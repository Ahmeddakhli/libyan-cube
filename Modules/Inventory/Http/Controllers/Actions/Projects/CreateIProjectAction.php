<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Modules\Inventory\IProject;
use DB;
use Carbon\Carbon;
use Modules\Attachments\Http\Controllers\Actions\PrepareAttachmentDataAction;
use Modules\Attachments\Http\Controllers\Actions\StoreSingleAttachmentsAction;
use Modules\Inventory\Http\Resources\IProjectResource;
use Modules\Inventory\UnitType;
use Illuminate\Support\Str;
use Modules\Inventory\PaymentPlan;

class CreateIProjectAction
{
    public function execute(array $data, $facilities = null, $amenities = null, $tags = null, $attachments = null, $floorplans = null): IProjectResource
    {
        if(isset($data['landing_page_image']) && is_file($data['landing_page_image'])){
            $data['landing_page_image'] = $data['landing_page_image']->store('landing_page_images','public');
        }
        // Transform delivery_date
        if (isset($data['delivery_date'])) {
            // Create delivery_date in user timezone then convert to UTC
            // $delivery_date = Carbon::createFromFormat('Y-m-d', $data['delivery_date'], auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->setTimezone('UTC')->toDateString();
            // $data['delivery_date'] = $delivery_date;
        }

        $data['publish_id'] = Str::uuid();
        // Create project
        $i_project = IProject::create($data);

        $created_at = Carbon::now()->toDateTimeString();

        foreach ($data['translations'] as $translation) {
            // To overcome composite primary key laravel insertion issue
            if ($translation['language_id'] == 1) {
                $slug = str_slug($translation['project']);
            }

            // Create translation
            DB::table('i_project_trans')->insert([
                'i_project_id' => $i_project->id,
                'language_id' => $translation['language_id'],
                'project' => $translation['project'],
                // 'second_title' => $translation['second_title'],
                'description' => isset($translation['description']) ? $translation['description'] : '',
                'landing_description' => isset($translation['landing_description']) ? $translation['landing_description'] : '',
                'meta_title' => isset($translation['meta_title']) && !is_null($translation['meta_title']) ? $translation['meta_title'] : $translation['project'],
                // 'meta_description' => isset($translation['meta_description']) && !is_null($translation['meta_description']) ? $translation['meta_description'] : (isset($translation['description']) ? $translation['description'] : ''),
                'meta_description' => isset($translation['meta_description']) && !is_null($translation['meta_description']) ? $translation['meta_description'] : '',
                'created_at' => $created_at
            ]);
        }

        // Associate the facilities with the project
        if ($facilities) {
            $i_project->facilities()->attach($facilities);
        }

        // Associate the amenities with the project
        if ($amenities) {
            $i_project->amenities()->attach($amenities);
        }

        // Associate the tags with the project
        if ($tags) {
            $i_project->tags()->attach($tags);
        }

        if (isset($data['payment_plans']) && count($data['payment_plans'])) {
            foreach ($data['payment_plans'] as $payment_plan) {

                $payment_plan = PaymentPlan::create([
                    'title' => $payment_plan['title'],
                    'delivery_date' => date('Y-m-d',strtotime($payment_plan['delivery_date'])),
                    'down_payment' => $payment_plan['down_payment'],
                    'years_of_installments' => $payment_plan['years_of_installments'],
                    'discount' => isset($payment_plan['discount']) ? $payment_plan['discount'] : null,
                ]);

                $i_project->paymentPlans()->save($payment_plan);
            }
        }
        $errors = array();
        $destination = '/projects/' . $i_project->id;

        // Upload attachments
        $destination = '/projects/' . $i_project->id;

        // Upload attachments
        if ($attachments && count($attachments)) {
            $type = 'attachment';
            $action = new PrepareAttachmentDataAction;
            $action->execute($attachments, $destination, $i_project, $type);
        }

        // Upload attachments
        // if ($floorplans && count($floorplans)) {
        //     $type = 'floorplan';
        //     $action = new PrepareAttachmentDataAction;
        //     $action->execute($floorplans, $destination, $i_project, $type);
        // }


        $created_at = Carbon::now()->toDateTimeString();
        // Create Project unit types
        if (isset($data['unit_types'])) {
            foreach ($data['unit_types'] as $unit_type) {
                if (isset($unit_type['translations'])) {

                    // Create unit type
                    $unit_type_file = $unit_type['image'];
                    $single_file_destination = '/unit-types';
                    if ($unit_type_file) {
                        $action = new StoreSingleAttachmentsAction;
                        $unit_type['image'] = $action->execute($unit_type_file, $single_file_destination);
                    }

                    $unit_type['project_id'] =  $i_project->id;

                    $i_unit_type = UnitType::create($unit_type);

                    foreach ($unit_type['translations'] as $trans) {
                        // Create unit type
                        DB::table('i_unit_type_trans')->insert([
                            'i_unit_type_id' => $i_unit_type->id,
                            'language_id' => $trans['language_id'],
                            'unit_type' => $trans['unit_type'],
                            'description' => isset($trans['description']) ? $trans['description'] : '',
                            'created_at' => $created_at
                        ]);
                    }
                }
            }
        }

        // Trigger update event on i_project to cache its values & set slug
        $i_project->update([
            'slug' => $slug
        ]);

        // Reload the instance
        $i_project = IProject::find($i_project->id);

        // Transform the result
        $i_project = new IProjectResource($i_project);

        // Return the response
        return $i_project;
    }
}

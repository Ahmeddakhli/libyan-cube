<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Modules\Inventory\IProject;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Modules\Attachments\Http\Controllers\Actions\DeleteAttachmentAction;
use Modules\Attachments\Http\Controllers\Actions\PrepareAttachmentDataAction;
use Modules\Attachments\Http\Controllers\Actions\StoreAttachmentAction;
use Modules\Attachments\Http\Controllers\Actions\StoreSingleAttachmentsAction;
use Modules\Inventory\Http\Controllers\Actions\Phases\CreateIPhaseAction;
use Modules\Inventory\Http\Resources\IProjectResource;
use Modules\Inventory\IProjectTranslation;
use Modules\Inventory\Http\Controllers\Actions\Phases\UpdateIPhaseAction;
use Modules\Inventory\IPhase;
use Modules\Inventory\UnitType;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use Illuminate\Support\Str;
use Modules\Inventory\PaymentPlan;

class UpdateIProjectAction
{
    public function execute($id, array $data, $facilities = null, $amenities = null, $tags = null, $attachments = null, $floorplans = null): IProjectResource
    {
        // Get project
        $i_project = IProject::find($id);

        if(isset($data['landing_page_image']) && is_file($data['landing_page_image'])){
            $data['landing_page_image'] = $data['landing_page_image']->store('landing_page_images','public');
        }
        // Transform delivery_date
        if (isset($data['delivery_date'])) {
            // Create delivery_date in user timezone then convert to UTC
            // $delivery_date = Carbon::createFromFormat('Y-m-d', $data['delivery_date'], auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->setTimezone('UTC')->format('Y-m-d');
            // $data['delivery_date'] = $delivery_date;
        }

        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();

        if (!$i_project->publish_id) {
            $data['publish_id'] = Str::uuid();
        }
        // Update/Create translations
        foreach ($data['translations'] as $translation) {
            // To overcome composite primary key laravel update issue
            $i_project_id = $id;
            $language_id = $translation['language_id'];
            if ($translation['language_id'] == 1) {
                $slug = str_slug($translation['project']);
                $data['slug'] = $slug;
            }

            // Set data for translation
            $translations_data = [
                'project' => $translation['project'],
                // 'second_title' => $translation['second_title'],
                'description' => isset($translation['description']) ? $translation['description'] : '',
                'landing_description' => isset($translation['landing_description']) ? $translation['landing_description'] : '',
                'meta_title' => isset($translation['meta_title']) && !is_null($translation['meta_title']) ? $translation['meta_title'] : $translation['project'],
                // 'meta_description' => isset($translation['meta_description']) && !is_null($translation['meta_description']) ? $translation['meta_description'] : (isset($translation['description']) ? $translation['description'] : ''),
                'meta_description' => isset($translation['meta_description']) && !is_null($translation['meta_description']) ? $translation['meta_description'] : '',
                'updated_at' => $updated_at
            ];

            // Check if translation exists
            $i_project_trnaslation = IProjectTranslation::where('i_project_id', $i_project_id)->where('language_id', $language_id)->first();

            if ($i_project_trnaslation) {
                DB::table('i_project_trans')->where('i_project_id', $i_project_id)->where('language_id', $language_id)->update($translations_data);
            } else {
                // Add additional data
                $translations_data['i_project_id'] = $i_project_id;
                $translations_data['language_id'] = $language_id;

                // Create project translation
                DB::table('i_project_trans')->insert($translations_data);
            }
        }

        // Associate the facilities with the unit
        if (is_array($facilities)) {
            $i_project->facilities()->sync([]);
            $i_project->facilities()->attach($facilities);
        } else {
            $i_project->facilities()->sync([]);
        }

        // Associate the amenities with the unit
        if (is_array($amenities)) {
            $i_project->amenities()->sync([]);
            $i_project->amenities()->attach($amenities);
        } else {
            $i_project->amenities()->sync([]);
        }

        // Associate the tags with the unit
        if (is_array($tags)) {
            $i_project->tags()->sync([]);
            $i_project->tags()->attach($tags);
        } else {
            $i_project->tags()->sync([]);
        }


        if (isset($data['payment_plans']) && count($data['payment_plans'])) {
            PaymentPlan::where('model_id', $i_project->id)->where('model_type','Modules\Inventory\IProject')->delete();
            foreach ($data['payment_plans'] as $payment_plan) {
                if($payment_plan['title']){
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
        }
        // errors array
        $errors = array();

        // File destination
        $destination = '/projects/' . $i_project->id;

        // errors array
        $errors = array();

        // Upload attachments
        if ($attachments && count($attachments)) {
            $type = 'attachment';
            $action = new PrepareAttachmentDataAction;
            $action->execute($attachments, $destination, $i_project, $type);
        }

        if (isset($data['delete_attachments']) && count($data['delete_attachments'])) {
            foreach ($data['delete_attachments'] as $value) {
                $action = new DeleteAttachmentAction;
                $action->execute($value);
            }
        }

        // Upload floorplans
        // if ($floorplans && count($floorplans)) {
        //     $type = 'floorplan';
        //     $action = new PrepareAttachmentDataAction;
        //     $action->execute($floorplans, $destination, $i_project, $type);
        // }

        // if (isset($data['delete_floorplans']) && count($data['delete_floorplans'])) {
        //     foreach ($data['delete_floorplans'] as $value) {
        //         $action = new DeleteAttachmentAction;
        //         $action->execute($value);
        //     }
        // }

        // Unit Type Update
        if (isset($data['unit_types'])) {
            foreach ($data['unit_types'] as $unit_type) {
                // Create unit type
                if (isset($unit_type['translations'])) {
                    $i_unit_type = null;
                    $unit_type['project_id'] =  $i_project->id;
                    if (isset($unit_type['i_unit_type_id']) && $unit_type['i_unit_type_id']) {
                        $i_unit_type = UnitType::find($unit_type['i_unit_type_id']);
                    }
                    // Check Unit Type Image To Upload Or Delete
                    if (isset($unit_type['image']) && $unit_type['image']) {
                        $unit_type_file = $unit_type['image'];
                        $single_file_destination = '/unit-types';
                        if ($unit_type_file) {
                            $action = new StoreSingleAttachmentsAction;
                            $unit_type['image'] = $action->execute($unit_type_file, $single_file_destination);
                        }
                    } else {
                        if (isset($unit_type['delete_unit_type_image']) && $unit_type['delete_unit_type_image'] == 1) {
                            $unit_type['image'] = null;
                            Storage::delete($i_unit_type->image);
                        }
                    }

                    if ($i_unit_type) {
                        $i_unit_type->update($unit_type);
                    } else {
                        $i_unit_type = UnitType::create($unit_type);
                    }

                    DB::table('i_unit_type_trans')->where('i_unit_type_id', $i_unit_type->id)->delete();

                    foreach ($unit_type['translations'] as $trans) {
                        // Create unit type
                        DB::table('i_unit_type_trans')->insert([
                            'i_unit_type_id' => $i_unit_type->id,
                            'language_id' => isset($trans['language_id']) ? $trans['language_id'] : 2,
                            'unit_type' => $trans['unit_type'],
                            'description' => isset($trans['description']) ? $trans['description'] : '',
                            'created_at' => $created_at
                        ]);
                    }
                    $trak_unit_type = UnitType::find($i_unit_type->id);
                    $trak_unit_type->save();
                }
            }
        }

        // Delete Unit types
        if (isset($data['unit_types_to_delete']) && !empty($data['unit_types_to_delete'])) {
            UnitType::whereIn('id', $data['unit_types_to_delete'])->delete();
        }

        // Update i_project
        // Trigger update event on i_project to cache its values
        $data['is_featured'] = isset($data['is_featured']) ? $data['is_featured'] : 0;
        $data['in_discover_by'] = isset($data['in_discover_by']) ? $data['in_discover_by'] : 0;
        $data['ready_to_move'] = isset($data['ready_to_move']) ? $data['ready_to_move'] : 0;

        $i_project->update($data);

        // Reload the instance
        $i_project = IProject::find($i_project->id);

        // Transform the result
        $i_project = new IProjectResource($i_project);

        return $i_project;
    }
}

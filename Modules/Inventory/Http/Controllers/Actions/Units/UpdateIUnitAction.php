<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Modules\Inventory\IUnit;
use Modules\Inventory\Http\Resources\IUnitResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use Illuminate\Http\JsonResponse;
use Lang;
use Modules\Attachments\Http\Controllers\Actions\StoreAttachmentAction;
use Modules\Inventory\IUnitTranslation;
use Carbon\Carbon;
use DB;
use Modules\Attachments\Entities\Attachmentable;
use Modules\Attachments\Http\Controllers\Actions\DeleteAttachmentAction;
use Modules\Attachments\Http\Controllers\Actions\StoreMultiDimensionalAttachmentsAction;
use Modules\Inventory\IUnitImage;
use Modules\Inventory\IUnitImageTranslation;
use Modules\Inventory\PaymentPlan;

class UpdateIUnitAction
{
    public function execute($id, array $data, $facilities = null, $amenities = null, $attachments = null, $floorplans = null, $masterplans, $images = null, $tags = null): IUnitResource
    {
        // Get the  unit
        $i_unit = IUnit::find($id);

        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();

        // Update/Create translations
        foreach ($data['translations'] as $translation) {
            // To overcome composite primary key laravel update issue
            if (($translation['address'] || $translation['description']) && isset($translation['language_id'])) {
                $i_unit_id = $id;
                $language_id = $translation['language_id'];
                $title = $translation['title'];
                $address = isset($translation['address']) ? $translation['address'] : null;
                $description = isset($translation['description']) ? $translation['description'] : null;
                $meta_description = isset($translation['meta_description']) ? $translation['meta_description'] : (isset($translation['description']) ? strip_tags(substr($translation['description'], 0, 150)) : null);
                $meta_title = isset($translation['meta_title']) ? $translation['meta_title'] : null;

                // Check if translation exists
                $i_unit_trnaslation = IUnitTranslation::where('i_unit_id', $i_unit_id)->where('language_id', $language_id)->first();

                if ($i_unit_trnaslation) {
                    DB::table('i_unit_trans')->where('i_unit_id', $i_unit_id)->where('language_id', $language_id)->update([
                        'address' => $address,
                        'description' => $description,
                        'title' => $title,
                        'meta_title' => $meta_title,
                        'meta_description' => $meta_description,
                        'updated_at' => $updated_at
                    ]);
                } else {
                    DB::table('i_unit_trans')->insert([
                        'i_unit_id' => $i_unit_id,
                        'language_id' => $language_id,
                        'address' => $address,
                        'description' => $description,
                        'meta_title' => $meta_title,
                        'meta_description' => $meta_description,
                        'created_at' => $created_at
                    ]);
                }
            }
        }

        // Append slug
        $data['slug'] = isset($data['unit_number']) ? str_slug($data['unit_number']) : str_slug($i_unit->unit_number);

        // Update the i_unit
        $data['is_featured'] = isset($data['is_featured']) ? $data['is_featured'] : 0;
        $data['ready_to_move'] = isset($data['ready_to_move']) ? $data['ready_to_move'] : 0;

        $i_unit->update($data);

        // Associate the facilities with the unit
        if (is_array($facilities)) {
            $i_unit->facilities()->sync([]);
            $i_unit->facilities()->attach($facilities);
        } else {
            $i_unit->facilities()->sync([]);
        }

        // Associate the amenities with the unit
        if (is_array($amenities)) {
            $i_unit->amenities()->sync([]);
            $i_unit->amenities()->attach($amenities);
        } else {
            $i_unit->amenities()->sync([]);
        }

        // Associate the tags with the unit
        if (is_array($tags)) {
            $i_unit->tags()->sync([]);
            $i_unit->tags()->attach($tags);
        } else {
            $i_unit->tags()->sync([]);
        }


        if (isset($data['payment_plans']) && count($data['payment_plans'])) {
            PaymentPlan::where('model_id', $i_unit->id)->where('model_type','Modules\Inventory\IUnit')->delete();
            foreach ($data['payment_plans'] as $payment_plan) {

                $payment_plan = PaymentPlan::create([
                    'title' => $payment_plan['title'],
                    'delivery_date' => date('Y-m-d',strtotime($payment_plan['delivery_date'])),
                    'down_payment' => $payment_plan['down_payment'],
                    'installment_amount' => $payment_plan['installment_amount'],
                    'years_of_installments' => isset($payment_plan['years_of_installments']) ? $payment_plan['years_of_installments'] : null,
                    'discount' => isset($payment_plan['discount']) ? $payment_plan['discount'] : null,
                ]);

                $i_unit->paymentPlans()->save($payment_plan);
            }
        }

        // File destination
        $destination = '/units/' . $i_unit->id;

        // errors array
        $errors = array();

        if ($attachments && count($attachments)) {
            foreach ($attachments as $attachment) {
                if (isset($attachment['file']) && $attachment['file']) {
                    // Upload multiple dimensionals Attachments
                    $attachment_file = $attachment['file'];
                    $file_name_with_extension = $attachment_file->getClientOriginalName();
                    $file_name_without_extension = pathinfo($file_name_with_extension, PATHINFO_FILENAME);
                    $extension = $attachment_file->getClientOriginalExtension();

                    $name = uniqid() . '_' . $file_name_without_extension;

                    $action = new StoreMultiDimensionalAttachmentsAction;
                    $action->execute($attachment_file, $name, $extension);

                    try {
                        $file = $attachment['file'];
                        if (is_array($attachment) && isset($attachment['order']) && $attachment['order']) {
                            $order = $attachment['order'];
                        } else {
                            $order = $i_unit->attachmentables()->where('type', 'attachment')->count() + 1;
                        }
                        $file_name = $name . '.' . $extension;
                        $project_attachment = new StoreAttachmentAction();
                        $project_attachment = $project_attachment->execute($file, $file_name, $order, $destination, 'attachment');
                        $i_unit->attachmentables()->save($project_attachment);
                    } catch (FileUnacceptableForCollection $e) {
                        $errors[] = [
                            'field' => 'file',
                            'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                        ];
                    }
                } else {
                    if (isset($attachment['attachment_id']) && $attachment['attachment_id']) {
                        if (isset($attachment['name']) && $attachment['name']) {
                            Attachmentable::where('id', $attachment['attachment_id'])->update([
                                'alt' => $attachment['name']
                            ]);
                        }
                    }
                }
            }
        }

        if (isset($data['delete_attachments']) && count($data['delete_attachments'])) {
            foreach ($data['delete_attachments'] as $value) {
                $action = new DeleteAttachmentAction;
                $action->execute($value);
            }
        }
        // Upload floorplans
        if ($floorplans && count($floorplans)) {
            foreach ($floorplans as $floorplan) {
                if (isset($floorplan['file']) && $floorplan['file']) {
                    // Upload multiple dimensionals floorplans
                    $floorplan_file = $floorplan['file'];
                    $file_name_with_extension = $floorplan_file->getClientOriginalName();
                    $file_name_without_extension = pathinfo($file_name_with_extension, PATHINFO_FILENAME);
                    $extension = $floorplan_file->getClientOriginalExtension();

                    $name = uniqid() . '_' . $file_name_without_extension;

                    $action = new StoreMultiDimensionalAttachmentsAction;
                    $action->execute($floorplan_file, $name, $extension);

                    try {
                        $file = $floorplan['file'];
                        if (is_array($floorplan) && isset($floorplan['order']) && $floorplan['order']) {
                            $order = $floorplan['order'];
                        } else {
                            $order = $i_unit->attachmentables()->where('type', 'floorplan')->count() + 1;
                        }
                        $file_name = $name . '.' . $extension;
                        $project_floorplan = new StoreAttachmentAction();
                        $project_floorplan = $project_floorplan->execute($file, $file_name, $order, $destination, 'floorplan');
                        $i_unit->attachmentables()->save($project_floorplan);
                    } catch (FileUnacceptableForCollection $e) {
                        $errors[] = [
                            'field' => 'file',
                            'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                        ];
                    }
                }
            }
        }

        if (isset($data['delete_floorplans']) && count($data['delete_floorplans'])) {
            foreach ($data['delete_floorplans'] as $value) {
                $action = new DeleteAttachmentAction;
                $action->execute($value);
            }
        }


        // Upload masterplans
        if ($masterplans && count($masterplans)) {
            foreach ($masterplans as $masterplan) {
                if (isset($masterplan['file']) && $masterplan['file']) {
                    // Upload multiple dimensionals masterplans
                    $masterplan_file = $masterplan['file'];
                    $file_name_with_extension = $masterplan_file->getClientOriginalName();
                    $file_name_without_extension = pathinfo($file_name_with_extension, PATHINFO_FILENAME);
                    $extension = $masterplan_file->getClientOriginalExtension();

                    $name = uniqid() . '_' . $file_name_without_extension;

                    $action = new StoreMultiDimensionalAttachmentsAction;
                    $action->execute($masterplan_file, $name, $extension);

                    try {
                        $file = $masterplan['file'];
                        if (is_array($masterplan) && isset($masterplan['order']) && $masterplan['order']) {
                            $order = $masterplan['order'];
                        } else {
                            $order = $i_unit->attachmentables()->where('type', 'masterplan')->count() + 1;
                        }
                        $file_name = $name . '.' . $extension;
                        $project_masterplan = new StoreAttachmentAction();
                        $project_masterplan = $project_masterplan->execute($file, $file_name, $order, $destination, 'masterplan');
                        $i_unit->attachmentables()->save($project_masterplan);
                    } catch (FileUnacceptableForCollection $e) {
                        $errors[] = [
                            'field' => 'file',
                            'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                        ];
                    }
                }
            }
        }

        if (isset($data['delete_masterplans']) && count($data['delete_masterplans'])) {
            foreach ($data['delete_masterplans'] as $value) {
                $action = new DeleteAttachmentAction;
                $action->execute($value);
            }
        }

        // Image 360 Create\Update
        if ($images && count($images)) {
            foreach ($images as $image) {
                if (isset($image['link']) && $image['link']) {
                    if (isset($image['i_unit_image_id'])) {
                        $i_unit_image = IUnitImage::find($image['i_unit_image_id']);
                        $i_unit_image->update([
                            'i_unit_id' => $i_unit->id,
                            'link' => $image['link']
                        ]);
                    } else {
                        $i_unit_image = IUnitImage::Create([
                            'i_unit_id' => $i_unit->id,
                            'link' => $image['link']
                        ]);
                    }

                    // Create Image title translations
                    foreach ($image['translations'] as $value) {
                        if (isset($value['language_id']) && $value['title']) {
                            $i_unit_image_translation = IUnitImageTranslation::where('i_unit_image_id', $i_unit_image->id)->where('language_id', $value['language_id'])->first();
                            if ($i_unit_image_translation) {
                                IUnitImageTranslation::where('i_unit_image_id', $i_unit_image->id)->where('language_id', $value['language_id'])->update([
                                    'title' => $value['title'],
                                    'updated_at' => $updated_at
                                ]);
                            } else {
                                IUnitImageTranslation::insert([
                                    'i_unit_image_id' => $i_unit_image->id,
                                    'language_id' => $value['language_id'],
                                    'title' => $value['title'],
                                    'created_at' => $created_at,
                                    'updated_at' => $updated_at
                                ]);
                            }
                        }
                    }
                }
            }
        }

        // Transform the result
        $i_unit = new IUnitResource($i_unit);

        // Return the response
        return $i_unit;
    }
}

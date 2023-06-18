<?php

namespace Modules\Inventory\Http\Controllers\Actions\Facilities;

use Modules\Inventory\IFacility;
use Modules\Inventory\IFacilityTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IFacilityResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use Ramsey\Uuid\Uuid;

class CreateIFacilityAction
{
    public function execute(array $data, $attachments = null): IFacilityResource
    {
        // Create facility
        $i_facility = IFacility::create([
            'id' => Uuid::uuid1(),
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : null,
            'svg' => isset($data['svg']) ? $data['svg'] : null
        ]);
        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_facility_id = $i_facility->id;
            $language_id = $data['translations'][$i]['language_id'];
            $facility = $data['translations'][$i]['facility'];
            $description = $data['translations'][$i]['description'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_facility_trans')->insert([
                'i_facility_id' => $i_facility_id,
                'language_id' => $language_id,
                'facility' => $facility,
                'description' => $description,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_facility to cache its values
        $i_facility->update();

        // Upload attachments
        if ($attachments) {
            $path = storage_path('tmp/uploads');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $errors = array();

            $name = uniqid() . '_' . trim($attachments->getClientOriginalName());
            $attachments->move($path, $name);

            $full_path = storage_path('tmp/uploads/' . $name);

            // Associate the file with the unit collection
            try {
                $i_facility
                    ->addMedia(storage_path('tmp/uploads/' . $name))
                    ->toMediaCollection(request()->getHttpHost() . ',inventory,facilities,' . $i_facility->id . ',' . 'attachments');
            } catch (FileUnacceptableForCollection $e) {
                $errors[] = [
                    'field' => 'file',
                    'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                    // 'message' => $e->getMessage()
                ];
            }

            if (count($errors)) {
                throw new HttpResponseException(response()->json([
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
        }

        // Reload the instance
        $i_facility = IFacility::find($i_facility->id);

        // Transform the result
        $i_facility = new IFacilityResource($i_facility);

        return $i_facility;
    }
}

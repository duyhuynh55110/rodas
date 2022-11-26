<?php

namespace App\Modules\Admin\Services;

use App\Exceptions\DataNotFoundException;
use App\Modules\Admin\Repositories\GiftBoxRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * GiftBoxService
 */
class GiftBoxService
{
    /**
     * @var GiftBoxRepository
     */
    private $giftBoxRepo;

    /**
     * __construct
     *
     * @param  GiftBoxRepository  $giftBoxRepo
     */
    public function __construct(GiftBoxRepository $giftBoxRepo)
    {
        $this->giftBoxRepo = $giftBoxRepo;
    }

    /**
     * Data for gift boxes table
     *
     * @param  Request  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function giftBoxesDataTable(Request $request)
    {
        $filter = [
            'name' => $request->name ?? null,
        ];

        return $this->giftBoxRepo->giftBoxesDataTable($filter);
    }

    /**
     * Get gift box by id
     *
     * @param $id
     * @return App\Models\GiftBox
     */
    public function getGiftBoxById($id)
    {
        $giftBox = $this->giftBoxRepo->find($id);

        // throw exception if not found data
        if (! $giftBox) {
            throw new DataNotFoundException();
        }

        return $giftBox;
    }

    /**
     * Create/Update a gift box
     *
     * @param $request
     * @return App\Models\GiftBox
     */
    public function updateOrCreate($request)
    {
        try {
            // db - start transaction
            DB::beginTransaction();

            // gift box id
            $id = $request->id;

            // gift box values
            $values = [
                'name' => $request->name,
                'price' => $request->price,
            ];

            // if have upload file
            if ($request->hasFile('image_file_upload')) {
                // prepare for remove image if was update form
                if ($id) {
                    $giftBox = $this->getGiftBoxById($id);
                    $deleteLogoFileName = $giftBox->image_file_name;
                }

                // prepare for upload image to storage
                $file = $request->image_file_upload;
                $logoFileName = STORAGE_PATH_TO_GIFT_BOXES.$file->hashName();

                // save logo name
                $values['image_file_name'] = $logoFileName;
            }

            // create/update giftBox
            $giftBox = $this->giftBoxRepo->updateOrCreateWithRelations(
                [
                    'id' => $id,
                ],
                $values,
                $request->gift_box_products,
            );

            // db - end transaction and save data
            DB::commit();

            // upload file to storage
            if ($request->hasFile('image_file_upload')) {
                // delete old image if was update form
                if ($id) {
                    deleteImageFromStorage($deleteLogoFileName);
                }

                // upload to storage
                uploadImageToStorage($file, $logoFileName, RESIZE_GIFT_BOXES_WIDTH, RESIZE_GIFT_BOXES_HEIGHT);
            }

            return $giftBox;
        } catch (Throwable $e) {
            // log error
            Log::error($e);

            // db rollback
            DB::rollback();

            // throw exception to handle exception in controller
            throw new $e;
        }
    }
}

<?php

namespace App\Modules\Admin\Services;

use App\Exceptions\DataNotFoundException;
use App\Modules\Admin\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Brand Service
 */
class BrandService
{
    /**
     * @var Brand Repository
     */
    private $brandRepo;

    /**
     * __construct
     *
     * @param BrandRepository $brandRepo
     */
    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }

    /**
     * Data for brands table
     *
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function brandsDataTable(Request $request)
    {
        $filters = [
            'name' => $request->name ?? null,
            'country_id' => $request->country_id ?? null,
        ];

        return $this->brandRepo->brandsDataTable($filters);
    }

    /**
     * Create/Update a brand
     *
     * @param $request
     * @return App\Models\Brand
     */
    public function updateOrCreate($request) {
        try {
            // db - start transaction
            DB::beginTransaction();

            // brand id
            $id = $request->id;

            // brand values
            $values = [
                'name' => $request->name,
                'country_id' => $request->country_id,
            ];

            // if have upload file
            if($request->hasFile('logo_file_upload')) {
                // prepare for remove image if was update form
                if($id) {
                    $brand = $this->getBrandById($id);
                    $deleteLogoFileName = $brand->logo_file_name;
                }

                // prepare for upload image to storage
                $file = $request->logo_file_upload;
                $logoFileName = STORAGE_PATH_TO_BRANDS . $file->hashName();

                // save logo name
                $values['logo_file_name'] = $logoFileName;
            }

            // create/update brand
            $brand = $this->brandRepo->updateOrCreate(
                [
                    'id' => $id,
                ],
                $values
            );

            // db - end transaction and save data
            DB::commit();

            // upload file to storage
            if ($request->hasFile('logo_file_upload')) {
                // delete old image if was update form
                if ($id) {
                    deleteImageFromStorage($deleteLogoFileName);
                }

                // upload to storage
                uploadImageToStorage($file, $logoFileName, RESIZE_BRAND_WIDTH, RESIZE_BRAND_HEIGHT);
            }

            return $brand;
        } catch (Throwable $e) {
            // log error
            Log::error($e);

            // db rollback
            DB::rollback();

            // throw exception to handle exception in controller
            throw new $e;
        }
    }

    /**
     * Get brand by id
     *
     * @param $id
     * @return App\Models\Brand
     */
    public function getBrandById($id)
    {
        $brand = $this->brandRepo->find($id);

        // throw exception if not found data
        if(!$brand) {
            throw new DataNotFoundException();
        }

        return $brand;
    }
}

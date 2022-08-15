<?php

namespace App\Modules\Admin\Services;

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

            // brand values
            $values = [
                'name' => $request->name,
                'country_id' => $request->country_id,
            ];

            // upload image
            if($request->hasFile('logo_file_upload')) {
                $file = $request->logo_file_upload;
                $logoFileName = STORAGE_PATH_TO_BRANDS . $file->hashName();

                // upload to storage
                uploadImageToStorage($file, $logoFileName, RESIZE_BRAND_WIDTH, RESIZE_BRAND_HEIGHT);

                $values['logo_file_name'] = $logoFileName;
            }

            // create/update brand
            $brand = $this->brandRepo->updateOrCreate(
                [
                    'id' => $request->id,
                ],
                $values
            );

            // db - end transaction and save data
            DB::commit();

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
}

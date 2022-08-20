<?php

namespace App\Modules\Admin\Services;

use App\Exceptions\DataNotFoundException;
use App\Modules\Admin\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * ProductService
 */
class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepo;

    /**
     * __construct
     *
     * @param ProductRepository $productRepo
     */
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * Data for products table
     *
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function productsDataTable(Request $request)
    {
        $filters = [
            'name' => $request->name ?? null,
            'brand_id' => $request->brand_id ?? null,
            'country_id' => $request->country_id ?? null,
        ];

        return $this->productRepo->productsDataTable($filters);
    }

    /**
     * Get product by id
     *
     * @param $id
     * @return App\Models\Product
     */
    public function getProductById($id)
    {
        $product = $this->productRepo->find($id);

        // throw exception if not found data
        if(!$product) {
            throw new DataNotFoundException();
        }

        return $product;
    }

    /**
     * Create/Update a product
     *
     * @param $request
     * @return App\Models\Product
     */
    public function updateOrCreate($request) {
        try {
            // db - start transaction
            DB::beginTransaction();

            // product id
            $id = $request->id;

            // product values
            $values = [
                'name' => $request->name,
                'item_price' => $request->item_price,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
            ];

            // if have upload file
            if($request->hasFile('image_file_upload')) {
                // prepare for remove image if was update form
                if($id) {
                    $product = $this->getProductById($id);
                    $deleteLogoFileName = $product->image_file_upload;
                }

                // prepare for upload image to storage
                $file = $request->image_file_upload;
                $logoFileName = STORAGE_PATH_TO_PRODUCTS . $file->hashName();

                // save logo name
                $values['image_file_name'] = $logoFileName;
            }

            // create/update product
            $product = $this->productRepo->updateOrCreateWithRelations(
                [
                    'id' => $id,
                ],
                $values,
                $request->category_ids,
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
                uploadImageToStorage($file, $logoFileName, RESIZE_PRODUCT_WIDTH, RESIZE_PRODUCT_HEIGHT);
            }

            return $product;
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

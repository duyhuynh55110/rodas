<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Admin\Http\Controllers\BaseController;
use App\Modules\Admin\Http\Requests\ProductFormRequest;
use App\Modules\Admin\Services\BrandService;
use App\Modules\Admin\Services\CategoryService;
use App\Modules\Admin\Services\CountryService;
use App\Modules\Admin\Services\ProductService;
use Base\Assets\Assets;
use Throwable;

/**
 * ProductController
 */
class ProductController extends BaseController
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @var CountryService
     */
    private $countryService;

    /**
     * @var BrandService
     */
    private $brandService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * __construct
     *
     * @param ProductService $productService
     * @param CountryService $countryService
     * @param BrandService $brandService
     * @param CategoryService $categoryService
     */
    public function __construct(ProductService $productService, CountryService $countryService, BrandService $brandService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->countryService = $countryService;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
    }

    /**
     * View page product list
     *
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        if($request->expectsJson()) {
            return $this->productService->productsDataTable($request);
        }

        // data
        $brands = $this->brandService->getAllBrands();
        $countries = $this->countryService->getAllCountries();
        $options = [
            'updateUrl' => routeAdmin('products.edit', [
                'id' => '%s',
            ]),
            'dataTableAjax' => routeAdmin('products.index'),
        ];

        // init js
        $this->registerAssets();

        return view('Admin::products.index', compact('countries', 'options', 'brands'));
    }

    /**
     * View create product form
     *
     * @return view
     */
    public function create()
    {
        // data
        $brands = $this->brandService->getAllBrands();
        $categories = $this->categoryService->getAllCategories();

        // init js
        $this->registerAssets();

        return view('Admin::products.form', compact('brands', 'categories'));
    }

    /**
     * View edit product form
     *
     * @param $id
     * @return view
     */
    public function edit($id)
    {
        try {
            $product = $this->productService->getProductById($id);

            // data
            $brands = $this->brandService->getAllBrands();
            $categories = $this->categoryService->getAllCategories();

            // init js
            $this->registerAssets();

            return view('Admin::products.form', compact('product', 'brands', 'categories'));
        } catch (Throwable $e) {
            return back()->with('status', $e->getMessage())->with('status_type', 'danger')->withInput();
        }
    }

    /**
     * Save a product data
     *
     * @param ProductFormRequest $request
     * @return mixed
     */
    public function save(ProductFormRequest $request)
    {
        try {
            $this->productService->updateOrCreate($request);
            return redirect(routeAdmin('products.index'))->with('status', DATA_SAVED);
        } catch (Throwable $e) {
            return back()->with('status', ERROR_OCCURRED_MSG)->with('status_type', 'danger')->withInput();
        }
    }

    /**
     * Register assets
     *
     * @return void
     */
    private function registerAssets() : void
    {
        Assets::js(
            [
                assetAdmin('pages/products.js')
            ]
        );
    }
}
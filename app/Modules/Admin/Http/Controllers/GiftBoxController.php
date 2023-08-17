<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Http\Requests\GiftBoxFormRequest;
use App\Modules\Admin\Services\BrandService;
use App\Modules\Admin\Services\CountryService;
use App\Modules\Admin\Services\GiftBoxService;
use Base\Assets\Assets;
use Illuminate\Http\Request;
use Throwable;

/**
 * GiftBoxController
 */
class GiftBoxController extends BaseController
{
    /**
     * @var GiftBoxService
     */
    private $giftBoxService;

    /**
     * @var BrandService
     */
    private $brandService;

    /**
     * @var CountryService
     */
    private $countryService;

    /**
     * __construct
     */
    public function __construct(GiftBoxService $giftBoxService, BrandService $brandService, CountryService $countryService)
    {
        $this->giftBoxService = $giftBoxService;
        $this->brandService = $brandService;
        $this->countryService = $countryService;
    }

    /**
     * View page giftBox list
     *
     * @return view
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->giftBoxService->giftBoxesDataTable($request);
        }

        $options = [
            'updateUrl' => routeAdmin('gift-boxes.edit', [
                'id' => '%s',
            ]),
            'dataTableAjax' => routeAdmin('gift-boxes.index'),
        ];

        // init js
        $this->registerAssets();

        return view('Admin::gift-boxes.index', compact('options'));
    }

    /**
     * View create giftBox form
     *
     * @return view
     */
    public function create()
    {
        // data
        $brands = $this->brandService->getAllBrands();
        $countries = $this->countryService->getAllCountries();

        $options = [
            'giftBoxProducts' => [
                'dataTableAjax' => routeAdmin('products.index'),
            ],
            'searchProducts' => [
                'dataTableAjax' => routeAdmin('products.index'),
            ],
        ];

        // init js
        $this->registerAssets();

        return view('Admin::gift-boxes.form', compact(
            'brands',
            'countries',
            'options',
        ));
    }

    /**
     * View edit giftBox form
     *
     * @return view
     */
    public function edit($id)
    {
        try {
            // data
            $giftBox = $this->giftBoxService->getGiftBoxById($id);
            $brands = $this->brandService->getAllBrands();
            $countries = $this->countryService->getAllCountries();

            $options = [
                'giftBoxProducts' => [
                    'data' => $this->getGiftBoxProductsData($giftBox),
                ],
                'searchProducts' => [
                    'dataTableAjax' => routeAdmin('products.index'),
                ],
            ];

            // init js
            $this->registerAssets();

            return view('Admin::gift-boxes.form', compact(
                'giftBox',
                'brands',
                'countries',
                'options',
            ));
        } catch (Throwable $e) {
            return back()->with('status', $e->getMessage())->with('status_type', 'danger')->withInput();
        }
    }

    /**
     * Save a gift box data
     *
     * @return mixed
     */
    public function save(GiftBoxFormRequest $request)
    {
        try {
            $this->giftBoxService->updateOrCreate($request);

            return redirect(routeAdmin('gift-boxes.index'))->with('status', DATA_SAVED);
        } catch (Throwable $e) {
            return back()->with('status', ERROR_OCCURRED_MSG)->with('status_type', 'danger')->withInput();
        }
    }

    /**
     * Register assets
     */
    private function registerAssets(): void
    {
        Assets::js(
            [
                assetAdmin('pages/gift-boxes.js'),
            ]
        );
    }

    /**
     * Return gift box products data for giftBoxProducts table
     *
     * @return array
     */
    private function getGiftBoxProductsData($giftBox)
    {
        return $giftBox->products->map(
            function ($product) {
                $brand = $product->brand;
                $country = $brand->country;

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'item_price' => floatval($product->item_price),
                    'full_path_image' => $product->full_path_image,
                    'quantity' => $product->pivot->quantity,
                    'brand' => [
                        'id' => $brand->id,
                        'name' => $brand->name,
                        'country' => [
                            'id' => $country->id,
                            'name' => $country->name,
                        ],
                    ],
                ];
            }
        );
    }
}

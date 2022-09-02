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
     *
     * @param GiftBoxService $giftBoxService
     * @param BrandService $brandService
     * @param CountryService $countryService
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
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->giftBoxService->giftBoxsDataTable($request);
        }

        $options = [
            'updateUrl' => routeAdmin('gift-boxs.edit', [
                'id' => '%s',
            ]),
            'dataTableAjax' => routeAdmin('gift-boxs.index'),
        ];

        // init js
        $this->registerAssets();

        return view('Admin::gift-boxs.index', compact('options'));
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

        return view('Admin::gift-boxs.form', compact(
            'brands',
            'countries',
            'options',
        ));
    }

    /**
     * View edit giftBox form
     *
     * @param $id
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

            return view('Admin::gift-boxs.form', compact(
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
     * @param GiftBoxFormRequest $request
     * @return mixed
     */
    public function save(GiftBoxFormRequest $request)
    {
        try {
            $this->giftBoxService->updateOrCreate($request);
            return redirect(routeAdmin('gift-boxs.index'))->with('status', DATA_SAVED);
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
                assetAdmin('pages/gift-boxs.js')
            ]
        );
    }

    /**
     * Return gift box products data for giftBoxProducts table
     *
     * @param $giftBox
     * @return array
     */
    private function getGiftBoxProductsData($giftBox) {
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
                        ]
                    ],
                ];
            }
        );
    }
}

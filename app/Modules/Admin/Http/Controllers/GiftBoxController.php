<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Services\BrandService;
use App\Modules\Admin\Services\CountryService;
use App\Modules\Admin\Services\GiftBoxService;
use Base\Assets\Assets;
use Illuminate\Http\Request;

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
        // init js
        $this->registerAssets();

        return view('Admin::gift-boxs.form');
    }

    /**
     * Save a gift box data
     *
     * @param Request $request
     * @return mixed
     */
    public function save(Request $request)
    {
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
}

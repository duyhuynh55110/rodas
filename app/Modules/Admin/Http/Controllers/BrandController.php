<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Admin\Http\Controllers\BaseController;
use App\Modules\Admin\Services\BrandService;
use App\Modules\Admin\Services\CountryService;
use Base\Assets\Assets;

/**
 * BrandController
 */
class BrandController extends BaseController
{
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
     * @param BrandService $brandService
     * @param CountryService $countryService
     */
    public function __construct(BrandService $brandService, CountryService $countryService)
    {
        $this->brandService = $brandService;
        $this->countryService = $countryService;
    }

    public function index(Request $request)
    {
        if($request->expectsJson()) {
            return $this->brandService->brandsDataTable($request);
        }

        // data
        $countries = $this->countryService->getAllCountries();
        $options = [
            'updateUrl' => routeAdmin('brands.edit', [
                'id' => '%s',
            ]),
            'dataTableAjax' => routeAdmin('brands.index'),
        ];

        // init js
        $this->registerAssets();

        return view('Admin::brands.index', compact(
            'countries',
            'options',
        ));
    }

    public function create()
    {
        return 'create page';
    }

    public function edit($id)
    {
        return 'edit page';
    }

    public function save()
    {
        return 'save';
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
                assetAdmin('pages/brands.js')
            ]
        );
    }
}

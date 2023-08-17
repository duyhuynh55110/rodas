<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Http\Requests\BrandFormRequest;
use App\Modules\Admin\Services\BrandService;
use App\Modules\Admin\Services\CountryService;
use Base\Assets\Assets;
use Illuminate\Http\Request;
use Throwable;

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
     */
    public function __construct(BrandService $brandService, CountryService $countryService)
    {
        $this->brandService = $brandService;
        $this->countryService = $countryService;
    }

    /**
     * View page brand list
     *
     * @return view
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
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

    /**
     * View create brand form
     *
     * @return view
     */
    public function create()
    {
        // country list
        $countries = $this->countryService->getAllCountries();

        // init js
        $this->registerAssets();

        return view('Admin::brands.form', compact('countries'));
    }

    /**
     * View edit brand form
     *
     * @return view
     */
    public function edit($id)
    {
        try {
            $brand = $this->brandService->getBrandById($id);

            // country list
            $countries = $this->countryService->getAllCountries();

            // init js
            $this->registerAssets();

            return view('Admin::brands.form', compact('countries', 'brand'));
        } catch (Throwable $e) {
            return back()->with('status', $e->getMessage())->with('status_type', 'danger')->withInput();
        }
    }

    /**
     * Save a brand data
     *
     * @return mixed
     */
    public function save(BrandFormRequest $request)
    {
        try {
            $this->brandService->updateOrCreate($request);

            return redirect(routeAdmin('brands.index'))->with('status', DATA_SAVED);
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
                assetAdmin('pages/brands.js'),
            ]
        );
    }
}

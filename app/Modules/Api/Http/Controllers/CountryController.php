<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Services\CountryService;

class CountryController extends BaseController
{
    /**
     * Constructor
     *
     * @param  CountryService  $countryService
     */
    public function __construct(private CountryService $countryService)
    {
        parent::__construct();
    }

    /**
     * Get all countries
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index() {
        $collection = $this->countryService->getCountries();

        return $this->outputJson($collection);
    }
}

<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\CountryRepository;
use App\Modules\Api\Transformers\CountryTransformer;

class CountryService
{
    /**
     * Constructor
     *
     * @param  CountryRepository $countryRepo
     */
    public function __construct(private CountryRepository $countryRepo)
    {}

    /**
     * Get all countries with fractal format
     *
     * @return League\Fractal\Resource\Collection
     */
    public function getCountries() {
        $data = $this->countryRepo->getCountries();

        return createFractalCollection($data, new CountryTransformer);
    }
}

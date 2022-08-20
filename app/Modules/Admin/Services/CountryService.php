<?php

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Repositories\CountryRepository;

/**
 * Country Service
 */
class CountryService
{
    /**
     * @var Country Repository
     */
    private $countryRepo;

    /**
     * __construct
     *
     * @param CountryRepository $countryRepo
     */
    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepo = $countryRepo;
    }

    /**
     * Get list all countries
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllCountries()
    {
        return $this->countryRepo->getCountries();
    }
}

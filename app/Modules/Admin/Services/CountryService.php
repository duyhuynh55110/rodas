<?php

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Repositories\CountryRepository;

/**
 * CountryService
 */
class CountryService
{
    /**
     * @var CountryRepository
     */
    private $countryRepo;

    /**
     * __construct
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

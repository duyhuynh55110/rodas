<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Services\CompositionService;

class CompositionController extends BaseController
{
    /**
     * Constructor
     */
    public function __construct(private CompositionService $compositionService)
    {
        parent::__construct();
    }

    /**
     * Response master data for home page
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function homePage()
    {
        $responseData = $this->compositionService->homePage();

        return $this->outputJson($responseData);
    }
}

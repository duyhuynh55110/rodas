<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Services\StorageService;
use Illuminate\Http\Request;

/**
 * StorageController
 */
class StorageController extends BaseController
{
    /**
     * @var StorageService
     */
    private $storageService;

    /**
     * __construct
     *
     * @param  StorageService  $storageService
     */
    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    /**
     * Upload image to storage
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadMultipleImagesToStorage(Request $request)
    {
        $imageNames = $this->storageService->uploadMultipleImagesToStorage($request);

        return $this->outputJson($imageNames);
    }
}

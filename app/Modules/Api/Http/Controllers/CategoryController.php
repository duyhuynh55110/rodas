<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Http\Requests\CategoryDetailFormRequest;
use App\Modules\Api\Services\CategoryService;

class CategoryController extends BaseController
{
    /**
     * Constructor
     *
     * @param  CategoryService  $categoryService
     */
    public function __construct(private CategoryService $categoryService)
    {
        parent::__construct();
    }

    /**
     * Response all categories
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $responseData = $this->categoryService->getAllCategories();

        return $this->outputJson($responseData);
    }

    /**
     * Response a catego
     *
     * @param $id
     * @param CategoryDetailFormRequest $request
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id, CategoryDetailFormRequest $request)
    {
        $responseData = $this->categoryService->getCategoryById($id);

        return $this->outputJson($responseData);
    }
}

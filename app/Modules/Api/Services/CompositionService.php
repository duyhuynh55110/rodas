<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\CategoryRepository;
use App\Modules\Api\Repositories\GiftBoxRepository;
use App\Modules\Api\Transformers\CategoryTransformer;
use App\Modules\Api\Transformers\GiftBoxTransformer;

class CompositionService
{
    /**
     * Constructor
     *
     * @param  CategoryRepository  $categoryRepo
     * @param  GiftBoxRepository  $giftBoxRepo
     */
    public function __construct(private CategoryRepository $categoryRepo, private GiftBoxRepository $giftBoxRepo)
    {
    }

    /**
     * Master data for homepage
     */
    public function homePage()
    {
        $categoriesCollection = createFractalCollection($this->categoryRepo->getAllCategories(), new CategoryTransformer);
        $giftBoxs = createFractalCollection($this->giftBoxRepo->getAllGiftBoxs(), new GiftBoxTransformer);

        return [
            'categories' => $categoriesCollection,
            'gift_boxs' => $giftBoxs,
        ];
    }
}

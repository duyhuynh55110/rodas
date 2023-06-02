<?php

namespace App\Modules\Api\Repositories;

use App\Models\GiftBox;
use Base\Repositories\Eloquent\Repository;

/**
 * GiftBoxRepository
 */
class GiftBoxRepository extends Repository
{
    /**
     * Model
     *
     * @return GiftBox::class
     */
    public function model()
    {
        return GiftBox::class;
    }

    /**
     * Get all giftBoxes
     *
     * @return array
     */
    public function getAllGiftBoxes()
    {
        return $this->model->select([
            'id',
            'name',
            'image_file_name',
            'price',
        ])->get();
    }
}

<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GiftBoxProduct extends Pivot
{
    use HasFactory, AdminTimestamp;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gift_box_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gift_box_id', 'product_id',
        'created_by', 'created_at', 'updated_by', 'updated_at'
    ];
}

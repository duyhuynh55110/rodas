<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, AdminTimestamp;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id', 'name', 'image_file_name', 'item_price', 'weight',
        'created_by', 'created_at', 'updated_by', 'updated_at'
    ];

    /**
     * Product belong to many categories
     *
     * @return mixed
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id')
                ->withTimestamps()
                ->withPivot(['deleted_at'])
                ->using(CategoryProduct::class);
    }
}

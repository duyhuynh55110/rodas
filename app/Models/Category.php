<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, AdminTimestamp;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'created_by', 'created_at', 'updated_by', 'updated_at',
    ];

    /**
     * Category has many products
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products', 'category_id', 'product_id')
            ->withTimestamps()
            ->withPivot(['deleted_at'])
            ->using(CategoryProduct::class);
    }
}

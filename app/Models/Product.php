<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_path_image'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id', 'name', 'image_file_name', 'item_price', 'weight',
        'created_by', 'created_at', 'updated_by', 'updated_at'
    ];

    // ---- Relations
    /**
     * Product belong to many categories
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id')
                ->withTimestamps()
                ->withPivot(['deleted_at'])
                ->using(CategoryProduct::class);
    }

    /**
     * Product belong to a brand
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    // ---- Mutators & Casting
    /**
     * Get full image path
     *
     * @return string
     */
    public function getFullPathImageAttribute()
    {
        if(empty($this->image_file_name)) {
            return null;
        }

        return Storage::disk()->url($this->image_file_name) ;
    }
}

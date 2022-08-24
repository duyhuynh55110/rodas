<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftBox extends Model
{
    use HasFactory, AdminTimestamp;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gift_boxs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image_file_name', 'price',
        'created_by', 'created_at', 'updated_by', 'updated_at'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_path_image'];

    // ---- Relations
    /**
     * Product belong to many giftBoxs
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products() {
        return $this->belongsToMany(GiftBox::class, 'gift_box_products', 'product_id', 'gift_box_id')
                ->withTimestamps()
                ->withPivot(['deleted_at'])
                ->using(GiftBoxProduct::class);
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

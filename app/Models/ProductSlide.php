<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductSlide extends Model
{
    use HasFactory, AdminTimestamp;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_slides';

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
        'product_id', 'image_file_name',
        'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_at',
    ];

    // ---- Mutators & Casting
    /**
     * Get full image path
     *
     * @return string
     */
    public function getFullPathImageAttribute()
    {
        if (empty($this->image_file_name)) {
            return null;
        }

        return Storage::disk()->url($this->image_file_name);
    }
}

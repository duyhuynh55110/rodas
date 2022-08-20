<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use HasFactory, AdminTimestamp;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'name', 'logo_file_name',
        'created_by', 'created_at', 'updated_by', 'updated_at'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_path_logo'];

    // ---- Relations
    /**
     * Brand belong to a country
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    // ---- Mutators & Casting
    /**
     * Get full image logo path
     *
     * @return string
     */
    public function getFullPathLogoAttribute()
    {
        if(empty($this->logo_file_name)) {
            return null;
        }

        return Storage::disk()->url($this->logo_file_name) ;
    }
}

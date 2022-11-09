<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AdminTimestamp;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // --- Relations
    /**
     * - User's cart has many products
     * - Products can belongs to many user's cart
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart()
    {
        return $this->belongsToMany(Product::class, 'cart_products', 'user_id', 'product_id')
                ->withTimestamps()
                ->withPivot(['quantity'])
                ->using(CartProduct::class);
    }

    /**
     * - User has many favorite products
     * - Products can be favorite by many users
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorite_products', 'user_id', 'product_id')
                ->withTimestamps()
                ->using(FavoriteProduct::class);
    }
}

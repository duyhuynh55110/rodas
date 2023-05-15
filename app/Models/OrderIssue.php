<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIssue extends Model
{
    use HasFactory, AdminTimestamp;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_issues';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status', 'total_price', 'note',
        'created_by', 'created_at', 'updated_by', 'updated_at',
    ];

    // ---- Relations
    /**
     * Order issue has many order issue products
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orderIssueProducts()
    {
        return $this->belongsToMany(Product::class, 'order_issue_products', 'order_issue_id', 'product_id')
                ->withTimestamps()
                ->withPivot(['item_price', 'quantity', 'amount', 'deleted_at'])
                ->using(OrderIssueProduct::class);
    }

    /**
     * Order issue has one inform
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderIssueInform()
    {
        return $this->hasOne(OrderIssueInform::class);
    }
}

<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIssueInform extends Model
{
    use HasFactory, AdminTimestamp;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_issues_inform';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id', 'order_issue_id', 'name', 'email', 'address', 'zip_code', 'city', 'phone',
        'created_by', 'created_at', 'updated_by', 'updated_at',
    ];
}

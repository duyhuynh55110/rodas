<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Concerns\HasEvents;

trait AdminTimestamp
{
    use HasEvents;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Creating event
         */
        self::creating(
            function ($model) {
                $admin = auth();

                // if have admin authorization
                if ($admin && $admin->user()) {
                    $userId = $admin->user()->id;

                    $model->created_by = $userId;
                    $model->updated_by = $userId;
                } else {
                    $model->created_by = CREATED_BY_SYSTEM;
                    $model->updated_by = CREATED_BY_SYSTEM;
                }
            }
        );

        /**
         * Updating event
         */
        self::updating(
            function ($model) {
                $admin = auth();

                // if have admin authorization
                if ($admin && $admin->user()) {
                    $userId = $admin->user()->id;

                    $model->updated_by = $userId;
                } else {
                    $model->updated_by = CREATED_BY_SYSTEM;
                }
            }
        );
    }
}

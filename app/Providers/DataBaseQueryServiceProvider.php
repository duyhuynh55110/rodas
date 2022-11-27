<?php

namespace App\Providers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class DataBaseQueryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        DB::listen(function ($query) {
            $sql = $query->sql;
            foreach ($query->bindings as $binding) {
                if (is_string($binding)) {
                    $binding = "'{$binding}'";
                } elseif ($binding === null) {
                    $binding = 'NULL';
                } elseif ($binding instanceof Carbon) {
                    $binding = "'{$binding->toDateTimeString()}'";
                } elseif ($binding instanceof DateTime) {
                    $binding = "'{$binding->format('Y-m-d H:i:s')}'";
                }

                $sql = preg_replace("/\?/", $binding, $sql, 1);
            }

            Log::debug('SQL', ['sql' => $sql, 'time' => "$query->time ms"]);
        });

        Event::listen(TransactionBeginning::class, function (TransactionBeginning $event) {
            Log::debug('[sql] start transaction');
        });

        Event::listen(TransactionCommitted::class, function (TransactionCommitted $event) {
            Log::debug('[sql] commit transaction');
        });

        Event::listen(TransactionRolledBack::class, function (TransactionRolledBack $event) {
            Log::debug('[sql] rollback transaction');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

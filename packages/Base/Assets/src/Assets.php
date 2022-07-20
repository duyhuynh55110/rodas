<?php

namespace Base\Assets;

use Illuminate\Support\Facades\Facade;

/**
 * Assets facade - allows easy access to the Manager instance.
 *
 * @see AssetsManager
 */
class Assets extends Facade
{
    /**
     * Get the name of the class registered in the Application container.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return AssetsManager::class;
    }
}

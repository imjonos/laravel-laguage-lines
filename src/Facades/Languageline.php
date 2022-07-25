<?php

namespace Nos\Languageline\Facades;

use Illuminate\Support\Facades\Facade;

class Languageline extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'languageline';
    }
}

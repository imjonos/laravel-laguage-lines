<?php

namespace CodersStudio\Languageline\Facades;

use Illuminate\Support\Facades\Facade;

class Languageline extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'languageline';
    }
}

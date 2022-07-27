<?php

namespace Nos\LanguageLine\Facades;

use Illuminate\Support\Facades\Facade;

class LanguageLine extends Facade
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

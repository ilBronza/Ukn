<?php

namespace IlBronza\Ukn\Facades;

use Illuminate\Support\Facades\Facade;

class Ukn extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ukn';
    }
}

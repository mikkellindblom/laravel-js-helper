<?php

namespace Mikkellindblom\jsHelper\JavaScript;

use Illuminate\Support\Facades\Facade;

class JavaScriptFacade extends Facade
{
    /**
     * The name of the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'JavaScript';
    }
}
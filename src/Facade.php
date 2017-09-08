<?php

namespace Seekerliu\YaJson;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    /**
     * Facade Name.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'YaJson';
    }
}

<?php

namespace Reizee\Api\Facades;

use Illuminate\Support\Facades\Facade;

class ReizeeApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'reizee_api';
    }
}

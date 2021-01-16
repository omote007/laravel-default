<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class CommonUtilFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CommonUtil';
    }
}
<?php

namespace app\http\controllers;

use blink\core\Object;
use \app\models\UserWx;
class IndexController extends Object
{
    public function sayHello()
    {
        return 'Hello world, Blink.';
    }
    public function index()
    {
        //$database = app()->config('database');
       // print_r($database);
        $result = UserWx::first();
        print_r($result);
        echo '111111111111';
        return 'Hello world, testdddd.';
    }
}

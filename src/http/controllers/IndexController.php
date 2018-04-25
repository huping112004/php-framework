<?php

namespace app\http\controllers;

use blink\http\Request;
use blink\core\Object;
use \app\models\UserWx;

class IndexController
{

    public function sayHello()
    {
        return 'Hello world, Blink.';
    }

    public function index(Request $request)
    {
        $params = $request->all();
        print_r($params);
        //$database = app()->config('database');
        // print_r($database);
        $result = UserWx::first();
        print_r($result);
        echo '111111111111';
        return 'Hello world, testdddd.';
    }

    public function test($type,$id,Request $request)
    {
        echo $type;
        $params = $request->all();
        print_r($params);
        return 'Hello world, test.';
    }

}

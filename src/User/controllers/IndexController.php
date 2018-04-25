<?php

namespace app\User\controllers;

use blink\http\Request;
use blink\core\Object;
use \app\models\UserWx;
use \app\http\controllers\BaseController;
class IndexController
{
    protected $request = null;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware = ['app\middleware\Auth'];
        $request = request();
        $request->middleware([
            'class' => \app\middleware\Auth::class,
            'identity' => 'id',
        ]);

        $request->callMiddleware();

        //response()->middleware(\app\middleware\Auth::class, true);
       // request()->abort = true;
    }
    public function sayHello()
    {
        return 'user Hello world, Blink.';
    }

    public function index(Request $request)
    {
        $params = $request->all();
        print_r($params);
        //$database = app()->config('database');
        // print_r($database);
        //$result = UserWx::first();
        //print_r($result);
        echo '222';
        return 'Hello world, 2222222.';
    }

    public function test()
    {
        return 'Hello world, test.';
    }
}

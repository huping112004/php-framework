<?php

namespace app\middleware;


use blink\core\MiddlewareContract;


/**
 * BasicAccess middleware.
 *
 * @package Kerisy\Auth\Middleware
 */
class Auth implements MiddlewareContract {



    /**
     * The user identity name that used to authenticate.
     *
     * @var string
     */
    public $identity = 'id';

    /**
     *
     * @param Request $request
     */
    public function handle($controller) {
        $args = request()->all();
        $controller->showError('您的登录状态异常，请重新登录', 40011);
        request()->abort = true;
        return;

    }

}

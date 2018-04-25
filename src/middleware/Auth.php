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

    /**
     * @description cookie 校验
     * @return bool
     */
    public function cookieChannel() {
        $cookie = request()->cookie; //uid token sign
        $account = config('config')->get('account_web');
        if (!isset($cookie['uid']) || !$cookie['token'] || !$cookie['sign']) {
            return false;
        }
        $sign = strtoupper(md5($cookie['uid'] . $cookie['token'] . $account['secret_key']));

        if ($sign != $cookie['sign']) {
            return false;
        }
        //第二次校验
        $result = (new Client())->post($account['check_login_url'], $cookie);
        $sign = strtoupper(md5($result['uid'] . $result['token'] . $account['secret_key']));
        if ($sign != $cookie['sign']) {
            return false;
        }
        User::firstOrCreate(['id' => $result['uid']])->update(['username' => $result['nickname'], 'nickname' => $result['nickname']]);
        request()->set('uid', $result['uid']);
        return true;
    }

    /**
     * @param $args
     * @param $controller
     * @description token验证
     * @return bool
     */
    public function tokenChannel($args, $controller) {
        if ($controller->userId()) {
            return true;
        }
        if ($this->dealAuthorizable($args)) {
            return true;
        }
        return false;
    }

    public function dealAuthorizable($args) {
        $nickname = $this->getNickName($args);
        if ($nickname === false) {
            return false;
        }
        $avatar = $this->getAvatar($args);
//        if ($nickname === false) {
//            return false;
//        }
        $nickname = $nickname ?: 'pt' . mt_rand(100000, 999999);
        $key = $args['uid'] . $args['token'];
        //写入缓存
        session()->set(
                $key, ['uid' => $args['uid'], 'time' => time(), 'nickname' => $nickname, 'avatar' => $avatar]);
        User::firstOrCreate(['id' => $args['uid']])->update(
                [
                    'id' => $args['uid'],
                    'last_login' => time(),
                    'username' => $nickname,
                    'nickname' => $nickname,
                    'avatar' => $avatar
        ]);
        return true;
    }

}

<?php


namespace app\models;

use \blink\database\LaravelORM\DB;
use blink\database\LaravelORM\Model;


class UserWx extends Store
{
    protected $table = 'user_wx';
//    protected $primaryKey;
    protected $fillable = ['uid','openid','unionid','bind_time'];

}
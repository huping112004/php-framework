<?php

namespace blink\database\LaravelORM;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use blink\core\Object;


class DB extends Object
{
    public static $capsule = [];
    protected static $connection = 'default';


    public static function signton($default_connection = '')
    {
        $connection = $default_connection ?: static::$connection;

        if (!isset(self::$capsule[$connection])) {
            $config = config('database')->get($connection);
            print_r($config);
            $capsule = new PTCapsule();
            $capsule->addConnection($config, $connection);
            $capsule->setEventDispatcher(new Dispatcher(new Container));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            self::$capsule[$connection] = $capsule->connection($connection);
        }
        return self::$capsule[$connection];
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array([static::signton(), $method], $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        print_r($parameters);
        return call_user_func_array([static::signton(), $method], $parameters);
    }

    public static function table($table, $connection = null)
    {
        $connection = $connection ?: static::$connection;
        return static::signton($connection)->table($table);
    }

}
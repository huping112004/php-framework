<?php
/**
 * Kerisy Framework
 *
 * PHP Version 7
 *
 * @author          Jiaqing Zou <zoujiaqing@gmail.com>
 * @copyright      (c) 2015 putao.com, Inc.
 * @package         kerisy/framework
 * @subpackage      Database
 * @since           2015/11/11
 * @version         2.0.0
 */

namespace blink\database\LaravelORM;

use \Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $connection = 'default';

    public function __construct(array $attributes = [])
    {
        DB::signton($this->connection);
        parent::__construct($attributes);
    }
    public static function getLastSql()
    {
        DB::signton()->enableQueryLog(); // 开启查询日志

        $list = DB::signton()->getQueryLog();

        $a = end($list);
        $tmp = str_replace('?', '"'.'%s'.'"', $a["query"]);
        return vsprintf($tmp, $a['bindings']);
    }
    // 获取最后一条 sql
    public static function getALLSql()
    {
        DB::signton()->enableQueryLog(); // 开启查询日志
        $list = DB::signton()->getQueryLog();
        $strings = '';
        if ($list) {
            foreach ($list as $a) {
                $tmp = str_replace('?', '"'.'%s'.'"', $a["query"]);
                $strings = $strings."\n\r".vsprintf($tmp, $a['bindings']);
                echo $strings;
            }
            return $strings;
        }
    }
}

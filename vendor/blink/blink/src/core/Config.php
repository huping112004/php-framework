<?php

namespace blink\core;

class Config extends Set
{
    public function __construct($config_group)
    {
        $ext_name = '.php';
        echo '1111111111';
        $config_file = CONFIG_PATH . $config_group . $ext_name;
        /* 环境变量加载不同扩展名的配置文件 */
        $env_ext_name = (BLINK_ENV == 'development' ? '.dev' : (BLINK_ENV == 'test' ? '.test' : '')) . $ext_name;
        $env_config_file = CONFIG_PATH . $config_group . $env_ext_name;
        
        /* ENV配置文件不存在的情况下默认加载正式环境配置文件 */
        $config_file = file_exists($env_config_file) ? $env_config_file : $config_file;
        
        $this->data = require $config_file;
    }
}

<?php
return [
    'class' => '\blink\server\SwServer',
    'bootstrap' => __DIR__ . '/../bootstrap.php',
    'host' => '0.0.0.0',
    'port' => 7788,
    'numWorkers' => 4,
    'maxRequests' => 200,
    'name' => 'dev_blink',
    /*'taskWorkerNum' => 4,
    'taskRetryCount' => 3,
    'taskFailLog' => "/tmp/task_fail_log",
    'taskTimeout' => 1,
    */
];

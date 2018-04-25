<?php
return [
    ['GET', '/index', 'IndexController@sayHello'],
    ['GET', '/', 'IndexController@index'],
    ['GET', '/user/{type}/{id}', 'IndexController@test'],
    ['GET', '/user', '\app\User\controllers\IndexController@index']
];

/*
return [
    ['/api', [
        ['GET', '/index', 'IndexController@sayHello'],
        ['GET', '/', 'IndexController@index']
    ]]
];*/
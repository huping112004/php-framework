<?php

namespace blink\core;

use blink\core\Object;
use blink\core\Router;
use blink\http\Request;

/**
 * Class Dispatcher
 *
 * @package Kerisy\Core
 */
class Dispatcher extends Object
{
    protected $_router;

    public function init()
    {
        $this->_router = Router::getInstance();
    }

    public function getRouter()
    {
        return $this->_router;
    }

    public function dispatch( $request)
    {
        // TODO

        $route = $this->_router->routing($request);

        return $route;
    }
}

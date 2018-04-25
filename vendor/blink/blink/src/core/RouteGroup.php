<?php
namespace blink\core;

use blink\core\Object;

/**
 * Class RouteGroup
 *
 * @package Kerisy\Core
 */
class RouteGroup extends Object
{
    private $_prefix;
    private $_routes = [];

    public function setPrefix($prefix)
    {
        $this->_prefix = $prefix;
    }
    
    public function getPrefix()
    {
        return $this->_prefix;
    }

    /**
     * 类似下面这种形式的配置文件
    ['route' => '/', 'module'=> 'core', 'controller' => 'index', 'action' => 'index'],
    ['route' => 'user/<id:\d+>/', 'module'=> 'user', 'controller' => 'user', 'action' => 'show', 'params' => ['param1'=>'p1', 'param2'=>'p2']],
    ['route' => 'product/list', 'module'=> 'product', 'controller' => 'product', 'action' => 'index', 'params' => ['param1'=>'p1', 'param2'=>'p2']]
     */
    public function addRoute($config = [])
    {
        if (count($config) < 3)
        {
            throw new Exception("route config is not valid");
        }

        list($method, $pattern, $mca) = $config;

        $template = '/' . trim($pattern, '/') . '/';

        $routeObject = new Route();
        $routeObject->setPrefix($this->_prefix);
        $routeObject->setRoute($pattern);
        $routeObject->setPattern($pattern);
        $routeObject->setMethod($method);

        $tmp = explode('/', $mca);
        if (count($tmp) < 3)
        {
            throw new Exception("route mca is not valid");
        }

        $routeObject->setModule($tmp[0]);
        $routeObject->setController($tmp[1]);
        $routeObject->setAction($tmp[2]);

        if(preg_match_all('/<(\w+):?(.*?)?>/', $pattern, $matches))
        {
            $params = [];

            for ($i = 0; $i < count($matches[0]); $i++)
            {
                $params[$i] = $matches[1][$i];
                $reg = $matches[2][$i] ? $matches[2][$i] : '.*';
                $pattern = str_replace($matches[0][$i], "({$reg})", $pattern);
                $template = str_replace($matches[0][$i], "{{$matches[1][$i]}}", $template);
            }

            $pattern = str_replace('/', '\/', $pattern);

            $pattern = "/^{$pattern}$/";

            $routeObject->setPattern($pattern);
            $routeObject->setTemplate($template);
            $routeObject->setRegular(true);
            $routeObject->setParamKeys($params);
        }

        $this->_routes[$pattern] = $routeObject;
    }

    public function match($path = '/')
    {
        if (isset($this->_routes[$path])) {
            return $this->_routes[$path];
        }

        foreach ($this->_routes as $key => $route) {
            if (!$route->getRegular()) {
                continue;
            }

            if (preg_match($route->getPattern(), $path, $maches)) {
                $params = [];
                foreach ($route->getParamKeys() as $i => $key) {
                    $params[$key] = $maches[$i + 1];
                }
                $route->setParams($params);
                return $route;
            }
        }

        return false;
    }
}

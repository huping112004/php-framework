<?php


namespace blink\core;

/**
 * Class MiddlewareTrait
 *
 * @package blink\core
 */
trait MiddlewareTrait
{
    public $middleware = [];

    private $_middlewareCalled = false;

    /**
     * Add a new middleware to the middleware stack of the object.
     *
     * @param $definition
     * @param $prepend
     */
    public function middleware($definition, $prepend = false)
    {
        if ($this->_middlewareCalled) {
            throw new InvalidCallException('The middleware stack is already called, no middleware can be added');
        }

        if ($prepend) {
            array_unshift($this->middleware, $definition);
        } else {
            $this->middleware[] = $definition;
        }
        //print_r($this->middleware);
    }

    /**
     * Call the middleware stack.
     *
     * @throws InvalidConfigException
     */
    public function callMiddleware()
    {
        if ($this->_middlewareCalled) {
            return;
        }
        echo '888888888888';
        print_r($this->middleware);

        foreach ($this->middleware as $definition) {

            $middleware = make($definition);
            if (!$middleware instanceof MiddlewareContract) {
                throw new InvalidConfigException(sprintf("'%s' is not a valid middleware", get_class($middleware)));
            }
            print_r($this);
            if ($middleware->handle($this) === false) {
                break;
            }
        }

        $this->_middlewareCalled = true;
    }
}

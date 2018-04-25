<?php


namespace blink\http;

use blink\core\MiddlewareTrait;

class Controller
{
    private $_user_id;
    
    use MiddlewareTrait;

//    public function before()
//    {
//    
//    }
//    
//    public function after()
//    {
//    
//    }
    
    public function userId()
    {
        return $this->_user_id;
    }
    public function guestActions()
    {
        return [];
    }
}

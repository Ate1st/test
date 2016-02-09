<?php

class request implements IRequest
{
    private static $route;
    private static $params;
    
    public static function init($config)
    {
        $request = $_REQUEST; 
        if(isset($request['route']))
        {
            self::$route = explode('/', array_shift($request));
        }
        else
        {
            self::$route = [$config['default_controller'], $config['default_action']];
        }
            self::$params = $request;   
    }
    
    public static function get_route()
    {
        return self::$route;
    }
    
    public static function get_params()
    {
        return ['params' => self::$params];
    }
}
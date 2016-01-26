<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.07.2015
 * Time: 6:14
 */
class controller 
{
    
    private static $route;
    private static $params;

    public static function call($route, $params = null)
    {
        $start = microtime(true);
        
        self::$route = $route;
        self::$params = $params;
        
        if(!class_exists(self::$route[0].'_controller'))
        {
            self::$route[0] = config::get_config('app_config')['default_controller'].'_controller';
            messages::set_message('00', 'alert-danger');
        }
        else
        {
            self::$route[0] = self::$route[0] . '_controller';
        }
        
        if(!isset(self::$route[1]))        
        {
            self::$route[1] = config::get_config('app_config')['default_action'];  
        }
        if(method_exists(self::$route[0], self::$route[1]))
        {
            self::$route[1] = self::$route[1];
        }
        else
        {
            self::$route[1] = config::get_config('app_config')['default_action'];
            messages::set_message('01', 'alert-danger');
        }

        call_user_func_array(self::$route, self::$params);
        
        log::add(" controller_call  ->  \n", $start);
        
    }
    
}
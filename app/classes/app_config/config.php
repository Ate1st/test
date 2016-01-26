<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26.07.2015
 * Time: 21:21
 */
class config implements IConfig
{
	private static $cfg_path = null;
	private static $cfg = [];
	
	public static function set_config_path($config_path)
	{
		self::$cfg_path = $config_path;
	}
	
	
	public static function set_config($config_name, $value = null)
	{
	    if(file_exists(self::$cfg_path.'/'.$config_name.'.json'))
	    {
		      $config = file_get_contents(self::$cfg_path.'/'.$config_name.'.json');
		      $res = json_decode($config, true);
	    }
	    else 
	    {
	        $res = $value;
	    }
		self::$cfg[$config_name] = $res;
	}
	
	public static function get_config($config_name)
	{
	    if(!isset(self::$cfg[$config_name]))
	    {
	        return false;
	    }
	    return self::$cfg[$config_name];
	}
	
	public static function update_config($config_name, $config = [])
	{
		file_put_contents(self::$cfg_path.'/'.$config_name.'.json', json_encode($config));
		self::set_config($config_name);
	}
	
	public static function get_all()
	{
	    return self::$cfg;
	}
    
}
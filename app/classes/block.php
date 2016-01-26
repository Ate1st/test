<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of block
 *
 * @author vasilyevab
 */
class block 
{
    protected static $blocks = [];
    protected static $block_name = null;
    protected static $values = [];
    protected static $params = [];

    protected static function show()
    {
        
        
        if(self::$block_name == null)
        {
            //var_dump('++block++', self::$block_name);
            return null;
        }

        ob_start();
        //var_dump(self::$blocks[self::$block_name]['path'].self::$blocks[self::$block_name]['name']);
            if(file_exists(self::$blocks[self::$block_name]['path'].self::$blocks[self::$block_name]['name']))
            {
                require self::$blocks[self::$block_name]['path'].self::$blocks[self::$block_name]['name'];   
            }
            else 
            {
                echo 'not_found';
            }
            
        $res = ob_get_contents();
        
        ob_end_clean();
        
        //echo $res;
        
        return $res;
    }
    
    public static function getValues($name)
    {
        //var_dump(self::$values);
        
        return isset(self::$values[$name]) ? self::$values[$name] : FALSE;
    }
    
    public static function getParams()
    {
        $config_path = self::$blocks[self::$block_name]['path'].str_replace('.php', '_config.json', self::$block_name);
        
        $res = [];
        
        if(file_exists($config_path))
	{
            $config = file_get_contents($config_path);
            $res = json_decode($config, true);
	}
        
        self::$params = $res;   
    }
    
    public static function getParam($param)
    {            
        if(!isset(self::$params[$param]) && count(self::$params) == 0)
        {
            return null;
        }
        
        return self::$params[$param];
    }
    
}

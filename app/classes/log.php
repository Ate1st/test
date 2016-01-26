<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of log
 *
 * @author vasilyevab
 */
class log 
{
    private static $file_name;

    public static function create($file_name)
    {
        self::$file_name = $file_name;
    }
    
    public static function add($text, $start_time = 0)
    {
        $time = microtime(true) - $start_time;
        file_put_contents(self::$file_name, $time.' - '.$text, FILE_APPEND);    
    }
    
    public static function clear()
    {
        file_put_contents(self::$file_name, '');
    }
}

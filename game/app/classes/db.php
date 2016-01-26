<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.07.2015
 * Time: 19:48
 */
class db
{
    private static $pdo = null;
    private static $state = 0;

    public static function Connect($config)
    {
        $dsn = 'mysql:dbname='.$config['db_name'].';host='.$config['db_host'].';';

        self::$state = $config['connect'];
        //echo $dsn;

        if($config['connect'] === 1)
        {
            self::$pdo = new PDO($dsn, $config['db_user'], $config['db_password']);
            
        }
        else 
        {
            self::$pdo = false;
        }


    }

    public static function get_pdo()
    {
        if(self::$state === 1)
        {
            self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);  
            return self::$pdo;
        }
        
        return false;
    }

}
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getConfig()
{
    $config = [
        'app/helpers/',  
        'app/classes/',
        'app/classes/model/', 
        'app/classes/app_config/',
        'app/classes/request/',
        'app/classes/tcpdf/',
        'bin/controllers/',
        'bin/models/', 
        //'bin/models/player_model/',
        'bin/modules/auth/', 
        'bin/modules/upload/',
        'bin/bloks/messages/',
        'bin/bloks/test_reg_block/',
        'bin/bloks/test_auth_block/',
        'bin/bloks/phpexcel_block/'
        ];
    
    $result = [];
    
    foreach ($config as $val)
    {
        $classes = [];
        
        if($handle = opendir($val))
        {
            while (false !== ($entry = readdir($handle)))
            {
                if(is_file($val.$entry))
                {
                    array_push($classes, $entry);
                }
            }
        }
        $result[$val] = $classes;
    }
    
    //var_dump($result);
    
    return $result;
}

function _autoload($class_name) 
{
    $autoload_arr = getConfig();
     
    //echo '<pre>';
    
    //var_dump($autoload_arr);
    
    //echo '</pre>';
    
    foreach ($autoload_arr as $key => $value)
    {
        foreach ($value as $v)
        {
            $file = $key.$v;

            if( file_exists($file))
            {
                //echo $file.'---';
                include_once ($file);
            }
        }
        
    }
    
}

spl_autoload_register('_autoload');
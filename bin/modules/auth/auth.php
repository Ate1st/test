<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author vasilyevab
 */
class auth 
{
    private static $password = null;

    public static function issetParams($params = [], $keys = [])
    {
        //var_dump($params);
        //var_dump($keys);
        foreach ($keys as $val)
        {
            if(!isset($params[$val]) || empty($params[$val]))
            {
                return false;
            }
            
            if(trim(htmlspecialchars($val)) == '')
            {
                return false;
            }
        }
        
        return true;
    }
    
    public static function getAuth(IModel $player, $password)
    {
        if($player->exists())
        {
            if(password_verify(trim($password), $player->getPlayer()['password']))
            {
                $_SESSION['id'] = $player->getPlayer()['id'];
                $_SESSION['name'] = $player->getPlayer()['name'];
                $_SESSION['auth'] = 1;
                
                return true;
            }
            
            return false;
        }
        
        return false;
    }
}

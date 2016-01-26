<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of battle_controller
 *
 * @author vasilyevab
 */
class battle_controller extends controller
{
    public static function register()
    {
        session::start();
        
        
        session::close();
        render::get_main_tpl();             
        render::rend();
        
    }
    
    public static function standart()
    {
        echo '+++---battle---+++';
        
        render::get_main_tpl();             
        render::rend();
    }
    
    public static function pve()
    {
        echo '+++---battle---+++';
        
        render::get_main_tpl();             
        render::rend();
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main_controller
 *
 * @author vasilyevab
 */
class main_controller extends controller
{
    public static function index()
    {
        session::start();
        
        phpexcel_block_class::getBlock();
        
        render::get_main_tpl();             
        render::rend();
        
        session::close();
    }
    
    
}

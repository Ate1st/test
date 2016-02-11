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
        
        render::add_val('content', phpexcel_block_class::getBlock());
        
        render::get_main_tpl();             
        render::rend();
        
        session::close();
    }
    
    public static function get_pdf()
    {
        $path = $_POST['path'];
        
            header('Content-Type:application/pdf; charset=UTF-8', false);
            header('Content-Disposition:inline; filename = file.pdf', false );

        /* Проверяем наличие файла и выводим его содержимое в буфер как строку */
        $html = '';
        if (file_exists($path)) 
        { 
            
            // если файл существует
            $html = file_get_contents($path);
            
            if ($html != '') print $html;
            else echo 'НЕТ такого файла';
        exit();
}       
    }
    
    
}

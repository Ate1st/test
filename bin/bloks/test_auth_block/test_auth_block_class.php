<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test_auth_block_class
 *
 * @author vasilyevab
 */
class test_auth_block_class extends block
{
    public static function getBlock()
    {
        session::start();
        $block_path = __DIR__.'/block/';
        $block_name = str_replace('_class', '', __CLASS__).'.php';
        self::$block_name = $block_name;
        self::$blocks[$block_name] = ['name' => $block_name, 'path' => $block_path]; 
        
        return self::show();
    }
}

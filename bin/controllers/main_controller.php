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
        
        if(session::getVal('auth') !== 1)
        {
            render::add_val('content1', test_auth_block_class::getBlock());
        }
        else 
        {
            render::add_val('content1', player_block_class::getBlock());
        }
        //var_dump($_SESSION);
        
        render::get_main_tpl();             
        render::rend();
        
        session::close();
    }
    
    public static function registration()
    {
        session::start();
        
        render::add_val('content', test_reg_block_class::getBlock());
        
        render::get_main_tpl();             
        render::rend();
        
        session::close();
    }

    public static function reg()
    {
        response::setParams();
        $name = response::_POST('name');
        $password = response::_POST('password');
        
        if(!$name || !$password)
        {
            messages::set_message('13', 'alert-danger');
            self::call(['main', 'index'], ['params' => []]);
            die;
        }
        
        $player_map = new player_mapper(new query_builder(), config::get_config('pdo'), new player_model());
        $player = $player_map->getPlayerByName($name);

        if($player->exists())
        {
            messages::set_message('72', 'alert-danger');
            self::call(['main', 'registration'], ['params' => []]);
            die;
        }
        
        $player->set(['name' => $name, 'password' => password_hash(trim($password), PASSWORD_DEFAULT)]);

        var_dump($player);
        
        $player_map->setModel($player);
        $player_map->setQueryBuilder(new query_builder());
        
        $player_map->save();
        
        messages::set_message('73', 'alert-success');
        self::call(['main', 'index'], ['params' => []]);
    }
    
    public static function auth()
    {
        session::start();
        
        response::setParams();
        $name = response::_POST('name');
        $password = response::_POST('password');
        
        if(!$name || !$password)
        {
            messages::set_message('13', 'alert-danger');
            self::call(['main', 'index'], ['params' => []]);
            die;
        }
        
        $player_map = new player_mapper(new query_builder(), config::get_config('pdo'), new player_model());
        $player = $player_map->getPlayerByName($name);

        if(!auth::getAuth($player, $password))
        {
            messages::set_message('11', 'alert-danger');
            self::call(['main', 'index'], ['params' => []]);
            die;
        }
        
        $player_map->setQueryBuilder(new query_builder());
        $player->set(['status' => 2]);
        $player_map->setModel($player);
        $player_map->save();
        
        messages::set_message('70', 'alert-success');
        self::call(['main', 'index'], ['params' => []]);
        
        session::close();
    }
    
    public static function logout()
    {
        session::start();
        
        session::delVal('auth');
        
        $name = session::getVal('name');
        $player_map = new player_mapper(new query_builder(), config::get_config('pdo'), new player_model());
        $player = $player_map->getPlayerByName($name);
        
        $player->set(['status' => 1]);
        $player_map->setQueryBuilder(new query_builder());
        $player_map->setModel($player);
        $player_map->save();
        
        self::call(['main', 'index'], ['params' => []]);
        
        session::close();
    }
}

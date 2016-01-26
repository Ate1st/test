<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of player_block_class
 *
 * @author vasilyevab
 */
class player_block_class extends block
{
    public static function getBlock()
    {
        session::start();
        $block_path = __DIR__.'/block/';
        $block_name = str_replace('_class', '', __CLASS__).'.php';
        self::$block_name = $block_name;
        self::$blocks[$block_name] = ['name' => $block_name, 'path' => $block_path]; 
        
        $player_map = new player_mapper(new query_builder(), config::get_config('pdo'), new player_model);
        $player = $player_map->getPlayerByName(session::getVal('name'));
        
        //var_dump(session::getVal('name'));
        //var_dump($player);
        //var_dump($player->getPlayer()['stamina']);
        
        if($player->exists())
        {
            self::$values['avatar'] = $player->getPlayer()['avatar'];
            self::$values['name'] = $player->getPlayer()['name'];
            self::$values['level'] = $player->getPlayer()['level'];
            self::$values['mastery'] = $player->getPlayer()['mastery'];
            self::$values['health'] = $player->getPlayer()['health'];
            self::$values['stamina'] = $player->getPlayer()['stamina'];
            self::$values['mana'] = $player->getPlayer()['mana'];
            self::$values['level'] = $player->getPlayer()['level'];
        }
        
        
        
        return self::show();
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of player_mapper
 *
 * @author vasilyevab
 */
class player_mapper extends mapper
{
    private $select = ['players.id', 'players.name', 
        'players.password', 'players.mastery',
        'players.health', 'players.stamina', 
        'players.mana', 'players.level', 'players.status', 'players.date', 
        'players.time'];
    private $from = ['players'];


    public function getPlayerByName($name)
    {
        //var_dump($name);
        
        $this->get_query_builder()->select($this->select)->from($this->from)->
                                    where([['players.name = ' => ':name']]);
        
                               //var_dump($this->get_query_builder());
        
        return $this->prepare([':name' => $name])->get_one();
    }

    public function save()
    {
        $player = $this->model;
        
        $id = 0;

        if($player->exists())
        {
            $this->get_query_builder()->update('players')->set([['name =' => ':name'], 
                                                                ['password = ' => ':password'], 
                                                                ['mastery = ' => ':mastery'],
                                                                ['health =' => ':health'], 
                                                                ['stamina =' => ':stamina'], 
                                                                ['mana =' => ':mana'], 
                                                                ['level =' => ':level'],
                                                                ['status =' => ':status'], 
                                                                ['date =' => ':date'], 
                                                                ['time =' => ':time']])->where([['id =' => ':id']]);
            
            $this->set([':id' => $player->getPlayer()['id'],
                          ':name' => $player->getPlayer()['name'], 
                          ':password' => $player->getPlayer()['password'], 
                          ':mastery' => $player->getPlayer()['mastery'], 
                          ':health' => $player->getPlayer()['health'], 
                          ':stamina' => $player->getPlayer()['stamina'],
                          ':mana' => $player->getPlayer()['mana'],
                          ':level' => $player->getPlayer()['level'],
                          ':status' => $player->getPlayer()['status'],
                          ':date' => $player->getPlayer()['date'],
                          ':time' => $player->getPlayer()['time']]);
            
        }
        else
        {
            $this->get_query_builder()->insert('players', ['name', 'password', 'mastery', 'health', 'stamina', 'mana', 'level', 'status', 'date', 'time'])->
              values([':name', ':password', ':mastery', ':health', ':stamina', ':mana', 'level', 'status', ':date', ':time']);
        
        //var_dump($this->get_query_builder());
        
            $id = $this->set([':name' => $player->getPlayer()['name'], 
                          ':password' => $player->getPlayer()['password'], 
                          ':mastery' => $player->getPlayer()['mastery'], 
                          ':health' => $player->getPlayer()['health'], 
                          ':stamina' => $player->getPlayer()['stamina'],
                          ':mana' => $player->getPlayer()['mana'],
                          ':level' => $player->getPlayer()['level'],
                          ':status' => $player->getPlayer()['status'],
                          ':date' => $player->getPlayer()['date'],
                          ':time' => $player->getPlayer()['time']]);
        }
        
        var_dump($player->getPlayer());
        var_dump($this->get_query_builder());
        
        return $id;
    }
}

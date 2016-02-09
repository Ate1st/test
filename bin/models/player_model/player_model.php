<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of player_model
 *
 * @author vasilyevab
 */
class player_model extends model implements IModel 
{
    private $id = 0;
    private $name = 0;
    private $password = 0;
    private $mastery = 10;
    private $health = 100;
    private $stamina = 1000;
    private $mana = 10;
    private $avatar = 0;
    private $level = 1;
    private $status = 1;


    private $date = 0;
    private $time = 0;

    public function set($params)
    {
        
        $this->id = isset($params['id']) ? $params['id'] : $this->id;
        $this->name = isset($params['name']) ? $params['name'] : $this->name;
        $this->password = isset($params['password']) ? $params['password'] : $this->password;
        $this->avatar = isset($params['avatar']) ? $params['avatar'] : $this->avatar;
        $this->mastery = isset($params['mastery']) ? $params['mastery'] : $this->mastery;
        $this->health = isset($params['health']) ? $params['health'] : $this->health;
        $this->stamina = isset($params['stamina']) ? $params['stamina'] : $this->stamina;
        $this->mana = isset($params['mana']) ? $params['mana'] : $this->mana;
        $this->level = isset($params['level']) ? $params['level'] : $this->level;
        $this->status = isset($params['status']) ? $params['status'] : $this->status;
        
        $this->date = isset($params['date']) ? $params['date'] : $this->date;
        $this->time = isset($params['time']) ? $params['time'] : $this->time;
        
        return $this;
    }
    
    public function getPlayer()
    {
        return ['id' => $this->id, 
            'name' => $this->name, 
            'password' => $this->password, 
            'avatar' => $this->avatar, 
            'mastery' => $this->mastery, 
            'health' => $this->health, 
            'stamina' => $this->stamina, 
            'mana' => $this->mana, 
            'level' => $this->level,
            'status' => $this->status,
            'date' => $this->date, 
            'time' => $this->time];
    }
    
    public function exists()
    {
        if($this->id != 0)
        {
            return true;
        }
        
        return false;
    }
    
    public function isOnline()
    {
        if($this->status != 0)
        {
            return true;
        }
        
        return false;
    }
    
    public function get()
    {
        
    }
}

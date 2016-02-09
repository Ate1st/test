<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of npc_model
 *
 * @author vasilyevab
 */
class npc_model extends model implements IModel
{
    private $id = 0;
    private $name = 'mob';
    private $mastery = 10;
    private $health = 100;
    private $stamina = 1000;
    private $mana = 10;
    private $avatar = 0;
    private $level = 1;
    
    public function set($params)
    {
        $this->id = isset($params['id']) ? $params['id'] : $this->id;
        $this->name = isset($params['name']) ? $params['name'] : $this->name;
        $this->avatar = isset($params['avatar']) ? $params['avatar'] : $this->avatar;
        $this->mastery = isset($params['mastery']) ? $params['mastery'] : $this->mastery;
        $this->health = isset($params['health']) ? $params['health'] : $this->health;
        $this->stamina = isset($params['stamina']) ? $params['stamina'] : $this->stamina;
        $this->mana = isset($params['mana']) ? $params['mana'] : $this->mana;
        $this->level = isset($params['level']) ? $params['level'] : $this->level;
      
        return $this;
    }
    
    public function exists()
    {
        
    }
    
    public function get()
    {
        
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author vasilyevab
 */
interface IModel 
{
    public function set($params);
    
    public function exists();
}

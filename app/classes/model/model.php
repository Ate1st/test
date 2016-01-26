<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of n_model
 *
 * @author vasilyevab
 */
abstract class model 
{
    public static function create()
    {
        return new static();
    }
}

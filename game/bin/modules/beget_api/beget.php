<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of beget
 *
 * @author vasilyevab
 */
abstract class beget 
{
    protected static $api_address = 'https://api.beget.ru/api/';
    protected static $result_json = null;
    protected static $login = 'p95342uc';
    protected static $password = 'ryvBkW8I';

    protected static function getResult()
    {
        return json_decode(self::$result_json);
    }
    
}

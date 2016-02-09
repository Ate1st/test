<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26.07.2015
 * Time: 21:21
 */

//require_once 'autoload.php';

class app
{

    public static function init()
    {
        config::set_config_path('configs');
        config::set_config('db_config');
        config::set_config('app_config');

        db::Connect(config::get_config('db_config'));

        config::set_config('pdo', db::get_pdo());
        
        config::set_config_path(config::get_config('app_config')['default_tpl']);
        config::set_config('tpl_config');
        
        config::set_config('app_path', $_SERVER['DOCUMENT_ROOT']);
        config::set_config('bloks_new_path', config::get_config('app_path').'/bin/bloks');

    }

    public static function start()
    {
        request::init(config::get_config('app_config'));

        controller::call(request::get_route(), request::get_params());
    }


}
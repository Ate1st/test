<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22.07.2015
 * Time: 19:28
 */



function class_autoload($class_name) {
    $file = 'app/classes/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
    require_once ($file);
}
function controller_autoload($class_name) {
    $file = 'bin/controllers/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
    require_once ($file);
}
function model_autoload($class_name) {
    $file = 'app/classes/model/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
    require_once ($file);
}
function module_autoload($class_name) {
    $file = 'app/modules/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
    require_once ($file);
}

function configs_autoload($class_name) {
    $file = 'app/configs/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
    require_once ($file);
}

function app_config_autoload($class_name) {
    $file = 'app/classes/app_config/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
        require_once ($file);
}

function request_autoload($class_name) {
    $file = 'app/classes/request/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
        require_once ($file);
}

function new_autoload($class_name) {
    $file = 'app/classes/new/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
        require_once ($file);
}

function models_autoload($class_name) {
    $file = 'bin/models/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
    require_once ($file);
}

function user_model_autoload($class_name) {
    $file = 'bin/models/user_model/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
    require_once ($file);
}

function user_info_model_autoload($class_name) {
    $file = 'bin/models/user_info_model/'.$class_name.'.php';
    if( file_exists($file) == false )
        return false;
    require_once ($file);
}

spl_autoload_register('class_autoload');
spl_autoload_register('controller_autoload');
spl_autoload_register('model_autoload');
spl_autoload_register('module_autoload');
spl_autoload_register('configs_autoload');
spl_autoload_register('app_config_autoload');
spl_autoload_register('request_autoload');
spl_autoload_register('new_autoload');
spl_autoload_register('models_autoload');
spl_autoload_register('user_model_autoload');
spl_autoload_register('user_info_model_autoload');
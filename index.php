<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22.07.2015
 * Time: 17:13
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'app/classes/autoload/autoload.php'; 

log::create(__DIR__.'\log\log.txt');
log::clear();

$start = microtime(true);

app::init();

app::start();


$time = microtime(true) - $start;

echo $time;
//print_r($_REQUEST);

//print_r(config::get_all());

$time = microtime(true) - $start;

//echo '<br> time_index = '.$time;

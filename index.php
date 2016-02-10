<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22.07.2015
 * Time: 17:13
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);
//require_once '/app/classes/PHPExcel/IOFactory.php';
require_once 'app/classes/autoload/autoload.php'; 

app::init();

app::start();

<?php

interface IConfig
{
	public static function set_config_path($config_path);
	public static function set_config($config_name, $value = null);
	public static function get_config($config_name);
	public static function update_config($config_name, $config = []);
}
<?php

interface IRequest
{
    public static function  init($config);
    public static function  get_route();
    public static function  get_params();
}
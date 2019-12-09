<?php

use App\src\Flash;
use App\src\Redirect;

function dd($data)
{
    var_dump($data);
    die();
}

function path()
{
    return dirname(dirname(__DIR__));
}

function flash(string $index, string $message)
{
    Flash::add($index, $message);
}

function error(string $message)
{
    return "<span class='error'>* {$message} </span>";
}

function success(string $message)
{
    return "<span class='success'>{$message} </span>";
}

function redirect(string $target)
{
    Redirect::redirect($target);
    die();
}

function back()
{
    Redirect::back();
    die();
}

function assets(string $target)
{
    return "/assets/$target";  
}

function buscaSanitize()
{
    return filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);
}
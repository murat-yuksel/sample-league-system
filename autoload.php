<?php

session_start();

function load($class)
{
    $class = end(explode('\\',$class));
    $file = dirname(__FILE__).'/class/'.$class.'.php';

    if (file_exists($file)) {
        require $file;
        return true;
    }

    return false;
}


spl_autoload_register('load');
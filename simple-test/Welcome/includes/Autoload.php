<?php

spl_autoload_register('myAutoloader');

function myAutoloader($className)
{
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $fullPath = $className. '.php';

    require_once $fullPath;
}

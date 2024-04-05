<?php

spl_autoload_register('myAutoloader');

function myAutoloader($className) {
    $fullpaths = [
        'Config/' .$className. '.php',
        'Controller/' .$className. '.php',
        'Databaeses/' .$className. '.php'
    ];

    foreach ($fullpaths as $fullpath) {
        if (!file_exists($fullpath)) {
            return false;
        }

        require_once $fullpath;
    }
}

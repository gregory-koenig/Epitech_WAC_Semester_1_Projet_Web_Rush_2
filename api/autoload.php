<?php

spl_autoload_register('my_autoloader');

function my_autoloader($class)
{
    if (file_exists("./Router/$class.php")) {
        include_once "./Router/$class.php";
    } elseif (file_exists("./Controller/$class.php")) {
        include_once "./Controller/$class.php";
    } elseif (file_exists("./Model/$class.php")) {
        include_once "./Model/$class.php";
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 03/06/2018
 * Time: 21:30
 */

spl_autoload_register(function ($className)
{
    $fileName = "class". DIRECTORY_SEPARATOR .$className.".php";
    if(file_exists($fileName)){
        require_once($fileName);
    }
});



?>
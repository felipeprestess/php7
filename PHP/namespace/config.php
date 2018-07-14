<?php

spl_autoload_register(function ($nameClass)
{
    $dirClass = "class";//nome da pasta onde se encontra a classe
    //monta o diretório
    $filename = $dirClass . DIRECTORY_SEPARATOR . $nameClass . ".php";

    //verifica se o arquivo existe naquele diretório
    if(file_exists($filename)){
        require_once($filename);
    }
});

?>
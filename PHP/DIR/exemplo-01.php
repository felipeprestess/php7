<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 31/05/2018
 * Time: 20:43
 */

$name = "images";

if(!is_dir($name)){
    mkdir($name);
    echo "Diretório $name criado com sucesso!";
}else{
    rmdir($name);
    echo "Diretório já existe: $name foi removido";
}
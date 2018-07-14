<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 01/06/2018
 * Time: 20:18
 */


$file = fopen("teste.txt","w+");

fclose($file);

unlink("teste.txt");

echo "Arquivo removido com sucesso";
?>
<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 01/06/2018
 * Time: 19:51
 */

$file = fopen("log.txt","w+");

fwrite($file, date("Y-m-d H:i:s"));

fclose($file);

echo "Arquivo criado com sucesso!";
?>
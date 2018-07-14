<?php
function __autoload($nomeClasse){
    require_once("$nomeClasse.php");
    //var_dump($nomeClasse);
    //var_dump($nomeClasse);
}
//require_once("DelRey.php");
$carro = new DelRey();
$carro->Acelerar(80);
?>
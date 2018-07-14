<?php

class Pessoa 
{
    public $nome;


    public function falar(){
        return "O meu nome é: " . $this->nome;
    }
}

$felipe = new Pessoa();
$felipe->nome = "Felipe Prestes";
echo $felipe->falar();

?>
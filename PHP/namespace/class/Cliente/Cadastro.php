<?php
//Utiliza a classe da pasta Cliente
namespace Cliente;

class Cadastro extends \Cadastro
{
    public function registrarVenda()
    {
        echo "Foi registrado uma venda para o cliente: ".$this->getNome();
    }
}

?>
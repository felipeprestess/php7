<?php
abstract class Automovel implements Veiculo
{
    public function Frenar($velocidade){
        echo "O veículo frenou até ". $velocidade . "km/h<br/>";
    }
    public function Acelerar($velocidade){
        echo "O veículo acelerou até ". $velocidade . "km/h<br/>";
    }
    public function TrocarMarcha($marcha){
        echo "O veículo engatou a marcha ". $marcha . "<br/>";
    }
}

interface Veiculo
{
    public function Frenar($velocidade);
    public function Acelerar($velocidade);
    public function TrocarMarcha($marcha);
}

class DelRey extends Automovel
{
    public function empurrar(){

    }
}

$carro = new DelRey();
$carro->TrocarMarcha(1);
$carro->Acelerar(20);
$carro->TrocarMarcha(2);
$carro->Acelerar(50);
$carro->TrocarMarcha(3);
$carro->Acelerar(70);
$carro->TrocarMarcha(4);
$carro->Acelerar(80);
$carro->TrocarMarcha(5);
$carro->Frenar(25);

?>
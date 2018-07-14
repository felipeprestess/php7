<?php
interface Veiculo
{
    public function Frenar($velocidade);
    public function Acelerar($velocidade);
    public function TrocarMarcha($marcha);
}

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

?>
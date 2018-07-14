<?PHP

$a = 10;

function trocaValor(&$a){//Passagem de parâmetro por referência com o &
    
    $a += 50;

    return $a; 
}


echo trocaValor($a);
echo "<br>";
echo $a;

?>
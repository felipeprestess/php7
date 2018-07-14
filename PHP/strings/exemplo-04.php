<?PHP

$frase = "A repetição é mãe da retenção.";
//Encontra a posição da palavra
$q = strpos($frase, "mãe");

$palavra = "mãe";

$texto = substr($frase,0, $q);

echo $texto;


echo "<br>";

$texto2 = substr($frase, $q + strlen($palavra), strlen($frase));

echo $texto2;

?>
<?PHP

$nome = "felipe prestes";

//A palavra em maiúscula
echo strtoupper($nome);

echo "<br>";

echo $nome;

//A palavra em minúscula
$nome = strtolower($nome);

echo "<br>";

//Apenas a primeira letra maiúscula
echo ucfirst($nome);

echo "<br>";

//Todas as iniciais maiúsculas
echo ucwords($nome);
?>
<?PHP

$nome = (int)$_GET["a"];
$nome2 = $_GET["b"];
// var_dump($nome);
// echo '<br>';
// var_dump($nome2);


//$ip = $_SERVER["REMOTE_ADDR"];
$ip = $_SERVER["SCRIPT_NAME"];
echo $ip;
?>
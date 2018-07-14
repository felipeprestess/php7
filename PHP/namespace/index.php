<?PHP

require_once("config.php");

use Cliente\Cadastro;

$cad = new Cadastro();

$cad->setNome("Felipe Prestes");
$cad->setEmail("felipe.adriano1@gmail.com");
$cad->setSenha("123456");

$cad->registrarVenda();
?>
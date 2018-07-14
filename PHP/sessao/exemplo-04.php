<?PHP

require_once("config.php");

echo session_regenerate_id();

echo session_id();

var_dump($_SESSION);

?>
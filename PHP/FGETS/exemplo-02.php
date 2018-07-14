<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 01/06/2018
 * Time: 22:34
 */

$filename = "logo.png";
//retorna um binario, depois utiliza o base64_encode pra retornar base64
$base64 = base64_encode(file_get_contents($filename));

//Intancia o objeto com o tipo de imagem
$fileinfo = new finfo(FILEINFO_MIME_TYPE);

$mimetype = $fileinfo->file($filename);

$base64encode = "data:".$mimetype. ";base64,".$base64;

?>

<a href="<?=$base64encode ?>" target="_blank">Link para imagem</a>
<img src="<?=$base64encode ?>">
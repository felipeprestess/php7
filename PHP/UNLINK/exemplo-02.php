<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 01/06/2018
 * Time: 20:21
 */

if(!is_dir("images")) mkdir("images");

foreach (scandir("images") as $item){

    if(!in_array($item, array(".",".."))){
        unlink("images". DIRECTORY_SEPARATOR. $item);
    }

}
echo "arquivos apagados com sucesso!";

?>
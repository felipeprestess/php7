<form method="post" enctype="multipart/form-data">

    <input type="file" name="fileUpload"/>

    <input type="submit" value="Fazer upload"/>
</form>

<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 01/06/2018
 * Time: 22:48
 */

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $file = $_FILES["fileUpload"];

    if($file["error"]){
        throw new Exception("Error: ".$file["error"]);
    }

    $dirUpload = "uploads";

    if(!is_dir($dirUpload)){

        mkdir($dirUpload);

    }
}

?>



<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 31/05/2018
 * Time: 20:56
 */

$images = scandir("images");

$data = array();

foreach ($images as $img)
{
    if(!in_array($img,array(".",".."))){
        $filename = "images" . DIRECTORY_SEPARATOR .$img;

        $info = pathinfo($filename);
        $info["size"] = filesize($filename);
        $info["modified"] = date("d/m/Y H:i:s", filemtime($filename));
        $info["url"] = "http://localhost/DIR/".str_replace("\\","/",$filename);

        array_push($data, $info);

    }
}

echo json_encode($data);
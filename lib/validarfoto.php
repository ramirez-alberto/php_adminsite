<?php

function validarFoto($nombre)
{

    #global $extImg;
    global $dirImg;

    $imagen = $_FILES['imagen'];

    $extImg = preg_replace('/image\//', '', $imagen['type']);
    $tempImg = $imagen['tmp_name'];

    $nombre = strtolower($nombre);
    $dirImg = "fotos/$nombre/";

    if ($extImg == 'jpeg' || $extImg == 'gif' || $extImg == 'png') {
        if (!file_exists($dirImg)) {
            mkdir($dirImg, 0777);
        }
        if (move_uploaded_file($tempImg, "{$dirImg}profile.jpg")) {
            return true;
        } else {
            return false;
        }
    } else {

        trigger_error("Error de formato.", E_USER_WARNING);
        exit();
    }
}

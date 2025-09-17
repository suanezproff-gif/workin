<?php
$carpeta = //provisional

//se ha recibido el formulario?
if ($_SERVER[REQUEST_METHOD] == "POST"){
    $usuario = htmlspecialchars($_POST['Usuario']);
    $email = htmlspecialchars($_POST['email']);
    $sinArchivo = isset($_POST['sinArchivo']) ;//checkbox
    $archivoSubido = isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK;

}
//si no hay archivo subido y no se ha marcado la casilla de sin archivo, error
if (!$archivoSubido && !$sinArchivo) {
    echo "Es necesario subir un archivo o marcar la casilla para continuar"
    exit;

}
//si no se ha introducido usuario o email, error
if (!$usuario || !$email) {
    echo "Se requiere llenar los campos con los datos indicados";
    exit;  

}
$NombreArchivo
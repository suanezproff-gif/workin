<?php



$carpeta = "./uploads";
$carpeta1 = "./resources";
//si no existen las carpetas, crearlas
if (!is_dir($carpeta)) { 
    mkdir($carpeta, 0754, true);
}
if (!is_dir($carpeta1)) {
    mkdir($carpeta1, 0754, true);
}
//se ha recibido el formulario?
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = htmlspecialchars($_POST['Usuario']);
    $email = htmlspecialchars($_POST['email']);
    $sinArchivo = isset($_POST['sin-archivo']); // checkbox
    $archivoSubido = isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK;
    $fotousuario = "https://airbox.pro/firmas/" . $usuario . ".jpg";
}
//validar los campos requeridos
if (!$usuario || !$email) {
    echo "Porfavor introduzca correctamente los campos obligatorios.";
    exit;
}
//validar archivo o checkbox
if (!$archivoSubido && !$sinArchivo) {
    echo "Porfavor, suba un archivo o marque la casilla de verificación.";
    exit;
}
//si se ha subido un archivo procesarlo
$nombreImagen = "";
if ($archivoSubido) {
    $nombreOriginal = basename($_FILES["archivo"]["name"]);
    $nombreImagen = "img_" . $usuario . ".jpg";
    $rutaDestino = $carpeta . $nombreImagen;
    if (!move_uploaded_file($_FILES["archivo"]["tmp_name"], $rutaDestino)) {
        echo "Error al subir el archivo.";
        exit;
    }
}

// Comprobar si la imagen existe realmente
$fotoExiste = @getimagesize($fotousuario);

$firmaHtml = '';
if ($fotoExiste) {
    $firmaHtml = '<a href="mailto:' . htmlspecialchars($email) . '">';
    $firmaHtml .= '<img src="' . htmlspecialchars($fotousuario) . '" alt="Foto de ' . htmlspecialchars($usuario) . '" style="width:700px; height:160px; object-fit:cover;">';
    $firmaHtml .= '</a>';
} else {
    $firmaHtml = '<a href="mailto:' . htmlspecialchars($email) . '">';
    $firmaHtml .= '<img src="' . $carpeta1 . '/imagenerr.jpg" alt="enviar email a ' . htmlspecialchars($usuario) . '" style="width:700px; height:160px; object-fit:cover;">';
    $firmaHtml .= '</a>';
    $firmaHtml .= '<div>Información usuario:<ul>';
    $firmaHtml .= '<li>Usuario: <a href="mailto:' . htmlspecialchars($email) . '">' . htmlspecialchars($usuario) . '</a></li>';
    $firmaHtml .= '<li>Email: <a href="mailto:' . htmlspecialchars($email) . '">' . htmlspecialchars($email) . '</a></li>';
    $firmaHtml .= '</ul></div>';
}

$html = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
@page Section1 { size: 595.3pt 841.9pt; margin: 70.85pt 3cm 70.85pt 3cm; }
body, p { font-family: "Montserrat", Arial, Helvetica, sans-serif; font-size: 10pt; margin: 0; }
small, .legal { font-family: Arial, Helvetica, sans-serif; font-size: 7.5pt; }
</style>
</head>
<body>
<p class="legal" style="color:#33aa33">
Si recibes este correo fuera de tu horario laboral, no espero respuesta hasta tu vuelta.
</p>
<!-- Firma usuario -->
<div>
$firmaHtml
</div>
<p class="legal" style="color:#33aa33">
Piensa en el medio ambiente, imprime este e-mail s&oacute;lo si es necesario.
</p>
<hr>
<p class="legal" style="color:#999">
La informaci&oacute;n de este e mail es confidencial, personal e intransferible y s&oacute;lo est&aacute; dirigida a la(s) direcci&oacute;n(es) indicada(s) arriba. Si recibi&oacute; este mensaje por equivocaci&oacute;n, le informamos que est&aacute; prohibida su divulgaci&oacute;n, uso o distribuci&oacute;n, completos o parciales; 
rogamos lo notifique al remitente y elimine el mensaje original junto con sus ficheros anexos sin leerlo ni grabarlo. Gracias. Para m&aacute;s informaci&oacute;n puede consultar nuestra Pol&iacute;tica de Privacidad y LOPD.
</p>
<p class="legal" style="color:#999"> Finalidades basadas en el inter&eacute;s leg&iacute;timo de AIRBOX S.A, para atender mejor a sus expectativas y aumentar su grado de satisfacci&oacute;n como cliente, as&iacute; como para realizar estudios estad&iacute;sticos o de
 mercado que puedan ser de inter&eacute;s y utilidad. Para ello nos es preciso utilizar informaci&oacute;n sobre el uso de los productos, servicios y canales, siempre desagregando sus datos personales, de forma
que no se le pueda identificar. As&iacute;, de forma enunciativa pero no exclusiva, podemos elaborar perfiles para el env&iacute;o de informaci&oacute;n comercial. Desarrollar acciones comerciales y ofrecerle o
recomendarle productos y servicios que puedan resultar de su inter&eacute;s, teniendo en cuenta los que haya contratado en el pasado. La recomendaci&oacute;n de productos podr&aacute; basarse en un perfilado
que, en algunos casos, se llevar&aacute; a cabo utilizando medios basados &uacute;nicamente en el tratamiento automatizado de sus datos. Los env&iacute;os de comunicaciones comerciales podr&aacute;n realizarse tanto a
trav&eacute;s de medios ordinarios como electr&oacute;nicos. En cualquier momento puede ejercer su derecho de oposici&oacute;n a estos tratamientos basados en nuestro inter&eacute;s leg&iacute;timo.</p>
<a href="https://airbox.pro/politica-de-Privacidad/">Pol&iacute;tica de Privacidad y LOPD</a>
</body>
</html>
HTML;

//guardar el html en un archivo
$nombreArchivoHTML = "firma_" . $usuario . ".html";
$rutaHTML = $carpeta . "/" . $nombreArchivoHTML;

if (file_put_contents($rutaHTML, $html)) {
    echo "Archivo HTML generado correctamente:</br>";
    echo "<a href='uploads/$nombreArchivoHTML' target='_blank'>Ver archivo HTML</a>";
} else {
    echo "Error al guardar el archivo HTML.";
 } 

?>


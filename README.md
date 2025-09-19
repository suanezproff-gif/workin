# Generador firmas HTML (PHP)
este proyecto es un script en **PHP** que procesa un formulario web para generar automaticamente una firma de correo electronico en formato HTML.


## FUNCIONALIDAD


1 **Creación de carpetas necesarias**
   -Se crean las carpetas `./uploads` y `./resources` con permisos (`0754`) si no existen.

2. **Procesamiento del formulario**
   -Recoge todos los datos enviados por 'POST':
     -`Usuario` (Nombre de usuario).
     -`email` (correo electrónico).
     -`archivo` (imagen opcional subida por el usuario).
     -`sin-archivo` (checkbox para indicar que no se subira archivo).
    
3. **Validaciones**
   - verifica que los campos (`Usuario` y `Email`) no estén vacios.
   - comprueba si hay un archivo **o** se haya marcado la casilla sin archivo.
   - Si se sube un archivo:
     - se le assigna el nombre `img_` + `Usuario` + `.jpg`.
     - se guarda en la carpeta `./uploads`.
   - Si no se sube ningún archivo
     - Tiene que ser 'true' el estado de la checkbox.
     - Seguirá el procedimiento con normalidad.

4. **Firma HTML generada**
   - Si existe una foto de usuario en la url `https://airbox.pro/firmas/USUARIO.jpg`, se muestra esa imagen.
   - Si no existe, se muestra una imagen de error (`./formulario/imagenerr.jpg`) junto con información bàsica del usuario.
   - Se puede enviar un e-mail al 'dueño' de la firma haciendo clic en la imàgen (independiente mente que sea `USUARIO.jpg` o `imagenerr.jpg`
   - la firma incluye textos legales y un aviso medioambiental.
     
5. **Salida Final**
   - Se genera un archivo HTML con el nombre:
     ```
     firma_[Usuario].html
     ```
     - El archivo se guarda en `./uploads` y se muestra un enlace para abrirlo en el navegador.


   ---
## Requisitos
- Servidor web con **PHP 7.4+** o superior.
- Permisos de escritura en el directorio del proyecto (para crear carpetas y guardar archivos).
- Carpeta `resources` con la imagen de error `imagenerr.jpg`.

  ---
  ## Estructura del proyecto
  .
├── resources/
│ └── imagenerr.jpg # Imagen usada si no existe la foto del usuario
├── uploads/ # Carpeta donde se guardan imágenes y firmas generadas
└── index.html # Script principal (frontend)
└── backend.php # Script que implementa la logica al formulario (backend)

   


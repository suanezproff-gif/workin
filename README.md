# Generador firmas HTML (PHP)
este proyecto es un script en **PHP** que procesa un formulario web para generar automaticamente una firma de correo electronico en formato HTML.


## FUNCIONALIDAD


1 **Creación de carpetas necesarias**
   -Crea las carpetas './uploads' y './resources' (perms '0754') si no existen.

2. **Procesamiento del formulario**
   -Recoge todos los datos enviados por 'POST':
     -'Usuario' (Nombre de usuario).
     -'email' (correo electrónico).
     -'archivo' (imagen opcional subida por el usuario).
     -'sin-archivo' (checkbox para indicar que no se subira archivo).
    
3. **Validaciones**
   - verifica que los campos ('Usuario' y 'Email') no estén vacios.
   - comprueba si hay un archivo **o** se haya marcado la casilla sin archivo.
   - Si se sube un archivo:
     - se le assigna el nombre 'img_' ('Usuario') '.jpg'.
     - se guarda en la carpeta './uploads'.
   - Si no se sube ningún archivo
     - Tiene que ser 'true' el estado de la checkbox.
     - Seguirá el procedimiento con normalidad.

4. **Firma HTML generada**
   


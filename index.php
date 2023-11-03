<!DOCTYPE html>
<!--
Autor: Karmel Idarraga Ariño
Asignatura: DAW - Desarrollo Web en Entorno Servidor
Unidad: UD2
Tarea: TE01: Página de Gestión de Biblioteca
Fecha: 20/10/2023

Descripcion:
Debes programar en PHP la parte del backend de una aplicación de registro de datos de una biblioteca. Para ello, supondremos que el usuario quiere alquilar un libro y para ello tiene que rellenar un formulario con una serie de campos. 

Si los datos están correctos, el sistema mostrará el nombre completo del usuario, el DNI y la fecha de devolución del libro
Si los datos NO son correctos, el sistema le comunicará al usuario únicamente los campos del formulario que son incorrectos.

-->
<html lang="es">
     <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Solicitud de Prestamo Mungiako Liburutegia</title>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
          <link href="https://www.mungia.eus/documents/39611/6cd7e1cd-6d5f-5821-c127-9b80bfaf997c" rel="icon">
     </head>
     <body>
<?php
     include 'main/controller/libFunc.php';
     if (!empty($_POST['apellidos']) && !empty($_POST['nombre'])&& !empty($_POST['libro']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['dni']) && validate_dni($_POST['dni']) 
     && !empty($_POST['fecha']) && (strtotime($_POST['fecha']) >= strtotime('today')) && (comprobar_libro($_POST['libro'],$_POST['fecha'],$datos) < strtotime($_POST['fecha'])))  {
          include 'main/view/correctView.php';
     }
     else {
          include 'main/view/formView.php';
     }
?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
     </body>
</html>
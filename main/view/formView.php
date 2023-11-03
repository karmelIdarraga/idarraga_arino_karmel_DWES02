<?php   
    $nombrereal="";
    if (!empty($_POST['nombre'])) {
        $nombrereal= $_POST['nombre'];
    }
    $apellidosreal="";
    if (!empty($_POST['apellidos'])) {
        $apellidosreal= $_POST['apellidos'];
    } 
    $libroSelected="";
    if (!empty($_POST['libro'])) {
        $libroSelected= $_POST['libro'];
    }
    $emailreal="";
    if (!empty($_POST['email'])) {
        $emailreal= $_POST['email'];
    } 
    $fechareal="";
    if (!empty($_POST['fecha'])) {
        $fechareal= $_POST['fecha'];
    } 
    $dnireal="";
    if (!empty($_POST['dni'])) {
        $dnireal= $_POST['dni'];
    } 
?>
<main class="container-sm mt-4">
     <h1>Solicitud de préstamos de libro</h1>
    <form name="input" class="col bg-primary-subtle p-3 rounded border" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <span for="nombre" class="form-label">Nombre</span>
          <input type="text" name="nombre" class="form-control" value="<?php echo $nombrereal;?>" />
          <?php
               if (isset($_POST['enviar']) && empty($_POST['nombre']))
                    echo "<span style='color:red'>  Debe introducir un nombre!!</span>"
          ?><br />
          <span for="apellidos" class="form-label">Apellidos</span>
          <input type="text" name="apellidos" class="form-control" value="<?php echo $apellidosreal;?>" />
          <?php
               if (isset($_POST['enviar']) && empty($_POST['apellidos']))
                    echo "<span style='color:red'>  Debe introducir al menos un apellido!!</span>"
          ?><br />
          <span for="libro" class="form-label">Libro</span>
          <select name="libro" id="libro" class="form-select">
               <option value="">Selecciona un libro</option>
               <?php
                    foreach ($datos[0]['libros'] as $libro) {
                         if ($libroSelected!="" && $libroSelected==$libro['ID_Libro']){
                              print "<option value='".$libro['ID_Libro']."' selected>".$libro['Nombre_Libro']."</option>";
                         }else{
                              print "<option value='".$libro['ID_Libro']."'>".$libro['Nombre_Libro']."</option>";
                         }
                         
                    }
               ?>
          </select>
          <?php
               if (isset($_POST['enviar']) && empty($_POST['libro']))
                    echo "<span style='color:red'>  Debe seleccionar un libro!!</span>"
          ?><br />
          <span for="emails" class="form-label">Email</span>
          <input type="text" name="email" class="form-control" value="<?php echo $emailreal;?>" />
          <?php
               if (isset($_POST['enviar']) && (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
                    echo "<span style='color:red'>  Debe introducir un email válido!!</span>";
               }                   
          ?><br />
          <span for="fecha" class="form-label">Fecha de Alquiler</span><br />
          <input type="date" name="fecha" value="<?php echo $fechareal;?>" />
          <?php
               if (isset($_POST['enviar']) && empty($_POST['fecha'])){
                    echo "<span style='color:red'>  Debe introducir una fecha de alquiler!!</span>";
               }
               if (isset($_POST['enviar']) && !empty($_POST['fecha']) && !(strtotime($_POST['fecha']) >= strtotime('today'))){
                    echo "<span style='color:red'>  Debe introducir una posterior a la fecha actual!!</span>";
               }
               if (isset($_POST['enviar']) && !empty($_POST['fecha']) && (strtotime($_POST['fecha']) >= strtotime('today')) 
               && (strtotime($_POST['fecha']) < comprobar_libro($_POST['libro'],$_POST['fecha'],$datos))){
                    echo "<span style='color:red'>  Lo sentimo, pero el libro seleccionado no está disponible hasta el ".date('d/m/y',comprobar_libro($_POST['libro'],$_POST['fecha'],$datos))."!!</span>";
               }    
          ?><br />
          <span for="dni" class="form-label">DNI</span>
          <input type="text" name="dni" class="form-control" value="<?php echo $dnireal;?>" />
          <?php
               if (isset($_POST['enviar']) && empty($_POST['dni'])){
                    echo "<span style='color:red'>  Debe introducir un DNI!!</span>";
               } else if (isset($_POST['enviar']) && !empty($_POST['dni']) && !validate_dni($_POST['dni'])){
                    echo "<span style='color:red'>  El DNI es erroneo, la letra debería de ser la <strong>".calcular_letra_DNI($_POST['dni'])."</strong></span>";
               }
                    
          ?><br />

          <input type="submit" value="Enviar" name="enviar" class="btn btn-secondary"/>
     </form>
</main>
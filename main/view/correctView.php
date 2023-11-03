<?php
      $nombre = $_POST['nombre'];
      $apellidos = $_POST['apellidos'];
      $fecha_solicitud = strtotime( $_POST['fecha']);
      $fecha = strtotime("+10 days", $fecha_solicitud);
      $dni = $_POST['dni'];
/*       print "Nombre completo: ".$nombre." ".$apellidos."<br />";
      print "DNI: ".$dni."<br />";
      print "Fecha de solicitud: ".date('d/m/y',$fecha_solicitud)."<br />";
      print "Fecha de devolución: ".date('d/m/y',$fecha); */
?>
<main class="container-sm mt-4">
      <h1>Prestamo de libro confirmado</h1>
      <div class="col bg-success-subtle p-3 rounded border">
            <span for="nombre" class="form-label">Nombre completo</span>
            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre." ".$apellidos;?>" disabled/>
            <span for="dni" class="form-label">DNI</span>
            <input type="text" name="dni" class="form-control" value="<?php echo $dni;?>" disabled/>
            <span for="fec_soli" class="form-label">Fecha de solicitud confirmada:</span>
            <input type="text" name="fec_soli" class="form-control" value="<?php echo date('d/m/y',$fecha_solicitud);?>" disabled/>
            <span for="fec_devo" class="form-label">Fecha de devolución estipulada:</span>
            <input type="text" name="fec_devo" class="form-control" value="<?php echo date('d/m/y',$fecha);?>" disabled/>
      </div>
</main>
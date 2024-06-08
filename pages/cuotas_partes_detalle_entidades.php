<?php
require_once "modelo/cuotas_partes.php";
require_once "controlador/cuotas_partes.php";
if (isset($_GET['i']) && "" != $_GET['i']) {
  $id = $_GET['i'];

  if (1 == $_SESSION['rol'] or 1 == $_SESSION['snr_tipo_oficina']) {
?>

    <div class="row">
      <div class="col-md-4">
        <?php
        $detalleEntidad = new cuotasPartesControlador();
        $detalleEntidad->detalleEntidadControlador($id);
        ?>
      </div>
      <div class="col-md-8">
        <?php
        $causantes = new cuotasPartesControlador();
        $causantes->causantesControlador($id);
        ?>
      </div>
    </div>

    <script src="js/cuotas_partes.js"></script>
<?php

  }
}
?>
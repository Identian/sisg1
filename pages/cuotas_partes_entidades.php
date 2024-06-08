<?php
require_once "modelo/cuotas_partes.php";
require_once "controlador/cuotas_partes.php";

if (1 == $_SESSION['rol'] or 1 == $_SESSION['snr_tipo_oficina']) {
?>

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo existencia('cuotas_partes_entidades'); ?></h3>

          <p>Entidades</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo existencia('cuotas_partes_datos_causante'); ?></h3>

          <p>Causantes</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo existencia('cuotas_partes_sustitucion'); ?></h3>

          <p>Sustitutos</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">


          <h3><?php echo existencia('cuotas_partes_pagos_entidades'); ?></h3>

          <p>Cuentas de Cobro</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>Directorio de Entidades </strong></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">

          <?php
          $tablaEntidades = new cuotasPartesControlador();
          $tablaEntidades->tablaEntidadesControlador();
          ?>

        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <script type="text/javascript" language="javascript" src="js/cuotas_partes.js"></script>

<?php
}

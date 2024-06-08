<?php
require_once "modelo/cuotas_partes.php";
require_once "controlador/cuotas_partes.php";
if (isset($_GET['i']) && "" != $_GET['i']) {
  $id = $_GET['i'];

  if ((isset($_POST["periodo_fecha_inicio"])) && ($_POST["periodo_fecha_inicio"] != "") and (isset($_POST["insertperiodo"])) && ($_POST["insertperiodo"] != "")) {

    $fechaInicio = $_POST["periodo_fecha_inicio"];
    $fechaFinal = $_POST["periodo_fecha_final"];
    $fechaEnteraI = strtotime($fechaInicio);
    $fechaEnteraF = strtotime($fechaFinal);
    $mesI = date("m", $fechaEnteraI);
    $mesF = date("m", $fechaEnteraF);

    if ($mesI == $mesF) {
      switch ($mesI) {
        case "01":
          $fechaletra = "ENERO";
          $referencia = 1;
          $estado_vista = 1;
          break;
        case "02":
          $fechaletra = "FEBRERO";
          $referencia = 1;
          $estado_vista = 0;
          break;
        case "03":
          $fechaletra = "MARZO";
          $referencia = 1;
          $estado_vista = 0;
          break;
        case "04":
          $fechaletra = "ABRIL";
          $referencia = 2;
          $estado_vista = 1;
          break;
        case "05":
          $fechaletra = "MAYO";
          $referencia = 2;
          $estado_vista = 0;
          break;
        case "06":
          $fechaletra = "JUNIO";
          $referencia = 2;
          $estado_vista = 0;
          break;
        case "07":
          $fechaletra = "JULIO";
          $referencia = 3;
          $estado_vista = 1;
          break;
        case "08":
          $fechaletra = "AGOSTO";
          $referencia = 3;
          $estado_vista = 0;
          break;
        case "09":
          $fechaletra = "SEPTIEMBRE";
          $referencia = 3;
          $estado_vista = 0;
          break;
        case "10":
          $fechaletra = "OCTUBRE";
          $referencia = 4;
          $estado_vista = 1;
          break;
        case "11":
          $fechaletra = "NOVIEMBRE";
          $referencia = 4;
          $estado_vista = 0;
          break;
        case "12":
          $fechaletra = "DICIEMBRE";
          $referencia = 4;
          $estado_vista = 0;
          break;
      }

      $query = sprintf("SELECT cuotas_partes_entidades.id_cuotas_partes_entidades FROM cuotas_partes_datos_causante
      LEFT JOIN cuotas_partes_entidades
      ON cuotas_partes_datos_causante.id_cuotas_partes_entidades=cuotas_partes_entidades.id_cuotas_partes_entidades
      WHERE 
      cuotas_partes_datos_causante.id_cuotas_partes_datos_causante=" . $id . " AND 
      cuotas_partes_datos_causante.estado_cuotas_partes_datos_causante=1");
      $select = mysql_query($query, $conexion) or die(mysql_error());
      $row = mysql_fetch_assoc($select);
      $idEntidad = $row['id_cuotas_partes_entidades'];

      $valorPagadoOriginal = $_POST['valor_pagado'];
      $valorPagadoSinComas = str_replace(',', '', $valorPagadoOriginal);
      $valorCuotaOriginal = $_POST['valor_cuota_parte'];
      $valorCuotaSinComas = str_replace(',', '', $valorCuotaOriginal);

      $insertSQL = sprintf(
        "INSERT INTO cuotas_partes_pagos_entidades (
        nombre_cuotas_partes_pagos_entidades, 
        id_cuotas_partes_datos_causante,
        id_cuotas_partes_entidades,
        radicado,
        referencia,
        fecha,
        participacion,
        valor_pagado,
        valor_cuota_parte,
        periodo_fecha_inicio,
        periodo_fecha_final,
        estado_vista,
        estado_cuotas_partes_pagos_entidades) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",

        GetSQLValueString('pago entidad cuota partista', "text"),
        GetSQLValueString($id, "int"),
        GetSQLValueString($idEntidad, "int"),
        GetSQLValueString($_POST["radicado"], "text"),
        GetSQLValueString($referencia, "int"),
        GetSQLValueString($fechaletra, "text"),
        GetSQLValueString($_POST["participacion"], "text"),
        GetSQLValueString($valorPagadoSinComas, "double"),
        GetSQLValueString($valorCuotaSinComas, "double"),
        GetSQLValueString($_POST["periodo_fecha_inicio"], "date"),
        GetSQLValueString($_POST["periodo_fecha_final"], "date"),
        GetSQLValueString($estado_vista, "int"),
        GetSQLValueString(1, "int")
      );
      $Result = mysql_query($insertSQL, $conexion);
      echo $insertado;
    } else {
      echo '<script type="text/javascript">swal(" ERROR!", " Fechas Diferentes deben ser del mismo periodo!", "error"); </script>';
    }
  }

  if ((isset($_POST["periodo_fecha_inicio"])) && ($_POST["periodo_fecha_inicio"] != "") and (isset($_POST["updateperiodo"])) && ($_POST["updateperiodo"] != "")) {

    $fechaInicio = $_POST["periodo_fecha_inicio"];
    $fechaFinal = $_POST["periodo_fecha_final"];
    $fechaEnteraI = strtotime($fechaInicio);
    $fechaEnteraF = strtotime($fechaFinal);
    $mesI = date("m", $fechaEnteraI);
    $mesF = date("m", $fechaEnteraF);

    if ($mesI == $mesF) {
      switch ($mesI) {
        case "01":
          $fechaletra = "ENERO";
          $referencia = 1;
          $estado_vista = 1;
          break;
        case "02":
          $fechaletra = "FEBRERO";
          $referencia = 1;
          $estado_vista = 0;
          break;
        case "03":
          $fechaletra = "MARZO";
          $referencia = 1;
          $estado_vista = 0;
          break;
        case "04":
          $fechaletra = "ABRIL";
          $referencia = 2;
          $estado_vista = 1;
          break;
        case "05":
          $fechaletra = "MAYO";
          $referencia = 2;
          $estado_vista = 0;
          break;
        case "06":
          $fechaletra = "JUNIO";
          $referencia = 2;
          $estado_vista = 0;
          break;
        case "07":
          $fechaletra = "JULIO";
          $referencia = 3;
          $estado_vista = 1;
          break;
        case "08":
          $fechaletra = "AGOSTO";
          $referencia = 3;
          $estado_vista = 0;
          break;
        case "09":
          $fechaletra = "SEPTIEMBRE";
          $referencia = 3;
          $estado_vista = 0;
          break;
        case "10":
          $fechaletra = "OCTUBRE";
          $referencia = 4;
          $estado_vista = 1;
          break;
        case "11":
          $fechaletra = "NOVIEMBRE";
          $referencia = 4;
          $estado_vista = 0;
          break;
        case "12":
          $fechaletra = "DICIEMBRE";
          $referencia = 4;
          $estado_vista = 0;
          break;
      }
      $updateSQL = sprintf(
        "UPDATE cuotas_partes_pagos_entidades SET referencia=%s,  fecha=%s, estado_vista=%s, radicado=%s, participacion=%s, valor_pagado=%s, valor_cuota_parte=%s, periodo_fecha_inicio=%s, periodo_fecha_final=%s where id_cuotas_partes_pagos_entidades=%s",
        GetSQLValueString($referencia, "int"),
        GetSQLValueString($fechaletra, "text"),
        GetSQLValueString($estado_vista, "int"),
        GetSQLValueString($_POST["radicado"], "text"),
        GetSQLValueString($_POST["participacion"], "text"),
        GetSQLValueString($_POST["valor_pagado"], "double"),
        GetSQLValueString($_POST["valor_cuota_parte"], "double"),
        GetSQLValueString($_POST["periodo_fecha_inicio"], "date"),
        GetSQLValueString($_POST["periodo_fecha_final"], "date"),
        GetSQLValueString($_POST["id_cuotas_partes_pagos_entidades"], "int")
      );
      $Result = mysql_query($updateSQL, $conexion);
      echo $actualizado;
    } else {
      echo '<script type="text/javascript">swal(" ERROR!", " Fechas Diferentes deben ser del mismo periodo!", "error"); </script>';
    }
  } ?>

  <div class="row">
    <div class="col-md-4">
      <?php
      $detalleCausante = new cuotasPartesControlador();
      $detalleCausante->detalleCausanteControlador($id);
      ?>
    </div>
    <div class="col-md-8">
      <?php
      $periodoscausantes  = new cuotasPartesControlador();
      $periodoscausantes->periodoscausantesControlador($id);
      ?>
    </div>
  </div>



  <div class="modal fade bd-example" id="popupperiodos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Nuevo Periodo</label> </h4>
        </div>
        <div class="row" style="padding:10px 30px;">
          <form method="POST" name="formperiodoentidad">

            <div class="col-md-6">
              <label><span style="color:#ff0000;">*</span>Radicado IRIS</label>
              <input type="text" class="form-control" name="radicado" required>
            </div>

            <div class="col-md-6">
              <label><span style="color:#ff0000;">*</span>Porcentaje (Participación)</label>
              <input type="text" class="form-control" name="participacion" required>
            </div>

            <div class="col-md-6">
              <label><span style="color:#ff0000;">*</span>Valor Pagado</label>
              <input type="text" class="moneda form-control" name="valor_pagado" required>
            </div>

            <div class="col-md-6">
              <label><span style="color:#ff0000;">*</span>Valor Cuota Parte</label>
              <input type="text" class="moneda form-control" name="valor_cuota_parte" required>
            </div>

            <div class="col-md-6">
              <label><span style="color:#ff0000;">*</span>Fecha Inicio</label>
              <input type="date" class="form-control" name="periodo_fecha_inicio" required>
            </div>

            <div class="col-md-6">
              <label><span style="color:#ff0000;">*</span>Fecha Inicio</label>
              <input type="date" class="form-control" name="periodo_fecha_final" required>
            </div>

            <div class="col-sm-12" style="margin-top:10px;">
              <button style="float:right;" type="submit" class="btn btn-success" name="insertperiodo" value="1">Guardar</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example" id="popupeditarperiodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Editar periodo</label> </h4>
        </div>
        <div class="row" style="padding:10px 30px;">
          <div id="diveditarperiodo">

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/cuotas_partes.js"></script>
<?php
}

?>
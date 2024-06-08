<?php
if (isset($_GET['i'])) {
  // Funcion privilegiosnotariado 
  // Params ($idnotar, $idmodulo, $idfunnota)
  $id = $_GET['i'];
  $idModulo = 12; // Modulo acceso a informe estadistico
  $idFunNota = $_SESSION['snr'];
  $accesoInforme = privilegiosnotariado($id, 12, $_SESSION['snr']);
  $nump114 = privilegios(114, $_SESSION['snr']); // Auditoria IEN - Fondo Notarios

  if (1 == $_SESSION['rol'] or $accesoInforme == 1 or 0 < $nump114) {

    // Fecha Actual
    date_default_timezone_set("America/Bogota");
    $fechaActual = date("Y-m-d H:i:s");
    $fechaActualOracle = date("d/m/y");

    if (
      isset($_POST['fecha_inicio']) and
      isset($_POST['fecha_final'])
    ) {
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_final = $_POST['fecha_final'];

      // INSERT MYSQL
      $queryexp12 = sprintf("SELECT not_inf_fini, not_inf_ffin, id_not_informe FROM not_informe where id_notaria=$id and not_inf_fini='$fecha_inicio' and not_inf_ffin='$fecha_final'  and estado_not_informe=1");
      $selectexp12 = mysql_query($queryexp12, $conexion) or die(mysql_error());
      $totalRowsexp12 = mysql_num_rows($selectexp12);
      if (0 < $totalRowsexp12) {
        echo $fecharepetida;
      } else {
        $insertSQL = sprintf(
          "INSERT INTO not_informe (
          id_notaria,
          nombre_not_informe,
          not_inf_fini,
          not_inf_ffin) VALUES (%s,%s,%s,%s)",
          GetSQLValueString($id, "int"),
          GetSQLValueString($fecha_inicio . ' / ' . $fecha_final, "text"),
          GetSQLValueString($fecha_inicio, "date"),
          GetSQLValueString($fecha_final, "date")
        );
        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
        $idInsert = mysql_insert_id($conexion);

        // INSERT ORACLE
        if (1 == $habilitarNotariaInformeOracle) {
          $dateInicio = date_create($fecha_inicio);
          $fecha_inicio_oracle = date_format($dateInicio, "d/m/y");
          $dateFinal = date_create($fecha_final);
          $fecha_final_oracle = date_format($dateFinal, "d/m/y");
          $sql = "INSERT INTO SNINFMENSUAL_TRANSACTION(
            id_not_informe, 
            id_notaria,
            nombre_not_informe, 
            not_inf_fini,
            not_inf_ffin,
            not_informe_ingreso)
            VALUES 
            ($idInsert,
            $id,
            '$fecha_inicio / $fecha_final',
            '$fecha_inicio_oracle',
            '$fecha_final_oracle',
            '$fechaActualOracle')";
          $stmt = $getConection->prepare($sql);
          $stmt->execute();
        }

        echo $insertado;
        echo '<meta http-equiv="refresh" content="0;URL=./notaria_informe&' . $id . '.jsp" />';
      }
    }
?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#popInformeEstadistico"><span class="glyphicon glyphicon-plus-sign"></span>Nuevo</button>
              &nbsp;&nbsp;&nbsp;
              <strong>INFORME ESTADISTICO NOTARIAL</strong>
            </h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>

          <div class="box-body">
            <div class="table-responsive">
              <table id="tablaPeriodosInforme" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th style="min-width:100;">Fecha Inicio</th>
                    <th style="min-width:100;">Fecha Final</th>
                    <th style="min-width:100;">Registrado</th>
                    <th style="min-width:120px;">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT * FROM not_informe
                  WHERE id_notaria='$id' and estado_not_informe=1";
                  $select = mysql_query($query, $conexion);
                  $row = mysql_fetch_assoc($select);
                  $totalRows = mysql_num_rows($select);
                  if (0 < $totalRows) {
                    do {
                      echo '<tr>';
                      echo '<td>' . $row['not_inf_fini'] . '</td>';
                      echo '<td>' . $row['not_inf_ffin'] . '</td>';
                      echo '<td>' . $row['not_informe_ingreso'] . '</td>';
                      echo '<td> 
                            <a href="notaria_informe_detalle&' . $row['id_not_informe'] . '.jsp" title="Detalle" class="btn-sm btn-success" target="_bank"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>';
                      echo '</tr>';
                    } while ($row = mysql_fetch_assoc($select));
                    mysql_free_result($select);
                  }
                  ?>
                  <script>
                    $(document).ready(function() {
                      $('#tablaPeriodosInforme').DataTable({
                        "lengthMenu": [
                          [50, 100, 200, 300, 500],
                          [50, 100, 200, 300, 500]
                        ],
                        "language": {
                          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                        }
                      });
                    });
                  </script>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>


    <div class="modal fade" id="popInformeEstadistico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            <h4 class="modal-title" id="myModalLabel"><label class="control-label">Nuevo Informe Estadistico Notarial</label></h4>
          </div>
          <div class="modal-body">
            <form id="formularioexpensa" method="POST" name="formPeriodoInformeEstadistico">

              <div class="box-body">
                <p style="font-size:14px; text-align: justify; line-height: 1.2;">
                  Para reportar el informe estadistico notarial debe ingresar el periodo, desde el primer dia del mes hasta el final del mismo.<br>
                  <b>Ejemplo:</b> 01/11/2021 al 30/11/2021
                </p>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-md-2 text_titulos_dev"><span style="color:#ff0000;">*</span> Periodo </label>
                      <div class="col-md-10">
                        <div class="col-md-2"><b>Inicio:</b></div>
                        <div class="col-md-10"><input type="date" class="form-control" name="fecha_inicio"></div>
                        <div class="col-md-2"><b>Final:</b></div>
                        <div class="col-md-10"><input type="date" class="form-control" name="fecha_final"></div>
                      </div>
                    </div>
                  </div><!-- col-md-12 -->
                </div><!-- ROW -->
                <button style="margin-top:50px; margin-left:20px; float: right;" type="submit" class="next btn btn-success">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php
  } else {
  }
}

<?php
if (isset($_GET['i'])) {
  $id = $_GET['i']; 
  require_once "modelo/exp_curaduria.php";
  require_once "controlador/exp_curaduria.php";

  $nump = privilegios(7, $_SESSION['snr']);

  if (1 == $_SESSION['rol'] or 0 < $nump) {

    $query = sprintf("SELECT * FROM curaduria, funcionario, situacion_curaduria where curaduria.id_curaduria=situacion_curaduria.id_curaduria and funcionario.id_funcionario=situacion_curaduria.id_funcionario and curaduria.id_curaduria=" . $id . " limit 1");
  } else {
    $idfun = intval($_SESSION['snr']);
    $query = sprintf("SELECT * FROM curaduria, funcionario, situacion_curaduria where situacion_curaduria.fecha_terminacion>='$realdate' and funcionario.id_funcionario=" . $idfun . " and curaduria.id_curaduria=situacion_curaduria.id_curaduria and funcionario.id_funcionario=situacion_curaduria.id_funcionario and curaduria.id_curaduria=" . $id . " limit 1");
  }

  // $query = sprintf("SELECT * FROM curaduria, funcionario where curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria='$id' limit 1"); 
  $select = mysql_query($query, $conexion) or die(mysql_error());
  $row1 = mysql_fetch_assoc($select);
  $totalRows = mysql_num_rows($select);
  if (0 < $totalRows) {
    $name = $row1['nombre_curaduria'];
    $funcionarioreal = $row1['id_funcionario'];
    $id_departamento = $row1['id_departamento'];
    $id_municipio = $row1['id_municipio'];
    $ncuraduria = $row1['numero_curaduria'];
?>



    <div class="row">
      <div class="col-md-12">

        <div class="box box-info">
          <div class="box-header with-border">
            <?php if (4 == $_SESSION['snr_tipo_oficina'] or 1 == $_SESSION['rol']) { ?>
              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</button>&nbsp;
            <?php } else {
            } ?>

            <strong>Tarifa de Vigilancia /
              <?php echo $name;
              echo ' - ';
              echo quees('departamento', $id_departamento);
              echo ' - ';
              echo nombre_municipio($id_municipio, $id_departamento);
              ?></strong>
            <a href="https://sisg.supernotariado.gov.co/images/MANUAL_TARIFA_DE_VIGILANCIA_CURADURIA_V1.pdf" target="_blank"> Ver manual</a>

            <div class="box-tools pull-right">
              <?php
              if (1 == $_SESSION['snr_tipo_oficina']) {
                echo '<a href="pdf/expensa_estado_cuenta&' . $id . '.pdf" title="Estado de cuenta"><img src="images/pdf.png"></a> ';
              } else {
              }
              ?>
            </div>
          </div>

          <div class="box-body">
            <div class="table-responsive">
              <table class="table display" id="tablaPeriodoCuradurias">
                <thead>
                  <tr>
                    <?php if (1 == $_SESSION['rol']) { ?>
                      <th>Expensa</th>
                    <?php } ?>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Registrado</th>
                    <th>Auditoria CURB</th>
                    <th>Auditoria financiera</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $tablaperiodocuraduria = new ExpensaCuraduriaControlador();
                  $tablaperiodocuraduria->tablaperiodoControlador($id);
                  ?>
                  <script>
                    $(document).ready(function() {
                      $('#tablaPeriodoCuradurias').DataTable({
                        "lengthMenu": [
                          [25, 50, 100, 250, 500],
                          [25, 50, 100, 250, 500]
                        ],
                        "language": {
                          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                        }
                      });
                    });
                  </script>
                </tbody>
              </table>
            </div> <!-- /.table-responsive -->
          </div><!-- /.box-body -->
        </div><!-- box box-info -->
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <strong>NOTAS CREDITO </strong>
          </div>

          <div class="box-body">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table display" id="tablanotaCredito">
                  <thead>
                    <tr>
                      <th>Concepto</th>
                      <th>Num Fac.</th>
                      <th>Cargo Fijo</th>
                      <th>cargo Vari</th>
                      <th>Cargo Uni</th>
                      <th>Fecha Radicado</th>
                      <th>Anexo</th>
                      <th>Fecha Autoriza</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                      $busqueda = " and " . "num_expensa_fac" . " like '%" . $_POST['buscar'] . "%' ";
                    } else {
                      $busqueda = "";
                    }

                    $query = "SELECT 
                    expensa_nota_credito.nombre_expensa_nota_credito, 
                    expensa_fac.num_expensa_fac,
                    expensa_nota_credito.fijo_expensa_fac, 
                    expensa_nota_credito.vari_expensa_fac, 
                    expensa_nota_credito.uni_expensa_fac, 
                    expensa_nota_credito.fecha_nota_credito,
                    expensa_nota_credito.estados,
                    expensa_nota_credito.fecha_autoriza,
                    expensa_documento.url_expensa_documento
                    FROM expensa_nota_credito
                    LEFT JOIN expensa_fac
                    ON expensa_nota_credito.id_expensa_fac=expensa_fac.id_expensa_fac
                    LEFT JOIN expensa_curaduria
                    ON expensa_fac.id_expensa_curaduria=expensa_curaduria.id_expensa_curaduria
                    LEFT JOIN curaduria
                    ON curaduria.id_curaduria=expensa_curaduria.id_curaduria
                    LEFT JOIN expensa_documento
                    ON expensa_fac.id_expensa_fac=expensa_documento.nombre_expensa_documento
                    WHERE curaduria.id_curaduria=$id AND estado_expensa_nota_credito=1";
                    $select = mysql_query($query, $conexion);
                    $row = mysql_fetch_assoc($select);
                    $totalRows = mysql_num_rows($select);
                    if (0 < $totalRows) {
                      do {
                        echo '<tr>';
                        echo '<td>' . $row['nombre_expensa_nota_credito'] . '</td>';
                        echo '<td>' . $row['num_expensa_fac'] . '</td>';
                        echo '<td>' . $row['fijo_expensa_fac'] . '</td>';
                        echo '<td>' . $row['vari_expensa_fac'] . '</td>';
                        echo '<td>' . $row['uni_expensa_fac'] . '</td>';

                        echo '<td>' . $row['fecha_nota_credito'] . '</td>';
                        echo '<td><a href="files/expensa_curadurias/' . $row['url_expensa_documento'] . '"/><img src="images/pdf.png"></a></td>';
                        echo '<td>' . $row['fecha_autoriza'] . '</td>';
                        echo '<td>';
                        if (0 == $row['estados']) {
                          echo '<span style="color:orange">Tramite</span>';
                        } elseif (1 == $row['estados']) {
                          echo '<span style="color:green"><b>Aprobado</b></span>';
                        } elseif (2 == $row['estados']) {
                          echo '<span style="color:red"><b>Rechazado</b></span>';
                        }
                        echo '</td>';
                        echo '</tr>';
                      } while ($row = mysql_fetch_assoc($select));
                      mysql_free_result($select);
                    }
                    ?>
                    <script>
                      $(document).ready(function() {
                        $('#tablanotaCredito').DataTable({
                          "lengthMenu": [
                            [25, 50, 100, 250, 500],
                            [25, 50, 100, 250, 500]
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

            </div>

          </div>

        </div>
      </div>
    </div>


    <!-- MODAL PERIODO DE TASA DE VIGILANCIA -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registrar Tarifa de Vigilancia</h4>
          </div>
          <div class="modal-body">
            <?php
            if (isset($_POST['expensadaf']) && ($_POST["feciniexp"] < $_POST["fecfinexp"])) {

              $fechaini = strtotime($_POST["feciniexp"]);
              $fechafin = strtotime($_POST["fecfinexp"]);
              $mesini = date("m", $fechaini);
              $mesfin = date("m", $fechafin);
              if ($mesini == $mesfin) {

                $fi2018 = $_POST["feciniexp"];
                $fin2018 = $_POST["fecfinexp"];
                $queryexp12 = sprintf("SELECT * FROM expensa_curaduria where id_curaduria=$id and fecha_inicio_expensa='$fi2018' and estado_expensa_curaduria=1");
                $selectexp12 = mysql_query($queryexp12, $conexion) or die(mysql_error());
                $totalRowsexp12 = mysql_num_rows($selectexp12);
                if (0 < $totalRowsexp12) {
                  echo $fecharepetida;
                } else {
                  date_default_timezone_set("America/Bogota");
                  $fechaAhora = date("Y-m-d H:i:s");
                  $insertSQL = sprintf(
                    "INSERT INTO expensa_curaduria (
                      id_curaduria,
                      id_funcionario, 
                      nombre_expensa_curaduria,
                      fecha_inicio_expensa,
                      fecha_final_expensa,
                      fecha_real_expensa) VALUES (%s, %s, %s, %s, %s, now())",
                    GetSQLValueString($id, "int"),
                    GetSQLValueString($funcionarioreal, "int"),
                    GetSQLValueString($id_departamento . $id_municipio . '-' . $ncuraduria . '-' . $fi2018 . '/' . $fin2018, "text"),
                    GetSQLValueString($_POST["feciniexp"], "date"),
                    GetSQLValueString($_POST["fecfinexp"], "date")
                  );
                  $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

                  echo $insertado;
                  echo '<meta http-equiv="refresh" content="0;URL=./expensa_curaduria&' . $id . '.jsp" />';
                } //este es el else de repetida

              } else {
                echo '<script type="text/javascript">swal(" ERROR !", " Fechas Fuera del Periodo, Ubicar Fechas dentro del mismo mes !", "error");</script>';
              }
            } else {
            }
            ?>
            <form id="formnuevoperiodo" action="" method="POST" name="envio_periodo_tarifa">
              <p style="font-size:12px; text-align: justify; line-height: 1.2;">
                Para el reporte de los ingresos, se ha modificado el formato de Licencias por el reporte
                de facturación el cual deberá contener las radicaciones del mes indicando el rango de
                facturación generado separado por tipo de costos, el valor total de la expensa por cada
                uno de la sumatoria de la facturación de los costos, esta resultante corresponderá a la
                base para el cálculo de la tasa de vigilancia.
              </p><br><br>
              <div class="row">
                <div class="col-md-12">
                  <!-- FECHA DE INICIO -->
                  <div class="form-group">
                    <label class="col-sm-2 text_titulos_dev"><span style="color:#ff0000;">*</span> Periodo </label>
                    <div class="col-sm-5">
                      <label><i class="fa fa-calendar"></i> Desde</label>
                      <input type="text" name="feciniexp" readonly="readonly" class="form-control datepickerexpensacur">
                    </div><!-- col-md-5 -->
                    <div class="col-sm-5">
                      <label><i class="fa fa-calendar"></i> Hasta</label>
                      <input type="text" name="fecfinexp" readonly="readonly" class="form-control datepickerexpensacur"><br><br>
                    </div>
                    <div class="modal-footer"><button type="reset" class="btn btn-sm btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                      <input type="submit" name="expensadaf" class="btn btn-sm btn-success" value="Guardar">
                    </div>
                  </div><!-- form-group -->
                </div><!-- col-md-12 -->
              </div><!-- ROW -->
            </form>
          </div>

        </div>
      </div>
    </div>

<?php


    $query = sprintf("SELECT * FROM expensa_curaduria where estado_expensa_curaduria=1 and id_curaduria=" . $id . " order by id_expensa_curaduria");
    $select = mysql_query($query, $conexion) or die(mysql_error());
    $row = mysql_fetch_assoc($select);
    $totalRows = mysql_num_rows($select);
    if (0 < $totalRows) {
      echo '<script>var arraydays = [';
      do {


        for ($i = $row['fecha_inicio_expensa']; $i <= $row['fecha_final_expensa']; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {
          echo '"' . $i . '",';
        }
      } while ($row = mysql_fetch_assoc($select));
      echo ' "2001-01-01"];</script>';
    } else {
    }
    mysql_free_result($select);
  } else {
  }
} else {
  echo '<meta http-equiv="refresh" content="0;URL=./" />';
}

?>
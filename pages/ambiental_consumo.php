<?php
if (isset($_GET['i']) && '' != $_GET['i']) {
  $idFuncionario = $_SESSION['snr']; // id funcionario
  $getIdOficinaRegistro = $_GET['i']; // get id oficina registro

  $nump82 = privilegios(82, $idFuncionario);  // Ambiental Coordinador
  $nump137 = privilegios(137, $idFuncionario); // Ambiental Lider
  $nump138 = privilegios(138, $idFuncionario); // Ambiental Lider Regional
  $privilegios = 0 < privreg($getIdOficinaRegistro, $idFuncionario, 4, 9); // privilegios Ambiental Lider de la oficina 
  if (0 < $nump137) {
    $query1 = "SELECT * FROM punto_ubicacion, punto_ubicacion_enlace WHERE id_funcionario=$idFuncionario  AND estado_punto_ubicacion_enlace=1 limit 1";
    $result1 = $mysqli->query($query1);
    if ($result1->num_rows > 0) {
      while ($row = $result1->fetch_assoc()) {
        $idUbicacion = $row['id_punto_ubicacion'];
        $ubicacion = $row['nombre_punto_ubicacion'];
      }
    } else {
      echo '<script type="text/javascript">swal(" ERROR !", "Usuario ' .  quees('funcionario', $idFuncionario) . ' no establece ubicacion solicitar al administrador la asignacion en el perfil del usuario!", "error");</script>';
    }
    $result1->free_result();
    $idOficinaRegistro = null;
  } else {
    $ubicacion = quees('oficina_registro', $getIdOficinaRegistro);
    $idOficinaRegistro = $getIdOficinaRegistro;
    $idUbicacion = null;
  }
}

if (0 < $nump82 || 0 < $nump137 || 0 < $nump138 || 0 < $privilegios || 1 == $_SESSION['rol']) {

  // FECHA ACTUAL
  date_default_timezone_set("America/Bogota");
  $fechaActual = date("Y-m-d H:i:s");
  $anoActual = date("Y");

  // INSERTAR
  if (
    isset($_POST["nuevoenergia"]) && '' != $_POST["nuevoenergia"] &&
    isset($_POST["mes_reporte"]) && '' != $_POST["mes_reporte"] &&
    isset($_POST["ano_reporte"]) && '' != $_POST["ano_reporte"]
  ) {
    $insertSQL = sprintf(
      "INSERT INTO ambiental_consumo (
      nombre_ambiental_consumo, 
      id_oficina_registro,
      id_punto_ubicacion,
      ubicacion,
      mes_reporte,
      ano_reporte,

      id_funcionario, 
      cantidad_personas,
      numero_medidor, 
      direccion_medidor,
      tipo_consumo,

      frecuencia_cobro,
      periodo_inicial, 
      periodo_final, 
      unidad,
      valor_factura, 

      observacion,
      fecha_registro) VALUES (%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s)",
      GetSQLValueString($_POST["nombre_ambiental_consumo"], "text"),
      GetSQLValueString($idOficinaRegistro, "int"),
      GetSQLValueString($idUbicacion, "int"),
      GetSQLValueString($ubicacion, "text"),
      GetSQLValueString($_POST["mes_reporte"], "text"),
      GetSQLValueString($_POST["ano_reporte"], "int"),

      GetSQLValueString($idFuncionario, "int"),
      GetSQLValueString($_POST["cantidad_personas"], "int"),
      GetSQLValueString($_POST["numero_medidor"], "int"),
      GetSQLValueString($_POST["direccion_medidor"], "text"),
      GetSQLValueString($_POST["tipo_consumo"], "text"),

      GetSQLValueString($_POST["frecuencia_cobro"], "text"),
      GetSQLValueString($_POST["periodo_inicial"], "date"),
      GetSQLValueString($_POST["periodo_final"], "date"),
      GetSQLValueString($_POST["unidad"], "int"),
      GetSQLValueString($_POST["valor_factura"], "int"),

      GetSQLValueString($_POST["observacion"], "text"),
      GetSQLValueString($fechaActual, "date")
    );
    $Result = mysql_query($insertSQL, $conexion);
    mysql_free_result($Result);
    echo $insertado;
    echo '<meta http-equiv="refresh" content="0;URL=./ambiental_consumo&' . $getIdOficinaRegistro . '.jsp" />';
  }

  // ACTUALIZAR
  if (
    isset($_POST["actualizarcomsumo"]) && '' != $_POST["actualizarcomsumo"] &&
    isset($_POST["periodo_inicial"]) && '' != $_POST["periodo_inicial"] &&
    isset($_POST["periodo_final"]) && '' != $_POST["periodo_final"]
  ) {
    $UpdateSQL = sprintf(
      "UPDATE ambiental_consumo SET
      cantidad_personas=%s,
      tipo_consumo=%s,
      numero_medidor=%s,
      direccion_medidor=%s,

      frecuencia_cobro=%s,
      periodo_inicial=%s,
      periodo_final=%s,
      unidad=%s,
      valor_factura=%s, 
      observacion=%s
      WHERE id_ambiental_consumo=%s",
      GetSQLValueString($_POST["cantidad_personas"], "int"),
      GetSQLValueString($_POST["tipo_consumo"], "text"),
      GetSQLValueString($_POST["numero_medidor"], "int"),
      GetSQLValueString($_POST["direccion_medidor"], "text"),

      GetSQLValueString($_POST["frecuencia_cobro"], "text"),
      GetSQLValueString($_POST["periodo_inicial"], "date"),
      GetSQLValueString($_POST["periodo_final"], "date"),
      GetSQLValueString($_POST["unidad"], "int"),
      GetSQLValueString($_POST["valor_factura"], "int"),
      GetSQLValueString($_POST["observacion"], "text"),

      GetSQLValueString($_POST["id_ambiental_consumo"], "int")
    );
    $Result = mysql_query($UpdateSQL, $conexion);
    mysql_free_result($Result);
    echo $actualizado;
    echo '<meta http-equiv="refresh" content="0;URL=./ambiental_consumo&' . $getIdOficinaRegistro . '.jsp" />';
  }


  // ACTUALIZAR PDF
  if (
    isset($_POST["actualizarpdfenergia"]) && '' != $_POST["actualizarpdfenergia"] &&
    isset($_FILES['actualizar_pdf']) && '' != $_FILES['actualizar_pdf']
  ) {
    // Funcion global cargar archivos
    $fileP = $_FILES['actualizar_pdf'];
    $fileName = uniqid() . date("YmdGis");
    $hashName = date("YmdGis") . uniqid();
    $nombreArchivo = $fileP['name'];
    $extension = strtolower(pathinfo(basename($fileP['name']), PATHINFO_EXTENSION));
    $tipoArchivoPermitido = array("pdf");
    $cargarPDF = uploadFileGlobal($fileP, 'filesnr/ambiental/' . $anoActual . '/', $fileName, $tipoArchivoPermitido, 10);

    if (isset($cargarPDF) && '' != $cargarPDF) {
      $UpdateSQL = sprintf(
        "UPDATE ambiental_consumo SET
        nombre_doc=%s,
        ano_doc=%s,
        url_doc=%s,
        hash_doc=%s
        WHERE id_ambiental_consumo=%s",
        GetSQLValueString($nombreArchivo, "text"),
        GetSQLValueString($anoActual, "text"),
        GetSQLValueString($fileName . '.' . $extension, "text"),
        GetSQLValueString($hashName, "text"),

        GetSQLValueString($_POST["id_ambiental_consumo"], "int")
      );
      $Result = mysql_query($UpdateSQL, $conexion);
      mysql_free_result($Result);
      echo $insertado;
      // echo '<meta http-equiv="refresh" content="0;URL=./ambiental_consumo&' . $getIdOficinaRegistro . '.jsp" />';
    }
  }

  // ACTUALIZAR CHECK LIDER REGIONAL
  if (
    isset($_POST["ckeck_lider_regional"]) && '' != $_POST["ckeck_lider_regional"]
  ) {
    $UpdateSQL = sprintf(
      "UPDATE ambiental_consumo SET
      estado_envio=%s
      WHERE id_ambiental_consumo=%s",
      GetSQLValueString(1, "text"),
      GetSQLValueString($_POST["ckeck_lider_regional"], "int")
    );
    $Result = mysql_query($UpdateSQL, $conexion);
    mysql_free_result($Result);
    echo $actualizado;
    echo '<meta http-equiv="refresh" content="0;URL=./ambiental_consumo&' . $getIdOficinaRegistro . '.jsp" />';
  }

?>
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>195</h3>
          <p>ORIPS</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>8420</h3>
          <p>Usuarios</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>0</h3>
          <p>Consumo Energia</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>0</h3>
          <p>Consumo Agua</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>


  <div class="panel panel-default">
    <div class="box-header with-border">
      <h3 class="box-title"><b>
          <a href="orips.jsp" class="btn btn-default btn-xs" title="Regreso a Tablero Expedientes">Regresar</a>
          Consumo de Servicios
          <?php
          if (isset($ubicacion)) {
            echo $ubicacion;
          }
          ?>
        </b></h3>
        <?php if (0 < $nump82 || 0 < $privilegios || (0 < $nump137 && isset($idUbicacion)) || 1 == $_SESSION['rol']) { ?>
          <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalnuevoconsumo" title="Consumo de Servicios"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo</button>
        <?php } ?>
      <div class="box-tools pull-right">
        <?php if ((0 < $nump137 && isset($idUbicacion)) || 0 < $nump138 || 0 < $nump82 || 1 == $_SESSION['rol']) { ?>
          <a href="ambiental_estadistica.jsp" class="btn btn-success btn-xs" title="Reporte">Reporte</a>
        <?php } ?>

      </div>
    </div>
    <div class="panel-body">
      
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="detalleconsumo" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Mes</th>
              <th>Año</th>
              <th>Ubicacion</th>
              <th>Servicio</th>
              <th>Cantidad Personas</th>
              <th>No Medidor</th>
              <th>Dirección Medidor</th>
              <th>Frecuencia</th>
              <th>Fecha Inicio Facturado</th>
              <th>Fecha Final Facturado</th>
              <th title="(kilovatios por Hora) (Metros Cubicos)">Unidad (Kw/h - M3)</th>
              <th>Valor</th>
              <th>Observación</th>
              <th>PDF Factura</th>
              <th>Visto</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (1 == $_SESSION['rol'] || 0 < $nump82) {
              $query = "SELECT * FROM ambiental_consumo WHERE estado_ambiental_consumo=1";
            } else if (0 < $privilegios) {
              $query = "SELECT * FROM ambiental_consumo WHERE id_oficina_registro=$idOficinaRegistro AND estado_ambiental_consumo=1";
            } else if (0 < $nump137 && isset($idUbicacion)) {
              $idUbicacionUno = $idUbicacion;
              $query = "SELECT * FROM ambiental_consumo WHERE id_punto_ubicacion=$idUbicacionUno AND estado_ambiental_consumo=1";
            } else if (0 < $nump138 && 2 == $_SESSION['snr_tipo_oficina'] && isset($_SESSION['snr_grupo_area'])) {
              $idGrupoArea = $_SESSION['snr_grupo_area'];
              $query3 = "SELECT id_orip FROM grupo_area WHERE id_grupo_area=$idGrupoArea AND estado_grupo_area=1 LIMIT 1";
              $result3 = $mysqli->query($query3);
              while ($row3 = $result3->fetch_assoc()) {
                $idRegion = region($row3['id_orip']);
              }
              $result3->free_result();
              $query = "SELECT * FROM oficina_registro, ambiental_consumo WHERE oficina_registro.id_region=$idRegion AND oficina_registro.id_oficina_registro=ambiental_consumo.id_oficina_registro AND estado_ambiental_consumo=1";
            } else {
              $query = "SELECT * FROM ambiental_consumo WHERE id_punto_ubicacion=0 AND estado_ambiental_consumo=1";
            }
            $result = $mysqli->query($query);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                echo '<td>' . $row['id_ambiental_consumo'] . '</td>';
                echo '<td>' . $row['mes_reporte'] . '</td>';
                echo '<td>' . $row['ano_reporte'] . '</td>';
                echo '<td>' . $row['ubicacion'] . '</td>';
                echo '<td>' . $row['nombre_ambiental_consumo'] . '</td>';
                echo '<td>' . $row['cantidad_personas'] . '</td>';
                echo '<td>' . $row['numero_medidor'] . '</td>';
                echo '<td>' . $row['direccion_medidor'] . '</td>';
                echo '<td>' . $row['frecuencia_cobro'] . '</td>';
                echo '<td>' . $row['periodo_inicial'] . '</td>';
                echo '<td>' . $row['periodo_final'] . '</td>';
                echo '<td>' . $row['unidad'] . '</td>';
                echo '<td>' . $row['valor_factura'] . '</td>';
                echo '<td>' . substr($row['observacion'], 0, 50) . '</td>';
                echo '<td>';
                if (isset($row['url_doc']) && '' != $row['url_doc']) {
                  echo '<a href="https://sisg.supernotariado.gov.co/filesnr/ambiental/' . $row['ano_doc'] . '/' . $row['url_doc'] . '" target="_blank"><img src="images\pdf.png" title="' . $row['nombre_doc'] . '"></a>';
                }
                if (0 == $row['estado_envio'] || 0 < $nump82 || 1 == $_SESSION['rol']) {
                  echo "&nbsp;<a class='actualizar_ambiental' title='Cambiar PDF' id=" . 'page_actualizar_pdf' . '-' . $row['id_ambiental_consumo'] . '-' . $row['id_oficina_registro'] . " style='cursor: pointer;' data-toggle='modal' data-target='#popupdateambiental'><i class='glyphicon glyphicon-pencil'></i></a>";
                }
                echo '</td>';
                echo '<td>';
                if (0 == $row['estado_envio']) {
                  echo 'No';
                  if (0 < $nump138 || 0 < $nump82 || 1 == $_SESSION['rol']) {
                    echo '<form name="ckeck_lider_regional" method="post" style="display: inline;">
                            <input type="hidden" name="ckeck_lider_regional" value="' . $row['id_ambiental_consumo'] . '">
                            <button class="btn btn-xs" type="submit"><i class="fa fa-check"></i></button>
                          </form>';
                  }
                } else {
                  echo 'Si';
                }
                echo '</td>';
                echo '<td>';
                if (0 == $row['estado_envio'] || 0 < $nump82 || 1 == $_SESSION['rol']) {
                  echo "<a class='actualizar_ambiental btn btn-xs btn-warning' title='Editar Consumo' id=" . 'actualizar' . '-' . $row['id_ambiental_consumo'] . '-' . $row['id_oficina_registro'] . " style='cursor: pointer;' data-toggle='modal' data-target='#popupdateambiental'>
                          <i class='glyphicon glyphicon-pencil'></i>
                        </a>&nbsp;";
                }
                echo '</td>';
                echo '</tr>';
              }
            }
            $result->free_result();
            ?>
            <script>
              $(document).ready(function() {
                $('#detalleconsumo').DataTable({
                  dom: 'Bfrtip',
                  buttons: [{
                    extend: 'excelHtml5',
                    title: 'Estadista <?php echo date("Y-m-d H:i:s"); ?>'
                  }],
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

    </div>
  </div>

  <!-- NUEVO ENERGIA -->
  <div class="modal fade" id="modalnuevoconsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Nuevo</label></h4>
        </div>
        <div class="modal-body">

          <form action="" method="POST" name="formenergia1" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-12">
                <label><span style="color:#ff0000;">*</span>Tipo de Servicio:</label>
                <select class="form-control" name="nombre_ambiental_consumo" required>
                  <option value=""></option>
                  <option value="Energia">Energia</option>
                  <option value="Agua">Agua</option>
                </select>
              </div>
              <div class="col-md-6">
                <label><span style="color:#ff0000;">*</span>Mes Reporte:</label>
                <select class="form-control" name="mes_reporte" required>
                  <option value=""></option>
                  <option value="Enero">Enero</option>
                  <option value="Febrero">Febrero</option>
                  <option value="Marzo">Marzo</option>
                  <option value="Abril">Abril</option>
                  <option value="Mayo">Mayo</option>
                  <option value="Junio">Junio</option>
                  <option value="Julio">Julio</option>
                  <option value="Agosto">Agosto</option>
                  <option value="Septiembre">Septiembre</option>
                  <option value="Octubre">Octubre</option>
                  <option value="Noviembre">Noviembre</option>
                  <option value="Diciembre">Diciembre</option>
                </select>
              </div>
              <div class="col-md-6">
                <label><span style="color:#ff0000;">*</span>Año Reporte:</label>
                <select class="form-control" name="ano_reporte" required>
                  <option value=""></option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                </select>
              </div>
              <div class="col-md-12" style="margin-bottom: 20px;">
                <label><span style="color:#ff0000;">*</span>¿ Cuenta con la informacion para reportar ?</label>
                <select class="form-control" name="respuesta_reporte" id="opcionesConsumoAmbiental" required>
                  <option value=""></option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>

              <div id="camposAdicionales" style="display: none;">

                <div class="col-md-12">
                  <label>Cantidad Personas</label>
                  <input type="number" class="form-control" name="cantidad_personas">
                </div>
                <div class="col-md-12">
                  <label>Numero Medidor</label>
                  <input type="number" class="form-control" name="numero_medidor">
                </div>
                <div class="col-md-12">
                  <label>Direccion</label>
                  <small>En caso de que la ORIP esté ubicada en un centro comercial, por favor indicar nombre y local.</small>
                  <input type="text" class="form-control" name="direccion_medidor">
                </div>
                <div class="col-md-12">
                  <label><span style="color:#ff0000;">*</span>Frecuencia de cobro</label>
                  <select class="form-control" name="frecuencia_cobro" id="frecuencia_cobro" required>
                    <option value=""></option>
                    <option value="Mensual">Mensual</option>
                    <option value="Bimestral">Bimestral</option>
                    <option value="Trimestral">Trimestral</option>
                    <option value="Cuatrimestral">Cuatrimestral</option>
                    <option value="Semestral">Semestral</option>
                    <option value="Anual">Anual</option>
                  </select>
                </div>
                <div class="col-md-12">
                  <label><span style="color:#ff0000;">*</span>Tipo de Consumo</label>
                  <select class="form-control" name="tipo_consumo" id="tipo_consumo" required>
                    <option value=""></option>
                    <option value="Por Consumo">Por Consumo</option>
                    <option value="Tarifa Fija">Tarifa Fija</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label><span style="color:#ff0000;">*</span>fecha de inicio de periodo de Facturación:</label>
                  <input type="date" class="form-control" name="periodo_inicial" id="periodo_inicial" required>
                </div>
                <div class="col-md-6">
                  <label><span style="color:#ff0000;">*</span>fecha final del periodo de Facturación:</label>
                  <input type="date" class="form-control" name="periodo_final" id="periodo_final" required>
                </div>
                <div class="col-md-6">
                  <label><span style="color:#ff0000;">*</span>Cantidad Unidad: Energia(Kw/h) Agua(M3)</label>
                  <input type="number" class="form-control" name="unidad" id="unidad" required>
                </div>
                <div class="col-md-6">
                  <label><span style="color:#ff0000;">*</span>Valor Facturado en Pesos</label>
                  <input type="number" class="form-control" name="valor_factura" id="valor_factura" required>
                </div>
                <div class="col-md-12">
                  <label>Observación</label>
                  <textarea name="observacion" class="form-control" cols="30" rows="3" maxlength="255">N/A</textarea>
                </div>
                <!-- <div class="col-md-12">
                <label><span style="color:#ff0000;">*</span>PDF Recibo Publico</label>
                <input type="file" name="pdf_energia">
              </div> -->
              </div>
            </div>

            <div class="modal-footer">
              <button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()"> Cancelar</button>
              <input type="submit" name="nuevoenergia" class="btn btn-success btn-xs" value="Guardar">
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- PUNTOS CONSUMOS -->
  <div class="modal fade" id="popupdateambiental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Actualizar</label></h4>
        </div>
        <div class="modal-body">
          <div id="div_update_consumo"></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('.actualizar_ambiental').click(function() {
      var option = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/ambiental_editar_consumo.php",
        data: 'option=' + option,
        async: true,
        success: function(b) {
          jQuery('#div_update_consumo').html(b);
        }
      })
    });

    $('#opcionesConsumoAmbiental').change(function() {
      let resp = document.getElementById("opcionesConsumoAmbiental").value;
      if ('Si' == resp) {
        let divCampos = document.getElementById("camposAdicionales");
        divCampos.style.display = "block";
      } else if ('No' == resp) {
        let divCampos = document.getElementById("camposAdicionales");
        divCampos.style.display = "none";
        let tres = document.getElementById("frecuencia_cobro");
        tres.required = false;
        let cuatro = document.getElementById("tipo_consumo");
        cuatro.required = false;
        let cinco = document.getElementById("periodo_inicial");
        cinco.required = false;
        let seis = document.getElementById("periodo_final");
        seis.required = false;
        let siete = document.getElementById("unidad");
        siete.required = false;
        let ocho = document.getElementById("valor_factura");
        ocho.required = false;
      }
    });
  </script>

<?php
}

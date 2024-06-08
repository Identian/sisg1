<?php
function refrescarPage()
{
?><script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
      location.reload();
    }
  </script> <?php
          }

          $id = $_GET['i'];
          $accesoInforme = 0;
          $query4 = sprintf("SELECT * FROM notaria, not_informe where notaria.id_notaria=not_informe.id_notaria  and id_not_informe='$id' limit 1");
          $select4 = mysql_query($query4, $conexion) or die(mysql_error());
          $row14 = mysql_fetch_assoc($select4);
          $id_notaria = $row14['id_notaria'];
          $fecini = $row14['not_inf_fini'];
          $fecfinal = $row14['not_inf_ffin'];
          if (isset($id_notaria)) {
            $accesoInforme = privilegiosnotariado($id_notaria, 12, $_SESSION['snr']);
            $nump114 = privilegios(114, $_SESSION['snr']); // Auditoria IEN - Fondo Notarios
          }
          if (isset($_GET['i']) and (1 == $_SESSION['rol'] or $accesoInforme == 1 or 0 < $nump114)) {

            //CONSULTA DE NOTARIA
            $query = sprintf("SELECT * FROM notaria where  notaria.id_notaria='$id_notaria' limit 1");
            $select = mysql_query($query, $conexion) or die(mysql_error());
            $row1 = mysql_fetch_assoc($select);
            $name = $row1['nombre_notaria'];
            $departamento = $row1['id_departamento'];
            $municipio = $row1['codigo_municipio'];
            $tele = $row1['telefono_notaria'];
            $dire = $row1['direccion_notaria'];
            $nnotaria = str_replace("Notaria ", "", $name);
            $email_notaria = $row1['email_notaria'];
            $subsidiada = $row1['subsidiada'];
            $codigo_notaria = $row1['codigo_dane'];

            //CONSULTA A NOTARIO
            $query = sprintf("SELECT * FROM posesion_notaria, funcionario, tipo_nombramiento_n where id_cargo=1 and posesion_notaria.id_funcionario=funcionario.id_funcionario and posesion_notaria.id_tipo_nombramiento_n=tipo_nombramiento_n.id_tipo_nombramiento_n and id_notaria=" . $id_notaria . " and estado_funcionario=1 and estado_posesion_notaria=1 order by fecha_inicio desc");
            $select = mysql_query($query, $conexion) or die(mysql_error());
            $row1 = mysql_fetch_assoc($select);
            $nombre_notario = $row1['nombre_funcionario'];
            $cedula_funcionario = $row1['cedula_funcionario'];
            $nombramiento =  $row1['nombre_tipo_nombramiento_n'];

            // CONSULTA A ESTADO
            $query4723 = sprintf("SELECT 
            estado_cierre_informe,
            estado_cierre_auditoria_fonnotarios
            FROM not_informe where id_not_informe=$id and estado_not_informe=1");
            $select4723 = mysql_query($query4723, $conexion) or die(mysql_error());
            $row14723 = mysql_fetch_assoc($select4723);

            if (0 == $row14723['estado_cierre_informe']) {
              $estadoCierreIEN = 0;
            } else {
              $estadoCierreIEN = $row14723['estado_cierre_informe'];
            }

            if (0 == $row14723['estado_cierre_auditoria_fonnotarios']) {
              $AuditoriaEstadoCierreIEN = 0;
            } else {
              $AuditoriaEstadoCierreIEN = 1;
            }
            mysql_free_result($select4723);

            // GUARDAR LOS ANEXOS DE SOPORTE DE CONSIGNACION
            if (isset($_POST["create_pdf_consignacion"])) {
              $idNotTipoDocumento = $_POST["id_not_tipo_documento"];
              $querya = sprintf("SELECT count(id_not_tipo_documento) AS countipodoc FROM not_documento where id_not_tipo_documento=$idNotTipoDocumento AND id_not_informe=$id AND estado_not_documento=1");
              $selecta = mysql_query($querya, $conexion) or die(mysql_error());
              $rowa = mysql_fetch_assoc($selecta);
              if (0 == $rowa['countipodoc']) {
                $fecha = new DateTime($_POST["fecha_consignacion"]);
                $periodoConsolidacion = $fecha->format('m');

                $tamano_archivo = 11534336;
                $formato_archivo = array('pdf');
                $carpeta_archivo = "filesnr/informeestadisticonotarial/";
                $ruta_archivo = date("YmdGis") . base64_encode($_FILES['file']['tmp_name']);

                if ("" != $_FILES['file']['tmp_name']) {
                  $archivo = $_FILES['file']['tmp_name'];
                  $tam_archivo = filesize($archivo);
                  $tam_archivo2 = $_FILES['file']['size'];
                  $nombre = strtolower($_FILES['file']['name']);
                  $info = pathinfo($nombre);
                  $extension = $info['extension'];
                  $array_archivo = explode('.', $nombre);
                  $extension2 = end($array_archivo);

                  if (($tam_archivo == $tam_archivo2) and ($tamano_archivo > $tam_archivo)) {
                    if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
                      $files = $ruta_archivo . '.' . $extension;
                      $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo . $files);
                      //chmod($files,0777);
                      $nombrebre_orig = ucwords($nombre);
                      $hash = md5($files);
                      $insertSQL = sprintf(
                        "INSERT INTO not_documento (
                        id_not_informe,
                        id_not_tipo_documento, 
                        nombre_not_documento,
                        url_not_documento,
                        hash_not_documento,

                        periocidad,
                        periodo,
                        cuenta_bancaria,
                        numero_consignacion,
                        fecha_consignacion,
                        valor_consignacion
                        ) VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s)",
                        GetSQLValueString($id, "int"),
                        GetSQLValueString($_POST["id_not_tipo_documento"], "int"),
                        GetSQLValueString($fecini . '/' . $fecfinal, "text"),
                        GetSQLValueString($files, "text"),
                        GetSQLValueString($hash, "text"),

                        GetSQLValueString($_POST["periocidad"], "text"),
                        GetSQLValueString($periodoConsolidacion, "int"),
                        GetSQLValueString($_POST["cuenta_bancaria"], "text"),
                        GetSQLValueString($_POST["numero_consignacion"], "number"),
                        GetSQLValueString($_POST["fecha_consignacion"], "date"),
                        GetSQLValueString($_POST["valor_consignacion"], "number")
                      );
                      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                      echo $documentocargado;
                      refrescarPage();
                    } else {
                      $valido = 0;
                      echo  $doc_no_tipo;
                    }
                  }
                } else {
                  $valido = 0;
                  echo $doc_tam;
                }
              } else {
                echo $repetido;
              }
            }

            // GUARDAR SOPORTE FIRMADOS DE INFORME Y REPORTE
            if (isset($_POST["create_pdf_documentos_firmados"])) {
              $tamano_archivo = 11534336;
              $formato_archivo = array('pdf');
              $carpeta_archivo = "filesnr/informeestadisticonotarial/";
              $ruta_archivo = date("YmdGis") . base64_encode($_FILES['file']['tmp_name']);

              if ("" != $_FILES['file']['tmp_name']) {
                $archivo = $_FILES['file']['tmp_name'];
                $tam_archivo = filesize($archivo);
                $tam_archivo2 = $_FILES['file']['size'];
                $nombre = strtolower($_FILES['file']['name']);
                $info = pathinfo($nombre);
                $extension = $info['extension'];
                $array_archivo = explode('.', $nombre);
                $extension2 = end($array_archivo);

                if (($tam_archivo == $tam_archivo2) and ($tamano_archivo > $tam_archivo)) {
                  if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
                    $files = $ruta_archivo . '.' . $extension;
                    $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo . $files);
                    $nombrebre_orig = ucwords($nombre);
                    $hash = md5($files);
                    $insertSQL = sprintf(
                      "INSERT INTO not_documento (
                      id_not_informe,
                      id_not_tipo_documento,
                      nombre_not_documento,
                      url_not_documento,
                      hash_not_documento
                      ) VALUES (%s,%s,%s,%s,%s)",
                      GetSQLValueString($id, "int"),
                      GetSQLValueString($_POST["id_not_tipo_documento"], "int"),
                      GetSQLValueString($fecini . '/' . $fecfinal, "text"),
                      GetSQLValueString($files, "text"),
                      GetSQLValueString($hash, "text")
                    );
                    $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                    echo $documentocargado;
                    refrescarPage();
                  } else {
                    $valido = 0;
                    echo  $doc_no_tipo;
                  }
                }
              } else {
                $valido = 0;
                echo $doc_tam;
              }
            }

            echo '<h1></h1>';

            // CIERRE DEL INFORME ESTADISTICO NOTARIAL
            if (isset($_POST["guardarAuditoriaCierraInforme"])) {

              $updateSQL = sprintf("UPDATE not_informe SET 
              estado_cierre_informe=1
              WHERE id_not_informe=$id");
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              date_default_timezone_set("America/Bogota");
              $fechaActual = date("Y-m-d H:i:s");
              $insertSQL = sprintf(
                "INSERT INTO not_auditoria (
                id_not_informe,
                id_not_auditorio_id_funcionario, -- 
                not_auditoria_observacion,
                not_auditoria_tipo,
                not_auditoria_fecha_cierre
                ) VALUES (%s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($_SESSION['snr'], "int"),
                GetSQLValueString('N/A', "text"),
                GetSQLValueString('Cierre Informe Estadistico Notarial', "text"),
                GetSQLValueString($fechaActual, "text")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              refrescarPage();
            }

            // CIERRE AUTORIZAR AUDITORIA CIERRE DE INFORME ESTADISTICO NOTARIAL.
            if (isset($_POST["guardarAuditoriaFondoNotarios"])) {

              $updateSQL = sprintf("UPDATE not_informe SET 
              estado_cierre_auditoria_fonnotarios=1
              WHERE id_not_informe=$id");
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              date_default_timezone_set("America/Bogota");
              $fechaActual = date("Y-m-d H:i:s");
              $insertSQL = sprintf(
                "INSERT INTO not_auditoria (
                id_not_informe,
                id_not_auditorio_id_funcionario, -- 
                not_auditoria_observacion,
                not_auditoria_tipo,
                not_auditoria_fecha_cierre
                ) VALUES (%s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($_SESSION['snr'], "int"),
                GetSQLValueString($_POST["not_auditoria_observacion"], "text"),
                GetSQLValueString('Autorizo Informe Estadistico Notarial', "text"),
                GetSQLValueString($fechaActual, "text")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              refrescarPage();
            }

            // CIERRE RECHAZAR AUDITORIA CIERRE DE INFORME ESTADISTICO NOTARIAL.
            if (isset($_POST["guardarRechazoAuditoriaCierraInforme"])) {

              $updateSQL = sprintf("UPDATE not_informe SET 
              estado_cierre_informe=0
              WHERE id_not_informe=$id");
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              date_default_timezone_set("America/Bogota");
              $fechaActual = date("Y-m-d H:i:s");
              $insertSQL = sprintf(
                "INSERT INTO not_auditoria (
                id_not_informe,
                id_not_auditorio_id_funcionario, -- 
                not_auditoria_observacion,
                not_auditoria_tipo,
                not_auditoria_fecha_cierre
                ) VALUES (%s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($_SESSION['snr'], "int"),
                GetSQLValueString($_POST["not_auditoria_observacion"], "text"),
                GetSQLValueString('Rechazo Informe Estadistico Notarial', "text"),
                GetSQLValueString($fechaActual, "text")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              refrescarPage();
            }
            ?>

  <!-- MODAL PARA AGREGAR LAS CONSGINACIONES DE INFORME ESTADISTICO NOTARIAL -->
  <div class="modal fade" id="popnotaria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div id="nuevaAventura" class="modal-body">

          <h5><b>SOPORTE OBLIGACIONES</b></h5>

          <form action="" method="POST" name="formpdfconsignacion" enctype="multipart/form-data">
            <table class="table">
              <tr>
                <td><b>Anexo</b></td>
                <td>
                  <select class="form-control" name="id_not_tipo_documento" required>
                    <option selected></option>
                    <?php $actualizar5 = mysql_query("SELECT * FROM not_tipo_documento WHERE estado_not_tipo_documento=1 AND tipo_seleccion=1 order by nombre_not_tipo_documento", $conexion) or die(mysql_error());
                    $row15 = mysql_fetch_assoc($actualizar5);
                    $total55 = mysql_num_rows($actualizar5);
                    if (0 < $total55) {
                      do {
                        echo '<option value="' . $row15['id_not_tipo_documento'] . '" ';
                        echo '>' . $row15['nombre_not_tipo_documento'] . '</option>';
                      } while ($row15 = mysql_fetch_assoc($actualizar5));
                      mysql_free_result($actualizar5);
                    } ?>
                  </select>
                </td>

                <td><b>Periocidad</b></td>
                <td>
                  <select class="form-control" name="periocidad" required>
                    <option selected></option>
                    <?php $actualizar5 = mysql_query("SELECT * FROM not_tipo_documento WHERE estado_not_tipo_documento=1 AND tipo_seleccion=2 order by nombre_not_tipo_documento", $conexion) or die(mysql_error());
                    $row15 = mysql_fetch_assoc($actualizar5);
                    $total55 = mysql_num_rows($actualizar5);
                    if (0 < $total55) {
                      do {
                        echo '<option value="' . $row15['nombre_not_tipo_documento'] . '" ';
                        echo '>' . $row15['nombre_not_tipo_documento'] . '</option>';
                      } while ($row15 = mysql_fetch_assoc($actualizar5));
                      mysql_free_result($actualizar5);
                    } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td><b>Seleccionar archivo</b></td>
                <td><input type="file" name="file" required></td>
                <td><b>Seleccionar Banco</b></td>
                <td>
                  <select class="form-control" name="id_banco_consignacion" required>
                    <option selected></option>
                    <?php $actualizar8 = mysql_query("SELECT * FROM nc_banco WHERE estado_nc_banco=1 ORDER BY nombre_nc_banco", $conexion) or die(mysql_error());
                    $row18 = mysql_fetch_assoc($actualizar8);
                    $total58 = mysql_num_rows($actualizar8);
                    if (0 < $total58) {
                      do {
                        echo '<option value="' . $row15['id_nc_banco'] . '" ';
                        echo '>' . $row18['nombre_nc_banco'] . '</option>';
                      } while ($row18 = mysql_fetch_assoc($actualizar8));
                      mysql_free_result($actualizar8);
                    } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td><b>N° Cuenta Bancaria</b></td>
                <td><input type="text" class="form-control" name="cuenta_bancaria" required></td>
                <td><b>Numero Consignacion</b></td>
                <td><input type="number" class="form-control" name="numero_consignacion" required></td>
              </tr>

              <tr>
                <td><b>Fecha Consignación</b></td>
                <td><input type="date" class="form-control" name="fecha_consignacion" required></td>
                <td><b>Valor Consignación</b></td>
                <td><input type="number" class="form-control" name="valor_consignacion" required></td>
              </tr>

            </table>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="create_pdf_consignacion" class="btn btn-success btn-sm">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL PARA AGREGAR LOS DOCUMENTOS FIRMADOS -->
  <div class="modal fade" id="popdocumentosfirmados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div id="nuevaAventura" class="modal-body">

          <h5><b>SUBIR INFORME Y REPORTE FIRMADOS</b></h5>

          <form action="" method="POST" name="formpdfdocumentosfirmados" enctype="multipart/form-data">
            <table class="table">
              <tr>
                <td><b>Anexos</b></td>
                <td>
                  <select class="form-control" name="id_not_tipo_documento" required>
                    <option selected></option>
                    <?php $actualizar5 = mysql_query("SELECT * FROM not_tipo_documento WHERE estado_not_tipo_documento=1 AND tipo_seleccion=3 order by nombre_not_tipo_documento", $conexion) or die(mysql_error());
                    $row15 = mysql_fetch_assoc($actualizar5);
                    $total55 = mysql_num_rows($actualizar5);
                    if (0 < $total55) {
                      echo '<option value="" selected></option>';
                      do {
                        echo '<option value="' . $row15['id_not_tipo_documento'] . '" ';
                        echo '>' . $row15['nombre_not_tipo_documento'] . '</option>';
                      } while ($row15 = mysql_fetch_assoc($actualizar5));
                      mysql_free_result($actualizar5);
                    } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td><b>Seleccionar archivo</b></td>
                <td><input type="file" name="file" required></td>
              </tr>

            </table>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="create_pdf_documentos_firmados" class="btn btn-success btn-sm">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title"><b>INFORMACION GENERAL</b></h3>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked info" style="font-size:11px;">
              <li><a><i class="glyphicon glyphicon-home"></i><span><b>NOTARIA</b> &nbsp;<?php echo $name; ?></span></a></li>
              <li><a><i class="glyphicon glyphicon-map-marker"></i><span><b>DEPARTAMENTO</b> &nbsp;<?php echo quees('departamento', $departamento); ?></span></a></li>
              <li><a><i class="glyphicon glyphicon-map-marker"></i> <span><b>CIRCULO</b> &nbsp;<?php echo nombre_municipio($municipio, $departamento); ?></span></a></li>
              <li><a><i class="glyphicon glyphicon-map-marker"></i>
                  <span><b>SUBSIDIADA</b> &nbsp;
                    <?php if ($subsidiada == NULL) {
                      echo 'NO';
                    } else {
                      echo 'SI';
                    } ?>
                  </span>
                </a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked info" style="font-size:11px;">
              <li><a><i class="glyphicon glyphicon-map-marker"></i><span><b>CODIGO</b> &nbsp;<?php echo $codigo_notaria; ?></span></a></li>
              <li><a><i class="glyphicon glyphicon-envelope"></i><span><b>EMAIL</b> &nbsp; <?php echo $email_notaria ?></span></a></li>
              <li><a><i class="glyphicon glyphicon-earphone"></i><span><b>TELEFONO</b> &nbsp;<?php echo $tele; ?></span></a></li>
              <li><a><i class="glyphicon glyphicon-home"></i><span><b>DIRECCION</b> &nbsp;<?php echo $dire; ?></span></a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked info" style="font-size:11px;">
              <li><a><i class="glyphicon glyphicon-user"></i><span><b>NOTARIO</b> <?php echo $nombre_notario; ?></span></a></li>
              <li><a><i class="glyphicon glyphicon-user"></i><span><b>CEDULA</b> <?php echo $cedula_funcionario; ?></span></a></li>
              <li><a><i class="glyphicon glyphicon-user"></i><span><b>NOMBRAMIENTO</b> <?php echo $nombramiento ?></span></a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-9">
      <div class="box box-body">
        <div class="box-header with-border">
          <h5>
            <a href="notaria_informe&<?php echo $id_notaria; ?>.jsp" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-left"></span> Regresar </a>&nbsp; &nbsp; &nbsp;
            <b>INFORME ESTADISTICO NOTARIAL &nbsp; &nbsp; &nbsp; <?php echo $fecini; ?> &nbsp; | &nbsp; <?php echo $fecfinal; ?></b>
          </h5>
        </div>

        <?php
            $totaldgdper = 0;
            $totaldgg = 0;
            $totaldt = 0;
        ?>

        <!-- ESCRITURACION -->
        <div class="row">
          <div class="col-md-12">
            <!-- UPDATE DETALLE ESCRITURACION -->
            <?php
            if (isset($_POST['update_not_es'])) {
              $not_es_al = $_POST['not_es_al'];
              $not_es_num = $_POST['not_es_num'];
              $not_es_total = $not_es_al - $not_es_num;
              if ($not_es_total < 0) $not_es_total = -$not_es_total;

              $updateSQL = sprintf(
                "UPDATE not_escrituracion SET 
                  not_es_num=%s,
                  not_es_al=%s,
                  not_es_total=%s,
                  not_es_tene=%s,
                  not_es_tenen=%s,
                  not_es_tenev=%s,

                  not_es_tevis=%s,
                  not_es_tevisn=%s,
                  not_es_tevisv=%s,
                  not_es_tesc=%s,
                  not_es_tescn=%s,
                  not_es_tescv=%s,

                  not_es_teevipa=%s,
                  not_es_teevipan=%s,
                  not_es_teevipav=%s,
                  not_es_tee=%s,
                  not_es_teen=%s,
                  not_es_teev=%s,

                  not_es_tdea=%s,
                  not_es_tdean=%s,
                  not_es_tdeav=%s,
                  not_es_tena=%s,
                  not_es_tenan=%s,
                  not_es_tenav=%s,

                  not_es_teevip=%s,
                  not_es_teevipn=%s,
                  not_es_teevipv=%s,
                  not_es_teup=%s,
                  not_es_teupn=%s,
                  not_es_teupv=%s

                  where id_not_informe=%s",
                GetSQLValueString($_POST["not_es_num"], "text"),
                GetSQLValueString($_POST["not_es_al"], "text"),
                GetSQLValueString($not_es_total, "number"),
                GetSQLValueString($_POST["not_es_tene"], "number"),
                GetSQLValueString($_POST["not_es_tenen"], "text"),
                GetSQLValueString($_POST["not_es_tenev"], "number"),

                GetSQLValueString($_POST["not_es_tevis"], "number"),
                GetSQLValueString($_POST["not_es_tevisn"], "text"),
                GetSQLValueString($_POST["not_es_tevisv"], "number"),
                GetSQLValueString($_POST["not_es_tesc"], "number"),
                GetSQLValueString($_POST["not_es_tescn"], "text"),
                GetSQLValueString($_POST["not_es_tescv"], "number"),

                GetSQLValueString($_POST["not_es_teevipa"], "number"),
                GetSQLValueString($_POST["not_es_teevipan"], "text"),
                GetSQLValueString($_POST["not_es_teevipav"], "number"),
                GetSQLValueString($_POST["not_es_tee"], "number"),
                GetSQLValueString($_POST["not_es_teen"], "text"),
                GetSQLValueString($_POST["not_es_teev"], "number"),

                GetSQLValueString($_POST["not_es_tdea"], "number"),
                GetSQLValueString($_POST["not_es_tdean"], "text"),
                GetSQLValueString($_POST["not_es_tdeav"], "number"),
                GetSQLValueString($_POST["not_es_tena"], "number"),
                GetSQLValueString($_POST["not_es_tenan"], "text"),
                GetSQLValueString($_POST["not_es_tenav"], "number"),

                GetSQLValueString($_POST["not_es_teevip"], "number"),
                GetSQLValueString($_POST["not_es_teevipn"], "text"),
                GetSQLValueString($_POST["not_es_teevipv"], "number"),
                GetSQLValueString($_POST["not_es_teup"], "number"),
                GetSQLValueString($_POST["not_es_teupn"], "text"),
                GetSQLValueString($_POST["not_es_teupv"], "number"),

                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // POST ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $u1 = $_POST["not_es_num"];
                $u2 = $_POST["not_es_al"];

                $u3 = $_POST["not_es_tene"];
                $u4 = $_POST["not_es_tenen"];
                $u5 = $_POST["not_es_tenev"];
                $u6 = $_POST["not_es_tevis"];
                $u7 = $_POST["not_es_tevisn"];
                $u8 = $_POST["not_es_tevisv"];

                $u9 = $_POST["not_es_tesc"];
                $u10 = $_POST["not_es_tescn"];
                $u11 = $_POST["not_es_tescv"];
                $u12 = $_POST["not_es_teevipa"];
                $u13 = $_POST["not_es_teevipan"];
                $u14 = $_POST["not_es_teevipav"];

                $u15 = $_POST["not_es_tee"];
                $u16 = $_POST["not_es_teen"];
                $u17 = $_POST["not_es_teev"];
                $u18 = $_POST["not_es_tdea"];
                $u19 = $_POST["not_es_tdean"];
                $u20 = $_POST["not_es_tdeav"];

                $u21 = $_POST["not_es_tena"];
                $u22 = $_POST["not_es_tenan"];
                $u23 = $_POST["not_es_tenav"];
                $u24 = $_POST["not_es_teevip"];
                $u25 = $_POST["not_es_teevipn"];
                $u26 = $_POST["not_es_teevipv"];

                $u27 = $_POST["not_es_teup"];
                $u28 = $_POST["not_es_teupn"];
                $u29 = $_POST["not_es_teupv"];

                // UPDATE ORACLE
                $sql = "UPDATE SNINFESCRITURACION_TRANSACTION SET
                  not_es_num='$u1',
                  not_es_al='$u2',
                  not_es_total='$not_es_total',

                  not_es_tene=$u3,
                  not_es_tenen='$u4',
                  not_es_tenev='$u5',
                  not_es_tevis=$u6,
                  not_es_tevisn='$u7',
                  not_es_tevisv='$u8',

                  not_es_tesc=$u9,
                  not_es_tescn='$u10',
                  not_es_tescv='$u11',
                  not_es_teevipa=$u12,
                  not_es_teevipan='$u13',
                  not_es_teevipav='$u14',

                  not_es_tee=$u15,
                  not_es_teen='$u16',
                  not_es_teev='$u17',
                  not_es_tdea=$u16,
                  not_es_tdean='$u19', 
                  not_es_tdeav='$u20',

                  not_es_tena=$u21,
                  not_es_tenan='$u22',
                  not_es_tenav='$u23',
                  not_es_teevip=$u24,
                  not_es_teevipn='$u25',
                  not_es_teevipv='$u26',

                  not_es_teup=$u27,
                  not_es_teupn='$u28',
                  not_es_teupv='$u29'
                  where id_not_informe=$id";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }
            $query_update = sprintf("SELECT * FROM not_escrituracion WHERE id_not_informe = $id LIMIT 1");
            $update = mysql_query($query_update, $conexion) or die(mysql_error());
            $row_update = mysql_fetch_assoc($update);
            $totalRows_update = mysql_num_rows($update);
            if (0 < $totalRows_update) {
            ?>

              <div class="modal fade" id="pop_not_es" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="not_escrituracion">
                        <!-- REPORTE ESCRITURACION -->
                        <h5><b>ESCRITURACIÓN</b></h5>

                        <table class="table">
                          <tr>
                            <td><span style="font-weight:bold">ESCRITURAS REALIZADAS EN EL MES:</span></td>
                            <td><span class="form-control" disabled><?php echo htmlentities($row_update['not_es_total'], ENT_COMPAT, ''); ?></span></td>
                            <td><span style="font-weight:bold">DEL NUMERO:</span></td>
                            <td><input type="number" class="form-control" name="not_es_num" min="1" value="<?php echo htmlentities($row_update['not_es_num'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">AL NUMERO:</span></td>
                            <td><input type="number" class="form-control" name="not_es_al" min="1" value="<?php echo htmlentities($row_update['not_es_al'], ENT_COMPAT, ''); ?>" required></td>
                          </tr>
                        </table>

                        <table class="table">
                          <tr>
                            <td><span style="font-weight:bold">Total Escrituras No Exentas</span></td>
                            <td><input type="number" class="form-control" name="not_es_tene" value="<?php echo htmlentities($row_update['not_es_tene'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Valor</span></td>
                            <td><input type="number" class="form-control" name="not_es_tenev" value="<?php echo htmlentities($row_update['not_es_tenev'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Numeros</span></td>
                            <td><textarea style="width:250px; height:50px;" name="not_es_tenen" class="form-control" required><?php echo htmlentities($row_update['not_es_tenen'], ENT_COMPAT, ''); ?></textarea></td>
                          </tr>
                          <tr>
                            <td><span style="font-weight:bold">Total Escrituras VIS</span></td>
                            <td><input type="number" class="form-control" name="not_es_tevis" value="<?php echo htmlentities($row_update['not_es_tevis'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Valor</span></td>
                            <td><input type="number" class="form-control" name="not_es_tevisv" value="<?php echo htmlentities($row_update['not_es_tevisv'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Numeros</span></td>
                            <td><textarea style="height:50px;" name="not_es_tevisn" class="form-control" required><?php echo htmlentities($row_update['not_es_tevisn'], ENT_COMPAT, ''); ?></textarea></td>
                          </tr>
                          <tr>
                            <td><span style="font-weight:bold">Total Escrituras Sin Cuantía</span></td>
                            <td><input type="number" class="form-control" name="not_es_tesc" value="<?php echo htmlentities($row_update['not_es_tesc'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Valor</span></td>
                            <td><input type="number" class="form-control" name="not_es_tescv" value="<?php echo htmlentities($row_update['not_es_tescv'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Numeros</span></td>
                            <td><textarea style="height:50px;" name="not_es_tescn" class="form-control" required><?php echo htmlentities($row_update['not_es_tescn'], ENT_COMPAT, ''); ?></textarea></td>
                          </tr>
                          <tr>
                            <td><span style="font-weight:bold">Total Escrituras V.I.P.A.</span></td>
                            <td><input type="number" class="form-control" name="not_es_teevipa" value="<?php echo htmlentities($row_update['not_es_teevipa'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Valor</span></td>
                            <td><input type="number" class="form-control" name="not_es_teevipav" value="<?php echo htmlentities($row_update['not_es_teevipav'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Numeros</span></td>
                            <td><textarea style="height:50px;" name="not_es_teevipan" class="form-control" required><?php echo htmlentities($row_update['not_es_teevipan'], ENT_COMPAT, ''); ?></textarea></td>
                          </tr>
                          <tr>
                            <td><span style="font-weight:bold">Total Escrituras Exentas</span></td>
                            <td><input type="number" class="form-control" name="not_es_tee" value="<?php echo htmlentities($row_update['not_es_tee'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Valor</span></td>
                            <td><input type="number" class="form-control" name="not_es_teev" value="<?php echo htmlentities($row_update['not_es_teev'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Numeros</span></td>
                            <td><textarea style="height:50px;" name="not_es_teen" class="form-control" required><?php echo htmlentities($row_update['not_es_teen'], ENT_COMPAT, ''); ?></textarea></td>
                          </tr>
                          <tr>
                            <td><span style="font-weight:bold">Total Escrituras Aclaración</span></td>
                            <td><input type="number" class="form-control" name="not_es_tdea" value="<?php echo htmlentities($row_update['not_es_tdea'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Valor</span></td>
                            <td><input type="number" class="form-control" name="not_es_tdeav" value="<?php echo htmlentities($row_update['not_es_tdeav'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Numeros</span></td>
                            <td><textarea style="height:50px;" name="not_es_tdean" class="form-control" required><?php echo htmlentities($row_update['not_es_tdean'], ENT_COMPAT, ''); ?></textarea></td>
                          </tr>
                          <tr>
                            <td><span style="font-weight:bold">Total Escrituras NO Autorizadas</span></td>
                            <td><input type="number" class="form-control" name="not_es_tena" value="<?php echo htmlentities($row_update['not_es_tena'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Valor</span></td>
                            <td><input type="number" class="form-control" name="not_es_tenav" value="<?php echo htmlentities($row_update['not_es_tenav'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Numeros</span></td>
                            <td><textarea style="height:50px;" name="not_es_tenan" class="form-control" required><?php echo htmlentities($row_update['not_es_tenan'], ENT_COMPAT, ''); ?></textarea></td>
                          </tr>
                          <tr>
                            <td><span style="font-weight:bold">Total Escrituras V.I.P.</span></td>
                            <td><input type="number" class="form-control" name="not_es_teevip" value="<?php echo htmlentities($row_update['not_es_teevip'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Valor</span></td>
                            <td><input type="number" class="form-control" name="not_es_teevipv" value="<?php echo htmlentities($row_update['not_es_teevipv'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Numeros</span></td>
                            <td><textarea style="height:50px;" name="not_es_teevipn" class="form-control" required><?php echo htmlentities($row_update['not_es_teevipn'], ENT_COMPAT, ''); ?></textarea></td>
                          </tr>
                          <tr>
                            <td><span style="font-weight:bold">Total Escrituras Utilidad Publica</span></td>
                            <td><input type="number" class="form-control" name="not_es_teup" value="<?php echo htmlentities($row_update['not_es_teup'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Valor</span></td>
                            <td><input type="number" class="form-control" name="not_es_teupv" value="<?php echo htmlentities($row_update['not_es_teupv'], ENT_COMPAT, ''); ?>" required></td>
                            <td><span style="font-weight:bold">Numeros</span></td>
                            <td><textarea style="height:50px;" name="not_es_teupn" class="form-control" required><?php echo htmlentities($row_update['not_es_teupn'], ENT_COMPAT, ''); ?></textarea></td>
                          </tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="update_not_es" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($update);

            // DETALLE ESCRITURACION 
            $query = sprintf("SELECT * FROM not_escrituracion where id_not_informe=$id LIMIT 1");
            $select = mysql_query($query, $conexion) or die(mysql_error());
            $row_not_es = mysql_fetch_assoc($select);
            $estado = $row_not_es['estado_not_escrituracion'];

            if (isset($_POST['ingreso_escrituracion'])) {
              $not_es_al = $_POST['not_es_al'];
              $not_es_num = $_POST['not_es_num'];
              $not_es_total = $not_es_al - $not_es_num;
              if ($not_es_total < 0) $not_es_total = -$not_es_total;

              $insertSQL = sprintf(
                "INSERT INTO not_escrituracion (
                  id_not_informe,

                  not_es_num,
                  not_es_al,
                  not_es_total,
                  not_es_tene,
                  not_es_tenen,
                  not_es_tenev,

                  not_es_tevis,
                  not_es_tevisn,
                  not_es_tevisv,
                  not_es_tesc,
                  not_es_tescn,
                  not_es_tescv,

                  not_es_teevipa,
                  not_es_teevipan,
                  not_es_teevipav,
                  not_es_tee,
                  not_es_teen,
                  not_es_teev,

                  not_es_tdea,
                  not_es_tdean,
                  not_es_tdeav,
                  not_es_tena,
                  not_es_tenan,
                  not_es_tenav,

                  not_es_teevip,
                  not_es_teevipn,
                  not_es_teevipv,
                  not_es_teup,
                  not_es_teupn,
                  not_es_teupv
                  
                  ) VALUES (%s, %s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),

                GetSQLValueString($_POST["not_es_num"], "text"),
                GetSQLValueString($_POST["not_es_al"], "text"),
                GetSQLValueString($not_es_total, "number"),
                GetSQLValueString($_POST["not_es_tene"], "number"),
                GetSQLValueString($_POST["not_es_tenen"], "text"),
                GetSQLValueString($_POST["not_es_tenev"], "number"),

                GetSQLValueString($_POST["not_es_tevis"], "number"),
                GetSQLValueString($_POST["not_es_tevisn"], "text"),
                GetSQLValueString($_POST["not_es_tevisv"], "number"),
                GetSQLValueString($_POST["not_es_tesc"], "number"),
                GetSQLValueString($_POST["not_es_tescn"], "text"),
                GetSQLValueString($_POST["not_es_tescv"], "number"),

                GetSQLValueString($_POST["not_es_teevipa"], "number"),
                GetSQLValueString($_POST["not_es_teevipan"], "text"),
                GetSQLValueString($_POST["not_es_teevipav"], "number"),
                GetSQLValueString($_POST["not_es_tee"], "number"),
                GetSQLValueString($_POST["not_es_teen"], "text"),
                GetSQLValueString($_POST["not_es_teev"], "number"),

                GetSQLValueString($_POST["not_es_tdea"], "number"),
                GetSQLValueString($_POST["not_es_tdean"], "text"),
                GetSQLValueString($_POST["not_es_tdeav"], "number"),
                GetSQLValueString($_POST["not_es_tena"], "number"),
                GetSQLValueString($_POST["not_es_tenan"], "text"),
                GetSQLValueString($_POST["not_es_tenav"], "number"),

                GetSQLValueString($_POST["not_es_teevip"], "number"),
                GetSQLValueString($_POST["not_es_teevipn"], "text"),
                GetSQLValueString($_POST["not_es_teevipv"], "number"),
                GetSQLValueString($_POST["not_es_teup"], "number"),
                GetSQLValueString($_POST["not_es_teupn"], "text"),
                GetSQLValueString($_POST["not_es_teupv"], "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              if (1 == $habilitarNotariaInformeOracle) {
                $u1 = $_POST["not_es_num"];
                $u2 = $_POST["not_es_al"];
                // $not_es_total
                $u3 = $_POST["not_es_tene"];
                $u4 = $_POST["not_es_tenen"];
                $u5 = $_POST["not_es_tenev"];

                $u6 = $_POST["not_es_tevis"];
                $u7 = $_POST["not_es_tevisn"];
                $u8 = $_POST["not_es_tevisv"];
                $u9 = $_POST["not_es_tesc"];
                $u10 = $_POST["not_es_tescn"];
                $u11 = $_POST["not_es_tescv"];

                $u12 = $_POST["not_es_teevipa"];
                $u13 = $_POST["not_es_teevipan"];
                $u14 = $_POST["not_es_teevipav"];
                $u15 = $_POST["not_es_tee"];
                $u16 = $_POST["not_es_teen"];
                $u17 = $_POST["not_es_teev"];

                $u18 = $_POST["not_es_tdea"];
                $u19 = $_POST["not_es_tdean"];
                $u20 = $_POST["not_es_tdeav"];
                $u21 = $_POST["not_es_tena"];
                $u22 = $_POST["not_es_tenan"];
                $u23 = $_POST["not_es_tenav"];

                $u24 = $_POST["not_es_teevip"];
                $u25 = $_POST["not_es_teevipn"];
                $u26 = $_POST["not_es_teevipv"];
                $u27 = $_POST["not_es_teup"];
                $u28 = $_POST["not_es_teupn"];
                $u29 = $_POST["not_es_teupv"];

                // INSERT ORACLE
                $sql = "INSERT INTO SNINFESCRITURACION_TRANSACTION(
                  id_not_escrituracion, 
                  id_not_informe, 
                  not_es_num,
                  not_es_al,
                  not_es_total,

                  not_es_tene,
                  not_es_tenen,
                  not_es_tenev,
                  not_es_tevis, 
                  not_es_tevisn,
                  not_es_tevisv,

                  not_es_tesc, 
                  not_es_tescn,
                  not_es_tescv,
                  not_es_teevipa, 
                  not_es_teevipan,
                  not_es_teevipav,

                  not_es_tee, 
                  not_es_teen,
                  not_es_teev,
                  not_es_tdea, 
                  not_es_tdean,
                  not_es_tdeav,

                  not_es_tena, 
                  not_es_tenan,
                  not_es_tenav,
                  not_es_teevip, 
                  not_es_teevipn,
                  not_es_teevipv,

                  not_es_teup, 
                  not_es_teupn,
                  not_es_teupv,
                  fec_ahora_not_es)
                  VALUES 
                  ($idInsert,  $id,  '$u1',  '$u2',  '$not_es_total',
                  $u3,  '$u4',  '$u5',  $u6,  '$u7',  '$u8',
                  $u9,  '$u10',  '$u11',  $u12,  '$u13',  '$u14',
                  $u15,  '$u16',  '$u17',  $u18,  '$u19',  '$u20',
                  $u21,  '$u22',  '$u23',  $u24,  '$u25',  '$u26',
                  $u27,  '$u28',  '$u29',  '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }
              refrescarPage();
            }
            ?>


            <?php // ESTADO PARA FIJAR SI YA HAY UN INGRESO ESCRITURACION
            if ($estado == NULL) {
            ?>

              <form method="POST" name="ingreso_escrituracion">

                <h5><b>ESCRITURACIÓN</b></h5>

                <table class="table">
                  <tr>
                    <td><span style="font-weight:bold">ESCRITURAS REALIZADAS EN EL MES:</span></td>
                    <td></td>
                    <td><span style="font-weight:bold">DEL NUMERO:</span></td>
                    <td><input type="text" class="form-control" name="not_es_num" required></td>
                    <td><span style="font-weight:bold">AL NUMERO</span></td>
                    <td><input type="text" class="form-control" name="not_es_al" required></td>
                  </tr>
                </table>

                <table class="table">
                  <tr>
                    <td><span style="font-weight:bold">Total Escrituras No Exentas</span></td>
                    <td><input type="number" class="form-control" name="not_es_tene" class="form-control" required></td>
                    <td><span style="font-weight:bold">Valor</span></td>
                    <td><input type="number" class="form-control" name="not_es_tenev" class="form-control" required></td>
                    <td><span style="font-weight:bold">Numeros</span></td>
                    <td><textarea style="height:50px;" name="not_es_tenen" class="form-control" required></textarea></td>
                  </tr>
                  <tr>
                    <td><span style="font-weight:bold">Total Escrituras VIS</span></td>
                    <td><input type="number" class="form-control" name="not_es_tevis" class="form-control" required></td>
                    <td><span style="font-weight:bold">Valor</span></td>
                    <td><input type="number" class="form-control" name="not_es_tevisv" class="form-control" required></td>
                    <td><span style="font-weight:bold">Numeros</span></td>
                    <td><textarea style="height:50px;" name="not_es_tevisn" class="form-control" required></textarea></td>
                  </tr>
                  <tr>
                    <td><span style="font-weight:bold">Total Escrituras Sin Cuantía</span></td>
                    <td><input type="number" class="form-control" name="not_es_tesc" class="form-control" required></td>
                    <td><span style="font-weight:bold">Valor</span></td>
                    <td><input type="number" class="form-control" name="not_es_tescv" class="form-control" required></td>
                    <td><span style="font-weight:bold">Numeros</span></td>
                    <td><textarea style="height:50px;" name="not_es_tescn" class="form-control" required></textarea></td>
                  </tr>
                  <tr>
                    <td><span style="font-weight:bold">Total Escrituras V.I.P.A.</span></td>
                    <td><input type="number" class="form-control" name="not_es_teevipa" class="form-control" required></td>
                    <td><span style="font-weight:bold">Valor</span></td>
                    <td><input type="number" class="form-control" name="not_es_teevipav" class="form-control" required></td>
                    <td><span style="font-weight:bold">Numeros</span></td>
                    <td><textarea style="height:50px;" name="not_es_teevipan" class="form-control" required></textarea></td>
                  </tr>
                  <tr>
                    <td><span style="font-weight:bold">Total Escrituras Exentas</span></td>
                    <td><input type="number" class="form-control" name="not_es_tee" class="form-control" required></td>
                    <td><span style="font-weight:bold">Valor</span></td>
                    <td><input type="number" class="form-control" name="not_es_teev" class="form-control" required></td>
                    <td><span style="font-weight:bold">Numeros</span></td>
                    <td><textarea style="height:50px;" name="not_es_teen" class="form-control" required></textarea></td>
                  </tr>
                  <tr>
                    <td><span style="font-weight:bold">Total Escrituras Aclaración</span></td>
                    <td><input type="number" class="form-control" name="not_es_tdea" class="form-control" required></td>
                    <td><span style="font-weight:bold">Valor</span></td>
                    <td><input type="number" class="form-control" name="not_es_tdeav" class="form-control" required></td>
                    <td><span style="font-weight:bold">Numeros</span></td>
                    <td><textarea style="height:50px;" name="not_es_tdean" class="form-control" required></textarea></td>
                  </tr>
                  <tr>
                    <td><span style="font-weight:bold">Total Escrituras NO Autorizadas</span></td>
                    <td><input type="number" class="form-control" name="not_es_tena" class="form-control" required></td>
                    <td><span style="font-weight:bold">Valor</span></td>
                    <td><input type="number" class="form-control" name="not_es_tenav" class="form-control" required></td>
                    <td><span style="font-weight:bold">Numeros</span></td>
                    <td><textarea style="height:50px;" name="not_es_tenan" class="form-control" required></textarea></td>
                  </tr>
                  <tr>
                    <td><span style="font-weight:bold">Total Escrituras V.I.P.</span></td>
                    <td><input type="number" class="form-control" name="not_es_teevip" class="form-control" required></td>
                    <td><span style="font-weight:bold">Valor</span></td>
                    <td><input type="number" class="form-control" name="not_es_teevipv" class="form-control" required></td>
                    <td><span style="font-weight:bold">Numeros</span></td>
                    <td><textarea style="height:50px;" name="not_es_teevipn" class="form-control" required></textarea></td>
                  </tr>
                  <tr>
                    <td><span style="font-weight:bold">Total Escrituras Utilidad Publica</span></td>
                    <td><input type="number" class="form-control" name="not_es_teup" class="form-control" required></td>
                    <td><span style="font-weight:bold">Valor</span></td>
                    <td><input type="number" class="form-control" name="not_es_teupv" class="form-control" required></td>
                    <td><span style="font-weight:bold">Numeros</span></td>
                    <td><textarea style="height:50px;" name="not_es_teupn" class="form-control" required></textarea></td>
                  </tr>
                </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_escrituracion" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <h5><b>ESCRITURACIÓN</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_not_es" title="Modificar Gastos Generales"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> Editar</button></a>
                <?php } ?>
              </h5>

              <table class="table">
                <tr>
                  <td><span style="font-weight:bold">ESCRITURAS REALIZADAS EN EL MES:</span></td>
                  <td><?php echo $row_not_es['not_es_total'] ?></td>
                  <td><span style="font-weight:bold">DEL NUMERO:</span></td>
                  <td><?php echo $row_not_es['not_es_num'] ?></td>
                  <td><span style="font-weight:bold">AL NUMERO</span></td>
                  <td><?php echo $row_not_es['not_es_al'] ?></td>
                </tr>
              </table>

              <table class="table">
                <tr>
                  <td><span style="font-weight:bold">Total Escrituras No Exentas</span></td>
                  <td><?php echo $row_not_es['not_es_tene']; ?></td>
                  <td><span style="font-weight:bold">Valor</span></td>
                  <td><?php echo '$ ' . number_format($row_not_es['not_es_tenev'], 0, ",", "."); ?></td>
                  <td><span style="font-weight:bold">Numeros</span></td>
                  <td><?php echo $row_not_es['not_es_tenen'] ?></td>
                </tr>
                <tr>
                  <td><span style="font-weight:bold">Total Escrituras VIS</span></td>
                  <td><?php echo $row_not_es['not_es_tevis'] ?></td>
                  <td><span style="font-weight:bold">Valor</span></td>
                  <td><?php echo '$ ' . number_format($row_not_es['not_es_tevisv'], 0, ",", "."); ?></td>
                  <td><span style="font-weight:bold">Numeros</span></td>
                  <td><?php echo $row_not_es['not_es_tevisn'] ?></td>
                </tr>
                <tr>
                  <td><span style="font-weight:bold">Total Escrituras Sin Cuantía</span></td>
                  <td><?php echo $row_not_es['not_es_tesc'] ?></td>
                  <td><span style="font-weight:bold">Valor</span></td>
                  <td><?php echo '$ ' . number_format($row_not_es['not_es_tescv'], 0, ",", "."); ?></td>
                  <td><span style="font-weight:bold">Numeros</span></td>
                  <td><?php echo $row_not_es['not_es_tescn'] ?></td>
                </tr>
                <tr>
                  <td><span style="font-weight:bold">Total Escrituras V.I.P.A.</span></td>
                  <td><?php echo $row_not_es['not_es_teevipa'] ?></td>
                  <td><span style="font-weight:bold">Valor</span></td>
                  <td><?php echo '$ ' . number_format($row_not_es['not_es_teevipav'], 0, ",", "."); ?></td>
                  <td><span style="font-weight:bold">Numeros</span></td>
                  <td><?php echo $row_not_es['not_es_teevipan'] ?></td>
                </tr>
                <tr>
                  <td><span style="font-weight:bold">Total Escrituras Exentas</span></td>
                  <td><?php echo $row_not_es['not_es_tee'] ?></td>
                  <td><span style="font-weight:bold">Valor</span></td>
                  <td><?php echo '$ ' . number_format($row_not_es['not_es_teev'], 0, ",", "."); ?></td>
                  <td><span style="font-weight:bold">Numeros</span></td>
                  <td><?php echo $row_not_es['not_es_teen'] ?></td>
                </tr>
                <tr>
                  <td><span style="font-weight:bold">Total Escrituras Aclaración</span></td>
                  <td><?php echo $row_not_es['not_es_tdea'] ?></td>
                  <td><span style="font-weight:bold">Valor</span></td>
                  <td><?php echo '$ ' . number_format($row_not_es['not_es_tdeav'], 0, ",", "."); ?></td>
                  <td><span style="font-weight:bold">Numeros</span></td>
                  <td><?php echo $row_not_es['not_es_tdean'] ?></td>
                </tr>
                <tr>
                  <td><span style="font-weight:bold">Total Escrituras NO Autorizadas</span></td>
                  <td><?php echo $row_not_es['not_es_tena'] ?></td>
                  <td><span style="font-weight:bold">Valor</span></td>
                  <td><?php echo '$ ' . number_format($row_not_es['not_es_tenav'], 0, ",", "."); ?></td>
                  <td><span style="font-weight:bold">Numeros</span></td>
                  <td><?php echo $row_not_es['not_es_tenan'] ?></td>
                </tr>
                <tr>
                  <td><span style="font-weight:bold">Total Escrituras V.I.P.</span></td>
                  <td><?php echo $row_not_es['not_es_teevip'] ?></td>
                  <td><span style="font-weight:bold">Valor</span></td>
                  <td><?php echo '$ ' . number_format($row_not_es['not_es_teevipv'], 0, ",", "."); ?></td>
                  <td><span style="font-weight:bold">Numeros</span></td>
                  <td><?php echo $row_not_es['not_es_teevipn'] ?></td>
                </tr>
                <tr>
                  <td><span style="font-weight:bold">Total Escrituras Utilidad Publica</span></td>
                  <td><?php echo $row_not_es['not_es_teup'] ?></td>
                  <td><span style="font-weight:bold">Valor</span></td>
                  <td><?php echo '$ ' . number_format($row_not_es['not_es_teupv'], 0, ",", "."); ?></td>
                  <td><span style="font-weight:bold">Numeros</span></td>
                  <td><?php echo $row_not_es['not_es_teupn'] ?></td>
                </tr>
              </table>

            <?php } ?>

          </div>
        </div>

        <!-- APORTE -->
        <div class="row">
          <div class="col-md-12">
            <!-- UPDATE DETALLE APORTES -->
            <?php
            if (isset($_POST['update_not_aporte'])) {
              $aporte_cedtp = $_POST["aporte_cedtp"];
              $aporte_pedtp = $_POST["aporte_pedtp"];
              $aporte_vcdtp = $aporte_cedtp * $aporte_pedtp;
              $aporte_50fedndtp = $aporte_vcdtp / 2;
              $aporte_50tsdtp = $aporte_vcdtp / 2;

              $aporte_cedte = $_POST["aporte_cedte"];
              $aporte_prdte = $_POST["aporte_prdte"];
              $aporte_vcdte = $aporte_cedte * $aporte_prdte;
              $aporte_50fedndte = $aporte_vcdte / 2;
              $aporte_50tsdte = $aporte_vcdte / 2;
              $updateSQL = sprintf(
                "UPDATE not_aporte SET 

                  aporte_cedtp=%s,
                  aporte_pedtp=%s,
                  aporte_vcdtp=%s,
                  aporte_50fedndtp=%s,
                  aporte_50tsdtp=%s,
                  aporte_cedte=%s,
                  aporte_prdte=%s,
                  aporte_vcdte=%s,
                  aporte_50fedndte=%s,
                  aporte_50tsdte=%s

                  where id_not_informe=%s",
                GetSQLValueString($aporte_cedtp, "int"),
                GetSQLValueString($aporte_pedtp, "number"),
                GetSQLValueString($aporte_vcdtp, "number"),
                GetSQLValueString($aporte_50fedndtp, "number"),
                GetSQLValueString($aporte_50tsdtp, "number"),

                GetSQLValueString($aporte_cedte, "int"),
                GetSQLValueString($aporte_prdte, "number"),
                GetSQLValueString($aporte_vcdte, "number"),
                GetSQLValueString($aporte_50fedndte, "number"),
                GetSQLValueString($aporte_50tsdte, "number"),

                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $sql = "UPDATE SNINFAPORTES_TRANSACTION SET

                  aporte_cedtp=$aporte_cedtp,
                  aporte_pedtp='$aporte_pedtp',
                  aporte_vcdtp='$aporte_vcdtp',
                  aporte_50fedndtp='$aporte_50fedndtp',
                  aporte_50tsdtp='$aporte_50tsdtp',

                  aporte_cedte=$aporte_cedte,
                  aporte_prdte='$aporte_prdte',
                  aporte_vcdte='$aporte_vcdte',
                  aporte_50fedndte='$aporte_50fedndte',
                  aporte_50tsdte='$aporte_50tsdte'

                  where id_not_informe=$id";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }

            $query_update = sprintf("SELECT * FROM not_aporte where id_not_informe=$id LIMIT 1");
            $update = mysql_query($query_update, $conexion) or die(mysql_error());
            $row_update = mysql_fetch_assoc($update);
            $totalRows_update = mysql_num_rows($update);
            if (0 < $totalRows_update) {
            ?>
              <div class="modal fade" id="pop_aporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="not_aporte">

                        <h5><b>APORTES</b></h5>
                        <table class="table">
                          <tr>
                            <th><span style="font-weight:bold">Clase de Escritura</span></th>
                            <th><span style="font-weight:bold">Cantidad Escrituras</span></th>
                            <th><span style="font-weight:bold">Por Escrituras</span></th>
                            <th><span style="font-weight:bold">Valor Total</span></th>
                            <th><span style="font-weight:bold">50% Fondo Especial de Notariado</span></th>
                            <th><span style="font-weight:bold">50% Tesoreria Supernotariado</span></th>
                          </tr>
                          <tr>
                            <td>De Tarifa Plena</td>
                            <td>
                              <input style="width: 100px;" type="number" class="form-control" name="aporte_cedtp" value="<?php echo htmlentities($row_update['aporte_cedtp'], ENT_COMPAT, ''); ?>" required />
                            </td>
                            <td>
                              <input type="number" class="form-control" name="aporte_pedtp" value="<?php echo htmlentities($row_update['aporte_pedtp'], ENT_COMPAT, ''); ?>" required />
                            </td>
                            <td>
                              <span class="form-control" disabled><?php echo htmlentities($row_update['aporte_vcdtp'], ENT_COMPAT, ''); ?></span>
                            </td>
                            <td>
                              <span class="form-control" disabled><?php echo htmlentities($row_update['aporte_50fedndtp'], ENT_COMPAT, ''); ?></span>
                            </td>
                            <td>
                              <span class="form-control" disabled><?php echo htmlentities($row_update['aporte_50tsdtp'], ENT_COMPAT, ''); ?></span>
                            </td>
                          </tr>
                          <tr>
                            <td>De Tarifa Especial</td>
                            <td>
                              <input style="width: 100px;" type="number" class="form-control" name="aporte_cedte" value="<?php echo htmlentities($row_update['aporte_cedte'], ENT_COMPAT, ''); ?>" required />
                            </td>
                            <td>
                              <input type="number" class="form-control" name="aporte_prdte" value="<?php echo htmlentities($row_update['aporte_prdte'], ENT_COMPAT, ''); ?>" required />
                            </td>
                            <td>
                              <span class="form-control" disabled><?php echo htmlentities($row_update['aporte_vcdte'], ENT_COMPAT, ''); ?></span>
                            </td>
                            <td>
                              <span class="form-control" disabled><?php echo htmlentities($row_update['aporte_50fedndte'], ENT_COMPAT, ''); ?></span>
                            </td>
                            <td>
                              <span class="form-control" disabled><?php echo htmlentities($row_update['aporte_50tsdte'], ENT_COMPAT, ''); ?></span>
                            </td>
                          </tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="update_not_aporte" class="btn btn-success btn-sm">Guardar</button>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($update);
            ?>



            <!-- DETALLE APORTES  -->
            <?php
            $query = sprintf("SELECT * FROM not_aporte WHERE id_not_informe = $id LIMIT 1");
            $select = mysql_query($query, $conexion) or die(mysql_error());
            $row_not_aporte = mysql_fetch_assoc($select);
            $estado = $row_not_aporte['estado_not_aporte'];


            if (isset($_POST['ingreso_aporte'])) {
              $aporte_cedtp = $_POST["aporte_cedtp"];
              $aporte_pedtp = $_POST["aporte_pedtp"];
              $aporte_vcdtp = $aporte_cedtp * $aporte_pedtp;
              $aporte_50fedndtp = $aporte_vcdtp / 2;
              $aporte_50tsdtp = $aporte_vcdtp / 2;

              $aporte_cedte = $_POST["aporte_cedte"];
              $aporte_prdte = $_POST["aporte_prdte"];
              $aporte_vcdte = $aporte_cedte * $aporte_prdte;
              $aporte_50fedndte = $aporte_vcdte / 2;
              $aporte_50tsdte = $aporte_vcdte / 2;
              $insertSQL = sprintf(
                "INSERT INTO not_aporte (
                id_not_informe,

                aporte_cedtp,
                aporte_pedtp,
                aporte_vcdtp,
                aporte_50fedndtp,
                aporte_50tsdtp,

                aporte_cedte,
                aporte_prdte,
                aporte_vcdte,
                aporte_50fedndte,
                aporte_50tsdte) VALUES (%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),

                GetSQLValueString($aporte_cedtp, "int"),
                GetSQLValueString($aporte_pedtp, "number"),
                GetSQLValueString($aporte_vcdtp, "number"),
                GetSQLValueString($aporte_50fedndtp, "number"),
                GetSQLValueString($aporte_50tsdtp, "number"),

                GetSQLValueString($aporte_cedte, "int"),
                GetSQLValueString($aporte_prdte, "number"),
                GetSQLValueString($aporte_vcdte, "number"),
                GetSQLValueString($aporte_50fedndte, "number"),
                GetSQLValueString($aporte_50tsdte, "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $sql = "INSERT INTO SNINFAPORTES_TRANSACTION(
                  id_not_aporte, 
                  id_not_informe, 

                  aporte_cedtp,
                  aporte_pedtp,
                  aporte_vcdtp,
                  aporte_50fedndtp,
                  aporte_50tsdtp,

                  aporte_cedte,
                  aporte_prdte,
                  aporte_vcdte,
                  aporte_50fedndte,
                  aporte_50tsdte,

                  fecha_crea_aporte)
                  VALUES 
                  ($idInsert, $id,

                  $aporte_cedtp, '$aporte_pedtp', '$aporte_vcdtp', '$aporte_50fedndtp', '$aporte_50tsdtp',
                
                  $aporte_cedte, '$aporte_prdte', '$aporte_vcdte', '$aporte_50fedndte', '$aporte_50tsdte',

                  '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }
            ?>


            <?php // ESTADO PARA FIJAR SI YA HAY UN INGRESO APORTES
            if ($estado == NULL) {
            ?>

              <form method="POST" name="ingreso_aporte">

                <hr>
                <h5><b>APORTES</b></h5>
                <div class="box-body">
                  <div class="row">

                    <table class="table">
                      <tr>
                        <th><span style="font-weight:bold">Clase de Escritura</span></th>
                        <th><span style="font-weight:bold">Cantidad Escrituras</span></th>
                        <th><span style="font-weight:bold">Por Escrituras</span></th>
                        <th><span style="font-weight:bold">Valor Total</span></th>
                        <th><span style="font-weight:bold">50% Fondo Especial de Notariado</span></th>
                        <th><span style="font-weight:bold">50% Tesoreria Supernotariado</span></th>
                      </tr>
                      <tr>
                        <td>De Tarifa Plena</td>
                        <td><input type="number" name="aporte_cedtp" class="form-control" required></td>
                        <td><input type="number" name="aporte_pedtp" class="form-control" required></td>
                      </tr>
                      <tr>
                        <td>De Tarifa Especial</td>
                        <td><input type="number" name="aporte_cedte" class="form-control" required></td>
                        <td><input type="number" name="aporte_prdte" class="form-control" required></td>
                      </tr>
                    </table>

                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_aporte" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <hr>
              <h5><b>APORTES</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_aporte" title="Modificar Aportes"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> Editar</button></a>
                <?php } ?>
              </h5>

              <table class="table">
                <tr>
                  <th><span style="font-weight:bold">Clase de Escritura</span></th>
                  <th><span style="font-weight:bold">Cantidad Escrituras</span></th>
                  <th><span style="font-weight:bold">Por Escrituras</span></th>
                  <th><span style="font-weight:bold">Valor Total</span></th>
                  <th><span style="font-weight:bold">50% Fondo Especial de Notariado</span></th>
                  <th><span style="font-weight:bold">50% Tesoreria Supernotariado</span></th>
                </tr>
                <tr>
                  <td>De Tarifa Plena realizar</td>
                  <td><?php echo $row_not_aporte['aporte_cedtp'] ?></td>
                  <td><?php echo $row_not_aporte['aporte_pedtp'] ?></td>
                  <td><?php echo '$ ' . number_format($row_not_aporte['aporte_vcdtp'], 0, ",", ".") ?></td>
                  <td><?php echo '$ ' . number_format($row_not_aporte['aporte_50fedndtp'], 0, ",", ".") ?></td>
                  <td><?php echo '$ ' . number_format($row_not_aporte['aporte_50tsdtp'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td>De Tarifa Especial</td>
                  <td><?php echo $row_not_aporte['aporte_cedte'] ?></td>
                  <td><?php echo $row_not_aporte['aporte_prdte'] ?></td>
                  <td><?php echo '$ ' . number_format($row_not_aporte['aporte_vcdte'], 0, ",", ".") ?></td>
                  <td><?php echo '$ ' . number_format($row_not_aporte['aporte_50fedndte'], 0, ",", ".") ?></td>
                  <td><?php echo '$ ' . number_format($row_not_aporte['aporte_50tsdte'], 0, ",", ".") ?></td>
                </tr>
              </table>

            <?php } ?>
          </div>
        </div>

        <div class="row">
          <!-- RECAUDOS -->
          <div class="col-md-12">
            <h5><b>RECAUDOS</b></h5>
            <?php
            $querynr1 = sprintf("SELECT * FROM not_recaudo where id_not_informe=$id LIMIT 1");
            $selectnr1 = mysql_query($querynr1, $conexion) or die(mysql_error());
            $rownr1 = mysql_fetch_assoc($selectnr1);
            ?>
            <table class="table">
              <tr>
                <td style="width: 400px;"><b>FONDO ESPECIAL DE LA SUPERINTENDENCIA:</b></td>
                <td style="width: 400px;">
                  <?php
                  $total4 =
                    $rownr1['sinc_vcpef50'] +
                    $rownr1['0100_vcpef50'] +
                    $rownr1['100300_vcpef50'] +
                    $rownr1['300500_vcpef50'] +
                    $rownr1['5001000_vcpef50'] +
                    $rownr1['100015000_vcpef50'] +
                    $rownr1['1500ea_vcpef50'];
                  echo '$ ' . number_format((float)$total4, 0, ",", ".");
                  ?>
                </td>
              </tr>
              <tr>
                <td style="width: 400px;""><b>SUPERINTENDENCIA</b></td>
              <td style=" width: 400px;">
                  <?php
                  $total5 =
                    $rownr1['sinc_vcpsnr'] +
                    $rownr1['0100_vcpsnr'] +
                    $rownr1['100300_vcpsnr'] +
                    $rownr1['300500_vcpsnr'] +
                    $rownr1['5001000_vcpsnr'] +
                    $rownr1['100015000_vcpsnr'] +
                    $rownr1['1500ea_vcpsnr'];
                  echo '$ ' . number_format((float)$total5, 0, ",", ".");
                  ?>
                </td>
              </tr>
              <tr>
                <td style="width: 400px;"><b>APORTES ESPECIALES</b></td>
                <td style="width: 400px;">
                  <?php
                  $totalnot_aporte_es = 0;
                  $query423 = sprintf("SELECT * FROM not_aporte_especial where id_not_informe=$id and estado_not_aporte_especial=1");
                  $result23 = $mysqli->query($query423);
                  while ($row23 = $result23->fetch_array(MYSQLI_ASSOC)) {
                    $totalnot_aporte_es += $row23["aportees_va"];
                  }
                  echo '$ ' . number_format($totalnot_aporte_es, 0, ",", ".");
                  ?>
                </td>
              </tr>
            </table>
          </div>
        </div>

        <div class="row">
          <!-- INGRESOS -->
          <div class="col-md-12">
            <h5><b>INGRESOS</b></h5>
            <table class="table">
              <tr>
                <?php
                $totalnot_detalle_ingreso_escrituracion1 = 0;
                $query423 = sprintf("SELECT * FROM not_detalle_ingreso_escrituracion where id_not_informe=$id and estado_not_detalle_ingreso_escrituracion=1 ORDER BY nombre_acto ASC");
                $result23 = $mysqli->query($query423);
                while ($row23 = $result23->fetch_array(MYSQLI_ASSOC)) {
                  $totalnot_detalle_ingreso_escrituracion1 += $row23["valor_acto"];
                }
                ?>
                <td style="width: 400px;"><b>POR ESCRITURACIÓN:</b></td>
                <td style="width: 400px;">
                  <?php echo '$ ' . number_format($totalnot_detalle_ingreso_escrituracion1, 0, ",", ".") ?>
                </td>
              </tr>
              <tr>
                <?php
                $totalnot_ingreso_conceptos_varios = 0;
                $query4232 = sprintf("SELECT * FROM not_ingreso_conceptos_varios where id_not_informe=$id and estado_not_ingreso_conceptos_varios=1 ORDER BY nombre_acto_varios ASC");
                $result232 = $mysqli->query($query4232);
                while ($row232 = $result232->fetch_array(MYSQLI_ASSOC)) {
                  $totalnot_ingreso_conceptos_varios += $row232["valor_acto_varios"];
                }
                ?>
                <td style="width: 400px;"><b>POR CONCEPTOS VARIOS:</b></td>
                <td style="width: 400px;">
                  <?php echo '$ ' . number_format($totalnot_ingreso_conceptos_varios, 0, ",", ".") ?>
                </td>
              </tr>
              <tr>
                <td style="width: 400px;"><b>TOTAL INGRESOS:</b></td>
                <td>
                  <?php
                  $totalIngresos = $totalnot_detalle_ingreso_escrituracion1 + $totalnot_ingreso_conceptos_varios;
                  echo '$ ' . number_format($totalIngresos, 0, ",", ".")
                  ?>
                </td>
              </tr>
            </table>

          </div>
        </div>

        <!-- APORTES ESPECIALES -->
        <div class="row">
          <div class="col-md-12">
            <!-- MODAL DE INGRESO APORTES ESPECIALES -->
            <?php
            if (isset($_POST['regis_aporte_es'])) {

              $insertSQL = sprintf(
                "INSERT INTO not_aporte_especial (
                id_not_informe,

                aportees_es,
                aportees_fec,
                aportees_ve,
                aportees_va) VALUES (%s, %s,%s,%s,%s)",
                GetSQLValueString($id, "int"),

                GetSQLValueString($_POST["aportees_es"], "text"),
                GetSQLValueString($_POST["aportees_fec"], "date"),
                GetSQLValueString($_POST["aportees_ve"], "number"),
                GetSQLValueString($_POST["aportees_va"], "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["aportees_es"];
                $c2 = $_POST["aportees_fec"];
                $c3 = $_POST["aportees_ve"];
                $c4 = $_POST["aportees_va"];
                $date = date_create($c2);
                $fechac2 = date_format($date, "d/m/y");

                $sql = "INSERT INTO SNINFAPORTES_ESP_TRANSACTION(
                    id_not_aporte_especial,
                    id_not_informe, 

                    aportees_es,
                    aportees_fec, 
                    aportees_ve,
                    aportees_va,

                    fec_ahora_aporte_es)
                  VALUES 
                  ($idInsert, $id,
                  '$c1', '$fechac2', $c3, $c4,
                  '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }
            ?>

            <div class="modal fade" id="popagregaraportesespeciales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div id="nuevaAventura" class="modal-body">
                    <h5><b>APORTES ESPECIALES</b></h5>
                    <form id="formaporteespecial" action="" method="POST" name="aporte_especial">

                      <table class="table">
                        <tr>
                          <th><b>Escritura No<b></th>
                          <th><b>Fecha<b></th>
                          <th><b>Valor Escritura<b></th>
                          <th><b>Valor Aporte<b></th>
                        </tr>
                        <tr>
                          <td><input type="text" name="aportees_es" class="form-control" required /></td>
                          <td><input type="date" class="form-control" name="aportees_fec" required /></td>
                          <td><input type="number" class="form-control" name="aportees_ve" placeholder="0" required /></td>
                          <td><input type="number" class="form-control" name="aportees_va" placeholder="0" required /></td>
                        </tr>
                      </table>

                      <div class="modal-footer">
                        <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal" onClick="this.form.reset()">Cancelar</button>
                        <button type="submit" name="regis_aporte_es" class="btn btn-success btn-sm">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- DETALLE APORTES ESPECIALES -->
            <hr>
            <h5><b>APORTES ESPECIALES</b>
              <span>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" data-toggle="modal" data-target="#popagregaraportesespeciales" title="Incluir facturas"> <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>
                <?php } ?>
              </span>
            </h5>

            <table class="table">
              <tr>
                <th><b>Escritura No<b></th>
                <th><b>Fecha<b></th>
                <th><b>Valor Escritura<b></th>
                <th><b>Valor Aporte<b></th>
                <th><b>Accion<b></th>
              </tr>
              <?php
              if (isset($_POST['update_aporte_es'])) {
                $updateSQL = sprintf(
                  "UPDATE not_aporte_especial SET
  
                      aportees_es=%s,
                      aportees_fec=%s,
                      aportees_ve=%s,
                      aportees_va=%s
              
                    where id_not_informe=%s AND id_not_aporte_especial=%s",
                  GetSQLValueString($_POST["aportees_es"], "text"),
                  GetSQLValueString($_POST["aportees_fec"], "date"),
                  GetSQLValueString($_POST["aportees_ve"], "number"),
                  GetSQLValueString($_POST["aportees_va"], "number"),

                  GetSQLValueString($id, "int"),
                  GetSQLValueString($_POST["id_not_aporte_especial"], "int")
                );
                $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

                // UPDATE ORACLE
                if (1 == $habilitarNotariaInformeOracle) {
                  $c1 = $_POST["aportees_es"];
                  $c2 = $_POST["aportees_fec"];
                  $c3 = $_POST["aportees_ve"];
                  $c4 = $_POST["aportees_va"];
                  $c5 = $_POST["id_not_aporte_especial"];
                  $date = date_create($c2);
                  $fechac2 = date_format($date, "d/m/y");

                  $sql = "UPDATE SNINFAPORTES_ESP_TRANSACTION  SET 

                    aportees_es=$c1,
                    aportees_fec='$fechac2',
                    aportees_ve=$c3,
                    aportees_va=$c4

                    WHERE id_not_informe=$id AND id_not_aporte_especial=$c5";
                  $stmt = $getConection->prepare($sql);
                  $stmt->execute();
                }

                refrescarPage();
              }
              // DECLARACION DE VARIABLE TOTAL DE APORTES ESPECIALES
              $totalnot_aporte_es = 0;
              $fechacongmes = '';
              $query423 = sprintf("SELECT * FROM not_aporte_especial where id_not_informe=$id and estado_not_aporte_especial=1");
              $result23 = $mysqli->query($query423);
              while ($row23 = $result23->fetch_array(MYSQLI_ASSOC)) {
                $totalnot_aporte_es += $row23["aportees_va"];
              ?>
                <tr>
                  <td><?php echo $row23["aportees_es"] ?></td>
                  <td><?php echo $row23["aportees_fec"] ?></td>
                  <td><?php echo '$ ' . number_format($row23["aportees_ve"], 0, ",", ".") ?></td>
                  <td><?php echo '$ ' . number_format($row23["aportees_va"], 0, ",", ".") ?></td>
                  <td>
                    <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) { ?>
                      <a style="float:right; margin-right:30px;" title="Borrar" name="not_aporte_especial" id="<?php echo $row23['id_not_aporte_especial']; ?>" class="borrar_f"><button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> </button></a>

                      <a href="" style="float:right; margin-right:10px;" id="<?php echo $row23['id_not_aporte_especial']; ?>" class="notariaaporteespecialeditar" data-toggle="modal" data-target="#modalnotariaaporteespecialeditar" title="Editar"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> </button></a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </table>

            <table class="table">
              <tr>
                <td><b>Total Consignado Mes</b></td>
                <td><b><?php echo '$ ' . number_format($totalnot_aporte_es, 0, ",", ".") ?></b></td>
              </tr>
            </table>

            <div class="modal fade" id="modalnotariaaporteespecialeditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Editar</h4>
                  </div>
                  <div class="modal-body" id="divnotariaaporteespecialeditar">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- DETALLE DE INGRESOS POR ESCRITURACION -->
        <div class="row">
          <div class="col-md-12">
            <!-- MODAL DE INGRESO DETALLE DE INGRESOS POR ESCRITURACION -->
            <?php

            if (isset($_POST['registro_detalle_ingreso_escrituracion'])) {
              $codigoNombreActos = $_POST['codigo_not_actos'];
              $cNa = explode('-', $codigoNombreActos);
              $codigoActo = $cNa[0];
              $NombreActo = $cNa[1];

              $insertSQL = sprintf(
                "INSERT INTO not_detalle_ingreso_escrituracion (
                  id_not_informe,

                  codigo_acto,
                  nombre_acto,
                  cantidad_acto,
                  valor_acto

                  ) VALUES (%s, %s,%s,%s,%s)",
                GetSQLValueString($id, "int"),

                GetSQLValueString($codigoActo, "text"),
                GetSQLValueString($NombreActo, "text"),
                GetSQLValueString($_POST["cantidad_acto"], "number"),
                GetSQLValueString($_POST["valor_acto"], "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["cantidad_acto"];
                $c2 = $_POST["valor_acto"];

                $sql = "INSERT INTO SNINDET_ING_ESC_TRANSACTION(
                  id_not_detalle_ingreso_escrituracion,
                  id_not_informe, 

                  codigo_acto,
                  nombre_acto,
                  cantidad_acto,
                  valor_acto,

                  fecha_ahora_acto)
                VALUES 
                ($idInsert, $id, '$codigoActo', '$NombreActo', $c1, $c2, '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }
            ?>
            <script type="text/javascript">
              $(function() {
                $("#buscadorien").select2({
                  dropdownParent: $('#popdetalleingresosescrituracion')
                });
              });
            </script>

            <div class="modal fade" id="popdetalleingresosescrituracion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-body">

                    <h5><b>DETALLE DE INGRESOS POR ESCRITURACION</b></h5>
                    <form id="formaporteespecial" action="" method="POST" name="aporte_especial">
                      <span style="font-weight:bold">Nombre del Acto</span>
                      <select id="buscadorien" style="width:100%" name="codigo_not_actos">
                        <option value="">Seleccionar</option>

                        <?php
                        $queryactos423 = sprintf("SELECT * FROM not_actos where tipo_actos_conceptos=1 and estado_not_actos=1 ORDER BY codigo_not_actos ASC");
                        $resultactos25 = $mysqli->query($queryactos423);
                        while ($rowactos23 = $resultactos25->fetch_array(MYSQLI_ASSOC)) {
                          echo '<option value="' . $rowactos23["codigo_not_actos"] . '-' . $rowactos23["nombre_not_actos"] . '">' . $rowactos23["codigo_not_actos"] . ' ' . $rowactos23["nombre_not_actos"] . '</option>';
                        }
                        ?>
                      </select>
                      <table class="table">
                        <tr>
                          <th><span style="font-weight:bold">Cantidad</span></th>
                          <th><span style="font-weight:bold">Valor</span></th>
                        </tr>
                        <tr>
                          <td><input type="number" class="form-control" name="cantidad_acto" required /></td>
                          <td><input type="number" class="form-control" name="valor_acto" placeholder="0" required /></td>
                        </tr>
                      </table>

                      <div class="modal-footer">
                        <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal" onClick="this.form.reset()">Cancelar</button>
                        <button type="submit" name="registro_detalle_ingreso_escrituracion" class="btn btn-success btn-sm">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- DETALLE DETALLE DE INGRESOS POR ESCRITURACION -->
            <hr>
            <h5><b>DETALLE DE INGRESOS POR ESCRITURACION</b>
              <span>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" data-toggle="modal" data-target="#popdetalleingresosescrituracion" title="Incluir facturas"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar </button></a>
                <?php } ?>
              </span>
            </h5>

            <table class="table">
              <tr>
                <th><span style="font-weight:bold">Codigo Acto</span></th>
                <th><span style="font-weight:bold">Nombre Acto</span></th>
                <th><span style="font-weight:bold">Cantidad</span></th>
                <th><span style="font-weight:bold">Valor</span></th>
                <th><span style="font-weight:bold">Accion</span></th>
              </tr>
              <?php
              if (isset($_POST['update_detalle_ingreso_escrituracion'])) {
                $codigoNombreActos = $_POST['codigo_not_actos'];
                echo $codigoNombreActos;
                $cNa = explode('-', $codigoNombreActos);
                $codigoActo = $cNa[0];
                $NombreActo = $cNa[1];

                $updateSQL = sprintf(
                  "UPDATE not_detalle_ingreso_escrituracion SET

                    codigo_acto=%s,
                    nombre_acto=%s,
                    cantidad_acto=%s,
                    valor_acto=%s

                  WHERE id_not_informe=%s AND id_not_detalle_ingreso_escrituracion=%s",
                  GetSQLValueString($codigoActo, "text"),
                  GetSQLValueString($NombreActo, "text"),
                  GetSQLValueString($_POST["cantidad_acto"], "number"),
                  GetSQLValueString($_POST["valor_acto"], "number"),

                  GetSQLValueString($id, "int"),
                  GetSQLValueString($_POST["id_not_detalle_ingreso_escrituracion"], "int")
                );
                $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

                // UPDATE ORACLE
                if (1 == $habilitarNotariaInformeOracle) {
                  $c1 = $_POST["cantidad_acto"];
                  $c2 = $_POST["valor_acto"];
                  $c3 = $_POST["id_not_detalle_ingreso_escrituracion"];
                  $sql = "UPDATE SNINDET_ING_ESC_TRANSACTION  SET 

                    codigo_acto='$codigoActo',
                    nombre_acto='$NombreActo',
                    cantidad_acto=$c1,
                    valor_acto=$c2

                  WHERE id_not_informe=$id AND id_not_detalle_ingreso_escrituracion=$c3";
                  $stmt = $getConection->prepare($sql);
                  $stmt->execute();
                }

                refrescarPage();
              }
              // DECLARACION DE VARIABLE TOTAL DE DETALLE DE INGRESOS POR ESCRITURACION
              $totalnot_detalle_ingreso_escrituracion = 0;
              $fechacongmes = '';
              $query423 = sprintf("SELECT * FROM not_detalle_ingreso_escrituracion where id_not_informe=$id and estado_not_detalle_ingreso_escrituracion=1 ORDER BY nombre_acto ASC");
              $result23 = $mysqli->query($query423);
              while ($row23 = $result23->fetch_array(MYSQLI_ASSOC)) {
                $totalnot_detalle_ingreso_escrituracion += $row23["valor_acto"];
              ?>
                <tr>
                  <td><?php echo $row23["codigo_acto"] ?></td>
                  <td><?php echo $row23["nombre_acto"] ?></td>
                  <td><?php echo number_format($row23["cantidad_acto"], 0, ",", ".") ?></td>
                  <td><?php echo '$ ' . number_format($row23["valor_acto"], 0, ",", ".") ?></td>
                  <td>
                    <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) { ?>
                      <a style="float:right; margin-right:30px;" title="Borrar" name="not_detalle_ingreso_escrituracion" id="<?php echo $row23['id_not_detalle_ingreso_escrituracion']; ?>" class="borrar_f"><button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> </button></a>

                      <a href="" style="float:right; margin-right:10px;" id="<?php echo $row23['id_not_detalle_ingreso_escrituracion']; ?>" class="notariadetalleingresoescrituracioneditar" data-toggle="modal" data-target="#modalnotariadetalleingresoescrituracioneditar" title="Editar"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> </button></a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </table>

            <table class="table">
              <tr>
                <td><b>Total Consignado Mes</b></td>
                <td><b><?php echo '$ ' . number_format($totalnot_detalle_ingreso_escrituracion, 0, ",", ".") ?></b></td>
              </tr>
            </table>

            <div class="modal fade" id="modalnotariadetalleingresoescrituracioneditar" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Editar</h4>
                  </div>
                  <div class="modal-body" id="divnotariadetalleingresoescrituracioneditar">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- DETALLE DE INGRESOS POR CONCEPTOS VARIOS -->
          <div class="col-md-12">
            <!-- MODAL DE DETALLE DE INGRESOS POR CONCEPTOS VARIOS -->
            <?php
            if (isset($_POST['registro_ingreso_conceptos_varios'])) {
              $codigoNombreActos = $_POST['codigo_not_actos_varios'];
              $cNa = explode('-', $codigoNombreActos);
              $codigoActo = $cNa[0];
              $NombreActo = $cNa[1];

              $insertSQL = sprintf(
                "INSERT INTO not_ingreso_conceptos_varios (
                id_not_informe,

                codigo_acto_varios,
                nombre_acto_varios,
                cantidad_acto_varios,
                valor_acto_varios

                ) VALUES (%s, %s,%s,%s,%s)",
                GetSQLValueString($id, "int"),

                GetSQLValueString($codigoActo, "text"),
                GetSQLValueString($NombreActo, "text"),
                GetSQLValueString($_POST["cantidad_acto_varios"], "number"),
                GetSQLValueString($_POST["valor_acto_varios"], "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["cantidad_acto_varios"];
                $c2 = $_POST["valor_acto_varios"];
                $sql = "INSERT INTO SNINDET_ING_CONVAR_TRANSACTION(
                  id_not_ingreso_conceptos_varios,
                  id_not_informe,

                  codigo_acto_varios,
                  nombre_acto_varios,
                  cantidad_acto_varios,
                  valor_acto_varios,

                  fecha_ahora_acto_varios)
                VALUES 
                ($idInsert, $id, '$codigoActo', '$NombreActo', $c1, $c2, '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }
            ?>
            <script type="text/javascript">
              $(function() {
                $("#buscadorotrosien").select2({
                  dropdownParent: $('#popdetalleingresosescrituracionotros')
                });
              });
            </script>

            <div class="modal fade" id="popdetalleingresosescrituracionotros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div id="nuevaAventura" class="modal-body">
                    <h5><b>DETALLE DE INGRESOS POR CONCEPTOS VARIOS</b></h5>
                    <form id="formaporteespecialotro" action="" method="POST" name="aporte_especial">
                      <span style="font-weight:bold">Nombre del Acto</span>
                      <select id="buscadorotrosien" style="width:100%" name="codigo_not_actos_varios">
                        <option value="">Seleccionar</option>

                        <?php
                        $queryactos423 = sprintf("SELECT * FROM not_actos where tipo_actos_conceptos=2 and estado_not_actos=1 ORDER BY codigo_not_actos ASC");
                        $resultactos25 = $mysqli->query($queryactos423);
                        while ($rowactos23 = $resultactos25->fetch_array(MYSQLI_ASSOC)) {
                          echo '<option value="' . $rowactos23["codigo_not_actos"] . '-' . $rowactos23["nombre_not_actos"] . '">' . $rowactos23["codigo_not_actos"] . ' ' . $rowactos23["nombre_not_actos"] . '</option>';
                        }
                        ?>
                      </select>
                      <table class="table">
                        <tr>
                          <th><span style="font-weight:bold">Cantidad</span></th>
                          <th><span style="font-weight:bold">Valor</span></th>
                        </tr>
                        <tr>
                          <td><input type="number" class="form-control" name="cantidad_acto_varios" required /></td>
                          <td><input type="number" class="form-control" name="valor_acto_varios" placeholder="0" required /></td>
                        </tr>
                      </table>

                      <div class="modal-footer">
                        <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal" onClick="this.form.reset()">Cancelar</button>
                        <button type="submit" name="registro_ingreso_conceptos_varios" class="btn btn-success btn-sm">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- DETALLE DE INGRESOS POR CONCEPTOS VARIOSN -->
            <hr>
            <h5><b>DETALLE DE INGRESOS POR CONCEPTOS VARIOS</b>
              <span>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" data-toggle="modal" data-target="#popdetalleingresosescrituracionotros" title="Incluir facturas"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>
                <?php } ?>
              </span>
            </h5>

            <table class="table">
              <tr>
                <th><span style="font-weight:bold">Codigo Acto</span></th>
                <th><span style="font-weight:bold">Nombre Acto</span></th>
                <th><span style="font-weight:bold">Cantidad</span></th>
                <th><span style="font-weight:bold">Valor</span></th>
                <th><span style="font-weight:bold">Accion</span></th>
              </tr>
              <?php
              if (isset($_POST['update_ingreso_conceptos_varios'])) {
                $codigoNombreActos = $_POST['codigo_not_actos_varios'];
                $codigoNombreActos;
                $cNa = explode('-', $codigoNombreActos);
                $codigoActo = $cNa[0];
                $NombreActo = $cNa[1];

                $updateSQL = sprintf(
                  "UPDATE not_ingreso_conceptos_varios SET
  
                    codigo_acto_varios=%s,
                    nombre_acto_varios=%s,
                    cantidad_acto_varios=%s,
                    valor_acto_varios=%s
              
                  WHERE id_not_informe=%s AND id_not_ingreso_conceptos_varios=%s",
                  GetSQLValueString($codigoActo, "text"),
                  GetSQLValueString($NombreActo, "text"),
                  GetSQLValueString($_POST["cantidad_acto_varios"], "number"),
                  GetSQLValueString($_POST["valor_acto_varios"], "number"),

                  GetSQLValueString($id, "int"),
                  GetSQLValueString($_POST["id_not_ingreso_conceptos_varios"], "int")
                );
                $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

                // UPDATE ORACLE
                if (1 == $habilitarNotariaInformeOracle) {
                  $c1 = $_POST["cantidad_acto_varios"];
                  $c2 = $_POST["valor_acto_varios"];
                  $c3 = $_POST["id_not_ingreso_conceptos_varios"];
                  $sql = "UPDATE SNINDET_ING_CONVAR_TRANSACTION  SET 

                    codigo_acto_varios='$codigoActo',
                    nombre_acto_varios='$NombreActo',
                    cantidad_acto_varios=$c1,
                    valor_acto_varios=$c2

                  WHERE id_not_informe=$id AND id_not_ingreso_conceptos_varios=$c3";
                  $stmt = $getConection->prepare($sql);
                  $stmt->execute();
                }

                refrescarPage();
              }
              // DECLARACION DE VARIABLE TOTAL DE DETALLE DE INGRESOS POR CONCEPTOS VARIOS
              $totalnot_detalle_ingreso_escrituracion = 0;
              $fechacongmes = '';
              $query423 = sprintf("SELECT * FROM not_ingreso_conceptos_varios where id_not_informe=$id and estado_not_ingreso_conceptos_varios=1 ORDER BY nombre_acto_varios ASC");
              $result23 = $mysqli->query($query423);
              while ($row23 = $result23->fetch_array(MYSQLI_ASSOC)) {
                $totalnot_detalle_ingreso_escrituracion += $row23["valor_acto_varios"];
              ?>
                <tr>
                  <td><?php echo $row23["codigo_acto_varios"] ?></td>
                  <td><?php echo $row23["nombre_acto_varios"] ?></td>
                  <td><?php echo number_format($row23["cantidad_acto_varios"], 0, ",", ".") ?></td>
                  <td><?php echo '$ ' . number_format($row23["valor_acto_varios"], 0, ",", ".") ?></td>
                  <td>
                    <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) { ?>
                      <a style="float:right; margin-right:30px;" title="Borrar" name="not_ingreso_conceptos_varios" id="<?php echo $row23['id_not_ingreso_conceptos_varios']; ?>" class="borrar_f"><button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> </button></a>

                      <a href="" style="float:right; margin-right:10px;" id="<?php echo $row23['id_not_ingreso_conceptos_varios']; ?>" class="notariaotrosactosnotarialeseditar" data-toggle="modal" data-target="#modalnotariaotrosactosnotarialeseditar" title="Editar"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> </button></a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </table>

            <table class="table">
              <tr>
                <td><b>Total Consignado Mes</b></td>
                <td><b><?php echo '$ ' . number_format($totalnot_detalle_ingreso_escrituracion, 0, ",", ".") ?></b></td>
              </tr>
            </table>

            <div class="modal fade" id="modalnotariaotrosactosnotarialeseditar" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Editar</h4>
                  </div>
                  <div class="modal-body" id="divnotariaotrosactosnotarialeseditar">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <!-- DETALLE GASTOS GENERALES -->
          <div class="col-md-6">
            <!-- UPDATE DETALLE GASTOS GENERALES -->
            <?php
            if (isset($_POST['update_detalles_gastos_generales'])) {

              $updateSQL = sprintf(
                "UPDATE not_detalle_gastos_generales SET 

                  dgg_finan=%s,
                  dgg_mante=%s,
                  dgg_arren=%s,
                  dgg_serpu=%s,
                  dgg_segur=%s,
                  dgg_utypa=%s,
                  dgg_empal=%s,
                  dgg_biene=%s,
                  dgg_otros=%s,
                  dgg_papel_notarial=%s
                WHERE id_not_informe=%s",

                GetSQLValueString($_POST["dgg_finan"], "number"),
                GetSQLValueString($_POST["dgg_mante"], "number"),
                GetSQLValueString($_POST["dgg_arren"], "number"),
                GetSQLValueString($_POST["dgg_serpu"], "number"),
                GetSQLValueString($_POST["dgg_segur"], "number"),
                GetSQLValueString($_POST["dgg_utypa"], "number"),
                GetSQLValueString($_POST["dgg_empal"], "number"),
                GetSQLValueString($_POST["dgg_biene"], "number"),
                GetSQLValueString($_POST["dgg_otros"], "number"),
                GetSQLValueString($_POST["dgg_papel_notarial"], "number"),

                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["dgg_finan"];
                $c2 = $_POST["dgg_mante"];
                $c3 = $_POST["dgg_arren"];
                $c4 = $_POST["dgg_serpu"];
                $c5 = $_POST["dgg_segur"];

                $c6 = $_POST["dgg_utypa"];
                $c7 = $_POST["dgg_empal"];
                $c8 = $_POST["dgg_biene"];
                $c9 = $_POST["dgg_otros"];
                $c10 = $_POST["dgg_papel_notarial"];
                $sql = "UPDATE SNINDET_GASTOS_G_TRANSACTION  SET 

                  dgg_finan=$c1,
                  dgg_mante=$c2,
                  dgg_arren=$c3,
                  dgg_serpu=$c4,
                  dgg_segur=$c5,

                  dgg_utypa=$c6,
                  dgg_empal=$c7,
                  dgg_biene=$c8,
                  dgg_otros=$c9,
                  dgg_papel_notarial=$c10
                WHERE id_not_informe=$id";

                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }

            $querydgg = sprintf("SELECT * FROM not_detalle_gastos_generales WHERE id_not_informe = $id LIMIT 1");
            $updatedgg = mysql_query($querydgg, $conexion) or die(mysql_error());
            $rowdgg = mysql_fetch_assoc($updatedgg);
            $totalRowsdgg = mysql_num_rows($updatedgg);
            if (0 < $totalRowsdgg) {
            ?>

              <div class="modal fade" id="popdetallegastosgenerales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="not_detalle_gastos_generales">

                        <h5><b>DETALLE GASTOS GENERALES</b></h5>

                        <table class="table">
                          <tr>
                            <td><b>FINANCIEROS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_finan" value="<?php echo htmlentities($rowdgg['dgg_finan'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          <tr>
                            <td><b>MANTENIMIENTO DE EQUIPOS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_mante" value="<?php echo htmlentities($rowdgg['dgg_mante'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>ARRENDAMIENTOS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_arren" value="<?php echo htmlentities($rowdgg['dgg_arren'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>SERVICIOS PUBLICOS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_serpu" value="<?php echo htmlentities($rowdgg['dgg_serpu'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>SEGUROS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_segur" value="<?php echo htmlentities($rowdgg['dgg_segur'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>UTILES Y PAPELERIA</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_utypa" value="<?php echo htmlentities($rowdgg['dgg_utypa'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>EMPASTE LIBROS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_empal" value="<?php echo htmlentities($rowdgg['dgg_empal'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>BIENESTAR</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_biene" value="<?php echo htmlentities($rowdgg['dgg_biene'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>OTROS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_otros" value="<?php echo htmlentities($rowdgg['dgg_otros'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>PAPEL NOTARIAL</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgg_papel_notarial" value="<?php echo htmlentities($rowdgg['dgg_papel_notarial'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="update_detalles_gastos_generales" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($updatedgg);


            $querydgg1 = sprintf("SELECT * FROM not_detalle_gastos_generales where id_not_informe =$id LIMIT 1");
            $selectdgg1 = mysql_query($querydgg1, $conexion) or die(mysql_error());
            $rowdgg1 = mysql_fetch_assoc($selectdgg1);
            $estado = $rowdgg1['estado_not_detalle_gastos_generales'];

            if (isset($_POST['ingreso_not_detalle_gastos_generales'])) {

              $insertSQL = sprintf(
                "INSERT INTO not_detalle_gastos_generales (
                id_not_informe,
                dgg_finan,
                dgg_mante,
                dgg_arren,
                dgg_serpu,

                dgg_segur,
                dgg_utypa,
                dgg_empal,
                dgg_biene,
                dgg_otros,
                dgg_papel_notarial) VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST["dgg_finan"], "number"),
                GetSQLValueString($_POST["dgg_mante"], "number"),
                GetSQLValueString($_POST["dgg_arren"], "number"),
                GetSQLValueString($_POST["dgg_serpu"], "number"),
                GetSQLValueString($_POST["dgg_segur"], "number"),

                GetSQLValueString($_POST["dgg_utypa"], "number"),
                GetSQLValueString($_POST["dgg_empal"], "number"),
                GetSQLValueString($_POST["dgg_biene"], "number"),
                GetSQLValueString($_POST["dgg_otros"], "number"),
                GetSQLValueString($_POST["dgg_papel_notarial"], "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["dgg_finan"];
                $c2 = $_POST["dgg_mante"];
                $c3 = $_POST["dgg_arren"];
                $c4 = $_POST["dgg_serpu"];
                $c5 = $_POST["dgg_segur"];

                $c6 = $_POST["dgg_utypa"];
                $c7 = $_POST["dgg_empal"];
                $c8 = $_POST["dgg_biene"];
                $c9 = $_POST["dgg_otros"];
                $c10 = $_POST["dgg_papel_notarial"];
                $sql = "INSERT INTO SNINDET_GASTOS_G_TRANSACTION(
                  id_not_detalle_gastos_generales,
                  id_not_informe,

                  dgg_finan,
                  dgg_mante,
                  dgg_arren,
                  dgg_serpu,
                  dgg_segur,

                  dgg_utypa,
                  dgg_empal,
                  dgg_biene,
                  dgg_otros,
                  dgg_papel_notarial,

                  fec_ahora_dgg)
                  VALUES 
                  ($idInsert,$id,
                  '$c1','$c2','$c3','$c4','$c5',
                  '$c6','$c7','$c8','$c9','$c10',
                  '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            if ($estado == 0) {
            ?>

              <form method="POST" name="ingreso_not_detalle_gastos_generales">
                <hr>
                <h5><b> DETALLE GASTOS GENERALES </b></h5>

                <table class="table">
                  <tr>
                    <td><b>FINANCIEROS</b></td>
                    <td><input type="number" class="form-control" name="dgg_finan" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>MANTENIMIENTO DE EQUIPOS</b></td>
                    <td><input type="number" class="form-control" name="dgg_mante" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>ARRENDAMIENTOS</b></td>
                    <td><input type="number" class="form-control" name="dgg_arren" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>SERVICIOS PUBLICOS</b></td>
                    <td><input type="number" class="form-control" name="dgg_serpu" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>SEGUROS</b></td>
                    <td><input type="number" class="form-control" name="dgg_segur" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>UTILES Y PAPELERIA</b></td>
                    <td><input type="number" class="form-control" name="dgg_utypa" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>EMPASTE LIBROS</b></td>
                    <td><input type="number" class="form-control" name="dgg_empal" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>BIENESTAR</b></td>
                    <td><input type="number" class="form-control" name="dgg_biene" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>OTROS</b></td>
                    <td><input type="number" class="form-control" name="dgg_otros" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>PAPEL NOTARIAL</b></td>
                    <td><input type="number" class="form-control" name="dgg_papel_notarial" placeholder="0" required /></td>
                  </tr>
                </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_detalle_gastos_generales" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <hr>
              <h5><b>DETALLE GASTOS GENERALES</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#popdetallegastosgenerales" title="MODIFICAR DETALLES DE INSCRIPCIONES EN EL REGISTRO CIVIL"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span>Editar</button></a>
                <?php } ?>
              </h5>

              <table class="table">
                <tr>
                  <td><b>FINANCIEROS</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_finan'], 0, ",", ".") ?></td>
                <tr>
                  <td><b>MANTENIMIENTO DE EQUIPOS</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_mante'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>ARRENDAMIENTOS</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_arren'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>SERVICIOS PUBLICOS</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_serpu'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>SEGUROS</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_segur'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>UTILES Y PAPELERIA</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_utypa'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>EMPASTE LIBROS</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_empal'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>BIENESTAR</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_biene'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>OTROS</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_otros'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>PAPEL NOTARIAL</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowdgg1['dgg_papel_notarial'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>TOTAL</b></td>
                  <?php $totaldgg = 0 + $rowdgg1['dgg_finan'] + $rowdgg1['dgg_mante'] + $rowdgg1['dgg_arren'] + $rowdgg1['dgg_serpu'] + $rowdgg1['dgg_segur'] + $rowdgg1['dgg_utypa'] + $rowdgg1['dgg_empal'] + $rowdgg1['dgg_biene'] + $rowdgg1['dgg_otros'] + $rowdgg1['dgg_papel_notarial']; ?>
                  <td><b><?php echo '$ ' . number_format((float)$totaldgg, 0, ",", ".") ?></b></td>
                </tr>
              </table>

            <?php } ?>
          </div>

          <!-- DETALLES GASTOS DE PERSONAL -->
          <div class="col-md-6">
            <!-- UPDATE  DETALLES GASTOS DE PERSONAL -->
            <?php
            if (isset($_POST['update_detalle_gastos_personal'])) {

              $updateSQL = sprintf(
                "UPDATE not_detalle_gastos_personal SET 

                  dgdper_nedpsian=%s,
                  dgdper_net=%s,
                  dgdper_sdle=%s,
                  dgdper_sdt=%s,
                  dgdper_cesantias=%s,

                  dgdper_primas=%s,
                  dgdper_vaca=%s,
                  dgdper_hono=%s,
                  dgdper_otros=%s

                  where id_not_informe=%s",
                GetSQLValueString($_POST["dgdper_nedpsian"], "int"),
                GetSQLValueString($_POST["dgdper_net"], "int"),
                GetSQLValueString($_POST["dgdper_sdle"], "number"),
                GetSQLValueString($_POST["dgdper_sdt"], "number"),
                GetSQLValueString($_POST["dgdper_cesantias"], "number"),

                GetSQLValueString($_POST["dgdper_primas"], "number"),
                GetSQLValueString($_POST["dgdper_vaca"], "number"),
                GetSQLValueString($_POST["dgdper_hono"], "number"),
                GetSQLValueString($_POST["dgdper_otros"], "number"),

                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["dgdper_nedpsian"];
                $c2 = $_POST["dgdper_net"];
                $c3 = $_POST["dgdper_sdle"];
                $c4 = $_POST["dgdper_sdt"];
                $c5 = $_POST["dgdper_cesantias"];

                $c6 = $_POST["dgdper_primas"];
                $c7 = $_POST["dgdper_vaca"];
                $c8 = $_POST["dgdper_hono"];
                $c9 = $_POST["dgdper_otros"];
                $sql = "UPDATE SNINDET_GAST_PER_TRANSACTION  SET 

                  dgdper_nedpsian=$c1,
                  dgdper_net=$c2,
                  dgdper_sdle=$c3,
                  dgdper_sdt=$c4,
                  dgdper_cesantias=$c5,

                  dgdper_primas=$c6,
                  dgdper_vaca=$c7,
                  dgdper_hono=$c8,
                  dgdper_otros=$c9
                  where id_not_informe=$id";

                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            $querydgdper = sprintf("SELECT * FROM not_detalle_gastos_personal WHERE id_not_informe = $id LIMIT 1");
            $updatedgdper = mysql_query($querydgdper, $conexion) or die(mysql_error());
            $rowdgdper = mysql_fetch_assoc($updatedgdper);
            $totalRowsdgdper = mysql_num_rows($updatedgdper);
            if (0 < $totalRowsdgdper) {
            ?>

              <div class="modal fade" id="popdetallegastospersonal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="not_detalle_gastos_personal">

                        <h5><b>DETALLES GASTOS DE PERSONAL</b></h5>

                        <table class="table">
                          <tr>
                            <td><b>NO. EMPLEADOS DE PLANTA SIN INCLUIR AL NOTARIO</b></td>
                            <td><input type="number" class="form-control" name="dgdper_nedpsian" value="<?php echo htmlentities($rowdgdper['dgdper_nedpsian'], ENT_COMPAT, ''); ?>" required /></td>
                          </tr>
                          <tr>
                            <td><b>NO. EMPLEADOS TEMPORALES</b></td>
                            <td><input type="number" class="form-control" name="dgdper_net" value="<?php echo htmlentities($rowdgdper['dgdper_net'], ENT_COMPAT, ''); ?>" required /></td>
                          </tr>
                          <tr>
                            <td><b>SUELDOS DE EMPLEADOS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdper_sdle" value="<?php echo htmlentities($rowdgdper['dgdper_sdle'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          <tr>
                            <td><b>SUBSIDIO TRANSPORTE</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdper_sdt" value="<?php echo htmlentities($rowdgdper['dgdper_sdt'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>CESANTIAS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdper_cesantias" value="<?php echo htmlentities($rowdgdper['dgdper_cesantias'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>PRIMAS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdper_primas" value="<?php echo htmlentities($rowdgdper['dgdper_primas'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>VACACIONES</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdper_vaca" value="<?php echo htmlentities($rowdgdper['dgdper_vaca'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>HONORARIOS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdper_hono" value="<?php echo htmlentities($rowdgdper['dgdper_hono'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>OTROS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdper_otros" value="<?php echo htmlentities($rowdgdper['dgdper_otros'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="update_detalle_gastos_personal" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($updatedgdper);


            $querydgdper1 = sprintf("SELECT * FROM not_detalle_gastos_personal where id_not_informe =$id LIMIT 1");
            $resultdgdper1 = mysql_query($querydgdper1, $conexion) or die(mysql_error());
            $rowdgdper1 = mysql_fetch_assoc($resultdgdper1);
            $estado = $rowdgdper1['estado_not_detalle_gastos_personal'];

            if (isset($_POST['ingreso_not_detalle_gastos_personal'])) {

              $insertSQL = sprintf(
                "INSERT INTO not_detalle_gastos_personal (
                id_not_informe,
                dgdper_nedpsian,
                dgdper_net,
                dgdper_sdle,
                dgdper_sdt,

                dgdper_cesantias,
                dgdper_primas,
                dgdper_vaca,
                dgdper_hono,
                dgdper_otros) VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST["dgdper_nedpsian"], "int"),
                GetSQLValueString($_POST["dgdper_net"], "int"),
                GetSQLValueString($_POST["dgdper_sdle"], "number"),
                GetSQLValueString($_POST["dgdper_sdt"], "number"),

                GetSQLValueString($_POST["dgdper_cesantias"], "number"),
                GetSQLValueString($_POST["dgdper_primas"], "number"),
                GetSQLValueString($_POST["dgdper_vaca"], "number"),
                GetSQLValueString($_POST["dgdper_hono"], "number"),
                GetSQLValueString($_POST["dgdper_otros"], "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["dgdper_nedpsian"];
                $c2 = $_POST["dgdper_net"];
                $c3 = $_POST["dgdper_sdle"];
                $c4 = $_POST["dgdper_sdt"];

                $c5 = $_POST["dgdper_cesantias"];
                $c6 = $_POST["dgdper_primas"];
                $c7 = $_POST["dgdper_vaca"];
                $c8 = $_POST["dgdper_hono"];
                $c9 = $_POST["dgdper_otros"];
                $sql = "INSERT INTO SNINDET_GAST_PER_TRANSACTION(
                  id_not_detalle_gastos_personal,
                  id_not_informe,

                  dgdper_nedpsian,
                  dgdper_net,
                  dgdper_sdle,
                  dgdper_sdt,

                  dgdper_cesantias,
                  dgdper_primas,
                  dgdper_vaca,
                  dgdper_hono,
                  dgdper_otros,

                  fec_ahora_dgdper)
                  VALUES 
                  ($idInsert, $id, '$c1', '$c2', '$c3', '$c4', '$c5', '$c6', '$c7',  '$c8', '$c9', '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }

            if ($estado == NULL) {
            ?>

              <form method="POST" name="ingreso_not_detalle_gastos_personal">

                <hr>
                <h5><b> DETALLES GASTOS DE PERSONAL </b></h5>

                <table class="table">
                  <tr>
                    <td><b>NO. EMPLEADOS DE PLANTA SIN INCLUIR AL NOTARIO</b></td>
                    <td><input type="number" class="form-control" name="dgdper_nedpsian" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>NO. EMPLEADOS TEMPORALES</b></td>
                    <td><input type="number" class="form-control" name="dgdper_net" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>SUELDOS DE EMPLEADOS</b></td>
                    <td><input type="number" class="form-control" name="dgdper_sdle" placeholder="0" required /></td>
                  <tr>
                    <td><b>SUBSIDIO TRANSPORTE</b></td>
                    <td><input type="number" class="form-control" name="dgdper_sdt" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>CESANTIAS</b></td>
                    <td><input type="number" class="form-control" name="dgdper_cesantias" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>PRIMAS</b></td>
                    <td><input type="number" class="form-control" name="dgdper_primas" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>VACACIONES</b></td>
                    <td><input type="number" class="form-control" name="dgdper_vaca" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>HONORARIOS</b></td>
                    <td><input type="number" class="form-control" name="dgdper_hono" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>OTROS</b></td>
                    <td><input type="number" class="form-control" name="dgdper_otros" placeholder="0" required /></td>
                  </tr>
                </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_detalle_gastos_personal" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <hr>
              <h5><b>DETALLES GASTOS DE PERSONAL</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#popdetallegastospersonal" title="MODIFICAR DETALLES DE INSCRIPCIONES EN EL REGISTRO CIVIL"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span>Editar</button></a>
                <?php } else {
                } ?>
              </h5>

              <table class="table">
                <tr>
                  <td><b>NO. EMPLEADOS DE PLANTA SIN INCLUIR AL NOTARIO</b></td>
                  <td><?php echo $rowdgdper1['dgdper_nedpsian'] ?></td>
                </tr>
                <tr>
                  <td><b>NO. EMPLEADOS TEMPORALES</b></td>
                  <td><?php echo $rowdgdper1['dgdper_net'] ?></td>
                </tr>
                <tr>
                  <td><b>TOTAL EMPLEADOS</b></td>
                  <?php $totaldgdperem = $rowdgdper1['dgdper_nedpsian'] + $rowdgdper1['dgdper_net']; ?>
                  <td><b><?php echo $totaldgdperem; ?></b></td>
                </tr>
                <tr>
                  <td><b>SUELDOS DE EMPLEADOS</b></td>
                  <td><?php echo '$ ' . number_format($rowdgdper1['dgdper_sdle'], 0, ",", ".") ?></td>
                <tr>
                  <td><b>SUBSIDIO TRANSPORTE</b></td>
                  <td><?php echo '$ ' . number_format($rowdgdper1['dgdper_sdt'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>CESANTIAS</b></td>
                  <td><?php echo '$ ' . number_format($rowdgdper1['dgdper_cesantias'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>PRIMAS</b></td>
                  <td><?php echo '$ ' . number_format($rowdgdper1['dgdper_primas'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>VACACIONES</b></td>
                  <td><?php echo '$ ' . number_format($rowdgdper1['dgdper_vaca'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>HONORARIOS</b></td>
                  <td><?php echo '$ ' . number_format($rowdgdper1['dgdper_hono'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>OTROS</b></td>
                  <td><?php echo '$ ' . number_format($rowdgdper1['dgdper_otros'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>TOTAL</b></td>
                  <?php
                  $totaldgdper = $rowdgdper1['dgdper_sdle'] + $rowdgdper1['dgdper_sdt'] + $rowdgdper1['dgdper_cesantias'] + $rowdgdper1['dgdper_primas'] + $rowdgdper1['dgdper_vaca'] + $rowdgdper1['dgdper_hono'] + $rowdgdper1['dgdper_otros'];
                  ?>
                  <td><b><?php echo '$ ' . number_format($totaldgdper, 0, ",", ".") ?></b></td>
                </tr>
              </table>

            <?php } ?>

          </div>
        </div>


        <div class="row">
          <!-- DETALLE TRANSFERENCIAS -->
          <div class="col-md-6">
            <!-- UPDATE DETALLE TRANSFERENCIAS -->
            <?php
            if (isset($_POST['update_not_dt'])) {

              $updateSQL = sprintf(
                "UPDATE not_detalle_transferencias SET 
                  dt_cdc=%s,
                  dt_sena=%s,
                  dt_icbf=%s,
                  dt_epss=%s,
                  dt_fadp=%s,
                  dt_arpr=%s,
                  dt_agre=%s,
                  dt_addj=%s,
                  dt_cdrc=%s,
                  dt_otro=%s
                  where id_not_informe=%s",
                GetSQLValueString($_POST["dt_cdc"], "number"),
                GetSQLValueString($_POST["dt_sena"], "number"),
                GetSQLValueString($_POST["dt_icbf"], "number"),
                GetSQLValueString($_POST["dt_epss"], "number"),
                GetSQLValueString($_POST["dt_fadp"], "number"),
                GetSQLValueString($_POST["dt_arpr"], "number"),
                GetSQLValueString($_POST["dt_agre"], "number"),
                GetSQLValueString($_POST["dt_addj"], "number"),
                GetSQLValueString(0, "number"),
                GetSQLValueString($_POST["dt_otro"], "number"),
                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["dt_cdc"];
                $c2 = $_POST["dt_sena"];
                $c3 = $_POST["dt_icbf"];
                $c4 = $_POST["dt_epss"];
                $c5 = $_POST["dt_fadp"];

                $c6 = $_POST["dt_arpr"];
                $c7 = $_POST["dt_agre"];
                $c8 = $_POST["dt_addj"];
                $c9 = $_POST["dt_otro"];
                $sql = "UPDATE SNINDET_TRANS_TRANSACTION  SET 

                  dt_cdc=$c1,
                  dt_sena=$c2,
                  dt_icbf=$c3,
                  dt_epss=$c4,
                  dt_fadp=$c5,

                  dt_arpr=$c6,
                  dt_agre=$c7,
                  dt_addj=$c8,
                  dt_cdrc=0,
                  dt_otro=$c9
                  where id_not_informe=$id";

                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }

            $querydt = sprintf("SELECT * FROM not_detalle_transferencias where id_not_informe =$id LIMIT 1");
            $updatedt = mysql_query($querydt, $conexion) or die(mysql_error());
            $rowdt = mysql_fetch_assoc($updatedt);
            $totalRowsdt = mysql_num_rows($updatedt);
            if (0 < $totalRowsdt) {
            ?>

              <div class="modal fade" id="popdetalletrasferencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="not_detalle_transferencias">

                        <h5><b> DETALLE TRANSFERENCIAS </b></h5>

                        <table class="table">
                          <tr>
                            <td><b>CAJA DE COMPENSACION</b></td>
                            <td>
                              <input type="number" class="form-control" name="dt_cdc" value="<?php echo htmlentities($rowdt['dt_cdc'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          <tr>
                            <td><b>SENA</b></td>
                            <td>
                              <input type="number" class="form-control" name="dt_sena" value="<?php echo htmlentities($rowdt['dt_sena'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>I.C.B.F</b></td>
                            <td>
                              <input type="number" class="form-control" name="dt_icbf" value="<?php echo htmlentities($rowdt['dt_icbf'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>EPS SALUD</b></td>
                            <td>
                              <input type="number" class="form-control" name="dt_epss" value="<?php echo htmlentities($rowdt['dt_epss'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>FONDO AMD. PENSIONES</b></td>
                            <td>
                              <input type="number" class="form-control" name="dt_fadp" value="<?php echo htmlentities($rowdt['dt_fadp'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>ARP RIESGOS PROFESIONALES</b></td>
                            <td>
                              <input type="number" class="form-control" name="dt_arpr" value="<?php echo htmlentities($rowdt['dt_arpr'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>AGREMIACIONES</b></td>
                            <td>
                              <input type="number" class="form-control" name="dt_agre" value="<?php echo htmlentities($rowdt['dt_agre'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>ADMINISTRACION DE JUSTICIA (LEY 6/1992)</b></td>
                            <td>
                              <input type="number" class="form-control" name="dt_addj" value="<?php echo htmlentities($rowdt['dt_addj'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>OTROS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dt_otro" value="<?php echo htmlentities($rowdt['dt_otro'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="update_not_dt" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($updatedt);


            $querydt1 = sprintf("SELECT * FROM not_detalle_transferencias where id_not_informe =$id LIMIT 1");
            $selectdt1 = mysql_query($querydt1, $conexion) or die(mysql_error());
            $rowdt1 = mysql_fetch_assoc($selectdt1);
            $estado = $rowdt1['estado_not_detalle_transferencias'];


            if (isset($_POST['ingreso_not_dt'])) {

              $insertSQL = sprintf(
                "INSERT INTO not_detalle_transferencias (
                id_not_informe,

                dt_cdc,
                dt_sena,
                dt_icbf,
                dt_epss,
                dt_fadp,

                dt_arpr,
                dt_agre,
                dt_addj,
                dt_cdrc,
                dt_otro) VALUES (%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),

                GetSQLValueString($_POST["dt_cdc"], "number"),
                GetSQLValueString($_POST["dt_sena"], "number"),
                GetSQLValueString($_POST["dt_icbf"], "number"),
                GetSQLValueString($_POST["dt_epss"], "number"),
                GetSQLValueString($_POST["dt_fadp"], "number"),

                GetSQLValueString($_POST["dt_arpr"], "number"),
                GetSQLValueString($_POST["dt_agre"], "number"),
                GetSQLValueString($_POST["dt_addj"], "number"),
                GetSQLValueString(0, "number"),
                GetSQLValueString($_POST["dt_otro"], "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["dt_cdc"];
                $c2 = $_POST["dt_sena"];
                $c3 = $_POST["dt_icbf"];
                $c4 = $_POST["dt_epss"];
                $c5 = $_POST["dt_fadp"];

                $c6 = $_POST["dt_arpr"];
                $c7 = $_POST["dt_agre"];
                $c8 = $_POST["dt_addj"];
                $c9 = $_POST["dt_otro"];
                $sql = "INSERT INTO SNINDET_TRANS_TRANSACTION(
                  id_not_detalle_transferencias,
                  id_not_informe,

                  dt_cdc,
                  dt_sena,
                  dt_icbf,
                  dt_epss,
                  dt_fadp,

                  dt_arpr,
                  dt_agre,
                  dt_addj,
                  dt_cdrc,
                  dt_otro,

                  fec_ahora_dt)
                  VALUES 
                  ($idInsert, $id, '$c1', '$c2', '$c3', '$c4', '$c5', '$c6', '$c7', '$c8', '0', '$c9', '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            if ($estado == NULL) {
            ?>

              <form method="POST" name="ingreso_not_dt">

                <hr>
                <h5><b> DETALLE TRANSFERENCIAS</b></h5>

                <table class="table">
                  <tr>
                    <td><b>CAJA DE COMPENSACION</b></td>
                    <td><input type="number" name="dt_cdc" class="form-control" placeholder="0" required /></td>
                  <tr>
                    <td><b>SENA</b></td>
                    <td><input type="number" name="dt_sena" class="form-control" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>I.C.B.F</b></td>
                    <td><input type="number" name="dt_icbf" class="form-control" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>EPS SALUD</b></td>
                    <td><input type="number" name="dt_epss" class="form-control" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>FONDO AMD. PENSIONES</b></td>
                    <td><input type="number" name="dt_fadp" class="form-control" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>ARP RIESGOS PROFESIONALES</b></td>
                    <td><input type="number" name="dt_arpr" class="form-control" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>AGREMIACIONES</b></td>
                    <td><input type="number" name="dt_agre" class="form-control" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>ADMINISTRACION DE JUSTICIA (LEY 6/1992)</b></td>
                    <td><input type="number" name="dt_addj" class="form-control" placeholder="0" required /></td>
                  </tr>
                  <tr>
                    <td><b>OTROS</b></td>
                    <td><input type="number" name="dt_otro" class="form-control" placeholder="0" required /></td>
                  </tr>
                </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_dt" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <hr>
              <h5><b> DETALLE TRANSFERENCIAS</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#popdetalletrasferencia" title="MODIFICAR DETALLE TRANSFERENCIAS"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span>Editar</button></a>
                <?php } ?>
              </h5>

              <table class="table">
                <tr>
                  <td><b>CAJA DE COMPENSACION</b></td>
                  <td><?php echo '$ ' . number_format($rowdt1['dt_cdc'], 0, ",", ".") ?></td>
                <tr>
                  <td><b>SENA</b></td>
                  <td><?php echo '$ ' . number_format($rowdt1['dt_sena'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>I.C.B.F</b></td>
                  <td><?php echo '$ ' . number_format($rowdt1['dt_icbf'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>EPS SALUD</b></td>
                  <td><?php echo '$ ' . number_format($rowdt1['dt_epss'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>FONDO AMD. PENSIONES</b></td>
                  <td><?php echo '$ ' . number_format($rowdt1['dt_fadp'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>ARP RIESGOS PROFESIONALES</b></td>
                  <td><?php echo '$ ' . number_format($rowdt1['dt_arpr'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>AGREMIACIONES</b></td>
                  <td><?php echo '$ ' . number_format($rowdt1['dt_agre'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>ADMINISTRACION DE JUSTICIA (LEY 6/1992)</b></td>
                  <td><?php echo '$ ' . number_format($rowdt1['dt_addj'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>OTROS</b></td>
                  <td><?php echo '$ ' . number_format($rowdt1['dt_otro'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>TOTAL</b></td>
                  <?php $totaldt = 0 + $rowdt1['dt_cdc'] + $rowdt1['dt_sena'] + $rowdt1['dt_icbf'] + $rowdt1['dt_epss'] + $rowdt1['dt_fadp'] + $rowdt1['dt_arpr'] + $rowdt1['dt_agre'] + $rowdt1['dt_addj'] + $rowdt1['dt_cdrc'] + $rowdt1['dt_otro']; ?>
                  <td><b><?php echo '$ ' . number_format($totaldt, 0, ",", ".") ?></b></td>
                </tr>
              </table>

            <?php } ?>

          </div>

          <!-- DETALLE GASTOS DE INVERSION -->
          <div class="col-md-6">
            <!--  UPDATE  DETALLE GASTOS DE INVERSION -->
            <?php
            if (isset($_POST['update_not_dgdi'])) {

              $updateSQL = sprintf(
                "UPDATE not_detalle_gastos_inversion SET 

                  dgdi_inyl=%s,
                  dgdi_siyt=%s,
                  dgdi_capa=%s,
                  dgdi_otros=%s

                  where id_not_informe=%s",
                GetSQLValueString($_POST["dgdi_inyl"], "number"),
                GetSQLValueString($_POST["dgdi_siyt"], "number"),
                GetSQLValueString($_POST["dgdi_capa"], "number"),
                GetSQLValueString($_POST["dgdi_otros"], "number"),

                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["dgdi_inyl"];
                $c2 = $_POST["dgdi_siyt"];
                $c3 = $_POST["dgdi_capa"];
                $c4 = $_POST["dgdi_otros"];
                $sql = "UPDATE SNINDET_GAST_INV_TRANSACTION  SET 

                  dgdi_inyl=$c1,
                  dgdi_siyt=$c2,
                  dgdi_capa=$c3,
                  dgdi_otros=$c4

                  where id_not_informe=$id";

                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }

            $query_update = sprintf("SELECT * FROM not_detalle_gastos_inversion where id_not_informe =$id LIMIT 1");
            $update = mysql_query($query_update, $conexion) or die(mysql_error());
            $row_update = mysql_fetch_assoc($update);
            $totalRows_update = mysql_num_rows($update);
            if (0 < $totalRows_update) {
            ?>

              <div class="modal fade" id="popdetallegastosinversion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="not_detalle_gastos_inversion">
                        <h5><b> DETALLE GASTOS DE INVERSION </b></h5>
                        <table class="table">
                          <tr>
                            <td><b>INFRAESTRUCTURA Y LOCATIVOS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdi_inyl" value="<?php echo htmlentities($row_update['dgdi_inyl'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          <tr>
                            <td><b>SISTEMA Y TECNOLOGIA</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdi_siyt" value="<?php echo htmlentities($row_update['dgdi_siyt'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>CAPACITACION</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdi_capa" value="<?php echo htmlentities($row_update['dgdi_capa'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>OTROS</b></td>
                            <td>
                              <input type="number" class="form-control" name="dgdi_otros" value="<?php echo htmlentities($row_update['dgdi_otros'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="update_not_dgdi" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($update);



            $querydgi = sprintf("SELECT * FROM not_detalle_gastos_inversion where id_not_informe =$id LIMIT 1");
            $selectdgi = mysql_query($querydgi, $conexion) or die(mysql_error());
            $rowdgi = mysql_fetch_assoc($selectdgi);
            $estado = $rowdgi['estado_not_detalle_gastos_inversion'];
            ?>

            <?php
            if (isset($_POST['ingreso_not_detalle_gastos_inversion'])) {

              $insertSQL = sprintf(
                "INSERT INTO not_detalle_gastos_inversion (
                id_not_informe,

                dgdi_inyl,
                dgdi_siyt,
                dgdi_capa,
                dgdi_otros) VALUES (%s, %s,%s,%s,%s)",
                GetSQLValueString($id, "int"),

                GetSQLValueString($_POST["dgdi_inyl"], "number"),
                GetSQLValueString($_POST["dgdi_siyt"], "number"),
                GetSQLValueString($_POST["dgdi_capa"], "number"),
                GetSQLValueString($_POST["dgdi_otros"], "number")

              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["dgdi_inyl"];
                $c2 = $_POST["dgdi_siyt"];
                $c3 = $_POST["dgdi_capa"];
                $c4 = $_POST["dgdi_otros"];
                $sql = "INSERT INTO SNINDET_GAST_INV_TRANSACTION(
                  id_not_detalle_gastos_inversion,
                  id_not_informe,

                  dgdi_inyl,
                  dgdi_siyt,
                  dgdi_capa,
                  dgdi_otros,

                  fec_ahora_dgdi)
                  VALUES 
                  ($idInsert, $id, '$c1', '$c2', '$c3', '$c4', '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            if ($estado == NULL) {
            ?>

              <form method="POST" name="ingreso_not_detalle_gastos_inversion">
                <hr>
                <h5><b> DETALLE GASTOS DE INVERSION</b></h5>
                <table class="table">
                  <tr>
                    <td><b>INFRAESTRUCTURA Y LOCATIVOS</b></td>
                    <td><input type="number" class="form-control" name="dgdi_inyl" required /></td>
                  <tr>
                    <td><b>SISTEMA Y TECNOLOGIA</b></td>
                    <td><input type="number" class="form-control" name="dgdi_siyt" required /></td>
                  </tr>
                  <tr>
                    <td><b>CAPACITACION</b></td>
                    <td><input type="number" class="form-control" name="dgdi_capa" required /></td>
                  </tr>
                  <tr>
                    <td><b>OTROS</b></td>
                    <td><input type="number" class="form-control" name="dgdi_otros" required /></td>
                  </tr>
                </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_detalle_gastos_inversion" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <hr>
              <h5><b> DETALLE GASTOS DE INVERSION</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#popdetallegastosinversion" title="MODIFICAR DETALLE GASTOS DE INVERSION"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span>Editar</button></a>
                <?php } else {
                } ?>
              </h5>

              <table class="table">
                <tr>
                  <td><b>INFRAESTRUCTURA Y LOCATIVOS</b></td>
                  <td><?php echo '$ ' . number_format($rowdgi['dgdi_inyl'], 0, ",", ".") ?></td>
                <tr>
                  <td><b>SISTEMA Y TECNOLOGIA</b></td>
                  <td><?php echo '$ ' . number_format($rowdgi['dgdi_siyt'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>CAPACITACION</b></td>
                  <td><?php echo '$ ' . number_format($rowdgi['dgdi_capa'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>OTROS</b></td>
                  <td><?php echo '$ ' . number_format($rowdgi['dgdi_otros'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>TOTAL</b></td>
                  <?php $totaldgdi = $rowdgi['dgdi_inyl'] + $rowdgi['dgdi_siyt'] + $rowdgi['dgdi_capa'] + $rowdgi['dgdi_otros']; ?>
                  <td><b><?php echo '$ ' . number_format($totaldgdi, 0, ",", ".") ?></b></td>
                </tr>
              </table>

            <?php } ?>

          </div>
        </div>

        <div class="row">
          <!-- INSCRIPCION EN EL REGISTRO CIVIL -->
          <div class="col-md-6">
            <!-- UPDATE INSCRIPCION EN EL REGISTRO CIVIL -->
            <?php
            if (isset($_POST['actualiza_detalle_inscripcion_registro_civil'])) {

              $updateSQL = sprintf(
                "UPDATE not_detalle_inscripcion_registro_civil SET 

                detieerc_nac=%s,
                detieerc_mat=%s,
                detieerc_def=%s,
                detieerc_ldv=%s

                where id_not_informe=%s",
                GetSQLValueString($_POST["detieerc_nac"], "int"),
                GetSQLValueString($_POST["detieerc_mat"], "int"),
                GetSQLValueString($_POST["detieerc_def"], "int"),
                GetSQLValueString($_POST["detieerc_ldv"], "int"),

                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["detieerc_nac"];
                $c2 = $_POST["detieerc_mat"];
                $c3 = $_POST["detieerc_def"];
                $c4 = $_POST["detieerc_ldv"];
                $sql = "UPDATE SNINDET_INS_REG_C_TRANSACTION  SET 
  
                  detieerc_nac=$c1,
                  detieerc_mat=$c2,
                  detieerc_def=$c3,
                  detieerc_ldv=$c4

                where id_not_informe=$id";

                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }

            $queryirc = sprintf("SELECT * FROM not_detalle_inscripcion_registro_civil WHERE id_not_informe = $id LIMIT 1");
            $resultirc = mysql_query($queryirc, $conexion) or die(mysql_error());
            $rowirc = mysql_fetch_assoc($resultirc);
            $totalRowsirc = mysql_num_rows($resultirc);
            if (0 < $totalRowsirc) {
            ?>
              <div class="modal fade" id="popinscripcionregistrocivil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="ingreso_not_detalle_inscripcion_registro_civil_pop">

                        <h5><b>DETALLES INSCRIPCION EN EL REGISTRO CIVIL</b></h5>

                        <table class="table">
                          <tr>
                            <th><b>Acto</b></th>
                            <th><b>Cantidad</b></th>
                          </tr>
                          <tr>
                            <td>NACIMIENTO</td>
                            <td>
                              <input type="number" class="form-control" name="detieerc_nac" value="<?php echo htmlentities($rowirc['detieerc_nac'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td>MATRIMONIO</td>
                            <td>
                              <input type="number" class="form-control" name="detieerc_mat" value="<?php echo htmlentities($rowirc['detieerc_mat'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td>DEFUNCION</td>
                            <td>
                              <input type="number" class="form-control" name="detieerc_def" value="<?php echo htmlentities($rowirc['detieerc_def'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td>LIBRO DE VARIOS</td>
                            <td>
                              <input type="number" class="form-control" name="detieerc_ldv" value="<?php echo htmlentities($rowirc['detieerc_ldv'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="actualiza_detalle_inscripcion_registro_civil" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($resultirc);
            ?>

            <!-- DETALLE INSCRIPCION EN EL REGISTRO CIVIL -->
            <?php
            $queryirc1 = sprintf("SELECT * FROM not_detalle_inscripcion_registro_civil WHERE id_not_informe = $id LIMIT 1");
            $selectirc1 = mysql_query($queryirc1, $conexion) or die(mysql_error());
            $rowirc1 = mysql_fetch_assoc($selectirc1);
            $estado = $rowirc1['estado_not_detalle_inscripcion_registro_civil'];


            if (isset($_POST['ingreso_not_detalle_inscripcion_registro_civil'])) {

              $insertSQL = sprintf(
                "INSERT INTO  not_detalle_inscripcion_registro_civil (
                  id_not_informe,
                  detieerc_nac,
                  detieerc_mat,
                  detieerc_def,
                  detieerc_ldv) VALUES (%s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST["detieerc_nac"], "int"),
                GetSQLValueString($_POST["detieerc_mat"], "int"),
                GetSQLValueString($_POST["detieerc_def"], "int"),
                GetSQLValueString($_POST["detieerc_ldv"], "int")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["detieerc_nac"];
                $c2 = $_POST["detieerc_mat"];
                $c3 = $_POST["detieerc_def"];
                $c4 = $_POST["detieerc_ldv"];
                $sql = "INSERT INTO SNINDET_INS_REG_C_TRANSACTION(
                id_not_detalle_inscripcion_registro_civil,
                id_not_informe,

                detieerc_nac,
                detieerc_mat,
                detieerc_def,
                detieerc_ldv,

                fec_ahora_detieerc)
                VALUES 
                ($idInsert, $id, $c1, $c2, $c3, $c4, '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }

            if ($estado == NULL) {
            ?>

              <form method="POST" name="ingreso_not_detalle_inscripcion_registro_civil">

                <hr>
                <h5><b>DETALLES DE INSCRIPCIONES EN EL REGISTRO CIVIL</b></h5>

                <table class="table">
                  <tr>
                    <th><b>Acto</b></th>
                    <th><b>Cantidad</b></th>
                  </tr>
                  <tr>
                    <td>NACIMIENTO</td>
                    <td><input type="number" class="form-control" name="detieerc_nac" required /></td>
                  </tr>
                  <tr>
                    <td>MATRIMONIO</td>
                    <td><input type="number" class="form-control" name="detieerc_mat" required /></td>
                  </tr>
                  <tr>
                    <td>DEFUNCION</td>
                    <td><input type="number" class="form-control" name="detieerc_def" required /></td>
                  </tr>
                  <tr>
                    <td>LIBRO DE VARIOS</td>
                    <td><input type="number" class="form-control" name="detieerc_ldv" required /></td>
                  </tr>
                </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_detalle_inscripcion_registro_civil" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <hr>
              <h5><b>DETALLES DE INSCRIPCIONES EN EL REGISTRO CIVIL</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#popinscripcionregistrocivil" title="MODIFICAR DETALLES DE INSCRIPCIONES EN EL REGISTRO CIVIL"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar </button></a>
                <?php } ?>
              </h5>
              <table class="table">
                <tr>
                  <th><b>Acto</b></th>
                  <th><b>Cantidad</b></th>
                </tr>
                <tr>
                  <td><b>NACIMIENTO</b></td>
                  <td><?php echo $rowirc1['detieerc_nac']; ?></td>
                </tr>
                <tr>
                  <td><b>MATRIMONIO</b></td>
                  <td><?php echo $rowirc1['detieerc_mat']; ?></td>
                </tr>
                <tr>
                  <td><b>DEFUNCION</b></td>
                  <td><?php echo $rowirc1['detieerc_def']; ?></td>
                </tr>
                <tr>
                  <td><b>LIBRO DE VARIOS</b></td>
                  <td><?php echo $rowirc1['detieerc_ldv']; ?></td>
                </tr>
                <tr>
                  <td><b>TOTAL</b></td>
                  <?php $totaldetieerc = $rowirc1['detieerc_nac'] + $rowirc1['detieerc_mat'] + $rowirc1['detieerc_def'] + $rowirc1['detieerc_ldv']; ?>
                  <td><b><?php echo $totaldetieerc; ?></b></td>
                </tr>
              </table>

            <?php } ?>

          </div>
          <div class="col-md-6">
            <!-- DETALLE OBLIGACIONES -->
            <?php
            if (isset($_POST['update_not_detalles_obligaciones'])) {

              $updateSQL = sprintf(
                "UPDATE not_detalle_obligaciones SET 

                iva_valor=%s,
                retencion_fuente_valor=%s,
                recaudo_fondo_especial_valor=%s,
                recaudo_superintendencia_valor=%s,
                aporte_fondo_especial_valor=%s,
                aporte_admin_justicia_valor=%s,
                fondo_rotatorio_rnec_valor=%s

                where id_not_informe=%s",
                GetSQLValueString($_POST["iva_valor"], "number"),
                GetSQLValueString($_POST["retencion_fuente_valor"], "number"),
                GetSQLValueString($_POST["recaudo_fondo_especial_valor"], "number"),
                GetSQLValueString($_POST["recaudo_superintendencia_valor"], "number"),
                GetSQLValueString($_POST["aporte_fondo_especial_valor"], "number"),
                GetSQLValueString($_POST["aporte_admin_justicia_valor"], "number"),
                GetSQLValueString($_POST["fondo_rotatorio_rnec_valor"], "number"),

                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["iva_valor"];
                $c2 = $_POST["retencion_fuente_valor"];
                $c3 = $_POST["recaudo_fondo_especial_valor"];
                $c4 = $_POST["recaudo_superintendencia_valor"];
                $c5 = $_POST["aporte_fondo_especial_valor"];
                $c6 = $_POST["aporte_admin_justicia_valor"];
                $c7 = $_POST["fondo_rotatorio_rnec_valor"];

                $sql = "UPDATE SNINDET_OBLIG_TRANSACTION  SET 

                iva_valor=$c1,
                retencion_fuente_valor=$c2,
                recaudo_fondo_especial_valor=$c3,
                recaudo_superintendencia_valor=$c4,
                aporte_fondo_especial_valor=$c5,
                aporte_admin_justicia_valor=$c6,
                fondo_rotatorio_rnec_valor=$c7

                where id_not_informe=$id";

                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }

            $query_update = sprintf("SELECT * FROM not_detalle_obligaciones where id_not_informe =$id LIMIT 1");
            $update = mysql_query($query_update, $conexion) or die(mysql_error());
            $row_update = mysql_fetch_assoc($update);
            $totalRows_update = mysql_num_rows($update);
            if (0 < $totalRows_update) {
            ?>

              <div class="modal fade" id="modeldetalleobligaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="not_detalle_obligaciones">
                        <h5><b> DETALLE OBLIGACIONES </b></h5>
                        <table class="table">
                          <tr>
                            <td><b>IVA</b></td>
                            <td>
                              <input type="number" class="form-control" name="iva_valor" value="<?php echo htmlentities($row_update['iva_valor'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          <tr>
                            <td><b>RETENCION EN LA FUENTE</b></td>
                            <td>
                              <input type="number" class="form-control" name="retencion_fuente_valor" value="<?php echo htmlentities($row_update['retencion_fuente_valor'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>RECAUDO FONDO ESPECIAL</b></td>
                            <td>
                              <input type="number" class="form-control" name="recaudo_fondo_especial_valor" value="<?php echo htmlentities($row_update['recaudo_fondo_especial_valor'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>RECAUDO SUPERINTENDENCIA</b></td>
                            <td>
                              <input type="number" class="form-control" name="recaudo_superintendencia_valor" value="<?php echo htmlentities($row_update['recaudo_superintendencia_valor'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>APORTE FONDO ESPECIAL</b></td>
                            <td>
                              <input type="number" class="form-control" name="aporte_fondo_especial_valor" value="<?php echo htmlentities($row_update['aporte_fondo_especial_valor'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>APORTE ADMIN. JUSTICIA</b></td>
                            <td>
                              <input type="number" class="form-control" name="aporte_admin_justicia_valor" value="<?php echo htmlentities($row_update['aporte_admin_justicia_valor'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                          <tr>
                            <td><b>FONDO ROTATORIO DE LA RNEC</b></td>
                            <td>
                              <input type="number" class="form-control" name="fondo_rotatorio_rnec_valor" value="<?php echo htmlentities($row_update['fondo_rotatorio_rnec_valor'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="update_not_detalles_obligaciones" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($update);



            $querydgi = sprintf("SELECT * FROM not_detalle_obligaciones where id_not_informe =$id LIMIT 1");
            $selectdgi = mysql_query($querydgi, $conexion) or die(mysql_error());
            $rowndo = mysql_fetch_assoc($selectdgi);
            $estado = $rowndo['estado_not_detalle_obligaciones'];
            ?>

            <?php
            if (isset($_POST['ingreso_not_detalles_obligaciones'])) {

              $insertSQL = sprintf(
                "INSERT INTO not_detalle_obligaciones (
                id_not_informe,

                iva_valor,
                retencion_fuente_valor,
                recaudo_fondo_especial_valor,
                recaudo_superintendencia_valor,
                aporte_fondo_especial_valor,
                aporte_admin_justicia_valor,
                fondo_rotatorio_rnec_valor) VALUES (%s, %s,%s,%s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),

                GetSQLValueString($_POST["iva_valor"], "number"),
                GetSQLValueString($_POST["retencion_fuente_valor"], "number"),
                GetSQLValueString($_POST["recaudo_fondo_especial_valor"], "number"),
                GetSQLValueString($_POST["recaudo_superintendencia_valor"], "number"),
                GetSQLValueString($_POST["aporte_fondo_especial_valor"], "number"),
                GetSQLValueString($_POST["aporte_admin_justicia_valor"], "number"),
                GetSQLValueString($_POST["fondo_rotatorio_rnec_valor"], "number")

              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["iva_valor"];
                $c2 = $_POST["retencion_fuente_valor"];
                $c3 = $_POST["recaudo_fondo_especial_valor"];
                $c4 = $_POST["recaudo_superintendencia_valor"];
                $c5 = $_POST["aporte_fondo_especial_valor"];
                $c6 = $_POST["aporte_admin_justicia_valor"];
                $c7 = $_POST["fondo_rotatorio_rnec_valor"];
                $sql = "INSERT INTO SNINDET_OBLIG_TRANSACTION(
                id_not_detalle_obligaciones,
                id_not_informe,

                iva_valor,
                retencion_fuente_valor,
                recaudo_fondo_especial_valor,
                recaudo_superintendencia_valor,
                aporte_fondo_especial_valor,
                aporte_admin_justicia_valor,
                fondo_rotatorio_rnec_valor,

                fec_ahora)
                VALUES 
                ($idInsert,$id,'$c1','$c2','$c3','$c4','$c5','$c6','$c7','$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            if ($estado == NULL) {
            ?>

              <form method="POST" name="ingreso_not_detalles_obligaciones">
                <hr>
                <h5><b> DETALLE OBLIGACIONES</b></h5>
                <table class="table">
                  <tr>
                    <td><b>IVA</b></td>
                    <td>
                      <input type="number" class="form-control" name="iva_valor" required />
                    </td>
                  <tr>
                    <td><b>RETENCION EN LA FUENTE</b></td>
                    <td>
                      <input type="number" class="form-control" name="retencion_fuente_valor" required />
                    </td>
                  </tr>
                  <tr>
                    <td><b>RECAUDO FONDO ESPECIAL</b></td>
                    <td>
                      <input type="number" class="form-control" name="recaudo_fondo_especial_valor" required />
                    </td>
                  </tr>
                  <tr>
                    <td><b>RECAUDO SUPERINTENDENCIA</b></td>
                    <td>
                      <input type="number" class="form-control" name="recaudo_superintendencia_valor" required />
                    </td>
                  </tr>
                  <tr>
                    <td><b>APORTE FONDO ESPECIAL</b></td>
                    <td>
                      <input type="number" class="form-control" name="aporte_fondo_especial_valor" required />
                    </td>
                  </tr>
                  <tr>
                    <td><b>APORTE ADMIN. JUSTICIA</b></td>
                    <td>
                      <input type="number" class="form-control" name="aporte_admin_justicia_valor" required />
                    </td>
                  </tr>
                  <tr>
                    <td><b>FONDO ROTATORIO DE LA RNEC</b></td>
                    <td>
                      <input type="number" class="form-control" name="fondo_rotatorio_rnec_valor" required />
                    </td>
                  </tr>
                </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_detalles_obligaciones" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <hr>
              <h5><b> DETALLE OBLIGACIONES</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#modeldetalleobligaciones" title="MODIFICAR DETALLE OBLIGACIONES"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span>Editar</button></a>
                <?php } else {
                } ?>
              </h5>

              <table class="table">
                <tr>
                  <td><b>IVA</b></td>
                  <td><?php echo '$ ' . number_format($rowndo['iva_valor'], 0, ",", ".") ?></td>
                <tr>
                  <td><b>RETENCION EN LA FUENTE</b></td>
                  <td><?php echo '$ ' . number_format($rowndo['retencion_fuente_valor'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>RECAUDO FONDO ESPECIAL</b></td>
                  <td><?php echo '$ ' . number_format($rowndo['recaudo_fondo_especial_valor'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>RECAUDO SUPERINTENDENCIA</b></td>
                  <td><?php echo '$ ' . number_format($rowndo['recaudo_superintendencia_valor'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>APORTE FONDO ESPECIAL</b></td>
                  <td><?php echo '$ ' . number_format($rowndo['aporte_fondo_especial_valor'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>APORTE ADMIN. JUSTICIA</b></td>
                  <td><?php echo '$ ' . number_format($rowndo['aporte_admin_justicia_valor'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>FONDO ROTATORIO DE LA RNEC</b></td>
                  <td><?php echo '$ ' . number_format($rowndo['fondo_rotatorio_rnec_valor'], 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <td><b>TOTAL</b></td>
                  <?php $totalndo = $rowndo['iva_valor'] + $rowndo['retencion_fuente_valor'] + $rowndo['recaudo_fondo_especial_valor'] + $rowndo['recaudo_superintendencia_valor']  + $rowndo['aporte_fondo_especial_valor'] + $rowndo['aporte_admin_justicia_valor'] + $rowndo['fondo_rotatorio_rnec_valor']; ?>
                  <td><b><?php echo '$ ' . number_format($totalndo, 0, ",", ".") ?></b></td>
                </tr>
              </table>

            <?php } ?>

          </div>
        </div>

        <!-- PAGO A TERCEROS - SOPORTE DE PAGO -->
        <div class="row">
          <div class="col-md-12">
            <hr>
            <h5><b>PAGO A TERCEROS - SOPORTE DE PAGO</b></h5>
            <div class="text-right">
              <?php
              if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {
                echo '<a data-toggle="modal" data-target="#popnotaria" title="Agregar Consignaciones"> <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign"></span>Agregar</button></a>';
              }
              ?>
            </div>
          </div>
          <div class="box-body">
            <div class="col-md-12">
              <?php
              $querydgisp = sprintf("SELECT * FROM not_detalle_obligaciones where id_not_informe =$id LIMIT 1");
              $selectdgisp = mysql_query($querydgisp, $conexion) or die(mysql_error());
              $rowndosp = mysql_fetch_assoc($selectdgisp);
              ?>
              <table class="table">
                <tr>
                  <td><b>CONCEPTO</b></td>
                  <td><b>OBLIGACION</b></td>
                  <td><b>PAGO</b></td>
                  <td><b>PERIODO</b></td>
                <tr>
                <tr>
                  <td>IVA</td>
                  <td><?php echo '$ ' . number_format($rowndosp['iva_valor'], 0, ",", ".") ?></td>
                  <td>
                    <?php
                    $querydgisopor = sprintf("SELECT id_not_tipo_documento, periocidad, periodo, valor_consignacion FROM not_documento WHERE estado_not_documento=1 AND id_not_informe=$id AND id_not_tipo_documento=1");
                    $selectdgisopor = mysql_query($querydgisopor, $conexion) or die(mysql_error());
                    $rowndosopor = mysql_fetch_assoc($selectdgisopor);
                    if (1 == $rowndosopor['id_not_tipo_documento']) {
                      echo '$ ' . number_format($rowndosopor['valor_consignacion'], 0, ",", ".");
                    } else {
                      echo '$ 0';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (1 == $rowndosopor['id_not_tipo_documento']) {
                      echo $rowndosopor['periocidad'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $rowndosopor['periodo'];
                    }
                    ?>
                  </td>
                <tr>
                  <td>RETENCION EN LA FUENTE</td>
                  <td><?php echo '$ ' . number_format($rowndosp['retencion_fuente_valor'], 0, ",", ".") ?></td>
                  <td>
                    <?php
                    $querydgisopor = sprintf("SELECT id_not_tipo_documento, periocidad, periodo, valor_consignacion FROM not_documento WHERE estado_not_documento=1 AND id_not_informe=$id AND id_not_tipo_documento=2");
                    $selectdgisopor = mysql_query($querydgisopor, $conexion) or die(mysql_error());
                    $rowndosopor = mysql_fetch_assoc($selectdgisopor);
                    if (2 == $rowndosopor['id_not_tipo_documento']) {
                      echo '$ ' . number_format($rowndosopor['valor_consignacion'], 0, ",", ".");
                    } else {
                      echo '$ 0';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (2 == $rowndosopor['id_not_tipo_documento']) {
                      echo $rowndosopor['periocidad'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $rowndosopor['periodo'];
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>RECAUDO FONDO ESPECIAL</td>
                  <td><?php echo '$ ' . number_format($rowndosp['recaudo_fondo_especial_valor'], 0, ",", ".") ?></td>
                  <td>
                    <?php
                    $querydgisopor = sprintf("SELECT id_not_tipo_documento, periocidad, periodo, valor_consignacion FROM not_documento WHERE estado_not_documento=1 AND id_not_informe=$id AND id_not_tipo_documento=3");
                    $selectdgisopor = mysql_query($querydgisopor, $conexion) or die(mysql_error());
                    $rowndosopor = mysql_fetch_assoc($selectdgisopor);
                    if (3 == $rowndosopor['id_not_tipo_documento']) {
                      echo '$ ' . number_format($rowndosopor['valor_consignacion'], 0, ",", ".");
                    } else {
                      echo '$ 0';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (3 == $rowndosopor['id_not_tipo_documento']) {
                      echo $rowndosopor['periocidad'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $rowndosopor['periodo'];
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>RECAUDO SUPERINTENDENCIA</td>
                  <td><?php echo '$ ' . number_format($rowndosp['recaudo_superintendencia_valor'], 0, ",", ".") ?></td>
                  <td>
                    <?php
                    $querydgisopor = sprintf("SELECT id_not_tipo_documento, periocidad, periodo, valor_consignacion FROM not_documento WHERE estado_not_documento=1 AND id_not_informe=$id AND id_not_tipo_documento=4");
                    $selectdgisopor = mysql_query($querydgisopor, $conexion) or die(mysql_error());
                    $rowndosopor = mysql_fetch_assoc($selectdgisopor);
                    if (4 == $rowndosopor['id_not_tipo_documento']) {
                      echo '$ ' . number_format($rowndosopor['valor_consignacion'], 0, ",", ".");
                    } else {
                      echo '$ 0';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (4 == $rowndosopor['id_not_tipo_documento']) {
                      echo $rowndosopor['periocidad'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $rowndosopor['periodo'];
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>APORTE FONDO ESPECIAL</td>
                  <td><?php echo '$ ' . number_format($rowndosp['recaudo_fondo_especial_valor'], 0, ",", ".") ?></td>
                  <td>
                    <?php
                    $querydgisopor = sprintf("SELECT id_not_tipo_documento, periocidad, periodo, valor_consignacion FROM not_documento WHERE estado_not_documento=1 AND id_not_informe=$id AND id_not_tipo_documento=5");
                    $selectdgisopor = mysql_query($querydgisopor, $conexion) or die(mysql_error());
                    $rowndosopor = mysql_fetch_assoc($selectdgisopor);
                    if (5 == $rowndosopor['id_not_tipo_documento']) {
                      echo '$ ' . number_format($rowndosopor['valor_consignacion'], 0, ",", ".");
                    } else {
                      echo '$ 0';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (5 == $rowndosopor['id_not_tipo_documento']) {
                      echo $rowndosopor['periocidad'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $rowndosopor['periodo'];
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>APORTE ADMIN. JUSTICIA</td>
                  <td><?php echo '$ ' . number_format($rowndosp['aporte_admin_justicia_valor'], 0, ",", ".") ?></td>
                  <td>
                    <?php
                    $querydgisopor = sprintf("SELECT id_not_tipo_documento, periocidad, periodo, valor_consignacion FROM not_documento WHERE estado_not_documento=1 AND id_not_informe=$id AND id_not_tipo_documento=6");
                    $selectdgisopor = mysql_query($querydgisopor, $conexion) or die(mysql_error());
                    $rowndosopor = mysql_fetch_assoc($selectdgisopor);
                    if (6 == $rowndosopor['id_not_tipo_documento']) {
                      echo '$ ' . number_format($rowndosopor['valor_consignacion'], 0, ",", ".");
                    } else {
                      echo '$ 0';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (6 == $rowndosopor['id_not_tipo_documento']) {
                      echo $rowndosopor['periocidad'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $rowndosopor['periodo'];
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>FONDO ROTATORIO DE LA RNEC</td>
                  <td><?php echo '$ ' . number_format($rowndosp['fondo_rotatorio_rnec_valor'], 0, ",", ".") ?></td>
                  <td>
                    <?php
                    $querydgisopor = sprintf("SELECT id_not_tipo_documento, periocidad, periodo, valor_consignacion FROM not_documento WHERE estado_not_documento=1 AND id_not_informe=$id AND id_not_tipo_documento=7");
                    $selectdgisopor = mysql_query($querydgisopor, $conexion) or die(mysql_error());
                    $rowndosopor = mysql_fetch_assoc($selectdgisopor);
                    if (7 == $rowndosopor['id_not_tipo_documento']) {
                      echo '$ ' . number_format($rowndosopor['valor_consignacion'], 0, ",", ".");
                    } else {
                      echo '$ 0';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (7 == $rowndosopor['id_not_tipo_documento']) {
                      echo $rowndosopor['periocidad'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $rowndosopor['periodo'];
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td><b>TOTALES</b></td>
                  <?php $totalndo = $rowndosp['iva_valor'] + $rowndosp['retencion_fuente_valor'] + $rowndosp['recaudo_fondo_especial_valor'] + $rowndosp['recaudo_superintendencia_valor']  + $rowndosp['aporte_fondo_especial_valor'] + $rowndosp['aporte_admin_justicia_valor'] + $rowndosp['fondo_rotatorio_rnec_valor']; ?>
                  <td><b><?php echo '$ ' . number_format($totalndo, 0, ",", ".") ?></b></td>
                  <td>
                    <?php
                    $querydgisoporS = sprintf("SELECT SUM(not_documento.valor_consignacion) AS sumapagodoc FROM not_documento WHERE id_not_informe=$id AND estado_not_documento=1");
                    $selectdgisoporS = mysql_query($querydgisoporS, $conexion) or die(mysql_error());
                    $rowndosoporS = mysql_fetch_assoc($selectdgisoporS);
                    echo '<b>$ ' . number_format($rowndosoporS['sumapagodoc'], 0, ",", ".") . '</b>';
                    ?>
                  </td>
                  <td></td>
                </tr>
              </table>
            </div>

            <div style="padding: 5px 10%;">
              <h5><b>SOPORTE OBLIGACIONES</b></h5>
              <?php
              $actualizar56 = mysql_query("SELECT * FROM not_documento
                                      LEFT JOIN not_tipo_documento
                                      ON not_documento.id_not_tipo_documento=not_tipo_documento.id_not_tipo_documento
                                      WHERE id_not_informe=$id and estado_not_documento=1 and tipo_seleccion = 1
                                      ORDER BY id_not_documento", $conexion) or die(mysql_error());
              $row156 = mysql_fetch_assoc($actualizar56);
              $total556 = mysql_num_rows($actualizar56);
              if (0 < $total556) {
                do {
                  if (1 == $estadoCierreIEN or 1 == $_SESSION['rol']) {
                    echo '<a href="filesnr/informeestadisticonotarial/' . $row156['url_not_documento'] . '" target="_blank"><img src="images/pdf.png"></a> ' . $row156['nombre_not_tipo_documento'] . '<br>';
                  }
                  if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {
                    echo '<a href="filesnr/informeestadisticonotarial/' . $row156['url_not_documento'] . '" target="_blank"><img src="images/pdf.png"></a> ' . $row156['nombre_not_tipo_documento'];
                    echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="not_documento" id="' . $row156['id_not_documento'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>' . '<br>';
                  }
                } while ($row156 = mysql_fetch_assoc($actualizar56));
                mysql_free_result($actualizar56);
              } else {
              }
              ?>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- NOVEDADES DEL MES -->
          <div class="col-md-12">

            <!-- UPDATE  NOVEDADES DEL MES -->
            <?php
            if (isset($_POST['update_not_ndmes'])) {

              $updateSQL = sprintf(
                "UPDATE not_novedades_mes SET 

                  ndmes_ddp=%s,
                  ndmes_ddl=%s

                  where id_not_informe=%s",
                GetSQLValueString($_POST["ndmes_ddp"], "int"),
                GetSQLValueString($_POST["ndmes_ddl"], "int"),
                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["ndmes_ddp"];
                $c2 = $_POST["ndmes_ddl"];

                $sql = "UPDATE SNINDET_NOV_MES_TRANSACTION  SET 

                ndmes_ddp=$c1,
                ndmes_ddl=$c2

                WHERE id_not_informe=$id";

                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            $querynnm = sprintf("SELECT * FROM not_novedades_mes where id_not_informe =$id LIMIT 1");
            $updatennm = mysql_query($querynnm, $conexion) or die(mysql_error());
            $rownnm = mysql_fetch_assoc($updatennm);
            $totalRowsnnm = mysql_num_rows($updatennm);
            if (0 < $totalRowsnnm) {
            ?>


              <div class="modal fade" id="popnovedadesmes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="not_novedades_mes">

                        <h5><b> NOVEDADES DEL MES </b></h5>

                        <table class="table">
                          <tr>
                            <td><b>dias de permiso<b></td>
                            <td><input type="number" class="form-control" name="ndmes_ddp" value="<?php echo htmlentities($rownnm['ndmes_ddp'], ENT_COMPAT, ''); ?>" required /></td>
                            <td><b>dias de licencia<b></td>
                            <td><input type="number" class="form-control" name="ndmes_ddl" value="<?php echo htmlentities($rownnm['ndmes_ddl'], ENT_COMPAT, ''); ?>" required /></td>
                          <tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="update_not_ndmes" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($updatennm);



            $querynnm1 = sprintf("SELECT * FROM not_novedades_mes where id_not_informe =$id LIMIT 1");
            $selectnnm1 = mysql_query($querynnm1, $conexion) or die(mysql_error());
            $rownnm1 = mysql_fetch_assoc($selectnnm1);
            $estado = $rownnm1['estado_not_novedades_mes'];

            if (isset($_POST['ingreso_not_novedades_mes'])) {
              $insertSQL = sprintf(
                "INSERT INTO not_novedades_mes (
                id_not_informe,

                ndmes_ddp,
                ndmes_ddl

                ) VALUES (%s, %s,%s)",
                GetSQLValueString($id, "int"),

                GetSQLValueString($_POST["ndmes_ddp"], "int"),
                GetSQLValueString($_POST["ndmes_ddl"], "int")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["ndmes_ddp"];
                $c2 = $_POST["ndmes_ddl"];
                $sql = "INSERT INTO SNINDET_NOV_MES_TRANSACTION(
                  id_not_novedades_mes, 
                  id_not_informe,
                  ndmes_ddp,
                  ndmes_ddl,
                  fec_ahora_ndmes)
                VALUES 
                ($idInsert,
                $id,
                $c1,
                $c2,
                '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            if ($estado == NULL) {
            ?>

              <form method="POST" name="ingreso_not_novedades_mes">

                <hr>
                <h5><b> NOVEDADES DEL MES</b></h5>

                <table class="table">
                  <tr>
                    <td><b>dias de permiso<b></td>
                    <td><input type="number" class="form-control" name="ndmes_ddp" required /></td>
                    <td><b>dias de licencia<b></td>
                    <td><input type="number" class="form-control" name="ndmes_ddl" required /></td>
                  <tr>
                </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_novedades_mes" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <hr>
              <h5><b> NOVEDADES DEL MES</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#popnovedadesmes" title="MODIFICAR NOVEDADES DEL MES"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span>Editar</button></a>
                <?php } else {
                } ?>
              </h5>

              <table class="table">
                <tr>
                  <td><b>dias de permiso<b></td>
                  <td><?php echo $rownnm1['ndmes_ddp'] ?></td>
                  <td><b>dias de licencia<b></td>
                  <td><?php echo $rownnm1['ndmes_ddl'] ?></td>
                <tr>
              </table>

            <?php } ?>
          </div>
        </div>


        <div class="row">
          <div class="col-md-6">
            <hr>
            <h5><b>INGRESOS</b></h5>

            <table class="table">
              <tr>
                <td><b>Por Escrituracion</b></td>
                <td><b><?php echo '$' . number_format($totalnot_detalle_ingreso_escrituracion1, 0, ",", ".") ?></b></td>
              </tr>
              <tr>
                <td><b>Por otros actos Notariales</b></td>
                <td><b><?php echo '$' . number_format($totalnot_ingreso_conceptos_varios, 0, ",", ".") ?></b></td>
              </tr>
              <tr>
                <td><b>TOTAL DE INGRESOS</b></td>
                <td><b><?php $totalingresos = $totalnot_detalle_ingreso_escrituracion1 + $totalnot_ingreso_conceptos_varios;
                        echo '$' . number_format($totalingresos, 0, ",", ".") ?></b></td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <hr>
            <h5><b>EGRESOS</b></h5>
            <table class="table">
              <tr>
                <td><b>Gastos de Personal</b></td>
                <td><b><?php echo '$' . number_format($totaldgdper, 0, ",", "."); ?></b></td>
              </tr>
              <tr>
                <td><b>Gastos Generales</b></td>
                <td><b><?php echo '$' . number_format($totaldgg, 0, ",", "."); ?></b></td>
              </tr>
              <tr>
                <td><b>Transferencias</b></td>
                <td><b><?php echo '$' . number_format($totaldt, 0, ",", "."); ?></b></td>
              </tr>
              <tr>
                <td><b>TOTAL DE EGRESOS</b></td>
                <td><b><?php $totalegresos = $totaldgdper + $totaldgg + $totaldt;
                        echo '$' . number_format($totalegresos, 0, ",", ".") ?></b></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <hr>
            <h5><b>NETO</b></h5>
            <table class="table">
              <tr>
                <td><b>INGRESOS NETOS<br></b></td>
                <td><b><?php $totalneto = $totalingresos - $totalegresos;
                        echo '$' . number_format($totalneto, 0, ",", ".") ?></b></td>
              </tr>
            </table>
          </div>

          <!-- VALOR SUBSIDIO -->
          <div class="col-md-6">
            <!-- UPDATE VALOR SUBSIDIO -->
            <?php
            if (isset($_POST['update_valor_subsidio'])) {

              $updateSQL = sprintf(
                "UPDATE not_valor_subsidio SET 
                  valor_subsidio=%s
                  WHERE id_not_informe=%s",
                GetSQLValueString($_POST["valor_subsidio"], "number"),
                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["valor_subsidio"];
                $sql = "UPDATE SNINDET_VAL_SUB_TRANSACTION  SET 
                valor_subsidio=$c1
                WHERE id_not_informe=$id";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }

            $queryvs = sprintf("SELECT * FROM not_valor_subsidio WHERE id_not_informe = $id LIMIT 1");
            $updatevs = mysql_query($queryvs, $conexion) or die(mysql_error());
            $rowvs = mysql_fetch_assoc($updatevs);
            $totalRowsvs = mysql_num_rows($updatevs);
            if (0 < $totalRowsvs) {
            ?>

              <div class="modal fade" id="poddetallevalorsubsidio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div id="nuevaAventura" class="modal-body">
                      <form method="POST" name="not_valor_subsidio">

                        <h5><b>VALOR SUBSIDIO</b></h5>

                        <table class="table">
                          <tr>
                            <td><b>VALOR</b></td>
                            <td>
                              <input type="number" class="form-control" name="valor_subsidio" value="<?php echo htmlentities($rowvs['valor_subsidio'], ENT_COMPAT, ''); ?>" required />
                            </td>
                          </tr>
                        </table>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="submit" name="update_valor_subsidio" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            mysql_free_result($updatevs);


            $queryvs1 = sprintf("SELECT * FROM not_valor_subsidio where id_not_informe=$id LIMIT 1");
            $selectvs1 = mysql_query($queryvs1, $conexion) or die(mysql_error());
            $rowvs1 = mysql_fetch_assoc($selectvs1);
            $estado = $rowvs1['estado_not_valor_subsidio'];

            if (isset($_POST['guardar_valor_subsidio'])) {

              $insertSQL = sprintf(
                "INSERT INTO not_valor_subsidio (
                id_not_informe,
                valor_subsidio) VALUES (%s,%s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST["valor_subsidio"], "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $c1 = $_POST["valor_subsidio"];
                $sql = "INSERT INTO SNINDET_VAL_SUB_TRANSACTION(
                  id_not_valor_subsidio, 
                  id_not_informe,
                  valor_subsidio,
                  fecha_actual_not_valor_subsidio)
                VALUES 
                ($idInsert,
                $id,
                '$c1',
                '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            if ($estado == 0) {
            ?>

              <form action="" name="valorsubsidiado" method="POST">
                <hr>
                <h5><b>VALOR SUBSIDIO</b></h5>
                <table class="table">
                  <tr>
                    <td><b> VALOR </b></td>
                    <td>
                      <input type="number" class="form-control" name="valor_subsidio" required />
                    </td>
                  </tr>
                </table>
                <div class="modal-footer">
                  <button type="submit" name="guardar_valor_subsidio" class="btn btn-success btn-sm">Guardar</button>
                </div>
              </form>

            <?php } else { ?>

              <hr>
              <h5><b>VALOR SUBSIDIO</b>
                <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                  <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#poddetallevalorsubsidio" title="MODIFICAR VALOR SUBSIDIO"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span>Editar</button></a>
                <?php } ?>
              </h5>

              <table class="table">
                <tr>
                  <td><b>VALOR</b></td>
                  <td><?php echo '$ ' . number_format((float)$rowvs1['valor_subsidio'], 0, ",", ".") ?></td>
                </tr>
              </table>

            <?php } ?>
          </div>
        </div>
      </div>

      <div class="box">
        <div class="box-header with-border">
          <h5>
            <a href="notaria_informe&<?php echo $id_notaria; ?>.jsp" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-left"></span> Regresar </a>&nbsp; &nbsp; &nbsp;
            <b>Actualización Formato de Recaudos &nbsp; &nbsp; &nbsp; <?php echo $fecini; ?> &nbsp; | &nbsp; <?php echo $fecfinal; ?></b>
          </h5>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <!-- UPDATE DETALLE RECAUDO  -->
          <?php
            if (isset($_POST['update_not_recaudo'])) {
              $num_resolucion = $_POST["num_resolucion"];
              $notas_aclaraciones = $_POST["notas_aclaraciones"];

              $sinc_cdeam = $_POST["sinc_cdeam"];
              $sinc_vrpervdt = $_POST["sinc_vrpervdt"];
              $sinc_vtr = $sinc_cdeam * $sinc_vrpervdt;
              $sinc_vcpef50 = $sinc_vtr / 2;
              $sinc_vcpsnr = $sinc_vtr / 2;

              $cien_cdeam = $_POST["0100_cdeam"];
              $cien_vrpervdt = $_POST["0100_vrpervdt"];
              $cien_vtr = $cien_cdeam * $cien_vrpervdt;
              $cien_vcpef50 = $cien_vtr / 2;
              $cien_vcpsnr = $cien_vtr / 2;

              $cienmil_cdeam = $_POST["100300_cdeam"];
              $cienmil_vrpervdt = $_POST["100300_vrpervdt"];
              $cienmil_vtr = $cienmil_cdeam * $cienmil_vrpervdt;
              $cienmil_vcpef50 = $cienmil_vtr / 2;
              $cienmil_vcpsnr = $cienmil_vtr / 2;

              $trecientosmil_cdeam = $_POST["300500_cdeam"];
              $trecientosmil_vrpervdt = $_POST["300500_vrpervdt"];
              $trecientosmil_vtr = $trecientosmil_cdeam * $trecientosmil_vrpervdt;
              $trecientosmil_vcpef50 = $trecientosmil_vtr / 2;
              $trecientosmil_vcpsnr = $trecientosmil_vtr / 2;

              $cincomillones_cdeam = $_POST["5001000_cdeam"];
              $cincomillones_vrpervdt = $_POST["5001000_vrpervdt"];
              $cincomillones_vtr = $cincomillones_cdeam * $cincomillones_vrpervdt;
              $cincomillones_vcpef50 = $cincomillones_vtr / 2;
              $cincomillones_vcpsnr = $cincomillones_vtr / 2;

              $diezmillones_cdeam = $_POST["100015000_cdeam"];
              $diezmillones_vrpervdt = $_POST["100015000_vrpervdt"];
              $diezmillones_vtr = $diezmillones_cdeam * $diezmillones_vrpervdt;
              $diezmillones_vcpef50 = $diezmillones_vtr / 2;
              $diezmillones_vcpsnr = $diezmillones_vtr / 2;

              $eamillones_cdeam = $_POST["1500ea_cdeam"];
              $eamillones_vrpervdt = $_POST["1500ea_vrpervdt"];
              $eamillones_vtr = $eamillones_cdeam * $eamillones_vrpervdt;
              $eamillones_vcpef50 = $eamillones_vtr / 2;
              $eamillones_vcpsnr = $eamillones_vtr / 2;

              $updateSQL = sprintf(
                "UPDATE not_recaudo SET 

                num_resolucion=%s,
                notas_aclaraciones=%s,

                sinc_cdeam=%s,
                sinc_vrpervdt=%s,
                sinc_vtr=%s,
                sinc_vcpef50=%s,
                sinc_vcpsnr=%s,

                0100_cdeam=%s,
                0100_vrpervdt=%s,
                0100_vtr=%s,
                0100_vcpef50=%s,
                0100_vcpsnr=%s,

                100300_cdeam=%s,
                100300_vrpervdt=%s,
                100300_vtr=%s,
                100300_vcpef50=%s,
                100300_vcpsnr=%s,

                300500_cdeam=%s,
                300500_vrpervdt=%s,
                300500_vtr=%s,
                300500_vcpef50=%s,
                300500_vcpsnr=%s,

                5001000_cdeam=%s,
                5001000_vrpervdt=%s,
                5001000_vtr=%s,
                5001000_vcpef50=%s,
                5001000_vcpsnr=%s,

                100015000_cdeam=%s,
                100015000_vrpervdt=%s,
                100015000_vtr=%s,
                100015000_vcpef50=%s,
                100015000_vcpsnr=%s,

                1500ea_cdeam=%s,
                1500ea_vrpervdt=%s,
                1500ea_vtr=%s,
                1500ea_vcpef50=%s,
                1500ea_vcpsnr=%s

                WHERE id_not_informe=%s",
                GetSQLValueString($num_resolucion, "text"),
                GetSQLValueString($notas_aclaraciones, "text"),

                GetSQLValueString($sinc_cdeam, "number"),
                GetSQLValueString($sinc_vrpervdt, "number"),
                GetSQLValueString($sinc_vtr, "number"),
                GetSQLValueString($sinc_vcpef50, "number"),
                GetSQLValueString($sinc_vcpsnr, "number"),

                GetSQLValueString($cien_cdeam, "number"),
                GetSQLValueString($cien_vrpervdt, "number"),
                GetSQLValueString($cien_vtr, "number"),
                GetSQLValueString($cien_vcpef50, "number"),
                GetSQLValueString($cien_vcpsnr, "number"),

                GetSQLValueString($cienmil_cdeam, "number"),
                GetSQLValueString($cienmil_vrpervdt, "number"),
                GetSQLValueString($cienmil_vtr, "number"),
                GetSQLValueString($cienmil_vcpef50, "number"),
                GetSQLValueString($cienmil_vcpsnr, "number"),

                GetSQLValueString($trecientosmil_cdeam, "number"),
                GetSQLValueString($trecientosmil_vrpervdt, "number"),
                GetSQLValueString($trecientosmil_vtr, "number"),
                GetSQLValueString($trecientosmil_vcpef50, "number"),
                GetSQLValueString($trecientosmil_vcpsnr, "number"),

                GetSQLValueString($cincomillones_cdeam, "number"),
                GetSQLValueString($cincomillones_vrpervdt, "number"),
                GetSQLValueString($cincomillones_vtr, "number"),
                GetSQLValueString($cincomillones_vcpef50, "number"),
                GetSQLValueString($cincomillones_vcpsnr, "number"),

                GetSQLValueString($diezmillones_cdeam, "number"),
                GetSQLValueString($diezmillones_vrpervdt, "number"),
                GetSQLValueString($diezmillones_vtr, "number"),
                GetSQLValueString($diezmillones_vcpef50, "number"),
                GetSQLValueString($diezmillones_vcpsnr, "number"),

                GetSQLValueString($eamillones_cdeam, "number"),
                GetSQLValueString($eamillones_vrpervdt, "number"),
                GetSQLValueString($eamillones_vtr, "number"),
                GetSQLValueString($eamillones_vcpef50, "number"),
                GetSQLValueString($eamillones_vcpsnr, "number"),

                GetSQLValueString($id, "int")
              );
              $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

              // UPDATE ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $sql = "UPDATE SNRECAUDO_TRANSACTION  SET 
                  num_resolucion='$num_resolucion',
                  notas_aclaraciones='$notas_aclaraciones',

                  sinc_cdeam=$sinc_cdeam,
                  sinc_vrpervdt='$sinc_vrpervdt',
                  sinc_vtr='$sinc_vtr',
                  sinc_vcpef50='$sinc_vcpef50',
                  sinc_vcpsnr='$sinc_vcpsnr',

                  sinc_0100_cdeam=$cien_cdeam,
                  sinc_0100_vrpervdt='$cien_vrpervdt',
                  sinc_0100_vtr='$cien_vtr',
                  sinc_0100_vcpef50='$cien_vcpef50',
                  sinc_0100_vcpsnr='$cien_vcpsnr',

                  sinc_100300_cdeam=$cienmil_cdeam,
                  sinc_100300_vrpervdt='$cienmil_vrpervdt',
                  sinc_100300_vtr='$cienmil_vtr',
                  sinc_100300_vcpef50='$cienmil_vcpef50',
                  sinc_100300_vcpsnr='$cienmil_vcpsnr',

                  sinc_300500_cdeam=$trecientosmil_cdeam,
                  sinc_300500_vrpervdt='$trecientosmil_vrpervdt',
                  sinc_300500_vtr='$trecientosmil_vtr',
                  sinc_300500_vcpef50='$trecientosmil_vcpef50',
                  sinc_300500_vcpsnr='$trecientosmil_vcpsnr',

                  sinc_5001000_cdeam=$cincomillones_cdeam,
                  sinc_5001000_vrpervdt='$cincomillones_vrpervdt',
                  sinc_5001000_vtr='$cincomillones_vtr',
                  sinc_5001000_vcpef50='$cincomillones_vcpef50',
                  sinc_5001000_vcpsnr='$cincomillones_vcpsnr',

                  sinc_100015000_cdeam=$diezmillones_cdeam,
                  sinc_100015000_vrpervdt='$diezmillones_vrpervdt',
                  sinc_100015000_vtr='$diezmillones_vtr',
                  sinc_100015000_vcpef50='$diezmillones_vcpef50',
                  sinc_100015000_vcpsnr='$diezmillones_vcpsnr',

                  sinc_1500ea_cdeam=$eamillones_cdeam,
                  sinc_1500ea_vrpervdt='$eamillones_vrpervdt',
                  sinc_1500ea_vtr='$eamillones_vtr',
                  sinc_1500ea_vcpef50='$eamillones_vcpef50',
                  sinc_1500ea_vcpsnr='$eamillones_vcpsnr'

              WHERE id_not_informe=$id";

                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            $querynr = sprintf("SELECT * FROM not_recaudo where id_not_informe=$id LIMIT 1");
            $updatenr = mysql_query($querynr, $conexion) or die(mysql_error());
            $rownr = mysql_fetch_assoc($updatenr);
            $totalRowsnr = mysql_num_rows($updatenr);
            if (0 < $totalRowsnr) {
          ?>


            <div class="modal fade" id="pop_recaudo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width: 900px;">
                  <div id="nuevaAventura" class="modal-body">
                    <form method="POST" name="pop_recaudo">

                      <h5><b>FORMATO DE RECAUDOS</b></h5>

                      <table class="table">
                        <tr>
                          <th colspan="2" style="width: 200px; text-align: center;"><b>CUANTIA</b></th>
                          <th style="text-align: center;"><b>CANTIDAD DE ESCRITURAS REALIZADAS MES (A)</b></th>
                          <th style="text-align: center;"><b>VALOR TARIFAS POR RECAUDO</b><br><span style="color:rgb(155, 155, 155); font-size:8px;">(Resolucion Vigentede tarifas)</span></th>
                          <th style="text-align: center;"><b>VALOR TOTAL RECAUDADO (A X B) = C</b></th>
                          <th style="text-align: center;"><b>VALOR CONSIGNADO PARA EL FONDO 50% DE C</b></th>
                          <th style="text-align: center;"><b>VALOR CONSIGNADO PARA SNR 50% DE C<b></th>
                        </tr>
                        <tr>
                          <td colspan="2">Actos sin cuantia y escrituras exentas de pago de derecho notarial.</td>
                          <td><input class="form-control" type="number" name="sinc_cdeam" value="<?php echo $rownr['sinc_cdeam']; ?>" required></td>
                          <td>
                            <input type="number" name="sinc_vrpervdt" class="form-control" value="<?php echo $rownr['sinc_vrpervdt']; ?>" required />
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['sinc_vtr'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['sinc_vcpef50'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['sinc_vcpsnr'], 0, ",", "."); ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td>$0</td>
                          <td>$100.000.000</td>
                          <td><input type="number" class="form-control" name="0100_cdeam" value="<?php echo $rownr['0100_cdeam']; ?>" required></td>
                          <td>
                            <input type="number" name="0100_vrpervdt" class="form-control" value="<?php echo $rownr['0100_vrpervdt']; ?>" required />
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['0100_vtr'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['0100_vcpef50'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['0100_vcpsnr'], 0, ",", "."); ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td>$100.000.001</td>
                          <td>$300.000.000</td>
                          <td><input type="number" class="form-control" name="100300_cdeam" value="<?php echo $rownr['100300_cdeam']; ?>" required></td>
                          <td>
                            <input type="number" name="100300_vrpervdt" class="form-control" value="<?php echo $rownr['100300_vrpervdt']; ?>" required />
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['100300_vtr'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['100300_vcpef50'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['100300_vcpsnr'], 0, ",", "."); ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td>$300.000.001</td>
                          <td>$500.000.000</td>
                          <td><input type="number" class="form-control" name="300500_cdeam" value="<?php echo $rownr['300500_cdeam']; ?>" required></td>
                          <td>
                            <input type="number" name="300500_vrpervdt" class="form-control" value="<?php echo $rownr['300500_vrpervdt']; ?>" required />
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['300500_vtr'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['300500_vcpef50'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['300500_vcpsnr'], 0, ",", "."); ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td>$500.000.001</td>
                          <td>$1.000.000.000</td>
                          <td><input type="number" class="form-control" name="5001000_cdeam" value="<?php echo $rownr['5001000_cdeam']; ?>" required></td>
                          <td>
                            <input type="number" name="5001000_vrpervdt" class="form-control" value="<?php echo $rownr['5001000_vrpervdt']; ?>" required />
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['5001000_vtr'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['5001000_vcpef50'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['5001000_vcpsnr'], 0, ",", "."); ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td>$1.000.000.001</td>
                          <td>$1.500.000.000</td>
                          <td><input class="form-control" type="number" name="100015000_cdeam" value="<?php echo $rownr['100015000_cdeam']; ?>" required></td>
                          <td>
                            <input type="number" name="100015000_vrpervdt" class="form-control" value="<?php echo $rownr['100015000_vrpervdt']; ?>" required />
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['100015000_vtr'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['100015000_vcpef50'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['100015000_vcpsnr'], 0, ",", "."); ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td>$1.500.000.001</td>
                          <td>En Adelante<br></td>
                          <td><input class="form-control" type="number" name="1500ea_cdeam" value="<?php echo $rownr['1500ea_cdeam']; ?>" required></td>
                          <td>
                            <input type="number" name="1500ea_vrpervdt" class="form-control" value="<?php echo $rownr['1500ea_vrpervdt']; ?>" required />
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['1500ea_vtr'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['1500ea_vcpef50'], 0, ",", "."); ?></span>
                          </td>
                          <td>
                            <span class="form-control" disabled><?php echo number_format((float)$rownr['1500ea_vcpsnr'], 0, ",", "."); ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><b>Total</b></td>
                          <td>
                            <?php
                            echo $total1 =
                              $rownr['sinc_cdeam'] +
                              $rownr['0100_cdeam'] +
                              $rownr['100300_cdeam'] +
                              $rownr['300500_cdeam'] +
                              $rownr['5001000_cdeam'] +
                              $rownr['100015000_cdeam'] +
                              $rownr['1500ea_cdeam'];
                            ?>
                          </td>
                          <td>
                            <?php
                            $total2 =
                              $rownr['sinc_vrpervdt'] +
                              $rownr['0100_vrpervdt'] +
                              $rownr['100300_vrpervdt'] +
                              $rownr['300500_vrpervdt'] +
                              $rownr['5001000_vrpervdt'] +
                              $rownr['100015000_vrpervdt'] +
                              $rownr['1500ea_vrpervdt'];
                            echo '$ ' . number_format((float)$total2, 0, ",", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $total3 =
                              $rownr['sinc_vtr'] +
                              $rownr['0100_vtr'] +
                              $rownr['100300_vtr'] +
                              $rownr['300500_vtr'] +
                              $rownr['5001000_vtr'] +
                              $rownr['100015000_vtr'] +
                              $rownr['1500ea_vtr'];
                            echo '$ ' . number_format((float)$total3, 0, ",", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $total4 =
                              $rownr['sinc_vcpef50'] +
                              $rownr['0100_vcpef50'] +
                              $rownr['100300_vcpef50'] +
                              $rownr['300500_vcpef50'] +
                              $rownr['5001000_vcpef50'] +
                              $rownr['100015000_vcpef50'] +
                              $rownr['1500ea_vcpef50'];
                            echo '$ ' . number_format((float)$total4, 0, ",", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $total5 =
                              $rownr['sinc_vcpsnr'] +
                              $rownr['0100_vcpsnr'] +
                              $rownr['100300_vcpsnr'] +
                              $rownr['300500_vcpsnr'] +
                              $rownr['5001000_vcpsnr'] +
                              $rownr['100015000_vcpsnr'] +
                              $rownr['1500ea_vcpsnr'];
                            echo '$ ' . number_format((float)$total5, 0, ",", ".");
                            ?>
                          </td>
                        </tr>
                      </table>
                      <table class="table">
                        <tr>
                          <td><b>Numero de Resolucion</b></td>
                          <td><input type="text" name="num_resolucion" class="form-control" value="<?php echo $rownr['num_resolucion']; ?>" required /></td>
                          <td><b>Notas Y Aclaraciones</b></td>
                          <td><textarea name="notas_aclaraciones" style="min-height:20px; width:100%;"><?php echo $rownr['notas_aclaraciones']; ?></textarea></td>
                        </tr>
                      </table>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="update_not_recaudo" class="btn btn-success">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php
            }
            mysql_free_result($updatenr);



            $querynr1 = sprintf("SELECT * FROM not_recaudo where id_not_informe=$id LIMIT 1");
            $selectnr1 = mysql_query($querynr1, $conexion) or die(mysql_error());
            $rownr1 = mysql_fetch_assoc($selectnr1);

            $estado = $rownr1['estado_not_recaudo'];


            if (isset($_POST['ingreso_notaria_recaudo'])) {
              $num_resolucion = $_POST["num_resolucion"];
              $notas_aclaraciones = $_POST["notas_aclaraciones"];

              $sinc_cdeam = $_POST["sinc_cdeam"];
              $sinc_vrpervdt = $_POST["sinc_vrpervdt"];
              $sinc_vtr = $sinc_cdeam * $sinc_vrpervdt;
              $sinc_vcpef50 = $sinc_vtr / 2;
              $sinc_vcpsnr = $sinc_vtr / 2;

              $cien_cdeam = $_POST["0100_cdeam"];
              $cien_vrpervdt = $_POST["0100_vrpervdt"];
              $cien_vtr = $cien_cdeam * $cien_vrpervdt;
              $cien_vcpef50 = $cien_vtr / 2;
              $cien_vcpsnr = $cien_vtr / 2;

              $cienmil_cdeam = $_POST["100300_cdeam"];
              $cienmil_vrpervdt = $_POST["100300_vrpervdt"];
              $cienmil_vtr = $cienmil_cdeam * $cienmil_vrpervdt;
              $cienmil_vcpef50 = $cienmil_vtr / 2;
              $cienmil_vcpsnr = $cienmil_vtr / 2;

              $trecientosmil_cdeam = $_POST["300500_cdeam"];
              $trecientosmil_vrpervdt = $_POST["300500_vrpervdt"];
              $trecientosmil_vtr = $trecientosmil_cdeam * $trecientosmil_vrpervdt;
              $trecientosmil_vcpef50 = $trecientosmil_vtr / 2;
              $trecientosmil_vcpsnr = $trecientosmil_vtr / 2;

              $cincomillones_cdeam = $_POST["5001000_cdeam"];
              $cincomillones_vrpervdt = $_POST["5001000_vrpervdt"];
              $cincomillones_vtr = $cincomillones_cdeam * $cincomillones_vrpervdt;
              $cincomillones_vcpef50 = $cincomillones_vtr / 2;
              $cincomillones_vcpsnr = $cincomillones_vtr / 2;

              $diezmillones_cdeam = $_POST["100015000_cdeam"];
              $diezmillones_vrpervdt = $_POST["100015000_vrpervdt"];
              $diezmillones_vtr = $diezmillones_cdeam * $diezmillones_vrpervdt;
              $diezmillones_vcpef50 = $diezmillones_vtr / 2;
              $diezmillones_vcpsnr = $diezmillones_vtr / 2;

              $eamillones_cdeam = $_POST["1500ea_cdeam"];
              $eamillones_vrpervdt = $_POST["1500ea_vrpervdt"];
              $eamillones_vtr = $eamillones_cdeam * $eamillones_vrpervdt;
              $eamillones_vcpef50 = $eamillones_vtr / 2;
              $eamillones_vcpsnr = $eamillones_vtr / 2;

              $insertSQL = sprintf(
                "INSERT INTO not_recaudo (

                id_not_informe,
                num_resolucion,
                notas_aclaraciones,

                sinc_cdeam,
                sinc_vrpervdt, 
                sinc_vtr,
                sinc_vcpef50, 
                sinc_vcpsnr, 

                0100_cdeam,
                0100_vrpervdt,
                0100_vtr,
                0100_vcpef50, 
                0100_vcpsnr, 

                100300_cdeam, 
                100300_vrpervdt, 
                100300_vtr,
                100300_vcpef50, 
                100300_vcpsnr, 

                300500_cdeam, 
                300500_vrpervdt,
                300500_vtr, 
                300500_vcpef50, 
                300500_vcpsnr, 

                5001000_cdeam,
                5001000_vrpervdt, 
                5001000_vtr,
                5001000_vcpef50, 
                5001000_vcpsnr, 

                100015000_cdeam, 
                100015000_vrpervdt,
                100015000_vtr, 
                100015000_vcpef50, 
                100015000_vcpsnr, 

                1500ea_cdeam, 
                1500ea_vrpervdt, 
                1500ea_vtr,
                1500ea_vcpef50, 
                1500ea_vcpsnr) VALUES (%s,%s, %s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($num_resolucion, "text"),
                GetSQLValueString($notas_aclaraciones, "text"),

                GetSQLValueString($sinc_cdeam, "number"),
                GetSQLValueString($sinc_vrpervdt, "number"),
                GetSQLValueString($sinc_vtr, "number"),
                GetSQLValueString($sinc_vcpef50, "number"),
                GetSQLValueString($sinc_vcpsnr, "number"),

                GetSQLValueString($cien_cdeam, "number"),
                GetSQLValueString($cien_vrpervdt, "number"),
                GetSQLValueString($cien_vtr, "number"),
                GetSQLValueString($cien_vcpef50, "number"),
                GetSQLValueString($cien_vcpsnr, "number"),

                GetSQLValueString($cienmil_cdeam, "number"),
                GetSQLValueString($cienmil_vrpervdt, "number"),
                GetSQLValueString($cienmil_vtr, "number"),
                GetSQLValueString($cienmil_vcpef50, "number"),
                GetSQLValueString($cienmil_vcpsnr, "number"),

                GetSQLValueString($trecientosmil_cdeam, "number"),
                GetSQLValueString($trecientosmil_vrpervdt, "number"),
                GetSQLValueString($trecientosmil_vtr, "number"),
                GetSQLValueString($trecientosmil_vcpef50, "number"),
                GetSQLValueString($trecientosmil_vcpsnr, "number"),

                GetSQLValueString($cincomillones_cdeam, "number"),
                GetSQLValueString($cincomillones_vrpervdt, "number"),
                GetSQLValueString($cincomillones_vtr, "number"),
                GetSQLValueString($cincomillones_vcpef50, "number"),
                GetSQLValueString($cincomillones_vcpsnr, "number"),

                GetSQLValueString($diezmillones_cdeam, "number"),
                GetSQLValueString($diezmillones_vrpervdt, "number"),
                GetSQLValueString($diezmillones_vtr, "number"),
                GetSQLValueString($diezmillones_vcpef50, "number"),
                GetSQLValueString($diezmillones_vcpsnr, "number"),

                GetSQLValueString($eamillones_cdeam, "number"),
                GetSQLValueString($eamillones_vrpervdt, "number"),
                GetSQLValueString($eamillones_vtr, "number"),
                GetSQLValueString($eamillones_vcpef50, "number"),
                GetSQLValueString($eamillones_vcpsnr, "number")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
              $idInsert = mysql_insert_id($conexion);

              // INSERT ORACLE
              if (1 == $habilitarNotariaInformeOracle) {
                $sql = "INSERT INTO SNRECAUDO_TRANSACTION(
                id_not_recaudo,
                id_not_informe, 
                num_resolucion,
                notas_aclaraciones,

                sinc_cdeam,
                sinc_vrpervdt, 
                sinc_vtr,
                sinc_vcpef50, 
                sinc_vcpsnr, 

                sinc_0100_cdeam,
                sinc_0100_vrpervdt,
                sinc_0100_vtr,
                sinc_0100_vcpef50, 
                sinc_0100_vcpsnr, 

                sinc_100300_cdeam, 
                sinc_100300_vrpervdt, 
                sinc_100300_vtr,
                sinc_100300_vcpef50, 
                sinc_100300_vcpsnr, 

                sinc_300500_cdeam, 
                sinc_300500_vrpervdt,
                sinc_300500_vtr, 
                sinc_300500_vcpef50, 
                sinc_300500_vcpsnr, 

                sinc_5001000_cdeam,
                sinc_5001000_vrpervdt, 
                sinc_5001000_vtr,
                sinc_5001000_vcpef50, 
                sinc_5001000_vcpsnr, 

                sinc_100015000_cdeam, 
                sinc_100015000_vrpervdt,
                sinc_100015000_vtr, 
                sinc_100015000_vcpef50, 
                sinc_100015000_vcpsnr, 

                sinc_1500ea_cdeam, 
                sinc_1500ea_vrpervdt, 
                sinc_1500ea_vtr,
                sinc_1500ea_vcpef50, 
                sinc_1500ea_vcpsnr,
                
                fec_ahora_not_recaudo)
                VALUES 
                ($idInsert,
                $id,
                '$num_resolucion',
                '$notas_aclaraciones',

                $sinc_cdeam,
                '$sinc_vrpervdt',
                '$sinc_vtr',
                '$sinc_vcpef50',
                '$sinc_vcpsnr',

                $cien_cdeam,
                '$cien_vrpervdt',
                '$cien_vtr',
                '$cien_vcpef50',
                '$cien_vcpsnr',

                $cienmil_cdeam,
                '$cienmil_vrpervdt',
                '$cienmil_vtr',
                '$cienmil_vcpef50',
                '$cienmil_vcpsnr',

                $trecientosmil_cdeam,
                '$trecientosmil_vrpervdt',
                '$trecientosmil_vtr',
                '$trecientosmil_vcpef50',
                '$trecientosmil_vcpsnr',

                $cincomillones_cdeam,
                '$cincomillones_vrpervdt',
                '$cincomillones_vtr',
                '$cincomillones_vcpef50',
                '$cincomillones_vcpsnr',

                $diezmillones_cdeam,
                '$diezmillones_vrpervdt',
                '$diezmillones_vtr',
                '$diezmillones_vcpef50',
                '$diezmillones_vcpsnr',

                $eamillones_cdeam,
                '$eamillones_vrpervdt',
                '$eamillones_vtr',
                '$eamillones_vcpef50',
                '$eamillones_vcpsnr',
                
                '$fechaActualOracle')";
                $stmt = $getConection->prepare($sql);
                $stmt->execute();
              }

              refrescarPage();
            }


            if ($estado == NULL) {
          ?>

            <form method="POST" name="notaria_recaudo">

              <h5><b>FORMATO DE RECAUDOS</b></h5>

              <table class="table">
                <tr>
                  <th colspan="2" style="width: 200px; text-align: center;"><b>CUANTIA</b></th>
                  <th style="text-align: center;"><b>CANTIDAD DE ESCRITURAS REALIZADAS MES (A)</b></th>
                  <th style="text-align: center;"><b>VALOR TARIFAS POR RECAUDO</b><br><span style="color:rgb(155, 155, 155); font-size:8px;">(Resolucion Vigentede tarifas)</span></th>
                  <th style="text-align: center;"><b>VALOR TOTAL RECAUDADO (A X B) = C</b></th>
                  <th style="text-align: center;"><b>VALOR CONSIGNADO PARA EL FONDO 50% DE C</b></th>
                  <th style="text-align: center;"><b>VALOR CONSIGNADO PARA SNR 50% DE C<b></th>
                </tr>
                <tr>
                  <td colspan="2">Actos sin cuantia y escrituras exentas de pago de derecho notarial.</td>
                  <td><input class="form-control" type="number" name="sinc_cdeam"></td>
                  <td><input type="number" class="form-control" name="sinc_vrpervdt" required></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>$0</td>
                  <td>$100.000.000</td>
                  <td><input class="form-control" type="number" name="0100_cdeam"></td>
                  <td><input type="number" class="form-control" name="0100_vrpervdt" required></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>$100.000.001</td>
                  <td>$300.000.000</td>
                  <td><input class="form-control" type="number" name="100300_cdeam"></td>
                  <td><input type="number" class="form-control" name="100300_vrpervdt" required></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>$300.000.001</td>
                  <td>$500.000.000</td>
                  <td><input class="form-control" type="number" name="300500_cdeam"></td>
                  <td><input type="number" class="form-control" name="300500_vrpervdt" required></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>$500.000.001</td>
                  <td>$1.000.000.000</td>
                  <td><input class="form-control" type="number" name="5001000_cdeam"></td>
                  <td><input type="number" class="form-control" name="5001000_vrpervdt" required></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>$1.000.000.001</td>
                  <td>$1.500.000.000</td>
                  <td><input class="form-control" type="number" name="100015000_cdeam"></td>
                  <td><input type="number" class="form-control" name="100015000_vrpervdt" required></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>$1.500.000.001</td>
                  <td>En Adelante<br></td>
                  <td><input class="form-control" type="number" name="1500ea_cdeam"></td>
                  <td><input type="number" class="form-control" name="1500ea_vrpervdt" required></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
              <table>
                <tr>
                  <td><b>Numero de Resolucion</b></td>
                  <td><input type="text" class="form-control" name="num_resolucion" required></td>
                  <td><b>Notas Y Aclaraciones</b></td>
                  <td>
                    <textarea name="notas_aclaraciones" style="min-height:20px; width:500px;" placeholder="De ser necesario se incluyen notas y/o aclaraciones en este reporte."></textarea>
                  </td>
                  <td>
                    <span style="font-size:7px;">EL SUSCRITO NOTARIO CERTIFICA QUE LA INFORMACION CONTENIDA EN EL PRESENTE INFORME, CORRESPONDE A LOS MOVIMIENTOS DE ESCRITURACION Y RECAUDOS RECIBIDOS DEL
                      PERIODO MENSUAL QUE SE REPORTA.</span>
                  </td>
                </tr>
              </table>

              <div class="modal-footer">
                <button type="submit" name="ingreso_notaria_recaudo" class="btn btn-success btn-sm">Guardar</button>
              </div>
            </form>

          <?php } else { ?>

            <h5><b>FORMATO DE RECAUDOS</b>
              <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
                <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_recaudo" title="Modificar Aportes"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> Editar</button></a>
              <?php } ?>
            </h5>

            <table class="table">
              <tr>
                <th colspan="2" style="width: 200px; text-align: center;"><b>CUANTIA</b></th>
                <th style="text-align: center;"><b>CANTIDAD DE ESCRITURAS REALIZADAS MES (A)</b></th>
                <th style="text-align: center;"><b>VALOR TARIFAS POR RECAUDO</b><br><span style="color:rgb(155, 155, 155); font-size:8px;">(Resolucion Vigentede tarifas)</span></th>
                <th style="text-align: center;"><b>VALOR TOTAL RECAUDADO (A X B) = C</b></th>
                <th style="text-align: center;"><b>VALOR CONSIGNADO PARA EL FONDO 50% DE C</b></th>
                <th style="text-align: center;"><b>VALOR CONSIGNADO PARA SNR 50% DE C<b></th>
              </tr>
              <tr>
                <td colspan="2">Actos sin cuantia y escrituras exentas de pago de derecho notarial.</td>
                <td><?php echo $rownr1['sinc_cdeam'] ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['sinc_vrpervdt'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['sinc_vtr'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['sinc_vcpef50'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['sinc_vcpsnr'], 0, ",", ".") ?></td>
              </tr>
              <tr>
                <td>$0</td>
                <td>$100.000.000</td>
                <td><?php echo $rownr1['0100_cdeam'] ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['0100_vrpervdt'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['0100_vtr'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['0100_vcpef50'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['0100_vcpsnr'], 0, ",", ".") ?></td>
              </tr>
              <tr>
                <td>$100.000.001</td>
                <td>$300.000.000</td>
                <td><?php echo $rownr1['100300_cdeam'] ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['100300_vrpervdt'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['100300_vtr'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['100300_vcpef50'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['100300_vcpsnr'], 0, ",", ".") ?></td>
              </tr>
              <tr>
                <td>$300.000.001</td>
                <td>$500.000.000</td>
                <td><?php echo $rownr1['300500_cdeam'] ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['300500_vrpervdt'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['300500_vtr'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['300500_vcpef50'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['300500_vcpsnr'], 0, ",", ".") ?></td>
              </tr>
              <tr>
                <td>$500.000.001</td>
                <td>$1.000.000.000</td>
                <td><?php echo $rownr1['5001000_cdeam'] ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['5001000_vrpervdt'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['5001000_vtr'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['5001000_vcpef50'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['5001000_vcpsnr'], 0, ",", ".") ?></td>
              </tr>
              <tr>
                <td>$1.000.000.001</td>
                <td>$1.500.000.000</td>
                <td><?php echo $rownr1['100015000_cdeam'] ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['100015000_vrpervdt'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['100015000_vtr'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['100015000_vcpef50'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['100015000_vcpsnr'], 0, ",", ".") ?></td>
              </tr>
              <tr>
                <td>$1.500.000.001</td>
                <td>En Adelante<br></td>
                <td><?php echo $rownr1['1500ea_cdeam'] ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['1500ea_vrpervdt'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['1500ea_vtr'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['1500ea_vcpef50'], 0, ",", ".") ?></td>
                <td><?php echo '$ ' . number_format((float)$rownr1['1500ea_vcpsnr'], 0, ",", ".") ?></td>
              </tr>
              <tr>
                <td></td>
                <td><b>Total</b></td>
                <td>
                  <?php
                  echo $total1 =
                    $rownr1['sinc_cdeam'] +
                    $rownr1['0100_cdeam'] +
                    $rownr1['100300_cdeam'] +
                    $rownr1['300500_cdeam'] +
                    $rownr1['5001000_cdeam'] +
                    $rownr1['100015000_cdeam'] +
                    $rownr1['1500ea_cdeam'];
                  ?>
                </td>
                <td>
                  <?php
                  $total2 =
                    $rownr1['sinc_vrpervdt'] +
                    $rownr1['0100_vrpervdt'] +
                    $rownr1['100300_vrpervdt'] +
                    $rownr1['300500_vrpervdt'] +
                    $rownr1['5001000_vrpervdt'] +
                    $rownr1['100015000_vrpervdt'] +
                    $rownr1['1500ea_vrpervdt'];
                  echo '$ ' . number_format((float)$total2, 0, ",", ".");
                  ?>
                </td>
                <td>
                  <?php
                  $total3 =
                    $rownr1['sinc_vtr'] +
                    $rownr1['0100_vtr'] +
                    $rownr1['100300_vtr'] +
                    $rownr1['300500_vtr'] +
                    $rownr1['5001000_vtr'] +
                    $rownr1['100015000_vtr'] +
                    $rownr1['1500ea_vtr'];
                  echo '$ ' . number_format((float)$total3, 0, ",", ".");
                  ?>
                </td>
                <td>
                  <?php
                  $total4 =
                    $rownr1['sinc_vcpef50'] +
                    $rownr1['0100_vcpef50'] +
                    $rownr1['100300_vcpef50'] +
                    $rownr1['300500_vcpef50'] +
                    $rownr1['5001000_vcpef50'] +
                    $rownr1['100015000_vcpef50'] +
                    $rownr1['1500ea_vcpef50'];
                  echo '$ ' . number_format((float)$total4, 0, ",", ".");
                  ?>
                </td>
                <td>
                  <?php
                  $total5 =
                    $rownr1['sinc_vcpsnr'] +
                    $rownr1['0100_vcpsnr'] +
                    $rownr1['100300_vcpsnr'] +
                    $rownr1['300500_vcpsnr'] +
                    $rownr1['5001000_vcpsnr'] +
                    $rownr1['100015000_vcpsnr'] +
                    $rownr1['1500ea_vcpsnr'];
                  echo '$ ' . number_format((float)$total5, 0, ",", ".");
                  ?>
                </td>
              </tr>
            </table>
            <table class="table">
              <tr>
                <td><b>Numero de Resolucion</b></td>
                <td><?php echo $rownr1['num_resolucion']; ?></td>
                <td><b>Notas Y Aclaraciones</b></td>
                <td><?php echo $rownr1['notas_aclaraciones']; ?></td>
              </tr>
            </table>

          <?php } ?>
        </div>
      </div>
    </div> <!-- col-md-9 -->

    <div class="col-md-3">
      <?php
            $querycierre = sprintf(
              "SELECT 
            estado_not_escrituracion,
            estado_not_aporte,
            (SELECT COUNT(estado_not_aporte_especial) FROM not_aporte_especial WHERE estado_not_aporte_especial=1) AS aporteespecial,
            (SELECT COUNT(estado_not_detalle_ingreso_escrituracion) FROM not_detalle_ingreso_escrituracion WHERE estado_not_detalle_ingreso_escrituracion=1) AS ingresoescrituracion,
            (SELECT COUNT(estado_not_ingreso_conceptos_varios) FROM not_ingreso_conceptos_varios WHERE estado_not_ingreso_conceptos_varios=1) AS ingresoConceptosVarios,
            estado_not_detalle_inscripcion_registro_civil,
            estado_not_detalle_gastos_generales,
            estado_not_detalle_gastos_personal,
            estado_not_detalle_transferencias,
            estado_not_detalle_gastos_inversion,
            estado_not_novedades_mes,
            estado_not_recaudo,
            estado_not_valor_subsidio,
            estado_not_detalle_obligaciones,
            (SELECT COUNT(estado_not_documento) FROM not_documento WHERE estado_not_documento=1 and id_not_informe=$id and id_not_tipo_documento<>8 and id_not_tipo_documento<>9) AS documentoien,
            (SELECT COUNT(estado_not_documento) FROM not_documento WHERE estado_not_documento=1 and id_not_informe=$id and (periocidad IS NULL)) AS documentosfirmados,
            estado_cierre_informe
            FROM 
            not_informe
            LEFT JOIN not_aporte
            ON not_informe.id_not_informe=not_aporte.id_not_informe
            LEFT JOIN not_detalle_inscripcion_registro_civil
            ON not_informe.id_not_informe=not_detalle_inscripcion_registro_civil.id_not_informe
            LEFT JOIN not_detalle_gastos_generales
            ON not_informe.id_not_informe=not_detalle_gastos_generales.id_not_informe
            LEFT JOIN not_detalle_gastos_personal
            ON not_informe.id_not_informe=not_detalle_gastos_personal.id_not_informe
            LEFT JOIN not_detalle_transferencias
            ON not_informe.id_not_informe=not_detalle_transferencias.id_not_informe
            LEFT JOIN not_detalle_gastos_inversion
            ON not_informe.id_not_informe=not_detalle_gastos_inversion.id_not_informe
            LEFT JOIN not_novedades_mes
            ON not_informe.id_not_informe=not_novedades_mes.id_not_informe
            LEFT JOIN not_recaudo
            ON not_informe.id_not_informe=not_recaudo.id_not_informe
            LEFT JOIN not_valor_subsidio
            ON not_informe.id_not_informe=not_valor_subsidio.id_not_informe
            LEFT JOIN not_escrituracion
            ON not_informe.id_not_informe=not_escrituracion.id_not_informe
            LEFT JOIN not_detalle_obligaciones
            ON not_informe.id_not_informe=not_detalle_obligaciones.id_not_informe
            WHERE not_informe.id_not_informe=$id"
            );
            $selectcierre = mysql_query($querycierre, $conexion) or die(mysql_error());
            $rowcierre = mysql_fetch_assoc($selectcierre); ?>

      <?php
            if (
              $rowcierre['estado_not_escrituracion'] == 1 and
              $rowcierre['estado_not_aporte'] == 1 and
              0 < intval($rowcierre['aporteespecial']) and
              0 < intval($rowcierre['ingresoescrituracion']) and
              0 < intval($rowcierre['ingresoConceptosVarios']) and
              $rowcierre['estado_not_detalle_inscripcion_registro_civil'] == 1 and
              $rowcierre['estado_not_detalle_gastos_generales'] == 1 and
              $rowcierre['estado_not_detalle_gastos_personal'] == 1 and
              $rowcierre['estado_not_detalle_transferencias'] == 1 and
              $rowcierre['estado_not_detalle_gastos_inversion'] == 1 and
              $rowcierre['estado_not_novedades_mes'] == 1 and
              $rowcierre['estado_not_recaudo'] == 1 and
              $rowcierre['estado_not_valor_subsidio'] == 1 and
              $rowcierre['estado_not_detalle_obligaciones'] == 1 and
              0 < intval($rowcierre['documentoien'])
            ) { ?>

        <div class="box">
          <div class="box-header with-border">
            <b>Cargar Documentos Firmados</b>
            <div class="text-right">
              <?php
              if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {
                echo '<a data-toggle="modal" data-target="#popdocumentosfirmados" title="Agregar Consignaciones"> <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign"></span>Agregar</button></a>';
              }
              ?>
            </div>
          </div>
          <div class="box-body">
            <p style="text-align: justify; padding:0px 5px 0px 5px; font-size:11px;"> Estos Pdf(s) se deben descargar y firmar y nuevamente cargar los documentos firmados en la seccion <b>Cargar Documentos Firmados</b>.</p>

            <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) { ?>
              <div class="text-center">
                <a href="pdf/notaria_informe_estadistico_notarial&<?php echo $id; ?>.pdf" class="btn btn-default btn-block btn-sm"><img src="images/pdf.png">&nbsp;&nbsp; PDF Para Firmar Informe Estadistico y Recaudo</a>
              </div>
              <div class="text-center">
                <a href="pdf/notaria_reporte_de_recaudos&<?php echo $id; ?>.pdf" class="btn btn-default btn-block btn-sm"><img src="images/pdf.png">&nbsp;&nbsp; PDF Para Firmar Actualización Formato de Recaudos</a>
              </div>
            <?php } ?>

            <div>
              <b style="margin:10px;">Documentos Firmados</b><br>
              <?php
              $actualizar56 = mysql_query("SELECT * FROM not_documento
                                      LEFT JOIN not_tipo_documento
                                      ON not_documento.id_not_tipo_documento=not_tipo_documento.id_not_tipo_documento
                                      WHERE id_not_informe=$id and estado_not_documento=1 and (periocidad IS NULL) order by id_not_documento", $conexion) or die(mysql_error());
              $row1562 = mysql_fetch_assoc($actualizar56);
              $total556 = mysql_num_rows($actualizar56);
              if (0 < $total556) {
                do {
                  if (1 == $estadoCierreIEN or 1 == $_SESSION['rol']) {
                    echo '<a href="filesnr/informeestadisticonotarial/' . $row1562['url_not_documento'] . '" target="_blank"><img src="images/pdf.png"></a> ' . $row1562['nombre_not_tipo_documento'] . '<br>';
                  }
                  if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {
                    echo '<a href="filesnr/informeestadisticonotarial/' . $row1562['url_not_documento'] . '" target="_blank"><img src="images/pdf.png"></a> ' . $row1562['nombre_not_tipo_documento'];
                    echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="not_documento" id="' . $row1562['id_not_documento'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>' . '<br>';
                  }
                } while ($row1562 = mysql_fetch_assoc($actualizar56));
                mysql_free_result($actualizar56);
              } else {
              }
              ?>
            </div>
          </div>
        </div>
        <?php
            }
            if (
              $rowcierre['estado_not_escrituracion'] == 1 and
              $rowcierre['estado_not_aporte'] == 1 and
              0 < intval($rowcierre['aporteespecial']) and
              0 < intval($rowcierre['ingresoescrituracion']) and
              0 < intval($rowcierre['ingresoConceptosVarios']) and
              $rowcierre['estado_not_detalle_inscripcion_registro_civil'] == 1 and
              $rowcierre['estado_not_detalle_gastos_generales'] == 1 and
              $rowcierre['estado_not_detalle_gastos_personal'] == 1 and
              $rowcierre['estado_not_detalle_transferencias'] == 1 and
              $rowcierre['estado_not_detalle_gastos_inversion'] == 1 and
              $rowcierre['estado_not_novedades_mes'] == 1 and
              $rowcierre['estado_not_recaudo'] == 1 and
              $rowcierre['estado_not_valor_subsidio'] == 1 and
              0 < intval($rowcierre['documentoien']) and
              1 < intval($rowcierre['documentosfirmados'])
            ) {
              if (0 == intval($estadoCierreIEN)) { ?>
          <div class="text-center">
            <form action="" method="POST" name="form123">
              <button type="submit" class="btn btn-success btn-block btn-sm" name="guardarAuditoriaCierraInforme" onclick="return confirm('Esta Seguro de Cerrar el Informe Estadistico Notarial y Recaudo');" value="1">
                <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; Cerrar Informe Estadistico y Recaudo
              </button>
            </form>
          </div>
        <?php
              }
            }
            if (1 == intval($estadoCierreIEN) and 0 == intval($AuditoriaEstadoCierreIEN)) {
        ?>
        <div class="text-center" style="background-color: #fff; padding:2%;">
          <b>Auditoria</b>
          <?php
              if (0 < $nump114 or 1 == $_SESSION['rol']) {
          ?>
            <div class="text-center">
              <button type="button" class="btn btn-success btn-block btn-xs" data-toggle="modal" data-target="#guardarAutorizoAuditoria">
                <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; Autorizo Informe Estadistico y Recaudo
              </button>
              <button type="button" class="btn btn-danger btn-block btn-xs" data-toggle="modal" data-target="#guardarRechazoAuditoria">
                <span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Rechazo Informe Estadistico y Recaudo
              </button>
            </div>
        <?php
              }
              echo '</div>';
            }
        ?>
        <style>
          div.ex3 {
            background-color: white;
            width: 100%;
            height: 220px;
            overflow: auto;
          }
        </style>
        <?php
            if (1 == intval($estadoCierreIEN) and 1 == intval($AuditoriaEstadoCierreIEN or (1 == $_SESSION['rol'] or 0 < $nump114))) {
              echo '<div style="background-color: white; padding:5px;">
                <h5 class="text-center"><b>Historial Auditoria</b></h5>';
              echo '<div class="ex3">';
              $query4723 = mysql_query("SELECT 
            id_not_auditorio_id_funcionario,
            not_auditoria_observacion,
            not_auditoria_tipo,
            not_auditoria_fecha_cierre
            FROM not_auditoria where id_not_informe=$id", $conexion) or die(mysql_error());
              $row4723 = mysql_fetch_assoc($query4723);
              $total = mysql_num_rows($query4723);
              if (0 < $total) {
                do {
                  echo '<div>'
                    . '<b>Observación:</b> ' . $row4723['not_auditoria_observacion'] . '<br>'
                    . '<b>Tipo:</b> ' . $row4723['not_auditoria_tipo'] . '<br>'
                    . '<b>Fecha:</b> ' . $row4723['not_auditoria_fecha_cierre'] . '<br>'
                    . quees('funcionario', $row4723['id_not_auditorio_id_funcionario']) . '<br><hr>'
                    . '</div>';
                } while ($row4723 = mysql_fetch_assoc($query4723));
                mysql_free_result($query4723);
              }
              echo '</div></div>';
            }
        ?>
        </div><!-- col-md-3 -->
    </div><!-- row -->

    <!-- Autorizo Auditoria -->
    <div class="modal fade" id="guardarAutorizoAuditoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="POST" name="form99923322">
            <div class="modal-body">
              <label for="">Observación de la Autorización</label><br>
              <textarea type="text" name="not_auditoria_observacion" rows="4" cols="85%">Sin Observación</textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-sm" name="guardarAuditoriaFondoNotarios" onclick="return confirm('Esta Seguro de Autizar el Informe Estadistico Notarial y Recaudo');">
                Autorizo Informe Estadistico y Recaudo
              </button>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Rechazo Auditoria -->
    <div class="modal fade" id="guardarRechazoAuditoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="POST" name="form99923322">
            <div class="modal-body">
              <label for="">Observación del Rechazo</label><br>
              <textarea type="text" name="not_auditoria_observacion" rows="4" cols="85%"></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger btn-sm" name="guardarRechazoAuditoriaCierraInforme" onclick="return confirm('Esta Seguro del rechazo el Informe Estadistico Notarial y Recaudo');">
                Rechazar Informe Estadistico y Recaudo
              </button>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>
<?php
//error_reporting(E_ALL & ~E_NOTICE);
if (isset($_GET['i'])) {
  $id = $_GET['i'];

  $nump = privilegios(7, $_SESSION['snr']);
  $nump22 = privilegios(22, $_SESSION['snr']);
  $AprobarFinanciero = privilegios(34, $_SESSION['snr']);
  $AprobarCuradurias = privilegios(35, $_SESSION['snr']);


  if (1 == $_SESSION['rol'] or 0 < $nump or 4 == $_SESSION['snr_tipo_oficina']) {

    if (isset($_POST['fecha_desde_expensa']) && "" != $_POST['fecha_desde_expensa'] && isset($_POST['fecha_hasta_expensa']) && "" != $_POST['fecha_hasta_expensa']) {

      $fechadesde = $_POST['fecha_desde_expensa'];
      $fechahasta = $_POST['fecha_hasta_expensa'];

      $updatecc = sprintf(
        "UPDATE expensa_curaduria SET fecha_inicio_expensa=%s, fecha_final_expensa=%s WHERE id_expensa_curaduria=%s and estado_expensa_curaduria=1",
        GetSQLValueString($fechadesde, "date"),
        GetSQLValueString($fechahasta, "date"),
        GetSQLValueString($id, "int")
      );
      $Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());

      echo $actualizado;
    } else {
    }

    if (isset($_GET['e']) && 0 == intval($_GET['e'])) {

      $updateSQL779l = sprintf(
        "UPDATE expensa_fac SET estado_expensa_fac=%s WHERE id_expensa_curaduria=%s and estado_expensa_fac=1",
        GetSQLValueString(0, "int"),
        GetSQLValueString($id, "int")
      );
      $Result1779l = mysql_query($updateSQL779l, $conexion) or die(mysql_error());
    } else if (isset($_GET['e']) && "" != ($_GET['e'])) {

      $fac = intval($_GET['e']);
      $updateSQL779lo = sprintf(
        "UPDATE expensa_fac SET estado_expensa_fac=%s WHERE id_expensa_curaduria=%s and id_expensa_fac=%s and estado_expensa_fac=1",
        GetSQLValueString(0, "int"),
        GetSQLValueString($id, "int"),
        GetSQLValueString($fac, "int")
      );
      $Result1779lo = mysql_query($updateSQL779lo, $conexion) or die(mysql_error());
    } else {
    }

    if (1 == $_SESSION['rol'] or 0 < $nump) {

      $query4 = sprintf("SELECT * FROM curaduria, funcionario, situacion_curaduria, expensa_curaduria where curaduria.id_curaduria=situacion_curaduria.id_curaduria and funcionario.id_funcionario=situacion_curaduria.id_funcionario  and expensa_curaduria.id_curaduria=curaduria.id_curaduria and expensa_curaduria.id_expensa_curaduria=" . $id . "");
    } else {
      $idfun = intval($_SESSION['snr']);
      $query4 = sprintf("SELECT * FROM curaduria, funcionario, situacion_curaduria, expensa_curaduria where  funcionario.id_funcionario=" . $idfun . " and situacion_curaduria.fecha_terminacion>='$realdate' and curaduria.id_curaduria=situacion_curaduria.id_curaduria and funcionario.id_funcionario=situacion_curaduria.id_funcionario and expensa_curaduria.id_curaduria=curaduria.id_curaduria and expensa_curaduria.id_expensa_curaduria=" . $id . " and curaduria.estado_curaduria=1 and estado_situacion_curaduria=1 limit 1");
    }



    $select4 = mysql_query($query4, $conexion) or die(mysql_error());
    $row14 = mysql_fetch_assoc($select4);
    $totalRows = mysql_num_rows($select4);
    if (0 < $totalRows) {  //cierre para permisos de expensas
      $id_curaduria = $row14['id_curaduria'];
      $fecini = $row14['fecha_inicio_expensa'];

      // Funcion para separar año
      $fectotal = $row14['fecha_inicio_expensa'];;
      $aDate = explode("-", $fectotal);
      $anofec = $aDate[0];
      // var_dump($anofec);

      $fecfinal = $row14['fecha_final_expensa'];
      $nombre_expensa = $row14['nombre_expensa_curaduria'];

      $name = $row14['nombre_curaduria'];
      $tele = $row14['telefono_curaduria'];
      $celu = $row14['celular_curaduria'];
      $dire = $row14['direccion_curaduria'];
      $id_departamento = $row14['id_departamento'];
      $id_municipio = $row14['id_municipio'];
      $ncuraduria = $row14['numero_curaduria'];
      $correo_curaduria = $row14['correo_curaduria'];
      $nombre_curador = $row14['nombre_funcionario'];
      $estado = $row14['expensa_cerrada'];

      // ADJUNTAR UN DOCUMENTO
      if (isset($_POST["guardasoporte"]) and isset($_POST["valor_soporte"])) {

        $tamano_archivo = 2097152;
        //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
        $formato_archivo = array('pdf');
        $carpeta_archivo = "files/expensa_curadurias/";
        $ruta_archivo = date("YmdGis") . '-' . $id_departamento . $id_municipio . '-' . $ncuraduria . '-' . $fecini . '-' . base64_encode($_FILES['file']['tmp_name']);

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
                "INSERT INTO expensa_documento (id_expensa_curaduria, valor_soporte, fecha_soporte, id_expensa_tipo_file, nombre_expensa_documento, url_expensa_documento, hash_documento, estado_expensa_documento) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST["valor_soporte"], "double"),
                GetSQLValueString($_POST["fecha_soporte"], "text"),
                GetSQLValueString($_POST["id_expensa_tipo_file"], "int"),
                GetSQLValueString($id_departamento . $id_municipio . '-' . $ncuraduria . '-' . $fecini . '/' . $fecfinal, "text"),
                GetSQLValueString($files, "text"),
                GetSQLValueString($hash, "text"),
                GetSQLValueString(1, "int")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $documentocargado;
            } else {
              $valido = 0;
              echo  $doc_no_tipo;
            }
          } else {
          }
        } else {
          $valido = 0;
          echo $doc_tam;
        }
      }



      // ADJUNTAR UN DOCUMENTO DEVOLUCION
      if (isset($_POST["enviar_devolucion"]) AND '' !=  $_POST["enviar_devolucion"] AND
          isset($_POST["valor_devolucion"]) AND '' !=  $_POST["valor_devolucion"]
      ) {
        $insertSQL = sprintf(
          "INSERT INTO expensa_devolucion (nombre_expensa_devolucion, id_persona_radica, id_expensa_curaduria, periodo_inicial, periodo_final,  valor_devolucion) VALUES (%s, %s, %s, %s, %s, %s)",
          GetSQLValueString($id_departamento . $id_municipio . '-' . $ncuraduria . '-' . $fecini . '/' . $fecfinal, "text"),
          GetSQLValueString($_SESSION["snr"], "int"),
          GetSQLValueString($id, "int"),
          GetSQLValueString($fecini, "date"),
          GetSQLValueString($fecfinal, "date"),
          GetSQLValueString($_POST["valor_devolucion"], "text")
        );
        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
        echo $insertado;
      }

      // EDITAR UN SOPORTE PERFIL FINANCIERA
      if (isset($_POST["editasoporteg"])) {
        if (isset($_POST["llenosoporte"])) {
          $updatesop = sprintf(
            "UPDATE expensa_documento SET 
            valor_soporte=%s,
            fecha_soporte=%s
            WHERE id_expensa_documento=%s",
            GetSQLValueString(str_replace(',', '.', $_POST["valor_soporte"]), "double"),
            GetSQLValueString($_POST["fecha_soporte"], "date"),
            GetSQLValueString($_POST["id_expensa_documento"], "int")
          );
          $Resultsop = mysql_query($updatesop, $conexion) or die(mysql_error());
          echo $actualizado;
        } else {
          echo '<script type="text/javascript">swal(" ERROR !", " No selecciono Soporte de Pago. !", "error");</script>';
        }
      }

      // AUTORIZACION DE FINANCIERA
      if (isset($_POST["autorizafinanciera"])) {
        if (1 == $row14['vigilancia_curaduria']) {
          $updatesop = sprintf(
            "UPDATE expensa_curaduria SET 
            vigilancia_financiera=%s,
            expensa_cerrada=%s
            WHERE id_expensa_curaduria=%s",
            GetSQLValueString(1, "int"),
            GetSQLValueString(2, "int"),
            GetSQLValueString($id, "int")
          );
          $Resultsop = mysql_query($updatesop, $conexion) or die(mysql_error());
          echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
          echo $insertado;
        } else {
          $updatesop = sprintf(
            "UPDATE expensa_curaduria SET 
            vigilancia_financiera=%s
            WHERE id_expensa_curaduria=%s",
            GetSQLValueString(1, "int"),
            GetSQLValueString($id, "int")
          );
          $Resultsop = mysql_query($updatesop, $conexion) or die(mysql_error());
          echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
          echo $insertado;
        }
      }

      // AUTORIZACION DE CURADURIA
      if (isset($_POST["autorizacuraduria"])) {
        if (1 == $row14['vigilancia_financiera']) {
          $updatesop = sprintf(
            "UPDATE expensa_curaduria SET 
            vigilancia_curaduria=%s,
            expensa_cerrada=%s
            WHERE id_expensa_curaduria=%s",
            GetSQLValueString(1, "int"),
            GetSQLValueString(2, "int"),
            GetSQLValueString($id, "int")
          );
          $Resultsop = mysql_query($updatesop, $conexion) or die(mysql_error());
          echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
          echo $insertado;
        } else {
          $updatesop = sprintf(
            "UPDATE expensa_curaduria SET 
            vigilancia_curaduria=%s
            WHERE id_expensa_curaduria=%s",
            GetSQLValueString(1, "int"),
            GetSQLValueString($id, "int")
          );
          $Resultsop = mysql_query($updatesop, $conexion) or die(mysql_error());
          echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
          echo $insertado;
        }
      }

      // ENVIO DE INFORMACION A VERIFICACION FINANCIERA Y CURADURIA
      if (isset($_POST["enviainfo"])) {
        $updatesop = sprintf(
          "UPDATE expensa_curaduria SET 
          expensa_cerrada=%s
          WHERE id_expensa_curaduria=%s",
          GetSQLValueString(1, "int"),
          GetSQLValueString($id, "int")
        );
        $Resultsop = mysql_query($updatesop, $conexion) or die(mysql_error());
        echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
        echo '<script type="text/javascript">swal(" ENVIADO !", " Se envia Información para verificación !", "success");</script>';
      }

      // ENVIO DE INFORMACION DE AUDITORIA
      if (isset($_POST["formaudita"])) {
        $insertSQL = sprintf(
          "INSERT INTO expensa_auditoria (id_expensa_curaduria, id_expensa_tipos_auditoria, observacion_expensa_auditoria, fecha_ahora, id_funcionario, estado_expensa_auditoria) VALUES (%s, %s, %s, now(), %s, %s)",
          GetSQLValueString($id, "int"),
          GetSQLValueString($_POST["id_expensa_tipos_auditoria"], "int"),
          GetSQLValueString($_POST["observacion_expensa_auditoria"], "text"),
          GetSQLValueString($_SESSION['snr'], "int"),
          GetSQLValueString(1, "int")
        );
        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
        echo $insertado;
      }


      // GUARDAR DATOS DE NOTA CREDITO
      if (
        isset($_POST["GuardarNotaCredito"]) and '' != $_POST["GuardarNotaCredito"] and
        isset($_FILES['file']) and '' != $_FILES['file'] and
        isset($_POST["id_expensa_fac"]) and '' != $_POST["id_expensa_fac"]
      ) {
        $idexpensafac = $_POST["id_expensa_fac"];
        $queryverfac = sprintf("SELECT COUNT(id_expensa_fac) AS contador FROM expensa_nota_credito WHERE id_expensa_fac=$idexpensafac limit 1");
        $selectverfac = mysql_query($queryverfac, $conexion) or die(mysql_error());
        $rowverfac = mysql_fetch_assoc($selectverfac);

        if (0 >= $rowverfac['contador']) {

          $tamano_archivo = 2097152;
          $formato_archivo = array('pdf');
          $carpeta_archivo = "files/expensa_curadurias/";
          $ruta_archivo = date("YmdGis") . '-' . $id_departamento . $id_municipio . '-' . $ncuraduria . '-' . base64_encode($_FILES['file']['tmp_name']);

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
                  "INSERT INTO expensa_documento (id_expensa_curaduria, valor_soporte, fecha_soporte, id_expensa_tipo_file, nombre_expensa_documento, url_expensa_documento, hash_documento, estado_expensa_documento) VALUES (%s, %s, now(), %s, %s, %s, %s, %s)",
                  GetSQLValueString($id, "int"),
                  GetSQLValueString(0, "double"),
                  GetSQLValueString(4, "int"),
                  GetSQLValueString($idexpensafac, "text"),
                  GetSQLValueString($files, "text"),
                  GetSQLValueString($hash, "text"),
                  GetSQLValueString(1, "int")
                );
                $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

                if (0 < $Result) {

                  $querycompl = sprintf("SELECT * FROM expensa_fac WHERE id_expensa_fac=$idexpensafac limit 1");
                  $selectcompl = mysql_query($querycompl, $conexion) or die(mysql_error());
                  $rowcompl = mysql_fetch_assoc($selectcompl);

                  $insertnotacredito = sprintf(
                    "INSERT INTO expensa_nota_credito (nombre_expensa_nota_credito, id_expensa_fac, antes_fijo_expensa_fac, antes_vari_expensa_fac, antes_uni_expensa_fac, fijo_expensa_fac, vari_expensa_fac, uni_expensa_fac) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                    GetSQLValueString('Nota Credito', "text"),
                    GetSQLValueString($idexpensafac, "int"),
                    GetSQLValueString($rowcompl["fijo_expensa_fac"], "text"),
                    GetSQLValueString($rowcompl["vari_expensa_fac"], "text"),
                    GetSQLValueString($rowcompl["uni_expensa_fac"], "text"),
                    GetSQLValueString($_POST["fijo_expensa_fac"], "text"),
                    GetSQLValueString($_POST["vari_expensa_fac"], "text"),
                    GetSQLValueString($_POST["uni_expensa_fac"], "text")
                  );
                  $Results = mysql_query($insertnotacredito, $conexion) or die(mysql_error());
                }
                echo $insertado;
                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
              } else {
                $valido = 0;
                echo  $doc_no_tipo;
              }
            } else {
            }
          } else {
            $valido = 0;
            echo $doc_tam;
          }
        }
      }


?>
      <script>
        $(function() {
          $('.notacredito').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/expensanotacredito.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divnotacredito').html(b);
              }
            })
          });
        })
      </script>


      <div class="modal fade" id="popupnewdocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h5 class="modal-title">Soporte de Pago</h5>
            </div>
            <div id="nuevaAventura" class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <b>Procedimiento</b><br>
                  1. Seleccionar Tipo de Documento.<br>
                  2. Cargar el Adjunto correspondiente a la consignación de la Tarifa (Solo PDF).<br>
                  3. Completar el Campo Valor, con el valor cancelado en la consignación que esta adjuntando.<br>
                  <span style="font-size: 12px; color:red;">Colocar el valor completo y para los decimales coloco (.) punto digito los dos decimales.</span><br>
                  4. Completar el Campo fecha, con la fecha de realizada la consignación que esta adjuntando.<br>
                  5. Dar clic en aceptar para subir el Adjunto.<br>
                  <span style="color:#C22605; font-size:11px;"><b>Recordar que solo debe realizar un unico pago por el valor de la tarifa.</b></span>
                </div>
              </div><br>
              <form action="" method="POST" name="form1224355447" enctype="multipart/form-data">
                <input type="hidden" name="id_expensa_curaduria" value="" class="">
                <input type="hidden" name="table" value="expensa_documento">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label"><span class="obligatorio"> * </span> Tipo de documento</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="id_expensa_tipo_file" required>
                      <option selected></option>
                      <?php
                      $actualizar5 = mysql_query("SELECT * FROM expensa_tipo_file WHERE estado_expensa_tipo_file=1 order by id_expensa_tipo_file", $conexion) or die(mysql_error());
                      $row15 = mysql_fetch_assoc($actualizar5);
                      $total55 = mysql_num_rows($actualizar5);
                      if (0 < $total55) {
                        //echo '<option value="" selected></option>';
                        do {
                          echo '<option value="' . $row15['id_expensa_tipo_file'] . '" ';
                          echo '>' . $row15['nombre_expensa_tipo_file'] . '</option>';
                        } while ($row15 = mysql_fetch_assoc($actualizar5));

                        mysql_free_result($actualizar5);
                      } else {
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <div class="btn btn-default btn-sm btn-file">
                      <i class="fa fa-paperclip"></i> <input type="file" value="" name="file" required> Archivo Max. 2MB
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label"><span class="obligatorio"> * </span> Valor de Consignación</label>
                  <div class="col-sm-7">
                    <input type="number" step="any" class="form-control" name="valor_soporte">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label"><span class="obligatorio"> * </span> Fecha de Consignación</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control datepicker" name="fecha_soporte" required readonly="readonly">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="reset" class="btn btn-xs btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                  <button type="submit" class="btn btn-xs btn-success"><input type="hidden" name="guardasoporte" value="1"><span class="glyphicon glyphicon-ok"></span> Agregar </button>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>






      <?php
      if ((isset($_POST["table"])) && ($_POST["table"] == "expensa_correccion")) {

        // files/expensa_curadurias/
        $tamano_archivo = 2097152;
        //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
        $formato_archivo = array('pdf');
        $directoryftp = "files/expensa_curadurias/";
        $ruta_archivo = $id . '-' . date("YmdGis");

        if ("" != $_FILES['file']['tmp_name']) {

          $archivo = $_FILES['file']['tmp_name'];
          $tam_archivo = filesize($archivo);
          $tam_archivo2 = $_FILES['file']['size'];
          $nombrefile = strtolower($_FILES['file']['name']);
          $info = pathinfo($nombrefile);
          $extension = $info['extension'];
          $array_archivo = explode('.', $nombrefile);
          $extension2 = end($array_archivo);

          //echo $tam_archivo;
          //echo $tam_archivo2;

          if ($tamano_archivo >= intval($tam_archivo2)) {

            if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
              $files = $ruta_archivo . '.' . $extension;
              $mover_archivos = move_uploaded_file($archivo, $directoryftp . $files);
              //chmod($files,0777);
              $nombrebre_orig = ucwords($nombrefile);

              $insertSQL = sprintf(
                "INSERT INTO expensa_correccion (id_expensa_curaduria, id_expensa_tipo_file, nombre_expensa_correccion, url_expensa_correccion, concepto_correccion, estado_expensa_correccion, fecha_correccion) VALUES (%s, %s, %s, %s, %s, %s, now())",
                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST["id_expensa_tipo_file"], "text"),
                GetSQLValueString($id_departamento . $id_municipio . '-' . $ncuraduria . '-' . $fecini . '/' . $fecfinal, "text"),
                GetSQLValueString($files, "text"),
                GetSQLValueString($_POST["concepto_correccion"], "text"),
                GetSQLValueString(1, "int")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $documentocargado;
            } else {

              echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
            }
          } else {
            echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
          }
        } else {
          echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
        }
      } else {
      }
      ?>


      <div class="modal fade" id="pop_correcciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel">ADJUNTAR DOCUMENTOS: <span class="licenciac" style="font-weight: bold;"></span></h4>
            </div>
            <div id="nuevaAventura" class="modal-body">
              <form action="" method="POST" name="form999999" enctype="multipart/form-data">
                <input type="hidden" name="id_expensa_curaduria" value="" class="">
                <input type="hidden" name="table" value="expensa_correccion">
                <div class="form-group text-left">
                  <label class="control-label">Tipo de documento que se anexa</label>
                  <select class="form-control" name="id_expensa_tipo_file" required>
                    <option selected></option>
                    <option value="Soporte Correo Electronico">Soporte Correo Electronico</option>
                    <option value="Oficio Remitido a SNR">Oficio Remitido a SNR</option>
                  </select>
                </div>
                <div class="form-group">
                  <div>
                    Seleccionar archivo
                    <input type="file" name="file">
                  </div>
                  <p class="help-block">Max. 2MB</p>
                </div>
                <label class="control-label">Concepto de la Corrección:</label>
                <textarea rows="4" cols="70" name="concepto_correccion"></textarea>

                <div class="modal-footer"><button type="reset" class="btn btn-sm btn-default" data-dismiss="modal" onClick="this.form.reset()">
                    <span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-sm btn-success">
                    <input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>



      <?php  /////////////////////////////////////////////////////////////////////////////////////////
      ?>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-body">
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title"><b>Información</b></h3>
              <div class="box-tools">
                <button type="button" class="btn btn-sm btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>

            <div class="col-md-4">
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked info" style="font-size:11px;">
                  <li><a><i class="glyphicon glyphicon-home"></i> <span><?php echo  $name; ?></span></a></li>
                  <li><a><i class="glyphicon glyphicon-envelope"></i><span><?php echo $correo_curaduria ?></span></a></li>
                  <li><a><i class="glyphicon glyphicon-map-marker"></i><span><?php echo quees('departamento', $id_departamento); ?></span></a></li>
                  <li style="padding-left:20px;">
                    <?php
                    // FUNCION PARA INCLUIR LA FECHA
                    $valt = intval(20);
                    $mod_date = strtotime($fecini . "+ " . $valt . " days");
                    $fechavence = date("Y-m-d", $mod_date);
                    $fechavence1 = explode("-", $fechavence);
                    $anof = $fechavence1[0];
                    $mesf = $fechavence1[1];
                    $diaf = $fechavence1[2];
                    ?>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-md-4">
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked info" style="font-size:11px;">
                  <li><a><i class="glyphicon glyphicon-map-marker"></i> <span><?php echo nombre_municipio($id_municipio, $id_departamento); ?></span></a></li>
                  <li><a><i class="glyphicon glyphicon-earphone"></i><span><?php echo $tele; ?></span></a></li>
                  <li><a><i class="glyphicon glyphicon-phone"></i> <span><?php echo $celu; ?></span></a></li>
                </ul>
              </div>
            </div>

            <div class="col-md-4">
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked info" style="font-size:11px;">
                  <li><a><i class="glyphicon glyphicon-home"></i><span><?php echo $dire; ?></span></a></li>
                  <li><a><i class="fa fa-fw fa-credit-card"></i>Referecia de Pago: <span><?php echo $id; ?></span></a></li>
                  <li><a href="#pagoscuraduria"><button type="button" class="btn btn-sm btn-xs btn-warning">Ver pagos</button></a></li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- cajas de expensa -->
      <div class="row">
        <div class="col-md-9">
          <div class="box">
            <div class="box-header with-border">



              <?php if (1 == $_SESSION['rol']) { ?>
                <form action="" method="POST" name="fo345345r5tgmgjht1">
                  <div class="row" style="text-align: center;">
                    <div class="col-md-1">
                      <a href="expensa_curaduria&<?php echo $id_curaduria; ?>.jsp" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Regresar </a>&nbsp; &nbsp; &nbsp;
                    </div>
                    <label class="col-md-1" style="margin-top:5px;">
                      Desde:
                    </label>
                    <div class="col-md-2">
                      <input type="text" class="form-control datepicker" name="fecha_desde_expensa" value="<?php echo $fecini; ?>" required readonly="readonly">
                    </div>
                    <label class="col-md-1" style="margin-top:5px;">
                      Hasta:
                    </label>
                    <div class="col-md-2">
                      <input type="test" class="form-control datepicker" name="fecha_hasta_expensa" required value="<?php echo $fecfinal; ?>" readonly="readonly">
                    </div>
                    <div class="col-md-5">
                      <button type="submit" class="btn btn-sm btn-warning">
                        Actualizar</button>
                    </div>
                  </div>
                </form>

              <?php } else { ?>

                <a href="expensa_curaduria&<?php echo $id_curaduria; ?>.jsp" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Regresar </a>&nbsp; &nbsp; &nbsp;


                <b>Liquidación del &nbsp;<?php echo $fecini; ?> &nbsp; Hasta &nbsp; <?php echo $fecfinal; ?></b>
              <?php } ?>

              <!-- ESTA ES LA CONDICIONAL DEL ESTADO PARA DESAPARECER EL BOTON MODIFICAR   -->
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-sm btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <h4>
                <a href="images/MANUAL_TARIFA_DE_VIGILANCIA_CURADURIA_V1.pdf" style="color:#B40404" target="_blank"> VER MANUAL</a>

              </h4>


              <!-- CARGAS FACTURAS EN MASIVO -->

              <?php

              function valint($numb)
              {
                $newv = intval($numb);


                if (0 < $newv) {
                  return $newv;
                } else {
                  // echo '<script type="text/javascript">swal(" ERROR !", " El valor '.$numb.' NO es permitido", "error");</script>' ; 
                  return false;
                }
              }

              $nomfacmasivo = $id_departamento . $id_municipio . '-' . $ncuraduria;
              $anuexp = '';

              if (isset($_POST['subirmaxivo'])) {
                //Aquí es donde seleccionamos nuestro csv
                $fname = $_FILES['sel_file']['name'];
                //echo 'Cargando nombre del archivo: '.$fname.' <br>';
                $chk_ext = explode(".", $fname);

                if (strtolower(end($chk_ext)) == "csv") {
                  //si es correcto, entonces damos permisos de lectura para subir
                  $filename = $_FILES['sel_file']['tmp_name'];
                  $handle = fopen($filename, "r");

                  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                    $anofac = valint($data[0]);
                    $num_expensa = valint($data[1]);
                    $fijo_expensa = intval($data[2]);
                    $vari_expensa = intval($data[3]);
                    $uni_expensa = intval($data[4]);
                    $num_proyecto = $data[5];
                    $num_proyecto2 = $id_departamento . $id_municipio . '-' . $ncuraduria . '-' . $num_proyecto;

                    $actualizar5u = mysql_query("SELECT count(id_expensa_fac) as totfac FROM expensa_fac WHERE id_expensa_curaduria=" . $id . " and num_expensa_fac=" . $num_expensa . " and ano_licencia=" . $anofac . " and estado_expensa_fac=1 ", $conexion);
                    $row15u = mysql_fetch_assoc($actualizar5u);
                    $totfac = $row15u['totfac'];

                    if (0 < $totfac) {
                      echo '<p style="background:#ff0000;color:#fff;">Factura repetida: ' . $num_expensa . '</p>';
                    } else {


                      if (0 < $anofac and 0 < $num_expensa) {

                        $insertSQL = sprintf(
                          "INSERT INTO expensa_fac (
                          id_expensa_curaduria,              
                          nombre_expensa_fac,
                          ano_licencia,
                          num_expensa_fac,
                          fijo_expensa_fac,
                          vari_expensa_fac,
                          uni_expensa_fac,
                          anu_fac,
                          anular_expensa,
                          fecha_expensa_fac,
                          estado_expensa_fac,
                          num_radicacion) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, now(), %s, %s)",
                          GetSQLValueString($id, "int"),
                          GetSQLValueString($nomfacmasivo, "text"),
                          GetSQLValueString($anofac, "int"),
                          GetSQLValueString($num_expensa, "int"),
                          GetSQLValueString($fijo_expensa, "int"),
                          GetSQLValueString($vari_expensa, "int"),
                          GetSQLValueString($uni_expensa, "int"),
                          GetSQLValueString(0, "int"),
                          GetSQLValueString($anuexp, "text"),
                          GetSQLValueString(1, "int"),
                          GetSQLValueString($num_proyecto2, "text")
                        );

                        $Result = mysql_query($insertSQL, $conexion);
                      } else {

                        echo '<div class="alert alert-danger" role="alert">El numero de factura ' . $data[1] . ' presenta errores.</div>';
                      }
                    }
                  }
                  //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
                  fclose($handle);
                  //echo $masivocargado;
                  //echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id.'.jsp" />';
                } else {
                  //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
                  //ver si esta separado por " , "
                  echo $doc_no_tipo;
                }
              }
              ?>

              <!-- FIN DE FACTURACION -->

              <!-- FACTURACION  -->

              <h5 class="titulos_expensa"><b>FACTURAS</b></h5>

              <?php if (1 == $_SESSION['rol'] and 52 == $id_curaduria) {

                if ((isset($_POST["expensa_facsegundaria"])) && ($_POST["expensa_facsegundaria"] == "1")) {
                  $insertSQL = sprintf(
                    "INSERT INTO expensa_fac (
                    id_expensa_curaduria, 
                    num_expensa_fac, 
                    fijo_expensa_fac, 
                    vari_expensa_fac, 
                    uni_expensa_fac, 
                    anu_fac, 
                    fecha_expensa_fac, 
                    ano_licencia, 
                    num_radicacion, 
                    estado_expensa_fac
                    ) VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s, %s)",
                    GetSQLValueString($id, "int"),
                    GetSQLValueString(0, "int"),
                    GetSQLValueString($_POST["fijo_expensa_fac"], "text"),
                    GetSQLValueString($_POST["vari_expensa_fac"], "text"),
                    GetSQLValueString($_POST["uni_expensa_fac"], "text"),
                    GetSQLValueString(0, "int"),
                    GetSQLValueString($anoactual, "int"),
                    GetSQLValueString('0', "text"),
                    GetSQLValueString(1, "int")
                  );
                  $Result = mysql_query($insertSQL, $conexion);
                  echo $insertado;
                } else {
                }

              ?>



                <div class="row">
                  <div class="col-sm-12">
                    <label>Incluir consolidado de facturas segundarias</label>
                    <form action="" method="post" name="342ewfwetr">

                      <input type="hidden" name="expensa_facsegundaria" value="1">
                      <input type="number" class="numero" name="fijo_expensa_fac" placeholder="Cargo fijo">
                      <input type="number" class="numero" name="vari_expensa_fac" placeholder="Cargo variable">
                      <input type="number" class="numero" name="uni_expensa_fac" placeholder="Cargo unico">
                      <input type="submit" class="btn btn-xs btn-warning" value="Enviar">
                    </form><br>
                  </div>
                </div>
              <?php  } else {
              }
              ?>


              <?php if (0 == $estado && (4 == $_SESSION['snr_tipo_oficina'] or 1 == $_SESSION['rol'] or 0 < $nump22)) {  ?>

                <div class="row">
                  <div class="col-sm-6">
                    <label>Carga Facturas Manualmente</label><br>
                    <a style="float:left; margin:10px;" data-toggle="modal" data-target="#popagregarfacturas" title="Incluir facturas">
                      <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar factura </button></a>
                  </div>


                  <div class="col-sm-6" style="background:#f2f2f2;width:48%; padding-bottom:5px;">
                    <form method='post' enctype="multipart/form-data">
                      <label>Carga Archivo Plano</label><br>
                      <input type='file' name='sel_file' size='20'>
                      <a href="images/ejemplo_facturas.csv" download=>Descargar archivo de ejemplo .csv</a> &nbsp;
                      <input type='submit' name='subirmaxivo' value=' Agregar archivo ' class="btn btn-xs btn-success"><br>
                      <a href="expensa&<?php echo $id; ?>&0.jsp" style="font-size:10px;color:#ff0000;" class="seguroelimfac">Eliminar todas las facturas</a>
                    </form>
                  </div>
                </div>

              <?php } else {
              } ?>

              <?php
              $query423 = sprintf("SELECT * FROM expensa_curaduria, expensa_fac where expensa_curaduria.id_expensa_curaduria=expensa_fac.id_expensa_curaduria and expensa_curaduria.id_expensa_curaduria=" . $id . " and estado_expensa_fac=1 order by num_expensa_fac ");
              $result23 = $mysqli->query($query423); ?>

              <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <tr align="center">
                  <th>N° Factura</th>
                  <th>Costo Fijo</th>
                  <th>Costo Variable</th>
                  <th>Costo Unicos</th>
                  <th>Sub Total</th>
                  <th>Fecha subida</th>
                  <th>Radicación</th>
                  <th>Acción</th>
                </tr>
                <?php

                $array = array();

                while ($row23 = $result23->fetch_array(MYSQLI_ASSOC)) {

                  array_push($array, $row23["num_expensa_fac"]);

                ?>
                  <tr>
                    <td>
                      <?php $row23["id_expensa_fac"] ?>
                      <?php
                      $fac_s_anulada = $row23["anu_fac"];
                      $fac_nota_credito = $row23["nota_credito_fac"];
                      if ($fac_s_anulada == 1) { ?>
                        <span style="border-radius: 30px; border: solid 1px red; margin:0px 5px; padding:3px; font-size:9px; color:red;">Anulada</span>
                      <?php } else {
                      }
                      if ($fac_nota_credito == 1) { ?>
                        <span style="border-radius: 30px; border: solid 1px #01c0ef; margin:0px 5px; padding:3px; font-size:9px; color:#01c0ef;">Nota Credito</span>
                      <?php } else {
                      } ?>
                      <?php echo $row23["nombre_expensa_fac"] . '-' . $row23["ano_licencia"] . '-' . $row23["num_expensa_fac"]; ?>
                    </td>
                    <td><?php echo number_format((float) $row23["fijo_expensa_fac"], 2, ",", "."); ?></td>
                    <td><?php echo number_format((float) $row23["vari_expensa_fac"], 2, ",", "."); ?></td>
                    <td><?php echo number_format((float) $row23["uni_expensa_fac"], 2, ",", "."); ?></td>
                    <?php
                    $num1fac = $row23["fijo_expensa_fac"];
                    $num2fac = $row23["vari_expensa_fac"];
                    $num3fac = $row23["uni_expensa_fac"];

                    $subtotalfac = $num1fac + $num2fac + $num3fac;
                    ?>
                    <td><?php echo number_format((float) $subtotalfac, 2, ",", "."); ?></td>
                    <td><?php echo $row23["fecha_expensa_fac"]; ?></td>

                    <td><?php echo $row23["num_radicacion"]; ?></td>
                    <td>
                      <?php if (1 == $fac_s_anulada OR 1 == $fac_nota_credito OR 2 == $fac_nota_credito) {} else { ?>
                      <a class="notacredito btn btn-xs btn-info" title="Radicar Nota Credito" id="<?php echo $row23["id_expensa_fac"] ?>" style="cursor: pointer;" data-toggle="modal" data-target="#notacredito">NC</a>
                      <?php
                      }
                      if (0 == $estado && (4 == $_SESSION['snr_tipo_oficina'] or 1 == $_SESSION['rol'] or 0 < $nump22)) {
                      ?>
                        <?php if ($fac_s_anulada == 0) { ?>
                          <a class="updateggg btn btn-xs btn-warning" title="Editar Factura" id="<?php echo $row23["id_expensa_fac"] ?>" style="cursor: pointer;" data-toggle="modal" data-target="#popupupdate"><i class="glyphicon glyphicon-pencil"></i></a>
                        <?php } else {
                        } ?>

                        <?php if ($fac_s_anulada == 0) { ?>
                          <a class="anularggg btn btn-xs btn-danger" title="Anular Factura" id="<?php echo $row23["id_expensa_fac"]; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#popupanular"><i class="glyphicon glyphicon-remove"></i></a>
                        <?php } else { ?>
                          <a class="btn btn-xs btn-danger" title="Anular Factura" onclick="swal(' FACTURA ANULADA !', 'SI por error Anulo la factura, Contacte con el adminstrador !', 'warning')"><i class="glyphicon glyphicon-remove"></i></a>
                        <?php } ?>

                        <a href="https://sisg.supernotariado.gov.co/expensa&<?php echo $id; ?>&<?php echo $row23["id_expensa_fac"]; ?>.jsp" title="Eliminar" class="confirmationdel"><i class="glyphicon glyphicon-trash"></i></a>
                      <?php } else {
                      } ?>
                    </td>
                  </tr>
                <?php } ?>
              </table>



              <!--  NUMERO DE FACTURAS  -->

              <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                <h5 class="titulos_expensa"><b>NUMERO DE FACTURAS</b></h5>

                <tr>
                  <td>Consecutivo de Facturacion: </td>
                  <td><span class="res_expensa">
                      <?php

                      $fijo = '';
                      $variable = '';
                      $unico = '';
                      $totalfacturacion = '';

                      $query423 = sprintf("SELECT * FROM expensa_curaduria, expensa_fac where expensa_curaduria.id_expensa_curaduria=expensa_fac.id_expensa_curaduria and expensa_curaduria.id_expensa_curaduria='$id' and anu_fac=0 and estado_expensa_fac=1");
                      $result23 = $mysqli->query($query423);
                      while ($row23 = $result23->fetch_array(MYSQLI_ASSOC)) {
                        echo $row23['nombre_expensa_fac'] . '-' . $row23['ano_licencia'] . '-' . $row23['num_expensa_fac'] . ', ';

                        $fijo += $row23['fijo_expensa_fac'];
                        $variable += $row23['vari_expensa_fac'];
                        $unico += $row23['uni_expensa_fac'];

                        $totalfacturacion += $row23['fijo_expensa_fac'] + $row23['vari_expensa_fac'] + $row23['uni_expensa_fac'];
                      }
                      ?></span>
                  </td>
                </tr>

                <tr>
                  <td>Consecutivo de Facturacion Anulada: </td>
                  <td><span class="res_expensa">
                      <?php
                      $query423 = sprintf("SELECT * FROM expensa_curaduria, expensa_fac where expensa_curaduria.id_expensa_curaduria=expensa_fac.id_expensa_curaduria and expensa_curaduria.id_expensa_curaduria='$id' and anu_fac=1 and estado_expensa_fac=1");
                      $result23 = $mysqli->query($query423);
                      while ($row23 = $result23->fetch_array(MYSQLI_ASSOC)) {

                        echo '' . $row23['nombre_expensa_fac'] . '-' . $row23['ano_licencia'] . '-' . $row23['num_expensa_fac'] . '  ' . $row23['anular_expensa'] . '<br>';
                      }
                      ?></span>
                  </td>

                </tr>

                <tr>
                  <td>
                    Facturas faltantes:
                  </td>
                  <td>
                    <span class="res_expensa">
                      <?php
                      if (0 < count($array)) {
                        $maximo = max($array);
                        $minimo = min($array);
                        for ($i = $minimo; $i <= $maximo; $i++) {
                          if (in_array($i, $array)) {
                            echo '';
                          } else {
                            echo $i . ', ';
                          }
                        }
                      } ?>
                    </span>
                  </td>
                </tr>
              </table>

              <!-- FIN DE REPORTE DE FACTURACIÓN -->

              <!-- AGREGAR FACTURA -->

              <!-- MODAL DE INGRESO DE FACTURAS -->

              <?php
              if (isset($_POST['resfactura'])) {

                $infofac = $id_departamento . $id_municipio . '-' . $ncuraduria;
                $anoli = $_POST["ano_licencia"];

                $nfac = intval($_POST["factura_curaduria"]);
                $actualizar56 = mysql_query("SELECT id_expensa_fac FROM expensa_fac WHERE num_expensa_fac=" . $nfac . " and id_expensa_curaduria=" . $id . " and ano_licencia=" . $anoli . " and nombre_expensa_fac='$infofac' and estado_expensa_fac=1", $conexion) or die(mysql_error());
                $row156 = mysql_fetch_assoc($actualizar56);
                $total556 = mysql_num_rows($actualizar56);
                if (0 < $total556) {
                  echo  '<script type="text/javascript">swal(" Ya existe el número de factura !", " :( !", "error");</script>';
                } else {

                  $radi_num = $id_departamento . $id_municipio . '-' . $ncuraduria . '-' . $_POST["ano_radicacion"] . '-' . $_POST["num_radicacion"];
                  $insertSQL = sprintf(
                    "INSERT INTO expensa_fac (
                    id_expensa_curaduria,
                    num_expensa_fac,
                    nombre_expensa_fac,
                    ano_licencia,
                    fijo_expensa_fac,
                    vari_expensa_fac,
                    uni_expensa_fac,
                    anu_fac,

                    estado_expensa_fac,
                    fecha_expensa_fac, 
                    num_radicacion
                  ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, now(), %s)",
                    GetSQLValueString($id, "int"),
                    GetSQLValueString($nfac, "text"),
                    GetSQLValueString($infofac, "text"),
                    GetSQLValueString($_POST["ano_licencia"], "int"),

                    GetSQLValueString($_POST["fijo_expensa_fac"], "text"),
                    GetSQLValueString($_POST["vari_expensa_fac"], "text"),
                    GetSQLValueString($_POST["uni_expensa_fac"], "text"),
                    GetSQLValueString(0, "int"),
                    GetSQLValueString(1, "int"),
                    GetSQLValueString($radi_num, "text")
                  );
                  $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

                  echo $insertado;
                  echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
                }
              } else {
              }

              ?>

              <div class="modal fade" id="popagregarfacturas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                      <h4 class="modal-title" id="myModalLabel">Agregar una Nueva Factura:</h4>
                    </div>
                    <div id="nuevaAventura" class="modal-body">

                      <form id="formexpmod" action="" method="POST" name="expensa_envio">
                        <input type="hidden" name="table" value="licencia_curaduria">
                        <!-- NUMERO DE FACTURA -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>N° FACTURA</label>
                          <div class="col-sm-3 text-right" title="Departamento-Municipio-Curaduria-" style="font-size:18px;">
                            <?php echo $id_departamento . $id_municipio . '-' . $ncuraduria . '-'; ?>
                            <select name="ano_licencia" required title="Año">
                              <option value="<?php echo $anoactual; ?>" selected><?php echo $anoactual; ?></option>
                              <option value="<?php $anoactualmenos1 = $anoactual - 1;
                                              echo $anoactualmenos1; ?>"><?php echo $anoactualmenos1; ?></option>
                              <option value="<?php $anoactualmenos2 = $anoactual - 2;
                                              echo $anoactualmenos2; ?>"><?php echo $anoactualmenos2; ?></option>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <input class="form-control solonumeros" name="factura_curaduria" placeholder="Solo números" value="" style="width:100%;"><br>
                          </div>
                        </div>

                        <!-- CARGOS FIJOS -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargos Fijo</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control exp" required /><input type="hidden" id="numexp" name="fijo_expensa_fac"><br>
                          </div>
                        </div>

                        <!-- CARGOS VARIABLES -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargos Variable</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control 1exp" required /><input type="hidden" id="num1exp" name="vari_expensa_fac"><br>
                          </div>
                        </div>

                        <!-- CARGOS FIJOS -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargos Unico</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control 2exp" required /><input type="hidden" id="num2exp" name="uni_expensa_fac"><br>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5"><span style="color:#ff0000;">*</span> Número de radicacion del proyecto</label>
                          <div class="col-sm-3 text-right" title="Departamento-Municipio-Curaduria-" style="font-size:18px;">
                            <?php echo $id_departamento . $id_municipio . '-' . $ncuraduria . '-'; ?>
                            <select name="ano_radicacion" required title="Año">
                              <option value="<?php echo $anoactual; ?>" selected><?php echo $anoactual; ?></option>
                              <option value="<?php $anoactualmenos1 = $anoactual - 1;
                                              echo $anoactualmenos1; ?>"><?php echo $anoactualmenos1; ?></option>
                              <option value="<?php $anoactualmenos2 = $anoactual - 2;
                                              echo $anoactualmenos2; ?>"><?php echo $anoactualmenos2; ?></option>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <input class="form-control" name="num_radicacion" value="" style="width:100%;"><br>
                          </div>
                        </div>

                        <div class="modal-footer">
                          <button type="reset" class="btn btn-sm btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                          <input type="submit" name="resfactura" class="btn btn-sm btn-success" value="Guardar">
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- FIN MODAL DE INGRESO DE FACTURAS  -->

              <!--  FIN  AGREGAR FACTURA    -->

              <!-- DETALLE GASTOS DE PERSONAL   -->

              <!-- UPDATE DETALLE GASTOS DE PERSONAL -->
              <?php
              if (isset($_POST['update_gp'])) {

                $updateSQL = sprintf(
                  "UPDATE expensa_gp SET 
                  dg_c=%s,
                  dg_s=%s,
                  dg_sal=%s,
                  dg_trans=%s,
                  dg_cesan=%s,
                  dg_primas=%s,
                  dg_vaca=%s,
                  dg_hono=%s,
                  dg_otros=%s

                  where id_expensa_curaduria=%s",
                  GetSQLValueString($_POST["dg_c"], "text"),
                  GetSQLValueString($_POST["dg_s"], "text"),
                  GetSQLValueString($_POST["dg_sal"], "text"),
                  GetSQLValueString($_POST["dg_trans"], "text"),
                  GetSQLValueString($_POST["dg_cesan"], "text"),
                  GetSQLValueString($_POST["dg_primas"], "text"),
                  GetSQLValueString($_POST["dg_vaca"], "text"),
                  GetSQLValueString($_POST["dg_hono"], "text"),
                  GetSQLValueString($_POST["dg_otros"], "text"),

                  GetSQLValueString($id, "int")
                );
                $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

                echo $actualizado;

                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
              } else {
              }


              $query_update = sprintf("SELECT * FROM expensa_gp WHERE id_expensa_curaduria = %s", GetSQLValueString($id, "int"));
              $update = mysql_query($query_update, $conexion) or die(mysql_error());
              $row_update = mysql_fetch_assoc($update);
              $totalRows_update = mysql_num_rows($update);
              if (0 < $totalRows_update) {
              ?>


                <div class="modal fade" id="pop_gp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div id="nuevaAventura" class="modal-body">
                        <form method="POST" name="update_gp">

                          <!-- DETALLE GASTOS DE PERSONAL -->

                          <h5 class="titulos_expensa"><b>MODIFICAR GASTOS DE PERSONAL</b></h5>
                          <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                            <tr>
                              <td><span class="titleactu">N° Emp. sin el Curador: </span></td>
                              <td>
                                <span>
                                  <input class="inputexpensan numero" type="number" name="dg_c" required value="<?php echo htmlentities($row_update['dg_c'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            <tr>

                            </tr>
                            <td><span class="titleactu">N° Emp. Prestacion de Servicios: </span></td>
                            <td>
                              <span>
                                <input class="inputexpensan numero" type="number" name="dg_s" required value="<?php echo htmlentities($row_update['dg_s'], ENT_COMPAT, ''); ?>">
                              </span>
                            </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Salario Empleados:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 6exp" required value="<?php echo htmlentities($row_update['dg_sal'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num6exp" name="dg_sal" value="<?php echo htmlentities($row_update['dg_sal'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            <tr>

                            </tr>
                            <td><span class="titleactu">Subsidios De Transporte:</span></td>
                            <td>
                              <span>
                                <input type="text" class="inputexpensan 7exp" required value="<?php echo htmlentities($row_update['dg_trans'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num7exp" name="dg_trans" value="<?php echo htmlentities($row_update['dg_trans'], ENT_COMPAT, ''); ?>">
                              </span>
                            </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Cesantias: </span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 8exp" required value="<?php echo htmlentities($row_update['dg_cesan'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num8exp" name="dg_cesan" value="<?php echo htmlentities($row_update['dg_cesan'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            <tr>

                            </tr>
                            <td><span class="titleactu">Primas: </span></td>
                            <td>
                              <span>
                                <input type="text" class="inputexpensan 9exp" required value="<?php echo htmlentities($row_update['dg_primas'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num9exp" name="dg_primas" value="<?php echo htmlentities($row_update['dg_primas'], ENT_COMPAT, ''); ?>">
                              </span>
                            </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Vacaciones: </span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 10exp" required value="<?php echo htmlentities($row_update['dg_vaca'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num10exp" name="dg_vaca" value="<?php echo htmlentities($row_update['dg_vaca'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            <tr>

                            </tr>
                            <td><span class="titleactu">Honorarios: </span></td>
                            <td>
                              <span>
                                <input type="text" class="inputexpensan 11exp" required value="<?php echo htmlentities($row_update['dg_hono'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num11exp" name="dg_hono" value="<?php echo htmlentities($row_update['dg_hono'], ENT_COMPAT, ''); ?>">
                              </span>
                            </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Otros: </span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 12exp" required value="<?php echo htmlentities($row_update['dg_otros'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num12exp" name="dg_otros" value="<?php echo htmlentities($row_update['dg_otros'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                              <td></td>
                            </tr>



                          </table>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-sm btn-success" name="update_gp" value="Guardar">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              }

              mysql_free_result($update);
              $query = sprintf("SELECT * FROM expensa_curaduria, expensa_gp where expensa_curaduria.id_expensa_curaduria=expensa_gp.id_expensa_curaduria and expensa_curaduria.id_expensa_curaduria='$id' LIMIT 1");
              $select = mysql_query($query, $conexion) or die(mysql_error());
              $row1 = mysql_fetch_assoc($select);

              $editar_gp = $row1['editar_gp'];
              if (isset($_POST['ingreso_gp'])) {

                $insertSQL = sprintf(
                  "INSERT INTO expensa_gp (
                  id_expensa_curaduria,
                  nombre_expensa_gp,
                  dg_c,
                  dg_s,
                  dg_sal,
                  dg_trans,
                  dg_cesan,
                  dg_primas,
                  dg_vaca,
                  dg_hono,
                  dg_otros,
                  estado_expensa_gp,
                  fecha_expensa_gp) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,now())",
                  GetSQLValueString($id, "int"),
                  GetSQLValueString('uno', "text"),

                  GetSQLValueString($_POST["dg_c"], "int"),
                  GetSQLValueString($_POST["dg_s"], "int"),
                  GetSQLValueString($_POST["dg_sal"], "text"),
                  GetSQLValueString($_POST["dg_trans"], "text"),
                  GetSQLValueString($_POST["dg_cesan"], "text"),
                  GetSQLValueString($_POST["dg_primas"], "text"),
                  GetSQLValueString($_POST["dg_vaca"], "text"),
                  GetSQLValueString($_POST["dg_hono"], "text"),
                  GetSQLValueString($_POST["dg_otros"], "text"),
                  GetSQLValueString(1, "int")
                );

                $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                echo $insertado;
                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';

                $updateSQL2 = sprintf("UPDATE expensa_curaduria SET editar_gp=1  where id_expensa_curaduria='$id'");
                $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());
              } else {
              }

              // ESTADO PARA FIJAR SI YA HAY UN INGRESO GASTOS DE PERSONAL
              if (0 == $editar_gp) {
              ?>
                <form method="POST" name="ingreso_gp">

                  <h5 class="titulos_expensa"><b>DETALLE GASTOS DE PERSONAL</b></h5>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">

                        <!-- No. EMPLEADOS DE PLANTA SIN INCLUIR AL CURADOR -->
                        <div class="form-group">
                          <label class="col-sm-9 text_titulos_dev"><span style="color:#ff0000;">*</span> N°. Empleados De Planta Sin Incluir Al Curador</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control numero" name="dg_c" required /><br>
                          </div>
                        </div>
                        <!-- No. EMPLEADOS VINCULADO POR PRESTACION DE SERVICIOS -->
                        <div class="form-group">
                          <label class="col-sm-9 text_titulos_dev"><span style="color:#ff0000;">*</span> N°. Vinculados Por Prestacion De Servicios</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control numero" name="dg_s" required /><br>
                          </div>
                        </div>
                        <!-- Salario de los Empleados -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Salario de los Empleados</label>
                          <div class="col-sm-7">
                            <input id="13exp" type="text" class="form-control 6exp" required /><input type="hidden" id="num6exp" name="dg_sal"><br>
                          </div>
                        </div>
                        <!-- Subsidios De Transporte -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Subsidios De Transporte</label>
                          <div class="col-sm-7">
                            <input id="14exp" type="text" class="form-control 7exp" required /><input type="hidden" id="num7exp" name="dg_trans"><br>
                          </div>
                        </div>
                        <!-- Cesantias-->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Cesantias</label>
                          <div class="col-sm-7">
                            <input id="15exp" type="text" class="form-control 8exp" required /><input type="hidden" id="num8exp" name="dg_cesan"><br>
                          </div>
                        </div>
                      </div>
                      <!--col-md-6-->

                      <div class="col-md-6">
                        <!-- Primas-->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Primas</label>
                          <div class="col-sm-7">
                            <input id="16exp" type="text" class="form-control 9exp" required /><input type="hidden" id="num9exp" name="dg_primas"><br>
                          </div>
                        </div>
                        <!-- Vacaciones-->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Vacaciones</label>
                          <div class="col-sm-7">
                            <input id="17exp" type="text" class="form-control 10exp" required /><input type="hidden" id="num10exp" name="dg_vaca"><br>
                          </div>
                        </div>
                        <!-- Honorarios-->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Honorarios</label>
                          <div class="col-sm-7">
                            <input id="18exp" type="text" class="form-control 11exp" required /><input type="hidden" id="num11exp" name="dg_hono"><br>
                          </div>
                        </div>
                        <!-- Otros-->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Otros</label>
                          <div class="col-sm-7">
                            <input id="19exp" type="text" class="form-control 12exp" required /><input type="hidden" id="num12exp" name="dg_otros"><br>
                          </div>
                        </div>
                      </div><!-- col-md-6 -->

                    </div><!-- ROW -->
                  </div><!-- BOX BODY -->

                  <div class="modal-footer">
                    <button type="submit" name="ingreso_gp" class="btn btn-sm btn-success">Guardar</button>
                  </div>
                </form>

              <?php } else { ?>

                <h5 class="titulos_expensa" id="pagoscuraduria"><b>DETALLE GASTOS DE PERSONAL</b>
                  <?php if (0 == $estado or $_SESSION['rol'] == 1 or 0 < $nump22) {  ?>
                    <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_gp" title="Modificar FACTURAS"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar </button></a>
                  <?php } else {
                  } ?>
                </h5>


                <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                  <tr>
                    <td>N° Emp. Planta sin Incluir Curador: <span class="res_expensa"><?php echo '' . $row1['dg_c'] ?></span></td>
                    <td>N° Emp. Prestacion de Servicios: <span class="res_expensa"><?php echo '' . $row1['dg_s'] ?></span></td>
                  </tr>

                  <tr>
                    <td>Salario De Los Empleados: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row1['dg_sal'], 2, ",", ".") ?></span></td>
                    <td>Subsidios De Transporte: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row1['dg_trans'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Cesantias: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row1['dg_cesan'], 2, ",", ".") ?></span></td>
                    <td>Primas: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row1['dg_primas'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Vacaciones: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row1['dg_vaca'], 2, ",", ".") ?></span></td>
                    <td>Honorarios: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row1['dg_hono'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Otros: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row1['dg_otros'], 2, ",", ".") ?></span></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td style="color: white;">-</td>
                  </tr>

                  <?php

                  $dg1 = $row1["dg_sal"];
                  $dg2 = $row1["dg_trans"];
                  $dg3 = $row1["dg_cesan"];
                  $dg4 = $row1["dg_primas"];
                  $dg5 = $row1["dg_vaca"];
                  $dg6 = $row1["dg_hono"];
                  $dg7 = $row1["dg_otros"];

                  $dg8 = $row1["dg_c"];
                  $dg9 = $row1["dg_s"];


                  $dgtotalempleados = $dg8 + $dg9;

                  $dgtotal = $dg1 + $dg2 + $dg3 + $dg4 + $dg5 + $dg6 + $dg7;
                  ?>

                  <tr>
                    <td><b>Total de Empleados: <span class="res_expensa"><?php echo $dgtotalempleados; ?></span> </b></td>
                    <td style="text-align: center;">

                    </td>
                  </tr>
                  <tr>
                    <td><b>Total Gastos de Personal: <span class="res_expensa"><?php echo '$ ' . number_format((float) $dgtotal, 2, ",", "."); ?></span></b></td>

                  </tr>
                </table>

              <?php } ?>

              <!--  FIN DETALLE GASTOS DE PERSONAL   -->

              <!-- DETALLE GASTOS GENERALES -->

              <!-- UPDATE DETALLE GASTOS GENERALE-->
              <?php
              if (isset($_POST['update_gg'])) {

                $updateSQL = sprintf(
                  "UPDATE expensa_gg SET 
                  dgg_finan=%s,
                  dgg_equipos=%s,
                  dgg_arren=%s,
                  dgg_pub=%s,
                  dgg_seg=%s,
                  dgg_pap=%s,
                  dgg_bie=%s,
                  dgg_otros=%s
                  where id_expensa_curaduria=%s",
                  GetSQLValueString($_POST["dgg_finan"], "text"),
                  GetSQLValueString($_POST["dgg_equipos"], "text"),
                  GetSQLValueString($_POST["dgg_arren"], "text"),
                  GetSQLValueString($_POST["dgg_pub"], "text"),
                  GetSQLValueString($_POST["dgg_seg"], "text"),
                  GetSQLValueString($_POST["dgg_pap"], "text"),
                  GetSQLValueString($_POST["dgg_bie"], "text"),
                  GetSQLValueString($_POST["dgg_otros"], "text"),

                  GetSQLValueString($id, "int")
                );
                $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

                echo $actualizado;

                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
              } else {
              }


              $query_update = sprintf("SELECT * FROM expensa_gg WHERE id_expensa_curaduria = %s", GetSQLValueString($id, "int"));
              $update = mysql_query($query_update, $conexion) or die(mysql_error());
              $row_update = mysql_fetch_assoc($update);
              $totalRows_update = mysql_num_rows($update);
              if (0 < $totalRows_update) {
              ?>


                <div class="modal fade" id="pop_gg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div id="nuevaAventura" class="modal-body">
                        <form method="POST" name="update_gg">

                          <!-- REPORTE GASTOS GENERALES -->

                          <h5 class="titulos_expensa"><b>MODIFICAR GASTOS GENERALES</b></h5>
                          <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                            <tr>
                              <td><span class="titleactu">Gastos Financieros: </span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 13exp" required value="<?php echo htmlentities($row_update['dgg_finan'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num13exp" name="dgg_finan" value="<?php echo htmlentities($row_update['dgg_finan'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Mantenimiento Equipos:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 14exp" required value="<?php echo htmlentities($row_update['dgg_equipos'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num14exp" name="dgg_equipos" value="<?php echo htmlentities($row_update['dgg_equipos'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Arrendamientos: </span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 15exp" required value="<?php echo htmlentities($row_update['dgg_arren'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num15exp" name="dgg_arren" value="<?php echo htmlentities($row_update['dgg_arren'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Servicios Publicos: </span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 16exp" required value="<?php echo htmlentities($row_update['dgg_pub'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num16exp" name="dgg_pub" value="<?php echo htmlentities($row_update['dgg_pub'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Seguros: </span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 17exp" required value="<?php echo htmlentities($row_update['dgg_seg'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num17exp" name="dgg_seg" value="<?php echo htmlentities($row_update['dgg_seg'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Utiles Y Papeleria:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 18exp" required value="<?php echo htmlentities($row_update['dgg_pap'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num18exp" name="dgg_pap" value="<?php echo htmlentities($row_update['dgg_pap'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Bienestar: </span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 19exp" required value="<?php echo htmlentities($row_update['dgg_bie'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num19exp" name="dgg_bie" value="<?php echo htmlentities($row_update['dgg_bie'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Otros:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 20exp" required value="<?php echo htmlentities($row_update['dgg_otros'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num20exp" name="dgg_otros" value="<?php echo htmlentities($row_update['dgg_otros'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                          </table>


                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="update_gg" class="btn btn-sm btn-success">Guardar</button>
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
              <!-- FIN UPDATE DETALLE GASTOS DE PERSONAL -->

              <!-- DETALLE GASTOS GENERALES -->
              <?php
              $query = sprintf("SELECT * FROM expensa_curaduria, expensa_gg where expensa_curaduria.id_expensa_curaduria=expensa_gg.id_expensa_curaduria and expensa_curaduria.id_expensa_curaduria='$id' LIMIT 1");
              $select = mysql_query($query, $conexion) or die(mysql_error());
              $row_gg = mysql_fetch_assoc($select);

              $editar_gg = $row_gg['editar_gg'];

              if (isset($_POST['ingreso_gg'])) {

                $insertSQL = sprintf(
                  "INSERT INTO expensa_gg (
                  id_expensa_curaduria,
                  nombre_expensa_gg,
                  dgg_finan,
                  dgg_equipos,
                  dgg_arren,
                  dgg_pub,

                  dgg_seg,
                  dgg_pap,
                  dgg_bie,
                  dgg_otros,            
                  estado_expensa_gg,
                  fecha_expensa_gg) VALUES (%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,now())",
                  GetSQLValueString($id, "int"),
                  GetSQLValueString('uno', "text"),
                  GetSQLValueString($_POST["dgg_finan"], "text"),
                  GetSQLValueString($_POST["dgg_equipos"], "text"),
                  GetSQLValueString($_POST["dgg_arren"], "text"),
                  GetSQLValueString($_POST["dgg_pub"], "text"),

                  GetSQLValueString($_POST["dgg_seg"], "text"),
                  GetSQLValueString($_POST["dgg_pap"], "text"),
                  GetSQLValueString($_POST["dgg_bie"], "text"),
                  GetSQLValueString($_POST["dgg_otros"], "text"),
                  GetSQLValueString(1, "int")
                );
                $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                echo $insertado;
                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';

                $updateSQL2 = sprintf("UPDATE expensa_curaduria SET editar_gg=1  where id_expensa_curaduria='$id'");
                $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());
              } else {
              }

              // ESTADO PARA FIJAR SI YA HAY UN INGRESO GASTOS GENERALES
              if ($editar_gg == 0) {
              ?>

                <form method="POST" name="ingreso_gg">

                  <h5 class="titulos_expensa"><b>DETALLE GASTOS GENERALES</b></h5>
                  <div class="box-body">
                    <div class="row">

                      <div class="col-md-6">
                        <!-- Gastos Financieros -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Gastos Financieros</label>
                          <div class="col-sm-7">
                            <input type="text" class=" form-control 13exp" required /><input type="hidden" id="num13exp" name="dgg_finan"><br>
                          </div>
                        </div>
                        <!-- Mantenimiento De Equipos -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Mantenimiento De Equipos</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control 14exp" required /><input type="hidden" id="num14exp" name="dgg_equipos"><br>
                          </div>
                        </div>
                        <!-- Arrendamientos -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Arrendamientos</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control 15exp" required /><input type="hidden" id="num15exp" name="dgg_arren"><br>
                          </div>
                        </div>
                        <!-- Servicios Publicos -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Servicios Publicos</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control 16exp" required /><input type="hidden" id="num16exp" name="dgg_pub"><br>
                          </div>
                        </div>
                      </div>
                      <!--col-md-6-->

                      <div class="col-md-6">
                        <!-- Seguros-->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Seguros</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control 17exp" required /><input type="hidden" id="num17exp" name="dgg_seg"><br>
                          </div>
                        </div>
                        <!-- Utiles Y Papeleria-->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Utiles Y Papeleria</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control 18exp" required /><input type="hidden" id="num18exp" name="dgg_pap"><br>
                          </div>
                        </div>
                        <!-- Bienestar-->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Bienestar</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control 19exp" required /><input type="hidden" id="num19exp" name="dgg_bie"><br>
                          </div>
                        </div>
                        <!-- Otros-->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Otros</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control 20exp" required /><input type="hidden" id="num20exp" name="dgg_otros"><br>
                          </div>
                        </div>
                      </div><!-- col-md-6 -->


                    </div><!-- ROW -->
                  </div><!-- body -->

                  <div class="modal-footer">
                    <button type="submit" name="ingreso_gg" class="btn btn-sm btn-success">Guardar</button>
                  </div>
                </form>

              <?php } else { ?>

                <h5 class="titulos_expensa"><b>DETALLE GASTOS GENERALES</b>
                  <?php if (0 == $estado or $_SESSION['rol'] == 1 or 0 < $nump22) {  ?>
                    <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_gg" title="Modificar Gastos Generales"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar</button></a>
                  <?php } else {
                  } ?>
                </h5>

                <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                  <tr>
                    <td>Gastos Financieros: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gg['dgg_finan'], 2, ",", ".") ?></span></td>
                    <td>Mantenimiento De Equipos: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gg['dgg_equipos'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Arrendamientos: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gg['dgg_arren'], 2, ",", ".") ?></span></td>
                    <td>Servicios Publicos: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gg['dgg_pub'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Seguros: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gg['dgg_seg'], 2, ",", ".") ?></span></td>
                    <td>Utiles Y Papeleria: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gg['dgg_pap'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Bienestar: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gg['dgg_bie'], 2, ",", ".") ?></span></td>
                    <td>Otros: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gg['dgg_otros'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td style="color: white;">-</td>
                  </tr>

                  <?php

                  $dgg1 = $row_gg["dgg_finan"];
                  $dgg2 = $row_gg["dgg_equipos"];
                  $dgg3 = $row_gg["dgg_arren"];
                  $dgg4 = $row_gg["dgg_pub"];
                  $dgg5 = $row_gg["dgg_seg"];
                  $dgg6 = $row_gg["dgg_pap"];
                  $dgg7 = $row_gg["dgg_bie"];
                  $dgg8 = $row_gg["dgg_otros"];

                  $dggtotal = $dgg1 + $dgg2 + $dgg3 + $dgg4 + $dgg5 + $dgg6 + $dgg7 + $dgg8;

                  ?>

                  <tr>
                    <td><b>Total Gastos Generales: <span class="res_expensa"><?php echo '$ ' . number_format((float) $dggtotal, 2, ",", "."); ?></span></b></td>
                    <td></td>
                  </tr>
                </table>

              <?php } ?>

              <!--  FIN DETALLE GASTOS GENERALES  -->

              <!-- DETALLE GASTOS INVERSIÓN -->

              <!-- UPDATE  DETALLE GASTOS DE INVERSION -->
              <?php
              if (isset($_POST['update_gi'])) {

                $updateSQL = sprintf(
                  "UPDATE expensa_gi SET 
                  deg_infra=%s,
                  deg_sistec=%s,
                  deg_cap=%s

                  where id_expensa_curaduria=%s",
                  GetSQLValueString($_POST["deg_infra"], "text"),
                  GetSQLValueString($_POST["deg_sistec"], "text"),
                  GetSQLValueString($_POST["deg_cap"], "text"),

                  GetSQLValueString($id, "int")
                );
                $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

                echo $actualizado;

                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
              } else {
              }


              $query_update = sprintf("SELECT * FROM expensa_gi WHERE id_expensa_curaduria = %s", GetSQLValueString($id, "int"));
              $update = mysql_query($query_update, $conexion) or die(mysql_error());
              $row_update = mysql_fetch_assoc($update);
              $totalRows_update = mysql_num_rows($update);
              if (0 < $totalRows_update) {
              ?>


                <div class="modal fade" id="pop_gi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div id="nuevaAventura" class="modal-body">
                        <form method="POST" name="update_gi">

                          <!-- REPORTE GASTOS DE INVERSION  -->
                          <h5 class="titulos_expensa"><b>MODIFICAR GASTOS DE INVERSION</b></h5>
                          <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                            <tr>
                              <td><span class="titleactu">Infraestructura Y Locativos:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 21exp" required value="<?php echo htmlentities($row_update['deg_infra'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num21exp" name="deg_infra" value="<?php echo htmlentities($row_update['deg_infra'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Sistema Y Tecnologia:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 22exp" required value="<?php echo htmlentities($row_update['deg_sistec'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num22exp" name="deg_sistec" value="<?php echo htmlentities($row_update['deg_sistec'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Capacitacion:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 23exp" required value="<?php echo htmlentities($row_update['deg_cap'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num23exp" name="deg_cap" value="<?php echo htmlentities($row_update['deg_cap'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                          </table>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="update_gi" class="btn btn-sm btn-success">Guardar</button>
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
              <!-- FIN UPDATE DETALLE GASTOS DE INVERSION -->


              <!-- DETALLE GASTOS INVERSIÓN -->
              <?php
              $query = sprintf("SELECT * FROM expensa_curaduria, expensa_gi where expensa_curaduria.id_expensa_curaduria=expensa_gi.id_expensa_curaduria and expensa_curaduria.id_expensa_curaduria='$id' LIMIT 1");
              $select = mysql_query($query, $conexion) or die(mysql_error());
              $row_gi = mysql_fetch_assoc($select);

              $editar_gi = $row_gi['editar_gi'];
              ?>

              <?php
              if (isset($_POST['ingreso_gi'])) {

                $insertSQL = sprintf(
                  "INSERT INTO expensa_gi (
                  id_expensa_curaduria,
                  nombre_expensa_gi,

                  deg_infra,
                  deg_sistec,
                  deg_cap,

                  estado_expensa_gi,
                  fecha_expensa_gi) VALUES (%s,%s,%s,%s,%s,%s,now())",
                  GetSQLValueString($id, "int"),
                  GetSQLValueString('uno', "text"),

                  GetSQLValueString($_POST["deg_infra"], "text"),
                  GetSQLValueString($_POST["deg_sistec"], "text"),
                  GetSQLValueString($_POST["deg_cap"], "text"),

                  GetSQLValueString(1, "int")
                );
                $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

                echo $insertado;

                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';

                $updateSQL2 = sprintf("UPDATE expensa_curaduria SET editar_gi=1  where id_expensa_curaduria='$id'");
                $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());
              } else {
              }
              ?>

              <?php // ESTADO PARA FIJAR SI YA HAY UN INGRESO GASTOS INVERSIÓN
              if ($editar_gi == 0) {
              ?>
                <form method="POST" name="ingreso_gi">

                  <h5 class="titulos_expensa"><b> DETALLE GASTOS INVERSIÓN </b></h5>
                  <div class="box-body">
                    <div class="row">

                      <div class="col-md-12">

                        <!-- N°. Infraestructura y Locativos -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Infraestructura y Locativos</label>
                          <div class="col-sm-7">
                            <input id="28exp" type="text" class="form-control 21exp" required /><input type="hidden" id="num21exp" name="deg_infra"><br>
                          </div>
                        </div>
                        <!-- Sistemas Y Tecnologia -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Sistemas Y Tecnologia</label>
                          <div class="col-sm-7">
                            <input id="29exp" type="text" class="form-control 22exp" required /><input type="hidden" id="num22exp" name="deg_sistec"><br>
                          </div>
                        </div>
                        <!-- Capacitación -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Capacitación</label>
                          <div class="col-sm-7">
                            <input id="30exp" type="text" class="form-control 23exp" required /><input type="hidden" id="num23exp" name="deg_cap"><br>
                          </div>
                        </div>

                      </div><!-- col-md-12 -->

                    </div><!-- ROW -->
                  </div><!-- BODY -->

                  <div class="modal-footer">
                    <button type="submit" name="ingreso_gi" class="btn btn-sm btn-success">Guardar</button>
                  </div>
                </form>

              <?php } else { ?>

                <h5 class="titulos_expensa"><b>DETALLE GASTOS INVERSIÓN </b>
                  <?php if (0 == $estado or $_SESSION['rol'] == 1 or 0 < $nump22) {  ?>
                    <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_gi" title="Modificar Gastos Inversion"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar</button></a>
                  <?php } else {
                  } ?>
                </h5>

                <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                  <tr>
                    <td>Infraestructura Y Locativos: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gi['deg_infra'], 2, ",", ".") ?></span></td>
                    <td>Sistema Y Tecnologia: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gi['deg_sistec'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Capacitacion: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gi['deg_cap'], 2, ",", ".") ?></span></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td style="color: white;">-</td>
                  </tr>

                  <?php

                  $deg1 = $row_gi["deg_infra"];
                  $deg2 = $row_gi["deg_sistec"];
                  $deg3 = $row_gi["deg_cap"];

                  $degtotal = $deg1 + $deg2 + $deg3;

                  ?>

                  <tr>
                    <td><b>Total Gastos Inversión: <span class="res_expensa"><?php echo '$ ' . number_format((float) $degtotal, 2, ",", ".");  ?></span></b></td>
                    <td></td>
                  </tr>
                </table>

              <?php } ?>

              <!--  FIN  DETALLE GASTOS INVERSIÓN  -->

              <!-- DETALLE GASTOS TRANSFERENCIA  -->

              <!-- UPDATE DETALLE GASTOS DE TRASNFERENCIA -->
              <?php
              if (isset($_POST['update_gt'])) {

                $updateSQL = sprintf(
                  "UPDATE expensa_gt SET 

                  dt_cc=%s,
                  dt_sena=%s,
                  df_icbf=%s,
                  dt_es=%s,
                  dt_arp=%s,
                  dt_fadp=%s,
                  dt_agremi=%s,
                  dt_otros=%s

                  where id_expensa_curaduria=%s",
                  GetSQLValueString($_POST["dt_cc"], "text"),
                  GetSQLValueString($_POST["dt_sena"], "text"),
                  GetSQLValueString($_POST["df_icbf"], "text"),
                  GetSQLValueString($_POST["dt_es"], "text"),
                  GetSQLValueString($_POST["dt_arp"], "text"),
                  GetSQLValueString($_POST["dt_fadp"], "text"),
                  GetSQLValueString($_POST["dt_agremi"], "text"),
                  GetSQLValueString($_POST["dt_otros"], "text"),

                  GetSQLValueString($id, "int")
                );
                $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

                echo $actualizado;

                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
              } else {
              }


              $query_update = sprintf("SELECT * FROM expensa_gt WHERE id_expensa_curaduria = %s", GetSQLValueString($id, "int"));
              $update = mysql_query($query_update, $conexion) or die(mysql_error());
              $row_update = mysql_fetch_assoc($update);
              $totalRows_update = mysql_num_rows($update);
              if (0 < $totalRows_update) {
              ?>


                <div class="modal fade" id="pop_gt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div id="nuevaAventura" class="modal-body">
                        <form method="POST" name="update_gt">

                          <!-- REPORTE GASTOS DE INVERSION  -->


                          <h5 class="titulos_expensa"><b>MODIFICAR GASTOS DE TRASNFERENCIA</b></h5>
                          <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                            <tr>
                              <td><span class="titleactu">Caja De Compensación:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 24exp" required value="<?php echo htmlentities($row_update['dt_cc'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num24exp" name="dt_cc" value="<?php echo htmlentities($row_update['dt_cc'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Sena:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 25exp" required value="<?php echo htmlentities($row_update['dt_sena'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num25exp" name="dt_sena" value="<?php echo htmlentities($row_update['dt_sena'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Icbf:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 26exp" required value="<?php echo htmlentities($row_update['df_icbf'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num26exp" name="df_icbf" value="<?php echo htmlentities($row_update['df_icbf'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Eps Salud:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 27exp" required value="<?php echo htmlentities($row_update['dt_es'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num27exp" name="dt_es" value="<?php echo htmlentities($row_update['dt_es'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Arp Riesgos Profesionales:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 28exp" required value="<?php echo htmlentities($row_update['dt_arp'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num28exp" name="dt_arp" value="<?php echo htmlentities($row_update['dt_arp'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Fondo Adm. de Pensiones:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 29exp" required value="<?php echo htmlentities($row_update['dt_fadp'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num29exp" name="dt_fadp" value="<?php echo htmlentities($row_update['dt_fadp'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Agremiaciones:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 30exp" required value="<?php echo htmlentities($row_update['dt_agremi'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num30exp" name="dt_agremi" value="<?php echo htmlentities($row_update['dt_agremi'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Otros:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 31exp" required value="<?php echo htmlentities($row_update['dt_otros'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num31exp" name="dt_otros" value="<?php echo htmlentities($row_update['dt_otros'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                          </table>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="update_gt" class="btn btn-sm btn-success">Guardar</button>
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
              <!-- FIN UPDATE DETALLE GASTOS DE TRASNFERENCIA -->

              <!-- DETALLE GASTOS TRANSFERENCIA -->
              <?php
              $query = sprintf("SELECT * FROM expensa_curaduria, expensa_gt where expensa_curaduria.id_expensa_curaduria=expensa_gt.id_expensa_curaduria and expensa_curaduria.id_expensa_curaduria='$id' LIMIT 1");
              $select = mysql_query($query, $conexion) or die(mysql_error());
              $row_gt = mysql_fetch_assoc($select);

              $editar_gt = $row_gt['editar_gt'];

              if (isset($_POST['ingreso_gt'])) {

                $insertSQL = sprintf(
                  "INSERT INTO expensa_gt (
                  id_expensa_curaduria,
                  nombre_expensa_gt,
                  dt_cc,
                  dt_sena,
                  df_icbf,
                  dt_es,

                  dt_arp,
                  dt_fadp,
                  dt_agremi,
                  dt_otros,
                  estado_expensa_gt,
                  fecha_expensa_gt) VALUES (%s,%s,%s,%s,%s,%s, %s,%s,%s,%s, %s,now())",
                  GetSQLValueString($id, "int"),
                  GetSQLValueString('uno', "text"),
                  GetSQLValueString($_POST["dt_cc"], "text"),
                  GetSQLValueString($_POST["dt_sena"], "text"),
                  GetSQLValueString($_POST["df_icbf"], "text"),
                  GetSQLValueString($_POST["dt_es"], "text"),

                  GetSQLValueString($_POST["dt_arp"], "text"),
                  GetSQLValueString($_POST["dt_fadp"], "text"),
                  GetSQLValueString($_POST["dt_agremi"], "text"),
                  GetSQLValueString($_POST["dt_otros"], "text"),
                  GetSQLValueString(1, "int")
                );
                $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                echo $insertado;
                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';

                $updateSQL2 = sprintf("UPDATE expensa_curaduria SET editar_gt=1  where id_expensa_curaduria='$id'");
                $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());
              } else {
              }

              // ESTADO PARA FIJAR SI YA HAY UN INGRESO GASTOS DE TRANSFERENCIA
              if ($editar_gt == 0) {
              ?>
                <form method="POST" name="ingreso_gt">

                  <h5 class="titulos_expensa"><b>DETALLE GASTOS DE TRANSFERENCIA</b></h5>
                  <div class="box-body">
                    <div class="row">

                      <div class="col-md-6">
                        <!-- Caja De Compensación -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Caja De Compensación</label>
                          <div class="col-sm-7">
                            <input id="31exp" type="text" class="form-control 24exp" required /><input type="hidden" id="num24exp" name="dt_cc"><br>
                          </div>
                        </div>
                        <!-- Sena -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Sena</label>
                          <div class="col-sm-7">
                            <input id="32exp" type="text" class="form-control 25exp" required /><input type="hidden" id="num25exp" name="dt_sena"><br>
                          </div>
                        </div>
                        <!-- Icbf -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Icbf</label>
                          <div class="col-sm-7">
                            <input id="33exp" type="text" class="form-control 26exp" required /><input type="hidden" id="num26exp" name="df_icbf"><br>
                          </div>
                        </div>
                        <!-- Eps Salud -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Eps Salud</label>
                          <div class="col-sm-7">
                            <input id="34exp" type="text" class="form-control 27exp" required /><input type="hidden" id="num27exp" name="dt_es"><br>
                          </div>
                        </div>
                      </div><!-- col-md-6 -->


                      <div class="col-md-6">
                        <!-- Arp Riesgos Profesionales -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Arp Riesgos Profesionales</label>
                          <div class="col-sm-7">
                            <input id="35exp" type="text" class="form-control 28exp" required /><input type="hidden" id="num28exp" name="dt_arp"><br>
                          </div>
                        </div>
                        <!-- Fondo AdministraciÓN De Pensiones -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Fondo Adm. Pensiones</label>
                          <div class="col-sm-7">
                            <input id="36exp" type="text" class="form-control 29exp" required /><input type="hidden" id="num29exp" name="dt_fadp"><br>
                          </div>
                        </div>
                        <!-- Agremiaciones -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Agremiaciones</label>
                          <div class="col-sm-7">
                            <input id="37exp" type="text" class="form-control 30exp" required /><input type="hidden" id="num30exp" name="dt_agremi"><br>
                          </div>
                        </div>
                        <!-- Otros -->
                        <div class="form-group">
                          <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span> Otros</label>
                          <div class="col-sm-7">
                            <input id="38exp" type="text" class="form-control 31exp" required /><input type="hidden" id="num31exp" name="dt_otros"><br>
                          </div>
                        </div>
                      </div><!-- col-md-6 -->

                    </div><!-- ROW -->
                  </div><!-- box-body -->

                  <div class="modal-footer">
                    <button type="submit" name="ingreso_gt" class="btn btn-sm btn-success">Guardar</button>
                  </div>
                </form>

              <?php } else { ?>

                <h5 class="titulos_expensa"><b>DETALLE GASTOS TRANSFERENCIA </b>
                  <?php if (0 == $estado or $_SESSION['rol'] == 1 or 0 < $nump22) {  ?>
                    <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_gt" title="Modificar Gastos Generales"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar</button></a>
                  <?php } else {
                  } ?>
                </h5>

                <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                  <tr>
                    <td>Caja De Compensación: </b> <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gt['dt_cc'], 2, ",", ".") ?></span></td>
                    <td>Sena: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gt['dt_sena'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Icbf: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gt['df_icbf'], 2, ",", ".") ?></span></td>
                    <td>Eps Salud: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gt['dt_es'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Arp Riesgos Profesionales: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gt['dt_arp'], 2, ",", ".") ?></span></td>
                    <td>Fondo Adm. de Pensiones: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gt['dt_fadp'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td>Agremiaciones: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gt['dt_agremi'], 2, ",", ".") ?></span></td>
                    <td>Otros: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_gt['dt_otros'], 2, ",", ".") ?></span></td>
                  </tr>

                  <tr>
                    <td style="color: white;">-</td>
                  </tr>

                  <?php

                  $dt1 = $row_gt["dt_cc"];
                  $dt2 = $row_gt["dt_sena"];
                  $dt3 = $row_gt["df_icbf"];
                  $dt4 = $row_gt["dt_es"];
                  $dt5 = $row_gt["dt_arp"];
                  $dt6 = $row_gt["dt_fadp"];
                  $dt7 = $row_gt["dt_agremi"];
                  $dt8 = $row_gt["dt_otros"];

                  $dttotal = $dt1 + $dt2 + $dt3 + $dt4 + $dt5 + $dt6 + $dt7 + $dt8;

                  ?>

                  <tr>
                    <td><b>Total Gastos Transferencia: <span class="res_expensa"><?php echo '$ ' . number_format((float) $dttotal, 2, ",", "."); ?></span></b></td>
                    <td></td>
                  </tr>
                </table>

              <?php } ?>

              <!--  FIN  DETALLE GASTOS TRANSFERENCIA  -->

              <!-- DETALLE IVA -->

              <!-- UPDATE DETALLE IVA -->
              <?php
              if (isset($_POST['update_giva'])) {

                $updateSQL = sprintf(
                  "UPDATE expensa_giva SET 
                  iva_vi=%s,
                  iva_vifepago=%s,
                  iva_vipeini=%s,
                  iva_vipefin=%s,

                  iva_rf=%s,
                  iva_rffepago=%s,
                  iva_rfpeini=%s,
                  iva_rfpefin=%s,

                  iva_rete=%s,
                  iva_retefepago=%s,
                  iva_retepeini=%s,
                  iva_retepefin=%s,

                  iva_obser=%s

                  where id_expensa_curaduria=%s",
                  GetSQLValueString($_POST["iva_vi"], "text"),
                  GetSQLValueString($_POST["iva_vifepago"], "date"),
                  GetSQLValueString($_POST["iva_vipeini"], "date"),
                  GetSQLValueString($_POST["iva_vipefin"], "date"),

                  GetSQLValueString($_POST["iva_rf"], "text"),
                  GetSQLValueString($_POST["iva_rffepago"], "date"),
                  GetSQLValueString($_POST["iva_rfpeini"], "date"),
                  GetSQLValueString($_POST["iva_rfpefin"], "date"),

                  GetSQLValueString($_POST["iva_rete"], "text"),
                  GetSQLValueString($_POST["iva_retefepago"], "date"),
                  GetSQLValueString($_POST["iva_retepeini"], "date"),
                  GetSQLValueString($_POST["iva_retepefin"], "date"),

                  GetSQLValueString($_POST["iva_obser"], "text"),

                  GetSQLValueString($id, "int")
                );
                $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

                echo $actualizado;

                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
              } else {
              }


              $query_update = sprintf("SELECT * FROM expensa_giva WHERE id_expensa_curaduria = %s", GetSQLValueString($id, "int"));
              $update = mysql_query($query_update, $conexion) or die(mysql_error());
              $row_update = mysql_fetch_assoc($update);
              $totalRows_update = mysql_num_rows($update);
              if (0 < $totalRows_update) {
              ?>


                <div class="modal fade" id="pop_giva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div id="nuevaAventura" class="modal-body">
                        <form method="POST" name="update_giva">

                          <!-- DETALLE GASTOS DE IVA -->
                          <h5 class="titulos_expensa"><b>PAGOS DE IMPUESTOS</b></h5>
                          <table style="width:100%; border: solid 1px #eee; font-size: 100%;">

                            <tr>
                              <td><span class="titleactu">Valor IVA:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 32exp" required value="<?php echo htmlentities($row_update['iva_vi'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num32exp" name="iva_vi" value="<?php echo htmlentities($row_update['iva_vi'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Fecha de Pago:</span></td>
                              <td>
                                <span>
                                  <input type="date" class="inputexpensan datepicker" name="iva_vifepago" value="<?php echo $row_update['iva_vifepago']; ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Periodo Desde:</span></td>
                              <td>
                                <span>
                                  <input type="date" class="inputexpensan datepicker" name="iva_vipeini" value="<?php echo $row_update['iva_vipeini']; ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Periodo Hasta:</span></td>
                              <td>
                                <span>
                                  <input type="date" class="inputexpensan datepicker" name="iva_vipefin" value="<?php echo $row_update['iva_vipefin']; ?>">
                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <hr>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">V. Retencion Fuente:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 33exp" required value="<?php echo htmlentities($row_update['iva_rf'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num33exp" name="iva_rf" value="<?php echo htmlentities($row_update['iva_rf'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Fecha de Pago:</span></td>
                              <td>
                                <span>
                                  <input type="date" class="inputexpensan datepicker" name="iva_rffepago" value="<?php echo $row_update['iva_rffepago']; ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Periodo Desde:</span></td>
                              <td>
                                <span>
                                  <input type="date" class="inputexpensan datepicker" name="iva_rfpeini" value="<?php echo $row_update['iva_rfpeini']; ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Periodo Hasta:</span></td>
                              <td>
                                <span>
                                  <input type="date" class="inputexpensan datepicker" name="iva_rfpefin" value="<?php echo $row_update['iva_rfpefin']; ?>">
                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <hr>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Reteica:</span></td>
                              <td>
                                <span>
                                  <input type="text" class="inputexpensan 34exp" required value="<?php echo htmlentities($row_update['iva_rete'], ENT_COMPAT, ''); ?>" /><input type="hidden" id="num34exp" name="iva_rete" value="<?php echo htmlentities($row_update['iva_rete'], ENT_COMPAT, ''); ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Fecha de Pago:</span></td>
                              <td>
                                <span>
                                  <input type="date" class="inputexpensan datepicker" name="iva_retefepago" value="<?php echo $row_update['iva_retefepago']; ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Periodo Desde:</span></td>
                              <td>
                                <span>
                                  <input type="date" class="inputexpensan datepicker" name="iva_retepeini" value="<?php echo $row_update['iva_retepeini']; ?>">
                                </span>
                              </td>
                            </tr>

                            <tr>
                              <td><span class="titleactu">Periodo Hasta:</span></td>
                              <td>
                                <span>
                                  <input type="date" class="inputexpensan datepicker" name="iva_retepefin" value="<?php echo $row_update['iva_retepefin']; ?>">
                                </span>
                              </td>
                            </tr>
                            <hr>

                            <table style="width:100%; border: solid 1px #eee; font-size: 14px;">
                              <tr>
                                <td>Observaciones:
                                  <textarea name="iva_obser" rows="1" style="width: 100%; heigth:50px;"><?php echo $row_update['iva_obser']; ?></textarea>
                              </tr>
                            </table>

                          </table>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="update_giva" class="btn btn-sm btn-success">Guardar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              }
              mysql_free_result($update);
              // FIN  UPDATE DETALLE IVA

              // DETALLE IVA               
              $query = sprintf("SELECT * FROM expensa_curaduria, expensa_giva where expensa_curaduria.id_expensa_curaduria=expensa_giva.id_expensa_curaduria and expensa_curaduria.id_expensa_curaduria='$id' LIMIT 1");
              $select = mysql_query($query, $conexion) or die(mysql_error());
              $row_giva = mysql_fetch_assoc($select);

              $editar_giva = $row_giva['editar_giva'];

              if (isset($_POST['ingreso_giva'])) {

                if ($_POST["iva_vi"] == 0) {
                  $_POST["iva_vifepago"] = '';
                  $_POST["iva_vipeini"] = '';
                  $_POST["iva_vipefin"] = '';
                } else {
                }

                if ($_POST["iva_rf"] == 0) {
                  $_POST["iva_rffepago"] = '';
                  $_POST["iva_rfpeini"] = '';
                  $_POST["iva_rfpefin"] = '';
                } else {
                }

                if ($_POST["iva_rete"] == 0) {
                  $_POST["iva_retefepago"] = '';
                  $_POST["iva_retepeini"] = '';
                  $_POST["iva_retepefin"] = '';
                } else {
                }

                $insertSQL = sprintf(
                  "INSERT INTO expensa_giva (
                  id_expensa_curaduria,
                  nombre_expensa_giva,

                  iva_vi,
                  iva_vifepago,
                  iva_vipeini,
                  iva_vipefin,

                  iva_rf,
                  iva_rffepago,
                  iva_rfpeini,
                  iva_rfpefin,

                  iva_rete,
                  iva_retefepago,
                  iva_retepeini,
                  iva_retepefin,

                  iva_obser,

                  estado_expensa_giva,
                  fecha_expensa_giva) VALUES (%s,%s, %s,%s,%s,%s, %s,%s,%s,%s, %s,%s,%s,%s, %s, %s,now())",
                  GetSQLValueString($id, "int"),
                  GetSQLValueString('uno', "text"),

                  GetSQLValueString($_POST["iva_vi"], "text"),
                  GetSQLValueString($_POST["iva_vifepago"], "date"),
                  GetSQLValueString($_POST["iva_vipeini"], "date"),
                  GetSQLValueString($_POST["iva_vipefin"], "date"),

                  GetSQLValueString($_POST["iva_rf"], "text"),
                  GetSQLValueString($_POST["iva_rffepago"], "date"),
                  GetSQLValueString($_POST["iva_rfpeini"], "date"),
                  GetSQLValueString($_POST["iva_rfpefin"], "date"),

                  GetSQLValueString($_POST["iva_rete"], "text"),
                  GetSQLValueString($_POST["iva_retefepago"], "date"),
                  GetSQLValueString($_POST["iva_retepeini"], "date"),
                  GetSQLValueString($_POST["iva_retepefin"], "date"),

                  GetSQLValueString($_POST["iva_obser"], "text"),

                  GetSQLValueString(1, "int")
                );
                $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
                echo $insertado;
                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';

                $updateSQL2 = sprintf("UPDATE expensa_curaduria SET editar_giva=1  where id_expensa_curaduria='$id'");
                $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());
              } else {
              }



              ?>


              <?php // ESTADO PARA FIJAR SI YA HAY UN INGRESO GASTOS DE IVA
              if ($editar_giva == 0) {
              ?>
                <form method="POST" name="ingreso_giva">

                  <h5 class="titulos_expensa"><b>DETALLE PAGOS DE IMPUESTOS</b></h5>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">

                        <table style="width:100%;  font-size: 11px;">
                          <tr>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <label class="text_titulos_dev">&nbsp; Valor IVA</label>
                                </div>
                                <input id="39exp" type="text" class="form-control 32exp" required /><input type="hidden" id="num32exp" name="iva_vi">
                              </div>
                            </td>

                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i><label class="text_titulos_dev">&nbsp; Fecha Pago</label>
                                </div>
                                <input id="" type="date" class="form-control datepicker" name="iva_vifepago">
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <label class="text_titulos_dev"> Periodo Desde</label><br>
                                </div>
                                <input id="" type="date" class="form-control datepicker" name="iva_vipeini">
                              </div>
                            </td>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <label class="text_titulos_dev"> Hasta</label><br>
                                </div>
                                <input id="" type="date" class="form-control datepicker" name="iva_vipefin">
                              </div>
                            </td>
                          </tr>
                        </table>

                        <hr>

                        <table style="width:100%; border: solid 1px #eee; font-size: 11px;">
                          <tr>

                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <label class="text_titulos_dev">&nbsp; V. Rete-Fuente</label>
                                </div>
                                <input id="43exp" type="text" class="form-control 33exp" required /><input type="hidden" id="num33exp" name="iva_rf">
                              </div>
                            </td>

                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i><label class="text_titulos_dev">&nbsp; Fecha Pago</label>
                                </div>
                                <input id="" type="date" class="form-control datepicker" name="iva_rffepago">
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <label class="text_titulos_dev"> Periodo Desde</label><br>
                                </div>
                                <input id="" type="date" class="form-control datepicker" name="iva_rfpeini">
                              </div>
                            </td>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <label class="text_titulos_dev"> Hasta</label><br>
                                </div>
                                <input id="" type="date" class="form-control datepicker" name="iva_rfpefin">
                              </div>
                            </td>
                          </tr>
                        </table>

                        <hr>

                        <table style="width:100%; border: solid 1px #eee; font-size: 11px;">
                          <tr>

                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <label class="text_titulos_dev">&nbsp; Reteica</label>
                                </div>
                                <input id="47exp" type="text" class="form-control 34exp" required /><input type="hidden" id="num34exp" name="iva_rete">
                              </div>
                            </td>

                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i><label class="text_titulos_dev">&nbsp; Fecha Pago</label>
                                </div>
                                <input id="" type="date" class="form-control datepicker" name="iva_retefepago">
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <label class="text_titulos_dev"> Periodo Desde</label><br>
                                </div>
                                <input id="" type="date" class="form-control datepicker" name="iva_retepeini">
                              </div>
                            </td>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <label class="text_titulos_dev"> Hasta</label><br>
                                </div>
                                <input id="" type="date" class="form-control datepicker" name="iva_retepefin">
                              </div>
                            </td>
                          </tr>
                        </table>

                        <hr>

                        <table style="width:100%; border: solid 1px #eee; font-size: 16px;">
                          <tr>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i><label class="text_titulos_dev">&nbsp; Observaciones</label>
                                </div>
                                <textarea name="iva_obser" rows="4" style="width: 100%;" placeholder="Coloque las Observaciones referentes a aclaraciones con impuestos"></textarea>
                              </div>
                            </td>
                          </tr>
                        </table>

                      </div><!-- col-md-6 -->
                    </div><!-- ROW -->
                  </div>

                  <div class="modal-footer">
                    <button type="submit" name="ingreso_giva" class="btn btn-sm btn-success">Guardar</button>
                  </div>
                </form>

              <?php } else { ?>

                <h5 class="titulos_expensa"><b>GASTOS DE IMPUESTOS </b>
                  <?php if (0 == $estado or 1 == $_SESSION['rol'] or 0 < $nump22) {  ?>
                    <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_giva" title="Modificar Gastos Generales"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar</button></a>
                  <?php } else {
                  } ?>
                </h5>

                <!-- DETALLE IVA -->
                <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                  <tr>
                    <td>Valor IVA: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_giva['iva_vi'], 2, ",", "."); ?></span></td>

                    <td>Fecha de Pago: <span class="res_expensa"><?php echo $row_giva['iva_vifepago']; ?></span></td>
                  </tr>
                  <tr>
                    <td>Periodo Desde: <span class="res_expensa"><?php echo $row_giva['iva_vipeini']; ?></span></td>

                    <td>Periodo Hasta: <span class="res_expensa"><?php echo $row_giva['iva_vipefin']; ?></span></td>
                  </tr>
                  <tr>
                    <td style="color: white;">------------</td>
                    <td style="color: white;">------------</td>
                  </tr>

                  <tr>
                    <td>V. Retencion Fuente: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_giva['iva_rf'], 2, ",", "."); ?></span></td>

                    <td>Fecha de Pago: <span class="res_expensa"><?php echo $row_giva['iva_rffepago']; ?></span></td>
                  </tr>
                  <tr>
                    <td>Periodo Desde: <span class="res_expensa"><?php echo $row_giva['iva_rfpeini']; ?></span></td>

                    <td>Periodo Hasta: <span class="res_expensa"><?php echo $row_giva['iva_rfpefin']; ?></span></td>
                  </tr>
                  <tr>
                    <td style="color: white;">------------</td>
                    <td style="color: white;">------------</td>
                  </tr>

                  <tr>
                    <td>Reteica: <span class="res_expensa"><?php echo '$ ' . number_format((float) $row_giva['iva_rete'], 2, ",", "."); ?></span></td>

                    <td>Fecha de Pago: <span class="res_expensa"><?php echo $row_giva['iva_retefepago']; ?></span></td>
                  </tr>
                  <tr>
                    <td>Periodo Desde: <span class="res_expensa"><?php echo $row_giva['iva_retepeini']; ?></span></td>

                    <td>Periodo Hasta: <span class="res_expensa"><?php echo $row_giva['iva_retepefin']; ?></span></td>
                  </tr>
                </table>

                <table style="width:100%; border: solid 1px #eee; font-size: 14px;">
                  <tr>
                    <td>Observaciones: <span class="res_expensa"><?php echo $row_giva['iva_obser']; ?></span></td>
                  </tr>
                </table>

                <br>


              <?php } ?>


              <!--  FIN  DETALLE IVA   -->




              <!-- EGRESOS  -->


              <h5 class="titulos_expensa"><b>EGRESOS</b></h5>
              <table style="width:100%; border: solid 1px #eee; font-size: 100%;">
                <tr>
                  <?php if ($editar_gg == 1) { ?>
                    <td><b>Gastos de Personal: </b> <span class="res_expensa"><?php echo '$ ' . number_format((float) $dgtotal, 2, ",", "."); ?></span></td>
                  <?php } else { ?>
                    <td><b>Gastos de Personal: </b> <span class="res_expensa">FALTA GASTOS DE PERSONAL</span></td>
                  <?php } ?>
                </tr>

                <tr>
                  <?php if ($editar_gg == 1) { ?>
                    <td><b>Gastos de Generales: </b> <span class="res_expensa"><?php echo '$ ' . number_format((float) $dggtotal, 2, ",", "."); ?></span></td>
                  <?php } else { ?>
                    <td><b>Gastos de Generales: </b> <span class="res_expensa">FALTA GASTOS GENERALES</span></td>
                  <?php } ?>
                </tr>

                <tr>
                  <?php if ($editar_gi == 1) { ?>
                    <td><b>Gastos de Inversión: </b> <span class="res_expensa"><?php echo '$ ' . number_format((float) $degtotal, 2, ",", "."); ?></span></td>
                  <?php } else { ?>
                    <td><b>Gastos de Inversión: </b> <span class="res_expensa">FALTA GASTOS DE INVERSIÓN</span></td>
                  <?php } ?>
                </tr>

                <tr>
                  <?php if ($editar_gt == 1) { ?>
                    <td><b>Gastos de Transferencia: </b> <span class="res_expensa"><?php echo '$ ' . number_format((float) $dttotal, 2, ",", "."); ?></span></td>
                  <?php } else { ?>
                    <td><b>Gastos de Transferencia: </b> <span class="res_expensa">FALTA GASTOS DE TRANSFERENCIA</span></td>
                  <?php } ?>
                </tr>

                <tr>
                  <?php if ($editar_gg == 1 && $editar_gi == 1 && $editar_gp == 1 && $editar_gt == 1) {
                    $grantotal = $dgtotal + $dggtotal + $degtotal + $dttotal; ?>
                    <td><b>TOTAL DE EGRESOS: </b> <span class="res_expensa"><?php echo '$ ' . number_format((float) $grantotal, 2, ",", "."); ?></span></td>
                  <?php
                  } else { ?>
                    <td><b>TOTAL DE EGRESOS: </b> <span class="res_expensa">FALTA ALGUNO DE LOS GASTOS</span></td>
                  <?php } ?>
                </tr>

              </table><br>


              <!-- REPORTE DE FACTURACIÓN -->
              <h5 class="titulos_expensa"><b>VALOR POR CONCEPTO TASA VIGILANCIA</b></h5>
              <table style="width:100%; border: solid 1px #eee; font-size: 100%;">

                <tr>
                  <td><b>Total Facturación: <span class="res_expensa">
                        <?php echo '$ ' . number_format((float) $totalfacturacion, 2, ",", ".") ?>
                      </span></b>
                  </td>
                </tr>

                <tr>
                  <td><b>Valor Tarifa Vigilancia 5%: <span class="res_expensa">
                        <?php
                        $mostartarifa = $totalfacturacion * 05 / 100;
                        echo '$ ' . number_format((float) $mostartarifa, 2, ",", ".")
                        ?>
                      </span></b>
                  </td>
                </tr>
              </table>
              <br>
              <div class="alert" style="background:#D58512;color:#fff;" role="alert">
                La obligación del pago deberá cumplirse dentro de los 15 primeros días de cada mes
                mediante transferencia electrónica a la cuenta corriente 256-95508-9 denominada SUPERNOTARIADO-RECAUDO CURADORES del banco Occidente.
              </div>

              <!-- POP DE ALERT DE MODIFICAR FACTURA -->

              <?php
              if (isset($_POST['update_fac'])) {

                $updateSQL = sprintf(
                  "UPDATE expensa_fac SET 
                  fijo_expensa_fac=%s,
                  vari_expensa_fac=%s,
                  uni_expensa_fac=%s

                  where id_expensa_fac=%s",
                  GetSQLValueString($_POST["fijo_expensa_fac"], "text"),
                  GetSQLValueString($_POST["vari_expensa_fac"], "text"),
                  GetSQLValueString($_POST["uni_expensa_fac"], "text"),

                  GetSQLValueString($_POST["id_expensa_fac"], "int")
                );
                $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

                echo $actualizado;

                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
              } else {
              }
              ?>

              <div class="modal fade" id="popupupdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <span style="font-size: 20px; float: right; margin-right: 30px;"><b>MODIFICAR FACTURA</b></span>
                      <div class="box-tools pull-right">

                      </div>
                    </div>
                    <div id="nuevaAventura22" class="modal-body">
                      <form action="expensa&<?php echo $id; ?>.jsp" method="POST" name="anula_fac"><input type="hidden" name="">
                        <div id="divupdate">

                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- RADICAR NOTA DE CREDITO -->
              <div class="modal fade" id="notacredito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <span style="font-size: 20px; float: right; margin-right: 30px;"><b>Solicitar Nota Credito</b></span>
                      <div class="box-tools pull-right">

                      </div>
                    </div>
                    <div class="modal-body">
                      <form action="expensa&<?php echo $id; ?>.jsp" method="POST" name="formnotacredito" enctype="multipart/form-data">
                        <div id="divnotacredito">

                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ANULAR FACTURAS  -->

              <?php
              if (isset($_POST['anula_fac'])) {

                $id = $_POST['id_expensa_curaduria'];

                $updateSQL256 = sprintf(
                  "UPDATE expensa_fac SET 
                  anu_fac=%s,  
                  id_expensa_curaduria=%s,
                  anular_expensa=%s

                  where id_expensa_fac=%s",
                  GetSQLValueString(1, "int"),
                  GetSQLValueString($_POST["id_expensa_curaduria"], "int"),
                  GetSQLValueString($_POST["anular_expensa"], "text"),
                  GetSQLValueString($_POST["id_expensa_fac"], "int")
                );
                $Result256 = mysql_query($updateSQL256, $conexion) or die(mysql_error());

                echo $anulada;

                echo '<meta http-equiv="refresh" content="0;URL=./expensa&' . $id . '.jsp" />';
              } else {
              }
              ?>
              <div class="modal fade" id="popupanular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <span style="font-size: 20px; float: right; margin-right: 30px;"><b>ANULAR FACTURA</b></span>
                      <div class="box-tools pull-right">

                      </div>
                    </div>
                    <div id="nuevaAventura22" class="modal-body">
                      <form action="expensa&<?php echo $id; ?>.jsp" method="POST" name="form2">
                        <div id="divanular">

                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- FIN ANULAR FACTURAS -->

            </div><!-- body -->
          </div><!-- box -->
        </div><!-- col-md-12 GENERAL -->

        <div class="col-md-3">
          <div class="box">
            <div class="box-header with-border">
              <span><b>Procedimiento</b></span>
            </div>
            <div class="box-body">
              <p>Envio Informacion a SNR</p>
              <span>
                1. <b>Espacio Facturacion</b><br> Cargar Información de Faturación (Cargar archivo plano)<br>
                2. <b>Espacio Documento Anexo</b><br> Cargar Soporte(s) de Pago(s) datos del soporte <br>
                3. <b>Información de Gastos</b> <br> Cargar Informe Estadistico <br>
              </span> <br>
            </div>
          </div>
        </div>


        <?php if (1 == $_SESSION['rol'] or 0 < $nump) { ?>
          <div class="col-md-3">
            <div class="box">
              <div class="box-header with-border">
                <span style="color: #B00B29;"><b>Correción</b></span>
                <div class="text-right">
                  <?php
                  if (0 <= $estado or 1 == $_SESSION['rol'] or 0 < $nump or 0 < $nump22) {
                    echo '<a class="ventana1" data-toggle="modal" data-target="#pop_correcciones" title="Corrección"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
                  } else {
                  }
                  ?>
                </div>
              </div>
              <div class="box-body">
                <div style="border solid 1px red">
                  <?php
                  // $valid=$row['id_expensa_correccion'];
                  $actualizar56 = mysql_query("SELECT * FROM expensa_correccion where id_expensa_curaduria='$id' and estado_expensa_correccion=1 order by id_expensa_correccion", $conexion) or die(mysql_error());
                  $row156 = mysql_fetch_assoc($actualizar56);
                  $total556 = mysql_num_rows($actualizar56);
                  if (0 < $total556) {
                    do {
                      echo $row156['id_expensa_tipo_file'] . '<br>';
                      echo '$ ' . number_format((float) $row156["valor_soporte"], 2, ",", ".") . '&nbsp;';
                      echo '<a href="files/expensa_curadurias/' . $row156['url_expensa_correccion'] . '" target="_blank"><img src="images/pdf.png"> ' . $row156['nombre_expensa_correccion'] . '</a>';
                      echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="expensa_correccion" id="' . $row156['id_expensa_correccion'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

                      echo '<br>' . $row156['concepto_correccion'] . '';
                      echo '<hr>';
                    } while ($row156 = mysql_fetch_assoc($actualizar56));
                    mysql_free_result($actualizar56);
                  } else {
                  }

                  ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>



        <div class="col-md-3">
          <div class="box">
            <div class="box-header with-border">
              <b> Documento anexo <span style="color:#ff0000; font-size:11px;"> Solo Adjuntar Soporte de Pago</span></b>
              <div class="text-right">
                <?php
                if (0 == $estado or 1 == $_SESSION['rol'] or 0 < $AprobarFinanciero) {
                  echo '<a class="ventana1" data-toggle="modal" data-target="#popupnewdocumento" href="" title="Añadir documentos"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>';
                } else {
                }
                ?>
              </div>
            </div>
            <div class="box-body">
              <div style="border solid 1px red">
                <?php
                // $valid=$row['id_expensa_documento'];
                $actualizar56 = mysql_query("SELECT * FROM expensa_documento, expensa_tipo_file where expensa_documento.id_expensa_tipo_file=expensa_tipo_file.id_expensa_tipo_file and id_expensa_curaduria='$id' and estado_expensa_documento=1 order by id_expensa_documento", $conexion) or die(mysql_error());
                $row156 = mysql_fetch_assoc($actualizar56);
                $total556 = mysql_num_rows($actualizar56);
                if (0 < $total556) {
                  do {
                    if (1 == $estado or 2 == $estado) {
                      echo '<b>' . $row156['nombre_expensa_tipo_file'] . '</b><br>';
                      echo 'Valor Consignación:  $ ' . number_format((float) $row156["valor_soporte"], 2, ",", ".") . '<br>';
                      echo 'Fecha Consignación: ' . $row156["fecha_soporte"] . '<br>';
                      echo '<a href="files/expensa_curadurias/' . $row156['url_expensa_documento'] . '" target="_blank"><img src="images/pdf.png"> ' . $row156['nombre_expensa_documento'] . '</a><hr>';
                    } // if del estado
                    if (0 == $estado) {
                      echo '<b>' . $row156['nombre_expensa_tipo_file'] . '</b><br>';
                      echo 'Valor Consignación:  $ ' . number_format((float) $row156["valor_soporte"], 2, ",", ".") . '<br>';
                      echo 'Fecha Consignación: ' . $row156["fecha_soporte"] . '<br>';
                      echo '<a href="files/expensa_curadurias/' . $row156['url_expensa_documento'] . '" target="_blank"><img src="images/pdf.png"> ' . $row156['nombre_expensa_documento'] . '</a>';
                      echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="expensa_documento" id="' . $row156['id_expensa_documento'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a><hr>';
                    } else {
                    }

                    if (0 < $AprobarFinanciero or 1 == $_SESSION['rol']) { ?>
                      <div style="padding: 2px; text-align: center; margin: 5px 0px; background:orange; border-radius:5px;"><b style="color:white;">Editar Soporte</b></div>
                      <form name="editarsoporte" method="post">

                        <div class="row">
                          <label class="col-sm-5 col-form-label">Seleccionar</label>
                          <div class="col-sm-7">
                            <input type="hidden" name="id_expensa_documento" value="<?php echo $row156["id_expensa_documento"]; ?>">
                            <input type="checkbox" class="form-check-input" name="llenosoporte">
                          </div>
                        </div>

                        <div class="row">
                          <label class="col-sm-5 col-form-label">Valor Consignación</label>
                          <div class="col-sm-7">
                            <input type="number" step="any" style="width:90%;" name="valor_soporte" value="<?php echo $row156["valor_soporte"]; ?>">
                          </div>
                        </div>

                        <div class="row">
                          <label class="col-sm-5 col-form-label">Fecha Consignación</label>
                          <div class="col-sm-7">
                            <input type="date" style="width:90%;" name="fecha_soporte" value="<?php echo $row156["fecha_soporte"]; ?>">
                          </div>
                        </div>

                        <div class="row">
                          <label class="col-sm-9 col-form-label"></label>
                          <div class="col-sm-3">
                            <input type="submit" name="editasoporteg" class="btn btn-xs btn-success" value="Actualizar">
                          </div>
                        </div>

                      </form>
                      <hr>

                <?php } // SEGURIDAD PERFIL FINANCIERO

                  } while ($row156 = mysql_fetch_assoc($actualizar56));
                  mysql_free_result($actualizar56);
                } else {
                }


                // TOTALIZADO DEL SOPORTE DE PAGO
                $querytotal = mysql_query("SELECT valor_soporte FROM expensa_documento where id_expensa_curaduria='$id' and estado_expensa_documento=1", $conexion) or die(mysql_error());
                $rowtotal = mysql_fetch_assoc($querytotal);
                $totalSoporte = $rowtotal['valor_soporte']; // total declarado antes del bucle
                while ($rowtotal = mysql_fetch_array($querytotal)) {
                  $totalSoporte = $totalSoporte + $rowtotal['valor_soporte']; // Sumar variable $total + resultado de la consulta
                }

                echo '<b style="color:green;">Total Soporte(s):</b> $ ' . number_format((float) $totalSoporte, 2, ",", ".") . '<br>'; // Se imprime $total y se realiza la suma
                echo '<b style="color:red;">Total Tarifa 5%:</b> &nbsp;&nbsp; $ ' . number_format((float) $mostartarifa, 2, ",", ".");

                ?>
              </div>
            </div>
          </div>




        </div><!-- FIN col-md-3 -->


        <?php if (0 < $AprobarCuradurias or 0 < $AprobarFinanciero or 1 == $_SESSION['rol']) { ?>
          <div class="col-md-3">
            <div class="box">
              <div class="box-header with-border">
                <b>Auditoria</b>
              </div>
              <div class="box-body">

                <form method="POST" name="form_auditoria">

                  <div class="form-group">
                    <label>Selección auditoria</label>
                    <select name="id_expensa_tipos_auditoria" class="form-control" required>
                      <?php
                      echo '<option value="">--- Seleccion ---</option>';
                      $querySele = mysql_query("SELECT * FROM expensa_tipos_auditoria WHERE estado_expensa_tipos_auditoria=1 ORDER BY nombre_expensa_tipos_auditoria ASC", $conexion) or die(mysql_error());
                      while ($rowSele = mysql_fetch_array($querySele)) {
                        echo '<option value="' . $rowSele['id_expensa_tipos_auditoria'] . '">' . $rowSele['nombre_expensa_tipos_auditoria'] . '</option>';
                        //echo $rowSele['nombre_expensa_tipos_auditoria']; // Sumar variable $total + resultado de la consulta
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Descripción Observación</label>
                    <textarea name="observacion_expensa_auditoria" class="form-control" required></textarea>
                  </div>

                  <button type="submit" class="btn btn-success btn-xs" name="formaudita" value="1">Guardar</button>

                </form>

                <label style="margin:10px auto;">Historico de Observaciones</label>
                <div class="row" style="height:150px; margin:5px; overflow-y: scroll; border: solid 1px #ccc;">
                  <?php
                  $querySele = mysql_query("SELECT * FROM expensa_tipos_auditoria, expensa_auditoria, expensa_curaduria  WHERE 
                expensa_tipos_auditoria.id_expensa_tipos_auditoria=expensa_auditoria.id_expensa_tipos_auditoria AND
                expensa_auditoria.id_expensa_curaduria=expensa_curaduria.id_expensa_curaduria AND
                expensa_curaduria.id_expensa_curaduria=" . $id . " AND 
                estado_expensa_tipos_auditoria=1 ORDER BY fecha_ahora ASC", $conexion) or die(mysql_error());
                  while ($rowSele = mysql_fetch_array($querySele)) {
                    echo
                      '
                        <div style="border: solid 1px #ccc; padding:5px;">
                          <p><b>Fecha:</b> ' . $rowSele['fecha_ahora'] . '<br>
                          <b>Tipificación:</b> ' . $rowSele['nombre_expensa_tipos_auditoria'] . '<br>
                          <b>Observación:</b> ' . $rowSele['observacion_expensa_auditoria'] . '</p><br>
                        </div>
                      ';
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>


        <div class="col-md-3">
          <div class="box">
            <div class="box-header with-border">
              <b>Autorización</b>
            </div>
            <div class="box-body">

              <?php


              if (1 == $row14['expensa_cerrada'] or 1 == $_SESSION['rol']) {
                if (0 < $AprobarFinanciero and NULL != $mostartarifa or 1 == $_SESSION['rol']) {
                  if (0 == $row14['vigilancia_financiera']) {
              ?>
                    <div class="row">
                      <div class="col-md-10"><b>Perfil Financiero</b> (Pago de tarifa)</div>
                      <div class="col-md-2">
                        <form method="POST" name="formautorizafinanciera">
                          <?php if (0 < $AprobarCuradurias or 0 < $AprobarFinanciero or 1 == $_SESSION['rol']) { ?>
                            <input type="submit" class="btn btn-xs btn-success" style="float:right;" name="autorizafinanciera" value="Autoriza">
                          <?php } else {
                          } ?>
                        </form>
                      </div>
                    </div>
                    <hr>
                <?php
                  }
                }
                ?>

                <?php
                if (0 < $AprobarCuradurias or 1 == $_SESSION['rol']) {
                  if (0 == $row14['vigilancia_curaduria']) {
                ?>
                    <div class="row">
                      <div class="col-md-10"><b>Perfil Curadurias</b> (Entrega de Informe Estadistico)</div>
                      <div class="col-md-2">
                        <form method="POST" name="formautorizacuraduria">
                          <?php if (0 < $AprobarCuradurias or 0 < $AprobarFinanciero or 1 == $_SESSION['rol']) { ?>
                            <input type="submit" class="btn btn-xs btn-success" style="float:right;" name="autorizacuraduria" value="Autoriza">
                          <?php } else {
                          } ?>
                        </form>
                      </div>
                    </div>
                    <hr>
                  <?php
                  }
                }
              }



              if (
                NULL != $mostartarifa and
                1 == $editar_gp and
                1 == $editar_gg and
                1 == $editar_gi and
                1 == $editar_gt and
                1 == $editar_giva and
                0 != $totalSoporte
              ) {

                if (0 == $row14['expensa_cerrada']) { ?>
                  <form method="POST" name="formenviainfo">
                    <input type="submit" class="btn btn-xs btn-success" style="float:right;" name="enviainfo" value="Enviar Información" onclick="return confirm('Esta Seguro (Enviar Información)');"><br>
                  </form>

                <?php } elseif (1 == $row14['expensa_cerrada']) { ?>

                <?php } elseif (2 == $row14['expensa_cerrada']) { ?>

                  <a href="pdf/expensa&<?php echo $id;  ?>.pdf" class="btn btn-xs btn-success" style="width:100%;"><img src="images/pdf.png"> Cerrada </a>

              <?php }
              }
              ?>

            </div>
          </div>
        </div>


        <div class="col-md-3">
          <div class="box">
            <?php
            if (1 == $_SESSION['rol'] OR 0 < $AprobarFinanciero OR 0 < $AprobarCuradurias) { ?>
                  <div class="box-header with-border">
                    <b>Devolución</b><br>
                    <span style="color:red; text-align: center;">Devolución de Dinero por pago de lo no devido o exceso.</span>
                    <div class="box-body">
                      <form action="" method="POST" name="formdevolucion2324">
                        <input type="number" class="form-control" name="valor_devolucion" placeholder="Valor Devolución"><br>
                        <input type="submit" class="btn btn-success btn-sm" name="enviar_devolucion" value="Guardar"/>
                      </form>
                    </div>
                  </div>
            <?php
            }
            if (1 == $_SESSION['rol'] OR 0 < $AprobarFinanciero OR 0 < $AprobarCuradurias) {
              $estadodevolucion = '';
            }else{
              $estadodevolucion = 'AND estado=1';
            }
            echo '<span style="margin:10px;"><b>Anexos Devolución</b></span><br>';
            $consultaDoc = mysql_query("SELECT 
              ulr_expensa_devolucion,
              nombre_expensa_devolucion,
              valor_devolucion,
              fecha_devolucion, 
              estado
             FROM expensa_devolucion
             WHERE id_expensa_curaduria='$id'
             AND estado_expensa_devolucion=1 $estadodevolucion", $conexion) or die(mysql_error());
            $rowDocumentos = mysql_fetch_assoc($consultaDoc);
            $resultDocumentos = mysql_num_rows($consultaDoc);
            if (0 < $resultDocumentos) {
              do {
                if (0 == $rowDocumentos['estado']) {
                  echo '<div style="padding:5px 10px;"><span style="margin:10px; color: orange;"> Solicitud $' . $rowDocumentos["valor_devolucion"] . ' | ' . $rowDocumentos['fecha_devolucion'] . '| Tramite</span></div>';
                } elseif (2 == $rowDocumentos['estado']) {
                  echo '<div style="padding:5px 10px;"><span style="margin:10px; color: red;"> Solicitud $' . $rowDocumentos["valor_devolucion"] . ' | ' . $rowDocumentos['fecha_devolucion'] . ' | Rechazada</span></div>';
                } else {
                  if (isset($rowDocumentos['ulr_expensa_devolucion']) and isset($rowDocumentos['nombre_expensa_devolucion'])) {
                    echo '<div style="padding:5px 10px;">
                            <a href="files/expensa_curadurias/' . $rowDocumentos['ulr_expensa_devolucion'] . '" target="_blank" title="' . $rowDocumentos['nombre_expensa_devolucion'] . '"><img src="images/pdf.png"> Devolución $' . $rowDocumentos['valor_devolucion'] . ' | ' . $rowDocumentos['fecha_devolucion'] . ' | <span style="color:green;">Aprobada</span></a>
                          </div>';
                  }
                }
              } while ($rowDocumentos = mysql_fetch_assoc($consultaDoc));
              mysql_free_result($consultaDoc);
            }
            ?>

          </div>
        </div>


        <script>
          $(document).ready(function() {
            $(".numbermoneda").on({
              "focus": function(event) {
                $(event.target).select();
              },
              "keyup": function(event) {
                $(event.target).val(function(index, value) {
                  return value.replace(/\D/g, "")
                    // .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
              }
            });
          });
        </script>




        <!-- FIN DE CODIGO DE VISTA EMPIEZA EL MODAL -->

      </div><!-- Cierre del Row Prom-->



<?php } else {
      echo '.';
    }
  } else {
  }
} else {
  echo '';
}
?>
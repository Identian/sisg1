<?php
if (isset($_GET['i']) && "" != $_GET['i']) {
  $id = $_GET['i'];



  $nump103 = privilegios(103, $_SESSION['snr']);
  $nump51 = privilegios(51, $_SESSION['snr']);
  $nump52 = privilegios(52, $_SESSION['snr']);
  $nump53 = privilegios(53, $_SESSION['snr']);




  if (isset($_POST['id_municipio_orip']) && "" != $_POST['id_municipio_orip']) {
    $infomun = explode("-", $_POST['id_municipio_orip']);
    $dep = $infomun[0];
    $mun = $infomun[1];
    $insertSQL = sprintf(
      "INSERT INTO municipio_orip (
        id_oficina_registro, id_departamento, codigo_municipio, 
        estado_municipio_orip) VALUES (%s,%s, %s, %s)",
      GetSQLValueString($id, "int"),
      GetSQLValueString($dep, "int"),
      GetSQLValueString($mun, "int"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);
    echo $insertado;
    mysql_free_result($Result);
  }




  if ((isset($_POST["direccion_oficina_registro"])) && ($_POST["direccion_oficina_registro"] != "")) {
    $updateSQL = sprintf(
      "UPDATE oficina_registro SET 
      circulo=%s, id_oficina_registro_sismisional=%s, iris=%s, id_region=%s, direccion_oficina_registro=%s, barrio_oficina_registro=%s, telefono_oficina_registro=%s, 
      fax_oficina_registro=%s, correo_oficina_registro=%s, agendamiento=%s, tipo_oficina_orip=%s, id_tipo_acto=%s, numero_acto_orip=%s, horario_oficina_registro=%s, 
      latitud=%s, longitud=%s where id_oficina_registro=%s",
      GetSQLValueString($_POST["circulo"], "text"),
      GetSQLValueString($_POST["id_oficina_registro_sismisional"], "int"),
      GetSQLValueString($_POST["iris"], "int"),
      GetSQLValueString($_POST["id_region"], "int"),
      GetSQLValueString($_POST["direccion_oficina_registro"], "text"),
      GetSQLValueString($_POST["barrio_oficina_registro"], "text"),
      GetSQLValueString($_POST["telefono_oficina_registro"], "text"),
      GetSQLValueString($_POST["fax_oficina_registro"], "text"),
      GetSQLValueString($_POST["correo_oficina_registro"], "text"),
      GetSQLValueString($_POST["agendamiento"], "int"),
      GetSQLValueString($_POST["tipo_oficina_orip"], "text"),
      GetSQLValueString($_POST["id_tipo_acto"], "int"),
      GetSQLValueString($_POST["numero_acto_orip"], "int"),
      GetSQLValueString($_POST["horario_oficina_registro"], "text"),
      GetSQLValueString($_POST["latitud"], "text"),
      GetSQLValueString($_POST["longitud"], "text"),
      GetSQLValueString($id, "int")
    );
    $Result = mysql_query($updateSQL, $conexion);

    echo $actualizado;
  }


  if (isset($_POST['personal']) && isset($_POST['insumos']) && isset($_POST['otros'])) {

    if (isset($_FILES['filet']['name']) && "" != $_FILES['filet']['name']) {

      $tamano_archivo = 11534336;
      //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
      $formato_archivo = array('pdf');

      $directoryftp3 = "filesnr/reactivacion_orip/";

      $ruta_archivo = 'orip-' . $_SESSION['snr'] . '-' . date("YmdGis");

      $archivo = $_FILES['filet']['tmp_name'];
      $tam_archivo = filesize($archivo);
      $tam_archivo2 = $_FILES['filet']['size'];
      $nombrefile = strtolower($_FILES['filet']['name']);
      //echo '<script>alert("'.$nombrefile.'");</script>';
      $info = pathinfo($nombrefile);

      $extension = $info['extension'];

      $array_archivo = explode('.', $nombrefile);
      $extension2 = end($array_archivo);

      //echo $tam_archivo;
      //echo $tam_archivo2;



      if ($tamano_archivo >= intval($tam_archivo2)) {

        if (($extension2 == $extension)) {
          $files = $ruta_archivo . '.' . $extension;
          $mover_archivos = move_uploaded_file($archivo, $directoryftp3 . $files);
          //chmod($files,0777);
          $nombrebre_orig = ucwords($nombrefile);
        } else {
          $files = '';
          echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
        }
      } else {
        $files = '';
        echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
      }
    } else {
      $files = '';
    }




    $otrosv = '';
    if (isset($_POST['tecnologia'])) {
      $otrosv .= '. Copiado por correo a Tecnologia, ';
    } else {
    }

    if (isset($_POST['infraestructura'])) {
      $otrosv .= '. Copiado por correo a Infraestructura, ';
    } else {
    }

    if (isset($_POST['capacitacion'])) {
      $otrosv .= '. Copiado por correo a Capacitación, ';
    } else {
    }

    if (isset($_POST['ente_territorial'])) {
      $otrosv .= '. Copiado por correo a la Regional. ';
    } else {
    }

    $otros = $_POST["obs_otros"] . $otrosv;

    $insertSQL = sprintf(
      "INSERT INTO reactivacion_orip (
        id_oficina_registro, 
        fecha_reactivacion_orip, 
        personal, 
        obs_personal, 
        mail_personal, 
        insumos, 
        obs_insumos, 
        mail_insumos, 
        otros, 
        obs_otros, 
        mail_otros, 
        soporte, 
        estado_reactivacion_orip) VALUES (%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
      GetSQLValueString($id, "int"),
      GetSQLValueString($_POST["personal"], "text"),
      GetSQLValueString($_POST["obs_personal"], "text"),
      GetSQLValueString($_POST["mail_personal"], "text"),
      GetSQLValueString($_POST["insumos"], "text"),
      GetSQLValueString($_POST["obs_insumos"], "text"),
      GetSQLValueString($_POST["mail_insumos"], "text"),
      GetSQLValueString($_POST["otros"], "text"),
      GetSQLValueString($otros, "text"),
      GetSQLValueString($_POST["mail_otros"], "text"),
      GetSQLValueString($files, "text"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);
    echo $insertado;
    mysql_free_result($Result);




    if ('No' == $_POST["personal"]) {
      $emailune = 'mauricio.rivera@supernotariado.gov.co';
      $subject = 'Reactivación de ORIPS';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de personal para la reactivación de una ORIP";
      $cuerpo .= "<br><br>";
      $cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <a href="https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp">https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp</a><br>';
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      mail($emailune, $subject, $cuerpo, $cabeceras);
    } else {
    }



    if (1 == $_POST['regional']) {
      $emailun = 'jhon.jaimes@supernotariado.gov.co,diana.losada@supernotariado.gov.co';
    } else if (2 == $_POST['regional']) {
      $emailun = 'carlos.orozco@supernotariado.gov.co,oscar.serna@supernotariado.gov.co';
    } else if (3 == $_POST['regional']) {
      $emailun = 'marly.estrada@supernotariado.gov.co,milagro.villalobos@supernotariado.gov.co';
    } else if (4 == $_POST['regional']) {
      $emailun = 'diego.salazar@supernotariado.gov.co,jair.corcino@supernotariado.gov.co';
    } else if (5 == $_POST['regional']) {
      $emailun = 'nelson.penuela@supernotariado.gov.co,edgar.bahamon@supernotariado.gov.co';
    } else {
      $emailun = 'giovanni.ortegon@supernotariado.gov.co';
    }

    if ('No' == $_POST["insumos"]) {
      $subject = 'Reactivación de ORIPS';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad para la reactivación de una ORIP";
      $cuerpo .= "<br>";
      $cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp">https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp</a><br>';
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      mail($emailun, $subject, $cuerpo, $cabeceras);
    } else {
    }



    if (isset($_POST['tecnologia'])) {
      $emailu1 = 'wilson.barrios@supernotariado.gov.co';
      $subject = 'Reactivación de ORIPS';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de tecnologia para la reactivación de una ORIP";
      $cuerpo .= "<br>";
      $cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp">https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp</a><br>';
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      mail($emailu1, $subject, $cuerpo, $cabeceras);
    } else {
    }

    if (isset($_POST['infraestructura'])) {
      $emailu2 = 'sandra.ruiz@supernotariado.gov.co';
      $subject = 'Reactivación de ORIPS';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de infraestructura para la reactivación de una ORIP";
      $cuerpo .= "<br>";
      $cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp">https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp</a><br>';
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      mail($emailu2, $subject, $cuerpo, $cabeceras);
    } else {
    }

    if (isset($_POST['capacitacion'])) {
      $emailu3 = 'beatrizh.galindo@supernotariado.gov.co';
      $subject = 'Reactivación de ORIPS';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de capacitación para la reactivación de una ORIP";
      $cuerpo .= "<br>";
      $cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp">https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp</a><br>';
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      mail($emailu3, $subject, $cuerpo, $cabeceras);
    } else {
    }


    if (isset($_POST['ente_territorial'])) {
      $emailu4 = $emailun;
      $subject = 'Reactivación de ORIPS';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "Vicky te informa que se ha realizado una consulta y necesidad de ente territorial para la reactivación de una ORIP";
      $cuerpo .= "<br>";
      $cuerpo .= '<br>Puede ver la consulta en la siguiente URL, opción reactivación oficina: <br><a href="https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp">https://sisg.supernotariado.gov.co/orip&' . $id . '.jsp</a><br>';
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      mail($emailu4, $subject, $cuerpo, $cabeceras);
    } else {
    }
  } else {
  }

  $query_update = sprintf("SELECT * FROM oficina_registro WHERE oficina_registro.id_oficina_registro = %s", GetSQLValueString($id, "int"));
  $update = mysql_query($query_update, $conexion) or die(mysql_error());
  $row_update = mysql_fetch_assoc($update);
  $totalRows_update = mysql_num_rows($update);
  if (0 < $totalRows_update) {
    mysql_free_result($update);
?>


    <?php
    if (1 == $_SESSION['rol'] or 0 < $nump103) {
    ?>

      <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Actualizar ORIP</b></h4>
            </div>
            <div id="nuevaAventura" class="modal-body">

              <form action="" method="POST" name="form1">
                <div class="form-group text-left">
                  <label class="control-label">DIRECCION DE LA ORIP:</label>
                  <input type="text" class="form-control" name="direccion_oficina_registro" value="<?php echo $row_update['direccion_oficina_registro']; ?>">
                </div>
                <div class="form-group text-left">
                  <label class="control-label">BARRIO DE LA ORIP:</label>
                  <input type="text" class="form-control" name="barrio_oficina_registro" value="<?php echo $row_update['barrio_oficina_registro']; ?>">
                </div>
                <div class="form-group text-left">
                  <label class="control-label">TELEFONO DE LA ORIP:</label>
                  <input type="text" class="form-control" name="telefono_oficina_registro" value="<?php echo $row_update['telefono_oficina_registro']; ?>">
                </div>
                <div class="form-group text-left">
                  <label class="control-label">EMAIL DE LA ORIP:</label>
                  <input type="text" class="form-control" name="correo_oficina_registro" value="<?php echo $row_update['correo_oficina_registro']; ?>">
                </div>
                <div class="form-group text-left">
                  <label class="control-label">REGIONAL:</label>
                  <select class="form-control" name="id_region" required>
                    <option value="1" <?php if (1 == $row_update['id_region']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>Región Central</option>
                    <option value="2" <?php if (2 == $row_update['id_region']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>Región Andina</option>
                    <option value="3" <?php if (3 == $row_update['id_region']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>Región Caribe</option>
                    <option value="4" <?php if (4 == $row_update['id_region']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>Región Pacifica</option>
                    <option value="5" <?php if (5 == $row_update['id_region']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>Región Orinoquia</option>
                  </select>
                </div>

                <div class="form-group text-left">
                  <label class="control-label"> CIRCULO REGISTRAL:</label>
                  <input type="text" class="form-control" name="circulo" value="<?php echo $row_update['circulo']; ?>">
                </div>

                <div class="form-group text-left">
                  <label class="control-label"> TIPO DE OFICINA:</label>
                  <Select class="form-control" name="tipo_oficina_orip">
                    <option></option>
                    <option value="Principal" <?php if ('Principal' == $row_update['tipo_oficina_orip']) {
                                                echo 'selected';
                                              } else {
                                              } ?>>Principal</option>
                    <option value="Seccional" <?php if ('Seccional' == $row_update['tipo_oficina_orip']) {
                                                echo 'selected';
                                              } else {
                                              } ?>>Seccional</option>
                  </select>
                </div>

                <div class="form-group text-left">
                  <label class="control-label"> ACTO ADMINISTRATTIVO DE CREACIÓN:</label>
                  <select type="text" class="form-control" name="id_tipo_acto">
                    <option></option>
                    <option value="1" <?php if (1 == $row_update['id_tipo_acto']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>Decreto</option>
                    <option value="2" <?php if (2 == $row_update['id_tipo_acto']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>Resolución</option>
                  </select>
                </div>

                <div class="form-group text-left">
                  <label class="control-label"> NÚMERO DEL ACTO ADMINISTRATIVOS:</label>
                  <input type="text" class="form-control numero" name="numero_acto_orip" value="<?php echo $row_update['numero_acto_orip']; ?>">
                </div>



                <div class="form-group text-left">
                  <label class="control-label">SISTEMA MISIONAL:</label>
                  <select class="form-control" name="id_oficina_registro_sismisional" required>
                    <option value="1" <?php if (1 == $row_update['id_oficina_registro_sismisional']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>FOLIO</option>
                    <option value="2" <?php if (2 == $row_update['id_oficina_registro_sismisional']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>SIR</option>
                  </select>
                </div>

                <div class="form-group text-left">
                  <label class="control-label">Con SGD - IRIS:</label>
                  <select class="form-control" name="iris" required>
                    <option value="1" <?php if (1 == $row_update['iris']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>Si</option>
                    <option value="0" <?php if (0 == $row_update['iris']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>No</option>
                  </select>
                </div>


                <div class="form-group text-left">
                  <label class="control-label">Con Agendamiento en ventanilla:</label>
                  <select class="form-control" name="agendamiento" required>
                    <option value="1" <?php if (1 == $row_update['agendamiento']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>Si</option>
                    <option value="0" <?php if (0 == $row_update['agendamiento']) {
                                        echo 'selected';
                                      } else {
                                      } ?>>No</option>
                  </select>
                </div>


                <div class="form-group text-left">
                  <label class="control-label">HORARIO:</label>
                  <input type="text" class="form-control" name="horario_oficina_registro" value="<?php echo $row_update['horario_oficina_registro']; ?>">
                </div>
                <div class="form-group text-left">
                  <label class="control-label">LATITUD:</label>
                  <input type="text" class="form-control" name="latitud" value="<?php echo $row_update['latitud']; ?>">
                </div>
                <div class="form-group text-left">
                  <label class="control-label">LONGITUD:</label>
                  <input type="text" class="form-control" name="longitud" value="<?php echo $row_update['longitud']; ?>">
                </div>

                <div class="modal-footer">
                  <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                    <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                  <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span> Actualizar</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

    <?php
    } else {
    }


    ?>


    <div class="modal fade" id="actualizarsituacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Situación administrativa</h4>
          </div>
          <div class="modal-body" id="resultadoposesion">


          </div>
        </div>
      </div>
    </div>









    <div class="modal fade" id="updatesituacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Situación administrativa</h4>
          </div>
          <div class="modal-body" id="resultadoactposesion">


          </div>
        </div>
      </div>
    </div>





    <div class="modal fade" id="resultadopermisolicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Detalles del permiso o licencia</h4>
          </div>
          <div class="modal-body" id="resultadopermiso">


          </div>
        </div>
      </div>
    </div>




    <?php if ((1 == $_SESSION['rol']) or 0 < $nump103) {  ?>

      <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva situación</h4>
            </div>
            <div class="modal-body">

              <form action="" method="POST" name="form1" onsubmit="return validate();">
                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> USUARIO:</label>
                  <select class="form-control" name="id_funcionario" required>
                    <option selected></option>
                    <?php
                    $query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_tipo_oficina=3 and id_rol=3 and id_cargo=1 and estado_funcionario=1 order by nombre_funcionario");
                    $select = mysql_query($query, $conexion) or die(mysql_error());
                    $row = mysql_fetch_assoc($select);
                    $totalRows = mysql_num_rows($select);
                    if (0 < $totalRows) {
                      do {
                        echo '<option value="' . $row['id_funcionario'] . '">' . $row['nombre_funcionario'] . '</option>';
                      } while ($row = mysql_fetch_assoc($select));
                    } else {
                    }
                    mysql_free_result($select);
                    ?>
                  </select>
                </div>
                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> ACTO DE NOMBRAMIENTO:</label>

                  <select class="form-control" name="acto_nombramiento" required>
                    <option value="" selected></option>
                    <option value="Decreto">Decreto</option>
                    <option value="Resolucion">Resolucion</option>
                  </select>
                </div>


                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> NÚMERO:</label>
                  <input type="text" required class="form-control" name="numero_nombramiento">
                </div>


                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE NOMBRAMIENTO:</label>
                  <select class="form-control" name="id_tipo_nombramiento_n" required>
                    <option value="" selected></option>
                    <?php echo lista('tipo_nombramiento_n'); ?>
                  </select>
                </div>
                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DE INICIO:</label>
                  <input type="text" readonly="readonly" required class="form-control datepicker" name="fecha_inicio">
                </div>

                <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                  <button type="submit" class="btn btn-success"><input type="hidden" name="table" value="posesion_oficina_registro">
                    <span class="glyphicon glyphicon-ok"></span> Crear </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>



    <?php } else {
    } ?>







    <div class="row">
      <div class="col-md-4">


        <div class="box box-primary">
          <div class="box-body box-profile">

            <div class="box-tools">
              <?php
              if (1 == $_SESSION['rol'] or (0 < $nump103)) { ?>
                &nbsp; <a href="" data-toggle="modal" data-target="#popup">
                  <button type="button" class="btn btn-warning btn-xs">Actualizar</button>
                </a>
              <?php } else {
              } ?>
            </div>



            <p class="text-muted text-center">Oficina de Registro de Intrumentos Publicos</p>
            <h3 class="profile-username text-center"><?php echo $row_update['nombre_oficina_registro']; ?></h3>

            <p class="text-muted text-center"><?php echo quees('departamento', $row_update['id_departamento']); ?> / <?php echo nombre_municipio($row_update['codigo_municipio'], $row_update['id_departamento']); ?></p>

            <!-- <p class="text-muted text-center">DANE: <?php echo $row_update['codigo_dane']; ?></p> -->

            <ul class="list-group list-group-unbordered">
              <!-- <li class="list-group-item">
                  <b>Categoria:</b> <?php echo $row_update['id_categoria_oficina_registro']; ?>
                </li> -->
              <li class="list-group-item">
                <b>Teléfono:</b> <?php echo $row_update['telefono_oficina_registro']; ?>
              </li>

              <li class="list-group-item">
                <b>Fax:</b> <?php echo $row_update['fax_oficina_registro']; ?>
              </li>

              <li class="list-group-item">
                <b>Email:</b> <?php echo $row_update['correo_oficina_registro']; ?>
              </li>
              <li class="list-group-item">
                <b>Dirección:</b> <?php echo $row_update['direccion_oficina_registro']; ?>
              </li>
              <li class="list-group-item">
                <b>Barrio:</b> <?php echo $row_update['barrio_oficina_registro']; ?>
              </li>
              <li class="list-group-item">
                <b>Horario:</b> <?php echo $row_update['horario_oficina_registro']; ?>
              </li>

              <li class="list-group-item">
                <b>Codigo Municipal:</b>
                <?php echo $row_update['id_departamento'] . str_pad($row_update['id_municipio'], 3, "0", STR_PAD_LEFT); ?>
              </li>

              <li class="list-group-item">
                <b>Circulo Registral:</b>
                <?php echo $row_update['circulo']; ?>
              </li>

              <li class="list-group-item">
                <b>Regional:</b> <?php echo quees('region', $row_update['id_region']); ?>
              </li>

              <li class="list-group-item">
                <b>Tipo de oficina:</b> <?php echo $row_update['tipo_oficina_orip']; ?>
              </li>

              <li class="list-group-item">
                <b>Acto administrativo de creación:</b> <?php if (isset($row_update['id_tipo_acto'])) {
                                                          echo quees('tipo_acto', $row_update['id_tipo_acto']);
                                                        } else {
                                                        } ?>
              </li>

              <li class="list-group-item">
                <b>Número de acto de creación:</b> <?php echo $row_update['numero_acto_orip']; ?>
              </li>




              <li class="list-group-item">
                <b>Sistema Misional:</b> <?php echo quees('oficina_registro_sismisional', $row_update['id_oficina_registro_sismisional']); ?>
              </li>




              <li class="list-group-item">
                <b>Con sistema de gestión documental - Iris:</b> <?php if (1 == $row_update['iris']) {
                                                                    echo 'Si';
                                                                  } else {
                                                                    echo 'No';
                                                                  } ?>
              </li>





              <li class="list-group-item">
                <b>Con Agendamiento en ventanillas:</b> <?php if (1 == $row_update['agendamiento']) {
                                                          echo 'Si';
                                                        } else {
                                                          echo 'No';
                                                        } ?>
              </li>


              <li class="list-group-item">
                <b>Acto de creación:</b> <?php echo $row_update['acto_creacion']; ?>
              </li>

              <li class="list-group-item">
                <b>Número de acto:</b> <?php echo $row_update['numero_acto']; ?>
              </li>

              <li class="list-group-item">
                <b>Fecha del acto:</b> <?php echo $row_update['fecha_acto']; ?>
              </li>


              <li class="list-group-item">
                <b>Geolocalización:</b> <?php echo $row_update['latitud']; ?>, <?php echo $row_update['longitud']; ?>
              </li>

            </ul>



            <div id="mapid" style="width: 100%; min-height: 315px;border: 2px #333;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
            </div>
            <br>
            <b>COMPRENSIÓN REGISTRAL</b><BR><BR>
            <?php
            if (1 == $_SESSION['rol'] or 0 < $nump103) { ?>

              <form action="" method="POST" name="6546zam1">
                <select name="id_municipio_orip">
                  <option value="" selected></option>
                  <?php echo dep_mun(); ?>
                </select><br>
                <input type="Submit" value="Agregar">
              </form><br>

            <?php } else {
            }

            ?>


            <ul class="list-group list-group-unbordered">





              <?php

              $actualizar57ll = mysql_query("SELECT id_municipio_orip, nombre_municipio from municipio_orip, municipio where municipio_orip.id_departamento=municipio.id_departamento and municipio_orip.codigo_municipio=municipio.codigo_municipio and  id_oficina_registro=" . $id . "  and estado_municipio_orip=1 order by nombre_municipio", $conexion);
              $row157ll = mysql_fetch_assoc($actualizar57ll);
              $total557ll = mysql_num_rows($actualizar57ll);
              if (0 < $total557ll) {
                do {
                  echo '<li class="list-group-item">';
                  if (1 == $_SESSION['rol'] or 0 < $nump103) {
                    echo
                    '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="municipio_orip" id="' . $row157ll['id_municipio_orip'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
                  } else {
                  }
                  echo ' <b>Municipio:</b> ' . $row157ll['nombre_municipio'] . '
              </li>';
                } while ($row157ll = mysql_fetch_assoc($actualizar57ll));
                mysql_free_result($actualizar57ll);
              } else {
              }





              ?>



              <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
              <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>

              <script>
                var mymap = L.map('mapid').setView([<?php echo $row_update['latitud']; ?>, <?php echo $row_update['longitud']; ?>], 12); // toda colombia 6

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {


                  maxZoom: 18,
                  attribution: 'OpenStreetMap' +
                    '' +
                    '',
                  id: 'open.streets'
                }).addTo(mymap);


                L.marker([<?php echo $row_update['latitud']; ?>, <?php echo $row_update['longitud']; ?>]).addTo(mymap)
                  .bindPopup('<?php echo $row_update['nombre_notaria']; ?>');
              </script><br>




          </div>
          <!-- /.box-body -->

        </div>




      </div>
      <!-- /.col -->
      <div class="col-md-8">
        <div class="nav-tabs-custom">

          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Funcionario</a></li>
            <?php if (1 == $_SESSION['rol'] or 0 < $nump53) { ?>
              <li><a href="#encuesta" data-toggle="tab">Personal</a></li>
            <?php } ?>
            <li><a href="#settings" data-toggle="tab">Recaudo</a></li>
            <?php if (1 == $_SESSION['rol'] or 0 < $nump53) { ?>
              <li><a href="#control" data-toggle="tab">Reactivación</a></li>
              <li><a href="#suministros" data-toggle="tab">Suministros</a></li>
              <li><a href="#locativas" data-toggle="tab">Locativo</a></li>
              <li><a href="#tecnologia" data-toggle="tab">Tecnología</a></li>
            <?php } ?>
              <li><a href="#hvinmueble" data-toggle="tab">Hoja De Vida Bien Inmueble</a></li>
              <li><a href="#requerimientos" data-toggle="tab">Requerimientos</a></li>
          </ul>

          <div class="tab-content">
            <div class="active tab-pane" id="activity">

              <div class="post">
                <div class="user-block">
                  <div class="col-xs-12 table-responsive ">

                    <?php
                    $queryn = sprintf("SELECT nombre_grupo_area, foto_funcionario, funcionario.id_cargo, cedula_funcionario, remoto, nombre_funcionario, correo_funcionario, id_funcionario, nombre_cargo FROM funcionario, grupo_area, cargo 
					          where funcionario.id_grupo_area=grupo_area.id_grupo_area and funcionario.id_cargo=cargo.id_cargo and id_oficina_registro=" . $id . " and id_tipo_oficina=2 and estado_funcionario=1 order by funcionario.id_cargo desc");
                    $selectn = mysql_query($queryn, $conexion);
                    $rown = mysql_fetch_assoc($selectn);
                    ?>

                    <table class="table table-striped table-bordered table-hover" id="detallefun">
                      <thead>
                        <tr>
                          <th style="width:3px !important;"></th>
                          <th>Cedula</th>
                          <th>Nombre</th>
                          <th>Grupo</th>
                          <th>Correo</th>
                          <th>Cargo</th>
                          <th>Remoto</th>
                          <th></th>
                          <?php
                          $nump119 = privilegios(119, $_SESSION['snr']);
                          if (1 == $_SESSION['rol'] or 0 < $nump119) {
                            echo '<th>';

                            echo '</th>';
                          } else {
                          }
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        do {
                          echo '<tr>';
                          echo '<td style="width:3px !important;"><span style="font-size:3px;">' . $rown['id_cargo'] . '</span></td>';
                          echo '<td>' . $rown['cedula_funcionario'] . '</td>';
                          echo '<td>' . $rown['nombre_funcionario'] . '</td>';
                          echo '<td>' . $rown['nombre_grupo_area'] . '</td>';
                          echo '<td>' . $rown['correo_funcionario'] . '</td>';
                          echo '<td>' . $rown['nombre_cargo'] . '</td>';
                          echo '<td>';
                          if (1 == $rown['remoto']) {
                            echo 'Si';
                          } else {
                            echo 'No';
                          }
                          echo '</td>';
                          echo '<td><a href="usuario&' . $rown['id_funcionario'] . '.jsp"><span class="glyphicon glyphicon-user"></span></a>
						              </td>';


                          if (1 == $_SESSION['rol'] or 0 < $nump119) {
                            echo '<td>';
                            if ((isset($rown['foto_funcionario'])) && 'avatar.png' != $rown['foto_funcionario']) {
                              echo '<a href="files/' . $rown['foto_funcionario'] . '" target="_blank"><img src="files/' . $rown['foto_funcionario'] . '" style="width:30px;"></a>';
                            } else {
                            }
                            echo '</td>';
                          } else {
                          }

                          echo '</tr>';

                          if (1 == $rown['id_cargo']) {
                            $correo_registrador = $rown['correo_funcionario'];
                          } else {
                          }
                        } while ($rown = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);


                        ?>
                        <script>
                          $(document).ready(function() {
                            $('#detallefun').DataTable({
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
            </div>

            <?php if (1 == $_SESSION['rol'] or 0 < $nump53) { ?>
              <div class="tab-pane" id="encuesta">

                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">
                      <?php

                      if (isset($_POST['p1']) and "" != $_POST['p1']) {

                        $varen1 = intval($_POST['p1']);
                        $varen2 = intval($_POST['p2']);
                        $varen3 = intval($_POST['p3']);
                        $varen4 = intval($_POST['p4']);
                        $varen5 = intval($_POST['p5']);
                        $varen6 = intval($_POST['p6']);
                        $varen7 = intval($_POST['p7']);
                        $varen8 = intval($_POST['p8']);
                        $varen9 = intval($_POST['p9']);
                        $varen10 = intval($_POST['p10']);
                        $varen11 = intval($_POST['p11']);
                        $varen12 = intval($_POST['p12']);
                        $varen13 = intval($_POST['p13']);
                        $varen14 = $_POST['p14'];
                        $varen15 = $_POST['p15'];
                        $varen16 = $_POST['p16'];
                        $varen17 = $_POST['p17'];
                        $varen18 = $_POST['p18'];
                        $varen19 = $_POST['p19'];
                        $varen20 = $_POST['p20'];
                        $varen21 = $_POST['p21'];
                        $varen22 = $_POST['p22'];
                        $varen23 = $_POST['p23'];
                        $varen24 = $_POST['p24'];
                        $varen25 = $_POST['p25'];
                        $varen26 = $_POST['p26'];
                        $varen27 = $_POST['p27'];
                        $varen28 = $_POST['p28'];
                        $varen29 = $_POST['p29'];
                        $varen30 = $_POST['p30'];
                        $varen31 = $_POST['p31'];
                        $varen32 = $_POST['p32'];

                        $insertSQL5 = sprintf(
                          "INSERT INTO personal_orip (id_oficina_registro, fecha, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, estado_personal_orip) VALUES (%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                          GetSQLValueString($id, "int"),
                          GetSQLValueString($varen1, "int"),
                          GetSQLValueString($varen2, "int"),
                          GetSQLValueString($varen3, "int"),
                          GetSQLValueString($varen4, "int"),
                          GetSQLValueString($varen5, "int"),
                          GetSQLValueString($varen6, "int"),
                          GetSQLValueString($varen7, "int"),
                          GetSQLValueString($varen8, "int"),
                          GetSQLValueString($varen9, "int"),
                          GetSQLValueString($varen10, "int"),
                          GetSQLValueString($varen11, "int"),
                          GetSQLValueString($varen12, "int"),
                          GetSQLValueString($varen13, "int"),
                          GetSQLValueString($varen14, "text"),
                          GetSQLValueString($varen15, "text"),
                          GetSQLValueString($varen16, "text"),
                          GetSQLValueString($varen17, "text"),
                          GetSQLValueString($varen18, "text"),
                          GetSQLValueString($varen19, "text"),
                          GetSQLValueString($varen20, "text"),
                          GetSQLValueString($varen21, "text"),
                          GetSQLValueString($varen22, "text"),
                          GetSQLValueString($varen23, "text"),
                          GetSQLValueString($varen24, "text"),
                          GetSQLValueString($varen25, "text"),
                          GetSQLValueString($varen26, "text"),
                          GetSQLValueString($varen27, "text"),
                          GetSQLValueString($varen28, "text"),
                          GetSQLValueString($varen29, "text"),
                          GetSQLValueString($varen30, "text"),
                          GetSQLValueString($varen31, "text"),
                          GetSQLValueString($varen32, "text"),
                          GetSQLValueString(1, "int")
                        );
                        $Result = mysql_query($insertSQL5, $conexion);


                        echo $insertado;
                        mysql_free_result($Result);
                      } else {
                      }




                      global $mysqli;
                      $mysqli = new mysqli($hostname_conexion2, $username_conexion2, $password_conexion2, $database_conexion2);
                      if (mysqli_connect_errno()) {
                        printf("", $mysqli->connect_error);
                        exit();
                      }

                      function personal_orip($idg, $preg)
                      {
                        global $mysqli;
                        $query4 = sprintf("SELECT " . $preg . " FROM personal_orip where id_oficina_registro=" . $idg . " and estado_personal_orip=1 limit 1");
                        $result4 = $mysqli->query($query4);
                        $obj = $result4->fetch_array(MYSQLI_ASSOC);
                        printf("%s", $obj[$preg]);
                        //return $res;
                        $result4->free();
                      }


                      $querynn = sprintf("SELECT count(id_personal_orip) as totnot FROM personal_orip where estado_personal_orip=1 and id_oficina_registro=" . $id . " ");
                      $selectnn = mysql_query($querynn, $conexion);
                      $rownn = mysql_fetch_assoc($selectnn);
                      if (0 < $rownn['totnot']) {



                        if (isset($_POST['up1']) and "" != $_POST['up1']) {


                          $updatecc = sprintf(
                            "UPDATE personal_orip SET fecha=now(), p1=%s, p2=%s, p3=%s, p4=%s, p5=%s, p6=%s, p7=%s, p8=%s, p9=%s, p10=%s, p11=%s, p12=%s, p13=%s, p14=%s, p15=%s, p16=%s, p17=%s, p18=%s, p19=%s, p20=%s, p21=%s, p22=%s, p23=%s, p24=%s, p25=%s, p26=%s, p27=%s, p28=%s, p29=%s, p30=%s, p31=%s, p32=%s WHERE id_oficina_registro=" . $id . " and estado_personal_orip=1",

                            GetSQLValueString($_POST['up1'], "int"),
                            GetSQLValueString($_POST['up2'], "int"),
                            GetSQLValueString($_POST['up3'], "int"),
                            GetSQLValueString($_POST['up4'], "int"),
                            GetSQLValueString($_POST['up5'], "int"),
                            GetSQLValueString($_POST['up6'], "int"),
                            GetSQLValueString($_POST['up7'], "int"),
                            GetSQLValueString($_POST['up8'], "int"),
                            GetSQLValueString($_POST['up9'], "int"),
                            GetSQLValueString($_POST['up10'], "int"),
                            GetSQLValueString($_POST['up11'], "int"),
                            GetSQLValueString($_POST['up12'], "int"),
                            GetSQLValueString($_POST['up13'], "int"),
                            GetSQLValueString($_POST['up14'], "text"),
                            GetSQLValueString($_POST['up15'], "text"),
                            GetSQLValueString($_POST['up16'], "text"),
                            GetSQLValueString($_POST['up17'], "text"),
                            GetSQLValueString($_POST['up18'], "text"),
                            GetSQLValueString($_POST['up19'], "text"),
                            GetSQLValueString($_POST['up20'], "text"),
                            GetSQLValueString($_POST['up21'], "text"),
                            GetSQLValueString($_POST['up22'], "text"),
                            GetSQLValueString($_POST['up23'], "text"),
                            GetSQLValueString($_POST['up24'], "text"),
                            GetSQLValueString($_POST['up25'], "text"),
                            GetSQLValueString($_POST['up26'], "text"),
                            GetSQLValueString($_POST['up27'], "text"),
                            GetSQLValueString($_POST['up28'], "text"),
                            GetSQLValueString($_POST['up29'], "text"),
                            GetSQLValueString($_POST['up30'], "text"),
                            GetSQLValueString($_POST['up31'], "text"),
                            GetSQLValueString($_POST['up32'], "text"),
                            GetSQLValueString(1, "int")
                          );

                          $Resulta = mysql_query($updatecc, $conexion);

                          echo $actualizado;
                          mysql_free_result($Resulta);
                        } else {
                        }





                        echo '<b>Encuesta enviada</b> &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp; ';


                        if (isset($_GET['e'])) {

                          ///////////////  actualización
                          echo '<a href="orip&' . $id . '.jsp" class="btn btn-xs btn-success">Solo consultar</a>';

                          $queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=3 and estado_encuesta_orip=1");
                          $selectn = mysql_query($queryn, $conexion);
                          $rown = mysql_fetch_assoc($selectn);
                      ?>
                          <form action="" method="POST" name="foractualizam1" onsubmit="">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>Pregunta</th>
                                  <th>Respuesta</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                do {
                                  echo $rown['nombre_seccion'];
                                  $pre = 'p' . $rown['id_encuesta_orip'];

                                  echo '<tr>';
                                  echo '<td><span>' . $rown['id_encuesta_orip'] . '</span></td>';
                                  echo '<td>' . $rown['nombre_encuesta_orip'] . '';
                                  echo '</td>';
                                  echo '<td>';
                                  if (1 == $rown['tipo_pregunta']) {
                                    echo '<input type="text" class="form-control numero" required placeholder="Solo números" name="up' . $rown['id_encuesta_orip'] . '" id="pregorip' . $rown['id_encuesta_orip'] . '" value="';
                                    echo personal_orip($id, $pre);
                                    echo '">';
                                  } else if (2 == $rown['tipo_pregunta']) {
                                    echo '<select name="up' . $rown['id_encuesta_orip'] . '" required class="form-control">';
                                    echo '<option value="';
                                    echo personal_orip($id, $pre);
                                    echo '" selected>';
                                    echo personal_orip($id, $pre);
                                    echo '</option>';
                                    echo '<option value="Si">Si</option>';
                                    echo '<option value="No">No</option>';
                                    echo '</select>';
                                  } else if (3 == $rown['tipo_pregunta']) {

                                    echo '<input type="text" class="form-control datepicker" readonly name="up' . $rown['id_encuesta_orip'] . '" value="">';
                                  } else if (4 == $rown['tipo_pregunta']) {

                                    echo '</td></tr><td><td colspan="3"><textarea class="form-control" name="up' . $rown['id_encuesta_orip'] . '">';
                                    echo personal_orip($id, $pre);
                                    echo '</textarea>';
                                  } else if (5 == $rown['tipo_pregunta']) {
                                    echo '<select name="p' . $rown['id_encuesta_orip'] . '" required class="form-control">';
                                    echo '<option value="" selected></option>';
                                    echo '<option value="Suficientes">Suficientes</option>';
                                    echo '<option value="Escasa">Escasa</option>';
                                    echo '<option value="No hay">No hay</option>';
                                    echo '</select>';
                                  } else if (6 == $rown['tipo_pregunta']) {
                                    echo '<select name="up' . $rown['id_encuesta_orip'] . '" required class="form-control">';
                                    echo '<option value="';
                                    echo personal_orip($id, $pre);
                                    echo '" selected>';
                                    echo personal_orip($id, $pre);
                                    echo '</option>';
                                    echo '<option value="Si">Si</option>';
                                    echo '<option value="No">No</option>';
                                    echo '<option value="Refuerzo">Refuerzo</option>';
                                    echo '</select>';
                                  } else {
                                  }

                                  echo '</td></tr>';
                                } while ($rown = mysql_fetch_assoc($selectn));
                                mysql_free_result($selectn);


                                ?>
                            </table>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-ok"></span> Actualizar </button>
                            </div>

                          </form>


                        <?php






                        } else {
                          echo '<a href="orip&' . $id . '&1.jsp" class="btn btn-xs btn-warning">Actualizar</a>';


                          $queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=3 and estado_encuesta_orip=1");
                          $selectn = mysql_query($queryn, $conexion);
                          $rown = mysql_fetch_assoc($selectn);

                          echo ' <table class="table">
                                  <thead>
                                  <tr>	
                              <th></th>
                                    <th>Pregunta</th>
                                    <th>Respuesta</th>
                                  </tr>
                                  </thead>
                                  <tbody>';

                          do {
                            echo $rown['nombre_seccion'];
                            $pre = 'p' . $rown['id_encuesta_orip'];
                            echo '<tr>';
                            echo '<td><span>' . $rown['id_encuesta_orip'] . '</span></td>';
                            echo '<td>' . $rown['nombre_encuesta_orip'] . '</td>';
                            echo '<td>';
                            if (4 == $rown['tipo_pregunta']) {
                              echo '</td><tr><td colspan="3">';
                            } else {
                            }

                            echo personal_orip($id, $pre);




                            echo '</td></tr>';
                          } while ($rown = mysql_fetch_assoc($selectn));
                          mysql_free_result($selectn);


                          echo '</table>';
                        }
                      } else {



                        $queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=3 and estado_encuesta_orip=1");
                        $selectn = mysql_query($queryn, $conexion);
                        $rown = mysql_fetch_assoc($selectn);
                        ?>
                        <form action="" method="POST" name="form1" onsubmit="">
                          <table class="table">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Pregunta</th>
                                <th style="width:200px;">Respuesta</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              do {

                                echo $rown['nombre_seccion'];

                                echo '<tr>';
                                echo '<td><span>' . $rown['id_encuesta_orip'] . '</span></td>';
                                echo '<td>' . $rown['nombre_encuesta_orip'] . '';
                                echo '</td>';
                                echo '<td>';
                                if (1 == $rown['tipo_pregunta']) {
                                  echo '<input type="number" class="form-control numero" required placeholder="Solo números" name="p' . $rown['id_encuesta_orip'] . '" id="pregorip' . $rown['id_encuesta_orip'] . '" value="">';
                                } else if (2 == $rown['tipo_pregunta']) {
                                  echo '<select name="p' . $rown['id_encuesta_orip'] . '" required class="form-control">';
                                  echo '<option value="" selected></option>';
                                  echo '<option value="Si">Si</option>';
                                  echo '<option value="No">No</option>';
                                  echo '</select>';
                                } else if (3 == $rown['tipo_pregunta']) {
                                  echo '<input type="text" class="form-control datepicker" readonly name="p' . $rown['id_encuesta_orip'] . '" value="">';
                                } else if (4 == $rown['tipo_pregunta']) {
                                  echo '</td><tr><td colspan="3"><textarea class="form-control" name="p' . $rown['id_encuesta_orip'] . '"></textarea>';
                                } else if (6 == $rown['tipo_pregunta']) {
                                  echo '<select name="p' . $rown['id_encuesta_orip'] . '" required class="form-control">';
                                  echo '<option value="" selected></option>';
                                  echo '<option value="Si">Si</option>';
                                  echo '<option value="No">No</option>';
                                  echo '<option value="Refuerzo">Refuerzo</option>';
                                  echo '</select>';
                                } else {
                                }

                                echo '</td></tr>';
                              } while ($rown = mysql_fetch_assoc($selectn));
                              mysql_free_result($selectn);


                              ?>
                          </table>
                          <div class="modal-footer">
                            <button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                            <button type="submit" class="btn btn-success">
                              <span class="glyphicon glyphicon-ok"></span> Enviar </button>
                          </div>

                        </form>
                      <?php }
                      mysql_free_result($selectnn);
                      ?>

                    </div>
                  </div>
                </div>
              </div>
            <?php } else {
            } ?>

            <div class="tab-pane" id="settings">
              <div class="post">
                <div class="user-block">
                  <div class="col-xs-12 table-responsive ">

                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col"><i class="glyphicon glyphicon glyphicon-cog"></i> Configuracion de Medios Recaudo</th>
                          <th scope="col">Activo / Inhabilitado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">Cuenta Producto:</th>
                          <td>
                            <?php
                            $opconoff = 0;
                            if ($opconoff == $row_update['opc_1']) {
                              echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
                            } else {
                              echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
                            } ?>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Liquidador Derechos de Registro(VUR):</th>
                          <td>
                            <?php
                            $opconoff = 0;
                            if ($opconoff == $row_update['opc_2']) {
                              echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
                            } else {
                              echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
                            } ?>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Supergiros:</th>
                          <td>
                            <?php
                            $opconoff = 0;
                            if ($opconoff == $row_update['opc_3']) {
                              echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
                            } else {
                              echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
                            } ?>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Radicacion Electronica (REL):</th>
                          <td>
                            <?php
                            $opconoff = 0;
                            if ($opconoff == $row_update['opc_4']) {
                              echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
                            } else {
                              echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
                            } ?>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Datafono:</th>
                          <td>
                            <?php
                            $opconoff = 0;
                            if ($opconoff == $row_update['opc_5']) {
                              echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
                            } else {
                              echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
                            } ?>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Otras ORIPS antiguo botón de pago:</th>
                          <td>
                            <?php
                            $opconoff = 0;
                            if ($opconoff == $row_update['opc_6']) {
                              echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
                            } else {
                              echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
                            } ?>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Sellos:</th>
                          <td>
                            <?php
                            $opconoff = 0;
                            if ($opconoff == $row_update['opc_7']) {
                              echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
                            } else {
                              echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
                            } ?>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Inmediatos canales web y electrónicos:</th>
                          <td>
                            <?php
                            $opconoff = 0;
                            if ($opconoff == $row_update['opc_8']) {
                              echo '<i class="glyphicon glyphicon-remove" style="color:#777"></i>';
                            } else {
                              echo '<i class="glyphicon glyphicon-ok" style="color:#49E845"></i>';
                            } ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>



                  </div>
                </div>
              </div>

            </div>

            <?php if (1 == $_SESSION['rol']) { ?>
              <div class="tab-pane" id="control">
                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">
                      <?php if (0 < $nump51 or 0 < $nump52 or 1 == $_SESSION['rol']) { ?>
                        <button class="btn btn-success" data-toggle="modal" data-target="#popupcontrol" title="Control"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo</button>
                        <br>
                      <?php

                      } else {
                      } ?>
                      <br>
                      <?php

                      if (isset($_POST['resolucion_r'])) {
                        $reactivacion_orip = intval($_POST['reactivacion_orip']);

                        $resolucion_r = $_POST['resolucion_r'];
                        $fecha_resolucion_r = $_POST['fecha_resolucion_r'];
                        $fecha_apertura = $_POST['fecha_apertura'];
                        $updateSQLe = "UPDATE reactivacion_orip SET 
                        resolucion_r='$resolucion_r', 
                        fecha_resolucion_r='$fecha_resolucion_r', 
                        fecha_apertura='$fecha_apertura' 
                        where id_oficina_registro=" . $id . " and id_reactivacion_orip=" . $reactivacion_orip . " and estado_reactivacion_orip=1 limit 1";
                        $Result1e = mysql_query($updateSQLe, $conexion);
                        echo $actualizado;
                        mysql_free_result($Result1e);
                      } else {
                      }


                      $queryn = sprintf("SELECT * from reactivacion_orip where id_oficina_registro=" . $id . " and estado_reactivacion_orip=1 order by fecha_reactivacion_orip desc");
                      $selectn = mysql_query($queryn, $conexion);
                      $rown = mysql_fetch_assoc($selectn);
                      $totalRows = mysql_num_rows($selectn);
                      if (0 < $totalRows) {
                        do {  //alert alert-success
                          if ("Si" == $rown['personal'] && "Si" == $rown['insumos'] && "Si" == $rown['otros']) {
                            $color = 'background:#D0E9C6;';
                          } else {
                            $color = 'background:#f2f2f2;';
                          }
                          echo '<div  style="border-radius: 5px;margin:10px 2px 0px 2px;padding:10px 10px 10px 10px;' . $color . '">';
                          echo '' . $rown['fecha_reactivacion_orip'] . '<br>';
                          echo '<b>Activación por Personal: ' . $rown['personal'] . '</b>; ' . $rown['obs_personal'] . '.<br>';


                          echo '<b>Activación por insumos: ' . $rown['insumos'] . '</b>; ' . $rown['obs_insumos'] . '.<br>';


                          echo '<b>Activación por Otros: ' . $rown['otros'] . '</b>; ' . $rown['obs_otros'] . '<br>';


                          if (isset($rown['soporte'])) {
                            echo '<br><a href="filesnr/reactivacion_orip/' . $rown['soporte'] . '" target="_blank">Ver Soporte</a>';
                          } else {
                          }

                          if ("Si" == $rown['personal'] && "Si" == $rown['insumos'] && "Si" == $rown['otros']) {
                            if (0 < $nump52 or 1 == $_SESSION['rol']) {
                              echo '<hr><form action="" method="post">
                              <input type="hidden" name="reactivacion_orip" value="' . $rown['id_reactivacion_orip'] . '">
                              <b>Resolución activación:</b> <input type="text" style="width:90px;" name="resolucion_r" value="' . $rown['resolucion_r'] . '" class="numero" placeholder="N. Resolución">
                              de <input type="text" style="width:130px;" name="fecha_resolucion_r" value="' . $rown['fecha_resolucion_r'] . '" class="datepicker" placeholder="Fecha resolución">
                              Apertura: <input type="text" style="width:130px;" name="fecha_apertura" value="' . $rown['fecha_apertura'] . '" class="datepicker" placeholder="Fecha apertura">
                              <input type="submit" value="Guardar" style="background:#008D4C;color:#fff;">
                              </form>';
                            } else {
                            }
                          } else {
                          }
                          echo '</div>';
                        } while ($rown = mysql_fetch_assoc($selectn));
                      }
                      mysql_free_result($selectn);


                      ?>



                    </div>
                  </div>
                </div>
              </div>
            <?php } else {
            } ?>

            <?php if (1 == $_SESSION['rol'] or 0 < $nump53) { ?>
              <div class="tab-pane" id="suministros">
                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">
                      <button class="btn btn-success" data-toggle="modal" data-target="#popupsuministros" title="Suministros"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo</button>
                      <br>
                      <br>
                      <?php

                      if ((isset($_POST["p34"])) && ($_POST["p34"] != "")) {
                        $insertSQL = sprintf(
                          "INSERT INTO suministro_orip (id_oficina_registro, fecha_suministro, p33, p34, p35, p36, p37, p38, p39, p40, p41, p42, p43, p44, p45, p46, p47, p48, p49, p50, p51, p52, p53, estado_suministro_orip) VALUES (%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                          GetSQLValueString($id, "int"),
                          GetSQLValueString($_POST["p33"], "int"),
                          GetSQLValueString($_POST["p34"], "int"),
                          GetSQLValueString($_POST["p35"], "int"),
                          GetSQLValueString($_POST["p36"], "int"),
                          GetSQLValueString($_POST["p37"], "int"),
                          GetSQLValueString($_POST["p38"], "text"),
                          GetSQLValueString($_POST["p39"], "text"),
                          GetSQLValueString($_POST["p40"], "text"),
                          GetSQLValueString($_POST["p41"], "text"),
                          GetSQLValueString($_POST["p42"], "text"),
                          GetSQLValueString($_POST["p43"], "text"),
                          GetSQLValueString($_POST["p44"], "text"),
                          GetSQLValueString($_POST["p45"], "text"),
                          GetSQLValueString($_POST["p46"], "text"),
                          GetSQLValueString($_POST["p47"], "text"),
                          GetSQLValueString($_POST["p48"], "text"),
                          GetSQLValueString($_POST["p49"], "text"),
                          GetSQLValueString($_POST["p50"], "text"),
                          GetSQLValueString($_POST["p51"], "text"),
                          GetSQLValueString($_POST["p52"], "text"),
                          GetSQLValueString($_POST["p53"], "text"),
                          GetSQLValueString(1, "int")
                        );
                        $Result = mysql_query($insertSQL, $conexion);
                        echo $insertado;
                      } else {
                      }




                      function pregunta_orip($preg)
                      {
                        global $mysqli;
                        $query4 = sprintf("SELECT nombre_encuesta_orip FROM encuesta_orip where id_encuesta_orip=" . $preg . " and estado_encuesta_orip limit 1");
                        $result4 = $mysqli->query($query4);
                        $obj = $result4->fetch_array(MYSQLI_ASSOC);
                        printf("%s", $obj['nombre_encuesta_orip']);
                        //return $res;
                        $result4->free();
                      }

                      $query = sprintf("SELECT * FROM suministro_orip where id_oficina_registro=" . $id . " and estado_suministro_orip=1 order by id_suministro_orip desc");
                      $select = mysql_query($query, $conexion);
                      $row = mysql_fetch_assoc($select);
                      $totalRows = mysql_num_rows($select);
                      if (0 < $totalRows) {
                        do {
                          echo '<div style="border:1px solid#ccc;"><ul>';
                          echo '<li><b>Fecha de diligenciamiento: ' . $row['fecha_suministro'] . '</b></li>';
                          echo '<li>';
                          echo pregunta_orip(33);
                          echo ': ' . $row['p33'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(34);
                          echo ': ' . $row['p34'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(35);
                          echo ': ' . $row['p35'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(36);
                          echo ': ' . $row['p36'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(37);
                          echo ': ' . $row['p37'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(38);
                          echo ': ' . $row['p38'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(39);
                          echo ': ' . $row['p39'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(40);
                          echo ': ' . $row['p40'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(41);
                          echo ': ' . $row['p41'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(42);
                          echo ': ' . $row['p42'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(43);
                          echo ': ' . $row['p43'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(44);
                          echo ': ' . $row['p44'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(45);
                          echo ': ' . $row['p45'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(46);
                          echo ': ' . $row['p46'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(47);
                          echo ': ' . $row['p47'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(48);
                          echo ': ' . $row['p48'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(49);
                          echo ': ' . $row['p49'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(50);
                          echo ': ' . $row['p50'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(51);
                          echo ': ' . $row['p51'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(52);
                          echo ': ' . $row['p52'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(53);
                          echo ': ' . $row['p53'] . '</li>';

                          echo '</ul></div><br>';
                        } while ($row = mysql_fetch_assoc($select));
                      } else {
                      }
                      mysql_free_result($select);

                      ?>
                      <br>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="locativas">
                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">

                      <button class="btn btn-success" data-toggle="modal" data-target="#popuplocativas" title="Aspectos locativos"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo</button>
                      <br>
                      <br>

                      <?php

                      if ((isset($_POST["p58"])) && ($_POST["p58"] != "")) {

                        if ('Si' == $_POST["p54"]) {
                          $loc54 = $_POST["p54"] . ', ' . $_POST["ant54"];
                        } else {
                          $loc54 = $_POST["p54"];
                        }
                        if ('Si' == $_POST["p55"]) {
                          $loc55 = $_POST["p55"] . ', ' . $_POST["ant55"];
                        } else {
                          $loc55 = $_POST["p55"];
                        }
                        if ('Si' == $_POST["p56"]) {
                          $loc56 = $_POST["p56"] . ', ' . $_POST["ant56"];
                        } else {
                          $loc56 = $_POST["p56"];
                        }
                        if ('Si' == $_POST["p57"]) {
                          $loc57 = $_POST["p57"] . ', ' . $_POST["ant57"];
                        } else {
                          $loc57 = $_POST["p57"];
                        }
                        if ('Si' == $_POST["p58"]) {
                          $loc58 = $_POST["p58"] . ', ' . $_POST["ant58"];
                        } else {
                          $loc58 = $_POST["p58"];
                        }
                        if ('Si' == $_POST["p59"]) {
                          $loc59 = $_POST["p59"] . ', ' . $_POST["ant59"];
                        } else {
                          $loc59 = $_POST["p59"];
                        }
                        if ('Si' == $_POST["p60"]) {
                          $loc60 = $_POST["p60"] . ', ' . $_POST["ant60"];
                        } else {
                          $loc60 = $_POST["p60"];
                        }
                        if ('Si' == $_POST["p61"]) {
                          $loc61 = $_POST["p61"] . ', ' . $_POST["ant61"];
                        } else {
                          $loc61 = $_POST["p61"];
                        }
                        if ('Si' == $_POST["p62"]) {
                          $loc62 = $_POST["p62"] . ', ' . $_POST["ant62"];
                        } else {
                          $loc62 = $_POST["p62"];
                        }
                        if ('Si' == $_POST["p63"]) {
                          $loc63 = $_POST["p63"] . ', ' . $_POST["ant63"];
                        } else {
                          $loc63 = $_POST["p63"];
                        }
                        if ('Si' == $_POST["p64"]) {
                          $loc64 = $_POST["p64"] . ', ' . $_POST["ant64"];
                        } else {
                          $loc64 = $_POST["p64"];
                        }
                        if ('Si' == $_POST["p65"]) {
                          $loc65 = $_POST["p65"] . ', ' . $_POST["ant65"];
                        } else {
                          $loc65 = $_POST["p65"];
                        }
                        if ('Si' == $_POST["p66"]) {
                          $loc66 = $_POST["p66"] . ', ' . $_POST["ant66"];
                        } else {
                          $loc66 = $_POST["p66"];
                        }
                        if ('Si' == $_POST["p67"]) {
                          $loc67 = $_POST["p67"] . ', ' . $_POST["ant67"];
                        } else {
                          $loc67 = $_POST["p67"];
                        }
                        if ('Si' == $_POST["p68"]) {
                          $loc68 = $_POST["p68"] . ', ' . $_POST["ant68"];
                        } else {
                          $loc68 = $_POST["p68"];
                        }


                        $insertSQL = sprintf(
                          "INSERT INTO locativo_orip (id_oficina_registro, fecha_locativo, p54, p55, p56, p57, p58, p59, p60, p61, p62, p63, p64, p65, p66, p67, p68, estado_locativo_orip) VALUES (%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                          GetSQLValueString($id, "int"),
                          GetSQLValueString($loc54, "text"),
                          GetSQLValueString($loc55, "text"),
                          GetSQLValueString($loc56, "text"),
                          GetSQLValueString($loc57, "text"),
                          GetSQLValueString($loc58, "text"),
                          GetSQLValueString($loc59, "text"),
                          GetSQLValueString($loc60, "text"),
                          GetSQLValueString($loc61, "text"),
                          GetSQLValueString($loc62, "text"),
                          GetSQLValueString($loc63, "text"),
                          GetSQLValueString($loc64, "text"),
                          GetSQLValueString($loc65, "text"),
                          GetSQLValueString($loc66, "text"),
                          GetSQLValueString($loc67, "text"),
                          GetSQLValueString($loc68, "text"),
                          GetSQLValueString(1, "int")
                        );
                        $Result = mysql_query($insertSQL, $conexion);
                        echo $insertado;
                      } else {
                      }


                      $query = sprintf("SELECT * FROM locativo_orip where id_oficina_registro=" . $id . "");
                      $select = mysql_query($query, $conexion);
                      $row = mysql_fetch_assoc($select);
                      $totalRows = mysql_num_rows($select);
                      if (0 < $totalRows) {
                        do {
                          echo '<div style="border:1px solid#ccc;"><ul>';
                          echo '<li><b>Fecha de diligenciamiento: ' . $row['fecha_locativo'] . '</b></li>';

                          echo '<li>';
                          echo pregunta_orip(54);
                          echo ': ';
                          echo $row['p54'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(55);
                          echo ': ';
                          echo $row['p55'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(56);
                          echo ': ';
                          echo $row['p56'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(57);
                          echo ': ';
                          echo $row['p57'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(58);
                          echo ': ';
                          echo $row['p58'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(59);
                          echo ': ';
                          echo $row['p59'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(60);
                          echo ': ';
                          echo $row['p60'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(61);
                          echo ': ';
                          echo $row['p61'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(62);
                          echo ': ';
                          echo $row['p62'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(63);
                          echo ': ';
                          echo $row['p63'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(64);
                          echo ': ';
                          echo $row['p64'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(65);
                          echo ': ';
                          echo $row['p65'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(66);
                          echo ': ';
                          echo $row['p66'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(67);
                          echo ': ';
                          echo $row['p67'] . '</li>';
                          echo '<li>';
                          echo pregunta_orip(68);
                          echo ': ';
                          echo $row['p68'] . '</li>';
                          echo '</ul></div><br>';
                        } while ($row = mysql_fetch_assoc($select));
                      } else {
                      }
                      mysql_free_result($select);
                      ?>

                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tecnologia">
                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">

                      <button class="btn btn-success" data-toggle="modal" data-target="#popuptecnologia" title="Aspectos locativos"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo</button>
                      <br>
                      <br>

                      <?php

                      if ((isset($_POST["p70"])) && ($_POST["p70"] != "")) {
                        $insertSQL = sprintf(
                          "INSERT INTO tecnologia_orip (id_oficina_registro, fecha_tecnologia, p69, p70, p71, p72, p73, p74, p75, p76, p77, p78, p79, p80, p81, p82, p83, p84, p85, p86, p87, p88, p89, p90, p91, p92, p93, p94, p95, p96, p97, p98, p99, p100, p101, p102, p103, p104, p105, p106, p107, p108, estado_tecnologia_orip) VALUES (%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                          GetSQLValueString($id, "int"),
                          GetSQLValueString($_POST["p69"], "int"),
                          GetSQLValueString($_POST["p70"], "int"),
                          GetSQLValueString($_POST["p71"], "int"),
                          GetSQLValueString($_POST["p72"], "int"),
                          GetSQLValueString($_POST["p73"], "int"),
                          GetSQLValueString($_POST["p74"], "int"),
                          GetSQLValueString($_POST["p75"], "int"),
                          GetSQLValueString($_POST["p76"], "int"),
                          GetSQLValueString($_POST["p77"], "int"),
                          GetSQLValueString($_POST["p78"], "int"),
                          GetSQLValueString($_POST["p79"], "int"),
                          GetSQLValueString($_POST["p80"], "int"),
                          GetSQLValueString($_POST["p81"], "int"),
                          GetSQLValueString($_POST["p82"], "int"),
                          GetSQLValueString($_POST["p83"], "int"),
                          GetSQLValueString($_POST["p84"], "int"),
                          GetSQLValueString($_POST["p85"], "int"),
                          GetSQLValueString($_POST["p86"], "int"),
                          GetSQLValueString($_POST["p87"], "int"),
                          GetSQLValueString($_POST["p88"], "int"),
                          GetSQLValueString($_POST["p89"], "int"),
                          GetSQLValueString($_POST["p90"], "int"),
                          GetSQLValueString($_POST["p91"], "int"),
                          GetSQLValueString($_POST["p92"], "int"),
                          GetSQLValueString($_POST["p93"], "int"),
                          GetSQLValueString($_POST["p94"], "int"),
                          GetSQLValueString($_POST["p95"], "int"),
                          GetSQLValueString($_POST["p96"], "int"),
                          GetSQLValueString($_POST["p97"], "int"),
                          GetSQLValueString($_POST["p98"], "int"),
                          GetSQLValueString($_POST["p99"], "int"),
                          GetSQLValueString($_POST["p100"], "int"),
                          GetSQLValueString($_POST["p101"], "text"),
                          GetSQLValueString($_POST["p102"], "text"),
                          GetSQLValueString($_POST["p103"], "text"),
                          GetSQLValueString($_POST["p104"], "text"),
                          GetSQLValueString($_POST["p105"], "text"),
                          GetSQLValueString($_POST["p106"], "text"),
                          GetSQLValueString($_POST["p107"], "text"),
                          GetSQLValueString($_POST["p108"], "text"),
                          GetSQLValueString(1, "int")
                        );
                        $Result = mysql_query($insertSQL, $conexion);
                        echo $insertado;
                      } else {
                      }


                      $query = sprintf("SELECT * FROM tecnologia_orip where id_oficina_registro=" . $id . " and estado_tecnologia_orip=1");
                      $select = mysql_query($query, $conexion);
                      $row = mysql_fetch_assoc($select);
                      $totalRows = mysql_num_rows($select);
                      if (0 < $totalRows) {
                        do {
                          echo '<div style="border:1px solid#ccc;"><ul>';
                          echo '<li><b>Fecha de diligenciamiento: ' . $row['fecha_tecnologia'] . '</b></li>';
                          echo  '<li>';
                          echo pregunta_orip(69);
                          echo ': ';
                          echo $row['p69'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(70);
                          echo ': ';
                          echo $row['p70'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(71);
                          echo ': ';
                          echo $row['p71'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(72);
                          echo ': ';
                          echo $row['p72'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(73);
                          echo ': ';
                          echo $row['p73'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(74);
                          echo ': ';
                          echo $row['p74'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(75);
                          echo ': ';
                          echo $row['p75'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(76);
                          echo ': ';
                          echo $row['p76'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(77);
                          echo ': ';
                          echo $row['p77'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(78);
                          echo ': ';
                          echo $row['p78'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(79);
                          echo ': ';
                          echo $row['p79'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(80);
                          echo ': ';
                          echo $row['p80'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(81);
                          echo ': ';
                          echo $row['p81'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(82);
                          echo ': ';
                          echo $row['p82'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(83);
                          echo ': ';
                          echo $row['p83'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(84);
                          echo ': ';
                          echo $row['p84'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(85);
                          echo ': ';
                          echo $row['p85'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(86);
                          echo ': ';
                          echo $row['p86'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(87);
                          echo ': ';
                          echo $row['p87'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(88);
                          echo ': ';
                          echo $row['p88'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(89);
                          echo ': ';
                          echo $row['p89'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(90);
                          echo ': ';
                          echo $row['p90'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(91);
                          echo ': ';
                          echo $row['p91'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(92);
                          echo ': ';
                          echo $row['p92'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(93);
                          echo ': ';
                          echo $row['p93'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(94);
                          echo ': ';
                          echo $row['p94'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(95);
                          echo ': ';
                          echo $row['p95'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(96);
                          echo ': ';
                          echo $row['p96'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(97);
                          echo ': ';
                          echo $row['p97'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(98);
                          echo ': ';
                          echo $row['p98'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(99);
                          echo ': ';
                          echo $row['p99'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(100);
                          echo ': ';
                          echo $row['p100'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(101);
                          echo ': ';
                          echo $row['p101'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(102);
                          echo ': ';
                          echo $row['p102'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(103);
                          echo ': ';
                          echo $row['p103'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(104);
                          echo ': ';
                          echo $row['p104'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(105);
                          echo ': ';
                          echo $row['p105'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(106);
                          echo ': ';
                          echo $row['p106'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(107);
                          echo ': ';
                          echo $row['p107'] . '</li>';
                          echo  '<li>';
                          echo pregunta_orip(108);
                          echo ': ';
                          echo $row['p108'] . '</li>';


                          echo '</ul></div><br>';
                        } while ($row = mysql_fetch_assoc($select));
                      } else {
                      }
                      mysql_free_result($select);
                      ?>

                    </div>
                  </div>
                </div>
              </div>

              

            <?php } ?>

            <div class="tab-pane" id="hvinmueble">
                <div class="post">
                  <div class="user-block">
                    <div class="col-xs-12 table-responsive ">
                      <?php
                      $query = "SELECT * FROM oficina_registro_inmueble 
                      WHERE id_oficina_registro_fk_oficina_registro = $id
                      AND estado_oficina_registro_inmueble = 1";
                      $result = $mysqli->query($query);
                      $row = $result->fetch_array(MYSQLI_ASSOC);
                      $idORI = $row['id_oficina_registro_inmueble'];
                      if (isset($idORI)) {
                      ?>

                      <div class="row">
                        <div class="col-md-5">
                          <table>
                            <tr>
                              <th>Información Bien Inmueble</th>
                            </tr>
                            <tr>
                              <td>Fecha Adquisición</td>
                              <td><?php echo isset($row['fecha_adquisicion']) ? $row['fecha_adquisicion'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero Escritura</td>
                              <td><?php echo isset($row['num_escritura']) ? $row['num_escritura'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Nombre Notaria</td>
                              <td><?php echo isset($row['nombre_notaria']) ? $row['nombre_notaria'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Cedula Catastral</td>
                              <td><?php echo isset($row['num_cedula_catastral']) ? $row['num_cedula_catastral'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero Matricula Inmobiliaria</td>
                              <td><?php echo isset($row['num_matricula_inmobiliaria']) ? $row['num_matricula_inmobiliaria'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Porcentaje (%) de Propiedad</td>
                              <td><?php echo isset($row['porcentaje_propiedad']) ? $row['porcentaje_propiedad'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Tipo de Uso</td>
                              <td><?php echo isset($row['tipo_uso_inmueble']) ? $row['tipo_uso_inmueble'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Inmueble Patrimonio Declarado </td>
                              <td><?php echo isset($row['inmueble_declarado_patrimonio']) ? $row['inmueble_declarado_patrimonio'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero acto administrativo</td>
                              <td><?php echo isset($row['num_acto_administrativo']) ? $row['num_acto_administrativo'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Area terreno</td>
                              <td><?php echo isset($row['area_terreno']) ? $row['area_terreno'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Area construida</td>
                              <td><?php echo isset($row['area_construida']) ? $row['area_construida'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero Pisos</td>
                              <td><?php echo isset($row['num_pisos']) ? $row['num_pisos'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Area patio</td>
                              <td><?php echo isset($row['area_patio']) ? $row['area_patio'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Area zona verdes</td>
                              <td><?php echo isset($row['area_zonas_verdes']) ? $row['area_zonas_verdes'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero asensores</td>
                              <td><?php echo isset($row['num_asensores']) ? $row['num_asensores'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Carga Electrica (KVA)</td>
                              <td><?php echo isset($row['carga_electrica_kva']) ? $row['carga_electrica_kva'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero contadores electricos</td>
                              <td><?php echo isset($row['num_contadores_electricos']) ? $row['num_contadores_electricos'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero puntos red</td>
                              <td><?php echo isset($row['num_puntos_red']) ? $row['num_puntos_red'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero lamparas</td>
                              <td><?php echo isset($row['num_lamparas']) ? $row['num_lamparas'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero baños</td>
                              <td><?php echo isset($row['num_banos']) ? $row['num_banos'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero baños (Discapasitados)</td>
                              <td><?php echo isset($row['num_bano_discapacitados']) ? $row['num_bano_discapacitados'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero und Sanitarias</td>
                              <td><?php echo isset($row['num_und_sanitarias']) ? $row['num_und_sanitarias'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero extintores</td>
                              <td><?php echo isset($row['num_extintores']) ? $row['num_extintores'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero camaras vigilancia</td>
                              <td><?php echo isset($row['num_camaras_vigilancia']) ? $row['num_camaras_vigilancia'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero vigilantes</td>
                              <td><?php echo isset($row['num_vigilantes']) ? $row['num_vigilantes'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero escrituras registradas</td>
                              <td><?php echo isset($row['num_escrituras_registradas']) ? $row['num_escrituras_registradas'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Numero libros</td>
                              <td><?php echo isset($row['num_libros']) ? $row['num_libros'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Existe modulo atencion (Discapasitados)&nbsp;&nbsp;</td>
                              <td><?php echo isset($row['modulo_atencion_discapacitados']) ? $row['modulo_atencion_discapacitados'] : ''; ?></td>
                            </tr>
                            <tr>
                              <td>Existe enfermeria</td>
                              <td><?php echo isset($row['existe_enfermeria']) ? $row['existe_enfermeria'] : ''; ?></td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-md-7">

                          <table class="table">
                            <b>Impuesto predial unificado</b>
                            <head>
                              <tr>
                                <td>Año</td>
                                <td>Valor</td>
                                <td>Pdf</td>
                              </tr>
                            </head>
                            <body>
                              <?php
                              $query2 = "SELECT * FROM oficina_registro_inmueble_detalle WHERE 
                              id_oficina_registro_inmueble_fk_oficina_registro_inmueble=$idORI
                              AND nombre_oficina_registro_inmueble_detalle='PREDIAL'
                              AND estado_oficina_registro_inmueble_detalle=1";
                              $result2 = $mysqli->query($query2);
                              while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                                if ($row2) { ?>
                                <tr>
                                  <td><?php echo $row2['ano']; ?></td>
                                  <td><?php echo $row2['valor']; ?></td>
                                  <td><a href="filesnr/oficinaregistroinmueble/<?php echo $row2['ano_creacion_documento'] . '/' . $row2['url_documento']; ?>" target="_blank"><img src="images\pdf.png" alt="" style="width:15px; height:15px;"></a></td>
                                </tr>
                              <?php } 
                              } ?>
                            </body>
                          </table>

                          <table class="table">
                            <b>Avalúo inmobiliario</b>
                            <head>
                              <tr>
                                <td>Año</td>
                                <td>Valor</td>
                                <td>Pdf</td>
                              </tr>
                            </head>
                            <body>
                              <?php
                              $query2 = "SELECT * FROM oficina_registro_inmueble_detalle WHERE 
                              id_oficina_registro_inmueble_fk_oficina_registro_inmueble=$idORI
                              AND nombre_oficina_registro_inmueble_detalle='AVALUO'
                              AND estado_oficina_registro_inmueble_detalle=1";
                              $result2 = $mysqli->query($query2);
                              while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                                if ($row2) { ?>
                                <tr>
                                  <td><?php echo $row2['ano']; ?></td>
                                  <td><?php echo $row2['valor']; ?></td>
                                  <td><a href="filesnr/oficinaregistroinmueble/<?php echo $row2['ano_creacion_documento'] . '/' . $row2['url_documento']; ?>" target="_blank"><img src="images\pdf.png" alt="" style="width:15px; height:15px;"></a></td>
                                </tr>
                              <?php } 
                              } ?>
                            </body>
                          </table>

                          <table class="table no-margin">
                            <b>Estado del Inmueble</b>
                            <head>
                              <tr>
                                <th>Elemento</th>
                                <th>Ubicacion</th>
                                <th>Material</th>
                                <th>Estado</th>
                                <th>Tipo</th>
                                <th>Medidas</th>
                              </tr>
                            </head>

                            <body>
                              <?php
                              $query2 = "SELECT * FROM oficina_registro_inmueble_detalle WHERE 
                              id_oficina_registro_inmueble_fk_oficina_registro_inmueble=$idORI 
                              AND nombre_oficina_registro_inmueble_detalle='ESTADO_INMUEBLE'
                              AND estado_oficina_registro_inmueble_detalle=1";
                              $result2 = $mysqli->query($query2);
                              while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                                if ($row2) {
                              ?>
                                  <tr>
                                    <td><?php echo $row2['nombre_elemento']; ?></td>
                                    <td><?php echo $row2['ubicacion']; ?></td>
                                    <td><?php echo $row2['material']; ?></td>
                                    <td><?php echo $row2['estado']; ?></td>
                                    <td><?php echo $row2['tipo']; ?></td>
                                    <td><?php echo $row2['medida']; ?></td>
                                  </tr>
                              <?php }
                              } ?>
                            </body>
                          </table>

                        </div>
                      </div>
                      
                      <?php } else { echo 'Sin Informacion'; } ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="requerimientos">
                <div class="post">
                  <div class="user-block">
                    <?php include('orips_requisitos.php') ?>
                  </div>
                </div>
              </div>

            <!-- /.tab-pane -->

            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>



      <div class="modal fade" id="popupcontrol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel"><label class="control-label">Reactivación de ORIP / <?php echo $row_update['nombre_oficina_registro']; ?></label></h4>
            </div>
            <div class="modal-body">
              <form action="" method="POST" name="form1" onsubmit="" enctype="multipart/form-data">
                <input type="hidden" name="regional" value="<?php echo $row_update['id_region']; ?>">
                <input type="hidden" name="correo_registrador" value="<?php echo $correo_registrador; ?>">

                <div class="form-group text-left">
                  <div class="input-group">
                    <label class="control-label input-group-addon">
                      <b>Personal:</b></label>
                    <span class="input-group-addon">
                      <select name="personal" style="width:65px;" class="form-control" required>
                        <option value="" selected></option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </span>
                    <textarea name="obs_personal" class="form-control" id="" placeholder="Observación"></textarea>
                  </div>
                </div>


                <div class="form-group text-left">
                  <div class="input-group">
                    <label class="control-label input-group-addon">
                      <b>Insumos:</b></label>
                    <span class="input-group-addon">
                      <select name="insumos" style="width:65px;" class="form-control" required>
                        <option value="" selected></option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </span>
                    <textarea name="obs_insumos" class="form-control" id="" placeholder="Observación"></textarea>
                  </div>
                </div>

                <div class="form-group text-left">
                  <div class="input-group">
                    <label class="control-label input-group-addon">
                      <b>Otros:</b></label>
                    <span class="input-group-addon">
                      <select name="otros" style="width:65px;" class="form-control" required>
                        <option value="" selected></option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </span>
                    <textarea name="obs_otros" class="form-control" id="" placeholder="Observación"></textarea>
                  </div>
                  <b>Copiar por correo a:</b> &nbsp; Tecnologia: <input type="checkbox" name="tecnologia" value=""> &nbsp; &nbsp;
                  Infraestructura: <input type="checkbox" name="infraestructura" value=""> &nbsp; &nbsp;
                  Capacitación: <input type="checkbox" name="capacitacion" value=""> &nbsp; &nbsp;
                  Ente territorial: <input type="checkbox" name="ente_territorial" value="">
                </div>


                <div class="form-group text-left">
                  <div class="">
                    <label class="control-label">
                      <b>Soporte:</b></label>
                    <input type="file" name="filet" class="form-control">
                    <span style="color:#aaa;font-size:13px;">Archivo inferior a 8 Mg</span>
                  </div>
                </div>






                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
                    <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                  <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span> Enviar </button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>










      <div class="modal fade" id="popupsuministros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel"><label class="control-label">Suministros / <?php echo $row_update['nombre_oficina_registro']; ?></label></h4>
            </div>
            <div class="modal-body">

              <?php




              $queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=4 and estado_encuesta_orip=1");
              $selectn = mysql_query($queryn, $conexion);
              $rown = mysql_fetch_assoc($selectn);
              ?>
              <form action="" method="POST" name="fo435435rm1" onsubmit="">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th style="width:200px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    do {

                      echo $rown['nombre_seccion'];
                      echo '<tr>';
                      echo '<td></td>';
                      echo '<td>' . $rown['nombre_encuesta_orip'] . '';
                      echo '</td>';
                      echo '<td>';
                      if (1 == $rown['tipo_pregunta']) {
                        echo '<input type="number" class="form-control numero" required placeholder="Solo números" name="p' . $rown['id_encuesta_orip'] . '"  value="">';
                      } else if (2 == $rown['tipo_pregunta']) {
                        echo '<select name="p' . $rown['id_encuesta_orip'] . '" required class="form-control">';
                        echo '<option value="" selected></option>';
                        echo '<option value="Si">Si</option>';
                        echo '<option value="No">No</option>';
                        echo '</select>';
                      } else if (3 == $rown['tipo_pregunta']) {
                        echo '<input type="text" class="form-control datepicker" readonly name="p' . $rown['id_encuesta_orip'] . '" value="">';
                      } else if (4 == $rown['tipo_pregunta']) {
                        echo '</td><tr><td colspan="3"><textarea class="form-control" name="p' . $rown['id_encuesta_orip'] . '"></textarea>';
                      } else if (5 == $rown['tipo_pregunta']) {
                        echo '<select name="p' . $rown['id_encuesta_orip'] . '" required class="form-control">';
                        echo '<option value="" selected></option>';
                        echo '<option value="Suficientes">Suficientes</option>';
                        echo '<option value="Escasa">Escasa</option>';
                        echo '<option value="No hay">No hay</option>';
                        echo '</select>';
                      } else {
                      }

                      echo '</td></tr>';
                    } while ($rown = mysql_fetch_assoc($selectn));
                    mysql_free_result($selectn);


                    ?>
                </table>


                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
                    <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                  <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span> Enviar </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>















      <div class="modal fade" id="popuplocativas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel"><label class="control-label">Aspectos locativos / <?php echo $row_update['nombre_oficina_registro']; ?></label></h4>
            </div>
            <div class="modal-body">


              <?php




              $queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=5 and estado_encuesta_orip=1");
              $selectn = mysql_query($queryn, $conexion);
              $rown = mysql_fetch_assoc($selectn);
              ?>
              <form action="" method="POST" name="fo4354325345435rm1" onsubmit="">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th style="width:200px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    do {

                      echo $rown['nombre_seccion'];
                      echo '<tr>';
                      echo '<td></td>';
                      echo '<td>' . $rown['nombre_encuesta_orip'] . '. <br>En caso de Si, reportar la antiguedad del problema.';
                      echo '</td>';
                      echo '<td>';
                      if (1 == $rown['tipo_pregunta']) {
                        echo '<input type="number" class="form-control numero" required placeholder="Solo números" name="p' . $rown['id_encuesta_orip'] . '" value="">';
                      } else if (2 == $rown['tipo_pregunta']) {
                        echo '<select name="p' . $rown['id_encuesta_orip'] . '" required class="form-control">';
                        echo '<option value="" selected></option>';
                        echo '<option value="Si">Si</option>';
                        echo '<option value="No">No</option>';
                        echo '</select> ';


                        echo '<select name="ant' . $rown['id_encuesta_orip'] . '" class="form-control">';
                        echo '<option value="" selected>- - Antiguedad - -</option>';
                        echo '<option value="Menos de 1 mes">Menos de 1 mes</option>';
                        echo '<option value="Entre 1 y 3 meses">Entre 1 y 3 meses</option>';
                        echo '<option value="Entre 3 y 6 meses">Entre 3 y 6 meses</option>';
                        echo '<option value="Entre 6 y 12 meses">Entre 6 y 12 meses</option>';
                        echo '<option value="Entre 1 y 2 años">Entre 1 y 2 años</option>';
                        echo '<option value="Más de 2 años">Más de 2 años</option>';
                        echo '</select>';
                      } else if (3 == $rown['tipo_pregunta']) {
                        echo '<input type="text" class="form-control datepicker" readonly name="p' . $rown['id_encuesta_orip'] . '" value="">';
                      } else if (4 == $rown['tipo_pregunta']) {

                        echo '</td><tr><td colspan="3"><textarea class="form-control" name="p' . $rown['id_encuesta_orip'] . '"></textarea>';
                      } else {
                      }

                      echo '</td></tr>';
                    } while ($rown = mysql_fetch_assoc($selectn));
                    mysql_free_result($selectn);


                    ?>
                </table>


                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
                    <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                  <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span> Enviar </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="popuptecnologia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel"><label class="control-label">CONDICIONES DE COMUNICACIÓN Y TECNOLOGÍAS / <?php echo $row_update['nombre_oficina_registro']; ?></label></h4>
            </div>
            <div class="modal-body">


              <?php

              $queryn = sprintf("SELECT * FROM encuesta_orip where id_encuesta=6 and estado_encuesta_orip=1");
              $selectn = mysql_query($queryn, $conexion);
              $rown = mysql_fetch_assoc($selectn);
              ?>
              <form action="" method="POST" name="fo4354324545345435rm1" onsubmit="">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th style="width:200px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    do {

                      echo $rown['nombre_seccion'];
                      echo '<tr>';
                      echo '<td></td>';
                      echo '<td>' . $rown['nombre_encuesta_orip'] . '';
                      echo '</td>';
                      echo '<td>';
                      if (1 == $rown['tipo_pregunta']) {
                        echo '<input type="number" class="form-control numero" required placeholder="Solo números" name="p' . $rown['id_encuesta_orip'] . '" value="">';
                      } else if (2 == $rown['tipo_pregunta']) {
                        echo '<select name="p' . $rown['id_encuesta_orip'] . '" required class="form-control">';
                        echo '<option value="" selected></option>';
                        echo '<option value="Si">Si</option>';
                        echo '<option value="No">No</option>';
                        if (107 == $rown['id_encuesta_orip'] or 108 == $rown['id_encuesta_orip']) {
                          echo '<option value="No aplica">No aplica</option>';
                        } else {
                        }

                        echo '</select> ';
                      } else if (4 == $rown['tipo_pregunta']) {

                        echo '</td><tr><td colspan="3"><textarea class="form-control" name="p' . $rown['id_encuesta_orip'] . '"></textarea>';
                      } else {
                      }

                      echo '</td></tr>';
                    } while ($rown = mysql_fetch_assoc($selectn));
                    mysql_free_result($selectn);


                    ?>
                </table>


                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
                    <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                  <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span> Enviar </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

  <?php
  }
}
  ?>
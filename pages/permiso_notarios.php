<?php
$nump6 = privilegios(6, $_SESSION['snr']);
if (isset($_GET['i']) && "" != $_GET['i']) {
  $id = $_GET['i'];

  $query_updaten = sprintf("SELECT motivo, email_notaria, nombre_notaria, notaria.id_notaria, id_categoria_notaria FROM permiso, notaria WHERE id_permiso = %s and permiso.id_notaria=notaria.id_notaria and estado_notaria=1 and estado_permiso=1", GetSQLValueString($id, "int"));
  $updaten = mysql_query($query_updaten, $conexion);
  $row_updaten = mysql_fetch_assoc($updaten);
  $totalRows_updaten = mysql_num_rows($updaten);
  if (0 < $totalRows_updaten) {


    $id_notaria = $row_updaten['id_notaria'];
    $email_notaria = $row_updaten['email_notaria'];
    $nombre_notaria = $row_updaten['nombre_notaria'];
    $id_categoria_notaria = $row_updaten['id_categoria_notaria'];
    $motivo = $row_updaten['motivo'];
  } else {
  }

  if ($id_notaria == $_SESSION['id_vigilado'] or 1 == $_SESSION['rol'] or 0 < $nump6) {


    if ((isset($_POST["adjunto"])) && ($_POST["adjunto"] != "")) {

      $tamano_archivo = 11534336;
      //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
      $formato_archivo = array('pdf');


      $directoryftp = "filesnr/documento_permiso/";


      $ruta_archivo = 'permiso-' . $id . '-' . date("YmdGis");



      $archivo = $_FILES['file']['tmp_name'];
      $tam_archivo = filesize($archivo);
      $tam_archivo2 = $_FILES['file']['size'];
      $nombrefile = strtolower($_FILES['file']['name']);
      $info = pathinfo($nombrefile);
      $extension = $info['extension'];
      $array_archivo = explode('.', $nombrefile);
      $extension2 = end($array_archivo);



      if ($tamano_archivo >= intval($tam_archivo2)) {

        if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
          $files = $ruta_archivo . '.' . $extension;
          $mover_archivos = move_uploaded_file($archivo, $directoryftp . $files);
          //chmod($files,0777);
          $nombrebre_orig = ucwords($nombrefile);



          $updateSQLyt = sprintf(
            "UPDATE permiso SET file_acta=%s where id_permiso=%s and estado_permiso=1",
            GetSQLValueString($files, "text"),
            GetSQLValueString($id, "int")
          );
          $Resulty = mysql_query($updateSQLyt, $conexion);

          echo '<script type="text/javascript">swal(" OK !", " Documento almacenado correctamente  !", "success");</script>';
        } else {

          echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
        }
      } else {
        echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
      }
    } else {
    }






    if (isset($_GET['e']) && "" != $_GET['e']) {
      $ed = $_GET['e'];
      $eda = explode('-', $ed);
      $iddia = $eda[0];
      $tipoid = $eda[1];
      $updateSQLy = sprintf(
        "UPDATE dia_licencia SET id_tipo_encargo=%s where id_dia_licencia=%s and estado_dia_licencia=1",
        GetSQLValueString($tipoid, "int"),
        GetSQLValueString($iddia, "int")
      );
      $Resulty = mysql_query($updateSQLy, $conexion);
      echo $actualizado;
    } else {
    }







    if ((isset($_POST["aprobacionp"])) && ("" != $_POST["aprobacionp"])) {
      $aproba = intval($_POST["aprobacionp"]);
      $updateSQL33 = sprintf(
        "UPDATE permiso SET aprobacion=%s, motivo=%s, fecha_aprobacion=now() where id_permiso=%s",
        GetSQLValueString($aproba, "int"),
        GetSQLValueString($_POST["motivo"], "text"),
        GetSQLValueString($id, "int")
      );
      $Result = mysql_query($updateSQL33, $conexion);
      echo $actualizado;


      if (1 == $rownvb['aprobacion']) {
        $aprobatext = 'Aprobada';
      } else {
        $aprobatext = 'No aprobada';
      }




      $emailu = $email_notaria;
      $subject = 'Permisos y licencias, TEST';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "Se reviso el permiso y licencia agregado por la Notaria";
      $cuerpo .= '<br>Estado: ' . $aprobatext . '<br>';
      $cuerpo .= '<br>Motivo: ' . $_POST["motivo"] . '<br>';
      $cuerpo .= '<br>Enlace o identificación del permiso: <a href="https://sisg.supernotariado.gov.co/permiso_notarios&' . $id . '.jsp">https://sisg.supernotariado.gov.co/permiso_notarios&' . $id . '.jsp</a><br>';
      $cuerpo .= "<br><br>Notaria : " . $email_notaria . "<br>";
      $cuerpo .= "<br><br><br>";
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= "<br></div><br></div>";
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'cc: miguel.gonzalez@supernotariado.gov.co' . "\r\n";
      $cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";


      mail($emailu, $subject, $cuerpo, $cabeceras);
    } else {
    }







    if ((isset($_POST["table"])) && ($_POST["table"] == "permiso")) {
      $updateSQL = sprintf(
        "UPDATE permiso SET numero_resolucion=%s, id_funcionario=%s, fecha_resolucion=%s, aprobacion=%s, fecha_aprobacion=now(), modificacion=%s where id_permiso=%s",
        GetSQLValueString($_POST["numero_resolucion"], "text"),
        GetSQLValueString($_POST["id_funcionario_notario"], "int"),
        GetSQLValueString($_POST["fecha_resolucion"], "date"),
        GetSQLValueString(1, "int"),
        GetSQLValueString(0, "int"),
        GetSQLValueString($id, "int")
      );
      $Result = mysql_query($updateSQL, $conexion);
      echo $actualizado;
    } else {
    }












    $query_updaten = sprintf(
      "SELECT * FROM permiso, notaria WHERE id_permiso = %s and permiso.id_notaria=notaria.id_notaria and estado_notaria=1 and estado_permiso=1",
      GetSQLValueString($id, "int")
    );
    $updaten = mysql_query($query_updaten, $conexion);
    $row_updaten = mysql_fetch_assoc($updaten);
    $totalRows_updaten = mysql_num_rows($updaten);
    if (0 < $totalRows_updaten) {

      $id_notaria = $row_updaten['id_notaria'];
      $email_notaria = $row_updaten['email_notaria'];
      $nombre_notaria = $row_updaten['nombre_notaria'];
      $id_categoria_notaria = $row_updaten['id_categoria_notaria'];

      $file_acto = $row_updaten['file_acto'];
      $file_acta = $row_updaten['file_acta'];
      if (isset($row_updaten['aprobacion'])) {
        $aprobacion = $row_updaten['aprobacion'];
      } else {
        $aprobacion = 2;
      }
      $id_encargado = $row_updaten['id_funcionario_encargado'];
    } else {
      echo 'No tiene acceso.';
    }

    if (1 == $_SESSION['rol'] or 0 < $nump6 or $id_notaria == $_SESSION['id_vigilado']) {




      if ((isset($_POST["id_tipo_encargo"])) && ($_POST["id_tipo_encargo"] != "") && "" != $_POST["fecha_permiso_desde"]) {


        require_once('pages/validacion_dias.php');




        if ("" != $_POST["fecha_permiso_hasta"]) {


          if (strtotime($_POST["fecha_permiso_hasta"]) > strtotime($_POST["fecha_permiso_desde"])) {



            $begin = new DateTime($_POST["fecha_permiso_desde"]);
            $end = new DateTime($_POST["fecha_permiso_hasta"]);
            $end = $end->modify('+1 day');
            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval, $end);

            foreach ($daterange as $date) {
              $date1 = $date->format("Y-m-d");


              $query_reghx = "SELECT count(id_dia_licencia) as totper FROM dia_licencia, permiso WHERE dia_licencia.id_permiso=permiso.id_permiso and fecha_permiso='$date1' and id_funcionario=" . $id_notario . " and estado_permiso=1 and estado_dia_licencia=1 and id_tipo_encargo<5";
              $reghx = mysql_query($query_reghx, $conexion);
              $row_reghx = mysql_fetch_assoc($reghx);

              if (0 < $row_reghx['totper']) {
                echo '<div style="width:100%;background:#B40404;color:#fff;text-align: center;">No se puede ingresar la fecha9999: ' . $date1 . '.</div>';
              } else {



                $id_tipo_encargo = $_POST['id_tipo_encargo'];
                $valido = permiso($id_notario, $date1, $id_tipo_encargo);

                if (1 == $valido) {

                  $id_funcionario_encargo = $_POST["id_funcionario_encargo"];

                  $insertSQL = sprintf(
                    "INSERT INTO dia_licencia (id_permiso, fecha_permiso, id_tipo_encargo, id_funcionario_encargo, estado_dia_licencia, confirmado) VALUES (%s, %s, %s, %s, %s, %s)",
                    GetSQLValueString($id, "int"),
                    GetSQLValueString($date1, "date"),
                    GetSQLValueString($id_tipo_encargo, "int"),
                    GetSQLValueString($id_funcionario_encargo, "int"),
                    GetSQLValueString(1, "int"),
                    GetSQLValueString(1, "int")
                  );
                  $Result = mysql_query($insertSQL, $conexion);
                  //echo $insertado;
                  echo '<div style="width:100%;background:#00A65A;color:#fff;text-align: center;">Ok ' . $date1 . '.</div>';
                } else {
                  echo $nopermitido;
                }
              }
            }
          } else {
            echo '<script type="text/javascript">swal(" ERROR !", " Las fechas no estan ordenadas. !", "error");</script>';
          }
        } else {



          $infofecha = $_POST["fecha_permiso_desde"];



          $query_reghx = "SELECT count(id_dia_licencia) as totper FROM dia_licencia, permiso WHERE dia_licencia.id_permiso=permiso.id_permiso and fecha_permiso='$infofecha' and id_funcionario=" . $id_notario . " and estado_permiso=1 and estado_dia_licencia=1 and id_tipo_encargo<5 AND hora_desde IS  null ";
          $reghx = mysql_query($query_reghx, $conexion);
          $row_reghx = mysql_fetch_assoc($reghx);

          if (0 < $row_reghx['totper']) {
            echo '<div style="width:100%;background:#B40404;color:#fff;text-align: center;">No se puede ingresar la fecha: ' . $infofecha . '.</div>';
          } else {




            $id_tipo_encargo = $_POST["id_tipo_encargo"];
            $id_funcionario_encargo = $_POST["id_funcionario_encargo"];



            if ("" != $_POST["hora_desde"] && "" != $_POST["hora_hasta"]) {
              $hora_desde = $_POST["hora_desde"];
              $hora_hasta = $_POST["hora_hasta"];
            } else {
              $hora_desde = '';
              $hora_hasta = '';
            }

            $valido = permiso($id_notario, $infofecha, $id_tipo_encargo);



            if (1 == $valido) {
              $insertSQL = sprintf(
                "INSERT INTO dia_licencia (id_permiso, fecha_permiso, hora_desde, hora_hasta, id_tipo_encargo, id_funcionario_encargo, estado_dia_licencia, confirmado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                GetSQLValueString($id, "int"),
                GetSQLValueString($infofecha, "date"),
                GetSQLValueString($hora_desde, "text"),
                GetSQLValueString($hora_hasta, "text"),
                GetSQLValueString($id_tipo_encargo, "int"),
                GetSQLValueString($id_funcionario_encargo, "int"),
                GetSQLValueString(1, "int"),
                GetSQLValueString(1, "int")
              );
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
            } else {
              echo $nopermitido;
            }

            //echo $insertado;
            echo '<div style="width:100%;background:#00A65A;color:#fff;text-align: center;">Ok ' . $infofecha . '.</div>';
          }
        }
      } else {
      }


      if (isset($_POST["borrar_todos_permisos"])) {
        $updateBP = sprintf(
          "UPDATE dia_licencia SET estado_dia_licencia=%s where id_permiso=%s and estado_dia_licencia=1",
          GetSQLValueString(0, "int"),
          GetSQLValueString($id, "int")
        );
        $result = mysql_query($updateBP, $conexion);
        echo $insertado;
      }

?>
      <ol class="breadcrumb">
        <li style="display: flex; justify-content: flex-end;">
          <a href="https://sisg.supernotariado.gov.co/permisos_licencias&<?php echo $id_notaria; ?>.jsp" class="btn btn-default"> <i class="fa fa-arrow-circle-left" style="margin-left: 5px;"></i> Regresar </a>
        </li>
      </ol>

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <?php
                //$query12 = "SELECT count(id_dia_licencia) as totres FROM dia_licencia where id_permiso=".$id." and confirmado=1 and estado_dia_licencia=1";
                $query12 = "SELECT count(id_dia_licencia) as totresaa FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=" . $id_notario . " and YEAR(dia_licencia.fecha_permiso) = " . $anoactualcompleto . " and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1 and dia_licencia.id_tipo_encargo =1 ";
                $res12 = mysql_query($query12);
                $rownes = mysql_fetch_assoc($res12);
                if (isset($rownes['totresaa'])) {
                  echo $rownes['totresaa'];
                } else {
                  echo '0';
                }
                ?>
              </h3>

              <p>Dias de licencias ordinarias durante <?php echo $anoactualcompleto; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>

            <a href="xls/reporte_permiso&<?php echo $id_notario; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
                  $query12a = "SELECT count(id_dia_licencia) as totresa FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=" . $id_notario . " and YEAR(fecha_permiso) = " . $anoactualcompleto . " and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1 and dia_licencia.id_tipo_encargo =2 ";
                  $res12a = mysql_query($query12a);
                  $rownesa = mysql_fetch_assoc($res12a);
                  if (isset($rownesa['totresa'])) {
                    echo $rownesa['totresa'];
                  } else {
                    echo '0';
                  }
                  ?></h3>

              <p>Dias de permiso durante <?php echo $anoactualcompleto; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="xls/reporte_permiso&<?php echo $id_notario; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>





        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <?php
                //$query12a = "SELECT count(id_dia_licencia) as totresa FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=".$id_notario." and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1";
                $query12af = "SELECT count(id_dia_licencia) as totresar FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=" . $id_notario . " and YEAR(fecha_permiso) = " . $anoactualcompleto . " and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1 and dia_licencia.id_tipo_encargo =3 ";

                $res12af = mysql_query($query12af);
                $rownesaf = mysql_fetch_assoc($res12af);
                if (isset($rownesaf['totresar'])) {
                  echo $rownesaf['totresar'];
                } else {
                  echo '0';
                }
                ?></h3>

              <p>Dias de licencias por incapacidad durante el <?php echo $anoactualcompleto; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="xls/reporte_permiso&<?php echo $id_notario; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>

          </div>
        </div>



        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                <?php


                $query12aft = "SELECT count(id_dia_licencia) as totrese FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=" . $id_notario . " and YEAR(fecha_permiso) = " . $anoactualcompleto . " and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1 and dia_licencia.id_tipo_encargo =4 ";

                //$query12a = "SELECT count(id_dia_licencia) as totresar FROM dia_licencia, permiso where dia_licencia.id_tipo_encargo=1 and YEAR(fecha_permiso) = 2019 and permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=".$id_notario." and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1";
                $res12aft = mysql_query($query12aft);
                $rownesaft = mysql_fetch_assoc($res12aft);
                //$infoper= $rownesa['totresar'];
                if (isset($rownesaft['totrese'])) {
                  echo $rownesaft['totrese'];
                } else {
                  echo '0';
                }

                //$noventa=90;
                //$dtt=intval($infoper);
                //$tdis= $noventa - $dtt;
                //echo $tdis;
                ?></h3>
              <p>Dias de licencia especial durante <?php echo $anoactualcompleto; ?> <?php //echo $infoper; 
                                                                                      ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="xls/reporte_permiso&<?php echo $id_notario; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>




          </div>
        </div>


      </div>



      <div class="row">


        <div class="col-md-5">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Ausencias</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">





              <form action="" method="POST" name="form1" onsubmit="return validate();">

                <script>
                  var arraydays = <?PHP
                                  //$query126 = "select fecha_permiso from permiso, dia_licencia where dia_licencia.confirmado=1 and permiso.id_permiso=dia_licencia.id_permiso and permiso.id_funcionario=".$id_notario." and estado_permiso=1 and fecha_permiso like '%$anoactualcompleto%' and hora_desde is null";

                                  $query126 = "SELECT fecha_permiso FROM dia_licencia, permiso where dia_licencia.hora_desde is  null and permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=" . $id_notario . " and dia_licencia.confirmado=1 and dia_licencia.id_tipo_encargo<=4 and estado_dia_licencia=1 and estado_permiso=1";

                                  $result126 = mysql_query($query126);
                                  $totalresult126 = mysql_num_rows($result126);
                                  if (0 < $totalresult126) {
                                    while ($row126 = @mysql_fetch_assoc($result126)) {
                                      $arrayday[] = '"' . $row126['fecha_permiso'] . '"';
                                    }
                                    $string = implode(",", $arrayday);
                                    echo '[' . $string . ']';
                                    mysql_free_result($result126);
                                  } else {
                                    echo '["1940-01-01"]';
                                  }
                                  ?>
                </script>

                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> DIAS DE AUSENCIA Y ENCARGO:</label>

                  <div class="input-group">
                    <div class="input-group-btn">
                      <input type="text" readonly="readonly" required class="form-control datepickera" name="fecha_permiso_desde" placeholder="Dia / Desde">
                    </div>
                    <div class="input-group-btn">
                      <input type="text" readonly="readonly" class="form-control datepickera" id="fecha_permiso_hasta" name="fecha_permiso_hasta" placeholder="Hasta / opcional">
                    </div>
                  </div>
                </div>
                <div class="form-group text-left" id="horas_permiso">
                  <label class="control-label">POR HORAS:</label>

                  <div class="input-group">
                    <div class="input-group-btn">
                      <select class="form-control" name="hora_desde">
                        <option value="" selected>Desde</option>
                        <option value="06:00:00">06:00:00</option>
                        <option value="06:15:00">06:15:00</option>
                        <option value="06:30:00">06:30:00</option>
                        <option value="06:45:00">06:45:00</option>
                        <option value="07:00:00">07:00:00</option>
                        <option value="07:15:00">07:15:00</option>
                        <option value="07:30:00">07:30:00</option>
                        <option value="07:45:00">07:45:00</option>
                        <option value="08:00:00">08:00:00</option>
                        <option value="08:15:00">08:15:00</option>
                        <option value="08:30:00">08:30:00</option>
                        <option value="08:45:00">08:45:00</option>
                        <option value="09:00:00">09:00:00</option>
                        <option value="09:15:00">09:15:00</option>
                        <option value="09:30:00">09:30:00</option>
                        <option value="09:45:00">09:45:00</option>
                        <option value="10:00:00">10:00:00</option>
                        <option value="10:15:00">10:15:00</option>
                        <option value="10:30:00">10:30:00</option>
                        <option value="10:45:00">10:45:00</option>
                        <option value="11:00:00">11:00:00</option>
                        <option value="11:15:00">11:15:00</option>
                        <option value="11:30:00">11:30:00</option>
                        <option value="11:45:00">11:45:00</option>
                        <option value="12:00:00">12:00:00</option>
                        <option value="12:15:00">12:15:00</option>
                        <option value="12:30:00">12:30:00</option>
                        <option value="12:45:00">12:45:00</option>
                        <option value="13:00:00">13:00:00</option>
                        <option value="13:15:00">13:15:00</option>
                        <option value="13:30:00">13:30:00</option>
                        <option value="13:45:00">13:45:00</option>
                        <option value="14:00:00">14:00:00</option>
                        <option value="14:15:00">14:15:00</option>
                        <option value="14:30:00">14:30:00</option>
                        <option value="14:45:00">14:45:00</option>
                        <option value="15:00:00">15:00:00</option>
                        <option value="15:15:00">15:15:00</option>
                        <option value="15:30:00">15:30:00</option>
                        <option value="15:45:00">15:45:00</option>
                        <option value="16:00:00">16:00:00</option>
                        <option value="16:15:00">16:15:00</option>
                        <option value="16:30:00">16:30:00</option>
                        <option value="16:45:00">16:45:00</option>
                        <option value="17:00:00">17:00:00</option>
                        <option value="17:15:00">17:15:00</option>
                        <option value="17:30:00">17:30:00</option>
                        <option value="17:45:00">17:45:00</option>
                        <option value="18:00:00">18:00:00</option>
                        <option value="18:15:00">18:15:00</option>
                        <option value="18:30:00">18:30:00</option>
                        <option value="18:45:00">18:45:00</option>
                        <option value="19:00:00">19:00:00</option>
                        <option value="19:15:00">19:15:00</option>
                        <option value="19:30:00">19:30:00</option>
                        <option value="19:45:00">19:45:00</option>
                        <option value="20:00:00">20:00:00</option>
                        <option value="20:15:00">20:15:00</option>
                        <option value="20:30:00">20:30:00</option>
                        <option value="20:45:00">20:45:00</option>
                        <option value="21:00:00">21:00:00</option>
                        <option value="21:15:00">21:15:00</option>
                        <option value="21:30:00">21:30:00</option>
                        <option value="21:45:00">21:45:00</option>
                        <option value="22:00:00">22:00:00</option>
                      </select>
                    </div>
                    <div class="input-group-btn">
                      <select class="form-control" name="hora_hasta">
                        <option value="" selected>Hasta</option>
                        <option value="06:00:00">06:00:00</option>
                        <option value="06:15:00">06:15:00</option>
                        <option value="06:30:00">06:30:00</option>
                        <option value="06:45:00">06:45:00</option>
                        <option value="07:00:00">07:00:00</option>
                        <option value="07:15:00">07:15:00</option>
                        <option value="07:30:00">07:30:00</option>
                        <option value="07:45:00">07:45:00</option>
                        <option value="08:00:00">08:00:00</option>
                        <option value="08:15:00">08:15:00</option>
                        <option value="08:30:00">08:30:00</option>
                        <option value="08:45:00">08:45:00</option>
                        <option value="09:00:00">09:00:00</option>
                        <option value="09:15:00">09:15:00</option>
                        <option value="09:30:00">09:30:00</option>
                        <option value="09:45:00">09:45:00</option>
                        <option value="10:00:00">10:00:00</option>
                        <option value="10:15:00">10:15:00</option>
                        <option value="10:30:00">10:30:00</option>
                        <option value="10:45:00">10:45:00</option>
                        <option value="11:00:00">11:00:00</option>
                        <option value="11:15:00">11:15:00</option>
                        <option value="11:30:00">11:30:00</option>
                        <option value="11:45:00">11:45:00</option>
                        <option value="12:00:00">12:00:00</option>
                        <option value="12:15:00">12:15:00</option>
                        <option value="12:30:00">12:30:00</option>
                        <option value="12:45:00">12:45:00</option>
                        <option value="13:00:00">13:00:00</option>
                        <option value="13:15:00">13:15:00</option>
                        <option value="13:30:00">13:30:00</option>
                        <option value="13:45:00">13:45:00</option>
                        <option value="14:00:00">14:00:00</option>
                        <option value="14:15:00">14:15:00</option>
                        <option value="14:30:00">14:30:00</option>
                        <option value="14:45:00">14:45:00</option>
                        <option value="15:00:00">15:00:00</option>
                        <option value="15:15:00">15:15:00</option>
                        <option value="15:30:00">15:30:00</option>
                        <option value="15:45:00">15:45:00</option>
                        <option value="16:00:00">16:00:00</option>
                        <option value="16:15:00">16:15:00</option>
                        <option value="16:30:00">16:30:00</option>
                        <option value="16:45:00">16:45:00</option>
                        <option value="17:00:00">17:00:00</option>
                        <option value="17:15:00">17:15:00</option>
                        <option value="17:30:00">17:30:00</option>
                        <option value="17:45:00">17:45:00</option>
                        <option value="18:00:00">18:00:00</option>
                        <option value="18:15:00">18:15:00</option>
                        <option value="18:30:00">18:30:00</option>
                        <option value="18:45:00">18:45:00</option>
                        <option value="19:00:00">19:00:00</option>
                        <option value="19:15:00">19:15:00</option>
                        <option value="19:30:00">19:30:00</option>
                        <option value="19:45:00">19:45:00</option>
                        <option value="20:00:00">20:00:00</option>
                        <option value="20:15:00">20:15:00</option>
                        <option value="20:30:00">20:30:00</option>
                        <option value="20:45:00">20:45:00</option>
                        <option value="21:00:00">21:00:00</option>
                        <option value="21:15:00">21:15:00</option>
                        <option value="21:30:00">21:30:00</option>
                        <option value="21:45:00">21:45:00</option>
                        <option value="22:00:00">22:00:00</option>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE AUSENCIA:</label>
                  <select class="form-control" name="id_tipo_encargo" required>
                    <option value=""></option>
                    <?php
                    $queryne = sprintf("SELECT * FROM tipo_encargo where inicial=1 and estado_tipo_encargo=1");
                    $selectne = mysql_query($queryne, $conexion);
                    $rowne = mysql_fetch_assoc($selectne);
                    $totalRowsne = mysql_num_rows($selectne);
                    if (0 < $totalRowsne) {
                      do {
                        echo '<option value="' . $rowne['id_tipo_encargo'] . '" ';

                        echo '>' . $rowne['nombre_tipo_encargo'] . '</option>';
                      } while ($rowne = mysql_fetch_assoc($selectne));
                    } else {
                      echo '';
                    }
                    mysql_free_result($selectne);
                    ?></option>
                  </select>
                </div>


                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> ENCARGADO:
                    <a href="personal_notaria&<?php echo $id_notaria; ?>.jsp" target="_blank"><button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-plus-sign"></span>
                        Agregar personal
                      </button></a>


                  </label>
                  <select class="form-control" name="id_funcionario_encargo" required>
                    <option></option>

                    <?php
                    $queryn = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_notaria_f=" . $id_notaria . " and id_tipo_oficina=3 and estado_funcionario=1 group by id_funcionario");
                    $selectn = mysql_query($queryn, $conexion);
                    $rown = mysql_fetch_assoc($selectn);
                    $totalRowsn = mysql_num_rows($selectn);
                    if (0 < $totalRowsn) {
                      do {
                        echo '<option value="' . $rown['id_funcionario'] . '" ';

                        echo '>' . $rown['nombre_funcionario'] . '</option>';
                      } while ($rown = mysql_fetch_assoc($selectn));
                    } else {
                      echo '';
                    }
                    mysql_free_result($selectn);


                    ?>

                  </select>
                </div>

                <?php if (1 == $aprobacion) {
                } else { ?>
                  <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                      <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <button type="submit" class="btn btn-success">
                      <span class="glyphicon glyphicon-ok"></span> Crear </button>
                  </div>

                <?php } ?>

              </form>


            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Documentos</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">


              <form action="" method="POST" name="form34563451" enctype="multipart/form-data">

                <div class="form-group text-left">
                  <label class="control-label"> ACTO ADMINISTRATIVO:</label>

                  <a href="filesnr/documento_permiso/<?php echo $file_acto; ?>" target="_blank"><img src="images/pdf.png"> Acto</a>
                </div>

                <br>claudia.varonclaudia.varonclaudia.varon


                <?php

                if ((isset($_POST["id_sub_tipo_adjunto"])) && ($_POST["id_sub_tipo_adjunto"] != "")) {

                  $tamano_archivo = 11534336;
                  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
                  $formato_archivo = array('pdf');


                  $directoryftp = "filesnr/documento_permiso/";


                  $ruta_archivo = 'permiso-' . $id . '-' . date("YmdGis");



                  $archivo = $_FILES['file']['tmp_name'];
                  $tam_archivo = filesize($archivo);
                  $tam_archivo2 = $_FILES['file']['size'];
                  $nombrefile = strtolower($_FILES['file']['name']);
                  $info = pathinfo($nombrefile);
                  $extension = $info['extension'];
                  $array_archivo = explode('.', $nombrefile);
                  $extension2 = end($array_archivo);



                  if ($tamano_archivo >= intval($tam_archivo2)) {

                    if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
                      $files = $ruta_archivo . '.' . $extension;
                      $mover_archivos = move_uploaded_file($archivo, $directoryftp . $files);
                      //chmod($files,0777);
                      $nombrebre_orig = ucwords($nombrefile);



                      $insertSQL = sprintf(
                        "INSERT INTO documento_permiso (id_funcionario, id_tipo_adjunto, id_sub_tipo_adjunto, id_permiso, nombre_documento_permiso, fecha_subida, estado_documento_permiso) VALUES (%s, %s, %s, %s, %s, now(), %s)",
                        GetSQLValueString($id_notario, "int"),
                        GetSQLValueString(1, "int"),
                        GetSQLValueString($_POST['id_sub_tipo_adjunto'], "int"),
                        GetSQLValueString($id, "int"),
                        GetSQLValueString($files, "text"),
                        GetSQLValueString(1, "int")
                      );
                      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

                      echo '<script type="text/javascript">swal(" OK !", " Documento almacenado correctamente  !", "success");</script>';
                    } else {

                      echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
                    }
                  } else {
                    echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
                  }
                } else {
                }

                ?>
                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE DOCUMENTO:</label>
                  <select class="form-control" name="id_sub_tipo_adjunto" required>
                    <option value=""></option>
                    <option value="45">ACTA DE POSESION</option>
                    <!-- <php 
                    $query = sprintf("SELECT id_sub_tipo_adjunto, nombre_sub_tipo_adjunto FROM sub_tipo_adjunto where id_tipo_adjunto=1 and estado_sub_tipo_adjunto=1 order by id_sub_tipo_adjunto"); 
                    $select = mysql_query($query, $conexion);
                    $row = mysql_fetch_assoc($select);
                    $totalRows = mysql_num_rows($select);
                    if (0<$totalRows){
                    do {
                      echo '<option value="'.$row['id_sub_tipo_adjunto'].'">'.$row['nombre_sub_tipo_adjunto'].'</option>';
                      } while ($row = mysql_fetch_assoc($select)); 
                    } else {}	 
                    mysql_free_result($select);
                    ?> -->
                  </select>
                </div>

                <div class="form-group text-left">
                  <label class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO:</label>
                  <input type="file" name="file" value="" required>
                </div>


                <?php if (1 == $aprobacion) {
                } else { ?>
                  <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                      <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <button type="submit" class="btn btn-success">
                      <input type="hidden" name="table" value="dia_licencia">
                      <span class="glyphicon glyphicon-ok"></span> Subir </button>
                  </div>
                <?php } ?>
              </form>
              <HR>


              <?php

              $query_regh = "SELECT * FROM documento_permiso, sub_tipo_adjunto WHERE documento_permiso.id_sub_tipo_adjunto=sub_tipo_adjunto.id_sub_tipo_adjunto and documento_permiso.id_permiso =" . $id . " and documento_permiso.estado_documento_permiso=1";
              $regh = mysql_query($query_regh, $conexion);
              $row_regh = mysql_fetch_assoc($regh);
              $totalRows_regh = mysql_num_rows($regh);
              if (0 < $totalRows_regh) {
                do {

                  echo '<a href="filesnr/documento_permiso/' . $row_regh['nombre_documento_permiso'] . '" target="_blank">';
                  echo '<img src="images/pdf.png"> <span title="' . $row_regh['fecha_subida'] . '">' . $row_regh['nombre_sub_tipo_adjunto'] . '</span>';
                  echo '</a>';



                  if (1 == $aprobacion) {
                  } else {
                    echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_permiso" id="' . $row_regh['id_documento_permiso'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
                  }

                  echo '<br />';
                } while ($row_regh = mysql_fetch_assoc($regh));
              } else {
                echo '';
              }

              ?>

            </div>
          </div>
        </div>



        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Revisión por la SNR.</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">

              <?php
              if (isset($_SESSION['id_vigilado']) && "" != $_SESSION['id_vigilado']) {

                if (1 == $aprobacion) {
                  echo 'Aprobado';
                } else if (0 == $aprobacion) {
                  echo 'No aprobado';
                } else if (2 == $aprobacion) {
                  echo 'En revisión';
                } else {
                }
              } else {

              ?>



                <form action="" method="POST" name="form435345345tretret63451">
                  <div class="form-group text-left">
                    <label class="control-label"> APROBACIÓN (<?php echo $realdate; ?>):</label>
                    <select class="form-control" name="aprobacionp" required>

                      <?php


                      if (1 == $aprobacion) {
                        echo '<option value="1" selected>Si</option>';
                      } else if (0 == $aprobacion) {
                        echo '<option value="0" selected>No</option>';
                      } else if (2 == $aprobacion) {
                        echo '<option selected></option>';
                      } else {
                      }


                      ?>
                      <option value="1">Si</option>
                      <option value="0">No</option>

                    </select>
                  </div>


                  <div class="form-group text-left">
                    <label class="control-label"> MOTIVO:</label>
                    <textarea class="form-control" name="motivo" required><?php echo $motivo;  ?></textarea>
                  </div>


                  <?php if (1 == $aprobacion) {
                  } else { ?>
                    <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                      <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-ok"></span> Enviar </button>
                    </div>
                  <?php } ?>
                </form>

              <?php } ?>

            </div>
          </div>



        </div>
      </div>






      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <?php


            $query = sprintf("SELECT * FROM dia_licencia, tipo_encargo where dia_licencia.id_tipo_encargo=tipo_encargo.id_tipo_encargo and id_permiso=" . $id . " and dia_licencia.confirmado=1 and estado_dia_licencia=1");
            $select = mysql_query($query, $conexion) or die(mysql_error());
            $row = mysql_fetch_assoc($select);
            $totalRows = mysql_num_rows($select);
            if (0 < $totalRows) {
            ?>
              <div class="box-header with-border">
                <form action="" method="post" onsubmit="return confirm('¿Estás seguro de que deseas borrar todos los permisos?');">
                  <div class="text-right">
                    <input type="hidden" name="borrar_todos_permisos">
                    <button type="submit" class="btn btn-danger">Borrar Todos los Permisos</button>
                  </div>
                </form>
                <br>
                <table class="table table-striped table-bordered table-hover" id="pqrsvigilados">
                  <thead>
                    <tr align='center' valign='middle'>
                      <th>Fecha</th>
                      <th>Dias de permiso / licencia</th>
                      <th>Tiempo</th>
                      <th>Tipo de encargo</th>
                      <th>Encargado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    do {
                      echo '<tr>';
                      echo '<td>' . $row['fecha_permiso'] . '- ' . $row['id_dia_licencia'] . '</td>';
                      echo '<td>';
                      $time = strtotime($row['fecha_permiso']);
                      setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
                      echo ucfirst(utf8_encode(strftime("%A %d de %B del %Y", $time)));
                      echo '</td>';
                      echo '<td>';
                      if (isset($row['hora_desde'])) {
                        echo '' . $row['hora_desde'] . ' - ' . $row['hora_hasta'] . '';
                      } else {
                      }
                      echo '</td>';
                      echo '<td>' . $row['nombre_tipo_encargo'] . '</td>';
                      echo '<td>';
                      echo quees('funcionario', $row['id_funcionario_encargo']);
                      echo '</td>';
                      echo '<td>';
                      if (1 == $aprobacion) {
                      } else {
                        if (1 == 1) {
                          echo ' <a href="permiso&' . $id . '&' . $row['id_dia_licencia'] . '-5.jsp">Revocación</a> &nbsp; ';
                          echo ' <a href="permiso&' . $id . '&' . $row['id_dia_licencia'] . '-6.jsp">Modificación</a>  &nbsp; ';
                          echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="dia_licencia" id="' . $row['id_dia_licencia'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
                        } else {
                        }
                      }

                      echo '</td>';
                    } while ($row = mysql_fetch_assoc($select));
                    mysql_free_result($select);
                    ?>
                  </tbody>
                </table>
                <script>
                  $(document).ready(function() {
                    $('#pqrsvigilados').DataTable({
                      "language": {
                        "url": "/json/tablacastellano.json"
                      },
                      "aaSorting": [
                        [0, "asc"]
                      ]
                    });
                  });
                </script>
              </div>
          </div>
        </div>
      </div>

<?php
              mysql_free_result($select);
            } else {
            }
          } else {
            echo 'Code: 3';
          }
        } else {
          echo 'Code: 2';
        }
      } else {
        echo 'Code: 1';
      }
?>
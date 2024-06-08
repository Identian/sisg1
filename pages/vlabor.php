<?php
$nump153 = privilegios(153, $_SESSION['snr']);
if (3 > $_SESSION['snr_tipo_oficina']) {



  if (isset($_POST["idvlabor"]) && "" != $_POST["idvlabor"]) {
    $tamano_archivo = 17301504;
    //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
    $formato_archivo = array('pdf');

    $directoryftp = "filesnr/vlabor/";

    if (isset($_FILES['file']['name']) && "" != $_FILES['file']['name']) {

      $ruta_archivo = 'vlabor-' . $_SESSION['snr'] . '' . date("YmdGis");

      $archivo = $_FILES['file']['tmp_name'];
      $tam_archivo = filesize($archivo);
      $tam_archivo2 = $_FILES['file']['size'];
      $nombrefile = strtolower($_FILES['file']['name']);
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
          $mover_archivos = move_uploaded_file($archivo, $directoryftp . $files);
          //chmod($files,0777);
          $nombrebre_orig = ucwords($nombrefile);

          $updateSQL = sprintf(
            "UPDATE vlabor SET url=%s WHERE id_vlabor=%s",
            GetSQLValueString($files, "text"),
            GetSQLValueString(intval($_POST['idvlabor']), "int")
          );
          $Result1 = mysql_query($updateSQL, $conexion);

          echo $insertado;
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
  }

  if ((isset($_POST["contacto_vlabor"])) && ("" != $_POST["contacto_vlabor"])) {

    $funcionario = $_SESSION['snr'];

    $insertSQL = sprintf(
      "INSERT INTO vlabor (nombre_vlabor, id_funcionario, contacto_vlabor, transporte, origen, restriccion, estado_vlabor) 
      VALUES (%s, %s, %s, %s, %s, %s, %s)",
      GetSQLValueString($_POST["nombre_vlabor"], "text"),
      GetSQLValueString($funcionario, "int"),
      GetSQLValueString($_POST["contacto_vlabor"], "int"),
      GetSQLValueString($_POST["transporte"], "text"),
      GetSQLValueString($_POST["origen"], "text"),
      GetSQLValueString($_POST["restriccion"], "text"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);


    echo $insertado;


    $updateSQL = sprintf(
      "UPDATE funcionario SET  celular_funcionario=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString($_POST["celular_funcionario"], "text"),
      GetSQLValueString($funcionario, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);


    $emailur2 = $_SESSION['snr_correo'];
    $subject = 'CONFIRMACIÓN DE REGISTRO PARA UNA VIDA DE LABOR';
    $cuerpo2 = '';
    $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
    $cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que se ha registrado correctamente el registro a una vida de labor.<br><br>';
    $cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
    $cuerpo2 .= "<br></div><br></div>";
    $cabeceras = '';
    $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
    $cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
    $cabeceras .= "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($emailur2, $subject, $cuerpo2, $cabeceras);
  } else {
  }
?>


  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo existencia('vlabor'); ?></h3>
          <p>Registros</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>


    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>20<?php echo $anoactual; ?></h3>

          <p>Año</p>
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
          <h3>5</h3>
          <p>Regionales</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>195</h3>
          <p>Oficinas de registro</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-md-12">
            <p>
              <b>Toda una vida de Labor</b>
            </p>
            <?php
            $realdatecompleto = date('Y-m-d H:i:s');
            $fecha_actual = strtotime($realdatecompleto);
            $fecha_inicio = strtotime("2023-09-01 08:00:00");
            $fecha_limite = strtotime("2023-09-07 14:00:00");
            // || $fecha_actual <= $fecha_limite and 3 > $_SESSION['snr_tipo_oficina'] and 5 > $_SESSION['snr_grupo_cargo']
            if (1==$_SESSION['rol'] || 8959==$_SESSION['snr'] || 1980==$_SESSION['snr'] || 10873 == $_SESSION['snr']) {
            ?>

              <h3 class="box-title">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
                  Nuevo
                </button> Hasta 2023-sep-07 14:00:00 - Se muestra para Cindy, Viviana
              </h3>

            <?php

            } else {
            }
            ?>
          </div>


        </div> <!-- FINAL box-header with-border -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table display" id="inforesoluciones" cellspacing="0" width="100%">
              <thead>
                <tr align="center" valign="middle">
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Cedula</th>
                  <th>Celular</th>
                  <th>Area</th>
                  <th>Oficina</th>
                  <th>Para emergencia</th>
                  <th>Contacto</th>
                  <th>Transporte</th>
                  <th>Origen</th>
                  <th>Restricción A.</th>
                  <th>Doc</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (1 == $_SESSION['rol'] or 0 < $nump153) {
                  $query4 = "SELECT * from vlabor, funcionario where vlabor.id_funcionario=funcionario.id_funcionario and estado_vlabor=1 ORDER BY id_vlabor desc  ";
                } else {
                  $query4 = "SELECT * from vlabor, funcionario where vlabor.id_funcionario=funcionario.id_funcionario and estado_vlabor=1 and funcionario.id_funcionario=" . $_SESSION['snr'] . " ORDER BY id_vlabor desc  ";
                }
                $result = $mysqli->query($query4);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                ?>
                  <tr>
                    <?php
                    $id_res = $row['id_vlabor'];

                    echo '<td><a href="usuario&' . $row['id_funcionario'] . '.jsp"  target="_blank">' . $row['nombre_funcionario'] . '</a></td>';
                    echo '<td>';
                    echo $row['correo_funcionario'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['cedula_funcionario'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['celular_funcionario'];
                    echo '</td>';
                    if (1 == $row['id_tipo_oficina']) {
                      echo '<td>Nivel central</td>';
                      echo '<td>' . quees('grupo_area', $row['id_grupo_area']) . '</td>';
                    } else {
                      echo '<td>' . regional($row['id_oficina_registro']) . '</td>';
                      echo '<td>' . quees('oficina_registro', $row['id_oficina_registro']) . '</td>';
                    }
                    echo '<td>';
                    echo $row['nombre_vlabor'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['contacto_vlabor'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['transporte'];
                    echo '</td>';

                    echo '<td>';
                    echo $row['origen'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['restriccion'];
                    echo '</td>';

                    echo '<td>';
                    if (isset($row['url']) && "" != $row['url']) {
                      echo '<a href="filesnr/vlabor/' . $row['url'] . '" target="_blank">Documento</a>';
                    } else {
                      echo  '<a href="" title="Anexar documento" id="' . $id_res . '" class="ver_vlabor" data-toggle="modal" data-target="#popupvlabor"><button class="btn btn-xs btn-warning">Anexar</button></a> ';
                    }
                    echo '</td>';

                    echo '<td>';
                    if (1 == $_SESSION['rol'] or 0 < $nump153) {
                      echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="vlabor" id="' . $id_res . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
                    } else {
                    }
                    echo '</td>';
                    ?>

                  </tr>
                <?php }
                $result->free();
                ?>
              </tbody>
            </table>

            <script>
              $(document).ready(function() {
                $('#inforesoluciones').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                    // 'copyHtml5',
                    'excelHtml5'

                    // 'pdfHtml5'
                  ],
                  "lengthMenu": [
                    [50, 100, 200, 300, 500],
                    [50, 100, 200, 300, 500]
                  ],
                  "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [1, "desc"]
                  ]
                });
              });
            </script>

          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->

      </div> <!-- FINAL PRIMARY -->
    </div> <!-- FINAL DE COL MD 12 -->
  </div><!-- FINAL DE ROW -->




  <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
        </div>
        <div class="modal-body">
          <form action="" method="POST" name="for54354r653454345345464324324563m1" enctype="multipart/form-data">

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label>
              <input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Cédula:</label>
              <input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Telefono Celular:</label>
              <input type="text" class="form-control numero" name="celular_funcionario" placeholder="Solo números" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre de una persona para emergencias:</label>
              <input type="text" class="form-control" name="nombre_vlabor" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Telefono de contacto de la persona para emergencias:</label>
              <input type="text" class="form-control numero" name="contacto_vlabor" placeholder="Solo números" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Transporte para el evento:</label>
              <select class="form-control" name="transporte" required>
                <option></option>
                <option>Transporte con vehiculo propio</option>
                <option>Transporte con bus intermunicipal</option>
                <option>Transporte aéreo</option>
              </select>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Ciudad de origen:</label>
              <input type="text" class="form-control" name="origen" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Restricción alimentaria:</label>
              <input type="text" class="form-control" name="restriccion" required>
            </div>

            <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-ok"></span> Crear </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade bd-example-modal-lg" id="popupvlabor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel2"><b>Anexar documento</b><span style="font-weight: bold;"></span></h4>
        </div>
        <div id="respuestavlabor" class="modal-body">

        </div>
      </div>
    </div>
  </div>


<?php
} else {
  echo 'No tiene acceso. ';
} ?>
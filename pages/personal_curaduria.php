<?php
$nump12 = privilegios(12, $_SESSION['snr']);

if ((1 == $_SESSION['rol'] or 0 < $nump12) && isset($_GET['i'])) {
  $id = $_GET['i'];
  $percur = 1;
} else {
  $id = $_SESSION['id_vigiladocurador'];
  $percur = permisopruebacuraduria($id);
}

if (isset($_POST["id_curador"]) && "" != $_POST["id_curador"]) {
  $id_curador = intval($_POST["id_curador"]);
  $idfuncionario = intval($_POST["idfuncionario"]);
  $updated7787 = sprintf(
    "UPDATE relacion_curaduria set id_curador=%s where id_funcionario=%s and id_curaduria=%s",
    GetSQLValueString($id_curador, "int"),
    GetSQLValueString($idfuncionario, "int"),
    GetSQLValueString($id, "int")
  );
  $Resultpd777 = mysql_query($updated7787, $conexion);
}

if (isset($_POST["fecha_salida"]) && "" != $_POST["fecha_salida"]) {
  $person = intval($_POST["person"]);
  $updated7789 = sprintf(
    "UPDATE relacion_curaduria set estado_activo=0 where id_funcionario=%s",
    GetSQLValueString($person, "int")
  );
  $Resultpd779 = mysql_query($updated7789, $conexion);
  $updated778 = sprintf(
    "UPDATE funcionario set fecha_salida=%s where id_funcionario=%s",
    GetSQLValueString($_POST["fecha_salida"], "date"),
    GetSQLValueString($person, "int")
  );
  $Resultpd77 = mysql_query($updated778, $conexion);
}

if (isset($_POST["reglamentacion_local"]) && "" != $_POST["reglamentacion_local"]) {
  $identificadora2 = $id . '-regla' . $identi;
  $tamano_archivo2 = 15534336;
  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
  $formato_archivo2 = array('pdf');
  $directoryftp2 = "filesnr/curadurias/";
  if (isset($_FILES['fileacta']['name']) && "" != $_FILES['fileacta']['name']) {
    $ruta_archivo2 = $identificadora2;
    $archivo2 = $_FILES['fileacta']['tmp_name'];
    $tam_archivo2 = filesize($archivo2);
    $tam_archivo22 = $_FILES['fileacta']['size'];
    $nombrefile2 = strtolower($_FILES['fileacta']['name']);
    $info2 = pathinfo($nombrefile2);
    $extension2 = $info2['extension'];
    $array_archivo2 = explode('.', $nombrefile2);
    $extension22 = end($array_archivo2);
    if ($tamano_archivo2 >= intval($tam_archivo22)) {
      if (($extension22 == $extension2)) {
        $filesacta1 = $ruta_archivo2 . '.' . $extension2;
        $mover_archivos2 = move_uploaded_file($archivo2, $directoryftp2 . $filesacta1);
        $nombrebre_orig2 = ucwords($nombrefile2);
      } else {
        $filesacta1 = '';
      }
    } else {
      $filesacta1 = '';
    }
  } else {
    $filesacta1 = '';
  }

  $updated = sprintf(
    "UPDATE curaduria set reglamentacion_local=%s, url_reglamentacion_local=%s where id_curaduria=%s",
    GetSQLValueString($_POST["reglamentacion_local"], "text"),
    GetSQLValueString($filesacta1, "text"),
    GetSQLValueString($id, "int")
  );
  $Resultpd = mysql_query($updated, $conexion);
  echo $actualizado;
}

if (isset($id) && 0 < $percur) {
  if ((isset($_POST["cedula_funcionario"])) && ($_POST["cedula_funcionario"] != "")) {
    /*
    $tamano_archivo=1048576; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15
    //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
    $formato_archivo = array('pdf');
    $directoryftp="filesnr/hv/";

    if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

    $ruta_archivo = 'snr-'.$_POST["cedula_funcionario"].'-'.$identi;

    $archivo = $_FILES['file']['tmp_name'];
    $tam_archivo= filesize($archivo);
    $tam_archivo2= $_FILES['file']['size'];
    $nombrefile = strtolower($_FILES['file']['name']);
    //echo '<script>alert("'.$nombrefile.'");</script>';
    $info = pathinfo($nombrefile); 

    $extension=$info['extension'];

    $array_archivo = explode('.',$nombrefile);
    $extension2= end($array_archivo);


    if ($tamano_archivo>=intval($tam_archivo2)) {
      
    if (($extension2==$extension) ) { 
      $files = $ruta_archivo.'.'.$extension;
      $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
      chmod($files,0777);
      $nombrebre_orig= ucwords($nombrefile);
      
      
      } else {
    $files='';	  
      echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
      }
    } else { 
    $files='';	
    echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
        }
        

    } else { 
    $files='';	
      }
    */

    $ced_fu = trim($_POST["cedula_funcionario"]);
    $selecty = mysql_query("select id_funcionario from funcionario where cedula_funcionario='$ced_fu' and estado_funcionario=1", $conexion);
    $rowy = mysql_fetch_assoc($selecty);
    $totalRowsy = mysql_num_rows($selecty);
    if (0 < $totalRowsy) {
      if ("Otra" == $_POST["profesion"]) {
        $profe = $_POST["otra_profesion"];
      } else {
        $profe = $_POST["profesion"];
      }

      $update = sprintf(
        "UPDATE funcionario set nombre_funcionario=%s, sexo=%s, correo_funcionario=%s, 
        clave_funcionario=%s, fecha_ingreso=%s, fecha_salida=%s, profesion=%s, telefono_funcionario=%s, id_rol=%s, id_grupo_area=%s, 
        id_cargo_nomina_encargo=%s, id_cargo_nomina_titular=%s, desc_cargo=%s, 
        id_nivel_academico=%s, id_tipo_oficina=%s, id_cargo=%s, id_vinculacion=%s, foto_funcionario=%s, hv_funcionario=%s, 
        lider_pqrs=%s where cedula_funcionario=%s and id_cargo!=1",

        GetSQLValueString($_POST["nombre_funcionario"], "text"),
        GetSQLValueString($_POST["sexo"], "text"),
        GetSQLValueString(trim($_POST["correo_funcionario"]), "text"),
        GetSQLValueString(md5('12345'), "text"),
        GetSQLValueString($_POST["fecha_ingreso"], "date"),
        GetSQLValueString(NULL, "date"),
        GetSQLValueString($profe, "text"),
        GetSQLValueString($_POST["telefono"], "int"),
        GetSQLValueString(3, "int"),
        GetSQLValueString(301, "int"),
        GetSQLValueString(44, "int"),
        GetSQLValueString(44, "int"),
        GetSQLValueString($_POST["cargo"], "text"),
        GetSQLValueString($_POST["id_nivel_academico"], "int"),
        GetSQLValueString(4, "int"),
        GetSQLValueString(3, "int"),
        GetSQLValueString($_POST["id_vinculacion"], "int"),
        GetSQLValueString('avatar.png', "text"),
        GetSQLValueString($files, "text"),
        GetSQLValueString(0, "int"),
        GetSQLValueString($_POST["cedula_funcionario"], "text")
      );
      $Resultp = mysql_query($update, $conexion);

      $idfun = buscarcampo('funcionario', 'id_funcionario', 'cedula_funcionario=' . $ced_fu);
      $query5 = "SELECT count(id_funcionario) as countIRC FROM relacion_curaduria WHERE id_curaduria=$id and id_funcionario=$idfun and estado_relacion_curaduria=1";
      $result5 = $mysqli->query($query5);
      $row5 = $result5->fetch_array(MYSQLI_ASSOC);
      if (0 < $row5['countIRC']) {
        echo sweetAlert("Alerta", "Personal Ya creado validar nuevamente", "warning");
      } else {
        $select = mysql_query("SELECT id_funcionario FROM funcionario where cedula_funcionario=" . $ced_fu . " limit 1", $conexion);
        $row = mysql_fetch_assoc($select);
        $idfunc = intval($row['id_funcionario']);
        $insertSQL22 = sprintf(
          "INSERT INTO relacion_curaduria (id_funcionario, id_curaduria, tipo_relacion, estado_activo, estado_relacion_curaduria) VALUES (%s, %s, %s, %s, %s)",
          GetSQLValueString($idfunc, "int"),
          GetSQLValueString($id, "int"),
          GetSQLValueString('GRUPO INTERDISCIPLINARIO', "text"),
          GetSQLValueString(1, "int"),
          GetSQLValueString(1, "int")
        );
        $Result = mysql_query($insertSQL22, $conexion);
        mysql_free_result($select);
        echo $insertado;
        echo '<meta http-equiv="refresh" content="0;URL=./personal_curaduria&' . $id . '.jsp" />';
      }
      
    } else {

      $insertSQL = sprintf(
        "INSERT INTO funcionario (id_tipo_documento, cedula_funcionario, nombre_funcionario, sexo, correo_funcionario, 
      clave_funcionario, fecha_ingreso, profesion, telefono_funcionario, id_rol, id_grupo_area, 
      id_cargo_nomina_encargo, id_cargo_nomina_titular, desc_cargo, 
      id_nivel_academico, id_tipo_oficina, id_cargo, id_vinculacion, foto_funcionario, hv_funcionario, 
      lider_pqrs, estado_funcionario) 
          VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
        GetSQLValueString(1, "int"),
        GetSQLValueString(trim($_POST["cedula_funcionario"]), "text"),
        GetSQLValueString($_POST["nombre_funcionario"], "text"),
        GetSQLValueString($_POST["sexo"], "text"),
        GetSQLValueString(trim($_POST["correo_funcionario"]), "text"),
        GetSQLValueString(md5('12345'), "text"),
        GetSQLValueString($_POST["fecha_ingreso"], "date"),
        GetSQLValueString($_POST["profesion"], "text"),
        GetSQLValueString($_POST["telefono"], "int"),
        GetSQLValueString(3, "int"),
        GetSQLValueString(301, "int"),
        GetSQLValueString(44, "int"),
        GetSQLValueString(44, "int"),
        GetSQLValueString('Curadurias', "text"),
        GetSQLValueString($_POST["id_nivel_academico"], "int"),
        GetSQLValueString(4, "int"),
        GetSQLValueString(3, "int"),
        GetSQLValueString($_POST["id_vinculacion"], "int"),
        GetSQLValueString('avatar.png', "text"),
        GetSQLValueString($files, "text"),
        GetSQLValueString(0, "int"),
        GetSQLValueString(1, "int")
      );
      $Result = mysql_query($insertSQL, $conexion);

      $select = mysql_query("SELECT id_funcionario FROM funcionario where cedula_funcionario=" . $ced_fu . " limit 1", $conexion);
      $row = mysql_fetch_assoc($select);
      $idfunc = intval($row['id_funcionario']);
      $insertSQL22 = sprintf(
        "INSERT INTO relacion_curaduria (id_funcionario, id_curaduria, tipo_relacion, estado_activo, estado_relacion_curaduria) VALUES (%s, %s, %s, %s, %s)",
        GetSQLValueString($idfunc, "int"),
        GetSQLValueString($id, "int"),
        GetSQLValueString('GRUPO INTERDISCIPLINARIO', "text"),
        GetSQLValueString(1, "int"),
        GetSQLValueString(1, "int")
      );
      $Result = mysql_query($insertSQL22, $conexion);
      mysql_free_result($select);
      
      echo $insertado;

      $emailu = 'hv.personalcurb@supernotariado.gov.co';
      $subject = 'Nuevo usuario para Curadurias';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que se ha creado un nuevo usuario.<br>";
      $cuerpo .= "<br><br>";
      $cuerpo .= '<a href="https://sisg.supernotariado.gov.co/personal_curaduria' . $id . '.jsp">Ver registro.</a>';
      $cuerpo .= "<br><br>";
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= "<br></div><br></div>";
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      mail($emailu, $subject, $cuerpo, $cabeceras);

      echo '<meta http-equiv="refresh" content="0;URL=./personal_curaduria&' . $id . '.jsp" />';
    }

  } else {
  } ?>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">

          <?php
          $queryop = sprintf("SELECT reglamentacion_local, url_reglamentacion_local FROM curaduria where id_curaduria=" . $id . "");
          $selectop = mysql_query($queryop, $conexion);
          $rowop = mysql_fetch_assoc($selectop);
          $regla = $rowop['reglamentacion_local'];
          $urlregla = $rowop['url_reglamentacion_local'];
          mysql_free_result($selectop); ?>

          <div class="row">
            <form action="" method="POST" name="for54435345354352342aar65464563m1" enctype="multipart/form-data">
              <div class="col-md-4">
                <div class="form-group text-left">
                  <label class="control-label">
                    ¿EN EL MUNICIPIO DE SU JURISDICCIÓN EXISTE UNA EXIGENCIA ADICIONAL A LA EXPEDIDA POR EL MINISTERIO DE CIUDAD VIVIENDA Y TERRITORIO PARA LA CONFORMACIÓN DEL EQUIPO INTERDISCIPLINARIO?:</label>
                  <select class="form-control" name="reglamentacion_local">
                    <option value="" selected></option>
                    <option value="Si" <?php if ('Si' == $regla) {
                                          echo 'selected';
                                        } else {
                                        } ?>>Si</option>
                    <option value="No" <?php if ('No' == $regla) {
                                          echo 'selected';
                                        } else {
                                        } ?>>No</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group text-left">
                  <label class="control-label"> Documento relacionado (Si aplica):
                    <?php if (isset($urlregla) && "" != $urlregla) {
                      echo '<a href="filesnr/curadurias/' . $urlregla . '" target="_blank"> Ver Documento</a>';
                    } else {
                    } ?>
                  </label>
                  <input type="file" name="fileacta" required>
                  <span style="color:#B40404;font-size:13px;">Documento en formato PDF inferior a 15 Mg</span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="control-label">
                  <button type="submit" class="btn btn-xs btn-success">
                    <span class="glyphicon glyphicon-ok"></span> Actualizar </button>
                </div>
              </div>
            </form>
          </div>

          <hr>

          <div class="col-md-4">
            <h3 class="box-title">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
                Nuevo
              </button>
            </h3>
          </div>

          <div class="col-md-8">
            <b>PERSONAL - <?php echo quees('curaduria', $id); ?></b>
          </div>

        </div> <!-- FINAL box-header with-border -->

        <div class="box-body">
          <div class="table-responsive">
            <table class="table display" id="inforesoluciones" cellspacing="0" width="100%">
              <thead>
                <tr align="center" valign="middle">
                  <th>Cédula</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Curador asociado</th>
                  <th>Profesión</th>
                  <th>Estado</th>
                  <th>Fecha de ingreso</th>
                  <th>Fecha de retiro</th>
                  <th style="width:80px;"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query4 = "SELECT id_curador, id_relacion_curaduria, fecha_salida, cedula_funcionario, profesion, correo_funcionario, nombre_vinculacion, fecha_ingreso, funcionario.id_funcionario, tipo_relacion, nombre_funcionario, estado_activo, tipo_relacion, requisitos_curaduria, id_relacion_curaduria 
                FROM relacion_curaduria, funcionario, vinculacion where funcionario.id_vinculacion=vinculacion.id_vinculacion and relacion_curaduria.id_funcionario=funcionario.id_funcionario and relacion_curaduria.id_curaduria=" . $id . " and estado_relacion_curaduria=1";

                $result = $mysqli->query($query4);
                while ($row = $result->fetch_array()) {

                  $id_res = $row['id_funcionario'];
                  echo '<tr>';
                  echo '<td>' . $row['cedula_funcionario'] . '</td>';
                  echo '<td>' . $row['nombre_funcionario'] . '</td>';
                  echo '<td>' . $row['correo_funcionario'] . '</td>';

                  echo '<td>';

                  if (!isset($row['id_curador'])) {

                    echo '<form class="navbar-form" name="dfgdg43554356466765740036' . $id_res . '" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <select class="form-control"    name="id_curador" required><option></option>';

                    $queryg = sprintf("SELECT * FROM situacion_curaduria, tipo_acto where situacion_curaduria.id_tipo_acto=tipo_acto.id_tipo_acto and id_curaduria=" . $id . " and estado_situacion_curaduria=1");
                    $selectg = mysql_query($queryg, $conexion);
                    $rowcc = mysql_fetch_assoc($selectg);
                    $totalRows_regg = mysql_num_rows($selectg);

                    if (0 < $totalRows_regg) {
                      do {

                        echo '<option value="' . $rowcc['id_funcionario'] . ' ';
                        if ($rowcc['id_funcionario'] == $row['id_curador']) {
                          echo 'selected';
                        } else {
                        }
                        echo '">';
                        echo quees('funcionario', $rowcc['id_funcionario']);
                        echo '</option>';
                      } while ($rowcc = mysql_fetch_assoc($selectg));
                      mysql_free_result($selectg);
                    } else {
                    }

                    echo '</select>
                    <input type="hidden" name="idfuncionario" value="' . $id_res . '">
                    </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>';
                  } else {
                    echo quees('funcionario', $row['id_curador']);
                  }

                  echo '</td>';
                  echo '<td>' . $row['profesion'] . '</td>';
                  echo '<td>';
                  if (1 == $row['estado_activo']) {
                    echo 'Activo';
                  } else {
                    echo 'Inactivo';
                  }
                  echo '</td>';
                  echo '<td>' . $row['fecha_ingreso'] . '</td>';
                  echo '<td>';

                  if (!isset($row['fecha_salida'])) {
                    echo '<form class="navbar-form" name="dfgdg54356466765740036' . $id_res . '" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="text" readonly="readonly" class="form-control datepickera"  name="fecha_salida" value="' . $row['fecha_salida'] . '" required>
                      <input type="hidden" name="person" value="' . $id_res . '">
					  
					          </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>';
                  } else {
                    echo $row['fecha_salida'] . '';
                  }

                  echo '</td>';
                  //echo '<td><a href="filesnr/hv/'.$row['hv_funcionario'].'" target="_blank"><i class="fa fa-file"></i></a></td>';
                  echo '<td>';

                  if (1 == $_SESSION['rol'] or 0 < $nump3) {
                    echo '<a href="usuario&' . $row['id_funcionario'] . '.jsp"><span class="glyphicon glyphicon-user"></span></a> ';
                  } else {
                  }

                  echo '<a href="documentos&' . $row['id_funcionario'] . '&' . $id . '.jsp"><span class="fa fa-file" style="color:#E08E0B;"></span></a>';

                  if (isset($row['hv_funcionario'])) {
                    echo ' <a href="filesnr/hv/' . $row['hv_funcionario'] . '" target="_blank"><img src="images/pdf.png"></a>';
                  } else {
                  }

                  if (1 == $_SESSION['rol']) { //or 0<$nump161
                    echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar ' . $row['id_relacion_curaduria'] . '" name="relacion_curaduria" id="' . $row['id_relacion_curaduria'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
                  } else {
                  }

                  echo '</td>'; ?>
                  </tr>
                <?php } ?>
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

          <form action="" method="POST" name="for54352342aar65464563m1" enctype="multipart/form-data">

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CEDULA:</label>
              <input type="text" class="form-control numero" name="cedula_funcionario" required>
            </div>
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE:</label>
              <input type="text" class="form-control" name="nombre_funcionario" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>SEXO:</label>
              <select class="form-control" name="sexo" required>
                <option value="" selected></option>
                <option value="F">Femenino</option>
                <option value="M">Masculino</option>
              </select>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CORREO PERSONAL:</label>
              <input type="email" class="form-control" name="correo_funcionario" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> TELEFONO PERSONAL:</label>
              <input type="text" class="form-control numero" name="telefono_funcionario" required>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DE INGRESO: </label>
              <input type="text" class="form-control datepickera" name="fecha_ingreso" required>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>VINCULACIÓN:</label>
              <select class="form-control" name="id_vinculacion" required>
                <option value="" selected></option>
                <?php

                $query = sprintf("SELECT * FROM vinculacion where estado_vinculacion=1 and id_vinculacion in (5, 8, 9, 10) order by id_vinculacion");
                $select = mysql_query($query, $conexion);
                $row = mysql_fetch_assoc($select);
                $totalRows = mysql_num_rows($select);
                if (0 < $totalRows) {
                  do {
                    echo '<option value="' . $row['id_vinculacion'] . '">' . $row['nombre_vinculacion'] . '</option>';
                  } while ($row = mysql_fetch_assoc($select));
                } else {
                }
                mysql_free_result($select);
                ?>
              </select>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>NIVEL ACADEMICO:</label>
              <select class="form-control" name="id_nivel_academico" required>
                <option value="" selected></option>
                <?php

                $query = sprintf("SELECT * FROM nivel_academico where estado_nivel_academico=1 and id_nivel_academico!=12 order by id_nivel_academico");
                $select = mysql_query($query, $conexion);
                $row = mysql_fetch_assoc($select);
                $totalRows = mysql_num_rows($select);
                if (0 < $totalRows) {
                  do {
                    echo '<option value="' . $row['id_nivel_academico'] . '">' . $row['nombre_nivel_academico'] . '</option>';
                  } while ($row = mysql_fetch_assoc($select));
                } else {
                }
                mysql_free_result($select);
                ?>
              </select>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> PROFESION:</label>
              <select class="form-control " name="profesion" required>
                <option></option>
                <option>Ingeniero civil</option>
                <option>Arquitecto</option>
                <option>Abogado</option>
                <option>Ingeniero de sistemas</option>
                <option>Ingeniero catastral</option>
                <option>Otra</option>
              </select>
            </div>

            <div class="form-group text-left">
              <label class="control-label"> EN CASO DE OTRA, CÚAL:</label>
              <input type="text" class="form-control" name="otra_profesion">
            </div>
            <!--
            <script>


            function fileValidation(){
                var fileInput = document.getElementById('file');
                var filePath = fileInput.value;
              
              
              var fsize = 5000;
              var fileSize = fileInput.files[0].size;
                var siezekiloByte = parseInt(fileSize / 1024);
                
                //  alert(siezekiloByte+'<'+fsize);
                
                if  (siezekiloByte < fsize){
                  
                var allowedExtensions = /(.pdf)$/i;
                if(!allowedExtensions.exec(filePath)){
                    alert('Solo se permite extension .pdf.');
                    fileInput.value = '';
                document.getElementById('imagePreview').innerHTML = 'Error por tipo de archivo';
                    return false;
                }else{
                    //Image preview
                    if (fileInput.files && fileInput.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('imagePreview').innerHTML = 'ok';
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    } 
                }
              
            } else {
              alert('Debe ser inferior a 5000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
                  fileInput.value = '';
                document.getElementById('imagePreview').innerHTML = 'Error por tamaño';
                return false;
            }

            }
            </script>

            <div class="form-group text-left">
            <label  class="control-label"> Hoja de vida en PDF:</label> 
            <input type="file" name="file" id="file"  onchange="return fileValidation()">
            <span style="color:#B40404;font-size:13px;">Documento en formato PDF inferior a 5 Mg</span>
            <div id="imagePreview"></div>
            </div>-->
            <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-ok"></span> Cargar </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--
    <div class="modal fade bd-example-modal-lg" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header"> 
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
    <h4 class="modal-title" id="myModalLabel"><label  class="control-label">Configuración</label></h4>
    </div> 
    <div class="ver_banner" class="modal-body"> 
    </div>
    </div> 
    </div> 
    </div> 
    -->
<?php
} else {
  echo 'Se debe iniciar seleccionando la Curaduria.';
} ?>
<?php
/*
$nump95=privilegios(95,$_SESSION['snr']);
if (isset($_POST['fecha'])){ 
$fechan=$_POST['fecha'];
 } else {
$fechan=date('Y-m-d');  
 } 
} else {
$idorip=$_SESSION['id_oficina_registro'];
}
*/






if (isset($_GET['i'])) {
  $idorip = $_GET['i'];
} else {
  $idorip = 0;
}



$nump111 = privilegios(111, $_SESSION['snr']);




if (1 == $_SESSION['rol'] or 3 > $_SESSION['snr_tipo_oficina']) {


  /*
if ((isset($_POST["id_funcionariog"])) && (""!=$_POST["id_incentivo_educativog"]) && 
(1==$_SESSION['rol'] or 0<$nump111)) {


if (1==2) {	

$updateSQL7799m = sprintf("UPDATE incentivo_educativo SET id_categoria_incentivo_educativo=%s, id_modalidad_incentivo_educativo=%s, id_sede_incentivo_educativo=%s  
WHERE id_funcionario=%s and id_incentivo_educativo=%s and estado_incentivo_educativo=1",                  
					  GetSQLValueString($_POST["id_categoria_incentivo_educativog"], "text"),
					  GetSQLValueString($_POST["id_modalidad_incentivo_educativog"], "text"),
					  GetSQLValueString($_POST["id_sede_incentivo_educativog"], "text"),
					  GetSQLValueString($_POST["id_funcionariog"], "int"),
					  GetSQLValueString($_POST["id_incentivo_educativog"], "int")
 
					  );
					 // echo $updateSQL7799m;
$Result17799m = mysql_query($updateSQL7799m, $conexion);
  


} else {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, No existen cupos para esta categoria ó modalidad de inscripción..</div>';	
}
	
	
}
*/

  // validar que sea un funcionario con permiso bajo condiciones del negocio
  $idFuncionario = isset($_SESSION['snr']) ? $_SESSION['snr'] : '';
  $queryt = sprintf("SELECT COUNT(id_funcionario) AS tfuncionario
  FROM funcionario
  WHERE (id_cargo IN (1, 2, 4, 6))
    AND (id_vinculacion IN (2, 3, 4, 7))
    AND (estado_funcionario = 1)
    AND (fecha_ingreso <= DATE_SUB(NOW(), INTERVAL 13 MONTH))
    AND (id_funcionario = " . $idFuncionario . ")");
  $selectt = mysql_query($queryt, $conexion);
  $rowtt = mysql_fetch_assoc($selectt);
  $idTenerPermiso = $rowtt['tfuncionario'];

  // validar que solo se pueda cargar un registro por funcionario
  $queryrf = sprintf("SELECT count(id_funcionario) as regisFuncionario FROM incentivo_educativo where vigencia=2024 and estado_incentivo_educativo=1 and id_funcionario=" . $idFuncionario . "");
  $selectrf = mysql_query($queryrf, $conexion);
  $rowrf = mysql_fetch_assoc($selectrf);
  $soloUnRegistro = $rowrf['regisFuncionario'];


  if ((isset($_POST["nombre_incentivo_educativo"])) && ("" != $_POST["nombre_incentivo_educativo"]) &&
    (1 == $_SESSION['rol'] or 3 > $_SESSION['snr_tipo_oficina']) && isset($idFuncionario)
  ) {

    if (0 < $idTenerPermiso) {

      if (0 >= $soloUnRegistro) {

        if (1 == 1) {

          $tamano_archivo = 11534336;
          //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
          $formato_archivo = array('pdf');


          $directoryftp = "filesnr/incentivo_educativo/";

          if (isset($_FILES['file']['name']) && "" != $_FILES['file']['name']) {

            $ruta_archivo = 'incentivo_educativo-' . $_SESSION['snr'] . '' . date("YmdGis");

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


                $insertSQL = sprintf(
                  "INSERT INTO incentivo_educativo (
                nombre_incentivo_educativo, vigencia, id_funcionario, nombre_hijo, id_tipo_documento_hijo, documento_id_hijo,  nacimiento_hijo, genero_hijo, 
                fecha_incentivo_educativo, url, estado_incentivo_educativo) 
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s, now(), %s, %s)",
                  GetSQLValueString($_POST["nombre_incentivo_educativo"], "text"),
                  GetSQLValueString('2024', "int"),
                  GetSQLValueString($idFuncionario, "int"),
                  GetSQLValueString($_POST["nombre_hijo"], "text"),
                  GetSQLValueString($_POST["id_tipo_documento_hijo"], "text"),
                  GetSQLValueString($_POST["documento_id_hijo"], "text"),
                  GetSQLValueString($_POST["nacimiento_hijo"], "date"),
                  GetSQLValueString($_POST["genero_hijo"], "text"),
                  GetSQLValueString($files, "text"),
                  GetSQLValueString(1, "int")
                );
                $Result = mysql_query($insertSQL, $conexion);
                echo $insertado;




                $updateSQL = sprintf(
                  "UPDATE funcionario SET correo_personal=%s, rh=%s, celular_funcionario=%s, id_estado_civil=%s, fecha_nacimiento=%s, 
                generos=%s, 
                orientacion=%s, 
                id_etnia=%s, 
                territorio_etnico=%s, 
                discapacidad=%s, 
                celular_funcionario=%s, 
                municipio_vive=%s 
                WHERE id_funcionario=%s and estado_funcionario=1",
                  GetSQLValueString($_POST["correo_personal"], "text"),
                  GetSQLValueString($_POST["rh"], "text"),
                  GetSQLValueString($_POST["celular_funcionario"], "text"),
                  GetSQLValueString($_POST["id_estado_civil"], "text"),
                  GetSQLValueString($_POST["fecha_nacimiento"], "date"),

                  GetSQLValueString($_POST["generos"], "text"),
                  GetSQLValueString($_POST["orientacion"], "text"),
                  GetSQLValueString($_POST["id_etnia"], "int"),
                  GetSQLValueString($_POST["territorio_etnico"], "text"),
                  GetSQLValueString($_POST["discapacidad"], "text"),
                  GetSQLValueString($_POST["celular_funcionario"], "text"),
                  GetSQLValueString($_POST["municipio_vive"], "int"),
                  GetSQLValueString($idFuncionario, "int")
                );
                $Result1 = mysql_query($updateSQL, $conexion);

                echo '<meta http-equiv="refresh" content="3;URL=./incentivo_educativo.jsp" />';
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
        } else {
          echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida.</div>';
        }
      } else {
        echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, Solo esta disponible para un hijo por funcionario.</div>';
      }
    } else {
      echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, Solo esta disponible para funcionarios de de carrera ó provisionales. Si identifica inconsistencias, reportarlo a direcciontalentohumano@supernotariado.gov.co para actualizar el perfil.</div>';
    }
  } else {
  }

  $fechaActual = date("Y-m-d H:i:s");
  if (isset($_POST["borrar_incentivo_educativo"])) {
    $updateSQL = sprintf("UPDATE incentivo_educativo SET estado_incentivo_educativo=%s, fecha_borrado=%s WHERE id_incentivo_educativo=%s",
      GetSQLValueString(0, "int"),
      GetSQLValueString($fechaActual, "date"),
      GetSQLValueString($_POST["borrar_incentivo_educativo"], "int"));
      $Result1 = mysql_query($updateSQL, $conexion);
      echo '<meta http-equiv="refresh" content="3;URL=./incentivo_educativo.jsp" />';
  } else {}
?>



  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo existencia('incentivo_educativo'); ?></h3>
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



    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
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
    <!-- ./col -->

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
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
              <b>Formulario de solicitud Incentivo Educativo</b>
              <br>
              OBJETIVO: Otorgar un incentivo educativo para el año 2024 por funcionario como
              aporte a la educación de sus hijos.
              <br>
              DIRIGIDO A: funcionarios vinculados a la Superintendencia de Notariado y Registro, mediante nombramiento en carrera administrativa y provisionalidad, en todos los niveles, así como Registradores de Instrumentos Públicos. Se exceptúan de este beneficio los servidores públicos de Libre Nombramiento y Remoción.
              <br>
              <hr>
              <a href="documentos/TERMINOS16042024.pdf" target="_blank">Terminos y condiciones</a> <br> <a href="documentos/03715-LINEAMIENTOS.pdf" target="_blank">Resolución 03715 de 2024</a>
              <br>
              <span style="color:red; font-size:14px;"><b>
                  Recuerde que debe cumplir con la totalidad de los requisitos estipulados en la Resolución 03715 de 2024 y leer detenidamente los términos y condiciones adjuntas.
                </b></span>
            </p>

            <?php
            $fecha_actual = strtotime(date('Y-m-d'));
            $fecha_inicial = strtotime("2024-01-22");
            $fecha_limite = strtotime("2024-05-31");

            //1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']
            if ((3 > $_SESSION['snr_tipo_oficina'] && $fecha_limite >= $fecha_actual && (0 < $idTenerPermiso && 0 >= $soloUnRegistro))) {
            ?>

              <h3 class="box-title">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
                  Nuevo
                </button> Incentivo Educativos


                <?php if (isset($_GET['i'])) {
                  echo ' / ';
                  //echo quees('oficina_registro',$idorip);
                } else {
                }
                ?>
              </h3>

            <?php } else {
            } ?>
          </div>







        </div> <!-- FINAL box-header with-border -->

        <div class="box-body">
          <div class="table-responsive">




            <table class="table display" id="inforesoluciones" cellspacing="0" width="100%">


              <thead>
                <tr align="center" valign="middle">
                  <th>Vigencia</th>
                  <th>Registro</th>
                  <th>Funcionario</th>
                  <th>Cedula</th>
                  <th>Celular</th>
                  <th>Correo Personal</th>
                  <th>Regional</th>
                  <th>Oficina</th>
                  <th>Nombre del hijo</th>
                  <th>Identificación</th>
                  <th>Fecha de nacimiento</th>
                  <th>Genero del hijo</th>
                  <th>Nivel educativo</th>
                  <th style="width:45px;"></th>
                </tr>
              </thead>
              <tbody>

                <?php



                if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                  $infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
                  $infop = $infobus;
                  $pagina = 0;
                } else {

                  $infop = '';

                  if (isset($_GET['i']) && "" != $_GET['i']) {
                    $pagina = intval($_GET['i']);
                  } else {
                    $pagina = 0;
                  }
                }



                if (1 == $_SESSION['rol'] or 0 < $nump111) {
                  $query4 = "SELECT * from incentivo_educativo, funcionario where incentivo_educativo.id_funcionario=funcionario.id_funcionario and estado_incentivo_educativo=1 " . $infop . " ORDER BY id_incentivo_educativo desc  "; //LIMIT 500 OFFSET ".$pagina."
                } else {
                  $query4 = "SELECT * from incentivo_educativo, funcionario where incentivo_educativo.id_funcionario=funcionario.id_funcionario and estado_incentivo_educativo=1 and funcionario.id_funcionario=" . $_SESSION['snr'] . " ORDER BY id_incentivo_educativo desc  "; //LIMIT 500 OFFSET ".$pagina."
                }


                $result = $mysqli->query($query4);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                ?>
                  <tr>
                    <?php
                    $id_res = $row['id_incentivo_educativo'];
                    echo '<td>' . $row['vigencia'] . '</td>';
                    echo '<td>' . $row['fecha_incentivo_educativo'] . '</td>';
                    echo '<td><a href="usuario&' . $row['id_funcionario'] . '.jsp"  target="_blank">' . $row['nombre_funcionario'] . '</a></td>';

                    echo '<td>';
                    echo $row['cedula_funcionario'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['celular_funcionario'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['correo_personal'];
                    echo '</td>';

                    if (1 == $row['id_tipo_oficina']) {
                      echo '<td>Nivel central</td>';
                      echo '<td>' . quees('grupo_area', $row['id_grupo_area']) . '</td>';
                    } else {
                      echo '<td>' . regional($row['id_oficina_registro']) . '</td>';
                      echo '<td>' . quees('oficina_registro', $row['id_oficina_registro']) . '</td>';
                    }


                    echo '<td>' . $row['nombre_hijo'] . '</td>';
                    echo '<td>' . $row['documento_id_hijo'] . '</td>';

                    echo '<td>' . $row['nacimiento_hijo'] . '</td>';
                    echo '<td>' . $row['genero_hijo'] . '</td>';
                    echo '<td>' . $row['nombre_incentivo_educativo'] . '</td>';
                    echo '<td>';
                    echo ' <a href="filesnr/incentivo_educativo/' . $row['url'] . '" target="_blank"><img src="images/pdf.png"></a>';
                    if (1 == $_SESSION['rol'] or 0 < $nump111) { ?>

                      <form action="" method="post" name="borrar_incentivo_educativo" style="display:inline;">
                        <input type="hidden" name="borrar_incentivo_educativo" value="<?php echo $row['id_incentivo_educativo']; ?>">
                        <button type="submit" style="background-color: white; border:none;"><span class="glyphicon glyphicon-trash" style="color:red;"></span></button>
                      </form>

                      <!-- echo ' <a href="" class="buscarincentivo_educativo" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizarincentivo_educativo"> <i class="fa fa-edit"></i></a> '; -->

                    <?php } else {
                    }
                    echo '</td>';
                    ?>

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


  <?php if (3 > $_SESSION['snr_tipo_oficina']) { ?>





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

            <form action="" method="POST" name="for54354r653454345345464324324563m1" id="formGuardarNuevoTramoComision" enctype="multipart/form-data">

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Vigencia:</label>
                <input type="text" class="form-control" readonly value="2024">
              </div>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label>
                <input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
              </div>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Cédula:</label>
                <input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
              </div>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Correo Personal:</label>
                <input type="email" class="form-control" name="correo_personal" required>
              </div>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Estado Civil:</label>
                <select name="id_estado_civil" class="form-control" required>
                  <option selected></option>
                  <?php
                  $query = sprintf("SELECT * FROM estado_civil where estado_estado_civil=1 and id_estado_civil!=6 order by id_estado_civil");
                  $select = mysql_query($query, $conexion);
                  $row = mysql_fetch_assoc($select);
                  $totalRows = mysql_num_rows($select);
                  if (0 < $totalRows) {
                    do {
                      echo '<option value="' . $row['id_estado_civil'] . '"  ';


                      echo '>' . $row['nombre_estado_civil'] . '</option>';
                    } while ($row = mysql_fetch_assoc($select));
                  } else {
                  }
                  mysql_free_result($select);
                  ?>

                </select>
              </div>





              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> RH:</label>
                <input type="text" class="form-control" name="rh" placeholder="" required>
              </div>



              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Fecha nacimiento: (Usar el calendario)</label>
                <input type="text" readonly class="form-control datepickera" name="fecha_nacimiento" required>
              </div>











              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Genero</label>
                <select class="form-control" name="generos" required>
                  <option selected></option>
                  <option>Masculino </option>
                  <option>Femenino</option>
                  <option>No Binario</option>
                  <option>Prefiero no responder.</option>

                </select>
              </div>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Orientación</label>
                <select class="form-control " name="orientacion" required>
                  <option selected></option>
                  <option>Heterosexual</option>
                  <option>Bisexual</option>
                  <option>Homosexual</option>
                  <option>Prefiero no responder</option>

                </select>
              </div>


              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Grupo Étnico</label>
                <select class="form-control " name="id_etnia" required>
                  <option selected></option>
                  <?php
                  $query = "SELECT * FROM etnia where estado_etnia=1";
                  $result = $mysqli->query($query);
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_etnia'] . "'>" . $row['nombre_etnia'] . " </option>";
                  }
                  $mysqli->close();
                  ?>
                </select>
              </div>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Territorios étnicos</label>
                <select class="form-control" name="territorio_etnico" required>
                  <option selected></option>
                  <option>Resguardos Indígenas</option>
                  <option>Consejos Comunitarios</option>
                  <option>No aplica </option>
                </select>
              </div>


              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Discapacidad</label>
                <input type="text" class="form-control" name="discapacidad" required placeholder="Si - Cual, No, Prefiero no responder">
              </div>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Telefono Celular:</label>
                <input type="text" class="form-control numero" name="celular_funcionario" placeholder="Solo números" required>
              </div>


              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Ciudad donde desempeña sus labores </label>
                <select class="form-control" name="municipio_vive" required>
                  <option value="" selected></option>
                  <?php
                  //echo dep_mun();
                  /*
$query = "SELECT nombre_departamento, nombre_municipio FROM municipio, departamento where  municipio.id_departamento= departamento.id_departamento";
$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['id_municipio'] . "'>" . $row['nombre_departamento'] . " / " . $row['nombre_municipio'] . " </option>";
}
$result->free();
$mysqli->close();



$querytt = "SELECT nombre_departamento, nombre_municipio FROM municipio, departamento where  municipio.id_departamento= departamento.id_departamento";
$resulttt = $mysqli->query($querytt);
while ($obj = $resulttt->fetch_array()) {
    echo "<option value='" . $obj['id_municipio'] . "'>" . $obj['nombre_departamento'] . " / " . $obj['nombre_municipio'] . " </option>";
    }
$resulttt->free();
*/

                  ?>

                  <option value="	1	"> ANTIOQUIA / MEDELLIN </option>
                  <option value="	2	"> ANTIOQUIA / ABEJORRAL </option>
                  <option value="	3	"> ANTIOQUIA / ABRIAQUI </option>
                  <option value="	4	"> ANTIOQUIA / ALEJANDRIA </option>
                  <option value="	5	"> ANTIOQUIA / AMAGA </option>
                  <option value="	6	"> ANTIOQUIA / AMALFI </option>
                  <option value="	7	"> ANTIOQUIA / ANDES </option>
                  <option value="	8	"> ANTIOQUIA / ANGELOPOLIS </option>
                  <option value="	9	"> ANTIOQUIA / ANGOSTURA </option>
                  <option value="	10	"> ANTIOQUIA / ANORI </option>
                  <option value="	11	"> ANTIOQUIA / SANTAFE DE ANTIOQUIA </option>
                  <option value="	12	"> ANTIOQUIA / ANZA </option>
                  <option value="	13	"> ANTIOQUIA / APARTADO </option>
                  <option value="	14	"> ANTIOQUIA / ARBOLETES </option>
                  <option value="	15	"> ANTIOQUIA / ARGELIA </option>
                  <option value="	16	"> ANTIOQUIA / ARMENIA </option>
                  <option value="	17	"> ANTIOQUIA / BARBOSA </option>
                  <option value="	18	"> ANTIOQUIA / BELMIRA </option>
                  <option value="	19	"> ANTIOQUIA / BELLO </option>
                  <option value="	20	"> ANTIOQUIA / BETANIA </option>
                  <option value="	21	"> ANTIOQUIA / BETULIA </option>
                  <option value="	22	"> ANTIOQUIA / CIUDAD BOLIVAR </option>
                  <option value="	23	"> ANTIOQUIA / BRICENO </option>
                  <option value="	24	"> ANTIOQUIA / BURITICA </option>
                  <option value="	25	"> ANTIOQUIA / CACERES </option>
                  <option value="	26	"> ANTIOQUIA / CAICEDO </option>
                  <option value="	27	"> ANTIOQUIA / CALDAS </option>
                  <option value="	28	"> ANTIOQUIA / CAMPAMENTO </option>
                  <option value="	29	"> ANTIOQUIA / CANASGORDAS </option>
                  <option value="	30	"> ANTIOQUIA / CARACOLI </option>
                  <option value="	31	"> ANTIOQUIA / CARAMANTA </option>
                  <option value="	32	"> ANTIOQUIA / CAREPA </option>
                  <option value="	33	"> ANTIOQUIA / EL CARMEN DE VIBORAL </option>
                  <option value="	34	"> ANTIOQUIA / CAROLINA </option>
                  <option value="	35	"> ANTIOQUIA / CAUCASIA </option>
                  <option value="	36	"> ANTIOQUIA / CHIGORODO </option>
                  <option value="	37	"> ANTIOQUIA / CISNEROS </option>
                  <option value="	38	"> ANTIOQUIA / COCORNA </option>
                  <option value="	39	"> ANTIOQUIA / CONCEPCION </option>
                  <option value="	40	"> ANTIOQUIA / CONCORDIA </option>
                  <option value="	41	"> ANTIOQUIA / COPACABANA </option>
                  <option value="	42	"> ANTIOQUIA / DABEIBA </option>
                  <option value="	43	"> ANTIOQUIA / DON MATIAS </option>
                  <option value="	44	"> ANTIOQUIA / EBEJICO </option>
                  <option value="	45	"> ANTIOQUIA / EL BAGRE </option>
                  <option value="	46	"> ANTIOQUIA / ENTRERRIOS </option>
                  <option value="	47	"> ANTIOQUIA / ENVIGADO </option>
                  <option value="	48	"> ANTIOQUIA / FREDONIA </option>
                  <option value="	49	"> ANTIOQUIA / FRONTINO </option>
                  <option value="	50	"> ANTIOQUIA / GIRALDO </option>
                  <option value="	51	"> ANTIOQUIA / GIRARDOTA </option>
                  <option value="	52	"> ANTIOQUIA / GOMEZ PLATA </option>
                  <option value="	53	"> ANTIOQUIA / GRANADA </option>
                  <option value="	54	"> ANTIOQUIA / GUADALUPE </option>
                  <option value="	55	"> ANTIOQUIA / GUARNE </option>
                  <option value="	56	"> ANTIOQUIA / GUATAPE </option>
                  <option value="	57	"> ANTIOQUIA / HELICONIA </option>
                  <option value="	58	"> ANTIOQUIA / HISPANIA </option>
                  <option value="	59	"> ANTIOQUIA / ITAGUI </option>
                  <option value="	60	"> ANTIOQUIA / ITUANGO </option>
                  <option value="	61	"> ANTIOQUIA / JARDIN </option>
                  <option value="	62	"> ANTIOQUIA / JERICO </option>
                  <option value="	63	"> ANTIOQUIA / LA CEJA </option>
                  <option value="	64	"> ANTIOQUIA / LA ESTRELLA </option>
                  <option value="	65	"> ANTIOQUIA / LA PINTADA </option>
                  <option value="	66	"> ANTIOQUIA / LA UNION </option>
                  <option value="	67	"> ANTIOQUIA / LIBORINA </option>
                  <option value="	68	"> ANTIOQUIA / MACEO </option>
                  <option value="	69	"> ANTIOQUIA / MARINILLA </option>
                  <option value="	70	"> ANTIOQUIA / MONTEBELLO </option>
                  <option value="	71	"> ANTIOQUIA / MURINDO </option>
                  <option value="	72	"> ANTIOQUIA / MUTATA </option>
                  <option value="	73	"> ANTIOQUIA / NARINO </option>
                  <option value="	74	"> ANTIOQUIA / NECOCLI </option>
                  <option value="	75	"> ANTIOQUIA / NECHI </option>
                  <option value="	76	"> ANTIOQUIA / OLAYA </option>
                  <option value="	77	"> ANTIOQUIA / PENOL </option>
                  <option value="	78	"> ANTIOQUIA / PEQUE </option>
                  <option value="	79	"> ANTIOQUIA / PUEBLORRICO </option>
                  <option value="	80	"> ANTIOQUIA / PUERTO BERRIO </option>
                  <option value="	81	"> ANTIOQUIA / PUERTO NARE </option>
                  <option value="	82	"> ANTIOQUIA / PUERTO TRIUNFO </option>
                  <option value="	83	"> ANTIOQUIA / REMEDIOS </option>
                  <option value="	84	"> ANTIOQUIA / RETIRO </option>
                  <option value="	85	"> ANTIOQUIA / RIONEGRO </option>
                  <option value="	86	"> ANTIOQUIA / SABANALARGA </option>
                  <option value="	87	"> ANTIOQUIA / SABANETA </option>
                  <option value="	88	"> ANTIOQUIA / SALGAR </option>
                  <option value="	89	"> ANTIOQUIA / SAN ANDRES DE CUERQUIA </option>
                  <option value="	90	"> ANTIOQUIA / SAN CARLOS </option>
                  <option value="	91	"> ANTIOQUIA / SAN FRANCISCO </option>
                  <option value="	92	"> ANTIOQUIA / SAN JERONIMO </option>
                  <option value="	93	"> ANTIOQUIA / SAN JOSE DE LA MONTANA </option>
                  <option value="	94	"> ANTIOQUIA / SAN JUAN DE URABA </option>
                  <option value="	95	"> ANTIOQUIA / SAN LUIS </option>
                  <option value="	96	"> ANTIOQUIA / SAN PEDRO </option>
                  <option value="	97	"> ANTIOQUIA / SAN PEDRO DE URABA </option>
                  <option value="	98	"> ANTIOQUIA / SAN RAFAEL </option>
                  <option value="	99	"> ANTIOQUIA / SAN ROQUE </option>
                  <option value="	100	"> ANTIOQUIA / SAN VICENTE </option>
                  <option value="	101	"> ANTIOQUIA / SANTA BARBARA </option>
                  <option value="	102	"> ANTIOQUIA / SANTA ROSA DE OSOS </option>
                  <option value="	103	"> ANTIOQUIA / SANTO DOMINGO </option>
                  <option value="	104	"> ANTIOQUIA / EL SANTUARIO </option>
                  <option value="	105	"> ANTIOQUIA / SEGOVIA </option>
                  <option value="	106	"> ANTIOQUIA / SONSON </option>
                  <option value="	107	"> ANTIOQUIA / SOPETRAN </option>
                  <option value="	108	"> ANTIOQUIA / TAMESIS </option>
                  <option value="	109	"> ANTIOQUIA / TARAZA </option>
                  <option value="	110	"> ANTIOQUIA / TARSO </option>
                  <option value="	111	"> ANTIOQUIA / TITIRIBI </option>
                  <option value="	112	"> ANTIOQUIA / TOLEDO </option>
                  <option value="	113	"> ANTIOQUIA / TURBO </option>
                  <option value="	114	"> ANTIOQUIA / URAMITA </option>
                  <option value="	115	"> ANTIOQUIA / URRAO </option>
                  <option value="	116	"> ANTIOQUIA / VALDIVIA </option>
                  <option value="	117	"> ANTIOQUIA / VALPARAISO </option>
                  <option value="	118	"> ANTIOQUIA / VEGACHI </option>
                  <option value="	119	"> ANTIOQUIA / VENECIA </option>
                  <option value="	120	"> ANTIOQUIA / VIGIA DEL FUERTE </option>
                  <option value="	121	"> ANTIOQUIA / YALI </option>
                  <option value="	122	"> ANTIOQUIA / YARUMAL </option>
                  <option value="	123	"> ANTIOQUIA / YOLOMBO </option>
                  <option value="	124	"> ANTIOQUIA / YONDO </option>
                  <option value="	125	"> ANTIOQUIA / ZARAGOZA </option>
                  <option value="	126	"> ATLANTICO / BARRANQUILLA </option>
                  <option value="	127	"> ATLANTICO / BARANOA </option>
                  <option value="	128	"> ATLANTICO / CAMPO DE LA CRUZ </option>
                  <option value="	129	"> ATLANTICO / CANDELARIA </option>
                  <option value="	130	"> ATLANTICO / GALAPA </option>
                  <option value="	131	"> ATLANTICO / JUAN DE ACOSTA </option>
                  <option value="	132	"> ATLANTICO / LURUACO </option>
                  <option value="	133	"> ATLANTICO / MALAMBO </option>
                  <option value="	134	"> ATLANTICO / MANATI </option>
                  <option value="	135	"> ATLANTICO / PALMAR DE VARELA </option>
                  <option value="	136	"> ATLANTICO / PIOJO </option>
                  <option value="	137	"> ATLANTICO / POLONUEVO </option>
                  <option value="	138	"> ATLANTICO / PONEDERA </option>
                  <option value="	139	"> ATLANTICO / PUERTO COLOMBIA </option>
                  <option value="	140	"> ATLANTICO / REPELON </option>
                  <option value="	141	"> ATLANTICO / SABANAGRANDE </option>
                  <option value="	142	"> ATLANTICO / SABANALARGA </option>
                  <option value="	143	"> ATLANTICO / SANTA LUCIA </option>
                  <option value="	144	"> ATLANTICO / SANTO TOMAS </option>
                  <option value="	145	"> ATLANTICO / SOLEDAD </option>
                  <option value="	146	"> ATLANTICO / SUAN </option>
                  <option value="	147	"> ATLANTICO / TUBARA </option>
                  <option value="	148	"> ATLANTICO / USIACURI </option>
                  <option value="	149	"> CUNDINAMARCA - BOGOTA / BOGOTA </option>
                  <option value="	150	"> BOLIVAR / CARTAGENA </option>
                  <option value="	151	"> BOLIVAR / ACHI </option>
                  <option value="	152	"> BOLIVAR / ALTOS DEL ROSARIO </option>
                  <option value="	153	"> BOLIVAR / ARENAL </option>
                  <option value="	154	"> BOLIVAR / ARJONA </option>
                  <option value="	155	"> BOLIVAR / ARROYOHONDO </option>
                  <option value="	156	"> BOLIVAR / BARRANCO DE LOBA </option>
                  <option value="	157	"> BOLIVAR / CALAMAR </option>
                  <option value="	158	"> BOLIVAR / CANTAGALLO </option>
                  <option value="	159	"> BOLIVAR / CICUCO </option>
                  <option value="	160	"> BOLIVAR / CORDOBA </option>
                  <option value="	161	"> BOLIVAR / CLEMENCIA </option>
                  <option value="	162	"> BOLIVAR / EL CARMEN DE BOLIVAR </option>
                  <option value="	163	"> BOLIVAR / EL GUAMO </option>
                  <option value="	164	"> BOLIVAR / EL PENON </option>
                  <option value="	165	"> BOLIVAR / HATILLO DE LOBA </option>
                  <option value="	166	"> BOLIVAR / MAGANGUE </option>
                  <option value="	167	"> BOLIVAR / MAHATES </option>
                  <option value="	168	"> BOLIVAR / MARGARITA </option>
                  <option value="	169	"> BOLIVAR / MARIA LA BAJA </option>
                  <option value="	170	"> BOLIVAR / MONTECRISTO </option>
                  <option value="	171	"> BOLIVAR / MOMPOS </option>
                  <option value="	172	"> BOLIVAR / MORALES </option>
                  <option value="	173	"> BOLIVAR / NOROSI </option>
                  <option value="	174	"> BOLIVAR / PINILLOS </option>
                  <option value="	175	"> BOLIVAR / REGIDOR </option>
                  <option value="	176	"> BOLIVAR / RIO VIEJO </option>
                  <option value="	177	"> BOLIVAR / SAN CRISTOBAL </option>
                  <option value="	178	"> BOLIVAR / SAN ESTANISLAO </option>
                  <option value="	179	"> BOLIVAR / SAN FERNANDO </option>
                  <option value="	180	"> BOLIVAR / SAN JACINTO </option>
                  <option value="	181	"> BOLIVAR / SAN JACINTO DEL CAUCA </option>
                  <option value="	182	"> BOLIVAR / SAN JUAN NEPOMUCENO </option>
                  <option value="	183	"> BOLIVAR / SAN MARTIN DE LOBA </option>
                  <option value="	184	"> BOLIVAR / SAN PABLO </option>
                  <option value="	185	"> BOLIVAR / SANTA CATALINA </option>
                  <option value="	186	"> BOLIVAR / SANTA ROSA </option>
                  <option value="	187	"> BOLIVAR / SANTA ROSA DEL SUR </option>
                  <option value="	188	"> BOLIVAR / SIMITI </option>
                  <option value="	189	"> BOLIVAR / SOPLAVIENTO </option>
                  <option value="	190	"> BOLIVAR / TALAIGUA NUEVO </option>
                  <option value="	191	"> BOLIVAR / TIQUISIO </option>
                  <option value="	192	"> BOLIVAR / TURBACO </option>
                  <option value="	193	"> BOLIVAR / TURBANA </option>
                  <option value="	194	"> BOLIVAR / VILLANUEVA </option>
                  <option value="	195	"> BOLIVAR / ZAMBRANO </option>
                  <option value="	196	"> BOYACA / TUNJA </option>
                  <option value="	197	"> BOYACA / ALMEIDA </option>
                  <option value="	198	"> BOYACA / AQUITANIA </option>
                  <option value="	199	"> BOYACA / ARCABUCO </option>
                  <option value="	200	"> BOYACA / BELEN </option>
                  <option value="	201	"> BOYACA / BERBEO </option>
                  <option value="	202	"> BOYACA / BETEITIVA </option>
                  <option value="	203	"> BOYACA / BOAVITA </option>
                  <option value="	204	"> BOYACA / BOYACA </option>
                  <option value="	205	"> BOYACA / BRICENO </option>
                  <option value="	206	"> BOYACA / BUENAVISTA </option>
                  <option value="	207	"> BOYACA / BUSBANZA </option>
                  <option value="	208	"> BOYACA / CALDAS </option>
                  <option value="	209	"> BOYACA / CAMPOHERMOSO </option>
                  <option value="	210	"> BOYACA / CERINZA </option>
                  <option value="	211	"> BOYACA / CHINAVITA </option>
                  <option value="	212	"> BOYACA / CHIQUINQUIRA </option>
                  <option value="	213	"> BOYACA / CHISCAS </option>
                  <option value="	214	"> BOYACA / CHITA </option>
                  <option value="	215	"> BOYACA / CHITARAQUE </option>
                  <option value="	216	"> BOYACA / CHIVATA </option>
                  <option value="	217	"> BOYACA / CIENEGA </option>
                  <option value="	218	"> BOYACA / COMBITA </option>
                  <option value="	219	"> BOYACA / COPER </option>
                  <option value="	220	"> BOYACA / CORRALES </option>
                  <option value="	221	"> BOYACA / COVARACHIA </option>
                  <option value="	222	"> BOYACA / CUBARA </option>
                  <option value="	223	"> BOYACA / CUCAITA </option>
                  <option value="	224	"> BOYACA / CUITIVA </option>
                  <option value="	225	"> BOYACA / CHIQUIZA </option>
                  <option value="	226	"> BOYACA / CHIVOR </option>
                  <option value="	227	"> BOYACA / DUITAMA </option>
                  <option value="	228	"> BOYACA / EL COCUY </option>
                  <option value="	229	"> BOYACA / EL ESPINO </option>
                  <option value="	230	"> BOYACA / FIRAVITOBA </option>
                  <option value="	231	"> BOYACA / FLORESTA </option>
                  <option value="	232	"> BOYACA / GACHANTIVA </option>
                  <option value="	233	"> BOYACA / GAMEZA </option>
                  <option value="	234	"> BOYACA / GARAGOA </option>
                  <option value="	235	"> BOYACA / GUACAMAYAS </option>
                  <option value="	236	"> BOYACA / GUATEQUE </option>
                  <option value="	237	"> BOYACA / GUAYATA </option>
                  <option value="	238	"> BOYACA / GUICAN </option>
                  <option value="	239	"> BOYACA / IZA </option>
                  <option value="	240	"> BOYACA / JENESANO </option>
                  <option value="	241	"> BOYACA / JERICO </option>
                  <option value="	242	"> BOYACA / LABRANZAGRANDE </option>
                  <option value="	243	"> BOYACA / LA CAPILLA </option>
                  <option value="	244	"> BOYACA / LA VICTORIA </option>
                  <option value="	245	"> BOYACA / LA UVITA </option>
                  <option value="	246	"> BOYACA / VILLA DE LEYVA </option>
                  <option value="	247	"> BOYACA / MACANAL </option>
                  <option value="	248	"> BOYACA / MARIPI </option>
                  <option value="	249	"> BOYACA / MIRAFLORES </option>
                  <option value="	250	"> BOYACA / MONGUA </option>
                  <option value="	251	"> BOYACA / MONGUI </option>
                  <option value="	252	"> BOYACA / MONIQUIRA </option>
                  <option value="	253	"> BOYACA / MOTAVITA </option>
                  <option value="	254	"> BOYACA / MUZO </option>
                  <option value="	255	"> BOYACA / NOBSA </option>
                  <option value="	256	"> BOYACA / NUEVO COLON </option>
                  <option value="	257	"> BOYACA / OICATA </option>
                  <option value="	258	"> BOYACA / OTANCHE </option>
                  <option value="	259	"> BOYACA / PACHAVITA </option>
                  <option value="	260	"> BOYACA / PAEZ </option>
                  <option value="	261	"> BOYACA / PAIPA </option>
                  <option value="	262	"> BOYACA / PAJARITO </option>
                  <option value="	263	"> BOYACA / PANQUEBA </option>
                  <option value="	264	"> BOYACA / PAUNA </option>
                  <option value="	265	"> BOYACA / PAYA </option>
                  <option value="	266	"> BOYACA / PAZ DE RIO </option>
                  <option value="	267	"> BOYACA / PESCA </option>
                  <option value="	268	"> BOYACA / PISBA </option>
                  <option value="	269	"> BOYACA / PUERTO BOYACA </option>
                  <option value="	270	"> BOYACA / QUIPAMA </option>
                  <option value="	271	"> BOYACA / RAMIRIQUI </option>
                  <option value="	272	"> BOYACA / RAQUIRA </option>
                  <option value="	273	"> BOYACA / RONDON </option>
                  <option value="	274	"> BOYACA / SABOYA </option>
                  <option value="	275	"> BOYACA / SACHICA </option>
                  <option value="	276	"> BOYACA / SAMACA </option>
                  <option value="	277	"> BOYACA / SAN EDUARDO </option>
                  <option value="	278	"> BOYACA / SAN JOSE DE PARE </option>
                  <option value="	279	"> BOYACA / SAN LUIS DE GACENO </option>
                  <option value="	280	"> BOYACA / SAN MATEO </option>
                  <option value="	281	"> BOYACA / SAN MIGUEL DE SEMA </option>
                  <option value="	282	"> BOYACA / SAN PABLO DE BORBUR </option>
                  <option value="	283	"> BOYACA / SANTANA </option>
                  <option value="	284	"> BOYACA / SANTA MARIA </option>
                  <option value="	285	"> BOYACA / SANTA ROSA DE VITERBO </option>
                  <option value="	286	"> BOYACA / SANTA SOFIA </option>
                  <option value="	287	"> BOYACA / SATIVANORTE </option>
                  <option value="	288	"> BOYACA / SATIVASUR </option>
                  <option value="	289	"> BOYACA / SIACHOQUE </option>
                  <option value="	290	"> BOYACA / SOATA </option>
                  <option value="	291	"> BOYACA / SOCOTA </option>
                  <option value="	292	"> BOYACA / SOCHA </option>
                  <option value="	293	"> BOYACA / SOGAMOSO </option>
                  <option value="	294	"> BOYACA / SOMONDOCO </option>
                  <option value="	295	"> BOYACA / SORA </option>
                  <option value="	296	"> BOYACA / SOTAQUIRA </option>
                  <option value="	297	"> BOYACA / SORACA </option>
                  <option value="	298	"> BOYACA / SUSACON </option>
                  <option value="	299	"> BOYACA / SUTAMARCHAN </option>
                  <option value="	300	"> BOYACA / SUTATENZA </option>
                  <option value="	301	"> BOYACA / TASCO </option>
                  <option value="	302	"> BOYACA / TENZA </option>
                  <option value="	303	"> BOYACA / TIBANA </option>
                  <option value="	304	"> BOYACA / TIBASOSA </option>
                  <option value="	305	"> BOYACA / TINJACA </option>
                  <option value="	306	"> BOYACA / TIPACOQUE </option>
                  <option value="	307	"> BOYACA / TOCA </option>
                  <option value="	308	"> BOYACA / TOGsI </option>
                  <option value="	309	"> BOYACA / TOPAGA </option>
                  <option value="	310	"> BOYACA / TOTA </option>
                  <option value="	311	"> BOYACA / TUNUNGUA </option>
                  <option value="	312	"> BOYACA / TURMEQUE </option>
                  <option value="	313	"> BOYACA / TUTA </option>
                  <option value="	314	"> BOYACA / TUTAZA </option>
                  <option value="	315	"> BOYACA / UMBITA </option>
                  <option value="	316	"> BOYACA / VENTAQUEMADA </option>
                  <option value="	317	"> BOYACA / VIRACACHA </option>
                  <option value="	318	"> BOYACA / ZETAQUIRA </option>
                  <option value="	319	"> CALDAS / MANIZALES </option>
                  <option value="	320	"> CALDAS / AGUADAS </option>
                  <option value="	321	"> CALDAS / ANSERMA </option>
                  <option value="	322	"> CALDAS / ARANZAZU </option>
                  <option value="	323	"> CALDAS / BELALCAZAR </option>
                  <option value="	324	"> CALDAS / CHINCHINA </option>
                  <option value="	325	"> CALDAS / FILADELFIA </option>
                  <option value="	326	"> CALDAS / LA DORADA </option>
                  <option value="	327	"> CALDAS / LA MERCED </option>
                  <option value="	328	"> CALDAS / MANZANARES </option>
                  <option value="	329	"> CALDAS / MARMATO </option>
                  <option value="	330	"> CALDAS / MARQUETALIA </option>
                  <option value="	331	"> CALDAS / MARULANDA </option>
                  <option value="	332	"> CALDAS / NEIRA </option>
                  <option value="	333	"> CALDAS / NORCASIA </option>
                  <option value="	334	"> CALDAS / PACORA </option>
                  <option value="	335	"> CALDAS / PALESTINA </option>
                  <option value="	336	"> CALDAS / PENSILVANIA </option>
                  <option value="	337	"> CALDAS / RIOSUCIO </option>
                  <option value="	338	"> CALDAS / RISARALDA </option>
                  <option value="	339	"> CALDAS / SALAMINA </option>
                  <option value="	340	"> CALDAS / SAMANA </option>
                  <option value="	341	"> CALDAS / SAN JOSE </option>
                  <option value="	342	"> CALDAS / SUPIA </option>
                  <option value="	343	"> CALDAS / VICTORIA </option>
                  <option value="	344	"> CALDAS / VILLAMARIA </option>
                  <option value="	345	"> CALDAS / VITERBO </option>
                  <option value="	346	"> CAQUETA / FLORENCIA </option>
                  <option value="	347	"> CAQUETA / ALBANIA </option>
                  <option value="	348	"> CAQUETA / BELEN DE LOS ANDAQUIES </option>
                  <option value="	349	"> CAQUETA / CARTAGENA DEL CHAIRA </option>
                  <option value="	350	"> CAQUETA / CURILLO </option>
                  <option value="	351	"> CAQUETA / EL DONCELLO </option>
                  <option value="	352	"> CAQUETA / EL PAUJIL </option>
                  <option value="	353	"> CAQUETA / LA MONTANITA </option>
                  <option value="	354	"> CAQUETA / MILAN </option>
                  <option value="	355	"> CAQUETA / MORELIA </option>
                  <option value="	356	"> CAQUETA / PUERTO RICO </option>
                  <option value="	357	"> CAQUETA / SAN JOSE DEL FRAGUA </option>
                  <option value="	358	"> CAQUETA / SAN VICENTE DEL CAGUAN </option>
                  <option value="	359	"> CAQUETA / SOLANO </option>
                  <option value="	360	"> CAQUETA / SOLITA </option>
                  <option value="	361	"> CAQUETA / VALPARAISO </option>
                  <option value="	362	"> CAUCA / POPAYAN </option>
                  <option value="	363	"> CAUCA / ALMAGUER </option>
                  <option value="	364	"> CAUCA / ARGELIA </option>
                  <option value="	365	"> CAUCA / BALBOA </option>
                  <option value="	366	"> CAUCA / BOLIVAR </option>
                  <option value="	367	"> CAUCA / BUENOS AIRES </option>
                  <option value="	368	"> CAUCA / CAJIBIO </option>
                  <option value="	369	"> CAUCA / CALDONO </option>
                  <option value="	370	"> CAUCA / CALOTO </option>
                  <option value="	371	"> CAUCA / CORINTO </option>
                  <option value="	372	"> CAUCA / EL TAMBO </option>
                  <option value="	373	"> CAUCA / FLORENCIA </option>
                  <option value="	374	"> CAUCA / GUACHENE </option>
                  <option value="	375	"> CAUCA / GUAPI </option>
                  <option value="	376	"> CAUCA / INZA </option>
                  <option value="	377	"> CAUCA / JAMBALO </option>
                  <option value="	378	"> CAUCA / LA SIERRA </option>
                  <option value="	379	"> CAUCA / LA VEGA </option>
                  <option value="	380	"> CAUCA / LOPEZ </option>
                  <option value="	381	"> CAUCA / MERCADERES </option>
                  <option value="	382	"> CAUCA / MIRANDA </option>
                  <option value="	383	"> CAUCA / MORALES </option>
                  <option value="	384	"> CAUCA / PADILLA </option>
                  <option value="	385	"> CAUCA / PAEZ </option>
                  <option value="	386	"> CAUCA / PATIA </option>
                  <option value="	387	"> CAUCA / PIAMONTE </option>
                  <option value="	388	"> CAUCA / PIENDAMO </option>
                  <option value="	389	"> CAUCA / PUERTO TEJADA </option>
                  <option value="	390	"> CAUCA / PURACE </option>
                  <option value="	391	"> CAUCA / ROSAS </option>
                  <option value="	392	"> CAUCA / SAN SEBASTIAN </option>
                  <option value="	393	"> CAUCA / SANTANDER DE QUILICHAO </option>
                  <option value="	394	"> CAUCA / SANTA ROSA </option>
                  <option value="	395	"> CAUCA / SILVIA </option>
                  <option value="	396	"> CAUCA / SOTARA </option>
                  <option value="	397	"> CAUCA / SUAREZ </option>
                  <option value="	398	"> CAUCA / SUCRE </option>
                  <option value="	399	"> CAUCA / TIMBIO </option>
                  <option value="	400	"> CAUCA / TIMBIQUI </option>
                  <option value="	401	"> CAUCA / TORIBIO </option>
                  <option value="	402	"> CAUCA / TOTORO </option>
                  <option value="	403	"> CAUCA / VILLA RICA </option>
                  <option value="	404	"> CESAR / VALLEDUPAR </option>
                  <option value="	405	"> CESAR / AGUACHICA </option>
                  <option value="	406	"> CESAR / AGUSTIN CODAZZI </option>
                  <option value="	407	"> CESAR / ASTREA </option>
                  <option value="	408	"> CESAR / BECERRIL </option>
                  <option value="	409	"> CESAR / BOSCONIA </option>
                  <option value="	410	"> CESAR / CHIMICHAGUA </option>
                  <option value="	411	"> CESAR / CHIRIGUANA </option>
                  <option value="	412	"> CESAR / CURUMANI </option>
                  <option value="	413	"> CESAR / EL COPEY </option>
                  <option value="	414	"> CESAR / EL PASO </option>
                  <option value="	415	"> CESAR / GAMARRA </option>
                  <option value="	416	"> CESAR / GONZALEZ </option>
                  <option value="	417	"> CESAR / LA GLORIA </option>
                  <option value="	418	"> CESAR / LA JAGUA DE IBIRICO </option>
                  <option value="	419	"> CESAR / MANAURE </option>
                  <option value="	420	"> CESAR / PAILITAS </option>
                  <option value="	421	"> CESAR / PELAYA </option>
                  <option value="	422	"> CESAR / PUEBLO BELLO </option>
                  <option value="	423	"> CESAR / RIO DE ORO </option>
                  <option value="	424	"> CESAR / LA PAZ </option>
                  <option value="	425	"> CESAR / SAN ALBERTO </option>
                  <option value="	426	"> CESAR / SAN DIEGO </option>
                  <option value="	427	"> CESAR / SAN MARTIN </option>
                  <option value="	428	"> CESAR / TAMALAMEQUE </option>
                  <option value="	429	"> CORDOBA / MONTERIA </option>
                  <option value="	430	"> CORDOBA / AYAPEL </option>
                  <option value="	431	"> CORDOBA / BUENAVISTA </option>
                  <option value="	432	"> CORDOBA / CANALETE </option>
                  <option value="	433	"> CORDOBA / CERETE </option>
                  <option value="	434	"> CORDOBA / CHIMA </option>
                  <option value="	435	"> CORDOBA / CHINU </option>
                  <option value="	436	"> CORDOBA / CIENAGA DE ORO </option>
                  <option value="	437	"> CORDOBA / COTORRA </option>
                  <option value="	438	"> CORDOBA / LA APARTADA </option>
                  <option value="	439	"> CORDOBA / LORICA </option>
                  <option value="	440	"> CORDOBA / LOS CORDOBAS </option>
                  <option value="	441	"> CORDOBA / MOMIL </option>
                  <option value="	442	"> CORDOBA / MONTELIBANO </option>
                  <option value="	443	"> CORDOBA / MONITOS </option>
                  <option value="	444	"> CORDOBA / PLANETA RICA </option>
                  <option value="	445	"> CORDOBA / PUEBLO NUEVO </option>
                  <option value="	446	"> CORDOBA / PUERTO ESCONDIDO </option>
                  <option value="	447	"> CORDOBA / PUERTO LIBERTADOR </option>
                  <option value="	448	"> CORDOBA / PURISIMA </option>
                  <option value="	449	"> CORDOBA / SAHAGUN </option>
                  <option value="	450	"> CORDOBA / SAN ANDRES SOTAVENTO </option>
                  <option value="	451	"> CORDOBA / SAN ANTERO </option>
                  <option value="	452	"> CORDOBA / SAN BERNARDO DEL VIENTO </option>
                  <option value="	453	"> CORDOBA / SAN CARLOS </option>
                  <option value="	454	"> CORDOBA / SAN JOSE DE URE </option>
                  <option value="	455	"> CORDOBA / SAN PELAYO </option>
                  <option value="	456	"> CORDOBA / TIERRALTA </option>
                  <option value="	457	"> CORDOBA / VALENCIA </option>
                  <option value="	458	"> CUNDINAMARCA / AGUA DE DIOS </option>
                  <option value="	459	"> CUNDINAMARCA / ALBAN </option>
                  <option value="	460	"> CUNDINAMARCA / ANAPOIMA </option>
                  <option value="	461	"> CUNDINAMARCA / ANOLAIMA </option>
                  <option value="	462	"> CUNDINAMARCA / ARBELAEZ </option>
                  <option value="	463	"> CUNDINAMARCA / BELTRAN </option>
                  <option value="	464	"> CUNDINAMARCA / BITUIMA </option>
                  <option value="	465	"> CUNDINAMARCA / BOJACA </option>
                  <option value="	466	"> CUNDINAMARCA / CABRERA </option>
                  <option value="	467	"> CUNDINAMARCA / CACHIPAY </option>
                  <option value="	468	"> CUNDINAMARCA / CAJICA </option>
                  <option value="	469	"> CUNDINAMARCA / CAPARRAPI </option>
                  <option value="	470	"> CUNDINAMARCA / CAQUEZA </option>
                  <option value="	471	"> CUNDINAMARCA / CARMEN DE CARUPA </option>
                  <option value="	472	"> CUNDINAMARCA / CHAGUANI </option>
                  <option value="	473	"> CUNDINAMARCA / CHIA </option>
                  <option value="	474	"> CUNDINAMARCA / CHIPAQUE </option>
                  <option value="	475	"> CUNDINAMARCA / CHOACHI </option>
                  <option value="	476	"> CUNDINAMARCA / CHOCONTA </option>
                  <option value="	477	"> CUNDINAMARCA / COGUA </option>
                  <option value="	478	"> CUNDINAMARCA / COTA </option>
                  <option value="	479	"> CUNDINAMARCA / CUCUNUBA </option>
                  <option value="	480	"> CUNDINAMARCA / EL COLEGIO </option>
                  <option value="	481	"> CUNDINAMARCA / EL PENON </option>
                  <option value="	482	"> CUNDINAMARCA / EL ROSAL </option>
                  <option value="	483	"> CUNDINAMARCA / FACATATIVA </option>
                  <option value="	484	"> CUNDINAMARCA / FOMEQUE </option>
                  <option value="	485	"> CUNDINAMARCA / FOSCA </option>
                  <option value="	486	"> CUNDINAMARCA / FUNZA </option>
                  <option value="	487	"> CUNDINAMARCA / FUQUENE </option>
                  <option value="	488	"> CUNDINAMARCA / FUSAGASUGA </option>
                  <option value="	489	"> CUNDINAMARCA / GACHALA </option>
                  <option value="	490	"> CUNDINAMARCA / GACHANCIPA </option>
                  <option value="	491	"> CUNDINAMARCA / GACHETA </option>
                  <option value="	492	"> CUNDINAMARCA / GAMA </option>
                  <option value="	493	"> CUNDINAMARCA / GIRARDOT </option>
                  <option value="	494	"> CUNDINAMARCA / GRANADA </option>
                  <option value="	495	"> CUNDINAMARCA / GUACHETA </option>
                  <option value="	496	"> CUNDINAMARCA / GUADUAS </option>
                  <option value="	497	"> CUNDINAMARCA / GUASCA </option>
                  <option value="	498	"> CUNDINAMARCA / GUATAQUI </option>
                  <option value="	499	"> CUNDINAMARCA / GUATAVITA </option>
                  <option value="	500	"> CUNDINAMARCA / GUAYABAL DE SIQUIMA </option>
                  <option value="	501	"> CUNDINAMARCA / GUAYABETAL </option>
                  <option value="	502	"> CUNDINAMARCA / GUTIERREZ </option>
                  <option value="	503	"> CUNDINAMARCA / JERUSALEN </option>
                  <option value="	504	"> CUNDINAMARCA / JUNIN </option>
                  <option value="	505	"> CUNDINAMARCA / LA CALERA </option>
                  <option value="	506	"> CUNDINAMARCA / LA MESA </option>
                  <option value="	507	"> CUNDINAMARCA / LA PALMA </option>
                  <option value="	508	"> CUNDINAMARCA / LA PENA </option>
                  <option value="	509	"> CUNDINAMARCA / LA VEGA </option>
                  <option value="	510	"> CUNDINAMARCA / LENGUAZAQUE </option>
                  <option value="	511	"> CUNDINAMARCA / MACHETA </option>
                  <option value="	512	"> CUNDINAMARCA / MADRID </option>
                  <option value="	513	"> CUNDINAMARCA / MANTA </option>
                  <option value="	514	"> CUNDINAMARCA / MEDINA </option>
                  <option value="	515	"> CUNDINAMARCA / MOSQUERA </option>
                  <option value="	516	"> CUNDINAMARCA / NARINO </option>
                  <option value="	517	"> CUNDINAMARCA / NEMOCON </option>
                  <option value="	518	"> CUNDINAMARCA / NILO </option>
                  <option value="	519	"> CUNDINAMARCA / NIMAIMA </option>
                  <option value="	520	"> CUNDINAMARCA / NOCAIMA </option>
                  <option value="	521	"> CUNDINAMARCA / VENECIA </option>
                  <option value="	522	"> CUNDINAMARCA / PACHO </option>
                  <option value="	523	"> CUNDINAMARCA / PAIME </option>
                  <option value="	524	"> CUNDINAMARCA / PANDI </option>
                  <option value="	525	"> CUNDINAMARCA / PARATEBUENO </option>
                  <option value="	526	"> CUNDINAMARCA / PASCA </option>
                  <option value="	527	"> CUNDINAMARCA / PUERTO SALGAR </option>
                  <option value="	528	"> CUNDINAMARCA / PULI </option>
                  <option value="	529	"> CUNDINAMARCA / QUEBRADANEGRA </option>
                  <option value="	530	"> CUNDINAMARCA / QUETAME </option>
                  <option value="	531	"> CUNDINAMARCA / QUIPILE </option>
                  <option value="	532	"> CUNDINAMARCA / APULO </option>
                  <option value="	533	"> CUNDINAMARCA / RICAURTE </option>
                  <option value="	534	"> CUNDINAMARCA / SAN ANTONIO DEL TEQUENDAMA </option>
                  <option value="	535	"> CUNDINAMARCA / SAN BERNARDO </option>
                  <option value="	536	"> CUNDINAMARCA / SAN CAYETANO </option>
                  <option value="	537	"> CUNDINAMARCA / SAN FRANCISCO </option>
                  <option value="	538	"> CUNDINAMARCA / SAN JUAN DE RIO SECO </option>
                  <option value="	539	"> CUNDINAMARCA / SASAIMA </option>
                  <option value="	540	"> CUNDINAMARCA / SESQUILE </option>
                  <option value="	541	"> CUNDINAMARCA / SIBATE </option>
                  <option value="	542	"> CUNDINAMARCA / SILVANIA </option>
                  <option value="	543	"> CUNDINAMARCA / SIMIJACA </option>
                  <option value="	544	"> CUNDINAMARCA / SOACHA </option>
                  <option value="	545	"> CUNDINAMARCA / SOPO </option>
                  <option value="	546	"> CUNDINAMARCA / SUBACHOQUE </option>
                  <option value="	547	"> CUNDINAMARCA / SUESCA </option>
                  <option value="	548	"> CUNDINAMARCA / SUPATA </option>
                  <option value="	549	"> CUNDINAMARCA / SUSA </option>
                  <option value="	550	"> CUNDINAMARCA / SUTATAUSA </option>
                  <option value="	551	"> CUNDINAMARCA / TABIO </option>
                  <option value="	552	"> CUNDINAMARCA / TAUSA </option>
                  <option value="	553	"> CUNDINAMARCA / TENA </option>
                  <option value="	554	"> CUNDINAMARCA / TENJO </option>
                  <option value="	555	"> CUNDINAMARCA / TIBACUY </option>
                  <option value="	556	"> CUNDINAMARCA / TIBIRITA </option>
                  <option value="	557	"> CUNDINAMARCA / TOCAIMA </option>
                  <option value="	558	"> CUNDINAMARCA / TOCANCIPA </option>
                  <option value="	559	"> CUNDINAMARCA / TOPAIPI </option>
                  <option value="	560	"> CUNDINAMARCA / UBALA </option>
                  <option value="	561	"> CUNDINAMARCA / UBAQUE </option>
                  <option value="	562	"> CUNDINAMARCA / UBATE </option>
                  <option value="	563	"> CUNDINAMARCA / UNE </option>
                  <option value="	564	"> CUNDINAMARCA / UTICA </option>
                  <option value="	565	"> CUNDINAMARCA / VERGARA </option>
                  <option value="	566	"> CUNDINAMARCA / VIANI </option>
                  <option value="	567	"> CUNDINAMARCA / VILLAGOMEZ </option>
                  <option value="	568	"> CUNDINAMARCA / VILLAPINZON </option>
                  <option value="	569	"> CUNDINAMARCA / VILLETA </option>
                  <option value="	570	"> CUNDINAMARCA / VIOTA </option>
                  <option value="	571	"> CUNDINAMARCA / YACOPI </option>
                  <option value="	572	"> CUNDINAMARCA / ZIPACON </option>
                  <option value="	573	"> CUNDINAMARCA / ZIPAQUIRA </option>
                  <option value="	574	"> CHOCO / QUIBDO </option>
                  <option value="	575	"> CHOCO / ACANDI </option>
                  <option value="	576	"> CHOCO / ALTO BAUDO </option>
                  <option value="	577	"> CHOCO / ATRATO </option>
                  <option value="	578	"> CHOCO / BAGADO </option>
                  <option value="	579	"> CHOCO / BAHIA SOLANO </option>
                  <option value="	580	"> CHOCO / BAJO BAUDO </option>
                  <option value="	581	"> CHOCO / BOJAYA </option>
                  <option value="	582	"> CHOCO / EL CANTON DEL SAN PABLO </option>
                  <option value="	583	"> CHOCO / CARMEN DEL DARIEN </option>
                  <option value="	584	"> CHOCO / CERTEGUI </option>
                  <option value="	585	"> CHOCO / CONDOTO </option>
                  <option value="	586	"> CHOCO / EL CARMEN DE ATRATO </option>
                  <option value="	587	"> CHOCO / EL LITORAL DEL SAN JUAN </option>
                  <option value="	588	"> CHOCO / ISTMINA </option>
                  <option value="	589	"> CHOCO / JURADO </option>
                  <option value="	590	"> CHOCO / LLORO </option>
                  <option value="	591	"> CHOCO / MEDIO ATRATO </option>
                  <option value="	592	"> CHOCO / MEDIO BAUDO </option>
                  <option value="	593	"> CHOCO / MEDIO SAN JUAN </option>
                  <option value="	594	"> CHOCO / NOVITA </option>
                  <option value="	595	"> CHOCO / NUQUI </option>
                  <option value="	596	"> CHOCO / RIO IRO </option>
                  <option value="	597	"> CHOCO / RIO QUITO </option>
                  <option value="	598	"> CHOCO / RIOSUCIO </option>
                  <option value="	599	"> CHOCO / SAN JOSE DEL PALMAR </option>
                  <option value="	600	"> CHOCO / SIPI </option>
                  <option value="	601	"> CHOCO / TADO </option>
                  <option value="	602	"> CHOCO / UNGUIA </option>
                  <option value="	603	"> CHOCO / UNION PANAMERICANA </option>
                  <option value="	604	"> HUILA / NEIVA </option>
                  <option value="	605	"> HUILA / ACEVEDO </option>
                  <option value="	606	"> HUILA / AGRADO </option>
                  <option value="	607	"> HUILA / AIPE </option>
                  <option value="	608	"> HUILA / ALGECIRAS </option>
                  <option value="	609	"> HUILA / ALTAMIRA </option>
                  <option value="	610	"> HUILA / BARAYA </option>
                  <option value="	611	"> HUILA / CAMPOALEGRE </option>
                  <option value="	612	"> HUILA / COLOMBIA </option>
                  <option value="	613	"> HUILA / ELIAS </option>
                  <option value="	614	"> HUILA / GARZON </option>
                  <option value="	615	"> HUILA / GIGANTE </option>
                  <option value="	616	"> HUILA / GUADALUPE </option>
                  <option value="	617	"> HUILA / HOBO </option>
                  <option value="	618	"> HUILA / IQUIRA </option>
                  <option value="	619	"> HUILA / ISNOS </option>
                  <option value="	620	"> HUILA / LA ARGENTINA </option>
                  <option value="	621	"> HUILA / LA PLATA </option>
                  <option value="	622	"> HUILA / NATAGA </option>
                  <option value="	623	"> HUILA / OPORAPA </option>
                  <option value="	624	"> HUILA / PAICOL </option>
                  <option value="	625	"> HUILA / PALERMO </option>
                  <option value="	626	"> HUILA / PALESTINA </option>
                  <option value="	627	"> HUILA / PITAL </option>
                  <option value="	628	"> HUILA / PITALITO </option>
                  <option value="	629	"> HUILA / RIVERA </option>
                  <option value="	630	"> HUILA / SALADOBLANCO </option>
                  <option value="	631	"> HUILA / SAN AGUSTIN </option>
                  <option value="	632	"> HUILA / SANTA MARIA </option>
                  <option value="	633	"> HUILA / SUAZA </option>
                  <option value="	634	"> HUILA / TARQUI </option>
                  <option value="	635	"> HUILA / TESALIA </option>
                  <option value="	636	"> HUILA / TELLO </option>
                  <option value="	637	"> HUILA / TERUEL </option>
                  <option value="	638	"> HUILA / TIMANA </option>
                  <option value="	639	"> HUILA / VILLAVIEJA </option>
                  <option value="	640	"> HUILA / YAGUARA </option>
                  <option value="	641	"> LA GUAJIRA / RIOHACHA </option>
                  <option value="	642	"> LA GUAJIRA / ALBANIA </option>
                  <option value="	643	"> LA GUAJIRA / BARRANCAS </option>
                  <option value="	644	"> LA GUAJIRA / DIBULLA </option>
                  <option value="	645	"> LA GUAJIRA / DISTRACCION </option>
                  <option value="	646	"> LA GUAJIRA / EL MOLINO </option>
                  <option value="	647	"> LA GUAJIRA / FONSECA </option>
                  <option value="	648	"> LA GUAJIRA / HATONUEVO </option>
                  <option value="	649	"> LA GUAJIRA / LA JAGUA DEL PILAR </option>
                  <option value="	650	"> LA GUAJIRA / MAICAO </option>
                  <option value="	651	"> LA GUAJIRA / MANAURE </option>
                  <option value="	652	"> LA GUAJIRA / SAN JUAN DEL CESAR </option>
                  <option value="	653	"> LA GUAJIRA / URIBIA </option>
                  <option value="	654	"> LA GUAJIRA / URUMITA </option>
                  <option value="	655	"> LA GUAJIRA / VILLANUEVA </option>
                  <option value="	656	"> MAGDALENA / SANTA MARTA </option>
                  <option value="	657	"> MAGDALENA / ALGARROBO </option>
                  <option value="	658	"> MAGDALENA / ARACATACA </option>
                  <option value="	659	"> MAGDALENA / ARIGUANI </option>
                  <option value="	660	"> MAGDALENA / CERRO SAN ANTONIO </option>
                  <option value="	661	"> MAGDALENA / CHIBOLO </option>
                  <option value="	662	"> MAGDALENA / CIENAGA </option>
                  <option value="	663	"> MAGDALENA / CONCORDIA </option>
                  <option value="	664	"> MAGDALENA / EL BANCO </option>
                  <option value="	665	"> MAGDALENA / EL PINON </option>
                  <option value="	666	"> MAGDALENA / EL RETEN </option>
                  <option value="	667	"> MAGDALENA / FUNDACION </option>
                  <option value="	668	"> MAGDALENA / GUAMAL </option>
                  <option value="	669	"> MAGDALENA / NUEVA GRANADA </option>
                  <option value="	670	"> MAGDALENA / PEDRAZA </option>
                  <option value="	671	"> MAGDALENA / PIJINO DEL CARMEN </option>
                  <option value="	672	"> MAGDALENA / PIVIJAY </option>
                  <option value="	673	"> MAGDALENA / PLATO </option>
                  <option value="	674	"> MAGDALENA / PUEBLOVIEJO </option>
                  <option value="	675	"> MAGDALENA / REMOLINO </option>
                  <option value="	676	"> MAGDALENA / SABANAS DE SAN ANGEL </option>
                  <option value="	677	"> MAGDALENA / SALAMINA </option>
                  <option value="	678	"> MAGDALENA / SAN SEBASTIAN DE BUENAVISTA </option>
                  <option value="	679	"> MAGDALENA / SAN ZENON </option>
                  <option value="	680	"> MAGDALENA / SANTA ANA </option>
                  <option value="	681	"> MAGDALENA / SANTA BARBARA DE PINTO </option>
                  <option value="	682	"> MAGDALENA / SITIONUEVO </option>
                  <option value="	683	"> MAGDALENA / TENERIFE </option>
                  <option value="	684	"> MAGDALENA / ZAPAYAN </option>
                  <option value="	685	"> MAGDALENA / ZONA BANANERA </option>
                  <option value="	686	"> META / VILLAVICENCIO </option>
                  <option value="	687	"> META / ACACIAS </option>
                  <option value="	688	"> META / BARRANCA DE UPIA </option>
                  <option value="	689	"> META / CABUYARO </option>
                  <option value="	690	"> META / CASTILLA LA NUEVA </option>
                  <option value="	691	"> META / CUBARRAL </option>
                  <option value="	692	"> META / CUMARAL </option>
                  <option value="	693	"> META / EL CALVARIO </option>
                  <option value="	694	"> META / EL CASTILLO </option>
                  <option value="	695	"> META / EL DORADO </option>
                  <option value="	696	"> META / FUENTE DE ORO </option>
                  <option value="	697	"> META / GRANADA </option>
                  <option value="	698	"> META / GUAMAL </option>
                  <option value="	699	"> META / MAPIRIPAN </option>
                  <option value="	700	"> META / MESETAS </option>
                  <option value="	701	"> META / LA MACARENA </option>
                  <option value="	702	"> META / URIBE </option>
                  <option value="	703	"> META / LEJANIAS </option>
                  <option value="	704	"> META / PUERTO CONCORDIA </option>
                  <option value="	705	"> META / PUERTO GAITAN </option>
                  <option value="	706	"> META / PUERTO LOPEZ </option>
                  <option value="	707	"> META / PUERTO LLERAS </option>
                  <option value="	708	"> META / PUERTO RICO </option>
                  <option value="	709	"> META / RESTREPO </option>
                  <option value="	710	"> META / SAN CARLOS DE GUAROA </option>
                  <option value="	711	"> META / SAN JUAN DE ARAMA </option>
                  <option value="	712	"> META / SAN JUANITO </option>
                  <option value="	713	"> META / SAN MARTIN </option>
                  <option value="	714	"> META / VISTAHERMOSA </option>
                  <option value="	715	"> NARIÃ‘O / PASTO </option>
                  <option value="	716	"> NARIÃ‘O / ALBAN </option>
                  <option value="	717	"> NARIÃ‘O / ALDANA </option>
                  <option value="	718	"> NARIÃ‘O / ANCUYA </option>
                  <option value="	719	"> NARIÃ‘O / ARBOLEDA </option>
                  <option value="	720	"> NARIÃ‘O / BARBACOAS </option>
                  <option value="	721	"> NARIÃ‘O / BELEN </option>
                  <option value="	722	"> NARIÃ‘O / BUESACO </option>
                  <option value="	723	"> NARIÃ‘O / COLON </option>
                  <option value="	724	"> NARIÃ‘O / CONSACA </option>
                  <option value="	725	"> NARIÃ‘O / CONTADERO </option>
                  <option value="	726	"> NARIÃ‘O / CORDOBA </option>
                  <option value="	727	"> NARIÃ‘O / CUASPUD </option>
                  <option value="	728	"> NARIÃ‘O / CUMBAL </option>
                  <option value="	729	"> NARIÃ‘O / CUMBITARA </option>
                  <option value="	730	"> NARIÃ‘O / CHACHAGsI </option>
                  <option value="	731	"> NARIÃ‘O / EL CHARCO </option>
                  <option value="	732	"> NARIÃ‘O / EL PENOL </option>
                  <option value="	733	"> NARIÃ‘O / EL ROSARIO </option>
                  <option value="	734	"> NARIÃ‘O / EL TABLON DE GOMEZ </option>
                  <option value="	735	"> NARIÃ‘O / EL TAMBO </option>
                  <option value="	736	"> NARIÃ‘O / FUNES </option>
                  <option value="	737	"> NARIÃ‘O / GUACHUCAL </option>
                  <option value="	738	"> NARIÃ‘O / GUAITARILLA </option>
                  <option value="	739	"> NARIÃ‘O / GUALMATAN </option>
                  <option value="	740	"> NARIÃ‘O / ILES </option>
                  <option value="	741	"> NARIÃ‘O / IMUES </option>
                  <option value="	742	"> NARIÃ‘O / IPIALES </option>
                  <option value="	743	"> NARIÃ‘O / LA CRUZ </option>
                  <option value="	744	"> NARIÃ‘O / LA FLORIDA </option>
                  <option value="	745	"> NARIÃ‘O / LA LLANADA </option>
                  <option value="	746	"> NARIÃ‘O / LA TOLA </option>
                  <option value="	747	"> NARIÃ‘O / LA UNION </option>
                  <option value="	748	"> NARIÃ‘O / LEIVA </option>
                  <option value="	749	"> NARIÃ‘O / LINARES </option>
                  <option value="	750	"> NARIÃ‘O / LOS ANDES </option>
                  <option value="	751	"> NARIÃ‘O / MAGsI </option>
                  <option value="	752	"> NARIÃ‘O / MALLAMA </option>
                  <option value="	753	"> NARIÃ‘O / MOSQUERA </option>
                  <option value="	754	"> NARIÃ‘O / NARINO </option>
                  <option value="	755	"> NARIÃ‘O / OLAYA HERRERA </option>
                  <option value="	756	"> NARIÃ‘O / OSPINA </option>
                  <option value="	757	"> NARIÃ‘O / FRANCISCO PIZARRO </option>
                  <option value="	758	"> NARIÃ‘O / POLICARPA </option>
                  <option value="	759	"> NARIÃ‘O / POTOSI </option>
                  <option value="	760	"> NARIÃ‘O / PROVIDENCIA </option>
                  <option value="	761	"> NARIÃ‘O / PUERRES </option>
                  <option value="	762	"> NARIÃ‘O / PUPIALES </option>
                  <option value="	763	"> NARIÃ‘O / RICAURTE </option>
                  <option value="	764	"> NARIÃ‘O / ROBERTO PAYAN </option>
                  <option value="	765	"> NARIÃ‘O / SAMANIEGO </option>
                  <option value="	766	"> NARIÃ‘O / SANDONA </option>
                  <option value="	767	"> NARIÃ‘O / SAN BERNARDO </option>
                  <option value="	768	"> NARIÃ‘O / SAN LORENZO </option>
                  <option value="	769	"> NARIÃ‘O / SAN PABLO </option>
                  <option value="	770	"> NARIÃ‘O / SAN PEDRO DE CARTAGO </option>
                  <option value="	771	"> NARIÃ‘O / SANTA BARBARA </option>
                  <option value="	772	"> NARIÃ‘O / SANTACRUZ </option>
                  <option value="	773	"> NARIÃ‘O / SAPUYES </option>
                  <option value="	774	"> NARIÃ‘O / TAMINANGO </option>
                  <option value="	775	"> NARIÃ‘O / TANGUA </option>
                  <option value="	776	"> NARIÃ‘O / SAN ANDRES DE TUMACO </option>
                  <option value="	777	"> NARIÃ‘O / TUQUERRES </option>
                  <option value="	778	"> NARIÃ‘O / YACUANQUER </option>
                  <option value="	779	"> NORTE DE SANTANDER / CUCUTA </option>
                  <option value="	780	"> NORTE DE SANTANDER / ABREGO </option>
                  <option value="	781	"> NORTE DE SANTANDER / ARBOLEDAS </option>
                  <option value="	782	"> NORTE DE SANTANDER / BOCHALEMA </option>
                  <option value="	783	"> NORTE DE SANTANDER / BUCARASICA </option>
                  <option value="	784	"> NORTE DE SANTANDER / CACOTA </option>
                  <option value="	785	"> NORTE DE SANTANDER / CACHIRA </option>
                  <option value="	786	"> NORTE DE SANTANDER / CHINACOTA </option>
                  <option value="	787	"> NORTE DE SANTANDER / CHITAGA </option>
                  <option value="	788	"> NORTE DE SANTANDER / CONVENCION </option>
                  <option value="	789	"> NORTE DE SANTANDER / CUCUTILLA </option>
                  <option value="	790	"> NORTE DE SANTANDER / DURANIA </option>
                  <option value="	791	"> NORTE DE SANTANDER / EL CARMEN </option>
                  <option value="	792	"> NORTE DE SANTANDER / EL TARRA </option>
                  <option value="	793	"> NORTE DE SANTANDER / EL ZULIA </option>
                  <option value="	794	"> NORTE DE SANTANDER / GRAMALOTE </option>
                  <option value="	795	"> NORTE DE SANTANDER / HACARI </option>
                  <option value="	796	"> NORTE DE SANTANDER / HERRAN </option>
                  <option value="	797	"> NORTE DE SANTANDER / LABATECA </option>
                  <option value="	798	"> NORTE DE SANTANDER / LA ESPERANZA </option>
                  <option value="	799	"> NORTE DE SANTANDER / LA PLAYA </option>
                  <option value="	800	"> NORTE DE SANTANDER / LOS PATIOS </option>
                  <option value="	801	"> NORTE DE SANTANDER / LOURDES </option>
                  <option value="	802	"> NORTE DE SANTANDER / MUTISCUA </option>
                  <option value="	803	"> NORTE DE SANTANDER / OCAÃ‘A </option>
                  <option value="	804	"> NORTE DE SANTANDER / PAMPLONA </option>
                  <option value="	805	"> NORTE DE SANTANDER / PAMPLONITA </option>
                  <option value="	806	"> NORTE DE SANTANDER / PUERTO SANTANDER </option>
                  <option value="	807	"> NORTE DE SANTANDER / RAGONVALIA </option>
                  <option value="	808	"> NORTE DE SANTANDER / SALAZAR </option>
                  <option value="	809	"> NORTE DE SANTANDER / SAN CALIXTO </option>
                  <option value="	810	"> NORTE DE SANTANDER / SAN CAYETANO </option>
                  <option value="	811	"> NORTE DE SANTANDER / SANTIAGO </option>
                  <option value="	812	"> NORTE DE SANTANDER / SARDINATA </option>
                  <option value="	813	"> NORTE DE SANTANDER / SILOS </option>
                  <option value="	814	"> NORTE DE SANTANDER / TEORAMA </option>
                  <option value="	815	"> NORTE DE SANTANDER / TIBU </option>
                  <option value="	816	"> NORTE DE SANTANDER / TOLEDO </option>
                  <option value="	817	"> NORTE DE SANTANDER / VILLA CARO </option>
                  <option value="	818	"> NORTE DE SANTANDER / VILLA DEL ROSARIO </option>
                  <option value="	819	"> QUINDIO / ARMENIA </option>
                  <option value="	820	"> QUINDIO / BUENAVISTA </option>
                  <option value="	821	"> QUINDIO / CALARCA </option>
                  <option value="	822	"> QUINDIO / CIRCASIA </option>
                  <option value="	823	"> QUINDIO / CORDOBA </option>
                  <option value="	824	"> QUINDIO / FILANDIA </option>
                  <option value="	825	"> QUINDIO / GENOVA </option>
                  <option value="	826	"> QUINDIO / LA TEBAIDA </option>
                  <option value="	827	"> QUINDIO / MONTENEGRO </option>
                  <option value="	828	"> QUINDIO / PIJAO </option>
                  <option value="	829	"> QUINDIO / QUIMBAYA </option>
                  <option value="	830	"> QUINDIO / SALENTO </option>
                  <option value="	831	"> RISARALDA / PEREIRA </option>
                  <option value="	832	"> RISARALDA / APIA </option>
                  <option value="	833	"> RISARALDA / BALBOA </option>
                  <option value="	834	"> RISARALDA / BELEN DE UMBRIA </option>
                  <option value="	835	"> RISARALDA / DOSQUEBRADAS </option>
                  <option value="	836	"> RISARALDA / GUATICA </option>
                  <option value="	837	"> RISARALDA / LA CELIA </option>
                  <option value="	838	"> RISARALDA / LA VIRGINIA </option>
                  <option value="	839	"> RISARALDA / MARSELLA </option>
                  <option value="	840	"> RISARALDA / MISTRATO </option>
                  <option value="	841	"> RISARALDA / PUEBLO RICO </option>
                  <option value="	842	"> RISARALDA / QUINCHIA </option>
                  <option value="	843	"> RISARALDA / SANTA ROSA DE CABAL </option>
                  <option value="	844	"> RISARALDA / SANTUARIO </option>
                  <option value="	845	"> SANTANDER / BUCARAMANGA </option>
                  <option value="	846	"> SANTANDER / AGUADA </option>
                  <option value="	847	"> SANTANDER / ALBANIA </option>
                  <option value="	848	"> SANTANDER / ARATOCA </option>
                  <option value="	849	"> SANTANDER / BARBOSA </option>
                  <option value="	850	"> SANTANDER / BARICHARA </option>
                  <option value="	851	"> SANTANDER / BARRANCABERMEJA </option>
                  <option value="	852	"> SANTANDER / BETULIA </option>
                  <option value="	853	"> SANTANDER / BOLIVAR </option>
                  <option value="	854	"> SANTANDER / CABRERA </option>
                  <option value="	855	"> SANTANDER / CALIFORNIA </option>
                  <option value="	856	"> SANTANDER / CAPITANEJO </option>
                  <option value="	857	"> SANTANDER / CARCASI </option>
                  <option value="	858	"> SANTANDER / CEPITA </option>
                  <option value="	859	"> SANTANDER / CERRITO </option>
                  <option value="	860	"> SANTANDER / CHARALA </option>
                  <option value="	861	"> SANTANDER / CHARTA </option>
                  <option value="	862	"> SANTANDER / CHIMA </option>
                  <option value="	863	"> SANTANDER / CHIPATA </option>
                  <option value="	864	"> SANTANDER / CIMITARRA </option>
                  <option value="	865	"> SANTANDER / CONCEPCION </option>
                  <option value="	866	"> SANTANDER / CONFINES </option>
                  <option value="	867	"> SANTANDER / CONTRATACION </option>
                  <option value="	868	"> SANTANDER / COROMORO </option>
                  <option value="	869	"> SANTANDER / CURITI </option>
                  <option value="	870	"> SANTANDER / EL CARMEN DE CHUCURI </option>
                  <option value="	871	"> SANTANDER / EL GUACAMAYO </option>
                  <option value="	872	"> SANTANDER / EL PENON </option>
                  <option value="	873	"> SANTANDER / EL PLAYON </option>
                  <option value="	874	"> SANTANDER / ENCINO </option>
                  <option value="	875	"> SANTANDER / ENCISO </option>
                  <option value="	876	"> SANTANDER / FLORIAN </option>
                  <option value="	877	"> SANTANDER / FLORIDABLANCA </option>
                  <option value="	878	"> SANTANDER / GALAN </option>
                  <option value="	879	"> SANTANDER / GAMBITA </option>
                  <option value="	880	"> SANTANDER / GIRON </option>
                  <option value="	881	"> SANTANDER / GUACA </option>
                  <option value="	882	"> SANTANDER / GUADALUPE </option>
                  <option value="	883	"> SANTANDER / GUAPOTA </option>
                  <option value="	884	"> SANTANDER / GUAVATA </option>
                  <option value="	885	"> SANTANDER / GUEPSA </option>
                  <option value="	886	"> SANTANDER / HATO </option>
                  <option value="	887	"> SANTANDER / JESUS MARIA </option>
                  <option value="	888	"> SANTANDER / JORDAN </option>
                  <option value="	889	"> SANTANDER / LA BELLEZA </option>
                  <option value="	890	"> SANTANDER / LANDAZURI </option>
                  <option value="	891	"> SANTANDER / LA PAZ </option>
                  <option value="	892	"> SANTANDER / LEBRIJA </option>
                  <option value="	893	"> SANTANDER / LOS SANTOS </option>
                  <option value="	894	"> SANTANDER / MACARAVITA </option>
                  <option value="	895	"> SANTANDER / MALAGA </option>
                  <option value="	896	"> SANTANDER / MATANZA </option>
                  <option value="	897	"> SANTANDER / MOGOTES </option>
                  <option value="	898	"> SANTANDER / MOLAGAVITA </option>
                  <option value="	899	"> SANTANDER / OCAMONTE </option>
                  <option value="	900	"> SANTANDER / OIBA </option>
                  <option value="	901	"> SANTANDER / ONZAGA </option>
                  <option value="	902	"> SANTANDER / PALMAR </option>
                  <option value="	903	"> SANTANDER / PALMAS DEL SOCORRO </option>
                  <option value="	904	"> SANTANDER / PARAMO </option>
                  <option value="	905	"> SANTANDER / PIEDECUESTA </option>
                  <option value="	906	"> SANTANDER / PINCHOTE </option>
                  <option value="	907	"> SANTANDER / PUENTE NACIONAL </option>
                  <option value="	908	"> SANTANDER / PUERTO PARRA </option>
                  <option value="	909	"> SANTANDER / PUERTO WILCHES </option>
                  <option value="	910	"> SANTANDER / RIONEGRO </option>
                  <option value="	911	"> SANTANDER / SABANA DE TORRES </option>
                  <option value="	912	"> SANTANDER / SAN ANDRES </option>
                  <option value="	913	"> SANTANDER / SAN BENITO </option>
                  <option value="	914	"> SANTANDER / SAN GIL </option>
                  <option value="	915	"> SANTANDER / SAN JOAQUIN </option>
                  <option value="	916	"> SANTANDER / SAN JOSE DE MIRANDA </option>
                  <option value="	917	"> SANTANDER / SAN MIGUEL </option>
                  <option value="	918	"> SANTANDER / SAN VICENTE DE CHUCURI </option>
                  <option value="	919	"> SANTANDER / SANTA BARBARA </option>
                  <option value="	920	"> SANTANDER / SANTA HELENA DEL OPON </option>
                  <option value="	921	"> SANTANDER / SIMACOTA </option>
                  <option value="	922	"> SANTANDER / SOCORRO </option>
                  <option value="	923	"> SANTANDER / SUAITA </option>
                  <option value="	924	"> SANTANDER / SUCRE </option>
                  <option value="	925	"> SANTANDER / SURATA </option>
                  <option value="	926	"> SANTANDER / TONA </option>
                  <option value="	927	"> SANTANDER / VALLE DE SAN JOSE </option>
                  <option value="	928	"> SANTANDER / VELEZ </option>
                  <option value="	929	"> SANTANDER / VETAS </option>
                  <option value="	930	"> SANTANDER / VILLANUEVA </option>
                  <option value="	931	"> SANTANDER / ZAPATOCA </option>
                  <option value="	932	"> SUCRE / SINCELEJO </option>
                  <option value="	933	"> SUCRE / BUENAVISTA </option>
                  <option value="	934	"> SUCRE / CAIMITO </option>
                  <option value="	935	"> SUCRE / COLOSO </option>
                  <option value="	936	"> SUCRE / COROZAL </option>
                  <option value="	937	"> SUCRE / COVENAS </option>
                  <option value="	938	"> SUCRE / CHALAN </option>
                  <option value="	939	"> SUCRE / EL ROBLE </option>
                  <option value="	940	"> SUCRE / GALERAS </option>
                  <option value="	941	"> SUCRE / GUARANDA </option>
                  <option value="	942	"> SUCRE / LA UNION </option>
                  <option value="	943	"> SUCRE / LOS PALMITOS </option>
                  <option value="	944	"> SUCRE / MAJAGUAL </option>
                  <option value="	945	"> SUCRE / MORROA </option>
                  <option value="	946	"> SUCRE / OVEJAS </option>
                  <option value="	947	"> SUCRE / PALMITO </option>
                  <option value="	948	"> SUCRE / SAMPUES </option>
                  <option value="	949	"> SUCRE / SAN BENITO ABAD </option>
                  <option value="	950	"> SUCRE / SAN JUAN DE BETULIA </option>
                  <option value="	951	"> SUCRE / SAN MARCOS </option>
                  <option value="	952	"> SUCRE / SAN ONOFRE </option>
                  <option value="	953	"> SUCRE / SAN PEDRO </option>
                  <option value="	954	"> SUCRE / SAN LUIS DE SINCE </option>
                  <option value="	955	"> SUCRE / SUCRE </option>
                  <option value="	956	"> SUCRE / SANTIAGO DE TOLU </option>
                  <option value="	957	"> SUCRE / TOLU VIEJO </option>
                  <option value="	958	"> TOLIMA / IBAGUE </option>
                  <option value="	959	"> TOLIMA / ALPUJARRA </option>
                  <option value="	960	"> TOLIMA / ALVARADO </option>
                  <option value="	961	"> TOLIMA / AMBALEMA </option>
                  <option value="	962	"> TOLIMA / ANZOATEGUI </option>
                  <option value="	963	"> TOLIMA / ARMERO </option>
                  <option value="	964	"> TOLIMA / ATACO </option>
                  <option value="	965	"> TOLIMA / CAJAMARCA </option>
                  <option value="	966	"> TOLIMA / CARMEN DE APICALA </option>
                  <option value="	967	"> TOLIMA / CASABIANCA </option>
                  <option value="	968	"> TOLIMA / CHAPARRAL </option>
                  <option value="	969	"> TOLIMA / COELLO </option>
                  <option value="	970	"> TOLIMA / COYAIMA </option>
                  <option value="	971	"> TOLIMA / CUNDAY </option>
                  <option value="	972	"> TOLIMA / DOLORES </option>
                  <option value="	973	"> TOLIMA / ESPINAL </option>
                  <option value="	974	"> TOLIMA / FALAN </option>
                  <option value="	975	"> TOLIMA / FLANDES </option>
                  <option value="	976	"> TOLIMA / FRESNO </option>
                  <option value="	977	"> TOLIMA / GUAMO </option>
                  <option value="	978	"> TOLIMA / HERVEO </option>
                  <option value="	979	"> TOLIMA / HONDA </option>
                  <option value="	980	"> TOLIMA / ICONONZO </option>
                  <option value="	981	"> TOLIMA / LERIDA </option>
                  <option value="	982	"> TOLIMA / LIBANO </option>
                  <option value="	983	"> TOLIMA / MARIQUITA </option>
                  <option value="	984	"> TOLIMA / MELGAR </option>
                  <option value="	985	"> TOLIMA / MURILLO </option>
                  <option value="	986	"> TOLIMA / NATAGAIMA </option>
                  <option value="	987	"> TOLIMA / ORTEGA </option>
                  <option value="	988	"> TOLIMA / PALOCABILDO </option>
                  <option value="	989	"> TOLIMA / PIEDRAS </option>
                  <option value="	990	"> TOLIMA / PLANADAS </option>
                  <option value="	991	"> TOLIMA / PRADO </option>
                  <option value="	992	"> TOLIMA / PURIFICACION </option>
                  <option value="	993	"> TOLIMA / RIOBLANCO </option>
                  <option value="	994	"> TOLIMA / RONCESVALLES </option>
                  <option value="	995	"> TOLIMA / ROVIRA </option>
                  <option value="	996	"> TOLIMA / SALDANA </option>
                  <option value="	997	"> TOLIMA / SAN ANTONIO </option>
                  <option value="	998	"> TOLIMA / SAN LUIS </option>
                  <option value="	999	"> TOLIMA / SANTA ISABEL </option>
                  <option value="	1000	"> TOLIMA / SUAREZ </option>
                  <option value="	1001	"> TOLIMA / VALLE DE SAN JUAN </option>
                  <option value="	1002	"> TOLIMA / VENADILLO </option>
                  <option value="	1003	"> TOLIMA / VILLAHERMOSA </option>
                  <option value="	1004	"> TOLIMA / VILLARRICA </option>
                  <option value="	1005	"> VALLE DEL CAUCA / CALI </option>
                  <option value="	1006	"> VALLE DEL CAUCA / ALCALA </option>
                  <option value="	1007	"> VALLE DEL CAUCA / ANDALUCIA </option>
                  <option value="	1008	"> VALLE DEL CAUCA / ANSERMANUEVO </option>
                  <option value="	1009	"> VALLE DEL CAUCA / ARGELIA </option>
                  <option value="	1010	"> VALLE DEL CAUCA / BOLIVAR </option>
                  <option value="	1011	"> VALLE DEL CAUCA / BUENAVENTURA </option>
                  <option value="	1012	"> VALLE DEL CAUCA / GUADALAJARA DE BUGA </option>
                  <option value="	1013	"> VALLE DEL CAUCA / BUGALAGRANDE </option>
                  <option value="	1014	"> VALLE DEL CAUCA / CAICEDONIA </option>
                  <option value="	1015	"> VALLE DEL CAUCA / CALIMA </option>
                  <option value="	1016	"> VALLE DEL CAUCA / CANDELARIA </option>
                  <option value="	1017	"> VALLE DEL CAUCA / CARTAGO </option>
                  <option value="	1018	"> VALLE DEL CAUCA / DAGUA </option>
                  <option value="	1019	"> VALLE DEL CAUCA / EL AGUILA </option>
                  <option value="	1020	"> VALLE DEL CAUCA / EL CAIRO </option>
                  <option value="	1021	"> VALLE DEL CAUCA / EL CERRITO </option>
                  <option value="	1022	"> VALLE DEL CAUCA / EL DOVIO </option>
                  <option value="	1023	"> VALLE DEL CAUCA / FLORIDA </option>
                  <option value="	1024	"> VALLE DEL CAUCA / GINEBRA </option>
                  <option value="	1025	"> VALLE DEL CAUCA / GUACARI </option>
                  <option value="	1026	"> VALLE DEL CAUCA / JAMUNDI </option>
                  <option value="	1027	"> VALLE DEL CAUCA / LA CUMBRE </option>
                  <option value="	1028	"> VALLE DEL CAUCA / LA UNION </option>
                  <option value="	1029	"> VALLE DEL CAUCA / LA VICTORIA </option>
                  <option value="	1030	"> VALLE DEL CAUCA / OBANDO </option>
                  <option value="	1031	"> VALLE DEL CAUCA / PALMIRA </option>
                  <option value="	1032	"> VALLE DEL CAUCA / PRADERA </option>
                  <option value="	1033	"> VALLE DEL CAUCA / RESTREPO </option>
                  <option value="	1034	"> VALLE DEL CAUCA / RIOFRIO </option>
                  <option value="	1035	"> VALLE DEL CAUCA / ROLDANILLO </option>
                  <option value="	1036	"> VALLE DEL CAUCA / SAN PEDRO </option>
                  <option value="	1037	"> VALLE DEL CAUCA / SEVILLA </option>
                  <option value="	1038	"> VALLE DEL CAUCA / TORO </option>
                  <option value="	1039	"> VALLE DEL CAUCA / TRUJILLO </option>
                  <option value="	1040	"> VALLE DEL CAUCA / TULUA </option>
                  <option value="	1041	"> VALLE DEL CAUCA / ULLOA </option>
                  <option value="	1042	"> VALLE DEL CAUCA / VERSALLES </option>
                  <option value="	1043	"> VALLE DEL CAUCA / VIJES </option>
                  <option value="	1044	"> VALLE DEL CAUCA / YOTOCO </option>
                  <option value="	1045	"> VALLE DEL CAUCA / YUMBO </option>
                  <option value="	1046	"> VALLE DEL CAUCA / ZARZAL </option>
                  <option value="	1047	"> ARAUCA / ARAUCA </option>
                  <option value="	1048	"> ARAUCA / ARAUQUITA </option>
                  <option value="	1049	"> ARAUCA / CRAVO NORTE </option>
                  <option value="	1050	"> ARAUCA / FORTUL </option>
                  <option value="	1051	"> ARAUCA / PUERTO RONDON </option>
                  <option value="	1052	"> ARAUCA / SARAVENA </option>
                  <option value="	1053	"> ARAUCA / TAME </option>
                  <option value="	1054	"> CASANARE / YOPAL </option>
                  <option value="	1055	"> CASANARE / AGUAZUL </option>
                  <option value="	1056	"> CASANARE / CHAMEZA </option>
                  <option value="	1057	"> CASANARE / HATO COROZAL </option>
                  <option value="	1058	"> CASANARE / LA SALINA </option>
                  <option value="	1059	"> CASANARE / MANI </option>
                  <option value="	1060	"> CASANARE / MONTERREY </option>
                  <option value="	1061	"> CASANARE / NUNCHIA </option>
                  <option value="	1062	"> CASANARE / OROCUE </option>
                  <option value="	1063	"> CASANARE / PAZ DE ARIPORO </option>
                  <option value="	1064	"> CASANARE / PORE </option>
                  <option value="	1065	"> CASANARE / RECETOR </option>
                  <option value="	1066	"> CASANARE / SABANALARGA </option>
                  <option value="	1067	"> CASANARE / SACAMA </option>
                  <option value="	1068	"> CASANARE / SAN LUIS DE PALENQUE </option>
                  <option value="	1069	"> CASANARE / TAMARA </option>
                  <option value="	1070	"> CASANARE / TAURAMENA </option>
                  <option value="	1071	"> CASANARE / TRINIDAD </option>
                  <option value="	1072	"> CASANARE / VILLANUEVA </option>
                  <option value="	1073	"> PUTUMAYO / MOCOA </option>
                  <option value="	1074	"> PUTUMAYO / COLON </option>
                  <option value="	1075	"> PUTUMAYO / ORITO </option>
                  <option value="	1076	"> PUTUMAYO / PUERTO ASIS </option>
                  <option value="	1077	"> PUTUMAYO / PUERTO CAICEDO </option>
                  <option value="	1078	"> PUTUMAYO / PUERTO GUZMAN </option>
                  <option value="	1079	"> PUTUMAYO / LEGUIZAMO </option>
                  <option value="	1080	"> PUTUMAYO / SIBUNDOY </option>
                  <option value="	1081	"> PUTUMAYO / SAN FRANCISCO </option>
                  <option value="	1082	"> PUTUMAYO / SAN MIGUEL </option>
                  <option value="	1083	"> PUTUMAYO / SANTIAGO </option>
                  <option value="	1084	"> PUTUMAYO / VALLE DEL GUAMUEZ </option>
                  <option value="	1085	"> PUTUMAYO / VILLAGARZON </option>
                  <option value="	1086	"> SAN ANDRES / SAN ANDRES </option>
                  <option value="	1087	"> SAN ANDRES / PROVIDENCIA </option>
                  <option value="	1088	"> AMAZONAS / LETICIA </option>
                  <option value="	1089	"> AMAZONAS / EL ENCANTO </option>
                  <option value="	1090	"> AMAZONAS / LA CHORRERA </option>
                  <option value="	1091	"> AMAZONAS / LA PEDRERA </option>
                  <option value="	1092	"> AMAZONAS / LA VICTORIA </option>
                  <option value="	1093	"> AMAZONAS / MIRITI - PARANA </option>
                  <option value="	1094	"> AMAZONAS / PUERTO ALEGRIA </option>
                  <option value="	1095	"> AMAZONAS / PUERTO ARICA </option>
                  <option value="	1096	"> AMAZONAS / PUERTO NARINO </option>
                  <option value="	1097	"> AMAZONAS / PUERTO SANTANDER </option>
                  <option value="	1098	"> AMAZONAS / TARAPACA </option>
                  <option value="	1099	"> GUAINIA / INIRIDA </option>
                  <option value="	1100	"> GUAINIA / BARRANCO MINAS </option>
                  <option value="	1101	"> GUAINIA / MAPIRIPANA </option>
                  <option value="	1102	"> GUAINIA / SAN FELIPE </option>
                  <option value="	1103	"> GUAINIA / PUERTO COLOMBIA </option>
                  <option value="	1104	"> GUAINIA / LA GUADALUPE </option>
                  <option value="	1105	"> GUAINIA / CACAHUAL </option>
                  <option value="	1106	"> GUAINIA / PANA PANA </option>
                  <option value="	1107	"> GUAINIA / MORICHAL </option>
                  <option value="	1108	"> GUAVIARE / SAN JOSE DEL GUAVIARE </option>
                  <option value="	1109	"> GUAVIARE / CALAMAR </option>
                  <option value="	1110	"> GUAVIARE / EL RETORNO </option>
                  <option value="	1111	"> GUAVIARE / MIRAFLORES </option>
                  <option value="	1112	"> VAUPES / MITU </option>
                  <option value="	1113	"> VAUPES / CARURU </option>
                  <option value="	1114	"> VAUPES / PACOA </option>
                  <option value="	1115	"> VAUPES / TARAIRA </option>
                  <option value="	1116	"> VAUPES / PAPUNAUA </option>
                  <option value="	1117	"> VAUPES / YAVARATE </option>
                  <option value="	1118	"> VICHADA / PUERTO CARRENO </option>
                  <option value="	1119	"> VICHADA / LA PRIMAVERA </option>
                  <option value="	1120	"> VICHADA / SANTA ROSALIA </option>
                  <option value="	1121	"> VICHADA / CUMARIBO </option>


                </select>
              </div>












              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Nombre completo de su hijo (a):</label>
                <input type="text" class="form-control" name="nombre_hijo" required>
              </div>


              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de documento de su hijo (a):</label>
                <select class="form-control" name="id_tipo_documento_hijo" required>
                  <option value="" selected></option>
                  <?php // echo lista('tipo_documento'); 
                  ?>
                  <option value="	1	"> Cédula de ciudadania </option>
                  <option value="	2	"> Cédula de extranjeria </option>
                  <option value="	3	"> Pasaporte </option>
                  <option value="	4	"> Nit </option>
                  <option value="	5	"> Tarjeta de identidad </option>
                  <option value="	6	"> Registro civil de nacimiento </option>
                  <option value="	7	"> N&uacute;mero de oficio externo </option>
                  <option value="	8	"> DNI - Documento nacional de identidad </option>
                  <option value="	9	"> PEP - Permiso especial de permanencia </option>
                  <option value="	10	"> Menor extranjero residente en Colombia </option>
                  <option value="	11	"> Certificado electoral </option>
                  <option value="	12	"> Permiso de proteccion temporal </option>
                  <option value="	13	"> Cedula Electoral </option>

                </select>
              </div>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Número de identificación de su hijo (a):</label>
                <input type="text" class="form-control" name="documento_id_hijo" required>
              </div>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Genero de su hijo (a):</label>
                <select class="form-control" name="genero_hijo" required>
                  <option value="" selected></option>
                  <option>Femenino</option> 
                  <option>Masculino</option> 
                </select>
              </div>






              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Fecha de Nacimiento de su hijo (a):</label>
                <input type="text" class="form-control datepickera" name="nacimiento_hijo" readonly required>
              </div>






              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Nivel Educativo / escolaridad de su hijo (a):</label>
                <select class="form-control" name="nombre_incentivo_educativo" required>
                  <option value="" selected></option>
                  <option>Preescolar</option> 
                  <option>Primaria</option> 
                  <option>Secundaria</option> 
                  <option>Pregrado</option> 
                  <option>Postgrado</option>
                </select>
              </div>






              <script>
                function fileValidation() {
                  var fileInput = document.getElementById('file');
                  var filePath = fileInput.value;
                  var allowedExtensions = /(.pdf)$/i;

                  var fsize = 10000;
                  var fileSize = fileInput.files[0].size;
                  var siezekiloByte = parseInt(fileSize / 1024);

                  if (!allowedExtensions.exec(filePath)) {
                    alert('Solo se permite extension pdf');
                    fileInput.value = '';
                    return false;


                  } else {

                    if (siezekiloByte < fsize) {

                      if (fileInput.files && fileInput.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                          document.getElementById('imagePreview').innerHTML = 'ok';
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                      }

                    } else {
                      alert('Debe ser inferior a 10000 Kb, el archivo cargado es de ' + siezekiloByte + ' Kb');
                      fileInput.value = '';
                      return false;
                    }


                  }
                }
              </script>

              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> <b>Adjunte en un solo PDF:</b><br>
                </label>
                <br>* Registro Civil de Nacimiento con el fin de establecer el parentesco y la edad.
                <br>* Certificación de pago de matrícula o una certificación académica donde conste el grado académico en el que se encuentra matriculado su hijo (a) y el año lectivo.
                <br>* Formato de declaración juramentada donde exprese bajo gravedad de juramento que la información anexada es autentica. (Cada funcionario deberá realizar una carta y autenticarla ante cualquier notaria).
                <input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
                <span style="color:#B40404;font-size:13px;">PDF inferior a 10 Mg / </span>
                <div id="imagePreview"></div>
              </div>

              <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                  <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <button type="submit" class="btn btn-success">
                  <input type="hidden" name="table" value="instruccion_admin">
                  <span class="glyphicon glyphicon-ok"></span> Crear </button>
              </div>

            </form>


          </div>
        </div>
      </div>
    </div>





    <div class="modal fade" id="popupactualizarincentivo_educativo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            <h4 class="modal-title" id="myModalLabel"><b>Actualizar</b></h4>
          </div>
          <div id="ver_actualizarincentivo_educativo" class="modal-body">

          </div>
        </div>
      </div>
    </div>

<?php } else {
  }
} else {
} ?>
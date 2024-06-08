<?php
$nump135 = privilegios(135, $_SESSION['snr']); // Administrador Hoja de Vida Bien Inmueble

$id = $_GET['i'];
if (isset($id)) {

  // Fecha Actual
  date_default_timezone_set("America/Bogota");
  $fechaActual = date("Y-m-d H:i:s");
  $anoActual = date("Y");

  // UPDATE Información Bien Inmueble 
  if (
    isset($_POST["campohvinmueble"]) && $_POST["campohvinmueble"] != ""
  ) {
    $campo = $_POST["campohvinmueble"];
    $cambio = "'" . $_POST["$campo"] . "'";
    $updateQuery = "UPDATE oficina_registro_inmueble 
    SET $campo = $cambio
    WHERE id_oficina_registro_inmueble = $id";
    if ($mysqli->query($updateQuery) === TRUE) {
      // auditoria($idControlDisciplinario, 'Activo Expediente', $idControlDisciplinario, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
    } else {
      echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
    }
    echo '<meta http-equiv="refresh" content="0;URL=./orip_hv_inmueble_detalle&' . $id . '.jsp" />';
  }

  // INSERT DE ANEXOS 
  if (
    isset($_FILES['file']) && "" != $_FILES['file'] &&
    isset($_POST['guardar_nuevo_pdf']) && "" != $_POST['guardar_nuevo_pdf'] &&
    isset($_POST['ano']) && "" != $_POST['ano'] &&
    isset($_POST['valor']) && "" != $_POST['valor'] &&
    isset($_POST['nombre_oficina_registro_inmueble_detalle']) && "" != $_POST['nombre_oficina_registro_inmueble_detalle']
  ) {
    $ano = $_POST['ano'];
    $valor = $_POST['valor'];
    $nombreOficina = $_POST['nombre_oficina_registro_inmueble_detalle'];
    $tamano_archivo = 15728640;
    $formato_archivo = array('pdf');
    $carpeta_archivo = "filesnr/oficinaregistroinmueble/" . $anoActual . "/";
    $ruta_archivo =  date("YmdGisu") . rtrim(strtr(base64_encode(date("YmdGisu")), '+/', '-_'), '=');

    if ("" != $_FILES['file']['tmp_name']) {
      $archivo = $_FILES['file']['tmp_name'];
      $nombre = strtolower($_FILES['file']['name']);
      $nom = pathinfo($nombre);
      $extension = $nom['extension'];
      $array_archivo = explode('.', $nombre);
      $extension2 = end($array_archivo);

      if ($tamano_archivo >= intval($_FILES['file']['size'])) {
        if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
          $files = $ruta_archivo . '.' . $extension;
          $hash = md5($files);
          $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo . $hash . '.' . $extension);
          $nombreUc = ucwords($nombre);
          $insertDocumento = sprintf("INSERT INTO oficina_registro_inmueble_detalle 
              (id_oficina_registro_inmueble_fk_oficina_registro_inmueble, 
              nombre_oficina_registro_inmueble_detalle,
              ano,
              valor,
              ano_creacion_documento,
              url_documento,
              hash_documento,
              fecha_creado)
              VALUES 
              ('$id', '$nombreOficina', '$ano', '$valor', '$anoActual', '$hash.$extension', '$hash', '$fechaActual')");
          $Result = mysql_query($insertDocumento, $conexion) or die(mysql_error());
          // $idInsert = mysql_insert_id($conexion);
          // auditoria($idControlDisciplinario, 'cd_anexos', $idInsert, $insertDocumento, $GlobalIdFuncionario, $fechaActual, $conexion);
          echo $insertado;
        } else {
          echo  $doc_no_tipo;
        }
      }
    } else {
      echo '<script type="text/javascript">swal(" ERROR !", " El archivo Supera los 15 Megas Permitidos. !", "error");</script>';
    }
    echo '<meta http-equiv="refresh" content="0;URL=./orip_hv_inmueble_detalle&' . $id . '.jsp" />';
  }

  // BORRAR ANEXOS 
  if (
    isset($_POST["borrar_pdf_inmueble"]) && $_POST["borrar_pdf_inmueble"] != "" &&
    isset($_POST["id_oficina_registro_inmueble_detalle"]) && $_POST["id_oficina_registro_inmueble_detalle"] != ""
  ) {
    $idDetalle = $_POST["id_oficina_registro_inmueble_detalle"];
    $updateQuery = "UPDATE oficina_registro_inmueble_detalle 
    SET estado_oficina_registro_inmueble_detalle = 0
    WHERE id_oficina_registro_inmueble_detalle = $idDetalle";
    if ($mysqli->query($updateQuery) === TRUE) {
      // auditoria($idControlDisciplinario, 'Activo Expediente', $idControlDisciplinario, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
    } else {
      echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
    }
    echo '<meta http-equiv="refresh" content="0;URL=./orip_hv_inmueble_detalle&' . $id . '.jsp" />';
  }

  // INSERT ESTADO INMUEBLE
  if (
    isset($_POST["guardar_estado_inmueble"]) && $_POST["guardar_estado_inmueble"] != "" &&
    isset($_POST["nombre_elemento"]) && $_POST["nombre_elemento"] != ""
  ) {
    $insertSQLEntidad = sprintf(
      "INSERT INTO oficina_registro_inmueble_detalle (
      id_oficina_registro_inmueble_fk_oficina_registro_inmueble,
      nombre_oficina_registro_inmueble_detalle, 
      nombre_elemento,
      ubicacion,
      material,

      estado,
      tipo,
      medida,
      fecha_creado
      )VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s)",
      GetSQLValueString($id, "int"),
      GetSQLValueString('ESTADO_INMUEBLE', "text"),
      GetSQLValueString($_POST["nombre_elemento"], "text"),
      GetSQLValueString($_POST["ubicacion"], "text"),
      GetSQLValueString($_POST["material"], "text"),

      GetSQLValueString($_POST["estado"], "text"),
      GetSQLValueString($_POST["tipo"], "text"),
      GetSQLValueString($_POST["medida"], "text"),
      GetSQLValueString($fechaActual, "date")
    );
    $Result = mysql_query($insertSQLEntidad, $conexion) or die(mysql_error());
  }
?>

  <div class="box box-info">
    <div class="box-header with-border" style="text-align: center;">
      <span><b>Detalle Hoja Vida Bien Inmueble</b></span>
    </div>
    <?php
    // CONSULTA DEL INMUEBLE
    $query = "SELECT * FROM oficina_registro_inmueble WHERE id_oficina_registro_inmueble = $id";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    ?>
    <div class="box-body">
      <div class="row">

        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <span><b>Información Bien Inmueble</b></span>
            </div>
            <div class="box-body">
              <table class="table no-margin">
                <tr>
                  <th>Oficina Registro</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="id_oficina_registro_fk_oficina_registro">
                        <div class="input-group input-group-sm">
                          <select class="form-control" name="id_oficina_registro_fk_oficina_registro">
                            <option value="<?php echo $row['id_oficina_registro_fk_oficina_registro']; ?>" selected><?php echo quees('oficina_registro',$row['id_oficina_registro_fk_oficina_registro']); ?></option>
                            <option value=""></option>
                            <?php
                              $query3 = "SELECT * FROM oficina_registro WHERE estado_oficina_registro = 1 ORDER BY nombre_oficina_registro ASC";
                              $result3 = $mysqli->query($query3);
                              while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $row3['id_oficina_registro']; ?>"><?php echo quees('oficina_registro', $row3['id_oficina_registro']); ?></option>
                              <?php };
                            ?>
                          </select>
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="id_oficina_registro_fk_oficina_registro" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['id_oficina_registro_fk_oficina_registro']) ? quees('oficina_registro',$row['id_oficina_registro_fk_oficina_registro']) : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Direccion</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="direccion">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="direccion" value="<?php echo $row['direccion']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="direccion" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['direccion']) ? $row['direccion'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Barrio</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="barrio">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="barrio" value="<?php echo $row['barrio']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="barrio" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['barrio']) ? $row['barrio'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Fecha Adquisición</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="fecha_adquisicion">
                        <div class="input-group input-group-sm">
                          <input type="date" class="form-control" name="fecha_adquisicion" value="<?php echo $row['fecha_adquisicion']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="fecha_adquisicion" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['fecha_adquisicion']) ? $row['fecha_adquisicion'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero Escritura</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_escritura">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="num_escritura" value="<?php echo $row['num_escritura']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_escritura" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_escritura']) ? $row['num_escritura'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Nombre Notaria</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="nombre_notaria">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="nombre_notaria" value="<?php echo $row['nombre_notaria']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="nombre_notaria" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['nombre_notaria']) ? $row['nombre_notaria'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Cedula Catastral</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_cedula_catastral">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="num_cedula_catastral" value="<?php echo $row['num_cedula_catastral']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_cedula_catastral" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_cedula_catastral']) ? $row['num_cedula_catastral'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero Matricula Inmobiliaria</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_matricula_inmobiliaria">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="num_matricula_inmobiliaria" value="<?php echo $row['num_matricula_inmobiliaria']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_matricula_inmobiliaria" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_matricula_inmobiliaria']) ? $row['num_matricula_inmobiliaria'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Porcentaje (%) de Propiedad</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="porcentaje_propiedad">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="porcentaje_propiedad" value="<?php echo $row['porcentaje_propiedad']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="porcentaje_propiedad" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['porcentaje_propiedad']) ? $row['porcentaje_propiedad'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Geolocalización - Longitud</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="geo_longitud">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="geo_longitud" value="<?php echo $row['geo_longitud']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="geo_longitud" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['geo_longitud']) ? $row['geo_longitud'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Geolocalización - Latitud</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="geo_latitud">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="geo_latitud" value="<?php echo $row['geo_latitud']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="geo_latitud" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['geo_latitud']) ? $row['geo_latitud'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Tipo de Uso</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="tipo_uso_inmueble">
                        <div class="input-group input-group-sm">
                          <select class="form-control" name="tipo_uso_inmueble">
                            <option value="<?php echo $row['tipo_uso_inmueble']; ?>" selected><?php echo $row['tipo_uso_inmueble']; ?></option>
                            <option value=""></option>
                            <option value="Propio">Propio</option>
                            <option value="Arriendo">Arriendo</option>
                            <option value="Comodato">Comodato</option>
                          </select>
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="tipo_uso_inmueble" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                  </td>
                  </form>
                <?php } else { ?>
                  <?php echo isset($row['tipo_uso_inmueble']) ? $row['tipo_uso_inmueble'] : ''; ?>
                <?php } ?>
                </tr>
                <tr>
                  <th>Inmueble Patrimonio Declarado</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="inmueble_declarado_patrimonio">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="inmueble_declarado_patrimonio" value="<?php echo $row['inmueble_declarado_patrimonio']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="inmueble_declarado_patrimonio" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['inmueble_declarado_patrimonio']) ? $row['inmueble_declarado_patrimonio'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero acto administrativo</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_acto_administrativo">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="num_acto_administrativo" value="<?php echo $row['num_acto_administrativo']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_acto_administrativo" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_acto_administrativo']) ? $row['num_acto_administrativo'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Area terreno</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="area_terreno">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="area_terreno" value="<?php echo $row['area_terreno']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="area_terreno" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['area_terreno']) ? $row['area_terreno'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Area construida</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="area_construida">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="area_construida" value="<?php echo $row['area_construida']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="area_construida" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['area_construida']) ? $row['area_construida'] : ''; ?> m2
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero Pisos</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_pisos">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_pisos" value="<?php echo $row['num_pisos']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_pisos" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_pisos']) ? $row['num_pisos'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Area patio</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="area_patio">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="area_patio" value="<?php echo $row['area_patio']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="area_patio" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['area_patio']) ? $row['area_patio'] : ''; ?> m2
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Area zona verdes</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="area_zonas_verdes">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="area_zonas_verdes" value="<?php echo $row['area_zonas_verdes']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="area_zonas_verdes" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['area_zonas_verdes']) ? $row['area_zonas_verdes'] : ''; ?> m2
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero asensores</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_asensores">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_asensores" value="<?php echo $row['num_asensores']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_asensores" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_asensores']) ? $row['num_asensores'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Carga Electrica (KVA)</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="carga_electrica_kva">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="carga_electrica_kva" value="<?php echo $row['carga_electrica_kva']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="carga_electrica_kva" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['carga_electrica_kva']) ? $row['carga_electrica_kva'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero contadores electricos</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_contadores_electricos">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_contadores_electricos" value="<?php echo $row['num_contadores_electricos']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_contadores_electricos" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_contadores_electricos']) ? $row['num_contadores_electricos'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero puntos red</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_puntos_red">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_puntos_red" value="<?php echo $row['num_puntos_red']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_puntos_red" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_puntos_red']) ? $row['num_puntos_red'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero lamparas</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_lamparas">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_lamparas" value="<?php echo $row['num_lamparas']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_lamparas" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_lamparas']) ? $row['num_lamparas'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero baños</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_banos">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_banos" value="<?php echo $row['num_banos']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_banos" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_banos']) ? $row['num_banos'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero baños (Discapasitados)</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_bano_discapacitados">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_bano_discapacitados" value="<?php echo $row['num_bano_discapacitados']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_bano_discapacitados" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_bano_discapacitados']) ? $row['num_bano_discapacitados'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero und Sanitarias</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_und_sanitarias">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_und_sanitarias" value="<?php echo $row['num_und_sanitarias']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_und_sanitarias" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_und_sanitarias']) ? $row['num_und_sanitarias'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero extintores</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_extintores">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_extintores" value="<?php echo $row['num_extintores']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_extintores" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_extintores']) ? $row['num_extintores'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero camaras vigilancia</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_camaras_vigilancia">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_camaras_vigilancia" value="<?php echo $row['num_camaras_vigilancia']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_camaras_vigilancia" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_camaras_vigilancia']) ? $row['num_camaras_vigilancia'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero vigilantes</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_vigilantes">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_vigilantes" value="<?php echo $row['num_vigilantes']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_vigilantes" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_vigilantes']) ? $row['num_vigilantes'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero escrituras registradas</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_escrituras_registradas">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_escrituras_registradas" value="<?php echo $row['num_escrituras_registradas']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_escrituras_registradas" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_escrituras_registradas']) ? $row['num_escrituras_registradas'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Numero libros</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="num_libros">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" name="num_libros" value="<?php echo $row['num_libros']; ?>">
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="num_libros" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['num_libros']) ? $row['num_libros'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Existe modulo atencion (Discapasitados)</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="modulo_atencion_discapacitados">
                        <div class="input-group input-group-sm">
                          <select class="form-control" name="modulo_atencion_discapacitados">
                            <option value="<?php echo $row['modulo_atencion_discapacitados']; ?>" selected><?php echo $row['modulo_atencion_discapacitados']; ?></option>
                            <option value=""></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                          </select>
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="modulo_atencion_discapacitados" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['modulo_atencion_discapacitados']) ? $row['modulo_atencion_discapacitados'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Existe enfermeria</th>
                  <td>
                    <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                      <form action="" method="post" name="existe_enfermeria">
                        <div class="input-group input-group-sm">
                          <select class="form-control" name="existe_enfermeria">
                            <option value="<?php echo $row['existe_enfermeria']; ?>" selected><?php echo $row['existe_enfermeria']; ?></option>
                            <option value=""></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                          </select>
                          <span class="input-group-btn">
                            <input type="hidden" name="campohvinmueble" value="existe_enfermeria" oncopy="return false;">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </span>
                        </div>
                      </form>
                    <?php } else { ?>
                      <?php echo isset($row['existe_enfermeria']) ? $row['existe_enfermeria'] : ''; ?>
                    <?php } ?>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div> <!-- col-md-6 -->

        <div class="col-md-6">

          <!-- PREDIAL -->
          <div class="box box-default">
            <div class="box-header with-border">
              <span><b>Impuesto predial unificado</b></span>
              <div class="box-tools pull-right">
                <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                  <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalPredial" title="Nuevo Predial"><span class="fa fa-fw fa-plus"></span></button>
                <?php } ?>
              </div>
            </div>
            <div class="box-body">
              <table class="table no-margin">

                <head>
                  <tr>
                    <th>Año</th>
                    <th>Valor</th>
                    <th>Pdf</th>
                    <th>Accion</th>
                  </tr>
                </head>
                <body>
                  <?php
                  $query2 = "SELECT * FROM oficina_registro_inmueble_detalle WHERE 
                  id_oficina_registro_inmueble_fk_oficina_registro_inmueble=$id 
                  AND nombre_oficina_registro_inmueble_detalle='PREDIAL'
                  AND estado_oficina_registro_inmueble_detalle=1";
                  $result2 = $mysqli->query($query2);
                  while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                    if ($row2) {
                  ?>
                      <tr>
                        <td><?php echo $row2['ano']; ?></td>
                        <td><?php echo $row2['valor']; ?></td>
                        <td>
                          <a href="filesnr/oficinaregistroinmueble/<?php echo $row2['ano_creacion_documento'] . '/' . $row2['url_documento']; ?>" target="_blank"><img src="images\pdf.png" alt="" style="width:15px;"></a>
                        </td>
                        <td>
                          <form action="" method="post" name="borrarpdf">
                            <input type="hidden" name="id_oficina_registro_inmueble_detalle" value="<?php echo $row2['id_oficina_registro_inmueble_detalle']; ?>">
                            <input type="hidden" name="borrar_pdf_inmueble" value="borrar">
                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                  <?php }
                  } ?>
                </body>
              </table>
            </div>
          </div>

          <!-- AVALUO -->
          <div class="box box-default">
            <div class="box-header with-border">
              <span><b>Avalúo inmobiliario</b></span>
              <div class="box-tools pull-right">
                <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                  <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalAvaluo" title="Nuevo Avaluo"><span class="fa fa-fw fa-plus"></span></button>
                <?php } ?>
              </div>
            </div>
            <div class="box-body">
              <table class="table no-margin">

                <head>
                  <tr>
                    <th>Año</th>
                    <th>Valor</th>
                    <th>Pdf</th>
                    <th>Accion</th>
                  </tr>
                </head>

                <body>
                  <?php
                  $query2 = "SELECT * FROM oficina_registro_inmueble_detalle WHERE 
                id_oficina_registro_inmueble_fk_oficina_registro_inmueble=$id 
                AND nombre_oficina_registro_inmueble_detalle='AVALUO'
                AND estado_oficina_registro_inmueble_detalle=1";
                  $result2 = $mysqli->query($query2);
                  while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                    if ($row2) {
                  ?>
                      <tr>
                        <td><?php echo $row2['ano']; ?></td>
                        <td><?php echo $row2['valor']; ?></td>
                        <td>
                          <a href="filesnr/oficinaregistroinmueble/<?php echo $row2['ano_creacion_documento'] . '/' . $row2['url_documento']; ?>" target="_blank"><img src="images\pdf.png" alt="" style="width:15px;"></a>
                        </td>
                        <td>
                          <form action="" method="post" name="borrarpdf">
                            <input type="hidden" name="id_oficina_registro_inmueble_detalle" value="<?php echo $row2['id_oficina_registro_inmueble_detalle']; ?>">
                            <input type="hidden" name="borrar_pdf_inmueble" value="borrar">
                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                  <?php }
                  } ?>
                </body>
              </table>
            </div>
          </div>

          <!-- ESTADO DEL INMUEBLE -->
          <div class="box box-default">
            <div class="box-header with-border">
              <span><b>Estado del Inmueble</b></span>
              <div class="box-tools pull-right">
                <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
                  <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalEstadoInmueble" title="Nuevo Estado Inmueble"><span class="fa fa-fw fa-plus"></span></button>
                <?php } ?>
              </div>
            </div>
            <div class="box-body">
              <table class="table no-margin">

                <head>
                  <tr>
                    <th>Elemento</th>
                    <th>Ubicacion</th>
                    <th>Material</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Medidas</th>
                    <th>Accion</th>
                  </tr>
                </head>

                <body>
                  <?php
                  $query2 = "SELECT * FROM oficina_registro_inmueble_detalle WHERE 
                id_oficina_registro_inmueble_fk_oficina_registro_inmueble=$id 
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
                        <td>
                          <form action="" method="post" name="borrarpdf">
                            <input type="hidden" name="id_oficina_registro_inmueble_detalle" value="<?php echo $row2['id_oficina_registro_inmueble_detalle']; ?>">
                            <input type="hidden" name="borrar_pdf_inmueble" value="borrar">
                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                  <?php }
                  } ?>
                </body>
              </table>
            </div>
          </div>

        </div> <!-- col-md-6 -->

      </div> <!-- row -->

    </div> <!-- box-body -->
  </div> <!-- box box-info -->
  </div>


  <!-- MODAL NUEVO PREDIAL -->
  <div class="modal fade" id="modalPredial" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <b>Nuevo Predial</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="" method="post" name="formNuevoPredial" enctype="multipart/form-data">
            <input type="hidden" name="nombre_oficina_registro_inmueble_detalle" value="PREDIAL">

            <table class="table">
              <tr>
                <th>Año</th>
                <td><input type="number" class="form-control" name="ano"></td>
              </tr>
              <tr>
                <th>Valor</th>
                <td><input type="text" class="form-control" name="valor"></td>
              </tr>
              <tr>
                <th>Anexo</th>
                <td>
                  <input type="file" name="file" required>
                  <span style="color:#B40404;font-size:13px;">Inferior a 15 mb solo Pdf</span>
                  <a href="https://smallpdf.com/es/comprimir-pdf" style="color:#B40404;" target="_blank">Comprimir</a>
                </td>
              </tr>
            </table>
            <div class="modal-footer"><button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()">
                <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success btn-xs">
                <input type="hidden" name="guardar_nuevo_pdf" value="guardar_nuevo_pdf">
                <span class="glyphicon glyphicon-ok"></span> Guardar </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL NUEVO AVALUO -->
  <div class="modal fade" id="modalAvaluo" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <b>Nuevo Predial</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="" method="post" name="formNuevoPredial" enctype="multipart/form-data">
            <input type="hidden" name="nombre_oficina_registro_inmueble_detalle" value="AVALUO">
            <table class="table">
              <tr>
                <th>Año</th>
                <td><input type="number" class="form-control" name="ano"></td>
              </tr>
              <tr>
                <th>Valor</th>
                <td><input type="text" class="form-control" name="valor"></td>
              </tr>
              <tr>
                <th>Anexo</th>
                <td>
                  <input type="file" name="file" required>
                  <span style="color:#B40404;font-size:13px;">Inferior a 15 mb solo Pdf</span>
                  <a href="https://smallpdf.com/es/comprimir-pdf" style="color:#B40404;" target="_blank">Comprimir</a>
                </td>
              </tr>
            </table>
            <div class="modal-footer"><button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()">
                <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success btn-xs">
                <input type="hidden" name="guardar_nuevo_pdf" value="guardar_nuevo_pdf">
                <span class="glyphicon glyphicon-ok"></span> Guardar </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL ESTADO INMUEBLE -->
  <div class="modal fade" id="modalEstadoInmueble" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <b>Nuevo</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="" method="post" name="formNuevoEstadoInmuble">
            <table class="table">
              <tr>
                <th>Elemento</th>
                <td><input type="text" class="form-control" name="nombre_elemento"></td>
              </tr>
              <tr>
                <th>Ubicacion</th>
                <td><input type="text" class="form-control" name="ubicacion"></td>
              </tr>
              <tr>
                <th>Material</th>
                <td><input type="text" class="form-control" name="material"></td>
              </tr>
              <tr>
                <th>Estado</th>
                <td>
                  <select name="estado" class="form-control">
                    <option value=""></option>
                    <option value="Bueno">Bueno</option>
                    <option value="Regular">Regular</option>
                    <option value="Malo">Malo</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Tipo</th>
                <td>
                  <select name="tipo" class="form-control">
                    <option value=""></option>
                    <option value="Aereo">Aereo</option>
                    <option value="Subterraneo">Subterraneo</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Medidas</th>
                <td><input type="text" class="form-control" name="medida" placeholder="alto * ancho"></td>
              </tr>
            </table>
            <div class="modal-footer"><button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()">
                <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success btn-xs">
                <input type="hidden" name="guardar_estado_inmueble" value="guardar_estado_inmueble">
                <span class="glyphicon glyphicon-ok"></span> Guardar </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
}

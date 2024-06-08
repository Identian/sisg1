<?php
$idFuncionario = $_SESSION['snr'];
$nump136 = privilegios(136, $idFuncionario); // Administrador 

if (1 == $_SESSION['rol'] || 0 < $nump136) {

  // Colocar id funcionario y podemos obtener los contratos que ha realizado.
  $id = isset($_GET['i']) ? $_GET['i'] : '';

  // FECHA ACTUAL
  date_default_timezone_set("America/Bogota");
  $fechaActual = date("Y-m-d H:i:s");
  $fechaAno = date("Y");

  // GUARDAR NUEVA MODIFICACION
  if (isset($_POST["guardarNuevaModificacion"]) && '' != $_POST["guardarNuevaModificacion"]) {
    $insert = sprintf(
      "INSERT INTO nc_modifica_contrato (
      id_nc_contrato,
      nombre_nc_modifica_contrato,
      texto_nc_rubro,
      fecha_modifica,
      valor_modifica,
      nota_modifica,

      num_cdp,
      cdp_fecha_expedicion,
      num_crp,
      crp_fecha_expedicion,
      auditoria_funcionario,
      fecha) 
      VALUES 
      (%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s)",
      GetSQLValueString($_POST["id_nc_contrato"], "int"),
      GetSQLValueString($_POST["nombre_nc_modifica_contrato"], "text"),
      GetSQLValueString($_POST["texto_nc_rubro"], "text"),
      GetSQLValueString($_POST["fecha_modifica"], "date"),
      GetSQLValueString($_POST["valor_modifica"], "text"),
      GetSQLValueString($_POST["nota_modifica"], "text"),

      GetSQLValueString($_POST["num_cdp"], "int"),
      GetSQLValueString($_POST["cdp_fecha_expedicion"], "date"),
      GetSQLValueString($_POST["num_crp"], "int"),
      GetSQLValueString($_POST["crp_fecha_expedicion"], "date"),
      GetSQLValueString($idFuncionario, "int"),
      GetSQLValueString($fechaActual, "date")
    );
    mysql_query($insert, $conexion) or die(mysql_error());
    $idInsert = mysql_insert_id($conexion);
    auditoriaGeneral('nc_auditoria', $_POST["id_nc_contrato"], 'nc_modifica_contrato', $idInsert, 'Insert ' . $insert, $idFuncionario, $fechaActual, $conexion);
    sweetAlert('OK', 'Registrado Correctamente', 'success');
    echo '<meta http-equiv="refresh" content="1;URL=./contratos.jsp" />';
  }

  // BORRAR MODIFICACION
  if (isset($_POST['borrarmodificacion']) && "" != $_POST['borrarmodificacion']) {
    $idModifica = $_POST['id_nc_modifica_contrato'];
    $queryUpdate = "UPDATE nc_modifica_contrato SET estado_nc_modifica_contrato=0 WHERE id_nc_modifica_contrato=" . $idModifica . " limit 1";
    $resultUpdate = $mysqli->query($queryUpdate);
    auditoriaGeneral('nc_auditoria', $_POST['id_nc_contrato'], 'nc_modifica_contrato', $idModifica, 'Update ' . $queryUpdate, $idFuncionario, $fechaActual, $conexion);
    sweetAlert('OK', 'Borrado Correctamente', 'success');
    echo '<meta http-equiv="refresh" content="1;URL=./contratos.jsp" />';
  }

  // NUEVO CONSECUTIVO
  if (
    isset($_POST["guardarConsecutivo"]) && ($_POST["guardarConsecutivo"] != "") &&
    isset($_POST["cod_datos_contrato"]) && ($_POST["cod_datos_contrato"] != "") &&
    isset($_POST["ano_datos_contrato"]) && ($_POST["ano_datos_contrato"] != "")
  ) {
    $codContrato = $_POST["cod_datos_contrato"];
    $AnoContrato = $_POST["ano_datos_contrato"];
    $query4 = sprintf("SELECT count(id_nc_contratos) AS contrato FROM nc_contratos where cod_datos_contrato='$codContrato' AND ano_datos_contrato=$AnoContrato AND estado_nc_contratos=1");
    $result4 = $mysqli->query($query4);
    $row4 = $result4->fetch_array(MYSQLI_ASSOC);
    $row4['contrato'];
    if (0 < $row4['contrato']) {
      echo '<script type="text/javascript">swal(" ADVERTENCIA !", " Numero de contrato ' . $codContrato . '-' . $AnoContrato . ' Ya existente. !", "warning");</script>';
    } else {
      $insertSQL = sprintf(
        "INSERT INTO nc_contratos (cod_datos_contrato, ano_datos_contrato, fecha_creado) 
      VALUES (%s,%s,%s)",
        GetSQLValueString($_POST["cod_datos_contrato"], "text"),
        GetSQLValueString($_POST["ano_datos_contrato"], "int"),
        GetSQLValueString($fechaActual, "date")
      );
      $Result = mysql_query($insertSQL, $conexion);
      $idInsert = mysql_insert_id($conexion);
      auditoriaGeneral('nc_auditoria', NULL, 'nc_contratos', $idInsert, 'Insert ' . $insertSQL, $idFuncionario, $fechaActual, $conexion);
      sweetAlert('OK', 'Registrado Correctamente', 'success');
      echo '<meta http-equiv="refresh" content="1;URL=./contratos.jsp" />';
    }
  }

  // CEDER CONTRATO
  if (
    isset($_POST["btnGuardarCederContrato"]) && ($_POST["btnGuardarCederContrato"] != "") &&
    isset($_POST["id_nc_contrato"]) && ($_POST["id_nc_contrato"] != "") &&
    isset($_POST["fecha_modifica"]) && ($_POST["fecha_modifica"] != "") &&
    isset($_POST["cedula_funcionario"]) && ($_POST["cedula_funcionario"] != "")
  ) {
    $cedula = $_POST["cedula_funcionario"];
    $buscarContratista = buscarcampo('funcionario', 'nombre_funcionario', 'cedula_funcionario=' . $cedula);
    $buscarIdContratista = buscarcampo('funcionario', 'id_funcionario', 'cedula_funcionario=' . $cedula);
    if ($buscarContratista != 'No esta parametrizado') {
      // Realizar count para identificar que no existe el contratista ya con un contrato en ese año.
      $query7 = "SELECT count(id_funcionario) AS contFun FROM nc_contratos WHERE estado_nc_contratos=1 AND id_funcionario=$buscarIdContratista AND ano_datos_contrato=$fechaAno";
      $result7 = $mysqli->query($query7);
      $row7 = $result7->fetch_array(MYSQLI_ASSOC);
      $contFun = $row7['contFun'];

      // if ($contFun == 0) {
      $idNcContratoPost = $_POST["id_nc_contrato"];
      $query8 = "SELECT * FROM nc_contratos WHERE estado_nc_contratos=1 AND id_nc_contratos=$idNcContratoPost LIMIT 1";
      $result8 = $mysqli->query($query8);
      $row8 = $result8->fetch_array(MYSQLI_ASSOC);

      $datos = array(
        "nombre_nc_contratos" => $row8['nombre_nc_contratos'],
        "cod_datos_contrato" => $row8['cod_datos_contrato'],
        "ano_datos_contrato" => $row8['ano_datos_contrato'],
        "texto_funcionario" => $buscarContratista,
        "id_funcionario" => $buscarIdContratista,
        "id_empresa" => 0,
        "cargo_supervisor" => $row8['cargo_supervisor'],
        "id_funcionario_supervisor" => $row8['id_funcionario_supervisor'],
        "id_opcion_modalidad_seleccion" => $row8['id_opcion_modalidad_seleccion'],
        "id_opcion_clase_convenio" => $row8['id_opcion_clase_convenio'],
        "id_opcion_categoria_servicio" => $row8['id_opcion_categoria_servicio'],
        "id_opcion_naturaleza" => $row8['id_opcion_naturaleza'],
        "id_opcion_afectacion_recurso" => $row8['id_opcion_afectacion_recurso'],
        "texto_responsable_abogado" => $row8['texto_responsable_abogado'],
        "id_reponsable_abogado" => $row8['id_reponsable_abogado'],
        "id_nc_salario" => $row8['id_nc_salario'],
        "objeto" => $row8['objeto'],
        "obligaciones_especificas" => $row8['obligaciones_especificas'],
        "texto_municipio" => $row8['texto_municipio'],
        "id_municipio" => $row8['id_municipio'],
        "fecha_acta_inicio" => '',
        "fecha_inicio" => $fechaActual,
        "fecha_terminacion" => '',
        "fecha_arl" => '',
        "fecha_poliza" => '',
        "valor_inicial" => '',
        "rut_actividad" => $row8['rut_actividad'],
        "texto_nc_rubro" => $row8['texto_nc_rubro'],
        "id_opcion_regimen" => $row8['id_opcion_regimen'],
        "profesion" => $row8['profesion'],
        "fecha_creado" => $row8['fecha_creado'],
        "texto_opcion_estado_contratos" => $row8['texto_opcion_estado_contratos'],
        "id_opcion_estado_contratos" => $row8['id_opcion_estado_contratos'],
        "observacion" => $row8['observacion'],
        "url_contrato" => $row8['url_contrato'],
        "cedido" => "SI",
      );
      if (insertarDatos($mysqli, "nc_contratos", $datos)) {
        $uIdInsert = $mysqli->insert_id;
        $datos_campos = implode(", ", array_keys($datos));
        $datos_valores = "'" . implode("', '", $datos) . "'";
        auditoriaGeneral('nc_auditoria', $idNcContratoPost, 'nc_contratos', $uIdInsert, 'Insert ' . $datos_campos . $datos_valores, $idFuncionario, $fechaActual, $conexion);

        $datos1 = array(
          "fk_nc_contratos" => $_POST["id_nc_contrato"],
          "id_funcionario" => $_POST['id_funcionario'],
          "fk_id_funcionario_sucede" => $buscarIdContratista,
          "fecha_modificacion" => $_POST['fecha_modifica'],
          "fecha" => $fechaActual,
          "fk_id_funcionario_auditoria" => $idFuncionario,
        );
        if (insertarDatos($mysqli, "nc_ceder", $datos1)) {
          $uIdInsert1 = $mysqli->insert_id;
          $datos_campos1 = implode(", ", array_keys($datos1));
          $datos_valores1 = "'" . implode("', '", $datos1) . "'";
          auditoriaGeneral('nc_auditoria', $idNcContratoPost, 'nc_ceder', $uIdInsert1, 'Insert ' . $datos_campos1 . $datos_valores1, $idFuncionario, $fechaActual, $conexion);

          $idNcContrato = $_POST["id_nc_contrato"];
          $datos2 = array(
            "fecha_terminacion" => $_POST['fecha_modifica'],
            "estado_nc_contratos" => 0,
          );
          if (actualizarDatos($mysqli, "nc_contratos", $datos2, "id_nc_contratos=$idNcContrato LIMIT 1")) {
            $datos_campos2 = implode(", ", array_keys($datos2));
            $datos_valores2 = "'" . implode("', '", $datos2) . "'";
            auditoriaGeneral('nc_auditoria', NULL, 'nc_contratos', $idNcContrato, 'Update ' . $datos_campos2 . $datos_valores2, $idFuncionario, $fechaActual, $conexion);
            sweetAlert('OK', 'Cedido correctamente. Tenga en cuenta que la información del contrato podría experimentar cambios al cambiar de contratista. Le solicitamos revisar con atención, ya que esto forma parte de sus responsabilidades.', 'success');
          }
        } else {
          echo "Error en la inserción del comisionado";
        }
      }
      echo '<meta http-equiv="refresh" content="1;URL=./contratos.jsp" />';
      // } else {
      //   echo sweetAlert('warning', 'El contratista ' . $buscarContratista . ' cuenta actualmente con un contrato vigente asignado.', 'warning');
      // }
    } else {
      echo sweetAlert('warning', 'No se ha encontrado información para el contratista especificado. Por favor, verifique los detalles e intente nuevamente.', 'warning');
    }
  }
?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h6 class="box-title">Contratos</h6>
      &nbsp;
      &nbsp;
      <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalguardarConsecutivo"> Nuevo </button>
      <div class="box-tools pull-right">
        <a href="contratos_reporte.jsp" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-fw fa-table"></i> Historico</a>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>

      <form class="navbar-form" name="formbuscarcontratistas" method="POST">

        <div class="input-group">
          <div class="input-group-btn">Buscar
            <select class="form-control" name="campo" required>
              <option value="" selected> - - Buscar por: - - </option>
              <option value="funcionario.nombre_funcionario">Nombre Contratista</option>
              <option value="funcionario.cedula_funcionario">Cedula Contratista</option>
              <option value="ano_datos_contrato">Año Contrato</option>
            </select>
          </div>
          <div class="input-group-btn">
            <input type="text" name="buscar" placeholder="Buscar" class="form-control" required>
          </div>

          <div class="input-group-btn">
            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
          </div>
        </div>

      </form>
    </div>
    <div class="box-body">
      <table class="table table-bordered" id="contratos">
        <thead>
          <tr align="center" valign="middle">
            <th>Id</th>
            <th>N Contrato</th>
            <th>Cedula/Nit</th>
            <th>Contratista</th>
            <th>Fecha Acta</th>
            <th>Fecha Suscripcion</th>
            <th>Fecha Terminacion</th>
            <th>Perfil</th>
            <th>Salario</th>
            <th>Valor Inicial</th>
            <th>Supervisor</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($id) && '' != $id) {
            $query5 = "SELECT * FROM nc_contratos WHERE estado_nc_contratos=1 AND id_funcionario=" . $id . "";
          } elseif (1 == $_SESSION['rol'] || 0 < $nump136) {
            if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
              $searchQuery = " AND " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
              $query5 = "SELECT * FROM nc_contratos, funcionario WHERE nc_contratos.id_funcionario=funcionario.id_funcionario " . $searchQuery . "";
            } else {
              $query5 = "SELECT * FROM nc_contratos WHERE estado_nc_contratos=1 AND ano_datos_contrato = $fechaAno";
            }
          } else {
            $query5 = "SELECT * FROM nc_contratos WHERE id_nc_contratos=0";
          }
          $result5 = $mysqli->query($query5);
          while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) {
            if ($row5['id_nc_contratos']) { ?>
              <tr>
                <td><?php echo isset($row5['id_nc_contratos']) ? $row5['id_nc_contratos'] : 'No esta parametrizado'; ?></td>
                <td><?php echo isset($row5['cod_datos_contrato']) && isset($row5['ano_datos_contrato'])  ? $row5['cod_datos_contrato'] . '-' . $row5['ano_datos_contrato'] : 'No esta parametrizado'; ?></td>
                <td>
                  <?php
                  if (isset($row5['id_funcionario']) && '' != buscarcampo('funcionario', 'cedula_funcionario', 'id_funcionario=' . $row5['id_funcionario'])) {
                    echo  buscarcampo('funcionario', 'cedula_funcionario', 'id_funcionario=' . $row5['id_funcionario']);
                  } else {
                    echo 'No esta parametrizado';
                  } ?>
                </td>
                <td><?php echo isset($row5['id_funcionario']) ? quees('funcionario', $row5['id_funcionario']) : 'No esta parametrizado'; ?></td>
                <td><?php echo isset($row5['fecha_acta_inicio']) ? $row5['fecha_acta_inicio'] : 'No esta parametrizado'; ?></td>
                <td><?php echo isset($row5['fecha_inicio']) ? $row5['fecha_inicio'] : 'No esta parametrizado'; ?></td>
                <td><?php echo isset($row5['fecha_terminacion']) ? $row5['fecha_terminacion'] : 'No esta parametrizado'; ?></td>
                <td>
                  <?php $idSalario = $row5['id_nc_salario'];
                  if (isset($idSalario)) {
                    $query6 = "SELECT nombre_nc_cargo FROM nc_cargo LEFT JOIN nc_salario ON nc_cargo.id_nc_cargo=nc_salario.id_nc_cargo WHERE id_nc_salario = $idSalario";
                    $result6 = $mysqli->query($query6);
                    $row6 = $result6->fetch_array(MYSQLI_ASSOC) ?>
                    <?php echo isset($row6['nombre_nc_cargo']) ? $row6['nombre_nc_cargo'] : 'No esta parametrizado'; ?>
                  <?php } ?>
                </td>
                <td><?php echo isset($row5['id_nc_salario']) ? quees('nc_salario', $row5['id_nc_salario']) : 'No esta parametrizado'; ?></td>
                <td><?php echo isset($row5['valor_inicial']) ? $row5['valor_inicial'] : 'No esta parametrizado'; ?></td>
                <td><?php echo isset($row5['id_funcionario_supervisor']) ? quees('funcionario', $row5['id_funcionario_supervisor']) : 'No esta parametrizado'; ?></td>
                <td style="width: 120px;">
                  <a style="cursor:pointer;" class="actualizarcontrato btn btn-warning btn-xs" data-toggle="modal" data-target="#modalactualizarcontrato" id="actualizar-<?php echo $row5['id_nc_contratos']; ?>">
                    <i class="fa fa-fw fa-pencil" title="Actualizar Información"></i>
                  </a>
                  <?php if (1 == $_SESSION['rol'] || $row5['estado_nc_contratos'] == 1) { ?>
                    <a style="cursor:pointer;" class="actualizarcontrato btn btn-info btn-xs" data-toggle="modal" data-target="#modalactualizarcontrato" id="modificar-<?php echo $row5['id_nc_contratos']; ?>">
                      <i class="fa fa-fw fa-gavel" title="Modificar Contrato"></i>
                    </a>
                    <a style="cursor:pointer;" class="actualizarcontrato btn btn-primary btn-xs" data-toggle="modal" data-target="#modalactualizarcontrato" id="ceder_contrato-<?php echo $row5['id_nc_contratos']; ?>">
                      <i class="fa fa-fw fa-exchange" title="Ceder Contrato"></i>
                    </a>
                    <a href="pdf/minuta_contratos&<?php echo $row5['id_nc_contratos']; ?>.pdf" class="actualizarcontrato btn btn-default btn-xs"><i class="fa fa-fw fa-file-pdf-o" title="Descargar Minuta"></i></a>
                  <?php } ?>
                </td>
              </tr>
          <?php }
          } ?>
        </tbody>
      </table>

      <script>
        $(document).ready(function() {
          $('#contratos').DataTable({
            dom: 'Bfrtip',
            buttons: [
              'excelHtml5'
            ],
            "lengthMenu": [
              [50, 100, 200, 300, 500],
              [50, 100, 200, 300, 500]
            ],
            "language": {
              "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "aaSorting": [
              [0, "desc"]
            ]
          });
        });
      </script>


    </div>
  </div>

  <!-- MODAL ACTUALIZAR Y MODIFICAR -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalactualizarcontrato" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <b>Contrato</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div id="divactualizarcontrato"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- NUEVO CONSECUTIVO -->
  <div class="modal fade" id="modalguardarConsecutivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <b>Consecutivo</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form name="guardarformhistoricocargoscontratos" method="post">
            <div class="row">
              <div class="col-md-6">
                <label><span style="color:#ff0000;">*</span>Número Contrato:</label><br>
                <input type="text" name="cod_datos_contrato" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label><span style="color:#ff0000;">*</span>Año Contrato:</label><br>
                <input type="number" name="ano_datos_contrato" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarConsecutivo" value="insertco"> Guardar </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php }

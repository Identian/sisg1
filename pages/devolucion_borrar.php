<?php
$nump54 = privilegios(54, $_SESSION['snr']);  // PRINCIPAL
$nump55 = privilegios(55, $_SESSION['snr']);  // SECCIONAL
$nump56 = privilegios(56, $_SESSION['snr']);  // ADM TESORERIA
$nump57 = privilegios(57, $_SESSION['snr']);  // ADM PRESUPUESTO
$nump58 = privilegios(58, $_SESSION['snr']);  // ADM CONTABILIDAD
$nump59 = privilegios(59, $_SESSION['snr']);  // USU PRESUPUESTO
$nump60 = privilegios(60, $_SESSION['snr']);  // USU CONTABILIDAD
$nump61 = privilegios(61, $_SESSION['snr']);  // USU TESORERIA
$idfunres = $_SESSION['snr'];

if (0 < $nump54) {
  $info = intval($_SESSION['id_oficina_registro']);
  $queryinfo = ' AND id_tipo_oficina_de=2 AND orip_a_cargo=' . $info . '';
} elseif (0 < $nump56 or 0 < $nump57 or 0 < $nump58 && 1 == $_SESSION['snr_tipo_oficina']) {
  $info = 0;
  $queryinfo = '';
} elseif (0 < $nump59 or 0 < $nump60 or 0 < $nump61 && 1 == $_SESSION['snr_tipo_oficina']) {
  $info = 0;
  $queryinfo = 'AND (id_fun_presupuesto=' . $idfunres . ' OR id_fun_contabilidad=' . $idfunres . ' OR id_fun_tesoreria=' . $idfunres . ')';
  echo 60;
} elseif (2 == $_SESSION['snr_tipo_oficina']) {
  $info = intval($_SESSION['id_oficina_registro']);
  $queryinfo = ' AND id_tipo_oficina_de=2 AND codigo_oficina_de=' . $info . '';
} else {
  if (1 == $_SESSION['rol']) {
    $info = $_GET['i'];
    if (0 == $info) {
      $queryinfo = '';
    } else {
      $queryinfo = 'AND id_tipo_oficina_de=2 AND codigo_oficina_de=' . $info . '';
    }
  } else {
    echo '<meta http-equiv="refresh" content="0;URL=orips.jsp" />';
  }
}

// CREACION DE RADICADO EN IRIS
$userpostgres     = "postgres";
$passwordpostgres   = "postgres";
$dbpostgres        = "SNR";
$portpostgres     = "5432";
$hostpostgres     = "192.168.10.22";

$conexionpostgres = pg_pconnect("host=" . $hostpostgres . " port=" . $portpostgres . " dbname=" . $dbpostgres . " user=" . $userpostgres . " password=" . $passwordpostgres . "") or die("No se ha podido conectar");

if (isset($_POST["resoluciondatos"])) {

  $asunto_correspondencia =  $_POST["asunto_correspondencia"];
  $descripcion_correspondencia = $_POST["descripcion_correspondencia"];
  $recibida = 'true';
  $interno = 'false';
  $idestado = '8';
  $fechairis = date("Y-m-d H:i:s");
  $fechaenvio = date("Y-m-d ") . '00:00:00';

  $id = 'ER';
  $anoiris = date("Y");
  $infoiris = 'SNR' . $anoiris . $id;
  $sql = "SELECT codigo FROM correspondencia where codigo like '%" . $infoiris . "%' order by idcorrespondencia desc limit 1";
  $rs = pg_query($sql);
  $num_resultados = pg_num_rows($rs);
  if (0 < $num_resultados) {
    for ($i = 0; $i < $num_resultados; $i++) {
      $row = pg_fetch_array($rs);
      $info2iris = $row['codigo'];
    }
    $info3iris = explode($anoiris . $id, $info2iris);
    $info4iris = intval($info3iris[1]);
    $info5iris = $info4iris + 1;
    $info6iris = trim(substr('000000' . $info5iris, -6));
    $radicado = 'SNR' . $anoiris . $id . $info6iris;
  }
  pg_free_result($rs);
 // echo $radicado;

  $consultab = sprintf("INSERT INTO correspondencia (
    idcorreoprioridad, 
    idtipodocumento, 
    codigo, 
    referencia, 
    asunto, 
    idestado, 
    idcorreovia, 
    recibida, 
    interna, 
    deint, 
    de, 
    paraint, 
    para,  
    folios, 
    anexos, 
    contenido, 
    fechaenvio, 
    fecharecepcion, 
    descripcion, 
    creado, 
    fcreado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
    GetSQLValueString('1', "text"), 
    GetSQLValueString('308', "text"), 
    GetSQLValueString($radicado, "text"), 
    GetSQLValueString('DEVOLUCION DAF', "text"), 
    GetSQLValueString($asunto_correspondencia, "text"), 
    GetSQLValueString($idestado, "text"), 
    GetSQLValueString('3', "text"), 
    GetSQLValueString($recibida, "text"), 
    GetSQLValueString($interno, "text"), 
    GetSQLValueString('5,1642 ', "text"), 
    GetSQLValueString('SISG OTI [USUARIO]', "text"), 
    GetSQLValueString('5,1980 ', "text"), 
    GetSQLValueString('ARCHIVO DEVOLUCIONES DE DINERO / ', "text"), 
    GetSQLValueString('1', "text"), 
    GetSQLValueString('1', "text"), 
    GetSQLValueString('1', "text"), 
    GetSQLValueString($fechaenvio, "text"), 
    GetSQLValueString($fechairis, "text"), 
    GetSQLValueString($descripcion_correspondencia, "text"),
    GetSQLValueString(1642, "text"),
    GetSQLValueString($fechairis, "text"));


  $resultadopg = pg_query($consultab);

  if (FALSE != $resultadopg) {

    $insertSQL = sprintf(

      "INSERT INTO correspondencia (
              nombre_correspondencia, 
              referencia, 
              id_tipo_correspondencia, 
              id_funcionario_de, 
              id_funcionario_para, 
              fecha_correspondencia, 
              asunto_correspondencia, 
              descripcion_correspondencia, 
              id_tipo_oficina_de, 
              codigo_oficina_de, 
              id_tipo_oficina_para, 
              codigo_oficina_para,  
              estado_correspondencia) VALUES (%s, %s, %s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s)",
      GetSQLValueString($radicado, "text"),
      GetSQLValueString("DEVOLUCION-DAF", "text"),
      GetSQLValueString(308, "text"),
      GetSQLValueString($_SESSION['snr'], "int"),
      GetSQLValueString(1980, "int"),
      GetSQLValueString($asunto_correspondencia, "text"),
      GetSQLValueString($descripcion_correspondencia, "text"),
      GetSQLValueString(2, "int"),
      GetSQLValueString($info, "int"),
      GetSQLValueString(1, "int"),
      GetSQLValueString(19, "int"),
      GetSQLValueString(1, "int")
    );
    $ResultInsertSQL = mysql_query($insertSQL, $conexion);
    echo $insertado;
  }
}


// INSERTAR ASIGNACION
if (isset($_POST['AsignarFunPresupuesto'])) {
  var_dump($_POST["id_fun_presupuesto"]);
  var_dump($_POST["id_correspondencia"]);
  $updatecc = sprintf(
    "UPDATE correspondencia SET id_fun_presupuesto=%s WHERE id_correspondencia=%s and estado_correspondencia=1",
    GetSQLValueString($_POST["id_fun_presupuesto"], "int"),
    GetSQLValueString($_POST["id_correspondencia"], "int")
  );
  $Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());
  echo $actualizado;
  echo '<meta http-equiv="refresh" content="0;URL=./devolucion.jsp" />';
}
if (isset($_POST['AsignarFunContabilidad'])) {
  var_dump($_POST["id_fun_contabilidad"]);
  var_dump($_POST["id_correspondencia"]);
  $updatecc = sprintf(
    "UPDATE correspondencia SET id_fun_contabilidad=%s WHERE id_correspondencia=%s and estado_correspondencia=1",
    GetSQLValueString($_POST["id_fun_contabilidad"], "int"),
    GetSQLValueString($_POST["id_correspondencia"], "int")
  );
  $Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());
  echo $actualizado;
  echo '<meta http-equiv="refresh" content="0;URL=./devolucion.jsp" />';
}
if (isset($_POST['AsignarFunTesoreria'])) {
  $updatecc = sprintf(
    "UPDATE correspondencia SET id_fun_tesoreria=%s WHERE id_correspondencia=%s and estado_correspondencia=1",
    GetSQLValueString($_POST["id_fun_tesoreria"], "int"),
    GetSQLValueString($_POST["id_correspondencia"], "int")
  );
  $Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());

  echo $actualizado;
  echo '<meta http-equiv="refresh" content="0;URL=./devolucion.jsp" />';
}



if (isset($_POST['archivar']) && "" != $_POST['archivar']) {
  $updatecc = sprintf(
    "UPDATE correspondencia SET estado_correspondencia=0 WHERE id_correspondencia=%s and estado_correspondencia=1",
    GetSQLValueString($_POST["archivar"], "int")
  );
  $Resultcc = mysql_query($updatecc, $conexion);
  echo $actualizado;
  mysql_free_result($Resultcc);
  echo '<meta http-equiv="refresh" content="0;URL=./devolucion.jsp" />';
}

?>

<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>46162 </h3>
        <p>Total de PQRS</p>
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
        <h3>82472</h3>
        <p>Licencias urbanisticas</p>
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
        <h3>540836</h3>
        <p>Ciudadanos</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-8">
            <?php
            if ((0 < privreg($info, $_SESSION['snr'], 3, 7)) or 1 == $_SESSION['rol']) { ?>
              <button data-toggle="modal" data-target="#miModal" type="button" class="btn btn-success" style="margin:15px;"><span class="glyphicon glyphicon-plus-sign"></span>Nueva Devolución</button>
            <?php } ?>
          </div>
          <div class="col-md-4">
            <h3> <b>Devoluciones de Dinero</b> </h3>
          </div>
        </div>


        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-12">
              <form class="navbar-form" name="fotertrm3252345rter1erteg" method="POST">
                <div class="input-group">
                  <div class="input-group-btn">Buscar
                    <select class="form-control" name="campo" required>
                      <option value="" selected> - - Buscar por: - - </option>
                      <option value="nombre_correspondencia">Radicado</option>
                      <option value="asunto_correspondencia">Asunto</option>
                      <option value="referencia">Referencia / Turno</option>
                    </select>
                  </div>
                  <div class="input-group-btn">
                    <input type="text" name="buscar" placeholder="Buscar" class="form-control" required></div>

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                  </div>
                </div>

              </form>
            </div>
          </div>
          <!-- FINAL box-tools pull-right -->
        </div>

        <style>
          .dataTables_filter {
            display: none;
          }
        </style>


        <div class="box-body">
          <div class="table-responsive">


            <table class="table table-striped table-bordered table-hover" id="inforesoluciones" cellspacing="0" width="100%">
              <thead>
                <tr align="center" valign="middle">
                  <th>Creación</th>
                  <th>Oficina Registro</th>
                  <th>Radicado</th>
                  <th>Asunto</th>
                  <th>Referencia / Turno</th>
                  <th>Ubicación</th>
                  <th>Actividad</th>
                  <th>Estado</th>
                  <th>Acción</th>
                </tr>
              </thead>

              <tbody>

                <?php

                // if (0 < $nump56 OR 0 < $nump57 OR 0 < $nump58 OR 0 < $nump59 OR 0 < $nump60 OR 0 < $nump61 OR 1 == $_SESSION['rol']) {
                if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                  $infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
                } elseif (isset($_POST['campo2']) && "" != $_POST['campo2']) {
                  $infobus = " and  " . $_POST['buscar2'] . $_POST['campo2'] . " ";
                  $id_fun_res = intval($_POST['campo2']);
                  $infobus = " and (id_fun_presupuesto=" . $id_fun_res . " or id_fun_contabilidad=" . $id_fun_res . " or id_fun_tesoreria=" . $id_fun_res . ") ";
                } else {
                  $infobus = "";
                }
                $query = "SELECT 
                  correspondencia.fecha_correspondencia,
                  oficina_registro.nombre_oficina_registro,
                  correspondencia.nombre_correspondencia,
                  correspondencia.asunto_correspondencia,
                  correspondencia.id_fun_presupuesto,
                  correspondencia.id_fun_contabilidad,
                  correspondencia.id_fun_tesoreria,
                  devolucion_form.turno,
                  devolucion_form.estado,
                  devolucion_form.rechazo,
                  correspondencia.id_correspondencia
                  FROM correspondencia
                  LEFT JOIN oficina_registro
                  ON correspondencia.codigo_oficina_de=oficina_registro.id_oficina_registro
                  LEFT JOIN devolucion_form
                  ON correspondencia.codigo_oficina_de=oficina_registro.id_oficina_registro AND correspondencia.id_correspondencia=devolucion_form.id_correspondencia
                  WHERE id_tipo_oficina_de=2 and id_tipo_correspondencia=308 and estado_correspondencia=1 " . $queryinfo . " " . $infobus . " order by id_correspondencia desc";

                $select = mysql_query($query, $conexion);
                $row = mysql_fetch_assoc($select);
                $totalRows = mysql_num_rows($select);
                if (0 < $totalRows) {
                  do {
                    echo '<tr><td>' . $row['fecha_correspondencia'] . '</td>';
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                    echo '<td>' . $row['nombre_correspondencia'] . '<br>';
                    if (isset($row['id_fun_presupuesto'])) { ?>
                      <i style="color:orange;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_presupuesto']); ?>"></i>&nbsp;
                    <?php }
                    if (isset($row['id_fun_contabilidad'])) { ?>
                      <i style="color:green;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_contabilidad']); ?>"></i>&nbsp;
                    <?php }
                    if (isset($row['id_fun_tesoreria'])) { ?>
                      <i style="color:#3368FF;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_tesoreria']); ?>"></i>&nbsp;
                <?php }
                    echo '</td>';
                    echo '<td>' . $row['asunto_correspondencia'] . '</td>';
                    echo '<td>' . $row['turno'] . '</td>';
                    echo '<td>';
                    switch ($row['estado']) {
                      case 0:
                        echo "Oficina Seccional";
                        break;
                      case 1:
                        echo "Oficina Seccional";
                        break;
                      case 2:
                        echo "Nivel Central (Tesoreria)";
                        break;
                      case 3:
                        echo "Nivel Central (Tesoreria)";
                        break;
                      case 4:
                        echo "Oficina Seccional";
                        break;
                      case 5:
                        echo "Oficina Principal";
                        break;
                      case 6:
                        echo "Nivel Central (Tesoreria)";
                        break;
                      case 7:
                        echo "Nivel Central (Presupuesto)";
                        break;
                      case 8:
                        echo "Nivel Central (Contabilidad)";
                        break;
                      case 9:
                        echo "Nivel Central (Tesoreria)";
                        break;
                      case 10:
                        echo "Nivel Central (Tesoreria)";
                        break;
                    }
                    echo '</td>';
                    echo '<td>';
                    switch ($row['estado']) {
                      case 0:
                        echo "Formulario";
                        break;
                      case 1:
                        echo "Documentos Anexos";
                        break;
                      case 2:
                        echo "Certificación Ingreso";
                        break;
                      case 3:
                        echo "Aprobación Tesoreria";
                        break;
                      case 4:
                        echo "Acto Administrativo";
                        break;
                      case 5:
                        echo "Creación Tercero";
                        break;
                      case 6:
                        echo "Reclasificación / Solicitud";
                        break;
                      case 7:
                        echo "Vincular Tercero";
                        break;
                      case 8:
                        echo "Acreedor";
                        break;
                      case 9:
                        echo "Orden Pago";
                        break;
                      case 10:
                        echo "Pagado";
                        break;
                    }
                    echo '</td>';
                    echo '<td>';
                    switch ($row['rechazo']) {
                      case 0:
                        echo '<i class="fa fa-circle" style="color:green;"> <span style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Aprobado</span></i>';
                        break;
                      case 1:
                        echo '<i class="fa fa-circle" style="color:red;"> <span style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Rechazo</span></i>';
                        break;
                    }
                    echo '<td style="width:80px;">
                          <a href="devolucion_detalle&' . $row['id_correspondencia'] . '.jsp" title="Detalle" class="btn-sm btn-success" target="_bank"><i class="fa fa-search" aria-hidden="true"></i></a>';
                    if (0 < $nump56 or 0 < $nump57 or 0 < $nump58 && 1 == $_SESSION['snr_tipo_oficina']) {
                      echo '<a name="' . $row['nombre_correspondencia'] . '" href="" class="btn-sm btn-warning buscar_devolucion" id="' . $row['id_correspondencia'] . '" data-toggle="modal"data-target="#popupasigna" title="Asignar Devolucion"><i class="fa fa-fw fa-group"></i></a>';
                    }
                    echo '</td>';
                  } while ($row = mysql_fetch_assoc($select));
                  mysql_free_result($select);
                }
                ?>
              </tbody>
            </table>
            <script>
              $(document).ready(function() {
                $('#inforesoluciones').DataTable({
                  "lengthMenu": [
                    [100, 200, 300, 500],
                    [100, 200, 300, 500]
                  ],
                  "language": {
                    "url": "http:cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [1, "desc"]
                  ]
                });
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- MODAL FORMULARIO DE INGRESO DE LA DEVOLUCION -->
<div class="modal fade bd-example-modal-lg" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">FORMULARIO DE DEVOLUCION DE DINERO</h4>
      </div>
      <div class="modal-body">

        <form action="" method="POST" name="for543543m1" enctype="multipart/form-data">
          <div class="row">

            <div class="col-md-6">
              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> DE:</label>
                <input type="text" class="form-control mayuscula" name="de" required readonly="readonly" value="<?php echo quees('oficina_registro', $info); ?>">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> PARA:</label>
                <input type="text" value="ARCHIVO DEVOLUCIONES" class="form-control" name="para" readonly="readonly" id="para" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> ASUNTO:</label>
                <input type="text" class="form-control" name="asunto_correspondencia" maxlength="250" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> DESCRIPCIÓN:</label>
                <textarea class="form-control" name="descripcion_correspondencia" maxlength="500" required></textarea>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
            <button type="submit" class="btn btn-success"><input type="hidden" name="resoluciondatos" value="resoluciondatos"><span class="glyphicon glyphicon-ok"></span> Crear </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="popupasigna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel"><label class="control-label">Correspondencia</label> <span id="asigna"></span></h4>
      </div>
      <div class="ver_devolucion" class="modal-body">

      </div>
    </div>
  </div>
</div>
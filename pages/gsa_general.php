<!-- GSA = GRUPO DE SERVICIOS ADMNISTRATIVOS -->
<?php
$nump85 = privilegios(85, $_SESSION['snr']);  // COORDINADOR ASEO Y CAFETERIA
$nump86 = privilegios(86, $_SESSION['snr']);  // ADMINISTRADOR ASEO Y CAFETERIA
$nump99 = privilegios(99, $_SESSION['snr']);  // PERFIL REPORTES ASEO Y CAFETERIA


// CONSULTA DE VARIABLES PERFIL DE MODULOS OFICINAS DE REGISTRO
$idfun = $_SESSION['snr'];
$consulfun = "SELECT id_oficina_registro FROM funcionario
 WHERE id_funcionario=$idfun AND estado_funcionario=1";
$selectfun = mysql_query($consulfun, $conexion);
$rowfun = mysql_fetch_assoc($selectfun);
if (isset($rowfun)) {
  $oficinaRegistro = $rowfun['id_oficina_registro'];
} else {
  $oficinaRegistro = 0;
}

// CONSULTA LUGAR DEL PUNTO UBICACION
$consulpunto = "SELECT id_punto_ubicacion FROM punto_ubicacion_enlace
 WHERE id_funcionario=$idfun AND estado_punto_ubicacion_enlace=1";
$selectpunto = mysql_query($consulpunto, $conexion);
$rowpunto = mysql_fetch_assoc($selectpunto);
if (isset($rowpunto)) {
  $puntoUbicacion = $rowpunto['id_punto_ubicacion'];
} else {
  $puntoUbicacion = 0;
}

// INSERTAR NUEVO PROVEEDOR
if (
  isset($_POST["nuevoproveedor"]) && '' != $_POST["nuevoproveedor"] &&
  isset($_POST["nombre_gsa_proveedor"]) && '' != $_POST["nombre_gsa_proveedor"] &&
  isset($_POST["nit_proveedor"]) && '' != $_POST["nit_proveedor"] &&
  isset($_POST["digito_verificacion"]) && '' != $_POST["digito_verificacion"] &&
  isset($_POST["representante_legal"]) && '' != $_POST["representante_legal"] &&

  isset($_POST["cedula_representante"]) && '' != $_POST["cedula_representante"] &&
  isset($_POST["telefono_contacto_1"]) && '' != $_POST["telefono_contacto_1"] &&
  isset($_POST["correo_contacto_1"]) && '' != $_POST["correo_contacto_1"] &&
  isset($_POST["direccion"]) && '' != $_POST["direccion"]
) {
  $nitProveedor = $_POST["nit_proveedor"];
  $consulnit = sprintf("SELECT COUNT(nit_proveedor) AS cuenta FROM gsa_proveedor WHERE nit_proveedor=$nitProveedor");
  $selectnit = mysql_query($consulnit, $conexion);
  $rownit = mysql_fetch_assoc($selectnit);

  if (0 < $rownit['cuenta']) {
  } else {

    $insertar = sprintf(
      "INSERT INTO gsa_proveedor (
      nombre_gsa_proveedor,
      nit_proveedor, 
      digito_verificacion,
      representante_legal,
      cedula_representante,
      nombre_contacto_1,
      
      telefono_contacto_1,
      correo_contacto_1,
      nombre_contacto_2,
      telefono_contacto_2,
      correo_contacto_2,
      direccion) VALUES (%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s)",
      GetSQLValueString($_POST["nombre_gsa_proveedor"], "text"),
      GetSQLValueString($_POST["nit_proveedor"], "text"),
      GetSQLValueString($_POST["digito_verificacion"], "int"),
      GetSQLValueString($_POST["representante_legal"], "text"),
      GetSQLValueString($_POST["cedula_representante"], "text"),
      GetSQLValueString($_POST["nombre_contacto_1"], "text"),

      GetSQLValueString($_POST["telefono_contacto_1"], "text"),
      GetSQLValueString($_POST["correo_contacto_1"], "text"),
      GetSQLValueString($_POST["nombre_contacto_2"], "text"),
      GetSQLValueString($_POST["telefono_contacto_2"], "text"),
      GetSQLValueString($_POST["correo_contacto_2"], "text"),
      GetSQLValueString($_POST["direccion"], "text")
    );
    $result = mysql_query($insertar, $conexion);
    echo $insertado;
    mysql_free_result($result);
  }
}

// ACTUALIZAR PROVEEDOR
if (
  isset($_POST["actualizarproveedor"]) && '' != $_POST["actualizarproveedor"] &&
  isset($_POST["id_gsa_proveedor"]) && '' != $_POST["id_gsa_proveedor"] &&
  isset($_POST["nombre_gsa_proveedor"]) && '' != $_POST["nombre_gsa_proveedor"] &&
  isset($_POST["nit_proveedor"]) && '' != $_POST["nit_proveedor"] &&
  isset($_POST["digito_verificacion"]) && '' != $_POST["digito_verificacion"] &&
  isset($_POST["representante_legal"]) && '' != $_POST["representante_legal"] &&

  isset($_POST["cedula_representante"]) && '' != $_POST["cedula_representante"] &&
  isset($_POST["telefono_contacto_1"]) && '' != $_POST["telefono_contacto_1"] &&
  isset($_POST["correo_contacto_1"]) && '' != $_POST["correo_contacto_1"] &&
  isset($_POST["direccion"]) && '' != $_POST["direccion"]
) {
  $actualizarProducto = sprintf(
    "UPDATE gsa_proveedor SET 
      nombre_gsa_proveedor=%s,
      nit_proveedor=%s, 
      digito_verificacion=%s, 
      representante_legal=%s, 
      cedula_representante=%s, 
      nombre_contacto_1=%s,

      telefono_contacto_1=%s,
      correo_contacto_1=%s,
      nombre_contacto_2=%s,
      telefono_contacto_2=%s,
      correo_contacto_2=%s,
      direccion=%s
      WHERE id_gsa_proveedor=%s",
    GetSQLValueString($_POST["nombre_gsa_proveedor"], "text"),
    GetSQLValueString($_POST["nit_proveedor"], "text"),
    GetSQLValueString($_POST["digito_verificacion"], "int"),
    GetSQLValueString($_POST["representante_legal"], "text"),
    GetSQLValueString($_POST["cedula_representante"], "text"),
    GetSQLValueString($_POST["nombre_contacto_1"], "text"),

    GetSQLValueString($_POST["telefono_contacto_1"], "text"),
    GetSQLValueString($_POST["correo_contacto_1"], "text"),
    GetSQLValueString($_POST["nombre_contacto_2"], "text"),
    GetSQLValueString($_POST["telefono_contacto_2"], "text"),
    GetSQLValueString($_POST["correo_contacto_2"], "text"),
    GetSQLValueString($_POST["direccion"], "text"),
    GetSQLValueString($_POST["id_gsa_proveedor"], "int")
  );
  $result = mysql_query($actualizarProducto, $conexion);
  echo $actualizado;
  mysql_free_result($result);
}


// INSERTAR NUEVAS ORDENES DE COMPRA 
if (
  isset($_POST["guardarOrden"]) && '' != $_POST["guardarOrden"] &&
  isset($_POST["id_gsa_proveedor"]) && '' != $_POST["id_gsa_proveedor"] &&
  isset($_POST["id_funcionario"]) && '' != $_POST["id_funcionario"] &&
  isset($_POST["numero_orden"]) && '' != $_POST["numero_orden"] &&
  isset($_POST["porcentaje_aiu"]) && '' != $_POST["porcentaje_aiu"] &&
  isset($_POST["fecha_inicio"]) && '' != $_POST["fecha_inicio"] &&
  isset($_POST["fecha_final"]) && '' != $_POST["fecha_final"]
) {

  $insertar = sprintf(
    "INSERT INTO gsa_orden (
    id_funcionario,
    id_gsa_proveedor,
    nombre_gsa_orden,
    region, 

    numero_orden,
    porcentaje_aiu,
    fecha_inicio, 
    fecha_final) VALUES (%s,%s,%s,%s, %s,%s,%s,%s)",
    GetSQLValueString($_POST["id_funcionario"], "int"),
    GetSQLValueString($_POST["id_gsa_proveedor"], "int"),
    GetSQLValueString('OC -', "text"),
    GetSQLValueString($_POST["region"], "text"),

    GetSQLValueString($_POST["numero_orden"], "text"),
    GetSQLValueString($_POST["porcentaje_aiu"], "text"),
    GetSQLValueString($_POST["fecha_inicio"], "date"),
    GetSQLValueString($_POST["fecha_final"], "date")
  );
  $result = mysql_query($insertar, $conexion);
  echo $insertado;
  mysql_free_result($result);
}

?>

<script>
  // Funcion para no duplicar envios de formularios
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

  function cambioproveedor(tabla, var2, var3) {
    jQuery.ajax({
      type: "POST",
      url: "pages/gsa_actualizar.php",
      data: 'option=' + tabla + '-' + var2 + '-' + var3,
      async: true,
      success: function(html) {
        location.reload();
      }
    })
  }

  $(function() {
    $('.editarProveedor').click(function() {
      var var2 = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + 'editamosProveedor' + '-' + var2,
        async: true,
        success: function(b) {
          jQuery('#divEditarProveedor').html(b);
        }
      })
    });
  })
</script>

<!-- CONTROL DE SEGURIDAD COORDINADOR SUPERADMINISTRADOR OFICINA REGISTRO PUNTO UBICACION-->
<?php if (0 < $nump85 OR 0 < $nump86 OR 0 < $nump99 OR 1 == $_SESSION['rol'] OR (0 != $oficinaRegistro and 0 < privreg($oficinaRegistro, $idfun, 5, 10)) OR 0 < $puntoUbicacion) { ?>

  <?php
  $parametroUrl = $_GET['i'];
  if ($parametroUrl  == 'proveedor') {
    $activep = 'class="active"';
    $tabp = 'class="active tab-pane"';
  } else {
    $activep = '';
    $tabp = 'class="tab-pane"';
  }
  if ($parametroUrl == 'orden') {
    $activeo = 'class="active"';
    $tabo = 'class="active tab-pane"';
  } else {
    $activeo = '';
    $tabo = 'class="tab-pane"';
  }
  if ($parametroUrl == 'insumo') {
    $activei = 'class="active"';
    $tabi = 'class="active tab-pane"';
  } else {
    $activei = '';
    $tabi = 'class="tab-pane"';
  }
  if ($parametroUrl == 'maquinaria') {
    $activem = 'class="active"';
    $tabm = 'class="active tab-pane"';
  } else {
    $activem = '';
    $tabm = 'class="tab-pane"';
  }
  if ($parametroUrl == 'jardineria') {
    $activej = 'class="active"';
    $tabj = 'class="active tab-pane"';
  } else {
    $activej = '';
    $tabj = 'class="tab-pane"';
  }
  if ($parametroUrl == 'fumigacion') {
    $activef = 'class="active"';
    $tabf = 'class="active tab-pane"';
  } else {
    $activef = '';
    $tabf = 'class="tab-pane"';
  }
  if ($parametroUrl == 'personal') {
    $activepe = 'class="active"';
    $tabpe = 'class="active tab-pane"';
  } else {
    $activepe = '';
    $tabpe = 'class="tab-pane"';
  }

  ?>
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li <?php echo $activep; ?>><a href="gsa_general&proveedor.jsp">Proveedores</a></li>
      <li <?php echo $activeo; ?>><a href="gsa_general&orden.jsp">Ordenes</a></li>
      <?php if (0 < $nump85 OR 0 < $nump86 OR 0 < $nump99 OR 1 == $_SESSION['rol']) { ?>
        <li <?php echo $activei; ?>><a href="gsa_general&insumo.jsp">Insumo</a></li>
        <li <?php echo $activem; ?>><a href="gsa_general&maquinaria.jsp">Maquinaria</a></li>
        <li <?php echo $activej; ?>><a href="gsa_general&jardineria.jsp">Jardineria</a></li>
        <li <?php echo $activef; ?>><a href="gsa_general&fumigacion.jsp">Fumigacion</a></li>
        <li <?php echo $activepe; ?>><a href="gsa_general&personal.jsp">Personal</a></li>
      <?php } ?>
    </ul>

    <div class="tab-content">


      <div <?php echo $tabp; ?> id="proveedores">
        <?php if (0 < $nump85 OR 0 < $nump86 OR 1 == $_SESSION['rol']) { ?>
          <button style="margin:15px;" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal"> Nuevo Proveedor </button>
        <?php } ?>

        <table class="table table-striped table-bordered table-hover" id="tableproveedor" cellspacing="0" width="100%">
          <thead>
            <tr align="center" valign="middle">
              <th>#</th>
              <th>Proveedor</th>
              <th>NIT</th>
              <th>Representante Legal</th>
              <th>Cedula R.Legal</th>
              <th>Nombre Contacto</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Nombre Contacto Opcional</th>
              <th>Telefono Opcional</th>
              <th>Email Opcional</th>
              <th>Dirección</th>
              <th>Fecha</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT 
              id_gsa_proveedor,
              nombre_gsa_proveedor,
              nit_proveedor,
              digito_verificacion,
              representante_legal,
              cedula_representante,
              nombre_contacto_1,
              nombre_contacto_2,
              telefono_contacto_1,
              correo_contacto_1,
              telefono_contacto_2,
              correo_contacto_2,
              direccion,
              fecha,
              estado_gsa_proveedor
            FROM gsa_proveedor ORDER BY id_gsa_proveedor DESC";
            $select = mysql_query($query, $conexion);
            $row = mysql_fetch_assoc($select);
            $totalRows = mysql_num_rows($select);
            if (0 < $totalRows) {
              do {
                echo '<tr>';
                echo '<td>' . $row['id_gsa_proveedor'] . '</td>';
                echo '<td>' . $row['nombre_gsa_proveedor'] . '</td>';
                echo '<td>' . $row['nit_proveedor'] . ' - ' . $row['digito_verificacion'] . '</td>';
                echo '<td>' . $row['representante_legal'] . '</td>';
                echo '<td>' . $row['cedula_representante'] . '</td>';
                echo '<td>' . $row['nombre_contacto_1'] . '</td>';
                echo '<td>' . $row['telefono_contacto_1'] . '</td>';
                echo '<td>' . $row['correo_contacto_1'] . '</td>';
                echo '<td>' . $row['nombre_contacto_2'] . '</td>';
                echo '<td>' . $row['telefono_contacto_2'] . '</td>';
                echo '<td>' . $row['correo_contacto_2'] . '</td>';
                echo '<td>' . $row['direccion'] . '</td>';
                echo '<td>' . $row['fecha'] . '</td>';
                echo '<td>';

                if (0 < $nump85 OR 0 < $nump86 OR 1 == $_SESSION['rol']) {
                  if (1 == $row['estado_gsa_proveedor']) { ?>
                    <button class="btn btn-xs btn-success" onclick="cambioproveedor('proveedor', <?php echo $row['id_gsa_proveedor']; ?>, 0);">Activo</button>
                  <?php
                  } elseif (0 == $row['estado_gsa_proveedor']) { ?>
                    <button class="btn btn-xs btn-danger" onclick="cambioproveedor('proveedor', <?php echo $row['id_gsa_proveedor']; ?>, 1);">Inactivo</button>
                  <?php } ?>

                  <a class="editarProveedor btn btn-xs btn-warning" title="Editar Proveedor" id="<?php echo $row['id_gsa_proveedor']; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#editar_proveedor"><i class="glyphicon glyphicon-pencil"></i></a>
            <?php
                }
                echo '</td>';
                echo '</tr>';
              } while ($row = mysql_fetch_assoc($select));
              mysql_free_result($select);
            }
            ?>
            <script>
              $(document).ready(function() {
                $('#tableproveedor').DataTable({
                  "lengthMenu": [
                    [50, 100, 200, 300, 500],
                    [50, 100, 200, 300, 500]
                  ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [0, "asc"]
                  ]
                });
              });
            </script>
          </tbody>
        </table>


      </div>


      <div <?php echo $tabo; ?> id="ordenes">

        <?php if (0 < $nump85 OR 0 < $nump86 OR 1 == $_SESSION['rol']) { ?>
          <button style="margin:15px;" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#orderCompra"> Nueva Orden </button>
        <?php } ?>

        <table class="table table-striped table-bordered table-hover" id="tableorden" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Region Secop</th>
              <th>Id</th>
              <th>Proveedor</th>
              <th>Numero Orden</th>
              <th>Fecha Inicio</th>
              <th>Fecha Final</th>
              <th>Fecha Registro</th>
              <th title="Funcionario a Cargo OC">Funcionario</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_GET['i'])) {
              if (0 < $nump86 OR 1 == $_SESSION['rol']) {
                $IdOficina = $_GET['i']; // GET OFICINA REGISTRO
              } else {
                $IdOficina = 0;
              }
            } else {
              $IdOficina = 0;
            }
            if (0 < $nump86 OR 1 == $_SESSION['rol']) {
              $query = "SELECT 
              gsa_orden.id_gsa_orden,
              gsa_proveedor.nombre_gsa_proveedor,
              gsa_orden.id_funcionario,
              gsa_orden.numero_orden,
              gsa_orden.region,
              gsa_orden.fecha_inicio,
              gsa_orden.fecha_final,
              gsa_orden.fecha,
              funcionario.nombre_funcionario
              FROM gsa_orden
              LEFT JOIN gsa_proveedor
              ON gsa_orden.id_gsa_proveedor=gsa_proveedor.id_gsa_proveedor
              LEFT JOIN funcionario
              ON gsa_orden.id_funcionario=funcionario.id_funcionario
              WHERE estado_gsa_orden=1 AND estado_gsa_proveedor=1 ORDER BY id_gsa_orden DESC";
            } elseif (0 < $nump85) {
              $idCoordinador = $_SESSION["snr"];
              $query = "SELECT 
              gsa_orden.id_gsa_orden,
              gsa_proveedor.nombre_gsa_proveedor,
              gsa_orden.id_funcionario,
              gsa_orden.numero_orden,
              gsa_orden.region,
              gsa_orden.fecha_inicio,
              gsa_orden.fecha_final,
              gsa_orden.fecha,
              funcionario.nombre_funcionario
              FROM gsa_orden
              LEFT JOIN gsa_proveedor
              ON gsa_orden.id_gsa_proveedor=gsa_proveedor.id_gsa_proveedor
              LEFT JOIN funcionario
              ON gsa_orden.id_funcionario=funcionario.id_funcionario
              WHERE estado_gsa_orden=1 AND estado_gsa_proveedor=1 AND gsa_orden.id_funcionario=$idCoordinador ORDER BY id_gsa_orden DESC";
            } elseif (0 < $puntoUbicacion) {
              $idFunPunto = $_SESSION['snr'];
              $query = "SELECT 
              gsa_orden.id_gsa_orden,
              gsa_proveedor.nombre_gsa_proveedor,
              gsa_orden.id_funcionario,
              gsa_orden.numero_orden,
              gsa_orden.region,
              gsa_orden.fecha_inicio,
              gsa_orden.fecha_final,
              gsa_orden.fecha,
              funcionario.nombre_funcionario
              FROM gsa_orden
              LEFT JOIN gsa_proveedor
              ON gsa_orden.id_gsa_proveedor=gsa_proveedor.id_gsa_proveedor
              LEFT JOIN funcionario
              ON gsa_orden.id_funcionario=funcionario.id_funcionario
              LEFT JOIN gsa_sedes
              ON gsa_orden.id_gsa_orden=gsa_sedes.id_gsa_orden
              LEFT JOIN punto_ubicacion_enlace
              ON gsa_sedes.id_punto_ubicacion=punto_ubicacion_enlace.id_punto_ubicacion
              WHERE estado_gsa_orden=1 AND 
              estado_gsa_proveedor=1 AND 
              gsa_sedes.id_punto_ubicacion=$puntoUbicacion AND 
              punto_ubicacion_enlace.id_funcionario=$idFunPunto ORDER BY id_gsa_orden DESC";
            } else {
              $idFunOficina = $_SESSION['snr'];
              $ConsultaOficina = "SELECT id_oficina_registro FROM funcionario WHERE id_funcionario=$idFunOficina AND estado_funcionario=1";
              $selectpro = mysql_query($ConsultaOficina, $conexion);
              $rowpro = mysql_fetch_assoc($selectpro);
              if (isset($rowpro)) {
                $idOficinaRegistro = $rowpro['id_oficina_registro'];
              } else {
                $idOficinaRegistro = 0;
              }
              $query = "SELECT 
                gsa_orden.id_gsa_orden,
                gsa_proveedor.nombre_gsa_proveedor,
                gsa_orden.id_funcionario,
                gsa_orden.numero_orden,
                gsa_orden.region,
                gsa_orden.fecha_inicio,
                gsa_orden.fecha_final,
                gsa_orden.fecha,
                funcionario.nombre_funcionario
              FROM gsa_orden
              LEFT JOIN gsa_proveedor
              ON gsa_orden.id_gsa_proveedor=gsa_proveedor.id_gsa_proveedor
              LEFT JOIN funcionario
              ON gsa_orden.id_funcionario=funcionario.id_funcionario
              LEFT JOIN gsa_sedes
              ON gsa_orden.id_gsa_orden=gsa_sedes.id_gsa_orden
              WHERE estado_gsa_orden=1 AND estado_gsa_proveedor=1 AND gsa_sedes.id_oficina_registro=$idOficinaRegistro ORDER BY region DESC";
            }
            $select = mysql_query($query, $conexion);
            $row = mysql_fetch_assoc($select);
            $totalRows = mysql_num_rows($select);
            if (0 < $totalRows) {
              do {
                $fechaInicioC = date_create($row['fecha_inicio']);
                $fechaInicio = date_format($fechaInicioC, "d/m/Y");
                $fechaFinalC = date_create($row['fecha_final']);
                $fechaFinal = date_format($fechaFinalC, "d/m/Y");
                $fechaRegistroC = date_create($row['fecha']);
                $fechaRegistro = date_format($fechaRegistroC, "d/m/Y H:i:s");
                echo '<tr>';
                echo '<td> Region -  ' . $row['region'] . '</td>';
                echo '<td>' . $row['id_gsa_orden'] . '</td>';
                echo '<td>' . $row['nombre_gsa_proveedor'] . '</td>';
                echo '<td> OC - ' . $row['numero_orden'] . '</td>';
                echo '<td>' . $fechaInicio . '</td>';
                echo '<td>' . $fechaFinal . '</td>';
                echo '<td>' . $fechaRegistro . '</td>';
                echo '<td>' . $row['nombre_funcionario'] . '</td>';
                echo '<td>';
                if (0 < $nump85 OR 0 < $nump86 OR 1 == $_SESSION['rol']) {
                  echo '<a class="btn btn-warning btn-xs" href="gsa_general_detalle&' . $row['id_gsa_orden'] . '.jsp" title="Editar Orden"><i class="fa fa-fw fa-pencil"></i></a>';
                }

                $idOrden23 =  $row['id_gsa_orden'];
                // VALIDA QUE EXISTA SEDES CARGADAS A LA ORDEN
                $query2 = "SELECT count(id_gsa_orden) AS Cuenta2 FROM gsa_sedes WHERE id_gsa_orden=$idOrden23";
                $select2 = mysql_query($query2, $conexion);
                $row2 = mysql_fetch_assoc($select2);
                // VALIDA QUE EXISTA PRODUCTOS CARGADAS A LA ORDEN
                $query3 = "SELECT count(id_gsa_orden) AS Cuenta3 FROM gsa_producto WHERE id_gsa_orden=$idOrden23";
                $select3 = mysql_query($query3, $conexion);
                $row3 = mysql_fetch_assoc($select3);
                // VALIDA QUE EXISTA MAQUINARIA CARGADAS A LA ORDEN
                $query4 = "SELECT count(id_gsa_orden) AS Cuenta4 FROM gsa_maquinaria WHERE id_gsa_orden=$idOrden23";
                $select4 = mysql_query($query4, $conexion);
                $row4 = mysql_fetch_assoc($select4);
                if (0 < $row2['Cuenta2'] and 0 < $row3['Cuenta3'] and 0 < $row4['Cuenta4']) {
                  echo '<a class="btn btn-primary btn-xs" href="gsa_orden&' . $row['id_gsa_orden'] . '.jsp" title="Ver Solicitudes"><i class="fa fa-fw fa-folder-o"></i></a>';
                }
                echo '</td>';
                echo '</tr>';
              } while ($row = mysql_fetch_assoc($select));
              mysql_free_result($select);
            }
            ?>
            <script>
              $(document).ready(function() {
                $('#tableorden').DataTable({
                  "lengthMenu": [
                    [50, 100, 200, 300, 500],
                    [50, 100, 200, 300, 500]
                  ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [0, "asc"]
                  ]
                });
              });
            </script>
          </tbody>
        </table>

      </div>

      <?php if (0 < $nump85 OR 0 < $nump86 OR 0 < $nump99 OR 1 == $_SESSION['rol']) { ?>
        <div <?php echo $tabi; ?> id="insumo">
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <form class="navbar-form" name="insumo12" method="post" action="">
                <div class="input-group">
                  <div class="input-group-btn">Buscar
                    <select class="form-control" name="campo" required>
                      <option value="" selected> - - Buscar por: - - </option>
                      <option value="oficina_registro.nombre_oficina_registro">Nombre Oficina Registro</option>
                      <option value="punto_ubicacion.nombre_punto_ubicacion">Nombre Punto Ubicacion</option>
                      <option value="gsa_solicitud_insumo.id_solicitud">Numero Solicitud</option>
                      <option value="ano">Año</option>
                      <option value="region">Region Secop</option>
                    </select>
                  </div><!-- /btn-group -->
                  <div class="input-group-btn">
                    <input type="text" name="buscarInsumo" placeholder="" class="form-control" required>
                  </div>
                  <!-- /input-group -->
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                  </div>
                </div>
              </form>
            </div>
          </div>


          <style>
            .dataTables_filter {
              display: none;
            }
          </style>
          <table class="table table-striped table-bordered table-hover" id="tableinsumo" cellspacing="0" width="100%">
            <thead>
              <tr align="center" valign="middle">
                <th>Oficina o Ubicacion</th>
                <th>Region Secop</th>
                <th>Id Solicitud</th>
                <th>Periodo Inicio</th>
                <th>Periodo Final</th>
                <th>Tipo</th>
                <th title="Elementos, Maquinaria y Equipo">Maquinaria</th>
                <th>Precio UND</th>
                <th title="Cantidad de Unidades asignadas por Nivel Central">Cantidad SNR</th>
                <th>Cantidad * Precio</th>
                <th title="Cantidad Recibida  ">Cantidad Verificada</th>
                <th title="Fecha en que se crea solicitud">Fecha Creado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['buscarInsumo']) && "" != $_POST['buscarInsumo']) {
                if ('ano' === $_POST['campo']) {
                  $infobus = "YEAR(gsa_solicitud.fecha_inicio) = " . $_POST['buscarInsumo'] . "";
                } else {
                  $infobus =  $_POST['campo'] . " like '%" . $_POST['buscarInsumo'] . "%' ";
                }
                $infop = $infobus;
              } else {
                $infop = ' gsa_solicitud_insumo.estado_gsa_solicitud_insumo=1';
              }

              $query = "SELECT 
              gsa_solicitud_insumo.id_solicitud,
              gsa_solicitud_insumo.nombre_gsa_solicitud_insumo,
              gsa_producto.bien_producto,
              gsa_producto.precio_unitario,
              gsa_solicitud_insumo.id_oficina_registro,
              oficina_registro.nombre_oficina_registro,
              gsa_solicitud_insumo.id_punto_ubicacion,
              punto_ubicacion.nombre_punto_ubicacion,
              gsa_solicitud_insumo.cantidad_producto,
              gsa_solicitud_insumo.cantidad_verifica,
              gsa_solicitud_insumo.fecha,
              gsa_solicitud.fecha_inicio,
              gsa_solicitud.fecha_final,
              gsa_orden.region
              FROM gsa_solicitud_insumo
              LEFT JOIN gsa_producto
              ON gsa_solicitud_insumo.id_gsa_producto=gsa_producto.id_gsa_producto
              LEFT JOIN oficina_registro
              ON gsa_solicitud_insumo.id_oficina_registro=oficina_registro.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON gsa_solicitud_insumo.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
              LEFT JOIN gsa_solicitud
              ON gsa_solicitud_insumo.id_solicitud=gsa_solicitud.id_gsa_solicitud
              LEFT JOIN gsa_orden
              ON gsa_solicitud.id_gsa_orden=gsa_orden.id_gsa_orden
              WHERE  $infop ";
              $select = mysql_query($query, $conexion);
              $row = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  if (isset($row['id_oficina_registro'])) {
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                  }
                  if (isset($row['id_punto_ubicacion'])) {
                    echo '<td>' . $row['nombre_punto_ubicacion'] . '</td>';
                  }
                  echo '<td> Region - ' . $row['region'] . '</td>';
                  echo '<td>' . $row['id_solicitud'] . '</td>';
                  $fecha = date_create($row['fecha_inicio']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  $fecha = date_create($row['fecha_final']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '<td>' . $row['nombre_gsa_solicitud_insumo'] . '</td>';
                  echo '<td>' . $row['bien_producto'] . '</td>';
                  echo '<td>' . $row['precio_unitario'] . '</td>';
                  echo '<td>' . $row['cantidad_producto'] . '</td>';
                  echo '<td>' . $row['cantidad_producto'] * $row['precio_unitario'] . '</td>';
                  echo '<td>' . $row['cantidad_verifica'] . '</td>';
                  $fecha = date_create($row['fecha']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y H:i:s") . '</td>';
                  echo '</tr>';
                } while ($row = mysql_fetch_assoc($select));
                mysql_free_result($select);
              }
              ?>
              <script>
                $(document).ready(function() {
                  $('#tableinsumo').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        text: 'Pdf',
                        title: "ELEMENTOS, MAQUINARIA Y EQUIPO",
                        customize: function(doc) {
                          doc.styles.title = {
                            color: 'gray',
                            fontSize: '14',
                            alignment: 'center'
                          }
                        }
                      },
                      {
                        extend: 'excel',
                        text: 'Excel',
                        title: "ELEMENTOS, MAQUINARIA Y EQUIPO"
                      }
                    ],
                    "lengthMenu": [
                      [50, 100, 200, 300, 500],
                      [50, 100, 200, 300, 500]
                    ],
                    "language": {
                      "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                    },
                    "aaSorting": [
                      [0, "asc"]
                    ]
                  });
                });
              </script>
            </tbody>
          </table>

        </div>
      <?php } ?>

      <?php if (0 < $nump85 OR 0 < $nump86 OR 0 < $nump99 OR 1 == $_SESSION['rol']) { ?>
        <div <?php echo $tabm; ?> id="maquinaria">
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <form class="navbar-form" name="maquinaria12" method="post" action="">
                <div class="input-group">
                  <div class="input-group-btn">Buscar
                    <select class="form-control" name="campo" required>
                      <option value="" selected> - - Buscar por: - - </option>
                      <option value="oficina_registro.nombre_oficina_registro">Nombre Oficina Registro</option>
                      <option value="punto_ubicacion.nombre_punto_ubicacion">Nombre Punto Ubicacion</option>
                      <option value="gsa_solicitud_maquinaria.id_solicitud">Numero Solicitud</option>
                      <option value="ano">Año</option>
                      <option value="region">Region Secop</option>
                    </select>
                  </div><!-- /btn-group -->
                  <div class="input-group-btn">
                    <input type="text" name="buscarMaquinaria" placeholder="" class="form-control" required>
                  </div>
                  <!-- /input-group -->
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                  </div>
                </div>
              </form>
            </div>
          </div>


          <style>
            .dataTables_filter {
              display: none;
            }
          </style>
          <table class="table table-striped table-bordered table-hover" id="tablemaquinaria" cellspacing="0" width="100%">
            <thead>
              <tr align="center" valign="middle">
                <th>Oficina o Ubicacion</th>
                <th>Region Secop</th>
                <th>Id Solicitud</th>
                <th>Periodo Inicio</th>
                <th>Periodo Final</th>
                <th>Tipo</th>
                <th title="Elementos, Maquinaria y Equipo">Maquinaria</th>
                <th>Precio UND</th>
                <th title="Cantidad de Unidades asignadas por Nivel Central">Cantidad SNR</th>
                <th>Cantidad * Precio</th>
                <th># Serial</th>
                <th title="Cantidad Recibida  ">Cantidad Verificada</th>
                <th title="Fecha en que se crea solicitud">Fecha Creado</th>
                <th title="Fecha en que llego elemento a oficina - ubicacion">Fecha LLegada</th>
                <th title="Fecha en que oficina - ubicacion devuelven elemento a Proveedor">Fecha Entrega P.</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['buscarMaquinaria']) && "" != $_POST['buscarMaquinaria']) {
                if ('ano' === $_POST['campo']) {
                  $infobus = "YEAR(gsa_solicitud.fecha_inicio) = " . $_POST['buscarMaquinaria'] . "";
                } else {
                  $infobus =  $_POST['campo'] . " like '%" . $_POST['buscarMaquinaria'] . "%' ";
                }
                $infop = $infobus;
              } else {
                $infop = ' gsa_solicitud_maquinaria.estado_gsa_solicitud_maquinaria=1';
              }

              $query = "SELECT 
              gsa_solicitud_maquinaria.id_solicitud,
              gsa_solicitud_maquinaria.nombre_gsa_solicitud_maquinaria,
              gsa_maquinaria.bien_maquinaria,
              gsa_maquinaria.precio_unitario,
              gsa_solicitud_maquinaria.id_oficina_registro,
              oficina_registro.nombre_oficina_registro,
              gsa_solicitud_maquinaria.id_punto_ubicacion,
              punto_ubicacion.nombre_punto_ubicacion,
              gsa_solicitud_maquinaria.cantidad_producto,
              gsa_solicitud_maquinaria.serial_maquinaria,
              gsa_solicitud_maquinaria.cantidad_verifica,
              gsa_solicitud_maquinaria.fecha,
              gsa_solicitud_maquinaria.fecha_entrega,
              gsa_solicitud_maquinaria.fecha_devolucion,
              gsa_solicitud_maquinaria.estado_gsa_solicitud_maquinaria,

              gsa_solicitud.fecha_inicio,
              gsa_solicitud.fecha_final,
              gsa_orden.region
              FROM gsa_solicitud_maquinaria
              LEFT JOIN gsa_maquinaria
              ON gsa_solicitud_maquinaria.id_gsa_maquinaria=gsa_maquinaria.id_gsa_maquinaria
              LEFT JOIN oficina_registro
              ON gsa_solicitud_maquinaria.id_oficina_registro=oficina_registro.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON gsa_solicitud_maquinaria.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
              LEFT JOIN gsa_solicitud
              ON gsa_solicitud_maquinaria.id_solicitud=gsa_solicitud.id_gsa_solicitud
              LEFT JOIN gsa_orden
              ON gsa_solicitud.id_gsa_orden=gsa_orden.id_gsa_orden
              WHERE  $infop ";
              $select = mysql_query($query, $conexion);
              $row = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  if (isset($row['id_oficina_registro'])) {
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                  }
                  if (isset($row['id_punto_ubicacion'])) {
                    echo '<td>' . $row['nombre_punto_ubicacion'] . '</td>';
                  }
                  echo '<td> Region - ' . $row['region'] . '</td>';
                  echo '<td>' . $row['id_solicitud'] . '</td>';
                  $fecha = date_create($row['fecha_inicio']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  $fecha = date_create($row['fecha_final']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '<td>' . $row['nombre_gsa_solicitud_maquinaria'] . '</td>';
                  echo '<td>' . $row['bien_maquinaria'] . '</td>';
                  echo '<td>' . $row['precio_unitario'] . '</td>';
                  echo '<td>' . $row['cantidad_producto'] . '</td>';
                  echo '<td>' . $row['cantidad_producto'] * $row['precio_unitario'] . '</td>';
                  echo '<td>' . $row['serial_maquinaria'] . '</td>';
                  echo '<td>' . $row['cantidad_verifica'] . '</td>';
                  $fecha = date_create($row['fecha']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y H:i:s") . '</td>';
                  $fecha = date_create($row['fecha_entrega']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  $fecha = date_create($row['fecha_devolucion']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '</tr>';
                } while ($row = mysql_fetch_assoc($select));
                mysql_free_result($select);
              }
              ?>
              <script>
                $(document).ready(function() {
                  $('#tablemaquinaria').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        text: 'Pdf',
                        title: "ELEMENTOS, MAQUINARIA Y EQUIPO",
                        customize: function(doc) {
                          doc.styles.title = {
                            color: 'gray',
                            fontSize: '14',
                            alignment: 'center'
                          }
                        }
                      },
                      {
                        extend: 'excel',
                        text: 'Excel',
                        title: "ELEMENTOS, MAQUINARIA Y EQUIPO",
                        exportOptions: {
                          modifier: {
                            page: 'current'
                          }
                        }
                      }
                    ],
                    "lengthMenu": [
                      [50, 100, 200, 300, 500],
                      [50, 100, 200, 300, 500]
                    ],
                    "language": {
                      "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                    },
                    "aaSorting": [
                      [0, "asc"]
                    ]
                  });
                });
              </script>
            </tbody>
          </table>

        </div>
      <?php } ?>

      <?php if (0 < $nump85 OR 0 < $nump86 OR 0 < $nump99 OR 1 == $_SESSION['rol']) { ?>
        <div <?php echo $tabj; ?> id="jardineria">
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <form class="navbar-form" name="maquinaria12" method="post" action="">
                <div class="input-group">
                  <div class="input-group-btn">Buscar
                    <select class="form-control" name="campo" required>
                      <option value="" selected> - - Buscar por: - - </option>
                      <option value="oficina_registro.nombre_oficina_registro">Nombre Oficina Registro</option>
                      <option value="punto_ubicacion.nombre_punto_ubicacion">Nombre Punto Ubicacion</option>
                      <option value="gsa_solicitud_jardineria.id_solicitud">Numero Solicitud</option>
                      <option value="ano">Año</option>
                      <option value="region">Region Secop</option>
                    </select>
                  </div><!-- /btn-group -->
                  <div class="input-group-btn">
                    <input type="text" name="buscarJardineria" placeholder="" class="form-control" required>
                  </div>
                  <!-- /input-group -->
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                  </div>
                </div>
              </form>
            </div>
          </div>


          <style>
            .dataTables_filter {
              display: none;
            }
          </style>
          <table class="table table-striped table-bordered table-hover" id="tablejardineria" cellspacing="0" width="100%">
            <thead>
              <tr align="center" valign="middle">
                <th>Oficina o Ubicacion</th>
                <th>Region Secop</th>
                <th>Id Solicitud</th>
                <th>Periodo Inicio</th>
                <th>Periodo Final</th>
                <th>Tipo</th>
                <th title="Fecha en que se programo por SNR el servicio">Fecha Programa</th>
                <th>Valor Servicio</th>
                <th title="Fecha en que se realizo el servicio">Fecha Realiza</th>
                <th title="Nombre de quien realizo el servicio">Nombre Personal</th>
                <th title="Fecha cuando se atualizo el registro">Fecha Actuliza</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['buscarJardineria']) && "" != $_POST['buscarJardineria']) {
                if ('ano' === $_POST['campo']) {
                  $infobus = "YEAR(gsa_solicitud.fecha_inicio) = " . $_POST['buscarJardineria'] . "";
                } else {
                  $infobus =  $_POST['campo'] . " like '%" . $_POST['buscarJardineria'] . "%' ";
                }
                $infop = $infobus;
              } else {
                $infop = ' gsa_solicitud_jardineria.estado_gsa_solicitud_jardineria=1';
              }

              $query = "SELECT 
              gsa_solicitud_jardineria.id_solicitud,
              gsa_solicitud_jardineria.nombre_gsa_solicitud_jardineria,
              gsa_solicitud_jardineria.id_oficina_registro,
              oficina_registro.nombre_oficina_registro,
              gsa_solicitud_jardineria.id_punto_ubicacion,
              punto_ubicacion.nombre_punto_ubicacion,
              gsa_solicitud_jardineria.fecha_programa,
              gsa_solicitud_jardineria.valor_servicio,
              gsa_solicitud_jardineria.fecha_realiza,
              gsa_solicitud_jardineria.nombre_personal,
              gsa_solicitud_jardineria.actualiza,
              gsa_solicitud.fecha_inicio,
              gsa_solicitud.fecha_final,
              gsa_orden.region
              FROM gsa_solicitud_jardineria
              LEFT JOIN oficina_registro
              ON gsa_solicitud_jardineria.id_oficina_registro=oficina_registro.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON gsa_solicitud_jardineria.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
              LEFT JOIN gsa_solicitud
              ON gsa_solicitud_jardineria.id_solicitud=gsa_solicitud.id_gsa_solicitud
              LEFT JOIN gsa_orden
              ON gsa_solicitud.id_gsa_orden=gsa_orden.id_gsa_orden
              WHERE  $infop ";
              $select = mysql_query($query, $conexion);
              $row = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  if (isset($row['id_oficina_registro'])) {
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                  }
                  if (isset($row['id_punto_ubicacion'])) {
                    echo '<td>' . $row['nombre_punto_ubicacion'] . '</td>';
                  }
                  echo '<td> Region - ' . $row['region'] . '</td>';
                  echo '<td>' . $row['id_solicitud'] . '</td>';
                  $fecha = date_create($row['fecha_inicio']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  $fecha = date_create($row['fecha_final']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '<td>' . $row['nombre_gsa_solicitud_jardineria'] . '</td>';
                  $fecha = date_create($row['fecha_programa']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '<td>' . $row['valor_servicio'] . '</td>';
                  $fecha = date_create($row['fecha_realiza']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '<td>' . $row['nombre_personal'] . '</td>';
                  $fecha = date_create($row['actualiza']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y H:i:s") . '</td>';
                  echo '</tr>';
                } while ($row = mysql_fetch_assoc($select));
                mysql_free_result($select);
              }
              ?>
              <script>
                $(document).ready(function() {
                  $('#tablejardineria').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        text: 'Pdf',
                        title: "JARDINERIA",
                        customize: function(doc) {
                          doc.styles.title = {
                            color: 'gray',
                            fontSize: '14',
                            alignment: 'center'
                          }
                        }
                      },
                      {
                        extend: 'excel',
                        text: 'Excel',
                        title: "JARDINERIA",
                        exportOptions: {
                          modifier: {
                            page: 'current'
                          }
                        }
                      }
                    ],
                    "lengthMenu": [
                      [50, 100, 200, 300, 500],
                      [50, 100, 200, 300, 500]
                    ],
                    "language": {
                      "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                    },
                    "aaSorting": [
                      [0, "asc"]
                    ]
                  });
                });
              </script>
            </tbody>
          </table>

        </div>
      <?php } ?>

      <?php if (0 < $nump85 OR 0 < $nump86 OR 0 < $nump99 OR 1 == $_SESSION['rol']) { ?>
        <div <?php echo $tabf; ?> id="fumigacion">
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <form class="navbar-form" name="fumigacion12" method="post" action="">
                <div class="input-group">
                  <div class="input-group-btn">Buscar
                    <select class="form-control" name="campo" required>
                      <option value="" selected> - - Buscar por: - - </option>
                      <option value="oficina_registro.nombre_oficina_registro">Nombre Oficina Registro</option>
                      <option value="punto_ubicacion.nombre_punto_ubicacion">Nombre Punto Ubicacion</option>
                      <option value="gsa_solicitud_fumigacion.id_solicitud">Numero Solicitud</option>
                      <option value="ano">Año</option>
                      <option value="region">Region Secop</option>
                    </select>
                  </div><!-- /btn-group -->
                  <div class="input-group-btn">
                    <input type="text" name="buscarFumigacion" placeholder="" class="form-control" required>
                  </div>
                  <!-- /input-group -->
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <style>
            .dataTables_filter {
              display: none;
            }
          </style>
          <table class="table table-striped table-bordered table-hover" id="tablefumigacion" cellspacing="0" width="100%">
            <thead>
              <tr align="center" valign="middle">
                <th>Oficina o Ubicacion</th>
                <th>Region Secop</th>
                <th>Id Solicitud</th>
                <th>Periodo Inicio</th>
                <th>Periodo Final</th>
                <th>Tipo</th>
                <th title="Fecha en que se programo por SNR el servicio">Fecha Programa</th>
                <th>Valor Servicio</th>
                <th title="Fecha en que se realizo el servicio">Fecha Realiza</th>
                <th title="Nombre de quien realizo el servicio">Nombre Personal</th>
                <th title="Fecha cuando se atualizo el registro">Fecha Actuliza</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['buscarFumigacion']) && "" != $_POST['buscarFumigacion']) {
                if ('ano' === $_POST['campo']) {
                  $infobus = "YEAR(gsa_solicitud.fecha_inicio) = " . $_POST['buscarFumigacion'] . "";
                } else {
                  $infobus =  $_POST['campo'] . " like '%" . $_POST['buscarFumigacion'] . "%' ";
                }
                $infop = $infobus;
              } else {
                $infop = ' gsa_solicitud_fumigacion.estado_gsa_solicitud_fumigacion=1';
              }

              $query = "SELECT 
              gsa_solicitud_fumigacion.id_solicitud,
              gsa_solicitud_fumigacion.nombre_gsa_solicitud_fumigacion,
              gsa_solicitud_fumigacion.id_oficina_registro,
              oficina_registro.nombre_oficina_registro,
              gsa_solicitud_fumigacion.id_punto_ubicacion,
              punto_ubicacion.nombre_punto_ubicacion,
              gsa_solicitud_fumigacion.fecha_programa,
              gsa_solicitud_fumigacion.valor_servicio,
              gsa_solicitud_fumigacion.fecha_realiza,
              gsa_solicitud_fumigacion.nombre_personal,
              gsa_solicitud_fumigacion.actualiza,
              gsa_solicitud.fecha_inicio,
              gsa_solicitud.fecha_final,
              gsa_orden.region
              FROM gsa_solicitud_fumigacion
              LEFT JOIN oficina_registro
              ON gsa_solicitud_fumigacion.id_oficina_registro=oficina_registro.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON gsa_solicitud_fumigacion.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
              LEFT JOIN gsa_solicitud
              ON gsa_solicitud_fumigacion.id_solicitud=gsa_solicitud.id_gsa_solicitud
              LEFT JOIN gsa_orden
              ON gsa_solicitud.id_gsa_orden=gsa_orden.id_gsa_orden
              WHERE  $infop ";
              $select = mysql_query($query, $conexion);
              $row = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  if (isset($row['id_oficina_registro'])) {
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                  }
                  if (isset($row['id_punto_ubicacion'])) {
                    echo '<td>' . $row['nombre_punto_ubicacion'] . '</td>';
                  }
                  echo '<td> Region - ' . $row['region'] . '</td>';
                  echo '<td>' . $row['id_solicitud'] . '</td>';
                  $fecha = date_create($row['fecha_inicio']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  $fecha = date_create($row['fecha_final']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '<td>' . $row['nombre_gsa_solicitud_fumigacion'] . '</td>';
                  $fecha = date_create($row['fecha_programa']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '<td>' . $row['valor_servicio'] . '</td>';
                  $fecha = date_create($row['fecha_realiza']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '<td>' . $row['nombre_personal'] . '</td>';
                  $fecha = date_create($row['actualiza']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y H:i:s") . '</td>';
                  echo '</tr>';
                } while ($row = mysql_fetch_assoc($select));
                mysql_free_result($select);
              }
              ?>
              <script>
                $(document).ready(function() {
                  $('#tablefumigacion').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        text: 'Pdf',
                        title: "FUMIGACION",
                        customize: function(doc) {
                          doc.styles.title = {
                            color: 'gray',
                            fontSize: '14',
                            alignment: 'center'
                          }
                        }
                      },
                      {
                        extend: 'excel',
                        text: 'Excel',
                        title: "FUMIGACION",
                        exportOptions: {
                          modifier: {
                            page: 'current'
                          }
                        }
                      }
                    ],
                    "lengthMenu": [
                      [50, 100, 200, 300, 500],
                      [50, 100, 200, 300, 500]
                    ],
                    "language": {
                      "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                    },
                    "aaSorting": [
                      [0, "asc"]
                    ]
                  });
                });
              </script>
            </tbody>
          </table>

        </div>
      <?php } ?>

      <?php if (0 < $nump85 OR 0 < $nump86 OR 0 < $nump99 OR 1 == $_SESSION['rol']) { ?>
        <div <?php echo $tabpe; ?> id="personal">
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <form class="navbar-form" name="personal12" method="post" action="">
                <div class="input-group">
                  <div class="input-group-btn">Buscar
                    <select class="form-control" name="campo" required>
                      <option value="" selected> - - Buscar por: - - </option>
                      <option value="oficina_registro.nombre_oficina_registro">Nombre Oficina Registro</option>
                      <option value="punto_ubicacion.nombre_punto_ubicacion">Nombre Punto Ubicacion</option>
                      <option value="gsa_solicitud_personal.id_solicitud">Numero Solicitud</option>
                      <option value="ano">Año</option>
                      <option value="region">Region Secop</option </select>
                  </div><!-- /btn-group -->
                  <div class="input-group-btn">
                    <input type="text" name="buscarPersonal" placeholder="" class="form-control" required>
                  </div>
                  <!-- /input-group -->
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <style>
            .dataTables_filter {
              display: none;
            }
          </style>
          <table class="table table-striped table-bordered table-hover" id="tablepersonal" cellspacing="0" width="100%">
            <thead>
              <tr align="center" valign="middle">
                <th>Oficina o Ubicacion</th>
                <th>Region Secop</th>
                <th>Id Solicitud</th>
                <th>Periodo Inicio</th>
                <th>Periodo Final</th>
                <th>Tipo</th>
                <th>Nombre Personal</th>
                <th>Dias Trabajados</th>
                <th>Valor Personal</th>
                <th title="Fecha del registro">Fecha</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['buscarPersonal']) && "" != $_POST['buscarPersonal']) {
                if ('ano' === $_POST['campo']) {
                  $infobus = "YEAR(gsa_solicitud.fecha_inicio) = " . $_POST['buscarPersonal'] . "";
                } else {
                  $infobus =  $_POST['campo'] . " like '%" . $_POST['buscarPersonal'] . "%' ";
                }
                $infop = $infobus;
              } else {
                $infop = ' gsa_solicitud_personal.estado_gsa_solicitud_personal=1';
              }

              $query = "SELECT 
              gsa_solicitud_personal.id_solicitud,
              gsa_solicitud_personal.nombre_gsa_solicitud_personal,
              gsa_solicitud_personal.id_oficina_registro,
              oficina_registro.nombre_oficina_registro,
              gsa_solicitud_personal.id_punto_ubicacion,
              punto_ubicacion.nombre_punto_ubicacion,
              gsa_solicitud_personal.nombre_personal,
              gsa_solicitud_personal.dias_trabajados,
              gsa_solicitud_personal.valor_personal,
              gsa_solicitud_personal.fecha,
              gsa_solicitud.fecha_inicio,
              gsa_solicitud.fecha_final,
              gsa_orden.region
              FROM gsa_solicitud_personal
              LEFT JOIN oficina_registro
              ON gsa_solicitud_personal.id_oficina_registro=oficina_registro.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON gsa_solicitud_personal.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
              LEFT JOIN gsa_solicitud
              ON gsa_solicitud_personal.id_solicitud=gsa_solicitud.id_gsa_solicitud
              LEFT JOIN gsa_orden
              ON gsa_solicitud.id_gsa_orden=gsa_orden.id_gsa_orden
              WHERE  $infop ";
              $select = mysql_query($query, $conexion);
              $row = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  if (isset($row['id_oficina_registro'])) {
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                  }
                  if (isset($row['id_punto_ubicacion'])) {
                    echo '<td>' . $row['nombre_punto_ubicacion'] . '</td>';
                  }
                  echo '<td> Region - ' . $row['region'] . '</td>';
                  echo '<td>' . $row['id_solicitud'] . '</td>';
                  $fecha = date_create($row['fecha_inicio']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  $fecha = date_create($row['fecha_final']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '<td>' . $row['nombre_gsa_solicitud_personal'] . '</td>';
                  echo '<td>' . $row['nombre_personal'] . '</td>';
                  echo '<td>' . $row['dias_trabajados'] . '</td>';
                  echo '<td>' . $row['valor_personal'] . '</td>';
                  $fecha = date_create($row['fecha']);
                  echo '<td>' . $fechaC = date_format($fecha, "d/m/Y") . '</td>';
                  echo '</tr>';
                } while ($row = mysql_fetch_assoc($select));
                mysql_free_result($select);
              }
              ?>
              <script>
                $(document).ready(function() {
                  $('#tablepersonal').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        text: 'Pdf',
                        title: "PERSONAL",
                        customize: function(doc) {
                          doc.styles.title = {
                            color: 'gray',
                            fontSize: '14',
                            alignment: 'center'
                          }
                        }
                      },
                      {
                        extend: 'excel',
                        text: 'Excel',
                        title: "PERSONAL",
                        exportOptions: {
                          modifier: {
                            page: 'current'
                          }
                        }
                      }
                    ],
                    "lengthMenu": [
                      [50, 100, 200, 300, 500],
                      [50, 100, 200, 300, 500]
                    ],
                    "language": {
                      "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                    },
                    "aaSorting": [
                      [0, "asc"]
                    ]
                  });
                });
              </script>
            </tbody>
          </table>

        </div>
      <?php } ?>

    </div>
  </div>

<?php } ?>
<!-- FINAL DE SEGURIDAD -->


<!-- MODAL DE NUEVO PROVEEDOR -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="float:left" id="exampleModalLabel"><b>Nuevo Proveedor</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="POST" name="formularioProveedor">
        <div class="modal-body">
          <label>Nombre del Proveedor</label>
          <input type="text" class="form-control" name="nombre_gsa_proveedor" required>
          <label>Nit</label>
          <div class="row">
            <div class="col-md-10">
              <input type="number" class="form-control" id="numero" name="nit_proveedor" required>
            </div>
            <div class="col-md-2">
              <select name="digito_verificacion" class="form-control" required>
                <?php for ($i = 0; $i < 10; $i++) {
                  echo "<option value=" . $i . ">" . $i . "</option>";
                } ?>
              </select>
            </div>
          </div>
          <label>Representante Legal</label>
          <input type="text" class="form-control" name="representante_legal" required>
          <label>Cedula Representante</label>
          <input type="number" class="form-control" name="cedula_representante" required>
          <label>Nombre Contacto</label>
          <input type="text" class="form-control" name="nombre_contacto_1">

          <label>Numero Contacto</label>
          <input type="text" class="form-control" name="telefono_contacto_1" required>
          <label>Email Contacto</label>
          <input type="email" class="form-control" name="correo_contacto_1" required>
          <label>Nombre Contacto Opcional</label>
          <input type="text" class="form-control" name="nombre_contacto_2">
          <label>Numero Contacto Opcional</label>
          <input type="text" class="form-control" name="telefono_contacto_2">
          <label>Email Contacto Opcional</label>
          <input type="email" class="form-control" name="correo_contacto_2">
          <label>Direccion</label>
          <input type="text" class="form-control" name="direccion" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
          <input class="btn btn-success" type="submit" name="nuevoproveedor" value="Guardar">
        </div>
      </form>

    </div>
  </div>
</div>


<!-- MODAL DE EDITAR PROVEEDOR -->
<div class="modal fade" id="editar_proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="float:left" id="exampleModalLabel"><b>Nuevo Producto</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" name="actualizarProveedor">
        <div id="divEditarProveedor">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL NUEVA ORDEN -->
<div class="modal fade" id="orderCompra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="float:left" id="exampleModalLabel"><b>Nueva Orden de Compra</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="POST" name="formularioOrdenCompra">

        <div class="modal-body">
          <label>Nombre Proveedor</label>
          <select class="form-control" name="id_gsa_proveedor" required>
            <option value="" selected></option>
            <?php echo listapordefecto("gsa_proveedor", 500, "id_gsa_proveedor") ?>
          </select>
          <label>Región</label>
          <select name="region" class="form-control" required>
            <option value=""> </option>
            <?php
            for ($i = 1; $i < 19; $i++) {
              echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
          </select>
          <label>Numero de Orden</label>
          <input type="number" class="form-control" name="numero_orden" required>
          <label>Porcentaje AIU</label>
          <select name="porcentaje_aiu" class="form-control" required>
            <option value="" selected></option>
            <?php
            for ($i = 1; $i < 11; $i++) {
              echo '<option value="0.0' . $i . '">' . $i . ' %</option>';
            }
            ?>
          </select>
          <label>Fecha Inicio</label>
          <input type="date" class="form-control" name="fecha_inicio" required>
          <label>Fecha Final</label>
          <input type="date" class="form-control" name="fecha_final" required>
          <label>Funcionario a Cargo</label>
          <select class="form-control" name="id_funcionario" required>
            <option value="" selected></option>
            <?php
            $query20 = sprintf("SELECT * FROM funcionario_perfil LEFT JOIN funcionario ON funcionario_perfil.id_funcionario=funcionario.id_funcionario WHERE funcionario_perfil.id_perfil=85 AND funcionario_perfil.estado_funcionario_perfil=1");
            $result20 = $mysqli->query($query20);
            while ($row20 = $result20->fetch_array(MYSQLI_ASSOC)) {
              echo '<option value="' . $row20['id_funcionario'] . '">' . $row20['nombre_funcionario'] . '</option>';
            }
            ?>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
          <input type="submit" class="btn btn-success" name="guardarOrden" value="Guardar" />
        </div>

      </form>

    </div>
  </div>
</div>
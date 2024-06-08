<?php
$nump85 = privilegios(85, $_SESSION['snr']);  // COORDINADOR ASEO Y CAFETERIA
$nump86 = privilegios(86, $_SESSION['snr']);  // ADMINISTRADOR ASEO Y CAFETERIA
$idOrden = $_GET['i'];

// ACTUALIZAR PRODUCTO
if (
  isset($_POST["actualizarproducto"]) && '' != $_POST["actualizarproducto"] &&
  isset($_POST["id_gsa_producto"]) && '' != $_POST["id_gsa_producto"] &&
  isset($_POST["numero_producto"]) && '' != $_POST["numero_producto"] &&
  isset($_POST["bien_producto"]) && '' != $_POST["bien_producto"] &&
  isset($_POST["especificacion_producto"]) && '' != $_POST["especificacion_producto"] &&
  isset($_POST["presentacion_producto"]) && '' != $_POST["presentacion_producto"] &&
  isset($_POST["cantidad_mensual"]) && '' != $_POST["cantidad_mensual"] &&
  isset($_POST["precio_unitario"]) && '' != $_POST["precio_unitario"]
) {
  $actualizarProducto = sprintf(
    "UPDATE gsa_producto SET 
    numero_producto=%s,
    bien_producto=%s, 
    especificacion_producto=%s,
    presentacion_producto=%s,
    cantidad_mensual=%s,
    precio_unitario=%s
    WHERE id_gsa_producto=%s",
    GetSQLValueString($_POST["numero_producto"], "int"),
    GetSQLValueString($_POST["bien_producto"], "text"),
    GetSQLValueString($_POST["especificacion_producto"], "text"),
    GetSQLValueString($_POST["presentacion_producto"], "text"),
    GetSQLValueString($_POST["cantidad_mensual"], "int"),
    GetSQLValueString($_POST["precio_unitario"], "text"),
    GetSQLValueString($_POST["id_gsa_producto"], "int")
  );
  $result = mysql_query($actualizarProducto, $conexion);
  mysql_free_result($result);
}

// ACTUALIZAR ARTICULO
if (
  isset($_POST["actualizarArticulo"]) && '' != $_POST["actualizarArticulo"] &&
  isset($_POST["id_gsa_orden_articulo"]) && '' != $_POST["id_gsa_orden_articulo"] &&
  isset($_POST["nombre_gsa_orden_articulo"]) && '' != $_POST["nombre_gsa_orden_articulo"] &&
  isset($_POST["cantidad"]) && '' != $_POST["cantidad"] &&
  isset($_POST["unidad"]) && '' != $_POST["unidad"] &&
  isset($_POST["precio"]) && '' != $_POST["precio"]
) {
  $actualizarArticulo = sprintf(
    "UPDATE gsa_orden_articulo SET 
    nombre_gsa_orden_articulo=%s,
    cantidad=%s, 
    unidad=%s,
    precio=%s
    WHERE id_gsa_orden_articulo=%s",
    GetSQLValueString($_POST["nombre_gsa_orden_articulo"], "text"),
    GetSQLValueString($_POST["cantidad"], "text"),
    GetSQLValueString($_POST["unidad"], "text"),
    GetSQLValueString($_POST["precio"], "text"),
    GetSQLValueString($_POST["id_gsa_orden_articulo"], "int")
  );
  $result = mysql_query($actualizarArticulo, $conexion);
  mysql_free_result($result);
}

// ACTUALIZAR MAQUINARIA
if (
  isset($_POST["actualizarmaquinaria"]) && '' != $_POST["actualizarmaquinaria"] &&
  isset($_POST["id_gsa_maquinaria"]) && '' != $_POST["id_gsa_maquinaria"] &&
  isset($_POST["numero_maquinaria"]) && '' != $_POST["numero_maquinaria"] &&
  isset($_POST["bien_maquinaria"]) && '' != $_POST["bien_maquinaria"] &&
  isset($_POST["especificacion_maquinaria"]) && '' != $_POST["especificacion_maquinaria"] &&
  isset($_POST["presentacion_maquinaria"]) && '' != $_POST["presentacion_maquinaria"] &&
  isset($_POST["cantidad_mensual"]) && '' != $_POST["cantidad_mensual"] &&
  isset($_POST["precio_unitario"]) && '' != $_POST["precio_unitario"]
) {
  $actualizarMaquinaria = sprintf(
    "UPDATE gsa_maquinaria SET 
    numero_maquinaria=%s,
    bien_maquinaria=%s, 
    especificacion_maquinaria=%s,
    presentacion_maquinaria=%s,
    cantidad_mensual=%s,
    precio_unitario=%s
    WHERE id_gsa_maquinaria=%s",
    GetSQLValueString($_POST["numero_maquinaria"], "int"),
    GetSQLValueString($_POST["bien_maquinaria"], "text"),
    GetSQLValueString($_POST["especificacion_maquinaria"], "text"),
    GetSQLValueString($_POST["presentacion_maquinaria"], "text"),
    GetSQLValueString($_POST["cantidad_mensual"], "int"),
    GetSQLValueString($_POST["precio_unitario"], "text"),
    GetSQLValueString($_POST["id_gsa_maquinaria"], "int")
  );
  $resultMaqui = mysql_query($actualizarMaquinaria, $conexion);
  mysql_free_result($resultMaqui);
}

// ACTUALIZAR DATOS DE LA ORDEN DE COMPRA
if (
  isset($_POST["editaDetalleOrden"]) && '' != $_POST["editaDetalleOrden"] &&
  isset($_POST["id_gsa_proveedor"]) && '' != $_POST["id_gsa_proveedor"] &&
  isset($_POST["numero_orden"]) && '' != $_POST["numero_orden"] &&
  isset($_POST["porcentaje_aiu"]) && '' != $_POST["porcentaje_aiu"] &&
  isset($_POST["fecha_inicio"]) && '' != $_POST["fecha_inicio"] &&
  isset($_POST["fecha_final"]) && '' != $_POST["fecha_final"]
) {
  $actualiza = sprintf(
    "UPDATE gsa_orden SET 
    id_funcionario=%s,
    id_gsa_proveedor=%s,
    numero_orden=%s,
    region=%s,

    porcentaje_aiu=%s,
    fecha_inicio=%s,
    fecha_final=%s   WHERE id_gsa_orden=$idOrden ",
    GetSQLValueString($_POST["id_funcionario"], "int"),
    GetSQLValueString($_POST["id_gsa_proveedor"], "int"),
    GetSQLValueString($_POST["numero_orden"], "int"),
    GetSQLValueString($_POST["region"], "int"),

    GetSQLValueString($_POST["porcentaje_aiu"], "text"),
    GetSQLValueString($_POST["fecha_inicio"], "date"),
    GetSQLValueString($_POST["fecha_final"], "date")
  );
  $result = mysql_query($actualiza, $conexion);
  echo $insertado;
  mysql_free_result($result);
  echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';
}

// NUEVO ARTICULO EN ORDEN DE COMPRA
if (
  isset($_POST["nuevoarticulo"]) && '' != $_POST["nuevoarticulo"] &&
  isset($_POST["nombre_gsa_orden_articulo"]) && '' != $_POST["nombre_gsa_orden_articulo"] &&
  isset($_POST["cantidad"]) && '' != $_POST["cantidad"] &&
  isset($_POST["unidad"]) && '' != $_POST["unidad"] &&
  isset($_POST["precio"]) && '' != $_POST["precio"]
) {
  $nombreArticulo = $_POST["nombre_gsa_orden_articulo"];
  $precioArticulo = $_POST["precio"];
  if ($precioArticulo == 0) {
    $articulo = 0;
    echo $articulo;
  } else {
    $querySede = "SELECT COUNT(nombre_gsa_orden_articulo) AS articulo FROM gsa_orden_articulo WHERE id_gsa_orden=$idOrden AND precio=$precioArticulo AND estado_gsa_orden_articulo=1";
    $selectSede = mysql_query($querySede, $conexion);
    $rowSede = mysql_fetch_assoc($selectSede);
    echo $articulo = $rowSede['articulo'];
  }
  if (0 < $articulo) {
    echo $repetido;
    mysql_free_result($result);
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';
  } else {
    $insertar = sprintf(
      "INSERT INTO gsa_orden_articulo (
      id_gsa_orden,
      nombre_gsa_orden_articulo, 
      cantidad,
      unidad,
      precio) VALUES (%s,%s,%s,%s,%s)",
      GetSQLValueString($idOrden, "int"),
      GetSQLValueString($nombreArticulo, "text"),
      GetSQLValueString($_POST["cantidad"], "text"),
      GetSQLValueString($_POST["unidad"], "text"),
      GetSQLValueString($precioArticulo, "text")
    );
    $result = mysql_query($insertar, $conexion);
    echo $insertado;
    mysql_free_result($result);
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';
  }
}

// INSERTAR NUEVAS SEDES A LA ORDEN DE COMPRA
if (
  isset($_POST["guardarsede"]) && '' != $_POST["guardarsede"] &&
  isset($_POST["id_oficina_registro"]) && '' != $_POST["id_oficina_registro"]
) {
  $idOficina = $_POST["id_oficina_registro"];

  $querySede = "SELECT COUNT(id_oficina_registro) AS oficina FROM gsa_sedes WHERE id_gsa_orden=$idOrden AND id_oficina_registro=$idOficina AND estado_gsa_sedes=1";
  $selectSede = mysql_query($querySede, $conexion);
  $rowSede = mysql_fetch_assoc($selectSede);

  $queryMax = "SELECT MAX(num_sede) AS MACX FROM gsa_sedes WHERE id_gsa_orden=$idOrden AND estado_gsa_sedes=1";
  $selectMax = mysql_query($queryMax, $conexion);
  $rowMax = mysql_fetch_assoc($selectMax);
  if (NULL == $rowMax['MACX']) {
    $numSede = 1;
  } else {
    $numSede = $rowMax['MACX'] + 1;
  }

  if (0 < $rowSede['oficina']) {
  } else {
    $insertar = sprintf(
      "INSERT INTO gsa_sedes (
      nombre_gsa_sedes, 
      id_oficina_registro,
      id_gsa_orden,
      num_sede) VALUES (%s,%s,%s,%s)",
      GetSQLValueString('Detalle Orden', "text"),
      GetSQLValueString($_POST["id_oficina_registro"], "int"),
      GetSQLValueString($idOrden, "int"),
      GetSQLValueString($numSede, "int")
    );
    $result = mysql_query($insertar, $conexion);
    mysql_free_result($result);
  }
}

// INSERTAR NUEVOS PUNTOS DE UBICACION A LA ORDEN
if (
  isset($_POST["GuardaPuntoUbicacion"]) && '' != $_POST["GuardaPuntoUbicacion"] &&
  isset($_POST["id_punto_ubicacion"]) && '' != $_POST["id_punto_ubicacion"]
) {
  $idPuntoUbicacion = $_POST["id_punto_ubicacion"];

  $querySede = "SELECT COUNT(id_punto_ubicacion) AS ubicacion FROM gsa_sedes WHERE id_gsa_orden=$idOrden AND id_punto_ubicacion=$idPuntoUbicacion";
  $selectSede = mysql_query($querySede, $conexion);
  $rowSede = mysql_fetch_assoc($selectSede);

  $queryMax = "SELECT MAX(num_sede) AS MACX FROM gsa_sedes WHERE id_gsa_orden=$idOrden AND estado_gsa_sedes=1";
  $selectMax = mysql_query($queryMax, $conexion);
  $rowMax = mysql_fetch_assoc($selectMax);
  if (NULL == $rowMax['MACX']) {
    $numSede = 1;
  } else {
    $numSede = $rowMax['MACX'] + 1;
  }

  if (0 < $rowSede['ubicacion']) {
  } else {
    $insertar = sprintf(
      "INSERT INTO gsa_sedes (
    nombre_gsa_sedes, 
    id_punto_ubicacion,
    id_gsa_orden,
    num_sede) VALUES (%s,%s,%s,%s)",
      GetSQLValueString('Detalle Orden', "text"),
      GetSQLValueString($_POST["id_punto_ubicacion"], "int"),
      GetSQLValueString($idOrden, "int"),
      GetSQLValueString($numSede, "int")
    );
    $result = mysql_query($insertar, $conexion);
    mysql_free_result($result);
  }
}

// CARGAR ARCHIVO CVS MASIVO INSUMOS
if (
  isset($_POST["masivoInsumo"]) && '' != $_POST["masivoInsumo"]
) {
  //Aquí es donde seleccionamos nuestro csv
  $fname = $_FILES['sel_file']['name'];
  //echo 'Cargando nombre del archivo: '.$fname.' <br>';
  $chk_ext = explode(".", $fname);

  if (strtolower(end($chk_ext)) == "csv") {
    //si es correcto, entonces damos permisos de lectura para subir
    $filename = $_FILES['sel_file']['tmp_name'];
    $handle = fopen($filename, "r");

    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

      $NumProducto = intval($data[0]);
      $BienProducto = utf8_encode($data[1]);
      $ExpecificacionProducto = utf8_encode($data[2]);
      $PresentacionProducto = utf8_encode($data[3]);
      $CantidadMensual = intval($data[4]);
      $PrecioUnitario = $data[5];

      $InsertP = mysql_query("SELECT count(numero_producto) as totNUmPro FROM gsa_producto WHERE 
      id_gsa_orden=" . $idOrden . " AND
      numero_producto=" . $NumProducto . " AND
      precio_unitario= " . $PrecioUnitario . "", $conexion);
      $row15u = mysql_fetch_assoc($InsertP);
      $totNUmPro = $row15u['totNUmPro'];
      if (0 < $totNUmPro) {
        echo '<div class="alert alert-danger alert-dismissible"> Repetido Cod Secop: ' . $NumProducto . '</div>';
      } else {

        if (0 < $NumProducto and (0 < $idOrden or is_null($idOrden))) {
          $unitario = explode(",", $PrecioUnitario);
          if (isset($unitario[1])) {
            $total = $unitario[0] . '.' . $unitario[1];
          } else {
            $total = $unitario[0];
          }
          $estadoProducto = 1;
          $insertSQL = sprintf(
            "INSERT INTO gsa_producto (
          nombre_gsa_producto,
          id_gsa_elemento,
          id_gsa_orden,         
          numero_producto,
          bien_producto,

          especificacion_producto,
          presentacion_producto,
          cantidad_mensual,
          precio_unitario,
          producto_estado, -- Control para conocer si un producto esta activo o inactivo pero se nesecita mostrarlo en la tabla.
          estado_gsa_producto) VALUES (%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s)",
            GetSQLValueString('INSUMO', "text"),
            GetSQLValueString(1, "int"),
            GetSQLValueString($idOrden, "int"),
            GetSQLValueString($NumProducto, "int"),
            GetSQLValueString($BienProducto, "text"),

            GetSQLValueString($ExpecificacionProducto, "text"),
            GetSQLValueString($PresentacionProducto, "text"),
            GetSQLValueString($CantidadMensual, "int"),
            GetSQLValueString($total, "double"),
            GetSQLValueString($estadoProducto, "int"),
            GetSQLValueString($estadoProducto, "int")
          );
          $Result = mysql_query($insertSQL, $conexion);
        }
      }
    }
    //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
    fclose($handle);
    echo $masivocargado;
    echo '<meta http-equiv="refresh" content="0;URL=./gsa_general_detalle&' . $idOrden . '.jsp" />';
  } else {
    //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
    //ver si esta separado por " , "
    echo $doc_no_tipo;
  }
}

// CARGAR ARCHIVO CVS MASIVO MAQUINARIA
if (
  isset($_POST["masivoMaquinaria"]) && '' != $_POST["masivoMaquinaria"]
) {
  //Aquí es donde seleccionamos nuestro csv
  $fname = $_FILES['sel_file']['name'];
  //echo 'Cargando nombre del archivo: '.$fname.' <br>';
  $chk_ext = explode(".", $fname);

  if (strtolower(end($chk_ext)) == "csv") {
    //si es correcto, entonces damos permisos de lectura para subir
    $filename = $_FILES['sel_file']['tmp_name'];
    $handle = fopen($filename, "r");

    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

      $NumMaquinaria = intval($data[0]);
      $BienMaquinaria = utf8_encode($data[1]);
      $ExpecificacionMaquinaria = utf8_encode($data[2]);
      $PresentacionMaquinaria = utf8_encode($data[3]);
      $CantidadMensualM = intval($data[4]);
      $PrecioUnitarioM = $data[5];

      $unitario = explode(",", $PrecioUnitarioM);
      if (isset($unitario[1])) {
        $total = $unitario[0] . '.' . $unitario[1];
      } else {
        $total = $unitario[0];
      }

      $InsertM = mysql_query("SELECT count(numero_maquinaria) as totNUmPro FROM gsa_maquinaria WHERE 
      id_gsa_orden=" . $idOrden . " AND
      numero_maquinaria=" . $NumMaquinaria . " AND
      precio_unitario= " . $PrecioUnitarioM . "", $conexion);
      $row15u = mysql_fetch_assoc($InsertM);
      $totNUmPro = $row15u['totNUmPro'];
      if (0 < $totNUmPro) {
        echo '<div class="alert alert-danger alert-dismissible"> COD SECOP REPETIDO: ' . $NumMaquinaria . '</div>';
      } else {

        if (0 < $NumMaquinaria and (0 < $idOrden or is_null($idOrden))) {
          $estadoMaquinaria = 1;
          $insertSQLM = sprintf(
            "INSERT INTO gsa_maquinaria (
            nombre_gsa_maquinaria,
            id_gsa_elemento,
            id_gsa_orden,         
            numero_maquinaria,
            bien_maquinaria,

            especificacion_maquinaria,
            presentacion_maquinaria,
            cantidad_mensual,
            precio_unitario,
            maquinaria_estado, -- Control para conocer si un maquinaria esta activo o inactivo pero se nesecita mostrarlo en la tabla.
            estado_gsa_maquinaria) VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s)",
            GetSQLValueString('MAQUINARIA', "text"),
            GetSQLValueString(2, "int"),
            GetSQLValueString($idOrden, "int"),
            GetSQLValueString($NumMaquinaria, "int"),
            GetSQLValueString($BienMaquinaria, "text"),

            GetSQLValueString($ExpecificacionMaquinaria, "text"),
            GetSQLValueString($PresentacionMaquinaria, "text"),
            GetSQLValueString($CantidadMensualM, "int"),
            GetSQLValueString($total, "double"),
            GetSQLValueString($estadoMaquinaria, "int"),
            GetSQLValueString($estadoMaquinaria, "int")
          );
          $Result = mysql_query($insertSQLM, $conexion);
        }
      }
    }
    //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
    fclose($handle);
    echo $masivocargado;
    echo '<meta http-equiv="refresh" content="0;URL=./gsa_general_detalle&' . $idOrden . '.jsp" />';
  } else {
    //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
    //ver si esta separado por " , "
    echo $doc_no_tipo;
  }
}


$query = "SELECT 
id_gsa_orden,
gsa_proveedor.nombre_gsa_proveedor,
gsa_orden.region,
gsa_orden.numero_orden,
gsa_proveedor.id_gsa_proveedor,
porcentaje_aiu,
fecha_inicio,
fecha_final,
gsa_orden.fecha,
funcionario.id_funcionario,
funcionario.nombre_funcionario
FROM gsa_orden
LEFT JOIN gsa_proveedor
ON gsa_orden.id_gsa_proveedor=gsa_proveedor.id_gsa_proveedor
LEFT JOIN funcionario
ON gsa_orden.id_funcionario=funcionario.id_funcionario
WHERE id_gsa_orden=$idOrden AND estado_gsa_orden=1 AND estado_gsa_proveedor=1 order by id_gsa_orden DESC";
$selectotal = mysql_query($query, $conexion);
$rows = mysql_fetch_assoc($selectotal);
?>


<script>
  // Funcion para no duplicar envios de formularios
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

  function cambiosedes(tabla, var2, var3) {
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

  function eliminarProducto(tabla, var2) {
    jQuery.ajax({
      type: "POST",
      url: "pages/gsa_actualizar.php",
      data: 'option=' + tabla + '-' + var2,
      async: true,
      success: function(html) {
        location.reload();
      }
    })
  }

  function eliminarMaquinaria(tabla, var2) {
    jQuery.ajax({
      type: "POST",
      url: "pages/gsa_actualizar.php",
      data: 'option=' + tabla + '-' + var2,
      async: true,
      success: function(html) {
        location.reload();
      }
    })
  }

  function serviciojardineria(tabla, var2, var3) {
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

  function serviciofumigacion(tabla, var2, var3) {
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

  function cambiocantidadpersonal(tabla, var2, var3) {
    jQuery.ajax({
      type: "POST",
      url: "pages/gsa_actualizar.php",
      data: 'option=' + tabla + '-' + var3 + '-' + var2,
      async: true,
      success: function(html) {

      }
    })
  }

  function serviciopersonal(tabla, var2, var3) {
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

  function cambioproducto(tabla, var2, var3) {
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

  function cambiomaquinaria(tabla, var2, var3) {
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
    $('.editarPro').click(function() {
      var var2 = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + 'editamosProducto' + '-' + var2,
        async: true,
        success: function(b) {
          jQuery('#divEditarProducto').html(b);
        }
      })
    });
  })

  $(function() {
    $('.editarArticulo').click(function() {
      var var2 = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + 'editamosArticulo' + '-' + var2,
        async: true,
        success: function(b) {
          jQuery('#divEditarArticulo').html(b);
        }
      })
    });
  })

  $(function() {
    $('.editarMaquinaria').click(function() {
      var var2 = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + 'editamosMaquinaria' + '-' + var2,
        async: true,
        success: function(b) {
          jQuery('#divEditarMaquinaria').html(b);
        }
      })
    });
  })

  $(function() {
    $('.gsamoneda').keyup(function() {
      // skip for arrow keys
      if (event.which >= 37 && event.which <= 40) {
        event.preventDefault();
      }

      $(this).val(function(index, value) {
        return value
          .replace(/\D/g, "")
          .replace(/([0-9])([0-9]{2})$/, '$1.$2');
      });
    });
  })

  function borrarArticulo(tabla, var2, var3) {
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
</script>

<div class="nav-tabs-custom" style="padding: 3%;">
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-xs btn-default" href="gsa_general&orden.jsp"><i class="fa fa-fw fa-mail-reply"></i> Regresar </a><br><br>
      <div class="row">
        <div class="col-md-6">
          <h4><b>Detalle Orden de Compra</b></h4>
        </div>
        <div class="col-md-6">
          <?php if (0 < $nump86 or 1 == $_SESSION['rol']) { ?>
            <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editar-orden">Editar</button>
          <?php } ?>
        </div>
      </div>

      <table class="table">
        <tbody>
          <tr>
            <td>Nombre del Proveedor</td>
            <td><?php echo $rows['nombre_gsa_proveedor'];  ?></td>
          </tr>
          <tr>
            <td>Región</td>
            <td><?php echo $rows['region'];  ?></td>
          </tr>
          <tr>
            <td>Numero Orden</td>
            <td><?php echo $rows['numero_orden'];  ?></td>
          </tr>
          <tr>
            <td>Porcentaje AIU</td>
            <td><?php
                echo $rows['porcentaje_aiu'];
                $porcetajeAIU = $rows['porcentaje_aiu'];
                ?> %</td>
          </tr>
          <tr>
            <td>Fecha Inicio</td>
            <td><?php echo $rows['fecha_inicio'];  ?></td>
          </tr>
          <tr>
            <td>Fecha Final</td>
            <td><?php echo $rows['fecha_final'];  ?></td>
          </tr>
          <tr>
            <td>Funcionario a Cargo</td>
            <td><?php echo $rows['nombre_funcionario'];  ?></td>
          </tr>
        </tbody>
      </table><br>

      <div class="row">
        <div class="col-md-6">
          <h4><b>Articulos Orden de Compra</b></h4>
        </div>
        <div class="col-md-6">
          <?php if (0 < $nump86 or 1 == $_SESSION['rol']) { ?>
            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#nuevo-articulo">Nuevo</button>
          <?php } ?>
        </div>
      </div>
      <table class="table table-striped table-bordered table-hover" id="tablearticulos" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Articulo</th>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Total</th>

            <th>Precio U.</th>
            <th>AIU U.</th>
            <th>IVA U.</th>
            <th>Total U.</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $SumatoriaPrecio = 0;
          $query = "SELECT 
          gsa_orden_articulo.id_gsa_orden_articulo,
          gsa_orden_articulo.nombre_gsa_orden_articulo,
          gsa_orden_articulo.cantidad,
          gsa_orden_articulo.unidad,
          gsa_orden_articulo.precio
          FROM gsa_orden_articulo
          WHERE estado_gsa_orden_articulo=1 AND gsa_orden_articulo.id_gsa_orden=$idOrden ORDER BY id_gsa_orden_articulo DESC";
          $selectarti = mysql_query($query, $conexion);
          $rowarti = mysql_fetch_assoc($selectarti);
          $totalRows = mysql_num_rows($selectarti);
          if (0 < $totalRows) {
            do {
              $diezporciento = $rowarti['precio'] * 10 / 100;
              echo '<tr>
                    <td>' . $rowarti['nombre_gsa_orden_articulo'] . '</td>
                    <td>' . $rowarti['cantidad'] . '</td>
                    <td>' . $rowarti['unidad'] . '</td>
                    <td>' . number_format($rowarti['precio'] * $rowarti['cantidad'], 2, '.', ',') . '</td>

                    <td>' . number_format($rowarti['precio'], 2, '.', ',') . '</td>
                    <td>' . number_format($rowarti['precio'] * $porcetajeAIU, 2, '.', ',') . '</td>
                    <td>' . number_format($diezporciento * 19 / 100, 2, '.', ',') . ' </td>
                    <td>' . number_format($diezporciento * 19 / 100 + $rowarti['precio'] * $porcetajeAIU + $rowarti['precio'], 2, '.', ',') . '</td>
                    <td>';
              if (1 == $_SESSION['rol'] or 0 < $nump86) {
          ?>
                <a class="editarArticulo btn btn-xs btn-warning" title="Editar Articulo" id="<?php echo $rowarti['id_gsa_orden_articulo']; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#editar_articulo"><i class="glyphicon glyphicon-pencil"></i></a>

                <button class="btn btn-xs btn-danger" onclick="borrarArticulo('borrararticulo', <?php echo $rowarti['id_gsa_orden_articulo']; ?>, 0);" title="Borrar"><i class="fa fa-fw fa-trash"></i></button>
          <?php
              }
              echo '</td>
                  </tr>';
              $SumatoriaPrecio += $rowarti['cantidad'] * $rowarti['precio'];
            } while ($rowarti = mysql_fetch_assoc($selectarti));
            mysql_free_result($selectarti);
          } ?>
        </tbody>
        <tfoot>
          <tr>
            <th>SubTotal</th>
            <td></td>
            <td></td>
            <th><?php echo number_format($SumatoriaPrecio, 2, '.', ','); ?></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>AIU</th>
            <td>1</td>
            <td>Unidad</td>
            <td><?php echo number_format($SumatoriaPrecio * $porcetajeAIU, 2, '.', ',') ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>IVA</th>
            <td>1</td>
            <td>Unidad</td>
            <td><?php $diezporciento = $SumatoriaPrecio * 10 / 100;
                echo number_format($diezporciento * 19 / 100, 2, '.', ',') ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>TOTAL</th>
            <td></td>
            <td></td>
            <th> <?php echo number_format($SumatoriaPrecio + $SumatoriaPrecio * $porcetajeAIU + $diezporciento * 19 / 100, 2, '.', ','); ?></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tfoot>
        <script>
          $(document).ready(function() {
            $('#tablearticulos').DataTable({
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
      </table><br><br>

      <!-- SEDES -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h5 class="box-title"><b>Listado de Sedes</b></h5>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: none;">
          <?php if (0 < $nump86 or 1 == $_SESSION['rol']) { ?>
            <form method="POST" name="detalleSedes5">
              <div class="row" style="margin-bottom:5px;">
                <div class="col-md-4">
                  <label>Oficina Registro</label><br>
                  <select name="id_oficina_registro" class="form-control">
                    <?php echo lista("oficina_registro", 220) ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <label></label><br>
                  <input type="submit" class="btn btn-sm btn-success" name="guardarsede" value="Agregar" />
                </div>
              </div>
            </form>

            <form method="POST" name="puntosUbicacion">
              <div class="row" style="margin-bottom:80px;">
                <div class="col-md-4">
                  <label>Puntos Ubicación</label><br>
                  <select name="id_punto_ubicacion" class="form-control">
                    <?php echo lista("punto_ubicacion", 220) ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <label></label><br>
                  <input type="submit" class="btn btn-sm btn-success" name="GuardaPuntoUbicacion" value="Agregar" />
                </div>
              </div>
            </form>
          <?php } ?>
          <table class="table table-striped table-bordered table-hover" id="sedesorden" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th scope="col"><label># Sede</label></th>
                <th scope="col"><label>Ubicación</label></th>
                <th scope="col"><label>Región</label></th>
                <th scope="col"><label># Orden</label></th>
                <th scope="col"><label>Fecha</label></th>
                <th scope="col"><label>Estado</label></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT 
              gsa_sedes.id_oficina_registro,
              gsa_sedes.id_punto_ubicacion,
              gsa_sedes.id_gsa_sedes,
              gsa_sedes.num_sede,              
              oficina_registro.nombre_oficina_registro,
              punto_ubicacion.nombre_punto_ubicacion,
              region.nombre_region,
              gsa_orden.numero_orden,
              gsa_sedes.fecha,
              gsa_sedes.estado_gsa_sedes
              FROM gsa_sedes
              LEFT JOIN oficina_registro
              ON gsa_sedes.id_oficina_registro=oficina_registro.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON gsa_sedes.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
              LEFT JOIN region
              ON oficina_registro.id_region=region.id_region
              LEFT JOIN gsa_orden
              ON gsa_sedes.id_gsa_orden=gsa_orden.id_gsa_orden
              WHERE gsa_sedes.id_gsa_orden=$idOrden AND gsa_sedes.estado_gsa_sedes=1 ORDER BY num_sede ASC";
              $select = mysql_query($query, $conexion);
              $row = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  echo '<td>' . $row['num_sede'] . '</td>';
                  if (isset($row['id_oficina_registro'])) {
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                    echo '<td>' . $row['nombre_region'] . '</td>';
                  }
                  if (isset($row['id_punto_ubicacion'])) {
                    echo '<td>' . $row['nombre_punto_ubicacion'] . '</td>';
                    echo '<td></td>';
                  }
                  echo '<td> OC - ' . $row['numero_orden'] . '</a></td>';
                  echo '<td>' . $row['fecha'] . '</td>';
                  echo '<td>';
                  if (0 < $nump86 or 1 == $_SESSION['rol']) { ?>
                    <button class="btn btn-xs btn-danger" onclick="cambiosedes('sedes', <?php echo $row['id_gsa_sedes']; ?>, 0);"><i class="fa fa-fw fa-trash"></i></button>
              <?php }
                  echo '</td>';
                  echo '</tr>';
                } while ($row = mysql_fetch_assoc($select));
                mysql_free_result($select);
              }
              ?>
            </tbody>
            <script>
              $(document).ready(function() {
                $('#sedesorden').DataTable({
                  "lengthMenu": [
                    [6, 20, 50, 100, 200],
                    [6, 20, 50, 100, 200]
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
          </table>

        </div>
      </div>
      <!-- FIN SEDES -->

      <!-- PRODUCTOS -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h5 class="box-title"><b>Productos</b></h5>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: none;">
          <div class="row">
            <div class="col-md-6">
              <?php if (1 == $_SESSION['rol'] or 0 < $nump86) { ?>
                <form method='POST' enctype="multipart/form-data" name="masivoInsumo">
                  <label>Carga Archivo Plano Productos</label><br>
                  <input type='file' name='sel_file' size='20'>
                  <a href="documentos/ejemplo_cargue_productos.csv" download=>Descargar archivo Subir Productos.csv</a> &nbsp;
                  <input type='submit' name='masivoInsumo' value=' Agregar archivo ' class="btn btn-xs btn-success"><br>
                </form>
              <?php } ?>
            </div>
            <div class="col-md-6">
              <?php if (1 == $_SESSION['rol']) { ?>
                <button class="btn btn-xs btn-danger" title="Borrar" onclick="eliminarProducto('eliminarTodosProductos', <?php echo $idOrden; ?>, 0);"><i class="fa fa-trash"> Eliminar Todos los Productos</i></button>
              <?php } ?>
            </div>
          </div>
          <br><br>

          <table class="table table-striped table-bordered table-hover" id="tableproducto" cellspacing="0" width="100%">
            <thead>
              <tr align="center" valign="middle">
                <th>Cod</th>
                <th>Nombre</th>
                <th>Especificación</th>
                <th>Presentación</th>

                <th>Cantidad</th>
                <th>Precio Und</th>
                <th>Fecha Creado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $querypro = "SELECT 
              id_gsa_producto,
              numero_producto,
              bien_producto,
              especificacion_producto,
              presentacion_producto,
              cantidad_mensual,
              precio_unitario,
              fecha,
              producto_estado,
              estado_gsa_producto
              FROM gsa_producto 
              WHERE id_gsa_orden=$idOrden AND estado_gsa_producto=1";
              $selectpro = mysql_query($querypro, $conexion);
              $rowpro = mysql_fetch_assoc($selectpro);
              $totalRowspro = mysql_num_rows($selectpro);
              if (0 < $totalRowspro) {
                do {
                  echo '<tr>';
                  echo '<td>' . $rowpro['numero_producto'] . '</td>';
                  echo '<td>' . $rowpro['bien_producto'] . '</td>';
                  echo '<td>' . $rowpro['especificacion_producto'] . '</td>';
                  echo '<td>' . $rowpro['presentacion_producto'] . '</td>';

                  echo '<td>' . $rowpro['cantidad_mensual'] . '</td>';
                  echo '<td>' . $rowpro['precio_unitario'] . '</td>';
                  echo '<td>' . $rowpro['fecha'] . '</td>';
                  echo '<td>';
                  if (1 == $rowpro['producto_estado']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) { ?>
                      <button class="btn btn-xs btn-success" onclick="cambioproducto('producto', <?php echo $rowpro['id_gsa_producto']; ?>, 0);">Activo</button>
                    <?php
                    } else {
                      echo '<button class="btn btn-xs btn-success">Activo</button>';
                    }
                  }
                  if (0 == $rowpro['producto_estado'] and 1 == $_SESSION['rol']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) { ?>
                      <button class="btn btn-xs btn-danger" onclick="cambioproducto('producto', <?php echo $rowpro['id_gsa_producto']; ?>, 1);">Inactivo</button>
                    <?php
                    } else {
                      echo '<button class="btn btn-xs btn-danger">Inactivo</button>';
                    }
                  }
                  if (1 == $_SESSION['rol'] or 0 < $nump86) { ?>
                    <a class="editarPro btn btn-xs btn-warning" title="Editar" id="<?php echo $rowpro['id_gsa_producto']; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#editar_producto"><i class="glyphicon glyphicon-pencil"></i></a>
              <?php
                  }
                  echo '</td>';
                  echo '</tr>';
                } while ($rowpro = mysql_fetch_assoc($selectpro));
                mysql_free_result($selectpro);
              }
              ?>
              <script>
                $(document).ready(function() {
                  $('#tableproducto').DataTable({
                    "lengthMenu": [
                      [30, 50, 100, 200, 500],
                      [30, 50, 100, 200, 500]
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
      </div>
      <!-- FIN PRODUCTOS -->

      <!-- MAQUINARIA Y EQUIPOS -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h5 class="box-title"><b>Elementos, equipos y maquinaria</b></h5>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: none;">
          <div class="row">
            <div class="col-md-6">
              <?php if (1 == $_SESSION['rol'] or 0 < $nump86) { ?>
                <form method='POST' enctype="multipart/form-data" name="masivoMaquinaria">
                  <label>Carga Archivo Plano Elementos, equipos y maquinaria</label><br>
                  <input type='file' name='sel_file' size='20'>
                  <a href="documentos/ejemplo_cargue_maquinaria.csv" download=>Descargar archivo Subir Elementos, equipos y maquinaria.csv</a> &nbsp;
                  <input type='submit' name='masivoMaquinaria' value=' Agregar archivo ' class="btn btn-xs btn-success"><br>
                </form>
              <?php } ?>
            </div>
            <div class="col-md-6">
              <?php if (1 == $_SESSION['rol']) { ?>
                <button class="btn btn-xs btn-danger" title="Borrar" onclick="eliminarMaquinaria('eliminarTodoMaquinaria', <?php echo $idOrden; ?>);"><i class="fa fa-trash"> Eliminar Toda la Maquinaria</i></button>
              <?php } ?>
            </div>
          </div>
          <br><br>

          <table class="table table-striped table-bordered table-hover" id="tableMaquina" cellspacing="0" width="100%">
            <thead>
              <tr align="center" valign="middle">
                <th>Cod</th>
                <th>Nombre</th>
                <th>Especificación</th>
                <th>Presentación</th>

                <th>Cantidad</th>
                <th>Precio Und</th>
                <th>Fecha Creado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $querypro = "SELECT 
              id_gsa_maquinaria,
              numero_maquinaria,
              bien_maquinaria,
              especificacion_maquinaria,
              presentacion_maquinaria,
              cantidad_mensual,
              precio_unitario,
              fecha,
              maquinaria_estado,
              estado_gsa_maquinaria
              FROM gsa_maquinaria
              WHERE id_gsa_orden=$idOrden AND estado_gsa_maquinaria=1";
              $selectpro = mysql_query($querypro, $conexion);
              $rowpro = mysql_fetch_assoc($selectpro);
              $totalRowspro = mysql_num_rows($selectpro);
              if (0 < $totalRowspro) {
                do {
                  echo '<tr>';
                  echo '<td>' . $rowpro['numero_maquinaria'] . '</td>';
                  echo '<td>' . $rowpro['bien_maquinaria'] . '</td>';
                  echo '<td>' . $rowpro['especificacion_maquinaria'] . '</td>';
                  echo '<td>' . $rowpro['presentacion_maquinaria'] . '</td>';

                  echo '<td>' . $rowpro['cantidad_mensual'] . '</td>';
                  echo '<td>' . $rowpro['precio_unitario'] . '</td>';
                  echo '<td>' . $rowpro['fecha'] . '</td>';
                  echo '<td>';

                  if (1 == $rowpro['maquinaria_estado']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) {
              ?>
                      <button class="btn btn-xs btn-success" onclick="cambiomaquinaria('maquinaria', <?php echo $rowpro['id_gsa_maquinaria']; ?>, 0);">Activo</button>
                    <?php
                    } else {
                      echo '<button class="btn btn-xs btn-success">Activo</button>';
                    }
                  }
                  if (0 == $rowpro['maquinaria_estado']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) {
                    ?>
                      <button class="btn btn-xs btn-danger" onclick="cambiomaquinaria('maquinaria', <?php echo $rowpro['id_gsa_maquinaria']; ?>, 1);">Inactivo</button>
                    <?php
                    } else {
                      echo '<button class="btn btn-xs btn-danger">Inactivo</button>';
                    }
                  }
                  if (1 == $_SESSION['rol'] or 0 < $nump86) {
                    ?>
                    <a class="editarMaquinaria btn btn-xs btn-warning" title="Editar Maquinaria" id="<?php echo $rowpro['id_gsa_maquinaria']; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#editar_maquinaria"><i class="glyphicon glyphicon-pencil"></i></a>
              <?php
                  }
                  echo '</td>';
                  echo '</tr>';
                } while ($rowpro = mysql_fetch_assoc($selectpro));
                mysql_free_result($selectpro);
              }
              ?>
              <script>
                $(document).ready(function() {
                  $('#tableMaquina').DataTable({
                    "lengthMenu": [
                      [30, 50, 100, 200, 500],
                      [30, 50, 100, 200, 500]
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
      </div>
      <!--FIN MAQUINARIA Y EQUIPOS -->

      <!-- JARDINERIA -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h5 class="box-title"><b>Jardineria</b></h5>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: none;">

          <table class="table table-striped table-bordered table-hover" id="tablajardineria" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th scope="col"><label># Sede</label></th>
                <th scope="col"><label>Ubicación</label></th>
                <th scope="col"><label>Región</label></th>
                <th scope="col"><label># Orden</label></th>
                <th scope="col"><label>Fecha</label></th>
                <th scope="col"><label>Estado Jardineria</label></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT 
              gsa_sedes.id_oficina_registro,
              gsa_sedes.id_punto_ubicacion,
              gsa_sedes.id_gsa_sedes,
              gsa_sedes.num_sede,              
              oficina_registro.nombre_oficina_registro,
              punto_ubicacion.nombre_punto_ubicacion,
              region.nombre_region,
              gsa_orden.numero_orden,
              gsa_sedes.fecha,
              gsa_sedes.estado_jardineria,
              gsa_sedes.estado_gsa_sedes
              FROM gsa_sedes
              LEFT JOIN oficina_registro
              ON gsa_sedes.id_oficina_registro=oficina_registro.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON gsa_sedes.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
              LEFT JOIN region
              ON oficina_registro.id_region=region.id_region
              LEFT JOIN gsa_orden
              ON gsa_sedes.id_gsa_orden=gsa_orden.id_gsa_orden
              WHERE gsa_sedes.id_gsa_orden=$idOrden AND gsa_sedes.estado_gsa_sedes=1 ORDER BY num_sede ASC";
              $select = mysql_query($query, $conexion);
              $row = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  echo '<td>' . $row['num_sede'] . '</td>';
                  if (isset($row['id_oficina_registro'])) {
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                    echo '<td>' . $row['nombre_region'] . '</td>';
                  }
                  if (isset($row['id_punto_ubicacion'])) {
                    echo '<td>' . $row['nombre_punto_ubicacion'] . '</td>';
                    echo '<td></td>';
                  }
                  echo '<td> OC - ' . $row['numero_orden'] . '</a></td>';
                  echo '<td>' . $row['fecha'] . '</td>';
                  echo '<td>';
                  if (0 == $row['estado_jardineria']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) { ?>
                      <button class="btn btn-xs btn-danger" onclick="serviciojardineria('servicioJardineria', <?php echo $row['id_gsa_sedes']; ?>, 1);">No</button>
                    <?php
                    } else {
                      echo '<button class="btn btn-xs btn-danger">No</button>';
                    }
                  }
                  if (1 == $row['estado_jardineria']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) { ?>
                      <button class="btn btn-xs btn-success" onclick="serviciojardineria('servicioJardineria', <?php echo $row['id_gsa_sedes']; ?>, 0);">Si</button>
              <?php
                    } else {
                      echo '<button class="btn btn-xs btn-success">Si</button>';
                    }
                  }
                  echo '</td>';
                  echo '</tr>';
                } while ($row = mysql_fetch_assoc($select));
                mysql_free_result($select);
              }
              ?>
            </tbody>
            <script>
              $(document).ready(function() {
                $('#tablajardineria').DataTable({
                  "lengthMenu": [
                    [6, 20, 50, 100, 200],
                    [6, 20, 50, 100, 200]
                  ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [0, "asc"]
                  ]
                });
              });
            </script>
          </table>

        </div>
      </div>
      <!-- FIN JARDINERIA -->

      <!-- FUMIGACION -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h5 class="box-title"><b>Fumigación</b></h5>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: none;">

          <table class="table table-striped table-bordered table-hover" id="tablafumigacion" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th scope="col"><label># Sede</label></th>
                <th scope="col"><label>Ubicación</label></th>
                <th scope="col"><label>Región</label></th>
                <th scope="col"><label># Orden</label></th>
                <th scope="col"><label>Fecha</label></th>
                <th scope="col"><label>Estado Fumigación</label></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT 
              gsa_sedes.id_oficina_registro,
              gsa_sedes.id_punto_ubicacion,
              gsa_sedes.id_gsa_sedes,
              gsa_sedes.num_sede,              
              oficina_registro.nombre_oficina_registro,
              punto_ubicacion.nombre_punto_ubicacion,
              region.nombre_region,
              gsa_orden.numero_orden,
              gsa_sedes.fecha,
              gsa_sedes.estado_fumigacion,
              gsa_sedes.estado_gsa_sedes
              FROM gsa_sedes
              LEFT JOIN oficina_registro
              ON gsa_sedes.id_oficina_registro=oficina_registro.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON gsa_sedes.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
              LEFT JOIN region
              ON oficina_registro.id_region=region.id_region
              LEFT JOIN gsa_orden
              ON gsa_sedes.id_gsa_orden=gsa_orden.id_gsa_orden
              WHERE gsa_sedes.id_gsa_orden=$idOrden AND gsa_sedes.estado_gsa_sedes=1 ORDER BY num_sede ASC";
              $select = mysql_query($query, $conexion);
              $row = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  echo '<td>' . $row['num_sede'] . '</td>';
                  if (isset($row['id_oficina_registro'])) {
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                    echo '<td>' . $row['nombre_region'] . '</td>';
                  }
                  if (isset($row['id_punto_ubicacion'])) {
                    echo '<td>' . $row['nombre_punto_ubicacion'] . '</td>';
                    echo '<td></td>';
                  }
                  echo '<td> OC - ' . $row['numero_orden'] . '</a></td>';
                  echo '<td>' . $row['fecha'] . '</td>';
                  echo '<td>';
                  if (0 == $row['estado_fumigacion']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) { ?>
                      <button class="btn btn-xs btn-danger" onclick="serviciofumigacion('servicioFumigacion', <?php echo $row['id_gsa_sedes']; ?>, 1);">No</button>
                    <?php
                    } else {
                      echo '<button class="btn btn-xs btn-danger">No</button>';
                    }
                  }
                  if (1 == $row['estado_fumigacion']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) {
                    ?>
                      <button class="btn btn-xs btn-success" onclick="serviciofumigacion('servicioFumigacion', <?php echo $row['id_gsa_sedes']; ?>, 0);">Si</button>
              <?php
                    } else {
                      echo '<button class="btn btn-xs btn-success">Si</button>';
                    }
                  }
                  echo '</td>';
                  echo '</tr>';
                } while ($row = mysql_fetch_assoc($select));
                mysql_free_result($select);
              }
              ?>
            </tbody>
            <script>
              $(document).ready(function() {
                $('#tablafumigacion').DataTable({
                  "lengthMenu": [
                    [6, 20, 50, 100, 200],
                    [6, 20, 50, 100, 200]
                  ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [0, "asc"]
                  ]
                });
              });
            </script>
          </table>

        </div>
      </div>
      <!-- FIN FUMIGACION -->

      <!-- PERSONAL -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h5 class="box-title"><b>Personal</b></h5>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: none;">

          <table class="table table-striped table-bordered table-hover" id="tablapersonal" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th scope="col"><label># Sede</label></th>
                <th scope="col"><label>Ubicación</label></th>
                <th scope="col"><label>Región</label></th>
                <th scope="col"><label># Orden</label></th>
                <th scope="col"><label>Fecha</label></th>
                <th scope="col"><label>Cantidad Personal</label></th>
                <th scope="col"><label>Estado Personal</label></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT 
              gsa_sedes.id_oficina_registro,
              gsa_sedes.id_punto_ubicacion,
              gsa_sedes.id_gsa_sedes,
              gsa_sedes.num_sede,              
              oficina_registro.nombre_oficina_registro,
              punto_ubicacion.nombre_punto_ubicacion,
              region.nombre_region,
              gsa_orden.numero_orden,
              gsa_sedes.fecha,
              gsa_sedes.cantidad_personal,
              gsa_sedes.estado_personal,
              gsa_sedes.estado_gsa_sedes
              FROM gsa_sedes
              LEFT JOIN oficina_registro
              ON gsa_sedes.id_oficina_registro=oficina_registro.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON gsa_sedes.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
              LEFT JOIN region
              ON oficina_registro.id_region=region.id_region
              LEFT JOIN gsa_orden
              ON gsa_sedes.id_gsa_orden=gsa_orden.id_gsa_orden
              WHERE gsa_sedes.id_gsa_orden=$idOrden AND gsa_sedes.estado_gsa_sedes=1 ORDER BY num_sede ASC";
              $select = mysql_query($query, $conexion);
              $row = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  echo '<td>' . $row['num_sede'] . '</td>';
                  if (isset($row['id_oficina_registro'])) {
                    echo '<td>' . $row['nombre_oficina_registro'] . '</td>';
                    echo '<td>' . $row['nombre_region'] . '</td>';
                  }
                  if (isset($row['id_punto_ubicacion'])) {
                    echo '<td>' . $row['nombre_punto_ubicacion'] . '</td>';
                    echo '<td></td>';
                  }
                  echo '<td> OC - ' . $row['numero_orden'] . '</a></td>';
                  echo '<td>' . $row['fecha'] . '</td>';
                  echo '<td>';
                  if (1 == $_SESSION['rol'] or 0 < $nump86) { ?>
                    <input style="width:50px; text-align: center; border-radius:0px; border:solid 1px #999;" type="number" value="<?php echo $row['cantidad_personal']; ?>" onchange="cambiocantidadpersonal('verifica_personal', this.value, <?php echo $row['id_gsa_sedes']; ?>);" />
                    <?php
                  } else {
                    echo $row['cantidad_personal'];
                  }
                  echo '</td>';
                  echo '<td>';
                  if (0 == $row['estado_personal']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) {
                    ?>
                      <button class="btn btn-xs btn-danger" onclick="serviciopersonal('servicioPersonal', <?php echo $row['id_gsa_sedes']; ?>, 1);">No</button>
                    <?php
                    } else {
                      echo '<button class="btn btn-xs btn-danger">No</button>';
                    }
                  }
                  if (1 == $row['estado_personal']) {
                    if (1 == $_SESSION['rol'] or 0 < $nump86) {
                    ?>
                      <button class="btn btn-xs btn-success" onclick="serviciopersonal('servicioPersonal', <?php echo $row['id_gsa_sedes']; ?>, 0);">Si</button>
              <?php
                    } else {
                      echo '<button class="btn btn-xs btn-success">Si</button>';
                    }
                  }
                  echo '</td>';
                  echo '</tr>';
                } while ($row = mysql_fetch_assoc($select));
                mysql_free_result($select);
              }
              ?>
            </tbody>
            <script>
              $(document).ready(function() {
                $('#tablapersonal').DataTable({
                  "lengthMenu": [
                    [6, 20, 50, 100, 200],
                    [6, 20, 50, 100, 200]
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
          </table>

        </div>
      </div>
      <!-- FIN PERSONAL -->

    </div>
  </div>
</div>

<!-- EDITAR ORDEN DE COMPRA -->
<div class="modal fade" id="editar-orden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Editar Orden de Compra</b></h5>
      </div>
      <div class="modal-body">
        <form name="editaDetalleOrden" method="POST">
          <div class="row">
            <div class="col-md-4">
              <label>Nombre del Proveedor</label>
            </div>
            <div class="col-md-8">
              <select name="id_gsa_proveedor" class="form-control">
                <option value="<?php echo $rows['id_gsa_proveedor'];  ?>" selected><?php quees('gsa_proveedor', $rows['id_gsa_proveedor']);  ?></option>
                <option value=""> </option>
                <?php echo listapordefecto("gsa_proveedor", 500, "id_gsa_proveedor") ?>
              </select><br>
            </div>

            <div class="col-md-4">
              <label>Región</label>
            </div>
            <div class="col-md-8">
              <select name="region" class="form-control" required>
                <option value="<?php echo $rows['region'];  ?>" selected><?php echo $rows['region'];  ?></option>
                <option value=""> </option>
                <?php
                for ($i = 1; $i < 19; $i++) {
                  echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
              </select><br>
            </div>

            <div class="col-md-4">
              <label>Numero Orden</label>
            </div>
            <div class="col-md-8">
              <input type="number" class="form-control" name="numero_orden" value="<?php echo $rows['numero_orden'];  ?>"><br>
            </div>

            <div class="col-md-4">
              <label>Porcentaje AIU</label>
            </div>
            <div class="col-md-8">

              <select name="porcentaje_aiu" class="form-control" required>
                <option value="<?php echo $rows['porcentaje_aiu'];  ?>" selected><?php echo $rows['porcentaje_aiu'];  ?> %</option>
                <option value=""> </option>
                <?php
                for ($i = 1; $i < 11; $i++) {
                  echo '<option value="0.0' . $i . '">' . $i . ' %</option>';
                }
                ?>
              </select><br>
            </div>

            <div class="col-md-4">
              <label>Fecha Inicio</label>
            </div>
            <div class="col-md-8">
              <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $rows['fecha_inicio'];  ?>"><br>
            </div>

            <div class="col-md-4">
              <label>Fechal Final</label>
            </div>
            <div class="col-md-8">
              <input type="date" class="form-control" name="fecha_final" value="<?php echo $rows['fecha_final'];  ?>"><br>
            </div>

            <div class="col-md-4">
              <label>Funcionario a Cargo</label>
            </div>
            <div class="col-md-8">
              <select name="id_funcionario" class="form-control">
                <?php
                $query20 = sprintf("SELECT * FROM funcionario_perfil LEFT JOIN funcionario ON funcionario_perfil.id_funcionario=funcionario.id_funcionario WHERE funcionario_perfil.id_perfil=85 AND funcionario_perfil.estado_funcionario_perfil=1");
                $result20 = $mysqli->query($query20); ?>
                <option value="<?php echo $rows['id_funcionario'];  ?>" selected><?php echo $rows['nombre_funcionario'];  ?></option>
                <option value=""> </option>
                <?php while ($row20 = $result20->fetch_array(MYSQLI_ASSOC)) {
                  echo '<option value="' . $row20['id_funcionario'] . '">' . $row20['nombre_funcionario'] . '</option>';
                }
                ?>
              </select>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <input class="btn btn-success" type="submit" name="editaDetalleOrden" value="Actualizar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL DE EDITAR PRODUCTO -->
<div class="modal fade" id="editar_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="float:left" id="exampleModalLabel"><b>Editar Producto</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" name="actualizarProducto">
        <div id="divEditarProducto">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL DE EDITAR ARTICULO -->
<div class="modal fade" id="editar_articulo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="float:left" id="exampleModalLabel"><b>Editar Articulo</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" name="actualizarArticulo">
        <div id="divEditarArticulo">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL DE EDITAR MAQUINARIA -->
<div class="modal fade" id="editar_maquinaria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="float:left" id="exampleModalLabel"><b>Nueva Maquinaria</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" name="actualizarmaquinaria">
        <div id="divEditarMaquinaria">
        </div>
      </form>
    </div>
  </div>
</div>


<!-- NUEVO ARTICULO ORDEN DE COMRPRA -->
<div class="modal fade" id="nuevo-articulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Nuevo Articulo</b></h5>
      </div>
      <div class="modal-body">
        <form name="nuevoArticulo" method="POST">
          <div class="row">
            <div class="col-md-4">
              <label>Nombre Articulo</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="nombre_gsa_orden_articulo" required><br>
            </div>

            <div class="col-md-4">
              <label>Cantidad</label>
            </div>
            <div class="col-md-8">
              <input type="number" class="form-control" name="cantidad" required><br>
            </div>

            <div class="col-md-4">
              <label>Unidad</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="unidad" required><br>
            </div>

            <div class="col-md-4">
              <label>Precio</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="gsamoneda form-control" name="precio" required><br>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <input class="btn btn-success" type="submit" name="nuevoarticulo" value="Guardar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
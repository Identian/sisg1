<?php
set_time_limit(0);
$idOrden = $_GET['i'];
$idfun = $_SESSION['snr'];
$nump85 = privilegios(85, $_SESSION['snr']);  // COORDINADOR ASEO CAFETERIA
$nump86 = privilegios(86, $_SESSION['snr']);  // ADMINISTRADOR ASEO Y CAFETERIA

//////////////////////////////////
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
////////////////////////////////////

// INSERTAR NUEVA SOLICITUD
if (
  isset($_POST["nuevaSolicitud"]) && '' != $_POST["nuevaSolicitud"] &&
  isset($_POST["fecha_inicio"]) && '' != $_POST["fecha_inicio"] &&
  isset($_POST["fecha_final"]) && '' != $_POST["fecha_final"]
) {

  // VALIDA INGRESA ELEMENTO POR INSUMO
  if (isset($_POST["elementoSolicitud"]) && '' != $_POST["elementoSolicitud"] && 1 == $_POST["elementoSolicitud"]) {
    $fecInicio = $_POST["fecha_inicio"];
    $idSolicitudElemento = $_POST["elementoSolicitud"];
    $date1 = date_create($fecInicio);
    $fecInicioMes = date_format($date1, "m");
    $date2 = date_create($fecInicio);
    $fecInicioAno = date_format($date2, "Y");

    $queryCuenta = "SELECT COUNT(fecha_inicio) AS fecInicio FROM gsa_solicitud 
    WHERE MONTH(fecha_inicio) = $fecInicioMes AND 
    YEAR(fecha_inicio) = $fecInicioAno AND 
    estado_gsa_solicitud=1 AND
    id_gsa_elemento=1 AND 
    id_gsa_orden=$idOrden";
    $selecCuenta = mysql_query($queryCuenta, $conexion);
    $rowCuenta = mysql_fetch_assoc($selecCuenta);

    if (0 < $rowCuenta['fecInicio']) {
      echo $repetido;
      echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
    } else {

      $insertar = sprintf(
        "INSERT INTO gsa_solicitud (
        nombre_gsa_solicitud,
        id_gsa_elemento,
        id_gsa_orden, 
        fecha_inicio,
        fecha_final) VALUES (%s,%s,%s,%s,%s)",
        GetSQLValueString('INSUMO', "text"),
        GetSQLValueString($idSolicitudElemento, "int"),
        GetSQLValueString($idOrden, "int"),
        GetSQLValueString($fecInicio, "text"),
        GetSQLValueString($_POST["fecha_final"], "text")
      );
      $result = mysql_query($insertar, $conexion);
      if (NULL != $insertar) {
        $ultimoIdSolicitud = mysql_insert_id($conexion);

        $querypro = "SELECT * FROM gsa_producto
        WHERE gsa_producto.id_gsa_orden=$idOrden AND estado_gsa_producto=1 AND producto_estado=1";
        $selectpro = mysql_query($querypro, $conexion);
        $rowpro = mysql_fetch_assoc($selectpro);
        $totalpro = mysql_num_rows($selectpro);
        if (0 < $totalpro) {
          do {
            $idProducto = $rowpro['id_gsa_producto'];
            $queryofi = "SELECT * FROM gsa_sedes
            LEFT JOIN gsa_producto
            ON gsa_sedes.id_gsa_orden=gsa_producto.id_gsa_orden
            WHERE gsa_sedes.id_gsa_orden=$idOrden AND gsa_producto.id_gsa_producto=$idProducto AND estado_gsa_sedes=1";
            $selectofi = mysql_query($queryofi, $conexion);
            $rowofi = mysql_fetch_assoc($selectofi);
            $totalofi = mysql_num_rows($selectofi);
            if (0 < $totalofi) {
              do {
                $idOficina = $rowofi['id_oficina_registro'];
                $idPuntoUbicacion = $rowofi['id_punto_ubicacion'];
                $matriz = sprintf(
                  "INSERT INTO gsa_solicitud_insumo (
                  nombre_gsa_solicitud_insumo,
                  id_solicitud, 
                  id_gsa_producto,
                  id_oficina_registro,
                  id_punto_ubicacion,
                  cantidad_producto,
                  cantidad_verifica) VALUES (%s,%s,%s,%s,%s,%s,%s)",
                  GetSQLValueString('INSUMO', "text"),
                  GetSQLValueString($ultimoIdSolicitud, "int"),
                  GetSQLValueString($idProducto, "int"),
                  GetSQLValueString($idOficina, "int"),
                  GetSQLValueString($idPuntoUbicacion, "int"),
                  GetSQLValueString(1, "int"),
                  GetSQLValueString(0, "int")
                );
                $resultmatriz = mysql_query($matriz, $conexion);
              } while ($rowofi = mysql_fetch_assoc($selectofi));
              mysql_free_result($selectofi);
            }
          } while ($rowpro = mysql_fetch_assoc($selectpro));
          mysql_free_result($selectpro);
        }
        echo $insertado;
        mysql_free_result($result);
        echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
      }
    }
  }
  // FINAL VALIDA INGRESA ELEMENTO POR INSUMO

  // VALIDA INGRESA ELEMENTO POR MAQUINARIA
  if (isset($_POST["elementoSolicitud"]) && '' != $_POST["elementoSolicitud"] && 2 == $_POST["elementoSolicitud"]) {
    $fecInicio = $_POST["fecha_inicio"];
    $idSolicitudElemento = $_POST["elementoSolicitud"];
    $date1 = date_create($fecInicio);
    $fecInicioMes = date_format($date1, "m");
    $date2 = date_create($fecInicio);
    $fecInicioAno = date_format($date2, "Y");

    $queryCuenta = "SELECT COUNT(fecha_inicio) AS fecInicio FROM gsa_solicitud 
    WHERE MONTH(fecha_inicio) = $fecInicioMes AND 
    YEAR(fecha_inicio) = $fecInicioAno AND 
    estado_gsa_solicitud=1 AND
    id_gsa_elemento=2 AND 
    id_gsa_orden=$idOrden";
    $selecCuenta = mysql_query($queryCuenta, $conexion);
    $rowCuenta = mysql_fetch_assoc($selecCuenta);

    if (0 < $rowCuenta['fecInicio']) {
      echo $repetido;
      echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
    } else {

      $insertar = sprintf(
        "INSERT INTO gsa_solicitud (
        nombre_gsa_solicitud,
        id_gsa_elemento,
        id_gsa_orden, 
        fecha_inicio,
        fecha_final) VALUES (%s,%s,%s,%s,%s)",
        GetSQLValueString('MAQUINARIA', "text"),
        GetSQLValueString($idSolicitudElemento, "int"),
        GetSQLValueString($idOrden, "int"),
        GetSQLValueString($fecInicio, "text"),
        GetSQLValueString($_POST["fecha_final"], "text")
      );
      $result = mysql_query($insertar, $conexion);
      if (NULL != $insertar) {
        $ultimoIdSolicitud = mysql_insert_id($conexion);

        $querypro = "SELECT * FROM gsa_maquinaria
        WHERE gsa_maquinaria.id_gsa_orden=$idOrden AND estado_gsa_maquinaria=1 AND maquinaria_estado=1";
        $selectpro = mysql_query($querypro, $conexion);
        $rowpro = mysql_fetch_assoc($selectpro);
        $totalpro = mysql_num_rows($selectpro);
        if (0 < $totalpro) {
          do {
            $idMaquinaria = $rowpro['id_gsa_maquinaria'];
            $queryofi = "SELECT * FROM gsa_sedes
            LEFT JOIN gsa_maquinaria
            ON gsa_sedes.id_gsa_orden=gsa_maquinaria.id_gsa_orden
            WHERE gsa_sedes.id_gsa_orden=$idOrden AND gsa_maquinaria.id_gsa_maquinaria=$idMaquinaria AND estado_gsa_sedes=1";
            $selectofi = mysql_query($queryofi, $conexion);
            $rowofi = mysql_fetch_assoc($selectofi);
            $totalofi = mysql_num_rows($selectofi);
            if (0 < $totalofi) {
              do {
                $idOficina = $rowofi['id_oficina_registro'];
                $idPuntoUbicacion = $rowofi['id_punto_ubicacion'];
                $matriz = sprintf(
                  "INSERT INTO gsa_solicitud_maquinaria (
                  nombre_gsa_solicitud_maquinaria,
                  id_solicitud, 
                  id_gsa_maquinaria,
                  id_oficina_registro,
                  id_punto_ubicacion,
                  cantidad_producto,
                  cantidad_verifica) VALUES (%s,%s,%s,%s,%s,%s,%s)",
                  GetSQLValueString('MAQUINARIA', "text"),
                  GetSQLValueString($ultimoIdSolicitud, "int"),
                  GetSQLValueString($idMaquinaria, "int"),
                  GetSQLValueString($idOficina, "int"),
                  GetSQLValueString($idPuntoUbicacion, "int"),
                  GetSQLValueString(0, "int"),
                  GetSQLValueString(0, "int")
                );
                $resultmatriz = mysql_query($matriz, $conexion);
              } while ($rowofi = mysql_fetch_assoc($selectofi));
              mysql_free_result($selectofi);
            }
          } while ($rowpro = mysql_fetch_assoc($selectpro));
          mysql_free_result($selectpro);
        }
        echo $insertado;
        mysql_free_result($result);
        echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
      }
    }
  }
  // FINAL VALIDA INGRESA ELEMENTO POR MAQUINARIA

  // VALIDA INGRESA ELEMENTO POR JARDINERIA
  if (isset($_POST["elementoSolicitud"]) && '' != $_POST["elementoSolicitud"] && 3 == $_POST["elementoSolicitud"]) {
    $fecInicio = $_POST["fecha_inicio"];
    $idSolicitudElemento = $_POST["elementoSolicitud"];
    $date1 = date_create($fecInicio);
    $fecInicioMes = date_format($date1, "m");
    $date2 = date_create($fecInicio);
    $fecInicioAno = date_format($date2, "Y");

    $queryCuenta = "SELECT COUNT(fecha_inicio) AS fecInicio FROM gsa_solicitud 
    WHERE MONTH(fecha_inicio) = $fecInicioMes AND 
    YEAR(fecha_inicio) = $fecInicioAno AND 
    estado_gsa_solicitud=1 AND
    id_gsa_elemento=3 AND 
    id_gsa_orden=$idOrden";
    $selecCuenta = mysql_query($queryCuenta, $conexion);
    $rowCuenta = mysql_fetch_assoc($selecCuenta);

    if (0 < $rowCuenta['fecInicio']) {
      echo $repetido;
      echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
    } else {

      $insertar = sprintf(
        "INSERT INTO gsa_solicitud (
        nombre_gsa_solicitud,
        id_gsa_elemento,
        id_gsa_orden, 
        fecha_inicio,
        fecha_final) VALUES (%s,%s,%s,%s,%s)",
        GetSQLValueString('JARDINERIA', "text"),
        GetSQLValueString($idSolicitudElemento, "int"),
        GetSQLValueString($idOrden, "int"),
        GetSQLValueString($fecInicio, "text"),
        GetSQLValueString($_POST["fecha_final"], "text")
      );
      $result = mysql_query($insertar, $conexion);
      if (NULL != $insertar) {
        $ultimoIdSolicitud = mysql_insert_id($conexion);
        $queryofi = "SELECT 
        oficina_registro.id_oficina_registro,
        punto_ubicacion.id_punto_ubicacion
        FROM gsa_sedes
        LEFT JOIN gsa_orden
        ON gsa_sedes.id_gsa_orden=gsa_orden.id_gsa_orden
        LEFT JOIN oficina_registro
        ON gsa_sedes.id_oficina_registro=oficina_registro.id_oficina_registro
        LEFT JOIN punto_ubicacion
        ON gsa_sedes.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
        WHERE gsa_sedes.id_gsa_orden=$idOrden AND gsa_sedes.estado_gsa_sedes=1 AND gsa_sedes.estado_jardineria=1";
        $selectofi = mysql_query($queryofi, $conexion);
        $rowofi = mysql_fetch_assoc($selectofi);
        $totalofi = mysql_num_rows($selectofi);
        if (0 < $totalofi) {
          do {
            $idOficina = $rowofi['id_oficina_registro'];
            $idPuntoUbicacion = $rowofi['id_punto_ubicacion'];
            $matriz = sprintf(
              "INSERT INTO gsa_solicitud_jardineria (
              nombre_gsa_solicitud_jardineria,
              id_solicitud, 
              id_oficina_registro,
              id_punto_ubicacion) VALUES (%s,%s,%s,%s)",
              GetSQLValueString('JARDINERIA', "text"),
              GetSQLValueString($ultimoIdSolicitud, "int"),
              GetSQLValueString($idOficina, "int"),
              GetSQLValueString($idPuntoUbicacion, "int")
            );
            $resultmatriz = mysql_query($matriz, $conexion);
          } while ($rowofi = mysql_fetch_assoc($selectofi));
          mysql_free_result($selectofi);
        }
        echo $insertado;
        mysql_free_result($result);
        echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
      }
    }
  }
  // FINAL VALIDA INGRESA ELEMENTO POR JARDINERIA

  // VALIDA INGRESA ELEMENTO POR FUMIGACION
  if (isset($_POST["elementoSolicitud"]) && '' != $_POST["elementoSolicitud"] && 4 == $_POST["elementoSolicitud"]) {
    $fecInicio = $_POST["fecha_inicio"];
    $idSolicitudElemento = $_POST["elementoSolicitud"];
    $date1 = date_create($fecInicio);
    $fecInicioMes = date_format($date1, "m");
    $date2 = date_create($fecInicio);
    $fecInicioAno = date_format($date2, "Y");

    $queryCuenta = "SELECT COUNT(fecha_inicio) AS fecInicio FROM gsa_solicitud 
    WHERE MONTH(fecha_inicio) = $fecInicioMes AND 
    YEAR(fecha_inicio) = $fecInicioAno AND 
    estado_gsa_solicitud=1 AND
    id_gsa_elemento=4 AND 
    id_gsa_orden=$idOrden";
    $selecCuenta = mysql_query($queryCuenta, $conexion);
    $rowCuenta = mysql_fetch_assoc($selecCuenta);

    if (0 < $rowCuenta['fecInicio']) {
      echo $repetido;
      echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
    } else {

      $insertar = sprintf(
        "INSERT INTO gsa_solicitud (
        nombre_gsa_solicitud,
        id_gsa_elemento,
        id_gsa_orden, 
        fecha_inicio,
        fecha_final) VALUES (%s,%s,%s,%s,%s)",
        GetSQLValueString('FUMIGACION', "text"),
        GetSQLValueString($idSolicitudElemento, "int"),
        GetSQLValueString($idOrden, "int"),
        GetSQLValueString($fecInicio, "text"),
        GetSQLValueString($_POST["fecha_final"], "text")
      );
      $result = mysql_query($insertar, $conexion);
      if (NULL != $insertar) {
        $ultimoIdSolicitud = mysql_insert_id($conexion);
        $queryofi = "SELECT 
        oficina_registro.id_oficina_registro,
        punto_ubicacion.id_punto_ubicacion
        FROM gsa_sedes
        LEFT JOIN gsa_orden
        ON gsa_sedes.id_gsa_orden=gsa_orden.id_gsa_orden
        LEFT JOIN oficina_registro
        ON gsa_sedes.id_oficina_registro=oficina_registro.id_oficina_registro
        LEFT JOIN punto_ubicacion
        ON gsa_sedes.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
        WHERE gsa_sedes.id_gsa_orden=$idOrden AND gsa_sedes.estado_gsa_sedes=1";
        $selectofi = mysql_query($queryofi, $conexion);
        $rowofi = mysql_fetch_assoc($selectofi);
        $totalofi = mysql_num_rows($selectofi);
        if (0 < $totalofi) {
          do {
            $idOficina = $rowofi['id_oficina_registro'];
            $idPuntoUbicacion = $rowofi['id_punto_ubicacion'];
            $matriz = sprintf(
              "INSERT INTO gsa_solicitud_fumigacion (
              nombre_gsa_solicitud_fumigacion,
              id_solicitud, 
              id_oficina_registro,
              id_punto_ubicacion) VALUES (%s,%s,%s,%s)",
              GetSQLValueString('FUMIGACION', "text"),
              GetSQLValueString($ultimoIdSolicitud, "int"),
              GetSQLValueString($idOficina, "int"),
              GetSQLValueString($idPuntoUbicacion, "int")
            );
            $resultmatriz = mysql_query($matriz, $conexion);
          } while ($rowofi = mysql_fetch_assoc($selectofi));
          mysql_free_result($selectofi);
        }
        echo $insertado;
        mysql_free_result($result);
        echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
      }
    }
  }
  // FINAL VALIDA INGRESA ELEMENTO POR FUMIGACION

  // VALIDA INGRESA ELEMENTO POR PERSONA
  if (isset($_POST["elementoSolicitud"]) && '' != $_POST["elementoSolicitud"] && 5 == $_POST["elementoSolicitud"]) {
    $fecInicio = $_POST["fecha_inicio"];
    $idSolicitudElemento = $_POST["elementoSolicitud"];
    $date1 = date_create($fecInicio);
    $fecInicioMes = date_format($date1, "m");
    $date2 = date_create($fecInicio);
    $fecInicioAno = date_format($date2, "Y");

    $queryCuenta = "SELECT COUNT(fecha_inicio) AS fecInicio FROM gsa_solicitud 
    WHERE MONTH(fecha_inicio) = $fecInicioMes AND 
    YEAR(fecha_inicio) = $fecInicioAno AND 
    estado_gsa_solicitud=1 AND
    id_gsa_elemento=5 AND 
    id_gsa_orden=$idOrden";
    $selecCuenta = mysql_query($queryCuenta, $conexion);
    $rowCuenta = mysql_fetch_assoc($selecCuenta);

    if (0 < $rowCuenta['fecInicio']) {
      echo $repetido;
      echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
    } else {

      $insertar = sprintf(
        "INSERT INTO gsa_solicitud (
        nombre_gsa_solicitud,
        id_gsa_elemento,
        id_gsa_orden, 
        fecha_inicio,
        fecha_final) VALUES (%s,%s,%s,%s,%s)",
        GetSQLValueString('PERSONAL', "text"),
        GetSQLValueString($idSolicitudElemento, "int"),
        GetSQLValueString($idOrden, "int"),
        GetSQLValueString($fecInicio, "text"),
        GetSQLValueString($_POST["fecha_final"], "text")
      );
      $result = mysql_query($insertar, $conexion);
      if (NULL != $insertar) {
        $ultimoIdSolicitud = mysql_insert_id($conexion);

        $fecha1 = new DateTime($fecInicio);
        $fecha2 = new DateTime($_POST["fecha_final"]);
        $diff = $fecha1->diff($fecha2);
        $diastrabajados = $diff->days + 1;

        $queryPer = "SELECT * FROM gsa_sedes
            WHERE gsa_sedes.id_gsa_orden=$idOrden AND estado_gsa_sedes=1";
        $selectPer = mysql_query($queryPer, $conexion);
        $rowPer = mysql_fetch_assoc($selectPer);
        $totalPer = mysql_num_rows($selectPer);
        if (0 < $totalPer) {
          do {
            for ($i = 0; $i < $rowPer['cantidad_personal']; $i++) {

              $numpersonal = 1 + $i;
              $idOficina = $rowPer['id_oficina_registro'];
              $idPuntoUbicacion = $rowPer['id_punto_ubicacion'];
              $matriz = sprintf(
                "INSERT INTO gsa_solicitud_personal (
                  nombre_gsa_solicitud_personal,
                  id_solicitud, 
                  id_oficina_registro,
                  id_punto_ubicacion,

                  nombre_personal,
                  cantidad_total_personal,
                  dias_trabajados) VALUES (%s,%s,%s,%s, %s,%s,%s)",
                GetSQLValueString('PERSONAL', "text"),
                GetSQLValueString($ultimoIdSolicitud, "int"),
                GetSQLValueString($idOficina, "int"),
                GetSQLValueString($idPuntoUbicacion, "int"),

                GetSQLValueString('PERSONAL # ' . $numpersonal, "text"),
                GetSQLValueString($rowPer['cantidad_personal'], "int"),
                GetSQLValueString($diastrabajados, "int")
              );
              $resultmatriz = mysql_query($matriz, $conexion);
            }
          } while ($rowPer = mysql_fetch_assoc($selectPer));
          mysql_free_result($selectPer);
        }

        echo $insertado;
        mysql_free_result($result);
        echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
      }
    }
  }
  // FINAL VALIDA INGRESA ELEMENTO POR PERSONA

}
// FINAL IF INSERTAR NUEVA SOLICITUD

// DUPLICA SOLICITUD
if (
  isset($_POST["duplicaSolicitud"]) && '' != $_POST["duplicaSolicitud"] &&
  isset($_POST["id_solicitud_duplicar"]) && '' != $_POST["id_solicitud_duplicar"] &&
  isset($_POST["id_gsa_elemento"]) && '' != $_POST["id_gsa_elemento"] &&
  isset($_POST["fecha_inicio_duplica"]) && '' != $_POST["fecha_inicio_duplica"] &&
  isset($_POST["fecha_final_duplica"]) && '' != $_POST["fecha_final_duplica"]
) {
  $fecInicio = $_POST["fecha_inicio_duplica"];
  $elemento = $_POST["id_gsa_elemento"];

  if ($elemento == 1) {
    $nombreGsaSolicitud = 'INSUMO';
  }
  if ($elemento == 2) {
    $nombreGsaSolicitud = 'MAQUINARIA';
  }
  if ($elemento == 3) {
    $nombreGsaSolicitud = 'JARDINERIA';
  }
  if ($elemento == 4) {
    $nombreGsaSolicitud = 'FUMIGACION';
  }
  if ($elemento == 5) {
    $nombreGsaSolicitud = 'PERSONAL';
  }

  $date1 = date_create($fecInicio);
  $fecInicioMes = date_format($date1, "m");
  $date2 = date_create($fecInicio);
  $fecInicioAno = date_format($date2, "Y");

  $queryCuenta = "SELECT COUNT(fecha_inicio) AS fecInicio FROM gsa_solicitud WHERE MONTH(fecha_inicio) = $fecInicioMes AND YEAR(fecha_inicio) = $fecInicioAno AND id_gsa_elemento=$elemento AND id_gsa_orden=$idOrden AND estado_gsa_solicitud=1";
  $selecCuenta = mysql_query($queryCuenta, $conexion);
  $rowCuenta = mysql_fetch_assoc($selecCuenta);

  if (0 < $rowCuenta['fecInicio']) {
    echo $repetido;
    echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
  } else {
    $insertar = sprintf(
      "INSERT INTO gsa_solicitud (
      nombre_gsa_solicitud,
      id_gsa_elemento,
      id_gsa_orden, 
      fecha_inicio,
      fecha_final) VALUES (%s,%s,%s,%s,%s)",
      GetSQLValueString($nombreGsaSolicitud, "text"),
      GetSQLValueString($elemento, "int"),
      GetSQLValueString($idOrden, "int"),
      GetSQLValueString($fecInicio, "text"),
      GetSQLValueString($_POST["fecha_final_duplica"], "text")
    );
    if (mysql_query($insertar, $conexion)) {
      $ultimo_id_duplica = mysql_insert_id($conexion);
      $idSolicitud = $_POST["id_solicitud_duplicar"];
      // INSUMO
      if ($elemento == 1) {
        $queryproDuplica = "SELECT * FROM gsa_solicitud_insumo
        WHERE id_solicitud=$idSolicitud AND estado_gsa_solicitud_insumo=1";
        $selectproDuplica = mysql_query($queryproDuplica, $conexion);
        $rowproDuplica = mysql_fetch_assoc($selectproDuplica);
        $totalproDuplica = mysql_num_rows($selectproDuplica);
        if (0 < $totalproDuplica) {
          do {
            $productoduplica = $rowproDuplica['id_gsa_producto'];
            $idOficinaduplica = $rowproDuplica['id_oficina_registro'];
            $puntoUbicacionduplica = $rowproDuplica['id_punto_ubicacion'];
            $cantidadduplica = $rowproDuplica['cantidad_producto'];

            $matrizDuplica = sprintf(
              "INSERT INTO gsa_solicitud_insumo (
              nombre_gsa_solicitud_insumo,
              id_solicitud, 
              id_gsa_producto,
              id_oficina_registro,

              id_punto_ubicacion,
              cantidad_producto,
              cantidad_verifica) VALUES (%s,%s,%s,%s, %s,%s,%s)",
              GetSQLValueString('DUPLICADO INSUMO', "text"),
              GetSQLValueString($ultimo_id_duplica, "int"),
              GetSQLValueString($productoduplica, "int"),
              GetSQLValueString($idOficinaduplica, "int"),
              GetSQLValueString($puntoUbicacionduplica, "int"),
              GetSQLValueString($cantidadduplica, "int"),
              GetSQLValueString(0, "int")
            );
            $resultmatrizDuplica = mysql_query($matrizDuplica, $conexion);
          } while ($rowproDuplica = mysql_fetch_assoc($selectproDuplica));
          mysql_free_result($selectproDuplica);
          echo $insertado;
          echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
        }
      }
      // MAQUINARIA
      if ($elemento == 2) {
        $queryproDuplica = "SELECT * FROM gsa_solicitud_maquinaria
        WHERE id_solicitud=$idSolicitud AND estado_gsa_solicitud_maquinaria=1";
        $selectproDuplica = mysql_query($queryproDuplica, $conexion);
        $rowproDuplica = mysql_fetch_assoc($selectproDuplica);
        $totalproDuplica = mysql_num_rows($selectproDuplica);
        if (0 < $totalproDuplica) {
          do {
            $productoduplica = $rowproDuplica['id_gsa_maquinaria'];
            $idOficinaduplica = $rowproDuplica['id_oficina_registro'];
            $puntoUbicacionduplica = $rowproDuplica['id_punto_ubicacion'];
            $cantidadduplica = $rowproDuplica['cantidad_producto'];

            $matrizDuplica = sprintf(
              "INSERT INTO gsa_solicitud_maquinaria (
              nombre_gsa_solicitud_maquinaria,
              id_solicitud, 
              id_gsa_maquinaria,
              id_oficina_registro,

              id_punto_ubicacion,
              cantidad_producto,
              cantidad_verifica) VALUES (%s,%s,%s,%s, %s,%s,%s)",
              GetSQLValueString('DUPLICADO MAQUINARIA', "text"),
              GetSQLValueString($ultimo_id_duplica, "int"),
              GetSQLValueString($productoduplica, "int"),
              GetSQLValueString($idOficinaduplica, "int"),
              GetSQLValueString($puntoUbicacionduplica, "int"),
              GetSQLValueString($cantidadduplica, "int"),
              GetSQLValueString(0, "int")
            );
            $resultmatrizDuplica = mysql_query($matrizDuplica, $conexion);
          } while ($rowproDuplica = mysql_fetch_assoc($selectproDuplica));
          mysql_free_result($selectproDuplica);
          echo $insertado;
          echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
        }
      }
      // JARDINERIA
      if ($elemento == 3) {
        $queryproDuplica = "SELECT * FROM gsa_solicitud_jardineria
        WHERE id_solicitud=$idSolicitud AND estado_gsa_solicitud_jardineria=1";
        $selectproDuplica = mysql_query($queryproDuplica, $conexion);
        $rowproDuplica = mysql_fetch_assoc($selectproDuplica);
        $totalproDuplica = mysql_num_rows($selectproDuplica);
        if (0 < $totalproDuplica) {
          do {
            $idOficinaduplica = $rowproDuplica['id_oficina_registro'];
            $puntoUbicacionduplica = $rowproDuplica['id_punto_ubicacion'];
            $valorServicioJardineria = $rowproDuplica['valor_servicio'];

            $matrizDuplica = sprintf(
              "INSERT INTO gsa_solicitud_jardineria (
              nombre_gsa_solicitud_jardineria,
              id_solicitud, 
              id_oficina_registro,
              id_punto_ubicacion,
              valor_servicio) VALUES (%s,%s,%s,%s,%s)",
              GetSQLValueString('DUPLICADO JARDINERIA', "text"),
              GetSQLValueString($ultimo_id_duplica, "int"),
              GetSQLValueString($idOficinaduplica, "int"),
              GetSQLValueString($puntoUbicacionduplica, "int"),
              GetSQLValueString($valorServicioJardineria, "double")
            );
            $resultmatrizDuplica = mysql_query($matrizDuplica, $conexion);
          } while ($rowproDuplica = mysql_fetch_assoc($selectproDuplica));
          mysql_free_result($selectproDuplica);
          echo $insertado;
          echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
        }
      }
      // FUMIGACION
      if ($elemento == 4) {
        $queryproDuplica = "SELECT * FROM gsa_solicitud_fumigacion
        WHERE id_solicitud=$idSolicitud AND estado_gsa_solicitud_fumigacion=1";
        $selectproDuplica = mysql_query($queryproDuplica, $conexion);
        $rowproDuplica = mysql_fetch_assoc($selectproDuplica);
        $totalproDuplica = mysql_num_rows($selectproDuplica);
        if (0 < $totalproDuplica) {
          do {
            $idOficinaduplica = $rowproDuplica['id_oficina_registro'];
            $puntoUbicacionduplica = $rowproDuplica['id_punto_ubicacion'];
            $valorServicioFumigacion = $rowproDuplica['valor_servicio'];

            $matrizDuplica = sprintf(
              "INSERT INTO gsa_solicitud_fumigacion (
              nombre_gsa_solicitud_fumigacion,
              id_solicitud, 
              id_oficina_registro,
              id_punto_ubicacion,
              valor_servicio) VALUES (%s,%s,%s,%s,%s)",
              GetSQLValueString('DUPLICADO FUMIGACION', "text"),
              GetSQLValueString($ultimo_id_duplica, "int"),
              GetSQLValueString($idOficinaduplica, "int"),
              GetSQLValueString($puntoUbicacionduplica, "int"),
              GetSQLValueString($valorServicioFumigacion, "double")
            );
            $resultmatrizDuplica = mysql_query($matrizDuplica, $conexion);
          } while ($rowproDuplica = mysql_fetch_assoc($selectproDuplica));
          mysql_free_result($selectproDuplica);
          echo $insertado;
          echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
        }
      }
      // PERSONAL
      if ($elemento == 5) {
        $fecha1 = new DateTime($_POST["fecha_inicio_duplica"]);
        $fecha2 = new DateTime($_POST["fecha_final_duplica"]);
        $diff = $fecha1->diff($fecha2);
        $diastrabajados = $diff->days + 1;

        $queryproDuplica = "SELECT * FROM gsa_solicitud_personal
        WHERE id_solicitud=$idSolicitud AND estado_gsa_solicitud_personal=1";
        $selectproDuplica = mysql_query($queryproDuplica, $conexion);
        $rowproDuplica = mysql_fetch_assoc($selectproDuplica);
        $totalproDuplica = mysql_num_rows($selectproDuplica);
        if (0 < $totalproDuplica) {
          do {
            $idOficinaduplica = $rowproDuplica['id_oficina_registro'];
            $puntoUbicacionduplica = $rowproDuplica['id_punto_ubicacion'];
            $nombreServicioPersonal = $rowproDuplica['nombre_personal'];
            $CantidadPersonal = $rowproDuplica['cantidad_total_personal'];
            $valorServicioPersonal = $rowproDuplica['valor_personal'];

            $matrizDuplica = sprintf(
              "INSERT INTO gsa_solicitud_personal (
              nombre_gsa_solicitud_personal,
              id_solicitud, 
              id_oficina_registro,
              id_punto_ubicacion,
              nombre_personal,

              cantidad_total_personal,
              valor_personal,
              dias_trabajados) VALUES (%s,%s,%s,%s,%s, %s,%s,%s)",
              GetSQLValueString('DUPLICADO PERSONAL', "text"),
              GetSQLValueString($ultimo_id_duplica, "int"),
              GetSQLValueString($idOficinaduplica, "int"),
              GetSQLValueString($puntoUbicacionduplica, "int"),
              GetSQLValueString($nombreServicioPersonal, "text"),

              GetSQLValueString($CantidadPersonal, "int"),
              GetSQLValueString($valorServicioPersonal, "double"),
              GetSQLValueString($diastrabajados, "int")
            );
            $resultmatrizDuplica = mysql_query($matrizDuplica, $conexion);
          } while ($rowproDuplica = mysql_fetch_assoc($selectproDuplica));
          mysql_free_result($selectproDuplica);
          echo $insertado;
          echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
        }
      }
    } else {
      echo $error;
      echo '<meta http-equiv="refresh" content="0;URL=gsa_orden&' . $idOrden . '.jsp" />';
    }
  }
}


$query = "SELECT 
gsa_orden.id_gsa_orden,
gsa_proveedor.nombre_gsa_proveedor,
gsa_orden.numero_orden,
gsa_orden.fecha_inicio,
gsa_orden.fecha_final,
gsa_orden.fecha,
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
  
  $(function() {
    $('.gsaInsumos').click(function() {
      var ma = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_insumo.php",
        data: 'option=' + ma,
        async: true,
        success: function(gsaInsumos) {
          jQuery('#divModal').html(gsaInsumos);
        }
      })
    });
  })

  $(function() {
    $('.gsamaquinaria').click(function() {
      var maqui = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_maquinaria.php",
        data: 'option=' + maqui,
        async: true,
        success: function(gsamaquinaria) {
          jQuery('#divModal').html(gsamaquinaria);
        }
      })
    });
  })

  $(function() {
    $('.gsajardineria').click(function() {
      var jar = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_jardineria.php",
        data: 'option=' + jar,
        async: true,
        success: function(gsajardineria) {
          jQuery('#divModal').html(gsajardineria);
        }
      })
    });
  })

  $(function() {
    $('.gsafumigacion').click(function() {
      var fum = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_fumigacion.php",
        data: 'option=' + fum,
        async: true,
        success: function(gsafumigacion) {
          jQuery('#divModal').html(gsafumigacion);
        }
      })
    });
  })

  $(function() {
    $('.gsapersonal').click(function() {
      var per = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_personal.php",
        data: 'option=' + per,
        async: true,
        success: function(gsapersonal) {
          jQuery('#divModal').html(gsapersonal);
        }
      })
    });
  })

  function duplicarSolicitud(tabla, var2, var3) {
    jQuery.ajax({
      type: "POST",
      url: "pages/gsa_actualizar.php",
      data: 'option=' + tabla + '-' + var2 + '-' + var3,
      async: true,
      success: function(duplicarSolicitud) {
        jQuery('#divIdSolicitudDuplica').html(duplicarSolicitud);
      }
    })
  }

  function enviarsolicitud(tabla, var2, var3) {
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

  function enviaverificaregis(tabla, var2, var3, var4, var5) {
    jQuery.ajax({
      type: "POST",
      url: "pages/gsa_actualizar.php",
      data: 'option=' + tabla + '-' + var2 + '-' + var3 + '-' + var4 + '-' + var5,
      async: true,
      success: function(html) {
        location.reload();
      }
    })
  }

  function enviaverificaPunto(tabla, var2, var3, var4, var5) {
    jQuery.ajax({
      type: "POST",
      url: "pages/gsa_actualizar.php",
      data: 'option=' + tabla + '-' + var2 + '-' + var3 + '-' + var4 + '-' + var5,
      async: true,
      success: function(html) {
        location.reload();
      }
    })
  }

  function enviadevolucionregis(tabla, var2, var3) {
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

  function enviadevolucionPunto(tabla, var2, var3) {
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

  function borrarSolicitudInsumo(tabla, var2, var3) {
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

  function borrarSolicitudMaquinaria(tabla, var2, var3) {
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

  function borrarSolicitudJardineria(tabla, var2, var3) {
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

  function borrarSolicitudFumigacion(tabla, var2, var3) {
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

  function borrarSolicitudPersonal(tabla, var2, var3) {
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

<!-- CONTROL DE SEGURIDAD COORDINADOR SUPERADMINISTRADOR OFICINA REGISTRO PUNTO UBICACION-->
<?php if (0 < $nump85 or 1 == $_SESSION['rol'] or (0 != $oficinaRegistro and 0 < privreg($oficinaRegistro, $idfun, 5, 10)) or 0 < $puntoUbicacion) { ?>

  <div class="box box-primary">
    <div class="box-header with-border">
      <a class="btn btn-xs btn-default" href="gsa_general&orden.jsp"><i class="fa fa-fw fa-mail-reply"></i> Regresar </a> &nbsp; &nbsp; &nbsp; &nbsp;
      <h3 class="box-title"><b>Orden: <?php echo $rows['numero_orden']; ?></b> - Solicitudes</h3>
    </div>
    <div class="box-body">

      <div class="table-responsive">
        <?php if (0 < $nump85 or 1 == $_SESSION['rol']) { ?>
          <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#nueva-solicitud">Nueva Solicitud</button><br><br>
        <?php } ?>
        <table class="table table-striped table-bordered table-hover" id="tableorden" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No Solicitud</th>
              <th>Fecha Inicio</th>
              <th>Fecha Final</th>
              <th>Fecha Registro</th>
              <th>Estado SNR</th>
              <th>Tipo Solicitud</th>
              <?php if (1 == $_SESSION['rol'] or 0 < $nump86 or 0 < $nump85) { ?>
                <th>Total</th>
              <?php } ?>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php
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
            gsa_solicitud.id_gsa_orden,
            gsa_solicitud.nombre_gsa_solicitud,
            gsa_solicitud.id_gsa_elemento,
            gsa_solicitud.id_gsa_solicitud,
            gsa_solicitud.fecha_inicio,
            gsa_solicitud.fecha_final,
            gsa_solicitud.fecha,
            gsa_solicitud.estado_snr
            FROM  gsa_solicitud
            WHERE gsa_solicitud.id_gsa_orden=$idOrden AND .gsa_solicitud.estado_gsa_solicitud=1 " . $infobus . " order by gsa_solicitud.id_gsa_solicitud DESC";
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
                echo '<td>' . $row['id_gsa_solicitud'] . '</td>';
                echo '<td>' .  $fechaInicio . '</td>';
                echo '<td>' . $fechaFinal . '</td>';
                echo '<td>' . $fechaRegistro . '</td>';

                if (0 == $row['estado_snr']) {
                  echo '<td> <span class="label label-danger">Pendiente</span></td>';
                } elseif (1 == $row['estado_snr']) {
                  echo '<td> <span class="label label-success">Enviada</span> </td>';
                }

                echo '<td>' . $row['nombre_gsa_solicitud'] . '</td>';

                if (1 == $_SESSION['rol'] or 0 < $nump86 or 0 < $nump85) {
                  if (1 == $row['id_gsa_elemento']) {
                    $esteIdSolicitud = $row['id_gsa_solicitud'];
                    $query2 = "SELECT 
                    gsa_solicitud.id_gsa_solicitud,
                    SUM(gsa_solicitud_insumo.cantidad_producto * gsa_producto.precio_unitario) AS total
                    FROM gsa_solicitud 
                    LEFT JOIN gsa_solicitud_insumo
                    ON gsa_solicitud.id_gsa_solicitud=gsa_solicitud_insumo.id_solicitud
                    LEFT JOIN gsa_producto
                    ON gsa_solicitud_insumo.id_gsa_producto=gsa_producto.id_gsa_producto
                    WHERE gsa_solicitud.id_gsa_solicitud = $esteIdSolicitud";
                    $select2 = mysql_query($query2, $conexion);
                    $row2 = mysql_fetch_row($select2);
                    echo '<td>$ ' . number_format($row2[1], 2, '.', ',') . '</td>';
                  }
                  if (2 == $row['id_gsa_elemento']) {
                    $esteIdSolicitud = $row['id_gsa_solicitud'];
                    $query2 = "SELECT 
                  gsa_solicitud.id_gsa_solicitud,
                  SUM(gsa_solicitud_maquinaria.cantidad_producto * gsa_maquinaria.precio_unitario) AS total
                  FROM gsa_solicitud 
                  LEFT JOIN gsa_solicitud_maquinaria
                  ON gsa_solicitud.id_gsa_solicitud=gsa_solicitud_maquinaria.id_solicitud
                  LEFT JOIN gsa_maquinaria
                  ON gsa_solicitud_maquinaria.id_gsa_maquinaria=gsa_maquinaria.id_gsa_maquinaria
                  WHERE gsa_solicitud.id_gsa_solicitud = $esteIdSolicitud";
                    $select2 = mysql_query($query2, $conexion);
                    $row2 = mysql_fetch_row($select2);
                    echo '<td>$ ' . number_format($row2[1], 2, '.', ',') . '</td>';
                  }
                  if (3 == $row['id_gsa_elemento']) {
                    $esteIdSolicitud = $row['id_gsa_solicitud'];
                    $query2 = "SELECT 
                  gsa_solicitud.id_gsa_solicitud,
                  SUM(gsa_solicitud_jardineria.valor_servicio) AS total
                  FROM gsa_solicitud 
                  LEFT JOIN gsa_solicitud_jardineria
                  ON gsa_solicitud.id_gsa_solicitud=gsa_solicitud_jardineria.id_solicitud
                  WHERE gsa_solicitud.id_gsa_solicitud = $esteIdSolicitud";
                    $select2 = mysql_query($query2, $conexion);
                    $row2 = mysql_fetch_row($select2);
                    echo '<td>$ ' . number_format($row2[1], 2, '.', ',') . '</td>';
                  }
                  if (4 == $row['id_gsa_elemento']) {
                    $esteIdSolicitud = $row['id_gsa_solicitud'];
                    $query2 = "SELECT 
                  gsa_solicitud.id_gsa_solicitud,
                  SUM(gsa_solicitud_fumigacion.valor_servicio) AS total
                  FROM gsa_solicitud 
                  LEFT JOIN gsa_solicitud_fumigacion
                  ON gsa_solicitud.id_gsa_solicitud=gsa_solicitud_fumigacion.id_solicitud
                  WHERE gsa_solicitud.id_gsa_solicitud = $esteIdSolicitud";
                    $select2 = mysql_query($query2, $conexion);
                    $row2 = mysql_fetch_row($select2);
                    echo '<td>$ ' . number_format($row2[1], 2, '.', ',') . '</td>';
                  }
                  if (5 == $row['id_gsa_elemento']) {
                    $esteIdSolicitud = $row['id_gsa_solicitud'];
                    $query2 = "SELECT 
                  gsa_solicitud.id_gsa_solicitud,
                  SUM(gsa_solicitud_personal.valor_personal) AS total
                  FROM gsa_solicitud 
                  LEFT JOIN gsa_solicitud_personal
                  ON gsa_solicitud.id_gsa_solicitud=gsa_solicitud_personal.id_solicitud
                  WHERE gsa_solicitud.id_gsa_solicitud = $esteIdSolicitud";
                    $select2 = mysql_query($query2, $conexion);
                    $row2 = mysql_fetch_row($select2);
                    echo '<td>$ ' . number_format($row2[1], 2, '.', ',') . '</td>';
                  }
                }


                if (0 < $nump85 or 1 == $_SESSION['rol']) {
                  echo '<td>';
                  // INSUMO 
                  if (1 == $row['id_gsa_elemento']) { ?>
                    <a class="gsaInsumos btn btn-xs bg-orange" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Insumo"><i class="fa fa-fw fa-coffee"></i></a>
                    <?php if (1 == $row['estado_snr']) { ?>
                      <a class="btn btn-xs btn-primary" onclick="duplicarSolicitud('duplicaSolicitud', <?php echo $row['id_gsa_solicitud']; ?>, <?php echo $row['id_gsa_elemento']; ?>)" style="cursor: pointer;" data-toggle="modal" data-target="#duplicar-solicitud" title="Duplicar"><i class="fa fa-fw fa-clone"></i></a>
                    <?php } ?>
                    <?php if (0 == $row['estado_snr']) { ?>
                      <button class="btn btn-xs btn-success" onclick="enviarsolicitud('enviasolicitud', <?php echo $row['id_gsa_solicitud']; ?>, 1)" title="Guarda Pedido" /><i class="fa fa-fw fa-save"></i></button>
                    <?php
                    }
                    if (0 < $nump86 or 1 == $_SESSION['rol']) {
                    ?>
                      <button class="btn btn-xs btn-danger" onclick="borrarSolicitudInsumo('borrarSolicitudInsumo', <?php echo $row['id_gsa_solicitud']; ?>, 0);" title="Borrar"><i class="fa fa-fw fa-trash"></i></button>
                    <?php
                    }
                  } // FIN INSUMOS

                  // MAQUINARIA 
                  if (2 == $row['id_gsa_elemento']) { ?>
                    <a class="gsamaquinaria btn btn-xs bg-orange" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Maquinaria"><i class="fa fa-fw fa-fax"></i></a>
                    <?php if (1 == $row['estado_snr']) { ?>
                      <a class="btn btn-xs btn-primary" onclick="duplicarSolicitud('duplicaSolicitud', <?php echo $row['id_gsa_solicitud']; ?>, <?php echo $row['id_gsa_elemento']; ?>)" style="cursor: pointer;" data-toggle="modal" data-target="#duplicar-solicitud" title="Duplicar"><i class="fa fa-fw fa-clone"></i></a>
                    <?php } ?>
                    <?php if (0 == $row['estado_snr']) { ?>
                      <button class="btn btn-xs btn-success" onclick="enviarsolicitud('enviasolicitud', <?php echo $row['id_gsa_solicitud']; ?>, 1)" title="Guarda Pedido" /><i class="fa fa-fw fa-save"></i></button>
                    <?php
                    }
                    if (0 < $nump86 or 1 == $_SESSION['rol']) {
                    ?>
                      <button class="btn btn-xs btn-danger" onclick="borrarSolicitudMaquinaria('borrarSolicitudMaquinaria', <?php echo $row['id_gsa_solicitud']; ?>, 0);" title="Borrar"><i class="fa fa-fw fa-trash"></i></button>
                    <?php
                    }
                  } // FIN MAQUINARIA

                  // JARDINERIA 
                  if (3 == $row['id_gsa_elemento']) { ?>
                    <a class="gsajardineria btn btn-xs bg-orange" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Jardineria"><i class="fa fa-fw fa-leaf"></i></a>
                    <?php if (1 == $row['estado_snr']) { ?>
                      <a class="btn btn-xs btn-primary" onclick="duplicarSolicitud('duplicaSolicitud', <?php echo $row['id_gsa_solicitud']; ?>, <?php echo $row['id_gsa_elemento']; ?>)" style="cursor: pointer;" data-toggle="modal" data-target="#duplicar-solicitud" title="Duplicar"><i class="fa fa-fw fa-clone"></i></a>
                    <?php } ?>
                    <?php if (0 == $row['estado_snr']) { ?>
                      <button class="btn btn-xs btn-success" onclick="enviarsolicitud('enviasolicitud', <?php echo $row['id_gsa_solicitud']; ?>, 1)" title="Guarda Pedido" /><i class="fa fa-fw fa-save"></i></button>
                    <?php
                    }
                    if (0 < $nump86 or 1 == $_SESSION['rol']) {
                    ?>
                      <button class="btn btn-xs btn-danger" onclick="borrarSolicitudJardineria('borrarSolicitudJardineria', <?php echo $row['id_gsa_solicitud']; ?>, 0);" title="Borrar"><i class="fa fa-fw fa-trash"></i></button>
                    <?php
                    }
                  } // FIN JARDINERIA

                  // FUMIGACION 
                  if (4 == $row['id_gsa_elemento']) { ?>
                    <a class="gsafumigacion btn btn-xs bg-orange" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Fumigacion"><i class="fa fa-fw fa-bug"></i></a>
                    <?php if (1 == $row['estado_snr']) { ?>
                      <a class="btn btn-xs btn-primary" onclick="duplicarSolicitud('duplicaSolicitud', <?php echo $row['id_gsa_solicitud']; ?>, <?php echo $row['id_gsa_elemento']; ?>)" style="cursor: pointer;" data-toggle="modal" data-target="#duplicar-solicitud" title="Duplicar"><i class="fa fa-fw fa-clone"></i></a>
                    <?php } ?>
                    <?php if (0 == $row['estado_snr']) { ?>
                      <button class="btn btn-xs btn-success" onclick="enviarsolicitud('enviasolicitud', <?php echo $row['id_gsa_solicitud']; ?>, 1)" title="Guarda Pedido" /><i class="fa fa-fw fa-save"></i></button>
                    <?php
                    }
                    if (0 < $nump86 or 1 == $_SESSION['rol']) {
                    ?>
                      <button class="btn btn-xs btn-danger" onclick="borrarSolicitudFumigacion('borrarSolicitudFumigacion', <?php echo $row['id_gsa_solicitud']; ?>, 0);" title="Borrar"><i class="fa fa-fw fa-trash"></i></button>
                    <?php
                    }
                  } // FIN FUMIGACION

                  // PERSONAL
                  if (5 == $row['id_gsa_elemento']) { ?>
                    <a class="gsapersonal btn btn-xs bg-orange" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Personal"><i class="fa fa-fw fa-users"></i></a>
                    <?php if (1 == $row['estado_snr']) { ?>
                      <a class="btn btn-xs btn-primary" onclick="duplicarSolicitud('duplicaSolicitud', <?php echo $row['id_gsa_solicitud']; ?>, <?php echo $row['id_gsa_elemento']; ?>)" style="cursor: pointer;" data-toggle="modal" data-target="#duplicar-solicitud" title="Duplicar"><i class="fa fa-fw fa-clone"></i></a>
                    <?php } ?>
                    <?php if (0 == $row['estado_snr']) { ?>
                      <button class="btn btn-xs btn-success" onclick="enviarsolicitud('enviasolicitud', <?php echo $row['id_gsa_solicitud']; ?>, 1)" title="Guarda Pedido" /><i class="fa fa-fw fa-save"></i></button>
                    <?php
                    }
                    if (0 < $nump86 or 1 == $_SESSION['rol']) {
                    ?>
                      <button class="btn btn-xs btn-danger" onclick="borrarSolicitudPersonal('borrarSolicitudPersonal', <?php echo $row['id_gsa_solicitud']; ?>, 0);" title="Borrar"><i class="fa fa-fw fa-trash"></i></button>
                      <?php
                    }
                  } // FIN PERSONAL

                  echo '</td>';
                } else {

                  echo '<td>';

                  // INSUMO 
                  if (1 == $row['id_gsa_elemento']) {
                    // CONSULTA QUE ESTE CON PERMISO EN OFICINA DE REGISTRO
                    if (0 != $oficinaRegistro) {
                      if (0 < privreg($oficinaRegistro, $idfun, 5, 10)) {
                        if (1 == $row['estado_snr']) { ?>
                          <a class="gsaInsumos btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión Oficina Registro"><i class="glyphicon glyphicon-search"></i></a>
                          <?php $iDsolicitud = $row['id_gsa_solicitud'];
                          $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                          LEFT JOIN gsa_sedes
                          ON gsa_verifica_solicitud.id_oficina_registro=gsa_sedes.id_oficina_registro
                          WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_oficina_registro=$oficinaRegistro";
                          $selectfun = mysql_query($consulfun, $conexion);
                          $rowfun = mysql_fetch_assoc($selectfun);
                          if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                            <button class="btn btn-xs btn-success" onclick="enviaverificaregis('enviaverificaregis', <?php echo $row['id_gsa_solicitud'] . ',' . $oficinaRegistro .  ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
                        <?php } else {
                            echo '<button class="btn btn-xs btn-success" title="Remision Enviada Satisfactoriamente" /><i class="fa fa-fw fa-check"></i></button>';
                          }
                        }
                      }
                    }
                    // CONSULTA QUE ESTE CON PERMISO EN PUNTOS DE UBICACION
                    if (0 < $puntoUbicacion) {
                      if (1 == $row['estado_snr']) { ?>
                        <a class="gsaInsumos btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión"><i class="glyphicon glyphicon-search"></i></a>
                        <?php $iDsolicitud = $row['id_gsa_solicitud'];
                        $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                        LEFT JOIN gsa_sedes
                        ON gsa_verifica_solicitud.id_punto_ubicacion=gsa_sedes.id_punto_ubicacion
                        WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_punto_ubicacion=$puntoUbicacion";
                        $selectfun = mysql_query($consulfun, $conexion);
                        $rowfun = mysql_fetch_assoc($selectfun);
                        if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                          <button class="btn btn-xs btn-success" onclick="enviaverificaPunto('enviaverificaPunto', <?php echo $row['id_gsa_solicitud'] . ','  . $puntoUbicacion . ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
                        <?php } else {
                          echo '<button class="btn btn-xs btn-success" title="Remision Enviada Satisfactoriamente" /><i class="fa fa-fw fa-check"></i></button>';
                        }
                      }
                    }
                  } // FIN INSUMO 

                  // MAQUINARIA 
                  if (2 == $row['id_gsa_elemento']) {
                    // CONSULTA QUE ESTE CON PERMISO EN OFICINA DE REGISTRO
                    if (0 != $oficinaRegistro) {
                      if (0 < privreg($oficinaRegistro, $idfun, 5, 10)) {
                        if (1 == $row['estado_snr']) { ?>
                          <a class="gsamaquinaria btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión"><i class="glyphicon glyphicon-search"></i></a>
                          <?php $iDsolicitud = $row['id_gsa_solicitud'];
                          $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                          LEFT JOIN gsa_sedes
                          ON gsa_verifica_solicitud.id_oficina_registro=gsa_sedes.id_oficina_registro
                          WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_oficina_registro=$oficinaRegistro";
                          $selectfun = mysql_query($consulfun, $conexion);
                          $rowfun = mysql_fetch_assoc($selectfun);
                          if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                            <button class="btn btn-xs btn-success" onclick="enviaverificaregis('enviaverificaregis', <?php echo $row['id_gsa_solicitud'] . ',' . $oficinaRegistro .  ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
                          <?php } elseif (1 == $rowfun['estado_gsa_verifica_solicitud']) { ?>
                            <button class="btn btn-xs bg-orange" onclick="enviadevolucionregis('enviadevolucionregis', <?php echo $row['id_gsa_solicitud'] ?>, 2)" title="Entrega Elementos Proveedor" /><i class="fa fa-fw fa-save"></i></button>
                        <?php
                          } elseif (2 == $rowfun['estado_gsa_verifica_solicitud']) {
                            echo '<button class="btn btn-xs btn-success" title="Elementos Entregados al Proveedor" /><i class="fa fa-fw fa-check"></i></button>';
                          }
                        }
                      }
                    }
                    // CONSULTA QUE ESTE CON PERMISO EN PUNTOS DE UBICACION
                    if (0 < $puntoUbicacion) {
                      if (1 == $row['estado_snr']) { ?>
                        <a class="gsamaquinaria btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión"><i class="glyphicon glyphicon-search"></i></a>
                        <?php $iDsolicitud = $row['id_gsa_solicitud'];
                        $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                        LEFT JOIN gsa_sedes
                        ON gsa_verifica_solicitud.id_punto_ubicacion=gsa_sedes.id_punto_ubicacion
                        WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_punto_ubicacion=$puntoUbicacion";
                        $selectfun = mysql_query($consulfun, $conexion);
                        $rowfun = mysql_fetch_assoc($selectfun);
                        if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                          <button class="btn btn-xs btn-success" onclick="enviaverificaPunto('enviaverificaPunto', <?php echo $row['id_gsa_solicitud'] . ','  . $puntoUbicacion . ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
                        <?php } elseif (1 == $rowfun['estado_gsa_verifica_solicitud']) { ?>
                          <button class="btn btn-xs bg-orange" onclick="enviadevolucionPunto('enviadevolucionPunto', <?php echo $row['id_gsa_solicitud'] ?>, 2)" title="Entrega Elementos Proveedor" /><i class="fa fa-fw fa-save"></i></button>
                        <?php
                        } elseif (2 == $rowfun['estado_gsa_verifica_solicitud']) {
                          echo '<button class="btn btn-xs btn-success" title="Elementos Entregados al Proveedor" /><i class="fa fa-fw fa-check"></i></button>';
                        }
                      }
                    }
                  } // FIN MAQUINARIA

                  // JARDINERIA 
                  if (3 == $row['id_gsa_elemento']) {
                    // CONSULTA QUE ESTE CON PERMISO EN OFICINA DE REGISTRO
                    if (0 != $oficinaRegistro) {
                      if (0 < privreg($oficinaRegistro, $idfun, 5, 10)) {
                        if (1 == $row['estado_snr']) { ?>
                          <a class="gsajardineria btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión"><i class="glyphicon glyphicon-search"></i></a>
                          <?php $iDsolicitud = $row['id_gsa_solicitud'];
                          $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                          LEFT JOIN gsa_sedes
                          ON gsa_verifica_solicitud.id_oficina_registro=gsa_sedes.id_oficina_registro
                          WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_oficina_registro=$oficinaRegistro";
                          $selectfun = mysql_query($consulfun, $conexion);
                          $rowfun = mysql_fetch_assoc($selectfun);
                          if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                            <button class="btn btn-xs btn-success" onclick="enviaverificaregis('enviaverificaregis', <?php echo $row['id_gsa_solicitud'] . ',' . $oficinaRegistro .  ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
                        <?php } elseif (1 == $rowfun['estado_gsa_verifica_solicitud']) {
                            echo '<button class="btn btn-xs btn-success" title="Servicio Realizado" /><i class="fa fa-fw fa-check"></i></button>';
                          }
                        }
                      }
                    }
                    // CONSULTA QUE ESTE CON PERMISO EN PUNTOS DE UBICACION
                    if (0 < $puntoUbicacion) {
                      if (1 == $row['estado_snr']) { ?>
                        <a class="gsajardineria btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión"><i class="glyphicon glyphicon-search"></i></a>
                        <?php $iDsolicitud = $row['id_gsa_solicitud'];
                        $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                        LEFT JOIN gsa_sedes
                        ON gsa_verifica_solicitud.id_punto_ubicacion=gsa_sedes.id_punto_ubicacion
                        WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_punto_ubicacion=$puntoUbicacion";
                        $selectfun = mysql_query($consulfun, $conexion);
                        $rowfun = mysql_fetch_assoc($selectfun);
                        if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                          <button class="btn btn-xs btn-success" onclick="enviaverificaPunto('enviaverificaPunto', <?php echo $row['id_gsa_solicitud'] . ','  . $puntoUbicacion . ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
                        <?php } elseif (1 == $rowfun['estado_gsa_verifica_solicitud']) {
                          echo '<button class="btn btn-xs btn-success" title="Servicio Realizado" /><i class="fa fa-fw fa-check"></i></button>';
                        }
                      }
                    }
                  } // FIN JARDINERIA

                  // FUMIGACION 
                  if (4 == $row['id_gsa_elemento']) {
                    // CONSULTA QUE ESTE CON PERMISO EN OFICINA DE REGISTRO
                    if (0 != $oficinaRegistro) {
                      if (0 < privreg($oficinaRegistro, $idfun, 5, 10)) {
                        if (1 == $row['estado_snr']) { ?>
                          <a class="gsafumigacion btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión"><i class="glyphicon glyphicon-search"></i></a>
                          <?php $iDsolicitud = $row['id_gsa_solicitud'];
                          $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                          LEFT JOIN gsa_sedes
                          ON gsa_verifica_solicitud.id_oficina_registro=gsa_sedes.id_oficina_registro
                          WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_oficina_registro=$oficinaRegistro";
                          $selectfun = mysql_query($consulfun, $conexion);
                          $rowfun = mysql_fetch_assoc($selectfun);
                          if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                            <button class="btn btn-xs btn-success" onclick="enviaverificaregis('enviaverificaregis', <?php echo $row['id_gsa_solicitud'] . ',' . $oficinaRegistro .  ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
                        <?php } elseif (1 == $rowfun['estado_gsa_verifica_solicitud']) {
                            echo '<button class="btn btn-xs btn-success" title="Servicio Realizado" /><i class="fa fa-fw fa-check"></i></button>';
                          }
                        }
                      }
                    }
                    // CONSULTA QUE ESTE CON PERMISO EN PUNTOS DE UBICACION
                    if (0 < $puntoUbicacion) {
                      if (1 == $row['estado_snr']) { ?>
                        <a class="gsafumigacion btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión"><i class="glyphicon glyphicon-search"></i></a>
                        <?php $iDsolicitud = $row['id_gsa_solicitud'];
                        $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                        LEFT JOIN gsa_sedes
                        ON gsa_verifica_solicitud.id_punto_ubicacion=gsa_sedes.id_punto_ubicacion
                        WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_punto_ubicacion=$puntoUbicacion";
                        $selectfun = mysql_query($consulfun, $conexion);
                        $rowfun = mysql_fetch_assoc($selectfun);
                        if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                          <button class="btn btn-xs btn-success" onclick="enviaverificaPunto('enviaverificaPunto', <?php echo $row['id_gsa_solicitud'] . ','  . $puntoUbicacion . ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
                        <?php } elseif (1 == $rowfun['estado_gsa_verifica_solicitud']) {
                          echo '<button class="btn btn-xs btn-success" title="Servicio Realizado" /><i class="fa fa-fw fa-check"></i></button>';
                        }
                      }
                    }
                  } // FIN FUMIGACION


                  // PERSONAL
                  if (5 == $row['id_gsa_elemento']) {
                    // CONSULTA QUE ESTE CON PERMISO EN OFICINA DE REGISTRO
                    if (0 != $oficinaRegistro) {
                      if (0 < privreg($oficinaRegistro, $idfun, 5, 10)) {
                        if (1 == $row['estado_snr']) { ?>
                          <a class="gsapersonal btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión"><i class="glyphicon glyphicon-search"></i></a>
                          <?php $iDsolicitud = $row['id_gsa_solicitud'];
                          $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                          LEFT JOIN gsa_sedes
                          ON gsa_verifica_solicitud.id_oficina_registro=gsa_sedes.id_oficina_registro
                          WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_oficina_registro=$oficinaRegistro";
                          $selectfun = mysql_query($consulfun, $conexion);
                          $rowfun = mysql_fetch_assoc($selectfun);
                          if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                            <button class="btn btn-xs btn-success" onclick="enviaverificaregis('enviaverificaregis', <?php echo $row['id_gsa_solicitud'] . ',' . $oficinaRegistro .  ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
                        <?php } elseif (1 == $rowfun['estado_gsa_verifica_solicitud']) {
                            echo '<button class="btn btn-xs btn-success" title="Servicio Realizado" /><i class="fa fa-fw fa-check"></i></button>';
                          }
                        }
                      }
                    }
                    // CONSULTA QUE ESTE CON PERMISO EN PUNTOS DE UBICACION
                    if (0 < $puntoUbicacion) {
                      if (1 == $row['estado_snr']) { ?>
                        <a class="gsapersonal btn btn-xs btn-info" id="<?php echo $row['id_gsa_solicitud']; ?>" style="cursor: pointer;" data-target="#id-modal" title="Detalle Remisión"><i class="glyphicon glyphicon-search"></i></a>
                        <?php $iDsolicitud = $row['id_gsa_solicitud'];
                        $consulfun = "SELECT estado_gsa_verifica_solicitud FROM gsa_verifica_solicitud
                        LEFT JOIN gsa_sedes
                        ON gsa_verifica_solicitud.id_punto_ubicacion=gsa_sedes.id_punto_ubicacion
                        WHERE id_gsa_solicitud=$iDsolicitud AND gsa_sedes.id_punto_ubicacion=$puntoUbicacion";
                        $selectfun = mysql_query($consulfun, $conexion);
                        $rowfun = mysql_fetch_assoc($selectfun);
                        if (is_null($rowfun['estado_gsa_verifica_solicitud'])) { ?>
                          <button class="btn btn-xs btn-success" onclick="enviaverificaPunto('enviaverificaPunto', <?php echo $row['id_gsa_solicitud'] . ','  . $puntoUbicacion . ',' . $idfun; ?>, 1)" title="Guarda Remisión" /><i class="fa fa-fw fa-save"></i></button>
            <?php } elseif (1 == $rowfun['estado_gsa_verifica_solicitud']) {
                          echo '<button class="btn btn-xs btn-success" title="Servicio Realizado" /><i class="fa fa-fw fa-check"></i></button>';
                        }
                      }
                    }
                  } // FIN PERSONAL

                  echo '</td>';
                }
                echo '</tr>';
              } while ($row = mysql_fetch_assoc($select));
              mysql_free_result($select);
            } ?>

            <script>
              $(document).ready(function() {
                $('#tableorden').DataTable({
                  "lengthMenu": [
                    [100, 200, 300, 500],
                    [100, 200, 300, 500]
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
  </div>

<?php } ?>
<!-- FINAL DE SEGURIDAD -->

<!-- NUEVA SOLICITUD -->
<div class="modal fade" id="nueva-solicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Nueva Solicitud</b></h5>
      </div>
      <div class="modal-body">
        <form name="nuevasolicitud" method="POST">
          <div class="row">

            <div class="col-md-4">
              <label>TIPO SOLICITUD</label>
            </div>
            <div class="col-md-8">
              <select name="elementoSolicitud" class="form-control">
                <option selected></option>
                <option value="1">INSUMO</option>
                <option value="2">MAQUINARIA</option>
                <option value="3">JARDINERIA</option>
                <option value="4">FUMIGACION</option>
                <option value="5">PERSONAL</option>
              </select><br>
            </div>

            <div class="col-md-4">
              <label>Fecha Inicio</label>
            </div>
            <div class="col-md-8">
              <input type="date" class="form-control" name="fecha_inicio"><br>
            </div>

            <div class="col-md-4">
              <label>Fechal Final</label>
            </div>
            <div class="col-md-8">
              <input type="date" class="form-control" name="fecha_final"><br>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <input type="submit" name="nuevaSolicitud" class="btn btn-success" value="Guardar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- DUPLICAR SOLICITUD -->
<div class="modal fade" id="duplicar-solicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Duplicar Solicitud</b></h5>
      </div>
      <div class="modal-body">
        <p>Colocar el nuevo periodo</p>
        <form name="duplicaSolicitud" method="POST">
          <div id="divIdSolicitudDuplica">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <input type="submit" name="duplicaSolicitud" class="btn btn-success" value="Guardar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- 
DIV INSUMO 
DIV MAQUINARIA
-->
<div id="id-modal">
  <div id="divModal">

  </div>
</div>
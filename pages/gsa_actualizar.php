<?php
include '../conf.php';
if (isset($_POST['option']) and "" != $_POST['option']) {

  $division = explode("-", $_POST['option']);
  if (isset($division[0])) { $tabla = $division[0]; } else { $tabla=''; } // TABLA
  if (isset($division[1])) { $var2 = $division[1]; } else { $var2=''; } // ID
  if (isset($division[2])) { $var3 = $division[2]; } else { $var3=''; } // CANTIDAD
  if (isset($division[3])) { $var4 = $division[3]; } else { $var4=''; } // PARA AUDITAR
  if (isset($division[4])) { $var5 = $division[4]; } else { $var5=''; } // PARA AUDITAR

  if ("cantidad_insumo" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_insumo SET 
    cantidad_producto=%s,
    actualiza=%s
    WHERE id_gsa_solicitud_insumo=$var2 ",
      GetSQLValueString($var3, "text"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("verifica_insumo" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_insumo SET 
    cantidad_verifica=%s,
    actualiza=%s
    WHERE id_gsa_solicitud_insumo=$var2 ",
      GetSQLValueString($var3, "text"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("verifica_personal" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_sedes SET 
    cantidad_personal=%s,
    actualiza=%s
    WHERE id_gsa_sedes=$var2 ",
      GetSQLValueString($var3, "text"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    // mysql_free_result($result);

  } elseif ("cantidad_maquinaria" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_maquinaria SET 
      cantidad_producto=%s,
      actualiza=%s
      WHERE id_gsa_solicitud_maquinaria=$var2 ",
      GetSQLValueString($var3, "text"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("verifica_maquinaria" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_maquinaria SET 
      cantidad_verifica=%s,
      actualiza=%s
      WHERE id_gsa_solicitud_maquinaria=$var2 ",
      GetSQLValueString($var3, "text"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("serial_maquinaria" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_maquinaria SET 
      serial_maquinaria=%s,
      actualiza=%s
      WHERE id_gsa_solicitud_maquinaria=$var2 ",
      GetSQLValueString($var3, "text"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("valorServicio" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_jardineria SET 
      valor_servicio=%s,
      actualiza=%s
      WHERE id_gsa_solicitud_jardineria=$var3 ",
      GetSQLValueString($var2, "int"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("DiasTrabajados" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_personal SET 
      dias_trabajados=%s,
      actualiza=%s
      WHERE id_gsa_solicitud_personal=$var3 ",
      GetSQLValueString($var2, "int"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);
  
  } elseif ("nombreOperario" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_solicitud_personal SET 
      nombre_operario=%s
      WHERE id_gsa_solicitud_personal=$var3 ",
      GetSQLValueString($var2, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("cedulaOperario" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_solicitud_personal SET 
      cedula_operario=%s
      WHERE id_gsa_solicitud_personal=$var3 ",
      GetSQLValueString($var2, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("salariodepersonal" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_solicitud_personal SET 
      valor_personal=%s
      WHERE id_gsa_solicitud_personal=$var3 ",
      GetSQLValueString($var2, "int")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("Observacion" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_verifica_solicitud SET 
      observacion=%s,
      estado_observacion=%s
      WHERE id_gsa_verifica_solicitud=$var3 ",
      GetSQLValueString($var2, "text"),
      GetSQLValueString($var4, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("EditarObservacion" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_verifica_solicitud SET 
      estado_observacion=%s
      WHERE id_gsa_verifica_solicitud=$var2 ",
      GetSQLValueString($var3, "int")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("valorServicioFumigacion" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_fumigacion SET 
      valor_servicio=%s,
      actualiza=%s
      WHERE id_gsa_solicitud_fumigacion=$var3 ",
      GetSQLValueString($var2, "int"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("nombrePersonal" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_jardineria SET 
      nombre_personal=%s,
      actualiza=%s
      WHERE id_gsa_solicitud_jardineria=$var3 ",
      GetSQLValueString($var2, "text"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("nombrePersonalFumigacion" == $tabla) {

    date_default_timezone_set("America/Bogota");
    $FActualiza = date("Y-m-d H:i:sa");
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_fumigacion SET 
      nombre_personal=%s,
      actualiza=%s
      WHERE id_gsa_solicitud_fumigacion=$var3 ",
      GetSQLValueString($var2, "text"),
      GetSQLValueString($FActualiza, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("fechaentregamaquina" == $tabla) {

    $fecha = explode("/", $var3);
    echo $fecha[0];
    echo $fecha[1];
    echo $fecha[2];
    if (is_numeric($fecha[0]) and is_numeric($fecha[1]) and is_numeric($fecha[2])) {
      $var3 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
      echo $var3;
    } else {
      $var3 = '';
    }
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_maquinaria SET 
    fecha_entrega=%s
    WHERE id_gsa_solicitud_maquinaria=$var2 ",
      GetSQLValueString($var3, "date")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);
  
  } elseif ("fechaPrograma" == $tabla) {

    $fecha = explode("/", $var2);
    echo $fecha[0];
    echo $fecha[1];
    echo $fecha[2];
    if (is_numeric($fecha[0]) and is_numeric($fecha[1]) and is_numeric($fecha[2])) {
      $var2 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
      echo $var2;
    } else {
      $var2 = '';
    }
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_jardineria SET 
    fecha_programa=%s
    WHERE id_gsa_solicitud_jardineria=$var3",
      GetSQLValueString($var2, "date")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("fechaProgramaFumigacion" == $tabla) {

    $fecha = explode("/", $var2);
    echo $fecha[0];
    echo $fecha[1];
    echo $fecha[2];
    if (is_numeric($fecha[0]) and is_numeric($fecha[1]) and is_numeric($fecha[2])) {
      $var2 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
      echo $var2;
    } else {
      $var2 = '';
    }
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_fumigacion SET 
    fecha_programa=%s
    WHERE id_gsa_solicitud_fumigacion=$var3",
      GetSQLValueString($var2, "date")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("fechaRealiza" == $tabla) {

    $fecha = explode("/", $var2);
    echo $fecha[0];
    echo $fecha[1];
    echo $fecha[2];
    if (is_numeric($fecha[0]) and is_numeric($fecha[1]) and is_numeric($fecha[2])) {
      $var2 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
      echo $var2;
    } else {
      $var2 = '';
    }
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_jardineria SET 
    fecha_realiza=%s
    WHERE id_gsa_solicitud_jardineria=$var3",
      GetSQLValueString($var2, "date")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("fechaRealizaFumigacion" == $tabla) {

    $fecha = explode("/", $var2);
    echo $fecha[0];
    echo $fecha[1];
    echo $fecha[2];
    if (is_numeric($fecha[0]) and is_numeric($fecha[1]) and is_numeric($fecha[2])) {
      $var2 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
      echo $var2;
    } else {
      $var2 = '';
    }
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_fumigacion SET 
    fecha_realiza=%s
    WHERE id_gsa_solicitud_fumigacion=$var3",
      GetSQLValueString($var2, "date")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);
  
  } elseif ("fechadevolucionmaquina" == $tabla) {

    $fecha = explode("/", $var3);
    echo $fecha[0];
    echo $fecha[1];
    echo $fecha[2];
    if (is_numeric($fecha[0]) and is_numeric($fecha[1]) and is_numeric($fecha[2])) {
      $var3 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
      echo $var3;
    } else {
      $var3 = '';
    }
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_maquinaria SET 
    fecha_devolucion=%s
    WHERE id_gsa_solicitud_maquinaria=$var2 ",
      GetSQLValueString($var3, "date")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("fechaIngresoOperario" == $tabla) {

    $fecha = explode("/", $var2);
    echo $fecha[0];
    echo $fecha[1];
    echo $fecha[2];
    if (is_numeric($fecha[0]) and is_numeric($fecha[1]) and is_numeric($fecha[2])) {
      $var2 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
      echo $var2;
    } else {
      $var2 = '';
    }
    $actualiza = sprintf(
      "UPDATE gsa_solicitud_personal SET 
    fecha_ingreso_operario=%s
    WHERE id_gsa_solicitud_personal=$var3",
      GetSQLValueString($var2, "date")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("enviasolicitud" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_solicitud SET 
    estado_snr=%s WHERE id_gsa_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("enviaverificaregis" == $tabla) {

    $insertSQL = sprintf(
      "INSERT INTO gsa_verifica_solicitud (
    id_gsa_solicitud,  
    id_oficina_registro,
    id_funcionario,
    fecha_verificado,            
    estado_gsa_verifica_solicitud
    ) VALUES (%s,%s,%s,now(),%s)",
      GetSQLValueString($var2, "int"),
      GetSQLValueString($var3, "int"),
      GetSQLValueString($var4, "int"),
      GetSQLValueString($var5, "int")
    );
    $result = mysql_query($insertSQL, $conexion);
    mysql_free_result($result);
    echo $insertado;
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';

  } elseif ("enviaverificaPunto" == $tabla) {

    $insertSQL = sprintf(
      "INSERT INTO gsa_verifica_solicitud (
      id_gsa_solicitud,  
      id_punto_ubicacion,
      id_funcionario,
      fecha_verificado,         
      estado_gsa_verifica_solicitud
      ) VALUES (%s,%s,%s,now(),%s)",
      GetSQLValueString($var2, "int"),
      GetSQLValueString($var3, "int"),
      GetSQLValueString($var4, "int"),
      GetSQLValueString($var5, "int")
    );
    $result = mysql_query($insertSQL, $conexion);
    mysql_free_result($result);
    echo $insertado;
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';

  } elseif ("enviadevolucionregis" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_verifica_solicitud SET 
    estado_gsa_verifica_solicitud=%s WHERE id_gsa_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("enviadevolucionPunto" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_verifica_solicitud SET 
    estado_gsa_verifica_solicitud=%s WHERE id_gsa_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("sedes" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_sedes SET 
      estado_gsa_sedes=%s WHERE id_gsa_sedes=$var2 ",
      GetSQLValueString($var3, "int")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);
  
  } elseif ("eliminarTodosProductos" == $tabla) {

    $var3=0;
    $actualiza = sprintf(
      "UPDATE gsa_producto SET 
      estado_gsa_producto=%s WHERE id_gsa_orden=$var2 ",
      GetSQLValueString($var3, "int")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("eliminarTodoMaquinaria" == $tabla) {

    $var3=0;
    $actualiza = sprintf(
      "UPDATE gsa_maquinaria SET 
      estado_gsa_maquinaria=%s WHERE id_gsa_orden=$var2 ",
      GetSQLValueString($var3, "int")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);
  
  } elseif ("servicioJardineria" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_sedes SET 
      estado_jardineria=%s WHERE id_gsa_sedes=$var2 ",
      GetSQLValueString($var3, "int")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("servicioFumigacion" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_sedes SET 
      estado_fumigacion=%s WHERE id_gsa_sedes=$var2 ",
      GetSQLValueString($var3, "int")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("servicioPersonal" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_sedes SET 
      estado_personal=%s WHERE id_gsa_sedes=$var2 ",
      GetSQLValueString($var3, "int")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("producto" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_producto SET 
      estado_gsa_producto=%s WHERE id_gsa_producto=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("maquinaria" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_maquinaria SET 
      estado_gsa_maquinaria=%s WHERE id_gsa_maquinaria=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("proveedor" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_proveedor SET 
      estado_gsa_proveedor=%s WHERE id_gsa_proveedor=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

  } elseif ("editamosProducto" == $tabla) {

    $ConsultaPro = "SELECT id_gsa_producto, numero_producto, bien_producto, especificacion_producto, presentacion_producto, cantidad_mensual, precio_unitario FROM gsa_producto WHERE id_gsa_producto=$var2";
    $selectpro = mysql_query($ConsultaPro, $conexion);
    $rowpro = mysql_fetch_assoc($selectpro);?>
    <div class="modal-body">
      <input type="hidden" name="id_gsa_producto" value="<?php echo $var2 ?>" required>
      <label>Numero Secop</label>
      <input type="number" class="form-control" name="numero_producto" value="<?php echo $rowpro['numero_producto'] ?>" required>
      <label>Nombre Producto</label>
      <input type="text" class="form-control" name="bien_producto" value="<?php echo $rowpro['bien_producto'] ?>" required>
      <label>Especificación Producto</label>
      <textarea name="especificacion_producto" class="form-control" cols="10" rows="5" required><?php echo $rowpro['especificacion_producto'] ?></textarea>
      <label>Presentación Producto</label>
      <textarea name="presentacion_producto" class="form-control" cols="10" rows="5" required><?php echo $rowpro['presentacion_producto'] ?></textarea>
      <label>Cantidad Mensual</label>
      <input type="number" class="form-control" name="cantidad_mensual" value="<?php echo $rowpro['cantidad_mensual'] ?>" required>
      <label>Precio Unitario</label>
      <input type="text" class="form-control" name="precio_unitario" value="<?php echo $rowpro['precio_unitario'] ?>" required>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
      <input class="btn btn-success" type="submit" name="actualizarproducto" value="Actualizar">
    </div><?php

  } elseif ("editamosArticulo" == $tabla) {

    $ConsultaPro = "SELECT id_gsa_orden_articulo, nombre_gsa_orden_articulo, cantidad, unidad, precio FROM gsa_orden_articulo WHERE id_gsa_orden_articulo=$var2";
    $selectpro = mysql_query($ConsultaPro, $conexion);
    $rowpro = mysql_fetch_assoc($selectpro);?>
    <div class="modal-body">
      <input type="hidden" name="id_gsa_orden_articulo" value="<?php echo $var2 ?>" required>
      <div class="row">
        <div class="col-md-4">
          <label>Nombre Articulo</label>
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" name="nombre_gsa_orden_articulo" value="<?php echo $rowpro['nombre_gsa_orden_articulo'] ?>" required><br>
        </div>

        <div class="col-md-4">
          <label>Cantidad</label>
        </div>
        <div class="col-md-8">
          <input type="number" class="form-control" name="cantidad" value="<?php echo $rowpro['cantidad'] ?>" required><br>
        </div>

        <div class="col-md-4">
          <label>Unidad</label>
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" name="unidad" value="<?php echo $rowpro['unidad'] ?>" required><br>
        </div>

        <div class="col-md-4">
          <label>Precio</label>
        </div>
        <div class="col-md-8">
          <input type="text" class="gsamoneda form-control" name="precio" value="<?php echo $rowpro['precio'] ?>" required><br>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
      <input class="btn btn-success" type="submit" name="actualizarArticulo" value="Actualizar">
    </div><?php 
    
  } elseif ("editamosMaquinaria" == $tabla) {

    $ConsultaPro = "SELECT id_gsa_maquinaria, numero_maquinaria, bien_maquinaria, especificacion_maquinaria, presentacion_maquinaria, cantidad_mensual, precio_unitario FROM gsa_maquinaria WHERE id_gsa_maquinaria=$var2";
    $selectpro = mysql_query($ConsultaPro, $conexion);
    $rowpro = mysql_fetch_assoc($selectpro);?>
    <div class="modal-body">
      <input type="hidden" name="id_gsa_maquinaria" value="<?php echo $var2 ?>" required>
      <label>Numero Secop</label>
      <input type="number" class="form-control" name="numero_maquinaria" value="<?php echo $rowpro['numero_maquinaria'] ?>" required>
      <label>Nombre Maquinaria</label>
      <input type="text" class="form-control" name="bien_maquinaria" value="<?php echo $rowpro['bien_maquinaria'] ?>" required>
      <label>Especificación Maquinaria</label>
      <textarea name="especificacion_maquinaria" class="form-control" cols="10" rows="5" required><?php echo $rowpro['especificacion_maquinaria'] ?></textarea>
      <label>Presentación Maquinaria</label>
      <textarea name="presentacion_maquinaria" class="form-control" cols="10" rows="5" required><?php echo $rowpro['presentacion_maquinaria'] ?></textarea>
      <label>Cantidad Mensual</label>
      <input type="number" class="form-control" name="cantidad_mensual" value="<?php echo $rowpro['cantidad_mensual'] ?>" required>
      <label>Precio Unitario</label>
      <input type="text" class="form-control" name="precio_unitario" value="<?php echo $rowpro['precio_unitario'] ?>" required>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
      <input class="btn btn-success" type="submit" name="actualizarmaquinaria" value="Actualizar">
    </div><?php

  } elseif ("editamosProveedor" == $tabla) {

    $ConsultaProve = "SELECT * FROM gsa_proveedor WHERE id_gsa_proveedor=$var2";
    $selectprove = mysql_query($ConsultaProve, $conexion);
    $rowprove = mysql_fetch_assoc($selectprove);?>
    <div class="modal-body">
      <input type="hidden" name="id_gsa_proveedor" value="<?php echo $var2 ?>" required>
      <label>Nombre del Proveedor</label>
      <input type="text" class="form-control" name="nombre_gsa_proveedor" value="<?php echo $rowprove['nombre_gsa_proveedor'] ?>" required>
      <label>Nit</label>
      <div class="row">
        <div class="col-md-10">
          <input type="number" class="form-control" name="nit_proveedor" value="<?php echo $rowprove['nit_proveedor'] ?>" required>
        </div>
        <div class="col-md-2">
          <select name="digito_verificacion" class="form-control" required>
            <option value="<?php echo $rowprove['digito_verificacion'] ?>" selected><?php echo $rowprove['digito_verificacion'] ?></option>
            <option value="">-</option>
            <?php for ($i = 0; $i < 10; $i++) {
              echo "<option value=" . $i . ">" . $i . "</option>";
            } ?>
          </select>
        </div>
      </div>
      <label>Representante Legal</label>
      <input type="text" class="form-control" name="representante_legal" value="<?php echo $rowprove['representante_legal'] ?>" required>
      <label>Cedula Representante</label>
      <input type="number" class="form-control" name="cedula_representante" value="<?php echo $rowprove['cedula_representante'] ?>" required>
      <label>Nombre Contacto</label>
      <input type="text" class="form-control" name="nombre_contacto_1" value="<?php echo $rowprove['nombre_contacto_1'] ?>">
      <label>Numero Contacto</label>
      <input type="text" class="form-control" name="telefono_contacto_1" value="<?php echo $rowprove['telefono_contacto_1'] ?>" required>
      <label>Email Contacto</label>
      <input type="email" class="form-control" name="correo_contacto_1" value="<?php echo $rowprove['correo_contacto_1'] ?>" required>
      <label>Nombre Contacto Opcional</label>
      <input type="text" class="form-control" name="nombre_contacto_2" value="<?php echo $rowprove['nombre_contacto_2'] ?>">
      <label>Numero Contacto Opcional</label>
      <input type="text" class="form-control" name="telefono_contacto_2" value="<?php echo $rowprove['telefono_contacto_2'] ?>">
      <label>Email Contacto Opcional</label>
      <input type="email" class="form-control" name="correo_contacto_2" value="<?php echo $rowprove['correo_contacto_2'] ?>">
      <label>Direccion</label>
      <input type="text" class="form-control" name="direccion" value="<?php echo $rowprove['direccion'] ?>" required>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
      <input class="btn btn-success" type="submit" name="actualizarproveedor" value="Actualizar">
    </div><?php

  } elseif ("borrarSolicitudInsumo" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_solicitud SET 
      estado_gsa_solicitud=%s WHERE id_gsa_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

    $actualizadeta = sprintf(
      "UPDATE gsa_solicitud_insumo SET 
      estado_gsa_solicitud_insumo=%s WHERE id_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $resultde = mysql_query($actualizadeta, $conexion);
    mysql_free_result($resultde);
    echo $borrado;
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';

  } elseif ("borrarSolicitudMaquinaria" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_solicitud SET 
      estado_gsa_solicitud=%s WHERE id_gsa_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

    $actualizadeta = sprintf(
      "UPDATE gsa_solicitud_maquinaria SET 
      estado_gsa_solicitud_maquinaria=%s WHERE id_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $resultde = mysql_query($actualizadeta, $conexion);
    mysql_free_result($resultde);
    echo $borrado;
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';

  } elseif ("borrarSolicitudJardineria" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_solicitud SET 
      estado_gsa_solicitud=%s WHERE id_gsa_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

    $actualizadeta = sprintf(
      "UPDATE gsa_solicitud_jardineria SET 
      estado_gsa_solicitud_jardineria=%s WHERE id_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $resultde = mysql_query($actualizadeta, $conexion);
    mysql_free_result($resultde);
    echo $borrado;
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';

  } elseif ("borrarSolicitudFumigacion" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_solicitud SET 
      estado_gsa_solicitud=%s WHERE id_gsa_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

    $actualizadeta = sprintf(
      "UPDATE gsa_solicitud_fumigacion SET 
      estado_gsa_solicitud_fumigacion=%s WHERE id_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $resultde = mysql_query($actualizadeta, $conexion);
    mysql_free_result($resultde);
    echo $borrado;
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';

  } elseif ("borrarSolicitudPersonal" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_solicitud SET 
      estado_gsa_solicitud=%s WHERE id_gsa_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

    $actualizadeta = sprintf(
      "UPDATE gsa_solicitud_personal SET 
      estado_gsa_solicitud_personal=%s WHERE id_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $resultde = mysql_query($actualizadeta, $conexion);
    mysql_free_result($resultde);
    echo $borrado;
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';

  } elseif ("borrararticulo" == $tabla) {

    $actualiza = sprintf(
      "UPDATE gsa_orden_articulo SET 
      estado_gsa_orden_articulo=%s WHERE id_gsa_orden_articulo=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $result = mysql_query($actualiza, $conexion);
    mysql_free_result($result);

    $actualizadeta = sprintf(
      "UPDATE gsa_solicitud_insumo SET 
      estado_gsa_solicitud_insumo=%s WHERE id_solicitud=$var2 ",
      GetSQLValueString($var3, "text")
    );
    $resultde = mysql_query($actualizadeta, $conexion);
    mysql_free_result($resultde);
    echo $borrado;
    echo '<meta http-equiv="refresh" content="0;URL=gsa_general_detalle&' . $idOrden . '.jsp" />';

  } elseif ("duplicaSolicitud" == $tabla) { ?>
  
    <input type="hidden" class="form-control" name="id_solicitud_duplicar" value="<?php echo $var2; ?>"/>
    <input type="hidden" class="form-control" name="id_gsa_elemento" value="<?php echo $var3; ?>"/>
    <div class="row">
      <div class="col-md-4">
        <label>Fecha Inicio</label>
      </div>
      <div class="col-md-8">
        <input type="date" class="form-control" name="fecha_inicio_duplica"><br>
      </div>
      <div class="col-md-4">
        <label>Fechal Final</label>
      </div>
      <div class="col-md-8">
        <input type="date" class="form-control" name="fecha_final_duplica"><br>
      </div>
    </div><?php

  }

}
?>
<script>
// Funcion para no duplicar envios de formularios
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
</script>
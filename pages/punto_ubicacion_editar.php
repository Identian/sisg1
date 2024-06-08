<?php
include '../conf.php';
if (isset($_POST['option']) and "" != $_POST['option']) {

  $division = explode("-", $_POST['option']);
  $tabla = $division[0]; // TABLA
  $var2 = $division[1]; // ID

  if ("editarpuntoubicacion" == $tabla) { 

    $query = "SELECT * FROM punto_ubicacion WHERE id_punto_ubicacion=$var2 AND estado_punto_ubicacion=1";
    $select = mysql_query($query, $conexion);
    $row = mysql_fetch_assoc($select);
    echo '<input type="hidden" name="id_punto_ubicacion" value="'.$var2.'"';
    echo '<label>Nombre del Punto Ubicación</label>';
    echo '<input type="text" name="nombre_punto_ubicacion" class="form-control" value="'.$row['nombre_punto_ubicacion'].'">';

    echo '<div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
            <input class="btn btn-success" type="submit" name="actualizarpuntoubicacion" value="Actualizar">
          </div>';
    
  } elseif ("verifica" == $tabla) {
  }
}

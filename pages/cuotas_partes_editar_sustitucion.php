<?php
// session_start();
if (isset($_POST['option']) and "" != $_POST['option']) {
  require_once('../conf.php');
  require_once('listas.php');
  $id =  $_POST['option'];

  $query = sprintf("SELECT * FROM cuotas_partes_sustitucion
  LEFT JOIN tipo_documento
  ON cuotas_partes_sustitucion.tipodoc=tipo_documento.id_tipo_documento
  WHERE 
  id_cuotas_partes_sustitucion=" . $id . " AND 
  estado_cuotas_partes_sustitucion=1");
  $select = mysql_query($query, $conexion) or die(mysql_error());
  $row = mysql_fetch_assoc($select);

?>
  <form method="POST" accept-charset="utf-8" name="formeditasustitucion">
    <input type="hidden" name="id_cuotas_partes_sustitucion" value="<?php echo $id; ?>">
    <div class="row">

      <div class="col-md-6">
        <label><span style="color:#ff0000;">*</span>Numero de Documento</label>
        <input type="number" class="form-control" name="cedula_sustitucion" value="<?php echo $row['cedula_sustitucion']; ?>" required>
      </div>

      <div class="col-md-6">
        <label for="input"><span style="color:#ff0000;">*</span> Causante:</label>
        <select name="id_cuotas_partes_datos_causante" class="form-control">
          <option>--- Seleccionar ---</option>
          <?php echo listapordefecto('cuotas_partes_datos_causante', 1300, $row['id_cuotas_partes_datos_causante']); ?>
        </select>
      </div>

      <div class="col-md-12">
        <label><span style="color:#ff0000;">*</span>Nombres Y Apellidos</label>
        <input type="text" class="form-control" name="nombre_cuotas_partes_sustitucion" value="<?php echo $row['nombre_cuotas_partes_sustitucion']; ?>" required>
      </div>

      <div class="col-md-4">
        <label><span style="color:#ff0000;">*</span>Numero Resolución</label>
        <input type="text" class="form-control" name="numero_resolucion" value="<?php echo $row['numero_resolucion']; ?>" required>
      </div>

      <div class="col-md-4">
        <label><span style="color:#ff0000;">*</span>Fecha Inicial Resolución</label>
        <input type="date" class="form-control" name="fecha_inicial_resolucion" value="<?php echo $row['fecha_inicial_resolucion']; ?>" required>
      </div>

      <div class="col-md-4">
        <label><span style="color:#ff0000;">*</span>Fecha Final Resolución</label>
        <input type="date" class="form-control" name="fecha_final_resolucion" value="<?php echo $row['fecha_final_resolucion']; ?>" required>
      </div>

      <div class="col-md-6">
        <label class="control-label"><span style="color:#ff0000;">*</span> Estado (Vive o No): </label>
        <select name="estado_cedula" class="form-control">
          <option value="<?php echo $row['estado_cedula']; ?>" selected>
            <?php
            switch ($row['estado_cedula']) {
              case 0:
                echo "INACTIVO";
                break;
              case 1:
                echo "ACTIVO";
                break;
            } ?>
          </option>
          <option></option>
          <option value="0">INACTIVO</option>
          <option value="1">ACTIVO</option>
        </select>
      </div>

    </div>

    <div class="row">
      <div class="col-sm-12" style="margin-top:30px;">
        <button style="float:right; margin-top:8px; margin-right:50px;" type="submit" class="btn btn-success" name="updateSustituto" value="1">Actualizar</button>
      </div>
    </div>
  </form>

<?php
}
mysql_free_result($select);

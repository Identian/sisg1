<?php
// session_start();
if (isset($_POST['option']) and "" != $_POST['option']) {
  require_once('../conf.php');
  require_once('listas.php');
  $id =  $_POST['option'];

  // $nump55 = privilegios(55, $_SESSION['snr']);
  // $nump54 = privilegios(54, $_SESSION['snr']);
  // $nump57 = privilegios(57, $_SESSION['snr']);
  // $nump60 = privilegios(60, $_SESSION['snr']);
  // $nump58 = privilegios(58, $_SESSION['snr']);
  // $nump61 = privilegios(61, $_SESSION['snr']);
  // $nump56 = privilegios(56, $_SESSION['snr']);
  // $nump59 = privilegios(59, $_SESSION['snr']);

  $query = sprintf("SELECT * FROM cuotas_partes_entidades
    LEFT JOIN departamento
    ON cuotas_partes_entidades.id_departamento=departamento.id_departamento
    LEFT JOIN municipio
    ON cuotas_partes_entidades.id_municipio=municipio.id_municipio   
  WHERE 
  id_cuotas_partes_entidades=" . $id . " AND 
  estado_cuotas_partes_entidades=1 limit 1");
  $select = mysql_query($query, $conexion) or die(mysql_error());
  $row = mysql_fetch_assoc($select);

?>
  <form method="POST" accept-charset="utf-8" name="formeditaentidad">
    <input type="hidden" name="id_cuotas_partes_entidades" value="<?php echo $id; ?>">
    <div class="row">
      <div class="col-md-6">
        <label for="inputSuma">Nit:</label>
        <input type="number" class="form-control" id="numero" name="nit" value="<?php echo $row['nit']; ?>" required>
      </div>

      <div class="col-md-6">
        <label for="inputSuma">Razon Social:</label>
        <input type="text" class="form-control" name="nombre_cuotas_partes_entidades" value="<?php echo $row['nombre_cuotas_partes_entidades']; ?>" required>
      </div>

      <div class="col-md-6">
        <label class="control-label"><span style="color:#ff0000;">*</span> Departamento</label>
        <select name="id_departamento" class="form-control">
          <?php echo listapordefecto('departamento', 300, $row['id_departamento']); ?>
        </select>
      </div>

      <div class="col-md-6">
        <label for="input"><span style="color:#ff0000;">*</span> Ciudad:</label>
        <select name="id_municipio" class="form-control">
          <?php echo listapordefecto('municipio', 1300, $row['id_municipio']); ?>
        </select>
      </div>

      <div class="col-md-6">
        <label class="control-label">Clasificacion</label>
        <select name="id_cuotas_partes_clasificacion" class="form-control">
          <?php echo listapordefecto('cuotas_partes_clasificacion', 1300, $row['id_cuotas_partes_clasificacion']); ?>
        </select>
      </div>

      <div class="col-md-6">
        <label class="control-label">Dirección</label>
        <input type="text" class="form-control" name="direccion" value="<?php echo $row['direccion']; ?>">
      </div>

      <div class="col-md-6">
        <label class="control-label">Telefono</label>
        <input type="number" class="form-control" name="telefono" value="<?php echo $row['telefono']; ?>">
      </div>

      <div class="col-md-6">
        <label class="control-label">Correo </label>
        <input type="text" class="form-control" name="correo1" value="<?php echo $row['correo1']; ?>">
      </div>

      <div class="col-md-6">
        <label class="control-label">Correo Opcional</label>
        <input type="text" class="form-control" name="correo2" value="<?php echo $row['correo2']; ?>">
      </div>

    </div>

    <div class="row">
      <div class="col-sm-12">
        <button style="float:right; margin-top:8px; margin-right:50px;" type="submit" class="btn btn-success" name="updateEntidad" value="1">Actualizar</button>
      </div>
    </div>
  </form>

<?php
}
mysql_free_result($select);

  // cierre del option

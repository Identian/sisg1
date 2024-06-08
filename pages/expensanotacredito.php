<?php
if (isset($_POST['option']) and "" != $_POST['option']) {
  require_once('../conf.php');
  $parametro = $_POST['option'];
  $updateNC = mysql_query("SELECT * FROM expensa_fac WHERE id_expensa_fac='$parametro' and estado_expensa_fac=1 ", $conexion) or die(mysql_error());
  $rownotacredito = mysql_fetch_assoc($updateNC);
?>
  <input type="hidden" name="id_expensa_fac" value="<?php echo $rownotacredito['id_expensa_fac']; ?>">
  <?php
  if (0 < $rownotacredito['fijo_expensa_fac']) {
  ?>
    <label>Valor Fijo</label>
    <input type="text" class="form-control" name="fijo_expensa_fac" value="<?php echo $rownotacredito['fijo_expensa_fac']; ?>">
  <?php
  } elseif (0 == $rownotacredito['fijo_expensa_fac']) {
    echo '<input type="hidden" class="form-control" name="fijo_expensa_fac" value="0">';
  }
  ?>

  <?php
  if (0 < $rownotacredito['vari_expensa_fac']) {
  ?>
    <label>Valor Variable</label>
    <input type="text" class="form-control" name="vari_expensa_fac" value="<?php echo $rownotacredito['vari_expensa_fac']; ?>">
  <?php
  } elseif (0 == $rownotacredito['vari_expensa_fac']) {
    echo '<input type="hidden" class="form-control" name="vari_expensa_fac" value="0">';
  }
  ?>

  <?php
  if (0 < $rownotacredito['uni_expensa_fac']) {
  ?>
    <label>Valor Unico</label>
    <input type="text" class="form-control" name="uni_expensa_fac" value="<?php echo $rownotacredito['uni_expensa_fac']; ?>">
  <?php
  } elseif (0 == $rownotacredito['uni_expensa_fac']) {
    echo '<input type="hidden" class="form-control" name="uni_expensa_fac" value="0">';
  }
  ?>
  <br>
  <div class="form-group">
    <div>
      Seleccionar archivo Soporte de la Nota Credito
      <input type="file" name="file">
    </div>
    <p class="help-block">Max. 2MB</p>
  </div>

  <input type="submit" name="GuardarNotaCredito" value="Guardar" class="btn btn-xs btn-success">

<?php
}

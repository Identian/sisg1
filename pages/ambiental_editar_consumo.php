<?php
if (isset($_POST['option']) and "" != $_POST['option']) {
  session_start();
  require_once('../conf.php');
  require_once('listas.php');

  $division = explode("-", $_POST['option']);
  $path = $division[0];
  $id = $division[1];
  $idOficinaRegistro = $division[2];

  $nump82 = privilegios(82, $_SESSION['snr']);  // Coordinador Ambiental Nivel central
  $nump137 = privilegios(137, $_SESSION['snr']); // Lider Ambiental nivel central
  if (isset($idOficinaRegistro) && '' != $idOficinaRegistro) {
    $privilegios = 0 < privreg($idOficinaRegistro, $_SESSION['snr'], 4, 9); // privilegios de la oficina 
  }
?>
  <?php if ($path == 'actualizar') { ?>

    <form action="" method="POST" name="formactualizar">
      <input type="hidden" name="id_ambiental_consumo" value="<?php echo $id; ?>">
      <?php
      $query = "SELECT * FROM ambiental_consumo WHERE id_ambiental_consumo=" . $id . "";
      $result = $mysqli->query($query);
      while ($row = $result->fetch_assoc()) {
      ?>
        <div class="row">
          <div class="col-md-12">
            <label>Cantidad Personas</label>
            <input type="number" class="form-control" name="cantidad_personas" value="<?php echo $row['cantidad_personas'] ? $row['cantidad_personas'] : ''; ?>">
          </div>
          <div class="col-md-12">
            <label>Numero Medidor</label>
            <input type="number" class="form-control" name="numero_medidor" value="<?php echo $row['numero_medidor'] ? $row['numero_medidor'] : ''; ?>">
          </div>
          <div class="col-md-12">
            <label>Direccion</label>
            <small>En caso de que la ORIP esté ubicada en un centro comercial, por favor indicar nombre y local.</small>
            <input type="text" class="form-control" name="direccion_medidor" value="<?php echo $row['direccion_medidor'] ? $row['direccion_medidor'] : ''; ?>">
          </div>
          <div class="col-md-12">
            <label><span style="color:#ff0000;">*</span>Frecuencia de cobro</label>
            <select class="form-control" name="frecuencia_cobro" required>
              <option value="<?php echo $row['frecuencia_cobro']; ?>"><?php echo $row['frecuencia_cobro']; ?></option>
              <option value=""></option>
              <option value="Mensual">Mensual</option>
              <option value="Bimestral">Bimestral</option>
              <option value="Trimestral">Trimestral</option>
              <option value="Cuatrimestral">Cuatrimestral</option>
              <option value="Semestral">Semestral</option>
              <option value="Anual">Anual</option>
            </select>
          </div>
          <div class="col-md-12">
            <label><span style="color:#ff0000;">*</span>Tipo de Consumo</label>
            <select class="form-control" name="tipo_consumo" required>
              <option value="<?php echo $row['tipo_consumo']; ?>"><?php echo $row['tipo_consumo']; ?></option>
              <option value=""></option>
              <option value="Por Consumo">Por Consumo</option>
              <option value="Tarifa Fija">Tarifa Fija</option>
            </select>
          </div>
          <div class="col-md-6">
            <label><span style="color:#ff0000;">*</span>fecha de inicio de periodo de Facturación:</label>
            <input type="date" class="form-control" name="periodo_inicial" value="<?php echo $row['periodo_inicial'] ? $row['periodo_inicial'] : ''; ?>" required>
          </div>
          <div class="col-md-6">
            <label><span style="color:#ff0000;">*</span>fecha final del periodo de Facturación:</label>
            <input type="date" class="form-control" name="periodo_final" value="<?php echo $row['periodo_final'] ? $row['periodo_final'] : ''; ?>" required>
          </div>
          <div class="col-md-6">
            <label><span style="color:#ff0000;">*</span>Cantidad Unidad: Energia(Kw/h) Agua(M3)</label>
            <input type="number" class="form-control" name="unidad" value="<?php echo $row['unidad'] ? $row['unidad'] : ''; ?>" required>
          </div>
          <div class="col-md-6">
            <label><span style="color:#ff0000;">*</span>Valor Facturado en Pesos</label>
            <input type="number" class="form-control" name="valor_factura" value="<?php echo $row['valor_factura'] ? $row['valor_factura'] : ''; ?>" required>
          </div>
          <div class="col-md-12">
            <label>Observación</label>
            <textarea name="observacion" class="form-control" cols="30" rows="3" maxlength="255"><?php echo $row['observacion'] ? $row['observacion'] : ''; ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()"> Cancelar</button>
          <input type="submit" name="actualizarcomsumo" class="btn btn-success btn-xs" value="Actualizar">
        </div>
      <?php
      }
      $result->free_result();
      ?>
    </form>
  <?php } ?>

  <?php if ($path == 'page_actualizar_pdf') { ?>
    <form action="" method="POST" name="formactualizarpdfenergia" enctype="multipart/form-data">
      <input type="hidden" name="id_ambiental_consumo" value="<?php echo $id; ?>">
      <div class="row">
        <div class="col-md-12">
          <label><span style="color:#ff0000;">*</span>PDF Recibo Publico</label>
          <input type="file" name="actualizar_pdf" id="myFileInputwe" onchange="return fileValidationGlobal('myFileInputwe',10)" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()"> Cancelar</button>
        <input type="submit" name="actualizarpdfenergia" class="btn btn-success btn-xs" value="Actualizar">
      </div>
    </form>
  <?php } ?>
<?php
}
?>
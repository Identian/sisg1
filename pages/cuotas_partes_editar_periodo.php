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

  $query = sprintf("SELECT * FROM cuotas_partes_pagos_entidades
  WHERE 
  id_cuotas_partes_pagos_entidades=" . $id . " AND 
  estado_cuotas_partes_pagos_entidades=1");
  $select = mysql_query($query, $conexion) or die(mysql_error());
  $row = mysql_fetch_assoc($select);

?>
  <form method="POST" accept-charset="utf-8" name="formeditarperiodo">
    <input type="hidden" name="id_cuotas_partes_pagos_entidades" value="<?php echo $id; ?>">
    <div class="row">

      <div class="col-md-6">
        <label><span style="color:#ff0000;">*</span>Radicado IRIS</label>
        <input type="text" class="form-control" name="radicado" value="<?php echo $row['radicado']; ?>" required>
      </div>

      <div class="col-md-6">
        <label><span style="color:#ff0000;">*</span>Porcentaje (Participación)</label>
        <input type="text" class="form-control" name="participacion" value="<?php echo $row['participacion']; ?>" required>
      </div>

      <div class="col-md-6">
        <label><span style="color:#ff0000;">*</span>Valor Pagado</label>
        <input type="text" class="form-control" name="valor_pagado" value="<?php echo $row['valor_pagado']; ?>" required>
      </div>

      <div class="col-md-6">
        <label><span style="color:#ff0000;">*</span>Valor Cuota Parte</label>
        <input type="text" class="form-control" name="valor_cuota_parte" value="<?php echo $row['valor_cuota_parte']; ?>" required>
      </div>

      <div class="col-md-6">
        <label><span style="color:#ff0000;">*</span>Fecha Inicio</label>
        <input type="date" class="form-control" name="periodo_fecha_inicio" value="<?php echo $row['periodo_fecha_inicio']; ?>" required>
      </div>

      <div class="col-md-6">
        <label><span style="color:#ff0000;">*</span>Fecha Inicio</label>
        <input type="date" class="form-control" name="periodo_fecha_final" value="<?php echo $row['periodo_fecha_final']; ?>" required>
      </div>

    </div>

    <div class="row">
      <div class="col-sm-12" style="margin-top:30px;">
        <button style="float:right; margin-top:8px; margin-right:50px;" type="submit" class="btn btn-success" name="updateperiodo" value="1">Actualizar</button>
      </div>
    </div>
  </form>

<?php
}
mysql_free_result($select);

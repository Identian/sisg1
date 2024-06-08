<!-- UPDATE DETALLE GASTOS GENERALES -->
<?php
if (isset($_POST['update_valor_subsidio'])) {

  $updateSQL = sprintf(
    "UPDATE not_valor_subsidio SET 
    valor_subsidio=%s
    WHERE id_not_informe=%s",
    GetSQLValueString($_POST["valor_subsidio"], "number"),
    GetSQLValueString($id, "int")
  );
  $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());
  echo '<meta http-equiv="refresh" content="0;URL=./notaria_informe_detalle&' . $id . '.jsp" />';
}

$queryvs = sprintf("SELECT * FROM not_valor_subsidio WHERE id_not_informe = $id LIMIT 1");
$updatevs = mysql_query($queryvs, $conexion) or die(mysql_error());
$rowvs = mysql_fetch_assoc($updatevs);
$totalRowsvs = mysql_num_rows($updatevs);
if (0 < $totalRowsvs) {
?>

  <div class="modal fade" id="poddetallevalorsubsidio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div id="nuevaAventura" class="modal-body">
          <form method="POST" name="not_valor_subsidio">

            <h5><b>VALOR SUBSIDIO</b></h5>

            <table class="table">
              <tr>
                <td><b>VALOR</b></td>
                <td>
                  <input type="number" class="form-control" name="valor_subsidio" value="<?php echo htmlentities($rowvs['valor_subsidio'], ENT_COMPAT, ''); ?>" required />
                </td>
              </tr>
            </table>

            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="update_valor_subsidio" class="btn btn-success btn-sm">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
}
mysql_free_result($updatevs);


$queryvs1 = sprintf("SELECT * FROM not_valor_subsidio where id_not_informe=$id LIMIT 1");
$selectvs1 = mysql_query($queryvs1, $conexion) or die(mysql_error());
$rowvs1 = mysql_fetch_assoc($selectvs1);
$estado = $rowvs1['estado_not_valor_subsidio'];

if (isset($_POST['guardar_valor_subsidio'])) {

  $insertSQL = sprintf(
    "INSERT INTO not_valor_subsidio (
                id_not_informe,
                valor_subsidio) VALUES (%s,%s)",
    GetSQLValueString($id, "int"),
    GetSQLValueString($_POST["valor_subsidio"], "number")
  );
  $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
  echo '<meta http-equiv="refresh" content="0;URL=./notaria_informe_detalle&' . $id . '.jsp" />';
}


if ($estado == 0) {
?>

  <form action="" name="valorsubsidiado" method="POST">
    <hr>
    <h5><b>VALOR SUBSIDIO</b></h5>
    <table class="table">
      <tr>
        <td><b> VALOR </b></td>
        <td>
          <input type="number" class="form-control" name="valor_subsidio" required />
        </td>
      </tr>
    </table>
    <div class="modal-footer">
      <button type="submit" name="guardar_valor_subsidio" class="btn btn-success btn-sm">Guardar</button>
    </div>
  </form>

<?php } else { ?>

  <hr>
  <h5><b>VALOR SUBSIDIO</b>
    <?php if (0 == $estadoCierreIEN or 1 == $_SESSION['rol']) {  ?>
      <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#poddetallevalorsubsidio" title="MODIFICAR VALOR SUBSIDIO"> <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span>Editar</button></a>
    <?php } ?>
  </h5>

  <table class="table">
    <tr>
      <td><b>VALOR</b></td>
      <td><?php echo '$ ' . number_format((float)$rowvs1['valor_subsidio'], 0, ",", ".") ?></td>
    </tr>
  </table>

<?php } ?>
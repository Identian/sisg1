<?php
if (isset($_POST['option']) && "" != $_POST['option']) {
	require_once('../conf.php');
  require_once('listas.php');

  $id = $_POST['option'];

  $query5 = "SELECT * FROM not_aporte_especial WHERE id_not_aporte_especial=$id AND estado_not_aporte_especial=1";
  $result5 = $mysqli->query($query5);
  $rowUpdate = $result5->fetch_assoc();
?>
	<form id="formaporteespecialeditar" action="" method="POST" name="aporte_especial">

		<table class="table">
			<tr>
				<th><b>Escritura No<b></th>
				<th><b>Fecha<b></th>
				<th><b>Valor Escritura<b></th>
				<th><b>Valor Aporte<b></th>
			</tr>
			<tr>
				<input type="hidden" name="id_not_aporte_especial" value="<?php echo $id; ?>">
				<td><input type="text" class="form-control" name="aportees_es"  value="<?php echo $rowUpdate['aportees_es']; ?>" required /></td>
				<td><input type="date" class="form-control" name="aportees_fec" value="<?php echo $rowUpdate['aportees_fec']; ?>" required /></td>
				<td><input type="number" class="form-control" name="aportees_ve" value="<?php echo $rowUpdate['aportees_ve']; ?>" placeholder="0" required /></td>
				<td><input type="number" class="form-control" name="aportees_va" value="<?php echo $rowUpdate['aportees_va']; ?>" placeholder="0" required /></td>
			</tr>
		</table>

		<div class="modal-footer">
			<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal" onClick="this.form.reset()">Cancelar</button>
			<button type="submit" name="update_aporte_es" class="btn btn-success btn-sm">Guardar</button>
		</div>
	</form>
<?php
}

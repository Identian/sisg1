<?php
if (isset($_POST['option']) && "" != $_POST['option']) {
  require_once('../conf.php');
  require_once('listas.php');

  $id = $_POST['option'];

  $query5 = "SELECT * FROM not_ingreso_conceptos_varios WHERE id_not_ingreso_conceptos_varios=$id AND estado_not_ingreso_conceptos_varios=1";
  $result5 = $mysqli->query($query5);
  $rowUpdate = $result5->fetch_assoc();
?>
  <script type="text/javascript">
    $(function() {
      $("#buscadornoanupdate").select2({
        dropdownParent: $('#modalnotariaotrosactosnotarialeseditar')
      });
    });
  </script>
  <form action="" method="POST" name="notariaotrosactosnotarialeseditar">
    <input type="hidden" name="id_not_ingreso_conceptos_varios" value="<?php echo $id; ?>">
    <span style="font-weight:bold">Nombre del Acto</span>
    <select id="buscadornoanupdate" style="width:100%" name="codigo_not_actos_varios">
      <option value="<?php echo $rowUpdate["codigo_acto_varios"].'-'.$rowUpdate["nombre_acto_varios"]; ?>" selected><?php echo $rowUpdate["codigo_acto_varios"].' '.$rowUpdate["nombre_acto_varios"]; ?></option>

      <?php
      $queryactos423 = sprintf("SELECT * FROM not_actos where tipo_actos_conceptos=2 and estado_not_actos=1 ORDER BY codigo_not_actos ASC");
      $resultactos25 = $mysqli->query($queryactos423);
      while ($rowactos23 = $resultactos25->fetch_array(MYSQLI_ASSOC)) {
        echo '<option value="' . $rowactos23["codigo_not_actos"] . '-' . $rowactos23["nombre_not_actos"] . '">' . $rowactos23["codigo_not_actos"] . ' ' . $rowactos23["nombre_not_actos"] . '</option>';
      }
      ?>
    </select>
    <table class="table">
      <tr>
        <th><span style="font-weight:bold">Cantidad</span></th>
        <th><span style="font-weight:bold">Valor</span></th>
      </tr>
      <tr>
        <td><input type="number" class="form-control" name="cantidad_acto_varios" value="<?php echo  $rowUpdate['cantidad_acto_varios']; ?>" required /></td>
        <td><input type="number" class="form-control" name="valor_acto_varios" placeholder="0" value="<?php echo  $rowUpdate['valor_acto_varios']; ?>" required /></td>
      </tr>
    </table>

    <div class="modal-footer">
      <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal" onClick="this.form.reset()">Cancelar</button>
      <button type="submit" name="update_ingreso_conceptos_varios" class="btn btn-success btn-sm">Guardar</button>
    </div>
  </form>
<?php
}

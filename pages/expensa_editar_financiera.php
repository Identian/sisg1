<?php
include '../conf.php';
if (isset($_POST['option']) and "" != $_POST['option']) {

  $division = explode("-", $_POST['option']);
  $tabla = $division[0]; // TABLA
  $var2 = $division[1]; // ID
  //$var3 = $division[2]; CANTIDAD

  if ("notacredito" == $tabla) {

    $update100 = mysql_query("SELECT 
    expensa_nota_credito.id_expensa_fac,
    expensa_fac.num_expensa_fac,
    expensa_nota_credito.antes_fijo_expensa_fac,
    expensa_nota_credito.antes_vari_expensa_fac,
    expensa_nota_credito.antes_uni_expensa_fac,
    expensa_nota_credito.fijo_expensa_fac,
    expensa_nota_credito.vari_expensa_fac,
    expensa_nota_credito.uni_expensa_fac
    FROM expensa_nota_credito
    LEFT JOIN expensa_fac
    ON expensa_nota_credito.id_expensa_fac=expensa_fac.id_expensa_fac
     WHERE expensa_nota_credito.id_expensa_fac=$var2 and expensa_nota_credito.estado_expensa_nota_credito=1 LIMIT 1", $conexion) or die(mysql_error());
    $row15 = mysql_fetch_assoc($update100);
    $total55 = mysql_num_rows($update100);
    if (0 < $total55) {
      do { ?>

        <div class="form-group">
          <label>N° FACTURA</label>
          <input type="hidden" name="id_expensa_fac" value="<?php echo $var2; ?>">
          <?php echo $row15['num_expensa_fac']; ?>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <label>Anterior Fijo </label>&nbsp;&nbsp;&nbsp;
            <?php echo $row15['fijo_expensa_fac']; ?>
          </div>
          <div class="col-sm-4">
            <label>Anterior Variable </label>&nbsp;&nbsp;&nbsp;
            <?php echo $row15['antes_vari_expensa_fac']; ?>
          </div>
          <div class="col-sm-4">
            <label>Anterior Unico </label>&nbsp;&nbsp;&nbsp;
            <?php echo $row15['antes_uni_expensa_fac']; ?>
          </div>
        </div><br>

        <?php
        if (0 < $row15['antes_fijo_expensa_fac']) {
        ?>
          <label>Valor Fijo</label>
          <input type="text" class="form-control" name="fijo_expensa_fac" value="<?php echo $row15['fijo_expensa_fac']; ?>">
        <?php
        } elseif (0 == $row15['fijo_expensa_fac']) {
          echo '<input type="hidden" class="form-control" name="fijo_expensa_fac" value="0">';
        }
        ?>

        <?php
        if (0 < $row15['antes_vari_expensa_fac']) {
        ?>
          <label>Valor Variable</label>
          <input type="text" class="form-control" name="vari_expensa_fac" value="<?php echo $row15['vari_expensa_fac']; ?>">
        <?php
        } elseif (0 == $row15['vari_expensa_fac']) {
          echo '<input type="hidden" class="form-control" name="vari_expensa_fac" value="0">';
        }
        ?>

        <?php
        if (0 < $row15['antes_uni_expensa_fac']) {
        ?>
          <label>Valor Unico</label>
          <input type="text" class="form-control" name="uni_expensa_fac" value="<?php echo $row15['uni_expensa_fac']; ?>">
        <?php
        } elseif (0 == $row15['uni_expensa_fac']) {
          echo '<input type="hidden" class="form-control" name="uni_expensa_fac" value="0">';
        }
        ?>
        <br>

        <div class="row">
          <div class="col-md-6">
            <label>Acción</label><br>
          </div>
          <div class="col-md-6">
            <select name="accionnotacredito" class="form-control">
              <option value="" selected>-- Seleccionar --</option>
              <option value="1">Aprobar</option>
              <option value="2">Rechazar</option>
            </select>
          </div>
        </div>

        <input type="submit" class="btn btn-sm btn-success" name="editarnotacredito" value="Guardar" />

      <?php
      } while ($row15 = mysql_fetch_assoc($update100));
      mysql_free_result($update100);
    } 
  } elseif ("devolucion" == $tabla) {
    $updateDev = mysql_query("SELECT * FROM expensa_devolucion
    WHERE expensa_devolucion.id_expensa_devolucion=$var2 AND expensa_devolucion.estado_expensa_devolucion=1 LIMIT 1", $conexion) or die(mysql_error());
    $rowdev = mysql_fetch_assoc($updateDev);
    $totaldev = mysql_num_rows($updateDev);
    if (0 < $totaldev) {
      do { ?>
        <input type="hidden" name="id_expensa_devolucion" value="<?php echo $var2; ?>"> 
        <div class="row">
          <div class="col-sm-4">
            <label style="margin-top:10px;">Valor Devolución</label>
          </div>
          <div class="col-sm-8">
            <input type="number" class="form-control" name="valor_devolucion" value="<?php echo $rowdev['valor_devolucion']; ?>"/>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <label style="margin-top:10px;">Cargar Anexo Devolución</label>
          </div>
          <div class="col-sm-8">
            <input type="file" value="" name="file"> Archivo Max. 2MB
          </div>
        </div><br>

        <div class="row">
          <div class="col-md-4">
            <label>Acción</label><br>
          </div>
          <div class="col-md-8">
            <select name="acciondevolucion" class="form-control">
              <option value="" selected>-- Seleccionar --</option>
              <option value="1">Aprobar</option>
              <option value="2">Rechazar</option>
            </select>
          </div>
        </div>

        <input type="submit" class="btn btn-success btn-sm" name="editardevolucion" value="Guardar" />
      <?php
      } while ($rowdev = mysql_fetch_assoc($updateDev));

      mysql_free_result($updateDev);
    } 
  }
}

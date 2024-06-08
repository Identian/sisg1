<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=$_POST['option'];
$update100 = mysql_query("SELECT * FROM expensa_fac WHERE id_expensa_fac='$parametro' and estado_expensa_fac=1 ", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($update100);
$total55 = mysql_num_rows($update100);
if (0<$total55) {
 do { ?>

<!-- pattern="^[0-9]{0,12}([.][0-9]{2,2})?$" -->
             
                  <!-- NUMERO DE FACTURA -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>N° FACTURA</label>
                  <div class="col-sm-7">
                  <input type="hidden" name="id_expensa_fac" value="<?php echo $row15['id_expensa_fac']; ?>">
                  <input type="hidden" name="id_expensa_curaduria" value="<?php echo $row15['id_expensa_curaduria']; ?>">
                  <input class="form-control" value="<?php echo htmlentities($row15['nombre_expensa_fac'], ENT_COMPAT, ''); ?><?php echo htmlentities($row15['num_expensa_fac'], ENT_COMPAT, ''); ?>" disabled/><br>
                  </div>
              </div>

              <!-- CARGOS FIJOS -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"></span>Cargo Fijo</label>
                  <div class="col-sm-7">
                  <input class="form-control" value="<?php echo '$ '.number_format((float)$row15['fijo_expensa_fac'],2,",","."); ?>" disabled/><br>
                  </div>
              </div>

              <!-- CARGOS VARIABLES -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"></span>Cargo Variable</label>
                  <div class="col-sm-7">
                  <input class="form-control" value="<?php echo '$ '.number_format((float)$row15['vari_expensa_fac'],2,",","."); ?>" disabled/><br>
                  </div>
              </div>

              <!-- CARGOS FIJOS -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"></span>Cargo Unico</label>
                  <div class="col-sm-7">
                  <input class="form-control" value="<?php echo '$ '.number_format((float)$row15['uni_expensa_fac'],2,",","."); ?>" disabled/><br>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Observacion de la Anulación</label>
                  <div class="col-sm-7">
                    <textarea  name="anular_expensa"  style="height:30px;" cols="35" required="Falta Incluir"></textarea> 
                  </div>
              </div> 

                <div class="modal-footer"> 
                    <button style="float: left;" onclick="return confirm('Esta Seguro de Anular la Factura');" type="submit" class="btn btn-warning" name="anula_fac" >Anular Factura</button>
                </div> 


<?php
    } while ($row15 = mysql_fetch_assoc($update100)); 
 
  mysql_free_result($update100);


} else {}
} else {}
?>
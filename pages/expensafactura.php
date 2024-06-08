<script type="text/javascript">
$(document).ready(function(){
  $(function(){
        $('.exp_edi').on('change',function(){
                console.log('Change event.');
                var val = $('.exp_edi').val();
                $('#numexp_edi').val( val !== '' ? val : '(empty)' );
        });

        $('.exp_edi').change(function(){
                console.log('Second change event...');
        });

        $('.exp_edi').number( true, 2 );
  });

  $(function(){
        $('.1exp_edi').on('change',function(){
                console.log('Change event.');
                var val = $('.1exp_edi').val();
                $('#num1exp_edi').val( val !== '' ? val : '(empty)' );
        });

        $('.1exp_edi').change(function(){
                console.log('Second change event...');
        });

        $('.1exp_edi').number( true, 2 );
  });

  $(function(){
        $('.2exp_edi').on('change',function(){
                console.log('Change event.');
                var val = $('.2exp_edi').val();
                $('#num2exp_edi').val( val !== '' ? val : '(empty)' );
        });

        $('.2exp_edi').change(function(){
                console.log('Second change event...');
        });

        $('.2exp_edi').number( true, 2 );
  });
});
</script>

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
                  <input class="form-control" value="<?php echo htmlentities($row15['nombre_expensa_fac'], ENT_COMPAT, ''); ?><?php echo htmlentities($row15['num_expensa_fac'], ENT_COMPAT, ''); ?>" disabled/><br>
                  </div>
              </div>

              <!-- CARGOS FIJOS -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargo Fijo</label>
                  <div class="col-sm-7">
                     <input type="text" class="form-control exp_edi"  value="<?php echo htmlentities($row15['fijo_expensa_fac'], ENT_COMPAT, ''); ?>" required/>
                     <input type="hidden" id="numexp_edi" name="fijo_expensa_fac" value="<?php echo htmlentities($row15['fijo_expensa_fac'], ENT_COMPAT, ''); ?>"/><br>
                  </div>
              </div>

             <!--  <input type="text" class="price" name="tiro" />
              <pre id="the_number"></pre> -->


              <!-- CARGOS VARIABLES -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargo Variable</label>
                  <div class="col-sm-7">
                  <input type="text" class="form-control 1exp_edi" value="<?php echo htmlentities($row15['vari_expensa_fac'], ENT_COMPAT, ''); ?>" required/>
                  <input type="hidden" id="num1exp_edi" name="vari_expensa_fac" value="<?php echo htmlentities($row15['vari_expensa_fac'], ENT_COMPAT, ''); ?>"/><br>
                  </div>
              </div>

              <!-- CARGOS FIJOS -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargo Unico</label>
                  <div class="col-sm-7">
                  <input type="text" class="form-control 2exp_edi" value="<?php echo htmlentities($row15['uni_expensa_fac'], ENT_COMPAT, ''); ?>" required/>
                  <input type="hidden" id="num2exp_edi" name="uni_expensa_fac" value="<?php echo htmlentities($row15['uni_expensa_fac'], ENT_COMPAT, ''); ?>"/><br>
                  </div>
              </div>

              <div class="modal-footer">
              	<button type="submit" name="update_fac" class="btn btn-success">Guardar</button>
              </div>

<?php
    } while ($row15 = mysql_fetch_assoc($update100)); 
 
  mysql_free_result($update100);


} else {}
} else {}
?>




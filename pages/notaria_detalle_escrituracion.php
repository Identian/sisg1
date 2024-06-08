<script type="text/javascript">
$(document).ready(function(){

  $(function(){
  $('.numero').on('input', function () { 
            this.value = this.value.replace(/[^0-9]/g,'');
        });
  });
  
  $(function(){
        $('.not_edi').on('change',function(){
                console.log('Change event.');
                var val = $('.not_edi').val();
                $('#numnot_edi').val( val !== '' ? val : '(empty)' );
        });

        $('.not_edi').change(function(){
                console.log('Second change event...');
        });

        $('.not_edi').number( true, 2 );
  });
});
</script>

<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=$_POST['option'];
$update100 = mysql_query("SELECT * FROM not_detesc WHERE id_not_detesc='$parametro' and estado_not_detesc=1 ", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($update100);
$total55 = mysql_num_rows($update100);
if (0<$total55) {
 do { ?>
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Acto</label>
                  <div class="col-sm-7">
                  <input type="hidden" name="id_not_detesc" value="<?php echo $row15['id_not_detesc']; ?>">
                  <select name="nombre_not_detesc" class="form-control" required>
                  <?php
                  $query = sprintf("SELECT id_not_actos, nombre_not_actos FROM not_actos where eo_not_actos=0 and estado_not_actos=1 order by nombre_not_actos"); 
                  $select = mysql_query($query, $conexion) or die(mysql_error());
                  $row = mysql_fetch_assoc($select);
                  $totalRows = mysql_num_rows($select);
                  if (0<$totalRows){
                  do {
                    echo '<option value="'.$row['id_not_actos'].'"  ';
                    
                    if ($row15['nombre_not_detesc']==$row['id_not_actos']) { echo 'selected';} else {} 
                    
                    echo '>'.$row['nombre_not_actos'].'</option>';
                     } while ($row = mysql_fetch_assoc($select)); 
                  } else {}  
                  mysql_free_result($select);
                  ?>
                  </select><br>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cantidad</label>
                  <div class="col-sm-7">
                  <input type="number" name="cantidad_not_detesc" class="form-control numero" value="<?php echo htmlentities($row15['cantidad_not_detesc'], ENT_COMPAT, ''); ?>" required/><br>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargo Fijo</label>
                  <div class="col-sm-7">
                     <input type="text" class="form-control not_edi"  value="<?php echo htmlentities($row15['ingreso_not_detesc'], ENT_COMPAT, ''); ?>" required/>
                     <input type="hidden" id="numnot_edi" name="ingreso_not_detesc" value="<?php echo htmlentities($row15['ingreso_not_detesc'], ENT_COMPAT, ''); ?>"/><br>
                  </div>
              </div>

              <div class="modal-footer">
              	<button type="submit" name="updatedetesc" class="btn btn-success btn-xs">Guardar</button>
              </div>

<?php
    } while ($row15 = mysql_fetch_assoc($update100)); 
 
  mysql_free_result($update100);


} else {}
} else {}
?>








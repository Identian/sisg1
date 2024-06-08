<script type="text/javascript">
	$('#not_lista').change(function (){
                var maxcont =document.getElementById("not_lista").value;
                jQuery.ajax({
                type: "POST",
                url: "pages/not_uesac.php",
                data: 'option='+maxcont,
                async: true,
                                success: function(b) {
                                        jQuery('#listatarifanotaria').html(b);
                    
                                }
                        })
                });
</script>


<style type="text/css">
	h1{
	 
	}
</style>


<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=$_POST['option'];

echo '<h4 style="color:white; text-transform: uppercase; background: #B3B3B3; text-align: center; padding: 10px;"><b> Numero de Escritura '.$parametro.'</b></h4>';
?>

 <div>   
  <form  method="POST" name="agreactos">
    <table class="jona">
    <input type="hidden" name="id_not_ues" value="<?php echo $parametro ?>">
    <tr>
      <th class="jona-baqh" style="width: 100px;"><span style="font-weight:bold;">Tipo de Acto</span></th>
      <td class="jona-0lax">
        <select class="form-control" id="not_lista" name="option">
        <option value="0">Selecciona una opcion</option>
        <option value="1">Actos Con Cuantia</option>
        <option value="2">Actos Sin Cuantia</option>
        <option value="3">Otros Actos de Escrituración</option>
        <option value="4">Conceptos Varios</option>
        </select>
        <br>
      </td>
    </tr>
    <tr>
        <th class="jona-baqh" style="width: 100px;"><span style="font-weight:bold;">Actos</span></th>
        <td class="jona-0lax" id="listatarifanotaria"></td>
    </tr>
    <tr>
      <th class="jona-baqh" style="width: 100px;"><span style="font-weight:bold;">Cantidad</span></th>
	   <td class="jona-0lax"><input type="number" name="cantidad_not_uesac" class="form-control numero" required> </td>
   	</tr>
   	<tr>
      <th class="jona-baqh" style="width: 100px;"><span style="font-weight:bold;">Ingreso</span></th>
	   <td class="jona-0lax"><input type="text" name="ingreso_not_uesac" class="form-control" required> </td>
   	</tr>
    </table>
   <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
   <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
   <button type="submit" name="regis_not_uesac" class="btn btn-success">Guardar</button>
   </form>
   </div>
   </div>




<?php

echo '<h4 style="color:white; text-transform: uppercase; background: #B3B3B3; text-align: center; padding: 10px;"><b> Actos Cargados a Escritura '.$parametro.'</b></h4>';

$update100 = mysql_query("SELECT * FROM  not_ues, not_uesac, not_actos WHERE
 not_ues.id_not_ues=not_uesac.id_not_ues and
 not_uesac.id_not_actos=not_actos.id_not_actos and
 not_ues.id_not_ues='$parametro' and estado_not_ues=1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($update100);
$total55 = mysql_num_rows($update100);
$totalesc=0;
if (0<$total55) {
 do { ?>
 	<table class="jona">
    <tr>
      <th class="jona-baqh" style="width: 100px;"><span style="font-weight:bold;">Nombre del Acto</span></th>
      <th class="jona-baqh" style="width: 100px;"><span style="font-weight:bold;">Cantidad</span></th>
      <th class="jona-baqh" style="width: 100px;"><span style="font-weight:bold;">Ingreso</span></th>
      <th class="jona-baqh" style="width: 100px;"><span style="font-weight:bold;">Total</span></th>
    </tr>
    <tr>
        <td class="jona-0lax"><?php echo $row15["nombre_not_actos"] ?></td>
        <td class="jona-0lax"><?php echo $row15["cantidad_not_uesac"] ?></td>
        <td class="jona-0lax"><?php echo $row15["ingreso_not_uesac"] ?></td>
        <td class="jona-0lax"><?php echo $toescri= $row15["cantidad_not_uesac"]*$row15["ingreso_not_uesac"] ?></td>
    </tr>
    </table>
	<br>
	<?php $totalesc+=$toescri; ?>

<?php
    } while ($row15 = mysql_fetch_assoc($update100)); 
 
  mysql_free_result($update100);


} else {}

} else {}
?>

	<table class="jona">
    <tr>
      <th class="jona-baqh" style="width: 200px;"><span style="font-weight:bold;">Total de la Escritura</span></th>
      <td class="jona-0lax"> <?php echo $totalesc ?></td>
  	</tr>
  	</table>
   
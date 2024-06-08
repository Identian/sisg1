<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 
	require_once('listas.php');
$nump63=privilegios(63,$_SESSION['snr']);
if (0<$nump63 or 1==$_SESSION['rol']) {
$idbe=intval($_POST['option']);
$query="SELECT * FROM departamento, notaria, posesion_notaria, funcionario, beneficio_notaria   
WHERE notaria.id_notaria=posesion_notaria.id_notaria 
and departamento.id_departamento=notaria.id_departamento 
AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND beneficio_notaria.id_notaria=notaria.id_notaria 
AND posesion_notaria.fecha_fin IS NULL 
AND estado_notaria=1 
AND estado_funcionario=1 
AND estado_posesion_notaria=1 
AND estado_beneficio_notaria=1 
AND beneficio_notaria.id_beneficio_notaria=".$idbe." ";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
?>
<div style="padding:10px 10px 10px 10px">
<form action="" method="POST" name="for4354m1">
<div class="form-group text-left"> 
<label  class="control-label">Notario:</label> 
<?php echo $row['nombre_funcionario'];  ?>.
 <b>C.C.</b> <?php echo $row['cedula_funcionario'];  ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Notaria:</label> 
<?php echo $row['nombre_departamento']; ?> / <?php echo $row['nombre_notaria']; ?> - <?php $emailn=$row['email_notaria']; echo $emailn; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Mes:</label> 
<?php echo $row['mes_beneficio'];  ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Analista:</label> 
<?php 
if (isset($row['id_analista'])) {
echo quees('funcionario', $row['id_analista']);
	} else { ?>
<select name="id_analista" >
					<option value="" selected></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and id_perfil=62  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion);
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {
							echo '<option value="'.$rowop['id_funcionario'].'" ';
							if ($row['id_analista']==$rowop['id_funcionario']) { echo 'selected'; } else {}
							echo '>'.$rowop['nombre_funcionario'].'</option>';
							
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>						
				</select>

</div>


<div class="modal-footer">
<div id="imagePreview"></div>
<input type="hidden" name="asignacion" value="<?php echo $idbe; ?>">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>
<?php } ?>
</form>
</div>
<?php
 } else {} 
 } else {} ?>

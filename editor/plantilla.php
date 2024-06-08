<?php
if (isset($_POST['plantilla_visita']) && ""!=$_POST['plantilla_visita']) {
$datas=$_POST['plantilla_visita'];
$query88 = "UPDATE plantilla_visita SET plantilla_visita='$datas' where id_area=".$id." and id_plantilla_visita=".$seccion." and estado_plantilla_visita=1";  
$result44 = $mysqli->query($query88);
}


?>
<div class="container-fluid" >
      <div class="row">
        <div class="col-md-12">
		<center><h3>PLANTILLA</h3></center><br>
  <div class="row">
<div class="col-md-11">
</div>
</div>
	<form action="" method="post" name="435435">
		<div class="grid-container">
			<div class="grid-width-100">
				<textarea id="editor" name="plantilla_visita"><?php
$queryk = sprintf("SELECT * from plantilla_visita where id_area=".$id." and id_plantilla_visita=".$seccion." and estado_plantilla_visita=1");
$result4hj = $mysqli->query($queryk);
$row4hj = $result4hj->fetch_array();
if (0<count($row4hj)){
echo $row4hj['plantilla_visita'];
} else {}
$result4hj->free();
?></textarea>
  <br><center>
  
   <button type="submit" class="btn btn-xs btn-success">
				<span class="fa fa-edit" title="Agregar"></span> GUARDAR</button>
				</center>
			</div>
		</div>
	</form>
	</div>
		</div>
	</div>

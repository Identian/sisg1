<?php
$nump77=privilegios(77,$_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump77) {


if ((isset($_POST["id_tipo_macroprocesou"])) && ($_POST["id_tipo_macroprocesou"] != "")) {
$id_tipo_macroprocesou=$_POST["id_tipo_macroprocesou"];
$id_macroprocesou=intval($_POST["id_macroprocesou"]);
  $updateSQL = sprintf("UPDATE macroproceso SET nombre_macroproceso=%s, id_tipo_macroproceso=%s, 
  descripcion_macroproceso=%s 
  WHERE id_macroproceso=%s and estado_macroproceso=1",
                       GetSQLValueString($_POST["nombre_macroproceso"], "text"),
					     GetSQLValueString($id_tipo_macroprocesou, "int"),
						   GetSQLValueString($_POST["descripcion_macroproceso"], "text"),
					    GetSQLValueString($id_macroprocesou, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);
  echo $updateSQL;
  echo $actualizado;
}



function insertar($table1, $idb) {
global $mysqli;
$query88 = "INSERT INTO ".$table1." (nombre_$table1, estado_$table1) values ('$idb', 1)";  

$result44 = $mysqli->query($query88);
return;
$result44->free();
}






function listap($table) {
global $mysqli;
$query = "SELECT id_".$table.", nombre_".$table."  FROM ".$table." where  estado_".$table."=1 order by id_".$table." ASC ";
$result = $mysqli->query($query);
echo '<ol>';
while ($obj = $result->fetch_array()) {
	$infoid='id_'.$table;
	$infonombre='nombre_'.$table;
	
echo '<li><a style="color:#ff0000;cursor: pointer" title="Borrar" name="'.$table.'" id="'.$obj[$infoid].']" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>  ';
	if ("macroproceso"==$table) {
echo '<a href="" class="buscar_macro" id="'.$table.'-'.$obj[$infoid].'" data-toggle="modal" data-target="#popupmacro"><span class="fa fa-edit"></span></a>';
	} else {}
	
	echo ' '.$obj[$infonombre].' </li>';
    }
echo '</ol>';
$result->free();

}







if (isset($_POST['macroproceso']) && ""!=$_POST['macroproceso']) {
	echo insertar('macroproceso',$_POST['macroproceso']);
} else {}

if (isset($_POST['procedimiento']) && ""!=$_POST['procedimiento']) {
	echo insertar('procedimiento',$_POST['procedimiento']);
} else {}

if (isset($_POST['proceso']) && ""!=$_POST['proceso']) {
	echo insertar('proceso',$_POST['proceso']);
} else {}

if (isset($_POST['sistema_gestion']) && ""!=$_POST['sistema_gestion']) {
	echo insertar('sistema_gestion',$_POST['sistema_gestion']);
} else {}

if (isset($_POST['tipo_macroproceso']) && ""!=$_POST['tipo_macroproceso']) {
	echo insertar('tipo_macroproceso',$_POST['tipo_macroproceso']);
} else {}

if (isset($_POST['tipo_vrsdocumento']) && ""!=$_POST['tipo_vrsdocumento']) {
	echo insertar('tipo_vrsdocumento',$_POST['tipo_vrsdocumento']);
} else {}




?>


<div class="row">
 <div class="col-md-4">
 
 <div class="panel panel-default">
  <div class="panel-body">
<h3>Tipo de macroproceso</h3>
<form class="navbar-form" name="fo45454334as5rm1" method="post" action="">
<div class="input-group">
<div class="input-group-btn">
<input class="form-control" style="width:220px;height:30px" name="tipo_macroproceso" required="">
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button> 
</div>
</div>
</form>
<hr>
<?php
echo listap('tipo_macroproceso');
?>
</div>
</div>



</div>

 <div class="col-md-4">
<div class="panel panel-default">
  <div class="panel-body">
<h3>Macroproceso</h3>
<form class="navbar-form" name="fo454543345rm1" method="post" action="">
<div class="input-group">
<div class="input-group-btn">
<input class="form-control" style="width:220px;height:30px" name="macroproceso" required="">
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button> 
</div>
</div>
</form>
<hr>
<?php
echo listap('macroproceso');
?>
</div>
</div>
</div>
 <div class="col-md-4">
 <div class="panel panel-default">
  <div class="panel-body">
<h3>Sistema de gestion</h3>
<form class="navbar-form" name="fo4545w43345rm1" method="post" action="">
<div class="input-group">
<div class="input-group-btn">
<input class="form-control" style="width:220px;height:30px" name="sistema_gestion" required="">
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button> 
</div>
</div>
</form>
<hr>
<?php
echo listap('sistema_gestion');
?>
</div>
</div>


</div>

</div>

<div class="row">
 <div class="col-md-4">
<div class="panel panel-default">
  <div class="panel-body">
<h3>Procedimiento</h3>
<form class="navbar-form" name="fofhgfh43432454543345rm1" method="post" action="">
<div class="input-group">
<div class="input-group-btn">
<input class="form-control" style="width:220px;height:30px" name="procedimiento" required="">
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button> 
</div>
</div>
</form>
<hr>
<?php
echo listap('procedimiento');
?>
</div>
</div>
</div>
 <div class="col-md-4">
<div class="panel panel-default">
  <div class="panel-body">
<h3>Proceso</h3>
<form class="navbar-form" name="fo45454334trt5rtyrym1" method="post" action="">
<div class="input-group">
<div class="input-group-btn">
<input class="form-control" style="width:220px;height:30px" name="proceso" required="">
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button> 
</div>
</div>
</form>
<hr>
<?php
echo listap('proceso');
?>
</div>
</div>
</div>
 <div class="col-md-4">
<div class="panel panel-default">
  <div class="panel-body">
<h3>Tipo de documento</h3>
<form class="navbar-form" name="fo454543345rjkjkm1" method="post" action="">
<div class="input-group">
<div class="input-group-btn">
<input class="form-control" style="width:220px;height:30px" name="tipo_vrsdocumento" required="">
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button> 
</div>
</div>
</form>
<hr>
<?php
echo listap('tipo_vrsdocumento');
?>
</div>
</div>
</div>
</div>



<div class="modal fade bd-example-modal-lg" id="popupmacro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Actualizar</label></h4>
			</div> 
			<div class="ver_macro" class="modal-body"> 

			</div>
		</div> 
	</div> 
</div> 


<?php } ?>

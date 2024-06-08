<?php



if ((1==$_SESSION['rol']) and isset($_GET["i"])){
	$id=$_GET['i'];
	$numpnota=0;
} else {
	
if (isset($_SESSION['id_vigilado']) && 1==$_SESSION['snr_grupo_cargo']) {
$id=$_SESSION['id_vigilado'];
$numpnota=privilegiosnotariado($id, 2, $_SESSION['snr']);
$salida=privilegiosnotariado($id, 9, $_SESSION['snr']);
} else {
$id=0;
$numpnota=0;
}
	
	
}


if (0<$id) {




if ((isset($_POST["id_modulo_notariado"])) && (""!=$_POST["id_modulo_notariado"])) { 

$idfun=intval($_POST["id_funcionario"]);
$idmod=intval($_POST["id_modulo_notariado"]);

$querynb = sprintf("SELECT count(id_privilegio_notariado) as rep FROM privilegio_notariado where id_notaria=".$id." and id_modulo_notariado=".$idmod." and id_funcionario=".$idfun." and estado_privilegio_notariado=1");
$selectnb = mysql_query($querynb, $conexion) or die(mysql_error());
$rownb = mysql_fetch_assoc($selectnb);
if (0<$rownb['rep']) {
	echo $repetido;
} else {


$insertSQL = sprintf("INSERT INTO privilegio_notariado (id_funcionario, id_modulo_notariado, id_notaria, fecha_privilegio, estado_privilegio_notariado) VALUES (%s, %s, %s, now(), %s)", 
GetSQLValueString($idfun, "int"), 
GetSQLValueString($idmod, "int"), 
GetSQLValueString($id, "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
} 
}



?>


<?php if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && (""!=$_SESSION['posesionnotaria'] or ""!=$_SESSION['id_vigilado'])))
{ include 'menu_notaria.php'; } else { } ?>

	  

	  


<div class="row">

<div class="col-md-9"  >
  
<div class="box" style="min-height:500px;">


<div class="box-header with-border">
                  <h3 class="box-title">Acceso a módulos de la Notaria <?php echo quees('notaria', $id); ?></h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
	
	
	<hr>
<form action="" method="POST" name="for5erttgmgjht1">
<div class="row">

<div class="col-md-3">
Acceso a módulos de Notariado:
</div>


<div class="col-md-3">
<select class="form-control" style="width:100%;" name="id_modulo_notariado" required>
<option value="" selected> - - Módulo - - </option>

<?php
$queryn = sprintf("SELECT * FROM modulo_notariado where id_modulo_notariado!=8 and estado_modulo_notariado=1");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
$totalRowsn = mysql_num_rows($selectn);
if (0<$totalRowsn){
do {
echo '<option value="'.$rown['id_modulo_notariado'].'">'.$rown['nombre_modulo_notariado'].'</option>';
} while ($rown = mysql_fetch_assoc($selectn));
} else {
	echo '';
}
mysql_free_result($selectn);
?>


</select>
</div>

<div class="col-md-3"> 
<select class="form-control" style="width:100%;" name="id_funcionario" required>
<option value="" selected> - - Asesor - - </option>
<?php
$queryn = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_cargo!=1 and id_notaria_f=".$id." and id_tipo_oficina=3 and estado_funcionario=1");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
$totalRowsn = mysql_num_rows($selectn);
if (0<$totalRowsn){
do {
echo '<option value="'.$rown['id_funcionario'].'">'.$rown['nombre_funcionario'].'</option>';
} while ($rown = mysql_fetch_assoc($selectn));
} else {
	echo '<option value="">No tiene personal relacionado</option>';
}
mysql_free_result($selectn);
?>
</select>


</div>

<div class="col-md-3"> 
<button type="submit" class="btn btn-success">
Dar acceso</button>
</div>
</div>
</form>

	<hr>
	
	
<!--<div style="text-align:right"><a href="xls/curadurias.xls"><img src="images/excel.png"></a></div>	-->

<?php


$query = sprintf("SELECT * FROM privilegio_notariado, funcionario, modulo_notariado where privilegio_notariado.id_funcionario=funcionario.id_funcionario and privilegio_notariado.id_modulo_notariado=modulo_notariado.id_modulo_notariado and id_notaria=".$id." and estado_privilegio_notariado=1");
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows_reg = mysql_num_rows($select);
echo $totalRows_reg.' registros.<br />';
if (0<$totalRows_reg) {
?>
<table id="lista" class="table">
<thead><tr align='center' valign='middle'><th>FUNCIONARIO</th><th>IDENTIFICACIÓN</th><th>MODULO DE NOTARIADO</th><th>FECHA DE CREACIÓN</th></tr></thead><tbody>
<?php
do {
	echo '<tr>';
echo '<td>'.$row['nombre_funcionario'].'</td>';
echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td>'.$row['nombre_modulo_notariado'].'</td>';
echo '<td>'.$row['fecha_privilegio'].'</td>';
echo '<td><a style="color:#ff0000;cursor: pointer" name="privilegio_notariado" id="'.$row['id_privilegio_notariado'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';
} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);
echo '</tbody></table>';
} else {}
?>







</div>
</div>
</div>

 

        <div class="col-md-3">

		
		

	


 <div class="box">
<div class="box-header with-border">
                  <h3 class="box-title">Usuarios de la Notaria</h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">
<?php
$queryn = sprintf("SELECT id_funcionario, nombre_funcionario, id_cargo FROM funcionario where id_notaria_f=".$id." and id_tipo_oficina=3 and estado_funcionario=1 order by id_cargo");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
$totalRowsn = mysql_num_rows($selectn);
if (0<$totalRowsn){
	echo '<ul>';
do {
echo '<li>';
if (1==$_SESSION['rol']) {
echo '<a href="https://sisg.supernotariado.gov.co/usuario&'.$rown['id_funcionario'].'.jsp"><i class="fa fa-user"></i></a> ';
} else {}
ECHO $rown['nombre_funcionario'].'';
if (1==$rown['id_cargo']) { echo ' <b>(NOTARIO)</b>'; } else {}
echo '</li>';
} while ($rown = mysql_fetch_assoc($selectn));

echo '</ul>';

} else {
echo 'No tiene asesores registrados';
}
mysql_free_result($selectn);
?>

		<!--
         <hr>

              <div class="progress vertical">Jul
                <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="height: 40%">
                  <span class="sr-only"></span>12567
                </div>
              </div>
              <div class="progress vertical">
                <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="height: 20%">
                  <span class="sr-only"></span>
                </div>
              </div>
              <div class="progress vertical">
                <div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 60%">
                  <span class="sr-only"></span>
                </div>
              </div>
              <div class="progress vertical">
                <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="height: 80%">
                  <span class="sr-only"></span>
                </div>
              </div>
         
			-->

</div>
</div>




			
			</div>
			

</div>


<?php } else {echo 'No tiene acceso';} ?>











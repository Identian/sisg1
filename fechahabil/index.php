<!DOCTYPE html>
<html>

<head>
	<title>Tiempo</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
	<script type="text/javascript" src="cronos.js"></script>
	<link rel="shortcut icon" href="#">

</head>
<body>

	<form method="post" name="fechaCalcular" action="index.php">

	<label><h3>Calcula los dias desde una fecha incial hasta una fecha final </h3><p></p> </label>
	<label>Ingresa fecha: </label>
	 <input name="fecha" type="date">

	<label>Ingresa los dias: </label>
	<input name="fechaF" type="date">

	<input type="button" name="Calcular" value="Calcular">

	</form>
	
	<div id="caja">
		<p>Dias hasta la fecha</p>
	</div>

	<label><h3>Calcula la fecha final desde una fecha incial y los dias necesarios  </h3><p></p> </label>
	<form method="post" name="fechaCalcularDias" action="index.php">

	<label>Ingresa fecha: </label>
	 <input name="fechaI" type="date">

	<label>Ingresa los dias: </label>
	<input name="diasF" type="number">

	<input type="button" name="CalcularDias" value="Calcular">
	</form>
	<div id="caja2">
		<p>Fecha desde días</p>
	</div>
</body>
<?php/*
include("calcular.php");
if(isset($_REQUEST['Calcular'])){
	$fech = $_REQUEST['fecha'];
	$dia = $_REQUEST['dias'];
	echo calculadora::calcularDiasHabiles($fech,$dia);
}
 */?>
</html>
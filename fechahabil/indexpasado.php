<!DOCTYPE html>
<html>

<head>
	<title>Tiempo</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
	<script type="text/javascript" src="moment.min.js"></script>
</head>
<body>
	<form method="post" action="index.php">

	<label>Ingresa fecha: </label>
	 <input name="fecha" type="date">

	<label>Ingresa los dias: </label>
	<input type="" name="dias">

	<input type="submit" name="Calcular" value="Calcular">
	</form>
</body>
<?php
include("calcular.php");
if(isset($_REQUEST['Calcular'])){
	$fech = $_REQUEST['fecha'];
	$dia = $_REQUEST['dias'];
	echo calculadora::calcularDias($fech,$dia);
}
 ?>
</html>
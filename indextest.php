<?php
$hostname_conexion2 = "192.168.80.11";
$database_conexion2 = "sisg";
$username_conexion2 = "sisg";
$password_conexion2 = "C0l0mb1@19*";

global $mysqli;
$mysqli = new mysqli($hostname_conexion2, $username_conexion2, $password_conexion2, $database_conexion2);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}


function dep_mun() {
	global $mysqli;
	$querym = "SELECT * FROM departamento limit 10";
$resultadom = $mysqli->query($querym);
	 while ($obj = $resultadom->fetch_object()) {
        echo $obj->nombre_departamento;
    }
	$resultadom->free();
}
echo dep_mun();

?>
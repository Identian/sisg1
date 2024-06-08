<?php
$hostname_conexion = "192.168.80.175";
$database_conexion = "sisg";
$username_conexion = "root";
$password_conexion = "M01ses8o8o";

$conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion);
if (!$conexion) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully to MySQL server';
mysql_close($conexion);
?>

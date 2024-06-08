<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
session_start();
$info=intval($_POST['option']);
require_once('../conf.php'); 

    global $mysqli;
    $mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
    if (mysqli_connect_errno()) {
        printf("", $mysqli->connect_error);
        exit();
    }
	

$query4p = "INSERT INTO pactiva (id_funcionario, tipo_pactiva) VALUES (".$_SESSION['snr'].", ".$info.")"; 
//echo $query4p;
$result4p = $mysqli->query($query4p);
} else {}

?>
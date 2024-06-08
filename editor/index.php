<?php 
if (isset($_GET['q']) && isset($_GET['i']) && isset($_GET['e'])) {
session_start();

require_once('../conf.php');

global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Editor</title>
	<meta name="robots" content="noindex">
	<meta name="googlebot-news" content="nosnippet">
	<link href='../images/favicon.ico' rel='icon' type='image/x-icon'/>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="ckeditor.js"></script>
	<script src="samples/js/sample.js"></script>
	<link rel="stylesheet" href="samples/css/samples.css">
	<link rel="stylesheet" href="samples/toolbarconfigurator/lib/codemirror/neo.css">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body id="main">
<?php

$hoja=$_GET['q'];
$id=intval($_GET['i']);	
$seccion=intval($_GET['e']);

if ('plantilla'==$hoja) {
include 'plantilla.php';
} else if ("formato" ==$hoja) {
include 'formato.php';
} else {}

?>
<script>
	initSample();
</script>
</body>
</html>
<?php
} else { echo ''; }
?>
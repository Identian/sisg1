<?php
require_once('listas.php');
if (isset($_POST["cedula"])) {
    $cedulaABuscar = $_POST["cedula"];
    $nombreEncontrado = quenombreporcedula($cedulaABuscar);
    echo "<p>{$nombreEncontrado}</p>";
}
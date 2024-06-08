<?php
session_start();
require_once('listas.php');

$textodecrypt = decrypt($_POST['option'], cs());

if (
    isset($_POST['option']) and "" != $_POST['option'] &&
    isset($_POST['campo']) and "" != $_POST['campo']
) {
    $division = explode("-", $textodecrypt);

    $tabla = isset($division[0]) ? $division[0] : '';
    $nombreCampo = isset($division[1]) ? $division[1] : '';
    $nombreId = isset($division[2]) ? $division[2] : '';
    $ValorId = isset($division[3]) ? $division[3] : '';
    $Valorcampo = $_POST['campo'];

    if (
        isset($tabla) and "" != $tabla &&
        isset($nombreCampo) and "" != $nombreCampo &&
        isset($nombreId) and "" != $nombreId &&
        isset($ValorId) and "" != $ValorId &&
        isset($Valorcampo) and "" != $Valorcampo 
    ) {
        $sql = "UPDATE $tabla SET $nombreCampo = ? WHERE $nombreId = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $Valorcampo, $ValorId);
        if ($stmt->execute()) {
            echo 'Exitoso';
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo 'Vacios';
    }
}

<?php
require_once('../conf.php');
require_once('listas.php');
foreach ($_POST['anexo'] as $key => $value) {
    $update = 'UPDATE cd_anexos SET posicion_cd_anexos = ' . $key . ' WHERE id_cd_anexos =' . $value;
    $mysqli->query($update);
}
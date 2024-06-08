<!-- <php
require_once('../conf.php');
require_once('listas.php');

// GUARDAR NUEVA COMISION
if (
    isset($_POST["nuevotramo1"]) && '' != $_POST["nuevotramo1"] &&
    isset($_POST["nuevotramo2"]) && '' != $_POST["nuevotramo2"] &&
    isset($_POST["nuevotramo3"]) && '' != $_POST["nuevotramo3"] &&
    isset($_POST["nuevotramo4"]) && '' != $_POST["nuevotramo4"]
) {
    $nuevotramo1 = $_POST['nuevotramo1'];
    $nuevotramo2 = $_POST['nuevotramo2'];
    $nuevotramo3 = $_POST['nuevotramo3'];
    $nuevotramo4 = $_POST['nuevotramo4'];
    $nuevotramo5 = $_POST['nuevotramo5'];
    $nuevotramo6 = $_POST['nuevotramo6'];
    $datos = array(
        "id_comision_detalle" => $nuevotramo1,
        "desde_id_municipio" => $nuevotramo2,
        "hasta_id_municipio" => $nuevotramo3,
        "medio_transporte" => $nuevotramo4,
        "centro_costos" => $nuevotramo5,
        "centro_costos_viaticos" => $nuevotramo6
    );
    if (insertarDatos($mysqli, "comision_detalle_tramo", $datos)) {
        echo $insertado;
    } else {
        echo "Error en la inserción";
    }
} -->

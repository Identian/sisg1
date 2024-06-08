<?php
require_once('../conf.php');
require_once('listas.php');

session_start();
$nump125 = privilegios(125, $_SESSION['snr']); // SID Auxiliar
$nump126 = privilegios(126, $_SESSION['snr']); // SID Profesional
$nump127 = privilegios(127, $_SESSION['snr']); // SID Coordinador
$nump128 = privilegios(128, $_SESSION['snr']); // SID Jefe
$nump129 = privilegios(129, $_SESSION['snr']); // SID Noficador encargado de crear plantillas de notificacion

if (isset($_POST['option'])) {
    $option = explode("-", $_POST['option']);
    $id_cd_modulo = $option[0];
    $idAccion = $option[1];
} else {
    $id_cd_modulo = 0;
}
?>

<form action="" method="POST" name="formdsfeer3434" enctype="multipart/form-data">
    <div class="modal-body">
        <input type="hidden" name="id_cd_accion_fk_cd_anexos" value="<?php echo $id_cd_modulo; ?>">

        <div class="form-group text-left">
            <label class="control-label">Tipo Acción:</label>
            <select class="form-control" name="pra_cd_anexos">
                <option value="" selected>--Seleccionar--</option>
                <?php if (0 < $nump125 || 0 < $nump127 || 0 < $nump128 || 1 == $_SESSION['rol']) { ?>
                    <option value="Proyecto">Proyecto</option>
                    <option value="Reviso">Reviso</option>
                    <option value="Aprobo">Aprobo</option>
                <?php } else if (0 < $nump126) { ?>
                    <option value="Proyecto">Proyecto</option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group text-left">
            <label class="control-label">Documento Anexar:</label>
            <select class="form-control" name="nombre_cd_anexos">
                <option value="" selected>--Seleccionar--</option>
                <?php $Query = sprintf("SELECT nombre_cd_accion FROM cd_accion WHERE id_cd_accion=$idAccion AND estado_cd_accion=1");
                $Resultado = $mysqli->query($Query);
                while ($row = $Resultado->fetch_array(MYSQLI_ASSOC)) {
                    if (isset($row['nombre_cd_accion'])) {
                        echo '<option value="' . $row['nombre_cd_accion'] . '">' . $row['nombre_cd_accion'] . '</option>';
                    }
                } ?>
            </select>
        </div>

        <div class="form-group text-left">
            <label class="control-label">Observación:</label>
            <textarea class="form-control" name="observacion_doc_cd_anexos" cols="10" rows="8"></textarea>
        </div>
        <?php 
        $listaAbogadoPruebaTD = array(2, 12, 22, 55, 121, 151, 13, 23, 56, 122, 152);
        $existe_accion_abogado = in_array($idAccion, $listaAbogadoPruebaTD);
        if ((1 == $_SESSION['rol'] || 0 < $nump125 || 0 < $nump127 || 0 < $nump128 || 0 < $nump143) || (0 < $nump126 && $existe_accion_abogado)) { ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="definitivo_cd_anexos"> Definitivo
                </label>
            </div>
        <?php } ?>

        <div class="form-group text-left">
            <label class="control-label">Adjunto:</label>
            <input type="file" name="file">
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="guardar_cd_anexos">

        </div>
    </div>
</form>
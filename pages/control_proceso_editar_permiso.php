<?php
if (isset($_POST['option']) and "" != $_POST['option']) {
    require_once('../conf.php');
    require_once('listas.php');
    $option = explode('-', $_POST["option"]);
    $id = intval($option[0]);

    $Query = "SELECT * FROM cd_permiso_file_sid where id_cd_permiso_file_sid=$id AND estado_cd_permiso_file_sid=1";
    $Result = $mysqli->query($Query);
    $row = $Result->fetch_array(MYSQLI_ASSOC);
?>

    <form action="" method="POST">
        <input type="hidden" name="id_cd_permiso_file_sid" value="<?php echo $row['id_cd_permiso_file_sid']; ?>">
        <div class="form-group text-left">
            <label class="control-label">Identificación</label>
            <input type="number" class="form-control" name="identificacion" value="<?php echo $row['identificacion']; ?>">
        </div>
        <div class="form-group text-left">
            <label class="control-label">Nombre y Apellido</label>
            <input type="text" class="form-control" name="nombre_cd_permiso_file_sid" value="<?php echo $row['nombre_cd_permiso_file_sid']; ?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="actualizar_permiso">
        </div>
    </form>


<?php }

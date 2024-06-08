<?php
if (isset($_POST['option'])) {
    require_once('../conf.php');
    require_once('listas.php');
    $id = $_POST["option"];
    $Query22 = "SELECT * FROM cd_notificacion 
    WHERE id_cd_notificacion=$id
    AND estado_cd_notificacion=1";
    $Resultado22 = $mysqli->query($Query22);
    $row22 = $Resultado22->fetch_array(MYSQLI_ASSOC);
?>

    <form action="" method="POST" name="Fromhasd63847438">
        <div class="modal-body">
            <input type="hidden" name="id_cd_notificacion" value="<?php echo $id; ?>">
            <div class="form-group text-left">
                <label><b>Tipo Notificación / Comunicación</b></label>
                <input class="form-control" type="text" name="nombre_cd_notificacion" value="<?php echo $row22['nombre_cd_notificacion']; ?>">
            </div>
            <div class="form-group text-left">
                <label><b>Asunto</b></label>
                <input class="form-control" type="text" name="asunto_cd_notificacion" value="<?php echo $row22['asunto_cd_notificacion']; ?>">
            </div>
            <div class="form-group text-left">
                <label><b>Contenido de la comunicación</b></label>
                <textarea class="form-control" name="cuerpo_cd_notificacion" id="editarnotificacion322434" cols="10" rows="10">
                    <?php echo $row22['cuerpo_cd_notificacion']; ?>
                </textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-success btn-xs" value="Actualizar" name="editar_cd_notificacion">
            </div>
    </form>

    <script>
        $(function() {
            CKEDITOR.replace('editarnotificacion322434');
        })
    </script>
<?php } ?>
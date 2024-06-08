<?php
if (isset($_POST['option'])) {
    $id_cd_modulo = $_POST['option'];
}
?>

<form action="" method="POST" name="formhklfdf23">
    <div class="modal-body">
        <input type="hidden" name="id_cd_accion_fk_cd_anexos" value="<?php echo $id_cd_modulo; ?>">

        <div class="form-group text-left">
            <textarea class="form-control" id="asunto_control" name="observacion_cd_anexos"></textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success btn-xs">Guardar</button>
        </div>
    </div>
</form>
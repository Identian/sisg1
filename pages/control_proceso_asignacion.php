<?php
if (isset($_POST['option'])) {
    require_once('../conf.php');
    require_once('listas.php');
    $opcion = explode("-", $_POST["option"]);
    $id = $opcion[0];
    $grupoArea = $opcion[1];   
?>

    <form action="" method="POST" name="Fromhasd63847438">
        <div class="modal-body">
            <input type="hidden" name="id_cd_fk_cd_asignado" value="<?php echo $id; ?>">
            <div class="form-group text-left">
                <label class="control-label">Seleccionar:</label>
                <select class="form-control" name="para_cd_asignado_fk_id_funcionario">
                    <option value="" selected></option>
                    <?php $query6 = "SELECT DISTINCT(funcionario.id_funcionario), id_grupo_area, estado_funcionario_perfil  FROM funcionario_perfil  
                    INNER JOIN funcionario
                    ON funcionario_perfil.id_funcionario=funcionario.id_funcionario
                    WHERE id_grupo_area IN ($grupoArea)
                    AND estado_funcionario_perfil=1
                    AND estado_funcionario=1";
                    $result = $mysqli->query($query6);
                    while ($row6 = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <option value="<?php echo $row6['id_funcionario'] . '-' . $row6['id_grupo_area']; ?>"><?php echo quees('funcionario', $row6['id_funcionario']); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group text-left">
                <label class="control-label">Motivo:</label>
                <textarea name="motivo_cd_asignado" class="form-control" rows="1" maxlength="250"></textarea>
                <p class="help-block">Maximo 250 Caracteres.</p>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="crear_asignacion">
        </div>
    </form>

<?php } ?>
<?php
if (isset($_POST['option']) and "" != $_POST['option']) {
    require_once('../conf.php');
    require_once('listas.php');
    $option = explode("-", $_POST['option']);
    $accionEtapa = $option[0];
    $idCDetalleEtapa = $option[1];
?>
    <form action="" method="POST" name="Form456262ds">
        <div class="modal-body">
            <div class="form-group text-left">
                <input type="hidden" name="id_cd_etapa_fk_cd_detalle_accion" value="<?php echo $accionEtapa; ?>">
                <input type="hidden" name="id_cd_detalle_etapa" value="<?php echo $idCDetalleEtapa; ?>">
                <select class="form-control" name="id_cd_accion_fk_cd_detalle_accion" require>
                    <option value="" selected>Seleccionar</option>
                    <?php $Query1 = sprintf("SELECT * FROM cd_accion WHERE  estado_cd_accion=1 
                    AND id_cd_etapa_fk_cd_accion=$accionEtapa
                    ORDER BY nombre_cd_accion ASC");
                    $Resultado1 = $mysqli->query($Query1);
                    while ($row1 = $Resultado1->fetch_array(MYSQLI_ASSOC)) { ?>
                        <option value="<?php echo $row1['id_cd_accion'] . '-' . $row1['tipo_notificacion_cd_accion']; ?>"><?php echo $row1['nombre_cd_accion']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="crear_accion">
        </div>
    </form>
<?php
}

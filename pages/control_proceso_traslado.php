<?php
session_start();
if (isset($_POST['option'])) {
    require_once('../conf.php');
    require_once('listas.php');
    $opcion = explode("-", $_POST["option"]);
    $id = $opcion[0];
    $dependencia = $opcion[1];
    $Query23 = "SELECT * FROM cd
    WHERE id_cd=$id
    AND estado_cd=1";
    $Resultado23 = $mysqli->query($Query23);
    $row23 = $Resultado23->fetch_array(MYSQLI_ASSOC);

    $nump143 = privilegios(143, $_SESSION['snr']); // Usuario usado por sebastian
?>

    <form action="" method="POST" name="Fromtrasdsd234">
        <div class="modal-body">
            <input type="hidden" name="id_cd" value="<?php echo $id; ?>" required>
            <div class="form-group text-left">
                <span style="color:#ff0000;">*</span>
                <label><b>Dependencia</b></label>
                <select class="form-control" name="id_tipo_oficina_fk_tipo_oficina" required>
                    <option value="<?php echo $row23['id_tipo_oficina_fk_tipo_oficina']; ?>" selected>
                        <?php if (1 == $row23['id_tipo_oficina_fk_tipo_oficina']) {
                            echo 'Oficina de Control Disciplinario Interno';
                        } else if (2 == $row23['id_tipo_oficina_fk_tipo_oficina']) {
                            echo 'Grupo de Gestion Disciplinaria Registral';
                        } else if (3 == $row23['id_tipo_oficina_fk_tipo_oficina']) {
                            echo 'Direccion de Vigilancia y Control Notarial';
                        } else if (4 == $row23['id_tipo_oficina_fk_tipo_oficina']) {
                            echo 'Grupo para el control y vigilancia de Curadores Urbanos';
                        } else if (5 == $row23['id_tipo_oficina_fk_tipo_oficina']) {
                            echo 'Oficina Asesora Juridica';
                        } else if (6 == $row23['id_tipo_oficina_fk_tipo_oficina']) {
                            echo 'Despacho Del Superintendente';
                        }  ?>
                    </option>
                    <option value="">-- Seleccionar --</option>
                    <?php if (5 == $dependencia || 6 == $dependencia || 1 == $_SESSION['rol'] || 0 < $nump143) { ?>
                        <option value="1">Oficina de Control Disciplinario Interno</option>
                        <option value="2">Grupo de Gestion Disciplinaria Registral</option>
                        <option value="3">Direccion de Vigilancia y Control Notarial</option>
                        <option value="4">Grupo para el control y vigilancia de Curadores Urbanos</option>
                        <option value="5">Oficina Asesora Juridica</option>
                        <option value="6">Despacho Del Superintendente</option>
                    <?php } else if (2 == $dependencia || 3 == $dependencia || 4 == $dependencia) { ?>
                        <option value="1">Oficina de Control Disciplinario Interno</option>
                        <option value="6">Despacho Del Superintendente</option>
                        <option value="7">(Juzgamiento) Oficina de Control Disciplinario Interno</option>
                    <?php } else if (1 == $dependencia) { ?>
                        <option value="1">Oficina de Control Disciplinario Interno</option>
                        <option value="2">Grupo de Gestion Disciplinaria Registral</option>
                        <option value="3">Direccion de Vigilancia y Control Notarial</option>
                        <option value="4">Grupo para el control y vigilancia de Curadores Urbanos</option>
                        <option value="5">Oficina Asesora Juridica</option>
                        <option value="6">Despacho Del Superintendente</option>
                        <option value="8">(Juzgamiento) Oficina Asesora Juridica</option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-success btn-xs" value="Trasladar" name="cd_traslado">
            </div>
        </div>
    </form>
<?php } ?>
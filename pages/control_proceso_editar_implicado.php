<?php
if (isset($_POST['option']) and "" != $_POST['option']) {
    require_once('../conf.php');
    require_once('listas.php');
    $option = explode('-', $_POST["option"]);
    $id = intval($option[0]);
    $GlobalTipoDeOficina = intval($option[1]);

    $Query = "SELECT * FROM cd_implicado where id_cd_implicado=$id AND estado_cd_implicado=1";
    $Result = $mysqli->query($Query);
    $row = $Result->fetch_array(MYSQLI_ASSOC);

    $Query2 = "SELECT * FROM cd_entidad where id_cd_entidad=$id AND estado_cd_entidad=1";
    $Result2 = $mysqli->query($Query2);
    $row2 = $Result2->fetch_array(MYSQLI_ASSOC);
?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#entidadgrupo_cd_entidad').select2({});
        });
    </script>

    <form action="" method="POST" name="formeditarimplicadosjskf">
        <div class="modal-body">
            <input type="hidden" name="id_cd_implicado" value="<?php echo $id; ?>">
            <div class="form-group text-left">
                <?php
                if ($GlobalTipoDeOficina == 1) {
                    $Querytipo = "SELECT id_grupo_area AS id_area, nombre_grupo_area AS nombre_area, dependencia
                                    FROM (
                                        SELECT id_grupo_area, nombre_grupo_area, (1) AS dependencia
                                        FROM grupo_area WHERE id_area IS NOT NULL AND estado_grupo_area=1
                                        UNION
                                        SELECT id_oficina_registro, nombre_oficina_registro, (2) AS dependencia
                                        FROM oficina_registro WHERE estado_oficina_registro=1
                                    ) AS resultados_combinados
                                    ORDER BY nombre_area ASC";
                    echo '<label class="control-label">Nivel Central o Oficinas Registro:</label>';
                } elseif ($GlobalTipoDeOficina == 2) {
                    $Querytipo = "SELECT * FROM oficina_registro where estado_oficina_registro=1";
                    echo '<label class="control-label">Oficinas Registro:</label>';
                    echo '<input type="hidden" name="nombre_cd_entidad" value="2">';
                } elseif ($GlobalTipoDeOficina == 3) {
                    $Querytipo = "SELECT * FROM notaria where estado_notaria=1";
                    echo '<label class="control-label">Notarias:</label>';
                    echo '<input type="hidden" name="nombre_cd_entidad" value="3">';
                } elseif ($GlobalTipoDeOficina == 4) {
                    $Querytipo = "SELECT * FROM curaduria where estado_curaduria=1";
                    echo '<label class="control-label">Curadurias:</label>';
                    echo '<input type="hidden" name="nombre_cd_entidad" value="4">';
                }
                ?>
                <span style="color:#ff0000;">*</span><select class="form-control" style="width:100%" name="grupo_cd_entidad" id="entidadgrupo_cd_entidad" required>
                    <?php
                    if (isset($row2['grupo_cd_entidad'])) {
                        if ($GlobalTipoDeOficina == 1) { ?>
                            <option value="<?php echo $row2['nombre_cd_entidad'] .'-'. $row2['grupo_cd_entidad']; ?>" selected>
                                <?php 
                                if (1 == $row2['nombre_cd_entidad']) {
                                    echo quees('grupo_area', $row2['grupo_cd_entidad']);
                                }
                                if (2 == $row2['nombre_cd_entidad']) {
                                    echo quees('oficina_registro', $row2['grupo_cd_entidad']);
                                }
                                ?>
                            </option>
                        <?php } elseif ($GlobalTipoDeOficina == 2) { ?>
                            <option value="<?php echo $row2['grupo_cd_entidad']; ?>" selected>
                                <?php echo quees('oficina_registro', $row2['grupo_cd_entidad']); ?>
                            </option>
                        <?php } elseif ($GlobalTipoDeOficina == 3) { ?>
                            <option value="<?php echo $row2['grupo_cd_entidad']; ?>" selected>
                                <?php echo quees('notaria', $row2['grupo_cd_entidad']); ?>
                            </option>
                        <?php } elseif ($GlobalTipoDeOficina == 4) { ?>
                            <option value="<?php echo $row2['grupo_cd_entidad']; ?>" selected>
                                <?php echo quees('curaduria', $row2['grupo_cd_entidad']); ?>
                            </option>
                    <?php }
                        echo '<option value=""></option>';
                    } else {
                        echo '<option value="" selected>--Seleccionar--</option>';
                    }
                    $Query18 = "$Querytipo";
                    $Resul18 = $mysqli->query($Query18);
                    while ($row18 = $Resul18->fetch_array(MYSQLI_ASSOC)) {
                        if ($GlobalTipoDeOficina == 1 and isset($row18['id_area'])) {
                            echo '<option value="' . $row18['dependencia'] . '-' . $row18['id_area'] . '">' . $row18['nombre_area'] . '</option>';
                        } elseif ($GlobalTipoDeOficina == 2 and isset($row18['id_oficina_registro'])) {
                            echo '<option value="' . $row18['id_oficina_registro'] . '">' . $row18['nombre_oficina_registro'] . '</option>';
                        } elseif ($GlobalTipoDeOficina == 3 and isset($row18['id_notaria'])) {
                            echo '<option value="' . $row18['id_notaria'] . '">' . $row18['nombre_notaria'] . '</option>';
                        } elseif ($GlobalTipoDeOficina == 4 and isset($row18['id_curaduria'])) {
                            echo '<option value="' . $row18['id_curaduria'] . '">' . $row18['nombre_curaduria'] . '</option>';
                        }
                    } ?>
                </select>
            </div>
            <div class="form-group text-left">
                <label class="control-label">Cedula Implicado:</label>
                <input type="number" class="form-control" name="cedula_cd_implicado" value="<?php echo $row['cedula_cd_implicado']; ?>">
            </div>
            <div class="form-group text-left">
                <span style="color:#ff0000;">*</span><label class="control-label">Nombre Implicado:</label>
                <input type="text" class="form-control" name="nombre_cd_implicado" value="<?php echo $row['nombre_cd_implicado']; ?>" required>
            </div>
            <div class="form-group text-left">
                <label class="control-label">Email Implicado:</label>
                <input type="text" class="form-control" name="email_cd_implicado" value="<?php echo $row['email_cd_implicado']; ?>">
            </div>
            <div class="form-group text-left">
                <label class="control-label">Direccion Implicado:</label>
                <input type="text" class="form-control" name="direccion_cd_implicado" value="<?php echo $row['direccion_cd_implicado']; ?>">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="update_implicado_entidad">
        </div>
    </form>
<?php
}

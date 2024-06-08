<?php
if (isset($_POST['option']) and "" != $_POST['option']) {
    session_start();
    require_once('../conf.php');
    require_once('listas.php');
    // separacion del path
    $division = explode("-", $_POST['option']);
    $path = $division[0];
    $id = $division[1];
    // consulta exp
    $Query23 = "SELECT * FROM cd_migracion_sid
    WHERE id_cdms=$id
    AND estado_cdmso=1";
    $Resultado23 = $mysqli->query($Query23);
    $row23 = $Resultado23->fetch_array(MYSQLI_ASSOC);
?>
    <?php if ($path == 'traslado') { ?>
        <b>Traslado</b><br>
        <form action="" method="POST" name="formoldtraslasdodsnkfdfr45">

            <div class="modal-body">
                <input type="hidden" name="id_cdms" value="<?php echo $id; ?>" required>
                <div class="form-group text-left">
                    <span style="color:#ff0000;">*</span>
                    <label><b>Fase</b></label>
                    <select class="form-control" name="fase_cdmso" required>
                        <option value="<?php echo $row23['fase_cdmso']; ?>" selected><?php echo $row23['fase_cdmso']; ?></option>
                        <option value="">-- Seleccionar --</option>
                        <option value="Instruccion">Instruccion</option>
                        <option value="Juzgamiento">Juzgamiento</option>
                        <option value="Segunda Instancia">Segunda Instancia</option>
                    </select>
                </div>
                <div class="form-group text-left">
                    <span style="color:#ff0000;">*</span>
                    <label><b>Dependencia</b></label>
                    <select class="form-control" name="tipo_oficina_cdmso" required>
                        <option value="<?php echo $row23['tipo_oficina_cdmso']; ?>" selected>
                            <?php if (0 == $row23['tipo_oficina_cdmso']) {
                                echo 'Por Identificar';
                            } else if (1 == $row23['tipo_oficina_cdmso']) {
                                echo 'OCDI - Oficina de Control Disciplinario Interno';
                            } else if (2 == $row23['tipo_oficina_cdmso']) {
                                echo 'SDR - Superintendencia Delegada Para El Registro';
                            } else if (3 == $row23['tipo_oficina_cdmso']) {
                                echo 'SDN - Superintendencia Delegada Para El Notariado';
                            } else if (4 == $row23['tipo_oficina_cdmso']) {
                                echo 'SDC - Grupo para el control y vigilancia de Curadores Urbanos';
                            } else if (5 == $row23['tipo_oficina_cdmso']) {
                                echo 'OAJ - Oficina Asesora Juridica';
                            } else if (6 == $row23['tipo_oficina_cdmso']) {
                                echo 'DDS - Despacho Del Superintendente';
                            } ?>
                        </option>
                        <option value="">-- Seleccionar --</option>
                        <option value="1">OCDI - Oficina de Control Disciplinario Interno</option>
                        <option value="2">SDR - Superintendencia Delegada Para El Registro</option>
                        <option value="3">SDN - Superintendencia Delegada Para El Notariado</option>
                        <option value="4">SDC - Grupo para el control y vigilancia de Curadores Urbanos</option>
                        <option value="5">OAJ - Oficina Asesora Juridica</option>
                        <option value="6">DDS - Despacho Del Superintendente</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-success btn-xs" value="Trasladar" name="cd_migracion_sid_traslado">
                </div>
            </div>

        </form>
    <?php } ?>


    <?php if ($path == 'asignacion') { ?>
        <b>Historial Asignacion</b><br>
        <?php
        // grupo de area
        if (1 == $_SESSION['rol'] or 0 < $nump143) {
            $idGrupoArea = '23,41,42,313,44,45,297,305,12,1';
        } else {
            $idGrupoArea = $_SESSION['snr_grupo_area'];
        } ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre Apellidos</th>
                    <th>Fecha asignacion</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php $Query25 = "SELECT * FROM cd_migracion_asignacion WHERE estado_cd_migracion_asignacion=1 ORDER BY fecha_registro ASC";
                $Resultado25 = $mysqli->query($Query25);
                while ($row25 = $Resultado25->fetch_array(MYSQLI_ASSOC)) { ?>

                    <tr>
                        <td><?php echo quees('funcionario', $row25['id_funcionario']); ?></td>
                        <td><?php echo $row25['fecha_registro']; ?></td>
                        <td>
                            <form action="" method="POST" name="borrarAsignacionSidMigra">
                                <input type="hidden" name="id_cd_migracion_asignacion" value="<?php echo $row25['id_cd_migracion_asignacion']; ?>">
                                <input type="hidden" name="borrar_asignacion_sid_migracion" value="borrar">
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash" title="Borrar Asignacion"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php }
                $Resultado25->free();
                ?>
            </tbody>
        </table>
        <form action="" method="POST" name="formAsignarSidMigracion">
            <div class="modal-body">
                <div class="form-group text-left">
                    <input type="hidden" name="id_cdms" value="<?php echo $id; ?>" required>
                    <span style="color:#ff0000;">*</span>
                    <label><b>Funcionario</b></label>
                    <select class="form-control" name="id_funcionario" style="text-transform: uppercase;" required>
                        <option value=""></option>
                        <?php
                        $Query24 = "SELECT * FROM funcionario WHERE id_grupo_area IN ($idGrupoArea) AND estado_funcionario=1 ORDER BY nombre_funcionario ASC";
                        $Resultado24 = $mysqli->query($Query24);
                        while ($row24 = $Resultado24->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row24['id_funcionario']; ?>"><?php echo $row24['nombre_funcionario']; ?></option>
                        <?php }
                        $Resultado24->free();
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-success btn-xs" value="Asignar" name="cd_migracion_sid_asignar">
                </div>
            </div>
        </form>
        <!-- <php } ?> -->
    <?php } ?>

<?php } ?>
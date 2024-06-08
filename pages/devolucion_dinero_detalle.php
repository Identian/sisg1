<?php
session_start();
if (isset($_POST['option']) and "" != $_POST['option']) {
    require_once('../conf.php');
    require_once('listas.php');
    $option = intval($_POST['option']);

    $nump57 = privilegios(57, $_SESSION['snr']);
    $nump59 = privilegios(59, $_SESSION['snr']);
    $nump58 = privilegios(58, $_SESSION['snr']);
    $nump60 = privilegios(60, $_SESSION['snr']);
    $nump56 = privilegios(56, $_SESSION['snr']);
    $nump61 = privilegios(61, $_SESSION['snr']);

    // CONSULTA DEVOLUCION
    $query = "SELECT * FROM devolucion_dinero WHERE id_devolucion_dinero=" . $option . " AND estado_devolucion_dinero=1 LIMIT 1";
    $select = mysql_query($query, $conexion);
    $row = mysql_fetch_assoc($select);

    if (1 == $_SESSION['rol'] || 0 < $nump56 || 0 < $nump59) {
?>
        <div class="row">
            <div class="col-md-8" style="margin-left:5%">

                <br><label>Numero Reclasificación:</label>
                <?php if ((is_null($row['num_r_reclasificacion']) && 0 < $nump59) || (0 < $nump56) || (1 == $_SESSION['rol'])) { ?>

                    <form action="" method="post" name="form_num_r_reclasificacion">
                        <div class="input-group input-group-sm">
                            <input type="hidden" name="id_devolucion_dinero" value="<?php echo $option; ?>">
                            <input type="text" class="form-control" name="num_r_reclasificacion" value="<?php echo $row['num_r_reclasificacion']; ?>">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                            </span>
                        </div>
                    </form>

                <?php } else { ?>

                    <?php echo $row['num_r_reclasificacion']; ?>

                <?php } ?>


                <br><label>Numero Solicitud:</label>
                <?php if ((is_null($row['num_s_reclasificacion']) && 0 < $nump59) || (0 < $nump56) || (1 == $_SESSION['rol'])) { ?>

                    <form action="" method="post" name="form_num_s_reclasificacion">
                        <div class="input-group input-group-sm">
                            <input type="hidden" name="id_devolucion_dinero" value="<?php echo $option; ?>">
                            <input type="text" class="form-control" name="num_s_reclasificacion" value="<?php echo $row['num_s_reclasificacion']; ?>">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                            </span>
                        </div>
                    </form>

                <?php } else { ?>

                    <?php echo $row['num_s_reclasificacion']; ?>

                <?php } ?>


                <br><label>Numero DXC:</label>
                <?php if ((is_null($row['num_dxc_reclasificacion']) && 0 < $nump59) || (0 < $nump56) || (1 == $_SESSION['rol'])) { ?>

                    <form action="" method="post" name="form_num_dxc_reclasificacion">
                        <div class="input-group input-group-sm">
                            <input type="hidden" name="id_devolucion_dinero" value="<?php echo $option; ?>">
                            <input type="text" class="form-control" name="num_dxc_reclasificacion" value="<?php echo $row['num_dxc_reclasificacion']; ?>">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                            </span>
                        </div>
                    </form>

                <?php } else { ?>

                    <?php echo $row['num_dxc_reclasificacion']; ?>

                <?php } ?>

                <br><label>Numero orden de Pago:</label>
                <?php if ((is_null($row['num_orden_pago']) && 0 < $nump59) || (0 < $nump56) || (1 == $_SESSION['rol'])) { ?>

                    <form action="" method="post" name="form_num_orden_pago">
                        <div class="input-group input-group-sm">
                            <input type="hidden" name="id_devolucion_dinero" value="<?php echo $option; ?>">
                            <input type="text" class="form-control" name="num_orden_pago" value="<?php echo $row['num_orden_pago']; ?>">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                            </span>
                        </div>
                    </form>

                <?php } else { ?>

                    <?php echo $row['num_orden_pago']; ?>

                <?php } ?>

                <br><label>Numero Bancarización:</label>
                <?php if ((is_null($row['num_bancarizacion']) && 0 < $nump59) || (0 < $nump56) || (1 == $_SESSION['rol'])) { ?>

                    <form action="" method="post" name="form_num_bancarizacion">
                        <div class="input-group input-group-sm">
                            <input type="hidden" name="id_devolucion_dinero" value="<?php echo $option; ?>">
                            <input type="text" class="form-control" name="num_bancarizacion" value="<?php echo $row['num_bancarizacion']; ?>">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                            </span>
                        </div>
                    </form>

                <?php } else { ?>

                    <?php echo $row['num_bancarizacion']; ?>

                <?php } ?>

                <br><label>Fecha de Pago:</label>
                <?php if ((is_null($row['fecha_pago']) && 0 < $nump59) || (0 < $nump56) || (1 == $_SESSION['rol'])) { ?>

                    <form action="" method="post" name="form_fecha_pago">
                        <div class="input-group input-group-sm">
                            <input type="hidden" name="id_devolucion_dinero" value="<?php echo $option; ?>">
                            <input type="date" class="form-control" name="fecha_pago" value="<?php echo $row['fecha_pago']; ?>">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                            </span>
                        </div>
                    </form>

                <?php } else { ?>

                    <?php echo $row['fecha_pago']; ?>

                <?php } ?>


                <br><label>Check Principal:</label>
                <?php if (1 == $row['check_principal']) {
                    echo 'Si';
                } else {
                    echo 'No';
                }
                ?>
                <br><label>Fecha:</label> <?php echo $row['fecha_check_principal']; ?>

                <br><br><label>Check Tesoreria:</label>
                <?php if (1 == $row['check_tesoreria']) {
                    echo 'Si';
                } else {
                    echo 'No';
                }
                ?>
                <br><label>Fecha:</label> <?php echo $row['fecha_check_tesoreria']; ?>
                <br>
                <br>

            </div>
        </div>
<?php
    }
}

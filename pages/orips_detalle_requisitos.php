<?php
if (isset($_POST['option']) and "" != $_POST['option']) {
    session_start();
    require_once('../conf.php');
    require_once('listas.php');

    $division = explode("-", $_POST['option']);
    $path = $division[0];
    $id = $division[1];
?>

    <style>
        .divscroll400 {
            overflow-y: scroll;
            overflow-x: none;
            height: 300px;
        }
    </style>

    <?php if ($path == 'actualizar') { ?>

        <form action="" method="POST" name="formactualizar">
            <input type="hidden" name="id_orips_requisito" value="<?php echo $id; ?>">
            <?php
            $query = "SELECT * FROM orips_requisito WHERE id_orips_requisito=" . $id . "";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="row">
                    <div class="col-md-12">
                        <label>Tipo</label>
                        <select class="form-control" name="id_orips_tipo_requisito">
                            <option value="<?php echo $row['id_orips_tipo_requisito']; ?>" selected><?php echo quees('orips_tipo_requisito', $row['id_orips_tipo_requisito']); ?></option>';
                            <option value=""></option>
                            <?php
                            $query1 = "SELECT * FROM orips_tipo_requisito WHERE id_orips_tipo_requisito=" . $id . "";
                            $result1 = $mysqli->query($query1);
                            while ($row1 = $result1->fetch_assoc()) {
                                echo '<option value="' . $row1['id_orips_tipo_requisito'] . '">' . quees('orips_tipo_requisito', $row1['id_orips_tipo_requisito']) . '</option>';
                            }
                            $result1->free_result();
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Descripcion</label>
                        <textarea name="descripcion" class="form-control" cols="30" rows="10" maxlength="500"><?php echo $row['descripcion'] ? $row['descripcion'] : ''; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()"> Cancelar</button>
                    <input type="submit" name="actualizarequisito" class="btn btn-success btn-xs" value="Actualizar">
                </div>
            <?php
            }
            $result->free_result();
            ?>
        </form>
    <?php } ?>

    <?php if ($path == 'chat') { ?>
        <div class="box box-widget">
            <h6><b>Historial</b></h6>
            <div class="box-footer box-comments divscroll400">

                <?php
                $query2 = "SELECT * FROM orips_requisito_historial WHERE id_orips_requisito=" . $id . " AND estado_orips_requisito_historial=1 ORDER BY fecha_registro DESC";
                $result2 = $mysqli->query($query2);
                while ($row2 = $result2->fetch_assoc()) { ?>
                    <div class="box-comment">
                        <div class="comment-text" style="margin-left: 0px;">
                            <span class="username" style="margin-left: 0px;">
                                <?php echo quees('funcionario', $row2['id_funcionario']); ?>
                                <span class="text-muted pull-right"><?php echo $row2['fecha_registro']; ?></span>
                            </span>
                            <?php echo $row2['nombre_orips_requisito_historial']; ?>
                        </div>
                    </div>
                <?php }
                $result2->free_result();
                ?>

            </div>

            <div class="box-footer">
                <form action="" method="POST" name="formenviomensajes">
                    <input type="hidden" name="id_orips_requisito" value="<?php echo $id; ?>">
                    <textarea name="nombre_orips_requisito_historial" class="form-control" cols="30" rows="10" maxlength="400" placeholder="Escribe Mensaje 400 caracteres ..."></textarea>
                    <div class="pull-right">
                        <input type="submit" name="enviomensajes" class="btn btn-success btn-sm" value="Enviar">
                    </div>
                </form>
            </div>

        </div>
    <?php } ?>
<?php }

<?php
if (isset($_POST['option']) and "" != $_POST['option']) {
    require_once('../conf.php');
    require_once('listas.php');

    $RadicadoIris = $_POST['option'];
?>

    <div class="row">
        <div class="col-md-12">

            <div class="box-body">
                <div class="direct-chat-messages" style="min-height:500px;">
                    <?php
                    $query = sprintf("SELECT * FROM devolucion_rechazo
                    WHERE nombre_devolucion_dinero = '" . $RadicadoIris . "' order by fecha_rechazo desc");
                    $select = mysql_query($query, $conexion) or die(mysql_error());
                    $row = mysql_fetch_assoc($select);
                    $totalRows = mysql_num_rows($select);
                    if (0 < $totalRows) {
                        do {
                            echo '<div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                          <span class="direct-chat-name pull-left">';
                            echo quees('funcionario', $row['id_funcionario_rechazo']);
                            echo  '</span>
                          <span class="direct-chat-timestamp pull-right">' . $row['fecha_rechazo'] . '</span>
                        </div>
                        <span class="direct-chat-img" style="border:solid 2px red; padding:4px 12px; font-size:20px; color:red;">
                            <b>R</b>
                        </span>
                        <div class="direct-chat-text">
                          ' . $row['mensaje_rechazo'] . '
                        </div>';
                            if (0 == $row['estado_devolucion_rechazo']) { ?>

                                <br><br>
                                <form method="POST" name="solucionDevolucion">
                                    <input type="hidden" name="id_devolucion_rechazo" value="<?php echo $row['id_devolucion_rechazo'] ?>" required>
                                    <textarea name="mensaje_solucion" spellcheck="true" lang="es" cols="10" rows="10" class="form-control" id="texto_devolucion_dinero_rechazo_solucion" required> </textarea>
                                    <input type="submit" class="btn btn-success btn-flat" name="solucionDevolucion" value="Solucion">
                                </form>

                    <?php
                            }
                            echo '</div>';

                            if (isset($row['id_funcionario_solucion']) && isset($row['fecha_solucion'])) {
                                echo '<div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">';
                                echo quees('funcionario', $row['id_funcionario_solucion']);
                                echo '</span>
                                    <span class="direct-chat-timestamp pull-left">' . $row['fecha_solucion'] . '</span>
                                </div>
                                <span class="direct-chat-img" style="border:solid 2px green; padding:4px 12px; font-size:20px; color:green;">
                                <b>S</b>
                                </span>
                                <div class="direct-chat-text">
                                ' . $row['mensaje_solucion'] . '
                                </div>
                            </div><hr>';
                            }
                        } while ($row = mysql_fetch_assoc($select));
                    }
                    mysql_free_result($select);
                    ?>

                    <?php if (1 == $row['estado_devolucion_rechazo']) { ?>
                        <br><br><label>Realizar un Nuevo Rechazo</label>
                        <form method="POST" name="rechazoDevolucion">
                            <input type="hidden" name="nombre_devolucion_dinero" value="<?php echo $RadicadoIris; ?>" required>
                            <textarea name="mensaje_rechazo" spellcheck="true" lang="es" cols="100%" rows="10" class="form-control" id="texto_devolucion_dinero_rechazo_rechazo" required> </textarea>
                            <input type="submit" class="btn btn-danger btn-flat" name="rechazoDevolucion" value="Rechazo">
                        </form>
                    <?php } ?>

                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript" charset="utf-8" async defer>
        $(function() {
            CKEDITOR.replace('texto_devolucion_dinero_rechazo_solucion');
        });
        $(function() {
            CKEDITOR.replace('texto_devolucion_dinero_rechazo_rechazo');
        });
    </script>
<?php
}

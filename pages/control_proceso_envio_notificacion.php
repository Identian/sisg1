<?php
if (isset($_POST['option'])) {
    require_once('../conf.php');
    require_once('listas.php');
    $option = explode("-", $_POST['option']);

    $id_cd_detalle_accion = $option[0];
    $id_cd_accion_fk_cd_detalle_accion = $option[1];
    $id_cd_notificacion = $option[2];
    $GlobalTipoDeOficina = $option[3];
    $idControlDisciplinario = $option[4];

    $query12 = "SELECT * FROM cd_notificacion  WHERE id_cd_notificacion=$id_cd_notificacion AND estado_cd_notificacion=1";
    $result = $mysqli->query($query12);
    $row12 = $result->fetch_array(MYSQLI_ASSOC);
?>

    <form action="" method="POST" name="formcontrolprocesoenvionotificacion">
        <div class="modal-body">
            <!-- CAMPOS PARA INSERTAR EN LA TABLA DE ANEXOS -->
            <input type="hidden" name="id_cd_accion_fk_cd_anexos" value="<?php echo $id_cd_detalle_accion; ?>">
            <?php $Query13 = "SELECT nombre_cd_accion FROM cd_accion WHERE id_cd_accion=$id_cd_accion_fk_cd_detalle_accion AND estado_cd_accion=1";
            $Result13 = $mysqli->query($Query13);
            $row13 = $Result13->fetch_array(MYSQLI_ASSOC) ?>
            <input type="hidden" name="nombre_cd_anexos" value="<?php echo $row13['nombre_cd_accion']; ?>">

            <?php echo '<p><a href="#"><img alt="logo supernotarioado" src="https://sisg.supernotariado.gov.co/images/cabezotesnr-2023.jpg" style="height:53px; width:100%" /></a></p>'; ?><br>
            <div class="form-group text-left">
                <label><b>Asunto</b></label>
                <input class="form-control" type="text" name="asunto_cd_historial_notificacion" value="<?php echo $row12['asunto_cd_notificacion']; ?>" required>
            </div>
            <div class="form-group text-left">
                <label><b>Correo Desde</b></label>
                <?php
                // MOSTRAR LOS CORREOS RELACIONADOS AL ENVIO
                if (isset($GlobalTipoDeOficina) && 1 == $GlobalTipoDeOficina) { ?>
                    <input class="form-control" type="text" name="desde_cd_historial_notificacion" required>
                    <div class="help-block" style="font-size:12px;"><b>Usar solo uno de los dos correos:</b><br> procesos.disciplinarios@supernotariado.gov.co <br> juzgamientoocdi@supernotariado.gov.co</div>
                <?php } elseif (isset($GlobalTipoDeOficina) && 2 == $GlobalTipoDeOficina) { ?>
                    <input class="form-control" type="text" name="desde_cd_historial_notificacion" required>
                    <div class="help-block" style="font-size:12px;"><b>Usar solo uno de los dos correos:</b><br> instrucciondisciplinariaregistral@supernotariado.gov.co <br> alertasinstrucciondisciplinariaregistral@supernotariado.gov.co</div>
                <?php } elseif (isset($GlobalTipoDeOficina) && 3 == $GlobalTipoDeOficina) { ?>
                    <input class="form-control" type="text" name="desde_cd_historial_notificacion" value="notificacionesdisciplinariosdn@supernotariado.gov.co" readonly required>
                <?php } elseif (isset($GlobalTipoDeOficina) && 4 == $GlobalTipoDeOficina) { ?>
                    <input class="form-control" type="text" name="desde_cd_historial_notificacion" value="instrucciondisciplinariacuradores@supernotariado.gov.co" readonly required>
                <?php } elseif (isset($GlobalTipoDeOficina) && 5 == $GlobalTipoDeOficina) { ?>
                    <input class="form-control" type="text" name="desde_cd_historial_notificacion" value="juzgamiento.oaj@supernotariado.gov.co" readonly required>
                <?php } elseif (isset($GlobalTipoDeOficina) && 6 == $GlobalTipoDeOficina) { ?>
                    <input class="form-control" type="text" name="desde_cd_historial_notificacion" value="sisg@supernotariado.gov.co" readonly required>
                <?php } ?>
            </div>

            <div class="form-group text-left">
                <input type="radio" name="check_historial_notificacion" value="correo" id="correo" checked> Notificacion Correo &nbsp; &nbsp;
                <input type="radio" name="check_historial_notificacion" value="fisica" id="fisica"> Notificacion Fisica
            </div>

            <div class="form-group text-left">
                <label>Correo Destino</label>
                <input class="form-control" type="text" name="para_cd_historial_notificacion" id="inputUno">
                <div class="help-block" style="font-size:12px;">Solo recibe correos seguidos por coma, sin espacios. Ejemplo: correo@gmail.com,correodos@gmail.com</div>
            </div>

            <div class="form-group text-left">
                <label>Dirección de Destino</label>
                <input class="form-control" type="text" name="direccion_destino_cd_historial_notificacion" id="inputDos">
            </div>

            <div class="form-group text-left">
                <label class="control-label"><span style="color:#ff0000;">*</span> Iris Para:</label>
                <select class="form-control" name="id_iris_para_cd_historial_notificacion" id="selectOpcionesIris" required>
                    <option value="" selected></option>
                    <option value="1642">NO ES SERVIDOR PÚBLICO DE LA SNR (NIVEL CENTRAL)</option>
                    <?php
                    $sql = "SELECT username_iris, nombre_funcionario FROM funcionario WHERE (username_iris IS NOT NULL OR '' != username_iris) AND estado_funcionario=1 AND id_cargo != 8 ORDER BY nombre_funcionario ASC";
                    $result = $mysqli->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=" .  $row['username_iris'] . ">" . $row['nombre_funcionario'] . "</option>";
                        }
                    }
                    $result->free_result();
                    ?>
                </select>
                <input class="form-control" type="text" name="nombre_para_cd_historial_notificacion" placeholder="Nombre y Apellido" id="inputNoTieneIrisExterno" style="display: none;">
            </div>

            <div class="form-group text-left">
                <span style="color:#ff0000;">*</span><label><b>Tipo de Correspondencia</b></label>
                <select class="form-control" name="id_tipo_correspondencia_cd_historial_notificacion" required>
                    <option value="" selected></option>
                    <option value="ER">Externo Recibido ER</option>
                    <option value="IE">Interno Enviado IE</option>
                    <option value="EE">Externo Enviado EE</option>
                </select>
            </div>
            <div class="form-group text-left">
                <span style="color:#ff0000;">*</span><label>Tipo Documento</label>
                <select class="form-control" name="id_tipo_doc_cd_historial_notificacion" required>
                    <option value="" selected></option>
                    <?php $query13 = "SELECT * FROM tipo_documento_iris WHERE estado_tipo_documento_iris=1 ORDER BY nombre_tipo_documento_iris ASC";
                    $result13 = $mysqli->query($query13);
                    while ($row13 = $result13->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value="' . $row13['idtipodocumento'] . '">' . $row13['nombre_tipo_documento_iris'] . '</option>';
                    } ?>
                </select>
            </div>
            <div class="form-group text-left">
                <span style="color:#ff0000;">*</span><label>Detalle del Correo</label>
                <textarea class="form-control" name="cuerpo_cd_historial_notificacion" id="textareaProcesoEnvioNot" required>
                    <?php echo $row12['cuerpo_cd_notificacion']; ?>
                    <?php if ($row12['id_cd_notificacion'] == 2 || $row12['id_cd_notificacion'] == 16) {
                        echo 'https://sisg.supernotariado.gov.co/expediente/' . $idControlDisciplinario . '.jsp';
                    } ?>
                </textarea>
            </div>

            <div class="form-group text-left">
                <?php $query4 = "SELECT * FROM cd_anexos 
                        WHERE cd_anexos.id_cd_fk_cd_anexos = $idControlDisciplinario 
                        AND definitivo_cd_anexos=1 
                        AND estado_cd_anexos=1
                        ORDER BY posicion_cd_anexos ASC";
                $Result4 = $mysqli->query($query4); ?>
                <ul>
                    <!-- DOCUMENTOS DE SISG EN CARPETA SID -->
                    <?php
                    while ($row4 = $Result4->fetch_array(MYSQLI_ASSOC)) {
                        if (isset($row4['id_cd_anexos'])) {
                            if (isset($row4['observacion_doc_cd_anexos']) and 'Cargado desde Notificacion' == $row4['observacion_doc_cd_anexos']) {
                                echo '
                                <input type="checkbox" value="' . $row4['hash_cd_anexos'] . '" name="array_cd_anexos[]" />
                                <a href="filesnr/sid/' . $row4['ano_creacion_cd_anexos'] . '/' . $row4['hash_cd_anexos'] . '.pdf" target="_blank"><img src="images\pdf.png" alt="" style="width:15px;"> ' . $row4['id_cd_anexos'] . '-' . $row4['nombre_cd_anexos'] . '</a>';
                                echo '<br/>';
                            } else {
                                if (isset($row4['extension_cd_anexos']) && 'pdf' == $row4['extension_cd_anexos'] || 'PDF' == $row4['extension_cd_anexos']) {
                                    echo '
                                    <input type="checkbox" value="' . $row4['hash_cd_anexos'] . '" name="array_cd_anexos[]" />
                                    <a href="https://servicios.supernotariado.gov.co/filesidtemp/' . $row4['hash_cd_anexos'] . '.pdf" target="_blank"><img src="images\pdf.png" alt="" style="width:15px;"> ' . $row4['id_cd_anexos'] . '-' . $row4['nombre_cd_anexos'] . '</a>';
                                    echo '<br/>';
                                }
                            }
                        }
                    } ?>
                </ul>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
            <input type="text" class="btn btn-success btn-xs" value="Guardar" onclick="pregunta()" name="editar_cd_historial_notificacion">
        </div>
    </form>

<?php } ?>

<script>
    function pregunta() {
        var asunto = document.getElementsByName("asunto_cd_historial_notificacion")[0].value;
        var desdecorreo = document.getElementsByName("desde_cd_historial_notificacion")[0].value;
        var tipocorrespondencia = document.getElementsByName("id_tipo_correspondencia_cd_historial_notificacion")[0].value;
        var tipodocumento = document.getElementsByName("id_tipo_doc_cd_historial_notificacion")[0].value;
        var cuerpocorresondencia = document.getElementsByName("cuerpo_cd_historial_notificacion")[0].value;

        if ((asunto == "") || (desdecorreo == "") || (tipocorrespondencia == "") || (tipodocumento == "") || (cuerpocorresondencia == "")) { //COMPRUEBA CAMPOS VACIOS
            alert("Los campos no pueden quedar vacios");
            return false;
        }
        if (true) {
            if (confirm('¿Estas seguro de enviar correo electrónico?')) {
                document.formcontrolprocesoenvionotificacion.submit()
            }
        }
    }

    $(function() {
        let inputUno = document.getElementById('inputUno');
        let inputDos = document.getElementById('inputDos');

        inputDos.disabled = true;

        document.getElementById('correo').addEventListener('click', function(e) {
            inputUno.disabled = false;
            inputDos.disabled = true;
            inputDos.value = "";
        });

        document.getElementById('fisica').addEventListener('click', function(e) {
            inputUno.disabled = true;
            inputDos.disabled = false;
            inputUno.value = "";
        });
    });

    // OCULTAR 
    document.getElementById('selectOpcionesIris').addEventListener('change', function() {
        mostrarOcultarElemento();
    });

    function mostrarOcultarElemento() {
        const opcionSeleccionada = document.getElementById('selectOpcionesIris').value;

        if (opcionSeleccionada === '1642') {
            document.getElementById('inputNoTieneIrisExterno').style.display = 'block';
        } else {
            document.getElementById('inputNoTieneIrisExterno').style.display = 'none';
        }
    }
    mostrarOcultarElemento();
</script>
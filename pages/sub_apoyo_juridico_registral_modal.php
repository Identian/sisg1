<?php
if (isset($_POST['option']) && "" != $_POST['option']) {
    session_start();
    require_once('../conf.php');
    require_once('listas.php');

    $division = explode("-", $_POST['option']);
    $path = $division[0]; // PATH
    $id = $division[1]; // ID

    // FECHA ACTUAL
    date_default_timezone_set("America/Bogota");
    $fechaActual = date("Y-m-d H:i:s");
    $anoActual = date("Y");
    $idFuncionario = $_SESSION['snr'];

    // PRIVILEGIOS
    $nump167 = privilegios(167, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Admin 
    $nump168 = privilegios(168, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Profesional
    $nump171 = privilegios(171, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Subdirector
    $nump172 = privilegios(172, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Notificador
?>
    <script src="../plugins/ckeditor40/ckeditor.js"></script>

    <style>
        .titulos {
            text-align: center;
            font-weight: 900;
            padding-bottom: 15px;
        }

        .modal-footer {
            float: right !important;
            padding: 10px 20px 0 0;
        }
    </style>

    <?php if ('recurrente' == $path) { ?>
        <div class="titulos"> Nuevo Recurrente </div>
        <form action="" name="recurrentesajr" method="POST" id="recurrentesajr">
            <input type="hidden" name="fk_id_sajr" value="<?php echo $id; ?>">
            <div class="row">


                <div class="col-md-4">Tipo</div>
                <div class="col-md-8">
                    <select style="width: 100%;" class="select_search_recurrentesajr" name="fk_id_tipo_documento">
                        <option value="">Seleccionar</option>
                        <?php echo lista('tipo_documento', '') ?>
                    </select>
                </div>

                <div class="col-md-4">Numero Documento</div>
                <div class="col-md-8">
                    <input class="form-control" type="number" name="numero_documento">
                </div>

                <div class="col-md-4">Nombre y Apellido</div>
                <div class="col-md-8">
                    <input class="form-control" type="text" name="nombre_sajr_incluido">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs" name="guardarRecurrenteSajr" value="guardarRecurrenteSajr"> Guardar </button>
                </div>

            </div>
        </form>
    <?php } ?>

    <?php if ('oficinas_registro' == $path) { ?>
        <div class="titulos"> Nuevo</div>
        <form action="" name="recurrentesajr" method="POST" id="recurrentesajr">
            <input type="hidden" name="fk_id_sajr" value="<?php echo $id; ?>">
            <div class="row">

                <div class="col-md-4">Oficina Registro</div>
                <div class="col-md-8">
                    <select style="width: 100%;" class="select_search_recurrentesajr" name="nombre_sajr_incluido">
                        <option value="">Seleccionar</option>
                        <?php echo lista('oficina_registro', '') ?>
                    </select>
                </div>

                <div class="col-md-4">Matriculas</div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="matriculas">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs" name="guardarOficinaRegistroSajr" value="guardarOficinaRegistroSajr"> Guardar </button>
                </div>

            </div>
        </form>
    <?php } ?>

    <?php if ('asignacion' == $path) { ?>
        <div class="titulos"> Asignacion </div>
        <form action="" name="asignacionsajr" method="POST">
            <input type="hidden" name="fk_id_sajr" value="<?php echo $id; ?>">
            <div class="row">

                <div class="col-md-4">Usuario Asignado</div>
                <div class="col-md-8">
                    <select class="form-control" name="fk_hasta_id_funcionario">
                        <option value=""></option>
                        <?php $query1 = "SELECT DISTINCT(fp.id_funcionario) AS fp_funcionario_perfil FROM funcionario_perfil AS fp WHERE fp.id_perfil IN (167,168,171,172) AND fp.estado_funcionario_perfil=1";
                        $result1 = $mysqli->query($query1);
                        while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row1['fp_funcionario_perfil']; ?>"><?php echo quees('funcionario', $row1['fp_funcionario_perfil']); ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs" name="btnGuardarAsignacionSajr" value="btnGuardarAsignacionSajr"> Guardar </button>
                </div>

            </div>
        </form>

        <?php $result1->free_result(); ?>
    <?php } ?>

    <?php if ('traslado' == $path) { ?>
    <?php } ?>

    <?php if ('nuevaactividad' == $path) { ?>
        <div class="titulos"> Nueva Actividad </div>
        <form action="" name="nuevaactividadsajr" method="POST">
            <div class="row">

                <div class="col-md-4"><span style="color:red">*</span> Actividad</div>
                <div class="col-md-8">
                    <select name="fk_id_sajr_opcion" class="form-control" required>
                        <option value=""></option>
                        <?php 
                        if (1 == $_SESSION['rol']) {
                            echo listapordefectocondicion('sajr_opcion', '', '', "AND (prefijo_sajr_opcion LIKE '%actividad%')");
                        } elseif (0 < $nump167) {
                            echo listapordefectocondicion('sajr_opcion', '', '', "AND (prefijo_sajr_opcion LIKE '%actividad%')");
                        } elseif (0 < $nump168) {
                            echo listapordefectocondicion('sajr_opcion', '', '', "AND (estado_proceso_sajr_opcion LIKE '%EN ESTUDIO%') OR (estado_proceso_sajr_opcion LIKE '%RESOLUCION%')");
                        } elseif (0 < $nump171) {
                            echo listapordefectocondicion('sajr_opcion', '', '', "AND (estado_proceso_sajr_opcion LIKE '%FIRMA%')");
                        } elseif (0 < $nump172) {
                            echo listapordefectocondicion('sajr_opcion', '', '', "AND (estado_proceso_sajr_opcion LIKE '%NOTIFICACION%')");
                        } else {
                            echo '<option value=""></option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-4">Fecha Ejecucion</div>
                <div class="col-md-8">
                    <input type="date" class="form-control" name="fecha_ejecucion">
                </div>

                <div class="col-md-4">Fecha Notificación</div>
                <div class="col-md-8">
                    <input type="date" class="form-control" name="fecha_notificacion">
                </div>                

                <div class="col-md-4">Observacion</div>
                <div class="col-md-8">
                    <textarea class="form-control" name="observacion_sajr_detalle"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs" name="guardarActividadSajr" value="guardarActividadSajr"> Guardar </button>
                </div>

            </div>
        </form>
    <?php } ?>

    <?php if ('editaractividad' == $path) { ?>
        <?php $query1 = "SELECT * FROM sajr_detalle WHERE id_sajr_detalle=$id AND estado_sajr_detalle=1 LIMIT 1";
        $result1 = $mysqli->query($query1);
        $row1 = $result1->fetch_array(MYSQLI_ASSOC);
        ?>
        <div class="titulos"> Editar Actividad </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Observacion </div>
                <div class="input-group col-md-8">
                    <textarea class="form-control" id="<?php echo $CampoFrom = gia(); ?>" required><?php echo $row1['observacion_sajr_detalle']; ?></textarea>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseSajr(
                                    '<?php echo $CampoFrom; ?>',
                                    '<?php echo encrypt('sajr_detalle-observacion_sajr_detalle-id_sajr_detalle-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>
        </div>

        <?php $result1->free(); ?>
    <?php } ?>

    <?php if ('editarinicial' == $path) { ?>
        <div class="row">
            <?php $query1 = "SELECT * FROM sajr WHERE id_sajr=$id AND estado_sajr=1 LIMIT 1";
            $result1 = $mysqli->query($query1);
            $row1 = $result1->fetch_array(MYSQLI_ASSOC); ?>
            <div class="titulos"> Editar Informacion Inicial </div>

            <div class="col-md-12">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Radicado </div>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $row1['radicado']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseSajr(
                                    '<?php echo $CampoFrom; ?>',
                                    '<?php echo encrypt('sajr-radicado-id_sajr-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Fecha Radicado </div>
                <div class="input-group col-md-8">
                    <input type="date" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $row1['fecha_radicado']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseSajr(
                                    '<?php echo $CampoFrom; ?>',
                                    '<?php echo encrypt('sajr-fecha_radicado-id_sajr-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Medio Radicado </div>
                <div class="input-group col-md-8">
                    <select name="medio_radicado" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" required>
                        <option value="<?php echo $row1['medio_radicado']; ?>" selected><?php echo quees('sajr_opcion', $row1['medio_radicado']); ?></option>
                        <option value=""></option>
                        <?php echo listapordefectocondicion('sajr_opcion', '', '', "AND prefijo_sajr_opcion='medio_radicacion'") ?>
                    </select>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseSajr(
                                    '<?php echo $CampoFrom; ?>',
                                    '<?php echo encrypt('sajr-medio_radicado-id_sajr-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Tipo Recurso </div>
                <div class="input-group col-md-8">
                    <select name="tipo_recurso" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" required>
                        <option value="<?php echo $row1['tipo_recurso']; ?>" selected><?php echo quees('sajr_opcion', $row1['tipo_recurso']); ?></option>
                        <option value=""></option>
                        <?php echo listapordefectocondicion('sajr_opcion', '', '', "AND prefijo_sajr_opcion='tipo_recurso'") ?>
                    </select>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseSajr(
                                    '<?php echo $CampoFrom; ?>',
                                    '<?php echo encrypt('sajr-tipo_recurso-id_sajr-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-12"><span style="color:#ff0000;">*</span> Descripcion</div>
                <div class="input-group col-md-12">
                    <textarea class="ckeditor" id="<?php echo $CampoFrom = gia(); ?>"><?php echo $row1['descripcion_sajr']; ?></textarea>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseSajrCreator(
                                '<?php echo $CampoFrom; ?>',
                                '<?php echo encrypt('sajr-descripcion_sajr-id_sajr-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>
            <?php $result1->free(); ?>
        </div>
    <?php } ?>

    <?php if ('adjuntarpdf' == $path) { ?>
        <div class="titulos"> Listado de Anexos </div>
        <form action="" method="POST" name="guardarDocumentoSajr" enctype="multipart/form-data">
            <input type="hidden" name="fk_id_sajr_detalle" value="<?php echo $id; ?>">
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="tel" name="nombre_sajr_documento" class="form-control" placeholder="Nombre del Documento" required>
                </div>
                <div class="col-sm-4">
                    <input type="file" name="file_sajr_documento" required>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarDocumentoSajr" value="guardarDocumentoSajr"><i class="fa fa-fw fa-plus"></i> Guardar</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Listado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php $query4 = "SELECT * FROM sajr_documento WHERE fk_id_sajr_detalle=$id AND estado_sajr_documento=1 ORDER BY fecha DESC";
                $result4 = $mysqli->query($query4);
                while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) { ?>
                    <tr>
                        <td>
                            <a href="filesnr/sajr/<?php echo $row4['ano_sajr_documento']; ?>/<?php echo $row4['url_sajr_documento']; ?>" target="_blank"><img src="images/pdf.png" alt="" style="width:15px;"><?php echo $row4['nombre_sajr_documento']; ?></a> <?php echo $row4['fecha']; ?><br>
                        </td>
                        <td>
                            <form action="" method="POST" name="formBorrarDocumentoSajr">
                                <input type="hidden" name="id_sajr_documento" value="<?php echo $row4['id_sajr_documento']; ?>">
                                <button style="border:none; background:white;" type="submit" name="btnBorrarDocumentoSajr" value="btnBorrarDocumentoSajr"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php $result4->free(); ?>
    <?php } ?>

<?php } ?>

<script>
    function modalCloseSajr(valorCampo, dato) {
        let campo = $('#' + valorCampo).val();
        $.ajax({
            url: "pages/modal_actualiza.php",
            type: 'POST',
            data: {
                campo: campo,
                option: dato
            },
            success: function(response) {
                swal({
                    title: "Actualizado!",
                    text: false,
                    timer: 400
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr, status, error);
            }
        });
    };

    function modalCloseSajrCreator(valorCampo, dato) {
        const data = CKEDITOR.instances[valorCampo].getData();

        $.ajax({
            url: "pages/modal_actualiza.php",
            type: 'POST',
            data: {
                campo: data,
                option: dato
            },
            success: function(response) {
                swal({
                    title: "Actualizado!",
                    text: false,
                    timer: 400
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr, status, error);
            }
        });
    };


    $(document).ready(function() {
        $(".select_search_trasladosajr").select2({
            dropdownParent: $('#trasladosajr')
        });
        $(".select_search_recurrentesajr").select2({
            dropdownParent: $('#recurrentesajr')
        });
    });
</script>
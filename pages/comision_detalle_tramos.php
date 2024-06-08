<?php
if (isset($_POST['option']) && "" != $_POST['option']) {
    session_start();
    require_once('../conf.php');
    require_once('listas.php');

    $nump101 = privilegios(101, $_SESSION['snr']); // Comision Revisor

    $division = explode("-", $_POST['option']);
    $path = $division[0]; // PATH
    $id = $division[1]; // ID
?>
    <?php if ('nuevoTramo' == $path) { ?>
        <label>Nuevo Tramo</label><br><br>
        <form method="POST" name="formGuardarNuevoTramoComision" id="formGuardarNuevoTramoComision">
            <input type="hidden" name="fk_id_comision_detalle" value="<?php echo $id; ?>">
            <div class="row" style="margin-bottom:20px;">
                <div class="col-md-2"><span style="color:#ff0000;">*</span> Desde</div>
                <div class="col-md-4">
                    <select style="width: 100%;" class="select2ComisionNuevo" name="desde_id_municipio" required>
                        <option value="" selected>--Seleccionar--</option>
                        <?php $query5 = "SELECT id_municipio, nombre_departamento, nombre_municipio FROM municipio, departamento WHERE departamento.id_departamento=municipio.id_departamento AND estado_municipio=1 ORDER BY nombre_municipio ASC";
                        $result5 = $mysqli->query($query5);
                        while ($row5 = $result5->fetch_assoc()) { ?>
                            <option value="<?php echo $row5['id_municipio']; ?>">
                                <?php echo $row5['nombre_municipio'] . '-' . $row5['nombre_departamento']; ?>
                            </option>
                        <?php }
                        $result5->free(); ?>
                    </select>
                </div>
                <div class="col-md-2"><span style="color:#ff0000;">*</span> Hasta</div>
                <div class="col-md-4">
                    <select style="width: 100%;" class="select2ComisionNuevo" name="hasta_id_municipio" required>
                        <option value="" selected>--Seleccionar--</option>
                        <?php $query5 = "SELECT id_municipio, nombre_departamento, nombre_municipio FROM municipio, departamento WHERE departamento.id_departamento=municipio.id_departamento AND estado_municipio=1 ORDER BY nombre_municipio ASC";
                        $result5 = $mysqli->query($query5);
                        while ($row5 = $result5->fetch_assoc()) { ?>
                            <option value="<?php echo $row5['id_municipio']; ?>">
                                <?php echo $row5['nombre_municipio'] . '-' . $row5['nombre_departamento']; ?>
                            </option>
                        <?php }
                        $result5->free(); ?>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px;">
                <div class="col-md-2"><span style="color:#ff0000;">*</span> Medio Transporte </div>
                <div class="col-md-10">
                    <select style="width: 100%;" class="select2ComisionNuevo ocultarDivMedioTransporte" name="medio_transporte">
                        <option value="" selected>--Seleccionar--</option>
                        <option value="Aereo">Aereo</option>
                        <option value="Terreste">Terreste</option>
                        <option value="Fluvial">Fluvial</option>
                        <!-- <option value="Multimodal">Multimodal</option> -->
                    </select>
                </div>
            </div>
            <div class="ocultarDiv" style="display: none">
                <div class="row" style="margin-bottom:20px;">
                    <div class="col-md-2"> Centro Costos Viaticos </div>
                    <div class="col-md-10">
                        <select style="width: 100%;" class="select2ComisionNuevo" name="centro_costos">
                            <option value="" selected>--Seleccionar--</option>
                            <?php echo listaparamentro('comision_centro_costos', 'tipo', 'numero', 'viaticos'); ?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px;">
                    <div class="col-md-2"> Centro Costos Tiquetes </div>
                    <div class="col-md-10">
                        <select style="width: 100%;" class="select2ComisionNuevo" name="centro_costos_viaticos">
                            <option value="" selected>--Seleccionar--</option>
                            <?php echo listaparamentro('comision_centro_costos', 'tipo', 'numero', 'tiquetes'); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:10px 20px;">
                <div class="pull-right">
                    <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarNuevoTramo" value="guardarNuevoTramo"> Guardar </button>
                </div>
            </div>
        </form>
    <?php } ?>

    <?php if ('editarTramo' == $path) { ?>
        <label>Actualizar Tramo</label><br><br>
        <?php $querycontra = "SELECT * FROM comision_detalle_tramo WHERE id_comision_detalle_tramo = $id";
        $resultcontra = $mysqli->query($querycontra);
        $rowcontra = $resultcontra->fetch_array(MYSQLI_ASSOC); ?>

        <div class="row" id="formActualizarTramoComision">
            <div class="col-md-6">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Desde </div>
                <div class="input-group col-md-8">

                    <select style="width: 100%;" class="select2ComisionActualizar" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['desde_id_municipio'])) { ?>
                            <option value="<?php echo $rowcontra['desde_id_municipio']; ?>" selected><?php echo quees('municipio', $rowcontra['desde_id_municipio']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query5 = "SELECT id_municipio, nombre_departamento, nombre_municipio FROM municipio, departamento WHERE departamento.id_departamento=municipio.id_departamento AND estado_municipio=1 ORDER BY nombre_municipio ASC";
                        $result5 = $mysqli->query($query5);
                        while ($row5 = $result5->fetch_assoc()) { ?>
                            <option value="<?php echo $row5['id_municipio']; ?>"><?php echo $row5['nombre_municipio'] . '-' . $row5['nombre_departamento']; ?>
                            </option>
                        <?php }
                        $result5->free(); ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" style="height:28px;" class="btn btn-success" onclick="modalCloseActualizaTramosComision(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('comision_detalle_tramo-desde_id_municipio-id_comision_detalle_tramo-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Hasta </div>
                <div class="input-group col-md-8">

                    <select style="width: 100%;" class="select2ComisionActualizar" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['hasta_id_municipio'])) { ?>
                            <option value="<?php echo $rowcontra['hasta_id_municipio']; ?>" selected><?php echo quees('municipio', $rowcontra['hasta_id_municipio']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query5 = "SELECT id_municipio, nombre_departamento, nombre_municipio FROM municipio, departamento WHERE departamento.id_departamento=municipio.id_departamento AND estado_municipio=1 ORDER BY nombre_municipio ASC";
                        $result5 = $mysqli->query($query5);
                        while ($row5 = $result5->fetch_assoc()) { ?>
                            <option value="<?php echo $row5['id_municipio']; ?>"><?php echo $row5['nombre_municipio'] . '-' . $row5['nombre_departamento']; ?>
                            </option>
                        <?php }
                        $result5->free(); ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" style="height:28px;" class="btn btn-success" onclick="modalCloseActualizaTramosComision(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('comision_detalle_tramo-hasta_id_municipio-id_comision_detalle_tramo-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Medio Transporte </div>
                <form action="" method="POST" name="actualizaCampoTransporte" style="display: inline;">
                    <div class="input-group col-md-8">

                        <input type="hidden" name="id_comision_detalle_tramo" value="<?php echo $rowcontra['id_comision_detalle_tramo']; ?>">
                        <input type="hidden" name="centro_costos" value="<?php echo $rowcontra['centro_costos']; ?>">
                        <input type="hidden" name="centro_costos_viaticos" value="<?php echo $rowcontra['centro_costos_viaticos']; ?>">
                        <select style="width: 100%;" class="select2ComisionActualizar ocultarDivMedioTransporte" name="medio_transporte" required>
                            <?php if (isset($rowcontra['medio_transporte'])) { ?>
                                <option value="<?php echo $rowcontra['medio_transporte']; ?>" selected><?php echo $rowcontra['medio_transporte']; ?></option>
                            <?php } ?>
                            <option value=""></option>
                            <option value="Aereo">Aereo</option>
                            <option value="Terreste">Terreste</option>
                            <option value="Fluvial">Fluvial</option>
                            <!-- <option value="Multimodal">Multimodal</option> -->
                        </select>

                        <span class="input-group-btn">
                            <button type="submit" style="height:28px;" class="btn btn-success" name="btnActualizarMedioTransporte" value="btnActualizarMedioTransporte">
                                <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                            </button>
                        </span>

                    </div>
                </form>
            </div>

            <?php if (1 == $_SESSION['rol'] || 0 < $nump101) { ?>
                <div class="col-md-6">
                    <div class="col-md-4"><span style="color:#ff0000;">*</span> Valor Transporte &nbsp;<b>$</b></div>
                    <div class="input-group col-md-8">
                        <input type="text" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo number_format($rowcontra['valor_trasporte'], 0, ',', '.'); ?>" required>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success" onclick="modalCloseActualizaTramosComision(
                            '<?php echo $CampoFrom; ?>',
                            '<?php echo encrypt('comision_detalle_tramo-valor_trasporte-id_comision_detalle_tramo-' . $id . '', cs()); ?>')">
                                <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                            </button>
                        </span>
                    </div>
                    <div style="color: #6c757d; font-size:10px; text-align: right;">Para actualizar, borrar por completo el campo</div>
                </div>
            <?php } ?>

            <div class="ocultarDiv" style="display: <?php echo $rowcontra['medio_transporte'] == 'Aereo' ? '' : 'none'; ?>">

                <div class="col-md-12">
                    <div class="col-md-2"><span style="color:#ff0000;">*</span> Centro Costos Viaticos </div>
                    <div class="input-group col-md-10">

                        <select style="width: 100%;" class="select2ComisionActualizar" id="<?php echo $CampoFrom = gia(); ?>">
                            <?php if (isset($rowcontra['centro_costos'])) { ?>
                                <option value="<?php echo $rowcontra['centro_costos']; ?>" selected><?php echo quees('comision_centro_costos', $rowcontra['centro_costos']); ?></option>
                            <?php } ?>
                            <option value=""></option>
                            <?php echo listaparamentro('comision_centro_costos', 'tipo', 'numero', 'viaticos'); ?>
                        </select>

                        <span class="input-group-btn">
                            <button type="button" style="height:28px;" class="btn btn-success" onclick="modalCloseActualizaTramosComision(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('comision_detalle_tramo-centro_costos-id_comision_detalle_tramo-' . $id . '', cs()); ?>')">
                                <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                            </button>
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-2"><span style="color:#ff0000;">*</span> Centro Costos Tiquetes </div>
                    <div class="input-group col-md-10">

                        <select style="width: 100%;" class="select2ComisionActualizar" id="<?php echo $CampoFrom = gia(); ?>">
                            <?php if (isset($rowcontra['centro_costos_viaticos'])) { ?>
                                <option value="<?php echo $rowcontra['centro_costos_viaticos']; ?>" selected><?php echo quees('comision_centro_costos', $rowcontra['centro_costos_viaticos']); ?></option>
                            <?php } ?>
                            <option value=""></option>
                            <?php echo listaparamentro('comision_centro_costos', 'tipo', 'numero', 'tiquetes'); ?>
                        </select>

                        <span class="input-group-btn">
                            <button type="button" style="height:28px;" class="btn btn-success" onclick="modalCloseActualizaTramosComision(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('comision_detalle_tramo-centro_costos_viaticos-id_comision_detalle_tramo-' . $id . '', cs()); ?>')">
                                <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                            </button>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>

    <?php if ('actualizarComisionado' == $path) { ?>
        <label>Actualizar Comisionado</label><br><br>
        <div class="row" style="padding: 10px;">
            <form action="" method="POST" name="updateComisionado">

                <?php
                $query6 = "SELECT * FROM comision_detalle WHERE id_comision_detalle=$id LIMIT 1";
                $result6 = $mysqli->query($query6);
                $row6 = $result6->fetch_assoc() ?>

                <input type="hidden" name="id_comision" value="<?php echo $row6['id_comision']; ?>">
                <input type="hidden" name="id_comision_detalle" value="<?php echo $id; ?>">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><span style="color:#ff0000;">*</span>Fecha Ida</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="fecha_ida" value="<?php echo $row6['fecha_ida']; ?>" required>
                    </div>
                    <label class="col-sm-2 col-form-label"><span style="color:#ff0000;">*</span>Fecha Regreso</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="fecha_regreso" value="<?php echo $row6['fecha_regreso']; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><span style="color:#ff0000;">*</span> Comisionado </label>
                    <div class="col-sm-10">
                        <?php $idGrupoArea = $_SESSION['snr_grupo_area'];
                        $idArea = buscarcampo('grupo_area', 'id_area', 'id_grupo_area=' . $idGrupoArea);
                        $datos = array();
                        $query8 = "SELECT * FROM grupo_area  WHERE id_area=$idArea AND estado_grupo_area=1";
                        $result8 = $mysqli->query($query8);
                        while ($row8 = $result8->fetch_array()) {
                            $datos[] = $row8['id_grupo_area'];
                        }
                        $cadena = implode(", ", $datos); ?>
                        <select class="form-control" name="id_funcionario">
                            <option value="<?php echo $row6['id_funcionario']; ?>" selected><?php echo quees('funcionario', $row6['id_funcionario']); ?></option>
                            <option value="">Seleccion</option>
                            <?php $query9 = "SELECT * FROM funcionario  WHERE id_grupo_area IN ($cadena) AND estado_funcionario=1";
                            $result9 = $mysqli->query($query9);
                            while ($row9 = $result9->fetch_array()) { ?>
                                <option value="<?php echo $row9['id_funcionario']; ?>"><?php echo $row9['nombre_funcionario']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><span style="color:#ff0000;">*</span> Objeto</label>
                    <div class="col-sm-10">
                        <textarea name="objeto" cols="30" class="form-control" maxlength="500" placeholder="Maximo 500 Caracteres" required><?php echo $row6['objeto']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Observacion </label>
                    <div class="col-sm-10">
                        <textarea name="observacion" cols="30" class="form-control" maxlength="500" placeholder="Maximo 500 Caracteres"><?php echo $row6['observacion']; ?></textarea>
                    </div>
                </div>

                <div class="pull-right">
                    <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarComisionado" value="updateComisionado"> Actualizar </button>
                </div>

                <?php $result6->free(); ?>
            </form>
        </div>
    <?php } ?>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        $(document).ready(function() {
            $(".select2ComisionNuevo").select2({
                dropdownParent: $('#formGuardarNuevoTramoComision')
            });
        });

        $(document).ready(function() {
            $(".select2ComisionActualizar").select2({
                dropdownParent: $('#formActualizarTramoComision')
            });
        });

        $('.ocultarDivMedioTransporte').on('change', function() {
            const selectValor = $(this).val();
            if (selectValor == 'Aereo' || selectValor == 'Multimodal') {
                $('.ocultarDiv').show();
            } else {
                $('.ocultarDiv').hide();
            }
        });

        function modalCloseActualizaTramosComision(valorCampo, dato) {
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
    </script>
<?php } ?>
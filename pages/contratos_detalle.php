<?php
if (isset($_POST['option'])) {
    session_start();
    require_once('../conf.php');
    require_once('listas.php');

    $division = explode("-", $_POST['option']);
    $path = $division[0]; // PATH
    $id = $division[1]; // ID

    $nump136 = privilegios(136, $_SESSION['snr']); // Administrador de Contratos

    // FECHA ACTUAL
    date_default_timezone_set("America/Bogota");
    $fechaActual = date("Y-m-d H:i:s");
    $anoActual = date("Y");

    // CONSULTA CONTRATO
    $querycontra = "SELECT * FROM nc_contratos WHERE id_nc_contratos = $id";
    $resultcontra = $mysqli->query($querycontra);
    $rowcontra = $resultcontra->fetch_array(MYSQLI_ASSOC);
?>
    <script src="../plugins/ckeditor40/ckeditor.js"></script>

    <style>
        .col-md-12 {
            margin-bottom: 20px;
        }

        .col-md-6 {
            margin-bottom: 20px;
        }

        .col-md-4 {
            margin-bottom: 20px;
        }

        .col-md-3 {
            margin-bottom: 20px;
        }
    </style>

    <?php if ('actualizar' == $path) { ?>
        <div class="row">

            <div class="col-md-6">
                <label><span style="color:red;">*</span> Numero Contrato <span style="font-size: 10px;">(campo requerido Minuta, certificación)</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['cod_datos_contrato']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                            '<?php echo $CampoFrom; ?>',
                            '<?php echo encrypt('nc_contratos-cod_datos_contrato-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label><span style="color:red;">*</span> Año <span style="font-size: 10px;">(campo requerido Minuta, certificación)</span></label>
                <div class="input-group">
                    <input type="number" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['ano_datos_contrato']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-ano_datos_contrato-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>


            <div class="col-md-6">
                <label>Funcionario</label>
                <div class="input-group">
                    <?php echo quees('funcionario', $rowcontra['id_funcionario']); ?>
                </div>
            </div>

            <div class="col-md-6">
                <label><span style="color:red;">*</span> Perfil <span style="font-size: 10px;">(campo requerido Minuta)</span></label>
                <div class="input-group">
                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>" required>
                        <?php if (isset($rowcontra['id_nc_salario'])) {
                            $idSalario = $rowcontra['id_nc_salario'];
                            $query14 = "SELECT id_nc_salario, nombre_nc_cargo, nombre_nc_salario FROM nc_salario LEFT JOIN nc_cargo ON nc_cargo.id_nc_cargo=nc_salario.id_nc_cargo WHERE id_nc_salario=$idSalario";
                            $result14 = $mysqli->query($query14);
                            $row14 = $result14->fetch_array(MYSQLI_ASSOC); ?>
                            <option value="<?php echo $rowcontra['id_nc_salario']; ?>" selected><?php echo $row14['nombre_nc_cargo'] . '-' . $row14['nombre_nc_salario']; ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $anoContrato = $rowcontra['ano_datos_contrato'];
                        $query10 = "SELECT id_nc_salario, nombre_nc_cargo, nombre_nc_salario FROM nc_salario LEFT JOIN nc_cargo ON nc_cargo.id_nc_cargo=nc_salario.id_nc_cargo WHERE estado_nc_salario=1 AND ano_nc_salario=$anoContrato AND estado_nc_cargo=1";
                        $result10 = $mysqli->query($query10);
                        while ($row10 = $result10->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row10['id_nc_salario']; ?>"><?php echo $row10['nombre_nc_cargo'] . '-' . $row10['nombre_nc_salario']; ?></option>
                        <?php } ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_nc_salario-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label><span style="color:red;">*</span> Funcionario Supervisor <span style="font-size: 10px;">(campo requerido Minuta)</span></label>
                <div class="input-group">

                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_funcionario_supervisor'])) { ?>
                            <option value="<?php echo $rowcontra['id_funcionario_supervisor']; ?>" selected><?php echo quees('funcionario', $rowcontra['id_funcionario_supervisor']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query4 = "SELECT * FROM funcionario WHERE estado_funcionario = 1 AND id_cargo=1 OR id_cargo=2 ORDER BY nombre_funcionario ASC";
                        $result4 = $mysqli->query($query4);
                        while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row4['id_funcionario']; ?>"><?php echo quees('funcionario', $row4['id_funcionario']); ?></option>
                        <?php };
                        ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_funcionario_supervisor-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>


            <div class="col-md-6">
                <label>Modalidad de Seleccion</label>
                <div class="input-group">

                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_opcion_modalidad_seleccion'])) { ?>
                            <option value="<?php echo $rowcontra['id_opcion_modalidad_seleccion']; ?>" selected><?php echo quees('nc_opcion', $rowcontra['id_opcion_modalidad_seleccion']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query5 = "SELECT * FROM nc_opcion WHERE estado_nc_opcion = 1 AND prefijo_nc_opcion='modalidad_seleccion' ORDER BY nombre_nc_opcion ASC";
                        $result5 = $mysqli->query($query5);
                        while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row5['id_nc_opcion']; ?>"><?php echo $row5['nombre_nc_opcion']; ?></option>
                        <?php };
                        ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_opcion_modalidad_seleccion-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label>Clase de Convenio</label>
                <div class="input-group">

                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_opcion_clase_convenio'])) { ?>
                            <option value="<?php echo $rowcontra['id_opcion_clase_convenio']; ?>" selected><?php echo quees('nc_opcion', $rowcontra['id_opcion_clase_convenio']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query6 = "SELECT * FROM nc_opcion WHERE estado_nc_opcion = 1 AND prefijo_nc_opcion='clase_convenio' ORDER BY nombre_nc_opcion ASC";
                        $result6 = $mysqli->query($query6);
                        while ($row6 = $result6->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row6['id_nc_opcion']; ?>"><?php echo $row6['nombre_nc_opcion']; ?></option>
                        <?php };
                        ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_opcion_clase_convenio-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label><span style="color:red;">*</span> Categoria de Servicio <span style="font-size: 10px;">(campo requerido Minuta)</span></label>
                <div class="input-group">
                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_opcion_categoria_servicio'])) { ?>
                            <option value="<?php echo $rowcontra['id_opcion_categoria_servicio']; ?>" selected><?php echo quees('nc_opcion', $rowcontra['id_opcion_categoria_servicio']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query9 = "SELECT * FROM nc_opcion WHERE estado_nc_opcion = 1 AND prefijo_nc_opcion='categoria_servicio' ORDER BY nombre_nc_opcion ASC";
                        $result9 = $mysqli->query($query9);
                        while ($row9 = $result9->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row9['id_nc_opcion']; ?>"><?php echo $row9['nombre_nc_opcion']; ?></option>
                        <?php };
                        ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_opcion_categoria_servicio-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label>Naturaleza del contrato</label>
                <div class="input-group">
                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_opcion_naturaleza'])) { ?>
                            <option value="<?php echo $rowcontra['id_opcion_naturaleza']; ?>" selected><?php echo quees('nc_opcion', $rowcontra['id_opcion_naturaleza']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query15 = "SELECT * FROM nc_opcion WHERE estado_nc_opcion = 1 AND prefijo_nc_opcion='naturaleza' ORDER BY nombre_nc_opcion ASC";
                        $result15 = $mysqli->query($query15);
                        while ($row15 = $result15->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row15['id_nc_opcion']; ?>"><?php echo $row15['nombre_nc_opcion']; ?></option>
                        <?php };
                        ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_opcion_naturaleza-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label>Afectacion del recurso</label>
                <div class="input-group">
                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_opcion_afectacion_recurso'])) { ?>
                            <option value="<?php echo $rowcontra['id_opcion_afectacion_recurso']; ?>" selected><?php echo quees('nc_opcion', $rowcontra['id_opcion_afectacion_recurso']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query15 = "SELECT * FROM nc_opcion WHERE estado_nc_opcion = 1 AND prefijo_nc_opcion='afectacion_recurso' ORDER BY nombre_nc_opcion ASC";
                        $result15 = $mysqli->query($query15);
                        while ($row15 = $result15->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row15['id_nc_opcion']; ?>"><?php echo $row15['nombre_nc_opcion']; ?></option>
                        <?php };
                        ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_opcion_afectacion_recurso-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label>Regimen</label>
                <div class="input-group">
                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_opcion_regimen'])) { ?>
                            <option value="<?php echo $rowcontra['id_opcion_regimen']; ?>" selected><?php echo quees('nc_opcion', $rowcontra['id_opcion_regimen']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query15 = "SELECT * FROM nc_opcion WHERE estado_nc_opcion = 1 AND prefijo_nc_opcion='regimen' ORDER BY nombre_nc_opcion ASC";
                        $result15 = $mysqli->query($query15);
                        while ($row15 = $result15->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row15['id_nc_opcion']; ?>"><?php echo $row15['nombre_nc_opcion']; ?></option>
                        <?php };
                        ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_opcion_regimen-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>cod_datos_contrato
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label><span style="color:red;">*</span> Ciudad de Ejecucion <span style="font-size: 10px;">(campo requerido Minuta)</span></label>
                <div class="input-group">

                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_municipio'])) { ?>
                            <option value="<?php echo $rowcontra['id_municipio']; ?>" selected><?php echo quees('municipio', $rowcontra['id_municipio']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query11 = "SELECT * FROM municipio WHERE estado_municipio = 1 ORDER BY nombre_municipio ASC";
                        $result11 = $mysqli->query($query11);
                        while ($row11 = $result11->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row11['id_municipio']; ?>"><?php echo quees('municipio', $row11['id_municipio']); ?></option>
                        <?php };
                        ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_municipio-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label>Abogado responsable</label>
                <div class="input-group">

                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_reponsable_abogado'])) { ?>
                            <option value="<?php echo $rowcontra['id_reponsable_abogado']; ?>" selected><?php echo quees('funcionario', $rowcontra['id_reponsable_abogado']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query8 = "SELECT * FROM funcionario WHERE estado_funcionario = 1 AND id_grupo_area IN(31,32,243)  ORDER BY nombre_funcionario ASC";
                        $result8 = $mysqli->query($query8);
                        while ($row8 = $result8->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row8['id_funcionario']; ?>"><?php echo quees('funcionario', $row8['id_funcionario']); ?></option>
                        <?php } ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_reponsable_abogado-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <label><span style="color:red;">*</span> Objeto <span style="font-size: 10px;">(campo requerido Minuta, Certificación)</span></label>
                <div class="input-group">
                    <textarea class="ckeditor" id="<?php echo $CampoFrom = gia(); ?>"><?php echo $rowcontra['objeto']; ?></textarea>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratosCreator(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-objeto-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <label><span style="color:red;">*</span> Obligaciones <span style="font-size: 10px;">(campo requerido Minuta, Certificación)</span></label>
                <div class="input-group">
                    <textarea class="ckeditor" id="<?php echo $CampoFrom = gia(); ?>"><?php echo $rowcontra['obligaciones_especificas']; ?></textarea>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratosCreator(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-obligaciones_especificas-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <label>Observacion</label>
                <div class="input-group">
                    <textarea class="ckeditor" id="<?php echo $CampoFrom = gia(); ?>"><?php echo $rowcontra['observacion']; ?></textarea>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratosCreator(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-observacion-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-3">
                <label><span style="color:red;">*</span> Fecha Acta Inicio <br><span style="font-size: 10px;">(campo requerido Minuta, Certificación)</span></label>
                <div class="input-group">
                    <input type="date" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['fecha_acta_inicio']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-fecha_acta_inicio-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-3">
                <label><span style="color:red;">*</span> Fecha Suscripcion Contrato <br><span style="font-size: 10px;">(campo requerido Certificación)</span></label>
                <div class="input-group">
                    <input type="date" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['fecha_inicio']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-fecha_inicio-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-3">
                <label><span style="color:red;">*</span> Fecha Terminacion <br><span style="font-size: 10px;">(campo requerido Minuta, Certificación)</span></label>
                <div class="input-group">
                    <input type="date" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['fecha_terminacion']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-fecha_terminacion-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-3">
                <label>Fecha Expedicion Garantia</label><br><br>
                <div class="input-group">
                    <input type="date" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['fecha_poliza']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-fecha_poliza-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label><span style="color:red;">*</span> Valor Inicial <span style="font-size: 10px;">(campo requerido Minuta, Certificación)</span></label>
                <div class="input-group">
                    <input type="number" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['valor_inicial']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-valor_inicial-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label>Profesion Contratista</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['profesion']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-profesion-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label>Numero de Actividad RUT</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['rut_actividad']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-rut_actividad-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label>Fecha Afiliación Arl</label>
                <div class="input-group">
                    <input type="date" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $rowcontra['fecha_arl']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-fecha_arl-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <label>Estado Contrato</label>
                <div class="input-group">

                    <select class="form-control" style="font-size: 90%" id="<?php echo $CampoFrom = gia(); ?>">
                        <?php if (isset($rowcontra['id_opcion_estado_contratos'])) { ?>
                            <option value="<?php echo $rowcontra['id_opcion_estado_contratos']; ?>" selected><?php echo quees('nc_opcion', $rowcontra['id_opcion_estado_contratos']); ?></option>
                        <?php } ?>
                        <option value=""></option>
                        <?php
                        $query15 = "SELECT * FROM nc_opcion WHERE estado_nc_opcion = 1 AND prefijo_nc_opcion='estado_contratos' ORDER BY nombre_nc_opcion ASC";
                        $result15 = $mysqli->query($query15);
                        while ($row15 = $result15->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row15['id_nc_opcion']; ?>"><?php echo $row15['nombre_nc_opcion']; ?></option>
                        <?php };
                        ?>
                    </select>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info" onclick="modalCloseActualizaContratos(
                        '<?php echo $CampoFrom; ?>',
                        '<?php echo encrypt('nc_contratos-id_opcion_estado_contratos-id_nc_contratos-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

        </div>
    <?php } ?>

    <?php if ('modificar' == $path) { ?>
        <form action="" method="post">
            <div class="row">
                <div style="text-align:center"><b>Nuevo</b></div>
                <input type="hidden" name="id_nc_contrato" value="<?php echo $id; ?>">

                <div class="col-md-4">
                    <label><span style="color:#ff0000;">*</span>Fecha</label>
                    <input type="date" name="fecha_modifica" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label><span style="color:#ff0000;">*</span>Seleccionar</label>
                    <select name="nombre_nc_modifica_contrato" class="form-control" required>
                        <option value=""></option>
                        <option value="Inicial">Inicial</option>
                        <option value="Adicion">Adicion</option>
                        <option value="Prorroga">Prorroga</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Valor</label>
                    <input type="number" name="valor_modifica" class="form-control">
                </div>

                <div class="col-md-12">
                    <label><span style="color:#ff0000;">*</span>Nota</label>
                    <input type="text" name="nota_modifica" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label>Nombre CDP <span style="font-size: 10px;">(campo requerido Minuta)</span></label>
                    <input type="text" class="form-control" name="texto_nc_rubro" value="<?php echo $rowcontra['texto_nc_rubro']; ?>" required>
                </div>

                <div class="col-md-6">
                    <label>Numero CDP <span style="font-size: 10px;">(campo requerido Minuta)</span></label>
                    <input type="number" name="num_cdp" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Fecha CDP <span style="font-size: 10px;">(campo requerido Minuta)</span></label>
                    <input type="date" name="cdp_fecha_expedicion" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Numero CRP</label>
                    <input type="number" name="num_crp" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Fecha CRP</label>
                    <input type="date" name="crp_fecha_expedicion" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarNuevaModificacion" value="guardar" onclick="location.reload()"><span class="glyphicon glyphicon-ok"></span> Guardar </button>
                </div>

            </div>
        </form>

        <div class="row">
            <div style="text-align:center"><b>Listado</b></div>
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>Fecha</th>
                        <th>Modificacion</th>
                        <th>Valor</th>
                        <th>Nota</th>
                        <th>Num cdp</th>
                        <th>Fecha cdp</th>
                        <th>Num crp</th>
                        <th>Fecha crp</th>
                        <th>Accion</th>
                    </tr>
                    <?php
                    $query1 = "SELECT * FROM nc_modifica_contrato WHERE id_nc_contrato=$id AND estado_nc_modifica_contrato = 1";
                    $result1 = $mysqli->query($query1);
                    while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) { ?>
                        <tr>
                            <td><?php echo isset($row1['fecha_modifica']) ? $row1['fecha_modifica'] : ''; ?></td>
                            <td><?php echo isset($row1['nombre_nc_modifica_contrato']) ? $row1['nombre_nc_modifica_contrato'] : ''; ?></td>
                            <td><?php echo isset($row1['valor_modifica']) ? $row1['valor_modifica'] : ''; ?></td>
                            <td><?php echo isset($row1['nota_modifica']) ? $row1['nota_modifica'] : ''; ?></td>
                            <td><?php echo isset($row1['num_cdp']) ? $row1['num_cdp'] : ''; ?></td>
                            <td><?php echo isset($row1['cdp_fecha_expedicion']) ? $row1['cdp_fecha_expedicion'] : ''; ?></td>
                            <td><?php echo isset($row1['num_crp']) ? $row1['num_crp'] : ''; ?></td>
                            <td><?php echo isset($row1['crp_fecha_expedicion']) ? $row1['crp_fecha_expedicion'] : ''; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id_nc_contrato" value="<?php echo $row1['id_nc_contrato']; ?>">
                                    <input type="hidden" name="id_nc_modifica_contrato" value="<?php echo $row1['id_nc_modifica_contrato']; ?>">
                                    <input type="hidden" name="borrarmodificacion" value="borrarmodificacion">
                                    <button class="btn btn-danger btn-xs"><i class="fa fa-fw fa-trash" title="Borrar Modificacion"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    <?php } ?>

    <?php if ('ceder_contrato' == $path) { ?>
        <form action="" method="post" name="formCederContrato">
            <div class="row">
                <div style="text-align:center"><b>Ceder Contrato</b></div>
                <input type="hidden" name="id_nc_contrato" value="<?php echo $id; ?>">

                <div class="col-md-6" style="margin-top: 10px;">
                    <label><span style="color:#ff0000;">*</span>Fecha</label>
                    <input type="date" name="fecha_modifica" class="form-control" required>
                </div>

                <div class="col-md-6" style="margin-top: 10px;">
                    <label>Contratista Actual</label>
                    <input type="hidden" name="id_funcionario" value="<?php echo $rowcontra['id_funcionario']; ?>" required>
                    <span class="form-control" disabled><?php echo quees('funcionario', $rowcontra['id_funcionario']); ?></span>
                </div>

                <div class="col-md-6" style="margin-top: 10px;">
                    <form id="formularioBusqueda">
                        <label>Cédula Contratista Reemplazante:</label>
                        <div class="input-group">
                            <input type="text" id="cedula_funcionario" name="cedula_funcionario" class="form-control" required>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info" onclick="buscarContratista()">Buscar</button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="col-md-6" style="margin-top: 10px;">
                    <label>Nombre Contratista Reemplazante:</label>
                    <div id="resultadoBusqueda" class="form-control" disabled></div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="btnGuardarCederContrato" value="btnGuardarCederContrato" onclick="location.reload()"><span class="glyphicon glyphicon-ok"></span> Guardar </button>
                </div>

            </div>
        </form>

        <div class="row">
            <div style="text-align:center"><b>Listado Modificacion</b></div>
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Contratista Anterior</th>
                        <th>Contratista Actual</th>
                        <th>Fecha</th>
                        <th>Registrado por</th>
                    </tr>
                    <?php
                    $query1 = "SELECT * FROM nc_ceder WHERE fk_nc_contratos=$id AND estado_nc_ceder = 1";
                    $result1 = $mysqli->query($query1);
                    while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) {
                        if ($row1['id_nc_ceder']) { ?>
                            <tr>
                                <td><?php echo isset($row1['id_nc_ceder']) ? $row1['id_nc_ceder'] : ''; ?></td>
                                <td><?php echo isset($row1['id_funcionario']) ? $row1['id_funcionario'] : ''; ?></td>
                                <td><?php echo isset($row1['fk_id_funcionario_sucede']) ? $row1['fk_id_funcionario_sucede'] : ''; ?></td>
                                <td><?php echo isset($row1['fecha_modificacion']) ? $row1['fecha_modificacion'] : ''; ?></td>
                                <td><?php echo isset($row1['fk_id_funcionario_auditoria']) ? $row1['fk_id_funcionario_auditoria'] : ''; ?></td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </div>
        </div>
<?php }

    $resultcontra->free();
    $mysqli->close();
}
?>

<script>
    function modalCloseActualizaContratos(valorCampo, dato) {
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

    function modalCloseActualizaContratosCreator(valorCampo, dato) {
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

    function buscarContratista() {
        var cedulaABuscar = $("#cedula_funcionario").val();
        $.ajax({
            type: "POST",
            url: "pages/contratos_buscador.php",
            data: {
                cedula: cedulaABuscar
            },
            success: function(respuesta) {
                $("#resultadoBusqueda").html(respuesta);
            }
        });
    }
</script>
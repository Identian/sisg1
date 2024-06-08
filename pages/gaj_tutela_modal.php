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
    $nump141 = privilegios(141, $_SESSION['snr']);  // Tutelas Grupo de Administracion Judicial Admin
    $nump142 = privilegios(142, $_SESSION['snr']); // Tutelas Grupo de Administracion Judicial Abogados
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

    <?php if ('accionado' == $path) { ?>
        <div class="titulos"> Nuevo </div>
        <form action="" name="accionadogajtutela" method="POST" id="accionadogajtutela">
            <input type="hidden" name="fk_id_gaj_tutela" value="<?php echo $id; ?>">
            <div class="row">

                <div class="col-md-4">Seleccionar</div>
                <div class="col-md-8">
                    <select class="form-control" id="selectPersonaOLugar" onchange="mostrarple()">
                        <option value="">Seleccionar</option>
                        <option value="Persona">Persona Natural o Jurídica</option>
                        <option value="Lugar">Dependencia / Oficina</option>
                        <option value="Entidad">Entidad</option>
                    </select>
                </div>

                <div id="mostrarPersona" style="display:none">
                    <div class="col-md-4">Nombre y Apellido</div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="persona">
                    </div>
                </div>

                <div id="mostrarEntidad" style="display:none">
                    <div class="col-md-4">Nombre</div>
                    <div class="col-md-8">
                        <select class="form-control" name="entidad">
                            <option value="SUPERINTENDENCIA DE NOTARIADO Y REGISTRO">SUPERINTENDENCIA DE NOTARIADO Y REGISTRO</option>
                        </select>
                    </div>
                </div>

                <div id="mostrarLugar" style="display:none">
                    <div class="col-md-4">Dependencia / Oficina</div>
                    <div class="col-md-8">
                        <select class="form-control" id="primerSelect" onchange="mostrarSegundoSelect()">
                            <option value="">Seleccionar</option>
                            <option value="dependencias">Dependencias</option>
                            <option value="oficinaRegistro">Oficinas de Registro</option>
                            <option value="notarias">Notarias</option>
                            <option value="curadurias">Curadurias</option>
                        </select>

                        <div id="dependenciasSelect" style="display:none">
                            <select style="width: 100%;" class="select_search_accionadogajtutela" name="dependencia">
                                <option value=""></option>
                                <?php listaPorCampo('grupo_area', 'nombre_grupo_area', 'id_area IS NOT NULL AND estado_grupo_area=1 ORDER BY nombre_grupo_area ASC'); ?>
                            </select>
                        </div>

                        <div id="oficinaRegistroSelect" style="display:none">
                            <select style="width: 100%;" class="select_search_accionadogajtutela" name="oficina_registro">
                                <option value=""></option>
                                <?php listaPorCampo('oficina_registro', 'nombre_oficina_registro', 'estado_oficina_registro=1 ORDER BY nombre_oficina_registro ASC'); ?>
                            </select>
                        </div>

                        <div id="notariasSelect" style="display:none">
                            <select style="width: 100%;" class="select_search_accionadogajtutela" name="notaria">
                                <option value=""></option>
                                <?php listaPorCampo('notaria', 'nombre_notaria', 'estado_notaria=1 ORDER BY nombre_notaria ASC'); ?>
                            </select>
                        </div>

                        <div id="curaduriasSelect" style="display:none">
                            <select style="width: 100%;" class="select_search_accionadogajtutela" name="curaduria">
                                <option value=""></option>
                                <?php listaPorCampo('curaduria', 'nombre_curaduria', 'estado_curaduria=1 ORDER BY nombre_curaduria ASC'); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs" name="guardarAccionadogajtutela" value="guardarAccionadogajtutela"> Guardar </button>
                </div>

            </div>
        </form>
    <?php } ?>

    <?php if ('accionante' == $path) { ?>
        <div class="titulos"> Nuevo Accionante </div>
        <form action="" name="accionantegajtutela" method="POST" id="accionantegajtutela">
            <input type="hidden" name="fk_id_gaj_tutela" value="<?php echo $id; ?>">
            <div class="row">

                <div class="col-md-4">Tipo</div>
                <div class="col-md-8">
                    <select class="form-control" name="fk_id_tipo_documento">
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
                    <input class="form-control" type="text" name="nombre_gaj_tutela_incluidos">
                </div>

                <div class="col-md-4">Observación</div>
                <div class="col-md-8">
                    <input class="form-control" type="text" name="observacion_gaj_tutela_incluidos">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs" name="guardarAccionantegajtutela" value="guardarAccionantegajtutela"> Guardar </button>
                </div>

            </div>
        </form>
    <?php } ?>

    <?php if ('asignacion' == $path) { ?>
        <?php $query1 = "SELECT fk_nombre_gaj_tutela_traslado, fk_id_gaj_tutela_traslado FROM gaj_tutela_asignacion WHERE fk_id_gaj_tutela=$id AND estado_gaj_tutela_asignacion=1 AND nombre_gaj_tutela_asignacion='Traslado' ORDER BY fecha DESC LIMIT 1";
        $result1 = $mysqli->query($query1);
        $row1 = $result1->fetch_assoc();
        $nombreGajTraslado = $row1['fk_nombre_gaj_tutela_traslado'];
        $idGajTraslado = $row1['fk_id_gaj_tutela_traslado'];
        ?>

        <div class="titulos"> Asignacion </div>
        <form action="" name="asignaciongajtutela" method="POST">
            <input type="hidden" name="fk_id_gaj_tutela" value="<?php echo $id; ?>">
            <div class="row">








                <div class="col-md-4">Usuario Asignado:</div>
                <div class="col-md-8">
                    <select class="form-control" name="fk_hasta_id_funcionario">
                        <option value=""></option>
                        <?php 
                        if (0 < $nump141 || 0 < $nump142) {
                            $query2 = "SELECT fp.id_funcionario FROM funcionario_perfil AS fp
                            WHERE id_perfil IN (24,141,142)
                            AND fp.estado_funcionario_perfil=1
                            ORDER BY fp.id_funcionario ASC";
                        } elseif (isset($nombreGajTraslado) && 'DEPENDENCIA' == $nombreGajTraslado) {
                            $query2 = "SELECT fp.id_funcionario FROM funcionario_perfil AS fp, funcionario AS f
                            WHERE id_perfil IN (23,24) 
                            AND fp.estado_funcionario_perfil=1
                            AND f.id_funcionario=fp.id_funcionario
                            AND f.id_grupo_area=$idGajTraslado
                            AND f.estado_funcionario=1
                            ORDER BY f.id_funcionario ASC";
                        } elseif (isset($nombreGajTraslado) && 'OFICINA REGISTRO' == $nombreGajTraslado) {
                            $query2 = "SELECT pr.id_funcionario  FROM privilegio_registro AS pr
                            WHERE pr.id_modulo_registro=9 
                            AND pr.id_perfil_registro IN (14,15) 
                            AND pr.id_oficina_registro=$idGajTraslado
                            AND pr.estado_privilegio_registro=1 
                            ORDER BY pr.id_funcionario ASC";
                        } elseif (isset($nombreGajTraslado) && 'NOTARIA' == $nombreGajTraslado) {
                            $query2 = "SELECT pr.id_funcionario  FROM privilegio_notariado AS pr
                            AND pr.id_modulo_notariado IN (14,15) 
                            AND pr.id_notaria=$idGajTraslado
                            AND pr.estado_modulo_notariado=1 
                            ORDER BY pr.id_funcionario ASC";
                        } elseif (isset($nombreGajTraslado) && 'CURADURIA' == $nombreGajTraslado) {
                            $query2 = "SELECT pr.id_funcionario  FROM privilegio_curaduria AS pr
                            AND pr.id_modulo_curaduria IN (14,15) 
                            AND pr.id_curaduria=$idGajTraslado
                            AND pr.estado_modulo_curaduria=1 
                            ORDER BY pr.id_funcionario ASC";
                        }
                        $result2 = $mysqli->query($query2);
                        while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row2['id_funcionario']; ?>"><?php echo quees('funcionario', $row2['id_funcionario']); ?></option>
                        <?php } 
						?>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs" name="guardarAsignaciongajtutela" value="guardarAsignaciongajtutela"> Guardar </button>
                </div>

            </div>
        </form>

        <?php $result2->free_result(); ?>
        <?php $result1->free_result(); ?>
    <?php } ?>

    <?php if ('traslado' == $path) { ?>
        <div class="titulos"> Traslado </div>
        <form action="" name="trasladogajtutela" method="POST" id="trasladogajtutela">
            <input type="hidden" name="fk_id_gaj_tutela" value="<?php echo $id; ?>">
            <div class="row">

                <div class="col-md-4">Seleccionar</div>
                <div class="col-md-8">
                    <?php if (1 == $_SESSION['rol'] || 0 < $nump141 || 0 < $nump142) { ?>
                        <select class="form-control" id="primerSelect" onchange="mostrarSegundoSelect()">
                            <option value=""></option>
                            <option value="dependencias">Dependencias</option>
                            <option value="oficinaRegistro">Oficinas de Registro</option>
                            <option value="notarias">Notarias</option>
                            <option value="curadurias">Curadurias</option>
                        </select>

                        <div id="dependenciasSelect" style="display:none">
                            <select style="width: 100%;" class="select_search_trasladogajtutela" name="dependencia">
                                <option value=""></option>
                                <?php listapordefectocondicion('grupo_area', '', '', 'AND id_area IS NOT NULL'); ?>
                            </select>
                        </div>

                        <div id="oficinaRegistroSelect" style="display:none">
                            <select style="width: 100%;" class="select_search_trasladogajtutela" name="oficina_registro">
                                <option value=""></option>
                                <?php lista('oficina_registro', ''); ?>
                            </select>
                        </div>

                        <div id="notariasSelect" style="display:none">
                            <select style="width: 100%;" class="select_search_trasladogajtutela" name="notaria">
                                <option value=""></option>
                                <?php lista('notaria', ''); ?>
                            </select>
                        </div>

                        <div id="curaduriasSelect" style="display:none">
                            <select style="width: 100%;" class="select_search_trasladogajtutela" name="curaduria">
                                <option value=""></option>
                                <?php lista('curaduria', ''); ?>
                            </select>
                        </div>
                    <?php } else { ?>
                        <select style="width: 100%;" class="select_search_trasladogajtutela" name="dependencia">
                            <option value=""></option>
                            <option value="14">Grupo de Administracion Judicial</option>
                        </select>
                    <?php } ?>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs" name="btnguardarTrasladogajtutela" value="btnguardarTrasladogajtutela"> Guardar </button>
                </div>

            </div>
        </form>
    <?php } ?>

    <?php if ('nuevaactividad' == $path) { ?>
        <div class="titulos"> Nueva Actividad </div>
        <form action="" name="nuevaactividadgajtutela" method="POST">
            <div class="row">

                <?php if (1 == $_SESSION['rol'] || 0 < $nump141 || 0 < $nump142) { ?>
                    <div class="col-md-4">Actividad</div>
                    <div class="col-md-8">
                        <select name="fk_tutela_opcion" class="form-control">
                            <option value=""></option>
                            <?php echo listapordefectocondicion('gaj_tutela_opcion', '', '', '') ?>
                        </select>
                    </div>
                <?php } else { ?>
                    <div class="col-md-4">Actividad</div>
                    <div class="col-md-8">
                        <select name="fk_tutela_opcion" class="form-control">
                            <option value=""></option>
                            <?php echo listapordefectocondicion('gaj_tutela_opcion', '', '', 'AND prefijo_gaj_tutela_opcion="donc"') ?>
                        </select>
                    </div>
                <?php } ?>

                <div class="col-md-4">Fecha Ejecucion</div>
                <div class="col-md-8">
                    <input type="date" class="form-control" name="fecha_ejecucion">
                </div>

                <div class="col-md-4">Observacion</div>
                <div class="col-md-8">
                    <textarea class="form-control" name="observacion_gaj_tutela_detalle"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-xs" name="guardarGajTutelaActividad" value="guardarGajTutelaActividad"> Guardar </button>
                </div>

            </div>
        </form>
    <?php } ?>

    <?php if ('editaractividad' == $path) { ?>
        <?php $query1 = "SELECT * FROM gaj_tutela_detalle WHERE id_gaj_tutela_detalle=$id AND estado_gaj_tutela_detalle=1 LIMIT 1";
        $result1 = $mysqli->query($query1);
        $row1 = $result1->fetch_array(MYSQLI_ASSOC);
        $idTutelaOpcion  = $row1['fk_tutela_opcion'];
        $mostrarPlazoDiasFecha = buscarcampo('gaj_tutela_opcion', 'mostrar_fecha_dias_plazo', "id_gaj_tutela_opcion='$idTutelaOpcion'");
        ?>
        <div class="titulos"> Editar Actividad </div>

        <div class="row">

            <?php if (isset($mostrarPlazoDiasFecha) && 1 == $mostrarPlazoDiasFecha) { ?>

                <div class="col-md-12">
                    <div class="col-md-4"><span style="color:#ff0000;">*</span> Fecha Notificación </div>
                    <div class="input-group col-md-8">
                        <input type="date" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $row1['fecha_plazo']; ?>">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success" onclick="modalCloseGAJTutela(
                                        '<?php echo $CampoFrom; ?>',
                                        '<?php echo encrypt('gaj_tutela_detalle-fecha_plazo-id_gaj_tutela_detalle-' . $id . '', cs()); ?>')">
                                <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                            </button>
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4"><span style="color:#ff0000;">*</span> Plazo Dias </div>
                    <div class="input-group col-md-8">
                        <input type="number" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $row1['dias_plazo']; ?>" min="1">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success" onclick="modalCloseGAJTutela(
                                        '<?php echo $CampoFrom; ?>',
                                        '<?php echo encrypt('gaj_tutela_detalle-dias_plazo-id_gaj_tutela_detalle-' . $id . '', cs()); ?>')">
                                <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                            </button>
                        </span>
                    </div>
                </div>

            <?php } ?>

            <div class="col-md-12">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Fecha Ejecucion </div>
                <div class="input-group col-md-8">
                    <input type="date" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $row1['fecha_ejecucion']; ?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseGAJTutela(
                                        '<?php echo $CampoFrom; ?>',
                                        '<?php echo encrypt('gaj_tutela_detalle-fecha_ejecucion-id_gaj_tutela_detalle-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Observacion </div>
                <div class="input-group col-md-8">
                    <textarea class="form-control" id="<?php echo $CampoFrom = gia(); ?>" required><?php echo $row1['observacion_gaj_tutela_detalle']; ?></textarea>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseGAJTutela(
                                    '<?php echo $CampoFrom; ?>',
                                    '<?php echo encrypt('gaj_tutela_detalle-observacion_gaj_tutela_detalle-id_gaj_tutela_detalle-' . $id . '', cs()); ?>')">
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

            <?php $query1 = "SELECT * FROM gaj_tutela WHERE id_gaj_tutela=$id AND estado_gaj_tutela=1 LIMIT 1";
            $result1 = $mysqli->query($query1);
            $row1 = $result1->fetch_array(MYSQLI_ASSOC); ?>
            <div class="titulos"> Editar Informacion Inicial </div>

            <div class="col-md-12">
                <div class="col-md-4"><span style="color:#ff0000;">*</span> Juzgado </div>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo $row1['juzgado']; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseGAJTutela(
                                '<?php echo $CampoFrom; ?>',
                                '<?php echo encrypt('gaj_tutela-juzgado-id_gaj_tutela-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4"><span style="color:#ff0000;">*</span>Email Juzgado </div>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" id="<?php echo $CampoFrom = gia(); ?>" value="<?php echo isset($row1['email_juzgado']) ? $row1['email_juzgado'] : ''; ?>" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseGAJTutela(
                                '<?php echo $CampoFrom; ?>',
                                '<?php echo encrypt('gaj_tutela-email_juzgado-id_gaj_tutela-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4"> Tema </div>
                <div class="input-group col-md-8">
                   <!-- <input type="text" class="form-control" id="<?php //echo $CampoFrom = gia(); ?>" value="<?php //echo $row1['tema']; ?>" required>-->
                    
				
					
					  
<select  class="form-control" name="tema" >
<option><?php echo quees('gaj_tutela_opcion',$row1['tema']); ?></option>		   
<?php				  
$query9 = sprintf("SELECT * FROM gaj_tutela_opcion where prefijo_gaj_tutela_opcion='tema' order by id_gaj_tutela_opcion");
$select9 = mysql_query($query9, $conexion);
$row9 = mysql_fetch_assoc($select9);
do {
echo '<option value="'.$row9['id_gaj_tutela_opcion'].'">'.$row9['nombre_gaj_tutela_opcion'].'</option>';
} while ($row9 = mysql_fetch_assoc($select9));
mysql_free_result($select9);
?>
</select>				
					
					
					
					<span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseGAJTutela(
                                '<?php echo $CampoFrom; ?>',
                                '<?php echo encrypt('gaj_tutela-tema-id_gaj_tutela-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4"> Derecho Fundamental </div>
                <div class="input-group col-md-8">
                  <!--  <input type="text" class="form-control" id="<?php //echo $CampoFrom = gia(); ?>" value="<?php //echo $row1['derecho_fundamental']; ?>" required>-->
                    
					
					<select  class="form-control" name="derecho_fundamental" >
<option><?php echo quees('gaj_tutela_opcion',$row1['derecho_fundamental']); ?></option>		   
<?php				  
$query9 = sprintf("SELECT * FROM gaj_tutela_opcion where prefijo_gaj_tutela_opcion='derecho_fundamental' order by id_gaj_tutela_opcion");
$select9 = mysql_query($query9, $conexion);
$row9 = mysql_fetch_assoc($select9);
do {
echo '<option value="'.$row9['id_gaj_tutela_opcion'].'">'.$row9['nombre_gaj_tutela_opcion'].'</option>';
} while ($row9 = mysql_fetch_assoc($select9));
mysql_free_result($select9);
?>
</select>	

					
					
					<span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseGAJTutela(
                                '<?php echo $CampoFrom; ?>',
                                '<?php echo encrypt('gaj_tutela-derecho_fundamental-id_gaj_tutela-' . $id . '', cs()); ?>')">
                            <span class="glyphicon glyphicon-refresh" title="Actualizar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-12"><span style="color:#ff0000;">*</span> Descripcion Tutela </div>
                <div class="input-group col-md-12">
                    <textarea class="ckeditor" id="<?php echo $CampoFrom = gia(); ?>"><?php echo $row1['descripcion_tutela']; ?></textarea>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success" onclick="modalCloseGAJTutelaCreator(
                                '<?php echo $CampoFrom; ?>',
                                '<?php echo encrypt('gaj_tutela-descripcion_tutela-id_gaj_tutela-' . $id . '', cs()); ?>')">
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
        <form action="" method="POST" name="guardarDocumentoGajTutela" enctype="multipart/form-data">
            <input type="hidden" name="fk_id_gaj_tutela_detalle" value="<?php echo $id; ?>">
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="tel" name="nombre_gaj_tutela_documento" class="form-control" placeholder="Nombre del Documento" required>
                </div>
                <div class="col-sm-4">
                    <input type="file" name="file_gaj_tutela_documento" required>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarDocumentoGajTutela" value="guardarDocumentoGajTutela"><i class="fa fa-fw fa-plus"></i> Guardar</button>
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
                <?php $query4 = "SELECT * FROM gaj_tutela_documento WHERE fk_id_gaj_tutela_detalle=$id AND estado_gaj_tutela_documento=1 ORDER BY fecha DESC";
                $result4 = $mysqli->query($query4);
                while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) { ?>
                    <tr>
                        <td>
                            <a href="filesnr/gajtutela/<?php echo $row4['ano_gaj_tutela_documento']; ?>/<?php echo $row4['ulr_gaj_tutela_documento']; ?>" target="_blank"><img src="images/pdf.png" alt="" style="width:15px;"><?php echo $row4['nombre_gaj_tutela_documento']; ?></a> <?php echo $row4['fecha']; ?><br>
                        </td>
                        <td>
                            <form action="" method="POST" name="formBorrarDocumentoGajTutela">
                                <input type="hidden" name="id_gaj_tutela_documento" value="<?php echo $row4['id_gaj_tutela_documento']; ?>">
                                <button style="border:none; background:white;" type="submit" name="btnBorrarDocumentoGajTutela" value="btnBorrarDocumentoGajTutela"><i class="fa fa-trash-o"></i></button>
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
    function modalCloseGAJTutela(valorCampo, dato) {
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

    function modalCloseGAJTutelaCreator(valorCampo, dato) {
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

    function mostrarSegundoSelect() {
        let primerSelect = document.getElementById("primerSelect");
        let dependenciasSelect = document.getElementById("dependenciasSelect");
        let oficinaRegistroSelect = document.getElementById("oficinaRegistroSelect");
        let notariasSelect = document.getElementById("notariasSelect");
        let curaduriasSelect = document.getElementById("curaduriasSelect");

        if (primerSelect.value === "dependencias") {
            dependenciasSelect.style.display = "block";
            oficinaRegistroSelect.style.display = "none";
            notariasSelect.style.display = "none";
            curaduriasSelect.style.display = "none";
        } else if (primerSelect.value === "oficinaRegistro") {
            dependenciasSelect.style.display = "none";
            oficinaRegistroSelect.style.display = "block";
            notariasSelect.style.display = "none";
            curaduriasSelect.style.display = "none";
        } else if (primerSelect.value === "notarias") {
            dependenciasSelect.style.display = "none";
            oficinaRegistroSelect.style.display = "none";
            notariasSelect.style.display = "block";
            curaduriasSelect.style.display = "none";
        } else if (primerSelect.value === "curadurias") {
            dependenciasSelect.style.display = "none";
            oficinaRegistroSelect.style.display = "none";
            notariasSelect.style.display = "none";
            curaduriasSelect.style.display = "block";
        }
    }

    function mostrarple() {
        let selectPersonaOLugar = document.getElementById("selectPersonaOLugar");
        let mostrarPersona = document.getElementById("mostrarPersona");
        let mostrarLugar = document.getElementById("mostrarLugar");
        let mostrarEntidad = document.getElementById("mostrarEntidad");

        if (selectPersonaOLugar.value === "Persona") {
            mostrarPersona.style.display = "block";
            mostrarLugar.style.display = "none";
            mostrarEntidad.style.display = "none";
        } else if (selectPersonaOLugar.value === "Lugar") {
            mostrarPersona.style.display = "none";
            mostrarLugar.style.display = "block";
            mostrarEntidad.style.display = "none";
        } else if (selectPersonaOLugar.value === "Entidad") {
            mostrarPersona.style.display = "none";
            mostrarLugar.style.display = "none";
            mostrarEntidad.style.display = "block";
        }
    }

    $(document).ready(function() {
        $(".select_search_trasladogajtutela").select2({
            dropdownParent: $('#trasladogajtutela')
        });
    });

    $(document).ready(function() {
        $(".select_search_accionadogajtutela").select2({
            dropdownParent: $('#accionadogajtutela')
        });
    });
</script>
<?php
// PRIVILEGIOS
$nump100 = privilegios(100, $_SESSION['snr']); // Comision Admin
$nump101 = privilegios(101, $_SESSION['snr']); // Comision Revisor 
$nump166 = privilegios(166, $_SESSION['snr']); // Comision Aprobo
$nump120 = privilegios(120, $_SESSION['snr']); // Comision Usuario Tiquetes

$nump173 = privilegios(173, $_SESSION['snr']); // Comision Admin Presupuesto
$nump162 = privilegios(162, $_SESSION['snr']); // Comision Usuario Presupuesto

$nump174 = privilegios(174, $_SESSION['snr']); // Comision Admin Contabilidad
$nump163 = privilegios(163, $_SESSION['snr']); // Comision Usuario Contabilidad

$nump175 = privilegios(175, $_SESSION['snr']); // Comision Admin Tesoreria
$nump164 = privilegios(164, $_SESSION['snr']); // Comision Usuario Tesoreria


if (isset($_GET['i']) && '' != $_GET['i']) {
    $id = $_GET['i'];
} else {
    $id = $_SESSION['snr'];
}

1 == $_SESSION['rol'] || 1 == $_SESSION['snr_grupo_cargo'] || 2 == $_SESSION['snr_grupo_cargo'] || 0 < $nump100 || 0 < $nump101 || 0 < $nump166 || 0 < $nump120 || 0 < $nump162 || 0 < $nump163 || 0 < $nump164 || 0 < $nump173 || 0 < $nump174 || 0 < $nump175 ?: exit;

// FECHA ACTUAL
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$anoActual = date("Y");
$idFuncionario = $_SESSION['snr'];
if (1 == $_SESSION['snr_grupo_cargo']) {
    $autorizaJefe = 1;
    $idGrupoArea = $_SESSION['snr_grupo_area'];
    $buscarIdArea = buscarcampo('grupo_area', 'id_area', 'id_grupo_area=' . $idGrupoArea);
} else {
    $autorizaJefe = 0;
    $idGrupoArea = 0;
    $buscarIdArea = 0;
}

// GUARDAR NUEVA COMISION
if (isset($_POST["guardarNuevaComision"]) && '' != $_POST["guardarNuevaComision"]) {
    $datos = array(
        "fk_id_funcionario_crea" => $idFuncionario,
        "fk_id_area_crea" => $buscarIdArea,
        "fecha_solicitud_comision" => $fechaActual,
        "estado" => 'Creado',
        // "radicado_iris" => crearNuevoIris($_SESSION['username_iris'], '315', '1863', 'TRAMITES PARA COMISIONES DE SERVICIO SNR', 'IE', 'COMISION ', 'COMISION', $conexionpostgres),
        "radicado_iris" => 'SNR2023IE013831',
        "legalizacion" => 'NO'
    );
    if (insertarDatos($mysqli, "comision", $datos)) {
        echo $insertado;
    } else {
        echo "Error en la inserción";
    }
}

// GUARDAR MASIVO
// PRESUPUESTO
if (isset($_POST["btnGuardarMasivoPresupuesto"]) && '' != $_POST["btnGuardarMasivoPresupuesto"]) {
    echo $_POST["id_funcionario"];
    $listaIdcomision = $_POST["masivosidcomision"];
    $idFuncionario = $_POST["id_funcionario"];
    foreach ($listaIdcomision as $idComision) {
        $datos = array(
            "pago_presupuesto" => $idFuncionario
        );
        actualizarDatos($mysqli, "comision", $datos, "id_comision=$idComision LIMIT 1");
    }
}
// CONTABILIDAD
if (isset($_POST["btnGuardarMasivoContabilidad"]) && '' != $_POST["btnGuardarMasivoContabilidad"]) {
    echo $_POST["id_funcionario"];
    $listaIdcomision = $_POST["masivosidcomision"];
    $idFuncionario = $_POST["id_funcionario"];
    foreach ($listaIdcomision as $idComision) {
        $datos = array(
            "pago_contabilidad" => $idFuncionario
        );
        actualizarDatos($mysqli, "comision", $datos, "id_comision=$idComision LIMIT 1");
    }
}
// TESORERIA
if (isset($_POST["btnGuardarMasivoTesoreria"]) && '' != $_POST["btnGuardarMasivoTesoreria"]) {
    echo $_POST["id_funcionario"];
    $listaIdcomision = $_POST["masivosidcomision"];
    $idFuncionario = $_POST["id_funcionario"];
    foreach ($listaIdcomision as $idComision) {
        $datos = array(
            "pago_contabilidad" => $idFuncionario
        );
        actualizarDatos($mysqli, "comision", $datos, "id_comision=$idComision LIMIT 1");
    }
}


?>
<style>
    .table>thead>tr>th {
        padding: 5px;
        line-height: 2;
    }

    .withModal {
        width: 70%;
    }
</style>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo existencia('comision'); ?></h3>
                <p>Comisiones</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo 0; ?></h3>
                <p>Rechazos</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo existencia('comision_documento'); ?></h3>
                <p>Documentos</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?php echo existencia('grupo_area'); ?></h3>
                <p>Grupos Nivel central</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <span style="margin-right:20px; font-weight:bold;">Comisiones</span>
                <?php if (1 == $_SESSION['rol'] || 0 < $autorizaJefe || 2 == $_SESSION['snr_grupo_cargo'] || 0 < $nump100) { ?>
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createNuevaComision"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo </button>
                <?php } ?>
                <div class="box-tools pull-right">
                    <?php if (1 == $_SESSION['rol'] || 0 < $nump173 || 0 < $nump174 || 0 < $nump175) { ?>
                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#asignacionMasiva"> Masivos </button>
                    <?php } ?>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>

            <div class="box-body">

                <div class="table-responsive" style="font-size: 90%">
                    <table class="table table-bordered" id="tablacomision">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Radicado Iris</th>
                                <th style="width: 400px !important;">Comisionados</th>
                                <?php if (1 == $_SESSION['rol'] || 0 < $nump100) { ?>
                                    <th>Solicitud</th>
                                    <th>Justificacion</th>
                                    <th>Siif</th>
                                    <th>Tiquetes</th>
                                <?php } ?>
                                <?php if (1 == $_SESSION['rol'] || 0 < $nump162 || 0 < $nump163 || 0 < $nump164 || 0 < $nump173 || 0 < $nump174 || 0 < $nump175) { ?>
                                    <th>Presupuesto</th>
                                    <th>Contabilidad</th>
                                    <th>Tesoreria</th>
                                <?php } ?>
                                <th>Estado</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (1 == $_SESSION['rol'] || 0 < $nump100) {
                                $query4 = "SELECT * FROM comision WHERE estado_comision=1";
                            } elseif (0 < $nump101) {
                                $query4 = "SELECT * FROM comision WHERE estado_comision=1 AND estado='Reviso'";
                            } elseif (0 < $nump166) {
                                $query4 = "SELECT * FROM comision WHERE estado_comision=1 AND estado='Reviso Financiera'";
                            } elseif (0 < $autorizaJefe || 2 == $_SESSION['snr_grupo_cargo']) {
                                echo $query4 = "SELECT * FROM comision WHERE fk_id_area_crea=$buscarIdArea AND estado_comision=1";
                            } elseif (0 < $nump162 || 0 < $nump173) {
                                $query4 = "SELECT * FROM comision WHERE estado_comision=1 AND estado='Envio Pago'";
                            } elseif (0 < $nump163 || 0 < $nump174) {
                                $query4 = "SELECT * FROM comision WHERE estado_comision=1 AND estado='Presupuesto'";
                            } elseif (0 < $nump164 || 0 < $nump175) {
                                $query4 = "SELECT * FROM comision WHERE estado_comision=1 AND estado='Contabilidad'";
                            } else {
                                $query4 = "SELECT * FROM comision WHERE fk_id_funcionario_crea=$idFuncionario AND comision.estado_comision=1";
                            }
                            $result4 = $mysqli->query($query4);
                            while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) { ?>
                                <tr>
                                    <?php
                                    $idComision = $row4['id_comision'];
                                    echo '<td>' . $row4['id_comision']  . '</td>';
                                    echo '<td>' . $row4['fecha_solicitud_comision'] . '</td>';
                                    echo '<td>' . $row4['radicado_iris'] . '</td>';
                                    echo '<td>';
                                    $query8 = "SELECT * FROM comision_detalle WHERE id_comision=$idComision AND estado_comision_detalle=1";
                                    $result8 = $mysqli->query($query8);
                                    while ($row8 = $result8->fetch_array(MYSQLI_ASSOC)) { ?>
                                        <?php $totalComision = 0; ?>
                                        <?php echo isset($row8['nombre_comision_detalle']) ? $row8['nombre_comision_detalle'] : ''; ?>
                                        <?php echo isset($row8['cedula']) ? $row8['cedula'] : ''; ?>
                                        <?php echo isset($row8['fecha_ida']) ? $row8['fecha_ida'] . ' / ' : ''; ?>
                                        <?php echo isset($row8['fecha_regreso']) ? $row8['fecha_regreso'] : ''; ?>
                                        <?php echo isset($row8['fecha_ida']) && isset($row8['fecha_regreso']) ? datecomision($row8['fecha_ida'], $row8['fecha_regreso']) : 0; ?><br>
                                        <?php $totalComision = +datecomision($row8['fecha_ida'], $row8['fecha_regreso']) * $row8['dia_comision']; ?>
                                        <?php
                                        $idComisionDetalle = $row8['id_comision_detalle'];
                                        $query9 = "SELECT * FROM comision_detalle_tramo WHERE fk_id_comision_detalle=$idComisionDetalle AND estado_comision_detalle_tramo=1";
                                        $result9 = $mysqli->query($query9);
                                        $totalTrans = 0;
                                        while ($row9 = $result9->fetch_array(MYSQLI_ASSOC)) { ?>
                                            <?php echo isset($row9['medio_transporte']) ? $row9['medio_transporte'] : ''; ?>
                                            <?php echo isset($row9['medio_transporte']) ? quees('municipio', $row9['desde_id_municipio']) : ''; ?>
                                            <?php echo isset($row9['medio_transporte']) ? quees('municipio', $row9['hasta_id_municipio']) : ''; ?><br>
                                            <?php $totalTrans += $row9['valor_trasporte']; ?>
                                    <?php }
                                        echo '$ ' . number_format((float) $totalComision +  $totalTrans, 0, ",", ".")  . '<br>';
                                    }
                                    echo '</td>';

                                    if (1 == $_SESSION['rol'] || 0 < $nump100) {
                                        echo '<td>';
                                        $solicitud = buscarcampo('comision_documento', 'nombre_comision_documento', 'id_comision=' . $idComision . ' AND nombre_comision_documento="Solicitud Comision" AND estado_comision_documento=1');
                                        if ($solicitud == 'Solicitud Comision') {
                                            echo '<i class="fa fa-fw fa-check" style="color: green;"></i> Si';
                                        } else {
                                            echo '<i class="fa fa-fw fa-close" style="color: red;"></i> No';
                                        }
                                        echo '</td>';

                                        echo '<td>';
                                        $justificacion = buscarcampo('comision_documento', 'nombre_comision_documento', 'id_comision=' . $idComision . ' AND nombre_comision_documento="Justificacion Comision" AND estado_comision_documento=1');
                                        if ($justificacion == 'Justificacion Comision') {
                                            echo '<i class="fa fa-fw fa-check" style="color: green;"></i> Si';
                                        } else {
                                            echo '<i class="fa fa-fw fa-close" style="color: red;"></i> No';
                                        }
                                        echo '</td>';

                                        echo '<td>';
                                        $siif = buscarcampo('comision_documento', 'nombre_comision_documento', 'id_comision=' . $idComision . ' AND nombre_comision_documento="Soporte SIIF" AND estado_comision_documento=1');
                                        if ($siif == 'Soporte SIIF') {
                                            echo '<i class="fa fa-fw fa-check" style="color: green;"></i> Si';
                                        } else {
                                            echo '<i class="fa fa-fw fa-close" style="color: red;"></i> No';
                                        }
                                        echo '</td>';

                                        echo '<td>';
                                        $tiquetes = buscarcampo('comision_documento', 'nombre_comision_documento', 'id_comision=' . $idComision . ' AND nombre_comision_documento="Tiquetes" AND estado_comision_documento=1');
                                        if ($tiquetes == 'Tiquetes') {
                                            echo '<i class="fa fa-fw fa-check" style="color: green;"></i> Si';
                                        } else {
                                            echo '<i class="fa fa-fw fa-close" style="color: red;"></i> No';
                                        }
                                        echo '</td>';
                                    }

                                    if (1 == $_SESSION['rol'] || 0 < $nump162 || 0 < $nump163 || 0 < $nump164 || 0 < $nump173 || 0 < $nump174 || 0 < $nump175) {
                                        echo '<td>';
                                        echo 0 == $row4['pago_presupuesto'] ? '<i class="fa fa-fw fa-close" style="color: red;"></i> No' : '<i class="fa fa-fw fa-check" style="color: green;"></i> Si';
                                        echo '</td>';


                                        echo '<td>';
                                        echo 0 == $row4['pago_contabilidad'] ? '<i class="fa fa-fw fa-close" style="color: red;"></i> No' : '<i class="fa fa-fw fa-check" style="color: green;"></i> Si';
                                        echo '</td>';



                                        echo '<td>';
                                        echo 0 == $row4['pago_tesoreria'] ? '<i class="fa fa-fw fa-close" style="color: red;"></i> No' : '<i class="fa fa-fw fa-check" style="color: green;"></i> Si';
                                        echo '</td>';
                                    }

                                    echo '<td>' . $row4['estado'] . '</td>';

                                    echo '<td style="width: 89px;">'; ?>
                                    <a class="btn btn-primary btn-xs" href="comision_detalle&<?php echo $row4['id_comision']; ?>.jsp"><i class="fa fa-fw fa-search" title="Ver Comision"></i></a>
                                    <?php echo '</td>';
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function() {
                            $('#tablacomision').DataTable({
                                "order": [
                                    [0, 'asc']
                                ],
                                "lengthMenu": [
                                    [25, 50, 100, 250, 500],
                                    [25, 50, 100, 250, 500]
                                ],
                                "language": {
                                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                                }
                            });
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- MODAL NUEVA COMISION -->
<div class="modal fade" id="createNuevaComision" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">Nuevo</h5>
            </div>
            <div class="modal-body">

                <form action="" method="POST" name="nuevacomisionradicado">
                    <label> Cuando haga clic en 'Guardar', se generará automáticamente un número de radicado para iniciar el proceso de comisión. Por favor, asegúrese de estar seguro antes de proceder. </label>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarNuevaComision" value="guardar"> Guardar </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<!-- MODAL ACTUALIZAR -->
<div class="modal fade" tabindex="-1" role="dialog" id="com" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog withModal" style="min-height: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <b>Comision</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="divcomision"></div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL MASIVO -->
<div class="modal fade" tabindex="-1" role="dialog" id="asignacionMasiva" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <b>Asignacion Masivos</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php
                if (0 < $nump173) {
                    $query5 = "SELECT * FROM comision WHERE estado_comision=1 AND pago_presupuesto = 0";
                } elseif (0 < $nump174) {
                    $query5 = "SELECT * FROM comision WHERE estado_comision=1 AND pago_presupuesto IS NOT NULL AND pago_contabilidad = 0 ";
                } elseif (0 < $nump175) {
                    $query5 = "SELECT * FROM comision WHERE estado_comision=1 AND pago_presupuesto IS NOT NULL AND pago_contabilidad IS NOT NULL AND pago_tesoreria = 0 ";
                } elseif (1 == $_SESSION['rol']) {
                    $query5 = "SELECT * FROM comision WHERE estado_comision=1";
                }
                ?>


                <form action="" method="POST" name="formAsignarMasivo">
                    <select class="form-control" name="masivosidcomision[]" multiple style="height:250px;">
                        <?php
                        $result5 = $mysqli->query($query5);
                        while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row5['id_comision']; ?>">
                                <?php
                                echo $row5['radicado_iris'] . ' | Comision | ';
                                echo (0 != $row5['pago_presupuesto']) ? ' OK Presupuesto | ' : ' NO Presupuesto | ';
                                echo (0 != $row5['pago_contabilidad']) ? ' OK Contabilidad | ' : ' NO Contabilidad | ';
                                echo (0 != $row5['pago_tesoreria']) ? ' OK Tesoreria | ' : ' NO Tesoreria | ';
                                ?>
                            </option>
                        <?php }
                        $result5->free(); ?>
                    </select>

                    <?php if (1 == $_SESSION['rol'] || 0 < $nump173) { ?>
                        <br><b>Presupuesto masivo a:</b>
                        <select name="id_funcionario">
                            <?php $query6 = "SELECT id_funcionario FROM funcionario_perfil WHERE estado_funcionario_perfil=1 AND (id_perfil = 173 OR id_perfil = 162)";
                            $result6 = $mysqli->query($query6);
                            while ($row6 = $result6->fetch_array(MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $row6['id_funcionario']; ?>"><?php echo quees('funcionario', $row6['id_funcionario']); ?></option>
                            <?php }
                            $result6->free(); ?>
                        </select>
                        <button type="submit" class="btn btn-warning btn-xs" name="btnGuardarMasivoPresupuesto" value="btnGuardarMasivoPresupuesto">Asignar masivamente</button>
                    <?php } ?>

                    <?php if (1 == $_SESSION['rol'] || 0 < $nump174) { ?>
                        <br><b>Contabilidad masivo a:</b>
                        <select name="id_funcionario">
                            <?php $query7 = "SELECT id_funcionario FROM funcionario_perfil WHERE estado_funcionario_perfil=1 AND (id_perfil = 174 OR id_perfil = 163)";
                            $result7 = $mysqli->query($query7);
                            while ($row7 = $result7->fetch_array(MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $row7['id_funcionario']; ?>"><?php echo quees('funcionario', $row7['id_funcionario']); ?></option>
                            <?php }
                            $result7->free(); ?>
                        </select>
                        <button type="submit" class="btn btn-warning btn-xs" name="btnGuardarMasivoContabilidad" value="btnGuardarMasivoContabilidad">Asignar masivamente</button>
                    <?php } ?>

                    <?php if (1 == $_SESSION['rol'] || 0 < $nump175) { ?>
                        <br><b>Tesoreria masivo a:</b>
                        <select name="id_funcionario">
                            <?php $query7 = "SELECT id_funcionario FROM funcionario_perfil WHERE estado_funcionario_perfil=1 AND (id_perfil = 175 OR id_perfil = 164)";
                            $result7 = $mysqli->query($query7);
                            while ($row7 = $result7->fetch_array(MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $row7['id_funcionario']; ?>"><?php echo quees('funcionario', $row7['id_funcionario']); ?></option>
                            <?php }
                            $result7->free(); ?>
                        </select>
                        <button type="submit" class="btn btn-warning btn-xs" name="btnGuardarMasivoTesoreria" value="btnGuardarMasivoTesoreria">Asignar masivamente</button>
                    <?php } ?>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
    // Funcion para no duplicar envios de formularios
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $('.actualizarcomision').click(function() {
        var ma = this.id;
        jQuery.ajax({
            type: "POST",
            url: "pages/comision_detalle.php",
            data: 'option=' + ma,
            async: true,
            success: function(b) {
                jQuery('#divcomision').html(b);
            }
        })
    });
</script>
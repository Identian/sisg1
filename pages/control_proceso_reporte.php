<?php
require_once('listas.php');

$nump125 = privilegios(125, $_SESSION['snr']); // SID Auxiliar
$nump126 = privilegios(126, $_SESSION['snr']); // SID Profesional
$nump127 = privilegios(127, $_SESSION['snr']); // SID Coordinador
$nump128 = privilegios(128, $_SESSION['snr']); // SID Jefe
$nump129 = privilegios(129, $_SESSION['snr']); // SID ADMIN Noficador encargado de crear plantillas de notificacion
$nump130 = privilegios(130, $_SESSION['snr']); // SID Noficador recibe una notificacion 
$nump143 = privilegios(143, $_SESSION['snr']); // Usuario usado por sebastian

// VARIABLES GLOBALES
$GlobalGrupoArea = $_SESSION['snr_grupo_area'];

// Oficina de Control Disciplinario Interno = 23
if ($GlobalGrupoArea == 23) {
    $nomenclatura = 'AND consecutivo_nomenclatura_cd=OCDI';
    $GlobalTipoDeOficina = 1;
}

// Superintendencia Delegada Para El Registro = 41
// Grupo de Inspeccion Vigilancia y Control Registral = 42
// Grupo de Gestion Disciplinaria Registral = 313
if ($GlobalGrupoArea == 41 or $GlobalGrupoArea == 42 or $GlobalGrupoArea == 313) {
    $nomenclatura = 'AND consecutivo_nomenclatura_cd=SDR';
    $GlobalTipoDeOficina = 2;
}

// Superintendencia Delegada Para El Notariado = 44
// Direccion de Vigilancia y Control Notarial = 45 
if ($GlobalGrupoArea == 44 or $GlobalGrupoArea == 45) {
    $nomenclatura = 'AND consecutivo_nomenclatura_cd=SDN';
    $GlobalTipoDeOficina = 3;
}

// Superintendencia Delegada para la Proteccion Restitucion y Formalizacion de Tierras = 297
// Grupo para el control y vigilancia de Curadores Urbanos = 305
if ($GlobalGrupoArea == 297 or $GlobalGrupoArea == 305) {
    $nomenclatura = 'AND consecutivo_nomenclatura_cd=SDC';
    $GlobalTipoDeOficina = 4;
}

// Oficina Asesora Juridica = 12
if ($GlobalGrupoArea == 12) {
    $nomenclatura = 'AND consecutivo_nomenclatura_cd=OAJ';
    $GlobalTipoDeOficina = 5;
}

// Despacho Del Superintendente = 1 | Oficina Asesora Juridica = 12 para asignar a luisa
if ($GlobalGrupoArea == 1) {
    $querydependencias = 'AND consecutivo_nomenclatura_cd=DDS';
    $GlobalTipoDeOficina = 6;
}


if (1 == $_SESSION['rol'] or 0 < $nump143) {
    $querydependencias = '';
}


if (1 == $_SESSION['rol'] or 0 < $nump125 or 0 < $nump127 or 0 < $nump128) {
?>

    <style>
        .divscroll200 {
            overflow-y: hidden;
            overflow-x: scroll;
        }
    </style>

    <div class="row">
        <div class="col-md-12" style="font-size:100%">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title"><b>Historico Expedientes SID</b></h4>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div> <!-- BOX HEADER -->
                <div class="box-body">

                    <div>
                        <form action="" method="POST" name="controlprocesoreporte4234">
                            <span style=" float: left;">&nbsp;&nbsp;Desde&nbsp;&nbsp;</span>
                            <input style="width:120px; float: left;" type="date" name="fecha_ini" class="form-control" required>
                            <span style=" float: left;">&nbsp;&nbsp;Hasta&nbsp;&nbsp;</span>
                            <input style="width:120px; float: left;" type="date" name="fecha_fin" class="form-control" required>
                            <span style=" float: left;">&nbsp;&nbsp;Dependencia&nbsp;&nbsp;</span>
                            <select class="form-control" name="id_dependencia" style="width:300px; float: left;">
                                <option value="">--Seleccionar--</option>
                                <?php if ($GlobalTipoDeOficina == 1) { ?>
                                    <option value="OCDI">OCDI - Oficina de Control Disciplinario Interno</option>
                                <?php } ?>
                                <?php if ($GlobalTipoDeOficina == 2) { ?>
                                    <option value="SDR">SDR - Superintendencia Delegada Para El Registro</option>
                                <?php } ?>
                                <?php if ($GlobalTipoDeOficina == 3) { ?>
                                    <option value="SDN">SDN - Superintendencia Delegada Para El Notariado</option>
                                <?php } ?>
                                <?php if ($GlobalTipoDeOficina == 4) { ?>
                                    <option value="SDC">SDC - Grupo para el control y vigilancia de Curadores Urbanos</option>
                                <?php } ?>
                                <?php if ($GlobalTipoDeOficina == 5) { ?>
                                    <option value="OAJ">OAJ - Oficina Asesora Juridica</option>
                                <?php } ?>
                                <?php if ($GlobalTipoDeOficina == 6) { ?>
                                    <option value="DDS">DDS - Despacho Del Superintendente</option>
                                <?php } ?>
                                <?php if (1 == $_SESSION['rol'] or 0 < $nump143) { ?>
                                    <option value="OCDI">OCDI - Oficina de Control Disciplinario Interno</option>
                                    <option value="SDR">SDR - Superintendencia Delegada Para El Registro</option>
                                    <option value="SDN">SDN - Superintendencia Delegada Para El Notariado</option>
                                    <option value="SDC">SDC - Grupo para el control y vigilancia de Curadores Urbanos</option>
                                    <option value="OAJ">OAJ - Oficina Asesora Juridica</option>
                                    <option value="DDS">DDS - Despacho Del Superintendente</option>
                                <?php } ?>
                            </select>
                            <input class="btn btn-primary" type="submit" name="control_proceso_reporte" value="Buscar" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="./control_proceso_reporte.jsp" class="btn btn-default">Restaurar</a>
                        </form>
                    </div><br><br>
                    <div class="box-body divscroll200">
                        <table class="table display nowrap" id="controlprocesoreporte">
                            <thead>
                                <tr>
                                    <th>N° Expediente</th>
                                    <th>Fecha Creacion</th>
                                    <th>Entrada</th>
                                    <th>Nombre del Implicado / Entidad</th>
                                    <th>Radicacion Iris</th>
                                    <th>Fecha Queja</th>

                                    <th>Iris Traslado</th>
                                    <th>Fecha Traslado</th>
                                    <th>Fecha Hechos</th>
                                    <!-- <th>Asunto</th> -->
                                    <th>Fecha Prescripción</th>

                                    <th>Area</th>
                                    <th>Fase | Etapa | Accion</th>
                                    <!-- <th>Creado desde</th> -->
                                    <th>Asignado</th>
                                    <th>Tipología</th>
                                    <th>Prioritarios</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['control_proceso_reporte'])) {
                                    $idDependencia = $_POST['id_dependencia'];
                                    if (isset($idDependencia)) {
                                        $fecha_ini = $_POST['fecha_ini'];
                                        $fecha_fin = $_POST['fecha_fin'];
                                        $query1 = sprintf("SELECT * FROM cd 
                                        WHERE consecutivo_nomenclatura_cd='$idDependencia'
                                        AND fecha_creado_cd BETWEEN '$fecha_ini' AND '$fecha_fin'
                                        AND estado_cd=1");
                                    } else {
                                        $ped_ini = $_POST['ped_ini'];
                                        $ped_fin = $_POST['ped_fin'];
                                        $idDependencia = $_POST['id_dependencia'];
                                        $query1 = sprintf("SELECT * FROM cd 
                                        WHERE consecutivo_nomenclatura_cd='$idDependencia'
                                        AND estado_cd=1");
                                    }
                                } else {
                                    $query1 = sprintf("SELECT * FROM cd WHERE id_cd=7 LIMIT 1");
                                }
                                $select1 = mysql_query($query1, $conexion) or die(mysql_error());
                                while ($row = mysql_fetch_assoc($select1)) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if (7 == $row['id_cd']) {
                                                echo '<span style="color:red">EXP PRUEBA ' . $row['nomenclatura_juzgamiento_cd'] . $row['consecutivo_nomenclatura_cd'] . '-' . $row['consecutivo_numero_cd'] . '-' . $row['consecutivo_ano_cd'] . '</span>';
                                            } else {
                                                echo
                                                '<a href="control_proceso_detalle&' . $row['id_cd'] . '.jsp">' .
                                                    $row['nomenclatura_juzgamiento_cd'] . $row['consecutivo_nomenclatura_cd'] . '-' . $row['consecutivo_numero_cd'] . '-' . $row['consecutivo_ano_cd'] .
                                                    '</a>';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $row['fecha_creado_cd']; ?></td>
                                        <td><?php echo $row['canal_entrada_cd']; ?></td>

                                        <td><?php
                                            $id = $row['id_cd'];
                                            $querye = "SELECT * FROM cd_entidad
                                        LEFT JOIN cd_implicado
                                        ON cd_entidad.id_cd_entidad=cd_implicado.id_cd_entidad_fk_cd_implicado
                                        WHERE cd_entidad.id_cd_fk_cd_entidad = $id AND 
                                        cd_entidad.estado_cd_entidad=1 AND 
                                        cd_implicado.estado_cd_implicado=1";
                                            $selecte  = mysql_query($querye, $conexion) or die(mysql_error());
                                            while ($rowe = mysql_fetch_assoc($selecte)) {

                                                echo $rowe['nombre_cd_implicado'] . ' / ';

                                                if ($rowe['nombre_cd_entidad'] == 1) { ?>
                                                    <?php echo quees('grupo_area', $rowe['grupo_cd_entidad']) ?>
                                                <?php } elseif ($rowe['nombre_cd_entidad'] == 2) { ?>
                                                    <?php echo quees('oficina_registro', $rowe['grupo_cd_entidad']) ?>
                                                <?php } elseif ($rowe['nombre_cd_entidad'] == 3) { ?>
                                                    <?php echo quees('notaria', $rowe['grupo_cd_entidad']) ?>
                                                <?php } elseif ($rowe['nombre_cd_entidad'] == 4) { ?>
                                                    <?php echo quees('curaduria', $rowe['grupo_cd_entidad']) ?>
                                            <?php }
                                                echo '<br>';
                                            }
                                            ?></td>


                                        <td><?php echo $row['radicacion_iris_cd']; ?></td>
                                        <td><?php echo $row['fecha_queja_cd']; ?></td>


                                        <td><?php echo $row['iris_traslado_cd']; ?></td>
                                        <td><?php echo $row['fecha_traslado_cd']; ?></td>
                                        <td><?php echo $row['fecha_hechos_cd']; ?></td>
                                        <!-- <td><php echo $row['asunto_cd']; ?></td> -->


                                        <td><?php echo $row['fecha_prescripcion_cd']; ?></td>
                                        <td>
                                            <?php
                                            $tipoOficina = $row['id_tipo_oficina_fk_tipo_oficina'];
                                            if ($tipoOficina == 1) {
                                                echo 'Oficina de Control Disciplinario Interno';
                                            } elseif ($tipoOficina == 2) {
                                                echo 'Grupo de Gestion Disciplinaria Registral';
                                            } elseif ($tipoOficina == 3) {
                                                echo 'Direccion de Vigilancia y Control Notarial';
                                            } elseif ($tipoOficina == 4) {
                                                echo 'Grupo para el control y vigilancia de Curadores Urbanos';
                                            } elseif ($tipoOficina == 5) {
                                                echo 'Oficina Asesora Juridica';
                                            } elseif ($tipoOficina == 6) {
                                                echo 'Despacho Del Superintendente';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $idCdUnionCdDetalle = $row['id_cd'];
                                            $query20 = "SELECT * FROM cd_detalle_accion WHERE id_cd_fk_cd_detalle_accion=$idCdUnionCdDetalle AND estado_cd_detalle_accion=1 ORDER BY fecha_creado_cd_detalle_accion DESC";
                                            $result20 = $mysqli->query($query20);
                                            $row20 = $result20->fetch_array(MYSQLI_ASSOC);
                                            if (isset($row20['id_cd_etapa_fk_cd_detalle_accion'])) {
                                                if ($row20['id_cd_etapa_fk_cd_detalle_accion']) {
                                                    $idEtapa = $row20['id_cd_etapa_fk_cd_detalle_accion'];
                                                    $query21 = "SELECT * FROM cd_etapa WHERE id_cd_etapa=$idEtapa AND estado_cd_etapa=1";
                                                    $result21 = $mysqli->query($query21);
                                                    $row21 = $result21->fetch_array(MYSQLI_ASSOC);
                                                    echo 'Fase: ';
                                                    echo quees('cd_fase', $row21['id_cd_fase_fk_cd_etapa']);
                                                }
                                                echo '<br>';
                                                echo 'Etapa: ';
                                                echo quees('cd_etapa', $row20['id_cd_etapa_fk_cd_detalle_accion']);
                                                echo '<br>';
                                                echo 'Accion: ';
                                                echo quees('cd_accion', $row20['id_cd_accion_fk_cd_detalle_accion']);

                                                $idAccion = $row20['id_cd_detalle_accion'];
                                                $query21 = "SELECT * FROM cd_anexos WHERE id_cd_fk_cd_anexos=$idCdUnionCdDetalle 
                                              AND id_cd_accion_fk_cd_anexos=$idAccion
                                              AND estado_cd_anexos=1 
                                              ORDER BY fecha_creado_cd_anexos DESC";
                                                $result21 = $mysqli->query($query21);
                                                $row21 = $result21->fetch_array(MYSQLI_ASSOC);
                                                echo '<br>';
                                                echo 'Detalle: ';
                                                if (isset($row21['id_cd_accion_fk_cd_anexos']) && $idAccion == $row21['id_cd_accion_fk_cd_anexos']) {
                                                    echo $row21['pra_cd_anexos'];
                                                } else {
                                                    echo 'Sin Adjuntos';
                                                }
                                            }
                                            ?>
                                        </td>
                                        <!-- <td><php echo $row['creado_desde_cd']; ?></td> -->
                                        <td>
                                            <?php echo isset($row['id_funcionario_fk_asignado']) ? quees('funcionario', $row['id_funcionario_fk_asignado']) : 'Sin Asignar';
                                            ?>
                                        </td>
                                        <td>
                                            <?php if (isset($row['id_cd_tipo_fk_cd_tipo'])) {
                                                echo quees('cd_tipo', $row['id_cd_tipo_fk_cd_tipo']);
                                            } ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (0 == $row['checkbox_prioritario_cd']) {
                                                echo 'No';
                                            } elseif (1 == $row['checkbox_prioritario_cd']) {
                                                echo 'Si';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $row['estado_expediente_cd'];
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <script>
                                    $(document).ready(function() {
                                        $('#controlprocesoreporte').DataTable({
                                            dom: 'Bfrtip',
                                            buttons: [{
                                                    extend: 'excelHtml5',
                                                    title: 'Historico expedientes SID <?php echo date("d-m-Y"); ?>'
                                                },
                                                {
                                                    extend: 'csvHtml5',
                                                    title: 'Historico expedientes SID <?php echo date("d-m-Y"); ?>'
                                                }
                                            ],
                                            "lengthMenu": [
                                                [50, 100, 200, 300, 500],
                                                [50, 100, 200, 300, 500]
                                            ],
                                            "language": {
                                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                                            }
                                        });
                                    });
                                </script>

                            </tbody>
                        </table>
                    </div>
                </div> <!-- BODY -->

            </div> <!-- BOX -->
        </div> <!-- COL-MD-12 -->
    </div> <!-- ROW -->

<?php

} else {
}

?>
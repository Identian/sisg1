<?php
$nump124 = privilegios(124, $_SESSION['snr']); // SID Migracion
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
    $nomenclatura = 'AND consecutivo_nomenclatura_cd=DDS';
    $GlobalTipoDeOficina = 6;
}


if (1 == $_SESSION['rol'] or 0 < $nump143) {
    $nomenclatura = '';
    $GlobalTipoDeOficina = 3;
}


if (1 == $_SESSION['rol'] or 0 < $nump124) {
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
                    <h4 class="box-title"><b>Historico Expedientes SID ANTIGUO</b></h4>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div> <!-- BOX HEADER -->
                <div class="box-body">

                    <div>
                        <form action="" method="POST" name="controlprocesomigracionreportesdd56">
                            <span style=" float: left;">&nbsp;&nbsp;Dependencia&nbsp;&nbsp;</span>
                            <select class="form-control" name="nomenclatura_cdmso" style="width:300px; float: left;">
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
                            <input class="btn btn-primary" type="submit" name="control_proceso_migracion_reporte" value="Buscar" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="./control_proceso_migracion_reporte.jsp" class="btn btn-default">Restaurar</a>
                        </form>
                    </div><br><br>
                    <div class="box-body divscroll200" style="font-size:85%">
                        <table class="table table-bordered" id="controlprocesomigracionreporte">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CREADO POR</th>
                                    <th># EXPEDIENTE</th>
                                    <th>ORIGEN</th>
                                    <th>TIPOLOGIA</th>
                                    <th>ENTIDAD</th>
                                    <th>IMPLICADOS</th>
                                    <th>AREA ACTUAL</th>
                                    <th>FASE</th>
                                    <th>ETAPA</th>
                                    <th>ESTADO</th>
                                    <th>OBSERVACIÓN</th>
                                    <th>AJUNTOS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['control_proceso_migracion_reporte'])) {
                                    $nomCdmso = $_POST['nomenclatura_cdmso'];
                                    $query4 = sprintf("SELECT * FROM cd_migracion_sid
                                    LEFT JOIN cd_migracion_traslado
                                    ON cd_migracion_sid.id_cdms=cd_migracion_traslado.id_fk_cd_migracion_sid 
                                    WHERE (cd_migracion_sid.nomenclatura_cdmso='$nomCdmso'
                                    OR cd_migracion_traslado.desde_cd_migracion_traslado = $GlobalTipoDeOficina
                                    AND cd_migracion_traslado.estado_cd_migracion_traslado=1)
                                    AND cd_migracion_sid.estado_cdmso=1");
                                } else {
                                    $query4 = sprintf("SELECT * FROM cd_migracion_sid WHERE estado_cdmso=2");
                                }
                                $result = $mysqli->query($query4);
                                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                ?>
                                    <tr>
                                    <?php
                                        echo '<td>' . $row['id_cdms'] . '</td>';
                                        echo '<td>' . $row['nomenclatura_cdmso'] . '</td>';
                                        echo '<td>';
                                        if ($row['nomenclatura_cdmso'] == 'SDC') {
                                            if ($row['fase_cdmso'] == 'Juzgamiento' || $row['fase_cdmso'] == 'Segunda Instancia') {
                                                echo 'OCDI-JZ' . '-' . $row['id_cdms'] . '-' . $row['ano_cdmso'] . '-' . 'C-' . $row['proc_nro_radicacion_cdmso'];
                                            } else {
                                                echo 'C-' . $row['proc_nro_radicacion_cdmso'];
                                            }
                                        } else {
                                            if ($row['fase_cdmso'] == 'Juzgamiento' || $row['fase_cdmso'] == 'Segunda Instancia') {
                                                echo 'OCDI-JZ' . '-' . $row['id_cdms'] . '-' . $row['ano_cdmso'] . '-' . $row['proc_nro_radicacion_cdmso'];
                                            } else {
                                                echo $row['proc_nro_radicacion_cdmso'];
                                            }
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if ($row['proc_origen_cdmso'] == 'O') {
                                            echo 'De Oficio';
                                        }
                                        if ($row['proc_origen_cdmso'] == 'C') {
                                            echo 'Ciudadano';
                                        }
                                        if ($row['proc_origen_cdmso'] == 'A') {
                                            echo 'Falta identificar';
                                        }
                                        if ($row['proc_origen_cdmso'] == 'IO') {
                                            echo 'Informe oficial';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        echo isset($row['nombre_cd_tipo']) ? $row['nombre_cd_tipo'] : '';
                                        echo '</td>';
                                        echo '<td>';
                                        $id_cdms = $row['id_cdms'];
                                        $Query8 = "SELECT nombre_cd_migracion_entidad FROM cd_migracion_entidad 
                                            WHERE id_cdms_fk_cd_migracion_sid=$id_cdms AND estado_cd_migracion_entidad=1";
                                        $result8 = $mysqli->query($Query8);
                                        while ($row8 = $result8->fetch_array(MYSQLI_ASSOC)) {
                                            echo $row8['nombre_cd_migracion_entidad'] . '<br>';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        $id_cdms = $row['id_cdms'];
                                        $Query9 = "SELECT nombre_cd_migracion_implicados FROM cd_migracion_implicados 
                                            WHERE id_cdms_fk_cd_migracion_sid=$id_cdms AND estado_cd_migracion_implicados=1";
                                        $result9 = $mysqli->query($Query9);
                                        while ($row9 = $result9->fetch_array(MYSQLI_ASSOC)) {
                                            echo $row9['nombre_cd_migracion_implicados'] . '<br>';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if ($row['tipo_oficina_cdmso'] == 0) {
                                            echo 'Por Identificar';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 1) {
                                            echo 'ODCI - Oficina de Control Disciplinario Interno';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 2) {
                                            echo 'SDR - Superintendencia Delegada Para El Registro';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 3) {
                                            echo 'SDN - Superintendencia Delegada Para El Notariado';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 4) {
                                            echo 'SDC - Grupo para el control y vigilancia de Curadores Urbanos';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 5) {
                                            echo 'OAJ - Oficina Asesora Juridica';
                                        }
                                        if ($row['tipo_oficina_cdmso'] == 6) {
                                            echo 'DDS - Despacho Del Superintendente';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if (isset($row['fase_cdmso']) and '' <> $row['fase_cdmso']) {
                                            echo $row['fase_cdmso'];
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if (isset($row['etapa_cdmso']) and '' <> $row['etapa_cdmso']) {
                                            echo quees('cd_migracion_etapa', $row['etapa_cdmso']);
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if ($row['estado_expediente_cdmso'] == 'Activo') {
                                            echo 'Activo';
                                        } else {
                                            echo 'Finalizado';
                                        }
                                        echo '</td>';
                                        echo '<td>';  
                                            echo $row['observacion_cdmso'];                                
                                        echo '</td>';
                                        echo '<td>';
                                            if ($row['estado_expediente_cdmso'] == 'Finalizado') {
                                                $id = $row['proc_id_cdmso'];
                                                $query1 = "SELECT id_procf_cdmfs, nombre_procf_cdmfs FROM cd_migracion_file_sid 
                                                INNER JOIN cd_migracion_sid
                                                ON cd_migracion_file_sid.id_proc_cdmfs=cd_migracion_sid.proc_id_cdmso
                                                WHERE id_proc_cdmfs='$id' AND estado_cd_migracion_file_sid=1";
                                                $result1 = $mysqli->query($query1);
                                                while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) {
                                                    echo '<a href="https://sisg.supernotariado.gov.co/filesnr/archivo/' . $row1['id_procf_cdmfs'] . '" target="_blank">' . $row1['nombre_procf_cdmfs'] . '</a><br>';
                                                }
                                            }
                                        echo '</td>';
                                        ?>
                                    </tr>
                                <?php
                                }
                                $result->free();
                                ?>

                                <script>
                                    $(document).ready(function() {
                                        $('#controlprocesomigracionreporte').DataTable({
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


    <div class="row">
        <div class="col-md-12" style="font-size:100%">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title"><b>Historico Traslados Expedientes</b></h4>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div> <!-- BOX HEADER -->
                <div class="box-body">

                    <div>
                        <form action="" method="POST" name="controltraslado">
                            <span style=" float: left;">&nbsp;&nbsp;Dependencia&nbsp;&nbsp;</span>
                            <select class="form-control" name="nomenclatura_cdmso" style="width:300px; float: left;">
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
                            <input class="btn btn-primary" type="submit" name="control_traslado" value="Buscar" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="./control_proceso_migracion_reporte.jsp" class="btn btn-default">Restaurar</a>
                        </form>
                    </div><br><br>
                    <div class="box-body divscroll200" style="font-size:85%">
                        <table class="table table-bordered" id="controltraslado">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th># EXPEDIENTE</th>
                                    <th>TIPOLOGIA</th>
                                    <th>ENTIDAD</th>
                                    <th>IMPLICADOS</th>
                                    <th>FECHA DEL TRASLADO</th>
                                    <th>AREA QUE REALIZA TRASLADO</th>
                                    <th>AREA QUE RECIBE TRASLADO</th>
                                    <th>USUARIO EFECTUO TRASLADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['control_traslado'])) {
                                    $nomCdmso = $_POST['nomenclatura_cdmso'];
                                    $query4 = sprintf("SELECT * FROM cd_migracion_traslado
                                    LEFT JOIN cd_migracion_sid
                                    ON cd_migracion_sid.id_cdms=cd_migracion_traslado.id_fk_cd_migracion_sid 
                                    WHERE (cd_migracion_sid.nomenclatura_cdmso='$nomCdmso'
                                    OR cd_migracion_traslado.desde_cd_migracion_traslado = $GlobalTipoDeOficina
                                    AND cd_migracion_traslado.estado_cd_migracion_traslado=1)
                                    AND cd_migracion_sid.estado_cdmso=1");
                                } else {
                                    $query4 = sprintf("SELECT * FROM cd_migracion_sid WHERE estado_cdmso=2");
                                }
                                $result = $mysqli->query($query4);
                                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                ?>
                                    <tr>
                                    <?php
                                        echo '<td>' . $row['id_cdms'] . '</td>';
                                        echo '<td>' . $row['proc_nro_radicacion_cdmso'] . '</td>';
                                        echo '<td>';
                                        echo isset($row['nombre_cd_tipo']) ? $row['nombre_cd_tipo'] : '';
                                        echo '</td>';
                                        echo '<td>';
                                        $id_cdms = $row['id_cdms'];
                                        $Query8 = "SELECT nombre_cd_migracion_entidad FROM cd_migracion_entidad 
                                            WHERE id_cdms_fk_cd_migracion_sid=$id_cdms AND estado_cd_migracion_entidad=1";
                                        $result8 = $mysqli->query($Query8);
                                        while ($row8 = $result8->fetch_array(MYSQLI_ASSOC)) {
                                            echo $row8['nombre_cd_migracion_entidad'] . '<br>';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        $id_cdms = $row['id_cdms'];
                                        $Query9 = "SELECT nombre_cd_migracion_implicados FROM cd_migracion_implicados 
                                            WHERE id_cdms_fk_cd_migracion_sid=$id_cdms AND estado_cd_migracion_implicados=1";
                                        $result9 = $mysqli->query($Query9);
                                        while ($row9 = $result9->fetch_array(MYSQLI_ASSOC)) {
                                            echo $row9['nombre_cd_migracion_implicados'] . '<br>';
                                        }
                                        echo '</td>';
                                        echo '<td>' . $row['fecha_creado_cd_migracion_traslado'] . '</td>';
                                        echo '<td>';
                                        if ($row['desde_cd_migracion_traslado'] == 0) {
                                            echo 'Por Identificar';
                                        }
                                        if ($row['desde_cd_migracion_traslado'] == 1) {
                                            echo 'ODCI - Oficina de Control Disciplinario Interno';
                                        }
                                        if ($row['desde_cd_migracion_traslado'] == 2) {
                                            echo 'SDR - Superintendencia Delegada Para El Registro';
                                        }
                                        if ($row['desde_cd_migracion_traslado'] == 3) {
                                            echo 'SDN - Superintendencia Delegada Para El Notariado';
                                        }
                                        if ($row['desde_cd_migracion_traslado'] == 4) {
                                            echo 'SDC - Grupo para el control y vigilancia de Curadores Urbanos';
                                        }
                                        if ($row['desde_cd_migracion_traslado'] == 5) {
                                            echo 'OAJ - Oficina Asesora Juridica';
                                        }
                                        if ($row['desde_cd_migracion_traslado'] == 6) {
                                            echo 'DDS - Despacho Del Superintendente';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if ($row['para_cd_migracion_traslado'] == 0) {
                                            echo 'Por Identificar';
                                        }
                                        if ($row['para_cd_migracion_traslado'] == 1) {
                                            echo 'ODCI - Oficina de Control Disciplinario Interno';
                                        }
                                        if ($row['para_cd_migracion_traslado'] == 2) {
                                            echo 'SDR - Superintendencia Delegada Para El Registro';
                                        }
                                        if ($row['para_cd_migracion_traslado'] == 3) {
                                            echo 'SDN - Superintendencia Delegada Para El Notariado';
                                        }
                                        if ($row['para_cd_migracion_traslado'] == 4) {
                                            echo 'SDC - Grupo para el control y vigilancia de Curadores Urbanos';
                                        }
                                        if ($row['para_cd_migracion_traslado'] == 5) {
                                            echo 'OAJ - Oficina Asesora Juridica';
                                        }
                                        if ($row['para_cd_migracion_traslado'] == 6) {
                                            echo 'DDS - Despacho Del Superintendente';
                                        }
                                        echo '</td>';
                                        echo '<td>' . quees('funcionario', $row['id_fk_funcionario']) . '</td>';
                                        ?>
                                    </tr>
                                <?php
                                }
                                $result->free();
                                ?>

                                <script>
                                    $(document).ready(function() {
                                        $('#controltraslado').DataTable({
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
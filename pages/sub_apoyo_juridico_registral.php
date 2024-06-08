<?php
// SUBDIRECCION DE APOYO JURIDICO REGISTRAL

// PRIVILEGIOS
$nump167 = privilegios(167, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Admin 
$nump168 = privilegios(168, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Abogado
$nump171 = privilegios(171, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Subdirector
$nump172 = privilegios(172, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Notificador


// FECHA ACTUAL
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$anoActual = date("Y");
$idFuncionario = $_SESSION['snr'];

// VALIDACION GENERAL DE INGRESO
1 == $_SESSION['rol'] || 0 < $nump167 || 0 < $nump168 || 0 < $nump171 || 0 < $nump172 ?: exit;

// INCREMENTAR EXPEDIENTE
function obtenerUltimoNumeroExpediente($anoActual, $mysqli)
{
    $query = "SELECT numero_expediente as maximo_expediente FROM sajr WHERE estado_sajr=1 AND ano_expediente=$anoActual ORDER BY numero_expediente DESC LIMIT 1";
    $resultado = $mysqli->query($query);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $ultimoNumero = $fila['maximo_expediente'];
    } else {
        $ultimoNumero = 0;
    }
    return $ultimoNumero;
}

// NUEVO
if (isset($_POST["guardarsajr"]) && '' != $_POST["guardarsajr"]) {
    // "radicado_iris" => crearNuevoIris($_SESSION['username_iris'], '315', '1863', 'TRAMITES PARA COMISIONES DE SERVICIO SNR', 'IE', 'COMISION ', 'COMISION', $conexionpostgres),
    $NumeroExp = intval(obtenerUltimoNumeroExpediente($anoActual, $mysqli)) + 1;
    $datos = array(
        "radicado" => 'SNR' . $anoActual . 'ER' . $_POST["radicado"],
        "fecha_radicado" => $_POST["fecha_radicado"],
        "medio_radicado" => $_POST["medio_radicado"],
        "tipo_recurso" => $_POST["tipo_recurso"],
        "numero_expediente" => $NumeroExp,
        "ano_expediente" => intval($anoActual),
        "descripcion_sajr" => $_POST["descripcion_sajr"],
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "sajr", $datos)) {
        sweetAlert('OK', 'Creado Correctamente.', 'success');
    } else {
        echo "Error en la inserción";
    }
}
?>

<script src="../plugins/ckeditor40/ckeditor.js"></script>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo existencia('sajr'); ?></h3>
                <p>Asignaciones</p>
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
                <h3><?php echo existencia('sajr_vigencia'); ?></h3>
                <p>Expedientes</p>
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
                <h3><?php echo existencia('oficina_registro'); ?></h3>
                <p>Oficinas De registro</p>
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

<div class="box box-primary">
    <div class="box-header with-border">
        <h6 class="box-title">Apoyo Juridico Registral</h6>
        &nbsp;
        &nbsp;
        <?php if (1 == $_SESSION['rol'] || (0 < $nump167)) { ?>
            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalCrearSajr"> Nuevo </button>
        <?php } ?>
        <div class="box-tools pull-right">
            <?php if (1 == $_SESSION['rol'] || (0 < $nump167)) { ?>
                <a href="#" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-fw fa-table"></i> Historico </a>
            <?php } ?>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form class="navbar-form" name="formbuscadorsajr" method="post" action="">
                <div class="input-group">
                    <div class="input-group-btn">Buscar
                        <select class="form-control" name="campo" required>
                            <option value="" selected> - - Buscar por: - - </option>
                            <option value="descripcion_sajr">Descripcion</option>
                        </select>
                    </div>
                    <div class="input-group-btn">
                        <input type="text" name="buscar" placeholder="" class="form-control" required>
                    </div>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6" style="text-align: right; padding-top:20px; padding-right:30px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/Coat_of_arms_of_Colombia.svg/250px-Coat_of_arms_of_Colombia.svg.png" alt="Logo Rama Judicial" width="20" height="20">
                    <a href="https://consultaprocesos.ramajudicial.gov.co/Procesos/Index" target="_blank"> Consulta de Procesos Rama Judicial</a>
                </div>
                <div class="col-md-4">
                    <img src="https://samai.consejodeestado.gov.co/Imagenes/oficial/samailogo_BH71.png" alt="Logo Rama Judicial" width="20" height="20">
                    <a href="https://samai.consejodeestado.gov.co" target="_blank"> Samai</a>
                </div>
                <div class="col-md-4">
                    <img src="https://procesojudicial.ramajudicial.gov.co/Justicia21/Imagenes/png/icono_justicia21.png" alt="Logo Rama Judicial" width="20" height="20">
                    <a href="https://procesojudicial.ramajudicial.gov.co/Justicia21/" target="_blank"> TYBA</a>
                </div>
            </div>
        </div>
    </div>

    <div class="box-body">
        <table class="table table-bordered" id="Sajr">
            <thead>
                <tr align="center" valign="middle">
                    <th>#</th>
                    <th>Radicado</th>
                    <th>Numero Expediente</th>
                    <th>Fecha</th>
                    <th>Asignacion</th>
                    <th>Tipologia</th>
                    <th>Orip - Matriculas</th>
                    <th>Recurrentes</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                    $infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
                    $infop = $infobus;
                } else {
                    $infop = '';
                }
                if (1 == $_SESSION['rol'] || 0 < $nump167) {
                    $query5 = "SELECT * FROM sajr WHERE estado_sajr=1 $infop";
                } elseif (0 < $nump168) {
                    $query5 = "SELECT * FROM sajr, sajr_asignacion 
                    WHERE sajr.id_sajr=sajr_asignacion.fk_id_sajr 
                    AND sajr_asignacion.fk_hasta_id_funcionario=$idFuncionario $infop
                    AND sajr.estado_sajr=1";
                } else {
                    $query5 = "SELECT * FROM sajr WHERE estado_sajr=0";
                }
                $result5 = $mysqli->query($query5);
                while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) {
                    if ($row5['id_sajr']) { ?>
                        <tr>
                            <td><?php echo isset($row5['id_sajr']) ? $row5['id_sajr'] : ''; ?></td>

                            <td>
                                <?php if (isset($row5['radicado'])) {
                                    echo '<a href="http://sisg.supernotariado.gov.co/correspondencia&' . $row5['radicado'] . '.jsp" target="_blank">' . $row5['radicado'] . '</a>';
                                } else {
                                    echo '';
                                }  ?>
                            </td>
                            <td><?php echo isset($row5['numero_expediente']) && isset($row5['ano_expediente']) ? 'SAJ-' . $row5['numero_expediente'] . '-' . $row5['ano_expediente'] : ''; ?></td>
                            <td><?php echo isset($row5['fecha'])  ? $row5['fecha'] : ''; ?></td>
                            <td>
                                <?php
                                $idSajr = $row5['id_sajr'];
                                $query1 = "SELECT * FROM sajr_asignacion WHERE fk_id_sajr=$idSajr AND estado_sajr_asignacion=1 ORDER BY fecha DESC";
                                $result1 = $mysqli->query($query1);
                                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                                echo isset($row1['fk_hasta_id_funcionario'])  ? quees('funcionario', $row1['fk_hasta_id_funcionario']) : 'Sin Asignar';
                                $result1->free(); ?>
                            </td>
                            <td>
                                <?php echo isset($row5['tipo_recurso']) ? buscarcampo('sajr_opcion', 'nombre_sajr_opcion', 'id_sajr_opcion=' . $row5['tipo_recurso']) : ''; ?>
                            </td>
                            <td style="font-size: 11px;">
                                <?php $query2 = "SELECT * FROM sajr_incluido WHERE fk_id_sajr=$idSajr AND estado_sajr_incluido=1";
                                $result2 = $mysqli->query($query2);
                                while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                                    echo isset($row2['fk_id_oficina_registro'])  ? buscarcampo('oficina_registro', 'nombre_oficina_registro', 'id_oficina_registro=' . $row2['fk_id_oficina_registro']) : '';
                                    
									
									if (isset($row2['fk_id_oficina_registro'])) {
										echo ' ';
										echo circulo($row2['fk_id_oficina_registro']);
										echo '-';
									} else {}
									
									
									echo isset($row2['matriculas'])  ? ' - ' . $row2['matriculas'] : '';
                                    echo isset($row2['fk_id_oficina_registro']) ? '<br>' : '';
                                }
                                $result2->free(); ?>
                            </td>
                            <td style="width:300px; font-size: 11px;">
                                <?php $query3 = "SELECT * FROM sajr_incluido WHERE fk_id_sajr=$idSajr AND estado_sajr_incluido=1";
                                $result3 = $mysqli->query($query3);
                                while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) {
                                    echo isset($row3['nombre_sajr_incluido']) && is_null($row3['fk_id_oficina_registro'])  ? $row3['nombre_sajr_incluido'] : '';
                                    echo isset($row3['fk_id_tipo_documento'])  ? ' ' . buscarcampo('tipo_documento', 'sigla', 'id_tipo_documento=' . $row3['fk_id_tipo_documento']) : '';
                                    echo isset($row3['numero_documento'])  ? ' ' . $row3['numero_documento'] : '';
                                    echo is_null($row3['fk_id_oficina_registro']) ? '<br>' : '';
                                }
                                $result3->free(); ?>
                            </td>
                            <td>
                                <?php $query1 = "SELECT * FROM sajr_detalle WHERE fk_id_sajr=$idSajr AND estado_sajr_detalle=1 ORDER BY fecha DESC";
                                $result1 = $mysqli->query($query1);
                                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                                echo isset($row1['fk_id_sajr_opcion'])  ? buscarcampo('sajr_opcion', 'estado_proceso_sajr_opcion', 'id_sajr_opcion=' . $row1['fk_id_sajr_opcion']) : '';
                                $result1->free(); ?>
                            </td>
                            <td>
							
							<a href="<?php echo isset($row5['sajr_url_resol']) ? 'files/resoluciones/'.$row5['sajr_url_resol'] : '#'; ?>" target="_blank">Resolución </a> 
							
							
							
                                <a href="./sub_apoyo_juridico_registral_detalle&<?php echo $row5['id_sajr']; ?>.jsp" class="btn btn-primary btn-xs">
                                    <i class="fa fa-fw fa-search" title="Detalle"></i>
                                </a>
                            </td>
                        </tr>
                <?php }
                }
                $result5->free(); ?>
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                $('#Sajr').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5'
                    ],
                    "lengthMenu": [
                        [50, 100, 200, 300, 500],
                        [50, 100, 200, 300, 500]
                    ],
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                    },
                    "aaSorting": [
                        [0, "desc"]
                    ]
                });
            });
        </script>


    </div>
</div>

<!-- NUEVO -->
<div class="modal fade" id="modalCrearSajr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b>Nuevo</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form name="guardarformcrearsajr" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label><span style="color:#ff0000;">*</span>Radicado:</label><br>
                            <div class="row">
                                <label class="col-sm-3 col-form-label">SNR<?php echo $anoActual; ?>ER</label>
                                <div class="col-sm-9">
                                    <input type="text" name="radicado" class="form-control" placeholder="000001" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label><span style="color:#ff0000;">*</span>Fecha Radicado:</label><br>
                            <input type="date" name="fecha_radicado" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label><span style="color:#ff0000;">*</span>Medio Radicación:</label><br>
                            <select name="medio_radicado" class="form-control" required>
                                <option value=""></option>
                                <?php echo listapordefectocondicion('sajr_opcion', '', '', "AND prefijo_sajr_opcion='medio_radicacion'") ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label><span style="color:#ff0000;">*</span>Tipo De Recurso:</label><br>
                            <select name="tipo_recurso" class="form-control" required>
                                <option value=""></option>
                                <?php echo listapordefectocondicion('sajr_opcion', '', '', "AND prefijo_sajr_opcion='tipo_recurso'") ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label><span style="color:#ff0000;">*</span>Descripcion:</label><br>
                            <textarea type="text" name="descripcion_sajr" id="editordescripcionsajr" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-xs" name="guardarsajr" value="guardarsajr"> Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $(function() {
        CKEDITOR.replace('editordescripcionsajr');
    });
</script>
<?php

// FECHA ACTUAL
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$anoActual = date("Y");
$idFuncionario = $_SESSION['snr'];

// PRIVILEGIOS
$nump141 = privilegios(141, $_SESSION['snr']);  // Tutelas Grupo de Administracion Judicial Admin
$nump142 = privilegios(142, $_SESSION['snr']); // Tutelas Grupo de Administracion Judicial Abogados

// PRIVILEGIOS DEPENDECIAS
$nump23 = privilegios(23, $_SESSION['snr']);  // Tutelas Grupo de Administracion Judicial Dependencias Lider
$nump24 = privilegios(24, $_SESSION['snr']); // Tutelas Grupo de Administracion Judicial Dependencias Abogado

if (1 == $_SESSION['rol'] || 0 < $nump141 || 0 < $nump142) {
    $idDONC = 0;
    $prefijoDONC = 'DEPENDENCIA';
    $privilegiosLider = 0;
    $privilegiosAbogado = 0;
} elseif (0 < $nump23 || 0 < $nump24) {
    // Dependencias
    $idDONC = $_SESSION['snr_grupo_area'];
    $prefijoDONC = 'DEPENDENCIA';
    $privilegiosLider = $nump23; // Lider Tutela
    $privilegiosAbogado = $nump24;  // Abogado Tutela

} elseif (2 == $_SESSION['snr_tipo_oficina']) {
    // Oficinas de Registro
    $idDONC = $_SESSION['id_oficina_registro'];
    $prefijoDONC = 'OFICINA REGISTRO';
    $privilegiosLider = 0 < privreg($idDONC, $idFuncionario, 9, 14); // Lider Tutela
    $privilegiosAbogado = 0 < privreg($idDONC, $idFuncionario, 9, 15); // Abogado Tutela

} elseif (3 == $_SESSION['snr_tipo_oficina']) {
    // Notarias
    $idDONC = $_SESSION['posesionnotaria'];
    $prefijoDONC = 'NOTARIA';
    $privilegiosLider = 0 < privilegiosnotariado($idDONC, 15, $idFuncionario); // Lider Tutela
    $privilegiosAbogado = 0 < privilegiosnotariado($idDONC, 16, $idFuncionario); // Abogado Tutela

} elseif (4 == $_SESSION['snr_tipo_oficina']) {
    // Curadurias
    $idDONC = $_SESSION['id_vigiladocurador'];
    $prefijoDONC = 'CURADURIA';
    $privilegiosLider = 0 < privilegiosnotariado($idDONC, 1, $idFuncionario); // Lider Tutela
    $privilegiosAbogado = 0 < privilegiosnotariado($idDONC, 2, $idFuncionario); // Abogado Tutela
} else {
    $idDONC = 0;
    $prefijoDONC = '';
    $privilegiosLider = 0;
    $privilegiosAbogado = 0;
}

// VALIDACION GENERAL DE INGRESO
1 == $_SESSION['rol'] ||  0 < $nump141 ||  0 < $nump142 || 0 < $privilegiosLider || 0 < $privilegiosAbogado ?: exit;

// NUEVA TUTELA
if (isset($_POST["guardarGajTutela"]) && '' != $_POST["guardarGajTutela"]) {
    // "radicado_iris" => crearNuevoIris($_SESSION['username_iris'], '315', '1863', 'TRAMITES PARA COMISIONES DE SERVICIO SNR', 'IE', 'COMISION ', 'COMISION', $conexionpostgres),
    $datos = array(
        "radicado" => $_POST["radicado"],
        "juzgado" => $_POST["juzgado"],
        "email_juzgado" => $_POST["email_juzgado"],
        "fecha_tutela" => $_POST["fecha_tutela"],
        "tema" => $_POST["tema"],
        "fecha_tutela" => $_POST["fecha_tutela"],
        "derecho_fundamental" => $_POST["derecho_fundamental"],
        "fecha" => $fechaActual,
    );
    if (insertarDatos($mysqli, "gaj_tutela", $datos)) {
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
                <h3><?php echo existencia('gaj_tutela'); ?></h3>
                <p>Tutelas</p>
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
                <h3><?php echo existencia('oficina_registro'); ?></h3>
                <p>Oficinas de Registro</p>
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
                <h3><?php echo existencia('notaria'); ?></h3>
                <p>Notarias</p>
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
                <h3><?php echo existencia('curaduria'); ?></h3>
                <p>Curadurias</p>
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
        <h6 class="box-title">Tutelas</h6>
        &nbsp;
        &nbsp;
        <?php if (1 == $_SESSION['rol'] || 0 < $nump141) { ?>
            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalCrearGajTutela"> Nuevo </button>
        <?php } ?>
        <div class="box-tools pull-right">
            <?php if (1 == $_SESSION['rol'] || 0 < $nump141) { ?>
                <a href="#" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-fw fa-table"></i> Historico </a>
            <?php } ?>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form class="navbar-form" name="formbuscadorgaj" method="post" action="">
                <div class="input-group">
                    <div class="input-group-btn">Buscar
                        <select class="form-control" name="campo" required>
                            <option value="" selected> - - Buscar por: - - </option>
                            <option value="gaj_tutela.descripcion_tutela">Descripcion</option>
							
							
								<option value="gaj_tutela.radicado">Radicado</option>
									<option value="gaj_tutela.juzgado">Juzgado</option>
										<option value="gaj_tutela.fecha">Fecha</option>
							
							
											
							
							
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
	
	
			<style>


.dataTables_filter {
display:none;
}



.dataTables_paginate {
display:none;
}

			</style> 
			
			
        <table class="table table-bordered" id="gaj_tutela">
            <thead>
                <tr align="center" valign="middle">
                    <th>Id</th>
                    <th>Radicado</th>
                    <th>Juzgado</th>
                    <th>Fecha</th>
                    <th>Asignado</th>
                    <th>Traslado</th>
                    <th>Accionado o Accionante</th>
                    <th>Estado</th>
                    <th>Acción</th>
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
                if (1 == $_SESSION['rol'] || 0 < $nump141) {
                    $query5 = "SELECT * FROM gaj_tutela WHERE estado_gaj_tutela=1 $infop ORDER BY fecha DESC limit 50";
                } elseif (0 < $privilegiosLider) {
                    $query5 = "SELECT * FROM gaj_tutela AS gt
                    LEFT JOIN gaj_tutela_asignacion AS gta
                    ON gt.id_gaj_tutela=gta.fk_id_gaj_tutela 
                    WHERE gta.nombre_gaj_tutela_asignacion='Traslado' 
                    AND gta.fk_nombre_gaj_tutela_traslado='$prefijoDONC' 
                    AND gta.fk_id_gaj_tutela_traslado='$idDONC' $infop
                    ORDER BY gta.fecha DESC";
                } elseif (0 < $privilegiosAbogado || 0 < $nump142) {
                    $query5 = "SELECT * FROM gaj_tutela
                    LEFT JOIN gaj_tutela_asignacion
                    ON gaj_tutela.id_gaj_tutela = gaj_tutela_asignacion.fk_id_gaj_tutela
                    WHERE gaj_tutela_asignacion.nombre_gaj_tutela_asignacion = 'Asignado'
                    AND estado_gaj_tutela_asignacion=1 
					AND gaj_tutela_asignacion.fk_hasta_id_funcionario = $idFuncionario $infop 
					AND gaj_tutela_asignacion.id_gaj_tutela_asignacion = (
                        SELECT MAX(id_gaj_tutela_asignacion)
                        FROM gaj_tutela_asignacion
                        WHERE fk_id_gaj_tutela = gaj_tutela.id_gaj_tutela)
                   ";
				   
				   
						
                } else {
                    $query5 = "SELECT id_gaj_tutela FROM gaj_tutela WHERE id_gaj_tutela=0";
                }
                $result5 = $mysqli->query($query5);
                while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) {
                    if ($row5['id_gaj_tutela']) { ?>
                        <tr>
                            <td><?php echo isset($row5['id_gaj_tutela']) ? $row5['id_gaj_tutela'] : ''; ?></td>
                            <td><?php echo isset($row5['radicado'])  ? $row5['radicado'] : ''; ?></td>
                            <td><?php echo isset($row5['juzgado'])  ? $row5['juzgado'] : ''; ?></td>
                            <td><?php echo isset($row5['fecha'])  ? $row5['fecha'] : ''; ?></td>
                            <td>
                                <?php
                                $idTutela = $row5['id_gaj_tutela'];
                                $query1 = "SELECT * FROM gaj_tutela_asignacion WHERE fk_id_gaj_tutela=$idTutela AND estado_gaj_tutela_asignacion=1 ORDER BY fecha DESC";
                                $result1 = $mysqli->query($query1);
                                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                                echo isset($row1['fk_hasta_id_funcionario'])  ? quees('funcionario', $row1['fk_hasta_id_funcionario']) : 'Sin Asignar';
                                $result1->free(); ?>
                            </td>
                            <td>
							
                                <?php $idTutela = $row5['id_gaj_tutela'];
                                $query1 = "SELECT * FROM gaj_tutela_asignacion WHERE fk_id_gaj_tutela=$idTutela AND estado_gaj_tutela_asignacion=1 AND nombre_gaj_tutela_asignacion='Traslado' ORDER BY fecha DESC";
                                $result1 = $mysqli->query($query1);
                                $row1 = $result1->fetch_array(MYSQLI_ASSOC);

                                if (isset($row1['fk_nombre_gaj_tutela_traslado']) && 'DEPENDENCIA' == $row1['fk_nombre_gaj_tutela_traslado']) {
                                    $donc = quees('grupo_area', $row1['fk_id_gaj_tutela_traslado']);
                                }
                                if (isset($row1['fk_nombre_gaj_tutela_traslado']) && 'OFICINA REGISTRO' == $row1['fk_nombre_gaj_tutela_traslado']) {
                                    $donc = quees('oficina_registro', $row1['fk_id_gaj_tutela_traslado']);
                                }
                                if (isset($row1['fk_nombre_gaj_tutela_traslado']) && 'NOTARIA' == $row1['fk_nombre_gaj_tutela_traslado']) {
                                    $donc = quees('notaria', $row1['fk_id_gaj_tutela_traslado']);
                                }
                                if (isset($row1['fk_nombre_gaj_tutela_traslado']) && 'CURADURIA' == $row1['fk_nombre_gaj_tutela_traslado']) {
                                    $donc = quees('curaduria', $row1['fk_id_gaj_tutela_traslado']);
                                }
                                echo isset($row1['fk_nombre_gaj_tutela_traslado']) && isset($row1['fk_id_gaj_tutela_traslado']) ? $row1['fk_nombre_gaj_tutela_traslado'] . ' - ' . $donc : 'Sin Asignar';
                                $result1->free(); ?>
                            </td>
                            <td style="font-size: 11px; width: 400px;">
                                <?php $idTutela = $row5['id_gaj_tutela'];
                                $query2 = "SELECT * FROM gaj_tutela_incluidos WHERE fk_id_gaj_tutela=$idTutela";
                                $result2 = $mysqli->query($query2);
                                while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                                    echo isset($row2['accionado_accionante']) ? ' (' . $row2['accionado_accionante'] . ') ' . $row2['nombre_gaj_tutela_incluidos'] . '<br>' : '';
                                }
                                $result2->free(); ?>
                            </td>
                            <td>
                                <?php $idTutela = $row5['id_gaj_tutela'];
                                $query1 = "SELECT * FROM gaj_tutela_detalle WHERE fk_id_gaj_tutela=$idTutela AND estado_gaj_tutela_detalle=1 ORDER BY fecha DESC";
                                $result1 = $mysqli->query($query1);
                                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                                echo isset($row1['fecha'])  ? quees('gaj_tutela_opcion', $row1['fk_tutela_opcion']) : 'Inicial';
                                $result1->free(); ?>
                            </td>
                            <td>
                                <a href="./gaj_tutela_detalle&<?php echo $row5['id_gaj_tutela']; ?>.jsp" target="_blank" class="btn btn-primary btn-xs">
                                    <i class="fa fa-fw fa-search" title="Detalle Tutela"></i>
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
                $('#gaj_tutela').DataTable({
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

<!-- NUEVA TUTELA -->
<div class="modal fade" id="modalCrearGajTutela" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b>Tutela</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form name="guardarformcreargajtutela" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label><span style="color:#ff0000;">*</span>Radicado:</label><br>
                            <input type="text" name="radicado" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label><span style="color:#ff0000;">*</span>Juzgado:</label><br>
                            <input type="text" name="juzgado" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label><span style="color:#ff0000;">*</span>Email Juzgado:</label><br>
                            <input type="text" name="email_juzgado" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label><span style="color:#ff0000;">*</span>Fecha Tutela:</label><br>
                            <input type="date" name="fecha_tutela" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label> Tema:</label><br>
                           <!-- <input type="text" name="tema" class="form-control">-->
						   <select  class="form-control" name="tema" >
						   <option></option>
						   
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
						   
						   
                        </div>

                        <div class="col-md-6">
                            <label> Derecho Fundamental:</label><br>
                          <!--  <input type="text" name="derecho_fundamental" class="form-control">-->
							
							   <select  class="form-control" name="derecho_fundamental" >
						   <option></option>
						   
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
						   
						   
                        </div>

                        <div class="col-md-12">
                            <label><span style="color:#ff0000;">*</span>Descripcion Tutela:</label><br>
                            <textarea type="text" name="descripcion_tutela" id="editordescripciontutela" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-xs" name="guardarGajTutela" value="guardarGajTutela"> Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
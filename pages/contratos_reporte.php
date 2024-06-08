<style>
    .divscroll {
        overflow-y: hidden;
        overflow-x: scroll;
    }
</style>

<div class="box box-primary">
    <div class="box-header with-border">
        <h6 class="box-title">Contratos</h6>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="divscroll">
            <table class="table table-striped table-bordered table-hover nowrap" id="contratosReporte">
                <thead>
                    <tr align="center" valign="middle">
                        <th>Id</th>
                        <th>N Contrato</th>
                        <th>Modalidad</th>
                        <th>Clase Contrato/convenio</th>
                        <th>Prestacion de Servicios</th>
                        <th>Cedula/Nit</th>
                        <th>Contratista</th>
                        <th>Fecha Suscripcion</th>
                        <th>Objeto</th>
                        <th>Obligaciones Especificas</th>

                        <th>Perfil</th>
                        <th>Naturaleza</th>
                        <th>Valor Inicial</th>
                        <th>Valor Total</th>
                        <th>Valor Mensual</th>
                        <th>Ciudad Ejecucion</th>
                        <th>Fecha Acta</th>
                        <th>Fecha Terminacion</th>
                        <th>Fecha Exp Garantia</th>
                        <th>Supervisor</th>

                        <th>Area Supervisor</th>
                        <th>Cargo Supervisor</th>
                        <th>Rubro</th>
                        <th>Afectacion Recurso</th>
                        <th>Abogado Responsable</th>
                        <th>Profesion</th>
                        <th>Fecha Nacimiento</th>
                        <th>Lugar Nacimiento</th>
                        <th>Edad</th>
                        <th>Modificaciones Contrato</th>
                        <th>Estado Contrato</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //   if (isset($idf) && '' != $idf) {
                    //     $query5 = "SELECT * FROM nc_contratos WHERE estado_nc_contratos=1 and id_funcionario=" . $idf . "";
                    //   } elseif (1 == $_SESSION['rol'] || 0 < $nump136) {
                    //     $query5 = "SELECT * FROM nc_contratos WHERE estado_nc_contratos=1 and id_empresa IS NOT NULL";
                    //   } else {
                    //     $query5 = "SELECT * FROM nc_contratos WHERE id_nc_contratos=0";
                    //   }
                    $query5 = "SELECT * FROM nc_contratos WHERE estado_nc_contratos=1"; // WHERE id_nc_contratos=581
                    $result5 = $mysqli->query($query5);
                    while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) {
                        if ($row5['id_nc_contratos']) { ?>
                            <tr>
                                <td><?php echo isset($row5['id_nc_contratos']) ? $row5['id_nc_contratos'] : ''; ?></td>
                                <td><?php echo isset($row5['cod_datos_contrato']) && isset($row5['ano_datos_contrato'])  ? $row5['cod_datos_contrato'] . '-' . $row5['ano_datos_contrato'] : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['id_opcion_modalidad_seleccion']) ? quees('nc_opcion', $row5['id_opcion_modalidad_seleccion']) : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['id_opcion_clase_convenio']) ? quees('nc_opcion', $row5['id_opcion_clase_convenio']) : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['id_opcion_categoria_servicio']) ? quees('nc_opcion', $row5['id_opcion_categoria_servicio']) : 'No esta parametrizado'; ?></td>
                                <td>
                                    <?php
                                    if (isset($row5['id_funcionario']) && '' != buscarcampo('funcionario', 'cedula_funcionario', 'id_funcionario=' . $row5['id_funcionario'])) {
                                        echo  buscarcampo('funcionario', 'cedula_funcionario', 'id_funcionario=' . $row5['id_funcionario']);
                                    } else {
                                        echo 'No esta parametrizado';
                                    } ?>
                                </td>
                                <td><?php echo isset($row5['id_funcionario']) ? quees('funcionario', $row5['id_funcionario']) : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['fecha_inicio']) ? $row5['fecha_inicio'] : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['objeto']) ? $row5['objeto'] : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['obligaciones_especificas']) ? $row5['obligaciones_especificas'] : 'No esta parametrizado'; ?></td>

                                <td>
                                    <?php $idSalario = $row5['id_nc_salario'];
                                    if (isset($idSalario)) {
                                        $query6 = "SELECT nombre_nc_cargo FROM nc_cargo LEFT JOIN nc_salario ON nc_cargo.id_nc_cargo=nc_salario.id_nc_cargo WHERE id_nc_salario = $idSalario";
                                        $result6 = $mysqli->query($query6);
                                        $row6 = $result6->fetch_array(MYSQLI_ASSOC) ?>
                                        <?php echo isset($row6['nombre_nc_cargo']) ? $row6['nombre_nc_cargo'] : 'No esta parametrizado'; ?>
                                    <?php } ?>
                                </td>
                                <td><?php echo isset($row5['id_opcion_naturaleza']) ? quees('nc_opcion', $row5['id_opcion_naturaleza']) : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['valor_inicial']) ? $row5['valor_inicial'] : 'No esta parametrizado'; ?></td>
                                <td>Sumar con adiciones</td>
                                <td><?php echo isset($row5['id_nc_salario']) ? quees('nc_salario', $row5['id_nc_salario']) : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['id_municipio']) ? quees('municipio', $row5['id_municipio']) : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['fecha_acta_inicio']) ? $row5['fecha_acta_inicio'] : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['fecha_terminacion']) ? $row5['fecha_terminacion'] : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['fecha_poliza']) ? $row5['fecha_poliza'] : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['id_funcionario_supervisor']) ? quees('funcionario', $row5['id_funcionario_supervisor']) : 'No esta parametrizado'; ?></td>

                                <td>
                                    <?php
                                    if (isset($row5['id_funcionario_supervisor']) && 'No esta parametrizado' != buscarcampo('funcionario', 'id_grupo_area', 'id_funcionario=' . $row5['id_funcionario_supervisor'])) {
                                        $idGrupoArea = buscarcampo('funcionario', 'id_grupo_area', 'id_funcionario=' . $row5['id_funcionario_supervisor']);
                                        $idArea = buscarcampo('grupo_area', 'id_area', 'id_grupo_area=' . $idGrupoArea);
                                        echo quees('area',  $idArea);
                                    } else {
                                        echo 'No esta parametrizado';
                                    }
                                    ?>
                                </td>
                                <td><?php echo isset($row5['id_funcionario_supervisor']) && 'No esta parametrizado' != buscarcampo('funcionario', 'id_grupo_area', 'id_funcionario=' . $row5['id_funcionario_supervisor']) ? quees('cargo_nomina',  buscarcampo('funcionario', 'id_cargo_nomina_encargo', 'id_funcionario=' . $row5['id_funcionario_supervisor'])) : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['texto_nc_rubro']) ? $row5['texto_nc_rubro'] : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['id_opcion_afectacion_recurso']) ? quees('nc_opcion', $row5['id_opcion_afectacion_recurso']) : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['id_reponsable_abogado']) ? quees('funcionario', $row5['id_reponsable_abogado']) : 'No esta parametrizado'; ?></td>
                                <td><?php echo isset($row5['profesion']) ? $row5['profesion'] : 'No esta parametrizado'; ?></td>
                                <td>
                                    <?php
                                    if (isset($row5['id_funcionario']) && '' != buscarcampo('funcionario', 'fecha_nacimiento', 'id_funcionario=' . $row5['id_funcionario'])) {
                                        echo buscarcampo('funcionario', 'fecha_nacimiento', 'id_funcionario=' . $row5['id_funcionario']);
                                    } else {
                                        echo 'No esta parametrizado';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($row5['id_funcionario']) && 'No esta parametrizado' != buscarcampo('funcionario', 'departamento_nacimiento', 'id_funcionario=' . $row5['id_funcionario']) && buscarcampo('funcionario', 'municipio_nacimiento', 'id_funcionario=' . $row5['id_funcionario'])) {
                                        echo buscarcampo('funcionario', 'departamento_nacimiento', 'id_funcionario=' . $row5['id_funcionario']) . '-' . buscarcampo('funcionario', 'municipio_nacimiento', 'id_funcionario=' . $row5['id_funcionario']);
                                    } else {
                                        echo 'No esta parametrizado';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if (isset($row5['id_funcionario']) && 'No esta parametrizado' != buscarcampo('funcionario', 'fecha_nacimiento', 'id_funcionario=' . $row5['id_funcionario'])) {
                                        $fechaNacimiento = buscarcampo('funcionario', 'fecha_nacimiento', 'id_funcionario=' . $row5['id_funcionario']);
                                        echo calculaedad($fechaNacimiento);
                                    } else {
                                        echo  'No esta parametrizado';
                                    } ?>
                                </td>
                                <td>
                                    <?php
                                    $idC = $row5['id_nc_contratos'];
                                    $query7 = "SELECT * FROM nc_modifica_contrato WHERE id_nc_contrato = $idC AND estado_nc_modifica_contrato=1";
                                    $result7 = $mysqli->query($query7);
                                    while ($row7 = $result7->fetch_array(MYSQLI_ASSOC)) { ?>
                                        <?php
                                        echo isset($row7['fecha_modifica']) ? $row7['fecha_modifica'] . ' ' : '';
                                        echo isset($row7['nombre_nc_modifica_contrato']) ? $row7['nombre_nc_modifica_contrato'] . ' ' : '';
                                        echo isset($row7['valor_modifica']) ? 'Valor '.$row7['valor_modifica'] . ' ' : '';
                                        echo isset($row7['nota_modifica']) ? 'Observacion '.$row7['nota_modifica'] . ' ' : '';
                                        echo '<br>';
                                        ?>
                                    <?php } ?>
                                </td>
                                <td><?php echo isset($row5['id_opcion_estado_contratos']) ? quees('nc_opcion', $row5['id_opcion_estado_contratos']) : 'No esta parametrizado'; ?></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>

            <script>
                $(document).ready(function() {
                    $('#contratosReporte').DataTable({
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
</div>
<?php
// Fecha Actual
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$fechaAno = date("Y");


if (isset($_POST["guardar_seguridad_salud_trabajo"]) && $_POST["guardar_seguridad_salud_trabajo"] != "") {
    $insertSQL = sprintf(
        "INSERT INTO seguridad_salud_trabajo (
      id_orip_fk_oficina_registro,
      dependencia,
      tipo_de_novedad,
      categoria_condicion_acto_inseguro_detectado,

      descripcion_detallada,
      condicion_acto_genera_indicidente,
      quien_datos_quien_reporta,
      quien_nombre,
      fecha_verificacion,

      tipo_de_accion,
      describa_accion,
      estado_accion,
      fecha_cierre_accion,
      fecha_creacion) 
      VALUES 
      (%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s)",
        GetSQLValueString($_POST["id_orip_fk_oficina_registro"], "int"),
        GetSQLValueString($_POST["dependencia"], "text"),
        GetSQLValueString($_POST["tipo_de_novedad"], "text"),
        GetSQLValueString($_POST["categoria_condicion_acto_inseguro_detectado"], "text"),

        GetSQLValueString($_POST["descripcion_detallada"], "text"),
        GetSQLValueString($_POST["condicion_acto_genera_indicidente"], "text"),
        GetSQLValueString($_POST["quien_datos_quien_reporta"], "text"),
        GetSQLValueString($_POST["quien_nombre"], "text"),
        GetSQLValueString($_POST["fecha_verificacion"], "date"),

        GetSQLValueString($_POST["tipo_de_accion"], "text"),
        GetSQLValueString($_POST["describa_accion"], "text"),
        GetSQLValueString($_POST["estado_accion"], "text"),
        GetSQLValueString($_POST["fecha_cierre_accion"], "date"),
        GetSQLValueString($fechaActual, "date")
    );
    $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
    // $idInsert = mysql_insert_id($conexion);
    // auditoria(NULL, 'cd', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
    echo $insertado;
    echo '<meta http-equiv="refresh" content="0;URL=./seguridad_salud_trabajo.jsp" />';
}
?>

<!-- modal nuevo seguridad salud trabajo -->
<div class="modal fade" id="nuevoSST" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo</h4>
            </div>
            <div class="modal-body">

                <form action="" method="POST" name="for54354r6546tretret4563m1">

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span>Orip</label>
                        <select class="form-control" name="id_orip_fk_oficina_registro" required>
                            <option value="" selected>-- Seleccionar --</option>
                            <?php $query5 = "SELECT * FROM oficina_registro 
                            WHERE estado_oficina_registro=1 ORDER BY nombre_oficina_registro ASC";
                            $result = $mysqli->query($query5);
                            while ($row5 = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $row5['id_oficina_registro']; ?>"><?php echo $row5['nombre_oficina_registro']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span> Dependencia</label>
                        <input type="text" class="form-control" name="dependencia" required>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de Novedad</label>
                        <select name="tipo_de_novedad" class="form-control" required>
                            <option value="" selected>-- Seleccionar --</option>
                            <option value="Acto Inseguro">Acto Inseguro</option>
                            <option value="Condicion Insegura">Condicion Insegura</option>
                            <option value="Condicion Ambiental">Condicion Ambiental</option>
                            <option value="">Otro</option>
                        </select>
                        <input type="text" class="form-control" name="tipo_de_novedad" placeholder="Escribir el Otro">
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span>
                            Categoria de la Condicion y acto inseguro detectado</label>
                        <select name="categoria_condicion_acto_inseguro_detectado" class="form-control" required>
                            <option value="" selected>-- Seleccionar --</option>
                            <option value="Normas o Procedimientos">Normas o Procedimientos</option>
                            <option value="Instalaciones Locativas o Electricas">Instalaciones Locativas o Electricas</option>
                            <option value="Equipo y/o Herramientas">Equipo y/o Herramientas</option>
                            <option value="Señalizacion">Señalizacion</option>
                            <option value="Condiciones de Orden y Aseo">Condiciones de Orden y Aseo</option>
                            <option value="Condiciones de Seguirdad Vial">Condiciones de Seguirdad Vial</option>
                            <option value="Manejo de Residuos">Manejo de Residuos</option>
                            <option value="Manejo de Emergencias">Manejo de Emergencias</option>
                            <option value="Manejo de Productos Quimicos">Manejo de Productos Quimicos</option>
                            <option value="Manejo de Cargas">Manejo de Cargas</option>
                            <option value="Elemento Ergonomico">Elemento Ergonomico</option>
                            <option value="">Otro</option>
                        </select>

                        <input type="text" class="form-control" name="categoria_condicion_acto_inseguro_detectado" placeholder="Escribir el Otro">
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span> Descripción Detallada</label>
                        <textarea name="descripcion_detallada" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span>
                            ¿La condicion o acto inseguro detectado, genero algun tipo de incidente?</label>
                        <select class="form-control" name="condicion_acto_genera_indicidente" required>
                            <option value="" selected>-- Seleccionar --</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span> Quien Reporta</label>
                        <select class="form-control" name="quien_datos_quien_reporta" required>
                            <option value="" selected>-- Seleccionar --</option>
                            <?php $query6 = "SELECT * FROM cargo 
                            WHERE estado_cargo=1 ORDER BY nombre_cargo ASC";
                            $result6 = $mysqli->query($query6);
                            while ($row6 = $result6->fetch_array(MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $row6['id_cargo']; ?>"><?php echo $row6['nombre_cargo']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span>Nombre quien reporta</label>
                        <input type="text" class="form-control" name="quien_nombre" required>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span> Fecha Verificación</label>
                        <input type="date" name="fecha_verificacion" class="form-control" required>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span>Tipo de Verificación</label>
                        <select class="form-control" name="tipo_de_accion" required>
                            <option value="" selected>-- Seleccionar --</option>
                            <option value="Preventiva">Preventiva</option>
                            <option value="Correctiva">Correctiva</option>
                            <option value="Mejora">Mejora</option>
                        </select>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span>Descripción de la acción</label>
                        <textarea name="describa_accion" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span>Estado Acción</label>
                        <select class="form-control" name="estado_accion" required>
                            <option value="" selected>-- Seleccionar --</option>
                            <option value="Abierta">Abierta</option>
                            <option value="Cerrada">Cerrada</option>
                        </select>
                    </div>

                    <div class="form-group text-left">
                        <label class="control-label"><span style="color:#ff0000;">*</span> Fecha Cierre</label>
                        <input type="date" name="fecha_cierre_accion" class="form-control" required>
                    </div>

                    <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                            <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success">
                            <input type="hidden" name="guardar_seguridad_salud_trabajo" value="guardar">
                            <span class="glyphicon glyphicon-ok"></span> Crear </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<!-- Tabla -->
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">

                <div class="col-md-4">
                    <h6 class="box-title">
                        <!-- <php if (0 < $nump125 or 0 < $nump127 or 1 == $_SESSION['rol']) { ?> -->
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#nuevoSST"><span class="glyphicon glyphicon-plus-sign"></span>
                            Nuevo
                        </button>&nbsp;&nbsp;&nbsp;
                        <!-- <php } ?> -->
                    </h6>
                </div>

                <div class="col-md-4">
                    <h8 class="box-title">
                        <b>REPORTE DE ACTOS Y CONDICIONES INSEGURAS</b>
                    </h8>
                </div>

                <div class="box-tools pull-right">
                    <!-- <php if (1 == $_SESSION['rol'] or (isset($nump129) && 0 < $nump129)) { ?>
              <a href="control_proceso_nueva_notificacion.jsp" class="btn btn-success btn-sm" target="_blank"><span class="glyphicon glyphicon-plus-sign"></span> Notificación</a>
            <php } ?> -->
                    <!-- <a href="control_proceso_reporte.jsp" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-fw fa-table"></i> Historico</a>
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button> -->
                </div> <!-- FINAL box-tools pull-right -->
            </div> <!-- FINAL box-header with-border -->

            <!-- <div class="row">
          <div class="box-tools pull-right" style="margin-right:10px;">
            <form class="navbar-form" name="fotertrm3252345rter1erteg" method="POST">
              <div class="input-group">
                <div style="padding-right: 20px;">
                  <span class="help-block">Buscar expedientes trasladados a otras areas</span>
                </div>
                <div class="input-group-btn">
                  <input type="text" name="buscar" placeholder="Buscar... 000001" class="form-control" required>
                </div>
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-danger" title="Buscar Expediente"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                  <a href="https://sisg.supernotariado.gov.co/control_proceso.jsp" class="btn btn-default" title="Refrescar Consulta"><i class="fa fa-fw fa-refresh"></i></a><br>
                </div>
              </div>
            </form>
          </div>
        </div> -->

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="seguridadSaludTrabajo" cellspacing="0" width="100%">

                        <thead>
                            <tr align="center" valign="middle">
                                <th>Fecha</th>
                                <th>Orip</th>
                                <th>Dependecia</th>
                                <th>Tipo de Novedad</th>
                                <th>Categoria / Condicion / Acto Inseguro</th>

                                <th>Descripción Detallada</th>
                                <th>genero tipo incidente</th>
                                <th>Datos quien reporta</th>
                                <th>Nombre quien reporta</th>
                                <th>Fecha verificación</th>

                                <th>Tipo de acción</th>
                                <th>Descripción acción</th>
                                <th>Estado acción</th>
                                <th>Fecha Cierre</th>
                                <th style="width:100px;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                                $infobus = "consecutivo_numero_cd  like '" . $_POST['buscar'] . "%' and ";
                                $infop = $infobus;
                            } else {
                                $infop = '';
                            }
                            $query4 = "SELECT * FROM seguridad_salud_trabajo WHERE 
                            estado_seguridad_salud_trabajo=1";
                            $result = $mysqli->query($query4);
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                                <tr>
                                    <?php
                                    echo '<td>' . $row['fecha_creacion'] . '</td>';
                                    echo '<td>';
                                    echo quees('oficina_registro', $row['id_orip_fk_oficina_registro']);
                                    echo '</td>';
                                    echo '<td>' . $row['dependencia'] . '</td>';
                                    echo '<td>' . $row['tipo_de_novedad'] . '</td>';
                                    echo '<td>' . $row['categoria_condicion_acto_inseguro_detectado'] . '</td>';

                                    echo '<td>' . $row['descripcion_detallada'] . '</td>';
                                    echo '<td>' . $row['condicion_acto_genera_indicidente'] . '</td>';
                                    echo '<td>';
                                    echo quees('cargo', $row['quien_datos_quien_reporta']);
                                    echo '</td>';
                                    echo '<td>' . $row['quien_nombre'] . '</td>';
                                    echo '<td>' . $row['fecha_verificacion'] . '</td>';

                                    echo '<td>' . $row['tipo_de_accion'] . '</td>';
                                    echo '<td>' . $row['describa_accion'] . '</td>';
                                    echo '<td>' . $row['estado_accion'] . '</td>';
                                    echo '<td>' . $row['fecha_cierre_accion'] . '</td>';
                                    echo '<td style="width: 85px;">'; ?>
                                    <!-- <a class="btn btn-warning btn-xs" href="control_proceso_detalle&<php echo $row['id_cd']; ?>.jsp" target="_blank" title="Ver Detalle Expediente">
                                        <span class="fa fa-edit"></span>
                                    </a> -->
                                    <?php echo '</td>';
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>


                    <script>
                        $(document).ready(function() {
                            $('#seguridadSaludTrabajo').DataTable({
                                order: [
                                    [0, 'desc']
                                ],
                                dom: 'Bfrtip',
                                buttons: [
                                    'csv', 'excel'
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
    </div>
</div>
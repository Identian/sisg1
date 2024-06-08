<?php
$nump140 = privilegios(140, $_SESSION['snr']); // Admin Orips Requisito
$idFuncionario = $_SESSION['snr']; // id funcionario
$getIdOficinaRegistro = $_GET['i']; // get id oficina registro
$privilegios = 0 < privreg($getIdOficinaRegistro, $idFuncionario, 8, 13); // privilegios enviar requerimientos

// FECHA ACTUAL
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$anoActual = date("Y");


// INSERTAR
if (
    isset($_POST["nuevorequisito"]) && '' != $_POST["nuevorequisito"] &&
    isset($_POST["id_orips_tipo_requisito"]) && '' != $_POST["id_orips_tipo_requisito"] &&
    isset($_POST["descripcion"]) && '' != $_POST["descripcion"]
) {
    echo $insertSQL = sprintf(
        "INSERT INTO orips_requisito (
      id_orips_tipo_requisito, 
      id_oficina_registro,
      id_funcionario_creado,
      descripcion,
      fecha_registro) VALUES (%s,%s,%s,%s,%s)",
        GetSQLValueString($_POST["id_orips_tipo_requisito"], "text"),
        GetSQLValueString($getIdOficinaRegistro, "int"),
        GetSQLValueString($idFuncionario, "int"),
        GetSQLValueString($_POST["descripcion"], "text"),
        GetSQLValueString($fechaActual, "date")
    );
    $Result = mysql_query($insertSQL, $conexion);
    mysql_free_result($Result);
    echo $insertado;
    echo '<meta http-equiv="refresh" content="0;URL=./orip&' . $getIdOficinaRegistro . '.jsp" />';
}

// UPDATE
if (
    isset($_POST["actualizarequisito"]) && '' != $_POST["actualizarequisito"] &&
    isset($_POST["id_orips_tipo_requisito"]) && '' != $_POST["id_orips_tipo_requisito"] &&
    isset($_POST["descripcion"]) && '' != $_POST["descripcion"]
) {
    $UpdateSQL = sprintf(
        "UPDATE orips_requisito SET
        id_orips_tipo_requisito=%s,
        descripcion=%s
        WHERE id_orips_requisito=%s",
        GetSQLValueString($_POST["id_orips_tipo_requisito"], "int"),
        GetSQLValueString($_POST["descripcion"], "text"),
        GetSQLValueString($_POST["id_orips_requisito"], "int")
    );
    $Result = mysql_query($UpdateSQL, $conexion);
    mysql_free_result($Result);
    echo $actualizado;
    echo '<meta http-equiv="refresh" content="0;URL=./orip&' . $getIdOficinaRegistro . '.jsp" />';
}

// INSERTAR CHAT
if (
    isset($_POST["enviomensajes"]) && '' != $_POST["enviomensajes"] &&
    isset($_POST["id_orips_requisito"]) && '' != $_POST["id_orips_requisito"] &&
    isset($_POST["nombre_orips_requisito_historial"]) && '' != $_POST["nombre_orips_requisito_historial"]
) {
    echo $insertSQL = sprintf(
        "INSERT INTO orips_requisito_historial (
        nombre_orips_requisito_historial, 
        id_orips_requisito,
        id_funcionario,
        fecha_registro) VALUES (%s,%s,%s,%s)",
        GetSQLValueString($_POST["nombre_orips_requisito_historial"], "text"),
        GetSQLValueString($_POST["id_orips_requisito"], "int"),
        GetSQLValueString($idFuncionario, "int"),
        GetSQLValueString($fechaActual, "date")
    );
    $Result = mysql_query($insertSQL, $conexion);
    mysql_free_result($Result);
    echo $insertado;
    echo '<meta http-equiv="refresh" content="0;URL=./orip&' . $getIdOficinaRegistro . '.jsp" />';
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php if (0 < $nump140 || 1 == $_SESSION['rol'] || 0 < $privilegios) { ?>
                    <div style="margin: 10px; width:100px; display:inline;">
                        <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalnuevorequisito" title="Hoja de Vida"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo</button>
                    </div>
                    <div style="text-align:center;">
                        <b>Requerimientos</b>
                    </div>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="requerimientosOrip" cellspacing="0" width="100%">
                        <thead>
                            <tr align="center" valign="middle">
                                <th>Id</th>
                                <th>Tipo</th>
                                <th>Descripcion</th>
                                <th>Funcionario Solicitante</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (1 == $_SESSION['rol'] || 0 < $nump140) {
                                $query = "SELECT * FROM orips_requisito WHERE estado_orips_requisito=1";
                            } else if (0 < $privilegios) {
                                $query = "SELECT * FROM orips_requisito WHERE id_oficina_registro=$getIdOficinaRegistro AND estado_orips_requisito=1";
                            } else {
                                $query = "SELECT * FROM orips_requisito WHERE id_oficina_registro=0 AND estado_orips_requisito=1";
                            }
                            $result = $mysqli->query($query);
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                if ($row) {
                            ?>
                                    <tr>
                                        <td><?php echo isset($row['id_orips_requisito']) ? $row['id_orips_requisito'] : ''; ?></td>
                                        <td><?php echo isset($row['id_orips_tipo_requisito']) ? quees('orips_tipo_requisito', $row['id_orips_tipo_requisito']) : ''; ?></td>
                                        <td><?php echo isset($row['descripcion']) ? $row['descripcion'] : ''; ?></td>
                                        <td><?php echo isset($row['id_funcionario_creado']) ? quees('funcionario', $row['id_funcionario_creado']) : ''; ?></td>
                                        <td>
                                            <a style="cursor:pointer;" class="oripsdetallerequisitos btn btn-warning btn-xs" data-toggle="modal" data-target="#modaloripsdetallerequisitos" id="actualizar-<?php echo $row['id_orips_requisito']; ?>">
                                                <i class="fa fa-fw fa-pencil" title="Actualizar Información"></i>
                                            </a>
                                            <a style="cursor:pointer;" class="oripsdetallerequisitos btn btn-info btn-xs" data-toggle="modal" data-target="#modaloripsdetallerequisitos" id="chat-<?php echo $row['id_orips_requisito']; ?>">
                                                <i class="fa fa-fw fa-history" title="Historial de mensajes"></i>
                                            </a>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function() {
                            $('#requerimientosOrip').DataTable({
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

<!-- MODAL NUEVO -->
<div class="modal fade" id="modalnuevorequisito" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b>Nuevo</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" name="forminmueble123">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Tipo</label>
                            <select class="form-control" name="id_orips_tipo_requisito" id="">
                                <?php lista('orips_tipo_requisito', ''); ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Descripcion</label>
                            <textarea class="form-control" name="descripcion" cols="30" rows="10" maxlength="500"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()"> Cancelar</button>
                        <input type="submit" name="nuevorequisito" class="btn btn-success btn-xs" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL ACTUALIZA Y CHAT -->
<div class="modal fade" id="modaloripsdetallerequisitos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="myModalLabel"><label class="control-label">Requimientos</label></h4>
            </div>
            <div class="modal-body">
                <div id="divdetallerequisitos"></div>
            </div>
        </div>
    </div>
</div>
<?php 
$nump129 = privilegios(129, $_SESSION['snr']); // SID ADMIN Noficador encargado de crear plantillas de notificacion

if (1 == $_SESSION['rol'] or 0 < $nump129) {

    // VARIABLES GLOBALES
    $GlobalIdFuncionario = $_SESSION['snr'];

    // Fecha Actual
    date_default_timezone_set("America/Bogota");
    $fechaActual = date("Y-m-d H:i:s");


    // Funcion para la auditoria global
    function auditoria($idControlDisciplinario, $tabla, $idTabla, $accion, $GlobalIdFuncionario, $fechaActual, $conexion)
    {
        $AuditoriaSQL = sprintf(
            "INSERT INTO cd_auditoria (
                id_cd_fk_cd_auditoria,
                tabla_cd_auditoria,
                id_tabla_cd_auditoria,
                accion_cd_auditoria,
                id_funcionario_fk_cd_auditoria,
                fecha_creado_cd_auditoria) VALUES (%s,%s,%s,%s,%s,%s)",
            GetSQLValueString($idControlDisciplinario, "text"),
            GetSQLValueString($tabla, "text"),
            GetSQLValueString($idTabla, "int"),
            GetSQLValueString($accion, "text"),
            GetSQLValueString($GlobalIdFuncionario, "int"),
            GetSQLValueString($fechaActual, "date")
        );
        mysql_query($AuditoriaSQL, $conexion) or die(mysql_error());
    }


    // INSERTAR NUEVA NOTIFICACION
    if (
        isset($_POST["crear_cd_notificacion"]) && $_POST["crear_cd_notificacion"] != "" &&
        isset($_POST["nombre_cd_notificacion"]) && $_POST["nombre_cd_notificacion"] != "" &&
        isset($_POST["asunto_cd_notificacion"]) && $_POST["asunto_cd_notificacion"] != "" &&
        isset($_POST["cuerpo_cd_notificacion"]) && $_POST["cuerpo_cd_notificacion"] != ""
    ) {
        $insertSQL = sprintf(
            "INSERT INTO cd_notificacion (
            nombre_cd_notificacion,
            logo_cabecera_cd_notificacion,
            asunto_cd_notificacion,
            cuerpo_cd_notificacion,
            fecha_creado_cd_notificacion
            )VALUES (%s,%s,%s,%s,%s)",
            GetSQLValueString($_POST["nombre_cd_notificacion"], "text"),
            GetSQLValueString('<p><img alt="logo supernotarioado" src="https://sisg.supernotariado.gov.co/images/cabezotesnr-2023.jpg" style="height:53px; width:100%" /></p>', "text"),
            GetSQLValueString($_POST["asunto_cd_notificacion"], "text"),
            GetSQLValueString($_POST["cuerpo_cd_notificacion"], "text"),
            GetSQLValueString($fechaActual, "date")
        );
        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
        $idInsert = mysql_insert_id($conexion);
        auditoria(NULL, 'cd_notificacion', $idInsert, $insertSQL, $GlobalIdFuncionario, $fechaActual, $conexion);
        echo $actualizado;
    }

    // EDITAR NOTIFICACION
    if (
        isset($_POST["editar_cd_notificacion"]) && $_POST["editar_cd_notificacion"] != "" &&
        isset($_POST["nombre_cd_notificacion"]) && $_POST["nombre_cd_notificacion"] != "" &&
        isset($_POST["asunto_cd_notificacion"]) && $_POST["asunto_cd_notificacion"] != "" &&
        isset($_POST["cuerpo_cd_notificacion"]) && $_POST["cuerpo_cd_notificacion"] != ""
    ) {
        $uno = $_POST["nombre_cd_notificacion"];
        $dos = $_POST["asunto_cd_notificacion"];
        $tre = $_POST["cuerpo_cd_notificacion"];
        $cua = $_POST["id_cd_notificacion"];
        $updateQuery = "UPDATE cd_notificacion SET 
        nombre_cd_notificacion = '$uno',
        asunto_cd_notificacion = '$dos',
        cuerpo_cd_notificacion = '$tre'
        WHERE id_cd_notificacion = $cua";
        auditoria(NULL, 'cd_notificacion', $cua, $updateQuery, $GlobalIdFuncionario, $fechaActual, $conexion);
        if ($mysqli->query($updateQuery) === TRUE) {
            echo $actualizado;
        } else {
            echo "Error: " . $updateQuery . "<br>" . $mysqli->error;
        }
    }
?>

    <script src="../plugins/ckeditor40/ckeditor.js"></script>

    <!-- NOTIFICACIONES CREADAS PARA EDITAR -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <b>Notificaciones o Comunicaciones</b>
            <span class="pull-letf badge bg-red">
                <?php
                $query20 = sprintf("SELECT count(id_cd_notificacion) AS contador FROM cd_notificacion WHERE estado_cd_notificacion=1");
                $select20 = mysql_query($query20, $conexion) or die(mysql_error());
                $row20 = mysql_fetch_assoc($select20);
                echo $row20['contador'];
                ?>
            </span>
            <div style="float: right;">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalCrearNotificacion" title="Nuevo">
                    <i class="fa fa-plus"></i>
                </button>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tablenotificacion" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Asunto</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $Query21 = "SELECT * FROM cd_notificacion WHERE estado_cd_notificacion=1 ORDER BY fecha_creado_cd_notificacion DESC";
                        $Resultado21 = $mysqli->query($Query21);
                        while ($row21 = $Resultado21->fetch_array(MYSQLI_ASSOC)) {

                            if (isset($row21['id_cd_notificacion'])) { ?>
                                <tr>
                                    <td>
                                        <b style="color:#dd4b39;"><i class="fa fa-fw fa-clock-o"></i>
                                            <?php echo isset($row21['fecha_creado_cd_notificacion']) ? $row21['fecha_creado_cd_notificacion'] : '' ?>
                                        </b>
                                    </td>
                                    <td>
                                        <?php echo $row21['id_cd_notificacion']; ?>
                                    </td>
                                    <td>
                                        <?php echo isset($row21['nombre_cd_notificacion']) ? $row21['nombre_cd_notificacion'] : '' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($row21['asunto_cd_notificacion']) ? $row21['asunto_cd_notificacion'] : '' ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (1 == $row21['estado_cd_notificacion']) {
                                            echo 'Activo';
                                        } else {
                                            echo 'Inactivo';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-xs sidcrearnotificacion" id="<?php echo $row21['id_cd_notificacion']; ?>" data-toggle="modal" data-target="#modalEditarNotificacion">
                                            <span class="fa fa-fw fa-pencil"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        $('#tablenotificacion').DataTable({
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

    <!-- MODAL CREAR UNA NOTIFICAIONES -->
    <div class="modal fade" id="modalCrearNotificacion" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <b>Crear Notificación</b>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" name="form72371389343yb">

                        <div class="form-group text-left">
                            <label><b>Tipo Notificación / Comunicación</b></label>
                            <input type="text" name="nombre_cd_notificacion" class="form-control">
                        </div>
                        <div class="form-group text-left">
                            <label><b>Asunto</b></label>
                            <input class="form-control" type="text" name="asunto_cd_notificacion">
                        </div>
                        <div class="form-group text-left">
                            <label><b>Contenido de la comunicación</b></label>
                            <textarea class="form-control" name="cuerpo_cd_notificacion" id="sidcrearnotificacion" cols="10" rows="10"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-success btn-xs" value="Guardar" name="crear_cd_notificacion">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR UNA NOTIFICAION -->
    <div class="modal fade" id="modalEditarNotificacion" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <b>Editar Notificación</b>
                </div>
                <div class="modal-body">
                    <div id="divsidcrearnotificacion"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            CKEDITOR.replace('sidcrearnotificacion');
        })
    </script>

<?php } ?>
<?php
if (isset($_GET["i"]) && 1 == $_SESSION['rol']) {
    $id = $_GET['i'];
} elseif (isset($_GET["i"]) && 0 < $_SESSION['snr']) {
    // SOLO CURADOR PUEDE EDITAR PRIVILEGIOS DE SU CURADURIA.
    $idFuncionario = $_SESSION['snr'];
    $query3 = sprintf("SELECT id_funcionario, id_curaduria FROM situacion_curaduria WHERE id_funcionario=$idFuncionario AND estado_situacion_curaduria=1 ORDER BY id_situacion_curaduria DESC LIMIT 1");
    $select3 = mysql_query($query3, $conexion) or die(mysql_error());
    $row3 = mysql_fetch_assoc($select3);
    $id = $row3['id_curaduria'];
}

if (0 < $id && $_GET["i"] == $id) {

    if ((isset($_POST["id_modulo_curaduria"])) && ("" != $_POST["id_modulo_curaduria"])) {

        $idfun = intval($_POST["id_funcionario"]);
        $idmod = intval($_POST["id_modulo_curaduria"]);

        $querynb = sprintf("SELECT count(id_privilegio_curaduria) as rep FROM privilegio_curaduria where id_curaduria=" . $id . " and id_modulo_curaduria=" . $idmod . " and id_funcionario=" . $idfun . " and estado_privilegio_curaduria=1");
        $selectnb = mysql_query($querynb, $conexion) or die(mysql_error());
        $rownb = mysql_fetch_assoc($selectnb);
        if (0 < $rownb['rep']) {
            echo $repetido;
        } else {


            $insertSQL = sprintf(
                "INSERT INTO privilegio_curaduria (id_funcionario, id_modulo_curaduria, id_curaduria, fecha_privilegio, estado_privilegio_curaduria) VALUES (%s, %s, %s, now(), %s)",
                GetSQLValueString($idfun, "int"),
                GetSQLValueString($idmod, "int"),
                GetSQLValueString($id, "int"),
                GetSQLValueString(1, "int")
            );
            $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
            echo $insertado;
        }
    }



?>

    <div class="row">
        <div class="col-md-9">
            <div class="box" style="min-height:500px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Acceso a módulos de la <?php echo quees('curaduria', $id); ?></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>

                </div>
                <div class="box-body">
                    <hr>
                    <form action="" method="POST" name="formguardarpriviligioscuradurias">
                        <div class="row">

                            <div class="col-md-3">
                                Acceso a módulos de Curaduria:
                            </div>


                            <div class="col-md-3">
                                <select class="form-control" style="width:100%;" name="id_modulo_curaduria" required>
                                    <option value="" selected> - - Módulo - - </option>
                                    <?php
                                    $queryn = sprintf("SELECT * FROM modulo_curaduria where id_modulo_curaduria!=8 and estado_modulo_curaduria=1");
                                    $selectn = mysql_query($queryn, $conexion) or die(mysql_error());
                                    $rown = mysql_fetch_assoc($selectn);
                                    $totalrown = mysql_num_rows($selectn);
                                    if (0 < $totalrown) {
                                        do {
                                            echo '<option value="' . $rown['id_modulo_curaduria'] . '">' . $rown['nombre_modulo_curaduria'] . '</option>';
                                        } while ($rown = mysql_fetch_assoc($selectn));
                                    } else {
                                        echo '';
                                    }
                                    mysql_free_result($selectn);
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select class="form-control" style="width:100%;" name="id_funcionario" required>
                                    <option value="" selected> seleccionar </option>
                                    <?php
                                    // $queryn = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_cargo!=1 and id_curaduria_f=" . $id . " and id_tipo_oficina=3 and estado_funcionario=1");
                                    $queryn = sprintf("SELECT funcionario.id_funcionario, funcionario.nombre_funcionario FROM relacion_curaduria, funcionario 
                                    WHERE relacion_curaduria.id_funcionario=funcionario.id_funcionario
                                    AND relacion_curaduria.id_curaduria=" . $id . " AND estado_relacion_curaduria=1");
                                    $selectn = mysql_query($queryn, $conexion) or die(mysql_error());
                                    $rown = mysql_fetch_assoc($selectn);
                                    $totalrown = mysql_num_rows($selectn);
                                    if (0 < $totalrown) {
                                        do {
                                            echo '<option value="' . $rown['id_funcionario'] . '">' . $rown['nombre_funcionario'] . '</option>';
                                        } while ($rown = mysql_fetch_assoc($selectn));
                                    } else {
                                        echo '<option value="">No tiene personal relacionado</option>';
                                    }
                                    mysql_free_result($selectn);
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success">
                                    Dar acceso</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <?php
                    $query = sprintf("SELECT * FROM privilegio_curaduria, funcionario, modulo_curaduria where privilegio_curaduria.id_funcionario=funcionario.id_funcionario and privilegio_curaduria.id_modulo_curaduria=modulo_curaduria.id_modulo_curaduria and id_curaduria=" . $id . " and estado_privilegio_curaduria=1");
                    $select = mysql_query($query, $conexion) or die(mysql_error());
                    $row = mysql_fetch_assoc($select);
                    $totalrow = mysql_num_rows($select);
                    // echo $totalrow . ' registros.<br />';
                    if (0 < $totalrow) {
                    ?>
                        <table id="lista" class="table">
                            <thead>
                                <tr align='center' valign='middle'>
                                    <th>FUNCIONARIO</th>
                                    <th>IDENTIFICACIÓN</th>
                                    <th>MODULO DE CURADURIA</th>
                                    <th>FECHA DE CREACIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            do {
                                echo '<tr>';
                                echo '<td>' . $row['nombre_funcionario'] . '</td>';
                                echo '<td>' . $row['cedula_funcionario'] . '</td>';
                                echo '<td>' . $row['nombre_modulo_curaduria'] . '</td>';
                                echo '<td>' . $row['fecha_privilegio'] . '</td>';
                                echo '<td><a style="color:#ff0000;cursor: pointer" name="privilegio_curaduria" id="' . $row['id_privilegio_curaduria'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';
                            } while ($row = mysql_fetch_assoc($select));
                            mysql_free_result($select);
                            echo '</tbody></table>';
                        } else {
                        }
                            ?>
                </div>
            </div>
        </div>



        <div class="col-md-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Usuarios de la Curaduria</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>

                </div>
                <div class="box-body">
                    <?php
                    $query1 = sprintf("SELECT id_funcionario FROM situacion_curaduria WHERE id_curaduria=$id AND estado_situacion_curaduria=1 ORDER BY id_situacion_curaduria DESC LIMIT 1");
                    $select1 = mysql_query($query1, $conexion) or die(mysql_error());
                    $row1 = mysql_fetch_assoc($select1);
                    $curador = $row1['id_funcionario']; ?>
                    <ul>
                        <?php if (isset($curador)) {
                            echo '<li>';
                            if (1 == $_SESSION['rol']) {
                                echo '<a href="https://sisg.supernotariado.gov.co/usuario&' . $row1['id_funcionario'] . '.jsp"><i class="fa fa-user"></i></a> ';
                            } else {
                            }
                            echo quees('funcionario', $curador) . ' <b>(CURADOR)</b></li>';
                        }

                        $queryn = sprintf("SELECT funcionario.id_funcionario, funcionario.nombre_funcionario, funcionario.id_cargo FROM relacion_curaduria, funcionario 
                        WHERE relacion_curaduria.id_funcionario=funcionario.id_funcionario
                        AND relacion_curaduria.id_curaduria=" . $id . " AND estado_relacion_curaduria=1");
                        $selectn = mysql_query($queryn, $conexion) or die(mysql_error());
                        $rown = mysql_fetch_assoc($selectn);
                        $totalrown = mysql_num_rows($selectn);
                        if (0 < $totalrown) {
                            do {
                                echo '<li>';
                                if (1 == $_SESSION['rol']) {
                                    echo '<a href="https://sisg.supernotariado.gov.co/usuario&' . $rown['id_funcionario'] . '.jsp"><i class="fa fa-user"></i></a> ';
                                } else {
                                }
                                echo $rown['nombre_funcionario'] . '';
                                echo '</li>';
                            } while ($rown = mysql_fetch_assoc($selectn)); ?>

                        <?php } else {
                            echo 'No tiene asesores registrados';
                        }
                        mysql_free_result($selectn);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


<?php } else {
    echo 'No tiene acceso';
} ?>
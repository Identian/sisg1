<?php
session_start();
if (isset($_POST['option'])) {
    require_once('../conf.php');
    require_once('listas.php');
    $option = explode('-', $_POST['option']);
    $id                  = intval($option[0]);
    $GlobalTipoDeOficina = intval($option[1]);

    $query26 = "SELECT * FROM cd_migracion_sid WHERE id_cdms=$id";
    $result26 = $mysqli->query($query26);
    $row26 = $result26->fetch_array(MYSQLI_ASSOC);
} ?>


<style>
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
        overflow-y: scroll;
        height: 200px;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
</style>
<div class="form-group text-left">
    <label>Entidades</label><br>
    <?php $Query9 = "SELECT id_cd_migracion_entidad ,nombre_cd_migracion_entidad FROM cd_migracion_entidad 
                     WHERE id_cdms_fk_cd_migracion_sid=$id AND estado_cd_migracion_entidad=1";
    $result9 = $mysqli->query($Query9);
    while ($row9 = $result9->fetch_array(MYSQLI_ASSOC)) { ?>
        <form action="" method="post" name="quitarentidadexpediente213">
            <input type="hidden" name="id_cdms" value="<?php echo $row9['id_cd_migracion_entidad']; ?>">
            <?php echo $row9['nombre_cd_migracion_entidad']; ?>
            <input type="hidden" name="borrar_entidad_migracion" value="borrar_entidad_migracion">
            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Borrar entidad del expediente"></i></button>
        </form>
    <?php } ?>
    <br>
    <?php
    if ($GlobalTipoDeOficina == 1) {
        $Querytipo = "SELECT id_grupo_area AS id_area, nombre_grupo_area AS nombre_area
                        FROM (
                            SELECT id_grupo_area, nombre_grupo_area
                            FROM grupo_area WHERE id_area IS NOT NULL AND estado_grupo_area=1
                            UNION
                            SELECT id_oficina_registro, nombre_oficina_registro
                            FROM oficina_registro WHERE estado_oficina_registro=1
                        ) AS resultados_combinados
                        ORDER BY nombre_area ASC";
    } elseif ($GlobalTipoDeOficina == 2) {
        $Querytipo = "SELECT * FROM oficina_registro where estado_oficina_registro=1 ORDER BY nombre_oficina_registro ASC";
    } elseif ($GlobalTipoDeOficina == 3) {
        $Querytipo = "SELECT * FROM notaria where estado_notaria=1 ORDER BY nombre_notaria ASC";
    } elseif ($GlobalTipoDeOficina == 4) {
        $Querytipo = "SELECT * FROM curaduria where estado_curaduria=1 ORDER BY nombre_curaduria ASC";
    }
    ?>
    <form action="" method="post" name="agregarentidadexpediente213">
        <div class="input-group input-group-sm">
            <input type="hidden" name="id_cdms" value="<?php echo $id; ?>">
            <select class="form-control" name="nombre_cd_migracion_entidad" required>
                <option value="">--- Selección ---</option>
                <option value="POR DETERMINAR">POR DETERMINAR</option>
                <?php echo $Query18 = "$Querytipo";
                $Resul18 = $mysqli->query($Query18);
                while ($row18 = $Resul18->fetch_array(MYSQLI_ASSOC)) {
                    if ($GlobalTipoDeOficina == 1 and isset($row18['id_area'])) {
                        echo '<option value="' . $row18['nombre_area'] . '">' . $row18['nombre_area'] . '</option>';
                    } elseif ($GlobalTipoDeOficina == 2 and isset($row18['id_oficina_registro'])) {
                        echo '<option value="' . $row18['nombre_oficina_registro'] . '">' . $row18['nombre_oficina_registro'] . '</option>';
                    } elseif ($GlobalTipoDeOficina == 3 and isset($row18['id_notaria'])) {
                        echo '<option value="' . $row18['nombre_notaria'] . '">' . $row18['nombre_notaria'] . '</option>';
                    } elseif ($GlobalTipoDeOficina == 4 and isset($row18['id_curaduria'])) {
                        echo '<option value="' . $row18['nombre_curaduria'] . '">' . $row18['nombre_curaduria'] . '</option>';
                    }
                }
                $Resul18->free();
                ?>
            </select>
            <input type="hidden" name="guardar_entidad_migracion" value="guardar_entidad_migracion">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-success btn-flat">+</button>
            </span>
        </div>
    </form>
</div>


<div class="form-group text-left">
    <label>Implicados</label><br>
    <?php
    $Query9 = "SELECT id_cd_migracion_implicados ,nombre_cd_migracion_implicados FROM cd_migracion_implicados 
                WHERE id_cdms_fk_cd_migracion_sid=$id AND estado_cd_migracion_implicados=1";
    $result9 = $mysqli->query($Query9);
    while ($row9 = $result9->fetch_array(MYSQLI_ASSOC)) { ?>
        <form action="" method="post" name="quitarimplicadosexpediente213">
            <input type="hidden" name="id_cdms" value="<?php echo $row9['id_cd_migracion_implicados']; ?>">
            <?php echo $row9['nombre_cd_migracion_implicados']; ?>
            <input type="hidden" name="borrar_implicado_migracion" value="borrar_implicado_migracion">
            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Borrar implicado del Expediente"></i></button>
        </form>
    <?php }
    ?>
    <br>
    <form action="" method="post" name="agregarimplicadosexpediente213">
        <div class="input-group input-group-sm">
            <input type="hidden" name="id_cdms" value="<?php echo $id; ?>">
            <div class="autocomplete" style="width:100%;">
                <input id="myInput" type="text" name="nombre_cd_migracion_implicados" placeholder="Buscar Implicados solo por nombre" style="text-transform:uppercase; height: 30px; padding: 5px 10px;  font-size: 12px;  line-height: 1.5;  width:100%" required>
            </div>
            <input type="hidden" name="guardar_implicado_migracion" value="guardar_implicado_migracion">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-success btn-flat">+</button>
            </span>
        </div>
    </form>
</div>

<form action="" method="POST" name="Formhdash3434">
    <div class="modal-body">
        <input type="hidden" name="id_cdms" value="<?php echo $id; ?>">
        <div class="form-group text-left">
            <label>N Radicación</label>
            <span class="form-control" readonly><?php echo $row26['proc_nro_radicacion_cdmso']; ?></span>
        </div>

        <?php if (1 == $_SESSION['rol'] or 0 < $nump143) { ?>
            <div class="form-group text-left">
                <label>Creado por</label>
                <select name="nomenclatura_cdmso" class="form-control" require>
                    <option value="nomenclatura_cdmso" selected><?php echo $row26['nomenclatura_cdmso']; ?></option>
                    <option value="">--- Selección ---</option>
                    <option value="OCDI">OCDI - Oficina de Control Disciplinario Interno</option>
                    <option value="SDR">SDR - Superintendencia Delegada Para El Registro</option>
                    <option value="SDN">SDN - Superintendencia Delegada Para El Notariado</option>
                    <option value="SDC">SDC - Grupo para el control y vigilancia de Curadores Urbanos</option>
                    <option value="OAJ">OAJ - Oficina Asesora Juridica</option>
                    <option value="DDS">DDS - Despacho Del Superintendente</option>
                </select>
            </div>
        <?php } else { ?>
            <div class="form-group text-left">
                <label>Creado por</label>
                <span class="form-control" readonly><?php echo $row26['nomenclatura_cdmso']; ?></span>
                <input type="hidden" name="nomenclatura_cdmso" value="<?php echo $row26['nomenclatura_cdmso']; ?>">
            </div>
        <?php } ?>

        <div class="form-group text-left">
            <label>Origen</label>
            <select class="form-control" name="proc_origen_cdmso">
                <?php
                if ('O' == $row26['proc_origen_cdmso']) {
                    echo '<option value="' . $row26['proc_origen_cdmso'] . '" selected>De Oficio</option>';
                } elseif ('C' == $row26['proc_origen_cdmso']) {
                    echo '<option value="' . $row26['proc_origen_cdmso'] . '" selected>Ciudadano</option>';
                } elseif ('A' == $row26['proc_origen_cdmso']) {
                    echo '<option value="' . $row26['proc_origen_cdmso'] . '" selected>Falta identificar</option>';
                } elseif ('IO' == $row26['proc_origen_cdmso']) {
                    echo '<option value="' . $row26['proc_origen_cdmso'] . '" selected>Informe oficial</option>';
                }
                ?>
                <option value="">--- Selección ---</option>
                <option value="O">De Oficio</option>
                <option value="C">Ciudadano</option>
                <option value="A">Falta identificar</option>
                <option value="IO">Informe oficial</option>
            </select>
        </div>

        <div class="form-group text-left">
            <label class="control-label">Tipologia:</label>
            <select class="form-control" name="nombre_cd_tipo">
                <?php if (isset($row26['nombre_cd_tipo'])) { ?>
                    <option value="<?php echo $row26['nombre_cd_tipo']; ?>" selected><?php echo $row26['nombre_cd_tipo']; ?></option>
                <?php } ?>
                <option value=""></option>
                <?php $query29 = "SELECT * FROM cd_tipo WHERE id_tipo_oficina_fk_tipo_oficina=$GlobalTipoDeOficina AND estado_cd_tipo=1";
                $result29 = $mysqli->query($query29);
                while ($row29 = $result29->fetch_array(MYSQLI_ASSOC)) { ?>
                    <option value="<?php echo $row29['nombre_cd_tipo']; ?>"><?php echo $row29['nombre_cd_tipo']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group text-left">
            <label>Etapa</label>
            <select class="form-control" name="etapa_cdmso">
                
                <?php if (isset($row26['etapa_cdmso']) and '' <> $row26['etapa_cdmso'] and NULL <> $row26['etapa_cdmso']) { ?>
                    <option value="<?php echo $row26['etapa_cdmso']; ?>" selected><?php echo quees('cd_migracion_etapa', $row26['etapa_cdmso']); ?></option>
                <?php }
                echo '<option value="">--- Selección ---</option>';
                ?>
                <?php $Query25 = "SELECT *  FROM cd_migracion_etapa WHERE estado_cd_migracion_etapa=1 ORDER BY nombre_cd_migracion_etapa ASC";
                $Resul25 = $mysqli->query($Query25);
                while ($row25 = $Resul25->fetch_array(MYSQLI_ASSOC)) {
                    if (isset($row25['id_cd_migracion_etapa'])) {
                        echo '<option value="' . $row25['id_cd_migracion_etapa'] . '">' . $row25['nombre_cd_migracion_etapa'] . '</option>';
                    }
                }
                $Resul25->free();
                ?>
            </select>
        </div>
        <div class="form-group text-left">
            <label>Estado</label>
            <select class="form-control" name="estado_expediente_cdmso">
                <option value="<?php echo $row26['estado_expediente_cdmso']; ?>" selected><?php echo $row26['estado_expediente_cdmso']; ?></option>
                <option value="">--- Selección ---</option>
                <option value="Activo">Activo</option>
                <option value="Finalizado">Finalizado</option>
            </select>
        </div>
        <div class="form-group text-left">
            <label>Observación</label>
            <textarea class="form-control" name="observacion_cdmso" id="observacionMigracionSidEditar" cols="10" rows="10"><?php echo $row26['observacion_cdmso']; ?></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Cerrar</button>
        <input type="submit" name="actualizar_expediente" value="Guardar" class="btn btn-success btn-xs">
    </div>
</form>

<script>
    $(function() {
        CKEDITOR.replace('observacionMigracionSidEditar');
    })

    // FUNCION BUSCADOR IMPLICADOS
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }

    /*An array containing all the implicados names in the world:*/
    <?php
    $query10 = "SELECT DISTINCT(nombre_cd_migracion_implicados) FROM cd_migracion_implicados WHERE estado_cd_migracion_implicados=1 ORDER BY nombre_cd_migracion_implicados ASC";
    $select10 = mysql_query($query10, $conexion);
    $row10 = mysql_fetch_assoc($select10);
    $totalRows10 = mysql_num_rows($select10);
    if (0 < $totalRows10) {
        $array = array();
        do {
            array_push($array, $row10['nombre_cd_migracion_implicados']);
        } while ($row10 = mysql_fetch_assoc($select10));
        mysql_free_result($select10);
    } else {
    }
    ?>
    var implicados = <?php echo json_encode($array); ?>

    /*initiate the autocomplete function on the "myInput" element, and pass along the implicados array as possible autocomplete values:*/
    autocomplete(document.getElementById("myInput"), implicados);
</script>
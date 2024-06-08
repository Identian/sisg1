<?php
if (isset($_POST['option'])) {
    require_once('../conf.php');
    require_once('listas.php');
    $option = explode("-", $_POST['option']);
    $id_cd_detalle_accion = $option[0];
    $id_cd_accion_fk_cd_detalle_accion = $option[1];
    $GlobalTipoDeOficina = $option[2];
    $idControlDisciplinario = $option[3];
?>

    <style>
        .divscroll200 {
            overflow-y: scroll;
            overflow-x: scroll;
            height: 200px;
        }
    </style>

    <label class="control-label">Seleccionar Modelo Notificacion:</label><br>
    <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Buscar Notificación ...">

    <section id="mySection" class="divscroll200">
        <?php $query12 = "SELECT * FROM cd_notificacion WHERE estado_cd_notificacion=1 ORDER BY nombre_cd_notificacion ASC";
        $result = $mysqli->query($query12);
        while ($row12 = $result->fetch_array(MYSQLI_ASSOC)) { ?>
            <div>
                <a style="cursor:pointer;" class="sidnotificaciondos" id="<?php echo $id_cd_detalle_accion . '-' . $id_cd_accion_fk_cd_detalle_accion . '-' . $row12['id_cd_notificacion'] . '-' . $GlobalTipoDeOficina . '-' . $idControlDisciplinario; ?>">
                    <?php echo $row12['nombre_cd_notificacion']; ?>
                </a>
            </div>
        <?php } ?>
    </section>

    <div id="divsidenvionotificacion"></div>

<?php } ?>

<script>
    $('.sidnotificaciondos').click(function() {
        var ma = this.id;
        jQuery.ajax({
            type: "POST",
            url: "pages/control_proceso_envio_notificacion.php",
            data: 'option=' + ma,
            async: true,
            success: function(b) {
                jQuery('#divsidenvionotificacion').html(b);
                $('textarea[id="textareaProcesoEnvioNot"]').each(function() {
                    if (!$(this).hasClass('cke')) { // Comprueba si no se ha inicializado ya
                        CKEDITOR.replace(this);
                    }
                });
            }
        })
    });

    // FUNCION BUSCADOR DE NOTIFICACIONES
    function myFunction() {
        var input, filter, section, div, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        section = document.getElementById("mySection");
        div = section.getElementsByTagName("div");
        for (i = 0; i < div.length; i++) {
            a = div[i].getElementsByTagName("a")[0];
            if (a) {
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    div[i].style.display = "";
                } else {
                    div[i].style.display = "none";
                }
            }
        }
    }
</script>
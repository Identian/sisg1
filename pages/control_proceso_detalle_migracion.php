<?php
if (isset($_POST['option'])) {
    session_start();
    require_once('../conf.php');
    require_once('listas.php');
    $nump124 = privilegios(124, $_SESSION['snr']); // SID Migracion
    $nump132 = privilegios(132, $_SESSION['snr']); // SID Migracion Eliminar Anexos
    $nump139 = privilegios(139, $_SESSION['snr']); // SID Migracion Cargar Anexos
    $nump143 = privilegios(143, $_SESSION['snr']); // Usuario usado por sebastian

    $option = explode('-', $_POST['option']);
    $path                   = $option[0]; // PATH
    $id                     = $option[1];
    $rowGlobalTipoDeOficina = $option[2];

    $GlobalGrupoArea = $_SESSION['snr_grupo_area'];

    // Oficina de Control Disciplinario Interno = 23
    if ($GlobalGrupoArea == 23) {
        $query = '';
        $GlobalTipoDeOficina = 1;
    }
    // Superintendencia Delegada Para El Registro = 41
    // Grupo de Inspeccion Vigilancia y Control Registral = 42
    // Grupo de Gestion Disciplinaria Registral = 313
    if ($GlobalGrupoArea == 41 || $GlobalGrupoArea == 41 || $GlobalGrupoArea == 313) {
        $query = "AND nomenclatura_cdmso = 'SDR'";
        $GlobalTipoDeOficina = 2;
    }
    // Superintendencia Delegada Para El Notariado = 44
    // Direccion de Vigilancia y Control Notarial = 45 
    if ($GlobalGrupoArea == 44 || $GlobalGrupoArea == 45) {
        $query = "AND nomenclatura_cdmso = 'SDN'";
        $GlobalTipoDeOficina = 3;
    }
    // Superintendencia Delegada para la Proteccion Restitucion y Formalizacion de Tierras = 297
    // Grupo para el control y vigilancia de Curadores Urbanos = 305
    if ($GlobalGrupoArea == 297 or $GlobalGrupoArea == 305) {
        $query = "AND nomenclatura_cdmso = 'SDC'";
        $GlobalTipoDeOficina = 4;
    }
    // Oficina Asesora Juridica = 12
    if ($GlobalGrupoArea == 12) {
        $query = "AND nomenclatura_cdmso = 'OAJ'";
        $GlobalTipoDeOficina = 5;
    }
    // Despacho Del Superintendente = 1 | Oficina Asesora Juridica = 12 para asignar a luisa
    if ($GlobalGrupoArea == 1) {
        $query = "AND nomenclatura_cdmso = 'DDS'";
        $GlobalTipoDeOficina = 6;
    }
    // Super usuario para simular Superintendencia Delegada Para El Notariado
    if (1 == $_SESSION['rol'] or 0 < $nump143) {
        $query = '';
        $GlobalTipoDeOficina = 3;
    }
} ?>

<script>
    function fileValidationSid() {
        var fileInput = document.getElementById('filemigracionsid');
        var filePath = fileInput.value;
        var allowedExtensions = /(.pdf)$/i;

        var fsize = 15000;
        var fileSize = fileInput.files[0].size;
        var siezekiloByte = parseInt(fileSize / 1024);

        if (!allowedExtensions.exec(filePath)) {
            alert('Solo se permite extension pdf');
            fileInput.value = '';
            return false;
        } else {
            if (siezekiloByte < fsize) {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').innerHTML = 'ok';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            } else {
                alert('Debe ser inferior a 15000 Kb, el archivo cargado es de ' + siezekiloByte + ' Kb');
                fileInput.value = '';
                return false;
            }
        }
    }
</script>

<?php if (('pdf' == $path) && 1 == $_SESSION['rol'] || 0 < $nump143 || 0 < $nump139) { ?>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 20px;">
            <form action="" method="POST" name="form5645615err4" enctype="multipart/form-data">
                <label>Archivo</label>
                <div class="input-group">
                    <input type="hidden" name="id_proc_cdmfs" value="<?php echo $id; ?>">
                    <input type="file" id="filemigracionsid" name="file" onchange="return fileValidationSid()" required>
                    <span style="color:#B40404;font-size:13px;">PDF inferior a 15000 Kb / </span>
                    <a href="https://smallpdf.com/es/comprimir-pdf" style="color:#B40404;" target="_blank">Comprimir</a>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-ms">
                            <span class="glyphicon glyphicon-refresh" title="Guardar File"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>

        <div class="col-md-12">
            <label>Listado Archivos</label>
            <?php $query1 = "SELECT * FROM cd_migracion_file_sid WHERE id_proc_cdmfs=$id AND estado_cd_migracion_file_sid=1";
            $result1 = $mysqli->query($query1);
            while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) {
                if (1 == $_SESSION['rol'] || 0 < $nump143 || 0 < $nump132) {
                    echo '<form action="" method="POST" name="formsdasdasdd55">
                        <a href="https://sisg.supernotariado.gov.co/filesnr/archivo/' . $row1['id_procf_cdmfs'] . '" target="_blank">' . $row1['nombre_procf_cdmfs'] . '</a>
                        <input type="hidden" name="borrar_id_procf_cdmfs" value="' . $row1['id_cdmfs'] . '">
                        <button type="submit" style="color:red; border:none; background:none;" title="Eliminar PDF"><i class="fa fa-trash-o"></i></button>';
                    echo '</form>';
                } else {
                    echo '<a href="https://sisg.supernotariado.gov.co/filesnr/archivo/' . $row1['id_procf_cdmfs'] . '" target="_blank">' . $row1['nombre_procf_cdmfs'] . '</a><br> ';
                }
            }
            $result1->free();
            ?>
        </div>
    </div>
<?php } ?>

<?php if (('video' == $path) && 1 == $_SESSION['rol'] || 0 < $nump143 || 0 < $nump139) { ?>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 20px;">
            <form action="" method="POST" name="form564561video">
                <input type="hidden" name="id_cd_migracion_sid" value="<?php echo $id; ?>" required>
                <label>Nombre del Video</label><br>
                <input type="text" class="form-control" name="nombre_cd_migracion_video" required>
                <label>Url del Video</label><br>
                <input type="text" class="form-control" name="url_cd_migracion_video" required>
                <br>
                <div class="box-tools pull-right">
                    <button type="submit" class="btn btn-success btn-xs"> Guardar </button>
                </div>
            </form>
        </div>

        <div class="col-md-12">
            <label>Listado Videos</label>
            <?php $query1 = "SELECT * FROM cd_migracion_video WHERE id_cd_migracion_sid=$id AND estado_cd_migracion_video=1";
            $result1 = $mysqli->query($query1);
            while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) {
                if (1 == $_SESSION['rol'] || 0 < $nump143 || 0 < $nump132) {
                    echo '<form action="" method="POST" name="formsdasdvideo">';
                    echo $row1['nombre_cd_migracion_video'] . ' - ' . '<a href="' . $row1['url_cd_migracion_video'] . '">' . $row1['url_cd_migracion_video'] . '</a>';
                    echo '<input type="hidden" name="borrar_video_id_cd_migracion_sid" value="' . $row1['id_cd_migracion_video'] . '">';
                    echo '<button type="submit" style="color:red; border:none; background:none;" title="Eliminar PDF"><i class="fa fa-trash-o"></i></button>';
                    echo '</form>';
                } else {
                    echo $row1['nombre_cd_migracion_video'] . ' - ' . '<a href="' . $row1['url_cd_migracion_video'] . '">' . $row1['url_cd_migracion_video'] . '</a>';
                }
            }
            $result1->free();
            ?>
        </div>
    </div>

<?php } ?>
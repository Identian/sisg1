<?php
$nump82 = privilegios(82, $_SESSION['snr']);  // Coordinador Ambiental Nivel central

if (0 < $nump82 or 1 == $_SESSION['rol']) {
  if (isset($_GET['i']) and "" != $_GET['i']) {
    $id = $_GET['i'];
  } else {
    $id = 0;
  }
} else {
  $idfun = $_SESSION['snr'];
  $querypro = "SELECT id_punto_ubicacion, id_funcionario FROM punto_ubicacion_enlace WHERE id_funcionario=$idfun AND estado_punto_ubicacion_enlace=1";
  $selectpro = mysql_query($querypro, $conexion);
  $rowpro = mysql_fetch_assoc($selectpro);
  $id = $rowpro['id_punto_ubicacion'];
  $idfunvalida = $rowpro['id_funcionario'];
}


// NUEVO PUNTO UBICACION
if (
  isset($_POST['nuevopuntoubicacion']) && '' != $_POST['nuevopuntoubicacion'] &&
  isset($_POST['nombre_punto_ubicacion']) && '' != $_POST['nombre_punto_ubicacion']
) {
  $insertSQL = sprintf(
    "INSERT INTO punto_ubicacion (nombre_punto_ubicacion) VALUES (%s)",
    GetSQLValueString($_POST['nombre_punto_ubicacion'], "text")
  );
  $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
  echo $insertado;
}

// EDITAR PUNTO UBICACION
if (
  isset($_POST['actualizarpuntoubicacion']) && '' != $_POST['actualizarpuntoubicacion'] &&
  isset($_POST['nombre_punto_ubicacion']) && '' != $_POST['nombre_punto_ubicacion'] &&
  isset($_POST['id_punto_ubicacion']) && '' != $_POST['id_punto_ubicacion']
) {
  $actualizar = sprintf(
    "UPDATE punto_ubicacion SET 
          nombre_punto_ubicacion=%s
          WHERE id_punto_ubicacion=%s",
    GetSQLValueString($_POST["nombre_punto_ubicacion"], "text"),
    GetSQLValueString($_POST["id_punto_ubicacion"], "int")
  );
  $resultado = mysql_query($actualizar, $conexion);
  mysql_free_result($resultado);
  echo $actualizado;
}
?>

<script>
  $(function() {
    $('.editarpunto').click(function() {
      var var2 = this.id;
      jQuery.ajax({
        type: "POST",
        url: "pages/punto_ubicacion_editar.php",
        data: 'option=' + 'editarpuntoubicacion' + '-' + var2,
        async: true,
        success: function(b) {
          jQuery('#divEditarPuntoUbicacion').html(b);
        }
      })
    });
  })
</script>

<div class="row">
  <div class="col-md-12">
    <!-- TABLE: LATEST ORDERS -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><strong>Puntos de Ubicación</strong></h3>&nbsp;&nbsp;&nbsp;
        <?php if (0 < $nump82 or 1 == $_SESSION['rol']) { ?>
          <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#nuevo_punto_ubicacion" title="Nuevo punto de Ubicacion"> Nuevo </button>
        <?php } ?>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-striped table-bordered table-hover" id="tablepuntosubicacion" cellspacing="0" width="100%">
          <thead>
            <tr align="center" valign="middle">
              <th>Cod</th>
              <th>Lugar</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $querypro = "SELECT 
            punto_ubicacion.id_punto_ubicacion, 
            punto_ubicacion.nombre_punto_ubicacion, 
            punto_ubicacion.estado_punto_ubicacion,
            punto_ubicacion_enlace.estado_punto_ubicacion_enlace
            FROM punto_ubicacion
            LEFT JOIN punto_ubicacion_enlace 
            ON punto_ubicacion.id_punto_ubicacion=punto_ubicacion_enlace.id_punto_ubicacion
            WHERE estado_punto_ubicacion=1";
            $selectpro = mysql_query($querypro, $conexion);
            $rowpro = mysql_fetch_assoc($selectpro);
            $totalRowspro = mysql_num_rows($selectpro);
            if (0 < $totalRowspro) {
              do {
                echo '<tr>';
                echo '<td>' . $rowpro['id_punto_ubicacion'] . '</td>';
                echo '<td>' . $rowpro['nombre_punto_ubicacion'] . '</td>';
                echo '<td>';
            ?>
                <?php if (0 < $nump82 or 1 == $_SESSION['rol']) { ?>
                  <a class="editarpunto btn-sm btn-warning" title="Editar Punto Ubicacion" id="<?php echo $rowpro['id_punto_ubicacion']; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#editar_punto"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                <?php } ?>
                <a href="ambiental&ubicacion&<?php echo $rowpro['id_punto_ubicacion']; ?>.jsp" style="background:#25ea3d" title="Ambiental" class="btn-sm btn-success"><i class="fa fa-fw fa-leaf"></i></a>&nbsp;
            <?php
                echo '</td>';
                echo '</tr>';
              } while ($rowpro = mysql_fetch_assoc($selectpro));
              mysql_free_result($selectpro);
            }
            ?>
            <script>
              $(document).ready(function() {
                $('#tablepuntosubicacion').DataTable({
                  "lengthMenu": [
                    [30, 50, 100, 200, 500],
                    [30, 50, 100, 200, 500]
                  ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [0, "asc"]
                  ]
                });
              });
            </script>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<!-- MODAL DE NUEVO PUNTO UBICACION -->
<div class="modal fade" id="nuevo_punto_ubicacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="float:left" id="exampleModalLabel"><b>Nuevo Punto Ubicación</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="POST" name="formulariopuntoubicacion">
        <div class="modal-body">
          <label>Nombre del Punto Ubicación</label>
          <input type="text" class="form-control" name="nombre_punto_ubicacion" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
          <input class="btn btn-success" type="submit" name="nuevopuntoubicacion" value="Guardar">
        </div>
      </form>

    </div>
  </div>
</div>

<!-- MODAL DE EDITAR PUNTO UBICACION -->
<div class="modal fade" id="editar_punto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="float:left" id="exampleModalLabel"><b>Editar Punto Ubicación</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" name="actualizarPuntoUbicacion">
        <div class="modal-body">
          <div id="divEditarPuntoUbicacion">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
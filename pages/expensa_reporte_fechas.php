<?php
$nump34 = privilegios(34, $_SESSION['snr']);
$nump35 = privilegios(35, $_SESSION['snr']);
if (1 == $_SESSION['rol'] or 0 < $nump34 or 0 < $nump35) {

  require_once "modelo/exp_curaduria.php";
  require_once "controlador/exp_curaduria.php";
?>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong> Reporte de Pagos - Expensas de Curadurias </strong></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
          <div class="table-responsive">
            <table class="table display" id="reporfecha">
              <thead>
                <tr>
                  <th>Id expensa</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                  <th>Nombre Curaduria</th>
                  <th>Departamento</th>
                  <th>Municipio</th>
                  <th>Fecha Soporte</th>
                  <th>Valor Soporte</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $tablareporfecha = new expensaCuraduriaControlador();
                $tablareporfecha->tablareporfechaControlador();
                ?>
               <script>
                  $(document).ready(function() {
                    $('#reporfecha').DataTable({
                      dom: 'Bfrtip',
                      buttons: [{
                          extend: 'excelHtml5',
                          title: 'Detalle Reporte Pagos Curadurias <?php echo date("d-m-Y"); ?>'
                        },
                        {
                          extend: 'csvHtml5',
                          title: 'Detalle Reporte Pagos Curadurias <?php echo date("d-m-Y"); ?>'
                        }
                      ],
                      "lengthMenu": [
                        [50, 100, 200, 300, 500],
                        [50, 100, 200, 300, 500]
                      ],
                      "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                      }
                    });
                  });
                </script>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
<?php } else {
}

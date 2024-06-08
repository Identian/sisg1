<?php
require_once "modelo/exp_curaduria.php";
require_once "controlador/exp_curaduria.php";
?>

<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><strong> Reporte de Facturación por Curaduria </strong></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table display" id="reporfactura">
            <thead>
              <tr>
                <th>Nombre Curaduria</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th>Cargo Fijo</th>
                <th>Cargo Variable</th>
                <th>Cargo Unico</th>
                <th>Facturación</th>
                <th>Tarifa 5%</th>
                <th>Notas Credito</th>
                <th>Total Facturación</th>
                <th>Total Tarifa 5%</th>
                <th>Pagos Efectuados</th>
                <th>Devolución</th>
                <th>Saldos</th>
                <th>Observación</th>
                <th>Estado</th>
                <th>Debe o Pago</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $tablareporfactura = new expensaCuraduriaControlador();
              $tablareporfactura->tablareporfacturaControlador();
              ?>
             <script>
                $(document).ready(function() {
                  $('#reporfactura').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        title: 'Detalle Reporte Facturacion Curadurias <?php echo date("d-m-Y"); ?>'
                      },
                      {
                        extend: 'csvHtml5',
                        title: 'Detalle Reporte Facturacion Curadurias <?php echo date("d-m-Y"); ?>'
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
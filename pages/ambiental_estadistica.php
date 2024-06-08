<?php
require_once('listas.php');

// FECHA ACTUAL
date_default_timezone_set("America/Bogota");
$ano =  date('Y');

// agrupacion de unidades de medida energia y agua
function total($mes, $ano, $region, $servicio, $mysqli)
{
  $query1 = "SELECT SUM(unidad) AS total FROM ambiental_consumo 
  LEFT JOIN oficina_registro
  ON ambiental_consumo.id_oficina_registro=oficina_registro.id_oficina_registro
  LEFT JOIN region
  ON region.id_region=oficina_registro.id_region
  WHERE estado_ambiental_consumo=1 
  AND nombre_ambiental_consumo='$servicio'
  AND month(periodo_inicial)=$mes
  AND year(periodo_inicial)=$ano 
  AND oficina_registro.id_region=$region";
  $result1 = $mysqli->query($query1);
  if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    if (NULL != $row1["total"] || '' != $row1["total"] && isset($row1["total"])) {
      return $row1["total"];
    } else {
      return 0;
    }
  } 
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<div class="panel panel-default">
  <div class="row">

  <div class="col-md-6">
      <h5 style="text-align: center; color:#666"><b>Estadistica Consumo de Energia <?php echo $ano; ?></b></h5>
      <div style="width:100%;"><canvas id="canvas" class="chartjs"></canvas></div>
      <script>
        new Chart(document.getElementById("canvas"), {
          "type": "line",
          "data": {
            "labels": ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            "datasets": [{
              "label": "Andina",
              "backgroundColor": "rgb(240, 128, 128)",
              "data": [
                '<?php echo total(1, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(2, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(3, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(4, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(5, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(6, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(7, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(8, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(9, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(10, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(11, $ano, 1, 'Energia',  $mysqli); ?>',
                '<?php echo total(12, $ano, 1, 'Energia',  $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(240, 128, 128)",
              "lineTension": 0.1
            }, {
              "label": 'Central',
              "backgroundColor": "rgb(175, 122, 197)",
              "data": [
                '<?php echo total(1, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(2, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(3, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(4, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(5, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(6, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(7, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(8, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(9, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(10, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(11, $ano, 2, 'Energia',  $mysqli); ?>',
                '<?php echo total(12, $ano, 2, 'Energia',  $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(175, 122, 197)",
              "lineTension": 0.1
            }, {
              "label": 'Caribe',
              "backgroundColor": "rgb(93, 173, 226)",
              "data": [
                '<?php echo total(1, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(2, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(3, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(4, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(5, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(6, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(7, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(8, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(9, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(10, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(11, $ano, 3, 'Energia',  $mysqli); ?>',
                '<?php echo total(12, $ano, 3, 'Energia',  $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(93, 173, 226)",
              "lineTension": 0.1
            }, {
              "label": 'Pacifico',
              "backgroundColor": "rgb(69, 179, 157)",
              "data": [
                '<?php echo total(1, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(2, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(3, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(4, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(5, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(6, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(7, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(8, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(9, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(10, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(11, $ano, 4, 'Energia',  $mysqli); ?>',
                '<?php echo total(12, $ano, 4, 'Energia',  $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(69, 179, 157)",
              "lineTension": 0.1
            }, {
              "label": 'Orinoquia',
              "backgroundColor": "rgb(245, 176, 65)",
              "data": [
                '<?php echo total(1, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(2, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(3, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(4, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(5, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(6, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(7, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(8, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(9, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(10, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(11, $ano, 5, 'Energia',  $mysqli); ?>',
                '<?php echo total(12, $ano, 5, 'Energia',  $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(245, 176, 65)",
              "lineTension": 0.1
            }]
          },
          "options": {}
        });
      </script>
    </div>

    <div class="col-md-6">
      <h5 style="text-align: center; color:#666"><b>Estadistica Consumo de Agua <?php echo $ano; ?></b></h5>
      <div style="width:100%;"><canvas id="canvas1" class="chartjs"></canvas></div>
      <script>
        new Chart(document.getElementById("canvas1"), {
          "type": "line",
          "data": {
            "labels": ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            "datasets": [{
              "label": "Andina",
              "backgroundColor": "rgb(240, 128, 128)",
              "data": [
                '<?php echo total(1, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(2, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(3, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(4, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(5, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(6, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(7, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(8, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(9, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(10, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(11, $ano, 1, 'Agua', $mysqli); ?>',
                '<?php echo total(12, $ano, 1, 'Agua', $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(240, 128, 128)",
              "lineTension": 0.1
            }, {
              "label": 'Central',
              "backgroundColor": "rgb(175, 122, 197)",
              "data": [
                '<?php echo total(1, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(2, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(3, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(4, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(5, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(6, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(7, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(8, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(9, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(10, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(11, $ano, 2, 'Agua', $mysqli); ?>',
                '<?php echo total(12, $ano, 2, 'Agua', $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(175, 122, 197)",
              "lineTension": 0.1
            }, {
              "label": 'Caribe',
              "backgroundColor": "rgb(93, 173, 226)",
              "data": [
                '<?php echo total(1, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(2, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(3, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(4, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(5, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(6, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(7, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(8, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(9, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(10, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(11, $ano, 3, 'Agua', $mysqli); ?>',
                '<?php echo total(12, $ano, 3, 'Agua', $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(93, 173, 226)",
              "lineTension": 0.1
            }, {
              "label": 'Pacifico',
              "backgroundColor": "rgb(69, 179, 157)",
              "data": [
                '<?php echo total(1, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(2, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(3, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(4, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(5, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(6, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(7, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(8, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(9, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(10, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(11, $ano, 4, 'Agua', $mysqli); ?>',
                '<?php echo total(12, $ano, 4, 'Agua', $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(69, 179, 157)",
              "lineTension": 0.1
            }, {
              "label": 'Orinoquia',
              "backgroundColor": "rgb(245, 176, 65)",
              "data": [
                '<?php echo total(1, $ano, 5, 2,  $mysqli); ?>',
                '<?php echo total(2, $ano, 5, 2,  $mysqli); ?>',
                '<?php echo total(3, $ano, 5, 2,  $mysqli); ?>',
                '<?php echo total(4, $ano, 5, 2,  $mysqli); ?>',
                '<?php echo total(5, $ano, 5, 2,  $mysqli); ?>',
                '<?php echo total(6, $ano, 5, 2,  $mysqli); ?>',
                '<?php echo total(7, $ano, 5, 2,  $mysqli); ?>',
                '<?php echo total(8, $ano, 5, 2,  $mysqli); ?>',
                '<?php echo total(9, $ano, 5, 2,  $mysqli); ?>',
                '<?php echo total(10, $ano, 5, 'Agua', $mysqli); ?>',
                '<?php echo total(11, $ano, 5, 'Agua', $mysqli); ?>',
                '<?php echo total(12, $ano, 5, 'Agua', $mysqli); ?>'
              ],
              "fill": false,
              "borderColor": "rgb(245, 176, 65)",
              "lineTension": 0.1
            }]
          },
          "options": {}
        });
      </script>
    </div>
  </div>
</div>



<div class="panel panel-default">
  <div class="box-header with-border">
    <h3 class="box-title">
      <b>Consumo de Servicios</b>
      <div class="box-tools pull-right">
      </div>
    </h3>
  </div>
  <div class="panel-body">

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="consolidadoConsumo" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Mes</th>
            <th>Año</th>
            <th>Ubicacion</th>
            <th>Servicio</th>
            <th>Cantidad Personas</th>
            <th>No Medidor</th>
            <th>Dirección Medidor</th>
            <th>Frecuencia</th>
            <th>Fecha Inicio Facturado</th>
            <th>Fecha Final Facturado</th>
            <th title="(kilovatios por Hora) (Metros Cubicos)">Unidad (Kw/h - M3)</th>
            <th>Valor</th>
            <th>Observación</th>
            <th>PDF Factura</th>
            <th>Visto</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM ambiental_consumo";
          $result = $mysqli->query($query);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo '<td>' . $row['id_ambiental_consumo'] . '</td>';
              echo '<td>' . $row['mes_reporte'] . '</td>';
              echo '<td>' . $row['ano_reporte'] . '</td>';
              echo '<td>' . $row['ubicacion'] . '</td>';
              echo '<td>' . $row['nombre_ambiental_consumo'] . '</td>';
              echo '<td>' . $row['cantidad_personas'] . '</td>';
              echo '<td>' . $row['numero_medidor'] . '</td>';
              echo '<td>' . $row['direccion_medidor'] . '</td>';
              echo '<td>' . $row['frecuencia_cobro'] . '</td>';
              echo '<td>' . $row['periodo_inicial'] . '</td>';
              echo '<td>' . $row['periodo_final'] . '</td>';
              echo '<td>' . $row['unidad'] . '</td>';
              echo '<td>' . $row['valor_factura'] . '</td>';
              echo '<td>' . substr($row['observacion'], 0, 50) . '</td>';
              echo '<td>';
              if (isset($row['url_doc']) && '' != $row['url_doc']) {
                echo '<a href="https://sisg.supernotariado.gov.co/filesnr/ambiental/' . $row['ano_doc'] . '/' . $row['url_doc'] . '"  target="_blank">https://sisg.supernotariado.gov.co/filesnr/ambiental/' . $row['ano_doc'] . '/' . $row['url_doc'] . '</a>';
              }
              echo '</td>';
              echo '<td>';
              if (0 === intval($row['estado_envio'])) {
                echo 'No';
              } else {
                echo 'Si';
              }
              echo '</td>';
              echo '</tr>';
            }
          }
          $result->free_result();
          ?>
          <script>
            $(document).ready(function() {
              $('#consolidadoConsumo').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                  extend: 'excelHtml5',
                  title: 'Estadista <?php echo date("Y-m-d H:i:s"); ?>'
                }],
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

  </div>

</div>
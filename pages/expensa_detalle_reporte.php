<?php
$nump16 = privilegios(16, $_SESSION['snr']);
$nump34 = privilegios(34, $_SESSION['snr']);
$nump35 = privilegios(35, $_SESSION['snr']);

if (1 == $_SESSION['rol'] or 0 < $nump16 or 0 < $nump34 or 0 < $nump35) {
?>

  <div class="row">
    <div class="col-md-12" style="font-size:100%">
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title"><b>PERIODOS NO REPORTADOS</b></h4>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div> <!-- BOX HEADER -->
        <div class="box-body">

          <div>
            <form action="" method="POST" name="enviodevarabusqueda">
              <span style=" float: left;">&nbsp;&nbsp;AÑO&nbsp;&nbsp;</span>
              <select class="form-control" name="anoselect" style="width:300px; float: left;">
                <option value="" selected>--- Seleccionar ---</option>
                <option value="2018"> 2018 </option>
                <option value="2019"> 2019 </option>
                <option value="2020"> 2020 </option>
                <option value="2021"> 2021 </option>
              </select>
              <input class="btn-xl btn btn-primary" type="submit" name="repor_tarifa_expensa" value="Buscar" />&nbsp;
              <a href="./expensa_detalle_reporte.jsp" />Restaurar</a>
            </form>
          </div><br><br>
          <table class="table display nowrap" id="reportedeexpensa">
            <thead>
              <tr>
                <th>Curaduria</th>
                <th>Año</th>
                <th>Mes</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $anoActual = date("Y");
              if (isset($_POST['repor_tarifa_expensa'])) {
                $selectAno = $_POST['anoselect'];
                $query1201 = sprintf("SELECT DISTINCT a.id_curaduria, anno, mes, anno_cura, mes_cura
              FROM curaduria_ames a
              LEFT JOIN cura_anno_mes b
              ON (a.id_curaduria = b.id_curaduria
              AND a.anno = b.anno_cura
              AND a.mes = b.mes_cura)
              WHERE a.anno = $selectAno
              AND anno_cura IS null");
              } else {
                $query1201 = sprintf("SELECT DISTINCT a.id_curaduria, anno, mes, anno_cura, mes_cura
              FROM curaduria_ames a
              LEFT JOIN cura_anno_mes b
              ON (a.id_curaduria = b.id_curaduria
              AND a.anno = b.anno_cura
              AND a.mes = b.mes_cura)
              WHERE a.anno = $anoActual
              AND anno_cura IS null");
              }

              $select1201 = mysql_query($query1201, $conexion) or die(mysql_error());
              while ($row1201 = mysql_fetch_assoc($select1201)) {
              ?>
                <tr>
                  <td><?php echo quees('curaduria', $row1201['id_curaduria']); ?></td>
                  <td><?php echo $row1201['anno']; ?></td>
                  <td><?php echo $row1201['mes']; ?></td>
                </tr>
              <?php } ?>

              <script>
                $(document).ready(function() {
                  $('#reportedeexpensa').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        title: 'Periodos NO Reportados <?php echo date("d-m-Y"); ?>'
                      },
                      {
                        extend: 'csvHtml5',
                        title: 'Periodos NO Reportados <?php echo date("d-m-Y"); ?>'
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

        </div> <!-- BODY -->

      </div> <!-- BOX -->
    </div> <!-- COL-MD-12 -->
  </div> <!-- ROW -->

<?php
} else {
}

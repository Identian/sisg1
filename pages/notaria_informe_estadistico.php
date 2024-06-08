<div class="box" style="background-color: white; margin:10px;">
  <div class="box-header with-border">
    <h3 class="box-title">Reporte Informe Estadistico Notarial</h3>
  </div>
  <div class="box-body">
    <!-- <h4 class="card-title text-center"><b>Reporte Informe Estadistico Notarial</b></h4> -->
    <form action="" method="POST" name="enviodenotarias">
      <div class="row">
        <div class="col-md-2">
          Notaria<br>
          <select name="notaria" class="form-control">
            <option value="">--Seleccionar--</option>
            <option value="0">Todas Notarias</option>
            <?php echo listanotarias() ?>
          </select>
        </div>
        <div class="col-md-2">
          Fecha Inicio<br>
          <input type="date" name="fechaNoInicio" class="form-control">
        </div>
        Fecha Final<br>
        <div class="col-md-2">
          <input type="date" name="fechaNoFinal" class="form-control">
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
        </div>

        <div class="col-md-4">
          <?php
          if (
            isset($_POST['notaria']) && "" != $_POST['notaria'] &&
            isset($_POST['fechaNoInicio']) && "" != $_POST['fechaNoInicio']  &&
            isset($_POST['fechaNoFinal']) && "" != $_POST['fechaNoFinal']
          ) {
            $Notaria = $_POST['notaria'];

            $anoFechaNoInicio = substr($_POST['fechaNoInicio'], 0, 4);
            $mesFechaNoInicio = substr($_POST['fechaNoInicio'], 5, 2);
            $diaFechaNoInicio = substr($_POST['fechaNoInicio'], 8, 2);
            $fechaNoInicioLiteral = intval($anoFechaNoInicio . $mesFechaNoInicio . $diaFechaNoInicio);

            $anoFechaNoFinal = substr($_POST['fechaNoFinal'], 0, 4);
            $mesFechaNoFinal = substr($_POST['fechaNoFinal'], 5, 2);
            $diaFechaNoFinal = substr($_POST['fechaNoFinal'], 8, 2);
            $fechaNoFinalLiteral = $anoFechaNoFinal . $mesFechaNoFinal . $diaFechaNoFinal;

            $nuevaURL = 'https://sisg.supernotariado.gov.co/xls/informe_estadistico_notarial&' . $Notaria . '&' . $fechaNoInicioLiteral . $fechaNoFinalLiteral . '.xls';
            // $nuevaURL = 'https://localhost/sisg/xls/informe_estadistico_notarial&' . $Notaria . '&' . $fechaNoInicioLiteral . $fechaNoFinalLiteral . '.xls';

          ?>
            <div class="sport-table-wager" id="grupo1">
              <a href="<?php echo $nuevaURL; ?>" onclick="ocultar('grupo1')"><img src="images/excel.png" alt="Exportar Reporte" style="width:20px;">Reporte Informe Estadistico Notarial<?php echo $_POST['fechaNoInicio']; ?> al <?php echo $_POST['fechaNoFinal']; ?></a>
            </div>
          <?php
          }
          ?>
        </div>

      </div>
      <hr>
    </form>
  </div>
</div>
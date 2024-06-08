<script>
  function ocultar(id) {
    var elemento = document.getElementById(id);
    elemento.style.display = "none";
  }
</script>

<div class="box" style="background-color: white; margin:10px;">
  <div class="box-header with-border">
    <h3 class="box-title">Estadisticas No Conformidad</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form action="" method="POST" name="enviodeoficinaalcontador">
      <div class="row">
        <div class="col-sm-3">
          <select name="oficina" class="form-control col-lg-7">
            <option value="">--Seleccionar--</option>
            <?php echo lista('oficina_registro', 300) ?>
          </select>
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
        </div>
      </div>
    </form>
    <hr>

    <?php
    if (isset($_POST['oficina']) && "" != $_POST['oficina']) {
      // $infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
      // $infop = $infobus;
      $idOficina = $_POST['oficina'];
    } else {
      $idOficina = 30;
    }
    ?>

    <!-- /.col (left) -->
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
          <h4 class="card-title text-center"><b>Cantidad de Errores Registrados del Mes Presente No Conformidades <?php echo quees('oficina_registro', $idOficina) ?></b></h4>
        </div>
        <!-- /.card-header -->
        <div class="card-body text-center">
          <?php
          $anoNO = date('Y');
          $mesNO = date('m');

          $sql = sprintf("SELECT count(id_snc_tipo_error) as contador FROM snc_orip_tipo_error 
          where 
          estado_error_snc=1");
          $result = $mysqli->query($sql);
          $row4 = $result->fetch_array(MYSQLI_ASSOC);
          $CantidadErrores = $row4['contador'];

          for ($item = 1; $item <= $CantidadErrores; $item++) {

            $sql = "SELECT COUNT(id_error_snc) AS ERRORSNC FROM snc_orip_pnc 
            WHERE
            MONTH(fecha_registro_snc) = $mesNO AND YEAR(fecha_registro_snc) = $anoNO AND
            id_oficina_registro=$idOficina AND
            id_error_snc=$item";
            $result = $mysqli->query($sql);
            $row = $result->fetch_array(MYSQLI_NUM);

            $sqls = sprintf("SELECT nombre_error_snc FROM snc_orip_tipo_error where id_snc_tipo_error=$item");
            $results = $mysqli->query($sqls);
            $rows = $results->fetch_array(MYSQLI_ASSOC);
            echo '
              <div class="row">
                <label class="col-sm-4">' . $rows['nombre_error_snc'] . '</label>
                <div class="col-sm-7">
                <div class="progress">
                <div class="progress-bar progress-bar-success" style="width:' . $row[0] . '%">';
            if ($row[0] == 0) {
              echo '<span style="color:black">' . $row[0] . '</span>';
            } else {
              echo '<span>' . $row[0] . '</span>';
            }
            echo '</div>
                </div>
                </div>
              </div>
              ';
          }

          $sqlTotal = "SELECT COUNT(id_oficina_registro) AS TOTALREGISTRO FROM snc_orip_pnc 
          WHERE
          MONTH(fecha_registro_snc) = $mesNO AND YEAR(fecha_registro_snc) = $anoNO AND
          id_oficina_registro=$idOficina AND estado_snc=1";
          $result = $mysqli->query($sqlTotal);
          $rowTotal = $result->fetch_array(MYSQLI_NUM);
          $TOTALREGISTRO = $rowTotal[0];

          $sqlTotal = "SELECT COUNT(id_oficina_registro) AS TOTALCORRECCCIONES FROM snc_orip_pnc 
          WHERE
          MONTH(fecha_registro_snc) = $mesNO AND YEAR(fecha_registro_snc) = $anoNO AND
          id_oficina_registro=$idOficina AND estado_snc=2";
          $result = $mysqli->query($sqlTotal);
          $rowTotal = $result->fetch_array(MYSQLI_NUM);
          $TOTALCORRECCCIONES = $rowTotal[0];

          echo '
              <div class="row">
                <label class="col-sm-4">TOTAL REGISTRADOS:</label>
                <label class="col-sm-4">' . $TOTALREGISTRO . '</label>
              </div>
              <div class="row">
                <label class="col-sm-4">TOTAL CORRECCIONES:</label>
                <label class="col-sm-4">' . $TOTALCORRECCCIONES . '</label>
              </div>
            ';

          // $result->free_result();
          // $mysqli->close();
          ?>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col (right) -->
    <hr>
  </div>



  <div class="box-body">
    <h4 class="card-title text-center"><b>Reporte No Conformidad</b></h4>
    <form action="" method="POST" name="enviodedatosareportenoconformidad">
      <div class="row">
        <div class="col-md-2">
          Oficina Registro<br>
          <select name="oficinareporte" class="form-control">
            <option value="">--Seleccionar--</option>
            <option value="0">Todas Oficinas de Registro</option>
            <?php echo lista('oficina_registro', 300) ?>
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
            isset($_POST['oficinareporte']) && "" != $_POST['oficinareporte'] &&
            isset($_POST['fechaNoInicio']) && "" != $_POST['fechaNoInicio']  &&
            isset($_POST['fechaNoFinal']) && "" != $_POST['fechaNoFinal']
          ) {
            $oficinareporte = $_POST['oficinareporte'];

            $anoFechaNoInicio = substr($_POST['fechaNoInicio'], 0, 4);
            $mesFechaNoInicio = substr($_POST['fechaNoInicio'], 5, 2);
            $diaFechaNoInicio = substr($_POST['fechaNoInicio'], 8, 2);
            $fechaNoInicioLiteral = intval($anoFechaNoInicio . $mesFechaNoInicio . $diaFechaNoInicio);

            $anoFechaNoFinal = substr($_POST['fechaNoFinal'], 0, 4);
            $mesFechaNoFinal = substr($_POST['fechaNoFinal'], 5, 2);
            $diaFechaNoFinal = substr($_POST['fechaNoFinal'], 8, 2);
            $fechaNoFinalLiteral = $anoFechaNoFinal . $mesFechaNoFinal . $diaFechaNoFinal;

            $nuevaURL = 'https://sisg.supernotariado.gov.co/xls/no_conformidad&' . $oficinareporte . '&' . $fechaNoInicioLiteral . $fechaNoFinalLiteral . '.xls';
          ?>
            <div class="sport-table-wager" id="grupo1">
              <a href="<?php echo $nuevaURL; ?>" onclick="ocultar('grupo1')"><img src="images/excel.png" alt="Exportar Reporte" style="width:20px;">Reporte No Conformidad<?php echo $_POST['fechaNoInicio']; ?> al <?php echo $_POST['fechaNoFinal']; ?></a>
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
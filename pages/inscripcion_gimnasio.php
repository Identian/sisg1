<?php
//GIMNASIO
$nump111 = privilegios(111, $_SESSION['snr']);

$realdatecompleto = date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-05-25 08:00:00");
$fecha_limite = strtotime("2023-12-31 17:00:00");

// Fecha Actual
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$fechaAno = date("Y");

// CONTROL DE INGRESO 
$query = "SELECT id_grupo_area FROM grupo_area WHERE 
            nombre_grupo_area LIKE '%armenia%' 
            OR nombre_grupo_area LIKE '%bogota%'
            OR nombre_grupo_area LIKE '%barranquilla%'
            OR nombre_grupo_area LIKE '%bucaramanga%'
            OR nombre_grupo_area LIKE '%cali%'
            OR nombre_grupo_area LIKE '%cartagena%'
            OR nombre_grupo_area LIKE '%medellin%'
            OR nombre_grupo_area LIKE '%monteria%'
            OR nombre_grupo_area LIKE '%rionegro%'
            OR nombre_grupo_area LIKE '%pasto%'
            OR nombre_grupo_area LIKE '%palmira%'
            OR nombre_grupo_area LIKE '%pereira%'
            OR nombre_grupo_area LIKE '%tunja%'
            OR nombre_grupo_area LIKE '%tulua%'
            OR nombre_grupo_area LIKE '%manizales%'
            OR nombre_grupo_area LIKE '%cucuta%'
            OR nombre_grupo_area LIKE '%ibague%'
            OR nombre_grupo_area LIKE '%valledupar%'
            OR nombre_grupo_area LIKE '%villavicencio%'
            OR nombre_grupo_area LIKE '%neiva%'";
$result = $mysqli->query($query);
$arrayorips = array();
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  array_push($arrayorips, $row['id_grupo_area']);
}
$idGrupoArea = $_SESSION['snr_grupo_area'];
if (in_array("$idGrupoArea", $arrayorips)) {
  $autorizacion = 1;
} else {
  $autorizacion = 0;
}

if ($fecha_limite >= $fecha_actual && (1 == $_SESSION['snr_tipo_oficina'] || 1 == $autorizacion || 0 < $nump111 || 1 == $_SESSION['rol'])) {

  if ((isset($_POST["relacion"])) && ("" != $_POST["relacion"])) {
    $funcionario = $_SESSION['snr'];

      $insertSQL = sprintf(
        "INSERT INTO gimnasio23 (id_funcionario, nombre_gimnasio23, gimnasio, ano_vigencia, id_oficina_registro, id_sede_gimnasio, relacion, cedula_beneficiario, contacto, fecha_inscripcion) 
        VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
        GetSQLValueString($funcionario, "int"),
        GetSQLValueString($_POST['nombre_gimnasio23'], "text"),
		 GetSQLValueString($_POST['gimnasio'], "text"),
        GetSQLValueString($fechaAno, "int"),
        GetSQLValueString($_SESSION['snr_tipo_oficina'], "int"),
        GetSQLValueString($_POST["id_sede_gimnasio"], "text"),
        GetSQLValueString($_POST["relacion"], "text"),
        GetSQLValueString($_POST["cedula_beneficiario"], "text"),
        GetSQLValueString($_POST["contacto"], "text"),
        GetSQLValueString($fechaActual, "date")
      );
      $Result = mysql_query($insertSQL, $conexion);
      
	  
	  echo $insertado;

      $emailur2 = $_SESSION['snr_correo'];
      $subject = 'CONFIRMACIÓN DE REGISTRO PARA GIMNASIO';
      $cuerpo2 = '';
      $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que se ha registrado correctamente el registro de gimnasio.<br><br>';
      $cuerpo2 .= "<b>Datos del Beneficiario</b><br>";
      $cuerpo2 .= "<b>Nombre</b> " . $_POST['nombre_gimnasio23'] . "<br>";
      $cuerpo2 .= "<b>Cedula</b> " . $_POST['cedula_beneficiario'] . "<br>";
      $cuerpo2 .= "<b>Contacto</b> " . $_POST['contacto'] . "<br>";
      $cuerpo2 .= "<b>Sede GYM</b> " . $_POST['id_sede_gimnasio'] . "<br>";
      $cuerpo2 .= "<b>Fecha</b> " . $fechaActual . "<br>";
      $cuerpo2 .= "<br>";
      $cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo2 .= "<br></div><br></div>";
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      mail($emailur2, $subject, $cuerpo2, $cabeceras);

      
  } else {
  }


?>
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo existencia('gimnasio23'); ?></h3>

          <p>Registros</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>


    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>20<?php echo $anoactual; ?></h3>

          <p>Año</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>



    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">

          <h3>5</h3>

          <p>Regionales</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>195</h3>
          <p>Oficinas de registro</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>


  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-md-12">
		    <button type="button" class="btn  btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
                Agregar persona
              </button>
			  
            <span><b>Gimnasio 2023</b></span>
			
			  <a target="_blank" href="files/portal/intranet/portal-terminos_condiciones_gimnasio_2023.pdf">Terminos y condiciones</a>

          </div>
        </div> <!-- FINAL box-header with-border -->

        <div class="box-body">
          <div class="table-responsive">
            <table class="table display" id="inforesoluciones" cellspacing="0" width="100%">
              <thead>
                <tr align="center" valign="middle">
                  <th>Fecha</th>
                  <th>Funcionario</th>
                  <th>Gimnasio</th>
				   <th>Correo</th>
                  <th>Cedula</th>
                  <th>Area</th>
                  <th>Oficina</th>
                  <th>Consanguinidad</th>
                  <th>Nombre inscrito</th>
                  <th>Cedula</th>
                  <th>Contacto</th>
                  <th>Sede</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (1 == $_SESSION['rol'] or 0 < $nump111) {
                  $query4 = "SELECT * from gimnasio23, funcionario where gimnasio23.id_funcionario=funcionario.id_funcionario and estado_gimnasio23=1 ORDER BY id_gimnasio23 desc  ";
                } else {
                  $query4 = "SELECT * from gimnasio23, funcionario where gimnasio23.id_funcionario=funcionario.id_funcionario and estado_gimnasio23=1 and funcionario.id_funcionario=" . $_SESSION['snr'] . " ORDER BY id_gimnasio23 desc  ";
                }
                $result = $mysqli->query($query4);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                ?>
                  <tr>
                    <?php
                    $id_res = $row['id_gimnasio23'];

                    echo '<td>';
                    echo $row['fecha_inscripcion'];
                    echo '</td>';

                    echo '<td><a href="usuario&' . $row['id_funcionario'] . '.jsp"  target="_blank">' . $row['nombre_funcionario'] . '</a></td>';
                    echo '<td>';
                    echo $row['gimnasio'];
                    echo '</td>';
					echo '<td>';
                    echo $row['correo_funcionario'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['cedula_funcionario'];
                    echo '</td>';
                    if (1 == $row['id_tipo_oficina']) {
                      echo '<td>Nivel central</td>';
                      echo '<td>' . quees('grupo_area', $row['id_grupo_area']) . '</td>';
                    } else {
                      echo '<td>' . regional($row['id_oficina_registro']) . '</td>';
                      echo '<td>' . quees('oficina_registro', $row['id_oficina_registro']) . '</td>';
                    }
                    echo '<td>';
                    echo $row['relacion'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['nombre_gimnasio23'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['cedula_beneficiario'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['contacto'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['id_sede_gimnasio'];
                    echo '</td>';
                    echo '<td>';
                    if (1 == $_SESSION['rol'] or 0 < $nump111) {
                      echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="gimnasio23" id="' . $id_res . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
                    } else {
                    }
                    echo '</td>';
                    ?>

                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <script>
              $(document).ready(function() {
                $('#inforesoluciones').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                    // 'copyHtml5',
                    'excelHtml5'

                    // 'pdfHtml5'
                  ],
                  "lengthMenu": [
                    [50, 100, 200, 300, 500],
                    [50, 100, 200, 300, 500]
                  ],
                  "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [1, "desc"]
                  ]
                });
              });
            </script>
          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->

      </div> <!-- FINAL PRIMARY -->
    </div> <!-- FINAL DE COL MD 12 -->
  </div><!-- FINAL DE ROW -->




  <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
        </div>
        <div class="modal-body">

          <form action="" method="POST" name="formagregarnuevobeneficiariot">

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Vigencia:</label>
              <input type="text" class="form-control" readonly value="2023">
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label>
              <input type="text" class="form-control" id="namef" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Cédula:</label>
              <input type="text" class="form-control" id="cedulaf" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
            </div>

            <!-- <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Telefono Celular:</label>
              <input type="text" class="form-control numero" name="celular_funcionario" placeholder="Solo números" required>
            </div>
-->
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Gimnasio:</label>
              <select name="gimnasio" class="form-control" required>
                <option></option>
                <option>BodyTech</option>
                <option>Sppining Center</option>
              </select>
            </div>

            <h5 style="text-align: center;"><b>Datos del Beneficiario</b></h5>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Yo o familiar por grado de consanguinidad:</label>
              <select name="relacion" class="form-control" required id="gimnasiobeneficiario">
                <option selected></option>
				<option>Ninguno, Yo</option>
                <option>Padre</option>
                <option>Madre</option>
                <option>Hijo/a</option>
                <option>Cónyuge </option>
                <option>Abuelo/a</option>
                <option>Nieto</option>
                <option>Hermano/a </option>
                <option>Tío/a </option>
                <option>Sobrino/a </option>
              </select>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre de la persona:</label>
              <input type="text" class="form-control" id="personag" name="nombre_gimnasio23" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Cedula de la persona:</label>
              <input type="number" class="form-control numero" id="cedulag" name="cedula_beneficiario" required>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Telefono de la persona:</label>
              <input type="number" class="form-control numero" name="contacto" placeholder="Solo números" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Sede de BodyTech en la cual esta interesado: (<a href="https://bodytech.com.co/sedes" target="_blank">Ver mapa</a>)</label>
              <select name="id_sede_gimnasio" class="form-control" required>
                <option selected></option>
                <option value="ARMENIA, ARMENIA, CARRERA 6 NO 3 - 180 CENTRO COMERCIAL CALIMA, LOCAL: 223">ARMENIA, ARMENIA, CARRERA 6 NO 3 - 180 CENTRO COMERCIAL CALIMA, LOCAL: 223</option>
                <option value="BOGOTÁ, CABRERA, CALLE 85 # 7-13">BOGOTÁ, CABRERA, CALLE 85 # 7-13</option>
                <option value="BOGOTÁ, CHICO, AVENIDA 19 # 102 - 31 PISO 3">BOGOTÁ, CHICO, AVENIDA 19 # 102 - 31 PISO 3</option>
                <option value="BOGOTÁ, CARRERA 11, CALLE 96#10-38">BOGOTÁ, CARRERA 11, CALLE 96#10-38</option>
                <option value="BOGOTÁ, CALLE 90, CALLE 90 # 16-30">BOGOTÁ, CALLE 90, CALLE 90 # 16-30</option>
                <option value="BOGOTÁ, FONTANAR, KILOMETRO 2.5 VIA CHIA-CAJICA PRIMER PISO COSTADO SUR">BOGOTÁ, FONTANAR, KILOMETRO 2.5 VIA CHIA-CAJICA PRIMER PISO COSTADO SUR</option>
                <option value="BOGOTÁ, HACIENDA, CALLE 116 CON AVENIDA SEPTIMA CC HACIENDA SANTA BARARA SOTANO 1">BOGOTÁ, HACIENDA, CALLE 116 CON AVENIDA SEPTIMA CC HACIENDA SANTA BARARA SOTANO 1</option>
                <option value="BOGOTÁ, COLINA, CALLE 138 N° 58 - 74">BOGOTÁ, COLINA, CALLE 138 N° 58 - 74</option>
                <option value="BOGOTÁ, PASADENA, CRA 53 N°101 A - 37 C.C. LOS TRES ELEFANTES PISO 2">BOGOTÁ, PASADENA, CRA 53 N°101 A - 37 C.C. LOS TRES ELEFANTES PISO 2</option>
                <option value="BOGOTÁ, CHAPINERO, CRA 7 # 63-25">BOGOTÁ, CHAPINERO, CRA 7 # 63-25</option>
                <option value="BOGOTÁ, CEDRITOS, CALLE 147 # 7 - 52">BOGOTÁ, CEDRITOS, CALLE 147 # 7 - 52</option>
                <option value="BOGOTÁ, TORRE CENTRAL, CLL 26 # 68C-61 LOCAL 116">BOGOTÁ, TORRE CENTRAL, CLL 26 # 68C-61 LOCAL 116</option>
                <option value="BOGOTÁ, SANTA ANA, AV 9 # 110-20 CENTRO COMERCIAL SANTA ANA">BOGOTÁ, SANTA ANA, AV 9 # 110-20 CENTRO COMERCIAL SANTA ANA</option>
                <option value="BOGOTÁ, BULEVAR, AVENIDA CARRERA 58 # 127-59 LOCAL 181 B CC BULEVAR ">BOGOTÁ, BULEVAR, AVENIDA CARRERA 58 # 127-59 LOCAL 181 B CC BULEVAR </option>
                <option value="BOGOTÁ, GRAN ESTACION, CENTRO COMERCIAL GRAN ESTACIÓN AV. CALLE 26 #62-47 TERCER PISO AL LADO DE CINE COLOMBIA.">BOGOTÁ, GRAN ESTACION, CENTRO COMERCIAL GRAN ESTACIÓN AV. CALLE 26 #62-47 TERCER PISO AL LADO DE CINE COLOMBIA.</option>
                <option value="BOGOTÁ, CHIA, CC. PLAZA MAYOR AVENIDA PRADILLA N 5-31 E LOCAL 121">BOGOTÁ, CHIA, CC. PLAZA MAYOR AVENIDA PRADILLA N 5-31 E LOCAL 121</option>
                <option value="BOGOTÁ, AUTOPISTA 134, CALLE 134 A # 23 - 72">BOGOTÁ, AUTOPISTA 134, CALLE 134 A # 23 - 72</option>
                <option value="BOGOTÁ, COUNTRY 138, CALLE 138 N# 10 A - 42">BOGOTÁ, COUNTRY 138, CALLE 138 N# 10 A - 42</option>
                <option value="BOGOTÁ, FLORESTA, AVENDIA 68 # 90 -88 NIVEL 0 CENTRO COMERCIAL FLORESTA">BOGOTÁ, FLORESTA, AVENDIA 68 # 90 -88 NIVEL 0 CENTRO COMERCIAL FLORESTA</option>
                <option value="BOGOTÁ, CONNECTA, AVENIDA CALLE 26 NO. 92 – 32, MODULO G4 Y G5, PISO 4">BOGOTÁ, CONNECTA, AVENIDA CALLE 26 NO. 92 – 32, MODULO G4 Y G5, PISO 4</option>
                <option value="BOGOTÁ, AUTOPISTA 170, CARRERA 23 N° 166 - 59// AUTP NORTE # 167-10">BOGOTÁ, AUTOPISTA 170, CARRERA 23 N° 166 - 59// AUTP NORTE # 167-10</option>
                <option value="BOGOTÁ, GALERIAS, PISO 6, CRA. 24 #53 - 73, BOGOTÁ CC PLAZA 54">BOGOTÁ, GALERIAS, PISO 6, CRA. 24 #53 - 73, BOGOTÁ CC PLAZA 54</option>
                <option value="BOGOTÁ, TITAN PLAZA, CENTRO COMERCIAL TITAN PLAZA AV CARRERA 72#80-94 LOCAL 427">BOGOTÁ, TITAN PLAZA, CENTRO COMERCIAL TITAN PLAZA AV CARRERA 72#80-94 LOCAL 427</option>
                <option value="BOGOTÁ, CENTRO MAYOR, CALLE 38ª SUR N° 34D - 51 LOCAL 3058">BOGOTÁ, CENTRO MAYOR, CALLE 38ª SUR N° 34D - 51 LOCAL 3058</option>
                <option value="BOGOTÁ, SULTANA, CLL 12 SUR # 31 -33">BOGOTÁ, SULTANA, CLL 12 SUR # 31 -33</option>
                <option value="BOGOTÁ, HAYUELOS, C.C. HAYUELOS CALLE 20 NO 82 - 52 LOCAL 4-59">BOGOTÁ, HAYUELOS, C.C. HAYUELOS CALLE 20 NO 82 - 52 LOCAL 4-59</option>
                <option value="BOGOTÁ, PABLO VI, CRA 52 BIS # 56B -26">BOGOTÁ, PABLO VI, CRA 52 BIS # 56B -26</option>
                <option value="BOGOTÁ, NORMANDIA, AV. BOYACA 49 29 PISO 2">BOGOTÁ, NORMANDIA, AV. BOYACA 49 29 PISO 2</option>
                <option value="BOGOTÁ, PLAZA CENTRAL, CARRERA 65 # 11 – 50 (AVENIDA DE LAS AMÉRICAS Y CALLE 13) PISO 3. LOCAL 3-28 | BOGOTÁ – COLOMBIA">BOGOTÁ, PLAZA CENTRAL, CARRERA 65 # 11 – 50 (AVENIDA DE LAS AMÉRICAS Y CALLE 13) PISO 3. LOCAL 3-28 | BOGOTÁ – COLOMBIA</option>
                <option value="BOGOTÁ, ENSUEÑO, CARRERA 51 # 59C SUR 93A">BOGOTÁ, ENSUEÑO, CARRERA 51 # 59C SUR 93A</option>
                <option value="BOGOTÁ, PASEO DEL RIO, CL. 57D SUR #78H 14">BOGOTÁ, PASEO DEL RIO, CL. 57D SUR #78H 14</option>
                <option value="BOGOTÁ, PORTAL 80, TRV 100A # 80A-20">BOGOTÁ, PORTAL 80, TRV 100A # 80A-20</option>
                <option value="BOGOTÁ, DIVERPLAZA, TRANSVERSAL 96 # 70 A - 85 TERRAZA CUARTO PISO">BOGOTÁ, DIVERPLAZA, TRANSVERSAL 96 # 70 A - 85 TERRAZA CUARTO PISO</option>
                <option value="BOGOTÁ, KENNEDY, TRANS. 78J # 41F-05 SUR">BOGOTÁ, KENNEDY, TRANS. 78J # 41F-05 SUR</option>
                <option value="BOGOTÁ, PLAZA BOSA, CALLE 65 SUR 78 H -51 LOCAL 314">BOGOTÁ, PLAZA BOSA, CALLE 65 SUR 78 H -51 LOCAL 314</option>
                <option value="BOGOTÁ, SUBA, AV CRA 104 # 148 - 07 LOC 269 C. C PLAZA IMPERIAL">BOGOTÁ, SUBA, AV CRA 104 # 148 - 07 LOC 269 C. C PLAZA IMPERIAL</option>
                <option value="SOACHA, TERREROS, CRA. 1 NO. 38-53 LOCAL 4-16 VENTURA-TERCER PISO">SOACHA, TERREROS, CRA. 1 NO. 38-53 LOCAL 4-16 VENTURA-TERCER PISO</option>
                <option value="SOACHA, ANTARES, ANTARES AUTOPISTA SUR CARRERA 4 # 26- 55 SUR MUNICIPIO SOACHA">SOACHA, ANTARES, ANTARES AUTOPISTA SUR CARRERA 4 # 26- 55 SUR MUNICIPIO SOACHA</option>
                <option value="BARRANQUILLA, PARQUE WASHINGTON, CENTRO COMERCIAL ROYAL WASHIGNTON CARRERA 53 NO 79-279">BARRANQUILLA, PARQUE WASHINGTON, CENTRO COMERCIAL ROYAL WASHIGNTON CARRERA 53 NO 79-279</option>
                <option value="BARRANQUILLA, VIVA BARRANQUILLA, CRA 51B NO 87 - 50 - CENTRO COMERCIAL VIVA">BARRANQUILLA, VIVA BARRANQUILLA, CRA 51B NO 87 - 50 - CENTRO COMERCIAL VIVA</option>
                <option value="BARRANQUILLA, MIRAMAR, CRA 43 # 99-50 CC MIRAMAR PISO 3 LOCAL 301-302">BARRANQUILLA, MIRAMAR, CRA 43 # 99-50 CC MIRAMAR PISO 3 LOCAL 301-302</option>
                <option value="BARRANQUILLA, RECREO, CRA. 43 NO. 60-25 BARRANQUILLA - COLOMBIA">BARRANQUILLA, RECREO, CRA. 43 NO. 60-25 BARRANQUILLA - COLOMBIA</option>
                <option value="BARRANQUILLA, SOLEDAD, CARRERA 32 N 30 15 PISO 3 C,C GRAN PLAZA DEL SOL">BARRANQUILLA, SOLEDAD, CARRERA 32 N 30 15 PISO 3 C,C GRAN PLAZA DEL SOL</option>
                <option value="BARRANQUILLA, MURILLO, CALLE. 45 (MURILLO) NO. 21-18 PISO 2 ,3 ,4| BARRANQUILLA - COLOMBIA">BARRANQUILLA, MURILLO, CALLE. 45 (MURILLO) NO. 21-18 PISO 2 ,3 ,4| BARRANQUILLA - COLOMBIA</option>
                <option value="BUCARAMANGA, CARACOLI, CARRERA 27 N 29 145 LOCAL 503 PARQUE CARACOLI">BUCARAMANGA, CARACOLI, CARRERA 27 N 29 145 LOCAL 503 PARQUE CARACOLI</option>
                <option value="BUCARAMANGA, CACIQUE, TRANSVERSAL 93 #34 99 CENTRO COMERCILAL CACIQUE LOCAL 420">BUCARAMANGA, CACIQUE, TRANSVERSAL 93 #34 99 CENTRO COMERCILAL CACIQUE LOCAL 420</option>
                <option value="BUCARAMANGA, MEGAMALL, CARRERA 33 A # 30A 19 LOCAL 301">BUCARAMANGA, MEGAMALL, CARRERA 33 A # 30A 19 LOCAL 301</option>
                <option value="CALI, OESTE, CALLE 7 OESTE # 1A - 59 BARRIO SANTA TERESITA ">CALI, OESTE, CALLE 7 OESTE # 1A - 59 BARRIO SANTA TERESITA </option>
                <option value="CALI, JARDIN PLAZA, CARRERA 98 #16-200 LOC.202 C,C JARDIN PLAZA">CALI, JARDIN PLAZA, CARRERA 98 #16-200 LOC.202 C,C JARDIN PLAZA</option>
                <option value="CALI, CHIPICHAPE, CALLE 38 N # 6N - 35 LOCAL 8-246. CENTRO COMERCIAL CHIPICHAPE">CALI, CHIPICHAPE, CALLE 38 N # 6N - 35 LOCAL 8-246. CENTRO COMERCIAL CHIPICHAPE</option>
                <option value="CALI, CANEY, CALLE 48# 85-54">CALI, CANEY, CALLE 48# 85-54</option>
                <option value="CALI, LIMONAR, CALLE 5 #69-09 CENTRO COMERCIAL PREMIER LIMONAR LOCAL 401">CALI, LIMONAR, CALLE 5 #69-09 CENTRO COMERCIAL PREMIER LIMONAR LOCAL 401</option>
                <option value="CARTAGENA, BOCAGRANDE, BOCAGRANDE AV EL MALECON CC. PLAZA BOCAGRANDE PISO 5 ">CARTAGENA, BOCAGRANDE, BOCAGRANDE AV EL MALECON CC. PLAZA BOCAGRANDE PISO 5 </option>
                <option value="CARTAGENA, CARIBE PLAZA, CLL. 29D NO. 22-62 LOCAL 225 | CARTAGENA - COLOMBIA BARRIO PIE DE LA POPA">CARTAGENA, CARIBE PLAZA, CLL. 29D NO. 22-62 LOCAL 225 | CARTAGENA - COLOMBIA BARRIO PIE DE LA POPA</option>
                <option value="CARTAGENA, PLAZUELA, C.C. LA PLAZUELA CALLE 71 #29 -236 LOCALES 1-5 ">CARTAGENA, PLAZUELA, C.C. LA PLAZUELA CALLE 71 #29 -236 LOCALES 1-5 </option>
                <option value="CARTAGENA, EJECUTIVOS, SUPER CENTRO LOS EJECUTIVOS 2 PISO CALLE 31#57-106">CARTAGENA, EJECUTIVOS, SUPER CENTRO LOS EJECUTIVOS 2 PISO CALLE 31#57-106</option>
                <option value="MEDELLIN, SANTA MARIA DE LOS ÁNGELES, CRA 46 # 16 SUR-67 ">MEDELLIN, SANTA MARIA DE LOS ÁNGELES, CRA 46 # 16 SUR-67 </option>
                <option value="MEDELLIN, VIZCAYA, CLL 10 # 32-115 INT 127 ">MEDELLIN, VIZCAYA, CLL 10 # 32-115 INT 127 </option>
                <option value="MEDELLIN, RIO SUR, CRA 43A N° 6 SUR - 26 CC. RÍO SUR - PISO 6">MEDELLIN, RIO SUR, CRA 43A N° 6 SUR - 26 CC. RÍO SUR - PISO 6</option>
                <option value="MEDELLIN, LLANOGRANDE, CENTRO COMERCIAL JARDINES DE LLANOGRANDE">MEDELLIN, LLANOGRANDE, CENTRO COMERCIAL JARDINES DE LLANOGRANDE</option>
                <option value="MEDELLIN, MALL DEL ESTE, CRA 25 # 3-45 SOTANO 3">MEDELLIN, MALL DEL ESTE, CRA 25 # 3-45 SOTANO 3</option>
                <option value="MEDELLIN, SAN LUCAS, CLL 20 SUR # 27-115 SÓTANO 4 ">MEDELLIN, SAN LUCAS, CLL 20 SUR # 27-115 SÓTANO 4 </option>
                <option value="MEDELLIN, VILLAGRANDE, TRANS 27 A SUR 42B 60">MEDELLIN, VILLAGRANDE, TRANS 27 A SUR 42B 60</option>
                <option value="MEDELLIN, LAURELES, CLL 66B # 32 D - 36">MEDELLIN, LAURELES, CLL 66B # 32 D - 36</option>
                <option value="MEDELLIN, AMERICAS, DG 75B   2A-120 L.227">MEDELLIN, AMERICAS, DG 75B   2A-120 L.227</option>
                <option value="MEDELLIN, CITY PLAZA, CLL 36D SUR N 27A-105 LC 340">MEDELLIN, CITY PLAZA, CLL 36D SUR N 27A-105 LC 340</option>
                <option value="MEDELLIN, PREMIUM PLAZA, CRA 42 A # 30 - 25 LC 3189">MEDELLIN, PREMIUM PLAZA, CRA 42 A # 30 - 25 LC 3189</option>
                <option value="MEDELLIN, ROBLEDO, CRA 80 N° 64 – 61 INTERIOR ÉXITO ROBLEDO  ">MEDELLIN, ROBLEDO, CRA 80 N° 64 – 61 INTERIOR ÉXITO ROBLEDO  </option>
                <option value="MEDELLIN, SAN JUAN, CRA 84 # 44-54 INT. 201">MEDELLIN, SAN JUAN, CRA 84 # 44-54 INT. 201</option>
                <option value="MEDELLIN, CAMINO REAL, AV. ORIENTAL CRA. 46 NO. 52 - 95 LC 401">MEDELLIN, CAMINO REAL, AV. ORIENTAL CRA. 46 NO. 52 - 95 LC 401</option>
                <option value="MEDELLIN, AVENIDA COLOMBIA, CLL 50 # 66-50">MEDELLIN, AVENIDA COLOMBIA, CLL 50 # 66-50</option>
                <option value="MEDELLIN, ENVIGADO, DG 40 # 33 SUR 48">MEDELLIN, ENVIGADO, DG 40 # 33 SUR 48</option>
                <option value="MEDELLIN, NIQUIA, CC TIERRAGRO DIA 50 A # 38- 20, BELLO">MEDELLIN, NIQUIA, CC TIERRAGRO DIA 50 A # 38- 20, BELLO</option>
                <option value="MEDELLIN, BELEN, CLL 32 # 75-50 ">MEDELLIN, BELEN, CLL 32 # 75-50 </option>
                <option value="MONTERIA, NUESTRO MONTERIA, TRANSVERSAL 29 # 29-69 CENTRO COMERCIAL NUESTRO MONTERIA">MONTERIA, NUESTRO MONTERIA, TRANSVERSAL 29 # 29-69 CENTRO COMERCIAL NUESTRO MONTERIA</option>
                <option value="RIONEGRO, LLANOGRANDE, CENTRO COMERCIAL JARDINES DE LLANOGRANDE">RIONEGRO, LLANOGRANDE, CENTRO COMERCIAL JARDINES DE LLANOGRANDE</option>
                <option value="PASTO, PASTO, CALLE 22B # 2 - 63//67 ÉXITO PANAMERICA">PASTO, PASTO, CALLE 22B # 2 - 63//67 ÉXITO PANAMERICA</option>
                <option value="PALMIRA, PALMIRA, CALLE 31 # 44-239 LLANOGRANDE PLAZA">PALMIRA, PALMIRA, "CALLE 31 # 44-239 LLANOGRANDE PLAZA</option>
                <option value="PEREIRA, PEREIRA, AV CIRCUNVALAR CRA 13 Nº 12 B-25 EDIFICIO UNIPLEX PISO 5 Y 6">PEREIRA, PEREIRA, AV CIRCUNVALAR CRA 13 Nº 12 B-25 EDIFICIO UNIPLEX PISO 5 Y 6</option>
                <option value="PEREIRA, DOS QUEBRADAS, CARRERA 16 # 43 CC EL PROGRESO LOCAL 208">PEREIRA, DOS QUEBRADAS, CARRERA 16 # 43 CC EL PROGRESO LOCAL 208</option>
                <option value="TUNJA, CALLE 37 N. 6-20">TUNJA, CALLE 37 N. 6-20</option>
                <option value="TULUA, TULUA, CRA 40 #37-51 CENTRO COMERCIAL TULUA LA 14 LOCAL MESANINE H">TULUA, TULUA, CRA 40 #37-51 CENTRO COMERCIAL TULUA LA 14 LOCAL MESANINE H</option>
                <option value="MANIZALES, SANCANCIO, C.C. SANCANCIO CRA 27A # 66 - 30 ">MANIZALES, SANCANCIO, C.C. SANCANCIO CRA 27A # 66 - 30 </option>
                <option value="CUCUTA, CAOBOS, CALLE 11 # 2E-10 BARRIO CAOBOS CENTRO COMERCILA QUINTA VELEZ (3) PISO LOCAL 301">CUCUTA, CAOBOS, CALLE 11 # 2E-10 BARRIO CAOBOS CENTRO COMERCILA QUINTA VELEZ (3) PISO LOCAL 301</option>
                <option value="IBAGUE, IBAGUE, CLL 60 CON AV AMBALA CENTRO COMERCIASL LA ESTACION LOCAL 302">IBAGUE, IBAGUE, CLL 60 CON AV AMBALA CENTRO COMERCIASL LA ESTACION LOCAL 302</option>
                <option value="VALLEDUPAR, MAYALES, CENTRO COMERCIAL MAYALES CALLE 31 NO 6-133">VALLEDUPAR, MAYALES, CENTRO COMERCIAL MAYALES CALLE 31 NO 6-133</option>
                <option value="VILLAVICENCIO, LLANOCENTRO, CRA 39 C N°29C-15 BARRIO BALATA CC LLANOCENTRO LOCAL 3001">VILLAVICENCIO, LLANOCENTRO, CRA 39 C N°29C-15 BARRIO BALATA CC LLANOCENTRO LOCAL 3001</option>
                <option value="VILLAVICENCIO, VIVA VILLAVICENCIO, CALLE 7#45-185 CENTRO COMERCIAL VIVA VILLAVICENCIO BARRIO LA ESPERANZA">VILLAVICENCIO, VIVA VILLAVICENCIO, CALLE 7#45-185 CENTRO COMERCIAL VIVA VILLAVICENCIO BARRIO LA ESPERANZA</option>
                <option value="NEIVA, NEIVA, KRA 8A N- 38-42 C.C SAN PEDRO PLAZA LOCAL 291">NEIVA, NEIVA, KRA 8A N- 38-42 C.C SAN PEDRO PLAZA LOCAL 291</option>
              </select>
            </div>


            <div class="modal-footer">
              <button type="reset" class="btn btn-default " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-ok"></span> Crear</button>
            </div>

          </form>


        </div>
      </div>
    </div>
  </div>


<?php
} else {
  echo 'No tiene acceso. ';
} ?>
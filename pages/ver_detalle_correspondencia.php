<?php
session_start();
if (isset($_POST['option']) and "" != $_POST['option']) {



  require_once('../conf.php');
  $actualizar6 = mysql_query("SELECT valor FROM configuracion WHERE id_configuracion=14 limit 1", $conexion);
  $row16 = mysql_fetch_assoc($actualizar6);
  $valor = $row16['valor'];

  if (0 == $valor) { ?>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>El sistema de gestión documental se encuentra en mantenimiento. Lamentamos el inconveniente.</h4>
            <br>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {

    require_once('listas.php');
    $nump36 = privilegios(36, $_SESSION['snr']);
    $nump25 = privilegios(25, $_SESSION['snr']);
    $nump26 = privilegios(26, $_SESSION['snr']);
    $nump27 = privilegios(27, $_SESSION['snr']);
    $nump28 = privilegios(28, $_SESSION['snr']);
    $nump29 = privilegios(29, $_SESSION['snr']);
    $nump30 = privilegios(30, $_SESSION['snr']);


    $nump38 = privilegios(38, $_SESSION['snr']);
    $nump39 = privilegios(39, $_SESSION['snr']);
    $nump40 = privilegios(40, $_SESSION['snr']);
    $nump41 = privilegios(41, $_SESSION['snr']);
    $nump42 = privilegios(42, $_SESSION['snr']);
    $nump43 = privilegios(43, $_SESSION['snr']);


    $nump44 = privilegios(44, $_SESSION['snr']);
    $nump47 = privilegios(47, $_SESSION['snr']);
    $nump45 = privilegios(45, $_SESSION['snr']);
    $nump48 = privilegios(48, $_SESSION['snr']);
    $nump46 = privilegios(46, $_SESSION['snr']);
    $nump49 = privilegios(49, $_SESSION['snr']);

    // DEVOLUCIONES DE DINERO
    $nump56 = privilegios(56, $_SESSION['snr']);  // ADM TESORERIA
    $nump57 = privilegios(57, $_SESSION['snr']);  // ADM PRESUPUESTO
    $nump58 = privilegios(58, $_SESSION['snr']);  // ADM CONTABILIDAD
    $nump59 = privilegios(59, $_SESSION['snr']);  // USU PRESUPUESTO
    $nump60 = privilegios(60, $_SESSION['snr']);  // USU CONTABILIDAD
    $nump61 = privilegios(61, $_SESSION['snr']);  // USU TESORERIA


    $radicado2 = $_POST['option'];
  ?>

    <header>
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
      <script>
        $(document).ready(function() {
          $("#e1").select2();
        });
      </script>
    </header>


    <?php


    function saberestado($codee)
    {
      if (1 == $codee) {
        $estadoiris = 'ACTIVO';
      } else if (2 == $codee) {
        $estadoiris = 'INACTIVO';
      } else if (3 == $codee) {
        $estadoiris = 'PRESTADO';
      } else if (4 == $codee) {
        $estadoiris = 'EN PROCESO';
      } else if (5 == $codee) {
        $estadoiris = 'Recibido';
      } else if (6 == $codee) {
        $estadoiris = 'Enviado';
      } else if (7 == $codee) {
        $estadoiris = 'ATRASADO';
      } else if (13 == $codee) {
        $estadoiris = 'Para Reasignar';
      } else if (14 == $codee) {
        $estadoiris = 'Para Enviar';
      } else if (15 == $codee) {
        $estadoiris = 'Enviada';
      } else if (8 == $codee) {
        $estadoiris = 'Radicada';
      } else if (10 == $codee) {
        $estadoiris = 'Listada';
      } else if (11 == $codee) {
        $estadoiris = 'Mostrada';
      } else if (12 == $codee) {
        $estadoiris = 'Reasignada';
      } else if (16 == $codee) {
        $estadoiris = 'CONTESTADA';
      } else if (19 == $codee) {
        $estadoiris = 'PARA PLANILLA';
      } else if (20 == $codee) {
        $estadoiris = 'Interna';
      } else if (17 == $codee) {
        $estadoiris = 'ATRASADA';
      } else {
        $estadoiris = '';
      }
      return $estadoiris;
    }



    $conexionpostgresql = pg_connect($conexionpostgres);
    if (!$conexionpostgresql) {
      echo 'No se puede conectar con IRIS.';
    } else {


      $res = pg_query("SELECT idcorrespondencia, referencia, asunto, de, para, fcreado, descripcion, idestado, paraint, idtipodocumento, deint  FROM correspondencia where codigo='$radicado2' limit 1");
      while ($row = pg_fetch_row($res)) {
        $idcorrespondencia2 = $row[0];
        $referencia2 = $row[1];
        $asunto2 = $row[2];
        $de2 = $row[3];
        $para2 = $row[4];
        $fcreado2 = $row[5];
        $descripcion2 = $row[6];
        $idestado2 = $row[7];
        $paraint2 = $row[8];
        $idtipodocumento2 = $row[9];
        $deint2 = $row[10];
      }

      $docm = intval($idcorrespondencia2);
	  
	  
      $radicado = '<b>Radicado</b>: ' . $radicado2;
      $referencia = '<br><b>Referencia</b>: ' . $referencia2;
      $asunto = '<br><b>Asunto</b>: ' . $asunto2;
      $de = '<br><b>De</b>: ' . $de2;
      $para = '<br><b>Para</b>: ' . $para2;
      $fcreado = '<br><b>Creado</b>: ' . $fcreado2;
      $idestado = saberestado($idestado2);
      $descripcion = '<br><b>Descripción</b>: ' . $descripcion2 . '<br><br>';
      $idtipodocumento = intval($idtipodocumento2);


      $infofun2 = explode(",", $paraint2);
      $infofun = intval($infofun2[1]);

      $infode2 = explode(",", $deint2);
      $infode = intval($infode2[1]);


      pg_free_result($res);
      pg_close($conexionpostgresql);
    }


    ?>

    <div style="margin:5px 20px 20px 10px;padding:5px 20px 20px 10px;">
      <?php
      if (1 == $_SESSION['rol'] or 0 < $nump36) {
        echo '<form  action=""  method="POST" name="f5">
        <input type="hidden" name="radicado_re" value="' . $radicado2 . '">
        <input type="hidden" name="reasignar-funcionario" value="2471-ARCHIVO SISG BORRADO"><input type="submit" value="Archivar"></form>';
      } else {
      }


      echo '<form  action=""  method="POST" name="f5465443545343454sfg1ftregg" enctype="multipart/form-data">';
      echo $radicado;



      $queryop = sprintf("SELECT count(id_correspondencia) as totc FROM correspondencia where nombre_correspondencia='$radicado2'");
      $selectop = mysql_query($queryop, $conexion);
      $rowop = mysql_fetch_assoc($selectop);
      if (0 < $rowop['totc']) {
      } else {

        if (1 == $_SESSION['rol'] or 0 < $nump36) {

          echo '<input type="hidden" name="radicado_insertar" value="' . $radicado2 . '">';
          echo '<input type="hidden" name="asunto_insertar" value="' . $asunto2 . ' ' . $de2 . '">';
          echo '<input type="hidden" name="referencia_insertar" value="' . $referencia2 . '">';
          echo '<input type="hidden" name="fcreado_insertar" value="' . $fcreado2 . '">';
          echo '<input type="hidden" name="descripcion_insertar" value="' . $descripcion2 . '">';
          echo '<input type="hidden" name="tipodocumento_insertar" value="' . $idtipodocumento2 . '">';
          echo ' <button type="submit" class="btn btn-xs btn-success" >Insertar en SISG</button>';
        } else {
        }
      }
      mysql_free_result($selectop);

      echo '</form>';
      echo $idcorrespondencia;
      echo $referencia;
      echo $asunto;
      if (1 == $_SESSION['rol'] or 0 < $nump36) {
        echo '<form  action=""  method="POST" name="f54654343454s343fg1ftregg" enctype="multipart/form-data">';
        echo '<input type="hidden" name="radicado_asunto_cambio" value="' . $radicado2 . '">';
        echo '<b>Cambiar asunto: </b><input name="asunto_cambio" style="width:350px;" required value="' . $asunto2 . '">';
        echo '<button type="submit" class="btn btn-xs btn-warning" >Cambiar</button></form>';
      } else {
      }




      echo $de;
      echo $para;
      echo '/' . $paraint2;
      echo '<br><b>Tipo de documento: </b>';
      echo tipodociris($idtipodocumento);

      if (1 == $_SESSION['rol'] or 0 < $nump36) {
        echo '<form  action=""  method="POST" name="f5465454sfg1ftregg" enctype="multipart/form-data">';
        echo '<input type="hidden" name="radicado_update_tipo_doc" value="' . $radicado2 . '">';
        echo '<b>Cambiar tipo a: </b><select name="id_tipo_documento_cambio" required><option value="" selected></option>';

        $queryb = sprintf("SELECT * FROM tipo_documento_iris where estado_tipo_documento_iris=1 order by nombre_tipo_documento_iris");
        $selectb = mysql_query($queryb, $conexion);
        $rowb = mysql_fetch_assoc($selectb);
        $totalRowsb = mysql_num_rows($selectb);
        do {
          echo '<option value="' . $rowb['idtipodocumento'] . '">' . $rowb['nombre_tipo_documento_iris'] . '</option>';
        } while ($rowb = mysql_fetch_assoc($selectb));
        mysql_free_result($selectb);
        echo '</select><button type="submit" class="btn btn-xs btn-warning" >Cambiar</button></form>';
      } else {
      }



      echo $fcreado;
      echo '<br><b>Estado: </b>';
      echo $idestado;
      echo $descripcion;

      if (('0' != $_SESSION['username_iris']) && ($infofun == $_SESSION['idiris'] or 1 == $_SESSION['rol'] or 0 < $nump36)) {
        //if (1==$_SESSION['rol'] or 0<$nump36 or 1661==$_SESSION['snr']) {
        echo '<form  action=""  method="POST" name="for3243234234m353454sfg1ftregg" id="formacorrespondencia">'; //<input type="text" name="cambio" readonly="readonly" data-toggle="modal" data-target="#directivos">';
        echo '<input type="hidden" name="paraint_re" value="' . $paraint2 . '">';
        echo '<input type="hidden" name="para_re" value="' . $para2 . '">';
        echo '<input type="hidden" name="radicado_re" value="' . $radicado2 . '">';


        echo '<b>Reasignar a:</b> <select class="select2correspondencia" style="width:330px;" name="reasignar-funcionario" required>
        <option value=""></option>';
        $query = sprintf("SELECT * FROM usuario_iris where estado_usuario_iris=1 order by nombre_usuario_iris");
        $select = mysql_query($query, $conexion);
        $row = mysql_fetch_assoc($select);
        $totalRows = mysql_num_rows($select);
        if (0 < $totalRows) {
          do {
            echo '<option value="' . $row['codigo_usuario_iris'] . '-' . $row['nombre_usuario_iris'] . '">' . $row['nombre_usuario_iris'] . ' ' . $row['desc'] . '</option>';
          } while ($row = mysql_fetch_assoc($select));
        } else {
        }
        mysql_free_result($select);

        echo '</select>';
        echo '<button type="submit" class="btn btn-xs btn-warning" >Reasignar</button></form><hr>';
      } else {
      }




      $querybv = sprintf("SELECT count(id_correspondencia) as permi FROM correspondencia where nombre_correspondencia='$radicado2' and id_supervisor=" . $_SESSION['snr'] . " and estado_correspondencia=1");
      $selectbv = mysql_query($querybv, $conexion);
      $rowbv = mysql_fetch_assoc($selectbv);
      $supervisor = intval($rowbv['permi']);
      mysql_free_result($selectbv);

      if (450 == $_SESSION['snr']) {
        /*echo '1'.$_SESSION['snr'];
	echo '2'.$_SESSION['username_iris'];
	echo '3'.$infode;
	echo '4'.$_SESSION['idiris'];
	*/
      } else {
      }
      
      if (2 == $_SESSION['snr_tipo_oficina']) {
        $_SESSION['username_iris'] = 'SISG OTI';
        $privOrip = 0 < privreg($_SESSION['id_oficina_registro'], $_SESSION['snr'], 3, 8);
      } else {
        $_SESSION['username_iris'] = $_SESSION['username_iris'];
        $privOrip = 0;
      }

      if (('0' != $_SESSION['username_iris']) && (1 == $_SESSION['rol'] or
        40 == $_SESSION['snr_grupo_area'] or
        0 < $supervisor or
        ($infode == $_SESSION['idiris']) or
        (311 == $idtipodocumento and  (0 < $nump38 or 0 < $nump39 or 0 < $nump40 or 0 < $nump41 or 0 < $nump42 or 0 < $nump43)) or
        (305 == $idtipodocumento and (0 < $nump25 or 0 < $nump26 or 0 < $nump27 or 0 < $nump28  or 0 < $nump29 or 0 < $nump30)) or
        (123 == $idtipodocumento and (0 < $nump44 or 0 < $nump45 or 0 < $nump46 or 0 < $nump47  or 0 < $nump48 or 0 < $nump49)) or
        (308 == $idtipodocumento and (0 < $nump56 or 0 < $nump57 or 0 < $nump58 or 0 < $nump59  or 0 < $nump60 or 0 < $nump61 or 0 < $privOrip))
      )) { ?>
        <form action="" method="POST" name="for343543m353454sfg1ftregg" enctype="multipart/form-data">
          <div class="input-group">
            <span class="input-group-addon">
              <select name="id_tipo_documento_anexo" required>
                <option value="" selected>-- Tipo de adjunto --</option>
                <!--
                <option value="1" >Interno Enviado IE</option>
                <option value="2" >Externo Enviado EE</option>
                <option value="3" >Externo Recibido ER</option>
                -->
                <?php
                if (
                  1 == $_SESSION['rol'] or
                  40 == $_SESSION['snr_grupo_area'] or
                  ($infode == $_SESSION['idiris']) or
                  (311 == $idtipodocumento and (0 < $nump38 or 0 < $nump39 or 0 < $nump40 or 0 < $nump41 or 0 < $nump42 or 0 < $nump43)) or
                  (305 == $idtipodocumento and (0 < $nump25 or 0 < $nump26 or 0 < $nump27 or 0 < $nump28  or 0 < $nump29 or 0 < $nump30)) or
                  (123 == $idtipodocumento and (0 < $nump44 or 0 < $nump45 or 0 < $nump46 or 0 < $nump47  or 0 < $nump48 or 0 < $nump49)) or
                  (308 == $idtipodocumento and (0 < $nump56 or 0 < $nump57 or 0 < $nump58 or 0 < $nump59  or 0 < $nump60 or 0 < $nump61 or 0 < $privOrip))
                ) { ?>
                  <option value="4">Documento / Anexo</option>
                <?php } else {
                }
                if (311 == $idtipodocumento and (1 == $_SESSION['rol'] or 0 < $supervisor or 0 < $nump25 or 0 < $nump26 or 0 < $nump38 or 0 < $nump41 or 0 < $nump36 or 40 == $_SESSION['snr_grupo_area'])) { ?>
                  <option value="9">Certificación de cumplimiento</option>
                <?php  } else {
                }
                if (1 == $_SESSION['rol'] or 0 < $nump25 or 0 < $nump26 or 0 < $nump38 or 0 < $nump41 or 0 < $nump44) { ?>
                  <option value="6">Factura equivalente</option>
                <?php } else {
                }
                if (1 == $_SESSION['rol'] or 0 < $nump25 or 0 < $nump26 or 0 < $nump38 or 0 < $nump41 or 0 < $nump44 or 0 < $nump58 or 0 < $nump60) { ?>
                  <option value="5"><?php if (0 < $nump58 or 0 < $nump60) { echo 'Acreedor /'; } ?> Cuenta por pagar</option>
                <?php } else {
                }
                if (1 == $_SESSION['rol'] or 0 < $nump27 or 0 < $nump28 or 0 < $nump39 or 0 < $nump42 or 0 < $nump44) { ?>
                  <option value="7">Obligaciones</option>
                <?php } else {
                }
                if (1 == $_SESSION['rol'] or 0 < $nump29 or 0 < $nump30 or 0 < $nump40 or 0 < $nump43 or 0 < $nump44 or 0 < $nump56 or 0 < $nump61) { ?>
                  <option value="8">Orden de pago</option>
                <?php } else {
                }
                if (1 == $_SESSION['rol'] or 0 < $privOrip) { ?>
                  <option value="10">Devolución completa</option>
                <?php } else {
                }
                if (1 == $_SESSION['rol']) { ?>
                  <option value="11">Aclaración de devolución</option>
                <?php } else {
                }
                if (1 == $_SESSION['rol'] or 0 < $nump57 or 0 < $nump59) { ?>
                  <option value="12">Vinculacion de Cuenta</option>
                <?php } else {
                }
                if (1 == $_SESSION['rol']) { ?>
                  <option value="13">Documento Reclasificación</option>
                <?php } else {
                } ?>

              </select>
            </span>
            <span class="input-group-addon" style="width:80%">
              <input type="file" name="file" id="file" required onchange="return fileValidation2()">
              <input type="hidden" name="idcorrespondencia_anexa" value="<?php echo $docm; ?>">
			  <input type="hidden" name="idparaint" value="<?php echo $infofun; ?>">
              <input type="hidden" name="radicadou" value="<?php echo $radicado2; ?>">
            </span>
            <span class="input-group-addon">

              <button type="submit" class="btn btn-xs btn-success"> Anexar </button>

            </span>
          </div>
        </form>

        <br>
      <?php } else {
      } ?>


  <?php

    function saberdoc($coda)
    {
      if (1 == $coda) {
        $estadod = 'Interno Enviado';
      } else if (2 == $coda) {
        $estadod = 'Externo Enviado';
      } else if (3 == $coda) {
        $estadod = 'Externo Recibido';
      } else if (4 == $coda) {
        $estadod = 'Anexo';
      } else if (5 == $coda) {
        $estadod = 'Cuenta por pagar';
      } else if (6 == $coda) {
        $estadod = 'Factura equivalente';
      } else if (7 == $coda) {
        $estadod = 'Obligaciones';
      } else if (8 == $coda) {
        $estadod = 'Orden de pago';
      } else if (9 == $coda) {
        $estadod = 'Certificado de cumplimiento';
      } else if (10 == $coda) {
        $estadod = 'Devolución completa';
      } else if (11 == $coda) {
        $estadod = 'Aclaración de devolución';
      } else if (12 == $coda) {
        $estadod = 'Vinculacion de Cuenta';
      } else if (13 == $coda) {
        $estadod = 'Documento Reclasificaciòn';
      } else {
        $estadod = '';
      }
      return $estadod;
    }


    $conexionpostgresql = pg_connect($conexionpostgres);
    if (!$conexionpostgresql) {
      echo 'No se puede conectar con IRIS.';
    } else {

      $consultab = "select nombre, creado, fcreado from correspondenciacontenido WHERE idcorrespondencia='$docm'";
      $resultado = pg_query($consultab);
      $num_resultados = pg_num_rows($resultado);


      $num_resultados2 = $num_resultados - 1;



      echo 'Adjuntos: ' . $num_resultados . '  <br />';



      if (0 < $num_resultados) {


        for ($i = 0; $i < $num_resultados; $i++) {
          $row = pg_fetch_array($resultado);

          $numb = $i + 1;

          echo '<a href="pdfview/?q=' . base64_encode($docm) . '_' . base64_encode($row["nombre"]) . '.pdf" target="_blank" style="text-decoration:none;"><img src="../images/pdf.png"> Documento adjunto ' . $numb . ' </a>';

          if (1 == $_SESSION['guardar_pdf'] or 1 == $_SESSION['rol']) {
            echo ' / <a title="' . $docm . '" href="file_sgd/?q=' . base64_encode($docm) . '_' . base64_encode($row["nombre"]) . '.pdf" download="Documento.pdf" style="color:#ED1C27;">  Descargar </a>';
          } else {
          }


          if (1642 == $row["creado"]) {
            $archid = explode("-", $row["nombre"]);
            $narchi = $archid[0];
            echo ' / ';
            echo saberdoc($narchi);

            echo ' - ' . $row["fcreado"];
          } else {
          }


          echo '<br>';
        }


        pg_free_result($resultado);
        pg_close($conexionpostgresql);
      }
    }




    echo '</div>';
	?>
	<script>
	$(document).ready(function() {
            $(".select2correspondencia").select2({
                dropdownParent: $('#formacorrespondencia')
            });
        });
	
	</script>
	
	<?php
  }

  mysql_free_result($actualizar6);
} else {
}

  ?>
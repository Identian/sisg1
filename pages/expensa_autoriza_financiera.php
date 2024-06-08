<?php
$AprobarFinanciero = privilegios(34, $_SESSION['snr']);
if (1 == $_SESSION['rol'] or 0 < $AprobarFinanciero) {

  if (
    isset($_POST['editarnotacredito']) and '' != $_POST['editarnotacredito'] and
    isset($_POST['accionnotacredito']) and '' != $_POST['accionnotacredito'] and
    isset($_POST['id_expensa_fac']) and '' != $_POST['id_expensa_fac']
  ) {

    $idFacExpensa = $_POST['id_expensa_fac'];
    if (1 == $_POST['accionnotacredito']) {
      $updatenota = sprintf(
        "UPDATE expensa_fac SET 
        fijo_expensa_fac=%s, 
        vari_expensa_fac=%s, 
        uni_expensa_fac=%s,
        nota_credito_fac=%s
        WHERE id_expensa_fac=%s",
        GetSQLValueString($_POST['fijo_expensa_fac'], "text"),
        GetSQLValueString($_POST['vari_expensa_fac'], "text"),
        GetSQLValueString($_POST['uni_expensa_fac'], "text"),
        GetSQLValueString(1, "int"),
        GetSQLValueString($idFacExpensa, "int")
      );
      $Resultnota = mysql_query($updatenota, $conexion) or die(mysql_error());

      if (0 < $Resultnota) {
        date_default_timezone_set("America/Bogota");
        $fechaAhora = date("Y-m-d H:i:s");
        $updatenota = sprintf(
          "UPDATE expensa_nota_credito SET 
          fecha_autoriza=%s,
          estados=%s
          WHERE id_expensa_fac=%s",
          GetSQLValueString($fechaAhora, "text"),
          GetSQLValueString(1, "int"),
          GetSQLValueString($idFacExpensa, "int")
        );
        $Resultnota = mysql_query($updatenota, $conexion) or die(mysql_error());
        echo $actualizado;
      }
    } elseif (2 == $_POST['accionnotacredito']) {
      date_default_timezone_set("America/Bogota");
      $fechaAhora = date("Y-m-d H:i:s");
      $updatenota2 = sprintf(
        "UPDATE expensa_nota_credito SET 
        fecha_autoriza=%s,
        estados=%s
        WHERE id_expensa_fac=%s",
        GetSQLValueString($fechaAhora, "text"),
        GetSQLValueString(2, "int"),
        GetSQLValueString($idFacExpensa, "int")
      );
      $Resultnota2 = mysql_query($updatenota2, $conexion) or die(mysql_error());
      if (0 < $Resultnota2) {
        $updatenota3 = sprintf(
          "UPDATE expensa_fac SET 
        nota_credito_fac=%s
        WHERE id_expensa_fac=%s",
          GetSQLValueString(2, "int"),
          GetSQLValueString($idFacExpensa, "int")
        );
        $Resultnota3 = mysql_query($updatenota3, $conexion) or die(mysql_error());
        echo $actualizado;
      }
    }
  }

  // ADJUNTAR UN DOCUMENTO DEVOLUCION
  if (
    isset($_POST["editardevolucion"]) AND '' != $_POST["editardevolucion"] AND
    isset($_POST["acciondevolucion"]) AND '' != $_POST["acciondevolucion"] AND
    isset($_POST["id_expensa_devolucion"]) AND '' != $_POST["id_expensa_devolucion"]
  ) {
    $tamano_archivo = 4194304;
    $formato_archivo = array('pdf');
    $carpeta_archivo = "files/expensa_curadurias/";
    $ruta_archivo = date("YmdGis") . '-' . $_POST["id_expensa_devolucion"] . '-' . 'Devolucion' . '-' . base64_encode($_FILES['file']['tmp_name']);

    if (1 == $_POST["acciondevolucion"]) {

      if ("" != $_FILES['file']['tmp_name']) {
        $archivo = $_FILES['file']['tmp_name'];
        $tam_archivo = filesize($archivo);
        $tam_archivo2 = $_FILES['file']['size'];
        $nombre = strtolower($_FILES['file']['name']);
        $info = pathinfo($nombre);
        $extension = $info['extension'];
        $array_archivo = explode('.', $nombre);
        $extension2 = end($array_archivo);

        if (($tam_archivo == $tam_archivo2) and ($tamano_archivo > $tam_archivo)) {
          if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
            $files = $ruta_archivo . '.' . $extension;
            $mover_archivos = move_uploaded_file($archivo, $carpeta_archivo . $files);
            $nombrebre_orig = ucwords($nombre);
            $hash = md5($files);

            date_default_timezone_set("America/Bogota");
            $fechaAhora = date("Y-m-d H:i:s");
            $updatedoc = sprintf(
              "UPDATE expensa_devolucion SET 
            ulr_expensa_devolucion=%s, 
            hash_expensa_devolucion=%s,
            fecha_autoriza=%s,
            estado=%s
            WHERE id_expensa_devolucion=%s and estado_expensa_devolucion=1",
              GetSQLValueString($files, "text"),
              GetSQLValueString($hash, "text"),
              GetSQLValueString($fechaAhora, "date"),
              GetSQLValueString(1, "text"),
              GetSQLValueString($_POST["id_expensa_devolucion"], "int")
            );
            $Resultdoc = mysql_query($updatedoc, $conexion) or die(mysql_error());
            echo $documentocargado;
          } else {
            $valido = 0;
            echo  $doc_no_tipo;
          }
        }
      } else {
        $valido = 0;
        echo $doc_tam;
      }
    } elseif (2 == $_POST["acciondevolucion"]) {
      date_default_timezone_set("America/Bogota");
      $fechaAhora = date("Y-m-d H:i:s");
      $updatedoc = sprintf(
        "UPDATE expensa_devolucion SET 
        id_funcionario_aprobacion=%s,
        fecha_autoriza=%s,
        estado=%s
        WHERE id_expensa_devolucion=%s and estado_expensa_devolucion=1",
        GetSQLValueString($_SESSION['snr'], "int"),
        GetSQLValueString($fechaAhora, "date"),
        GetSQLValueString(2, "text"),
        GetSQLValueString($_POST["id_expensa_devolucion"], "int")
      );
      $Resultdoc = mysql_query($updatedoc, $conexion) or die(mysql_error());
      echo $actualizado;
    }
  }


?>


  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><b>NOTAS CREDITO</b></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

      <table class="table display" id="tablanotaCredito">
        <thead>
          <tr>
            <th>Concepto</th>
            <th>Curaduria</th>
            <th>Periodo</th>
            <th>Num Fac.</th>
            <th>Cargo Fijo</th>
            <th>cargo Vari</th>
            <th>Cargo Uni</th>
            <th>Fecha Radicado</th>
            <th>Anexo</th>
            <th>Fecha Autoriza</th>
            <th>Estado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT 
          expensa_nota_credito.nombre_expensa_nota_credito, 
          curaduria.nombre_curaduria,
          expensa_curaduria.id_expensa_curaduria,
          expensa_curaduria.fecha_inicio_expensa,
          expensa_curaduria.fecha_final_expensa,
          expensa_fac.num_expensa_fac, 
          expensa_fac.id_expensa_fac, 
          expensa_nota_credito.fijo_expensa_fac, 
          expensa_nota_credito.vari_expensa_fac, 
          expensa_nota_credito.uni_expensa_fac, 
          expensa_nota_credito.fecha_nota_credito,
          expensa_nota_credito.estados,
          expensa_nota_credito.fecha_autoriza,
          expensa_documento.url_expensa_documento
          FROM expensa_nota_credito
          LEFT JOIN expensa_fac
          ON expensa_nota_credito.id_expensa_fac=expensa_fac.id_expensa_fac
          LEFT JOIN expensa_curaduria
          ON expensa_fac.id_expensa_curaduria=expensa_curaduria.id_expensa_curaduria
          LEFT JOIN curaduria
          ON curaduria.id_curaduria=expensa_curaduria.id_curaduria
          LEFT JOIN expensa_documento
          ON expensa_fac.id_expensa_fac=expensa_documento.nombre_expensa_documento
          WHERE estado_expensa_nota_credito=1";
          $select = mysql_query($query, $conexion);
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
            do {
              echo '<tr>';
              echo '<td>' . $row['nombre_expensa_nota_credito'] . '</td>';
              echo '<td><a href="expensa&' . $row['id_expensa_curaduria'] . '.jsp" />' . $row['nombre_curaduria'] . '</a></td>';
              echo '<td>' . $row['fecha_inicio_expensa'] . ' | ' . $row['fecha_final_expensa'] . '</td>';
              echo '<td>' . $row['num_expensa_fac'] . '</td>';
              echo '<td>' . $row['fijo_expensa_fac'] . '</td>';
              echo '<td>' . $row['vari_expensa_fac'] . '</td>';
              echo '<td>' . $row['uni_expensa_fac'] . '</td>';
              echo '<td>' . $row['fecha_nota_credito'] . '</td>';
              echo '<td><a href="files/expensa_curadurias/' . $row['url_expensa_documento'] . '"/><img src="images/pdf.png"></a></td>';
              echo '<td>' . $row['fecha_autoriza'] . '</td>';
              echo '<td>';
              if (0 == $row['estados']) {
                echo '<span style="color:orange">Tramite</span>';
              } elseif (1 == $row['estados']) {
                echo '<span style="color:green"><b>Aprobado</b></span>';
              } elseif (2 == $row['estados']) {
                echo '<span style="color:red"><b>Rechazado</b></span>';
              }
              echo '</td>';
              echo '<td>';
              if (0 == $row['estados'] OR 1 == $_SESSION['rol']) {
              ?>
              <a class="editarnotacredito btn btn-xs btn-warning" title="Editar Nota Credito" id="<?php echo $row["id_expensa_fac"]; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#popeditarNotacredito"><i class="glyphicon glyphicon-pencil"></i></a>
              <?php
              }
              echo '</td>';
              echo '</tr>';
            } while ($row = mysql_fetch_assoc($select));
            mysql_free_result($select);
          }
          ?>
          <script>
            $(document).ready(function() {
              $('#tablanotaCredito').DataTable({
                "lengthMenu": [
                  [25, 50, 100, 250, 500],
                  [25, 50, 100, 250, 500]
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

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><b>DEVOLUCIONES</b></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

      <table class="table display" id="tablaDevolucion">
        <thead>
          <tr>
            <th>Concepto</th>
            <th>Curaduria</th>
            <th>Periodo</th>
            <th>Fecha Radicado</th>
            <th>Anexo</th>
            <th>Fecha Autoriza</th>
            <th>Valor</th>
            <th>Estado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT
          curaduria.nombre_curaduria,
          expensa_curaduria.id_expensa_curaduria,
          expensa_curaduria.fecha_inicio_expensa,
          expensa_curaduria.fecha_final_expensa,
          expensa_devolucion.id_expensa_devolucion,
          expensa_devolucion.fecha_devolucion,
          expensa_devolucion.ulr_expensa_devolucion,
          expensa_devolucion.fecha_autoriza,
          expensa_devolucion.valor_devolucion,
          expensa_devolucion.estado
          FROM expensa_devolucion
          LEFT JOIN expensa_curaduria
          ON expensa_devolucion.id_expensa_curaduria=expensa_curaduria.id_expensa_curaduria
          LEFT JOIN curaduria
          ON curaduria.id_curaduria=expensa_curaduria.id_curaduria
          WHERE estado_expensa_devolucion=1";
          $select = mysql_query($query, $conexion);
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
            do {
              echo '<tr>';
              echo '<td>Devolución</td>';
              echo '<td><a href="expensa&' . $row['id_expensa_curaduria'] . '.jsp" />' . $row['nombre_curaduria'] . '</a></td>';
              echo '<td>' . $row['fecha_inicio_expensa'] . ' | ' . $row['fecha_final_expensa'] . '</td>';
              echo '<td>' . $row['fecha_devolucion'] . '</td>';
              if (0 == $row['estado']) {
              echo '<td><a href="files/expensa_curadurias/' . $row['ulr_expensa_devolucion'] . '"/><img src="images/pdf.png"></a></td>';
              } elseif (1 == $row['estado'] AND 2 == $row['estado']) { 
              echo '<td></td>';
              }
              echo '<td>' . $row['fecha_autoriza'] . '</td>';
              echo '<td>' . number_format((float) $row["valor_devolucion"], 2, ",", ".") . '</td>';
              echo '<td>';
              if (0 == $row['estado']) {
                echo '<span style="color:orange"><b>Tramite</b></span>';
              } elseif (1 == $row['estado']) {
                echo '<span style="color:green"><b>Aprobado</b></span>';
              } elseif (2 == $row['estado']) {
                echo '<span style="color:red"><b>Rechazado</b></span>';
              }
              echo '</td>';
              echo '<td>';
              if (0 == $row['estado']) {
              ?>
              <a class="editardevolucion btn btn-xs btn-warning" title="Editar Devolucion" id="<?php echo $row["id_expensa_devolucion"]; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#popeditardevolucion"><i class="glyphicon glyphicon-pencil"></i></a>
              <?php
              } elseif (1 == $row['estado'] AND 2 == $row['estado']) { }
              echo '</td>';
              echo '</tr>';
            } while ($row = mysql_fetch_assoc($select));
            mysql_free_result($select);
          }
          ?>
          <script>
            $(document).ready(function() {
              $('#tablaDevolucion').DataTable({
                "lengthMenu": [
                  [25, 50, 100, 250, 500],
                  [25, 50, 100, 250, 500]
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

  <script>
    $(function() {
      $('.editarnotacredito').click(function() {
        var ma = this.id;
        jQuery.ajax({
          type: "POST",
          url: "pages/expensa_editar_financiera.php",
          data: 'option=' + 'notacredito' + '-' + ma,
          async: true,
          success: function(b) {
            jQuery('#diveditarNotacredito').html(b);
          }
        })
      });
    })
    
    $(function() {
      $('.editardevolucion').click(function() {
        var ma = this.id;
        jQuery.ajax({
          type: "POST",
          url: "pages/expensa_editar_financiera.php",
          data: 'option=' + 'devolucion' + '-' + ma,
          async: true,
          success: function(b) {
            jQuery('#diveditardevolucion').html(b);
          }
        })
      });
    })
  </script>



  <div class="modal fade" id="popeditarNotacredito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <span style="font-size: 20px; float: right; margin-right: 30px;"><b>EDITAR NOTA CREDITO</b></span>
          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="modal-body">
          <form action="" method="POST" name="editarNotaCredito">
            <div id="diveditarNotacredito">

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="popeditardevolucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <span style="font-size: 20px; float: right; margin-right: 30px;"><b>EDITAR NOTA CREDITO</b></span>
          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="modal-body">
          <form action="" method="POST" name="editardevolucion" enctype="multipart/form-data">
            <div id="diveditardevolucion">

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  

<?php
}

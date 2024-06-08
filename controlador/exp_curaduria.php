<?php
class expensaCuraduriaControlador
{

  # TABLA CURADURIAS
  static public function tablacuraduriaControlador()
  {
    $respuesta = expensaCuraduriaModelo::tablacuraduriaModelo("curaduria");

    foreach ($respuesta as $row => $item) { ?>
      <tr>
        <td><?php echo $item['nombre_departamento']; ?></td>
        <td><?php echo $item['nombre_municipio']; ?></td>
        <td><?php echo $item['nombre_curaduria']; ?></td>
        <td><?php echo $item['correo_curaduria']; ?></td>
        <td><?php echo $item['telefono_curaduria']; ?></td>
        <td>
          <?php
          $editar = '<a href="curaduria&' . $item['id_curaduria'] . '.jsp" ><span class="glyphicon glyphicon-search" ></span></a>  &nbsp; ';

          if ((1 == $_SESSION['rol'] or 3184 == $_SESSION['snr']) or (4 == intval($_SESSION['snr_tipo_oficina']))) {
            $licencia = '<a href="licencia_curaduria&' . $item['id_curaduria'] . '.jsp" ><span class="label label-danger" >Licencias</span></a>  &nbsp; ';
          } else {
            $licencia = '';
          }

          if ((1 == $_SESSION['snr_tipo_oficina']) or (4 == $_SESSION['snr_tipo_oficina'])) {
            $expensa = '<a href="expensa_curaduria&' . $item['id_curaduria'] . '.jsp" ><span class="label label-warning" >Tarifa de Vig.</span></a>  &nbsp; ';
          } else {
            $expensa = '';
          }

          if (1 == $_SESSION['rol'] or 3184 == $_SESSION['snr'] or 438 == $_SESSION['snr']) {
            $validar = '<a href="validacion_licencias&' . $item['id_curaduria'] . '.jsp" ><span class="label label-info" >Validar</span></a>  &nbsp; ';
          } else {
            $validar = '';
          }

          echo $editar . $licencia . $expensa . $validar;


          ?>
        </td>
      </tr>
    <?php
    }
  }

  # TABLA PERIODOS DE LAS EXPENSAS DE CURADURIA
  static public function tablaperiodoControlador($id)
  {
    $respuesta = expensaCuraduriaModelo::tablaperiodoModelo("expensa_curaduria", $id);
    $AprobarFinanciero = privilegios(34, $_SESSION['snr']);

    foreach ($respuesta as $row => $item) { ?>
      <tr>
        <?php if (1 == $_SESSION['rol']) { ?>
          <td><?php echo $item['id_expensa_curaduria']; ?></td>
        <?php } ?>
        <td><?php echo $item['fecha_inicio_expensa']; ?></td>
        <td><?php echo $item['fecha_final_expensa']; ?></td>
        <td><?php echo $item['fecha_real_expensa']; ?></td>
        <td><?php
            if (0 == $item['vigilancia_curaduria']) {
              echo '<span class="label label-danger">Sin Auditar</span>';
            } elseif (1 == $item['vigilancia_curaduria']) {
              echo '<span class="label label-success">Auditado</span>';
            }
            ?></td>
        <td><?php
            if (0 == $item['vigilancia_financiera']) {
              echo '<span class="label label-danger">Sin Auditar</span>';
            } elseif (1 == $item['vigilancia_financiera']) {
              echo '<span class="label label-success">Auditado</span>';
            }
            ?></td>
        <td>
          <?php

          $vigfinanciera = $item['vigilancia_financiera'];
          $vigcuraduria = $item['vigilancia_curaduria'];
          $estadoexpensa = $item['expensa_cerrada'];

          $conbinacion = $vigfinanciera . $vigcuraduria . $estadoexpensa;

          switch ($conbinacion) {
            case '000':
              $infoi2 = '<a href="expensa&' . $item['id_expensa_curaduria'] . '.jsp" <span class="label label-danger">Abierta</span></a> &nbsp;';
              $pdf2 = '';
              $modificar = '';
              echo $modificar . $infoi2 . $pdf2;
              break;
            case '001':
              $infoi2 = '<a href="expensa&' . $item['id_expensa_curaduria'] . '.jsp" <span class="label label-danger">Abierta</span></a> &nbsp;';
              $pdf2 = '';
              $modificar = '';
              echo $modificar . $infoi2 . $pdf2;
              break;
            case '101':
              $infoi2 = '<a href="expensa&' . $item['id_expensa_curaduria'] . '.jsp" <span class="label label-info">Revision</span></a> &nbsp;';
              $pdf2 = '';
              $modificar = '';
              echo $modificar . $infoi2 . $pdf2;
              break;
            case '011':
              $infoi2 = '<a href="expensa&' . $item['id_expensa_curaduria'] . '.jsp" <span class="label label-info">Revision</span></a> &nbsp;';
              $pdf2 = '';
              $modificar = '';
              echo $modificar . $infoi2 . $pdf2;
              break;
            case '112':
              $infoi2 = '<a href="expensa&' . $item['id_expensa_curaduria'] . '.jsp"<span class="label label-success">Cerrado</span></a> &nbsp;';
              $pdf2 = '<a href="pdf/expensa&' . $item['id_expensa_curaduria'] . '.pdf" title="PDF"><img src="images/pdf.png"></a> ';
              $modificar = '';
              echo $modificar . $infoi2 . $pdf2;
              break;
          }

          ?>
        </td>
      </tr>
    <?php
    }
  }

  # TABLA REPORTE DE FACTURACION POR CURADURIA
  static public function tablareporfacturaControlador()
  {
    $respuesta = expensaCuraduriaModelo::tablareporfacturaModelo("expensa_consol_facxcura");

    foreach ($respuesta as $row => $item) { ?>
      <tr>
      <td><a href="expensa&<?php echo $item['id_expensa_curaduria']; ?>.jsp"><?php echo $item['nombre_curaduria']; ?></td>
        <td><?php echo date("d/m/Y", strtotime($item['fecha_inicio_expensa'])); ?></td>
        <td><?php echo date("d/m/Y", strtotime($item['fecha_final_expensa'])); ?></td>
        <td><?php echo number_format((float) $item["fijo"], 2, ",", "."); ?></td>
        <td><?php echo number_format((float) $item["variable"], 2, ",", "."); ?></td>
        <td><?php echo number_format((float) $item["unico"], 2, ",", "."); ?></td>
        <td>
          <?php
          $totalizado = $item['fijo'] + $item['variable'] + $item['unico'];
          $respuestanota = expensaCuraduriaModelo::expensaNotaModelo("expensa_nota_credito", $item['id_expensa_curaduria']);
          $sumaNotasCredito = $respuestanota['sumanotafijo'] + $respuestanota['sumanotavari'] + $respuestanota['sumanotauni'];
          $totalmasNotasCredito = $totalizado + $sumaNotasCredito;
          echo number_format((float) $totalmasNotasCredito, 2, ",", ".");
          ?>
        </td>
        <td>
          <?php 
          $tarifa = $totalmasNotasCredito * 0005 / 100;
          echo number_format((float) $tarifa, 2, ",", ".");
          ?>
        </td>
        <td>
          <?php
          $sumatorianotacredito = $respuestanota['sumanotafijo'] + $respuestanota['sumanotavari'] + $respuestanota['sumanotauni'];
          echo '-'.number_format((float) $sumatorianotacredito, 2, ",", ".");
          ?>
        </td>
        <td>
          <?php
          $totalizado = $item['fijo'] + $item['variable'] + $item['unico'];
          echo number_format((float) $totalizado, 2, ",", ".");
          ?>
        </td>
        <td>
          <?php $totalingreso = $item['fijo'] + $item['variable'] + $item['unico'];
          $tarifa = $totalingreso * 0005 / 100;
          echo number_format((float) $tarifa, 2, ",", ".");
          ?>
        </td>
        <td>
          <?php
          $datos = $item['id_expensa_curaduria'];
          $respuesta1 = expensaCuraduriaModelo::expensadocumentoModelo("expensa_documento", $datos);
          $pagado = $respuesta1['soporte'];
          echo number_format((float) $pagado, 2, ",", ".");
          ?>
        </td>
        <td>
          <?php
          $respuestaDevolucion = expensaCuraduriaModelo::expensaDevolucionModelo("expensa_devolucion", $item['id_expensa_curaduria']);
          echo '-'.number_format((float) $respuestaDevolucion['sumadevolucion'], 2, ",", ".");
          ?>
        </td>
        <td>
          <?php
          $deducciones = $pagado - $respuestaDevolucion['sumadevolucion'];
          $SumaResta = $deducciones - $tarifa;
          echo number_format((float) $SumaResta, 2, ",", ".");
          ?>
        </td>
        <td>
          <?php
          $datos = intval($item['id_expensa_curaduria']);
          $respuesta2 = expensaCuraduriaModelo::expensaauditoriaModelo("expensa_auditoria", $datos);
          echo $respuesta2['nombre_expensa_tipos_auditoria'];
          ?>
        </td>
        <td>
          <?php
          switch ($item['expensa_cerrada']) {
            case 0:
              echo "Abierto";
              break;
            case 1:
              echo "Revisar";
              break;
            case 2:
              echo "Cerrado";
              break;
          }
          ?>
        </td>
        <td>
          <?php
          if (is_numeric($SumaResta) and ($SumaResta < 0)) {
            echo '<b style="color:red;">Debe</b>';
          } else {
            echo '<b style="color:green;">Pago</b>';
          }

          ?>
        </td>
      </tr>
    <?php }
  }


  # TABLA DETALLE DE FACTURACION
  static public function tablareporfechaControlador()
  {
    $respuesta = expensaCuraduriaModelo::tablareporfechaModelo("expensa_curaduria");
    foreach ($respuesta as $row => $item) { ?>
      <tr>
        <td><a href="expensa&<?php echo $item['id_expensa_curaduria']; ?>.jsp"><?php echo $item['id_expensa_curaduria']; ?></td>
        <td><?php echo date("d/m/Y", strtotime($item['fecha_inicio_expensa'])); ?></td>
        <td><?php echo date("d/m/Y", strtotime($item['fecha_final_expensa'])); ?></td>
        <td><?php echo $item['nombre_curaduria']; ?></td>
        <td><?php echo $item['nombre_departamento']; ?></td>
        <td><?php echo $item['nombre_municipio']; ?></td>
        <td><?php echo $item['fecha_soporte']; ?> </td>
        <td><?php echo $item['valor_soporte']; ?></td>
      </tr>
<?php }
  }



  // FIN DE LA CLASS
}

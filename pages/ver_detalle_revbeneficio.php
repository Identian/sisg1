<?php 
session_start();
require_once('../conf.php'); 
require_once('listas.php');
$nump63=privilegios(63,$_SESSION['snr']);
if (isset($_POST['ben']) && ""!=$_POST['ben'] && (1==$_SESSION['rol'] or 0<$nump63)) {
	
	

//$nump63=privilegios(63,$_SESSION['snr']);

$idbene=intval($_POST['ben']);

//echo $idbene;


$query="SELECT notaria.id_notaria, nombre_departamento, notaria.nombre_notaria, email_notaria, nombre_funcionario, cedula_funcionario, 
id_beneficio_notaria, fecha_beneficio, mes_beneficio, id_analista, b0, rb0, b1, n_empleados_abril, planilla_abril, rb1, b2, planilla_mes_anterior, rb2, b3, n_empleados_mes, rb3, b4, nombre_contador, cedula_contador, tarjeta_contador, rb4, b5, rb5, b9, rb9, b6, id_nc_banco, banco, tipo_cuenta, numero_cuenta, rb6, confirmacion, daf, fecha_envio_rev, nombre_beneficio_notaria 
 FROM departamento, notaria, posesion_notaria, funcionario, beneficio_notaria   
WHERE notaria.id_notaria=posesion_notaria.id_notaria 
and departamento.id_departamento=notaria.id_departamento 
AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND beneficio_notaria.id_notaria=notaria.id_notaria 
AND posesion_notaria.fecha_fin IS NULL 
AND estado_notaria=1 
AND estado_funcionario=1 
AND estado_posesion_notaria=1 
AND estado_beneficio_notaria=1 
AND beneficio_notaria.id_beneficio_notaria=".$idbene." limit 1";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);



function ndocumento($filename) {
$namefile=explode("-", $filename);
$namef=$namefile[0];
if ('benNot'==$namef) {
$namedoc=' inicial';
} else if ('actualizado'==$namef) {
$namedoc=' actualizado';
} else { $namedoc=''; }
return $namedoc;
}



$id_notaria=$row['id_notaria'];

?>



<div style="padding:10px 10px 10px 10px">
<form action="" method="POST" name="form1">

<div class="form-group text-left"> 
<label  class="control-label">Asignado a:</label> 
<?php echo quees('funcionario', $row['id_analista']); ?>
</div>

<?php if (isset($row['fecha_envio_rev'])) {  ?>
<div class="form-group text-left"> 
<label  class="control-label">Fecha de calificación:</label> 
<?php echo $row['fecha_envio_rev'].' / '; 

$fechaf=$row['fecha_envio_rev'];
$fechaf2 = date('Y-m-d', strtotime($fechaf));
$fecha_ven=fechahabil($fechaf2, 3);
echo ''.$fecha_ven.'';
//if ($realdate>$fecha_ven) { echo ' <b style="color:#ff0000;">Ya vencio</b>'; } else {}
?>
</div>
<?php } else {}  ?>

<div class="form-group text-left"> 
<label  class="control-label">Notario:</label> 
<?php echo $row['nombre_funcionario'];  ?>.
 <b>C.C.</b> <?php echo $row['cedula_funcionario'];  ?>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Notaria:</label> 
<a href="notaria&<?php echo $id_notaria; ?>.jsp" target="_blank">
<?php echo $row['nombre_departamento']; ?> / <?php echo $row['nombre_notaria']; ?></a>
 - <?php $emailn=$row['email_notaria']; echo $emailn; ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">Mes:</label> 
<?php $mes=$row['mes_beneficio']; echo $mes; ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label">Documentos requeridos:</label> 
</div>

<div class="form-group text-left"> 
Formato de solicitud de acuerdo con el anexo 1: 
<?php if (isset($row['b0'])) { ?>
<!--<a href="filesnr/beneficio_notariado/<?php echo $row['b0']; ?>"  download><img src="../images/pdf.png"> Documento <?php echo ndocumento($row['b0']); ?></a> 
<select class="" name="rb0">
<option value=""></option>
<option value="Si" <?php //if ('Si'==$row['rb0']) { echo 'selected'; } else {} ?>>Si</option>
<option value="No" <?php //if ('No'==$row['rb0']) { echo 'selected'; } else {} ?>>No</option>
</select>-->
<?php echo 'R: '.$row['rb0']; } else { echo 'No hay documento.'; } ?>
</div>






<?php if ('Junio'==$mes)  { } else { ?>
<div class="form-group text-left" style="background:#f7bebe; padding: 5px 5px 5px 5px;"> 
Constancia de pago al Sistema General del Seguridad Social del mes de abril de 2020: 
<br><?php 
$query77="SELECT * from beneficio_notaria WHERE id_notaria=".$id_notaria." and mes_beneficio='Junio' and estado_beneficio_notaria=1";
$select77 = mysql_query($query77, $conexion);
$row77 = mysql_fetch_assoc($select77);
$nn77= mysql_num_rows($select77);
if (0<$nn77) {

if (isset($row77['rb1']) && 'Si'==$row77['rb1']) { ?>
Si, empleados en abril: <b><?php echo $row77['n_empleados_abril']; ?></b>, planilla de abril: <b><?php echo $row77['planilla_abril']; ?></b> 
<a href="filesnr/beneficio_notariado/<?php echo $row77['b1']; ?>" target="_blank"><img src="../images/pdf.png"> Documento de abril.</a> 

<?php } else { echo 'La calificación en Junio fue NO.'; } ?>
<?php } else { echo 'No existe registro para Junio.'; } 
mysql_free_result($select77);
?>
</div>
<?php } ?>




<div class="form-group text-left"> 
1. Constancia de pago al Sistema General del Seguridad Social, de la Planilla Integrada de Liquidación de Aportes (PILA) correspondiente al mes de abril de 2020.
<br><?php if (isset($row['b1'])) { ?>
Empleados en abril: <b><?php echo $row['n_empleados_abril']; ?></b>, planilla de abril: <b><?php echo $row['planilla_abril']; ?></b> 
<a href="filesnr/beneficio_notariado/<?php echo $row['b1']; ?>" target="_blank"><img src="../images/pdf.png"> Documento <?php echo ndocumento($row['b1']); ?></a> 
<!--<select class="" name="rb1">
<option value=""></option>
<option value="Si" <?php //if ('Si'==$row['rb1']) { echo 'selected'; } else {} ?>>Si</option>
<option value="No" <?php //if ('No'==$row['rb1']) { echo 'selected'; } else {} ?>>No</option>
</select>-->
<?php echo 'R: '.$row['rb1']; } else { echo 'No hay documento.'; } ?>
</div>


<div class="form-group text-left"> 
2. Constancia de pago al Sistema General del Seguridad Social, según la Planilla Integrada de Liquidación de Aportes (PILA) correspondiente al mes inmediatamente anterior a aquel para el cual se solicita el apoyo.
<br>
<?php if (isset($row['b2'])) { ?>
Planilla del mes anterior: <b><?php echo $row['planilla_mes_anterior']; ?></b> 
<a href="filesnr/beneficio_notariado/<?php echo $row['b2']; ?>" target="_blank"><img src="../images/pdf.png"> Documento <?php echo ndocumento($row['b2']); ?></a> 
<!--<select class="" name="rb2">
<option value=""></option>
<option value="Si" <?php //if ('Si'==$row['rb2']) { echo 'selected'; } else {} ?>>Si</option>
<option value="No" <?php //if ('No'==$row['rb2']) { echo 'selected'; } else {} ?>>No</option>
</select>-->
<?php echo 'R: '.$row['rb2']; } else { echo 'No hay documento.'; } ?>
</div>


<div class="form-group text-left"> 
3. Certificación emitida por el suscrito, en la que señalo el número de empleados dependientes que se mantendrán durante el mes correspondiente al otorgamiento del apoyo económico. 
<br><?php if (isset($row['b3'])) { ?>
Número de empleados del mes reportado: <b><?php echo $row['n_empleados_mes']; ?></b> 
<a href="filesnr/beneficio_notariado/<?php echo $row['b3']; ?>" target="_blank"><img src="../images/pdf.png"> Documento <?php echo ndocumento($row['b3']); ?></a> 
<!--<select class="" name="rb3">
<option value=""></option>
<option value="Si" <?php //if ('Si'==$row['rb3']) { echo 'selected'; } else {} ?>>Si</option>
<option value="No" <?php //if ('No'==$row['rb3']) { echo 'selected'; } else {} ?>>No</option>
</select>-->
<?php echo 'R: '.$row['rb3']; } else { echo 'No hay documento.'; } ?>
</div>


<div class="form-group text-left"> 
4. Certificación emitida por contador público en la que señala que los recursos del beneficio económico otorgados en el mes anterior, fueron destinados en su integridad al pago de las obligaciones laborales de los empleados de la notaría (para la segunda solicitud en adelante).  
<br><span style="color:#B40404;">En caso de aplicar el mes de Junio, debe anexar una identificación del contador (Cedúla ó tarjeta profesional).</span>
<br><?php if (isset($row['b4'])) { ?>
Nombre del contador: <b><?php echo $row['nombre_contador']; ?></b>, 
Cédula del contador: <b><?php echo $row['cedula_contador']; ?></b>, 
Tarjeta profesional del contador: <b><?php echo $row['tarjeta_contador']; ?></b> 
<a href="filesnr/beneficio_notariado/<?php echo $row['b4']; ?>" target="_blank"><img src="../images/pdf.png"> Documento <?php echo ndocumento($row['b4']); ?></a> 
, <a href="https://sgr.jcc.gov.co:8181/apex/f?p=138" style="color:#ff0000;" target="_blank">Validar datos del Contador.</a>
<?php } else { echo 'No hay documento. '; } ?>
<!--<select class="" name="rb4">
<option value=""></option>
<option value="Si" <?php //if ('Si'==$row['rb4']) { echo 'selected'; } else {} ?>>Si</option>
<option value="No" <?php //if ('No'==$row['rb4']) { echo 'selected'; } else {} ?>>No</option>
</select>-->
<?php echo 'R: '.$row['rb4']; ?>

</div>


<div class="form-group text-left"> 
5. Copia de los comprobantes de pago de nómina a los empleados relacionados en la Planilla Integrada de Liquidación de Aportes (PILA) correspondiente al mes  inmediatamente anterior a aquel para el cual se solicita se otorgue el beneficio.
<br><?php if (isset($row['b5'])) { ?><a href="filesnr/beneficio_notariado/<?php echo $row['b5']; ?>" target="_blank"><img src="../images/pdf.png"> Documento <?php echo ndocumento($row['b5']); ?></a> 
<!--<select class="" name="rb5">
<option value=""></option>
<option value="Si" <?php // if ('Si'==$row['rb5']) { echo 'selected'; } else {} ?>>Si</option>
<option value="No" <?php //if ('No'==$row['rb5']) { echo 'selected'; } else {} ?>>No</option>
</select>-->
<?php echo 'R: '.$row['rb5']; } else { echo 'No hay documento.'; } ?>
</div>


<div class="form-group text-left"> 
6. Certificado de cuenta bancaria a nombre del notario titular que se postula.
<br><?php if (isset($row['b6'])) { ?>
Banco: <b><?php echo $row['banco']; ?></b>, 
Tipo de cuenta: <b><?php echo $row['tipo_cuenta']; ?></b>, 
Número de cuenta: <b><?php echo $row['numero_cuenta']; ?></b> 

<a href="filesnr/beneficio_notariado/<?php echo $row['b6']; ?>" target="_blank"><img src="../images/pdf.png"> Documento <?php echo ndocumento($row['b6']); ?></a> 
<!--<select class=""  name="rb6">
<option value=""></option>
<option value="Si" <?php //if ('Si'==$row['rb6']) { echo 'selected'; } else {} ?>>Si</option>
<option value="No" <?php //if ('No'==$row['rb6']) { echo 'selected'; } else {} ?>>No</option>
</select>-->
<?php echo 'R: '.$row['rb6']; } else { echo 'No hay documento.'; } ?>
</div>

<div class="form-group text-left"> 
7. El Notario Confirmo los documentos.
<br>
<?php if (isset($row['confirmacion'])  && ""!=$row['confirmacion']) { ?>
<b><?php echo $row['confirmacion']; ?></b>
<?php } else { echo 'No existe confirmación.'; } ?>
</div>


<div class="form-group text-left"> 
8. La Notaria cumple el decreto 2148 de 1983, pago de aportes.
<br>
<?php if (isset($row['daf']) && ""!=$row['daf']) {  echo '<b>'.$row['daf'].'</b>';  } else { echo 'No hay respuesta.'; } ?>
</div>




<div class="form-group text-left"> 
9. La Notaria anexo el certificado proferido por el contador público de la Notaría, mediante el cual se dé cuenta del pago de nómina realizado a los empleados del despacho notarial, en el mes inmediatamente anterior a aquel sobre el cual se busca el reconocimiento del apoyo económico estipulado en el Decreto Ley 805 de 2020
<br><?php if (isset($row['b9'])) { ?><a href="filesnr/beneficio_notariado/<?php echo $row['b9']; ?>" target="_blank"><img src="../images/pdf.png"> Documento <?php echo ndocumento($row['b9']); ?></a> 
<select class="" name="rb9">
<option value=""></option>
<option value="Si" <?php if ('Si'==$row['rb9']) { echo 'selected'; } else {} ?>>Si</option>
<option value="No" <?php if ('No'==$row['rb9']) { echo 'selected'; } else {} ?>>No</option>
</select>
<?php } else { echo 'No hay documento.'; } ?>
</div>



<div class="form-group text-left"> 
Observaciones  <br>
<textarea class="form-control" name="nombre_beneficio_notaria"><?php echo $row['nombre_beneficio_notaria']; ?></textarea>
</div>



<div class="modal-footer">
<div id="imagePreview"></div>
<input type="hidden" name="rev" value="<?php echo $idbene; ?>">
<input type="hidden" name="idb" value="<?php echo $row['id_beneficio_notaria']; ?>">
<input type="hidden" name="emailn" value="<?php echo $emailn; ?>">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div></form>
</div>
<?php
mysql_free_result($select);
} else { echo 'No';}
?>
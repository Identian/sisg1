<?php
$nump165=privilegios(165,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump165 and isset($_GET['i'])) {


$id=intval($_GET['i']);
 
 
 
 if (isset($_GET['e']) && ""!=$_GET['e']) { 
 
$edi=intval($_GET['e']);
$updateSQL = sprintf("UPDATE nomina SET estado=1, revisado=1 WHERE identificacion=%s ",				 
	GetSQLValueString($edi, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);
  
  
  



$query2357 = "SELECT id_funcionario, correo_funcionario  FROM funcionario WHERE cedula_funcionario=".$edi." limit 1";
$result2357 = mysql_query($query2357);	
 $row7 = mysql_fetch_assoc($result2357); 
$totalRows7 = mysql_num_rows($result2357);
if (0<$totalRows7){
	
$idf=$row7['id_funcionario'];
$correo=$row7['correo_funcionario'];

$emailu=$correo;
$subject = 'CERTIFICADO - SNR.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que ya se encuentra su certificado disponible para descarga. Por favor acceder al enlace:<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/pdf/certificado_convocatoria&'.$idf.'.pdf">https://sisg.supernotariado.gov.co/pdf/certificado_convocatoria&'.$idf.'.pdf</a>';


$cuerpo .= '<br><br><b>En caso de requerir información adicional o verificar la información contenida en la certificación, podrá solicitarla al correo
</b> certificacionessnr@supernotariado.gov.co';

$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'cc: certificacionessnr@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);

}
mysql_free_result($result2357);

} else { }

 
 
 
 
 
 
if (isset($_POST['id_nomina']) && ""!=$_POST['id_nomina']) { 

$idnomina=intval($_POST['id_nomina']);
$funcion_ano=intval($_POST['funcion_ano']);

$identifica=$_POST['identifica'];
	
$id_funcion_cargo=intval($_POST['id_funcion_cargo']);

 $updateSQL = sprintf("UPDATE nomina SET funcion_cargo=%s WHERE id_nomina=%s and identificacion=%s",				 
	GetSQLValueString($id_funcion_cargo, "int"),
	GetSQLValueString($idnomina, "int"),
	GetSQLValueString($identifica, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);

echo $actualizado;

} else { }
 
 
 
 
 if (isset($_POST['id_borrar']) && ""!=$_POST['id_borrar']) { 

$borrar=intval($_POST['id_borrar']);
$iden=intval($_POST['iden']);
 $updateSQL = sprintf("UPDATE nomina SET funcion_cargo=NULL WHERE id_nomina=%s and identificacion=%s ",				 
	GetSQLValueString($borrar, "int"),
	GetSQLValueString($iden, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);

} else { }






function hasta($ced,$num){
global $mysqli;
$query = "select fecha_efectiva from nomina WHERE identificacion=".$ced." order by fecha_efectiva desc";
$result = $mysqli->query($query);

$e=1;
while ($obj = $result->fetch_array()) {
$inc=$e++;
if($num==$inc) {
 $valorce=$obj['fecha_efectiva'];
    }
}
		
return $valorce;
$result->free();
}


	
	


?>
 
 



	
<div class="row">
<div class="col-md-12">
<div class="box ">
<div class="box-header with-border">
<div class="col-md-6">

	  </div>
	  
	  <?php
	  

function funcion($fun){
global $mysqli;
$query = "select * from funcion_cargo, cargo_nomina WHERE id_funcion_cargo=".$fun." and funcion_cargo.id_cargo_nomina=cargo_nomina.id_cargo_nomina";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$valorc='<b>Manual de funciones '.$row['funcion_ano'].' ('.$row['codigodep'].' / '.$row['nombre_cargo_nomina'].': '.$row['cod_cargo_nomina'].'-'.$row['grado_cargo_nomina'].')</b>'.$row['nombre_funcion_cargo'];


} else { 
$valorc='Error';
}
return $valorc;
$result->free();
}





$query235 = "SELECT * FROM funcionario, nomina WHERE funcionario.cedula_funcionario=nomina.identificacion and 
id_funcionario=".$id." and id_tipo_oficina<3 order by id_nomina desc limit 1";
$result235 = mysql_query($query235);	
 $row = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){
	$cedulaa=$row['cedula_funcionario'];
	$namefun=$row['nombre_funcionario'];
	$fechaingreso=$row['fecha_ingreso2'];
	$revisado=$row['revisado'];
	?>
	  
	  
	  
<div class="col-md-6">

<?php
if (1==$revisado) {
	echo '<b style="color:#008D4C">YA FUE AUTORIZADO </b> ';
	} else {  
	?>

  <a href="generar_certificado&<?php echo $id; ?>&<?php echo $cedulaa; ?>.jsp">
		  <button class="btn  btn-warning">
<span class="fa fa-file"></span> AUTORIZAR CERTIFICADO</button></a>

<?php
	}

	?>
	
	




 <a href="pdf/certificado_convocatoria&<?php echo $id; ?>.pdf">
		  <button class="btn  btn-success">
<span class="fa fa-file"></span> VER CERTIFICADO</button></a>

<!--
 <a href="generar_certificado&<?php //echo $id; ?>&<?php //echo $cedulaa; ?>.jsp">
		  <button class="btn  btn-danger">
<span class="fa fa-file"></span> ENVIAR EMAIL</button></a>-->



	  </div>

</div> 

    <div class="box-body">
      <div class="table-responsive">
	  
<?php

$infocc= '<center><b>LA DIRECTORA DE TALENTO HUMANO DE LA SUPERINTENDENCIA
DE NOTARIADO Y REGISTRO<br><br>CERTIFICA QUE:</b></center><br><br>
Que <b>'.$namefun.'</b>, identificado(a) con cédula de ciudadanía No <b>'.$cedulaa.'</b>, se encuentra
vinculado(a) a esta Entidad mediante nombramiento provisional a partir de '.$fechaingreso.', desempeñando los siguientes cargos y funciones así:
<br>';
echo $infocc;



$query3 = sprintf("SELECT * FROM nomina, dependencia WHERE nomina.dependencia=dependencia.codigo AND nomina.identificacion=".$cedulaa." and estado_nomina=1 order by fecha_efectiva desc"); 

$select3 = mysql_query($query3, $conexion);   
$rowrt = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
	$i=1;
do {

echo'';
echo '<b><br>Desde: '.$rowrt['fecha_efectiva'];

if (1==$rowrt['ultimo']) {
echo ', Cargo actual.'; 

} else { 


$vale=$i++;
$infofe=hasta($rowrt['identificacion'],$vale);
echo  ', Hasta: ';

if ('0000-00-00'!=$rowrt['fecha_final']) {
echo $rowrt['fecha_final'];
} else {
echo  date('Y-m-d', strtotime('-1 day', strtotime($infofe)));
}

} 

echo '<br>Dependencia: '.$rowrt['nombre_dependencia'].'  ('.$rowrt['codegrupo'].')';

if (isset($rowrt['cargo']) && ""!=$rowrt['cargo']){
echo '<br>Cargo: '.$rowrt['desc_cargo'];
echo ', código '.$rowrt['cargo'].', grado '.$rowrt['grado'].'</b>';
} else {}


if ('0000-00-00'==$rowrt['fecha_final']) {
} else {
	echo '<br>Hasta: '.$rowrt['fecha_fin'];
}


if (isset($rowrt['funcion_cargo']) && ""!=$rowrt['funcion_cargo']) {
	
echo '<br><br><i>DESCRIPCIÓN DE FUNCIONES ESENCIALES:</i>';
	
	
	
	
echo '<form action="" method="POST" name="for4354r41" >
<input type="hidden"  value="'.$rowrt['id_nomina'].'" name="id_borrar">
<input type="hidden"  value="'.$rowrt['identificacion'].'" name="iden">
<button type="submit" class="btn btn-xs btn-danger">
<span class="fa fa-trash"></span> Borrar</button>';

if (1==$rowrt['estado']) { //echo ' <span style="color:#fff;background:#E29111">. <b> Certificado enviado </b> .</span><br>'; 

} else {}

echo '</form>';

	
	echo funcion($rowrt['funcion_cargo']);
} else {
echo  ' <a href="" title="Anexar funciones" id="'.$rowrt['id_nomina'].'" class="ver_nomina" data-toggle="modal" data-target="#popupnomina"><button class="btn btn-xs btn-warning">+ funciones</button></a> ';
}

echo '<hr><br>';
	
		 } while ($rowrt = mysql_fetch_assoc($select3)); 
} else {}	 
mysql_free_result($select3);





	
} else { Echo ''; }
mysql_free_result($result235);


				?>

				
                <hr>
				<center>
          
		  <a href="https://sisg.supernotariado.gov.co/pdf/certificado_convocatoria&<?php echo $id; ?>.pdf">
		  <button class="btn  btn-success">
<span class="fa fa-file"></span> VER CERTIFICADO</button></a>
		  
		    
		    <a href="generar_certificado&<?php echo $id; ?>&<?php echo $cedulaa; ?>.jsp">
		  <button class="btn  btn-warning">
<span class="fa fa-file"></span> VALIDAR CERTIFICADO</button></a>

		  
		  </center>
	 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->





<div class="modal fade bd-example-modal-lg" id="popupnomina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Agregar</b><span style="font-weight: bold;"></span></h4>
</div> 
<div  class="modal-body">

<form action="" method="POST" name="for54354r6534541"  >


<span style="color:#ff0000;">*</span><input type="text" readonly required id="id_nomina" value="" name="id_nomina" class="form-control">

<input type="hidden" value="<?php echo $cedulaa; ?>" name="identifica" >


  
<div class="form-group text-left"> 
<label  class="control-label">

<span style="color:#ff0000;">*</span> Funciones: <a id="consulta_funcion_cargo">Buscar</a></label> 
<div id="id_funcion_cargoc">
</div>
</div>

<div class="modal-footer" ><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success" id="divfuncion_cargo" style="display:none;">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


   </div>
    </div>
  </div>
</div>



<?php
} else {
}
?>




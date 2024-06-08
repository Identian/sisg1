<?php
$actualizar6 = mysql_query("SELECT valor FROM configuracion WHERE id_configuracion=14 limit 1", $conexion) or die(mysql_error());
$row16 = mysql_fetch_assoc($actualizar6);
$valor = $row16['valor'];

if (0==$valor) { ?>
<div class="row">
<div class="col-md-12" >
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

if (isset($_GET['i']) &&  (2==$_SESSION['snr_tipo_oficina'] or 24 == $_SESSION['snr_grupo_area'] or 40 == $_SESSION['snr_grupo_area'] or 1==$_SESSION['rol'])) {
$id=intval($_GET['i']);


global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}
	
$query4 = sprintf("SELECT * FROM ciudadano where id_ciudadano='$id' and estado_ciudadano=1 limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
if (0<count($row4)){
$nombre = $row4['nombre_ciudadano'];
$identificacion = $row4['identificacion'];
$correo_ciudadano = $row4['correo_ciudadano'];
$direccion_ciudadano = $row4['direccion_ciudadano'];
$id_ciudadano=$row4['id_ciudadano'];
$dep=$row4['id_departamento'];
$mun=$row4['id_municipio'];
$tipod=$row4['id_tipo_documento'];
$telefono=$row4['telefono_ciudadano'];
$etnia=$row4['id_etnia'];
} else { }
$result4->free();


if (isset($_GET["e"]) && ""!=$_GET["e"]) { 
$inforadi=intval($_GET["e"]);
$query48 = sprintf("SELECT * from radi_cert where id_radi_cert=".$inforadi.""); 
$selectls8 = mysql_query($query48, $conexion) or die(mysql_error());
$row4 = mysql_fetch_assoc($selectls8);
$totalRowsls8 = mysql_num_rows($selectls8);
if (0<$totalRowsls8) {
$radicado22 = $row4['radi_cert'];
$fecha_radicado = $row4['fecha_radi_cert'];
$nombre_pqrs  = $row4['nombre_radi_cert'];
$identificacionc  = $row4['identificacion'];

$totalrad='Importado - '.$radicado22.' - '.$nombre_pqrs;

} else {
	$totalrad='';	
	$radicado22=0;	
}
} else { 
$totalrad='';
$radicado22=0;	
}





if ((isset($_POST["asunto_solicitud"])) && ($_POST["asunto_solicitud"] != "")) {


	
$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 
$anoiris=date("Y");
$infoiris='SNR'.$anoiris.'ER';
$query = "SELECT idcorrespondencia, codigo FROM correspondencia where codigo like '%$infoiris%' order by idcorrespondencia desc limit 1"; 
$resultado = pg_query ($query);
$num_resultados = pg_num_rows ($resultado);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado);
$info2iris=$row['codigo'];
$idcorrespondencia=$row['idcorrespondencia'];
 }

//echo $info2iris;


$info3iris=explode($anoiris.'ER', $info2iris);
$info4iris=intval($info3iris[1]);
$info5iris=$info4iris+1;
$info6iris = trim(substr('000000'.$info5iris,-6));
$radicado='SNR'.$anoiris.'ER'.$info6iris;

$idcorrespondenciaf=$idcorrespondencia+1;

//echo '<br>'.$radicado;


$textoiris=strip_tags($_POST["descripcion_solicitud"]);

$fecha_radicado=$_POST["fecha_radicado"].' '.$_POST["hora_radicado"];
$fechairis=date("Y-m-d H:i:s");

$consultab = sprintf("INSERT INTO correspondencia (idcorreoprioridad, idtipodocumento, codigo, referencia, asunto, idestado, idcorreovia, recibida, interna, deint, de, paraint, para, folios, anexos, contenido, fechaenvio, fecharecepcion, descripcion, creado, fcreado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString('1', "text"), 
GetSQLValueString('334', "text"), 
GetSQLValueString($radicado, "text"), 
GetSQLValueString($identificacion, "text"), 
GetSQLValueString($_POST["asunto_solicitud"], "text"), 
GetSQLValueString('8', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('0', "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString($nombre, "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString('Oficina de atencion al ciudadano', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($fechairis, "text"), 
GetSQLValueString($textoiris, "text"),
GetSQLValueString('1227', "text"),
GetSQLValueString($fechairis, "text"));


$resultado = pg_query ($consultab);


  pg_free_result($resultado);
  pg_close($conexionpostgresql);  

  }
  

				
if (isset($_GET["e"]) && ""!=$_GET["e"]) {

$certicamara=intval($_GET["e"]);
	
$updateSQL7799kk = sprintf("UPDATE radi_cert SET trasladada_sisg=%s WHERE id_radi_cert=%s and estado_radi_cert=1",                  
					  GetSQLValueString($radicado, "text"),
					  GetSQLValueString($certicamara, "int"));
$Result17799kk = mysql_query($updateSQL7799kk, $conexion) or die(mysql_error());
	
	
	
} else {
	$certicamara=0;
}



$insertSQL = sprintf("INSERT INTO solicitud_pqrs (id_estado_solicitud, id_canal_pqrs, id_categoria_pqrs, radicado, fecha_radicado, id_ciudadano, nombre_solicitud_pqrs, descripcion_solicitud, estado_solicitud_pqrs, de_certicamara) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST['id_canal_pqrs'], "int"), 
GetSQLValueString($_POST['id_categoria_pqrs'], "int"), 
GetSQLValueString($radicado, "text"), 
GetSQLValueString($fecha_radicado, "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["asunto_solicitud"], "text"), 
GetSQLValueString($_POST["descripcion_solicitud"], "text"),
GetSQLValueString(1, "int"),
GetSQLValueString($radicado22, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;



$actualizar = mysql_query("SELECT id_solicitud_pqrs FROM solicitud_pqrs WHERE radicado='$radicado' limit 1", $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($actualizar);
$uri77 = $row1['id_solicitud_pqrs'];





if (isset($_POST["documentoscert"]) && ""!=$_POST["documentoscert"]) {

$arraydoc=explode("%", $_POST["documentoscert"]);
	


foreach($arraydoc as $doc4) {

if (""!=$doc4) {

$seguridad=md5($radicado22.'.pdf'.$id_ciudadano);

$insertSQL77 = sprintf("INSERT INTO documento_pqrs (idcorrespondencia, id_ciudadano, nombre_documento_pqrs, id_solicitud_pqrs, id_clase_documento, fecha_subida, url_documento, extension, hash_documento, estado_documento_pqrs) VALUES (%s, %s, %s, %s, %s, now(), %s, %s, %s, %s)", 
GetSQLValueString($idcorrespondenciaf, "int"), 
GetSQLValueString($id_ciudadano, "int"), 
GetSQLValueString('Importado de certicamara', "text"),
 GetSQLValueString($uri77, "int"), 
 GetSQLValueString(1, "int"), 
 GetSQLValueString($doc4, "text"), 
 GetSQLValueString('.pdf', "text"), 
 GetSQLValueString($seguridad, "text"),
 GetSQLValueString(1, "int"));
$Result77 = mysql_query($insertSQL77, $conexion) or die(mysql_error());



} else {}
}
}



echo '<meta http-equiv="refresh" content="0;URL=pdf/snr_solicitud.php?q='.$uri77.'" />';


//echo '<meta http-equiv="refresh" content="0;URL=anexos_pqrs&'.$uri77.'.jsp" />';


	
mysql_free_result($select);



} else { }
?>
	
	<div class="row">
<div class="col-md-9">
	<div class="box box-info">


 <div class="box-header with-border">
                  <h3 class="box-title"><b>NUEVA PQRS</b> </h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">

			<div  class="modal-body">
<div class="row" >
	 <div class="col-md-6">
			<?php
		


echo '<b>Nombre:</b> '.$nombre.'<br>';
echo '<b>Tipo de documento:</b> ';
echo ''.quees('tipo_documento', $tipod).'<br>';
echo '<b>Identificación:</b> '.$identificacion.'<br>';
echo '<b>Etnia:</b> ';
echo ''.quees('etnia', $etnia).'<br>';
echo '<b>E-mail:</b> '.$correo_ciudadano.'<br>';
echo '<b>Telefono:</b> '.$telefono.'<br>';
echo '<b>Dirección:</b> '.$direccion_ciudadano.'<br>';
?>
</div>
 <div class="col-md-6">
<?php
echo '<b>Departamento:</b> ';
echo ''.quees('departamento', $dep).'<br>';
echo '<b>Municipio:</b> ';
echo ''.quees('municipio', $mun).'<br>';
?>



</div>
</div>

<div class="row" >
	 <div class="col-md-12">

	 <hr>
	 <form action="" method="POST" name="form1" onsubmit="" >
	
<div class="form-group text-left"> 
<div class="input-group">
<label  class="control-label input-group-addon">
<b>Fecha de envio:</b></label> <!---addon-->
<span class="input-group-addon">
<input type="text" class="form-control datepicker" readonly name="fecha_radicado" value="<?php echo $realdate; ?>"  required>
</span><span class="input-group-addon">
<input type="time" class="form-control " name="hora_radicado" value="<?php echo date('H:i:s'); ?>"  required>
</span>
</div>
</div>
<br />
	

<div class="form-group text-left"> 
<label  class="control-label">Canal:</label> 
<?php if (isset($_GET["e"]) && ""!=$_GET["e"]) { 

echo 'Correo electrónico';

echo '<input type="hidden" name="id_canal_pqrs" value="4">';


 } else { ?>


<select class="form-control" name="id_canal_pqrs"  required>
<option value="" selected></option>
<?php
$query = sprintf("SELECT id_canal_pqrs, nombre_canal_pqrs FROM canal_pqrs where estado_canal_pqrs=1 order by id_canal_pqrs"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	
/*if (1==$row['id_canal_pqrs'] && 24==$_SESSION['snr_grupo_area']) {
		echo '<option value="'.$row['id_canal_pqrs'].'">'.$row['nombre_canal_pqrs'].'</option>';
	 
}	else { */
		echo '<option value="'.$row['id_canal_pqrs'].'">'.$row['nombre_canal_pqrs'].'</option>';
	 
//}

	 
	 
	 
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
<?php } ?>


</div>


	 
<label  class="control-label">TIPO DE PQRSD:</label> 



	<table class="table">
<?php
$query = sprintf("SELECT * FROM categoria_pqrs where estado_categoria_pqrs=1 order by id_categoria_pqrs"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	  echo '<tr><td><input type="radio" name="id_categoria_pqrs" value="'.$row['id_categoria_pqrs'].'" required></td><td>
      <b>'.$row['nombre_categoria_pqrs'].':</b> '.$row['descripcion_categoria'].'</td></tr>';
	
	

	  
	  

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</table>



<div class="form-group text-left"> 
<label  class="control-label">ASUNTO:</label> 
<input type="text" class="form-control" name="asunto_solicitud" value="<?php echo $totalrad; ?>"  required>
</div>
<br />

<div class="form-group text-left"> 

<?php if (isset($_GET["e"]) && ""!=$_GET["e"]) { 
echo '<label  class="control-label">Trazabilidad:</label> ';
$actualizar579 = mysql_query("SELECT * FROM eventos_cert WHERE radi_cert=".$radicado22." and estado_eventos_cert=1", $conexion) or die(mysql_error());
$row1579 = mysql_fetch_assoc($actualizar579);
$total5579 = mysql_num_rows($actualizar579);
if (0<$total5579) {
echo 'Trazabilidad anterior:<br>';
 do { 
 
 echo $row1579['nombre_ciu'].' - '.$row1579['estado'].' - '.$row1579['tarea'].' - '.$row1579['fecha_eventos_cert'].'<br>';
 

 } while ($row1579 = mysql_fetch_assoc($actualizar579)); 
  mysql_free_result($actualizar579);
} else {}
} else {}
?>
</div>


<div class="form-group text-left" > 
<label  class="control-label">DESCRIPCIÓN DE LA PQRSD:</label><br><br>
<textarea required class="form-control textarea" name="descripcion_solicitud" id="texto_pqrs3"  style="min-height:400px;" required>
</textarea>
<br>

<?php if (isset($_GET["e"]) && ""!=$_GET["e"]) { ?>
<hr>
<br><br><b>Documentos adjuntos</b><br>
<?php

$actualizar57 = mysql_query("SELECT * FROM doc_cert WHERE radi_cert=".$radicado22." and estado_doc_cert=1", $conexion) or die(mysql_error());
$row157 = mysql_fetch_assoc($actualizar57);
$total557 = mysql_num_rows($actualizar57);
if (0<$total557) {
	$documentoscert='';
 do { 
 

 echo ' <a href="files/'.$row157['nombre_doc_cert'].'" target="_blank"> <img src="images/pdf.png">  Anexo</a><br>';   
 
$documentoscert.=$row157['nombre_doc_cert'].'%';
 

 
    
 } while ($row157 = mysql_fetch_assoc($actualizar57)); 
  mysql_free_result($actualizar57);
  
   echo '<input type="hidden" name="documentoscert" value="'.$documentoscert.'">';
   
   
} else { }


} else { }
?>


</div>

<div class="modal-footer">
<button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>

<?php if (isset($_GET["e"]) && ""!=$_GET["e"]) { ?>
<button type="submit" class="btn btn-success desaparecerboton">
<span class="glyphicon glyphicon-ok"></span> Siguiente </button>
<?php } else { ?>
<button type="submit" class="btn btn-success desaparecerboton">
<span class="glyphicon glyphicon-ok"></span> Siguiente </button>
<?php } ?>
</div>

</form>

		
		</div>  
    </div>      
          
<hr>

<br>
<br>		  
 </div>  			  

			
			
              <!-- /.table-responsive -->
            </div>
        
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
		
		
		<div class="col-md-3">


		  <div class="box box-success direct-chat direct-chat-warning" >
                <div class="box-header with-border">
                  <h3 class="box-title">Otras PQRS del mismo Ciudadano</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
				<div  class="modal-body" style="max-height:250px;">
			

<?php

$realdatecompleto=date('Y-m-d');
$fecha_actual = strtotime($realdatecompleto);
$valorpp=0;


$query48 = sprintf("SELECT * FROM solicitud_pqrs, ciudadano where ciudadano.id_ciudadano=".$id_ciudadano."  and solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and estado_solicitud_pqrs=1 order by id_solicitud_pqrs desc"); 
$result8 = $mysqli->query($query48);

	while($row9 = $result8->fetch_array(MYSQLI_ASSOC)) {
		
			echo '<a href="solicitud_pqrs&'.$row9['id_solicitud_pqrs'].'.jsp">'.$row9['radicado'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row9['fecha_radicado'].'</span><br>';
			echo $row9['nombre_solicitud_pqrs'].'<hr>';
			
$fechapq =  strtotime(date("Y-m-d", strtotime($row9['fecha_radicado'])));
if ($fecha_actual==$fechapq) {
	$valorpp.=1;
} else {
	
}	

	}
	$result8->free();
?>


		<?php
		
		


$actualizar57ll = mysql_query("SELECT * FROM radi_cert where identificacion='$identificacion' and estado_radi_cert=1", $conexion);
$row157ll = mysql_fetch_assoc($actualizar57ll);
$total557ll = mysql_num_rows($actualizar57ll);
if (0<$total557ll) {
 do { 
 
		echo '<a href="https://sisg.supernotariado.gov.co/radicado_anterior&'.$row157ll['id_radi_cert'].'.jsp">Certicamara '.$row157ll['radi_cert'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row157ll['fecha_radi_cert'].'</span><br>';
			echo $row157ll['nombre_radi_cert'].'<hr>';

 
 
 } while ($row157ll = mysql_fetch_assoc($actualizar57ll)); 
  mysql_free_result($actualizar57ll);
} else {}
?>




				</div>
			</div>	
	</div>
	
	
	<?php 
	$valorpp2=intval($valorpp);
	if (0<$valorpp2) {
		echo '<div style="background:#F39C3F;padding: 3px 3px 3px 3px;"><b>Validar si el documento ya fue radicado</b></div>';
	} else {}
	
/*echo $valorpp;
echo '<br>';
echo $fecha_actual;
echo '<br>';
echo $fechapq;
*/
	?>
	
	</div>
	
	
<?php } else {} 


 }
 
 mysql_free_result($actualizar6);
 
?>
	
	

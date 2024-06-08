<?php

$nump91=privilegios(91,$_SESSION['snr']);
 
if ((2==$_SESSION['snr_tipo_oficina'] and (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['lider_percepcion'])) or  24==$_SESSION['snr_grupo_area'] or 40==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol'] or 0<$nump91) {


?>


<script type="text/javascript">
function validate(){
	
	if (document.getElementById('clave_c2').value == document.getElementById('clave_c').value)  {
	return true;
	} else {	
 alert("Las claves seleccionadas deben coincidir en los dos campos");
	  return false;		
	}


 }
 
 

 </script>
 <?php
if ((isset($_POST["table"])) && ($_POST["table"] == "ciudadanos")) { 

$identificacion=$_POST["identificacion"];

if (isset($_POST["correo_c"]) && ""!=$_POST["correo_c"]) {
	$correo_c=$_POST["correo_c"];
	$infoc=" or correo_ciudadano='$correo_c'";
	
} else {
	$correo_c="correotrazadepqrs@supernotariado.gov.co";
	$infoc="";
}


$query4 = sprintf("SELECT identificacion FROM ciudadano where identificacion='$identificacion' ".$infoc." limit 1"); 
$select4 = mysql_query($query4, $conexion) or die(mysql_error());
$totalRows4 = mysql_num_rows($select4);
if (0<$totalRows4){ 
echo $usuariorepetido;
}
else {
	

	
	
$conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else {
	  
	 

$querypp = "SELECT idcorreocontacto FROM correocontacto order by idcorreocontacto desc limit 1"; 
$resultadopp = pg_query ($querypp);
$num_resultados = pg_num_rows ($resultadopp);
 	 
for ($i=0; $i<$num_resultados; $i++)
   {
$rowkk = pg_fetch_array ($resultadopp);
$cuenta=$rowkk['idcorreocontacto'];
 }


$incremental=$cuenta+1;


	
	
	
	

$insertSQL = sprintf("INSERT INTO ciudadano (nombre_ciudadano, id_tipo_documento, identificacion, idcorreocontactoiris, sexo, id_etnia, correo_ciudadano, clave_ciudadano, telefono_ciudadano, id_departamento, id_municipio, id_tipo_respuesta, direccion_ciudadano, fecha_registro, estado_ciudadano, fuente, cfuncionario) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($_POST["nombre_c"], "text"), 
GetSQLValueString($_POST["id_tipo_documento"], "int"), 
GetSQLValueString($_POST["identificacion"], "text"), 
GetSQLValueString($incremental, "text"), 
GetSQLValueString($_POST["sexo"], "text"), 
GetSQLValueString($_POST["id_etnia"], "int"), 
GetSQLValueString($correo_c, "text"), 
GetSQLValueString(md5($identi), "text"), 
GetSQLValueString($_POST["telefono_c"], "text"), 
GetSQLValueString($_POST["id_departamento"], "int"), 
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($_POST["id_tipo_respuesta"], "int"), 
GetSQLValueString($_POST["direccion_c"], "text"),
GetSQLValueString(1, "int"),
GetSQLValueString(0, "int"),
GetSQLValueString(0, "int"));
$Result = mysql_query($insertSQL, $conexion);


if (isset($_POST["correo_c"]) && ""!=$_POST["correo_c"]) { 


$emailu=$_POST["correo_c"];
$subject = 'Nueva clave PQRS';
$cuerpo = '';
$cuerpo .= 'Cordial saludo. '."\n\n"; 
$cuerpo .= 'La nueva clave para utilizar el sistema PQRS de la Superintendencia de Notariado y Registro es: '.$identi."\n\n"; 
$cuerpo .= 'Por favor cambiar la clave una vez entre al sistema.'."\n\n"; 
$cuerpo .= 'https://pqrs.supernotariado.gov.co'."\n\n"; 
$cuerpo .= 'Atentamente. '."\n\n"; 
$cabeceras = 'From: Supernotariado<notificadorD@supernotariado.gov.co>';

 $correo_ciudadano=$_POST["correo_c"];
} else { 
 $correo_ciudadano='';
}


$query488 = sprintf("SELECT id_ciudadano FROM ciudadano where identificacion='$identificacion' ".$infoc." limit 1"); 
$select488 = mysql_query($query488, $conexion) or die(mysql_error());
$row88 = mysql_fetch_assoc($select488);

$id_ciudadano=$row88['id_ciudadano'];
$nombre=$_POST["nombre_c"];
$identificacion=$_POST["identificacion"];
$telefono=$_POST["telefono_c"];
$direccion_ciudadano=$_POST["direccion_c"];

$idcorreoempresa = 4110;  
$cargo = '';  
$fax = '';  
$movil ='';
$creado = 1642;  
$fcreado = date("Y-m-d");  
$modificado = 0;  
$fmodificado = date("Y-m-d");  



$consultab = sprintf("INSERT INTO correocontacto (idcorreoempresa, codigo, nombre, ndocumento, cargo, telefono, fax, movil, mail, mailpersonal, descripcion, creado, fcreado, modificado, fmodificado ) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
 
GetSQLValueString('4110', "text"), 
GetSQLValueString($id_ciudadano, "int"), 
GetSQLValueString($nombre, "text"), 
GetSQLValueString($identificacion, "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString($telefono, "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString('', "text"), 
GetSQLValueString($correo_ciudadano, "text"), 
GetSQLValueString($correo_ciudadano, "text"), 
GetSQLValueString($direccion_ciudadano, "text"), 
GetSQLValueString(1642, "int"), 
GetSQLValueString($fcreado, "date"), 
GetSQLValueString(0, int), 
GetSQLValueString($fmodificado, "date"));


$resultado = pg_query ($consultab);


  pg_free_result($resultado);
  

  pg_close($conexionpostgresql);  

  }
  

  
  
$queryll = " INSERT INTO correocontacto ( idcorreocontacto, idcorreoempresa, codigo, nombre, ndocumento, cargo, telefono, fax, movil, mail, mailpersonal, descripcion, creado, fcreado, 
modificado, fmodificado )  VALUES ( '$incremental', '$idcorreoempresa', '$id_ciudadano', '$nombre', '$identificacion', '$cargo', '$telefono', '$fax', '$movil', '$correo_ciudadano', 
'$correo_ciudadano', '$direccion_ciudadano', '$creado', '$fcreado', '$modificado', '$fmodificado' ) "; 
$resultll = mysql_query($queryll); 








echo $insertado;
}
} else { }
?>
 
 
 
 
 
 <?php 
 $nump160=privilegios(160,$_SESSION['snr']);
 
 
 if (1==$_SESSION['rol'] or 0<$nump160) { 
 
 IF (ISSET($_POST['tema']) && ""!=$_POST['tema']) {
 
    $ced = trim($_POST["identificacion"]);
    $selecty = mysql_query("select identificacion from ciudadano where identificacion='$ced'", $conexion);
    $rowy = mysql_fetch_assoc($selecty);
    $totalRowsy = mysql_num_rows($selecty);
    if (0 < $totalRowsy) {

$updateSQL = sprintf("UPDATE ciudadano SET id_tipo_documento=%s, 
id_tipo_respuesta=%s, sexo=%s, id_etnia=%s, telefono_ciudadano=%s, 
id_departamento=%s, id_municipio=%s, direccion_ciudadano=%s where identificacion=%s  and id_ciudadano!=21373",
GetSQLValueString($_POST["id_tipo_documento"], "int"), 
GetSQLValueString($_POST["id_tipo_respuesta"], "int"),
GetSQLValueString($_POST["sexo"], "text"),  
GetSQLValueString($_POST["id_etnia"], "int"), 
GetSQLValueString($_POST["telefono_ciudadano"], "text"), 
GetSQLValueString($_POST["id_departamento"], "int"), 
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($_POST["direccion_ciudadano"], "text"), 
GetSQLValueString($ced, "int"));
$Result = mysql_query($updateSQL, $conexion);


 
    } else {


    $insertSQL = sprintf("INSERT INTO ciudadano (nombre_ciudadano, id_tipo_documento, identificacion, 
	idcorreocontactoiris, sexo, id_etnia, correo_ciudadano, clave_ciudadano, telefono_ciudadano,
	id_departamento, id_municipio, id_tipo_respuesta, direccion_ciudadano, fecha_registro,
	estado_ciudadano, fuente, cfuncionario) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($_POST["nombre_c"], "text"), 
GetSQLValueString($_POST["id_tipo_documento"], "int"), 
GetSQLValueString($ced, "text"), 
GetSQLValueString('1', "text"), 
GetSQLValueString($_POST["sexo"], "text"), 
GetSQLValueString($_POST["id_etnia"], "int"), 
GetSQLValueString($_POST["correo_c"], "text"), 
GetSQLValueString(md5($identi), "text"), 
GetSQLValueString($_POST["telefono_c"], "text"), 
GetSQLValueString($_POST["id_departamento"], "int"), 
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($_POST["id_tipo_respuesta"], "int"), 
GetSQLValueString($_POST["direccion_c"], "text"),
GetSQLValueString(1, "int"),
GetSQLValueString(0, "int"),
GetSQLValueString(0, "int"));
$Result = mysql_query($insertSQL, $conexion);

     
    }


  $insertSQL = sprintf("INSERT INTO tema_ciudadano (nombre_tema_ciudadano, id_funcionario,  tipo_entrada, 
 id_municipio,   identificacion, fecha_tema_ciudadano,  estado_tema_ciudadano) 
VALUES (%s, %s, %s, %s, %s, now(), %s)", 
GetSQLValueString($_POST["tema"], "text"), 
GetSQLValueString($_SESSION["snr"], "text"),
GetSQLValueString($_POST["tipo_entrada"], "text"),
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($ced, "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

 echo $insertado;
}
 else { }

 ?>
 	<div class="modal fade" id="popupnewciudadano2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">NUEVA ATENCIÓN:</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1">
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE:</label> 
<input type="text" class="form-control" name="nombre_c"  required>
</div>
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE DOCUMENTO:</label> 
<select  class="form-control" name="id_tipo_documento" required>
<option value="0" selected>Anónimo</option>
<?php
echo lista('tipo_documento');
?>
</select>
</div>
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE IDENTIFICACION:</label> 
<input type="text" class="form-control numero" name="identificacion" placeholder="Para anónimos, colocar 0" required>
</div>



<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE ATENCIÓN:</label> 
<select  class="form-control" name="tipo_entrada" required>
<option value="" selected></option>
<option>Presencial</option>
<option>Telefonico</option>
</select>
</div>



<div class="form-group text-left" > 
<label  class="control-label">GENERO:</label> 
<select  class="form-control" name="sexo" required>
<option value="" selected></option>
<option value="Mujer">Mujer</option>
<option value="Hombre">Hombre</option>
</select>
</div>



<div class="form-group text-left" > 
<label  class="control-label">ETNIA:</label> 
<select  class="form-control" name="id_etnia">
<option value="6" selected></option>
<?php
echo lista('etnia');
?>
</select>
</div>

<div class="form-group text-left" > 
<label  class="control-label">TELEFONO:</label> 
<input type="text" class="form-control" name="telefono_c">
</div>


<div class="form-group text-left" > 
<label  class="control-label">PAIS:</label> 
<select  class="form-control" name="id_pais" required>
<option value="45" selected>Colombia</option>
<?php echo lista('pais'); ?>
</select>
</div>



<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> DEPARTAMENTO</label> 
<select name="id_departamento" id="id_departamentomun2" class="form-control" required>
		
<option value="11" selected>Cundinamarca / Bogotá</option>
<?php
echo lista ('departamento');
?>
</select> 
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> MUNICIPIO:</label> 
<select class="form-control" name="id_municipio" id="id_municipiomun2" required>
<option value="149" selected>Bogotá</option>
</select>
</div>


<input type="hidden" class="form-control" name="id_tipo_respuesta" value="1">


<div class="form-group text-left" > 
<label  class="control-label"> EMAIL:</label> 
<input type="email" class="form-control" name="correo_c"  placeholder="" >
</div>


<div class="form-group text-left" > 
<label  class="control-label"> DIRECCION:</label> 
<input type="text" class="form-control" name="direccion_c"  id="direccion_c" >
</div>




<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> TEMA:</label> 
<textarea class="form-control" name="tema" required></textarea>
</div>




<div class="modal-footer">
<button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>
</form>

</div>
</div> 
</div> 
</div> 
 
 <?php } else {} ?>
 
 
 
 
 
 
 
 
	<div class="modal fade" id="popupnewciudadano" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">NUEVO CIUDADANO:</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1">
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE:</label> 
<input type="text" class="form-control" name="nombre_c"  required>
</div>
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE DOCUMENTO:</label> 
<select  class="form-control" name="id_tipo_documento" required>
<option value="" selected></option>
<?php
$query = sprintf("SELECT id_tipo_documento, nombre_tipo_documento FROM tipo_documento where estado_tipo_documento=1 order by id_tipo_documento"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_documento'].'">'.$row['nombre_tipo_documento'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE IDENTIFICACION:</label> 
<input type="text" class="form-control numero" name="identificacion"  required>
</div>


<div class="form-group text-left" > 
<label  class="control-label">GENERO:</label> 
<select  class="form-control" name="sexo" required>
<option value="" selected></option>
<option value="Mujer">Mujer</option>
<option value="Hombre">Hombre</option>
</select>
</div>



<div class="form-group text-left" > 
<label  class="control-label">ETNIA:</label> 
<select  class="form-control" name="id_etnia">
<option value="6" selected></option>
<?php
$query = sprintf("SELECT id_etnia, nombre_etnia FROM etnia where estado_etnia=1 order by id_etnia"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_etnia'].'">'.$row['nombre_etnia'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<div class="form-group text-left" > 
<label  class="control-label">TELEFONO:</label> 
<input type="text" class="form-control" name="telefono_c">
</div>



<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> DEPARTAMENTO</label> 
<select name="id_departamento" id="id_departamentomun" class="form-control">
		
<option value="" selected></option>
<?php
$query = sprintf("SELECT id_departamento, nombre_departamento FROM departamento where estado_departamento=1 order by id_departamento"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_departamento'].'">'.strtoupper($row['nombre_departamento']).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select> 
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> MUNICIPIO:</label> 
<select class="form-control" name="id_municipio" id="id_municipiomun" required>

</select>
</div>


<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span>  POR QUE MEDIO DESEA RECIBIR SU RESPUESTA:</label> 
<select  class="form-control" name="id_tipo_respuesta" id="id_tipo_respuesta" required>
<option value="" selected></option>
<?php
$query = sprintf("SELECT id_tipo_respuesta, nombre_tipo_respuesta FROM tipo_respuesta where estado_tipo_respuesta=1 order by id_tipo_respuesta"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_respuesta'].'">'.$row['nombre_tipo_respuesta'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>



<div class="form-group text-left" > 
<label  class="control-label"><span id="correoc" style="display:none;">*</span> CORREO ELECTRÓNICO:</label> 
<input type="email" class="form-control" name="correo_c"  id="correo_c">
</div>


<div class="form-group text-left" > 
<label  class="control-label"><span id="direccionc" style="display:none;">*</span> DIRECCION:</label> 
<input type="text" class="form-control" name="direccion_c"  id="direccion_c" >
</div>





<div class="form-group text-left" > 
<span style="color:#ff0000;"> La clave del ciudadano llega al correo electrónico registrado.</span>
</div>


<div class="modal-footer">
<button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success" onclick="infomun();">
<input type="hidden" name="table" value="ciudadanos">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>
</form>

</div>
</div> 
</div> 
</div> 






<!--/////////////////////////-->

<?php

if (1==$_SESSION['snr_tipo_oficina']){
$valp=0;
} else if (2==$_SESSION['snr_tipo_oficina']){
$valp=$_SESSION['id_oficina_registro'];
} else { }



if ((isset($_POST["table"])) && ($_POST["table"] == "percepcion_oac")) { 

if (isset($_POST["cedula_percepcion"]) and ""!=$_POST["cedula_percepcion"]) {

$cedulap=$_POST["cedula_percepcion"];

$queryk = sprintf("SELECT count(id_ciudadano) as totalc FROM ciudadano where identificacion='$cedulap' and estado_ciudadano=1"); 
$selectk = mysql_query($queryk, $conexion) or die(mysql_error());
$rowk = mysql_fetch_assoc($selectk);
$totalRowskk=$rowk['totalc'];
	
} else {

	$totalRowskk=0;
}



if (0<$totalRowskk){
echo'<script type="text/javascript">swal(" ERROR !", " La Cedula si existe en el sistema. El registro no se pudo y debe realizar como anónimo. !", "error");</script>';
} else {

	




$insertSQL = sprintf("INSERT INTO percepcion_oac (id_ciudadano, cedula_percepcion, modulo_atencion, id_funcionario_atendio, id_servicio_oac, calificacion_servicio, nombre_percepcion_oac, claridad_lenguaje, agilidad_atencion, calidad_respuesta, tiempo_respuesta, amabilidad_atencion, observaciones, fecha_percepcion_oac, estado_percepcion_oac, id_oficina_registro, id_tipo_ciudadano) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString(21373, "int"), 
GetSQLValueString($_POST["cedula_percepcion"], "text"), 
GetSQLValueString($_POST["modulo_atencion"], "int"), 
GetSQLValueString($_POST["id_funcionario_atendio"], "int"), 
GetSQLValueString($_POST["id_servicio_oac"], "int"), 
GetSQLValueString($_POST["calificacion_servicio"], "int"), 
GetSQLValueString($_POST["nombre_percepcion_oac"], "text"), 
GetSQLValueString($_POST["claridad_lenguaje"], "int"), 
GetSQLValueString($_POST["agilidad_atencion"], "int"), 
GetSQLValueString($_POST["calidad_respuesta"], "int"), 
GetSQLValueString($_POST["tiempo_respuesta"], "int"), 
GetSQLValueString($_POST["amabilidad_atencion"], "int"), 
GetSQLValueString($_POST["observaciones"], "text"), 
GetSQLValueString($_POST["fecha_percepcion_oac"], "date"), 
GetSQLValueString(1, "int"),
GetSQLValueString($valp, "int"),
GetSQLValueString($_POST["id_tipo_ciudadano"], "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo $insertado;
}
} else {
	
}

?>


<div class="modal fade" id="popupnewpercepcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Percepción Anónima - 
<?php 
if (1==$_SESSION['snr_tipo_oficina']){
echo 'Oficina de Atención al Ciudadano';
} else if (2==$_SESSION['snr_tipo_oficina']){
$valp=$_SESSION['id_oficina_registro'];
echo quees('oficina_registro', $valp);

} else { }
 ?></label></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="POST" name="for3234456345m1">



<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label">Existe Cedula:</label> 
<input type="checkbox"  id="ver_cedula" >
</div>
</div>
<div class="col-md-8">
<input type="text" class="form-control" placeholder="Cedula" name="cedula_percepcion" id="cedula_percepcion" style="display:none;">
</div>
</div>




<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA:</label> 
</div>
</div>
<div class="col-md-8">
<input type="date" class="form-control datepicker" readonly="readonly" name="fecha_percepcion_oac" style="width:180px;" required>
</div>
</div>










<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> EL CIUDADANO ES:</label> 
<select  class="form-control" name="id_tipo_ciudadano" required>
<option value="" selected></option>
<?php
$query = sprintf("SELECT * FROM tipo_ciudadano where estado_tipo_ciudadano=1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_ciudadano'].'">'.strtoupper(utf8_encode($row['nombre_tipo_ciudadano'])).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>




<div class="row">
<div class="col-md-4">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MODULO DE ATENCION:</label> 
</div>
</div>
<div class="col-md-8">
<select class="form-control" name="modulo_atencion" style="width:80px;" required> 
<option value="" selected></option>
 <?php 
        for ($i = 1; $i <= 20; $i++){
          
            echo '<option>'.$i.'</option>';

        };

    ?>
</select>
</div>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> SERVIDOR PÚBLICO QUE LO ATENDIO:</label> 
<select  class="form-control" name="id_funcionario_atendio" required>
<option value="" selected></option>

<?php
if (0==$valp) {
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_grupo_area=24 and id_tipo_oficina=1 and estado_funcionario=1 order by nombre_funcionario"); 
} else {
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_oficina_registro=".$valp." and estado_funcionario=1 order by nombre_funcionario"); 
}
$select = mysql_query($query, $conexion) or die(mysql_error());

$row = mysql_fetch_assoc($select);

$totalRows = mysql_num_rows($select);

if (0<$totalRows){

do {

	echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

?>
<option value="0" title="Persona que opera servicios como Reval, Kioscos, entre otros.">AGENTE DE SERVICIO</option>

</select>
</div>


<div class="row">
<div class="col-md-6">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE SERVICIO UTILIZADO:</label> 
<select  class="form-control" name="id_servicio_oac" required>
<option value="" selected></option>
<?php echo lista('servicio_oac'); ?>
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CALIFICACION DEL SERVICIO:</label> 
<select  class="form-control" name="calificacion_servicio" required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
</div>
</div>



<div class="form-group text-left"> 
<label  class="control-label">COMENTARIO SOBRE LA CALIFICACIÓN:</label> 
<textarea name="nombre_percepcion_oac" style="width:100%;height:200px;"></textarea>
</div>
<hr>
<div class="row">
<div class="col-md-12">
<div class="form-group text-left"> 
<b><center>
CALIFIQUE LA PRESTACIÓN DEL SERVICIO RECIBIDO EN ESTA OFICINA, EN CUANTO A:
</center>
</B>
</div>
</div>

</div>
<hr>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CLARIDAD DEL LENGUAJE:</label> 
<select  class="form-control" name="claridad_lenguaje" required >
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> AGILIDAD EN LA ATENCIÓN:</label> 
<select  class="form-control" name="agilidad_atencion" required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CALIDAD DE LA RESPUESTA:</label> 
<select  class="form-control" name="calidad_respuesta" required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIEMPO DE RESPUESTA:</label> 
<select  class="form-control" name="tiempo_respuesta" required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> AMABILIDAD EN LA ATENCION:</label> 
<select  class="form-control" name="amabilidad_atencion" required>
<option value="" selected></option>
<?php echo lista('calificacion'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">OBSERVACIONES Y/O SUGERENCIAS:</label> 
<textarea class="form-control" name="observaciones" style="height:200px;"></textarea>
</div>

<div class="modal-footer">
<span style="color:#ff0000;">* Obligatorio</span>
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="percepcion_oac">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div></form>


</div>
</div> 
</div> 
</div> 




 <div class="row">
	   
	   
	   
	          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
echo existencia('ciudadano');
?></h3>

              <p>Ciudadanos</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
	   
	   
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3>
<?php echo existencia('percepcion_oac'); ?>
 
			  </h3>

              <p>Encuestas de Percepción</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
		   <a href="https://sisg.supernotariado.gov.co/percepcion_reporte.jsp" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
 
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('solicitud_pqrs'); ?></h3>

              <p>PQRS</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
              <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo existencia('tema_ciudadano'); ?></h3>

              <p>Atención presencial y telefónico.</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
             <a href="xls/atencion_ciudadanos.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
	 
      </div>



	
	<div class="row">
<div class="col-md-12">



 <div class="box box-info">
            <div class="box-header with-border">
  
			
				
		<form class="navbar-form" name="form1erteg" method="post" action="">

<div class="col-md-2">
<?php if ((2==$_SESSION['snr_tipo_oficina'] and (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['lider_percepcion'])) or  24==$_SESSION['snr_grupo_area'] or 40==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) { ?>
<a href="" class="btn btn-success" class="ventana1" data-toggle="modal" data-target="#popupnewciudadano"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo ciudadano</a>
<?php } else { }?>
</div>



<div class="col-md-2">
<?php  if (1==$_SESSION['rol'] or 0<$nump160) { ?>
<a href="" class="btn btn-danger"  data-toggle="modal" data-target="#popupnewciudadano2"><span class="glyphicon glyphicon-plus-sign"></span> Nueva atención</a>
<?php } else { }?>
</div>



<div class="col-md-2">
<?php if ((2==$_SESSION['snr_tipo_oficina'] and (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['lider_percepcion'])) or 24 == $_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) { ?>
 <a href="" class="btn btn-warning" data-toggle="modal" data-target="#popupnewpercepcion">
<span class="glyphicon glyphicon-plus-sign"></span> Percepción anónima </a>
<?php } else { }?>
</div>

<div class="col-md-2">
<?php if ((1==$_SESSION['snr_tipo_oficina'] and 24==$_SESSION['snr_grupo_area']) or 1==$_SESSION['rol']) { ?>
 <a href="nueva_pqrs&21373.jsp" class="btn btn-warning" >
<span class="glyphicon glyphicon-plus-sign"></span> PQRS anónima </a>
<?php } else { }?>
</div>

<div class="col-md-4">
<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected> - - Buscar por: - -  </option>
		  <?php if (1==$_SESSION['snr_tipo_oficina']) {
			echo ' <option value="nombre_ciudadano">Nombre</option>';
		  } else {  }?>

 		  <option value="identificacion">Identificación</option>
		   <option value="correo_ciudadano">Correo</option>
		  </select>
</div><!-- /btn-group -->
<div class="input-group-btn"><input type="text" name="buscar" placeholder="Buscar Texto" class="form-control" required ></div>
    <!-- /input-group -->
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>
</div>



</form>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
  
            <div class="box-body">
			<style>
.dataTables_filter {
display:none;
}
			</style>
              <div class="table-responsive">
               <table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
<th>Identificación</th>
				  <th>Nombre</th>
				   <th>Correo</th>
				   
				
<th style="width:250px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
	$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
} else {
	$infobus="";
}
				


$query4="SELECT * from ciudadano where estado_ciudadano=1 ".$infobus." order by id_ciudadano asc limit 200  "; //LIMIT 500 OFFSET ".$pagina."


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
<?php
$id_res=$row['id_ciudadano'];
echo '<td>'.$row['identificacion'].'</td>';
echo '<td>'.$row['nombre_ciudadano'].'</td>';
echo '<td>'.$row['correo_ciudadano'].'</td>';
echo '<td>';
if ((2==$_SESSION['snr_tipo_oficina'] and (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['lider_percepcion'])) or  24==$_SESSION['snr_grupo_area'] or 40==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) { 
echo '<a href="ciudadano&'.$id_res.'.jsp"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; ';
} else { }

if ((2==$_SESSION['snr_tipo_oficina'] and (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs'] or 1==$_SESSION['lider_percepcion'])) or  24==$_SESSION['snr_grupo_area'] or 40==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) { 
echo '<a href="nueva_pqrs&'.$id_res.'.jsp"><span class="label label-success"><b>+</b> PQRS</span></a>  &nbsp;   ';
} else { }

if ((2==$_SESSION['snr_tipo_oficina'] and (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['lider_percepcion'])) or 24 == $_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) { 
echo '<a href="nueva_percepcion&'.$id_res.'.jsp"><span class="label label-warning"><b>+</b> Percepción</span></a>  &nbsp;  ';
} else { }
echo '<a href="info_ciudadano&'.$id_res.'.jsp"><span class="fa fa-search"></span></a>  &nbsp;  ';


echo '</td>';

echo '<td>';


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
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
		  
		  


        </div>

</div>

<?php } else {} ?>

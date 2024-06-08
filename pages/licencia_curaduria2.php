<?php
if (isset($_GET['i'])) {
	$id=$_GET['i'];
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }


if (1==$_SESSION['rol'] or 3184==$_SESSION['snr']) {
	
$query = sprintf("SELECT * FROM curaduria, situacion_curaduria where situacion_curaduria.fecha_terminacion>='$realdate' and curaduria.id_curaduria=situacion_curaduria.id_curaduria  and curaduria.id_curaduria=".$id."  and curaduria.estado_curaduria=1 and estado_situacion_curaduria=1 limit 1"); 
	
} 
else {
$idfun=intval($_SESSION['snr']);
$query = sprintf("SELECT * FROM curaduria, situacion_curaduria where (situacion_curaduria.fecha_terminacion>='$realdate' or situacion_curaduria.fecha_terminacion is null) and curaduria.id_curaduria=situacion_curaduria.id_curaduria  and curaduria.id_curaduria=".$id." and situacion_curaduria.id_funcionario=".$idfun."  and curaduria.estado_curaduria=1 and estado_situacion_curaduria=1 limit 1"); 
	
}


$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
$name = $row1['nombre_curaduria'];
$dep = $row1['departamento_curaduria'];
$ciudad = $row1['ciudad_curaduria'];
$tele = $row1['telefono_curaduria'];
$celu = $row1['celular_curaduria'];
$dire = $row1['direccion_curaduria'];
$nombre_curador = $row1['nombre_funcionario'];
$correo = $row1['correo_funcionario'];
$correo_curaduria = $row1['correo_curaduria'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];
$ncuraduria=$row1['numero_curaduria'];


$idfuncionarioreal=$_SESSION['snr'];



if ((isset($_POST['table'])) && ($_POST['table'] == "licencia_curaduria")) { 



$identificador=$id_departamento.$id_municipio.'-'.$ncuraduria.'-'.$_POST["ano_licencia"].'-'.$_POST["nombre_licencia_curaduria"];

$actualizar56 = mysql_query("SELECT nombre_licencia_curaduria FROM licencia_curaduria WHERE id_curaduria=".$id." and nombre_licencia_curaduria='$identificador' and estado_licencia_curaduria=1", $conexion);
$row156 = mysql_fetch_assoc($actualizar56);
$total556 = mysql_num_rows($actualizar56);
if (0<$total556) {
	echo $repetido;
} else {




$fecha_radicacion=date('Y-m-d', strtotime($_POST["fecha_radicacion"]));
$fecha_expedicion=date('Y-m-d', strtotime($_POST["fecha_expedicion"]));
$fecha_ejecutoria=date('Y-m-d', strtotime($_POST["fecha_ejecutoria"]));

if ($fecha_radicacion<$fecha_expedicion && $fecha_radicacion<$fecha_ejecutoria && $fecha_ejecutoria>=$fecha_expedicion) {


$objeto=$_POST["id_objeto_lic_curaduria"];

///////////////////////////////////

 if (1==$objeto) {

$valido=1;

 } else if (2==$objeto) {
	 
$fechaven=$_POST["fecha_vencimiento_licencia_inicial"];
$fechavencemes=date("Y-m-d", strtotime($fechaven."- 1 month"));
if ($fechavencemes<=$fecha_radicacion && $fechaven>=$fecha_radicacion) {
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];
$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());

//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La prorroga 1 no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }

		
		
		
		 }
		 else if (3==$objeto) {
   // $licencia_inicial='';
	// $prorroga1='';
	
$fechaven=$_POST["fecha_vencimiento_licencia_inicial"];
$fechaven2 =date("Y-m-d", strtotime($fechaven."+ 1 year"));
$fechavencemes=date("Y-m-d", strtotime($fechaven2."- 1 month"));
if ($fechavencemes<=$fecha_radicacion && $fechaven2>=$fecha_radicacion) {
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];


$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());


/////// prorroga1

$identificador_prorroga1=$id_departamento.$id_municipio.'-'.$_POST["curaduria_prorroga1"].'-'.$_POST["ano_licencia_prorroga1"].'-'.$_POST["nombre_licencia_curaduria_prorroga1"];

$insertSQL_prorroga1 = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Prorroga 1', "text"), 
GetSQLValueString($identificador_prorroga1, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_prorroga1"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_prorroga1 = mysql_query($insertSQL_prorroga1, $conexion) or die(mysql_error());




//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La prorroga 2 no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }

	
	

		 }
  else if (4==$objeto) {
       //  $licencia_inicial='';

$fechaven=$_POST["fecha_vencimiento_licencia_inicial"];
if ($fechaven>=$fecha_radicacion) {
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];
$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());

//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La modificación no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }
   
	   
	   
	   

  } else if (5==$objeto) {
    // $licencia_inicial='';
	 
$fechaven=$_POST["fecha_vencimiento_licencia_inicial"];
$fechareva=date("Y-m-d", strtotime($fechaven."+ 2 month"));

if ($fechareva>=$fecha_radicacion) {
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];
$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());

//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La revalidación no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }
   
	 
	 

  } else if (6==$objeto) {	  
		  //$licencia_inicial='';
		  //$prorroga1='';
 
 	
$fechaven=$_POST["fecha_vencimiento_licencia_inicial"];
$fechaven2 =date("Y-m-d", strtotime($fechaven."+ 1 year"));
if ($fechaven2>=$fecha_radicacion) {
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];


$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());


/////// prorroga1

$identificador_prorroga1=$id_departamento.$id_municipio.'-'.$_POST["curaduria_prorroga1"].'-'.$_POST["ano_licencia_prorroga1"].'-'.$_POST["nombre_licencia_curaduria_prorroga1"];

$insertSQL_prorroga1 = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Prorroga 1', "text"), 
GetSQLValueString($identificador_prorroga1, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_prorroga1"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_prorroga1 = mysql_query($insertSQL_prorroga1, $conexion) or die(mysql_error());




//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La prorroga 2 no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }

   
 

 
 
 
 
  } else if (7==$objeto) {
 
 		  //  $licencia_inicial='';
         //  $prorroga1='';
		//  $prorroga2='';

$fechaven=$_POST["fecha_vencimiento_licencia_inicial"];
$fechaven2 =date("Y-m-d", strtotime($fechaven."+ 2 year"));
if ($fechaven2>=$fecha_radicacion) {
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];


$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());


/////// prorroga1

$identificador_prorroga1=$id_departamento.$id_municipio.'-'.$_POST["curaduria_prorroga1"].'-'.$_POST["ano_licencia_prorroga1"].'-'.$_POST["nombre_licencia_curaduria_prorroga1"];

$insertSQL_prorroga1 = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Prorroga 1', "text"), 
GetSQLValueString($identificador_prorroga1, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_prorroga1"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_prorroga1 = mysql_query($insertSQL_prorroga1, $conexion) or die(mysql_error());



/////// prorroga2

$identificador_prorroga2=$id_departamento.$id_municipio.'-'.$_POST["curaduria_prorroga2"].'-'.$_POST["ano_licencia_prorroga2"].'-'.$_POST["nombre_licencia_curaduria_prorroga2"];

$insertSQL_prorroga2 = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Prorroga 2', "text"), 
GetSQLValueString($identificador_prorroga2, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_prorroga2"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_prorroga2 = mysql_query($insertSQL_prorroga2, $conexion) or die(mysql_error());






//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La modificación de la prorroga 2 no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }



   
			  
			  
			  
			  
			  
  } else if (8==$objeto) {  
		//	$licencia_inicial='';
         //  $revalidacion='';	 

//fecha_vencimiento_revalidacion


$fechaven=$_POST["fecha_vencimiento_revalidacion"];
$fechavencemes=date("Y-m-d", strtotime($fechaven."- 1 month"));

if ($fechavencemes<=$fecha_radicacion && $fechaven>=$fecha_radicacion) {
	
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];


$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());


/////// revalidacion

$identificador_revalidacion=$id_departamento.$id_municipio.'-'.$_POST["curaduria_revalidacion"].'-'.$_POST["ano_licencia_revalidacion"].'-'.$_POST["nombre_licencia_curaduria_revalidacion"];

$insertSQL_revalidacion = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Revalidación', "text"), 
GetSQLValueString($identificador_revalidacion, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_revalidacion"], "text"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_revalidacion = mysql_query($insertSQL_revalidacion, $conexion) or die(mysql_error());

//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La prorroga de la revalidación no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }


			  
  }  else if (9==$objeto) { 
 	//$licencia_inicial='';
 //$revalidacion='';

$fechaven=$_POST["fecha_vencimiento_revalidacion"];

if ($fechaven>=$fecha_radicacion) {
	
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];


$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());


/////// revalidacion

$identificador_revalidacion=$id_departamento.$id_municipio.'-'.$_POST["curaduria_revalidacion"].'-'.$_POST["ano_licencia_revalidacion"].'-'.$_POST["nombre_licencia_curaduria_revalidacion"];

$insertSQL_revalidacion = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Revalidación', "text"), 
GetSQLValueString($identificador_revalidacion, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_revalidacion"], "text"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_revalidacion = mysql_query($insertSQL_revalidacion, $conexion) or die(mysql_error());

//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La modificación de la revalidación no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }

   



 
 
  } else if (10==$objeto) { 
  
  //	$licencia_inicial='';
	//	  $prorroga1='';
		//	  $revalidacion='';	
  
$fechaven=$_POST["fecha_vencimiento_revalidacion"];
$fechaven2 =date("Y-m-d", strtotime($fechaven."+ 1 year"));
if ($fechaven2>=$fecha_radicacion) {
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];


$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());


/////// prorroga1

$identificador_prorroga1=$id_departamento.$id_municipio.'-'.$_POST["curaduria_prorroga1"].'-'.$_POST["ano_licencia_prorroga1"].'-'.$_POST["nombre_licencia_curaduria_prorroga1"];

$insertSQL_prorroga1 = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Prorroga 1', "text"), 
GetSQLValueString($identificador_prorroga1, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_prorroga1"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_prorroga1 = mysql_query($insertSQL_prorroga1, $conexion) or die(mysql_error());



  
  /////// revalidacion

$identificador_revalidacion=$id_departamento.$id_municipio.'-'.$_POST["curaduria_revalidacion"].'-'.$_POST["ano_licencia_revalidacion"].'-'.$_POST["nombre_licencia_curaduria_revalidacion"];

$insertSQL_revalidacion = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Revalidación', "text"), 
GetSQLValueString($identificador_revalidacion, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_revalidacion"], "text"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_revalidacion = mysql_query($insertSQL_revalidacion, $conexion) or die(mysql_error());

//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La modificación de la revalidación con prorroga no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }
  
  
  
  
  
  
    } else if (11==$objeto) { 
	
	
	 		  //  $licencia_inicial='';
         //  $prorroga1='';


$fechaven=$_POST["fecha_vencimiento_licencia_inicial"];
$fechaven2 =date("Y-m-d", strtotime($fechaven."+ 1 year"));
$fechavencemes=date("Y-m-d", strtotime($fechaven2."+ 2 month"));


if ($fechavencemes>=$fecha_radicacion) {
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];


$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());


/////// prorroga1

$identificador_prorroga1=$id_departamento.$id_municipio.'-'.$_POST["curaduria_prorroga1"].'-'.$_POST["ano_licencia_prorroga1"].'-'.$_POST["nombre_licencia_curaduria_prorroga1"];

$insertSQL_prorroga1 = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Prorroga 1', "text"), 
GetSQLValueString($identificador_prorroga1, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_prorroga1"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_prorroga1 = mysql_query($insertSQL_prorroga1, $conexion) or die(mysql_error());







//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La modificación de la prorroga 2 no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }



	
	  } else if (12==$objeto) { 
	  
	  
  
  	  //  $licencia_inicial='';
    //  $prorroga1='';
//  $prorroga2='';


$fechaven=$_POST["fecha_vencimiento_licencia_inicial"];
$fechaven2 =date("Y-m-d", strtotime($fechaven."+ 2 year"));
$fechavencemes=date("Y-m-d", strtotime($fechaven2."+ 2 month"));


if ($fechavencemes>=$fecha_radicacion) {
$identificador_inicial=$id_departamento.$id_municipio.'-'.$_POST["curaduria_inicial"].'-'.$_POST["ano_licencia_inicial"].'-'.$_POST["nombre_licencia_curaduria_inicial"];


$insertSQL_inicial = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Licencia inicial', "text"), 
GetSQLValueString($identificador_inicial, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_inicial"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_inicial = mysql_query($insertSQL_inicial, $conexion) or die(mysql_error());


/////// prorroga1

$identificador_prorroga1=$id_departamento.$id_municipio.'-'.$_POST["curaduria_prorroga1"].'-'.$_POST["ano_licencia_prorroga1"].'-'.$_POST["nombre_licencia_curaduria_prorroga1"];

$insertSQL_prorroga1 = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Prorroga 1', "text"), 
GetSQLValueString($identificador_prorroga1, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_prorroga1"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_prorroga1 = mysql_query($insertSQL_prorroga1, $conexion) or die(mysql_error());



/////// prorroga2

$identificador_prorroga2=$id_departamento.$id_municipio.'-'.$_POST["curaduria_prorroga2"].'-'.$_POST["ano_licencia_prorroga2"].'-'.$_POST["nombre_licencia_curaduria_prorroga2"];

$insertSQL_prorroga2 = sprintf("INSERT INTO detalle_otra_licencia 
(nombre_licencia_curaduria, tipo_objeto, nombre_detalle_otra_licencia, acto_administrativo, fecha_ejecutoria_inicial, fecha_vencimiento_inicial, estado_detalle_otra_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString('Prorroga 2', "text"), 
GetSQLValueString($identificador_prorroga2, "text"), 
GetSQLValueString($_POST["n_acto_administrativo_prorroga2"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria_inicial"], "date"), 
GetSQLValueString($fechaven, "date"), 
GetSQLValueString(1, "int"));
$Result_prorroga2 = mysql_query($insertSQL_prorroga2, $conexion) or die(mysql_error());






//echo '<script>alert("Si '.$identificador_inicial.'");</script>';
$valido=1;
   } else {	 
echo '<script type="text/javascript">swal(" ERROR!", " La modificación de la prorroga 2 no esta dentro del plazo de la licencia. !", "error"); </script>';
$valido=0;
   }



   
   
  
  } else {
	  
  }
  
  


if (1==$valido) {

$insertSQL = sprintf("INSERT INTO licencia_curaduria (id_curaduria, id_funcionario, nombre_licencia_curaduria, fecha_licencia_real, fecha_radicacion, fecha_expedicion, fecha_ejecutoria, n_acto_administrativo, certificado_ocupacion, autorizacion_ocupacion, observacion_licencia, situacion_licencia, estado_licencia_curaduria, id_estado_lic_curaduria, n_titulares, n_predios, id_objeto_lic_curaduria) 
VALUES (%s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($idfuncionarioreal, "int"), 
GetSQLValueString($identificador, "text"), 
GetSQLValueString($_POST["fecha_radicacion"], "date"), 
GetSQLValueString($_POST["fecha_expedicion"], "date"), 
GetSQLValueString($_POST["fecha_ejecutoria"], "date"), 
GetSQLValueString(trim($_POST["n_acto_administrativo"]), "text"),  
GetSQLValueString($_POST["certificado_ocupacion"], "text"), 
GetSQLValueString($_POST["autorizacion_ocupacion"], "text"), 
GetSQLValueString($_POST["observacion_licencia"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"),
GetSQLValueString($_POST["id_estado_lic_curaduria"], "int"),
GetSQLValueString($_POST["n_titulares"], "int"),
GetSQLValueString($_POST["n_predios"], "int"),
GetSQLValueString($objeto, "int")
);
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo $insertado;


$actualizar5 = mysql_query("SELECT id_licencia_curaduria FROM licencia_curaduria WHERE id_curaduria=".$id." and nombre_licencia_curaduria='$identificador' limit 1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$id_lic2 = $row15['id_licencia_curaduria'];
echo '<meta http-equiv="refresh" content="0;URL=licencia&'.$id_lic2.'.jsp" />';



} else {
	
	
}




} else {
echo '<div class="alert alert-danger" role="alert"><a href="" class="close" style="text-decoration:none;">&times;</a>Las fechas no estan de acuerdo al orden cronológico.</div>';
	
}


}
  mysql_free_result($actualizar56);

} else { }




?>	

<script>




        $(document).ready(function(){
			
		 $('#objeto_tramite').change(function() {
        var obt =document.getElementById("objeto_tramite").value;

		
		 if (1==obt) {	
		     $('#licencia_inicial').attr('style','display:none;');
			  $('#prorroga1').attr('style','display:none;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:none;');	  
  
			  $('.requerimiento').attr('style','display:display;');	
			  
		 }
		 else if (2==obt) {
   
        $('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:none;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:none;');	
			  
			    $('.requerimiento').attr('style','display:none;');	
				
		 }
		 else if (3==obt) {
    $('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:display;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:none;');	
			  
			    $('.requerimiento').attr('style','display:none;');	
				
				
		 }
  else if (4==obt) {
         $('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:none;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:none;');	
			  
			    $('.requerimiento').attr('style','display:none;');	
				
				
  } else if (5==obt) {
     $('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:none;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:none;');	
			  
			    $('.requerimiento').attr('style','display:none;');	
				
				
  } else if (6==obt) {	  
			    $('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:display;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:none;');	  
			  
			    $('.requerimiento').attr('style','display:none;');	
				
				
  } else if (7==obt) {
 
 		    $('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:display;');
			  $('#prorroga2').attr('style','display:display;');
			  $('#revalidacion').attr('style','display:none;');	
			  
			    $('.requerimiento').attr('style','display:none;');	
				
				
  } else if (8==obt) {  
			$('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:none;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:display;');	 

  $('.requerimiento').attr('style','display:none;');	

  
  }  else if (9==obt) { 
 	$('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:none;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:display;');	
			  
			    $('.requerimiento').attr('style','display:none;');	
				
 
  } else if (10==obt) { 
  
  	$('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:display;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:display;');	
    $('.requerimiento').attr('style','display:none;');	
  
  
  
   
  } else if (11==obt) { 
  
  	$('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:display;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:none;');	
    $('.requerimiento').attr('style','display:none;');	
  
  
  
  
   
  } else if (12==obt) { 
  
  	$('#licencia_inicial').attr('style','display:display;');
		  $('#prorroga1').attr('style','display:display;');
			  $('#prorroga2').attr('style','display:display;');
			  $('#revalidacion').attr('style','display:none;');	
    $('.requerimiento').attr('style','display:none;');	
  
  
  
  
  
  
  
  
  
 
		  } else {

		  	     $('#licencia_inicial').attr('style','display:none;');
			  $('#prorroga1').attr('style','display:none;');
			  $('#prorroga2').attr('style','display:none;');
			  $('#revalidacion').attr('style','display:none;');	  

			      $('.requerimiento').attr('style','display:display;');	
				  
                }
						
				
        });
		

		
		
		
			  $('#buscarlicenciainicial').click(function (){
				 
				   var lica =document.getElementById("depmun").value;
                    var licb =document.getElementById("curaduria_inicial").value;
					   var licc =document.getElementById("ano_licencia_inicial").value;
					      var licd =document.getElementById("nombre_licencia_curaduria_inicial").value;
						  
						  var tlic=lica+"-"+licb+"-"+licc+"-"+licd;
				
                        jQuery.ajax({
                                type: "POST",
								url: "pages/buscarlicenciainicial.php",
								data: 'option='+tlic,
								async: true,
                                success: function(b) {
                                        jQuery('#resultadolicenciainicial').html(b);
										
                                }
                        })
					
						 
						
						
						
                });
				
				
				

			
			  })
			  
			  
			</script>


	<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
             <h3>
			 <?php 		
$query="SELECT count(id_tipo_autorizacion_licencia) as cuenta FROM licencia_curaduria, tipo_autorizacion_licencia where id_clase_licencia=1 and  licencia_curaduria.id_licencia_curaduria=tipo_autorizacion_licencia.id_licencia_curaduria and licencia_curaduria.id_curaduria=".$id." and estado_tipo_autorizacion_licencia=1 and licencia_curaduria.estado_licencia_curaduria=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
echo $row1['cuenta'];
?> 
			 </h3>

              <p>Licencia de Urbanización</p>
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
             <h3>
			 <?php 		
$query="SELECT count(id_tipo_autorizacion_licencia) as cuenta FROM licencia_curaduria, tipo_autorizacion_licencia where id_clase_licencia=2 and  licencia_curaduria.id_licencia_curaduria=tipo_autorizacion_licencia.id_licencia_curaduria and licencia_curaduria.id_curaduria=".$id." and estado_tipo_autorizacion_licencia=1 and licencia_curaduria.estado_licencia_curaduria=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
echo $row1['cuenta'];
?> 
			 </h3>

              <p>Licencia de Parcelación</p>
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
             <h3>
			 <?php 		
$query="SELECT count(id_tipo_autorizacion_licencia) as cuenta FROM licencia_curaduria, tipo_autorizacion_licencia where id_clase_licencia=3 and  licencia_curaduria.id_licencia_curaduria=tipo_autorizacion_licencia.id_licencia_curaduria and licencia_curaduria.id_curaduria=".$id." and estado_tipo_autorizacion_licencia=1 and licencia_curaduria.estado_licencia_curaduria=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
echo $row1['cuenta'];
?> 
			 </h3>

              <p>Licencia de Subdivisión</p>
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
                  <h3>
			 <?php 		
$query="SELECT count(id_tipo_autorizacion_licencia) as cuenta FROM licencia_curaduria, tipo_autorizacion_licencia where id_clase_licencia=4 and  licencia_curaduria.id_licencia_curaduria=tipo_autorizacion_licencia.id_licencia_curaduria and licencia_curaduria.id_curaduria=".$id." and estado_tipo_autorizacion_licencia=1 and licencia_curaduria.estado_licencia_curaduria=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
echo $row1['cuenta'];
?> 
			 </h3>

              <p>Licencia de Construcción</p>
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
<div class="alert" style="background:#f1f1f1;" role="alert"><a href="" class="close" style="text-decoration:none;">&times;</a>
<b>De acuerdo con la <a href="images/RESOLUCION_8103-2018.pdf" target="_blank" style="color:#B40404;">Resolución 8103 del 12 de Julio del 2018</a>, el repositorio almacena actualmente las licencias urbanisticas en sus diferentes modalidades y actos de reconocimiento.<br>Proximamente el repositorio comprenderá las modificaciones a las licencias vigentes, prorrogas, revalidaciones, correcciones, entre otras.</b></div>
 </div>
</div>



<div class="modal fade" id="popupnewlicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Nuevo tramite de licencia</label></h4>
</div> 
<div class="modal-body"> 

<form action="" method="POST" name="formgjht1" id="validalicencia">


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN DEL PROYECTO:</label> 
<div class="input-group">
<span class="input-group-addon"><?php echo $id_departamento.$id_municipio.'-'.$ncuraduria.'-'; ?></span>
 <span class="input-group-addon">
<select name="ano_licencia" required>
<option value="" selected></option>
<!--
<option value="<?php // echo $anoactual; ?>" selected><?php //echo $anoactual; ?></option>
<option value="<?php // $anoactualmenos1=$anoactual-1; echo $anoactualmenos1; ?>"><?php // echo $anoactualmenos1; ?></option>
<option value="<?php // $anoactualmenos2=$anoactual-2; echo $anoactualmenos2; ?>"><?php // echo $anoactualmenos2; ?></option>
<option value="<?php // $anoactualmenos3=$anoactual-3; echo $anoactualmenos3; ?>"><?php // echo $anoactualmenos3; ?></option>
-->
<?php
$anolic=date('y');
for($i = 10; $i <= $anolic; ++$i) {
    echo '<option value="'.$i.'">'.$i.'</option>';
}
?>

</select>
</span>
 <span class="input-group-addon">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria" style="width:50px;" value="" maxlength="4" required>
</span>
</div>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE ACTO ADMINISTRATIVO:</label> 
<input type="text" class="form-control mayuscula" name="n_acto_administrativo"  required>
</div>

<!---datepickercuraduria--->
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE RADICACION LEGAL Y EN DEBIDA FORMA:</label> 
<input type="text" class="form-control datepickerlicencia" style="background:#fff;width:150px;" readonly="readonly" name="fecha_radicacion" required  >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE EXPEDICION:</label> 
<input type="test"  class="form-control datepickerlicencia" style="background:#fff;width:150px;" readonly="readonly" name="fecha_expedicion" required  >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA EJECUTORIA:</label> 
<input type="text"  class="form-control datepickerlicencia" style="background:#fff;width:150px;" readonly="readonly" name="fecha_ejecutoria" required  >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESTADO DEL TRAMITE:</label> 
<select  class="form-control" name="id_estado_lic_curaduria" required>
<option value="" selected></option>
<?php echo lista('estado_lic_curaduria'); ?>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OBJETO DEL TRAMITE:</label> 
<select  class="form-control" name="id_objeto_lic_curaduria" id="objeto_tramite" required>
<option value="" selected></option>
<?php echo lista('objeto_lic_curaduria'); ?>
</select>
</div>




<!------------------LICENCIA NUEVA---------------------------->

<div class="form-group text-left" style="display:none;background:#eee;" id="licencia_inicial"> 
<label class="control-label" style="background:#eee;"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN DEL PROYECTO - LICENCIA INICIAL:





</label> 
<div class="input-group" style="background:#eee;">
<span class="input-group-addon" style="background:#eee;"><?php echo $id_departamento.$id_municipio.'-'; ?></span>
 <span class="input-group-addon" style="background:#eee;">
 <input type="hidden" id="depmun" value="<?php echo $id_departamento.$id_municipio; ?>">
 <select name="curaduria_inicial" id="curaduria_inicial"  >
 <OPTION VALUE="" SELECTED></OPTION>
<?php
$queryh = sprintf("SELECT numero_curaduria, nombre_curaduria  FROM curaduria where id_municipio=".$id_municipio." and id_departamento=".$id_departamento." and estado_curaduria=1 order by numero_curaduria"); 
$selecth = mysql_query($queryh, $conexion);
$rowh = mysql_fetch_assoc($selecth);
$totalRowsh = mysql_num_rows($selecth);
if (0<$totalRowsh){
do {
	echo '<option value="'.$rowh['numero_curaduria'].'">'.$rowh['nombre_curaduria'].'</option>';
} while ($rowh = mysql_fetch_assoc($selecth)); 
} else {}	 
mysql_free_result($selecth);
 ?>
</select>-
 </span>
  <span class="input-group-addon" style="background:#eee;">
<select name="ano_licencia_inicial" id="ano_licencia_inicial" >
<?php
$anolic=date('y');
for($i = 10; $i <= $anolic; ++$i) {
    echo '<option>'.$i.'</option>';
}
?>
</select>
</span>
<span class="input-group-addon" style="background:#eee;">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria_inicial" id="nombre_licencia_curaduria_inicial" style="width:50px;" value="" maxlength="4" >
</span>
</div>



<div class="form-group "> 
<span class="input-group-addon">
<span style="color:#ff0000;">*</span> Acto administrativo:
</span>
<span class="input-group-addon">
<input type="text" class="form-control" name="n_acto_administrativo_inicial"  >
</span>
</div>

<div class="form-group"> 
<span class="input-group-addon">
Ejecutoria:
</span>
<span class="input-group-addon">
<input type="date"  name="fecha_ejecutoria_inicial"   >
</span>
<span class="input-group-addon">
Vencimiento:
</span>
<span class="input-group-addon">
<input type="date"   name="fecha_vencimiento_licencia_inicial" id="fecha_vencimiento_licencia_inicial"   >
</span>
</div>






</div>
<div class="form-group text-left"  style="display:none;background:#eee;" id="prorroga1"> 
<label  class="control-label" style="background:#eee;">NÚMERO DE RADICACIÓN DEL PROYECTO - PRORROGA 1:</label> 
<div class="input-group"  style="background:#eee;">
<span class="input-group-addon" style="background:#eee;"><?php echo $id_departamento.$id_municipio.'-'; ?></span>
 <span class="input-group-addon" style="background:#eee;">
 <select name="curaduria_prorroga1" >
 <OPTION VALUE="" SELECTED></OPTION>
<?php
$queryh = sprintf("SELECT numero_curaduria, nombre_curaduria FROM curaduria where id_municipio=".$id_municipio." and id_departamento=".$id_departamento." and estado_curaduria=1 order by numero_curaduria"); 
$selecth = mysql_query($queryh, $conexion);
$rowh = mysql_fetch_assoc($selecth);
$totalRowsh = mysql_num_rows($selecth);
if (0<$totalRowsh){
do {
	echo '<option value="'.$rowh['numero_curaduria'].'">'.$rowh['nombre_curaduria'].'</option>';
} while ($rowh = mysql_fetch_assoc($selecth)); 
} else {}	 
mysql_free_result($selecth);
 ?>
</select>-
 </span>
  <span class="input-group-addon" style="background:#eee;">
<select name="ano_licencia_prorroga1" >
<?php
$anolic=date('y');
for($i = 10; $i <= $anolic; ++$i) {
    echo '<option>'.$i.'</option>';
}
?>
</select>
</span>
<span class="input-group-addon" style="background:#eee;">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria_prorroga1" style="width:50px;" value="" maxlength="4" >
</span>
</div>

<div class="form-group " style="background:#eee;"> 
<span class="input-group-addon">
<span style="color:#ff0000;">*</span> Número del acto administrativo:
</span>
<span class="input-group-addon">
<input type="text"  class="form-control numero" name="n_acto_administrativo_prorroga1"   >
</span>
</div>
</div>


<div class="form-group text-left"  style="display:none;background:#eee;" id="prorroga2"> 
<label  class="control-label" style="background:#eee;"> NÚMERO DE RADICACIÓN DEL PROYECTO - PRORROGA 2:</label> 
<div class="input-group"  style="background:#eee;">
<span class="input-group-addon" style="background:#eee;"><?php echo $id_departamento.$id_municipio.'-'; ?></span>
 <span class="input-group-addon" style="background:#eee;">
 <select name="curaduria_prorroga2" >
 <OPTION VALUE="" SELECTED></OPTION>
<?php
$queryh = sprintf("SELECT numero_curaduria, nombre_curaduria FROM curaduria where id_municipio=".$id_municipio." and id_departamento=".$id_departamento." and estado_curaduria=1 order by numero_curaduria"); 
$selecth = mysql_query($queryh, $conexion);
$rowh = mysql_fetch_assoc($selecth);
$totalRowsh = mysql_num_rows($selecth);
if (0<$totalRowsh){
do {
	echo '<option value="'.$rowh['numero_curaduria'].'">'.$rowh['nombre_curaduria'].'</option>';
} while ($rowh = mysql_fetch_assoc($selecth)); 
} else {}	 
mysql_free_result($selecth);
 ?>
</select>-
 </span>
  <span class="input-group-addon" style="background:#eee;">
<select name="ano_licencia_prorroga2" >
<?php
$anolic=date('y');
for($i = 10; $i <= $anolic; ++$i) {
    echo '<option>'.$i.'</option>';
}
?>
</select>
</span>
<span class="input-group-addon" style="background:#eee;">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria_prorroga2" style="width:50px;" value="" maxlength="4" >
</span>
</div>

<div class="form-group " style="background:#eee;"> 
<span class="input-group-addon">
<span style="color:#ff0000;">*</span> Número del acto administrativo:
</span>
<span class="input-group-addon">
<input type="text"  class="form-control numero" name="n_acto_administrativo_prorroga2"   >
</span>
</div>
</div>


<div class="form-group text-left"  style="display:none;background:#eee;" id="revalidacion"> 
<label  class="control-label" style="background:#eee;"> NÚMERO DE RADICACIÓN DEL PROYECTO - REVALIDACIÓN:</label> 
<div class="input-group"  style="background:#eee;">
<span class="input-group-addon" style="background:#eee;"><?php echo $id_departamento.$id_municipio.'-'; ?></span>
 <span class="input-group-addon" style="background:#eee;">
 <select name="curaduria_revalidacion" >
 <OPTION VALUE="" SELECTED></OPTION>
<?php
$queryh = sprintf("SELECT numero_curaduria, nombre_curaduria FROM curaduria where id_municipio=".$id_municipio." and id_departamento=".$id_departamento." and estado_curaduria=1 order by numero_curaduria"); 
$selecth = mysql_query($queryh, $conexion);
$rowh = mysql_fetch_assoc($selecth);
$totalRowsh = mysql_num_rows($selecth);
if (0<$totalRowsh){
do {
	echo '<option value="'.$rowh['numero_curaduria'].'">'.$rowh['nombre_curaduria'].'</option>';
} while ($rowh = mysql_fetch_assoc($selecth)); 
} else {}	 
mysql_free_result($selecth);
 ?>
</select>-
 </span>
  <span class="input-group-addon" style="background:#eee;">
<select name="ano_licencia_revalidacion" >
<?php
$anolic=date('y');
for($i = 10; $i <= $anolic; ++$i) {
    echo '<option>'.$i.'</option>';
}
?>
</select>
</span>
<span class="input-group-addon" style="background:#eee;">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria_revalidacion" style="width:50px;" value="" maxlength="4" >
</span>
</div>

<div class="form-group " style="background:#eee;"> 
<span class="input-group-addon">
<span style="color:#ff0000;">*</span> Número del acto administrativo:
</span>
<span class="input-group-addon">
<input type="text"  class="form-control numero" name="n_acto_administrativo_revalidacion"  >
</span>
</div>




<div class="form-group"> 
<span class="input-group-addon">
Fecha de vencimiento:
</span>
<span class="input-group-addon">
<input type="text"  class="form-control datepickerlicencia" style="background:#fff;" readonly="readonly" name="fecha_vencimiento_revalidacion"   >
</span>
</div>


</div>




<!----------------------------NORMAL------------------------------------------->





<div class="form-group text-left requerimiento"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> REQUIERE CERTIFICACIÓN TECNICA DE OCUPACIÓN:</label> 
<select name="certificado_ocupacion" class="form-control"  style="width:150px;"  >
<option></option>
<option>SI</option>
<option>NO</option>
</select>
</div>
 
 <div class="form-group text-left requerimiento" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> REQUIERE AUTORIZACIÓN DE OCUPACIÓN DE INMUEBLE:</label> 
<select name="autorizacion_ocupacion" class="form-control" style="width:150px;" >
<option></option>
<option>SI</option>
<option>NO</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE TITULARES:</label>   
<input type="text"  class="form-control numero" name="n_titulares"  required >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE PREDIOS:</label>  
<input type="text"  class="form-control numero" name="n_predios"  required > 
</div>



<div class="form-group text-left"> 
<label  class="control-label"> OBSERVACION:</label> 
<!--<span style="color:#ff0000;">(En caso de que el número de radicado sea de hace dos años, informar el motivo.)</span>-->
<textarea class="form-control mayuscula" name="observacion_licencia" ></textarea>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success" id="vv">
<input type="hidden" name="table" value="licencia_curaduria">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>

</form>


</div>
</div> 
</div> 
</div> 



	
	
	<div class="row">
<div class="col-md-12">



 <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
				
			
				
			<a href="" class="btn btn-success" data-toggle="modal" data-target="#popupnewlicencia"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo </a>

  
		
				
				<strong>  &nbsp; Licencias /
	   <?php echo $name; 
	   echo ' - ';
	   echo quees('departamento', $id_departamento); 
	    echo ' - ';
	   echo nombre_municipio($id_municipio, $id_departamento); 
	   ?>

				
				</strong></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
  
            <div class="box-body">
              <div class="table-responsive">
                <table id="datatabla" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Radicación</th>
                        <th>Acto admin.</th>
                        <th>Fecha de Expedición</th>
						 <th>Fecha de Vencimiento</th>
                        <th style="min-width:120px;"></th>         
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
		  
		  


        </div>
		
		

	
	
	
</div>
<?php } else {} ?>


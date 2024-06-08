<?php
$nump12 = privilegios(12, $_SESSION['snr']);



if ((1==$_SESSION['rol'] or 0<$nump12)) {
$id=intval($_GET['i']);
$curad=$_GET['e'];
$percur=1;
$listaper=1;
}
else {	
$id=intval($_GET['i']);
$curad=$_SESSION['id_vigiladocurador'];
$percur=permisopruebacuraduria($_SESSION['id_vigiladocurador']);
$listaper=listapercuraduria($id,$curad);
}







if (0<$id && 0<$percur && (0<$listaper or 1==$_SESSION['rol'])) {


if (isset($_POST["estado_rev"]) && ""!=$_POST["estado_rev"]) {

 $updated = sprintf("UPDATE documento_funcionario set estado_rev=%s, rechazo=%s, computa=%s   
 where id_documento_funcionario=%s and id_funcionario=%s",

        GetSQLValueString($_POST["estado_rev"], "int"),
		GetSQLValueString($_POST["rechazo"], "text"),
		GetSQLValueString($_POST["computa"], "text"),
		GetSQLValueString($_POST["id_documento_funcionario"], "int"),
		GetSQLValueString($id, "int")
      );
      $Resultpd = mysql_query($updated, $conexion);
     // echo $actualizado;
	
	if (isset($_POST["estado_rev"]) && ""!=$_POST["estado_rev"]) {
	
if (1==$_POST["estado_rev"]) {
	$mensa='aceptado';
	$recha='';
} else {
	$mensa='rechazado';
	$recha=$_POST["rechazo"];
}
	
	
$emailu=$_POST["correocur"].','.$_POST["correousuario"];
$subject = 'Revisión de documentos de la SNR';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "La Superintendencia de Notariado y Registro informa que se ha ".$mensa." un documento enviado a la SNR.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/documentos&'.$id.'.jsp">Ver registro.</a>';
$cuerpo .= "<br><br>".$recha;
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);
	
	
	
	
	} else {}
	
	
	
	
	
}





if (isset($_POST["direccion_funcionario"]) && ""!=$_POST["direccion_funcionario"]) {
	

if (isset($_POST["fecha_salida"]) && ""!=$_POST["fecha_salida"]) {
	
	 $updated778 = sprintf("UPDATE relacion_curaduria set estado_activo=0 where id_funcionario=%s",
		GetSQLValueString($id, "int")
		);
      $Resultpd77 = mysql_query($updated778, $conexion);
	  
	
}


	
 $updated77 = sprintf("UPDATE funcionario set direccion_funcionario=%s, fecha_nacimiento=%s, correo_personal=%s,  
 celular_funcionario=%s, fecha_salida=%s, tarjeta_profesional=%s, fecha_tarjeta_profesional=%s, profesion=%s, experiencia_purbana=%s, 
 tiempo_experiencia_purbana=%s, perfil_curaduria=%s  
 where id_funcionario=%s",

        GetSQLValueString($_POST["direccion_funcionario"], "text"),
		GetSQLValueString($_POST["fecha_nacimiento"], "date"),
		GetSQLValueString($_POST["correo_personal"], "text"),
		GetSQLValueString($_POST["celular_funcionario"], "int"),
		GetSQLValueString($_POST["fecha_salida"], "date"),
		GetSQLValueString($_POST["tarjeta_profesional"], "text"),
		GetSQLValueString($_POST["fecha_tarjeta_profesional"], "date"),
		GetSQLValueString($_POST["profesion"], "text"),
		GetSQLValueString($_POST["experiencia_purbana"], "text"), 
		GetSQLValueString($_POST["tiempo_experiencia_purbana"], "text"), 
		
		GetSQLValueString($_POST["perfil_curaduria"], "int"),
		GetSQLValueString($id, "int")
		);
      $Resultpd77 = mysql_query($updated77, $conexion);
   echo $actualizado;
   

}





if ((isset($_POST["tipo_soporte"])) && ($_POST["tipo_soporte"] != "")) {

/*tipo_soporte
<option value="13-23">Certificados de formación</option>
<option value="13-10">Certificados Laborales</option>
<option value="13-25">Certificados Laboral actual</option>
*/




if ("13-10"==$_POST["tipo_soporte"] or "13-25"==$_POST["tipo_soporte"]) {
if ($_POST["desde"]>$_POST["ftarjeta"]) {
	$infov=1;
} else {
	$infov=0;
}
} else {
$infov=1;
}




if (0<$infov) {  


$query = sprintf("SELECT count(id_documento_funcionario) as ncedula FROM documento_funcionario 
where id_tipo_adjunto=3 and id_tipo_subadjunto=2 and id_funcionario=".$id.""); 
$select1 = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select1);



if (0<$row1['ncedula'] or "3-2"==$_POST["tipo_soporte"]) {



$queryr = sprintf("SELECT count(id_documento_funcionario) as ntarjeta FROM documento_funcionario 
where id_tipo_adjunto=3 and id_tipo_subadjunto=11 and id_funcionario=".$id.""); 
$select2 = mysql_query($queryr, $conexion);
$row12 = mysql_fetch_assoc($select2);


if (0<$row12['ntarjeta'] or "3-2"==$_POST["tipo_soporte"] or "3-11"==$_POST["tipo_soporte"]) {
	
	
//echo '<h1>'.$row1['ncedula'].' / '.$_POST["tipo_soporte"].'</h1>';


$tamano_archivo=4194304; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15

$formato_archivo = array('pdf');

$directoryftp="filesnr/documentos/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'snr-'.$_SESSION["snr"].'-'.$identi;

$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);


if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
   $seguridad = md5($files . $_POST["funci"]);
   
   $tipos=explode('-', $_POST["tipo_soporte"]);
  $adjunto=$tipos[0];
  $subadjunto=$tipos[1];
  
 
    $insertSQL = sprintf(
            "INSERT INTO documento_funcionario (nombre_documento_funcionario, id_tipo_adjunto, 
id_tipo_subadjunto, id_funcionario, labora_actualmente, id_nivel_academico, tipo_certificacion, url_documento, hash_documento, fecha_inicial, 
fecha_documento, estado_documento_funcionario) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
            GetSQLValueString('Curadurias', "text"),
            GetSQLValueString($adjunto, "int"),
            GetSQLValueString($subadjunto, "int"),
            GetSQLValueString($id, "int"),
			GetSQLValueString($_POST["labora_actualmente"], "text"),
			 GetSQLValueString($_POST["id_nivel_academico"], "int"),
			 GetSQLValueString($_POST["tipo_certificacion"], "text"),
            GetSQLValueString($files, "text"),
            GetSQLValueString($seguridad, "text"),
            GetSQLValueString($_POST["desde"], "date"),
            GetSQLValueString($_POST["hasta"], "date"),
            GetSQLValueString(1, "int")
          );
          $Result = mysql_query($insertSQL, $conexion);
          echo $insertado;
		  
		
		
$emailu='hv.personalcurb@supernotariado.gov.co';
$subject = 'Nueva carga de documentos de la SNR';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "La Superintendencia de Notariado y Registro informa que se ha cargado un documento.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/documentos&'.$id.'.jsp">Ver registro.</a>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);
	
	
	
	
   
  } else {
$files='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
  }
} else { 
$files='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 4 MB(Megabytes) permitidos.</div>';
		}
		

} else { 
$files='';	
	}	
  
  
  
  
  
    } else {
echo '<script type="text/javascript">swal(" ERROR !", " Debe registrar la tarjeta profesional primero. !", "error");</script>';
}
mysql_free_result($select2);
  
  
  
  
  
  } else {
echo '<script type="text/javascript">swal(" ERROR !", " Debe registrar la cédula primero. !", "error");</script>';
}
mysql_free_result($select1);
  
  
  
  
} else {
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, La fecha de certificación laboral debe ser mayor a la fecha de la tarjeta profesional. .</div>';

	}
	
	
} else { }






?>	 <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo '13'; ?></h3>

              <p>Documentos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>8</h3>

              <p>Revisados</p>
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
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Avance</p>
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
          <div class="small-box bg-red">
            <div class="inner">
              <h3>5</h3>

              <p>Sin revisar</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- <span class="label label-danger">No se ha tramitado</span> <i class="fa fa-file-pdf-o"></i> Leer</a>-->
      </div>
	
	
	<div class="row">
<div class="col-md-12">
	<div class="box box-info">
            <div class="box-header with-border">
			
	<div class="row">	

<?php

$query = sprintf("SELECT * FROM funcionario where id_funcionario=".$id." limit 1"); 

$select = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select);
$tota = mysql_num_rows($select);
if (0<$tota) {


$perfil_curaduria=$row1['perfil_curaduria'];


$id_cargo=$row1['id_cargo'];
if (1==$id_cargo) {
$query44="SELECT correo_curaduria, nombre_curaduria, reglamentacion_local, url_reglamentacion_local FROM curaduria, situacion_curaduria, funcionario where funcionario.id_funcionario=".$id." and situacion_curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria=situacion_curaduria.id_curaduria AND (situacion_curaduria.fecha_terminacion IS NULL OR situacion_curaduria.fecha_terminacion>='$realdate') limit 1";
} else {
$query44="SELECT correo_curaduria, nombre_curaduria, reglamentacion_local, url_reglamentacion_local FROM curaduria, relacion_curaduria, funcionario  
 where curaduria.id_curaduria=relacion_curaduria.id_curaduria and relacion_curaduria.id_funcionario=funcionario.id_funcionario and relacion_curaduria.id_funcionario=".$id." and estado_relacion_curaduria=1";
	}
$result44 = $mysqli->query($query44);
$row44 = $result44->fetch_array();
$nombre_curaduria=$row44['nombre_curaduria'];
$correo_curaduria=$row44['correo_curaduria'];
$reglamentacion_local=$row44['reglamentacion_local'];
$url_reglamentacion_local=$row44['url_reglamentacion_local'];
$result44->free();


?>

<form class="navbar-form" name="for232334332455345m14543653653456436" method="post" action="">
<div class="col-md-4">
CURADURIA: 
<input type="text" class="form-control" style="width:100%;" readonly value="<?php echo $nombre_curaduria.' / '.$correo_curaduria; ?>">
<BR>



NOMBRE: <input type="text" class="form-control" style="width:100%;" readonly value="<?php echo $row1['nombre_funcionario']; ?>">
<br>
DIRECCIÓN PERSONAL: <input type="text" class="form-control" style="width:100%;" name="direccion_funcionario" value="<?php echo $row1['direccion_funcionario'];  ?>" required>
<br>
FECHA DE NACIMIENTO: <span style="color:#B40404">*</span> 
<?php
if (isset($row1['fecha_nacimiento'])) {
echo calculaedad($row1['fecha_nacimiento']);
echo ' años';
} else {}
?>
 <input type="date" class="form-control"  style="width:100%;" name="fecha_nacimiento" value="<?php echo $row1['fecha_nacimiento'];  ?>" required>



<br><br>
<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-ok"></span> Actualizar</button>

<?php if (isset($row1['fecha_salida']) && ""!=$row1['fecha_salida']) { echo ' <b>Inactivo</b>'; } else{} ?>
 &nbsp;  &nbsp;  &nbsp;  &nbsp; 
<a href="usuario&<?php echo $id; ?>.jsp">Ver perfil</a>
 &nbsp;  &nbsp;  &nbsp;  &nbsp; 
<a href="pdf/hv_persona_curaduria&<?php echo $id; ?>.pdf">Ver hoja de vida</a>







</div>
<div class="col-md-4">
CORREO PERSONAL: <input type="text" class="form-control" style="width:100%;" 
name="correo_personal" value="<?php $correouser=$row1['correo_personal']; echo $correouser;   ?>" required>
<br>
TELEFONO PERSONAL: <input type="text" class="form-control" style="width:100%;" name="celular_funcionario" value="<?php echo $row1['celular_funcionario'];  ?>" required>
<br>
EXPERIENCIA LABORAL EN EL EJERCICIO DE ACTIVIDADES DE DESARROLLO O PLANEACIÓN URBANA: 
<select class="form-control" style="width:100%;" name="experiencia_purbana" required>
<option><?php echo $row1['experiencia_purbana'];  ?></option>
<option>Si</option>
<option>No</option>
</select>
<?php
if (1==$id_cargo) { } else { ?>
<br>
PERFIL:
<select name="perfil_curaduria" style="width:100%;" REQUIRED  class="form-control">
<option></option>
<option value="1" <?php if (1==$row1['perfil_curaduria']) { echo 'selected'; }  else {}  ?>>Para equipo interdisciplinario</option>
<option value="2" <?php if (2==$row1['perfil_curaduria']) { echo 'selected'; }  else {}  ?>>Para ser curador urbano</option>
</select>
<?php  } ?>

</div>
<div class="col-md-4">
TARJETA PROFESIONAL: <input type="text" class="form-control" style="width:100%;" name="tarjeta_profesional" value="<?php echo $row1['tarjeta_profesional'];  ?>" required>
<br>
FECHA DE LA TARJETA PROFESIONAL:  <span style="color:#B40404">*</span> 
<?php


if (isset($row1['fecha_tarjeta_profesional'])) {
	$fechatarjetap=$row1['fecha_tarjeta_profesional'];
echo calculaedad($row1['fecha_tarjeta_profesional']);
echo ' años';
} else {
	
	$fechatarjetap='';
}
?>
 <input type="date" class="form-control "  style="width:100%;" name="fecha_tarjeta_profesional" value="<?php echo $row1['fecha_tarjeta_profesional'];  ?>" required>
<br>
AÑOS DE EXPERIENCIA EN EL EJERCICIO DE DESARROLLO O ACTIVIDADES DE PLANEACIÓN URBANA: 
<input type="text" class="form-control numero" style="width:100%;" name="tiempo_experiencia_purbana" value="<?php echo $row1['tiempo_experiencia_purbana'];  ?>" required>

<?php
if (1==$id_cargo) { } else { ?>
PROFESION:
<select name="profesion" style="width:100%;" REQUIRED  class="form-control">

<option value="<?php $profesion=$row1['profesion']; echo $profesion; ?>" selected><?php echo  $profesion; ?></option>
<option>Ingeniero civil</option>
			 <option>Arquitecto</option>
			  <option>Abogado</option>
			   <option>Ingeniero de sistemas</option>
			    <option>Ingeniero catastral</option>
			  <option>Otra</option>
			  </select>





<br>
FECHA DE RETIRO: 

 <input type="date" class="form-control"  style="width:100%;" name="fecha_salida" value="<?php echo $row1['fecha_salida'];  ?>" >
<br>



<?php  } ?>







</div>
</form>	
<?php  } ?>
	</div>
<hr>	
			
			
			
			
			
			
			       <a href="" class="btn btn-success" data-toggle="modal" data-target="#popupdoc">
				   <span class="glyphicon glyphicon-plus-sign"></span> Nuevo </a>


              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
				
				
		
              
              </div>
            </div>
            <!-- /.box-header -->
			
		
				
			
            <div class="box-body"  >
              <div class="table-responsive">
              
			  		
<table  class="table display table-bordered" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
<tr align="center" valign="middle">

 <th>Tipo</th>
 <th>Subtipo</th>
 <th>Lab. Actual</th>
 <th>Nivel académico</th>
<th>Documento</th>
<th>Archivo</th>
<th>Tipo</th>
<th>Fecha</th> 		
<th>Tipo experiencia</th> 	 
<th>Estado</th>  
<th></th> 
</tr>
</thead>
<tbody>
<?php 

$array=array();
$arrayp=array();
$profesional=array();
$relacionada=array();

$arraymes=array();
$arraypmes=array();
$profesionalmes=array();
$relacionadames=array();


$query4="select * from documento_funcionario, tipo_adjunto, tipo_subadjunto where tipo_adjunto.id_tipo_adjunto=tipo_subadjunto.id_tipo_adjunto and documento_funcionario.id_tipo_subadjunto=tipo_subadjunto.id_tipo_subadjunto and documento_funcionario.id_tipo_adjunto=tipo_subadjunto.id_tipo_adjunto and id_funcionario=".$id." and estado_documento_funcionario=1 ";
$result = $mysqli->query($query4);

$espe='';

while($row = $result->fetch_array()) {
	
$iddoc=$row['id_documento_funcionario'];
$i=$row['id_documento_funcionario'];
echo '<tr>';
echo '<td>' .$row['nombre_tipo_adjunto']. '</td>';
echo '<td>' .$row['nombre_tipo_subadjunto']. ' </td>';
echo '<td>' .$row['labora_actualmente']. ' </td>';
echo '<td>';
if (isset($row['id_nivel_academico'])) {
	$nivelaca=quees('nivel_academico',$row['id_nivel_academico']);
	echo $nivelaca;
	
	if (9==$row['id_nivel_academico']) {
		$espe.=1;
	} else {
		$espe.=0;
	}
	
} else {
}
echo '</td>';

echo '<td>' . $row['nombre_documento_funcionario'] . '</td>';

echo '<td><a href="filesnr/documentos/' . $row['url_documento'] . '" target="_blank"><i class="fa fa-file-pdf-o"></i> Leer </a></td>';            

	
echo '<td>';

$tcert=$row['tipo_certificacion'];
echo $tcert;
echo '</td>';
	
			  
 echo '<td><span style="color:#999;">';

if ('Tarjeta profesional'==$row['nombre_tipo_subadjunto']) {
	echo $fechatarjetap;
	
	
} else	if ('Certificacion de formacion'==$row['nombre_tipo_subadjunto']) {
	

	
	
} else {

echo ''.$row['fecha_inicial'] . ' ' . $row['fecha_documento'] . '</span> <br>';

              if (isset($row['fecha_inicial']) && isset($row['fecha_documento'])) {
                echo ' (';
              // $ani= calculatiempo($row['fecha_inicial'], $row['fecha_documento']);
                //echo $ani.' Años.)';
				
				
	$na = new DateTime($row['fecha_inicial']);
    $ah = new DateTime($row['fecha_documento']);
    $diferenciar = $ah->diff($na);
    $ani= $diferenciar->format("%y");
	echo $ani;
	//array_push($relacionada, $ani);
	
	echo ' años, ';
		$mesi= $diferenciar->format("%m");
		echo $mesi." meses) ";  
		
		
echo ' meses)';		
				
		
			   
              } else if (isset($row['fecha_documento'])) {
                echo ' (';
              //  $ani= calculaedad($row['fecha_documento']);
               // echo $ani.' Años.) ';
				
				
$fechaInicio2 = new DateTime($row['fecha_documento']);
$fechaFin2 = new DateTime($realdate);
$intervalo = $fechaInicio2->diff($fechaFin2);
$ani=$intervalo->y;
echo $ani." años, ";
$mesi=$intervalo->m;
echo $mesi." meses) ";  
 


				
				
				
				
				
              } else {
              }
			  
}
			  
			  
	echo '</td>';		  
			

echo '<td>';

if (13==$row['id_tipo_adjunto'] && (10==$row['id_tipo_subadjunto'] or 25==$row['id_tipo_subadjunto'])) {
	
If (isset($row['computa']) && 1==intval($row['estado_rev'])) {
If ('Si'==$row['computa']) {
	echo 'Experiencia relacionada';
	array_push($relacionada, $ani);
	array_push($relacionadames, $mesi);
} else {
echo 'Experiencia profesional';
	array_push($profesional, $ani);
	array_push($profesionalmes, $mesi);
}
} else {}

} else {}
echo '</td>';


echo '<td>';
if (1==intval($row['estado_rev'])) {
	echo '<span class="fa fa-check" title="'.$row['fecha_rev'].'">Aprobado</span>';
	
	If ('Público'==$tcert) {
	array_push($array, $ani);
	array_push($arraymes, $mesi);
	} else {
	array_push($arrayp, $ani);
	array_push($arraypmes, $mesi);
	}
} elseif (2==intval($row['estado_rev'])) {
   echo '<span class="fa fa-times" title="'.$row['fecha_rev'].'"> Rechazado</span> ';
   
   echo $row['rechazo'];
   
} else {
	
	//<option value="13-10">Certificados Laborales</option>
	if (13==$row['id_tipo_adjunto'] && (10==$row['id_tipo_subadjunto'] or 25==$row['id_tipo_subadjunto'])) {
		$tipodocu=0;
	} else {
		$tipodocu=1;
	}
	
	if (1==$_SESSION['rol'] or 0<$nump12) {
echo '<a href="" title="Revisar '.$iddoc.'" id="'.$iddoc.'" name="'.$tipodocu.'" class="ver_revision_documento" data-toggle="modal" data-target="#popuprevisiondocumento"><button class="btn btn-xs btn-info">
<span class="fa fa-file"></span> Revisar</button></a> ';
	} else {}


}
echo '</td>';

			
echo '<td>';
if (1==$_SESSION['rol'] or 0<$nump12) {
	 echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_funcionario" id="'.$i.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else {}

echo '</td>';
echo '</tr>';


 } 
 
 $result->free();
 ?>

				
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
			  
			  
			  	<div class="row">
<div class="col-md-6">
			  
		<?php 
			$pub=array_sum($array);
			$priv=array_sum($arrayp);
			$pro=array_sum($profesional);
			$rel=array_sum($relacionada);
			
			$pubmes=array_sum($arraymes);
			$privmes=array_sum($arraypmes);
			$promes=array_sum($profesionalmes);
			$relmes=array_sum($relacionadames);
			
			
			
			$total=$pub+$priv;
			$totalinter=$pro+$rel;
			
			echo '<table border="1">';
			echo '<tr><td><b>Sumatoria en público</b></td><td> '.$pub.' años, '.$pubmes.' meses</td></tr>';

			echo '<tr><td><b>Sumatoria en privado</b></td><td> '.$priv.' años, '.$privmes.' meses</td></tr>'; 
			
			echo '<tr><td><b>Total de experiencia profesional </b></td><td> '.$pro.' años, '.$promes.' meses </td></tr>'; 
			
			echo '<tr><td><b>Total de experiencia relacionada &nbsp;  &nbsp; </b> </td><td> '.$rel.' años, '.$relmes.' meses </td></tr>'; 
				
			
			echo '</table>';
			
			
			if (5<=$totalinter && 1==$perfil_curaduria) {	
			echo 'Si cumple 5 años para interdiciplinario';
			
$updated = sprintf("UPDATE relacion_curaduria set requisitos_curaduria='Si', nombre_relacion_curaduria='Cambio automatico por sistema para interdiciplinario, + 5 años' where id_funcionario=%s",
		GetSQLValueString($id, "int"));
      $Resultpd = mysql_query($updated, $conexion);
 

			
			} else {}
			
			
			if (10<=$rel && 2==$perfil_curaduria) {	
			echo 'Si cumple 10 años para curador';
			
$updated = sprintf("UPDATE relacion_curaduria set requisitos_curaduria='Si', nombre_relacion_curaduria='Cambio automatico por sistema para curadores, +10 años' where id_funcionario=%s",
		GetSQLValueString($id, "int"));
      $Resultpd = mysql_query($updated, $conexion);
 
 
			} else {}
			?>
			</div>
			<div class="col-md-6">
			<?php
			
			if ('Si'==$reglamentacion_local) {
			ECHO 'Existe alguna reglamentación local en cuanto al número de integrantes del equipo interdisciplinario: '.$reglamentacion_local.' / ';
            
			echo ' <a href="filesnr/curadurias/'.$url_reglamentacion_local.'" target="_blank"> Ver Documento</a>';
			} else {}
			?>
			
			</div>
			
			</div>
			
              <!-- /.table-responsive -->
            </div>
        
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
		
		
		
	
	
	
</div>


<div class="modal fade" id="popupdoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Nuevo documento</h4>
</div> 
<div  class="modal-body"> 
<form action="" method="POST" name="form5435asdf3245fh324gdh345122" enctype="multipart/form-data">
<input type="hidden" name="funci" value="<?php echo $idfuncionarioreal; ?>">



<div class="form-group text-left"> 
<select class="form-control" name="tipo_soporte" id="tipo_soporte_personal" required>
<option></option>
<option value="3-2">Cédula</option>
<option value="3-11">Tarjeta profesional</option>
<!--<option value="3-24">Hoja de vida SIGEP II</option>-->
<option value="13-23">Certificados de formación</option>
<option value="13-10">Certificados Laborales</option>
<!--<option value="13-25">Certificados Laboral actual</option>-->


 </select>
</div>


<input type="hidden" name="ftarjeta" value="<?php echo $row1['fecha_tarjeta_profesional']; ?>">


<div class="form-group text-left niv_academico" style="display:none;"> 
Nivel académico
<select class="form-control" name="id_nivel_academico" >
<option></option>
	<?php				
					$queryop = sprintf("SELECT * FROM nivel_academico where id_nivel_academico in (8, 9, 10, 11) order by id_nivel_academico");
					$selectop = mysql_query($queryop, $conexion);
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_nivel_academico']; ?>"><?php echo $rowop['nombre_nivel_academico']; ?></option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>	

 </select>
</div>



<div class="form-group text-left" id="fechasexperiencia"> 

<div id="certificacionlaboral" style="display:none;">

<div class="form-group text-left"> 
Tipo de certificación
<select class="form-control" name="tipo_certificacion" >
<option></option>
<option value="Público">Público</option>
<option value="Privado">Privado</option>
 </select>
</div>

<div class="form-group text-left"> 
Labora actualmente
<select class="form-control" name="labora_actualmente"id="labora_actualmente">
<option></option>
<option value="Si">Si</option>
<option value="No">No</option>
 </select>
</div>



<br><i>La fecha de ingreso debe ser mayor a la fecha de expedición de la tarjeta profesional.</i>
</div>
<input id="personal_desde"   style="display:none;" type="text" name="desde" class="form-control datepickera" style="width:200px;" readonly placeholder="Desde">
 <input id="personal_hasta"   style="display:none;" type="text" name="hasta" class="form-control  datepickera"  style="width:200px;" readonly placeholder="Hasta">
</div>




<div class="form-group text-left"> 
<input type="file" name="file" class="form-control"  required>
</div>



<div class="for-m-group text-right"> 
<br>
<button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adjuntar </button>
</div>
</form>
</div> 
</div> 
</div> 
</div> 





<div class="modal fade " id="popuprevisiondocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog ">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Revisar</b><span style="font-weight: bold;"></span></h4>
</div> 
<div  class="modal-body">

<form action="" method="POST" name="form5435asdf3244455fh324gdh345122" >

Revisión:
<select class="form-control" name="estado_rev" required>
<option></option>
<option value="1">Aceptado</option>
<option  value="2">Rechazado</option>
</select>

<?php if (1==1) { ?>
<div id="idcomputa" style="display:display">
<br>
Computa:
<select class="form-control" name="computa" id="computa" required>
<option></option>
<option>Si</option>
<option>No</option>
</select>
</div>
<?php  } else {} ?>


<br>

<textarea class="form-control" name="rechazo" placeholder="Motivo de rechazo"></textarea>

<input id="iddocumento" name="id_documento_funcionario" type="hidden" value="">

<input name="correousuario" type="hidden" value="<?php echo $correouser; ?>">

<input name="correocur" type="hidden" value="<?php echo $correo_curaduria; ?>">

<div class="for-m-group text-right"> 
<br>
<button type="submit" class="btn btn-sm btn-success">
<span class="glyphicon glyphicon-plus-sign"></span> Enviar </button>
</div>

</form>
   </div>
    </div>
  </div>
</div>


<?php
} else {  echo 'Error de acceso.'; }

?>

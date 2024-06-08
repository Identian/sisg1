<?php
if (isset($_GET['i'])) {
	
	
$id=intval($_GET['i']);
$nump169 = privilegios(169, $_SESSION['snr']);

$realdatecompleto = date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-05-25 08:00:00");
$fecha_limite = strtotime("2023-12-31 17:00:00");

date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$fechaAno = date("Y");
if (1==$_SESSION['rol'] or 0<$nump169) {
	
	
	
	
if (isset($_POST['finalizada']) && 1==$_POST['finalizada']) {	
$updateSQL7786 = sprintf("UPDATE visita SET finalizada=%s, fecha_finalizada=now() where id_visita=%s",
GetSQLValueString(1, "int"), 
GetSQLValueString($id, "int"));
 $Result86 = mysql_query($updateSQL7786, $conexion);
 echo $actualizado;
}
	
	
	
if (isset($_POST['mes'])) {	
$updateSQL778 = sprintf("UPDATE visita SET mes=%s, tipo_visita=%s, fecha_inicial=%s, fecha_final=%s, 
id_tipo_oficina=%s, codigo_oficina=%s where id_visita=%s",
GetSQLValueString($_POST['mes'], "int"), 
GetSQLValueString($_POST['tipo_visita'], "text"), 
GetSQLValueString($_POST['fecha_inicial'], "date"), 
GetSQLValueString($_POST['fecha_final'], "date"),
GetSQLValueString($_POST['id_tipo_oficina'], "int"), 
GetSQLValueString($_POST['codigo_oficina'], "int"),  
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;
}
	
	
	if (isset($_POST['nombre_visita'])) {	
$updateSQL778 = sprintf("UPDATE visita SET nombre_visita=%s 
where id_visita=%s", 
GetSQLValueString($_POST['nombre_visita'], "text"), 
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;

}

	
	
if (isset($_POST['aprobacion_visita'])) {	
$updateSQL778 = sprintf("UPDATE visita SET aprobacion_visita=%s, aprobacion_funcionario=%s where id_visita=%s", 
GetSQLValueString($_POST['aprobacion_visita'], "int"), 
GetSQLValueString($_SESSION['snr'], "int"),   
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;
}
	

if (isset($_POST['fecha_prorroga'])) {	
$updateSQL778 = sprintf("UPDATE visita SET fecha_prorroga=%s where id_visita=%s", 
GetSQLValueString($_POST['fecha_prorroga'], "date"),  
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;
}




if (isset($_POST['fecha_inicial'])) {	
$updateSQL778 = sprintf("UPDATE visita SET fecha_inicial=%s where id_visita=%s", 
GetSQLValueString($_POST['fecha_inicial'], "date"),  
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;
}

if (isset($_POST['fecha_final'])) {	
$updateSQL778 = sprintf("UPDATE visita SET fecha_final=%s where id_visita=%s", 
GetSQLValueString($_POST['fecha_final'], "date"),  
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;
}





if (isset($_POST['visita_anterior'])) {	
$updateSQL778 = sprintf("UPDATE visita SET visita_anterior=%s where id_visita=%s", 
GetSQLValueString($_POST['visita_anterior'], "date"),  
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;
}

	
	
		
if (isset($_POST['auto'])) {	
$updateSQL778 = sprintf("UPDATE visita SET auto=%s, fecha_auto=%s where id_visita=%s", 
GetSQLValueString($_POST['auto'], "int"), 
GetSQLValueString($_POST['fecha_auto'], "date"),   
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;
}
	
	
	
	
	
	
if (isset($_POST['correos_notificacion'])) {

	if (isset($_POST['otros_correos_notificacion']) && ""!=$_POST['otros_correos_notificacion']) {
		$correosn=$_POST['correos_notificacion'].','.$_POST['otros_correos_notificacion'];
	} else {
		$correosn=$_POST['correos_notificacion'];
	}
	
$updateSQL778 = sprintf("UPDATE visita SET correos_notificacion=%s, fecha_notificacion=now() where id_visita=%s", 
GetSQLValueString($correosn, "text"), 
GetSQLValueString($id, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;
 
$emailur2='giovanni.ortegon@supernotariado.gov.co';
$subject = 'NOTIFICACIÓN DE VISITA';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Notificación de visita de la Superintendencia de Notariado y Registro.<br><br>';

$cuerpo2 .= $correosn."<br><br>"; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);

 
 
 
}	
	
	
	
	
	
	
	
	
	
function infonotaria ($info) {
global $mysqli;
$query4 = sprintf("SELECT funcionario.id_funcionario, nombre_funcionario, id_categoria_notaria, direccion_notaria, telefono_notaria, email_notaria FROM posesion_notaria, notaria, funcionario WHERE posesion_notaria.id_funcionario=funcionario.id_funcionario and posesion_notaria.id_notaria=notaria.id_notaria and notaria.id_notaria=".$info." and fecha_fin is null and estado_posesion_notaria=1 limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$informa='<br><b>Notario:</b> <a href="usuario&'.$row4['id_funcionario'].'.jsp" target="_blank">'.$row4['nombre_funcionario'].'</a>
<br><b>Categoria:</b> '.$row4['id_categoria_notaria'].'
<br><b>Dirección:</b> '.$row4['direccion_notaria'].'
<br><b>Telefono:</b> '.$row4['telefono_notaria'].'
<br><b>Email:</b> '.$row4['email_notaria'].'';		
$result4->free();
return $informa;
}


function inforegistro ($info) {
global $mysqli;
$query4 = sprintf("SELECT funcionario.id_funcionario, nombre_funcionario, circulo, direccion_oficina_registro, telefono_oficina_registro, correo_oficina_registro  
FROM funcionario, grupo_area, oficina_registro   
where grupo_area.id_orip=oficina_registro.id_oficina_registro  and funcionario.id_grupo_area=grupo_area.id_grupo_area and id_cargo=1 and oficina_registro.id_oficina_registro=" . $info . " and id_tipo_oficina=2 and estado_funcionario=1 limit 1");
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$informa='<br><b>Registrador:</b> <a href="usuario&'.$row4['id_funcionario'].'.jsp" target="_blank">'.$row4['nombre_funcionario'].'</a>
<br><b>Circulo:</b> '.$row4['circulo'].'
<br><b>Dirección:</b> '.$row4['direccion_oficina_registro'].'
<br><b>Telefono:</b> '.$row4['telefono_oficina_registro'].'
<br><b>Email:</b> '.$row4['correo_oficina_registro'].'
';	
$result4->free();
return $informa;
}

	
	
function infocuraduria ($info) {
global $mysqli;
$query4 = sprintf("SELECT funcionario.id_funcionario, nombre_funcionario, nombre_tipo_acto, nombre_situacion_curaduria, direccion_curaduria, telefono_curaduria, correo_curaduria   
FROM situacion_curaduria, curaduria, tipo_acto, funcionario 
WHERE 
situacion_curaduria.id_curaduria=curaduria.id_curaduria 
and situacion_curaduria.id_tipo_acto=tipo_acto.id_tipo_acto 
and situacion_curaduria.id_funcionario=funcionario.id_funcionario 
and situacion_curaduria.id_curaduria=".$info." and fecha_terminacion>='$realdate' and 
estado_situacion_curaduria=1 order by id_situacion_curaduria desc limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$informa='<br><b>Curador:</b> <a href="usuario&'.$row4['id_funcionario'].'.jsp" target="_blank">'.$row4['nombre_funcionario'].'</a>
<br><b>Nombramiento:</b> '.$row4['nombre_tipo_acto'].' - '.$row4['nombre_situacion_curaduria'].'
<br><b>Dirección:</b> '.$row4['direccion_curaduria'].'
<br><b>Telefono:</b> '.$row4['telefono_curaduria'].'
<br><b>Email:</b> '.$row4['correo_curaduria'].'
';	
$result4->free();
return $informa;
}	
	
	
	
	

function mailnotaria ($infoe) {
global $mysqli;
$query4e = sprintf("SELECT email_notaria FROM notaria WHERE id_notaria=".$infoe."  limit 1"); 
$result4e = $mysqli->query($query4e);
$row4e = $result4e->fetch_array();
$informae=$row4e['email_notaria'];		
$result4e->free();
return $informae;
}


function mailregistro ($infoe) {
global $mysqli;
$query4e = sprintf("SELECT correo_oficina_registro FROM oficina_registro WHERE id_oficina_registro=".$infoe."  limit 1"); 
$result4e = $mysqli->query($query4e);
$row4e = $result4e->fetch_array();
$informae=$row4e['correo_oficina_registro'];		
$result4e->free();
return $informae;
}


function mailcuraduria ($infoe) {
global $mysqli;
$query4e = sprintf("SELECT correo_curaduria FROM curaduria WHERE id_curaduria=".$infoe."  limit 1"); 
$result4e = $mysqli->query($query4e);
$row4e = $result4e->fetch_array();
$informae=$row4e['correo_curaduria'];		
$result4e->free();
return $informae;
}


function mailcatastro ($infoe) {
$informae='sisg1@supernotariado.gov.co';
return $informae;
}

	
	
	
	
	
if ((isset($_POST["nombre_anexo_visita"])) && (""!=$_POST["nombre_anexo_visita"])) { 


$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'xls', 'doc', 'docx', 'xlsx');


$directoryftp="filesnr/visitas/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'visita-'.$_SESSION['snr'].'-'.$identi;

$archivo = $_FILES['file']['tmp_name'];

$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;


if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
 


$insertSQL = sprintf("INSERT INTO anexo_visita (
id_visita, id_seccion_visita, nombre_anexo_visita, url, estado_anexo_visita) 
VALUES (%s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST['id_seccion_visita'], "int"), 
GetSQLValueString($_POST['nombre_anexo_visita'], "text"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
//echo $insertSQL;
   
  } else {
$files='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
  }
} else { 
$files='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}
		

} else { 
$files='';	
	}	
	
} else {}
	  
	
	
	
	
	
$select = mysql_query("select * from plan_visita, visita, area where 
plan_visita.id_plan_visita=visita.id_plan_visita and 
plan_visita.id_area=area.id_area 
and aprobado=1 and estado_plan_visita=1 and id_visita=".$id."  limit 1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows) {
	

	
	if (isset($row['aprobacion_visita']) && 0==$row['aprobacion_visita']){

echo 'Visita rechazada';
	} else {
$id_area=''.$row['id_area'].'';
$plan=''.$row['id_plan_visita'].'';
$vigencia=''.$row['vigencia'].'';
$cantidad=''.$row['cantidad'].'';
$nombre_area=''.$row['nombre_area'].'';



?>
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>
		  <?php echo $realdate; ?></h3>

          <p>Fecha</p>
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
          <h3><?php echo $vigencia; ?></h3>

          <p>Vigencia</p>
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

          <h3><?php echo $cantidad; ?></h3>

          <p>Cantidad programadas</p>
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
          <h3><?php $nvisitas= existenciaunica('visita', 'id_plan_visita', $plan); echo $nvisitas; ?></h3>
          <p>Visitas del area en <?php echo $vigencia; ?></p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>


  </div>

<div class="row">
    <div class="col-md-9">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Descripción de la Visita</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		<div class="row">
		 <div class="col-md-6">
          <b>Area</b>: <?php echo $row['nombre_area']; ?>
		  <br><b>Vigencia</b>: <?php echo $row['vigencia']; ?>
		   <br><b>Tipo de comisión</b>: <?php echo $row['tipo_comision']; ?>
		  <br><b>Tipo de visita</b>: <?php echo $row['tipo_visita']; ?>
		<br><b>Oficina</b>: <?php  
		$code=$row['codigo_oficina'];	 
		if (10==$id_area) {
		echo '<a href="notaria&'.$code.'.jsp" target="_blank">'.quees('notaria', $code).'</a> ';
echo infonotaria($code);
$mailn=mailnotaria($code);
			   } else if (9==$id_area) {
			      echo '<a href="orip&'.$code.'.jsp" target="_blank">'.quees('oficina_registro', $code).'</a>';
echo inforegistro($code);
$mailn=mailregistro($code);
				} else if (27==$id_area) {
			       echo '<a href="curaduria&'.$code.'.jsp" target="_blank">'.quees('curaduria', $code).'</a>';
echo infocuraduria($code);
$mailn=mailcuraduria($code);
				} else if (26==$id_area) {
			      echo '<a href="catastro&'.$code.'.jsp" target="_blank">'.quees('catastro', $code).'</a>';
$mailn=mailcatastro($code);
			   } else {} 
			   ?>
		</div>
		 <div class="col-md-6">
		
		<b>Mes</b>: <?php echo ucfirst(mese($row['mes'])); ?>
	
		<?php if (1==$row['finalizada']) { ?>
		
		

<br><b>Duración, Fecha inicial</b>: <?php echo $row['fecha_inicial']; ?>
		<br><b>Duración, Fecha final</b>: <?php echo $row['fecha_final']; ?>
		
		<?php } else { ?>
			<br><b>Duración, Fecha inicial:</b> 
	<form action="" method="post" name="ewr43435654634554656ewr"  >

 <div class="input-group">

<div class="input-group-btn">
<input type="text" name="fecha_inicial" class="form-control datepicker"   value="<?php echo $row['fecha_inicial']; ?>"  required>
</div>
 <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success">
				<span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
              </div>
            </div>
</form>

<b>Duración, Fecha final:</b>
		
			<form action="" method="post" name="ewr43435654634345435554656ewr"  >
			 
 <div class="input-group">

<div class="input-group-btn">
<input type="text" name="fecha_final" class="form-control datepicker"  value="<?php echo $row['fecha_final']; ?>"  required>
</div>
 <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success">
				<span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
              </div>
            </div>
</form>


		<?php } ?>
		
		
		
		<?php if (isset($row['fecha_prorroga']) && ""!=$row['fecha_prorroga']) { ?>
		<br><b>Duración, Fecha con prorroga</b>: <?php echo $row['fecha_final']; ?>
		<?php } else {}
			?>
		
		<?php if (1==$row['finalizada']) { } else { ?>
<form action="" method="post" name="ewr4343534554656ewr"  >
 <div class="input-group">
<div class="input-group-btn">
<input type="text" class="form-control datepicker" name="fecha_prorroga" placeholder="Prorroga" required>
</div>
 <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success">
				<span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
              </div>

            </div>
</form>
		<?php } ?>
		
		<br><b>Duración, dias de la comisión</b>: <?php 
		
		 if (isset($row['fecha_prorroga']) && ""!=$row['fecha_prorroga']) { 
		     echo calculadias($row['fecha_inicial'],$row['fecha_prorroga']);
		 } else {
			 echo calculadias($row['fecha_inicial'],$row['fecha_final']);
		 }
		 ?>
		 <br><b>Periodo, desde</b>: <?php echo $row['periodo_inicial']; ?>
<br><b>Periodo, hasta</b>: <?php echo $row['periodo_final']; ?>		  
		
</div>
</div>
	 
		   </div>
		    </div>
			
			
		

   <div class="box box-solid">
        <div class="box-header with-border">
		<div style="float: right;">
		<?php echo '<a class="btn btn-xs btn-warning" href="html/acta_visita&'.$id.'.html" target="_blank">Previsualizar</a>'; ?>
		</div>
		 <b>Asunto: </b>
		<?php echo $row['asunto']; ?>
		<br>
        <b>Objeto de la visita: </b>
		<?php echo $row['objeto']; ?>
		<hr>
		

		
		
		<?php if (1==$row['finalizada']) { 

echo '<br><br><b>RADICADO DE LA VISITA:</b> SNR2023IE0532'.rand(11, 19);

//echo '<br><a class="btn btn-xs btn-success" href="pdf/acta_visita&'.$id.'.pdf">Generar acta de visita en PDF</a>'; 
echo '<br><a class="btn btn-xs btn-success" href="html/acta_visita&'.$id.'.html"><i class="fa fa-print"></i> Imprimir acta de visita</a>';
echo '<br><a class="btn btn-xs btn-primary" href="word/acta_visita&'.$id.'.doc"><img src="images/word.png" style="width:15px;height:15px;"> Generar acta de visita en WORD</a>';

echo '<br><br><b>DESARROLLO DE LA VISITA:</b><BR><BR>';

$querykl = sprintf("SELECT * from seccion_visita, plantilla_visita 
where seccion_visita.id_plantilla_visita=plantilla_visita.id_plantilla_visita and seccion_visita.id_visita=".$id." and estado_seccion_visita=1 order by orden asc ");
$result4hjl = $mysqli->query($querykl);
while ($row4hjl = $result4hjl->fetch_array()) {

echo '<b>'.$row4hjl['nombre_plantilla_visita'];
echo '</b><br>';
echo $row4hjl['nombre_seccion_visita'];
echo '<br><br>';

}


$result4hjl->free();



		} else {  ?>
		
		
            

			
<label class="control-label"><span style="color:#ff0000;">*</span> Desarrollo de la visita:</label>
<br>


<?php

function anexos($planti) {
$infovis='<br><br><div style="background:#D4E8F9;">
<form action="" method="post" name="ewr4344354435555435ewr" enctype="multipart/form-data" >
 <div class="row">
 <div class="col-md-3">Anexar documentos</div>
<div class="col-md-3">
<select name="nombre_anexo_visita" style="width:200px;" required>
<option></option>';
	
global $mysqli;
$querykt = "select * from soporte_visita where id_plantilla_visita=".$planti." and estado_soporte_visita=1";
$result48k = $mysqli->query($querykt);
while ($obj5k = $result48k->fetch_array()) {
$infovis.= '<option>'.$obj5k['nombre_soporte_visita'].'</option>';
}
$infovis.='</select> 
</div><div class="col-md-3">
<input type="hidden" name="id_seccion_visita" value="'.$planti.'" required >
<input type="file" name="file" required >
</div><div class="col-md-3">
<button type="submit" class="btn btn-xs btn-success">Agregar anexos</button>
</div>
</div>
</form></div>';
return $infovis;
$result48k->free();
}



function textoc($iv,$plan,$areac) {
global $mysqli;
$queryk = sprintf("SELECT * from seccion_visita where id_visita=".$iv." and id_plantilla_visita=".$plan." and estado_seccion_visita=1");
$result4hj = $mysqli->query($queryk);
$row4hj = $result4hj->fetch_array();
if (0<count($row4hj)){
$reshhj=$row4hj['nombre_seccion_visita'];
//$reshhj.=anexos($plan);
} else {
$reshhj='';
}
return $reshhj;
$result4hj->free();
}




function adjuntos($visita,$seccion) {
global $mysqli;

$querykt = "select * from anexo_visita where id_seccion_visita=".$seccion." and id_visita=".$visita." and estado_anexo_visita=1";
$result48k = $mysqli->query($querykt);
$a=1;
$infovisi='';
while ($obj5k = $result48k->fetch_array()) {
$infovisi.= ''.$a++.'. <a href="filesnr/visitas/'.$obj5k['url'].'" target="_blank">'.$obj5k['nombre_anexo_visita'].'</a><br>';
}
$result48k->free();
return $infovisi;

}











 
if ('Especial'==$row['tipo_visita']) {

$select3 = mysql_query("select id_seccion_acta_visita, plantilla_visita.id_plantilla_visita, nombre_plantilla_visita from seccion_acta_visita, plantilla_visita where seccion_acta_visita.id_plantilla_visita=plantilla_visita.id_plantilla_visita and id_visita=".$id." and estado_seccion_acta_visita=1", $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
	$correosfuncionario='';
do {
echo '<hr><a href="editor/formato&'.$id.'&'.$row3['id_plantilla_visita'].'.jsp" target="_blank"><button class="btn btn-xs btn-success">'.$row3['nombre_plantilla_visita'].'</button></a><br><br>';


echo anexos($row3['id_plantilla_visita']);
//echo $id.'-'.$row3['id_plantilla_visita'].'<br>';
echo adjuntos($id,$row3['id_plantilla_visita']);



	 } while ($row3 = mysql_fetch_assoc($select3)); 
} else {}	 
mysql_free_result($select3);

} else {






$query4="select id_plantilla_visita, nombre_plantilla_visita from plantilla_visita where id_area=".$id_area." and estado_plantilla_visita=1 order by orden asc";
$result = $mysqli->query($query4);


while($row2 = $result->fetch_array()) {
	
echo '<hr><a href="editor/formato&'.$id.'&'.$row2['id_plantilla_visita'].'.jsp" target="_blank"><button class="btn btn-xs btn-success">'.$row2['nombre_plantilla_visita'].'</button></a><br><br>';


$vartexto=textoc($id,$row2['id_plantilla_visita'],$id_area);
echo $vartexto;

echo anexos($row2['id_plantilla_visita']);

echo adjuntos($id,$row2['id_plantilla_visita']);

 } 
 
$result->free();
 
 
}
 ?>



<hr>
<?php if (isset($row['nombre_visita'])) { echo $row['nombre_visita']; } else {  } ?>
<hr>


   
			  
<form action="" method="post" name="ew454543545435r4543ewr"  >
<center>
<input name="finalizada" type="hidden" value="1">
<button type="submit" class="confirmaenvio btn btn-xs btn-warning">
<span class="glyphicon glyphicon-ok" title="Agregar"></span> Finalizar acta de visita y generar radicado en IRIS</button>
</center>
</form>
		<?php } ?>

			  
          </div><!-- /.table-responsive -->
        </div>

		
			
			
			
			
			
			
			
			 </div>
			 
		
			 
			 
			 
			 
			 
			
			 
			 
			 
			 
			 
			 
			 
			 
			 
 
			 
			 <div class="col-md-3">





  <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Comisionantes</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		
		<?php 
		
		
 if (isset($_POST['id_funcionario'])) {	

$queryyy="select count(id_funcionario_visita) as cuentap from funcionario_visita where estado_funcionario_visita=1 and 
id_visita=".$id." and id_funcionario=".$_POST['id_funcionario']." ";
$select276 = mysql_query($queryyy, $conexion);
$row276 = mysql_fetch_assoc($select276);
 
if (0<$row276['cuentap']){
echo $repetido;
} else {





$insertSQL = sprintf("INSERT INTO funcionario_visita (
 id_visita, id_funcionario, nombre_funcionario_visita, estado_funcionario_visita) 
VALUES (%s, %s,  %s, %s)", 
GetSQLValueString($id, "int"),
GetSQLValueString($_POST['id_funcionario'], "int"),  
GetSQLValueString($_POST['nombre_funcionario_visita'], "text"),  
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);


}	 
mysql_free_result($select276);


 } else {}
			 
			
			 
		
		if (1==$row['aprobacion_visita']) { } else {
			?>
		  <form class="navbar-form" name="form1" method="post" action="">

            
              <div >
                <select  class="form-control"  style="width:100%" name="id_funcionario" required>
                  <option value="" selected></option>
                 <?php

if (27==$id_area) {
					 
$select27 = mysql_query("select funcionario.id_funcionario, nombre_funcionario from funcionario, personal_visita where 
funcionario.id_funcionario=personal_visita.id_funcionario and  
id_area=27 and estado_personal_visita=1 order by nombre_funcionario", $conexion);
				

} else if (10==$id_area) {
					 
$select27 = mysql_query("select funcionario.id_funcionario, nombre_funcionario from funcionario where 
(id_grupo_area=45 or id_grupo_area=44) and estado_funcionario=1 order by nombre_funcionario ", $conexion);

				
				 } else {
				 
$select27 = mysql_query("select funcionario.id_funcionario, nombre_funcionario from area, grupo_area, funcionario where 
grupo_area.id_grupo_area=funcionario.id_grupo_area and 
area.id_area=grupo_area.id_area and area.id_area=".$id_area." and 
estado_funcionario=1  order by nombre_funcionario ", $conexion);
				 }
$row27 = mysql_fetch_assoc($select27);
$totalRows27 = mysql_num_rows($select27);
				 
if (0<$totalRows27){
do {
	echo '<option value="'.$row27['id_funcionario'].'" ';
	echo '>'.$row27['nombre_funcionario'].'</option>';

	 } while ($row27 = mysql_fetch_assoc($select27)); 

} else {}	 
mysql_free_result($select27);
			?>
                </select>
              </div>
			  <div class="input-group">
			  <div class="input-group-btn">
              <select name="nombre_funcionario_visita" placeholder="Perfil (Opcional)" class="form-control"  style="width:90%"  >
			  <option selected></option>
<?php
$select27 = mysql_query("select * from personal_rol_visita where estado_personal_rol_visita=1 and 
 id_area=".$id_area." and estado_personal_rol_visita=1 order by nombre_personal_rol_visita ", $conexion);
$row27 = mysql_fetch_assoc($select27);
$totalRows27 = mysql_num_rows($select27);		 
if (0<$totalRows27){
do {
	echo '<option value="'.$row27['nombre_personal_rol_visita'].'" ';
	echo '>'.$row27['nombre_personal_rol_visita'].'</option>';

	 } while ($row27 = mysql_fetch_assoc($select27)); 

} else {}	 
mysql_free_result($select27);
			?>
			
			  
			  
			  </select>

			  </div>
			  
              <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>
              </div>

            </div>
          </form>
		  
<?php } ?>
		  
		  
<?php
$select3 = mysql_query("select * from funcionario_visita, funcionario where 
funcionario_visita.id_funcionario=funcionario.id_funcionario and id_visita=".$id." 
and estado_funcionario_visita=1  order by nombre_funcionario ", $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
	$correosfuncionario='';
	echo '<ol>';
do {
	echo '<li title="'.$row3['fecha_funcionario_visita'].'">';
	if (isset($row3['nombre_funcionario_visita'])) {
echo ''.$row3['nombre_funcionario_visita'].', ';
	} else {}
echo ''.$row3['nombre_funcionario'].'';

$correosfuncionario.=$row3['correo_funcionario'].',';

     if (1 == $_SESSION['rol']) {
		 
		 if (1==$row['aprobacion_visita']) { } else {
 echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="funcionario_visita" id="' . $row3['id_funcionario_visita'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
		 }      } else {}
					echo '</li>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
echo '</ol>';
} else {}	 
mysql_free_result($select3);
			?>
			
		   </div>
		   </div>
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   <?php
		   if ('Especial'==$row['tipo_visita']) {
			   ?>
		   <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Secciones para visitas especiales</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		
		<?php 
		
		
 if (isset($_POST['id_plantilla_visita'])) {	

$insertSQL = sprintf("INSERT INTO seccion_acta_visita (
 id_visita, id_plantilla_visita, estado_seccion_acta_visita) 
VALUES (%s, %s,  %s)", 
GetSQLValueString($id, "int"),
GetSQLValueString($_POST['id_plantilla_visita'], "int"),  
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
 } else {}
			 
			
			 
		
		if (1==$row['aprobacion_visita']) { } else {
			?>
		  <form class="navbar-form" name="form1" method="post" action="">

               <div class="input-group">
              <div class="input-group">
<select  class="form-control"  style="width:90%" name="id_plantilla_visita" required>
                  <option value="" selected></option>
                 <?php

$select27 = mysql_query("select * from plantilla_visita where id_area=".$id_area." and estado_plantilla_visita=1 order by orden", $conexion);
				
$row27 = mysql_fetch_assoc($select27);
$totalRows27 = mysql_num_rows($select27);			 
if (0<$totalRows27){
do {
	echo '<option value="'.$row27['id_plantilla_visita'].'" ';
	echo '>'.$row27['nombre_plantilla_visita'].'</option>';
	 } while ($row27 = mysql_fetch_assoc($select27)); 
} else {}	 
mysql_free_result($select27);
			?>
</select>
              </div>
			 
			 
			  
              <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>
              </div>

            </div>
          </form>
		  
<?php } ?>
		  
		  
<?php
$select3 = mysql_query("select id_seccion_acta_visita, nombre_plantilla_visita from seccion_acta_visita, plantilla_visita where seccion_acta_visita.id_plantilla_visita=plantilla_visita.id_plantilla_visita and id_visita=".$id." and estado_seccion_acta_visita=1", $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){

	echo '<ol>';
do {
	echo '<li>';

echo ''.$row3['nombre_plantilla_visita'].'';



     if (1 == $_SESSION['rol']) {
		 
		
 echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar ' . $row3['id_seccion_acta_visita'] . '" name="seccion_acta_visita" id="' . $row3['id_seccion_acta_visita'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
		      } else {}
					echo '</li>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
echo '</ol>';
} else {}	 
mysql_free_result($select3);
			?>
			
		   </div>
		   </div>
		   <?php } else {} ?>
		   
		   
		   
		   

			 
			  <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Autorización</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		<?php if (isset($row['aprobacion_visita'])) {
echo '<b>Aprobación </b>: ';
if (1==$row['aprobacion_visita']) {
	echo 'Si';
echo '<br><b>Fecha de la aprobación</b>: '.$row['fecha_aprobacion'].'';
echo '<br><b>Aprobó</b>: '.quees('funcionario',$row['aprobacion_funcionario']).'';
echo '<br><b>Comisiones:</b> <a href="comision.jsp" target="_blank">Solicitar.</a>';
} else { echo 'No'; }
			 } else {	

if (1==$_SESSION['rol'] or 1==$_SESSION['snr_grupo_cargo']) {			 ?>		
		<form action="" method="post" name="ewr43ewr"  >
Aprobar visita por parte del jefe de la oficina:
 <div class="input-group">
<div class="input-group-btn">
              <select class="form-control" name="aprobacion_visita" required>
                <option></option>
                <option value="1">Si</option>
				 <option value="0">No</option>
            </select>
			  </div>
			  
              <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success">
				<span class="glyphicon glyphicon-refresh" title="Agregar"></span></button>
              </div>

            </div>
</form>
 <?php 
} else {
echo '<br><b>Aprobación </b>: Pendiente';
 }
 } ?>
		</div>
</div>






		  <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Auto comisorio</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		
					 <?php if (isset($row['auto'])) {
echo '<b>Auto comisorio</b>: '.$row['auto'].' ';

echo '<br><b>Fecha del Auto</b>: '.$row['fecha_auto'].'';

echo '<div class="box-tools">

<a  href="pdf/auto_comision&'.$id.'.pdf"><img src="images/pdf.png" style="width:15px;height:15px;"> Generar auto en PDF</a>

<br><a  href="word/auto_comision&'.$id.'.doc"><img src="images/word.png" style="width:15px;height:15px;"> Generar auto en WORD</a>

'; ?>
<hr>

<?php
if (isset($row['correos_notificacion'])) {
	
	echo '<b>Correos notificados en '.$row['fecha_notificacion'].':</b> ';
	
	$corr = str_replace(",", "<br>", $row['correos_notificacion']);
	$corr = str_replace(",", "<br>", $row['correos_notificacion']);
    echo $corr;
	
	
} else {
	?>
 <form  name="for343244ty234t564TU36" method="post" action="">

<b>Correos para notificar el auto:</b> <br>
<?php $prepcorreos=$correosfuncionario.$mailn;
$corr = str_replace(",", "<br>", $prepcorreos);
echo $corr;
 ?>
 <input type="hidden" class="form-control" name="correos_notificacion" value="<?php echo $prepcorreos; ?>"  required>
<input type="text" class="form-control" name="otros_correos_notificacion" value="" placeholder="Más correos separados por ,">

<button type="submit" class="enviar_correo btn btn-xs btn-success"> Enviar</button>
</form>
				  


<?php 

}

echo '</div>';


			 } else {		?>		
			  <form  name="for343244tyt564TU36" method="post" action="">
 Auto comisorio:
 <div class="input-group">
<div class="input-group-btn">
               <input type="text" class="form-control" name="auto" value="" required>
                      
			  </div>
			  <div class="input-group-btn">
               <input type="text" class="form-control datepicker" placeholder="Fecha del auto" name="fecha_auto" value="" required>
                      
			  </div>
			  
              <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success">
				<span class="glyphicon glyphicon-refresh" title="Agregar"></span> </button>
              </div>

            </div>
			
                  </form>
			 <?php } ?>
			 
		</div>
</div>










		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		    <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Visitas anteriores</h3>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		
		<?php if (9==$id_area) { 
		

$query5 = "SELECT * FROM visitas_sdr where id_orip=".$code." ";
$result5 = $mysqli->query($query5);
while ($obj5 = $result5->fetch_array()) {
echo '<li>'.$obj5['id'].'</li>';
    }
$result5->free();

		
 }  else if (10==$id_area) { 

$query5 = "SELECT * FROM visitas_sdn where id_notaria=".$code." ";
$result5 = $mysqli->query($query5);
while ($obj5 = $result5->fetch_array()) {
echo '<li>Auto: '.$obj5['auto'].'-'.$obj5['ano'].', '.$obj5['clase_visita'].' - '.$obj5['categoria_visita'].', '.$obj5['fecha_inicio'].' - '.$obj5['fecha_final'].'</li>';
    }
$result5->free();



 }  else if (27==$id_area) { 


$query5 = "SELECT * FROM visitas_curadurias where id_curaduria=".$code." ";
$result5 = $mysqli->query($query5);
while ($obj5 = $result5->fetch_array()) {
echo '<li>Auto: '.$obj5['auto'].'-'.$obj5['ano'].', '.$obj5['clase_visita'].' - '.$obj5['categoria_visita'].', '.$obj5['fecha_inicio'].' - '.$obj5['fecha_final'].'</li>';
    }
$result5->free();




 } else {
			?>
<form class="navbar-form" name="fo54645635435rm1" method="post" action="">
<div class="input-group">
<div class="input-group-btn">Visita anterior:

<input name="visita_anterior"  type="text"  class="form-control datepickera"  required>		  

</div>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>
              </div>

            </div>
          </form>  
<?php }  ?>
</div>
		   </div>
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   		    <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Consulta de información</h3>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		<?php 
		if (9==$id_area) {
?>		
	<a href="orip&<?php echo $code; ?>.jsp" target="_blank">Hoja de vida de Orip</a>
	<br><a href="https://sisg.supernotariado.gov.co/analisis_oficina&<?php echo $code; ?>-2.jsp" target="_blank">PQRSD</a>
	<br><a href="https://sisg.supernotariado.gov.co/no_conformidad_estadistica.jsp" target="_blank">No conformidades</a>
	<br><a href="https://sisg.supernotariado.gov.co/ambiental_estadistica.jsp" target="_blank">Control ambiental</a>
	
	<br><a href="https://sisg.supernotariado.gov.co/estado_tramite_orip.jsp" target="_blank">Estado real (G2,E3)</a>
	<br><a href="https://sisg.supernotariado.gov.co/reporte_diario_orip.jsp" target="_blank">Control diario de Registro</a>
	
	<br><a href="https://sisg.supernotariado.gov.co/estado_juridico.jsp" target="_blank">Estado juridico</a>
	
	
	
	<br><a href="https://sisg.supernotariado.gov.co/gaj_tutela.jsp" target="_blank">Control de tutelas</a>
	
	<br><a href="https://sisg.supernotariado.gov.co/registro_bi/" target="_blank">Control de operación</a>
		<br><a href="https://app.powerbi.com/links/Rxj5C8iqfj?ctid=9b1ecfaa-c675-42ee-b297-0eaeb51bcc4c&pbi_source=linkShare" target="_blank">Control de Orips</a>
		<br><a href="https://estadotramiteciud.supernotariado.gov.co/Portal/EstadoTramiteCiud/" target="_blank">Estado de tramites</a>
		<br><a href="https://radicacion.supernotariado.gov.co/app/" target="_blank">Control de radicaciones</a>
<br><a href="https://sir.supernotariado.gov.co/" target="_blank">Sistema Registral</a>
<br><a href="https://www.vur.gov.co/portal/" target="_blank">Ventanilla Unica Registral</a>
<br><a href="https://cdn.supernotariado.gov.co" target="_blank">Libros de antiguo sistema</a>

<?PHP	
	 }  else if (10==$id_area) { ?>
<a href="notaria&<?php echo $code; ?>.jsp" target="_blank">Hoja de vida de la Notaria</a>
<br><a href="https://sisg.supernotariado.gov.co/mapa_notarias.jsp" target="_blank">Control de Notarias</a>

<br><a href="https://app.powerbi.com/view?r=eyJrIjoiNWQzNjlkYmEtODk5NC00NTY0LTg2M2UtZWU2ZjEyOWE4YTI5IiwidCI6IjliMWVjZmFhLWM2NzUtNDJlZS1iMjk3LTBlYWViNTFiY2M0YyIsImMiOjR9" target="_blank">Control de PQRS</a>

<br><a href="https://sisg.supernotariado.gov.co/control_req_tras.jsp" target="_blank">Control de requerimientos</a>


<br><a href="https://sisg.supernotariado.gov.co/turnos_sabados.jsp" target="_blank">Turnos de sabados</a>

<br><a href="https://sisg.supernotariado.gov.co/carceles.jsp" target="_blank">Turnos de carceles</a>

<br><a href="https://sisg.supernotariado.gov.co/reparto_asignado&<?php echo $code; ?>.jsp" target="_blank">Control de repartos</a>

<br><a href="https://sisg.supernotariado.gov.co/testamento&<?php echo $code; ?>.jsp" target="_blank">Control de testamentos</a>
<br><a href="https://sisg.supernotariado.gov.co/salida_menor&<?php echo $code; ?>.jsp" target="_blank">Control de salida de menores</a>
<br><a href="https://sisg.supernotariado.gov.co/apostilla&<?php echo $code; ?>.jsp" target="_blank">Control de apostillas</a>

<br><a href="https://sisg.supernotariado.gov.co/sucesion&<?php echo $code; ?>.jsp" target="_blank">Control de sucesiones</a>


<br><a href="https://sisg.supernotariado.gov.co/local_notaria&<?php echo $code; ?>.jsp" target="_blank">Control de local</a>


<?php		 
	 }  else if (27==$id_area) { ?>
<a href="curaduria&<?php echo $code; ?>.jsp" target="_blank">Hoja de vida de la Curaduria</a>
<br><a href="https://sisg.supernotariado.gov.co/radicacion_curaduria&<?php echo $code; ?>.jsp" target="_blank">Control de radicaciones</a>
<br><a href="https://sisg.supernotariado.gov.co/licencia_curaduria&<?php echo $code; ?>.jsp" target="_blank">Control de licencias</a>
<br><a href="https://sisg.supernotariado.gov.co/expensa_curaduria&<?php echo $code; ?>.jsp" target="_blank">Control de expensas</a>	 


<br><a href="https://servicios.supernotariado.gov.co/files/portal/portal-normatividad_nacional_dcurb.pdf" target="_blank">Normatividad nacional</a>	 

<br><a href="https://servicios.supernotariado.gov.co/files/portal/portal-normatividad_local_dcurb.pdf" target="_blank">Normatividad local</a>	 
<br><a href="https://sisg.supernotariado.gov.co/analisis_curaduria_interdisciplinario.jsp" target="_blank">Grupo interdisciplinario</a>	 
<br><a href="https://sisg.supernotariado.gov.co/xls/faltas_curadores.xls" target="_blank">Faltas</a>	 
<br><a href="https://sisg.supernotariado.gov.co/control_lista_elegibles.jsp" target="_blank">Control de listas de elegibles</a>	 





<?php	 
	 } else {}
	 ?>
</div>
		   </div>
		   
		   
		   
		   
		   
		   
		   
		   
		   	  <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Requerimientos de información</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		
		<?php 
		
		
 if (isset($_POST['nombre_requerimiento_visita'])) {	

$insertSQL = sprintf("INSERT INTO requerimiento_visita (
 id_visita, nombre_requerimiento_visita, estado_requerimiento_visita) 
VALUES (%s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST['nombre_requerimiento_visita'], "text"),  
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
 } else {}
			 
			
			 

			?>
			
			<?php if (1==$row['finalizada']) { } else { 
			
echo ' <a href=""  title="Requerimiento" data-toggle="modal" data-target="#popuprequerimiento"> <span class="btn btn-xs btn-success">Nuevo requerimiento</span></a> <br><br>';

			 } ?>
		  

		  
		  
<?php
$select3 = mysql_query("select * from requerimiento_visita where 
id_visita=".$id." and estado_requerimiento_visita=1  order by id_requerimiento_visita ", $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
	echo '<ol>';
do {
	echo '<li>';
	
echo '<i>'.$row3['fecha_requerimiento_visita'].'</i> - '.$row3['nombre_requerimiento_visita'].'';


     if (1 == $_SESSION['rol']) {
		 
		 if (1==$row['aprobacion_visita']) { } else {
 echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="requerimiento_visita" id="' . $row3['id_requerimiento_visita'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
		 }      } else {}
					echo '</li>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
echo '</ol>';
} else {}	 
mysql_free_result($select3);
			?>
			
		   </div>
		   </div>
		   
		   




















			 <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Anexos</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		
		
	<form action="" method="post" name="ewr43443555435ewr" enctype="multipart/form-data" >
Cargar anexos, fichas, etc.<br>
<input type="file" name="file" required >
<input type="text" value="" placeholder="Nombre del anexo" style="width:80%" name="nombre_anexo_visita" required>
<button type="submit" class="btn btn-xs btn-success">
<span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>
</form>
<br>
<?php
$select35 = mysql_query("select * from anexo_visita where id_visita=".$id." 
and estado_anexo_visita=1  order by fecha ", $conexion);
$row35 = mysql_fetch_assoc($select35);
$totalRows35 = mysql_num_rows($select35);
if (0<$totalRows35){
	echo '<ol>';
do {
	echo '<li title="'.$row35['fecha'].'"><a href="filesnr/visitas/'.$row35['url'].'" target="_blank">'.$row35['nombre_anexo_visita'].'</a> ';
     if (1 == $_SESSION['rol']) {
		 
		 if (1==$row['finalizada']) { } else {
		 
 echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="anexo_visita" id="' . $row35['id_anexo_visita'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
		 }                
				} else {}
					echo '</li>';
	 } while ($row35 = mysql_fetch_assoc($select35)); 
echo '</ol>';
} else {}	 
mysql_free_result($select35);
			?>
			
		   </div>
		   </div>

















		   	  <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Finalización, calificación</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
		
		<?php 
		
		
 if (isset($_POST['nombre_calificacion_visita'])) {	

$insertSQL = sprintf("INSERT INTO calificacion_visita (
 id_visita, nombre_calificacion_visita, codigo_visita, descripcion_calificacion_visita, estado_calificacion_visita) 
VALUES (%s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST['nombre_calificacion_visita'], "text"),  
GetSQLValueString($_POST['codigo_visita'], "text"),  
GetSQLValueString($_POST['descripcion_calificacion_visita'], "text"),  
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
 } else {}
			 
		

		
			 
 if (1==$row['finalizada']) { } else { 
			
echo ' <a href=""  title="Calificación" data-toggle="modal" data-target="#popupcalificacion"> <span class="btn btn-xs btn-success">+ Nuevo</span></a> <br><br>';

			 } ?>
		  

		  
		  
<?php
$select3 = mysql_query("select * from calificacion_visita where 
id_visita=".$id." and estado_calificacion_visita=1  order by id_calificacion_visita ", $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
	echo '<ol>';
do {
	echo '<li>';
	
echo '<i>'.$row3['fecha_calificacion_visita'].'</i> - <b>'.$row3['nombre_calificacion_visita'].'';
echo ' / '.$row3['codigo_visita'].': </b>';

echo '<span>'.$row3['descripcion_calificacion_visita'].'</span>';

echo '</li>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
echo '</ol>';
} else {}	 
mysql_free_result($select3);
			?>
			
		   </div>
		   </div>
		   
		   








		   </div>
		   
		   
			  </div>
		  
		  







<div class="modal fade" id="popuprequerimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Nuevo requerimiento</b></h4>
</div> 
<div  class="modal-body"> 
<?php
if (isset($_POST['correovigiladoreq'])) {
	
$emailur2='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Nuevo requerimiento';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'La Superintendencia de Notariado y Registro ha realizado un nuevo requerimiento.<br><br>';

$cuerpo2 .= $_POST['nombre_requerimiento_visita']."<br><br>"; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);

 
	}
?>
  <form class="navbar-form" name="fo5435435rm1" method="post" action="">
  Correo de la oficina:<br>
<input type="text" name="correovigiladoreq" readonly style="width:100%" required value="<?php echo $mailn; ?>"><br>
            
    
			Nuevo requerimiento:<br>
              <textarea name="nombre_requerimiento_visita" class="form-control" style="width:100%" required></textarea>

			 
			  <br> <br>
             
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span> Enviar </button>
             

            </div>
          </form>
</div>
</div> 
</div> 










<div class="modal fade" id="popupcalificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Nueva calificación</b></h4>
</div> 
<div  class="modal-body"> 

  <form class="navbar-form" name="fo543654635435rm1" method="post" action="">
  Tipo:<br>
<select name="nombre_calificacion_visita" class="form-control" style="width:100%" required>
<option selected></option>
<option>Plan de mejoramiento</option>
<option>Auto de archivo</option>
<option>Traslado a control disciplinario</option>
</select>
<br>

Número o código de identificación:
            <br>
			
			<input type="text" name="codigo_visita" class="form-control" required">
           
		   <br>
    
			Descripción:<br>
              <textarea name="descripcion_calificacion_visita" class="form-control" id="texto_para_conocimiento" style="width:100%" required></textarea>

			 
			  <br> <br>
             
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span> Enviar </button>
             

            </div>
          </form>
</div>
</div> 
</div> 









</div>





<?php

	}
	
} else {  }	 
mysql_free_result($select);




} else {
  echo 'No tiene acceso. ';
} 


} else {
  echo 'No tiene acceso. ';
}

?>
<?php
if (isset($_GET['i']) && "" != $_GET['i']) {
$id = $_GET['i'];



$query_updaten = sprintf("SELECT email_notaria, nombre_notaria, notaria.id_notaria, id_categoria_notaria FROM permiso, notaria WHERE id_permiso = %s and permiso.id_notaria=notaria.id_notaria and estado_notaria=1 and estado_permiso=1", GetSQLValueString($id, "int"));
$updaten = mysql_query($query_updaten, $conexion);
$row_updaten = mysql_fetch_assoc($updaten);
$totalRows_updaten = mysql_num_rows($updaten);
if (0<$totalRows_updaten) {
	
$id_notaria=$row_updaten['id_notaria'];
$email_notaria=$row_updaten['email_notaria'];
$nombre_notaria=$row_updaten['nombre_notaria'];
$id_categoria_notaria=$row_updaten['id_categoria_notaria'];
} else {}



if (isset($_GET['e']) && "" != $_GET['e']) {
$ed = $_GET['e'];
$eda=explode('-', $ed);
$iddia=$eda[0];
$tipoid=$eda[1];

$updateSQLy = sprintf("UPDATE dia_licencia SET id_tipo_encargo=%s where id_dia_licencia=%s and estado_dia_licencia=1",
GetSQLValueString($tipoid, "int"), 
GetSQLValueString($iddia, "int"));
$Resulty = mysql_query($updateSQLy, $conexion) or die(mysql_error());
echo $actualizado;

} else {}




$nump6=privilegios(6,$_SESSION['snr']);

 
if ((isset($_POST["table"])) && ($_POST["table"] == "permiso")) { 
$updateSQL = sprintf("UPDATE permiso SET numero_resolucion=%s, id_funcionario=%s, fecha_resolucion=%s, aprobacion=%s, fecha_aprobacion=now(), modificacion=%s where id_permiso=%s",
GetSQLValueString($_POST["numero_resolucion"], "text"), 
GetSQLValueString($_POST["id_funcionario_notario"], "int"), 
GetSQLValueString($_POST["fecha_resolucion"], "date"), 
GetSQLValueString(1, "int"), 
GetSQLValueString(0, "int"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());
echo $actualizado;

/*
$correo_notario='giova900@gmail.com';
$res_dan=$_POST["numero_resolucion"];
$res_fecha=$_POST["fecha_resolucion"];

$subject = 'Superintendencia de Notariado y Registro';
$headers = "From: Supernotariado<notificadorD@supernotariado.gov.co>\r\n";
$headers .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$message = '';
$message .= 'Cordial saludo<br>';
$message .= 'La Dirección de Administración Notarial de la Superintendencia de Notariado y Registro informa la resolución de su permiso ó licencia.<br>La resolución es la número '.$res_dan.' con fecha '.$res_fecha.'<br>';
$message .= 'Puede visualizar la resolución en la dirección web https://sisg.supernotariado.gov.co/files/resoluciones/res-1485-20200227170741.pdf<br><br>';
$message .= 'Superintendencia de Notariado y Registro<br>';
mail($correo_notario, $subject, $message, $headers);
*/


} else { }


$query_update = sprintf("SELECT * FROM permiso WHERE id_permiso = %s and estado_permiso=1", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update && (1==$_SESSION['rol'] or 0<$nump6))

{
	
$id_notaria=$row_update['id_notaria'];
$id_notario=$row_update['id_funcionario'];
$id_encargado=$row_update['id_funcionario_encargado'];
	
if (0==$row_update['origen']) {
	$origen='SNR';
} else {
	$origen='WEB';
}

if (isset($row_update['numero_resolucion'])) {
	$resolucion=$row_update['numero_resolucion'];
	$fecha_resolucion=$row_update['fecha_resolucion'];
} else {
	$resolucion='En tramite';
	$fecha_resolucion='En tramite';
}


mysql_free_result($update);







if ((isset($_POST["id_tipo_encargo"])) && ($_POST["id_tipo_encargo"] != "") && ""!=$_POST["fecha_permiso_desde"]) { 





require_once('pages/validacion_dias.php'); 




if (""!=$_POST["fecha_permiso_hasta"]) {


if (strtotime($_POST["fecha_permiso_hasta"])>strtotime($_POST["fecha_permiso_desde"]))

	{
	
	//echo $_POST["fecha_permiso_desde"];

$begin = new DateTime($_POST["fecha_permiso_desde"]);
$end = new DateTime($_POST["fecha_permiso_hasta"]);
$end = $end->modify( '+1 day' ); 
$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
    $date1= $date->format("Y-m-d");


$query_reghx = "SELECT count(id_dia_licencia) as totper FROM dia_licencia, permiso WHERE dia_licencia.id_permiso=permiso.id_permiso and fecha_permiso='$date1' and id_funcionario=".$id_notario." and estado_permiso=1 and estado_dia_licencia=1 and id_tipo_encargo<5";
$reghx = mysql_query($query_reghx, $conexion);
$row_reghx = mysql_fetch_assoc($reghx);

if (0<$row_reghx['totper']) {
echo '<div style="width:100%;background:#B40404;color:#fff;text-align: center;">No se puede ingresar la fecha9999: '.$date1.'.</div>';
} else {
	  
	  
	  
$id_tipo_encargo=$_POST['id_tipo_encargo'];
$valido=permiso($id_notario, $date1, $id_tipo_encargo);

if (1==$valido) { 
	
$id_funcionario_encargo=$_POST["id_funcionario_encargo"];

$insertSQL = sprintf("INSERT INTO dia_licencia (id_permiso, fecha_permiso, id_tipo_encargo, id_funcionario_encargo, estado_dia_licencia, confirmado) VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($date1, "date"), 
GetSQLValueString($id_tipo_encargo, "int"), 
GetSQLValueString($id_funcionario_encargo, "int"), 
GetSQLValueString(1, "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
//echo $insertado;
echo '<div style="width:100%;background:#00A65A;color:#fff;text-align: center;">Ok '.$date1.'.</div>';

} else { echo $nopermitido;  } 

}
  
    }
	
	} else { 
echo '<script type="text/javascript">swal(" ERROR !", " Las fechas no estan ordenadas. !", "error");</script>';

	}

} else {
	

	
$infofecha=$_POST["fecha_permiso_desde"];



$query_reghx = "SELECT count(id_dia_licencia) as totper FROM dia_licencia, permiso WHERE dia_licencia.id_permiso=permiso.id_permiso and fecha_permiso='$infofecha' and id_funcionario=".$id_notario." and estado_permiso=1 and estado_dia_licencia=1 and id_tipo_encargo<5 AND hora_desde IS  null ";
$reghx = mysql_query($query_reghx, $conexion) or die(mysql_error());
$row_reghx = mysql_fetch_assoc($reghx);

if (0<$row_reghx['totper']) {
echo '<div style="width:100%;background:#B40404;color:#fff;text-align: center;">No se puede ingresar la fecha: '.$infofecha.'.</div>';
} else {
	
	


$id_tipo_encargo=$_POST["id_tipo_encargo"];
$id_funcionario_encargo=$_POST["id_funcionario_encargo"];



if (""!=$_POST["hora_desde"] && ""!=$_POST["hora_hasta"]) {
	$hora_desde=$_POST["hora_desde"];
	$hora_hasta=$_POST["hora_hasta"];
} else {
	$hora_desde='';
	$hora_hasta='';
}

$valido=permiso($id_notario, $infofecha, $id_tipo_encargo);



if (1==$valido) {
$insertSQL = sprintf("INSERT INTO dia_licencia (id_permiso, fecha_permiso, hora_desde, hora_hasta, id_tipo_encargo, id_funcionario_encargo, estado_dia_licencia, confirmado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($infofecha, "date"),
GetSQLValueString($hora_desde, "text"), 
GetSQLValueString($hora_hasta, "text"),  
GetSQLValueString($id_tipo_encargo, "int"), 
GetSQLValueString($id_funcionario_encargo, "int"), 
GetSQLValueString(1, "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
} else {
	echo $nopermitido;

	} 

//echo $insertado;
echo '<div style="width:100%;background:#00A65A;color:#fff;text-align: center;">Ok '.$infofecha.'.</div>';
}
}



} else {}	

?>


			 <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3>
<?php
//$query12 = "SELECT count(id_dia_licencia) as totres FROM dia_licencia where id_permiso=".$id." and confirmado=1 and estado_dia_licencia=1";
$query12 = "SELECT count(id_dia_licencia) as totresaa FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=".$id_notario." and YEAR(dia_licencia.fecha_permiso) = ".$anoactualcompleto." and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1 and dia_licencia.id_tipo_encargo =1 ";
$res12 = mysql_query($query12);
$rownes = mysql_fetch_assoc($res12);
if (isset($rownes['totresaa'])) {
echo $rownes['totresaa'];
} else { echo '0';}
?>
</h3>

              <p>Dias de licencias ordinarias durante <?php echo $anoactualcompleto; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
			
            <a href="xls/reporte_permiso&<?php echo $id_notario; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
$query12a = "SELECT count(id_dia_licencia) as totresa FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=".$id_notario." and YEAR(fecha_permiso) = ".$anoactualcompleto." and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1 and dia_licencia.id_tipo_encargo =2 ";
$res12a = mysql_query($query12a);
$rownesa = mysql_fetch_assoc($res12a);
if (isset($rownesa['totresa'])) {
echo $rownesa['totresa'];
} else { echo '0';}
?></h3>

              <p>Dias de permiso durante <?php echo $anoactualcompleto; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="xls/reporte_permiso&<?php echo $id_notario; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
<?php
//$query12a = "SELECT count(id_dia_licencia) as totresa FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=".$id_notario." and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1";
$query12af = "SELECT count(id_dia_licencia) as totresar FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=".$id_notario." and YEAR(fecha_permiso) = ".$anoactualcompleto." and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1 and dia_licencia.id_tipo_encargo =3 ";

$res12af = mysql_query($query12af);
$rownesaf = mysql_fetch_assoc($res12af);
if (isset($rownesaf['totresar'])) {
echo $rownesaf['totresar'];
} else { echo '0';}
?></h3>

              <p>Dias de licencias por incapacidad durante el <?php echo $anoactualcompleto; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="xls/reporte_permiso&<?php echo $id_notario; ?>.xls" class="small-box-footer" >Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3>
<?php


$query12aft = "SELECT count(id_dia_licencia) as totrese FROM dia_licencia, permiso where permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=".$id_notario." and YEAR(fecha_permiso) = ".$anoactualcompleto." and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1 and dia_licencia.id_tipo_encargo =4 ";

//$query12a = "SELECT count(id_dia_licencia) as totresar FROM dia_licencia, permiso where dia_licencia.id_tipo_encargo=1 and YEAR(fecha_permiso) = 2019 and permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=".$id_notario." and dia_licencia.confirmado=1 and estado_dia_licencia=1 and estado_permiso=1";
$res12aft = mysql_query($query12aft);
$rownesaft = mysql_fetch_assoc($res12aft);
//$infoper= $rownesa['totresar'];
if (isset($rownesaft['totrese'])) {
echo $rownesaft['totrese'];
} else { echo '0';}

//$noventa=90;
//$dtt=intval($infoper);
//$tdis= $noventa - $dtt;
//echo $tdis;
?></h3>
              <p>Dias de licencia especial durante <?php echo $anoactualcompleto; ?> <?php //echo $infoper; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="xls/reporte_permiso&<?php echo $id_notario; ?>.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
			
			
			
          </div>
        </div>
		
	 
      </div>
	
	
		
<div class="row">
		  
		  
		  <div class="col-md-5">
		  <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Dias y tipo de encargo</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
         <div class="box-body">

		 



<form action="" method="POST" name="form1" onsubmit="return validate();">

<script>
var arraydays = <?PHP 
//$query126 = "select fecha_permiso from permiso, dia_licencia where dia_licencia.confirmado=1 and permiso.id_permiso=dia_licencia.id_permiso and permiso.id_funcionario=".$id_notario." and estado_permiso=1 and fecha_permiso like '%$anoactualcompleto%' and hora_desde is null";

$query126 = "SELECT fecha_permiso FROM dia_licencia, permiso where dia_licencia.hora_desde is  null and permiso.id_permiso=dia_licencia.id_permiso and id_funcionario=".$id_notario." and dia_licencia.confirmado=1 and dia_licencia.id_tipo_encargo<=4 and estado_dia_licencia=1 and estado_permiso=1";

$result126 = mysql_query($query126);
$totalresult126 = mysql_num_rows($result126);
if(0<$totalresult126){
while ($row126 = @mysql_fetch_assoc($result126)){
$arrayday[]='"'.$row126['fecha_permiso'].'"';
}
$string=implode(",",$arrayday);
echo '['.$string.']';
mysql_free_result($result126);
} else { echo '["1940-01-01"]'; }
?>
</script>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE PERMISO:</label> 

<div class="input-group">
<div class="input-group-btn">
<input type="text"  readonly="readonly" required class="form-control datepickera" name="fecha_permiso_desde" placeholder="Dia / Desde"  >
</div>
<div class="input-group-btn">
<input type="text" readonly="readonly" class="form-control datepickera" id="fecha_permiso_hasta" name="fecha_permiso_hasta"  placeholder="Hasta / opcional"  >
</div>
</div>
</div>
<div class="form-group text-left" id="horas_permiso"> 
<label  class="control-label">POR HORAS:</label> 

<div class="input-group">
<div class="input-group-btn">
<select  class="form-control" name="hora_desde">
<option value="" selected>Desde</option>
<option value="06:00:00">06:00:00</option>
<option value="06:15:00">06:15:00</option>
<option value="06:30:00">06:30:00</option>
<option value="06:45:00">06:45:00</option>
<option value="07:00:00">07:00:00</option>
<option value="07:15:00">07:15:00</option>
<option value="07:30:00">07:30:00</option>
<option value="07:45:00">07:45:00</option>
<option value="08:00:00">08:00:00</option>
<option value="08:15:00">08:15:00</option>
<option value="08:30:00">08:30:00</option>
<option value="08:45:00">08:45:00</option>
<option value="09:00:00">09:00:00</option>
<option value="09:15:00">09:15:00</option>
<option value="09:30:00">09:30:00</option>
<option value="09:45:00">09:45:00</option>
<option value="10:00:00">10:00:00</option>
<option value="10:15:00">10:15:00</option>
<option value="10:30:00">10:30:00</option>
<option value="10:45:00">10:45:00</option>
<option value="11:00:00">11:00:00</option>
<option value="11:15:00">11:15:00</option>
<option value="11:30:00">11:30:00</option>
<option value="11:45:00">11:45:00</option>
<option value="12:00:00">12:00:00</option>
<option value="12:15:00">12:15:00</option>
<option value="12:30:00">12:30:00</option>
<option value="12:45:00">12:45:00</option>
<option value="13:00:00">13:00:00</option>
<option value="13:15:00">13:15:00</option>
<option value="13:30:00">13:30:00</option>
<option value="13:45:00">13:45:00</option>
<option value="14:00:00">14:00:00</option>
<option value="14:15:00">14:15:00</option>
<option value="14:30:00">14:30:00</option>
<option value="14:45:00">14:45:00</option>
<option value="15:00:00">15:00:00</option>
<option value="15:15:00">15:15:00</option>
<option value="15:30:00">15:30:00</option>
<option value="15:45:00">15:45:00</option>
<option value="16:00:00">16:00:00</option>
<option value="16:15:00">16:15:00</option>
<option value="16:30:00">16:30:00</option>
<option value="16:45:00">16:45:00</option>
<option value="17:00:00">17:00:00</option>
<option value="17:15:00">17:15:00</option>
<option value="17:30:00">17:30:00</option>
<option value="17:45:00">17:45:00</option>
<option value="18:00:00">18:00:00</option>
<option value="18:15:00">18:15:00</option>
<option value="18:30:00">18:30:00</option>
<option value="18:45:00">18:45:00</option>
<option value="19:00:00">19:00:00</option>
<option value="19:15:00">19:15:00</option>
<option value="19:30:00">19:30:00</option>
<option value="19:45:00">19:45:00</option>
<option value="20:00:00">20:00:00</option>
<option value="20:15:00">20:15:00</option>
<option value="20:30:00">20:30:00</option>
<option value="20:45:00">20:45:00</option>
<option value="21:00:00">21:00:00</option>
<option value="21:15:00">21:15:00</option>
<option value="21:30:00">21:30:00</option>
<option value="21:45:00">21:45:00</option>
<option value="22:00:00">22:00:00</option>
</select>
</div>
<div class="input-group-btn">
<select  class="form-control" name="hora_hasta">
<option value="" selected>Hasta</option>
<option value="06:00:00">06:00:00</option>
<option value="06:15:00">06:15:00</option>
<option value="06:30:00">06:30:00</option>
<option value="06:45:00">06:45:00</option>
<option value="07:00:00">07:00:00</option>
<option value="07:15:00">07:15:00</option>
<option value="07:30:00">07:30:00</option>
<option value="07:45:00">07:45:00</option>
<option value="08:00:00">08:00:00</option>
<option value="08:15:00">08:15:00</option>
<option value="08:30:00">08:30:00</option>
<option value="08:45:00">08:45:00</option>
<option value="09:00:00">09:00:00</option>
<option value="09:15:00">09:15:00</option>
<option value="09:30:00">09:30:00</option>
<option value="09:45:00">09:45:00</option>
<option value="10:00:00">10:00:00</option>
<option value="10:15:00">10:15:00</option>
<option value="10:30:00">10:30:00</option>
<option value="10:45:00">10:45:00</option>
<option value="11:00:00">11:00:00</option>
<option value="11:15:00">11:15:00</option>
<option value="11:30:00">11:30:00</option>
<option value="11:45:00">11:45:00</option>
<option value="12:00:00">12:00:00</option>
<option value="12:15:00">12:15:00</option>
<option value="12:30:00">12:30:00</option>
<option value="12:45:00">12:45:00</option>
<option value="13:00:00">13:00:00</option>
<option value="13:15:00">13:15:00</option>
<option value="13:30:00">13:30:00</option>
<option value="13:45:00">13:45:00</option>
<option value="14:00:00">14:00:00</option>
<option value="14:15:00">14:15:00</option>
<option value="14:30:00">14:30:00</option>
<option value="14:45:00">14:45:00</option>
<option value="15:00:00">15:00:00</option>
<option value="15:15:00">15:15:00</option>
<option value="15:30:00">15:30:00</option>
<option value="15:45:00">15:45:00</option>
<option value="16:00:00">16:00:00</option>
<option value="16:15:00">16:15:00</option>
<option value="16:30:00">16:30:00</option>
<option value="16:45:00">16:45:00</option>
<option value="17:00:00">17:00:00</option>
<option value="17:15:00">17:15:00</option>
<option value="17:30:00">17:30:00</option>
<option value="17:45:00">17:45:00</option>
<option value="18:00:00">18:00:00</option>
<option value="18:15:00">18:15:00</option>
<option value="18:30:00">18:30:00</option>
<option value="18:45:00">18:45:00</option>
<option value="19:00:00">19:00:00</option>
<option value="19:15:00">19:15:00</option>
<option value="19:30:00">19:30:00</option>
<option value="19:45:00">19:45:00</option>
<option value="20:00:00">20:00:00</option>
<option value="20:15:00">20:15:00</option>
<option value="20:30:00">20:30:00</option>
<option value="20:45:00">20:45:00</option>
<option value="21:00:00">21:00:00</option>
<option value="21:15:00">21:15:00</option>
<option value="21:30:00">21:30:00</option>
<option value="21:45:00">21:45:00</option>
<option value="22:00:00">22:00:00</option>
</select>
</div>
</div>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE ENCARGO:</label> 
<select  class="form-control" name="id_tipo_encargo" required>
<option value=""></option>
<?php 
$queryne = sprintf("SELECT * FROM tipo_encargo where inicial=1 and estado_tipo_encargo=1");
$selectne = mysql_query($queryne, $conexion) or die(mysql_error());
$rowne = mysql_fetch_assoc($selectne);
$totalRowsne = mysql_num_rows($selectne);
if (0<$totalRowsne){
			do {
echo '<option value="'.$rowne['id_tipo_encargo'].'" ';

echo '>'.$rowne['nombre_tipo_encargo'].'</option>';
} while ($rowne = mysql_fetch_assoc($selectne));

} else {
	echo '';
}
mysql_free_result($selectne);
 ?></option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ENCARGADO:</label>   
<select  class="form-control" name="id_funcionario_encargo" required>

<option value="<?php echo $id_encargado; ?>" selected><?php echo quees('funcionario', $id_encargado); ?></option>
<?php
$queryn = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_funcionario!=".$id_encargado." and id_notaria_f=".$id_notaria." and id_tipo_oficina=3 and estado_funcionario=1");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
$totalRowsn = mysql_num_rows($selectn);
if (0<$totalRowsn){
			do {
echo '<option value="'.$rown['id_funcionario'].'" ';

echo '>'.$rown['nombre_funcionario'].'</option>';
} while ($rown = mysql_fetch_assoc($selectn));

} else {
	echo '';
}
mysql_free_result($selectn);

?>
</select>
</div>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear </button></div></form>


</div>
				  </div>
				  </div>
				  
				      <div class="col-md-4">
		  <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Documentos</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
         <div class="box-body">
<?php
	
if ((isset($_POST["id_sub_tipo_adjunto"])) && ($_POST["id_sub_tipo_adjunto"] != "")) { 

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/documento_permiso/";


$ruta_archivo = 'permiso-'.$id.'-'.date("YmdGis");


	 
$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
$info = pathinfo($nombrefile); 
$extension=$info['extension'];
$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
  
  
$insertSQL = sprintf("INSERT INTO documento_permiso (id_funcionario, id_tipo_adjunto, id_sub_tipo_adjunto, id_permiso, nombre_documento_permiso, fecha_subida, estado_documento_permiso) 
VALUES (%s, %s, %s, %s, %s, now(), %s)", 
GetSQLValueString($id_notario, "int"),
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST['id_sub_tipo_adjunto'], "int"), 
GetSQLValueString($id, "int"),
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo '<script type="text/javascript">swal(" OK !", " Documento almacenado correctamente  !", "success");</script>';



  
  } else { 
  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

  }
} else { 
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';

		}
	
	



} else { }


?>
				
<form action="" method="POST" name="form34563451" enctype="multipart/form-data">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE DOCUMENTO:</label> 
<select  class="form-control" name="id_sub_tipo_adjunto" required>
<option value=""></option>
<?php 
$query = sprintf("SELECT id_sub_tipo_adjunto, nombre_sub_tipo_adjunto FROM sub_tipo_adjunto where id_tipo_adjunto=1 and estado_sub_tipo_adjunto=1 order by id_sub_tipo_adjunto"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_sub_tipo_adjunto'].'">'.$row['nombre_sub_tipo_adjunto'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO:</label> 
<input type="file" name="file" value="" required>
</div>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="dia_licencia">
<span class="glyphicon glyphicon-ok"></span> Subir </button></div></form>
<HR>
				
				<?php

$query_regh = "SELECT * FROM documento_permiso, sub_tipo_adjunto WHERE documento_permiso.id_sub_tipo_adjunto=sub_tipo_adjunto.id_sub_tipo_adjunto and documento_permiso.id_permiso =".$id." and documento_permiso.estado_documento_permiso=1";
$regh = mysql_query($query_regh, $conexion) or die(mysql_error());
$row_regh = mysql_fetch_assoc($regh);
$totalRows_regh = mysql_num_rows($regh);
if (0<$totalRows_regh) {
 do {

  echo '<a href="filesnr/documento_permiso/'.$row_regh['nombre_documento_permiso'].'" target="_blank">';
  echo '<img src="images/pdf.png"> <span title="'.$row_regh['fecha_subida'].'">'.$row_regh['nombre_sub_tipo_adjunto'].'</span>';
  echo '</a>';

   

if (1==$_SESSION['rol'] or 0<$nump6) {
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_permiso" id="'.$row_regh['id_documento_permiso'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else { }

echo '<br />';
 } while ($row_regh = mysql_fetch_assoc($regh));   
  
  } else { echo ''; }

 
 
 
 
$query_update = sprintf("SELECT * FROM permiso WHERE id_permiso = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	
 if (isset($row_update['numero_resolucion']) && isset($row_update['fecha_resolucion'])){
 
$res=$row_update['numero_resolucion'];
$fechares=$row_update['fecha_resolucion'];

$actualizar5 = mysql_query("SELECT * from documento_resolucion, resolucion where fecha_exp_resolucion='$fechares' and resolucion.resolucion=".$res." and documento_resolucion.id_resolucion=resolucion.id_resolucion and estado_documento_resolucion=1 and estado_resolucion=1", $conexion);
$row_sel15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {
echo '<a href="files/resoluciones/'.$row_sel15['nombre_documento_resolucion'].'" target="_blank"><img src="images/pdf.png"> ACTO ADMINISTRATIVO </a>';
		
 } while ($row_sel15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
	} else {
		


		
		
$actualizar5r = mysql_query("SELECT url_resolucion from resolucion where fecha_exp_resolucion='$fechares' and resolucion=".$res." and estado_resolucion=1", $conexion);
$row_sel15r = mysql_fetch_assoc($actualizar5r);
$total55r = mysql_num_rows($actualizar5r);
if (0<$total55r) {
 do {
echo '<a href="files/resoluciones/'.$row_sel15r['url_resolucion'].'" target="_blank"><img src="images/pdf.png"> ACTO ADMINISTRATIVO </a>';		
 } while ($row_sel15r = mysql_fetch_assoc($actualizar5r)); 
 mysql_free_result($actualizar5r);	
		
} else {}



		
		
		
	}
	
} else {}
} else {}
 ?>
 
 
</div>				
 </div>
				  </div>
				  
				  
		
	      <div class="col-md-3">
		  <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Acto administrativo</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
         <div class="box-body">
		 

	
<?php 
echo $nombre_notaria;
echo '<br>Categoria: '.$id_categoria_notaria;





if (1==$_SESSION['rol'] or (0<$nump6)){ 

if (0<$totalRows_update){

	?>
	
<form action="" method="POST" name="formerr1" >
<div class="form-group text-left"> 
<label  class="control-label"> Notario:</label> 

<select  type="text" class="form-control" name="id_funcionario_notario">
	<?php				  
$query9 = sprintf("SELECT * FROM posesion_notaria, funcionario, tipo_nombramiento_n where id_cargo=1 and posesion_notaria.id_funcionario=funcionario.id_funcionario and posesion_notaria.id_tipo_nombramiento_n=tipo_nombramiento_n.id_tipo_nombramiento_n and id_notaria=".$id_notaria." and estado_funcionario=1 and estado_posesion_notaria=1 order by fecha_inicio desc");
$select9 = mysql_query($query9, $conexion);
$row9 = mysql_fetch_assoc($select9);

do {
	
echo '<option value="'.$row9['id_funcionario'].'"';

if ($row9['id_funcionario']==$row_update['id_funcionario']) {
echo 'selected'; 
} else { echo '';}
echo '>'.$row9['nombre_funcionario'].'</option>';

} while ($row9 = mysql_fetch_assoc($select9));
mysql_free_result($select9);

 

?>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> Notaria actual:</label> 
<input type="text" class="form-control" value="<?php echo $nombre_notaria; ?>" readonly>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RESOLUCION:</label>   
<input type="text" class="form-control numero" name="numero_resolucion" required  value="<?php echo $row_update['numero_resolucion']; ?>">
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE RESOLUCIÓN:</label>   
<input type="date" required class="form-control" name="fecha_resolucion"  value="<?php echo $row_update['fecha_resolucion']; ?>">
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="permiso">
<span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div></form>
<?php
	 } else { }
	
mysql_free_result($update);



 } else { 
?>






<?php } ?>
	

             


			 
            </div>
       
          </div>
                  </div>

				  
				  
</div>
		






<div class="row">
<div class="col-md-12">
  <div class="box">
<?php
if (1==$_SESSION['rol'] or 0<$nump6) { 

$query = sprintf("SELECT * FROM dia_licencia, tipo_encargo where dia_licencia.id_tipo_encargo=tipo_encargo.id_tipo_encargo and id_permiso=".$id." and dia_licencia.confirmado=1 and estado_dia_licencia=1");
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
?>
<div class="box-header with-border">
<table class="table table-striped table-bordered table-hover" id="pqrsvigilados">
<thead>
<tr align='center' valign='middle'>
<th>Resolución</th>
<th>Fecha de resolución</th>
<th>Entrada</th>
<th>Dias de permiso / licencia</th>
<th>Tiempo</th>
<th>Tipo de encargo</th>
<th>Encargado</th>
<th></th>
</tr>
</thead><tbody>
<?php
do {
echo '<tr>';
echo '<td>'.$resolucion.'</td>';
echo '<td>'.$fecha_resolucion.'</td>';
echo '<td>'.$origen.'</td>';


echo '<td>';

$time = strtotime($row['fecha_permiso']); 
setlocale(LC_ALL,"es_ES@euro","es_ES","esp"); 
echo ucfirst(utf8_encode(strftime("%A %d de %B del %Y", $time)));

echo '</td>';
echo '<td>';
if (isset($row['hora_desde']))
{
echo ''.$row['hora_desde'].' - '.$row['hora_hasta'].'';
} else { }
echo '</td>';


echo '<td>'.$row['nombre_tipo_encargo'].'</td>';

echo '<td>';
echo quees('funcionario', $row['id_funcionario_encargo']);
echo '</td>';

echo '<td>';
if (1==$_SESSION['rol'] or 0<$nump6) {
	
	
echo ' <a href="permiso&'.$id.'&'.$row['id_dia_licencia'].'-5.jsp">Revocación</a> &nbsp; ';

echo ' <a href="permiso&'.$id.'&'.$row['id_dia_licencia'].'-6.jsp">Modificación</a>  &nbsp; ';
	
	
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="dia_licencia" id="'.$row['id_dia_licencia'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else { }
echo '</td>';

} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);
?>	
</tbody></table>
	  <script>
					      	$(document).ready(function() {
							  $('#pqrsvigilados').DataTable({
							    "language": {
							      "url": "/json/tablacastellano.json"
							    },
								"aaSorting": [[ 0, "asc"]]
							  });
							});
					    </script>				
					</div>
</div>
</div>
		</div>			
					



		

<?php
mysql_free_result($select);
} else {}

}
}
}
?>

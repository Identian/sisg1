<div class="row">
<div class="col-md-7">
	<div class="box box-info">


 <div class="box-header with-border">
 <center>
 <h3><b>Vencimiento de PQRSD en los próximos dias.</b></h3>
 
 Para ver terminos ampliados ó requeridos, ir a la propia PQRS.
 </center>
 
                

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">
<a href="xls/pqrs_area.xls">Descargar reporte completo.</a><br>
<a href="xls/requerimientos_notarias.xls">Descargar reporte de requerimientos.</a>
<hr>

<div class="input-group-btn">
<input type="text" id="search" name="buscar" placeholder="Buscar utilizando correo" class="form-control" required >
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>


<hr>
			<?php

		
		
$hostname_conexion2 = "192.168.80.12";
$database_conexion2 = "sisg";
$username_conexion2 = "sisg";
$password_conexion2 = "C0l0mb1@19*";

$conexion2 = mysql_pconnect($hostname_conexion2, $username_conexion2, $password_conexion2); 
mysql_select_db($database_conexion2, $conexion2);
		
$realdate= date("Y-m-d");
		
$cuarentacinco = date('Y-m-d', strtotime('-45 day', strtotime($realdate)));
	

$noventa = date('Y-m-d', strtotime('-90 day', strtotime($realdate)));
	
	/*				   
$query = "SELECT solicitud_pqrs.id_solicitud_pqrs, funcionario.id_cargo, funcionario.id_funcionario, correo_funcionario, radicado, fecha_radicado, terminos_dias 
 FROM solicitud_pqrs, asignacion_pqrs_funcionario, funcionario, clasificacion_pqrs, clase_oac 
WHERE  solicitud_pqrs.id_solicitud_pqrs=asignacion_pqrs_funcionario.id_solicitud_pqrs 
and asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario 
AND (funcionario.id_cargo=1 or funcionario.lider_pqrs=1) AND fecha_radicado>'$cuarentacinco' 
and clasificacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs
AND clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac
and estado_asignacion_pqrs_funcionario=1 
AND (solicitud_pqrs.id_estado_solicitud=2 OR solicitud_pqrs.id_estado_solicitud=4)
 and estado_solicitud_pqrs=1 AND estado_asignacion_pqrs_funcionario=1  
 AND estado_clasificacion_pqrs=1 AND estado_clase_oac=1
 order by solicitud_pqrs.id_solicitud_pqrs asc"; */



$query = "SELECT solicitud_pqrs.id_solicitud_pqrs, funcionario.id_cargo, funcionario.id_funcionario, 
correo_funcionario, radicado, fecha_radicado, terminos_ampliados  
 FROM solicitud_pqrs, asignacion_pqrs_funcionario, funcionario, clasificacion_pqrs, clase_oac 
WHERE  solicitud_pqrs.id_solicitud_pqrs=asignacion_pqrs_funcionario.id_solicitud_pqrs 
and asignacion_pqrs_funcionario.id_funcionario=funcionario.id_funcionario 
AND (funcionario.id_cargo=1 or funcionario.lider_pqrs=1) AND fecha_radicado>'$noventa' 
and clasificacion_pqrs.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs
AND clasificacion_pqrs.id_clase_oac=clase_oac.id_clase_oac
and estado_asignacion_pqrs_funcionario=1 
AND (solicitud_pqrs.id_estado_solicitud=2 OR solicitud_pqrs.id_estado_solicitud=4)
 and estado_solicitud_pqrs=1 AND estado_asignacion_pqrs_funcionario=1  
 AND estado_clasificacion_pqrs=1 AND estado_clase_oac=1
 order by solicitud_pqrs.id_solicitud_pqrs asc"; 
 


$selectnoti = mysql_query($query, $conexion2);
$rownoti = mysql_fetch_assoc($selectnoti);
$totalRows = mysql_num_rows($selectnoti);
if (0<$totalRows){



$menosundia = date('Y-m-d', strtotime('+1 day', strtotime($realdate)));
	
$menosdosdia = date('Y-m-d', strtotime('+2 day', strtotime($realdate)));

$menostres = date('Y-m-d', strtotime('+3 day', strtotime($realdate)));


$array1nn = array();

echo '<table id="mytable">';


do {
	
$idsol=$rownoti['id_solicitud_pqrs'];
$idfun=$rownoti['id_funcionario'];
$correofun=$rownoti['correo_funcionario'];
$radipqrs=$rownoti['radicado'];
$idcargo=$rownoti['id_cargo'];

//$fechavence=fechahabil($rownoti['fecha_radicado'],$rownoti['terminos_dias']);
$fechavence=fechahabil($rownoti['fecha_radicado'],$rownoti['terminos_ampliados']);

if ($realdate>$fechavence) {

	

	
} else if ($realdate==$fechavence) {
echo '<tr><td>';

echo '<a href="usuario&'.$idfun.'.jsp"><i class="fa fa-user"></i></a> ';
echo '<a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$rownoti['id_solicitud_pqrs'].'.jsp">  Hoy vence PQRS '.$rownoti['radicado'].'</a> / '.$correofun.'';
if (1==$idcargo) { echo ' - Jefe '; 
array_push($array1nn, 1);
} else { }
echo '</td></tr>';
	
	
} else if ($menosundia==$fechavence) {
echo '<tr><td>';
echo '<a href="usuario&'.$idfun.'.jsp"><i class="fa fa-user"></i></a> ';
echo '<a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$rownoti['id_solicitud_pqrs'].'.jsp">  Mañana vence PQRS '.$rownoti['radicado'].'</a> / '.$correofun.'';
if (1==$idcargo) { echo ' - Jefe ';
array_push($array1nn, 1);
 } else { }
echo '</td></tr>';

	} 
	
else if ($menosdosdia==$fechavence) {
echo '<tr><td>';
echo '<a href="usuario&'.$idfun.'.jsp"><i class="fa fa-user"></i></a> ';
echo '<a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$rownoti['id_solicitud_pqrs'].'.jsp">  En dos dias vence PQRS '.$rownoti['radicado'].'</a> / '.$correofun.'';
if (1==$idcargo) { echo ' - Jefe '; 
array_push($array1nn, 1);
} else { }
echo '</td></tr>';



	} else if ($menostres==$fechavence) {

//array_push($array1nn, 1);

$selectyyc = mysql_query("select count(id_mensaje_correo) as tmens from mensaje_correo where id_solicitud_pqrs=".$idsol." and id_funcionario=".$idfun." and estado_mensaje_correo=1", $conexion);
$rowyyc = mysql_fetch_assoc($selectyyc);
if (0<$rowyyc['tmens']) {
	echo '';
} else { 
	
	echo '<tr><td>';
	echo '<a href="usuario&'.$idfun.'.jsp"><i class="fa fa-user"></i></a> ';
echo '<a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$rownoti['id_solicitud_pqrs'].'.jsp">  En tres dias vence PQRS '.$radipqrs.'</a>';
echo '- '.$correofun;
if (1==$idcargo) { echo ' - Jefe '; } else { }
echo '</td></tr>';
	
	
$insertSQL33 = sprintf("INSERT INTO mensaje_correo (nombre_mensaje_correo, radicado_pqrs, id_solicitud_pqrs, id_funcionario, fecha_mensaje, estado_mensaje_correo) VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString($correofun, "text"), 
GetSQLValueString($radipqrs, "text"), 
GetSQLValueString($idsol, "int"), 
GetSQLValueString($idfun, "int"), 
GetSQLValueString(1, "int"));
$Result33 = mysql_query($insertSQL33, $conexion) or die(mysql_error());

//$emailu='giovanni.ortegon@supernotariado.gov.co';

$subject = 'Notificación automática - PQRSD '.$radipqrs.'';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'> &nbsp; Cordial saludo.<br><br> &nbsp; Vicky informa que en tres días se vence una PQRSD que tiene a su cargo (".$radipqrs.").<br> &nbsp; Por favor ir al siguiente enlace:"; 
$cuerpo .= "<br><br>"; 
$cuerpo .='<center><a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$idsol.'.jsp"><button type="button" style="cursor: pointer;background:#B40404;color:#ffffff;height:30px;width:300px;text-align:center;border-radius: 10px;cursor:pointer; cursor: hand;"> Acceder a SISG </button><br> https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$idsol.'.jsp </a></center>';
$cuerpo .= "<br><br> &nbsp; Sistema Integrado de Servicios y Gestión.<br><br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($correofun,$subject,$cuerpo,$cabeceras);
	
}





	} else {
	
echo '';	
}
	

	

	
	
	
  } while ($rownoti = mysql_fetch_assoc($selectnoti)); 
  
  echo '</table>';
  
$tramitenotificacion=array_sum($array1nn);



} else {
	

}	 
mysql_free_result($selectnoti);


?>

</DIV>
</DIV>

</DIV>





<div class="col-md-5">
	<div class="box box-info">


 <div class="box-header with-border">
 <h3><center><b>Resumen</b></center></h3>
                

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">
			
			<?php echo 'En menos de 3 dias se vencen '.$tramitenotificacion.' PQRSD <br><hr>'; ?>
			
			
			Notificaciones enviadas: <?php  echo existencia('mensaje_correo'); ?>
			<br>
			<a href="xls/notificaciones_pqrs.xls">Descargar reporte completo de envios.</a>

			<hr>
			Notificaciones enviadas por correo hoy que se vencen en 3 dias:
			<?php
$query = "select * from mensaje_correo where CAST(fecha_mensaje AS date) = CAST('$realdate' AS date) and estado_mensaje_correo=1"; 

$selectnoti = mysql_query($query, $conexion);
$rownoti = mysql_fetch_assoc($selectnoti);
$totalRows = mysql_num_rows($selectnoti);
echo $totalRows.'<br><br>';

if (0<$totalRows){

echo '<ol>';
do {
echo '<li>';
echo '<a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&'.$rownoti['id_solicitud_pqrs'].'.jsp">'.$rownoti['radicado_pqrs'].'</a>';
echo ' / ';
echo $rownoti['nombre_mensaje_correo'];
echo '</li>';
  } while ($rownoti = mysql_fetch_assoc($selectnoti)); 
  echo '</ol>';
} else {  }	 
mysql_free_result($selectnoti);



			
			
			?>
			</DIV>
</DIV>

</DIV>




</DIV>


<script>
 // Write on keyup event of keyword input element
 $(document).ready(function(){
 $("#search").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#mytable tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });
});
</script>


<?php	
$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);

$fecha_inicio = strtotime("2023-03-27 07:58:00");
$fecha_limite = strtotime("2023-03-27 17:00:00");


	if($fecha_actual > $fecha_inicio) {
	//echo '.';
	if($fecha_actual < $fecha_limite) {
	//echo '.';
	$vali=1;
	} else {
	echo 'La votación esta inactiva. ';
	$vali=0;
	}
	
	} else {
	echo 'La votación no ha iniciado. ';
	$vali=0;
	}


if (1==$_SESSION['rol'] && isset($_GET['i'])) {
$valor=$_GET['i'];
} else {		
$valor=$_SESSION['snr'];
}
$selectu = mysql_query("SELECT id_funcionario, nombre_funcionario, correo_funcionario from funcionario where id_vinculacion in (1, 2, 3, 4, 7) and funcionario.id_tipo_oficina<3 and id_funcionario=".$valor." limit 1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$idf=$rowu['id_funcionario'];
$correof=$rowu['correo_funcionario'];
$funcionario=$rowu['nombre_funcionario'];
mysql_free_result($selectu);

if (0<$vali) {
if	(0<$idf) {
?>

<style>
.col-xs-6 {
	background:#fff;
	border:5px solid#ECF0F5;
	border-radius:5px;
	min-height:510px;
}
</style>


<div class="row">
<div class="col-md-12">

 <div class="row">
 
  <?php
  
if ((isset($_POST["vot"])) && ($_POST["vot"] != "")) { 
  
$selectu = mysql_query("select count(id_votacion_convivencia23) as totale from votacion_convivencia23 where id_funcionario=".$idf." and estado_votacion_convivencia23=1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$numvotauw=intval($rowu['totale']);
if (0<$numvotauw) { echo '<script>alert("Ya habia emitido el voto");</script>'; } else {
  
$realdatecompleto=date('Y-m-d H:i:s');

$varvot=$_SESSION['snr'].'-'.$_POST["vot"].'-'.$realdatecompleto.'';
$valorhash= md5($varvot);
$insertSQL = sprintf("INSERT INTO votacion_convivencia23 
(nombre_votacion_convivencia23, id_candidato_votacion_convivencia23, id_funcionario, fecha_votacion_convivencia23, estado_votacion_convivencia23) 
VALUES (%s, %s, %s, %s, %s)", 
GetSQLValueString($valorhash, "text"),
 GetSQLValueString($_POST["vot"], "int"), 
 GetSQLValueString($idf, "int"), 
  GetSQLValueString($realdatecompleto, "date"), 
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;


$votf=intval($_POST["vot"]);
$prin=$_POST["prin"];
$suple=$_POST["suple"];




$emailur2=$_SESSION['snr_correo'];
$subject = 'CONFIRMACIÓN VOTO EXITOSO';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado correctamente el voto a la comision de convivencia laborar 2023.<br><br>';
$cuerpo2 .= 'Fecha y hora de votación: '.$realdatecompleto.'<br>';
$cuerpo2 .= 'Para efecto de auditoria del sistema, su código hash de votación fue el siguiente: '.$valorhash.'<br>';
$cuerpo2 .= "<br><br>"; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);



}

} else { }
  
  

  
  

  
$query = "SELECT * FROM candidato_votacion_convivencia23, funcionario WHERE candidato_votacion_convivencia23.id_funcionario=funcionario.id_funcionario and estado_candidato_votacion_convivencia23=1 ";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){

do {

$idv=$row['id_candidato_votacion_convivencia23'];
$fun1=$row['id_funcionario'];
$foto=$row['foto_funcionario'];
$name=$row['nombre_funcionario'];
?>
<div class="col-xs-4 col-lg-4" style="background:#fff;border:solid #f2f2f2;padding: 0px 0px 10px 0px;border-radius: 20px;">
              <center><h2>PLANCHA <?php echo $idv; ?></h2></center>
 <div class="row">
<div class="col-md-12">
		<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
<?php echo '<center><img src="files/'.$foto.'" style="width:100px;height:120px;"></center>
<br>'.$name.''; ?>        
			  <br>
              <b>Candidato</b>
            </div>
            <div class="box-footer no-padding">
              
            </div>
			
		<?php		
$selectu = mysql_query("select count(id_votacion_convivencia23) as totale from votacion_convivencia23 where id_funcionario=".$idf." and estado_votacion_convivencia23=1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$numvotau=intval($rowu['totale']);
mysql_free_result($selectu);
if (0<$numvotau) { echo 'Votación hecha'; } else {
?>
<form action="" method="POST" name="form54565461">
<input type="hidden" name="prin" value="<?php echo $name; ?>">
<input type="hidden" name="vot" value="<?php echo $idv; ?>">
<button type="submit" id="<?php echo $idv; ?>" class="btn btn-success confirmavotacion" style="width:100%" >
<span class="glyphicon glyphicon-ok"></span> Votar</button>
</Form>
<?php } ?>		
			
			
          </div>
		  
	</div>

          </div>	
              <!--<p><a class="btn btn-success" style="width:100%" href="" role="button">Votar</a></p>-->


</div>
     

<?php
			 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

			?>
			
			
			
			  <div class="col-xs-4 col-lg-4" style="background:#fff;border:solid #f2f2f2;padding: 0px 0px 10px 0px;">
              <h2>Voto en blanco</h2>
            


			  <div class="row">
<div class="col-md-12">

			    <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
           
             
				<center><img src="files/avatar.png" style="width:100px;"></center>
				<br>Voto en blanco            
			  <br>-------------
        
            </div>
            <div class="box-footer no-padding">
  
            </div>
			
				<?php if (0<$numvotau) { echo 'Votación hecha'; } else { ?>
	<form action="" method="POST" name="form54435565461">
<input type="hidden" name="prin" value="Voto en blanco">
<input type="hidden" name="suple" value="Voto en blanco">
<input type="hidden" name="vot" value="0">
<button type="submit" id="Voto blanco" class="btn btn-success confirmavotacion" style="width:100%" >
<span class="glyphicon glyphicon-ok"></span> Votar</button>
</Form>
	<?php } ?>
	
          </div>
		  
	</div>

          </div>	
              <!--<p><a class="btn btn-success" style="width:100%" href="" role="button">Votar</a></p>-->


			  
            </div><!--/.col-xs-6.col-lg-4-->
     

		  
		  </div>
		   </div>
		    </div>

<?php 

} else { echo 'No tiene acceso, solo para funcionarios de carrera administrativa y provisionalidad.'; }

} else { echo ''; }


 ?>
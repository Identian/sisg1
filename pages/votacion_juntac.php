<?php	
if (3>$_SESSION['snr_tipo_oficina'] && (5!=$_SESSION['snr_grupo_cargo'] or 3!=$_SESSION['snr_grupo_cargo'])) {
	
$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);

//echo $realdatecompleto.'<br>';
$fecha_inicio = strtotime("2022-08-08 08:00:00");
$fecha_limite = strtotime("2022-08-08 17:00:00");

//echo $fecha_inicio.'<br>'.$fecha_actual.'<br>'.$fecha_limite.'<br>';

	if($fecha_actual >= $fecha_inicio) {
	//echo '.';
	if($fecha_actual <= $fecha_limite) {
	//echo '.';
	$vali=1;
	} else {
	echo 'La votación esta inactiva';
	$vali=0;
	}
	
	} else {
	echo 'La votación no ha iniciado';
	$vali=0;
	}


		
$valor=$_SESSION['snr'];

$selectu = mysql_query("SELECT id_funcionario, nombre_funcionario, correo_funcionario from funcionario where id_tipo_oficina<3 and id_cargo!=5 and id_funcionario=".$valor." limit 1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$idf=$rowu['id_funcionario'];
$correof=$rowu['correo_funcionario'];
$funcionario=$rowu['nombre_funcionario'];
mysql_free_result($selectu);

if (0<$vali and 0<$idf) {
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
  
$selectu = mysql_query("select count(id_votacion_juntac) as totale from votacion_juntac where id_funcionario=".$idf." and estado_votacion_juntac=1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$numvotauw=intval($rowu['totale']);
if (0<$numvotauw) { echo '<script>alert("Ya habia emitido el voto");</script>'; } else {
  
$realdatecompleto=date('Y-m-d H:i:s');

$varvot=$_SESSION['snr'].'-'.$_POST["vot"].'-'.$realdatecompleto.'';
$valorhash= md5($varvot);
$insertSQL = sprintf("INSERT INTO votacion_juntac 
(nombre_votacion_juntac, id_candidato_votacion_juntac, id_funcionario, fecha_votacion_juntac, estado_votacion_juntac) 
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
$cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado correctamente el voto a la junta de credito de vivienda.<br><br>';
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
  
  

  
  

  
$query = "SELECT * FROM candidato_votacion_juntac, funcionario WHERE candidato_votacion_juntac.id_funcionario=funcionario.id_funcionario and estado_candidato_votacion_juntac=1 ";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){

do {

$idv=$row['id_candidato_votacion_juntac'];
$fun1=$row['id_funcionario'];
$foto=$row['foto_funcionario'];
$name=$row['nombre_funcionario'];
?>
            <div class="col-xs-4 col-lg-4" style="border-radius:20px;background:#fff;border:solid #f2f2f2;padding: 20px 20px 20px 20px;height:450px;">
              <h2><CENtER>CANDIDATO <?php echo $idv; ?></center></h2>
 <div class="row">
<div class="col-md-12">
		<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header ">
<?php echo '<center><img src="files/'.$foto.'" style="width:100px;height:130px;"></center>
<br>'.$name.''; ?>        
			  <br>
              
            </div>
            <div class="box-footer no-padding">
              
            </div>
			
		<?php		
$selectu = mysql_query("select count(id_votacion_juntac) as totale from votacion_juntac where id_funcionario=".$idf." and estado_votacion_juntac=1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$numvotau=intval($rowu['totale']);
mysql_free_result($selectu);
if (0<$numvotau) { echo '<center><b>Votación hecha</b></center>'; } else {
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
			
			
			
			  <div class="col-xs-4 col-lg-4" style="border-radius:20px;background:#fff;border:solid #f2f2f2;padding: 20px 20px 10px 0px;height:450px;">
              <h2>Voto en blanco</h2>
            


			  <div class="row">
<div class="col-md-12">

			    <div class="box box-widget widget-user-2" >
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" style="border-radius:10px;">
           
             
				<center><img src="files/avatar.png" style="width:100px;height:130px;"></center>
				<br>Voto en blanco            
			  
        
            </div>
            <div class="box-footer no-padding">
  
            </div>
			
				<?php if (0<$numvotau) { echo '<center><b>Votación hecha</b></center>'; } else { ?>
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

<?php } else { echo '<br>Solo para funcionarios de la SNR.'; }

	} else { echo '<br>Solo para funcionarios de la SNR.'; }
 ?>
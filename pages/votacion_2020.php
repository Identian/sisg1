<?php	
$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
//echo $realdatecompleto.' - ';
$fecha_limite = strtotime("2020-09-22 17:00:00");

/*if($fecha_actual > $fecha_limite)
	{
	echo 'Votación cerrada a las 17:00:00';
	} else {*/ 
	

	
	
if (1==$_SESSION['rol'] && isset($_GET['i'])) {
$valor=$_GET['i'];
} else {		
$valor=0;//$_SESSION['snr'];
}
$selectu = mysql_query("select notaria.id_notaria, nombre_notaria, funcionario.id_funcionario, nombre_funcionario from notario_propiedad, notaria, funcionario where
notario_propiedad.id_notaria=notaria.id_notaria  and  notario_propiedad.id_funcionario=funcionario.id_funcionario AND 
 notario_propiedad.id_funcionario=".$valor." and estado_notario_propiedad=1 limit 1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$idn=$rowu['id_notaria'];
$idfun=$rowu['id_funcionario'];
$notarian=$rowu['nombre_notaria'];
$funcionario=$rowu['nombre_funcionario'];
mysql_free_result($selectu);

if (0<$idn) {
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
  
$realdatecompleto=date('Y-m-d H:i:s');

$varvot=$_SESSION['snr'].'-'.$_POST["vot"].'-'.$realdatecompleto.'';
$valorhash= md5($varvot);
$insertSQL = sprintf("INSERT INTO votacion (nombre_votacion, id_candidato_votacion, id_funcionario, id_notaria, fecha_votacion, estado_votacion) VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($valorhash, "text"),
 GetSQLValueString($_POST["vot"], "int"), 
 GetSQLValueString($idfun, "int"), 
  GetSQLValueString($idn, "int"), 
  GetSQLValueString($realdatecompleto, "date"), 
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;


$votf=intval($_POST["vot"]);
$prin=$_POST["prin"];
$suple=$_POST["suple"];


$emailur='votonotarial@supernotariado.gov.co';
$subject = 'Registro exitoso de voto';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= 'La Superintendencia de Notariado y Registro informa que se ha registrado correctamente voto a las Elecciones de Representantes de Notarios ante el CSCN 2020.<br><br>';
$cuerpo .= 'Notaria: '.$notarian.'<br>';
$cuerpo .= 'Voto para: PLANCHA No. '.$votf.'<br>';
$cuerpo .= 'Candidato Principal: '.$prin.'<br>';
$cuerpo .= 'Candidato Suplente: '.$suple.'<br>';

$cuerpo .= 'Fecha y hora de votación: '.$realdatecompleto.'<br>';
$cuerpo .= 'Para efecto de auditoria del sistema, su código hash de votación fue el siguiente: '.$valorhash.'<br>';

$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur,$subject,$cuerpo,$cabeceras);


$emailur2=$_SESSION['snr_correo'];

$subject = 'CONFIRMACIÓN VOTO EXITOSO';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado correctamente su voto a las Elecciones de Representantes de Notarios ante el CSCN 2020.<br><br>';
$cuerpo2 .= 'Notaria: '.$notarian.'<br>';
$cuerpo2 .= 'Fecha y hora de votación: '.$realdatecompleto.'<br>';
$cuerpo2 .= '*Recuerde que puede votar una única vez y por una sola fórmula de candidato (Principal y Suplente).<br>';
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





} else { }
  
  
function vota($fun) {
global $mysqli;
$query = "SELECT * FROM funcionario where id_funcionario=".$fun." and estado_funcionario=1 limit 1 ";
$result4m = $mysqli->query($query);
$row4m = $result4m->fetch_array(MYSQLI_ASSOC);
//$resm=$row4m['nombre_funcionario'];
 $resm='<center><img src="files/'.$row4m['foto_funcionario'].'" style="width:100px;"></center>
				<br>'.$row4m['nombre_funcionario'].'';

				
return $resm;
$result4m->free();
}
  
  
function votan($not) {
global $mysqli;
$queryn = "SELECT * FROM notaria where id_notaria=".$not." and estado_notaria=1 limit 1 ";
$result4mn = $mysqli->query($queryn);
$row4mn = $result4mn->fetch_array(MYSQLI_ASSOC);
//$resmn=$row4mn['nombre_notaria'];
$resmn=' <li><a>Notaria: '.$row4mn['nombre_notaria'].'<span class="pull-right badge bg-blue"></span></a></li>
                <li><a style="font-size:9px;">'.$row4mn['email_notaria'].'<span class="pull-right badge bg-aqua"></span></a></li>
                <li><a>Notaria de '.$row4mn['id_categoria_notaria'].' categoria<span class="pull-right badge bg-green"></span></a></li>';	 
return $resmn;
$result4mn->free();
}

  
  
$query = "SELECT * FROM candidato_votacion WHERE estado_candidato_votacion=1 ";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){

do {

$idv=$row['id_candidato_votacion'];
$fun1=vota($row['id_funcionario1']);
$fun2=vota($row['id_funcionario2']);
$namenotaria1=votan($row['id_notaria1']);
$namenotaria2=votan($row['id_notaria2']);


?>
            <div class="col-xs-6 col-lg-6">
              <h2>PLANCHA <?php echo $idv; ?></h2>
            


			  <div class="row">
<div class="col-md-6">

			    <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
           
             
				<?php echo $fun1; ?>
            
			  <br>
              <b>Principal</b>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
			 
    <?php echo  $namenotaria1; ?>
            </ul>
            </div>
          </div>
		  
	</div>
<div class="col-md-6">
		   <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
            
	<?php echo $fun2; ?>
	<br>
              <b>Suplente</b>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
			  
   <?php echo  $namenotaria2; ?>           
		   </ul>
            </div>
          </div>
			  
		 </div>
          </div>	
              <!--<p><a class="btn btn-success" style="width:100%" href="" role="button">Votar</a></p>-->
	<?php		
$selectu = mysql_query("select count(id_votacion) as totale from votacion where id_funcionario=".$idfun." and estado_votacion=1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$numvotau=intval($rowu['totale']);
mysql_free_result($selectu);
if (0<$numvotau) { } else {
?>
<form action="" method="POST" name="form54565461">
<input type="hidden" name="prin" value="<?php echo quees('funcionario', $row['id_funcionario1']); ?>">
<input type="hidden" name="suple" value="<?php echo quees('funcionario', $row['id_funcionario2']); ?>">
<input type="hidden" name="vot" value="<?php echo $idv; ?>">
<button type="submit" id="<?php echo $idv; ?>" class="btn btn-success confirmavotacion" style="width:100%" >
<span class="glyphicon glyphicon-ok"></span> Votar</button>
</Form>
<?php } ?>

			  
            </div><!--/.col-xs-6.col-lg-4-->
     
			
			
			
			<?php
			 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

			?>
			

		  
		  </div>
		   </div>
		    </div>

<?php } else { echo 'No tiene acceso'; }

	//}
 ?>
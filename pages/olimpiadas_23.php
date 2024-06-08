<?php
$nump111=privilegios(111,$_SESSION['snr']);

$todaolimpiada23=existencia('olimpiada23'); 

$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-05-24 08:00:00");
$fecha_limite = strtotime("2023-05-24 12:00:00");

if (837>$todaolimpiada23) {
//if (1==$_SESSION['rol'] && 831>$todaolimpiada23) { 



if (isset($_GET['i'])) { 
$idorip=$_GET['i'];
 } else {
$idorip=0;  
 } 
 
 

if (3>$_SESSION['snr_tipo_oficina']) { 


function disciplina($disciplina) {
global $mysqli;
$query4png = sprintf("SELECT count(id_olimpiada23) as contador FROM olimpiada23 where nombre_olimpiada23='$disciplina' and estado_olimpiada23=1"); 
$result4png = $mysqli->query($query4png);
$row4png = $result4png->fetch_array();
$respng=$row4png['contador'];
return $respng;
$result4png->free();
}




if (((isset($_POST["nombre_olimpiada23"])) && (""!=$_POST["nombre_olimpiada23"]) && 
(3>$_SESSION['snr_tipo_oficina'])) && ($fecha_limite>=$fecha_actual)) {
	
	

$funcionarioedl=$_SESSION['snr']; //$_POST["id_funcionario"];

	
	
	
	
$queryt = sprintf("SELECT count(id_funcionario) as tfuncionario FROM funcionario where id_tipo_oficina<3 and id_cargo in (1, 2, 4) and estado_funcionario=1 and id_funcionario=".$funcionarioedl.""); 
$selectt = mysql_query($queryt, $conexion);
$rowtt = mysql_fetch_assoc($selectt);
if (0<$rowtt['tfuncionario']) {

	
	
	
	$query = sprintf("SELECT count(id_olimpiada23) as tolimpiada23 FROM olimpiada23 where estado_olimpiada23=1 and id_funcionario=".$funcionarioedl.""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tolimpiada23']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene inscripción activa.</div>';
	
} else {



$reglag2=disciplina($_POST["nombre_olimpiada23"]);

$nombre_olimpiada23=$_POST["nombre_olimpiada23"];

if ('Futbol 5 Masculino'==$_POST["nombre_olimpiada23"] &&  96>$reglag2) {
$varc=1; $grupal=1; $cantidad=8; $contratistas=3; $equipos=12; } 
else if ('Futbol 5 Femenino'==$_POST["nombre_olimpiada23"] && 32>$reglag2) { 
$varc=1; $grupal=1; $cantidad=8; $contratistas=3; $equipos=4;}
/*
else if ('Baloncesto Femenino'==$_POST["nombre_olimpiada23"] && 96>$reglag2) { 
$varc=1; $grupal=1; $cantidad=8; $contratistas=3;  $equipos=12;}
else if ('Baloncesto Masculino'==$_POST["nombre_olimpiada23"] && 96>$reglag2) { 
$varc=1; $grupal=1; $cantidad=8; $contratistas=3;  $equipos=12; }
*/
else if ('Baloncesto mixto'==$_POST["nombre_olimpiada23"] && 32>$reglag2) { 
$varc=1; $grupal=1; $cantidad=8; $contratistas=3;  $equipos=4;}
else if ('Voleibol Mixto'==$_POST["nombre_olimpiada23"] && 80>$reglag2) { 
$varc=1; $grupal=1; $cantidad=10; $contratistas=4;  $equipos=8;}
else if ('Bolirana Mixto'==$_POST["nombre_olimpiada23"] && 132>$reglag2) { 
$varc=1; $grupal=1; $cantidad=6; $contratistas=3;  $equipos=22;}
else if ('Bolos Mixto'==$_POST["nombre_olimpiada23"] && 192>$reglag2) { 
$varc=1; $grupal=1; $cantidad=6; $contratistas=3;  $equipos=32;}
else if ('Mini tejo Mixto'==$_POST["nombre_olimpiada23"] && 132>$reglag2) { 
$varc=1; $grupal=1; $cantidad=6; $contratistas=3;  $equipos=22; }
else if ('Atletismo femenino (5 Km)'==$_POST["nombre_olimpiada23"] && 13>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3; $equipos=13;}
else if ('Atletismo masculino (10 Km)'==$_POST["nombre_olimpiada23"] && 13>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3; $equipos=13;}
else if ('Tenis de Mesa masculino'==$_POST["nombre_olimpiada23"] && 12>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3;  $equipos=10;}
else if ('Tenis de Mesa femenino'==$_POST["nombre_olimpiada23"] && 12>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3;  $equipos=10;}
else if ('Tenis de campo masculino'==$_POST["nombre_olimpiada23"] && 9>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3; $equipos=10;}
else if ('Tenis de campo femenino'==$_POST["nombre_olimpiada23"] && 9>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3;  $equipos=10;}
else if ('Billar pool masculino'==$_POST["nombre_olimpiada23"] && 8>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3; $equipos=10;}
else if ('Billar pool femenino'==$_POST["nombre_olimpiada23"] && 8>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3; $equipos=10;}
else if ('Billar libre masculino'==$_POST["nombre_olimpiada23"] && 8>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3; $equipos=10;}
else if ('Billar libre femenino'==$_POST["nombre_olimpiada23"] && 8>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3;  $equipos=10;}
else if ('Natación Masculino (pecho, espalda y libre)'==$_POST["nombre_olimpiada23"] && 8>$reglag2) { 
$varc=1; $grupal=0; $cantidad=10; $contratistas=3;  $equipos=10;}
else if ('Natación Femenino (pecho, espalda y libre)'==$_POST["nombre_olimpiada23"] && 8>$reglag2) { 
$varc=1; $grupal=0; $cantidad=10;  $contratistas=3; $equipos=10; }
else if ('Ajedrez'==$_POST["nombre_olimpiada23"] && 15>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=6;  $equipos=16 ;}
else if ('Duatlon'==$_POST["nombre_olimpiada23"] && 10>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3;  $equipos=10;}
/*
else if ('Patinaje masculino'==$_POST["nombre_olimpiada23"] && 10>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3;  $equipos=10;}
else if ('Patinaje femenino'==$_POST["nombre_olimpiada23"] && 10>$reglag2) { 
$varc=1; $grupal=0; $cantidad=99; $contratistas=3;  $equipos=10; }
*/
else { $varc=0; $grupal=0; $cantidad=0; $contratistas=0;  $equipos=0; } 






if (1==1){
//if (1==$varc) {	

	
	



$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/olimpiada/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'olimpiada23-'.$_SESSION['snr'].''.date("YmdGis");

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
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
  
 
 
	  if ('0'==$_POST["equipo2"]) {
	$equipo=$_POST["equipo"];
	$code=$identi;
	  $men= '<script type="text/javascript">swal(" OK ", "Registrado Correctamente. CODIGO DE EQUIPO: '.$code.'  ", "success");</script>';
$corre='<br>Recuerde comparirt el codigo unico de equipo a sus compañeros: '.$code;
  $permi=1;
  } else {
	$equipo=$_POST["equipo2"];
	$code=$_POST["code"];
	  $men= '<script type="text/javascript">swal(" OK !", " Registrado Correctamente  !", "success");</script>';
$corre='';

$query = sprintf("SELECT count(id_olimpiada23) as toli FROM olimpiada23 where estado_olimpiada23=1 and equipo='$equipo' and code='$code' and nombre_olimpiada23='$nombre_olimpiada23'"); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
$cante=$rowt['toli'];
if (0<$cante) {
$permi=1;
  } else {
$permi=0;  
  }
  
mysql_free_result($select);
  
  }

if (1==$permi or 0==$grupal) {
	


// EQUIPOS
$queryc = sprintf("SELECT count(DISTINCT(equipo)) as tola FROM olimpiada23 where estado_olimpiada23=1 AND nombre_olimpiada23='$nombre_olimpiada23' "); 
$selectc = mysql_query($queryc, $conexion);
$rowtc = mysql_fetch_assoc($selectc);
$con=$rowtc['tola'];

if (($equipos>$con AND 0!=$_POST['equipo2']) OR 1==$permi)  {



if ($cante<$cantidad) {

if (5==$_SESSION['snr_grupo_cargo']) {
	$contra=1;
} else {
	$contra=0;
}

$insertSQL = sprintf("INSERT INTO olimpiada23 (
nombre_olimpiada23, id_funcionario, equipo, pantalon, camiseta, chaqueta, 
ciudadr, eps, arl, cemergencia, celuemergencia, alimentos, alergia, medicamento, contratista, 
fecha_olimpiada23, url, code, estado_olimpiada23) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s,  %s, %s, %s, %s, %s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($_POST["nombre_olimpiada23"], "text"), 
GetSQLValueString($funcionarioedl, "int"),
GetSQLValueString($equipo, "text"),
GetSQLValueString($_POST["pantalon"], "text"),
GetSQLValueString($_POST["camiseta"], "text"),
GetSQLValueString($_POST["chaqueta"], "text"),
GetSQLValueString($_POST["ciudadr"], "text"),
GetSQLValueString($_POST["eps"], "text"),
GetSQLValueString($_POST["arl"], "text"),
GetSQLValueString($_POST["cemergencia"], "text"),
GetSQLValueString($_POST["celuemergencia"], "text"),
GetSQLValueString($_POST["alimentos"], "text"),
GetSQLValueString($_POST["alergia"], "text"),
GetSQLValueString($_POST["medicamento"], "text"),
GetSQLValueString($contra, "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString($code, "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

echo $men;


  $updateSQL = sprintf("UPDATE funcionario SET rh=%s, celular_funcionario=%s, id_estado_civil=%s, fecha_nacimiento=%s  WHERE id_funcionario=%s and estado_funcionario=1",
                        GetSQLValueString($_POST["rh"], "text"),
					   GetSQLValueString($_POST["celular_funcionario"], "text"),
					   GetSQLValueString($_POST["id_estado_civil"], "text"),
					     GetSQLValueString($_POST["fecha_nacimiento"], "date"),
					    GetSQLValueString($funcionarioedl, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);

$emailur2=$_SESSION['snr_correo'];
$subject = 'CONFIRMACIÓN DE INSCRIPCIÓN A JUEGOS 2023';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que se ha registrado correctamente la inscripción a los Juegos Deportivos Nacionales SNR 2023.<br><br>';

$cuerpo2 .= $corre."<br><br>"; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);


} else { echo '<script type="text/javascript">swal(" Error !", " El equipo ya esta completo.  !", "error");</script>'; }


//contratistas

} else {
echo '<script type="text/javascript">swal(" Error !", " El juego ya tiene el número de equipos permitidos.  !", "error");</script>';
}
mysql_free_result($selectc);




} else { echo '<script type="text/javascript">swal(" Error !", " El codigo no es correcto con el nombre del equipo.  !", "error");</script>'; }


  
   
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
  
	
} else {
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, No existen cupos para esta disciplina..</div>';	
}

}

} else {
echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, Solo esta disponible para funcionarios de de carrera ó provisionales. Si identifica inconsistencias, reportarlo a sandram.gomez@supernotariado.gov.co para actualizar el perfil.</div>';	
} 




}
 else { }

 
 


?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php   echo $todaolimpiada23;  ?></h3>

              <p>Registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
	
            <a href="#" data-toggle="modal" data-target="#popupequipos" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>24</h3>

              <p>Disciplinas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" data-toggle="modal" data-target="#popupactualizarolimpiada232" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>20<?php echo $anoactual; ?></h3>
			  
              <p>Año</p>
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
              <h3>195</h3>
              <p>Oficinas de registro</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	<?php
	if (837<=$todaolimpiada23) { echo 'Cupos completados'; } else {
	?>

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">
 
  
  <p>
<b> Formulario de inscripción a  Juegos Deportivos Nacionales SNR 2023:</b>
La Superintendencia de Notariado y Registro, continúa trabajando en el compromiso de mejorar la calidad de vida de sus funcionarios. Para esto, ha establecido el deporte como un proceso permanente, orientado a crear, mantener y mejorar acciones que favorezcan el desarrollo integral de los servidores públicos de la SNR, enfocado en salud, vivienda, recreación, deporte, cultura y educación para la vida como ejes fundamentales para el incremento del salario emocional y sentido de pertenencia. 
<!--
<br>
 <a href="#" target="_blank">Ver Terminos y condiciones completo.</a>
 <br>
<b>Objetivos: </b>
Promover la integración y el sentido de pertenencia de los servidores de la SNR mediante la práctica del deporte y juegos tradicionales
 <br>
Motivar la práctica del deporte y la actividad física en los servidores de la entidad, como estrategia para el cuidado de la salud integral.  
 <br>
Propiciar espacios y encuentros de sana diversión en un ambiente no laboral que permita la recuperación y práctica de los valores institucionales: honestidad, respeto, tolerancia, equidad y solidaridad.  
-->
<br>
  Sus datos personales están protegidos por la ley 1581 de 2012 donde al diligenciar el formulario acepta el uso de datos personales y el envío de información relacionada con el Grupo de Bienestar y Gestión del Conocimiento.
  <br>
  
  </p>
  
   <h3  class="box-title">
<?php 


if ($fecha_limite>=$fecha_actual && 837>$todaolimpiada23) {

// if (1==$_SESSION['rol'] or 0<$nump111 or 1==1) {   //
 //if (1==$_SESSION['rol']) {
	 
	 
	$array= array('80727789', '71710352', '1017146869', '39683397', '2964324', '42058018', '30651509', '1044502456', '1035416970', '1832496', '2143615', '35264786', '1018407662', '52965755', '19408429', '51933065', '10544543605', '1005486463', '1085914981', '52396624', '1116782526', '55150780', '1214722550', '30285145', '17348126', '69026253', '52049917', '51780149', '49732348', '20945858', '52587426', '80832089', '1102352461', '1052388386', '12979604', '87433783', '80766734', '52819341', '94316965');
	 if (in_array($_SESSION['cedula_funcionario'], $array)) {
echo '<b>- No puede participar, contactar a seguridad y salud en el trabajo.</b>';
		 } else {
 ?>
  
   
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>  Juegos Deportivos Nacionales SNR 2023   
	  <a href="https://intranet.supernotariado.gov.co/bienestar/juegos-deportivos-nacionales-2023/" target="_blank">Terminos y condiciones</a>
	  
	  
	 <?php 

	 }

	 } else { echo ''; } 
	 //} else { } 
 ?>
	  </h3>
	  

	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Inscripción</th>
		<th>Funcionario</th>
		<th>Correo</th>
		<th>Celular</th>
		<th>Cedula</th>
				  <th>Regional</th>
				  <th>Oficina</th>
				   <th>Disciplina</th>
				  <th>Equipo</th>
				  
				  <th>Pantalon</th>		
				   <th>Camiseta</th>
 <th>Chaqueta</th>				   
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 
if (1==$_SESSION['rol'] or 0<$nump111) {
$query4="SELECT * from olimpiada23, funcionario where olimpiada23.id_funcionario=funcionario.id_funcionario and estado_olimpiada23=1 ORDER BY id_olimpiada23 desc  "; 

} else {
$query4="SELECT * from olimpiada23, funcionario where olimpiada23.id_funcionario=funcionario.id_funcionario and estado_olimpiada23=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_olimpiada23 desc  "; 

}





$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_olimpiada23'];
echo '<td>'.$row['fecha_olimpiada23'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';

echo '<td>';
echo $row['correo_funcionario'];
echo '</td>';
echo '<td>';
echo $row['celular_funcionario'];
echo '</td>';

echo '<td>';
echo $row['cedula_funcionario'];
echo '</td>';


if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
	
}

echo '<td>'.$row['nombre_olimpiada23'].'</td>';
echo '<td>';
if (1==$row['equipo']) { echo 'No tiene equipo'; } else { echo $row['equipo'];}
echo '</td>';
echo '<td>'.$row['pantalon'].'</td>';

echo '<td>'.$row['camiseta'].'</td>';
echo '<td>'.$row['chaqueta'].'</td>';

echo '<td>';
echo ' <a href="filesnr/olimpiada/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';
	if (1==$_SESSION['rol'] or 0<$nump111 ) { //or 0<$nump111
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="olimpiada23" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

//echo ' <a href="" class="buscarolimpiada23" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizarolimpiada23"> <i class="fa fa-edit"></i></a> ';




	} else {}
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
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php 
	if (1==1) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r653454345345464324324563m1" enctype="multipart/form-data" >


 
 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>



 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> PERFIL:</label> 
<input type="text" class="form-control" readonly value="<?php if (5==$_SESSION['snr_grupo_cargo']) { echo 'Contratista'; } else { echo 'Funcionario';} ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Estado Civil:</label> 
<select name="id_estado_civil" class="form-control" required>
<option selected></option>
<?php
$query = sprintf("SELECT * FROM estado_civil where estado_estado_civil=1 and id_estado_civil!=6 order by id_estado_civil"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_estado_civil'].'"  ';
	
	
	echo '>'.$row['nombre_estado_civil'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>

</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Telefono Celular:</label> 
<input type="text" class="form-control numero"  name="celular_funcionario" placeholder="Solo números" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RH:</label> 
<input type="text" class="form-control"  name="rh" placeholder="" required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha nacimiento: (Usar el calendario)</label> 
<input type="text" readonly class="form-control datepickera"  name="fecha_nacimiento" required>
</div>






<div class="form-group text-left"> 
<label  class="control-label">
<span style="color:#ff0000;">*</span> Seleccione la disciplina deportiva en la cual usted va a representar:</label> 
<select class="form-control" name="nombre_olimpiada23" id="nombre_olimpiada" required>
<option value="" selected></option>
<optgroup label="Disciplinas en equipo">
<option title="Max 9 por equipo">Futbol 5 Masculino</option> 
<option title="Max 9 por equipo">Futbol 5 Femenino</option> 
<!--
<option title="Max 9 por equipo">Baloncesto Femenino</option> 
<option title="Max 9 por equipo">Baloncesto Masculino</option> 
-->
<option title="Max 8 por equipo">Baloncesto mixto</option>
<option title="Max 10 por equipo">Voleibol Mixto</option> 
<option title="Max 6 por equipo">Bolirana Mixto</option>
<option title="Max 6 por equipo">Bolos Mixto</option>
<option title="Max 6 por equipo">Mini tejo Mixto</option>
</optgroup>
 <optgroup label="Disciplinas individuales">
<option>Atletismo femenino (5 Km)</option> 
<option>Atletismo masculino (10 Km)</option> 
<option>Tenis de Mesa masculino</option>  
<option>Tenis de Mesa femenino</option> 
<option>Tenis de campo masculino</option>  
<option>Tenis de campo femenino</option> 
<option>Billar pool masculino</option>  
<option>Billar pool femenino</option> 
<option>Billar libre masculino</option> 
<option>Billar libre femenino</option> 
<option>Natación Masculino (pecho, espalda y libre)</option> 
<option>Natación Femenino (pecho, espalda y libre)</option> 
<option>Ajedrez</option> 
<option>Duatlon</option> 
<option>Patinaje masculino</option>
<option>Patinaje femenino</option>
</optgroup>
</select>
</div>





		

<div class="form-group text-left" style="display:none" id="vistaequipo"> 
<label  class="control-label">
<span style="color:#ff0000;">*</span> Seleccione el nombre de su equipo ó cree uno.(si es disciplina en equipo):</label> 
<select class="form-control"  name="equipo2" placeholder="" id="tipo_olimpiada">
<option value=""></option> 
<optgroup label="Opciones - - - - - - - ">
<option value="0">Nuevo equipo</option>
<option value="1">No tengo equipo</option>
</optgroup>
 <optgroup label="Equipos creados - - - - - - -">
<?php
$query3 = sprintf("SELECT equipo FROM olimpiada23 where estado_olimpiada23=1 and equipo!=1 and equipo is not null group by equipo order by equipo"); 
$select3 = mysql_query($query3, $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
do {
	echo '<option value="'.$row3['equipo'].'"  ';
	
	
	echo '>'.$row3['equipo'].'</option>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
} else {}	 
mysql_free_result($select3);
?>
</optgroup>

</select>
</div>




<div class="form-group text-left" style="display:none;" id="name_equipo"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>  Crear nuevo nombre de equipo (si es disciplina en equipo):</label> 
<input type="text" class="form-control"  name="equipo" id="equipo" placeholder="Debe ser el mismo nombre para todos los miembros" >
</div>


<div class="form-group text-left" style="display:none;" id="code"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>  Codigo de equipo: </label> 
<input type="text" class="form-control"  name="code"  placeholder="Debe ser el mismo codigo para todos los miembros" >
</div>



<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> Ciudad de Residencia:</label> 
<input type="text" class="form-control"  name="ciudadr" required >
</div>



<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> EPS:</label> 
<input type="text" class="form-control"  name="eps" required >
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> ARL:</label> 
<input type="text" class="form-control"  name="arl" required >
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> Contacto de emergencia:</label> 
<input type="text" class="form-control"  name="cemergencia" required >
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> Número de celular de contacto de emergencia:</label> 
<input type="text" class="form-control numero"  name="celuemergencia" required >
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>De acuerdo con su estilo de vida por favor indicarnos sus hábitos alimenticios: 
</label>
<select class="form-control"  name="alimentos" required>
<option></option>
<option>Vegano</option> 
<option>Vegetariano</option>
<option>Libre de gluten</option>
<option>Carnívoro</option>
<option>Omnívoro</option>
</select>
</div>



<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> Indique si presenta alguna alergia alimentaria (Si / No) (Si: medicamento):</label> 
<input type="text" class="form-control"  name="alergia" required >
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> Indicar si es diabético (Si / No)  (Si: mencione los medicamentos):</label> 
<input type="text" class="form-control"  name="medicamento" required >
</div>







<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Ingrese su talla de pantalón y/o pantaloneta: 
(<a href="files/portal/intranet/portal-juegos_2023.jpg" target="_blank"> Guia de tallas</a>)</label> 

<select class="form-control"  name="pantalon" required>
<option></option>
<optgroup label="Mujeres">
<option>4</option> 
<option>6</option>
<option>8</option>
<option>10</option>
<option>12</option>
<option>14</option>
</optgroup>
<optgroup label="Hombres">
<option>28</option>
<option>30</option>
<option>32</option>
<option>34</option>
<option>36</option>
<option>38</option>
</optgroup>
</select>

</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Ingrese su talla de camiseta: 
(<a href="files/portal/intranet/portal-juegos_2023.jpg" target="_blank"> Guia de tallas</a>)</label> 

<select class="form-control"  name="camiseta" required>
<option></option>
<option>XS</option> 
<option>S</option>
<option>M</option>
<option>L</option>
<option>XL</option>
<option>XXL</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Ingrese su talla de chaqueta:
(<a href="files/portal/intranet/portal-juegos_2023.jpg" target="_blank"> Guia de tallas</a>) </label> 

<select class="form-control"  name="chaqueta" required>
<option></option>
<optgroup label="Mujeres">
<option>6</option>
<option>8</option>
<option>10</option>
<option>12</option>
<option>14</option>
</optgroup>
<optgroup label="Hombres">
<option>XS</option> 
<option>S</option>
<option>M</option>
<option>L</option>
<option>XL</option>
<option>XXL</option>
</optgroup>
</select>



</div>


<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
	var fsize = 10000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension pdf');
        fileInput.value = '';
        return false;
		
		
    }else{
  
  if  (siezekiloByte < fsize){
	  
	   if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
	  
} else {
	alert('Debe ser inferior a 10000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> <b>Adjunte en un solo PDF la siguiente documentación:</b><br></label> 
<br>1. Fotocopia de cédula de ciudadanía legible.  
<br>

2. Certificado médico de la EPS que corrobore que es una persona apta para participar en los juegos deportivos de la SNR, de acuerdo con la disciplina deportiva de su elección.  
<br>


3. Certificado de esquema de vacunación completo (dos dosis o única dosis para el caso de Janssen).
<br>


4. Consentimiento informado (<a href="files/portal/intranet/portal-consentimiento_2023.pdf" download="Formato a diligenciar.pdf">Descargar modelo</a>).
<br>





<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 10 Mg / </span>
<div id="imagePreview"></div>
</div>





<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="instruccion_admin">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="popupactualizarolimpiada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Disciplinas</b></h4>
</div> 
<div id="ver_actualizarolimpiada" class="modal-body"> 
<?php
$query3 = sprintf("SELECT nombre_olimpiada23, COUNT( * ) Total
FROM olimpiada23 where estado_olimpiada23=1 
GROUP BY nombre_olimpiada23
HAVING COUNT( * ) >0"); 
$select3 = mysql_query($query3, $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
do {
	echo '<li>';
	if ('1'==$row3['nombre_olimpiada23']) {
		echo 'Sin equipo: ';
	} else {
	echo $row3['nombre_olimpiada23'].': ';
	}
echo ''.$row3['Total'].'</li>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
} else {}	 
mysql_free_result($select3);

?>
</div>
</div> 
</div> 
</div>



<div class="modal fade" id="popupactualizarolimpiada2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Equipos</b></h4>
</div> 
<div id="ver_actualizarolimpiada2" class="modal-body"> 
<?php
$query3 = sprintf("SELECT equipo, COUNT( * ) Total2
FROM olimpiada23 where equipo is not null and estado_olimpiada23=1 
GROUP BY equipo
HAVING COUNT( * ) >0"); 
$select3 = mysql_query($query3, $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
do {
	echo '<li>';
	if ('1'==$row3['equipo']) {
		echo 'No tiene equipo: ';
	} else {
	echo $row3['equipo'].': ';
	}
echo ''.$row3['Total2'].'</li>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
} else {}	 
mysql_free_result($select3);

?>
</div>
</div> 
</div> 
</div>

	  



<div class="modal fade" id="popupequipos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Equipos</b></h4>
</div> 
<div id="ver_actualizarolimpiada2" class="modal-body"> 
<table>
<tr>
<td>Disciplina </td>
<td>N. funcionarios </td>
<td>N. equipos </td>
</tr>
<?php

$query3 = sprintf("SELECT nombre_olimpiada23, COUNT( * ) Total
FROM olimpiada23 where estado_olimpiada23=1
GROUP BY nombre_olimpiada23
HAVING COUNT( * ) >0"); 
$select3 = mysql_query($query3, $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
do {

$equip=$row3['nombre_olimpiada23'].' ';
echo '<tr><td>'.$equip;
echo '</td><td> '.$row3['Total'].' ';


$query33 = sprintf("SELECT count(DISTINCT(equipo)) as totale FROM olimpiada23 where estado_olimpiada23=1 AND 
nombre_olimpiada23='$equip'"); 
$select33 = mysql_query($query33, $conexion);
$row33 = mysql_fetch_assoc($select33);
echo '</td><td>'.$row33['totale'].'</td></tr>';
mysql_free_result($select33);



	 } while ($row3 = mysql_fetch_assoc($select3)); 
} else {}	 
mysql_free_result($select3);
echo '</table>';
echo '<br><b>Total: '.$todaolimpiada23.'</b>';

?>
</div>
</div> 
</div> 
</div>



<?php } else { }

	 } 

} else {
	echo 'No tiene acceso.';
} 


} else {
	echo 'No disponible.<br>';
	echo date('Y-m-d H:i');
}

?>




<?php
/*
$nump95=privilegios(95,$_SESSION['snr']);
if (isset($_POST['fecha'])){ 
$fechan=$_POST['fecha'];
 } else {
$fechan=date('Y-m-d');  
 } 


	   

} else {
$idorip=$_SESSION['id_oficina_registro'];
}

*/





if (isset($_GET['i'])) { 
$idorip=$_GET['i'];
 } else {
$idorip=0;  
 } 
 
 

$nump113=privilegios(113,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { 



if ((isset($_POST["salud1"])) && (""!=$_POST["salud1"]) && 
(1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina'])) {
	
	

$query = sprintf("SELECT count(id_condicion_salud) as tt FROM condicion_salud where estado_condicion_salud=1 and id_funcionario=".$_SESSION['snr'].""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tt']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene un registro.</div>';
	
} else {
	
	

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/condicions/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'condicions-'.$_SESSION['snr'].''.date("YmdGis");

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
  
	
/*
$insertSQL = sprintf("INSERT INTO condicion_salud (id_funcionario, fecha_registro, url, salud1, salud2, salud3, salud4, salud5, salud6, salud7, salud8, salud9, 
salud10, salud11, salud12, salud13, salud14, salud15, salud16, salud17, salud18, salud19, salud20, salud21, salud22, salud23, salud24, salud25, salud26, salud27, 
salud28, salud29, salud30, salud31, salud32, salud33, salud34, salud35, salud36, salud37, salud38, salud39, salud40, salud41, salud42, salud43, salud44, salud45, 
estado_condicion_salud)
 VALUES (%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
 %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString($_POST["salud1"], "text"), 
GetSQLValueString($_POST["salud2"], "text"), 
GetSQLValueString($_POST["salud3"], "text"), 
GetSQLValueString($_POST["salud4"], "text"), 
GetSQLValueString($_POST["salud5"], "text"), 
GetSQLValueString($_POST["salud6"], "text"), 
GetSQLValueString($_POST["salud7"], "text"), 
GetSQLValueString($_POST["salud8"], "text"), 
GetSQLValueString($_POST["salud9"], "text"), 
GetSQLValueString($_POST["salud10"], "text"), 
GetSQLValueString($_POST["salud11"], "text"), 
GetSQLValueString($_POST["salud12"], "text"), 
GetSQLValueString($_POST["salud13"], "text"), 
GetSQLValueString($_POST["salud14"], "text"), 
GetSQLValueString($_POST["salud15"], "text"), 
GetSQLValueString($_POST["salud16"], "text"), 
GetSQLValueString($_POST["salud17"], "text"), 
GetSQLValueString($_POST["salud18"], "text"), 
GetSQLValueString($_POST["salud19"], "text"), 
GetSQLValueString($_POST["salud20"], "text"), 
GetSQLValueString($_POST["salud21"], "text"), 
GetSQLValueString($_POST["salud22"], "text"), 
GetSQLValueString($_POST["salud23"], "text"), 
GetSQLValueString($_POST["salud24"], "text"), 
GetSQLValueString($_POST["salud25"], "text"), 
GetSQLValueString($_POST["salud26"], "text"), 
GetSQLValueString($_POST["salud27"], "text"), 
GetSQLValueString($_POST["salud28"], "text"), 
GetSQLValueString($_POST["salud29"], "text"), 
GetSQLValueString($_POST["salud30"], "text"), 
GetSQLValueString($_POST["salud31"], "text"), 
GetSQLValueString($_POST["salud32"], "text"), 
GetSQLValueString($_POST["salud33"], "text"), 
GetSQLValueString($_POST["salud34"], "text"), 
GetSQLValueString($_POST["salud35"], "text"), 
GetSQLValueString($_POST["salud36"], "text"), 
GetSQLValueString($_POST["salud37"], "text"), 
GetSQLValueString($_POST["salud38"], "text"), 
GetSQLValueString($_POST["salud39"], "text"), 
GetSQLValueString($_POST["salud40"], "text"), 
GetSQLValueString($_POST["salud41"], "text"), 
GetSQLValueString($_POST["salud42"], "text"), 
GetSQLValueString($_POST["salud43"], "text"), 
GetSQLValueString($_POST["salud44"], "text"), 
GetSQLValueString($_POST["salud45"], "text"), 
GetSQLValueString(1, "int"));
$Result22 = mysql_query($insertSQL, $conexion);
*/


$insertSQL = sprintf("INSERT INTO condicion_salud (id_funcionario, fecha_registro, url, salud1, salud2, salud3, salud4, salud5, salud6, salud7, salud8, salud9, 
salud10, salud11, salud12, salud13, salud14, salud15, salud16, salud17, salud18, salud19, salud20, salud21, salud22, salud23, salud24, salud25, 
salud26, salud27, salud28, salud29, salud30, salud31, salud32, salud33, salud34, salud35, salud36, salud37, salud38, salud39, salud40, salud41, salud42, 
salud43, salud44, salud45, estado_condicion_salud) VALUES 
(%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
 %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"), 

GetSQLValueString($files, "text"), 

GetSQLValueString($_POST["salud1"], "text"), 

GetSQLValueString($_POST["salud2"], "text"), GetSQLValueString($_POST["salud3"], "text"), GetSQLValueString($_POST["salud4"], "text"), GetSQLValueString($_POST["salud5"], "text"), GetSQLValueString($_POST["salud6"], "text"), GetSQLValueString($_POST["salud7"], "text"), GetSQLValueString($_POST["salud8"], "text"), GetSQLValueString($_POST["salud9"], "text"), GetSQLValueString($_POST["salud10"], "text"), GetSQLValueString($_POST["salud11"], "text"), GetSQLValueString($_POST["salud12"], "text"), GetSQLValueString($_POST["salud13"], "text"), GetSQLValueString($_POST["salud14"], "text"), GetSQLValueString($_POST["salud15"], "text"), GetSQLValueString($_POST["salud16"], "text"), GetSQLValueString($_POST["salud17"], "text"), GetSQLValueString($_POST["salud18"], "text"), GetSQLValueString($_POST["salud19"], "text"), GetSQLValueString($_POST["salud20"], "text"), GetSQLValueString($_POST["salud21"], "text"), GetSQLValueString($_POST["salud22"], "text"), GetSQLValueString($_POST["salud23"], "text"), GetSQLValueString($_POST["salud24"], "text"), GetSQLValueString($_POST["salud25"], "text"), GetSQLValueString($_POST["salud26"], "text"), GetSQLValueString($_POST["salud27"], "text"), GetSQLValueString($_POST["salud28"], "text"), GetSQLValueString($_POST["salud29"], "text"), GetSQLValueString($_POST["salud30"], "text"), GetSQLValueString($_POST["salud31"], "text"), GetSQLValueString($_POST["salud32"], "text"), GetSQLValueString($_POST["salud33"], "text"), GetSQLValueString($_POST["salud34"], "text"), GetSQLValueString($_POST["salud35"], "text"), GetSQLValueString($_POST["salud36"], "text"), GetSQLValueString($_POST["salud37"], "text"), GetSQLValueString($_POST["salud38"], "text"), GetSQLValueString($_POST["salud39"], "text"), GetSQLValueString($_POST["salud40"], "text"), GetSQLValueString($_POST["salud41"], "text"), GetSQLValueString($_POST["salud42"], "text"), GetSQLValueString($_POST["salud43"], "text"), GetSQLValueString($_POST["salud44"], "text"), GetSQLValueString($_POST["salud45"], "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);


echo $insertado;
 if (1==$_SESSION['rol']) { 
//echo $insertSQL;
 } else {}
  $updateSQL2 = sprintf("UPDATE funcionario SET celular_funcionario=%s, rh=%s, id_estado_civil=%s  WHERE id_funcionario=%s and estado_funcionario=1",
                     
					   GetSQLValueString($_POST["celular_funcionario"], "text"),
					   GetSQLValueString($_POST["rh"], "text"),
					   GetSQLValueString($_POST["id_estado_civil"], "text"),
					 
					    GetSQLValueString($_SESSION['snr'], "int"));
  $Result12 = mysql_query($updateSQL2, $conexion);
  


}


}


 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('condicion_salud'); ?></h3>

              <p>Registros</p>
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
              <h3>20<?php echo $anoactual; ?></h3>

              <p>Año</p>
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
             
 <h3>5</h3>
			  
              <p>Regionales</p>
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
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">
<?php 
// or 3>$_SESSION['snr_tipo_oficina']
 if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { 

$fechan=date('Y-m-d');  

?>
  
   <!-- <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>-->

	 Condición de salud 2022
	  
	  
	 <?php if (isset($_GET['i'])) { 
	 echo ' / ';
//echo quees('oficina_registro',$idorip);
 } else {
 
 } 
 
  if (1==$_SESSION['rol'] or 0<$nump113) { 
//echo ' &nbsp;  &nbsp;  &nbsp;  &nbsp; <a href="https://sisg.supernotariado.gov.co/xlsx/condicion_salud.xls"><img src="images/xls.png"> Reporte</a>';
  } else {}
 ?>
	  </h3>
<br><br>La siguiente encuesta tiene como objetivo identificar su estado de salud actual e incluirlo en programas de seguimiento desde el área de Medicina Preventiva de la Superintendencia de Notariado y Registro además de ubicarlo en los factores de riesgo para Covid 19.
<br>Por lo anterior al diligenciarla declaro que he sido informado y he comprendido satisfactoriamente la naturaleza y propósito de esta encuesta, y sé que mi participación es voluntaria, por lo anterior, doy mi consentimiento para que la información de la misma sea utilizada para los análisis requeridos dentro del programa de vigilancia epidemiológica de la Superintendencia de Notariado y Registro y los programas de prevención para Covid 19.
<br>Tenga presente que la información consignada esta sujeta a reserva clínico-legal y confidencialidad de acuerdo a la normatividad vigente y solo será utilizada con fines preventivos. 
<br>Por favor responda las preguntas con sinceridad.
<br>Sus datos personales están protegidos por la ley 1581 de 2012 ¿Acepta el uso de datos personales y el envío de información relacionada con la presente solicitud?

	  
	  
<?php } else {} ?>
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Reportado</th>
				  <th>Funcionario</th>
				   <th>Cedula</th>
				  <th>Celular</th>
				  <th>Rh</th>
				  <th>Estado civil</th>


				  <th>Regional</th>
				  <th>Oficina</th>				  
				   <th>Peso</th>	
<th>Estatura</th>
<th>Eps</th>
<th>Cabeza Familia</th>		
<th>	¿Alguna vez a usted le han diagnosticado cáncer?	</th>
<th>	Si la anterior respuesta es afirmativa responda ¿está usted en tratamiento activo (ultima quimioterapia o radioterapia) hace menos de 3 meses y por esta causa se encuentra incapacitado o tiene recomendaciones médicas vigentes?	</th>
<th>	¿Ha recibido trasplante de órganos en los últimos 6 meses?	</th>
<th>	Si su respuesta anterior fue  (SÍ) Por favor responda  ¿está usted incapacitado por esta causa actualmente o tiene recomendaciones vigentes por para de su médico especialista tratante?	</th>
<th>	¿Esta usted en la lista de espera para trasplante por enfermedad crónica de algún órgano importante?	</th>
<th>	Si la anterior respuesta es (SÍ) responda ¿Ha estado hospitalizado por esta causa en los últimos 3 meses o ha tenido múltiples incapacidades recientes?	</th>
<th>	"Le han diagnosticado enfermedades producto de secuelas posterior a Covid 19 como pulmonares crónicas (que amerite oxigeno) enfermedad del corazón u otras enfermedades del Sistema Nervioso"</th>
<th>	Si la respuesta anterior fue (SÍ) responda  si el manejo de su(s) enfermedad (es) esta siendo tratado por :	</th>
<th>	¿Ha estado incapacitado (a) de manera CONTINUA por mas de 180 días (6 meses)?	</th>
<th>	¿Esta usted en embarazo de ALTO RIESGO OBSTETRICO?	</th>
<th>	Diabetes	</th>
<th>	Cáncer	</th>
<th>	Hipertensión arterial	</th>
<th>	Lupus eritematoso	</th>
<th>	Artritis reumatoidea	</th>
<th>	Asma 	</th>
<th>	Enfermedad Hepática	</th>
<th>	Insuficiencia Renal	</th>
<th>	Otras Enfermedades auto-inmunes	</th>
<th>	Enfermedad pulmonar obstructiva Crónica (Epoc)	</th>
<th>	"Trastornos cardíacos (como insuficiencia cardíaca, enfermedad
Trastornos cardíacos (como insuficiencia cardíaca, enfermedad, arterial coronaria, cardiomiopatías)."	</th>
<th>	ECV /ACV Accidente cerebrovascular	</th>
<th>	Enfermedades Huerfanas	</th>
<th>	 Enfermedad de células falciformes o talasemia.	</th>
<th>	¿Requiere usted de ayuda psicológica en este momento?	</th>
<th>	¿Ha sufrido accidentes de trabajo en el ultimo año?	</th>
<th>	¿Se encuentra actualmente en algún proceso terapéutico con psicología o psiquiatría?	</th>
<th>	¿Le han calificado enfermedades laborales?	</th>
<th>	Si su respuesta anterior fue (SÍ) por favor mencione cual enfermedad laboral, de lo contrario continué con la encuesta.	</th>
<th>	En caso de emergencia vital por favor escriba nombre completo y numero de celular de familiar o acudiente	</th>
<th>	¿Usted realiza ejercicio en forma activa al menos 20 minutos, correr, bicicleta?	</th>
<th>	¿Considera que su alimentación es balanceada?	</th>
<th>	¿consume  azúcar , sal, o comida chatarra?	</th>
<th>	¿Fuma cigarrillo actualmente?	</th>
<th>	Si su respuesta anteriror fue (SI) Hace cuanto tiempo fuma?	</th>
<th>	Cuantos cigarrillos consume en el día	</th>
<th>	¿Consume frecuentemente café, té, bebidas oscuras ?	</th>
<th>	Ha sufrido PRE- INFARTOS o INFARTOS	</th>
<th>	Realiza pausas activas durante su jornada laboral	</th>
		   <th>Ha sufrido alguna enfermedad que genere alteración del sistema osteomuscular</th>
		    <th>Realiza actividades extralaborales con alto riesgo osteomuscular </th>
<th style="width:90px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
				$infop=$infobus;
				$pagina=0;
				} else {
					
				$infop='';
				
	if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
	 } else {
		$pagina=0;  
	 }
				
				}
 


if (1==$_SESSION['rol'] or 0<$nump113) {
$query4="SELECT * from condicion_salud, funcionario, estado_civil where funcionario.id_estado_civil=estado_civil.id_estado_civil and condicion_salud.id_funcionario=funcionario.id_funcionario and estado_condicion_salud=1 ".$infop." ORDER BY id_condicion_salud desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from condicion_salud, funcionario, estado_civil where funcionario.id_estado_civil=estado_civil.id_estado_civil and  condicion_salud.id_funcionario=funcionario.id_funcionario and estado_condicion_salud=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_condicion_salud desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_condicion_salud'];
echo '<td>'.$row['fecha_registro'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';

echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td>'.$row['celular_funcionario'].'</td>';
echo '<td>'.$row['rh'].'</td>';
echo '<td>'.$row['nombre_estado_civil'].'</td>';


if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
	
}



echo '<td>'.$row['salud1'].'</td>';
echo '<td>'.$row['salud2'].'</td>';
echo '<td>'.$row['salud3'].'</td>';
echo '<td>'.$row['salud4'].'</td>';
echo '<td>'.$row['salud5'].'</td>';
echo '<td>'.$row['salud6'].'</td>';
echo '<td>'.$row['salud7'].'</td>';
echo '<td>'.$row['salud8'].'</td>';
echo '<td>'.$row['salud9'].'</td>';
echo '<td>'.$row['salud10'].'</td>';
echo '<td>'.$row['salud11'].'</td>';
echo '<td>'.$row['salud12'].'</td>';
echo '<td>'.$row['salud13'].'</td>';
echo '<td>'.$row['salud14'].'</td>';
echo '<td>'.$row['salud15'].'</td>';
echo '<td>'.$row['salud16'].'</td>';
echo '<td>'.$row['salud17'].'</td>';
echo '<td>'.$row['salud18'].'</td>';
echo '<td>'.$row['salud19'].'</td>';
echo '<td>'.$row['salud20'].'</td>';
echo '<td>'.$row['salud21'].'</td>';
echo '<td>'.$row['salud22'].'</td>';
echo '<td>'.$row['salud23'].'</td>';
echo '<td>'.$row['salud24'].'</td>';
echo '<td>'.$row['salud25'].'</td>';
echo '<td>'.$row['salud26'].'</td>';
echo '<td>'.$row['salud27'].'</td>';
echo '<td>'.$row['salud28'].'</td>';
echo '<td>'.$row['salud29'].'</td>';
echo '<td>'.$row['salud30'].'</td>';
echo '<td>'.$row['salud31'].'</td>';
echo '<td>'.$row['salud32'].'</td>';
echo '<td>'.$row['salud33'].'</td>';
echo '<td>'.$row['salud34'].'</td>';
echo '<td>'.$row['salud35'].'</td>';
echo '<td>'.$row['salud36'].'</td>';
echo '<td>'.$row['salud37'].'</td>';
echo '<td>'.$row['salud38'].'</td>';
echo '<td>'.$row['salud39'].'</td>';
echo '<td>'.$row['salud40'].'</td>';
echo '<td>'.$row['salud41'].'</td>';
echo '<td>'.$row['salud42'].'</td>';
echo '<td>'.$row['salud43'].'</td>';
echo '<td>'.$row['salud44'].'</td>';
echo '<td>'.$row['salud45'].'</td>';
echo '<td>';
if (isset($row['url']) && ""!=$row['url']) { 
echo ' <a href="filesnr/condicions/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';
} else {}


	if (1==$_SESSION['rol'] or 0<$nump113) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="condicion_salud" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
										<?php if (1==$_SESSION['rol'] or 0<$nump113) {  ?>
									'excelHtml5'
										<?php } else {} ?>
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

//1==$_SESSION['rol'] or
if ( 3>$_SESSION['snr_tipo_oficina']) { ?>





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
        
<form action="" method="POST" name="for54354r65345345464324324563m1" enctype="multipart/form-data" >


 
 <div class="form-group text-left"> 
<label  class="control-label">1.<span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">2.<span style="color:#ff0000;">*</span> Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">3.<span style="color:#ff0000;">*</span> Cargo:</label> 
<input type="text" class="form-control" readonly value="<?php echo quees('cargo',$_SESSION['snr_grupo_cargo']); ?>">
</div>


 <div class="form-group text-left"> 
<label  class="control-label">4.<span style="color:#ff0000;">*</span> Estado Civil:</label> 
<select class="form-control" name="id_estado_civil" required>
<option value="6" selected></option>
<option value="1">Soltero</option><option value="2">Casado</option><option value="3">Union Libre</option><option value="4">Separado</option><option value="5">Madre/padre cabeza de familia</option><option value="7">Viudo/a</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label">5.<span style="color:#ff0000;">*</span> Número de celular: </label> 
<input type="text" class="form-control numero"  name="celular_funcionario" placeholder="Solo números y punto"   required>
</div>


<div class="form-group text-left"> 
<label  class="control-label">6.<span style="color:#ff0000;">*</span> RH: </label> 
<input type="text" class="form-control"  name="rh"   required>
</div>



<div class="form-group text-left"> 
<label  class="control-label">7.<span style="color:#ff0000;">*</span> ¿Cuál es su peso actual?</label>

<input type="text"  class="form-control" name="salud1"></div>

<div class="form-group text-left"> 
<label  class="control-label">8.<span style="color:#ff0000;">*</span> ¿Cuál es su estatura?</label>

<input type="text"  class="form-control" name="salud2" required></div>

<div class="form-group text-left"> 
<label  class="control-label">9.<span style="color:#ff0000;">*</span> ¿Nombre de la EPS actual?</label>

<input type="text"  class="form-control" name="salud3" required></div>

<div class="form-group text-left"> 
<label  class="control-label">10.<span style="color:#ff0000;">*</span> ¿Es madre o padre cabeza de familia?</label>

<select class="form-control" name="salud4" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">11.<span style="color:#ff0000;">*</span> ¿Alguna vez a usted le han diagnosticado cáncer?</label>

<select class="form-control filepdf" name="salud5" id="salud5" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">12.<span style="color:#ff0000;">*</span> Si la anterior respuesta es afirmativa responda ¿está usted en tratamiento activo (ultima quimioterapia o radioterapia) hace menos de 3 meses y por esta causa se encuentra incapacitado o tiene recomendaciones médicas vigentes?</label>

<select class="form-control  filepdf" name="salud6" id="salud6" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">13.<span style="color:#ff0000;">*</span> ¿Ha recibido trasplante de órganos en los últimos 6 meses?</label>

<select class="form-control filepdf" name="salud7" id="salud7" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">14.<span style="color:#ff0000;">*</span> Si su respuesta anterior fue  (SI) Por favor responda  ¿está usted incapacitado por esta causa actualmente o tiene recomendaciones vigentes por para de su médico especialista tratante?</label>

<select class="form-control  filepdf" name="salud8" id="salud8" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">15.<span style="color:#ff0000;">*</span> ¿Esta usted en la lista de espera para trasplante por enfermedad crónica de algún órgano importante?</label>

<select class="form-control  filepdf" name="salud9" id="salud9" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">16.<span style="color:#ff0000;">*</span> Si la anterior respuesta es (SI) responda ¿Ha estado hospitalizado por esta causa en los últimos 3 meses o ha tenido múltiples incapacidades recientes?</label>

<select class="form-control  filepdf" name="salud10" id="salud10" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">17.<span style="color:#ff0000;">*</span> "Le han diagnosticado enfermedades producto de secuelas posterior a Covid 19 como pulmonares crónicas (que amerite oxigeno) enfermedad del corazón u otras enfermedades del Sistema Nervioso y por esta causa se ha incapacitado o ha estado hospitalizado en los últimos 3 meses? "</label>

<select class="form-control  filepdf" name="salud11" id="salud11" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">18.<span style="color:#ff0000;">*</span> Si la respuesta anterior fue (SI) responda  si el manejo de su(s) enfermedad (es) esta siendo tratado por :</label>

<select class="form-control" name="salud12" required><option selected></option>

		 	

<option>EPS</option>
<option>Medicina Prepagada</option>
<option>ARL</option>
<option>Fondo de Pensiones</option>
<option>No aplica</option>
</select></div>

<div class="form-group text-left"> 
<label  class="control-label">19.<span style="color:#ff0000;">*</span> ¿Ha estado incapacitado (a) de manera CONTINUA por mas de 180 d as (6 meses)?</label>

<select class="form-control filepdf" name="salud13" id="salud13" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">20.<span style="color:#ff0000;">*</span> ¿Esta usted en embarazo de ALTO RIESGO OBSTETRICO?</label>

<select class="form-control  filepdf" name="salud14" id="salud14" required>
<option selected></option><option>Si</option><option>No</option>
<option>No aplica</option>
</select></div>

<hr>
Actualmente usted esta diagnosticado con alguna de las siguientes enfermedades por su médico tratante recuerde que debe contar con el soporte para cargarlo en la siguiente pregunta. Por favor responda si o no según corresponda.

<div class="form-group text-left"> 
<label  class="control-label">21.<span style="color:#ff0000;">*</span> Diabetes</label>

<select class="form-control  filepdf" name="salud15" id="salud15" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">22.<span style="color:#ff0000;">*</span> Cáncer</label>

<select class="form-control  filepdf" name="salud16" id="salud16" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">23.<span style="color:#ff0000;">*</span> Hipertensión arterial</label>

<select class="form-control  filepdf" name="salud17" id="salud17" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">24.<span style="color:#ff0000;">*</span> Lupus eritematoso</label>

<select class="form-control  filepdf" name="salud18" id="salud18" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">25.<span style="color:#ff0000;">*</span> Artritis reumatoidea</label>

<select class="form-control  filepdf" name="salud19" id="salud19" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">26.<span style="color:#ff0000;">*</span> Asma </label>

<select class="form-control  filepdf" name="salud20" id="salud20" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">27.<span style="color:#ff0000;">*</span> Enfermedad Hepática</label>

<select class="form-control  filepdf" name="salud21" id="salud21" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">28.<span style="color:#ff0000;">*</span> Insuficiencia Renal</label>

<select class="form-control  filepdf" name="salud22" id="salud22" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">29.<span style="color:#ff0000;">*</span> Otras Enfermedades auto-inmunes (Colocar No ó cual enfermedad)</label>

<input type="text" class="form-control" name="salud23" id="salud23" required placeholder="Si, Cual enfermedad">
</div>

<div class="form-group text-left"> 
<label  class="control-label">30.<span style="color:#ff0000;">*</span> Enfermedad pulmonar obstructiva Crónica (Epoc)</label>

<select class="form-control  filepdf" name="salud24" id="salud24" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">31.<span style="color:#ff0000;">*</span> "Trastornos cardiacos (como insuficiencia cardiaca, enfermedad Trastornos cardiacos (como insuficiencia cardiaca, enfermedad, arterial coronaria, cardiomiopatias)."</label>

<select class="form-control  filepdf" name="salud25" id="salud25" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">32.<span style="color:#ff0000;">*</span> ECV /ACV Accidente cerebrovascular</label>

<select class="form-control  filepdf" name="salud26" id="salud26" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">33.<span style="color:#ff0000;">*</span> Enfermedades Huerfanas (No ó cual enfermedad)</label>

<input type="text" class="form-control " name="salud27" id="salud27" required placeholder="Si, cual enfermedad">
</div>

<div class="form-group text-left"> 
<label  class="control-label">34.<span style="color:#ff0000;">*</span>  Enfermedad de células falciformes o talasemia.</label>

<select class="form-control  filepdf" name="salud28" id="salud28" required><option selected></option><option>Si</option><option>No</option></select></div>
<hr>
<div class="form-group text-left"> 
<label  class="control-label">35.<span style="color:#ff0000;">*</span> ¿Requiere usted de ayuda psicológica en este momento?</label>

<select class="form-control" name="salud29" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">36.<span style="color:#ff0000;">*</span> ¿Ha sufrido accidentes de trabajo en el ultimo año?</label>

<select class="form-control" name="salud30" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">37.<span style="color:#ff0000;">*</span> ¿Se encuentra actualmente en algún proceso terapéutico con psicologia o psiquiatria?</label>

<select class="form-control" name="salud31" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">38.<span style="color:#ff0000;">*</span> ¿Le han calificado enfermedades laborales?</label>

<select class="form-control" name="salud32" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">39. Si su respuesta anterior fue (SI) por favor mencione cual enfermedad laboral, de lo contrario continué con la encuesta.</label>

<input type="text" class="form-control" name="salud33"></div>

<div class="form-group text-left"> 
<label  class="control-label">40.<span style="color:#ff0000;">*</span> En caso de emergencia vital por favor escriba nombre completo y numero de celular de familiar o acudiente</label>

<input type="text" class="form-control" name="salud34" required></div>
<hr>
<strong>ESTILOS DE VIDA SALUDABLE<br>
Por favor conteste SI o No según corresponda. Esta información nos permite detectar el nivel de riesgo cardiovascular. </strong>

<div class="form-group text-left"> 
<label  class="control-label">41.<span style="color:#ff0000;">*</span> ¿Usted realiza ejercicio en forma activa al menos 20 minutos, correr, bicicleta?</label>

<select class="form-control" name="salud35" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">42.<span style="color:#ff0000;">*</span> ¿Considera que su alimentación es balanceada?</label>

<select class="form-control" name="salud36" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">43.<span style="color:#ff0000;">*</span> ¿Consume  azúcar , sal, o comida chatarra?</label>

<select class="form-control" name="salud37" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">44.<span style="color:#ff0000;">*</span> ¿Fuma cigarrillo actualmente?</label>

<select class="form-control" name="salud38" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">45. Si su respuesta anteriror fue (SI) Hace cuanto tiempo fuma?</label>

<select class="form-control" name="salud39"><option selected></option>
<option>1 año</option>
<option>más de un año</option>
<option>No Aplica</option>
</select></div>

<div class="form-group text-left"> 
<label  class="control-label">46. Cuantos cigarrillos consume en el dia</label>

<select class="form-control" name="salud40"><option selected></option>
<option>Entre 1 a 5 
</option>
<option>Entre 5 a 10
</option>
<option>Más de 10 
</option>
<option>No Aplica
</option>
</select></div>

<div class="form-group text-left"> 
<label  class="control-label">47.<span style="color:#ff0000;">*</span> ¿Consume frecuentemente café, té, bebidas oscuras ?</label>

<select class="form-control" name="salud41" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">48.<span style="color:#ff0000;">*</span> Ha sufrido PRE- INFARTOS o INFARTOS</label>

<select class="form-control" name="salud42" required><option selected></option><option>Si</option><option>No</option></select></div>

<div class="form-group text-left"> 
<label  class="control-label">49.<span style="color:#ff0000;">*</span> Realiza pausas activas durante su jornada laboral</label>

<select class="form-control" name="salud43" required><option selected></option><option>Si</option><option>No</option></select></div>




<div class="form-group text-left"> 
<label  class="control-label">50.<span style="color:#ff0000;">*</span> Ha sufrido alguna enfermedad que genere alteración del sistema osteomuscular como:</label>

<select class="form-control" name="salud44" required><option selected></option>
<option>Enfermedades inmunológicas</option>
<option>Enfermedades neurológicas</option>
<option>Enfermedades metabólicas o tumorales (Menopausia, Diabetes, Hipotiroidismo, Osteoporosis, insuficiencia renal, tumor maligno)</option>
<option>Patología osteomuscular degenerativa, congénita, reumatológica </option>
<option>Tiene antecedentes de trauma osteomuscular de origen laboral o extra laboral que generen alteraciones anatómicas: atrofia muscular, acortamiento en la extremidad, hipotonía muscular, deformidad articular, edema residual, restricción en los arcos de movimiento que se encuentre sintomático o asintomático.</option>
<option>No Aplica
</option>
</select></div>



<div class="form-group text-left"> 
<label  class="control-label">51.<span style="color:#ff0000;">*</span> Realiza actividades extralaborales con alto riesgo osteomuscular como:</label>

<select class="form-control" name="salud45" required><option selected></option>
<option>
Futbol</option><option>Rugby</option><option>Basquetbol</option><option>Boxeo</option><option>Tenis</option><option>Golf</option><option>Squash</option><option>Artes marciales</option><option>Elíptica</option><option>Ciclismo</option><option>Ciclo montañismo</option><option>Natación </option><option>Lanzamiento (jabalina, martillo, disco, bala, béisbol) </option><option>Wáter polo</option><option>Sky</option><option>Actividades manuales como tallar madera, coser, joyería, </option><option>interpretar instrumentos de cuerda (guitarra, piano, violín), percusión. </option><option>Uso de video terminales o videojuegos por fuera de la jornada laboral</option><option>Otro tipo de actividades extralaborales de riesgo como: Levantamiento de cargas, movimientos repetitivos en oficios domésticos
</option>
<option>No Aplica
</option>
</select></div>



<?php
/*
$query = sprintf("SELECT * FROM condicion_salud_pre where estado_condicion_salud_pre=1 order by id_condicion_salud_pre"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	echo '<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ';
	echo ''.$row['nombre_condicion_salud_pre'].'</label>';
	echo "\n\r";
	echo '<select class="form-control" name="'.$row['pre'].'" required>';
	echo '<option selected></option><option>Si</option><option>No</option>';
	echo '</select></div>';
	echo "\n\r";

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
*/
?>


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
<label  class="control-label">52. Por favor cargar en un solo PDF el soporte  médico actualizado Vigencia NO superior a  3  meses de antigüedad  de la(s)  patología(s)  reportadas  en la  parte superior.  (Resumen de atención por especialistas,  orden de medicamentos,  resultados de laboratorio clínico, epicrisis por estancia hospitalaria u hospitalización).  Únicamente documentos  respaldados por su  EPS o PREPAGADA,
: </label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="">
<span style="color:#B40404;font-size:13px;">PDF inferior a 10 Mg</span>

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




<?php } else { }


} else {} ?>




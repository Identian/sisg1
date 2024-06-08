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
 
 

$nump111=privilegios(111,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { 


function disciplina($disciplina) {
global $mysqli;
$query4png = sprintf("SELECT count(id_olimpiada) as contador FROM olimpiada where nombre_olimpiada='$disciplina' and estado_olimpiada=1"); 
$result4png = $mysqli->query($query4png);
$row4png = $result4png->fetch_array();
$respng=$row4png['contador'];
return $respng;
$result4png->free();
}





/*
if ((isset($_POST["id_funcionariog"])) && (""!=$_POST["id_olimpiadag"]) && 
(1==$_SESSION['rol'] or 0<$nump111)) {


if (1==2) {	

$updateSQL7799m = sprintf("UPDATE olimpiada SET id_categoria_olimpiada=%s, id_modalidad_olimpiada=%s, id_sede_olimpiada=%s  
WHERE id_funcionario=%s and id_olimpiada=%s and estado_olimpiada=1",                  
					  GetSQLValueString($_POST["id_categoria_olimpiadag"], "text"),
					  GetSQLValueString($_POST["id_modalidad_olimpiadag"], "text"),
					  GetSQLValueString($_POST["id_sede_olimpiadag"], "text"),
					  GetSQLValueString($_POST["id_funcionariog"], "int"),
					  GetSQLValueString($_POST["id_olimpiadag"], "int")
 
					  );
					 // echo $updateSQL7799m;
$Result17799m = mysql_query($updateSQL7799m, $conexion);
  


} else {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, No existen cupos para esta categoria ó modalidad de inscripción..</div>';	
}
	
	
}
*/







if ((isset($_POST["nombre_olimpiada"])) && (""!=$_POST["nombre_olimpiada"]) && 
(1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina'])) {
	
	

$funcionarioedl=$_SESSION['snr']; //$_POST["id_funcionario"];

	
	
	
	
$queryt = sprintf("SELECT count(id_funcionario) as tfuncionario FROM funcionario where (id_cargo=1 or id_cargo=2 or id_cargo=4 or id_cargo=6) and estado_funcionario=1 and id_funcionario=".$funcionarioedl.""); 
$selectt = mysql_query($queryt, $conexion);
$rowtt = mysql_fetch_assoc($selectt);
if (0<$rowtt['tfuncionario']) {

	
	
	
	$query = sprintf("SELECT count(id_olimpiada) as tolimpiada FROM olimpiada where estado_olimpiada=1 and id_funcionario=".$funcionarioedl.""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tolimpiada']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene inscripción activa.</div>';
	
} else {



$reglag2=disciplina($_POST["nombre_olimpiada"]);


if ('Futbol 5 Masculino'==$_POST["nombre_olimpiada"] &&  90>$reglag2) {
$varc=1; } 
else if ('Futbol 5 Femenino'==$_POST["nombre_olimpiada"] && 54>$reglag2) { 
$varc=1; }
else if ('Baloncesto Femenino'==$_POST["nombre_olimpiada"] && 54>$reglag2) { 
$varc=1; }
else if ('Baloncesto Masculino'==$_POST["nombre_olimpiada"] && 54>$reglag2) { 
$varc=1; }
else if ('Voleibol Mixto'==$_POST["nombre_olimpiada"] && 54>$reglag2) { 
$varc=1; }
else if ('Bolos Mixto'==$_POST["nombre_olimpiada"] && 70>$reglag2) { 
$varc=1; }
else if ('Mini tejo Mixto'==$_POST["nombre_olimpiada"] && 70>$reglag2) { 
$varc=1; }
else if ('Atletismo femenino (6,000 mts)'==$_POST["nombre_olimpiada"] && 12>$reglag2) { 
$varc=1; }
else if ('Atletismo masculino (10,000 mts)'==$_POST["nombre_olimpiada"] && 8>$reglag2) { 
$varc=1; }
else if ('Tenis de Mesa masculino'==$_POST["nombre_olimpiada"] && 18>$reglag2) { 
$varc=1; }
else if ('Tenis de Mesa femenino'==$_POST["nombre_olimpiada"] && 8>$reglag2) { 
$varc=1; }
else if ('Natación Masculino (pecho, espalda y libre)'==$_POST["nombre_olimpiada"] && 12>$reglag2) { 
$varc=1; }
else if ('Natación Femenino (pecho, espalda y libre)'==$_POST["nombre_olimpiada"] && 10>$reglag2) { 
$varc=1; }
else if ('Ajedrez'==$_POST["nombre_olimpiada"] && 10>$reglag2) { 
$varc=1; }

else { $varc=0;} 







if (1==$varc) {	

	

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/olimpiada/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'olimpiada-'.$_SESSION['snr'].''.date("YmdGis");

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
  } else {
	$equipo=$_POST["equipo2"];
  }

$insertSQL = sprintf("INSERT INTO olimpiada (
nombre_olimpiada, id_funcionario, equipo, pantalon, camiseta, medias, fecha_olimpiada, url, estado_olimpiada) 
VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString($_POST["nombre_olimpiada"], "text"), 
GetSQLValueString($funcionarioedl, "int"),
GetSQLValueString($equipo, "text"),
GetSQLValueString($_POST["pantalon"], "text"),
GetSQLValueString($_POST["camiseta"], "text"),
GetSQLValueString($_POST["medias"], "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);


/*if (1==$_SESSION['rol']) { 
echo $insertSQL.'-'.$_POST["equipo"].'-'.$_POST["equipo2"].'/'.$equipo;
} else {}
*/

  
  echo $insertado;
  
  
  

  $updateSQL = sprintf("UPDATE funcionario SET rh=%s, celular_funcionario=%s, id_estado_civil=%s, fecha_nacimiento=%s  WHERE id_funcionario=%s and estado_funcionario=1",
                        GetSQLValueString($_POST["rh"], "text"),
					   GetSQLValueString($_POST["celular_funcionario"], "text"),
					   GetSQLValueString($_POST["id_estado_civil"], "text"),
					     GetSQLValueString($_POST["fecha_nacimiento"], "date"),
					    GetSQLValueString($funcionarioedl, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);






  
  
  
   
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
              <h3><?php $todaolimpiada=existencia('olimpiada'); 
            echo $todaolimpiada;			  ?></h3>

              <p>Registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
	
            <a href="#" data-toggle="modal" data-target="#popupactualizarolimpiada" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>14</h3>

              <p>Disciplinas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" data-toggle="modal" data-target="#popupactualizarolimpiada2" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
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
	if (500<=$todaolimpiada) { echo 'Cupos completados'; } else {
	?>

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">
 
  
  <p>
<b> Formulario de solicitud Olimpiadas Deportivas 2022:</b>
La Superintendencia de Notariado y Registro, continúa trabajando en el compromiso de mejorar la calidad de vida de sus funcionarios. Para esto, ha establecido el deporte como un proceso permanente, orientado a crear, mantener y mejorar acciones que favorezcan el desarrollo integral de los servidores públicos de la SNR, enfocado en salud, vivienda, recreación, deporte, cultura y educación para la vida como ejes fundamentales para el incremento del salario emocional y sentido de pertenencia. 

<br>
 <a href="documentos/olimpiadassnr2022.pdf" target="_blank">Ver Terminos y condiciones completo.</a>
 <br>
<b>Objetivos: </b>
Promover la integración y el sentido de pertenencia de los servidores de la SNR mediante la práctica del deporte y juegos tradicionales
 <br>
Motivar la práctica del deporte y la actividad física en los servidores de la entidad, como estrategia para el cuidado de la salud integral.  
 <br>
Propiciar espacios y encuentros de sana diversión en un ambiente no laboral que permita la recuperación y práctica de los valores institucionales: honestidad, respeto, tolerancia, equidad y solidaridad.  

<br>
  Sus datos personales están protegidos por la ley 1581 de 2012 donde al diligenciar el formulario acepta el uso de datos personales y el envío de información relacionada con el Grupo de Bienestar y Gestión del Conocimiento.
  <br>
  
  </p>
  
  
<?php  if ((1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) && 1==2) { // or 3>$_SESSION['snr_tipo_oficina']?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> Olimpiadas Deportivas 2022 
	  
	  
	 <?php if (isset($_GET['i'])) { 
	 echo ' / ';
//echo quees('oficina_registro',$idorip);
 } else {
 
 } 
 ?>
	  </h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Inscripción</th>
		<th>Funcionario</th>
		
		<th>Celular</th>
				  <th>Regional</th>
				  <th>Oficina</th>
				   <th>Disciplina</th>
				  <th>Equipo</th>
				  
				  <th>Pantalon</th>		
				   <th>Camiseta</th>
 <th>Medias</th>				   
<th style="width:45px;"></th>		  
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
 


if (1==$_SESSION['rol'] or 0<$nump111) {
$query4="SELECT * from olimpiada, funcionario where olimpiada.id_funcionario=funcionario.id_funcionario and estado_olimpiada=1 ".$infop." ORDER BY id_olimpiada desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from olimpiada, funcionario where olimpiada.id_funcionario=funcionario.id_funcionario and estado_olimpiada=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_olimpiada desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_olimpiada'];
echo '<td>'.$row['fecha_olimpiada'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';


echo '<td>';
echo $row['celular_funcionario'];
echo '</td>';


if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
	
}

echo '<td>'.$row['nombre_olimpiada'].'</td>';
echo '<td>';
if (1==$row['equipo']) { echo 'No tiene equipo'; } else { echo $row['equipo'];}
echo '</td>';
echo '<td>'.$row['pantalon'].'</td>';

echo '<td>'.$row['camiseta'].'</td>';
echo '<td>'.$row['medias'].'</td>';

echo '<td>';
echo ' <a href="filesnr/olimpiada/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';
	if (1==$_SESSION['rol'] or 0<$nump111) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="olimpiada" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

//echo ' <a href="" class="buscarolimpiada" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizarolimpiada"> <i class="fa fa-edit"></i></a> ';




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
	if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { ?>





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
<select class="form-control" name="nombre_olimpiada" id="nombre_olimpiada" required>
<option value="" selected></option>
<optgroup label="Disciplinas en equipo">
<option>Futbol 5 Masculino</option> 
<option>Futbol 5 Femenino</option> 
<option>Baloncesto Femenino</option> 
<option>Baloncesto Masculino</option> 
<option>Voleibol Mixto</option> 
<option>Bolos Mixto</option>
<option>Mini tejo Mixto</option>
</optgroup>
 <optgroup label="Disciplinas individuales">
<option>Atletismo femenino (6,000 mts)</option> 
<option>Atletismo masculino (10,000 mts)</option> 
<option>Tenis de Mesa masculino</option>  
<option>Tenis de Mesa femenino</option>  
<option>Natación Masculino (pecho, espalda y libre)</option> 
<option>Natación Femenino (pecho, espalda y libre)</option> 
<option>Ajedrez</option> 
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
$query3 = sprintf("SELECT equipo FROM olimpiada where estado_olimpiada=1 and equipo!=1 and equipo is not null group by equipo order by equipo"); 
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



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Ingrese su talla de pantalón y/o pantaloneta:</label> 
<input type="text" class="form-control"  name="pantalon" placeholder="" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Ingrese su talla de camiseta:</label> 
<input type="text" class="form-control"  name="camiseta" placeholder="" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Ingrese su talla de medias:</label> 
<input type="text" class="form-control"  name="medias" placeholder="" required>
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
<label  class="control-label"><span style="color:#ff0000;">*</span> <b>Adjunte en un solo PDF la siguiente documentación:</b><br>

1. Certificado de esquema de vacunación completo (dos dosis o única dosis para el caso de Janssen).
<br>
2. Fotocopia de cédula de ciudadanía legible.  
<br>
3. Certificado médico de la EPS que corrobore que es una persona apta para participar de las olimpiadas deportivas de la SNR, de acuerdo con la disciplina deportiva de su elección.  
<br>
</label> 
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
$query3 = sprintf("SELECT nombre_olimpiada, COUNT( * ) Total
FROM olimpiada where estado_olimpiada=1 
GROUP BY nombre_olimpiada
HAVING COUNT( * ) >0"); 
$select3 = mysql_query($query3, $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
do {
	echo '<li>';
	if ('1'==$row3['nombre_olimpiada']) {
		echo 'Sin equipo: ';
	} else {
	echo $row3['nombre_olimpiada'].': ';
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
FROM olimpiada where equipo is not null and estado_olimpiada=1 
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

	  



<?php } else { }

	 } 

} else {} ?>




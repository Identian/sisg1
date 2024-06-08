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


function tipogimnasio($tipo, $clase) {
global $mysqli;
$query4png = sprintf("SELECT count(id_gimnasio) as contadorgim FROM gimnasio where ".$tipo."='$clase' and estado_gimnasio=1"); 
$result4png = $mysqli->query($query4png);
$row4png = $result4png->fetch_array();
$respng=$row4png['contadorgim'];
return $respng;
$result4png->free();
}



if (isset($_GET['i'])) { 
$idorip=$_GET['i'];
 } else {
$idorip=0;  
 } 
 
 

$nump111=privilegios(111,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { 



if ((isset($_POST["id_funcionariog"])) && (""!=$_POST["id_gimnasiog"]) && 
(1==$_SESSION['rol'] or 0<$nump111)) {



if (isset($_POST["id_categoria_gimnasiog"]) && ""!=$_POST["id_categoria_gimnasiog"]) {
$reglag2=tipogimnasio('id_categoria_gimnasio', $_POST["id_categoria_gimnasiog"]);
} else {}
if (isset($_POST["id_modalidad_gimnasiog"]) && ""!=$_POST["id_modalidad_gimnasiog"]) {
$reglag2=tipogimnasio('id_modalidad_gimnasio', $_POST["id_modalidad_gimnasiog"]);
} else {}

// if (1==$_SESSION['rol']) { echo $reglag2.'/'; } else {} 
 

if ('Platino'==$_POST["id_categoria_gimnasiog"] &&  10>$reglag2) {
$varc=1; } 
else if ('One'==$_POST["id_categoria_gimnasiog"] && 17>$reglag2) { 
$varc=1; }
else if ('Premium'==$_POST["id_categoria_gimnasiog"] && 170>$reglag2) { 
$varc=1; }
else if ('Classic'==$_POST["id_categoria_gimnasiog"] && 100>$reglag2) { 
$varc=1; }
else if ('Super'==$_POST["id_categoria_gimnasiog"] && 100>$reglag2) { 
$varc=1; }
else if ('My Coach'==$_POST["id_modalidad_gimnasiog"] && 100>$reglag2) { 
$varc=1; }
else if ('Coach Nutricional'==$_POST["id_modalidad_gimnasiog"] && 100>$reglag2) { 
$varc=1; }
else if ('Entrenamiento Personalizado Online'==$_POST["id_modalidad_gimnasiog"] && 5>$reglag2) { 
$varc=1; }

else { $varc=0;} 

//if (1==$_SESSION['rol']) { echo $varc; } else {} 


if (1==$varc) {	

$updateSQL7799m = sprintf("UPDATE gimnasio SET id_categoria_gimnasio=%s, id_modalidad_gimnasio=%s, id_sede_gimnasio=%s  
WHERE id_funcionario=%s and id_gimnasio=%s and estado_gimnasio=1",                  
					  GetSQLValueString($_POST["id_categoria_gimnasiog"], "text"),
					  GetSQLValueString($_POST["id_modalidad_gimnasiog"], "text"),
					  GetSQLValueString($_POST["id_sede_gimnasiog"], "text"),
					  GetSQLValueString($_POST["id_funcionariog"], "int"),
					  GetSQLValueString($_POST["id_gimnasiog"], "int")
 
					  );
					 // echo $updateSQL7799m;
$Result17799m = mysql_query($updateSQL7799m, $conexion);
  


} else {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, No existen cupos para esta categoria ó modalidad de inscripción..</div>';	
}
	
	
}








if ((isset($_POST["id_pago_gimnasio"])) && (""!=$_POST["id_pago_gimnasio"]) && 
(1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina'])) {
	
	
if (isset($_GET['i'])) { 
$idorip=$_GET['i'];
$funcionarioedl=$_SESSION['snr']; //$_POST["id_funcionario"];
 } else {
$idorip=0;  
$funcionarioedl=$_SESSION['snr'];
 } 
	
	
	
	
		$queryt = sprintf("SELECT count(id_funcionario) as tfuncionario FROM funcionario where (id_cargo=1 or id_cargo=2 or id_cargo=4 or id_cargo=6) and estado_funcionario=1 and id_funcionario=".$funcionarioedl.""); 
$selectt = mysql_query($queryt, $conexion);
$rowtt = mysql_fetch_assoc($selectt);
if (0<$rowtt['tfuncionario']) {

	
	
	
	$query = sprintf("SELECT count(id_gimnasio) as tgimnasio FROM gimnasio where estado_gimnasio=1 and id_funcionario=".$funcionarioedl.""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tgimnasio']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene inscripción activa.</div>';
	
} else {


if (isset($_POST["id_categoria_gimnasio"]) && ""!=$_POST["id_categoria_gimnasio"]) {
$reglag=tipogimnasio('id_categoria_gimnasio', $_POST["id_categoria_gimnasio"]);
} else {}
if (isset($_POST["id_modalidad_gimnasio"]) && ""!=$_POST["id_modalidad_gimnasio"]) {
$reglag=tipogimnasio('id_modalidad_gimnasio', $_POST["id_modalidad_gimnasio"]);
} else {}

 if (1==$_SESSION['rol']) { echo $reglag.'/'; } else {} 
 

if ('Platino'==$_POST["id_categoria_gimnasio"] &&  10>$reglag) {
$varc=1; } 
else if ('One'==$_POST["id_categoria_gimnasio"] && 15>$reglag) { 
$varc=1; }
else if ('Premium'==$_POST["id_categoria_gimnasio"] && 170>$reglag) { 
$varc=1; }
else if ('Classic'==$_POST["id_categoria_gimnasio"] && 100>$reglag) { 
$varc=1; }
else if ('Super'==$_POST["id_categoria_gimnasio"] && 100>$reglag) { 
$varc=1; }
else if ('My Coach'==$_POST["id_modalidad_gimnasio"] && 100>$reglag) { 
$varc=1; }
else if ('Coach Nutricional'==$_POST["id_modalidad_gimnasio"] && 100>$reglag) { 
$varc=1; }
else if ('Entrenamiento Personalizado Online'==$_POST["id_modalidad_gimnasio"] && 5>$reglag) { 
$varc=1; }

else { $varc=0;} 

	 if (1==$_SESSION['rol']) { echo $varc; } else {} 


if (1==$varc) {
	

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/gimnasio/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'gimnasio-'.$_SESSION['snr'].''.date("YmdGis");

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
  

$insertSQL = sprintf("INSERT INTO gimnasio (
nombre_gimnasio, id_funcionario, id_categoria_gimnasio, id_sede_gimnasio, id_modalidad_gimnasio, id_pago_gimnasio, fecha_gimnasio, url, estado_gimnasio) 
VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString($_POST["nombre_gimnasio"], "text"), 
GetSQLValueString($funcionarioedl, "int"),
GetSQLValueString($_POST["id_categoria_gimnasio"], "text"),
GetSQLValueString($_POST["id_sede_gimnasio"], "text"),
GetSQLValueString($_POST["id_modalidad_gimnasio"], "text"),
GetSQLValueString($_POST["id_pago_gimnasio"], "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);


  
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
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, No existen cupos para esta categoria ó modalidad de inscripción..</div>';	
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
              <h3><?php echo existencia('gimnasio'); ?></h3>

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
 
  
  <p>
<b>  Inscripción Gimnasio  2022:</b>
En cumplimiento con lo establecido en el Plan de Bienestar e Incentivos de la Superintendencia de Notariado y Registro, y con lo señalado en el Programa de Recreación y Deportes, decreto 1567 de 1998, articulo 23, abre la convocatoria a los servidores públicos para que se inscriban en gimnasio.  
 <br>
 <a href="documentos/TCgimnasio.pdf" target="_blank">Ver Terminos y condiciones completo.</a>
 <br>
<b>Objetivo: </b>
Contribuir a la mejora de la calidad de vida de los servidores públicos a través de la actividad física, con el fin de que mantener un buen estado físico y mental.
  <br>
  Sus datos personales están protegidos por la ley 1581 de 2012 donde al diligenciar el formulario acepta el uso de datos personales y el envío de información relacionada con el Grupo de Bienestar y Gestión del Conocimiento.
  <br>
  
  </p>
  
  
<?php  if (1==$_SESSION['rol']) { // or 3>$_SESSION['snr_tipo_oficina']?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> Gimnasio 2022 
	  
	  
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
		<th>Edad</th>
		<th>Celular</th>
				  <th>Regional</th>
				  <th>Oficina</th>
				   <th>Modalidad</th>
				  <th>Categoria</th>
				  
				  <th>Sede</th>		
				   <th>Pago</th>		
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
$query4="SELECT * from gimnasio, funcionario where gimnasio.id_funcionario=funcionario.id_funcionario and estado_gimnasio=1 ".$infop." ORDER BY id_gimnasio desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from gimnasio, funcionario where gimnasio.id_funcionario=funcionario.id_funcionario and estado_gimnasio=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_gimnasio desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_gimnasio'];
echo '<td>'.$row['fecha_gimnasio'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>';
echo calculaedad($row['fecha_nacimiento']);
echo '</td>';

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

echo '<td>'.$row['id_modalidad_gimnasio'].'</td>';
echo '<td>'.$row['id_categoria_gimnasio'].'</td>';

echo '<td>'.$row['id_sede_gimnasio'].'</td>';
echo '<td>'.$row['id_pago_gimnasio'].'</td>';
echo '<td>';
echo ' <a href="filesnr/gimnasio/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';
	if (1==$_SESSION['rol'] or 0<$nump111) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="gimnasio" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

echo ' <a href="" class="buscargimnasio" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizargimnasio"> <i class="fa fa-edit"></i></a> ';




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


<?php if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { ?>





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






<?php 
$oficinar=$_SESSION['id_oficina_registro'];

if (1==$_SESSION['snr_tipo_oficina']  or 107==$oficinar or 3==$oficinar or 42==$oficinar or 59==$oficinar or 62==$oficinar or 67==$oficinar or 74==$oficinar or 77==$oficinar or 101==$oficinar or 111==$oficinar or 113==$oficinar or 116==$oficinar or 122==$oficinar or 131==$oficinar or 134==$oficinar or 138==$oficinar or 148==$oficinar or 185==$oficinar or 187==$oficinar or 10==$oficinar or 11==$oficinar or 12==$oficinar or 30==$oficinar or 57==$oficinar) { ?>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de inscripción:</label> 
<select class="form-control" id="tipo_gimnasio" required>
<option value="1" selected>Presencial</option>
<option value="0">Virtual</option>
</select>
</div>


<div class="form-group text-left" id="categoria_gimnasio"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Categorias de inscripción: (Presencial)</label> 
<select name="id_categoria_gimnasio" id="id_categoria_gimnasio" class="form-control" required>
<option selected></option>
<?php if (1==$_SESSION['rol']) { ?><option>Platino</option><?php } else {} ?>
<option>One</option>
<option>Premium</option>
<option>Classic</option>
<option>Super</option>
</select>
</div>


<div class="form-group text-left" id="modalidad_gimnasio" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipos de modalidades virtuales: (Virtual)</label> 
<select name="id_modalidad_gimnasio" id="id_modalidad_gimnasio"  class="form-control">
<option selected></option>
<option>My Coach</option>
<option>Coach Nutricional</option>
<option>Entrenamiento Personalizado Online</option>
</select>
</div>




<div class="form-group text-left" id="sede_gimnasio"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Sede en la cual esta interesado: (<a href="https://bodytech.com.co/sedes" target="_blank">Ver mapa</a>)</label> 
<select name="id_sede_gimnasio" class="form-control" id="id_sede_gimnasio" required>
<option selected></option>
<option>ARMENIA, ARMENIA, CARRERA 6 NO 3 - 180 CENTRO COMERCIAL CALIMA, LOCAL: 223</option>
<option>BOGOTÁ, CABRERA, CALLE 85 # 7-13</option>
<option>BOGOTÁ, CHICO, AVENIDA 19 # 102 - 31 PISO 3</option>
<option>BOGOTÁ, CARRERA 11, CALLE 96#10-38</option>
<option>BOGOTÁ, CALLE 90, CALLE 90 # 16-30</option>
<option>BOGOTÁ, FONTANAR, KILOMETRO 2.5 VIA CHIA-CAJICA PRIMER PISO COSTADO SUR</option>
<option>BOGOTÁ, HACIENDA, CALLE 116 CON AVENIDA SEPTIMA CC HACIENDA SANTA BARARA SOTANO 1</option>
<option>BOGOTÁ, COLINA, CALLE 138 N° 58 - 74</option>
<option>BOGOTÁ, PASADENA, CRA 53 N°101 A - 37 C.C. LOS TRES ELEFANTES PISO 2</option>
<option>BOGOTÁ, CHAPINERO, CRA 7 # 63-25</option>
<option>BOGOTÁ, CEDRITOS, CALLE 147 # 7 - 52</option>
<option>BOGOTÁ, TORRE CENTRAL, CLL 26 # 68C-61 LOCAL 116</option>
<option>BOGOTÁ, SANTA ANA, AV 9 # 110-20  CENTRO COMERCIAL SANTA ANA</option>
<option>BOGOTÁ, BULEVAR, AVENIDA CARRERA 58 #127-59 LOCAL 181 B CC BULEVAR </option>
<option>BOGOTÁ, GRAN ESTACION, CENTRO COMERCIAL GRAN ESTACIÓN AV. CALLE 26 #62-47 TERCER PISO AL LADO DE CINE COLOMBIA.</option>
<option>BOGOTÁ, CHIA, CC. PLAZA MAYOR AVENIDA PRADILLA N 5-31 E LOCAL 121</option>
<option>BOGOTÁ, AUTOPISTA 134, CALLE 134 A # 23 - 72</option>
<option>BOGOTÁ, COUNTRY  138, CALLE 138 N# 10 A - 42</option>
<option>BOGOTÁ, FLORESTA, AVENDIA 68 # 90 -88 NIVEL 0 CENTRO COMERCIAL FLORESTA</option>
<option>BOGOTÁ, AUTOPISTA 170, CARRERA 23 N° 166 - 59// AUTP NORTE # 167-10</option>
<option>BOGOTÁ, GALERIAS, PISO 6, CRA. 24 #53 - 73, BOGOTÁ CC PLAZA 54</option>
<option>BOGOTÁ, TITAN PLAZA, CENTRO COMERCIAL TITAN PLAZA AV CARRERA 72#80-94 LOCAL 427 </option>
<option>BOGOTÁ, CENTRO MAYOR, CALLE 38ª SUR N° 34D - 51 LOCAL 3058</option>
<option>BOGOTÁ, SULTANA, CLL 12 SUR # 31 -33</option>
<option>BOGOTÁ, HAYUELOS, C.C. HAYUELOS CALLE 20 NO 82 - 52 LOCAL 4-59</option>
<option>BOGOTÁ, PABLO VI, CRA 52 BIS # 56B -26</option>
<option>BOGOTÁ, NORMANDIA, AV. BOYACA 49 29 PISO 2</option>
<option>BOGOTÁ, PLAZA CENTRAL, CARRERA 65 # 11 – 50 (AVENIDA DE LAS AMÉRICAS Y CALLE 13) PISO 3. LOCAL 3-28 | BOGOTÁ – COLOMBIA</option>
<option>BOGOTÁ, ENSUEÑO, CARRERA 51 # 59C SUR 93A</option>
<option>BOGOTÁ, PASEO DEL RIO, CL. 57D SUR #78H 14</option>
<option>BOGOTÁ, PORTAL 80, TRV  100A # 80A-20</option>
<option>BOGOTÁ, DIVERPLAZA, TRANSVERSAL 96 # 70 A - 85 TERRAZA CUARTO  PISO</option>
<option>BOGOTÁ, KENNEDY, TRANS. 78J # 41F-05 SUR</option>
<option>BOGOTÁ, PLAZA BOSA, CALLE 65 SUR 78 H -51 LOCAL 314</option>
<option>BOGOTÁ, SUBA, AV CRA 104 #148 - 07 LOC 269 C. C PLAZA IMPERIAL</option>
<option>SOACHA, TERREROS, CRA. 1 NO. 38-53 LOCAL 4-16 VENTURA-TERCER PISO</option>
<option>SOACHA, ANTARES, ANTARES AUTOPISTA SUR CARRERA 4 # 26- 55 SUR MUNICIPIO SOACHA</option>
<option>BARRANQUILLA, PARQUE WASHINGTON, CENTRO COMERCIAL ROYAL WASHIGNTON CARRERA 53 NO 79-279</option>
<option>BARRANQUILLA, VIVA BARRANQUILLA, CRA 51B NO 87 - 50 - CENTRO COMERCIAL VIVA</option>
<option>BARRANQUILLA, MIRAMAR, CRA 43 # 99-50 CC MIRAMAR PISO 3 LOCAL 301-302</option>
<option>BARRANQUILLA, RECREO, CRA. 43 NO. 60-25 BARRANQUILLA - COLOMBIA</option>
<option>BARRANQUILLA, SOLEDAD, CARRERA 32 N 30 15 PISO 3  C,C GRAN PLAZA DEL SOL</option>
<option>BARRANQUILLA, MURILLO, CALLE. 45 (MURILLO) NO. 21-18 PISO 2 ,3 ,4| BARRANQUILLA - COLOMBIA</option>
<option>BUCARAMANGA, CARACOLI, CARRERA 27 N 29 145 LOCAL 503 PARQUE CARACOLI</option>
<option>BUCARAMANGA, CACIQUE, TRANSVERSAL 93 #34 99 CENTRO COMERCILAL CACIQUE LOCAL 420</option>
<option>BUCARAMANGA, MEGAMALL, CARRERA 33 A # 30A 19 LOCAL 301</option>
<option>CALI, OESTE, CALLE 7 OESTE # 1A - 59 BARRIO SANTA TERESITA </option>
<option>CALI, JARDIN PLAZA, CARRERA 98 #16-200 LOC.202 C,C JARDIN PLAZA</option>
<option>CALI, CHIPICHAPE, CALLE 38 N # 6N - 35 LOCAL 8-246. CENTRO COMERCIAL CHIPICHAPE</option>
<option>CALI, CANEY, CALLE 48# 85-54</option>
<option>CALI, LIMONAR, CALLE 5 #69-09 CENTRO COMERCIAL PREMIER LIMONAR LOCAL 401</option>

<option>CARTAGENA, BOCAGRANDE, BOCAGRANDE AV EL MALECON CC. PLAZA BOCAGRANDE PISO 5 </option>
<option>CARTAGENA, CARIBE PLAZA, CLL. 29D NO. 22-62 LOCAL 225 | CARTAGENA - COLOMBIA BARRIO PIE DE LA POPA</option>
<option>CARTAGENA, PLAZUELA, C.C. LA PLAZUELA CALLE 71 #29 -236 LOCALES 1-5 </option>
<option>CARTAGENA, EJECUTIVOS, SUPER CENTRO LOS EJECUTIVOS 2 PISO CALLE 31#57-106</option>


<option>MEDELLIN, SANTA MARIA DE LOS ÁNGELES, CRA 46 # 16 SUR-67 </option>
<option>MEDELLIN, VIZCAYA, CLL 10 # 32-115 INT 127 </option>
<option>MEDELLIN, RIO SUR, CRA 43A N° 6 SUR - 26 CC. RÍO SUR - PISO 6</option>
<option>MEDELLIN, LLANOGRANDE, CENTRO COMERCIAL JARDINES DE LLANOGRANDE</option>
<option>MEDELLIN, MALL DEL ESTE, CRA 25 # 3-45 SOTANO 3</option>
<option>MEDELLIN, SAN LUCAS, CLL 20 SUR # 27-115 SÓTANO 4  </option>
<option>MEDELLIN, VILLAGRANDE, TRANS 27 A SUR 42B 60</option>
<option>MEDELLIN, LAURELES, CLL 66B # 32 D - 36</option>
<option>MEDELLIN, AMERICAS, DG 75B   2A-120 L.227</option>
<option>MEDELLIN, CITY PLAZA, CLL 36D SUR N 27A-105 LC 340</option>
<option>MEDELLIN, PREMIUM PLAZA, CRA 42 A # 30 - 25 LC 3189</option>
<option>MEDELLIN, ROBLEDO, CRA 80 N° 64 – 61 INTERIOR ÉXITO ROBLEDO  </option>
<option>MEDELLIN, SAN JUAN, CRA 84 # 44-54 INT. 201</option>
<option>MEDELLIN, CAMINO REAL, AV. ORIENTAL CRA. 46 NO. 52 - 95 LC 401</option>
<option>MEDELLIN, AVENIDA COLOMBIA, CLL 50 # 66-50</option>
<option>MEDELLIN, ENVIGADO, DG 40 # 33 SUR 48</option>
<option>MEDELLIN, NIQUIA, CC TIERRAGRO DIA 50 A # 38- 20, BELLO</option>
<option>MEDELLIN, BELEN, CLL 32 # 75-50 </option>
<option>MONTERIA, NUESTRO MONTERIA, TRANSVERSAL 29 # 29-69 CENTRO COMERCIAL NUESTRO MONTERIA</option>
<option>RIONEGRO, LLANOGRANDE, CENTRO COMERCIAL JARDINES DE LLANOGRANDE</option>
<option>PASTO, PASTO, CALLE 22B # 2 - 63//67 ÉXITO PANAMERICA</option>
<option>PALMIRA, PALMIRA, "CALLE 31 # 44-239 LLANOGRANDE PLAZA</option>
<option>PEREIRA, PEREIRA, AV CIRCUNVALAR CRA 13 Nº 12 B-25 EDIFICIO UNIPLEX PISO 5 Y 6</option>
<option>PEREIRA, DOS QUEBRADAS, CARRERA 16 # 43 CC EL PROGRESO LOCAL 208</option>
<option>TUNJA, CALLE 37 N. 6-20</option>
<option>TULUA, TULUA, CRA 40 #37-51 CENTRO COMERCIAL TULUA LA 14 LOCAL MESANINE H</option>
<option>MANIZALES, SANCANCIO, C.C. SANCANCIO CRA 27A # 66 - 30 </option>
<option>CUCUTA, CAOBOS, CALLE 11 # 2E-10 BARRIO CAOBOS CENTRO COMERCILA QUINTA VELEZ (3) PISO LOCAL 301</option>
<option>IBAGUE, IBAGUE, CLL 60 CON  AV AMBALA CENTRO COMERCIASL LA ESTACION LOCAL  302</option>
<option>VALLEDUPAR, MAYALES, CENTRO COMERCIAL MAYALES CALLE 31 NO 6-133</option>
<option>VILLAVICENCIO, LLANOCENTRO, CRA 39 C N°29C-15 BARRIO BALATA CC LLANOCENTRO LOCAL 3001</option>
<option>VILLAVICENCIO, VIVA VILLAVICENCIO, CALLE 7#45-185 CENTRO COMERCIAL VIVA VILLAVICENCIO BARRIO LA ESPERANZA</option>
<option>NEIVA, NEIVA, KRA 8A N- 38-42 C.C SAN PEDRO PLAZA LOCAL 291</option>


</select>
</div>


<?php } else { ?>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de inscripción:</label> 
<input type="text" class="form-control" readonly value="Virtual">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipos de modalidades virtuales:</label> 
<select name="id_modalidad_gimnasio" class="form-control" required>
<option selected></option>
<option>My Coach</option>
<option>Coach Nutricional</option>
<option>Entrenamiento Personalizado Online</option>
</select>
</div>

<?php } ?>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>  Opción de pago: (Autorizo el descuento a la SNR del 30% del valor de la afiliación por un año para el beneficio del gimnasio y este no será reembolsable por ningún motivo. )</label> 
<select name="id_pago_gimnasio" class="form-control" required>
<option selected></option>
<option>Un solo pago a través de la prima de julio de 2022</option>
<option>Tres pagos con descuento de nómina en los meses abril, mayo y junio de 2022</option>
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
<label  class="control-label"><span style="color:#ff0000;">*</span> <b>Adjunte en un solo PDF la siguiente documentación:</b><br>
1.  Certificado de esquema de vacunación completo (dos dosis ó única dosis).<br>
2.  Fotocopia de cédula de ciudadanía legible.:</label> 
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





<div class="modal fade" id="popupactualizargimnasio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar</b></h4>
</div> 
<div id="ver_actualizargimnasio" class="modal-body"> 

</div>
</div> 
</div> 
</div>



	  



<?php } else { }


} else {} ?>




<?php
if (1==2) {
$nump115=privilegios(115,$_SESSION['snr']);


if (((1==$_SESSION['rol'] or 0<$nump115)) or (2==$_SESSION['snr_tipo_oficina'] && isset($_SESSION['id_oficina_registro']))) { 

if ((1==$_SESSION['rol'] or 0<$nump115) && isset($_GET['i']) && ""!=$_GET['i']) {
	$ofi=intval($_GET['i']);
} else {
	$ofi=$_SESSION['id_oficina_registro'];
}



function ronda($cate,$mun,$dep){
global $mysqli;
$query = "SELECT id_ronda_reparto from ronda_reparto where id_categoria_reparto=".$cate." 
and mun=".$mun." and dep=".$dep." 
and estado_ronda_reparto=1 order by id_ronda_reparto desc limit 1 ";

$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)) {
$cuentar=$row['id_ronda_reparto'];
} else {
echo crearronda($cate,$mun,$dep);

$query3 = "SELECT id_ronda_reparto from ronda_reparto where id_categoria_reparto=".$cate." 
and mun=".$mun." and dep=".$dep." 
and estado_ronda_reparto=1 order by id_ronda_reparto desc limit 1 ";
$result3 = $mysqli->query($query3);
$row3 = $result3->fetch_array();
$cuentar=$row3['id_ronda_reparto'];
}
$result->free();
return $cuentar;
}


function crearronda($catego,$mun,$dep) {
global $mysqli;
$query4pn = sprintf("INSERT INTO ronda_reparto (id_categoria_reparto, mun, dep, estado_ronda_reparto)
VALUES ($catego, $mun, $dep, 1)"); 
$result4pn = $mysqli->query($query4pn);
$respn=''; //ronda($catego,$mun,$dep);
return $respn;
$result4pn->free();
}


function cuenta($mun,$dep,$cat,$ron){
global $mysqli;
$query = "SELECT count(id_notaria) as ccnn FROM notaria
WHERE id_notaria not in (SELECT id_notaria FROM reparto 
WHERE id_categoria_reparto=".$cat." and id_ronda_reparto=".$ron."   
and id_notaria IS NOT null) and id_departamento=".$dep." and codigo_municipio=".$mun." and estado_notaria=1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
$cuenta=$row['ccnn'];
if (0<$cuenta){
} else {
	echo crearronda($cat,$mun,$dep);
}
$result->free();
return $cuenta;
}




function correonotaria($nota) {
global $mysqli;
$nb = sprintf("select email_notaria from notaria where id_notaria=".$nota." and estado_notaria=1"); 
$resultnb = $mysqli->query($nb);
$rown = $resultnb->fetch_array();
$not=$rown['email_notaria'];
return $not;
$resultnb->free();
}



if (isset($_POST['id_reparto2']) && ""!=$_POST['id_reparto2']) {
	$reparto=intval($_POST['id_reparto2']);
	
	
$query_update2 = "SELECT reparto.id_reparto, nombre_reparto, correos_intervinientes, id_categoria_reparto, id_departamento, id_municipio, nombre_entidad_reparto, correo_entidad  
FROM reparto, entidad_reparto  WHERE reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto and reparto.id_reparto=".$reparto."  and estado_reparto=1 limit 1";
$update2 = mysql_query($query_update2, $conexion);
$row_update2 = mysql_fetch_assoc($update2);
$totalRows_update2 = mysql_num_rows($update2);
if (0<$totalRows_update2){
	
	$id_reparto=$row_update2['id_reparto'];
	$nombre_entidad_reparto=$row_update2['nombre_entidad_reparto'];
	$nombre_reparto=$row_update2['nombre_reparto'];
	$correo_entidad=$row_update2['correo_entidad'];
	$correos_intervinientes=$row_update2['correos_intervinientes'];
	$id_categoria_reparto=$row_update2['id_categoria_reparto'];
	$id_departamento=$row_update2['id_departamento'];
	$id_municipio=$row_update2['id_municipio'];
	
$ronda=ronda($id_categoria_reparto,$id_municipio,$id_departamento);

$num=cuenta($id_municipio,$id_departamento,$id_categoria_reparto,$ronda);

$ronda=ronda($id_categoria_reparto,$id_municipio,$id_departamento);

$query2 = sprintf("SELECT id_notaria FROM notaria
WHERE id_notaria not in (SELECT id_notaria FROM reparto 
WHERE id_categoria_reparto=".$id_categoria_reparto." and id_ronda_reparto=".$ronda."  
and id_notaria IS NOT null) and id_departamento=".$id_departamento." and codigo_municipio=".$id_municipio." and estado_notaria=1 ORDER BY RAND() LIMIT 1");

$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
$notaria=$row2['id_notaria'];

mysql_free_result($update2);
mysql_free_result($select2);




$unico=$id_categoria_reparto.$ronda.$notaria;

$fechareparto=date('Y-m-d H:i:s');
$hash=md5($reparto.'-'.$id_categoria_reparto.'-'.$ronda.'-'.$notaria.'-'.$fechareparto);
  $updateSQL = sprintf("UPDATE reparto SET fecha_reparto=%s, id_notaria=%s, id_ronda_reparto=%s, unico=%s, hash=%s WHERE id_reparto=%s and estado_reparto=1 and id_notaria is null",
                   GetSQLValueString($fechareparto, "date"),					  
					  GetSQLValueString($notaria, "int"),
					     GetSQLValueString($ronda, "int"),
						  GetSQLValueString($unico, "int"),
						  GetSQLValueString($hash, "text"),
					    GetSQLValueString($reparto, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);



$correonotaria=correonotaria($notaria);

//$emailu=''.$correo_entidad.','.$correonotaria.','.$correos_intervinientes;
$emailu=''.$correos_intervinientes;
$subject = 'Test Reparto realizado.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Se realizo un reparto de posesion regular <br>";
$cuerpo .= "<br><br>Se ha enviado la notificación del acta de reparto a: ".$emailu;
$cuerpo .= "<br><br>Fecha y hora del acta de reparto: ".$fechareparto;
$cuerpo .= '<br><br>Enlace del acta: <a href="https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash.'.pdf">https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash.'.pdf</a><br>';
$cuerpo .= "<br><br>Notaria seleccionada: ".quees('notaria',$notaria)."<br>";
$cuerpo .= "<br><br>Categoria de reparto: ".quees('categoria_reparto',$id_categoria_reparto)."<br>";
$cuerpo .= "<br><br>Hash de seguridad: ".$hash."<br>";
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'cc: reparto.notarial@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);



} else {}


} else {}







if ((isset($_POST["fecha_ingreso"])) && (""!=$_POST["fecha_ingreso"])) {
	
	

$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/reparto/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'reparto-'.$_SESSION['snr'].''.date("YmdGis");

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
  
  
  




  
 
$fecha_ingreso= $_POST["fecha_ingreso"];

if ($realdate>=$fecha_ingreso) {

  $mun=explode('-',$_POST["mun"]);
  $depa=$mun[0];
$munci=$mun[1];

$insertSQL = sprintf("INSERT INTO reparto (
fecha_registro, fecha_ingreso, id_entidad_reparto, id_oficina_registro, id_departamento, id_municipio,  
direccion_reparto, matriculas, actos, intervinientes, correos_intervinientes, observaciones, 
url, 
unidades, id_categoria_reparto, estado_reparto) 
VALUES (now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($fecha_ingreso, "date"), 
GetSQLValueString(1293, "int"),
GetSQLValueString($ofi, "int"),
GetSQLValueString($depa, "int"),
GetSQLValueString($munci, "int"),
GetSQLValueString($_POST["direccion_reparto"], "text"),
GetSQLValueString($_POST["matriculas"], "text"),
GetSQLValueString($_POST["actos"], "text"),
GetSQLValueString($_POST["intervinientes"], "text"),
GetSQLValueString($_POST["correos_intervinientes"], "text"),
GetSQLValueString($_POST["observaciones"], "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString($_POST["unidades"], "int"),
GetSQLValueString(7, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
 
  echo $insertado;
  
    } else {  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>La fecha de registro no puede ser superior a hoy.</div>';
  }
  
  

  
  

   
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
  
	
 
}
 else { }
 


?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('reparto'); ?></h3>

              <p>Registros a nivel nacional</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="https://sisg.supernotariado.gov.co/xls/posesion_regular.xls" class="small-box-footer">Reporte<i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3><?php echo existencia('notaria'); ?></h3>
			  
              <p>Notarias</p>
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
              <h3><?php //echo cuenta('1','52','8','1');?>195</h3>
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
 

    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> Reparto de posesion regular para <?php echo quees('oficina_registro', $ofi);?>
	  
	  </h3>
	  

	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Id</th>
 <th>Fecha registro</th>
 <th>Oficina</th>
 <th>Departamento</th>
 <th>Municipio</th>
 <th>Categoria</th>
 <th>Ronda</th>

<th></th>			 	
<th style="width:150px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 
if ((1==$_SESSION['rol'] or 0<$nump115)) {
$query4="SELECT * from reparto, departamento, categoria_reparto where reparto.id_departamento=departamento.id_departamento and reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto and estado_reparto=1 and id_entidad_reparto=1293 ORDER BY id_reparto desc  "; 
} else {
$query4="SELECT * from reparto, departamento, categoria_reparto where reparto.id_departamento=departamento.id_departamento and reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto and estado_reparto=1 and id_entidad_reparto=1293 and id_oficina_registro=".$ofi." ORDER BY id_reparto desc  "; 
}
	 
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_reparto'];

echo '<td>'.$id_res.'</td>';
echo '<td>'.$row['fecha_ingreso'].'</td>';
echo '<td>';
if (0==$row['id_oficina_registro']) {
	echo 'Dir. Admin. Notarial';
} else {
echo quees('oficina_registro',$row['id_oficina_registro']);
}
echo '</td>';
echo '<td title="'.$row['id_departamento'].'">'.$row['nombre_departamento'].'</td>';
echo '<td title="'.$row['id_municipio'].'">';
echo nombre_municipio($row['id_municipio'], $row['id_departamento']);
echo '</td>';

echo '<td>'.$row['nombre_categoria_reparto'].'</td>';
echo '<td>'.$row['id_ronda_reparto'].'</td>';


echo '<td>';
if (isset($row['id_notaria']) && ""!=$row['id_notaria']) {
	echo quees('notaria',$row['id_notaria']);
} else {
$mun=$row['id_municipio'].'-'.$row['id_departamento'];
echo ' <a href="" class="buscar_reparto" id="'.$id_res.'" title="Reparto" data-toggle="modal" data-target="#popupreparto"><span class="btn btn-xs btn-info">Repartir</span></a> ';

echo ' <a href="" class="buscar_circulonotarial" id="'.$mun.'" title="Circulo Notarial" data-toggle="modal" data-target="#popupcirculonotarial"> <span class="btn btn-xs btn-warning">Notarias</span></a> ';

}

echo '</td><td>';
echo ' <a href=filesnr/reparto/'.$row['url'].' target="_blank"><img src="images/pdf.png"></a>';

if (isset($row['id_notaria']) && ""!=$row['id_notaria']) {
//echo ' <a href="pdf/acta_reparto&'.$id_res.'.pdf"> <span class="btn btn-xs btn-success">Acta</span></a> ';

//echo ' <a href="mailto:'.$row['correos_intervinientes'].'?cc=reparto.notarial@supernotariado.gov.co&subject=Notificacion-Reparto&body=Reparto Notarial"> 
//<span class="btn btn-xs btn-danger">Notificar</span></a> ';
$hash2=$row['hash'];
echo ' <a href="https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash2.'.pdf" download=""> <span class="btn btn-xs btn-success">Acta</span></a> ';

} else {
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="reparto" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
}

	
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
        
<form action="" method="POST" name="for54354r653454332445345464324324563m1" enctype="multipart/form-data" >



 
  <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Solicitud:</label> 
<input type="text" class="form-control datepicker" readonly name="fecha_ingreso" value="">
</div>

 

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Intervinientes (Nombres - cédulas):</label> 
<textarea class="form-control" name="intervinientes" placeholder="Separados por ,"></textarea>
</div>



 <div class="form-group text-left"> 
<label  class="control-label"> Correos electrónicos de los intervinientes:</label> 
<textarea class="form-control" name="correos_intervinientes" placeholder="Separados por , (Si no existen, dejar en blanco.)"></textarea>
</div>




 <div class="form-group text-left"> 
<label  class="control-label">Matriculas relacionadas:</label> 
<textarea class="form-control" name="matriculas" placeholder="Separados por ,"></textarea>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dirección del inmueble:</label> 
<input type="text" class="form-control" name="direccion_reparto" value="" >
</div>


<div class="form-group text-left"> <!-- id="unidades" style="display:none;"-->
<label  class="control-label"><span style="color:#ff0000;" >*</span> Unidades:</label> 
<input type="text" class="form-control numero" name="unidades" value="" required>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Circulo Notarial:</label>   
<select  class="form-control" name="mun" id="mun" required>
<option selected></option>
<?php
$select = mysql_query("SELECT notaria.id_departamento, nombre_departamento, notaria.codigo_municipio, nombre_municipio, divipola, COUNT( * ) Total
FROM notaria, municipio, departamento WHERE municipio.id_departamento=notaria.id_departamento  
and municipio.codigo_municipio=notaria.codigo_municipio and municipio.id_departamento= departamento.id_departamento AND estado_municipio=1 
and id_oficina_registro=".$ofi." and estado_notaria=1
GROUP BY divipola 
HAVING COUNT( * ) >1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_departamento'].'-'.$row['codigo_municipio'].'"';

	echo '>'.$row['nombre_departamento'].' - '.$row['nombre_municipio'].'</option>';
 } while ($row = mysql_fetch_assoc($select)); 
mysql_free_result($select);



/*
$select = mysql_query("SELECT notaria.id_departamento, nombre_departamento, notaria.codigo_municipio, nombre_municipio, divipola, COUNT( * ) Total
FROM notaria, municipio, departamento WHERE municipio.id_departamento=notaria.id_departamento  
and municipio.codigo_municipio=notaria.codigo_municipio and municipio.id_departamento= departamento.id_departamento AND estado_municipio=1 
GROUP BY divipola 
HAVING COUNT( * ) >1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_departamento'].'-'.$row['codigo_municipio'].'"';
	echo '>'.$row['nombre_departamento'].' - '.$row['nombre_municipio'].'</option>';
 } while ($row = mysql_fetch_assoc($select)); 
mysql_free_result($select);*/
?>
</select>
</div>


<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Departamento:</label>   
<select  class="form-control" name="id_departamento" id="id_departamento" required>
<option selected></option>
<?php /*
$select = mysql_query("select * from departamento where estado_departamento=1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_departamento'].'"';

	echo '>'.$row['nombre_departamento'].'</option>';
 } while ($row = mysql_fetch_assoc($select)); 
mysql_free_result($select);
*/
?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Municipio:</label>   

<select  class="form-control" name="id_municipio" id="id_municipio" required>
</select>
</div>
-->


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
<label  class="control-label"><span style="color:#ff0000;">*</span> <b>Adjunte en un solo PDF los soportes:</b><br>


</label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 10 Mg / </span>
<div id="imagePreview"></div>
</div>



 <div class="form-group text-left"> 
<label  class="control-label"> Observaciones:</label> 
<textarea class="form-control" name="observaciones" ></textarea>
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




<div class="modal fade" id="popupreparto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Reparto</b></h4>
</div> 
<div id="ver_reparto" class="modal-body"> 

</div>
</div> 
</div> 
</div>




<div class="modal fade" id="popupcirculonotarial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Notarias del Circulo</b></h4>
</div> 
<div id="ver_circulonotarial" class="modal-body"> 

</div>
</div> 
</div> 
</div>

	  



<?php

} else {}
} else {} ?>




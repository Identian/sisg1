<?php
$nump110=privilegios(110,$_SESSION['snr']);

if (3>$_SESSION['snr_tipo_oficina']) { 


if (isset($_POST['estado']) && ""!=$_POST['estado']) {
	
	if  ("Aprobado"==$_POST['estado']) {
		
		
		
//$dos='SNR2023IE02586'.rand(10,99);

	
	
$tamano_archivo=17301504;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/cuenta_cobro/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'cuenta_cobro-'.$_SESSION['snr'].''.date("YmdGis");

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
   
   
   
   
   
   
	
	
	
$cedulacontratista=$_POST['cedula_contratista'];
$namecontratista=$_POST['nombre_contratista'];
include('pages/iris_cuenta.php'); 

//echo $consultab;

	
	
	$updated = sprintf("UPDATE cuenta_cobro set estado=%s, nombre_cuenta_cobro='$radicado_salida', motivo='$motivo', url=%s, fecha_estado=now() where id_cuenta_cobro=%s",
		
			GetSQLValueString($_POST['estado'], "text"),
			GetSQLValueString($files, "text"),
		GetSQLValueString($_POST['id_cuenta_cobro'], "int"));
      $Resultpd = mysql_query($updated, $conexion);
	  echo $actualizado;
	  
	  
	
	
	//CORRESPONDENCIA
	
	
$insertSQL2 = sprintf("INSERT INTO correspondencia (
nombre_correspondencia, 
referencia, 
cedula_contratista, 
id_tipo_correspondencia, 
id_funcionario_de, 
id_funcionario_para, 
fecha_correspondencia, 
asunto_correspondencia, 
descripcion_correspondencia, 
id_tipo_oficina_de, 
codigo_oficina_de, 
id_tipo_oficina_para, 
codigo_oficina_para, 
ruta_documento, 
estado_correspondencia) VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($radicado_salida, "text"), 
GetSQLValueString('GCC - '.$cedulacontratista.'', "text"), 
GetSQLValueString($cedulacontratista, "int"), 
GetSQLValueString('305', "text"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString(1600, "int"),                        
GetSQLValueString('CUENTA DE COBRO '.$namecontratista.'', "text"), 
GetSQLValueString('CUENTA DE COBRO '.$namecontratista.'', "text"), 
GetSQLValueString(1, "int"), 
GetSQLValueString(19, "int"), 
GetSQLValueString(1, "int"), 
GetSQLValueString(19, "int"), 
GetSQLValueString(''.$files, "text"), 
GetSQLValueString(1, "int"));
$Result33 = mysql_query($insertSQL2, $conexion);


	
	
	

include('pages/iris_cuenta_anexos.php'); 

$idanexoiris=idanexoiris($radicado_salida);

$query4pn = sprintf("SELECT url FROM cuenta_cobro where id_cuenta_cobro=".$_POST['id_cuenta_cobro']." and estado_cuenta_cobro=1 limit 1"); 
$result4pn = $mysqli->query($query4pn);
$row4pn = $result4pn->fetch_array();

echo anexosiris($idanexoiris,'Cuenta de cobro',$row4pn['url']);
echo anexosftpiris($idanexoiris,$row4pn['url']);

$result4pn->free();


	
	  
   
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
  
  
  

		$motivo='';		
		
		
	} else {	
		$dos='';
		$files='';	
		$motivo=$_POST['motivo'];
		
$updated = sprintf("UPDATE cuenta_cobro set estado=%s, nombre_cuenta_cobro='$dos', motivo='$motivo', fecha_estado=now() where id_cuenta_cobro=%s",
		
			GetSQLValueString($_POST['estado'], "text"),
		GetSQLValueString($_POST['id_cuenta_cobro'], "int"));
      $Resultpd = mysql_query($updated, $conexion);
	  echo $actualizado;

$emailu=$_POST['correo_contratista'];
$subject = 'Cuenta de cobro rechazada';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky informa que se ha rechazado la cuenta de cobro. Por favor revisar:<br>";
$cuerpo .= '<br><a href="https://sisg.supernotariado.gov.co/cuenta_cobro.jsp">https://sisg.supernotariado.gov.co/cuenta_cobro.jsp</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);


	  
	}
	




	 
}






if (isset($_POST['id_cuenta_cobro_finaliza']) && ""!=$_POST['id_cuenta_cobro_finaliza'])  {
	
	$updated22 = sprintf("UPDATE cuenta_cobro set finaliza_anexos=1 where id_cuenta_cobro=%s",

		GetSQLValueString($_POST['id_cuenta_cobro_finaliza'], "int"));
      $Resultpd = mysql_query($updated22, $conexion);
	  echo $actualizado;
	
	

$emailu=$_POST['correo_supervisa'];
$subject = 'Nueva cuenta de cobro';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky informa que se ha cargado una nueva cuenta de cobro. Por favor revisar:<br>";
$cuerpo .= '<br><a href="https://sisg.supernotariado.gov.co/cuenta_cobro.jsp">https://sisg.supernotariado.gov.co/cuenta_cobro.jsp</a><br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);

	
	
} else {}








if ((isset($_POST["tipo_soporte_anexo"]) && 3>$_SESSION['snr_tipo_oficina'])) {
	
$tamano_archivo=17301504;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/cuenta_cobro/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'cuenta_cobro-'.$_SESSION['snr'].''.date("YmdGis");

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
  

	

$insertSQL = sprintf("INSERT INTO soporte_cuenta_cobro (
id_cuenta_cobro, nombre_soporte_cuenta_cobro, url, estado_soporte_cuenta_cobro) 
VALUES (%s, %s, %s, %s)", 
GetSQLValueString($_POST["id_cuenta_cobro"], "int"),
GetSQLValueString($_POST["tipo_soporte_anexo"], "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

  echo $insertado;
   
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
  

}  else { }

 
 
 
 







if ((isset($_POST["contrato_pago"]) && 3>$_SESSION['snr_tipo_oficina'])) {
	
$tamano_archivo=17301504;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/cuenta_cobro/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'cuenta_cobro-'.$_SESSION['snr'].''.date("YmdGis");

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
  
  
if ($_POST["fecha_inicial"]<$_POST["fecha_final"]) {
	
/*
$query234 = sprintf("SELECT count(id_cuenta_cobro) as tt FROM cuenta_cobro where contrato_pago=".$_POST["contrato_pago"]." and pago_numero=".$_POST["pago_numero"]." and id_funcionario=".$_SESSION['snr']." and estado='Rechazado'"); 
$select234 = mysql_query($query234, $conexion);
$row234 = mysql_fetch_assoc($select234);
$numero=$row234['tt'];
mysql_free_result($select234);

if (0<$numero) { 
	
} else {
*/
$insertSQL6666 = sprintf("INSERT INTO cuenta_cobro (
id_funcionario, id_supervisor, contrato_pago, pago_numero, factura_electronica, fecha_inicial, fecha_final, cuenta_cobro, estado_cuenta_cobro) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["id_funcionario"], "int"),
GetSQLValueString($_POST["id_supervisor"], "int"),
GetSQLValueString($_POST["contrato_pago"], "text"),
GetSQLValueString($_POST["pago_numero"], "int"),
GetSQLValueString($_POST["factura_electronica"], "text"),
GetSQLValueString($_POST["fecha_inicial"], "date"),
GetSQLValueString($_POST["fecha_final"], "date"),
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result6786678 = mysql_query($insertSQL6666, $conexion);

  echo $insertado;
  

  
//}


} else {
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Las fechas presentan error.</div>';
 	
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
  
	
	


}  else { }

 
 



if (1==$_SESSION['rol'] &&   1==2) {
/*
include('pages/iris_cuenta_anexos.php'); 
$idanexoiris=idanexoiris('SNR2023IE017466');
$query = "SELECT * FROM soporte_cuenta_cobro where id_soporte_cuenta_cobro!=4 and id_cuenta_cobro=3 and estado_soporte_cuenta_cobro=1 order by nombre_soporte_cuenta_cobro asc";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
echo anexosiris($idanexoiris,$obj['nombre_soporte_cuenta_cobro'],$obj['url']);
echo anexosftpiris($idanexoiris,$obj['url']);
 }
$result->free();
*/


include('pages/iris_cuenta_anexos.php'); 

$idanexoiris=idanexoiris('SNR2023IE017651');

$query4pn = sprintf("SELECT url FROM cuenta_cobro where id_cuenta_cobro=9 and estado_cuenta_cobro=1 limit 1"); 
$result4pn = $mysqli->query($query4pn);
$row4pn = $result4pn->fetch_array();

echo anexosiris($idanexoiris,'Cuenta de cobro',$row4pn['url']);
echo anexosftpiris($idanexoiris,$row4pn['url']);


$result4pn->free();




} else {}


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('cuenta_cobro'); ?></h3>

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
 // 3>$_SESSION['snr_tipo_oficina']   && (5==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['rol'])
if (1==$_SESSION['snr_tipo_oficina']) { 
?>
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> Solicitar capacitación a oti.jefatura@supernotariado.gov.co

<?php } else { } ?>	

	  </h3>
	  
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Registrado</th>
  <th>Contrato</th>
   <th>Periodo</th>
 <th>Cédula</th>
<th>Contratista</th>
				  <th>Supervisor</th>
				  <th>Oficina</th>
				  <th>Oficina</th>
				  <th>Pago</th>
				   <th>Fecha inicial</th>
				  <th>Fecha final</th>	
				  <th>Fac. Elec.</th>	
<th>Estado</th>	
<th>Radicado</th>	
<th>Cuenta cobro</th>			  
				   <th>Anexos</th>		
		  
</tr>
</thead>
<tbody>
				
<?php 
/*
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
				*/
 


if (1==$_SESSION['rol']) {
$query4="SELECT * from cuenta_cobro, funcionario where  cuenta_cobro.id_funcionario=funcionario.id_funcionario and estado_cuenta_cobro=1  ORDER BY id_cuenta_cobro desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from cuenta_cobro, funcionario where cuenta_cobro.id_funcionario=funcionario.id_funcionario and estado_cuenta_cobro=1 and (funcionario.id_funcionario=".$_SESSION['snr']." or cuenta_cobro.id_supervisor=".$_SESSION['snr'].")  ORDER BY id_cuenta_cobro desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {
?>  
<tr>
				<?php
$id_res=$row['id_cuenta_cobro'];
echo '<td>'.$row['fecha_real'].'</td>';

echo '<td>'.$row['contrato_pago'].'</td>';
echo '<td>'.$row['fecha_inicial'].' / '.$row['fecha_final'].'</td>';

echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>'.quees('funcionario',$row['id_supervisor']).'</td>';

if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
	
}


echo '<td>'.$row['pago_numero'].'</td>';

echo '<td>'.$row['fecha_inicial'].'</td>';
echo '<td>'.$row['fecha_final'].'</td>';

echo '<td>'.$row['factura_electronica'].'</td>';

echo '<td>';

if ('Aprobado'==$row['estado']) { 

echo ' <a href="filesnr/cuenta_cobro/'.$row['url'].'" target="_blank"><img src="images/pdf.png"> Aprobado</a>';
 
} else if ('Rechazado'==$row['estado']) { 

echo 'Rechazado: '; 
echo $row['motivo'];

} else {

if ($_SESSION['snr']==$row['id_supervisor']) {
echo ' <a href="" class="buscar_cuentacobro" id="'.$id_res.'" title="Revisar" data-toggle="modal" data-target="#popupcuentacobro"> <span class="btn btn-xs btn-warning">Revisar</span></a> ';
} else {}
}

echo '</td>';
echo '<td><a href="correspondencia&'.$row['nombre_cuenta_cobro'].'.jsp" target="_blank">'.$row['nombre_cuenta_cobro'].'</a></td>';

echo '<td>';
echo ' <a href="filesnr/cuenta_cobro/'.$row['cuenta_cobro'].'" target="_blank"><img src="images/pdf.png"> Solicitud C.C.</a>';
echo '</td>';


echo '<td>';

if (isset($row['estado']) or 1==$row['finaliza_anexos']) { 
} else {
echo ' <a href="" class="buscar_anexocuentacobro" id="'.$id_res.'" title="Revisar" data-toggle="modal" data-target="#popupanexocuentacobro"> <span class="btn btn-xs btn-success">+</span></a> <br>';
}


$query23 = sprintf("SELECT * FROM soporte_cuenta_cobro where id_cuenta_cobro=".$id_res." and estado_soporte_cuenta_cobro=1 order by nombre_soporte_cuenta_cobro asc"); 
$select23 = mysql_query($query23, $conexion);
$row23 = mysql_fetch_assoc($select23);
$totalRows23 = mysql_num_rows($select23);
if (0<$totalRows23){
do {
		echo '<a href="filesnr/cuenta_cobro/'.$row23['url'].'" target="_blank">'.$row23['nombre_soporte_cuenta_cobro'].'</a> ';


if (isset($row['estado']) or 1==$row['finaliza_anexos']) { } else {
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_res.'" name="soporte_cuenta_cobro" id="'.$row23['id_soporte_cuenta_cobro'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} 
	 echo '<br>';
	 
	 } while ($row23 = mysql_fetch_assoc($select23)); 
} else {}	 
mysql_free_result($select23);


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


<?php if (3>$_SESSION['snr_tipo_oficina']) { ?>





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
        
<form action="" method="POST" name="for54354r653453456456345464324324563m1" enctype="multipart/form-data" >




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
<input type="hidden" name="id_funcionario" value="<?php echo $_SESSION['snr']; ?>" required>
</div>

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cargo:</label> 
<input type="text" class="form-control" readonly value="<?php echo quees('cargo',$_SESSION['snr_grupo_cargo']); ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Supervisor:</label> 
<select class="form-control"  name="id_supervisor" required>
<option selected></option>
<?php
$query2 = sprintf("SELECT * FROM funcionario where id_tipo_oficina<3 and id_cargo<3 and estado_funcionario=1 order by nombre_funcionario asc"); 
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
$totalRows2 = mysql_num_rows($select2);
if (0<$totalRows2){
do {
		echo '<option value="'.$row2['id_funcionario'].'">'.$row2['nombre_funcionario'].'</option>';
	 } while ($row2 = mysql_fetch_assoc($select2)); 
} else {}	 
mysql_free_result($select2);


?>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Contrato relacionado para pago (Solo 2023):</label> 
<input class="form-control numero"  name="contrato_pago" required>
</div>

<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Contrato relacionado para pago:</label> 
<select class="form-control"  name="contrato_pago" required>
<option selected></option>
<?php
/*
$query22 = sprintf("SELECT * FROM nc_contratos where id_funcionario=".$_SESSION['snr']." and estado_nc_contratos=1 order by cod_datos_contrato asc"); 
$select22 = mysql_query($query22, $conexion);
$row22 = mysql_fetch_assoc($select22);
$totalRows22 = mysql_num_rows($select22);
if (0<$totalRows22){
do {

echo '<option value="'.$row2['cod_datos_contrato'].'">'.$row2['cod_datos_contrato'].' - '.$row2['ano_datos_contrato'].'</option>';
	
	} while ($row2 = mysql_fetch_assoc($select22)); 
} else {}	 
mysql_free_result($select22);

*/
?>
</select>
</div>
-->








<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Pago N.</label> 
<input type="text" class="form-control numero" name="pago_numero" value="" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Desde</label> 
<input type="text" class="form-control datepicker" name="fecha_inicial" value="" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Hasta</label> 
<input type="text" class="form-control datepicker" name="fecha_final" value="" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Es con factura electrónica:</label> 
<select class="form-control" name="factura_electronica"  required>
<option selected></option>
<option>No</option>
<option>Si</option>
</select>
</div>




<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
	var fsize = 15000;
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
	alert('Debe ser inferior a 15000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span> DOCUMENTO PDF : </label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 15 Mg</span>
<div id="imagePreview"></div>
</div>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success desaparecerboton">
<input type="hidden" name="table" value="instruccion_admin">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>















<div class="modal fade" id="popupcuentacobro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Revisión de cuenta de cobro</b></h4>
</div> 
<div id="ver_cuentacobro" class="modal-body"> 

</div>
</div> 
</div> 
</div>





<div class="modal fade" id="popupanexocuentacobro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Anexar documentos</b></h4>
</div> 
<div id="ver_anexocuentacobro" class="modal-body"> 

</div>
</div> 
</div> 
</div>





<?php } else { }


} else {
	echo 'Se debe solicitar a la OTI la activación para todo el pais.';
	
} ?>




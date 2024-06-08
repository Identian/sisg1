<?php
if (isset($_GET['i'])) {
	$info=$_GET['i'];
} else {}

$nump36=privilegios(36,$_SESSION['snr']);
$nump25=privilegios(25,$_SESSION['snr']);
$nump26=privilegios(26,$_SESSION['snr']);
$nump27=privilegios(27,$_SESSION['snr']);
$nump28=privilegios(28,$_SESSION['snr']);
$nump29=privilegios(29,$_SESSION['snr']);
$nump30=privilegios(30,$_SESSION['snr']);
if (0<$nump36 or 1==$_SESSION['rol'] or 0<$nump25 or 0<$nump26 or 0<$nump27 or 0<$nump28  or 0<$nump29 or 0<$nump30) 

{ 

//ANEXAR DOCUMENTOS EN IRIS (MAS DOCUMENTOS)

	if (isset($_POST['idcorrespondencia_anexa']) && ""!=$_POST['idcorrespondencia_anexa'] && isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

		$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
		$formato_archivo = array('pdf');
		$directoryftp="filesnr/iris/";

		if (isset($_POST['id_tipo_documento_anexo']) && ""!=$_POST['id_tipo_documento_anexo']) {
			$ruta_archivo2 = $_POST['id_tipo_documento_anexo'].'-'.$_SESSION['snr'].'-'.date("YmdGis");
		} else {
			$ruta_archivo2 = '4-'.$_SESSION['snr'].'-'.date("YmdGis");
		}

		$archivo2 = $_FILES['file']['tmp_name'];
		$tam_archivo= filesize($archivo2);
		$tam_archivo3= $_FILES['file']['size'];
		$nombrefile = strtolower($_FILES['file']['name']);
		$info = pathinfo($nombrefile); 
		$extension=$info['extension'];
		$array_archivo = explode('.',$nombrefile);
		$extension2= end($array_archivo);

		if ($tamano_archivo>=intval($tam_archivo3)) {


//if (($extension2==$extension) and in_array($extension, $formato_archivo)) { 
			if ('pdf'==$extension)  { 
				$filep = $ruta_archivo2.'.pdf';
				$mover_archivos = move_uploaded_file($archivo2, $directoryftp.$filep);
//chmod($files,0777);
				$nombrebre_orig= ucwords($nombrefile);

//$seguridad=md5($files.$id_ciudadano);

// correspondenciacontenido


				$conexionpostgresql = pg_connect($conexionpostgres);
				if(!$conexionpostgresql){
					echo 'No se puede conectar con IRIS.';
				} else {


					$idcorrespondencia=$_POST['idcorrespondencia_anexa'];



					$dateiris=date("Y-m-d H:i:s");


					$conn_id = ftp_connect($ftp_server);
					$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

/*
$remotef = 'Correo/'.$idcorrespondencia.'/Files';
if (ftp_mkdir($conn_id, $remotef)) {
echo "";
} else {
echo "";
}
*/


$file2 = $directoryftp.$filep;  
$remote_file2 = 'Correo/'.$idcorrespondencia.'/Files/'.$filep;


if (ftp_put($conn_id, $remote_file2, $file2, FTP_BINARY)) {
	echo "";
} else {
	echo "";
}
ftp_close($conn_id);



$consultab = sprintf("INSERT INTO correspondenciacontenido (
	idcorrespondencia, 
	idtipodocumento, 
	idsubclasedocumento, 
	indice, 
	upd, 
	mostrar, 
	nombre, 
	extension, 
	dir, 
	pag, 
	crc, audita, fechaaudita, audita2, fechaaudita2, creado, fcreado, modificado, fmodificado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
	GetSQLValueString($idcorrespondencia, "text"), 
	GetSQLValueString('0', "text"), 
	GetSQLValueString('0', "text"),
	GetSQLValueString('1', "text"), //incremental
	GetSQLValueString('0', "text"),
	GetSQLValueString('f', "text"),
	GetSQLValueString($filep, "text"), 
	GetSQLValueString('Pdf', "text"),
	GetSQLValueString('1', "text"),
	GetSQLValueString('1', "text"),
	GetSQLValueString('', "text"),
	GetSQLValueString('0', "text"),
	GetSQLValueString('', "text"),
	GetSQLValueString('0', "text"),
	GetSQLValueString('', "text"),
	GetSQLValueString('1642', "text"),
	GetSQLValueString($dateiris, "text"),
	GetSQLValueString('0', "text"),
	GetSQLValueString('', "text"));


	$resultado = pg_query ($consultab);

	pg_free_result($resultado);
	pg_close($conexionpostgresql);  
}

echo $insertado;

if ((isset($_POST["radicadou"])) && ($_POST["radicadou"] != "")) {
	$radicadou=$_POST["radicadou"];
	$id_anexo=intval($_POST["id_tipo_documento_anexo"]);


	if (4==$id_anexo) {
		$updateSQL = "UPDATE correspondencia SET anexos=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";	 
	} else if (5==$id_anexo){ 
		$updateSQL = "UPDATE correspondencia SET cuenta_pagar=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";
	} else if (6==$id_anexo){ 
		$updateSQL = "UPDATE correspondencia SET factura=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";
	} else if (7==$id_anexo){ 
		$updateSQL = "UPDATE correspondencia SET obligaciones=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";
	} else if (8==$id_anexo){ 
		$updateSQL = "UPDATE correspondencia SET orden_pago=1 WHERE nombre_correspondencia='$radicadou' and estado_correspondencia=1";
	} else {}

	$Result1 = mysql_query($updateSQL, $conexion);
}





} else { 
	$filep='';
	echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';

}
} else { 
	$filep='';
	echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
}

} else { 
	$filep='';
}




//INSERTAR MASIVAMENTE

if ((isset($_POST["radicadosm"])) && ("" != $_POST["radicadosm"])) {

$estud=$_POST['radicadosm'];
for ($u=0;$u<count($estud);$u++)    
{     
$estu=$estud[$u];    
//echo $asig.'-'.$estu.'<br>';

if (isset($_POST['id_fun_presupuestom']) and (""!=$_POST['id_fun_presupuestom'])) {
$asig=$_POST["id_fun_presupuestom"];
$queryp = "select id_fun_presupuesto from correspondencia where id_correspondencia=".$estu." and estado_correspondencia=1 limit 1"; 
$selectp = mysql_query($queryp, $conexion);
$rowp = mysql_fetch_assoc($selectp);
if(isset($rowp['id_fun_presupuesto'])) { } else {  					
	$updatecc = sprintf("UPDATE correspondencia SET id_fun_presupuesto=%s WHERE id_correspondencia=%s and estado_correspondencia=1",                  
	GetSQLValueString($asig, "int"),
	GetSQLValueString($estu, "int"));
	$Resultcc = mysql_query($updatecc, $conexion) ;
 }
} else {}
 
 
 
 if (isset($_POST['id_fun_contabilidadm']) and (""!=$_POST['id_fun_contabilidadm'])) {
$asig=$_POST["id_fun_contabilidadm"];
$queryp = "select id_fun_contabilidad from correspondencia where id_correspondencia=".$estu." and estado_correspondencia=1 limit 1"; 
$selectp = mysql_query($queryp, $conexion);
$rowp = mysql_fetch_assoc($selectp);
if(isset($rowp['id_fun_contabilidad'])) { } else {  					
	$updatecc = sprintf("UPDATE correspondencia SET id_fun_contabilidad=%s WHERE id_correspondencia=%s and estado_correspondencia=1",                  
	GetSQLValueString($asig, "int"),
	GetSQLValueString($estu, "int"));
	$Resultcc = mysql_query($updatecc, $conexion) ;
 }
} else {}




if (isset($_POST['id_fun_tesoreriam']) and (""!=$_POST['id_fun_tesoreriam'])) {
$asig=$_POST["id_fun_tesoreriam"];
$queryp = "select id_fun_tesoreria from correspondencia where id_correspondencia=".$estu." and estado_correspondencia=1 limit 1"; 
$selectp = mysql_query($queryp, $conexion);
$rowp = mysql_fetch_assoc($selectp);
if(isset($rowp['id_fun_tesoreria'])) { } else {  					
	$updatecc = sprintf("UPDATE correspondencia SET id_fun_tesoreria=%s WHERE id_correspondencia=%s and estado_correspondencia=1",                  
	GetSQLValueString($asig, "int"),
	GetSQLValueString($estu, "int"));
	$Resultcc = mysql_query($updatecc, $conexion) ;
 }
} else {}
 
 
 
 
}
echo $insertado;
}





// INSERTAR ASIGNACION
if (isset($_POST['AsignarFunPresupuesto'])) {
	//var_dump($_POST["id_fun_presupuesto"]);
	//var_dump($_POST["id_correspondencia"]);
	$updatecc = sprintf("UPDATE correspondencia SET id_fun_presupuesto=%s WHERE id_correspondencia=%s and estado_correspondencia=1",                  
	GetSQLValueString($_POST["id_fun_presupuesto"], "int"),
	GetSQLValueString($_POST["id_correspondencia"], "int"));
	$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());

	echo $actualizado;
	//echo '<meta http-equiv="refresh" content="0;URL=./cuentas_cobro.jsp" />';
}
if (isset($_POST['AsignarFunContabilidad'])) {
	//var_dump($_POST["id_fun_contabilidad"]);
	//var_dump($_POST["id_correspondencia"]);
	$updatecc = sprintf("UPDATE correspondencia SET id_fun_contabilidad=%s WHERE id_correspondencia=%s and estado_correspondencia=1",                  
	GetSQLValueString($_POST["id_fun_contabilidad"], "int"),
	GetSQLValueString($_POST["id_correspondencia"], "int"));
	$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());

	echo $actualizado;
	// echo '<meta http-equiv="refresh" content="0;URL=./cuentas_cobro.jsp" />';
}
if (isset($_POST['AsignarFunTesoreria'])) {
	$updatecc = sprintf("UPDATE correspondencia SET id_fun_tesoreria=%s WHERE id_correspondencia=%s and estado_correspondencia=1",                  
	GetSQLValueString($_POST["id_fun_tesoreria"], "int"),
	GetSQLValueString($_POST["id_correspondencia"], "int"));
	$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());

	echo $actualizado;
	echo '<meta http-equiv="refresh" content="0;URL=./cuentas_cobro.jsp" />';
}




// ACTUALIZACION TIPO DE DOCUMENTO
if ((isset($_POST["id_tipo_documento_cambio"])) && ($_POST["id_tipo_documento_cambio"] != "")) {
$radicadotipodoc=$_POST["radicado_update_tipo_doc"];
$id_tipo_documento_u=intval($_POST["id_tipo_documento_cambio"]);
  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else { 
$consultabre = sprintf("UPDATE correspondencia SET idtipodocumento=%s, modificado=1642, fmodificado=%s where codigo=%s",
GetSQLValueString($id_tipo_documento_u, "int"), 
GetSQLValueString($fechairis_re, "text"), 
GetSQLValueString($radicadotipodoc, "text"));
$resultadore = pg_query ($consultabre);
  pg_free_result($resultadore);
  pg_close($conexionpostgresql);  
  }
$updateSQL2 = "UPDATE correspondencia SET id_tipo_correspondencia=".$id_tipo_documento_u." WHERE nombre_correspondencia='$radicadotipodoc' and estado_correspondencia=1";	 
 $Result12 = mysql_query($updateSQL2, $conexion);
echo  $actualizado;
mysql_free_result($Result12);
 }
 


if (isset($_POST['archivar']) && ""!=$_POST['archivar']) {
	$updatecc = sprintf("UPDATE correspondencia SET estado_correspondencia=0 WHERE id_correspondencia=%s and estado_correspondencia=1",                  
	GetSQLValueString($_POST["archivar"], "int"));
	$Resultcc = mysql_query($updatecc, $conexion);
	echo $actualizado;
	mysql_free_result($Resultcc);
	//echo '<meta http-equiv="refresh" content="0;URL=./cuentas_cobro.jsp" />';
}




?>  

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Cuentas de cobro
				</h3>
				<br>
<!--
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
<div class="input-group-btn">
<input type="text" id="search" name="buscar" placeholder="Buscar Texto" class="form-control" required >
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
-->




<div class="box-header with-border">


	<div class="row">
		<div class="col-md-5">
			<form class="navbar-form" name="fotertrm3252345rter1erteg" method="POST">
				
					<div class="input-group">
						<div class="input-group-btn">Buscar 
							<select class="form-control" name="campo" required>
								<option value="" selected> - - Buscar por: - -  </option>
								<option value="nombre_correspondencia" >Radicado</option>
								<option value="asunto_correspondencia">Asunto</option>
							</select>
						</div>
						<div class="input-group-btn">
							<input type="text" name="buscar" placeholder="Buscar" class="form-control" required ></div>
							
							<div class="input-group-btn">
								<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
							</div>
						</div>
					
				</form>
			</div>
			
			<div class="col-md-2">
			
			<?php 
			if (1==$_SESSION['rol'] or (0<$nump25)  or (0<$nump27)  or (0<$nump29)){ ?>
<a href=""  data-toggle="modal" data-target="#popupmasiva">
<button type="button" class="btn btn-warning btn-xs" >Masivos</button>
	</a><br>
<?php } else { }?>


			   &nbsp; <a href="https://youtu.be/MfJrMjTq8h0" target="_blank"> Ver Manual</a>
			   <br>
			   <?php	if (0<$nump36 OR 0<$nump25 or 0<$nump27 or 0<$nump29 or 1==$_SESSION['rol']) { ?>
			   <a href="https://sisg.supernotariado.gov.co/xls/correspondencia_cuenta_cobro.xls">Reporte completo</a>
			   <?php } else {} ?>
			   </div>
			
			<div class="col-md-5">
		<?php	if (0<$nump36 OR 0<$nump25 or 0<$nump27 or 0<$nump29 or 1==$_SESSION['rol']) { ?>
				<form class="navbar-form" name="formatobuscar2" method="POST">
					
						<div class="input-group">
						<!--
							<select class="form-control" name="buscar2" required>
								<option value="" selected> - - Buscar por: - -  </option>
								<option value="id_fun_presupuesto=">Presupuesto</option>
								<option value="id_fun_contabilidad=">Contabilidad</option>
								<option value="id_fun_tesoreria=">Tesoreria</option>
							</select>-->

							<div class="input-group-btn">Buscar 
								<select class="form-control" name="campo2" required>
								<option value="" selected> - - Funcionario responsable: - -  </option>
								<?php				
									$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=25 OR id_perfil=26 OR id_perfil=27 OR id_perfil=28 OR id_perfil=29 OR id_perfil=30)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
									$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
									$rowop = mysql_fetch_assoc($selectop);
									$total = mysql_num_rows($selectop);
									if (0<$total) {
										do {?>
											<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
											<?php
										}while ($rowop = mysql_fetch_assoc($selectop)); 
										mysql_free_result($selectop);
									} else {}
								?>	
								</select>
							</div>

							

							<div class="input-group-btn">
								<button type="submit" class="btn btn-warning" name="btnbuscar2" value="1"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
							</div>
						</div>
				</form> 
		<?php } else {}?>
			</div>
		</div>

	

		<!-- FINAL box-tools pull-right -->
	</div>




	<style>


		.dataTables_filter {
			display:none;
		}

	</style> 


	<div class="box-body">
		<div class="table-responsive">

<b>Las cuentas de cobro que ya se tramitaron completamente (Con Factura equivalente, Cuenta por pagar, Obligaciones y Orden de pago), no aparecen en la sigueinte tabla. Si utiliza busquedas, si.</b>

			<table  class="table table-striped table-bordered table-hover" id="inforesoluciones" cellspacing="0" width="100%">
<thead>
					<tr align="center" valign="middle">
						<th >Creación</th>
						<th >Radicado</th>
						<th >Asunto</th>
						<th>
							Radicado Externo
						</th><th>
							Factura equivalente
						</th><th>
							Cuenta por pagar
						</th><th>
							Obligaciones
						</th><th>
							Orden de pago
						</th><th>
							Anexo
						</th>
						<th>Acciones</th>
					</tr>
				</thead>

						<tbody>

							<?php

							$si='Si <span class="fa fa-check" style="color:#398439"></span>';
							$no='No <span class="fa fa-close" style="color:#B40404"></span>';


//id_correspondencia>=500000 and

function primeronull() {
global $mysqli;
$query4hj = sprintf("SELECT id_correspondencia FROM correspondencia where id_correspondencia>=490000 and id_tipo_correspondencia=305 and factura is null and cuenta_pagar is null and estado_correspondencia=1 order by id_correspondencia asc LIMIT 3"); 
$result4hj = $mysqli->query($query4hj);
$idcor='';
while ($obj5k = $result4hj->fetch_array()) {

$idcor.=$obj5k['id_correspondencia'].'---';


}

$reshhj=$idcor;
return $reshhj;
$result4hj->free();
}



$infop=primeronull();
$cifra=explode("---", $infop);
$uno=$cifra[0];
$dos=$cifra[1];
$tres=$cifra[2];

//echo $uno.'-'.$dos.'-'.$tres;


	if (0<$nump36 OR 0<$nump25 or 0<$nump27 or 0<$nump29 or 1==$_SESSION['rol']) {
							if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
								$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
							} elseif (isset($_POST['campo2']) && ""!=$_POST['campo2']) {
							$id_fun_res=intval($_POST['campo2']);
							$infobus=" and (id_fun_presupuesto=".$id_fun_res." or id_fun_contabilidad=".$id_fun_res." or id_fun_tesoreria=".$id_fun_res.") ";
								
							} else {
							$infobus="	AND (factura IS NULL or cuenta_pagar IS NULL or obligaciones IS NULL OR orden_pago IS null) ";
							}						
 
$query = "SELECT * FROM correspondencia where id_tipo_correspondencia=305 and estado_correspondencia=1 ".$infobus." order by id_correspondencia desc "; 


} else {
$idfunres=$_SESSION['snr'];
	if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
$query = "SELECT * FROM correspondencia where id_tipo_correspondencia=305 and estado_correspondencia=1 ".$infobus." order by id_correspondencia desc"; 
	} else {
	$query = "SELECT * FROM correspondencia where (id_fun_presupuesto=".$idfunres." or id_fun_contabilidad=".$idfunres." or id_fun_tesoreria=".$idfunres.") 
	AND (factura IS NULL or cuenta_pagar IS NULL or obligaciones IS NULL OR orden_pago IS null) 
	and id_tipo_correspondencia=305 and estado_correspondencia=1 order by id_correspondencia desc"; 
	}
}


							$select = mysql_query($query, $conexion);
							$row = mysql_fetch_assoc($select);
							$totalRows = mysql_num_rows($select);
							if(0<$totalRows){

								do {
									$idrad=$row['id_correspondencia'];
									$radi=$row['nombre_correspondencia'];
									echo '<tr><td>'.$row['fecha_correspondencia'].'</td>';
									echo '<td>'.$radi.'<br>';
									
									if (isset($row['id_fun_presupuesto'])) { ?>
										<i style="color:orange;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_presupuesto']); ?>"></i>&nbsp;
									<?php } if (isset($row['id_fun_contabilidad'])) { ?>
										<i style="color:green;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_contabilidad']); ?>"></i>&nbsp;
									<?php } if (isset($row['id_fun_tesoreria'])) { ?>
										<i style="color:#3368FF;" class="fa fa-user" title="<?php echo quees('funcionario', $row['id_fun_tesoreria']); ?>"></i>&nbsp;
									<?php } else {}
									
									echo '</td>';
									echo '<td>'.$row['asunto_correspondencia'].' / CC'.$row['cedula_contratista'].'';
									
									echo '</td>';
									
									echo '<td>';
									echo $si; 
									echo '</td>';

									echo '<td>';
									if (1==$row['factura']) { echo $si; } else { echo $no; }
									echo '</td><td>';
									if (1==$row['cuenta_pagar']) { echo $si; } else { echo $no; }
									echo '</td><td>';
									if (1==$row['obligaciones']) { echo $si; } else { echo $no; }
									echo '</td><td>';
									if (1==$row['orden_pago']) { echo $si; } else { echo $no; }
									echo '</td><td>';
									if (1==$row['anexos']) { echo $si; } else { echo $no; }
									echo '</td>';

							

									echo '<td>';
									
									if (1==2) {         //1==$_SESSION['rol'] or 0<$nump26) {
										
										
									                        //if ($idrad==$uno or $idrad==$dos or $idrad==$tres) {
									if ($idrad<=$tres) {

echo '<a name="'.$radi.'" href="" class="buscar_correspondencia" id="'.$radi.'" data-toggle="modal" data-target="#popupcorrespondencia"><img src="images/pdf.png"></a>&nbsp;&nbsp;&nbsp;';
							        
									
										} else {


											}
									
									
									
									} else {
									echo '<a name="'.$radi.'" href="" class="buscar_correspondencia" id="'.$radi.'" data-toggle="modal" data-target="#popupcorrespondencia"><img src="images/pdf.png"></a>&nbsp;&nbsp;&nbsp;';
							        	
									}
									
									echo ' <a name="'.$radi.'" href="" class="buscar_asigna" id="'.$idrad.'" data-toggle="modal"data-target="#popupasigna" title="Asignar Cuenta"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-group"></i> Ir</button></a>';
								
									echo '</td>';
									echo '</tr>';

								} while ($row = mysql_fetch_assoc($select)); 
								mysql_free_result($select);
							} else {}
								?>
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
						"aaSorting": [[ 1, "desc"]]
					});
				});
	
			</script>
			

						
					</div>


				</div>




			</div>
		</div>
	</div>
</div>





<div class="modal fade" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Correspondencia</label> <span id="radicor"></span></h4>
			</div> 
			<div class="ver_correspondencia" class="modal-body"> 

			</div>
		</div> 
	</div> 
</div> 

<div class="modal fade" id="popupasigna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Correspondencia</label> <span id="asigna"></span></h4>
			</div> 
			<div class="ver_asigna" class="modal-body"> 

			</div>
		</div> 
	</div> 
</div> 


<style>
.rojo {
	color:#ff0000;
}

</style>


  <div class="modal fade bd-example-modal-lg" id="popupmasiva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            <h4 class="modal-title" id="myModalLabel"><label class="control-label">Asignaciones masivas</label></h4>
          </div>
          <div class="modal-body">

<form action="" method="post" name="4355434534534545345435">

<div class="row" >
	
			<div class="col-md-12">
<select id="multiplemasivo" name="radicadosm[]" multiple style="width:100%;height:220px;" >
	<?php
	
	if (0<$nump27 OR 1==$_SESSION['rol']) {
$queryop = sprintf("SELECT * FROM correspondencia where id_tipo_correspondencia=305 and estado_correspondencia=1 AND orden_pago is null and id_fun_presupuesto is not null and factura is not null and cuenta_pagar is not null and id_fun_contabilidad is null ORDER BY id_correspondencia desc");
		
	} else {		
	$queryop = sprintf("SELECT * FROM correspondencia where id_tipo_correspondencia=305 and estado_correspondencia=1 AND orden_pago is null and id_fun_presupuesto is not null and factura is not null and cuenta_pagar is not null and id_fun_contabilidad is not null and obligaciones is not null and id_fun_tesoreria is null ORDER BY id_correspondencia desc");
				
	}
				$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_correspondencia']; ?>" title="<?php echo $rowop['fecha_correspondencia']; ?>"><?php echo $rowop['nombre_correspondencia']; ?> - <?php echo $rowop['asunto_correspondencia']; ?>
							
							<?php 
							if (isset($rowop['id_fun_presupuesto']) and isset($rowop['factura']) and isset($rowop['cuenta_pagar'])) { echo '/ OK funPres-fac-cuenta '; } else { echo '<i class="rojo">/ NO funPres-fac-cuenta</i>';}
							
							
							if (isset($rowop['id_fun_contabilidad'])) { echo '/ OK funCont '; } else { echo '<i class="rojo"> / NO funCont</i>';}
							
							
							if (isset($rowop['obligaciones'])) { echo '/ OK obligaciones '; } else { echo '<i class="rojo"> / NO obligaciones</i>';}
							
							
							
							?>
							
							
							
							</option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					
?>
</select>
<br><br>
</div>
</div>

<?php
if (0<$nump25 OR 1==$_SESSION['rol']) { ?>
<div class="row" >
			<div class="col-md-4"><b>Presupuesto masivo a:</b></div>
			<div class="col-md-5">
				<select name="id_fun_presupuestom">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=25 OR id_perfil=26)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>						
				</select>
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-xs btn-warning" >Asignar masivamente</button> 
			
			</div>
			<hr>
		</div>
<?php } else {} 


if (0<$nump27 OR 1==$_SESSION['rol']) { ?>

		

		<div class="row" >
		<div class="col-md-4"><b>Asignar masivamente Contabilidad a:</b></div>
			<div class="col-md-5">
				<select name="id_fun_contabilidadm">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=27 OR id_perfil=28)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>						
				</select>
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-xs btn-warning" name="AsignarFunContabilidad" value="1">Asignar masivamente</button> 
			</div>
			
		</div>
	<br>
<?php } else {} 

if (0<$nump29 OR 1==$_SESSION['rol']) { ?>
		
		<div class="row" >
	
			<div class="col-md-4"><b>Asignar masivamente Tesoreria a:</b></div>
			<div class="col-md-5">
				<select name="id_fun_tesoreriam">
					<option value=""></option>
					<?php				
					$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=29 OR id_perfil=30)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
					$selectop = mysql_query($queryop, $conexion) or die(mysql_error());
					$rowop = mysql_fetch_assoc($selectop);
					$total = mysql_num_rows($selectop);
					if (0<$total) {
						do {?>
							<option value="<?php echo $rowop['id_funcionario']; ?>"><?php echo $rowop['nombre_funcionario']; ?></option>
							<?php
						}while ($rowop = mysql_fetch_assoc($selectop)); 
						mysql_free_result($selectop);
					} else {}
					?>						
				</select>
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-xs btn-warning" name="AsignarFunTesoreria" value="1">Asignar masivamente</button> 
			</div>
			
		</div>
<?php } else {} ?>
		
		
		
		
		
		
		
	</form>
	


          </div>
        </div>
      </div>
    </div>
	



<?php } ?>










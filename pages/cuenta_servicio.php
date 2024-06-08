<?php
if (isset($_GET['i'])) {
	$info=$_GET['i'];
} else {}

$nump36=privilegios(36,$_SESSION['snr']);
$nump44=privilegios(44,$_SESSION['snr']);
$nump47=privilegios(47,$_SESSION['snr']);
$nump45=privilegios(45,$_SESSION['snr']);
$nump48=privilegios(48,$_SESSION['snr']);
$nump46=privilegios(46,$_SESSION['snr']);
$nump49=privilegios(49,$_SESSION['snr']);

if (0<$nump36 OR 1==$_SESSION['rol'] OR 40==$_SESSION['snr_grupo_area'] OR 0<$nump44 OR 0<$nump47 OR 0<$nump45 OR 0<$nump48 OR 0<$nump46 OR 0<$nump49) 

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




// INSERTAR ASIGNACION
if (isset($_POST['AsignarFunPresupuesto'])) {

	$updatecc = sprintf("UPDATE correspondencia SET id_fun_presupuesto=%s WHERE id_correspondencia=%s and estado_correspondencia=1",                  
		GetSQLValueString($_POST["id_fun_presupuesto"], "int"),
		GetSQLValueString($_POST["id_correspondencia"], "int"));
	$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());

	echo $actualizado;

}
if (isset($_POST['AsignarFunContabilidad'])) {
	$updatecc = sprintf("UPDATE correspondencia SET id_fun_contabilidad=%s WHERE id_correspondencia=%s and estado_correspondencia=1",                  
		GetSQLValueString($_POST["id_fun_contabilidad"], "int"),
		GetSQLValueString($_POST["id_correspondencia"], "int"));
	$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());

	echo $actualizado;

}
if (isset($_POST['AsignarFunTesoreria'])) {
	$updatecc = sprintf("UPDATE correspondencia SET id_fun_tesoreria=%s WHERE id_correspondencia=%s and estado_correspondencia=1",                  
		GetSQLValueString($_POST["id_fun_tesoreria"], "int"),
		GetSQLValueString($_POST["id_correspondencia"], "int"));
	$Resultcc = mysql_query($updatecc, $conexion) or die(mysql_error());

	echo $actualizado;

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
 }
 
 
  
 // ACTUALIZACION ASUNTO
if ((isset($_POST["asunto_cambio"])) && ($_POST["asunto_cambio"] != "")) {
$radicado_asunto_cambio=$_POST["radicado_asunto_cambio"];
$asunto_cambio=$_POST["asunto_cambio"];
  $conexionpostgresql = pg_connect($conexionpostgres);
   if(!$conexionpostgresql){
     echo 'No se puede conectar con IRIS.';
  } else { 
$consultabre = sprintf("UPDATE correspondencia SET asunto=%s, modificado=1642, fmodificado=%s where codigo=%s",
GetSQLValueString($asunto_cambio, "text"), 
GetSQLValueString($fechairis_re, "text"), 
GetSQLValueString($radicado_asunto_cambio, "text"));
$resultadore = pg_query ($consultabre);
  pg_free_result($resultadore);
  pg_close($conexionpostgresql);  
  }
$updateSQL2 = "UPDATE correspondencia SET asunto_correspondencia=".$asunto_cambio." WHERE nombre_correspondencia='$radicado_asunto_cambio' and estado_correspondencia=1";	 
 $Result12 = mysql_query($updateSQL2, $conexion);
echo  $actualizado;
 }
 
 
 
 
 
?>  

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Tramite de Gastos de Servicio</h3>
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
		<div class="col-md-6">
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
		<div class="col-md-6">
				<?php	if (0<$nump36 OR 0<$nump44 or 0<$nump45 or 0<$nump46 or 1==$_SESSION['rol']) { ?>
					<form class="navbar-form" name="formatobuscar2" method="POST">

						<div class="input-group">


						<div class="input-group-btn">Buscar 
							<select class="form-control" name="campo2" required>
								<option value="" selected> - - Funcionario responsable: - -  </option>
								<?php				
								$queryop = sprintf("SELECT * FROM funcionario_perfil, funcionario where funcionario_perfil.id_funcionario=funcionario.id_funcionario and (id_perfil=38 OR id_perfil=39 OR id_perfil=40 OR id_perfil=41 OR id_perfil=42 OR id_perfil=43)  and estado_funcionario_perfil=1 ORDER BY nombre_funcionario ASC");
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

				if (0<$nump36 OR 0<$nump44 or 0<$nump45 or 0<$nump46 or 1==$_SESSION['rol']) {
					if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
						$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
					} elseif (isset($_POST['campo2']) && ""!=$_POST['campo2']) {
						//$infobus=" and  ".$_POST['buscar2'].$_POST['campo2']." ";
						$id_fun_res=intval($_POST['campo2']);
						$infobus=" and (id_fun_presupuesto=".$id_fun_res." or id_fun_contabilidad=".$id_fun_res." or id_fun_tesoreria=".$id_fun_res.") ";

					} else {
						$infobus="";
					}						

					$query = "SELECT * FROM correspondencia where id_tipo_correspondencia=123 and estado_correspondencia=1 ".$infobus." order by id_correspondencia desc"; 


				} else {
					$idfunres=$_SESSION['snr'];
						if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
						$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
						} else {
						$infobus="";
						}
					$query = "SELECT * FROM correspondencia where (id_fun_presupuesto=".$idfunres." or id_fun_contabilidad=".$idfunres." or id_fun_tesoreria=".$idfunres.") and id_tipo_correspondencia=123 and estado_correspondencia=1 ".$infobus." order by id_correspondencia desc"; 

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
						echo '<td>'.$row['asunto_correspondencia'].'</td>';

						echo '<td>';
						echo $si; 
						echo '</td><td>';
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
						echo '<a name="'.$radi.'" href="" class="buscar_correspondencia" id="'.$radi.'" data-toggle="modal" data-target="#popupcorrespondencia"><img src="images/pdf.png"></a>&nbsp;&nbsp;&nbsp;';
						echo ' <a name="'.$radi.'" href="" class="buscar_servicio" id="'.$idrad.'" data-toggle="modal"data-target="#popupservicio" title="Asignar Servicio"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-group"></i> Ir</button></a>';

						echo '</td>';
						echo '</tr>';

					} while ($row = mysql_fetch_assoc($select)); 
					mysql_free_result($select);

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

<div class="modal fade" id="popupservicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Pago de Servicios</label></h4>
			</div> 
			<div class="ver_servicio" class="modal-body"> 

			</div>
		</div> 
	</div> 
</div> 



<?php }} ?>










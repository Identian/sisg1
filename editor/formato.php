<?php
if (isset($_POST['nombre_visita'])) {	
	
function actualizarseccion($data,$id,$seccion,$idp) {
global $mysqli;
$query88 = "UPDATE seccion_visita SET nombre_seccion_visita='$data' where id_seccion_visita=".$idp."";  
$result44 = $mysqli->query($query88);
return '';
}



function insertarseccion($data,$id,$seccion) {
global $mysqli;
$query88 = "INSERT INTO seccion_visita (id_visita, id_plantilla_visita, nombre_seccion_visita, estado_seccion_visita) 
values ($id, $seccion, '$data', 1)";  
$result44 = $mysqli->query($query88);
return '';
}


$queryk = sprintf("SELECT id_seccion_visita from seccion_visita where id_visita=".$id." and id_plantilla_visita=".$seccion." and estado_seccion_visita=1");
$result4hj = $mysqli->query($queryk);
$row4hj = $result4hj->fetch_array();
if (0<count($row4hj)){
echo actualizarseccion($_POST['nombre_visita'],$id,$seccion,$row4hj['id_seccion_visita']);

} else {
echo insertarseccion($_POST['nombre_visita'],$id,$seccion);

}
$result4hj->free();






$insertSQL = sprintf("INSERT INTO seguimiento_visita (
id_funcionario, id_visita, id_seccion_visita, estado_seguimiento_visita) 
VALUES (%s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($seccion, "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

} else {}



$select = mysql_query("select * from plan_visita, visita, area where 
plan_visita.id_plan_visita=visita.id_plan_visita and 
plan_visita.id_area=area.id_area 
	and aprobado=1 and estado_plan_visita=1 and id_visita=".$id." and visita.finalizada is null limit 1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){

$id_area=''.$row['id_area'].'';
$plan=''.$row['id_plan_visita'].'';
$vigencia=''.$row['vigencia'].'';
$cantidad=''.$row['cantidad'].'';
$nombre_area=''.$row['nombre_area'].'';
$code=$row['codigo_oficina'];	


 

	
function infonotaria ($info) {
global $mysqli;
$query4 = sprintf("SELECT funcionario.id_funcionario, nombre_funcionario, notaria.id_notaria, nombre_notaria, id_categoria_notaria, direccion_notaria, telefono_notaria, email_notaria FROM posesion_notaria, notaria, funcionario WHERE posesion_notaria.id_funcionario=funcionario.id_funcionario and posesion_notaria.id_notaria=notaria.id_notaria and notaria.id_notaria=".$info." and fecha_fin is null and estado_posesion_notaria=1 limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$informa='<p style="font-size:12px;">
<b>Notaria:</b> <a href="../notaria&'.$row4['id_notaria'].'.jsp" target="_blank">'.$row4['nombre_notaria'].'</a>
<br><b>Notario:</b> <a href="../usuario&'.$row4['id_funcionario'].'.jsp" target="_blank">'.$row4['nombre_funcionario'].'</a>
<br><b>Categoria:</b> '.$row4['id_categoria_notaria'].'
<br><b>Dirección:</b> '.$row4['direccion_notaria'].'
<br><b>Telefono:</b> '.$row4['telefono_notaria'].'
<br><b>Email:</b> '.$row4['email_notaria'].'</p>';		
$result4->free();
return $informa;
}

	

function inforegistro ($info) {
global $mysqli;
$query4 = sprintf("SELECT funcionario.id_funcionario, nombre_funcionario, oficina_registro.id_oficina_registro, oficina_registro.nombre_oficina_registro, circulo, direccion_oficina_registro, telefono_oficina_registro, correo_oficina_registro  
FROM funcionario, grupo_area, oficina_registro   
where grupo_area.id_orip=oficina_registro.id_oficina_registro  and funcionario.id_grupo_area=grupo_area.id_grupo_area and id_cargo=1 and oficina_registro.id_oficina_registro=" . $info . " and id_tipo_oficina=2 and estado_funcionario=1 limit 1");
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$informa='<p style="font-size:12px;">
<br><b>Oficina de registro:</b> <a href="orip&'.$row4['id_oficina_registro'].'.jsp" target="_blank">'.$row4['nombre_oficina_registro'].'</a>
<br><b>Registrador:</b> <a href="usuario&'.$row4['id_funcionario'].'.jsp" target="_blank">'.$row4['nombre_funcionario'].'</a>
<br><b>Circulo:</b> '.$row4['circulo'].'
<br><b>Dirección:</b> '.$row4['direccion_oficina_registro'].'
<br><b>Telefono:</b> '.$row4['telefono_oficina_registro'].'
<br><b>Email:</b> '.$row4['correo_oficina_registro'].'</p>';	
$result4->free();
return $informa;
}

	
	
function infocuraduria ($info) {
global $mysqli;
$query4 = sprintf("SELECT funcionario.id_funcionario, curaduria.id_curaduria, curaduria.nombre_curaduria, nombre_funcionario, nombre_tipo_acto, nombre_situacion_curaduria, direccion_curaduria, telefono_curaduria, correo_curaduria   
FROM situacion_curaduria, curaduria, tipo_acto, funcionario 
WHERE 
situacion_curaduria.id_curaduria=curaduria.id_curaduria 
and situacion_curaduria.id_tipo_acto=tipo_acto.id_tipo_acto 
and situacion_curaduria.id_funcionario=funcionario.id_funcionario 
and situacion_curaduria.id_curaduria=".$info." and fecha_terminacion>='$realdate' and 
estado_situacion_curaduria=1 order by id_situacion_curaduria desc limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$informa='<p style="font-size:12px;">
<b>Curaduria:</b> <a href="curaduria&'.$row4['id_curaduria'].'.jsp" target="_blank">'.$row4['nombre_curaduria'].'</a>
<br><b>Curador:</b> <a href="usuario&'.$row4['id_funcionario'].'.jsp" target="_blank">'.$row4['nombre_funcionario'].'</a>
<br><b>Nombramiento:</b> '.$row4['nombre_tipo_acto'].' - '.$row4['nombre_situacion_curaduria'].'
<br><b>Dirección:</b> '.$row4['direccion_curaduria'].'
<br><b>Telefono:</b> '.$row4['telefono_curaduria'].'
<br><b>Email:</b> '.$row4['correo_curaduria'].'</p>';	
$result4->free();
return $informa;
}	
	
	
	

function personalnotaria ($infop) {
	global $mysqli;
	$personal='<table class="table" border="1"><tr><td>CEDULA</td><td>NOMBRE</td><td>CORREO</td></tr>';
	$querym = "SELECT cedula_funcionario, correo_funcionario, nombre_funcionario FROM funcionario where id_tipo_oficina=3 and id_notaria_f=".$infop."";
$resultadom = $mysqli->query($querym);
	 while ($obj = $resultadom->fetch_object()) {
$personal.= '<tr><td>'.$obj->cedula_funcionario.'</td><td>'.$obj->nombre_funcionario.'</td><td>'.$obj->correo_funcionario.'</td></tr>';
    }
	$personal.='</table>';
	$resultadom->free();
	return $personal;
}

	
	function personalregistro ($infop) {
	global $mysqli;
	$personal='<table class="table" border="1"><tr><td>CEDULA</td><td>NOMBRE</td><td>CORREO</td></tr>';
	$querym = "SELECT nombre_grupo_area, foto_funcionario, funcionario.id_cargo, cedula_funcionario, remoto, nombre_funcionario, correo_funcionario, id_funcionario, nombre_cargo FROM funcionario, grupo_area, cargo 
					where funcionario.id_grupo_area=grupo_area.id_grupo_area and funcionario.id_cargo=cargo.id_cargo and id_oficina_registro=" . $infop . " and id_tipo_oficina=2 and estado_funcionario=1 order by funcionario.id_cargo desc";
$resultadom = $mysqli->query($querym);
	 while ($obj = $resultadom->fetch_object()) {
$personal.= '<tr><td>'.$obj->cedula_funcionario.'</td><td>'.$obj->nombre_funcionario.'</td><td>'.$obj->correo_funcionario.'</td></tr>';
    }
	$personal.='</table>';
	$resultadom->free();
	return $personal;
}



function personalcuraduria ($infop) {
	global $mysqli;
	$personal='<table class="table" border="1"><tr><td>CEDULA</td><td>NOMBRE</td><td>CORREO</td></tr>';
	$querym = "SELECT profesion, cedula_funcionario, correo_funcionario, funcionario.id_funcionario, nombre_funcionario, estado_activo, tipo_relacion, requisitos_curaduria, id_relacion_curaduria 
 FROM relacion_curaduria, funcionario where relacion_curaduria.id_funcionario=funcionario.id_funcionario and relacion_curaduria.id_curaduria=".$infop." and estado_relacion_curaduria=1 ";
$resultadom = $mysqli->query($querym);
	 while ($obj = $resultadom->fetch_object()) {
$personal.= '<tr><td>'.$obj->cedula_funcionario.'</td><td>'.$obj->nombre_funcionario.'</td><td>'.$obj->correo_funcionario.'</td></tr>';
    }
	$personal.='</table>';
	$resultadom->free();
	return $personal;
}



function nombrecategoria($nn) {
	if (1==$nn) {
	$cate='primera';	
	} else if (2==$nn) {
		$cate='segunda';	
	} else if (3==$nn) {		
		$cate='tercera';	
	} else {
		$cate='';
	}
return $cate;	
}


function codigonotaria ($infoc) {
global $mysqli;
$query4 = sprintf("SELECT id_categoria_notaria, nombre_municipio from notaria, municipio where 
notaria.divipola=municipio.divipolaf and id_notaria=".$infoc." limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$informac=nombrecategoria($row4['id_categoria_notaria']).' categoria del circulo de '.$row4['nombre_municipio'].'.';
$result4->free();
return $informac;
}


function codigoregistro ($infoc) {
global $mysqli;
$query4 = sprintf("SELECT circulo from oficina_registro where id_oficina_registro=".$infoc." limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$informac=$row4['circulo'];
$result4->free();
return $informac;
}

function codigocuraduria ($infoc) {
global $mysqli;
$query4 = sprintf("SELECT numero_curaduria from curaduria where id_curaduria=".$infoc." limit 1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$informac=$row4['numero_curaduria'];
$result4->free();
return $informac;
}
	
	
	
	
function quees($table, $valor){
global $mysqli;
$query = "SELECT nombre_".$table." FROM ".$table." where id_".$table."=".$valor." and estado_".$table."=1 limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$info='nombre_'.$table;
if (0<count($row)){
$nameff=$row[$info];
} else { $nameff='No esta parametrizado';}
$result->free();
return $nameff;
}
			   
?>
<div class="container-fluid" >
<div class="row">
        <div class="col-md-11">
	<center>	
<h3><?php echo $nombre_area; ?></h3>
</center>
  <div class="row">
  <div class="col-md-1">
  </div>
<div class="col-md-11">
<?php

	if (10==$id_area) {
	
echo infonotaria($code);
$nombreoficina=quees('notaria',$code); 
$numerooficina=codigonotaria($code);
$personal=personalnotaria($code);

			   } else if (9==$id_area) {
			   
echo inforegistro($code);
$nombreoficina=quees('oficina_registro',$code); 
$numerooficina=codigoregistro($code);
$personal=personalregistro($code);
				} else if (27==$id_area) {
			     
echo infocuraduria($code);
$nombreoficina=quees('curaduria',$code); 
$numerooficina=codigocuraduria($code);
$personal=personalcuraduria($code);

				} else if (26==$id_area) {
			   

			   } else {} 
			 
			   
?>
</div>
</div>
	<form action="" method="post" name="435435">

		<div class="grid-container">
			<div class="grid-width-100">
				<textarea id="editor" name="nombre_visita"><?php
function plantilla($area,$sec) {
global $mysqli;
$querykk = sprintf("SELECT * from plantilla_visita where id_plantilla_visita=".$sec." and id_area=".$area." and estado_plantilla_visita=1");
$result4hjk = $mysqli->query($querykk);
$row4hjk = $result4hjk->fetch_array();
if (0<count($row4hjk)){
$reshhjk=$row4hjk['plantilla_visita'];
} else {
$reshhjk='';
}
return $reshhjk;
$result4hjk->free();
}
			
			
			

$queryk = sprintf("SELECT * from seccion_visita where id_visita=".$id." and id_plantilla_visita=".$seccion." and estado_seccion_visita=1");
$result4hj = $mysqli->query($queryk);
$row4hj = $result4hj->fetch_array();
if (0<count($row4hj)){
echo $row4hj['nombre_seccion_visita'];
} else {
echo plantilla($id_area,$seccion); 
}
$result4hj->free();



?></textarea>
  <br><center>
  
   <button type="submit" class="btn btn-xs btn-success">
				<span class="fa fa-edit" title="Agregar"></span> GUARDAR</button>
				</center>
			</div>
		</div>
	</form>
	
	</div>
	
	<div class="col-md-1" style="background:#f2f2f2;min-height:800px;">
	<b>Historial de cambios</b><br>
<?php
$select3 = mysql_query("select * from seguimiento_visita, funcionario where 
seguimiento_visita.id_funcionario=funcionario.id_funcionario and seguimiento_visita.id_seccion_visita=".$seccion." 
and estado_seguimiento_visita=1 order by id_seguimiento_visita desc ", $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
do {
	echo '<span title="'.$row3['nombre_funcionario'].'" style="font-size:9px;">'.$row3['nombre_seguimiento_visita'].'</span><br>';

	 } while ($row3 = mysql_fetch_assoc($select3)); 

} else {}	 
mysql_free_result($select3);
			?>
			
</div>
</div>
</div>
<?php

} else { echo ''; }	 
mysql_free_result($select);
?>
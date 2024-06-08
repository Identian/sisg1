<?php 
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 
	require_once('listas.php');
	$idper=intval($_POST['option']);
	
$query = sprintf("SELECT * FROM percepcion_oac, ciudadano, servicio_oac where percepcion_oac.id_ciudadano=ciudadano.id_ciudadano and percepcion_oac.id_servicio_oac=servicio_oac.id_servicio_oac and id_percepcion_oac=".$idper." and estado_percepcion_oac=1 limit 1");
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
echo '<div style="padding: 30px 30px 30px 30px">';


$nombre = $row['nombre_ciudadano'];
$identificacion = $row['identificacion'];
$correo_ciudadano = $row['correo_ciudadano'];
$direccion_ciudadano = $row['direccion_ciudadano'];
$id_ciudadano=$row['id_ciudadano'];
$dep=$row['id_departamento'];
$mun=$row['id_municipio'];
$tipod=$row['id_tipo_documento'];
$telefono=$row['telefono_ciudadano'];
$etnia=$row['id_etnia'];



echo '<b>Nombre:</b> '.$nombre.'<br>';
echo '<b>Tipo de documento:</b> ';
echo ''.quees('tipo_documento', $tipod).'<br>';
echo '<b>Identificación:</b> '.$identificacion.'<br>';
echo '<b>Etnia:</b> ';
echo ''.quees('etnia', $etnia).'<br>';
echo '<b>E-mail:</b> '.$correo_ciudadano.'<br>';
echo '<b>Telefono:</b> '.$telefono.'<br>';
echo '<b>Dirección:</b> '.$direccion_ciudadano.'<br>';
echo '<b>Departamento:</b> ';
echo ''.quees('departamento', $dep).'<br>';
echo '<b>Municipio:</b> ';
echo ''.quees('municipio', $mun).'<br><hr>';


if (isset($row['cedula_percepcion']) && ""!=$row['cedula_percepcion']){
echo '<b>Cédula del ciudadano:</b> '.$row['cedula_percepcion'].'<br>';
} else {}
echo '<b>Fecha de la Percepción:</b> '.$row['fecha_percepcion_oac'].'<br>';
echo '<b>Módulo de atención:</b> '.$row['modulo_atencion'].'<br>';
echo '<b>Servidor público que atendio:</b> ';
echo quees('funcionario', $row['id_funcionario_atendio']).'<br>';
echo '<b>Tipo de ciudadano:</b> ';
echo quees('tipo_ciudadano', $row['id_tipo_ciudadano']).'<br>';
echo '<b>Servicio:</b> '.$row['nombre_servicio_oac'].'<br>';
echo '<b>Calificación del servicio:</b> '.calificacion($row['calificacion_servicio']).'<br>';

echo '<b>Comentarios sobre la calificación:</b> '.$row['nombre_percepcion_oac'].'<br>';

echo '<b>Claridad del lenguaje:</b> '.calificacion($row['claridad_lenguaje']).'<br>';
echo '<b>Agilidad en la atención:</b> '.calificacion($row['agilidad_atencion']).'<br>';
echo '<b>Calidad de la respuesta:</b> '.calificacion($row['calidad_respuesta']).'<br>';
echo '<b>Tiempo de respuesta:</b> '.calificacion($row['tiempo_respuesta']).'<br>';
echo '<b>Amabilidad en la atención:</b> '.calificacion($row['amabilidad_atencion']).'<br>';

echo '<b>Observaciones y/o sugerencias:</b> '.$row['observaciones'].'<br>';

echo '</div>';
	mysql_free_result($select);
} else {}

?>



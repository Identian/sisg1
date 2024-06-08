<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json, charset=utf-8");

$hostname_conexion2 = "192.168.80.12";
$database_conexion2 = "sisg";
$username_conexion2 = "sisg";
$password_conexion2 = "C0l0mb1@19*";

global $mysqli;
$mysqli = new mysqli($hostname_conexion2, $username_conexion2, $password_conexion2, $database_conexion2);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}


function privilegios($idperfil, $idfun) {
global $mysqli;
$query4p = "SELECT count(id_funcionario_perfil) as contadorp FROM funcionario_perfil where id_perfil=".$idperfil." and id_funcionario=".$idfun." and estado_funcionario_perfil=1"; 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array();
$resp=$row4p['contadorp'];
return $resp;
$result4p->free();
}



function parametrizacion($not){	
global $mysqli;
$query = "SELECT notaria.id_notaria, anydesk, resolucion_dian, fecha_resolucion_dian, codigo_dane, nombre_departamento, nombre_municipio, notaria.id_departamento, notaria.codigo_municipio, 
	nombre_notaria, email_notaria, correo_rut, nit, celular_n, direccion_n, cod_postal, 
	id_sw, testsetid, llave_tecnica, prefijo, rango_desde, rango_hasta, rango_fecha_desde, rango_fecha_hasta, 
	nombre_notario, vigencia_desde, vigencia_hasta, nombre_funcionario, cedula_funcionario 
	FROM notaria, posesion_notaria, funcionario, notaria_facturacion, departamento, municipio where notaria.id_notaria=posesion_notaria.id_notaria 
	AND departamento.id_departamento=municipio.id_departamento 
	AND notaria.codigo_municipio=municipio.codigo_municipio
and notaria.id_departamento=departamento.id_departamento 
AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND posesion_notaria.fecha_fin IS NULL 
AND estado_notaria=1 
AND estado_funcionario=1 
AND estado_posesion_notaria=1 
AND	notaria.id_notaria=".$not." and notaria.id_notaria=notaria_facturacion.id_notaria limit 1";

$result = $mysqli->query($query);
$obj=$result->fetch_array();

//$namep=utf8_decode($obj['nombre_notario']);
$namep=$obj['nombre_notario']; 



$par = array("id_notaria"=>$obj['id_notaria'], 
"iddepartamento"=>$obj['id_departamento'],
"departamento"=>$obj['nombre_departamento'],
"idmunicipio"=>$obj['codigo_municipio'],
"municipio"=>$obj['nombre_municipio'],
"email_institucional"=>$obj['email_notaria'],
"notaria"=>$obj['nombre_notaria'],
"correo_rut"=>$obj['correo_rut'],
"nit"=>$obj['nit'],
"nombre_software"=>'SNR'.$obj['codigo_dane'],
"id_sw"=>$obj['id_sw'],
"pin"=>'12345',
"testsetid"=>$obj['testsetid'],
"llave_tecnica"=>$obj['llave_tecnica'],
"prefijo"=>$obj['prefijo'],
"resolucion"=>$obj['resolucion_dian'],
"fecha_resolucion"=>$obj['fecha_resolucion_dian'],
"rango_desde"=>$obj['rango_desde'],
"rango_hasta"=>$obj['rango_hasta'],
"rango_fecha_desde"=>$obj['rango_fecha_desde'],
"rango_fecha_hasta"=>$obj['rango_fecha_hasta'],
"direccion"=>$obj['direccion_n'],
"codigo_postal"=>$obj['cod_postal'],
"actividad_economica"=>'6910',
"razon_social"=>'Persona natural',
"nombre_notario"=>$obj['nombre_funcionario'],
"nombre_rut"=>$namep,
"cedula_notario"=>$obj['cedula_funcionario'],
"celular"=>$obj['celular_n'],
"anydesk"=>$obj['anydesk'],
"firma_desde"=>$obj['vigencia_desde'],
"firma_hasta"=>$obj['vigencia_hasta'],
"nit_snr"=>'899999007',
"ip_server"=>'192.168.1.10',
"ps"=>'ca792fe202083cd96733e1d0815c2032'
);

     return $par;
	 $result->free();
}




if (isset($_GET['q'])) {
	

if (1==$_SESSION['rol'] or 1==$_SESSION['snr_tipo_oficina']) {
echo json_encode(parametrizacion($_GET['q']));
} else {
	
if (isset($_SESSION['id_vigilado']) && 3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) {
$id=$_SESSION['id_vigilado'];
echo json_encode(parametrizacion($id));
} else {
$lict = array("permisos"=>0);
echo json_encode($lict);
}		
}

} else {}

?>
<?php
session_start();
if (isset($_GET['q']) && ""!=$_GET['q']) {
	
	
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


$ide=$_GET['q'];
	

header('Content-type: application/pdf; charset=UTF-8');
header("Content-Disposition:attachment;filename='Carnet.pdf'");

function oficina($oficina,$valor){
global $mysqli;
if (1==$oficina) {
$query = "SELECT nombre_area as name from area where id_area=".$valor." limit 1";
} else {
$query = "SELECT nombre_oficina_registro as name from oficina_registro where id_oficina_registro=".$valor." limit 1";
}
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
if (0<count($row)){
return $row['name'];
} else { return '';
}
$result->free();
}



ob_start();
?>
<style>

@page {
	margin-top: 0.2cm;
		margin-left: 0.5cm;
		margin-right: 0;
		margin-bottom: 0.2cm;
	}

div {
position:absolute;
}





.row {
  overflow: auto;
}

.left {
  width: 48%;
}

.right {
  float: right;
  right: 0px;
  width: 48%;
}



#foto {margin-top:68px;margin-left:70px;}   

#foto_funcionario {width:140px;height:150px;border-radius: 15px;}   	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	  	   	  	  	  	  
																																					  #nombre {margin-top:125px;margin-left:25px;font-size:14px;text-align:center;width:180px; }
#nombre {margin-top:228px;margin-left:30px;font-size:14px;text-align:center; width:210px;}

#cedula {margin-top:266px;margin-left:100px;text-align:center;font-size:12px;}

#oficina {margin-top:292px;margin-left:25px;width:180px;text-align:center;font-size:12px;}

#vinculacion {margin-top:325px;margin-left:25px;width:180px;text-align:center;font-size:12px;}

#cargo {
	margin-top:330px;margin-left:30px;font-size:12px;text-align:center; width:170px;
	}

#rh {margin-top:296px;margin-left:150px;font-size:12px;}

#qr {margin-top:340px;margin-left:190px;}	





</style>
<body style="background-image: url('carnet24.jpg'); background-repeat:no-repeat;font-family: 'Arial Black', sans-serif; font-weight: bold;">

<?php //if (file_exists('../fotos/'.$datass['foto']) and isset($datass['foto'])) { ?>

<?php
/*$query4p = sprintf("SELECT rh, nombre_vinculacion, foto_funcionario, cedula_funcionario, nombre_funcionario, nombre_cargo_nomina, correo_funcionario, 
nombre_tipo_oficina, grupo_area.codigo_grupo_area, nombre_grupo_area 
FROM funcionario, cargo_nomina, tipo_oficina, grupo_area, vinculacion 
WHERE funcionario.id_cargo_nomina_encargo=cargo_nomina.id_cargo_nomina and funcionario.id_vinculacion=vinculacion.id_vinculacion  
and cedula_funcionario='$ide' AND funcionario.codigo_grupo_area2=grupo_area.codigo_grupo_area and funcionario.id_tipo_oficina=tipo_oficina.id_tipo_oficina and  funcionario.id_tipo_oficina<3 AND alias_iduca IS NOT NULL AND estado_funcionario=1"); 
*/

$query4p = sprintf("SELECT funcionario.id_funcionario, funcionario.id_tipo_oficina, funcionario.id_grupo_area, rh, foto_funcionario, telefono_funcionario, celular_funcionario, cedula_funcionario, 
nombre_funcionario, correo_funcionario, id_cargo, id_area, id_orip, nombre_cargo_nomina   
FROM funcionario, tipo_oficina, grupo_area, cargo_nomina 
WHERE funcionario.id_funcionario=".$ide." and funcionario.id_cargo_nomina_encargo=cargo_nomina.id_cargo_nomina 
AND funcionario.id_grupo_area=grupo_area.id_grupo_area 
and funcionario.id_tipo_oficina=tipo_oficina.id_tipo_oficina and funcionario.id_tipo_oficina<3 AND alias_iduca IS NOT NULL AND estado_funcionario=1 limit 1");


$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array();
echo '<div id="foto" style="border-radius: 15px;"><img src="../files/'. $row4p['foto_funcionario'].'" style="border-radius: 15px;" id="foto_funcionario"></div>';
echo '<div id="nombre">'.utf8_decode($row4p['nombre_funcionario']).'</div>';
echo '<div id="cedula">CC '.$row4p['cedula_funcionario'].'</div>';
echo '<div id="rh">'. $row4p['rh'].'</div>';
echo '<div id="cargo">';



 if(5==$row4p['id_cargo']) {
 echo 'Contratista';
 } else {
echo $row4p['nombre_cargo_nomina'];
 }

/*
if (1==$row4p['id_cargo']) { 
if (1==$row4p['id_tipo_oficina']) { 
echo 'Directivo';
} else {
echo 'Registrador';
}
} else if(2==$row4p['id_cargo'] or 4==$row4p['id_cargo']) {
echo 'Profesional';
} else if(5==$row4p['id_cargo']) {
echo 'Contratista';
} else if(6==$row4p['id_cargo']) {
echo 'Técnico asistencial';
} else if(7==$row4p['id_cargo']) {
echo 'Judicante';
} else {}
*/
echo '</div>';
/*
echo '<div id="oficina">';
if (1==$row4p['id_tipo_oficina'] && isset($row4p['id_area']) && ""!=$row4p['id_area']) { 
$data=oficina(1,$row4p['id_area']);
echo utf8_decode($data);
} else {}

if (2==$row4p['id_tipo_oficina'] && isset($row4p['id_orip']) && ""!=$row4p['id_orip']) { 
$data=oficina(2,$row4p['id_orip']);
echo utf8_decode($data);
} else {}

echo '</div>';
*/
//echo '<div id="vinculacion">'.utf8_decode($row4p['nombre_vinculacion']).'</div>';
//echo '<div id="rh"></div>';//
//return $resp;

$ced=base64_encode($row4p['id_funcionario']);
$result4p->free();

?>


<div id="qr" >
<a href="https://www.supernotariado.gov.co/perfil/?r=<?php echo $ced; ?>" target="_blank">


<img src="https://sisg.supernotariado.gov.co/qrcode/carnet&<?php echo $ide; ?>.gif">

<!--<img src="https://chart.googleapis.com/chart?chs=90x90&cht=qr&choe=UTF-8&chld=L|0&chl=https://www.supernotariado.gov.co/perfil/?r=<?php //echo $ced; ?>">-->
</a></div>
<?php if ($ide==$_SESSION['snr'] && 1==2) {?>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>

<div id="vcard" style="margin-left:5px;" >
<i>vCard</i><br>
<?php

$vcard = "BEGIN:VCARD\r\nVERSION:3.0\r\n
N:" . $row4p['nombre_funcionario'] . "\r\n
ORG:Superintendencia de Notariado y Registro\r\n
TITLE:" .$data. "\r\n
TEL;TYPE=home,voice:+57" . $row4p['celular_funcionario'] . "\r\n
TEL;TYPE=work,voice:+576013282121#" . $row4p['telefono_funcionario'] . "\r\n
URL;TYPE=work:www.supernotariado.gov.co\r\n
EMAIL;TYPE=internet,pref:" . $row4p['correo_funcionario'] . "\r\n
REV:" . date('Ymd') . "T195243Z\r\n
END:VCARD";

//echo '<img src="https://chart.googleapis.com/chart?chs=275x275&cht=qr&chl='.urlencode($vcard).'&chld=L|1&choe=UTF-8">';

echo '<img src="https://sisg.supernotariado.gov.co/qrcode/vcard&'.$vcard.'.gif">';

?>
</div>
<?php } else {} ?>

</body>
<?php

require_once("../pdf/dompdf_config.inc.php");




$orientation = "portrait"; //portrait    landscape


$paper = array(10,0,235,335);

$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->set_paper($paper, $orientation);
$dompdf->render();
$pdf = $dompdf->output();
$filename = 'Carnet.pdf';
$dompdf->stream("Carnet.pdf", array("Attachment" => false));

} else {
 echo  '<meta http-equiv="refresh" content="0;URL=../index.php" >';
}


?>

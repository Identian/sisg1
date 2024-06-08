<?php

error_reporting(0);
$hostname_conexion = "192.168.80.11";
$database_conexion = "sisg";
$username_conexion = "sisg";
$password_conexion = "C0l0mb1@19*";



global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}


/*
function festivos() {
global $mysqli;
$query = "SELECT * FROM festivo where estado_festivo=1";
$result = $mysqli->query($query);
$festivoa='';
while ($obj = $result->fetch_array()) {
$festivoa.='"'.$obj['nombre_festivo'].'",';
    }
$festivovvv=substr($festivoa, 0, -1);	
return $festivovvv;
$result->free();
}
$festivosv=festivos();
echo $festivosv;
*/


function rev($fechac,$idciud) {
$realdate= date("Y-m-d");
$mas8 = date('Y-m-d', strtotime('+8 day', strtotime($realdate)));

if ($fechac<=$mas8) {

if (6==date('N', strtotime($fechac)) or 7==date('N', strtotime($fechac))) {
	$resul=0;
} else {
	//$resul=1;

global $mysqli;
$fecham=date('Y-m-d');
$query47 = sprintf("SELECT count(id_cita_ventanilla) as conta FROM cita_ventanilla WHERE resultado=0 and id_ciudadano=".$idciud." and fecha_cita>='$fecham' and estado_cita_ventanilla=1 "); 
$result47 = $mysqli->query($query47);
$row47 = $result47->fetch_array(MYSQLI_ASSOC);
$resu47=$row47['conta'];

if (0<$resu47) {
	$resul=0;
} else {
	$resul=1;
}
$result47->free();

}

} else {
	$resul=0;
}
return $resul;
}




function inserta($ventan,$fechav,$tip,$ciud) {
global $mysqli;
	$rev=rev($fechav,$ciud);
	if (0<$rev) {
$query4n = sprintf("insert into cita_ventanilla (id_agenda_ventanilla, fecha_cita, tipo, id_ciudadano, estado_cita_ventanilla) 
values ($ventan, '$fechav', $tip, $ciud, 1)"); 
$result4n = $mysqli->query($query4n);


return '<div class="alert alert-success" style="background:#069169;color:#fff;"  role="alert">Cita agendada con exito para el dia '.$fechav.'. Por favor revisar su correo con los detalles de la Cita.</div>';
$result4n->free();
	} else {
	return '<div class="alert alert-danger" style="background:#D11F3E;color:#fff;"  role="alert">No se ha podido agendar la cita, asegurese que no tiene más citas agendadas.</div>';	
	}
}



function numciudadano($cedul,$emailc) {
global $mysqli;
$query4n = sprintf("SELECT id_ciudadano FROM ciudadano where id_tipo_documento=1 and identificacion='$cedul' and correo_ciudadano='$emailc' and estado_ciudadano=1 order by id_ciudadano desc limit 1"); 
$result4n = $mysqli->query($query4n);
$row4n = $result4n->fetch_array(MYSQLI_ASSOC);
$resn=$row4n['id_ciudadano'];
return $resn;
$result4n->free();
}


function revciudadano($cc) {
global $mysqli;
$query4 = sprintf("SELECT count(identificacion) as contadore FROM ciudadano where id_tipo_documento=1 and identificacion='$cc' and estado_ciudadano=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contadore'];
return $res;
$result4->free();
}

function insertaciudadano($nombrec,$cedulaciudadano,$correoc,$telefonoc,$dep,$mun,$dire) {
global $mysqli;
$revciudadano=revciudadano($cedulaciudadano); 
if (0<$revciudadano) {
$query88 = "UPDATE ciudadano SET nombre_ciudadano='$nombrec', correo_ciudadano='$correoc', telefono_ciudadano='$telefonoc', direccion_ciudadano='$dire' WHERE identificacion='$cedulaciudadano' and id_tipo_documento=1 and id_ciudadano!=21373";  
$result44 = $mysqli->query($query88);
return $query88;
$result44->free();
	} else {
$clave=md5('SupernotariadoyRegistro');
$query4nc = sprintf("INSERT INTO ciudadano (nombre_ciudadano, id_tipo_documento, identificacion,  id_etnia, 
correo_ciudadano, clave_ciudadano, telefono_ciudadano, id_departamento, id_municipio, 
id_tipo_respuesta, fuente, direccion_ciudadano,  estado_ciudadano) 
VALUES ('$nombrec', 1, '$cedulaciudadano', 6, '$correoc', '$clave', '$telefonoc', $dep, $mun, 1, 4, '$dire', 1)");
$result4nc = $mysqli->query($query4nc);
return '';
$result4nc->free();
	} 
}


function ventanillas($orip3) {
global $mysqli;
$query4 = sprintf("SELECT count(DISTINCT numero_ventanilla) as contadora FROM ventanilla where id_oficina_registro=".$orip3." and estado_ventanilla=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contadora'];
return $res;
$result4->free();
}



function disponible($idven,$datec) {
global $mysqli;
$query4v = sprintf("SELECT count(id_cita_ventanilla) as contadorv FROM cita_ventanilla where fecha_cita='$datec' and id_agenda_ventanilla=".$idven." and estado_cita_ventanilla=1"); 
$result4v = $mysqli->query($query4v);
$row4v = $result4v->fetch_array(MYSQLI_ASSOC);
$resul=$row4v['contadorv'];
return $resul;
$result4v->free();
}


function agenda($venta,$cod,$fechad) {
global $mysqli;


$query2 = "SELECT * from ventanilla, agenda_ventanilla where numero_ventanilla=".$venta." and id_oficina_registro=".$cod." and ventanilla.id_ventanilla=agenda_ventanilla.id_ventanilla";

echo '<br><table  class="table table-sm" ><tbody>';
echo '<tr><th>Ventanilla</th><th>Fecha</th><th>Horario</th><th>Tramite</th><th>Estado</th></tr>';
$result2 = $mysqli->query($query2);

while ($obj2 = $result2->fetch_array()) {
	
  
$agendav=$obj2['id_agenda_ventanilla'];

$real=date("Y-m-d H:i:s");
$hoy=strtotime(date("Y-m-d"));
$minute=strtotime(date("H:i:s"));
$fechaq=strtotime($fechad);
$horaq=strtotime($obj2['nombre_agenda_ventanilla']);

//if ($hoy==$fechaq && $horaq<=$minute) {  } else {
	
	
	echo '<tr title="">';
	echo '<td>';
	echo ''.$obj2['numero_ventanilla'];
	echo '</td>';
	echo '<td>';
	echo $fechad;
	echo '</td>';
	echo '<td>';
	echo ''.$obj2['nombre_agenda_ventanilla'];
	echo '</td>';
	echo '<td>';
	echo ''.$obj2['nombre_ventanilla'];
	echo '</td>';
	echo '<td>';
	$disponible=disponible($agendav,$fechad);
	if (0<$disponible) {
$resultado='<span class="ocupado">Ocupado</span>';
} else {

$resultado='<span id="'.$agendav.'" name="'.$fechad.'" title="'.$fechad.'" class="enviarv">Disponible</span>';
}
echo $resultado;
	echo '</td>';
	echo '</tr>';
//}
	}
	
	echo '</tbody></table>';
$result2->free();


}



?>

<section id="contenido">
    <div class="container">
	<div class="row">
                   	<div class="col-12">
<h3 style="color:#777;">Agendamiento de citas de la Superintendencia de Notariado y Registro</h3><br>
        <hr>

<div class="row">
<div class="col-5">
<?php

session_start();
if ((isset($_SESSION['ciu']) && 0!=$_SESSION['ciu']) or (isset($_SESSION['and']))){

if (isset($_SESSION['and'])) {



$name=explode('---', $_SESSION['and']);	
$cedulaciudadano=$name[1];
$nombrec=$name[2];
$correoc=$name[3];
$telefonoc=$name[4];
$dire=$name[5];
$tipo=2;

echo 'Identificación: '.$cedulaciudadano;
echo '<br>Tipo: Cédula de ciudadania';
echo '<br>Nombre: '.$nombrec;
echo '</div><div class="col-5">E-mail: '.$correoc;
echo '<br>Telefono: '.$telefonoc;
echo '<br>Dirección: '.$dire;
echo '</div><div class="col-2 text-right">';
echo ' <a href="login/logout.php" >Cerrar sesión</a> ';


} else {
	
	
$name=explode('---', $_SESSION['ciu']);	

$tipo=1;
$ciudadano=$name[0];


echo 'Identificación: '.$name[1];
echo '<br>Tipo: '.$name[6].'';
echo '<br>Nombre: '.$name[2];
echo '</div><div class="col-5">E-mail: '.$name[3];
echo '<br>Telefono: '.$name[4];
echo '<br>Dirección: '.$name[5];

echo '</div><div class="col-2 text-right">';
echo '<a href="login/?q=salir" >Cerrar sesión</a> ';
}

echo '</div></div><hr>';




if (isset($_POST['infov']) && isset($_POST['datev'])) {
$infovv=intval($_POST['infov']);
$datevv=$_POST['datev'];
$consulv=disponible($infovv,$datevv);
if (0<$consulv) {
echo '<div class="alert alert-warning" style="background:#D11F3E;color:#fff;" role="alert">';
echo 'La cita ya no esta disponible en la fecha y hora seleccionada. Por favor seleccione otra.';
} else {

if (isset($_SESSION['and'])) {


echo insertaciudadano($nombrec,$cedulaciudadano,$correoc,$telefonoc,11,149,$dire);
	
$ciudadano=numciudadano($cedulaciudadano,$correoc);

} else { }


echo inserta($infovv,$datevv,$tipo,$ciudadano);	

}
echo '<hr>';
}
?>

<form method="post" action="" name="formulariov">
<input type="hidden" name="infov" id="enviov" value="">
<input type="hidden" name="datev" id="enviof" value="">
<input type="hidden" name="orip" value="<?php if (isset($_POST['orip'])) {
echo $_POST['orip'];
} else { } ?>">
<input type="hidden" name="fecha" value="<?php if (isset($_POST['fecha'])) {
echo $_POST['fecha'];
} else { } ?>">
</form>

Debe seleccionar una oficina y una fecha junto con el botón buscar.

<form action="" name="for345maa" method="post">
 Oficina:                           
<select class="js-example-basic-multiple" style="width:500px;" name="orip" required>
<option></option>
<option value="0" <?php if (isset($_POST['orip']) && 0==$_POST['orip']) { echo 'selected'; } else {}  ?>><b>OFICINA DE ATENCIÓN AL CIUDADANO - BOGOTÁ</b></option>
<?php	
	function orip($pordefecto) {
	global $mysqli;
	$querym = "SELECT * FROM oficina_registro where estado_oficina_registro=1 order by nombre_oficina_registro";
$resultadom = $mysqli->query($querym);
	 while ($obj = $resultadom->fetch_object()) {
		 
	$or=$obj->id_oficina_registro;
if ($pordefecto==$or and 0!=$pordefecto) {
		  $res='selected';
	} else { $res='';	}
		 
        printf ("<option value='%s' %s>OFICINA DE REGISTRO %s</option>\n",  $or, $res, $obj->nombre_oficina_registro);
    }

	
	
}

if (isset($_POST['orip'])) {
$orip2=$_POST['orip'];
echo orip($orip2);
} else { echo orip(); }

?>
									</select>
                                  
								Fecha
								 
<input readonly type="text" required class="datepickersinfinsemana"  name="fecha" value="<?php if (isset($_POST['fecha'])) {
echo $_POST['fecha'];
} else { } ?>" >
                                 
                                    <button class="btn btn-outline-secondary " style="border-radius: 15px;" type="submit" ><i class="fas fa-search"></i> Buscar</button>
                                
                           
                        </form>
						
                     </div>
					 
				<?php	 } else { 
				

				echo '<br>Debe iniciar sesión para poder agendar la cita.<br><br>
				
				<a href="login/">Iniciar Sesión.</a>
				';} ?>
                    </div>
                
				
	
	
	
        <div class="row">
		<div class="col-12" style="color:#777;">
		<p style="font-size:25px;">

</p>
<p>

<?php
if (isset($_POST['orip']) && ""!=$_POST['orip'] && isset($_POST['fecha'])){
	$fechacitacion=$_POST['fecha'];
	?>
	<div id="tabs">
  <ul><?php
$nventa= ventanillas(intval($_POST['orip']));
if (0<$nventa) {
for ($i = 1; $i <= $nventa; $i++) {
	echo '<li><a href="#tabs-'.$i.'">Ventanilla '.$i.'</a></li>';
}
echo '</ul>';

for ($v = 1; $v <= $nventa; $v++) {
echo '<div id="tabs-'.$v.'"><p>';
echo agenda($v,intval($_POST['orip']),$fechacitacion);
 echo '</p></div>';
}

	

} else { echo 'No existe agenda para la oficina';}
	

} else {
echo '';
}
?>

 
</div>


<br><br>
Para mayor información ingrese a: www.supernotariado.gov.co. 


	</p>
		

		
		  </div>
        </div>
  
  </div>
</section>







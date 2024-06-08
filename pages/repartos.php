<?php

$nump115=privilegios(115,$_SESSION['snr']);


if (1226==$_SESSION['snr'] or 0<$nump115) { 


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
and id_notaria IS NOT null) and id_departamento=".$dep." and codigo_municipio=".$mun." 
and estado_notaria=1 and estado_reparton=1";
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
	
	$fechacompleta=date('Y-m-d h:i:s');
	$mas24 = date('Y-m-d h:i:s', strtotime('+1 day', strtotime($fechacompleta)));
	
	$update22 = sprintf("UPDATE reparto set  
  fecha_ejecuta_reparto=%s, revisado=1 where id_reparto=%s and id_notaria is null and estado_reparto=1 and fecha_ejecuta_reparto is null",
      GetSQLValueString($mas24, "date"),
		GetSQLValueString($reparto, "int")
      );
      $Resultp = mysql_query($update22, $conexion);




	
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
and id_notaria IS NOT null) and id_departamento=".$id_departamento." and codigo_municipio=".$id_municipio." 
and estado_notaria=1  and estado_reparton=1 ORDER BY RAND() LIMIT 1");



$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
$notaria=$row2['id_notaria'];

mysql_free_result($update2);
mysql_free_result($select2);



$aleatorio=rand(0, 9);
$unico=$id_categoria_reparto.$ronda.$notaria.$aleatorio;


$query_updater = "SELECT count(id_reparto) as cuentar FROM reparto where id_reparto= ".$reparto." and id_notaria is not null ";
$updater = mysql_query($query_updater, $conexion);
$row_r = mysql_fetch_assoc($updater);
if (0<$row_r['cuentar'])
{ echo 'Ya se repartio'; } else {
	
	

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


$linkp='https://servicios.supernotariado.gov.co/filesrep/'.$hash.'.pdf';
$urliris=$hash;
$clavep = substr($urliris, -4);


/*
$horao=date('H:i:s');
$fecha_actual = strtotime($horao);
$fecha_limite = strtotime("14:00:00");

if ($fecha_actual<$fecha_limite) {
} else { }
*/
$emailu=''.$correo_entidad.','.$correonotaria.','.$correos_intervinientes;

//$emailu='giovanni.ortegon@supernotariado.gov.co,miguel.gonzalez@supernotariado.gov.co';


$subject = 'Reparto notarial.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Se realizo el reparto del proyecto ".$nombre_reparto." para la entidad ".$nombre_entidad_reparto."<br>";
$cuerpo .= "<br><br>Se ha enviado la notificación del acta de reparto a: ".$emailu;
$cuerpo .= "<br><br>Fecha y hora del acta de reparto: ".$fechareparto;
$cuerpo .= '<br><br>Enlace del acta: <a href="https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash.'.pdf">https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash.'.pdf</a><br>';

$cuerpo .= '<br><br>Las personas naturales deben usar la dirección web: <a href="'.$linkp.'">'.$linkp.'</a> ';
$cuerpo .= '<br> y acceder con la clave: '.$clavep.'<br>';


$cuerpo .= "<br><br>Notaria seleccionada: ".quees('notaria',$notaria)."<br>";
$cuerpo .= "<br><br>Categoria de reparto: ".quees('categoria_reparto',$id_categoria_reparto)."<br>";
$cuerpo .= "<br><br>Hash de seguridad: ".$hash."<br>";
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'cc: reparto.notarial@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";


$query_updatera = "SELECT count(id_reparto) as cuentan FROM reparto where id_reparto= ".$reparto." and hash is not null ";
$updatera = mysql_query($query_updatera, $conexion);
$row_ra = mysql_fetch_assoc($updatera);
//if (0<$row_ra['cuentan']) { 
mail($emailu,$subject,$cuerpo,$cabeceras);
// } else {  }


	

} 
mysql_free_result($updatera);

mysql_free_result($updater);

} else {}


} else {}





function categoria($valor,$unidades) {
	$valore=intval($valor);
	$unidad=intval($unidades);
	if (650000000<=$valore or 501<=$unidad) {
    $resultado=1;
	} else if ((450000000<=$valore && 649999999>=$valore) or (301<=$unidad && 500>=$unidad)) {
	$resultado=2;	
	} else if ((250000000<=$valore && 449999999>=$valore) or (101<=$unidad && 300>=$unidad)) {
	$resultado=3;
	} else if ((1<=$valore && 249999999>=$valore) and (1<=$unidad && 100>=$unidad)) {
	$resultado=4;
	} else if (0==$valore and 0<$unidad) {
	$resultado=5;
	}
	else {
	$resultado=0;
	}
	return $resultado;
}


if ((isset($_POST["nombre_reparto"])) && (""!=$_POST["nombre_reparto"])) {
	
	

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
  
  
  
  $cuantia = str_replace(",", "", $_POST["cuantia"]);
  
  
  if (isset($_POST['id_categoria_reparto']) && ""!=$_POST['id_categoria_reparto']) {
	if (0==intval($_POST['id_categoria_reparto'])) {
  $categoria=categoria($cuantia,$_POST["unidades"]);
	} else {
  $categoria=intval($_POST["id_categoria_reparto"]);
	}
  
 
$fecha_ingreso= $_POST["fecha_ingreso"];

if ($realdate>=$fecha_ingreso) {

  $mun=explode('-',$_POST["mun"]);
  $depa=$mun[0];
$munci=$mun[1];

$estud=$_POST['actos'];
$estu='';
for ($u=0;$u<count($estud);$u++)    
{     
$estu.=$estud[$u].',';    
}


$insertSQL = sprintf("INSERT INTO reparto (
fecha_registro, fecha_ingreso, id_entidad_reparto, codigo, radicado, id_departamento, id_municipio, nombre_reparto, 
direccion_reparto, matriculas, actos, intervinientes, correos_intervinientes, observaciones, 
url, cuantia, 
unidades, id_categoria_reparto, estado_reparto) 
VALUES (now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($fecha_ingreso, "date"), 
GetSQLValueString(intval($_GET["i"]), "int"),
GetSQLValueString($_POST["codigo"], "text"), 
GetSQLValueString($_POST["radicado"], "text"), 
GetSQLValueString($depa, "int"),
GetSQLValueString($munci, "int"),
GetSQLValueString($_POST["nombre_reparto"], "text"),
GetSQLValueString($_POST["direccion_reparto"], "text"),
GetSQLValueString($_POST["matriculas"], "text"),
GetSQLValueString($estu, "text"),
GetSQLValueString($_POST["intervinientes"], "text"),
GetSQLValueString($_POST["correos_intervinientes"], "text"),
GetSQLValueString($_POST["observaciones"], "text"),
GetSQLValueString($files, "text"), 
GetSQLValueString($cuantia, "int"),
GetSQLValueString($_POST["unidades"], "int"),
GetSQLValueString($categoria, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
 
  echo $insertado;
  
    } else {  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>La fecha de registro no puede ser superior a hoy.</div>';
  }
  
  
  } else {}
  
  

   
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
 


 if (isset($_POST['rechazo']) && ''!=$_POST['rechazo'] && isset($_POST['id_rechazo']) && ''!=$_POST['id_rechazo']) {
$rechazo=$_POST['rechazo'];
$id_rechazo=intval($_POST['id_rechazo']);


$query_update2 = "SELECT reparto.id_reparto, nombre_reparto, correos_intervinientes, id_categoria_reparto, id_departamento, id_municipio, nombre_entidad_reparto, correo_entidad  
FROM reparto, entidad_reparto  WHERE reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto and reparto.id_reparto=".$id_rechazo."  and estado_reparto=1 limit 1";
$update2 = mysql_query($query_update2, $conexion);
$row_update2 = mysql_fetch_assoc($update2);
$totalRows_update2 = mysql_num_rows($update2);
if (0<$totalRows_update2){
	
	$id_reparto=$row_update2['id_reparto'];
	$nombre_entidad_reparto=$row_update2['nombre_entidad_reparto'];
	$nombre_reparto=$row_update2['nombre_reparto'];
	$correo_entidad=$row_update2['correo_entidad'];
	$correos_intervinientes=$row_update2['correos_intervinientes'];
} else {}
mysql_free_result($update2);


		$updateSQL77 = sprintf("UPDATE reparto SET estado_reparto=0, rechazo=%s 
   where id_reparto=%s",
GetSQLValueString($rechazo, "text"), 
GetSQLValueString($id_rechazo, "int"));
 $Result = mysql_query($updateSQL77, $conexion);
	echo $actualizado;	
	
	
	
	
	
$emailu=''.$correo_entidad.','.$correos_intervinientes;
//$emailu='giovanni.ortegon@supernotariado.gov.co';
$subject = 'Rechazo de reparto notarial.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Se rechazo el reparto del proyecto ".$nombre_reparto." para la entidad ".$nombre_entidad_reparto."<br>";
$cuerpo.= 'Motivo: '.$rechazo.'<br>';
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'cc: reparto.notarial@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);
	
	} else {}













if(1==$_SESSION['rol'] && isset($_POST['nombre_entidad_reparto2']) && ""!=$_POST['nombre_entidad_reparto2']) {
  $updateSQL = sprintf("UPDATE reparto SET id_entidad_reparto=%s WHERE id_reparto=%s",
                  
					   GetSQLValueString($_POST["nombre_entidad_reparto2"], "int"),
					   GetSQLValueString($_POST["reparto_proyecto"], "int"));
  $Result1 = mysql_query($updateSQL, $conexion);
  echo $actualizado;
} else {}

?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('entidad_reparto'); ?></h3>

              <p>Total de Entidades</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="entidades_reparto.jsp" class="small-box-footer">Ir a Entidades <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="https://sisg.supernotariado.gov.co/xls/reparto_notarial.xls" class="small-box-footer">Descargar Reporte <i class="fa fa-arrow-circle-right"></i></a>
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
              <h3><?php echo existencia('reparto'); ?></h3>
              <p>Registros activos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="xls/repartos.xls" class="small-box-footer">Descargar. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
 
	  
	

<div class="col-md-4">
 REPARTOS
</div>
<div class="col-md-8">
<form action="" method="post" name="rtret">
<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected>- - - Buscar por:  - - - - </option>
 		  <option value="id_reparto"># Acta</option>
		   <option value="matriculas">Matricula</option>
		   <option value="intervinientes">Ciudadano</option>
		  
		  </select>
</div>
<div class="input-group-btn"><input type="text" style="width:250px;" name="buscar" placeholder="Buscar" class="form-control" required ></div>
 
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
</div>
</form>
</div>
	
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
<style>
    .dataTables_filter {
          display: none;
        }
	
      </style>
			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Id</th>
 <th>Entidad</th>
 <th>Fecha registro</th>
 <th>Matriculas</th>
 <th>Proyecto</th>
 <th>Código</th>
 <th>Departamento</th>
 <th>Municipio</th>
 <th>Categoria</th>
 <th>Ronda</th>
<th>Resultado</th>	
<th>Estado</th>			 	
<th style="width:150px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

			if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
$querynn = " and ".$_POST['campo']." like '%".$_POST['buscar']."%'";

		$query4="SELECT * from reparto, entidad_reparto, departamento, categoria_reparto where 
		reparto.id_departamento=departamento.id_departamento ".$querynn." 
		and reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto  
		and reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto ORDER BY id_reparto desc  "; 	

	} else {

		$query4="SELECT * from reparto, entidad_reparto, departamento, categoria_reparto where 
		reparto.id_departamento=departamento.id_departamento and hash is null and estado_reparto=1 
		and reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto  
		and reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto  ORDER BY id_reparto desc  "; 
}//and fecha_ejecuta_reparto is null



	/*	$query4="SELECT * from reparto, entidad_reparto, departamento, categoria_reparto where 
		reparto.id_departamento=departamento.id_departamento 
		and reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto  
		and reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto ORDER BY id_reparto desc  "; 

 */
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_reparto'];

echo '<td>'.$id_res.'</td>';
echo '<td>'.$row['nombre_entidad_reparto'].'</td>';
echo '<td>'.$row['fecha_ingreso'].'</td>';
echo '<td>'.$row['matriculas'].'</td>';
echo '<td>';
echo $row['nombre_reparto'];
echo '</td>';
echo '<td>'.$row['codigo'].'</td>';
echo '<td title="'.$row['id_departamento'].'">'.$row['nombre_departamento'].'</td>';
echo '<td title="'.$row['id_municipio'].'">';
echo nombre_municipio($row['id_municipio'], $row['id_departamento']);
echo '</td>';

echo '<td>'.$row['nombre_categoria_reparto'].'</td>';
echo '<td>'.$row['id_ronda_reparto'].'</td>';


echo '<td>';
if (0==$row['estado_reparto']) {
	
echo '<b>RECHAZADA: </b> '.$row['rechazo'];
} else {


//if (isset($row['fecha_ejecuta_reparto'])) {
	//echo '<b>REVISADO </b>' ; } else {

if (isset($row['id_notaria']) && ""!=$row['id_notaria']) {
	echo quees('notaria',$row['id_notaria']);
} else {
$mun=$row['id_municipio'].'-'.$row['id_departamento'];
echo ' <a href="" class="buscar_reparto" id="'.$id_res.'" title="Reparto" data-toggle="modal" data-target="#popupreparto"><span class="btn btn-xs btn-info">Revisar</span></a> ';
echo ' <a href="" class="buscar_circulonotarial" id="'.$mun.'" title="Circulo Notarial" data-toggle="modal" data-target="#popupcirculonotarial"> <span class="btn btn-xs btn-warning">Notarias</span></a> ';
}

/////}


}
echo '</td><td>';


if (isset($row['id_notaria']) && ""!=$row['id_notaria']) {
	echo 'ok';
} else {
	echo 'Falta';
}
echo '</td><td>';
if (isset($row['url']) && "web.pdf"!=$row['url']) {
echo ' <a href="filesnr/reparto/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';
} else {}
if (isset($row['id_notaria']) && ""!=$row['id_notaria']) {
//echo ' <a href="pdf/acta_reparto&'.$id_res.'.pdf"> <span class="btn btn-xs btn-success">Acta</span></a> ';
$hash2=$row['hash'];
echo ' <a href="https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash2.'.pdf" download=""> <span class="btn btn-xs btn-success">Acta</span></a> ';


//echo ' <a href="mailto:'.$row['correos_intervinientes'].'?cc=reparto.notarial@supernotariado.gov.co&subject=Notificacion-Reparto&body=Reparto Notarial"> 
//<span class="btn btn-xs btn-danger">Notificar</span></a> ';

} else {
//echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="reparto" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
}




if (1==$_SESSION['rol']) {
	echo ' <a href="" class="cambiarentidad" id="'.$id_res.'" title="Cambiar entidad" data-toggle="modal" data-target="#popupcambiarentidad"> <span class="fa fa-edit"></span></a> ';
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
						"aaSorting": [[ 0, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (1==$_SESSION['rol']  or 0<$nump115) { ?>








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




<div class="modal fade" id="popupcambiarentidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Cambiar entidad</b></h4>
</div> 
<div id="ver_cambiarentidad" class="modal-body"> 

</div>
</div> 
</div> 
</div>


	  



<?php } else { }


} else {} ?>


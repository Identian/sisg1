<?php
if (isset($_GET['i']) && "" != $_GET['i'] && 1==1) {
  $id = $_GET['i'];


$nump107 = privilegios(107, $_SESSION['snr']);

 if (0<$nump107) { 
$_SESSION['permiso107']=107;
 } else { $_SESSION['permiso107']=0; }  





if ((0<$nump107 or 1==$_SESSION['rol']) and (isset($_POST["correccionrad"]) && "321"==$_POST["correccionrad"])) {

$idcorreccion=$_POST["id_radicacion_curaduria_correccion"];
	
$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/radicacion_curaduria/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'correccion-'.$id.'-'.$identi;

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
  $filesa = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$filesa);
  chmod($filesa,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
  } else {
$filesa='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
  }
} else { 
$filesa='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}
		

} else { 
$filesa='';	
	}	
	

$hh=$_POST["correcciones"].'/'.$filesa;
$update24 = sprintf("UPDATE radicacion_curaduria set numero_radicacion_curaduria=%s,  
  desc_correccion=%s, radicacion_legal=%s, url_correccion=%s, fecha_radicacion_curaduria=%s, fecha_cambio_legal=%s, fecha_cambio_estado=%s, 
  fecha_ini_suspension=%s, fecha_fin_suspension=%s,  
  matriculas=%s, estado=%s, correcciones=%s where id_radicacion_curaduria=%s and id_curaduria=%s",
  
  GetSQLValueString($_POST["numero_radicacion_curaduriac"], "int"),
  	GetSQLValueString($_POST["desc_correccion"], "text"),
	GetSQLValueString($_POST["radicacion_legal_updateadmin"], "text"),
		GetSQLValueString($filesa, "text"),
		GetSQLValueString($_POST["fecha_radicacion_curaduriac"], "date"),
		GetSQLValueString($_POST["fecha_cambio_legalc"], "date"),
		GetSQLValueString($_POST["fecha_cambio_estadoc"], "date"),
		GetSQLValueString($_POST["fecha_ini_suspension"], "date"),
		GetSQLValueString($_POST["fecha_fin_suspension"], "date"),
		GetSQLValueString($_POST["matriculasc"], "text"),
		GetSQLValueString($_POST["estadoccc"], "text"),
		GetSQLValueString($hh, "text"),
		GetSQLValueString(intval($idcorreccion), "int"),
		GetSQLValueString($id, "int")
      );
	
      $Resultp4 = mysql_query($update24, $conexion);
	  echo $insertado;
		//echo  $update24;
		  
	  } else {}
	  




if (0<$nump107 or 1==$_SESSION['rol'] or 4==$_SESSION['snr_tipo_oficina']) {
	



	
	if (isset($_POST['estado_r'])) {
	
	
$estud2=$_POST['tipo_licencia2'];
$tipolicencia2='';
for ($u=0;$u<count($estud2);$u++)    
{     
$tipolicencia2.=$estud2[$u].',';    
}


//fecha_radicacion_curaduria=%s, 
			
 $update = sprintf("UPDATE radicacion_curaduria set 
 numero_radicacion_curaduria=%s,  
 radicacion_legal=%s, 
 id_objeto_lic_curaduria=%s, 
  tipo_licencia=%s, 
   verdadero_objeto=%s, 
 actuacion=%s, 
 
 fecha_cambio_legal=%s, 
 cedulas=%s, 
 matriculas=%s, 
 nombre_radicacion_curaduria=%s,   
 estado=%s, 
 fecha_cambio_estado=%s, 
fotovalla=%s, 
notivecinos=%s, 
fechanotivecinos=%s, 
actaobserva=%s, 
fechaactaobserva=%s, 
respuestaobserva=%s, 
actaviabilidad=%s, 
fechaactaviabilidad=%s, 
pagos=%s, 
expeactoadmin=%s, 
notiactoadmin=%s, 
recurso=%s, 
fechapresrecurso=%s, 
fecharecursorepo=%s, 
fecharecursoape=%s, 
fecharesrecursoape=%s 
 where id_radicacion_curaduria=%s and id_curaduria=%s",
GetSQLValueString($_POST["numero_completo"], "int"),        
GetSQLValueString($_POST["radicacion_legal_update"], "text"),		
GetSQLValueString(1, "int"), 

GetSQLValueString($tipolicencia2, "text"),
GetSQLValueString($_POST["verdadero_objeto2"], "text"),


GetSQLValueString($_POST["actuacion2"], "text"),
//GetSQLValueString($_POST["fecha_radicacion_curaduria"], "date"),
GetSQLValueString($_POST["fecha_cambio_legal"], "date"),
GetSQLValueString($_POST["cedulas2"], "text"), 
GetSQLValueString($_POST["matriculas2"], "text"), 
GetSQLValueString($_POST["nombre_radicacion_curaduria"], "text"), 
GetSQLValueString($_POST["estado_r"], "text"),
GetSQLValueString($_POST["fecha_cambio_estadoc"], "date"),
		 

GetSQLValueString($_POST["fotovalla"], "text"),
GetSQLValueString($_POST["notivecinos"], "text"),
GetSQLValueString($_POST["fechanotivecinos"], "date"),
GetSQLValueString($_POST["actaobserva"], "text"),	
GetSQLValueString($_POST["fechaactaobserva"], "text"),
GetSQLValueString($_POST["respuestaobserva"], "text"),	
GetSQLValueString($_POST["actaviabilidad"], "text"),
GetSQLValueString($_POST["fechaactaviabilidad"], "date"),	
GetSQLValueString($_POST["pagos"], "text"),
GetSQLValueString($_POST["expeactoadmin"], "text"),	
GetSQLValueString($_POST["notiactoadmin"], "text"),
GetSQLValueString($_POST["recurso"], "text"),	
GetSQLValueString($_POST["fechapresrecurso"], "date"),
GetSQLValueString($_POST["fecharecursorepo"], "date"),	
GetSQLValueString($_POST["fecharecursoape"], "date"),
GetSQLValueString($_POST["fecharesrecursoape"], "date"),	 
		 
		 
		 
		 
		GetSQLValueString(intval($_POST["id_radicacion_curaduria"]), "int"),
		GetSQLValueString($id, "int")
      );
      $Resultp = mysql_query($update, $conexion);
	  
	  
		
	//  echo $update;
	 
	  
	  
	  /*
	  if ('Si'==$_POST["radicacion_legal_update"]) {
$update2 = sprintf("UPDATE radicacion_curaduria set  
  fecha_cambio_legal=now() where id_radicacion_curaduria=%s and id_curaduria=%s and fecha_cambio_legal is null",
		GetSQLValueString(intval($_POST["id_radicacion_curaduria"]), "int"),
		GetSQLValueString($id, "int")
      );
      $Resultp = mysql_query($update2, $conexion);
	  
		  
	  } else {}*/
	  
	  
      echo $actualizado;


	} else {}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
 if (isset($_POST["id_radicacion_curaduria_file"]) && ""!=$_POST["id_radicacion_curaduria_file"]) {
	 
	 
	 
$id_radicacion_curaduria_file=intval($_POST["id_radicacion_curaduria_file"]);

	
	
	
$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/radicacion_curaduria/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'radicado-'.$id.'-'.$identi;

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
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  


$update22 = sprintf("UPDATE radicacion_curaduria set  
  url=%s where id_radicacion_curaduria=%s and id_curaduria=%s",
      GetSQLValueString($files, "text"),
		GetSQLValueString($id_radicacion_curaduria_file, "int"),
		GetSQLValueString($id, "int")
      );
      $Resultp = mysql_query($update22, $conexion);
echo $actualizado;



   
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
	
	
	  } else {}
	  
	
	
	
	
if (1==$_SESSION['rol'] or 0<$nump107) {
	
$query = sprintf("SELECT * FROM curaduria where id_curaduria=".$id."  and curaduria.estado_curaduria=1 limit 1"); 
	
} 
else {
$idfun=intval($_SESSION['snr']);
$query = sprintf("SELECT * FROM curaduria, situacion_curaduria where (situacion_curaduria.fecha_terminacion>='$realdate' or situacion_curaduria.fecha_terminacion is null) and curaduria.id_curaduria=situacion_curaduria.id_curaduria  and curaduria.id_curaduria=".$id." and situacion_curaduria.id_funcionario=".$idfun."  and curaduria.estado_curaduria=1 and estado_situacion_curaduria=1 limit 1"); 
	
}

$select = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
$name = $row1['nombre_curaduria'];
$dep = $row1['departamento_curaduria'];
$ciudad = $row1['ciudad_curaduria'];
$tele = $row1['telefono_curaduria'];
$celu = $row1['celular_curaduria'];
$dire = $row1['direccion_curaduria'];
$nombre_curador = $row1['nombre_funcionario'];
$correo = $row1['correo_funcionario'];
$correo_curaduria = $row1['correo_curaduria'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];
$ncuraduria=$row1['numero_curaduria'];
}
	
	
$ano=date('y');
$radica=$id_departamento.$id_municipio.'-'.$ncuraduria.'-'.$ano.'-';
	
	
if (isset($_POST['verdadero_objeto']) && ""!=$_POST['verdadero_objeto'] 
&& isset($_POST['actuacion'])) {
	
	
	
	/*
	
$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/radicacion_curaduria/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'radicado-'.$id.'-'.$identi;

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
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
 */
  
  

	
//$query_update22 = "SELECT max(numero_radicacion_curaduria) as maximo FROM radicacion_curaduria 
//WHERE id_curaduria=".$id." and estado_radicacion_curaduria=1 limit 1";

$query_update22 = "SELECT count(id_radicacion_curaduria) AS maximo FROM radicacion_curaduria 
WHERE id_curaduria=".$id." and ano_radicado=".$ano." and estado_radicacion_curaduria=1";


$update22 = mysql_query($query_update22, $conexion) ;
$row_update22 = mysql_fetch_assoc($update22);
if (isset($row_update22['maximo']) or 0!=$row_update22['maximo']) {
	$numero2=$row_update22['maximo'];
$numero=$numero2+1;
} else {
$numero=0001;
}



$numerounico=$_POST['numerounico'];

$query_update4 = "SELECT numero_radicacion_curaduria FROM radicacion_curaduria WHERE id_curaduria=".$id." and numero_radicacion_curaduria!=".$numerounico." and estado_radicacion_curaduria=1 ";
$update4 = mysql_query($query_update4, $conexion);
$row_update4 = mysql_fetch_assoc($update4);
$totalRows_update4 = mysql_num_rows($update4);
if (0<$totalRows_update4){
echo $repetido;
	} else {
	

$estud=$_POST['tipo_licencia'];
$tip='';
for ($u=0;$u<count($estud);$u++)    
{     
$tip.=$estud[$u].',';    
}


$fechac=date('Y-m-d');

$unico=$id.$ano.$numero;
$insertSQL = sprintf("INSERT INTO radicacion_curaduria (id_curaduria, ano_radicado, codigo_curaduria, tipo_licencia, verdadero_objeto, 
numero_radicacion_curaduria, unico_radicado, 
id_objeto_lic_curaduria, actuacion, radicacion_legal, fecha_radicacion_curaduria, cedulas, 
matriculas, estado, nombre_radicacion_curaduria,  
 estado_radicacion_curaduria) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", //%s,
GetSQLValueString($id, "int"),
GetSQLValueString($ano, "int"),
GetSQLValueString($radica, "text"), 
GetSQLValueString($tip, "text"), 
GetSQLValueString($_POST["verdadero_objeto"], "text"), 
GetSQLValueString($numero, "int"), 
GetSQLValueString($unico, "int"), 
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST["actuacion"], "text"), 
GetSQLValueString($_POST["radicacion_legal"], "text"), 
GetSQLValueString($fechac, "date"), 
GetSQLValueString($_POST["cedulas"], "text"), 
GetSQLValueString($_POST["matriculas"], "text"), 
GetSQLValueString('Radicado', "text"), 
//GetSQLValueString($files, "text"), 
GetSQLValueString($_POST["nombre_radicacion_curaduria"], "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

// echo $insertado;
 
echo '<script type="text/javascript">swal(" OK !", " Radicado correctamente con el número: '.$numero.' ", "success");</script>';

 
 
}


   /*
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
	*/

mysql_free_result($update22);
}





 
if($_SERVER['REQUEST_METHOD'] == 'POST'){

$camp = json_encode($_POST);

if (isset($_POST["id_radicado"]) && ""!=$_POST["id_radicado"]) {
$infocur=intval($_POST["id_radicado"]);
} else 
{
$infocur=0;
}

$insertSQL88p = sprintf("INSERT INTO traza_radicacion (id_funcionario, id_radicacion_curaduria, nombre_traza_radicacion) 
VALUES (%s, %s, %s)",
                       GetSQLValueString($_SESSION['snr'], "int"),
					      GetSQLValueString($infocur, "int"),
					   GetSQLValueString($camp, "text"));
$Result188p = mysql_query($insertSQL88p, $conexion);
mysql_free_result($Result188p);

}
 
 

?>




    <div class="row">
      <div class="col-md-12">


        <div class="box box-primary">
		

	
          <div class="box-body box-profile">


Radicación de solicitud de licencias urbanisticas y otras solicitudes. Conforme con Resolución 1026 - 2021 de MinVivienda.
			<strong>  &nbsp; /
	   <?php echo $name; 
	   echo ' - ';
	   echo quees('departamento', $id_departamento); 
	    echo ' - ';
	   echo nombre_municipio($id_municipio, $id_departamento); 

	   ?>
</strong> 
<?php

	if (1==$_SESSION['rol'] or 0<$nump107) { 

echo ' <a href="auditoria&'.$id.'.jsp" title="Auditoria" target="_blank"> <i class="fa fa-folder-open-o"></i> Auditar</a> ';

} else {}
	?>

          </div>


  
        <div class="nav-tabs-custom">



	 
          

          <div class="tab-content">
		  
		  
		  
		   <form class="navbar-form" name="fotertrm5435435rter1erteg" method="post" action="">
<B>  Buscar</B> 
              <div class="input-group">
                <div class="input-group-btn">
                  <select class="form-control" name="campo" required>
                    <option value="" selected> - - Buscar por: - - </option>

<option value="numero_radicacion_curaduria">Número de radicación (Últimos 4 digitos)</option>
<option value="cedulas">Cédulas</option>
<option value="matriculas">Matriculas</option>
mas30dias
                  </select>
                </div><!-- /btn-group -->
                <div class="input-group-btn">
                  <input type="text" name="buscar" placeholder="" class="form-control" required></div>
                <!-- /input-group -->
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                </div>
              </div>

            </form>
			
			
		  
		  
		  
<?php  if (1==$_SESSION['rol'] or 0<$nump107 or 4==$_SESSION['snr_tipo_oficina']) { 

function cambioestado($idv,$idc){
 return '<b>Aviso: Se van a desistir radicaciones por tiempo superior a 30 dias y por NO estar en debida forma.</b> 
 Número: '.$idc.' <br>';
}

function actualizarestado30($idv,$idc){
	global $mysqli;
//$query885 = "UPDATE radicacion_curaduria SET estado='Desistido' WHERE id_radicacion_curaduria=".$idv." and id_curaduria=".$idc." limit 1";  

$query885 = "UPDATE radicacion_curaduria SET mas30dias=1, estado='Desistido' WHERE id_radicacion_curaduria=".$idv." and id_curaduria=".$idc." limit 1";  
$result445 = $mysqli->query($query885);
return;
$result445->free();

}



function tipo_tramite($rad){
global $mysqli;
$queryk = "select nombre_clase_licencia, licencia_curaduria.id_licencia_curaduria  from clase_licencia, tipo_autorizacion_licencia, licencia_curaduria WHERE 
tipo_autorizacion_licencia.id_licencia_curaduria=licencia_curaduria.id_licencia_curaduria AND 
clase_licencia.id_clase_licencia=tipo_autorizacion_licencia.id_clase_licencia and nombre_licencia_curaduria='$rad' 
and estado_clase_licencia=1 and estado_tipo_autorizacion_licencia=1 and situacion_tipo_autorizacion_licencia=1";
$result48k = $mysqli->query($queryk);
while ($obj5k = $result48k->fetch_array()) {

$ref=$obj5k['nombre_clase_licencia'].'&&&'.$obj5k['id_licencia_curaduria'].'|||';

}
$result48k->free();
return $ref;
}



?>
  
  
	
 <a href="" class="btn btn-success" data-toggle="modal" data-target="#popupnewlicencia"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo </a> 

<?php if (1==$_SESSION['rol'] or 0<$nump107) { ?>
 <a href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#popupnewradicacion2"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo </a> 
<?php } else {} ?>



<br><br>
	  
<?php } else {} ?>

		  
            <div class="active tab-pane" id="activity">

              <div class="post">
                <div class="user-block">
                  <div class="col-xs-12 table-responsive ">

                    <?php
					
					if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                $infobus = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' limit 500";
                
              } else {
				  
				
                $infobus = " order by id_radicacion_curaduria desc"; // limit 600 
              
			  }
					
	 if (0<$nump107 OR 1==$_SESSION['rol']) { 
$queryn = "SELECT * FROM radicacion_curaduria, objeto_lic_curaduria where 
radicacion_curaduria.id_objeto_lic_curaduria=objeto_lic_curaduria.id_objeto_lic_curaduria  
and radicacion_curaduria.id_curaduria=".$id." ".$infobus." ";
 



 } else { 
 
 
$queryn = "SELECT * FROM radicacion_curaduria where id_curaduria=".$id."   and estado_radicacion_curaduria=1 ".$infobus."";
 
 }  

 
                   
					
					$selectn = mysql_query($queryn, $conexion) ;
                    $row = mysql_fetch_assoc($selectn);
					$totalRows = mysql_num_rows($selectn);

if (0<$totalRows){
	
	
	
                    ?>

<style>
        .dataTables_filter {
          display: none;
        }
      </style>
	  
                    <table class="table table-striped table-bordered table-hover" id="detallefun">
                    
				<thead><tr align='center' valign='middle'>
				<th>Número</th>
				
			<?php if (1==$_SESSION['snr_tipo_oficina']) { 
echo '<th>Clase </th>';
} else {} ?>
		
	<th>Tipo de tramite</th>
	 <th>Objeto de tramite</th>

				<th>Actuación</th>
				<th>Rad legal</th>
				<th>Fecha creación</th>
				
				<th>Terminos</th>
				<th>Fecha debida forma</th>

				<th>Fecha cambio estado</th>
	<?php if (1==$_SESSION['rol']) {
	 echo '<th>Valla</th>';
} else {} ?>

				<th>Estado</th>
				<th>Cédulas</th>
				<th>Matriculas</th>
				<th>Observación</th>
				<th style="width:200px;"></th>
				</tr></thead><tbody>
				
					  
                        <?php
						
						
						
                        do {
                          echo '<tr>';
						  
						  
 
if (0==$row['estado_radicacion_curaduria'] && (0<$nump107 OR 1==$_SESSION['rol'])) {
$v=' style="text-decoration: line-through;" ';
} else {
$v=' style="" ';
}
						  
$idv=intval($row['id_radicacion_curaduria']);
//echo '<td style="font-size:4px;">'.$idv.' </td>';



$nlicencia=$row['codigo_curaduria'].$row['numero_radicacion_curaduria'];
echo '<td '.$v.'>'.$nlicencia.'</td>';


if (1==$_SESSION['snr_tipo_oficina']) { 
echo '<td '.$v.'>'.$row['nombre_objeto_lic_curaduria'].' </td>';
} else {}



echo '<td '.$v.'>'.$row['tipo_licencia'].'</td>';

echo '<td>'.$row['verdadero_objeto'].'</td>';

if (1==$_SESSION['rol']) {
	/*
	 echo '<td>';
	 $vart=tipo_tramite($nlicencia);
	 $vart1=explode("|||", $vart);
	 $vart2=explode("&&&", $vart1[0]);
	 echo $vart2[0];
	 $numerorad=$vart2[1];
	 echo '</td>';
	 
	 */
	 
} else {}



echo '<td '.$v.'>'.$row['actuacion'].' </td>';
echo '<td '.$v.'>'.$row['radicacion_legal'].'</td>';

$fechar=$row['fecha_radicacion_curaduria'];

$mas30 = date('Y-m-d', strtotime('+30 day', strtotime($fechar)));


if ('No'==$row['radicacion_legal'] && 'Desistido'!=$row['estado'] && $realdate>$mas30 && 1==$row['estado_radicacion_curaduria']) {

	echo cambioestado($idv,$row['numero_radicacion_curaduria']);
	
	$fechalimite=fechahabil($fechar,30);
	
if ($realdate>$fechalimite) {
	echo actualizarestado30($idv,$id);
} else {}
	
	$varaviso=' Por vencer';
	
} else {
	$varaviso='';
	
}


echo ' <td '.$v.'>'.$row['fecha_radicacion_curaduria'].'</td>';



echo '<td '.$v.'>'.$varaviso.' </td>';
echo '<td '.$v.'>';
echo $row['fecha_cambio_legal'];
echo '</td>';
echo '<td '.$v.'>'.$row['fecha_cambio_estado'].'</td>';


if (1==$_SESSION['rol']) {
	echo '<td>';
	if (isset($row['fecha_cambio_legal'])) {
$mas5 = date('Y-m-d', strtotime('+5 day', strtotime($row['fecha_cambio_legal'])));
echo $mas5;
	} else {}
echo '</td>';
} else {}


echo '<td '.$v.'>'.$row['estado'].'';

if (1==$_SESSION['rol'] && 'Aprobado'==$row['estado']) {
echo ' <a href="licencia&'.$numerorad.'.jsp" target="_blank">Lic</a>';
} else { }

echo '</td>';


echo '<td '.$v.'>';
$bodc = str_replace(",", ", ", $row['cedulas']);
echo $bodc;
echo ' </td>';


echo '<td '.$v.'>';
$bod = str_replace(",", ", ", $row['matriculas']);
echo $bod;
echo ' </td>';


echo '<td '.$v.'>';

if (1==$_SESSION['rol'] or 0<$nump107) {

//echo cuentamodradicaciones($idv);
} ELSE {}

echo ' '.$row['nombre_radicacion_curaduria'].'</td>';

echo '<td style="width:200px;">';

$nombre_filer2 = './filesnr/radicacion_curaduria/'.$row['url'];
if (1<filesize($nombre_filer2) && isset($row['url']) && ""!=$row['url']) {
$tamr='#3F8E4D';
$pendiente='';
} else { 
$tamr='#777777';
$pendiente=' <i class="fa fa-warning" title="Pendiente de anexar el formulario" style="color:#F39C12"></i> ';
//$pendiente='';
 }
 
 
 
 

echo '<a href="" class="buscaractualizarfile" id="'.$idv.'" title="'.$idv.'" data-toggle="modal" data-target="#popupactualizarfile">'.$pendiente.'<i class="fa fa-file-pdf-o" style="color:'.$tamr.'"></i></a> ';

echo ' <a href="" class="buscaractualizarradicacioncuraduria" id="'.$idv.'" title="'.$idv.'" data-toggle="modal" data-target="#popupactualizarradicacioncuraduria"><span class="fa fa-edit" style="color:#F39C3F;"></span></a> ';
	

	
		if (1==$_SESSION['rol'] or 0<$nump107) { 
		



echo ' <a href="" class="buscarcorreccion" id="'.$idv.'" title="Corrección" data-toggle="modal" data-target="#popupactualizarcorreccion"> <i class="fa fa-folder-open-o"></i></a> ';

echo ' <a href="" class="buscarauditoriaradicacioncuraduria" id="'.$idv.'" title="Auditoria" data-toggle="modal" data-target="#popupauditoria"> <i class="fa fa-search"></i></a> ';

echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="radicacion_curaduria" id="'.$idv.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';


echo ' <a href="detalle_radicacion_curaduria&'.$idv.'.jsp" class="btn btn-xs btn-warning">Detalles</a> ';
	



	} else {}
	
echo '</td>';
                      echo '</tr>';
                        } while ($row = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);


                        ?>
						<script>
				$(document).ready(function() {
					$('#detallefun').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [500], [500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
                        
                      </tbody>
                    </table>
<?php } else { echo 'No existen registros'; } ?>
</div>
                </div>
              </div>
            </div>






            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>








<?php if (1==$_SESSION['rol'] or 0<$nump107 or 4==$_SESSION['snr_tipo_oficina']) { 

/*
$query_update22 = "SELECT max(numero_radicacion_curaduria) as maximo FROM radicacion_curaduria WHERE id_curaduria=".$id." and estado_radicacion_curaduria=1 limit 1";
$update22 = mysql_query($query_update22, $conexion) ;
$row_update22 = mysql_fetch_assoc($update22);
if (isset($row_update22['maximo']) or 0!=$row_update22['maximo']) {
	$numero2=$row_update22['maximo'];
$numero=$numero2+1;
//$identificador=$radica.$numero;


$infonum = trim(substr('0000'.$numero,-4));
$identificador=$radica.$infonum;

echo '<input type="hidden" name="numerounico" value="'.$numero.'">';
$inp= '<input type="text" class="form-control numero" name="radicacion" value="'.$identificador.'" readonly>';
} else {
$numero=1;
}
*/



?>





 <div class="modal fade" id="popupnewlicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for5445435354r65464563m1" enctype="multipart/form-data">



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">
EL NÚMERO DE RADICACIÓN APARECERA LUEGO DE DILIGENCIAR Y ENVIAR EL FORMULARIO, 
LA DIGITALIZACIÓN DEL FORMULARIO Y CARGA LA DEBE REALIZAR SELECCIONANDO LA FILA DEL REGISTRO.</span></label> 
</div>

<?php 
/*if (0<$totalRows){
	  ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN:</label> 
<?php echo $inp; ?>
</div>

<?PHP	} else { ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO INICIAL DE RADICACIÓN:</label> 
<input  class="form-control numero" name="numero_radicacion" maxlength="4" value="1"  readonly required>
</div>
<?php } */?>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de tramite:</label> 

<select class="form-control js-example-basic-multiple" style="width:440px;" required name="tipo_licencia[]" multiple>
	<?php
	
$actualizar5 = mysql_query("SELECT * FROM tipo_licencia WHERE estado_tipo_licencia=1", $conexion);
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
 do {
   echo '<option value="'.$row15['nombre_tipo_licencia'].'">';
   echo ''.$row15['nombre_tipo_licencia'].'</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}


?>

</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OBJETO DEL TRAMITE:</label> 
<select class="form-control"  required name="verdadero_objeto">
<option></option>
	<?php

		 echo '<option>Inicial</option>';
		 		 echo '<option>Modificación de licencia vigente</option>';
				 echo '<option>Revalidación</option>';
if (1==$_SESSION['rol']) {
	 echo '<option>Prorroga</option>';
	  echo '<option>Otra actuación</option>';
	
}
?>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> OTRAS ACTUACIONES:</label> 
<select  class="form-control" name="actuacion" required>
<option selected></option>
<option>NO PRESENTA</option>
<option>AJUSTE DE AREAS</option>
<option>CONCEPTO DE NORMA URBANISTICA</option>
<option>CONCEPTO DE USO DEL SUELO</option>
<option>COPIA CERTIFICADA DE PLANOS</option>
<option>APROBACION DE LOS PLANOS DE PROPIEDAD HORIZONTAL</option>
<option>AUTORIZACIÓN PARA EL MOVIMIENTO DE TIERRAS</option>
<option>APROBACIÓN DE PISCINAS</option>
<option>MODIFICACION DE PLANOS URBANISTICOS, DE LEGALIZACION Y DEMAS PLANOS QUE APROBARÓN DESARROLLOS O ASENTAMIENTOS</option>
<option>BIENES DESTINADOS A USO PUBLICO O CON VOCACIÓN DE USO PÚBLICO</option>
</select>
</div>

<?php
if (1==$_SESSION['rol']) {
// Solo para Prorrogas  los 3 vid
// para otras actuaciones  los 2 primeros
// para modificacion de licencia vigente, el numeor de expediente.
?>

<div id="" style="">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN INTERNO DE LA CURADURIA:</label> 
<INPUT class="form-control" name="numero_radicacion" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DEL NÚMERO DE RADICACIÓN INTERNO :</label> 
<INPUT class="form-control datepickera" name="fecha_radicacion" required>
</div>

<div class="form-group text-left"> 
<label class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DEL EXPEDIENTE (RADICADO) "FUN":</label>
<div class="input-group">
<span class="input-group-addon">15759-</span>

<span class="input-group-addon">
<select name="" required>
<option value="" selected></option>
<option value="">1</option>
<option value="">2</option>
<option value="">3</option>
<option value="">4</option>
<option value="">5</option>
</select>
</span>

 <span class="input-group-addon">
<select name="ano_licencia" required="">

<option value="" selected></option>
<option value="23">23</option>
<option value="22">22</option>
<option value="21">21</option>
<option value="20">20</option>
<option value="19">19</option>
<option value="18">18</option>
<option value="17">17</option>
</select>
</span>

<input type="hidden" class="form-control" name="normalizacion_curaduria" value="15759-1-">
 <span class="input-group-addon">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria" style="width:50px;" value="" maxlength="4" required="">
</span>
</div>
</div>




</div>



<?php } else {} ?>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICACIÓN LEGAL Y EN DEBIDA FORMA:</label> 
<select  class="form-control" name="radicacion_legal" required>
<option selected></option>
<option>Si</option>
<option>No</option>
</select>
</div>






<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN DEL PROYECTO:</label> 
<div class="input-group">
<span class="input-group-addon"><?php //echo $id_departamento.$id_municipio.'-'.$ncuraduria.'-'.$anoactual.'-'; ?></span>
<span class="input-group-addon">
<select name="ano_licencia" required>
<option value="<?php /*echo $anoactual; ?>" selected><?php echo $anoactual; ?></option>
<option value="<?php $anoactualmenos1=$anoactual-1; echo $anoactualmenos1; ?>"><?php echo $anoactualmenos1; ?></option>
<option value="<?php $anoactualmenos2=$anoactual-2; echo $anoactualmenos2; ?>"><?php echo $anoactualmenos2; ?></option>
<option value="<?php $anoactualmenos3=$anoactual-3; echo $anoactualmenos3; ?>"><?php echo $anoactualmenos3;*/ ?></option>
</select>
</span>
<input type="hidden" class="form-control" name="normalizacion_curaduria"  value="<?php //echo $id_departamento.$id_municipio.'-'.$ncuraduria.'-'.$anoactual.'-'; ?>">
 <span class="input-group-addon">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria" style="width:50px;" value="0337" readonly maxlength="4" required>
</span>
</div>

</div>-->



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE RADICACION:</label> 
<input type="text" class="form-control" readonly="readonly" name="fecha" value="<?php echo date('Y-m-d H:i:s'); ?>" required  >
</div>





<div class="form-group text-left"> 
<label  class="control-label">CÉDULA DEL TITULAR DE LA LICENCIA (Para varias separar con ,):</label> 
<INPUT  class="form-control matriculaspermitidas" name="cedulas">

</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MATRICULA INMOBILIARIA (Para varias separar con ,):</label> 
<input type="text" class="form-control matriculaspermitidas" name="matriculas"  required>
</div>
<!--numeroscomas
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO FOLIO(S) DE MATRICULA. (Separado por ,):</label> 
<input type="text" class="form-control mayuscula" name=""  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE EXPEDICION:</label> 
<input type="test"  class="form-control datepickercuraduria" readonly="readonly" name="fecha_expedicion" required  >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA EJECUTORIA:</label> 
<input type="text"  class="form-control datepickercuraduria" readonly="readonly" name="fecha_ejecutoria" required  >
</div>
-->


<script>
/*

function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
	
	
	var fsize = 15000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    //  alert(siezekiloByte+'<'+fsize);
	  
	  if  (siezekiloByte < fsize){
		  
    var allowedExtensions = /(.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension .pdf.');
        fileInput.value = '';
		document.getElementById('imagePreview').innerHTML = 'Error por tipo de archivo';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        } 
    }
	
} else {
	alert('Debe ser inferior a 15000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
	   document.getElementById('imagePreview').innerHTML = 'Error por tamaño';
    return false;
}

}
*/
</script>
<!--

<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">*</span>FORMULARIO UNICO NACIONAL O DOCUMENTO DE SOLICITUD:</label> 
<input type="file" name="file" id="file" required onchange="return fileValidation()">
<span style="color:#B40404;font-size:13px;">Documento en formato PDF inferior a 15 Mg</span>
<div id="imagePreview"></div>
</div>-->
<div class="form-group text-left">
<label  class="control-label"><span style="color:#ff0000;">Se debe adjuntar el documento luego de crear el radicado mediante el icono PDF</label> 
</span>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> OBSERVACIONES:</label> 
<span style="color:#ff0000;"></span>
<textarea class="form-control" name="nombre_radicacion_curaduria" ></textarea>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success confirmaenvio" >
<input type="hidden" name="table" value="instruccion_admin">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>









<?PHP 
	if (1==$_SESSION['rol']  or 0<$nump107) {  
	?>

<div class="modal fade" id="popupnewradicacion2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Nueva radicación</label></h4>
</div> 
<div class="modal-body"> 


<form action="" method="POST" name="formgjht1">



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE OBJETO DEL TRAMITE:</label> 
<select  class="form-control" name="id_objeto_lic_curaduria" id="tipoobjeto2" required>
<option value="" selected></option>
	 <option value="Inicial">Inicial</option>
		 	 <option value="Inicial con radicación automática">Inicial con radicación automática</option>
		 		 <option value="Modificación de licencia vigente">Modificación de licencia vigente</option>
				  <option value="Modificación de licencia vigente con radicación automática">Modificación de licencia vigente con radicación automática</option>
				 <option value="Revalidación">Revalidación</option>
				  <option value="Revalidación con radicación automática">Revalidación con radicación automática</option>
				  <option value="Prorroga">Prorroga</option>
				  <option value="Otras actuaciones">Otras actuaciones</option>
</select>
</div>


<div class="form-group text-left numradicado2" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN DEL PROYECTO INICIAL:</label>
<div class="input-group">
<span class="input-group-addon"><?php echo $id_departamento.$id_municipio.'-'.$ncuraduria.'-'; ?></span>
 <span class="input-group-addon">
<select name="ano_licencia" id="ano_licencia2" >
<option value="<?php echo $anoactual; ?>" selected><?php echo $anoactual; ?></option>
<option value="<?php $anoactualmenos1=$anoactual-1; echo $anoactualmenos1; ?>"><?php echo $anoactualmenos1; ?></option>
<option value="<?php $anoactualmenos2=$anoactual-2; echo $anoactualmenos2; ?>"><?php echo $anoactualmenos2; ?></option>
<option value="<?php $anoactualmenos3=$anoactual-3; echo $anoactualmenos3; ?>"><?php echo $anoactualmenos3; ?></option>
<option value="<?php $anoactualmenos4=$anoactual-4; echo $anoactualmenos4; ?>"><?php echo $anoactualmenos4; ?></option>
<option value="<?php $anoactualmenos5=$anoactual-5; echo $anoactualmenos5; ?>"><?php echo $anoactualmenos5; ?></option>
<option value="<?php $anoactualmenos6=$anoactual-6; echo $anoactualmenos6; ?>"><?php echo $anoactualmenos6; ?></option>

</select>
</span>
<input type="hidden" class="form-control" name="normalizacion_curaduria"  value="<?php echo $id_departamento.$id_municipio.'-'.$ncuraduria.'-'; ?>">
 <span class="input-group-addon">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria" style="width:50px;" value="" maxlength="4" required>
</span>
</div>
</div>


<div class="form-group text-left prorroga2" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN DE LA PRORROGA ASIGNADO POR VUR:
</label> 
<input type="text" class="form-control" name="numero_prorroga2"  id="numero_prorroga2">
</div>


<div class="form-group text-left otrasactuaciones2" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ACTUACIÓN:</label> 
<select  class="form-control" name="actuacion" id="otrasact2">
<option selected></option>
<option>NO PRESENTA</option>
<option>AJUSTE DE AREAS</option>
<option>CONCEPTO DE NORMA URBANISTICA</option>
<option>CONCEPTO DE USO DEL SUELO</option>
<option>COPIA CERTIFICADA DE PLANOS</option>
<option>APROBACION DE LOS PLANOS DE PROPIEDAD HORIZONTAL</option>
<option>AUTORIZACIÓN PARA EL MOVIMIENTO DE TIERRAS</option>
<option>APROBACIÓN DE PISCINAS</option>
<option>MODIFICACION DE PLANOS URBANISTICOS, DE LEGALIZACION Y DEMAS PLANOS QUE APROBARÓN DESARROLLOS O ASENTAMIENTOS</option>
<option>BIENES DESTINADOS A USO PUBLICO O CON VOCACIÓN DE USO PÚBLICO</option>
</select>
</div>




<div class="form-group text-left  actoadmin2" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE ACTO ADMINISTRATIVO:
</label> 
<input type="text" class="form-control mayuscula" name="n_acto_administrativo"  id="actoadministrativo2">
</div>


<!--<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICACIÓN LEGAL Y EN DEBIDA FORMA:</label> 
<select  class="form-control" name="radicacion_legal" id="radicacion_legal" required>
<option selected></option>
<option value="Si">Si</option>
<option value="No">No</option>
</select>
</div>-->


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESTADO:</label> 
<select  class="form-control" name="radicacion_estado" id="radicacion_estado" required>
<option selected></option>
<option value="Radicación incompleta">Radicación incompleta</option>
<option value="Radicación en legal y debida forma">Radicación en legal y debida forma</option>
<option value="Aprobado">Aprobado</option>
<option value="Desistido">Desistido</option>
<option value="Suspendido">Suspendido</option>
<option value="Negado">Negado</option>
<option value="Con recurso">Con recurso</option>
</select>
</div>


<div class="form-group text-left mensaje30dias" style="display:none;"> 
<label  class="control-label">TIENE 30 DIAS HABILES PARA CAMBIAR EL ESTADO A RADICACIÓN EN LEGAL Y DEBIDA FORMA O EL SISTEMA LO DESISTIRA AUTOMATICAMENTE</label> 
FECHA DE RADICACIÓN INCOMPLETA
<input type="text" class="form-control datepickercuraduria" readonly="readonly" value="<?php echo date('Y-m-d'); ?>" name="fecha_incompleta"  >


</div>




<!--
<div class="form-group text-left ccertificado_ocupacion" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> REQUIERE CERTIFICACIÓN TECNICA DE OCUPACIÓN:</label> 
<select name="certificado_ocupacion" class="form-control" id="certificado_ocupacion" required>
<option></option>
<option>SI</option>
<option>NO</option>
</select>
</div>
 
 <div class="form-group text-left cautorizacion_ocupacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> REQUIERE AUTORIZACIÓN DE OCUPACIÓN DE INMUEBLE:</label> 
<select name="autorizacion_ocupacion" class="form-control" id="autorizacion_ocupacion" required>
<option></option>
<option>SI</option>
<option>NO</option>
</select>
</div>-->




 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE TITULARES:</label> 
<input name="n_titulares" class="form-control numero" required>
</div>



 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE MATRICULAS INMOBILIARIAS ASOCIADAS AL PROYECTO:</label> 
<input name="n_matriculas" class="form-control numero" required>
</div>






<div class="form-group text-left"> 
<label  class="control-label"> OBSERVACION:</label> 
<span style="color:#ff0000;">(En caso de que el número de radicado sea de hace dos años, informar el motivo.)</span>
<textarea class="form-control mayuscula" style="min-height:200px;" name="observacion_licencia" ></textarea>
</div>


<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE RADICACION LEGAL Y EN DEBIDA FORMA:</label> 
<input type="text" class="form-control datepickercuraduria" readonly="readonly" name="fecha_radicacion"  required  >
</div>
<div class="form-group text-left cfecha_expedicion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE EXPEDICION:</label> 
<input type="test"  class="form-control datepickercuraduria" readonly="readonly" name="fecha_expedicion" id="fecha_expedicion" required  >
</div>
<div class="form-group text-left cfecha_ejecutoria"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA EJECUTORIA:</label> 
<input type="text"  class="form-control datepickercuraduria" readonly="readonly" name="fecha_ejecutoria" id="fecha_ejecutoria" required  >
</div>

<div class="form-group text-left cfecha_viabilidad"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DEL ACTA DE VIABILIDAD::</label> 
<input type="text"  class="form-control datepickercuraduria" readonly="readonly" name="fecha_viabilidad" id="fecha_viabilidad" required  >
</div>
-->


<?php if (1==$_SESSION['rol'] or 0<$nump107) {    // 0<$nump144  Cuando el curador se va y no ha subido licencias. ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CURADOR:</label> 
<select  class="form-control" name="id_curador" required>
<option value="" selected></option>
<?php 
$query = sprintf("SELECT id_funcionario, nombre_funcionario, nombre_cargo FROM funcionario, cargo where funcionario.id_cargo=cargo.id_cargo and estado_funcionario=1 and id_tipo_oficina=4 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].' - '.$row['nombre_cargo'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<?php } else {} ?>







</div>

<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<!--<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="licencia_curaduria">
<span class="glyphicon glyphicon-ok"></span> Crear</button>-->

<a href="tramite_curaduria&111939.jsp" class="btn btn-success">Siguiente</a> 



</div>
</form>







</div>
</div> 
</div> 
</div>
<?php
} else {

	}
	?>





<div class="modal fade" id="popupactualizarradicacioncuraduria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar radicación</b></h4>
</div> 
<div id="ver_actualizarradicacioncuraduria" class="modal-body"> 

</div>
</div> 
</div> 
</div>




<div class="modal fade" id="popupactualizarfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar formulario único nacional</b></h4>
</div> 
<div id="ver_actualizarfile" class="modal-body"> 

</div>
</div> 
</div> 
</div>




<div class="modal fade" id="popupactualizarcorreccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Corrección</b></h4>
</div> 
<div id="ver_actualizarcorreccion" class="modal-body"> 

</div>
</div> 
</div> 
</div>




<div class="modal fade bd-example-modal-lg" id="popupauditoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Auditoria</b></h4>
</div> 
<div id="ver_auditoriar" class="modal-body"> 

</div>
</div> 
</div> 
</div>



<?php } else { echo ''; }

  
  } else {  echo '';}
} else {  echo 'En mantenimiento durante 15 minutos.';}
?>
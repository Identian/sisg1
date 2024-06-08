<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<?php

$nump117 = privilegios(117, $_SESSION['snr']);




$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;



$query4t = sprintf("select id_parcial_edl from parcial_edl 
where id_eval_edl=".intval($_GET['i'])." and 
 id_funcionario=".$_SESSION['snr']." and estado_parcial_edl=1"); 
   $select4t = mysql_query($query4t, $conexion);
   $row4t = mysql_fetch_assoc($select4t);
   $totalff = mysql_num_rows($select4t);
mysql_free_result($select4t);

     
if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "") 
	&& isset($_GET['i']) && (0<$totalff or 1==$_SESSION['rol'] or 0<$nump117)) 
	{
	
	





if (isset($_POST['cambio_comision']) && ''!=$_POST['cambio_comision'] && (1==$_SESSION['rol'] or 0<$nump117)) {
	$edliden=intval($_GET['i']);
$updateSQL77 = sprintf("UPDATE eval_funcionario_edl SET id_funcionario_jefe_inme=%s, id_funcionario_jefe_area=%s   
   where id_eval_funcionario_edl=%s",
   GetSQLValueString($_POST['cambio_evaluador'], "int"),
   GetSQLValueString($_POST['cambio_comision'], "int"),
GetSQLValueString($edliden, "int"));
 $Result = mysql_query($updateSQL77, $conexion);
 
 //echo $updateSQL77;
echo $actualizado;	
	} else {}













	
	$id_funcionario = $_SESSION['snr'];
	$id_funcionario2 = $_SESSION['snr'];
//	echo "id funcionario: ".$id_funcionario;
	
	$query2 = sprintf("SELECT id_periodos_edl, nombre_periodos_edl,
	fechaper_desde, fechaper_hasta, sysdate() hoy 
	FROM periodos_edl 
	WHERE periodo_activo_edl = 1 
	AND estado_periodos_edl = 1"); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);

    $id_periodos_edl = $row2['id_periodos_edl'];
	$nombre_periodo_edl = $row2['nombre_periodos_edl'];
	$fechaper_desde = $row2['fechaper_desde'];
	$fechaper_hasta = $row2['fechaper_hasta'];
    $hoy = $row2['hoy'];

   
	$query5 = sprintf("SELECT * FROM perfil_activo_edl x
	              left join funcionario y
				  ON (x.id_funcionario = y.id_funcionario 
				     AND y.estado_funcionario = 1)
                  where x.id_funcionario = '$id_funcionario' 
				  and x.estado_perfil_activo_edl = 1 "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){ 
       $id_cargo = $row5['id_cargo'];
	   $nombre_funcionario_log = $row5['nombre_funcionario'];
	   $id_tipo_oficina = $row5['id_tipo_oficina'];
	   $id_grupo_area = $row5['id_grupo_area'];
	   $id_oficina_registro = $row5['id_oficina_registro'];
	   
	   $nombre_perfil_activo_edl = $row5['nombre_perfil_activo_edl'];
	   $tipo_funcionario = $row5['tipo_funcionario'];
	   
   } 

   $id_eval_funcionario_edl= 0;
   
   

   
   if (isset($_GET['i'])) {
	
   

   $id_eval_funcionario_edl=intval($_GET['i']);


// ***************
// desde aqui

// *********************************
// Registra nueva meta funcionario
// ***********************************

if (isset($_POST['insertmeta']) and $_POST['insertmeta'] == 'insertmeta') {

	$id_eval_funcionario_edl = $_POST['id_eval_funcionario_edl'];
    $id_metas_edl = $_POST['id_metas_edl'];
    $nombre_meta_funcionario_edl = 'Metas del funcionario ';
	$compromiso_laboral = $_POST['compromiso_laboral'];
	$peso_porcentual = $_POST['peso_porcentual'];

$query = sprintf("SELECT count(id_eval_funcionario_edl) as tmetas_edl 
  FROM metas_funcionario_edl
  where estado_metas_funcionario_edl=1 
  and id_eval_funcionario_edl = '$id_eval_funcionario_edl' 
  AND id_metas_edl = '$id_metas_edl'"); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
// if (0<$rowt['tmetas_edl']) {
//	echo $repetido; 
// } else {		
	$insertSQL = sprintf("INSERT INTO metas_funcionario_edl (
      id_eval_funcionario_edl, id_metas_edl, 
	  nombre_meta_funcionario_edl, 
	  compromiso_laboral, peso_porcentual) 
	  VALUES (%s, %s, %s, %s, %s)", 
      GetSQLValueString($id_eval_funcionario_edl, "int"), 
      GetSQLValueString($id_metas_edl, "int"), 
	  GetSQLValueString($nombre_meta_funcionario_edl, "text"),
	  GetSQLValueString($compromiso_laboral, "text"),
	  GetSQLValueString($peso_porcentual, "int")); 
      $Result = mysql_query($insertSQL, $conexion);

	echo $hecho;
//  }		 

//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';
 }	

// Modifica periodos de evaluacion
// ********************************

if (isset($_POST['modiperiodo']) and $_POST['modiperiodo'] == 'modiperiodo') {

	$id_eval_funcionario_edl = $_POST['id_eval_funcionario_edl9'];
//  $nombre_eval_funcionario_edl = $_POST['nombre_eval_funcionario_edl'];
// 	$id_grupo_area = $_POST['id_grupo_area'];
	$fecha_concertacion = $_POST['fecha_concertacion9'];
//	$id_periodos_edl = $_POST['id_periodos_edl'];
	$periodo_desde = $_POST['periodo_desde9'];
	$periodo_hasta = $_POST['periodo_hasta9'];
//	$proposito_empleo = $_POST['proposito_empleo'];
	$id_funcionario_jefe_inme = $_POST['id_funcionario_jefe_inme9'];
	$id_funcionario_jefe_area = $_POST['id_funcionario_jefe_area9'];


    $updateSQL37 = sprintf("UPDATE eval_funcionario_edl 
	        SET fecha_concertacion = %s,	
			periodo_desde = %s,
			periodo_hasta = %s,
			id_funcionario_jefe_inme = %s,
			id_funcionario_jefe_area = %s
			WHERE id_eval_funcionario_edl = %s",                  
	GetSQLValueString($fecha_concertacion, "date"),
	GetSQLValueString($periodo_desde, "date"),
	GetSQLValueString($periodo_hasta, "date"),
	GetSQLValueString($id_funcionario_jefe_inme, "int"),
	GetSQLValueString($id_funcionario_jefe_area, "int"),
	GetSQLValueString($id_eval_funcionario_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';

 }

// Modifica Meta
// ********************************

if (isset($_POST['modifimeta']) and $_POST['modifimeta'] == 'modifimeta') {

	$id_metas_funcionario_edl = $_POST['id_metas_funcionario_edl8'];
    $id_metas_edl = $_POST['id_metas_edl8'];
	$compromiso_laboral = $_POST['compromiso_laboral8'];
	$peso_porcentual = $_POST['peso_porcentual8'];

    $updateSQL37 = sprintf("UPDATE metas_funcionario_edl 
	        SET id_metas_edl = %s,	
			compromiso_laboral = %s,
			peso_porcentual = %s 
			WHERE id_metas_funcionario_edl = %s",                  
	GetSQLValueString($id_metas_edl, "int"),
	GetSQLValueString($compromiso_laboral, "text"),
	GetSQLValueString($peso_porcentual, "int"),
	GetSQLValueString($id_metas_funcionario_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';

 }



// *************************************************
// Registro de activacion periodo 
// *************************************************

if (isset($_POST['activarper'])){

      $id_funcionario = $_POST['id_funcionario2'];
	  $id_cargo = $_POST['id_cargo2'];
      $id_periodos_edl = $_POST['id_periodos_edl'];
	  $tipo_funcionario = $_POST['tipo_funcionario'];
	  $id_funcionario_edl = $_POST['id_funcionario_edl'];

    if ($tipo_funcionario == 0) {
	    $id_funcionario_edl = $_POST['id_funcionario2'];
    }
      $nombre_periodos_edl = ' ';
	  $fechaper_desde = ' ';
	  $fechaper_hasta = ' ';

	$query7 = sprintf("SELECT * FROM periodos_edl
                  where id_periodos_edl = '$id_periodos_edl' 
				  and estado_periodos_edl = 1 "); 
    $select7 = mysql_query($query7, $conexion) or die(mysql_error());
    $row7 = mysql_fetch_assoc($select7);
    $totalRows7 = mysql_num_rows($select7);
    if ($totalRows7 > 0){
       $nombre_periodos_edl = $row7['nombre_periodos_edl'];
	   $fechaper_desde = $row7['fechaper_desde'];
	   $fechaper_hasta = $row7['fechaper_hasta'];
   }

    $updateSQL37 = sprintf("UPDATE periodo_activo_edl 
	        SET nombre_periodo_activo_edl = %s,
			id_periodos_edl = %s,
			fechaper_desde = %s,
			fechaper_hasta = %s,
			id_funcionario_edl = %s,
            tipo_funcionario = %s			
			WHERE id_funcionario = %s",                  
	GetSQLValueString($nombre_periodos_edl, "text"),
	GetSQLValueString($id_periodos_edl, "int"),
	GetSQLValueString($fechaper_desde, "date"),
	GetSQLValueString($fechaper_hasta, "date"),
	GetSQLValueString($id_funcionario_edl, "int"),
	GetSQLValueString($tipo_funcionario, "int"),
	GetSQLValueString($id_funcionario, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

/*			
      $insertSQL = sprintf("INSERT INTO periodo_activo_edl ( 
		    id_funcionario, nombre_periodo_activo_edl, 
			id_periodos_edl, fechaper_desde, fechaper_hasta,
			id_funcionario_edl, tipo_funcionario) 
            VALUES (%s, %s, %s, %s, %s, %s, %s)", 
            GetSQLValueString($id_funcionario, "int"), 
            GetSQLValueString($nombre_periodos_edl, "text"),
			GetSQLValueString($id_periodos_edl, "int"),
            GetSQLValueString($fechaper_desde, "date"),
            GetSQLValueString($fechaper_hasta, "date"),
			GetSQLValueString($id_funcionario_edl, "int"),
			GetSQLValueString($tipo_funcionario, "int"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
*/		

	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./edl_fun.jsp" />';
 }
 

// Registra nueva competencia funcionario
// ***************************************

if (isset($_POST['inscompefun']) and $_POST['inscompefun'] == 'inscompefun') {

	$id_eval_funcionario_edl = $_POST['id_eval_funcionario_edl3'];
    $id_competencias_edl = $_POST['id_competencias_edl3'];
	$nombre_competencia_funcionario_edl = 'xxx';
//	$id_niveles_desarrollo_edl = $_POST['id_niveles_desarrollo_edl3'];
//	$descrip_cualitativa = $_POST['descrip_cualitativa3'];
//    $valor_niveldesa = 0;
/*	
	$query7 = sprintf("SELECT * FROM niveles_desarrollo_edl
                  where id_niveles_desarrollo_edl = '$id_niveles_desarrollo_edl' 
				  and estado_niveles_desarrollo_edl = 1 "); 
    $select7 = mysql_query($query7, $conexion) or die(mysql_error());
    $row7 = mysql_fetch_assoc($select7);
    $totalRows7 = mysql_num_rows($select7);
    if ($totalRows7 > 0){
       $valor_niveldesa = $row7['valor_niveldesa'];
   }
*/

$query = sprintf("SELECT count(id_eval_funcionario_edl) as tcompe_edl 
  FROM competencia_funcionario_edl
  where estado_competencia_funcionario_edl=1 
  and id_eval_funcionario_edl = '$id_eval_funcionario_edl' 
  AND id_competencias_edl = '$id_competencias_edl' "); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tcompe_edl']) {
	echo $repetido; 
} else {		

		
	$insertSQL = sprintf("INSERT INTO competencia_funcionario_edl (
      id_eval_funcionario_edl, id_competencias_edl, 
	  nombre_competencia_funcionario_edl) 
	  VALUES (%s, %s, %s)", 
      GetSQLValueString($id_eval_funcionario_edl, "int"), 
	  GetSQLValueString($id_competencias_edl, "int"),
	  GetSQLValueString($nombre_competencia_funcionario_edl, "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
  }		 

//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';
 }	

 
// Registra nueva evidencia funcionario
// ***********************************

if (isset($_POST['inserteviden']) and $_POST['inserteviden'] == 'inserteviden') {

	$id_eval_funcionario_edl = $_POST['id_eval_funcionario_edl22'];
	$id_metas_funcionario_edl = $_POST['id_metas_funcionario_edl'];
	$fecha_evidencia = $_POST['fecha_evidencia'];
    $nombre_evidencias_edl = $_POST['nombre_evidencias_edl'];
	$ubicacion_evidencia = $_POST['ubicacion_evidencia'];
	$observa_evidencia = $_POST['observa_evidencia'];
	$daportado_por = ' ';
	$aportado_por = 0;
	
//  0 = Funcionario, 1 = JEFE INMEDIATO, 2 = JEFE AREA
	if ($tipo_funcionario > 0) {
		$daportado_por = 'EVALUADOR';
		$aportado_por = 2;
	} else {
		$daportado_por = 'EVALUADO';
		$aportado_por = 1;
	}
		
	$insertSQL = sprintf("INSERT INTO evidencias_edl (
      id_eval_funcionario_edl, nombre_evidencias_edl, 
	  id_metas_funcionario_edl, ubicacion_evidencia,
	  fecha_evidencia, observa_evidencia, aportado_por) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($id_eval_funcionario_edl, "int"), 
	  GetSQLValueString($nombre_evidencias_edl, "text"),
	  GetSQLValueString($id_metas_funcionario_edl, "int"),
	  GetSQLValueString($ubicacion_evidencia, "text"),
	  GetSQLValueString($fecha_evidencia, "date"),
	  GetSQLValueString($observa_evidencia, "text"),
	  GetSQLValueString($aportado_por, "int")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
		 

//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';
 }	

// Modifica evidencia funcionario
// ***********************************

if (isset($_POST['modifievi']) and $_POST['modifievi'] == 'modifievi') {

	$id_evidencias_edl = $_POST['id_evidencias_edl78'];
	$id_metas_funcionario_edl = $_POST['id_metas_funcionario_edl78'];
	$fecha_evidencia = $_POST['fecha_evidencia78'];
    $nombre_evidencias_edl = $_POST['nombre_evidencias_edl78'];
	$ubicacion_evidencia = $_POST['ubicacion_evidencia78'];
	$observa_evidencia = $_POST['observa_evidencia78'];
	$daportado_por = ' ';
	$aportado_por = 0;
	
//  0 = Funcionario, 1 = JEFE INMEDIATO, 2 = JEFE AREA
	if ($tipo_funcionario > 0) {
		$daportado_por = 'EVALUADOR';
		$aportado_por = 2;
	} else {
		$daportado_por = 'EVALUADO';
		$aportado_por = 1;
	}
		

    $updateSQL37 = sprintf("UPDATE evidencias_edl 
	        SET id_metas_funcionario_edl = %s, 
			fecha_evidencia = %s,
			nombre_evidencias_edl = %s,
			ubicacion_evidencia = %s,
			observa_evidencia = %s 
			WHERE id_evidencias_edl = %s",                  
	GetSQLValueString($id_metas_funcionario_edl, "int"),
	GetSQLValueString($fecha_evidencia, "date"),
	GetSQLValueString($nombre_evidencias_edl, "text"),
	GetSQLValueString($ubicacion_evidencia, "text"),
	GetSQLValueString($observa_evidencia, "text"),
	GetSQLValueString($id_evidencias_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

	echo $hecho;

//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';
 }	

// Guarda calificacion Meta
// ********************************

if (isset($_POST['gcalimeta']) and $_POST['gcalimeta'] == 'gcalimeta') {

/*
    // total resultado metas funcionario
	$query2 = sprintf("SELECT round((sum((peso_porcentual * eval_porcentual) / 100)),2) t_resul_meta  
	                   FROM metas_funcionario_edl
					   WHERE id_eval_funcionario_edl = '$id_eval_funcionario_edl' "); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);
    $t_resul_meta = $row2['t_resul_meta'];

	$query4 = sprintf("SELECT round((sum((peso_porcentual * eval_porcentual) / 100)),2) t_resul_meta  
	                   FROM metas_funcionario_edl
					   WHERE id_eval_funcionario_edl = '$id_eval_funcionario_edl'  "); 
    $select4 = mysql_query($query4, $conexion) or die(mysql_error());
    $row4 = mysql_fetch_assoc($select4);
    $t_resul_meta = $row4['t_resul_meta'];

mysql_free_result($select4);
*/

    $updateSQL37 = sprintf("UPDATE eval_funcionario_edl 
	        SET fecha_eva_jinme = now(),	
			estado_eva_jime = 1
			WHERE id_eval_funcionario_edl = %s",                  
	GetSQLValueString($id_eval_funcionario_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 

	$id_metas_funcionario_edl = $_POST['id_metas_funcionario_edl85'];
	$eval_porcentual = $_POST['eval_porcentual85'];

    $updateSQL37 = sprintf("UPDATE metas_funcionario_edl 
	        SET eval_porcentual = %s	
			WHERE id_metas_funcionario_edl = %s",                  
	GetSQLValueString($eval_porcentual, "int"),
	GetSQLValueString($id_metas_funcionario_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';

 }

// Actualiza calificacion competencia funcionario
// ***********************************************

if (isset($_POST['calicompefun']) and $_POST['calicompefun'] == 'calicompefun') {

	$id_competencia_funcionario_edl = $_POST['id_competencia_funcionario_edl65'];
	$id_niveles_desarrollo_edl = $_POST['id_niveles_desarrollo_edl65'];
	$descrip_cualitativa = $_POST['descrip_cualitativa65'];

    if (strlen($descrip_cualitativa) < 3) {
	   $descrip_cualitativa = ' ';
	}
	$valor_niveldesa = $_POST['valor_niveldesa65'];;

	$query7 = sprintf("SELECT * FROM niveles_desarrollo_edl
                  where $valor_niveldesa between valor_niveldesde and valor_nivelhasta 
				  and estado_niveles_desarrollo_edl = 1 "); 
    $select7 = mysql_query($query7, $conexion) or die(mysql_error());
    $row7 = mysql_fetch_assoc($select7);
    $totalRows7 = mysql_num_rows($select7);
    if ($totalRows7 > 0){
       $id_niveles_desarrollo_edl = $row7['id_niveles_desarrollo_edl'];
   }

/*
    $updateSQL37 = sprintf("UPDATE eval_funcionario_edl 
	        SET fecha_eva_jarea = now(),	
			estado_eva_jarea = 1
			WHERE id_eval_funcionario_edl = %s",                  
	GetSQLValueString($id_eval_funcionario_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
*/
		 
    $updateSQL37 = sprintf("UPDATE eval_funcionario_edl 
	        SET fecha_eva_jinme = now(),	
			estado_eva_jime = 1
			WHERE id_eval_funcionario_edl = %s",                  
	GetSQLValueString($id_eval_funcionario_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
	
    $updateSQL37 = sprintf("UPDATE competencia_funcionario_edl 
	        SET id_niveles_desarrollo_edl = %s,
			valor_niveldesa = %s,
			descrip_cualitativa = %s
			WHERE id_competencia_funcionario_edl = %s",                  
	GetSQLValueString($id_niveles_desarrollo_edl, "int"),
	GetSQLValueString($valor_niveldesa, "int"),
	GetSQLValueString($descrip_cualitativa, "text"),
	GetSQLValueString($id_competencia_funcionario_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

	echo $hecho;

//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';
 }	

// Actualiza calificacion Jefe Area
// ***********************************

if (isset($_POST['actcalijefea']) and $_POST['actcalijefea'] == 'actcalijefea') {

	$id_eval_funcionario_edl = $_POST['id_eval_funcionario_edl6'];
	$id_funcionario = $_POST['id_funcionario6'];
	$califi_jarea = $_POST['califi_jarea6'];
    $estado_eva_jarea = 1; // con EDL
    $updateSQL37 = sprintf("UPDATE eval_funcionario_edl 
	        SET estado_eva_jarea = %s,
			califi_jarea = %s,
			fecha_eva_jarea = now()
			WHERE id_eval_funcionario_edl = %s",                  
	GetSQLValueString($estado_eva_jarea, "int"),
	GetSQLValueString($califi_jarea, "int"),
	GetSQLValueString($id_eval_funcionario_edl, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

	echo $hecho;

//	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';
 }	

// ********************************
// cargue docto PDF de EDL firmado
// ********************************

if ((isset($_POST["insertdocto"])) && ($_POST["insertdocto"] == "carguedocto")) { // 1

  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');

   if (""!=$_FILES['file']['tmp_name']){ // 2
 
      $tipoArchivo=explode("/",$_FILES["file"]["type"]);
      $ubicacion="filesnr/edlsnr/";
	  $NomImagen=$_FILES['file']['name'];
	  $totarchivo=explode(".",$_FILES["file"]["name"]);
	  // echo $totarchivo[0];
	 $nombre_img=$id_funcionario2.'-'.$id_periodos_edl.'-'.$aleatorio.'.pdf';
	 
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
      $NomImagenR=$ubicacion."/".$nombre_img;
	 
     

      if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 11534336)) { // 3
	    if ($_FILES["file"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file']['tmp_name'],$NomImagenR);
			
//          $nombrebre_orig= ucwords($nombrefile);
//          $hash=md5($files);
 
            $insertSQL = sprintf("UPDATE eval_funcionario_edl 
			set docto_firmado_edl = '$nombre_img' WHERE id_eval_funcionario_edl = '$id_eval_funcionario_edl' ");
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
		  
//            echo $insertado;
 //           echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';
        } else {} // fin 4 
      } else { $valido=0; echo $doc_tam;
//	         echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';
             echo ' ';
		} // fin 3
		
		
  } else { 
//      echo $doc_tam;
//	  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_edl&'.$id_eval_funcionario_edl.'.jsp" />';
      echo ' ';
  } // fin 2

} 
 

// hasta aqui



    $query4 = sprintf("SELECT a.id_eval_funcionario_edl, a.aproba_edl_fun, a.id_funcionario,
                      e.nombre_funcionario	funcionario_eva, 
	                  a.id_funcionario_jefe_inme, a.califi_jarea, 
					  case when a.califi_jarea > 0 
                      then 'Rechazada'
                      else 'Aceptada'
                      end AS `destado_calijarea`, 
					  a.fecha_eva_jarea, 
	                  a.id_funcionario_jefe_area,
		              b.nombre_funcionario jefe_inme, d.nombre_funcionario jefe_area, 
					  a.fecha_concertacion, a.id_proposito_edl,
                      a.periodo_desde, a.periodo_hasta, 
					  c.fechaper_desde, c.fechaper_hasta,
					  a.estado_eva_jime, a.estado_eva_jarea,
					  case when a.estado_eva_jime > 0 
                      then 'CON Evaluación - EDL'
                      else 'SIN Evaluación - EDL'
                      end AS `destado_eva_jime`, 
					  case when a.estado_eva_jarea > 0 
                      then 'CON Evaluación - EDL'
                      else 'SIN Evaluación - EDL'
                      end AS `destado_eva_jarea`, f.nombre_proposito_edl  
                      FROM eval_funcionario_edl a 
			          LEFT JOIN funcionario b
					  ON a.id_funcionario_jefe_inme = b.id_funcionario
			          LEFT JOIN funcionario d
					  ON a.id_funcionario_jefe_area = d.id_funcionario
					  LEFT JOIN periodos_edl c
					  ON a.id_periodos_edl = c.id_periodos_edl 
			          LEFT JOIN funcionario e
					  ON a.id_funcionario = e.id_funcionario
			          LEFT JOIN proposito_edl f
					  ON a.id_proposito_edl = f.id_proposito_edl 
                      WHERE a.id_eval_funcionario_edl = '$id_eval_funcionario_edl' 
					  AND a.estado_eval_funcionario_edl = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
$id_eval_funcionario_edl = $row4['id_eval_funcionario_edl'];
	$id_funcionario = $row4['id_funcionario'];
	$funcionario_eva = $row4['funcionario_eva'];
    $jefe_inme = $row4['jefe_inme'];
	$jefe_area = $row4['jefe_area'];
	$fecha_eva_jarea = $row4['fecha_eva_jarea'];
	$califi_jarea = $row4['califi_jarea'];
	$destado_calijarea = $row4['destado_calijarea'];
	$fecha_concertacion = $row4['fecha_concertacion'];
	$proposito_empleo = $row4['nombre_proposito_edl'];
	$periodo_desde = $row4['periodo_desde'];
	$periodo_hasta = $row4['periodo_hasta'];
	$estado_eva_jime = $row4['estado_eva_jime'];
	$estado_eva_jarea = $row4['estado_eva_jarea'];
	$destado_eva_jime = $row4['destado_eva_jime'];
	$destado_eva_jarea = $row4['destado_eva_jarea'];
    $id_funcionario_jefe_inme = $row4['id_funcionario_jefe_inme'];
	$id_funcionario_jefe_area = $row4['id_funcionario_jefe_area'];
	$aprobado = $row4['aproba_edl_fun'];
 }

if ($estado_eva_jarea > 0) { 
  $destado_eva_jarea = $destado_eva_jarea.'<b> - Estado: </b>'.$destado_calijarea;
}
mysql_free_result($select4);

	$query2 = sprintf("SELECT count(*) num_metas, sum(peso_porcentual) tot_peso
    FROM metas_funcionario_edl 
	WHERE id_eval_funcionario_edl = '$id_eval_funcionario_edl' 
	and estado_metas_funcionario_edl=1"); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);
    $tot_peso = intval($row2['tot_peso']);
	$num_metas = intval($row2['num_metas']);
$falta_peso=100-$tot_peso;

mysql_free_result($select2);

    $t_resul_meta = 0;
	
	$query4 = sprintf("SELECT round((sum((peso_porcentual * eval_porcentual) / 100)),2) t_resul_meta  
	                   FROM metas_funcionario_edl
					   WHERE id_eval_funcionario_edl = '$id_eval_funcionario_edl' 
                       AND 	estado_metas_funcionario_edl = 1 					   "); 
    $select4 = mysql_query($query4, $conexion) or die(mysql_error());
    $row4 = mysql_fetch_assoc($select4);
    $t_resul_meta = $row4['t_resul_meta'];

mysql_free_result($select4);

    $tot_nivelde = 0;
	
	$query2 = sprintf("SELECT ifnull(sum(valor_niveldesa),0) tot_nivelde  
	                   FROM competencia_funcionario_edl
					   WHERE id_eval_funcionario_edl = '$id_eval_funcionario_edl'  
					   AND 	estado_competencia_funcionario_edl = 1 "); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);
    $tot_nivelde = $row2['tot_nivelde'];

mysql_free_result($select2);

    $num_compe = 0;
	
	$query4 = sprintf("SELECT count(*) as num_compe  
	                   FROM competencia_funcionario_edl
					   WHERE id_eval_funcionario_edl = '$id_eval_funcionario_edl' 
                       AND 	estado_competencia_funcionario_edl = 1 "); 
    $select4 = mysql_query($query4, $conexion) or die(mysql_error());
    $row4 = mysql_fetch_assoc($select4);
    $num_compe = $row4['num_compe'];

	$prom_compe = 0;
	
	if ($tot_nivelde > 0) {
	$prom_compe = round(($tot_nivelde / $num_compe),2);
    }
mysql_free_result($select4);

$cal80 = round($t_resul_meta *(80 / 100),2);
$cal20 = round($prom_compe *(20 / 10),2);
$total_cal = $cal80 + $cal20;

     
   } else {
      echo 'No tiene acceso.';
   }
   

	  



// include('tablero_edl.php');
 
?> 
 
	  
	  
<div class="row">
    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <div class="row-md-3 text-left">
                 <h3 class="box-title"><b>EVALUACIONES PARCIALES</b></h3> &nbsp; &nbsp; 
				 <?php if($estado_eva_jime < 1 and $tipo_funcionario == 1 ) { // No ha empezado la EDL ?>
    		    <!-- <a id="" class="ventana1" data-toggle="modal" data-target="#periodos_edl" href="" title="Modificar Período Funcionario"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                 <?php } ?>
				 <?php if($tipo_funcionario == 2 and $estado_eva_jime > 0) { // Jefe de Area ?>
    		     <a id="" class="ventana1" data-toggle="modal" data-target="#eval_jefearea" href="" title="Evaluación Comisión Evaluadora"> <button type="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-star"></span> Evaluación Comisión Evaluadora </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <?php } ?>
<!--	         <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#activ_periodo"><span class="glyphicon glyphicon-list-alt"></span> ACTIVAR PERÍODO</button>&nbsp; -->
                 <?php if($tipo_funcionario == 0) { // Perfil funcionario ?>
             <!-- <a href="reclamacion_edl&<?php echo $id_eval_funcionario_edl; ?>.jsp"><span class="btn btn-info btn-xs" title="Reclamacion Evaluado"><span class="glyphicon glyphicon-star"></span>Reclamación</a> &nbsp;-->
                 <?php } ?>
				 <?php if($tipo_funcionario <= 10 and $estado_eva_jarea >= 0) { // <= 1 y > 0 Genera archivo PDF ?>
<!--                 <a href="pdf_edl&<?php echo $id_eval_funcionario_edl; ?>.jsp"><span class="btn btn-success btn-xs" title="Generación PDF">PDF para Firma <img src="images/pdf.png"></a> &nbsp; -->
			<!--   <a href="pdf/edl_funcionario_firma&<?php //echo $id_eval_funcionario_edl; ?>.pdf"><span class="btn btn-success btn-xs" title="PDF de Evaluación para firma">PDF para Firma <img src="images/pdf.png"></a>-->

                 <?php } ?>
				 <?php if($tipo_funcionario <= 10 and $estado_eva_jarea >= 0) { // <= 1 y > 0 Cargue Docto Firmado ?>
    		<!--    <a id="" class="ventana1" data-toggle="modal" data-target="#carguedocedl" href="" title="Cargue Docto Firmado"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-star"></span> Cargue Docto Firmado </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                 <?php } ?>
			 </div>
			 
		  <div class="row-md-6 text-right">
	      </div>
	    <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Evaluado:</label>   
                       <?php echo $funcionario_eva; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Fecha de Concertación:</label>   
                       <?php echo $fecha_concertacion; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Período Desde:</label>   
                       <?php echo $periodo_desde; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Período Hasta:</label>   
                       <?php echo $periodo_hasta; ?>
                    </div>
					 <div class="form-group text-left"> 
                       <label  class="control-label">Aceptado:</label>   
                       <?php if(1==$aprobado) { echo 'Si'; } else { echo 'No'; } ?>
                    </div>
                    </div>

                <div class="col-md-3">

                   
                   
              				
					
					
<a href="" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#popupparcial">
<span class="glyphicon glyphicon-plus-sign"></span> Evaluaciones Parciales</a> 
	
	<?php
	
	
	if (isset($_POST['tipo_evaluacion'])) {

$insertSQL = sprintf("INSERT INTO parcial_edl (
id_eval_edl, tipo_evaluacion, motivo, fecha_inicial, fecha_final, 
fecha_real, tipo_evaluador, id_funcionario, estado_parcial_edl) 
VALUES (%s, %s, %s, %s, %s, now(), %s, %s, %s)", 
GetSQLValueString($id_eval_funcionario_edl, "int"),
GetSQLValueString($_POST["tipo_evaluacion"], "text"), 
GetSQLValueString($_POST["motivo"], "text"),
GetSQLValueString($_POST["fecha_inicial"], "date"),
GetSQLValueString($_POST["fecha_final"], "date"),
GetSQLValueString($_POST["tipo_evaluador"], "text"),
GetSQLValueString($_POST["id_funcionario"], "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

	}

	
	
$query3 = sprintf("select * from parcial_edl, funcionario where parcial_edl.id_funcionario=funcionario.id_funcionario 
and id_eval_edl=".$id_eval_funcionario_edl." and estado_parcial_edl=1"); 
$select3 = mysql_query($query3, $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
	
do {
echo '<hr>'.$row3['tipo_evaluacion'].' - ';
echo $row3['motivo'].' / Desde ';
echo $row3['fecha_inicial'].' - ';
echo $row3['fecha_final'].': ';

echo calculadias($row3['fecha_inicial'],$row3['fecha_final']);
echo ' dias. / '.$row3['tipo_evaluador'].': '.$row3['nombre_funcionario'].' ';

 if (1 == $_SESSION['rol'] ) {
 echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar dato de '.$row3['fecha_real'].'" name="parcial_edl" id="'.$row3['id_parcial_edl'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
 } else { }
					
					
echo '<br>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
} else {}	 
mysql_free_result($select3);
?>
	
	
					
				</div>  
				
				
				<div class="col-md-3">
				 <?php 
				 
				 
if (isset($_POST['evaparcial']))  {
	

$fecha_inicio = strtotime($_POST['fecha_inicial']);
$fecha_fin = strtotime($_POST['fecha_final']);


$fecha_limitea = strtotime("2022-08-01");
$fecha_limiteb = strtotime("2023-01-31");

//$fecha_inicio < $fecha_fin or 

if (isset($_POST['evaparcial']))  {
	
	
/*	
if (""!=$_POST['fecha_inicial'] && ""!=$_POST['fecha_final'] && $fecha_limitea<=$fecha_inicio && $fecha_fin<=$fecha_limiteb) {
  
} else {
	 exit('Las fechas no estan en el rango que deberian. Del 1 de agosto al 31 de enero.');
}*/
  $date1 = new DateTime($_POST['fecha_inicial']);
$date2 = new DateTime($_POST['fecha_final']);
$diff = $date1->diff($date2);
$diasc= $diff->days;
//$diasc>=30 or 
if (isset($_POST['evaparcial'])) 
 {
	
	$insertSQL = sprintf("INSERT INTO eval_edl (
      id_eval_funcionario_edl, periodo_evaluacion, tipo_evaluacion, nombre_eval_edl, fecha_inicial,  fecha_final, id_funcionario, estado_eval_edl) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($id_eval_funcionario_edl, "int"), 
	    GetSQLValueString($_POST['periodo_evaluacion'], "text"),
	   GetSQLValueString($_POST['tipo_evaluacion'], "text"),
	  GetSQLValueString($_POST['motivo'], "text"),
	    GetSQLValueString($_POST['fecha_inicial'], "date"),
		  GetSQLValueString($_POST['fecha_final'], "date"),
		    GetSQLValueString($_SESSION['snr'], "int"),
	   GetSQLValueString(1, "int")
	  ); 
      $Result = mysql_query($insertSQL, $conexion);



$camposc=$_POST;
foreach ($_POST as $key => $value) {
	
$campo=explode('-',$key);

$compromiso=$campo[1];

	if ('id_metas_funcionario_edl'==$campo[0]){
		
		
		$tipo=1;
	
		$valor=$value;
		
		
		$insertSQLc = sprintf("INSERT INTO nota_eval_edl (
      id_eval_edl, tipo_c, id_metas_funcionario_edl, nombre_nota_eval_edl, fecha_nota_eval_edl, 
	   id_funcionario, estado_nota_eval_edl) 
	  VALUES (%s, %s, %s, %s, now(), %s, %s)", 
      GetSQLValueString($id_eval_funcionario_edl, "int"), 
	   GetSQLValueString($tipo, "int"),
	     GetSQLValueString($compromiso, "text"),
	GetSQLValueString($valor, "text"),

GetSQLValueString($_SESSION['snr'], "int"),
	   GetSQLValueString(1, "int")
	  ); 
      $Result = mysql_query($insertSQLc, $conexion);


		
	
	} else if ('nota_competencia_funcionario_edl'==$campo[0]) {
		
		
		$tipo=2;
	
		$valor=$value;
		$insertSQLc = sprintf("INSERT INTO nota_eval_edl (
      id_eval_edl, tipo_c, id_competencia_funcionario_edl, nota_competencia, fecha_nota_eval_edl, 
	   id_funcionario, estado_nota_eval_edl) 
	  VALUES (%s, %s, %s, %s, now(), %s, %s)", 
      GetSQLValueString($id_eval_funcionario_edl, "int"), 
	   GetSQLValueString($tipo, "int"),
	     GetSQLValueString($compromiso, "text"),
	GetSQLValueString($valor, "text"),

GetSQLValueString($_SESSION['snr'], "int"),
	   GetSQLValueString(1, "int")
	  ); 
      $Result = mysql_query($insertSQLc, $conexion);

		
		
		
		
		
		
		
	} else if ('aprobarcompromiso'==$campo[0]) {
		
	
	
		
		

		
		$updateSQL77 = sprintf("UPDATE nota_eval_edl SET estado_nota=%s  
   where id_nota_eval_edl=%s",
   GetSQLValueString($value, "int"),
GetSQLValueString($compromiso, "int"));
 $Result = mysql_query($updateSQL77, $conexion);

	//echo $updateSQL77;
		
		
	} else {}
	



}



echo $insertado;

} else {
echo '<b style="background:#ff0000;color:#fff;">Recuerde que las evaluación solo se dan mayores a 30 días.</b>'; 
}
} else { 
echo '<b style="background:#ff0000;color:#fff;">La fechas presentan inconsistencias.</b>';
}
} else { }
 
				 
		
		
		
		
		
		
			
function grupoparcial ($id,$user) {
global $mysqli;
$query4 = sprintf("SELECT count(id_parcial_edl) as contad FROM parcial_edl where id_eval_edl=".$id." and 
id_funcionario=".$user.""); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contad'];
return $res;
$result4->free();
		}

$valore=grupoparcial($id_eval_funcionario_edl,$_SESSION['snr']);
			
			
 if (3>$_SESSION['snr_tipo_oficina'] && 
 (
 //$_SESSION['snr']==$id_funcionario_jefe_inme or $_SESSION['snr']==$id_funcionario_jefe_area or 
 0<$valore)) { 
					 ?>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Calificación:</label>   
					   
					   <?php 
					   /*	$query = sprintf("SELECT count(id_eval_edl) as cuentaedl FROM eval_edl where 
						 completo=1 and 
						
						id_eval_funcionario_edl=".$id_eval_funcionario_edl." and estado_eval_edl=1 order by id_eval_edl"); 
$selectrr = mysql_query($query, $conexion);
$rowrr = mysql_fetch_assoc($selectrr);
	if (0<$rowrr['cuentaedl']) {		*/		   
					   ?>
<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#popupanexoevaluacion"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a> 
	<?php// } else { }?>
			<br><br>
			<?php
$query = sprintf("SELECT * FROM eval_edl, funcionario where eval_edl.id_funcionario=funcionario.id_funcionario and id_eval_funcionario_edl=".$id_eval_funcionario_edl." and estado_eval_edl=1 order by id_eval_edl"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo '<ol>';
do {
	echo '<li title="'.$row['id_eval_edl'].'">'.$row['nombre_funcionario'].': '.$row['tipo_evaluacion'].'';
	
if (isset($row['nombre_eval_edl'])){
echo ' / '.$row['nombre_eval_edl'].' / '.$row['fecha_inicial'].' / '.$row['fecha_final'].'';
$fechascreadas=1;
$fechaini= date("Y-m-d",strtotime($row['fecha_final']."+ 1 days")); 
} else {$fechascreadas=0; }
echo '</li>';
	 } while ($row = mysql_fetch_assoc($select)); 
	 echo '</ol>';
} else {}	 
mysql_free_result($select);
			?>


                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label"></label>   
                    
                    </div>
				 <?php } else {} ?>
				</div>
				
				
				   <div class="col-md-3">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Evidencias:</label>   
                       
					   <form action="" method="POST" name="form5435asdf3245fhgdh345122" enctype="multipart/form-data">

<div class="form-group text-left"> 
<select class="form-control" name="evi" required>
<option></option>
<?php
 $query62 = sprintf("SELECT a.id_metas_funcionario_edl, 
			    a.id_eval_funcionario_edl, b.nombre_metas_edl, a.id_metas_edl,  a.evaluacionf, 
				a.compromiso_laboral, a.peso_porcentual, IFNULL(a.eval_porcentual,0) eval_porcentual  
	            FROM metas_funcionario_edl a  
				LEFT JOIN metas_edl b 
				ON a.id_metas_edl = b.id_metas_edl 
                WHERE a.id_eval_funcionario_edl = '$id_eval_funcionario_edl'  
				AND a.estado_metas_funcionario_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion);
			  while ($row62 = mysql_fetch_assoc($select62)) {	
echo '<option>'. $row62['compromiso_laboral'].'</option>';
 } ?> 
	   </select>
</div>



<div class="form-group text-left"> 
<input type="file" name="file" class="form-control"  required>

</div>

<div class="form-group text-left"> 
<button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adjuntar documento </button>
</div>
</form>
<?php

if ((isset($_POST["evi"])) && (""!=$_POST["evi"])) { 


$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'xls', 'xlsx');


$directoryftp="filesnr/evidenciaedl/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'edl-'.$_SESSION['snr'].'-'.$identi;

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
  
 


$insertSQL = sprintf("INSERT INTO evidencias_edl (id_funcionario, fecha_evidencia, nombre_evidencias_edl, id_eval_funcionario_edl, 
url, estado_evidencias_edl) VALUES (%s, now(), %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST['evi'], "text"), 
GetSQLValueString($_GET['i'], "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

//echo $insertSQL;
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
	
	


	
	  } else {}
	  


$queryb = sprintf("SELECT * FROM evidencias_edl where id_eval_funcionario_edl=".$id_eval_funcionario_edl." and estado_evidencias_edl=1 order by id_evidencias_edl"); 
$selectb = mysql_query($queryb, $conexion);
$rowb = mysql_fetch_assoc($selectb);
$totalRowsb = mysql_num_rows($selectb);
if (0<$totalRowsb){
	echo '<ol>';
do {
	$idedla=$rowb['id_evidencias_edl'];
	echo '<li title="'.$rowb['id_funcionario'].' / '.$rowb['fecha_evidencia'].'"><a href="filesnr/evidenciaedl/'.$rowb['url'].'" target="_blank">'.$rowb['nombre_evidencias_edl'].'</a>';
	if (1==$_SESSION['rol'] or 0<$nump117) {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="evidencias_edl" id="'.$idedla.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
echo '</li>';
	 } while ($rowb = mysql_fetch_assoc($selectb)); 
	 echo '</ol>';
} else {}	 
mysql_free_result($selectb);
			?>
				    </div>  
				</div>  
				
				
				
				
				         		  
				
				
				
				
             </div>
        </div>
  </div>
  </div>
</div> 



<?php
// Modificacion de periodos de evaluacion
// *************************************
?>

<div class="modal fade"  id="periodos_edl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN PERIODO DEL EVALUADO - EDL</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4377224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_eval_funcionario_edl9" id="id_eval_funcionario_edl9" readonly="readonly" value="<?php echo $id_eval_funcionario_edl; ?>">

	
    <div class="form-group text-left"> 
      <label  class="control-label">Evaluado:</label>   
      <input type="text" class="form-control" name="id_funcionario9" id="id_funcionario9" readonly="readonly" value="<?php echo $nombre_funcionario_log; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Concertación:</label>   
      <input type="date" class="form-control" name="fecha_concertacion9" id="fecha_concertacion9" value="<?php echo $fecha_concertacion; ?>">
    </div>

     <div class="form-group text-left"> 
      <label  class="control-label">Período Desde:</label>   
      <input type="date" class="form-control" name="periodo_desde9" id="periodo_desde9" value="<?php echo $periodo_desde; ?>">
    </div>

     <div class="form-group text-left"> 
      <label  class="control-label">Período Hasta:</label>   
      <input type="date" class="form-control" name="periodo_hasta9" id="periodo_hasta9" value="<?php echo $periodo_hasta; ?>">
    </div>

   <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Evaluador:</label> 
        <select class="form-control" name="id_funcionario_jefe_inme9" id="id_funcionario_jefe_inme9" onChange = "valjefeinme();" required >
        <option value="<?php echo $id_funcionario_jefe_inme ?>" selected><?php echo $jefe_inme; ?></option>
          <?php echo lista('funcionario'); ?>
        </select>
    </div>

   <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Comisión Evaluadora:</label> 
        <select class="form-control" name="id_funcionario_jefe_area9" id="id_funcionario_jefe_area9" onChange = "valjefearea();" required >
        <option value="<?php echo $id_funcionario_jefe_area ?>" selected><?php echo $jefe_area; ?></option>
          <?php echo lista('funcionario'); ?>
        </select>
    </div>
    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="modiperiodo" id="modiperiodo" value="modiperiodo">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<?php
// Activacion de periodos 
// *****************************************
?>

<div class="modal fade"  id="activ_periodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>ACTIVACIÓN DE PERÍODOS - EDL</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_funcionario2" id="id_funcionario2" readonly="readonly" value="<?php echo $id_funcionario2; ?>">
    <input type="hidden" class="form-control" name="id_cargo2" id="id_cargo2" readonly="readonly" value="<?php echo $id_cargo; ?>">

	<div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Período a Activar:</label> 
        <select class="form-control" name="id_periodos_edl" id="id_periodos_edl" required >
        <option value="" selected></option>
        <?php echo periodosedl('periodos_edl'); ?>
        </select>
    </div>

	<div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Funcionario:</label> 
        <select class="form-control" name="tipo_funcionario" id="tipo_funcionario" onChange = "valtipofun();" required >
        <option value="0" selected>Evaluado</option>
        <option value="1" >Evaluador</option>
        <option value="2" >Comisión Evaluadora</option>
        </select>
    </div>


    <div id = "funconsul" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Evaluado a Consultar:</label> 
        <select class="form-control" name="id_funcionario_edl" id="id_funcionario_edl"  >
        <option value="" selected></option>
        <?php echo lista('funcionario'); ?>
        </select>
    </div>

    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="activarper" value="activarper">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<!-- Modal: crear periodo Funcionario -->
<div class="modal fade" id="creaperfun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>NUEVO PERIODO A EVALUAR</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">

				   <input type="hidden" name="id_funcionario" id="id_funcionario"   value="<?php echo $id_funcionario; ?>" >
                   <input type="hidden" name="nombre_eval_funcionario_edl" id="nombre_eval_funcionario_edl" readonly="readonly" value="<?php echo $nombre_funcionario_log; ?>"> 
                   <input type="hidden" name="id_grupo_area" id="id_grupo_area" readonly="readonly" value="<?php echo $id_grupo_area; ?>"> 

                   <div class="form-group text-left"> 
                        <label><i class="fa fa-calendar"><span style="color:#ff0000;">*</span></i> Fecha Concertación:</label>   
                        <input type="date" class="form-control" id="fecha_concertacion"name="fecha_concertacion" value="" required >
                   </div>

	               <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span> Período a Activar:</label> 
                        <select class="form-control" name="id_periodos_edl" id="id_periodos_edl" required >
                        <option value="" selected></option>
                          <?php echo periodosedl('periodos_edl'); ?>
                         </select>
                   </div>
				   
                   <div class="form-group text-left"> 
                        <label  class="control-label">FECHA INICIO:</label>   
                        <input type="date" class="form-control" name="periodo_desde" id="periodo_desde" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label">FECHA FINAL:</label>   
                        <input type="date" class="form-control" name="periodo_hasta" id="periodo_hasta" value="" required >
                   </div>

                  <div class="form-group text-left"> 
                       <label  class="control-label"><span style="color:#ff0000;">*</span> Propósito del empleo:</label>   
                       <textarea rows="5" cols="40" class="form-control" id="proposito_empleo"  name="proposito_empleo" value="" required ></textarea>
                  </div>
    
                  <div class="form-group text-left"> 
                       <label  class="control-label">EVALUADOR:</label>   
                       <select class="form-control" name="id_funcionario_jefe_inme" id="id_funcionario_jefe_inme" onChange = "valjefeinme();" required >
                       <option value="" selected></option>
                         <?php echo lista('funcionario'); ?>
                       </select>
                  </div>

                  <div class="form-group text-left"> 
                       <label  class="control-label">COMISIÓN EVALUADORA:</label>   
                       <select class="form-control" name="id_funcionario_jefe_area" id="id_funcionario_jefe_area" onChange = "valjefearea();" required >
                       <option value="" selected></option>
                         <?php echo lista('funcionario'); ?>
                       </select>
                  </div>
    
                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="archperfun" value="archperfun">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
				</form>
              </div>
          </div> 
     </div> 
</div> 

 <?php
 // ************************************
 // Detalle de Metas Funcionario
 // ************************************
 ?>
 
 		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'COMPROMISO LABORAL (<B style="color:#B40404;">Mínimo 3 - Máximo 5</B>) - '.'<b>'.' TOTAL PESO PORCENTUAL: '.$tot_peso.'% - '. '</b>'.'<b>'.' NÚMERO DE COMPROMISOS LABORALES: '.$num_metas.' '. '</b>'.'<b>'.' ---> CALIFICACIÓN: '.$t_resul_meta.'</b>'; ?>
					   </h4> 
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
<?php if ($tot_peso < 100 && 0==$aprobado) {
	
if ($num_metas < 5) {
 
?>
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#nmetafun"><span class="glyphicon glyphicon-plus-sign"></span> Compromiso Laboral</a> 
<?php }} ?>
					   </h4> 
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID Reg</th>
                                <th>ID Meta</th>
								<th>Nombre Meta</th>
                                <th>Compromiso Laboral</th>
								<th>Peso Porcentual</th>
                      
                                <th title="Borrar"></th>
								
								 <?php if (1==$_SESSION['rol']) { echo '<th>Nota</th>'; } else {}?>
                             </tr>
                </thead>
            <tbody>

            <?php
			
			if ((isset($_POST["id_metas_funcionario_edl"])) && ($_POST["id_metas_funcionario_edl"] != "")) {
$notaf=$_POST["nota"];
$idcompromiso=$_POST["id_metas_funcionario_edl"];
$idf=$_GET['i'];
  
  $insertSQL = sprintf("INSERT INTO nota_eval_edl (
      id_eval_edl, nombre_nota_eval_edl, id_metas_funcionario_edl, fecha_nota_eval_edl, id_funcionario, estado_nota_eval_edl) 
	  VALUES (%s, %s, %s, now(), %s, %s)", 
      GetSQLValueString($idf, "int"), 
      GetSQLValueString($notaf, "int"), 
	  GetSQLValueString($idcompromiso, "int"),
	  GetSQLValueString($_SESSION['snr'], "int"),
	  GetSQLValueString(1, "int")); 
      $Result = mysql_query($insertSQL, $conexion);
	  
	  
  
}








			$array1 = array();	
			
               $query62 = sprintf("SELECT a.id_metas_funcionario_edl, 
			    a.id_eval_funcionario_edl, b.nombre_metas_edl, a.id_metas_edl,  a.evaluacionf, 
				a.compromiso_laboral, a.peso_porcentual, IFNULL(a.eval_porcentual,0) eval_porcentual  
	            FROM metas_funcionario_edl a  
				LEFT JOIN metas_edl b 
				ON a.id_metas_edl = b.id_metas_edl 
                WHERE a.id_eval_funcionario_edl = '$id_eval_funcionario_edl'  
				AND a.estado_metas_funcionario_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
$compromiso=$row62['id_metas_funcionario_edl'];			  
            ?>
          <tr>
             <td><?php echo $compromiso; ?></td>
             <td><?php echo $row62['id_metas_edl']; ?></td>
             <td><?php echo $row62['nombre_metas_edl'];?></td> 
			 <td><?php echo $row62['compromiso_laboral']; ?></td>
			 <td><?php echo $row62['peso_porcentual']; ?></td>
	
		

		     <td> 
			  <?php if (1==$aprobado) { } else {
			 //if (1==1) { // 1 = jefe inmediato ($tipo_funcionario == 1 and $row62['eval_porcentual'] <= 0) or ($id_grupo_area == 26)
				 ?>
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="metas_funcionario_edl" id="<?php echo $row62['id_metas_funcionario_edl']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
			 <?php } ?>
			 </td>
 		     
			 <?php if (1==1) { ?>


<td>
				<?php 	
$query235 = "SELECT * FROM nota_eval_edl, funcionario WHERE nota_eval_edl.id_funcionario=funcionario.id_funcionario 
and estado_nota_eval_edl = 1 and tipo_c=1 and id_metas_funcionario_edl=".$compromiso." order by id_nota_eval_edl";
$result235 = mysql_query($query235);	 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){

while ($row235 = @mysql_fetch_assoc($result235)){
                echo '<span title="'.$row235['id_nota_eval_edl'].' - '.$row235['fecha_nota_eval_edl'].'">
				'.$row235['nombre_funcionario'].': <b>';
				echo $row235['nombre_nota_eval_edl'].'</b></span> ';
				

					$notttt=($row235['nombre_nota_eval_edl']*$row62['peso_porcentual'])/100;					
                  //echo '-'.$notttt;
				  array_push($array1, $notttt);
				
				 if (2319==$id_funcionario_jefe_area) {
						 echo '';  
					   }   else {
				if (isset($row235['estado_nota'])) {
					
					//echo $id_funcionario_jefe_area.'-';

					 
					
				if (1==$row235['estado_nota']) {
					echo '<span class="fa fa-check"  style="color:#008d4c;">Aprobado</span> '; 
				} else {
				echo '<span class="fa fa-close" style="color:#b40404;">Rechazado</span> '; 
					echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="nota_eval_edl" id="'.$row235['id_nota_eval_edl'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	
				} 
				
				
				
				
				
				} else {
					echo '<span class="fa fa-file" style="color:#ccc;">Pendiente</span> '; 
				}
}
				
                echo '<br>'; 
             } 
	 		 
 } else { } 
mysql_free_result($result235); ?>
</td>
		<?php } else {}  ?>
								
			 
			 
         </tr>
          <?php } ?> 
          </tbody>
        </table>
			<?php
			if (0<$totalRows){
		$cuentac=count($array1);
		$tramitec=array_sum($array1);
		
		$infottc=$tramitec*0.8;
echo '<center>Promedio: '.$tramitec.' / Resultado de compromisos: '.$infottc.'</center>';
			} else {}
		?>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div>
</div><!-- col-md-12 -->


<?php

// ********************************
// Nuevo Meta Funcionario
// ********************************
?>
<div class="modal fade" id="nmetafun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>COMPROMISO LABORAL</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form4311567534555"  enctype="multipart/form-data">
    
	<input type="hidden" class="form-control" id="falta_peso" name="falta_peso" value="<?php echo $falta_peso; ?>" >
	
	<input type="hidden" class="form-control" id="id_eval_funcionario_edl" name="id_eval_funcionario_edl" value="<?php echo $id_eval_funcionario_edl; ?>">
	<input type="hidden" class="form-control" id="id_funcionario2" name="id_funcionario2" value="<?php echo $id_funcionario2; ?>">

    <div class="form-group text-left"> 
        <label  class="control-label">Meta del Área:</label>   
        <select class="form-control" name="id_metas_edl" id="id_metas_edl" required >
        <option value="" selected></option>
        <?php 
$id_grupo_area=$_SESSION['snr_grupo_area'];
echo listaparamentro('metas_edl', 'id_grupo_area', 'id_grupo_area', $id_grupo_area);


		?>
		<option value="167">No vinculado a las actividades del plan anual de gestión</option>	
		
<?php if (2==$_SESSION['snr_tipo_oficina']) {?>
<option value="168">Optimizar los servicios internos y externos de las ORIP de la jurisdicción, en búsqueda del mejoramiento del servicio registral.</option>				
<?php } else {} ?>  
     
	   </select>
	   
    </div>
    
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Compromiso Laboral:</label>   
        <textarea placeholder="Debe ser un parrafo, el verbo + objeto + la condiciòn del resultado." rows="5" cols="40" class="form-control" id="compromiso_laboral"  name="compromiso_laboral" value="" required ></textarea>
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Peso Porcentual:</label>   
     
	<input type="number"  class="form-control" id="peso_porcentual" name="peso_porcentual" value="<?php echo $falta_peso; ?>"  onChange = "valpeso();" required >
	
	</div>

	<div class="modal-footer">
        <span style="color:#ff0000;">(*) Campos obligatorios</span>
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="insertmeta" value="insertmeta">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 

<?php

// ********************************
// Nuevo Evidencia Funcionario
// ********************************
?>
<div class="modal fade" id="nevidefun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVA EVIDENCIA EVALUADO</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form4311567534555"  enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_eval_funcionario_edl22" name="id_eval_funcionario_edl22" value="<?php echo $id_eval_funcionario_edl; ?>">
	<input type="hidden" class="form-control" id="id_funcionario2" name="id_funcionario2" value="<?php echo $id_funcionario2; ?>">

	<div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Compromiso Laboral:</label> 
        <select class="form-control" name="id_metas_funcionario_edl" id="id_metas_funcionario_edl" >
        <option value="0" selected></option>
        <?php echo comprolaboral($id_eval_funcionario_edl); ?>
        </select>
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">Fecha Evidencia:</label>   
        <input type="date" class="form-control" name="fecha_evidencia" id="fecha_evidencia" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Descripción Evidencia:</label>   
        <textarea rows="5" cols="40" class="form-control" id="nombre_evidencias_edl"  name="nombre_evidencias_edl" value="" required ></textarea>
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Ubicación Evidencia:</label>   
        <textarea rows="5" cols="40" class="form-control" id="ubicacion_evidencia"  name="ubicacion_evidencia" value="" required ></textarea>
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Observación Evidencia:</label>   
        <textarea rows="5" cols="40" class="form-control" id="observa_evidencia"  name="observa_evidencia" value="" required ></textarea>
    </div>

	<div class="modal-footer">
        <span style="color:#ff0000;">(*) Campos obligatorios</span>
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="inserteviden" value="inserteviden">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 



<!-- Modal: modifica Meta -->
<div class="modal fade" id="modifimeta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>MODIFICACION COMPROMISO LABORAL</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">
                   
				   <input type="hidden" name="id_eval_funcionario_edl8" id="id_eval_funcionario_edl8"   value="" >
                   <input type="hidden" name="id_metas_funcionario_edl8" id="id_metas_funcionario_edl8"   value="" >
				   
                   <div class="form-group text-left"> 
                      <label  class="control-label">Meta del Área:</label>   
	                  <select class="form-control" name="id_metas_edl8" id="id_metas_edl8" required>
                      <option value="" selected> </option>
                      <?php 
                        $id_grupo_area=$_SESSION['snr_grupo_area'];
                        echo listaparamentro('metas_edl', 'id_grupo_area', 'id_grupo_area', $id_grupo_area);
                      ?>   
                      <option value="167">No vinculado a las actividades del plan anual de gestión</option>					  
                      </select>
                   </div>
    
                  <div class="form-group text-left"> 
                       <label  class="control-label"><span style="color:#ff0000;">*</span> Compromiso Laboral:</label>   
                       
					   <textarea placeholder="" rows="5" cols="40" class="form-control" id="compromiso_laboral8"  name="compromiso_laboral8" value="" required ></textarea>
                  </div>
    
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Peso Porcentual:</label>   
	<input type="number"  class="form-control" id="peso_porcentual8" name="peso_porcentual8" value=""  onChange = "valpeso();" required >
					                      
</div>

                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="modifimeta" value="modifimeta">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
 
				</form>
              </div>
          </div> 
     </div> 
</div> 

<!-- Modal: modifica Evidencia -->
<div class="modal fade" id="modieviden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>MODIFICACION EVIDENCIA</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">
                   
				   <input type="hidden" name="id_eval_funcionario_edl78" id="id_eval_funcionario_edl78"   value="" >
                   <input type="hidden" name="id_evidencias_edl78" id="id_evidencias_edl78"   value="" >
				   
	<div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Compromiso Laboral:</label> 
        <select class="form-control" name="id_metas_funcionario_edl78" id="id_metas_funcionario_edl78" >
        <option value="" selected></option>
        <?php echo comprolaboral($id_eval_funcionario_edl); ?>
        </select>
    </div>
    
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Fecha Evidencia:</label>   
                        <input type="date" class="form-control" name="fecha_evidencia78" id="fecha_evidencia78" value="" required >
                   </div>

                  <div class="form-group text-left"> 
                       <label  class="control-label"><span style="color:#ff0000;">*</span> Descripción Evidencia:</label>   
                       <textarea rows="5" cols="40" class="form-control" id="nombre_evidencias_edl78"  name="nombre_evidencias_edl78" value="" required ></textarea>
                  </div>
    
                  <div class="form-group text-left"> 
                       <label  class="control-label"><span style="color:#ff0000;">*</span> Ubicación Evidencia:</label>   
                       <textarea rows="5" cols="40" class="form-control" id="ubicacion_evidencia78"  name="ubicacion_evidencia78" value="" required ></textarea>
                  </div>
    
                  <div class="form-group text-left"> 
                       <label  class="control-label"><span style="color:#ff0000;">*</span> Observación Evidencia:</label>   
                       <textarea rows="5" cols="40" class="form-control" id="observa_evidencia78"  name="observa_evidencia78" value="" required ></textarea>
                  </div>
   
                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="modifievi" value="modifievi">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
				</form>
              </div>
          </div> 
     </div> 
</div> 



<?php
 // ************************************
 // Detalle de Competencias Funcionario
 // ************************************
 ?>
 
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
						 <?php echo 'COMPETENCIAS COMPORTAMENTAL  (<B style="color:#B40404;">Mínimo 3 - Máximo 5</B>) - '.'<b>'.' NÚMERO DE COMPETENCIAS: '.$num_compe.' ---> '.'</b>'.'<b>'.' CALIFICACIÓN: '.$prom_compe.'</b>'; ?>
					   </h4> 
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
            		   <?php if ($num_compe < 5 && 0==$aprobado) { // 1 = jefe inmediato ?>
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ncompefun"><span class="glyphicon glyphicon-plus-sign"></span> Competencia Comportamental</a> 
                       <?php } ?>
					   </h4> 
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID</th>
                                <th>Competencia</th>
                                <th>Definición</th>
								<th>Conductas Asociadas</th>
							
                                <th></th>
								 <?php if (1==$_SESSION['rol']) { echo '<th style="width:140px;">Evaluar</th><th></th>'; } else {}?>
                             </tr>
                </thead>
            <tbody>
            <?php
			
			
			
			
			
				if ((isset($_POST["id_competencia_funcionario_edl"])) && ($_POST["id_competencia_funcionario_edl"] != "")) {
$notafc=$_POST["notafc"];
$idcompetencia=$_POST["id_competencia_funcionario_edl"];
$idf=$_GET['i'];
  $updateSQL2 = sprintf("UPDATE competencia_funcionario_edl SET evaluacionfc=%s  WHERE id_competencia_funcionario_edl=%s 
  and id_eval_funcionario_edl=%s and estado_competencia_funcionario_edl=1",
                       GetSQLValueString($notafc, "text"),
					     GetSQLValueString($idcompetencia, "int"),
					    GetSQLValueString($idf, "int"));
  $Result12 = mysql_query($updateSQL2, $conexion);
}


$array0 = array();	

			
               $query62 = sprintf("SELECT a.id_competencia_funcionario_edl, 
			    a.id_eval_funcionario_edl, a.id_competencias_edl, a.evaluacionfc, 
				a.id_niveles_desarrollo_edl, a.valor_niveldesa, descrip_cualitativa,
				b.nombre_competencias_edl, b.definicion_edl, b.conducta_asociada,
				c.nombre_niveles_desarrollo_edl 
	            FROM competencia_funcionario_edl a
				LEFT JOIN competencias_edl b
				ON a.id_competencias_edl = b.id_competencias_edl
				LEFT JOIN niveles_desarrollo_edl c
				ON a.id_niveles_desarrollo_edl = c.id_niveles_desarrollo_edl
                WHERE a.id_eval_funcionario_edl = '$id_eval_funcionario_edl'  
				AND a.estado_competencia_funcionario_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion);
			  while ($row62 = mysql_fetch_assoc($select62)) {

$idcompetencia= $row62['id_competencia_funcionario_edl']; 
				  
            ?>
          <tr>
             <td><?php echo $idcompetencia; ?></td>
             <td><?php echo $row62['nombre_competencias_edl'];?></td> 
			 <td><?php echo $row62['definicion_edl']; ?></td>
			 <td><?php echo $row62['conducta_asociada']; ?></td>
			
	
			
      
		   
			  <td>
<?php 
			 if (1==$aprobado) { } else {
			 //if (1==1) { // 1 = jefe inmediato ($tipo_funcionario == 1 and $row62['valor_niveldesa'] <= 0) or ($id_grupo_area == 26) ?>
		    			  
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="competencia_funcionario_edl" id="<?php echo $row62['id_competencia_funcionario_edl']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
 <?php } ?>			
			</td>
 		    
				 <?php if (1==1) {  ?>
				<td>
								<?php 	
								
			
			
$query235 = "SELECT * FROM nota_eval_edl, funcionario WHERE nota_eval_edl.id_funcionario=funcionario.id_funcionario 
and estado_nota_eval_edl = 1 and tipo_c=2 and id_competencia_funcionario_edl=".$idcompetencia." order by id_nota_eval_edl";
$result235 = mysql_query($query235, $conexion);	
$row235 = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){
do {
	
//while ($row235 = @mysql_fetch_assoc($result235)){
                echo '<span title="'.$row235['id_nota_eval_edl'].' - '.$row235['fecha_nota_eval_edl'].'">'.$row235['nombre_funcionario'].': <b>';
				$notacompe=$row235['nota_competencia'];
				echo $notacompe.'</b></span> / ';
		

				if ('Muy alto'==$row235['nota_competencia']) {
				array_push($array0, 100);
                } else {  }
				
			    if ('Alto'==$row235['nota_competencia']) {
				array_push($array0, 80); 
					} else {   }
				
				 if ('Aceptable'==$row235['nota_competencia']) {
				array_push($array0, 60); 
					} else {  }
				
				if ('Bajo'==$row235['nota_competencia']) {
				array_push($array0, 40); 
					 } else {   }				
						
		
		
			  if (2319==$id_funcionario_jefe_area) {
						 echo '';  
					   }   else {
				
				if (isset($row235['estado_nota'])) { 
				
			  
				
				if (1==$row235['estado_nota']) {
					echo '<span class="fa fa-check"  style="color:#008d4c;">Aprobado</span> '; 
				} else {
					echo '<span class="fa fa-close" style="color:#b40404;">Rechazado</span> '; 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="nota_eval_edl" id="'.$row235['id_nota_eval_edl'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	
				} 
				
					   
				
				
				
				}  else {
echo '<span class="fa fa-file" style="color:#ccc;">Pendiente</span> '; 

					}
}
                echo '<br>'; 
            // }
 } while ($row235 = mysql_fetch_assoc($result235)); 			
	 		 
 } else { }   
 mysql_free_result($result235);
 
 
 
 ?>
</td>
			 <?php } else {}  ?>
		
		
			
         </tr>
          <?php } ?> 
          </tbody>
        </table>
		<?php
		if (0<$totalRows){
		$cuenta=count($array0);
		$tramite=array_sum($array0);
		$infoff=$tramite/$cuenta;
		$infott=$infoff*0.2;
echo '<center>Resultado de competencias: '.$infott.'<br>';
$res=$infott+$infottc;
echo '<b>Nota definitiva: '.$res.'<br>';

if (95<=$res) {
	echo 'Sobresaliente';
} else {

	if (85<=$res && 95>$res) {
	echo 'Destacado';
	
	} else {
		
		if (70<=$res && 85>$res) {
	echo 'Satisfactorio';
	
	} else {
		echo 'No satisfactorio';
	}
	}
}

echo '</b>';

	echo '<br><a href="pdf/formato_edl&'.$id_eval_funcionario_edl.'.pdf" download="Formato EDL.pdf"><img src="../images/pdf.png"> Generar PDF para firma.</a> ';
	

echo '</center>';

		} else {}
		?>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div>
</div><!-- col-md-12 -->


<?php
 // ************************************
 // Detalle de Evidencias Funcionario
 // ************************************
 
 
 if (1==2) {
 ?>
 
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'EVIDENCIAS DEL EVALUADO'; ?>
					   </h4> 
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
           		       <?php if ($tipo_funcionario <= 1 AND $estado_eva_jarea == 0) { // 1 = jefe inmediato ?>
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#nevidefun"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Evidencia del Evaluado</a> 
                       <?php } ?>
					   </h4> 
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID Reg</th>
                                <th>ID Meta</th>
                                <th>Meta Area</th>
                                <th>Definición Evidencia</th>
								<th>Ubicación Evidencia</th>
								<th>Fecha Evidencia</th>
								<th>Observación Evidencia</th>
								<th>Aportada Por</th>
                                <th colspan="4">Acción</th>
                             </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT a.id_evidencias_edl, 
			    a.nombre_evidencias_edl, 
				c.nombre_metas_edl, a.id_metas_funcionario_edl,
				a.ubicacion_evidencia, a.fecha_evidencia, a.observa_evidencia,
				case when a.aportado_por > 1
                then 'EVALUADOR'
                else 'EVALUADO'
                end AS qaporta
	            FROM evidencias_edl a
				LEFT JOIN metas_edl c 
				ON a.id_metas_funcionario_edl = c.id_metas_edl 
                WHERE a.id_eval_funcionario_edl = '$id_eval_funcionario_edl'  
				AND a.estado_evidencias_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	 
            ?>
          <tr>
             <td><?php echo $row62['id_evidencias_edl']; ?></td>
             <td><?php echo $row62['id_metas_funcionario_edl']; ?></td>
             <td><?php echo $row62['nombre_metas_edl'];?></td> 
			 <td><?php echo $row62['nombre_evidencias_edl']; ?></td>
			 <td><?php echo $row62['ubicacion_evidencia']; ?></td>
			 <td><?php echo $row62['fecha_evidencia']; ?></td>
			 <td><?php echo $row62['observa_evidencia']; ?></td>
			 <td><?php echo $row62['qaporta']; ?></td>
	    	 <?php if ($tipo_funcionario == 1 AND $estado_eva_jarea == 0) { // 1 = jefe inmediato ?>
             <td>
				<button type="button" class="btn btn-info btn-xs modievibtn" title="Modificación Evidencia"><span  class="glyphicon glyphicon-hand-up"></span></button>&nbsp;
             </td>
             <?php } ?> 
		     <?php if ($tipo_funcionario == 1 AND $estado_eva_jarea == 0) { // 1 = jefe inmediato ?>
    		 <td> 
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="evidencias_edl" id="<?php echo $row62['id_evidencias_edl']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
			 </td>
             <?php } ?> 
          </tr>
          <?php } ?> 
          </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div>
</div><!-- col-md-12 -->


<?php
	}
// ********************************
// Nuevo Competencia Funcionario
// ********************************
?>


<div class="modal fade" id="ncompefun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>COMPETENCIA COMPORTAMENTAL</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form46678655">
    <input type="hidden" class="form-control" id="id_eval_funcionario_edl3" name="id_eval_funcionario_edl3" value="<?php echo $id_eval_funcionario_edl; ?>">
	<input type="hidden" class="form-control" id="id_funcionario3" name="id_funcionario3" value="<?php echo $id_funcionario2; ?>">
 	<div class="form-group text-left"> 
	     <label  class="control-label"><span style="color:#ff0000;">*</span> Competencia:</label> 
	     <select class="form-control" name="id_competencias_edl3" id="id_competencias_edl3" required>
            <option value="" selected> </option>
            <?php 
            
             $query235 = "SELECT * FROM competencias_edl WHERE  estado_competencias_edl = 1 order by nombre_competencias_edl";
             $result235 = mysql_query($query235);
             while ($row235 = @mysql_fetch_assoc($result235)){
                echo "<option value='".$row235['id_competencias_edl']."'>";
                echo ' '.$row235['nombre_competencias_edl']."</option>"; 
             }
            ?>     
         </select>
    </div>

	<div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="inscompefun" value="inscompefun">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
	
  </form>
</div>
</div> 
</div> 
</div> 

<!-- Modal: Califica Meta Jefe inmediato -->
<div class="modal fade" id="calimeta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>CALIFICACIÓN COMPROMISO LABORAL</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                <form action="" method="POST" name="form1" enctype="multipart/form-data">
                   
				   <input type="hidden" name="id_eval_funcionario_edl85" id="id_eval_funcionario_edl85"   value="" >
                   <input type="hidden" name="id_metas_funcionario_edl85" id="id_metas_funcionario_edl85"   value="" >
				   
                  <div class="form-group text-left"> 
                       <label  class="control-label"><span style="color:#ff0000;">*</span> Meta del Area:</label>   
                       <textarea rows="5" cols="40" class="form-control" id="nombre_meta_funcionario_edl85"  name="nombre_meta_funcionario_edl85" readonly = "readonly" value="" required ></textarea>
                  </div>
    
                  <div class="form-group text-left"> 
                       <label  class="control-label"><span style="color:#ff0000;">*</span> Compromiso Laboral:</label>   
                       <textarea rows="5" cols="40" class="form-control" id="compromiso_laboral85"  name="compromiso_laboral85" readonly = "readonly" value="" required ></textarea>
                  </div>
    
                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Peso Porcentual:</label>   
                        <input type="number" class="form-control" name="peso_porcentual85" id="peso_porcentual85" readonly = "readonly" value="" required >
                   </div>

                   <div class="form-group text-left"> 
                        <label  class="control-label"><span style="color:#ff0000;">*</span>Calificación Evaluador:</label>   
                        <input type="number" class="form-control" name="eval_porcentual85" id="eval_porcentual85" value="" required >
                   </div>

  
                  <div class="modal-footer">
						<span style="color:#ff0000;">(*) Campos obligatorios</span>
                        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                        <button type="submit" class="btn btn-success"><input type="hidden" name="gcalimeta" value="gcalimeta">
                        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
				  </div>
				</form>
              </div>
          </div> 
     </div> 
</div> 


<?php

// ********************************
// Califica Competencia Funcionario
// ********************************
?>


<div class="modal fade" id="calicompefun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>CALIFICACIÓN COMPETENCIA LABORAL</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form46655">
	<input type="hidden" class="form-control" id="id_competencia_funcionario_edl65" name="id_competencia_funcionario_edl65" value="">

    <div class="form-group text-left"> 
      <label  class="control-label">Competencia:</label>   
      <input type="text" class="form-control" name="nombre_competencias_edl65" id="nombre_competencias_edl65" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span> Definición:</label>   
         <textarea rows="5" cols="40" class="form-control" id="definicion_edl65"  name="definicion_edl65" readonly="readonly" value="" required ></textarea>
    </div>

    <div class="form-group text-left"> 
         <label  class="control-label"><span style="color:#ff0000;">*</span>Cal Cuantitativa (0 - 15):</label>   
         <input type="number" class="form-control" name="valor_niveldesa65" id="valor_niveldesa65" value="" required >
    </div>

    <div class="form-group text-left"> 
         <label  class="control-label"> Descripción Cualitativa:</label>   
         <textarea rows="5" cols="40" class="form-control" id="descrip_cualitativa65"  name="descrip_cualitativa65" value="" ></textarea>
    </div>
 
	<div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="calicompefun" value="calicompefun">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
	
  </form>
</div>
</div> 
</div> 
</div> 

<?php

// ********************************
// Calificacion Jefe Area
// ********************************
?>


<div class="modal fade" id="eval_jefearea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>CALIFICACIÓN COMISIÓN EVALUADORA</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form46678655">
    <input type="hidden" class="form-control" id="id_eval_funcionario_edl6" name="id_eval_funcionario_edl6" value="<?php echo $id_eval_funcionario_edl; ?>">
	<input type="hidden" class="form-control" id="id_funcionario6" name="id_funcionario6" value="<?php echo $id_funcionario2; ?>">
 	<div class="form-group text-left"> 
	     <label  class="control-label"><span style="color:#ff0000;">*</span> Evaluación Comisión Evaluadora:</label> 
            <option value="" selected> </option>
	     <select class="form-control" name="califi_jarea6" id="califi_jarea6" required>
        <option value="0" selected>Aceptada</option>
        <option value="1" >Rechazada</option>
        </select>
    </div>

	<div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actcalijefea" value="actcalijefea">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
	
  </form>
</div>
</div> 
</div> 
</div> 

<?php

// ********************************
// Carge Doctos Ausentismo
// ********************************
?>
<div class="modal fade" id="carguedocedl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>CARGUE DE DOCTO FIRMADO - EDL</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
  <form action="" method="POST" name="form43534543555" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_ausentismo" name="id_ausentismo" value="<?php echo $id_ausentismo; ?>">
		
    <div class="form-group text-left"> 
       <label  class="control-label"><span style="color:#ff0000;">*</span> ADJUNTAR DOCUMENTO:</label> 
       <input type="file" value=""  name="file" required>
    </div>

    <div class="form-group text-left">
	   <button type="submit" class="btn btn-success">
       <input type="hidden" name="insertdocto" value="carguedocto"><span class="glyphicon glyphicon-ok"></span> Cargar </button>
    </div>
  </form>
</div>
</div> 
</div> 
</div> 






<?php
	} else { echo 'No tiene acceso..'; }
	
	
 function competencia() {
		
global $mysqli;
$query5 = "SELECT * FROM competencias_edl WHERE  estado_competencias_edl = 1 ";
$result5 = $mysqli->query($query5);
while ($obj = $result5->fetch_array()) {
	$infoid = 'id_competencias_edl';
	$infonombre ='nombre_competencias_edl';
	$nom = $obj[$infonombre];
	$codifi = mb_detect_encoding($nom, "UTF-8, ISO-8859-1");
	$infonombre = iconv($codifi, 'UTF-8', $nom);
	
    printf ("<option value='%s'>%s</option>\n", $obj[$infoid], $infonombre);
 }

$result5->free();

}

 
 ?>

<?php

function nivlesdesa($tabla) {
		
global $mysqli;
$query55 = "SELECT id_".$tabla.", nombre_".$tabla."  FROM ".$tabla." where  estado_".$tabla." = 1";
$result55 = $mysqli->query($query55);
while ($obj = $result5->fetch_array()) {
	$infoid='id_'.$table;
	$infonombre ='nombre_'.$table;
	$nom = $obj[$infonombre];
	$codifi = mb_detect_encoding($nom, "UTF-8, ISO-8859-1");
	$infonombre = iconv($codifi, 'UTF-8', $nom);
	
    printf ("<option value='%s'>%s</option>\n", $obj[$infoid], $infonombre);
 }

$result55->free();

}

 
 ?>

<script>
     $(document).ready(function() {
      $('.modimebtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#modifimeta").modal("show");
          $('#id_metas_funcionario_edl8').val(data[0]);
//          $('#id_metas_edll8').val(data[1]);
          document.getElementById('id_metas_edl8').value = data[1];
          $('#compromiso_laboral8').val(data[3]);
          $('#peso_porcentual8').val(data[4]);
      });  
    });

</script>


<script>
     $(document).ready(function() {
      $('.modievibtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#modieviden").modal("show");
          $('#id_evidencias_edl78').val(data[0]);
          $('#id_metas_funcionario_edl78').val(data[1]);
          $('#nombre_meta_funcionario_edl78').val(data[2]);
          $('#nombre_evidencias_edl78').val(data[3]);
          $('#ubicacion_evidencia78').val(data[4]);
		  $('#fecha_evidencia78').val(data[5]);
		  $('#observa_evidencia78').val(data[6]);
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.calijibtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#calimeta").modal("show");
          $('#id_metas_funcionario_edl85').val(data[0]);
          $('#nombre_meta_funcionario_edl85').val(data[2]);
          $('#compromiso_laboral85').val(data[3]);
          $('#peso_porcentual85').val(data[4]);
		  $('#eval_porcentual85').val(data[5]);
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.editbtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#modiausen").modal("show");
          $('#id_ausentismo').val(data[0]);
		  $('#id_funcionario_jefe2').val(data[1]);
          $('#id_funcionario2').val(data[2]);
		  $('#nombre_funcionario2').val(data[3]);
		  $('#id_tipo_ausentismo2').val(data[4]);
		  $('#nombre_tipo_ausentismo2').val(data[5]);
          $('#mfecha_inicio2').val(data[6]);
		  $('#mfecha_final2').val(data[7]);
		  $('#id_funcionario_reempla2').val(data[8]);
		  $('#id_tipo_ausentismo2').val(data[9]);
		  $('#id_aprobacion_ausentismo2').val(data[10]);
//		  $('#nombre_aprobacion_ausentismo').val(data[11]);
		  $('#motivo_ausentismo2').val(data[12]);
		  $('#hora_inicio2').val(data[13]);
		  $('#hora_final2').val(data[14]);
		  $('#id_tipo_oficina2').val(data[15]);
		  $('#id_grupo_area2').val(data[16]);
		  $('#id_oficina_registro2').val(data[17]);
          $('#nombre_funcionario_reem2').val(data[18]);
		  
		  //		alert("difer: " + diasdif);
        if(data[6] == data[7]) {
			hdesde2.style.display='block';
			hhasta2.style.display='block';
         } else {
			document.getElementById('hora_inicio2').value = '00:00:00';
			document.getElementById('hora_final2').value = '00:00:00';
		 }
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.aprobjdtr').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#aprojedtr").modal("show");
          $('#id_ausentismo3').val(data[0]);
		  $('#id_funcionario_jefe3').val(data[1]);
          $('#id_funcionario3').val(data[2]);
		  $('#nombre_funcionario3').val(data[3]);
		  $('#id_tipo_ausentismo3').val(data[4]);
		  $('#nombre_tipo_ausentismo3').val(data[5]);
          $('#mfecha_inicio3').val(data[6]);
		  $('#mfecha_final3').val(data[7]);
		  $('#id_funcionario_reempla3').val(data[8]);
		  $('#id_tipo_ausentismo3').val(data[9]);
		  $('#id_aprobacion_ausentismo3').val(data[10]);
//		  $('#nombre_aprobacion_ausentismo3').val(data[11]);
		  $('#motivo_ausentismo3').val(data[12]);
		  $('#hora_inicio3').val(data[13]);
		  $('#hora_final3').val(data[14]);
		  $('#id_tipo_oficina3').val(data[15]);
		  $('#id_grupo_area3').val(data[16]);
		  $('#id_oficina_registro3').val(data[17]);
		  $('#nombre_funcionario_reem3').val(data[18]);
		  
        if(data[6] == data[7]) {
			hdesde3.style.display='block';
			hhasta3.style.display='block';
         } else {
			document.getElementById('hora_inicio3').value = '00:00:00';
			document.getElementById('hora_final3').value = '00:00:00';
		 }
		 

      jsofireg();
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.aprobtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#aprscrgral").modal("show");
          $('#id_ausentismo4').val(data[0]);
          $('#id_funcionario_jefe4').val(data[1]);
		  
          $('#nombre_funcionario4').val(data[3]);
          $('#nombre_tipo_ausentismo4').val(data[5]);
          $('#mfecha_inicio4').val(data[6]);
          $('#mfecha_final4').val(data[7]);
		  $('#id_funcionario_reempla4').val(data[8]);
		  $('#id_aprobacion_ausentismo4').val(data[10]);
		  $('#motivo_ausentismo4').val(data[12]);
		  $('#id_tipo_oficina4').val(data[15]);
		  $('#id_grupo_area4').val(data[16]);
		  $('#id_oficina_registro4').val(data[17]);
          $('#nombre_funcionario_reem4').val(data[18]); 
		  });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.rhaprobtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#aprrecurh").modal("show");
          $('#id_ausentismo5').val(data[0]);
          $('#id_funcionario_jefe5').val(data[1]);
		  
          $('#nombre_funcionario5').val(data[3]);
          $('#nombre_tipo_ausentismo5').val(data[5]);
          $('#mfecha_inicio5').val(data[6]);
          $('#mfecha_final5').val(data[7]);
		  $('#id_funcionario_reempla5').val(data[8]);
		  $('#id_aprobacion_ausentismo5').val(data[10]);
		  $('#motivo_ausentismo5').val(data[12]);
		  $('#id_tipo_oficina5').val(data[15]);
		  $('#id_grupo_area5').val(data[16]);
		  $('#id_oficina_registro5').val(data[17]);
          $('#nombre_funcionario_reem5').val(data[18]);
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.calijiedl').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#calicompefun").modal("show");
          $('#id_competencia_funcionario_edl65').val(data[0]);
          $('#nombre_competencias_edl65').val(data[1]);
		  
          $('#definicion_edl65').val(data[2]);
          $('#conducta_asociada65').val(data[3]);
          $('#nombre_niveles_desarrollo_edl65').val(data[4]);
//		  alert ("cali: " + data[5]);
		  $('#descrip_cualitativa65').val(data[6]);
		  $('#id_niveles_desarrollo_edl65').val(data[7]);
      });  
    });

</script>

<script>
    function valpeso() {
	var falta_peso = document.getElementById('falta_peso').value;
	var peso_porcentual = document.getElementById('peso_porcentual').value;
//	alert('falta_peso = ' + falta_peso);
//	alert('peso_porcentual = ' + peso_porcentual);
	
		if ( Number(peso_porcentual) > Number(falta_peso)) {
			alert('Peso porcentual mayor al 100% ....!!!');  
			document.getElementById('peso_porcentual').value = falta_peso;
			document.getElementById('peso_porcentual').focus();
		} 
    }
</script>

<script>
    function valtipofun() {
	var tipo_funcionario = document.getElementById('tipo_funcionario').value;
	var id_funcionario2 = document.getElementById('id_funcionario2').value;
		if ( tipo_funcionario > 0) {
			funconsul.style.display='block';
			document.getElementById('id_funcionario_edl').focus();
		} else {
			funconsul.style.display='none';
			document.getElementById('id_funcionario_edl').value = id_funcionario2;
			document.getElementById('tipo_funcionario').focus();
        }
    }
</script>

<script>
    function valjefeinme() {
        var jefe_inme = document.getElementById('id_funcionario_jefe_inme').value;
		var id_funcionario = document.getElementById('id_funcionario').value;
		var jefeyfun = jefe_inme+'-'+id_funcionario;	 			
        jQuery.ajax({
        type: "POST",url: "pages/valijefeinme.php",
		data: "valjinme="+jefeyfun,
		async: true,
         success: function(b) {
			   var sw5 = b * 1;
//			   alert('sw5 = ' + sw5);  
			   if (sw5 > 0) {
				alert('Cargo del Jefe inmediato es menor al del Funcionario....!!!');  
                document.getElementById('id_funcionario_jefe_inme').focus();				
			   } else {
				  document.getElementById('id_funcionario_jefe_area').focus(); 
			   }
               
         }
        });				
    }
</script>

<script>
    function valjefearea() {
        var jefe_area = document.getElementById('id_funcionario_jefe_area').value;
		var id_funcionario = document.getElementById('id_funcionario').value;
		var jefeyfun = jefe_area+'-'+id_funcionario;	 			
        jQuery.ajax({
        type: "POST",url: "pages/valijefeinme.php",
		data: "valjinme="+jefeyfun,
		async: true,
         success: function(b) {
			   var sw5 = b * 1;
			   if (sw5 > 0) {
				alert('Cargo del Jefe Area es menor al del Funcionario....!!!');  
//                document.getElementById('id_funcionario_jefe_area').focus();				
			   } else {
				  document.getElementById('id_funcionario_jefe_area').focus(); 
			   }
               
         }
        });				
    }
</script>
 
<?php  

function periodosedl() {
	global $mysqli;
	$query = "SELECT * FROM periodos_edl WHERE estado_periodos_edl=1 ";
    $resultado = $mysqli->query($query);
	 while ($obj = $resultado->fetch_object()) {
        printf ("<option value='%s'>%s</option>\n", $obj->id_periodos_edl, $obj->fechaper_desde. ' - '.$obj->fechaper_hasta);
    }
}


 function comprolaboral($id_eval_funcionario_edl) {
		
global $mysqli;
 
    $query17 = "SELECT a.id_metas_funcionario_edl, b.id_metas_edl,
	            b.nombre_metas_edl 
			    FROM metas_funcionario_edl a 
				LEFT JOIN metas_edl b 
				ON a.id_metas_edl = b.id_metas_edl 
			    WHERE a.id_eval_funcionario_edl = '$id_eval_funcionario_edl'
		 AND a.estado_metas_funcionario_edl = 1";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj17['id_metas_edl'], $obj17['nombre_metas_edl']);
    }
	echo '<option value="167">No vinculado a las actividades del plan anual de gestión</option>	';
$result17->free();	
 }






 

?>









<div class="modal fade bd-example-modal-lg" id="popupanexoevaluacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>CALIFICACIÓN</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form46678655">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>
Periodo a evaluar: </label> <br>
<select name="periodo_evaluacion"  required> 
<option value="" selected></option>
<option value="2022-II">2022-II</option>
<option value="2023-I">2023-I</option>
</select>
</div>
	
	
	


<div class="form-group text-left"> 
<label  class="control-label">COMPROMISOS LABORALES:</label> 

<?php
$query62 = sprintf("SELECT a.id_metas_funcionario_edl, 
			    a.id_eval_funcionario_edl, b.nombre_metas_edl, a.id_metas_edl,  a.evaluacionf, 
				a.compromiso_laboral, a.peso_porcentual, IFNULL(a.eval_porcentual,0) eval_porcentual  
	            FROM metas_funcionario_edl a  
				LEFT JOIN metas_edl b 
				ON a.id_metas_edl = b.id_metas_edl 
                WHERE a.id_eval_funcionario_edl = '$id_eval_funcionario_edl'  
				AND a.estado_metas_funcionario_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion);
			  while ($row62 = mysql_fetch_assoc($select62)) {	
$compromiso=$row62['id_metas_funcionario_edl'];			  
  
  echo '<b>'.$row62['nombre_metas_edl'].':</b> '.$row62['compromiso_laboral'].'<br>'; 
  
				
$query235 = "SELECT * FROM nota_eval_edl, funcionario WHERE nota_eval_edl.id_funcionario=funcionario.id_funcionario 
and estado_nota_eval_edl = 1 and id_metas_funcionario_edl=".$compromiso." order by id_nota_eval_edl";
$result235 = mysql_query($query235);	 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){

while ($row235 = @mysql_fetch_assoc($result235)){
	
	$idnot=$row235['id_nota_eval_edl'];
                echo '<span title="'.$row235['fecha_nota_eval_edl'].'" style="color:#B40404">'.$row235['nombre_funcionario'].': <b>';
				echo $row235['nombre_nota_eval_edl'].'</b></span> ';
				
	
	if (isset($row235['estado_nota'])) {
	
				if (1==$row235['estado_nota']) {

echo '<span class="fa fa-check"  style="color:#008d4c;">Aprobado</span> '; 

					} else {
					
						echo '<span class="fa fa-close" style="color:#b40404;">Rechazado</span> '; 
					
					echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="nota_eval_edl" id="'.$row235['id_nota_eval_edl'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
					
					/*if ($_SESSION['snr']==$id_funcionario_jefe_area ) {
				echo '<select name="aprobarcompromiso-'.$idnot.'" class="form-control" style="width:100px;" required><option></option><option value="1">Aprobar</option><option value="0">Rechazar</option>'; 
				echo '</select>'; 
					} else {
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="nota_eval_edl" id="'.$row235['id_nota_eval_edl'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
						}*/
				
				
				}
				
} else {
	
	
		if ($_SESSION['snr']==$id_funcionario_jefe_area ) {
				echo '<select name="aprobarcompromiso-'.$idnot.'" class="form-control" style="width:100px;" required><option></option><option value="1">Aprobar</option><option value="0">Rechazar</option>'; 
				echo '</select>'; 
					} else {
						
	echo '<span  style="color:#ccc;">Pendiente</span> '; 
					}
}
                echo '<br>'; 
             } 
	 		 
 } else {			
?>	
	

<select name="id_metas_funcionario_edl-<?php echo $compromiso; ?>" class="form-control" style="width:100px;" required> 
<option selected></option>
<option>	100	</option>
<option>	99	</option>
<option>	98	</option>
<option>	97	</option>
<option>	96	</option>
<option>	95	</option>
<option>	94	</option>
<option>	93	</option>
<option>	92	</option>
<option>	91	</option>
<option>	90	</option>
<option>	89	</option>
<option>	88	</option>
<option>	87	</option>
<option>	86	</option>
<option>	85	</option>
<option>	84	</option>
<option>	83	</option>
<option>	82	</option>
<option>	81	</option>
<option>	80	</option>
<option>	79	</option>
<option>	78	</option>
<option>	77	</option>
<option>	76	</option>
<option>	75	</option>
<option>	74	</option>
<option>	73	</option>
<option>	72	</option>
<option>	71	</option>
<option>	70	</option>
<option>	69	</option>
<option>	68	</option>
<option>	67	</option>
<option>	66	</option>
<option>	65	</option>
<option>	64	</option>
<option>	63	</option>
<option>	62	</option>
<option>	61	</option>
<option>	60	</option>
<option>	59	</option>
<option>	58	</option>
<option>	57	</option>
<option>	56	</option>
<option>	55	</option>
<option>	54	</option>
<option>	53	</option>
<option>	52	</option>
<option>	51	</option>
<option>	50	</option>
<option>	49	</option>
<option>	48	</option>
<option>	47	</option>
<option>	46	</option>
<option>	45	</option>
<option>	44	</option>
<option>	43	</option>
<option>	42	</option>
<option>	41	</option>
<option>	40	</option>
<option>	39	</option>
<option>	38	</option>
<option>	37	</option>
<option>	36	</option>
<option>	35	</option>
<option>	34	</option>
<option>	33	</option>
<option>	32	</option>
<option>	31	</option>
<option>	30	</option>
<option>	29	</option>
<option>	28	</option>
<option>	27	</option>
<option>	26	</option>
<option>	25	</option>
<option>	24	</option>
<option>	23	</option>
<option>	22	</option>
<option>	21	</option>
<option>	20	</option>
<option>	19	</option>
<option>	18	</option>
<option>	17	</option>
<option>	16	</option>
<option>	15	</option>
<option>	14	</option>
<option>	13	</option>
<option>	12	</option>
<option>	11	</option>
<option>	10	</option>
<option>	9	</option>
<option>	8	</option>
<option>	7	</option>
<option>	6	</option>
<option>	5	</option>
<option>	4	</option>
<option>	3	</option>
<option>	2	</option>
<option>	1	</option>
<option>	0	</option>
</select>
<br>
<?php }   ?>

          <?php } 
		  
		  mysql_free_result($result235);
		  ?> 

</div>



<hr>



<div class="form-group text-left"> 
<label  class="control-label">COMPETENCIAS COMPORTAMENTALES :</label> 
<br><br>
<?php
               $query62 = sprintf("SELECT a.id_competencia_funcionario_edl, 
			    a.id_eval_funcionario_edl, a.id_competencias_edl, a.evaluacionfc, 
				a.id_niveles_desarrollo_edl, a.valor_niveldesa, descrip_cualitativa,
				b.nombre_competencias_edl, b.definicion_edl, b.conducta_asociada,
				c.nombre_niveles_desarrollo_edl 
	            FROM competencia_funcionario_edl a
				LEFT JOIN competencias_edl b
				ON a.id_competencias_edl = b.id_competencias_edl
				LEFT JOIN niveles_desarrollo_edl c
				ON a.id_niveles_desarrollo_edl = c.id_niveles_desarrollo_edl
                WHERE a.id_eval_funcionario_edl = '$id_eval_funcionario_edl'  
				AND a.estado_competencia_funcionario_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion);
			  while ($row62 = mysql_fetch_assoc($select62)) {

$idcompetencia= $row62['id_competencia_funcionario_edl']; 
				  
echo '<b title="'.$idcompetencia.'">'.$row62['nombre_competencias_edl'].'</b>: <i>'.$row62['definicion_edl'].'</i>, '.$row62['conducta_asociada'].' <br> '; 




$query235 = "SELECT * FROM nota_eval_edl, funcionario WHERE nota_eval_edl.id_funcionario=funcionario.id_funcionario 
and estado_nota_eval_edl = 1 and tipo_c=2 and  id_competencia_funcionario_edl=".$idcompetencia." order by id_nota_eval_edl";
$result235 = mysql_query($query235);	 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){

while ($row235 = @mysql_fetch_assoc($result235)){
	
	$idnotac=$row235['id_nota_eval_edl'];
	
                echo '<span title="'.$row235['id_nota_eval_edl'].' - '.$row235['fecha_nota_eval_edl'].'" style="color:#B40404">'.$row235['nombre_funcionario'].': <b>';
				echo $row235['nota_competencia'].'</b></span> ';
				
				if (isset($row235['estado_nota']) &&  1==$row235['estado_nota']) { 
				
				if (1==$row235['estado_nota']) {
					echo '<span class="fa fa-check"  style="color:#008d4c;">Aprobado</span> '; 
				} else {
					echo '<span class="fa fa-close" style="color:#b40404;">Rechazado</span> '; 
				} 
				}  else {

if ($_SESSION['snr']==$id_funcionario_jefe_area) {
echo '<select name="aprobarcompromiso-'.$idnotac.'" class="form-control" style="width:100px;" required>
				<option></option><option value="1">Aprobar</option><option value="0">Rechazar</option>'; 
				echo '</select>'; 
} else { echo '<span style="color:#aaa;">Pendiente de aprobar</span>'; }
					}
                echo '<br>'; 
             } 
	 		 
 } else {
?>							
<select class="form-control" name="nota_competencia_funcionario_edl-<?php echo $idcompetencia; ?>" style="width:100px;" required>
<option value="" selected></option>
<option value="Muy alto">Muy alto</option>
<option value="Alto">Alto</option>
<option value="Aceptable">Aceptable</option>
<option value="Bajo">Bajo</option>
</select>

<?php


	 }   
 mysql_free_result($result235);
 
 

 }

mysql_free_result($select62);

		  ?> 
		  

</div>





<?php if (0<$totalff) { ?>
<div class="modal-footer">
<span style="color:#ff0000;">* Obligatorio</span>
<input type="hidden" name="evaparcial">
<button type="reset" class="btn btn-default">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success desaparecerboton">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>
<?php } else {} ?>


	
	
  </form>
</div>
</div> 
</div> 
</div> 

 



<div class="modal fade" id="popupparcial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Evaluaciones parciales</b></h4>
</div> 
<div  class="modal-body"> 
	
	<form action="" method="POST">
	
 <div class="form-group text-left"> 
	     <label  class="control-label"><span style="color:#ff0000;">*</span>
Tipo de evaluación</label> <br>
<select name="tipo_evaluacion"  required> 
<option value="" selected></option>
<option value="Evaluación parcial eventual">Evaluación parcial eventual</option>
<!--<option value="Calificación definitiva">Calificación definitiva</option>-->
<option value="Calificación extraordinaria">Calificación extraordinaria</option>
</select>

    </div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>
Seleccione motivo en caso de evaluación parcial o extraordinaria</label> <br>
<select name="motivo" value=""> 
<option selected></option>
<option>Cambio de evaluador</option>
<option>Lapso entre la última evaluación y el final del periodo</option>
<option>Por perido de prueba en otro empleo</option>
<option>Separación temporal del empleo por más de 30 días calendario</option>
<option>Cambio de empleo por traslado o reubicación</option>
</select>
</div>


<div class="form-group text-left"> 

<label  class="control-label"><span style="color:#ff0000;">*</span>
Fecha inicial:</label> 
<input type="text" class="datepicker" readonly name="fecha_inicial" value="" > 
<br>

<br>
<label  class="control-label"><span style="color:#ff0000;">*</span>
Fecha final:</label> 
<input  type="text" class="datepicker" readonly  name="fecha_final" value="" > 
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>
Tipo de evaluador</label> <br>
<select name="tipo_evaluador" value=""> 
<option selected></option>
<option>Evaluador</option>
<option>Comisión evaluadora</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>
Evaluador: </label> <br>
<input type="text" class="numero" id="consultacedula" value="" style="width:150px;" 
placeholder="Cédula" required>
<button type="button" class="btn btn-xs btn-warning" id="botonconsultacedula">
<span class="glyphicon glyphicon-search"></span></button>
<div id="resultadoconsultacedula">
</div>

</div>


  <div class="modal-footer">
              <button type="reset" class="btn btn-default " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-ok"></span> Crear</button>
            </div>
			
</form>
</div>
</div> 
</div> 
</div>

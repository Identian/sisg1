<?php
$nump=privilegios(18,$_SESSION['snr']);





if (isset($_SESSION['id_vigilado'])) {
	$id_notarian=$_SESSION['id_vigilado'];
} else {
	

		$id_notarian=0;
	
	
}
	
$numpnota=privilegiosnotariado($id_notarian, 2, $_SESSION['snr']);




 IF ((3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) or  0<$numpnota) { 
 
	$variablenota=" and id_notaria=".$id_notarian."";
	
	
 } else if (1==$_SESSION['rol'] or 0<$nump) {
		 $id_notaria='';
		 $variablenota='';
		 
	 } 
	 
	 else { 
	 $variablenota=' and id_notaria=0';

	 }
	 



 
 
if (isset($_GET['i'])) {
	
	
	
	
	
if ((isset($_POST["identificacion"])) && ($_POST["identificacion"] != "")) { 
	
$identtt= $_POST["identificacion"];
$updateSQL = sprintf("UPDATE ciudadano SET nombre_ciudadano=%s where identificacion=%s  and id_ciudadano!=21373",
GetSQLValueString($_POST["nombre_ciudadano"], "text"), 
GetSQLValueString($identtt, "text"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());
echo $actualizado;
} else { }
	
	
	
	
	
	
	
	$id_sucesion=intval($_GET['i']);
	
	
	 if ((isset($_POST["num_dcto_terminacion"])) && ($_POST["num_dcto_terminacion"] != "")) { 
 
	  if (isset($_POST["reapertura"])) {
	     $reapertura = $_POST["reapertura"];
	  } else {
	     $reapertura = '  ';
     }	 
	
    $updateSQL37 = sprintf("UPDATE sucesion SET num_dcto_terminacion = %s, 
	                   fecha_reg_terminacion = %s, 
                       id_causa_terminacion = %s, id_tipodcto_terminacion = %s,
                       id_estado_sucesion = %s, reapertura = %s					   
					   WHERE id_sucesion = %s",                  
					GetSQLValueString($_POST["num_dcto_terminacion"], "text"),
					GetSQLValueString($_POST["fecha_reg_terminacion"], "date"),
					GetSQLValueString($_POST["id_causa_terminacion"], "int"),
					GetSQLValueString($_POST["id_tipodcto_terminacion"], "int"),
					GetSQLValueString(2, "int"),
					GetSQLValueString($reapertura, "text"),
					GetSQLValueString($id_sucesion, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

    echo $hecho;
 
}


if (isset($_POST["actsucesion"]) && $_POST["actsucesion"] == 'modisucesion'){ 



    $cedula_funcionario = '0';
	
	$query5 = sprintf("SELECT cedula_funcionario 
	              FROM posesion_notaria, funcionario, tipo_nombramiento_n 
                  where id_cargo = 1 
				  and posesion_notaria.id_funcionario = funcionario.id_funcionario 
				  and posesion_notaria.id_tipo_nombramiento_n = tipo_nombramiento_n.id_tipo_nombramiento_n 
				  and id_notaria= '$id_notarian' 
				  and estado_funcionario = 1 
				  and estado_posesion_notaria=1 
				  order by fecha_inicio desc "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){
       $cedula_funcionario = $row5['cedula_funcionario'];
   }
   
   


    $id_sucesion = $_POST["id_sucesion"];
    $updateSQL77 = sprintf("UPDATE sucesion 
	        SET fecha_inicio = %s, numero_acta = %s, 
            fecha_acta = %s, fecha_reg_creacion = %s, num_causantes = %s,
            cc_funcionario_notario = %s			
			WHERE id_sucesion = '$id_sucesion' ",                  
			GetSQLValueString($_POST["fecha_inicio"], "date"),
			GetSQLValueString($_POST["numero_acta"], "int"),
			GetSQLValueString($_POST["fecha_acta"], "date"),
			GetSQLValueString($_POST["fecha_reg_creacion"], "date"),
			GetSQLValueString($_POST["num_causantes"], "int"),
			GetSQLValueString($cedula_funcionario, "text"));
    $Result177 = mysql_query($updateSQL77, $conexion) or die(mysql_error());

    echo $hecho;

} 

	
	
	
$query4 = sprintf("SELECT id_notaria, fecha_inicio, numero_acta, fecha_acta, 
fecha_reg_creacion, cc_funcionario_reg, num_causantes,
id_estado_sucesion, num_dcto_terminacion, fecha_reg_terminacion,
id_causa_terminacion, id_tipodcto_terminacion, cc_funcionario_notario,
reapertura
FROM sucesion 
WHERE id_sucesion=".$id_sucesion." ".$variablenota." and estado_sucesion=1 limit 1"); 
$select4 = mysql_query($query4, $conexion) or die(mysql_error());
$row4 = mysql_fetch_assoc($select4);
$totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
	$id_notaria = $row4['id_notaria'];
    $fecha_inicio = $row4['fecha_inicio'];
	$numero_acta = $row4['numero_acta'];
	$fecha_acta = $row4['fecha_acta'];
	$fecha_reg_creacion = $row4['fecha_reg_creacion'];
	$cc_funcionario_reg = $row4['cc_funcionario_reg'];
	$cc_fun = intval($row4['cc_funcionario_reg']);
	$num_causantes = $row4['num_causantes'];
	$num_dcto_terminacion = $row4['num_dcto_terminacion'];
	$fecha_reg_terminacion = $row4['fecha_reg_terminacion'];
	$id_causa_terminacion = $row4['id_causa_terminacion'];
	$id_tipodcto_terminacion = $row4['id_tipodcto_terminacion'];
	$id_estado_sucesion = $row4['id_estado_sucesion'];
	$cc_funcionario_notario = $row4['cc_funcionario_notario'];
	$reapertura = $row4['reapertura'];
	$des_estado_sucesion = 'ABIERTA';
    if ($id_estado_sucesion == 2){
		$des_estado_sucesion = 'TERMINADA';
	}
	if ($id_estado_sucesion == 3){
		$des_estado_sucesion = 'REPORTADO EN OTRA NOTARIA';
	}

    $nombre_notaria = ' ';
    $id_depto = ' ';
    $codigo_municipio = ' ';

    $query5 = sprintf("SELECT * FROM notaria 
    WHERE id_notaria = '$id_notaria' limit 1"); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
	
    if ($totalRows5 > 0) {
       $nombre_notaria = $row5['nombre_notaria'];
	   $id_depto = $row5['id_departamento'];
	   $codigo_municipio = $row5['codigo_municipio'];
    }

    $nombre_funcionario = ' ';

    $query6 = sprintf("SELECT * FROM funcionario 
    WHERE cedula_funcionario = '$cc_funcionario_reg' limit 1"); 
    $select6 = mysql_query($query6, $conexion) or die(mysql_error());
    $row6 = mysql_fetch_assoc($select6);
    $totalRows6 = mysql_num_rows($select6);
	
    if ($totalRows6 > 0) {
       $nombre_funcionario = $row6['nombre_funcionario'];
    }

    $muni_depto = ' ';

    $query60 = sprintf("SELECT * FROM departamento, municipio 
    WHERE departamento.id_departamento = municipio.id_departamento
	AND   municipio.id_departamento = '$id_depto'
	AND   municipio.codigo_municipio = '$codigo_municipio' limit 1"); 
    $select60 = mysql_query($query60, $conexion) or die(mysql_error());
    $row60 = mysql_fetch_assoc($select60);
    $totalRows60 = mysql_num_rows($select60);
	
    if ($totalRows60 > 0) {
       $nombre_departamento = $row60['nombre_departamento'];
	   $nombre_municipio = $row60['nombre_municipio'];
       $muni_depto = trim($nombre_municipio).' - '.trim($nombre_departamento);
    }



    $funcionario_notario = ' ';

    $query16 = sprintf("SELECT * FROM funcionario 
    WHERE cedula_funcionario = '$cc_funcionario_notario' limit 1"); 
    $select16 = mysql_query($query16, $conexion) or die(mysql_error());
    $row16 = mysql_fetch_assoc($select16);
    $totalRows16 = mysql_num_rows($select16);
	
    if ($totalRows16 > 0) {
       $funcionario_notario = $row16['nombre_funcionario'];
    }

    $des_causa_terminacion = ' ';

    $query61 = sprintf("SELECT * FROM causa_terminacion 
    WHERE id_causa_terminacion = '$id_causa_terminacion' limit 1"); 
    $select61 = mysql_query($query61, $conexion) or die(mysql_error());
    $row61 = mysql_fetch_assoc($select61);
    $totalRows61 = mysql_num_rows($select61);
	
    if ($totalRows61 > 0) {
       $des_causa_terminacion = $row61['des_causa_terminacion'];
    }

    $des_tipodcto_terminacion = ' ';

    $query62 = sprintf("SELECT * FROM tipodcto_terminacion 
    WHERE id_tipodcto_terminacion = '$id_tipodcto_terminacion' limit 1"); 
    $select62 = mysql_query($query62, $conexion) or die(mysql_error());
    $row62 = mysql_fetch_assoc($select62);
    $totalRows62 = mysql_num_rows($select62);
	
    if ($totalRows62 > 0) {
       $des_tipodcto_terminacion = $row62['des_tipodcto_terminacion'];
    }


// mysql_free_result($update);















if ((isset($_POST["insertacta"])) && ($_POST["insertacta"] == "cargueacta")) { // 1

  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');

   if (""!=$_FILES['file']['tmp_name']){ // 2
 
      $tipoArchivo=explode("/",$_FILES["file"]["type"]);
      $ubicacion="filesnr/sucesionessnr/";
	  $NomImagen=$_FILES['file']['name'];
	  $totarchivo=explode(".",$_FILES["file"]["name"]);
	  echo $totarchivo[0];
	 $nombre_img=$id_notaria.'-'.$id_sucesion.'-'.$aleatorio.'.pdf';
	 
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
      $NomImagenR=$ubicacion."/".$nombre_img;
	 
     

      if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 11534336)) { // 3
	    if ($_FILES["file"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file']['tmp_name'],$NomImagenR);
			
//          $nombrebre_orig= ucwords($nombrefile);
//          $hash=md5($files);

            $insertSQL = sprintf("INSERT INTO docto_sucesion (id_sucesion, 
		    id_tipo_docto_sucesion, nombre_docto_sucesion, estado_docto_sucesion, 
		    fecha_registro) 
            VALUES (%s, %s, %s, 1, now())", 
            GetSQLValueString($id_sucesion, "int"), 
            GetSQLValueString($_POST['id_tipo_docto_sucesion'], "int"),
            GetSQLValueString($nombre_img, "text"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
		  
            echo $insertado;
            echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';
        } else { $valido=0; echo  $doc_no_tipo;
	           echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';
			} // fin 4 
      } else { $valido=0; echo $doc_tam;
	         echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';
		} // fin 3
		
		
  } else { 
//      echo $doc_tam;
	  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';
  } // fin 2

} 
?>




  
		
		
<div class="modal fade" id="finsucesion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">CIERRE LIQUIDACI&Oacute;N HERENCIA: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="post" name="form43254351435435224">

    <input type="hidden" class="form-control" name="tot_causantes" id="tot_causantes" readonly="readonly" value="">
    <input type="hidden" class="form-control" name="nactas" id="nactas" readonly="readonly" value="<?php echo $nactas; ?>">

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA INICIO:</label>   
      <input type="text" class="form-control" name="fecha_inicio" readonly="readonly" value="<?php echo $fecha_inicio; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA ACTA:</label>   
      <input type="text" class="form-control" name="fecha_acta" readonly="readonly" value="<?php echo $fecha_acta; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">N&Uacute;MERO ACTA:</label>   
      <input type="number" class="form-control" name="numero_acta"  readonly="readonly" value="<?php echo $numero_acta; ?>">
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">NUM DOCTO TERMINACI&Oacute;N:</label>   
        <input type="text" class="form-control" id="num_dcto_terminacion"  name="num_dcto_terminacion"  value="<?php echo $num_dcto_terminacion; ?>" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA TERMINACI&Oacute;N:</label>   
      <input type="text" class="form-control  datepickerjo" id="fecha_reg_terminacion" name="fecha_reg_terminacion" readonly="readonly" value="<?php echo $fecha_reg_terminacion; ?>"  required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">CAUSANTE DE TERMINACI&Oacute;N:</label><?php echo ' '.$des_causa_terminacion; ?>   
      <select  class="form-control" name="id_causa_terminacion" id="id_causa_terminacion" required>
        <option value="<?php $id_causa_terminacion; ?>" selected></option>
        <?php
         $query = sprintf("SELECT *  
		 FROM causa_terminacion 
		 order by id_causa_terminacion"); 
         $select = mysql_query($query, $conexion) or die(mysql_error());
         $row = mysql_fetch_assoc($select);
         $totalRows = mysql_num_rows($select);
         if (0<$totalRows){
            do {
	            echo '<option value="'.$row['id_causa_terminacion'].'" ';
				
				if ($id_causa_terminacion==$row['id_causa_terminacion']) { echo 'selected';} else {}
				
				echo '>'.$row['des_causa_terminacion'].'</option>';
	        } while ($row = mysql_fetch_assoc($select)); 
         } else {}	 
         mysql_free_result($select);
         ?>
      </select>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">TIPO DOCTO DE TERMINACI&Oacute;N:</label><?php echo ' '.$des_tipodcto_terminacion; ?>   
      <select  class="form-control" name="id_tipodcto_terminacion" id="id_tipodcto_terminacion" required>
        <option value="<?php $id_tipodcto_terminacion; ?>" selected></option>
        <?php
         $query = sprintf("SELECT *  
		 FROM tipodcto_terminacion 
		 order by id_tipodcto_terminacion"); 
         $select = mysql_query($query, $conexion) or die(mysql_error());
         $row = mysql_fetch_assoc($select);
         $totalRows = mysql_num_rows($select);
         if (0<$totalRows){
            do {
	            echo '<option value="'.$row['id_tipodcto_terminacion'].'" ';
				if ($id_tipodcto_terminacion==$row['id_tipodcto_terminacion']) { echo 'selected';} else {}
				
				echo '>'.$row['des_tipodcto_terminacion'].'</option>';
	        } while ($row = mysql_fetch_assoc($select)); 
         } else {}	 
         mysql_free_result($select);
         ?>
      </select>
    </div>
    
    <?php if ($id_estado_sucesion == 2){ ?>
    <div class="form-group text-left"> 
        <label  class="control-label">DATOS DE REAPERTURA:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="reapertura"  name="reapertura"  value="<?php echo $reapertura; ?>"><?php echo $reapertura; ?></textarea>
    </div>
	<?php } ?>


    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="termsucesion" value="cierresu">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>








<div class="modal fade" id="editcausante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Modificación de causante: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="post" name="fodf45dwf435435224">

  <div id="ver_causante">
  
  
  </div>
  
  

    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="termsucesion" value="cierresu">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>






<?php
 IF ((3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) or 0<$numpnota) { 
	$id=$_SESSION['id_vigilado'];
?>
<div class="row">
  <div class="col-md-12">
    <nav class="navbar navbar-default" style="background:#fff;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		</div>
 <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			
			 <li><a href="notaria&<?php echo $id; ?>.jsp"><b>NOTARIA 	 
     <?php echo quees('notaria', $id);?>
		  </b></a></li>
		  

              <li><a href="sucesion.jsp">Liq. Herencia</a></li>
          
			 
			   <?php if ($_SESSION['snr_tipo_oficina'] == 3 && 1==$_SESSION['snr_grupo_cargo']) { ?> 
			  <li><a href="privilegios_notariado.jsp">Acceso a módulos</a></li>
             <?php } else {} ?>
			 
            </ul>
          </div>
		 
      </div>
    </nav>
  </div>
</div>
	  <?php } else {}  ?>
	  
	  
	  
		

<div class="row">
    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <div class="row-md-6 text-left">
               <h3 class="box-title"><b>LIQUIDACI&Oacute;N HERENCIA</b></h3> &nbsp; &nbsp; 
			   
	<?php if((3==$_SESSION['rol'] && 3 == $_SESSION['snr_tipo_oficina']) or 1==$_SESSION['rol'])   { ?>
  		   <a id="" class="ventana1" data-toggle="modal" data-target="#modificasucesion" href="" title="Modificar Sucesi&oacute;n"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></a>
	<?php } else {} ?>
             </div>
             <input type="hidden" class="form-control" name="tot_causantes" id="tot_causantes" readonly="readonly" value="">

			 <div class="row-md-6 text-right">
			    <?php if(1==$_SESSION['rol'] or (3==$_SESSION['rol'] && 3 == $_SESSION['snr_tipo_oficina'])){ 
            	 
				 
$query5 = sprintf("SELECT count(id_sucesion) as cuentasuce  FROM causante  WHERE id_sucesion = ".$id_sucesion." AND estado_causante = 1"); 
$select5 = mysql_query($query5, $conexion);
$row5 = mysql_fetch_assoc($select5);
$totalRows5 = $row5['cuentasuce'];
 mysql_free_result($select5);
 
 
$query5N = sprintf("SELECT count(id_sucesion) as cuentasuce2  FROM docto_sucesion  WHERE id_sucesion = ".$id_sucesion." AND estado_docto_sucesion= 1"); 
$select5N = mysql_query($query5N, $conexion);
$row5N= mysql_fetch_assoc($select5N);
$totalRows5N = $row5N['cuentasuce2'];
 mysql_free_result($select5N);

//echo $num_causantes.'-'.$totalRows5.'-'.$totalRows5N.'-'.$id_estado_sucesion;

 if ($num_causantes <= $totalRows5 && 0<$totalRows5N) {

     if (1==$id_estado_sucesion) { ?>
			  <a id="" class="ventana1" data-toggle="modal" data-target="#finsucesion" href="" title="Finalizar"> <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Cerrar Liq. Herencia</button></a>
 <?php }  ?>
				 
 <?php if (2==$id_estado_sucesion) {	?>			 
			      <a id="" class="ventana1" data-toggle="modal" data-target="#finsucesion" href="" title="Finalizar"> <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Reapertura Liq. Herencia</button></a>
			 
 <?php  } ?>
 <?php  if (3==$id_estado_sucesion) {			 
                    // 'REPORTADO EN OTRA NOTARIA';
					echo ' ';
  
  } 
  
  } else {
      echo 'Debe agregar causantes y acta de inicio para poder cerrar la liq. de herencia.';
  } 
  } ?> 
			 </div>
			 
			 <!-- Modal -->


			 <hr>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group text-left"> 
                       <label  class="control-label">CIUDAD NOTARIA:</label>   
                       <?php echo $muni_depto ?>
                  </div>
                  <div class="form-group text-left"> 
                       <label  class="control-label">NOTARIA:</label>   
                       <?php echo $nombre_notaria ?>
                  </div>
                  <div class="form-group text-left"> 
                       <label  class="control-label">NOTARIO:</label>   
                       <?php echo $funcionario_notario ?>
                  </div>
                  <div class="form-group text-left"> 
                       <label  class="control-label">FECHA DE INICIO:</label>   
                       <?php echo $fecha_inicio ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">N&Uacute;MERO ACTA:</label>   
                        <?php echo $numero_acta; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA ACTA:</label>   
                        <?php echo $fecha_acta; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA CREACI&Oacute;N:</label>   
                        <?php echo $fecha_reg_creacion; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FUNCIONARIO QUE REPORTA:</label>   
                        <?php echo $nombre_funcionario; ?>
                  </div>

				</div>  
                <div class="col-md-6">
                  <div class="form-group text-left"> 
                       <label  class="control-label">N&Uacute;MERO DE CAUSANTES:</label>   
                       <?php echo $num_causantes; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA TERMINACI&Oacute;N:</label>   
                        <?php echo $fecha_reg_terminacion; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">NUM DOCTO TERMINACI&Oacute;N:</label>   
                        <?php echo $num_dcto_terminacion; ?>
                  </div>
                  <div class="form-group text-left"> 
                       <label  class="control-label">CAUSA TERMINACI&Oacute;N:</label>   
                       <?php echo $des_causa_terminacion; ?>
                  </div>
                  <div class="form-group text-left"> 
                       <label  class="control-label">TIPO DOCTO TERMINACI&Oacute;N:</label>   
                       <?php echo $des_tipodcto_terminacion; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">ESTADO LIQ. HERENCIA:</label>   
                        <span style= 'color: red;'><?php echo $des_estado_sucesion; ?></span>
                  </div>
				  
                  <div class="form-group text-left"> 
				  <?php if ($id_estado_sucesion == 3){ ?>
                        <label  class="control-label">OBSERVACIÓN:</label>   
				  <?php } else { ?>
				        <label  class="control-label">REAPERTURA:</label>   
				  <?php } ?>		
                        <textarea type="text"  rows="4" cols="20" class="form-control" id="reapertura"  name="reapertura"  readonly="readonly" ><?php echo $reapertura; ?></textarea>
                  </div>
               </div>
                </div>
  </div>
  
			 
                  
             </div>
          </div> 
 </div>
 
      
           
            
   
	
		
		
		
		
		
			
		<div class="row">
			<div class="col-md-6">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					   
					      <?php if((3==$_SESSION['rol'] && 3 == $_SESSION['snr_tipo_oficina']) or 1==$_SESSION['rol']){ ?>
						  
            		     <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#creacausante"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo causante </a>
                        
						  
					   <?php } else { echo 'Causante ';}?>
					   
					   </h4> 
               
  
            <div class="box-body">
              <div class="table-responsive">
               <table class="table">
                <thead>
                <tr>
              
                  <th>Num Acta</th>
                  <th>Fecha Acta</th>
                  <th>Tipo Docto</th>
                  <th>Num Documento</th>
                  <th>Nombre Causante</th>
                 <th>Accion</th>
                </tr>
                </thead>
            <tbody>
            <?php
			


               $query62 = sprintf("SELECT distinct(identificacion), id_causante, 
			    id_sucesion, num_dcto_causante, causante.id_tipo_documento,
                nombre_tipo_documento, nombre_ciudadano
	            FROM causante, ciudadano, tipo_documento 
	            WHERE id_sucesion = ".$id_sucesion." 
	            AND causante.estado_causante = 1 
				AND causante.id_tipo_documento = ciudadano.id_tipo_documento
				AND causante.num_dcto_causante = ciudadano.identificacion
				AND estado_ciudadano = 1 
				AND causante.id_tipo_documento = tipo_documento.id_tipo_documento
				AND estado_tipo_documento = 1
				limit 15"); 
                $select62 = mysql_query($query62, $conexion);
			  while ($row62 = mysql_fetch_assoc($select62)) {	  
            ?>
          <tr>
             <?php $idsucesion=$row62['id_sucesion'];?>
             <td><?php echo $numero_acta;?></td>
             <td><?php echo $fecha_acta;?></td>
           <?php $idcausante=$row62['id_causante'];?>
		   <td><?php echo $row62['nombre_tipo_documento'];?></td>
             <td><?php echo $row62['num_dcto_causante'];?></td>
             <td><?php echo $row62['nombre_ciudadano'];?></td>
             <td>

 <?php 

 if((3==$_SESSION['rol'] && 3 == $_SESSION['snr_tipo_oficina']) or 1==$_SESSION['rol'] or 0<$nump ){ 
			if (1==2) { 
				echo ' <a style="color:#ff0000;cursor: pointer" class="edit_causante" data-toggle="modal" data-target="#editcausante" id="'.$row62['id_causante'].'"><span class="glyphicon glyphicon-edit"></span></a> &nbsp; '; 
				} else {}
			
				echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="causante" id="'.$row62['id_causante'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>'; 
			
				
				
				} else {} 
				
			
				?>
             </td>
          </tr>

      <?php } ?> 

          
            </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->



		
			<div class="col-md-6">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					   
					        <?php if((3==$_SESSION['rol'] && 3 == $_SESSION['snr_tipo_oficina']) or 1==$_SESSION['rol']){ ?>
							
							
            		     <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#cargueactas"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Acta</a>

                  
					   
					     <?php } else { echo 'ACTAS DE LIQUIDACI&Oacute;N HERENCIA';}?>
					   
					   </h4> 
           
  
               <div class="box-body">
               <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
                <thead>
                <tr>
                
                  <th>Num Acta</th>
                  <th>Fecha Acta</th>
                  <th>Tipo de Acta</th>
                  <th>Archivo</th>
                 <th>Accion</th>
                </tr>
                </thead>
            <tbody>
            <?php
			
			
               $query62 = sprintf("SELECT id_docto_sucesion, id_tipo_docto_sucesion,
			    nombre_docto_sucesion, numero_acta, fecha_acta
	            FROM docto_sucesion, sucesion 
                WHERE docto_sucesion.id_sucesion = sucesion.id_sucesion 
				AND docto_sucesion.id_sucesion = '$id_sucesion'
	            AND estado_docto_sucesion = 1"); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
                $id_tipo_docto_sucesion = $row62['id_tipo_docto_sucesion'];
				$tipo_docto = 'ACTA INICIO';
                if($id_tipo_docto_sucesion == 2){
                   $tipo_docto = 'ACTA TERMINACI&Oacute;N';
                }				
            ?>
          <tr>
      
             <td><?php echo $row62['numero_acta'];?></td>
             <td><?php echo $row62['fecha_acta'];?></td>
             <td><?php echo $tipo_docto;?></td>
             <td><?php echo $row62['nombre_docto_sucesion'];?></td>

		     <?php if('' != $row62['nombre_docto_sucesion']){ ?> 
		     <td> 
			    <a href="filesnr/sucesionessnr/<?php echo $row62['nombre_docto_sucesion']; ?>" target = '_blank' >
		       <img src="images/pdf.png"></a>
				
				<a style="color:#ff0000;cursor: pointer" title="Borrar" name="docto_sucesion" id="<?php echo $row62['id_docto_sucesion']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
			
				
	         </td>
		     <?php } else { echo ""; } ?>
          </tr>
		  <?php } ?>
		  
          </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->

</div>

 <!-- ************************
     consulta de Actas 
     ************************ -->
        




<!-- ************************
     modificacion de Sucesion 
     ************************ -->

<div class="modal fade" id="modificasucesion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel">MODICACI&Oacute;N LIQUIDACI&Oacute;N HERENCIA: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
  <form action="" method="POST" name="form55">
    <input type="hidden" class="form-control" id="id_sucesion" name="id_sucesion" value="<?php echo $id_sucesion; ?>">
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE INICIO:</label>   
        <input type="text" required class="form-control datepickerjo" id="fecha_inicio" name="fecha_inicio" readonly="readonly"  value="<?php echo $fecha_inicio; ?>" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> N&Uacute;MERO ACTA:</label>   
        <input type="text" required class="form-control numero" id="numero_acta" maxlength="5" name="numero_acta" value="<?php echo $numero_acta; ?>" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> FECHA ACTA:</label>   
        <input type="text" required class="form-control datepickerjo" name="fecha_acta"  readonly="readonly" value="<?php echo $fecha_acta; ?>" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> FECHA CREACI&Oacute;N:</label>   
        <input type="text" required class="form-control datepickerjo" id="fecha_reg_creacion" name="fecha_reg_creacion" readonly="readonly" value="<?php echo $fecha_reg_creacion; ?>" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> N&Uacute;MERO DE CAUSANTES:</label>   
        <input type="text" required class="form-control numero" id="num_causantes" name="num_causantes" maxlength="5" value="<?php echo $num_causantes; ?>" required >
    </div>

    <div class="modal-footer">
       <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
       <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
       <button type="submit" class="btn btn-success"><input type="hidden" id="actsucesion" name="actsucesion" value="modisucesion">
       <span class="glyphicon glyphicon-ok"></span>Guardar</button>
    </div>
  </form>
</div>
</div> 
</div> 
</div> 

<?php 
}

// mysql_free_result($update);

?>


<!-- ************************
     Carge de Actas 
     ************************ -->

<div class="modal fade" id="cargueactas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel">CARGUE DE ACTAS: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
  <form action="" method="POST" name="form43534543555" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_sucesion" name="id_sucesion" value="<?php echo $id_sucesion; ?>">
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE INICIO:</label>   
        <input type="text" required class="form-control" id="fecha_inicio" name="fecha_inicio" readonly="readonly"  value="<?php echo $fecha_inicio; ?>" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> N&Uacute;MERO ACTA:</label>   
        <input type="number" required class="form-control" id="numero_acta"  name="numero_acta" readonly="readonly" value="<?php echo $numero_acta; ?>" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> FECHA ACTA:</label>   
        <input type="text" required class="form-control" name="fecha_acta"  readonly="readonly" value="<?php echo $fecha_acta; ?>" required >
    </div>

    <div class="form-group text-left"> 
       <label  class="control-label"><span style="color:#ff0000;">*</span> ADJUNTAR ACTAS:</label> 
       <input type="file" value=""  name="file" required>
       <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
    </div>

    <div class="form-group text-left"> 
	   <label  class="control-label">TIPO DE ACTA:</label> 
       <select class="form-control" id="id_tipo_docto_sucesion" name="id_tipo_docto_sucesion" required >
	   <option value="" selected></option>
       <option value="1">Acta de Inicio</option>
       <option value="2">Acta de Terminaci&oacute;n</option>
       </select>
    </div>
    <div class="form-group text-left">
	   <button type="submit" class="btn btn-success">
       <input type="hidden" name="insertacta" value="cargueacta"><span class="glyphicon glyphicon-ok"></span> Agregar </button>
    </div>
  </form>
</div>
</div> 
</div> 
</div> 










<div class="modal fade" id="creacausante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">NUEVO CAUSANTE <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form122">
    <input type="hidden" id="id_sucesion" name="id_sucesion" value="<?php echo $id_sucesion; ?>">
<!--    <input type="hidden" class="form-control" name="id_notaria" id="id_notaria" readonly="readonly" value="<?php echo $id_notaria; ?>"> -->
	<input type="hidden" class="form-control" name="id_sucesion" id="id_sucesion" readonly="readonly" value="<?php echo $id_sucesion; ?>">
    <div class="form-group text-left"> 
      <label  class="control-label">FECHA INICIO:</label>   
      <input type="text" class="form-control" name="fecha_inicio" readonly="readonly" value="<?php echo $fecha_inicio; ?>">
    </div>
    <div class="form-group text-left"> 
      <label  class="control-label">N&Uacute;MERO ACTA:</label>   
      <input type="number" class="form-control" name="numero_acta"  readonly="readonly" value="<?php echo $numero_acta; ?>">
    </div>
    <div class="form-group text-left"> 
      <label  class="control-label">FECHA ACTA:</label>   
      <input type="text" class="form-control" name="fecha_acta" readonly="readonly" value="<?php echo $fecha_acta; ?>">
    </div>
    <div class="form-group text-left"> 
      <label  class="control-label">NÚMERO DCTO CAUSANTE:</label>   
      <input type="text" class="form-control" name="num_dcto_causante"  id="num_dcto_causante" value="" required >
    </div>
 <div class="form-group text-left"> 
      <label  class="control-label">TIPO DE DCTO CAUSANTE:</label>   
      <select  class="form-control" name="id_tipo_documento" required>
        <option value="-- TIPO DOCTO --" selected></option>
        <?php
         $query = sprintf("SELECT id_tipo_documento, nombre_tipo_documento 
		                           FROM tipo_documento 
								   WHERE estado_tipo_documento = 1 
								   order by id_tipo_documento"); 
         $select = mysql_query($query, $conexion);
         $row = mysql_fetch_assoc($select);
         $totalRows = mysql_num_rows($select);
         if (0<$totalRows){
            do {
	            echo '<option value="'.$row['id_tipo_documento'].'">'.$row['nombre_tipo_documento'].'</option>';
	        } while ($row = mysql_fetch_assoc($select)); 
         } else {}	 
         mysql_free_result($select);
         ?>
      </select>
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">NOMBRE CAUSANTE:</label>   
        <input type="text" class="form-control" id="nombre_causante"  name="nombre_causante" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">TEL&Eacute;FONO CAUSANTE:</label>   
        <input type="text" class="form-control" id="tel_causante"  name="tel_causante" value="" required >
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">DIRECCI&Oacute;N CAUSANTE:</label>   
        <input type="text" class="form-control" id="dir_causante"  name="dir_causante" value="" required >
    </div>

    <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="archcausante" value="notaria">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div> 

<?php

// aqui
if (isset($_POST['archcausante'])){

	$id_funcionario = $_SESSION['snr'];
	$num_dcto_causante = $_POST['num_dcto_causante'];
$id_tipo_documento= $_POST['id_tipo_documento'];


	$clave_ciudadano = md5(12345);

    $id_depto = 0;
	$id_municipio = 0;
	$sin_correo = 'sin correo...';

	$query2 = sprintf("SELECT *
	FROM sucesion 
	WHERE id_sucesion = ".$id_sucesion." 
	AND estado_sucesion = 1 limit 1 "); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);
    $totalRows2 = mysql_num_rows($select2);
    if ($totalRows2 > 0){
      $id_notaria = $row2['id_notaria'];
    }	

	$query4 = sprintf("SELECT *
	FROM notaria 
	WHERE id_notaria = $id_notaria 
	AND estado_notaria = 1 limit 1"); 
    $select4 = mysql_query($query4, $conexion);
    $row4 = mysql_fetch_assoc($select4);
    $totalRows4 = mysql_num_rows($select4);
    if ($totalRows4 > 0){
      $id_depto = $row4['id_departamento'];
	  $id_municipio = $row4['codigo_municipio'];
    }	


$query5 = sprintf("SELECT * 
	FROM ciudadano 
	WHERE id_tipo_documento = ".$id_tipo_documento."  
	AND identificacion = '$num_dcto_causante' 
	AND estado_ciudadano = 1 limit 1"); 
    $select5 = mysql_query($query5, $conexion) ;
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
	
	


    if ($totalRows5 < 1){

        $insertSQL5 = sprintf("INSERT INTO ciudadano (
        nombre_ciudadano, id_tipo_documento, 
		identificacion, idcorreocontactoiris, id_etnia, 
		correo_ciudadano, clave_ciudadano, telefono_ciudadano, 
		id_departamento, id_municipio, id_tipo_respuesta, 
		direccion_ciudadano, fecha_registro, estado_ciudadano,
		fuente, cfuncionario) 
		VALUES (%s,%s,%s,null,6,%s,%s,%s,%s,%s,4,%s,now(),1,0,0)", 
      GetSQLValueString($_POST["nombre_causante"], "text"), 
      GetSQLValueString($_POST["id_tipo_documento"], "int"),  
      GetSQLValueString($_POST["num_dcto_causante"], "text"),
	  GetSQLValueString($sin_correo, "text"),
	  GetSQLValueString($clave_ciudadano, "text"),
	  GetSQLValueString($_POST["tel_causante"], "text"),
	  GetSQLValueString($id_depto, "text"),
	  GetSQLValueString($id_municipio, "text"),
	  GetSQLValueString($_POST["dir_causante"], "text")); 
      $Result = mysql_query($insertSQL5, $conexion);
	
}

  
	    $id_sucesion = $_POST["id_sucesion"];
      $query5 = sprintf("SELECT *
	   FROM causante 
	   WHERE id_tipo_documento = $id_tipo_documento
	   AND  num_dcto_causante = '$num_dcto_causante' 
	   AND   id_sucesion = '$id_sucesion'
	   AND   estado_causante = 1 limit 1"); 
      $select5 = mysql_query($query5, $conexion) or die(mysql_error());
      $row5 = mysql_fetch_assoc($select5);
      $totalRows5 = mysql_num_rows($select5);
	  
	  
      if ($id_sucesion > 0 && $totalRows5 > 0){ 
	  
	     echo $repetido; 

         echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';

      } else {

	 $insertSQL = sprintf("INSERT INTO causante (
        id_sucesion, id_tipo_documento, num_dcto_causante, 
		estado_causante, fecha_registro) 
		VALUES (%s,%s, %s, 1,now())", 
      GetSQLValueString($id_sucesion, "int"), 
	  GetSQLValueString($_POST["id_tipo_documento"], "int"),
      GetSQLValueString($_POST["num_dcto_causante"], "text")); 
      $Result = mysql_query($insertSQL, $conexion);

	  echo $hecho;
    }  
	
// desde

      $id_sucesiondoble = 0;


	  
	   $query7 = sprintf("SELECT IFNULL(max(causante.id_sucesion),0) mid_sucesion
	   FROM causante, sucesion 
	   WHERE num_dcto_causante = '$num_dcto_causante' 
	   AND id_tipo_documento = $id_tipo_documento 
       AND causante.id_sucesion = sucesion.id_sucesion
	   AND sucesion.id_notaria != $id_notaria
	   AND   estado_causante = 1 
	   and sucesion.id_causa_terminacion = 3 limit 5 "); 
      $select7 = mysql_query($query7, $conexion);
      $row7 = mysql_fetch_assoc($select7);
      $totalRows7 = mysql_num_rows($select7);
	    $id_sucesiondoble = $row7['mid_sucesion'];
	  
	  
      if ($id_sucesiondoble > 0){
         
         $id_notariadoble = 0;
         $nombre_notaria = ' ';
         $id_departamento = 0;
         $codigo_municipio = 0;
  
         $query21 = sprintf("SELECT * 
	      FROM sucesion 
	      WHERE id_sucesion = $id_sucesiondoble    
	      AND   estado_sucesion = 1 limit 1"); 
         $select21 = mysql_query($query21, $conexion) or die(mysql_error());
         $row21 = mysql_fetch_assoc($select21);
         $totalRows21 = mysql_num_rows($select21);
         if ($totalRows21 > 0){
            $id_notariadoble = $row21['id_notaria'];
         }


         $query27 = sprintf("SELECT *
	      FROM notaria 
	      WHERE id_notaria = $id_notariadoble 
	      AND   estado_notaria = 1 limit 1"); 
         $select27 = mysql_query($query27, $conexion) or die(mysql_error());
         $row27 = mysql_fetch_assoc($select27);
         $totalRows27 = mysql_num_rows($select27);
         if ($totalRows27 > 0){
            $nombre_notaria = $row27['nombre_notaria'];
            $id_depto = $row27['id_departamento'];
            $codigo_municipio = $row27['codigo_municipio'];
         }

         $muni_depto = ' ';

         $query60 = sprintf("SELECT * FROM departamento, municipio 
          WHERE departamento.id_departamento = municipio.id_departamento
	      AND   municipio.id_departamento = '$id_depto'
	      AND   municipio.codigo_municipio = '$codigo_municipio' limit 1"); 
         $select60 = mysql_query($query60, $conexion) or die(mysql_error());
         $row60 = mysql_fetch_assoc($select60);
         $totalRows60 = mysql_num_rows($select60);
	
         if ($totalRows60 > 0) {
            $nombre_departamento = $row60['nombre_departamento'];
	        $nombre_municipio = $row60['nombre_municipio'];
            $muni_depto = trim($nombre_municipio).' - '.trim($nombre_departamento);
         }

         $reapertura = "CAUSANTE REPORTADO EN LA NOTARIA: ".$nombre_notaria." * DE LA CIUDAD: ".$muni_depto;


         // echo $causante_doble; 
  
         $id_estado_sucesion = 3; // Causante reportado en otra Notaria 

         $updateSQL37 = sprintf("UPDATE sucesion SET id_estado_sucesion = %s, 
	                   reapertura = %s
					   WHERE id_sucesion = %s",                  
					GetSQLValueString($id_estado_sucesion, "int"),
					GetSQLValueString($reapertura, "text"),
					GetSQLValueString($id_sucesion, "int"));
         $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
		 echo $causante_doble;
		 
	     echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';
     }


else { 
	 
	     $id_estado_sucesion = 1; 
         $reapertura = ' ';
         $updateSQL37 = sprintf("UPDATE sucesion SET id_estado_sucesion = %s, 
	                   reapertura = %s
					   WHERE id_sucesion = %s",                  
					GetSQLValueString($id_estado_sucesion, "int"),
					GetSQLValueString($reapertura, "text"),
					GetSQLValueString($id_sucesion, "int"));
         $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
	 }	 




	 
// hasta	
	 echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';
}	  
    
	  

// mysql_free_result($Result);	




} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }

	


?>

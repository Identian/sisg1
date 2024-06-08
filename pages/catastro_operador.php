<?php

$nump147=privilegios(147,$_SESSION['snr']);
// $nump147 = 100;


$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;


if (1==$_SESSION['rol'] or 0<$nump147) {

   if (isset($_GET['i'])) { 
	
	$id_gestor_catastral = intval($_GET['i']); 
	$id_funcionario = $_SESSION['snr'];
	  
	$query5 = sprintf("SELECT * FROM funcionario
                  where id_funcionario = '$id_funcionario' 
				  and estado_funcionario = 1 "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){
       $id_cargo = $row5['id_cargo'];
	   $id_tipo_oficina = $row5['id_tipo_oficina'];
	   $id_grupo_area = $row5['id_grupo_area'];
	   $id_oficina_registro = $row5['id_oficina_registro'];
	   
//	   echo "id func: ".$id_funcionario."  -  ";
//	   echo "tipo of: ".$id_tipo_oficina."  -  ";
//	   echo "grupo_area: ".$id_grupo_area."  -  ";
//	   echo "oficina_registro: ".$id_tipo_oficina;
	   
   }
}	  
} else { 
     echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 

$privi = " AND a.id_funcionario = '$id_funcionario' ";

  if ($_SESSION['rol'] == 1){ // superadmon 
    $privi = " ";
	} else {
    $id= 0;
}

if (isset($_GET["e"]) && ""!=$_GET["e"]) {
    $id_operador_catastral=intval($_GET["e"]);

	$query84 = "UPDATE operador_catastral SET estado_operador_catastral = 0  WHERE id_operador_catastral = ".$id_operador_catastral." limit 1";  
//   $query86 = "UPDATE contratos_gestor SET estado_contratos_gestor = 0  WHERE id_gestor_catastral = ".$id_gestor_catastral." limit 50";  
 
   $Result1 = mysql_query($query84, $conexion);

//   $Result12 = mysql_query($query86, $conexion);
 
   echo $actualizado;

 } else {
  
 }

 include('tablero_gestor.php');
 
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
		 
		  <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			    <li><a href="catastro_gestor.jsp"><b> MÓDULO DE OPERADORES CATASTRALES</b></a></li>
            </ul>
          </div>
		
        </div>
      </div>
    </nav>
  </div>
</div>

	  
	  
	  
<div class="row">
<div class="col-md-12">

 <div class="box box-info">
  <div class="box-header with-border">
  
      <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>       <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Operador</button>&nbsp;
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
	  <?php } ?>
    </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  <th>Id Operador</th>
                  <th>Nombre</th>
				  <th>Natu-juridica</th>
				  <th>Representante Legal</th>
				  <th>Correo Electrónico</th>
                 <th colspan="4">Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT a.id_operador_catastral, o.cod_operador_catastral,
			                                 o.nombre_operador_catastral, o.id_natu_juridica_operador, 
											 d.nombre_natu_juridica_operador, o.nit_operador, 
											 o.repre_legal, o.dir_operador, o.tel_operador, o.correo_operador 
			                        FROM operador_xgestor a
											LEFT JOIN operador_catastral o
											ON a.id_operador_catastral = o.id_operador_catastral
											LEFT JOIN natu_juridica_operador d
											ON o.id_natu_juridica_operador = d.id_natu_juridica_operador
                          WHERE a.estado_operador_xgestor = 1 AND a.id_gestor_catastral = ".$id_gestor_catastral.
						  " ORDER BY a.id_operador_catastral ");
						  
						  
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {
				  
            ?>
          <tr>
		     <?php 
			 $id_operador_catastral = $row_dian['id_operador_catastral'];
		     $cod_operador_catastral = $row_dian['cod_operador_catastral'];
             $nombre_operador_catastral = $row_dian['nombre_operador_catastral'];
			 $id_natu_juridica_operador = $row_dian['id_natu_juridica_operador'];
			 $nombre_natu_juridica_operador = $row_dian['nombre_natu_juridica_operador'];
			 $nit_operador = $row_dian['nit_operador'];
			 $repre_legal = $row_dian['repre_legal'];
			 $dir_operador = $row_dian['dir_operador'];
			 $tel_operador = $row_dian['tel_operador'];
			 $correo_operador = $row_dian['correo_operador'];
			 
			$sw5 = 0;
			
	         ?>
             <td><?php echo $id_operador_catastral; ?></td>
			 <td><?php echo $nombre_operador_catastral; ?></td>
             <td><?php echo $nombre_natu_juridica_operador; ?></td>
             <td><?php echo $repre_legal; ?></td>
             <td><?php echo $correo_operador; ?></td>
             <td>
                <a href="consulta_operador&<?php echo $id_operador_catastral; ?>.jsp"><span class="btn btn-info btn-xs" title="Consultar"><span  class="glyphicon glyphicon-hand-up"></span></a> &nbsp;
             </td>
             <td>
			    <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
                <a href="catastro_operador&<?php echo $id_funcionario; ?>&<?php echo $id_operador_catastral; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar"  ><span class="glyphicon glyphicon-trash"></span></a>
				<?php } ?>
             </td>
			<?php } ?>
          </tr>
         
         
          <script>

              $(document).ready(function() {
            $('#tab_sucesiones').DataTable({
              "lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              }
            });
          });

          </script>
            </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->


<!-- Modal myModal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>NUEVO OPERADOR</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                   <form action="" method="POST" name="form1" enctype="multipart/form-data">
				        <input type="hidden" name="id_funcionario" id="id_funcionario"   value="<?php echo $id_funcionario; ?>" >
				        <input type="hidden" name="id_gestor_catastral" id="id_gestor_catastral"   value="<?php echo $id_gestor_catastral; ?>" >
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Operador:</label> 
                              <select class="form-control" name="id_operador_catastral" id="id_operador_catastral" onChange ="valopera();">
                              <option value="" selected></option>
                              <?php echo operadores('operador_catastral'); ?>
                              </select>
                         </div>
						 
                         <div class="form-group text-left" id ="cod_operador" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Código Operador:</label>   
                              <input type="text" class="form-control" id="cod_operador_catastral" name="cod_operador_catastral"  value="" onChange = "validaope();" required >
                         </div>
                       
                         <div class="form-group text-left" id ="nom_operador" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Nombre Operador:</label>   
                              <input type="text" class="form-control" id="nombre_operador_catastral" name="nombre_operador_catastral"  value="" required >
                         </div>

                         <div class="form-group text-left" id="natujuri" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Naturaleza Jurídica:</label> 
                              <select class="form-control" name="id_natu_juridica_operador" id="id_natu_juridica_operador" >
                              <option value="" selected></option>
                              <?php echo lista('natu_juridica_operador'); ?>
                              </select>
                         </div>
						 
                         <div class="form-group text-left" id="nit" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> NIT Operador:</label>   
                              <input type="text" class="form-control" id="nit_operador" name="nit_operador"  value="" required >
                         </div>

                         <div class="form-group text-left" id="digito" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span>Digito Verificación NIT:</label>   
                              <input type="number" class="form-control" id="digito_verificacion" name="digito_verificacion"  value="" required >
                         </div>

                         <div class="form-group text-left" id="represen" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Representante Legal:</label>   
                              <input type="text" class="form-control" id="repre_legal" name="repre_legal"  value="" required >
                         </div>

                         <div class="form-group text-left" id="direcc" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span>Dirección Operador:</label>   
                              <input type="text" class="form-control" id="dir_operador" name="dir_operador"  value="" required >
                         </div>

                         <div class="form-group text-left" id="telefono"style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Teléfono Operador:</label>   
                              <input type="text" class="form-control" id="tel_operador" name="tel_operador"  value=""  onChange = "televal();" required >
                         </div>

                         <div class="form-group text-left" id="correo" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Correo Operador:</label>   
                              <input type="text" class="form-control" id="correo_operador" name="correo_operador"  value="" required >
                         </div>

				   		 <div class="modal-footer">
						      <span style="color:#ff0000;">(*) Campos obligatorios</span>
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="archopera" value="operador">
                              <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div> 

<script>
    function televal() {
	var tel_operador = document.getElementById('tel_operador').value;

	var lontel = tel_operador.length;

//		alert("longitud tel: " + lontel);
		if (lontel < 7 || (lontel > 7 && lontel < 10)) {
		   alert("Número incorrecto (Teléfono de 7 digitos o Celular de 10 digitos) ...!!!");
		   document.getElementById('tel_operador').focus();
		} 
    }
</script>

<script>
    function validaope() {
        var cod_operador_cat = document.getElementById('cod_operador_catastral').value;
		// alert (' Codigo: ' + cod_operador_cat);
        jQuery.ajax({
        type: "POST",url: "pages/valida_operador.php",
		data: "cod_operador_cat="+cod_operador_cat,
		async: true,
         success: function(b) {
               validacion = b;
			   // alert (' RESP: ' + validacion);
			   if (validacion == 10) {
			     alert (cod_operador_cat + ' Ya existe....!!!');
			     document.getElementById('cod_operador_catastral').value = ' ';
			     document.getElementById('cod_operador_catastral').focus();
			   } else {
			     document.getElementById('nombre_operador_catastral').focus();
			   }
         }
        });				
    }
</script>

<script>
    function valotros() {
	var tipo_contrages = document.getElementById('id_tipo_contrato_operador').value;
		if ( tipo_contrages == 3) {
			detotros.style.display='block';
			document.getElementById('detalle_otros').focus();
		} else {
			detotros.style.display='none';
			document.getElementById('detalle_otros').value = ' ';
			document.getElementById('num_contrato').focus();
        }
    }
</script>
  


<?php

function nivelc($id_funcionario, $id_grupo_area) {
		
global $mysqli;
 
    $query17 = "SELECT id_funcionario, nombre_funcionario
			  FROM funcionario 
			  WHERE id_funcionario != '$id_funcionario'
			   AND id_grupo_area = '$id_grupo_area'
			   AND id_cargo in(1,2,4)  
			   AND estado_funcionario =1 
			   UNION
			   SELECT 0, 'SIN REEMPLAZO' ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj17['id_funcionario'], $obj17['nombre_funcionario']);
    }
$result17->free();	
 }

 function ofireg($id_funcionario, $id_oficina_registro) {
    global $mysqli;		
    $query18 = "SELECT id_funcionario, nombre_funcionario
			  FROM funcionario 
			  WHERE id_funcionario != '$id_funcionario' 
			   AND id_oficina_registro = '$id_oficina_registro' 
			   AND id_cargo in(1,2,4)  
			   AND estado_funcionario =1 
			   UNION
			   SELECT 0, 'SIN REEMPLAZO' ";
    $result18 = $mysqli->query($query18);
    while ($obj18 = $result18->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj18['id_funcionario'], $obj18['nombre_funcionario']);
    }
   $result18->free();	
 }

 
 ?>


<?php

function deptociud() {
		
global $mysqli;
 
    $query17 = "SELECT m.id_municipio id_municipio, 
	          concat(nombre_municipio,' - ', nombre_departamento) nom_municipio
			  FROM departamento d, municipio m 
			  WHERE d.id_departamento = m.id_departamento
			   AND d.estado_departamento = 1 
			   AND m.estado_municipio = 1
				ORDER BY nom_municipio ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj17['id_municipio'], $obj17['nom_municipio']);
    }
$result17->free();	
 }

function operadores($tabla) {
		
global $mysqli;
 
    $query19 = "SELECT id_operador_catastral, 
	          nombre_operador_catastral 
			  FROM ".$tabla. 
			  " WHERE estado_operador_catastral = 1
			  UNION 
			  SELECT 99, 'NO EXITE OPERADOR **' 
			  ORDER BY nombre_operador_catastral ";
    $result19 = $mysqli->query($query19);
    while ($obj19 = $result19->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj19['id_operador_catastral'], $obj19['nombre_operador_catastral']);
    }
$result19->free();	
 }

 
if (isset($_POST['archopera']) && $_POST['archopera'] == 'operador') {

	$id_funcionario = $_POST['id_funcionario'];
	$id_gestor_catastral = $_POST['id_gestor_catastral'];
	$id_operador_catastral = $_POST['id_operador_catastral'];
	$cod_operador_catastral = $_POST['cod_operador_catastral'];
	
	if ($id_operador_catastral == 99) {
	  $insertSQL = sprintf("INSERT INTO operador_catastral (
      cod_operador_catastral, nombre_operador_catastral, 
	  id_natu_juridica_operador, nit_operador, digito_verificacion, 
	  repre_legal, dir_operador, tel_operador, correo_operador, 
	  id_funcionario) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($_POST['cod_operador_catastral'], "text"),
      GetSQLValueString($_POST['nombre_operador_catastral'], "text"),
      GetSQLValueString($_POST['id_natu_juridica_operador'], "text"),
      GetSQLValueString($_POST['nit_operador'], "text"),
	  GetSQLValueString($_POST['digito_verificacion'], "text"),
      GetSQLValueString($_POST['repre_legal'], "text"),
      GetSQLValueString($_POST['dir_operador'], "text"),
      GetSQLValueString($_POST['tel_operador'], "text"),
      GetSQLValueString($_POST['correo_operador'], "text"),
      GetSQLValueString($id_funcionario, "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	  $query5 = sprintf("SELECT id_operador_catastral 
	              FROM operador_catastral
                  where cod_operador_catastral = '$cod_operador_catastral' 
				  and estado_operador_catastral = 1 "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){
	   $id_operador_catastral = $row5['id_operador_catastral'];
    }
	  
   }
	  
	  $insertSQL5 = sprintf("INSERT INTO operador_xgestor (
      id_gestor_catastral, id_operador_catastral, id_funcionario) 
	  VALUES (%s, %s, %s)", 
      GetSQLValueString($id_gestor_catastral, "int"),
      GetSQLValueString($id_operador_catastral, "int"),
      GetSQLValueString($id_funcionario, "text")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());
	
echo '<meta http-equiv="refresh" content="0;URL= ./catastro_operador&'.$id_gestor_catastral.'.jsp" />';
	  
 }
 	
?>

 <script>
    function valopera() {
	var id_operador_catastral = document.getElementById('id_operador_catastral').value;
		if ( id_operador_catastral == 99) {
			cod_operador.style.display='block';
			nom_operador.style.display='block';
			natujuri.style.display='block';
			nit.style.display='block';
			digito.style.display='block';
			represen.style.display='block';
			direcc.style.display='block';
			telefono.style.display='block';
			correo.style.display='block';
//			muni.style.display='block';
			document.getElementById('cod_operador_catastral').focus();
		} else {

			cod_operador.style.display='none';
			nom_operador.style.display='none';
			natujuri.style.display='none';
			nit.style.display='none';
			digito.style.display='none';
			represen.style.display='none';
			direcc.style.display='none';
			telefono.style.display='none';
			correo.style.display='none';
//			muni.style.display='none';
/*
			cod_operador.style.display='block';
			nom_operador.style.display='block';
			natujuri.style.display='block';
			nit.style.display='block';
			digito.style.display='block';
			represen.style.display='block';
			direcc.style.display='block';
			telefono.style.display='block';
			correo.style.display='block';
			muni.style.display='block';
*/
			document.getElementById('cod_operador_catastral').value = 0;
			document.getElementById('nombre_operador_catastral').value = 'x';
			document.getElementById('id_natu_juridica_operador').value = 1;
			document.getElementById('nit_operador').value = 0;
			document.getElementById('digito_verificacion').value = 0;
			document.getElementById('repre_legal').value = 'x';
			document.getElementById('dir_operador').value = 'x';
			document.getElementById('tel_operador').value = '0';
			document.getElementById('correo_operador').value = 'x';
//			document.getElementById('id_municipio').value = 149;
			document.getElementById('id_operador_catastral').focus();
        }
    }
</script>


<?php
$nump54=privilegios(54,$_SESSION['snr']);

if ((1==$_SESSION['rol'] or 0<$nump54) && (isset($_GET['i']) && "" != $_GET['i'])) {
$id = $_GET['i'];
} else { 
 $id = $_SESSION['id_vigilado'];
 }
 
 
	
if ((isset($_POST["id_tipo_documento"])) && (""!=$_POST["id_tipo_documento"])) {


$insertSQL = sprintf("INSERT INTO testamento 
(fecha_captura, email, id_notaria, otorga, id_tipo_documento, identificacion_otorga, 
tipo_testamento, numero_escritura, fecha_otorgamiento,  nombre_notario, modifica_revoca, pais_pasaporte, tipo_modifica, 
numero_modifica, fecha_modifica, notario_modifica, id_notaria_modifica, estado_testamento) 

VALUES (now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 

GetSQLValueString($_POST['email'], "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST['otorga'], "text"), 
GetSQLValueString($_POST['id_tipo_documento'], "text"), 
GetSQLValueString($_POST['identificacion_otorga'], "text"), 
GetSQLValueString($_POST['tipo_testamento'], "text"), 
GetSQLValueString($_POST['numero_escritura'], "text"), 
GetSQLValueString($_POST['fecha_otorgamiento'], "text"), 
GetSQLValueString($_POST['nombre_notario'], "text"), 
GetSQLValueString($_POST['modifica_revoca'], "text"), 
GetSQLValueString($_POST['pais_pasaporte'], "text"), 
GetSQLValueString($_POST['tipo_modifica'], "text"), 
GetSQLValueString($_POST['numero_modifica'], "text"), 
GetSQLValueString($_POST['fecha_modifica'], "text"), 
GetSQLValueString($_POST['notario_modifica'], "text"), 
GetSQLValueString($_POST['id_notaria_modifica'], "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;






}
 else { }

 

?>
 
 


<?php if (((1==$_SESSION['rol'] or 0<$nump54) && 0<$_GET['i']) or (3==$_SESSION['snr_tipo_oficina'] && 0<=$_SESSION['id_vigilado']))
{ include 'menu_notaria.php'; } else { } ?>	 

	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-4">
<?php  if (1==$_SESSION['rol'] or 3==$_SESSION['snr_tipo_oficina']) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo testamento
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">
	   
	   <form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

              <div class="input-group">
                <div class="input-group-btn">Buscar
                  <select class="form-control" name="campo" required>
                    <option value="" selected> - - Buscar otros testamentos: - - </option>
                    <option value="identificacion_otorga">Número de identificación</option>
                    <option value="otorga">Nombre del otorgante</option>
                    <option value="numero_escritura">Número de Escritura</option>
			 <option value="numero_modifica">Número de Escritura con que se modifica o revoca</option>
			
			
			
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



</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
 
			<style>


.dataTables_filter {
display:none;
}



.dataTables_paginate {
display:none;
}

			</style> 


			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">

                <thead>
<tr align="center" valign="middle">
<th>Notaria</th>
<th>Otorgante</th>
<th>Tipo de identificación</th>
<th>N. identificación</th>
<th>Tipo testamento</th>
<th>Escritura</th>
<th>Fecha</th>
<th>Esc. Mod./ Revoca</th>
<th>Fecha Mod./ Revoca</th>
</tr>
</thead>
<tbody>
<?php 

if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
				$infop=$infobus;
				$pagina=0;
				} else {	
				$infop="  and  testamento.id_notaria=".$id." ";	
	if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
	 } else {
		$pagina=0;  
	 }}


$query4="SELECT * from testamento, notaria, tipo_documento where testamento.id_notaria=notaria.id_notaria and testamento.id_tipo_documento=tipo_documento.id_tipo_documento ".$infop." and estado_testamento=1 ";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {


$id_res=$row['id_testamento'];
echo '<tr><td>'.$row['nombre_notaria'].'</td><td>'.$row['otorga'].'</td>';
echo '<td>'.$row['nombre_tipo_documento'].'</td>';
echo '<td>'.$row['identificacion_otorga'].'</td>';
echo '<td>'.$row['tipo_testamento'].'</td>';
echo '<td>'.$row['numero_escritura'].'</td>';
echo '<td>'.$row['fecha_otorgamiento'].'</td>';
echo '<td>'.$row['numero_modifica'].'</td>';
echo '<td>'.$row['fecha_modifica'].'</td>';
echo '</td></tr>';
?>
      
        
                <?php } ?>

				
                </tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									//'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (1==$_SESSION['rol'] or 3==$_SESSION['snr_tipo_oficina']) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO TESTAMENTO</h4>
      </div>
      <div class="modal-body">
    

    
<form action="" method="POST" name="for543534345353454r65464563m1"  >

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre completo de quien otorga el testamento :</label> 
<input type="text" class="form-control" required name="otorga" value="">
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de identificación de quien otorga el testamento: </label> 
<select class="form-control" name="id_tipo_documento" id="tipodoctesta" required>
<option value="" selected></option>
<option value="" selected=""></option>
<option value="1">Cédula de ciudadania</option>
<option value="2">Cédula de extranjeria</option>
<option value="3">Pasaporte</option>
<option value="9">PEP - Permiso especial de permanencia</option>
<option value="12">Permiso de proteccion temporal</option>
<option value="5">Tarjeta de identidad</option>
</select>
</div>


<div class="form-group text-left" id="paistesta" style="display:none;">
<label  class="control-label">Indique el país de expedición del pasaporte.:</label>
<select name="pais_pasaporte" class="form-control">
<option selected></option>
<?php echo lista('pais'); ?>
</select>
</div> 



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Número de identificación de quien otorga el testamento :</label> 
<input type="text" class="form-control" required name="identificacion_otorga" value="">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de testamento: </label> 
<select class="form-control" name="tipo_testamento" required>
<option value="" selected></option>
<option>Testamento abierto</option>
<option>Testamento cerrado</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Número de la escritura pública con la que se protocolizó o se dispuso la custodia del testamento:</label> 
<input type="text" class="form-control"  name="numero_escritura" value="">
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha otorgamiento o custodia del testamento :</label> 
<input type="text" class="form-control datepickera" required readonly name="fecha_otorgamiento" value="">
</div>


<div class="form-group text-left"> 
<label  class="control-label">Nombre del Notario que autorizó el Testamento:</label> 
<input type="text" class="form-control" required name="nombre_notario" value="">
</div>



<div class="form-group text-left"><label  class="control-label">¿Con el testamento otorgado se modifica o se revoca algún testamento otorgado anteriormente?:</label>
<select class="form-control" id="inforevoca" required name="modifica_revoca">
<option selected></option>
<option>No</option>
<option>Si</option>
</select>
</div> 



<div class="form-group text-left revocatesta" style="display:none;">
<label  class="control-label">Tipo de testamento que se modifica o se revoca:</label>
<select class="form-control" name="tipo_modifica">
<option value="" selected></option>
<option>Testamento abierto</option>
<option>Testamento cerrado</option>
</select>
</div>
<div class="form-group text-left revocatesta" style="display:none;">
<label  class="control-label">Número de la escritura pública con la que se protocolizó o se dispuso la custodia del testamento que se modifica o se revoca:</label>
<input type="text" class="form-control"  name="numero_modifica" value=""></div> 


<div class="form-group text-left revocatesta" style="display:none;">
<label  class="control-label">Fecha otorgamiento o de custodia del testamento que se modifica o se revoca:</label>
<input type="text" class="form-control datepickera" readonly name="fecha_modifica" value=""></div> 


<div class="form-group text-left revocatesta" style="display:none;">
<label  class="control-label">Nombre del Notario que autorizó o dispuso la custodia del Testamento que se modifica o se revoca:</label>
<input type="text" class="form-control"  name="notario_modifica" value=""></div> 



<div class="form-group text-left ubicacion revocatesta" style="display:none;"> 
<label  class="control-label">Departamento de la Notaria de modifica o revoca:</label> 
<select  class="form-control"  id="id_departamento_testa" >
<option value="" selected></option>
<?php echo lista('departamento');  ?>
</select>
</div>
<div class="form-group text-left ubicacion revocatesta" style="display:none;"> 
<label  class="control-label">Notaria que modifica o revoca el testamento:</label> 
<select  class="form-control" name="id_notaria_modifica" id="id_notaria_testa" >
</select>
</div>



	






<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>


<?php
} else {}
?>







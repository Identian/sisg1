<?php if (1==$_SESSION['rol']) { ?>	


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
});
  </script>


<?php
if ((isset($_POST["tipo"])) && ($_POST["tipo"] == "ingresar1")) { 
$insertSQL = sprintf("INSERT INTO tramite_interno (tipo_gestion, via_entrada, via_tramite, 
n_dane, n_dans, resuelto, radicado, radicado_salida, fecha_tramite, hora_tramite, id_procedimiento_interno, id_accion_interna, folios, tipo_solicitante, id_notaria, cedula, solicitante, detalle_tramite, funcionario_entrega, id_funcionario_entrega, funcionario_responsable, id_funcionario_responsable, fecha_correo, de_correo, para_correo, asunto, fecha_actualiza, hora_actualiza, estado_tramite_interno) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["tipo_gestion"], "text"), 
GetSQLValueString($_POST["via_entrada"], "text"), 
GetSQLValueString($_POST["via_tramite"], "int"), 
GetSQLValueString($dane, "int"), 
GetSQLValueString($dans, "int"), 
GetSQLValueString($_POST["resuelto"], "int"), 
GetSQLValueString($_POST["radicado"], "text"), 
GetSQLValueString($_POST["radicado_salida"], "text"), 
GetSQLValueString($_POST["fecha_tramite"], "date"), 
GetSQLValueString($_POST["id_procedimiento_interno"], "int"), 
GetSQLValueString($_POST["id_accion_interna"], "int"), 
GetSQLValueString($_POST["folios"], "int"), 
GetSQLValueString($_POST["tipo_solicitante"], "text"), 
GetSQLValueString($_POST["id_notaria"], "int"), 
GetSQLValueString($_POST["cedula"], "int"), 
GetSQLValueString($_POST["solicitante"], "text"), 
GetSQLValueString($_POST["funcionario_entrega"], "int"), 
GetSQLValueString($_POST["id_funcionario_entrega"], "int"), 
GetSQLValueString($_POST["funcionario_responsable"], "int"), 
GetSQLValueString($_POST["id_funcionario_responsable"], "int"), 
GetSQLValueString($_POST["fecha_correo"], "date"), 
GetSQLValueString($_POST["de_correo"], "text"), 
GetSQLValueString($_POST["para_correo"], "text"), 
GetSQLValueString($_POST["asunto"], "text"), 
GetSQLValueString($_POST["fecha_actualiza"], "date"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;
} else { }




if ((isset($_POST["tipo"])) && ($_POST["tipo"] == "actualizar1") && isset($_POST["id_tramite_interno"])) { 
$idr=intval($_POST["id_tramite_interno"]);
$updateSQL = sprintf("UPDATE tramite_interno SET tipo_gestion=%s, via_entrada=%s, 
via_tramite=%s, n_dane=%s, n_dans=%s, resuelto=%s, radicado=%s, radicado_salida=%s, 
fecha_tramite=%s, hora_tramite=%s, id_procedimiento_interno=%s, id_accion_interna=%s, 
folios=%s, tipo_solicitante=%s, id_notaria=%s, cedula=%s, solicitante=%s, detalle_tramite=%s, 
funcionario_entrega=%s, id_funcionario_entrega=%s, funcionario_responsable=%s, 
id_funcionario_responsable=%s, fecha_correo=%s, de_correo=%s, para_correo=%s, 
asunto=%s, fecha_actualiza=%s, hora_actualiza=%s, estado_tramite_interno=%s 
where id_tramite_interno=%s",
GetSQLValueString($_POST["tipo_gestion"], "text"), 
GetSQLValueString($_POST["via_entrada"], "text"), 
GetSQLValueString($_POST["via_tramite"], "int"), 
GetSQLValueString($_POST["n_dane"], "int"), 
GetSQLValueString($_POST["n_dans"], "int"), 
GetSQLValueString($_POST["resuelto"], "int"), 
GetSQLValueString($_POST["radicado"], "text"), 
GetSQLValueString($_POST["radicado_salida"], "text"), 
GetSQLValueString($_POST["fecha_tramite"], "date"), 
GetSQLValueString($_POST["id_procedimiento_interno"], "int"), 
GetSQLValueString($_POST["id_accion_interna"], "int"), 
GetSQLValueString($_POST["folios"], "int"), 
GetSQLValueString($_POST["tipo_solicitante"], "text"), 
GetSQLValueString($_POST["id_notaria"], "int"), 
GetSQLValueString($_POST["cedula"], "int"), 
GetSQLValueString($_POST["solicitante"], "text"), 
GetSQLValueString($_POST["funcionario_entrega"], "int"), 
GetSQLValueString($_POST["id_funcionario_entrega"], "int"), 
GetSQLValueString($_POST["funcionario_responsable"], "int"), 
GetSQLValueString($_POST["id_funcionario_responsable"], "int"), 
GetSQLValueString($_POST["fecha_correo"], "date"), 
GetSQLValueString($_POST["de_correo"], "text"), 
GetSQLValueString($_POST["para_correo"], "text"), 
GetSQLValueString($_POST["asunto"], "text"), 
GetSQLValueString($_POST["fecha_actualiza"], "date"), 
GetSQLValueString($_POST["estado_tramite_interno"], "int"), 
GetSQLValueString($idr, "int"));
$Result = mysql_query($updateSQL, $conexion) ;
echo $actualizado;
} else { }
	
?>




	<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3><?php $actualizar55 = mysql_query("SELECT count(id_tramite_interno) as tota FROM tramite_interno where estado_tramite_interno=1", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
$totfull=$row155['tota'];
echo $totfull;
mysql_free_result($actualizar55);
 ?>
 </h3>

              <p>Tramites</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="" class="small-box-footer" data-toggle="modal" data-target="#controlpqrs">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> 
<?php $actualizar557 = mysql_query("SELECT count(id_tramite_interno) as tota FROM tramite_interno where resuelto=1 and estado_tramite_interno=1", $conexion);
$row1557 = mysql_fetch_assoc($actualizar557);
$res= $row1557['tota'];
echo $res;
mysql_free_result($actualizar557);
 ?>
</h3>

              <p>Finalizados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#popupclasificadas">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
<?php 
$pen=$totfull-$res;
echo $pen;
 ?>
</h3>

              <p>Pendientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
			
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#popupdireccionadas">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3>
<?php $actualizar557f = mysql_query("SELECT count(id_tramite_interno) as tota FROM tramite_interno where id_funcionario_responsable=".$_SESSION['snr']." and estado_tramite_interno=1", $conexion);
$row1557f = mysql_fetch_assoc($actualizar557f);
$resff= $row1557f['tota'];
echo $resff;
mysql_free_result($actualizar557f);
 ?>
</h3>
              <p>Asignadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
			
			
			
          </div>
        </div>
		
	 
      </div>
	
	
	
	
	
	
<div class="row">
<div class="col-md-12">
  <div class="box box-info">


            <div class="box-header with-border">
              
	
		<form class="navbar-form" name="form1erteg" method="post" action="">

<div class="col-md-4">
	 <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo tramite
      </button></h3>
</div>
<div class="col-md-8">



<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected>- - - Buscar por:  - - - - </option>
 		  <option value="n_dane">DANE</option>
		   <option value="n_dans">DANS</option>
 <option value="radicacion">Radicado</option>
  <option value="radicado_entrada">Radicado salida</option>
    <option value="solicitante">Nombre del solicitante</option>
	 <option value="cedula">Cédula del solicitante</option>
	 <option value="nombre_funcionario">Funcionario responsable</option>
    <option value="fecha_tramite">Fecha</option>
		  </select>
</div>
<div class="input-group-btn"><input type="text" style="width:250px;" name="buscar" placeholder="Buscar" class="form-control" required ></div>
 
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
</div>

</div>



</form>

				

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
						<style>
.dataTables_filter {
display:none;
}
			</style>
              <div class="table-responsive">
			  
			  
			  <?php

				if (isset($_POST['buscar']) && ""!=$_POST['buscar'] ) {
				$info=" ";
				$cons=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
				} else {
				$info=" limit 200";
				$cons="";
				}
				
$query = "SELECT * FROM tramite_interno, accion_interna, funcionario where 
tramite_interno.id_accion_interna=accion_interna.id_accion_interna and 
tramite_interno.id_funcionario_responsable=funcionario.id_funcionario and  estado_tramite_interno=1 ".$cons." order by id_tramite_interno desc".$info."";
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);


				?>
				
				
<table  class="table table-striped table-bordered table-hover" id="inforesoluciones" cellspacing="0" width="100%">
                    <thead>
                    <tr>
<th style="min-width:80px;">Estado</th>
<th>DANE</th>
<th>DANS</th>
<th>RADICADO</th>
<th>RADICADO SALIDA</th>
<th>FECHA</th>
<th>TIPO</th>
<th>NOTARIA</th>
<th>ASIGNADO</th>
				   
				   <th style="min-width:20px;"></th>         
                    </tr>
                    </thead>
                    <tbody>
					<?php
			
do {
	echo '<tr>';
$idt=$row['id_tramite_interno'];
echo '<td>';
if (1==$row['resuelto']) { echo '<span class="fa fa-check-circle-o"></span> '; 
} else { echo '<span class="fa fa-circle-o"></span> '; }
echo ''.$row['tipo_gestion'].'</td>';
echo '<td>'.$row['n_dane'].'</td>';
echo '<td>'.$row['n_dans'].'</td>';
echo '<td>';
if (15==strlen($row['radicado'])) {
	echo '<a href="correspondencia&'.$row['radicado'].'.jsp" target="_blank">'.$row['radicado'].'</a>';
} else { echo $row['radicado']; }
echo '</td>';

echo '<td>';

if (15==strlen($row['radicado_salida'])) {
	echo '<a href="correspondencia&'.$row['radicado_salida'].'.jsp" target="_blank">'.$row['radicado_salida'].'</a>';
} else { echo $row['radicado_salida']; }


echo '</td>';
echo '<td>'.$row['fecha_tramite'].'</td>';
echo '<td>'.$row['nombre_accion_interna'].'</td>';
echo '<td>';
if (isset($row['id_notaria'])) {
	echo quees('notaria', $row['id_notaria']);
} else {}
'</td>';
echo '<td>'.$row['nombre_funcionario'].'</td>';

echo '<td>';
echo '<button id="'.$idt.'" type="button" class="btn btn-xs btn-warning buscar_tramite" data-toggle="modal" data-target="#popuptramite"><span class="glyphicon glyphicon-plus-sign"></span>
      </button>';
echo '</td></tr>';
} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);
					?>
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
						}
					});
				});
				
			//	,						"aaSorting": [[ 1, "desc"]]
			
		
				
			</script>	


						
              </div>
          
            </div>
			
     
          </div>
        </div>

</div>



 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo tramite</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r65464563m1" enctype="multipart/form-data" >

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE GESTION:</label> 
<select  class="form-control" name="tipo_gestion" required>
<option value="" selected></option>
<option value="Tramite">Tramite</option>
<option value="Archivo">Archivo</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> VIA DE ENTRADA:</label> 
<select class="form-control" name="via_entrada"  required>
  <option selected></option>
  <option value="Iris">Iris</option>
  <option value="Delegada de Notariado">Delegada de Notariado</option>
<option value="Correo">Correo</option>
<option value="Otra..">Otra..</option>
  </select>


</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICADO:</label> 
<input type="text" class="form-control" name="radicado" value="" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"> RADICADO SALIDA:</label> 
<input type="text" class="form-control" name="radicado_salida" required >
</div>

<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> VIA DE TRAMITE:</label> 
<select  class="form-control" name="via_tramite" required readonly>
<option value="" selected></option>
<option value=""></option>
</select>
</div>-->

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> PROCEDIMIENTO:</label> 
<select  class="form-control" name="id_procedimiento_interno" id="id_procedimiento_interno" required>
<option value="" selected></option>
<?php echo lista('procedimiento_interno'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TRAMITE:</label> 
<select  class="form-control" name="id_accion_interna" id="id_accion_interna" required>
<option value="" selected></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">FOLIOS:</label> 
<input type="text" class="form-control numero" name="folios" >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE SOLICITANTE:</label> 
<select class="form-control" name="tipo_solicitante" required="">
  <option selected></option>
  <option value="Funcionario">Funcionario</option>
  <option value="Notaria">Notaria</option>
<option value="Particular">Particular</option>
  </select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">NOTARIA:</label> 
<select class="form-control" name="id_notaria" >
<option value="" selected></option>
<?php echo lista('notaria'); ?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label">NOMBRE DEL SOLICITANTE:</label> 
<input type="text" class="form-control" name="solicitante" required >
</div>


<div class="form-group text-left"> 
<label  class="control-label">CEDULA DEL SOLICITANTE:</label> 
<input type="text" class="form-control numero" name="cedula" >
</div>


<div class="form-group text-left"> 
<label  class="control-label">DETALLE DEL TRAMITE:</label> 
<textarea class="form-control" name="detalle_tramite" ></textarea>
</div>

<div class="form-group text-left"> 
<label  class="control-label">FUNCIONARIO QUE ENTREGA:</label> 
<select  class="form-control" name="id_funcionario_entrega" >
<option value="" selected></option>
<?php
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_grupo_area=46 and estado_funcionario=1 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<!--
<div class="form-group text-left"> 
<label  class="control-label">N DE DANE:</label> 
<select  class="form-control" name="n_dane" >
<option value="" selected></option>
<option value=""></option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">N DE DANS:</label> 
<select  class="form-control" name="n_dans" >
<option value="" selected></option>
<option value=""></option>
</select>
</div>
-->
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FUNCIONARIO RESPONSABLE:</label> 
<select  class="form-control" name="id_funcionario_responsable" required>
<option value="" selected></option>
<option value=""></option>
<?php
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_grupo_area=46 and estado_funcionario=1 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<hr>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE CORREO:</label> 
<input type="text" readonly="readonly" class="form-control datepicker" style="background:#fff;" name="fecha_correo"   >
</div>
<div class="form-group text-left"> 
<label  class="control-label">DEL CORREO:</label> 
<input type="text" class="form-control" name="de_correo"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">PARA EL CORREO:</label> 
<input type="text" class="form-control" name="para_correo"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">ASUNTO DEL CORREO:</label> 
<textarea type="text" class="form-control" name="asunto"></textarea>
</div>


<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="tipo" value="ingresar" >
<span class="glyphicon glyphicon-ok"></span> Crear </button></div>

</form>


      </div>
    </div>
  </div>
</div>























<div class="modal fade" id="popuptramite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Tramite</label></h4>
</div> 
<div class="ver_tramite"> 


</div>
</div> 
</div> 
</div> 


<?php } else {} ?>
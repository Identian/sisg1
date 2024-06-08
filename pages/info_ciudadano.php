<?php
if (isset($_GET['i'])) {
	$id=intval($_GET['i']);
} else { echo ''; }


	
if ((isset($_POST["table"])) && ($_POST["table"] == "ciudadano") && (1==$_SESSION['rol'] or 40==$_SESSION['snr_grupo_area'] or 24==$_SESSION['snr_grupo_area'])) { 






echo $actualizado;
} else { }
	
	
	
	
	
$query_update = sprintf("SELECT * FROM ciudadano WHERE id_ciudadano = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);

if (0<$totalRows_update){

	
	$identificacion=$row_update['identificacion'];

?>









<div class="row">
<div class="col-md-6">
	<div class="box box-info">
 <div class="box-header with-border">
                  <h3 class="box-title">CIUDADANO  
				  </h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">

			<div  class="modal-body">
			

	 
	 
	
<div class="row">


<div class="col-md-12">
<div class="form-group text-left"> 
<label  class="control-label">NOMBRE:</label>   
<?php echo htmlentities($row_update['nombre_ciudadano'], ENT_COMPAT, ''); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">TIPO DE DOCUMENTO:</label>   
<?php echo quees('tipo_documento', $row_update['id_tipo_documento']); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">IDENTIFICACIÓN:</label>   
<?php echo $identificacion; ?>

</div>
<div class="form-group text-left"> 
<label  class="control-label">ETNIA:</label>   
<?php echo quees('etnia', $row_update['id_etnia']); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">CORREO:</label>   
<?php echo htmlentities($row_update['correo_ciudadano'], ENT_COMPAT, ''); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">TELEFONO:</label>   
<?php echo htmlentities($row_update['telefono_ciudadano'], ENT_COMPAT, ''); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">DEPARTAMENTO:</label>  
<?php echo quees('departamento', $row_update['id_departamento']); ?> 
</div>
<div class="form-group text-left"> 
<label  class="control-label">MUNICIPIO:</label>   
<?php $muni=$row_update['id_municipio'];  echo quees('municipio', $muni); ?>
</div>
<div class="form-group text-left"> 
<label  class="control-label">POR QUE MEDIO DESEA RECIBIR SU RESPUESTA::</label>   
<?php echo quees('tipo_respuesta', $row_update['id_tipo_respuesta']); ?>

</div>
<div class="form-group text-left"> 
<label  class="control-label">DIRECCION DEL CIUDADANO:</label>   
<?php echo htmlentities($row_update['direccion_ciudadano'], ENT_COMPAT, ''); ?>
</div>
</div>







</div>


</div>
</div>
</div>
</div>

<div class="col-md-6">

	  <div class="box box-success direct-chat direct-chat-warning" >
                <div class="box-header with-border">
                  <h3 class="box-title">PQRS del Ciudadano</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
				<div  class="modal-body" style="max-height:450px;">
		

			<?php
			
		
$query48 = sprintf("SELECT * FROM solicitud_pqrs, ciudadano where ciudadano.id_ciudadano=".$id."  and solicitud_pqrs.id_ciudadano=ciudadano.id_ciudadano and estado_solicitud_pqrs=1 order by id_solicitud_pqrs desc"); 
$result8 = $mysqli->query($query48);

	while($row9 = $result8->fetch_array(MYSQLI_ASSOC)) {
		
			echo '<a href="solicitud_pqrs&'.$row9['id_solicitud_pqrs'].'.jsp">'.$row9['radicado'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row9['fecha_radicado'].'</span><br>';
			echo $row9['nombre_solicitud_pqrs'].'<hr>';
			
			
			
	}
	$result8->free();
?>
		

		
<?php
		
$actualizar57ll = mysql_query("SELECT * FROM radi_cert where identificacion='$identificacion' and estado_radi_cert=1", $conexion) or die(mysql_error());
$row157ll = mysql_fetch_assoc($actualizar57ll);
$total557ll = mysql_num_rows($actualizar57ll);
if (0<$total557ll) {
 do { 
 
		echo '<a href="https://sisg.supernotariado.gov.co/radicado_anterior&'.$row157ll['id_radi_cert'].'.jsp">Certicamara '.$row157ll['radi_cert'].'</a><br>';
			echo '<span style="color:#aaa;">'.$row157ll['fecha_radi_cert'].'</span><br>';
			echo $row157ll['nombre_radi_cert'].'<hr>';
 
 } while ($row157ll = mysql_fetch_assoc($actualizar57ll)); 
  mysql_free_result($actualizar57ll);
} else {}
?>




		

		
			
			</div>
			</div>	
	</div>
	

</div>


<!--
<div class="col-md-3">

	  <div class="box box-success direct-chat direct-chat-warning" >
                <div class="box-header with-border">
                  <h3 class="box-title">Liquidación de herencia</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
              
                <div class="box-body" >
				<div  class="modal-body" style="max-height:450px;">
		

		

		
<?php
		/*
$actualizar57ll = mysql_query("select * FROM ciudadano, causante WHERE ciudadano.identificacion=causante.num_dcto_causante AND identificacion='$identificacion'", $conexion) or die(mysql_error());
$row157ll = mysql_fetch_assoc($actualizar57ll);
$total557ll = mysql_num_rows($actualizar57ll);
if (0<$total557ll) {
 do { 
 
		echo '<a href="https://sisg.supernotariado.gov.co/consulta_sucesion&'.$row157ll['id_sucesion'].'.jsp">Liquidación</a><br>';
			echo '<br>';
 
 } while ($row157ll = mysql_fetch_assoc($actualizar57ll)); 
  mysql_free_result($actualizar57ll);
} else {}
*/
?>




		

		
			
			</div>
			</div>	
	</div>
	

</div>-->





</div>


<?php
//select * FROM ciudadano, causante WHERE ciudadano.identificacion=causante.num_dcto_causante AND identificacion=


} 

?>
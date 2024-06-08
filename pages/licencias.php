<?php
$nump144=privilegios(144,$_SESSION['snr']);

	 
if ((isset($_POST["id_radicado"])) && (""!=$_POST["id_radicado"]) && (0<$nump144 or 1==$_SESSION['rol'])) {



$insertSQL = sprintf("INSERT INTO licencia_curaduria (id_curaduria, id_funcionario, nombre_licencia_curaduria, id_objeto_lic_curaduria, estado_licencia_curaduria, 
n_acto_administrativo, fecha_licencia_real, fecha_radicacion, fecha_expedicion, fecha_ejecutoria, fecha_terminacion_l, observacion_licencia, 
licencia_cerrada, id_estado_lic_curaduria, situacion_licencia) 
VALUES (%s, %s, %s, %s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["id_curaduria"], "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["id_radicado"], "text"), 
GetSQLValueString(1, "int"), 
GetSQLValueString(1, "int"), 
GetSQLValueString($_POST["id_acto"], "text"), 

GetSQLValueString($_POST["fecha_radicacion"], "text"), 
GetSQLValueString($_POST["fecha_expedicion"], "text"), 
GetSQLValueString($_POST["fecha_ejecutoria"], "text"), 
GetSQLValueString($_POST["fecha_vencimiento"], "text"), 
GetSQLValueString($_POST["observacion"], "text"), 
GetSQLValueString(1, "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

  echo $insertado;
  
  
$query2 = sprintf("SELECT id_licencia_curaduria FROM licencia_curaduria where id_curaduria=".$_POST["id_curaduria"]." and nombre_licencia_curaduria=".$_POST["id_radicado"]." order by id_licencia_curaduria desc limit 1");
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
$lic=$row2['id_licencia_curaduria'];
mysql_free_result($select2);
echo '<meta http-equiv="refresh" content="2;URL=https://sisg.supernotariado.gov.co/licencia&'.$lic.'.jsp" />';



}
 else { }

?>
	<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
             <h3><?php echo existenciaunica('tipo_autorizacion_licencia', 'id_clase_licencia', 1); ?></h3>

              <p>Licencia de Urbanización</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
		  </div>
		  

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo existenciaunica('tipo_autorizacion_licencia', 'id_clase_licencia', 2); ?></h3>

              <p>Licencia de Parcelación</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
          <h3><?php echo existenciaunica('tipo_autorizacion_licencia', 'id_clase_licencia', 3); ?></h3>

              <p>Licencia de Subdivisión</p>
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
              <h3><?php echo existenciaunica('tipo_autorizacion_licencia', 'id_clase_licencia', 4); ?></h3>

              <p>Licencia de Construcción</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		

      </div>
	
	
	<div class="row">

	<div class="col-md-12">

				

 <div class="box box-info">
 <div class="box-header with-border">
		
<div class="row">		
<div class="col-md-3">

<?php 

 if (1==$_SESSION['rol'] or 0<$nump144) { ?>
  
   
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>
	  
<?php } else {} ?>


<span class="box-title"><strong>Licencias</strong></span> 				
</div>


<form class="navbar-form" name="form1erertretteg" method="post" action="">
<div class="col-md-4">

<select class="form-control" name="curaduria" style="width:100%" >
<option value="" selected> - Buscar por Curaduria: -  </option>
	<?php

$query = sprintf("SELECT id_curaduria, nombre_curaduria FROM curaduria where estado_curaduria=1 order by id_curaduria"); 

$select = mysql_query($query, $conexion) or die(mysql_error());

$row = mysql_fetch_assoc($select);

$totalRows = mysql_num_rows($select);

if (0<$totalRows){

do {

	echo '<option value="'.$row['id_curaduria'].'" ';
	echo '>'.$row['nombre_curaduria'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

?>

	
</select>
</div>




<div class="col-md-3">


<input type="text" style="width:100%" class="form-control" name="licencia" placeholder="Radicación ó acto admin. del proyecto" value="">

</div>
<div class="col-md-2">
 <button type="submit" style="width:100%" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>

</form>
</div>


		<div class="row">		
				

  
            <div class="box-body">
			<style>
.dataTables_filter {
display:none;
}
			</style>
              <div class="table-responsive">
              				
				
				
			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">

  <th>Curaduria</th>
						<th>Radicación</th>
                        <th>Acto admin.</th>
						<th>Fecha Expedición</th>
                        <th>Fecha Ejecutoria</th>
						<th>Fecha de vencimiento</th>
                        <th style="min-width:120px;"></th> 
				  
</tr>
</thead>
<tbody>
<?php 


	
$fecha_re=date("Y-m-d");
$menos1mes = strtotime($fecha_re."- 1 day");
$fechacambia= date("Y-m-d",$menos1mes);



					
if (isset($_POST['licencia']) or (isset($_POST['curaduria']))) {		
				
				
if (""!=$_POST['licencia'] && ""==$_POST['curaduria']) {
$licencia=$_POST['licencia'];
$infoli=" and (licencia_curaduria.nombre_licencia_curaduria='$licencia' or licencia_curaduria.n_acto_administrativo='$licencia')";
$buscarlicencia=$infoli;
} else if (""!=$_POST['curaduria'] && ""==$_POST['licencia']) {
$cura=intval($_POST['curaduria']);
$infobus=" and curaduria.id_curaduria=".$cura." ";
$buscarlicencia=$infobus;
} else {
$buscarlicencia="  and fecha_licencia_real>='$fechacambia'  ";
}


} else {
$buscarlicencia=" and fecha_licencia_real>='$fechacambia' ";
}

function otroactoasociado($idlic) {
global $mysqli;
$resbacto2='';
$query = "SELECT documento_url_acto FROM acto_admin_x_licencia where id_licencia_curaduria=".$idlic." and estado_acto_admin_x_licencia=1 order by id_acto_admin_x_licencia";
$result = $mysqli->query($query);
while ($obj = $result->fetch_array()) {
     $resbacto2.= '<a href="files/'.$obj['documento_url_acto'].'" title="Acto administrativo asociado"><span class="fa fa-file" style="color:#B40404;"></span></a> ';
  
   }
   return $resbacto2;
$result->free();
}

function cuentalicacto($idlic2) {
global $mysqli;
$query4b = sprintf("SELECT count(id_acto_admin_x_licencia) as totsolacto FROM acto_admin_x_licencia where id_licencia_curaduria=".$idlic2." and estado_acto_admin_x_licencia=1"); 
$result4b = $mysqli->query($query4b);
$row4b = $result4b->fetch_array(MYSQLI_ASSOC);
$resb=$row4b['totsolacto'];
if (0<$resb) {
	 $resbacto=otroactoasociado($idlic2);
} else {
	 $resbacto='';
}
return $resbacto;
$result4b->free();
}

$query4="SELECT * FROM licencia_curaduria, documento_licencia, curaduria where licencia_curaduria.id_curaduria=curaduria.id_curaduria and licencia_curaduria.id_licencia_curaduria=documento_licencia.id_licencia_curaduria and licencia_cerrada=1 ".$buscarlicencia." and documento_licencia.estado_documento_licencia=1 and estado_licencia_curaduria=1 and situacion_licencia=1 order by licencia_curaduria.fecha_expedicion desc"; 

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php

if (1==intval($_SESSION['snr_tipo_oficina'])) {
$infoi='<a href="licencia&'.$row['id_licencia_curaduria'].'.jsp" title="Ver Licencia"><span class="label label-success">Ver</span></a> &nbsp;';
	} else { $infoi=''; }
	
		$valsim=intval($row['situacion_licencia']);
			if (0==$valsim) {
			$anulada=' Anulada ';
			} else {
			$anulada='';
			}
			
$pdf='<a href="pdf/licencia&'.$row['nombre_licencia_curaduria'].'.pdf" title="Constancia" download="Constancia.pdf"><img src="images/pdf.png"></a> ';
$pdf2='<a href="files/licenciassnr/'.$row['url_documento_licencia'].'" title="Acto Administrativo"  download="Acto_administrativo.pdf"><img src="images/pdf.png"></a> ';
$otroacto=cuentalicacto($row['id_licencia_curaduria']);

echo '<td>'.$row['nombre_curaduria'].'</td>';
echo '<td>'.$row['nombre_licencia_curaduria'].'</td>';
echo '<td>'.$row['n_acto_administrativo'].'</td>';
echo '<td>'.$row['fecha_expedicion'].'</td>';
echo '<td>'.$row['fecha_ejecutoria'].'</td>';
echo '<td>'.$row['fecha_terminacion_l'].'</td>';
echo '<td>'.$infoi.$anulada.$pdf.$pdf2.$otroacto.'</td>';
						  
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
									//'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 1, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
		  
		  


        </div>
		</div>
		</div>
			</div>
		

	
	
	

<?php if (1==$_SESSION['rol'] or 0<$nump144) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva licencia</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r43543324464563m1"  >

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CURADURIA:</label> 
<select class="form-control" name="id_curaduria" style="width:100%" >
<option value="" selected> - Buscar por Curaduria: -  </option>
	<?php

$query = sprintf("SELECT id_curaduria, nombre_curaduria FROM curaduria where estado_curaduria=1 order by id_curaduria"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_curaduria'].'" ';
	echo '>'.$row['nombre_curaduria'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICADO:</label> 
<input type="text" class="form-control" name="id_radicado" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ACTO ADMINISTRATIVO:</label> 
<input type="text" class="form-control" name="id_acto" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA RADICACIÓN:</label> 
<input type="text" class="form-control datepickera" name="fecha_radicacion" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA EXPEDICIÓN:</label> 
<input type="text" class="form-control datepickera" name="fecha_expedicion" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA EJECUTORIA:</label> 
<input type="text" class="form-control datepickera" name="fecha_ejecutoria" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE VENCIMIENTO:</label> 
<input type="text" class="form-control datepickera" name="fecha_vencimiento" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> OBSERVACIONES:</label> 
<textarea class="form-control" name="observacion" ></textarea>
</div>




<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="estado_contable">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>


<?php } else { }
?>

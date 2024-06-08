<?php
$nump87=privilegios(87,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) {


if ((isset($_POST["radicado"])) && (""!=$_POST["radicado"]) && (0<$nump87 or 1==$_SESSION['rol'])) {

$insertSQL = sprintf("INSERT INTO concepto (radicado, fuente, 
fecha_publicacion, nombre_concepto, id_tipo_oficina, ubicacion, 
ano, estado_concepto) VALUES (%s, %s, now(), %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["radicado"], "text"), 
GetSQLValueString($_POST["fuente"], "text"), 
GetSQLValueString($_POST["nombre_concepto"], "text"), 
GetSQLValueString($_POST["id_tipo_oficina"], "int"), 
GetSQLValueString($_POST["ubicacion"], "text"), 
GetSQLValueString($_POST["ano"], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;

}  else { }

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('concepto'); ?></h3>

              <p>Cantidad de conceptos OAJ</p>
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
              <h3>20<?php echo $anoactual; ?></h3>

              <p>Año</p>
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
             
 <h3>
 <?php echo existencialimitada('concepto', 'fecha_publicacion', $realdate) ?></h3>
			 
              <p>Conceptos OAJ registrados hoy</p>
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
              <h3>2</h3>
              <p>Formas de presentación</p>
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
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-4">
<?php  if (1==$_SESSION['rol'] or 0<$nump87) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">
	<!--
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">Buscar 
<select class="form-control" name="campo" required>
          <option value="" selected> - - Buscar por: - -  </option>
 <option value="mes">Mes</option>
<option value="ano">Año</option>
<option value="nombre_tipo_estado_contable">Tipo de estado contable</option>
		  </select>
</div>
<div class="input-group-btn">
<input type="text" name="buscar" placeholder="" class="form-control" required ></div>
   
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>

</form>-->


</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
				  <th>Radicado</th>
			
				  <th>Año</th>
				  <th>Ubicación</th>
				  <th>Asunto</th>
				  <th>Oficina</th>
				  <th>Documento</th>
				
<th style="width:20px;"></th>
				  
</tr>
</thead>
<tbody>
<?php 


require_once('ver_anexos_iris_pdf.php');


if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
				$infop=$infobus;
				$pagina=0;
				} else {
					
				$infop='';
				
	if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
	 } else {
		$pagina=0;  
	 }
				
				}
 

$query4="SELECT * from concepto, tipo_oficina where concepto.id_tipo_oficina=tipo_oficina.id_tipo_oficina and estado_concepto=1 ".$infop." ORDER BY fecha_publicacion desc ";

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_concepto'];
echo '<td title="'.$row['fuente'].' / '.$row['fecha_publicacion'].'">'.$row['radicado'].'</td>';
echo '<td>'.$row['ano'].'</td>';
echo '<td>'.$row['ubicacion'].'</td>';
echo '<td>'.$row['nombre_concepto'].'</td>';

echo '<td>'.$row['nombre_tipo_oficina'].'</td>';

echo '<td>';
if ('SISG'==$row['fuente']) {
echo '<a download="Concepto.pdf" href="https://servicios.supernotariado.gov.co/pqrs/pdf/'.$row['radicado'].'.pdf"><img src="images/pdf.png"></a>';
} else {
echo ver_anexos_iris($row['radicado']);
}


echo '</td>';


echo '<td>';

	if (1==$_SESSION['rol'] or 0<$nump87) { 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="concepto" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
						"aaSorting": [[ 1, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (1==$_SESSION['rol'] or 0<$nump87) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo concepto de OAJ</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r6544324464563m1" enctype="multipart/form-data" >

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICADO:</label> 
<input type="text" class="form-control" name="radicado"  required>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FUENTE:</label> 
<select class="form-control" name="fuente"  required>
<option></option>
<option>SISG</option>
<option>IRIS</option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> AÑO:</label> 
<input type="text" class="form-control numero" name="ano" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>TIPO DE OFICINA:</label> 
<select  class="form-control" name="id_tipo_oficina" required>
<option value="" selected></option>
<?php echo lista('tipo_oficina'); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label">UBICACIÓN:</label> 
<input type="text" class="form-control" name="ubicacion"  >
</div>

<div class="form-group text-left"> 
<label  class="control-label">ASUNTO:</label> 
<textarea class="form-control" name="nombre_concepto" ></textarea>
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


} else {}
?>




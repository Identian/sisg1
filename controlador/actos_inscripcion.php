<?php
$nump123=privilegios(123,$_SESSION['snr']);
?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3>
195</h3>
              <p>Oficinas de registro</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo existencialimitada('oficina_registro','id_oficina_registro_sismisional',1); ?></h3>

              <p>Oficinas SIR</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>
<?php echo existencialimitada('oficina_registro','id_oficina_registro_sismisional',2); ?>
			  </h3>
			 
              <p>Oficinas Folio</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $realdate; ?></h3>
              <p>Año</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-3">
  <b>Fecha actual: 
<?php 
if (isset($_POST['viernes']) && ""!=$_POST['viernes'] && (1==$_SESSION['rol'] or 0<$nump123)) {
$insertSQL = sprintf("INSERT INTO acto_inscripcion (nombre_acto_inscripcion) 
VALUES (%s)", 
GetSQLValueString($_POST["viernes"], "int"));

//GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;
} else {}



$query44r = sprintf("SELECT nombre_acto_inscripcion FROM acto_inscripcion where estado_acto_inscripcion=1 order by id_acto_inscripcion desc limit 1");
$selectregr = mysql_query($query44r, $conexion);
$row1regr = mysql_fetch_assoc($selectregr);
$fechaviernes=$row1regr['nombre_acto_inscripcion'];
mysql_free_result($selectregr);


echo $fechaviernes.'</b>';
?>

	  </div>
	  
	  
	  
	   <div class="col-md-5">
<?php
 if (1==$_SESSION['rol'] or 0<$nump123) { 
 ?>
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">

<div class="input-group-btn">
<input type="text" name="viernes" value="<?php echo $fechaviernes; ?>" class="form-control" required ></div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Crear </button> 
</div>
</div>
</form>
<?php  } else {
}
?>
</div>

<div class="col-md-4">
<select class="form-control" >
 <option value="" selected>Otras fechas</option>
<?php
echo lista('acto_inscripcion');
?>
		  </select>
	   </div>
  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
   <th>REGIONAL</th>
   <TH>DEPARTAMENTO</TH>
	<th>ORIP</th>
	<th>CIRCULO</th>
	<th>SISTEMA</th>
<th>ARCHIVO</th>	
<th>ESTADO</th>	  
</tr>
</thead>
<tbody>
<?php 

$query4="SELECT * FROM oficina_registro, region, municipio, departamento, oficina_registro_sismisional  where region.id_region=oficina_registro.id_region and municipio.id_departamento=departamento.id_departamento and oficina_registro.id_departamento=departamento.id_departamento and  oficina_registro.id_municipio=municipio.codigo_municipio and oficina_registro.id_departamento=municipio.id_departamento and  oficina_registro_sismisional.id_oficina_registro_sismisional=oficina_registro.id_oficina_registro_sismisional and estado_oficina_registro=1";

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
echo '<tr>';
echo '<td>'.$row['nombre_direccion_regional'].'</td>';
echo '<td>'.$row['nombre_departamento'].'</td>';
echo '<td>'.$row['nombre_oficina_registro'].'</td>';
echo '<td>'.$row['circulo'].'</td>';
echo '<td>'.$row['nombre_oficina_registro_sismisional'].'</td>';
echo '<td><a href="https://www.supernotariado.gov.co/actosinscripcion/'.$fechaviernes.'/'.$row['circulo'].'.pdf" target="_blank">Archivo</a> ';
echo '</td><td>';
$filename = 'https://www.supernotariado.gov.co/actosinscripcion/'.$fechaviernes.'/'.$row['circulo'].'.pdf';

$file_headers = @get_headers($filename);

if($file_headers[0] == 'HTTP/1.0 404 Not Found'){
      echo " No ";
} else if ($file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found'){
    echo " No ";
} else {
    echo " Ok ";
}



echo '</td></tr>';
 } 
 ?>

				
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





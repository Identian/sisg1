	 <?php if (2>=$_SESSION['snr_tipo_oficina']) { ?>
	


	
	
	<div class="row">
<div class="col-md-12">
  <div class="box box-info">
            <div class="box-header with-border">
              
				
				
				<?php
				
				if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infopqrs=" and ".$_POST['campo']." = '".trim($_POST['buscar'])."' ";
				$_SESSION['buscarpqrs2']=$infopqrs;
				} else {
				$_SESSION['buscarpqrs2']=" ";
				//and fecha_radi_cert>='2018-05-01'
				}

				?>
			<!--	
		<form class="navbar-form" name="form1erteg" method="post" action="">


<div class="col-md-12">

<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected>- - - Buscar por:  - - - - </option>
 		  <option value="radi_cert">Radicado de Certicamara</option>
		   <option value="expediente">Expediente del radicado</option>
		     <option value="identificacion">Identificación Ciudadano</option>
			
		  </select>
</div>
<div class="input-group-btn"><input type="text" name="buscar" placeholder="Buscar Texto" class="form-control" required ></div>
 
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
</div>

</div>



</form>-->

<b>PQRS CERTICAMARA: 13.883</b> &nbsp; &nbsp;

	 <?php  if (1==$_SESSION['rol'] or 24==$_SESSION['snr_grupo_area']) { ?>
<!--<a HREF="xls/pqrs_certicamara.xls"><img src="images/xls.png"> Reporte PQRS de Certicamara </a>-->
	&nbsp; &nbsp; &nbsp;
<a HREF="xlsx/pqrs_iris_cert.xls"><img src="images/xls.png"> Detalles de CERTICAMARA </a>
	



	<?php } else { }?>			

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>

  
            <div class="box-body">


			
              <div class="table-responsive">
                
							
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	<thead>
                    <tr>
                    <th>Radicado CERT</th>
					<th>Expediente</th>
					<th>Identificación</th>
					<th>Fecha</th>
					<th>Entrada Iris</th>
                    <th>Respuesta</th>
				    <th>Trasladada a SISG</th>
					<th>Estado</th>
					<th>Gestión Interna</th>
                     <th ></th>         
                    </tr>
                    </thead>
<tbody>
				
<?php 
$query4="SELECT * FROM radi_cert where estado_radi_cert=1 ";
$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {
?>  
<tr>
<?php
$id_res=$row['radi_cert'];

ECHO '<td>'.$row['radi_cert'].'';
ECHO '<td>'.$row['expediente'].'';
ECHO '<td>'.$row['identificacion'].'';
ECHO '<td>'.$row['fecha_radi_cert'].'';


$entradairis=$row['iris_entrada'];		
$respuestairis	=$row['iris_salida'];



	if (ISSET($row['trasladada_sisg']) && '0'!=$row['trasladada_sisg']) {
$trasladada= $row['trasladada_sisg'];
$estadoiris='Finalizada';	
	} else {
if (isset($row['iris_salida'])) {
	$trasladada= 'NO';	
	$estadoiris='Finalizada';
		} else {
$trasladada= 'NO';	
$estadoiris='En tramite';	
	}
	}
	



if (isset($row['gestion_oac']) && ''!=$row['gestion_oac']) {
$gestion_oac= 'Si';	
		} else {
$gestion_oac= 'No';
	}

$tramitar='<a href="radicado_anterior&'.$row['id_radi_cert'].'.jsp">Ver</a> ';
	

ECHO '<td>'.$entradairis.'</td>';

ECHO '<td>'.$respuestairis.'</td>';
ECHO '<td>'.$trasladada.'</td>';
ECHO '<td>'.$estadoiris.'</td>';
ECHO '<td>'.$gestion_oac.'</td>';
ECHO '<td>'.$tramitar.'</td>';
						  
?>
      
                  </tr>
                <?php } 
				

$result->free();

//mysqli_free_result();



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
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			
			
				

	 
              </div>
          
            </div>
			
		
        
          </div>
        </div>
		
		

	
	
	
</div>

	 <?php } else { } ?>


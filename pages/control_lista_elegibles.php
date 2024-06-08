<?php
$nump177=privilegios(177,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump177) {
	

function correoevioaviso() {
	
$emailu='hv.personalcurb@supernotariado.gov.co,diana.torres@supernotariado.gov.co';
$subject = 'Lista de elegibles agotada';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que se ha agotado una lista.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/control_lista_elegibles.jsp">Ver registro.</a>';
$cuerpo .= "<br><br>";
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);
	
}

?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('elegible_curaduria'); ?></h3>

              <p>Registros</p>
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
 <?php echo date('Y'); ?></h3>
			 
              <p>Año</p>
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
              <h3><?php echo existencia('curaduria'); ?></h3>
              <p>Curadurias</p>
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

	  </div>

	  
	   <div class="col-md-8">


</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">


				  <th>CONVOCATORIA</th>
				  <th>MUNICIPIO</th>
				  
				  <th>FECHA PUBLICACIÓN</th>
				  <th>FECHA VENCIMIENTO</th>

				   <th>DIAS RESTANTES</th>
				   
				    <th>DETALLES</th>
					
					<th>TOTAL</th>
				  <th>POSESIONADOS</th>
				  <th>DESISTIDOS</th>
				   <th>DISPONIBLES</th>
				   <th>ESTADO</th>
				    
</tr>
</thead>
<tbody>
<?php 

function calculartipos($tipo,$convo){
global $mysqli;
$query = "select tipo from elegible_curaduria WHERE id_municipio=".$tipo."   
and convocatoria='$convo' and estado_elegible_curaduria=1"; 
$result4 = $mysqli->query($query);
$cuenta=array();
$posesion=array();
$desistidos=array();
$restante=array();
while ($obj = $result4->fetch_array()) {
	array_push($cuenta, 1);
	if ('Posesión'==$obj['tipo']) {
	array_push($posesion, 1);
	} else if ('Desistimiento'==$obj['tipo'])  {
	array_push($desistidos, 1);
	} else {
	array_push($restante, 1);
	}
}
$todos=array_sum($cuenta);
$todosposesion=array_sum($posesion);
$todosdesistidos=array_sum($desistidos);
$todosrestante=array_sum($restante);
$res=$todos.'</td><td>'.$todosposesion.'</td><td>'.$todosdesistidos.'</td>
<td>'.$todosrestante;



if (0==$todosrestante) { 
$res.= '<td>Agotada</td>';
echo correoevioaviso();
} else { 
$res.= '<td></td>'; }





return $res;
$result4->free();
}



$query4="SELECT fecha_publicacion, convocatoria, elegible_curaduria.id_municipio, nombre_municipio, CONCAT(convocatoria, elegible_curaduria.id_municipio) AS junto, COUNT( * ) Total
FROM elegible_curaduria, municipio WHERE elegible_curaduria.id_municipio=municipio.id_municipio AND estado_elegible_curaduria=1 
GROUP BY junto
HAVING COUNT( * ) >0 
ORDER BY elegible_curaduria.id_municipio, convocatoria desc";

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php

//echo '<td>'.$row['Total'].'</td>';
echo '<td>'.$row['convocatoria'].'</td>';
echo '<td>'.$row['nombre_municipio'].'</td>';





echo '<td>'.$row['fecha_publicacion'].'</td>';

echo '<td>';

$nuevafecha = strtotime ('+3 year' , strtotime($row['fecha_publicacion']));
$fechaf= date ('Y-m-d',$nuevafecha);

 
 
$realdate=date('Y-m-d');
$fecha_actual = strtotime($realdate);

$fecha_limite = strtotime($fechaf);

if ($fecha_actual>=$fecha_limite)
	
	{
	 echo ' <b>Vencida</b> ';
 } else {}
  echo $fechaf;
  
echo '</td>';




echo '<td>';
echo calculadias($realdate,$fechaf);
echo '</td>';





echo '<td>';
echo '<a href="lista_elegibles_curadurias.jsp">Detalles</a>';
echo '</td>';


echo '<td>';
echo calculartipos($row['id_municipio'],$row['convocatoria']);
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



<?php
} else {}
?>
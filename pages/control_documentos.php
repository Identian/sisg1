<?php
$nump12=privilegios(12,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump12) {

?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('documento_funcionario'); ?></h3>

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
	  

		  		
<table  class="table display table-bordered" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
<tr align="center" valign="middle">
<th>Curaduria</th>
<th>Usuario</th>
<th>Perfil</th>
 <th>Tipo</th>
 <th>Subtipo</th>
 <th>Lab. Actual</th>
 <th>Nivel académico</th>
<th>Documento</th>
<th>Archivo</th>
<th>Tipo</th>
<th>Fecha</th> 		
<th>Tipo experiencia</th> 	 
<th>Estado</th>  
<th></th> 
</tr>
</thead>
<tbody>
<?php 

$array=array();
$arrayp=array();
$profesional=array();
$relacionada=array();

$query4="select * from funcionario, documento_funcionario, tipo_adjunto, tipo_subadjunto 
where funcionario.id_funcionario=documento_funcionario.id_funcionario and funcionario.id_tipo_oficina=4 and 
tipo_adjunto.id_tipo_adjunto=tipo_subadjunto.id_tipo_adjunto and documento_funcionario.id_tipo_subadjunto=tipo_subadjunto.id_tipo_subadjunto and documento_funcionario.id_tipo_adjunto=tipo_subadjunto.id_tipo_adjunto and estado_documento_funcionario=1 ";
$result = $mysqli->query($query4);

$espe='';

while($row = $result->fetch_array()) {
	
$iddoc=$row['id_documento_funcionario'];
$i=$row['id_documento_funcionario'];
$idfunci=$row['id_funcionario'];

if (1==$row['id_cargo']) {
	$carg='Curador';
	
$namecuraduria=curaduriacurador($idfunci);	
} else {
	$carg='Equipo';

$namecuraduria=curaduriaequipo($idfunci);	
}


echo '<tr>';
echo '<td>'.$namecuraduria.'</td>';
echo '<td><a href="usuario&' .$idfunci.'.jsp" target="_blank">' .$row['nombre_funcionario'].'</a></td>';
echo '<td>';
echo $carg; 
 echo '</td>';

echo '<td>' .$row['nombre_tipo_adjunto']. '</td>';
echo '<td>' .$row['nombre_tipo_subadjunto']. ' </td>';
echo '<td>' .$row['labora_actualmente']. ' </td>';
echo '<td>';
if (isset($row['id_nivel_academico'])) {
	$nivelaca=quees('nivel_academico',$row['id_nivel_academico']);
	echo $nivelaca;
	
	if (9==$row['id_nivel_academico']) {
		$espe.=1;
	} else {
		$espe.=0;
	}
	
} else {
}
echo '</td>';

echo '<td>' . $row['nombre_documento_funcionario'] . '</td>';

echo '<td><a href="filesnr/documentos/' . $row['url_documento'] . '" target="_blank"><i class="fa fa-file-pdf-o"></i> Leer </a></td>';            

	
echo '<td>';

$tcert=$row['tipo_certificacion'];
echo $tcert;
echo '</td>';
	
			  
 echo '<td><span style="color:#999;">';

if ('Tarjeta profesional'==$row['nombre_tipo_subadjunto']) {
	echo $fechatarjetap;
} else {

echo ''.$row['fecha_inicial'] . ' ' . $row['fecha_documento'] . '</span> <br>';

              if (isset($row['fecha_inicial']) && isset($row['fecha_documento'])) {
                echo ' (';
                $ani= calculatiempo($row['fecha_inicial'], $row['fecha_documento']);
                echo $ani.' Años.)';
              } else if (isset($row['fecha_documento'])) {
                echo ' (';
                $ani= calculaedad($row['fecha_documento']);
                echo $ani.' Años.)';
              } else {
              }
			  
}
			  
			  
	echo '</td>';		  
			

echo '<td>';

if (13==$row['id_tipo_adjunto'] && (10==$row['id_tipo_subadjunto'] or 25==$row['id_tipo_subadjunto'])) {
	
If (isset($row['computa']) && 1==intval($row['estado_rev'])) {
If ('Si'==$row['computa']) {
	echo 'Experiencia relacionada';
	array_push($relacionada, $ani);
} else {
echo 'Experiencia profesional';
	array_push($profesional, $ani);
}
} else {}

} else {}
echo '</td>';


echo '<td>';
if (1==intval($row['estado_rev'])) {
	echo '<span class="fa fa-check" title="'.$row['fecha_rev'].'">Aprobado</span>';
	
	If ('Público'==$tcert) {
	array_push($array, $ani);
	} else {
	array_push($arrayp, $ani);
	}
} elseif (2==intval($row['estado_rev'])) {
   echo '<span class="fa fa-times" title="'.$row['fecha_rev'].'"> Rechazado</span> ';
   
   echo $row['rechazo'];
   
} else {
	
	//<option value="13-10">Certificados Laborales</option>
	if (13==$row['id_tipo_adjunto'] && (10==$row['id_tipo_subadjunto'] or 25==$row['id_tipo_subadjunto'])) {
		$tipodocu=0;
	} else {
		$tipodocu=1;
	}
	
	if (1==$_SESSION['rol'] or 0<$nump12) {
//echo '<a href="" title="Revisar '.$iddoc.'" id="'.$iddoc.'" name="'.$tipodocu.'" class="ver_revision_documento" data-toggle="modal" data-target="#popuprevisiondocumento"><button class="btn btn-xs btn-info">
//<span class="fa fa-file"></span> Revisar</button></a> ';
	} else {}


}
echo '</td>';

			
echo '<td>';

//echo  '<a href="documentos&'.$idfunci.'.jsp">Revisar</a>';
if (100==$_SESSION['rol']) {
	 echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_funcionario" id="'.$i.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else {}

echo '</td>';
echo '</tr>';


 } 
 
 $result->free();
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
			
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->



<?php
} else {}
?>
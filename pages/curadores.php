<?php
$nump111=privilegios(111,$_SESSION['snr']);


if (2>$_SESSION['snr_tipo_oficina']) { 

function enviomes($idsitua,$idcuradu) {
	
$emailur2='norma.calderon@supernotariado.gov.co,diana.torres@supernotariado.gov.co';
$subject = 'Alerta de fecha proxima en situación de un curador';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que falta menos de un mes para la terminación de la situación administrativa de un Curador.<br><br>';

$cuerpo2 .= '<a href="https://sisg.supernotariado.gov.co/curaduria&'.$idcuradu.'.jsp">Ver el registro</a><br><br>'; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);


global $mysqli;
$query887 = "UPDATE situacion_curaduria SET correo_unmes=1 WHERE id_situacion_curaduria=".$idsitua."";  
$result44 = $mysqli->query($query887);

}


function envioano($idsitua,$idcuradu) {
	
$emailur2='santiago.campo@supernotariado.gov.co,diana.torres@supernotariado.gov.co';
$subject = 'Alerta de fecha proxima en situación de un curador';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que falta menos de un año para la terminación de la situación administrativa de un Curador.<br><br>';

$cuerpo2 .= '<a href="https://sisg.supernotariado.gov.co/curaduria&'.$idcuradu.'.jsp">Ver el registro</a><br><br>'; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);


global $mysqli;
$query887 = "UPDATE situacion_curaduria SET correo_unano=1 WHERE id_situacion_curaduria=".$idsitua."";  
$result44 = $mysqli->query($query887);

}



?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('curaduria'); ?></h3>

              <p>Curadurias</p>
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
              <h3><?php echo existencia('relacion_curaduria'); ?></h3>

              <p>Personal de curadurias</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="xls/personal_curadurias.xls" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3><?php echo existencia('situacion_curaduria'); ?></h3>
			  
              <p>Registros de situaciones</p>
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
              <h3><?php echo $realdate; ?></h3>
              <p>Fecha</p>
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
  
  
  
  <div class="col-md-12">
 
  
<h3>Curadores</h3>
  

	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>CURADURIA</th>
<th>CURADOR</th>
<th>TIPO DE ACTO</th>
<th>NÚMERO DE ACTO</th>
<th>NOMBRAMIENTO</th>
<th>POSESION</th>
<th>FECHA-TERMINACION</th>
<th></th>
<th style="width:100px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 




$query4="SELECT * FROM curaduria, situacion_curaduria, funcionario, tipo_acto where situacion_curaduria.id_funcionario=funcionario.id_funcionario and 
curaduria.id_curaduria=situacion_curaduria.id_curaduria and 
fecha_terminacion>='$realdate' and situacion_curaduria.id_tipo_acto=tipo_acto.id_tipo_acto and estado_situacion_curaduria=1 and estado_curaduria=1";

$result = $mysqli->query($query4);
while($rowcc = $result->fetch_array()) {

echo '<tr>';
echo '<td title="'.$rowcc['id_situacion_curaduria'].'">'.$rowcc['nombre_curaduria'].'</td>';
echo '<td>';
echo $rowcc['nombre_funcionario'];
echo '</td>';
echo '<td>'.$rowcc['nombre_tipo_acto'].'</td>';
echo '<td>'.$rowcc['nombre_situacion_curaduria'].'</td>';
echo '<td>'.$rowcc['fecha_nombramiento'].'</td>';
echo '<td>'.$rowcc['fecha_acta_posesion'].'</td>';
echo '<td>';

	echo $rowcc['fecha_terminacion'];

$menos30 = date('Y-m-d', strtotime('-30 day', strtotime($rowcc['fecha_terminacion'])));
$menos1 = date('Y-m-d', strtotime('-1 year', strtotime($rowcc['fecha_terminacion'])));

//echo ' / '.$menos30.' / ';
//echo $menos1;

if ($realdate>=$menos30 && !isset($rowcc['correo_unmes'])) {
	//echo 'correo mes';
echo enviomes($rowcc['id_situacion_curaduria'],$rowcc['id_curaduria']);
} else { }


if ($realdate>=$menos1 && !isset($rowcc['correo_unano'])) {
	//echo 'correo año';
	echo envioano($rowcc['id_situacion_curaduria'],$rowcc['id_curaduria']);
} else { }



echo '</td>';

echo '<td style="width:70px;">';

if (isset($rowcc['url_nombramiento'])) {
	echo '  &nbsp; <a title="Decreto de nombramiento" href="filesnr/curadurias/'.$rowcc['url_nombramiento'].'" ><span class="fa fa-file" ></span></a> &nbsp; ';
} else {}

if (isset($rowcc['url_posesion'])) {
	echo '  &nbsp; <a title="Acta de posesion" href="filesnr/curadurias/'.$rowcc['url_posesion'].'" ><span class="fa fa-file" style="color:#C5903D;"></span></a> &nbsp; ';
} else { }
	echo '</td>';



echo '<td>';

echo '<a href="curaduria&'.$rowcc['id_curaduria'].'.jsp"><span class="fa fa-home" style="color:#B40404"></span></a> ';


echo '<a href="usuario&'.$rowcc['id_funcionario'].'.jsp"><span class="fa fa-user"></span></a> ';

echo '<a  href="documentos&'.$rowcc['id_funcionario'].'.jsp"><span class="glyphicon glyphicon-file" style="color:#E08E0B;"></span></a> ';



  
  echo '</td></tr>';
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
						"aaSorting": [[ 6, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php 


} else {} ?>




<?php
$nump81=privilegios(81,$_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump81) {
?>
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
<div class="col-md-9">
 <b>Validación de Notarias</b>
  <ol>
  	<li><a href="https://www.supernotariado.gov.co/files/portal/portal-anexotecnico4deenero.pdf">Anexo t&eacute;cnico- Digitalizaci&oacute;n Notarial.</a></li>
	<li><a href="https://www.supernotariado.gov.co/files/portal/portal-ws_rep_not_1_2.pdf">Anexo t&eacute;cnico- Repositorio Notarial&nbsp;V1.2</a></li>
	<li><a href="https://www.supernotariado.gov.co/files/portal/portal-actos_tiposdocumentos_repositorio.xlsx">Listados de codificación</a></li>
	<li><a href="https://www.supernotariado.gov.co/files/resoluciones/res-254-20210104191042.pdf">Resoluci&oacute;n No. 11 de 2021, Directrices a trav&eacute;s de medios electr&oacute;nicos</a></li>
	<li><a href="https://www.supernotariado.gov.co/files/resoluciones/res-254-20210104183245.pdf">Resoluci&oacute;n No. 12 de 2021, Pautas para la transferencia de la copia del archivo digital</a></li>
<!--	<li><a href="https://www.supernotariado.gov.co/files/resoluciones/res-254-20210104191149.pdf">Resoluci&oacute;n No. 13 de 2021-Por el cual se define la copia simple y se establece su tarifa</a></li>
--></ol>
 
</div>

<div class="col-md-3">
Videos:
<br>
<a href="https://www.youtube.com/watch?v=mARYA5s2fIg" target="_blank">Video 1</a>
<br>
<a href="https://www.facebook.com/JurisURosario/videos/1104547296706542/" target="_blank">Video 1</a>

<br>
<a href="https://www.youtube.com/watch?v=txhwiL-eTnk" target="_blank">Video 3</a>



</div>

</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
		
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
<tr align="center" valign="middle">
<th>Departamento</th>
<th>Notaria</th>

<th>Fecha de validación</th>
<th>Url</th>
<th>Validado</th>
<th>Resolución</th>
<th>Fecha Res.</th>
<th>Proveedor</th>
<th>Documentos</th>
<th style=""></th>	  
</tr>
</thead>
<tbody>
<?php 

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
 



$query4="SELECT * from resp_val_not_digital, notaria, departamento where notaria.id_departamento=departamento.id_departamento and resp_val_not_digital.id_notaria=notaria.id_notaria and fecha_solicitud is not null and estado_resp_val_not_digital=1 ORDER BY orden_cita desc";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {



echo '<tr title="">';
$id=$row['id_resp_val_not_digital'];
echo '<td>'.$row['nombre_departamento'].'</td>';
echo '<td>'.$row['nombre_notaria'].'</td>';

echo '<td>'.$row['fecha_validacion'].'</td>';
echo '<td>'.$row['url'].'</td>';
echo '<td>'.$row['cump_val_digitalizacion'].'</td>';

echo '<td>'.$row['resolucion_autorizacion'].'</td>';
echo '<td>'.$row['fecha_resolucion'].'</td>';

echo '<td>'.$row['proveedor'].'</td>';
echo '<td>';


$queryr = sprintf("SELECT * FROM doc_resp_val_not_digital where id_resp_val_not_digital=".$id." and estado_doc_resp_val_not_digital=1 order by id_doc_resp_val_not_digital"); 
$selectr = mysql_query($queryr, $conexion);
$rowr = mysql_fetch_assoc($selectr);
$totalRowsr = mysql_num_rows($selectr);
if (0<$totalRowsr){
do {
echo '<a href="filesnr/digitalizacion/'.$rowr['url'].'" target="_blank" title="'.$rowr['nombre_doc_resp_val_not_digital'].'"><i class="fa fa-file-pdf-o" ';
if ('Resolución de permiso para la prestación del servicio público notarial a través de medios electrónicos'==$rowr['nombre_doc_resp_val_not_digital']) {
echo 'style="color:#ff0000" ';	
} else {
	
}


echo '></i></a> ';
	 } while ($rowr = mysql_fetch_assoc($selectr)); 
} else {}	 
mysql_free_result($selectr);


echo '</td>';
echo '<td>';
echo ' <a href="digitalizacion_notarial&'.$row['id_notaria'].'.jsp" target="_blank"><span class="glyphicon glyphicon-edit"></span></a>';
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
						"aaSorting": [[ 2, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php } else { }?>




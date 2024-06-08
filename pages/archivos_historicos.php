<?php
$nump73=privilegios(73,$_SESSION['snr']);

if ((isset($_POST["id_archivo"])) && ($_POST["id_archivo"] != "")) { 

$updateSQL = sprintf("UPDATE archivo SET fecha_publicacion=%s, nombre_archivo=%s, numero_archivo=%s, 
 id_normatividad=%s, codificado=1 where id_archivo=%s and estado_archivo=1",
GetSQLValueString($_POST["fecha_publicacion"], "date"),
 GetSQLValueString($_POST["nombre_archivo"], "text"), 
 GetSQLValueString($_POST["numero_archivo"], "int"), 
 GetSQLValueString($_POST["id_normatividad"], "int"), 
 GetSQLValueString($_POST["id_archivo"], "int")
 );
$Result = mysql_query($updateSQL, $conexion);
echo $actualizado;
} else { }

?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('archivo'); ?></h3>

              <p>Cantidad de archivos</p>
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
 0</h3>
			 
              <p>Documentos registrados hoy</p>
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
              <h3>9</h3>
              <p>Tipos de documentos</p>
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
Documentos historicos
	  </div>
	  
	  
	  
	   <div class="col-md-8">
	
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">Buscar 
<select class="form-control" name="campo" required>
          <option value="" selected> - - Tipo: - -  </option>
<option value="1">Autos</option>
<option value="2">Circulares</option>
<option value="3">Conceptos</option>
<option value="4">Decretos</option>
<option value="5">Instrucciones</option>
<option value="6">Memos</option>
<option value="7">Notificaciones</option>
<option value="8">Resoluciones</option>
<option value="9">Sentencias</option>
<option value="10">OAC</option>
		  </select>
</div>
<div class="input-group-btn">
<input type="text" name="buscar" placeholder="Palabra clave" class="form-control" required >
</div>
   
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>

</form>


</div>

  
  
</div> <!-- FINAL box-header with-border -->

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
				  
				  <th>FECHA</th>
				  <th>AÑO</th>
				  <th>NÚMERO</th>
				  <th>TIPO</th>
				  <th>ASUNTO</th>
<th style="width:50px;"></th>
				  
</tr>
</thead>
<tbody>
<?php 

if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infobus=" and id_normatividad=".$_POST['campo']." and (nombre_archivo like '%".$_POST['buscar']."%' or url like '%".$_POST['buscar']."%') ";
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
 

$query4="SELECT * from archivo where estado_archivo=1 ".$infop." ORDER BY fecha_publicacion desc limit 3000";

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_archivo'];

echo '<td>'.$row['fecha_publicacion'].'</td>';

$fechass = strtotime($row['fecha_publicacion']);


echo '<td>'.date("Y", $fechass).'</td>';
echo '<td>'.$row['numero_archivo'].'</td>';
echo '<td>'.ucfirst($row['tipo']).'</td>';
echo '<td>';
$resul=intval($row['codificado']);
if (0==$resul) {
echo ''.utf8_encode($row['nombre_archivo']);
} else {
	echo ''.$row['nombre_archivo'];
}
echo '</td>';
echo '<td>';
echo ' <a href="files/content/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';

	if (1==$_SESSION['rol'] or 0<$nump73) { 
	
		
	echo ' <a href="" class="buscararchivo" id="'.$id_res.'" title="'.$id_res.'" data-toggle="modal" data-target="#popupbuscararchivo"><span class="fa fa-edit"></span></a> &nbsp; ';
	
	//echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="archivo" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	
	
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




<div class="modal fade" id="popupbuscararchivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar</b></h4>
</div> 
<div class="ver_buscararchivo" class="modal-body"> 

</div>
</div> 
</div> 
</div>

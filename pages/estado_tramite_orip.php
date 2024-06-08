<?php
$nump98=privilegios(98,$_SESSION['snr']);


if (isset($_POST['fecha'])){ 
$fechan=$_POST['fecha'];
 } else {
$fechan=date('Y-m-d');  
 } 





if ((isset($_POST["archivo"])) && ($_POST["archivo"] != "") && (1==$_SESSION['rol'] or 0<$nump98)) {




$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('csv');


$directoryftp="files/instruccion_admin/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = $identi;

$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
}
}
}

           
                $filename = $directoryftp.$ruta_archivo.'.csv';
                  $handle = fopen($filename, "r");

                  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                    $aa = $data[0];
                    $bb = intval($data[1]);
                    $cc = intval($data[2]);
                    $dd = intval($data[3]);
                    $ee = intval($data[4]);
               //   echo $aa.'-'.$bb.'-'.$cc.'-'.$dd.'-'.$ee.'<br>';

      		  
				  
$insertSQL = sprintf("INSERT INTO estado_tramite_orip (circulo_orip, 
n_abogados,  n_tramites, pendientes_reparto, pendientes_calificar, fecha_subida, estado_estado_tramite_orip) 
VALUES (%s, %s, %s, %s, %s, now(), %s)", 
GetSQLValueString($aa, "text"), 
GetSQLValueString($bb, "int"), 
GetSQLValueString($cc, "int"), 
GetSQLValueString($dd, "int"), 
GetSQLValueString($ee, "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) ;



                  
                  }
                  //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
                  fclose($handle);
                  //echo $masivocargado;
                  //echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id.'.jsp" />';
              
            
			  




echo $insertado;
   


   
}
 else { 
 echo '';
 
 }

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3>
			  <?php	  
$query4h = sprintf("SELECT count(id_estado_tramite_orip) as tot FROM estado_tramite_orip where 
estado_estado_tramite_orip=1 
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['tot'];
$result4h->free();
 echo $reshh;
			  ?></h3>
              <p>Cantidad de registros</p>
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
              <h3> <?php	  
$query4h = sprintf("SELECT sum(n_abogados) as imp FROM estado_tramite_orip where 
estado_estado_tramite_orip=1 
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['imp'];
$result4h->free();
 echo $reshh;
			  ?></h3>

              <p>Abogados</p>
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
  <?php	  
$query4h = sprintf("SELECT sum(n_tramites) as imp FROM estado_tramite_orip where 
estado_estado_tramite_orip=1
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['imp'];
$result4h->free();
 echo $reshh;
			  ?>
			  </h3>
			 
              <p>Tramites</p>
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
              <h3>195</h3>
              <p>Orip</p>
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
  
  
  
  <div class="col-md-6">
<?php 



 if (1==$_SESSION['rol'] or 0<$nump98) { ?>
  
   
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-6">

	



</div>


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th>Fecha</th>
 <th>Circulo</th>
<TH>Abogados</TH>
<TH>Promedio diario</TH>
<TH>Pendientes reparto</TH>	
<TH>Pendientes Calificar</TH>
<th>Capacidad</th>	
<th>Diferencia</th>		
<th>Remanente</th>	
<th>Porcentaje estado</th>
<th>Estado</th>
<th></th>			  
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
 





$query4="SELECT * from estado_tramite_orip where estado_estado_tramite_orip=1 ";


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_estado_tramite_orip'];
echo '<td>'.$row['fecha_subida'].'</td>';
echo '<td>'.$row['circulo_orip'].'</td>';
$abogados=$row['n_abogados'];
echo '<td>'.$abogados.'</td>';
echo '<td>'.$row['n_tramites'].'</td>';
echo '<td>'.$row['pendientes_reparto'].'</td>';
echo '<td>'.$row['pendientes_calificar'].'</td>';
$capacidad=27*$abogados;
echo '<td>'.$capacidad.'</td>';

$diferencia=$capacidad-$row['n_tramites'];
echo '<td>'.$diferencia.'</td>';


$remanente=$diferencia+$row['pendientes_reparto']+$row['pendientes_calificar'];
echo '<td>'.$remanente.'</td>';

$porestado=intval(($remanente*100)/$capacidad);
echo '<td>'.$porestado.' %</td>';

if (301<=$porestado) {
$resultado='<b style="color:#ff0000;">Critico</b>';
} else if (201<=$porestado && 301>$porestado) {
	$resultado='<b style="color:#F39C3F;">Alto</b>';
} else if (101<=$porestado && 201>$porestado) {
	$resultado='<b style="color:#F8C446;">Medio</b>';
} else if (1<=$porestado && 101>$porestado) {
	$resultado='<b style="color:#3F8E4D;">Bajo</b>';
} else {
	$resultado='';
}
	
	
echo '<td>'.$resultado.'</td>';



echo '<td>';
	if (1==$_SESSION['rol'] or 0<$nump98) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="estado_tramite_orip" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	
?>
</td>
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


 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo Archivo</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54364563m1" enctype="multipart/form-data">
 <div class="form-group text-left"> 
#Circulo;Abogados;Promedio diario;Pendientes reparto;Pendientes calificar
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Archivo CSV:</label> 
<input type="file" class="form-control" name="file" required>
</div>




<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="archivo" value="1">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>


<?php //} else { }?>




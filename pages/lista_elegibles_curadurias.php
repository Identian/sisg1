<?php
$nump177=privilegios(177,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump177) {

if ((isset($_POST["id_elegible_curaduriatt"])) && (""!=$_POST["id_elegible_curaduriatt"])) {
$idcur=intval($_POST["id_elegible_curaduriatt"]);

	
$tamano_archivo=17301504;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/listaelegibles/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'listaelegibles-'.$_SESSION['snr'].''.date("YmdGis");

$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  

   
  } else {
$files='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
  }
} else { 
$files='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}
		
	
} else { 
$files='';	
	}	
  
	
	
	
	
$insertSQL2 = sprintf("update elegible_curaduria set elegible=%s, tipo=%s, porcentaje=%s, 
convocatoria=%s, municipio=%s, url=%s, fecha_publicacion=%s where id_elegible_curaduria=%s ", 
GetSQLValueString($_POST["cedula"], "int"), 
GetSQLValueString($_POST["tipo"], "text"), 
GetSQLValueString($_POST["porcentaje"], "text"),
GetSQLValueString($_POST["convocatoriat"], "text"), 
GetSQLValueString($_POST["municipio"], "text"),
GetSQLValueString($files, "text"),
GetSQLValueString($_POST["fecha"], "date"),
GetSQLValueString($idcur, "int"));
$Result = mysql_query($insertSQL2, $conexion);
  echo $actualizado;
  
} else {}




if ((isset($_POST["convocatoria"])) && (""!=$_POST["convocatoria"])) {
$insertSQL = sprintf("INSERT INTO elegible_curaduria (
elegible, tipo, porcentaje, convocatoria, id_municipio, fecha_publicacion, estado_elegible_curaduria) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["cedula"], "int"), 
GetSQLValueString($_POST["tipo"], "text"), 
GetSQLValueString($_POST["porcentaje"], "text"),
GetSQLValueString($_POST["convocatoria"], "text"), 
GetSQLValueString($_POST["id_municipio"], "int"),
GetSQLValueString($_POST["fecha"], "date"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);


  echo $insertado;
  
} else {}
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

  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  </div>

	  
	   <div class="col-md-8">


</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th>CEDULA</th>
  <th>RESULTADO</th>
  <th></th>
  <th>INFORMACIÓN</th>
				  <th>PORCENTAJE</th>
				  <th>CONVOCATORIA</th>
				  <th>MUNICIPIO</th>
				  <th>FECHA PUBLICACIÓN</th>
				  <th>FECHA VENCIMIENTO</th>

				   <th>DIAS RESTANTES</th>
				   <th style="width:100px;"></th>
</tr>
</thead>
<tbody>
<?php 


$query4="SELECT * from elegible_curaduria, municipio where elegible_curaduria.id_municipio=municipio.id_municipio and estado_elegible_curaduria=1 ";

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php

echo '<td>'.$row['elegible'].'</td>';
echo '<td>'.$row['tipo'].'</td>';

if (isset($row['url']) && ""!=$row['url']) {
echo '<td><a href="filesnr/listaelegibles/'.$row['url'].'" target="_blank">Acto</a></td>';
} else {
	echo '<td></td>';
}


echo '<td>';
echo quenombreporcedula($row['elegible']);
echo '</td>';
echo '<td>'.$row['porcentaje'].'</td>';
echo '<td>'.$row['convocatoria'].'</td>';
echo '<td>'.$row['nombre_municipio'].'</td>';
echo '<td>'.$row['fecha_publicacion'].'</td>';

echo '<td>';

$nuevafecha = strtotime ('+3 year' , strtotime($row['fecha_publicacion']));
$fechaf= date ('Y-m-d',$nuevafecha);
 echo $fechaf;
echo '</td>';

echo '<td>';
echo calculadias($realdate,$fechaf);
echo '</td>';

echo '<td style="width:100px;">';

echo  '<a href="" title="Actualizar" id="'.$row['id_elegible_curaduria'].'" class="ver_listaelegible" data-toggle="modal" data-target="#popuplistaelegible"><button class="btn btn-xs btn-warning">Act</button></a> ';
		

echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$row['id_elegible_curaduria'].'" name="elegible_curaduria" id="'.$row['id_elegible_curaduria'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

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
						"aaSorting": [[ 2, "desc"]]
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
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nueva lista de elegible</h4>
      </div>
      <div class="modal-body">
    
    
<form action="" method="POST" name="for5435353454r65464563m1" enctype="multipart/form-data" >


<div class="form-group text-left"> 
<label  class="control-label">Cedula:</label> 
<input type="text" class="form-control numero" name="cedula"  >
</div>


<div class="form-group text-left"> 
<label  class="control-label">Tipo de resultado:</label> 
<select class="form-control " name="tipo" >
<option value="" selected></option>
<option>Posesión</option>
<option>Desistimiento</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Porcentaje:</label> 
<input type="text" class="form-control" name="porcentaje"  >
</div>


<div class="form-group text-left"> 
<label  class="control-label">Convocatoria:</label> 
<input type="text" class="form-control " name="convocatoria"  >
</div>



<div class="form-group text-left"> 
<label  class="control-label">Municipio:</label> 
<select class="form-control " name="id_municipio" >
<option value="" selected></option>


<?php

$query5 = "SELECT * FROM municipio where id_municipio 
in (819, 851, 126, 19, 149, 845, 1011, 468, 1005, 150, 1017, 478, 779, 835, 227, 47, 877, 486, 488, 880, 1012, 958, 59, 1026, 319, 1, 429, 515, 604, 1031, 715, 831, 905, 362, 139, 85, 656, 932, 544, 293, 145, 558, 1040, 196, 404, 686, 1054, 1045) 
 order by nombre_municipio";
$result5 = $mysqli->query($query5);
while ($row25 = $result5->fetch_array()) {
echo '<option value="'.$row25['id_municipio'].'">'.$row25['nombre_municipio'].'</option>';
    }
$result5->free();
?>


</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label">Fecha de publicación:</label> 
<input type="text" class="form-control datepicker" name="fecha"  >
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









 <div class="modal fade" id="popuplistaelegible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Actualizar lista de elegible</h4>
      </div>
      <div id="ver_lista_elegibles">
    

      </div>
    </div>
  </div>
</div>

<?php
} else {}
?>
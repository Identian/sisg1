<?php
$nump115=privilegios(115,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 0<$nump115) { 

if(isset($_POST['nombre_entidad_reparto2']) && ""!=$_POST['nombre_entidad_reparto2']) {
  $updateSQL = sprintf("UPDATE entidad_reparto SET nombre_entidad_reparto=%s, tipo=%s, tipo_entidad=%s,  correo_entidad=%s, 
  direccion_entidad=%s, nit_entidad=%s, exento=%s WHERE id_entidad_reparto=%s and estado_entidad_reparto=1",
                  
					   GetSQLValueString($_POST["nombre_entidad_reparto2"], "text"),
					   GetSQLValueString($_POST["tipo2"], "text"),
					   GetSQLValueString($_POST["tipo_entidad2"], "int"),
					   GetSQLValueString($_POST["correo_entidad2"], "text"),
					   GetSQLValueString($_POST["direccion_entidad2"], "text"),
				       GetSQLValueString($_POST['nit_entidad2'], "text"),
				       GetSQLValueString($_POST['exento2'], "int"),
					   GetSQLValueString($_POST["id_entidad_reparto2"], "int"));
  $Result1 = mysql_query($updateSQL, $conexion);
  echo $actualizado;
} else {}



if ((isset($_POST["nombre"])) && (""!=$_POST["nombre"]) && (1==$_SESSION['rol']) or 0<$nump115) {
$insertSQL = sprintf("INSERT INTO entidad_reparto (
nombre_entidad_reparto, tipo, tipo_entidad, correo_entidad, direccion_entidad, nit_entidad, exento, estado_entidad_reparto) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST['nombre'], "text"),
GetSQLValueString($_POST['tipo'], "text"),
GetSQLValueString($_POST['tipo_entidad'], "int"),
GetSQLValueString($_POST['correo_entidad'], "text"),
GetSQLValueString($_POST['direccion_entidad'], "text"),
GetSQLValueString($_POST['nit_entidad'], "text"),
GetSQLValueString($_POST['exento'], "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;
} else { }

 
 
 if ((isset($_POST["nombre_permiso_entidad_reparto"])) && (""!=$_POST["nombre_permiso_entidad_reparto"]) && (1==$_SESSION['rol']) or 0<$nump115) {
$insertSQL2 = sprintf("INSERT INTO permiso_entidad_reparto (
nombre_permiso_entidad_reparto, fecha_permiso, id_entidad_reparto, cedula_ciudadano, estado_permiso_entidad_reparto) 
VALUES (%s, now(), %s, %s, %s)", 
GetSQLValueString($_POST['nombre_permiso_entidad_reparto'], "text"),
GetSQLValueString($_POST["id_entidad_reparto3"], "int"),
GetSQLValueString($_POST['cedula_ciudadano'], "int"),
GetSQLValueString(1, "int"));
$Result2 = mysql_query($insertSQL2, $conexion);
echo $insertado;
} else { }



?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('entidad_reparto'); ?></h3>

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
            <a href="https://sisg.supernotariado.gov.co/xls/reparto_notarial.xls" class="small-box-footer">Descargar reporte <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3><?php echo existencia('notaria'); ?></h3>
			  
              <p>Notarias</p>
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
              <h3>195</h3>
              <p>Oficinas de registro</p>
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
 

  
<?php  if (1==$_SESSION['rol'] or 0<$nump115) { // or 3>$_SESSION['snr_tipo_oficina']?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> 
	  
	  
	 <?php if (isset($_GET['i'])) { 
	 echo ' / ';
//echo quees('oficina_registro',$idorip);
 } else {
 
 } 
 ?>
	  </h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Nombre</th>
 <th>Nit</th>
 <th>Tipo</th>
  <th>Territorial</th>
 <th>Correo</th>
<th>Dirección</th>
<th>Cedulas Acceso</th>
<th>Excento</th>
				 	
<th style="width:120px;"></th>		  
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
 



$query4="SELECT * from entidad_reparto where estado_entidad_reparto=1 and id_entidad_reparto!=1293  ORDER BY nombre_entidad_reparto "; //LIMIT 500 OFFSET ".$pagina."

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_entidad_reparto'];
echo '<td>';
echo $row['nombre_entidad_reparto'];
echo '</td>';
echo '<td>';
echo $row['nit_entidad'];
echo '</td>';
echo '<td>'.$row['tipo'].'</td>';

echo '<td>';

if (1==$row['tipo_entidad']) {
	echo 'Si';
} else {
	echo 'No';
}

echo '</td>';


echo '<td>';


$str = str_replace(",", ",<br>", $row['correo_entidad']);
echo $str;

echo '</td>';
echo '<td>';
echo $row['direccion_entidad'];
echo '</td>';

echo '<td>';
$query2 = sprintf("SELECT * FROM permiso_entidad_reparto where id_entidad_reparto=".$id_res." and estado_permiso_entidad_reparto=1 "); 
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
$totalRows2 = mysql_num_rows($select2);
if (0<$totalRows2){
do {
	$idper=$row2['id_permiso_entidad_reparto'];
	
	echo ''.$row2['cedula_ciudadano'].' ';
	echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="permiso_entidad_reparto" id="'.$idper.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
echo '<br>';
	 } while ($row2 = mysql_fetch_assoc($select2)); 
} else {}	 
mysql_free_result($select2);
echo '</td>';



echo '<td>';


if (1==$row['exento']) {
	echo 'Si';
} else {
	echo 'No';
}

echo '</td><td> <a href="" class="buscar_entidadreparto" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizarentidad_reparto"> <span class="btn btn-xs btn-warning">Actualizar</span></a> ';


echo ' <a href="reparto&'.$id_res.'.jsp"><span class="btn btn-xs btn-info">Proyectos</span></a> ';


	if (1==$_SESSION['rol']) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="entidad_reparto" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

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
						"aaSorting": [[ 0, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (1==$_SESSION['rol']  or 0<$nump115) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r653454345345464324324563m1"  >


 
 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre de la entidad:</label> 
<input type="text" class="form-control" name="nombre" value="" required>
</div>



 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nit de la entidad:</label> 
<input type="text" class="form-control" name="nit_entidad" value="">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo:</label> 
<input type="text" class="form-control"  name="tipo"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Es entidad territorial:</label> 
<select type="text" class="form-control"  name="tipo_entidad"  required>
<option value="" selected></option>
<option value="1">Si</option>
<option value="0">No</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Correo electrónico: (Separado por ,)</label> 
<input type="text" class="form-control"  name="correo_entidad"  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dirección:</label> 
<input type="text" class="form-control"  name="direccion_entidad"  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Exento:</label> 
<select type="text" class="form-control"  name="exento"  required>
<option value="" selected></option>
<option value="1">Si</option>
<option value="0">No</option>
</select>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="instruccion_admin">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="popupactualizarentidad_reparto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar</b></h4>
</div> 
<div id="ver_entidadreparto" class="modal-body"> 

</div>
</div> 
</div> 
</div>



	  



<?php } else { }


} else {} ?>




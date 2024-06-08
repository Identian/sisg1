<?php
$nump169=privilegios(169,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump169) { 


if (1==$_SESSION['rol'] && isset($_POST['id_area'])) { 
$id_area=$_POST['id_area'];
} else {
$id_area=$_SESSION['snr_area'];	
}



if (11==$id_area) {
$idoficina=27;		 
} else {
$idoficina=$id_area;
}



$arraydd=array(5, 6, 9, 10, 11, 26, 27);
 
 if (1==$_SESSION['rol'] or in_array($id_area, $arraydd)) {
					 



if (isset($_POST['actualizar_id_tipo_visita']) && ""!=$_POST['actualizar_id_tipo_visita'] && 2>$_SESSION['snr_tipo_oficina']) {
	
$updated = sprintf("UPDATE tipo_visita set tipo=%s, nombre_tipo_visita=%s, auto_titulo=%s, auto_texto=%s where id_tipo_visita=%s ",
			GetSQLValueString($_POST['tipo'], "int"),
			GetSQLValueString($_POST['nombre_tipo_visita'], "text"),
			GetSQLValueString($_POST['auto_titulo'], "text"),
			GetSQLValueString($_POST['auto_texto'], "text"),
		   GetSQLValueString($_POST['actualizar_id_tipo_visita'], "int"));
      $Resultpd = mysql_query($updated, $conexion);
	  echo $actualizado;
	 
} else {}





if ((isset($_POST["id_area"]) && ""!=$_POST["id_area"])) {
	

$insertSQL = sprintf("INSERT INTO tipo_visita (
id_area, tipo, nombre_tipo_visita, auto_titulo, auto_texto, estado_tipo_visita) 
VALUES (%s, %s, %s, %s, %s, %s)", 
GetSQLValueString($idoficina, "int"),
GetSQLValueString($_POST["tipo"], "int"),
GetSQLValueString($_POST["nombre_tipo_visita"], "text"),
GetSQLValueString($_POST["auto_titulo"], "text"),
GetSQLValueString($_POST["auto_texto"], "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

  echo $insertado;
   

}  else { }

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('tipo_visita'); ?></h3>

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
              <h3><?php echo date('Y'); ?></h3>

              <p>Vigencia</p>
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
             
 <h3><?php echo $realdate; ?></h3>
			  
              <p>Fecha</p>
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
<?php  
if (1==$_SESSION['rol'] or 0<$nump169) {
?>
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>

<?php } else { } ?>	
TIPOS DE VISITAS
	  </h3>
	  
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">

  <th>Area</th>
 <th>Tipo</th>
<th>Subtipo</th>
<th>Titulo</th>
<th>Objeto</th>
<th style="width:60px"></th>
				  		  
</tr>
</thead>
<tbody>
				
<?php 


if (1==$_SESSION['rol']) { 
$query4="SELECT * from tipo_visita, area where tipo_visita.id_area=area.id_area and estado_tipo_visita=1 ORDER BY area.id_area asc"; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from tipo_visita, area where tipo_visita.id_area=area.id_area and area.id_area=".$idoficina." and estado_tipo_visita=1 ORDER BY area.id_area, orden asc"; //LIMIT 500 OFFSET ".$pagina."
}




$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {
?>  
<tr>
				<?php
$id_res=$row['id_tipo_visita'];


echo '<td>'.$row['nombre_area'].'</td>';

echo '<td>';
if (1==$row['tipo']) { echo 'Especial'; }
else { echo 'General'; }

echo '</td>';

echo '<td>'.$row['nombre_tipo_visita'].'</td>';

echo '<td>'.$row['auto_titulo'].'</td>';

echo '<td>'.$row['auto_texto'].'</td>';


echo '<td>';
echo ' <a href="" class="buscar_actualizartipovisita" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizartipovisita"> <span class="btn btn-xs btn-warning">Actualizar</span></a> ';
 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_res.'" name="tipo_visita" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

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
        
<form action="" method="POST" name="for54354r653453543545464324324563m1" enctype="multipart/form-data" >


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Area:</label> 

<?php
if (1==$_SESSION['rol']) { 
?>

 <select class="form-control" name="id_area" >
			  <option></option>
			  	<?php
$select = mysql_query("select * from area where id_area in (5, 6, 9, 10, 11, 26, 27)  order by nombre_area ", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_area'].'" ';
	echo '>'.$row['nombre_area'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 
mysql_free_result($select);
			?>
			  </select>
<?php } else { ?>
 <input type="text" readonly required class="form-control" name="id_area" value="<?php echo quees('area',$idoficina); ?>">

<?php } ?>
			  
			  
</div>




<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de visita:</label>  
			    <select class="form-control" name="tipo" required>
			  <option></option>
		  <option value="0">General</option>
		    <option  value="1">Especial</option>
			  </select>
            </div>

 <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Subtipo de visita (Nombre del tipo de visita):</label>
             <input type="text" class="form-control" name="nombre_tipo_visita" required value="">
            </div>
			
			
			
			 <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Asunto:</label>
             <input type="text" class="form-control" name="auto_titulo" required value="">
            </div>
			
			
			
			 <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Objeto:</label>
             <textarea class="form-control" name="auto_texto" style="min-height:250px;" required></textarea>
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















<div class="modal fade" id="popupactualizartipovisita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar</b></h4>
</div> 
<div id="ver_actualizartipovisita" class="modal-body"> 

</div>
</div> 
</div> 
</div>






<?php
} else {}
} else {} ?>




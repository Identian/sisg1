<?php
	
if (1==$_SESSION['rol']) {

global $mysqlic;
$mysqlic = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("error", $mysqlic->connect_error);
    exit();
}


function nuevoinsert($titul) {
global $mysqlic;
$query4g = $titul; 
$result4g = $mysqlic->query($query4g);
$resok='';
return $resok;
$result4g->free();
}




if ((isset($_POST["titulo"])) && ($_POST["titulo"] != "")) {

$insertSQL = sprintf("INSERT INTO portal (fecha_publicacion, titulo, subtitulo, portada,  
nombre_portal, actualizado, estado_portal) VALUES (now(), %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["titulo"], "text"), 
GetSQLValueString($_POST["subtitulo"], "text"), 
GetSQLValueString(0, "int"),
GetSQLValueString($_POST["nombre_portal"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) ;

echo $insertado;
  
   

}  else { }

?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('portal'); ?></h3>

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
            
<h3>20<?php echo $anoactual; ?></h3>
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
			<h3>20<?php echo $anoactual; ?></h3>
              <p>Año</p>
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
<?php  if (1==$_SESSION['rol']) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">
	   <b>BASE DE CONOCIMIENTO</b>
	<!--
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">Buscar 
<select class="form-control" name="campo" required>
          <option value="" selected> - - Buscar por: - -  </option>
 <option value="mes">Mes</option>
<option value="ano">Año</option>
<option value="nombre_tipo_estado_contable">Tipo de estado contable</option>
		  </select>
</div>
<div class="input-group-btn">
<input type="text" name="buscar" placeholder="" class="form-control" required ></div>
   
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>

</form>-->


</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
  <th>Orden</th>
 <th>Categoria / Titulo</th>
<th>Subtitulo</th>

<th style="width:90px;"></th>	  
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
 

$query4="SELECT * from portal where estado_portal=1 ".$infop." ORDER BY id_portal desc";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_portal'];
	echo '<td>'.$row['orden'].'</td>';
	echo '<td>';
	

	if (1==$row['actualizado']) {
echo $row['titulo']; 	

if ('Noticias'==$row['titulo'] && 1==$row['portada']) {
echo ' / Portada / '; 	
echo date('Y-m-d', strtotime($row['fecha_publicacion']));
} else {
}

	

} else {
echo utf8_encode($row['titulo']); 
}

	
	echo '</td>';
	echo '<td>';
	if (1==$row['actualizado']) {
echo $row['subtitulo']; 	
} else {
echo utf8_encode($row['subtitulo']); 
}
	echo '</td>';

echo '<td>';



if (1==$_SESSION['rol'] ) { 
	
echo '<a href="" class="buscar_contenido" id="'.$id_res.'" data-toggle="modal" data-target="#popupcorrespondencia"><span class="fa fa-eye"></span></a> ';
echo ' &nbsp; <a href="contenido/contenido&'.$id_res.'.jsp" target="_blank"><span class="fa fa-edit"></span></a> ';
echo ' &nbsp; <a style="color:#ff0000;cursor: pointer" title="Borrar" name="portal" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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


<?php if (1==$_SESSION['rol'] ) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">CONTENIDO</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for5435353443454r65464563m1" >


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CATEGORIA / TITULO:</label> 
<select class="form-control" name="titulo"  required>

<?php

$query = sprintf("SELECT id_portal, titulo, actualizado FROM portal where estado_portal=1 group by titulo order by titulo "); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	
	if (1==$row['actualizado']) {
$titulo= $row['titulo']; 	
} else {
$titulo= utf8_encode($row['titulo']); 
}


	echo '<option value="'.$titulo.'">'.$titulo.'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TITULO:</label> 
<input type="text" class="form-control" name="titulo"  required>
</div>-->
<div class="form-group text-left"> 
<label  class="control-label">SUBTITULO:</label> 
<input type="text" class="form-control" name="subtitulo"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CONTENIDO:</label> 
<textarea class="form-control" name="nombre_portal" required></textarea>
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





<div class="modal fade bd-example-modal-lg" id="popupcorrespondencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Contenido</label></h4>
</div> 
<div class="ver_contenido" class="modal-body"> 





</div>
</div> 
</div> 
</div> 




<?php } else { }

 } else { }?>




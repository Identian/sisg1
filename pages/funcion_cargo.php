<?php
$nump161=privilegios(161,$_SESSION['snr']);



if (1==$_SESSION['rol'] or 0<$nump161) {

 /*
 if (isset($_POST['nombre_grupo_area'])) { 
 $insertSQL = sprintf("INSERT INTO grupo_area (
nombre_grupo_area, codigo_grupo_area, id_area, estado_grupo_area) 
VALUES (%s, %s, %s, %s)", 
GetSQLValueString($_POST["nombre_grupo_area"], "text"), 
GetSQLValueString($_POST["codigo_grupo_area"], "int"), 
GetSQLValueString(28, "int"), 
GetSQLValueString(0, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;
} else {}*/
 
 
 
 
 
 
  if (isset($_POST['nombre_cargo_nomina'])) { 
 
 $insertSQL = sprintf("INSERT INTO cargo_nomina (
nombre_cargo_nomina, cod_cargo_nomina, grado_cargo_nomina, estado_cargo_nomina) 
VALUES (%s, %s, %s, %s)", 
GetSQLValueString($_POST["nombre_cargo_nomina"], "text"), 
GetSQLValueString($_POST["cod_cargo_nomina"], "int"), 
GetSQLValueString($_POST["grado_cargo_nomina"], "int"), 
GetSQLValueString(0, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;
} else {}


 
 
 

if (isset($_POST['id_cargo_nomina'])) { 


$infor=explode("-",$_POST["id_dependencia"]);
$depe=$infor[0];
$codedepe=$infor[1];

$info=explode('•	',$_POST["nombre_funcion_cargo"]);

foreach($info as $cat) {
    $categories.= "<br>".$cat."";
}


$insertSQL = sprintf("INSERT INTO funcion_cargo (
id_cargo_nomina, id_area, id_dependencia, codigodep funcion_ano, nombre_funcion_cargo, estado_funcion_cargo) 
VALUES (%s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["id_cargo_nomina"], "int"), 
GetSQLValueString(28, "int"), 
GetSQLValueString($depe, "int"), 
GetSQLValueString($codedepe, "text"),
GetSQLValueString($_POST["funcion_ano"], "int"), 
GetSQLValueString($categories, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;

} else { }
 


?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php  echo existencia('funcion_cargo');   ?></h3>

              <p>Registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
	
            <a href="#" data-toggle="modal" data-target="#popupequipos" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>22</h3>

              <p>Areas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" data-toggle="modal" data-target="#popupactualizarolimpiada232" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
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
  
  
  
  <div class="col-md-2">
 <h3  class="box-title">
 <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> 
	  </h3>
	  </div>
	  
	  

	  
	    <div class="col-md-8">
 <?php if (1==$_SESSION['rol']) { ?>
<form class="navbar-form" name="for54354356m1erteg" method="post" action="">
<div class="input-group">

<div class="input-group-btn">
<input type="text" class="form-control numero"  name="cod_cargo_nomina" placeholder="Codigo del cargo. 4 digitos" required>
</div>
<div class="input-group-btn">
<input type="text" class="form-control numero"  name="grado_cargo_nomina" placeholder="Grado cargo. 2 digitos" required>
</div>

<div class="input-group-btn">
<input type="text" class="form-control" style="min-width:300px;" name="nombre_cargo_nomina" placeholder="Nuevo cargo" required>
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-info">Crear </button> 
</div>
</div>
</form>
<?php  } else {  }?>
	  </div>
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th></th>
 <th>Año - manual</th>	
<th>Cargo</th>		
<th>Grado</th>		
<th>Dependencia</th>
<th>Funciones</th>					   					   
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

$query4="SELECT * from funcion_cargo, cargo_nomina, area where 
funcion_cargo.id_cargo_nomina=cargo_nomina.id_cargo_nomina and 
funcion_cargo.id_area=area.id_area and 
estado_funcion_cargo=1"; 

$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {
?>  
<tr>
				<?php
$id_res=$row['id_funcion_cargo'];



echo '<td style="font-size:5px;">';
echo $row['id_cargo_nomina'];
echo '</td>';

echo '<td>';
echo $row['funcion_ano'];
echo '</td>';


echo '<td>';
echo $row['nombre_cargo_nomina'];
echo '</td>';
echo '<td>';
echo $row['grado_cargo_nomina'];
echo '</td>';




echo '<td>';
echo $row['nombre_area'];
echo '</td>';


echo '<td>';
echo $row['nombre_funcion_cargo'];
echo '</td>';



echo '<td>';
	if ((1==$_SESSION['rol'] or 0<$nump161) && 1==2 ) { //or 0<$nump161
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_res.'" name="funcion_cargo" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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



 <div class="modal fade bd-example-modal-lg" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r653454345345464324324563m1" enctype="multipart/form-data" >

<div class="form-group text-left"> 
<label  class="control-label">
<span style="color:#ff0000;">*</span> Cargo:</label> 
<select class="form-control" name="id_cargo_nomina"  required>
<option value="" selected></option>

 <?php 
$selectu = mysql_query("SELECT * FROM cargo_nomina  where id_cargo_nomina!=44 order by cod_cargo_nomina, grado_cargo_nomina ", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$totalRowsu = mysql_num_rows($selectu);
do {
echo '<option value="'.$rowu['id_cargo_nomina'].'">'.$rowu['nombre_cargo_nomina'].' / '.$rowu['cod_cargo_nomina'].'-'.$rowu['grado_cargo_nomina'].'</option>';
 } while ($rowu = mysql_fetch_assoc($selectu)); 
mysql_free_result($selectu);
?>

</select>
</div>





<div class="form-group text-left"> 
<label  class="control-label">
<span style="color:#ff0000;">*</span> Año del manual de funciones:</label> 
<select class="form-control" name="funcion_ano"  required>
<option selected></option>
<option value="2000">2000</option>
<option value="2004">2004</option>
<option value="2006">2006</option>
<option value="2009">2009</option>
<option value="2011">2011</option>
<option value="2012">2012 (Tierras)</option>
<option value="2013">2013 (Tierras)</option>
<option value="2015">2015</option>
<option value="2019">2019</option>
<option value="2022">2022</option>
</select>
</div>

  
<div class="form-group text-left"> 
<label  class="control-label">
<span style="color:#ff0000;">*</span> Dependencia: <a id="consulta_dependencia">Ver / seleccionar</a></label> 
<div id="id_dependencia">
</div>
</div>







<div class="form-group text-left"> 
<label  class="control-label">
<span style="color:#ff0000;">*</span> Funciones:</label> 
<textarea class="form-control" style="min-height:400px;" name="nombre_funcion_cargo" required></textarea>
</div>
		


<div class="modal-footer" id="enviodependencia" style="display:none;"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>




<?php
} else {
}
?>




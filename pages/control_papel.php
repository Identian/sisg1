<?php
if (1==$_SESSION['rol'] and isset($_GET["i"])) {	
$id=$_GET['i'];
} else {
$id=$_SESSION['id_vigilado'];
}

if (isset($id) && ""!=$id) {

if (isset($_POST['identificacion']) && ""!=$_POST['identificacion']) {


if ($_POST["inicial"]<=$_POST["final"]) {
	


$estud=$_POST['id_not_actos'];
$estu='';
for ($u=0;$u<count($estud);$u++)    
{     
$estu.=$estud[$u].',';    
}


      $insertSQL = sprintf(
     "INSERT INTO papel_seguridad (id_notaria,  id_not_actos, identificacion, fecha_acto, intervinientes, proveedor, letras, inicial, final, nombre_papel_seguridad, 
estado_papel_seguridad) 
		VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
        GetSQLValueString($id, "int"),
        GetSQLValueString($estu, "text"),
		GetSQLValueString($_POST["identificacion"], "text"),
				GetSQLValueString($_POST["fecha_acto"], "text"),
						GetSQLValueString($_POST["intervinientes"], "text"),
								GetSQLValueString($_POST["proveedor"], "text"),
										GetSQLValueString($_POST["letras"], "text"),
												GetSQLValueString($_POST["inicial"], "text"),
														GetSQLValueString($_POST["final"], "text"),
																GetSQLValueString($_POST["nombre_papel_seguridad"], "text"),

        GetSQLValueString(1, "int")
      );
      $Result = mysql_query($insertSQL, $conexion);
      echo $insertado;
    
} else { 
echo '<script type="text/javascript">swal(" ERROR !", " NO registrado La numeración no es incremental", "error");</script>';
}


} else { }
 
 


?>
 
 
 <div class="row">
  
 
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3>3</h3>

              <p>Proveedores de papel</p>
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
             
 <h3>195</h3>
			  
              <p>Oficinas de registro</p>
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
              <h3><?php echo existencia('notaria'); ?></h3>
              <p>Notarias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
	  
	  
 

<?php if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && (""!=$_SESSION['posesionnotaria'] or ""!=$_SESSION['id_vigilado'])))
{ include 'menu_notaria.php'; } else { } ?>

	
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
	   
Control de papeles de seguridad

</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
<tr align="center" valign="middle">
 <th>Actos</th>
              <th>Num Documento</th>
              <th>Fecha</th>
			  <th>Proveedor</th>
			  <th>Intervinientes</th>
			   <th>Observaciones</th>
              <th>Consultar Hojas</th>  
			  <th></th>
</tr>
</thead>
<tbody>
<?php 
$query4="SELECT * FROM papel_seguridad where id_notaria=".$id." and estado_papel_seguridad=1";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {

$id_res=$row['id_papel_seguridad'];
echo '<tr>';
echo '<td>';
$tags=explode(',',$row['id_not_actos']);
foreach($tags as $i =>$key) {
	if (0!=$key) {
 echo quees('not_actos',$key);
	} else {}
	echo '<br>';
}
echo '</td>';
echo '<td>'.$row['identificacion'].'</td>';
echo '<td>'.$row['fecha_acto'].'</td>';
echo '<td>';
$prove=$row['proveedor'];
if (1==$prove) {
		echo 'Thomas greg';
} else if (2==$prove) {
echo 'Segurdoc';
} else if (3==$prove) {
	echo 'Cadena';
} else {}
echo '</td>';
echo '<td>'.$row['intervinientes'].'</td>';
echo '<td>'.$row['nombre_papel_seguridad'].'</td>';
echo '<td>';

$inicial=$row['inicial'];
$final=$row['final'];
$cuenta=strlen($row['inicial']);
$valoec='-'.$cuenta;

for ($i = $inicial; $i <= $final; $i++) {
	
	
$nume = trim(substr('000000000'.$i,$valoec));
	
	$id_ref=$prove.'-'.$row['letras'].$nume;
	$id_papel=$row['letras'].$nume;
	
	echo '<a href="" class="buscarpapel" id="'.$id_ref.'" data-toggle="modal" data-target="#popupactualizarpapel">'.$id_papel.'</a>, ';
}


echo '</td><td>';

	if (1==$_SESSION['rol']) { 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="papel_seguridad" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
									//'excelHtml5'
									
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
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
    


<form action="" method="POST" name="for23423454432dsfds3m1">


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Actos utilizados:</label> 
<select class="js-example-basic-multiple" style="width:440px;" required name="id_not_actos[]" multiple>
<option></option>
<?php
$query2 = sprintf("SELECT * FROM not_actos where estado_not_actos=1 order by nombre_not_actos"); 
$select2 = mysql_query($query2, $conexion);
$row2 = mysql_fetch_assoc($select2);
$totalRows2 = mysql_num_rows($select2);
if (0<$totalRows2){
do {
	echo '<option value="'.$row2['id_not_actos'].'" >'.$row2['codigo_not_actos'].' - '.$row2['nombre_not_actos'].'</option> ';
	 } while ($row2 = mysql_fetch_assoc($select2)); 
} else {}	 
mysql_free_result($select2);

?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>  Número identificador del documento:</label> 
<input  type="text"  class="form-control"  name="identificacion" value="" required>


</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha de uso:</label> 
<input  type="text"  class="form-control datepicker"  name="fecha_acto" value="" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Intervinientes:</label> 
<textarea  class="form-control"  name="intervinientes" required></textarea>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Proveedor de papel:</label> 
<select class="form-control" required name="proveedor">
<option value="" selected></option>
<option value="1">THOMAS GREG</option>
<option value="2">SEGURDOC</option>
<option value="3">CADENA</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Letras iniciales del papel:</label> 
<input  type="text"  class="form-control"  name="letras" value=""  placeholder="Ejemplo: PO, SAO, Aa">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Numero Inicial "Menor" (generalmente 9 digitos):</label> 
<input  type="text"  class="form-control numero"  name="inicial" value=""  required placeholder="Identico al número que esta en el papel">
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Número final "Mayor" (generalmente 9 digitos):</label> 
<input  type="text"  class="form-control numero"  name="final" value=""  required placeholder="Identico al número que esta en el papel">
</div>


<div class="form-group text-left"> 
<label  class="control-label"> Observaciones:</label> 
<textarea  class="form-control"  name="nombre_papel_seguridad"></textarea>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>


</form>




      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="popupactualizarpapel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Información de la Hoja</b></h4>
</div> 
<div id="veractualizarpapel" class="modal-body"> 

</div>
</div> 
</div> 
</div>




<?php } else {}
 ?>




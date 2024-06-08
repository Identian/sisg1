<?php
$nump54=privilegios(54,$_SESSION['snr']);

if ((1==$_SESSION['rol'] or 0<$nump54) && (isset($_GET['i']) && "" != $_GET['i'])) {
$id = $_GET['i'];
} else { 
$id = $_SESSION['id_vigilado'];
 }
?>
 
 


<?php if (((1==$_SESSION['rol'] or 0<$nump54) && 0<$_GET['i']) or (3==$_SESSION['snr_tipo_oficina'] && 0<=$_SESSION['id_vigilado']))
{ include 'menu_notaria.php'; } else { } ?>	 

	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-4">
  
  <h3>Turnos de carceles para Notarias</h3>
<?php  if (1==2) { ?>
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-8">
	   <!--
	   <form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">
              <div class="input-group">
                <div class="input-group-btn">Buscar
                  <select class="form-control" name="campo" required>
                    <option value="" selected> - - Buscar otros testamentos: - - </option>
                    <option value="identificacion">Número</option>
                  </select>
                </div>
                <div class="input-group-btn">
                  <input type="text" name="buscar" placeholder="" class="form-control" required></div>
             
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                </div>
              </div>
            </form>-->



</div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
 
		<!--	<style>


.dataTables_filter {
display:none;
}



.dataTables_paginate {
display:none;
}

			</style> -->


			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">

                <thead>
<tr align="center" valign="middle">

<th>Fecha</th>
<th>Carcel</th>
<th>Departamento</th>
<th>Notaria</th>
</tr>
</thead>
<tbody>
<?php 
/*
if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infobus=" and ".$_POST['campo']." like '%".$_POST['buscar']."%' ";
				$infop=$infobus;
				$pagina=0;
				} else {	
				$infop="  and  testamento.id_notaria=".$id." ";	
	if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
	 } else {
		$pagina=0;  
	 }}
	 */


$query4="SELECT nombre_notaria, nombre_carcel, fecha_carcel, nombre_departamento FROM carcel, carcel_notaria, departamento, notaria WHERE departamento.id_departamento=notaria.id_departamento and notaria.id_notaria=carcel_notaria.id_notaria and carcel.id_carcel=carcel_notaria.id_carcel AND estado_carcel_notaria=1 and fecha_carcel>='$realdate' ORDER BY fecha_carcel";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {



echo '<tr><td>'.$row['fecha_carcel'].'</td>';
echo '<td>'.$row['nombre_carcel'].'</td>';
echo '<td>'.$row['nombre_departamento'].'</td>';
echo '<td>'.$row['nombre_notaria'].'</td>';
echo '</td></tr>';
?>
      
        
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
						"aaSorting": [[ 0, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (1==2) { ?>


 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVOO</h4>
      </div>
      <div class="modal-body">
    

      </div>
    </div>
  </div>
</div>


<?php
} else {}
?>







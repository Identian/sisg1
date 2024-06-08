
	<?php if (1==$_SESSION['rol']) { ?>
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  

	  
	  
	
  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
<div class="row">
<div class="col-md-8">
Gestión de usuarios en capacitación
</div>
<div class="col-md-4">
<a href="http://192.168.210.132:8080/admin/tool/uploaduser/index.php">Subir usuarios</a>
</div>
</div>

<br>
<table  class="table table-striped table-bordered table-hover" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>

<tr>

<td>username,firstname,lastname,email</td></tr>

</thead>
<?php 

?>  
<tbody>


			
                <?php 
				
$query = sprintf("SELECT * FROM funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and lms=1 and estado_funcionario=1");
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<tr>';

echo '<td>'.strtolower($row['alias_iduca']).','.$row['nombre_funcionario'].','.$row['nombre_grupo_area'].','.$row['correo_funcionario'].'</td>';


echo '</tr>';




} while ($row = mysql_fetch_assoc($select));
}
mysql_free_result($select);
 ?>

				
                </tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									//'excelHtml5'
									'csvHtml5'
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						}
					});
				});
				
			//	,						"aaSorting": [[ 1, "desc"]]
			
		
				
			</script>
			

		 
		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->

	<?php } ?>










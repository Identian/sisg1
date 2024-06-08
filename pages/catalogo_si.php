<?php

if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && 0<$_SESSION['posesionnotaria'])) { 

			  
if ((isset($_POST["id_funcionario_encargado"])) && ($_POST["id_funcionario_encargado"] != "") && (1==$_SESSION['rol'])) { 

$insertSQL = sprintf("INSERT INTO permiso (origen, id_funcionario, id_notaria, id_funcionario_encargado, fecha_creacion, estado_permiso) 
VALUES (%s, %s, %s, %s, now(), %s)", 
GetSQLValueString(0, "int"), 
GetSQLValueString($_POST["id_funcionario_notario"], "int"),
GetSQLValueString($id, "int"),
GetSQLValueString($_POST["id_funcionario_encargado"], "int"), 
GetSQLValueString(1, "int"));
//$Result = mysql_query($insertSQL, $conexion);
//echo $insertado;

} else {} 

?>
<div class="row">
<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('aplicacion'); ?></h3>

              <p>Total de registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="entidades_reparto.jsp" class="small-box-footer">Ir a Entidades <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="https://sisg.supernotariado.gov.co/xls/reparto_notarial.xls" class="small-box-footer">Descargar Reporte <i class="fa fa-arrow-circle-right"></i></a>
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
              <h3><?php //echo cuenta('1','52','8','1');?>195</h3>
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



<button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> CATALOGO DE SISTEMAS DE INFORMACIÓN
	  

  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
            <tr>
			 <th>Siglas</th>
			  <th>Nombre</th>
              <th>Funcionarios asignados</th>
			  <th></th>
            </tr>
   </thead>
<tbody>

				
<?php 

$query4="SELECT * FROM aplicacion where estado_aplicacion=1 order by id_aplicacion desc";

$result = $mysqli->query($query4);
while($rownvb = $result->fetch_array()) {
?>  
<tr>

            <?php

echo '<td>'.$rownvb['sigla_aplicacion'].'</td>';
echo '<td>'.$rownvb['nombre_aplicacion'].'</td>';
echo '<td>';
      $select = mysql_query("SELECT * FROM funcionario_aplicacion, funcionario where funcionario_aplicacion.id_funcionario=funcionario.id_funcionario and id_aplicacion=" . $rownvb['id_aplicacion']. " and estado_funcionario_aplicacion=1", $conexion);
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
     
            do {

              echo $row['nombre_funcionario'];
       echo ' <a style="color:#333;cursor: pointer" title="Borrar" name="funcionario_aplicacion" id="' . $row['id_funcionario_aplicacion'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a><br>';
           

   
            } while ($row = mysql_fetch_assoc($select));
     
          } else {          }
          mysql_free_result($select);
		  
echo '</td>';

echo '<td>';

	
	if (1==$_SESSION['rol'] or 0<$nump6) {
	echo ' <a href="aplicacion&'.$rownvb['id_aplicacion'].'.jsp"><i class="glyphicon glyphicon-pencil"></i></a> ';
	
	     echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="aplicacion" id="' . $rownvb['id_aplicacion'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
              
			  
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



<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
    

    
<form action="" method="POST" name="for543534345353454r65464563m1">



<div class="form-group text-left"> 
<label  class="control-label"> SIGLAS DEL SISTEMA:</label> 
<input  type="text" class="form-control" name="siglas_sistema" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"> SISTEMA:</label> 
<input  type="text" class="form-control" name="nombre_sistema" required>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onclick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>



















<div class="modal fade bd-example-modal-lg" id="popupreparto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Actualizar</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="ver_cambio_reparto" class="modal-body">

   </div>
    </div>
  </div>
</div>






<div class="modal fade" id="resultadopermisolicencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Detalles</h4>
      </div>
      <div class="modal-body" id="resultadopermiso">
	  
	 
	  </div> 
</div> 
</div> 
</div> 





<?php
} else {
	ECHO 'No tiene permisos de visualización. Solo para Notarios';
} ?>




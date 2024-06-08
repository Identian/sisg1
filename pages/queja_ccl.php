<?php
$nump159 = privilegios(159, $_SESSION['snr']);
if (3>$_SESSION['snr_tipo_oficina']) {



if ((isset($_POST["modalidad"])) && (""!=$_POST["modalidad"])) { 


	
$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx');


$directoryftp="filesnr/quejas/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'queja-'.$_SESSION['snr'].'-'.$identi;

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
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
  
$estud=$_POST['modalidad'];
$estu='';
for ($u=0;$u<count($estud);$u++)    
{     
$estu.=$estud[$u].',';    
}

 

$insertSQL = sprintf("INSERT INTO quejaccl (id_funcionario, fecha_quejaccl, modalidad, dirigido, 
nombre_quejaccl, evidencia, estado_quejaccl) VALUES (%s, now(), %s, %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($estu, "text"), 
GetSQLValueString($_POST["id_funcionario_solicita"], "int"), 
GetSQLValueString($_POST["nombre_quejaccl"], "text"), 
GetSQLValueString($files, "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;

   
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
	
 
	
	  } else {}
	  ?>


 <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('quejaccl'); ?></h3>

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
             
 <h3>5</h3>
			  
              <p>Regionales</p>
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
		

	
          <div class="box-body box-profile">

  <a class="ventana1" data-toggle="modal" data-target="#popupcreditoicetex" href="" title="Añadir"> <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</button></a>
          
<b>QUEJAS CCL</b> <br>
</div>


  
        <div class="nav-tabs-custom">



	 
          

          <div class="tab-content">


		  
            <div class="active tab-pane" id="activity">

              <div class="post">
                <div class="user-block">
                  <div class="col-xs-12 table-responsive ">

                    <?php
					
			if (1==$_SESSION['rol'] or 0<$nump159) {
$queryn="SELECT * FROM quejaccl, funcionario where quejaccl.id_funcionario=funcionario.id_funcionario and estado_quejaccl=1"; //LIMIT 500 OFFSET ".$pagina."
} else {
$queryn="SELECT * FROM quejaccl, funcionario where quejaccl.id_funcionario=funcionario.id_funcionario and estado_quejaccl=1 and funcionario.id_funcionario=".$_SESSION['snr'].""; //LIMIT 500 OFFSET ".$pagina."
}

               
					
					$selectn = mysql_query($queryn, $conexion) ;
                    $row = mysql_fetch_assoc($selectn);
					$totalRows = mysql_num_rows($selectn);

if (0<$totalRows){
                    ?>


	  
                    <table class="table table-striped table-bordered table-hover" id="detallefun">
                    
				<thead>
				<tr align='center' valign='middle'>
				
				<th>REGISTRO</th>
				<th>FUNCIONARIO</th>
				<th>CEDULA</th><th>CORREO</th>
				<th>OFICINA</th><th>VINCULACIÓN</th><TH>CARGO</TH>
				<TH>DIRIGIDO</TH>
				<th>CARGO DIRIGIDO</th>
				<th>MODALIDAD</th>
				<th>DESCRIPCIÓN</th>
				<th>EVIDENCIA</th>
				</tr>
				
				</thead><tbody>
				
					  
                        <?php
						
						
                        do {
                          echo '<tr>';
						  
						  echo '<td>';
echo $row['fecha_quejaccl'];
echo '</td>';


echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp" target="_blank">'.$row['nombre_funcionario'].'</a></td>';




echo '<td>';
echo $row['cedula_funcionario'];
echo '</td>';
echo '<td>';
echo $row['correo_funcionario'];
echo '</td>';

if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
}

	echo '<td>';
if (ISSET($row['id_vinculacion'])) {
echo quees('vinculacion', $row['id_vinculacion']); 
} else {}
	echo '</td>';

echo '<td>'.quees('funcionario',$row['dirigido']).'</td>';

echo '<td>';
echo cualcargo($row['dirigido']);
echo'</td>';


echo '<td>'.$row['modalidad'].'</td>';
echo '<td>'.$row['nombre_quejaccl'].'</td>';
echo '<td><a href="filesnr/quejas/'.$row['evidencia'].'" target="_blank"><img src="images/pdf.png" style="max-width:15px;height:18px;"></a>';
	if (1==$_SESSION['rol'] or 0<$nump159) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="quejaccl" id="'.$row['id_quejaccl'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

	} else {}
	
echo '</td>';

echo '</TR>';
                        } while ($row = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);


                        ?>
						<script>
				$(document).ready(function() {
					$('#detallefun').DataTable({
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
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
                        
                      </tbody>
                    </table>
<?php } else { echo 'No existen registros'; } ?>
</div>
                </div>
              </div>
            </div>






            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>






<div class="modal fade" id="popupcreditoicetex" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Solicitud: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="formasdf3245fhgdh345122" enctype="multipart/form-data">

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Asunto de queja:</label> 
<select  class="form-control" name="tipo_queja" required>
<option value="" selected></option>
<option>Queja presunto acoso</option>
<option>Solicitud en representación de un anónimo</option>
<option>Solicitud</option>

</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Queja dirigida a:</label> 
 &nbsp; <input id="consultanombre" value="" style="width:200px;" placeholder="Buscar nombre" required>
<button type="button" class="btn btn-xs btn-warning" id="botonconsultanombre" title="Buscar">
<span class="glyphicon glyphicon-search"></span></button>
<select name="id_funcionario_solicita"  class="form-control" required>
<div id="resultadoconsultanombre">
</div>

</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Modalidad:</label> 
<!--<select  class="form-control" name="modalidad" required> -->
<select class="form-control js-example-basic-multiple" style="width:440px;" required name="modalidad[]" multiple>
<option></option>
<option>Maltrato Laboral</option>
<option>Persecución Laboral</option>
<option>Discriminación Laboral</option>
<option>Entorpecimiento Laboral</option>
<option>Inequidad Laboral</option>
<option>Desprotección Laboral</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>Relato sucinto de los hechos que originan la queja, relacionados con las conductas establecidas en la Ley 1010 de 2006 y que hayan tenido ocurrencia no antes de los últimos 6 meses de su presentación, con mención de las circunstancias de tiempo, modo y lugar adjuntando las pruebas que considere necesarias.:</label> 
<textarea class="form-control" name="nombre_quejaccl"  required></textarea>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ADJUNTAR EVIDENCIA EN UN SOLO ARCHIVO:</label> 

<input type="file" name="file" class="form-control"  required>
</div>



                    
                    <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                      <button type="submit" class="btn btn-success"><input type="hidden" name="insertSupervisor" value="insertco"><span class="glyphicon glyphicon-ok"></span> Agregar </button>
                    </div>
                  </form>

                  
                </div>
              </div>
            </div>
          </div>
		  

<?php

  } else {  echo '';}

?>
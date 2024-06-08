<?php

	

$nump121=privilegios(121,$_SESSION['snr']);

if ((3>$_SESSION['snr_tipo_oficina']) && 
 (1==$_SESSION['snr_grupo_cargo'] or 2==$_SESSION['snr_grupo_cargo'] or 4==$_SESSION['snr_grupo_cargo'])) {
	
	
	
	function cantidadcurso($idic) {
global $mysqli;
$query4 = sprintf("SELECT cantidad FROM catalogo_curso where id_catalogo_curso=".$idic." "); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['cantidad'];
return $res;
$result4->free();
}

	
	
$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2022-10-20 08:00:00");
$fecha_limite = strtotime("2022-11-10 17:00:00");


if($fecha_actual > $fecha_limite)
	{
	echo '';
	} else { 
	
	
	

if ((isset($_POST["id_catalogo_curso"])) && (""!=$_POST["id_catalogo_curso"])) {
	
$cant=cantidadcurso($_POST["id_catalogo_curso"]);


$query = sprintf("SELECT count(id_curso) as tt FROM curso where estado_curso=1 and id_catalogo_curso=".$_POST["id_catalogo_curso"].""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);

//echo 'Cupos disponibles del curso: '.$cant.', Inscritos actualmente: '.$rowt['tt'].'';

if ($cant>$rowt['tt']) {
	




$query = sprintf("SELECT count(id_curso) as ccc FROM curso, catalogo_curso where ciclo=4 and curso.id_catalogo_curso=catalogo_curso.id_catalogo_curso and estado_curso=1  and id_funcionario=".$_SESSION['snr'].""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (5<$rowt['ccc']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene 2 procesos de formación activas.</div>';
	
} else {
	
	
	$insertSQL = sprintf("INSERT INTO curso (
      id_funcionario, fecha_curso, nombre_curso, id_catalogo_curso, estado_curso) 
	  VALUES (%s, now(), %s, %s, %s)", 
      GetSQLValueString($_SESSION['snr'], "int"), 
	  GetSQLValueString($_POST['nombre_curso'], "text"),
	  GetSQLValueString($_POST['id_catalogo_curso'], "text"),
	   GetSQLValueString(1, "int")
	  ); 
      $Result = mysql_query($insertSQL, $conexion);

echo $insertado;


  $updateSQL = sprintf("UPDATE funcionario SET fecha_exp_cedula=%s, celular_funcionario=%s  WHERE id_funcionario=%s and estado_funcionario=1",
                       GetSQLValueString($_POST["fecha_exp_cedula"], "date"),
					    GetSQLValueString($_POST["celular_funcionario"], "int"),
					    GetSQLValueString($_SESSION['snr'], "int"));
  $Result1 = mysql_query($updateSQL, $conexion);




   
}

} else {echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El curso ya esta completo a nivel de cupos.</div>';  } 


}
 else {  }

	}

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('curso'); ?></h3>

              <p>Inscripciones</p>
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
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">

    <h3  class="box-title">
	
	<?php
  if(1==2) {

	?>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>
	<?php } else {} ?>

  Cursos de la SNR &nbsp;  &nbsp;  &nbsp; 
  
 <?php if (1==$_SESSION['snr_tipo_oficina']) {
echo '<a href="area&'.$_SESSION['snr_area'].'.jsp"  target="_blank">Directorio de la oficina</a>';
	} else {
echo '<a href="orip&'.$_SESSION['id_oficina_registro'].'.jsp"  target="_blank">Directorio de la oficina</a>';
}
?>
	 </h3>
	  

	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Inscripción</th>
 <th>Cédula</th>
				  <th>Funcionario</th>
				  <th>Correo</th>
				  <?php if (1==$_SESSION['rol'] or 0<$nump121) { echo '<th>Celular</th>'; } else {} 
				  ?>
				  <!--<th>Regional</th>
				  <th>Oficina</th>-->
				  <th>Oficina / Grupo</th>
				  <th>Ciclo</th>
				   <th>Proceso de capacitaciòn</th>
				
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 
/*
Inscripcion
ciclo1=2022-08-17   /  20222-08-25
ciclo2=2022-09-05   /  20222-09-19
ciclo3=2022-10-03   /  20222-10-17
*/
if (1==$_SESSION['rol'] or 0<$nump121) {
$query4="SELECT * from curso, catalogo_curso, funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and curso.id_catalogo_curso=catalogo_curso.id_catalogo_curso and curso.id_funcionario=funcionario.id_funcionario and estado_curso=1  ORDER BY id_curso desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from curso, catalogo_curso, funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and curso.id_catalogo_curso=catalogo_curso.id_catalogo_curso and curso.id_funcionario=funcionario.id_funcionario and estado_curso=1 and funcionario.id_funcionario=".$_SESSION['snr']."  ORDER BY id_curso desc  "; //LIMIT 500 OFFSET ".$pagina."
}

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
<?php
$id_res=$row['id_curso'];
echo '<td>'.$row['fecha_curso'].'</td>';
echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>'.$row['correo_funcionario'].'</td>';
 if (1==$_SESSION['rol'] or 0<$nump121) { echo '<td>'.$row['celular_funcionario'].'</td>'; } else {} 
echo '<td>'.$row['nombre_grupo_area'].'</td>';
/*
if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
}
*/
echo '<td>'.$row['ciclo'].'</td>';
echo '<td>'.$row['nombre_catalogo_curso'].'</td>';

echo '<td>';

if (1==$_SESSION['rol'] or 0<$nump121) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="curso" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
						"aaSorting": [[ 0, "desc"]]
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
        
<form action="" method="POST" name="for54354r65345345464324324563m1" enctype="multipart/form-data" >



 
<div class="form-group text-left"> 
<label  class="control-label">Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">Fecha de expedición de la cédula:</label> 
<input type="text" class="form-control datepickera" name="fecha_exp_cedula" required>
</div>



 <div class="form-group text-left"> 
<label  class="control-label">Número Celular:</label> 
<input type="text" class="form-control numero" name="celular_funcionario" required>
</div>


 <div class="form-group text-left"> 
<label  class="control-label">Perfil:</label> 
<input type="text" class="form-control" readonly value="<?php echo quees('cargo',$_SESSION['snr_grupo_cargo']); ?>">
</div>


 <div class="form-group text-left"> 
<label  class="control-label">Cargo:</label> 
<input type="text" class="form-control" readonly value="<?php echo cargo($_SESSION['id_cargo_nomina_encargo']); ?>">
</div>



 <div class="form-group text-left"> 
<label  class="control-label">Oficina:</label> 
<input type="text" class="form-control" readonly value="
<?php 
if (1==$_SESSION['snr_tipo_oficina']) {
echo ''.quees('area',$_SESSION['snr_area']).' / ';
echo ''.quees('grupo_area',$_SESSION['snr_grupo_area']).'';
} else {
echo ''.regional($_SESSION['id_oficina_registro']).' / ';
echo ''.quees('oficina_registro',$_SESSION['id_oficina_registro']).'';	
echo ' / '.quees('grupo_area',$_SESSION['snr_grupo_area']).'';
} ?>
">
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CURSOS (Máximo 2):</label> 
<select class="form-control"  name="id_catalogo_curso" required  >
<option selected></option>
<?php echo opciones('catalogo_curso',' and ciclo=4 '); ?>
<!--<option value="10">DIPLOMADO 10: En actualización sindical</option>-->
<option value="21">Capacitación en Ley Disciplinaria</option>
</select>

</div>






<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success "><!--desaparecerboton-->
<input type="hidden" name="table">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>


<?php
}
 else { echo 'Solo para funcionarios';  }
 ?>


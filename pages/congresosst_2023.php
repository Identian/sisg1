<?php

$nump111 = privilegios(145, $_SESSION['snr']);

if ((1==$_SESSION['snr_tipo_oficina'] or 10==$_SESSION['id_oficina_registro'] or 
11==$_SESSION['id_oficina_registro'] or 11==$_SESSION['id_oficina_registro']) 
&& (1==$_SESSION['snr_grupo_cargo'] or 2==$_SESSION['snr_grupo_cargo'] 
or 4==$_SESSION['snr_grupo_cargo'])) {
	
	

	
$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-03-07 08:00:00");
$fecha_limite = strtotime("2023-03-15 17:00:00");


if($fecha_actual > $fecha_inicio)
	{
 
	
	
	

if ((isset($_POST["nombre_congresosst23"])) && (""!=$_POST["nombre_congresosst23"])) {
	
$tipo=$_POST["nombre_congresosst23"];

if ('Virtual'==$tipo) {
$query = sprintf("SELECT count(id_congresosst23) as tt FROM congresosst23 where estado_congresosst23=1 and nombre_congresosst23='$tipo'"); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
$cuenta=intval($rowt['tt']);
mysql_free_result($select);
$limite=180;
} else if ('Presencial'==$tipo) {
$query = sprintf("SELECT count(id_congresosst23) as tt FROM congresosst23 where estado_congresosst23=1 and nombre_congresosst23='$tipo'"); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
$cuenta=intval($rowt['tt']);
mysql_free_result($select);
$limite=180;
} else {
$cuenta=0;
$limite=0;
	
}



if ($cuenta<$limite) {


$query = sprintf("SELECT count(id_congresosst23) as ccc FROM congresosst23 where id_funcionario=".$_SESSION['snr']." and estado_congresosst23=1"); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['ccc']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, el funcionario ya esta registrado.</div>';
	
} else {
	
	
	$insertSQL = sprintf("INSERT INTO congresosst23 (
      id_funcionario, fecha_registro, nombre_congresosst23, transporte, estado_congresosst23) 
	  VALUES (%s, now(), %s, %s, %s)", 
      GetSQLValueString($_SESSION['snr'], "int"), 
	  GetSQLValueString($tipo, "text"),
	    GetSQLValueString($_POST['transporte'], "text"), 
	   GetSQLValueString(1, "int")
	  ); 
      $Result = mysql_query($insertSQL, $conexion);

echo $insertado;
mysql_free_result($select);
   
}

} else {echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, los cupos ya estan completos.</div>';  } 


}
 else {  }



 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('congresosst23'); ?></h3>

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
             
 <h3><?php 
 $query4 = sprintf("SELECT count(id_congresosst23) as contador FROM congresosst23 where 
 nombre_congresosst23='Virtual' and estado_congresosst23=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
echo $row4['contador'];
$result4->free();
 ?></h3>
			  
              <p>Virtual</p>
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
              <h3><?php  $query4 = sprintf("SELECT count(id_congresosst23) as contador FROM congresosst23 where 
 nombre_congresosst23='Presencial' and estado_congresosst23=1"); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
echo $row4['contador'];
$result4->free();
 ?></h3>
              <p>Presencial</p>
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
 if(1==1)  //$fecha_actual > $fecha_limite)
	{


	?>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>
	<?php } else {} ?>

 II Congreso de Seguridad y Salud en el Trabajo que realizara la SNR el día 28 de abril de 2023.
<br>Las personas que quieran participar de manera presencial son únicamente funcionarios que pertenezcan a oficinas de la ciudad de Bogotá (Nivel Central, Bogotá Centro, Bogotá Norte, Bogotá sur).
  
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
				  
				  <th>Oficina / Grupo</th>
				  	  <th>Tipo</th>
				
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
if (1==$_SESSION['rol'] or 0<$nump111) {
$query4="SELECT * from congresosst23, funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and congresosst23.id_funcionario=funcionario.id_funcionario and estado_congresosst23=1  ORDER BY id_congresosst23 desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from congresosst23, funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and congresosst23.id_funcionario=funcionario.id_funcionario and estado_congresosst23=1 and funcionario.id_funcionario=".$_SESSION['snr']."  ORDER BY id_congresosst23 desc  "; //LIMIT 500 OFFSET ".$pagina."
}

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
<?php
$id_res=$row['id_congresosst23'];
echo '<td>'.$row['fecha_registro'].'</td>';
echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>'.$row['correo_funcionario'].'</td>';
echo '<td>'.$row['nombre_grupo_area'].'</td>';
echo '<td>'.$row['nombre_congresosst23'].'</td>';

echo '<td>';

if (1==$_SESSION['rol'] or 0<$nump111) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="congresosst23" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
} 

?>
">
</div>




 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">* </span>Tipo de asistencia:</label> 
<select class="form-control" name="nombre_congresosst23" required>
<option></option>
<option>Virtual</option>
<option>Presencial</option>
</select>
</div>

<!--
 <div class="form-group text-left"> 
<label  class="control-label"> Si es presencial, ¿utilizará transporte de la SNR?:</label> 
<select class="form-control" name="transporte">
<option></option>
<option>Si</option>
<option>No</option>
</select>
</div>
-->


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


	} else {
		
		echo 'No disponible.';
	}

}
 else { echo 'Solo es para funcionarios de oficinas de la ciudad de Bogotá (Nivel Central, Bogotá Centro, Bogotá Norte, Bogotá sur).';  }
 ?>


<?php

$nump111=privilegios(111,$_SESSION['snr']);


if (3>$_SESSION['snr_tipo_oficina'] && (1==$_SESSION['snr_grupo_cargo'] or 2==$_SESSION['snr_grupo_cargo'] 
or 4==$_SESSION['snr_grupo_cargo'])) { 


if ((isset($_POST["tipom"])) && (""!=$_POST["tipom"]) && 
(3>$_SESSION['snr_tipo_oficina'])) {
	

$insertSQL = sprintf("INSERT INTO salalactante (
 id_funcionario, tipom, nombreb, nacimiento, estado_salalactante) 
VALUES (%s, %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"),
GetSQLValueString($_POST['tipom'], "text"),
GetSQLValueString($_POST['nombreb'], "text"),
GetSQLValueString($_POST['nacimiento'], "date"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

echo $insertado;
  
  

$emailur2=$_SESSION['snr_correo'];
$subject = 'CONFIRMACIÓN DE REGISTRO EN SALAS LACTANTES';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que se ha registrado correctamente el registro a salas lactantes de la SNR.<br><br>';

$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);


}
 else { }

 
 


?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('salalactante'); ?></h3>

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
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">
 
  
  <p>
<b>  Salas lactantes</b>


  </p>
  
  
<?php 


$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-07-10 08:00:00");
$fecha_limite = strtotime("2023-07-15 17:00:00");

if (3>$_SESSION['snr_tipo_oficina']) {

 ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button> 
	  
	  
	 <?php if (isset($_GET['i'])) { 
	 echo ' / ';
//echo quees('oficina_registro',$idorip);
 } else {
 
 } 
 ?>
	  </h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Registro</th>
		<th>Funcionario</th>
		
				  <th>Regional</th>
				  <th>Oficina</th>
				 	
						<th>Tipo</th>
						<th>Nombre del bebe</th>
						<th>Meses</th>
						
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 




if (1==$_SESSION['rol'] or 0<$nump111) {
$query4="SELECT * from salalactante, funcionario where salalactante.id_funcionario=funcionario.id_funcionario and estado_salalactante=1 ".$infop." ORDER BY id_salalactante desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from salalactante, funcionario where salalactante.id_funcionario=funcionario.id_funcionario and estado_salalactante=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_salalactante desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_salalactante'];
echo '<td>'.$row['nombre_salalactante'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';


if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';		
}


echo '<td>';
echo $row['tipom'];
echo '</td>';
echo '<td>';
echo $row['nombreb'];
echo '</td>';
echo '<td>';
echo calculameses($row['nacimiento']);
echo '</td>';




echo '<td>';


	if (1==$_SESSION['rol'] or 0<$nump111) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="salalactante" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

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


<?php if (3>$_SESSION['snr_tipo_oficina']) { ?>





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
        
<form action="" method="POST" name="for54354r653454345345464324324563m1" enctype="multipart/form-data" >


 
 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cedúla:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Mamá:</label> 
<select class="form-control"  name="tipom"  required>
<option selected></option>
<option>Mamá gestante</option>
<option>Mamá lactante</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label">Nombre del bebe:</label> 
<input type="text" class="form-control "  name="nombreb"  >
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Fecha nacimiento:</label> 
<input type="text" class="form-control datepickera" readonly name="nacimiento" required >
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








	  



<?php } else { }


} else {} ?>




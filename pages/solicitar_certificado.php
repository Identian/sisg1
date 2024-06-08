<?php
$nump165=privilegios(165,$_SESSION['snr']);

// if ((3>$_SESSION['snr_tipo_oficina'] and (3==$_SESSION['vinculacion'] or 4==$_SESSION['vinculacion'])) or (0<$nump165)) {
if (1==$_SESSION['rol']) {


if (3>$_SESSION['snr_tipo_oficina'] and 3==$_SESSION['vinculacion'] and '1'==$_POST['solicita']) {
$insertSQL = sprintf("INSERT INTO soli_certificado (
 id_funcionario, estado_soli_certificado) 
VALUES (%s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
 echo $insertado;
} else { }
	
	
	
	

if ((isset($_POST["contacto_soli_certificado"])) && (""!=$_POST["contacto_soli_certificado"])) {
	
$funcionario=$_SESSION['snr']; 


  $updateSQL = sprintf("UPDATE funcionario SET  celular_funcionario=%s WHERE id_funcionario=%s and estado_funcionario=1",                  
					   GetSQLValueString($_POST["celular_funcionario"], "text"),
					    GetSQLValueString($funcionario, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);


$emailur2=$_SESSION['snr_correo'];
$subject = 'CONFIRMACIÓN DE REGISTRO PARA UNA VIDA DE LABOR';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que se ha registrado correctamente el registro a una vida de labor.<br><br>';
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);


} else {}

 
 


?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('soli_certificado'); ?></h3>

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
  <b>Solicitud de certificaciones con funciones para provisionales y empleo temporal</b>
  <br><br>
  En caso de requerir información adicional o <b>verificar</b> la información contenida en la certificación, podrá solicitarla al correo
<a href="mailto:certificacionessnr@supernotariado.gov.co">certificacionessnr@supernotariado.gov.co</a>
  </p>
  
  <?php
  $query346 = sprintf("select id_soli_certificado from soli_certificado 
  where id_funcionario=".$_SESSION['snr']." and estado_soli_certificado=1"); 
$select346 = mysql_query($query346, $conexion);  
$rowrt46 = mysql_fetch_assoc($select346);
$totalRows346 = mysql_num_rows($select346);
if (0<$totalRows346){ } else {
	
	
	
$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-09-01 08:00:00");
$fecha_limite = strtotime("2023-09-15 23:59:59");

if ($fecha_actual<$fecha_limite) {
	?>

    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Solicitar
      </button>  

	  </h3>
<?php 
} else { }
} 
mysql_free_result($select346); ?>

	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
  <th>Reg.</th>
  <th>Fecha</th>
 <th>Nombre</th>
 <th>Correo</th>
<th>CC</th>
<th>Oficina</th>
<th>Area</th>
<th>Certificado</th>
<th></th>
</tr>
</thead>
<tbody>
				
<?php 


function estadocert($ccfun){
global $mysqli;
$query = "SELECT id_nomina FROM nomina where identificacion=".$ccfun." and revisado=1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$valorc=1;
} else { 
$valorc=0;
}
return $valorc;
$result->free();
}


 


if (1==$_SESSION['rol'] or 0<$nump165) {
$query4="SELECT * from soli_certificado, funcionario where soli_certificado.id_funcionario=funcionario.id_funcionario and estado_soli_certificado=1 ORDER BY id_soli_certificado desc  "; 
} else {
$query4="SELECT * from soli_certificado, funcionario where soli_certificado.id_funcionario=funcionario.id_funcionario and estado_soli_certificado=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_soli_certificado desc  "; 
}

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_soli_certificado'];

echo '<td>';
echo $id_res;
echo '</td>';
echo '<td>';
echo $row['fecha_sol'];
echo '</td>';

echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>';
echo $row['correo_funcionario'];
echo '</td>';
echo '<td>';
echo $row['cedula_funcionario'];
echo '</td>';
if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
}


echo '<td>';
/*
$resc=estadocert($row['cedula_funcionario']);
if (1==$resc) {
	echo '<a href="pdf/certificado_convocatoria&'.$row['id_funcionario'].'.pdf" style="color:#009551">Descargar</a>';
} else {
	*/
	


$resc=estadocert($row['cedula_funcionario']);

$nump165=privilegios(165,$_SESSION['snr']);

if (1==$resc)
{
	echo '<a href="pdf/certificado_convocatoria&'.$row['id_funcionario'].'.pdf" style="color:#009551">Descargar</a>';

} else {
if (0<$nump165) {
	echo '<a href="generar_certificado&'.$row['id_funcionario'].'.jsp" target="_blank">Tramitar</a>';	

} else {
	echo 'En tramite';
}

}
/*
if (1==$_SESSION['rol'] or 0<$nump165) {
	echo '<a href="generar_certificado&'.$row['id_funcionario'].'.jsp" target="_blank">Tramitar</a>';
} else {
	echo 'En tramite';
}*/
	
	
//}
echo '</td>';


echo '<td>';
	if (1==$_SESSION['rol']) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="soli_certificado" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

	} else {}
echo '</td>';
?>
      
                  </tr>
                <?php } 
				$result->free();
				?>

				
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
<label  class="control-label"><span style="color:#ff0000;">*</span> Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">Fecha:</label> 
<input type="text" class="form-control" readonly value="<?php echo date('Y-m-d H:i:s'); ?>">
</div>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Solicitar </button>
</div>
<input type="hidden" name="solicita" value="1">
</form>


      </div>
    </div>
  </div>
</div>





	  



<?php 
} else { echo 'No tiene acceso. ';} ?>






<?php
$nump165=privilegios(165,$_SESSION['snr']);


if (1==$_SESSION['rol'] or 0<$nump165) {


 
 

if (isset($_GET['i'])) { 

$ed=intval($_GET['i']);
$updateSQL = sprintf("UPDATE nomina SET estado=1 WHERE  identificacion=%s ",				 
	GetSQLValueString($ed, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);


$query2357 = "SELECT * FROM funcionario WHERE cedula_funcionario=".$ed." limit 1";
$result2357 = mysql_query($query2357);	
 $row7 = mysql_fetch_assoc($result2357); 
$totalRows7 = mysql_num_rows($result2357);
if (0<$totalRows7){
	
$idf=$row7['id_funcionario'];
$correo=$row7['correo_funcionario'];

$emailu=$correo;
$subject = 'CERTIFICADO - SNR.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que ya se encuentra su certificado disponible para descarga. Por favor acceder al enlace:<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/pdf/certificado_convocatoria&'.$idf.'.pdf">https://sisg.supernotariado.gov.co/pdf/certificado_convocatoria&'.$idf.'.pdf</a>';


$cuerpo .= '<br><br><b>En caso de requerir información adicional o verificar la información contenida en la certificación, podrá solicitarla al correo
</b> certificacionessnr@supernotariado.gov.co';

$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'cc: certificacionessnr@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);



  


}
mysql_free_result($result2357);

} else { }
 
 
 
 //id_dependencia=0114000&id_cargo=2028&id_grado=22&id_nomina=9360&id_cedula=80180988
 
 if (isset($_POST['id_dependencia']) && ""!=$_POST['id_dependencia']) { 

$dep=$_POST['id_dependencia'];
$car=$_POST['id_cargo'];
$grad=$_POST['id_grado'];
$nom=$_POST['id_nomina'];
$ced=$_POST['id_cedula'];
$fecha=$_POST['fecha_ingreso2'];

/*
$updateSQL = "UPDATE nomina SET codegrupo='$dep', fecha_ingreso2=".$fecha.", cargo=".$car.", grado=".$grad." WHERE id_nomina=".$nom." and identificacion=".$ced."";			 
$Result1 = mysql_query($updateSQL, $conexion);
*/


$updateSQL = sprintf("UPDATE nomina SET codegrupo=%s, cargo=%s, grado=%s, fecha_ingreso2=%s WHERE id_nomina=%s and identificacion=%s",				 
	GetSQLValueString($_POST['id_dependencia'], "text"),
		GetSQLValueString($_POST['id_cargo'], "int"),
			GetSQLValueString($_POST['id_grado'], "int"),
				GetSQLValueString($_POST['fecha_ingreso2'], "date"),
				GetSQLValueString($_POST['id_nomina'], "int"),
				GetSQLValueString($_POST['id_cedula'], "int"));
  $Result1 = mysql_query($updateSQL, $conexion);
  
  
 
echo $actualizado;
} else { }





?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('nomina');   ?></h3>

              <p>Registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
	
            <a href="#" data-toggle="modal" data-target="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> <?php 
$selectu = mysql_query("SELECT count(DISTINCT(identificacion)) as totale FROM nomina where estado_nomina=1", $conexion);
$rowu = mysql_fetch_assoc($selectu);
$servi= $rowu['totale'];
echo $servi;
mysql_free_result($selectu);
?></h3>

              <p>Servidores</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" data-toggle="modal" data-target="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3><?php 
$selectus = mysql_query("SELECT count(DISTINCT(identificacion)) as totales FROM nomina where revisado=1 and estado_nomina=1", $conexion);
$rowus = mysql_fetch_assoc($selectus);
$servis= $rowus['totales'];
echo $servis;
mysql_free_result($selectus);
?></h3>
			  
              <p>Hechos</p>
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
              <h3><?php
			  $tot= $servi-$servis;
			  echo $tot;
			  ?></h3>
              <p>Pendientes</p>
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
  
  
  
  <div class="col-md-4">
 <h3  class="box-title">
HISTORIAL LABORAL
	  </h3>
	  </div>
	  
	  <div class="col-md-8">
	  <form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">Buscar 
<select class="form-control" name="campo" required>
          <option value="" selected> - - Buscar por: - -  </option>
 <option value="identificacion">Cédula</option>
  <option value="namefuncionario">Nombre</option>
<option value="codegrupo">Código dependencia</option>
<option value="cargo">Cargo</option>
<option value="grado">Grado</option>
		  </select>
</div><!-- /btn-group -->
<div class="input-group-btn">
<input type="text" name="buscar" Autofocus placeholder="" class="form-control" required ></div>
    <!-- /input-group -->
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>

</form>
</div>
	  
	  
	  

  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

				<style>


.dataTables_filter {
display:none;
}



.dataTables_paginate {
display:none;
}

			</style> 
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>CC</th>	
 <th>Nombre</th>
<th>Tipo</th>		
<th>Acto</th>		
<th>Fecha</th>
<th>Dependencia</th>
<th>Manual</th>	
<th># Cargo</th>
<th>Grado</th>	
<th>Estado</th>	
<th>Cargo</th>					   					   
<th style="width:65px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 

if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
				$infop=" and estado_nomina=1 and ".$_POST['campo']." like '%".$_POST['buscar']."%' limit 100";
			
				} else {
					
				$infop=' and estado_nomina=1 limit 50 ';
				
				
				}
 
 

//$query4="SELECT * from nomina, dependencia, funcionario where nomina.codegrupo=dependencia.codigo and nomina.identificacion=funcionario.cedula_funcionario"; 
$query4="SELECT * from nomina, dependencia, funcionario where nomina.identificacion=funcionario.cedula_funcionario and nomina.codegrupo=dependencia.codigo ".$infop.""; 

$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {
?>  
<tr>
				<?php
$id_res=$row['id_nomina'];
$id_u=$row['id_funcionario'];
echo '<td>';
echo $row['identificacion'];
echo '</td>';
echo '<td>';
echo ''.$row['namefuncionario'].'';
echo '</td>';
echo '<td>';
echo $row['tipo_acto'];
echo '</td>';
echo '<td>';
echo $row['numero_acto'];
echo '</td>';
echo '<td>';
echo $row['fecha_ingreso2'];
echo '</td>';

echo '<td>';
echo $row['codegrupo'].' / '.$row['nombre_dependencia'];
echo '</td>';

echo '<td>';
 echo ' <a href="generar_certificado&'.$row['id_funcionario'].'.jsp" target="_blank">Cert. Manual</a> ';
echo '</td>';


echo '<td>';
echo $row['cargo'];
echo '</td>';
echo '<td>';
echo $row['grado'];
echo '</td>';

echo '<td>';
 if (1==$row['estado']) { echo '<span style="color:#00A65A"><b>Ok</b></span>'; } else { echo '<span style="color:#B40404"><b>X</b></span>'; 
 
 //echo ' <a href="hlaboral&'.$row['identificacion'].'.jsp">Aprobar</a> ';
 echo 'Pendiente';
 }

echo '</td>';


echo '<td>';
echo $row['desc_cargo'];
echo '</td>';

echo '<td>';


//echo  '<a href="" title="Actualizar" id="'.$id_res.'" class="ver_nomina" data-toggle="modal" data-target="#popupnomina"><button class="btn btn-xs btn-warning">Act.</button></a> ';
		

//echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_res.'" name="nomina" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

	
		
		
echo ' <a href="pdf/certificado_convocatoria&'.$id_u.'.pdf"> <i class="fa fa-file"></i> </a>';

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
							"url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
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





<div class="modal fade bd-example-modal-lg" id="popupnomina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Actualizar</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="respuestanomina" class="modal-body">

   </div>
    </div>
  </div>
</div>



<?php
} else {
}
?>




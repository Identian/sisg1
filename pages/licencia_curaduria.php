<?php
if (isset($_GET['i'])) {
	$id=$_GET['i'];
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }


$nump21=privilegios(21,$_SESSION['snr']);

//echo $_SESSION['snr'];  //10959

if (1==$_SESSION['rol'] or 0<$nump21) {
	
$query = sprintf("SELECT * FROM curaduria where id_curaduria=".$id."  and curaduria.estado_curaduria=1 limit 1"); 
	
} 
else {
	
	/*if (17==$id) {
	$idfun=intval($_SESSION['snr']);
	$query = sprintf("SELECT * FROM curaduria, funcionario, relacion_curaduria where funcionario.id_funcionario=".$idfun." and relacion_curaduria.id_funcionario=funcionario.id_funcionario and  relacion_curaduria.id_curaduria=curaduria.id_curaduria and curaduria.id_curaduria=".$id." limit 1"); 
} else {
	*/
$idfun=intval($_SESSION['snr']);
$query = sprintf("SELECT * FROM curaduria, situacion_curaduria where (situacion_curaduria.fecha_terminacion>='$realdate' or situacion_curaduria.fecha_terminacion is null) and curaduria.id_curaduria=situacion_curaduria.id_curaduria  and curaduria.id_curaduria=".$id." and situacion_curaduria.id_funcionario=".$idfun."  and curaduria.estado_curaduria=1 and estado_situacion_curaduria=1 limit 1"); 
	
//}
}

$select = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
$name = $row1['nombre_curaduria'];
$dep = $row1['departamento_curaduria'];
$ciudad = $row1['ciudad_curaduria'];
$tele = $row1['telefono_curaduria'];
$celu = $row1['celular_curaduria'];
$dire = $row1['direccion_curaduria'];
$nombre_curador = $row1['nombre_funcionario'];
$correo = $row1['correo_funcionario'];
$correo_curaduria = $row1['correo_curaduria'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];
$ncuraduria=$row1['numero_curaduria'];


$idfuncionarioreal=$_SESSION['snr'];



if ((isset($_POST['table'])) && ($_POST['table'] == "licencia_curaduria")) { 

$identificador=$_POST["normalizacion_curaduria"].$_POST["ano_licencia"].'-'.$_POST["nombre_licencia_curaduria"];

$actualizar56 = mysql_query("SELECT nombre_licencia_curaduria FROM licencia_curaduria WHERE id_curaduria=".$id." and nombre_licencia_curaduria='$identificador' and estado_licencia_curaduria=1", $conexion);
$row156 = mysql_fetch_assoc($actualizar56);
$total556 = mysql_num_rows($actualizar56);
if (0<$total556) {
	echo $repetido;
} else {




$fecha_radicacion=date('Y-m-d', strtotime($_POST["fecha_radicacion"]));
$fecha_expedicion=date('Y-m-d', strtotime($_POST["fecha_expedicion"]));
$fecha_ejecutoria=date('Y-m-d', strtotime($_POST["fecha_ejecutoria"]));

if ($fecha_radicacion<$fecha_expedicion && $fecha_radicacion<$fecha_ejecutoria && $fecha_ejecutoria>=$fecha_expedicion) {




$insertSQL = sprintf("INSERT INTO licencia_curaduria (id_curaduria, id_funcionario, nombre_licencia_curaduria, 
fecha_licencia_real, fecha_radicacion, fecha_expedicion, fecha_ejecutoria, n_acto_administrativo, 
certificado_ocupacion, autorizacion_ocupacion, observacion_licencia, situacion_licencia, 
estado_licencia_curaduria) VALUES (%s, %s, %s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($idfuncionarioreal, "int"), 
GetSQLValueString($identificador, "text"), 
GetSQLValueString($_POST["fecha_radicacion"], "date"), 
GetSQLValueString($_POST["fecha_expedicion"], "date"), 
GetSQLValueString($_POST["fecha_ejecutoria"], "date"), 
GetSQLValueString(trim($_POST["n_acto_administrativo"]), "text"),  
GetSQLValueString($_POST["certificado_ocupacion"], "text"), 
GetSQLValueString($_POST["autorizacion_ocupacion"], "text"), 
GetSQLValueString($_POST["observacion_licencia"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;

$actualizar5 = mysql_query("SELECT id_licencia_curaduria FROM licencia_curaduria WHERE id_curaduria='$id' and nombre_licencia_curaduria='$identificador' limit 1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$id_lic2 = $row15['id_licencia_curaduria'];

echo '<meta http-equiv="refresh" content="1;URL=licencia&'.$id_lic2.'.jsp" />';


} else {
echo '<div class="alert alert-danger" role="alert"><a href="" class="close" style="text-decoration:none;">&times;</a>Las fechas no estan de acuerdo al orden cronológico.</div>';
	
}


}
  mysql_free_result($actualizar56);

} else { }




?>	




	<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
             <h3>
			 <?php 		
$query="SELECT count(id_tipo_autorizacion_licencia) as cuenta FROM licencia_curaduria, tipo_autorizacion_licencia where id_clase_licencia=1 and  licencia_curaduria.id_licencia_curaduria=tipo_autorizacion_licencia.id_licencia_curaduria and licencia_curaduria.id_curaduria=".$id." and estado_tipo_autorizacion_licencia=1 and licencia_curaduria.estado_licencia_curaduria=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
echo $row1['cuenta'];
?> 
			 </h3>

              <p>Licencia de Urbanización</p>
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
             <h3>
			 <?php 		
$query="SELECT count(id_tipo_autorizacion_licencia) as cuenta FROM licencia_curaduria, tipo_autorizacion_licencia where id_clase_licencia=2 and  licencia_curaduria.id_licencia_curaduria=tipo_autorizacion_licencia.id_licencia_curaduria and licencia_curaduria.id_curaduria=".$id." and estado_tipo_autorizacion_licencia=1 and licencia_curaduria.estado_licencia_curaduria=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
echo $row1['cuenta'];
?> 
			 </h3>

              <p>Licencia de Parcelación</p>
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
             <h3>
			 <?php 		
$query="SELECT count(id_tipo_autorizacion_licencia) as cuenta FROM licencia_curaduria, tipo_autorizacion_licencia where id_clase_licencia=3 and  licencia_curaduria.id_licencia_curaduria=tipo_autorizacion_licencia.id_licencia_curaduria and licencia_curaduria.id_curaduria=".$id." and estado_tipo_autorizacion_licencia=1 and licencia_curaduria.estado_licencia_curaduria=1";
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
echo $row1['cuenta'];
?> 
			 </h3>

              <p>Licencia de Subdivisión</p>
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
                  <h3>
			 <?php 		
$query="SELECT count(id_tipo_autorizacion_licencia) as cuenta FROM licencia_curaduria, tipo_autorizacion_licencia where id_clase_licencia=4 and  licencia_curaduria.id_licencia_curaduria=tipo_autorizacion_licencia.id_licencia_curaduria and licencia_curaduria.id_curaduria=".$id." and estado_tipo_autorizacion_licencia=1 and licencia_curaduria.estado_licencia_curaduria=1";
$select = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select);
echo $row1['cuenta'];
?> 
			 </h3>

              <p>Licencia de Construcción</p>
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



 <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
				


<a href="nueva_licencia_curaduria&<?php echo $id; ?>.jsp" class="btn btn-success" ><span class="glyphicon glyphicon-plus-sign"></span> Nuevo </a>
  
			
				
				<strong>  &nbsp; Licencias /
	   <?php echo $name; 
	   echo ' - ';
	   echo quees('departamento', $id_departamento); 
	    echo ' - ';
	   echo nombre_municipio($id_municipio, $id_departamento); 
	   ?>

				
				</strong></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
  
  
  
     <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 
Buscar:
<th>Radicación	</th>
<th>Acto admin.	</th>
<th>	Fecha de Expedición		</th>
<th>Fecha de Vencimiento</th>
<TH>Cert. ocupación</TH>	

<TH></TH>				  
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
					
				$infop='';
				
	if (isset($_GET['i']) && ""!=$_GET['i']) {
		$pagina=intval($_GET['i']);
	 } else {
		$pagina=0;  
	 }
	}*/
 



 if (isset($_GET['i'])) { 
 $id=$_GET['i']; 
 $qid=' id_curaduria='.$id.' and '; 
 } else {  $qid=''; } 
	
	
$query4="SELECT * FROM licencia_curaduria where ".$qid." estado_licencia_curaduria=1  order by id_licencia_curaduria desc ";




$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$idcc=$row['id_licencia_curaduria'];

echo '<td>'.$row['nombre_licencia_curaduria'].'</td>';

echo '<td>'.$row['n_acto_administrativo'].'</td>';
echo '<td>'.$row['fecha_ejecutoria'].'</td>';
echo '<td>'.$row['fecha_terminacion_l'].'</td>';
echo '<td>'.$row['certificado_ocupacion'].'</td>';
echo '<td>';



$valosi=intval($row['situacion_licencia']);
if (0==$valosi)
{
$infoi='<a href="licencia&'.$row['id_licencia_curaduria'].'.jsp" title="Ver Licencia"><span class="label label-warning">Anulada</span></a> &nbsp;';
$pdf='<a href="pdf/licencia&'.$row['nombre_licencia_curaduria'].'.pdf" title="PDF"><img src="images/pdf.png"></a> ';
$pdf2='';
} else {
	

$valori=intval($row['licencia_cerrada']);
if (0<$valori)
{
$infoi='<a href="licencia&'.$row['id_licencia_curaduria'].'.jsp" title="Ver Licencia"><span class="label label-success">Cerrado</span></a> &nbsp;';
$pdf='<a href="pdf/licencia&'.$row['nombre_licencia_curaduria'].'.pdf" title="PDF"><img src="images/pdf.png"></a> ';
$pdf2='';
} else {
$infoi='<a href="licencia&'.$row['id_licencia_curaduria'].'.jsp" title="Ver Licencia"><span class="label label-danger">Abierto</span></a> &nbsp;';
$pdf='';
$pdf2='';
}
}

echo $infoi.$pdf.$pdf2;
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
	  
  <!--
            <div class="box-body">
              <div class="table-responsive">
                <table id="datatabla" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Radicación</th>
                        <th>Acto admin.</th>
                        <th>Fecha de Expedición</th>
						 <th>Fecha de Vencimiento</th>
                        <th style="min-width:120px;"></th>         
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
              
            </div>-->
            
          </div>
		  
		  


        </div>
		
		

</div>


















<?php } else {} ?>


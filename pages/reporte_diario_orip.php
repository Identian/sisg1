<?php
$nump95=privilegios(95,$_SESSION['snr']);


if (isset($_POST['fecha'])){ 
$fechan=$_POST['fecha'];
 } else {
$fechan=date('Y-m-d');  
 } 



if (1==$_SESSION['rol'] or 0<$nump95) {

if (isset($_GET['i'])) { 
$idorip=$_GET['i'];
 } else {
$idorip=195;  
 } 
	   


} else {
$idorip=$_SESSION['id_oficina_registro'];
}



if (isset($_GET['e']) && "" != $_GET['e'] && isset($_GET['i']) && "" != $_GET['i'] and (1==$_SESSION['rol'] or 0<$nump95)) {
$idorip = $_GET['i'];
$estado=intval($_GET['e']);
$updateSQL = sprintf("UPDATE reporte_dia_orip SET cerrado=%s, fecha_cierre=now() where id_reporte_dia_orip=%s",
GetSQLValueString(1, "int"), 
GetSQLValueString($estado, "int"));
$Result = mysql_query($updateSQL, $conexion) ;
}



if ((isset($_POST["impedimento"])) && ($_POST["impedimento"] != "") && 0<$idorip) {

if ('No'==$_POST["impedimento"]) {
	$situa=12;
} else {
	$situa=$_POST["id_situacion_orip"];
}


$insertSQL = sprintf("INSERT INTO reporte_dia_orip (nombre_reporte_dia_orip, 
id_oficina_registro,  impedimento, nivel, id_situacion_orip, fecha_publicacion, hora_publicacion, estado_reporte_dia_orip) 
VALUES (%s, %s, %s, %s, %s, now(), now(), %s)", 
GetSQLValueString($_POST["nombre_reporte_dia_orip"], "text"), 
GetSQLValueString($idorip, "int"), 
GetSQLValueString($_POST["impedimento"], "text"), 
GetSQLValueString($_POST["nivel"], "text"),
GetSQLValueString($situa, "int"), 
GetSQLValueString(1, "int"));


$Result = mysql_query($insertSQL, $conexion) ;

echo $insertado;
   
if (isset($_POST["impedimento"]) and ("Si"==$_POST["impedimento"])) {
	
$situacion=nombretabla('situacion_orip',$situa);
$orip=nombretabla('oficina_registro',$idorip);
	
//$emailur2='cristian.romero@supernotariado.gov.co'; //,giovanni.ortegon@supernotariado.gov.co

$emailur2='direcciontecnica@supernotariado.gov.co';

$subject = 'NUEVA SITUACIÓN';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado una situación<br><br>';
$cuerpo2 .= '<br>Orip: '.$orip;
$cuerpo2 .= '<br>Impedimento: '.$_POST["impedimento"];
$cuerpo2 .= '<br>Nivel: '.$_POST["nivel"];
$cuerpo2 .= '<br>Situación: '.$situacion;

$cuerpo2 .= '<br>Observación: '.$_POST["nombre_reporte_dia_orip"];
$cuerpo2 .= "<br><br>"; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);
   } else {}

   
}
 else { 
 echo '';
 
 }

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3>
			  <?php	  
$query4h = sprintf("SELECT count(id_reporte_dia_orip) as tot FROM reporte_dia_orip where 
estado_reporte_dia_orip=1 and fecha_publicacion='$fechan'
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['tot'];
$result4h->free();
 echo $reshh;
			  ?></h3>
              <p>Cantidad de registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> <?php	  
$query4h = sprintf("SELECT count(id_reporte_dia_orip) as imp FROM reporte_dia_orip where 
estado_reporte_dia_orip=1 and impedimento='Si' and fecha_publicacion='$fechan'
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['imp'];
$result4h->free();
 echo $reshh;
			  ?></h3>

              <p>Con Situación</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>
  <?php	  
$query4h = sprintf("SELECT count(id_reporte_dia_orip) as imp FROM reporte_dia_orip where 
estado_reporte_dia_orip=1 and impedimento='Si' and cerrado=1 and fecha_publicacion='$fechan'
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['imp'];
$result4h->free();
 echo $reshh;
			  ?>
			  </h3>
			 
              <p>Situaciones cerradas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>  <?php	  
$query4h = sprintf("SELECT count(distinct id_oficina_registro) as imp FROM reporte_dia_orip where 
estado_reporte_dia_orip=1 and fecha_publicacion='$fechan' 
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['imp'];
$result4h->free();
 echo $reshh;
			  ?></h3>
              <p>Diligenciado por Orip</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $fechan; ?></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-3">
<?php 


$permisosorip=privreg($idorip, $_SESSION['snr'], 6, 11);

 if (1==$_SESSION['rol'] or (2==$_SESSION['snr_tipo_oficina'] and (1==$_SESSION['snr_grupo_cargo'] or 0<$permisosorip))) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-5">

	
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">
<input type="text" name="fecha"  class="form-control datepicker" required ></div>
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>

</form>


</div>

<div class="col-md-4">
	<?php   if (1==$_SESSION['rol'] or 0<$nump95) { 
	
	echo '<a href="reporte_diario_orip.jsp">Inicio</a><br>';
	
	echo '<img src="images/xls.png"> <a href="xls/reporte_dia_orip.xls"> Completo</a> / ';

echo '<a href="xls/funcionariosconreportediario.xls">Funcionarios</a>';



	   } else {} 
	   ?>
	   </div>
  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
                <thead>
 <tr align="center" valign="middle">
 <th>FECHA</th>
   <th>REGION</th>
				  <th>ORIP</th>
<th>SITUACIÓN</th>
				 <th>TIPO</th>
				 <th>NIVEL</th>
				  <th>OBSERVACIÓN</th>
<TH>CERRADO</TH>	
<TH></TH>				  
</tr>
</thead>
<tbody>
<?php 

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
				
				}
 



if (1==$_SESSION['rol'] or 0<$nump95) {

if (isset($_GET['i'])){
$idorip=$_GET['i'];
$queryid= " reporte_dia_orip.id_oficina_registro=".$idorip." and ";
	} else {
$queryid="";	
	}
	
$query4="SELECT * from oficina_registro, region, reporte_dia_orip, situacion_orip where oficina_registro.id_region=region.id_region and fecha_publicacion='$fechan' and ".$queryid." oficina_registro.id_oficina_registro=reporte_dia_orip.id_oficina_registro and reporte_dia_orip.id_situacion_orip=situacion_orip.id_situacion_orip and estado_reporte_dia_orip=1  ORDER BY fecha_publicacion desc ";
} else {
$idorip=$_SESSION['id_oficina_registro'];
$query4="SELECT * from oficina_registro, region, reporte_dia_orip, situacion_orip where oficina_registro.id_region=region.id_region and fecha_publicacion='$fechan' and reporte_dia_orip.id_oficina_registro=".$idorip." and oficina_registro.id_oficina_registro=reporte_dia_orip.id_oficina_registro and reporte_dia_orip.id_situacion_orip=situacion_orip.id_situacion_orip and estado_reporte_dia_orip=1  ORDER BY fecha_publicacion desc ";
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_reporte_dia_orip'];
echo '<td>'.$row['fecha_publicacion'].' '.$row['hora_publicacion'].'</td>';
echo '<td>'.$row['nombre_region'].'</td>';
echo '<td>'.$row['nombre_oficina_registro'].'</td>';
echo '<td>'.$row['impedimento'].'</td>';
echo '<td>'.$row['nombre_situacion_orip'].'</td>';
echo '<td>'.$row['nivel'].'</td>';
echo '<td>'.$row['nombre_reporte_dia_orip'].'</td>';
echo '<td>';

if ('No'==$row['impedimento']){
	echo 'No aplica';
	}	else  {
if (1==$row['cerrado'])  {
	echo $row['fecha_cierre'];
}	else  { echo 'Activo'; }
	}
echo '</td>';
echo '<td><a href="orip&'.$row['id_oficina_registro'].'.jsp">Ver</a> ';

if ('No'==$row['impedimento']){
	echo '';
	}	else  {
if (1==$_SESSION['rol'] or 0<$nump95) {
echo ' &nbsp; <a href="reporte_diario_orip&'.$row['id_oficina_registro'].'&'.$id_res.'.jsp">Cerrar</a>';
	} else {
		 }
		 }
		 
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


<?php //if (1==$_SESSION['rol'] or 0<$nump73) { ?>


 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">Nuevo Registro</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r6tr45435tret5464563m1" >
 

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>¿En este momento la ORIP tiene alguna situación que impida prestar el servicio público registral?:</label> 
<select class="form-control" name="impedimento" id="impedimento" required>
<option value="" selected></option>
<option value="No">No</option>
<option value="Si">Si</option>
</select>
</div>


<div class="form-group text-left siimpedimento"> 
<label  class="control-label">Nivel percibido:</label> 
<select class="form-control" name="nivel" >
<option value="" selected></option>
<option value="Critico">Critico</option>
<option value="Alto">Alto</option>
<option value="Medio">Medio</option>
<option value="Bajo">Bajo</option>
</select>
</div>



<div class="form-group text-left siimpedimento"> 
<label  class="control-label">Situación:</label> 
<select class="form-control" name="id_situacion_orip">
<option value="" selected></option>
<?php 

$query = sprintf("SELECT * FROM situacion_orip where estado_situacion_orip=1 order by id_situacion_orip"); 

$select = mysql_query($query, $conexion);

$row = mysql_fetch_assoc($select);

$totalRows = mysql_num_rows($select);

if (0<$totalRows){

do {

	echo '<option value="'.$row['id_situacion_orip'].'">'.$row['nombre_situacion_orip'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 

mysql_free_result($select);

?>
</select>
</div>


<div class="form-group text-left siimpedimento"> 
<label  class="control-label"> OBSERVACIONES:</label> 
<textarea class="form-control" name="nombre_reporte_dia_orip"></textarea>
</div>







<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="carrera_notarial">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>


<?php //} else { }?>




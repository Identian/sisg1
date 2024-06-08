<?php

$nump115=privilegios(115,$_SESSION['snr']);


if (1226==$_SESSION['snr'] or 0<$nump115) { 





function restitucion(){
	
$realfecha=date('Y-m-d h:i:s');
global $mysqli;
$query = "SELECT * from reparto where fechaaccion<='$realfecha' and tipo_accion=2 and restituido IS NULL  ORDER BY RAND () LIMIT 1";

$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$notariasf=$row['id_notaria'];
$idrep=$row['id_reparto'];
$id_categoria_reparto2=$row['id_categoria_reparto'];
$id_departamento2=$row['id_departamento'];
$id_municipio2=$row['id_municipio'];



$query8857 = "UPDATE reparto SET restituido=1 WHERE id_reparto=".$idrep." and estado_reparto=1 and id_notaria is not null and hash is not null";  
$result44343247 = $mysqli->query($query8857);



$query44 = "SELECT reparto.id_reparto, nombre_reparto, correos_intervinientes, id_categoria_reparto, id_departamento, id_municipio, nombre_entidad_reparto, correo_entidad  
FROM reparto, entidad_reparto  WHERE  id_notaria is null and hash is null and reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto and estado_reparto=1 and id_categoria_reparto=".$id_categoria_reparto2." and id_departamento=".$id_departamento2." and id_municipio=".$id_municipio2." limit 1";


//revisado=1 and

$result44 = $mysqli->query($query44);
$row44 = $result44->fetch_array();
if (0<count($row44)){
$reparto=$row44['id_reparto'];
$ronda=0;


	$id_reparto=$row44['id_reparto'];
	$nombre_entidad_reparto=$row44['nombre_entidad_reparto'];
	$nombre_reparto=$row44['nombre_reparto'];
	$correo_entidad=$row44['correo_entidad'];
	$correos_intervinientes=$row44['correos_intervinientes'];
	$id_categoria_reparto=$row44['id_categoria_reparto'];
	$id_departamento=$row44['id_departamento'];
	$id_municipio=$row44['id_municipio'];

$aleatorio=rand(0, 9);
$unico=$id_categoria_reparto.$ronda.$notariasf.$aleatorio;



$fechareparto=date('Y-m-d H:i:s');
$hash=md5($reparto.'-'.$id_categoria_reparto2.'-'.$ronda.'-'.$notariasf.'-'.$fechareparto);



$query885 = "UPDATE reparto SET fecha_reparto='$fechareparto', revisado=1, fecha_ejecuta_reparto='$fechareparto', id_notaria=".$notariasf.", id_ronda_reparto=0, unico=".$unico.", hash='$hash', reparto_original=".$idrep." WHERE id_reparto=".$reparto." and id_categoria_reparto=".$id_categoria_reparto2." and id_departamento=".$id_departamento2." and id_municipio=".$id_municipio2." and  estado_reparto=1 and id_notaria is null and hash is null limit 1";  
$result4434324 = $mysqli->query($query885);


}
$result44->free();



$linkp='https://servicios.supernotariado.gov.co/filesrep/'.$hash.'.pdf';
$urliris=$hash;
$clavep = substr($urliris, -4);

$emailu='giovanni.ortegon@supernotariado.gov.co,miguel.gonzalez@supernotariado.gov.co';
$subject = 'TEST Reparto notarial.';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Se realizo el reparto del proyecto ".$nombre_reparto." para la entidad ".$nombre_entidad_reparto."<br>";
$cuerpo .= "<br><br>Se ha enviado la notificación del acta de reparto a: ".$emailu;
$cuerpo .= "<br><br>Fecha y hora del acta de reparto: ".$fechareparto;
$cuerpo .= '<br><br>Enlace del acta: <a href="https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash.'.pdf">https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash.'.pdf</a><br>';
$cuerpo .= '<br><br>Las personas naturales deben usar la dirección web: <a href="'.$linkp.'">'.$linkp.'</a> ';
$cuerpo .= '<br> y acceder con la clave: '.$clavep.'<br>';
$cuerpo .= "<br><br>Notaria seleccionada: ".quees('notaria',$notariasf)."<br>";
$cuerpo .= "<br><br>Categoria de reparto: ".quees('categoria_reparto',$id_categoria_reparto)."<br>";
$cuerpo .= "<br><br>Hash de seguridad: ".$hash."<br>";
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'cc: reparto.notarial@supernotariado.gov.co'."\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);






} else { 
$infor=0;
}
$result->free();







return '';
}

echo restitucion();











if ((1==$_SESSION['rol'] or 0<$nump115) && isset($_POST['tipo_accion']) && ""!=$_POST['tipo_accion']) {	

if (2==$_POST['tipo_accion']) {
	
	
$diaf=(rand(5,10));
$horaf=(rand(1,24));
$minf=(rand(1,60));
$segf=(rand(1,60));
$masmenos12 = date('Y-m-d h:i:s', strtotime('+'.$diaf.' day', strtotime($realdate)));  //SUMA

$masmenos1 = date('Y-m-d h:i:s');

$fechaf=$masmenos1; 
	
	
	$infocc=" fechaaccion='$fechaf', ";         
} else {
	$infocc=" fechaaccion=NULL, ";
}


$numv=intval($_POST['reparto_proyectoid']);

$updateSQL778 = sprintf("UPDATE reparto SET tipo_accion=%s, ".$infocc." descripcion_accion=%s, numero_resolucion=%s, ano_resolucion=%s where id_reparto=%s", 
GetSQLValueString($_POST['tipo_accion'], "int"), 
GetSQLValueString($_POST['descripcion_accion'], "text"),   
GetSQLValueString($_POST['nresolucion'], "text"),   
GetSQLValueString($_POST['anoresolucion'], "text"),   
GetSQLValueString($numv, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 echo $actualizado;


}



?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('reparto'); ?></h3>

              <p>Repartos</p>
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
              <h3><?php echo existencia('reparto'); ?></h3>
              <p>Registros activos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="xls/repartos.xls" class="small-box-footer">Descargar. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
 
	  
	

<div class="col-md-4">
 RESTITUCIÓN DE REPARTOS
</div>
<div class="col-md-8">
<form action="" method="post" name="rtret">
<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected>- - - Buscar por:  - - - - </option>
 		  <option value="id_reparto"># Acta</option>
		   <option value="matriculas">Matricula</option>
		   <option value="intervinientes">Ciudadano</option>
		  
		  </select>
</div>
<div class="input-group-btn"><input type="text" style="width:250px;" name="buscar" placeholder="Buscar" class="form-control" required ></div>
 
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>
</div>
</form>
</div>
	
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
<style>
    .dataTables_filter {
          display: none;
        }
	
      </style>
			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Id</th>
 <th>Entidad</th>
 <th>Fecha registro</th>
 <th>Matriculas</th>
 <th>Proyecto</th>
 <th>Código</th>
 <th>Departamento</th>
 <th>Municipio</th>
 <th>Categoria</th>

<th>Acción</th>	
<th>Resolución</th>	
<th>Estado</th>	
		 	
<th style="width:150px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 











function urlresolucion($valore,$infot){
global $mysqli;
$query = "SELECT url_resolucion from resolucion where resolucion=".$valore." and vigencia=".$infot." limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if (0<count($row)){
$infores='<a href="files/resoluciones/'.$row['url_resolucion'].'" target="_blank">';
} else { 
$infores='<a href="">';
}

return $infores;
$result->free();
}


			if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {
$querynn = " and ".$_POST['campo']." like '%".$_POST['buscar']."%'";

		$query4="SELECT * from reparto, entidad_reparto, departamento, categoria_reparto where 
		reparto.id_departamento=departamento.id_departamento ".$querynn." 
		and reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto  
		and reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto ORDER BY id_reparto desc  "; 	

	} else {

		$query4="SELECT * from reparto, entidad_reparto, departamento, categoria_reparto where 
		reparto.id_departamento=departamento.id_departamento and estado_reparto=1 
		and reparto.id_categoria_reparto=categoria_reparto.id_categoria_reparto  
		and reparto.id_entidad_reparto=entidad_reparto.id_entidad_reparto and tipo_accion>0 ORDER BY id_reparto desc  limit 10"; 
}

$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {
?>  
<tr>
				<?php
$id_res=$row['id_reparto'];

echo '<td>'.$id_res.'</td>';
echo '<td>'.$row['nombre_entidad_reparto'].'</td>';
echo '<td>'.$row['fecha_ingreso'].'</td>';
echo '<td>'.$row['matriculas'].'</td>';
echo '<td>';
echo $row['nombre_reparto'];
echo '</td>';
echo '<td>'.$row['codigo'].'</td>';
echo '<td title="'.$row['id_departamento'].'">'.$row['nombre_departamento'].'</td>';
echo '<td title="'.$row['id_municipio'].'">';
echo nombre_municipio($row['id_municipio'], $row['id_departamento']);
echo '</td>';

echo '<td>'.$row['nombre_categoria_reparto'].'</td>';



echo '<td>';



if (1==intval($row['tipo_accion'])) {
	echo '<b>Anulado.</b> '.$row['descripcion_accion'];
} else if (2==intval($row['tipo_accion'])) {
	echo '<b>Por restitución.</b> '.$row['descripcion_accion'];
	
	
	} else if (3==intval($row['tipo_accion'])) {
echo '<b>Corrección.</b> '.$row['descripcion_accion'];
	
	
} else {}



echo '</td><td>';
if (isset($row['numero_resolucion'])) {
echo urlresolucion($row['numero_resolucion'],$row['ano_resolucion']);
echo $row['numero_resolucion'].' de '.$row['ano_resolucion'];
echo '</a>';
} else {}
echo '</td><td>';

if (isset($row['id_notaria']) && ""!=$row['id_notaria']) {
	echo 'ok';
} else {
	echo 'Falta';
}
echo '</td><td>';
if (isset($row['url']) && "web.pdf"!=$row['url']) {
echo ' <a href="filesnr/reparto/'.$row['url'].'" target="_blank"><img src="images/pdf.png"></a>';
} else {}
if (isset($row['id_notaria']) && ""!=$row['id_notaria']) {
$hash2=$row['hash'];
echo ' <a href="https://servicios.supernotariado.gov.co/pdf/acta_reparto&'.$hash2.'.pdf" download=""> <span class="btn btn-xs btn-success">Acta</span></a> ';


} else {}



if (1==$_SESSION['rol'] or 0<$nump115) {
	echo ' <a href="" class="cambiar_reparto btn btn-xs btn-warning" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupreparto">Modificar</a> ';
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







<div class="modal fade bd-example-modal-lg" id="popupreparto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Actualizar reparto</b><span style="font-weight: bold;"></span></h4>
</div> 
<div id="ver_cambio_reparto" class="modal-body">

   </div>
    </div>
  </div>
</div>


	  



<?php } else { } ?>



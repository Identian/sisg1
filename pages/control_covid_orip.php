<?php
$nump95=privilegios(95,$_SESSION['snr']);


if (isset($_POST['fecha'])){ 
$fechan=$_POST['fecha'];
 } else {
$fechan=date('Y-m-d');  
 } 



if (1==$_SESSION['rol'] or 0<$nump95) {
$idorip=$_GET['i'];

if (isset($_GET['i'])) { 
$idorip=$_GET['i'];
 } else {
$idorip=195;  
 } 
	   


} else {
$idorip=$_SESSION['id_oficina_registro'];
}





global $mysqli;
$mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
if (mysqli_connect_errno()) {
    printf("", $mysqli->connect_error);
    exit();
}


function insertar($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $var11, $var12, $var13, $var14, $var15, $var16, $var17, $var18, $var19, $var20, $var21, $var22, $var23, $var24, $var25, $var26) {
global $mysqli;
	
$query5="insert into respuesta_covid (id_oficina_registro, fecha, id_pre1, id_pre2, id_pre3, id_pre4, id_pre5, id_pre6, id_pre7, id_pre8, id_pre9, id_pre10, id_pre11, id_pre12, id_pre13, id_pre14, id_pre15, id_pre16, id_pre17, id_pre18, id_pre19, id_pre20, id_pre21, id_pre22, id_pre23, id_pre24, observaciones, estado_respuesta_covid) 
values ($var1, now(), '$var2', '$var3', '$var4', '$var5', '$var6', '$var7', '$var8', '$var9', '$var10', '$var11', '$var12', '$var13', '$var14', '$var15', '$var16', '$var17', '$var18', '$var19', '$var20', '$var21', '$var22', '$var23', '$var24', '$var25', '$var26', 1)
";
$result5 = $mysqli->query($query5);
	return '';
}


if (isset($_POST['id_pre1']) && ""!=$_POST['id_pre1']) {
	echo insertar($idorip, $_POST['id_pre1'],  
$_POST['id_pre2'],  
$_POST['id_pre3'],  
$_POST['id_pre4'],  
$_POST['id_pre5'],  
$_POST['id_pre6'],  
$_POST['id_pre7'],  
$_POST['id_pre8'],  
$_POST['id_pre9'],  
$_POST['id_pre10'],  
$_POST['id_pre11'],  
$_POST['id_pre12'],  
$_POST['id_pre13'],  
$_POST['id_pre14'],  
$_POST['id_pre15'],  
$_POST['id_pre16'],  
$_POST['id_pre17'],  
$_POST['id_pre18'],  
$_POST['id_pre19'],  
$_POST['id_pre20'],  
$_POST['id_pre21'],  
$_POST['id_pre22'],  
$_POST['id_pre23'],  
$_POST['id_pre24'],  
$_POST['observaciones']);

echo $insertado;
} else {
	
}




 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3>
			  <?php	  
$query4h = sprintf("SELECT count(id_respuesta_covid) as tot FROM respuesta_covid where 
estado_respuesta_covid=1 
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
$query4h = sprintf("SELECT count(distinct(id_oficina_registro)) as imp FROM respuesta_covid where 
estado_respuesta_covid=1 
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['imp'];
$result4h->free();
 echo $reshh;
			  ?></h3>

              <p>Cantidad de Orip con registro</p>
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
/*  
$query4h = sprintf("SELECT count(id_reporte_dia_orip) as imp FROM reporte_dia_orip where 
estado_reporte_dia_orip=1 and impedimento='Si' and cerrado=1 and fecha_publicacion='$fechan'
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['imp'];
$result4h->free();
 echo $reshh;*/
 
			  ?>2021
			  </h3>
			 
              <p>Año</p>
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
/*			  
$query4h = sprintf("SELECT count(distinct id_oficina_registro) as imp FROM reporte_dia_orip where 
estado_reporte_dia_orip=1 and fecha_publicacion='$fechan' 
"); 
$result4h = $mysqli->query($query4h);
$row4h = $result4h->fetch_array(MYSQLI_ASSOC);
$reshh=$row4h['imp'];
$result4h->free();
 echo $reshh;*/
			  ?>195</h3>
              <p>Orip</p>
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
 <b> Formato de inspección y cumplimiento del protocolo de mitigación, control y manejo de la pandemia del Coronavirus COVID-19 de la SNR
  </b><hr>
  
  <div class="col-md-4">
<?php  //if (1==$_SESSION['rol'] or 0<$nump95) { ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button></h3>
	  
<?php //} else {} ?>
	  </div>
	  
	  
	  
	   <div class="col-md-6">

	<!--
<form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

<div class="input-group">
<div class="input-group-btn">
<input type="text" name="fecha"  class="form-control datepicker" required ></div>
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>

</form>-->


</div>

<div class="col-md-2">
	<?php   if (1==$_SESSION['rol'] or 0<$nump95) { echo ''; } else {} 
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

<th title="	¿La ubicación de los puestos de trabajo se encuentran demarcadas a  por lo menos a 2 metros de distancia de los demás?                	">	1	</th>
<th title="	¿La oficina cuenta con termometro digital para la toma de temperatura de los funcionarios/ usuarios /contratistas que presenten una condición de salud sospechosa de Covid 19?	">	2	</th>
<th title="	¿La oficina cuenta con la señalización y demarcación adecuada para Covid 19?	">	3	</th>
<th title="	¿La circulación de aire en el área de trabajo es suficiente?                	">	4	</th>
<th title="	¿ Si su oficina tiene servicio de aire acondicionado o ventilador, este funciona adecuadamente?	">	5	</th>
<th title="	¿Se controla el aforo de los Usuarios en la ORIP? 	">	6	</th>
<th title="	¿ La oficina cuenta con lugares para la alimentación como cafeteria?	">	7	</th>
<th title="	¿El lugar o Zona de alimentación se encuentra limpio?	">	8	</th>
<th title="	¿El personal puede mantener su distancia de 2 metros con sus compañeros o usuarios de trabajo durante la jornada?                	">	9	</th>
<th title="	¿Se realiza entrega y se hace uso de tapabocas?  	">	10	</th>
<th title="	¿Se realiza entrega y se hace uso de las caretas o mascaras protectoras al personal que tiene contacto proximal con usuarios?	">	11	</th>
<th title="	¿Se realiza entrega en los tiempos establecidos y se hace uso de los guantes al personal que lo requiere?	">	12	</th>
<th title="	¿Realizan desinfección de los puestos de trabajo cada 3 horas ?  	">	13	</th>
<th title="	¿Cuentan con espacios adecuados para la disposición de toallas, papel higiénico y tapabocas?  	">	14	</th>
<th title="	¿Cuentan con espacios adecuados y elementos para realizar el lavado y limpieza de manos (gel antibacterial, jabon, toallas de un solo uso, agua)?  	">	15	</th>
<th title="	¿La oficina cuenta con dispensadores de gel antibacterial para	">	16	</th>
<th title="	¿ Se realiza lavado de manos cada 2 horas?	">	17	</th>
<th title="	¿ Se da la directriz a los funcionarios para el diligenciamiento diario de su estado de salud en la plataforma ALISSTA?	">	18	</th>
<th title="	¿Loa funcionarios /contratistas siguen el procedimiento para reporte del estado de salud relacionado a Covid-19?   Conocen el procedimiento a realizar en caso de que presenten sintomatologia dentro de la ORIP.?	">	19	</th>
<th title="	¿Cuentan con cantidad suficiente de inventario de elementos de protección personal? 	">	20	</th>
<th title="	¿Alguna persona actualmente dentro de la oficina de registro ha presentado sintomatologia sospechosa de covid 19?	">	21	</th>
<th title="	¿Alguna persona actualmente dentro de la oficina de registro se encuentra pendiente de resultado de prueba covid 19?	">	22	</th>
<th title="	¿ En el momento de esta inspección cuantas personas se encuentran trabajando presencialmente en las instalaciones? 	">	24	</th>
	
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
 



if (1==$_SESSION['rol'] or 0<$nump95) {

if (isset($_GET['i'])){
$idorip=$_GET['i'];
$queryid= " and respuesta_covid.id_oficina_registro=".$idorip." ";
	} else {
$queryid="";	
	}
	//fecha='$fechan' and
$query4="SELECT * from oficina_registro, region, respuesta_covid where oficina_registro.id_region=region.id_region and oficina_registro.id_oficina_registro=respuesta_covid.id_oficina_registro ".$queryid." and estado_respuesta_covid=1  ORDER BY fecha desc ";

} else {
$idorip=$_SESSION['id_oficina_registro'];

$query4="SELECT * from oficina_registro, region, respuesta_covid where oficina_registro.id_region=region.id_region and respuesta_covid.id_oficina_registro=".$idorip." and oficina_registro.id_oficina_registro=respuesta_covid.id_oficina_registro and estado_respuesta_covid=1  ORDER BY fecha desc ";

}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  

				<tr>
				<?php
$id_res=$row['id_respuesta_covid'];
echo '<td>'.$row['fecha'].'</td>';
echo '<td>'.$row['nombre_region'].'</td>';
echo '<td>'.$row['nombre_oficina_registro'].'</td>';
echo '<td>'.$row['id_pre1'].'</td>';
echo '<td>'.$row['id_pre2'].'</td>';
echo '<td>'.$row['id_pre3'].'</td>';
echo '<td>'.$row['id_pre4'].'</td>';
echo '<td>'.$row['id_pre5'].'</td>';
echo '<td>'.$row['id_pre6'].'</td>';
echo '<td>'.$row['id_pre7'].'</td>';
echo '<td>'.$row['id_pre8'].'</td>';
echo '<td>'.$row['id_pre9'].'</td>';
echo '<td>'.$row['id_pre10'].'</td>';
echo '<td>'.$row['id_pre11'].'</td>';
echo '<td>'.$row['id_pre12'].'</td>';
echo '<td>'.$row['id_pre13'].'</td>';
echo '<td>'.$row['id_pre14'].'</td>';
echo '<td>'.$row['id_pre15'].'</td>';
echo '<td>'.$row['id_pre16'].'</td>';
echo '<td>'.$row['id_pre17'].'</td>';
echo '<td>'.$row['id_pre18'].'</td>';
echo '<td>'.$row['id_pre19'].'</td>';
echo '<td>'.$row['id_pre20'].'</td>';
echo '<td>'.$row['id_pre21'].'</td>';
echo '<td>'.$row['id_pre22'].'</td>';
echo '<td>'.$row['id_pre24'].'</td>';
echo '<td><a href="orip&'.$row['id_oficina_registro'].'.jsp">Ver</a> ';


		 
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


 <div class="modal fade bd-example-modal-lg" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
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
<label  class="control-label">Oficina de Registro: <?php echo quees('oficina_registro',$idorip);?></label> 
<br><b>DATOS LIDER DEL PROTOCOLO ORIP:</b> <?php echo quees('funcionario',$_SESSION['snr']);?>
</div>

<?php
$query4="SELECT * from pregunta_covid where id_pregunta_covid<23";
$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
$id=$row['id_pregunta_covid'];
echo '<div class="form-group text-left"> 
<label ><span style="color:#ff0000;">*</span>';
echo $id.'. ';
echo $row['nombre_pregunta_covid'];
echo '</label>';
echo '<select name="id_pre'.$id.'" class="form-control" style="width:30%;" required>';
echo '<option value="" selected></option><option>Si</option><option>No</option>';
echo '</select></div>';

  }


?>


<div class="form-group text-left"> 
<label><span style="color:#ff0000;">*</span>23. ¿Tiene alguna sugerencia de mejora e implementación del protocolo de la SNR?</label>
<textarea class="form-control" name="id_pre23"></textarea>
</div>

<div class="form-group text-left"> 
<label><span style="color:#ff0000;">*</span>24. ¿ En el momento de esta inspección cuantas personas se encuentran trabajando presencialmente en las instalaciones?:</label>
<input name="id_pre24" type="number" class="form-control" style="width:30%;" required>
</div>



<div class="form-group text-left"> 
<label><span style="color:#ff0000;">*</span>25. Observaciones:</label> 
<textarea name="observaciones" class="form-control"></textarea>
</div>



<br>









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






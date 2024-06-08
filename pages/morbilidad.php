<?php
$nump113=privilegios(113,$_SESSION['snr']);

if (3>$_SESSION['snr_tipo_oficina']) { 

if ((isset($_POST["salud1"])) && (""!=$_POST["salud1"])) {
	
	

$query = sprintf("SELECT count(id_morbilidad) as tt FROM morbilidad where estado_morbilidad=1 and id_funcionario=".$_SESSION['snr'].""); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tt']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene un registro.</div>';
	
} else {
	

$estud=$_POST['salud59'];
$estu='';
for ($u=0;$u<count($estud);$u++)    
{     
$estu.=$estud[$u].',';    
}



$insertSQL = sprintf("INSERT INTO morbilidad (id_funcionario, fecha_registro, salud1, salud2, salud3, salud4, salud5, salud6, salud7, salud8, salud9, 
salud10, salud11, salud12, salud14, salud15, salud16, salud17, salud18, salud19, salud20, salud21, salud22, salud23, salud24, salud25, 
salud26, salud27, salud28, salud29, salud30, salud31, salud32, salud33, salud34, salud35, salud36, salud37, salud38, salud39, salud40, salud41, salud42, 
salud43, salud44, salud45, salud46, salud47, salud48, salud49, salud50, salud51, salud52, salud53, salud54, salud55, salud56, salud57, salud58, salud59, salud60, salud61, salud62, estado_morbilidad) VALUES 
(%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
 %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["salud1"], "text"), 
GetSQLValueString($_POST["salud2"], "text"), GetSQLValueString($_POST["salud3"], "text"), 
GetSQLValueString($_POST["salud4"], "text"), GetSQLValueString($_POST["salud5"], "text"), 
GetSQLValueString($_POST["salud6"], "text"), GetSQLValueString($_POST["salud7"], "text"), 
GetSQLValueString($_POST["salud8"], "text"), GetSQLValueString($_POST["salud9"], "text"), 
GetSQLValueString($_POST["salud10"], "text"), GetSQLValueString($_POST["salud11"], "text"), 
GetSQLValueString($_POST["salud12"], "text"),  
GetSQLValueString($_POST["salud14"], "text"), 
GetSQLValueString($_POST["salud15"], "text"), 
GetSQLValueString($_POST["salud16"], "text"), GetSQLValueString($_POST["salud17"], "text"), GetSQLValueString($_POST["salud18"], "text"), GetSQLValueString($_POST["salud19"], "text"), GetSQLValueString($_POST["salud20"], "text"), GetSQLValueString($_POST["salud21"], "text"), GetSQLValueString($_POST["salud22"], "text"), GetSQLValueString($_POST["salud23"], "text"), GetSQLValueString($_POST["salud24"], "text"), GetSQLValueString($_POST["salud25"], "text"), GetSQLValueString($_POST["salud26"], "text"), GetSQLValueString($_POST["salud27"], "text"), GetSQLValueString($_POST["salud28"], "text"), GetSQLValueString($_POST["salud29"], "text"), GetSQLValueString($_POST["salud30"], "text"), GetSQLValueString($_POST["salud31"], "text"), GetSQLValueString($_POST["salud32"], "text"), GetSQLValueString($_POST["salud33"], "text"), GetSQLValueString($_POST["salud34"], "text"), GetSQLValueString($_POST["salud35"], "text"), GetSQLValueString($_POST["salud36"], "text"), GetSQLValueString($_POST["salud37"], "text"), GetSQLValueString($_POST["salud38"], "text"), GetSQLValueString($_POST["salud39"], "text"), GetSQLValueString($_POST["salud40"], "text"), GetSQLValueString($_POST["salud41"], "text"), GetSQLValueString($_POST["salud42"], "text"), GetSQLValueString($_POST["salud43"], "text"), 
GetSQLValueString($_POST["salud44"], "text"), 
GetSQLValueString($_POST["salud45"], "text"), 
GetSQLValueString($_POST["salud46"], "text"), 
GetSQLValueString($_POST["salud47"], "text"), 
GetSQLValueString($_POST["salud48"], "text"), 
GetSQLValueString($_POST["salud49"], "text"), 
GetSQLValueString($_POST["salud50"], "text"), 
GetSQLValueString($_POST["salud51"], "text"), 
GetSQLValueString($_POST["salud52"], "text"), 
GetSQLValueString($_POST["salud53"], "text"), 
GetSQLValueString($_POST["salud54"], "text"), 
GetSQLValueString($_POST["salud55"], "text"), 
GetSQLValueString($_POST["salud56"], "text"), 
GetSQLValueString($_POST["salud57"], "text"), 
GetSQLValueString($_POST["salud58"], "text"), 
GetSQLValueString($estu, "text"), 
GetSQLValueString($_POST["salud60"], "text"), 
GetSQLValueString($_POST["salud61"], "text"), 
GetSQLValueString($_POST["salud62"], "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

echo $insertado;


  $updateSQL2 = sprintf("UPDATE funcionario SET celular_funcionario=%s, rh=%s, id_estado_civil=%s  WHERE id_funcionario=%s and estado_funcionario=1",
                     
					   GetSQLValueString($_POST["celular_funcionario"], "text"),
					   GetSQLValueString($_POST["rh"], "text"),
					   GetSQLValueString($_POST["id_estado_civil"], "text"),
					 
					    GetSQLValueString($_SESSION['snr'], "int"));
  $Result12 = mysql_query($updateSQL2, $conexion);
  


}

}



 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('morbilidad'); ?></h3>

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
<?php 
// or 3>$_SESSION['snr_tipo_oficina']
 if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) { 

$fechan=date('Y-m-d');  

?>
  
    <h3  class="box-title">
	
	<?php if ($realdate<='2025-12-01') { ?>
	
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>
	<?php } else {} ?>
	ENCUESTA DE CONDICIONES DE SALUD 2023
	  
	  
	 <?php if (isset($_GET['i'])) { 
	 echo ' / ';
//echo quees('oficina_registro',$idorip);
 } else {
 
 } 
 
  if (1==$_SESSION['rol'] or 0<$nump113) { 
//echo ' &nbsp;  &nbsp;  &nbsp;  &nbsp; <a href="https://sisg.supernotariado.gov.co/xlsx/morbilidad.xls"><img src="images/xls.png"> Reporte</a>';
  } else {}
 ?>
	  </h3>
<br>La siguiente encuesta tiene como objetivo identificar su estado de salud actual e incluirlo en programas de seguimiento desde el área de Medicina Preventiva de la Superintendencia de Notariado y Registro.
<br>Por lo anterior al diligenciarla declaro que he sido informado y he comprendido satisfactoriamente la naturaleza y propósito de esta encuesta, y sé que mi participación es voluntaria, por lo anterior, doy mi consentimiento para que la información de la misma sea utilizada para los análisis requeridos dentro de los programas de vigilancia epidemiológica del Grupo de Seguridad y Salud en el Trabajo de la SNR.  
<br>
<br>Tenga presente que la información consignada está sujeta a reserva clínico-legal y confidencialidad de acuerdo a la normatividad vigente y solo será utilizada con fines preventivos. 
<br>Por favor responda las preguntas con sinceridad.
<br>Sus datos personales están protegidos por la ley 1581 de 2012. Al diligenciar el formulario, acepta el uso de datos personales y el envío de información relacionada con la presente solicitud. 

	  
	  
<?php } else {} ?>
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Reportado</th>
				  <th>Funcionario</th>
				   <th>Cedula</th>
				  <th>Celular</th>
				  <th>Rh</th>
				  <th>Estado civil</th>


<th>Fecha de ingreso</th>
<th>Nivel académico</th>
<th>Fecha de nacimiento</th>
<th>Edad</th>


				  <th>Oficina</th>
				  <th>Dependencia</th>		



				  
<th>	CIUDAD DE RESIDENCIA	</th>
<th>	BARRIO DE RESIDENCIA	</th>
<th>	DIRECCIÓN DE RESIDENCIA	</th>
<th>	ESTUDIA ACTUALMENTE s,n	</th>
<th>	N° PERSONAS EN EL HOGAR	</th>
<th>	N° PERSONAS A CARGO	</th>
<th>	NOMBRES Y APELLIDOS DE FAMILIAR RESPONSABLE	</th>
<th>	NUMERO TELEFONICO DE FAMILIAR	</th>
<th>	ASISTIO A PROCESOS DE INDUCCIÓN/ REINDUCCIÓN DE LA ENTIDAD s,n	</th>
<th>	PESO ACTUAL	</th>
<th>	ESTATURA	</th>
<th>	EPS ACTUAL	</th>
<th>	MEDIO DE TRANSPORTE PARA IR Y VOLVER DEL TRABAJO	</th>
<th>	TIEMPO DE DESPLAZAMIENTO DE LA CASA Y VISCEVERSA	</th>
<th>	ANTIGÜEDAD EN EL CARGO	</th>
<th>	CIUDAD DONDE VIVE ACTUALMENTE	</th>
<th>	ES MADRE O PADRE CABEZA DE HOGAR s,n,	</th>
<th>	ESTA USTED EN EMBARAZO s,n,	</th>
<th>	LE HAN DIAGNOSTICADO ALGUNA ENFERMEDAD s,n,</th>
<th>	ENFERMEDAD</th>
<th>	Dolor de cabeza	</th>
<th>	Dolor de cuello, espalda y cintura	</th>
<th>	Dolores musculares	</th>
<th>	Dificultad para algún movimiento	</th>
<th>	Tos frecuente	</th>
<th>	Dificultad respiratoria	</th>
<th>	Gastritis, ulcera	</th>
<th>	Otras alteraciones del funcionamiento digestivo	</th>
<th>	Alteraciones del sueño (insomnio, somnolencia)	</th>
<th>	Dificultad para concentrarse	</th>
<th>	Mal genio	</th>
<th>	Nerviosismo	</th>
<th>	Cansancio mental	</th>
<th>	Palpitaciones	</th>
<th>	Dolor en el pecho (angina)	</th>
<th>	Cambios visuales	</th>
<th>	Cansancio, fatiga, ardor o disconfort visual	</th>
<th>	Pitos o ruidos continuos o intermitentes en los oídos	</th>
<th>	Dificultad para oír	</th>
<th>	Sensación permanente de cansancio	</th>
<th>	Alteraciones en la piel	</th>
<th>	Otras alteraciones no anotadas	</th>
<th>	HA SUFRIDO ACCIDENTES DE TRABAJO  s,n,	</th>
<th>	LE HAN DIAGNOSTICADO ENFERMEDADES LABORALES s,n,	</th>
<th>	CÚAL ENFERMEDAD LABORAL</th>	
<th>	USTED REALIZA EJERCICIO EN FORMA ACTIVA AL MENOS 20 MINUTOS s,n,	</th>
<th>	QUE DEPORTES PRACTICA	</th>
<th>	CONSIDERA QUE SU ALIMENTACIÓN ES BALANCEADA s,n,	</th>
<th>	A MENUDO CONSUMO MUCHO AZÚCAR, SAL O COMIDA CHATARRA s,n,	</th>
<th>	YO FUMO CIGARRILLO ACTUALMENTE s,n,	</th>
<th>	HACE CUANTO TIEMPO FUMO	</th>
<th>	CUANTOS CIGARRILLOS CONSUMO EN EL DIA (ENTRE 1 Y 5, ENTRE 5 Y 10, MAS DE 10	</th>
<th>	BEBO MAS DE 4 TRAGOS EN UNA MISMA REUNIÓN s,n,	</th>
<th>	BEBO FRECUENTEMENTE CAFÉ, TÉ, O BEDIDAS DE COLA QUE TIENEN CAFÉÍNA s,n,	</th>
<th>	HA SUFRIDO PRE- INFARTOS o INFARTOS s,n,	</th>
<th>	REALIZA PAUSAS ACTIVAS DURANTE LA JORNADA LABORAL s,n,	</th>
<th>	CUÁL ES LA PRINCIPAL POSTURA O POSICIÓN QUE ADOPTA PARA REALIZAR SU TRABAJO (BIDEDO(PIE), RODILLAS, SEDENTE (SENTADO))	</th>
<th>	CUANTAS HORAS PERMANENTE EN ESTA POSICIÓN (ENTRE 1 Y 4 HORAS, ENTRE 4 Y 8 HORAS, MAS DE 8 HORAS)	</th>
<th>	ESCRIBA CUALES SON SUS HERRAMIENTAS DE TRABAJO	</th>
<th>	REALIZA USTED ACTIVIDADES EXTRALABORALES "FUERA DE LA JORNADA".	</th>
<th>	EN EL CARGO ACTUAL MANIPULA CARGAS (PESO 3KG) QUE LE PROPORCIONAN EXIGENCIA FISICA. s,n	</th>


<th style="width:90px;"></th>		  
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
 


if (1==$_SESSION['rol'] or 0<$nump113) {
$query4="SELECT * from morbilidad, funcionario, estado_civil where funcionario.id_estado_civil=estado_civil.id_estado_civil and morbilidad.id_funcionario=funcionario.id_funcionario and estado_morbilidad=1 ".$infop." ORDER BY id_morbilidad desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from morbilidad, funcionario, estado_civil where funcionario.id_estado_civil=estado_civil.id_estado_civil and  morbilidad.id_funcionario=funcionario.id_funcionario and estado_morbilidad=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_morbilidad desc  "; //LIMIT 500 OFFSET ".$pagina."
}


$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_morbilidad'];
echo '<td>'.$row['fecha_registro'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';

echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td>'.$row['celular_funcionario'].'</td>';
echo '<td>'.$row['rh'].'</td>';
echo '<td>'.$row['nombre_estado_civil'].'</td>';



echo '<td>'.$row['fecha_ingreso'].'</td>';
echo '<td>'.$row['formacion_aca'].'</td>';
echo '<td>'.$row['fecha_nacimiento'].'</td>';

$edadc = calculaedad($row['fecha_nacimiento']);				
echo '<td>'.$edadc.' años</td>';




if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
	
}



echo '<td>'.$row['salud1'].'</td>';
echo '<td>'.$row['salud2'].'</td>';
echo '<td>'.$row['salud3'].'</td>';
echo '<td>'.$row['salud4'].'</td>';
echo '<td>'.$row['salud5'].'</td>';
echo '<td>'.$row['salud6'].'</td>';
echo '<td>'.$row['salud7'].'</td>';
echo '<td>'.$row['salud8'].'</td>';
echo '<td>'.$row['salud9'].'</td>';
echo '<td>'.$row['salud10'].'</td>';
echo '<td>'.$row['salud11'].'</td>';
echo '<td>'.$row['salud12'].'</td>';
echo '<td>'.$row['salud14'].'</td>';
echo '<td>'.$row['salud15'].'</td>';

echo '<td>'.calculaedad($row['fecha_ingreso']).' años</td>';

echo '<td>'.$row['salud17'].'</td>';
echo '<td>'.$row['salud18'].'</td>';
echo '<td>'.$row['salud19'].'</td>';
echo '<td>'.$row['salud20'].'</td>';

echo '<td>'.$row['salud62'].'</td>';


echo '<td>'.$row['salud21'].'</td>';
echo '<td>'.$row['salud22'].'</td>';
echo '<td>'.$row['salud23'].'</td>';
echo '<td>'.$row['salud24'].'</td>';
echo '<td>'.$row['salud25'].'</td>';
echo '<td>'.$row['salud26'].'</td>';
echo '<td>'.$row['salud27'].'</td>';
echo '<td>'.$row['salud28'].'</td>';
echo '<td>'.$row['salud29'].'</td>';
echo '<td>'.$row['salud30'].'</td>';
echo '<td>'.$row['salud31'].'</td>';
echo '<td>'.$row['salud32'].'</td>';
echo '<td>'.$row['salud33'].'</td>';
echo '<td>'.$row['salud34'].'</td>';
echo '<td>'.$row['salud35'].'</td>';
echo '<td>'.$row['salud36'].'</td>';
echo '<td>'.$row['salud37'].'</td>';
echo '<td>'.$row['salud38'].'</td>';
echo '<td>'.$row['salud39'].'</td>';
echo '<td>'.$row['salud40'].'</td>';
echo '<td>'.$row['salud41'].'</td>';
echo '<td>'.$row['salud42'].'</td>';
echo '<td>'.$row['salud43'].'</td>';
echo '<td>'.$row['salud44'].'</td>';
echo '<td>'.$row['salud61'].'</td>';
echo '<td>'.$row['salud45'].'</td>';
echo '<td>'.$row['salud46'].'</td>';
echo '<td>'.$row['salud47'].'</td>';
echo '<td>'.$row['salud48'].'</td>';
echo '<td>'.$row['salud49'].'</td>';
echo '<td>'.$row['salud50'].'</td>';
echo '<td>'.$row['salud51'].'</td>';
echo '<td>'.$row['salud52'].'</td>';
echo '<td>'.$row['salud53'].'</td>';
echo '<td>'.$row['salud54'].'</td>';
echo '<td>'.$row['salud55'].'</td>';
echo '<td>'.$row['salud56'].'</td>';
echo '<td>'.$row['salud57'].'</td>';
echo '<td>'.$row['salud58'].'</td>';
echo '<td>'.$row['salud59'].'</td>';
echo '<td>'.$row['salud60'].'</td>';
echo '<td>';
if (1==$_SESSION['rol'] or 0<$nump113) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="morbilidad" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
										<?php if (1==$_SESSION['rol'] or 0<$nump113) {  ?>
									'excelHtml5'
										<?php } else {} ?>
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


<?php 

//1==$_SESSION['rol'] or
if ( 3>$_SESSION['snr_tipo_oficina']) { ?>





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
        
<form action="" method="POST" name="for543544324r65345345464324324563m1" enctype="multipart/form-data" >


 
 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cargo:</label> 
<input type="text" class="form-control" readonly value="<?php echo quees('cargo',$_SESSION['snr_grupo_cargo']); ?>">
</div>


 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Estado Civil:</label> 
<select class="form-control" name="id_estado_civil" required>
<option value="6" selected></option>
<option value="1">Soltero</option><option value="2">Casado</option><option value="3">Union Libre</option><option value="4">Separado</option><option value="5">Madre/padre cabeza de familia</option><option value="7">Viudo/a</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Número de celular: </label> 
<input type="text" class="form-control numero"  name="celular_funcionario" placeholder="Solo números y punto"   required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RH: </label> 
<input type="text" class="form-control"  name="rh"   required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CIUDAD DE RESIDENCIA</label>
<input type="text"  class="form-control" style="width:100%" name="salud1"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> BARRIO DE RESIDENCIA</label>
<input type="text"  class="form-control" style="width:100%" name="salud2"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> DIRECCIÓN DE RESIDENCIA</label>
<input type="text"  class="form-control" style="width:100%" name="salud3"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESTUDIA ACTUALMENTE s,n</label>
<select  class="form-control" style="width:100%" name="salud4">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> N° PERSONAS EN EL HOGAR</label>
<input type="text"  class="form-control" style="width:100%" name="salud5"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> N° PERSONAS A CARGO</label>
<input type="text"  class="form-control" style="width:100%" name="salud6"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRES Y APELLIDOS DE FAMILIAR RESPONSABLE</label>
<input type="text"  class="form-control" style="width:100%" name="salud7"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NUMERO TELEFONICO DE FAMILIAR</label>
<input type="text"  class="form-control" style="width:100%" name="salud8"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ASISTIO A PROCESOS DE INDUCCIÓN/ REINDUCCIÓN DE LA ENTIDAD s,n</label>
<select  class="form-control" style="width:100%" name="salud9">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> PESO ACTUAL (En Kilogramos)</label>
<input type="text"  class="form-control numero" style="width:100%" name="salud10"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESTATURA (En centimetros)</label>
<input type="text"  class="form-control numero" style="width:100%" name="salud11"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> EPS ACTUAL</label>
<input type="text"  class="form-control" style="width:100%" name="salud12"></div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MEDIO DE TRANSPORTE PARA IR Y VOLVER DEL TRABAJO</label>
<input type="text"  class="form-control" style="width:100%" name="salud14"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIEMPO DE DESPLAZAMIENTO DE LA CASA Y VISCEVERSA</label>
<input type="text"  class="form-control" style="width:100%" name="salud15"></div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CIUDAD DONDE VIVE ACTUALMENTE</label>
<input type="text"  class="form-control" style="width:100%" name="salud17"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ES MADRE O PADRE CABEZA DE HOGAR s,n,</label>
<select  class="form-control" style="width:100%" name="salud18">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESTA USTED EN EMBARAZO s,n,</label>
<select  class="form-control" style="width:100%" name="salud19">
<option></option>
<option>Si</option>
<option>No</option>
<option>No aplica</option>
</select></div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> LE HAN DIAGNOSTICADO ALGUNA ENFERMEDAD (cúal)</label>
<select  class="form-control" style="width:100%" name="salud20" required>
<option></option>
<option>Si</option>
<option>No</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label">En caso de si (Cúal)</label>
<input type="text"  class="form-control" style="width:100%" name="salud62">
</div>



<hr>
INDIQUE CUALES DE LAS SIGUIENTES MOLESTIAS HA EXPERIMENTADO CON FRECUENCIA EN LOS ULTIMOS SEIS (6) MESES (SINTOMAS)


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dolor de cabeza</label>
<select  class="form-control" style="width:100%" name="salud21">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dolor de cuello, espalda y cintura</label>
<select  class="form-control" style="width:100%" name="salud22">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dolores musculares</label>
<select  class="form-control" style="width:100%" name="salud23">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dificultad para algún movimiento</label>
<select  class="form-control" style="width:100%" name="salud24">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tos frecuente</label>
<select  class="form-control" style="width:100%" name="salud25">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dificultad respiratoria</label>
<select  class="form-control" style="width:100%" name="salud26">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Gastritis, ulcera</label>
<select  class="form-control" style="width:100%" name="salud27">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Otras alteraciones del funcionamiento digestivo</label>
<select class="form-control" style="width:100%" name="salud28" required>
<option></option>
<option>Si</option>
<option>No</option>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Alteraciones del sueño (insomnio, somnolencia)</label>
<select  class="form-control" style="width:100%" name="salud29">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dificultad para concentrarse</label>
<select  class="form-control" style="width:100%" name="salud30">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Mal genio</label>
<select  class="form-control" style="width:100%" name="salud31">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nerviosismo</label>
<select  class="form-control" style="width:100%" name="salud32">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cansancio mental</label>
<select  class="form-control" style="width:100%" name="salud33">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Palpitaciones</label>
<select  class="form-control" style="width:100%" name="salud34">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dolor en el pecho (angina)</label>
<select  class="form-control" style="width:100%" name="salud35">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cambios visuales</label>
<select  class="form-control" style="width:100%" name="salud36">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cansancio, fatiga, ardor o disconfort visual</label>
<select  class="form-control" style="width:100%" name="salud37">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Pitos o ruidos continuos o intermitentes en los oídos</label>
<select  class="form-control" style="width:100%" name="salud38">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dificultad para oír</label>
<select  class="form-control" style="width:100%" name="salud39">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Sensación permanente de cansancio</label>
<select  class="form-control" style="width:100%" name="salud40">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Alteraciones en la piel</label>
<select  class="form-control" style="width:100%" name="salud41">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label">Otras alteraciones (Cúal)</label>
<input type="text"  class="form-control" style="width:100%" name="salud42">
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> HA SUFRIDO ACCIDENTES DE TRABAJO  s,n,</label>
<select  class="form-control" style="width:100%" name="salud43">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> LE HAN DIAGNOSTICADO ENFERMEDADES LABORALES s,n,</label>
<select class="form-control" style="width:100%" name="salud44">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>

<div class="form-group text-left"> 
<label  class="control-label"> CÚAL ENFERMEDAD LABORAL (En caso de Si)</label>
<input class="form-control" style="width:100%" name="salud61">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> USTED REALIZA EJERCICIO EN FORMA ACTIVA AL MENOS 20 MINUTOS s,n,</label>
<select  class="form-control" style="width:100%" name="salud45">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> QUE DEPORTES PRACTICA</label>
<input type="text"  class="form-control" style="width:100%" name="salud46">
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CONSIDERA QUE SU ALIMENTACIÓN ES BALANCEADA s,n,</label>
<select  class="form-control" style="width:100%" name="salud47">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> A MENUDO CONSUMO MUCHO AZÚCAR, SAL O COMIDA CHATARRA s,n,</label>
<select  class="form-control" style="width:100%" name="salud48">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> YO FUMO CIGARRILLO ACTUALMENTE s,n,</label>
<select  class="form-control" style="width:100%" name="salud49">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"> HACE CUANTO TIEMPO FUMA EN CASO AFIRMATIVO DE LA ANTERIOR.</label>
<INPUT class="form-control" TYPE="text" style="width:100%" name="salud50">

</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CUANTOS CIGARRILLOS CONSUMO EN EL DIA (ENTRE 1 Y 5, ENTRE 5 Y 10, MAS DE 10</label>
<select type="text"  class="form-control" style="width:100%" name="salud51">

<option></option>
<option>ENTRE 1 Y 5</option>
<option>ENTRE 5 Y 10</option>
<option>MAS DE 10</option>
<option>NO FUMO</option>
</select>

</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> BEBO MAS DE 4 TRAGOS EN UNA MISMA REUNIÓN s,n,</label>
<select  class="form-control" style="width:100%" name="salud52">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> BEBO FRECUENTEMENTE CAFÉ, TÉ, O BEDIDAS DE COLA QUE TIENEN CAFÉÍNA s,n,</label>
<select  class="form-control" style="width:100%" name="salud53">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> HA SUFRIDO PRE- INFARTOS o INFARTOS s,n,</label>
<select  class="form-control" style="width:100%" name="salud54">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> REALIZA PAUSAS ACTIVAS DURANTE LA JORNADA LABORAL s,n,</label>
<select  class="form-control" style="width:100%" name="salud55">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CUÁL ES LA PRINCIPAL POSTURA O POSICIÓN QUE ADOPTA PARA REALIZAR SU TRABAJO 
</label>
<select class="form-control" style="width:100%" name="salud56">

<option></option>
<option>BIPEDO(PIE)</option>
<option>RODILLAS</option>
<option>SEDENTE (SENTADO)</option>


</select>

</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CUANTAS HORAS PERMANECE EN ESTA POSICIÓN</label>
<SELECT  class="form-control" style="width:100%" name="salud57">
<OPTION></OPTION>
<OPTION>ENTRE 1 Y 4 HORAS</OPTION>
<OPTION>ENTRE 4 Y 8 HORAS</OPTION>
<OPTION>MAS DE 8 HORAS</OPTION>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESCRIBA CUALES SON SUS HERRAMIENTAS DE TRABAJO</label>
<input type="text"  class="form-control" style="width:100%" name="salud58"></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> REALIZA USTED ACTIVIDADES EXTRALABORALES "FUERA DE LA JORNADA".</label>



<select class="js-example-basic-multiple" style="width:100%;" required name="salud59[]" multiple>
<option></option>
<option>Futbol</option>
<option>Rugby</option>
<option>Basquetbol</option>
<option>Boxeo</option>
<option>Tenis</option>
<option>Golf</option>
<option>Squash</option>
<option>Artes marciales</option>
<option>Eliptica</option>
<option>Ciclismo</option>
<option>Ciclomontañismo</option>
<option>Natación</option>
<option>Lanzamiento (jabalina, disco béisbol)</option>
<option>Wáter Polo</option>
<option>Sky</option>
<option>Tareas manuales como : coser, joyeria, tallar madera etc</option>
<option>Interpretar instrumentos (Guitarra, piano, violín, percusión)</option>
<option>Uso de videoterminales, videojuegos </option>
<option>Levantamiento de cargas en oficios domesticos </option>
<option>No realizo ninguna actividad</option>

</select>

</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> EN EL CARGO ACTUAL MANIPULA CARGAS (PESO 3KG) QUE LE PROPORCIONAN EXIGENCIA FISICA. s,n</label>
<select class="form-control" style="width:100%" name="salud60">
<option></option>
<option>Si</option>
<option>No</option>
</select></div>






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




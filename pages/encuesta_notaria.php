<?php
//https://docs.google.com/forms/d/e/1FAIpQLSchlPPHYZBYyqpG4plSQ4c7ai_ga5LrWcjx_IZiTCKvd5ZRNA/viewform?c=0&w=1
//https://docs.google.com/forms/d/e/1FAIpQLScEhylPDHvJabQDO4ejcRcwuFOYV6cnUG6pdm7dqVn5nnszcQ/viewform?c=0&w=1
//https://docs.google.com/forms/d/e/1FAIpQLSdEjgcFWiRRb9_KSDV1-5iyuiIIj6J1ODpnr3urc5Y6Toc3HQ/viewform?c=0&w=1
$nump50=privilegios(50,$_SESSION['snr']);

if ((1==$_SESSION['rol'] or 0<$nump50) and isset($_GET['i'])) {
$id=intval($_GET['i']);
} 
else {
$id=intval($_SESSION['snr']);
}
$query = sprintf("SELECT * FROM notaria where id_notaria=".$id." limit 1"); 

  
$select = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
$name = $row1['nombre_notaria'];



if (isset($_POST['fecha']) and ""!=$_POST['fecha']) {
$fechan=$_POST['fecha'];
$fecha1=explode('-', $fechan);
$anon=$fecha1[0];
$mesn=$fecha1[1];
$querynn = sprintf("SELECT count(id_encuesta_notaria) as totnot FROM encuesta_notaria where estado_encuesta_notaria=1 and MONTH(fecha) = ".$mesn." AND YEAR(fecha)=".$anon." and id_notaria=".$id." "); 
$selectnn = mysql_query($querynn, $conexion);
$rownn = mysql_fetch_assoc($selectnn);
if (0<$rownn['totnot']){
echo '<script type="text/javascript">swal(" ERROR !", " Mes duplicado !", "error");</script>';
} else {

$varen1=intval($_POST['1']);
$varen2=intval($_POST['2']);
$varen3=intval($_POST['3']);
$varen4=intval($_POST['4']);
$varen5=intval($_POST['5']);
$varen6=intval($_POST['6']);
$varen7=intval($_POST['7']);
$varen8=intval($_POST['8']);
$varen9=intval($_POST['9']);
$varen10=intval($_POST['10']);
$varen11=intval($_POST['11']);
$varen12=intval($_POST['12']);
$varen13=intval($_POST['13']);
$varen14=intval($_POST['14']);
$varen15=intval($_POST['15']);
$varen16=intval($_POST['16']);
$varen17=intval($_POST['17']);
$varen18=intval($_POST['18']);
$varen19=intval($_POST['19']);
$varen20=intval($_POST['20']);
//$varen21=intval($_POST['21']);
$varen22=intval($_POST['22']);
$varen23=intval($_POST['23']);
$varen24=intval($_POST['24']);
$varen25=intval($_POST['25']);
$varen26=intval($_POST['26']);
$varen27=intval($_POST['27']);
$varen28=intval($_POST['28']);
$varen29=intval($_POST['29']);
$varen30=intval($_POST['30']);
$varen31=intval($_POST['31']);
$varen32=intval($_POST['32']);
$varen33=intval($_POST['33']);
$varen34=intval($_POST['34']);
$varen35=intval($_POST['35']);

$insertSQL5 = sprintf("INSERT INTO encuesta_notaria (id_notaria, fecha, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, p33, p34, p35, estado_encuesta_notaria) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($fechan, "date"), 
GetSQLValueString($varen1, "int"), 
GetSQLValueString($varen2, "int"), 
GetSQLValueString($varen3, "int"), 
GetSQLValueString($varen4, "int"), 
GetSQLValueString($varen5, "int"), 
GetSQLValueString($varen6, "int"), 
GetSQLValueString($varen7, "int"), 
GetSQLValueString($varen8, "int"), 
GetSQLValueString($varen9, "int"), 
GetSQLValueString($varen10, "int"), 
GetSQLValueString($varen11, "int"), 
GetSQLValueString($varen12, "int"), 
GetSQLValueString($varen13, "int"), 
GetSQLValueString($varen14, "int"), 
GetSQLValueString($varen15, "int"), 
GetSQLValueString($varen16, "int"), 
GetSQLValueString($varen17, "int"), 
GetSQLValueString($varen18, "int"), 
GetSQLValueString($varen19, "int"), 
GetSQLValueString($varen20, "int"), 
//GetSQLValueString($varen21, "int"), 
GetSQLValueString($varen22, "int"), 
GetSQLValueString($varen23, "int"), 
GetSQLValueString($varen24, "int"), 
GetSQLValueString($varen25, "int"), 
GetSQLValueString($varen26, "int"), 
GetSQLValueString($varen27, "int"), 
GetSQLValueString($varen28, "int"), 
GetSQLValueString($varen29, "int"), 
GetSQLValueString($varen30, "int"), 
GetSQLValueString($varen31, "int"), 
GetSQLValueString($varen32, "int"), 
GetSQLValueString($varen33, "int"), 
GetSQLValueString($varen34, "int"), 
GetSQLValueString($varen35, "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL5, $conexion);


echo $insertado;
mysql_free_result($Result);

}
mysql_free_result($selectnn);
} else {}

?>  


<div class="row">
  <div class="col-md-12">
    <nav class="navbar navbar-default" style="background:#fff;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		</div>
 <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			
			 <li><a href="notaria&<?php echo $id; ?>.jsp"><b>NOTARIA  <?php echo quees('notaria', $id); ?> </b></a></li>
           
              <li><a href="sucesion<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Liq. Herencia</a></li>
			  
			   <?php if (($_SESSION['snr_tipo_oficina'] == 3 && 1==$_SESSION['snr_grupo_cargo']) OR 1==$_SESSION['rol']) { ?> 
			  <li><a href="privilegios_notariado<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Acceso a módulos</a></li>
			   <?php } else { } ?>
			   <li><a href="salida_menor<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Salida de menores</a></li>
           <li><a href="encuesta_notaria<?php if (1==$_SESSION['rol'] or 0<$nump50) { echo '&'.$id; } else {} ?>.jsp">Actos Notariales</a></li>
            </ul>
          </div>
		 
      </div>
    </nav>
  </div>
</div>




<div class="row">
 <div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body">
<h3><?php echo $name; ?>
</h3>
De acuerdo con el Decreto 2723 del 29 de diciembre de 2014 en el Artículo 4: “La Superintendencia de Notariado y Registro tendrá como objetivo la Orientación, Inspección, Vigilancia y Control de los servicios públicos que prestan los Notarios y los Registradores de Instrumentos Públicos, la organización, administración, sostenimiento, vigilancia y control de las Oficinas de Registro de Instrumentos Públicos, con el fin de garantizar la guarda de la fe pública, la seguridad jurídica y administración del servicio público registral inmobiliario, para que estos servicios se desarrollen conforme a la ley y bajo los principios de eficiencia, eficacia y efectividad”.  
<br>Con base en lo anterior la Entidad está facultada para solicitar, confirmar y analizar información sobre la situación jurídica, contable, económica y administrativa de cualquier Notaria del País.
<br>Por lo tanto, es indispensable que las Notarías suministren los datos requeridos por la Oficina Asesora de Planeación - Grupo de Estadistica Registral y Notarial, diligenciando el presente formulario, de acuerdo con la circular 229 de marzo del 2015.

<div class="box-body">
	<div class="table-responsive">
  <button data-toggle="modal" data-target="#miModal" type="button" class="btn btn-success">
  <span class="glyphicon glyphicon-plus-sign"></span>
        Nueva Encuesta
      </button>  
	  <br><br>
		<table  class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr align="center" valign="middle">
					<th style="width:90px;">Año - Mes</th>
<th>Vivienda de Interés Social - VIS</th>
<th>Escrituras de Vivienda de Interés Prioritario - VIP</th>
<th>Escrituras de Vivienda de Interés Prioritario para Ahorradores - VIPA</th>
<th>Sucesiones</th>
<th>Contratos por Arrendamientos</th>
<th style="width:60px;"></th>
				</tr>
			</thead>

			<tbody>

				<?php
$query = "SELECT * FROM encuesta_notaria where id_notaria=".$id." and estado_encuesta_notaria=1";
				$select = mysql_query($query, $conexion);
				$row = mysql_fetch_assoc($select);
				$totalRows = mysql_num_rows($select);
				if(0<$totalRows){

					do {
						$idencnot=$row['id_encuesta_notaria'];
						echo '<tr>';
						echo '<td>'.date("Y-m", strtotime($row['fecha'])).'</td>';
						echo '<td>'.$row['p1'].'</td>';
						echo '<td>'.$row['p2'].'</td>';
						echo '<td>'.$row['p3'].'</td>';
						echo '<td>'.$row['p4'].'</td>';
						echo '<td>'.$row['p5'].'</td>';
		      echo '<td><a  href="" class="buscar_encuesta_notaria" id="'.$idencnot.'" data-toggle="modal"data-target="#popupnotaria" title="Notaria"><button class="btn btn-xs btn-warning">Ver</button></a>';
				
if (1==$_SESSION['rol'] or 0<$nump50) {
				echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$idencnot.'" name="encuesta_notaria" id="'.$idencnot.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else {}
				echo '</td>';
						
						
						echo '</tr>';

					} while ($row = mysql_fetch_assoc($select)); 
					mysql_free_result($select);
				} else {}
					?>
				</tbody>

			</table>

			<script>
				$(document).ready(function() {
					$('.table').DataTable({
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
			</script>				
		</div>


	</div>





<div class="modal fade bd-example-modal-lg" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Cuantificación de actos jurídicos Notariales</label> DE-GIEI-PR-02-FR-02 </h4>
			</div> 
			<div class="ver_correspondencia" class="modal-body"> 





<form action="" method="POST" name="fo4354grm1" >
<div class="content">
Debe ingresar solo números, en caso contrario escribir 0.
<div class="row"><div class="col-md-6">
<div class="form-group"><label class="control-label">MES QUE QUIERE REPORTAR</label>
<select class="form-control" name="fecha" required>
<option value="" selected></option>
<option value="2020-05-01">Mayo-2020</option>
<option value="2020-04-01">Abril-2020</option>
<option value="2020-03-01">Marzo-2020</option>
<option value="2020-02-01">Febrero-2020</option>
<option value="2020-01-01">Enero-2020</option>
<option value="2019-12-01">Diciembre-2019</option>
<option value="2019-11-01">Noviembre-2019</option>
<option value="2019-10-01">Octubre-2019</option>
<option value="2019-09-01">Septiembre-2019</option>
<option value="2019-08-01">Agosto-2019</option>
<option value="2019-07-01">Julio-2019</option>
<option value="2019-06-01">Junio-2019</option>
<option value="2019-05-01">Mayo-2019</option>
<option value="2019-04-01">Abril-2019</option>
<option value="2019-03-01">Marzo-2019</option>
<option value="2019-02-01">Febrero-2019</option>
<option value="2019-01-01">Enero-2019</option>
<option value="2018-12-01">Diciembre-2018</option>
<option value="2018-11-01">Noviembre-2018</option>
<option value="2018-10-01">Octubre-2018</option>
<option value="2018-09-01">Septiembre-2018</option>
<option value="2018-08-01">Agosto-2018</option>
<option value="2018-07-01">Julio-2018</option>
<option value="2018-06-01">Junio-2018</option>
<option value="2018-05-01">Mayo-2018</option>
<option value="2018-04-01">Abril-2018</option>
<option value="2018-03-01">Marzo-2018</option>
<option value="2018-02-01">Febrero-2018</option>
<option value="2018-01-01">Enero-2018</option>

</select>

</div>

<div class="form-group"><label class="control-label">Vivienda de Interés Social - VIS</label><input type="text" class="form-control numero" name="1" required=""> </div>
<div class="form-group"><label class="control-label">Escrituras de Vivienda de Interés Prioritario - VIP</label><input type="text" class="form-control numero" name="2" required=""> </div>
<div class="form-group"><label class="control-label">Escrituras de Vivienda de Interés Prioritario para Ahorradores - VIPA</label><input type="text" class="form-control numero" name="3" required=""> </div>
<div class="form-group"><label class="control-label">Fiducias</label><input type="text" class="form-control numero" name="6" required=""> </div>
<div class="form-group"><label class="control-label">Leasing</label><input type="text" class="form-control numero" name="7" required=""> </div>
<div class="form-group"><label class="control-label">Constitución de Sociedades</label><input type="text" class="form-control numero" name="8" required=""> </div>
<div class="form-group"><label class="control-label">Liquidación de Sociedades</label><input type="text" class="form-control numero" name="9" required=""> </div>
<div class="form-group"><label class="control-label">Reforma de Sociedad Comercial</label><input type="text" class="form-control numero" name="10" required=""> </div>
<div class="form-group"><label class="control-label">Matrimonios Civiles de diferente sexo</label><input type="text" class="form-control numero" name="11" required=""> </div>
<div class="form-group"><label class="control-label">Matrimonios Civiles entre Personas del Mismo Sexo - SU 214 de 2016</label><input type="text" class="form-control numero" name="12" required=""> </div>
<div class="form-group"><label class="control-label">Divorcios entre el mismo sexo</label><input type="text" class="form-control numero" name="35" required=""> </div>
<div class="form-group"><label class="control-label">Uniones entre Personas del Mismo Sexo </label><input type="text" class="form-control numero" name="22" required=""> </div>
<div class="form-group"><label class="control-label">Divorcios entre personas de diferente sexo</label><input type="text" class="form-control numero" name="13" required=""> </div>
<div class="form-group"><label class="control-label">Declaraciones de Uniones Maritales de Hecho.</label><input type="text" class="form-control numero" name="14" required=""> </div>
<div class="form-group"><label class="control-label">Disoluciones de Uniones Maritales de Hecho.</label><input type="text" class="form-control numero" name="15" required=""> </div>
<div class="form-group"><label class="control-label">Disoluciones y/o Liquidaciones de sociedades conyugales</label><input type="text" class="form-control numero" name="16" required=""> </div>
<div class="form-group"><label class="control-label">Correcciones del Registro civil</label><input type="text" class="form-control numero" name="17" required=""> </div>
</div><div class="col-md-6">
<div class="form-group"><label class="control-label">Sucesiones</label><input type="text" class="form-control numero" name="4" required=""> </div>
<div class="form-group"><label class="control-label">Contratos por Arrendamientos</label><input type="text" class="form-control numero" name="5" required=""> </div>
<div class="form-group"><label class="control-label">Escrituras sobre Cambios de Nombre</label><input type="text" class="form-control numero" name="18" required=""> </div>
<div class="form-group"><label class="control-label">Escrituras sobre Legitimación de Hijos</label><input type="text" class="form-control numero" name="19" required=""> </div>
<div class="form-group"><label class="control-label">Capitulaciones Matrimoniales</label><input type="text" class="form-control numero" name="20" required=""> </div>
<div class="form-group"><label class="control-label">Actas de Comparecencia</label><input type="text" class="form-control numero" name="23" required=""> </div>
<div class="form-group"><label class="control-label">Autenticaciones</label><input type="text" class="form-control numero" name="24" required=""> </div>
<div class="form-group"><label class="control-label">Declaraciones Extra Juicio</label><input type="text" class="form-control numero" name="25" required=""> </div>
<div class="form-group"><label class="control-label">Declaraciones de Supervivencia</label><input type="text" class="form-control numero" name="26" required=""> </div>
<div class="form-group"><label class="control-label">Conciliaciones</label><input type="text" class="form-control numero" name="27" required=""> </div>
<div class="form-group"><label class="control-label">Copias del Registro Civil</label><input type="text" class="form-control numero" name="28" required=""> </div>
<div class="form-group"><label class="control-label">Registros Civiles de Nacimiento</label><input type="text" class="form-control numero" name="29" required=""> </div>
<div class="form-group"><label class="control-label">Registros Civiles de Matrimonio</label><input type="text" class="form-control numero" name="30" required=""> </div>
<div class="form-group"><label class="control-label">Registros Civiles de Defunción</label><input type="text" class="form-control numero" name="31" required=""> </div>
<div class="form-group"><label class="control-label">Escrituras Publicas sobre Corrección del componente Sexo de Masculino ( M ) a Femenino ( F )</label><input type="text" class="form-control numero" name="32" required=""> </div>
<div class="form-group"><label class="control-label">Escrituras Publicas sobre Corrección del componente Sexo de Femenino ( F) a Masculino (M)</label><input type="text" class="form-control numero" name="33" required=""> </div>
<div class="form-group"><label class="control-label">Matrimonios Civiles que Involucraron a un menor de Edad </label><input type="text" class="form-control numero" name="34" required=""> </div>
</div></div>
</div>  

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Crear </button>
</div></form>

			</div>
		</div> 
	</div> 
</div> 





<div class="modal fade" id="popupnotaria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Notaria</label></h4>
			</div> 
			<div class="ver_encuesta_notaria" class="modal-body"> 

			</div>
		</div> 
	</div> 
</div> 


<br>

<br>


</div>
</div>
</div>
</div>


<?php } ?>









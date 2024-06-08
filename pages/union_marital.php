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



if (isset($_POST['fecha_umarital_notaria']) and ""!=$_POST['fecha_umarital_notaria']) {
$fecha=$_POST['fecha_umarital_notaria'];
$escritura=$_POST['escritura'];
$querynn = sprintf("SELECT count(id_umarital_notaria) as totnot FROM umarital_notaria where estado_umarital_notaria=1 and fecha_umarital_notaria='$fecha' and nombre_umarital_notaria,=".$escritura." and id_notaria=".$id." limit 1"); 
$selectnn = mysql_query($querynn, $conexion);
$rownn = mysql_fetch_assoc($selectnn);
if (0<$rownn['totnot']){
echo '<script type="text/javascript">swal(" ERROR !", " El número de escritura junto con la fecha ya existe !", "error");</script>';
} else {

 

$insertSQL5 = sprintf("INSERT INTO umarital_notaria (
id_notaria, 
fecha_umarital_notaria, 
tipo_acto, 
genero_acto, 
nombre_umarital_notaria, 
tipo_doc_primer_otorgante, 
nacim_primer_otorgante, 
tipo_doc_segundo_otorgante, 
nacim_segundo_otorgante, 
estado_umarital_notaria) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "text"), 
GetSQLValueString($fecha, "date"), 
GetSQLValueString($_POST['tipo_acto'], "text"), 
GetSQLValueString($_POST['genero_acto'], "text"), 
GetSQLValueString($_POST['escritura'], "text"), 
GetSQLValueString($_POST['tipo_doc_primer_otorgante'], "text"), 
GetSQLValueString($_POST['nacim_primer_otorgante'], "date"), 
GetSQLValueString($_POST['tipo_doc_segundo_otorgante'], "text"), 
GetSQLValueString($_POST['nacim_segundo_otorgante'], "date"), 
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
		   <li><a href="union_marital<?php if (1==$_SESSION['rol'] or 0<$nump50) { echo '&'.$id; } else {} ?>.jsp">Rel M. sexo</a></li>	
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
<h3><?php echo $name; ?> / Relaciones entre parejas del mismo sexo</h3>

<div class="box-body">
	<div class="table-responsive">
  <button data-toggle="modal" data-target="#miModal" type="button" class="btn btn-success">
  <span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo registro
      </button>  
	  <br><br>
		<table  class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr align="center" valign="middle">
					<th>Fecha / escritura</th>
					<th>Escritura</th>
					<th>Tipo de acto</th>
					<th>Genero / acto</th>
<th style="width:60px;"></th>
				</tr>
			</thead>

			<tbody>

				<?php
$query = "SELECT * FROM umarital_notaria where id_notaria=".$id." and estado_umarital_notaria=1";
				$select = mysql_query($query, $conexion);
				$row = mysql_fetch_assoc($select);
				$totalRows = mysql_num_rows($select);
				if(0<$totalRows){

					do {
						$idencnot=$row['id_umarital_notaria'];
						echo '<tr>';
						echo '<td>'.$row['fecha_umarital_notaria'].'</td>';
						echo '<td>'.$row['nombre_umarital_notaria'].'</td>';
						echo '<td>'.$row['tipo_acto'].'</td>';
						echo '<td>'.$row['genero_acto'].'</td>';
		      echo '<td><a  href="" class="buscar_umarital_notaria" id="'.$idencnot.'" data-toggle="modal"data-target="#popupnotaria" title="Notaria"><button class="btn btn-xs btn-warning">Ver</button></a>';
				
if (1==$_SESSION['rol'] or 0<$nump50) {
				echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$idencnot.'" name="umarital_notaria" id="'.$idencnot.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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





<div class="modal fade " id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label">Uniones Maritales Entre Personas del Mismo Sexo.</label></h4>
			</div> 
			<div class="ver_correspondencia" class="modal-body"> 


<form action="" method="POST" name="fo44565354grm1" >
<div class="content">
<div class="row">
<div class="col-md-6">
<div class="form-group"><label class="control-label">Tipo de Acto Notarial</label>
<select class="form-control" name="tipo_acto" required="">
<option value="" selected></option>
<option value="Cesación de derechos Entre personas del mismo sexo">Cesación de derechos Entre personas del mismo sexo</option>
<option value="Divorcios entre Personas del Mismo Sexo">Divorcios entre Personas del Mismo Sexo</option>
<option value="Unión entre Personas del Mismo Sexo">Unión entre Personas del Mismo Sexo</option>
<option value="Matrimonio Civil Entre Personas del Mismo Sexo SU 214 - 2016">Matrimonio Civil Entre Personas del Mismo Sexo SU 214 - 2016</option>
</select>
 </div>
 

<div class="form-group"><label class="control-label">Genero Sexual del Acto</label>
<select class="form-control" name="genero_acto" required="">
<option value="" selected></option>
<option value="Masculino">Masculino</option>
<option value="Femenino">Femenino</option>
</select>
 </div>
 
 
<div class="form-group"><label class="control-label">Número de la Escritura Pública</label>
<input type="text" class="form-control numero" name=escritura required="">
</div>


<div class="form-group"><label class="control-label">Fecha de la Escritura Pública</label>
<input type="text" class="form-control datepicker" name="fecha_umarital_notaria" required="">
</div>


</div>
<div class="col-md-6">


<div class="form-group"><label class="control-label">Tipo de Identificacion del Primer Otorgante </label>
<select class="form-control" name="tipo_doc_primer_otorgante" required="">
<option value="" selected></option>
<option value="Pasaporte">Pasaporte</option>
<option value="Cédula de Extranjeria">Cédula de Extranjeria</option>
<option value="Cédula de Ciudadania">Cédula de Ciudadania</option>
<option value="NUIP - Registro Civil de Nacimiento">NUIP - Registro Civil de Nacimiento</option>
</select>
</div>


<div class="form-group"><label class="control-label">Fecha de Nacimiento del Primer Otorgante </label>
<input type="text" class="form-control datepickera" name="nacim_primer_otorgante" required="">
</div>


<div class="form-group"><label class="control-label">Tipo de Identificacion del Segundo Otorgante</label>
<select class="form-control" name="tipo_doc_segundo_otorgante" required="">
<option value="" selected></option>
<option value="Pasaporte">Pasaporte</option>
<option value="Cédula de Extranjeria">Cédula de Extranjeria</option>
<option value="Cédula de Ciudadania">Cédula de Ciudadania</option>
<option value="NUIP - Registro Civil de Nacimiento">NUIP - Registro Civil de Nacimiento</option>
</select>
</div>

<div class="form-group"><label class="control-label">
Fecha de Nacimiento del Segundo Otorgante </label>
<input type="text" class="form-control datepickera" name="nacim_segundo_otorgante" required="">
</div>

</div>
</div>
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
				<h4 class="modal-title" id="myModalLabel"><label  class="control-label"> Relaciones entre parejas del mismo sexo</label></h4>
			</div> 
			<div class="ver_umarital_notaria" class="modal-body"> 

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

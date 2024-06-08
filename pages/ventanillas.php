<?php
if (isset($_GET['i']) && "" != $_GET['i']) {
  $id = $_GET['i'];

$nump102 = privilegios(102, $_SESSION['snr']);
	

if (1==$_SESSION['rol'] or 0<$nump102 or (1==$_SESSION['snr_grupo_cargo'] && 
24==$_SESSION['snr_grupo_area']) or 
(2==$_SESSION['snr_tipo_oficina'] && $id==$_SESSION['id_oficina_registro']))
	{



	

if (1==$_SESSION['rol'] or 0<$nump102) {
	
	
	
if (isset($_POST['id_ventanillaact'])) {
	

$numv2=$_POST["numero_ventanillaact"];
$numfun2=$_POST["id_funcionario"];

$query_update22 = "SELECT count(id_ventanilla) as cuentan FROM ventanilla WHERE id_oficina_registro=".$id." and (numero_ventanilla=".$numv2." or id_funcionario=".$numfun2.") and estado_ventanilla=1 order by id_ventanilla desc limit 1";
$update22 = mysql_query($query_update22, $conexion) ;
$row_update22 = mysql_fetch_assoc($update22);
$countventanilla=$row_update22['cuentan'];
mysql_free_result($update22);
 if (1<$countventanilla) {
	 echo $repetido;
 } else {
	 
$insertSQL2 = sprintf("UPDATE ventanilla set 
numero_ventanilla=%s, nombre_ventanilla=%s, id_funcionario=%s, receso=%s where id_ventanilla=%s and 
estado_ventanilla=1", 
 GetSQLValueString($_POST["numero_ventanillaact"], "int"),
GetSQLValueString($_POST["nombre_ventanillaact"], "text"), 
GetSQLValueString($_POST["id_funcionario"], "int"),
GetSQLValueString($_POST["receso"], "int"),
GetSQLValueString($_POST['id_ventanillaact'], "int"));
$Result2 = mysql_query($insertSQL2, $conexion);

 echo $actualizado;
		}
}
	
	
	
	if (isset($_POST['numero_ventanilla'])) {
	
$numv=$_POST["numero_ventanilla"];
$numfun=$_POST["id_funcionario"];
$query_update22 = "SELECT count(id_ventanilla) as cuenta FROM ventanilla WHERE id_oficina_registro=".$id." and (numero_ventanilla=".$numv." or id_funcionario=".$numfun.") and estado_ventanilla=1 order by id_ventanilla desc limit 1";
$update22 = mysql_query($query_update22, $conexion) ;
$row_update22 = mysql_fetch_assoc($update22);
$countventanilla=$row_update22['cuenta'];
mysql_free_result($update22);
 if (0<$countventanilla) {
	 echo $repetido;
 } else {
 
	$insertSQL = sprintf("INSERT INTO ventanilla (id_oficina_registro, 
numero_ventanilla, id_tipo_ventanilla, dia_funcionamiento, nombre_ventanilla, id_funcionario, tiempo, receso,  
 estado_ventanilla) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["numero_ventanilla"], "int"), 
GetSQLValueString($_POST["id_tipo_ventanilla"], "int"), 
GetSQLValueString($_POST["dia_funcionamiento"], "text"), 
GetSQLValueString($_POST["nombre_ventanilla"], "text"), 
GetSQLValueString($_POST["id_funcionario"], "int"), 
GetSQLValueString($_POST["tiempo"], "int"), 
GetSQLValueString($_POST["receso"], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

 echo $insertado;
 

$tiempo=intval($_POST["tiempo"]);
$receso=intval($_POST["receso"]);

if (0==$receso){
	$ini='12:00:00';
	$fini='12:59:00';
} else if (1==$receso) {
	$ini='13:00:00';
	$fini='13:59:00';
} else {
	$ini='17:00:00';
	$fini='18:00:00';
}

$horaincial=$_POST["horainicio"];//'08:00:00';
$horafinal=$_POST["horafin"];//'15:59:00';
$tiempof=60*$tiempo;
$fechaInicio=strtotime($horaincial);
$fechaFin=strtotime($horafinal);



$query_update2 = "SELECT id_ventanilla FROM ventanilla WHERE id_oficina_registro=".$id." and numero_ventanilla=".$numv." order by id_ventanilla desc limit 1";
$update2 = mysql_query($query_update2, $conexion) ;
$row_update2 = mysql_fetch_assoc($update2);
$idventanilla=$row_update2['id_ventanilla'];
 mysql_free_result($update2);

for($i=$fechaInicio; $i<=$fechaFin; $i+=$tiempof){
$nuevafecha= date("H:i:s", $i);	
if ($nuevafecha>=$ini and $nuevafecha<=$fini) {
} else {
	
 //echo $nuevafecha.'<br>';
 $insertSQL2 = "INSERT INTO agenda_ventanilla (id_ventanilla, nombre_agenda_ventanilla, 
 estado_agenda_ventanilla) VALUES ($idventanilla, '$nuevafecha', 1)";
$Result2 = mysql_query($insertSQL2, $conexion);

}


if ($nuevafecha>=$horafinal) {
	break; 
}
}


	}
 
  
} else {}


if (0==$id) {
	$totalRows_update=1;
} else {
  $query_update = sprintf("SELECT * FROM oficina_registro WHERE oficina_registro.id_oficina_registro = %s", GetSQLValueString($id, "int"));
  $update = mysql_query($query_update, $conexion);
  $row_update = mysql_fetch_assoc($update);
  $totalRows_update = mysql_num_rows($update);
}
  if (0 < $totalRows_update) {
    mysql_free_result($update);
?>




    <div class="row">
      <div class="col-md-12">


        <div class="box box-primary">
		
	<?php if (0==$id) {
echo '<div class="box-body box-profile">Oficina de atención al ciudadano.<br>Calle 26 No. 13-49 Interior 201. / Conmutador : 57+(1) 328 2121</div>';
} else { ?>
	
          <div class="box-body box-profile">



            <ul style="list-style:none;">
			 
      <div class="col-md-6">
			<li >
                <b>ORIP: </B><?php echo $row_update['nombre_oficina_registro']; ?>
              </li>
			
              <li >
                  <b>Departamento:</b> <?php echo quees('departamento', $row_update['id_departamento']); ?> / <?php echo nombre_municipio($row_update['codigo_municipio'], $row_update['id_departamento']); ?>
                </li>
              <li >
                <b>Teléfono:</b> <?php echo $row_update['telefono_oficina_registro']; ?>
              </li>

           

              <li >
                <b>Email:</b> <?php echo $row_update['correo_oficina_registro']; ?>
              </li>
              <li >
                <b>Dirección:</b> <?php echo $row_update['direccion_oficina_registro']; ?>
              </li>
              <li >
                <b>Horario:</b> <?php echo $row_update['horario_oficina_registro']; ?>
              </li>

 <li >
                <b>Reanudación de citas:</b> <a href="documentos/citaQR.pdf" target="_blank">Descargar</a>
              </li>
 </div>
      <div class="col-md-6">

              <li >
                <b>Circulo Registral:</b>
                <?php echo $row_update['circulo']; ?>
              </li>

              <li >
                <b>Regional:</b> <?php echo quees('region', $row_update['id_region']); ?>
              </li>

              <li >
                <b>Sistema Misional:</b> <?php echo quees('oficina_registro_sismisional', $row_update['id_oficina_registro_sismisional']); ?>
              </li>




              <li >
                <b>Iris:</b> <?php if (1 == $row_update['iris']) {
                                                                    echo 'Si';
                                                                  } else {
                                                                    echo 'No';
                                                                  } ?>
              </li>

         
		  <li >
                <b>COMPRENSIÓN REGISTRAL: </b> 
				
				<?php
              
                $actualizar57ll = mysql_query("SELECT id_municipio_orip, nombre_municipio from municipio_orip, municipio where municipio_orip.id_departamento=municipio.id_departamento and municipio_orip.codigo_municipio=municipio.codigo_municipio and  id_oficina_registro=".$id."  and estado_municipio_orip=1 order by nombre_municipio", $conexion);
                $row157ll = mysql_fetch_assoc($actualizar57ll);
                $total557ll = mysql_num_rows($actualizar57ll);
                if (0 < $total557ll) {
                  do {


               echo ''.$row157ll['nombre_municipio'].', ';
         

                   
                  } while ($row157ll = mysql_fetch_assoc($actualizar57ll));
                  mysql_free_result($actualizar57ll);
                } else {
                }
                
				
				
           
				
                ?>
              </li>

		 
</div>
         
            </ul>



			

          </div>
<?php } ?>

  
        <div class="nav-tabs-custom">



	 
          

          <div class="tab-content">
		  <?php  if (1==$_SESSION['rol'] or 0<$nump102) { ?>
  
   
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>
	  
	    &nbsp;   &nbsp;   &nbsp;    &nbsp;   &nbsp;   &nbsp;    &nbsp;   &nbsp;   &nbsp;  &nbsp;   &nbsp;   &nbsp;    &nbsp;   &nbsp;   &nbsp;    &nbsp;   &nbsp;   &nbsp;
		<a href="xls/agendamientos&<?php echo $id; ?>.xls">Descargar reporte completo de todas las ventanillas</a> 
	  <br> <br>
<?php } else {} ?>

		  
            <div class="active tab-pane" id="activity">

              <div class="post">
                <div class="user-block">
                  <div class="col-xs-12 table-responsive ">

                    <?php
					
			
$queryn = "SELECT * FROM ventanilla, tipo_ventanilla, funcionario where ventanilla.id_tipo_ventanilla=tipo_ventanilla.id_tipo_ventanilla and ventanilla.id_funcionario=funcionario.id_funcionario and ventanilla.id_oficina_registro=".$id." and estado_ventanilla=1";
                    
					
					$selectn = mysql_query($queryn, $conexion) ;
                    $row = mysql_fetch_assoc($selectn);
					$totalRows = mysql_num_rows($selectn);

if (0<$totalRows){
                    ?>


	  
                    <table class="table table-striped table-bordered table-hover" id="detallefun">
                    
				<thead><tr align='center' valign='middle'>
				<th>Número</th>
				<th>Tramite</th>
				<th>Tipo</th>
				<th>Dias (1-5)(Lun-Vie)</th>
				<th>Tiempo x ciudadano</th>
				<th>Asignación</th>
				<th>Receso</th>
				<th></th>
				</tr></thead><tbody>
				
					  
                        <?php
                        do {
                          echo '<tr>';
$idv=$row['id_ventanilla'];
echo '<td>'.$row['numero_ventanilla'].'</td>';
echo '<td>'.$row['nombre_ventanilla'].'</td>';
echo '<td>'.$row['nombre_tipo_ventanilla'].'</td>';
echo '<td>'.$row['dia_funcionamiento'].'</td>';
echo '<td>'.$row['tiempo'].' minutos</td>';
echo '<td>'.$row['nombre_funcionario'].' <a href="usuario&'.$row['id_funcionario'].'.jsp" target="_blank"><span class="fa fa-user"></span></a></td>';
echo '<td>';
if (0==$row['receso']) { echo '12:00 a 13:00';
} else if(1==$row['receso']) { echo '13:00 a 14:00';
 } else if(2==$row['receso']) { echo 'Sin receso';
} else  { } 
echo '</td>';

echo '<td>';

	echo ' <a href="" class="buscaragenda" id="'.$idv.'" title="'.$idv.'" data-toggle="modal" data-target="#popupagenda"><span class="fa fa-search"></span></a> &nbsp; ';
	
	echo ' <a href="" class="buscaractualizaragenda" id="'.$idv.'" title="'.$idv.'" data-toggle="modal" data-target="#popupactualizaragenda"><span class="fa fa-edit"></span></a> &nbsp; ';
	
	echo ' <a href="agenda&'.$row['id_funcionario'].'.jsp" target="_blank"><span class="fa fa-calendar"></span></a> &nbsp; ';
	
	
		if (1==$_SESSION['rol'] or 0<$nump105) { 
	//echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="ventanilla" id="'.$idv.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	
echo '</td>';
                      echo '</tr>';
                        } while ($row = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);


                        ?>
						<script>
				$(document).ready(function() {
					$('#detallefun').DataTable({
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
                        
                      </tbody>
                    </table>
<?php } else { echo 'No existen registros';} ?>
</div>
                </div>
              </div>
            </div>






            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>








<?php if (1==$_SESSION['rol'] or 0<$nump102) { ?>





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
        
<form action="" method="POST" name="for5445435354r65464563m1" >

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO:</label> 
<select type="text" class="form-control" name="id_tipo_ventanilla"  required>
<option selected></option>
<option value="1">Ventanilla solicitada por web</option>
<option value="2">Ventanilla solicitada presencialmente</option>
<option value="3">Caja</option>
</select>
</div>

				
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO:</label> 
<input type="text" class="form-control numero" name="numero_ventanilla"  required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TRAMITE:</label> 
<select type="text" class="form-control" name="nombre_ventanilla"  required>
<option selected></option>
<?php if (0==$id) {
echo '<option value="Atención de ciudadanos">Atención de ciudadanos</option>';
} else { ?>
<option value="Entrega de documentos inscritos o devueltos.">Entrega de documentos inscritos o devueltos.</option>
<option value="Correcciones">Correcciones</option>
<option value="Liquidación de documentos sujetos a registro">Liquidación de documentos sujetos a registro</option>
<option value="Radicación de documentos sujetos a registro">Radicación de documentos sujetos a registro</option>
<option value="Liquidación y Radicación de documentos">Liquidación y Radicación de documentos</option>
<option value="REVAL Generación de certificados tradición y de pertenencia">REVAL Generación de certificados tradición y de pertenencia</option>
<option value="Sector constructor">Sector constructor</option>

<option value="Todos los tramites">Todos los tramites</option>
<?php } ?>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIEMPO X CIUDADANO:</label> 
<select class="form-control" name="tiempo"  required>
<option selected></option>
<option value="5">5 minutos</option>
<option value="10">10 minutos</option>
<option value="15">15 minutos</option>
<option value="20">20 minutos</option>
<option value="25">25 minutos</option>
<option value="30">30 minutos</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ASIGNACIÓN:</label> 
<select  class="form-control" name="id_funcionario" required>
<option value="" selected></option>
<?php
if (0==$id) {
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_grupo_area=24 order by nombre_funcionario"); 	
} else {
$query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where id_oficina_registro=".$id." order by nombre_funcionario"); 
}
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
do {
	echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 

mysql_free_result($select);
?>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Dia: 1 (para lunes) hasta 7 (para domingo) SEPARADOS POR COMAS</label> 
<input type="text" class="form-control" name="dia_funcionamiento" value="1,2,3,4,5" placeholder="1,2,3,4,5" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> HORA DE INICIO:</label> 
<select class="form-control" name="horainicio"  required>
<option selected></option>
<option>08:00:00</option>
<option>09:00:00</option>
<option>10:00:00</option>
<option>11:00:00</option>
<option>12:00:00</option>
<option>13:00:00</option>
<option>14:00:00</option>
<option>15:00:00</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> HORA DE TERMINACIÓN:</label> 
<select class="form-control" name="horafin"  required>
<option selected></option>
<option value="08:59:00">09:00:00</option>
<option value="09:59:00">10:00:00</option>
<option value="10:59:00">11:00:00</option>
<option value="11:59:00">12:00:00</option>
<option value="12:59:00">13:00:00</option>
<option value="13:59:00">14:00:00</option>
<option value="14:59:00">15:00:00</option>
<option value="15:59:00">16:00:00</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RECESO:</label> 
<select class="form-control" name="receso"  required>
<option selected></option>
<option value="0">12:00 a 13:00</option>
<option value="1">13:00 a 14:00</option>
<option value="2">Sin receso</option>
</select>
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









<div class="modal fade" id="popupagenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Agenda</b></h4>
</div> 
<div class="ver_agenda" class="modal-body"> 

</div>
</div> 
</div> 
</div>





<div class="modal fade" id="popupactualizaragenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar agenda</b></h4>
</div> 
<div class="ver_actualizaragenda" class="modal-body"> 

</div>
</div> 
</div> 
</div>



<?php } else { }

  }
  } else {}
   } else {}
}
?>
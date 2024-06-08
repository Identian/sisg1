<?php
$nump102 = privilegios(102, $_SESSION['snr']);



if (isset($_GET['i']) && (1==$_SESSION['rol'] or 0<$nump102)) {
$id=$_GET['i'];
} else {
$id=$_SESSION['snr'];
}

$query_updatef = "SELECT * from ventanilla where id_funcionario=".$id." ";
$updatef = mysql_query($query_updatef, $conexion);
$totalff = mysql_num_rows($updatef);
$rowf = mysql_fetch_assoc($updatef);
$fun=$rowf['id_funcionario'];
$ofi=$rowf['id_oficina_registro'];
$id_ventanilla=$rowf['id_ventanilla'];
$id_tipo_ventanilla=$rowf['id_tipo_ventanilla'];
$numeroventanilla=$rowf['numero_ventanilla'];
mysql_free_result($updatef);
/*
if (0<$totalff && 2==$id_tipo_ventanilla) {
	?>
	<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
<div class="col-md-12">
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
<thead><tr align='center' valign='middle'>
	<th style="width:10px;"></th><th>Fecha</th><th>Horario</th><th>Cita</th>
<th>Cedula</th><th>Ciudadano</th><th>Correo</th><th>Estado</th><th></th></tr>
</thead><tbody>
				
<?php
$fechav=date('Y-m-d');
$queryn = sprintf("SELECT * FROM presencial_ventanilla where ventanilla=5 and fecha='$fechav' order by id_presencial_ventanilla"); 
selectn = mysql_query($queryn, $conexion) ;
$row = mysql_fetch_assoc($selectn);
$totalRows = mysql_num_rows($selectn);
echo $totalRows;
                        do {
                         

	$hora=$row['hora'];
	echo '<tr><td></td><td>'.$row['fecha'].'</td><td>'.$hora.'</td><td></td>
	<td>'.$row['identificacion'].'</td><td>'.$row['nombre_presencial_ventanilla'].'</td><td></td><td></td><td></td></tr>';
	

                        } while ($row = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);


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
						"aaSorting": [[ 2, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
	
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->



<?php  
	
	
} else {
*/
if ((isset($_POST["table"])) && ($_POST["table"] == "ciudadanos")) { 

$identificacion=$_POST["identificacion"];

if (isset($_POST["correo_c"]) && ""!=$_POST["correo_c"]) {
	$correo_c=$_POST["correo_c"];
	$infoc=" or correo_ciudadano='$correo_c'";
	
} else {
	$correo_c="correotrazadepqrs@supernotariado.gov.co";
	$infoc="";
}


$query4 = sprintf("SELECT identificacion FROM ciudadano where identificacion='$identificacion' ".$infoc." limit 1"); 
$select4 = mysql_query($query4, $conexion);
$totalRows4 = mysql_num_rows($select4);
if (0<$totalRows4){ 
echo $usuariorepetido;
}
else {
	
	
	




$insertSQL = sprintf("INSERT INTO ciudadano (nombre_ciudadano, id_tipo_documento, identificacion, 
 sexo, id_etnia, correo_ciudadano, clave_ciudadano, telefono_ciudadano, 
id_departamento, id_municipio, id_tipo_respuesta, direccion_ciudadano,  
estado_ciudadano, fuente, cfuncionario) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_POST["nombre_c"], "text"), 
GetSQLValueString($_POST["id_tipo_documento"], "int"), 
GetSQLValueString($_POST["identificacion"], "text"),  
GetSQLValueString($_POST["sexo"], "text"), 
GetSQLValueString($_POST["id_etnia"], "int"), 
GetSQLValueString($correo_c, "text"), 
GetSQLValueString(md5($identi), "text"), 
GetSQLValueString($_POST["telefono_c"], "text"), 
GetSQLValueString($_SESSION['id_departamento'], "int"), 
GetSQLValueString($_SESSION['id_municipio'], "int"), 
GetSQLValueString(3, "int"), 
GetSQLValueString($_POST["direccion_c"], "text"),
GetSQLValueString(1, "int"),
GetSQLValueString(5, "int"),
GetSQLValueString(0, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;
}

}


if (isset($_POST['cita'])) {
$fechares=date('H:i:s');
$insertSQL2 = sprintf("UPDATE cita_ventanilla set 
 fecha_resultado=%s, resultado=1 where id_cita_ventanilla=%s and fecha_cita='$realdate' and estado_cita_ventanilla=1", 
GetSQLValueString($fechares, "text"),
GetSQLValueString($_POST['cita'], "int")
);
$Result2 = mysql_query($insertSQL2, $conexion);

 echo $actualizado;
		}
		
		
		if (isset($_POST['cita2'])) {
$fechares=date('H:i:s');
$insertSQL2 = sprintf("UPDATE cita_ventanilla set 
 fecha_resultado=%s, resultado=2 where id_cita_ventanilla=%s and fecha_cita='$realdate' and estado_cita_ventanilla=1", 
GetSQLValueString($fechares, "text"),
GetSQLValueString($_POST['cita2'], "int")
);
$Result2 = mysql_query($insertSQL2, $conexion);

 echo $actualizado;
		}
		


if (isset($_POST['id_agenda_ventanilla'])) {
$id_agendav=$_POST['id_agenda_ventanilla'];
$query_updatefv = "SELECT count(id_cita_ventanilla) as contadorv FROM cita_ventanilla where fecha_cita='$realdate' and id_agenda_ventanilla=".$id_agendav." and estado_cita_ventanilla=1";
$updatefv = mysql_query($query_updatefv, $conexion);
$rowfv = mysql_fetch_assoc($updatefv);
$cc=$rowfv['contadorv'];
if (0<$cc){
echo '<script type="text/javascript">swal(" NO DISPONIBLE !", " La hora seleccionada ya no esta disponible.", "error");</script>';
} else {
	
$insertSQL = sprintf("INSERT INTO cita_ventanilla (id_agenda_ventanilla, fecha_cita, 
id_ciudadano, estado_cita_ventanilla) VALUES (%s, %s, %s, %s)", 
GetSQLValueString($_POST['id_agenda_ventanilla'], "int"), 
GetSQLValueString($realdate, "date"), 
GetSQLValueString($_POST['id_ciudadano'], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
 echo $insertado;
 mysql_free_result($updatef);
}
	}



?>
<div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3>
<?php 
if (isset($_POST['fecha_dia']) && ""!==$_POST['fecha_dia']) {
	$fechar=$_POST['fecha_dia'];
} else {
	$fechar=$realdate;
}


$queryn = "SELECT * from cita_ventanilla, ciudadano, agenda_ventanilla where fecha_cita='$fechar' and cita_ventanilla.id_ciudadano=ciudadano.id_ciudadano and agenda_ventanilla.id_ventanilla=".$id_ventanilla." and cita_ventanilla.id_agenda_ventanilla=agenda_ventanilla.id_agenda_ventanilla ";
$selectn = mysql_query($queryn, $conexion) ;
$row = mysql_fetch_assoc($selectn);
$totalRows = mysql_num_rows($selectn);
echo $totalRows;

 ?></h3>

              <p>Cantidad de Citas</p>
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
<?php $query_update = "SELECT count(id_cita_ventanilla) as tot from cita_ventanilla, agenda_ventanilla where fecha_cita='$realdate' and agenda_ventanilla.id_ventanilla=".$id_ventanilla." and cita_ventanilla.id_agenda_ventanilla=agenda_ventanilla.id_agenda_ventanilla and resultado=1 and estado_cita_ventanilla=1";
$update = mysql_query($query_update, $conexion);
$rowc = mysql_fetch_assoc($update);
$tot=$rowc['tot'];
echo $tot;
mysql_free_result($update); ?></h3>

              <p>Citas finalizadas hoy</p>
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
 <?php  $dis=$totalRows-$tot; echo $dis;?></h3>
			 
              <p>Citas faltantes</p>
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
              <h3><?php echo $numeroventanilla; ?></h3>
              <p>Ventanilla</p>
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
<?php  

if (1==$_SESSION['rol'] ) {
?>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popupturno"><span class="glyphicon glyphicon-plus-sign"></span>
        Turno automático
      </button> 
	  <?php
	  } else {}



if (1==$_SESSION['rol'] or $id==$_SESSION['snr']) { ?>
  
  
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nueva cita
      </button> &nbsp;  
	  
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#popupnewciudadano"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo ciudadano
      </button> 

    
	  
<?php } else {} 

?>


	  </div>
	  
	  
	  
	   <div class="col-md-5">
	
<?php 

echo '<b>Fecha: '.$fechar;
echo '</b> / Agenda de ';
echo quees('funcionario',$id);
?>

</div>


 <div class="col-md-3">
 <form method="post" action="" name="form345435io">
<input type="text" class="datepicker" style="width:200px;" name="fecha_dia" readonly required value="<?php echo $fechar; ?>"> 
<input type="submit" value="Cambiar dia"  >
</form>
 </div>

  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
      <?php
					
			
			 
if (0<$totalRows){
?>
<form method="post" action="" name="formularioagenda">
<input type="hidden" name="cita" id="acita" >
</form>

<form method="post" action="" name="formularionoasistio">
<input type="hidden" name="cita2" id="acita2" >
</form>

		
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
			
               <thead><tr align='center' valign='middle'>
				
<tr><th style="width:10px;"></th><th>Fecha</th><th>Horario</th><th>Cita</th>

<th>Cedula</th><th>Ciudadano</th><th>Correo</th><th>Estado</th><th></th></tr>

</thead><tbody>
				
<?php
                        do {
                         
$idv=$row['id_cita_ventanilla'];
$iagenda=$row['id_agenda_ventanilla'];
$horaagenda=$row['nombre_agenda_ventanilla']; 





 echo '<tr>';
echo '<td><span style="font-size:7px;color:#fff;">'.$iagenda.'</span></td>';
echo '<td>'.$row['fecha_cita'].'</td>';
echo '<td>'.$horaagenda.'</td>';

echo '<td>';
 if (1==$row['estado_cita_ventanilla']) {
	 echo 'Activa';
 } else {
	  echo '<b style="color:#B40404">Cancelada</b>';
 }
echo '</td>';


echo '<td>'.$row['identificacion'].'</td>';
echo '<td>'.$row['nombre_ciudadano'].'</td>';
echo '<td>'.$row['correo_ciudadano'].'</td>';
if (isset($row['reanudacion'])) {
echo '<td style="background:#f39c3f;">Reanudar ('.$row['reanudacion'].')</td>';
} else { 
echo '<td>';
if (0==$row['resultado']) {
echo '<a id="'.$idv.'" name="'.$iagenda.'" class="listarcita" style="cursor:pointer;color:#3366cc;"><span class="fa fa-warning"></span> Pendiente</a> ';

echo '<a id="'.$idv.'" name="'.$iagenda.'" class="noasistio" style="cursor:pointer;color:#ff0000;"><span class="fa fa-delete"></span> No asistio</a>';
} else { }

if (1==$row['resultado']) {
	echo '<span class="fa fa-check" style="color:#3F8E4D"> Realizada</span>';
} else {}

if (2==$row['resultado']) {
	echo '<span style="color:#FF0000">X No asistio</span>';
} else {}

echo '</td>';
}
echo '<td>';
echo ' <a href="ciudadano&'.$row['id_ciudadano'].'.jsp" target="_blank" ><span class="fa fa-user"></span></a>';
/*if (1==$_SESSION['rol'] && 0==$row['resultado']) { 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="cita_ventanilla" id="'.$idv.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	*/
echo '</td>';
echo '</tr>';


                        } while ($row = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);




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
						"aaSorting": [[ 2, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
		 
		<?php } else {} ?>
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (1==1) { ?>


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
        
		
		

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cédula Ciudadano:</label> 
(0 si es anónimo)
</div>
<div class="input-group">
<input type="text" class="form-control numero"  name="identificacion" id="identificacion" required  value="">
  <span class="input-group-addon" style="cursor:pointer;" id="buscarcedula"><i class="fa fa-search"></i></span>
 </div>
<input type="hidden"  id="id_venta"  value="<?php echo $id_ventanilla; ?>" >


<form action="" method="POST" name="for2343245445435354r65464563m1" >
	

	  

<div id="agenda">
<br><br><br><br><br><br>

</div>

<div id="disponibilidad" style="display:none;">

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



<div class="modal fade" id="popupnewciudadano" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">NUEVO CIUDADANO:</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<span  style="color:#ff0000;">* Obligatorios</span> 
<form action="" method="POST" name="form1">

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE DOCUMENTO:</label> 
<select  class="form-control" name="id_tipo_documento" required>
<option value="" selected></option>
<?php
$query = sprintf("SELECT id_tipo_documento, nombre_tipo_documento FROM tipo_documento where estado_tipo_documento=1 order by id_tipo_documento"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_documento'].'">'.$row['nombre_tipo_documento'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE IDENTIFICACION:</label> 
<input type="text" class="form-control numero" name="identificacion"  required>
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE:</label> 
<input type="text" class="form-control" name="nombre_c"  required>
</div>

<hr>
<div class="form-group text-left" > 
<label  class="control-label">GENERO:</label> 
<select  class="form-control" name="sexo" required>
<option value="" selected></option>
<option value="Mujer">Mujer</option>
<option value="Hombre">Hombre</option>
</select>
</div>



<div class="form-group text-left" > 
<label  class="control-label">ETNIA:</label> 
<select  class="form-control" name="id_etnia">
<option value="6" selected></option>
<?php
$query = sprintf("SELECT id_etnia, nombre_etnia FROM etnia where estado_etnia=1 order by id_etnia"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_etnia'].'">'.$row['nombre_etnia'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>

<div class="form-group text-left" > 
<label  class="control-label">TELEFONO:
<?php // echo $_SESSION['id_departamento'].$_SESSION['id_municipio'];?></label>
<input type="text" class="form-control" name="telefono_c">
</div>


<!--
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> DEPARTAMENTO</label> 
<select name="id_departamento" id="id_departamentomun" class="form-control">
		
<option value="" selected></option>
<?php
/*
$query = sprintf("SELECT id_departamento, nombre_departamento FROM departamento where estado_departamento=1 order by id_departamento"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_departamento'].'">'.strtoupper($row['nombre_departamento']).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
*/
?>
</select> 
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> MUNICIPIO:</label> 
<select class="form-control" name="id_municipio" id="id_municipiomun" required>

</select>
</div>


<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span>  POR QUE MEDIO DESEA RECIBIR SU RESPUESTA:</label> 
<select  class="form-control" name="id_tipo_respuesta" id="id_tipo_respuesta" required>
<option value="" selected></option>
<?php /*
$query = sprintf("SELECT id_tipo_respuesta, nombre_tipo_respuesta FROM tipo_respuesta where estado_tipo_respuesta=1 order by id_tipo_respuesta"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_respuesta'].'">'.$row['nombre_tipo_respuesta'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
*/
?>
</select>
</div>
-->


<div class="form-group text-left" > 
<label  class="control-label">CORREO ELECTRÓNICO:</label> 
<input type="email" class="form-control" name="correo_c"  id="correo_c">
</div>


<div class="form-group text-left" > 
<label  class="control-label">DIRECCION:</label> 
<input type="text" class="form-control" name="direccion_c"  id="direccion_c" >
</div>



<span  style="color:#ff0000;">* Obligatorios</span> 

<div class="modal-footer">
<button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success" onclick="infomun();">
<input type="hidden" name="table" value="ciudadanos">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>
</form>

</div>
</div> 
</div> 
</div> 












<div class="modal fade" id="popupturno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">NUEVO TURNO:</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<span  style="color:#ff0000;">* Obligatorios</span> 
<form action="" method="POST" name="form1">
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE DOCUMENTO:</label> 
<input type="hidden" class="form-control" VALUE="1" readonly name="id_tipo_documento"  required>
Cédula de ciudadania
</div>


<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE IDENTIFICACION:</label> 
<input type="text" class="form-control numero" name="identificacion"  autofocus="autofocus" required>
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> PRIMER APELLIDO:</label> 
<input type="text" class="form-control" name="1apellido"  required>
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> SEGUNDO APELLIDO:</label> 
<input type="text" class="form-control" name="1apellido"  required>
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> PRIMER NOMBRE:</label> 
<input type="text" class="form-control" name="1apellido"  required>
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> SEGUNDO NOMBRE:</label> 
<input type="text" class="form-control" name="1apellido"  required>
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> GENERO:</label> 
<input type="text" class="form-control" name="sexo"  required>
</div>


<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE NACIMIENTO:</label> 
<input type="text" class="form-control" name="nacimiento"  required>
</div>



<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE SANGRE:</label> 
<input type="text" class="form-control" name="sangre"  required>
</div>

<!--

<div class="form-group text-left" > 
<label  class="control-label">TELEFONO:
<?php // echo $_SESSION['id_departamento'].$_SESSION['id_municipio'];?></label>
<input type="text" class="form-control" name="telefono_c">
</div>



<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> DEPARTAMENTO</label> 
<select name="id_departamento" id="id_departamentomun" class="form-control">
		
<option value="" selected></option>
<?php
/*
$query = sprintf("SELECT id_departamento, nombre_departamento FROM departamento where estado_departamento=1 order by id_departamento"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_departamento'].'">'.strtoupper($row['nombre_departamento']).'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
*/
?>
</select> 
</div>

<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> MUNICIPIO:</label> 
<select class="form-control" name="id_municipio" id="id_municipiomun" required>

</select>
</div>


<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span>  POR QUE MEDIO DESEA RECIBIR SU RESPUESTA:</label> 
<select  class="form-control" name="id_tipo_respuesta" id="id_tipo_respuesta" required>
<option value="" selected></option>
<?php /*
$query = sprintf("SELECT id_tipo_respuesta, nombre_tipo_respuesta FROM tipo_respuesta where estado_tipo_respuesta=1 order by id_tipo_respuesta"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_respuesta'].'">'.$row['nombre_tipo_respuesta'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
*/
?>
</select>
</div>
-->

<!--
<div class="form-group text-left" > 
<label  class="control-label">CORREO ELECTRÓNICO:</label> 
<input type="email" class="form-control" name="correo_c"  id="correo_c">
</div>


<div class="form-group text-left" > 
<label  class="control-label">DIRECCION:</label> 
<input type="text" class="form-control" name="direccion_c"  id="direccion_c" >
</div>

-->

<span  style="color:#ff0000;">* Obligatorios</span> 

<div class="modal-footer">
<button type="reset" class="btn btn-danger" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success" onclick="infomun();">
<input type="hidden" name="table" value="ciudadanos">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>
</form>

</div>
</div> 
</div> 
</div> 





<?php } else { }
//}



?>

<!DOCTYPE html>
<html lang="es">
<head>
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<?php

$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;


if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {
	
	$id_funcionario = $_SESSION['snr'];
	$id_funcionario2 = $_SESSION['snr'];
//	echo "id funcionario: ".$id_funcionario;
	
	$query2 = sprintf("SELECT sysdate() hoy "); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);
    $hoy = $row2['hoy'];

   
	$query5 = sprintf("SELECT * FROM funcionario
                  where id_funcionario = '$id_funcionario' 
				  and estado_funcionario = 1 "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){
       $id_cargo = $row5['id_cargo'];
	   $nombre_funcionario_log = $row5['nombre_funcionario'];
	   $id_tipo_oficina = $row5['id_tipo_oficina'];
	   $id_grupo_area = $row5['id_grupo_area'];
	   $id_oficina_registro = $row5['id_oficina_registro'];
   } 

	  
} else { 
     echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 


 if ($_SESSION['rol'] == 1) {
	$privi = " ";
    $id= 0;
 }


if (isset($_GET["i"]) && ""!=$_GET["i"]) {
    $id_periodos_edl = intval($_GET["i"]);

   $query84 = "UPDATE periodos_edl SET estado_periodos_edl = 0  WHERE id_periodos_edl = ".$id_periodos_edl." limit 1";  
 
   $Result1 = mysql_query($query84, $conexion);

   echo $actualizado;

 } else {
  
 }

 include('tablero_edl.php');
 
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
		  <div id="navbar" class="navbar">
<!--		  <p style="font-size: 20px"><b>PERÍODOS DE EVALUACIÓN DESEMPEÑO LABORAL - EDL </b></p> -->
            <ul class="nav navbar-nav">
              <li style="font-size: 18px; color: black;"><a href="edl_fun.jsp" ><b>PERÍODOS DE EVALUACIÓN DEL DESEMPEÑO LABORAL - EDL</b></a></li>
			</ul>
          </div>
        </div>
		
      </div>
    </nav>
  </div>
</div>

	  
	  
	  
<div class="row">
<div class="col-md-12">

 <div class="box box-info">
  <div class="box-header with-border">
	<div class="col-md-4">
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#periodos_edl"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Período de Evaluación</button>&nbsp;
    </div>
  </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  <th>Id Período</th>
				  <th>Nombre Período</th>
                  <th>Fecha Desde</th>
                  <th>Fecha Hasta</th>
                 <th colspan="4">Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT * FROM periodos_edl
                          WHERE estado_periodos_edl = 1 ");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {

            ?>
          <tr>
		     <?php 
			 $id_periodos_edl = $row_dian['id_periodos_edl'];
		     $nombre_periodos_edl = $row_dian['nombre_periodos_edl'];
             $fechaper_desde = $row_dian['fechaper_desde'];
             $fechaper_hasta = $row_dian['fechaper_hasta'];
			 $sw5 = 0;
			
	         ?>
             <td width = "150px"><?php echo $id_periodos_edl; ?></td>
			 <td width = "520px"><?php echo $nombre_periodos_edl; ?></td>
             <td width = "120px"><?php echo $fechaper_desde; ?></td>
             <td width = "120px"><?php echo $fechaper_hasta; ?></td>
			 
        	 <td width = "60px">
<!--                <a href="consulta_edl&<?php echo $id_eval_funcionario_edl; ?>.jsp"><span class="btn btn-info btn-xs" title="Consultar registro"><span  class="glyphicon glyphicon-hand-up"></span></a> &nbsp; -->
				<button type="button" class="btn btn-success btn-xs modifiper" title="Modificación Período "><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
             </td> 
             <?php if($id_cargo <= 2 or 1==$_SESSION['rol']) { ?>
             <td width = "60px">
                <a href="edl_periodos&<?php echo $id_periodos_edl; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar registro"  ><span class="glyphicon glyphicon-trash"></span></a>
             </td>
			<?php } ?>
          </tr>

      <?php } ?> <!-- CIERRE PRIMER WHILE -->

          <script>

              $(document).ready(function() {
            $('#tab_sucesiones').DataTable({
              "lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              }
            });
          });

          </script>
            </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->



<?php
// Generacion de periodos de evaluacion
// *************************************
?>

<div class="modal fade"  id="periodos_edl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>PERIODOS DE EVALUACION - EDL</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4377224"  enctype="multipart/form-data">

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA DESDE:</label>   
      <input type="date" class="form-control" name="fechaper_desde" id="fechaper_desde" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA HASTA:</label>   
      <input type="date" class="form-control" name="fechaper_hasta" id="fechaper_hasta" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">NOMBRE DEL PERIODO:</label>   
      <input type="text" class="form-control" name="nombre_periodos_edl" id="nombre_periodos_edl" value="" onChange = "valfechas();" required >
    </div>

    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="creaperiodo" id="creaperiodo" value="creaperiodo">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<?php
// MODIFICACION PERIODO
// **********************
?>

<div class="modal fade"  id="modiperiodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN PERÍODO</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_periodos_edl4" id="id_periodos_edl4" readonly="readonly" value="">
	
    <div class="form-group text-left"> 
      <label  class="control-label">FECHA DESDE:</label>   
      <input type="date" class="form-control" name="fechaper_desde4" id="fechaper_desde4" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA HASTA:</label>   
      <input type="date" class="form-control" name="fechaper_hasta4" id="fechaper_hasta4" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">NOMBRE DEL PERIODO:</label>   
      <input type="text" class="form-control" name="nombre_periodos_edl4" id="nombre_periodos_edl4" value="" onChange = "valmodfechas();" required >
    </div>
    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actscrgral" value="actscrgral">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<?php

 function lista2($table, $id) {
		
global $mysqli;
$query5 = "SELECT id_".$table.", nombre_".$table."  FROM ".$table." where  id_".$table." in (".$id.") ";
$result5 = $mysqli->query($query5);
while ($obj = $result5->fetch_array()) {
	$infoid='id_'.$table;
	$infonombre ='nombre_'.$table;
	$nom = $obj[$infonombre];
	$codifi = mb_detect_encoding($nom, "UTF-8, ISO-8859-1");
	$infonombre = iconv($codifi, 'UTF-8', $nom);
	
    printf ("<option value='%s'>%s</option>\n", $obj[$infoid], $infonombre);
 }

$result5->free();

}

 
 ?>


<script>
     $(document).ready(function() {
      $('.modifiper').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#modiperiodo").modal("show");
          $('#id_periodos_edl4').val(data[0]);
		  $('#nombre_periodos_edl4').val(data[1]);
          $('#fechaper_desde4').val(data[2]);
		  $('#fechaper_hasta4').val(data[3]);
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.aprobjdtr').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#aprojedtr").modal("show");
          $('#id_ausentismo3').val(data[0]);
		  $('#id_funcionario_jefe3').val(data[1]);
          $('#id_funcionario3').val(data[2]);
		  $('#nombre_funcionario3').val(data[3]);
		  $('#id_tipo_ausentismo3').val(data[4]);
		  $('#nombre_tipo_ausentismo3').val(data[5]);
          $('#mfecha_inicio3').val(data[6]);
		  $('#mfecha_final3').val(data[7]);
		  $('#id_funcionario_reempla3').val(data[8]);
		  $('#id_tipo_ausentismo3').val(data[9]);
		  $('#id_aprobacion_ausentismo3').val(data[10]);
//		  $('#nombre_aprobacion_ausentismo3').val(data[11]);
		  $('#motivo_ausentismo3').val(data[12]);
		  $('#hora_inicio3').val(data[13]);
		  $('#hora_final3').val(data[14]);
		  $('#id_tipo_oficina3').val(data[15]);
		  $('#id_grupo_area3').val(data[16]);
		  $('#id_oficina_registro3').val(data[17]);
		  $('#nombre_funcionario_reem3').val(data[18]);
		  
        if(data[6] == data[7]) {
			hdesde3.style.display='block';
			hhasta3.style.display='block';
         } else {
			document.getElementById('hora_inicio3').value = '00:00:00';
			document.getElementById('hora_final3').value = '00:00:00';
		 }
		 

      jsofireg();
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.aprobtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#aprscrgral").modal("show");
          $('#id_ausentismo4').val(data[0]);
          $('#id_funcionario_jefe4').val(data[1]);
		  
          $('#nombre_funcionario4').val(data[3]);
          $('#nombre_tipo_ausentismo4').val(data[5]);
          $('#mfecha_inicio4').val(data[6]);
          $('#mfecha_final4').val(data[7]);
		  $('#id_funcionario_reempla4').val(data[8]);
		  $('#id_aprobacion_ausentismo4').val(data[10]);
		  $('#motivo_ausentismo4').val(data[12]);
		  $('#id_tipo_oficina4').val(data[15]);
		  $('#id_grupo_area4').val(data[16]);
		  $('#id_oficina_registro4').val(data[17]);
          $('#nombre_funcionario_reem4').val(data[18]); 
		  });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.rhaprobtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#aprrecurh").modal("show");
          $('#id_ausentismo5').val(data[0]);
          $('#id_funcionario_jefe5').val(data[1]);
		  
          $('#nombre_funcionario5').val(data[3]);
          $('#nombre_tipo_ausentismo5').val(data[5]);
          $('#mfecha_inicio5').val(data[6]);
          $('#mfecha_final5').val(data[7]);
		  $('#id_funcionario_reempla5').val(data[8]);
		  $('#id_aprobacion_ausentismo5').val(data[10]);
		  $('#motivo_ausentismo5').val(data[12]);
		  $('#id_tipo_oficina5').val(data[15]);
		  $('#id_grupo_area5').val(data[16]);
		  $('#id_oficina_registro5').val(data[17]);
          $('#nombre_funcionario_reem5').val(data[18]);
      });  
    });

</script>

<script>
    function valfechas() {

        var inicio = document.getElementById('fechaper_desde').value;
		var final = document.getElementById('fechaper_hasta').value;
//		alert("fecha inicio: " + fecha_inicio);

        var aFecha1 = inicio.split('-');
        var aFecha2 = final.split('-');
        var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
        var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
		var fec1 = aFecha1[0] + aFecha1[1] + aFecha1[2];
		var fec2 = aFecha2[0] + aFecha2[1] + aFecha2[2];
        var diasdif = Number(fec2) - Number(fec1);
//        alert("diasdif : " + diasdif);
        if(diasdif <= 0) {
           alert("Rango de fechas errado... ");
		   document.getElementById('fechaper_hasta').focus();
		   return false;
		} else {
		   document.getElementById('nombre_periodos_edl').focus();	
		}
		
    }
</script>

<script>
    function valmodfechas() {

        var inicio = document.getElementById('fechaper_desde4').value;
		var final = document.getElementById('fechaper_hasta4').value;
//		alert("fecha inicio: " + fecha_inicio);

        var aFecha1 = inicio.split('-');
        var aFecha2 = final.split('-');
        var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
        var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
		var fec1 = aFecha1[0] + aFecha1[1] + aFecha1[2];
		var fec2 = aFecha2[0] + aFecha2[1] + aFecha2[2];
        var diasdif = Number(fec2) - Number(fec1);
//        alert("diasdif : " + diasdif);
        if(diasdif <= 0) {
           alert("Rango de fechas errado... ");
		   document.getElementById('fechaper_hasta4').focus();
		   return false;
		} else {
		   document.getElementById('nombre_periodos_edl4').focus();	
		}
		
    }
</script>
  
<?php  

function periodosedl() {
	global $mysqli;
	$query = "SELECT * FROM periodos_edl WHERE estado_periodos_edl=1 ";
    $resultado = $mysqli->query($query);
	 while ($obj = $resultado->fetch_object()) {
        printf ("<option value='%s'>%s</option>\n", $obj->id_periodos_edl, $obj->fechaper_desde. ' - '.$obj->fechaper_hasta);
    }
}
	

// Registra periodos de evaluacion
// ********************************

if (isset($_POST['creaperiodo'])) {

    $fechaper_desde = $_POST['fechaper_desde'];
    $fechaper_hasta = $_POST['fechaper_hasta'];
	$nombre_periodos_edl = $_POST['nombre_periodos_edl'];

    $query5 = sprintf("SELECT *  
	FROM periodos_edl 
	WHERE fechaper_desde = '$fechaper_desde'  
	AND   fechaper_hasta = '$fechaper_hasta' 
	AND   estado_periodos_edl = 1 "); 
$select5 = mysql_query($query5, $conexion);
$row5 = mysql_fetch_assoc($select5);
$totalRows5 = mysql_num_rows($select5);
if ($totalRows5 > 0) { 

echo $repetido; 


} else {
	$insertSQL = sprintf("INSERT INTO periodos_edl (
      nombre_periodos_edl, fechaper_desde, fechaper_hasta) 
	  VALUES (%s, %s, %s)", 
      GetSQLValueString($nombre_periodos_edl, "text"), 
	  GetSQLValueString($fechaper_desde, "date"),
	  GetSQLValueString($fechaper_hasta, "date")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
		 
    echo '<meta http-equiv="refresh" content="0;URL= ./edl_periodos.jsp" />';
    }
 }

// *************************************************
// actualiza periodo de evaluacion
// *************************************************

if (isset($_POST['actscrgral'])){

	$id_periodos_edl = $_POST['id_periodos_edl4'];
    $nombre_periodos_edl = $_POST['nombre_periodos_edl4'];
    $fechaper_desde = $_POST['fechaper_desde4'];
    $fechaper_hasta = $_POST['fechaper_hasta4'];

    $updateSQL40 = sprintf("UPDATE periodos_edl 
	        SET nombre_periodos_edl = %s,
             fechaper_desde = %s, fechaper_hasta = %s			
			WHERE id_periodos_edl = %s",                  
	GetSQLValueString($nombre_periodos_edl, "text"),
	GetSQLValueString($fechaper_desde, "date"),
	GetSQLValueString($fechaper_hasta, "date"),
	GetSQLValueString($id_periodos_edl, "int"));
    $Result40 = mysql_query($updateSQL40, $conexion) or die(mysql_error());

	echo $hecho;
		 
    echo '<meta http-equiv="refresh" content="0;URL= ./edl_periodos.jsp" />';

} 
 
?>

 

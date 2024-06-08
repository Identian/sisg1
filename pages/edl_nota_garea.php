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

/*   
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

*/

	$query2 = sprintf("SELECT id_periodos_edl, nombre_periodos_edl,
	fechaper_desde, fechaper_hasta, sysdate() hoy 
	FROM periodos_edl 
	WHERE periodo_activo_edl = 1 
	AND estado_periodos_edl = 1"); 
    $select2 = mysql_query($query2, $conexion) or die(mysql_error());
    $row2 = mysql_fetch_assoc($select2);

    $id_periodos_edl = $row2['id_periodos_edl'];
	$nombre_periodo_edl = $row2['nombre_periodos_edl'];
	$fechaper_desde = $row2['fechaper_desde'];
	$fechaper_hasta = $row2['fechaper_hasta'];
    $hoy = $row2['hoy'];


	$query5 = sprintf("SELECT * FROM perfil_activo_edl x
	              left join funcionario y
				  ON (x.id_funcionario = y.id_funcionario 
				     AND y.estado_funcionario = 1)
                  where x.id_funcionario = '$id_funcionario' 
				  and x.estado_perfil_activo_edl = 1 "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){ 
       $id_cargo = $row5['id_cargo'];
	   $nombre_funcionario_log = $row5['nombre_funcionario'];
	   $id_tipo_oficina = $row5['id_tipo_oficina'];
	   $id_grupo_area = $row5['id_grupo_area'];
	   $id_oficina_registro = $row5['id_oficina_registro'];
	   
	   $nombre_perfil_activo_edl = $row5['nombre_perfil_activo_edl'];
	   $tipo_funcionario = $row5['tipo_funcionario'];
	   
   }

	  
} else { 
     echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 


 if ($_SESSION['rol'] == 1) {
	$privi = " ";
    $id= 0;
 }


if (isset($_GET["i"]) && ""!=$_GET["i"]) {
    $id_nota_area_edl = intval($_GET["i"]);

   $query84 = "UPDATE nota_area_edl SET estado_nota_area_edl = 0  WHERE id_nota_area_edl = ".$id_nota_area_edl." limit 1";  
 
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
            <ul class="nav navbar-nav">
              <li style="font-size: 18px; color: black;"><a href="edl_fun.jsp" ><b>NOTAS DEL ÁREA U OFICINA - EDL</b></a></li>
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
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#periodos_edl"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Nota del Área u Oficina</button>&nbsp;
    </div>
  </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  <th>Id Nota</th>
				  <th>Área u Oficina</th>
				  <th>Período Desde</th>
 				  <th>Período Hasta</th>
                  <th>Calificación Área</th>
                  <th>Observación Área</th>
                 <th colspan="4">Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT a.id_nota_area_edl,
			              a.id_periodos_edl, a.id_grupo_area, 
			              a.califi_area, a.observa_area, b.fechaper_desde,
						  b.fechaper_hasta, c.nombre_grupo_area
            			  FROM nota_area_edl a 
						  LEFT JOIN periodos_edl b
						  ON a.id_periodos_edl = b.id_periodos_edl
						  LEFT JOIN grupo_area c 
						  ON a.id_grupo_area = c.id_grupo_area
                          WHERE a.id_periodos_edl = '$id_periodos_edl' 
						  AND estado_nota_area_edl = 1 ");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {

            ?>
          <tr>
		     <?php 
			 $id_nota_area_edl = $row_dian['id_nota_area_edl'];
		     $id_periodos_edl = $row_dian['id_periodos_edl'];
             $id_grupo_area = $row_dian['id_grupo_area'];
             $califi_area = $row_dian['califi_area'];
			 $observa_area = $row_dian['observa_area'];
			 $fechaper_desde = $row_dian['fechaper_desde'];
			 $fechaper_hasta = $row_dian['fechaper_hasta'];
			 $nombre_grupo_area = $row_dian['nombre_grupo_area'];
			 $sw5 = 0;
			
	         ?>
			 <td width = "60px"><?php echo $id_nota_area_edl; ?></td>
             <td style = "display: none"><?php echo $id_periodos_edl; ?></td>
             <td style = "display: none"><?php echo $id_grupo_area; ?></td>
			 <td width = "320px"><?php echo $nombre_grupo_area; ?></td>
             <td width = "90px"><?php echo $fechaper_desde; ?></td>
             <td width = "90px"><?php echo $fechaper_hasta; ?></td>
             <td width = "90px"><?php echo $califi_area; ?></td>
             <td width = "520px"><?php echo $observa_area; ?></td>
			 
        	 <td width = "60px">
				<button type="button" class="btn btn-success btn-xs modifiper" title="Modificación Registro "><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
             </td> 
             <?php if($id_cargo <= 2 or 1==$_SESSION['rol']) { ?>
             <td width = "60px">
                <a href="edl_nota_garea&<?php echo $id_nota_area_edl; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar registro"  ><span class="glyphicon glyphicon-trash"></span></a>
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
// creacion de nota area u oficina
// *************************************
?>

<div class="modal fade"  id="periodos_edl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>NOTA ÁREA U OFICINA - EDL</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4377224"  enctype="multipart/form-data">

    <div id = "funconsul" class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> PERÍODO DE EVALUACIÓN:</label> 
        <select class="form-control" name="id_periodos_edl" id="id_periodos_edl"  >
        <option value="" selected></option>
        <?php echo lista('periodos_edl'); ?>
        </select>
    </div>

    <div id = "funconsul" class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> GRUPO ÁREA:</label> 
        <select class="form-control" name="id_grupo_area" id="id_grupo_area"  >
        <option value="" selected></option>
        <?php echo lista('grupo_area'); ?>
        </select>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">CALIFICACIÓN ÁREA:</label>   
      <input type="number" class="form-control" name="califi_area" id="califi_area" value="" required >
    </div>

    <div class="form-group text-left"> 
       <label  class="control-label"><span style="color:#ff0000;">*</span> OBSERVACIONES AL ÁREA:</label>   
       <textarea rows="5" cols="40" class="form-control" id="observa_area"  name="observa_area" value="" required ></textarea>
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
// MODIFICACION NOTA
// **********************
?>

<div class="modal fade"  id="modiperiodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN NOTA ÁREA</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224"  enctype="multipart/form-data">

    <input type="hidden" name="id_nota_area_edl4" id="id_nota_area_edl4" readonly="readonly" value=""> 
	
    <div id = "funconsul" class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> PERÍODO DE EVALUACIÓN:</label> 
        <select class="form-control" name="id_periodos_edl4" id="id_periodos_edl4"  >
        <option value="" selected></option>
        <?php echo lista('periodos_edl'); ?>
        </select>
    </div>

    <div id = "funconsul" class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> GRUPO ÁREA:</label> 
        <select class="form-control" name="id_grupo_area4" id="id_grupo_area4"  >
        <option value="" selected></option>
        <?php echo lista('grupo_area'); ?>
        </select>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">CALIFICACIÓN ÁREA:</label>   
      <input type="number" class="form-control" name="califi_area4" id="califi_area4" value="" required >
    </div>

    <div class="form-group text-left"> 
       <label  class="control-label"><span style="color:#ff0000;">*</span> OBSERVACIONES AL ÁREA:</label>   
       <textarea rows="5" cols="40" class="form-control" id="observa_area4"  name="observa_area4" value="" required ></textarea>
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
          $('#id_nota_area_edl4').val(data[0]);
		  $('#id_periodos_edl4').val(data[1]);
          $('#id_grupo_area4').val(data[2]);
		  $('#califi_area4').val(data[6]);
		  $('#observa_area4').val(data[7]);
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
	

// Registra nota del area u oficina
// ********************************

if (isset($_POST['creaperiodo'])) {

    $nombre_nota_area_edl = 'NOTA DEL AREA U OFICINA EN EL PERIODO ';
    $id_periodos_edl = $_POST['id_periodos_edl'];
    $id_grupo_area = $_POST['id_grupo_area'];
	$califi_area = $_POST['califi_area'];
	$observa_area = $_POST['observa_area'];

    $query5 = sprintf("SELECT *  
	FROM nota_area_edl 
	WHERE id_periodos_edl = '$id_periodos_edl'  
	AND   id_grupo_area = '$id_grupo_area' 
	AND   estado_nota_area_edl = 1 "); 
$select5 = mysql_query($query5, $conexion);
$row5 = mysql_fetch_assoc($select5);
$totalRows5 = mysql_num_rows($select5);
if ($totalRows5 > 0) { 

echo $repetido; 


} else {

	$insertSQL = sprintf("INSERT INTO nota_area_edl (
      nombre_nota_area_edl, id_periodos_edl, id_grupo_area, 
	  califi_area, observa_area) 
	  VALUES (%s, %s, %s, %s, %s)", 
      GetSQLValueString($nombre_nota_area_edl, "text"), 
	  GetSQLValueString($id_periodos_edl, "int"),
	  GetSQLValueString($id_grupo_area, "int"),
	  GetSQLValueString($califi_area, "text"),
	  GetSQLValueString($observa_area, "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
		 
    echo '<meta http-equiv="refresh" content="0;URL= ./edl_nota_garea.jsp" />';
   }
 }

// *************************************************
// Actualiza nota del area u oficina
// *************************************************

if (isset($_POST['actscrgral'])){
    $id_nota_area_edl = $_POST['id_nota_area_edl4'];
    $id_periodos_edl = $_POST['id_periodos_edl4'];
    $id_grupo_area = $_POST['id_grupo_area4'];
	$califi_area = $_POST['califi_area4'];
	$observa_area = $_POST['observa_area4'];


    $updateSQL40 = sprintf("UPDATE nota_area_edl 
	        SET id_periodos_edl = %s,
             id_grupo_area = %s, califi_area = %s,
             observa_area = %s			 
			WHERE id_nota_area_edl = %s",                  
	GetSQLValueString($id_periodos_edl, "int"),
	GetSQLValueString($id_grupo_area, "int"),
	GetSQLValueString($califi_area, "text"),
	GetSQLValueString($observa_area, "text"),
	GetSQLValueString($id_nota_area_edl, "int"));
    $Result40 = mysql_query($updateSQL40, $conexion) or die(mysql_error());

	echo $hecho;
		 
    echo '<meta http-equiv="refresh" content="0;URL= ./edl_nota_garea.jsp" />';

} 
 
?>

 

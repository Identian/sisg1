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

$nump66=privilegios(66,$_SESSION['snr']);
$nump68=privilegios(68,$_SESSION['snr']);


if (1==$_SESSION['rol'] or (0<$nump66 or 0<$nump68)) {


if (isset($_GET["i"]) && ""!=$_GET["i"]) {
    $id_tasa_mensual_cp = intval($_GET["i"]);

   $query84 = "UPDATE tasa_mensual_cp SET estado_tasa_mensual_cp = 0  WHERE id_tasa_mensual_cp = ".$id_tasa_mensual_cp." limit 1";  
 
   $Result1 = mysql_query($query84, $conexion);

   echo $actualizado;

 } else {
  
 }

// Registra tasa mensual
// ********************************

if (isset($_POST['creatasam'])) {

    $fecha_tasa = $_POST['fecha_tasa'];
    $tasa_mensual = $_POST['tasa_mensual'];
    $nombre_tasa_mensual_cp = 'TASA MENSUAL';
	
    $query5 = sprintf("SELECT *  
	FROM tasa_mensual_cp 
	WHERE fecha_tasa = '$fecha_tasa'  
	AND   estado_tasa_mensual_cp = 1 "); 
$select5 = mysql_query($query5, $conexion);
$row5 = mysql_fetch_assoc($select5);
$totalRows5 = mysql_num_rows($select5);
if ($totalRows5 > 0) { 

echo $repetido; 


} else {
	$insertSQL = sprintf("INSERT INTO tasa_mensual_cp (
      fecha_tasa, nombre_tasa_mensual_cp, tasa_mensual) 
	  VALUES (%s, %s, %s)", 
      GetSQLValueString($fecha_tasa, "date"),
      GetSQLValueString($nombre_tasa_mensual_cp, "text"),	  
	  GetSQLValueString($tasa_mensual, "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
		 
//    echo '<meta http-equiv="refresh" content="0;URL= ./tasa_mensual_cp.jsp" />';
    }
 }

// *************************************************
// actualiza Tasa Mensual
// *************************************************

if (isset($_POST['actscrgral'])){

	$id_tasa_mensual_cp = $_POST['id_tasa_mensual_cp2'];
    $fecha_tasa = $_POST['fecha_tasa2'];
    $tasa_mensual = $_POST['tasa_mensual2'];

    $updateSQL40 = sprintf("UPDATE tasa_mensual_cp 
	        SET fecha_tasa = %s,
            tasa_mensual = %s 			
			WHERE id_tasa_mensual_cp = %s",                  
	GetSQLValueString($fecha_tasa, "date"),
	GetSQLValueString($tasa_mensual, "text"),
	GetSQLValueString($id_tasa_mensual_cp, "int"));
    $Result40 = mysql_query($updateSQL40, $conexion) or die(mysql_error());

	echo $hecho;
		 
//    echo '<meta http-equiv="refresh" content="0;URL= ./tasa_mensual_cp.jsp" />';

} 

 include('tablero_cuotas_partes.php');
 
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
              <li style="font-size: 18px; color: black;"><a href="cuotas_partes.jsp" ><b>TASA MENSUAL - CUOTAS PARTES</b></a></li>
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
    <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
	<div class="col-md-4">
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#periodos_edl"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Tasa</button>&nbsp;
    </div>
	<?php } ?>
  </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_salmin">
           <thead>
                <tr>
                  <th>Id Tasa</th>
				  <th>Fecha Tasa</th>
                  <th>Tasa Mensual</th>
                 <th colspan="4">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT * FROM tasa_mensual_cp
                          WHERE estado_tasa_mensual_cp = 1 order by fecha_tasa desc");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {

            ?>
          <tr>
		     <?php 
		     $id_tasa_mensual_cp = $row_dian['id_tasa_mensual_cp'];
			 $fecha_tasa = $row_dian['fecha_tasa'];
             $tasa_mensual = number_format($row_dian['tasa_mensual'],2);
			 $sw5 = 0;
			
	         ?>
             <td><?php echo $id_tasa_mensual_cp; ?></td>
			 <td><?php echo $fecha_tasa; ?></td>
             <td><?php echo $tasa_mensual; ?></td>
			 <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
        	 <td width = "60px">
				<button type="button" class="btn btn-success btn-xs xmodisal" title="Modificación tasa "><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
              </td> 
             <td width = "60px">
                <a href="tasa_mensual_cp&<?php echo $id_salario_min_cp; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar registro"  ><span class="glyphicon glyphicon-trash"></span></a>
             </td>
			 <?php } ?>
          </tr>

      <?php } ?> <!-- CIERRE PRIMER WHILE -->

          <script>

              $(document).ready(function() {
            $('#tab_salmin').DataTable({
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
// NUEVA TASA
// **********************
?>

<div class="modal fade"  id="periodos_edl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>NUEVA TASA MENSUAL - CUOTA PARTE</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4377224"  enctype="multipart/form-data">

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Tasa:</label>   
      <input type="date" class="form-control" name="fecha_tasa" id="fecha_tasa" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Tasa Mensual:</label>   
      <input type="txt" class="form-control" name="tasa_mensual" id="tasa_mensual" value="" required >
    </div>

    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="creatasam" id="creatasam" value="creatasam">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<?php
// MODIFICACION TASA
// **********************
?>

<div class="modal fade"  id="modisalario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN TASA MENSUAL</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43777224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_tasa_mensual_cp2" id="id_tasa_mensual_cp2" readonly="readonly" value="">
	
    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Tasa:</label>   
      <input type="date" class="form-control" name="fecha_tasa2" id="fecha_tasa2" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Tasa Mensual:</label>   
      <input type="txt" class="form-control" name="tasa_mensual2" id="tasa_mensual2" value="" required >
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
      $('.xmodisal').on('click', function() {          
//      alert("ejecuto msalario...");

          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#modisalario").modal("show");
          $('#id_tasa_mensual_cp2').val(data[0]);
		  $('#fecha_tasa2').val(data[1]);
          $('#tasa_mensual2').val(data[2]);
	   
    });
	 });
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
	
 
} else {
	
}
?>

 

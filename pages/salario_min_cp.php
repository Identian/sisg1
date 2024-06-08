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
    $id_salario_min_cp = intval($_GET["i"]);

   $query84 = "UPDATE salario_min_cp SET estado_salario_min_cp = 0  WHERE id_salario_min_cp = ".$id_salario_min_cp." limit 1";  
 
   $Result1 = mysql_query($query84, $conexion);

   echo $actualizado;

 } else {
  
 }

// Registra salario minimo
// ********************************

if (isset($_POST['creasalmin'])) {

    $anno_sal_min = $_POST['anno_sal_min'];
    $vr_salario_min = $_POST['vr_salario_min'];

    $query5 = sprintf("SELECT *  
	FROM salario_min_cp 
	WHERE anno_sal_min = '$anno_sal_min'  
	AND   estado_salario_min_cp = 1 "); 
$select5 = mysql_query($query5, $conexion);
$row5 = mysql_fetch_assoc($select5);
$totalRows5 = mysql_num_rows($select5);
if ($totalRows5 > 0) { 

echo $repetido; 


} else {
	$insertSQL = sprintf("INSERT INTO salario_min_cp (
      anno_sal_min, vr_salario_min) 
	  VALUES (%s, %s)", 
      GetSQLValueString($anno_sal_min, "number"), 
	  GetSQLValueString($vr_salario_min, "number")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

	echo $hecho;
		 
//    echo '<meta http-equiv="refresh" content="0;URL= ./salario_min_cp.jsp" />';
    }
 }

// *************************************************
// actualiza Salario Minimo
// *************************************************

if (isset($_POST['actscrgral'])){

	$id_salario_min_cp = $_POST['id_salario_min_cp2'];
    $anno_sal_min = $_POST['anno_sal_min2'];
    $vr_salario_min = $_POST['vr_salario_min2'];

    $updateSQL40 = sprintf("UPDATE salario_min_cp 
	        SET anno_sal_min = %s,
            vr_salario_min = %s 			
			WHERE id_salario_min_cp = %s",                  
	GetSQLValueString($anno_sal_min, "number"),
	GetSQLValueString($vr_salario_min, "number"),
	GetSQLValueString($id_salario_min_cp, "int"));
    $Result40 = mysql_query($updateSQL40, $conexion) or die(mysql_error());

	echo $hecho;
		 
//    echo '<meta http-equiv="refresh" content="0;URL= ./salario_min_cp.jsp" />';

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
              <li style="font-size: 18px; color: black;"><a href="cuotas_partes.jsp" ><b>SALARIO MÍNIMO - CUOTA PARTE</b></a></li>
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
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#periodos_edl"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Salario</button>&nbsp;
    </div>
  <?php } ?>	
  </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_salmin">
           <thead>
                <tr>
                  <th>Id Salario</th>
				  <th>Año</th>
                  <th>valor Salario Mínimo</th>
                 <th colspan="4">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT * FROM salario_min_cp
                          WHERE estado_salario_min_cp = 1 order by anno_sal_min desc");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {

            ?>
          <tr>
		     <?php 
			 $id_salario_min_cp = $row_dian['id_salario_min_cp'];
		     $anno_sal_min = $row_dian['anno_sal_min'];
             $vr_salario_min = number_format($row_dian['vr_salario_min'],0);
			 $sw5 = 0;
			
	         ?>
             <td><?php echo $id_salario_min_cp; ?></td>
			 <td><?php echo $anno_sal_min; ?></td>
             <td><?php echo $vr_salario_min; ?></td>
			 <?php if (1==$_SESSION['rol'] or 0<$nump66) { ?>
        	 <td width = "60px">
				<button type="button" class="btn btn-success btn-xs xmodisal" title="Modificación Salario Mínimo "><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
              </td> 
             <td width = "60px">
                <a href="salario_min_cp&<?php echo $id_salario_min_cp; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar registro"  ><span class="glyphicon glyphicon-trash"></span></a>
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
// NUEVO SALARIO MINIMO
// **********************
?>

<div class="modal fade"  id="periodos_edl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>NUEVO SALARIO MÍNIMO - CUOTA PARTE</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4377224"  enctype="multipart/form-data">

    <div class="form-group text-left"> 
      <label  class="control-label">Año (4 dígitos):</label>   
      <input type="number" class="form-control" name="anno_sal_min" id="anno_sal_min" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Valor salario Mínimo:</label>   
      <input type="number" class="form-control" name="vr_salario_min" id="vr_salario_min" value="" required >
    </div>

    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="creasalmin" id="creasalmin" value="creasalmin">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>


<?php
// MODIFICACION SALARIO
// **********************
?>

<div class="modal fade"  id="modisalario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN SALARIO</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43777224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_salario_min_cp2" id="id_salario_min_cp2" readonly="readonly" value="">
	
    <div class="form-group text-left"> 
      <label  class="control-label">Año (4 dígitos):</label>   
      <input type="number" class="form-control" name="anno_sal_min2" id="anno_sal_min2" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Valor salario Mínimo:</label>   
      <input type="number" class="form-control" name="vr_salario_min2" id="vr_salario_min2" value="" required >
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
          $('#id_salario_min_cp2').val(data[0]);
		  $('#anno_sal_min2').val(data[1]);
          $('#vr_salario_min2').val(data[2].replace(/,/g, ""));
	   
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

 

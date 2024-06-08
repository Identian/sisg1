<!DOCTYPE html>
<html lang="es">
<head>

<script>
   $(document).ready(function()
   {
      $("#mostrarmodal").modal("show");
   });
</script>

</head>
<?php


if (isset($_GET['i'])){
	  $id_sucesion = $_GET['i'];
} else { 
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
  }	

/*
  if (($_SESSION['rol'] >= 1 && $_SESSION['rol'] <= 3) && ($_SESSION['snr_tipo_oficina'] == 1 or $_SESSION['snr_tipo_oficina'] == 3)){  
    $id_notaria_f=$_GET['i']; // I = id_notaria
	} else {
    $id= 0;
}
*/


$condi = '=';
if($_SESSION['rol'] == 1 and $_SESSION['snr_tipo_oficina']== 1){
   $condi = '>=';
}

   $query15 = sprintf("SELECT *
	FROM sucesion 
	WHERE id_sucesion = '$id_sucesion' "); 
   $select15 = mysql_query($query15, $conexion) or die(mysql_error());
   $row15 = mysql_fetch_assoc($select15);
   $totalRows15 = mysql_num_rows($select15);
   if ($totalRows15 > 0){
      $numero_acta = $row15['numero_acta'];
	  $fecha_acta = $row15['fecha_acta']; 
      $id_notaria = $row15['id_notaria']; 
      $fecha_inicio = $row15['fecha_inicio'];
   }


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
          <span class="navbar-brand" > &nbsp;  NOTARIA <?php echo quees('notaria', $id_notaria). ' -  MANEJO DE SUCESIONES';?>: </span>
          </div>
		  
          </div>
      </div>
    </nav>
  </div>
</div>
 
 <!-- + ULT -->
 
     <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  <th>Nombre_Notaria</th>
                  <th>ID Sucesi&oacute;n</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                  <th>Num Acta</th>
                  <th>Fecha Acta</th>
                 <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT * FROM sucesion, notaria
                          WHERE notaria.id_notaria = sucesion.id_notaria
						  AND sucesion.id_notaria ".$condi.$id_notaria."
                          AND sucesion.estado_sucesion = 1");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {
            ?>
          <tr>
             <td><?php $iddian=$row_dian['id_notaria'];?><?php echo $row_dian['nombre_notaria'];?></td>
             <td><?php $idsucesion=$row_dian['id_sucesion'];?><?php echo $row_dian['id_sucesion'];?></td>
             <td><?php echo $row_dian['fecha_inicio'];?></td>
             <td><?php echo $row_dian['fecha_reg_terminacion'];?></td>
             <td><?php echo $row_dian['numero_acta'];?></td>
             <td><?php echo $row_dian['fecha_acta'];?></td>
             <td>
                <a href="sucesion_delete&<?php echo $idsucesion; ?>.jsp"><span class="pull-right-container"><small class="label pull-right bg-green">Cargar Actas</small></span></a> &nbsp;
                <a href="sucesion_update&<?php echo $idsucesion; ?>.jsp"><span class="pull-right-container"><small class="label pull-right bg-red">Consultar</small></span></a> &nbsp;
             </td>
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


 
<!-- Modal nuevo -->


<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h3>NUEVO CAUSANTE</h3>
         </div>
         <div class="modal-body">
                   <form action="" method="POST" name="form1" >


                         <input type="hidden" class="form-control" name="id_notaria" id="id_notaria" readonly="readonly" value="<?php echo $id_notaria; ?>">
						 <input type="hidden" class="form-control" name="id_sucesion" id="id_sucesion" readonly="readonly" value="<?php echo $id_sucesion; ?>">
                         <div class="form-group text-left"> 
                              <label  class="control-label">FECHA INICIO:</label>   
                              <input type="text" class="form-control" name="fecha_inicio" readonly="readonly" value="<?php echo $fecha_inicio; ?>">
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label">N&Uacute;MERO ACTA:</label>   
                              <input type="number" class="form-control" name="numero_acta"  readonly="readonly" value="<?php echo $numero_acta; ?>">
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label">FECHA ACTA:</label>   
                              <input type="text" class="form-control" name="fecha_acta" readonly="readonly" value="<?php echo $fecha_acta; ?>">
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label">N&Uacute;MERO DCTO CAUSANTE:</label>   
                              <input type="text" class="form-control" name="num_dcto_causante"  id="num_dcto_causante" value="">
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label">TIPO DE DCTO CAUSANTE:</label>   
                              <select  class="form-control" name="id_tipo_causante" required>
                              <option value="-- TIPO DOCTO --" selected></option>
                              <?php
                              $query = sprintf("SELECT id_tipo_documento, nombre_tipo_documento FROM tipo_documento where estado_tipo_documento=1 order by id_tipo_documento"); 
                              $select = mysql_query($query, $conexion) or die(mysql_error());
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
                         <div class="form-group text-left"> 
                              <label  class="control-label">NOMBRE CAUSANTE:</label>   
                              <input type="text" class="form-control" id="nombre_causante"  name="nombre_causante" value="">
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label">TEL&Eacute;FONO CAUSANTE:</label>   
                              <input type="text" class="form-control" id="tel_causante"  name="tel_causante" value="">
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label">DIRECCI&Oacute;N CAUSANTE:</label>   
                              <input type="text" class="form-control" id="dir_causante"  name="dir_causante" value="">
                         </div>

                         <div class="modal-footer">
                              <button type="submit" class="btn btn-default" data-dismiss="modal" onClick="salidac();" >
							  <input type="hidden" id="salida" name="salida" value="causan">
                              <span class="glyphicon glyphicon-remove"></span>Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="archcausante" value="notaria">
                              <span class="glyphicon glyphicon-ok"></span>Guardar</button>
					     </div>
				   </form>
         </div>
      </div>
   </div>
</div>	  
	  
	  
   <script>
   function valfunreg(){
    var cc_funreg = document.getElementById('cc_funcionario_reg').value;
	
    jQuery.ajax({
    type: "POST",
    url: "pages/valida_cc_fun.php",
    data: 'cc_funreg='+cc_funreg,
    async: true,
      success: function(b) {
//	  alert("valor de b: " + b);
	  document.getElementById('nombre_funcionario_reg').value = b;
	  var sw5 = b.substring(3,9);
	  // alert ("sw5: " + sw5);
	  document.getElementById('nombre_funcionario_reg').style.background='#CCCCCC';
	  document.getElementById('nombre_funcionario_reg').style.color='#424242';
	  if(sw5 == 'EXISTE'){
		document.getElementById('nombre_funcionario_reg').style.color='#CC0000';  
	  }	else{  
	    document.getElementById('nombre_funcionario_reg').style.background='#CCCCCC';
	  }
      document.getElementById('cc_funcionario_reg').focus();	  
      }
    });
   }
  </script>
  
  <script>
    function salidac(){
		alert('entro en salida');
	 <?php 	echo '<meta http-equiv="refresh" content="500;URL= ./sucesion&'.$id_notaria.'.jsp" />'; ?>
	}
  </script>
  
<?php  

if (isset($_POST['salida'])) {
	$id_notaria = $_POST['id_notaria'];
	echo '<meta http-equiv="refresh" content="500;URL= ./sucesion&'.$id_notaria.'.jsp" />';
	 
}	
  
if (isset($_POST['archcausante'])) {
//	$id_funcionario = $row1['id_funcionario'];
	$id_funcionario = $_SESSION['snr'];
	$num_dcto_causante = $_POST['num_dcto_causante'];
	$id_notaria = $_POST['id_notaria'];
	$clave_ciudadano = md5(12345);

    $id_depto = 0;
	$id_municipio = 0;
	$sin_correo = 'sin correo...';

	$query4 = sprintf("SELECT *
	FROM notaria 
	WHERE id_notaria = $id_notaria "); 
    $select4 = mysql_query($query4, $conexion) or die(mysql_error());
    $row4 = mysql_fetch_assoc($select4);
    $totalRows4 = mysql_num_rows($select4);
    if ($totalRows4 > 0){
      $id_depto = $row4['id_departamento'];
	  $id_municipio = $row4['codigo_municipio'];
    }	
	$query5 = sprintf("SELECT *
	FROM ciudadano 
	WHERE identificacion = $num_dcto_causante "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
// $cedula_funcionario = $row['cedula_funcionario'];
// $id_notaria = $row['id_notaria_f'];
if ($totalRows5 > 0){
    $dato = 'existe';
} else{ // no existe

	$insertSQL5 = sprintf("INSERT INTO ciudadano (
        nombre_ciudadano, id_tipo_documento, 
		identificacion, idcorreocontactoiris, id_etnia, 
		correo_ciudadano, clave_ciudadano, telefono_ciudadano, 
		id_departamento, id_municipio, id_tipo_respuesta, 
		direccion_ciudadano, fecha_registro, estado_ciudadano,
		fuente, cfuncionario) 
		VALUES (%s,%s,%s,null,6,%s,%s,%s,%s,%s,4,%s,now(),1,0,0)", 
      GetSQLValueString($_POST["nombre_causante"], "text"), 
      GetSQLValueString($_POST["id_tipo_causante"], "date"),  
      GetSQLValueString($_POST["num_dcto_causante"], "text"),
	  GetSQLValueString($sin_correo, "date"),
	  GetSQLValueString($clave_ciudadano, "text"),
	  GetSQLValueString($_POST["tel_causante"], "date"),
	  GetSQLValueString($id_depto, "text"),
	  GetSQLValueString($id_municipio, "text"),
	  GetSQLValueString($_POST["dir_causante"], "text")); 
      $Result = mysql_query($insertSQL5, $conexion) or die(mysql_error());
	
	
}

if(isset($_GET['i']) && ($_SESSION['rol'] == 1)){
  $id_notaria = $_GET['i'];	
}	

$id_sucesion = $_POST["id_sucesion"];
$query5 = sprintf("SELECT *
	FROM causante 
	WHERE num_dcto_causante = '$num_dcto_causante' 
	AND   id_sucesion = '$id_sucesion'
	AND   estado_causante = 1 "); 
$select5 = mysql_query($query5, $conexion) or die(mysql_error());
$row5 = mysql_fetch_assoc($select5);
$totalRows5 = mysql_num_rows($select5);
if ($id_notaria > 0 && $totalRows5 > 0){ echo $repetido; ?>
  <!--	<script> alert('Sucesión Ya Existe...!'); </script> -->
<?php 

  echo '<meta http-equiv="refresh" content="500;URL= ./causante&'.$id_sucesion.'.jsp" />';

} else{

	$insertSQL = sprintf("INSERT INTO causante (
        id_sucesion, num_dcto_causante, 
		estado_causante, fecha_registro) 
		VALUES (%s,%s,1,now())", 
      GetSQLValueString($id_sucesion, "int"), 
      GetSQLValueString($_POST["num_dcto_causante"], "text"),  
      GetSQLValueString($_POST["numero_acta"], "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());


echo '<meta http-equiv="refresh" content="0;URL= ./causante&'.$id_sucesion.'.jsp" />';

// mysql_free_result($Result);	
}	
}

 ?>
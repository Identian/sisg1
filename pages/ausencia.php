<?php

$id_funcionario = 0;
$cedula_funcionario = 0;

if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {
	//  $id_funcionario = $_SESSION['snr'];
	  $id_funcionario = 5;
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
<!--          <span class="navbar-brand" > &nbsp;  AUSENCIA <?php // echo quees('notaria', $id_notaria). ' -  SUCESIONES';?>: </span> -->
          </div>
<!--          <div id="navbar" class="navbar-collapse collapse"> -->
<!--          <ul class="nav navbar-nav">
           	<li <?php // if ('notaria_dian'==$_GET['q']) { echo 'class="active"'; } else {} ?>><a style="color:#000;" href="notaria_dian.jsp">Reporte DIAN</a></li>
            <li <?php // if ('notaria_dian'==$_GET['q']) { echo 'class="active"'; } else {} ?>><a href="sucesiones.jsp">Sucesiones</a></li>

            <li><a href="#">Interdictos</a></li>
			<li><a href="#">Testamentos</a></li>
			<li><a href="#">Fallecidos Extranjeros</a></li>
            <li><a href="#">Permisos y licencias</a></li>
            <li><a href="#">Situaciones administrativas</a></li>
          </ul> -->
		  
          </div>
      </div>
    </nav>
  </div>
</div>

	  
	  
	  
<div class="row">
<div class="col-md-12">

 <div class="box box-info">
  <div class="box-header with-border">
  
  <?php 
  
//  if ((3==$_SESSION['snr_tipo_oficina'] and isset($_SESSION['id_vigilado']) and 1==$_SESSION['snr_grupo_cargo']) or 1==$_SESSION['rol']) { 
      // 3 = NOTARIA
/* if (($_SESSION['rol'] >= 1 and $_SESSION['rol'] <= 3) and ($_SESSION['snr_tipo_oficina'] == 1 or $_SESSION['snr_tipo_oficina'] == 3)){  */
  ?>
       <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Solicitud</button>&nbsp;


  <?php //} else {} ?>
	
	 
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  <th>Tipo Ausencia</th>
                  <th>Nombre Funcionario</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                  <th>Hora Inicio</th>
                  <th>Hora Final</th>
                  <th>Total Días</th>
                  <th>Total Horas</th>
                  <th>Estado</th>
                 <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT * FROM ausencia a, funcionario b, tipo_permiso c, aprobacion_permiso d
                          WHERE a.id_funcionario = b.id_funcionario
						  AND a.id_tipo_permiso = c.id_tipo_permiso
						  AND a.id_aprobacion_permiso = d.id_aprobacion_permiso
						  AND a.id_funcionario = '$id_funcionario' 
                          AND a.estado_ausencia = 1 order by a.id_tipo_permiso ");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {
				  
            ?>
          <tr>
		     <?php $id_ausencia = $row_dian['id_ausencia'];?>
             <td><?php echo $row_dian['nombre_tipo_permiso'];?></td>
             <td><?php echo $row_dian['nombre_funcionario'];?></td>
             <td><?php echo $row_dian['fecha_inicio'];?></td>
             <td><?php echo $row_dian['fecha_final'];?></td>
             <td><?php echo $row_dian['hora_inicio'];?></td>
             <td><?php echo $row_dian['hora_final'];?></td>
             <td><?php echo $row_dian['num_dias'];?></td>
             <td><?php echo $row_dian['num_horas'];?></td>
             <td><?php echo $row_dian['nombre_aprobacion_permiso'];?></td>
             <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalmodi"><span class="glyphicon glyphicon-plus-sign"></span> Modificar</button>&nbsp;</td>         
             <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalevi"><span class="glyphicon glyphicon-plus-sign"></span> Evidencias</button>&nbsp;</td>         

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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>REGISTRO SOLICITUD DE AUSENTISMO</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                   <form action="" method="POST" name="form1" >
				         <input type="hidden" name="id_funcionario" id="id_funcionario"   value="<?php echo $id_funcionario; ?>" onChange = "mfaltandatos();" required >
                         <div class="form-group text-left"> 
                              <label  class="control-label"> Tipo de Ausentismo:</label> 
                              <select class="form-control" name="id_tipo_permiso" id="id_tipo_permiso">
                              <option value="" selected></option>
                              <?php echo lista('tipo_permiso'); ?>
                              </select>
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"> Jefe que Aprueba:</label> 
                              <select class="form-control" name="id_funcionario_jefe" id="id_funcionario_jefe">
                              <option value="" selected></option>
                              <?php echo lista('funcionario'); ?>
                              </select>
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"> Funcionario que lo Reemplaza:</label> 
                              <select class="form-control" name="id_funcionario_reempla" id="id_funcionario_reempla">
                              <option value="" selected></option>
                              <?php echo lista('funcionario'); ?>
                              </select>
                         </div>

                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"></i>Fecha Inicio:</label>   
                              <input type="text" class="form-control datepickerjo" name="fecha_inicio" readonly="readonly" value="" required >
                         </div>
                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"></i>Fecha Final:</label>   
                              <input type="text" class="form-control datepickerjo" name="fecha_final" readonly="readonly" value="" onChange = "mismodia();" required >
                         </div>
                         <div class="form-group text-left" style="display:none;"> 
                              <label  class="control-label">Hora Desde:</label>   
                              <input type="time" class="form-control" name="hora_inicio"   value="" required >
                         </div>
                         <div class="form-group text-left" style="display:none;"> 
                              <label  class="control-label">Hora Hasta:</label>   
                              <input type="time" class="form-control" name="hora_final"   value="" required >
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label">Motivo del Ausentismo:</label>   
                              <textarea rows="5" cols="40" class="form-control" id="motivo_permiso"  name="motivo_permiso" value="" required ></textarea>
                         </div>
        
                		 <div class="modal-footer">
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="archsucesion" value="notaria">
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
function mfaltandatos(){
    alert('Faltan fechas por reportar....!!!');
//	   $("#myModal").modal("show");
	var x = document.getElementById('fecha_inicio').value;
	var y = document.getElementById('fecha_acta').value;
	var z = document.getElementById('fecha_reg_creacion').value;
	
    if(x.length < 2 or y.length < 2 or z.length < 2){
		alert('Faltan fechas por reportar....!!!');
		return false;
   }
 }
</script>   
  
<?php  

if (isset($_POST['archsucesion'])) {
//	$id_funcionario = $row1['id_funcionario'];
    $id_notaria = $_POST['id_notaria'];
	$id_funcionario = $_SESSION['snr'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_acta = $_POST['fecha_acta'];
	$fecha_reg_creacion = $_POST['fecha_reg_creacion'];
	$tfecha_inicio = strlen($_POST['fecha_inicio']);
	$tfecha_acta = strlen($_POST['fecha_acta']);
	$tfecha_reg_creacion = strlen($_POST['fecha_reg_creacion']);
	
	if($tfecha_inicio < 2 || $tfecha_acta < 2 || $tfecha_reg_creacion < 2){
//		echo 'hola';
//		echo '<script>mfaltandatos();</script>';
//		echo "<script>";
//		echo "mfaltandatos();";
//		echo "</script>";
        echo $faltandatos;
	} else {
	
	$cedula_funcionario = 'sin cedula ';
	$query = sprintf("SELECT cedula_funcionario, id_notaria_f
	FROM funcionario 
	WHERE id_funcionario = $id_funcionario "); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
// $cedula_funcionario = $row['cedula_funcionario'];
// $id_notaria = $row['id_notaria_f'];
if ($totalRows > 0){
    
	$id_notaria = $row['id_notaria_f'];

	$query5 = sprintf("SELECT * FROM posesion_notaria, funcionario, tipo_nombramiento_n 
                  where id_cargo = 1 
				  and posesion_notaria.id_funcionario = funcionario.id_funcionario 
				  and posesion_notaria.id_tipo_nombramiento_n = tipo_nombramiento_n.id_tipo_nombramiento_n 
				  and id_notaria= '$id_notaria' and estado_funcionario = 1 
				  and estado_posesion_notaria=1 
				  order by fecha_inicio desc "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){
       $cedula_funcionario = $row5['cedula_funcionario'];
   }

}

                 
$numero_acta = $_POST["numero_acta"];
$fecha_acta = $_POST["fecha_acta"];
$query5 = sprintf("SELECT *
	FROM sucesion 
	WHERE id_notaria = '$id_notaria' 
	AND   numero_acta = '$numero_acta'
	AND   fecha_acta = '$fecha_acta'
	AND   estado_sucesion = 1 "); 
$select5 = mysql_query($query5, $conexion) or die(mysql_error());
$row5 = mysql_fetch_assoc($select5);
$totalRows5 = mysql_num_rows($select5);
if ($id_notaria > 0 && $totalRows5 > 0){ echo $repetido; ?>
	<!-- <script> alert('Sucesión Ya Existe...!'); </script> -->
<?php 

  echo '<meta http-equiv="refresh" content="500;URL= ./sucesion&'.$id_notaria.'.jsp" />';

} else{

	$insertSQL = sprintf("INSERT INTO sucesion (
        id_notaria, id_tsucesion, 
		fecha_inicio, numero_acta, fecha_acta, 
		id_estado_sucesion, cc_funcionario_reg, id_causa_terminacion, 
		fecha_reg_creacion, fecha_reg_terminacion, cc_funcionario_notario, 
		id_tipodcto_terminacion, num_causantes, estado_sucesion, fecha_registro) 
		VALUES (%s,0,%s,%s,%s,1,%s,null,%s,null,%s,null,%s,1,now())", 
      GetSQLValueString($id_notaria, "int"), 
      GetSQLValueString($_POST["fecha_inicio"], "date"),  
      GetSQLValueString($_POST["numero_acta"], "text"),
	  GetSQLValueString($_POST["fecha_acta"], "date"),
	  GetSQLValueString($_POST["cc_funcionario_reg"], "text"),
	  GetSQLValueString($_POST["fecha_reg_creacion"], "date"),
	  GetSQLValueString($cedula_funcionario, "text"),
	  GetSQLValueString($_POST["num_causantes"], "int")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

   $id_sucesion = 0;
   $query12 = sprintf("SELECT *
	FROM sucesion 
	WHERE id_notaria = '$id_notaria' 
	AND   numero_acta = '$numero_acta'
	AND   estado_sucesion = 1 "); 
   $select12 = mysql_query($query12, $conexion) or die(mysql_error());
   $row12 = mysql_fetch_assoc($select12);
   $totalRows12 = mysql_num_rows($select12);
   if ($totalRows12 > 0){
      $id_sucesion = $row12['id_sucesion'];
   }
}
 echo '<meta http-equiv="refresh" content="0;URL= ./sucesion&'.$id_notaria.'.jsp" />';

// echo '<meta http-equiv="refresh" content="0;URL= ./causante&'.$id_sucesion.'.jsp" />';

// mysql_free_result($Result);	
 }	
}

 ?>
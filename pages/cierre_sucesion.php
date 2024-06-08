<!DOCTYPE html>
<html lang="es">
<head>
<script>
   $(document).ready(function()
   {
    id_sucesion = document.getElementById('id_sucesion').value;
	jQuery.ajax({
    type: "POST",
    url: "pages/valida_ncausantes.php",
    data: 'id_sucesion='+id_sucesion,
    async: true,
      success: function(b) {
	  if(b == 10){
		  $("#finsucesion").modal("show");
	  }	else{  
	    alert ("PENDIENTE REPORTAR CAUSANTES ...!!! ");
		javascript:window.history.back();
	  } 
      }
    });

   });
</script>

</head>


<?php
if (isset($_GET['i'])) {
	$id_sucesion=$_GET['i'];
	
$query4 = sprintf("SELECT fecha_inicio, numero_acta, fecha_acta, 
fecha_reg_creacion, cc_funcionario_reg, num_causantes,
id_estado_sucesion, num_dcto_terminacion, fecha_reg_terminacion,
id_causa_terminacion, id_tipodcto_terminacion
   FROM sucesion 
WHERE id_sucesion='$id_sucesion' limit 1"); 
$select4 = mysql_query($query4, $conexion) or die(mysql_error());
$row4 = mysql_fetch_assoc($select4);
$totalRows4 = mysql_num_rows($select4);
	
if ($totalRows4 > 0) { // sino existe se sale
	
    $fecha_inicio = $row4['fecha_inicio'];
	$numero_acta = $row4['numero_acta'];
	$fecha_acta = $row4['fecha_acta'];
	$fecha_reg_creacion = $row4['fecha_reg_creacion'];
	$cc_funcionario_reg = $row4['cc_funcionario_reg'];
	$num_causantes = $row4['num_causantes'];
	$num_dcto_terminacion = $row4['num_dcto_terminacion'];
	$fecha_reg_terminacion = $row4['fecha_reg_terminacion'];
	$id_causa_terminacion = $row4['id_causa_terminacion'];
	$id_tipodcto_terminacion = $row4['id_tipodcto_terminacion'];
	$id_estado_sucesion = $row4['id_estado_sucesion'];
	$des_estado_sucesion = 'ABIERTA';
    if ($id_estado_sucesion == 2){
		$des_estado_sucesion = 'TERMINADA';
	}
    $nombre_funcionario = ' ';

    $query6 = sprintf("SELECT * FROM funcionario 
    WHERE cedula_funcionario = '$cc_funcionario_reg' limit 1"); 
    $select6 = mysql_query($query6, $conexion) or die(mysql_error());
    $row6 = mysql_fetch_assoc($select6);
    $totalRows6 = mysql_num_rows($select6);
	
    if ($totalRows6 > 0) {
       $nombre_funcionario = $row6['nombre_funcionario'];
    }

    $query6 = sprintf("SELECT * FROM funcionario 
    WHERE cedula_funcionario = '$cc_funcionario_reg' limit 1"); 
    $select6 = mysql_query($query6, $conexion) or die(mysql_error());
    $row6 = mysql_fetch_assoc($select6);
    $totalRows6 = mysql_num_rows($select6);
	
    if ($totalRows6 > 0) {
       $nombre_funcionario = $row6['nombre_funcionario'];
    }

    $des_causa_terminacion = ' ';

    $query61 = sprintf("SELECT * FROM causa_terminacion 
    WHERE id_causa_terminacion = '$id_causa_terminacion' limit 1"); 
    $select61 = mysql_query($query61, $conexion) or die(mysql_error());
    $row61 = mysql_fetch_assoc($select61);
    $totalRows61 = mysql_num_rows($select61);
	
    if ($totalRows61 > 0) {
       $des_causa_terminacion = $row61['des_causa_terminacion'];
    }

    $des_tipodcto_terminacion = ' ';

    $query62 = sprintf("SELECT * FROM tipodcto_terminacion 
    WHERE id_tipodcto_terminacion = '$id_tipodcto_terminacion' limit 1"); 
    $select62 = mysql_query($query62, $conexion) or die(mysql_error());
    $row62 = mysql_fetch_assoc($select62);
    $totalRows62 = mysql_num_rows($select62);
	
    if ($totalRows62 > 0) {
       $des_tipodcto_terminacion = $row62['des_tipodcto_terminacion'];
    }

} else {
	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';
}
}
?>



  <!-- 
      *******************
      Boton de Modificar 
      ******************* -->	  
		

<div class="row">
    <div class="col-md-12">
		<div class="row">
          <div class="box  box-info">
             <div class="box-header with-border">
             <?php  if (isset($_GET['i'])) { ?>
			 <div class="row-md-6 text-left">
             <h3 class="box-title">SUCESI&Oacute;N</h3> &nbsp; &nbsp; 
             </div>
             <input type="hidden" class="form-control" name="tot_causantes" id="tot_causantes" readonly="readonly" value="">

			 <div class="row-md-6 text-right">
			 </div>
			 <!-- Modal -->

<div class="modal fade" id="finsucesion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">CIERRE SUCESI&Oacute;N: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="form1224">
    <input type="hidden" class="form-control" name="id_notaria" id="id_notaria" readonly="readonly" value="<?php echo $id_notaria; ?>">
	<input type="hidden" class="form-control" name="id_sucesion" id="id_sucesion" readonly="readonly" value="<?php echo $id_sucesion; ?>">
    <input type="hidden" class="form-control" name="tot_causantes" id="tot_causantes" readonly="readonly" value="">
    <div class="form-group text-left"> 
      <label  class="control-label">FECHA INICIO:</label>   
      <input type="text" class="form-control" name="fecha_inicio" readonly="readonly" value="<?php echo $fecha_inicio; ?>">
    </div>
    <div class="form-group text-left"> 
      <label  class="control-label">N&Uacute;MERO ACTA:</label>   
      <input type="number" class="form-control" name="numero_acta"  readonly="readonly" value="<?php echo $numero_acta; ?>">
    </div>
    <div class="form-group text-left"> 
      <label  class="control-label">NOMBRE FUNCIONARIO QUE REGISTRA:</label>   
      <input type="text" class="form-control red-text" id="nombre_causante"  name="nombre_causante" readonly="readonly" value="<?php echo $nombre_funcionario; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA ACTA:</label>   
      <input type="text" class="form-control" name="fecha_acta" readonly="readonly" value="<?php echo $fecha_acta; ?>">
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label">NUM DOCTO TERMINACI&Oacute;N:</label>   
        <input type="text" class="form-control" id="num_dcto_terminacion"  name="num_dcto_terminacion"  value="<?php echo $num_dcto_terminacion; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA TERMINACI&Oacute;N:</label>   
      <input type="text" class="form-control  datepickerjo" id="fecha_reg_terminacion" name="fecha_reg_terminacion" readonly="readonly" value="<?php echo $fecha_reg_terminacion; ?>">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">CAUSANTE DE TERMINACI&Oacute;N:</label><?php echo ' '.$des_causa_terminacion; ?>   
      <select  class="form-control" name="id_causa_terminacion" required>
        <option value=" - causa --" selected></option>
        <?php
         $query = sprintf("SELECT *  
		 FROM causa_terminacion 
		 order by id_causa_terminacion"); 
         $select = mysql_query($query, $conexion) or die(mysql_error());
         $row = mysql_fetch_assoc($select);
         $totalRows = mysql_num_rows($select);
         if (0<$totalRows){
            do {
	            echo '<option value="'.$row['id_causa_terminacion'].'">'.$row['des_causa_terminacion'].'</option>';
	        } while ($row = mysql_fetch_assoc($select)); 
         } else {}	 
         mysql_free_result($select);
         ?>
      </select>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">TIPO DOCTO DE TERMINACI&Oacute;N:</label><?php echo ' '.$des_tipodcto_terminacion; ?>   
      <select  class="form-control" name="id_tipodcto_terminacion" required>
        <option value=" -- tipo docto --" selected></option>
        <?php
         $query = sprintf("SELECT *  
		 FROM tipodcto_terminacion 
		 order by id_tipodcto_terminacion"); 
         $select = mysql_query($query, $conexion) or die(mysql_error());
         $row = mysql_fetch_assoc($select);
         $totalRows = mysql_num_rows($select);
         if (0<$totalRows){
            do {
	            echo '<option value="'.$row['id_tipodcto_terminacion'].'">'.$row['des_tipodcto_terminacion'].'</option>';
	        } while ($row = mysql_fetch_assoc($select)); 
         } else {}	 
         mysql_free_result($select);
         ?>
      </select>
    </div>

    <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="termsucesion" value="cierresu">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>
                  
             </div>
          </div> 

          <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group text-left"> 
                       <label  class="control-label">FECHA DE INICIO:</label>   
                       <?php echo $fecha_inicio ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">N&Uacute;MERO ACTA:</label>   
                        <?php echo $numero_acta; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA ACTA:</label>   
                        <?php echo $fecha_acta; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA CREACI&Oacute;N:</label>   
                        <?php echo $fecha_reg_creacion; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FUNCIONARIO QUE REPORTA:</label>   
                        <?php echo $nombre_funcionario; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">ESTADO SUCESI&Oacute;N:</label>   
                        <span style= 'color: red;'><?php echo $des_estado_sucesion; ?></span>
                  </div>
				</div>  
                <div class="col-md-6">
                  <div class="form-group text-left"> 
                       <label  class="control-label">N&Uacute;MERO DE CAUSANTES:</label>   
                       <?php echo $num_causantes; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA TERMINACI&Oacute;N:</label>   
                        <?php echo $fecha_reg_terminacion; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">NUM DOCTO TERMINACI&Oacute;N:</label>   
                        <?php echo $num_dcto_terminacion; ?>
                  </div>
                  <div class="form-group text-left"> 
                       <label  class="control-label">CAUSA TERMINACI&Oacute;N:</label>   
                       <?php echo $des_causa_terminacion; ?>
                  </div>
                  <div class="form-group text-left"> 
                       <label  class="control-label">TIPO DOCTO TERMINACI&Oacute;N:</label>   
                       <?php echo $des_tipodcto_terminacion; ?>
                  </div>
                </div>
                </div>
            </div>
          </div>
	    </div>
			
		<div class="row">
			<div class="col-md-12">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4><b>CAUSANTES</b></h4> 
                       <div class="text-right"> 
                      <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
               </div>
  
            <div class="box-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
                <thead>
                <tr>
                  <th>ID Sucesi&oacute;n</th>
                  <th>Num Acta</th>
                  <th>Fecha Acta</th>
                  <th>ID Causante</th>
                  <th>Num Documento</th>
                  <th>Nombre Causante</th>
                </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT id_causante, id_sucesion, num_dcto_causante,
                nombre_ciudadano
	            FROM causante 
	            LEFT JOIN ciudadano
	            On causante.num_dcto_causante = ciudadano.identificacion
                WHERE id_sucesion = '$id_sucesion' 
	            AND causante.estado_causante = 1"); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	  
            ?>
          <tr>
             <td><?php $idsucesion=$row62['id_sucesion'];?><?php echo $row62['id_sucesion'];?></td>
             <td><?php echo $numero_acta;?></td>
             <td><?php echo $fecha_acta;?></td>
             <td><?php $idcausante=$row62['id_causante'];?><?php echo $row62['id_causante'];?></td>
             <td><?php echo $row62['num_dcto_causante'];?></td>
             <td><?php echo $row62['nombre_ciudadano'];?></td>
          </tr>

		  <?php } ?>
		  
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
if ((isset($_POST["termsucesion"])) && ($_POST["termsucesion"] == "cierresu")) { 
   
   $id_sucesion=$_POST['id_sucesion'];
   
   $query_update20 = sprintf("SELECT * 
   FROM sucesion 
   WHERE id_sucesion = %s 
   and estado_sucesion = 1 ", GetSQLValueString($id_sucesion, "int"));
   $update20 = mysql_query($query_update20, $conexion) or die(mysql_error());
   $row_update20 = mysql_fetch_assoc($update20);
   $totRows20 = mysql_num_rows($update20);
   if ($totRows20 == 0) {
     echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';	 
   }			   
    $id_estado_sucesion = 2;
    $updateSQL37 = sprintf("UPDATE sucesion SET num_dcto_terminacion = %s, fecha_reg_terminacion = %s, 
                       id_causa_terminacion = %s, id_tipodcto_terminacion = %s,
                       id_estado_sucesion = %s					   
					   WHERE id_sucesion = %s",                  
					  GetSQLValueString($_POST["num_dcto_terminacion"], "text"),
					  GetSQLValueString($_POST["fecha_reg_terminacion"], "date"),
					  GetSQLValueString($_POST["id_causa_terminacion"], "int"),
					  GetSQLValueString($_POST["id_tipodcto_terminacion"], "int"),
					   GetSQLValueString($id_estado_sucesion, "int"),
					  GetSQLValueString($id_sucesion, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

    echo $hecho;
    echo '<meta http-equiv="refresh" content="0;URL= ./consulta_sucesion&'.$id_sucesion.'.jsp" />';

}	   
?>

<!-- antes visualiza sucesion -->

</div>					  
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
	
	<?php
}  else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }
	?>

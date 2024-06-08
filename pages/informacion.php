<?php

if (isset($_POST['nombre_control_reunion'])) {
	
	$insertSQL = sprintf("INSERT INTO control_reunion (
      id_funcionario, nota_transd, fecha_control_reunion, nombre_control_reunion,  estado_control_reunion) 
	  VALUES (%s, %s, now(), %s, %s)", 
      GetSQLValueString($_SESSION['snr'], "int"), 
	   GetSQLValueString($_POST['nota_transd'], "int"),
	  GetSQLValueString($_POST['nombre_control_reunion'], "text"),
	   GetSQLValueString(1, "int")
	  ); 
      $Result = mysql_query($insertSQL, $conexion);

echo $insertado;


}
 else { }


?>
 
 

	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
<div class="col-md-12">
<h3  class="box-title">
Solicitud de información
</h3>
</div>
</div> 
    <div class="box-body">
      <div class="table-responsive">
	  <?php
	  if (isset($_POST['nombre_control_reunion'])) {
echo 'Gracias..';
	  } else { 
 ?>
	  
<form action="" method="POST" name="for54354r6rtert5354645345464324324563m1" >

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">* Ayudanos a mejorar.</span><br>
De 1 a 5, que tanto considera que la transformación digital ha mejorado el servicio público notarial:</label> <br>
1<input type="radio" name="nota_transd" value="1" required> &nbsp;  &nbsp;  &nbsp; 
2<input type="radio" name="nota_transd" value="2" required> &nbsp;  &nbsp;  &nbsp; 
3<input type="radio" name="nota_transd" value="3" required> &nbsp;  &nbsp;  &nbsp; 
4<input type="radio" name="nota_transd" value="4" required> &nbsp;  &nbsp;  &nbsp; 
5<input type="radio" name="nota_transd" value="5" required> &nbsp;  &nbsp;  &nbsp; 

</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">* Ayudanos a mejorar.</span><br> 
¿Que efectos o beneficios ha percibido en la SNR o en las Notarias generados por la transformación digital?:</label> 
<textarea class="form-control"  name="nombre_control_reunion" required placeholder="Respuesta obligatoria" >
</textarea>
</div>
<div class="modal-footer"><button type="reset" class="btn btn-default" onClick="location.reload()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success desaparecerboton">
<input type="hidden" name="table">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>
</form>
		<?php 
 }
?> 
	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->






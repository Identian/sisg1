
// Muestra los registros en detalle y por cada uno tiene la opción de Modificarlos y es el boton que 
// sigue a continuación


<td>
   <button type="button" class="btn btn-primary btn-xs editbtn" title="Modificar Medición"><span  class="glyphicon glyphicon-hand-up"></span></button>&nbsp;
</td>




<div class="modal fade"  id="modiausen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>TEMPERATURA FUNCIONARIO</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224">

    <input type="hidden" class="form-control" name="id_temperatura_snr" id="id_temperatura_snr" readonly="readonly" value="">

	
    <div class="form-group text-left"> 
      <label  class="control-label">Funcionario:</label>   
      <input type="text" class="form-control" name="nombre_funcionario" id="nombre_funcionario" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Medición:</label>   
      <input type="date" class="form-control" name="fecha_medicion" id="fecha_medicion" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Hora Medición:</label>   
      <input type="time" class="form-control" name="hora_medicion" id="hora_medicion"  value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Temperatura:</label>   
      <input type="text" class="form-control text-left" name="vr_temperatura" id="vr_temperatura" value="">
    </div>

    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actempe" value="actempe">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>




<script>
     $(document).ready(function() {
      $('.editbtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#modiausen").modal("show");
          $('#id_temperatura_snr').val(data[0]);
          $('#nombre_tipo_oficina').val(data[1]);
          $('#area').val(data[2]);
          $('#nombre_funcionario').val(data[3]);
          $('#fecha_medicion').val(data[4]);
		  $('#hora_medicion').val(data[5]);
		  $('#vr_temperatura').val(data[6]);
      });  
    });

</script>
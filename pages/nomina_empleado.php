<?php

?>

<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  

<div  class="modal-body"><form action="" method="POST" name="form1" onsubmit="return validate();">
<div class="form-group text-left"> 
<label  class="control-label">USUARIO:</label> 

<input type="text" readonly="readonly" class="form-control" VALUE="<?php echo quees('funcionario',$_GET['i']); ?>"   >
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE INICIO:</label> 
<input type="text" readonly="readonly" class="form-control datepicker" name="fecha_inicio_n"   >
</div>
<div class="form-group text-left"> 
<label  class="control-label">FECHA DE FIN:</label> 
<input type="text" readonly="readonly" class="form-control datepicker" name="fecha_fin_n"   >
</div>
<div class="form-group text-left"> 
<label  class="control-label">SALARIO BASICO:</label> 
<input type="text" class="form-control" name="salario_basico"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">DIAS LIQUIDADOS:</label> 
<input type="text" class="form-control" name="dias_liquidados"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">SALARIO DEVENGADO:</label> 
<input type="text" class="form-control" name="salario_devengado"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">HORAS EXTRAS:</label> 
<input type="text" class="form-control" name="horas_extras"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">RECARGOS:</label> 
<input type="text" class="form-control" name="recargos"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">AUXILIO DE TRANSPORTE:</label> 
<input type="text" class="form-control" name="auxilio_transporte"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">TOTAL DEVENGADO:</label> 
<input type="text" class="form-control" name="total_devengado"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">SALUD:</label> 
<input type="text" class="form-control" name="salud"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">PENSION:</label> 
<input type="text" class="form-control" name="pension"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">FONDO PENSIONAL:</label> 
<input type="text" class="form-control" name="fondo_pensional"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">RETENCION:</label> 
<input type="text" class="form-control" name="retencion"  >
</div>
<div class="form-group text-left"> 
<label  class="control-label">OTRAS DEDUCCIONES:</label> 
<input type="text" class="form-control" name="otras_deducciones"  >
</div>


<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success"><input type="hidden" name="table" value="nomina_funcionario"><span class="glyphicon glyphicon-ok"></span>
 Crear </button></div></form></div>
 
 </div>
 </div>
 </div>
 </div>

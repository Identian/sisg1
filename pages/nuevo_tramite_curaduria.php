<?php
	$nump144 = privilegios(144, $_SESSION['snr']);
	
if (isset($_GET['i']) and (1==$_SESSION['rol'] or 0<$nump144) and 1==2) {
	$id=$_GET['i'];
	

	

	
	
if (1==$_SESSION['rol'] or 0<$nump144) {

$query = sprintf("SELECT * FROM curaduria, situacion_curaduria, funcionario where situacion_curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria=situacion_curaduria.id_curaduria AND (situacion_curaduria.fecha_terminacion IS NULL OR situacion_curaduria.fecha_terminacion>='$realdate') and curaduria.id_curaduria=".$id." limit 1"); 


} 
else {
	
$idfun=intval($_SESSION['snr']);
$query = sprintf("SELECT * FROM curaduria, funcionario, situacion_curaduria where  funcionario.id_funcionario=".$idfun." and situacion_curaduria.fecha_terminacion>='$realdate'  and curaduria.id_curaduria=situacion_curaduria.id_curaduria and funcionario.id_funcionario=situacion_curaduria.id_funcionario and curaduria.id_curaduria=".$id." limit 1"); 

}

	
$select = mysql_query($query, $conexion);
$row1 = mysql_fetch_assoc($select);
$tota = mysql_num_rows($select);
if (0<$tota) {
	
$name = $row1['nombre_curaduria'];
$dep = $row1['departamento_curaduria'];
$ciudad = $row1['ciudad_curaduria'];
$tele = $row1['telefono_curaduria'];
$celu = $row1['celular_curaduria'];
$dire = $row1['direccion_curaduria'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];
$correo_curaduria= $row1['correo_curaduria'];
$ncuraduria=$row1['numero_curaduria'];

$funcionarioreal=$row1['nombre_funcionario'];
$idfuncionarioreal=$row1['id_funcionario'];




if ((isset($_POST['table'])) && ($_POST['table'] == "licencia_curaduria")) { 

$identificador=$_POST["normalizacion_curaduria"].$_POST["ano_licencia"].'-'.$_POST["nombre_licencia_curaduria"];

$actualizar56 = mysql_query("SELECT nombre_licencia_curaduria FROM licencia_curaduria WHERE id_curaduria=".$id." and nombre_licencia_curaduria='$identificador' and estado_licencia_curaduria=1", $conexion);
$row156 = mysql_fetch_assoc($actualizar56);
$total556 = mysql_num_rows($actualizar56);
if (0<$total556) {
	echo $repetido;
} else {







$fecha_radicacion=date('Y-m-d', strtotime($_POST["fecha_radicacion"]));
$fecha_expedicion=date('Y-m-d', strtotime($_POST["fecha_expedicion"]));
$fecha_ejecutoria=date('Y-m-d', strtotime($_POST["fecha_ejecutoria"]));

if ($fecha_radicacion<$fecha_expedicion && $fecha_radicacion<$fecha_ejecutoria && $fecha_ejecutoria>=$fecha_expedicion) {


if (1==$_SESSION['rol'] or 0<$nump144) {
	$curador=$_POST['id_curador'];
} else {
	$curador=$_SESSION['snr'];
}

$insertSQL = sprintf("INSERT INTO licencia_curaduria (id_curaduria, id_funcionario, nombre_licencia_curaduria, 
 fecha_radicacion, fecha_expedicion, fecha_ejecutoria, fecha_viabilidad, n_acto_administrativo, 
certificado_ocupacion, autorizacion_ocupacion, observacion_licencia, id_estado_lic_curaduria, 
id_objeto_lic_curaduria, situacion_licencia, estado_licencia_curaduria) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"), 
GetSQLValueString($curador, "int"), 
GetSQLValueString($identificador, "text"), 
GetSQLValueString($_POST["fecha_radicacion"], "date"), 
GetSQLValueString($_POST["fecha_expedicion"], "date"), 
GetSQLValueString($_POST["fecha_ejecutoria"], "date"), 
GetSQLValueString($_POST["fecha_viabilidad"], "date"), 
GetSQLValueString(trim($_POST["n_acto_administrativo"]), "text"),  
GetSQLValueString($_POST["certificado_ocupacion"], "text"), 
GetSQLValueString($_POST["autorizacion_ocupacion"], "text"), 
GetSQLValueString($_POST["observacion_licencia"], "text"), 
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;

$actualizar5 = mysql_query("SELECT id_licencia_curaduria FROM licencia_curaduria WHERE id_curaduria='$id' and nombre_licencia_curaduria='$identificador' limit 1", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($actualizar5);
$id_lic2 = $row15['id_licencia_curaduria'];

echo '<meta http-equiv="refresh" content="1;URL=licencia&'.$id_lic2.'.jsp" />';


} else {
echo '<div class="alert alert-danger" role="alert"><a href="" class="close" style="text-decoration:none;">&times;</a>Las fechas no estan de acuerdo al orden cronológico.</div>';
	
}






}
  mysql_free_result($actualizar56);

} else { }

?>

 <section class="content">
 

  
  
  
   <div class="row" style="background:#fff;">
      <div class="panel-body">
<div class="col-md-5"> 
<i class="glyphicon glyphicon-home"></i>  <?php echo $name; ?> <br>
<i class="glyphicon glyphicon-envelope"></i> <?php echo $correo_curaduria; ?><br>
<i class="glyphicon glyphicon-map-marker"></i> <?php echo quees('departamento', $id_departamento); ?>  <br>

</div>
<div class="col-md-3"> 
<i class="glyphicon glyphicon-map-marker"></i>  <?php echo nombre_municipio($id_municipio, $id_departamento); ?><br>
<i class="glyphicon glyphicon-earphone"></i>  <?php echo $tele; ?><br>
<i class="glyphicon glyphicon-user"></i>  <?php echo $funcionarioreal; ?><br>


</div> 
<div class="col-md-4"> 
<i class="glyphicon glyphicon-phone"></i> <?php echo $celu; ?><br>
<i class="glyphicon glyphicon-home"></i> <?php echo $dire; ?><br>
  
</div> 		 
  	 </div>
</div>
<br>

  
  
      <div class="row">
      
        <!-- /.col -->
        <div class="col-md-12">
		 <div class="row">
          <div class="box box-primary">
             <div class="box-header with-border">
                  <h3 class="box-title">NUEVO TRAMITE</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                  
                  </div>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
<form action="" method="POST" name="formgjht1">
<div class="row">
<div class="col-md-4">


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE OBJETO DEL TRAMITE:</label> 
<select  class="form-control" name="id_objeto_lic_curaduria" id="tipoobjeto2" required>
<option value="" selected></option>
<?PHP 
	if (1==$_SESSION['rol']  or 0<$nump144) {  /// solo las 3 p radicación
		 echo '<option value="Inicial">Inicial</option>';
		 	 echo '<option value="Inicial con radicación automática">Inicial con radicación automática</option>';
		 		 echo '<option value="Modificación de licencia vigente">Modificación de licencia vigente</option>';
				 echo '<option value="Revalidación">Revalidación</option>';
				  echo '<option value="Prorroga">Prorroga</option>';
				  echo '<option value="Otras actuaciones">Otras actuaciones</option>';
	} else {
echo lista('objeto_lic_curaduria'); 
	}
	?>
</select>
</div>


<div class="form-group text-left numradicado2" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN DEL PROYECTO INICIAL:</label>
<div class="input-group">
<span class="input-group-addon"><?php echo $id_departamento.$id_municipio.'-'.$ncuraduria.'-'; ?></span>
 <span class="input-group-addon">
<select name="ano_licencia" id="ano_licencia2" >
<option value="<?php echo $anoactual; ?>" selected><?php echo $anoactual; ?></option>
<option value="<?php $anoactualmenos1=$anoactual-1; echo $anoactualmenos1; ?>"><?php echo $anoactualmenos1; ?></option>
<option value="<?php $anoactualmenos2=$anoactual-2; echo $anoactualmenos2; ?>"><?php echo $anoactualmenos2; ?></option>
<option value="<?php $anoactualmenos3=$anoactual-3; echo $anoactualmenos3; ?>"><?php echo $anoactualmenos3; ?></option>
<option value="<?php $anoactualmenos4=$anoactual-4; echo $anoactualmenos4; ?>"><?php echo $anoactualmenos4; ?></option>
<option value="<?php $anoactualmenos5=$anoactual-5; echo $anoactualmenos5; ?>"><?php echo $anoactualmenos5; ?></option>
<option value="<?php $anoactualmenos6=$anoactual-6; echo $anoactualmenos6; ?>"><?php echo $anoactualmenos6; ?></option>

</select>
</span>
<input type="hidden" class="form-control" name="normalizacion_curaduria"  value="<?php echo $id_departamento.$id_municipio.'-'.$ncuraduria.'-'; ?>">
 <span class="input-group-addon">
<input type="text" class="numero" placeholder="#" name="nombre_licencia_curaduria" style="width:50px;" value="" maxlength="4" required>
</span>
</div>
</div>


<div class="form-group text-left prorroga2" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE RADICACIÓN DE LA PRORROGA:
</label> 
<input type="text" class="form-control" name="numero_prorroga2"  id="numero_prorroga2">
</div>


<div class="form-group text-left otrasactuaciones2" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ACTUACIÓN:</label> 
<select  class="form-control" name="actuacion" id="otrasact2">
<option selected></option>
<option>NO PRESENTA</option>
<option>AJUSTE DE AREAS</option>
<option>CONCEPTO DE NORMA URBANISTICA</option>
<option>CONCEPTO DE USO DEL SUELO</option>
<option>COPIA CERTIFICADA DE PLANOS</option>
<option>APROBACION DE LOS PLANOS DE PROPIEDAD HORIZONTAL</option>
<option>AUTORIZACIÓN PARA EL MOVIMIENTO DE TIERRAS</option>
<option>APROBACIÓN DE PISCINAS</option>
<option>MODIFICACION DE PLANOS URBANISTICOS, DE LEGALIZACION Y DEMAS PLANOS QUE APROBARÓN DESARROLLOS O ASENTAMIENTOS</option>
<option>BIENES DESTINADOS A USO PUBLICO O CON VOCACIÓN DE USO PÚBLICO</option>
</select>
</div>




<div class="form-group text-left  actoadmin2" style="display:none;"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE ACTO ADMINISTRATIVO:
</label> 
<input type="text" class="form-control mayuscula" name="n_acto_administrativo"  id="actoadministrativo2">
</div>


<!--<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RADICACIÓN LEGAL Y EN DEBIDA FORMA:</label> 
<select  class="form-control" name="radicacion_legal" id="radicacion_legal" required>
<option selected></option>
<option value="Si">Si</option>
<option value="No">No</option>
</select>
</div>-->


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ESTADO:</label> 
<select  class="form-control" name="radicacion_estado" id="radicacion_estado" required>
<option selected></option>
<option value="Radicación incompleta">Radicación incompleta</option>
<option value="Radicación en legal y debida forma">Radicación en legal y debida forma</option>
<option value="Aprobado">Aprobado</option>
<option value="Desistido">Desistido</option>
<option value="Suspendido">Suspendido</option>
<option value="Negado">Negado</option>
<option value="Con recurso">Con recurso</option>
</select>
</div>


<div class="form-group text-left mensaje30dias" style="display:none;"> 
<label  class="control-label">TIENE 30 DIAS HABILES PARA CAMBIAR EL ESTADO A RADICACIÓN EN LEGAL Y DEBIDA FORMA O EL SISTEMA LO DESISTIRA AUTOMATICAMENTE</label> 
FECHA DE RADICACIÓN INCOMPLETA
<input type="text" class="form-control datepickercuraduria" readonly="readonly" value="<?php echo date('Y-m-d'); ?>" name="fecha_incompleta"  >


</div>





<div class="form-group text-left ccertificado_ocupacion" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> REQUIERE CERTIFICACIÓN TECNICA DE OCUPACIÓN:</label> 
<select name="certificado_ocupacion" class="form-control" id="certificado_ocupacion" required>
<option></option>
<option>SI</option>
<option>NO</option>
</select>
</div>
 
 <div class="form-group text-left cautorizacion_ocupacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> REQUIERE AUTORIZACIÓN DE OCUPACIÓN DE INMUEBLE:</label> 
<select name="autorizacion_ocupacion" class="form-control" id="autorizacion_ocupacion" required>
<option></option>
<option>SI</option>
<option>NO</option>
</select>
</div>




 <div class="form-group text-left cautorizacion_ocupacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE TITULARES:</label> 
<input name="n_titulares" class="form-control" required>
</div>



 <div class="form-group text-left cautorizacion_ocupacion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NÚMERO DE MATRICULAS INMOBILIARIAS ASOCIADAS AL PROYECTO:</label> 
<input name="n_matriculas" class="form-control" required>
</div>















</div>
<div class="col-md-5">

<div class="form-group text-left"> 
<label  class="control-label"> OBSERVACION:</label> 
<span style="color:#ff0000;">(En caso de que el número de radicado sea de hace dos años, informar el motivo.)</span>
<textarea class="form-control mayuscula" style="min-height:200px;" name="observacion_licencia" ></textarea>
</div>


			

</div>
<div class="col-md-3">
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE RADICACION LEGAL Y EN DEBIDA FORMA:</label> 
<input type="text" class="form-control datepickercuraduria" readonly="readonly" name="fecha_radicacion"  required  >
</div>
<div class="form-group text-left cfecha_expedicion"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE EXPEDICION:</label> 
<input type="test"  class="form-control datepickercuraduria" readonly="readonly" name="fecha_expedicion" id="fecha_expedicion" required  >
</div>
<div class="form-group text-left cfecha_ejecutoria"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA EJECUTORIA:</label> 
<input type="text"  class="form-control datepickercuraduria" readonly="readonly" name="fecha_ejecutoria" id="fecha_ejecutoria" required  >
</div>


<div class="form-group text-left cfecha_viabilidad"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DEL ACTA DE VIABILIDAD::</label> 
<input type="text"  class="form-control datepickercuraduria" readonly="readonly" name="fecha_viabilidad" id="fecha_viabilidad" required  >
</div>



<?php if (1==$_SESSION['rol'] or 0<$nump144) { ?>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CURADOR:</label> 
<select  class="form-control" name="id_curador" required>
<option value="" selected></option>
<?php 
$query = sprintf("SELECT id_funcionario, nombre_funcionario, nombre_cargo FROM funcionario, cargo where funcionario.id_cargo=cargo.id_cargo and estado_funcionario=1 and id_tipo_oficina=4 order by nombre_funcionario"); 
$select = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_funcionario'].'">'.$row['nombre_funcionario'].' - '.$row['nombre_cargo'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
?>
</select>
</div>
<?php } else {} ?>



</div>



</div>
<div class="row">
<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<!--<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="licencia_curaduria">
<span class="glyphicon glyphicon-ok"></span> Crear</button>-->

<a href="tramite_curaduria&111939.jsp" class="btn btn-success">Crear</a>


</div>
</div>
</form>




            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
		  </div>
		  
		  
        </div>
    
	
	
	
	
	

   
   
   
	
	
	
	

		
      </div>
      <!-- /.row -->
    </section>
	<?php
} else {}
	} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }
	
	?>
	
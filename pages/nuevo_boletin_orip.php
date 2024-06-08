<?php
if (isset($_GET['i'])) {
	$id=$_GET['i'];
	
$query = sprintf("SELECT * FROM departamento,municipio,oficina_registro,region  where departamento.id_departamento=oficina_registro.id_departamento and municipio.codigo_municipio=oficina_registro.codigo_municipio and region.id_region=oficina_registro.id_region and id_oficina_registro='$id'  limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
$name = $row1['nombre_oficina_registro'];
$id_or = $row1['id_oficina_registro'];
$dep = $row1['nombre_departamento'];
$ciudad = $row1['nombre_municipio'];
$region = $row1['nombre_region'];
$idregion = $row1['id_region'];
$tele = $row1['telefono_oficina_registro'];
$celu = $row1['telefono_oficina_registro'];
$dire = $row1['direccion_oficina_registro'];
$nombre = $row1['nombre_oficina_registro'];
$correo = $row1['correo_oficina_registro'];
$supergiros = $row1['supergiros_oficina_registo'];
$ncuraduria=str_replace("Curaduria ","",$name);

} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }



if (isset($_POST['supergiros'])) {
$insertSQL = sprintf("INSERT INTO boletin_orips (f_be, id_oficina_registro, odr_mvrb, odr_rd, odr_rv, oc_ro, oc_rd, oc_rv, oc_eoo, oc_ri, oc_vc, oc_vri, ie_irs, ie_is, ie_ic, ie_vc, a_sav, a_consd, a_cancd, id_region, estado_boletin_orips, fecha_real) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now())", 
GetSQLValueString($_POST["f_be"],"date"),        
GetSQLValueString($id_or, "text"), 
        
GetSQLValueString($_POST["odr_mvrb"], "text"),  
GetSQLValueString($_POST["odr_rd"], "text"),
GetSQLValueString($_POST["odr_rv"], "text"),

GetSQLValueString($_POST["oc_ro"], "text"),  
GetSQLValueString($_POST["oc_rd"], "text"),
GetSQLValueString($_POST["oc_rv"], "text"),
GetSQLValueString($_POST["oc_eoo"], "text"),
GetSQLValueString($_POST["oc_ri"], "text"),  
        
GetSQLValueString($_POST["oc_vc"], "text"),
GetSQLValueString($_POST["oc_vri"], "text"), 

GetSQLValueString($_POST["ie_irs"], "text"),
GetSQLValueString($_POST["ie_is"], "text"),
GetSQLValueString($_POST["ie_ic"], "text"),

GetSQLValueString($_POST["ie_vc"], "text"),

GetSQLValueString($_POST["a_sav"], "text"),
GetSQLValueString($_POST["a_consd"], "text"),
GetSQLValueString($_POST["a_cancd"], "text"),  


GetSQLValueString($idregion, "int"),       
GetSQLValueString(1, "int")); 
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
}else{}

if (isset($_POST['sucursal'])) {
$insertSQL = sprintf("INSERT INTO boletin_orips (f_be, id_oficina_registro, odr_mvrb, odr_rd, odr_rec, odr_rv, oc_ro, oc_rd, oc_rec, oc_rv, oc_eoo, oc_ri, oc_vc, oc_vri, ie_irs, ie_is, ie_ic, ie_vc, a_sav, a_consd, a_cancd, id_region, estado_boletin_orips, fecha_real) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now())", 
GetSQLValueString($_POST["f_be"],"date"),        
GetSQLValueString($id_or, "text"), 
        
GetSQLValueString($_POST["odr_mvrb"], "text"),  
GetSQLValueString($_POST["odr_rd"], "text"),
GetSQLValueString($_POST["odr_rec"], "text"),
GetSQLValueString($_POST["odr_rv"], "text"),

GetSQLValueString($_POST["oc_ro"], "text"),  
GetSQLValueString($_POST["oc_rd"], "text"),
GetSQLValueString($_POST["oc_rec"], "text"),
GetSQLValueString($_POST["oc_rv"], "text"),
GetSQLValueString($_POST["oc_eoo"], "text"),
GetSQLValueString($_POST["oc_ri"], "text"),  
        
GetSQLValueString($_POST["oc_vc"], "text"),
GetSQLValueString($_POST["oc_vri"], "text"), 

GetSQLValueString($_POST["ie_irs"], "text"),
GetSQLValueString($_POST["ie_is"], "text"),
GetSQLValueString($_POST["ie_ic"], "text"),

GetSQLValueString($_POST["ie_vc"], "text"),

GetSQLValueString($_POST["a_sav"], "text"),
GetSQLValueString($_POST["a_consd"], "text"),
GetSQLValueString($_POST["a_cancd"], "text"),  


GetSQLValueString($idregion, "int"),       
GetSQLValueString(1, "int")); 
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
}else{}
?>


<section class="content">
  <?php
    if ($supergiros == 1) {
    ?>
    
    <div class="row">

<!-- /.col -->
<div class="col-md-9">
<div class="box box-primary">
<div class="box-header with-border">
    <h3 class="box-title"><strong>Ingreso Boletin Oficina con Recaudo Supergiros</strong></h3>

<div class="box-tools pull-right">

<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>


</div>
</div>
<!-- /.box-header -->
<div class="box-body">        
<form action="" method="POST">
        <!-- Left col -->
          <!-- MAP & BOX PANE -->
            
            
            <div class="col-md-12">
              <div class="col-md-3">
                <div class="form-group text-left"> 
                    <h6 class="box-title">Fecha del Boletin</h6> 
                    <input type="date"  class="form-control datepicker" name="f_be" required>
                </div>
              </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                  </div>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                </div>
              </div>
              
            <div class="col-md-12">
                <div class="col-md-3">
                    <h6 class="box-title"><strong>INGRESOS DERECHOS REGISTRO</strong></h6><hr>
                    <div class="form-group">
                      <label class="text_titulos">Valor Recaudado En Bancos</label>
                      <input type="text" class="form-control price3" required/><input type="hidden" id="numero3" name="odr_mvrb" class="monto" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado Por Datáfono</label>
                      <input type="text" class="form-control price4" required/><input type="hidden" id="numero4" name="odr_rd" class="monto" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado Por Vur</label>
                      <input type="text" class="form-control price6" required/><input type="hidden" id="numero6" name="odr_rv" class="monto" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                        <label class="numer">Total Ingresos Derechos Registro</label><br>
                      <label class="muestra" id="spTotal"></label>
                    </div>
                </div>
               <div class="col-md-3">
                    <h6 class="box-title"><strong>INGRESOS POR CERTFICADOS</strong></h6><hr>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado En Supergiros</label>
                      <input type="text" class="form-control price7" required/><input type="hidden" id="numero7" name="oc_ro" class="monto2" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado Por Datáfono</label>
                      <input type="text" class="form-control price8" required/><input type="hidden" id="numero8" name="oc_rd" class="monto2" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado En Vur</label>
                      <input type="text" class="form-control price10" required/><input type="hidden" id="numero10" name="oc_rv" class="monto2" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Expedidos Por Otras ORIPS</label>
                      <input type="text" class="form-control price11" required/><input type="hidden" id="numero11" name="oc_eoo" class="monto2" onkeyup="sumar();">
                    </div>
                   <div class="form-group">
                       <label class="text_titulos">Recaudo Por Internet<br>(PSE, TC, KIOSKOS)</label>
                      <input type="text" class="form-control price12" required/><input type="hidden" id="numero12" name="oc_ri" class="monto2" onkeyup="sumar();">
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label style="font-size: 11px;"> Volumetria Certificados</label>
                              <input type="number" class="form-control" placeholder="Cantidad" required name="oc_vc">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label style="font-size: 11px;"> Volumetria Internet</label>
                              <input type="number" class="form-control" placeholder="Cantidad" required name="oc_vri">
                            </div>
                        </div>
                    </div>
                   <div class="form-group">
                      <label class="numer">Total Ingresos Por Certificados</label><br>
                      <label class="muestra" id="spTotal2"></label>
                    </div>
                </div>
               <div class="col-md-3">
                    <h6 class="box-title"><strong>INGRESOS EXTRAORDINARIOS</strong></h6><hr>
                    <div class="form-group">
                      <label class="text_titulos">Reproducción De Sellos</label>
                      <input type="text" class="form-control price13" required/><input type="hidden" id="numero13" name="ie_irs" class="monto3" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Sobrantes</label><br>
                      <input type="text" class="form-control price14" required/><input type="hidden" id="numero14" name="ie_is" class="monto3" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                        <label class="text_titulos">Copias</label><br>
                        <input type="text" class="form-control price15" required/><input type="hidden" id="numero15" name="ie_ic" class="monto3" onkeyup="sumar();">
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                          <label style="font-size: 11px;"> Volumetria Copias</label>
                          <input type="number" class="form-control" placeholder="Cantidad" required name="ie_vc">
                        </div>
                    </div>
                </div>
               <div class="col-md-3">
                   <h6 class="box-title"><strong>ANTICIPADOS</strong></h6><hr>
                    <div class="form-group">
                      <label class="text_titulos">Saldo Anticipado Que Viene</label>
                      <input type="text" class="form-control price16" required/><input type="hidden" id="numero16" name="a_sav" class="monto4" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Anticipados Constituidos al Día</label>
                      <input type="text" class="form-control price17" required/><input type="hidden" id="numero17" name="a_consd" class="monto4" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Anticipados Cancelados al Día</label>
                      <input type="text" class="form-control price18" required/><input type="hidden" id="numero18" name="a_cancd" class="monto5" onkeyup="sumar();">
                    </div>
               </div><br><br>
               
               <div class="row">
                   <div class="col-md-12">
                    <div class="col-md-6">
                    </div>  
                    <div class="col-md-3">
                        <label><input style="margin: 28px auto 0px" type="checkbox" value="" required> Seguro ha Validado </label>
                        <input style="width: 100%; height: 40px; margin: 0px auto" type="button" name="Ver total" value="Validar" class="btn btn-info" type="submit" onclick="sumar(odr_mvrb)">
                    </div>
                    <div class="col-md-3">   
                    <button style="width: 100%; height: 40px; float: right; margin: 50px auto" type="submit" name="supergiros" class="btn btn-success">ENVIAR</button>
                    </div>
                   </div>
               </div>
               </div>
                          
           
            <!-- /.box-header -->
          
        </form>


</div>
<!-- /.box-body -->

<!-- /.box-footer -->

<!-- /.box-footer -->
</div>
<!-- /. box -->
</div>


<div class="col-md-3">

<div class="box box-solid">
<div class="box-header with-border">
<h3 class="box-title"><b>Información Oficina de Registro</b></h3>

<div class="box-tools">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div>
</div>
<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a ><i class="glyphicon glyphicon-home"></i> Oficina de Registro <span class="pull-right"> <?php echo $name; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-home"></i> Regional <span class="pull-right"> <?php echo $region; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-map-marker"></i> Departamento     <span class="pull-right"><?php echo $dep; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-map-marker"></i> Municipio <span class="pull-right"><?php echo $ciudad; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-info-sign"></i> Recaudo <span style="font-size:13px" class="pull-right"> Supergiros </span></a></li>
<li><a ><i class="glyphicon glyphicon-earphone"></i> Telefono <span class="pull-right"><?php echo $tele; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-home"></i> Direccion <span style="font-size:13px" class="pull-right"><?php echo $dire; ?></span></a></li>
</ul>
</div>
</div>    

<div class="box box-solid">
<div class="box-header with-border">
<h3 class="box-title"><b>Informacion Registrador</b></h3>

<div class="box-tools">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div>
<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a ><i class="glyphicon glyphicon-user"></i> Registrador <span class="pull-right"><?php echo $nombre; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-envelope"></i> <span  style="font-size:13px" class="pull-right"><?php echo $correo; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-phone"></i> Celular <span class="pull-right"><?php echo $celu; ?></span></a></li>
</ul>
</div>
</div> 
<!-- /.box-body -->
</div>

 
    
    
<div class="box box-solid">
<div class="box-header with-border">
<h3 class="box-title"><b>Detalle de Consolidación</b></h3>

<div class="box-tools">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div>
</div>
<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked numero_total">
<label style="visibility: hidden" id="spTotalt"></label><br>
<label class="totales">TOTAL INGRESOS ORDINARIOS</label><br>
<label class="numeros_totales" id="spTotal1020"></label> 
<label class="totales">TOTAL INGRESOS EXTRAORDINARIOS</label><br>
<label class="numeros_totales" id="spTotal3"></label>
<label class="totales">TOTAL INGRESOS</label><br>
<label class="numeros_totales" id="spTotaingresoTsg"></label>
<label class="totales">SALDO DIARIO DEL ANTICIPADO</label><br>
<label class="numeros_totales" id="spTotal4"></label>
<label class="totales">ANTICIPADOS CANCELADOS EN EL DIA</label><br>
<label class="numeros_totales" id="spTotal5"></label>
<label class="totales">TOTAL SALDO DIARIO DEL ANTICIPADO</label><br>
<label class="numeros_totales" id="spTotarestacan"></label>
<br><br>

<label style="visibility: hidden" id="spTotaconsolidadosuma"></label><br>

<label class="totalescon">TOTAL BOLETIN DIARIO</label>
<label  style="font-size: 40px" class="totalescajac" id="sumatbsg"></label><br><br>

<!-- /. box -->
</ul>
<!-- /.box -->
</div>
</div>
    
    
    
</div>
<!-- /.row -->
</div>
  
<?php } else {    ?>

    <div class="row">

<!-- /.col -->
<div class="col-md-9">
<div class="box box-primary">
<div class="box-header with-border">
    <h3 class="box-title"><strong>Ingreso Boletin OFicina con Sucursal Bancaria</strong></h3>

<div class="box-tools pull-right">

<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>


</div>
</div>
<!-- /.box-header -->
<div class="box-body">        
<form action="" method="POST">
        <!-- Left col -->
          <!-- MAP & BOX PANE -->
            
            
            <div class="col-md-12">
              <div class="col-md-3">
                <div class="form-group text-left"> 
                    <h6 class="box-title">Fecha del Boletin</h6> 
                    <input type="date"  class="form-control datepicker" name="f_be" required>
                </div>
              </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                      <h6 class="box-title">Ingreso Recibido en la Oficina</h6>
                      <input type="text" class="form-control price" required/><input type="hidden" id="numero" name="tiro" class="montot" onkeyup="sumar();">
                  </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <h6 class="box-title">SALDO INICIAL EN BANCOS</h6>
                    <input type="text" class="form-control price1" required/><input type="hidden" id="numero1" name="sib">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <h6 class="box-title">SALDO FINAL EN BANCOS</h6>
                    <input type="text" class="form-control price2" required/><input type="hidden" id="numero2" name="sfb">
                    </div>
                </div>
              </div>
              
            <div class="col-md-12">
                <div class="col-md-3">
                    <h6 class="box-title"><strong>INGRESOS DERECHOS REGISTRO</strong></h6><hr>
                    <div class="form-group">
                      <label class="text_titulos">Valor Recaudado En Bancos</label>
                      <input type="text" class="form-control price3" required/><input type="hidden" id="numero3" name="odr_mvrb" class="monto" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado Por Datáfono</label>
                      <input type="text" class="form-control price4" required/><input type="hidden" id="numero4" name="odr_rd" class="monto" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado Extensiones Caja</label>
                      <input type="text" class="form-control price5" required/><input type="hidden" id="numero5" name="odr_rec" class="monto" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado Por Vur</label>
                      <input type="text" class="form-control price6" required/><input type="hidden" id="numero6" name="odr_rv" class="monto" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                        <label class="numer">Total Ingresos Derechos Registro</label><br>
                      <label class="muestra" id="spTotal"></label>
                    </div>
                </div>
               <div class="col-md-3">
                    <h6 class="box-title"><strong>INGRESOS POR CERTFICADOS</strong></h6><hr>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado En Bancos</label>
                      <input type="text" class="form-control price7" required/><input type="hidden" id="numero7" name="oc_ro" class="monto2" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado Por Datáfono</label>
                      <input type="text" class="form-control price8" required/><input type="hidden" id="numero8" name="oc_rd" class="monto2" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado Extensiones Caja</label>
                      <input type="text" class="form-control price9" required/><input type="hidden" id="numero9" name="oc_rec" class="monto2" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Recaudado En Vur</label>
                      <input type="text" class="form-control price10" required/><input type="hidden" id="numero10" name="oc_rv" class="monto2" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Expedidos Por Otras ORIPS</label>
                      <input type="text" class="form-control price11" required/><input type="hidden" id="numero11" name="oc_eoo" class="monto2" onkeyup="sumar();">
                    </div>
                   <div class="form-group">
                      <label class="text_titulos">Recaudo Por Internet</label>
                      <input type="text" class="form-control price12" required/><input type="hidden" id="numero12" name="oc_ri" class="monto2" onkeyup="sumar();">
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label style="font-size: 11px;"> Volumetria Certificados</label>
                              <input type="number" class="form-control" placeholder="Cantidad" required name="oc_vc">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label style="font-size: 11px;"> Volumetria Internet</label>
                              <input type="number" class="form-control" placeholder="Cantidad" required name="oc_vri">
                            </div>
                        </div>
                    </div>
                   <div class="form-group">
                      <label class="numer">Total Ingresos Por Certificados</label><br>
                      <label class="muestra" id="spTotal2"></label>
                    </div>
                </div>
               <div class="col-md-3">
                    <h6 class="box-title"><strong>INGRESOS EXTRAORDINARIOS</strong></h6><hr>
                    <div class="form-group">
                      <label class="text_titulos">Reproducción De Sellos</label>
                      <input type="text" class="form-control price13" required/><input type="hidden" id="numero13" name="ie_irs" class="monto3" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Sobrantes</label><br>
                      <input type="text" class="form-control price14" required/><input type="hidden" id="numero14" name="ie_is" class="monto3" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                        <label class="text_titulos">Copias</label><br>
                        <input type="text" class="form-control price15" required/><input type="hidden" id="numero15" name="ie_ic" class="monto3" onkeyup="sumar();">
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                          <label style="font-size: 11px;"> Volumetria Copias</label>
                          <input type="number" class="form-control" placeholder="Cantidad" required name="ie_vc">
                        </div>
                    </div>
                </div>
               <div class="col-md-3">
                   <h6 class="box-title"><strong>ANTICIPADOS</strong></h6><hr>
                    <div class="form-group">
                      <label class="text_titulos">Saldo Anticipado Que Viene</label>
                      <input type="text" class="form-control price16" required/><input type="hidden" id="numero16" name="a_sav" class="monto4" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Anticipados Constituidos al Día</label>
                      <input type="text" class="form-control price17" required/><input type="hidden" id="numero17" name="a_consd" class="monto4" onkeyup="sumar();">
                    </div>
                    <div class="form-group">
                      <label class="text_titulos">Anticipados Cancelados al Día</label>
                      <input type="text" class="form-control price18" required/><input type="hidden" id="numero18" name="a_cancd" class="monto5" onkeyup="sumar();">
                    </div>
               </div><br><br>
               
               <div class="row">
                   <div class="col-md-12">
                    <div class="col-md-6">
                    </div>  
                    <div class="col-md-3">
                        <label><input style="margin: 28px auto 0px" type="checkbox" value="" required> Seguro ha Validado </label>
                        <input style="width: 100%; height: 40px; margin: 0px auto" type="button" name="Ver total" value="Validar" class="btn btn-info" type="submit" onclick="sumar(tiro)">
                    </div>
                    <div class="col-md-3">   
                    <button style="width: 100%; height: 40px; float: right; margin: 50px auto" type="submit" name="sucursal" class="btn btn-success">ENVIAR</button>
                    </div>
                   </div>
               </div>
               </div>
                          
           
            <!-- /.box-header -->
          
        </form>


</div>
<!-- /.box-body -->

<!-- /.box-footer -->

<!-- /.box-footer -->
</div>
<!-- /. box -->
</div>


<div class="col-md-3">

<div class="box box-solid">
<div class="box-header with-border">
<h3 class="box-title"><b>Información Oficina de Registro</b></h3>

<div class="box-tools">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div>
</div>
<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a ><i class="glyphicon glyphicon-home"></i> Oficina de Registro <span class="pull-right"> <?php echo $name; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-home"></i> Regional <span class="pull-right"> <?php echo $region; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-map-marker"></i> Departamento     <span class="pull-right"><?php echo $dep; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-map-marker"></i> Municipio <span class="pull-right"><?php echo $ciudad; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-info-sign"></i> Recaudo <span style="font-size:13px" class="pull-right"> Sucursal Bancaria </span></a></li>
<li><a ><i class="glyphicon glyphicon-earphone"></i> Telefono <span class="pull-right"><?php echo $tele; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-home"></i> Direccion <span style="font-size:13px" class="pull-right"><?php echo $dire; ?></span></a></li>

</ul>
</div>
</div>    

<div class="box box-solid">
<div class="box-header with-border">
<h3 class="box-title"><b>Informacion Registrador</b></h3>

<div class="box-tools">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div>
<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a ><i class="glyphicon glyphicon-user"></i> Registrador <span class="pull-right"><?php echo $nombre; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-envelope"></i> <span  style="font-size:13px" class="pull-right"><?php echo $correo; ?></span></a></li>
<li><a ><i class="glyphicon glyphicon-phone"></i> Celular <span class="pull-right"><?php echo $celu; ?></span></a></li>
</ul>
</div>
</div> 
<!-- /.box-body -->
</div>

 
    
    
<div class="box box-solid">
<div class="box-header with-border">
<h3 class="box-title"><b>Detalle de Consolidación</b></h3>

<div class="box-tools">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div>
</div>
<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked numero_total">
<label class="totales">TOTAL INGRESOS RECIBIDOS EN LA OFICINA</label><br>
<label class="numeros_totales" id="spTotalt"></label> 
<label class="totales">TOTAL INGRESOS ORDINARIOS</label><br>
<label class="numeros_totales" id="spTotal1020"></label> 
<label class="totales">TOTAL INGRESOS EXTRAORDINARIOS</label><br>
<label class="numeros_totales" id="spTotal3"></label>
<label class="totales">SALDO DIARIO DEL ANTICIPADO</label><br>
<label class="numeros_totales" id="spTotal4"></label>
<label class="totales">ANTICIPADOS CANCELADOS EN EL DIA</label><br>
<label class="numeros_totales" id="spTotal5"></label>
<label class="totales">TOTAL SALDO DIARIO DEL ANTICIPADO</label><br>
<label class="numeros_totales" id="spTotarestacan"></label>
<br><br>

<label class="totalescon">TOTAL CONCILIACION DIARIA</label>
<label  style="font-size: 40px" class="totalescajac" id="spTotaconsolidadosuma"></label><br><br>


<!-- /. box -->
</ul>
<!-- /.box -->
</div>
</div>
    
    
    
</div>
<!-- /.row -->
</div>
    
<?php } ?>
</section>


<?php include'js_dinero_boletin.php'; ?>
	
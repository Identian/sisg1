<?php
if (isset($_GET['i']) && "" != $_GET['i'] && 1==$_SESSION['rol']) {
$id = $_GET['i'];

$query4 = sprintf("SELECT * FROM oficina_registro where id_oficina_registro='$id' limit 1"); 
$select4 = mysql_query($query4, $conexion) or die(mysql_error());
$row14 = mysql_fetch_assoc($select4);
$id_oficina_registro = $row14['id_oficina_registro'];


$query = sprintf("SELECT * FROM  oficina_registro, funcionario, departamento, oficina_registro_sismisional, region where oficina_registro.id_oficina_registro=funcionario.id_oficina_registro and oficina_registro.id_departamento=departamento.id_departamento and oficina_registro.id_region=region.id_region and oficina_registro_sismisional.id_oficina_registro_sismisional=oficina_registro.id_oficina_registro_sismisional   and oficina_registro.id_oficina_registro='$id' limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
$nombre = $row1['nombre_oficina_registro'];
$circulo = $row1['circulo'];
$dep = $row1['departamento_oficina_registro'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];
$region = $row1['nombre_region'];
$sistema_misional = $row1['nombre_oficina_registro_sismisional'];
$correo = $row1['correo_oficina_registro'];
$tele = $row1['telefono_oficina_registro'];
$fax = $row1['fax_oficina_registro'];
$dire = $row1['direccion_oficina_registro'];
$horario = $row1['horario_oficina_registro'];

$registrador = $row1['id_funcionario'];


$latitud = $row1['latitud'];
$longitud = $row1['longitud'];



// CONSULTA PARA SACAR EL REGISTRADOR
$queryreg = sprintf("SELECT * FROM funcionario  where id_funcionario=$registrador limit 1"); 
$selectreg = mysql_query($queryreg, $conexion) or die(mysql_error());
$row1reg = mysql_fetch_assoc($selectreg);
$nombre_registrador = $row1reg['nombre_funcionario'];
$correo_registrador = $row1reg['correo_funcionario'];


$opc_1 = $row1['opc_1'];
$opc_2 = $row1['opc_2'];
$opc_3 = $row1['opc_3'];
$opc_4 = $row1['opc_4'];
$opc_5 = $row1['opc_5'];
$opc_6 = $row1['opc_6'];
$opc_7 = $row1['opc_7'];
$opc_8 = $row1['opc_8'];




if (isset($_POST['orips_actulizar'])) {
$updateSQL = sprintf("UPDATE oficina_registro SET 
  nombre_oficina_registro=%s, 
  id_region=%s,
  telefono_oficina_registro=%s, 
  direccion_oficina_registro=%s,
  horario_oficina_registro=%s,
  id_departamento=%s, 
  id_municipio=%s,
  id_oficina_registro_sismisional=%s,
  estado_oficina_registro=%s, 
  correo_oficina_registro=%s,
  opc_1=%s,
  opc_2=%s,
  opc_3=%s,
  opc_4=%s,
  opc_5=%s,
  opc_6=%s,
  opc_7=%s,
  opc_8=%s,
  latitud=%s,
  longitud=%s 
  where 
  id_oficina_registro=%s",
GetSQLValueString($_POST["nombre_oficina_registro"], "text"), 
GetSQLValueString($_POST["id_region"], "text"),
GetSQLValueString($_POST["telefono_oficina_registro"], "text"), 
GetSQLValueString($_POST["direccion_oficina_registro"], "text"), 
GetSQLValueString($_POST["horario_oficina_registro"], "text"), 
GetSQLValueString($_POST["id_departamento"], "int"), 
GetSQLValueString($_POST["id_municipio"], "int"), 
GetSQLValueString($_POST["id_oficina_registro_sismisional"], "int"), 
GetSQLValueString(1, "int"),
GetSQLValueString($_POST["correo_oficina_registro"], "text"), 
GetSQLValueString($_POST["opc_1"], "int"),  
GetSQLValueString($_POST["opc_2"], "int"), 
GetSQLValueString($_POST["opc_3"], "int"), 
GetSQLValueString($_POST["opc_4"], "int"), 
GetSQLValueString($_POST["opc_5"], "int"), 
GetSQLValueString($_POST["opc_6"], "int"),
GetSQLValueString($_POST["opc_7"], "int"),
GetSQLValueString($_POST["opc_8"], "int"),
GetSQLValueString($_POST["latitud"], "text"),
GetSQLValueString($_POST["longitud"], "text"),
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());
echo $actualizado;
echo '<meta http-equiv="refresh" content="0;URL=./orips_actualizar&'.$id.'.jsp" />';
} else { }



$query_update = sprintf("SELECT * FROM oficina_registro, region WHERE id_oficina_registro = %s and oficina_registro.id_region=region.id_region", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
mysql_free_result($update);

$correo_oficina_registro = $row_update['correo_oficina_registro'];
$id_departamento = $row_update['id_departamento'];


?>

 <div class="row">  
      <div class="col-md-12">
         <div class="box box-body" >
          <div class="box-header with-border" style="text-align: center;">
            <h3 class="box-title"><b>Información ORIP</b></h3>
            <div class="box-tools">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>

          <div class="col-md-4"> 
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked info">
                <li><a><i class="glyphicon glyphicon-flag"></i> <span><b>ORIP</b> <?php echo $nombre; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-tag"></i><span><b>Circulo </b><?php echo $circulo ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-map-marker"></i><span><b>Departamento </b><?php echo quees('departamento', $id_departamento); ?> <br>
                <li><a><i class="glyphicon glyphicon-map-marker"></i> <span><b>Ciudad </b><?php echo nombre_municipio($id_municipio, $id_departamento); ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-map-marker"></i> <span><b>Regional </b><?php echo $region; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon glyphicon-cog"></i> <span><b>Sistema Misional </b><?php echo $sistema_misional; ?></span></a></li>
              </ul>
            </div>
          </div>

          <div class="col-md-4"> 
             <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked info">
                <li><a><i class="glyphicon glyphicon-envelope"></i> <span><?php echo $correo; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-earphone"></i><span><b>Telefono </b><?php echo $tele; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-earphone"></i><span><b>Fax </b><?php echo $fax; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-home"></i><span><b>Dirección </b><?php echo $dire; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-hourglass"></i><b>Horario </b><br><span><?php echo $horario; ?></span></a></li>
              </ul>
            </div>
          </div> 

          <div class="col-md-4"> 
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked info">
                <li><a><i class="glyphicon glyphicon-user"></i> <span><b>Registrador </b><?php echo $nombre_registrador; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-envelope"></i><span><?php echo $correo_registrador; ?></span></a></li>
              </ul>
            </div>
          </div>     

        </div>
      </div>
    </div>


<div class="row">
  <div class="col-md-12">
  <div class="col-md-6">
    <div class="box box-info">

      <div  class="modal-body">
      <form action="" method="POST" name="form13435" onsubmit="return validate();">
            <h4 class="infover">Datos ORIP</h4><br>
            <div class="form-group text-left"> 
            <label  class="control-label">Oficina Registro:</label>   
            <input type="text" class="form-control" name="nombre_oficina_registro"  required value="<?php echo htmlentities($row_update['nombre_oficina_registro'], ENT_COMPAT, ''); ?>">
            </div>

            <div class="form-group text-left"> 
            <label  class="control-label">Regional:</label>   
            <select  class="form-control" name="id_region" id="id_region">
            <?php echo listapordefecto('region', 5, $row_update['id_region']); ?>
            </select>
            </div>

            <div class="form-group text-left"> 
            <label  class="control-label">DEPARTAMENTO:</label>   
            <select  class="form-control" name="id_departamento" id="id_departamento">
            <option value=""></option>
            <?php echo listapordefecto('departamento', 40, $id_departamento); ?>
            </select>
            </div>
            <div class="form-group text-left"> 
            <label  class="control-label">MUNICIPIO:</label>   
            <select  class="form-control" name="id_municipio" id="id_municipio">
            <?php if (isset($id_municipio) && ""!=$id_municipio) { ?>
            <option value="<?php echo $row_update['id_municipio']; ?>" selected><?php echo nombre_municipio($id_municipio, $id_departamento); ?></option>
            <?php } else {} ?>
            </select>
            </div>

            <div class="form-group text-left"> 
            <label  class="control-label">Sistema Misional:</label>   
            <select  class="form-control" name="id_oficina_registro_sismisional" id="id_oficina_registro_sismisional">
            <option value=""></option>
            <?php echo listapordefecto('oficina_registro_sismisional', 2, $row_update['id_oficina_registro_sismisional']); ?>
            </select>
            </div>

            <div class="form-group text-left"> 
            <label  class="control-label">Correo Oficina de Registro:</label>   
            <input type="email" class="form-control" name="correo_oficina_registro" value="<?php echo htmlentities($row_update['correo_oficina_registro'], ENT_COMPAT, ''); ?>">
            </div>

            <div class="form-group text-left"> 
            <label  class="control-label">Telefono Oficina de Registro:</label>   
            <input type="text" class="form-control" name="telefono_oficina_registro"  required value="<?php echo htmlentities($row_update['telefono_oficina_registro'], ENT_COMPAT, ''); ?>">
            </div>

            <div class="form-group text-left"> 
            <label  class="control-label">Dirección Oficina de Registro:</label>   
            <input type="text" class="form-control" name="direccion_oficina_registro"  required value="<?php echo utf8_decode($row_update['direccion_oficina_registro']); ?>">
            </div>

            <div class="form-group text-left"> 
            <label  class="control-label">Horario en la OFicina:</label>   
            <input type="text" class="form-control" name="horario_oficina_registro"  required value="<?php echo utf8_decode($row_update['horario_oficina_registro']); ?>">
            </div>

			
			
			<div class="form-group text-left"> 
            <label  class="control-label">Latitud:</label>   
            <input type="text" class="form-control" name="latitud"  required value="<?php echo $row_update['latitud']; ?>">
            </div>
			
			
			<div class="form-group text-left"> 
            <label  class="control-label">Longitud:</label>   
            <input type="text" class="form-control" name="longitud"  required value="<?php echo $row_update['longitud']; ?>">
            </div>
			
			
			
      </div><!-- /.body -->

    </div><!-- /.info -->
  
  </div><!-- /.col-md-12 -->


  <div class="col-md-6">
    <div class="box box-info">

      <div  class="modal-body">
            <h4 class="infover">Configuracion de Medios Recaudo</h4><br>

            <!-- OPCION 1 -->
            <div class="form-group text-left"> 
            <label  class="control-label">  
              <?php $row_update['opc_1']=$opc_1; 
                if($opc_1==0){
                  echo '<span style="color:red; margin:0px 10px 0px 20px;">NO</span>';
                }else {
                  echo '<span style="color:green; margin:0px 10px 0px 20px;">SI</span>';
                }
              ?> Cuenta Producto:
            </label> 
            <select name="opc_1">
              <?php $row_update['opc_1']=$opc_1; 
                if($opc_1==0){
                  echo '<option value="0">NO</option>';
                  echo '<option value="1">SI</option>';
                }else {
                  echo '<option value="1">SI</option>';
                  echo '<option value="0">NO</option>';
                }
              ?>      
            </select>  
            </div>

            <!-- OPCION 2 -->
            <div class="form-group text-left"> 
            <label  class="control-label"> 
              <?php $row_update['opc_2']=$opc_2; 
                if($opc_2==0){
                  echo '<span style="color:red; margin:0px 10px 0px 20px;">NO</span>';
                }else {
                  echo '<span style="color:green; margin:0px 10px 0px 20px;">SI</span>';
                }
              ?> Liquidador Derechos de Registro(VUR):
            </label> 
            <select name="opc_2">
              <?php $row_update['opc_2']=$opc_2; 
                if($opc_2==0){
                  echo '<option value="0">NO</option>';
                  echo '<option value="1">SI</option>';
                }else {
                  echo '<option value="1">SI</option>';
                  echo '<option value="0">NO</option>';
                }
              ?>      
            </select>  
            </div>


            <!-- OPCION 3 -->
            <div class="form-group text-left"> 
            <label  class="control-label"> 
              <?php $row_update['opc_3']=$opc_3; 
                if($opc_3==0){
                  echo '<span style="color:red; margin:0px 10px 0px 20px;">NO</span>';
                }else {
                  echo '<span style="color:green; margin:0px 10px 0px 20px;">SI</span>';
                }
              ?> Supergiros:
            </label> 
            <select name="opc_3">
              <?php $row_update['opc_3']=$opc_3; 
                if($opc_3==0){
                  echo '<option value="0">NO</option>';
                  echo '<option value="1">SI</option>';
                }else {
                  echo '<option value="1">SI</option>';
                  echo '<option value="0">NO</option>';
                }
              ?>      
            </select>  
            </div>

            <!-- OPCION 4 -->
            <div class="form-group text-left"> 
            <label  class="control-label"> 
              <?php $row_update['opc_4']=$opc_4; 
                if($opc_4==0){
                  echo '<span style="color:red; margin:0px 10px 0px 20px;">NO</span>';
                }else {
                  echo '<span style="color:green; margin:0px 10px 0px 20px;">SI</span>';
                }
              ?> Radicacion Electronica (REL):
            </label> 
            <select name="opc_4">
              <?php $row_update['opc_4']=$opc_4; 
                if($opc_4==0){
                  echo '<option value="0">NO</option>';
                  echo '<option value="1">SI</option>';
                }else {
                  echo '<option value="1">SI</option>';
                  echo '<option value="0">NO</option>';
                }
              ?>      
            </select>  
            </div>

            <!-- OPCION 5 -->
            <div class="form-group text-left"> 
            <label  class="control-label"> 
              <?php $row_update['opc_5']=$opc_5; 
                if($opc_5==0){
                  echo '<span style="color:red; margin:0px 10px 0px 20px;">NO</span>';
                }else {
                  echo '<span style="color:green; margin:0px 10px 0px 20px;">SI</span>';
                }
              ?> Datafono:
            </label> 
            <select name="opc_5">
              <?php $row_update['opc_5']=$opc_5; 
                if($opc_5==0){
                  echo '<option value="0">NO</option>';
                  echo '<option value="1">SI</option>';
                }else {
                  echo '<option value="1">SI</option>';
                  echo '<option value="0">NO</option>';
                }
              ?>      
            </select>  
            </div>

            <!-- OPCION 6 -->
            <div class="form-group text-left"> 
            <label  class="control-label">
              <?php $row_update['opc_6']=$opc_6; 
                if($opc_6==0){
                  echo '<span style="color:red; margin:0px 10px 0px 20px;">NO</span>';
                }else {
                  echo '<span style="color:green; margin:0px 10px 0px 20px;">SI</span>';
                }
              ?> Otras ORIPS antiguo botón de pago: 
            </label> 
            <select name="opc_6">
              <?php $row_update['opc_6']=$opc_6; 
                if($opc_6==0){
                  echo '<option value="0">NO</option>';
                  echo '<option value="1">SI</option>';
                }else {
                  echo '<option value="1">SI</option>';
                  echo '<option value="0">NO</option>';
                }
              ?>      
            </select>  
            </div>

            <!-- OPCION 7 -->
            <div class="form-group text-left"> 
            <label  class="control-label">
              <?php $row_update['opc_7']=$opc_7; 
                if($opc_7==0){
                  echo '<span style="color:red; margin:0px 10px 0px 20px;">NO</span>';
                }else {
                  echo '<span style="color:green; margin:0px 10px 0px 20px;">SI</span>';
                }
              ?> Sellos: 
            </label> 
            <select name="opc_7">
              <?php $row_update['opc_7']=$opc_7; 
                if($opc_7==0){
                  echo '<option value="0">NO</option>';
                  echo '<option value="1">SI</option>';
                }else {
                  echo '<option value="1">SI</option>';
                  echo '<option value="0">NO</option>';
                }
              ?>      
            </select>  
            </div>

            <!-- OPCION 8 -->
            <div class="form-group text-left"> 
            <label  class="control-label">
              <?php $row_update['opc_8']=$opc_8; 
                if($opc_8==0){
                  echo '<span style="color:red; margin:0px 10px 0px 20px;">NO</span>';
                }else {
                  echo '<span style="color:green; margin:0px 10px 0px 20px;">SI</span>';
                }
              ?> Inmediatos canales web y electrónicos:
            </label> 
            <select name="opc_8">
              <?php $row_update['opc_8']=$opc_8; 
                if($opc_8==0){
                  echo '<option value="0">NO</option>';
                  echo '<option value="1">SI</option>';
                }else {
                  echo '<option value="1">SI</option>';
                  echo '<option value="0">NO</option>';
                }
              ?>      
            </select>  
            </div>


            <div class="modal-footer">
              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button  type="submit" name="orips_actulizar" class="next btn btn-success"><span class="glyphicon glyphicon-ok"></span>Actualizar</button>
            </div>
     
        </form>
      </div><!-- /.body -->

    </div><!-- /.info -->
  
  </div><!-- /.col-md-6 -->

  </div><!-- /.col-md-12 -->

</div> <!-- /.row --> 


<?php
}}
?>

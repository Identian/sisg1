<?php
if (isset($_GET['i'])) {
  $id=$_GET['i'];

// DATOS DE LA OFICINA DE REGISTRO
$query = sprintf("SELECT * FROM inveele where id_inveele='$id' limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
$id_oficina = $row1['id_oficina'];
 

if (1==$_SESSION['rol']) {
  
  $query = sprintf("SELECT * FROM  oficina_registro, funcionario, departamento, oficina_registro_sismisional, region where 
  oficina_registro.id_funcionario=funcionario.id_funcionario and 
  oficina_registro.id_departamento=departamento.id_departamento and 
  oficina_registro.id_region=region.id_region and 
  oficina_registro_sismisional.id_oficina_registro_sismisional=oficina_registro.id_oficina_registro_sismisional and 
  oficina_registro.id_oficina_registro='$id_oficina' limit 1"); 

} 
else {
$idfun=intval($_SESSION['snr']);

$query = sprintf("SELECT * FROM  oficina_registro, funcionario, departamento, oficina_registro_sismisional, region where 
  oficina_registro.id_funcionario=funcionario.id_funcionario and 
  oficina_registro.id_departamento=departamento.id_departamento and 
  oficina_registro.id_region=region.id_region and 
  oficina_registro_sismisional.id_oficina_registro_sismisional=oficina_registro.id_oficina_registro_sismisional and 
  oficina_registro.id_oficina_registro='$id_oficina' and 
  funcionario.id_funcionario='$idfun' limit 1"); 

}


$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
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

// CONSULTA PARA SACAR EL REGISTRADOR
$queryreg = sprintf("SELECT * FROM funcionario  where id_funcionario=$registrador limit 1"); 
$selectreg = mysql_query($queryreg, $conexion) or die(mysql_error());
$row1reg = mysql_fetch_assoc($selectreg);
$nombre_registrador = $row1reg['nombre_funcionario'];
$correo_registrador = $row1reg['correo_funcionario'];


if (isset($_POST['boletin_estado'])) {
$insertSQL = sprintf("INSERT INTO boletin_estado (nombre_boletin_estado, id_boletin_resul_daf, estado_boletin_estado) VALUES (%s, %s, %s)", 
GetSQLValueString($nombre, "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo $insertado;

} else {  }


$query4723 = sprintf("SELECT count(id_boletin_estado) as contador FROM boletin_estado where id_boletin_resul_daf='$id' and estado_boletin_estado=1 limit 1"); 
$select4723 = mysql_query($query4723, $conexion) or die(mysql_error());
$row14723 = mysql_fetch_assoc($select4723);
if (0<$row14723['contador']){
  $estado=1;
} else {
  $estado=0;
}
mysql_free_result($select4723);

} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }
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

<section class="content">   
     <!-- /*=============================================
     =             INFO CONTRATO DE COMODATO           =
    =============================================*/  -->

    <?php include 'inventario_obj.php'; ?>

    <!-- =             INFO CONTRATO DE COMODATO           = -->
</section>

<?php } else {} ?>    
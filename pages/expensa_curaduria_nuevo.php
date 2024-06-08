<?php

if (isset($_GET['i'])) {
  $id=$_GET['i'];
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }


if (1==$_SESSION['rol']) {
  
  $query = sprintf("SELECT * FROM curaduria, funcionario where curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria='$id' limit 1"); 

} 
else {
$idfun=intval($_SESSION['snr']);
$query = sprintf("SELECT * FROM curaduria, funcionario where curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria='$id' and funcionario.id_funcionario='$idfun' limit 1"); 
  
}
  
// $query = sprintf("SELECT * FROM curaduria, funcionario where curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria='$id' limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
$name = $row1['nombre_curaduria'];
$dep = $row1['departamento_curaduria'];
$ciudad = $row1['ciudad_curaduria'];
$tele = $row1['telefono_curaduria'];
$celu = $row1['celular_curaduria'];
$dire = $row1['direccion_curaduria'];
$nombre_curador = $row1['nombre_funcionario'];
$correo = $row1['correo_funcionario'];
$correo_curaduria = $row1['correo_curaduria'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];
$ncuraduria=str_replace("Curaduria ","",$name);


if (isset($_POST['expensadaf'])) {
$fi2018=$_POST["feciniexp"];
$fin2018=$_POST["fecfinexp"];

$queryexp12 = sprintf("SELECT * FROM expensa_curaduria where id_curaduria=$id and fecha_inicio_expensa='$fi2018' and fecha_final_expensa='$fin2018'  and estado_expensa_curaduria=1"); 
$selectexp12 = mysql_query($queryexp12, $conexion) or die(mysql_error());
$totalRowsexp12 = mysql_num_rows($selectexp12);
if (0<$totalRowsexp12){ 

echo $fecharepetida;

} else {




$insertSQL = sprintf("INSERT INTO expensa_curaduria (
  id_curaduria,
  nombre_expensa_curaduria,
  fecha_inicio_expensa,
  fecha_final_expensa,

  editar_gp, 
  editar_gg, 
  editar_gi,
  editar_gt, 
  editar_giva,

  estado_expensa_curaduria,
  fecha_real_expensa) VALUES (%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,now())", 
GetSQLValueString($id, "int"), 
GetSQLValueString($id_departamento.$id_municipio.'-'.$ncuraduria.'-'.$fi2018.'/'.$fin2018, "text"), 
GetSQLValueString($_POST["feciniexp"], "date"),  
GetSQLValueString($_POST["fecfinexp"], "date"),

GetSQLValueString(0, "int"),
GetSQLValueString(0, "int"),
GetSQLValueString(0, "int"),
GetSQLValueString(0, "int"),
GetSQLValueString(0, "int"),

GetSQLValueString(1, "int")); 
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo $insertado;



echo '<meta http-equiv="refresh" content="0;URL=./expensa_curaduria&'.$id.'.jsp" />';



} //este es el else de repetida


} else {}
?>

  <div class="row">      
    <div class="col-md-12">
      <div class="box box-body" >
          <div class="box-header with-border" style="text-align: center;">
            <h3 class="box-title"><b>Información</b></h3>
            <div class="box-tools">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>

          <div class="col-md-4"> 
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked info">
                <li><a><i class="glyphicon glyphicon-home"></i> <span><?php echo  $name; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-envelope"></i><span><?php echo $correo_curaduria ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-map-marker"></i><span><?php echo quees('departamento', $id_departamento); ?></span></a></li>
              </ul>
            </div>
          </div>

          <div class="col-md-4"> 
             <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked info">
                <li><a><i class="glyphicon glyphicon-map-marker"></i> <span><?php echo nombre_municipio($id_municipio, $id_departamento); ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-user"></i><span><?php echo $nombre_curador; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-earphone"></i><span><?php echo $tele; ?></span></a></li>
              </ul>
            </div>
          </div> 

          <div class="col-md-4"> 
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked info">
                <li><a><i class="glyphicon glyphicon-phone"></i> <span><?php echo $celu; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-home"></i><span><?php echo $dire; ?></span></a></li>
              </ul>
            </div>
          </div>     

        </div>
      </div>
    </div>

<div class="row">      
<div class="col-md-12">
<div class="box box-info">
<form class="navbar-form" name="form87878754" method="post">
<div class="box-header with-border">

<a href="expensa_curaduria&<?php echo $id; ?>.jsp" class="btn btn-default" ><span class="glyphicon glyphicon-chevron-left"></span> Regresar </a>
&nbsp; &nbsp; &nbsp; 

<h3 class="box-title"><strong> NUEVO </strong></h3>

<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
</div>
</div>

         
</form> 
    
 <div class="box-body">

        <form id="formularioexpensa" method="POST" name="expensacua545" enctype="multipart/form-data">
       
             <div class="box-body">
                      <p style="font-size:12px; text-align: justify; line-height: 1.2;">Para el reporte de los ingresos, se ha modificado el formato de Licencias por el reporte
                      de facturación el cual deberá contener las radicaciones del mes indicando el rango de
                      facturación generado separado por tipo de costos, el valor total de la expensa por cada
                      uno de la sumatoria de la facturación de los costos, esta resultante corresponderá a la
                      base para el cálculo de la tasa de vigilancia.
                      </p><br><br>
                      <div class="row">
                        <div class="col-md-12">

                          <!-- FECHA DE INICIO -->

                          <div class="form-group">
                              <label class="col-sm-2 text_titulos_dev"><span style="color:#ff0000;">*</span> Periodo </label>
                              <div class="col-sm-5">
                              <label>Desde</label> 
                              <div class="input-group date"> 
                                <div class="input-group-addon"> 
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="feciniexp" class="form-control datepickerjo" readonly="readonly">
                              </div>
                              
                              </div><!-- col-md-5 -->
                              <div class="col-sm-5">
                              <label>Hasta</label>
                                <div class="input-group date"> 
                                  <div class="input-group-addon"> 
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="fecfinexp" class="form-control datepickerjo" readonly="readonly">
                                </div>

                              </div>
                          </div><!-- form-group -->
                          
                        </div><!-- col-md-12 -->
                      </div><!-- ROW --> 
               <!--  <input style="margin-top:40px;" type="button"  class="next rut_check btn btn-success" value="Siguiente" /> -->
               <button  style="margin-top:50px; margin-left:20px; float: right;" type="submit" name="expensadaf" class="next btn btn-success">Siguiente</button>

            </div>
        </form>
      </div>


      
 </div><!-- /.box-footer -->
</div><!-- /.box -->
</div> 
  

<?php } else {} ?>

  


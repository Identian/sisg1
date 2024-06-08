<?php
// echo 'snr: '.$_SESSION['snr'];
if (isset($_GET['i'])) {
  $id=$_GET['i'];
} //else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }

echo 'i= '.$_GET['i'];
//  if (isset($_SESSION['snr']) && 1==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['rol']) {
if (isset($_POST['i']) and ($_SESSION['rol'] >= 1 and $_SESSION['rol'] <= 3) and ($_SESSION['snr_tipo_oficina'] == 1 or $_SESSION['snr_tipo_oficina'] == 3)){  
    echo 'i= '.$_GET['i'];
    $id_funcionario=$_SESSION['snr'];
	} else {
//	$id=$_SESSION['id_vigilado'];
    $id_funcionario= 0;
	}
	$condi = '=';
	if($_SESSION['rol'] == 1 and $_SESSION['snr_tipo_oficina']== 1){
		$condi = '>=';
	}
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
          <span class="navbar-brand" > &nbsp;  NOTARIA <?php echo quees('notaria', $id_funcionario). ' -  MANEJO DE SUCESIONES';?>: </span>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
<!--          <ul class="nav navbar-nav">
          	<li <?php if ('notaria_dian'==$_GET['q']) { echo 'class="active"'; } else {} ?>><a style="color:#000;" href="notaria_dian.jsp">Reporte DIAN</a></li>
            <li <?php if ('notaria_dian'==$_GET['q']) { echo 'class="active"'; } else {} ?>><a href="sucesiones.jsp">Sucesiones</a></li>
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
if (($_SESSION['rol'] >= 1 and $_SESSION['rol'] <= 3) and ($_SESSION['snr_tipo_oficina'] == 1 or $_SESSION['snr_tipo_oficina'] == 3)){  
/*
      if (isset($_POST['reportedian']) && ($_POST["feciniexp"] < $_POST["fecfinexp"])) {
      $periodo_ini=$_POST["feciniexp"];
      $periodo_fin=$_POST["fecfinexp"];
      $querydian = sprintf("SELECT * FROM notaria_dian where id_notaria=".$id." and ped_ini='$periodo_ini' and estado_notaria_dian=1"); 
      $selectdian = mysql_query($querydian, $conexion) or die(mysql_error());
      $totalRowsdian = mysql_num_rows($selectdian);
      if (0<$totalRowsdian){ 
      echo $fecharepetida;
      } else {

      $insertSQL = sprintf("INSERT INTO notaria_dian (
        id_notaria,
        nombre_notaria_dian,

        ped_ini,
        ped_fin,
        reporte_estado,
        estado_notaria_dian,

        fec_now) VALUES (%s,%s,%s, %s,%s,%s, now())", 
      GetSQLValueString($id, "int"), 
      GetSQLValueString($id.' / '.$periodo_ini.'/'.$periodo_fin, "text"), 
      GetSQLValueString($_POST["feciniexp"], "date"),  
      GetSQLValueString($_POST["fecfinexp"], "date"),
      GetSQLValueString(0, "int"),
      GetSQLValueString(1, "int")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

      echo $insertado;

      } //este es el else de repetida

      } else {}
*/  
  ?>
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</button>&nbsp;         
  <?php } else {} ?>
	
	
<!--	<strong> REPORTE A LA DIAN </strong>
	  <a href="#" target="_blank"> Ver manual</a> -->
	 
	 
	 </h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="periodo_dian">
           <thead>
                <tr>
                  <th>Nombre_Notaria</th>
                  <th>ID Sucesi&oacute;n</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                  <th>Num Acta</th>
                  <th>Fecha Acta</th>
                 <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT * FROM sucesion, notaria, funcionario
                          WHERE funcionario.id_funcionario ".$condi.$id_funcionario."
                          AND notaria.id_notaria = funcionario.id_notaria_f
                          AND  sucesion.id_notaria = notaria.id_notaria
                          AND sucesion.estado_sucesion = 1");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {
            ?>
          <tr>
             <td><?php $iddian=$row_dian['id_notaria'];?><?php echo $row_dian['nombre_notaria'];?></td>
             <td><?php $idsucesion=$row_dian['id_sucesion'];?><?php echo $row_dian['id_sucesion'];?></td>
             <td><?php echo $row_dian['fecha_inicio'];?></td>
             <td><?php echo $row_dian['fecha_terminacion'];?></td>
             <td><?php echo $row_dian['numero_acta'];?></td>
             <td><?php echo $row_dian['fecha_acta'];?></td>
             <td>
                <a href="sucesion_delete&<?php echo $idsucesion; ?>.jsp"><span class="pull-right-container"><small class="label pull-right bg-green">Eliminar</small></span></a> &nbsp;
                <a href="sucesion_update&<?php echo $idsucesion; ?>.jsp"><span class="pull-right-container"><small class="label pull-right bg-red">Editar</small></span></a> &nbsp;
             </td>
          </tr>
         
         


      <?php } ?> <!-- CIERRE PRIMER WHILE -->

          <script>
              $(document).ready(function() {
            $('#periodo_dian').DataTable({
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
<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>Registro Sucesi&oacute;n</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                   <form action="" method="POST" name="form1" >
                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"></i>FECHA INICIO:</label>   
                              <input type="text" class="form-control datepickerjo" name="fecha_inicio" readonly="readonly" value="">
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label">N&Uacute;MERO ACTA:</label>   
                              <input type="number" class="form-control" name="numero_acta"   value="">
                         </div>
                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"></i>FECHA ACTA:</label>   
                              <input type="text" class="form-control datepickerjo" name="fecha_acta" readonly="readonly" value="">
                         </div>
                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"></i>FECHA CREACI&Oacute;N:</label>   
                              <input type="text" class="form-control datepickerjo" name="fecha_reg_creacion" readonly="readonly" value="">
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label">C&Eacute;DULA FUNCIONARIO QUE REGISTRA:</label>   
                              <input type="number" class="form-control" id="cc_funcionario_reg"  name="cc_funcionario_reg" onChange= "valfunreg();" value="">
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label">NOMBRE FUNCIONARIO QUE REGISTRA:</label>   
                              <input type="number" class="form-control" id="nombre_funcionario_reg"  name="nombre_funcionario_reg" readonly="readonly" value="">
                         </div>

                         <div class="modal-footer">
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="table" value="notaria">
                              <span class="glyphicon glyphicon-ok"></span>Registrar</button>
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div> 

   <script>
   function valfunreg() {
    var cc_funreg = document.getElementById(cc_funcionario_reg).value;
    jQuery.ajax({
    type: "POST",
    url: "pages/valida_cc_fun.php",
    data: 'option='+cc_funreg,
    async: true,
      success: function(b) {
      document.getElementById(nombre_funcionario_reg).value = jQuery('#divinvegar').html(b);
      }
    })
   };
  </script>
  
<?php  
 /* 
$query = sprintf("SELECT ped_ini, ped_fin  FROM notaria_dian where estado_notaria_dian=1 and id_notaria=".$id." order by id_notaria_dian"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo '<script>var arraydays = [';
do {
	

for($i=$row['ped_ini'];$i<=$row['ped_fin'];$i = date("Y-m-d", strtotime($i ."+ 1 days"))){ 
echo '"'.$i.'",';
}

	
	 } while ($row = mysql_fetch_assoc($select)); 
echo ' "2001-01-01"];</script>';
} else {}	 
mysql_free_result($select);
*/

 ?>
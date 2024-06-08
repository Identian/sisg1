<?php
    if (isset($_GET['i']) && 1==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['rol']) {
    $id=$_GET['i'];
	} else {
	$id=$_SESSION['id_vigilado'];
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
<span class="navbar-brand" > &nbsp;  NOTARIA <?php echo quees('notaria', $id);?>: </span>
</div>
<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
	<li <?php if ('notaria_dian'==$_GET['q']) { echo 'class="active"'; } else {} ?>><a style="color:#000;" href="notaria_dian.jsp">Reporte DIAN</a></li>
             <li><a href="#">Sucesiones</a></li>
			 <li><a href="#">Interdictos</a></li>
			 <li><a href="#">Permisos y licencias</a></li>
			 <li><a href="#">Situaciones administrativas</a></li>
          </ul>
</div>
    </div>
</nav>
</div>
</div>


	  
	  
	  
<div class="row">
<div class="col-md-12">

 <div class="box box-info">
  <div class="box-header with-border">
  
  <?php if ((3==$_SESSION['snr_tipo_oficina'] and isset($_SESSION['id_vigilado']) and 1==$_SESSION['snr_grupo_cargo']) or 1==$_SESSION['rol']) { 
  
  

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
  
  ?>
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</button>&nbsp;         
  <?php } else {} ?>
	
	
	<strong> REPORTE A LA DIAN </strong>
	  <a href="#" target="_blank"> Ver manual</a>
	 
	 
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
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                  <th>Registrado</th>
                  <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $query875 = sprintf("SELECT * FROM notaria_dian, notaria WHERE 
                notaria_dian.id_notaria=notaria.id_notaria AND notaria.id_notaria=".$id." AND
                estado_notaria_dian=1");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {
            ?>
          <tr>
             <td><?php $iddian=$row_dian['id_notaria_dian'];?><?php echo $row_dian['nombre_notaria'];?></td>
             <td><?php echo $row_dian['ped_ini'];?></td>
             <td><?php echo $row_dian['ped_fin'];?></td>
             <td><?php echo $row_dian['fec_now'];?></td>
             <td>
              <?php 
                $estadodian=$row_dian['reporte_estado']; 
                if ($estadodian==0) { ?>
                  <a href="notaria_dian_reporte&<?php echo $iddian; ?>.jsp"><span class="pull-right-container"><small class="label pull-right bg-red">Abierto</small></span></a> &nbsp;
                <?php } else { ?>
                  <a href="notaria_dian_reporte&<?php echo $iddian; ?>.jsp"><span class="pull-right-container"><small class="label pull-right bg-green">Cerrado</small></span></a> &nbsp;
                <?php } ?>
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
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reporte a la Dian</h4>
        </div>
        <div class="modal-body">
     
     
        <form action="" method="POST" name="envioreportedian">
          <p>
            Seleccionar el periodo que desea reportar.
          </p>
          <div class="row">
            <div class="col-md-12">
             <!-- FECHA DE INICIO -->
              <div class="form-group">
                <label class="col-sm-2 text_titulos_dev"><span style="color:#ff0000;">*</span> Periodo </label>
                <div class="col-sm-5">
                <label><i class="fa fa-calendar"></i> Desde</label> 
                  <input type="text" name="feciniexp" readonly="readonly" class="form-control datepickerjo">                          
                </div><!-- col-md-5 -->
                <div class="col-sm-5">
                <label><i class="fa fa-calendar"></i> Hasta</label> 
                  <input type="text" name="fecfinexp" readonly="readonly" class="form-control datepickerjo"><br><br>
                </div> 
              <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                  <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                  <button type="submit" name="reportedian" class="btn btn-success">Guardar</button>
              </div>
              </div><!-- form-group -->
            </div><!-- col-md-12 -->
          </div><!-- ROW --> 
        </form>
      </div> <!-- modal body -->
      
    </div>  <!-- modal-dialog -->
  </div> <!-- modal fade -->

  <?php
  
  
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


 ?>
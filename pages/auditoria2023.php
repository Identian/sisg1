<?php
$nump10=privilegios(10,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump10) {	



$hostname_conexion2022 = "192.168.210.58";
$database_conexion2022 = "sisg";
$username_conexion2022 = "root";
$password_conexion2022 = "C0l0mb142019*";


$conexion2022 = mysql_pconnect($hostname_conexion2022, $username_conexion2022, $password_conexion2022); 
mysql_select_db($database_conexion2022, $conexion2022);



?>

 
	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  <div class="col-md-4">
    <h3  class="box-title">
	Auditoria hasta 31 dic 2023.
</h3>
	  </div>
<div class="col-md-8">		  
<form class="navbar-form" name="form1trterteg" method="post" action="">


<div class="input-group">
<div class="input-group-btn">
<select class="form-control" name="campo" required>
          <option value="" selected> - - Buscar por: - -  </option>
		   <option value="alias">Usuario CA</option>
 		  <option value="url" title="Última sección de la URL, despues de /">Contexto de URL</option>
		   <option value="descripcion_auditoria">Palabra clave</option>
		  </select>
</div><!-- /btn-group -->
<div class="input-group-btn"><input type="text" name="buscar" placeholder="Buscar Texto" class="form-control" required ></div>
    <!-- /input-group -->
<div class="input-group-btn">
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
</div>
</div>







</form>
</div>

  
  
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button>
</div> <!-- FINAL box-tools pull-right -->
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  
	  <?php
	  
if ((isset($_POST["buscar"])) && ("" != $_POST["buscar"]) or isset($_GET['i']))   { 

if (isset($_GET['i'])) {
$number=$_GET['i'];
$query = "SELECT * FROM auditoria2023 where url LIKE '%radicacion_curaduria&".$number.".jsp%' order by id_auditoria desc limit 1000";
} else {


$campo=$_POST["campo"];
$buscar=$_POST["buscar"];
$infobusqueda= " ".$_POST['campo']." like '%".$_POST['buscar']."%' ";


$query = "SELECT * FROM auditoria2023 where ".$infobusqueda." order by id_auditoria desc limit 1000";



}
$select = mysql_query($query, $conexion2022);
$row = mysql_fetch_assoc($select);
$total = mysql_num_rows($select);
echo $total.' registros.<br />';

if (1000<=$total) {
	echo '<h6>Se visualizan los últimos 1000 registros, si require más es necesario solicitar la busqueda formalmente.</h6>';
} else {}
	
if (0<$total) {
?>


 <table class="table" width="100%">
    
<thead>
<tr align='center' valign='middle'>
<th width="150">Fecha</th>
<th>Funcionario</th>
<th>Ip</th>
<th>Ip local</th>
<th>Url</th>
<th>Descripción</th>

</tr></thead>



<tbody>




<?php
do {
	echo '<tr>';
echo '<td>'.$row['fecha_hora'].'</td>';
echo '<td>'.$row['alias'].'</td>';
echo '<td>'.$row['ip'].'</td>';
echo '<td>'.$row['ip_local'].'</td>';
echo '<td>'.$row['url'].'</td>';
echo '<td>'.$row['descripcion_auditoria'].'</td>';
echo '</tr>';
} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);
echo '';
?>




                </tbody>
          
         </table>
		 
		 <?php 
		 
		 
} else {
	
	
	
}
} else {
	
	
	echo '<br><h4>Utilice la opción de busqueda.</h4>';
}
		 ?>
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div> <!-- FINAL DE ROW -->





<?php } else { }?>






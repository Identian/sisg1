<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
	require_once('../conf.php'); 

$idnot=intval($_POST['option']);
	

$query = "SELECT * FROM funcionario, notaria, posesion_notaria 
WHERE notaria.id_notaria=posesion_notaria.id_notaria 
and funcionario.id_funcionario=posesion_notaria.id_funcionario AND posesion_notaria.fecha_fin IS null 
and funcionario.id_funcionario=".$idnot." 
limit 1";

$actualizar55 = mysql_query($query, $conexion);
$row = mysql_fetch_assoc($actualizar55);
$idfunc=$row['id_funcionario'];
$idnota=$row['id_notaria'];
$rownotaria=$row['nombre_notaria'];
$rowname=$row['nombre_funcionario'];
$rowcedula=$row['cedula_funcionario'];
$codigo_dane=$row['codigo_dane'];
$numn=substr($codigo_dane, -2);
$email=$row['email_notaria'];
$dep=$row['id_departamento'];
$mun=$row['codigo_municipio'];
$foto=$row['foto_funcionario'];
$categoria2=$row['id_categoria_notaria'];
$codnotaria=$row['codigo_notaria'];
mysql_free_result($actualizar55);

echo '<div style="padding: 10px 30px 30px 30px">';
?>
<input type="hidden" name="id_funcionario2" value="<?php echo $idfunc; ?>">
<input type="hidden" name="id_notaria2" value="<?php echo $idnota; ?>">
<input type="hidden" name="id_categoria2" value="<?php echo $categoria2; ?>">
<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img src="files/<?php echo $foto; ?>" alt="Fotografia" style="max-width:300px;">
              </div>
              <!-- /.widget-user-image -->
			  <br>
              <h3 class="widget-user-username"><?php echo $rowname; ?></h3>
              <h5 class="widget-user-desc">Suplente</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="notaria&<?php echo $idnota?>.jsp" target="_blank">Notario <?php echo $rownotaria.' ('.$numn.')'; ?><span class="pull-right badge bg-blue"></span></a></li>
                <li><a><?PHP echo $email; ?><span class="pull-right badge bg-aqua"></span></a></li>
                <li><a>Notaria de <?PHP echo $categoria2; ?> categoria<span class="pull-right badge bg-green"></span></a></li>
             </ul>
            </div>
          </div>

	
<?php

echo '</div>';
} else {}

?>



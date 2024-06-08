<?php 
session_start();
if (isset($_POST['option']) and ""!=$_POST['option']) {
$ed=$_POST['option'];
require_once('../conf.php'); 

$queryop = sprintf("SELECT * FROM portal where id_portal=".$ed."");
$selectop = mysql_query($queryop, $conexion);
$row_update = mysql_fetch_assoc($selectop);
?>
<div style="padding: 10px 20px 20px 20px">


<div class="form-group text-left">
<h3><?php echo utf8_encode($row_update['titulo']); ?></h3>
</div>
<div class="form-group text-left"><h4>
<?php 
if (1==$row_update['actualizado']) {
echo $row_update['subtitulo']; 	
} else {
echo utf8_encode($row_update['subtitulo']); 
}?></h4>
</div>



<?php 
if ('Noticias'==$row_update['titulo']) { ?>
<div class="form-group text-left" style="background:#eee;border:1px solid #777;"> 
<?php 
echo '('.date('Y-m-d', strtotime($row_update['fecha_publicacion'])); 
echo ') <b>Resumen:</b> ';
echo $row_update['resumen']; ?>
</div>
<?php
} else { }?>


<div class="form-group text-left" > 
<?php 
if (1==$row_update['actualizado']) {
echo $row_update['nombre_portal']; 	
} else {
echo utf8_encode($row_update['nombre_portal']); 
}

mysql_free_result($selectop);


?>

</div>

</div>

<?php } else {} ?>
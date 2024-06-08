<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {

require_once('../conf.php'); 

$parametro=$_POST['option'];
$update100 = mysql_query("SELECT * FROM  invegar, inveest WHERE
 invegar.id_invegar=inveest.id_invegar and
 invegar.id_invegar='$parametro' and estado_invegar=1 order by inveest_feah Desc", $conexion) or die(mysql_error());
$row15 = mysql_fetch_assoc($update100);
$total55 = mysql_num_rows($update100);
if (0<$total55) {
 do { ?>
          
         <div class="tituloradius">
            <span class="time"><i class="fa fa-clock-o"></i> <?php echo $row15["inveest_feah"] ?>
             <?php $elemento=$row15["id_inveele"];
             $query = mysql_query("SELECT * FROM  inveele, invecon WHERE
              inveele.id_invecon=invecon.id_invecon and
              inveele.id_inveele='$elemento' and estado_inveele=1", $conexion) or die(mysql_error());
              $rowcont = mysql_fetch_assoc($query); ?>
              <h5 class="timeline-header" style="float:right;"><b>CONTRATISTA </b><?php echo $rowcont["invecon_cont"] ?></h5>
            </span>
		     </div>	
		      <div class="radius" >
            <div class="timeline-body">
                  <?php echo $row15["inveest_notic"] ?>
            </div>
          </div><br>
<?php
    } while ($row15 = mysql_fetch_assoc($update100)); 
 
  mysql_free_result($update100);


} else {}
} else {}
?>


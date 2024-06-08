<?php
$nump79=privilegios(78,$_SESSION['snr']);


if (1==$_SESSION['rol'] OR 0<$nump79) {


/*
$hostname_conexion2='192.168.80.16';
$database_conexioncc = 'intranet';
$username_conexioncc = 'intranetuser';
$password_conexioncc = 'Intr4n3t2022*';
*/


$hostname_conexion2='192.168.80.16';
$database_conexioncc = 'intranet';
$username_conexioncc = 'usrsisgintranet';
$password_conexioncc = 'U$er$1$g2.';




global $mysqlic;
$mysqlic = new mysqli($hostname_conexion2, $username_conexioncc, $password_conexioncc, $database_conexioncc);
if (mysqli_connect_errno()) {
    printf("error", $mysqlic->connect_error);
    exit();
}



function cantidaddechat($info) {
global $mysqlic;
$query4 = sprintf("select COUNT(*) as contadorac FROM wp_posts");  

$result4 = $mysqlic->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contadorac'];
return $res;
$result4->free();
}



function cantidaddeoperadores($info2) {
global $mysqlic;
$query4 = sprintf("SELECT count(*) as contadorop FROM wp_users where ID!=1"); 
$result4 = $mysqlic->query($query4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$res=$row4['contadorop'];
return $res;
$result4->free();
}



function listado($info) {	
global $mysqlic;
$query = "SELECT ID,user_login,user_email,meta_key,meta_value,user_url FROM wp_users
INNER JOIN wp_usermeta
ON wp_users.id = wp_usermeta.user_id
WHERE id!=1 AND meta_key='wp_capabilities'";
$result = $mysqlic->query($query);
while ($obj = $result->fetch_array()) {
$inf=explode(":",$obj['meta_value']);
if (0==$inf[1]) {
	$val='Inactivo';
} else {
	$val='Activo';
}

        printf ("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href='usuario&%s.jsp' target='_blank'>Ver perfil</td>
		</tr>", $obj['user_login'], $obj['user_email'], $obj['meta_value'], $val, $obj['user_url']);
    }

$result->free();
}




?>








<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<h3><?php echo cantidaddechat(1);
 ?>
 </h3>

              <p>Contenidos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> 
<?php echo cantidaddeoperadores(1); ?>
</h3>

              <p>Editores</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer" >Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
	   
	   
		
		
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
<?php echo $realdate; ?>
</h3>

              <p>Entrar </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
			
            <a href="http://www.supernotariado.gov.co/" target="_blank" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3>
<?php echo date('Y');  ?>
</h3>
              <p>Año</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="" target="_blank" class="small-box-footer" >Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
			
			
			
          </div>
        </div>
		
	 
      </div>







<div class="row">
 <div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-body">
<h3>INTRANET
</h3>
<hr>
<a href="https://intranet.supernotariado.gov.co/snradmin/" target="_blank" class="btn btn-xl btn-success">Acceder</a>
<hr>

<h3>Usuarios con acceso</h3>
<table class="table">

<?php echo listado('1'); ?> 
</table>



<hr>









</div>
</div>
</div>
</div>

<?php } ?>

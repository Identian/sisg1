<?php 
 if (1==$_SESSION['rol'] && 1==$_SESSION['snr_tipo_oficina']) {
$id=395;
$repo=1;
 } else if (3==$_SESSION['snr_tipo_oficina']) {
$id=$_SESSION['id_vigilado'];
$repo=privilegiosnotariado($id, 10, $_SESSION['snr']);
 }
 else {
	$id=''; 
	 $repo='';
 }
 
  $nump112=privilegios(112,$_SESSION['snr']);
  
if ((3==$_SESSION['snr_tipo_oficina'] and 1==$_SESSION['snr_grupo_cargo']) or 1==$_SESSION['rol'] or 0<$repo or 0<$nump112) {
 
 

 
 if (1==$_SESSION['rol'] or 0<$nump112) {
$notariotitular=5706;
$query = "SELECT * FROM notaria, posesion_notaria, funcionario   
WHERE notaria.id_notaria=posesion_notaria.id_notaria 
AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND posesion_notaria.fecha_fin IS NULL 
AND estado_notaria=1 
AND estado_funcionario=1 
AND estado_posesion_notaria=1 
AND cump_val_digitalizacion='Si' 
and funcionario.id_funcionario=".$notariotitular." 
limit 1";
 } else {
if (3==$_SESSION['snr_tipo_oficina'] and 1==$_SESSION['snr_grupo_cargo']) {
$notariotitular=$_SESSION['snr'];
$query = "SELECT * FROM notaria, posesion_notaria, funcionario   
WHERE notaria.id_notaria=posesion_notaria.id_notaria 
AND posesion_notaria.id_funcionario=funcionario.id_funcionario 
AND posesion_notaria.fecha_fin IS NULL 
AND estado_notaria=1 
AND estado_funcionario=1 
AND estado_posesion_notaria=1 
AND cump_val_digitalizacion='Si' 
and funcionario.id_funcionario=".$notariotitular." 
limit 1";	
	} else {
$empleado=$_SESSION['snr'];	
$query = "SELECT * FROM notaria, funcionario   
WHERE notaria.id_notaria=funcionario.id_notaria_f 
AND estado_notaria=1 
AND estado_funcionario=1 
AND cump_val_digitalizacion='Si' 
and funcionario.id_funcionario=".$empleado." 
limit 1";
	}		
 }
 
 
	


$actualizar55 = mysql_query($query, $conexion);
$rowp = mysql_fetch_assoc($actualizar55);
$totalRows = mysql_num_rows($actualizar55);

if (0<$totalRows) {
$rol=2;
$id_funci=$rowp['id_funcionario'];
$llave_token=$rowp['llave_token'];
$api_user=$rowp['api_user'];
$api_key=$rowp['api_key'];
$rownotaria=$rowp['nombre_notaria'];
$rowname=$rowp['nombre_funcionario'];
$rowcedula=$rowp['cedula_funcionario'];
$codigo_dane=$rowp['codigo_dane'];
$email=$rowp['email_notaria'];
$id=$rowp['id_notaria'];
$dep=$rowp['id_departamento'];
$mun=$rowp['codigo_municipio'];
$cump_val_digitalizacion=$rowp['cump_val_digitalizacion'];

$id_tipo_oficina=$rowp['id_tipo_oficina'];

//$id_tipo_oficina=$_SESSION['snr_tipo_oficina'];


mysql_free_result($actualizar55);
?>

	
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
		
		<div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Digitalización<br>Notarial</span>


              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
				  <?php
	// ambiente   1: producción    2: pruebas
	
	//id_tipo_oficina   1: Es analista, no pueden salir botones de creación
	//                  3:  es Notario,  sale todo
	
	

function token($ambiente,$iduser,$llave,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email){
       
       $cabecera = array('typ' => 'JWT', 'alg' => 'HS256');
        $cabecera = json_encode($cabecera);
        $cabecera = base64_encode($cabecera);
        $data = array('iss' => 'SNR', 'ambiente' => $ambiente, 'admin'=>0, 'id_funcionario' => ''.$iduser.'', 'nombre_funcionario' => ''.$rowname64.'', 'id_departamento' => ''.$dep.'', 'codigo_municipio' => ''.$mun.'', 'id_tipo_oficina' => ''.$id_tipo_oficina.'', 'id_notaria' => ''.$id.'', 'nombre_notaria' => ''.$rownotaria64.'', 'dane' => ''.$codigo_dane.'', 'correo' => ''.$email.'');
        $data = json_encode($data);
        $data = base64_encode($data);
        $firma = hash_hmac('sha256', "$cabecera.$data", $llave);
        $token = "$cabecera.$data.$firma";
      //52.184.219.189      40.70.170.37      52.251.65.16   https://www.digitalizacionnotarial.gov.co
	   $final= '<form action="https://www.digitalizacionnotarial.gov.co/token" method="post" target="_blank">
                <input type="hidden" name="token" value="'.$token.'" />
                <input type="submit" value="Acceder" class="btn btn-xs btn-default" style="width:100%">
                </form>'; 
return $final;				
    }
	
	$ambiente='1';
	$rowname64=base64_encode($rowname);
	$rownotaria64=base64_encode($rownotaria);
	echo token($ambiente,$id_funci,$llave_token,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email);
	
	
				  ?>
             
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  
      
          <!-- /.info-box -->
        </div>
     
	 
	 
	 <div class="col-md-3 col-sm-6 col-xs-12">
          
		  
		   <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TEST Digit.<br>Notarial</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                 <span class="progress-description">
                	  <?php
					  
					  
					  
function tokentest($ambientep,$iduser,$llave,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email){
       
       $cabecera = array('typ' => 'JWT', 'alg' => 'HS256');
        $cabecera = json_encode($cabecera);
        $cabecera = base64_encode($cabecera);
        $data = array('iss' => 'SNR', 'ambiente' => $ambientep, 'admin'=>0, 'id_funcionario' => ''.$iduser.'', 'nombre_funcionario' => ''.$rowname64.'', 'id_departamento' => ''.$dep.'', 'codigo_municipio' => ''.$mun.'', 'id_tipo_oficina' => ''.$id_tipo_oficina.'', 'id_notaria' => ''.$id.'', 'nombre_notaria' => ''.$rownotaria64.'', 'dane' => ''.$codigo_dane.'', 'correo' => ''.$email.'');
	   $data = json_encode($data);
        $data = base64_encode($data);
        $firma = hash_hmac('sha256', "$cabecera.$data", $llave);
        $token = "$cabecera.$data.$firma";
		
		
   $final= '<form action="http://test.digitalizacionnotarial.gov.co/token" method="post" target="_blank">
                <input type="hidden" name="token" value="'.$token.'">
                <input type="submit" value="Acceder" class="btn btn-xs btn-default" style="width:100%">
                </form>'; 
return $final;				
    }
	
	$ambientep='2';
//https://www.digitalizacionnotarial.gov.co/token2
	echo tokentest($ambientep,$id_funci,$llave_token,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email);
	
	
	

				  ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		
		
	 
	 
        <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box bg-red">
            <span class="info-box-icon">
			<!--<img src="images/vur.png" style="width:80%;">-->
			<i class="fa fa-file"></i>
			</span>

            <div class="info-box-content">
              <span class="info-box-text">SIN Calidad</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
				  <?php
	// ambiente   1: producción    2: pruebas
	
	//id_tipo_oficina   1: Es SNR
	//                  3: Es Notaria,  
	
// ROl:   1: Administrador
//        2: Notario
//        3: Empleado de notaria
//        4 Cliente



if (1==$_SESSION['rol'] or 0<$nump112) {

function token3($ambiente,$rol,$iduser,$llave,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email){
       
       $cabecera = array('typ' => 'JWT', 'alg' => 'HS256');
        $cabecera = json_encode($cabecera);
        $cabecera = base64_encode($cabecera);
        $data = array('iss' => 'SNR', 'ambiente' => $ambiente, 'rol'=> $rol, 'id_funcionario' => ''.$iduser.'', 'nombre_funcionario' => ''.$rowname64.'', 'id_departamento' => ''.$dep.'', 'codigo_municipio' => ''.$mun.'', 'id_tipo_oficina' => ''.$id_tipo_oficina.'', 'id_notaria' => ''.$id.'', 'nombre_notaria' => ''.$rownotaria64.'', 'dane' => ''.$codigo_dane.'', 'correo' => ''.$email.'');
        $data = json_encode($data);
        $data = base64_encode($data);
        $firma = hash_hmac('sha256', "$cabecera.$data", $llave);
        $token = "$cabecera.$data.$firma";
 
	   $final= '<form action="https://digitalizacionnotarial.gov.co/sin/api/token" method="post" target="_blank">
                <input type="hidden" name="token" value="'.$token.'" />
                <input type="submit" value="Acceder" class="btn btn-xs btn-default" style="width:100%">
                </form>'; 
				  //http://192.168.86.28/sin
				////http://test.digitalizacionnotarial.gov.co/proyecto/sin/api/token
return $final;				
    }
	
	$ambiente='1';
	$rowname64=base64_encode($rowname);
	$rownotaria64=base64_encode($rownotaria);
	echo token3($ambiente,$rol,$id_funci,$llave_token,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email);
	
	
} else { }
	
				  ?>
             
                  </span>
				  
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SIN Preproducción</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
				  
             <?php
	// ambiente   1: producción    2: pruebas
	
	//id_tipo_oficina   1: Es SNR
	//                  3: Es Notaria,  
	
// ROl:   1: Administrador
//        2: Notario
//        3: Empleado de notaria
//        4 Cliente



if (1==$_SESSION['rol'] or 0<$nump112) {

function token34($ambiente,$rol,$iduser,$llave,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email){
       
       $cabecera = array('typ' => 'JWT', 'alg' => 'HS256');
        $cabecera = json_encode($cabecera);
        $cabecera = base64_encode($cabecera);
        $data = array('iss' => 'SNR', 'ambiente' => $ambiente, 'rol'=> $rol, 'id_funcionario' => ''.$iduser.'', 'nombre_funcionario' => ''.$rowname64.'', 'id_departamento' => ''.$dep.'', 'codigo_municipio' => ''.$mun.'', 'id_tipo_oficina' => ''.$id_tipo_oficina.'', 'id_notaria' => ''.$id.'', 'nombre_notaria' => ''.$rownotaria64.'', 'dane' => ''.$codigo_dane.'', 'correo' => ''.$email.'');
        $data = json_encode($data);
        $data = base64_encode($data);
        $firma = hash_hmac('sha256', "$cabecera.$data", $llave);
        $token = "$cabecera.$data.$firma";
   
	   $final= '<form action="http://192.168.86.36/sin/api/token" method="post" target="_blank">
                <input type="hidden" name="token" value="'.$token.'" />
                <input type="submit" value="Acceder" class="btn btn-xs btn-default" style="width:100%">
                </form>'; 
				////http://test.digitalizacionnotarial.gov.co/proyecto/sin/api/token
return $final;				
    }
	
	$ambiente='1';
	$rowname64=base64_encode($rowname);
	$rownotaria64=base64_encode($rownotaria);
	echo token34($ambiente,$rol,$id_funci,$llave_token,$rowname64,$dep,$mun,$id_tipo_oficina,$id,$rownotaria64,$codigo_dane,$email);
	
	
} else { }
	
				  ?>
				  
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
<!-- /.row-->
	  <?php 
	  
	  
	   } else {}
	  } else {} ?>



<?php if (3>$_SESSION['snr_tipo_oficina']) { ?>
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Correo electrónico</span>
<span class="info-box-number"><a href="https://www.office.com/" target="_blank">Acceder</a></span>
</div>

</div>

</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Certificaciones laborales</span>
<span class="info-box-number"><a href="https://certnomina.supernotariado.gov.co/rhweb/autenticarusuario_2.php" target="_blank">Acceder</A></span>
</div>

</div>

</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Capacitaciones</span>
<span class="info-box-number"><a href="https://capacitacion.supernotariado.gov.co/" target="_blank">Acceder</A></span>
</div>

</div>

</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Inscripción a Gimnasio para SNR</span>
<span class="info-box-number"><a href="gimnasio.jsp" target="_blank">Acceder</A></span>
</div>

</div>

</div>

</div>

<?php } else {} ?>




















<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
<h3><?php $actualizar55 = mysql_query("SELECT count(id_solicitud_pqrs) as tota FROM solicitud_pqrs where estado_solicitud_pqrs=1", $conexion);
$row155 = mysql_fetch_assoc($actualizar55);
echo $row155['tota'];
mysql_free_result($actualizar55);
 ?>
 </h3>

              <p>Total de PQRS</p>
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
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3> 
<?php $actualizar55c = mysql_query("SELECT COUNT(id_funcionario) as totac FROM funcionario where estado_funcionario=1", $conexion);
$row155c = mysql_fetch_assoc($actualizar55c);
echo $row155c['totac'];
mysql_free_result($actualizar55c);
 ?>
</h3>

              <p>Usuarios</p>
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
<?php $actualizar55cal = mysql_query("SELECT COUNT(id_licencia_curaduria) as totacal FROM licencia_curaduria where estado_licencia_curaduria=1 and situacion_licencia=1", $conexion);
$row155cal = mysql_fetch_assoc($actualizar55cal);
echo $row155cal['totacal'];
mysql_free_result($actualizar55cal);
 ?>
</h3>

              <p>Licencias urbanisticas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
			
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
          </div>
        </div>
     
	 
	 
	  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
<h3>
<?php $actualizar55calc = mysql_query("SELECT COUNT(id_ciudadano) as totacalc FROM ciudadano where estado_ciudadano=1", $conexion);
$row155calc = mysql_fetch_assoc($actualizar55calc);
echo $row155calc['totacalc'];
mysql_free_result($actualizar55calc);
 ?>
</h3>
              <p>Ciudadanos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer" >Más info. <i class="fa fa-arrow-circle-right"></i></a>
			
			
			
			
          </div>
        </div>
		
	 
      </div>




 <div class="row">
  <div class="col-md-12">
  <div class="info-box">
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="orips.jsp" >
                <span class="badge bg-green" ><i class="fa fa-check"> 195</i></span>
                <i class="fa fa-bar-chart"></i> ORIP
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="notarias.jsp" >
                <span class="badge bg-green" ><i class="fa fa-check"> <?php  echo existencia('notaria'); ?></i></span>
                <i class="fa fa-bar-chart"></i> Notarias
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="curadurias.jsp">
                <span class="badge bg-green"><i class="fa fa-check"> <?php  echo existencia('curaduria'); ?></i></span>
                <i class="fa fa-bar-chart"></i> Curadurias
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="pqrs_central.jsp">
                <span class="badge bg-green"><i class="fa fa-check"> 18</i></span>
                <i class="fa fa-bar-chart"></i> Areas - NC
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="directorio.jsp">
                <span class="badge bg-green"><i class="fa fa-check"> </i></span>
                <i class="fa fa-bar-chart"></i> Grupos
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="mapa_orips.jsp">
                <span class="badge bg-green"><i class="fa fa-check"> 5</i></span>
                <i class="fa fa-bar-chart"></i> Direcciones regionales
              </a>
</div>
			  </div>
			   </div>
			  </div>
			  
			  


<!--  
<div class="row">

<div class="col-md-3">
<a href="orips.jsp">
<div class="info-box">
<span class="info-box-icon bg-primary"><i class="fa fa-building"></i></span>
<div class="info-box-content">
<span>ORIP</span>
<span class="info-box-number">195</span>
</div>
<hr style="width:60%;">
</div>
</a>
</div>

<div class="col-md-3">
<a href="notarias.jsp">
<div class="info-box">
<span class="info-box-icon bg-primary"><i class="fa fa-bank"></i></span>
<div class="info-box-content">
<span>Notarias</span>
<span class="info-box-number">907</span>
</div>
<hr style="width:60%;">
</div>
</a>
</div>


<div class="col-md-3">
<a href="pqrs_central.jsp">
<div class="info-box">
<span class="info-box-icon bg-primary"><i class="fa fa-spinner"></i></span>
<div class="info-box-content">
<span>Áreas en Nivel central</span>
<span class="info-box-number">24</span>
</div>
<hr style="width:60%;">
</div>
</a>
</div>
<div class="col-md-3">
<a href="curadurias.jsp">
<div class="info-box">
<span class="info-box-icon bg-primary"><i class="fa fa-building-o"></i></span>
<div class="info-box-content">
<span>Curadurias</span>
<span class="info-box-number">74</span>
</div>
<hr style="width:60%;">
</div>
</a>
</div>

</div>

-->





	  
	  

<div class="row">
<div class="col-md-4" >



<div class="box box-solid">
            <div class="box-header with-border">
            

              <h3 class="box-title">Novedades:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<center>
			Carnét digital<br>
 <a href="files/portal/intranet/portal-manual_carnet_digital.pdf" target="_blank">

<img src="files/portal/intranet/portal-imagen_carnet_digital.png" style="width:300px;"></a>


			</center>
			


 </div>
 
 </div>


<div class="box box-solid">
            <div class="box-header with-border">
            

              <h3 class="box-title">Sistemas de apoyo de la SNR:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			
              <ul>
 
	<!-- fuera http://190.145.190.156:7778/rhweb/autenticarusuario_2.php
	Dentro http://192.168.40.7:7778/rhweb/autenticarusuario_2.php-->



	  
<li><a class="nav-item nav-link" href="https://www.vur.gov.co/siteminderagent/forms_es-ES/loginsnr.fcc?TARGET=-SM-http%3a%2f%2fwww%2evur%2egov%2eco%2fportal%2f" target="_blank">Vur</a></li>
<?php if (1==$_SESSION['snr_tipo_oficina']) { ?>
<li> 
<a class="nav-item nav-link" href="https://sid.supernotariado.gov.co/"  target="_blank">SID: Control Disciplinario</a> 
</li>
<?php } else {} ?>
<li>HOLISTICA INVENTARIOS: <a class="nav-item nav-link" href="https://inventarios.supernotariado.gov.co/metastorm/#"  target="_blank">Fuera de SNR</a> /
<a class="nav-item nav-link" href="http://hgfi/Metastorm/default.aspx#"  target="_blank">Dentro de SNR</a> (Utilizar Explorer)<br>
<li><a class="nav-item nav-link" href="https://www.abcpagos.com/supernotariado/"  target="_blank">Recaudo Notarial</a><br>
<li> <a class="nav-item nav-link" href="https://www.abcpagos.com/instrumentos_publicos/cliente/" target="_blank">Derechos de registro</a></li>
 <li><a class="nav-item nav-link" href="https://exentos.supernotariado.gov.co/" target="_blank">Certificados Exentos</a></li>
<li> <a class="nav-item nav-link" href="https://radicacion.supernotariado.gov.co/app/" target="_blank">Radicación electrónica</a></li>
<li> <a class="nav-item nav-link" href="https://traditicios.supernotariado.gov.co/Sidt/" target="_blank">Estudios traditicios.</a></li>


<?php if (1==$_SESSION['snr_tipo_oficina']) { ?>
<!--<li>Sistema de personal y nómina: 
<a class="nav-item nav-link" href="http://190.145.190.156:7778/rhweb/autenticarusuario.php" target="_blank">Fuera de SNR</a></li>
 / <a class="nav-item nav-link" href="http://192.168.40.7:7778/rhweb/autenticarusuario_2.php" target="_blank">Dentro de SNR</a></li>
 
 <li><a class="nav-item nav-link" href="https://estadotramiteciud.supernotariado.gov.co/" target="_blank">Estado de tramites de Registro</a></li>
 
<li><a class="nav-item nav-link" href="https://certnomina.supernotariado.gov.co/rhweb/autenticarusuario_2.php" target="_blank">Certificaciones y desprendibles de Nomina</a></li>-->


<li> 
<a class="nav-item nav-link" href="https://procesos.supernotariado.gov.co/siprojweb2/" target="_blank">SIPROJWEB Procesos judiciales</a>
</li>
<li> 
<a class="nav-item nav-link" href="https://procesos.supernotariado.gov.co/Sidweb/" target="_blank">SIDWEB Sistema Digital Web</a>
</li>

<?php } else {}?>

<!--
clarity-->


              </ul>
            </div>
			
			


 </div>
	  
	  
</div>





<div class="col-md-8" >
<div class="box" >
<div class="text-left"  >
<div class="panel-body">
<a href="files/portal/portal-guia_innovacion.pdf" target="_blank">
<img src="files/portal/portal-innovacion.jpg" style="width:100%">
</a>

<?php


/*

$query = sprintf("SELECT * FROM banner_portal WHERE publicado=1 and activo=1 and estado_banner_portal=1 limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
//	echo $row['enlace'];
	echo '<a href="'.$row['enlace'].'" target="_blank"><img src="files/portal/'.$row['nombre_banner_portal'].'" style="width:100%;"></a>';

	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);

echo '<h4>https://www.supernotariado.gov.co</h4>';

*/

?>
<!--
Señor Notario(a), recuerde que las credenciales de acceso a SISG, son las mismas de VUR; en ese sentido si requiere recordar o cambiar su usuario y clave de acceso 
debe escribir a: <a href="mailto:mesadeayudavur@Supernotariado.gov.co">mesadeayudavur@Supernotariado.gov.co</a>

<br>
<br>
Actualmente la SNR esta implementando la actualización de SIN e instalación del componente web de facturación electrónica para las Notarias que utilizan SIN.
<br>De acuerdo con lo anterior, el manual se encuentra en la dirección web: <a href="https://sisg.supernotariado.gov.co/documentos/Manual_FE.html" target="_blank">https://sisg.supernotariado.gov.co/documentos/Manual_FE.html</a>
<br>La circular 609 del 2020 describe la actualización del sistema de información Notarial (SIN) - e 
implementación del módulo de facturación electrónica: <a href="https://www.supernotariado.gov.co/files/snrcirculares/circular-254-20200921132101.pdf" target="_blank">Ver</a>.
<br>
<br>

<br><br><br>



<video controls  loop poster="documentos/apoyon.png" style="width:95%;">
  <source src="https://sisg.supernotariado.gov.co/documentos/apoyo.mp4" type="video/mp4">
</video>
<div id="chart"></div>-->

</div>
</div>
</div>	
  </div>
  
   </div>
<!--
	  
<div class="row">
       
	   
	   	        <div class="col-md-4" >
				   <div class="box" style="min-height:300px;">
				 
				 <center><a href="https://sisg.supernotariado.gov.co/images/SISG-presenta.mp4" target="_blank"><img src="images/logvideo.jpg" style="width:100%;max-width:360px;min-height:280px;"></a></center>
				 
    </div>
        </div>
		
	   
	   
	           <div class="col-md-4">
			   
			   
			   <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Grupos en nivel central</span>
              <span class="info-box-number">
			  <?php	//echo existencia('grupo_area'); ?>
			  
			  </span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    - - - - 
                  </span>
            </div>
           
          </div>
		  
		  
		  
		  
		  
		  <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Notarias</span>
              <span class="info-box-number">  <?php	//echo existencia('notaria'); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    - - - - -
                  </span>
            </div>
        
          </div>
		  
		  
		  
		  
		  <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Curadurias</span>
              <span class="info-box-number">  <?php	//echo existencia('curaduria'); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                  - - - - - - 
                  </span>
            </div>
       
          </div>

  
 
        </div>
		
		
	
		
		
	   
	    <div class="col-md-4">


            <div class="widget-user-header bg-yellow">
              
			<div class="widget-user-image">
			<img class="img-circle" src="images/avatar.png">
              </div>
              <h3 class="widget-user-username"><?php //echo $_SESSION['snr_nombre']; ?></h3>
              <h5 class="widget-user-desc">
			  
			  
			    <?php 
				/*
						   if (1==$_SESSION['snr_tipo_oficina']) { 
						   
						     echo quees('area', $_SESSION['snr_area']); 
							  echo '<br>';
						      echo quees('grupo_area', $_SESSION['snr_grupo_area']); 
							  
						   } else if (2==$_SESSION['snr_tipo_oficina']) {
						   echo quees('oficina_registro', $_SESSION['id_oficina_registro']); 
						   } else {
                          echo quees('tipo_oficina', $_SESSION['snr_tipo_oficina']);							   
						   }
 */
						   ?>
						   
			  </h5>
			  
		  

            </div>
			

			<div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Tramites <span class="pull-right badge bg-green">0</span></a></li>
                <li><a href="#">Mensajes <span class="pull-right badge bg-red">0</span></a></li>
                <li><a href="#">Notificaciones <span class="pull-right badge bg-red">0</span></a></li>
			  </ul>
			   </div>
			 
           
          </div>
 
        </div>
		
		
		
 
 -->
 
 
 <div class="row">

 
 <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">De interes</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
           
              </div>
            </div>
          
		  <div class="box-body">
              <ul class="products-list product-list-in-box">
			  
			 <!-- 
			   <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="documentos/res-orip-covid.pdf" target="_black" class="product-title">Horario especial para Oficinas de Instrumentos Públicos

                      <span class="label label-warning pull-right">Descargar</span></a>
                    <span class="product-description">
                        Resolución 	02871 de 2020
                        </span>
                  </div>
                </li>
				
				 <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="documentos/res-notariado-covid.pdf" target="_black" class="product-title">Horario especial para Notarias

                      <span class="label label-warning pull-right">Descargar</span></a>
                    <span class="product-description">
                           Resolución 02872 de 2020
                        </span>
                  </div>
                </li>
				
				
			  -->


			  
			  
			  
			  
			  
	      <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="documentos/circular-319-2020.pdf" target="_black" class="product-title">Cicular 319 - Lineamientos Internos para la contención del Virus COVID-19

                      <span class="label label-warning pull-right">Descargar</span></a>
                    <span class="product-description">
                         De Secretaria General de la Superintendencia. 
                        </span>
                  </div>
                </li>
				
				
				    <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="documentos/circular-320-2020.pdf" target="_black" class="product-title">Información de interes - Notificaciones
                      <span class="label label-warning pull-right">Descargar</span></a>
                    <span class="product-description">
                         De la Oficina Asesora Jurídica
                        </span>
                  </div>
                </li>
				
				
	  
	  
	    <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="documentos/CIRCULAR_3508_2019_salida_menores.pdf" target="_black" class="product-title">Circular 3508 de 2019
                      <span class="label label-warning pull-right">Descargar</span></a>
                    <span class="product-description">
                         Salida de menores del pais.
                        </span>
                  </div>
                </li>
	  
	  
	  
	  
	  
	  
			  
			    <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="images/RES_10164.pdf" target="_black" class="product-title">Grupo interno de trabajo para el control y vigilancia de Curadores Urbanos
                      <span class="label label-warning pull-right">Descargar</span></a>
                    <span class="product-description">
                         Resolución 10164 del 27 de Agosto de 2018 
                        </span>
                  </div>
                </li>
              
			  
		
				
		
			  
			  
			  
			  <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="images/RESOLUCION_8103-2018.pdf" target="_black" class="product-title">Repositorio de licencias Urbanisticas
                      <span class="label label-warning pull-right">Descargar</span></a>
                    <span class="product-description">
                         Resolución 8103 del 12 de Julio del 2018 
                        </span>
                  </div>
                </li>
              
				
				
				
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="images/Estructura_SNR.pdf" target="_black" class="product-title">Organigrama SNR
                      <span class="label label-warning pull-right">Descargar</span></a>
                    <span class="product-description">
                         Decreto 2723 del 29 de diciembre del 2014 / Resolución 2863 del 16 de marzo de 2018.
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="images/Resolucion_grupos.pdf" target="_black" class="product-title">Grupos internos de trabajo
                      <span class="label label-info pull-right">Descargar</span></a>
                    <span class="product-description">
                          Resolución 2864 de 16 de marzo del 2018.
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/mano.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="images/Estructura14_snr.pdf" target="_black" class="product-title">Estructura de la SNR <span
                        class="label label-danger pull-right">Descargar</span></a>
                    <span class="product-description">
                          Decreto 2723 del 29 de diciembre de 2014.
                        </span>
                  </div>
                </li>
                <!-- /.item -->
 
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="http://intranet.supernotariado.gov.co" target="_black" class="uppercase"> + Más información </a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>



<?php
if (24==$_SESSION['snr_grupo_area'] or 1==$_SESSION['rol']) {
$date= date('Y-m-j H:i:s'); 
$newDater = strtotime ( '-2 hour' , strtotime ($date) ) ;  
$newDate = date ('Y-m-d H:i:s' , $newDater); 
//echo $newDate;
$updateSQL7887 = "UPDATE solicitud_pqrs SET id_estado_solicitud=2 
	WHERE id_estado_solicitud=1 and fecha_radicado<'$newDate' and id_canal_pqrs=1 and estado_solicitud_pqrs=1";
$Result17788 = mysql_query($updateSQL7887, $conexion);
mysql_free_result($Result17788);
} else {   }





if (3>$_SESSION['snr_tipo_oficina']) {



function cuentadir($funci) {
global $mysqli;
$query4 = sprintf("SELECT count(id_funcionario) as contador FROM funcionario where direccion_sigep is null and id_funcionario=".$funci." "); 
$result4 = $mysqli->query($query4);
$row4 = $result4->fetch_array();
$res=$row4['contador'];
return $res;
$result4->free();
}


$cuentaf=cuentadir($_SESSION['snr']);
if (0<$cuentaf) { 




$li=array( 
 'tipoDocumento'=>'CEDULA DE CIUDADANIA',
 'numerodocumento'=>$_SESSION['cedula_funcionario']);
	 
$ws=json_encode($li);

$datos=base64_encode($ws);

$aacurl = curl_init();

curl_setopt_array($aacurl, array(
  CURLOPT_URL => 'http://192.168.80.110/r1/CO/GOB/DAFP-0022/SIGEP/wsAutenticacion',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'ewogICJub21icmVVc3VhcmlvIjogIjc5ODY4NTEyIiwKICAiY29udHJhc2VuYUUiOiAiMUo4N0tNZlF1dSt2cnY0RUJ0TkpDQT09IiwKICAiY29kaWdvU2lnZXAiOiAiMDAyNyIKfQ==',
  CURLOPT_HTTPHEADER => array(
    'Accept: text/plain',
    'Content-Type: text/plain',
    'typeResponse: json',
    'x-road-client: CO/GOB/SNR-0027/FM-SIR',
    'Cookie: .AspNet.Cookies=atUeqeP2EfWCoxlaziLJN_DLBc2v4ZO5tnF9WzatksJqozTBJ8w-pGWyxUatX0Sa3Pt0t-sU7WkDjsOWCHiy3nDeA4GXmTjNnbHv9ueml5uIWbPz1Atz6Yoyfcsp2bZcZXSJYINoiVVXTi0pMH4b84bG4GBzh9WIUEjoRiK01-TRaO9DTsFsS2kCewySjrN1ZG5vodagF1iqAAGPvfEa3z9ioggEyvm2OCmrkGC4Xezl_uSh2kZQ_shAqrkNwCD0MiaLc4ItUMV_pGhN8zc3pFHIEj7xr_qLW1IKiBhQKqYVIihV7MlQ8PnlLxn4tH4kv2P2rV7a1F6vVcuA-zSqHliMXHLGJ_FFN3z1M3LBeFQ3h6Jm0QT7ov3Aiw3YnMTgr3zNaZohQ_Gpph_OR4n76XEKgfhInBAk4suXX1ut1hGdYhSWuODokudNeSGwMy-nJUk83UFGpJMmBAh5J953nQCLG0Y5XkpYimjmW8JfOuJZbDRzmhsoys5LpXF3XnLyHaJLEjV1zi-bhoSs3XjPGQ'
  ),
));

$aaresponse = curl_exec($aacurl);

curl_close($aacurl);

$aaresponses=base64_decode($aaresponse);

$obje=json_decode($aaresponses);

$clave= $obje->autenticacion->token;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.80.110/r1/CO/GOB/DAFP-0022/SIGEP/wsConsultaHojaVida',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: text/plain',
    'Content-Type: text/plain',
    'typeResponse: json',
    'x-road-client: CO/GOB/SNR-0027/FM-SIR',
    'token: '.$clave.'',
    'json: '.$datos.'',
    'Cookie: .AspNet.Cookies=atUeqeP2EfWCoxlaziLJN_DLBc2v4ZO5tnF9WzatksJqozTBJ8w-pGWyxUatX0Sa3Pt0t-sU7WkDjsOWCHiy3nDeA4GXmTjNnbHv9ueml5uIWbPz1Atz6Yoyfcsp2bZcZXSJYINoiVVXTi0pMH4b84bG4GBzh9WIUEjoRiK01-TRaO9DTsFsS2kCewySjrN1ZG5vodagF1iqAAGPvfEa3z9ioggEyvm2OCmrkGC4Xezl_uSh2kZQ_shAqrkNwCD0MiaLc4ItUMV_pGhN8zc3pFHIEj7xr_qLW1IKiBhQKqYVIihV7MlQ8PnlLxn4tH4kv2P2rV7a1F6vVcuA-zSqHliMXHLGJ_FFN3z1M3LBeFQ3h6Jm0QT7ov3Aiw3YnMTgr3zNaZohQ_Gpph_OR4n76XEKgfhInBAk4suXX1ut1hGdYhSWuODokudNeSGwMy-nJUk83UFGpJMmBAh5J953nQCLG0Y5XkpYimjmW8JfOuJZbDRzmhsoys5LpXF3XnLyHaJLEjV1zi-bhoSs3XjPGQ'
  ),
));

$response1 = curl_exec($curl);

curl_close($curl);

$response= base64_decode($response1);

$obj=json_decode($response);

$celu=$obj->hojaVidaPersona->datoContato->numCelular;

$dire=$obj->hojaVidaPersona->datoContato->direccionResidencia;

$nacim=$obj->hojaVidaPersona->fechaNacimiento;

$correoalt=$obj->hojaVidaPersona->correoElectronico;

//echo $celu.$dire.$nacim.$correoalt;

$infon=explode("/",$nacim);
$datenacim=$infon[2].'-'.$infon[1].'-'.$infon[0];




$updateSQL78879 = "UPDATE funcionario SET celular_funcionario='$celu' WHERE celular_funcionario is null and id_funcionario=".$_SESSION['snr']."";
$Result17788 = mysql_query($updateSQL78879, $conexion);

$updateSQL788791 = "UPDATE funcionario SET direccion_sigep='$dire' WHERE direccion_sigep is null and id_funcionario=".$_SESSION['snr']."";
$Result17788 = mysql_query($updateSQL788791, $conexion);

$updateSQL788792 = "UPDATE funcionario SET fecha_nacimiento='$datenacim' WHERE fecha_nacimiento is null and id_funcionario=".$_SESSION['snr']."";
$Result17788 = mysql_query($updateSQL788792, $conexion);

$updateSQL788793 = "UPDATE funcionario SET correo_personal='$correoalt' WHERE correo_personal is null and id_funcionario=".$_SESSION['snr']."";
$Result17788 = mysql_query($updateSQL788793, $conexion);




} else { }
	
	




} else {   }






?>



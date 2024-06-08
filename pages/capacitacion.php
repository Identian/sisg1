<?php
if (1==2) {

echo '	
<form class="login-form" action="https://capacitacion.supernotariado.gov.co/login/index.php" method="post" id="login">
        <input type="hidden" name="logintoken" value="e02cPvPbjmAbVNZvvvf1OSwxK5Xk31Du">
        <div class="login-form-username form-group" >
            <label for="username" class="sr-only">
                    Username
            </label>
            <input type="text" name="username" id="username" class="form-control form-control-lg" value="" placeholder="Username" autocomplete="username">
        </div>
        <div class="login-form-password form-group" >
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" value="" class="form-control form-control-lg" placeholder="Password" autocomplete="current-password">
        </div>
        <div class="login-form-submit form-group">
            <button class="btn btn-primary btn-lg" type="submit" id="loginbtn">Ingreso moodle</button>
        </div>
        
    </form>
	';
	}else {}
?>


<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
<div class="col-md-6">
<img src="files/portal/intranet/portal-vicky_sisg1.png" style="max-width:400px;width:100%">
</div>
<div class="col-md-6">
<br>
<h2>Hola <?php echo $_SESSION['snr_nombre']; ?>, aqui puedes entrar al sistema de capacitación de la SNR.</h2>
<br><br>


	
	

	
	
	
	
	<form class="login-form" action="https://capacitacion.supernotariado.gov.co/login/index.php" method="post" id="login" target="_blank">
      
     
            <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['usuariomoodle']; ?>">   
     

            <input type="hidden" name="password" id="password" value="<?php echo md5($_SESSION['usuariomoodle'].$_SESSION['cedula_funcionario']); ?>" >  
     
            <button class="btn btn-danger btn-lg" type="submit" id="loginbtn">Ingresar</button>
     
    </form>
	
	
	
	
	
	<br>
	
	<?php if (1==$_SESSION['rol']) { ?>
	
	<form class="login-form" action="http://192.168.239.26/login/index.php" method="post" id="login">
        <input type="hidden" name="logintoken" value="e02cPvPbjmAbVNZvvvf1OSwxK5Xk31Du">
      
            <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['usuariomoodle']; ?>">
      
            <input type="hidden" name="password" id="password" value="<?php echo $_SESSION['sesion']; ?>" >
     
            <button class="btn btn-warning btn-lg" type="submit" id="loginbtn">Ingresar al anterior</button>
     
    </form>
	
	<?php } else {} ?>
	
	
	</div>
	</div>
	</div>
	</div>
	</div>
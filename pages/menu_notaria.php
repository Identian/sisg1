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
		</div>
 <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			
			 <li><a href="notaria&<?php echo $id; ?>.jsp"><b> 	 
     <?php echo quees('notaria', $id);?>
		  </b></a></li>
           
 <?php if (($_SESSION['snr_tipo_oficina'] == 3 && 1==$_SESSION['snr_grupo_cargo']) OR 1==$_SESSION['rol']) { ?> 
<li><a href="privilegios_notariado<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Acceso a módulos</a></li>
 <?php } ?>
			   
 <li><a href="sucesion<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Liq. Herencia</a></li>	  
<li><a href="salida_menor<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Salida de menores</a></li>
 <li><a href="notaria_datos_facturacion<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Facturación</a></li>
<li><a href="personal_notaria<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="">Personal</a></li>
       <li><a href="apostilla<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="Apostilla">Apostilla</a></li>
		     <li><a href="testamento<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="Testamento">Testamentos</a></li>
		   <li><a href="carceles.jsp" title="Turnos de carceles">Carceles</a></li>

		<?php if (1==$_SESSION['rol']) { ?> 
		 

	<li><a href="digitalizacion_notarial<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="Digitalización">Digitalización</a></li>
  <li><a href="local_notaria<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="">Local</a></li>	  	
 <li><a href="historico_notarias<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="Consulta historica">Historial</a></li>
	
	
	
		 <?php } else {} ?>
            </ul>
          </div>
		 
      </div>
    </nav>
  </div>
</div>
<?php

$nump121=privilegios(121,$_SESSION['snr']);

if ((3>$_SESSION['snr_tipo_oficina']) &&  (1==$_SESSION['snr_grupo_cargo'] or 2==$_SESSION['snr_grupo_cargo'] or 4==$_SESSION['snr_grupo_cargo'])) {
	

	
	

if ((isset($_POST["pre1"])) && (""!=$_POST["pre1"])) {
	

	$insertSQL = sprintf("INSERT INTO curso_2024 (
      id_funcionario, proceso, id_funcionario_lider, 
	  
	  pre1, 
pre2, 
pre3, 
pre4, 
pre5, 
pre6, 
pre7, 
pre8, 
pre9, 
pre10, 
pre11, 
pre12, 
pre13, 
pre14, 
pre15, 
pre16, 
pre17, 
pre18, 


	  estado_curso_2024) 
	  VALUES (%s, %s, %s,  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST['proceso'], "text"),
GetSQLValueString($_POST['id_funcionario_lider'], "int"),
GetSQLValueString($_POST['pre1'], "text"),
GetSQLValueString($_POST['pre2'], "text"),
GetSQLValueString($_POST['pre3'], "text"),
GetSQLValueString($_POST['pre4'], "text"),
GetSQLValueString($_POST['pre5'], "text"),
GetSQLValueString($_POST['pre6'], "text"),
GetSQLValueString($_POST['pre7'], "text"),
GetSQLValueString($_POST['pre8'], "text"),
GetSQLValueString($_POST['pre9'], "text"),
GetSQLValueString($_POST['pre10'], "text"),
GetSQLValueString($_POST['pre11'], "text"),
GetSQLValueString($_POST['pre12'], "text"),
GetSQLValueString($_POST['pre13'], "text"),
GetSQLValueString($_POST['pre14'], "text"),
GetSQLValueString($_POST['pre15'], "text"),
GetSQLValueString($_POST['pre16'], "text"),
GetSQLValueString($_POST['pre17'], "text"),
GetSQLValueString($_POST['pre18'], "text"),

	   GetSQLValueString(1, "int")
	  ); 
      $Result = mysql_query($insertSQL, $conexion);

echo $insertado;


} else {  }

	
 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('curso_2024'); ?></h3>

              <p>Registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>20<?php echo $anoactual; ?></h3>

              <p>Año</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>5</h3>
			  
              <p>Regionales</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>195</h3>
              <p>Oficinas de registro</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">

    <h3  class="box-title">
	
	<?php
  if(1==1) {

	?>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>
	<?php } else {} ?>

	 </h3>
	  

<br>
<b>Objetivo</b>
<br>Desarrollar los Proyectos de Aprendizaje en Equipo - PAE con el fin de fortalecer el conocimiento técnico de las dependencias y oficinas de la Superintendencia de Notariado y Registro.
<br><b>Alcance</b><br>El alcance de este proyecto abarca desde la definición de las necesidades de capacitación de las dependencias y oficinas, hasta la estrategía a utilizar para su desarrollo.
<br><b>Definiciones</b> (Términos y siglas)
<br><b>SNR:</b> Superintendencia de Notariado y Registro.
<br><b>Aprendizaje:</b> es el proceso de construcción de conocimiento en forma colaborativa mediante el cual actúan varias personas con el objetivo de construirlo, a través de la discusión, reflexión y toma de decisiones, este proceso trae como resultado la generación de gestión del conocimiento. 
<br><b>Aprendizaje basado en problemas:</b> es aquel que un funcionario obtiene a través de cuestionamientos realizados a partir de la realidad laboral cotidiana.
<br><b>Aprendizaje en equipo:</b> proceso que se genera a partir de la construcción de conocimiento en forma colaborativa. Este aprendizaje es el resultado de los conocimientos de cada integrante del equipo y la transferencia de los mismos. 
<br><b>Aprendizaje individual:</b> es el generado de forma autónoma a partir de la realidad laboral cotidiana, y define la manera en que cada uno de los integrantes de un equipo participará en el cumplimiento de los objetivos del grupo.
<br><b>Capacitación:</b> conjunto de procesos pedagógicos, orientados a reforzar y complementar la capacidad cognitiva y técnica de los servidores públicos.
<br><b>Competencias:</b> es la capacidad de una persona para desempeñar, en diferentes contextos y con base en los requerimientos de calidad y resultados esperados en el sector público, las funciones inherentes a un empleo; capacidad que está determinada por los conocimientos, destrezas, habilidades, valores, actitudes y aptitudes que debe poseer y demostrar el empleado.
<br><b>Formación:</b> proceso encaminado a facilitar el desarrollo integral del ser humano, potenciando aptitudes, habilidades y conductas, en sus dimensiones: ética, creativa, comunicativa, crítica, sensorial, emocional e intelectual.
<br><b>Proyecto de Aprendizaje en Equipo - PAE:</b> comprende un conjunto de acciones programadas y desarrolladas por un grupo de empleados para resolver necesidades de aprendizaje y, al mismo tiempo, transformar y aportar soluciones a los problemas de su contexto laboral. 
<br><b>Sensibilización:</b> es la etapa mediante la cual se busca concientizar a los funcionarios acerca de la importancia de utilizar el aprendizaje basado en problemas como una estrategia eficaz para generar conocimiento.
<br><i>Tomado de la Guía para la formulación del PIC- DAFP</i>





	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Inscripción</th>
 <th>Cédula</th>
				  <th>Funcionario</th>
				  <th>Correo</th>
				  <!--<th>Regional</th>
				  <th>Oficina</th>-->
				  <th>Oficina / Grupo</th>
				  
				   <th>Macroproceso, proceso y procedimiento</th>
				   
				    <th>Enlace / Lider</th>
				  

				<th>	Necesidad general de capacitación: Redacte la necesidad principal de la Oficina o Dependencia en cuanto al tema de capacitación.	</th>
<th>	Problema de aprendizaje: Realice una pregunta  para resolver el problema de aprendizaje que tiene la Oficina o Dependencia. (¿Cómo mejoramos el proceso de actualización normativa para los funcionarios?)	</th>
<th>	Necesidades de Capacitación
¿QUÉ CONOCIMIENTOS NECESITAN FORTALECER LOS SERVIDORES DE  LA OFICINA O DEPENDENCIA? 	</th>
<th>¿Qué se necesita saber alineado al ámbito cognitivo?
Conocimientos básicos necesarios. (CÓDIGO GENERAL DEL PROCESO)	</th>
<th>	¿Qué se necesitan saber hacer en el ámbito de la aplicación?
Aplicación de los conocimientos para convertirlos en experiencia (REDACCIÓN Y COMPOSICIÓN DE TEXTOS)	</th>
<th>	¿Qué se necesita fortalecer en el ámbito de las emociones?
Gestionar las emociones en el ámbito laboral (ACTUACIONES CON CRÍTERIO JURÍDICO)	</th>
<th>	Saberes previos para resolver el problema. 
¿QUÉ SABEMOS PARA RESOLVER EL PROBLEMA QUE TENEMOS Y QUIÉN LO SABE?
FORTALEZAS	</th>
<th>	¿Qué conocimientos anteriores se tienen que pueden ayudar a resolver el problema?
Información cognitiva con la que cuenta el funcionario con anterioridad. 	</th>
<th>	¿Qué se sabe hace en el ámbito de la aplicación?
Conocimiento normativo, doctrinal y jurisprudencial con el que cuentan los funcionarios con anterioridad. 	</th>
<th>	¿Quién puede realizar la gestión del conocimiento?
Lista de funcionarios que tienen el conocimiento y lo pueden transferir. 	</th>
<th>	Objetivos de aprendizaje (¿Qué voy hacer?). Nombre de la capacitación que se requiere.	</th>
<th>	TEMAS  
(Escribir la temática específica que se sugiere desarrollar en el proceso de capacitación). Temas específicos concernientes a la capacitación general.	</th>
<th>	Métodos o estrategias de capacitación (¿Cómo lo voy hacer?). Manera como voy a impartir la capacitación: presencial-virtual(sincrónica-asincrónica)	</th>
<th>	Número de horas.Tiempo que se requiere para lograr el objetivo. 	</th>
<th>	Fechas previstas. Sugerencia de cronograma de actividades de acuerdo con los temas propuestos	</th>
<th>	Evaluación del aprendizaje 
(¿Con qué instrumento se evaluará?). Instrumento que se utilizará para medir el conocimiento adquirido. 
Encuesta
Evaluación de seguimiento	</th>
<th>	Materiales de aprendizaje. Materiales necesarios para impartir la capacitación. 	</th>
<th>	Apoyos  institucionales (espacio para capacitación). Gestión para poder desarrollar la capacitación: Contamos con recursos humanos y el apoyo y conocimiento de entidades gubernamentales. (DNP-DAFP-IGAC)	</th>

			  
				
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 
/*
Inscripcion
ciclo1=2022-08-17   /  20222-08-25
ciclo2=2022-09-05   /  20222-09-19
ciclo3=2022-10-03   /  20222-10-17
*/
if (1==$_SESSION['rol'] or 0<$nump121) {
$query4="SELECT * from curso_2024, funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and curso_2024.id_funcionario=funcionario.id_funcionario and estado_curso_2024=1  ORDER BY id_curso_2024 desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from curso_2024, funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and curso_2024.id_funcionario=funcionario.id_funcionario and estado_curso_2024=1 and funcionario.id_funcionario=".$_SESSION['snr']."  ORDER BY id_curso_2024 desc  "; //LIMIT 500 OFFSET ".$pagina."
}

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
<?php
$id_res=$row['id_curso_2024'];
echo '<td>'.$row['nombre_curso_2024'].'</td>';
echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>'.$row['correo_funcionario'].'</td>';
echo '<td>'.$row['nombre_grupo_area'].'</td>';

echo '<td>'.$row['proceso'].'</td>';

echo '<td>'.quees('funcionario',$row['id_funcionario_lider']).'</td>';


/*
if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
}
*/

echo '<td>'.$row['pre1'].'</td>';
echo '<td>'.$row['pre2'].'</td>';
echo '<td>'.$row['pre3'].'</td>';
echo '<td>'.$row['pre4'].'</td>';
echo '<td>'.$row['pre5'].'</td>';
echo '<td>'.$row['pre6'].'</td>';
echo '<td>'.$row['pre7'].'</td>';
echo '<td>'.$row['pre8'].'</td>';
echo '<td>'.$row['pre9'].'</td>';
echo '<td>'.$row['pre10'].'</td>';
echo '<td>'.$row['pre11'].'</td>';
echo '<td>'.$row['pre12'].'</td>';
echo '<td>'.$row['pre13'].'</td>';
echo '<td>'.$row['pre14'].'</td>';
echo '<td>'.$row['pre15'].'</td>';
echo '<td>'.$row['pre16'].'</td>';
echo '<td>'.$row['pre17'].'</td>';
echo '<td>'.$row['pre18'].'</td>';




echo '<td>';
if (1==$_SESSION['rol'] or 0<$nump121) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="curso_2024" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
echo '</td>';
?>
      
                  </tr>
                <?php } ?>

				
                </tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
						dom: 'Bfrtip',
								buttons: [
									// 'copyHtml5',
									'excelHtml5'
									
									// 'pdfHtml5'
								],
						"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						"language": {
							"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
						},
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


 <div class="modal fade bd-example-modal-lg" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r65345345464324324563m1" enctype="multipart/form-data" >



<div class="form-group text-left"> 
<label  class="control-label">Fecha de diligenciamiento del PAE</label> 

<input type="text" class="form-control" readonly value="<?php echo date('Y-m-d'); ?>">
</div>

<div class="form-group text-left"> 
<label  class="control-label">Nombre:</label> 

<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">Cédula:</label> 

<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>


 <div class="form-group text-left"> 
<label  class="control-label">Perfil:</label> 

<input type="text" class="form-control" readonly value="<?php echo quees('cargo',$_SESSION['snr_grupo_cargo']); ?>">
</div>


 <div class="form-group text-left"> 
<label  class="control-label">Cargo:</label> 

<input type="text" class="form-control" readonly value="<?php echo cargo($_SESSION['id_cargo_nomina_encargo']); ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label">Nombre completo de la Oficina o Dependencia:</label> 

<input type="text" class="form-control" readonly value="
<?php 
if (1==$_SESSION['snr_tipo_oficina']) {
echo ''.quees('area',$_SESSION['snr_area']).' / ';
echo ''.quees('grupo_area',$_SESSION['snr_grupo_area']).'';
} else {
echo ''.regional($_SESSION['id_oficina_registro']).' / ';
echo ''.quees('oficina_registro',$_SESSION['id_oficina_registro']).'';	
echo ' / '.quees('grupo_area',$_SESSION['snr_grupo_area']).'';
} ?>
">
</div>



 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre del macroproceso, procesos y procedimientos:</label> 

<input type="text" class="form-control" name="proceso" required value="">
</div>






<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre del enlace de la oficina o dependencia para temas de capacitación (Lider)::</label> 
<select class="form-control"  name="id_funcionario_lider" required  >
<option selected></option>

	<?php
if (1==$_SESSION['snr_tipo_oficina']) {	
	
$actualizar5 = mysql_query("SELECT id_funcionario, nombre_funcionario FROM funcionario, grupo_area WHERE 
funcionario.id_grupo_area=grupo_area.id_grupo_area and id_area=".$_SESSION['snr_area']." 
and id_tipo_oficina<3 and id_funcionario!=".$_SESSION['snr']." 
and estado_funcionario=1 order by id_cargo_nomina_encargo", $conexion);
	
	
	} else {
$actualizar5 = mysql_query("SELECT id_funcionario, nombre_funcionario FROM funcionario WHERE 
 id_oficina_registro=".$_SESSION['id_oficina_registro']."  
and id_tipo_oficina<3 and id_funcionario!=".$_SESSION['snr']." 
and estado_funcionario=1 order by id_cargo_nomina_encargo", $conexion);	
	}
	

$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);

if (0<$total55) {
 do {
   echo '<option value="'.$row15['id_funcionario'].'" ';
   echo '>'.$row15['nombre_funcionario'].'  ';
   echo '</option>';
 } while ($row15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);
} else {}
?>


</select>

</div>





<div class="form-group text-left"> 
<label  class="control-label">Necesidad general de capacitación: Redacte la necesidad principal de la Oficina o Dependencia en cuanto al tema de capacitación.	</label>
<input type="text" class="form-control" name="pre1" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Problema de aprendizaje: Realice una pregunta  para resolver el problema de aprendizaje que tiene la Oficina o Dependencia. (¿Cómo mejoramos el proceso de actualización normativa para los funcionarios?)	</label>
<input type="text" class="form-control" name="pre2" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Necesidades de Capacitación
¿QUÉ CONOCIMIENTOS NECESITAN FORTALECER LOS SERVIDORES DE  LA OFICINA O DEPENDENCIA? 	</label>
<input type="text" class="form-control" name="pre3" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Elaborar una lista de máximo cuatro (4) necesidades de capacitación: ¿Qué se necesita saber alineado al ámbito cognitivo?
Conocimientos básicos necesarios. (CÓDIGO GENERAL DEL PROCESO)	</label>
<textarea class="form-control" name="pre4" required></textarea></div>
<div class="form-group text-left"> 
<label  class="control-label">¿Qué se necesitan saber hacer en el ámbito de la aplicación?
Aplicación de los conocimientos para convertirlos en experiencia (REDACCIÓN Y COMPOSICIÓN DE TEXTOS)	</label>
<input type="text" class="form-control" name="pre5" required></div>
<div class="form-group text-left"> 
<label  class="control-label">¿Qué se necesita fortalecer en el ámbito de las emociones?
Gestionar las emociones en el ámbito laboral (ACTUACIONES CON CRÍTERIO JURÍDICO)	</label>
<input type="text" class="form-control" name="pre6" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Saberes previos para resolver el problema. 
¿QUÉ SABEMOS PARA RESOLVER EL PROBLEMA QUE TENEMOS Y QUIÉN LO SABE?
FORTALEZAS"	</label>
<input type="text" class="form-control" name="pre7" required></div>
<div class="form-group text-left"> 
<label  class="control-label">¿Qué conocimientos anteriores se tienen que pueden ayudar a resolver el problema?
Información cognitiva con la que cuenta el funcionario con anterioridad. </label>
<input type="text" class="form-control" name="pre8" required></div>
<div class="form-group text-left"> 
<label  class="control-label">¿Qué se sabe hace en el ámbito de la aplicación?
Conocimiento normativo, doctrinal y jurisprudencial con el que cuentan los funcionarios con anterioridad. </label>
<input type="text" class="form-control" name="pre9" required></div>
<div class="form-group text-left"> 
<label  class="control-label">¿Quién puede realizar la gestión del conocimiento?
Lista de funcionarios que tienen el conocimiento y lo pueden transferir. </label>
<input type="text" class="form-control" name="pre10" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Objetivos de aprendizaje (¿Qué voy hacer?). Nombre de la capacitación que se requiere.	</label>
<input type="text" class="form-control" name="pre11" required></div>
<hr>
<div class="form-group text-left"> 
<label  class="control-label">TEMAS  
(Escribir la temática específica que se sugiere desarrollar en el proceso de capacitación). Temas específicos concernientes a la capacitación general.</label>
<input type="text" class="form-control" name="pre12" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Métodos o estrategias de capacitación (¿Cómo lo voy hacer?). Manera como voy a impartir la capacitación: presencial-virtual(sincrónica-asincrónica)	</label>
<input type="text" class="form-control" name="pre13" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Número de horas.Tiempo que se requiere para lograr el objetivo. 	</label>
<input type="text" class="form-control" name="pre14" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Fechas previstas. Sugerencia de cronograma de actividades de acuerdo con los temas propuestos	</label>
<input type="text" class="form-control" name="pre15" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Evaluación del aprendizaje 
(¿Con qué instrumento se evaluará?). Instrumento que se utilizará para medir el conocimiento adquirido. 
Encuesta
Evaluación de seguimiento</label>
<input type="text" class="form-control" name="pre16" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Materiales de aprendizaje. Materiales necesarios para impartir la capacitación. 	</label>
<input type="text" class="form-control" name="pre17" required></div>
<div class="form-group text-left"> 
<label  class="control-label">Apoyos  institucionales (espacio para capacitación). Gestión para poder desarrollar la capacitación: Contamos con recursos humanos y el apoyo y conocimiento de entidades gubernamentales. (DNP-DAFP-IGAC)	</label>

<input type="text" class="form-control" name="pre18" required></div>










<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success "><!--desaparecerboton-->
<input type="hidden" name="table">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>


<?php
}
 else { echo 'Solo para funcionarios';  }
 ?>


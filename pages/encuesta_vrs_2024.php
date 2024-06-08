<?php

$nump121=privilegios(121,$_SESSION['snr']);

if ((3>$_SESSION['snr_tipo_oficina']) &&  (1==$_SESSION['snr_grupo_cargo'] or 2==$_SESSION['snr_grupo_cargo'] or 4==$_SESSION['snr_grupo_cargo'])) {
	

	
	

if ((isset($_POST["pre1"])) && (""!=$_POST["pre1"])) {
	

	$insertSQL = sprintf("INSERT INTO encuesta_vrs_2024 (
      id_funcionario, 
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


	  estado_encuesta_vrs_2024) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($_SESSION['snr'], "int"), 
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
              <h3><?php echo existencia('encuesta_vrs_2024'); ?></h3>

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
	<?php } else {} 
	
	
	
	
	$array=array('Modelo Integrado de Planeación y Gestión.', 'Fundamentos del direccionamiento estratégico. ', 'Análisis del entorno: Este tema puede centrarse en cómo realizar un análisis exhaustivo del entorno en el que opera la entidad y el análisis de las tendencias del mercado. ', 'Análisis interno: es decir el análisis FODA (Fortalezas, Oportunidades, Debilidades y Amenazas). ', 'Establecimiento de objetivos estratégicos: Este tema se enfoca en cómo definir objetivos claros y alcanzables que estén alineados con la visión y la misión de la organización. ', 'Desarrollo de estrategias.', 'Indicadores. ', 'Formulación de acuerdos de gestión. ', 'Riesgos.', 'Importancia de la comunicación estratégica en el sistema de gestión de calidad. ', 'Diseño de mensajes estratégicos.', 'Diseño de mensajes clave.', 'Identidad y reputación de la organización.', 'Comunicación interna.', 'Comunicación externa.', 'Identificación de audiencias clave: Este tema se enfoca en cómo identificar las audiencias internas y externas relevantes para la comunicación estratégica del sistema de gestión de calidad, y cómo adaptar los mensajes y canales de comunicación según las necesidades y características de cada audiencia. ', 'Selección de canales de comunicación.', 'El rol de los líderes y la comunicación estratégica.', 'Evaluación de la efectividad de la comunicación.', 'Introducción al sistema integrado de gestión.', 'Importancia de los acuerdos de gestión. ', 'Identificación de áreas clave para los acuerdos de gestión: En esta capacitación, se pueden explorar diferentes áreas funcionales de la entidad donde los acuerdos de gestión son relevantes, como producción, calidad, medio ambiente, salud y seguridad, entre otras, y cómo establecer objetivos específicos para cada área.', 'Definición de metas y objetivos SMART: Este tema se enfoca en cómo formular metas y objetivos específicos, medibles, alcanzables, relevantes y con un tiempo definido (SMART), que puedan ser monitoreados y evaluados en el marco de los acuerdos de gestión.', 'Planificación y asignación de recursos.', 'Seguimiento y evaluación de los acuerdos de gestión.', 'Formulación de planes institucionales.', 'Fundamentos de la gestión del conocimiento.', 'Gestión del cambio en los procesos.', 'Fomento de la innovación en la organización.', 'Desarrollo e investigación en la organización.', 'Integración de la gestión del conocimiento.', 'Mejora continua de los procesos.', 'Gestión del cambio y la resistencia.', 'Atención al ciudadano.', 'Legislación Normativa-Ética y conducta profesional-Técnicas de observación y reconocimiento-Comunicación efectiva. Resolución de problemas y toma de decisiones.', 'Sensibilización cultural y diversidad-Fomentar la comprensión y el respeto hacia la diversidad cultural y social, y la importancia de brindar un servicio equitativo y no discriminatorio a todos los ciudadanos, independientemente de su origen étnico, género, religión u orientación sexual. ', 'Autocuidado y bienestar emocional: Promover la importancia del autocuidado y el bienestar emocional en el desempeño de las tareas de atención al ciudadano. Esto puede incluir estrategias para gestionar el estrés, mantener un equilibrio entre el trabajo y la vida personal, y buscar apoyo cuando sea necesario.', 'Actualización de conocimientos: Destacar la importancia de mantenerse actualizado sobre nuevas tendencias, tecnologías y cambios legislativos en el ámbito de la vigilancia y la atención al ciudadano. ', 'Análisis de los procedimientos y protocolos utilizados para llevar a cabo la inspección a sujetos objetivo de supervisión en el ámbito del derecho disciplinario. Esto puede incluir aspectos como la notificación, el acceso a la información relevante, la confidencialidad y el debido proceso,  ', 'Criterios de selección. Esto puede incluir la identificación de factores de riesgo o indicadores que justifiquen la supervisión de un determinado individuo o entidad.', 'Alcance y limitaciones de la inspección en el Derecho Disciplinario: incluyendo las facultades y competencias de los inspectores, los derechos y garantías de los sujetos inspeccionados, y las restricciones legales o prácticas que puedan existir en el ejercicio de la supervisión.', 'Sanciones disciplinarias.', 'Independencia e imparcialidad: objetivo de garantizar la objetividad y la imparcialidad en la toma de decisiones y evitar cualquier tipo de sesgo o favoritismo.', 'Recursos y mecanismos de impugnación: para los sujetos objeto de inspección en el derecho disciplinario, incluyendo los procedimientos de apelación, la revisión judicial y la posibilidad de presentar recursos administrativos o reclamaciones ante órganos superiores.', 'Marco legal de los procesos misionales en el ámbito administrativo.  ', 'Control sujeto-objeto de supervisión: se debe profundizar en la comprensión de este control, identificando los actores involucrados, sus roles y responsabilidades, así como el alcance de su supervisión en relación con los objetivos y resultados de los procesos misionales.', 'Procedimientos administrativos: regulación y garantías.   Se puede examinar la regulación de los procedimientos administrativos, incluyendo las garantías para los interesados y los principios que rigen su desarrollo, como el debido proceso y la transparencia. ', 'Responsabilidad administrativa: obligaciones y consecuencias.', 'Ética y valores en la gestión de los procesos misionales.', 'El control interno y externo en el contexto administrativo- Se puede abordar cómo se estructura y ejecuta el control interno dentro de la entidad, así como el papel de los órganos de control externo, como los entes de fiscalización y auditoría.', 'Naturaleza y función del servicio registral.', 'Principios constitucionales aplicables al servicio registral.', 'Registro de la propiedad.', 'Acceso a la información registral.', 'Control constitucional del servicio registral.', 'Control constitucional del servicio registral. ', 'Desafíos y perspectivas futuras', 'Estatuto Registral.', 'Marco normativo del estatuto registral.', 'Funciones y responsabilidades de los funcionarios registrales.', 'Antiguo sistema', 'Calificación registral.', 'Gestión de expedientes registrales.', 'Atención al público y servicio al cliente.', 'Uso de tecnologías y sistemas de información registral.', 'Ética y deontología profesional', 'Ley de Tierras.', 'Marco normativo de la ley de tierras y el catastro multipropósito.', 'Procesos de regularización de la tenencia de la tierra. ', 'Integración del catastro con el registro de la propiedad.', 'Integración del catastro con el registro de la propiedad.', 'Gestión y análisis de datos geoespaciales.', 'Seguridad y privacidad de los datos en el catastro multipropósito.', 'Supervisión y control del catastro multipropósito', 'Licencias Urbanísticas Decreto 1077 del 2015.', 'Marco normativo de las licencias urbanísticas.', 'Tipos de licencias urbanísticas.', 'Documentación requerida para las licencias urbanísticas.', 'Control y seguimiento de las licencias urbanísticas.', 'Participación ciudadana en el proceso de licenciamiento. ', 'Actualizaciones y modificaciones al Decreto 1077 de 2015 y otras normas.', 'Curadurías Urbanas', 'Licencias de construcción.', 'Control urbano.', 'Planeación urbana.', 'Seguimiento normativo.', 'Interoperabilidad Registro Catastro Multipropósito.', 'Integración de datos.', 'Identificación única de propiedades.', 'Flujo de información.', 'Procesos de verificación y validación. ', 'Acceso y consulta de información', 'Explora el papel del notario como funcionario público encargado de autenticar actos y contratos, garantizando su validez, legalidad y seguridad jurídica.', 'Organización y regulación del servicio público notarial.', 'Formalidades y solemnidades notariales: Analiza las formalidades y solemnidades que deben cumplirse en los actos notariales, como la escritura pública, la firma y el sello notarial, y su importancia para conferirles eficacia jurídica y probatoria.', 'Documentos notariales y fe pública: Aborda la naturaleza de los documentos notariales como instrumentos públicos, su fuerza probatoria y la presunción de veracidad que se les atribuye, así como el concepto de fe pública notarial.', 'Responsabilidad y ética notarial.', 'Control y supervisión del servicio público notarial.', 'Modernización y tecnología en el servicio notarial.', 'Ofimática  ', 'Fundamentos de la informática y la tecnología.', 'Herramientas de productividad.', 'Gestión de archivos y organización de la información.', 'Seguridad de la información.', 'Colaboración y comunicación digital.', 'Uso de herramientas de comunicación digital.', '.Actualización tecnológica', 'Competencias digitales y desarrollo profesional.', 'Evaluación del desempeño.', 'Objetivos y expectativas claras. ', 'Indicadores y criterios de evaluación.', 'Recolección y análisis de datos.', 'Retroalimentación constructiva.', 'Planes de mejora y desarrollo.', 'Evaluación de competencias y habilidades.', 'Procesos de revisión y seguimiento', 'Trabajo en equipo.', 'Comunicación efectiva.', 'Roles y responsabilidades.', 'Establecimiento de metas y objetivos comunes.', 'Toma de decisiones en equipo.', 'Resolución de problemas en equipo.', 'Construcción de relaciones interpersonales.', 'Reconocimiento y celebración de logros.', 'Estatuto de Carrera Administrativa: ', 'Marco legal y normativo.', 'Procesos de selección y ingreso. ', 'Desarrollo y evaluación del desempeño.', 'Derechos y beneficios.', 'Procedimientos disciplinarios.', 'Gestión del talento en el marco de la carrera administrativa.', 'Desarrollo de competencias', 'Promición interna', 'Movilidad laboral', 'Ética y transparencia.', 'Gestión documental y archivo.', 'Tecnología de la información.', 'Organización y clasificación de documentos,  ', 'Indexación (Ordenación) y descripción de documentos.', 'Políticas y procedimientos de gestión documental.', 'Digitalización y conservación de documentos.', 'Gestión de versiones y control de cambios.', 'Gestión de flujos de trabajo y automatización.', 'Auditoría y cumplimiento normativo.', 'Marco normativo y legal.', 'Elaboración del presupuesto.', 'Control y seguimiento financiero.', 'Planificación financiera.', 'Gestión de tesorería ', 'Contratación y adquisiciones.', 'Gestión de recursos humanos.', 'Gestión financiera y contable.', 'Gestión de tecnología de la información.', 'Gestión de logística y suministros.', 'Gestión de la calidad y mejora continua.', 'Gestión de la seguridad y protección de datos.', 'Políticas de transparencia.', 'Acceso a la información.', 'Transparencia en contrataciones públicas.', 'Participación ciudadana.', 'Protección de datos personales.', 'Auditorías y control.', 'Transparencia en la gestión financiera.', 'Generalidades, marco jurídico y sujetos.', 'Etapa precontractual, estructuración del negocio y procesos de selección.', 'Contrato estatal -perfeccionamiento, ejecución, terminación y liquidación.', 'Supervisión e interventoría del contrato estatal', 'Estructura de un argumento jurídico.', 'Interpretación legal. ', 'Ejecución presupuestaria.', 'Jurisprudencia relevante.', 'Razonamiento lógico-jurídico.', 'Argumentación escrita.', 'Argumentación oral.', 'Contrargumentación.', 'Ética en la argumentación jurídica', 'Introducción al control disciplinario interno.', 'Normas y reglamentos de la organización.', 'Procedimientos disciplinarios.', 'Derechos y garantías de los empleados.', 'Investigación de las ', 'Proceso de evaluación y toma de ', 'Proceso de evaluación y toma de decisiones ', 'Proceso de evaluación y toma de decisiones.', 'Sanciones disciplinarias.', 'Gestión de registros y documentación', 'Fundamentos del control de gestión.', 'Diseño de indicadores de gestión.', 'Planificación y presupuesto. ', 'Control interno.', 'Gestión del riesgo.', 'Mejora continua.', 'Informes y análisis de gestión.', 'Ética y responsabilidad en el control de gestión', 'Competitividad e innovación', 'Ciudades sostenibles', 'Big data', 'Cambio de cultura para la experimentación', 'Análisis de indicadores y estadísticas ', 'Pensamiento complejo', 'Participación ciudadana en el diseño e implementación de políticas públicas', 'Marco de políticas de transparencia y gobernanza pública', 'Gerencia de proyectos', 'Modelos de Seguimiento a la inversión pública', 'Gestión del riesgo de desastres y cambio climático', 'Instrumentos de georreferenciación para la planeación y el ordenamiento territorial', 'Operación de sistemas de información y plataformas tecnológicas para la gestión de datos', 'Comunicación y lenguaje tecnológico', 'Solución de problemas con tecnologías', 'Apropiación y uso de la tecnología', 'Lenguaje claro', 'Comunicación asertiva', 'Empatía y solidaridad', 'Resolución de conflictos', 'Ética de lo público', 'Competencias comportamentales', 'Diversidad e inclusión en el servicio público'); 
	
	?>

	 </h3>
	  

<br>
<b>Contextualización</b>
<br>El Plan Institucional de Capacitación de la entidad responde a la identificación de las necesidades de capacitación de los funcionarios, las cuales se definen por medio de una encuesta alineada al mapa de procesos de la SNR, con el objetivo de establecer cuáles conocimientos y competencias se fortalecerán. 




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
<?php	  
foreach ($array as $val) {
    echo '<th>'. $val.'</th>';
}
?>
	  
				
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
$query4="SELECT * from encuesta_vrs_2024, funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and encuesta_vrs_2024.id_funcionario=funcionario.id_funcionario and estado_encuesta_vrs_2024=1  ORDER BY id_encuesta_vrs_2024 desc  "; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from encuesta_vrs_2024, funcionario, grupo_area where funcionario.id_grupo_area=grupo_area.id_grupo_area and encuesta_vrs_2024.id_funcionario=funcionario.id_funcionario and estado_encuesta_vrs_2024=1 and funcionario.id_funcionario=".$_SESSION['snr']."  ORDER BY id_encuesta_vrs_2024 desc  "; //LIMIT 500 OFFSET ".$pagina."
}

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
<?php
$id_res=$row['id_encuesta_vrs_2024'];
echo '<td>'.$row['nombre_encuesta_vrs_2024'].'</td>';
echo '<td>'.$row['cedula_funcionario'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>'.$row['correo_funcionario'].'</td>';
echo '<td>'.$row['nombre_grupo_area'].'</td>';
/*
if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
}
*/

for ($i = 0; $i <= 18; ++$i){
    echo '<td>'.$row[$i].'</td>';
}

echo '<td>';
if (1==$_SESSION['rol'] or 0<$nump121) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="encuesta_vrs_2024" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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

<br>
A continuación, se encuentran los procesos definidos en el mapa de entidad, por favor elija dos (2), por cada proceso, los cuales considere relevantes para su desempeño laboral.
<br>
A continuación, se encuentran los temas definidos alineados al mapa de procesos de la entidad. Por favor enumere de uno (1) a cinco (5), siendo uno (1) el más relevante para su desempeño laboral y cinco (5) el menos relevante.

<br>


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
<label  class="control-label">Procesos Estratégicos (Seleccionar maximo 2 opciones):</label>
<br>
<input type="checkbox" id="proceso1" name="proceso1" value="proceso1">
 Direccionamiento Estratégico y Planeación 
<br>
<input type="checkbox" id="proceso2" name="proceso2" value="proceso2"> 
Comunicación Estratégica
<br>
<input type="checkbox" id="proceso3" name="proceso3" value="proceso3">
Sistemas Integrados de Gestión
<br>
<input type="checkbox" id="proceso4" name="proceso4" value="proceso4">
Gestión del Conocimiento, Innovación, Desarrollo e Investigación
</div>


 <div class="form-group text-left"> 
<label  class="control-label">Procesos Misionales (Seleccionar maximo 2 opciones):</label>
<br>
<input type="checkbox" id="proceso1" name="proceso1" value="proceso1">
 Direccionamiento Estratégico y Planeación 
<br>
<input type="checkbox" id="proceso2" name="proceso2" value="proceso2"> 
Comunicación Estratégica
<br>
<input type="checkbox" id="proceso3" name="proceso3" value="proceso3">
Sistemas Integrados de Gestión
<br>
<input type="checkbox" id="proceso4" name="proceso4" value="proceso4">
Gestión del Conocimiento, Innovación, Desarrollo e Investigación
</div>






<?php
$m=0;
foreach ($array as $val) {
	$m=$m+1;
    echo '<div class="form-group text-left" id="vista'.$m.'"> 
<label  class="control-label" title="'.$m.'">'. $val.'</label><br>
1<input  type="radio"  name="pre'.$m.'" value="1" required> 
 &nbsp;  &nbsp; 2<input  type="radio"  name="pre'.$m.'" value="2" class="caja'.$m.'" required> 
 &nbsp;   &nbsp; 3<input  type="radio"  name="pre'.$m.'" value="3" class="caja'.$m.'" required> 
 &nbsp;   &nbsp; 4<input  type="radio"  name="pre'.$m.'" value="4" class="caja'.$m.'" required> 
 &nbsp;   &nbsp; 5<input  type="radio"  name="pre'.$m.'" value="5" class="caja'.$m.'" required> 
</div>';
}

?>











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


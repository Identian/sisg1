<?php
$nump109 = privilegios(109, $_SESSION['snr']);
if (1==$_SESSION['rol'] or 3>$_SESSION['snr_tipo_oficina']) {



if ((isset($_POST["datos_personales"])) && ($_POST["datos_personales"] == "1")) { 

$queryt = sprintf("SELECT count(id_funcionario) as tfuncionario FROM funcionario where (id_cargo=1 or id_cargo=2 or id_cargo=4 or id_cargo=6) and estado_funcionario=1 and id_funcionario=".$_SESSION['snr'].""); 
$selectt = mysql_query($queryt, $conexion);
$rowtt = mysql_fetch_assoc($selectt);
if (0<$rowtt['tfuncionario']) {


/*
$query = sprintf("SELECT count(id_credito_icetex) as tolimpiada FROM credito_icetex where estado_credito_icetex=1 and id_funcionario=".$_SESSION['snr']." AND estado_credito_icetex=1"); 
$select = mysql_query($query, $conexion);
$rowt = mysql_fetch_assoc($select);
if (0<$rowt['tolimpiada']) {
	 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El funcionario ya tiene inscripción activa.</div>';
} else {
	*/
	
$tamano_archivo=15728640; //11534336    https://convertlive.com/es/u/convertir/megabytes/a/bytes#15


//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');


$directoryftp="filesnr/creditos/";


if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'credito-'.$_SESSION['snr'].'-'.$identi;

$archivo = $_FILES['file']['tmp_name'];

$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;


if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
 


$insertSQL = sprintf("INSERT INTO credito_icetex (id_funcionario, fecha_inscripcion, tipo_credito, periodo, 
nivel_cursar, modalidad, centro_estudios, ubicacion_centro, url, nombre_credito_icetex, datos_personales, 
estado_credito_icetex) VALUES (%s, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["tipo_credito"], "text"), 
GetSQLValueString($_POST["periodo"], "text"), 
GetSQLValueString($_POST["nivel_cursar"], "text"), 
GetSQLValueString($_POST["modalidad"], "text"), 
GetSQLValueString($_POST["centro_estudios"], "text"), 
GetSQLValueString($_POST["ubicacion_centro"], "text"), 
GetSQLValueString($files, "text"), 
GetSQLValueString($_POST["nombre_credito_icetex"], "text"), 
GetSQLValueString($_POST["datos_personales"], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;



   
  } else {
$files='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
  }
} else { 
$files='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}
		

} else { 
$files='';	
	}	
	
	
//}
	
	} else {
echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, Solo esta disponible para funcionarios de de carrera ó provisionales. Si identifica inconsistencias, reportarlo a sandram.gomez@supernotariado.gov.co para actualizar el perfil.</div>';	
} 
	
	  } else {}
	  ?>


 <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('credito_icetex'); ?></h3>

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
		

	
          <div class="box-body box-profile">

  <a class="ventana1" data-toggle="modal" data-target="#popupcreditoicetex" href="" title="Añadir"> 
  <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign">
  </span> Nuevo</button></a>
  
  
          
<a>CONVENIO SNR-ICETEX 2023</a>, 8 convocatoria, <b>Del 4 a 10 de Marzo de 2024</b><br>
De acuerdo con lo estipulado en la Resolución N°12424 de 2021, por la cual se establece el Convenio SNR-ICETEX y se brinda un crédito educativo condonable por servicios laborables a los funcionarios de la Superintendencia de Notariado y Registro que requieran financiar su matrícula y derechos de grado de educación formal y no formal dentro y fuera del país, se establece el calendario de inscripción para la presente anualidad:
<br>Dirigido a: funcionarios de la Superintendencia de Notariado y Registro vinculados en Carrera Administrativa y Nombramiento Provisional."

<br> <a href="files/portal/intranet/portal-condiciones_icetex_2024.pdf" target="_blank">Ver terminos y condiciones de uso</a>
		<br> <a href="files/portal/intranet/portal-circular_458_2023.pdf" target="_blank">Circular 458 de 2023</a>
          </div>


  
        <div class="nav-tabs-custom">



	 
          

          <div class="tab-content">


		  
            <div class="active tab-pane" id="activity">

              <div class="post">
                <div class="user-block">
                  <div class="col-xs-12 table-responsive ">

                    <?php
					
			if (1==$_SESSION['rol'] or 0<$nump109) {
$queryn="SELECT * FROM credito_icetex, funcionario where credito_icetex.id_funcionario=funcionario.id_funcionario and estado_credito_icetex=1"; //LIMIT 500 OFFSET ".$pagina."
} else {
$queryn="SELECT * FROM credito_icetex, funcionario where credito_icetex.id_funcionario=funcionario.id_funcionario and estado_credito_icetex=1 and funcionario.id_funcionario=".$_SESSION['snr'].""; //LIMIT 500 OFFSET ".$pagina."
}

               
					
					$selectn = mysql_query($queryn, $conexion) ;
                    $row = mysql_fetch_assoc($selectn);
					$totalRows = mysql_num_rows($selectn);

if (0<$totalRows){
                    ?>


	  
                    <table class="table table-striped table-bordered table-hover" id="detallefun">
                    
				<thead>
				<tr align='center' valign='middle'><th>FUNCIONARIO</th>
				<th>CEDULA</th><th>CORREO</th><th>INGRESO</th><th></th><th>OFICINA</th><th>VINCULACIÓN</th>
				
				<th>FECHA DE INSCRIPCION</th>
				<th>TIPO DE CREDITO</th><th>PERIODO</th><th>NIVEL A CURSAR</th><th>MODALIDAD</th>
				<th>CENTRO DE ESTUDIOS</th><th>UBICACION DEL CENTRO</th><th>CURSO</th>
				<th>PDF</th>
				</tr>
				
				</thead><tbody>
				
					  
                        <?php
						
						
                        do {
                          echo '<tr>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp" target="_blank">'.$row['nombre_funcionario'].'</a></td>';


echo '<td>';
echo $row['cedula_funcionario'];
echo '</td>';
echo '<td>';
echo $row['correo_funcionario'];
echo '</td>';
echo '<td>';
echo $row['fecha_ingreso'];
echo '</td>';

if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
}

	echo '<td>';
if (ISSET($row['id_vinculacion'])) {
echo quees('vinculacion', $row['id_vinculacion']); 
} else {}
	echo '</td>';

echo '<td>'.$row['fecha_inscripcion'].'</td>';
echo '<td>'.$row['tipo_credito'].'</td>';
echo '<td>'.$row['periodo'].'</td>';
echo '<td>'.$row['nivel_cursar'].'</td>';
echo '<td>'.$row['modalidad'].'</td>';
echo '<td>'.$row['centro_estudios'].'</td>';
echo '<td>'.$row['ubicacion_centro'].'</td>';
echo '<td>'.$row['nombre_credito_icetex'].'</td>';
echo '<td><a href="filesnr/creditos/'.$row['url'].'" target="_blank"><img src="images/pdf.png" style="max-width:15px;height:18px;"></a>';
	if (1==$_SESSION['rol'] or 0<$nump109) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="credito_icetex" id="'.$row['id_credito_icetex'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

//echo ' <a href="" class="buscarincentivo_educativo" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizarincentivo_educativo"> <i class="fa fa-edit"></i></a> ';


	} else {}
	
echo '</td>';

echo '</TR>';
                        } while ($row = mysql_fetch_assoc($selectn));
                        mysql_free_result($selectn);


                        ?>
						<script>
				$(document).ready(function() {
					$('#detallefun').DataTable({
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
                        
                      </tbody>
                    </table>
<?php } else { echo 'No existen registros'; } ?>
</div>
                </div>
              </div>
            </div>






            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>






<div class="modal fade" id="popupcreditoicetex" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Solicitud de credito: <span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form action="" method="POST" name="formasdf3245fhgdh345122" enctype="multipart/form-data">

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE SOLICITUD:</label> 
<select  class="form-control" name="tipo_credito" required>
<option value="" selected></option>
<option value="Credito Nuevo">Credito Nuevo</option>
<option value="Renovación de credito">Renovación de credito</option>
<option>Derechos de grado</option>
<option>Condonación</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NIVEL A CURSAR:</label> 
<select  class="form-control" name="nivel_cursar" required>
<option value="" selected></option>
<option value="Técnico">Técnico</option>
<option value="Técnologo">Técnologo</option>
<option value="Pregrado">Pregrado</option>
<option>Diplomado</option>
<option value="Especialización">Especialización</option>
<option value="Maestria">Maestria</option>
<option value="Doctorado">Doctorado</option>
<option>No aplica</option>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> PERIODO A CURSAR:</label> 
<select  class="form-control" name="periodo" required>
<option value="" selected></option>
<option value="2024-1">2024-1</option>
<option value="2024-2">2024-2</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> MODALIDAD:</label> 
<select  class="form-control" name="modalidad" required>
<option value="" selected></option>
<option value="Virtual">Virtual</option>
<option value="Presencial">Presencial</option>
<option value="Semipresencial">Semipresencial</option>
<option>No aplica</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE COMPLETO DEL CENTRO DE ESTUDIOS:</label> 
<input type="text" class="form-control" name="centro_estudios"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> UBICACIÓN DEL CENTRO DE ESTUDIOS:</label> 
<select  class="form-control" name="ubicacion_centro" required>
<option value="" selected></option>
<option value="Nacional">Nacional</option>
<option value="Internacional">Internacional</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE COMPLETO DEL PROGRAMA EDUCATIVO:</label> 
<input type="text" class="form-control" name="nombre_credito_icetex"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ADJUNTAR EN UN SOLO PDF:</label> 
<br>Fotocopia de la cédula de ciudadanía al 150%. 
<br>Evaluación del Desempeño Laboral (EDL) del semestre inmediatamente anterior a la fecha de la convocatoria acreditando un nivel sobresaliente. Para Carrera Administrativa un puntaje mayor al 90% y para Nombramiento Provisional mayor al 95%. 
<br>Certificación laboral vigente con fecha de expedición no mayor a 30 días. 
<br>Certificado de antecedentes disciplinarios de la Procuraduría y Contraloría vigentes, expedidos no mayor a 30 días. 
<br>Diploma y acta de grado de los estudios anteriores. 
<br>Plan de estudio del programa a cursar expedido por el centro de formación aprobado por el Ministerio de Educación, que incluya: horarios de clases, asignaturas, número de créditos y valor total del periodo académico a cursar. 
<br>Para primer semestre: certificado de admisión al programa académico y orden de matrícula. 
<br>Para segundo semestre en adelante: certificado de notas del semestre inmediatamente anterior con el promedio académico mínimo de 3,8 para pregrado y para postgrado con un promedio mínimo de 4,0. 

<input type="file" name="file" class="form-control"  required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> ¿Sus datos personales están protegidos por la ley 1581 de 2012 ¿Acepta el uso de datos personales y el envío de información relacionada con la presente solicitud?:</label> 
<select  class="form-control" name="datos_personales" required>
<option value="1" selected>Si</option>
<option value="0">No</option>

</select>
</div>

                    
                    <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                      <button type="submit" class="btn btn-success"><input type="hidden" name="insertSupervisor" value="insertco"><span class="glyphicon glyphicon-ok"></span> Agregar </button>
                    </div>
                  </form>

                  
                </div>
              </div>
            </div>
          </div>
		  

<?php

  } else {  echo '';}

?>
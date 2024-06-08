<?php
if (1==$_SESSION['rol']) {
$pre_ori=intval($_GET['i']);

} else {

if (2==$_SESSION['snr_tipo_oficina'] && isset($_SESSION['id_oficina_registro'])) {

$pre_ori=intval($_SESSION['id_oficina_registro']);
} else {
	   
   } 
} 


if (isset($pre_ori) && ""!=$pre_ori) {



if(isset($_GET['e'])) { 

$updateSQLh = "UPDATE inve_encuesta SET estado_inve_encuesta=0 where id_oficina='$pre_ori' and estado_inve_encuesta=1";
$Resulth = mysql_query($updateSQLh, $conexion);

} ELSE { } 



// -----------------------------------------------
// INICIO DE CARGUE DEL CVS
// -----------------------------------------------

 if(isset($_POST['subirmaxivoen'])){  
    //Aquí es donde seleccionamos nuestro csv
    $fname = $_FILES['sel_file']['name'];
    //echo 'Cargando nombre del archivo: '.$fname.' <br>';
    $chk_ext = explode(".",$fname);
    if(strtolower(end($chk_ext)) == "csv"){
    //si es correcto, entonces damos permisos de lectura para subir
    $filename = $_FILES['sel_file']['tmp_name'];
    $handle = fopen($filename, "r");
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE){
      $marca=$data[0];
      $modelo=$data[1];
      $placa=$data[2];
      $serial=$data[3];
      $estadobueno=$data[4];
      $estadodanano=$data[5];
      $estadobaja=$data[6];
      $observacion=utf8_encode($data[7]); 

	  /*
      // id_oficina=".$pre_ori." AND inve_serial=".$serial." AND
	  $actualizaren = mysql_query("SELECT count(id_inve_encuesta) as totfac FROM inve_encuesta WHERE id_oficina='$pre_ori' AND (inve_placa='$placa' or inve_placa is not null) AND estado_inve_encuesta=1", $conexion);
	  $row_encuesta = mysql_fetch_assoc($actualizaren);
	  $totfac=$row_encuesta['totfac'];

	   if (0<$totfac) { 
	   ECHO '<div class="alert-warning" style="padding:5px; margin:1px; border-radius:5px;">
                <h6><i class="icon fa fa-warning"></i> Serial Repetido: <b> '.$serial.'</b>  O  Placa Repetida: <b> '.$placa.'</b> </h6>
             </div>';
	   } else { 
	   */

  	   // if (isset($marca) AND isset($modelo) OR isset($placa) AND is_numeric($placa) OR isset($serial)){ 

		$insertSQL = sprintf("INSERT INTO inve_encuesta (
		  id_oficina,
		  nombre_inve_encuesta,
	      inve_elemento,
	      inve_marca,
	      inve_modelo,

	      inve_placa,
	      inve_serial,
	      inve_bueno,
	      inve_danado,
	      inve_baja,

	      inve_observacion,
	      estado_inve_encuesta)

	    VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s)", 
		GetSQLValueString($pre_ori, "int"), 
	 	GetSQLValueString($pre_ori, "text"),
		GetSQLValueString('Impresora', "text"), 
		GetSQLValueString($marca, "text"), 
		GetSQLValueString($modelo, "text"),

		GetSQLValueString($placa, "text"),
		GetSQLValueString($serial, "text"),
		GetSQLValueString($estadobueno, "text"),
		GetSQLValueString($estadodanano, "text"), 
		GetSQLValueString($estadobaja, "text"), 

		GetSQLValueString($observacion, "text"),
		GetSQLValueString(1, "int")
		);

		$Result = mysql_query($insertSQL, $conexion);

		echo $insertado;

	// } else { echo 'vacio';}

	// 	// switch (isset($elemento)) {
	// 	//     case 0:
	// 	//         $elemento_ver = ' (Columna A) NO Puede estar Vacio '.$elemento;
	// 	//         break;
	// 	//     case 1:
	// 	//         $elemento_ver = '';
	// 	//         break;
	// 	// }

	//   ECHO '<div class="alert-danger" style="padding:5px; margin:1px; border-radius:5px;">
 //             <h6><i class="icon fa fa-warning"></i> Error : '.$elemento.'</h6>
 //           </div>';
	// }

	//} // validacion de repetidos		

	}
    //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
    fclose($handle);
    //echo $masivocargado;
    //echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id.'.jsp" />';
    }
    else
    {
    //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
    //ver si esta separado por " , "
    echo $doc_no_tipo;
    }
   
	}
?>

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
        <span class="navbar-brand" > &nbsp; ORIP <?php if (isset($_SESSION['id_oficina_registro'])) { echo quees('oficina_registro', $pre_ori); } else { echo quees('oficina_registro', $pre_ori); } ?>: </span>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="comodato_encuesta.jsp">Encuesta Impresoras</a></li>
         <!--   <li><a href="#">Boletines</a></li>
            <li><a href="#">Devoluciones</a></li>
            <li><a href="#">Permisos y licencias</a></li>
            <li><a href="#">Situaciones administrativas</a></li>
            <li><a href="no_conformidad_mvc.jsp">Producto no conforme</a></li>
            <li><a href="#">Segunda instancia</a></li>-->
          </ul>
        </div>
    </div>
  </nav>
  </div>
</div>


<div class="row">
	<div class="col-md-12">
	  <div class="box">
	    <div class="box-header with-border"><span style="height: "></span>
	      <h4 class="box-title"><b>REPORTE DE IMPRESORAS EN OFICINA DE REGISTRO</b></h4> <i>Dirección Administrativa y Financiera - Nivel central</i>
	    </div>
	    <div class="box-body">
	    	<div class="row">
	    		<div class="col-md-6" style="padding:30px;">
		            <b style="font-size: 18px;">Procedimiento:</b><br>
		            <b>1.</b> Descargue el archivo con extensión .csv / En descargar archivo de ejemplo.<br>
		            <b>2.</b> De la <b>tabla a la derecha</b> se debe incluir las impresoras en el reporte e indicar en qué estado se encuentran.<br>
		            <b>3.</b> Estructura del Archivo (csv): <br>
		            <b>Columna A </b> = Marca<br>
		            <b>Columna B </b> = Modelo<br>
		            <b>Columna C </b> = Placa<br>
		            <b>Columna D </b> = Serial<br>
		            Seleccionar una de estas Opciones <b> Marcando con una X </b><br>
		            <b>Columna E </b> = Estado/Bueno<br>
		            <b>Columna F </b> = Estado/Dañado<br>
		            <b>Columna G </b> = Estado/En Baja<br><br>
		            <b>Columna H </b> = Observaciones<br>

		            <!-- Luego <b>Marcar con una X</b> en el estado que se encuentra ya sea Bueno, Dañado o En Baja.<br> -->

					<b>4.</b> En caso de que la impresora <b>NO Tenga placa de inventario</b> reportarla con serial.<br>
					<b>5.</b> Una vez Termina de reportar todas las impresoras de la ORIP, damos Guardar al Excel (csv).<br>
					<b>6.</b> Aparece una advertencia. <b>¿Desea seguir utilizando este formato?</b> Seleccionamos el botón <b>SI</b><br>
		            <b>7.</b> Adjunte en el botón (Seleccionar Archivo o Examinar)<br>
		            <b>8.</b> Envié el archivo en (Agregar archivo)<br><br><br>
		            Circular Emitida por el Secretario General<br><br>
					<form method='post' enctype="multipart/form-data" name="comodatoencuesta">
	  					<label>Carga Archivo Plano</label><br>
	              		<input type='file' name='sel_file' size='20'>  
					    <a href="documentos/reporte_impresoras.csv" download="reporte_impresoras.csv">Descargar archivo de ejemplo.csv</a> &nbsp;  			  
	              		<input type='submit' name='subirmaxivoen' value=' Agregar archivo ' class="btn btn-xs btn-success">
	              		<a href="comodato_encuesta&<?php echo $pre_ori;?>&1.jsp" class="confirmacioneliminacionreporteimpresoras rojo">Eliminar todos los registros</a>
			    	</form>
					
					
					
					
			    </div>
			    <div class="col-md-6" style="padding: 30px;">
			    	<b>Impresoras en Comodato que deben incluirse al reporte:</b><br><br>
			        <table class="table table-striped table-bordered">
			          <thead>
			              <tr>
			                  <th>Elemento</th>
			                  <th>Marca</th>
			                  <th>Modelo</th>
			                  <th>Serial</th> 
			              </tr>
			          </thead>
			          <tbody> 
			            <?php 
			              $query4 = sprintf("SELECT * FROM inveele, oficina_registro where
					        inveele.id_oficina=oficina_registro.id_oficina_registro AND
					        inveele.id_oficina=".$pre_ori." AND
					        estado_inveele=1");              
			              $result = $mysqli->query($query4);
			              while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			            ?>
			            <tr>
			              <td><?php echo $row['id_invecat']; ?></td>
			              <td><?php echo $row['id_invemar']; ?></td>
			              <td><?php echo $row['id_invemod']; ?></td>
			              <td><?php echo $row['inveele_seri']; ?></td>
			            </tr>
			            <?php
			              } // cierre de while
			            ?>
			          </tbody>
			        </table>
				</div> <!-- cierre col-md-6 -->

				<div class="col-md-12">
					<hr>
				</div>
	  		


			
	  		<div class="col-md-12">
			  <div class="table-responsive">
			  	<h4 style="text-align: ;"><b>Elementos Cargados al REPORTE por esta ORIP </b></h4>
		        <table class="table table-striped table-bordered table-hover" id="comoatoencuesta">
		          <thead>
		              <tr>
		                  <!-- <th>Elemento</th> -->
		                  <th>Marca</th>
		                  <th>Modelo</th>
		                  <th>Placa</th>
		                  <th>Serial</th>
		                  <th>Estado / Bueno</th>
		                  <th>Estado / Dañado</th>
		                  <th>Estado / En Baja</th>
		                  <th>Observacion</th>     
		              </tr>
		          </thead>
		          <tbody> 
		            <?php 
		              $query4 = sprintf("SELECT * FROM inve_encuesta, oficina_registro where
				        inve_encuesta.id_oficina=oficina_registro.id_oficina_registro AND
				        inve_encuesta.id_oficina=".$pre_ori." AND
				        estado_inve_encuesta=1");              
		              $result = $mysqli->query($query4);
		              while($row = $result->fetch_array(MYSQLI_ASSOC)) {
		            ?>
		            <tr>
		              <!-- <td><?php echo $row['inve_elemento']; ?></td> -->
		              <td><?php echo $row['inve_marca']; ?></td>
		              <td><?php echo $row['inve_modelo']; ?></td>
		              <td><?php echo $row['inve_placa']; ?></td>
		              <td><?php echo $row['inve_serial']; ?></td>
		              <td><?php echo $row['inve_bueno']; ?></td>
		              <td><?php echo $row['inve_danado']; ?></td>
		              <td><?php echo $row['inve_baja']; ?></td>
		              <td><?php echo $row['inve_observacion']; ?></td>
		            </tr>
		            <?php
		              } // cierre de while
		            ?>
		            <script>
				      	$(document).ready(function() {
						  $('#comoatoencuesta').DataTable({
						  	"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
						    "language": {
						      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
						    }
						  });
						});
				    </script>
		          </tbody>
		        </table>
		      </div> <!-- /.table-responsive -->
			</div>

			</div> <!-- cierre de row -->
        	

        	
	    </div>
	   </div>
	</div>
</div>

<?php
} else {}
?>
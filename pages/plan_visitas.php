<?php
$nump211 = privilegios(211, $_SESSION['snr']);

$realdatecompleto = date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-05-25 08:00:00");
$fecha_limite = strtotime("2023-12-31 17:00:00");

date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$fechaAno = date("Y");
if (1==$_SESSION['rol']) {
	
	
	
if (isset($_POST['vigencia'])) {	


$tamano_archivo=17301504;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');

$directoryftp="filesnr/visitas/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'planvisita-'.$_SESSION['snr'].''.date("YmdGis");

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
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  


$insertSQL = sprintf("INSERT INTO plan_visita (
id_area, nombre_plan_visita, vigencia, cantidad, estado_plan_visita) 
VALUES (%s, %s, %s,  %s, %s)", 
GetSQLValueString($_POST['id_area'], "int"), 
GetSQLValueString($files, "text"), 
GetSQLValueString($_POST['vigencia'], "int"),
GetSQLValueString($_POST['cantidad'], "int"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;




$emailur2='giovanni.ortegon@supernotariado.gov.co';
$subject = 'SOLICITUD DE REVISIÓN DE PLAN DE VISITAS';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Se ha creado un nuevo plan de visitas para la Superintendencia de Notariado y Registro.<br><br>';
$cuerpo2 .= '<br><br><a href="https://sisg.supernotariado.gov.co/plan_visitas.jsp"></a>https://sisg.supernotariado.gov.co/plan_visitas.jsp<br>';

$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);

 
 
   
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
  
	
	
	
}
	
	
	
	if (isset($_POST['aprobar'])) {	

$updateSQL778 = sprintf("UPDATE plan_visita SET aprobado=%s where id_plan_visita=%s",
    GetSQLValueString($_POST['aprobar'], "int"),
GetSQLValueString($_POST['id_plan_visita'], "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
//echo $updateSQL778;
echo $actualizado;	


}

	
	

?>
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo existencia('plan_visita'); ?></h3>

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
		  

			<button type="button" class="btn  btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
                NUEVO
              </button>  <span><b>PLANES DE VISITAS</b></span>
			
          </div>
        </div> <!-- FINAL box-header with-border -->

        <div class="box-body">
          <div class="table-responsive">
            <table class="table display" id="inforesoluciones" cellspacing="0" width="100%">
              <thead>
                <tr align="center" valign="middle">
                  <th>Fecha</th>
                  <th>Area</th>
                  <th>Vigencia</th>
				  <th>Planeadas</th>
				   <th>Generales</th>
			 <th>Especiales</th>
				  <th>Documento</th>
		   <th>Estado</th>
	
		    <th>Acceso</th>
				   <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
				
function generales($valor) {
global $mysqli;
$query4p = sprintf("select count(id_visita) as contadornn 
from visita where id_plan_visita=".$valor." and tipo_visita='General' and estado_visita=1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array();
$resp=$row4p['contadornn'];
return $resp;
$result4p->free();
}
	

function especiales($valor) {
global $mysqli;
$query4p = sprintf("select count(id_visita) as contadornn 
from visita where id_plan_visita=".$valor." and tipo_visita='Especial' and estado_visita=1"); 
$result4p = $mysqli->query($query4p);
$row4p = $result4p->fetch_array();
$resp=$row4p['contadornn'];
return $resp;
$result4p->free();
}

	
				
				
                if (1 == $_SESSION['rol'] or 0 < $nump111) {
                  $query4 = "select * from plan_visita, area where plan_visita.id_area=area.id_area and estado_plan_visita=1 ";
                } else {
                  $query4 = "select * from plan_visita, area where plan_visita.id_area=area.id_area  and estado_plan_visita=1";
                }
                $result = $mysqli->query($query4);
                while ($row = $result->fetch_array()) {
                ?>
                  <tr>
                    <?php
                    $id_res = $row['id_plan_visita'];

                    echo '<td>';
                    echo $row['fecha'];
                    echo '</td>';

                     echo '<td>'.$row['nombre_area'].'</td>';
                 
				   echo '<td>';
                    echo $row['vigencia'];
                    echo '</td>';
					
					
					echo '<td>';
                    echo $row['cantidad'];
                    echo '</td>';
					
					echo '<td>';
                    echo generales($id_res);
                    echo '</td>';
					
					
					echo '<td>';
                    echo especiales($id_res);
                    echo '</td>';
					
					
					
					echo '<td>';
                 echo '<a href="filesnr/visitas/'.$row['nombre_plan_visita'].'" target="_blank">Soporte</a>';
                    echo '</td>';
					
					
				    echo '<td>';
					
					if (isset($row['aprobado'])) {
					
					
					
                    if (1==$row['aprobado']) {
						echo 'Aprobado';
					} else {
						echo 'Rechazado';
					}
					
					} else {
						
 echo ' <a href="" title="Revisar" id="'.$id_res.'" class="revisar_plan_visita" data-toggle="modal" data-target="#popupconfirmar">
				 <button class="btn btn-xs btn-warning">
<span class="fa fa-edit"></span> Revisar</button></a>';
						
					}
					
					
                    echo '</td>';
					
					ECHO '<td>';
					 if (1==$row['aprobado']) {
echo '<a href="visitas&'.$id_res.'.jsp"  class="btn btn-xs btn-success" >
<span class="fa fa-check"></span> Acceder</a>';
					} else {
						echo '';
					}
					ECHO '</td>';
					
                    echo '<td>';
                   
                  
                    if (1 == $_SESSION['rol']) {
                      echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="plan_visita" id="' . $id_res . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
                    } else {
                    }
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
                    'excelHtml5',

                     'pdfHtml5'
                  ],
                  "lengthMenu": [
                    [50, 100, 200, 300, 500],
                    [50, 100, 200, 300, 500]
                  ],
                  "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [1, "desc"]
                  ]
                });
              });
            </script>
          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->

      </div> <!-- FINAL PRIMARY -->
    </div> <!-- FINAL DE COL MD 12 -->
  </div><!-- FINAL DE ROW -->




  <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
        </div>
        <div class="modal-body">

          <form action="" method="POST" name="formagregarnuevobeneficiariot"  enctype="multipart/form-data">


 <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> AREA:</label>
              <select class="form-control" name="id_area" >
			  <option></option>
			  	<?php
$select = mysql_query("select * from area where id_area in (5, 6, 9, 10, 11, 26, 27)  order by nombre_area ", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_area'].'" ';
	echo '>'.$row['nombre_area'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 
mysql_free_result($select);
			?>
			  </select>
            </div>
			

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label>
              <input type="text" class="form-control" id="namef" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
            </div>


  <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Vigencia:</label>
              <select class="form-control" name="vigencia" >
			  <option></option>
			  <option>2018</option>
			  <option>2019</option>
			  <option>2020</option>
			  <option>2021</option>
			  <option>2022</option>
			  <option <?php if (2023==date('Y')) { echo 'selected'; } else {} ?>>2023</option>
			  <option <?php if (2024==date('Y')) { echo 'selected'; } else {} ?>>2024</option>
			  <option <?php if (2025==date('Y')) { echo 'selected'; } else {} ?>>2025</option>
			  </select>
            </div>
			


           <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Número de visitas programadas para la vigencia:</label>
              <input type="text" class="form-control numero" name="cantidad" placeholder="Solo números" required>
            </div>


 <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Documento anexo:</label>
              <input type="file" class="form-control" name="file" placeholder="Anexo firmado" required>
            </div>
			

            <div class="modal-footer">
              <button type="reset" class="btn btn-default " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-ok"></span> Crear</button>
            </div>

          </form>


        </div>
      </div>
    </div>
  </div>




<div class="modal fade bd-example-modal-lg" id="popupconfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel2"><b>Revisar plan de visitas</b><span style="font-weight: bold;"></span></h4>
</div> 
<div  class="modal-body">

  <form action="" method="POST" name="formagregarnuevobeneficiariot">
  
   <input type="hidden"  name="id_plan_visita" id="id_plan_visita" value="">
   
 <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Aprueba cantidad de planes de visitas:</label>
              <select class="form-control" name="aprobar"  required>
			  <option></option>
			   <option value="1">Si</option>
			    <option value="0">No</option>
			  </select>
            </div>


            <div class="modal-footer">
              <button type="reset" class="btn btn-default " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              <button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-ok"></span> Crear</button>
            </div>

          </form>
		  
	
   </div>
    </div>
  </div>
</div>


<?php
} else {
  echo 'No tiene acceso. ';
} ?>
<?php
if (isset($_GET['i'])) {
	
$id=intval($_GET['i']);
$nump169 = privilegios(169, $_SESSION['snr']);

$realdatecompleto = date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-05-25 08:00:00");
$fecha_limite = strtotime("2023-12-31 17:00:00");

date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$fechaAno = date("Y");
if (1==$_SESSION['rol']  or 0<$nump169) {
	
	
	
	
	
	
	
	if ((isset($_POST["fmasivo"])) && ("" != $_POST["fmasivo"])) {


if ('Especial'==$_POST['tipo_visita']) {

$vis=explode("---",$_POST['visita_especial']);
$vis1=$vis[0];
$vis2=$vis[1];

$queryyy="select id_tipo_visita, auto_titulo, auto_texto from tipo_visita where estado_tipo_visita=1 and 
id_tipo_visita=".$vis1." and id_area=".$_POST['id_area_visita']." limit 1";
$select276 = mysql_query($queryyy, $conexion);
$row276 = mysql_fetch_assoc($select276);

if (0<$row276['id_tipo_visita']){
$titulo=$row276['auto_titulo'];
$objeto=$row276['auto_texto'];

} else {}
mysql_free_result($select276);

} else {
	
	
$queryyy="select id_tipo_visita, auto_titulo, auto_texto from tipo_visita where estado_tipo_visita=1 and 
tipo=0 and id_area=".$_POST['id_area_visita']." limit 1";
$select276 = mysql_query($queryyy, $conexion);
$row276 = mysql_fetch_assoc($select276);
if (0<$row276['id_tipo_visita']){
$titulo=$row276['auto_titulo'];
$objeto=$row276['auto_texto'];
} else {}
mysql_free_result($select276);

	
}




$estud=$_POST['codigo_oficinam'];
for ($u=0;$u<count($estud);$u++)    
{     
$estu=$estud[$u];    

$insertSQL = sprintf("INSERT INTO visita (
 id_plan_visita, mes, tipo_visita, visita_especial, tipo_comision, asunto, objeto, periodo_inicial, 
 periodo_final, id_tipo_oficina, codigo_oficina, estado_visita) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"),
GetSQLValueString($_POST['mes'], "int"), 
GetSQLValueString($_POST['tipo_visita'], "text"), 
GetSQLValueString($vis2, "text"), 
GetSQLValueString($_POST['tipo_comision'], "text"), 
GetSQLValueString($titulo, "text"), 
GetSQLValueString($objeto, "text"), 
GetSQLValueString($_POST['periodo_inicial'], "date"), 
GetSQLValueString($_POST['periodo_final'], "date"),
GetSQLValueString($_POST['id_tipo_oficina'], "int"), 
GetSQLValueString($estu, "int"),  
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

 }
 
 echo $insertado;
 
 
} else {}



	
	
	
	
	
	
	
	
	
	
	
	
	
	
	if (isset($_GET['e']) && ""!=$_GET['e']) {	
	$numv=$_GET['e'];
$updateSQL778 = sprintf("UPDATE visita SET aprobacion_visita=%s, aprobacion_funcionario=%s where id_visita=%s", 
GetSQLValueString(1, "int"), 
GetSQLValueString($_SESSION['snr'], "int"),   
GetSQLValueString($numv, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 
 
$emailur2='giovanni.ortegon@supernotariado.gov.co';
$subject = 'VISITA APROBADA';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#777777;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Se ha creado aprobado una visita para la Superintendencia de Notariado y Registro.<br><br>';
$cuerpo2 .= '<br><br><a href="https://sisg.supernotariado.gov.co/detalle_visita&'.$numv.'.jsp"></a>https://sisg.supernotariado.gov.co/detalle_visita&'.$numv.'.jsp<br>';

$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);

 
 
}
	
	
	
	
if (isset($_POST['codigo_oficina'])) {	

if ('Especial'==$_POST['tipo_visita']) {

$vis=explode("---",$_POST['visita_especial']);
$vis1=$vis[0];
$vis2=$vis[1];

$queryyy="select id_tipo_visita, auto_titulo, auto_texto from tipo_visita where estado_tipo_visita=1 and 
id_tipo_visita=".$vis1." and id_area=".$_POST['id_area_visita']." limit 1";
$select276 = mysql_query($queryyy, $conexion);
$row276 = mysql_fetch_assoc($select276);

if (0<$row276['id_tipo_visita']){
$titulo=$row276['auto_titulo'];
$objeto=$row276['auto_texto'];

} else {}
mysql_free_result($select276);

} else {
	
	
$queryyy="select id_tipo_visita, auto_titulo, auto_texto from tipo_visita where estado_tipo_visita=1 and 
tipo=0 and id_area=".$_POST['id_area_visita']." limit 1";
$select276 = mysql_query($queryyy, $conexion);
$row276 = mysql_fetch_assoc($select276);
if (0<$row276['id_tipo_visita']){
$titulo=$row276['auto_titulo'];
$objeto=$row276['auto_texto'];
} else {}
mysql_free_result($select276);

	
}




$insertSQL = sprintf("INSERT INTO visita (
 id_plan_visita, mes, tipo_visita, visita_especial, tipo_comision, asunto, objeto, fecha_inicial, fecha_final, periodo_inicial, 
 periodo_final, id_tipo_oficina, codigo_oficina, estado_visita) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"),
GetSQLValueString($_POST['mes'], "int"), 
GetSQLValueString($_POST['tipo_visita'], "text"), 
GetSQLValueString($vis2, "text"), 
GetSQLValueString($_POST['tipo_comision'], "text"), 
GetSQLValueString($titulo, "text"), 
GetSQLValueString($objeto, "text"), 
GetSQLValueString($_POST['fecha_inicial'], "date"), 
GetSQLValueString($_POST['fecha_final'], "date"),
GetSQLValueString($_POST['periodo_inicial'], "date"), 
GetSQLValueString($_POST['periodo_final'], "date"),
GetSQLValueString($_POST['id_tipo_oficina'], "int"), 
GetSQLValueString($_POST['codigo_oficina'], "int"),  
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);
echo $insertado;

}
	
	
	
$select = mysql_query("select * from plan_visita, area where plan_visita.id_area=area.id_area 
	and aprobado=1 and estado_plan_visita=1 and id_plan_visita=".$id." limit 1", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){

$id_area=''.$row['id_area'].'';
$plan=''.$row['id_plan_visita'].'';
$vigencia=''.$row['vigencia'].'';
$cantidad=''.$row['cantidad'].'';
$nombre_area=''.$row['nombre_area'].'';

} else {  }	 
mysql_free_result($select);


?>
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo $vigencia; ?></h3>

          <p>Vigencia</p>
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
          <h3><?php echo $cantidad; ?></h3>

          <p>Visitas planeadas</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>


<?php





function comisionantes($idf) {
	global $mysqli;
	$infocom='';
	$querym = "select * from funcionario_visita, funcionario where 
funcionario_visita.id_funcionario=funcionario.id_funcionario and id_visita=".$idf." 
and estado_funcionario_visita=1  order by nombre_funcionario";
$resultadom = $mysqli->query($querym);
	 while ($obj = $resultadom->fetch_object()) {
   $infocom.=  $obj->nombre_funcionario.'<br>';
    }
	$resultadom->free();
	return $infocom;
}




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

?>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">

          <h3><?php  echo generales($id); ?></h3>

          <p>Visitas generales</p>
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
          <h3><?php  echo especiales($id); ?></h3>

          <p>Visitas especiales</p>
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
              </button>   
			  
			  
			  
			  <button type="button" class="btn  btn-warning" data-toggle="modal" data-target="#miModalmasivo"><span class="glyphicon glyphicon-plus-sign"></span>
                MASIVA
              </button> 
			  
			  
			  <span><b>Visitas  - <?php echo $nombre_area; ?></b></span>
			
          </div>
        </div> <!-- FINAL box-header with-border -->

        <div class="box-body">
          <div class="table-responsive">
            <table class="table display" id="inforesoluciones" cellspacing="0" width="100%">
              <thead>
                <tr align="center" valign="middle">
                  <th>Creación</th>
                  <th>Tipo</th>
				   <th>Especial</th>
                  <th>Fecha inicio</th>
				  <th>Fecha final</th>
                 <th>Mes</th>
                <th>Destino</th>
				<th>Estado</th>
				<th>Objeto</th>
				<th>Comisionantes</th>
				<th>Estado</th>
				    <th>Detalle</th>
				   <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (1 == $_SESSION['rol']) {
                  $query4 = "SELECT * from visita where id_plan_visita=".$id." and estado_visita=1   ";
                } else {
					
					if (11==$_SESSION['snr_area']) {  // curadurias
						$area=27;
					} else {
						$area=$_SESSION['snr_area'];
					}
					
                  $query4 = "SELECT * from visita, plan_visita where visita.id_plan_visita=plan_visita.id_plan_visita and id_area=".$area." and visita.id_plan_visita=".$id." and estado_visita=1  ";
           
				}
                $result = $mysqli->query($query4);
                while ($row = $result->fetch_array()) {
                ?>
                  <tr>
                    <?php
                    $id_res = $row['id_visita'];

                    echo '<td>';
                    echo $row['fecha'];
                    echo '</td>';
                     echo '<td>';
					 echo $row['tipo_visita'];
					 echo '</td>';
					 
					    echo '<td>';
					 echo $row['visita_especial'];
					 echo '</td>';
					 
					 
				   echo '<td>';
                echo $row['fecha_inicial'];
                    echo '</td>';
					echo '<td>';
                  echo $row['fecha_final'];
                    echo '</td>';
					
					echo '<td>';
                    echo ucfirst(mese($row['mes']));
                    echo '</td>';
					
					
					echo '<td>';
                 $code=$row['codigo_oficina'];
				 
		if (10==$id_area or 24==$id_area) {
			    echo quees('notaria', $code);
			   
			   } else if (9==$id_area) {
			      echo quees('oficina_registro', $code);
				
				} else if (27==$id_area) {
			     echo quees('curaduria', $code);
				
				} else if (9==$id_area) {
			      echo quees('catastro', $code);
				
			   } else {
				   
				   
			   }
			   
				 
				 
                    echo '</td>';
					
					
						echo '<td>';
                  if (1==$row['aprobacion_visita']) {
					  echo 'Aprobada';
				  } else {  echo 'En tramite'; }
				  
                    echo '</td>';
					
					
						echo '<td>';
                  echo $row['objeto'];
                    echo '</td>';
					
						echo '<td>';
                  $comisionantes=comisionantes($id_res);
				  echo $comisionantes;
                    echo '</td>';
					
					
					
							 echo '<td>';
							 if (isset($row['aprobacion_visita'])) {
							 if (1==$row['aprobacion_visita']) { echo 'Aprobada'; } 
							 else if (0==$row['aprobacion_visita']) {
								 echo 'Negada';
							 } else {
								 
							 }
							 } else {
								 
								 
				  
				  
								 if (""!=$comisionantes && isset($row['fecha_inicial']) && isset($row['fecha_final'])) {
								 			 
echo '<a href="visitas&'.$id.'&'.$id_res.'.jsp"  class="btn btn-xs btn-warning aprobar_registro" >Aprobar</a>';

								 } else {
									 echo 'En tramite';
								 }
							 }
echo '</td>';		
					
                 
				 echo '<td>';
echo '<a href="detalle_visita&'.$id_res.'.jsp"  class="btn btn-xs btn-success" >
 Detalles</a>';
echo '</td>';
                   
                    echo '<td>';
                    if (1 == $_SESSION['rol'] or 0 < $nump211) {
                      echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="visita" id="' . $id_res . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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
                    [0, "desc"]
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

          <form action="" method="POST" name="formagregerghc6546iariot">

 <input type="hidden" class="form-control" name="id_area_visita" required value="<?php echo $id_area; ?>">




            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label>
              <input type="text" class="form-control" id="namef" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
            </div>

        

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Mes:</label>
              <select name="mes" class="form-control" required>
                <option></option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
				<option value="3">Marzo</option>
				<option value="4">Abril</option>
				<option value="5">Mayo</option>
				<option value="6">Junio</option>
				<option value="7">Julio</option>
				<option value="8">Agosto</option>
				<option value="9">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
              </select>
            </div>


<?php
   if (10==$id_area or 24==$id_area) {
	echo '<input type="hidden" name="id_tipo_oficina" value="3">';
			   
			   } else if (9==$id_area) {
		echo '<input type="hidden" name="id_tipo_oficina" value="2">';
				
				} else if (27==$id_area) {
			echo '<input type="hidden" name="id_tipo_oficina" value="4">';
				
				} else if (9==$id_area) {
		echo '<input type="hidden" name="id_tipo_oficina" value="5">';
				
			   } else {
				   
				   
			   }
			   
			   ?>

<div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Oficina:</label>
              <select class="form-control" name="codigo_oficina"  required>
			  <option></option>
			   <?php 
			   if (10==$id_area or 24==$id_area) {
			   echo lista('notaria'); 
			   
			   } else if (9==$id_area) {
			    echo lista('oficina_registro'); 
				
				} else if (27==$id_area) {
			    echo lista('curaduria'); 
				
				} else if (9==$id_area) {
			    echo lista('catastro'); 
				
			   } else {
				   
				   
			   }
			   
			   ?>
			  </select>
            </div>
			
			
   
   <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de comisión:</label>
              <select class="form-control" name="tipo_comision"  required>
			  <option></option>
			   <option value="Solicitud">Solicitud</option>
			    <option value="Orden administrativa">Orden administrativa</option>
				 <option value="Virtual">Virtual</option>
				 <option value="Presencial">Presencial</option>
				 <option value="Semipresencial">Semipresencial</option>
				
			  </select>
            </div>
			
			
	<div style="color:#777777;">El <a href="tipo_visita.jsp" target="_blank">objeto</a> depende del tipo y subtipo de la visita.</div>
        
		
   
 <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de visita:</label>
              <select class="form-control" name="tipo_visita" id="tipo_visitam" required>
			  <option></option>
			   <option value="General">General</option>
			    <option value="Especial">Especial</option>
			  </select>
            </div>
			
			
			
			
			 <div class="form-group text-left" id="ver_visita_especialm" style="display:none;">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de visita especial:</label>
              <select class="form-control" name="visita_especial" id="visita_especialm" >
			  <option></option>
				
<?php
$select = mysql_query("select * from tipo_visita where tipo=1 and estado_tipo_visita=1 and id_area=".$id_area." order by nombre_tipo_visita ", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_visita'].'---'.$row['nombre_tipo_visita'].'" ';
	echo '>'.$row['nombre_tipo_visita'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);

?>

			  </select>
            </div>
			
			
			
			
			
			
			 <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span>Duración, Fecha de Inicio:</label>
              <input type="text" class="form-control datepicker" readonly required name="fecha_inicial"  value="">
            </div>
			
			 <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span>Duración, Fecha final:</label>
              <input type="text" class="form-control datepicker"  readonly required name="fecha_final"  value="">
            </div>
			
			
			<div class="form-group text-left">  
              <label class="control-label">Periodo de revisión, Desde:</label>
<?php


			   if (10==$id_area or 24==$id_area) {
			  $nuevafecha = strtotime ('-5 year' , strtotime($realdate));
$fechaff= date ('Y-m-d',$nuevafecha);
			   
			   } else if (9==$id_area) {
		$nuevafecha = strtotime ('-5 year' , strtotime($realdate));
$fechaff= date ('Y-m-d',$nuevafecha);
				
				} else if (27==$id_area) {
			$nuevafecha = strtotime ('-2 year' , strtotime($realdate));
$fechaff= date ('Y-m-d',$nuevafecha);
				
				} else if (9==$id_area) {
	$nuevafecha = strtotime ('-5 year' , strtotime($realdate));
$fechaff= date ('Y-m-d',$nuevafecha);
				
			   } else {
				   
				   
			   }
			   
			   ?>
			   



			  
              <input type="text" class="form-control datepickera"  readonly style="max-width:50%;" name="periodo_inicial"  value="<?php  echo $fechaff; ?>">
            </div>
			
			 <div class="form-group text-left">  
              <label class="control-label">Periodo de revisión, Hasta:</label>
              <input type="text" class="form-control datepickera"  readonly style="max-width:50%;" name="periodo_final"  value="<?php echo date('Y-m-d'); ?>">
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




















 <div class="modal fade" id="miModalmasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
        </div>
        <div class="modal-body">

          <form action="" method="POST" name="forma435435gregerghciariot">

 <input type="hidden" class="form-control" name="id_area_visita" required value="<?php echo $id_area; ?>">

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label>
              <input type="text" class="form-control" id="namef" name="fmasivo" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
            </div>

        

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Mes:</label>
              <select name="mes" class="form-control" required>
                <option></option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
				<option value="3">Marzo</option>
				<option value="4">Abril</option>
				<option value="5">Mayo</option>
				<option value="6">Junio</option>
				<option value="7">Julio</option>
				<option value="8">Agosto</option>
				<option value="9">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
              </select>
            </div>


<?php
   if (10==$id_area or 24==$id_area) {
	echo '<input type="hidden" name="id_tipo_oficina" value="3">';
			   
			   } else if (9==$id_area) {
		echo '<input type="hidden" name="id_tipo_oficina" value="2">';
				
				} else if (27==$id_area) {
			echo '<input type="hidden" name="id_tipo_oficina" value="4">';
				
				} else if (9==$id_area) {
		echo '<input type="hidden" name="id_tipo_oficina" value="5">';
				
			   } else {
				   
				   
			   }
			   
			   ?>

<div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Oficinas (Seleccionar varias con el Mouse+Control):</label>
              <select class="form-control" name="codigo_oficinam[]" multiple required style="height:200px;">
			
			   <?php 
			   if (10==$id_area or 24==$id_area) {
			   echo lista('notaria'); 
			   
			   } else if (9==$id_area) {
			    echo lista('oficina_registro'); 
				
				} else if (27==$id_area) {
			    echo lista('curaduria'); 
				
				} else if (9==$id_area) {
			    echo lista('catastro'); 
				
			   } else {
				   
				   
			   }
			   
			   ?>
			  </select>
            </div>
			
			
   
   <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de comisión:</label>
              <select class="form-control" name="tipo_comision"  required>
			  <option></option>
			   <option value="Solicitud">Solicitud</option>
			    <option value="Orden administrativa">Orden administrativa</option>
				 <option value="Virtual">Virtual</option>
				 <option value="Presencial">Presencial</option>
				 <option value="Semipresencial">Semipresencial</option>
				
			  </select>
            </div>
			
   	 <div style="color:#777777;">El <a href="tipo_visita.jsp" target="_blank">objeto</a> depende del tipo y subtipo de la visita.</div>
             


 <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de visita:</label>
              <select class="form-control" name="tipo_visita" id="tipo_visita" required>
			  <option></option>
			   <option value="General">General</option>
			    <option value="Especial">Especial</option>
			  </select>
            </div>
			
			
			
			
			 <div class="form-group text-left" id="ver_visita_especial" style="display:none;">  
			 
			 
		
			 <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de visita especial:</label>
              <select class="form-control" name="visita_especial" id="visita_especial" >
			  <option></option>
				
<?php
$select = mysql_query("select * from tipo_visita where tipo=1 and estado_tipo_visita=1 and id_area=".$id_area." order by nombre_tipo_visita ", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_tipo_visita'].'---'.$row['nombre_tipo_visita'].'" ';
	echo '>'.$row['nombre_tipo_visita'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);

?>

			  </select>
            </div>
			
			
			
			
			
			
		
			
			
			<div class="form-group text-left">  
              <label class="control-label">Periodo de revisión, Desde:</label>
<?php


			   if (10==$id_area or 24==$id_area) {
			  $nuevafecha = strtotime ('-5 year' , strtotime($realdate));
$fechaff= date ('Y-m-d',$nuevafecha);
			   
			   } else if (9==$id_area) {
		$nuevafecha = strtotime ('-5 year' , strtotime($realdate));
$fechaff= date ('Y-m-d',$nuevafecha);
				
				} else if (27==$id_area) {
			$nuevafecha = strtotime ('-2 year' , strtotime($realdate));
$fechaff= date ('Y-m-d',$nuevafecha);
				
				} else if (9==$id_area) {
	$nuevafecha = strtotime ('-5 year' , strtotime($realdate));
$fechaff= date ('Y-m-d',$nuevafecha);
				
			   } else {
				   
				   
			   }
			   
			   ?>
			   



			  
              <input type="text" class="form-control datepickera"  readonly style="max-width:50%;" name="periodo_inicial"  value="<?php  echo $fechaff; ?>">
            </div>
			
			 <div class="form-group text-left">  
              <label class="control-label">Periodo de revisión, Hasta:</label>
              <input type="text" class="form-control datepickera"  readonly style="max-width:50%;" name="periodo_final"  value="<?php echo date('Y-m-d'); ?>">
            </div>


<!--
 <div class="form-group text-left">  
<label class="control-label"><span style="color:#ff0000;">*</span> Objeto de la visita:</label>
<textarea spellcheck="true" lang="es" class="form-control" name="objeto" id="compose-textarea">
<?php
/*
 if (10==$id_area or 24==$id_area) {
		echo '';	   
			   } else if (9==$id_area) {
	  echo '';	
				} else if (27==$id_area) {
		echo 'Verificar la adecuada prestación de la función pública delegada en el Curador Urbano, y que la misma se cumpla en las condiciones administrativas, financieras, jurídicas y técnicas requeridas para el estudio, trámite y expedición de licencias urbanísticas y las actuaciones asociadas a las mismas.';
} else { }
*/
?>
</textarea>
</div>
-->



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
} 


} else {
  echo 'No tiene acceso. ';
}

?>
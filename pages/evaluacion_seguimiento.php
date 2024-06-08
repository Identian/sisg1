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
	
	
	
	
	if (isset($_GET['e']) && ""!=$_GET['e']) {	
	$numv=$_GET['e'];
$updateSQL778 = sprintf("UPDATE visita SET aprobacion_visita=%s, aprobacion_funcionario=%s where id_visita=%s", 
GetSQLValueString(1, "int"), 
GetSQLValueString($_SESSION['snr'], "int"),   
GetSQLValueString($numv, "int"));
 $Result8 = mysql_query($updateSQL778, $conexion);
 
 

 
 
}
	
	
	
	
if (isset($_POST['tipo_visita'])) {	
$insertSQL = sprintf("INSERT INTO visita (
 id_plan_visita, mes, tipo_visita, visita_especial, tipo_comision, objeto, fecha_inicial, fecha_final, periodo_inicial, 
 periodo_final, id_tipo_oficina, codigo_oficina, estado_visita) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($id, "int"),
GetSQLValueString($_POST['mes'], "int"), 
GetSQLValueString($_POST['tipo_visita'], "text"), 
GetSQLValueString($_POST['visita_especial'], "text"), 
GetSQLValueString($_POST['tipo_comision'], "text"), 
GetSQLValueString($_POST['objeto'], "text"), 
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
          <h3><?php echo existencia('evaluacion_segui'); ?></h3>

          <p>Evaluaciones</p>
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
          <h3><?php echo $realdate; ?></h3>

          <p>Fecha</p>
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

          <h3>920</h3>

          <p>Notarias</p>
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

          <p>Orips</p>
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
              </button>   <span> <b>Evaluación y seguimiento  - <?php echo quees('area',$id); ?></b></span>
			
          </div>
        </div> <!-- FINAL box-header with-border -->

        <div class="box-body">
          <div class="table-responsive">
            <table class="table display" id="inforesoluciones" cellspacing="0" width="100%">
              <thead>
                <tr align="center" valign="middle">
                  <th>Creación</th>
				  <th>Área</th>
				   <th>Auto Comisorio</th>
				   <th>Fecha de Auto</th>
                  <th>Tipo</th>
				  <th>Número</th>
               <th>Descripción</th>
		 <th></th>
				   <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (1 == $_SESSION['rol'] or 0 < $nump111) {
                  $query4 = "SELECT * from evaluacion_segui, area where evaluacion_segui.id_area=area.id_area and estado_evaluacion_segui=1   ";
                } else {
                  $query4 = "SELECT * from evaluacion_segui, area where evaluacion_segui.id_area=area.id_area and area.id_area=".$_SESSION['snr_area']." and estado_evaluacion_segui=1  ";
                }
                $result = $mysqli->query($query4);
                while ($row = $result->fetch_array()) {
                ?>
                  <tr>
                    <?php
                    $id_res = $row['id_evaluacion_segui'];

                    echo '<td>';
                    echo $row['fecha_evaluacion_segui'];
                    echo '</td>';
                     echo '<td>';
					 echo $row['nombre_area'];
					 echo '</td>';
					 
					    echo '<td>';
					 echo $row['id_visita'];
					 echo '</td>';
					 
					   echo '<td>';
					 echo $row['ano_visita'];
					 echo '</td>';
					 
					 
				   echo '<td>';
                echo $row['tipo'];
                    echo '</td>';
					
					
						   echo '<td>';
                echo $row['numero_eval'];
                    echo '</td>';
					
					
					echo '<td>';
                  echo $row['nombre_evaluacion_segui'];
                    echo '</td>';
					
				
					
					
					echo '<td>';
					
                echo '<a href="'.$row['url'].'">Anexo</a>';

                    echo '</td>';
					
					
    
                    echo '<td>';
                    if (1 == $_SESSION['rol'] or 0 < $nump211) {
                      echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="evaluacion_segui" id="' . $id_res . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
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

          <form action="" method="POST" name="formagregerghciariot">


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label>
              <input type="text" class="form-control" id="namef" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
            </div>

        

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Auto de comisión:</label>
              <select name="auto" class="form-control" required>
                <option></option>
<?php
$select = mysql_query("select * from visita, plan_visita where visita.id_plan_visita=plan_visita.id_plan_visita and estado_visita=1 and plan_visita.id_area=".$id." and auto is not null", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_visita'].'" ';
	echo '>'.$row['auto'].' del '.$row['fecha_auto'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);

?>
              </select>
            </div>



			
   
 <div class="form-group text-left">  
              <label class="control-label"><span style="color:#ff0000;">*</span> Tipo de evaluación:</label>
              <select class="form-control" name="tipo_visita" id="tipo_visita" required>
			  <option></option>
			   <option value="Plan de mejoramiento">Plan de mejoramiento</option>
			    <option value="Auto de archivo">Auto de archivo</option>
				 <option value="Traslado a disciplinariol">Traslado a disciplinario</option>
			  </select>
            </div>
			
			
	  <div class="form-group text-left">
              <label class="control-label">Anexo:</label>
              <input type="file" class="form-control" name="file">
            </div>




 <div class="form-group text-left">  
<label class="control-label">Descripción:</label>
<textarea spellcheck="true" lang="es" class="form-control" name="descripcion" id="compose-textarea">

</textarea>
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
  echo 'No tiene acceso.';
} 


} else {
  echo 'No tiene acceso. ';
}

?>
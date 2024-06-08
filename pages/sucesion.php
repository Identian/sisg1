<?php
$nump=privilegios(18,$_SESSION['snr']);


if ((1==$_SESSION['rol'] or 0<$nump) and isset($_GET["i"])){
$id =$_GET["i"];  
$numpnota=0;
} else {
	
	
$id=$_SESSION['id_vigilado'];
$numpnota=privilegiosnotariado($id, 2, $_SESSION['snr']);
$salida=privilegiosnotariado($id, 9, $_SESSION['snr']);
	
}
	
if (isset($_GET["e"]) && ""!=$_GET["e"]) {
	$idbor=intval($_GET["e"]);

	
$query80 = "SELECT * FROM sucesion  WHERE id_sucesion =".$idbor." and id_notaria=".$id." limit 1";  
$selectby2 = mysql_query($query80, $conexion);
$rowby2 = mysql_fetch_assoc($selectby2);
$numero_acta=$rowby2['numero_acta'];
$fecha_acta=$rowby2['fecha_acta'];


$query82 = "SELECT count(numero_acta) as totactas FROM sucesion WHERE estado_sucesion = 1 
AND id_notaria = ".$id." 
AND numero_acta = ".$numero_acta." 
AND fecha_acta = '".$fecha_acta."' limit 1";  
$selectby = mysql_query($query82, $conexion);
$rowby = mysql_fetch_assoc($selectby);
$totactas=$rowby['totactas'];


if($totactas > 1) {
 $query84 = "UPDATE sucesion SET estado_sucesion=0  WHERE id_sucesion = ".$idbor." limit 1";  
 $query86 = "UPDATE causante SET estado_causante =0  WHERE id_sucesion = ".$idbor." limit 50";  
$Result1 = mysql_query($query84, $conexion);
$Result12 = mysql_query($query86, $conexion);
}
// echo $actualizado;
echo '<meta http-equiv="refresh" content="0;URL=sucesion&'.$id.'.jsp" />';


	} else {}
	
	
	
	
	




IF ((3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) or (1==$_SESSION['rol']  or  0<$nump) or (0<$numpnota)) { 
 
	
 
 
 
 if (isset($_POST['archsucesion']) && $_POST['archsucesion'] != ' ' ) {


	$id_funcionario = $_SESSION['snr'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_acta = $_POST['fecha_acta'];
	$fecha_reg_creacion = $_POST['fecha_reg_creacion'];
	$tfecha_inicio = strlen($_POST['fecha_inicio']);
	$tfecha_acta = strlen($_POST['fecha_acta']);
	$tfecha_reg_creacion = strlen($_POST['fecha_reg_creacion']);
	

    $cc_funcionario_reg = $_SESSION['cedula_funcionario'];
	

             
$numero_acta = intval($_POST["numero_acta"]);
$fecha_acta = $_POST["fecha_acta"];




$query5 = sprintf("SELECT count(id_sucesion) as cuentasuce  
	FROM sucesion 
	WHERE id_notaria = ".$id." 
	AND   numero_acta = ".$numero_acta."
	AND   fecha_acta = '$fecha_acta'
	AND   estado_sucesion = 1 "); 
$select5 = mysql_query($query5, $conexion);
$row5 = mysql_fetch_assoc($select5);
$totalRows5 = $row5['cuentasuce'];
if ($id > 0 && $totalRows5 > 0) { 

echo $repetido; 


} else {
	
	// para guardar la cc del Notario

    $cedula_funcionario = '9999';
	
	$query5 = sprintf("SELECT cedula_funcionario 
	              FROM posesion_notaria, funcionario, tipo_nombramiento_n 
                  where id_cargo = 1 
				  and posesion_notaria.id_funcionario = funcionario.id_funcionario 
				  and posesion_notaria.id_tipo_nombramiento_n = tipo_nombramiento_n.id_tipo_nombramiento_n 
				  and id_notaria= '$id' 
				  and estado_funcionario = 1 
				  and estado_posesion_notaria=1 
				  order by fecha_inicio desc "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){
       $cedula_funcionario = $row5['cedula_funcionario'];
   }


	$insertSQL = sprintf("INSERT INTO sucesion (
        id_notaria, id_tsucesion, 
		fecha_inicio, numero_acta, fecha_acta, 
		id_estado_sucesion, cc_funcionario_reg, id_causa_terminacion, 
		fecha_reg_creacion, fecha_reg_terminacion, cc_funcionario_notario, 
		id_tipodcto_terminacion, num_causantes, estado_sucesion, fecha_registro) 
		VALUES (%s,0,%s,%s,%s,1,%s,null,%s,null,%s,null,%s,1,now())", 
      GetSQLValueString($id, "int"), 
      GetSQLValueString($_POST["fecha_inicio"], "date"),  
      GetSQLValueString($_POST["numero_acta"], "text"),
	  GetSQLValueString($_POST["fecha_acta"], "date"),
	  GetSQLValueString($cc_funcionario_reg, "text"),
	  GetSQLValueString($_POST["fecha_reg_creacion"], "date"),
	  GetSQLValueString($cedula_funcionario, "text"),
	  GetSQLValueString($_POST["num_causantes"], "int")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

      echo $hecho;
	  
 
   $query12 = sprintf("SELECT id_sucesion
	FROM sucesion 
	WHERE id_notaria = ".$id." 
	AND   numero_acta = ".$numero_acta."
	and fecha_acta='$fecha_acta'
	AND   estado_sucesion = 1 limit 1"); 
   $select12 = mysql_query($query12, $conexion) or die(mysql_error());
   $row12 = mysql_fetch_assoc($select12);
   $totalRows12 = mysql_num_rows($select12);
   if ($totalRows12 > 0){
      $id_sucesion = $row12['id_sucesion'];
	   echo '<meta http-equiv="refresh" content="0;URL=consulta_sucesion&'.$id_sucesion.'.jsp" />';
   }
}


 mysql_free_result($Result);	

}
 
 
 
 
?>
	 

	 
	 
	 

<?php if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && (""!=$_SESSION['posesionnotaria'] or ""!=$_SESSION['id_vigilado'])))
{ include 'menu_notaria.php'; } else { } ?>	 

	  
	  
<div class="row">
<div class="col-md-12">

 <div class="box box-info">
  <div class="box-header with-border">
    
<?php if((3==$_SESSION['rol'] && 3 == $_SESSION['snr_tipo_oficina']) or  $_SESSION['rol'] == 1 ) {
 ?>
       <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</button>&nbsp;
       <p>&nbsp;</p>
   <?php } ?>
   

    <div class="col-md-7">
	<form action="" method="POST" name="for585858m1" > 
      <div class="input-group">
        <div class="input-group-btn">
          <select class="form-control" name="campo" required>
            <option value="" selected> - - Buscar por: - -  </option>
 		    <option value="num_dcto_causante">Identificación Causante</option>

		    <option value="numero_acta">Número Acta en mi Notaria</option>
			
			<option value="numero_acta2">Número Acta en Colombia</option>
			
		   <!--  <option value="fecha_acta">Fecha Acta (yyyy-mm-dd)</option>
		   <option value="fecha_reg_terminacion">Fecha terminación (yyyy-mm-dd)</option>-->
          </select>
        </div>
        <div class="input-group-btn"><input type="text" name="buscar" placeholder="Buscar" class="form-control" required >
		</div>
        <div class="input-group-btn">
            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button> 
        </div>
      </div>
	  </form>
    </div>
	
	<div class="col-md-5">
	<div class="input-group-btn">
	        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#reponotaria"><span class="glyphicon glyphicon-list-alt"></span> Informe Notaria</button>&nbsp;
         </div>
	</div>




      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
  
    <div class="box-body">
				<style>
.dataTables_filter {
display:none;
}
			</style>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  <th>Notaria</th>
               
                  <th>Num Acta</th>
                  <th>Fecha Acta</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                  <th>Estado</th>
                 <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
			/*  if(isset($_POST['buscausante']) && $_POST['buscausante'] = 'bdctocau'){
				 
				 
				  $dctob_causante = str_replace(".","",$_POST['dctob_causante']);
              $query875 = sprintf("SELECT *
						  FROM sucesion, notaria, causante,  estado_sucesion
                          WHERE notaria.id_notaria = sucesion.id_notaria
						  AND REPLACE(causante.num_dcto_causante, '.', '') = ".$dctob_causante."   
						  AND sucesion.id_sucesion = causante.id_sucesion
						  AND estado_sucesion.id_estado_sucesion = sucesion.id_estado_sucesion
                          AND sucesion.estado_sucesion = 1 
						  AND causante.estado_causante = 1 limit 10 ");
			echo "<p><b>"."Documento del Causante: "."</b>".$dctob_causante."</p>";
			 } else { 
             $query875 = sprintf("SELECT sucesion.id_notaria, sucesion.id_sucesion, nombre_notaria, numero_acta, fecha_acta, 
                          fecha_inicio, fecha_reg_terminacion, des_estado_sucesion 
			              FROM sucesion, notaria, estado_sucesion
                          WHERE notaria.id_notaria = sucesion.id_notaria
						  AND sucesion.id_notaria = ".$id." 
						  AND estado_sucesion.id_estado_sucesion = sucesion.id_estado_sucesion  
                          AND sucesion.estado_sucesion = 1 ");

						  
					*/

	 if (isset($_POST['buscar']) && ""!=$_POST['buscar']) {	 
	             $nom_campo = $_POST['campo'];
				if ($nom_campo == 'numero_acta2'){
					$nom_campo = 'numero_acta';
				}
				$vr_campo = "'".$_POST['buscar']."'";	
                $datobus= ' ';
	            if ($_POST['campo'] == 'num_dcto_causante') {
                   $dctob_causante = str_replace(".","",$_POST['buscar']);
				   $datobus=" and REPLACE(causante.num_dcto_causante, '.', '') = ".$dctob_causante;
                } 
				
				if ($_POST['campo'] == 'numero_acta') {
				   $datobus=" and sucesion.".$nom_campo." = ".$vr_campo." and sucesion.id_notaria = ".$id;
                }
				
				if ($_POST['campo'] == 'numero_acta2') {
				   $datobus=" and sucesion.".$nom_campo." = ".$vr_campo;
                }
				
            if($_POST['campo'] == 'numero_acta' or $_POST['campo'] == 'numero_acta2'){
               $query875 = sprintf("SELECT distinct sucesion.id_notaria, sucesion.id_sucesion, nombre_notaria, numero_acta, fecha_acta, 
                          fecha_inicio, fecha_reg_terminacion, des_estado_sucesion
						  FROM sucesion
						  left join notaria
						  on sucesion.id_notaria = notaria.id_notaria
						  left join estado_sucesion
						  on sucesion.id_estado_sucesion = estado_sucesion.id_estado_sucesion
						  WHERE sucesion.estado_sucesion = 1".$datobus." limit 500 ");

            } else {				
            // echo $actualizado;
            // echo '<meta http-equiv="refresh" content="0;URL=sucesion&'.$id.'.jsp" />';				
				

				
$query875 = sprintf("SELECT distinct sucesion.id_notaria, sucesion.id_sucesion, nombre_notaria, numero_acta, fecha_acta, 
                          fecha_inicio, fecha_reg_terminacion, des_estado_sucesion
						  FROM causante
						  left join sucesion
						  on (causante.id_sucesion = sucesion.id_sucesion
						      AND sucesion.estado_sucesion = 1 )
						  left join notaria
						  on sucesion.id_notaria = notaria.id_notaria
						  left join estado_sucesion
						  on sucesion.id_estado_sucesion = estado_sucesion.id_estado_sucesion
						 WHERE causante.estado_causante = 1 ".$datobus." limit 500 ");
			}
						 } else { 
             $query875 = sprintf("SELECT distinct sucesion.id_notaria, sucesion.id_sucesion, nombre_notaria, numero_acta, fecha_acta, 
                          fecha_inicio, fecha_reg_terminacion, des_estado_sucesion 
			              FROM sucesion, notaria, estado_sucesion
                          WHERE notaria.id_notaria = sucesion.id_notaria
						  AND sucesion.id_notaria = ".$id." 
						  AND estado_sucesion.id_estado_sucesion = sucesion.id_estado_sucesion  
                          AND sucesion.estado_sucesion =1  ");

						  

             } 
			 
            $select875 = mysql_query($query875, $conexion) or die(mysql_error());
            while($row_dian = mysql_fetch_array($select875)) {
     
			
            ?>
          <tr>
             <td><?php $iddian=$row_dian['id_notaria'];?><?php echo $row_dian['nombre_notaria'];?></td>
             <?php $idsucesion=$row_dian['id_sucesion'];?>
             <td><?php echo $row_dian['numero_acta'];?></td>
             <td><?php echo $row_dian['fecha_acta'];?></td>
             <td><?php echo $row_dian['fecha_inicio'];?></td>
             <td><?php echo $row_dian['fecha_reg_terminacion'];?></td>
             <td style = 'color: red;'><?php echo $row_dian['des_estado_sucesion'];?></td>
             <td>
<!--   actas_sucesion   <a href="sucesion_delete&<?php echo $idsucesion; ?>.jsp"><span class="pull-right-container"><small class="label pull-right bg-green">Eliminar</small></span></a> &nbsp;
  cargue_causantes / cargue_sucesiones  <a href="sucesion_update&<?php echo $idsucesion; ?>.jsp"><span class="pull-right-container"><small class="label pull-right bg-red">Editar</small></span></a> &nbsp; -->
<!--                <a href="actas_sucesion&<?php // echo $idsucesion; ?>.jsp"><span class="pull-right-container"><small class="label pull-right bg-green">Cargar Actas</small></span></a> &nbsp; -->
               <?php if(($row_dian['id_notaria']==$_SESSION['id_vigilado'] or (1==$_SESSION['rol'] or 0<$nump)) and ($id == $row_dian['id_notaria'])){ ?>
                <a href="consulta_sucesion&<?php echo $idsucesion; ?>.jsp"><span class="pull-left-container"><small class="label pull-left bg-green">Consultar</small></span></a> &nbsp;
               
                <a href="sucesion&<?php echo $id; ?>&<?php echo $idsucesion; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar"  ><span class="glyphicon glyphicon-trash"></span></a>
							
			   <?php } ?>
             </td>
          </tr>
         
         


      <?php } ?> <!-- CIERRE PRIMER WHILE -->

          <script>
		  
		  		$(document).ready(function() {
					$('#tab_sucesiones').DataTable({
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
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>REGISTRO LIQUIDACI&Oacute;N HERENCIA</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                   <form action="" method="POST" name="for546456456m1" >
				         <input type="hidden" name="id_notaria" id="id_notaria"   value="<?php echo $id; ?>">
                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"></i>FECHA INICIO:</label>   
                              <input type="text" class="form-control datepickerjo" name="fecha_inicio" readonly="readonly" value="" required >
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label">N&Uacute;MERO ACTA:</label>   
                              <input type="number" class="form-control" id="numero_acta" name="numero_acta"  value="" required >
                         </div>
                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"></i>FECHA ACTA:</label>   
                              <input type="text" class="form-control datepickerjo" name="fecha_acta" readonly="readonly" value="" required >
                         </div>
                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"></i>FECHA CREACI&Oacute;N:</label>   
                              <input type="text" class="form-control datepickerjo" name="fecha_reg_creacion" readonly="readonly" value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label">N&Uacute;MERO DE CAUSANTES:</label>   
                              <input type="number" class="form-control" id="num_causantes" name="num_causantes" value="" required >
                         </div>
        
                		 <div class="modal-footer">
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="archsucesion" value="sucesion">
                              <span class="glyphicon glyphicon-ok"></span>Guardar</button>
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div> 










<div class="modal fade" id="reponotaria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>INFORME NOTARIA</b></h4>
              </div> 
              <div id="nAventura" class="modal-body"> 
			  <?php
if (isset($_POST['genrep']) && $_POST['genrep'] == 'genrep') {
    $id_notaria = $_POST['id_notaria2'];
	$anno_desde = $_POST['anno_desde2'];
	$anno_hasta = $_POST['anno_hasta2'];
	$annos = $anno_desde.'-'.$anno_hasta;
    echo '<meta http-equiv="refresh" content="0;URL=xls/repnotaria1&'.$id_notaria.'&'.$annos.'.xls" />';
 }
 ?>
                   <form action="" method="POST" name="form3">

				         <input type="hidden" name="id_notaria2" id="id_notaria2"   value="<?php echo $id; ?>" >
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Año Desde (AAAA):</label> 
                              <input type="number" class="form-control" id="anno_desde2"  name="anno_desde2" value="" required >
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Año Hasta (AAAA):</label> 
                              <input type="number" class="form-control" id="anno_hasta2"  name="anno_hasta2" onchange ="valrango();" value="" required >
                         </div>
						     
                		 <div class="modal-footer">
						      <span style="color:#ff0000;">(*) Campos obligatorios</span>&nbsp; &nbsp; 
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="genrep" value="genrep">
                              <span class="glyphicon glyphicon-ok"></span>Generar</button></br>
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div>

  
<?php } else {echo 'No tiene acceso'; }  ?>

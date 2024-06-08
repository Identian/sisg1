<?php

$nump147=privilegios(147,$_SESSION['snr']);


$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;
$id_tipo_ausentismo = 0;

if (1==$_SESSION['rol'] or 0<$nump147) {

	$id_funcionario = $_SESSION['snr'];
	 
	$query5 = sprintf("SELECT * FROM funcionario
                  where id_funcionario = '$id_funcionario' 
				  and estado_funcionario = 1 "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){
       $id_cargo = $row5['id_cargo'];
	   $id_tipo_oficina = $row5['id_tipo_oficina'];
	   $id_grupo_area = $row5['id_grupo_area'];
	   $id_oficina_registro = $row5['id_oficina_registro'];
   }
 
   if (isset($_GET['i'])) { 
   $id_operador_catastral=intval($_GET['i']);
   } else {
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
   }

    } else { 
    echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 
 
if ($id_operador_catastral > 0) { // Hasta el final
	
	$id_operador_catastral=intval($_GET['i']);
	
	
    $query4 = sprintf("SELECT id_operador_catastral, cod_operador_catastral,
			                                  nombre_operador_catastral, a.id_natu_juridica_operador,
											  a.nit_operador, a.digito_verificacion, d.nombre_natu_juridica_operador,
											  repre_legal, dir_operador, tel_operador, correo_operador
			                                FROM operador_catastral a
											LEFT JOIN natu_juridica_operador d
											ON a.id_natu_juridica_operador = d.id_natu_juridica_operador
      WHERE a.id_operador_catastral = '$id_operador_catastral' 
	  AND estado_operador_catastral = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
	$id_operador_catastral = $row4['id_operador_catastral'];
    $cod_operador_catastral = $row4['cod_operador_catastral'];
	$nombre_operador_catastral = $row4['nombre_operador_catastral'];
	$id_natu_juridica_operador = $row4['id_natu_juridica_operador'];
	$nombre_natu_juridica_operador = $row4['nombre_natu_juridica_operador'];
	$nit_operador = $row4['nit_operador'];
	$digito_verificacion = $row4['digito_verificacion'];
	$repre_legal = $row4['repre_legal'];
	$dir_operador = $row4['dir_operador'];
	$tel_operador = $row4['tel_operador'];
	$correo_operador = $row4['correo_operador'];
 }


mysql_free_result($select4);


if ((isset($_POST["insertcontra"])) && ($_POST["insertcontra"] == "contrato")) { // 1
    $id_municipio = 846;
	$insertSQL5 = sprintf("INSERT INTO contratos_operador (
      id_operador_xgestor, num_contrato, id_tipo_contrato_operador, 
	  detalle_otros, objeto_contrato, procesos_catastrales, 
	  id_producto_operador, subproductos, 
	  valor_contrato, duracion_meses, duracion_dias,
      fecha_inicio_contrato, fecha_fin_contrato,
	  fecha_inicio_servicio, fecha_fin_servicio, id_municipio) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
					 %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($id_operador_catastral, "int"), 
      GetSQLValueString($_POST['num_contrato'], "text"), 
      GetSQLValueString($_POST['id_tipo_contrato_operador'], "text"), 
      GetSQLValueString($_POST['detalle_otros'], "text"), 
	  GetSQLValueString($_POST['objeto_contrato'], "text"), 
	  GetSQLValueString($_POST['procesos_catastrales'], "text"),
      GetSQLValueString($_POST['id_producto_operador'], "int"), 
	  GetSQLValueString($_POST['subproductos'], "text"),
	  GetSQLValueString($_POST['valor_contrato'], "text"),
      GetSQLValueString($_POST['duracion_meses'], "int"), 
	  GetSQLValueString($_POST['duracion_dias'], "int"), 
      GetSQLValueString($_POST['fecha_inicio_contrato'], "date"),
	  GetSQLValueString($_POST['fecha_fin_contrato'], "date"),
      GetSQLValueString($_POST['fecha_inicio_servicio'], "date"),
	  GetSQLValueString($_POST['fecha_fin_servicio'], "date"),
	  GetSQLValueString($id_municipio, "int")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());

  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_operador&'.$id_operador_catastral.'.jsp" />';
} 

if ((isset($_POST["insertmuni"])) && ($_POST["insertmuni"] == "insertmuni")) { // 1
     $id_operador_catastral = $_POST['id_operador_catastral'];
     $id_municipio = $_POST['id_municipio'];
	 $id_municipio2 = 0;
global $mysqli;
 
    $query37 = "SELECT *
			  FROM municipio_operador 
			  WHERE id_operador_catastral = '$id_operador_catastral'
			   AND id_municipio = '$id_municipio' 
			   AND estado_municipio_operador = 1 ";
    $result37 = $mysqli->query($query37);
    while ($obj37 = $result37->fetch_array()) {
        $id_municipio2 = $obj37['id_municipio_operador'];
    }
$result37->free();	

if ($id_municipio != $id_municipio2) {

	$insertSQL5 = sprintf("INSERT INTO municipio_operador (
     id_operador_catastral, id_municipio) 
	  VALUES (%s, %s)", 
      GetSQLValueString($id_operador_catastral, "int"), 
      GetSQLValueString($id_municipio, "int")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());
	  
//  echo '<meta http-equiv="refresh" content="0;URL= ./consulta_gestor&'.$id_gestor_catastral.'.jsp" />';
}
} 

?>

<script>
     $(document).ready(function() {
      $('.nuevoc').on('click', function() {   
	 alert ('entro en llamdo de nvocontrato');	  
          $("#contrato").modal("show");
      });  
    });

</script>

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
			    <li><a href="catastro_operador&<?php echo $id_operador_catastral; ?>.jsp"><b>OPERADOR CATASTRAL</b></a></li>
            </ul>
        </div>
		 
      </div>
    </nav>
  </div>
</div>

<?php
// *******************************
// Consulta operador
// *******************************		
?>

<div class="row">
    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <div class="row-md-6 text-left">
                 <h3 class="box-title"><b>CONSULTA OPERADOR CATASTRAL</b></h3> &nbsp; &nbsp; 
				  <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
    		     <a id="" class="ventana1" data-toggle="modal" data-target="#updoperador" href="" title="Modificar operador"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></a>
				  <?php } ?>
   </div>
             <input type="hidden" class="form-control" name="tot_causantes" id="tot_causantes" readonly="readonly" value="">
		  <div class="row-md-6 text-right">
	</div>
	    <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">Código operador:</label>   
                       <?php echo $row4['cod_operador_catastral']; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Nombre operador:</label>   
                       <?php echo $row4['nombre_operador_catastral']; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Representante Legal:</label>   
                       <?php echo $row4['repre_legal']; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">Naturaleza Jurídica:</label>   
                       <?php echo $row4['nombre_natu_juridica_operador']; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">NIT operador:</label>   
                       <?php echo $row4['nit_operador']; ?>
                    </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Dirección operador:</label>   
                        <?php echo $row4['dir_operador']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Teléfono operador:</label>   
                        <?php echo $row4['tel_operador']; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">Correo operador:</label>   
                        <?php echo $row4['correo_operador']; ?>
                  </div>
				</div>  
             </div>
        </div>
  </div>
  </div>
   </div> 
 </div>

<?php

// ********************************
// Nuevo Contrato operador
// ********************************
?>
<div class="modal fade" id="ncontrato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVO CONTRATO</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form43115534555">
    <input type="hidden" class="form-control" id="id_operador_catastral" name="id_operador_catastral" value="<?php echo $id_operador_catastral; ?>">
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Número Contrato:</label>   
        <input type="text" class="form-control" id="num_contrato"  name="num_contrato" value="" required >
    </div>
    <div class="form-group text-left"> 
      <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo Contrato:</label> 
      <select class="form-control" name="id_tipo_contrato_operador" id="id_tipo_contrato_operador" required >
      <option value="" selected></option>
         <?php echo lista('tipo_contrato_operador'); ?>
      </select>
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Objeto Contrato:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="objeto_contrato"  name="objeto_contrato"  value=""></textarea>
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Procesos Catastrales:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="procesos_catastrales"  name="procesos_catastrales"  value=""></textarea>
    </div>
    <div class="form-group text-left"> 
      <label  class="control-label"><span style="color:#ff0000;">*</span> Producto Operador:</label> 
      <select class="form-control" name="id_producto_operador" id="id_producto_operador" onChange = "valotros3();" required >
      <option value="" selected></option>
         <?php echo lista('producto_operador'); ?>
      </select>
    </div>
    <div id = "detotros" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Detalle Otros:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="detalle_otros"  name="detalle_otros"  value=""></textarea>
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span>Subproducto:</label>   
        <textarea type="text"  rows="5" cols="40" class="form-control" id="subproductos"  name="subproductos"  value=""></textarea>
    </div>

    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Valor Contrato:</label>   
        <input type="number" class="form-control" id="valor_contrato" name="valor_contrato" value="" required >
    </div>
    <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Duración Meses:</label>   
        <input type="number"  class="form-control" id="duracion_meses" name="duracion_meses" value="" required >
    </div>
     <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Duración Días:</label>   
        <input type="number"  class="form-control" id="duracion_dias" name="duracion_dias" value="" required >
    </div>
   <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio Contrato:</label>   
        <input type="date" class="form-control" id="fecha_inicio_contrato" name="fecha_inicio_contrato" value="" required >
    </div>
   <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Contrato:</label>   
        <input type="date" class="form-control" id="fecha_fin_contrato" name="fecha_fin_contrato" value="" required >
    </div>
   <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Inicio Servicio:</label>   
        <input type="date" class="form-control" id="fecha_inicio_servicio" name="fecha_inicio_servicio" value="" required >
    </div>
   <div class="form-group text-left"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Fecha Fin Servicio:</label>   
        <input type="date" class="form-control" id="fecha_fin_servicio" name="fecha_fin_servicio" value="" required >
    </div>

	<div class="modal-footer">
        <span style="color:#ff0000;">(*) Campos obligatorios</span>
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="insertcontra" value="contrato">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 

<?php

// ********************************
// Nuevo Municipio Operador
// ********************************
?>
<div class="modal fade" id="nmunicipio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
  <h4 class="modal-title" id="myModalLabel"><b>NUEVO MUNICIPIO</b><span style="font-weight: bold;"></span></h4>
</div> 
<div class="modal-body"> 
  <form action="" method="POST" name="form431156755"  enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_operador_catastral" name="id_operador_catastral" value="<?php echo $id_operador_catastral; ?>">
	<div class="form-group text-left"> 
	     <label  class="control-label"><span style="color:#ff0000;">*</span> Municipio Gestor:</label> 
	     <select class="form-control" name="id_municipio" id="id_municipio" required>
         <option value="" selected></option>
         <?php echo deptociud(); ?>
         </select>
    </div>

	<div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="insertmuni" value="insertmuni">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
	</div>
	
  </form>
</div>
</div> 
</div> 
</div> 


 
 <?php
 // ************************************
 // Detalle de contratos operador
 // ************************************
 ?>
 
 		<div class="row">
			<div class="col-md-8">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'CONTRATOS DEL OPERADOR'; ?>
					   </h4> 
					   <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
                       <h4>
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ncontrato"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Contrato</a> 
					   </h4> 
					   <?php } ?>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID</th>
                                <th>Tipo Contrato</th>
								<th>Nro Contrato</th>
								<th>Objeto Contrato</th>
                                <th>Duración Meses</th>
								<th>Duración Días</th>
                                <th>Fecha Inicio</th>
                                <th>Valor Contrato</th>
                                <th>Accion</th>
                             </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT a.id_contratos_operador, 
			    a.id_operador_xgestor, a.num_contrato, a.id_tipo_contrato_operador,
				b.nombre_tipo_contrato_operador, a.detalle_otros, a.objeto_contrato, 
			    a.procesos_catastrales, a.id_producto_operador, 
				c.nombre_producto_operador, a.subproductos, 
				a.valor_contrato, a.duracion_meses, a.duracion_dias, 
				a.fecha_inicio_contrato, a.fecha_fin_contrato, a.fecha_inicio_servicio, 
				a.fecha_fin_servicio, id_municipio
	            FROM contratos_operador a
				LEFT JOIN tipo_contrato_operador b
				ON a.id_tipo_contrato_operador = b.id_tipo_contrato_operador
				LEFT JOIN producto_operador c
				ON a.id_producto_operador = c.id_producto_operador
                WHERE id_operador_xgestor = '$id_operador_catastral'  
				AND estado_contratos_operador = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	 
                 $id_contratos_operador = $row62['id_contratos_operador'];			  
            ?>
          <tr>
             <td><?php echo $row62['id_contratos_operador'];?></td>
			 <td style = "display: none"><?php echo $row62['id_operador_xgestor']; ?></td>
			 <td><?php echo $row62['num_contrato'];?></td>
			 <td style = "display: none"><?php echo $row62['id_tipo_contrato_operador'];?></td>
			 <td><?php echo $row62['nombre_tipo_contrato_operador']; ?></td>
			 <td><?php echo $row62['objeto_contrato'];?></td>
			 <td><?php echo $row62['duracion_meses'];?></td>
			 <td><?php echo $row62['duracion_dias'];?></td>
             <td><?php echo $row62['fecha_inicio_contrato'];?></td>
			 <td class="text-right" ><?php echo number_format($row62['valor_contrato']);?></td>
			 <td style = "display: none"><?php echo $row62['detalle_otros'];?></td>
			 <td style = "display: none"><?php echo $row62['procesos_catastrales'];?></td>
			 <td style = "display: none"><?php echo $row62['id_producto_operador'];?></td>
			 <td style = "display: none"><?php echo $row62['nombre_producto_operador'];?></td>
			 <td style = "display: none"><?php echo $row62['subproductos'];?></td>
			 <td style = "display: none"><?php echo $row62['fecha_fin_contrato'];?></td>
			 <td style = "display: none"><?php echo $row62['fecha_inicio_servicio'];?></td>
			 <td style = "display: none"><?php echo $row62['fecha_fin_servicio'];?></td>
			 <td style = "display: none"><?php echo $row62['id_municipio'];?></td>
			 
             <td>
			    <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
                <a href="modi_contrato_operador&<?php echo $id_contratos_operador; ?>.jsp"><span class="btn btn-success btn-xs" title="Modificaciones al Contrato">Modificación al Contrato</a> &nbsp;
				<?php } ?>
             </td>
		     <td> 
			   <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="contratos_operador" id="<?php echo $row62['id_contratos_operador']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
			   <?php } ?>
			 </td>
          </tr>
          <?php } ?> 
          </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->

<?php
 // ******************************************
 // Detalle de Municipios por Operador
 // ******************************************
 ?>
 
			<div class="col-md-4">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4>
					     <?php echo 'MUNICIPIOS DEL OPERADOR'; ?>
					   </h4> 
					    <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
                       <h4>
<!-- 					   <button type="button" class="btn btn-success btn-xs nuevoc">Nuevo Contrato</button> -->
         		       <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#nmunicipio"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Municipio</a> 
					   </h4> 
						<?php } ?>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID</th>
                                <th>Departamento</th>
                                <th>Municipio</th>
								<th>Indicativo</th>
                                <th colspan="4">Accion</th>
                             </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT a.id_municipio_operador, 
			    b.id_departamento, nombre_municipio,
				nombre_departamento, b.indicativo
	            FROM municipio_operador a
				LEFT JOIN municipio c
				ON a.id_municipio = c.id_municipio 
			    LEFT JOIN departamento b
				ON c.id_departamento = b.id_departamento
                WHERE id_operador_catastral = '$id_operador_catastral'  
				AND estado_municipio_operador = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	 
            ?>
          <tr>
             <td><?php echo $row62['id_municipio_operador']; ?></td>
            <td><?php echo $row62['nombre_departamento'];?></td> 
			 <td><?php echo $row62['nombre_municipio']; ?></td>
			 <td><?php echo $row62['indicativo']; ?></td>
		     <td> 
			  <?php if($id_tipo_oficina == 1 and (0<$nump147 or $_SESSION['rol'] == 1)) { // Grupo Catastro ?>
			   <a style="color:#ff0000;cursor: pointer" title="Borrar" name="municipio_gestor" id="<?php echo $row62['id_municipio_operador']; ?>" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>
			  <?php } ?>
			 </td>
          </tr>
          <?php } ?> 
          </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div>
</div><!-- col-md-12 -->


</div><!-- row -->


<?php
// *************************************
// MODIFICACION operador
// **************************************
?>
		
<div class="modal fade" id="updoperador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN OPERADOR</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 


<form action="" method="post" name="form43257435224">

    <input type="hidden" class="form-control" name="id_operador_catastral" id="id_operador_catastral" value="<?php echo $id_operador_catastral; ?>">

    <div class="form-group text-left"> 
      <label  class="control-label">Código operador:</label>   
      <input type="text" class="form-control" name="cod_operador_catastral" value="<?php echo $cod_operador_catastral; ?>" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Nombre operador:</label>   
      <input type="text" class="form-control" name="nombre_operador_catastral" value="<?php echo $nombre_operador_catastral; ?>" required >
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label"><span style="color:#ff0000;">*</span> Naturaleza Jurídica:</label> 
      <select class="form-control" name="id_natu_juridica_operador" id="id_natu_juridica_operador" required >
      <option value="<?php echo $id_natu_juridica_operador; ?>" selected><?php echo $nombre_natu_juridica_operador; ?></option>
         <?php echo lista('natu_juridica_operador'); ?>
      </select>
    </div>
						 
    <div class="form-group text-left"> 
      <label  class="control-label">NIT operador:</label>   
      <input type="text" class="form-control" name="nit_operador" value="<?php echo $nit_operador; ?>" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label"><span style="color:#ff0000;">*</span>Digito Verificación NIT:</label>   
      <input type="number" class="form-control" id="digito_verificacion" name="digito_verificacion"  value="<?php echo $digito_verificacion; ?>" required >
    </div>

	
    <div class="form-group text-left"> 
      <label  class="control-label">Representante Legal:</label>   
      <input type="text" class="form-control" name="repre_legal" value="<?php echo $repre_legal; ?>" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Dirección operador:</label>   
      <input type="text" class="form-control" name="dir_operador" value="<?php echo $dir_operador; ?>" required >
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Teléfono operador:</label>   
      <input type="text" class="form-control" name="tel_operador" value="<?php echo $tel_operador; ?>" required >
    </div>

	<div class="form-group text-left"> 
      <label  class="control-label">Correo operador:</label>   
      <input type="text" class="form-control" name="correo_operador" value="<?php echo $correo_operador; ?>" required >
    </div>
	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver()">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="modioperador" value="operador">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>

<?php
// ***************************
// Modificacion Contrato
// ***************************
?>

<div class="modal fade"  id="modiausen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>MODIFICACIÓN CONTRATO</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4324424">

    <input type="hidden" class="form-control" name="id_operador_catastral" id="id_operador_catastral" readonly="readonly" value="<?php echo $id_operador_catastral; ?>">

	
    <div class="form-group text-left"> 
      <label  class="control-label">ID Contrato:</label>   
      <input type="text" class="form-control" name="id_contratos_operador" id="id_contratos_operador" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Nombre Contrato:</label>   
      <input type="text" class="form-control" name="nombre_contratos_operador2" id="nombre_contratos_operador2" value="" required>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Tipo Contrato:</label>   
      <input type="text" class="form-control" name="tipo_contrato2" id="tipo_contrato2" value="" required>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Objeto Contrato:</label>   
      <input type="text" class="form-control" name="objeto_contrato2" id="objeto_contrato2" value="" required>
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Duración Contrato:</label>   
      <input type="text" class="form-control" name="duracion_contrato2" id="duracion_contrato2" value="" required >
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">Fecha Inicio Contrato:</label>   
      <input type="date" class="form-control" name="fecha_ini_servicio2" id="fecha_ini_servicio2" value="" required >
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">Valor Contrato:</label>   
      <input type="text" class="form-control" name="valor_contrato2" id="valor_contrato2" value="" required >
    </div>
	
    <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actcontra" value="contrato">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>





<?php 
}

// mysql_free_result($update);

?>

<?php

// *****************************************
// Registro Modificacion operador
// *****************************************

if (isset($_POST['modioperador']) && $_POST['modioperador'] == 'operador'){

	$id_operador_catastral = $_POST['id_operador_catastral'];

    $updateSQL37 = sprintf("UPDATE operador_catastral 
	        SET cod_operador_catastral = %,
			nombre_operador_catastral = %s, 
	        id_natu_juridica_operador = %s,
			nit_operador = %s,
			digito_verificacion = %s,
			repre_legal = %s,
			dir_operador = %s,
			tel_operador = %s,
			correo_operador = %s
			WHERE id_operador_catastral = %s",                  
	GetSQLValueString($_POST['cod_operador_catastral'], "text"),
	GetSQLValueString($_POST['nombre_operador_catastral'], "text"),
	GetSQLValueString($_POST['id_natu_juridica_operador'], "text"),
	GetSQLValueString($_POST['nit_operador'], "int"),
	GetSQLValueString($_POST['digito_verificacion'], "int"),
	GetSQLValueString($_POST['repre_legal'], "text"),
	GetSQLValueString($_POST['dir_operador'], "text"),
	GetSQLValueString($_POST['tel_operador'], "text"),
	GetSQLValueString($_POST['correo_operador'], "text"),
	GetSQLValueString($id_operador_catastral, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_operador&'.$id_operador_catastral.'.jsp" />';
 }

?>

<?php

// *****************************************
// Registro de Modificacion Contrato
// *****************************************

if (isset($_POST['actcontra']) && $_POST['actcontra'] == 'contrato'){

	$id_contratos_operador = $_POST['id_contratos_operador'];

    $updateSQL37 = sprintf("UPDATE contratos_operador 
	        SET tipo_contrato = %s, 
	        nombre_contratos_operador = %s,
			objeto_contrato = %s,
			duracion_contrato = %s,
			fecha_ini_servicio = %s,
			valor_contrato = %s
			WHERE id_contratos_operador = %s",                  
	GetSQLValueString($_POST['tipo_contrato2'], "text"),
	GetSQLValueString($_POST['nombre_contratos_operador2'], "text"),
	GetSQLValueString($_POST['objeto_contrato2'], "text"),
	GetSQLValueString($_POST['duracion_contrato2'], "text"),
	GetSQLValueString($_POST['fecha_ini_servicio2'], "date"),
	GetSQLValueString($_POST['valor_contrato2'], "text"),
	GetSQLValueString($id_contratos_operador, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());
		 
	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./consulta_operador&'.$id_operador_catastral.'.jsp" />';
 }

?>


<?php
function deptociud() {
		
global $mysqli;
 
    $query17 = "SELECT m.id_municipio id_municipio, 
	          concat(nombre_municipio,' - ', nombre_departamento) nom_municipio
			  FROM departamento d, municipio m 
			  WHERE d.id_departamento = m.id_departamento
			   AND d.estado_departamento = 1 
			   AND m.estado_municipio = 1
				ORDER BY nom_municipio ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj17['id_municipio'], $obj17['nom_municipio']);
    }
$result17->free();	
 }

?>

<script>
     $(document).ready(function() {
      $('.editbtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#modiausen").modal("show");
          $('#id_contratos_operador').val(data[0]);
          $('#tipo_contrato2').val(data[1]);
          $('#nombre_contratos_operador2').val(data[2]);
          $('#objeto_contrato2').val(data[3]);
          $('#duracion_contrato2').val(data[4]);
		  $('#fecha_ini_servicio2').val(data[5]);
          $('#valor_contrato2').val(data[6]);
      });  
    });

</script>

<script>
    function valotros3() {
//	alert('valotros');
	var productoper = document.getElementById('id_producto_operador').value;
		if ( productoper == 3) {
			detotros.style.display='block';
			document.getElementById('detalle_otros').focus();
		} else {
			detotros.style.display='none';
			document.getElementById('detalle_otros').value = ' ';
			document.getElementById('subproductos').focus();
        }
    }
</script>
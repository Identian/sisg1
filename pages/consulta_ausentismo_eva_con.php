<?php
$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;
$id_tipo_ausentismo = 0;

if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {
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
      $nodo = explode('x', $_GET['i']);
      $id_funcionario=$nodo[0];
      $fecha_inicio=$nodo[1];
      $fecha_final=$nodo[2];
	  $id_ausentismo=$nodo[3];
	  $nodo_dev = $id_funcionario.'x'.$fecha_inicio.'x'.$fecha_final;
	  
	  $query8 = sprintf("SELECT * FROM ausentismo
                  where id_ausentismo = '$id_ausentismo' 
				 AND estado_ausentismo = 1 "); 
    $select8 = mysql_query($query8, $conexion) or die(mysql_error());
    $row8 = mysql_fetch_assoc($select8);
    $totalRows8 = mysql_num_rows($select8);
    if ($totalRows8 > 0){
       $id_tipo_ausentismo = $row8['id_tipo_ausentismo'];
   } else {
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
   }

    }
 
if ($id_tipo_ausentismo > 0) { // Hasta el final
	
    $query4 = sprintf("SELECT au.id_funcionario, au.id_tipo_ausentismo, 
      fecha_inicio, hora_inicio, fecha_final, hora_final, 
      au.id_funcionario_jefe, au.id_funcionario_reempla,
      motivo_ausentismo, soli.nombre_funcionario funcionario_soli,
	  soli.id_cargo, soli.id_tipo_oficina, soli.id_grupo_area, 
	  soli.id_oficina_registro,
	  tipoa.nombre_tipo_ausentismo, jefe.nombre_funcionario funcionario_jefe,
	  reem.nombre_funcionario funcionario_reem, 
	  au.id_aprobacion_ausentismo, apa.nombre_aprobacion_ausentismo
      FROM ausentismo au
      LEFT JOIN funcionario soli
      ON  au.id_funcionario = soli.id_funcionario
      LEFT JOIN tipo_ausentismo tipoa
      ON au.id_tipo_ausentismo = tipoa.id_tipo_ausentismo
      LEFT JOIN funcionario jefe
      ON  au.id_funcionario_jefe = jefe.id_funcionario
      LEFT JOIN funcionario reem
      ON  au.id_funcionario_reempla = reem.id_funcionario
      LEFT JOIN aprobacion_ausentismo apa
      ON   au.id_aprobacion_ausentismo =  apa.id_aprobacion_ausentismo
      WHERE au.id_ausentismo = ".$id_ausentismo." AND estado_ausentismo = 1 limit 1"); 
   $select4 = mysql_query($query4, $conexion) or die(mysql_error());
   $row4 = mysql_fetch_assoc($select4);
   $totalRows4 = mysql_num_rows($select4);
	
if (0<$totalRows4) { 
	$id_tipo_ausentismo = $row4['id_tipo_ausentismo'];
    $fecha_inicio = $row4['fecha_inicio'];
	$hora_inicio = $row4['hora_inicio'];
	$hora_final = $row4['hora_final'];
	$fecha_final = $row4['fecha_final'];
	$id_funcionario_jefe = $row4['id_funcionario_jefe'];
	$id_funcionario_reempla = $row4['id_funcionario_reempla'];
	$motivo_ausentismo = $row4['motivo_ausentismo'];
	$funcionario_soli = $row4['funcionario_soli'];
	$nombre_tipo_ausentismo = $row4['nombre_tipo_ausentismo'];
	$funcionario_jefe = $row4['funcionario_jefe'];
	$funcionario_reem = $row4['funcionario_reem'];
	$id_aprobacion_ausentismo = $row4['id_aprobacion_ausentismo'];
	$nombre_aprobacion_ausentismo = $row4['nombre_aprobacion_ausentismo'];

	$nom_tipoau      =  $row4['nombre_tipo_ausentismo'];
    $codifi = mb_detect_encoding($nom_tipoau, "UTF-8, ISO-8859-1");
    $nombre_tipo_ausentismo = iconv($codifi, 'UTF-8', $nom_tipoau);
	
	$nom_funcio  =  $row4['funcionario_soli'];
    $codifi = mb_detect_encoding($nom_funcio, "UTF-8, ISO-8859-1");
    $funcionario_soli = iconv($codifi, 'UTF-8', $nom_funcio);

	$nom_jefe  =  $row4['funcionario_jefe'];
    $codifi = mb_detect_encoding($nom_jefe, "UTF-8, ISO-8859-1");
    $funcionario_jefe = iconv($codifi, 'UTF-8', $nom_jefe);
	
	$nom_reem  =  $row4['funcionario_reem'];
    $codifi = mb_detect_encoding($nom_reem, "UTF-8, ISO-8859-1");
    $funcionario_reem = iconv($codifi, 'UTF-8', $nom_reem);

    $id_cargo8 = $row4['id_cargo'];
	$id_tipo_oficina8 = $row4['id_tipo_oficina'];
	$id_grupo_area8 = $row4['id_grupo_area'];
	$id_oficina_registro8 = $row4['id_oficina_registro'];
	
 }
}
mysql_free_result($select4);

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
		</div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			    <li><a href="ausentismo_eva_dt&<?php echo $nodo_dev; ?>.jsp"><p style="font-size: 18px"><b>AUSENTISMO</b></p></a></li>
            </ul>
        </div>
		 
      </div>
    </nav>
  </div>
</div>

<?php
// *******************************
// Consulta Ausentismo
// *******************************		
?>

<div class="row">
    <div class="col-md-12">
          <div class="box  box-info">
             <div class="box-header with-border">
			 <div class="row-md-6 text-left">
                 <h3 class="box-title"><b>CONSULTA AUSENTISMO</b></h3> &nbsp; &nbsp; 
             </div>
             <input type="hidden" class="form-control" name="tot_causantes" id="tot_causantes" readonly="readonly" value="">
		  <div class="row-md-6 text-right">
	</div>
	    <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-left"> 
                       <label  class="control-label">FUNCIONARIO:</label>   
                       <?php echo $funcionario_soli; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">FUNCIONARIO JEFE:</label>   
                       <?php echo $funcionario_jefe; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">FUNCIONARIO QUE LO REEMPLAZA:</label>   
                       <?php echo $funcionario_reem; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">TIPO DE AUSENTISMO:</label>   
                       <?php echo $nombre_tipo_ausentismo; ?>
                    </div>
                    <div class="form-group text-left"> 
                       <label  class="control-label">ESTADO AUSENTISMO:</label>   
                       <?php echo $nombre_aprobacion_ausentismo; ?>
                    </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA INICIO:</label>   
                        <?php echo $fecha_inicio; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">FECHA FINAL:</label>   
                        <?php echo $fecha_final; ?>
                  </div>
                 <?php if ($fecha_inicio == $fecha_final) { ?>

                  <div class="form-group text-left"> 
                        <label  class="control-label">HORA INICIO:</label>   
                        <?php echo $hora_inicio; ?>
                  </div>
                  <div class="form-group text-left"> 
                        <label  class="control-label">HORA FINAL:</label>   
                        <?php echo $hora_final; ?>
                  </div>
                 <?php } ?>
                  <div class="form-group text-left"> 
                       <label  class="control-label">MOTIVO DEL AUSENTISMO:</label>   
                       <textarea type="text"  rows="4" cols="20" class="form-control" id="motivo_ausentismo"  name="motivo_ausentismo"  readonly="readonly" ><?php echo $motivo_ausentismo; ?></textarea> 
                  </div>
				</div>  
             </div>
        </div>
  </div>
  </div>
   </div> 
 </div>
 		<div class="row">
			<div class="col-md-6">
			   <div class="box box-primary">
                  <div class="box-header with-border">
                       <h4><b>Documentos del Ausentismo</b></h4>
                       <div class="box-body">
                         <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                             <tr>
                                <th>ID</th>
                                <th>Archivo</th>
								<th>Descripción</th>
                                <th>Fecha Registro</th>
                                <th>Accion</th>
                             </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT id_docto_ausentismo, 
			    nombre_docto_ausentismo, descrip_docto_ausentismo,
			    fecha_registro
	            FROM docto_ausentismo
                WHERE id_ausentismo = '$id_ausentismo'  
				AND estado_docto_ausentismo = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	  
            ?>
          <tr>
             <td><?php echo $row62['id_docto_ausentismo'];?></td>
             <td><?php echo $row62['nombre_docto_ausentismo'];?></td>
			 <td><?php echo $row62['descrip_docto_ausentismo'];?></td>
             <td><?php echo $row62['fecha_registro'];?></td>

		     <?php if('' != $row62['nombre_docto_ausentismo']){ ?> 
		     <td> 
			    <a href="filesnr/ausentismosnr/<?php echo $row62['nombre_docto_ausentismo']; ?>" target = '_blank' >
		       <img src="images/pdf.png"></a>
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
// *************************************
// Consulta detalle de ausentismo
// *************************************
?>		
	<div class="col-md-6">
		<div class="box box-primary">
           <div class="box-header with-border">
            <h4><b>DETALLE AUSENTISMO</b></h4>
           <div class="box-body">
               <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Fecha</th>
                  <th>Hora Inicio</th>
                  <th>Hora Final</th>
                  <th>Total Horas</th>
               </tr>
                </thead>
            <tbody>
            <?php
               $query62 = sprintf("SELECT id_detalle_ausentismo, 
			    fecha_secuencia, hora_inicio, hora_final,
			    num_dias, num_horas
	            FROM detalle_ausentismo
                WHERE id_ausentismo = '$id_ausentismo'  
				AND estado_detalle_ausentismo = 1 "); 
                $select62 = mysql_query($query62, $conexion) or die(mysql_error());
			  while ($row62 = mysql_fetch_assoc($select62)) {	
            ?>
          <tr>
      
             <td><?php echo $row62['id_detalle_ausentismo'];?></td>
             <td><?php echo $row62['fecha_secuencia'];?></td>
             <td><?php echo $row62['hora_inicio'];?></td>
             <td><?php echo $row62['hora_final'];?></td>
             <td><?php echo $row62['num_horas'];?></td>
          </tr>
          <?php } ?> 
          </tbody>
        </table>
      </div> <!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->

</div>
</div>

<?php
 
} 
 
?>

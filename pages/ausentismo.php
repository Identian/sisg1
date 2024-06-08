<!DOCTYPE html>
<html lang="es">
<head>
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<?php

$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;


if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {

   if (isset($_GET['i'])) { 
	
	  $id_funcionario=intval($_GET['i']); 
	//  echo "id: ".$id_funcionario;
	  
    } else {
	  $id_funcionario = $_SESSION['snr'];
	}  
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

       $id_tipo_oficina9 = $row5['id_tipo_oficina'];
	   $id_grupo_area9 = $row5['id_grupo_area'];
	   $id_oficina_registro9 = $row5['id_oficina_registro'];
	   
   }
	  
} else { 
   //  echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 

$sw5 = 0;
//  Jefes inmediato de Area 
  if (($id_grupo_area < 26 or ($id_grupo_area > 30 and $id_grupo_area !=  47)) and $id_cargo <= 2 and $id_funcionario > 0){ // Jefes inmediato de Area 
    $privi = " AND a.id_aprobacion_ausentismo IN(0,1,2) AND b.id_grupo_area = '$id_grupo_area'  ";
	$sw5 = 10;
	} else {
    $id= 0;
}

  if ($id_grupo_area ==  47 && $id_cargo <= 2){ // Jefe Direcc Tec Registro 
    $privi = " AND a.id_aprobacion_ausentismo IN (1,3,4) AND b.id_tipo_oficina = 2 ";
	$sw5 = 10;
	} else {
    $id= 0;
}


  if ($id_grupo_area ==  47 && $id_cargo == 4 && $id_funcionario == 1028){ // Direcc Tec Registro - Juan Carlos Diaz
    $privi = " AND a.id_aprobacion_ausentismo IN(3,5,6) AND a.id_tipo_ausentismo not in(4,6,7,15,17,19,23,24) AND b.id_tipo_oficina = 2 ";
	$sw5 = 10;
	} else {
    $id= 0;
}


  if ($id_grupo_area ==  47 && $id_cargo == 4 && $id_funcionario == 1962){ // Direcc Tec Registro - Victor Pinto
    $privi = " AND a.id_aprobacion_ausentismo in(3,5,6) AND a.id_tipo_ausentismo in(6,7) AND b.id_tipo_oficina = 2 ";
	$sw5 = 10;
	} else {
    $id= 0;
}

// para las otras Areas:  AND (a.id_aprobacion_ausentismo IN (1,7,8,9)  AND a.id_tipo_oficina = 1)

  if ($id_grupo_area == 27 && $id_funcionario == 2041){ // RRHH Yenny Ibañez 17 = Quinquenios
    $privi = " AND a.id_aprobacion_ausentismo IN(3,7,8,9) AND a.id_tipo_ausentismo in(4,15,17,19) AND b.id_tipo_oficina = 2 ";
	$sw5 = 10;
	} else {
    $id= 0;
}

  if ($id_grupo_area == 30 && $id_funcionario == 573){ // RRHH Marcela Muñoz 23 = Vacaciones
    $privi = "  AND a.id_aprobacion_ausentismo IN(3,7,8,9) AND a.id_tipo_ausentismo in(23) AND b.id_tipo_oficina = 2 ";
	$sw5 = 10;
	} else {
    $id= 0;
}

  if ($id_grupo_area == 29 && $id_funcionario == 1871){ // RRHH Sandra Camargo 24 = Permisos Sindicales
    $privi = "  AND a.id_aprobacion_ausentismo IN(3,7,8,9) AND a.id_tipo_ausentismo in(24) AND b.id_tipo_oficina = 2 ";
	$sw5 = 10;
	} else {
    $id= 0;
}

  if ($sw5 != 10){ // solo el funcionario o el superAdmon 
   $privi = " AND a.id_funcionario = '$id_funcionario' ";
	} else {
	 if ($_SESSION['rol'] == 1) {
	    $privi = " ";
        $id= 0;
    }
}

if (isset($_GET["e"]) && ""!=$_GET["e"]) {
    $id_ausentismo=intval($_GET["e"]);

   $query84 = "UPDATE ausentismo SET estado_ausentismo=0  WHERE id_ausentismo = ".$id_ausentismo." limit 1";  
   $query86 = "UPDATE detalle_ausentismo SET estado_detalle_ausentismo =0  WHEREid_ausentismo = ".$id_ausentismo." limit 50";  
   $query88 = "UPDATE docto_ausentismo SET estado_docto_ausentismo =0  WHEREid_ausentismo = ".$id_ausentismo." limit 50";  
 
   $Result1 = mysql_query($query84, $conexion);
   $Result12 = mysql_query($query86, $conexion);
   $Result14 = mysql_query($query88, $conexion);  

   echo $actualizado;

 } else {
  
 }

 include('tablero_ausentismo.php');
/*
    // Para prueba de consulta ausentismos - Rafael Medina 
      $id_funcionario='4199';
      $fecha_inicio='2020-03-01';
      $fecha_final='2020-11-30';
	  $nodo_dev = $id_funcionario.'x'.$fecha_inicio.'x'.$fecha_final;
*/
 
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
		  <p style="font-size: 20px"><b>MÓDULO DE AUSENTISMOS</b></p>
        </div>
      </div>
    </nav>
  </div>
</div>

	  
	  
	  
<div class="row">
<div class="col-md-12">

 <div class="box box-info">
  <div class="box-header with-border">
  
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Solicitud</button>&nbsp;
	 
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
  </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  <th>Id Au</th>
                  <th>Id Jefe</th>
				  <th>Funcionario</th>
                  <th>Tipo Ausentismo</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                  <th>Id Reem</th>
                  <th>Id Estado</th>
                  <th>Estado Ausentismo</th>
				  <th>Motivo</th>
                 <th colspan="4">Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php

              $query875 = sprintf("SELECT a.id_ausentismo, a.id_funcionario,
			                                b.nombre_funcionario, c.nombre_tipo_ausentismo,
                                            a.id_funcionario_reempla, 
											e.nombre_funcionario AS nombre_funcionario_reem,
											a.id_aprobacion_ausentismo, 
											a.id_funcionario_jefe, a.fecha_inicio, a.fecha_final,
                                            a.hora_inicio, a.hora_final,											
											a.id_tipo_ausentismo,
											d.nombre_aprobacion_ausentismo, a.motivo_ausentismo,
											b.id_tipo_oficina, b.id_grupo_area, b.id_oficina_registro
                             			    FROM ausentismo a
			                                LEFT JOIN funcionario b
											ON a.id_funcionario = b.id_funcionario
											LEFT JOIN tipo_ausentismo c
											ON a.id_tipo_ausentismo = c.id_tipo_ausentismo
											LEFT JOIN aprobacion_ausentismo d
											ON a.id_aprobacion_ausentismo = d.id_aprobacion_ausentismo
			                                LEFT JOIN funcionario e
											ON a.id_funcionario_reempla = e.id_funcionario
                          WHERE a.estado_ausentismo = 1 ".$privi." order by a.fecha_inicio desc, a.id_aprobacion_ausentismo ");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
//			  echo "area: ".$id_grupo_area;
//			  echo " cargo: ".$id_cargo;
//			  echo " select: ".$query875;
              while($row_dian = mysql_fetch_array($select875)) {
				  
            ?>
          <tr>
		     <?php 
			 $id_ausentismo = $row_dian['id_ausentismo'];
		     $id_funcionario9 = $row_dian['id_funcionario'];
             $id_funcionario_reempla = $row_dian['id_funcionario_reempla'];
			 $id_tipo_ausentismo  =  $row_dian['id_tipo_ausentismo'];
			 $nom_tipoau   =  $row_dian['nombre_tipo_ausentismo'];
			 $id_aprobacion_ausentismo = $row_dian['id_aprobacion_ausentismo'];
		    
            $codifi = mb_detect_encoding($nom_tipoau, "UTF-8, ISO-8859-1");
            $nombre_tipo_ausentismo = iconv($codifi, 'UTF-8', $nom_tipoau);
			
		    $nom_funcio  =  $row_dian['nombre_funcionario'];
            $codifi = mb_detect_encoding($nom_funcio, "UTF-8, ISO-8859-1");
            $funcionario = iconv($codifi, 'UTF-8', $nom_funcio);
					
		    $id_tipo_oficina8 = $row_dian['id_tipo_oficina'];
	        $id_grupo_area8 = $row_dian['id_grupo_area'];
	        $id_oficina_registro8 = $row_dian['id_oficina_registro'];
			$sw5 = 0;
			
	         ?>
             <td><?php echo $id_ausentismo; ?></td>
			 <td><?php echo $row_dian['id_funcionario_jefe']; ?></td>
			 <td  style = "display: none"><?php echo $id_funcionario9; ?></td>
             <td width = "130px"><?php echo $funcionario; ?></td>
			 <td  style = "display: none"><?php echo $id_tipo_ausentismo; ?></td>
             <td><?php echo $nombre_tipo_ausentismo; ?></td>
             <td width = "90px"><?php echo $row_dian['fecha_inicio']; ?></td>
             <td width = "90px"><?php echo $row_dian['fecha_final']; ?></td>
			 <td><?php echo $row_dian['id_funcionario_reempla']; ?></td>
			 <td style = "display: none"><?php echo $row_dian['id_tipo_ausentismo']; ?></td>
			 <td><?php echo $row_dian['id_aprobacion_ausentismo']; ?></td>
             <td><?php echo $row_dian['nombre_aprobacion_ausentismo']; ?></td>
			 <td><?php echo $row_dian['motivo_ausentismo']; ?></td>
			 <td  style = "display: none"><?php echo $row_dian['hora_inicio']; ?></td>
			 <td  style = "display: none"><?php echo $row_dian['hora_final']; ?></td>
			 <td  style = "display: none"><?php echo $row_dian['id_tipo_oficina']; ?></td>
             <td  style = "display: none"><?php echo $row_dian['id_grupo_area']; ?></td>
			 <td  style = "display: none"><?php echo $row_dian['id_oficina_registro']; ?></td>
			 <td  style = "display: none"><?php echo $row_dian['nombre_funcionario_reem']; ?></td>
			 
        	 <td>
<!--  			    <a href="ausentismo_eva_dt&<?php echo $nodo_dev; ?>.jsp"><span class="btn btn-info btn-xs" title="Consultar"><span  class="glyphicon glyphicon-hand-up"></span></a> &nbsp; -->
                <a href="consulta_ausentismo&<?php echo $id_ausentismo; ?>.jsp"><span class="btn btn-info btn-xs" title="Consultar"><span  class="glyphicon glyphicon-hand-up"></span></a> &nbsp;
             </td> 
             <?php if ((($id_grupo_area < 26 or ($id_grupo_area > 30 and $id_grupo_area !=  47)) and $id_cargo <= 2) or (1==$_SESSION['rol'])) {  // JEFE INMEDIATO $id_cargo <= 2 id_grupo_area != 47 (DTR)  != 26 RRHH ?>			 
			 <td>
				<button type="button" class="btn btn-primary btn-xs editbtn" title="Aprobación Jefe inmediato"><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
             </td>
			 <?php } ?>

             <?php if (($id_grupo_area ==  47 and $id_cargo <= 2) or (1==$_SESSION['rol'])) {  // JEFE DTR $id_cargo <= 2 id_grupo_area = 47 (DTR) ?>			 
			 <td>
				<button type="button" class="btn btn-danger btn-xs aprobjdtr" title="Aprobación Jefe DTR "><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
             </td>
			 <?php } ?>

			 <?php if (($id_grupo_area == 47 and $id_cargo == 4) or (1==$_SESSION['rol'])) { // Aprobacion Area DTR ?>
				<td>
				<button type="button" class="btn btn-success btn-xs aprobtn" title="Area DTR"><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
             </td> 
			 <?php } ?>
			 <?php if (($id_grupo_area >= 26 and $id_grupo_area <=  30)  or (1==$_SESSION['rol'])) { // Aprobación RRHH ?>
				<td>
				<button type="button" class="btn btn-warning btn-xs rhaprobtn" title="Aprobación RRHH"><span  class="glyphicon glyphicon-ok"></span></button>&nbsp;
             </td> 
			 <?php } ?>
             <?php if($id_aprobacion_ausentismo  < 1) { ?>
             <td>
                <a href="ausentismo&<?php echo $id_funcionario; ?>&<?php echo $id_ausentismo; ?>.jsp" class="confirmationdel" style="color:#ff0000;cursor: pointer" title="Borrar"  ><span class="glyphicon glyphicon-trash"></span></a>
             </td>
			<?php } ?>
          </tr>
         
         


      <?php } ?> <!-- CIERRE PRIMER WHILE -->

          <script>

              $(document).ready(function() {
            $('#tab_sucesiones').DataTable({
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
    </div><!-- /.box-body -->
  </div><!-- box box-info -->
</div><!-- row -->
</div><!-- col-md-12 -->



<?php
// Aprobacion del jefe inmediato
// *************************************
?>

<div class="modal fade"  id="modiausen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>APROBACIÓN AUSENTISMO JEFE</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4377224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_ausentismo" id="id_ausentismo" readonly="readonly" value="">
    <input type="hidden" class="form-control" name="id_tipo_ausentismo2" id="id_tipo_ausentismo2" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_tipo_oficina2" id="id_tipo_oficina2" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_grupo_area2" id="id_grupo_area2" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_oficina_registro2" id="id_oficina_registro2" readonly="readonly" value=""> 

	
    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO:</label>   
      <input type="text" class="form-control" name="nombre_funcionario2" id="nombre_funcionario2" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">TIPO DE AUSENTISMO:</label>   
      <input type="text" class="form-control" name="nombre_tipo_ausentismo2" id="nombre_tipo_ausentismo2" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA INICIO:</label>   
      <input type="text" class="form-control datepickersinfinsemana" name="mfecha_inicio2" id="mfecha_inicio2" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA FINAL:</label>   
      <input type="text" class="form-control datepickersinfinsemana" name="mfecha_final2" id="mfecha_final2" onChange = "diaigual();" value="">
    </div>

    <div id="hdesde2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Hora Desde (lista de valores):</label>  
        <input type="time" class="form-control" id="hora_inicio2" name="hora_inicio2" list="listahoras3" value="" required >
        <datalist id="listahoras3">
            <option value="08:00:00">
            <option value="09:00:00">
            <option value="10:00:00">
            <option value="11:00:00">
            <option value="12:00:00">
            <option value="13:00:00">
            <option value="14:00:00">
            <option value="15:00:00">
            <option value="16:00:00">
            <option value="17:00:00">
            <option value="18:00:00">
        </datalist>
    </div>
						 
    <div id="hhasta2" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Hora Hasta (lista de valores):</label>   
        <input type="time" class="form-control" id="hora_final2" name="hora_final2" list="listahoras3" value="" required >
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO JEFE:</label>   
<!--      <input type="text" class="form-control" name="funcionario_jefe" id="funcionario_jefe" readonly="readonly" value=""> -->
      <select class="form-control" name="id_funcionario_jefe2" id="id_funcionario_jefe2"   disabled="true">
            <option value="" selected></option>
            <?php echo lista('funcionario'); ?>
      </select>
    </div>

    <div class="form-group text-left" id="funanji"> 
      <label  class="control-label">FUNCIONARIO QUE LO REEMPLAZA: </label> 
      <input type="text" class="form-control" name="nombre_funcionario_reem2" id="nombre_funcionario_reem2" value="" readonly="readonly">	
    </div>	

    <div class="form-group text-left"> 
      <label  class="control-label  text-danger"><span style="color:#ff0000;">*</span><b>APROBACIÓN JEFE:</b>&nbsp;&nbsp;&nbsp;</label> 
      <select class="form-control" name="id_aprobacion_ausentismo2" id="id_aprobacion_ausentismo2" required>
            <option value="" selected></option>
            <?php  echo lista2('aprobacion_ausentismo', '0,1,2'); ?>
      </select>
    </div>	

    <div class="form-group text-left"> 
        <label  class="control-label">MOTIVO DEL AUSENTISMO:</label>   
        <textarea rows="5" cols="20" class="form-control" id="motivo_ausentismo2"  name="motivo_ausentismo2" value="" readonly="readonly"  ></textarea>
	</div>

    <div class="form-group text-left"> 
        <label  class="control-label"> ADJUNTAR DOCUMENTO:</label> 
        <input type="file" value=""  id="file" name="file">
        <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
    </div>
    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actajefeusen" id="actajefeusen" value="actajefeusen">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>

<?php
// Aprobacion del jefe DTR
// *************************************
?>

<div class="modal fade"  id="aprojedtr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<!-- <button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button> -->
<h4 class="modal-title" id="myModalLabel"><b>APROBACIÓN JEFE DTR</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form4377224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_ausentismo3" id="id_ausentismo3" readonly="readonly" value="">
    <input type="hidden" class="form-control" name="id_tipo_ausentismo3" id="id_tipo_ausentismo3" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_tipo_oficina3" id="id_tipo_oficina3" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_grupo_area3" id="id_grupo_area3" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_oficina_registro3" id="id_oficina_registro3" readonly="readonly" value=""> 

	
    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO:</label>   
      <input type="text" class="form-control" name="nombre_funcionario3" id="nombre_funcionario3" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">TIPO DE AUSENTISMO:</label>   
      <input type="text" class="form-control" name="nombre_tipo_ausentismo3" id="nombre_tipo_ausentismo3" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA INICIO:</label>   
      <input type="text" class="form-control" name="mfecha_inicio3" id="mfecha_inicio3" value="" readonly="readonly">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA FINAL:</label>   
      <input type="text" class="form-control" name="mfecha_final3" id="mfecha_final3"value="" readonly="readonly">
    </div>

    <div id="hdesde3" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Hora Desde (lista de valores):</label>  
        <input type="time" class="form-control" id="hora_inicio3" name="hora_inicio3"value="" readonly="readonly">
    </div>
						 
    <div id="hhasta3" class="form-group text-left" style="display:none;"> 
        <label  class="control-label"><span style="color:#ff0000;">*</span> Hora Hasta (lista de valores):</label>   
        <input type="time" class="form-control" id="hora_final3" name="hora_final3" value=""  readonly="readonly">
    </div>
	
    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO JEFE:</label>   
      <select class="form-control" name="id_funcionario_jefe3" id="id_funcionario_jefe3"  disabled="true">
            <option value="" selected></option>
            <?php echo lista('funcionario'); ?>
      </select>
    </div>

    <div class="form-group text-left" id="funanre"> 
      <label  class="control-label">FUNCIONARIO QUE LO REEMPLAZA: </label> 
      <input type="text" class="form-control" name="nombre_funcionario_reem3" id="nombre_funcionario_reem3" value="" readonly="readonly">	
    </div>	

    <div class="form-group text-left"> 
      <label  class="control-label  text-danger"><span style="color:#ff0000;">*</span><b>APROBACIÓN JEFE DTR:</b>&nbsp;&nbsp;&nbsp;</label> 
      <select class="form-control" name="id_aprobacion_ausentismo3" id="id_aprobacion_ausentismo3" required>
            <option value="" selected></option>
            <?php  echo lista2('aprobacion_ausentismo', '1,3,4'); ?>
      </select>
    </div>	

    <div class="form-group text-left"> 
        <label  class="control-label">MOTIVO DEL AUSENTISMO:</label>   
        <textarea rows="5" cols="20" class="form-control" id="motivo_ausentismo3"  name="motivo_ausentismo3" value="" readonly="readonly"  ></textarea>
	</div>

    <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actjefedtr" id="actjefedtr" value="actjefedtr">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>



<?php
// Aprobacion Area Direccion Tecnica
// *****************************************
?>

<div class="modal fade"  id="aprscrgral" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>APROBACIÓN AUSENTISMO AREA DIRECCIÓN TÉCNICA</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_ausentismo4" id="id_ausentismo4" readonly="readonly" value="">
    <input type="hidden" class="form-control" name="id_tipo_oficina4" id="id_tipo_oficina4" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_grupo_area4" id="id_grupo_area4" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_oficina_registro4" id="id_oficina_registro4" readonly="readonly" value=""> 

	
    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO:</label>   
      <input type="text" class="form-control" name="nombre_funcionario4" id="nombre_funcionario4" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">TIPO DE AUSENTISMO:</label>   
      <input type="text" class="form-control" name="nombre_tipo_ausentismo4" id="nombre_tipo_ausentismo4" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA INICIO:</label>   
      <input type="text" class="form-control" name="mfecha_inicio4" id="mfecha_inicio4" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA FINAL:</label>   
      <input type="text" class="form-control" name="mfecha_final4" id="mfecha_final4" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO JEFE:</label>   
<!--      <input type="text" class="form-control" name="funcionario_jefe" id="funcionario_jefe" readonly="readonly" value=""> -->
      <select class="form-control" name="id_funcionario_jefe4" id="id_funcionario_jefe4"  disabled="true">
            <option value="" selected></option>
            <?php echo lista('funcionario'); ?>
      </select>
    </div>
	
    <div class="form-group text-left" id="funanfa"> 
      <label  class="control-label">FUNCIONARIO QUE LO REEMPLAZA: </label> 
      <input type="text" class="form-control" name="nombre_funcionario_reem4" id="nombre_funcionario_reem4" value="" readonly="readonly">	
    </div>	

    <div class="form-group text-left"> 
      <label  class="control-label  text-danger"><span style="color:#ff0000;">*</span><b>APROBACIÓN ÁREA DTR:</b>&nbsp;&nbsp;&nbsp;</label> 
      <select class="form-control" name="id_aprobacion_ausentismo4" id="id_aprobacion_ausentismo4" required>
            <option value="" selected></option>
            <?php  echo lista2('aprobacion_ausentismo', '3,5,6'); ?>
      </select>
    </div>	

    <div class="form-group text-left"> 
        <label  class="control-label">MOTIVO DEL AUSENTISMO:</label>   
        <textarea rows="5" cols="20" class="form-control" id="motivo_ausentismo4"  name="motivo_ausentismo4" value="" readonly="readonly"  ></textarea>
	</div>

    <div class="form-group text-left"> 
        <label  class="control-label"> ADJUNTAR DOCUMENTO:</label> 
        <input type="file" value=""  id="file" name="file">
        <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
    </div>
    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actscrgral" value="actscrgral">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>

<?php
// Aprobacion Recursos Humanos (17 = quinquenio)
// ***********************************************************
?>

<div class="modal fade"  id="aprrecurh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal" onClick="volver();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>APROBACIÓN AUSENTISMO RECURSOS HUMANOS</b><span class="licenciac" style="font-weight: bold;"></span></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="form43224"  enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id_ausentismo5" id="id_ausentismo5" readonly="readonly" value="">
    <input type="hidden" class="form-control" name="id_tipo_oficina5" id="id_tipo_oficina5" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_grupo_area5" id="id_grupo_area5" readonly="readonly" value=""> 
    <input type="hidden" class="form-control" name="id_oficina_registro5" id="id_oficina_registro5" readonly="readonly" value=""> 

	
    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO:</label>   
      <input type="text" class="form-control" name="nombre_funcionario5" id="nombre_funcionario5" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">TIPO DE AUSENTISMO:</label>   
      <input type="text" class="form-control" name="nombre_tipo_ausentismo5" id="nombre_tipo_ausentismo5" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA INICIO:</label>   
      <input type="text" class="form-control" name="mfecha_inicio5" id="mfecha_inicio5" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FECHA FINAL:</label>   
      <input type="text" class="form-control" name="mfecha_final5" id="mfecha_final5" readonly="readonly" value="">
    </div>

    <div class="form-group text-left"> 
      <label  class="control-label">FUNCIONARIO JEFE:</label>   
      <select class="form-control" name="id_funcionario_jefe5" id="id_funcionario_jefe5"  disabled="true">
            <option value="" selected></option>
            <?php echo lista('funcionario'); ?>
      </select>
    </div>

    <div class="form-group text-left" id="funanfa"> 
      <label  class="control-label">FUNCIONARIO QUE LO REEMPLAZA: </label> 
      <input type="text" class="form-control" name="nombre_funcionario_reem5" id="nombre_funcionario_reem5" value="" readonly="readonly">	
    </div>	

    <div class="form-group text-left"> 
      <label  class="control-label  text-danger"><span style="color:#ff0000;">*</span><b>APROBACIÓN RECURSOS HUMANOS:</b>&nbsp;&nbsp;&nbsp;</label> 
      <select class="form-control" name="id_aprobacion_ausentismo5" id="id_aprobacion_ausentismo5" required>
            <option value="" selected></option>
            <?php  echo lista2('aprobacion_ausentismo', '3,7,8,9'); ?>
      </select>
    </div>	

    <div class="form-group text-left"> 
        <label  class="control-label">MOTIVO DEL AUSENTISMO:</label>   
        <textarea rows="5" cols="20" class="form-control" id="motivo_ausentismo5"  name="motivo_ausentismo5" value="" readonly="readonly"  ></textarea>
	</div>

    <div class="form-group text-left"> 
        <label  class="control-label"> ADJUNTAR DOCUMENTO:</label> 
        <input type="file" value=""  id="file5" name="file5">
        <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
    </div>
    	
    <div class="modal-footer">
<!--        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"> -->
        <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="volver();">
        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" class="btn btn-success"><input type="hidden" name="actrecurh" value="actrecurh">
        <span class="glyphicon glyphicon-ok"></span>Guardar</button>
	</div>
</form>
</div>
</div> 
</div> 
</div>





<!-- Modal myModal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>REGISTRO SOLICITUD DE AUSENTISMO</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

                   <form action="" method="POST" name="form1" enctype="multipart/form-data">
                <script>
                 var arraydays = <?PHP 
 
                 $query126 = "SELECT fecha_secuencia 
				 FROM ausentismo aus, detalle_ausentismo deaus
				 where deaus.num_horas = 0 
				 and aus.id_ausentismo = deaus.id_ausentismo 
				 and aus.id_funcionario=".$id_funcionario.
				 " and deaus.id_aprobacion_ausentismo = 1 
				 and estado_detalle_ausentismo = 1 
				 and estado_ausentismo = 1
				 union
				 select fecha_dianh
                 FROM dia_nohabil ";

                 $result126 = mysql_query($query126);
                 $totalresult126 = mysql_num_rows($result126);
                 if(0<$totalresult126){
                   while ($row126 = @mysql_fetch_assoc($result126)){
                    $arrayday[]='"'.$row126['fecha_secuencia'].'"';
                   }
                   $string=implode(",",$arrayday);
                   echo '['.$string.']';
                   mysql_free_result($result126);
                 } else { echo '["1940-01-01"]'; }
                ?>
                </script>

				   <input type="hidden" name="id_funcionario" id="id_funcionario"   value="<?php echo $id_funcionario; ?>" >
                   <input type="hidden" class="form-control" name="id_tipo_oficina" id="id_tipo_oficina" readonly="readonly" value="<?php echo $id_tipo_oficina; ?>"> 
                   <input type="hidden" class="form-control" name="id_grupo_area" id="id_grupo_area" readonly="readonly" value="<?php echo $id_grupo_area; ?>"> 
                   <input type="hidden" class="form-control" name="id_oficina_registro" id="id_oficina_registro" readonly="readonly" value="<?php echo $id_oficina_registro; ?>"> 

				         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Tipo de Ausentismo:</label> 
                              <select class="form-control" name="id_tipo_ausentismo" id="id_tipo_ausentismo" onChange = "totalaus();">
                              <option value="" selected></option>
                              <?php echo lista('tipo_ausentismo'); ?>
                              </select>
                         </div>

                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Total Ausentismo:</label> 
                              <input type="text" class="form-control red-text" id="total_ausentismo"  name="total_ausentismo" readonly="readonly" value="">
                         </div>
                         <?php $id_funcionario_reempla = 0;  $funcionario_reem = "SIN REEMPLAZO "; ?>
						 
                         <div class="form-group text-left"> 
                              <label  class="control-label"> Funcionario que lo Reemplaza:</label> 
                              <select class="form-control" name="id_funcionario_reempla" id="id_funcionario_reempla">
                              <option value="<?php echo $id_funcionario_reempla; ?>" selected><?php echo $funcionario_reem; ?></option>
							  <?php if ($id_tipo_oficina == 1) {  echo nvonivelc($id_funcionario, $id_grupo_area);  } ?>
                              <?php if ($id_tipo_oficina == 2) {  echo nvofireg($id_funcionario, $id_oficina_registro);  } ?>
                              </select>
                         </div>

						 
                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"><span style="color:#ff0000;">*</span></i> Fecha Inicio:</label>   
                              <input type="text" class="form-control datepickersinfinsemana" id="fecha_inicio"name="fecha_inicio" readonly="readonly" value="" required >
                         </div>
                         <div class="form-group text-left"> 
                              <label><i class="fa fa-calendar"><span style="color:#ff0000;">*</span></i>Fecha Final:</label>   
                              <input type="text" class="form-control datepickersinfinsemana" id="fecha_final" name="fecha_final" readonly="readonly" value="" onChange = "mismodia();" required >
                         </div>
                         <div id="hdesde" class="form-group text-left" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Hora Desde (lista de valores):</label>  
                              <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" list="listahoras" value="" required >
                              <datalist id="listahoras">
                                <option value="08:00:00">
                                <option value="09:00:00">
                                <option value="10:00:00">
                                <option value="11:00:00">
                                <option value="12:00:00">
                                <option value="13:00:00">
                                <option value="14:00:00">
                                <option value="15:00:00">
                                <option value="16:00:00">
                                <option value="17:00:00">
                                <option value="18:00:00">
                              </datalist>
                         </div>
						 
                         <div id="hhasta" class="form-group text-left" style="display:none;"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Hora Hasta (lista de valores):</label>   
                              <input type="time" class="form-control" id="hora_final" name="hora_final" list="listahoras" value="" required >
                         </div>
                         <div class="form-group text-left"> 
                              <label  class="control-label"><span style="color:#ff0000;">*</span> Motivo del Ausentismo:</label>   
                              <textarea rows="5" cols="40" class="form-control" id="motivo_ausentismo"  name="motivo_ausentismo" value="" required ></textarea>
                         </div>
    
                         <div class="form-group text-left"> 
                              <label  class="control-label"> ADJUNTAR DOCUMENTO:</label> 
                              <input type="file" value=""  id="file" name="file">
                              <span class="mensajeaclaracion">(Solo admite el formato PDF inferior a 5 Megas.)</span>
                         </div>
    
                		 <div class="modal-footer">
						      <span style="color:#ff0000;">(*) Campos obligatorios</span>
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="archausentismo" value="notaria">
                              <span class="glyphicon glyphicon-ok"></span>Guardar</button></br>
<!-- 							  </br><p class="text-primary">NOTA: Puede adicionar documentos PDF por la opción de Consulta</p> -->
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div> 

<?php

function nvonivelc($id_funcionario, $id_grupo_area) {
		
global $mysqli;
 
    $query17 = "SELECT id_funcionario, nombre_funcionario
			  FROM funcionario 
			  WHERE id_funcionario != '$id_funcionario'
			   AND id_grupo_area = '$id_grupo_area'
			   AND id_cargo in(1,2,4)  
			   AND estado_funcionario =1 
			   UNION
			   SELECT 0, 'SIN REEMPLAZO' ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj17['id_funcionario'], $obj17['nombre_funcionario']);
    }
$result17->free();	
 }
 
 function nivelc($id_funcionario8, $id_grupo_area8) {
		
global $mysqli;
 
    $query17 = "SELECT id_funcionario, nombre_funcionario
			  FROM funcionario 
			  WHERE id_funcionario != '$id_funcionario8'
			   AND id_grupo_area = '$id_grupo_area8'
			   AND id_cargo in(1,2,4)  
			   AND estado_funcionario =1 
			   UNION
			   SELECT 0, 'SIN REEMPLAZO' ";
    $result17 = $mysqli->query($query17);
    while ($obj17 = $result17->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj17['id_funcionario'], $obj17['nombre_funcionario']);
    }
$result17->free();	
 }

 function nvofireg($id_funcionario, $id_oficina_registro) {
    global $mysqli;		
    $query18 = "SELECT id_funcionario, nombre_funcionario
			  FROM funcionario 
			  WHERE id_funcionario != '$id_funcionario' 
			   AND id_oficina_registro = '$id_oficina_registro' 
			   AND id_cargo in(1,2,4)  
			   AND estado_funcionario =1 
			   UNION
			   SELECT 0, 'SIN REEMPLAZO' ";
    $result18 = $mysqli->query($query18);
    while ($obj18 = $result18->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj18['id_funcionario'], $obj18['nombre_funcionario']);
    }
   $result18->free();	
 }

  function ofireg($id_funcionario8, $id_oficina_registro8) {
    global $mysqli;		
	$id_oficina_registro6 = var_dump($_POST['id_oficina_registro3']);
	echo "of reg: ".$id_oficina_registro6;
    $query18 = "SELECT id_funcionario, nombre_funcionario
			  FROM funcionario 
			  WHERE id_oficina_registro = '$id_oficina_registro6' 
			   AND id_cargo in(1,2,4)  
			   AND estado_funcionario =1 
			   UNION
			   SELECT 0, 'SIN REEMPLAZO' ";
    $result18 = $mysqli->query($query18);
    while ($obj18 = $result18->fetch_array()) {
        printf ("<option value='%s'>%s</option>\n", $obj18['id_funcionario'], $obj18['nombre_funcionario']);
    }
   $result18->free();	
 }

 function lista2($table, $id) {
		
global $mysqli;
$query5 = "SELECT id_".$table.", nombre_".$table."  FROM ".$table." where  id_".$table." in (".$id.") ";
$result5 = $mysqli->query($query5);
while ($obj = $result5->fetch_array()) {
	$infoid='id_'.$table;
	$infonombre ='nombre_'.$table;
	$nom = $obj[$infonombre];
	$codifi = mb_detect_encoding($nom, "UTF-8, ISO-8859-1");
	$infonombre = iconv($codifi, 'UTF-8', $nom);
	
    printf ("<option value='%s'>%s</option>\n", $obj[$infoid], $infonombre);
 }

$result5->free();

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
          $('#id_ausentismo').val(data[0]);
		  $('#id_funcionario_jefe2').val(data[1]);
          $('#id_funcionario2').val(data[2]);
		  $('#nombre_funcionario2').val(data[3]);
		  $('#id_tipo_ausentismo2').val(data[4]);
		  $('#nombre_tipo_ausentismo2').val(data[5]);
          $('#mfecha_inicio2').val(data[6]);
		  $('#mfecha_final2').val(data[7]);
		  $('#id_funcionario_reempla2').val(data[8]);
		  $('#id_tipo_ausentismo2').val(data[9]);
		  $('#id_aprobacion_ausentismo2').val(data[10]);
//		  $('#nombre_aprobacion_ausentismo').val(data[11]);
		  $('#motivo_ausentismo2').val(data[12]);
		  $('#hora_inicio2').val(data[13]);
		  $('#hora_final2').val(data[14]);
		  $('#id_tipo_oficina2').val(data[15]);
		  $('#id_grupo_area2').val(data[16]);
		  $('#id_oficina_registro2').val(data[17]);
          $('#nombre_funcionario_reem2').val(data[18]);
		  
		  //		alert("difer: " + diasdif);
        if(data[6] == data[7]) {
			hdesde2.style.display='block';
			hhasta2.style.display='block';
         } else {
			document.getElementById('hora_inicio2').value = '00:00:00';
			document.getElementById('hora_final2').value = '00:00:00';
		 }
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.aprobjdtr').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);

          $("#aprojedtr").modal("show");
          $('#id_ausentismo3').val(data[0]);
		  $('#id_funcionario_jefe3').val(data[1]);
          $('#id_funcionario3').val(data[2]);
		  $('#nombre_funcionario3').val(data[3]);
		  $('#id_tipo_ausentismo3').val(data[4]);
		  $('#nombre_tipo_ausentismo3').val(data[5]);
          $('#mfecha_inicio3').val(data[6]);
		  $('#mfecha_final3').val(data[7]);
		  $('#id_funcionario_reempla3').val(data[8]);
		  $('#id_tipo_ausentismo3').val(data[9]);
		  $('#id_aprobacion_ausentismo3').val(data[10]);
//		  $('#nombre_aprobacion_ausentismo3').val(data[11]);
		  $('#motivo_ausentismo3').val(data[12]);
		  $('#hora_inicio3').val(data[13]);
		  $('#hora_final3').val(data[14]);
		  $('#id_tipo_oficina3').val(data[15]);
		  $('#id_grupo_area3').val(data[16]);
		  $('#id_oficina_registro3').val(data[17]);
		  $('#nombre_funcionario_reem3').val(data[18]);
		  
        if(data[6] == data[7]) {
			hdesde3.style.display='block';
			hhasta3.style.display='block';
         } else {
			document.getElementById('hora_inicio3').value = '00:00:00';
			document.getElementById('hora_final3').value = '00:00:00';
		 }
		 

      jsofireg();
      });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.aprobtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#aprscrgral").modal("show");
          $('#id_ausentismo4').val(data[0]);
          $('#id_funcionario_jefe4').val(data[1]);
		  
          $('#nombre_funcionario4').val(data[3]);
          $('#nombre_tipo_ausentismo4').val(data[5]);
          $('#mfecha_inicio4').val(data[6]);
          $('#mfecha_final4').val(data[7]);
		  $('#id_funcionario_reempla4').val(data[8]);
		  $('#id_aprobacion_ausentismo4').val(data[10]);
		  $('#motivo_ausentismo4').val(data[12]);
		  $('#id_tipo_oficina4').val(data[15]);
		  $('#id_grupo_area4').val(data[16]);
		  $('#id_oficina_registro4').val(data[17]);
          $('#nombre_funcionario_reem4').val(data[18]); 
		  });  
    });

</script>

<script>
     $(document).ready(function() {
      $('.rhaprobtn').on('click', function() {          
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
             return $(this).text(); 
          }).get();
          console.log(data);
          $("#aprrecurh").modal("show");
          $('#id_ausentismo5').val(data[0]);
          $('#id_funcionario_jefe5').val(data[1]);
		  
          $('#nombre_funcionario5').val(data[3]);
          $('#nombre_tipo_ausentismo5').val(data[5]);
          $('#mfecha_inicio5').val(data[6]);
          $('#mfecha_final5').val(data[7]);
		  $('#id_funcionario_reempla5').val(data[8]);
		  $('#id_aprobacion_ausentismo5').val(data[10]);
		  $('#motivo_ausentismo5').val(data[12]);
		  $('#id_tipo_oficina5').val(data[15]);
		  $('#id_grupo_area5').val(data[16]);
		  $('#id_oficina_registro5').val(data[17]);
          $('#nombre_funcionario_reem5').val(data[18]);
      });  
    });

</script>


 <script>
function mfaltandatos(){
    alert('Faltan fechas por reportar....!!!');
//	   $("#myModal").modal("show");
	var x = document.getElementById('fecha_inicio').value;
	var y = document.getElementById('fecha_acta').value;
	var z = document.getElementById('fecha_reg_creacion').value;
	
    if(x.length < 2 or y.length < 2 or z.length < 2){
		alert('Faltan fechas por reportar....!!!');
		return false;
   }
 }
</script>   

<script>
    function totalaus() {
        var tipo_ausen = document.getElementById('id_tipo_ausentismo').value;
		var id_funcionario = document.getElementById('id_funcionario').value;
		var tipo_auyfun = tipo_ausen+'-'+id_funcionario;	 			
        jQuery.ajax({
        type: "POST",url: "pages/consol_ausenxf.php",
		data: "tipo_ausen="+tipo_auyfun,
		async: true,
         success: function(b) {
               document.getElementById('total_ausentismo').value = b;
         }
        });				
    }
</script>

<script>
    function funreempla() {
//        var tipo_oficina = <?php echo $_SESSION['snr_tipo_oficina']; ?>;
//        var grupo_area = <?php echo $_SESSION['snr_grupo_area']; ?>;
		var id_funcionario = document.getElementById('id_funcionario').value;
//		var tipo_auyfun = tipo_ausen+'-'+id_funcionario;	 			
        jQuery.ajax({
        type: "POST",url: "pages/lista_reemplazo.php",
		data: "id_funcionario="+id_funcionario,
		async: true,
         success: function(b) {
               document.getElementById('id_funcionario_reempla').value = b;
         }
        });				
    }
</script>

<script>
    function mismodia() {
//		hdesde.style.display='block';
        var fecha_inicio = document.getElementById('fecha_inicio').value;
		var fecha_final = document.getElementById('fecha_final').value;
//		alert("fecha inicio: " + fecha_inicio);
		var aFecha1 = fecha_inicio.split('-');
        var aFecha2 = fecha_final.split('-');
        var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
        var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
        var diasdif = Number(fFecha2 - fFecha1);
//		alert("difer: " + diasdif);
        if(diasdif <= 0) {
			hdesde.style.display='block';
			hhasta.style.display='block';
		} else {
			hdesde.style.display='none';
			hhasta.style.display='none';
			document.getElementById('hora_inicio').value = '00:00:00';
			document.getElementById('hora_final').value = '00:00:00';
        }
			
    }
</script>

<script>
    function diaigual() {
//		hdesde.style.display='block';
        var fecha_inicio2 = document.getElementById('mfecha_inicio2').value;
		var fecha_final2 = document.getElementById('mfecha_final2').value;
//		alert("fecha inicio: " + fecha_inicio2);
//        alert("fecha final: " + fecha_final2);
		var aFecha1 = fecha_inicio2.split('-');
        var aFecha2 = fecha_final2.split('-');
        var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
        var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
        var diasdif = Number(fFecha2 - fFecha1);
//		alert("difer: " + diasdif);
        if(diasdif <= 0) {
			hdesde2.style.display='block';
			hhasta2.style.display='block';
		} else {
			hdesde2.style.display='none';
			hhasta2.style.display='none';
			document.getElementById('hora_inicio2').value = '00:00:00';
			document.getElementById('hora_final2').value = '00:00:00';
        }
			
    }
</script>
  
<?php  
function validafecha($tmp_fi) {

	   global $mysqli;
	   $sx = 100;
	   $query49 = "SELECT (ELT(WEEKDAY('$tmp_fi') + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS dia_semana "; 
       $result49 = $mysqli->query($query49);
       while ($obj49 = $result49->fetch_array()) {
			$dia_semana = $obj49['dia_semana'];
        }
       $result49->free();	
	
    if ($dia_semana == 'Sabado' or $dia_semana == 'Domingo') {
	   $sx = 99;
	}
	$igual = 0;
	global $mysqli;
	$query75 = "SELECT count(*) AS igual
	FROM dia_nohabil 
	WHERE fecha_dianh = '$tmp_fi' "; 
    $result75 = $mysqli->query($query75);
    while ($obj75 = $result75->fetch_array()) {
        $igual = $obj75['igual'];
    }
    $result75->free();	
    if ($igual > 0) {
	    $sx = 99;
    }
return $sx;
	
}

// Para crear nuevo Ausentismo
// ***********************************

if (isset($_POST['archausentismo'])) {

	$num_dias = 0;
	$num_horas = 0;
	$motivo_rechazo = ' ';
	$id_funcionario = $_POST['id_funcionario'];
    $id_tipo_ausentismo = $_POST['id_tipo_ausentismo'];
	$id_grupo_area = $_POST['id_grupo_area'];
	$id_oficina_registro = $_POST['id_oficina_registro'];
	$id_tipo_oficina = $_POST['id_tipo_oficina'];
	$id_funcionario_jefe = 0;
	if (isset($_POST['id_funcionario_reempla'])) {
	   $id_funcionario_reempla = $_POST['id_funcionario_reempla'];
	 } else {
        $id_funcionario_reempla = 0;
    }	 
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_final = $_POST['fecha_final'];
	if($fecha_inicio == $fecha_final) {
	   $num_dias = 0;
	   $hora_inicio = $_POST['hora_inicio'];
	   $hora_final = $_POST['hora_final'];
	   $array=explode(":", $hora_inicio);
	   $h_desde = $array[0];
	   $array2=explode(":", $hora_final);
	   $h_hasta = $array2[0];
       $num_horas = intval($h_hasta) - intval($h_desde);
	} else{
       $num_horas = 0;
	   $hora_inicio = "00:00:00";
	   $hora_final = "00:00:00";
       $query15 = sprintf("SELECT TIMESTAMPDIFF(DAY,'$fecha_inicio', '$fecha_final') As num_dias "); 
       $select15 = mysql_query($query15, $conexion) or die(mysql_error());
       $row15 = mysql_fetch_assoc($select15);
       $totalRows15 = mysql_num_rows($select15);
       $num_dias = $row15['num_dias'] + 1;
	}
	
	if ($id_tipo_oficina == 1) {
       global $mysqli;
 
       $query17 = "SELECT id_funcionario, nombre_funcionario,
	           correo_funcionario
	           FROM funcionario
			   WHERE id_grupo_area = '$id_grupo_area'
			   AND id_cargo in(1,2)  
			   AND estado_funcionario =1 ";
        $result17 = $mysqli->query($query17);
        while ($obj17 = $result17->fetch_array()) {
           $id_funcionario_jefe_in  = $obj17['id_funcionario'];
		   $nombre_funcionario_jefe_in = $obj17['nombre_funcionario'];
		   $correo_funcionario_jefe_in  = $obj17['correo_funcionario'];
        }
        $result17->free();	
	}

	if ($id_tipo_oficina == 2) {
       global $mysqli;
 
     $query18 = "SELECT id_funcionario, nombre_funcionario,
	           correo_funcionario
			  FROM funcionario 
			  WHERE id_oficina_registro = '$id_oficina_registro' 
			   AND id_cargo in(1,2)  
			   AND estado_funcionario =1 ";
    $result18 = $mysqli->query($query18);
    while ($obj18 = $result18->fetch_array()) {
           $id_funcionario_jefe_in = $obj18['id_funcionario'];
		   $nombre_funcionario_jefe_in = $obj18['nombre_funcionario'];
		   $correo_funcionario_jefe_in  = $obj18['correo_funcionario'];
    }
   $result18->free();	
	}
	
	$motivo_ausentismo = $_POST['motivo_ausentismo'];
		
    $regdo = 0;
	global $mysqli;
    $query55 = "SELECT count(*) AS regdo
	FROM ausentismo 
	WHERE id_funcionario = '$id_funcionario'  
	AND   id_tipo_ausentismo = '$id_tipo_ausentismo' 
	AND   fecha_inicio = '$fecha_inicio'    
	AND   estado_ausentismo = 1 "; 
   $result55 = $mysqli->query($query55);
    while ($obj55 = $result55->fetch_array()) {
        $regdo = $obj55['regdo'];
    }
   $result55->free();	
	  
	if ($regdo > 0){ 
	   echo $repetido; 
       echo '<meta http-equiv="refresh" content="500;URL= ./ausentismo.jsp" />';
    } else{

    $tmp_fi = $fecha_inicio;
	$num_horas2 = $num_horas;
	
	$insertSQL = sprintf("INSERT INTO ausentismo (
      id_funcionario, id_tipo_ausentismo, fecha_inicio,
      hora_inicio, fecha_final, hora_final, 
      id_funcionario_jefe, id_funcionario_reempla,
      motivo_ausentismo, motivo_rechazo, fecha_registro) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now())", 
      GetSQLValueString($id_funcionario, "int"), 
	  GetSQLValueString($id_tipo_ausentismo, "int"),
	  GetSQLValueString($fecha_inicio, "date"),
	  GetSQLValueString($hora_inicio, "text"),
	  GetSQLValueString($fecha_final, "date"),
	  GetSQLValueString($hora_final, "text"),
	  GetSQLValueString($id_funcionario_jefe_in, "int"),
	  GetSQLValueString($id_funcionario_reempla, "int"),
	  GetSQLValueString($motivo_ausentismo, "text"),
	  GetSQLValueString($motivo_rechazo, "text")); 
      $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

      $id_ausentismo = 0;
	  // echo "fecha final: ".$fecha_final;
	  
	  global $mysqli;
	   
	   $query29 = "SELECT id_ausentismo 
	                      FROM ausentismo
	                      WHERE id_funcionario = '$id_funcionario'  
	                      AND   id_tipo_ausentismo = '$id_tipo_ausentismo' 
	                      AND   fecha_inicio = '$fecha_inicio'    
						  AND   fecha_final = '$fecha_final'  
	                      AND   estado_ausentismo = 1 ";       
		$result29 = $mysqli->query($query29);
        while ($obj29 = $result29->fetch_array()) {
                $id_ausentismo = $obj29['id_ausentismo'];
        }
       $result29->free();	

	$mafec[0] = $tmp_fi; 
	$sw = 0;
	if ($num_horas2 > 0) {
	   $num_dias = 1;
	}
	for ($i = 1; $i <= $num_dias; $i++) {
	   $query49 = "SELECT DATE_ADD('$tmp_fi', INTERVAL 1 DAY) fecha_dia  "; 
       $result49 = $mysqli->query($query49);
       while ($obj49 = $result49->fetch_array()) {
	        $tmp_fi = $obj49['fecha_dia'];
			$mafec[$i] = $tmp_fi;
        }
	}

    $estado =  0;        
    for ($i = 0; $i < $num_dias; $i++) {
	$tmp_fi = $mafec[$i];
	$estado = validafecha($tmp_fi);
	$num_dias2 = 1;
    if ($num_horas2 > 0) {
       $num_dias2 = 0;
	   $estado = 100;
    }
	if ($estado == 100) {   
	$insertSQL5 = sprintf("INSERT INTO detalle_ausentismo (
      id_ausentismo, id_funcionario, id_tipo_ausentismo, 
	  fecha_secuencia,
      hora_inicio, hora_final, num_dias, num_horas) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($id_ausentismo, "int"), 
      GetSQLValueString($id_funcionario, "int"), 
	  GetSQLValueString($id_tipo_ausentismo, "int"),
	  GetSQLValueString($tmp_fi, "date"),
	  GetSQLValueString($hora_inicio, "text"),
	  GetSQLValueString($hora_final, "text"),
	  GetSQLValueString($num_dias2, "int"),
	  GetSQLValueString($num_horas2, "int")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());
  
 }
 }
}

// archiva documento

   if (""!=$_FILES['file']['tmp_name']) { // 2

 	   global $mysqli;
	   $id_ausentismo2 = 0;
	   $id_funcionario = $_POST['id_funcionario'];
       $id_tipo_ausentismo = $_POST['id_tipo_ausentismo'];
	   $fecha_inicio = $_POST['fecha_inicio'];
	   $fecha_final = $_POST['fecha_final'];
	   
	   $query39 = "SELECT id_ausentismo 
	                      FROM ausentismo
	                      WHERE id_funcionario = '$id_funcionario'  
	                      AND   id_tipo_ausentismo = '$id_tipo_ausentismo' 
	                      AND   fecha_inicio = '$fecha_inicio'    
						  AND   fecha_final = '$fecha_final'  
	                      AND   estado_ausentismo = 1 ";       
		$result39 = $mysqli->query($query39);
        while ($obj39 = $result39->fetch_array()) {
				$id_ausentismo2 = $obj39['id_ausentismo'];
        }
       $result39->free();	

  
   

      $tipoArchivo=explode("/",$_FILES["file"]["type"]);
      $ubicacion="filesnr/ausentismosnr/";
	  $NomImagen=$_FILES['file']['name'];
	  $totarchivo=explode(".",$_FILES["file"]["name"]);
	  $aleatorio = aleatorio(100);
	  
	 //  echo $totarchivo[0];
	 $nombre_img=$id_ausentismo.'-'.$id_funcionario.'-'.$aleatorio.'.pdf';
	 
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
      $NomImagenR=$ubicacion."/".$nombre_img;
	 
     

      if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 11534336)) { // 3
	    if ($_FILES["file"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file']['tmp_name'],$NomImagenR);
			
//          $nombrebre_orig= ucwords($nombrefile);
//          $hash=md5($files);
            $id_tipo_docto_ausentismo = 0; // 0 = Evidencia
            $descrip_docto_ausentismo = "EVIDENCIA DEL AUSENTISMO";
			
            $insertSQL = sprintf("INSERT INTO docto_ausentismo (id_ausentismo, 
		    id_tipo_docto_ausentismo, nombre_docto_ausentismo, 
			descrip_docto_ausentismo, estado_docto_ausentismo, 
		    fecha_registro) 
            VALUES (%s, %s, %s, %s, 1, now())", 
            GetSQLValueString($id_ausentismo2, "int"), 
            GetSQLValueString($id_tipo_docto_ausentismo, "int"),
            GetSQLValueString($nombre_img, "text"),
			GetSQLValueString( $descrip_docto_ausentismo, "text"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
		  
 //           echo $insertado;
            echo ' ';
        } else { $valido=0; echo  $doc_no_tipo;
	           echo ' ';
			} // fin 4 
      } else { $valido=0; echo $doc_tam;
	         echo ' ';
		} // fin 3
		
		
  }

  
  // envío del correo al jefe inmediato

     global $mysqli;
     $nombre_funcionario = ' ';
	 
     $query38 = "SELECT nombre_funcionario
			  FROM funcionario 
			  WHERE id_funcionario = '$id_funcionario' 
			   AND estado_funcionario =1 ";
    $result38 = $mysqli->query($query38);
    while ($obj38 = $result38->fetch_array()) {
        $nombre_funcionario = $obj38['nombre_funcionario'];
    }
   $result38->free();	
  
	 global $mysqli;
     $nombre_tipo_ausentismo = ' ';
	 
     $query39 = "SELECT nombre_tipo_ausentismo
			  FROM tipo_ausentismo 
			  WHERE id_tipo_ausentismo = '$id_tipo_ausentismo' 
			   AND estado_tipo_ausentismo =1 ";
    $result39 = $mysqli->query($query39);
    while ($obj39 = $result39->fetch_array()) {
        $nombre_tipo_ausentismo = $obj39['nombre_tipo_ausentismo'];
    }
   $result39->free();	

/*
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

	  $emailune = $correo_funcionario_jefe_in;
      $subject = 'Nueva solicitud de Aprobación de Ausentismo';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "SISG - le informa que Usted tiene una nueva solicitud de Aprobación de Ausentismo";
      $cuerpo .= "<br><br>";
	  $cuerpo .= '<br>Solicitante: '.$nombre_funcionario.'<br>';
      $cuerpo .= '<br>Tipo de Ausentismo: '.$nombre_tipo_ausentismo.' desde: '.$fecha_inicio.' Hasta: '.$fecha_final.'<br>';
	  if ($fecha_inicio == $fecha_final){
	     $cuerpo .= '<br>Total Horas: '.$num_horas.'<br>';
	  } else {
	     $cuerpo .= '<br>Total Dias: '.$num_dias.'<br>';
	  }
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      mail($emailune, $subject, $cuerpo, $cabeceras);
*/


echo '<h1>Mensaje enviado a '.$emailune.'</h1>';
 

 echo '<meta http-equiv="refresh" content="0;URL= ./ausentismo.jsp" />';
 }	

// actualiza aprobacion del jefe inmediato
// *********************************************

if (isset($_POST['actajefeusen'])) {

    $num_horas2 = 0;
	$id_ausentismo = $_POST['id_ausentismo'];
	$id_tipo_ausentismo = $_POST['id_tipo_ausentismo2'];
    $id_aprobacion_ausentismo = $_POST['id_aprobacion_ausentismo2'];
    $fecha_inicio = $_POST['mfecha_inicio2'];
    $fecha_final = $_POST['mfecha_final2'];
    $hora_inicio = $_POST['hora_inicio2'];
    $hora_final = $_POST['hora_final2'];
	$id_tipo_oficina2 = $_POST['id_tipo_oficina2'];
    $tmp_fi = $fecha_inicio;
	if($fecha_inicio == $fecha_final) {
	   $num_dias = 0;
	   $array=explode(":", $hora_inicio);
	   $h_desde = $array[0];
	   $array2=explode(":", $hora_final);
	   $h_hasta = $array2[0];
       $num_horas = intval($h_hasta) - intval($h_desde);
	   $num_horas2 = $num_horas;
	} else{
       $num_horas = 0;
	   $hora_inicio = "00:00:00";
	   $hora_final = "00:00:00";
       $query15 = sprintf("SELECT TIMESTAMPDIFF(DAY,'$fecha_inicio', '$fecha_final') As num_dias "); 
       $select15 = mysql_query($query15, $conexion) or die(mysql_error());
       $row15 = mysql_fetch_assoc($select15);
       $totalRows15 = mysql_num_rows($select15);
       $num_dias = $row15['num_dias'] + 1;
	}


    $updateSQL37 = sprintf("UPDATE ausentismo 
	        SET fecha_inicio = %s,
			hora_inicio = %s,
			fecha_final = %s,
			hora_final = %s,
			fecha_aprueba = now(),
            id_aprobacion_ausentismo = %s			
			WHERE id_ausentismo = %s",                  
	GetSQLValueString($fecha_inicio, "date"),
	GetSQLValueString($hora_inicio, "text"),
	GetSQLValueString($fecha_final, "date"),
	GetSQLValueString($hora_final, "text"),
	GetSQLValueString($id_aprobacion_ausentismo, "text"),
	GetSQLValueString($id_ausentismo, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

	$query64 = "UPDATE detalle_ausentismo 
	SET estado_detalle_ausentismo = 0  
	WHERE id_ausentismo = '$id_ausentismo' ";  
    $Result1 = mysql_query($query64, $conexion);
	$mafec[0] = $tmp_fi; 
	$sw = 0;
	
	if ($num_horas2 > 0) {
	   $num_dias = 1;
	}
	for ($i = 1; $i <= $num_dias; $i++) {
	   $query49 = "SELECT DATE_ADD('$tmp_fi', INTERVAL 1 DAY) fecha_dia  "; 
       $result49 = $mysqli->query($query49);
       while ($obj49 = $result49->fetch_array()) {
	        $tmp_fi = $obj49['fecha_dia'];
			$mafec[$i] = $tmp_fi;
        }
	}

    $estado =  0; 
//  $num_dias	 = 3;
   
    for ($i = 0; $i < $num_dias; $i++) {
	$tmp_fi = $mafec[$i];
	$estado = validafecha($tmp_fi); // fecha valida - dia habil = 100
	$num_dias2 = 1;
    if ($num_horas2 > 0) {
       $num_dias2 = 0;
	   $estado = 100;
    }
	if ($estado == 100) {   
//	if (100 == 100) {  
	$insertSQL5 = sprintf("INSERT INTO detalle_ausentismo (
      id_ausentismo, id_funcionario, id_tipo_ausentismo, 
	  fecha_secuencia,
      hora_inicio, hora_final, num_dias, num_horas) 
	  VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", 
      GetSQLValueString($id_ausentismo, "int"), 
      GetSQLValueString($id_funcionario, "int"), 
	  GetSQLValueString($id_tipo_ausentismo, "int"),
	  GetSQLValueString($tmp_fi, "date"),
	  GetSQLValueString($hora_inicio, "text"),
	  GetSQLValueString($hora_final, "text"),
	  GetSQLValueString($num_dias2, "int"),
	  GetSQLValueString($num_horas2, "int")); 
      $Result5 = mysql_query($insertSQL5, $conexion) or die(mysql_error());
  
 }
 }

 
 
// Envío de correo a Jefe Dirección Técnica 

if($id_aprobacion_ausentismo == 1 and $id_tipo_oficina2 == 2) {   // Aprobación del Jefe inmediato
  
       global $mysqli;
 
       $query17 = "SELECT id_funcionario, nombre_funcionario,
	           correo_funcionario
	           FROM funcionario
			   WHERE id_grupo_area = 47
			   AND id_cargo in(1,2)  
			   AND estado_funcionario =1 ";
        $result17 = $mysqli->query($query17);
        while ($obj17 = $result17->fetch_array()) {
           $id_funcionario_jefe_dtr  = $obj17['id_funcionario'];
		   $nombre_funcionario_jefe_dtr = $obj17['nombre_funcionario'];
		   $correo_funcionario_jefe_dtr  = $obj17['correo_funcionario'];
        }
        $result17->free();	


	 global $mysqli;
     $nombre_tipo_ausentismo = ' ';
	 
     $query39 = "SELECT nombre_tipo_ausentismo
			  FROM tipo_ausentismo 
			  WHERE id_tipo_ausentismo = '$id_tipo_ausentismo' 
			   AND estado_tipo_ausentismo =1 ";
    $result39 = $mysqli->query($query39);
    while ($obj39 = $result39->fetch_array()) {
        $nombre_tipo_ausentismo = $obj39['nombre_tipo_ausentismo'];
    }
   $result39->free();	

	 global $mysqli;
     $nombre_tipo_ausentismo = ' ';
	 
     $query49 = "SELECT nombre_funcionario
			  FROM funcionario 
			  WHERE id_funcionario = '$id_funcionario' 
			   AND estado_funcionario =1 ";
    $result49 = $mysqli->query($query49);
    while ($obj49 = $result49->fetch_array()) {
        $nombre_funcionario = $obj49['nombre_funcionario'];
    }
   $result49->free();	
   
/*
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
      $emailune = $correo_funcionario_jefe_dtr;
      $subject = 'Nueva solicitud de autorización de Aprobación de Ausentismo';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "SISG - le informa que Usted tiene una nueva solicitud de aprobación de Ausentismo";
      $cuerpo .= "<br><br>";
	  $cuerpo .= '<br>Solicitante: '.$nombre_funcionario.'<br>';
      $cuerpo .= '<br>Tipo de Ausentismo: '.$nombre_tipo_ausentismo.' desde: '.$fecha_inicio.' Hasta: '.$fecha_final.'<br>';
	  if ($fecha_inicio == $fecha_final){
	     $cuerpo .= '<br>Total Horas: '.$num_horas.'<br>';
	  } else {
	     $cuerpo .= '<br>Total Dias: '.$num_dias.'<br>';
	  }
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      mail($emailune, $subject, $cuerpo, $cabeceras);


     echo '<h1>Mensaje enviado a '.$emailune.'</h1>';
*/
 
    }	

	echo $hecho;
		 
    echo '<meta http-equiv="refresh" content="0;URL= ./ausentismo.jsp" />';

 }

// actualiza aprobacion del jefe DTR
// ****************************************

if (isset($_POST['actjefedtr'])) {
    $id_ausentismo = $_POST['id_ausentismo3'];
    $id_aprobacion_ausentismo = $_POST['id_aprobacion_ausentismo3'];

    $updateSQL37 = sprintf("UPDATE ausentismo 
	        SET id_aprobacion_ausentismo = %s
			WHERE id_ausentismo = %s",                  
	GetSQLValueString($id_aprobacion_ausentismo, "text"),
	GetSQLValueString($id_ausentismo, "int"));
    $Result137 = mysql_query($updateSQL37, $conexion) or die(mysql_error());

       global $mysqli;
 
       $query17 = "SELECT a.id_funcionario, b.nombre_funcionario,
	           a.id_tipo_ausentismo, c.nombre_tipo_ausentismo,
			   a.fecha_inicio, a.fecha_final, a.hora_inicio, a.hora_final
	           FROM ausentismo a
			   LEFT JOIN funcionario b
			   ON a.id_funcionario = b.id_funcionario
			   LEFT JOIN tipo_ausentismo c
               ON a.id_tipo_ausentismo = c.id_tipo_ausentismo
			   WHERE id_ausentismo = '$id_ausentismo' 
			   AND a.estado_ausentismo = 1 ";
        $result17 = $mysqli->query($query17);
        while ($obj17 = $result17->fetch_array()) {
           $id_funcionario  = $obj17['id_funcionario'];
		   $nombre_funcionario = $obj17['nombre_funcionario'];
		   $id_tipo_ausentismo  = $obj17['id_tipo_ausentismo'];
		   $nombre_tipo_ausentismo  = $obj17['nombre_tipo_ausentismo'];
		   $fecha_inicio  = $obj17['fecha_inicio'];
		   $fecha_final  = $obj17['fecha_final'];
		   $hora_inicio  = $obj17['hora_inicio'];
		   $hora_final  = $obj17['hora_final'];
		   
        }
        $result17->free();	
		
	if($fecha_inicio == $fecha_final) {
	   $num_dias = 0;
	   $array=explode(":", $hora_inicio);
	   $h_desde = $array[0];
	   $array2=explode(":", $hora_final);
	   $h_hasta = $array2[0];
       $num_horas = intval($h_hasta) - intval($h_desde);
	} else{
       $num_horas = 0;
	   $hora_inicio = "00:00:00";
	   $hora_final = "00:00:00";
       $query15 = sprintf("SELECT TIMESTAMPDIFF(DAY,'$fecha_inicio', '$fecha_final') As num_dias "); 
       $select15 = mysql_query($query15, $conexion) or die(mysql_error());
       $row15 = mysql_fetch_assoc($select15);
       $totalRows15 = mysql_num_rows($select15);
       $num_dias = $row15['num_dias'] + 1;
	}


$id_funcionario_rod = 1028; //DTR Juan Carlos Diaz ** por defecto

switch ($id_tipo_ausentismo) {
   case 4:
         $id_funcionario_rod = 2041; //RRHH Yenny Ibañez 
         break;
   case 15:
         $id_funcionario_rod = 2041; //RRHH Yenny Ibañez 
         break;
   case 17:
         $id_funcionario_rod = 2041; //RRHH Yenny Ibañez 
         break;
   case 19:
         $id_funcionario_rod = 2041; //RRHH Yenny Ibañez 
         break;
   case 23:
         $id_funcionario_rod = 573; //RRHH Marcela Muñoz
         break;
   case 24:
         $id_funcionario_rod = 573; //RRHH Sandra Camargo
         break;
   case 6:
         $id_funcionario_rod = 1962; //DTR Victor Pinto
         break;
   case 7:
         $id_funcionario_rod = 1962; //DTR Victor Pinto
         break;
}
   
       global $mysqli;
 
       $query17 = "SELECT id_funcionario, nombre_funcionario,
	           correo_funcionario
	           FROM funcionario
			   WHERE id_funcionario = '$id_funcionario_rod'
			   AND estado_funcionario =1 ";
        $result17 = $mysqli->query($query17);
        while ($obj17 = $result17->fetch_array()) {
           $id_funcionario_rod  = $obj17['id_funcionario'];
		   $nombre_funcionario_rod = $obj17['nombre_funcionario'];
		   $correo_funcionario_rod  = $obj17['correo_funcionario'];
        }
        $result17->free();	
    
		
// envio del correo al Area Correspondiente (DTR o RRHH)
// *******************************************************************
/*
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
      $emailune = $correo_funcionario_rod;
      $subject = 'Nueva solicitud de autorización de Aprobación de Ausentismo';
      $cuerpo = '';
      $cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo .= "SISG - le informa que Usted tiene una nueva solicitud de aprobación de Ausentismo";
      $cuerpo .= "<br><br>";
	  $cuerpo .= '<br>Solicitante: '.$nombre_funcionario.'<br>';
      $cuerpo .= '<br>Tipo de Ausentismo: '.$nombre_tipo_ausentismo.' desde: '.$fecha_inicio.' Hasta: '.$fecha_final.'<br>';
	  if ($fecha_inicio == $fecha_final){
	     $cuerpo .= '<br>Total Horas: '.$num_horas.'<br>';
	  } else {
	     $cuerpo .= '<br>Total Dias: '.$num_dias.'<br>';
	  }
      $cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
      $cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>';
      $cabeceras = '';
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      mail($emailune, $subject, $cuerpo, $cabeceras);


     echo '<h1>Mensaje enviado a '.$emailune.'</h1>';
*/	

	echo $hecho;
		 
  echo '<meta http-equiv="refresh" content="0;URL= ./ausentismo.jsp" />';

 }

// *************************************************
// Registro Aprobacion Area Direcc Técnica
// *************************************************

if (isset($_POST['actscrgral'])){

	$id_ausentismo = $_POST['id_ausentismo4'];
    $id_aprobacion_ausentismo = $_POST['id_aprobacion_ausentismo4'];


    $updateSQL40 = sprintf("UPDATE ausentismo 
	        SET fecha_aprueba = now(),
             id_aprobacion_ausentismo = %s			
			WHERE id_ausentismo = %s",                  
	GetSQLValueString($id_aprobacion_ausentismo, "text"),
	GetSQLValueString($id_ausentismo, "int"));
    $Result40 = mysql_query($updateSQL40, $conexion) or die(mysql_error());

// archiva documento

   if (""!=$_FILES['file']['tmp_name']) { // 2

      $id_ausentismo2 = $_POST['id_ausentismo4'];
   

      $tipoArchivo=explode("/",$_FILES["file"]["type"]);
      $ubicacion="filesnr/ausentismosnr/";
	  $NomImagen=$_FILES['file']['name'];
	  $totarchivo=explode(".",$_FILES["file"]["name"]);
	  $aleatorio = aleatorio(100);
	  
	 //  echo $totarchivo[0];
	 $nombre_img=$id_ausentismo.'-'.$id_funcionario.'-'.$aleatorio.'.pdf';
	 
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
      $NomImagenR=$ubicacion."/".$nombre_img;
	 
     

      if (($_FILES['file']['name'] == !NULL) && ($_FILES['file']['size'] <= 11534336)) { // 3
	    if ($_FILES["file"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file']['tmp_name'],$NomImagenR);
			
//          $nombrebre_orig= ucwords($nombrefile);
//          $hash=md5($files);
            $id_tipo_docto_ausentismo = 1; // 1 = Resolucion
            $descrip_docto_ausentismo = "RESOLUCION DEL AUSENTISMO";
			
            $insertSQL = sprintf("INSERT INTO docto_ausentismo (id_ausentismo, 
		    id_tipo_docto_ausentismo, nombre_docto_ausentismo, 
			descrip_docto_ausentismo, estado_docto_ausentismo, 
		    fecha_registro) 
            VALUES (%s, %s, %s, %s, 1, now())", 
            GetSQLValueString($id_ausentismo2, "int"), 
            GetSQLValueString($id_tipo_docto_ausentismo, "int"),
            GetSQLValueString($nombre_img, "text"),
			GetSQLValueString( $descrip_docto_ausentismo, "text"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
		  
 //           echo $insertado;
            echo ' ';
        } else { $valido=0; echo  $doc_no_tipo;
	           echo ' ';
			} // fin 4 
      } else { $valido=0; echo $doc_tam;
	         echo ' ';
		} // fin 3
		
		
  }

	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./ausentismo.jsp" />';
 }

// ************************************************
// Registro Aprobacion Recursos Humanos
// ************************************************

if (isset($_POST['actrecurh'])){

	$id_ausentismo = $_POST['id_ausentismo5'];
    $id_aprobacion_ausentismo = $_POST['id_aprobacion_ausentismo5'];


    $updateSQL40 = sprintf("UPDATE ausentismo 
	        SET fecha_aprueba = now(),
             id_aprobacion_ausentismo = %s			
			WHERE id_ausentismo = %s",                  
	GetSQLValueString($id_aprobacion_ausentismo, "text"),
	GetSQLValueString($id_ausentismo, "int"));
    $Result40 = mysql_query($updateSQL40, $conexion) or die(mysql_error());

// archiva documento

   if (""!=$_FILES['file5']['tmp_name']) { // 2

      $id_ausentismo5 = $_POST['id_ausentismo5'];
   

      $tipoArchivo=explode("/",$_FILES["file5"]["type"]);
      $ubicacion="filesnr/ausentismosnr/";
	  $NomImagen=$_FILES['file5']['name'];
	  $totarchivo=explode(".",$_FILES["file5"]["name"]);
	  $aleatorio = aleatorio(100);
	  
	 //  echo $totarchivo[0];
	 $nombre_img=$id_ausentismo.'-'.$id_funcionario.'-'.$aleatorio.'.pdf';
	 
//    $NomImagenR=$ubicacion."/".$NomImagen.'.'.$tipoArchivo[1];     
      $NomImagenR=$ubicacion."/".$nombre_img;
	 
     

      if (($_FILES['file5']['name'] == !NULL) && ($_FILES['file5']['size'] <= 11534336)) { // 3
	    if ($_FILES["file5"]["type"] == "application/pdf") {

            move_uploaded_file($_FILES['file5']['tmp_name'],$NomImagenR);
			
//          $nombrebre_orig= ucwords($nombrefile);
//          $hash=md5($files);
            $id_tipo_docto_ausentismo = 1; // 1 = Resolucion
            $descrip_docto_ausentismo = "RESOLUCION DEL AUSENTISMO RH";
			
            $insertSQL = sprintf("INSERT INTO docto_ausentismo (id_ausentismo, 
		    id_tipo_docto_ausentismo, nombre_docto_ausentismo, 
			descrip_docto_ausentismo, estado_docto_ausentismo, 
		    fecha_registro) 
            VALUES (%s, %s, %s, %s, 1, now())", 
            GetSQLValueString($id_ausentismo5, "int"), 
            GetSQLValueString($id_tipo_docto_ausentismo, "int"),
            GetSQLValueString($nombre_img, "text"),
			GetSQLValueString( $descrip_docto_ausentismo, "text"));
	        $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
		  
 //           echo $insertado;
            echo ' ';
        } else { $valido=0; echo  $doc_no_tipo;
	           echo ' ';
			} // fin 4 
      } else { $valido=0; echo $doc_tam;
	         echo ' ';
		} // fin 3
		
		
  }

	echo $hecho;
		 
	echo '<meta http-equiv="refresh" content="0;URL= ./ausentismo.jsp" />';
 }
 
 
?>

 

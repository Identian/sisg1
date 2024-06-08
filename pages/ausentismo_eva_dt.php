<?php

$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;


if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {

   if (isset($_GET['i'])) { 
      $nodo = explode('x', $_GET['i']);
      $id_funcionario=$nodo[0];
      $fecha_inicio=$nodo[1];
      $fecha_final=$nodo[2];
	  $nodo_dev = $id_funcionario.'x'.$fecha_inicio.'x'.$fecha_final; 

   //  echo "id: ".$id_funcionario;
	  
    } else {
	  echo '<meta http-equiv="refresh" content="0;URL=./" />';
	}  

} else {
	  echo '<meta http-equiv="refresh" content="0;URL=./" />';
}  
/*
      $id_funcionario=4199;
      $fecha_inicio='2020-03-01';
      $fecha_final='2020-11-30';
*/

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
	   $nombre_funcionario = $row5['nombre_funcionario'];	   
} else { 
      echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 

$sw5 = 0;
$privi = "  AND a.id_funcionario = '$id_funcionario' AND a.fecha_inicio between '$fecha_inicio' AND '$fecha_final' ";

 include('tablero_ausentismo_func.php');
 
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
		  <p style="font-size: 20px"><b>AUSENTISMO POR FUNCIONARIO - </b><?php echo $nombre_funcionario.' ** DESDE: '.$fecha_inicio.' HASTA: '.$fecha_final; ?></p>
        </div>
      </div>
    </nav>
  </div>
</div>

	  
	  
	  
<div class="row">
<div class="col-md-12">

 <div class="box box-info">
  <div class="box-header with-border">
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
  </div>
  
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tab_sucesiones">
           <thead>
                <tr>
                  <th>Id Aus</th>
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
                <a href="consulta_ausentismo_eva_con&<?php echo $nodo_dev.'x'.$id_ausentismo; ?>.jsp"><span class="btn btn-info btn-xs" title="Consultar"><span  class="glyphicon glyphicon-hand-up"></span></a> &nbsp;
             </td> 
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
 
?>

 

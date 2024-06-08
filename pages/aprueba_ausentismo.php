<?php

$id_funcionario = 0;
$cedula_funcionario = 0;
$id_cargo = 0;
$id_tipo_oficina = 0;
$id_grupo_area = 0;
$id_oficina_registro = 0;
$nombre_funcionario = ' ';

if (isset($_SESSION['snr']) && ($_SESSION['snr'] != "")) {
//	  $id_funcionario = 5;
	  $id_funcionario = $_SESSION['snr'];
	  $query5 = sprintf("SELECT * FROM funcionario
                  where id_funcionario = '$id_funcionario' 
				  and estado_funcionario = 1 "); 
    $select5 = mysql_query($query5, $conexion) or die(mysql_error());
    $row5 = mysql_fetch_assoc($select5);
    $totalRows5 = mysql_num_rows($select5);
    if ($totalRows5 > 0){
       $id_cargo = $row5['id_cargo'];
	   $nombre_funcionario = $row5['nombre_funcionario'];
	   $id_tipo_oficina = $row5['id_tipo_oficina'];
	   $id_grupo_area = $row5['id_grupo_area'];
	   $id_oficina_registro = $row5['id_oficina_registro'];
	   
     }
	  
} else { 
    echo '<meta http-equiv="refresh" content="0;URL=./" />';
} 

$privi = " AND a.id_funcionario = '$id_funcionario' ";

  if ($_SESSION['rol'] == 1){  // superadmon
    $privi = " ";
	} else {
    $id= 0;
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
		  <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			    <li><a href="ausentismo.jsp"><b>AUSENTISMO</b><?php echo ' -  Aprobación o Rechazo Jefe: '.$nombre_funcionario; ?></a></li>
            </ul>
        </div>

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
                  <th>Nombre Funcionario</th>
                  <th>Tipo Ausentismo</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                  <th>Total Días</th>
                  <th>Total Horas</th>
                  <th>Estado</th>
                 <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
			
			  $id_funcionario = 6464;
			  
              $query875 = sprintf("SELECT au.id_ausentismo, au.id_funcionario, 
			  au.id_tipo_ausentismo, 
      fecha_inicio, hora_inicio, fecha_final, hora_final, 
      au.id_funcionario_jefe, au.id_funcionario_reempla,
      motivo_ausentismo, soli.nombre_funcionario funcionario_soli,
	  tipoa.nombre_tipo_ausentismo, jefe.nombre_funcionario funcionario_jefe,
	  reem.nombre_funcionario funcionario_reem,
	  au.id_aprobacion_ausentismo, apa.nombre_aprobacion_ausentismo,
	  tot_dias, tot_horas
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
	  LEFT JOIN consol_ausentismo f
	  ON au.id_ausentismo = f.id_ausentismo 
      WHERE au.id_funcionario_jefe = '$id_funcionario' 
	  AND au.estado_ausentismo = 1 order by au.fecha_inicio desc");
              $select875 = mysql_query($query875, $conexion) or die(mysql_error());
              while($row_dian = mysql_fetch_array($select875)) {
				  
            ?>
          <tr>
			 <?php $id_ausentismo = $row_dian['id_ausentismo'];
                  $nom_tipoau      =  $row_dian['nombre_tipo_ausentismo'];
                  $codifi = mb_detect_encoding($nom_tipoau, "UTF-8, ISO-8859-1");
                  $nombre_tipo_ausentismo = iconv($codifi, 'UTF-8', $nom_tipoau);

                  $nom_soli      =  $row_dian['funcionario_soli'];
                  $codifi = mb_detect_encoding($nom_soli, "UTF-8, ISO-8859-1");
                  $funcionario_soli = iconv($codifi, 'UTF-8', $nom_soli);

			 ?>
             <td><?php echo $funcionario_soli;?></td>
             <td><?php echo $nombre_tipo_ausentismo;?></td>
             <td><?php echo $row_dian['fecha_inicio'];?></td>
             <td><?php echo $row_dian['fecha_final'];?></td>
             <td><?php echo $row_dian['tot_dias'];?></td>
             <td><?php echo $row_dian['tot_horas'];?></td>
             <td><?php echo $row_dian['nombre_aprobacion_ausentismo'];?></td>
             <td>
               <a href="aprueba_ausentismo_det&<?php echo $id_ausentismo; ?>.jsp"><span class="pull-left-container"><small class="label pull-left bg-green">Aprobar / Rechazar</small></span></a> &nbsp; 
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


  
 

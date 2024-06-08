<?php if (1==$_SESSION['rol']) { ?>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border"><span style="height: "></span>
        <h4 class="box-title"><b>Reporte de informe DIAN</b></h4>
      </div>
      <div class="box-body">

            <div class="table-responsive">
              <div>
                <form action="" method="POST" name="enviodevarabusqueda">
                <span style=" float: left;">&nbsp;&nbsp;Desde&nbsp;&nbsp;</span>
                <input style="width:120px; float: left;" type="text" name="ped_ini" class="form-control datepickercuraduria" readonly="readonly" required>
                <span style=" float: left;">&nbsp;&nbsp;Hasta&nbsp;&nbsp;</span>
                <input style="width:120px; float: left;" type="text" name="ped_fin" class="form-control datepickercuraduria" readonly="readonly" required>
                <span style=" float: left;">&nbsp;&nbsp;Curaduria&nbsp;&nbsp;</span>
                <select class="form-control" name="id_notaria" style="width:300px; float: left;" >                   
                <?php
                    $actualizar5 = mysql_query("SELECT * FROM notaria WHERE  estado_notaria = 1  order by nombre_notaria", $conexion) or die(mysql_error());
                    $row15 = mysql_fetch_assoc($actualizar5);
                    $total55 = mysql_num_rows($actualizar5);
                    if (0<$total55) {
                       echo '<option value="0">TODO</option>';
                     do {
                       echo '<option value="'.$row15['id_notaria'].'" ';
                       echo '>'.$row15['nombre_notaria'].'</option>';
                     } while ($row15 = mysql_fetch_assoc($actualizar5)); 
                     
                      mysql_free_result($actualizar5);
                    } else {}
                  ?>
                  </select>
                <input class="btn-xl btn btn-primary" type="submit" name="repor_dian_notaria" value="Buscar"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="./expensa_reporte.jsp"/>Restaurar</a>
                </form>
              </div><br><br>
            <table class="table table-striped table-bordered" id="reportedian">
               <thead>
                    <tr>
                      <th>Nombre_Notaria</th>
                      <th>Periodo</th>
                      <th>No_Escritura</th>
                      <th>Fecha_Escritura</th>
                      <th>Cod_Acto</th>
                      <th>Tipo_Acto</th>
                      <th>Nit_Enajenante</th>
                      <th>Nom_Enajenante</th>
                      <th>Nit_Adquiriente</th>
                      <th>Nom_Adquiriente</th>
                      <th>Valor_Escritura</th>
                      <th>No_Formulario</th>
                      <th>Valor</th>
              <th>Pago_Valor</th>
              <th>Valor_Pagado</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  if (isset($_POST['repor_dian_notaria'])) {
					  
                    $idnota=$_POST['id_notaria'];
                    if ($idnota==0) {
                      $ped_ini=$_POST['ped_ini'];
                      $ped_fin=$_POST['ped_fin'];
                    $query875 = sprintf("SELECT * FROM notaria_dian_reporte, notaria, notaria_dian WHERE
               notaria_dian_reporte.id_notaria_dian=notaria_dian.id_notaria_dian AND 
				   notaria_dian.id_notaria=notaria.id_notaria  AND 
					  
                      ped_ini BETWEEN '$ped_ini' AND '$ped_fin' AND
                      estado_notaria_dian_reporte=1 ");
					  
					  
                    }else{
                      $ped_ini=$_POST['ped_ini'];
                      $ped_fin=$_POST['ped_fin'];
                      $idnota=$_POST['id_notaria'];
                    $query875 = sprintf("SELECT * FROM notaria_dian_reporte, notaria, notaria_dian WHERE
               notaria_dian_reporte.id_notaria_dian=notaria_dian.id_notaria_dian AND 
				   notaria_dian.id_notaria=notaria.id_notaria  AND 
                      ped_ini BETWEEN '$ped_ini' AND '$ped_fin' AND
                      estado_notaria_dian_reporte=1 ");
					  
                    }
                  }else{
                    $query875 = sprintf("SELECT * FROM notaria_dian_reporte, notaria, notaria_dian WHERE
               notaria_dian_reporte.id_notaria_dian=notaria_dian.id_notaria_dian AND 
				   notaria_dian.id_notaria=notaria.id_notaria");
                  }
                  $select875 = mysql_query($query875, $conexion) or die(mysql_error());
                   while($row_dian = mysql_fetch_array($select875)) {
                ?>
                  <tr>
                 <td><?php echo $row_dian['nombre_notaria'];?></td>
                 <td><?php echo $row_dian['ped_ini'].'<br> al <br>'.$row_dian['ped_fin'];?></td>
                 <td><?php echo $row_dian['num_escritura'];?></td>
                 <td><?php echo $row_dian['fec_escritura'];?></td>
                 <td><?php echo $row_dian['cod_acto'];?></td>
                 <td><?php echo $row_dian['tipo_acto'];?></td>
                 <td><?php echo $row_dian['nit_enajenante'];?></td>
                 <td><?php echo $row_dian['nombre_enajenante'];?></td>
                 <td><?php echo $row_dian['nit_adquiriente'];?></td>
                 <td><?php echo $row_dian['nombre_adquiriente'];?></td>
                 <td><?php echo $row_dian['valor_escritura'];?></td>
                 <td><?php echo $row_dian['num_form'];?></td>
                 <td><?php echo $row_dian['valor'];?></td>
                 <td><?php echo $row_dian['valor_pago'];?></td>
                 <td><?php echo $row_dian['valor_inc'];?></td>
              </tr>
             
          <?php } ?> <!-- CIERRE PRIMER WHILE -->

              <script>
              $(document).ready(function() {
              $('#reportedian').DataTable({
                dom: 'Bfrtip',
                  buttons: [
                    // 'copyHtml5',
                    'excelHtml5',
                    'csvHtml5'
                    // 'pdfHtml5'
                  ],
				"lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              }
              });
              });
              </script>
                </tbody>
            </table>
           </div>

        </div>
      </div>
    </div>
  </div>

<?php } else {} ?>
<?php

$nump=privilegios(16,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump) {

?>


<div class="row">
	<div class="col-md-12" style="font-size:100%">
		<div class="box">
			<div class="box-header with-border">
			<h4 class="box-title"><b>INFORMES DE TARIFAS</b></h4>
				<div class="box-tools pull-right">
			        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			    </div>
			</div> <!-- BOX HEADER -->
				<div class="box-body">
					
					<div>
						<form action="" method="POST" name="enviodevarabusqueda">
						<span style=" float: left;">&nbsp;&nbsp;Desde&nbsp;&nbsp;</span>
						<input style="width:120px; float: left;" type="text" name="ped_ini" class="form-control datepickercuraduria" readonly="readonly" required>
						<span style=" float: left;">&nbsp;&nbsp;Hasta&nbsp;&nbsp;</span>
						<input style="width:120px; float: left;" type="text" name="ped_fin" class="form-control datepickercuraduria" readonly="readonly" required>
						<span style=" float: left;">&nbsp;&nbsp;Curaduria&nbsp;&nbsp;</span>
						<select class="form-control" name="id_curaduria" style="width:300px; float: left;" >							     
						<?php
					      $actualizar5 = mysql_query("SELECT * FROM curaduria WHERE  estado_curaduria = 1  order by nombre_curaduria", $conexion) or die(mysql_error());
					      $row15 = mysql_fetch_assoc($actualizar5);
					      $total55 = mysql_num_rows($actualizar5);
					      if (0<$total55) {
					         echo '<option value="0">TODO</option>';
					       do {
					         echo '<option value="'.$row15['id_curaduria'].'" ';
					         echo '>'.$row15['nombre_curaduria'].'</option>';
					       } while ($row15 = mysql_fetch_assoc($actualizar5)); 
					       
					        mysql_free_result($actualizar5);
					      } else {}
					    ?>
					    </select>
						<input class="btn-xl btn btn-primary" type="submit" name="repor_tarifa_expensa" value="Buscar"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="./expensa_reporte.jsp"/>Restaurar</a>
						</form>
					</div><br><br>
					<table class="table display nowrap" id="reporteexpensa">
						<thead>
							<tr>
							  <th>No Curaduria</th>
							  <th>Fecha Ini</th>
							  <th>Fecha Fin</th>

							  <th>GP NP</th>
							  <th>GP NS</th>
							  <th>GP Salario</th>
							  <th>GP Transporte</th>
							  <th>GP Cesantias</th>
							  <th>GP Primas</th>
							  <th>GP Vacaciones</th>
							  <th>GP Honorarios</th>
							  <th>GP Otros</th>

							  <th>GG Gastos Financieros</th>
							  <th>GG Man De Equipos</th>
							  <th>GG Arrandamiento</th>
							  <th>GG Servicio Publico</th>
							  <th>GG Seguros</th>
							  <th>GG Utiles Y Papeleria</th>
							  <th>GG Bienestar</th>
							  <th>GG Otros</th>

							  <th>GI Inf Y locativos</th>
							  <th>GI Sistema y Tec</th>
							  <th>GI Capacitacion</th>

							  <th>GT CCF</th>
							  <th>GT Sena</th>
							  <th>GT ICBF</th>
							  <th>GT EPS</th>
							  <th>GT ARP</th>
							  <th>GT FAP</th>
							  <th>GT Agremiaciones</th>
							  <th>GT Otros</th>

							  <th>GIVA Valor IVA</th>
							  <th>GIVA Fec Pago</th>
							  <th>GIVA Pdo Desde</th>
							  <th>GIVA Pdo Hasta</th>
							  <th>GIVA Valor ReteFuente</th>
							  <th>GIVA Fec Pago</th>

							  <th>GIVA Periodo Desde</th>
							  <th>GIVA Periodo Hasta</th>
							  <th>GIVA Valor ReteICA</th>
							  <th>GIVA Fecha Pago</th>
							  <th>GIVA Periodo Desde</th>

							  <th>GIVA Periodo Hasta</th>
							  <th>GIVA Observaciones</th>
							  
							</tr>
						</thead>
					<tbody>
					<?php
					if (isset($_POST['repor_tarifa_expensa'])) {
						$idcun=$_POST['id_curaduria'];
						if ($idcun==0) {
							$ped_ini=$_POST['ped_ini'];
							$ped_fin=$_POST['ped_fin'];
							$query1201 = sprintf("SELECT * FROM curaduria, expensa_curaduria, expensa_gg, expensa_gi, expensa_giva, expensa_gp, expensa_gt WHERE 
							curaduria.id_curaduria=expensa_curaduria.id_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_gg.id_expensa_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_gi.id_expensa_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_giva.id_expensa_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_gp.id_expensa_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_gt.id_expensa_curaduria AND
							fecha_inicio_expensa BETWEEN '$ped_ini' AND '$ped_fin' AND
							expensa_curaduria.estado_expensa_curaduria=1");
						}else{
							$ped_ini=$_POST['ped_ini'];
							$ped_fin=$_POST['ped_fin'];
							$idcun=$_POST['id_curaduria'];
							$query1201 = sprintf("SELECT * FROM curaduria, expensa_curaduria, expensa_gg, expensa_gi, expensa_giva, expensa_gp, expensa_gt WHERE 
							curaduria.id_curaduria=expensa_curaduria.id_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_gg.id_expensa_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_gi.id_expensa_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_giva.id_expensa_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_gp.id_expensa_curaduria AND
							expensa_curaduria.id_expensa_curaduria=expensa_gt.id_expensa_curaduria AND
							fecha_inicio_expensa BETWEEN '$ped_ini' AND '$ped_fin' AND curaduria.id_curaduria='$idcun' AND
							expensa_curaduria.estado_expensa_curaduria=1");
						}
					}else{
						$query1201 = sprintf("SELECT * FROM curaduria, expensa_curaduria, expensa_gg, expensa_gi, expensa_giva, expensa_gp, expensa_gt WHERE 
						curaduria.id_curaduria=expensa_curaduria.id_curaduria AND
						expensa_curaduria.id_expensa_curaduria=expensa_gg.id_expensa_curaduria AND
						expensa_curaduria.id_expensa_curaduria=expensa_gi.id_expensa_curaduria AND
						expensa_curaduria.id_expensa_curaduria=expensa_giva.id_expensa_curaduria AND
						expensa_curaduria.id_expensa_curaduria=expensa_gp.id_expensa_curaduria AND
						expensa_curaduria.id_expensa_curaduria=expensa_gt.id_expensa_curaduria AND
						expensa_curaduria.estado_expensa_curaduria=1");
					}
					$select1201 = mysql_query($query1201, $conexion) or die(mysql_error());
					while($row1201 = mysql_fetch_assoc($select1201)) {
					?>
					<tr>
						<td><?php echo '<a href="pdf/expensa&'.$row1201['id_expensa_curaduria'].'.pdf"><img src="images/pdf.png"></a>'; ?> <?php echo $row1201['nombre_curaduria']; ?></td>
						<td><?php echo $row1201['fecha_inicio_expensa']; ?></td>
						<td><?php echo $row1201['fecha_final_expensa']; ?></td>

						<td><?php echo $row1201['dg_c']; ?></td>
					    <td><?php echo $row1201['dg_s']; ?></td>
					    <td><?php echo $row1201['dg_sal']; ?></td>
					    <td><?php echo $row1201['dg_trans']; ?></td>
					    <td><?php echo $row1201['dg_cesan']; ?></td>
					    <td><?php echo $row1201['dg_primas']; ?></td>
					    <td><?php echo $row1201['dg_vaca']; ?></td>
					    <td><?php echo $row1201['dg_hono']; ?></td>
					    <td><?php echo $row1201['dg_otros']; ?></td>

					    <td><?php echo $row1201['dgg_finan']; ?></td>
					    <td><?php echo $row1201['dgg_equipos']; ?></td>
					    <td><?php echo $row1201['dgg_arren']; ?></td>
					    <td><?php echo $row1201['dgg_pub']; ?></td>
					    <td><?php echo $row1201['dgg_seg']; ?></td>
					    <td><?php echo $row1201['dgg_pap']; ?></td>
						<td><?php echo $row1201['dgg_bie']; ?></td>
						<td><?php echo $row1201['dgg_otros']; ?></td>

						<td><?php echo $row1201['deg_infra']; ?></td>
						<td><?php echo $row1201['deg_sistec']; ?></td>
						<td><?php echo $row1201['deg_cap']; ?></td>

						<td><?php echo $row1201['dt_cc']; ?></td>
						<td><?php echo $row1201['dt_sena']; ?></td>
						<td><?php echo $row1201['df_icbf']; ?></td>
						<td><?php echo $row1201['dt_es']; ?></td>
						<td><?php echo $row1201['dt_arp']; ?></td>
						<td><?php echo $row1201['dt_fadp']; ?></td>
						<td><?php echo $row1201['dt_agremi']; ?></td>
						<td><?php echo $row1201['dt_otros']; ?></td>

						<td><?php echo $row1201['iva_vi']; ?></td>
					    <td><?php echo $row1201['iva_vifepago']; ?></td>
					    <td><?php echo $row1201['iva_vipeini']; ?></td>
					    <td><?php echo $row1201['iva_vipefin']; ?></td>
					    <td><?php echo $row1201['iva_rf']; ?></td>
					    <td><?php echo $row1201['iva_rffepago']; ?></td>

						<td><?php echo $row1201['iva_rfpeini']; ?></td>
						<td><?php echo $row1201['iva_rfpefin']; ?></td>
						<td><?php echo $row1201['iva_rete']; ?></td>
						<td><?php echo $row1201['iva_retefepago']; ?></td>
						<td><?php echo $row1201['iva_retepeini']; ?></td>

						<td><?php echo $row1201['iva_retepefin']; ?></td>
						<td><?php echo $row1201['iva_obser']; ?></td>

					</tr>
					<?php } ?> 

					<script>
								$(document).ready(function() {
									$('#reporteexpensa').DataTable({
										dom: 'Bfrtip',
										buttons: [{
												extend: 'excelHtml5',
												title: 'Detalle Reporte Gastos Curadurias <?php echo date("d-m-Y"); ?>'
											},
											{
												extend: 'csvHtml5',
												title: 'Detalle Reporte Gastos Curadurias <?php echo date("d-m-Y"); ?>'
											}
										],
										"lengthMenu": [
											[50, 100, 200, 300, 500],
											[50, 100, 200, 300, 500]
										],
										"language": {
											"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
										}
									});
								});
							</script>
							
					</tbody>
					</table>
					
				</div> <!-- BODY -->
			
		</div> <!-- BOX -->
	</div> <!-- COL-MD-12 -->
</div>  <!-- ROW -->

<?php

} else {}

?>

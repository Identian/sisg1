<?php
	if (isset($_GET['i'])) {
	$id=$_GET['i'];

  if (isset($_GET['i']) && 1==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['rol']) {
    $idnota="";
	} else {
	$idnota0=$_SESSION['id_vigilado'];
	$idnota= "  notaria.id_notaria=".$idnota0." and ";
	}



	$query54 = sprintf("SELECT * FROM notaria, notaria_dian WHERE
	notaria.id_notaria=notaria_dian.id_notaria AND
	notaria_dian.id_notaria_dian=".$id." AND
	".$idnota."
	estado_notaria_dian=1 ");
	$select54 = mysql_query($query54, $conexion) or die(mysql_error());
	$row54 = mysql_fetch_assoc($select54);
	$totalR = mysql_num_rows($select54);
	
if (0<$totalR) {
	
	
	$id_notaria=$row54['id_notaria'];
	$nombre_notaria=$row54['nombre_notaria'];
	$ped_ini=$row54['ped_ini'];
	$ped_fin=$row54['ped_fin'];
	$reporte_estado=$row54['reporte_estado'];
	
	
	


	if(isset($_POST['cerrardianreporte'])){ 

		$query90 = mysql_query("SELECT count(notaria_dian.id_notaria_dian) as repordian FROM notaria_dian_reporte, notaria, notaria_dian WHERE
               notaria_dian_reporte.id_notaria_dian=notaria_dian.id_notaria_dian AND 
				   notaria_dian.id_notaria=notaria.id_notaria and
					  
		              	notaria_dian.id_notaria='$id_notaria' AND 
		              	notaria_dian_reporte.id_notaria_dian='$id' AND
		              	estado_notaria_dian_reporte=1
		
		
		", $conexion);
		$row90 = mysql_fetch_assoc($query90);
		$ver_reporte=$row90['repordian'];

	   if (0==$ver_reporte) { 

	   ECHO '<div class="alert-danger" style="padding:5px; margin:1px; border-radius:5px;">
                <h6><i class="icon fa fa-warning"></i>&nbsp;&nbsp; NO se puede cerrar el periodo SIN Registros</h6>
             </div>';

	   } else {

		  $updateSQL = sprintf("UPDATE notaria_dian SET 
		  reporte_estado=%s 
		  where id_notaria_dian=%s",
		  GetSQLValueString(1,"int"),
		  GetSQLValueString($id, "int"));
		  $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

		  echo $actualizado;

		  //echo '<meta http-equiv="refresh" content="0;URL=./notaria_dian_reporte&'.$id.'.jsp" />';

		}

}else {}


 if(isset($_POST['subirmaxivo'])){  
    //Aquí es donde seleccionamos nuestro csv
    $fname = $_FILES['sel_file']['name'];
    //echo 'Cargando nombre del archivo: '.$fname.' <br>';
    $chk_ext = explode(".",$fname);
    if(strtolower(end($chk_ext)) == "csv"){
    //si es correcto, entonces damos permisos de lectura para subir
    $filename = $_FILES['sel_file']['tmp_name'];
    $handle = fopen($filename, "r");
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE){
      $id_notaria;
      $id_notaria_dian=$id;
      $num_escritura=$data[0];
      // arreglo de fecha corta 
      $dateFormated = split('/', $data[1]);
      $fec_escritura = $dateFormated[2].'-'.$dateFormated[1].'-'.$dateFormated[0];
      $cod_acto=$data[2];

      $tipo_acto=$data[3];
      $nit_enajenante=$data[4];
      $nombre_enajenante=$data[5];
      $nit_adquiriente=$data[6];
      $nombre_adquiriente=$data[7];

      $valor_escritura=$data[8];
      $num_form1=$data[9];
	  $num_form= str_replace("'", "", $num_form1);
	  
      $valor=$data[10];
      $valor_pago=$data[11];
      $valor_inc=$data[12];

		$actualizar5u = mysql_query("SELECT count(id_notaria_dian_reporte) as totfac FROM notaria_dian_reporte, notaria_dian  WHERE notaria_dian_reporte.id_notaria_dian=notaria_dian.id_notaria_dian AND  notaria_dian.id_notaria=".$id_notaria." and num_escritura=".$num_escritura." and fec_escritura >= '".$fec_escritura."' and estado_notaria_dian_reporte=1", $conexion);
		$row15u = mysql_fetch_assoc($actualizar5u);
		$totfac=$row15u['totfac'];

	   if (0<$totfac) { 
	   ECHO '<div class="alert-warning" style="padding:5px; margin:1px; border-radius:5px;">
                <h6><i class="icon fa fa-warning"></i> Escritura Repetida: <b>'.$num_escritura.'</b></h6>
             </div>';
	   } else {

  	if (is_numeric($num_escritura) AND is_numeric($cod_acto) AND is_numeric($nit_enajenante) AND is_numeric($nit_adquiriente) AND is_numeric($valor_escritura) AND is_numeric($num_form) AND is_numeric($valor) AND is_numeric($valor_inc) AND $fec_escritura > $ped_ini && $fec_escritura < $ped_fin) {

		$insertSQL = sprintf("INSERT INTO notaria_dian_reporte (
		  nombre_notaria_dian_reporte,
		  id_notaria_dian,
	      num_escritura,
	      fec_escritura,	      
	      cod_acto,

	      tipo_acto,
	      nit_enajenante,
	      nombre_enajenante,
	      nit_adquiriente,
	      nombre_adquiriente,

	      valor_escritura,
	      num_form,
	      valor,
	      valor_pago,
	      valor_inc,

	      fec_now,
	      estado_notaria_dian_reporte) 
		VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, now(),%s)", 
		GetSQLValueString($nombre_notaria.'-'.$id_notaria.'-'.$id_notaria_dian, "text"), 
		GetSQLValueString($id_notaria_dian, "int"), 
		GetSQLValueString($num_escritura, "int"), 
		GetSQLValueString($fec_escritura, "date"),
		GetSQLValueString($cod_acto, "int"),

		GetSQLValueString($tipo_acto, "text"),
		GetSQLValueString($nit_enajenante, "int"),
		GetSQLValueString($nombre_enajenante, "text"), 
		GetSQLValueString($nit_adquiriente, "int"), 
		GetSQLValueString($nombre_adquiriente, "text"),

		GetSQLValueString($valor_escritura, "int"), 
		GetSQLValueString($num_form, "text"),
		GetSQLValueString($valor, "int"), 
		GetSQLValueString($valor_pago, "text"), 
		GetSQLValueString($valor_inc, "int"), 
		GetSQLValueString(1, "int")
		);

		$Result = mysql_query($insertSQL, $conexion);

	} else {

		switch (is_numeric($num_escritura)) {
		    case 0:
		        $escritura = ' (Columna A) NO es Numero '.$num_escritura;
		        break;
		    case 1:
		        $escritura = '';
		        break;
		}
	   	
		switch (is_numeric($cod_acto)) {
		    case 0:
		        $acto = ' (Columna C) NO es Numero '.$cod_acto;
		        break;
		    case 1:
		        $acto = '';
		        break;
		}

		switch (is_numeric($nit_enajenante)) {
		    case 0:
		        $enajenante = ' (Columna E) NO es Numero '.$nit_enajenante;
		        break;
		    case 1:
		        $enajenante = '';
		        break;
		}


		switch (is_numeric($nit_adquiriente)) {
		    case 0:
		        $adquiriente = ' (Columna G) NO es Numero '.$nit_adquiriente;
		        break;
		    case 1:
		        $adquiriente = '';
		        break;
		}


		switch (is_numeric($valor_escritura)) {
		    case 0:
		        $valorescritura = ' (Columna I) NO es Numero '.$valor_escritura;
		        break;
		    case 1:
		        $valorescritura = '';
		        break;
		}

		switch (is_numeric($num_form)) {
		    case 0:
		        $numform = ' (Columna J) NO es Numero '.$num_form;
		        break;
		    case 1:
		        $numform = '';
		        break;
		}

		switch (is_numeric($valor)) {
		    case 0:
		        $valor = ' (Columna K) NO es Numero '.$valor;
		        break;
		    case 1:
		        $valor = '';
		        break;
		}

		switch (is_numeric($valor_inc)) {
		    case 0:
		        $valorinc = ' (Columna M) NO es Numero '.$valor_inc;
		        break;
		    case 1:
		        $valorinc = '';
		        break;
		}

		switch ($fec_escritura > $ped_ini && $fec_escritura < $ped_fin) {
		    case 0:
		        $valorinc = ' (Columna B) NO esta dentro del rango de fechas a Reportar ';
		        break;
		    case 1:
		        $valorinc = '';
		        break;
		}

		

	  ECHO '<div class="alert-danger" style="padding:5px; margin:1px; border-radius:5px;">
                <h6><i class="icon fa fa-warning"></i> Error No Escritura: '.$num_escritura.$escritura.$acto.$enajenante.$adquiriente.$valorescritura.$numform.$valor.$valorinc.'</h6>
             </div>';
	}	

	} // validacion de repetidos		

	}
    //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
    fclose($handle);
    //echo $masivocargado;
    //echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id.'.jsp" />';
    }
    else
    {
    //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
    //ver si esta separado por " , "
    echo $doc_no_tipo;
    }
   
	}
?>



<div class="row">
	<div class="col-md-12">
	  <div class="box">
	    <div class="box-header with-border"><span style="height: "></span>
	      <h4 class="box-title"><b>ENTREGA DE INFORMACION DIAN PERIODO <?php echo $ped_ini.' - '.$ped_fin; ?></b></h4>
	    </div>
	    <div class="box-body">
	    	<div class="col-md-12">
	    	<?php
	    		if ($reporte_estado==0) { ?>
	    		<table class="jona">
	  				<tr>
	  					<td>
	  						<form method='post' enctype="multipart/form-data" name="enviodeinformacionmxdian">
	          					<label>Carga Archivo Plano</label><br>
			              		<input type='file' name='sel_file' size='20'>  
							    <a href="documentos/cm_dian.csv" download=>Descargar archivo de ejemplo.csv</a> &nbsp;  			  
			              		<input type='submit' name='subirmaxivo' value=' Agregar archivo ' class="btn btn-xs btn-success">
			              		<a href="notaria_dian_reporte&<?php echo $id; ?>&0.jsp" style="font-size:10px;color:#ff0000;" class="seguroelimdian">Eliminar todas las Escrituras</a>
						        <!-- <a href="dian&<?php echo $id; ?>&0.jsp" style="font-size:10px;color:#ff0000;" class="seguroelimdian">Eliminar todas las Escrituras</a> -->
					    	</form>
				    	</td>
	  					<td>
		  					<form method='post' name="cerrarreportedian">
		      					<label>Finalizacion del Reporte</label><br>
						        <p> Una vez termina de cargarse la informacion del periodo correspondiente vamos a cerrar el informe presionando (Cerrar).</p>
						        <input type='submit' name='cerrardianreporte' value=' Cerrar ' title="Cerrar de estar seguro de subir la Informacion" class="btn btn-xs btn-danger segurodian">
						    </form>
				    	</td>
	  				</tr>
	  			</table>
	    		<?php } else { echo '<div class="alert-success" style="padding:5px; margin:1px; width:150px;">
						                <h6><i class="fa fa-fw fa-check-circle"></i><b> INFORME  ENTREGADO </b></h6>
						             </div>'; } ?>
	  			
        	</div>

        	<div class="col-md-12"><br><br>
        	  <div class="table-responsive">
        		<table class="table table-striped table-bordered table-hover" id="datos_info_dian">
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
		              $query875 = sprintf("
					  SELECT * FROM notaria_dian_reporte, notaria, notaria_dian WHERE
               notaria_dian_reporte.id_notaria_dian=notaria_dian.id_notaria_dian AND 
				   notaria_dian.id_notaria=notaria.id_notaria and
					  
		              	notaria_dian.id_notaria='$id_notaria' AND 
		              	notaria_dian_reporte.id_notaria_dian='$id' AND
		              	estado_notaria_dian_reporte=1 ");
		              	$select875 = mysql_query($query875, $conexion) or die(mysql_error());
					    while($row_dian = mysql_fetch_array($select875)) {
					?>
		            	<tr>
					       <td><?php echo $row_dian['nombre_notaria'];?></td>
					       <td><?php echo $ped_ini.'/'.$ped_fin;?></td>
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
							  $('#datos_info_dian').DataTable({
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
</div>

<?php
} else{  echo '';  } 

} else {}
?>
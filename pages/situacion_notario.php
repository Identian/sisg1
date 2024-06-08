<?php 
session_start();

if (isset($_POST['option']) && ""!=$_POST['option']) {


	require_once('../conf.php'); 
	require_once('listas.php');
	$posesion_notaria=intval($_POST['option']);



$query_update = "SELECT * FROM posesion_notaria, tipo_nombramiento_n WHERE  tipo_nombramiento_n.id_tipo_nombramiento_n=posesion_notaria.id_tipo_nombramiento_n and id_posesion_notaria = ".$posesion_notaria."";
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_upt = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);



?>

	
<br />
<form action="" method="post" name="form1" id="form1">


  <table align="center">
  
  <tr><td colspan="2"><b>NOMBRAMIENTO</B><br /></td></tr>
  
  
  <tr class="marcador">
        <td nowrap="nowrap">Tipo de nombramiento:
		</td>
		<td>
		
		<?php echo $row_upt['nombre_tipo_nombramiento_n']; ?>
		

		</td>
		</tr>
		
		


	 <tr class="marcador">
      <td nowrap="nowrap" >Forma de ingreso:</td>
      <td>
	  
	  
	  
	  <select class="form-control" name="forma_ingreso">
	  <option value=""></option>
	  <option value="Derecho de preferencia" <?php if ('Derecho de preferencia'==$row_upt['forma_ingreso']) { echo 'selected'; } else {}  ?>>Derecho de preferencia</option>
	  <option value="Aplicación del articulo 144 - decreto 960 / 70" <?php if ('Aplicación del articulo 144 - decreto 960 / 70'==$row_upt['forma_ingreso']) { echo 'selected'; } else {}  ?>>Aplicación del articulo 144 - decreto 960 / 70</option>
	  <option value="Concurso" <?php if ('Concurso'==$row_upt['forma_ingreso']) { echo 'selected'; } else {}  ?>>Concurso</option>
	  <option value="Nombramiento simple" <?php if ('Nombramiento simple'==$row_upt['forma_ingreso']) { echo 'selected'; } else {}  ?>>Nombramiento simple</option>
	   <option value="Desicion judicial" <?php if ('Desicion judicial'==$row_upt['forma_ingreso']) { echo 'selected'; } else {}  ?>>Desición judicial</option>
	  
	    <option value="Confirmacion o ratificacion" <?php if ('Confirmacion o ratificacion'==$row_upt['forma_ingreso']) { echo 'selected'; } else {}  ?>>Confirmación o ratificación</option>
	  
	  
	  
	  
	  </select>
	  </td>
    </tr>
	
	
	
	<tr class="marcador">
	<td nowrap="nowrap" >Fecha de inicio: </td>
	<td>
		<input  class="form-control" type="date" name="fecha_inicio" value="<?php echo limpfecha($row_upt['fecha_inicio']); ?>" style="width:180px;"/>
		</td>
</tr>
 
	  

	<tr><td colspan="2"><hr></td></tr>

 <tr class="marcador">
      <td nowrap="nowrap" >Acto de Nombramiento:</td>
      <td><select class="form-control" name="acto_nombramiento">
	  <option value=""></option>
	  <option value="Decreto" <?php if ('Decreto'==$row_upt['acto_nombramiento']) { echo 'selected'; } else {}  ?>>Decreto</option>
	  <option value="Resolucion" <?php if ('Resolucion'==$row_upt['acto_nombramiento']) { echo 'selected'; } else {}  ?>>Resolucion</option>
	  
	  </select>
	  </td>
    </tr>
    <tr class="marcador">
      <td nowrap="nowrap" >Nùmero de Nombramiento:</td>
      <td><input  class="form-control" type="text" name="numero_nombramiento" value="<?php echo $row_upt['numero_nombramiento']; ?>" class="solonumeros" placeholder="Solo nùmeros"/></td>
    </tr>
    <tr class="marcador">
      <td nowrap="nowrap" >Fecha de Nombramiento:</td>
      <td><input  class="form-control" type="date" name="fecha_nombramiento"  value="<?php echo limpfecha($row_upt['fecha_nombramiento']); ?>" size="32" /></td>
    </tr>
    <tr class="marcador">
      <td nowrap="nowrap" >Nominador:</td>
      <td><select class="form-control" name="nominador">
	  <option value="" ></option>  
	  <option value="Presidencia" <?php if ('Presidencia'==$row_upt['nominador']) { echo 'selected'; } else {}  ?>>Presidencia</option>
	  <option value="Gobernacion" <?php if ('Gobernacion'==$row_upt['nominador']) { echo 'selected'; } else {}  ?>>Gobernacion</option>
	   <option value="Alcaldia" <?php if ('Alcaldia'==$row_upt['nominador']) { echo 'selected'; } else {}  ?>>Alcaldia</option>
	  <option value="Superintendencia" <?php if ('Superintendencia'==$row_upt['nominador']) { echo 'selected'; } else {}  ?>>Superintendencia</option>
	  </select>
	  </td>
    </tr>
	<tr><td colspan="2"><hr></td></tr>
	 <tr class="marcador">
      <td nowrap="nowrap" >Acto de confirmaciòn del cargo:</td>
      <td><select class="form-control" name="acto_confirmacion">
	  <option value=""></option>
	 <option value="Decreto" <?php if ('Decreto'==$row_upt['acto_confirmacion']) { echo 'selected'; } else {}  ?>>Decreto</option>
	  <option value="Resolucion" <?php if ('Resolucion'==$row_upt['acto_confirmacion']) { echo 'selected'; } else {}  ?>>Resolucion</option>
	  </select>
	  </td>
    </tr>
	
    <tr class="marcador">
      <td nowrap="nowrap" >Acto de confirmaciòn - nùmero:</td>
      <td><input  class="form-control" type="text" name="acto_conf_numero" value="<?php echo $row_upt['acto_conf_numero']; ?>" class="solonumeros" placeholder="Solo nùmeros" /></td>
    </tr>
    <tr class="marcador">
      <td nowrap="nowrap" >Fecha del Acto de confirmaciòn:</td>
      <td><input  class="form-control" type="date" name="acto_conf_fecha" value="<?php echo limpfecha($row_upt['acto_conf_fecha']); ?>" size="32" /></td>
    </tr>
    <tr class="marcador">
      <td nowrap="nowrap" >Acto de confirmaciòn - autoridad:</td>
      <td><select class="form-control" type="text" name="acto_conf_autoridad">
	  	  <option value=""></option>
	 <option value="Superintendencia" <?php if ('Superintendencia'==$row_upt['acto_conf_autoridad']) { echo 'selected'; } else {}  ?>>Superintendencia</option>
	  <option value="Gobernacion" <?php if ('Gobernacion'==$row_upt['acto_conf_autoridad']) { echo 'selected'; } else {}  ?>>Gobernacion</option>
	  </select>
	  
	  </td>
    </tr>
	<tr><td colspan="2"><hr></td></tr>
    <tr class="marcador">
      <td nowrap="nowrap" >Acta de posesiòn - nùmero:</td>
      <td><input  class="form-control" type="text" name="acta_pose_numero" value="<?php echo $row_upt['acta_pose_numero']; ?>" class="solonumeros" placeholder="Solo nùmeros" /></td>
    </tr>
    <tr class="marcador">
      <td nowrap="nowrap" >Fecha del Acto de posesiòn:</td>
      <td><input  class="form-control" type="date" name="acto_pose_fecha" value="<?php echo limpfecha($row_upt['acto_pose_fecha']); ?>" size="32"  /></td>
    </tr>
    <tr class="marcador">
      <td nowrap="nowrap" >Fecha de efectos fiscales - Acto de posesiòn:</td>
      <td><input  class="form-control" type="date" name="acto_pose_f_fiscales" value="<?php echo limpfecha($row_upt['acto_pose_f_fiscales']); ?>" size="32" /></td>
    </tr>
	
	
	  <tr class="marcador">
      <td nowrap="nowrap" >Fecha de recibo de la notaria:</td>
      <td><input  class="form-control" type="date" name="fecha_rec_notaria" value="<?php echo limpfecha($row_upt['fecha_rec_notaria']); ?>" size="32"  /></td>
    </tr>
	
	<tr class="marcador">
      <td nowrap="nowrap" >Autoridad de la posesión:</td>
      <td><select class="form-control" name="autoridad_pose">
	  <option value="" ></option>  
	  <option value="Presidencia" <?php if ('Presidencia'==$row_upt['autoridad_pose']) { echo 'selected'; } else {}  ?>>Presidencia</option>
	  <option value="Gobernacion" <?php if ('Gobernacion'==$row_upt['autoridad_pose']) { echo 'selected'; } else {}  ?>>Gobernacion</option>
	   <option value="Alcaldia" <?php if ('Alcaldia'==$row_upt['autoridad_pose']) { echo 'selected'; } else {}  ?>>Alcaldia</option>
	  <option value="Superintendencia" <?php if ('Superintendencia'==$row_upt['autoridad_pose']) { echo 'selected'; } else {}  ?>>Superintendencia</option>
	  </select>
	  </td>
    </tr>
	
	
	
	<tr><td colspan="2"><br /><hr><b> RETIRO</B><br /></td></tr>
	
	
	 <tr class="marcador">
      <td nowrap="nowrap" >Causal de retiro:</td>
      <td><select class="form-control" name="causal_retiro">
	  <option value=""></option>
	  
	  
	  <?php if (isset($row_upt['causal_retiro']) and ""!=$row_upt['causal_retiro']) { echo '<option selected>'.$row_upt['causal_retiro'].'</option>'; } else { echo '';} ?>
	  
	  
	 <OPTION>APLICACIÓN DEL ARTICULO 144 DEL DECRETO 960 DE 1970</OPTION>
  <OPTION>RETIRO FORZOSO POR EDAD</OPTION>
	 <OPTION>RETIRO POR MUERTE.</OPTION>
	  <OPTION>RETIRO POR RENUNCIA.</OPTION>
	  <OPTION>RETIRO POR DESTITUCION DEL CARGO.</OPTION>
	  <OPTION>RETIRO POR DECLARACION DE ABANDONO DE CARGO.</OPTION>
	  <OPTION>RETIRO POR EJERCICIO DEL CARGO NO AUTORIZADO POR LA LEY.</OPTION>
	  <OPTION>RETIRO POR SUPRESION DE LA NOTARIA.</OPTION>
	   <OPTION>RETIRO POR ORDEN JUDICIAL</OPTION>
	  <OPTION>POR DERECHO DE PREFERENCIA.</OPTION>
	 	<OPTION>ENTREGA DE NOTARIA</OPTION>
<option value="OTRO">OTRO</option>
	 
</select>
	  </td>
    </tr>
	

	 <tr class="marcador">
      <td nowrap="nowrap" >Fecha de retiro segun acto admin.:</td>
      <td><input  class="form-control" type="date" name="fecha_retiro" value="<?php echo limpfecha($row_upt['fecha_retiro']); ?>" size="32" /></td>
    </tr>
	


	<tr valign="baseline">
      <td nowrap="nowrap" >Autoridad que emite el acto admin.:</td>
      <td>
	  <select class="form-control" name="autoridad_ret">
	  <option value=""></option>
	    <?php if (isset($row_upt['autoridad_ret']) and ""!=$row_upt['autoridad_ret']) { echo '<option selected>'.$row_upt['autoridad_ret'].'</option>'; } else { echo '';} ?>
	  
	 <option>Ministerio</option>
	  <option>Gobernacion</option>
	   <option>Autoridad Judicial</option>
	 </select>
	  </td>
    </tr>
	
	
	
		
		<tr valign="baseline">
      <td nowrap="nowrap" >Tipo de documento:</td>
      <td>
	  <select class="form-control" name="t_doc_ret">
	  <option value=""></option>
	  
	     <?php if (isset($row_upt['t_doc_ret']) and ""!=$row_upt['t_doc_ret']) { echo '<option selected>'.$row_upt['t_doc_ret'].'</option>'; } else { echo '';} ?>
	  
	 <option>Decreto</option>
	  <option>Resolucion</option>
	   <option>Oficio</option>
	 </select>
	  </td>
    </tr>
	
	
	 <tr class="marcador">
      <td nowrap="nowrap" >Número del documento:</td>
      <td><input  class="form-control" type="text" name="n_doc_ret" value=" <?php echo $row_upt['n_doc_ret']; ?>" size="32" class="solonumeros"/></td>
    </tr>
	
	
	 <tr class="marcador">
      <td nowrap="nowrap" >Fecha del documento:</td>
      <td><input  class="form-control" type="date" name="fecha_doc_ret" value="<?php echo $row_upt['fecha_doc_ret']; ?>" size="32"  /></td>
    </tr>
	
	
	 <tr class="marcador">
      <td nowrap="nowrap" >Número de acta de entrega:</td>
      <td><input  class="form-control" type="text" name="n_acta_entrega" value="<?php echo $row_upt['n_acta_entrega']; ?>" size="32"  class="solonumeros" /></td>
    </tr>
	
	
 <tr class="marcador">	 
        <td nowrap="nowrap" ><b>Fecha de entrega de la notaria</b>: </td><td>
		<input  class="form-control" type="date" name="fecha_fin" value="<?php echo $row_upt['fecha_fin']; ?>" /></td>
		</tr>
		
    <tr>
	
	<input  class="form-control" type="hidden" name="id_posesion_notaria" value="<?php echo $row_upt['id_posesion_notaria']; ?>" >
      <td nowrap="nowrap" >&nbsp;</td>
      <td><br /><br />
	  
	  <button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok">
</span> Actualizar</button>
	  
	  </td>
    </tr>
  </table>
  <input  class="form-control" type="hidden" name="MM_update" value="form1" />
</form>
<?php

} else {}
?>

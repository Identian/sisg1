<?php
$nump169=privilegios(169,$_SESSION['snr']);

if (1==$_SESSION['rol'] or 0<$nump169) { 



if (1==$_SESSION['rol'] && isset($_POST['id_area'])) { 
$id_area=$_POST['id_area'];
} else {
$id_area=$_SESSION['snr_area'];	
}



if (11==$id_area) {
$idoficina=27;		 
} else {
$idoficina=$id_area;
}



$arraydd=array(5, 6, 9, 10, 11, 26, 27);
 
 if (1==$_SESSION['rol'] or in_array($id_area, $arraydd)) {
					 



if (isset($_POST['actualizar_id_plantilla_visita']) && ""!=$_POST['actualizar_id_plantilla_visita'] && 2>$_SESSION['snr_tipo_oficina']) {
	

$updated = sprintf("UPDATE plantilla_visita set nombre_plantilla_visita=%s, orden=%s where id_plantilla_visita=%s and id_area=".$idoficina."",
			GetSQLValueString($_POST['nombre_plantilla_visita'], "text"),
			GetSQLValueString($_POST['orden'], "int"),
		GetSQLValueString($_POST['actualizar_id_plantilla_visita'], "int"));
      $Resultpd = mysql_query($updated, $conexion);
	  echo $actualizado;
	 
} else {}








if ((isset($_POST["soporte_id_plantilla_visita"]) && 2>$_SESSION['snr_tipo_oficina'])) {
	
$insertSQL = sprintf("INSERT INTO soporte_visita (
id_plantilla_visita, nombre_soporte_visita, estado_soporte_visita) 
VALUES (%s, %s, %s)", 
GetSQLValueString($_POST["soporte_id_plantilla_visita"], "int"),
GetSQLValueString($_POST["nombre_soporte_visita"], "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

  echo $insertado;
  

}  else {}

 
 


if ((isset($_POST["nombre_plantilla_visita"]) && 2>$_SESSION['snr_tipo_oficina'])) {
	

$insertSQL = sprintf("INSERT INTO plantilla_visita (
id_area, orden, nombre_plantilla_visita, estado_plantilla_visita) 
VALUES (%s, %s, %s, %s)", 
GetSQLValueString($idoficina, "int"),
GetSQLValueString($_POST["orden"], "int"),
GetSQLValueString($_POST["nombre_plantilla_visita"], "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

  echo $insertado;
   

}  else { }

 
 


?>
 
 

  <div class="row">
  
  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('plantilla_visita'); ?></h3>

              <p>Registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo existencia('soporte_visita'); ?></h3>

              <p>Anexos</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3><?php echo $realdate; ?></h3>
			  
              <p>Fecha</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>195</h3>
              <p>Oficinas de registro</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

      </div>
    
	
	
	

	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  <div class="col-md-12">
<?php  
if (1==$_SESSION['rol'] or 0<$nump169) {
?>
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>

<?php } else { } ?>	

	  </h3>
	  
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Registrado</th>
  <th>Area</th>
 <th>Orden</th>
<th>Nombre</th>
<th>Actualizar</th>
				  <th>Anexos</th>
				  <th>Plantilla</th>
				  		  
</tr>
</thead>
<tbody>
				
<?php 


if (1==$_SESSION['rol']) { 
$query4="SELECT * from plantilla_visita, area where plantilla_visita.id_area=area.id_area and estado_plantilla_visita=1 ORDER BY area.id_area, orden asc"; //LIMIT 500 OFFSET ".$pagina."
} else {
$query4="SELECT * from plantilla_visita, area where plantilla_visita.id_area=area.id_area and area.id_area=".$idoficina." and estado_plantilla_visita=1 ORDER BY area.id_area, orden asc"; //LIMIT 500 OFFSET ".$pagina."
}




$result = $mysqli->query($query4);
while($row = $result->fetch_array()) {
?>  
<tr>
				<?php
$id_res=$row['id_plantilla_visita'];
echo '<td>'.$row['fecha_plantilla_visita'].'</td>';

echo '<td>'.$row['nombre_area'].'</td>';

echo '<td>'.$row['orden'].'</td>';

echo '<td>'.$row['nombre_plantilla_visita'].'</td>';

echo '<td>';
echo ' <a href="" class="buscar_actualizarvisita" id="'.$id_res.'" title="Revisar" data-toggle="modal" data-target="#popupactualizarvisita"> <span class="btn btn-xs btn-info">Actualizar</span></a> <br>';

echo '</td>';

echo '<td>';


echo ' <a href="" class="buscar_soportevisita" id="'.$id_res.'" title="Revisar" data-toggle="modal" data-target="#popupsoportevisita"> <span class="btn btn-xs btn-success">+</span></a> <br>';

$query23 = sprintf("SELECT * FROM soporte_visita where id_plantilla_visita=".$id_res." and estado_soporte_visita=1 order by nombre_soporte_visita asc"); 
$select23 = mysql_query($query23, $conexion);
$row23 = mysql_fetch_assoc($select23);
$totalRows23 = mysql_num_rows($select23);
if (0<$totalRows23){
do {
		echo ''.$row23['nombre_soporte_visita'];
		
	if (1==$_SESSION['rol']) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$row23['id_soporte_visita'].'" name="soporte_visita" id="'.$row23['id_soporte_visita'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
	
		echo '<br>';
	 } while ($row23 = mysql_fetch_assoc($select23)); 
} else {}	 
mysql_free_result($select23);


echo '</td>';



echo '<td>';


echo ' <a href="editor/plantilla&'.$row['id_area'].'&'.$row['id_plantilla_visita'].'.jsp" target="_blank" class="btn btn-xs btn-warning">Actualizar plantilla</a>';

	if (1==$_SESSION['rol'] or 0<$nump169) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_res.'" name="plantilla_visita" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	} else {}
echo '</td>';
?>
      
                  </tr>
                <?php } ?>

				
                </tbody>
          
         </table>
		 
		 
		 <script>
				$(document).ready(function() {
					$('#inforesoluciones').DataTable({
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
						"aaSorting": [[ 2, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php if (3>$_SESSION['snr_tipo_oficina']) { ?>





 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="font-weight: bold; text-align: center;" class="modal-title" id="myModalLabel">NUEVO</h4>
      </div>
      <div class="modal-body">
        
<form action="" method="POST" name="for54354r65345345464324324563m1" enctype="multipart/form-data" >


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Area:</label> 

<?php
if (1==$_SESSION['rol']) { 
?>

 <select class="form-control" name="id_area" >
			  <option></option>
			  	<?php
$select = mysql_query("select * from area where id_area in (5, 6, 9, 10, 11, 26, 27)  order by nombre_area ", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_area'].'" ';
	echo '>'.$row['nombre_area'].'</option>';

	 } while ($row = mysql_fetch_assoc($select)); 

} else {}	 
mysql_free_result($select);
			?>
			  </select>
<?php } else { ?>
 <input type="text" readonly class="form-control" name="ofi" value="<?php echo quees('area',$idoficina); ?>">

<?php } ?>
			  
			  
</div>




<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Nombre de la sección:</label>
              <input type="text" class="form-control" name="nombre_plantilla_visita" value="">
            </div>

 <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Orden:</label>
              <select class="form-control" name="orden" >
			  <option></option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			   <option>6</option>
			    <option>7</option>
				 <option>8</option>
				  <option>9</option>
				   <option>10</option>
				    <option>11</option>
					 <option>12</option>
					  <option>13</option>
					   <option>14</option>
					    <option>15</option>
			   <option>16</option>
			    <option>17</option>
				 <option>18</option>
				  <option>19</option>
				   <option>20</option>
			  <option>21</option>
			  <option>22</option>
			  <option>23</option>
			  <option>24</option>
			  <option>25</option>
			   <option>26</option>
			    <option>27</option>
				 <option>28</option>
				  <option>29</option>
				   <option>30</option>
			  <option>31</option>
			  <option>32</option>
			  <option>33</option>
			  <option>34</option>
			  <option>35</option>
			   <option>36</option>
			    <option>37</option>
				 <option>38</option>
				  <option>39</option>
				   <option>40</option>
			  <option>41</option>
			  <option>42</option>
			  <option>43</option>
			  <option>44</option>
			  <option>45</option>
			   <option>46</option>
			    <option>47</option>
				 <option>48</option>
				  <option>49</option>
				   <option>50</option>
			  </select>
            </div>
			



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="instruccion_admin">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>















<div class="modal fade" id="popupactualizarvisita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar</b></h4>
</div> 
<div id="ver_actualizarvisita" class="modal-body"> 

</div>
</div> 
</div> 
</div>





<div class="modal fade" id="popupsoportevisita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Documentos, anexos, fichas de la sección</b></h4>
</div> 
<div id="ver_soportevisita" class="modal-body"> 

</div>
</div> 
</div> 
</div>





<?php } else { }
} else {}
} else {} ?>




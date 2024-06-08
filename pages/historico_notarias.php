<?php 
$nump5=privilegios(5,$_SESSION['snr']);
if (1==$_SESSION['rol'] OR 0< $nump5) {
	$id=$_GET['i'];
	?>
	
	
	
	
	
  <?php
 IF (1==$_SESSION['rol'] or 0<$nump5) { 	
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
			
			 <li><a href="notaria&<?php echo $id; ?>.jsp"><b> 	 
     <?php echo quees('notaria', $id);?>
		  </b></a></li>
           
   <?php if (1==$_SESSION['rol']) { ?> 
<li><a href="privilegios_notariado&<?php echo $id; ?>.jsp">Acceso a módulos</a></li>
 <?php } else {} ?>
			   
 <li><a href="sucesion<?php if (1==$_SESSION['rol'] or 0<$nump18) { echo '&'.$id; } else {} ?>.jsp">Liq. Herencia</a></li>	  
<li><a href="salida_menor<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Salida de menores</a></li>
 <li><a href="notaria_datos_facturacion<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp">Facturación</a></li>
<li><a href="personal_notaria<?php if (1==$_SESSION['rol']) { echo '&'.$id; } else {} ?>.jsp" title="">Personal</a></li>
    

<?php if (1==$_SESSION['rol'] or 0<$nump5) { ?> 
 <li><a href="historico_notarias&<?php echo $id; ?>.jsp" title="Consulta historica">Historial</a></li>
<?php } else { } 
 if (1==$_SESSION['rol'] or 0<$nump97) { ?> 
<li><a href="digitalizacion_notarial&<?php echo $id; ?>.jsp" title="Digitalización">Digitalización</a></li>
<?php } else { } ?> 
  
  
  <?php if (1==$_SESSION['rol']) { ?> 
<li><a href="apostilla&<?php echo $id; ?>.jsp" title="Apostilla">Apostilla</a></li>
<li><a href="local_notaria&<?php echo $id; ?>.jsp" title="">Local</a></li>	  	
<?php } else {} ?>

            </ul>
          </div>
		 
      </div>
    </nav>
  </div>
</div>
	  <?php } else {}  ?>
	  
	 
	 
	 
	
	
	
	
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  
  
  
  
  
	  
  
  
  
  <div class="col-md-12">
 
 
 

	  </div>
	  
	
  
</div> 

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
<th>conc_descripcion</th>
<th>conc_tipo</th>
<th>pers_documento</th>
<th>nombre</th>
<th>nota_nombre</th>
<th>nota_categoria</th>
<th>depe_nombre</th>
<th>ciud_nombre</th>
<th>nomb_tipo</th>
<th>nomb_actaposecion</th>
<th>nomb_fechaposecion</th>
<th>nomb_posecionadoante</th>
<th>nomb_fechacierre</th>
<th>acad_numero</th>
<th>acad_fecha</th>
<th>acad_observacion</th>
<th>cino_nombre</th>
	  
</tr>
</thead>
<tbody>
				
<?php 

$query4="SELECT a.conc_descripcion, a.conc_tipo, a.pers_documento, 
CONCAT (a.pers_nombres,' ',a.pers_primerapellido,' ',a.pers_segundoapellido) AS nombre, 
a.nota_nombre, a.nota_categoria, a.depe_nombre, a.ciud_nombre, a.nomb_tipo, a.nomb_actaposecion,
a.nomb_fechaposecion, a.nomb_posecionadoante, a.nomb_fechacierre, a.acad_numero, a.acad_fecha, a.acad_observacion, a.cino_nombre
FROM pamplonacons a WHERE a.id_notaria = ".$id."";

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
echo '<td>'.$row['conc_descripcion'].'</td>';
echo '<td>'.$row['conc_tipo'].'</td>';
echo '<td>'.$row['pers_documento'].'</td>';
echo '<td>'.$row['nombre'].'</td>';
echo '<td>'.$row['nota_nombre'].'</td>';
echo '<td>'.$row['nota_categoria'].'</td>';
echo '<td>'.$row['depe_nombre'].'</td>';
echo '<td>'.$row['ciud_nombre'].'</td>';
echo '<td>'.$row['nomb_tipo'].'</td>';
echo '<td>'.$row['nomb_actaposecion'].'</td>';
echo '<td>'.$row['nomb_fechaposecion'].'</td>';
echo '<td>'.$row['nomb_posecionadoante'].'</td>';
echo '<td>'.$row['nomb_fechacierre'].'</td>';
echo '<td>'.$row['acad_numero'].'</td>';
echo '<td>'.$row['acad_fecha'].'</td>';
echo '<td>'.$row['acad_observacion'].'</td>';
echo '<td>'.$row['cino_nombre'].'</td>';

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
						"aaSorting": [[ 0, "asc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php  
} else { }
	
	////////////////////////////////////////////////////////////////////
if (99==$_SESSION['rol'] ) {


if ((isset($_POST["cedula_funcionario"])) && (""!=$_POST["cedula_funcionario"] && 1==$_SESSION['rol'])) { 

$correo_fu=$_POST["correo_funcionario"];
$ced_fu=$_POST["cedula_funcionario"];
$selecty = mysql_query("select id_funcionario from funcionario where cedula_funcionario='$ced_fu'", $conexion) or die(mysql_error());
$rowy = mysql_fetch_assoc($selecty);
$totalRowsy = mysql_num_rows($selecty);
if (0<$totalRowsy){
echo $repetido;
	} else {

	
	
$codigonotaria=$_POST["codigonotaria"];
$selectyn = mysql_query("select id_notaria from notaria where codigo_dane='$codigonotaria'", $conexion);
$rowyn = mysql_fetch_assoc($selectyn);
$totalRowsyn = mysql_num_rows($selectyn);
if (0<$totalRowsyn) {
	$id_notaria=$rowyn['id_notaria'];
} else {
	$id_notaria='';
}
	
	
	
$insertSQL = sprintf("INSERT INTO funcionario (cedula_funcionario, nombre_funcionario, correo_funcionario, clave_funcionario, id_notaria_f, alias_iduca, id_rol, id_grupo_area, id_tipo_oficina, id_cargo, foto_funcionario, lider_pqrs, estado_funcionario) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString(trim($_POST["cedula_funcionario"]), "text"), 
GetSQLValueString($_POST["nombre_funcionario"], "text"), 
GetSQLValueString(trim($_POST["correo_funcionario"]), "text"), 
GetSQLValueString(md5('12345'), "text"), 
GetSQLValueString($id_notaria, "text"), 
GetSQLValueString($_POST["login"], "text"), 
GetSQLValueString(3, "int"), 
GetSQLValueString(301, "int"), 
GetSQLValueString(3, "int"),
GetSQLValueString($_POST["id_cargo"], "int"), 
GetSQLValueString('avatar.png', "text"),
GetSQLValueString(0, "int"),
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
}
} else {}


$id=$_GET['i'];

$query_update = sprintf("SELECT * FROM notaria WHERE notaria.id_notaria = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	$dep=$row_update['id_departamento'];
$mun=$row_update['codigo_municipio'];
$not=$row_update['codigo_notaria'];



	?>

	<div class="row">
<div class="col-md-12">
	<div class="box box-info">
 <div class="box-header with-border">
                  <h3 class="box-title">Historia de Notaria:  <?php echo $row_update['nombre_notaria']; ?></h3>
<br><br>
                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
				  
				  <script>
 // Write on keyup event of keyword input element
 $(document).ready(function(){
 $("#search").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#mytable tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });
});
</script>
<div class="input-group-btn">
<input type="text" id="search" name="buscar" placeholder="Buscar" class="form-control" required >
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
</div>

                </div>

            <div class="box-body">

			<div  class="modal-body">
			
			
			

<table  class="table" id="mytable" >
<thead>
<tr align="center" valign="middle">

<th>Encargado</th>
<th>Cedula</th>
<th>Act Admin</th>
<th style="min-width:110px;">Fecha Act</th>
<th>Observacion</th>
<th>Expedido</th>
<th>Posesion</th>
<th style="min-width:110px;">Fecha P.</th>
<th>Posesiondante</th>
<th>Fecha Cierre</th>
<th>Fecha cambio</th>
<th style="min-width:50px;"></th>

</tr></thead><tbody>		
<?php

mysql_free_result($update);

error_reporting(0);
$json = file_get_contents('http://192.168.210.130:8080/datos_pamplona/'.$dep.'&'.$mun.'&'.$not.'.json');
//$json = file_get_contents('https://sisg.supernotariado.gov.co/api/usuarios_vur/');
$obj = json_decode($json);
foreach ($obj as $character) {
	echo '<tr>';
	
	echo '<td>';
	echo $character->PERS_NOMBRES;
	echo ' ';
	echo $character->PERS_PRIMERAPELLIDO;
	echo ' ';
	echo $character->PERS_SEGUNDOAPELLIDO;
	echo '</td>';
echo '<td>';
	echo $character->PERS_DOCUMENTO;
	echo '</td>';
echo '<td>';
	echo $character->ACAD_NUMERO;
	echo '</td>';
	echo '<td>';
	echo $character->ACAD_FECHA;
	echo '</td>';
	echo '<td>';
	echo $character->ACAD_OBSERVACION;
	echo '</td>';
	echo '<td>';
	echo $character->NOMB_EXPEDIDOPOR;
	echo '</td>';
	echo '<td>';
	echo $character->NOMB_ACTAPOSECION;
	echo '</td>';
	echo '<td>';
	echo $character->NOMB_FECHAPOSECION;
	echo '</td>';
	echo '<td>';
	echo $character->NOMB_POSECIONADOANTE;
	echo '</td>';
	echo '<td>';
	echo $character->NOMB_FECHACIERRE;
	echo '</td>';
	echo '<td>';
	echo $character->ACAD_FECHACAMBIO;
	echo '</td>';
	echo '<td>';
echo '';
	echo '</td>';
	
	echo '</tr>';
}


?>
	
		</tbody></table>
	
		</div>
	</div>
	</div>
	</div>
		</div>

	
	<?php
} else {}
 } else {} ?>

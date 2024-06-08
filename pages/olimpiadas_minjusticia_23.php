<?php
$nump111=privilegios(111,$_SESSION['snr']);



$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-06-27 08:00:00");
$fecha_limite = strtotime("2023-06-30 17:00:00");

if (837>$todaolimpiada23) {



if (isset($_GET['i'])) { 
$idorip=$_GET['i'];
 } else {
$idorip=0;  
 } 
 
 
$arrayorips=array(10,11,12);
if (3>$_SESSION['snr_tipo_oficina'] && (1==$_SESSION['snr_tipo_oficina'] or in_array($_SESSION['id_oficina_registro'], $arrayorips))) { 


function disciplina($disciplina) {
global $mysqli;
$query4png = sprintf("SELECT count(id_olimpiadaminj23) as contador FROM olimpiadaminj23 where nombre_olimpiadaminj23='$disciplina' and estado_olimpiadaminj23=1"); 
$result4png = $mysqli->query($query4png);
$row4png = $result4png->fetch_array();
$respng=$row4png['contador'];
return $respng;
$result4png->free();
}



function cantidad($funza) {
global $mysqli;
$query4png = sprintf("SELECT count(id_olimpiadaminj23) as contadora FROM olimpiadaminj23 where id_funcionario=".$funza." and estado_olimpiadaminj23=1"); 
$result4png = $mysqli->query($query4png);
$row4png = $result4png->fetch_array();
$respng=$row4png['contadora'];
return $respng;
$result4png->free();
}




if (((isset($_POST["nombre_olimpiada23"])) && (""!=$_POST["nombre_olimpiada23"]) && 
(3>$_SESSION['snr_tipo_oficina'])) && ($fecha_limite>=$fecha_actual)) {
	
	

$funcionarioedl=$_SESSION['snr']; //$_POST["id_funcionario"];


$reglag2=disciplina($_POST["nombre_olimpiada23"]);
$nombre_olimpiada23=$_POST["nombre_olimpiada23"];


if ('Futbol 5 Masculino'==$_POST["nombre_olimpiada23"] &&  20>$reglag2) {
$varc=1;  } 
else if ('Futbol 5 Femenino'==$_POST["nombre_olimpiada23"] && 20>$reglag2) { 
$varc=1; }
else if ('Baloncesto Femenino'==$_POST["nombre_olimpiada23"] && 12>$reglag2) { 
$varc=1; }
else if ('Baloncesto Masculino'==$_POST["nombre_olimpiada23"] && 12>$reglag2) { 
$varc=1;  }
else if ('Voleibol Mixto'==$_POST["nombre_olimpiada23"] && 24>$reglag2) { 
$varc=1; }
else if ('Bolirana'==$_POST["nombre_olimpiada23"] && 24>$reglag2) { 
$varc=1; }
else if ('Bolos Mixto'==$_POST["nombre_olimpiada23"] && 16>$reglag2) { 
$varc=1; }
else if ('Mini tejo'==$_POST["nombre_olimpiada23"] && 16>$reglag2) { 
$varc=1;  }
else if ('Atletismo femenino (18-39 años)'==$_POST["nombre_olimpiada23"] && 2>$reglag2) { 
$varc=1; }
else if ('Atletismo femenino (40 años en adelante)'==$_POST["nombre_olimpiada23"] && 2>$reglag2) { 
$varc=1; }
else if ('Atletismo masculino (18-39 años)'==$_POST["nombre_olimpiada23"] && 2>$reglag2) { 
$varc=1; }
else if ('Atletismo masculino (40 años en adelante)'==$_POST["nombre_olimpiada23"] && 2>$reglag2) { 
$varc=1; }
else if ('Tenis de Mesa masculino'==$_POST["nombre_olimpiada23"] && 4>$reglag2) { 
$varc=1; }
else if ('Tenis de campo femenino'==$_POST["nombre_olimpiada23"] && 4>$reglag2) { 
$varc=1; }
else if ('Tenis de campo masculino'==$_POST["nombre_olimpiada23"] && 2>$reglag2) { 
$varc=1; }
else if ('Billar 3 bandas Masculino'==$_POST["nombre_olimpiada23"] && 5>$reglag2) { 
$varc=1; }
else if ('Billar libre femenino'==$_POST["nombre_olimpiada23"] && 5>$reglag2) { 
$varc=1; }
else if ('Natación Masculino'==$_POST["nombre_olimpiada23"] && 4>$reglag2) { 
$varc=1; }
else if ('Natación Femenino'==$_POST["nombre_olimpiada23"] && 4>$reglag2) { 
$varc=1;  }
else if ('Ajedrez'==$_POST["nombre_olimpiada23"] && 6>$reglag2) { 
$varc=1; }
else if ('Parques Mixto'==$_POST["nombre_olimpiada23"] && 6>$reglag2) { 
$varc=1; 

} else { $varc=0;  } 



if (2>cantidad($_SESSION['snr'])) {
if (1==$varc) {

$insertSQL = sprintf("INSERT INTO olimpiadaminj23 (
nombre_olimpiadaminj23, id_funcionario, 
fecha_olimpiadaminj23, estado_olimpiadaminj23) 
VALUES (%s, %s, now(), %s)", 
GetSQLValueString($_POST["nombre_olimpiada23"], "text"), 
GetSQLValueString($funcionarioedl, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);




echo '<script type="text/javascript">swal(" OK !", " Enviado Correctamente  !", "success");</script>';


$emailur2=$_SESSION['snr_correo'];
$subject = 'CONFIRMACIÓN DE INSCRIPCIÓN A OLIMPIADAS MINISTERIO DE JUSTICIA 2023';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que se ha registrado correctamente la inscripción a las olimpiadas de Ministerio de Justicia 2023.<br><br>';

$cuerpo2 .= $corre."<br><br>"; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);



}
 else { 
echo '<script type="text/javascript">swal(" ERROR !", " El cupo ya esta completo, por favor leer la descripción de la inscripción. !", "error");</script>';
 }

}
 else { 
echo '<script type="text/javascript">swal(" ERROR !", " El máximo 2 inscripciones por persona. !", "error");</script>';
 }

 
}
 else { }
 


?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php  echo existencia('olimpiadaminj23');   ?></h3>

              <p>Registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
	
            <a href="#" data-toggle="modal" data-target="#popupequipos" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>23</h3>

              <p>Disciplinas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" data-toggle="modal" data-target="#popupactualizarolimpiada232" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             
 <h3>20<?php echo $anoactual; ?></h3>
			  
              <p>Año</p>
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
 
  

  
   <h3  class="box-title">
<?php 


if ($fecha_limite>=$fecha_actual) {

// if (1==$_SESSION['rol'] or 0<$nump111 or 1==1) {   //
 //if (1==$_SESSION['rol']) {
	 
	 $arrayorips=array(10,11,12);
if (3>$_SESSION['snr_tipo_oficina'] && (1==$_SESSION['snr_tipo_oficina'] or in_array($_SESSION['id_oficina_registro'], $arrayorips))) { 


 ?>
  
   
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>  Olimpiadas del Ministerio de Justicia 2023   
	  <a href="files/portal/intranet/portal-olimpiadas_min_justicia_23.pdf" target="_blank">Descripción</a>
	  
	  
	 <?php 
 } else { echo ''; } 
	

	 } else { echo ''; } 
	 //} else { } 
 ?>
	  </h3>
	  

	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Inscripción</th>
		<th>Funcionario</th>
		<th>Correo</th>
		<th>Celular</th>
		<th>Cedula</th>
		<th>Disciplina</th>
			<th>Oficina</th>
<th>Oficina</th>			
				   
							   
<th style="width:45px;"></th>		  
</tr>
</thead>
<tbody>
				
<?php 
if (1==$_SESSION['rol'] or 0<$nump111) {
$query4="SELECT * from olimpiadaminj23, funcionario where olimpiadaminj23.id_funcionario=funcionario.id_funcionario and estado_olimpiadaminj23=1 ORDER BY id_olimpiadaminj23 desc  "; 

} else {
$query4="SELECT * from olimpiadaminj23, funcionario where olimpiadaminj23.id_funcionario=funcionario.id_funcionario and estado_olimpiadaminj23=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_olimpiadaminj23 desc  "; 

}





$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_olimpiadaminj23'];
echo '<td>'.$row['fecha_olimpiadaminj23'].'</td>';
echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';

echo '<td>';
echo $row['correo_funcionario'];
echo '</td>';
echo '<td>';
echo $row['celular_funcionario'];
echo '</td>';

echo '<td>';
echo $row['cedula_funcionario'];
echo '</td>';

echo '<td>'.$row['nombre_olimpiadaminj23'].'</td>';


if (1 == $row['id_tipo_oficina']) {
                      echo '<td>Nivel central</td>';
                      echo '<td>' . quees('grupo_area', $row['id_grupo_area']) . '</td>';
                    } else {
                      echo '<td>Orip</td>';
                      echo '<td>' . quees('oficina_registro', $row['id_oficina_registro']) . '</td>';
                    }
					

echo '<td>';
	if (1==$_SESSION['rol'] or 0<$nump111 ) { //or 0<$nump111
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar '.$id_res.'" name="olimpiadaminj23" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

//echo ' <a href="" class="buscarolimpiada23" id="'.$id_res.'" title="Actualizar" data-toggle="modal" data-target="#popupactualizarolimpiada23"> <i class="fa fa-edit"></i></a> ';




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
						"aaSorting": [[ 0, "desc"]]
					});
				});
				
										
			
		
				
			</script>	
			

		 
		 		
		 
		 
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->

</div> <!-- FINAL PRIMARY -->
</div> <!-- FINAL DE COL MD 12 -->
</div><!-- FINAL DE ROW -->


<?php 
	if (1==1) { ?>





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
        
<form action="" method="POST" name="for54354r653454345345464324324563m1" enctype="multipart/form-data" >


 
 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>






<div class="form-group text-left"> 
<label  class="control-label">
<span style="color:#ff0000;">*</span> Seleccione la disciplina deportiva en la cual usted va a representar:</label> 
<select class="form-control" name="nombre_olimpiada23"  required>
<option value="" selected></option>
<optgroup label="Disciplinas en equipo">
<option title="4 Equipos con 5 jugadores">Futbol 5 Masculino</option> 
<option title="4 Equipos con 5 jugadores">Futbol 5 Femenino</option> 
<option title="4 Equipos con 5 jugadores">Baloncesto Femenino</option> 
<option title="4 Equipos con 5 jugadores">Baloncesto Masculino</option> 
<option title="4 Equipos con 5 jugadores, minimo 2 mujeres">Bolos Mixto</option>
<option title="2 Equipos con 12 jugadores/as, minimo 3 mujeres">Voleibol Mixto</option> 
<option title="4 Equipos con 5 jugadores">Tejo Masculino</option>
<option title="4 Equipos con 5 jugadores, minimo 2 mujeres">Minitejo</option>
<option title="6 Equipos con 5 jugadores, minimo 2 mujeres">Bolirana</option>
</optgroup>
 <optgroup label="Disciplinas individuales">
<option>Parques Mixto</option> 
<option>Atletismo femenino (18-39 años)</option> 
<option>Atletismo femenino (40 años en adelante)</option> 
<option>Atletismo masculino (18-39 años)</option> 
<option>Atletismo masculino (40 años en adelante)</option> 
<option>Tenis de Mesa masculino</option>  
<option>Tenis de Mesa femenino</option> 
<option>Tenis de campo masculino</option>  
<option>Tenis de campo femenino</option> 
<option>Billar 3 bandas Masculino</option>  
<option>Billar libre femenino</option> 
<option>Natación Masculino</option> 
<option>Natación Femenino</option> 
<option>Ajedrez</option> 
</optgroup>
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





<div class="modal fade" id="popupactualizarolimpiada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Disciplinas</b></h4>
</div> 
<div id="ver_actualizarolimpiada" class="modal-body"> 
<?php
$query3 = sprintf("SELECT nombre_olimpiada23, COUNT( * ) Total
FROM olimpiada23 where estado_olimpiada23=1 
GROUP BY nombre_olimpiada23
HAVING COUNT( * ) >0"); 
$select3 = mysql_query($query3, $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
do {
	echo '<li>';
	if ('1'==$row3['nombre_olimpiada23']) {
		echo 'Sin equipo: ';
	} else {
	echo $row3['nombre_olimpiada23'].': ';
	}
echo ''.$row3['Total'].'</li>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
} else {}	 
mysql_free_result($select3);

?>
</div>
</div> 
</div> 
</div>



<div class="modal fade" id="popupactualizarolimpiada2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Equipos</b></h4>
</div> 
<div id="ver_actualizarolimpiada2" class="modal-body"> 
<?php
$query3 = sprintf("SELECT equipo, COUNT( * ) Total2
FROM olimpiada23 where equipo is not null and estado_olimpiada23=1 
GROUP BY equipo
HAVING COUNT( * ) >0"); 
$select3 = mysql_query($query3, $conexion);
$row3 = mysql_fetch_assoc($select3);
$totalRows3 = mysql_num_rows($select3);
if (0<$totalRows3){
do {
	echo '<li>';
	if ('1'==$row3['equipo']) {
		echo 'No tiene equipo: ';
	} else {
	echo $row3['equipo'].': ';
	}
echo ''.$row3['Total2'].'</li>';
	 } while ($row3 = mysql_fetch_assoc($select3)); 
} else {}	 
mysql_free_result($select3);

?>
</div>
</div> 
</div> 
</div>

	  






<?php } else { }

	 

} else {
	echo 'No tiene acceso, solo para servidores públicos de Bogotá.';
} 


} else {
	echo 'No disponible.<br>';
	echo date('Y-m-d H:i');
}

?>




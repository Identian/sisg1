<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {
	
	$info=explode("---", $_POST['option']);
	
$id=intval($info[0]);
$estadoedl=intval($info[1]);



require_once('../conf.php'); 
session_start();
?>
 
<div style="padding: 10px 10px 10px 10px">


<?php if (1==1) { 

$id_eval_funcionario_edl=$id;
?>


                       <label  class="control-label">Cargar evidencias:</label>   
                       
					   <form action="" method="post" name="forfdsfm5435asdf3245fhgdh345122" enctype="multipart/form-data">

<table><tr><td>
<select name="evi" required style="width:300px;">
<option></option>
<?php
 $query62 = sprintf("SELECT a.id_metas_funcionario_edl, 
			    a.id_eval_funcionario_edl, b.nombre_metas_edl, a.id_metas_edl,  a.evaluacionf, 
				a.compromiso_laboral, a.peso_porcentual, IFNULL(a.eval_porcentual,0) eval_porcentual  
	            FROM metas_funcionario_edl a  
				LEFT JOIN metas_edl b 
				ON a.id_metas_edl = b.id_metas_edl 
                WHERE a.id_eval_funcionario_edl = '$id_eval_funcionario_edl'  
				AND a.estado_metas_funcionario_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion);
			  while ($row62 = mysql_fetch_assoc($select62)) {	
echo '<option>'. $row62['compromiso_laboral'].'</option>';
 } 
 mysql_free_result($select62);
 ?> 
	   </select>
</td><td>
<input type="file" name="file" class="form-control"  required>
<input type="hidden" name="edlidenti" value="<?php echo $id; ?>"  required>
</td><td>
<button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adjuntar documento </button>
</td></tr></table>
</form>

				 
				
				<hr>
<?php } else {} ?>


<div class="form-group text-left"> 
<label  class="control-label">COMPROMISOS LABORALES:</label> 
<br>
<?php
$arrayedlnota=array();
$array1 = array();	
$query62 = sprintf("SELECT a.id_metas_funcionario_edl, 
			    a.id_eval_funcionario_edl, b.nombre_metas_edl, a.id_metas_edl,  a.evaluacionf, 
				a.compromiso_laboral, a.peso_porcentual, IFNULL(a.eval_porcentual,0) eval_porcentual  
	            FROM metas_funcionario_edl a  
				LEFT JOIN metas_edl b 
				ON a.id_metas_edl = b.id_metas_edl 
                WHERE a.id_eval_funcionario_edl = '$id'  
				AND a.estado_metas_funcionario_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion);
				
				$totalcompromisos = mysql_num_rows($select62);
				
			  while ($row62 = mysql_fetch_assoc($select62)) {	
$compromiso=$row62['id_metas_funcionario_edl'];			  
  
  
  array_push($arrayedlnota, $row62['peso_porcentual']);
  
  
  
  echo '<span style="color:#B40404;">'.$row62['peso_porcentual'].'% </span><b>'.$row62['nombre_metas_edl'].':</b> '.$row62['compromiso_laboral'].'<br>'; 
  
				
$query235 = "SELECT * FROM nota_eval_edl, funcionario WHERE nota_eval_edl.id_funcionario=funcionario.id_funcionario 
and estado_nota_eval_edl = 1 and tipo_c=1 and id_metas_funcionario_edl=".$compromiso." order by id_nota_eval_edl";
$result235 = mysql_query($query235);	 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){

while ($row235 = @mysql_fetch_assoc($result235)){
                echo '<span title="'.$row235['id_nota_eval_edl'].' - '.$row235['fecha_nota_eval_edl'].'">
				'.$row235['nombre_funcionario'].': <b>';
				echo $row235['nombre_nota_eval_edl'].'</b></span> ';
				

$notttt=$row235['nombre_nota_eval_edl']*($row62['peso_porcentual']/100);					
array_push($array1, $notttt);
				
	//  if (2319==$id_funcionario_jefe_area) {
			//			 echo '';  
			//		   }   else {
					
				if (isset($row235['estado_nota'])) {
	

	
			if (1==$row235['estado_nota']) {
					echo '<span class="fa fa-check"  style="color:#008d4c;">Aprobado</span> '; 
				} else {
	echo '<span class="fa fa-close" style="color:#b40404;">Rechazado</span> '; 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="nota_eval_edl" id="'.$row235['id_nota_eval_edl'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	
				} 
		
			
		
				} else {

echo '<span  style="color:#ccc;">Pendiente</span> '; 

				} 
				
			//	}
				
                echo '<br>'; 
             } 
	 		 
 } else { } 
mysql_free_result($result235);
  





 } 
		


		if (0<$totalRows){
		$cuentac=count($array1);
		$tramitec=intval(array_sum($array1));
		
		$infottc=$tramitec*0.8;
echo '<center>Promedio: '.$tramitec.' / Resultado de compromisos: '.$infottc.'</center>';
			} else {}
			
		
		
		  ?> 

</div>
<hr>

<?php

$queryb = sprintf("SELECT * FROM evidencias_edl where id_eval_funcionario_edl=".$id_eval_funcionario_edl." and estado_evidencias_edl=1 order by id_evidencias_edl"); 
$selectb = mysql_query($queryb, $conexion);
$rowb = mysql_fetch_assoc($selectb);
$totalRowsb = mysql_num_rows($selectb);
if (0<$totalRowsb){
	echo '<b>Evidencias:</b><ol>';
do {
	$idedla=$rowb['id_evidencias_edl'];
	echo '<li title="'.$rowb['fecha_evidencia'].'"><a href="filesnr/evidenciaedl/'.$rowb['url'].'" target="_blank">'.$rowb['nombre_evidencias_edl'].'</a>';
echo '</li>';
	 } while ($rowb = mysql_fetch_assoc($selectb)); 
	 echo '</ol>';
} else {}	 
mysql_free_result($selectb);
			?>
<hr>
<div class="form-group text-left"> 
<label  class="control-label">COMPETENCIAS COMPORTAMENTALES :</label> 
<br><br>
<?php

$array0 = array();	
               $query62 = sprintf("SELECT a.id_competencia_funcionario_edl, 
			    a.id_eval_funcionario_edl, a.id_competencias_edl, a.evaluacionfc, 
				a.id_niveles_desarrollo_edl, a.valor_niveldesa, descrip_cualitativa,
				b.nombre_competencias_edl, b.definicion_edl, b.conducta_asociada,
				c.nombre_niveles_desarrollo_edl 
	            FROM competencia_funcionario_edl a
				LEFT JOIN competencias_edl b
				ON a.id_competencias_edl = b.id_competencias_edl
				LEFT JOIN niveles_desarrollo_edl c
				ON a.id_niveles_desarrollo_edl = c.id_niveles_desarrollo_edl
                WHERE a.id_eval_funcionario_edl = '$id'  
				AND a.estado_competencia_funcionario_edl = 1 "); 
                $select62 = mysql_query($query62, $conexion);
			  while ($row62 = mysql_fetch_assoc($select62)) {

$idcompetencia= $row62['id_competencia_funcionario_edl']; 
				  
echo '<b title="'.$idcompetencia.'">'.$row62['nombre_competencias_edl'].'</b>: 
<i>'.$row62['definicion_edl'].'</i>, '.$row62['conducta_asociada'].' <br> '; 




$query235 = "SELECT * FROM nota_eval_edl, funcionario WHERE nota_eval_edl.id_funcionario=funcionario.id_funcionario 
and estado_nota_eval_edl = 1 and tipo_c=2 and id_competencia_funcionario_edl=".$idcompetencia." order by id_nota_eval_edl";
$result235 = mysql_query($query235, $conexion);	
$row235 = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){
do {
	
//while ($row235 = @mysql_fetch_assoc($result235)){
                echo '<span title="'.$row235['id_nota_eval_edl'].' - '.$row235['fecha_nota_eval_edl'].'">'.$row235['nombre_funcionario'].': <b>';
				$notacompe=$row235['nota_competencia'];
				echo $notacompe.'</b></span> / ';
		

				if ('Muy alto'==$row235['nota_competencia']) {
				array_push($array0, 100);
                } else {  }
				
			    if ('Alto'==$row235['nota_competencia']) {
				array_push($array0, 80); 
					} else {   }
				
				 if ('Aceptable'==$row235['nota_competencia']) {
				array_push($array0, 60); 
					} else {  }
				
				if ('Bajo'==$row235['nota_competencia']) {
				array_push($array0, 40); 
					 } else {   }				
						
		
				
				if (isset($row235['estado_nota'])) { 
				
				
				
				if (1==$row235['estado_nota']) {
					echo '<span class="fa fa-check"  style="color:#008d4c;">Aprobado</span> '; 
				} else {
					echo '<span class="fa fa-close" style="color:#b40404;">Rechazado</span> '; 
	echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="nota_eval_edl" id="'.$row235['id_nota_eval_edl'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
	
				} 
				
				
				
				
				
				}  else {
echo '<span class="fa fa-file" style="color:#ccc;">Pendiente</span> '; 

					}
                echo '<br>'; 
            // }
 } while ($row235 = mysql_fetch_assoc($result235)); 			
	 		 
 } else { }   
 mysql_free_result($result235);
 
 

 }

mysql_free_result($select62);

		  ?> 
		  

</div>


<?php 
if (0<$totalRows){
		$cuenta=count($array0);
		$tramite=intval(array_sum($array0));
		$infoff=$tramite/$cuenta;
		$infott=$infoff*0.2;
echo '<center>Resultado de competencias: '.$infott.'<br>';
$res=$infott+$infottc;
echo '<b>Nota definitiva: '.$res.'<br>';

if (95<=$res) {
	echo 'Sobresaliente';
} else {

	if (85<=$res && 95>$res) {
	echo 'Destacado';
	
	} else {
		
		if (70<=$res && 85>$res) {
	echo 'Satisfactorio';
	
	} else {
		echo 'No satisfactorio';
	}
	}
}


	

echo '</b></center>';

		} else {}







if (1==$estadoedl) {
	
	
	echo '<a href="../pdf/formato_edl&'.$id.'.pdf" download="Formato EDL.pdf"><img src="../images/pdf.png"> Generar PDF para firma.</a> ';
	
	session_start();
require_once('listas.php'); 
$nump117=privilegios(117,$_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump117) { 
echo '<div class="modal-footer">
<form action="" method="post" name="ewr44543535435ewr">
<button type="submit" class="btn btn-warning" >
<input type="hidden" name="id_anular_edl" value="'.$id.'">
<span class="glyphicon glyphicon-edit"></span> Anular aceptación</button>
</form>
</div>';
} else {}

} else {
?>
<div class="form-group text-left"> 


<div class="modal-footer">
Diligenciar luego de tener todos los compromisos y competencias. 
<?php 

$fin=array_sum($arrayedlnota);
//echo $fin;

if (2<$totalcompromisos && 100==$fin) {
?>
<form action="" method="post" name="ewr435435ewr">
<button type="submit" class="btn btn-success" >
<input type="hidden" name="id_aceptar_edl" value="<?php echo $id; ?>">
<span class="glyphicon glyphicon-ok"></span> Aceptar </button>
</form>
</div>


<div class="modal-footer">
<form action="" method="post" name="ewr434353455435ewr">
<button type="submit" class="btn btn-xs btn-danger" onclick="alert('Recuerde informarle a su jefe inmediato sobre el rechazo generado.')">
<span class="glyphicon glyphicon-ok"></span> Rechazar </button>
<input type="hidden" name="rechazoedl" value="<?php echo $id; ?>">
</form>
</div>
<?php 

} else { echo '<div class="modal-footer" style="color:#B40404"><b>IMPORTANTE!</b> Recuerde que la sumatoria de los compromisos debe ser 100% y deben ser minimo 3 compromisos para poder aceptar la EDL.</div>'; }

?>




</div>
<?php
} 
?>
</div>
<?php

} else {}
?>



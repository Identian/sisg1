<?php

$nump153=privilegios(153,$_SESSION['snr']);

$realdatecompleto=date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2024-02-21 08:00:00");
$fecha_limite = strtotime("2024-02-27 17:00:00");


$array=array('9147859', '80773108', '6103659', '71367055', '49786829', '8691085', '52832873', '80729076', '51815024', '18205242', '31386809', '16719579', '34678010', '1058820913', '12276125', '1015432762', '79878812', '41660661', '1143860895', '1023888259', '79715092', '11221547', '1001205112', '85167437', '80810990', '20942268', '1136882942', '53894666', '79238817', '19393894', '16714473', '79781848', '1016011459', '79664754', '7730830', '1052951562', '79642594', '79393252', '92503084', '19317688', '79328794', '19286778', '79374131', '1015425748', '4263297', '19408429', '79520920', '52537041', '1059985582', '92226472', '1013634550', '1020781414', '1023931856', '54255816', '42887822', '43473471', '98463250', '71775624', '5884159', '1017160871', '43671927', '1216724750', '3353787', '8434529', '32182341', '21990818', '43204076', '3563400', '1152214401', '43412498', '70566003', '43185719', '43201767', '42979060', '71664292', '98539392', '98641912', '1022036447', '21422279', '32110748', '15450663', '39278549', '39272028', '43489863', '1033647255', '43410307', '1000304812', '1046933344', '21830734', '70752997', '1040039510', '15387903', '1037612572', '70904336', '21420724', '43401004', '43960596', '39444052', '39433743', '1152189173', '32298598', '39452595', '39383766', '39387699', '1047968441', '22103510', '22104209', '1017225777', '1045047910', '15456414', '1033342825', '1017146869', '71875747', '70135572', '22114851', '1152451011', '70074338', '1037606187', '98581397', '71579527', '43570086', '3622162', '1007286488', '70320985', '98564979', '71586048', '21581501', '43984970', '43551708', '21609182', '1037570390', '21449333', '8339238', '1040356154', '1028007916', '43418195', '21691015', '21742658', '70431578', '43106826', '71646100', '1035224651', '21811141', '98483084', '43649071', '43657283', '32564338', '1044502456', '32278202', '43250484', '21500425', '1044102223', '43797314', '42941216', '1007495869', '22117566', '32103356', '1039624818', '42650094', '32291438', '70522672', '43343600', '32559538', '39326970', '1140894079', '18775530', '1045699235', '8630751', '8644630', '85201814', '8636816', '32611358', '1022442719', '13067499', '72143888', '80125151', '52357595', '52450571', '80796433', '1022346224', '52539526', '1023916986', '4244137', '51556248', '1010203680', '1004206583', '52561645', '79240477', '10385356', '1032393918', '1072006156', '2979438', '79577485', '1002241853', '52392323', '1020756866', '1070617610', '11409151', '11411862', '11408551', '11412446', '51670413', '40775396', '39545638', '39629207', '80067951', '35250425', '1070609367', '39576089', '39662382', '20945858', '91105433', '79380077', '1105057476', '53892329', '1097035531', '1000353291', '19472040', '1030663663', '39757483', '52465957', '1022434621', '1015405365', '51914618', '41737565', '79730696', '1024520736', '40443439', '39525963', '79369458', '1016050413', '1233501801', '80068436', '11305994', '19491074', '1003189430', '79974679', '15025778', '52420996', '1010218422', '79608002', '39647221', '49742079', '55189653', '1121707042', '6820841', '35533457', '24713112', '28865444', '11345111', '75103397', '52200977', '20632281', '20989736', '1013622302', '79065669', '79351271', '80372603', '1018450830', '93288950', '1019054887', '52520568', '1020721773', '1014235072', '79555982', '79877775', '36532224', '8500509', '79697083', '79730432', '86049522', '79335439', '79426702', '26560033', '20493604', '1069256222', '1069282527', '20701364', '20429360', '20794270', '1073607050', '1128451705', '1069925843', '35502724', '208498', '45691737', '73211980', '45434574', '23144423', '45504141', '45449342', '34978756', '1002248969', '9098788', '73103171', '1050962609', '73194853', '9099978', '9178073', '9110676', '7931524', '73550779', '33106170', '73191269', '33198164', '1067837292', '72312000', '9142394', '1063480022', '19768398', '23148233', '40034519', '23781735', '1057592528', '97446187', '23782803', '1052388386', '40012948', '46678311', '79261078', '51891295', '40415950', '46677364', '23551995', '1052405933', '23551811', '1049412232', '53064903', '23607723', '80146107', '23606740', '23621238', '1054780389', '23752820', '23755455', '23784152', '23779610', '4173255', '43022518', '46643276', '23965806', '24048881', '1055272370', '24079972', '1052396295', '9529339', '46363027', '74082151', '46384982', '1118534711', '24758297', '4475294', '30327327', '10285460', '1060649092', '1053872443', '1057787773', '10259331', '24726932', '31868514', '1055834285', '24387721', '24386170', '1054561313', '10183922', '1054543605', '30386267', '80076722', '15991579', '24726329', '1002718705', '1058819290', '24838420', '24730753', '1336216', '1058843343', '25061203', '30383135', '25095596', '1053838636', '40777219', '1117824223', '40692455', '10530431', '76328265', '34568796', '10539244', '1062077201', '34324094', '25312887', '25311771', '29504590', '34771534', '1144202627', '1059444677', '34675292', '1061761080', '1062333078', '34373011', '34513178', '1061764515', '34606983', '34598156', '34594558', '1064427450', '10300986', '49762541', '42494063', '17977213', '52268197', '36712135', '49715973', '49764765', '26765815', '18919885', '26861824', '49608901', '49751874', '22446685', '78710510', '50849026', '15607488', '36538413', '6878277', '34977854', '1007629725', '1064987274', '78018900', '30687480', '50960271', '50960632', '78078451', '30670167', '26009219', '78741901', '30569843', '30580744', '50944099', '39283250', '78116001', '1077435875', '1010016767', '31973736', '4846464', '1077425001', '1075314787', '12130508', '36089729', '1003803288', '7715612', '55059658', '1075315227', '12274293', '1081393784', '12275830', '12232759', '12231409', '1083875361', '12265395', '40943579', '40983574', '40801385', '1121042141', '70066718', '77175611', '1006791700', '27004151', '36562725', '36545807', '12642360', '36532985', '12558671', '12557889', '12612803', '88186479', '23042913', '39018790', '12501042', '77189232', '26759691', '49767168', '26725412', '39086596', '32757307', '39089758', '57456848', '26910676', '17316198', '31960088', '51648243', '7536309', '40189137', '86069126', '39732508', '21173817', '1001203357', '80069905', '40390673', '52783129', '40416975', '40327476', '21200854', '7062757', '30739711', '12975243', '30734244', '1082689206', '87433783', '37002389', '13006401', '37000926', '1085903832', '27233411', '87710113', '87245918', '1088974054', '27295996', '1089481883', '1088733458', '59793986', '59665511', '87948469', '59674028', '30329062', '27534474', '13060397', '13463902', '13502083', '60448887', '37370891', '1094269976', '63547053', '27650989', '88001745', '27682599', '1064842342', '1064841157', '26863205', '1094240974', '88161192', '1065563444', '27804899', '27804979', '24577566', '41920757', '24580141', '18386029', '25016131', '41895006', '66735025', '4377064', '1014283413', '24579512', '1096645959', '1098309544', '30339135', '42152880', '33993872', '18533094', '1088536578', '1094943685', '24550686', '1087493983', '1093220885', '1059813471', '1094900842', '18614526', '25164922', '25193839', '25194226', '26863397', '51877907', '1098721071', '1098726943', '28338617', '52961279', '1102352461', '18904261', '37747128', '1095831750', '28130691', '63457607', '1098697840', '63459237', '63449248', '13702749', '88152189', '63509359', '30009085', '1099282003', '37557137', '63395899', '13834377', '63441455', '63363043', '37324198', '63529588', '37626408', '28307805', '37626445', '28357645', '91205065', '1100973174', '91109224', '1100960944', '37655976', '28403884', '37652609', '27993446', '91106119', '91390227', '37944473', '37947191', '63283461', '63437705', '51933682', '27982791', '1102548919', '1102549604', '64718568', '1102863226', '33238479', '92522391', '64866423', '33108791', '23219168', '23101831', '34945269', '12436651', '79493040', '38211346', '14137168', '1054548131', '1234645010', '65585757', '1012423509', '28576691', '43651954', '6008801', '28612354', '28684244', '1106773338', '1105683937', '1109301838', '28741986', '1105788371', '38287812', '14321970', '28815883', '52958128', '28846147', '6022109', '93205344', '5983963', '1106393310', '94062832', '79322975', '1144093187', '1193557666', '16755044', '38656363', '6318361', '38562234', '66971452', '16629500', '1144101665', '31376102', '38473907', '66737061', '27123788', '1115066451', '38860787', '1115070755', '29123241', '38873678', '31655451', '1112766556', '31499113', '16233708', '16208115', '31421158', '31432417', '31420520', '31158671', '31154556', '1113629053', '66756585', '1113695529', '66999788', '29661117', '38613346', '31154592', '41934554', '1116433689', '94154728', '66702442', '29812724', '29831860', '29832411', '66711584', '16365191', '14898730', '24242703', '1118558229', '1057599136', '1118552503', '47439811', '46663920', '23791710', '30982838', '27355979', '27354803', '69026253', '1006962091', '1085318514', '1121199371', '40368232', '42546633', '41213449', '69802364', '21246623', '23660283', '71643082');

	 		 
if(1==$_SESSION['rol'] or 0<$nump153 or ((in_array($_SESSION['cedula_funcionario'], $array)) && 3>$_SESSION['snr_tipo_oficina'])) {

if ((isset($_POST["calzado"])) && (""!=$_POST["calzado"])) {
	
	

$funcionario=$_SESSION['snr']; 
 $ano=date('Y');

$queryt = sprintf("SELECT count(id_funcionario) as dotacionn FROM dotacion where periodo=".$ano." and id_funcionario=".$funcionario." and estado_dotacion=1"); 
$selectt = mysql_query($queryt, $conexion);
$rowtt = mysql_fetch_assoc($selectt);
$ndota=intval($rowtt['dotacionn']);
if (1<$ndota) {


echo '<script type="text/javascript">swal(" Error !", "No es permitido más de dos dotaciones.  !", "error");</script>';


	} else {


 
 
 
 
 
 
$tamano_archivo=17301504;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');

$directoryftp="filesnr/dotacion/";

if (isset($_FILES['file']['name']) && ""!=$_FILES['file']['name']) {

$ruta_archivo = 'dotacion-'.$_SESSION['snr'].''.date("YmdGis");

$archivo = $_FILES['file']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file']['size'];
$nombrefile = strtolower($_FILES['file']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) ) { 
  $files = $ruta_archivo.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  $nombrebre_orig= ucwords($nombrefile);
  
  } else {
$files='';	  
  }
} else { 
$files='';	
		}
		
} else { 
$files='';	
	}	
 
 
 
 

$insertSQL = sprintf("INSERT INTO dotacion (
nombre_dotacion, id_funcionario, periodo, cuatrimestre, camisacorta, camisalarga, chaqueta, pantalon, calzado, url, estado_dotacion) 
VALUES (now(), %s, %s, %s,  %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString($funcionario, "int"), 
GetSQLValueString(2023, "int"),
GetSQLValueString(3, "int"),
GetSQLValueString($_POST["camisacorta"], "text"),
GetSQLValueString($_POST["camisalarga"], "text"),
GetSQLValueString($_POST["chaqueta"], "text"),
GetSQLValueString($_POST["pantalon"], "text"),
GetSQLValueString($_POST["calzado"], "text"),
GetSQLValueString($files, "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);


  
  echo $insertado;
  
  
  

  $updateSQL = sprintf("UPDATE funcionario SET  celular_funcionario=%s, sexo=%s WHERE id_funcionario=%s and estado_funcionario=1",                  
					   GetSQLValueString($_POST["celular_funcionario"], "text"),
					   GetSQLValueString($_POST["sexo"], "text"),
					    GetSQLValueString($funcionarioedl, "int"));
  $Result1 = mysql_query($updateSQL, $conexion);


$emailur2=$_SESSION['snr_correo'];
$subject = 'CONFIRMACIÓN DE REGISTRO PARA DOTACIÓN';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'Vicky de la Superintendencia de Notariado y Registro informa que se ha registrado correctamente el registro de la dotación.<br><br>';

$cuerpo2 .= $corre."<br><br>"; 
$cuerpo2 .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);


 }
 
} else {}

 
 


?>
 
 

  <div class="row">
  
  

  
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existencia('dotacion'); ?></h3>

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
              <h3>20<?php echo $anoactual; ?></h3>

              <p>Año</p>
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
             
 <h3>5</h3>
			  
              <p>Regionales</p>
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
 
  
  <p>
  <b>Dotaciones</b>


  </p>
  
  
<?php 
if (($fecha_inicio<=$fecha_actual && $fecha_limite>=$fecha_actual) or 1==$_SESSION['rol'] or 0<$nump153) {
 ?>
  
    <h3  class="box-title">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"><span class="glyphicon glyphicon-plus-sign"></span>
        Nuevo
      </button>  

	  </h3>
	  
<?php } else {} ?>
	  </div>
	  
	  
	  


  
  
</div> <!-- FINAL box-header with-border -->

    <div class="box-body">
      <div class="table-responsive">
	  

			
	
<table  class="table display" id="inforesoluciones" cellspacing="0" width="100%">
	
	
                <thead>
 <tr align="center" valign="middle">
 <th>Vigencia</th>
  <th>Nombre</th>
 <th>Correo</th>
 <th>Cedula</th>
<th>Celular</th>
<th>Area</th>
<th>Oficina</th>	
<th>Camisa manga corta</th>	
<th>Camisa manga larga</th>
<th>Pantalon</th>
<th>Calzado</th>
<th>Chaqueta</th>
<th>Recomendaciones</th>
<th></th>
</tr>
</thead>
<tbody>
				
<?php 

 


if (1==$_SESSION['rol'] or 0<$nump153) {
$query4="SELECT * from dotacion, funcionario where dotacion.id_funcionario=funcionario.id_funcionario and estado_dotacion=1 ORDER BY id_dotacion desc  "; 
} else {
$query4="SELECT * from dotacion, funcionario where dotacion.id_funcionario=funcionario.id_funcionario and estado_dotacion=1 and funcionario.id_funcionario=".$_SESSION['snr']." ORDER BY id_dotacion desc  "; 
}

$result = $mysqli->query($query4);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
?>  
<tr>
				<?php
$id_res=$row['id_dotacion'];
echo '<td>';
echo $row['periodo'].'-'.$row['cuatrimestre'];
echo '</td>';

echo '<td><a href="usuario&'.$row['id_funcionario'].'.jsp"  target="_blank">'.$row['nombre_funcionario'].'</a></td>';
echo '<td>';
echo $row['correo_funcionario'];
echo '</td>';
echo '<td>';
echo $row['cedula_funcionario'];
echo '</td>';
echo '<td>';
echo $row['celular_funcionario'];
echo '</td>';
if (1==$row['id_tipo_oficina']) {
echo '<td>Nivel central</td>';
echo '<td>'.quees('grupo_area',$row['id_grupo_area']).'</td>';
} else {
echo '<td>'.regional($row['id_oficina_registro']).'</td>';
echo '<td>'.quees('oficina_registro',$row['id_oficina_registro']).'</td>';	
}
echo '<td>';
echo $row['camisacorta'];
echo '</td>';
echo '<td>';
echo $row['camisalarga'];
echo '</td>';
echo '<td>';
echo $row['pantalon'];
echo '</td>';
echo '<td>';
echo $row['calzado'];
echo '</td>';
echo '<td>';
echo $row['chaqueta'];
echo '</td>';
echo '<td>';
if (isset($row['url']) && ""!=$row['url']) {
echo '<a href="filesnr/dotacion/'.$row['url'].'" target="_blank">Pdf</a>';
} else {}
echo '</td>';
echo '<td>';
	if (1==$_SESSION['rol'] or 0<$nump153) { 
echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="dotacion" id="'.$id_res.'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

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
<label  class="control-label"><span style="color:#ff0000;">*</span> Vigencia:</label> 
<input type="text" class="form-control" readonly value="2023-3">
</div>
 
 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Nombre:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['snr_nombre']; ?>">
</div>

 <div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Cédula:</label> 
<input type="text" class="form-control" readonly value="<?php echo $_SESSION['cedula_funcionario']; ?>">
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Genero:</label> 
<select name="sexo" class="form-control" required>
<option selected></option>
<option value="F">Femenino</option>
<option value="M">Masculino</option>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Telefono Celular:</label> 
<input type="text" class="form-control numero"  name="celular_funcionario" placeholder="Solo números" required>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Camisa / blusa manga corta:</label> 
<select name="camisacorta" class="form-control" required>
<option selected></option>
<option>XS</option>
<option>S</option>
<option>M</option>
<option>L</option>
<option>XL</option>
<option>XX</option>
<option>XXXL</option>
<option>XXXXL</option>
<option>XXXXXL</option>
<option></option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Camisa / blusa manga larga:</label> 
<select name="camisalarga" class="form-control" required>
<option selected></option>
<option>XS</option>
<option>S</option>
<option>M</option>
<option>L</option>
<option>XL</option>
<option>XX</option>
<option>XXXL</option>
<option>XXXXL</option>
<option>XXXXXL</option>
</select>
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Chaqueta:</label> 
<select name="chaqueta" class="form-control" required>
<option selected></option>
<option>XS</option>
<option>S</option>
<option>M</option>
<option>L</option>
<option>XL</option>
<option>XX</option>
<option>XXXL</option>
<option>XXXXL</option>
<option>XXXXXL</option>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Pantalon:</label> 
<select name="pantalon" class="form-control" required>
<option selected></option>
<optgroup label="Femenino">
<option>4</option>
<option>6</option>
<option>8</option>
<option>10</option>
<option>12</option>
<option>14</option>
<option>16</option>
<option>18</option>
<option>20</option>
<option>22</option>
</optgroup>
<optgroup label="Masculino">
<option>28</option>
<option>30</option>
<option>32</option>
<option>34</option>
<option>36</option>
<option>38</option>
<option>40</option>
<option>42</option>
<option>44</option>
</optgroup>
</select>
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Calzado:</label> 
<select name="calzado" class="form-control" required>
<option selected></option>
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
</select>
</div>




<script>
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
	var fsize = 15000;
	var fileSize = fileInput.files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
		
    if(!allowedExtensions.exec(filePath)){
        alert('Solo se permite extension pdf');
        fileInput.value = '';
        return false;
		
		
    }else{
  
  if  (siezekiloByte < fsize){
	  
	   if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 'ok';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
	  
} else {
	alert('Debe ser inferior a 15000 Kb, el archivo cargado es de '+siezekiloByte+' Kb');
      fileInput.value = '';
    return false;
}

       
    }
}
</script>

<div class="form-group text-left">
<label  class="control-label"> Recomendaciones medicas: </label> 
<input type="file" name="file" id="file" title="Solo PDF" onchange="return fileValidation()" value="" required>
<span style="color:#B40404;font-size:13px;">PDF inferior a 15 Mg</span>

<div id="imagePreview"></div>
</div>



<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Crear </button>
</div>

</form>


      </div>
    </div>
  </div>
</div>





	  



<?php 
} else { echo 'No tiene acceso. ';} ?>






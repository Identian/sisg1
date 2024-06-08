<?php if (1==$_SESSION['rol']) {


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
	
	
	
$insertSQL = sprintf("INSERT INTO funcionario (cedula_funcionario, nombre_funcionario, correo_funcionario, 
clave_funcionario, id_notaria_f, alias_iduca, id_rol, id_grupo_area, 
id_cargo_nomina_encargo, id_cargo_nomina_titular, id_nivel_academico, id_vinculacion, 

id_tipo_oficina, id_cargo, foto_funcionario, lider_pqrs, estado_funcionario) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
GetSQLValueString(trim($_POST["cedula_funcionario"]), "text"), 
GetSQLValueString($_POST["nombre_funcionario"], "text"), 
GetSQLValueString(trim($_POST["correo_funcionario"]), "text"), 
GetSQLValueString(md5('12345'), "text"), 
GetSQLValueString($id_notaria, "text"), 
GetSQLValueString($_POST["login"], "text"), 
GetSQLValueString(3, "int"), 
GetSQLValueString(301, "int"), 
GetSQLValueString(44, "int"), 
GetSQLValueString(44, "int"), 
GetSQLValueString(12, "int"), 
GetSQLValueString(6, "int"), 
GetSQLValueString(3, "int"),
GetSQLValueString($_POST["id_cargo"], "int"), 
GetSQLValueString('avatar.png', "text"),
GetSQLValueString(0, "int"),
 GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());
echo $insertado;
}
} else {}



	?>

	<div class="row">
<div class="col-md-12">
	<div class="box box-info">
 <div class="box-header with-border">
                  <h3 class="box-title">Notarios y asesores de VUR</h3>

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
<th>Rol</th>
<!--<th>Est.</th>
<th>Dep / Mun</th>
<th>Notaria</th>-->
<th>codigo N</th>
<th style="min-width:150px;">Nombre</th>
<th>Login</th>
<th>Identificación</th>
<th style="min-width:110px;">Fecha</th>
<th style="min-width:50px;">SISG</th>
<th style="min-width:150px;"></th>

</tr></thead><tbody>		
<?php
error_reporting(0);
$json = file_get_contents('http://192.168.210.130:8080/usuarios_vur/');
//$json = file_get_contents('https://sisg.supernotariado.gov.co/api/usuarios_vur/');
$obj = json_decode($json);
foreach ($obj as $character) {
	echo '<tr>';
	echo '<td>';
 
   $numn= intval($character->ID_ROL);
	if (2==$numn) {
		echo 'Notario';
		$cargon=1;
	} elseif (17==$numn) {
		echo 'Asesor';
		$cargon=3;
	} else {}
	
	
	/*
	echo '</td><td>';
	echo $character->STATUS;

	
	echo '</td><td>';
	echo $character->DEPARTAMENTO;
	echo ' ';
	echo $character->MUNICIPIO;
	echo '</td><td>';
	echo $character->NUMERO_NOTARIA;
	*/
	echo '</td><td>';
	$codenotaria = $character->CODIGO;
	echo $codenotaria;
	echo '</td><td>';
	$name1 = $character->PRIMER_NOMBRE;
	$name2 = ' '.$character->SEGUNDO_NOMBRE;
	$name3 = ' '.$character->PRIMER_APELLIDO;
	$name4 = ' '.$character->SEGUNDO_APELLIDO;
	
	$nombrec=trim($name1.$name2.$name3.$name4);
	echo $nombrec;
	
	
	echo '</td><td>';
	$login = $character->LOGIN;
	echo $login;
	echo '</td><td>';
	echo $character->NUM_DOCUMENTO;
	echo '</td>';

	echo '<td>';
	echo $character->FECHA_CREACION;
	echo '</td><td>';
	
$parametro=intval($character->NUM_DOCUMENTO);
$actualizar5 = mysql_query("SELECT id_funcionario, alias_iduca FROM funcionario where cedula_funcionario=".$parametro." or alias_iduca='$login'", $conexion);
$row15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {
	$id_user=$row15['id_funcionario'];
	
	echo '';
	if (isset($row15['alias_iduca'])) {
 echo 'Si';
	} else { 
  echo '<b style="color:#ff0000">No</b>';
	}
	
	
} else {
	echo '';

	
}
 
echo '</td><td>';
	
	
	if (0<$total55) {
 echo '<a href="usuario&'.$id_user.'.jsp"><span class="glyphicon glyphicon-user"></span></a>';
} else {
	

?>
	
<form action="" method="POST" name="form1<?php echo $parametro; ?>" >
<input type="hidden"  name="cedula_funcionario" value="<?php echo $parametro; ?>" >
<input type="hidden" name="nombre_funcionario" value="<?php echo $nombrec; ?>" >
<input type="hidden" name="login" value="<?php echo $login; ?>" >
<input type="hidden"  name="correo_funcionario" value="<?php echo $correon; ?>" >
<input type="hidden"  name="id_cargo" value="<?php echo $cargon; ?>" >
<input type="hidden"  name="codigonotaria" value="<?php echo $codenotaria; ?>" >
<input type="submit" value="Crear" class="">
</form>


<?php
	}
	
	
	echo '</td>';
	
	echo '</tr>';
}

 mysql_free_result($actualizar5);
?>
	
		</tbody></table>
	
		</div>
	</div>
	</div>
	</div>
		</div>

	
	
	
	<?php
	/*
	if (isset($_GET['q'])){
	$pais=$_GET['q'];
$json = file_get_contents('http://192.168.210.130:8080/'.$pais);
$obj = json_decode($json);

foreach ($obj as $character) {
	echo 'rol: ';
	echo $character->name;
	echo '<BR>';
	echo 'CAPITAL: ';
	echo $character->capital;
	echo '<BR>';
	echo 'REGION: ';
	echo $character->region;
	echo '<BR>';
}

	} else {}
	*/
 } else {} ?>

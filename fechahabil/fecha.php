<form action="" method="post">
Colocar la fecha de radicacion y dias de termino: 
<input type="date" name="fecha" placeholder="Fecha" value="<?php if (isset($_POST['fecha'])) { echo $_POST['fecha']; } else {} ?>" required>
<input type="number" name="dias" placeholder="Dias" value="<?php if (isset($_POST['dias'])) { echo $_POST['dias']; } else {} ?>"required>
<input type="submit" value="Enviar">
</form>
<br>

<?php
function fechahabil($f1a,$dias) {
$holiday = array(
//Y-m-d    2018
'2018-06-04', 
'2018-06-11', 
'2018-07-02', 
'2018-07-20',  
'2018-08-07', 
'2018-08-20', 
'2018-10-15', 
'2018-11-05', 
'2018-11-12', 
'2018-12-08', 
'2018-12-25', 
// 2019
'2019-01-01', 
'2019-01-07', 
'2019-03-25', 
'2019-04-18', 
'2019-04-19', 
'2019-05-01', 
'2019-06-03', 
'2019-06-24', 
'2019-07-01', 
'2019-07-20', 
'2019-08-07', 
'2019-08-19', 
'2019-10-14', 
'2019-11-04', 
'2019-11-11', 
'2019-12-08', 
'2019-12-25', 
// 2020
'2020-01-01', 
'2020-01-06', 
'2020-03-23', 
'2020-04-09', 
'2020-04-10', 
'2020-05-01', 
'2020-05-25', 
'2020-06-15', 
'2020-06-22', 
'2020-06-29', 
'2020-07-20', 
'2020-08-07', 
'2020-08-17', 
'2020-10-12', 
'2020-11-02', 
'2020-11-16', 
'2020-12-08', 
'2020-12-25',
//2021
'2021-01-01', 
'2021-01-11', 
'2021-03-22', 
'2021-04-01', 
'2021-04-02', 
'2021-05-01', 
'2021-05-17', 
'2021-06-07', 
'2021-06-14', 
'2021-07-05',
'2021-07-20',  
'2021-08-07', 
'2021-08-16', 
'2021-10-18', 
'2021-11-01', 
'2021-11-15', 
'2021-12-08', 
'2021-12-25',

);



/*
if (6==date('N', strtotime($dias))) {
	$limite=$dias;
} else {
	if (7==date('N', strtotime($dias))) {
	$limite=$dias;
} else { 
if (in_array($dias,$holiday)) {
	$limite=$dias;
} else {
	$limite=$dias+1;
}
}	
}
*/

if ((6==date('N', strtotime($f1a))) or (7==date('N', strtotime($f1a))) or (in_array($f1a,$holiday))) {
$limite=$dias;
} else {
$limite=$dias+1;
}

$fechaInicio=strtotime($f1a);
$mas100 = date('Y-m-d', strtotime('+150 day', strtotime($f1a)));
$fechaFin=strtotime($mas100);

$grupo=array();
for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
$nuevafecha= date("Y-m-d", $i);	

if (6==date('N', strtotime($nuevafecha))) {
} else {
	if (7==date('N', strtotime($nuevafecha))) {
} else { 
if (in_array($nuevafecha,$holiday)) {
} else {
	array_push($grupo, $nuevafecha);
}

}
	
}


$total= count($grupo);
if ($limite==$total) {
	$resultado=end($grupo);
	break; 
}

}


return $resultado;
 }
 
 if (isset($_POST['fecha']) && ""!=$_POST['fecha'])  {
	 echo 'Resultado en dias habiles: ';
 echo fechahabil($_POST['fecha'],$_POST['dias']);
 } else {}
 
 ?>
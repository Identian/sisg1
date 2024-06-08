<?php  

// require_once('../conf.php'); 
/*
   $id_funcionario = $_SESSION['snr'];
   $query10 = sprintf("SELECT cedula_funcionario, id_notaria_f
	FROM funcionario 
	WHERE id_funcionario = '.$id_funcionario.' 
	AND id_tipo_oficina = 3"); 
   $select10 = mysql_query($query, $conexion) or die(mysql_error());
   $row10 = mysql_fetch_assoc($select10);
   $totalRows10 = mysql_num_rows($select10);
   if ($totalRows10 > 0){
      $cedula_funcionario = $row10['cedula_funcionario'];
      $id_notaria = $row10['id_notaria_f'];  
   }
*/

set_time_limit(0);

// mysql_select_db($database_conexion, $conexion);  

// $deleteSQL = "DELETE FROM tmp_causantes";
// $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());
 


?> 
<br> 

<form name="form3" action="" method="post">
   <input name="userfile" type="file"> 
   <input type="submit" value="Enviar"  />

<br> 

<?php

/*
$fila = 1;
if (($gestor = fopen("test.csv", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
        echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
            echo $datos[$c] . "<br />\n";
        }
    }
    fclose($gestor);
}

*/
// $archivo = $_POST['userfile'];
// echo "archivo: ".$archivo;


$fila = 1;
if (isset($_POST['userfile']) && ($_POST['userfile'] != ' '))
// if ( $archivo != "") 
{  

$archivo = $_POST['userfile'];
echo "archivo: ".$archivo;

$row = 0;  
/*
VALUES ($data[0],'$data[1]',$data[2],$data[3],$data[4],
            $data[5],$data[6],'$data[7]','$data[8]','$data[9]'.'$data[10]','$data[11]','$data[12]',$data[13],'$data[14]')";  

VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."'.'".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."')";  

VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]',
            '$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]')";  

*/
// $fp = fopen ($archivo,"r");  
// $fp = fopen ("pages\\tmp_causantes.csv","r");
$fp = fopen ("pages/".$archivo,"r");
//el valor mil indica la cantidad de bytes del archivo
//si el archivo es un poco grande es mejor dejarlo en 0
//en algunos casos el ";" no es aceptado usa ","

while ($data = fgetcsv ($fp, 0, ";")) {  
$num = count ($data);  
print " <br>";  
$row++;  
echo "$row- ".$data[0].$data[1].$data[2].$data[3].$data[4].$data[5].$data[6].$data[7].$data[8].$data[9].$data[10].$data[11].$data[12].$data[13].$data[14];  
// $insertar="INSERT INTO tmp_causantes () VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]',
//            '$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]')";  
$insertar="INSERT INTO tmp_sucesiones (	id_sucesion, fecha_inicio, numero_acta, id_estado, id_causa_terminacion,
             swtitular, id_usuario, fecha_terminacion, fecha_registro_creacion, fecha_registro_terminacion, nombre_notario_encargado,
			 numero_documento_encargado, fecha_acta, id_tipo_documento_term, numero_documento_terminacion) 
VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."')";  
mysql_query($insertar, $conexion) or die('Error: '.mysql_error()); 

}  
fclose ($fp); 
}   
?> 

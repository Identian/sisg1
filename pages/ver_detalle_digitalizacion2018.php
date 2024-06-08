  <?php
session_start();
if (31==$_SESSION['permiso31'] OR 1==$_SESSION['rol']) {
	
if (isset($_POST['option']) and ""!=$_POST['option']) {
	
	
$infoa=explode('#',$_POST['option']);
$idcontenedor=intval($infoa[0]);
$nombre=$infoa[1];
$oficina=intval($infoa[2]);

$infoa=explode('-',$nombre);
$infob=intval($infoa[1]);




if (28==$oficina) {
$direc='Aguachica';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (31==$oficina) {
$direc='Caucacia';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (76==$oficina) {
$direc='Acacias';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (90==$oficina) {
$direc='Caloto';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (22==$oficina) {
$direc='Chaparral';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (186==$oficina) {
$direc='Chimichagua';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (65==$oficina) {
$direc='Convencion';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (151==$oficina) {
$direc='Corozal';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (129==$oficina) {
$direc='Florencia';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (47==$oficina) {
$direc='Ituango';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (92==$oficina) {
$direc='Popayan';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (119==$oficina) {

$path='./Digitalizaciones/Puertotejada/DatairisPuertoTejada/DATA/2/2';
} else if (29==$oficina) {
$direc='Simiti';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (152==$oficina) {
$direc='Sincelejo';
$path='./Digitalizaciones/'.$direc.'/Datairis/Data/2/2';
} else if (103==$oficina) {
$direc='Yarumal';
$path='./Digitalizaciones/'.$direc.'/Datairis/Data/2/2';
} else if (143==$oficina) {
$direc='Guamo';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (55==$oficina) {
$direc='Amalfi';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (37==$oficina) {
$direc='Segobia';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (117==$oficina) {
$direc='Silvia';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (148==$oficina) {
$direc='Ibague';
$path='./Digitalizaciones/'.$direc.'/Datairis/DATA/2/2';
} else if (9==$oficina) {
$direc='Puertoasis';
$path='./Digitalizaciones/'.$direc.'/PuertoAsis/DATA/2/2';
} else if (139==$oficina) {
$direc='Purificacion';
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
} else if (118==$oficina) {
$path='./Digitalizaciones/'.$direc.'/Datairis'.$direc.'/DATA/2/2';
$direc='Santanderdequilichao';
$path='./Digitalizaciones/'.$direc.'/DatairisSantanderdequilichao/DATA/2/2';
} else if (111==$oficina) {
$direc='Cartagena';
$path='./Digitalizaciones/'.$direc.'/Datairis/Data/2/2';
} else {
$direc='';
$path='#';
}


$dbpostgres2='ORIP'.$oficina;
$conexionpostgres2="host=192.168.80.181 port=5432 dbname=".$dbpostgres2." user=admin password=Superadmin2022";


$conexionpostgresql2 = pg_connect($conexionpostgres2);
if(!$conexionpostgresql2){
     echo 'ERROR';
} else {



echo '<div style="padding: 10px 10px 10px 10px">';


echo '<b>Nombre: '.$nombre.'</b><br>';


$query = "SELECT tipodocumento.nombre as tipo, contenedorcontenido.nombre as nombre FROM contenedorcontenido, tipodocumento where contenedorcontenido.idtipodocumento=tipodocumento.idtipodocumento and idcontenedor=".$idcontenedor.""; //where codigo='232-0000001'

$resultado2 = pg_query ($query);
$num_resultados = pg_num_rows ($resultado2);


// where tipo_documento_iris_orip.id_tipo_documento_iris_orip=usaid2018detalle.idtipodocumento and idcontenedor=".$idcontenedor." and id_oficina_registro=".$oficina.""); 

							
for ($i=0; $i<$num_resultados; $i++)
   {
$row = pg_fetch_array ($resultado2);
echo  ''.$row['tipo'].' /';
 //if (117==$oficina) {
	 //$nombre2=explode('.',$row['nombre']);
	 //$nombre=$nombre2[0].'.pdf';

	 $nombre=$row['nombre'];
 
echo ' <a href="'.$path.'/'.$infob.'/Files/'.$nombre.'" target="_blank">'.$row['nombre'].'</a><br>';



 }


 





	echo '</div>';
	
	  pg_free_result($resultado2);
  pg_close($conexionpostgresql2);  

  }
  

 } else {}
 } else {}

 ?>






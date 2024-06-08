<?php
session_start();
if (isset($_GET['q']) && ""!=$_GET['q'] && isset($_SESSION['snr'])) {
	$urliris=$_GET['q'];
	//echo '<meta http-equiv="refresh" content="2;URL=?q='.$urliris.'" />';
	
	
	
ini_set('max_execution_time', 10000000);

header("Content-type:application/pdf");

//header("Content-Disposition:attachment;filename=Documento.pdf");


$ftp_server = "192.168.10.22";
$ftp_user_name = "usuarioftpdesian"; 
$ftp_user_pass = "claveftpdesian"; 


$urisgd= explode(".",$urliris);
$urisgdr= explode("_",$urisgd[0]);

$document=base64_decode($urisgdr[0]);
$pdf=base64_decode($urisgdr[1]); 
       
	   
$ruta='ftp://'.$ftp_user_name.':'.$ftp_user_pass.'@'.$ftp_server.'/Correo/'.$document.'/Files/'.$pdf.'';
$b64Doc = base64_encode(file_get_contents($ruta));  
echo base64_decode($b64Doc);



 
 /*
   $local_file = $directoryftpiris.$identi.".pdf";
        $server_file = "Correo/".$document."/Files/".$pdf;
     
        $conn_id = ftp_connect($ftp_server) or die("Error FTP 1"); 

        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

   
        if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
            
		
			
			echo '<meta http-equiv="refresh" content="1;URL=pdfview/web/?id='.$identi.'" />';
			
        } else {
             echo "Error FTP 2";
        }

*/
        ftp_close($conn_id);
		
} else { echo '<center>No tiene permisos para ver este documento.</center>'; }

?>
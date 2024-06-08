<?php
$emailu='giova900@gmail.com'; 
$radicado='SNR0023EE000001';
$infoacuse1=base64_encode($emailu);
$bodytag = str_replace("=", "", $infoacuse1);
$infoacuse=$bodytag.'&'.$radicado;
$info='<img src="https://servicios.supernotariado.gov.co/pqrs/logo/'.$infoacuse.'.gif">';
echo $info;
?>
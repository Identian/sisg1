Firmado:
<?php
// debe ser en jpeg
$contenidoBinario = file_get_contents('https://sisg.supernotariado.gov.co/pages/firma.jpeg');
echo base64_encode($contenidoBinario);


echo '<br>';

$user=111;
$clave=111;

$momentocompleto=date('Y-m-d H:i');
$momento_actual = strtotime($momentocompleto); 
$codef=$momento_actual*$clave;   // CLAVE DE DB


echo '<img src="https://sisg.supernotariado.gov.co/lubrica/'.$user.'&'.$codef.'.png">';


?>
  
 
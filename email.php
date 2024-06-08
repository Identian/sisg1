<?php
if (isset($_POST['mail']) && ""!=$_POST['mail']) {
$emailu4=$_POST['mail'].',giovanni.ortegon@supernotariado.gov.co';
$subject = 'Prueba de correo de la SNR';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Prueba de correo de la SNR test"; 
$cuerpo .= "<br>"; 
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= '<span style="color:#ccc;">Enviado por S.I.S.G.</span><br></div><br></div>'; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu4,$subject,$cuerpo,$cabeceras);

echo '<h1>Mensaje enviado </h1>';
} else {
	?>
	
<form  name="form14553456436" method="post" action="">
PROBAR ENVIO DE CORREO: 
<input type="email" name="mail" value="" placeholder="e-mail" required>
<input type="submit" value="Enviar">
</form>
	
	<?php
}
?>
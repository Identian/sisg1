<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Encuesta</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body style="background:#BA315A;">
 <div class="container">
      <div class="page-header">

<IMG src="BANNER-ENCUESTA.jpg" style="width:80%">
<div style="color:#fff;text-align: justify;  text-justify: inter-word;"> 
<center><h2>SI TÚ CUENTAS, ¡CUENTA!</h2></center>

<i>Encuesta anónima</i>
<br>
<b>Términos y condiciones:</b>
<p style="text-align: justify;  text-justify: inter-word;">
Esta encuesta tiene como propósito construir un diagnóstico sobre las situaciones que atenten contra la dignidad e integridad humana, diagnóstico con el que se construirán acciones efectivas para eliminar situaciones en donde se presenten casos de violencias basadas en género (física, sexual, psicológica y económica), de estigmatización, racismo, discriminación y en general que vulneren los derechos humanos.
Dicho esto, la encuesta será totalmente anónima y no tiene ningún interés en particular de conocer situaciones individuales o catalogar de manera directa a posibles agresores o agresoras, sino más bien, que como SNR tengamos las herramientas necesarias para acabar de raíz con dichas situaciones.
</p><br>
<b>Protección de datos:</b>
<br>
Los datos proporcionados en la encuesta son confidenciales y estarán protegidos y tratados de acuerdo a la Ley 1581 de 2012.

</div>
<hr>


<?php
if (isset($_POST['acoso1'])) {

require_once('../conf.php'); 

$insertSQL = sprintf("INSERT INTO acoso (
acoso1, 
acoso2, 
acoso3, 
acoso4, 
acoso5, 
acoso6, 
acoso7, 
acoso8, 
acoso9, 
acoso10, 
acoso11, 
acoso12, 
acoso13
) 
VALUES (%s,  %s,  %s,  %s,  %s,  %s,  %s,  %s,  %s,  %s,  %s,  %s,  %s)", 

GetSQLValueString($_POST['acoso1'], "text"), 
GetSQLValueString($_POST['acoso2'], "text"), 
GetSQLValueString($_POST['acoso3'], "text"), 
GetSQLValueString($_POST['acoso4'], "text"), 
GetSQLValueString($_POST['acoso5'], "text"), 
GetSQLValueString($_POST['acoso6'], "text"), 
GetSQLValueString($_POST['acoso7'], "text"), 
GetSQLValueString($_POST['acoso8'], "text"), 
GetSQLValueString($_POST['acoso9'], "text"), 
GetSQLValueString($_POST['acoso10'], "text"), 
GetSQLValueString($_POST['acoso11'], "text"), 
GetSQLValueString($_POST['acoso12'], "text"), 
GetSQLValueString($_POST['acoso13'], "text") 
);
$Result = mysql_query($insertSQL, $conexion);
echo '<center><h3>Datos enviados.</h3></center>';


} else {

?>


<form action="" method="POST" name="for46425435324324563m1" style="background:#fff;padding: 50px 50px 50px 50px;border-radius: 20px;box-shadow: 10px 5px 5px black;">

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>1. ¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por ser percibido(a) demasiado joven o viejo(a)?</label> 
<select class="form-control" required name="acoso1" ><option selected></option><option>Si</option>
<option>No</option>
<option>No aplica</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 2. 
¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por su origen étnico, color de piel, lenguaje, su lugar de nacimiento, forma de vestirse, el idioma, la forma de hablar o sus prácticas culturales?
</label> 
<select class="form-control" required name="acoso2" ><option selected></option><option>Si</option>
<option>No</option>
<option>No aplica</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 3. ¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por ser hombre o mujer?</label> 
<select class="form-control" required name="acoso3" ><option selected></option><option>Si</option>
<option>No</option>
<option>No aplica</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 4. ¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por su orientación sexual o identidad de género?</label> 
<select class="form-control" required name="acoso4" ><option selected></option><option>Si</option>
<option>No</option>
<option>No aplica</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 5. ¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por su nivel educativo?</label> 
<select class="form-control" required name="acoso5" ><option selected></option><option>Si</option>
<option>No</option>
<option>No aplica</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 6. ¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por sus posturas políticas?</label> 
<select class="form-control" required name="acoso6" ><option selected></option><option>Si</option>
<option>No</option>
<option>No aplica</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 7. ¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por tener capacidades diferentes?</label> 
<select class="form-control" required name="acoso7" ><option selected></option><option>Si</option>
<option>No</option>
<option>No aplica</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 8. 
¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por alguno de estos motivos: por sus rasgos físicos o apariencia externa, por su peso, su estatura, tener una cicatriz o una marca de nacimiento, un tatuaje, arete o la forma de vestir?
</label> 
<select class="form-control" required name="acoso8" ><option selected></option><option>Si</option>
<option>No</option>
<option>No aplica</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 9. ¿Siente que ha experimentado personalmente alguna forma de discriminación laboral por pertenecer o no a una religión?</label> 
<select class="form-control" required name="acoso9" ><option selected></option><option>Por pertenecer</option>
<option>Por no pertenecer</option>
<option>No aplica</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 10.  
¿Ha experimentado alguna forma de acoso u hostigamiento laboral por alguna de las siguientes prácticas: recibir miradas obscenas o petición de pláticas relacionadas con asuntos sexuales y/o proposiciones o peticiones directas o indirectas para establecer una relación sexual?
</label> 
<select class="form-control" required name="acoso10" ><option selected></option><option>Sí</option>
<option>Sí</option>
<option>No</option>
<option>Prefiere no responder</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 11. ¿Ha experimentado alguna forma de acoso u hostigamiento laboral mediado por el contacto físico no deseado?</label> 
<select class="form-control" required name="acoso11" ><option selected></option><option>Sí</option>
<option>Sí</option>
<option>No</option>
<option>Prefiere no responder</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 12. 
¿Ha experimentado alguna forma de acoso u hostigamiento laboral por el ofrecimiento de recompensas o incentivos laborales a cambio de favores sexuales?

</label> 
<select class="form-control" required name="acoso12" ><option selected></option><option>Sí</option>
<option>Sí</option>
<option>No</option>
<option>Prefiere no responder</option></select></div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> 13. 
¿Ha experimentado alguna forma de acoso u hostigamiento laboral a través de presiones o amenazas con daños o castigos en caso de no acceder a proporcionar favores sexuales?


</label> 
<select class="form-control" required name="acoso13" ><option selected></option><option>Sí</option>
<option>Sí</option>
<option>No</option>
<option>Prefiere no responder</option>
<option>Totalmente en desacuerdo</option></select></div>

<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>

</form>
<?php
}
?>

<br><br><br>
</div>
</div>
  </body>

</html>

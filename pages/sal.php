	<div class="row">
<div class="col-md-12">
	<div class="box box-info">


 <div class="box-header with-border">
 <h3><center><b>SALIDA DE MENORES</b></center></h3>
                

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">
			



<style>
tr {
background:#fff;
background-color: #fff;
}

tr:hover  {
background:#eee;
background-color: #eee;
}
</style>




<center>
<?php




if (1==$_SESSION['rol']) {
	
	
	
	function pdfVersion($filename)
{ 
    $fp = @fopen($filename, 'rb');
 
    if (!$fp) {
        return 0;
    }
 
    /* Reset file pointer to the start */
    fseek($fp, 0);
 
    /* Read 20 bytes from the start of the PDF */
    preg_match('/\d\.\d/',fread($fp,20),$match);
 
    fclose($fp);
 
    if (isset($match[0])) {
        return $match[0];
    } else {
        return 0;
    }
} 



if (isset($_GET['i']) && "" != $_GET['i']) {
$updateSQL = sprintf("UPDATE salida_menor SET actualizacion=1 where id_salida_menor=%s",
GetSQLValueString($_GET["i"], "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());
echo $actualizado;
} else { }





echo '<table class="table">';
$actualizar5 = mysql_query("SELECT * from salida_menor where fecha_carga>='2019-12-07 00:00:01' order by id_salida_menor desc", $conexion);
$row_sel15 = mysql_fetch_assoc($actualizar5);
$total55 = mysql_num_rows($actualizar5);
if (0<$total55) {

 do {

echo '<tr>';

if (isset($row_sel15['respuesta_migra'])) {
echo '<td>'.$row_sel15['id_salida_menor'].'</td>';
	} else {
			echo '<td><a href="sal&'.$row_sel15['id_salida_menor'].'.jsp">P '.$row_sel15['id_salida_menor'].'</a></td>';
			}
			
		

	echo '<td>'.$row_sel15['identificador_sm'].'</td>';
	echo '<td>'.$row_sel15['id_notaria'].'</td>';
		echo '<td>'.$row_sel15['fecha_carga'].'</td>';
			echo '<td>'.$row_sel15['respuesta_migra'].'</td>';
			echo '<td>'.$row_sel15['estado_salida_menor'].'</td>';
			echo '<td>'.$row_sel15['actualizacion'].'</td>';
			
			
			echo '<td>';
			
			
if (isset($row_sel15['file_autenticacion']) && file_exists('files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['file_autenticacion'])) {
$valsal=1;
echo '<a href="files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['file_autenticacion'].'" title="Autenticación" download="autenticacion.pdf"><img src="images/pdf.png"> ';
echo round((filesize('files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['file_autenticacion']))/1048576, 2).' Mg / ';
echo pdfVersion('files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['file_autenticacion']);
echo '</a> &nbsp; ';
} else { 
$valsal=0;
echo '<img src="images/notice.png" title="El poder ó E.P. no se adjunto correctamente."> &nbsp; '; }



if (isset($row_sel15['file_civil']) && file_exists('files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['file_civil'])) {
$valsal2=1;
echo '<a href="files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['file_civil'].'" title="Registro civil" download="registro_civil.pdf"><img src="images/pdf.png"> ';
echo round((filesize('files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['file_civil']))/1048576, 2).' Mg / ';
echo pdfVersion('files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['file_civil']);

echo '</a> &nbsp; ';
} else { 
$valsal2=0;
echo '<img src="images/notice.png" title="El registro civil no se adjunto correctamente."> &nbsp; '; }



if (1==$valsal && 1==$valsal2) {
echo '<a href="files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['identificador_sm'].'.pdf" download="Resumen_salida.pdf" title="Resumen de salida"><img src="images/pdf.png">';
echo round((filesize('files/salidas/'.$row_sel15['identificador_sm'].'/'.$row_sel15['identificador_sm'].'.pdf'))/1048576, 2).' Mg';


echo '</a> &nbsp;';


} else { echo '<img src="images/alert.png" title="No fue aceptado por el sistema dado problemas con un adjunto pdf."> &nbsp; '; }



echo '</td>';

		echo '</tr>'; 
 } while ($row_sel15 = mysql_fetch_assoc($actualizar5)); 
 
  mysql_free_result($actualizar5);


echo '</table>';

} else {}

} else {}


?>
</center>
</DIV>
</DIV>

</DIV>

</DIV>


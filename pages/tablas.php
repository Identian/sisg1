	<div class="row">
<div class="col-md-12">
	<div class="box box-info">


 <div class="box-header with-border">
 <h3><center><b>TABLAS</b></center></h3>
                

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

<script type="text/javascript">
function ir(){
var name=document.getElementById('t').value;
 location.href='tablas&'+name+'.jsp'; 
}
</script>



<center>
<?php

if (1==$_SESSION['rol'] or 3184==$_SESSION['snr']) {

if (isset($_GET["i"]) and (""!=$_GET["i"])) {
$table=$_GET["i"];
 } else { $table="area"; } 
 
 

$sql = "SHOW TABLES FROM ".$database_conexion;
$resultado = mysql_query($sql);

echo '<select id="t" name="t" onchange="ir()">';
while ($fila = mysql_fetch_row($resultado)) {
    echo '<option value="'.$fila[0].'" ';
	if ($fila[0]==$table) { echo 'selected'; } else { echo ''; } 
	echo '>'.$fila[0].'</option>';
}
echo '</select>';
mysql_free_result($resultado);


echo '<a href="xlsx/'.$table.'.xls" download="download"> <IMG SRC="images/xls.png">Excel</a>';

 

$output = '<table class="table" style="width:100%;">';
$sql = mysql_query("select * from $table limit 50");
$columns_total = mysql_num_fields($sql);

// Get The Field Name
$output .="<tr align='center' valign='middle'>";
for ($i = 0; $i < $columns_total; $i++) {
$heading = mysql_field_name($sql, $i);
$output .= '<td><b> '.$heading.' </b></td>';
}
$output .="</tr>";

// Get Records from the table

while ($row = mysql_fetch_array($sql)) {
$output .="<tr align='left' valign='middle'>";
for ($i = 0; $i < $columns_total; $i++) {
$output .='<td>'.$row["$i"].'</td>';
}
$output .="</tr>";
}


$output .="</table>";
echo $output;


} else {}


?>
</center>
</DIV>
</DIV>

</DIV>

</DIV>


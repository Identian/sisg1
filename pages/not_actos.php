<?php
if (isset($_GET['i'])) {
$id=$_GET['i'];
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }



if (2>=$_SESSION['rol']) { 


if ((isset($_POST["eo_not_actos"])) && ($_POST["eo_not_actos"] != "")) {
$eo_not_actos=$_POST["eo_not_actos"];
  $updateSQL = sprintf("UPDATE not_actos SET eo_not_actos=%s WHERE id_not_actos=%s and estado_not_actos=1",
  GetSQLValueString($eo_not_actos, "int"),
  GetSQLValueString($id, "int"));
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
}


if ((isset($_POST["agru_not_actos"])) && ($_POST["agru_not_actos"] != "")) {
$agru_not_actos=$_POST["agru_not_actos"];
  $updateSQL = sprintf("UPDATE not_actos SET agru_not_actos=%s WHERE id_not_actos=%s and estado_not_actos=1",
  GetSQLValueString($agru_not_actos, "int"),
  GetSQLValueString($id, "int"));
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
}


if ((isset($_POST["tarifa_not_actos"])) && ($_POST["tarifa_not_actos"] != "")) {
$tarifa_not_actos=$_POST["tarifa_not_actos"];
  $updateSQL = sprintf("UPDATE not_actos SET tarifa_not_actos=%s WHERE id_not_actos=%s and estado_not_actos=1",
  GetSQLValueString($tarifa_not_actos, "text"),
  GetSQLValueString($id, "int"));
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
}


} //cierre ROL

$query = sprintf("SELECT * FROM not_actos, not_actagru where 
                not_actos.agru_not_actos=not_actagru.cod_not_actagru and
                not_actos.id_not_actos='$id' limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($select);



?>  

<div class="row">
<div class="col-md-12">
<div class="box box-info">
<div class="box-header with-border">
  <h3 class="box-title"><strong><a href="not_actos_lis.jsp" style="color:#000;"><button type="button" class="btn btn-secondary btn-lg">Atras</button></a></strong></h3>
<div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
</div>
</div>
     
<div  class="modal-body">

<table class="jona">

 

<tr>
  <td class="jona-0lax"><span style="font-weight:bold">CODIGO DEL ACTO:</span></td>
  <td class="jona-0lax">
   <?php echo htmlentities($row_update['codigo_not_actos'], ENT_COMPAT, '');  ?>
  </td>
</tr>

<tr>
  <td class="jona-0lax"><span style="font-weight:bold">NOMBRE ACTO:</span></td>
  <td class="jona-0lax">
   <?php echo $row_update['nombre_not_actos'];  ?>
  </td>
</tr>

<tr>
  <td class="jona-0lax"><span style="font-weight:bold">LIQUIDACION ACTO:</span></td>
  <td class="jona-0lax">
   <?php echo $row_update['liquidacion_not_actos'];  ?>
  </td>
</tr>

<tr>
  <td class="jona-0lax"><span style="font-weight:bold">ACTO:</span></td>
  <td class="jona-0lax">
   <?php if (2>=$_SESSION['rol']) { ?>
    <form class="navbar-form" name="formeo_not_actos" method="post" action="">
    <div class="input-group">
    <div class="input-group-btn">
    <select name="eo_not_actos" class="form-control" required>
    <?php
    $query = sprintf("SELECT id_not_cso, nombre_not_cso FROM not_cso where estado_not_cso=1 order by nombre_not_cso"); 
    $select = mysql_query($query, $conexion) or die(mysql_error());
    $row = mysql_fetch_assoc($select);
    $totalRows = mysql_num_rows($select);
    if (0<$totalRows){
    do {
      echo '<option value="'.$row['id_not_cso'].'"  ';
      
      if ($row_update['eo_not_actos']==$row['id_not_cso']) { echo 'selected';} else {} 
      
      echo '>'.$row['nombre_not_cso'].'</option>';
       } while ($row = mysql_fetch_assoc($select)); 
    } else {}  
    mysql_free_result($select);
    ?>
    </select>
    </div>
    <div class="input-group-btn">
    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button> 
    </div>
    </div>
    </form>
    <?php } else { } ?>
  </td>
</tr>


<tr>
  <td class="jona-0lax"><span style="font-weight:bold">AGRUPACION:</span></td>
  <td class="jona-0lax">
   <?php if (2>=$_SESSION['rol']) { ?>
    <form class="navbar-form" name="formagru_not_actos" method="post" action="">
    <div class="input-group">
    <div class="input-group-btn">
    <select name="agru_not_actos" class="form-control" required>
    <?php
    $query = sprintf("SELECT id_not_actagru, nombre_not_actagru FROM not_actagru where estado_not_actagru=1 order by nombre_not_actagru"); 
    $select = mysql_query($query, $conexion) or die(mysql_error());
    $row = mysql_fetch_assoc($select);
    $totalRows = mysql_num_rows($select);
    if (0<$totalRows){
    do {
      echo '<option value="'.$row['id_not_actagru'].'"  ';
      
      if ($row_update['agru_not_actos']==$row['id_not_actagru']) { echo 'selected';} else {} 
      
      echo '>'.$row['nombre_not_actagru'].'</option>';
       } while ($row = mysql_fetch_assoc($select)); 
    } else {}  
    mysql_free_result($select);
    ?>
    </select>
    </div>
    <div class="input-group-btn">
    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button> 
    </div>
    </div>
    </form>
    <?php } else { } ?>
  </td>
</tr>


<tr>
  <td class="jona-0lax"><span style="font-weight:bold">TARIFA:</span></td>
  <td class="jona-0lax">
   <?php if (2>=$_SESSION['rol']) { ?>
    <form class="navbar-form" name="formtarifa_not_actos" method="post" action="">
    <div class="input-group">
    <div class="input-group-btn">
       <input type="text" name="tarifa_not_actos" class="form-control" value="<?php echo htmlentities($row_update['tarifa_not_actos'], ENT_COMPAT, '');  ?>" requerid>
    </div>
    <div class="input-group-btn">
    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button> 
    </div>
    </div>
    </form>
    <?php } else { } ?>
  </td>
</tr>


</table>

</div> <!-- modal-body --> 
</div> <!-- box box-info -->
</div> <!-- col-md-12 -->
</div>
  
  
  

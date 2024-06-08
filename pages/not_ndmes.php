<!-- ////////////////////////////////////////////////
        UPDATE P. NOVEDADES DEL MES 
     //////////////////////////////////////////////// -->
<?php
if (isset($_POST['update_not_ndmes'])) {

$updateSQL = sprintf("UPDATE not_ndmes SET 

ndmes_ddp=%s,
ndmes_ddl=%s

where id_not_inf=%s",

GetSQLValueString($_POST["ndmes_ddp"], "text"),
GetSQLValueString($_POST["ndmes_ddl"], "text"),


GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

echo $actualizado;

echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';

} else {}


$query_update = sprintf("SELECT * FROM not_ndmes WHERE id_not_inf = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
?>


<div class="modal fade" id="pop_ndmes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Modificar Novedades del Mes</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form  method="POST" name="not_ndmes">

            <!-- /*=============================================
             =             INSCRIPCION  P. NOVEDADES DEL MES           =
            =============================================*/  -->

            <h5 class="titulos_expensa"><b>P. NOVEDADES DEL MES  </b></h5>  

            <table class="jona">
              <tr>
                <td class="jona-0lax"><span style="font-weight:bold">dias de permiso</span></td>
                <td class="jona-0lax"><input type="number" class="numero" name="ndmes_ddp" value="<?php echo htmlentities($row_update['ndmes_ddp'], ENT_COMPAT, ''); ?>" required/></td>
                <td class="jona-0lax"><span style="font-weight:bold">dias de licencia</span></td>
                <td class="jona-0lax"><input type="number" class="numero" name="ndmes_ddl" value="<?php echo htmlentities($row_update['ndmes_ddl'], ENT_COMPAT, ''); ?>" required/></td>
              <tr>
            </table>
             
<div class="modal-footer">
<button type="button" class="btn btn-default"  data-dismiss="modal">Cancelar</button>
<button type="submit" name="update_not_ndmes" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div> 
</div> 
</div> 
<?php
}

mysql_free_result($update);

?>
<!-- ////////////////////////////////////////////////
       FIN UPDATE  P. NOVEDADES DEL MES 
     //////////////////////////////////////////////// -->

    

          <!-- /*=============================================
          =           P. NOVEDADES DEL MES              =
          =============================================*/  -->
          <?php
          $query = sprintf("SELECT * FROM not_inf, not_ndmes where not_inf.id_not_inf =not_ndmes.id_not_inf  and not_inf.id_not_inf ='$id' LIMIT 1");
          $select = mysql_query($query, $conexion) or die(mysql_error());
          $row_not_ndmes = mysql_fetch_assoc($select);

          $not_ndmes = $row_not_ndmes['not_ndmes'];
          // echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id.'.jsp" />';
          ?>

          <?php
              if (isset($_POST['ingreso_not_ndmes'])) {

              $insertSQL = sprintf("INSERT INTO not_ndmes (
                id_not_inf,
                nombre_not_ndmes,

                ndmes_ddp,
                ndmes_ddl,
                
                estado_not_ndmes,
                fec_ahora_ndmes) VALUES (%s,%s, %s,%s, %s,now())", 
              GetSQLValueString($id, "int"), 
              GetSQLValueString('uno', "text"), 

              GetSQLValueString($_POST["ndmes_ddp"], "int"),
              GetSQLValueString($_POST["ndmes_ddl"], "int"),


              GetSQLValueString(1, "int")); 
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $insertado;

              echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';            

              } else {}

              $updateSQL2 = sprintf("UPDATE not_inf SET not_ndmes=1  where id_not_inf='$id'");
              $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());

              ?>


           <?php // ESTADO PARA FIJAR SI YA HAY P. NOVEDADES DEL MES 
            if ($not_ndmes==0){  
            ?>
            
            <form  method="POST" name="ingreso_not_ndmes">

                  <h5 class="titulos_expensa"><b> P. NOVEDADES DEL MES</b></h5>  

                  <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">dias de permiso</span></td>
                      <td class="jona-0lax"><input type="number" class="numero" name="ndmes_ddp" required/></td>
                      <td class="jona-0lax"><span style="font-weight:bold">dias de licencia</span></td>
                      <td class="jona-0lax"><input type="number" class="numero" name="ndmes_ddl" required/></td>
                    <tr>
                  </table>
                 
                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_ndmes" class="btn btn-success">Guardar</button>
                </div>
            </form>

            <?php }else{ ?>
              
              <h5 class="titulos_expensa"><b>P. NOVEDADES DEL MES</b>
              <?php if ($estado==0 or $_SESSION['rol']==1) {  ?> 
                <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_ndmes"  title="MODIFICAR N. DETALLE GASTOS DE INVERSION"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a>
              <?php } else {} ?>
              </h5>

                <table class="jona">
                  <tr>
                    <td class="jona-0lax"><span style="font-weight:bold">dias de permiso</span></td>
                    <td class="jona-0lax"><?php echo $row_not_ndmes['ndmes_ddp'] ?></td>
                    <td class="jona-0lax"><span style="font-weight:bold">dias de licencia</span></td>
                    <td class="jona-0lax"><?php echo $row_not_ndmes['ndmes_ddl'] ?></td>
                  <tr>
                </table>

           <?php } ?>
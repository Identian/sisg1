<!-- ////////////////////////////////////////////////
        UPDATE N. DETALLE GASTOS DE INVERSION
     //////////////////////////////////////////////// -->
<?php
if (isset($_POST['update_not_dgdi'])) {

$updateSQL = sprintf("UPDATE not_dgdi SET 

dgdi_inyl=%s,
dgdi_siyt=%s,
dgdi_capa=%s

where id_not_inf=%s",

GetSQLValueString($_POST["dgdi_inyl"], "text"),
GetSQLValueString($_POST["dgdi_siyt"], "text"),
GetSQLValueString($_POST["dgdi_capa"], "text"),


GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

echo $actualizado;

echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';

} else {}


$query_update = sprintf("SELECT * FROM not_dgdi WHERE id_not_inf = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
?>


<div class="modal fade" id="pop_dgdi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Modificar Detalle Gastos de Inversion</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form  method="POST" name="not_dgdi">

            <!-- /*=============================================
             =             INSCRIPCION  N. DETALLE GASTOS DE INVERSION          =
            =============================================*/  -->

             <h5 class="titulos_expensa"><b>N. DETALLE GASTOS DE INVERSION </b></h5>  

              <table class="jona">
                <tr>
                  <td class="jona-0lax"><span style="font-weight:bold">infraestructura y locativos</span></td>
                  <td class="jona-0lax">
                    <input type="text" class="63not"  value="<?php echo htmlentities($row_update['dgdi_inyl'], ENT_COMPAT, ''); ?>" required/>
                    <input type="hidden" id="num63not" name="dgdi_inyl" value="<?php echo htmlentities($row_update['dgdi_inyl'], ENT_COMPAT, ''); ?>" ></td>
                <tr>
                  <td class="jona-0lax"><span style="font-weight:bold">sistema y tecnologia</span></td>
                  <td class="jona-0lax">
                    <input type="text" class="64not"  value="<?php echo htmlentities($row_update['dgdi_siyt'], ENT_COMPAT, ''); ?>" required/>
                    <input type="hidden" id="num64not" name="dgdi_siyt" value="<?php echo htmlentities($row_update['dgdi_siyt'], ENT_COMPAT, ''); ?>" >
                  </td>
                </tr>
                <tr>
                  <td class="jona-0lax"><span style="font-weight:bold">capacitacion</span></td>
                  <td class="jona-0lax">
                    <input type="text" class="65not"  value="<?php echo htmlentities($row_update['dgdi_capa'], ENT_COMPAT, ''); ?>" required/>
                    <input type="hidden" id="num65not" name="dgdi_capa" value="<?php echo htmlentities($row_update['dgdi_capa'], ENT_COMPAT, ''); ?>" >
                  </td>
                </tr>
              </table>
             
<div class="modal-footer">
<button type="button" class="btn btn-default"  data-dismiss="modal">Cancelar</button>
<button type="submit" name="update_not_dgdi" class="btn btn-success">Guardar</button>
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
       FIN UPDATE  N. DETALLE GASTOS DE INVERSION
     //////////////////////////////////////////////// -->

    

          <!-- /*=============================================
          =           N. DETALLE GASTOS DE INVERSION             =
          =============================================*/  -->
          <?php
          $query = sprintf("SELECT * FROM not_inf, not_dgdi where not_inf.id_not_inf =not_dgdi.id_not_inf  and not_inf.id_not_inf ='$id' LIMIT 1");
          $select = mysql_query($query, $conexion) or die(mysql_error());
          $row_not_dgdi = mysql_fetch_assoc($select);

          $not_dgdi = $row_not_dgdi['not_dgdi'];
          // echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id.'.jsp" />';
          ?>

          <?php
              if (isset($_POST['ingreso_not_dgdi'])) {

              $insertSQL = sprintf("INSERT INTO not_dgdi (
                id_not_inf,
                nombre_not_dgdi,

                dgdi_inyl,
                dgdi_siyt,
                dgdi_capa,
                
                estado_not_dgdi,
                fec_ahora_dgdi) VALUES (%s,%s, %s,%s,%s, %s,now())", 
              GetSQLValueString($id, "int"), 
              GetSQLValueString('uno', "text"), 

              GetSQLValueString($_POST["dgdi_inyl"], "text"),
              GetSQLValueString($_POST["dgdi_siyt"], "text"),
              GetSQLValueString($_POST["dgdi_capa"], "text"),


              GetSQLValueString(1, "int")); 
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $insertado;

              echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';            

              } else {}

              $updateSQL2 = sprintf("UPDATE not_inf SET not_dgdi=1  where id_not_inf='$id'");
              $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());

              ?>


           <?php // ESTADO PARA FIJAR SI YA HAY UN INGRESO APORTES
            if ($not_dgdi==0){  
            ?>
            
            <form  method="POST" name="ingreso_not_dgdi">

                  <h5 class="titulos_expensa"><b> N. DETALLE GASTOS DE INVERSION</b></h5>  

                  <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">infraestructura y locativos</span></td>
                      <td class="jona-0lax"><input type="text" class="63not" required/><input type="hidden" id="num63not" name="dgdi_inyl"></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">sistema y tecnologia</span></td>
                      <td class="jona-0lax"><input type="text" class="64not" required/><input type="hidden" id="num64not" name="dgdi_siyt"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">capacitacion</span></td>
                      <td class="jona-0lax"><input type="text" class="65not" required/><input type="hidden" id="num65not" name="dgdi_capa"></td>
                    </tr>
                  </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_dgdi" class="btn btn-success">Guardar</button>
                </div>
            </form>

            <?php }else{ ?>
              
              <h5 class="titulos_expensa"><b>N. DETALLE GASTOS DE INVERSION</b>
              <?php if ($estado==0 or $_SESSION['rol']==1) {  ?> 
                <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_dgdi"  title="MODIFICAR N. DETALLE GASTOS DE INVERSION"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a>
              <?php } else {} ?>
              </h5>

                   <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">infraestructura y locativos</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdi['dgdi_inyl'],2,",",".") ?></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">sistema y tecnologia</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdi['dgdi_siyt'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">capacitacion</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdi['dgdi_capa'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">TOTAL</span></td>
                      <?php $totaldgdi=$row_not_dgdi['dgdi_inyl']+$row_not_dgdi['dgdi_siyt']+$row_not_dgdi['dgdi_capa'];?>
                      <td class="jona-0lax"><b><?php echo '$ '.number_format((float)$totaldgdi,2,",",".") ?></b></td>
                    </tr>
                  </table>

           <?php } ?>
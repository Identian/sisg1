<!-- ////////////////////////////////////////////////
        UPDATE M. DETALLE TRANSFERENCIAS
     //////////////////////////////////////////////// -->
<?php
if (isset($_POST['update_not_dt'])) {

$updateSQL = sprintf("UPDATE not_dt SET 

dt_cdc=%s,
dt_sena=%s,
dt_icbf=%s,
dt_epss=%s,
dt_fadp=%s,
dt_arpr=%s,
dt_agre=%s,
dt_addj=%s,
dt_cdrc=%s,
dt_otro=%s

where id_not_inf=%s",

GetSQLValueString($_POST["dt_cdc"], "text"),
GetSQLValueString($_POST["dt_sena"], "text"),
GetSQLValueString($_POST["dt_icbf"], "text"),
GetSQLValueString($_POST["dt_epss"], "text"),
GetSQLValueString($_POST["dt_fadp"], "text"),
GetSQLValueString($_POST["dt_arpr"], "text"),
GetSQLValueString($_POST["dt_agre"], "text"),
GetSQLValueString($_POST["dt_addj"], "text"),
GetSQLValueString($_POST["dt_cdrc"], "text"),
GetSQLValueString($_POST["dt_otro"], "text"),


GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

echo $actualizado;

echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';

} else {}


$query_update = sprintf("SELECT * FROM not_dt WHERE id_not_inf = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
?>


<div class="modal fade" id="pop_dt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Modificar Detalle Transferencias</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form  method="POST" name="not_dt">

            <!-- /*=============================================
             =             INSCRIPCION  M. DETALLE TRANSFERENCIAS           =
            =============================================*/  -->

             <h5 class="titulos_expensa"><b>M. DETALLE TRANSFERENCIAS </b></h5>  

             <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">caja de compensacion</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="53not"  value="<?php echo htmlentities($row_update['dt_cdc'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num53not" name="dt_cdc" value="<?php echo htmlentities($row_update['dt_cdc'], ENT_COMPAT, ''); ?>" ></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">sena</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="54not"  value="<?php echo htmlentities($row_update['dt_sena'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num54not" name="dt_sena" value="<?php echo htmlentities($row_update['dt_sena'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">icbf</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="55not"  value="<?php echo htmlentities($row_update['dt_icbf'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num55not" name="dt_icbf" value="<?php echo htmlentities($row_update['dt_icbf'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">eps salud</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="56not"  value="<?php echo htmlentities($row_update['dt_epss'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num56not" name="dt_epss" value="<?php echo htmlentities($row_update['dt_epss'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">fondo administracion de pensiones</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="57not"  value="<?php echo htmlentities($row_update['dt_fadp'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num57not" name="dt_fadp" value="<?php echo htmlentities($row_update['dt_fadp'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">arp riesgos profesionales</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="58not"  value="<?php echo htmlentities($row_update['dt_arpr'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num58not" name="dt_arpr" value="<?php echo htmlentities($row_update['dt_arpr'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">agremiaciones</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="59not"  value="<?php echo htmlentities($row_update['dt_agre'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num59not" name="dt_agre" value="<?php echo htmlentities($row_update['dt_agre'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">administracion de justicia (ley 6/1992)</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="60not"  value="<?php echo htmlentities($row_update['dt_addj'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num60not" name="dt_addj" value="<?php echo htmlentities($row_update['dt_addj'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">copias de registro civil 10%</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="61not"  value="<?php echo htmlentities($row_update['dt_cdrc'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num61not" name="dt_cdrc" value="<?php echo htmlentities($row_update['dt_cdrc'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Otros</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="62not"  value="<?php echo htmlentities($row_update['dt_otro'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num62not" name="dt_otro" value="<?php echo htmlentities($row_update['dt_otro'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                  </table>
             
<div class="modal-footer">
<button type="button" class="btn btn-default"  data-dismiss="modal">Cancelar</button>
<button type="submit" name="update_not_dt" class="btn btn-success">Guardar</button>
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
       FIN UPDATE  M. DETALLE TRANSFERENCIAS 
     //////////////////////////////////////////////// -->

    

          <!-- /*=============================================
          =           M. DETALLE TRANSFERENCIAS              =
          =============================================*/  -->
          <?php
          $query = sprintf("SELECT * FROM not_inf, not_dt where not_inf.id_not_inf =not_dt.id_not_inf  and not_inf.id_not_inf ='$id' LIMIT 1");
          $select = mysql_query($query, $conexion) or die(mysql_error());
          $row_not_dt = mysql_fetch_assoc($select);

          $not_dt = $row_not_dt['not_dt'];
          // echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id.'.jsp" />';
          ?>

          <?php
              if (isset($_POST['ingreso_not_dt'])) {

              $insertSQL = sprintf("INSERT INTO not_dt (
                id_not_inf,
                nombre_not_dt,

                dt_cdc,
                dt_sena,
                dt_icbf,
                dt_epss,
                dt_fadp,
                dt_arpr,
                dt_agre,
                dt_addj,
                dt_cdrc,
                dt_otro,
                
                estado_not_dt,
                fec_ahora_dt) VALUES (%s,%s, %s,%s,%s,%s,%s,%s,%s,%s,%s,%s, %s,now())", 
              GetSQLValueString($id, "int"), 
              GetSQLValueString('uno', "text"), 

              GetSQLValueString($_POST["dt_cdc"], "text"),
              GetSQLValueString($_POST["dt_sena"], "text"),
              GetSQLValueString($_POST["dt_icbf"], "text"),
              GetSQLValueString($_POST["dt_epss"], "text"),
              GetSQLValueString($_POST["dt_fadp"], "text"),
              GetSQLValueString($_POST["dt_arpr"], "text"),
              GetSQLValueString($_POST["dt_agre"], "text"),
              GetSQLValueString($_POST["dt_addj"], "text"),
              GetSQLValueString($_POST["dt_cdrc"], "text"),
              GetSQLValueString($_POST["dt_otro"], "text"),


              GetSQLValueString(1, "int")); 
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $insertado;

              echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';            

              } else {}

              $updateSQL2 = sprintf("UPDATE not_inf SET not_dt=1  where id_not_inf='$id'");
              $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());

              ?>


           <?php // ESTADO PARA FIJAR SI YA HAY UN INGRESO APORTES
            if ($not_dt==0){  
            ?>
            
            <form  method="POST" name="ingreso_not_dt">

                  <h5 class="titulos_expensa"><b> M. DETALLE TRANSFERENCIAS</b></h5>  

                  <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">caja de compensacion</span></td>
                      <td class="jona-0lax"><input type="text" class="53not" required/><input type="hidden" id="num53not" name="dt_cdc"></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">sena</span></td>
                      <td class="jona-0lax"><input type="text" class="54not" required/><input type="hidden" id="num54not" name="dt_sena"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">icbf</span></td>
                      <td class="jona-0lax"><input type="text" class="55not" required/><input type="hidden" id="num55not" name="dt_icbf"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">eps salud</span></td>
                      <td class="jona-0lax"><input type="text" class="56not" required/><input type="hidden" id="num56not" name="dt_epss"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">fondo administracion de pensiones</span></td>
                      <td class="jona-0lax"><input type="text" class="57not" required/><input type="hidden" id="num57not" name="dt_fadp"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">arp riesgos profesionales</span></td>
                      <td class="jona-0lax"><input type="text" class="58not" required/><input type="hidden" id="num58not" name="dt_arpr"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">agremiaciones</span></td>
                      <td class="jona-0lax"><input type="text" class="59not" required/><input type="hidden" id="num59not" name="dt_agre"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">administracion de justicia (ley 6/1992)</span></td>
                      <td class="jona-0lax"><input type="text" class="60not" required/><input type="hidden" id="num60not" name="dt_addj"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">copias de registro civil 10%</span></td>
                      <td class="jona-0lax"><input type="text" class="61not" required/><input type="hidden" id="num61not" name="dt_cdrc"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">otros</span></td>
                      <td class="jona-0lax"><input type="text" class="62not" required/><input type="hidden" id="num62not" name="dt_otro"></td>
                    </tr>
                  </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_dt" class="btn btn-success">Guardar</button>
                </div>
            </form>

            <?php }else{ ?>
              
              <h5 class="titulos_expensa"><b>M. DETALLE TRANSFERENCIAS</b>
              <?php if ($estado==0 or $_SESSION['rol']==1) {  ?> 
                <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_dt"  title="MODIFICAR M. DETALLE TRANSFERENCIAS"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a>
              <?php } else {} ?>
              </h5>

                   <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">caja de compensacion</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_cdc'],2,",",".") ?></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">sena</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_sena'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">icbf</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_icbf'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">esp salud</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_epss'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">fondo administracion de pensiones  </span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_fadp'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">arp riesgos profesionales</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_arpr'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">agremiaciones</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_agre'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">administracion de justicia (ley 6/1992)</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_addj'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">copias de registro civil 10%</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_cdrc'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">otros</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dt['dt_otro'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">TOTAL</span></td>
                      <?php $totaldt=0+$row_not_dt['dt_cdc']+$row_not_dt['dt_sena']+$row_not_dt['dt_icbf']+$row_not_dt['dt_epss']+$row_not_dt['dt_fadp']+$row_not_dt['dt_arpr']+$row_not_dt['dt_agre']+$row_not_dt['dt_addj']+$row_not_dt['dt_cdrc']+$row_not_dt['dt_otro'];?>
                      <td class="jona-0lax"><b><?php echo '$ '.number_format((float)$totaldt,2,",",".") ?></b></td>
                    </tr>
                  </table>

           <?php } ?>
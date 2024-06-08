<!-- ////////////////////////////////////////////////
        UPDATE  K. DETALLES GASTOS DE PERSONAL 
     //////////////////////////////////////////////// -->
<?php
if (isset($_POST['update_not_dgdper'])) {

$updateSQL = sprintf("UPDATE not_dgdper SET 

dgdper_nedpsian=%s,
dgdper_net=%s,

dgdper_sdle=%s,
dgdper_sdt=%s,
dgdper_cesantias=%s,
dgdper_primas=%s,
dgdper_vaca=%s,
dgdper_hono=%s,
dgdper_otros=%s

where id_not_inf=%s",
GetSQLValueString($_POST["dgdper_nedpsian"], "int"),
GetSQLValueString($_POST["dgdper_net"], "int"),

GetSQLValueString($_POST["dgdper_sdle"], "text"),
GetSQLValueString($_POST["dgdper_sdt"], "text"),
GetSQLValueString($_POST["dgdper_cesantias"], "text"),
GetSQLValueString($_POST["dgdper_primas"], "text"),
GetSQLValueString($_POST["dgdper_vaca"], "text"),
GetSQLValueString($_POST["dgdper_hono"], "text"),
GetSQLValueString($_POST["dgdper_otros"], "text"),

GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

echo $actualizado;

echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';

} else {}


$query_update = sprintf("SELECT * FROM not_dgdper WHERE id_not_inf = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
?>


<div class="modal fade" id="pop_dgdper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Modificar Detalles Gastos de Personal</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form  method="POST" name="not_dgdper">

            <!-- /*=============================================
             =             INSCRIPCION  K. DETALLES GASTOS DE PERSONAL             =
            =============================================*/  -->

             <h5 class="titulos_expensa"><b>K. DETALLES GASTOS DE PERSONAL</b></h5>  

             <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">No. Empleados de Planta sin Incluir al Notario</span></td>
                      <td class="jona-0lax"><input type="number" class="inputexpensan numero" name="dgdper_nedpsian" value="<?php echo htmlentities($row_update['dgdper_nedpsian'], ENT_COMPAT, ''); ?>"required/></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">No. empleados temporales</span></td>
                      <td class="jona-0lax"><input type="number" class="inputexpensan numero" name="dgdper_net" value="<?php echo htmlentities($row_update['dgdper_net'], ENT_COMPAT, ''); ?>"required/></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">salarios de los empleados</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="37not"  value="<?php echo htmlentities($row_update['dgdper_sdle'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num37not" name="dgdper_sdle" value="<?php echo htmlentities($row_update['dgdper_sdle'], ENT_COMPAT, ''); ?>" ></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Subsidios de Transporte</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="38not"  value="<?php echo htmlentities($row_update['dgdper_sdt'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num38not" name="dgdper_sdt" value="<?php echo htmlentities($row_update['dgdper_sdt'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Censantias</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="39not"  value="<?php echo htmlentities($row_update['dgdper_cesantias'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num39not" name="dgdper_cesantias" value="<?php echo htmlentities($row_update['dgdper_cesantias'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Primas</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="40not"  value="<?php echo htmlentities($row_update['dgdper_primas'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num40not" name="dgdper_primas" value="<?php echo htmlentities($row_update['dgdper_primas'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Vacaciones</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="41not"  value="<?php echo htmlentities($row_update['dgdper_vaca'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num41not" name="dgdper_vaca" value="<?php echo htmlentities($row_update['dgdper_vaca'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Honorarios</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="42not"  value="<?php echo htmlentities($row_update['dgdper_hono'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num42not" name="dgdper_hono" value="<?php echo htmlentities($row_update['dgdper_hono'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Otros</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="43not"  value="<?php echo htmlentities($row_update['dgdper_otros'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num43not" name="dgdper_otros" value="<?php echo htmlentities($row_update['dgdper_otros'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                  </table>
             
<div class="modal-footer">
<button type="button" class="btn btn-default"  data-dismiss="modal">Cancelar</button>
<button type="submit" name="update_not_dgdper" class="btn btn-success">Guardar</button>
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
       FIN UPDATE  K. DETALLES GASTOS DE PERSONAL 
     //////////////////////////////////////////////// -->

    

          <!-- /*=============================================
          =            K. DETALLES GASTOS DE PERSONAL              =
          =============================================*/  -->
          <?php
          $query = sprintf("SELECT * FROM not_inf, not_dgdper where not_inf.id_not_inf =not_dgdper.id_not_inf  and not_inf.id_not_inf ='$id' LIMIT 1");
          $select = mysql_query($query, $conexion) or die(mysql_error());
          $row_not_dgdper = mysql_fetch_assoc($select);

          $not_dgdper = $row_not_dgdper['not_dgdper'];          
          ?>

          <?php
              if (isset($_POST['ingreso_not_dgdper'])) {

              $insertSQL = sprintf("INSERT INTO not_dgdper (
                id_not_inf,
                nombre_not_dgdper,

                dgdper_nedpsian,
                dgdper_net,

                dgdper_sdle,
                dgdper_sdt,
                dgdper_cesantias,
                dgdper_primas,
                dgdper_vaca,
                dgdper_hono,
                dgdper_otros,
                
                estado_not_dgdper,
                fec_ahora_dgdper) VALUES (%s,%s, %s,%s, %s,%s,%s,%s,%s,%s,%s, %s,now())", 
              GetSQLValueString($id, "int"), 
              GetSQLValueString('uno', "text"), 

              GetSQLValueString($_POST["dgdper_nedpsian"], "int"),
              GetSQLValueString($_POST["dgdper_net"], "int"),

              GetSQLValueString($_POST["dgdper_sdle"], "text"),
              GetSQLValueString($_POST["dgdper_sdt"], "text"),
              GetSQLValueString($_POST["dgdper_cesantias"], "text"),
              GetSQLValueString($_POST["dgdper_primas"], "text"),
              GetSQLValueString($_POST["dgdper_vaca"], "text"),
              GetSQLValueString($_POST["dgdper_hono"], "text"),
              GetSQLValueString($_POST["dgdper_otros"], "text"),

              GetSQLValueString(1, "int")); 
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $insertado;

              echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';            

              } else {}

              $updateSQL2 = sprintf("UPDATE not_inf SET not_dgdper=1  where id_not_inf='$id'");
              $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());

              ?>


           <?php // ESTADO PARA FIJAR SI YA HAY UN INGRESO APORTES
            if ($not_dgdper==0){  
            ?>
            
            <form  method="POST" name="ingreso_not_dgdper">

                  <h5 class="titulos_expensa"><b> K. DETALLES GASTOS DE PERSONAL </b></h5>  

                  <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">No. Empleados de Planta sin Incluir al Notario</span></td>
                      <td class="jona-0lax"><input type="number" class="inputexpensan numero" name="dgdper_nedpsian" required value=""/></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">No. empleados temporales</span></td>
                      <td class="jona-0lax"><input type="number" class="inputexpensan numero" name="dgdper_net" required value=""/></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">salarios de los empleados</span></td>
                      <td class="jona-0lax"><input type="text" class="37not" required/><input type="hidden" id="num37not" name="dgdper_sdle"></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Subsidios de Transporte</span></td>
                      <td class="jona-0lax"><input type="text" class="38not" required/><input type="hidden" id="num38not" name="dgdper_sdt"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Censantias</span></td>
                      <td class="jona-0lax"><input type="text" class="39not" required/><input type="hidden" id="num39not" name="dgdper_cesantias"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Primas</span></td>
                      <td class="jona-0lax"><input type="text" class="40not" required/><input type="hidden" id="num40not" name="dgdper_primas"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Vacaciones</span></td>
                      <td class="jona-0lax"><input type="text" class="41not" required/><input type="hidden" id="num41not" name="dgdper_vaca"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Honorarios</span></td>
                      <td class="jona-0lax"><input type="text" class="42not" required/><input type="hidden" id="num42not" name="dgdper_hono"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Otros</span></td>
                      <td class="jona-0lax"><input type="text" class="43not" required/><input type="hidden" id="num43not" name="dgdper_otros"></td>
                    </tr>
                  </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_dgdper" class="btn btn-success">Guardar</button>
                </div>
            </form>

            <?php }else{ ?>
              
              <h5 class="titulos_expensa"><b>K. DETALLES GASTOS DE PERSONAL</b>
              <?php if ($estado==0 or $_SESSION['rol']==1) {  ?> 
                <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_dgdper"  title="Modificar DETALLES DE INSCRIPCIONES EN EL REGISTRO CIVIL"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a>
              <?php } else {} ?>
              </h5>

                  <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">No. Empleados de Planta sin Incluir al Notario</span></td>
                      <td class="jona-0lax"><?php echo $row_not_dgdper['dgdper_nedpsian'] ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">No. empleados temporales</span></td>
                      <td class="jona-0lax"><?php echo $row_not_dgdper['dgdper_net'] ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">TOTAL EMPLEADOS</span></td>
                      <?php $totaldgdperem=$row_not_dgdper['dgdper_nedpsian']+$row_not_dgdper['dgdper_net'];?>
                      <td class="jona-0lax"><b><?php echo $totaldgdperem; ?></b></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">salarios de los empleados</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdper['dgdper_sdle'],2,",",".") ?></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Subsidios de Transporte</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdper['dgdper_sdt'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Censantias</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdper['dgdper_cesantias'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Primas</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdper['dgdper_primas'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Vacaciones</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdper['dgdper_vaca'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Honorarios</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdper['dgdper_hono'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Otros</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgdper['dgdper_otros'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">TOTAL</span></td>
                      <?php $totaldgdper=$row_not_dgdper['dgdper_sdle']+$row_not_dgdper['dgdper_sdt']+$row_not_dgdper['dgdper_cesantias']+$row_not_dgdper['dgdper_primas']+$row_not_dgdper['dgdper_vaca']+$row_not_dgdper['dgdper_hono']+$row_not_dgdper['dgdper_otros'];?>
                      <td class="jona-0lax"><b><?php echo '$ '.number_format((float)$totaldgdper,2,",",".") ?></b></td>
                    </tr>
                  </table>

           <?php } ?>
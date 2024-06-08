<!-- ////////////////////////////////////////////////
        UPDATE L. DETALLE GASTOS GENERALES
     //////////////////////////////////////////////// -->
<?php
if (isset($_POST['update_not_dgg'])) {

$updateSQL = sprintf("UPDATE not_dgg SET 

dgg_finan=%s,
dgg_mante=%s,
dgg_arren=%s,
dgg_serpu=%s,
dgg_segur=%s,
dgg_utypa=%s,
dgg_empal=%s,
dgg_biene=%s,
dgg_otros=%s


where id_not_inf=%s",

GetSQLValueString($_POST["dgg_finan"], "text"),
GetSQLValueString($_POST["dgg_mante"], "text"),
GetSQLValueString($_POST["dgg_arren"], "text"),
GetSQLValueString($_POST["dgg_serpu"], "text"),
GetSQLValueString($_POST["dgg_segur"], "text"),
GetSQLValueString($_POST["dgg_utypa"], "text"),
GetSQLValueString($_POST["dgg_empal"], "text"),
GetSQLValueString($_POST["dgg_biene"], "text"),
GetSQLValueString($_POST["dgg_otros"], "text"),


GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

echo $actualizado;

echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';

} else {}


$query_update = sprintf("SELECT * FROM not_dgg WHERE id_not_inf = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
?>


<div class="modal fade" id="pop_dgg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Modificar Detalles Gastos Generales</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form  method="POST" name="not_dgg">

            <!-- /*=============================================
             =             INSCRIPCION  L. DETALLE GASTOS GENERALES            =
            =============================================*/  -->

             <h5 class="titulos_expensa"><b>L. DETALLE GASTOS GENERALES</b></h5>  

             <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Financieros</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="44not"  value="<?php echo htmlentities($row_update['dgg_finan'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num44not" name="dgg_finan" value="<?php echo htmlentities($row_update['dgg_finan'], ENT_COMPAT, ''); ?>" ></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Mantenimiento de Equipos</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="45not"  value="<?php echo htmlentities($row_update['dgg_mante'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num45not" name="dgg_mante" value="<?php echo htmlentities($row_update['dgg_mante'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Arrendamientos</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="46not"  value="<?php echo htmlentities($row_update['dgg_arren'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num46not" name="dgg_arren" value="<?php echo htmlentities($row_update['dgg_arren'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Servicios Publicos</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="47not"  value="<?php echo htmlentities($row_update['dgg_serpu'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num47not" name="dgg_serpu" value="<?php echo htmlentities($row_update['dgg_serpu'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Seguros</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="48not"  value="<?php echo htmlentities($row_update['dgg_segur'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num48not" name="dgg_segur" value="<?php echo htmlentities($row_update['dgg_segur'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Utiles Y Papeleria</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="49not"  value="<?php echo htmlentities($row_update['dgg_utypa'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num49not" name="dgg_utypa" value="<?php echo htmlentities($row_update['dgg_utypa'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Empaste Libros</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="50not"  value="<?php echo htmlentities($row_update['dgg_empal'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num50not" name="dgg_empal" value="<?php echo htmlentities($row_update['dgg_empal'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Bienestar</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="51not"  value="<?php echo htmlentities($row_update['dgg_biene'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num51not" name="dgg_biene" value="<?php echo htmlentities($row_update['dgg_biene'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Otros</span></td>
                      <td class="jona-0lax">
                        <input type="text" class="52not"  value="<?php echo htmlentities($row_update['dgg_otros'], ENT_COMPAT, ''); ?>" required/>
                        <input type="hidden" id="num52not" name="dgg_otros" value="<?php echo htmlentities($row_update['dgg_otros'], ENT_COMPAT, ''); ?>" >
                      </td>
                    </tr>
                  </table>
             
<div class="modal-footer">
<button type="button" class="btn btn-default"  data-dismiss="modal">Cancelar</button>
<button type="submit" name="update_not_dgg" class="btn btn-success">Guardar</button>
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
          $query = sprintf("SELECT * FROM not_inf, not_dgg where not_inf.id_not_inf =not_dgg.id_not_inf  and not_inf.id_not_inf ='$id' LIMIT 1");
          $select = mysql_query($query, $conexion) or die(mysql_error());
          $row_not_dgg = mysql_fetch_assoc($select);

          $not_dgg = $row_not_dgg['not_dgg'];
          // echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id.'.jsp" />';
          ?>

          <?php
              if (isset($_POST['ingreso_not_dgg'])) {

              $insertSQL = sprintf("INSERT INTO not_dgg (
                id_not_inf,
                nombre_not_dgg,

                dgg_finan,
                dgg_mante,
                dgg_arren,
                dgg_serpu,
                dgg_segur,
                dgg_utypa,
                dgg_empal,
                dgg_biene,
                dgg_otros,
                
                estado_not_dgg,
                fec_ahora_dgg) VALUES (%s,%s, %s,%s,%s,%s,%s,%s,%s,%s,%s, %s,now())", 
              GetSQLValueString($id, "int"), 
              GetSQLValueString('uno', "text"), 

              GetSQLValueString($_POST["dgg_finan"], "text"),
              GetSQLValueString($_POST["dgg_mante"], "text"),
              GetSQLValueString($_POST["dgg_arren"], "text"),
              GetSQLValueString($_POST["dgg_serpu"], "text"),
              GetSQLValueString($_POST["dgg_segur"], "text"),
              GetSQLValueString($_POST["dgg_utypa"], "text"),
              GetSQLValueString($_POST["dgg_empal"], "text"),
              GetSQLValueString($_POST["dgg_biene"], "text"),
              GetSQLValueString($_POST["dgg_otros"], "text"),


              GetSQLValueString(1, "int")); 
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $insertado;

              echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';            

              } else {}

              $updateSQL2 = sprintf("UPDATE not_inf SET not_dgg=1  where id_not_inf='$id'");
              $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());

              ?>


           <?php // ESTADO PARA FIJAR SI YA HAY UN INGRESO APORTES
            if ($not_dgg==0){  
            ?>
            
            <form  method="POST" name="ingreso_not_dgg">

                  <h5 class="titulos_expensa"><b> L. DETALLE GASTOS GENERALES </b></h5>  

                  <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Financieros</span></td>
                      <td class="jona-0lax"><input type="text" class="44not" required/><input type="hidden" id="num44not" name="dgg_finan"></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Mantenimiento de Equipos</span></td>
                      <td class="jona-0lax"><input type="text" class="45not" required/><input type="hidden" id="num45not" name="dgg_mante"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Arrendamientos</span></td>
                      <td class="jona-0lax"><input type="text" class="46not" required/><input type="hidden" id="num46not" name="dgg_arren"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">servicios publicos</span></td>
                      <td class="jona-0lax"><input type="text" class="47not" required/><input type="hidden" id="num47not" name="dgg_serpu"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">seguros</span></td>
                      <td class="jona-0lax"><input type="text" class="48not" required/><input type="hidden" id="num48not" name="dgg_segur"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">utiles y papeleria</span></td>
                      <td class="jona-0lax"><input type="text" class="49not" required/><input type="hidden" id="num49not" name="dgg_utypa"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">empaste libros</span></td>
                      <td class="jona-0lax"><input type="text" class="50not" required/><input type="hidden" id="num50not" name="dgg_empal"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">bienestar</span></td>
                      <td class="jona-0lax"><input type="text" class="51not" required/><input type="hidden" id="num51not" name="dgg_biene"></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Otros</span></td>
                      <td class="jona-0lax"><input type="text" class="52not" required/><input type="hidden" id="num52not" name="dgg_otros"></td>
                    </tr>
                  </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_dgg" class="btn btn-success">Guardar</button>
                </div>
            </form>

            <?php }else{ ?>
              
              <h5 class="titulos_expensa"><b>L. DETALLE GASTOS GENERALES</b>
              <?php if ($estado==0 or $_SESSION['rol']==1) {  ?> 
                <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_dgg"  title="Modificar DETALLES DE INSCRIPCIONES EN EL REGISTRO CIVIL"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a>
              <?php } else {} ?>
              </h5>

                   <table class="jona">
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Financieros</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgg['dgg_finan'],2,",",".") ?></td>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Mantenimiento de Equipos</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgg['dgg_mante'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Arrendamientos</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgg['dgg_arren'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">servicios publicos</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgg['dgg_serpu'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">seguros</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgg['dgg_segur'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">utiles y papeleria</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgg['dgg_utypa'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">empaste libros</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgg['dgg_empal'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">bienestar</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgg['dgg_biene'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">Otros</span></td>
                      <td class="jona-0lax"><?php echo '$ '.number_format((float)$row_not_dgg['dgg_otros'],2,",",".") ?></td>
                    </tr>
                    <tr>
                      <td class="jona-0lax"><span style="font-weight:bold">TOTAL</span></td>
                      <?php $totaldgg=0+$row_not_dgg['dgg_finan']+$row_not_dgg['dgg_mante']+$row_not_dgg['dgg_arren']+$row_not_dgg['dgg_serpu']+$row_not_dgg['dgg_segur']+$row_not_dgg['dgg_utypa']+$row_not_dgg['dgg_empal']+$row_not_dgg['dgg_biene']+$row_not_dgg['dgg_otros'];?>
                      <td class="jona-0lax"><b><?php echo '$ '.number_format((float)$totaldgg,2,",",".") ?></b></td>
                    </tr>
                  </table>

           <?php } ?>
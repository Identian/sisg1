<!-- ////////////////////////////////////////////////
        UPDATE  O. DETALLE DE LOS GASTOS A LA DIAN  
     //////////////////////////////////////////////// -->
<?php
if (isset($_POST['update_not_dlpdian'])) {

$updateSQL = sprintf("UPDATE not_dlpdian SET 

dlpdian_ivav=%s,
dlpdian_ivfp=%s,
dlpdian_iini=%s,
dlpdian_ifin=%s,

dlpdian_refv=%s,
dlpdian_refp=%s,
dlpdian_rini=%s,
dlpdian_rfin=%s,

dlpdian_ajfp=%s,
dlpdian_arfp=%s,
dlpdian_obse=%s

where id_not_inf=%s",

GetSQLValueString($_POST["dlpdian_ivav"], "text"),
GetSQLValueString($_POST["dlpdian_ivfp"], "date"),
GetSQLValueString($_POST["dlpdian_iini"], "date"),
GetSQLValueString($_POST["dlpdian_ifin"], "date"),

GetSQLValueString($_POST["dlpdian_refv"], "text"),
GetSQLValueString($_POST["dlpdian_refp"], "date"),
GetSQLValueString($_POST["dlpdian_rini"], "date"),
GetSQLValueString($_POST["dlpdian_rfin"], "date"),

GetSQLValueString($_POST["dlpdian_ajfp"], "date"),
GetSQLValueString($_POST["dlpdian_arfp"], "date"),
GetSQLValueString($_POST["dlpdian_obse"], "text"),

GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

echo $actualizado;

echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';

} else {}


$query_update = sprintf("SELECT * FROM not_dlpdian WHERE id_not_inf = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
?>


<div class="modal fade" id="pop_dlpdian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Modificar Detalles de los Gastos a la Dian</h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 
<form  method="POST" name="not_dlpdian">

            <!-- /*=============================================
             =             INSCRIPCION  O. DETALLE DE LOS GASTOS A LA DIAN              =
            =============================================*/  -->

             <h5 class="titulos_expensa"><b>O. DETALLE DE LOS GASTOS A LA DIAN </b></h5>  

             <table class="jona">
              <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Valor de IVA</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Fecha de Pago</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Desde</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Hasta</span></th>               
              </tr>
              <tr>
                <td class="jona-0lax">
                  <input type="text" class="66not" value="<?php echo htmlentities($row_update['dlpdian_ivav'], ENT_COMPAT, ''); ?>" required/>
                  <input type="hidden" id="num66not" name="dlpdian_ivav" value="<?php echo htmlentities($row_update['dlpdian_ivav'], ENT_COMPAT, ''); ?>">
                </td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_ivfp" value="<?php echo htmlentities($row_update['dlpdian_ivfp'], ENT_COMPAT, ''); ?>" required/></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_iini" value="<?php echo htmlentities($row_update['dlpdian_iini'], ENT_COMPAT, ''); ?>" required/></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_ifin" value="<?php echo htmlentities($row_update['dlpdian_ifin'], ENT_COMPAT, ''); ?>" required/></td>
              </tr>

              <tr><td style="border:none"><span style="color:white">--</span></td></tr>

              <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Valor Retefuente</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Fecha de Pago</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Desde</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Hasta</span></th>               
              </tr>
              <tr>
                <td class="jona-0lax">
                  <input type="text" class="67not" value="<?php echo htmlentities($row_update['dlpdian_refv'], ENT_COMPAT, ''); ?>" required/>
                  <input type="hidden" id="num67not" name="dlpdian_refv" value="<?php echo htmlentities($row_update['dlpdian_refv'], ENT_COMPAT, ''); ?>" >
                </td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_refp" value="<?php echo htmlentities($row_update['dlpdian_refp'], ENT_COMPAT, ''); ?>" required/></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_rini" value="<?php echo htmlentities($row_update['dlpdian_rini'], ENT_COMPAT, ''); ?>" required/></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_rfin" value="<?php echo htmlentities($row_update['dlpdian_rfin'], ENT_COMPAT, ''); ?>" required/></td>
              </tr>
            </table>

            <br>

            <table class="jona">
              <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Administracion de Justicia</span></th>               
                <td class="jona-0lax"><span style="font-weight:bold">Fecha de Pago</span></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_ajfp" value="<?php echo htmlentities($row_update['dlpdian_ajfp'], ENT_COMPAT, ''); ?>" required/></td>
                <th class="jona-0lax"><span style="font-weight:bold">Aporte Regis. Nacional Estado Civil</span></th>
                <td class="jona-0lax"><span style="font-weight:bold">fecha de pago</span></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_arfp" value="<?php echo htmlentities($row_update['dlpdian_arfp'], ENT_COMPAT, ''); ?>" required/></td>                
              </tr>              
            </table>

            <br>
            
            <table class="jona"> 
            <tr> 
                <td class="jona-0lax"><span style="font-weight:bold">Observacion:</span></td>               
                <td class="jona-1lax" style="width:700px"><input style="width:100%" name="dlpdian_obse" value="<?php echo htmlentities($row_update['dlpdian_obse'], ENT_COMPAT, ''); ?>" required/></td>    
              </tr>
            </table>
             
<div class="modal-footer">
<button type="button" class="btn btn-default"  data-dismiss="modal">Cancelar</button>
<button type="submit" name="update_not_dlpdian" class="btn btn-success">Guardar</button>
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
       FIN UPDATE  O. DETALLE DE LOS GASTOS A LA DIAN  
     //////////////////////////////////////////////// -->

    

          <!-- /*=============================================
          =            O. DETALLE DE LOS GASTOS A LA DIAN               =
          =============================================*/  -->
          <?php
          $query = sprintf("SELECT * FROM not_inf, not_dlpdian where not_inf.id_not_inf =not_dlpdian.id_not_inf  and not_inf.id_not_inf ='$id' LIMIT 1");
          $select = mysql_query($query, $conexion) or die(mysql_error());
          $row_not_dlpdian = mysql_fetch_assoc($select);

          $not_dlpdian = $row_not_dlpdian['not_dlpdian'];
          // echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id.'.jsp" />';
          ?>

          <?php
              if (isset($_POST['ingreso_not_dlpdian'])) {

              $insertSQL = sprintf("INSERT INTO not_dlpdian (
                id_not_inf,
                nombre_not_dlpdian,

                dlpdian_ivav,
                dlpdian_ivfp,
                dlpdian_iini,
                dlpdian_ifin,

                dlpdian_refv,
                dlpdian_refp,
                dlpdian_rini,
                dlpdian_rfin,

                dlpdian_ajfp,
                dlpdian_arfp,
                dlpdian_obse,
                
                estado_not_dlpdian,
                fec_ahora_dlpdian) VALUES (%s,%s, %s,%s,%s,%s, %s,%s,%s,%s, %s,%s,%s, %s,now())", 
              GetSQLValueString($id, "int"), 
              GetSQLValueString('uno', "text"), 

              GetSQLValueString($_POST["dlpdian_ivav"], "text"),
              GetSQLValueString($_POST["dlpdian_ivfp"], "date"),
              GetSQLValueString($_POST["dlpdian_iini"], "date"),
              GetSQLValueString($_POST["dlpdian_ifin"], "date"),

              GetSQLValueString($_POST["dlpdian_refv"], "text"),
              GetSQLValueString($_POST["dlpdian_refp"], "date"),
              GetSQLValueString($_POST["dlpdian_rini"], "date"),
              GetSQLValueString($_POST["dlpdian_rfin"], "date"),

              GetSQLValueString($_POST["dlpdian_ajfp"], "date"),
              GetSQLValueString($_POST["dlpdian_arfp"], "date"),
              GetSQLValueString($_POST["dlpdian_obse"], "text"),

              GetSQLValueString(1, "int")); 
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $insertado;

              echo '<meta http-equiv="refresh" content="0;URL=./notaria_detalle&'.$id.'.jsp" />';            

              } else {}

              $updateSQL2 = sprintf("UPDATE not_inf SET not_dlpdian=1  where id_not_inf='$id'");
              $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());

              ?>


           <?php // ESTADO PARA FIJAR SI YA HAY UN INGRESO APORTES
            if ($not_dlpdian==0){  
            ?>
            
            <form  method="POST" name="ingreso_not_dlpdian">

            <h5 class="titulos_expensa"><b> O. DETALLE DE LOS GASTOS A LA DIAN  </b></h5>  

            <table class="jona">
              <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Valor de IVA</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Fecha de Pago</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Desde</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Hasta</span></th>               
              </tr>
              <tr>
                <td class="jona-0lax"><input type="text" class="66not"  required/><input type="hidden" id="num66not" name="dlpdian_ivav" ></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_ivfp"  required/></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_iini"  required/></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_ifin"  required/></td>
              </tr>

              <tr><td style="border:none"><span style="color:white">--</span></td></tr>

              <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Valor Retefuente</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Fecha de Pago</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Desde</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Hasta</span></th>               
              </tr>
              <tr>
                <td class="jona-0lax"><input type="text" class="67not"  required/><input type="hidden" id="num67not" name="dlpdian_refv" ></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_refp" required/></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_rini" required/></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_rfin" required/></td>
              </tr>
            </table>

            <br>

            <table class="jona">
              <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Administracion de Justicia</span></th>               
                <td class="jona-0lax"><span style="font-weight:bold">Fecha de Pago</span></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_ajfp" required/></td>
                <th class="jona-0lax"><span style="font-weight:bold">Aporte Regis. Nacional Estado Civil</span></th>
                <td class="jona-0lax"><span style="font-weight:bold">fecha de pago</span></td>
                <td class="jona-0lax"><input type="date" class="datepiker"   name="dlpdian_arfp" required/></td>                
              </tr>              
            </table>

            <br>
            
            <table class="jona"> 
            <tr> 
                <td class="jona-0lax"><span style="font-weight:bold">Observacion:</span></td>               
                <td class="jona-1lax" style="width:700px"><input style="width:100%" name="dlpdian_obse" required/></td>   
              </tr>
            </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_not_dlpdian" class="btn btn-success">Guardar</button>
                </div>
            </form>

            <?php }else{ ?>
              
              <h5 class="titulos_expensa"><b>K. DETALLES GASTOS DE PERSONAL</b>
              <?php if ($estado==0 or $_SESSION['rol']==1) {  ?> 
                <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_dlpdian"  title="Modificar DETALLES DE INSCRIPCIONES EN EL REGISTRO CIVIL"> <button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a>
              <?php } else {} ?>
              </h5>

            <table class="jona">
              <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Valor de IVA</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Fecha de Pago</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Desde</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Hasta</span></th>               
              </tr>
              <tr>
                <td class="jona-0lax"><?php echo $row_not_dlpdian['dlpdian_ivav'] ?></td>
                <td class="jona-0lax"><?php echo $row_not_dlpdian['dlpdian_ivfp'] ?></td>
                <td class="jona-0lax"><?php echo $row_not_dlpdian['dlpdian_iini'] ?></td>
                <td class="jona-0lax"><?php echo $row_not_dlpdian['dlpdian_ifin'] ?></td>
              </tr>

              <tr><td style="border:none"><span style="color:white">--</span></td></tr>

              <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Valor Retefuente</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Fecha de Pago</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Desde</span></th>
                <th class="jona-0lax"><span style="font-weight:bold">Hasta</span></th>               
              </tr>
              <tr>
                <td class="jona-0lax"><?php echo $row_not_dlpdian['dlpdian_refv'] ?></td>
                <td class="jona-0lax"><?php echo $row_not_dlpdian['dlpdian_refp'] ?></td>
                <td class="jona-0lax"><?php echo $row_not_dlpdian['dlpdian_rini'] ?></td>
                <td class="jona-0lax"><?php echo $row_not_dlpdian['dlpdian_rfin'] ?></td>
              </tr>
            </table>

            <br>

            <table class="jona">
              <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Administracion de Justicia</span></th>               
                <td class="jona-0lax"><span style="font-weight:bold">Fecha de Pago</span></td>
                <td class="jona-0lax"><?php echo $row_not_dlpdian['dlpdian_ajfp'] ?></td>
                <th class="jona-0lax"><span style="font-weight:bold">Aporte Regis. Nacional Estado Civil</span></th>
                <td class="jona-0lax"><span style="font-weight:bold">fecha de pago</span></td>
                <td class="jona-0lax">
                  <?php echo $row_not_dlpdian['dlpdian_arfp'] ?>
                </td>                
              </tr>              
            </table>

            <br>
            
            <table class="jona"> 
            <tr> 
                <td class="jona-0lax"><span style="font-weight:bold">Observacion:</span></td>               
                <td class="jona-1lax" style="width:700px"><?php echo $row_not_dlpdian['dlpdian_obse'] ?></td>    
              </tr>
            </table>
           <?php } ?>
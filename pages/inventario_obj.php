<?php
$idfun=intval($_SESSION['snr']);
// DATOS DE LA OFICINA DE REGISTRO
$queryinvecon = sprintf("SELECT * FROM  inveele, invecon, invecat, invesub, invemar, invemod, invenup where
inveele.id_invecon=invecon.id_invecon and 
inveele.id_invecat=invecat.id_invecat and 
inveele.id_invesub=invesub.id_invesub and 
inveele.id_invemar=invemar.id_invemar and 
inveele.id_invemod=invemod.id_invemod and 
inveele.id_invenup=invenup.id_invenup and 
id_inveele='$id' limit 1"); 

$selectinvecon = mysql_query($queryinvecon, $conexion) or die(mysql_error());
$rowinvecon = mysql_fetch_assoc($selectinvecon);
$totalRowsinvecon = mysql_num_rows($selectinvecon);
if (0<$totalRowsinvecon){

// INVENTARIO DE CONTRATO
$invecon_clas  = $rowinvecon['invecon_clas'];
$invecon_obje  = $rowinvecon['invecon_obje'];
$invecon_cont  = $rowinvecon['invecon_cont'];
$invecon_ncon  = $rowinvecon['invecon_ncon'];
$invecon_fini  = $rowinvecon['invecon_fini'];
$invecon_ffin  = $rowinvecon['invecon_ffin'];
$invecon_supe  = $rowinvecon['invecon_supe'];

// INVENTARIO DE ELEMENTO
$invecat  = $rowinvecon['nombre_invecat'];
$invesub  = $rowinvecon['nombre_invesub'];
$invemar  = $rowinvecon['nombre_invemar'];
$invemod  = $rowinvecon['nombre_invemod'];
$invenup  = $rowinvecon['nombre_invenup'];
$inveele_desc  = $rowinvecon['inveele_desc'];
$inveele_seri  = $rowinvecon['inveele_seri'];
$inveele_plac  = $rowinvecon['inveele_plac'];
$inveele_esta  = $rowinvecon['inveele_esta'];
$id_funcionario  = $rowinvecon['id_funcionario'];





} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }
?>

<div class="box box-body">
  <div class="box-header with-border" style="text-align: center;">
    <h3 class="box-title"><b>INFORMACION DEL ELEMENTO</b></h3>
    <div class="box-tools">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#invegardetalle">Garantias</a></li>
    <li><a data-toggle="tab" href="#invetradetalle">Historico del Elemento</a></li>
    <li><a data-toggle="tab" href="#inveeledetalle">Detalle del Elemento</a></li>
    <li><a data-toggle="tab" href="#invecondetalle">Detalle Del Contrato</a></li>
  </ul>
  <div class="tab-content">
    <div id="invegardetalle" class="tab-pane fade in active">
    	<table class="jona">
            <tr>
            	<th class="jona-baqh"><h4><?php echo $invecat.' '.$invemar.' '.'<b>'.$invemod.'</b>'.' Serial '.' '.'<b>'.$inveele_seri.'</b>' ?></h4> </td>
                <th class="jona-baqh">
                <?php if (0==$estado or 1==$_SESSION['rol']) {  ?>
                <a style="float:right; margin-right:30px;" class="ventana1" data-toggle="modal" data-target="#pop_ingresoinvegar"  title="Ingresar Garantia"> <button type="button" class="btn btn-ms btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Garantia</button></a> 
                <?php } else {} ?>
            </td>
            </tr>
        </table>                 
        <?php 
        $query423 = sprintf("SELECT * FROM inveele, invegar where 
        	inveele.id_inveele=invegar.id_inveele and 
        	inveele.id_inveele=".$id." and estado_invegar=1"); 
        $result23 = $mysqli->query($query423);
        ?>
        <table class="jona">
        <tr>
        	<th class="jona-baqh"><span style="font-weight:bold">Ticket</span></th>
          <th class="jona-baqh"><span style="font-weight:bold">Categoria / Marca</span></th>
          <th class="jona-baqh"><span style="font-weight:bold">No Serie</span></th>
          <th class="jona-baqh"><span style="font-weight:bold">Error Presentado </span></th>
          <th class="jona-baqh"><span style="font-weight:bold;">Estado</span></th>
        </tr>
        <?php 
        while($row23 = $result23->fetch_array(MYSQLI_ASSOC)) { 
        $ticket=$row23["id_invegar"];
        $cercon=$row23["invegar_estcon"];

        ?>
            <tr>
            	<td class="jona-0lax"><?php echo $row23["id_invegar"] ?></td>
              <td class="jona-0lax"><?php echo $invecat.' '.$invemar.' '.$invemod ?></td>              
              <td class="jona-0lax"><?php echo $row23["inveele_seri"] ?></td>
              <td class="jona-0lax"><?php echo $row23["invegar_asun"] ?></td> 
              <?php if ($cercon==0) { ?>
              <td class="jona-0lax"> 
              <a class="invegar btn btn-xs btn-danger" title="Ver Garantia <?php echo $ticket?>" id="<?php echo $row23["id_invegar"]?>" style="cursor: pointer;" data-toggle="modal" data-target="#pop_verinvegar"><i class="glyphicon glyphicon-sign"></i>Abierto</a>
              </td>
              <?php } else{ ?>
              <td class="jona-0lax"> 
                <a class="invegar btn btn-xs btn-success" title="Ver Garantia <?php echo $ticket?>" id="<?php echo $row23["id_invegar"]?>" style="cursor: pointer;" data-toggle="modal" data-target="#pop_verinvegar"><i class="glyphicon glyphicon-sign"></i>Cerrado</a>                
              </td>
              <?php } ?>
            </tr>
          <?php } ?>
        </table> 	
    </div>
    <div id="invetradetalle" class="tab-pane fade">
      <table class="jona">
            <tr>
                <th class="jona-0lax" style="width: 300px;"><span style="font-weight:bold">Funcionario</span></th>
                <td class="jona-baqh" style="width: 500px;"> Luz Stella Rosero Escobar </td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Entregado desde</span></th>
                <td class="jona-baqh"> 20/11/2018 </td>
            </tr>
      </table>
    </div>
    <div id="inveeledetalle" class="tab-pane fade">
    	<table class="jona">
            <tr>
                <th class="jona-0lax" style="width: 300px;"><span style="font-weight:bold">Categoria</span></th>
                <td class="jona-baqh" style="width: 500px;"><?php echo $invecat; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Sub Categoria</span></td>
                <td class="jona-baqh"><?php echo $invesub; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Marca</span></th>
                <td class="jona-baqh"><?php echo $invemar; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Modelo</span></th>
                <td class="jona-baqh"><?php echo $invemod; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Numero de Parte</span></th>
                <td class="jona-baqh"><?php echo $invenup; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Descripcion</span></th>
                <td class="jona-baqh"><?php echo $inveele_desc; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Numero de Serie</span></th>
                <td class="jona-baqh"><?php echo $inveele_seri; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Placa de Inventario</span></th>
                <td class="jona-baqh"><?php echo $inveele_plac; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Estado del Elemento</span></th>
                <td class="jona-baqh"><?php echo $inveele_esta; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Funcionario Encargado del Elemento</span></th>
                <td class="jona-baqh"><?php echo $id_funcionario; ?></td>
            </tr>
        </table>
    </div>
    <div id="invecondetalle" class="tab-pane fade">
      <table class="jona">
            <tr>
                <th class="jona-0lax" style="width: 300px;"><span style="font-weight:bold">Clase de Contrato</span></th>
                <td class="jona-0lax" style="width: 500px;"><?php echo $invecon_clas; ?></td>
            </tr>
            <tr>  
                <th class="jona-0lax"><span style="font-weight:bold">Objeto del Contrato</span></th>
                <td class="jona-0lax"><?php echo $invecon_obje; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Contratista</span></th>
                <td class="jona-0lax"><?php echo $invecon_cont; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Numero del Contrato</span></th>
                <td class="jona-0lax"><?php echo $invecon_ncon; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Fecha de Inicio</span></th>
                <td class="jona-0lax"><?php echo $invecon_fini; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Fecha de Terminación</span></th>
                <td class="jona-0lax"><?php echo $invecon_ffin; ?></td>
            </tr>
            <tr>
                <th class="jona-0lax"><span style="font-weight:bold">Nombre del Supervisor</span></th>       
                <td class="jona-0lax"><?php echo $invecon_supe; ?></td>               	
            </tr>
        </table>
    </div>
    
  </div>
</div>


<!-- ////////////////////////////////////////////////
        INGRESO DE GARANTIA DE COMODATO NO BORRAR
//////////////////////////////////////////////// -->

<?php
              if (isset($_POST['ingreso_invegar'])) {

              

              $insertSQL = sprintf("INSERT INTO invegar (
                id_inveele,
                id_oficina,
                nombre_invegar,

                invegar_soper,
                invegar_asun,
                invegar_error,

                id_funcionario,
                invegar_estcon,
                invegar_estfun,
                
                estado_invegar,
                invegar_feah) VALUES (%s,%s,%s, %s,%s,%s, %s,%s,%s, %s,now())", 
              GetSQLValueString($id, "int"), 
              GetSQLValueString($id_oficina, "int"), 
              GetSQLValueString('Comodato', "text"), 

              GetSQLValueString($_POST["invegar_soper"], "text"),
              GetSQLValueString($_POST["invegar_asun"], "text"),
              GetSQLValueString($_POST["invegar_error"], "text"),

              GetSQLValueString($idfun, "int"), 
              GetSQLValueString(0, "int"), 
              GetSQLValueString(0, "int"), 
              
              GetSQLValueString(1, "int")); 
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $insertado;

              echo '<meta http-equiv="refresh" content="0;URL=./inventario_abrir&'.$id.'.jsp" />';            

              } else {}

              // $updateSQL2 = sprintf("UPDATE not_inf SET not_dgdi=1  where id_not_inf='$id'");
              // $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());

              ?>
            
            <div class="modal fade" id="pop_ingresoinvegar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
              <div class="modal-dialog">
              <div class="modal-content"><div class="modal-header"> 
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel">Ingresar Garantia</h4>
              </div>  
              <div id="nuevaAventura22" class="modal-body">   
                <form  method="POST" name="verinvegar">

                <table class="jona">
                    <tr>
                        <th class="jona-0lax"><span style="font-weight:bold">Sistema Operativo</span></th>
                        <td class="jona-0lax"><input type="text" class="form-control" name="invegar_soper" required></td>               
                    </tr>
                    <tr>
                        <th class="jona-0lax"><span style="font-weight:bold">Asunto del Error</span></th>
                        <td class="jona-0lax">
                          <select class="form-control select2" style="width: 100%;" name="invegar_asun" required>
                           <option selected="selected"></option><br>
                           <option style="color:red; font-weight: bold;" disabled="disabled">Problemas Comunes</option>
                           <option value="Atascos de papel">Atascos de papel</option>
                           <option value="Efecto fantasma">Efecto fantasma</option>
                           <option value="Toma mas de una hoja provoca atasco">Toma mas de una hoja provoca atasco</option>
                           <option value="Imprime lineas negras">Imprime lineas negras</option>
                           <option value="Impresión Borrosa">Impresión Borrosa</option><br> 

                           <option style="color:red; font-weight: bold;" disabled="disabled">Problemas de hardware en una impresora</option> 
                           <option value="Densidad de impresión variable">Densidad de impresión variable</option>
                           <option value="Áreas espaciadas irregularmente">Áreas espaciadas irregularmente</option>
                           <option value="Impresión gris o fondo gris">Impresión gris o fondo gris</option>
                           <option value="Tóner suelto">Tóner suelto</option>
                           <option value="Línea negra vertical sólida">Línea negra vertical sólida</option>
                           <option value="Papel atorado con frecuencia">Papel atorado con frecuencia</option>
                           <option value="Aparecen páginas en blanco entre las páginas impresas">Aparecen páginas en blanco entre las páginas impresas</option>

                           <option style="color:red; font-weight: bold;" disabled="disabled">Problemas de conexión entre impresoras</option>
                           <option value="El equipo no reconoce la impresora">El equipo no reconoce la impresora</option>
                           <option value="Impresora no disponible">Impresora no disponible</option>
                           <option value="No muestra que se termina el papel de la bandeja">No muestra que se termina el papel de la bandeja</option>
                           <option value="Error de puerto ocupado o la impresora se pone fuera de línea">Error de puerto ocupado o la impresora se pone fuera de línea</option>
                           <option value="Problemas con el controlador">Problemas con el controlador</option>

                           <option style="color:red; font-weight: bold;" disabled="disabled">OTROS</option>
                           <option value="Problemas con el controlador">otro</option>
                          </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="jona-0lax"><span style="font-weight:bold">Detalle del Error</span></th>
                        <td class="jona-0lax"><textarea rows="4" cols="69" name="invegar_error" required></textarea></td>               
                    </tr>
                </table>

                <div class="modal-footer">
                  <button type="submit" name="ingreso_invegar" class="btn btn-success">Enviar</button>
                </div>

                </form>
              </div>
              </div> 
              </div> 
            </div>


<!-- ////////////////////////////////////////////////
               VER HISTORIAL DEL TICKET    
     //////////////////////////////////////////////// -->

            <div class="modal fade" id="pop_verinvegar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
              <div class="modal-dialog">
              <div class="modal-content"><div class="modal-header"> 
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Historial del Ticket</b></h4>
              </div>  
              <div id="nuevaAventura22" class="modal-body">   
                <form  method="POST" name="verinvegar">
                <div id="divinvegar" style="overflow: scroll; height: 350px;"> 
                      
                </div>
                </form>

                <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                 <span class="glyphicon glyphicon-remove"></span> Salir</button>
                </div>
              </div>
              </div> 
              </div> 
            </div>

<!-- ////////////////////////////////////////////////
       FIN VER HISTORIAL DEL TICKET 
     //////////////////////////////////////////////// -->
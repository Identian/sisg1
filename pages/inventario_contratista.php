<?php
$idfun=intval($_SESSION['snr']);
?>


<!-- ////////////////////////////////////////////////
        CERRAR LA GARANTIA
//////////////////////////////////////////////// -->

        <?php
        if (isset($_POST['cerrar_invegar'])) {

        $updateSQL = sprintf("UPDATE invegar SET 
        invegar_estcon=%s,
        invegar_feccon=%s

        where id_invegar=%s",
        GetSQLValueString(1, "text"),
        GetSQLValueString(date("Y/m/d"), "date"),

        GetSQLValueString($_POST["id_invegar"], "int"));
        $Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

        echo $actualizado;

        echo '<meta http-equiv="refresh" content="0;URL=./inventario_contratista.jsp" />';

        } else {}
        ?>

<div class="box box-body">
	<table class="jona">
        <tr>
            <th class="jona-baqh"><h4><b>GARANTIAS</b></h4></td>
        </tr>
    </table>                 
        <?php 
        $query423 = sprintf("SELECT * FROM  inveele, invecon, invecat, invesub, invemar, invemod, invenup, invegar, oficina_registro where 
        	inveele.id_invecon=invecon.id_invecon and 
			inveele.id_invecat=invecat.id_invecat and 
			inveele.id_invesub=invesub.id_invesub and 
			inveele.id_invemar=invemar.id_invemar and 
			inveele.id_invemod=invemod.id_invemod and 
			inveele.id_invenup=invenup.id_invenup and
			inveele.id_inveele=invegar.id_inveele and 
        	inveele.id_oficina=oficina_registro.id_oficina_registro and
        	estado_invegar=1  order by id_invegar Desc"); 
        $result23 = $mysqli->query($query423);
        ?>
        <table class="jona">
        <tr>
          <th class="jona-baqh"><span style="font-weight:bold">Ticket</span></th>
          <th class="jona-baqh"><span style="font-weight:bold">Departamento</span></th>
          <th class="jona-baqh"><span style="font-weight:bold">Ciudad</span></th>

          <th class="jona-baqh"><span style="font-weight:bold">Categoria / Marca / Modelo</span></th>
          <th class="jona-baqh"><span style="font-weight:bold">No Serie</span></th>
          <th class="jona-baqh"><span style="font-weight:bold">Asunto del Error </span></th>
          <th class="jona-baqh"><span style="font-weight:bold;">Info</span></th>
          <th class="jona-baqh"><span style="font-weight:bold;">Accion</span></th>
          <th class="jona-baqh"><span style="font-weight:bold;">Estado</span></th>

        </tr>
        <?php 
        while($row23 = $result23->fetch_array(MYSQLI_ASSOC)) { 
        // Numero de id de garantia 
        $ticket=$row23["id_invegar"];
        // Estado de cierre de garantia por el contratista 
        $cercon=$row23["invegar_estcon"];
        ?>
            <tr>
              <td class="jona-baqh"><?php echo $id_invegar=$row23["id_invegar"] ?></td>
              <td class="jona-baqh"><?php $id_departamento = $row23['id_departamento']; ?><?php echo quees('departamento', $id_departamento); ?></td>
              <td class="jona-baqh"><?php $id_municipio = $row23['id_municipio']; ?><?php echo nombre_municipio($id_municipio, $id_departamento); ?></td>

              <td class="jona-baqh"><?php echo $row23["nombre_invecat"].' '.$row23["nombre_invemar"].' '.$row23["nombre_invemod"] ?></td>              
              <td class="jona-baqh"><?php echo $row23["inveele_seri"] ?></td>
              <td class="jona-baqh"><?php echo $row23["invegar_asun"] ?></td>
              <td class="jona-baqh"><a href="orips_ver&<?php echo $row23['id_oficina_registro']?>.jsp"><span class="glyphicon glyphicon-search" title="Ver Info ORIP" ></span></a> &nbsp;&nbsp;</td> 

              <?php if ($cercon==0) { ?>
              <td class="jona-0lax"> 
              <a class="tramitarinvegar btn btn-xs btn-danger" title="Tramitar Garantia <?php echo $ticket?>" id="<?php echo $row23["id_invegar"]?>" style="cursor: pointer;" data-toggle="modal" data-target="#pop_tramitarinvegar"><i class="glyphicon glyphicon-sign"></i>Abierto</a>
              </td>
              <?php } else{ ?>
              <td class="jona-0lax"> 
                <a class="invegar btn btn-xs btn-success" title="Ver Garantia <?php echo $ticket?>" id="<?php echo $row23["id_invegar"]?>" style="cursor: pointer;" data-toggle="modal" data-target="#pop_verinvegar"><i class="glyphicon glyphicon-sign"></i>Cerrado</a>                
              </td>
              <?php } ?>

              <?php if ($cercon==0) { ?>
              <td>
              <form  method="POST" name="cerrarinvegar">
                  <input type="hidden" name="id_invegar" value="<?php echo $ticket?>">
                  <button type="submit" name="cerrar_invegar" class="btn btn-xs" onclick="return confirm('Esta Seguro de Cerrar la garantia');">Cerrar</button>
              </form>
              </td>
              <?php } else{ ?>
              <td class="jona-0lax">
                              
              </td>
              <?php } ?>
              
            </tr>
          <?php } ?>
    </table>
</div>




<!-- ////////////////////////////////////////////////
        INGRESO DE RESPUESTA DE GARANTIA
//////////////////////////////////////////////// -->

			       <?php
              if (isset($_POST['ingreso_inveest'])) {

              $insertSQL = sprintf("INSERT INTO inveest (
              	nombre_inveest,

                id_inveele,
                id_oficina,
                id_invegar,
                inveest_notic,
                id_funcionario,

                estado_inveest,
                inveest_feah) VALUES (%s, %s,%s,%s,%s,%s, %s,now())", 
              	GetSQLValueString('Contratista Sumimas', "text"), 
              	GetSQLValueString($_POST["id_inveele"], "int"), 
              	GetSQLValueString($_POST["id_oficina"], "int"), 
              	GetSQLValueString($_POST["id_invegar"], "int"),
              	GetSQLValueString($_POST["inveest_notic"], "text"), 
              	GetSQLValueString($idfun, "int"),               	 
              
             	GetSQLValueString(1, "int")); 
              $Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

              echo $insertado;

              echo '<meta http-equiv="refresh" content="0;URL=./inventario_contratista.jsp" />';            

              } else {}

              // $updateSQL2 = sprintf("UPDATE not_inf SET not_dgdi=1  where id_not_inf='$id'");
              // $Result = mysql_query($updateSQL2, $conexion) or die(mysql_error());

            ?>




	      <div class="modal fade" id="pop_tramitarinvegar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
          <div class="modal-dialog">
            <div class="modal-content"><div class="modal-header"> 
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Historial del Ticket</b></h4>
              </div>  
              <div id="nuevaAventura22" class="modal-body">   
                <form  method="POST" name="verinvegar">
                <div id="divtramitarinvegar" style="overflow: scroll; height: 350px;"> 
                      
                </div>
                <div class="modal-footer">
                 <button type="submit" name="ingreso_inveest" class="btn btn-success">Guardar</button>
                </form>
                </div>
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
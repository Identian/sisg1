<?php
if (isset($_GET['i']) && "" != $_GET['i']) {
$id = $_GET['i'];



if (isset($_POST['telefono_area']) && "" != $_POST['telefono_area'] && 1==$_SESSION['rol']) {
$updateSQL = sprintf("UPDATE area SET telefono_area=%s, correos_area=%s where id_area=%s",
GetSQLValueString($_POST["telefono_area"], "text"),  
GetSQLValueString($_POST["correos_area"], "text"), 
GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());
echo $actualizado;
} else { }







$query_update = sprintf("SELECT * FROM area WHERE id_area = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
mysql_free_result($update);





if (1==$_SESSION['rol']) { 
?>

<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel"><b>Actualizar Área:</b></h4>
</div> 
<div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="fo345345rm1" >


<div class="form-group text-left"> 
<label  class="control-label">EXTENSIONES:</label>   
<textarea class="form-control" name="telefono_area"  required ><?php echo $row_update['telefono_area']; ?></textarea>
</div>

<div class="form-group text-left"> 
<label  class="control-label">CORREOS ASOCIADOS:</label>   
<textarea class="form-control" name="correos_area"  required ><?php echo $row_update['correos_area']; ?></textarea>
</div>



<div class="modal-footer">
<button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success"><input type="hidden" name="table" value="notaria">
<span class="glyphicon glyphicon-ok"></span> Actualizar</button></div></form>



</div>
</div> 
</div> 
</div> 

<?php 
} else {}


?>











 <div class="row">
        <div class="col-md-4">

     
          <div class="box box-primary">
            <div class="box-body box-profile">
      
      <div class="box-tools">
         <?php 
if (1==$_SESSION['rol']){ ?>
 &nbsp; <a href=""  data-toggle="modal" data-target="#popup">
<button type="button" class="btn btn-warning btn-xs" >Actualizar</button>
  </a>
<?php } else { } ?>
              </div>
        
      
      
            <p class="text-muted text-center">OFICINA</p>
              <h3 class="profile-username text-center"><?php echo $row_update['nombre_area']; ?></h3>

			  
			   <p class="text-muted text-center">
			  <a href="documentos/estructura_decreto2723de2014.pdf" target="_blank">Estructura</a> &nbsp; 
			  <a href="documentos/manual_funciones.pdf" target="_blank">Funciones</a> 
			  </p>
			  
			  
              <ul class="list-group list-group-unbordered">
           
                <li class="list-group-item">
                  <b>Teléfono: (+57 1) 3282121</b><br>Extensiones: <?php echo $row_update['telefono_area']; ?>
                </li>

				  <li class="list-group-item">
                  <b>Correos asociados:</b><br><?php echo $row_update['correos_area']; ?>
                </li>
 
        

        </ul>

<b>GRUPOS</b>

<?php          
$queryn = sprintf("SELECT * FROM grupo_area, area where grupo_area.id_area=area.id_area and area.id_area=".$id."  and estado_grupo_area=1");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
?>
<ul class="list-group list-group-unbordered">
            <?php
      do {



echo '<li class="list-group-item">'.$rown['codigo_grupo_area'].' - '.$rown['nombre_grupo_area'].'  ';

if (isset($rown['extension_tel'])){
echo ' / Ext: '.$rown['extension_tel'].'';
} else {}
echo '</li>';



} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


?>
</ul>
        

		
		<hr>
		
		
		<a href="documentos/organigrama2019.pdf" target="_blank"><img src="documentos/organigrama.png" style="width:100%"></a>
		
		
  
            </div>
            <!-- /.box-body -->

          </div>

      


        </div>
        <!-- /.col -->
		<div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Funcionarios</a></li>
              <li><a href="#timeline" data-toggle="tab">PQRSD</a></li>
			   <li><a href="#iris" data-toggle="tab">IRIS</a></li>
            <!--    <li><a href="#settings" data-toggle="tab">Permisos</a></li>
			 <li><a href="#permisos" data-toggle="tab">Permisos / Licencias</a></li>
			    <li><a href="#requerimientos" data-toggle="tab">Requerimientos</a></li>-->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
 
  <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
 	   <?php          
$queryn = sprintf("SELECT funcionario.id_cargo, nombre_vinculacion, cedula_funcionario, foto_funcionario, nombre_grupo_area, nombre_funcionario, correo_funcionario, id_funcionario, nombre_cargo 
FROM funcionario, vinculacion, cargo, grupo_area, area where funcionario.id_vinculacion=vinculacion.id_vinculacion AND funcionario.id_grupo_area=grupo_area.id_grupo_area AND grupo_area.id_area=area.id_area and funcionario.id_cargo=cargo.id_cargo and area.id_area=".$id." and id_tipo_oficina=1 and estado_funcionario=1 order by funcionario.id_cargo asc");
$selectn = mysql_query($queryn, $conexion);
$rown = mysql_fetch_assoc($selectn);
?>
            
          <table class="table table-striped table-bordered table-hover" id="detallefun">
            <thead>
            <tr>
			  <th style="width:3px !important;"></th>
			   <th>Grupo</th>
        <th>Cedula</th>
              <th>Nombre</th>
              <th>Correo</th>
			  <th>cargo</th>
        <th>Vinculación</th>
              <th style="width:30px;"></th>
			  <?php
			  
			  $nump119 = privilegios(119, $_SESSION['snr']);
			  
			    if (1==$_SESSION['rol'] or 0<$nump119) {   
				   echo '<th>';
				
				    echo '</th>';
				  } else {}
				  ?>
            </tr>
            </thead>
            <tbody>
            <?php
      do {
  echo '<tr>';
echo '<td style="width:3px !important;"><span style="font-size:3px;">'.$rown['id_cargo'].'</span></td>';


echo '<td>'.$rown['nombre_grupo_area'].'</td>';

echo '<td>'.$rown['cedula_funcionario'].'</td>';
echo '<td>'.$rown['nombre_funcionario'].'</td>';
echo '<td>'.$rown['correo_funcionario'].'</td>';
echo '<td>'.$rown['nombre_cargo'].'</td>';
echo '<td>'.$rown['nombre_vinculacion'].'</td>';
echo '<td><a href="usuario&'.$rown['id_funcionario'].'.jsp" target="_blank"><span class="glyphicon glyphicon-user"></span></a> ';

echo ' <a href="xls/pqrs_pendientes&0&'.$rown['id_funcionario'].'.xls" target="_blank"><span class="fa fa-file"></span></a>';

echo '</td>';
  if (1==$_SESSION['rol'] or 0<$nump119) {
echo '<td>';
if ((isset($rown['foto_funcionario'])) && 'avatar.png'!=$rown['foto_funcionario']) {   
				echo '<a href="files/'.$rown['foto_funcionario'].'" target="_blank"><img src="files/'.$rown['foto_funcionario'].'" style="width:30px;"></a>';		 
} else { }
	 echo '</td>';
  } else {}
				   
echo '</tr>';



} while ($rown = mysql_fetch_assoc($selectn));
mysql_free_result($selectn);


?>
<script>
                  $(document).ready(function() {
                $('#detallefun').DataTable({
                  "lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                  }
                });
              });
            </script>
 </tbody>
          </table>
           
				  
      
	
        </div>
    </div>
    </div>
 
 
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
              <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
   	   <?php          
$queryn = sprintf("SELECT count(id_asignacion_pqrs) as totofi FROM asignacion_pqrs where id_tipo_oficina=1 and asignacion_pqrs.codigo_oficina=".$id." and estado_asignacion_pqrs=1 ");
$selectn = mysql_query($queryn, $conexion) or die(mysql_error());
$rown = mysql_fetch_assoc($selectn);
echo '<b>Total de PQRSD:</b> <a href="analisis_oficina&'.$id.'-1.jsp">'.$rown['totofi'].'</a><br>';


 echo '<a href="analisis_oficina&'.$id.'-1.jsp"> <b>  Consultar PQRS </b> </a> ';
?>
					  
</div>
    </div>
    </div>
</div>
          



              <div class="tab-pane" id="iris">
              <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">

 
 <?php
//username_iris
$queryn2 = sprintf("SELECT nombre_funcionario, username_iris, codigo_usuario_iris FROM funcionario, grupo_area, usuario_iris WHERE  funcionario.username_iris=usuario_iris.user_iris AND  funcionario.id_grupo_area=grupo_area.id_grupo_area and grupo_area.id_area=".$id." and id_tipo_oficina=1 and estado_funcionario=1 and estado_usuario_iris=1 order by funcionario.id_cargo asc");
$selectn2 = mysql_query($queryn2, $conexion);
$rown2 = mysql_fetch_assoc($selectn2);
$userir='';
$matriz='';
do {
$userir.=$rown2['username_iris'].' / '.$rown2['nombre_funcionario'].'<br>';
$matriz.="'5,".$rown2['codigo_usuario_iris']." ', ";
} while ($rown2 = mysql_fetch_assoc($selectn2));
mysql_free_result($selectn2);

$infoiris= substr($matriz, 0, -2);
$linki='('.$infoiris.')';
echo '<span style="color:#fff;">'.$linki.'</span>';
$link3=base64_encode($linki);
 
 /*
 
 SELECT codigo, correspondencia.idestado, estado.nombre, referencia, asunto, de, para, fecharecepcion, descripcion   FROM correspondencia, estado WHERE correspondencia.idestado=estado.idestado and paraint in ('5,1481 ', 
'5,193 ', 
'5,278 ', 
'5,1916 ', 
'5,327 ', 
'5,410 ', 
'5,469 ', 
'5,842 ', 
'5,1191 ', 
'5,1222 ', 
'5,1309 ', 
'5,1425 ', 
'5,1459 ', 
'5,1481 ', 
'5,1881 ', 
'5,2021 ', 
'5,1697 ', 
'5,1713 ', 
'5,1766 ') and fecharecepcion>'2021-01-01 00:00:01' ORDER BY paraint

 */
 ?>
 <br>
<form action="xlsiris/reporte.xls" method="post" name="45435">

<input type="hidden" name="info" value="<?php echo $link3; ?>">
<input type="submit" value="Reporte 2021 de la oficina">
	</form>	
<br>
<b>Usuarios con Iris del area:</b><br>
<?php echo $userir; ?> 	
</div>
    </div>
    </div>
</div>


		  

              <div class="tab-pane" id="settings">
             <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
 
          
	
        </div>
    </div>
    </div>
	
              </div>
			  
			  
			  
			  
			  
			  
			  
			   <div class="tab-pane" id="permisos">
             <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 

        </div>
    </div>
    </div>
	
              </div>
			  
			

<div class="tab-pane" id="requerimientos">
             <div class="post">
                  <div class="user-block">
 <div class="col-xs-12 table-responsive ">
 
 	 

	
        </div>
    </div>
    </div>
	
              </div>



			
			  
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
	  
	  
	  
	  

    
    <?php
}
}
?>




<?php
if (1 == $_SESSION['snr_tipo_oficina']) {

  $nump11 = privilegios(11, $_SESSION['snr']);
    $nump100 = privilegios(100, $_SESSION['snr']);
$nump101 = privilegios(101, $_SESSION['snr']);


  if ((isset($_POST["table"])) && ($_POST["table"] == "funcionario") && (1 == $_SESSION['rol'] or 0 < $nump11)) {

    $correo_fu = $_POST["correo_funcionario"];
    $ced_fu = $_POST["cedula_funcionario"];
    $selecty = mysql_query("select id_funcionario from funcionario where cedula_funcionario='$ced_fu'", $conexion);
    $rowy = mysql_fetch_assoc($selecty);
    $totalRowsy = mysql_num_rows($selecty);
    if (0 < $totalRowsy) {
      echo $repetido;
    } else {





      $insertSQL = sprintf(
        "INSERT INTO funcionario (id_tipo_documento, cedula_funcionario, fecha_exp_cedula,  nombre_funcionario, sexo, correo_personal, 
clave_funcionario, id_rol, id_grupo_area, id_cargo_nomina_encargo, id_cargo_nomina_titular, id_nivel_academico, 
		
		id_tipo_oficina, id_cargo, fecha_ingreso, fecha_creacion, id_vinculacion, foto_funcionario, lider_pqrs, estado_funcionario) 
		VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(), %s, %s, %s, %s)",
         GetSQLValueString(1, "int"),      
	  GetSQLValueString(trim($_POST["cedula_funcionario"]), "text"),
		 GetSQLValueString($_POST["fecha_exp_cedula"], "date"),
        GetSQLValueString($_POST["nombre_funcionario"], "text"),
		GetSQLValueString($_POST["sexo"], "text"),
        GetSQLValueString(trim($_POST["correo_funcionario"]), "text"),
        GetSQLValueString(md5('12345'), "text"),
        GetSQLValueString(3, "int"),
        GetSQLValueString(301, "int"),
		GetSQLValueString(44, "int"),
        GetSQLValueString(44, "int"),
		GetSQLValueString(12, "int"),
        GetSQLValueString($_POST["id_tipo_oficina"], "int"),
        GetSQLValueString($_POST["id_cargo"], "int"),
		GetSQLValueString($_POST["fecha_ingreso"], "date"),
		GetSQLValueString($_POST["id_vinculacion"], "int"),
        GetSQLValueString('avatar.png', "text"),
        GetSQLValueString(0, "int"),
        GetSQLValueString(1, "int")
      );
      $Result = mysql_query($insertSQL, $conexion);
      echo $insertado;
	  
	if (5==$_POST["id_cargo"]) {
		$infocargo='Contratista';
	} else {
		$infocargo='Funcionario';
	} 
	  
	  
$emailur2=trim($_POST["correo_funcionario"]);
$subject = 'Solicitud de creación de usuario y clave en SISG';
$cuerpo2 = ''; 
$cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que debe solicitar la creación del correo electrónico institucional, por favor diligenciar el formulario del siguiente enlace junto con la firma del servidor público que sera su jefe, director, coordinador, supervisor o registrador de la oficina.'; 
$cuerpo2 .= "<br><br>Tipo de usuario: ".$infocargo; 
$cuerpo2 .= "<br><br>"; 
$cuerpo2 .= 'Formulario de gestión de usuarios: <a href="https://www.supernotariado.gov.co/files/portal/intranet/portal-formato_gestion_usuarios.xls">https://www.supernotariado.gov.co/files/portal/intranet/portal-formato_gestion_usuarios.xls</a>'; 
$cuerpo2 .= "<br><br>"; 
$cuerpo2 .= 'Manual para diligenciar el formulario de gestión de usuarios: <a href="https://www.supernotariado.gov.co/files/portal/intranet/portal-manual_diligenciar_formulario_usuarios.pdf">https://www.supernotariado.gov.co/files/portal/intranet/portal-manual_diligenciar_formulario_usuarios.pdf</a>'; 
$cuerpo2 .= "<br><br>"; 


$cuerpo2 .= "Recuerde que el formulario diligenciado y firmado debe enviarlo a soportetecnico@supernotariado.gov.co"; 
$cuerpo2 .= "<br><br>"; 
$cuerpo2 .= '<br><br>Mensaje automático de la Superintendencia de Notariado y Registro<br>';
$cuerpo2 .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Cc: SNR usuarios<novedadesusuariosSNR@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailur2,$subject,$cuerpo2,$cabeceras);




	  
	  
	  
	  
    }
  } else {
  }
?>



  <div class="modal fade" id="popupnewfuncionario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel">NUEVO:</h4>
        </div>
        <div id="nuevaAventura" class="modal-body">



          <form action="" method="POST" name="form1" onsubmit="return validate();">
		  
            <div class="form-group text-left">
			
              <label class="control-label"><span style="color:#ff0000;">*</span> CEDULA: 



			  </label>
              <input type="text" class="form-control numero" name="cedula_funcionario" id="cedula_persona" style="width:80%;" required>
			  <span class="btn btn-xs btn-warning fa fa-user" id="infodatanombre" style="cursor: pointer;" title="Validar">+</span>

            </div>
			
			
			<div id="datanombre">
			<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA EXPEDICIÓN DE CEDULA:</label>
              <input type="text" class="form-control datepickera" name="fecha_exp_cedula" required>
            </div>
			
			
			
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE:</label>
              <input type="text" class="form-control" name="nombre_funcionario" required>
            </div>
			</div>
			
			 <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>SEXO:</label>
              <select class="form-control" name="sexo" required>
                <option value="" selected></option>
               <option value="F">Femenino</option>
			    <option value="M">Masculino</option>
				
              </select>
            </div>
			
			
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CORREO:</label>
              <input type="text" class="form-control" name="correo_funcionario" required>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>TIPO DE OFICINA:</label>
              <select class="form-control" name="id_tipo_oficina" required>
                <option value="" selected></option>
                <?php echo lista('tipo_oficina'); ?>
              </select>
            </div>
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>PERFIL:</label>
              <select class="form-control" name="id_cargo" required>
                <option value="" selected></option>
                <?php 

$query = sprintf("SELECT * FROM cargo where estado_cargo=1 and id_cargo!=3 order by id_cargo"); 
$select = mysql_query($query, $conexion) ;
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_cargo'].'">'.$row['nombre_cargo'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
				?>
              </select>
            </div>


<div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span>VINCULACIÓN:</label>
              <select class="form-control" name="id_vinculacion" required>
                <option value="" selected></option>
                      <?php 

$query = sprintf("SELECT * FROM vinculacion where estado_vinculacion=1 order by id_vinculacion limit 7"); 
$select = mysql_query($query, $conexion) ;
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {
	echo '<option value="'.$row['id_vinculacion'].'">'.$row['nombre_vinculacion'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 
mysql_free_result($select);
				?>
              </select>
            </div>
			
			
			
			 <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DE INGRESO:</label>
              <input type="text" class="form-control datepicker" name="fecha_ingreso" required>
            </div>
			

            <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                <span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
                <input type="hidden" name="table" value="funcionario"><span class="glyphicon glyphicon-ok"></span> Crear </button></div>
          </form>




        </div>
      </div>
    </div>
  </div>

<?php } else {
} ?>


<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>
          <?php $actualizar55c = mysql_query("SELECT COUNT(id_funcionario) as totac FROM funcionario where estado_funcionario=1", $conexion);
          $row155c = mysql_fetch_assoc($actualizar55c);
          echo $row155c['totac'];
          mysql_free_result($actualizar55c);
          ?>
        </h3>
        <p>Usuarios del sistema</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>
          <?php $actualizar55cc = mysql_query("SELECT COUNT(id_funcionario) as totacc FROM funcionario where estado_funcionario=1 and id_cargo!=8 and id_tipo_oficina=1", $conexion);
          $row155cc = mysql_fetch_assoc($actualizar55cc);
          echo $row155cc['totacc'];
          mysql_free_result($actualizar55cc);
          ?>
        </h3>
        <p>En Nivel Central</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>
          <?php $actualizar55ccr = mysql_query("SELECT COUNT(id_funcionario) as totaccr FROM funcionario where estado_funcionario=1 and id_tipo_oficina=2", $conexion);
          $row155ccr = mysql_fetch_assoc($actualizar55ccr);
          echo $row155ccr['totaccr'];
          mysql_free_result($actualizar55ccr);
          ?></h3>

        <p>En ORIP</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>
          <?php $actualizar55ccn = mysql_query("SELECT COUNT(id_funcionario) as totaccn FROM funcionario where estado_funcionario=1 and id_tipo_oficina=3", $conexion);
          $row155ccn = mysql_fetch_assoc($actualizar55ccn);
          echo $row155ccn['totaccn'];
          mysql_free_result($actualizar55ccn);
          ?>
        </h3>
        <p>En Notarias</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
<div class="row">
  <div class="col-md-12">

    <div class="box box-info">
      <div class="box-header with-border">





        <div class="row">

          <div class="col-md-6">
            <?php if (1 == $_SESSION['rol'] or 0 < $nump11) { ?>
              <a href="" class="btn btn-success" class="ventana1" data-toggle="modal" data-target="#popupnewfuncionario"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo </a>
           

   <a href="xls/usuarios.xls"><span class="fa fa-file-excel-o"></span> Todos los usuarios</a> &nbsp;  &nbsp; 
    <a href="xls/funcionarios.xls"><span class="fa fa-file-excel-o"></span> Funcionarios SNR</a> &nbsp;  &nbsp; 
	 <a href="xls/contratistas.xls"><span class="fa fa-file-excel-o"></span> Contratistas</a> &nbsp;  &nbsp; 
   

		   <?php } else {
            } ?>

            &nbsp; <strong>Directorio de funcionarios</strong>

          

          </div>



          <div class="col-md-6">

            <form class="navbar-form" name="fotertrmrter1erteg" method="post" action="">

              <div class="input-group">
                <div class="input-group-btn">Buscar
                  <select class="form-control" name="campo" required>
                    <option value="" selected> - - Buscar por: - - </option>
                    <option value="funcionario.cedula_funcionario">Cédula</option>
                    <option value="funcionario.nombre_funcionario">Nombre</option>
                    <option value="funcionario.correo_funcionario">Correo</option>
					<?php if (1==$_SESSION['rol']) { ?>
					<option value="funcionario.alias_iduca">Usuario CA</option>
					<?php } else {} ?>
                  </select>
                </div><!-- /btn-group -->
                <div class="input-group-btn">
                  <input type="text" name="buscar" placeholder="" class="form-control" required></div>
                <!-- /input-group -->
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                </div>
              </div>

            </form>


          </div>
        </div>




        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>



      <style>
        .dataTables_filter {
          display: none;
        }
      </style>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table display" id="tabladirectorio">
            <thead>
              <tr>

                <th>Cedula</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tipo Oficina</th>
                
                <th>Perfil</th>
                <th style="min-width:120px;">Detalles / PQRS</th>
				
              </tr>
            </thead>
            <tbody>
              <?php

              if (isset($_POST['buscar']) && "" != $_POST['buscar']) {
                $infop = " and " . $_POST['campo'] . " like '%" . $_POST['buscar'] . "%' ";
                    } else {
                $infop = ' and funcionario.id_tipo_oficina=1 limit 100';
              }

              $query4 = "SELECT * FROM funcionario, tipo_oficina, cargo, rol where funcionario.id_funcionario!=2319 and funcionario.id_rol=rol.id_rol and funcionario.id_cargo=cargo.id_cargo and funcionario.id_tipo_oficina=tipo_oficina.id_tipo_oficina and estado_funcionario=1" . $infop;
              $result = $mysqli->query($query4);
              while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              ?>
            
              <tr>
                <?php

                if (1 == $_SESSION['rol']) {
                  $infoca = ' - ' . $row['alias_iduca'];
                } else {
                  $infoca = '';
                }

                if (1 == $row['lider_pqrs']) {
                  $infoca4 = ' - Lider PQRS';
                } else {
                  $infoca4 = '';
                }

                echo '<td>' . $row['cedula_funcionario'] . $infoca . '</td>';
                echo '<td>' . $row['nombre_funcionario'] . '</td>';
                echo '<td>' . $row['correo_funcionario'] . '</td>';
                echo '<td>' . $row['nombre_tipo_oficina'] . '</td>';
             
                echo '<td>' . $row['nombre_cargo'] . $infoca4 . '</td>';
                echo '<td>';
                echo '<a href="usuario&' . $row['id_funcionario'] . '.jsp"><span class="glyphicon glyphicon-search" ></span>';
          if (1==$_SESSION['rol'] or 0<$nump100 or 0<$nump101) {   
        echo ' &nbsp; <a href="comision&' . $row['id_funcionario'] . '.jsp"><span class="glyphicon glyphicon-plane" alt="Comisión" title="Comisión"></span>';
			} else {}
			   echo ' &nbsp; <a href="pqrs&' . $row['id_funcionario'] . '.jsp"><span class="glyphicon glyphicon-list-alt" ></span>';
			   
			   $nump110=privilegios(110,$_SESSION['snr']);
			    if ((1==$_SESSION['rol'] or 0<$nump110) and 3>$row['id_tipo_oficina'] and  (5!=$row['id_cargo'] or 3!=$row['id_cargo'])) {  
				  echo ' &nbsp; <a href="edl&' . $row['id_funcionario'] . '.jsp"><span class="fa fa-file" ></span>';
				} else {}
			   
			   
                echo '</td>';
				
				
				
                ?>

              </tr>
            <?php } ?>
            </tbody>
          </table>
          <script>
            $(document).ready(function() {
              $('#tabladirectorio').DataTable({
                "lengthMenu": [
                  [25, 50, 100, 250, 500],
                  [25, 50, 100, 250, 500]
                ],
                "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
              });
            });
          </script>
        </div>
        <!-- /.table-responsive -->
      </div>


    </div>
  </div>
</div>
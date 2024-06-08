<?php

if (isset($_GET['i'])) {
  $id=$_GET['i'];
} else { echo '<meta http-equiv="refresh" content="0;URL=./" />'; }


if (1==$_SESSION['rol']) {
  
  $query = sprintf("SELECT * FROM curaduria, funcionario where curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria='$id' limit 1"); 

} 
else {
$idfun=intval($_SESSION['snr']);
$query = sprintf("SELECT * FROM curaduria, funcionario where curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria='$id' and funcionario.id_funcionario='$idfun' limit 1"); 
  
}


$query423 = sprintf("SELECT * FROM expensa_fac where id_expensa_fac='$id' limit 1"); 
$select423 = mysql_query($query423, $conexion) or die(mysql_error());
$row1423 = mysql_fetch_assoc($select423);
$id_expensa_curaduria = $row1423['id_expensa_curaduria'];

  
$query4 = sprintf("SELECT * FROM expensa_curaduria where id_expensa_curaduria='$id_expensa_curaduria' limit 1"); 
$select4 = mysql_query($query4, $conexion) or die(mysql_error());
$row14 = mysql_fetch_assoc($select4);
$id_curaduria = $row14['id_curaduria'];
$fecini = $row14['fecha_inicio_expensa'];
$fecfinal = $row14['fecha_final_expensa'];
$nombre_expensa = $row14['nombre_expensa_curaduria'];



  
  
$query = sprintf("SELECT * FROM curaduria, funcionario where curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria='$id_curaduria' limit 1"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row1 = mysql_fetch_assoc($select);
$name = $row1['nombre_curaduria'];
$dep = $row1['departamento_curaduria'];
$ciudad = $row1['ciudad_curaduria'];
$tele = $row1['telefono_curaduria'];
$celu = $row1['celular_curaduria'];
$dire = $row1['direccion_curaduria'];
$nombre_curador = $row1['nombre_funcionario'];
$correo = $row1['correo_funcionario'];
$ncuraduria=str_replace("Curaduria ","",$name);
$correo_curaduria = $row1['correo_curaduria'];
$id_departamento = $row1['id_departamento'];
$id_municipio = $row1['id_municipio'];
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<section class="content">
  
<div class="row">      
    <div class="col-md-12">
      <div class="box box-body" >
          <div class="box-header with-border" style="text-align: center;">
            <h3 class="box-title"><b>Información</b></h3>
            <div class="box-tools">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>

          <div class="col-md-4"> 
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked info">
                <li><a><i class="glyphicon glyphicon-home"></i> <span><?php echo  $name; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-envelope"></i><span><?php echo $correo_curaduria ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-map-marker"></i><span><?php echo quees('departamento', $id_departamento); ?></span></a></li>
              </ul>
            </div>
          </div>

          <div class="col-md-4"> 
             <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked info">
                <li><a><i class="glyphicon glyphicon-map-marker"></i> <span><?php echo nombre_municipio($id_municipio, $id_departamento); ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-user"></i><span><?php echo $nombre_curador; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-earphone"></i><span><?php echo $tele; ?></span></a></li>
              </ul>
            </div>
          </div> 
          
          <div class="col-md-4"> 
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked info">
                <li><a><i class="glyphicon glyphicon-phone"></i> <span><?php echo $celu; ?></span></a></li>
                <li><a><i class="glyphicon glyphicon-home"></i><span><?php echo $dire; ?></span></a></li>
        <li style="padding-left:20px;">
          <?php
          //------------------------------------
          // FUNCION PARA INCLUIR LA FECHA
          //------------------------------------
          $valt=intval(20);
                  

          $mod_date = strtotime($fecini."+ ".$valt." days");
          $fechavence= date("Y-m-d",$mod_date);
            
          $fechavence1=explode("-", $fechavence);
            
          $anof=$fechavence1[0];
          $mesf=$fechavence1[1];
          $diaf=$fechavence1[2];
          ?>
                
          <script type="text/javascript">

          function ocultar() {

          }
            var ayo = <?php echo $anof; ?>;
            var mes = <?php echo $mesf; ?>; 
            var dia = <?php echo $diaf; ?>;
            var hora = 23;
            var minuto = 59;
            var segundo = 59;
            
           
            var id;
            if (!id) { id = 1; }
            else { id++; }
           
           

          document.write("Vence: <span id='evento" + id + "'></span> <br /> Tiempo restante: ");
          document.write("<span style='color:#990000;' id='contar" + id + "'></span>");
            

          setInterval('contar('+ayo+','+mes+','+dia+','+hora+','+minuto+','+segundo+',' + id + ')',1000);




          function contar(ayo,mes,dia,hora,minuto,segundo,id) {
            var dif = ayo + '-' + mes + '-' + dia + ' &nbsp;/&nbsp; ' + hora + ':';
            if (minuto < 10) { dif+='0'; }
            dif+=minuto + ':';
            
            if (segundo < 10) { dif+='0'; }
            dif+=segundo;
            
            document.getElementById('evento' + id).innerHTML=dif
            var a = new Date();
            dif = new Date(ayo,mes - 1,dia,hora,minuto,segundo);
            dif = (dif.getTime() - a.getTime())/1000;
            if (dif < 0) { document.getElementById('contar' + id).innerHTML="<font color='#777'> Ya vencio</font>";
            document.getElementById('examen').style.display='none';
            setTimeout("paso();",100);
            
            }
            else {
              dia= Math.floor(dif/60/60/24);
              hora= Math.floor((dif - dia*60*60*24)/60/60);
              minuto= Math.floor((dif - dia*60*60*24 - hora*60*60)/60);
              segundo= Math.floor(dif - dia*60*60*24 - hora*60*60 - minuto*60);
              var txt = '';
              if (dia > 0) {
                txt=dia+' d&iacute;a';
                if (dia != 1) { txt+='s'; }
                txt+= ', ';
              }
              if (hora > 0 || dia > 0) {
                txt+=hora+' hora';
                if (hora != 1) { txt+=''; }
                txt+= ', ';
              }
              if (minuto > 0 || hora > 0 || dia > 0) {
                txt+=minuto+' min';
                if (minuto != 1) { txt+=''; }
                txt+= ', ';
              }
              txt+=segundo+' seg';
              if (segundo != 1) { txt+=''; }
              document.getElementById('contar' + id).innerHTML=txt;
            }
          }
          </script>
        </li>
              </ul>
            </div>
          </div>     

        </div>
      </div>
    </div>



<?php
if (isset($_POST['update_fac'])) {

$updateSQL = sprintf("UPDATE expensa_fac SET 
nombre_expensa_fac=%s,
fijo_expensa_fac=%s,
vari_expensa_fac=%s,
uni_expensa_fac=%s

where id_expensa_fac=%s",
GetSQLValueString($_POST["nombre_expensa_fac"], "int"),
GetSQLValueString($_POST["fijo_expensa_fac"], "text"),
GetSQLValueString($_POST["vari_expensa_fac"], "text"),
GetSQLValueString($_POST["uni_expensa_fac"], "text"),

GetSQLValueString($id, "int"));
$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());

echo $actualizado;

echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id_expensa_curaduria.'.jsp" />';

} else {}


$query_update = sprintf("SELECT * FROM expensa_fac WHERE id_expensa_fac = %s", GetSQLValueString($id, "int"));
$update = mysql_query($query_update, $conexion) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
?>


<div class="row">
   <div class="col-md-9">
        <div class="box">
          <div class="box-header with-border">
            <a href="expensa&<?php echo $id_expensa_curaduria; ?>.jsp" class="btn btn-default btn-ms" ><span class="glyphicon glyphicon-chevron-left"></span> Regresar </a>&nbsp; &nbsp; &nbsp;
            <span style="font-size: 20px; float: right; margin-right: 30px;"><b>MODIFICAR FACTURA</b></span>
            <div class="box-tools pull-right">
              <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">


            <form  method="POST" name="update_fac">

              <!-- NUMERO DE FACTURA -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>N° FACTURA</label>
                  <div class="col-sm-7">
                  <input type="text" name="nombre_expensa_fac" class="form-control" value="<?php echo htmlentities($row_update['nombre_expensa_fac'], ENT_COMPAT, ''); ?>" required><br>
                  </div>
              </div>

              <!-- CARGOS FIJOS -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargo Fijo</label>
                  <div class="col-sm-7">
                  <input type="text" class="form-control exp" required value="<?php echo htmlentities($row_update['fijo_expensa_fac'], ENT_COMPAT, ''); ?>"/><input type="hidden" id="numexp" name="fijo_expensa_fac" value="<?php echo htmlentities($row_update['fijo_expensa_fac'], ENT_COMPAT, ''); ?>"><br>
                  </div>
              </div>

              <!-- CARGOS VARIABLES -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargo Variable</label>
                  <div class="col-sm-7">
                  <input type="text" class="form-control 1exp" required value="<?php echo htmlentities($row_update['vari_expensa_fac'], ENT_COMPAT, ''); ?>"/><input type="hidden" id="num1exp" name="vari_expensa_fac" value="<?php echo htmlentities($row_update['vari_expensa_fac'], ENT_COMPAT, ''); ?>"><br>
                  </div>
              </div>

              <!-- CARGOS FIJOS -->
              <div class="form-group">
                  <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargo Unico</label>
                  <div class="col-sm-7">
                  <input type="text" class="form-control 2exp" required value="<?php echo htmlentities($row_update['uni_expensa_fac'], ENT_COMPAT, ''); ?>"/><input type="hidden" id="num2exp" name="uni_expensa_fac" value="<?php echo htmlentities($row_update['uni_expensa_fac'], ENT_COMPAT, ''); ?>"><br>
                  </div>
              </div>

              <div class="modal-footer">

                <!-- ////////////////////////////////////////////////
                 ANULAR FACTURAS
               //////////////////////////////////////////////// -->

                <?php
                if (isset($_POST['anula_fac'])) {
                 echo $id;
                  // UPDATE `expensa_fac` SET `id_expensa_fac`=[value-1],`id_expensa_curaduria`=[value-2],`nombre_expensa_fac`=[value-3],`fijo_expensa_fac`=[value-4],`vari_expensa_fac`=[value-5],`uni_expensa_fac`=[value-6],`anu_fac`=[value-7],`fecha_expensa_fac`=[value-8],`estado_expensa_fac`=[value-9] WHERE 1

                 $updateSQL256 = sprintf("UPDATE expensa_fac SET anu_fac=1  where id_expensa_fac='$id'");
                 $Result256 = mysql_query($updateSQL256, $conexion) or die(mysql_error());

                echo $anulada;

                echo '<meta http-equiv="refresh" content="0;URL=./expensa&'.$id_expensa_curaduria.'.jsp" />';

                } else {}
                ?>

                <?php
                $query652 = sprintf("SELECT * FROM expensa_fac where id_expensa_fac='$id' limit 1"); 
                $select652 = mysql_query($query652, $conexion) or die(mysql_error());
                $row1652 = mysql_fetch_assoc($select652);
                $fac_s_anulada = $row1652['anu_fac'];

                if($fac_s_anulada==0){?>
                  <form  method="POST" name="anula_fac"><input type="hidden" name="">
                    <button style="float: left;" onclick="return confirm('Esta Seguro de Anular la Factura');" type="submit" class="btn btn-warning" name="anula_fac" >Anular Factura</button>
                  </form>
                <?php }else{
                   echo $facturaanulada;
                }
                ?>

                <!-- ////////////////////////////////////////////////
                 FIN ANULAR FACTURAS
               //////////////////////////////////////////////// -->

              <button type="submit" name="update_fac" class="btn btn-success">Guardar</button>
              </div>

              </form>
                  
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>


</section>

<?php
}

mysql_free_result($update);

?>
<!-- ////////////////////////////////////////////////
       FIN DETALLE GASTOS DE INVERSION
     //////////////////////////////////////////////// -->



    





<script type="text/javascript" src="dist/js/pages/expensa.js"></script>
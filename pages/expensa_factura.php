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
 
  
$query4 = sprintf("SELECT * FROM expensa_curaduria where id_expensa_curaduria='$id' limit 1"); 
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


if (isset($_POST['expensa_curaduria_estado'])) {
$insertSQL = sprintf("INSERT INTO expensa_curaduria_estado (nombre_expensa_curaduria_estado, id_expensa_curaduria, expensa_correccion, apro_expensa_curaduria_estado, estado_expensa_curaduria_estado) VALUES (%s, %s, %s, %s, %s)", 
GetSQLValueString($name, "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString(0, "int"),
GetSQLValueString(0, "int"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo $expensacerrada;

} else {  }

?>


<?php
if (isset($_POST['resfactura'])) {

$insertSQL = sprintf("INSERT INTO expensa_fac (
  id_expensa_curaduria,
  nombre_expensa_fac,

  fijo_expensa_fac,
  vari_expensa_fac,
  uni_expensa_fac,
  anu_expensa_fac,

  estado_expensa_fac,
  fecha_expensa_fac) VALUES (%s,%s,%s,%s,%s,%s,%s,now())", 
GetSQLValueString($id, "int"), 
GetSQLValueString($_POST["nombre_expensa_fac"], "int"), 

GetSQLValueString($_POST["fijo_expensa_fac"], "text"), 
GetSQLValueString($_POST["vari_expensa_fac"], "text"), 
GetSQLValueString($_POST["uni_expensa_fac"], "text"), 
GetSQLValueString($_POST["anu_expensa_fac"], "text"), 

GetSQLValueString(1, "int")); 
$Result = mysql_query($insertSQL, $conexion) or die(mysql_error());

echo $insertado;
// echo '<meta http-equiv="refresh" content="0;URL=./expensa_factura&'.$id.'.jsp" />';


} else {}
?>

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

<!-- cajas de expensa -->
 <div class="row">
   <div class="col-md-4">
        <div class="box">
          <div class="box-header with-border">

            <b>Periodo &nbsp;<?php echo $fecini;?> &nbsp; Hasta &nbsp; <?php echo $fecfinal;?></b>
            
          </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- SCRTIP PARA FORMATO MONEDA -->
              <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
              <!-- FIN SCRTIP PARA FORMATO MONEDA -->
              <div class="row">
                <div class="col-md-12">

                  <form  method="POST">

                    <!-- NUMERO DE FACTURA -->
                    <div class="form-group">
                        <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>N° FACTURA</label>
                        <div class="col-sm-7">
                        <input type="text" name="nombre_expensa_fac" class="form-control" required><br>
                        </div>
                    </div>

                    <!-- CARGOS FIJOS -->
                    <div class="form-group">
                        <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargos Fijo</label>
                        <div class="col-sm-7">
                        <input id="2exp" type="text" class="form-control exp" required/><input type="hidden" id="numexp" name="fijo_expensa_fac"><br>
                        </div>
                    </div>

                    <!-- CARGOS VARIABLES -->
                    <div class="form-group">
                        <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargos Variable</label>
                        <div class="col-sm-7">
                        <input id="2exp" type="text" class="form-control 1exp" required/><input type="hidden" id="num1exp" name="vari_expensa_fac"><br>
                        </div>
                    </div>

                    <!-- CARGOS FIJOS -->
                    <div class="form-group">
                        <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargos Unico</label>
                        <div class="col-sm-7">
                        <input id="2exp" type="text" class="form-control 2exp" required/><input type="hidden" id="num2exp" name="uni_expensa_fac"><br>
                        </div>
                    </div>

                    <!-- CARGOS FIJOS -->
                    <div class="form-group">
                        <label class="col-sm-5 text_titulos_dev"><span style="color:#ff0000;">*</span>Cargos Anulados</label>
                        <div class="col-sm-7">
                        <input id="2exp" type="text" class="form-control 3exp" required/><input type="hidden" id="num3exp" name="anu_expensa_fac"><br>
                        </div>
                    </div>

                    <button  style="margin-top:50px; margin-left:20px; float: right;" type="submit" name="resfactura" class="next btn btn-success">Enviar</button>

                  </form>

                </div>
              </div>
            </div><!-- ./box-body -->
        </div>  <!-- ./box  -->

  </div><!-- ./col-md-12  -->

        <div class="col-md-4">
          <div class="box">
          <div class="box-header with-border">

            <b>Periodo &nbsp;<?php echo $fecini;?> &nbsp; Hasta &nbsp; <?php echo $fecfinal;?></b>
            
          </div>
            <!-- /.box-header -->
            <div class="box-body">
            </div>
          </div>
        </div>


        <div class="col-md-4">
          <div class="box">
          <div class="box-header with-border">

            <b>Periodo &nbsp;<?php echo $fecini;?> &nbsp; Hasta &nbsp; <?php echo $fecfinal;?></b>
            
          </div>
            <!-- /.box-header -->
            <div class="box-body">
            </div>
          </div>
        </div>

</div><!-- ./row  -->


 
<script type="text/javascript" src="dist/js/pages/expensa.js"></script>


     
    



<?php
//Mapa

$nump111 = privilegios(111, $_SESSION['snr']);



$realdatecompleto = date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-05-25 08:00:00");
$fecha_limite = strtotime("2023-12-31 17:00:00");

// Fecha Actual
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$fechaAno = date("Y");

// CONTROL DE INGRESO 



$idGrupoArea = $_SESSION['snr_grupo_area'];
if (in_array("$idGrupoArea", $arrayorips)) {
  $autorizacion = 1;
} else {
  $autorizacion = 0;
}

if ($fecha_limite >= $fecha_actual && (1 == $_SESSION['snr_tipo_oficina'] || 1 == $autorizacion || 0 < $nump111 || 1 == $_SESSION['rol'])) {

  if ((isset($_POST["relacion"])) && ("" != $_POST["relacion"])) {
    $funcionario = $_SESSION['snr'];


?>


 <style type="text/css">

body{
    background-color:#F7F7F7;
    font-size: 12px;
  } 
h1 {
    font-size: 30px;
}
h2 {
    font-size: 22px;
}
h3 {
    font-size: 18px;
}
h4 {
    font-size: 15px;
}
hr {
    margin-top: 5px;
    margin-bottom: 5px;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-bottom: 5px;
    font-weight: 500;
    line-height: 1;
}
.btn-redbull {
    color: #fff;
    background-color: #8b0000;
    border-color: #8b0000;
}
.btn-redbull:hover {
    color: #fff;
    background-color: #7b0000;
    border-color: #7b0000;
}

.btn-lg {
    font-size: 1rem;
}

.btn {
    margin-left: 5px;
    margin-top: 5px;
}
#id-opt-docs{
    margin-left: 50px;

}
.text-reslatado {background: #888; color: #fff; margin-left: 50px;}
.text-reslatado span{font-weight:bold; }

#id-opt-docs a{font-size: 15px;}

#id-docs-col{display: none;}

</style>
  
<script type="text/javascript">
  
function UpdateMacroproceso(id,clase){  
$(document).ready(function() {          
    var parametro1 = id;
    var parametro2 = clase;
        $.ajax({
            url: 'funciones_mp.php',
            type: 'post',
            data: {
                funcion: 'listaMpMacroproceso',
                id: parametro1,
                clase: parametro2,
            },
            success: function(response) {
                $('#id-macroproceso').html(response);
            }
        });
    });

document.getElementById("id-proceso").innerHTML = "";
document.getElementById("id-opt-docs").innerHTML = "";
document.getElementById("id-docs").innerHTML = "";
var image = document.getElementById('id-img-map');
    image.style.width = '200px';
 document.getElementById("id-img").innerHTML = "";  
}


function UpdateProceso(id,clase,macroselect){
  $(document).ready(function() {          
    var parametro1 = id;
    var parametro2 = clase;
        $.ajax({
            url: 'funciones_mp.php',
            type: 'post',
            data: {
                funcion: 'listaproceso',
                id: parametro1,
                clase: parametro2,
                macro: macroselect,
            },
            success: function(response) {
                $('#id-proceso').html(response);
            }
        });
    });
document.getElementById("id-opt-docs").innerHTML = "";
document.getElementById("id-docs").innerHTML = "";
document.getElementById("id-docs-col").style.display = "none";


}

function UpdateProcesoOpt(id,clase,procesoselect){
  $(document).ready(function() {          
    var parametro1 = id;
    var parametro2 = clase;
        $.ajax({
            url: 'funciones_mp.php',
            type: 'post',
            data: {
                funcion: 'listaoptdocs',
                id: parametro1,
                clase: parametro2
            },
            success: function(response) {
                $('#id-opt-docs').html(response);
            }
        });
    });
document.getElementById("id-docs-col").style.display = "block";  
document.getElementById("title-proceso").innerHTML = "Documentos relacionados a &nbsp;"+procesoselect;
document.getElementById("id-docs").innerHTML = "";   


}



function UpdateProcesoOptDocs(id,doc,clase){
  $(document).ready(function() {          
    var parametro1 = id;
     var parametro2 = doc;
     var parametro3 = clase;
        $.ajax({
            url: 'funciones_mp.php',
            type: 'post',
            data: {
                funcion: 'listatdocsEdit',
                id: parametro1,
                doc: parametro2,
                clase: parametro3
            },
            success: function(response) {
                $('#id-docs').html(response);
            }
        });
    });
}

function ClearData() {

document.getElementById("id-proceso").innerHTML = "";
document.getElementById("id-opt-docs").innerHTML = "";
document.getElementById("id-docs").innerHTML = "";
document.getElementById("id-macroproceso").innerHTML = "";

var image = document.getElementById('id-img-map');
    image.style.width = '700px';
}


function editardoc(titulo){


  document.getElementById("title-doc").innerHTML = titulo;
}






function UpdateDocumentobd(id_mp_doc){

  var fecha=document.getElementById("fecha_"+id_mp_doc).value;
  var mp_codigo=document.getElementById("codigo_"+id_mp_doc).value;
  var estado=document.getElementById("estado_"+id_mp_doc).value;
  var nombre=document.getElementById("nombre_"+id_mp_doc).value;
 let text = "Esta seguro de editar el registro.";
  if (confirm(text) == true) {
  $(document).ready(function() {          
    
        $.ajax({
            url: 'funciones_mp.php',
            type: 'post',
            data: {
                funcion: 'UpdateDocumentobd',
                id_mp_doc: id_mp_doc,
                mp_codigo: mp_codigo,
                fecha: fecha,
                estado: estado,
                nombre: nombre,
            },
            success: function(response) {
              if(response==1){
                $('#id-docs').html("Registro actualizado");}
              else{ 
              $('#id-docs').html("Registro No actualizado");} 
             
            }
        });
    });
  }else{ alert}


}


</script>



<div class="container">

  <div class="row"> <br></div>
  <div class="row">
    <div class="col-sm-3" id='id-categoria'>
      <?php
      include 'funciones_mp.php';
      echo listMp('mp_categoria');

      ?>
    </div>
    <div class="col-sm-9" id='id-data'>
      <div class="row" >
        <div class="col-sm-12" id='id-img'>  <img Onclick=ClearData() id='id-img-map' src="images/mapa-pro.jpeg" width="600px"> </div>
      </div>

      <div class="row" ><div class="col-sm-12" id='id-macroproceso'></div></div>

       <div class="row" ><div class="col-sm-12" id='id-proceso'></div></div>

    </div>     


  </div>
  <div class="row" id='id-docs-col'> 
    <div class="col-sm-12 text-reslatado" > <br><h4 class="text-reslatado"> <span id="title-proceso"> </span></h4><br></div>
  </div>
  <div class="row" >
    <div class="col-sm-12" ><br></div>
          <div class="col-sm-3" id='id-opt-docs'></div>
          <div class="col-sm-8" id='id-docs'></div>  
  </div>


</div>
  

<?php
}
} else {
  echo 'No tiene acceso. ';
} ?>
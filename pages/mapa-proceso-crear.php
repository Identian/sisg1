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
.text-reslatado-header {background: #111; color: red; }
.text-reslatado-header h4 span{font-weight:500; }

.text-reslatado {background: #ddd; color:  #111; margin-left: 20px; }
.text-reslatado span{font-weight:500; }

#id-opt-docs a{font-size: 15px;}

#id-docs-col{display: none;}

</style>
  
<script type="text/javascript">
  
function UpdateMacroprocesoCrear(id,clase,macroselect){  
  
$(document).ready(function() {          
    var parametro1 = id;
    var parametro2 = clase;
    var parametro3 = macroselect;
        $.ajax({
            url: 'funciones_mp.php',
            type: 'post',
            data: {
                funcion: 'listaMpMacroprocesoCrear',
                id: parametro1,
                clase: parametro2,
                macroproceso: parametro3,
            },
            success: function(response) {
                $('#id-macroproceso').html(response);
            }
        });
    });
   
document.getElementById("selet-cat-add").innerHTML = macroselect;
document.getElementById("selet-macro-add").innerHTML =' ';
document.getElementById("selet-proceso-add").innerHTML =' ';
 document.getElementById("id-proceso").innerHTML =' ';
}

function AddNewMacro(idcat,clase,macroselect){

let text = "Esta seguro de agregar un nuevo macroproceso.";
  if (confirm(text) == true) {

       NewMacro = document.getElementById("id-macro-add").value;
       if(NewMacro==''){ alert('El campo de nuevo macroproceso esta vacio')}
       else { 
            $(document).ready(function() {          
              var parametro1 = idcat;
              var parametro2 = NewMacro;
                  $.ajax({
                      url: 'funciones_mp.php',
                      type: 'post',
                      data: {
                          funcion: 'AddMpMacroproceso',
                          idcategoria: parametro1,
                          macroproceso: parametro2,
                      },
                      success: function(response) {
                        if(response!=1){
                          alert('El macroproceso con nombre'+NewMacro+' ya existe')
                        }else{
                        document.getElementById("id-macro-add").value =''  
                        UpdateMacroprocesoCrear(idcat,clase,macroselect)
                        document.location.href = "#formid";
                       
                        }  
                      }
                  });
              });
       }
    
  } else {
    text = "Accion cancelada";
  }

}



function UpdateProcesoCrear(id,clase,macroselect){
  $(document).ready(function() {          
    var parametro1 = id;
    var parametro2 = clase;
        $.ajax({
            url: 'funciones_mp.php',
            type: 'post',
            data: {
                funcion: 'listaprocesoCrear',
                id: parametro1,
                clase: parametro2,
                macro: macroselect,
            },
            success: function(response) {

                $('#id-proceso').html(response);
                document.getElementById("selet-macro-add").innerHTML =' / '+macroselect;
                document.getElementById("selet-proceso-add").innerHTML =' ';
            }
        });
    });
}

function UpdateProcesoOptCrear(id,clase,procesoselect){
  $(document).ready(function() {          
    var parametro1 = id;
    var parametro2 = clase;
        $.ajax({
            url: 'funciones_mp.php',
            type: 'post',
            data: {
                funcion: 'listaoptdocsCrear',
                id: parametro1,
                clase: parametro2
            },
            success: function(response) {
                $('#id-opt-docs').html(response);
                document.getElementById("selet-proceso-add").innerHTML =' / '+procesoselect;

            }
        });
    });


   $(document).ready(function() {          
        $.ajax({
            url: 'funciones_mp.php',
            type: 'post',
            data: {
                funcion: 'AddFormularioDoc',
                proceso: id,   
                procesoselect:procesoselect,
            },
            success: function(response) {
                document.getElementById("id-docs-col").innerHTML =response;
                document.location.href = "#formid";
            }
        });
    });


document.getElementById("id-docs-col").style.display = "block";  
//document.getElementById("title-proceso").innerHTML = AddFormularioDoc(1);
//document.getElementById("id-docs").innerHTML = "";   


}



function AddNewProceso(idmacro,clase,macroselect){

let text = "Esta seguro de agregar un nuevo Proceso.";
  if (confirm(text) == true) {

       NewProceso = document.getElementById("id-proceso-add").value;
       if(NewProceso==''){ alert('El campo de nuevo Proceso esta vacio')}
       else { 
            $(document).ready(function() {          
          
                  $.ajax({
                      url: 'funciones_mp.php',
                      type: 'post',
                      data: {
                          funcion: 'AddNewProceso',
                          idmacro: idmacro,
                          proceso: NewProceso,
                      },
                      success: function(response) {
                        if(response!=1){
                          alert('El Proceso con nombre'+NewProceso+' ya existe')
                        }else{
                        document.getElementById("id-proceso-add").value =''  
                       // UpdateMacroprocesoCrear(idcat,clase,macroselect)
                          UpdateProcesoCrear(idmacro,clase,macroselect);
                        document.location.href = "#id-proceso-add";  

                        }  
                      }
                  });
              });
       }
    
  } else {
    text = "Accion cancelada";
  }

}


formid

function guardar(){
  var validacion=0;

  var tipo_doc = $('#id-tipo-doc').val();
  if (tipo_doc == ' ') {
    alert("Debe seleccionar un tipo de documento");
    return false;
  validacion=1;
  }

  var doc = $('#id-doc').val();
  if (doc == '') {
    alert("Debe digital el nombre del documento");
    return false;
  validacion=1;
  }

  var cod = $('#id-cod').val();
  if (cod == '') {
    alert("Debe digital el código del documento");
    return false;
  validacion=1;
  }

  var fecha = $('#id-fecha').val();
  if (fecha == '') {
    alert("Debe digital la fecha de publicación documento");
    return false;
  validacion=1;
  }

  var version = $('#id-version').val();
  if (version == '') {
    alert("Debe seleccionar la versión documento");
    return false;
  validacion=1;
  }

  var archivo = $('#id-archivo').val();
  if (archivo == '') {
    alert("Debe cargar un documento realcionado");
    return false;
    validacion=1;
  }

  var tiposPermitidos = ['doc', 'docx', 'xls', 'xlsx', 'pdf', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif'];
  var tipoArchivo = archivo.split('.').pop().toLowerCase();
  if (tiposPermitidos.indexOf(tipoArchivo) == -1){ 
    
    alert("Archivo no reconocido solo se permite archivos doc, docx, xls, xlsx, pdf, ppt, pptx, jpg, jpeg, png o gif");
    return false;
    validacion=1;
  }

  


  if(validacion==0){
    document.formmp.submit();
  }
  
}







</script>



<div class="container">

  <div class="row "> <br><br><br><br><h1>Crear Nueva Ruta de Mapa de Proceso</h1><br><br><br><br><br></div>
  
  <div class="row">
    <div class="col-sm-12" id='id-categoria'>
      <?php
      include 'funciones_mp.php';
      echo listMpCrear('mp_categoria');

      ?>
    </div>
    <div class="col-sm-12" id='id-data'>
      
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

<div class="row"> <br>
    <div class="col-sm-12 text-reslatado-header" > 
      <br>
        <h4 > 
            <span id="selet-cat-add"> </span> 
            <span id="selet-macro-add"> </span> 
            <span id="selet-proceso-add"> </span>
         </h4>   
            <button type="button" class="btn btn-primary btn-sm" id="formid" onclick="guardar()">Guardar Registro</button>
        
      <br><br><br>
    </div>

  </div>




</div>
  

<?php
}
} else {
  echo 'No tiene acceso. ';
} ?>
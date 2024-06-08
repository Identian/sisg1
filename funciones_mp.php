<?php

if (isset($_POST["accion"])) {


/*
*/

$accion = $_POST["accion"];
if ($accion == "guardar") {
  
   
    $proceso = $_POST["n-proceso-in"];
    $tipodoc = $_POST["n-tipo-doc"];
    $documento = $_POST["n-doc"];
    $codigo = $_POST["n-cod"];
    $version = $_POST["n-version"];
    $fecha = $_POST["n-fecha"];


    $nombre_archivo = $_FILES["archivo"]["name"];
    $archivo_temporal = $_FILES["archivo"]["tmp_name"];
    $carpeta_destino = "files/portal/mapaprocesos/";
    $ruta_archivo = $carpeta_destino . $nombre_archivo;

    if (move_uploaded_file($archivo_temporal, $ruta_archivo)) {
       
        $query = "INSERT INTO  mp_doc (`id_mp_proceso`, `id_mp_tipo_doc`, `mp_nombre_doc`, `mp_codigo`, `mp_version`, `mp_fecha`, `mp_link`) 
        VALUES (".$proceso.", ".$tipodoc.", '".$documento."', '".$codigo."', '".$version."', '".$fecha."', '".$nombre_archivo."');";
        $result = query_sisg_insert($query);

        if($result!=0){
            $query1 = "INSERT INTO mp_historico (`usuario`, `cambio`, `id_agregado`, `fecha`) 
            VALUES ('".$usuario."', 'Agrego documento nuevo', '".$result."', now());";
            $result1 = query_sisg_insert($query1);       
        }

       /* echo  $query;
        echo "<br>".$query1;*/
        echo "<script>alert('Datos Enviados');location.href ='javascript:history.back()';</script>";
    } else {
        echo "<script>alert('Error al enviar o al cargar el archivo');location.href ='javascript:history.back()';</script>";
    }


 }


}



$usuario="test";


function query_sisg($query){
  
  error_reporting(0);

 
      $hostname_conexion = "192.168.80.11";
$database_conexion = "sisg";
$username_conexion = "sisg";
$password_conexion = "C0l0mb1@19*";

    global $mysqli;
    $mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
    if (mysqli_connect_errno()) {
        printf("", $mysqli->connect_error);
        exit();
    }
     
    $result = $mysqli->query($query);  
    //$result->free();
     //exit();  
    $mysqli->close(); 
return  $result;
}


function query_sisg_insert($query){
  
  error_reporting(0);


        $hostname_conexion = "192.168.80.11";
$database_conexion = "sisg";
$username_conexion = "sisg";
$password_conexion = "C0l0mb1@19*";
      

    global $mysqli;
    $mysqli = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
    if (mysqli_connect_errno()) {
        printf("", $mysqli->connect_error);
        exit();
    }
     
     //exit();  
    $result = $mysqli->query($query);  
    $result = $mysqli -> insert_id;
    $mysqli->close(); 
return  $result;
}



function listMp($tabla) {

$html="";
$query = "SELECT * FROM ".$tabla." where estado_".$tabla."=1 order by prioridad ASC ";

$result = query_sisg($query);
$html= '<script> var campo= "id_'.$tabla.'";</script><ol>';

while ($obj = $result->fetch_array()) {
    $infoid=$obj['id_'.$tabla];
    $prioridad=$obj['prioridad'];
    $infonombre='nombre_'.$tabla;
    $classbtn="";  
    if($prioridad==1) { $clase=" btn-warning btn-sm"; }
    if($prioridad==2) { $clase=" btn-info btn-sm"; }
    if($prioridad==3) { $clase=" btn-danger btn-sm"; }
    if($prioridad==4) { $clase=" btn-redbull btn-sm"; } 
    
$html=$html.'<button class="btn '.$clase.' btn-lg btn-block" Onclick="UpdateMacroproceso('.$infoid.',\''.$clase.'\')" >'.$obj[$infonombre].'</button>';
    
    }

$result->free();


echo $html."<hr>";

}





function listaMpMacroproceso($value,$clase) {
$html="";
$query = "SELECT * FROM mp_macroproceso  WHERE id_mp_categoria =".$value." and estado_mp_macroproceso=1 ";
$result = query_sisg($query);
while ($obj = $result->fetch_array()) { 

$html=$html.'<button  class="btn '.$clase.' " Onclick="UpdateProceso('.$obj['id_mp_macroproceso'].',\''.$clase.'\',\''.$obj['nombre_mp_macroproceso'].'\')" > '.$obj['nombre_mp_macroproceso'].'</button>';   

    }

$result->free();
echo "<br><h2>Macroproceso</h2><hr>".$html."<hr>";
}



function listaproceso($value,$clase,$macroselect) {
global $mysqli;
$html="";
$query = "SELECT * FROM mp_proceso WHERE id_mp_macroproceso=".$value;

$result = query_sisg($query);

while ($obj = $result->fetch_array()) {
    
$html=$html.'<button  class="btn '.$clase.'" Onclick="UpdateProcesoOpt('.$obj['id_mp_proceso'].',\''.$clase.'\',\''.$obj['nombre_mp_proceso'].'\')" >'.$obj['nombre_mp_proceso'].'</button>'; 
    

}

$result->free();

echo "<h3>Procesos del Macropoceso ".$macroselect." </h3><hr>".$html."<hr>";

}


function listaoptdocs($value,$clase) {
global $mysqli;
$html="";
$query = "SELECT mp_tipo_doc.nombre_mp_tipo_doc, mp_tipo_doc.id_mp_tipo_doc
FROM mp_doc 
inner JOIN mp_tipo_doc ON  mp_tipo_doc.id_mp_tipo_doc = mp_doc.id_mp_tipo_doc 
WHERE id_mp_proceso=".$value."  GROUP BY mp_doc.id_mp_tipo_doc";

$result = query_sisg($query);
while ($obj = $result->fetch_array()) {
    
    
$html=$html.'<a href="#id-proceso" Onclick="UpdateProcesoOptDocs('.$value.','.$obj['id_mp_tipo_doc'].',\''.$clase.'\')"  >'.$obj['nombre_mp_tipo_doc'].'</a><br><br>';

    }
$result->free();

echo $html."<hr>";

}


function listatdocs($id,$doc) {
global $mysqli;
$html="";
$query = " SELECT * FROM mp_doc WHERE mp_doc.id_mp_proceso=".$id." AND  mp_doc.id_mp_tipo_doc=".$doc ;

$result = query_sisg($query);




$html=$html.'<table class="table table-striped"><thead>';
$html=$html.'<thead>
      <tr>
        <th></th>
        <th>Documento</th>
        <th>Código</th>
        <th>Fecha</th>
        <th>Versión</th>
       
      </tr>
    </thead><tbody>';

while ($obj = $result->fetch_array()) {
    
$html=$html.'<tr class="estado_"'.$obj['mp_estado'].'" >';
$mp_link=strtolower($obj['mp_link']);

$tipo = explode('.', $mp_link);
$iconodoc='';
if($tipo[1]=="pdf"){$iconodoc='<img src="images/pdf.png" alt="Documento PDF" width="30">
';}
if($tipo[1]=="xls"){$iconodoc='<img src="images/xls.png" alt="Documento PDF" width="30">
';}
if($tipo[1]=="xlsx"){$iconodoc='<img src="images/xls.png" alt="Documento PDF" width="30">
';}
if($tipo[1]=="docx"){$iconodoc='<img src="images/doc.png" alt="Documento PDF" width="30">
';}
if($tipo[1]=="doc"){$iconodoc='<img src="images/doc.png" alt="Documento PDF" width="30">
';}  


$html=$html.'<td><a target="_blank" href="files/portal/mapaprocesos/'.$mp_link.'" >'.$iconodoc.'</a></td> ';

$html=$html.'<td> <a target="_blank" href="files/portal/mapaprocesos/'.$mp_link.'" >'.$obj['mp_nombre_doc'].' </a> </td>';
    
$html=$html.'<td>'.$obj['mp_codigo'].' </td> ';

$html=$html.'<td>'.$obj['mp_fecha'].' </td> ';

$html=$html.'<td>'.$obj['mp_version'].' </td> ';


$html=$html.'</tr>';

    }

$html=$html.' </tbody></table>';

$result->free();

echo $html."<hr>";

}








function listatdocsEdit($id,$doc) {
global $mysqli;
$html="";
$query = " SELECT * FROM mp_doc WHERE mp_doc.id_mp_proceso=".$id." AND  mp_doc.id_mp_tipo_doc=".$doc ;

$result = query_sisg($query);




$html=$html.'<table class="table table-striped"><thead>';
$html=$html.'<thead>
      <tr>
        <th></th>
        <th>Documento</th>
        <th>Código</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Accion</th>
       
      </tr>
    </thead><tbody>';

while ($obj = $result->fetch_array()) {
    
$html=$html.'<tr class="estado_'.$obj['mp_estado'].'" >';
$mp_link=strtolower($obj['mp_link']);

$tipo = explode('.', $mp_link);
$iconodoc='';
if($tipo[1]=="pdf"){$iconodoc='<img src="images/pdf.png" alt="Documento PDF" width="30">
';}
if($tipo[1]=="xls"){$iconodoc='<img src="images/xls.png" alt="Documento PDF" width="30">
';}
if($tipo[1]=="xlsx"){$iconodoc='<img src="images/xls.png" alt="Documento PDF" width="30">
';}
if($tipo[1]=="docx"){$iconodoc='<img src="images/doc.png" alt="Documento PDF" width="30">
';}
if($tipo[1]=="doc"){$iconodoc='<img src="images/doc.png" alt="Documento PDF" width="30">
';}  


$html=$html.'<td><a target="_blank" href="files/portal/mapaprocesos/'.$mp_link.'" >'.$iconodoc.'</a></td> ';

$html=$html.'<td> <input id="nombre_'.$obj['id_mp_doc'].'" type="text" value="'.$obj['mp_nombre_doc'].'" > </td>';
    
$html=$html.'<td><input id="codigo_'.$obj['id_mp_doc'].'" type="text" value="'.$obj['mp_codigo'].'" ></td> ';

$html=$html.'<td> <input id="fecha_'.$obj['id_mp_doc'].'" type="text" value="'.$obj['mp_fecha'].'" > </td> ';

$html=$html.'<td> <select id="estado_'.$obj['id_mp_doc'].'" >
              <option value="1">Activo</option>
              <option value="2">Obsoleto</option>
            </select> </td> ';

$html=$html.'<td>

<button type="button" class="btn btn-info btn-lg" onclick="UpdateDocumentobd(\''.$obj['id_mp_doc'].'\')">Editar</button> </td> ';


$html=$html.'</tr>';

    }

$html=$html.' 

 <!-- Modal -->
  <div class="modal fade" id="modal_edit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar <span id="title-doc"></span></h4>
        </div>
        <div class="modal-body" id="form-modal">
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

</tbody></table>';

$result->free();

echo $html."<hr>";

}







function listaMpByCampo($tabla,$campo,$value) {

$html="";

$query = "SELECT * FROM ".$tabla. " WHERE ".$campo."=".$value." and estado_".$tabla."=1 order by prioridad ASC ";

$result = query_sisg($query);
$html= '<ol>';
while ($obj = $result->fetch_array()) {
    
$html=$html.'<li>';
   
$html=$html.'<button type="button" class="btn btn-select" Onclick="UpdateProceso('.$obj['id_mp_macroproceso'].')" value="'.$obj['nombre_mp_macroproceso'].'" ></button>';
    
$html=$html.'</li>';
    }
$html=$html.'</ol>';
$result->free();


echo $html."<br>";

}


if (isset($_POST['funcion']) && function_exists($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    $parametros = $_POST;
    unset($parametros['funcion']);
    
    // Llama a la función con los parámetros recibidos
    $resultado = call_user_func_array($funcion, $parametros);
    
    // Devuelve el resultado de la función
    echo $resultado;
}

function nombreFuncion($parametro1, $parametro2) {
    // Lógica de la función
    return "Los parámetros recibidos son: $parametro1 y $parametro2";
}


/*** Crear ********/




function listMpCrear($tabla) {

$html="";
$query = "SELECT * FROM ".$tabla." where estado_".$tabla."=1 order by prioridad ASC ";

$result = query_sisg($query);


$html= '<script> var campo= "id_'.$tabla.'";</script>';

while ($obj = $result->fetch_array()) {
    $infoid=$obj['id_'.$tabla];
    $prioridad=$obj['prioridad'];
    $infonombre='nombre_'.$tabla;
    $classbtn="";  
    if($prioridad==1) { $clase=" btn-warning"; }
    if($prioridad==2) { $clase=" btn-info"; }
    if($prioridad==3) { $clase=" btn-danger"; }
    if($prioridad==4) { $clase=" btn-redbull"; } 
    
$html=$html.'<button class="btn '.$clase.' btn-lg " Onclick="UpdateMacroprocesoCrear('.$infoid.',\''.$clase.'\',\''.$obj[$infonombre].'\')" >'.$obj[$infonombre].'</button>';
    
    }

$result->free();


echo $html."<hr>";

}

function listaMpMacroprocesoCrear($value,$clase,$macroproceso) {
$html='
    <div class="form-group">
      <label for="pwd">Agregar nuevo Macroproceso en '.$macroproceso.':</label>
      <input type="text" class="form-control" id="id-macro-add">
      <button type="button" class="btn btn-primary" onclick="AddNewMacro(\''.$value.'\',\''.$clase.'\',\''.$macroproceso.'\')">Agregar Nuevo Macroproceso</button>
      <hr>
    </div>
';
$query = "SELECT * FROM mp_macroproceso  WHERE id_mp_categoria =".$value." and estado_mp_macroproceso=1 ";
$result = query_sisg($query);
while ($obj = $result->fetch_array()) { 

$html=$html.'<button  class="btn '.$clase.'" Onclick="UpdateProcesoCrear('.$obj['id_mp_macroproceso'].',\''.$clase.'\',\''.$obj['nombre_mp_macroproceso'].'\')" > '.$obj['nombre_mp_macroproceso'].'</button>';   

    }

$result->free();
echo "<br><h2>Macroproceso</h2><hr>".$html."<hr>";
}

function AddMpMacroproceso($idcategoria,$macroproceso) {

$query = "INSERT INTO `mp`.`mp_macroproceso` (`nombre_mp_macroproceso`, `id_mp_categoria`, `fecha_mp_macroporceso`) VALUES ('".$macroproceso."', '".$idcategoria."', now());";
$result = query_sisg($query);

if($result===1){
    $query = "INSERT INTO `mp`.`mp_historico` (`usuario`, `cambio`, `contenido`, `fecha`) 
    VALUES ('".$usuario."', 'Agrero Macroproceso', '".$macroproceso."', now());";
    $result1 = query_sisg($query);       
}


echo $result;
}



function listaprocesoCrear($value,$clase,$macroselect) {
global $mysqli;
$html='
    <div class="form-group">
      <label for="pwd">Agregar nuevo Proceso en '.$macroselect.':</label>
      <input type="text" class="form-control" id="id-proceso-add">
      <button type="button" class="btn btn-primary" onclick="AddNewProceso(\''.$value.'\',\''.$clase.'\',\''.$macroselect.'\')">Agregar Nuevo Proceso</button>
      <hr>
    </div>
';
$query = "SELECT * FROM mp_proceso WHERE id_mp_macroproceso=".$value;

$result = query_sisg($query);

while ($obj = $result->fetch_array()) {
    
$html=$html.'<button  class="btn '.$clase.'" Onclick="UpdateProcesoOptCrear('.$obj['id_mp_proceso'].',\''.$clase.'\',\''.$obj['nombre_mp_proceso'].'\')" >'.$obj['nombre_mp_proceso'].'</button>'; 
    

}

$result->free();

echo "<h3>Procesos del Macropoceso ".$macroselect." </h3><hr>".$html."<hr>";

}


function AddNewProceso($idmacroproceso,$proceso) {
$query = "INSERT INTO `mp`.`mp_proceso` 
(`nombre_mp_proceso`, `id_mp_macroproceso`) 
VALUES ('".$proceso."', ".$idmacroproceso.");";
$result = query_sisg($query);

if($result==1){
    $query = "INSERT INTO `mp`.`mp_historico` (`usuario`, `cambio`, `contenido`, `fecha`) 
    VALUES ('".$usuario."', 'Agrero proceso', '".$proceso."', now());";
    $result1 = query_sisg($query);       
}

echo $result;
}




function UpdateDocumentobd($id_mp_doc,$mp_codigo,$fecha,$estado,$nombre) {
$query = "UPDATE `mp`.`mp_doc` 
SET `mp_codigo`='".$mp_codigo."', `mp_fecha`='".$fecha."', `mp_estado`='".$estado."', `mp_nombre_doc`='".$nombre."' 
WHERE  `id_mp_doc`=".$id_mp_doc.";";
$result = query_sisg($query);

if($result==1){
    $query = "INSERT INTO `mp`.`mp_historico` (`usuario`, `cambio`, `contenido`, `fecha`) 
    VALUES ('".$usuario."', 'Actualizo proceso', '".$proceso."', now());";
    $result1 = query_sisg($query);       
}

echo $result;
}




function AddFormularioDoc($proceso,$procesoselect){

$html='';

$html='
<div class="container mt-3">
<h3>'.$procesoselect.'</h3>

<form id="formmp" name="formmp" action="funciones_mp.php" enctype="multipart/form-data" method="POST">

<input type="hidden" name="n-proceso-in" id="id-proceso-in" value="'.$proceso.'">
<input type="hidden" name="accion" value="guardar">
<label for="nombre">Documento:</label><br>
<select class="form-control" name="n-tipo-doc" id="id-tipo-doc">';
$html=$html.'<option value=" ">Seleccionar tipo Documento</option>'; 

$query = "SELECT * from mp_tipo_doc WHERE estado_mp_tipo_doc=1";

$result = query_sisg($query);

while ($obj = $result->fetch_array()) {
    
$html=$html.'<option value="'.$obj['id_mp_tipo_doc'].'">'.$obj['nombre_mp_tipo_doc'].'</option>'; 
    
}

$html=$html.' 
</select>
<label for="nombre">Nombre Documento:</label>
<input type="text" class="form-control"  name="n-doc" id="id-doc">


<label for="nombre">Código:</label>
<input type="text" class="form-control" name="n-cod" id="id-cod">

<label for="nombre">Fecha:</label>
<input type="date" class="form-control" name="n-fecha" id="id-fecha">

<label for="nombre">Versión:</label>
<select class="form-control" name="n-version" id="id-version">
    <option value="1">Version 1</option>
    <option value="2">Version 2</option>
    <option value="3">Version 3</option>
    <option value="4">Version 4</option>
    <option value="5">Version 5</option>
    <option value="6">Version 6</option>
    <option value="7">Version 7</option>
    <option value="8">Version 8</option>
    <option value="9">Version 9</option>
    <option value="10">Version 10</option>
    <option value="11">Version 11</option>
    <option value="12">Version 12</option>
    <option value="13">Version 13</option>
    <option value="14">Version 14</option>
    <option value="15">Version 15</option>


</select>    
<br><br>
<input type="file" class="btn btn-primary" name="archivo" id="id-archivo">
<br>

</form>


</div>




';

echo $html;
}



function guardar($datos){

$proceso_in = $_POST["n-proceso-in"];
$tipo_doc = $_POST["n-tipo-doc"];
$cod = $_POST["n-cod"];
$fecha = $_POST["n-fecha"];
$version = $_POST["n-version"];

// Mover el archivo cargado a una carpeta en el servidor
$nombre_archivo = $_FILES["n-adjunto"]["name"];
$archivo_temporal = $_FILES["n-adjunto"]["tmp_name"];
$carpeta_destino = "files/portal/mapaprocesos/";
$ruta_archivo = $carpeta_destino . $nombre_archivo;

if (move_uploaded_file($archivo_temporal, $ruta_archivo)) {
    echo "El archivo se ha cargado correctamente.";
} else {
    echo "Ha ocurrido un error al cargar el archivo.";
}


     
}
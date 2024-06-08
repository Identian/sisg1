<?php

$funcionario = 101;
 global $funcionario;



function preguntatexto($idencuesta,$idpregunta,$pregunta,$size,$respuestatemp,$idrespuestatemp){
global $statusencuensta;
$html="";
$html=$html.'<div class="col-sm-'.$size.'">
                      <!-- text input -->
                      <div class="form-group">
                        <label>'.$pregunta.'</label>
                <input id="p-'.$idencuesta.'-'.$idpregunta.'" type="text" class="form-control" onchange="pregutaguardar([['.$idencuesta.'],['.$idpregunta.'],[this.value],['.$idrespuestatemp.']])" value="'.$respuestatemp.'" '.$statusencuensta.'>
                      </div>
                    </div>';
return $html;
}

function preguntarea($idencuesta,$idpregunta,$pregunta,$size,$respuestatemp,$idrespuestatemp,$placeholder){
global $statusencuensta;    
$html="";
$html=$html.'<div class="col-sm-'.$size.'">
                      <!-- text input -->
                      <div class="form-group">
                        <label>'.$pregunta.'</label>
                        <textarea id="p-'.$idencuesta.'-'.$idpregunta.'" class="form-control" rows="3" onchange="pregutaguardar([['.$idencuesta.'],['.$idpregunta.'],[this.value],['.$idrespuestatemp.']])" '.$statusencuensta.' placeholder="'.$placeholder.'" >'.$respuestatemp.'</textarea>
                      </div>
                    </div>';
return $html; 
    
}

function preguntdate($idencuesta,$idpregunta,$pregunta,$size,$respuestatemp,$idrespuestatemp){
global $statusencuensta; 
$html="";
$html=$html.'<div class="col-sm-'.$size.'">
                      <!-- text input -->
                      <div class="form-group">
                        <label>'.$pregunta.'</label>
                        <input id="p-'.$idencuesta.'-'.$idpregunta.'" type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="aaaa-mm-dd" data-mask="" im-insert="false" onchange="pregutaguardar([['.$idencuesta.'],['.$idpregunta.'],[this.value],['.$idrespuestatemp.']])" value="'.$respuestatemp.'" '.$statusencuensta.' >
                      </div>
                    </div>';
return $html; 
    
}


function preguntselect($idencuesta,$idpregunta,$pregunta,$size,$respuestatemp,$idrespuestatemp,$opcion){
global $statusencuensta; 
$selectedopt="";
$html="";
$html=$html.'<div class="col-sm-'.$size.'">
                      <!-- text input -->
                      <div class="form-group">
                        <label><span style="font-weight: 300;">'.$pregunta.'</span></label><br>
                        <select id="p-'.$idencuesta.'-'.$idpregunta.'" class="form-control"
                        onchange="pregutaguardar([['.$idencuesta.'],['.$idpregunta.'],[this.value],['.$idrespuestatemp.']])"
                        >
                        <option value=" " >Seleccione una Opcion</option>';
  $opciones=explode(";",$opcion);      
             
             foreach ($opciones as $options) {
                if($respuestatemp==$options){ $selectedopt='selected="true" '; }
              $html=$html.'<option '.$selectedopt.' value="'.$options.'">'.$options.'</option>';
              $selectedopt="";
            } 
           

  $html=$html.'</select>
                    </div>
                        </div>';
return $html; 
    
}


function preguntarange($idencuesta,$idpregunta,$pregunta,$size,$respuestatemp,$idrespuestatemp,$opcion,$rango){
global $statusencuensta;
if($respuestatemp==" " || $respuestatemp==""){$respuestatemp=1;}

$html="";
$html=$html.'<div class="col-sm-'.$size.'">
                      <!-- text input -->
                      <div class="form-group">
                        <label><span style="font-weight: 300;">'.$pregunta.'</span></label>

                <div class="row">  
                      
                    <input class="col-sm-10 custom-range custom-range-info" id="p-'.$idencuesta.'-'.$idpregunta.'" type="range" class="form-control" onchange="pregutaguardar([['.$idencuesta.'],['.$idpregunta.'],[this.value],['.$idrespuestatemp.']])" value="'.$respuestatemp.'"  min="1" max="'.$rango.'"  '.$statusencuensta.' oninput="this.nextElementSibling.value = this.value">
                     <output class="col-sm-2">'.$respuestatemp.'</output>
               
                   
                 </div>    
                      </div>
                    </div>';
return $html;



}


function preguntarinstrucion($idencuesta,$idpregunta,$pregunta,$size,$respuestatemp,$idrespuestatemp,$opcion,$class,$padre){
global $statusencuensta;
$html="";
$html=$html.'    <div class="col-sm-'.$size.' " '.$class.'><br></div>
                <div class="col-sm-'.$size.' callout callout-info '.$class.' '.$padre.'"  >
                         <p class="card-text" style="font-weight: 600;">'.$pregunta.'</p>
                </div>';
return $html;
}


function preguntcheck($idencuesta,$idpregunta,$pregunta,$size,$respuestatemp,$idrespuestatemp,$opcion,$rango){
global $statusencuensta; 
$selectedopt="";
$contador=1;
$html="";
$html=$html.'<div class="col-sm-'.$size.'">
                      <!-- text input -->
                      <div class="form-group">
                        <label>'.$pregunta.'</label>';
                        
  $opciones=explode(";",$opcion);      
             
             foreach ($opciones as $options) {

                $opt=explode(".",$options); 
                

              $html=$html.'<div class="form-check">
                                    <input id="'.$idpregunta.'-'.$contador.'" class="form-check-input" type="checkbox" Onclick="checkboxjs'.$idpregunta.'(this)"  value="'.$options.'" '.$statusencuensta.'>
                                    <label class="form-check-label">'.$options.'</label>
                                    </div>
                                ';
              $selectedopt="";
              $contador=$contador+1;
            } 
           
                        
 $html=$html.'  <input id="p-'.$idencuesta.'-'.$idpregunta.'" type="text" class="form-control" onchange="pregutaguardar([['.$idencuesta.'],['.$idpregunta.'],[this.value],['.$idrespuestatemp.']])" value="'.$respuestatemp.'" readonly >';

 if($rango===0){
    $rango=count($opciones);
 }


  $html=$html.' 
  <script>
       


var check'.$idpregunta.'=0; var p2'.$idpregunta.' = []; var p2id'.$idpregunta.' = [];
    
    /*
    console.log(p2'.$idpregunta.'[0])
    console.log(p2'.$idpregunta.'[1])
   */
function checkboxjs'.$idpregunta.'(value){
   

    if(check'.$idpregunta.'=='.$rango.' && value.checked == true){

        p2'.$idpregunta.'.push(value.value);
        p2id'.$idpregunta.'.push(value.id);
        document.getElementById(p2id'.$idpregunta.'[0]).checked = false;
        p2'.$idpregunta.'.splice(0, 1);
        p2id'.$idpregunta.'.splice(0, 1);  

    }else{

        if(value.checked == true){

            check'.$idpregunta.'=check'.$idpregunta.'+1;
            p2'.$idpregunta.'.push(value.value);
            p2id'.$idpregunta.'.push(value.id);
        }

        if(value.checked == false){
            check'.$idpregunta.'=check'.$idpregunta.'-1;

            var elemento = value.value;
            var elementoid = value.id;
            var indice = p2'.$idpregunta.'.indexOf(elemento);
            if (indice !== -1) {
              p2.splice(indice, 1);
            }

            var indiceid = p2id'.$idpregunta.'.indexOf(elementoid);
            if (indiceid !== -1) {
              p2id'.$idpregunta.'.splice(indiceid, 1);
            }
            
         
            
        }   
 }

    if(p2'.$idpregunta.'[0]!="" && p2'.$idpregunta.'[1]!=""){  
        document.getElementById("p-'.$idencuesta.'-'.$idpregunta.'").value = p2'.$idpregunta.'[0]+" / "+p2'.$idpregunta.'[1];
        pregutaguardar([['.$idencuesta.'],['.$idpregunta.'],[p2'.$idpregunta.'[0]+" / "+p2'.$idpregunta.'[1]],['.$idrespuestatemp.']])
    }
showoptiones'.$idpregunta.'();
}

function showoptiones'.$idpregunta.'(){

    $(".p'.$idpregunta.'").hide();

    

    var options=document.getElementById("p-'.$idencuesta.'-'.$idpregunta.'").value
    

    var optionshow =options.replace(/ /g, "")
    optionshow = optionshow.split("/");
    
    if (optionshow.length === 0) { console.log("p0") }
    else{
        var optionshow1 = optionshow[0].split(".");
        $("."+optionshow1[0]+'.$idpregunta.').show();  

        var optionshow2 = optionshow[1].split(".");
        if (optionshow2.length === 0) { console.log("p0") }
        else{
           $("."+optionshow2[0]+'.$idpregunta.').show(); 
        }
    }      

}
 

  </script>

  </div>
</div>
<style>
.p'.$idpregunta.'{display:none;}
</style>

';
return $html; 
    
}




function preguntstars($idencuesta,$idpregunta,$pregunta,$size,$respuestatemp,$idrespuestatemp,$opcion,$rango,$class,$padre){
global $statusencuensta; 
$selectedopt="";
$contador=1;
$html="";
$html=$html.'<div class="col-sm-'.$size.' '.$padre.'" '.$class.' >

                      <div class="form-group">
                        <label><span style="font-weight: 300;">'.$pregunta.'</span></label>
                      <div class="form-check">';
                        
  
    for ($x = 1; $x <= $opcion; $x++) {
       $checked="";
       if($respuestatemp==$x){ $checked="checked";}
       $html=$html.'  
                   <input class="starp" id="'.$idpregunta.'-'.$contador.'" type="radio" name="star'.$idpregunta.'" value="'.$x.'" onchange="pregutaguardar([['.$idencuesta.'],['.$idpregunta.'],[this.value],['.$idrespuestatemp.']])" '.$checked.'>

                   <label class="starl" for="radio">'.$x.'&nbsp;&nbsp;&nbsp;&nbsp;</label>         
                        ';
   
        $checked="";
    }
           
                        
    $html=$html.'</div>';


  $html=$html.'</div></div>';


return $html; 
    
}



function insertrespuesta($idencuesta,$idpregunta,$respuesta,$update){
 global $mysqli;
 global $funcionario;

 $result='';

 if($update==""){

    $insertSQL = "INSERT INTO encuestaresp (id_encuesta,id_pregunta, respuesta, id_funcionario, fecha ) 
        VALUES ($idencuesta,$idpregunta,'".$respuesta."',$funcionario,now())";

    $result = $mysqli->query($insertSQL);  
    $result = $mysqli -> insert_id;

 }

 if($update!=0){

    $insertSQL = "UPDATE encuestaresp  SET  respuesta = '".$respuesta."',fecha = now()  
                    where id =".$update;

    $result = $mysqli->query($insertSQL);  
    $result = $mysqli -> insert_id;
              
 }
    
echo $result;

}


function finalizarform($idencuesta){
 global $mysqli;
 global $funcionario;
 $result='';

    $insertSQL = "INSERT INTO encuestaestado (id_encuesta,id_funcionario, fecha ) 
        VALUES ($idencuesta,$funcionario,now())";

    $result = $mysqli->query($insertSQL);  
    $result = $mysqli -> insert_id;

echo $result;

}




if (isset($_POST["funcion"])) {

    if($_POST["funcion"]=='insertrespuesta'){

     insertrespuesta($_POST["idencuesta"],$_POST["idpregunta"], $_POST["respuesta"], $_POST["update"] );
    }
    
    if($_POST["funcion"]=='finalizarform'){

     finalizarform($_POST["idencuesta"]);
    }
    


     
}





//$nump111 = privilegios(111, $_SESSION['snr']);

$realdatecompleto = date('Y-m-d H:i:s');
$fecha_actual = strtotime($realdatecompleto);
$fecha_inicio = strtotime("2023-05-25 08:00:00");
$fecha_limite = strtotime("2023-12-31 17:00:00");

// Fecha Actual
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$fechaAno = date("Y");

// CONTROL DE INGRESO 

/*

$idGrupoArea = $_SESSION['snr_grupo_area'];
if (in_array("$idGrupoArea", $arrayorips)) {
  $autorizacion = 1;
} else {
  $autorizacion = 0;
}

*/

if (1==1) {

  if (1==1) {
    //$_SESSION['snr'];




?>


 <script type="text/javascript">
  

function pregutaguardar(datarest){  
    var inidpregunta = datarest[1][0];
    var inidencuesta = datarest[0][0];
    var inrespuesta = datarest[2][0];
    var inupdate = datarest[3][0];


    $(document).ready(function() {          
        $.ajax({
            url: 'encuestas.jsp',
            type: 'post',
            data: {
                funcion: 'insertrespuesta',
                idpregunta: inidpregunta,
                idencuesta: inidencuesta,
                respuesta: inrespuesta,
                update: inupdate,
            },
            success: function(response) {
                //$('#id-res').html(response);
                console.log(response);
            }
        });
    });

}    


function pregutaguardartest(datarest){  
    var inidpregunta = datarest[1][0];
    var inidencuesta = datarest[0][0];
    var inrespuesta = datarest[2][0];
    var inupdate = datarest[3][0];
   
  /*  console.log(inidpregunta);
    console.log(inidencuesta);
     console.log(inrespuesta);
     console.log(inupdate);
*/
   /* $(document).ready(function() {          
        $.ajax({
            url: 'encuesta/encuestas.php',
            type: 'post',
            data: {
                funcion: 'insertrespuesta',
                idpregunta: inidpregunta,
                idencuesta: inidencuesta,
                respuesta: inrespuesta,
                update: inupdate,
            },
            success: function(response) {
                //$('#id-res').html(response);
                console.log(response);
            }
        });
    });
    */
}    




function validarform(encuesta){


if (confirm("Esta seguro de enviar la información") == true) {
var estatus=0;
for (let i = 0; i < idspregs.length; i++) {
    $(document).ready(function() {  
        $("#"+idspregs[i]).addClass("is-invalid"); });

    if(document.getElementById(idspregs[i]).value!=''){
       $(document).ready(function() { 
        $("#"+idspregs[i]).removeClass("is-invalid");
        $("#"+idspregs[i]).addClass("is-valid");
                                                });
    }else{
        estatus=1;
    }

}
if(estatus==1){alert('preguntas sin responder')}
else{
      $(document).ready(function() {          
        $.ajax({
            url: 'encuesta/encuestas.php',
            type: 'post',
            data: {
                funcion: 'finalizarform',
                idencuesta: encuesta,

            },
            success: function(response) {
               console.log(response); 
               location.reload();
                
            }
        });
    });


}    
 
} else {
    text = "Acción Canceleda";
  }


}



</script>



<div class="container" style="background:#fff;">

  <div class="row"> <br></div>
  
<?php
$html="";  
$resumen="";
$masinfo="";
$nombre="Encuesta finalizada";
$idencuesta="";
$preids="";//arrego de preguntas
$statusencuensta="";// estado pregunta
if ('instructivo-formato-proyecto-aprendizaje'==$_GET['i']) {
$encuestaslug="instructivo-formato-proyecto-aprendizaje";
} else if ('plan-institucional-de-capacitacion'==$_GET['i']) {
$encuestaslug="plan-institucional-de-capacitacion";

} else {}


$query = "select * from encuesta where estado=1 and slut='".$encuestaslug."' and fechafi>=CURDATE()";

$result = $mysqli->query($query);
 while ($obj = $result->fetch_array()) {

    $nombre=$obj['nombre'];
    $resumen=$obj['resumen'];
    $masinfo=$obj['masinfo'];
    $idencuesta=$obj['id'];

    }
if($idencuesta==""){ echo "Encuesta Finalizada"; exit();}

  

$querystatus = "select * from encuestaestado where id_encuesta=$idencuesta and id_funcionario=$funcionario";
$resultstatus = $mysqli->query($querystatus);
    while ($objstatus = $resultstatus->fetch_array()) {

        $statusencuensta="readonly";
    
    }

?>
    <style>.main-sidebar{display: :none;}</style>
    <div class="row">
        <div class="col-lg-12"><h1><?php  echo $nombre; ?>  </h1> </div>
        <div class="col-lg-12"><br></div>
    </div>    
<div class="row">
  <?php  if($resumen!="" || $resumen!=null ){  ?>    
    <div class="col-lg-12">
     <div class="card">
        <div class="card-body">
                 <?php  echo $resumen;  ?>  
        </div>
        </div>
    </div> 
   <?php  } if($masinfo!="" || $masinfo!=null ){  ?>   
    <div class="col-lg-12">
                <?php  echo $masinfo;  ?>  
    </div> 
    <?php  }  ?>    
</div>


<!-- preguntas -->

<?php if($idencuesta!="" || $idencuesta!=null ){  ?>  

<div class="row">
<?php     
$query = "select seccion from encuestapregunta where id_encuesta=".$idencuesta." and estado=1 group by seccion order by orden asc";
$result = $mysqli->query($query);

$contador=0;
 while ($obj = $result->fetch_array()) {
?> 
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
             <h3 class="card-title" ><?php echo $obj['seccion']; ?> </h3>
            </div>
             <div class="card-body">
                <div class="row " >
            <?php 
                $queryp = "select * from encuestapregunta where estado=1 and id_encuesta=".$idencuesta." and seccion='".$obj['seccion']."' order by orden asc";
            
                $resultpre = $mysqli->query($queryp);
                
                $respuestatemp="";
                $idrespuestatemp="";
                
                while ($objpre = $resultpre->fetch_array()) {
                   
                        $queryrestmp="select id,respuesta from encuestaresp where id_encuesta=".$idencuesta." and id_pregunta=".$objpre['id']." and id_funcionario=".$funcionario;
                       $resultemp = $mysqli->query($queryrestmp);

                           while ($objrestemp = $resultemp->fetch_array()) {
                                if($objrestemp['respuesta']!=null || $objrestemp['respuesta']!=''){
                                     $respuestatemp=$objrestemp['respuesta'];
                                     $idrespuestatemp=$objrestemp['id'];
                                }
                           }
                   
                   //$objpre['pregunta']
                    if($objpre['preguntatipo']==='text'){
                    echo preguntatexto($idencuesta,$objpre['id'],$objpre['pregunta'],$objpre['size'],$respuestatemp,$idrespuestatemp); 
                    $preids=$preids."'p-".$idencuesta."-".$objpre['id']."',";
                   
                    }

                    if($objpre['preguntatipo']==='texarea'){
                    echo preguntarea($idencuesta,$objpre['id'],$objpre['pregunta'],$objpre['size'],$respuestatemp,$idrespuestatemp,$objpre['placeholder'] );
                    $preids=$preids."'p-".$idencuesta."-".$objpre['id']."',"; 
                    
                    } 
                         
                    if($objpre['preguntatipo']==='date'){
                    echo preguntdate($idencuesta,$objpre['id'],$objpre['pregunta'],$objpre['size'],$respuestatemp,$idrespuestatemp);
                    $preids=$preids."'p-".$idencuesta."-".$objpre['id']."',"; 
                    } 

                    if($objpre['preguntatipo']==='select'){
                    echo preguntselect($idencuesta,$objpre['id'],$objpre['pregunta'],$objpre['size'],$respuestatemp,$idrespuestatemp,$objpre['opciones']);
                    $preids=$preids."'p-".$idencuesta."-".$objpre['id']."',"; 
                    }

                    if($objpre['preguntatipo']==='range'){
                          
                    echo preguntarange($idencuesta,$objpre['id'],$objpre['pregunta'],$objpre['size'],$respuestatemp,$idrespuestatemp,$objpre['opciones'],$objpre['rango']);
                    $preids=$preids."'p-".$idencuesta."-".$objpre['id']."',"; 
                    }

                    if($objpre['preguntatipo']==='instrucion'){
                    echo preguntarinstrucion($idencuesta,$objpre['id'],$objpre['pregunta'],$objpre['size'],$respuestatemp,$idrespuestatemp,$objpre['opciones'],$objpre['class'],$objpre['padre']);
                    //$preids=$preids."'p-".$idencuesta."-".$objpre['id']."',"; 
                    }
                    
                    if($objpre['preguntatipo']==='check'){
                    echo preguntcheck($idencuesta,$objpre['id'],$objpre['pregunta'],$objpre['size'],$respuestatemp,$idrespuestatemp,$objpre['opciones'],$objpre['rango']);
                    $preids=$preids."'p-".$idencuesta."-".$objpre['id']."',"; 
                    } 

                     if($objpre['preguntatipo']==='stars'){
                    echo preguntstars($idencuesta,$objpre['id'],$objpre['pregunta'],$objpre['size'],$respuestatemp,$idrespuestatemp,$objpre['opciones'],$objpre['rango'],$objpre['class'],$objpre['padre']);
                    $preids=$preids."'p-".$idencuesta."-".$objpre['id']."',"; 
                    } 
                    
                    

                      $respuestatemp="";
                      $idrespuestatemp="";

                }
                   

            ?> 
            </div> 


          </div>  
        </div>
      </div>

<?php }  

$preids = substr($preids, 0, -1);

 ?>  
    
   
</div>
<?php if($statusencuensta===""){  ?> 
<script> const idspregs=[<?php echo  $preids; ?>];</script> 
<div class="row">
    <div class="col-md-5"> </div>  
    <div class="col-md-3">
        <button type="button" style="text-align: center;" class="btn btn-info" onclick="validarform(<?php echo  $idencuesta; ?>)" >Enviar</button>
    </div>  
    <div class="col-md-4"> </div>    
</div>
<?php }  ?> 



<div>    


<script>

var check=0;
var p2 = [];
var p2id = [];
function checkboxjs(value){


if(check==3 && value.checked == true){

    p2.push(value.value);
    p2id.push(value.id);
    document.getElementById(p2id[0]).checked = false;
    p2.splice(0, 1);
    p2id.splice(0, 1);  

}else{

    if(value.checked == true){

        check=check+1;
        p2.push(value.value);
        p2id.push(value.id);
        /*
        console.log("valor = " + check);
        console.log("valor = " + value.value);
        console.log("valor = " + value.id);*/
    }

    if(value.checked == false){
        check=check-1;

        var elemento = value.value;
        var elementoid = value.id;
        var indice = p2.indexOf(elemento);
        if (indice !== -1) {
          p2.splice(indice, 1);
        }

        var indiceid = p2id.indexOf(elementoid);
        if (indiceid !== -1) {
          p2id.splice(indiceid, 1);
        }
        /*
        console.log("valor = " + check);
        console.log("valor = " + value.value);*/
    }   
 } 
document.getElementById("p3id").value = p2;


}

</script>    



<?php 

 
}  


 


?>

   



</div>

</div>



<style type="text/css">


h1 {
    font-size: 25px!important;
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

</style>     

    


     

  

<?php

$mysqli->close(); 


}
} else {
  echo 'No tiene acceso. ';
} ?>
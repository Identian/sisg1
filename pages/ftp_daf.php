<!--<section class="content-header">
      <h1>
       Base 
        <small>Sub</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"> Inicio</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Pace page</li>
      </ol>
    </section>-->

<section class="content">
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">DAF</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>

          </div>
        </div>
        <div class="box-body">
         
          <br />
          <div class="row">
          <div class="col-md-12 text-center">

       <!--<iframe src="ftp://repmasivos:RepMas2018*@192.168.80.251" style="width:100%;min-height:700px;">-->
	
	   
	  <?php 
$ftp_server = '192.168.80.251';
$ftp_user_name = 'repmasivos';
$ftp_user_pass = 'RepMas2018*';


  // set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// get contents of the current directory
$contents = ftp_nlist($conn_id, ".");

// output $contents
//var_dump($contents);

function listar_directorios_ruta($conn_id){
    // abrir un directorio y listarlo recursivo
    if (is_dir($ruta)) {
       if ($dh = opendir($ruta)) {
          while (($file = readdir($dh)) !== false) {
             //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
             //mostraría tanto archivos como directorios
             //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
             if (is_dir($ruta . $file) && $file!="." && $file!=".."){
                //solo si el archivo es un directorio, distinto que "." y ".."
                echo "<br>Directorio: $ruta$file";
                listar_directorios_ruta($ruta . $file . "/");
             }
          }
       closedir($dh);
       }
    } else {
	echo "<br>No es ruta valida";}
 }

echo  listar_directorios_ruta($contents);
 
?>
          </div>
		  
		  
		  
		  
		  
		 
		
		  
		  
          </div>
          
        </div>
     
    
      </div>
    

    </section>
  
 
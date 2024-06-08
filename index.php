<?php
require_once('conf.php');

if (isset($_POST['ext-gen40']) and $_POST['ext-gen40'] == 'btnLogin') {
  # code...
  $idca = $_POST['username'];
  $consultaUsuario = mysql_query("SELECT * FROM funcionario WHERE alias_iduca='$idca' and estado_funcionario=1 limit 1", $conexion);
  $row1 = mysql_fetch_assoc($consultaUsuario);

  if (md5($_POST['password']) == $row1['clave_funcionario'] ) {
    # code...
    $arrayca = $row1['alias_iduca']; 
  } else {
    echo "<br>";
    echo "Usuario no Valido";
    echo "<br>";
  }

}

if (1 == 1) {
  session_start();  
  // $arrayca = 'luis.rosario'; 
  // $arrayca = array();
  // $arrayca = getallheaders();
  // $alias = $arrayca['SM_USER'];


  if (isset($_GET['q']) and "salir" == $_GET['q']) {
    //$arrayca['SM_USER']="";
    session_destroy();
    header("Location: index.jsp");
    //echo '<meta http-equiv="refresh" content="0;URL=." />';
    //echo '<meta http-equiv="refresh" content="0;URL=https://accesos.supernotariado.gov.co/iam/im/logout.jsp?envAlias=snr" />';
  } else {
  }


  if (isset($arrayca) && "" != $arrayca) {

    if (!isset($_SESSION['snr'])) {
      $idca = trim($arrayca);

      $consulta = mysql_query("SELECT * FROM funcionario WHERE alias_iduca='$idca' and estado_funcionario=1 limit 1", $conexion);
      $row1 = mysql_fetch_assoc($consulta);
      $nn = mysql_num_rows($consulta);
      if (0 < $nn) {
        $_SESSION['snr'] = $row1['id_funcionario'];
        $_SESSION['usuariomoodle'] = $row1['alias_iduca'];
        $_SESSION['sesion'] = md5($row1['alias_iduca'] . $row1['cedula_funcionario']);
        $_SESSION['rol'] = $row1['id_rol'];
        $_SESSION['snr_nombre'] = $row1['nombre_funcionario'];
        $_SESSION['snr_correo'] = $row1['correo_funcionario'];
        $_SESSION['fecha_nacimiento'] = $row1['fecha_nacimiento'];
        $_SESSION['snr_grupo_area'] = $row1['id_grupo_area'];
        $_SESSION['snr_grupo_cargo'] = $row1['id_cargo'];
        $_SESSION['snr_lider_pqrs'] = $row1['lider_pqrs'];
        $_SESSION['snr_perfil_funcionario'] = $row1['perfil_funcionario'];
        $_SESSION['snr_tipo_oficina'] = $row1['id_tipo_oficina'];
        $_SESSION['aprueba_pqrs'] = $row1['aprueba_pqrs'];
        $_SESSION['lider_percepcion'] = $row1['lider_percepcion'];
        $_SESSION['foto_funcionario'] = $row1['foto_funcionario'];
        $_SESSION['cedula_funcionario'] = $row1['cedula_funcionario'];
        $_SESSION['supervisor'] = $row1['supervisor'];
        $_SESSION['guardar_pdf'] = $row1['guardar_pdf'];
        $_SESSION['alias'] = $row1['alias_iduca'];
        $_SESSION['vinculacion'] = $row1['id_vinculacion'];
        $_SESSION['id_cargo_nomina_encargo'] = $row1['id_cargo_nomina_encargo'];



        if (isset($row1['username_iris']) && "" != $row1['username_iris']) {
          $_SESSION['username_iris'] = $row1['username_iris'];
        } else {
          $_SESSION['username_iris'] = '0';
        }

        if (1 == $row1['id_tipo_oficina']) {
          $id_grupo = $row1['id_grupo_area'];
          $actualizar6 = mysql_query("SELECT id_area FROM grupo_area WHERE id_grupo_area='$id_grupo' limit 1", $conexion);
          $row16 = mysql_fetch_assoc($actualizar6);
          $_SESSION['snr_area'] = $row16['id_area'];
          mysql_free_result($actualizar6);
          $_SESSION['id_departamento'] = 11;
          $_SESSION['id_municipio'] = 149;
        } else if (2 == $row1['id_tipo_oficina']) {
          $_SESSION['id_oficina_registro'] = $row1['id_oficina_registro'];


          $query_updatefx = "SELECT id_departamento, id_municipio from oficina_registro where id_oficina_registro=" . $row1['id_oficina_registro'] . " and estado_oficina_registro=1";
          $updatefx = mysql_query($query_updatefx, $conexion);
          $rowfx = mysql_fetch_assoc($updatefx);
          $_SESSION['id_departamento'] = $rowfx['id_departamento'];
          $_SESSION['id_municipio'] = $rowfx['id_municipio'];
          mysql_free_result($updatefx);
        } else if (3 == $row1['id_tipo_oficina']) {

          if (1 == $row1['id_cargo']) {
            $idfuncc = $row1['id_funcionario'];
            //$actualizar67 = mysql_query("SELECT id_notaria FROM posesion_notaria WHERE id_funcionario=".$idfuncc." and fecha_fin is null and estado_posesion_notaria=1 limit 1", $conexion);

            $actualizar67 = mysql_query("SELECT posesion_notaria.id_notaria, nombre_notaria, id_categoria_notaria FROM posesion_notaria, notaria WHERE posesion_notaria.id_notaria=notaria.id_notaria and id_funcionario=" . $idfuncc . " and fecha_fin is null and estado_posesion_notaria=1 limit 1", $conexion);


            $row167 = mysql_fetch_assoc($actualizar67);
            if (isset($row167['id_notaria']) && "" != $row167['id_notaria']) {
              $_SESSION['id_vigilado'] = $row167['id_notaria'];
              $_SESSION['posesionnotaria'] = $row167['id_notaria'];
              $_SESSION['nombre_notaria'] = $row167['nombre_notaria'];
              $_SESSION['id_categoria_notaria'] = $row167['id_categoria_notaria'];
            } else {
              $_SESSION['id_vigilado'] = $row1['id_notaria_f'];
            }
            mysql_free_result($actualizar67);
          } else {
            $_SESSION['id_vigilado'] = $row1['id_notaria_f'];
          }
        } else if (4 == $row1['id_tipo_oficina']) {


          $queryt = sprintf("SELECT * FROM curaduria, situacion_curaduria, funcionario where funcionario.id_funcionario=" . $_SESSION['snr'] . " and situacion_curaduria.id_funcionario=funcionario.id_funcionario and curaduria.id_curaduria=situacion_curaduria.id_curaduria AND (situacion_curaduria.fecha_terminacion IS NULL OR situacion_curaduria.fecha_terminacion>='$realdate') limit 1");
          $actualizar67t = mysql_query($queryt, $conexion);
          $row167t = mysql_fetch_assoc($actualizar67t);
          if (isset($row167t['id_curaduria']) && "" != $row167t['id_curaduria']) {
            $_SESSION['id_vigiladocurador'] = $row167t['id_curaduria'];
          } else {
          }
          mysql_free_result($actualizar67t);
        } else {
        }



        mysql_free_result($consulta);

        ?>
        <!--<script src='ip.js'></script>-->
        <?php
        //setcookie("iplocal","iplocal");

        if (isset($_COOKIE['iplocal'])) {
          $ip_snr = $_COOKIE['iplocal'];
          //echo $ip_snr;
        } else {
          $ip_snr = '0';
        }




        $insertSQL887 = sprintf(
          "INSERT INTO auditoria (id_funcionario, alias, ip, fecha_hora, url, descripcion_auditoria, ip_local) VALUES (%s, %s, %s, now(), %s, %s, %s)",
          GetSQLValueString($_SESSION['snr'], "int"),
          GetSQLValueString($alias, "text"),
          GetSQLValueString($iplocal, "text"),
          GetSQLValueString('inicio', "text"),
          GetSQLValueString('inicio', "text"),
          GetSQLValueString($ip_snr, "text")
        );
        $Result1887 = mysql_query($insertSQL887, $conexion);

        mysql_free_result($Result1887);
      } else {
        //echo '<div style="background:#b21f24;color:#fff;"><center>COMUNICARSE AL CORREO: ana.diaz@supernotariado.gov.co PARA CREAR SU USUARIO Y ASIGNAR SUS PERMISOS.</center></div>';

        echo '<div style="background:#b21f24;color:#fff;"><center>ERROR DE GESTOR DE USUARIOS.</center></div>';

        //echo '<div style="background:#b21f24;color:#fff;"><center>En este momento las aplicaciones de la SNR se encuentran en Mantenimiento.</center></div>';

      }
    } else {
    }
  } else {
    // echo '<meta http-equiv="refresh" content="0;URL=https://accesos.supernotariado.gov.co/iam/im/logout.jsp?envAlias=snr" />';
  }



  if (isset($_SESSION['snr'])) {

    require_once('pages/listas.php');


    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Sistema Integrado de Servicios y Gestión</title>
      <!--<meta http-equiv="X-Frame-Options" content="deny">-->
      <meta name="author" content="https://www.linkedin.com/in/giovanniortegon/">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <script src="plugins/jQuery/jquery.min.js"></script>
      <!--
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  -->
      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>



      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="media/font-awesome/css/font-awesome.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

      <link href='images/favicon.ico' rel='icon' type='image/x-icon' />


      <link rel="stylesheet" href="dist/css/stylenot.css">
      <script type="text/javascript" src="dist/js/pages/sweetalert.min.js"></script>


      <!-- JONATHAN SACAR BUTTON COPY EXCEL CSV PDF EN TABLE -->
      <link rel="stylesheet" type="text/css" href="dist/xls_jo/buttons.dataTables.min.css">
      <script type="text/javascript" language="javascript" src="dist/xls_jo/jquery.dataTables.min.js"></script>
      <script type="text/javascript" language="javascript" src="dist/xls_jo/dataTables.buttons.min.js"></script>
      <script type="text/javascript" language="javascript" src="dist/xls_jo/jszip.min.js"></script>
      <script type="text/javascript" language="javascript" src="dist/xls_jo/pdfmake.min.js"></script>
      <script type="text/javascript" language="javascript" src="dist/xls_jo/vfs_fonts.js"></script>
      <script type="text/javascript" language="javascript" src="dist/xls_jo/buttons.html5.min.js"></script>
      <!-- JONATHAN FIN SACAR BUTTON COPY EXCEL CSV PDF EN TABLE -->





      <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">



      <!-- Theme style  https://adminlte.io/docs/2.4/license     -->
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
page. However, you can choose any other skin. Make sure you
apply the skin class to the body tag so the changes take effect.
-->
      <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
      <!--Javascript-->

      <script>
        var arraydays = ["1920-01-01"];
      </script>

      <style>
        .blanco {
          color: #fff;
        }

        .verde {
          color: #00A65A;
        }

        .rojo {
          color: #DD4B39;
        }

        .azul {
          color: #0369b7;
        }

        .texto {
          color: #666;
          font-size: 16px;
          text-align: justify;
        }

        .gris {
          background: #555;
        }

        .iconos {
          color: #fff;
        }

        .iconos:hover {
          background: #5F5A62;
          cursor: pointer;
        }

        .mintamano {
          min-width: 180px;
        }

        .campominimo {
          min-width: 300px;
        }

        .opciones {
          width: 200px;
        }

        tr:hover {
          background: #f2f2f2;
        }

        .mouse {
          cursor: pointer;
        }

        textarea {
          min-height: 70px;
        }



        .datepicker {
          background: transparent url(images/calendar.png) no-repeat center right;
          background-color: #fff;
          text-align: left;
          cursor: pointer;
          padding-left: 5px;
          width: 200px;
        }

        .datepickera {
          background: transparent url(images/calendar.png) no-repeat center right;
          background-color: #fff;
          text-align: left;
          cursor: pointer;
          padding-left: 5px;
          width: 200px;
        }


        .convgris img {
          opacity: .3;
        }





        .caja {
          width: 100%;
          height: 30px;
          border-radius: 0 15px 15px 0;
          margin: -12px 0 14px 0;
          color: #fff;
          text-align: center;
          padding: 4px;
          border: 1px solid #777;


        }

        .cajavacia {
          background: #bbb;
        }

        .cajallena {
          background: #B40404;
          cursor: pointer;

        }


        .mensajeaclaracion {
          color: #B40404;
        }

        .triangulo {

          border-top: 15px solid transparent;
          border-bottom: 15px solid transparent;
          border-left: 30px solid #f1f1f1;
          margin: -25px 0 0 -5px;
          position: relative;

        }

        .text_titulos {
          font-size: 13px;
          text-transform: capitalize;
          font-weight: normal;
        }

        .numer {
          font-size: 12px;
          text-transform: capitalize;
        }

        .muestra {
          font-size: 15px;
          text-transform: capitalize;
          border: 1px solid #d2d6de;
          width: 100%;

        }

        .totales {
          font-size: 90%;
          text-transform: capitalize;
          width: 100%;
          color: #fff;
          background: #555;
          margin: 10px 0px 0px 0px;
        }

        .numeros_totales {
          margin: -8px 0px 0px 0px;
          font-size: 100%;
          width: 100%;
          color: #fff;
          background: #555;
        }

        .numero_total {
          text-align: center;
          width: 100%;
        }

        .totalescon {
          font-size: 120%;
          text-transform: capitalize;
          width: 100%;
          margin: 10px 0px 0px 0px;
        }


        .letrablanca {
          color: #fff;
        }

        ul.wysihtml5-toolbar li a[title="Insert image"] {
          display: none;
        }

        ul.wysihtml5-toolbar li.dropdown {
          display: none;
        }

        ul.wysihtml5-toolbar li a[title="Insert link"] {
          display: none;
        }



        .linkf {
          cursor: pointer;
        }






        .salert {
          -webkit-animation: color_change 0.5s infinite alternate;
          -moz-animation: color_change 0.5s infinite alternate;
          -ms-animation: color_change 0.5s infinite alternate;
          -o-animation: color_change 0.5s infinite alternate;
          animation: color_change 0.5s infinite alternate;
          width: 100%;
          height: 5px;
        }

        @-webkit-keyframes color_change {
          from {
            background-color: #B40404;
          }

          to {
            background-color: #fff;
          }
        }

        @-moz-keyframes color_change {
          from {
            background-color: #B40404;
          }

          to {
            background-color: #fff;
          }
        }

        @-ms-keyframes color_change {
          from {
            background-color: #B40404;
          }

          to {
            background-color: #fff;
          }
        }

        @-o-keyframes color_change {
          from {
            background-color: #B40404;
          }

          to {
            background-color: #fff;
          }
        }

        @keyframes color_change {
          from {
            background-color: #B40404;
          }

          to {
            background-color: #fff;
          }
        }








        .venactiva {
          background: #fafafa;
          color: #fff;
          width: 99%;
          min-height: 1024px;
          position: fixed;
          top: 1px;
          left: 10px;
          z-index: 9999;
        }




        .pactivac {
          color: #000;
          font-weight: bold;
          text-decoration: underline #fff;
        }
      </style>




    </head>

    <body class="hold-transition skin-blue sidebar-mini"> <!--onload="copiar();"-->

      <?php // if (1226==$_SESSION['snr']) { echo '<div id="causuarios">'.print_r($arrayca).'</div>';} else {}
      ?>

      <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

          <!-- Logo -->
          <a href="./" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>SNR</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SNR</b></span>
          </a>

          <!-- Header Navbar -->
          <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
              <span class="sr-only">Menu</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">




              <ul class="nav navbar-nav">






                <li class="dropdown tasks-menu">

                  <a href="https://office.com" target="_blank" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope" title="Correo"></i>
                    <span class="label label-danger"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- <li class="header">@supernotariado.gov.co</li>-->

                    <li class="footer">
                      <a href="https://office.com" target="_blank" class="">Acceder a correo</a>
                    </li>
                  </ul>
                </li>




                <li class="dropdown messages-menu">
                  <!-- Menu toggle button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-success">
                      <?php
                      $navegador = $_SERVER['HTTP_USER_AGENT'];
                      if (strpos($navegador, 'Chrome') !== false) {
                        $varnavegador = 0;
                        $mensajenavegador = 'Tienes 0 mensajes';
                        echo $varnavegador;
                      } else {
                        $varnavegador = 1;
                        $mensajenavegador = 'Se recomienda usar el <br>navegador Google Chrome.';
                        echo $varnavegador;
                      }
                      ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Tienes <?php echo $varnavegador; ?> mensajes</li>
                    <li>
                      <!-- inner menu: contains the messages -->
                      <ul class="menu">
                        <li><!-- start message -->
                          <a href="#">
                            <div class="pull-left">
                              <!-- User Image -->
                              <img src="dist/img/email.png" class="img-circle" alt="User Image">
                            </div>
                            <!-- Message title and timestamp -->
                            <h4>
                              <?php echo $mensajenavegador; ?>
                            </h4>
                            <!-- The message -->
                            <p></p>
                          </a>
                        </li>
                        <!-- end message -->
                      </ul>
                      <!-- /.menu -->
                    </li>
                    <li class="footer"><a href="" class="">Mensajes automáticos</a></li>
                  </ul>
                </li>
                <!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                  <!-- Menu toggle button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <?php

                    if (1 == $_SESSION['rol'] or 2072 == $_SESSION['snr'] or (1 == $_SESSION['snr_grupo_cargo'] && 3 == $_SESSION['snr_tipo_oficina'])) {

                      $fechamenosdiez = date('Y-m-d', strtotime('-9 day', strtotime($realdate)));

                      $queryx = sprintf("SELECT nombre_notaria, fecha_publicacion, url FROM derecho_preferencia, notaria WHERE derecho_preferencia.id_notaria= notaria.id_notaria and fecha_publicacion>='$fechamenosdiez' and estado_derecho_preferencia=1");
                      $selectx = mysql_query($queryx, $conexion);
                      $rowx = mysql_fetch_assoc($selectx);
                      $totalRowsx = mysql_num_rows($selectx);
                      if (0 < $totalRowsx) {
                        $der = '';
                        $cantipre = $totalRowsx;
                        do {
                          $der .= '<li> Derecho Preferencia <a href="files/derecho_preferencia/' . $rowx['url'] . '" target="_blank" title="' . $rowx['fecha_publicacion'] . '">' . $rowx['nombre_notaria'] . '</a></li>';
                        } while ($rowx = mysql_fetch_assoc($selectx));
                      } else {
                        $der = '';
                        $cantipre = 0;
                      }
                      mysql_free_result($selectx);
                    } else {
                      $cantipre = 0;
                      $der = '';
                    }




                    if (0 < $cantipre) {
                      echo '<span class="label label-warning">' . $cantipre . '</span>';
                    } else {
                      echo '<span class="label label-warning" id="cuentanotificar"></span>';
                    }
                    ?>

                  </a>
                  <ul class="dropdown-menu">
                    <li class="header"> <?PHP if (0 < $cantipre) {
                                          echo '';
                                        } else {
                                          echo '<span id="cuentanotificarv2"></span>';
                                        }
                                        ?>
                      Notificaciones</li>
                    <li>
                      <!-- Inner Menu: contains the notifications -->
                      <ul class="menu">
                        <?PHP if (0 < $cantipre) {

                          //ECHO '<li><a href="https://www.supernotariado.gov.co/delegada-de-notariado/derechos-preferencia/" class="comprar" target="_blank">
                          //                              <i class="fa fa-file-pdf-o"></i>Nuevo derecho de preferencia</a>     </li>';

                          echo $der;
                        } else {
                        }
                        ?>











                        <?php
                        if (3 > $_SESSION['snr_tipo_oficina']) { // && (1==$_SESSION['snr_grupo_cargo'] or 1==$_SESSION['snr_lider_pqrs'])) {		   
                          $query = "SELECT solicitud_pqrs.id_solicitud_pqrs, radicado FROM asignacion_pqrs_funcionario, solicitud_pqrs WHERE asignacion_pqrs_funcionario.id_solicitud_pqrs=solicitud_pqrs.id_solicitud_pqrs 
AND id_funcionario=" . $_SESSION['snr'] . " AND id_estado_solicitud!=5 AND estado_asignacion_pqrs_funcionario=1 AND estado_solicitud_pqrs=1";
                          $selectnoti = mysql_query($query, $conexion);
                          $rownoti = mysql_fetch_assoc($selectnoti);
                          $totalRows = mysql_num_rows($selectnoti);
                          if (0 < $totalRows) {
                            do {
                              echo '<li>';
                              echo '<a href="https://sisg.supernotariado.gov.co/solicitud_pqrs&' . $rownoti['id_solicitud_pqrs'] . '.jsp"><i class="fa fa-warning text-yellow"></i> ' . $rownoti['radicado'] . '</a>';
                              echo '</li>';
                            } while ($rownoti = mysql_fetch_assoc($selectnoti));
                          } else {
                            $totalRows = 0;
                          }
                          mysql_free_result($selectnoti);
                        } else {
                          $totalRows = 0;
                        }


                        $pqrspendientes = $totalRows;
                        ?>

                        <script>
                          var tramitenotificacion = <?php echo $totalRows; ?>;
                          document.getElementById("cuentanotificar").innerHTML = tramitenotificacion;
                          document.getElementById("cuentanotificarv2").innerHTML = tramitenotificacion;
                        </script>




                      </ul>
                    </li>
                    <li class="footer"><a href="xls/pqrs_pendientes&0&<?php echo $_SESSION['snr']; ?>.xls">Reporte notificaciones pendientes</a></li>
                  </ul>
                </li>
                <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger">0</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Tramites internos</li>
                    <li>
                      <!-- Inner menu: contains the tasks -->
                      <ul class="menu">



                        <li><a>0</a></li>




                      </ul>
                    </li>
                    <li class="footer">
                      <a href="#" class="">Tramites</a>
                    </li>
                  </ul>
                </li>

















                <!-- SOPORTE TICKET -->

                <li class="dropdown tasks-menu">

                  <a href="http://mesadeservicio.supernotariado.gov.co:8080/CAisd/pdmweb.exe" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-question-circle" title="Ticket de soporte"></i>
                    <span class="label label-danger">0</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Ticket de soporte</li>

                    <li class="footer">
                      <a href="http://mesadeservicio.supernotariado.gov.co:8080/CAisd/pdmweb.exe" class="">Acceder</a>
                    </li>
                  </ul>
                </li>









                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="files/avatar.png" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs"><?php echo $_SESSION['snr_nombre']; ?> </span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                      <img src="files/<?php echo $_SESSION['foto_funcionario']; ?>" class="img-circle" alt="User Image">

                      <p>
                        <?php




                        if (1 == $_SESSION['snr_tipo_oficina']) {

                          $snr_grupo_area = quees('grupo_area', $_SESSION['snr_grupo_area']);
                          echo $snr_grupo_area;
                          echo '<small>' . $_SESSION['snr_perfil_funcionario'] . '</small>';
                        } else {
                          echo quees('tipo_oficina', $_SESSION['snr_tipo_oficina']);
                          echo '<small>';
                          echo quees('cargo', $_SESSION['snr_grupo_cargo']);
                          echo '</small>';
                        }

                        ?>

                      </p>
                    </li>
                    <!-- Menu Body -->

                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="usuario.jsp" class="btn btn-default btn-flat comprar">Mi perfil</a>
                      </div>
                      <div class="pull-right">
                        <a href="salir.jsp" class="btn btn-default btn-flat">Salir</a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                  <a href="#" data-toggle="control-sidebar"><i class="fa fa-phone"></i></a>
                </li>
                <li>
                  <a href="index.php?q=salir" data-toggle="control-sidebar">Salir</a>                  
                </li>
              </ul>



            </div>
          </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <!-- Sidebar user panel -->

            <!-- search form -->
            <form action="ciudadanos.jsp" method="post" class="sidebar-form">
              <div class="input-group">
                <input type="hidden" name="campo" value="nombre_ciudadano">

                <input type="text" name="buscar" class="form-control" placeholder="Buscar...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">Menu</li>
              <!-- Optionally, you can add icons to the links -->
              <li class="active"><a href="./"><i class="fa fa-laptop"></i> <span>Inicio</span></a></li>



              <li><a href="directorio.jsp"><i class="fa fa-users"></i> <span>Directorio</span></a></li>

              <?php
              if (1 == $_SESSION['rol'] or 19 == $_SESSION['snr_area']) { ?>
                <li><a href="cuenta_cobro.jsp"><i class="fa fa-cube"></i> <span>Cuentas de cobro</span></a></li>
              <?php } else {
              } ?>


              <!-- <php
              if (3 > $_SESSION['snr_tipo_oficina'] and (3 == $_SESSION['vinculacion'] or 4 == $_SESSION['vinculacion'])) { ?>
                <li><a href="solicitar_certificado.jsp"><i class="fa  fa-file"></i> <span>Certificación / Funciones</span></a></li>
              <php  } else {} ?> -->


              <?php
              $nump69 = privilegios(69, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 0 < $nump69) { ?>
                <li><a href="reporte_fac_notaria.jsp"><i class="fa  fa-cubes"></i> <span>Facturación electrónica</span></a></li>

              <?php  } else {
              }

              $nump97 = privilegios(97, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 0 < $nump97) { ?>
                <li><a href="validacion_notarias_digitales.jsp"><i class="fa  fa-cubes"></i> <span>Digitalización Notarial</span></a></li>
              <?php } else {
              } ?>














              <?php

              $nump141 = privilegios(141, $_SESSION['snr']);  // Tutelas Grupo de Administracion Judicial Admin
              $nump142 = privilegios(142, $_SESSION['snr']); // Tutelas Grupo de Administracion Judicial Abogados

              // PRIVILEGIOS DEPENDECIAS
              $nump23 = privilegios(23, $_SESSION['snr']);  // Tutelas Grupo de Administracion Judicial Dependencias Lider
              $nump24 = privilegios(24, $_SESSION['snr']); // Tutelas Grupo de Administracion Judicial Dependencias Abogado

              if (1 == $_SESSION['rol'] || 0 < $nump141 || 0 < $nump142) {
                $idDONC = 0;
                $prefijoDONC = 'DEPENDENCIA';
                $privilegiosLider = 0;
                $privilegiosAbogado = 0;
              } elseif (0 < $nump23 || 0 < $nump24) {
                // Dependencias
                $idDONC = $_SESSION['snr_grupo_area'];
                $prefijoDONC = 'DEPENDENCIA';
                $privilegiosLider = $nump23; // Lider Tutela
                $privilegiosAbogado = $nump24;  // Abogado Tutela

              } elseif (22222 == $_SESSION['snr_tipo_oficina']) {
                // Oficinas de Registro
                $idDONC = $_SESSION['id_oficina_registro'];
                $prefijoDONC = 'OFICINA REGISTRO';
                $privilegiosLider = 0 < privreg($idDONC, $idFuncionario, 9, 14); // Lider Tutela
                $privilegiosAbogado = 0 < privreg($idDONC, $idFuncionario, 9, 15); // Abogado Tutela

              } elseif (333 == $_SESSION['snr_tipo_oficina']) {
                // Notarias
                $idDONC = $_SESSION['posesionnotaria'];
                $prefijoDONC = 'NOTARIA';
                $privilegiosLider = 0 < privilegiosnotariado($idDONC, 15, $idFuncionario); // Lider Tutela
                $privilegiosAbogado = 0 < privilegiosnotariado($idDONC, 16, $idFuncionario); // Abogado Tutela

              } elseif (4444 == $_SESSION['snr_tipo_oficina']) {
                // Curadurias
                $idDONC = $_SESSION['id_vigiladocurador'];
                $prefijoDONC = 'CURADURIA';
                $privilegiosLider = 0 < privilegiosnotariado($idDONC, 1, $idFuncionario); // Lider Tutela
                $privilegiosAbogado = 0 < privilegiosnotariado($idDONC, 2, $idFuncionario); // Abogado Tutela
              } else {
                $idDONC = 0;
                $prefijoDONC = '';
                $privilegiosLider = 0;
                $privilegiosAbogado = 0;
              }

              ?>
              <?php if (1 == $_SESSION['rol'] ||  0 < $nump141 ||  0 < $nump142 || 0 < $privilegiosLider || 0 < $privilegiosAbogado) {  ?>
                <li><a href="gaj_tutela.jsp"><i class="fa fa-file"></i> <span>Tutelas</span></a></li>
              <?php } else {
              }
              ?>






              <?php
              $nump167 = privilegios(167, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Admin
              $nump168 = privilegios(168, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Abogado
              $nump171 = privilegios(171, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Subdirector
              $nump172 = privilegios(172, $_SESSION['snr']); // Grupo Asignacion Juridica Registral Notificador

              if (1 == $_SESSION['rol'] || 0 < $nump167 || 0 < $nump168 || 0 < $nump171 || 0 < $nump172) {  ?>
                <li><a href="sub_apoyo_juridico_registral.jsp"><i class="fa fa-cubes"></i> <span>Asignación Juridica Registral</span></a></li>
              <?php } else {
              } ?>


























              <li><a href="pqrs.jsp"><i class="fa fa-outdent"></i> <span>PQRS
                    <?php if (3 == $_SESSION['snr_tipo_oficina']) {
                      echo ' Requerimiento';
                    } else {
                    }  ?>
                  </span></a></li>


              <?php if (3 == $_SESSION['snr_tipo_oficina']) {  ?>
                <li><a href="traslado_pqrs.jsp"><i class="fa fa-outdent"></i> <span>PQRS traslado</span></a></li>
              <?php } else {
              } ?>





              <?php if (3 > $_SESSION['snr_tipo_oficina']) { ?>
                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Atención a ciudadanos</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">

                    <?php
                    $nump91 = privilegios(91, $_SESSION['snr']);
                    if (0 < $nump91 or 2 == $_SESSION['snr_tipo_oficina'] or 40 == $_SESSION['snr_grupo_area'] or 24 == $_SESSION['snr_grupo_area'] or 1 == $_SESSION['rol']) { ?>
                      <li><a href="ciudadanos.jsp"><i class="fa fa-child"></i> <span>Ciudadanos</span></a></li>
                    <?php } else {
                    } ?>





                    <?php $nump155 = privilegios(155, $_SESSION['snr']);
                    if (1 == $_SESSION['rol'] or 0 < $nump155) { ?>
                      <li><a href="gestion_pqrs.jsp"><i class="fa fa-file"></i> <span>Reparto de PQRS</span></a></li>
                    <?php } else {
                    } ?>



                    <?php if (2 >= $_SESSION['snr_tipo_oficina']) { ?>
                      <li><a href="pqrs_anteriores.jsp"><i class="fa fa-list-alt"></i> <span>PQRS anteriores</span></a></li>
                    <?php } else {
                    } ?>

                    <?php
                    $nump37 = privilegios(37, $_SESSION['snr']);
                    if (24 == $_SESSION['snr_grupo_area'] or 1 == $_SESSION['rol'] or 0 < $nump37) { ?>
                      <li><a href="chat.jsp"><i class="fa fa-commenting-o"></i> <span>Chat</span></a></li>
                    <?php } else {
                    } ?>

                  </ul>
                </li>
              <?php } ?>





              <?php
              $nump83 = privilegios(83, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 0 < $nump83) { ?>
                <!--<li><a href="ausentismo.jsp"><i class="fa fa-legal"></i> <span>Ausentismo</span></a></li>-->
              <?php } else {
              } ?>
              <?php if (1 == $_SESSION['rol'] or 0 < $nump83) { ?>
                <li><a href="permiso_funcionario.jsp"><i class="fa fa-cube"></i> <span>Permisos</span></a></li>



              <?php } else {
              } ?>



              <?php
              $nump136 = privilegios(136, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] || 0 < $nump136) { ?>
                <li><a href="contratos.jsp"><i class="fa fa-cube"></i> <span>Contratos</span></a></li>
              <?php } ?>






              <?php if (3 > $_SESSION['snr_tipo_oficina']) { ?>
                <li class="treeview">
                  <a href="#"><i class="fa fa-users"></i> <span>Bienestar</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">

                    <li><a href="credito_icetex.jsp"><i class="fa fa-user"></i> <span>Crédito educativo Icetex</span></a></li>
                    <li><a href="incentivo_educativo.jsp"><i class="fa fa-user"></i> <span>Incentivo educativo</span></a></li>



                    <li><a href="inscripcion_gimnasio.jsp"><i class="fa fa-user"></i>Insc. Gimnasio.</a></li>
                    <?php
                    if (3 > $_SESSION['snr_tipo_oficina'] && (1 == $_SESSION['snr_grupo_cargo'] or 2 == $_SESSION['snr_grupo_cargo']
                      or 4 == $_SESSION['snr_grupo_cargo'])) {
                    } else {
                    }
                    ?>

                    <li><a href="salas_lactantes.jsp"><i class="fa fa-user"></i>Salas lactantes</a></li>


                    <?php
                    $nump153 = privilegios(153, $_SESSION['snr']);
                    $arraydd = array(33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43);
                    if (in_array($_SESSION['id_cargo_nomina_encargo'], $arraydd) or 1 == $_SESSION['rol'] or 0 < $nump153) {
                      echo '<li><a href="dotacion.jsp"><i class="fa fa-user"></i>Dotación</a></li>';
                    } else {
                    }
                    $nump117 = privilegios(117, $_SESSION['snr']);
                    if (1 == 2 and (1 == $_SESSION['rol'] or 3 == $_SESSION['vinculacion'] or 4 == $_SESSION['vinculacion'])) {
                      //echo ' <li><a href="reclamacion_edl.jsp"><i class="fa fa-user"></i> <span>Módulo evaluado EDL</span></a></li>';
                    } else {
                    }
                    ?>


                    <?php

                    $nump170 = privilegios(170, $_SESSION['snr']);
                    if (1 == $_SESSION['rol'] or 0 < $nump170) {
                      echo ' <li><a href="https://sisg.supernotariado.gov.co/encuesta_genero/" target="_blank"><i class="fa fa-user"></i> <span>Encuesta de Genero</span></a></li>';
                      echo ' <li><a href="genero.jsp"><i class="fa fa-user"></i> <span>Analisis de encuesta G.</span></a></li>';
                    }

                    ?>
                  </ul>
                </li>





                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Seguridad y salud T.</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="condicion_salud.jsp"><i class="fa fa-user"></i> <span>Condicion de salud 2022</span></a></li>
                    <li><a href="morbilidad.jsp"><i class="fa fa-user"></i> <span>Condicion de salud 2023</span></a></li>
                    <li><a class="pactiva" style="cursor:pointer;"><i class="fa fa-user"></i> <span>Pausa activa</span></a></li>
                  </ul>
                </li>


                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Gestión del conocimiento.</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <!--<li><a href="cursos.jsp"><i class="fa fa-user"></i> <span>Inscripción a capacitaciones</span></a></li>-->
                    <li><a href="capacitacion.jsp"><i class="fa fa-users"></i> <span>Sistema de Capacitación</span></a></li>

                  </ul>
                </li>






                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Evaluación Desemp.</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="edl_fun.jsp"><i class="fa fa-user"></i> <span>Módulo EDL</span></a></li>
                    <li><a href="edl.jsp"><i class="fa fa-user"></i> <span>Entrega EDL</span></a></li>
                  </ul>
                </li>



              <?php } else {
              }  ?>





              <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Registro</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">

                  <li><a href="orips.jsp"><i class="fa fa-building"></i> <span>ORIP</span></a></li>




                  <?php

                  if (1 == $_SESSION['rol']) { ?>
                    <li><a href="reparto_posesion_regular.jsp"><i class="fa fa-home"></i> <span>Reparto Pos. Regular</span></a></li>
                  <?php } else {
                  } ?>



                  <?php
                  $nump95 = privilegios(95, $_SESSION['snr']);
                  if ((2 == $_SESSION['snr_tipo_oficina'] and 1 == $_SESSION['snr_grupo_cargo']) or 1 == $_SESSION['rol'] or 0 < $nump95) { ?>
                    <li><a href="reporte_diario_orip.jsp"><i class="fa fa-home"></i> <span>Reporte Diario ORIP</span></a></li>
                  <?php } else {
                  } ?>


                  <?php
                  if (($_SESSION['snr_tipo_oficina'] <= 2 and 1 == $_SESSION['snr_grupo_cargo']) or 1 == $_SESSION['rol']) { ?>
                    <li><a href="registro_bi/" target="_blank">
                        <i class="fa fa-cube"></i> <span>Tablero de control</span></a></li>

                    <li><a href="https://app.powerbi.com/links/Rxj5C8iqfj?ctid=9b1ecfaa-c675-42ee-b297-0eaeb51bcc4c&pbi_source=linkShare" target="_blank">
                        <i class="fa fa-cube"></i> Tablero de registro</a></li>

                  <?php } else {
                  } ?>

                  <!-- <li><a href="actos_inscripcion.jsp"><i class="fa fa-file"></i> Actos de inscripción</a></li>-->

                </ul>
              </li>






              <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Admin. Notarial</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">

                  <?php
                  $nump115 = privilegios(115, $_SESSION['snr']);
                  if (0 < $nump115 or 1 == $_SESSION['rol']) { ?>
                    <li><a href="entidades_reparto.jsp"><i class="fa fa-file"></i> <span>Entidades de Reparto</span></a></li>
                    <li><a href="repartos.jsp"><i class="fa fa-file"></i> <span>Control Repartos</span></a></li>



                    <li><a href="restitucion_reparto.jsp"><i class="fa fa-file"></i> <span>Restitución de Repartos</span></a></li>

                    <li><a href="resoluciones_notariado.jsp"><i class="fa fa-file"></i> <span>Control Resoluciones</span></a></li>

                    <li><a href="certificaciones_notariales.jsp"><i class="fa fa-file"></i> <span>Cert. Notariales</span></a></li>

                    <li><a href="https://app.powerbi.com/view?r=eyJrIjoiNWQzNjlkYmEtODk5NC00NTY0LTg2M2UtZWU2ZjEyOWE4YTI5IiwidCI6IjliMWVjZmFhLWM2NzUtNDJlZS1iMjk3LTBlYWViNTFiY2M0YyIsImMiOjR9" target="_blank"><i class="fa fa-file"></i> <span>Control de PQRS</span></a></li>



                  <?php } else {
                  } ?>


                  <?php
                  if ((3 == $_SESSION['snr_tipo_oficina'] and 1 == $_SESSION['snr_grupo_cargo']) or 1 == $_SESSION['rol']) {
                  ?>
                    <li><a href="certificacion&<?php echo $_SESSION['snr']; ?>.jsp"><i class="fa fa-user"></i> <span>Certificado de Notario</span></a></li>
                  <?php } else {
                  } ?>

                </ul>
              </li>








              <?php
              $nump124 = privilegios(124, $_SESSION['snr']);
              $nump125 = privilegios(125, $_SESSION['snr']);
              $nump126 = privilegios(126, $_SESSION['snr']);
              $nump127 = privilegios(127, $_SESSION['snr']);
              $nump128 = privilegios(128, $_SESSION['snr']);
              if (0 < $nump124 or 0 < $nump125 or 0 < $nump126 or 0 < $nump127 or 0 < $nump128 or 1 == $_SESSION['rol']) { ?>

                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Control disciplinario</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">


                    <li><a href="control_proceso_migracion.jsp"><i class="fa fa-file"></i> <span>Migración antiguo SID</span></a></li>
                    <li><a href="control_proceso.jsp"><i class="fa fa-file"></i> <span>Sistema disciplinario</span></a></li>


                  </ul>
                </li>

              <?php } else {
              } ?>





              <?php
              $nump147 = privilegios(147, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 0 < $nump147) { ?>
                <li><a href="catastro_gestor.jsp"><i class="fa fa-delicious"></i> <span>Gestores Catastrales</span></a></li>
              <?php } else {
              } ?>




              <li class="treeview">
                <a href="#"><i class="fa fa-bank"></i> <span>Notarias</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">

                  <li><a href="notarias.jsp"><i class="fa fa-bank"></i> <span>Notarias</span></a></li>
                  <li><a href="turnos_sabados.jsp"><i class="fa  fa-cubes"></i> <span>Turnos sabados</span></a></li>
                  <li><a href="carceles.jsp"><i class="fa  fa-cubes"></i> <span>Turnos de carceles</span></a></li>
                  <?php
                  $nump62 = privilegios(62, $_SESSION['snr']);
                  $nump63 = privilegios(63, $_SESSION['snr']);
                  $nump64 = privilegios(64, $_SESSION['snr']);
                  if (1 == $_SESSION['rol'] or 0 < $nump62 or 0 < $nump63 or 0 < $nump64 or 3 == $_SESSION['snr_tipo_oficina']) { ?>
                    <!-- <li><a href="beneficio_notariado.jsp"><i class="fa  fa-cubes"></i> <span>Apoyo económico</span></a></li>-->
                    <li><a href="reparto_asignado.jsp"><i class="fa  fa-cubes"></i> <span>Repartos</span></a></li>





                    <?php if (1 == $_SESSION['rol']) { ?>
                      <li><a href="testamento.jsp"><i class="fa fa-file"></i> <span>Testamentos</span></a></li>
                    <?php } else {
                    } ?>

                  <?php } else {
                  } ?>


                </ul>
              </li>









              <li><a href="curadurias.jsp"><i class="fa fa-home"></i> <span>Curadurias</span></a></li>


              <?php if (1 == $_SESSION['rol']) { ?>
                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>HV: Curadurias</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="lista_elegibles_curadurias.jsp"><i class="fa fa-child"></i> <span>Lista elegibles</span></a></li>
                    <li><a href="control_lista_elegibles.jsp"><i class="fa fa-child"></i> <span>Control lista elegibles</span></a></li>
                    <li><a href="control_documentos.jsp"><i class="fa fa-child"></i> <span>Control de documentos</span></a></li>
                    <li><a href="analisis_curaduria_interdisciplinario.jsp"><i class="fa fa-child"></i> <span>Control de equi. inter.</span></a></li>
                    <li><a href="curadores.jsp"><i class="fa fa-child"></i> <span>Control Curadores</span></a></li>

                    <!--
<li><a href="personal_curaduria.jsp"><i class="fa fa-child"></i> <span>Personal curaduria</span></a></li>

<li><a href="documentos.jsp"><i class="fa fa-child"></i> <span>Documentos del personal</span></a></li>-->




                  </ul>
                </li>
              <?php } ?>







              <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Gestión juridica</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">

                  <li><a href="derechos_preferencia.jsp">Derechos de preferencia</a></li>
                  <li><a href="carrera_notarial.jsp">Elecciones CSCN </a></li>
                  <li><a href="carrera_notarial.jsp">Acuerdos</a></li>
                  <?php

                  if (3 > $_SESSION['snr_tipo_oficina']) { ?>
                    <li><a href="conceptos.jsp">Conceptos de OAJ</a></li>
                    <li><a href="tutelas.jsp">Tutelas</a></li>

                  <?php } else {
                  } ?>


                  <li><a href="sentencias.jsp">Sentencias</a></li>
                  <li><a href="">Providencias judiciales</a></li>


                  <?php
                  if (1 == $_SESSION['rol'] or 1 == $_SESSION['snr_tipo_oficina']) { ?>
                    <li><a href="notificacion_aviso.jsp">Notificaciones por aviso</a></li>
                  <?php  } else {
                  } ?>


                </ul>
              </li>







              <?php if (1 == $_SESSION['snr_tipo_oficina']) { ?>
                <li><a href="correspondencia.jsp"><i class="fa fa-file-pdf-o"></i> <span>Correspondencia</span></a></li>
              <?php } else {
              } ?>

              <?php if (1 == $_SESSION['snr_tipo_oficina']) { ?>
                <li><a href="resoluciones.jsp"><i class="fa fa-list"></i> <span>Resoluciones</span></a></li>

              <?php  } else {
              } ?>


              <?php

              $nump100 = privilegios(100, $_SESSION['snr']);
              $nump101 = privilegios(101, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 0 < $nump100 or 0 < $nump101) { ?>
                <li><a href="comision_vista.jsp"><i class="fa fa-list"></i> <span>Control de comisiones</span></a></li>

              <?php  } else {
              } ?>


              <?php
              $agenda = agenda($_SESSION['snr']);

              if (1 == $_SESSION['rol'] or 24 == $_SESSION['snr_grupo_area'] or (0 < $agenda)) {
                echo '<li><a href="agenda&' . $_SESSION['snr'] . '.jsp"><i class="fa fa-list"></i> <span>Agendamiento</span></a></li>';
              } else {
              }

              if (1 == $_SESSION['snr_tipo_oficina']) {
                $numven = 0;
              } else {
                $numven = $_SESSION['id_oficina_registro'];
              }

              $nump102 = privilegios(102, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 0 < $nump102) {
                echo '<li><a href="ventanillas&' . $numven . '.jsp"><i class="fa fa-list"></i> <span>Ventanillas</span></a></li>';
              } else {
              }
              ?>


              <?php
              $ubicapermiso = existenciaubicacion($_SESSION['snr']);
              $nump82 = privilegios(82, $_SESSION['snr']);

              if (1 == $_SESSION['rol'] or 0 < $ubicapermiso or 0 < $nump82) { ?>
                <li><a href="puntos_ubicacion.jsp"><i class="fa fa-list"></i> <span>Ubicaciones SNR</span></a></li>
              <?php  } else {
              } ?>


              <?php
              $nump77 = privilegios(77, $_SESSION['snr']);

              if (1 == $_SESSION['rol'] or 3 > $_SESSION['snr_tipo_oficina']) { ?>
                <li><a href="sistema_gestion_calidad.jsp"><i class="fa fa-list"></i> <span>Sistema de gestión</span></a></li>
                <li><a href="tipologias_gestion.jsp"><i class="fa fa-list"></i> <span>Tipologias Sistema de gestión</span></a></li>



              <?php  } else {
              } ?>








              <?php

              $nump73 = privilegios(73, $_SESSION['snr']);
              $nump76 = privilegios(76, $_SESSION['snr']);
              $nump77 = privilegios(77, $_SESSION['snr']);
              $nump78 = privilegios(78, $_SESSION['snr']);
              $nump79 = privilegios(79, $_SESSION['snr']);

              if (1 == $_SESSION['rol'] or 0 < $nump73 or 0 < $nump76 or 0 < $nump77 or 0 < $nump78 or 0 < $nump79) { ?>
                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Portal / Intranet</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">


                    <?php
                    if (1 == $_SESSION['rol'] or 0 < $nump78) { ?>
                      <li><a href="portal.jsp"><i class="fa fa-list"></i> <span>Acceso a Portal</span></a></li>
                    <?php  } else {
                    } ?>



                    <li><a href="archivos_portal.jsp"><i class="fa fa-list"></i> <span>Archivos de Portal</span></a></li>





                    <?php
                    $nump118 = privilegios(118, $_SESSION['snr']);
                    if (1 == $_SESSION['rol'] or 0 < $nump79 or 0 < $nump118) { ?>
                      <li><a href="intranet.jsp"><i class="fa fa-list"></i> <span>Acceso a Intranet</span></a></li>
                      <li><a href="archivos_intranet.jsp"><i class="fa fa-list"></i> <span>Archivos de Intranet</span></a></li>
                    <?php  } else {
                    } ?>





                  </ul>
                </li>
              <?php } else {
              } ?>




              <?php if (3 > $_SESSION['snr_tipo_oficina']) { ?>
                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Publicaciones</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">


                    <li><a href="resoluciones_publicas.jsp">Resoluciones públicas</a></li>
                    <li><a href="estados_financieros.jsp">Estados financieros</a></li>

                    <li><a href="informes_ci.jsp">Informes Control Interno</a></li>
                  </ul>
                </li>


              <?php } else {
              } ?>





              <?php if (3 > $_SESSION['snr_tipo_oficina']) { ?>
                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Normatividad</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="archivos_historicos.jsp">Históricos</a></li>
                    <li><a href="circulares.jsp">Circulares</a></li>
                    <li><a href="autos.jsp">Autos</a></li>

                    <li><a href="memorandos.jsp">Memorandos</a></li>
                    <li><a href="instrucciones_administrativas.jsp">Instrucciones admin.</a></li>
                    <li><a href="conceptos_portal.jsp">Conceptos</a></li>







                  </ul>
                </li>


              <?php } else {
              } ?>





              <?php
              $nump66 = privilegios(66, $_SESSION['snr']);
              $nump68 = privilegios(68, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 0 < $nump66 or 0 < $nump68) { ?>
                <li><a href="cuotas_partes.jsp"><i class="fa fa-delicious"></i> <span>Cuotas Partes</span></a></li>
              <?php } else {
              } ?>









              <?php
              $nump25 = privilegios(25, $_SESSION['snr']);
              $nump26 = privilegios(26, $_SESSION['snr']);
              $nump27 = privilegios(27, $_SESSION['snr']);
              $nump28 = privilegios(28, $_SESSION['snr']);
              $nump29 = privilegios(29, $_SESSION['snr']);
              $nump30 = privilegios(30, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 40 == $_SESSION['snr_grupo_area'] or 0 < $nump25 or 0 < $nump26 or 0 < $nump27 or 0 < $nump28  or 0 < $nump29 or 0 < $nump30) { ?>

                <li><a href="cuentas_cobro.jsp"><i class="fa  fa-cubes"></i> <span>Cuentas de cobro</span></a></li>
              <?php } else {
              } ?>




              <?php
              $nump38 = privilegios(38, $_SESSION['snr']);
              $nump39 = privilegios(39, $_SESSION['snr']);
              $nump40 = privilegios(40, $_SESSION['snr']);
              $nump41 = privilegios(41, $_SESSION['snr']);
              $nump42 = privilegios(42, $_SESSION['snr']);
              $nump43 = privilegios(43, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 40 == $_SESSION['snr_grupo_area'] or 0 < $nump38 or 0 < $nump39 or 0 < $nump40 or 0 < $nump41  or 0 < $nump42 or 0 < $nump43) { ?>

                <li><a href="cuenta_factura.jsp"><i class="fa  fa-cubes"></i> <span>Facturas</span></a></li>
              <?php } else {
              } ?>


              <?php
              $nump44 = privilegios(44, $_SESSION['snr']);
              $nump45 = privilegios(45, $_SESSION['snr']);
              $nump46 = privilegios(46, $_SESSION['snr']);
              $nump47 = privilegios(47, $_SESSION['snr']);
              $nump48 = privilegios(48, $_SESSION['snr']);
              $nump49 = privilegios(49, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 40 == $_SESSION['snr_grupo_area'] or 0 < $nump44 or 0 < $nump45 or 0 < $nump46 or 0 < $nump47  or 0 < $nump48 or 0 < $nump49) { ?>
                <li><a href="cuenta_servicio.jsp"><i class="fa  fa-cubes"></i> <span>Gastos - Servicios</span></a></li>
              <?php } else {
              } ?>


              <?php
              $nump100 = privilegios(100, $_SESSION['snr']);
              $nump101 = privilegios(101, $_SESSION['snr']);

              if (0 < $nump101 or 0 < $nump100 or 1 == $_SESSION['rol'] or (1 == $_SESSION['snr_grupo_cargo'] and 1 == $_SESSION['snr_tipo_oficina'])) { ?>
                <li><a href="comision.jsp"><i class="fa  fa-cubes"></i> <span>Comisiones</span></a></li>

              <?php } else {
              } ?>



              <li><a href="licencias.jsp"><i class="fa fa-file-text-o"></i> <span>Licenciamiento urbanístico</span></a></li>


              <?php
              $nump10 = privilegios(10, $_SESSION['snr']);

              if (1 == $_SESSION['rol'] or 0 < $nump10) { ?>

                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Auditoria</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="auditoria.jsp"><i class="fa  fa-cubes"></i> <span>Auditoria 2024</span></a></li>
                    <li><a href="auditoria2023.jsp"><i class="fa  fa-cubes"></i> <span>Auditoria 2023</span></a></li>
                    <li><a href="auditoria2022.jsp"><i class="fa  fa-cubes"></i> <span>Auditoria 2022</span></a></li>
                    <li><a href="auditoria2022.jsp"><i class="fa  fa-cubes"></i> <span>Auditoria 2021</span></a></li>
                    <li><a href="auditoria2022.jsp"><i class="fa  fa-cubes"></i> <span>Auditoria 2020</span></a></li>
                    <li><a href="auditoria2022.jsp"><i class="fa  fa-cubes"></i> <span>Auditoria 2019</span></a></li>
                    <li><a href="auditoria2022.jsp"><i class="fa  fa-cubes"></i> <span>Auditoria 2018</span></a></li>
                  </ul>
                </li>


              <?php } else {
              } ?>





              <?php

              if (1 == $_SESSION['rol']) { ?>
                <li><a href="contenidos.jsp"><i class="fa fa-list"></i> <span>Contenidos OTI</span></a></li>
              <?php } else {
              } ?>



              <?php if (1 == $_SESSION['rol'] or 3184 == $_SESSION['snr']) { ?>
                <li><a href="tablas.jsp"><i class="fa  fa-server"></i> <span>Tablas DB</span></a></li>
              <?php } else {
              } ?>


              <?php
              $nump143 = privilegios(143, $_SESSION['snr']);

              if (1 == $_SESSION['rol'] or 0 < $nump143) {
              ?>


                <li><a href="pantalla_perfil.jsp"><i class="fa fa-user"></i> Privilegios</a></li>


              <?php
              } else {
              } ?>


              <?php
              $nump176 = privilegios(176, $_SESSION['snr']);
              if (1 == $_SESSION['rol'] or 0 < $nump176) {
              ?>
                <li><a href="https://cdn.supernotariado.gov.co" target="_blank"><i class="fa fa-file"></i> CDN</a></li>


              <?php
              } else {
              }

              if (1 == $_SESSION['rol']) {
              ?>
                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Configuración</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">


                    <li><a href="https://sisg.supernotariado.gov.co/usuarios_vur.jsp">Usuarios VUR</a></li>
                    <li><a href="https://sisg.supernotariado.gov.co/usuarios_iris.jsp">Usuarios Iris</a></li>
                    <li><a href="https://sisg.supernotariado.gov.co/consulados.jsp">Consulados</a></li>
                    <li><a href="https://sisg.supernotariado.gov.co/consules.jsp">Consules</a></li>

                    <li><a href="https://sisg.supernotariado.gov.co/comision_control_dia.jsp">Control comisiones</a></li>

                    <!--<li><a href="incidencias.jsp">Incidencias</a></li>-->
                    <li><a href="mantenimiento_preventivo.jsp">Mantenimiento P</a></li>
                    <li><a href="https://datastudio.google.com/reporting/175uuJZPOEcawsqAmNlXL9Gvcv9G8YF-l/page/cZtg" target="black">Analisis T.</a></li>

                  </ul>
                </li>


                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Consultas Web</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">



                    <li><a href="indice_propietario.jsp">Indice de propietarios</a></li>
                    <li><a href="estado_juridico.jsp">Estado juridico</a></li>
                    <li><a href="consulta_simple.jsp">Consulta Simple PDF</a></li>
                    <li><a href="consulta_exento.jsp">Consulta exento PDF</a></li>
                    <li><a href="consulta_matricula.jsp">Consulta matricula</a></li>
                    <li><a href="nodo_tierras.jsp">Nodo de tierras</a></li>
                    <li><a href="almacen.jsp">Almacen por Cédula</a></li>
                    <li><a href="almacen_placa.jsp">Almacen por placa</a></li>

                    <li><a href="sigep.jsp">SIGEP - DAFP</a></li>
                    <li><a href="secop2.jsp">SECOP II</a></li>
                    <li><a href="certificacion_procuraduria.jsp">Procuraduria</a></li>
                    <li><a href="rues.jsp">RUES, Nit</a></li>


                  </ul>
                </li>




              <?php } else {
              } ?>

            </ul>
            <!-- /.sidebar-menu -->
          </section>
          <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">



            <div class="row" style="background:#222D32;margin-top:-15px;padding-top:4px;">
              <div class="col-md-6">


                <a href="./" style="color:#fff;"> SISTEMA INTEGRADO DE SERVICIOS Y GESTIÓN</a>





                <?php


                $realdatecompleto = date('Y-m-d H:i:s');
                $fecha_actual = strtotime($realdatecompleto);
                $fecha_limite = strtotime("2023-05-27 17:00:00");
                //$fecha_actual<=$fecha_limite
                if (1 == 2) { //$_SESSION['snr_tipo_oficina'] 
                ?>
                  <div class="salert"></div>
                  <marquee style="color:#fff;background:#000;font-size:20px;"> - A partir de las 12:00 m.m. (MEDIO DIA) del día 05 de enero del 2024 hasta el 08 de enero, el sistema no estará en funcionamiento. - </marquee>
                <?php  } else {
                } ?>

              </div>


              <a>
                <div class="col-lg-1 col-xs-2 iconos text-center">
                  <span style="width:40px;"></span>
                  <br />
                </div>
              </a>

              <a href="pqrs_central.jsp">
                <div class="col-lg-1 col-xs-2 iconos text-center">
                  <img src="images/icons/bar-graph.svg" style="width:40px;">
                  <br />
                  NivelCentral
                </div>
              </a>
              <a href="mapa_orips.jsp">
                <div class="col-lg-1 col-xs-2 iconos text-center">
                  <img src="images/icons/bar-graph90.svg" style="width:40px;">
                  <br />
                  ORIP
                </div>
              </a>
              <a href="mapa_notarias.jsp">
                <div class="col-lg-1 col-xs-2 iconos text-center">
                  <img src="images/icons/list.svg" style="width:54px;">
                  <br />
                  Notariado
                </div>
              </a>
              <a href="analisis.jsp">
                <div class="col-lg-1 col-xs-2 iconos text-center">
                  <img src="images/icons/pie-chart.svg" style="width:40px;">
                  <br />
                  Curadurias
                </div>
              </a>
              <a href="pqrs_control.jsp">
                <div class="col-lg-1 col-xs-2 iconos text-center">
                  <img src="images/icons/line-graph.svg" style="width:40px;">
                  <br />
                  PQRS
                </div>
              </a>
              <!--  <a  href="mapa_orips.jsp"><div class="col-lg-1 col-xs-2 iconos text-center">
       <img src="images/icons/house.svg" style="width:45px;">
        <br />
        ORIP
        </div></a>-->


            </div>



          </section>

          <section class="content container-fluid">

            <div id="portada">

              <form method="POST" action="" name="formulario_borrar">
                <input type="hidden" name="borrarregistro" id="borrarregistro" value="">
                <input type="hidden" name="borrardetabla" id="borrardetabla" value="">
              </form>


              <?php

              if (isset($_POST['borrarregistro']) and "" != $_POST['borrarregistro'] and isset($_POST['borrardetabla']) and "" != $_POST['borrardetabla']) {
                echo borrarregistro($_POST["borrardetabla"], $_POST["borrarregistro"]);
              } else {
              }




              $actualizar63 = mysql_query("SELECT valor FROM configuracion WHERE id_configuracion=12 limit 1", $conexion) or die(mysql_error());
              $row163 = mysql_fetch_assoc($actualizar63);
              $valor3 = $row163['valor'];

              if (0 == $valor3) { ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h4>El sistema se encuentra en mantenimiento. Lamentamos el inconveniente.</h4>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else {

                error_reporting(0);
                if (isset($_GET['q']) and "" != $_GET['q']) {
                  $option = $_GET['q'];
                  $q = $_GET['q'];
                  require_once('pages/' . $option . '.php');
                } else {
                  require_once('pages/portada.php');
                }
              }

              mysql_free_result($actualizar63);
              ?>



            </div>
            <!-- /.row -->




          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
          <a href="http://www.supernotariado.gov.co" target="_blank">
            SUPERINTENDENCIA DE NOTARIADO Y REGISTRO
          </a> /
          Nit 899.999.007-0 / Calle 26 No. 13-49 Interior 201.

          <?php //echo $arrayca['SM_USER'].' - '.$arrayca['SM_NTLMCTX']; 
          ?>

          <!-- https://bit.ly/giovanniortegon  -->
          <div class="pull-right hidden-xs">
            <a href="http://tinyurl.com/giovanniortegon" target="_blank">Autor: PhD./Ing. Giovanni Ortegón</a>
          </div>


        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Create the tabs -->
          <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab" title="Manuales"><i class="fa fa-book"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab" title="Soporte"><i class="fa fa-comments-o"></i></a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Home tab content -->

            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Mi perfil</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">

              <h3 class="control-sidebar-heading">Soporte: +57 (1) 3282121</h3>

              <div class="form-group">

                <ul class="control-sidebar-menu">
                  <li>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Oficina de Tecnologias de la Información</h4>
                      <p>ana.diaz@supernotariado.gov.co<br>Ext: 1240</p>
                    </div>
                  </li>

                  <li>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">
                        <a href="https://sisg.supernotariado.gov.co/images/RES_10164.pdf" style="color:#fff;" target="_blank">
                          Grupo para el control y vigilancia de Curadores Urbanos</a>
                      </h4>
                      <p>miriam.oviedo@supernotariado.gov.co<br>Ext: 3217</p>
                    </div>
                  </li>


                  <li>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Notariado</h4>
                      <p>miguel.gonzalez@supernotariado.gov.co<br>Ext: 1152 - 1053</p>
                    </div>

                  </li>


                  <hr>
                  <h3 class="control-sidebar-heading"> &nbsp; Formatos</h3>
                  <li>
                    <a href="images/PR10_FR01_Solicitud_del_Cambi- RFC_V1_03-08-2018.doc" target="_blank">
                      <i class="menu-icon fa fa-book bg-red"></i>
                      <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Formato de solicitud de cambio</h4>
                        <p>En formato Word</p>
                      </div>
                    </a>
                  </li>


                  <li>
                    <a href="documentos/Formato_Administracion_Usuarios.xlsx" target="_blank">
                      <i class="menu-icon fa fa-book bg-red"></i>
                      <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Formato de gestión de usuarios</h4>
                        <p>En formato Excel</p>
                      </div>
                    </a>
                  </li>




                </ul>





              </div>


            </div>

            <div class="tab-pane active" id="control-sidebar-home-tab">
              <h3 class="control-sidebar-heading">Manuales</h3>
              <ul class="control-sidebar-menu">






                <?php
                $querymm = sprintf("SELECT * FROM manual where estado_manual=1 order by id_manual");
                $selectmm = mysql_query($querymm, $conexion) or die(mysql_error());
                $rowmm = mysql_fetch_assoc($selectmm);
                $totalRowsmm = mysql_num_rows($selectmm);
                if (0 < $totalRowsmm) {
                  do {

                ?>
                    <li>
                      <a href="<?php echo $rowmm['url_manual']; ?>" target="_blank">
                        <i class="menu-icon fa fa-book bg-red"></i>
                        <div class="menu-info">
                          <h4 class="control-sidebar-subheading"><?php echo $rowmm['nombre_manual']; ?></h4>
                          <p>En formato <?php echo $rowmm['formato']; ?></p>
                        </div>
                      </a>
                    </li>
                <?php
                  } while ($rowmm = mysql_fetch_assoc($selectmm));
                } else {
                }
                mysql_free_result($selectmm);
                ?>










              </ul>

              <!-- /.control-sidebar-menu 

                  <h3 class="control-sidebar-heading">Compromisos</h3>
                  <ul class="control-sidebar-menu">
                    <li>
                      <a href="javascript:;">
                        <h4 class="control-sidebar-subheading">
                          Custom Template Design
                          <span class="pull-right-container">
                            <span class="label label-danger pull-right">70%</span>
                          </span>
                        </h4>

                        <div class="progress progress-xxs">
                          <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                      </a>
                    </li>
                  </ul>
                  <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
          </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
          immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
      </div>

      <!-- ./wrapper -->


      <!-- REQUIRED JS SCRIPTS -->
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="dist/js/adminlte.min.js"></script>
      <script src="dist/js/jput-2.js"></script>


      <script type="text/javascript" src="dist/js/pages/expensa.js"></script>

      <script src='dist/js/jquerynumber.js'></script>
      <!-- Slimscroll -->
      <!--<script src="plugins/slimscroll/jquery.slimscroll.min.js"></script>-->
      <!-- FastClick -->
      <script src="plugins/fastclick/fastclick.js"></script>
      <!-- icheck -->
      <script src="plugins/iCheck/icheck.min.js"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <!-- Page Script -->
      <script>
        $(function() {
          //Add text editor
          $("#compose-textarea").wysihtml5();
        });
      </script>








      <?php if (isset($_GET['q'])) { ?>
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

        <script src="jstable/<?php echo $_GET['q']; ?><?php if (isset($_GET['i'])) {
                                                        $id = $_GET['i'];
                                                        echo '&' . $id;
                                                      } else {
                                                      } ?>.js"></script>
        <script>
          $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
          });
        </script>
      <?php } else { ?>
        <!--
	    <link href='plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
        <link href='plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
        <script src='plugins/fullcalendar/lib/moment.min.js'></script>
        <script src='plugins/fullcalendar/lib/jquery.min.js'></script> 
        <script src='plugins/fullcalendar/fullcalendar.min.js'></script>
        <Script src='plugins/fullcalendar/lang/es.js'></script>
	-->
      <?php } ?>

      <?php if (3 > $_SESSION['snr_tipo_oficina']) { ?>
        <div class="venactiva" style="display:none">
          <br>


          <div style="text-align:right;">
            <a style="cursor:pointer;" class="pactivac">Cerrar X </a> &nbsp; &nbsp;
          </div>
          <br>
          <center>
            <div id="idpactiva"></div>
            <?php
            echo '<img src="files/' . $_SESSION['foto_funcionario'] . '" style="width:120px;"><br>';
            echo '<span style="color:#333;">' . $_SESSION['snr_nombre'] . '</span>';
            ?>
            <br><br>
            <!--<iframe src="https://supernotariadoyregistro-my.sharepoint.com/personal/seguridadsaludytrabajo_supernotariado_gov_co/_layouts/15/embed.aspx?UniqueId=dd9a9f11-a824-4d57-919b-0a3f48b43414&embed=%7B%22ust%22%3Atrue%2C%22hv%22%3A%22CopyEmbedCode%22%7D&referrer=StreamWebApp&referrerScenario=EmbedDialog.Create" width="640" height="360" frameborder="0" scrolling="no" allowfullscreen title="Pausas activas.mp4"></iframe>

<iframe src="https://supernotariadoyregistro-my.sharepoint.com/personal/seguridadsaludytrabajo_supernotariado_gov_co/_layouts/15/embed.aspx?UniqueId=dea3106f-058a-4b84-89bb-d9930e23faaa&embed=%7B%22ust%22%3Atrue%2C%22hv%22%3A%22CopyEmbedCode%22%7D&referrer=StreamWebApp&referrerScenario=EmbedDialog.Create" width="640" height="360" frameborder="0" scrolling="no" allowfullscreen title="PAUSAS ACTIVAS - EJERCICIOS POSTURALES.mp4"></iframe>

<iframe src="https://supernotariadoyregistro-my.sharepoint.com/:v:/g/personal/seguridadsaludytrabajo_supernotariado_gov_co/EW8Qo96KBYRLibvZkw4j-qoBKhKG6XXNkRu2Nq5LTB-lnA?nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZyIsInJlZmVycmFsQXBwUGxhdGZvcm0iOiJXZWIiLCJyZWZlcnJhbE1vZGUiOiJ2aWV3In19&e=vjbTgB" width="640" height="360" frameborder="0" scrolling="no" allowfullscreen title="PAUSAS ACTIVAS - EJERCICIOS POSTURALES.mp4"></iframe>

<iframe src="https://supernotariadoyregistro-my.sharepoint.com/personal/seguridadsaludytrabajo_supernotariado_gov_co/_layouts/15/embed.aspx?UniqueId=dea3106f-058a-4b84-89bb-d9930e23faaa&embed=%7B%22ust%22%3Atrue%2C%22hv%22%3A%22CopyEmbedCode%22%7D&referrer=StreamWebApp&referrerScenario=EmbedDialog.Create" width="640" height="360" frameborder="0" scrolling="no" allowfullscreen title="PAUSAS ACTIVAS - EJERCICIOS POSTURALES.mp4"></iframe>




<iframe src="https://supernotariadoyregistro-my.sharepoint.com/personal/seguridadsaludytrabajo_supernotariado_gov_co/_layouts/15/stream.aspx?id=%2Fpersonal%2Fseguridadsaludytrabajo%5Fsupernotariado%5Fgov%5Fco%2FDocuments%2FVideoPausasActivas%2FPAUSAS%20ACTIVAS%20%2D%20EJERCICIOS%20POSTURALES%2Emp4&ga=1&referrer=StreamWebApp%2EWeb&referrerScenario=AddressBarCopied%2Eview" width="640" height="360" frameborder="0" scrolling="no" allowfullscreen title="PAUSAS ACTIVAS - EJERCICIOS POSTURALES.mp4"></iframe>
-->
            <iframe src="./videos/" width="642" height="482" frameborder="0" scrolling="no" allowfullscreen title="PAUSAS ACTIVAS - EJERCICIOS POSTURALES"></iframe>




            <br>
            <br>
            <a style="cursor:pointer;" class="pactivac">Cerrar X </a>
          </center>
        </div>
        <div class="insertadop">
        </div>

      <?php } else {
      } ?>



      <script src="plugins/select2/select2.full.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


      <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


-->




      <?php
      $editortexto = $_SERVER['REQUEST_URI'];
      $infoed = explode('&', $editortexto);
      $infoeditor = $infoed[0];


      if ('/solicitud_pqrs' == $infoeditor or '/detalle_visita' == $infoeditor) {
      ?>


        <script src="plugins/ckeditor40/ckeditor.js"></script>

        <script>
          $(function() {
            CKEDITOR.replace('texto_modelo_respuesta_pqrs');
          })
        </script>


        <script>
          $(function() {
            CKEDITOR.replace('texto_acto_admin_x_licencia');
          })
        </script>


        <script>
          $(function() {
            CKEDITOR.replace('asunto_control');
          })
        </script>

        <script>
          $(function() {
            CKEDITOR.replace('nombre_requerir_pqrs');
          })
        </script>
        <script>
          $(function() {
            CKEDITOR.replace('respuesta_pre_ciudadano');
          })
        </script>


        <script>
          $(function() {
            CKEDITOR.replace('texto_modelo_respuesta_pqrs2');
          })
        </script>

        <script>
          $(function() {
            CKEDITOR.replace('texto_requerir');
          })
        </script>

        <script>
          $(function() {
            CKEDITOR.replace('texto_trasladar');
          })
        </script>


        <script>
          $(function() {
            CKEDITOR.replace('texto_info_ciudadano');
          })
        </script>

        <script>
          $(function() {
            CKEDITOR.replace('texto_para_conocimiento');
          })
        </script>


        <script>
          $(function() {
            CKEDITOR.replace('texto_trasladar_ciudadano');
          })
        </script>


        <script>
          $(function() {
            CKEDITOR.replace('texto_control_ciudadano');
          })
        </script>

        <script>
          $(function() {
            CKEDITOR.replace('texto_ampliacion_terminos');
          })
        </script>

        <script>
          $(function() {
            CKEDITOR.replace('texto_pqrs3');
          })
        </script>
      <?php  } else {
      }
      ?>

      <script>
        function fileValidationGlobal(nombreIdValidation, limite) {
          var fileInput = document.getElementById(nombreIdValidation);
          var selectedFile = fileInput.files[0];
          var fileSize = selectedFile.size;
          var maxSize = limite * 1024 * 1024; // 1 a 20 MB in bytes

          if (fileSize >= maxSize) {
            type = "text/javascript" > swal(" ERROR !", " El tamaño del archivo supera el límite máximo de " + (maxSize / 1024 / 1024) + " MB !", "error");
          }
        }
      </script>

      <script>
        $(function() {
          $('.updateggg').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/expensafactura.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divupdate').html(b);
              }
            })
          });

        })
      </script>

      <script>
        $(function() {
          $('.anularggg').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/expensaanular.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divanular').html(b);
              }
            })
          });

        })
      </script>


      <script>
        $(function() {
          $('.invegar').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/inventario_obj_detalle.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divinvegar').html(b);
              }
            })
          });

        })
      </script>

      <script>
        $(function() {
          $('.tramitarinvegar').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/inventario_tramitarinvegar.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divtramitarinvegar').html(b);
              }
            })
          });

        })
      </script>

      <script>
        $(function() {
          $('.actesc').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/not_actesc.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divactesc').html(b);
              }
            })
          });

        })
      </script>



      <?php if ("radicado_anterior" == $_GET["q"]) {
        echo '<script src="plugins/jquery.base64.min.js"></script>';
      } else {
      } ?>




      <script>
        $(document).ready(function() {





          $('.js-example-basic-multiple').select2({
            theme: "classic"
          });

          //$('.select2').select2()



          $('#vigenciab').mouseover(function() {
            var parj = document.getElementById("vigencia").value;
            var parju = document.getElementById("hastafecha").value;
            $('#vigencia_total').val(parj);
            $('#fecha_terminacion').val(parju);

            $('#vigencia1').html(parj);
            $('#hastafecha1').html(parju);

          });





          $('#gimnasiobeneficiario').change(function() {
            var yo = document.getElementById("gimnasiobeneficiario").value;
            if ('Ninguno, Yo' == yo) {
              document.getElementById("personag").value = document.getElementById("namef").value;
              document.getElementById("cedulag").value = document.getElementById("cedulaf").value;

            } else {
              document.getElementById("personag").value = "";
              document.getElementById("cedulag").value = "";

            }
          });




          $('#mmodalidad').on('click', function() {

            var idm = document.getElementById("id_modalidad_licencia").value;
            if (10 == idm) {
              return confirm('La modalidad de modificación solo aplica a licencias de construcción, no a modificaciones de licencias vigentes. ¿Quiere continuar?');
            } else {}
          });


          $('#retornos').click(function() {
            var par = 'Retornada a OAC';
            $('.input-sm').val(par);

          });






          $('.revisar_visita').click(function() {
            var pardire = this.id;
            $('#id_visita').val(pardire);
          });




          $('#tipo_soporte_personal').change(function() {
            // var pardiruu =this.val;	

            var pardiruu = document.getElementById("tipo_soporte_personal").value;


            if ('3-2' == pardiruu) {
              $('#certificacionlaboral').attr('style', 'display:none;');
              $('#personal_desde').attr('style', 'display:none;');
              $('#personal_desde').removeAttr('required');
              $('#personal_hasta').attr('style', 'display:none;');
              $('#personal_hasta').removeAttr('required');
              $('#certificacionlaboral').attr('style', 'display:none;');

            } else if ('13-23' == pardiruu) {
              $('#personal_desde').attr('style', 'display:none;');
              $('#personal_desde').attr('required', 'required');
              $('#personal_hasta').removeAttr('style');
              $('#personal_hasta').attr('required', 'required');

              $('#personal_hasta').attr('placeholder', 'Fecha de grado');

              $('#certificacionlaboral').attr('style', 'display:none;');


              $('.niv_academico').removeAttr('style');


            } else if ('13-10' == pardiruu) {
              $('#personal_desde').removeAttr('style');
              $('#personal_desde').attr('required');
              $('#personal_hasta').removeAttr('style');
              $('#personal_hasta').attr('required');
              $('#certificacionlaboral').removeAttr('style');

            } else if ('13-25' == pardiruu) {
              $('#personal_desde').removeAttr('style');
              $('#personal_desde').attr('required', 'required');
              $('#personal_hasta').removeAttr('required');
              $('#personal_hasta').attr('style', 'display:none;');
              $('#certificacionlaboral').removeAttr('style');


            } else if ('13-24' == pardiruu) {
              $('#personal_desde').removeAttr('required');
              $('#personal_desde').attr('style', 'display:none;');
              $('#personal_hasta').removeAttr('required');
              $('#personal_hasta').attr('style', 'display:none;');
              $('#certificacionlaboral').attr('style', 'display:none;');


            } else if ('3-11' == pardiruu) {
              $('#personal_desde').attr('style', 'display:none;');
              $('#personal_desde').attr('required', 'required');
              $('#personal_hasta').removeAttr('required');
              $('#personal_hasta').attr('style', 'display:none;');
              $('#certificacionlaboral').attr('style', 'display:none;');




            } else {
              $('#personal_desde').attr('style', 'display:none;');
              $('#personal_desde').removeAttr('required');
              $('#personal_hasta').attr('style', 'display:none;');
              $('#personal_hasta').removeAttr('required');
              $('#certificacionlaboral').attr('style', 'display:none;');
            }
          });





          $('#tipo_visita').change(function() {
            var vis = document.getElementById("tipo_visita").value;

            if ('Especial' == vis) {
              $('#ver_visita_especial').removeAttr('style');
              $('#visita_especial').attr('required', 'required');


            } else if ('General' == vis) {
              $('#ver_visita_especial').attr('style', 'display:none;');
              $('#visita_especial').removeAttr('required');

            } else {

              $('#ver_visita_especial').attr('style', 'display:none;');
              $('#visita_especial').removeAttr('required');

            }
          });







          $('#tipo_visitam').change(function() {
            var vism = document.getElementById("tipo_visitam").value;

            if ('Especial' == vism) {
              $('#ver_visita_especialm').removeAttr('style');
              $('#visita_especialm').attr('required', 'required');


            } else if ('General' == vism) {
              $('#ver_visita_especialm').attr('style', 'display:none;');
              $('#visita_especialm').removeAttr('required');

            } else {

              $('#ver_visita_especialm').attr('style', 'display:none;');
              $('#visita_especialm').removeAttr('required');

            }
          });








          $('#labora_actualmente').change(function() {
            var viso = document.getElementById("labora_actualmente").value;

            if ('No' == viso) {
              $('#personal_hasta').removeAttr('style');



            } else if ('Si' == viso) {
              $('#personal_hasta').attr('style', 'display:none;');


            } else {

              $('#personal_hasta').removeAttr('style');

            }
          });







          $('.enviodirectivo').click(function() {
            var pardir = this.id;
            var pardirt = this.title;
            $('#nombre_dir').val(pardir);
            $('#para').val(pardir);
            $('#parados').val(pardir);
            $('#paraint').val(pardirt);
            if ('1642' == pardirt) {
              $('#para').removeAttr('readonly');
            } else {
              $('#para').attr('readonly', 'readonly');
            }
          });



          $('.editar_devolucion').click(function() {
            var percor = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_edita_devolucion.php",
              data: 'option=' + percor,
              async: true,
              success: function(b) {
                jQuery('#ver_popupeditardevolucion').html(b);
              }
            })
          });






          $('#id_departamento_req').change(function() {
            var maff = document.getElementById("id_departamento_req").value;
            $('#ver_ofi').val('');
            $('#ver_ofi').attr('disabled', 'disabled');


            jQuery.ajax({
              type: "POST",
              url: "pages/municipios.php",
              data: 'option=' + maff,
              async: true,
              success: function(b) {
                jQuery('#id_municipio_req').html(b);
              }
            })
          });



          $('#id_departamento_req2').change(function() {
            var maff = document.getElementById("id_departamento_req2").value;
            $('#ver_ofi2').val('');
            $('#ver_ofi2').attr('disabled', 'disabled');


            jQuery.ajax({
              type: "POST",
              url: "pages/municipios.php",
              data: 'option=' + maff,
              async: true,
              success: function(b) {
                jQuery('#id_municipio_req2').html(b);
              }
            })
          });







          $('.ver_listaelegible').click(function() {
            var masl = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_lista_elegibles.php",
              data: 'option=' + masl,
              async: true,
              success: function(b) {
                jQuery('#ver_lista_elegibles').html(b);
              }
            })
          });










          $('#consulta_dependencia').click(function() {
            var mas = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_dependencia.php",
              data: 'option=' + mas,
              async: true,
              success: function(b) {
                jQuery('#id_dependencia').html(b);
              }
            })
            $('#enviodependencia').removeAttr('style');
            // $('.opcionesedl').attr( 'style','display:none' );
          });





          $('#consulta_funcion_cargo').click(function() {
            var maso = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_funcion_cargo.php",
              data: 'option=' + maso,
              async: true,
              success: function(b) {
                jQuery('#id_funcion_cargoc').html(b);
              }
            })
            $('#divfuncion_cargo').removeAttr('style');

          });




          $('.revisar_plan_visita').click(function() {
            var seccionffr = this.id;
            document.getElementById("id_plan_visita").value = seccionffr;
          });


          $('.botonseccion').click(function() {
            var seccionff = this.id;
            document.getElementById("seccion").value = seccionff;
          });



          $('#id_asunto_resolucion').change(function() {
            var maffrr = document.getElementById("id_asunto_resolucion").value;
            document.getElementById("nombre_resolucion").value = maffrr;
          });






          $('.buscar_ofi').change(function() {

            var tipof = document.getElementById("id_tipo_oficina_req").value;
            var depcr = document.getElementById("id_departamento_req").value;
            var muncr = document.getElementById("id_municipio_req").value;
            var totd = tipof + '|' + depcr + '|' + muncr;

            $('#ver_ofi').removeAttr('disabled', 'disabled');

            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_oficina.php",
              data: 'option=' + tipof + '|' + depcr + '|' + muncr,
              async: true,
              success: function(b) {
                jQuery('#ver_ofi').html(b);
              }


            })
          });




          $('#id_municipio_req2').change(function() {

            var tipof2 = document.getElementById("id_tipo_oficina_req2").value;
            var depcr2 = document.getElementById("id_departamento_req2").value;
            var muncr2 = document.getElementById("id_municipio_req2").value;
            var totd2 = tipof2 + '|' + depcr2 + '|' + muncr2;


            $('#ver_ofi2').removeAttr('disabled', 'disabled');

            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_oficina.php",
              data: 'option=' + tipof2 + '|' + depcr2 + '|' + muncr2,
              async: true,
              success: function(b) {
                jQuery('#ver_ofi2').html(b);
              }


            })
          });









          $('.classcomisionrechazo').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/comision_rechazo.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divrechazocomision').html(b);
              }
            })
          });

          $('.classcomisionticket').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/comision_ticket.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divViewTicket').html(b);
              }
            })
          });








          $('.ver_revisionedl').click(function() {
            var revedl = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_revisionedl.php",
              data: 'option=' + revedl,
              async: true,
              success: function(b) {
                jQuery('#respuestarevisionedl').html(b);
              }
            })
          });




          $('.ver_nomina').click(function() {
            var revnomina = this.id;
            document.getElementById("id_nomina").value = revnomina;
          });


          $('.ver_compro').click(function() {
            var revcompro = this.id;
            document.getElementById("id_concertacion").value = revcompro;
          });






          $('.ver_vlabor').click(function() {
            var revnn = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_vlabor.php",
              data: 'option=' + revnn,
              async: true,
              success: function(b) {
                jQuery('#respuestavlabor').html(b);
              }
            })
          });













          $('.ver_aceptar').click(function() {
            var revnne = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_aceptar_edl.php",
              data: 'option=' + revnne,
              async: true,
              success: function(b) {
                jQuery('#respuestaaceptar').html(b);
              }
            })
          });



          $('.ver_eva').click(function() {
            var revnne = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_nota_edl.php",
              data: 'option=' + revnne,
              async: true,
              success: function(b) {
                jQuery('#respuestaeval').html(b);
              }
            })
          });




          $('.ver_confirmar').click(function() {
            var revnnec = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_confirmar_edl.php",
              data: 'option=' + revnnec,
              async: true,
              success: function(b) {
                jQuery('#respuestaconfirmar').html(b);
              }
            })
          });



          $('.ver_confrontar').click(function() {
            var revnnect = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_edl.php",
              data: 'option=' + revnnect,
              async: true,
              success: function(b) {
                jQuery('#respuestaconfrontar').html(b);
              }
            })
          });




          $('.buscaractualizarradicacioncuraduria').click(function() {
            var radicadocuraduria = this.id;
            //var radicadocuradurianame = this.name;
            //alert(radicadocuraduria);
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_actualizarradicado.php",
              data: 'option=' + radicadocuraduria,
              async: true,
              success: function(b) {
                jQuery('#ver_actualizarradicacioncuraduria').html(b);
              }
            })
          });





          $('.buscarauditoriaradicacioncuraduria').click(function() {
            var radicadocuraduriar = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_auditoria_radicacion.php",
              data: 'option=' + radicadocuraduriar,
              async: true,
              success: function(b) {
                jQuery('#ver_auditoriar').html(b);
              }
            })
          });






          $('.buscar_macro').click(function() {
            var macro = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_macro.php",
              data: 'option=' + macro,
              async: true,
              success: function(b) {
                jQuery('.ver_macro').html(b);
              }
            })
          });





          $('.buscaractualizarfile').click(function() {
            var maf = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_radicado_file.php",
              data: 'option=' + maf,
              async: true,
              success: function(b) {
                jQuery('#ver_actualizarfile').html(b);
              }
            })
          });


          $('.buscarcorreccion').click(function() {
            var mafc = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_radicacion_correccion.php",
              data: 'option=' + mafc,
              async: true,
              success: function(b) {
                jQuery('#ver_actualizarcorreccion').html(b);
              }
            })
          });




          $('.buscargimnasio').click(function() {
            var mafcg = this.id;
            //alert(mafcg);
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_actualizar_gimnasio.php",
              data: 'option=' + mafcg,
              async: true,
              success: function(b) {
                jQuery('#ver_actualizargimnasio').html(b);
              }
            })
          });









          $('.buscardigitalizacion2018').click(function() {
            var mafcv = this.id;
            //alert(mafcv);
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_digitalizacion2018.php",
              data: 'option=' + mafcv,
              async: true,
              success: function(b) {
                jQuery('#ver_actualizardigitalizacion2018').html(b);
              }
            })
          });



          /////////////////////////


          $('.editar_periodo').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/cuotas_partes_editar_periodo.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#diveditarperiodo').html(b);
              }
            })
          });

          $('.editar_sustitucion').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/cuotas_partes_editar_sustitucion.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divEntidadSustitucion').html(b);
              }
            })
          });

          $('.editar_entidad').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/cuotas_partes_editar_entidad.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divEntidadEditar').html(b);
                // alert(b);
              }
            })
          });

          $('.editar_causante').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/cuotas_partes_editar_causante.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divEntidadCausante').html(b);
              }
            })
          });


          ///////////////////////////





          $('#modelo_respuesta_pqrs').change(function() {
            var max = document.getElementById("modelo_respuesta_pqrs").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/modelo_respuesta_pqrs.php",
              data: 'option=' + max,
              async: true,
              success: function(b) {
                jQuery('#texto_modelo_respuesta_pqrs').html(b);

              }
            })
          });




          $('#id_categoria_soporte').change(function() {
            var maxz = document.getElementById("id_categoria_soporte").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/tipo_soporte.php",
              data: 'option=' + maxz,
              async: true,
              success: function(b) {
                jQuery('#id_tipo_soporte').html(b);

              }
            })
          });



          $('#id_area').change(function() {
            var maxzm = document.getElementById("id_area").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/listado_grupo_area.php",
              data: 'option=' + maxzm,
              async: true,
              success: function(b) {
                jQuery('#id_grupo_area').html(b);

              }
            })
          });




          $('.actualizar_situacionc').click(function() {
            var percc = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/actualizar_situacionc.php",
              data: 'option=' + percc,
              async: true,
              success: function(b) {
                jQuery('#ver_situacionc').html(b);
              }
            })
          });



          $('.nreinicio').click(function() {
            var percca = this.id;
            document.getElementById("reinicio").value = percca;

          });


          $('.borraraceptacioncompromiso').click(function() {
            var perccate = this.id;
            document.getElementById("aprobar_compromiso").value = perccate;

          });




          $('#notaria_votacion').change(function() {
            var vot = this.value;
            //alert(vot);
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_votacion_notaria.php",
              data: 'option=' + vot,
              async: true,
              success: function(b) {
                jQuery('#suplente').html(b);
              }
            })
          });





          $('.buscar_rev_beneficio_nota').click(function() {
            var percbrvvxx = this.id;
            // alert(percbrvvxx);
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_revbeneficio.php",
              data: 'ben=' + percbrvvxx,
              async: true,
              success: function(b) {
                jQuery('.ver_revbeneficio_nota').html(b);
              }
            })
          });





          $('.buscar_detalle_movimiento').click(function() {
            var percbrvvxxm = this.id;
            //alert(percbrvvxxm);
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_movimiento.php",
              data: 'option=' + percbrvvxxm,
              async: true,
              success: function(b) {
                jQuery('#ver_detalle_movimiento').html(b);
              }
            })
          });





          $('.buscar_rev_asignacion').click(function() {
            var percbra = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_asignacion.php",
              data: 'option=' + percbra,
              async: true,
              success: function(b) {
                jQuery('.ver_asignacion').html(b);
              }
            })
          });


          $('.buscar_tramite').click(function() {
            var percbrat = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_tramite.php",
              data: 'option=' + percbrat,
              async: true,
              success: function(b) {
                jQuery('.ver_tramite').html(b);
              }
            })
          });




          $('.buscar_rev_observacion').click(function() {
            var percbrao = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_observacion.php",
              data: 'option=' + percbrao,
              async: true,
              success: function(b) {
                jQuery('.ver_observacion').html(b);
              }
            })
          });




          $('.buscar_beneficio').click(function() {
            var percb = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_beneficio.php",
              data: 'option=' + percb,
              async: true,
              success: function(b) {
                jQuery('.ver_beneficio').html(b);
              }
            })
          });



          $('.buscar_percepcion').click(function() {
            var perc = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_percepcion.php",
              data: 'option=' + perc,
              async: true,
              success: function(b) {
                jQuery('.ver_percepcion').html(b);
              }
            })
          });





          $('.buscar_resolucion').click(function() {
            var perco = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_resolucion.php",
              data: 'option=' + perco,
              async: true,
              success: function(b) {
                jQuery('.ver_resolucion').html(b);
              }
            })
          });






          $('.buscar_auto').click(function() {
            var percoa = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_auto.php",
              data: 'option=' + percoa,
              async: true,
              success: function(b) {
                jQuery('.ver_auto').html(b);
              }
            })
          });



          $('.devolucion_detalle').click(function() {
            var option = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/devolucion_dinero_detalle.php",
              data: 'option=' + option,
              async: true,
              success: function(b) {
                jQuery('.ver_devolucion_detalle').html(b);
              }
            })
          });




          $('#buscarcedula').click(function() {
            var agendai = document.getElementById("identificacion").value;
            var agendav = document.getElementById("id_venta").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_ciudadano.php",
              data: 'option=' + agendai + '---' + agendav,
              async: true,
              success: function(b) {
                jQuery('#agenda').html(b);
              }
            })

            $('#disponibilidad').removeAttr('style');

            //$('.codigo_oficina').attr('style','display:display');


          });







          $('.buscar_correspondencia').click(function() {
            var perconame = this.name;
            $('#radicor').html(perconame);

            var percor = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_correspondencia.php",
              data: 'option=' + percor,
              async: true,
              success: function(b) {
                jQuery('.ver_correspondencia').html(b);
              }
            })
          });






          $('.buscar_useriris').click(function() {
            alert('xxx');
            var perconamei = this.name;
            $('#useri').html(perconamei);

            var percori = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_useriris.php",
              data: 'option=' + percori,
              async: true,
              success: function(b) {
                jQuery('.ver_useriris').html(b);
              }
            })
          });







          $('.buscaragenda').click(function() {
            var asignavbnaa = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_agenda.php",
              data: 'option=' + asignavbnaa,
              async: true,
              success: function(b) {
                jQuery('.ver_agenda').html(b);
              }
            })
          });


          $('.buscaractualizaragenda').click(function() {
            var asignavbnaaz = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_actualizaragenda.php",
              data: 'option=' + asignavbnaaz,
              async: true,
              success: function(b) {
                jQuery('.ver_actualizaragenda').html(b);
              }
            })
          });



          $('.buscar_asigna').click(function() {
            var asigna = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_asigna.php",
              data: 'option=' + asigna,
              async: true,
              success: function(b) {
                jQuery('.ver_asigna').html(b);
              }
            })
          });



          $('.buscar_contenido').click(function() {
            var asignav = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_contenido_portal.php",
              data: 'option=' + asignav,
              async: true,
              success: function(b) {
                jQuery('.ver_contenido').html(b);
              }
            })
          });



          $('.buscar_banner').click(function() {
            var asignavb = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_banner.php",
              data: 'option=' + asignavb,
              async: true,
              success: function(b) {
                jQuery('.ver_banner').html(b);
              }
            })
          });





          $('.buscar_anexo').click(function() {
            var asignavbn = this.id;
            var asignavbname = this.name;
            $('#expedienteaviso').html(asignavbname);
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_notificacion_aviso.php",
              data: 'option=' + asignavbn,
              async: true,
              success: function(b) {
                jQuery('.ver_anexo').html(b);
              }
            })
          });






          $('.buscar_anexoevaluacion').click(function() {
            var asignavbncc = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_evaluacion.php",
              data: 'option=' + asignavbncc,
              async: true,
              success: function(b) {
                jQuery('.ver_evaluacion').html(b);
              }
            })
          });










          $('.buscararchivo').click(function() {
            var asignavbna = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_archivo.php",
              data: 'option=' + asignavbna,
              async: true,
              success: function(b) {
                jQuery('.ver_buscararchivo').html(b);
              }
            })
          });




          $('.buscar_apostilla').click(function() {
            var idapostilla = this.id;
            var apostilla = this.name;
            $('#idapostilla').html(apostilla);
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_apostilla.php",
              data: 'option=' + idapostilla,
              async: true,
              success: function(b) {
                jQuery('.ver_apostilla').html(b);
              }
            })
          });



          $('.buscar_soporte').click(function() {
            var idsoporte = this.id;
            var soporte = this.name;
            $('#idsoporte').html(soporte);
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_soporte.php",
              data: 'option=' + idsoporte,
              async: true,
              success: function(b) {
                jQuery('.ver_soporte').html(b);
              }
            })
          });




          $('.buscar_factura').click(function() {
            var fac = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_factura.php",
              data: 'option=' + fac,
              async: true,
              success: function(b) {
                jQuery('.ver_factura').html(b);
              }
            })
          });


          $('.buscar_encuesta_notaria').click(function() {
            var facn = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_encuesta_notaria.php",
              data: 'option=' + facn,
              async: true,
              success: function(b) {
                jQuery('.ver_encuesta_notaria').html(b);
              }
            })
          });


          $('.buscar_umarital_notaria').click(function() {
            var facnm = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_union_marital.php",
              data: 'option=' + facnm,
              async: true,
              success: function(b) {
                jQuery('.ver_umarital_notaria').html(b);
              }
            })
          });



          $('.buscar_servicio').click(function() {
            var facs = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_servicio.php",
              data: 'option=' + facs,
              async: true,
              success: function(b) {
                jQuery('.ver_servicio').html(b);
              }
            })
          });



          $('.buscar_chat').click(function() {
            var idchat = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_chat.php",
              data: 'option=' + idchat,
              async: true,
              success: function(b) {
                jQuery('.ver_conversacion_chat').html(b);
              }
            })
          });



          $('.devolucion_asigna').click(function() {
            var asigna = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/devolucion_dinero_asigna.php",
              data: 'option=' + asigna,
              async: true,
              success: function(b) {
                jQuery('.ver_devolucion_asigna').html(b);
              }
            })
          });




          $('.buscarpapel').click(function() {
            var idchatpp = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_papel.php",
              data: 'option=' + idchatpp,
              async: true,
              success: function(b) {
                jQuery('#veractualizarpapel').html(b);
              }
            })
          });





          $('#infodatanombre').click(function() {

            var ceduladata = document.getElementById("cedula_persona").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_persona.php",
              data: 'option=' + ceduladata,
              async: true,
              success: function(b) {
                jQuery('#datanombre').html(b);
              }
            })
          });



          $('#infodatanombreencargado').click(function() {

            var ceduladata = document.getElementById("cedula_persona").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_encargado.php",
              data: 'option=' + ceduladata,
              async: true,
              success: function(b) {
                jQuery('#datanombreencargado').html(b);
              }
            })
          });








          $('.buscar_cuentacobro').click(function() {
            var idchatwnc = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_cuenta_cobro.php",
              data: 'option=' + idchatwnc,
              async: true,
              success: function(b) {
                jQuery('#ver_cuentacobro').html(b);
              }
            })
          });


          $('.buscar_anexocuentacobro').click(function() {
            var idchatwncn = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_anexo_cuenta_cobro.php",
              data: 'option=' + idchatwncn,
              async: true,
              success: function(b) {
                jQuery('#ver_anexocuentacobro').html(b);
              }
            })
          });









          $('.buscar_actualizarvisita').click(function() {
            var idchatwncnt = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_actualizar_visita.php",
              data: 'option=' + idchatwncnt,
              async: true,
              success: function(b) {
                jQuery('#ver_actualizarvisita').html(b);
              }
            })
          });





          $('.buscar_actualizartipovisita').click(function() {
            var idchatwncntu = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_actualizar_tipo_visita.php",
              data: 'option=' + idchatwncntu,
              async: true,
              success: function(b) {
                jQuery('#ver_actualizartipovisita').html(b);
              }
            })
          });






          $('.buscar_soportevisita').click(function() {
            var idchatwncntr = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_agregar_soporte_visita.php",
              data: 'option=' + idchatwncntr,
              async: true,
              success: function(b) {
                jQuery('#ver_soportevisita').html(b);
              }
            })
          });








          $('.buscar_entidadreparto').click(function() {
            var idchatw = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_entidadreparto.php",
              data: 'option=' + idchatw,
              async: true,
              success: function(b) {
                jQuery('#ver_entidadreparto').html(b);
              }
            })
          });


          $('.buscar_circulonotarial').click(function() {
            var idchatwn = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_circulo_notarial.php",
              data: 'option=' + idchatwn,
              async: true,
              success: function(b) {
                jQuery('#ver_circulonotarial').html(b);
              }
            })
          });




          $('.cambiar_reparto').click(function() {
            var idchatwnrt = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_cambio_reparto.php",
              data: 'option=' + idchatwnrt,
              async: true,
              success: function(b) {
                jQuery('#ver_cambio_reparto').html(b);
              }
            })
          });










          $('.buscar_reparto').click(function() {
            var idchatwnr = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_reparto.php",
              data: 'option=' + idchatwnr,
              async: true,
              success: function(b) {
                jQuery('#ver_reparto').html(b);
              }
            })
          });


          $('.cambiarentidad').click(function() {
            var idchatwnrw = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_cambiarentidad.php",
              data: 'option=' + idchatwnrw,
              async: true,
              success: function(b) {
                jQuery('#ver_cambiarentidad').html(b);
              }
            })
          });



          $('.classeditarcontroldia').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/comision_control_dia_editar.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divcontroldiaeditar').html(b);
              }
            })
          });

          $('.classcomisioneditar').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/comision_editar.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divmostrarcomision').html(b);
              }
            })
          });

          $('.classcomisionver').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/comision_ver.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divViewComision').html(b);
              }
            })
          });






          $('.devoluciondinerorechazo').click(function() {
            var asigna = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/devolucion_dinero_rechazo.php",
              data: 'option=' + asigna,
              async: true,
              success: function(b) {
                jQuery('.ver_devolucion_dinero_rechazo').html(b);
              }
            })
          });



          $('.edit_causante').click(function() {
            var percov = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/edit_causante.php",
              data: 'option=' + percov,
              async: true,
              success: function(b) {
                console.log('Causante: ' + b);
                jQuery('#ver_causante').html(b);
              }
            })
          });








          $('.consultaposesion').click(function() {
            var pose = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/posesion_notaria.php",
              data: 'option=' + pose,
              async: true,
              success: function(b) {
                jQuery('#resultadoposesion').html(b);

              }
            })
          });





          $('.actualizaposesion').click(function() {
            var posen = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/situacion_notario.php",
              data: 'option=' + posen,
              async: true,
              success: function(b) {
                jQuery('#resultadoactposesion').html(b);

              }
            })
          });




          $('.consultapermiso').click(function() {
            var per = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/consulta_permiso.php",
              data: 'option=' + per,
              async: true,
              success: function(b) {
                jQuery('#resultadopermiso').html(b);

              }
            })
          });




          $('#botonconsultaciudadano22').click(function() {
            var maxrc = document.getElementById("consultaciudadano").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_ciudadano2.php",
              data: 'option=' + maxrc,
              async: true,
              success: function(b) {
                jQuery('#resultadoconsultaciudadano').html(b);
              }
            })
          });




          $('#botonconsultaciudadano').click(function() {
            var maxrc = document.getElementById("consultaciudadano").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_ciudadano.php",
              data: 'option=' + maxrc,
              async: true,
              success: function(b) {
                jQuery('#resultadoconsultaciudadano1').html(b);
              }
            })
          });





          $('#botonconsultaf').click(function() {
            var maxr = document.getElementById("consultaf").value;

            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_funcionario.php",
              data: 'option=' + maxr,
              async: true,
              success: function(b) {
                jQuery('#resultadoconsultaf').html(b);

              }
            })
          });





          $('#botonconsultacedula').click(function() {
            var maxrw = document.getElementById("consultacedula").value;

            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_funcionarioc.php",
              data: 'option=' + maxrw,
              async: true,
              success: function(b) {
                jQuery('#resultadoconsultacedula').html(b);

              }
            })
          });





          $('#botonconsultanombre').click(function() {
            var maxr = document.getElementById("consultanombre").value;

            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_funcionario_nombre.php",
              data: 'option=' + maxr,
              async: true,
              success: function(b) {
                jQuery('#resultadoconsultanombre').html(b);

              }
            })
          });







          $('#nombreevaluador').click(function() {
            var maxre = document.getElementById("consultanombreevaluador").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_nombre_evaluador.php",
              data: 'option=' + maxre,
              async: true,
              success: function(b) {
                jQuery('#resultadonombreevaluador').html(b);

              }
            })
          });

          $('#nombrecomision').click(function() {
            var maxrec = document.getElementById("consultanombrecomision").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_nombre_comision.php",
              data: 'option=' + maxrec,
              async: true,
              success: function(b) {
                jQuery('#resultadonombrecomision').html(b);

              }
            })
            $('.botonenviaredl').removeAttr('style');

          });





          $('.ver_concertacion').click(function() {
            var posea = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_concertacion.php",
              data: 'option=' + posea,
              async: true,
              success: function(b) {
                jQuery('#respuestaconcertacion').html(b);

              }
            })
          });





          $('.ver_revision_documento').click(function() {
            var poseat = this.id;
            document.getElementById("iddocumento").value = poseat;
            var alto = this.name;

            if ('1' == alto) {


              $('#idcomputa').attr('style', 'display:none');
              $('#computa').removeAttr('required');
            } else {
              $('#idcomputa').removeAttr('style');

            }

          });







          $('#botonconsultanombre2').click(function() {
            var maxrt = document.getElementById("consultanombre2").value;

            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_funcionario_nombre2.php",
              data: 'option=' + maxrt,
              async: true,
              success: function(b) {
                jQuery('#resultadoconsultanombre2').html(b);

              }
            })
          });








          $('#id_tipo_oficina2').change(function() {
            var maxrjvv = document.getElementById("id_tipo_oficina2").value;

            jQuery.ajax({
              type: "POST",
              url: "pages/listado_oficinas.php",
              data: 'option=' + maxrjvv,
              async: true,
              success: function(b) {
                jQuery('#listado_oficinas').html(b);

              }
            })
          });




          $('#id_tipo_oficina4').click(function() {
            var maxrjg = document.getElementById("id_tipo_oficina4").value;

            jQuery.ajax({
              type: "POST",
              url: "pages/listado_oficinas4.php",
              data: 'option=' + maxrjg,
              async: true,
              success: function(b) {
                jQuery('#listado_oficinas4').html(b);

              }
            })
          });






          $('#ver_cedula').click(function() {
            $('#cedula_percepcion').removeAttr('style');
          });




          $('.vertabladoc').click(function() {
            $('#aparecer').removeAttr('style');
          });








          $('#tipoobjeto2').change(function() {
            var martcorr2 = this.value;


            if ('Modificación de licencia vigente' == martcorr2) {
              $('.numradicado2').removeAttr('style');
              $('#ano_licencia2').attr('required', 'required');
              $('.otrasactuaciones2').attr('style', 'display:none');
              $('.prorroga2').attr('style', 'display:none');
              $('.actoadmin2').removeAttr('style');
              $('# actoadministrativo2').attr('required', 'required');

            } else if ('Revalidación' == martcorr2) {
              $('.numradicado2').removeAttr('style');
              $('#ano_licencia2').attr('required', 'required');
              $('.otrasactuaciones2').attr('style', 'display:none');
              $('.prorroga2').attr('style', 'display:none');
              $('.actoadmin2').removeAttr('style');
              $('# actoadministrativo2').attr('required', 'required');

            } else if ('Prorroga' == martcorr2) {
              $('.numradicado2').attr('style', 'display:none');
              $('.prorroga2').removeAttr('style');
              $('#numero_prorroga2').attr('required', 'required');
              $('.otrasactuaciones2').attr('style', 'display:none');
              $('.actoadmin2').removeAttr('style');
              $('# actoadministrativo2').attr('required', 'required');

            } else if ('Otras actuaciones' == martcorr2) {
              $('.numradicado2').attr('style', 'display:none');
              $('.prorroga2').attr('style', 'display:none');
              $('.otrasactuaciones2').removeAttr('style');
              $('#otrasact2').attr('required', 'required');
              $('.prorroga2').attr('style', 'display:none');
              $('.actoadmin2').removeAttr('style');
              $('# actoadministrativo2').attr('required', 'required');



            } else if ('Inicial' == martcorr2) {
              $('.numradicado2').removeAttr('style');
              $('.otrasactuaciones2').attr('style', 'display:none');
              $('.prorroga2').attr('style', 'display:none');
              $('.actoadmin2').attr('style', 'display:none');



            } else if ('Inicial con radicación automática' == martcorr2) {
              $('.numradicado2').attr('style', 'display:none');
              $('.otrasactuaciones2').attr('style', 'display:none');
              $('.prorroga2').attr('style', 'display:none');
              $('.actoadmin2').attr('style', 'display:none');
              $('.ccertificado_ocupacion').attr('style', 'display:none');
              $('#certificado_ocupacion').removeAttr('required');
              $('.cautorizacion_ocupacion').attr('style', 'display:none');
              $('#autorizacion_ocupacion').removeAttr('required');




              $('.cfecha_expedicion').attr('style', 'display:none');
              $('#fecha_expedicion').removeAttr('required');

              $('.cfecha_ejecutoria').attr('style', 'display:none');
              $('#fecha_ejecutoria').removeAttr('required');


              $('.cfecha_viabilidad').attr('style', 'display:none');
              $('#fecha_viabilidad').removeAttr('required');


            } else {

              $('.numradicado2').attr('style', 'display:none');
              $('.otrasactuaciones2').attr('style', 'display:none');
              $('.prorroga2').attr('style', 'display:none');
              $('.actoadmin2').attr('style', 'display:none');
            }




          });



          $('#radicacion_estado').change(function() {
            var martcorr2b = this.value;
            if ('Radicación incompleta' == martcorr2b) {
              $('.mensaje30dias').removeAttr('style');
            } else {
              $('.mensaje30dias').attr('style', 'display:none');
            }
          });



          $('#tipo_evaluacion_edl').change(function() {
            var martcorr = this.value;
            if ('Calificación definitiva' != martcorr) {
              $('.opcionesedl').removeAttr('style');
              $('.obligaedl').attr('required', 'required');


              if ('Calificación inferior al semestre' == martcorr) {
                $('.bloqedl').attr('style', 'display:none');
              } else {}

            } else {
              $('.opcionesedl').attr('style', 'display:none');
              $('.obligaedl').removeAttr('required');
            }
          });







          $('#respuesta').click(function() {
            $('.botonrespuesta').attr('style', 'display:none;');
            $('.formulariorespuesta').removeAttr('style');
          });



          $('.desaparecerboton').click(function() {
            $('.desaparecerboton').attr('style', 'display:none;');
          });




          $('#id_tipo_correspondencia').change(function() {
            var martcor = this.value;
            if ('ER' == martcor) {
              $('#de_iris').removeAttr('readonly');
              $('#de_iris').val('');
            } else {
              $('#de_iris').attr('readonly', 'readonly');
            }
          });






          $('#lineaartistica').change(function() {
            var martcort = this.value;
            if ('Música - Canto Kids' == martcort) {
              $('#kids').removeAttr('style');
            } else {
              $('#kids').attr('style', 'display:none;');
            }
          });







          $('#id_tipo_oficina').change(function() {
            var mart = document.getElementById("id_tipo_oficina").value;
            var depc = document.getElementById("id_departamento").value;
            var munc = document.getElementById("id_municipio").value;

            if (1 == mart) {
              $('#id_departamento').removeAttr('required');
              $('#id_municipio').removeAttr('required');
              $('.ubicacion').attr('style', 'display:none;');
              $('.codigo_oficina').removeAttr('disabled');
            } else {

              $('#id_departamento').attr('required');
              $('#id_municipio').attr('required');
              $('.ubicacion').attr('style', 'display:display;');
              $('.codigo_oficina').attr('disabled', 'disabled');
            }


            if (2 == mart || 3 == mart || 4 == mart) {
              $('.codigo_oficina').removeAttr('disabled');
            }



            jQuery.ajax({
              type: "POST",
              url: "pages/buscar_oficina.php",
              data: 'option=' + mart + '|' + depc + '|' + munc,
              async: true,
              success: function(b) {
                jQuery('#codigo_oficina').html(b);

              }
            })


          });





          $('#id_clase_licencia').change(function() {
            var mart = document.getElementById("id_clase_licencia").value;
            if (6 == mart) {
              $('#vigencia_reconocimiento').attr('style', 'display:none');
              $('#area_construida').attr('style', 'display:none');
            } else {

              if (4 <= mart) {

                $('#area_construida').removeAttr('style');

                if (4 == mart) {
                  $('#vigencia_reconocimiento').attr('style', 'display:none');
                } else {
                  $('#vigencia_reconocimiento').removeAttr('style');

                }

              } else {
                $('#vigencia_reconocimiento').attr('style', 'display:none');
                $('#area_construida').attr('style', 'display:none');
              }
            }
          });





          $('#pregorip11').attr('readonly', 'readonly');
          $('#pregorip12').attr('readonly', 'readonly');
          $('#pregorip13').attr('readonly', 'readonly');

          $('#pregorip10').mouseover(function() {
            var uno = document.getElementById("pregorip1").value;
            var dos = document.getElementById("pregorip2").value;
            var nueve = document.getElementById("pregorip9").value;
            var diez = document.getElementById("pregorip10").value;
            var once = uno - nueve;
            var doce = dos - diez;
            var trece = once + doce;
            $('#pregorip11').val(once);
            $('#pregorip12').val(doce);
            $('#pregorip13').val(trece);
          });




          $('#tipo_predio').change(function() {
            //var par=this.val;
            var marvp = document.getElementById("tipo_predio").value;
            if (1 == marvp) {
              $('#rural').attr('style', 'display:display;color:#000');
              $('#rural1').attr('required', 'required');
              $('#urbano').attr('style', 'display:none');
              $('#urbano1').removeAttr('required', 'required');

            } else if (3 == marvp) {
              $('#rural').attr('style', 'display:display;color:#000');
              $('#rural1').attr('required', 'required');
              $('#urbano').attr('style', 'display:none');
              $('#urbano1').removeAttr('required', 'required');

            } else if (2 == marvp) {
              $('#urbano').attr('style', 'display:display;color:#000');
              $('#urbano1').attr('required', 'required');
              $('#rural').attr('style', 'display:none');
              $('#rural1').removeAttr('required', 'required');

            } else if (4 == marvp) {
              $('#rural').attr('style', 'display:display;color:#000');
              $('#rural1').attr('required', 'required');
              $('#urbano').attr('style', 'display:none');
              $('#urbano1').removeAttr('required', 'required');


            } else {}
          });






          $('#nombre_olimpiada').change(function() {
            var equipos = document.getElementById("nombre_olimpiada").value;
            if ('Futbol 5 Masculino' == equipos ||
              'Futbol 5 Femenino' == equipos ||
              'Baloncesto mixto' == equipos ||
              'Voleibol Mixto' == equipos ||
              'Bolos Mixto' == equipos ||
              'Bolirana Mixto' == equipos ||

              'Mini tejo Mixto' == equipos) {
              $('#vistaequipo').attr('style', 'display:display;');
              $('#tipo_olimpiada').attr('required', 'required');
            } else {
              $('#vistaequipo').attr('style', 'display:none;');
              $('#tipo_olimpiada').removeAttr('required', 'required');
            }
          });








          $('#tipodoctesta').change(function() {
            var calft = document.getElementById("tipodoctesta").value;
            if ('3' == calft) {
              $('#paistesta').removeAttr('style', 'display:display;');
            } else {
              $('#paistesta').attr('style', 'display:none;');
            }
          });



          $('#inforevoca').change(function() {
            var calftu = document.getElementById("inforevoca").value;
            if ('Si' == calftu) {
              $('.revocatesta').removeAttr('style', 'display:display;');
            } else {
              $('.revocatesta').attr('style', 'display:none;');
            }
          });








          $('#actuacioncur').change(function() {
            var actua = document.getElementById("actuacioncur").value;

            if ('CONCEPTO DE NORMA URBANISTICA' == actua || 'CONCEPTO DE USO DEL SUELO' == actua || 'COPIA CERTIFICADA DE PLANOS' == actua) {
              $('#datosactuacionescur').attr('style', 'display:none;');
              $('.obligatoriocur').removeAttr('required', 'required');
            } else {
              $('#datosactuacionescur').attr('style', 'display:display;');
              $('.obligatoriocur').attr('required', 'required');
            }
          });






          $('#id_departamento_testa').change(function() {
            var percora = this.value;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_notaria.php",
              data: 'option=' + percora,
              async: true,
              success: function(b) {
                jQuery('#id_notaria_testa').html(b);
              }
            })
          });








          $('#tipo_calificacionedl').change(function() {
            var calf = document.getElementById("tipo_calificacionedl").value;
            if ('Evaluación parcial eventual' == calf || 'Calificación extraordinaria' == calf)

            {
              $('.edlparcial').attr('style', 'display:display;');
              //  $('#tipo_olimpiada').attr( 'required','required' );
            } else {
              $('.edlparcial').attr('style', 'display:none;');
              // $('#tipo_olimpiada').removeAttr( 'required','required' );	 
            }
          });










          $('#tipo_olimpiada').change(function() {

            var olimpiada = document.getElementById("tipo_olimpiada").value;
            if (0 == olimpiada) {
              $('#name_equipo').attr('style', 'display:display;');
              $('#equipo').attr('required', 'required');
              $('#code').removeAttr('required', 'required');
              $('#code').attr('style', 'display:none;');
            } else {
              $('#name_equipo').attr('style', 'display:none;');
              $('#equipo').removeAttr('required', 'required');
              $('#code').attr('style', 'display:display;');
              $('#code').attr('required', 'required');
            }
          });






          $('.pactiva').click(function() {
            $('.venactiva').removeAttr('style');
            var pacti = 1;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_pactiva.php",
              data: 'option=' + pacti,
              async: true,
              success: function(b) {
                jQuery('#idpactiva').html(b);
              }
            })

          });

          $('.pactivac').click(function() {
            $('.venactiva').attr('style', 'display:none;');
            var pacti = 0;
            jQuery.ajax({
              type: "POST",
              url: "pages/ver_detalle_pactiva.php",
              data: 'option=' + pacti,
              async: true,
              success: function(b) {
                jQuery('#idpactiva').html(b);
              }
            })
          });














          $('#categoria_reparto').change(function() {

            var marvpgr = document.getElementById("categoria_reparto").value;
            if (8 == marvpgr) {
              $('#codigo').attr('style', 'display:display;');
              $('#codigo').attr('required', 'required');
              $('#unidades').attr('style', 'display:display;');
              $('#unidades').attr('required', 'required');
            } else {
              $('#codigo').attr('style', 'display:none;');
              $('#codigo').removeAttr('required', 'required');
              $('#unidades').attr('style', 'display:none;');
              $('#unidades').removeAttr('required', 'required');


            }
          });





          $('#tipo_gimnasio').change(function() {
            //var par=this.val;
            var marvpg = document.getElementById("tipo_gimnasio").value;
            if (1 == marvpg) {
              $('#categoria_gimnasio').attr('style', 'display:display;');
              $('#id_categoria_gimnasio').attr('required', 'required');
              $('#modalidad_gimnasio').attr('style', 'display:none');
              $('#id_modalidad_gimnasio').removeAttr('required', 'required');
              $('#id_modalidad_gimnasio').val('');

              $('#sede_gimnasio').attr('style', 'display:display;');
              $('#id_sede_gimnasio').attr('required', 'required');




            } else if (0 == marvpg) {
              $('#modalidad_gimnasio').attr('style', 'display:display;');
              $('#id_modalidad_gimnasio').attr('required', 'required');
              $('#categoria_gimnasio').attr('style', 'display:none');
              $('#id_categoria_gimnasio').removeAttr('required', 'required');
              $('#id_categoria_gimnasio').val('');

              $('#sede_gimnasio').attr('style', 'display:none');
              $('#id_sede_gimnasio').removeAttr('required', 'required');
              $('#id_sede_gimnasio').val('');


            } else {}
          });







          $('#reconocimiento_vigencia2').change(function() {
            //var par=this.val;
            var marvpo = document.getElementById("reconocimiento_vigencia2").value;
            if (1 == marvpo) {
              $('#vigencia_reconocimiento1').removeAttr('disabled', 'disabled');


            } else if (0 == marvpo) {
              $('#vigencia_reconocimiento1').val('0');
              $('#vigencia_reconocimiento1').attr('disabled', 'disabled');

            } else {}
          });








          $('.notariaaporteespecialeditar').click(function() {
            var op = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/notaria_aporte_especial_editar.php",
              data: 'option=' + op,
              async: true,
              success: function(b) {
                jQuery('#divnotariaaporteespecialeditar').html(b);
              }
            })
          });

          $('.notariadetalleingresoescrituracioneditar').click(function() {
            var op = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/notaria_detalle_ingreso_escrituracion_editar.php",
              data: 'option=' + op,
              async: true,
              success: function(b) {
                jQuery('#divnotariadetalleingresoescrituracioneditar').html(b);
              }
            })
          });

          $('.notariaotrosactosnotarialeseditar').click(function() {
            var op = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/notaria_otros_actos_notariales_editar.php",
              data: 'option=' + op,
              async: true,
              success: function(b) {
                jQuery('#divnotariaotrosactosnotarialeseditar').html(b);
              }
            })
          });











          $('.editarcontratos').click(function() {
            var asigna = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/1nc_editar_contrato.php",
              data: 'option=' + asigna,
              async: true,
              success: function(b) {
                jQuery('.ver_editar_contrato').html(b);
              }
            })
          });

          $('.editarconfigestampilla').click(function() {
            var asigna = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/1nc_editar_estampilla.php",
              data: 'option=' + asigna,
              async: true,
              success: function(b) {
                jQuery('.ver_editar_config_estampilla').html(b);
              }
            })
          });

          $('.editarconfigreteica').click(function() {
            var asigna = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/1nc_editar_reteica.php",
              data: 'option=' + asigna,
              async: true,
              success: function(b) {
                jQuery('.ver_editar_config_reteica').html(b);
              }
            })
          });

          $('.editarconfigsobretasa').click(function() {
            var asigna = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/1nc_editar_sobretasa.php",
              data: 'option=' + asigna,
              async: true,
              success: function(b) {
                jQuery('.ver_editar_config_sobretasa').html(b);
              }
            })
          });






          $('#id_tipo_respuesta').change(function() {
            //var par=this.val;
            var marv = document.getElementById("id_tipo_respuesta").value;
            if (1 == marv) {
              $('#correoc').attr('style', 'display:display;color:#ff0000');
              $('#correo_c').attr('required', 'required');
              $('#direccionc').attr('style', 'display:none');
              $('#direccion_c').removeAttr('required', 'required');

            } else if (2 == marv) {
              $('#correoc').attr('style', 'display:none');
              $('#correo_c').removeAttr('required', 'required');
              $('#direccionc').attr('style', 'display:display;color:#ff0000');
              $('#direccion_c').attr('required', 'required');

            } else if (3 == marv) {
              $('#correoc').attr('style', 'display:none');
              $('#correo_c').removeAttr('required', 'required');
              $('#direccion_c').removeAttr('required', 'required');
              $('#direccionc').attr('style', 'display:none');
            } else {}
          });




          $('.numero').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
          });


          $('.numerodecimal').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '');
          });


          $('.matriculaspermitidas').on('input', function() {
            this.value = this.value.replace(/[^0-9,-NSC]/g, '');
          });


          $('.numeroscomas').on('input', function() {
            this.value = this.value.replace(/[^0-9,]/g, '');
          });


          $('.sololetras').on('input', function() {
            this.value = this.value.replace(/[^0-9_a-z]/g, '');
          });


          $('.mayuscula').on('input', function() {
            this.value = this.value.toUpperCase();
          });


          $('.dinero').number(true, 2);

          $(".close").click(function() {
            $("#insertado").alert("close");
          });



          $('#fecha_permiso_hasta').click(function() {
            $('#horas_permiso').attr('style', 'display:none;');
          });


          $('tr').click(function() {
            $(this).attr('style', 'background:#ddd');
          });

          $('tr').dblclick(function() {
            $(this).removeAttr('style');
          });



          $('#id_clase_licencia').change(function() {
            //var par=this.val;
            var mar = document.getElementById("id_clase_licencia").value;
            if (3 == mar || 2 == mar || 1 == mar) {
              $('#lotes_resultantes').removeAttr('style');
              $('#lotes_resultantes1').attr('required', 'required');
            } else {
              $('#lotes_resultantes').attr('style', 'display:none');
              $('#lotes_resultantes1').removeAttr('required');

            }
          });



          $('.ventana1').click(function() {
            var pa = this.id;
            $('.licencia').val(pa);
            var pap = this.id;
            $('.licenciac').html(pap);
          });





          $('#id_tipo_poder').change(function() {
            var esc = document.getElementById("id_tipo_poder").value;
            if (3 == esc) {
              $('#escritura').attr('style', 'display:display;');
              $('#vigenciaescritura').attr('style', 'display:none');
              $('#numero_escritura').attr('required', '');
              $('#fecha_escritura').attr('required', '');
              $('#fecha_escritura_vigencia').removeAttr('required');
              $('#hora_vigencia').removeAttr('required');
              $('#numero_escritura2').removeAttr('required');
              $('#fecha_escritura2').removeAttr('required');

              $('#id_pais').removeAttr('required');
              $('#pais').attr('style', 'display:none');
              $('#infoadjunto').html('ESCRITURA PÚBLICA');


            } else if (4 == esc) {
              $('#vigenciaescritura').attr('style', 'display:display;');
              $('#escritura').attr('style', 'display:none');
              $('#fecha_escritura_vigencia').attr('required', '');
              $('#hora_vigencia').attr('required', '');
              $('#numero_escritura').removeAttr('required');
              $('#fecha_escritura').removeAttr('required');
              $('#numero_escritura2').attr('required', '');
              $('#fecha_escritura2').attr('required', '');

              $('#id_pais').removeAttr('required');
              $('#pais').attr('style', 'display:none');
              $('#infoadjunto').html('CERTIFICADO DE VIGENCIA E.P.');




            } else {
              $('#escritura').attr('style', 'display:none');
              $('#vigenciaescritura').attr('style', 'display:none');
              $('#numero_escritura').removeAttr('required');
              $('#fecha_escritura').removeAttr('required');
              $('#fecha_escritura_vigencia').removeAttr('required');
              $('#numero_escritura2').removeAttr('required');
              $('#fecha_escritura2').removeAttr('required');
              $('#hora_vigencia').removeAttr('required');

              $('#pais').attr('style', 'display:display');
              $('#id_pais').attr('required', '');

              $('#infoadjunto').html('PODER AUTENTICADO');
            }
          });






          $('#id_tipo_documento_menor').change(function() {
            var erc = document.getElementById("id_tipo_documento_menor").value;
            if (10 == erc) {
              $('#infoadjuntocivil').html('VISA DEL MENOR');
            } else {
              $('#infoadjuntocivil').html('REGISTRO CIVIL DE NACIMIENTO');
            }
          });






          $('#tipo_req_tras').change(function() {
            var tipo_req_tras = document.getElementById("tipo_req_tras").value;
            if (0 == tipo_req_tras) {
              $('#divreq').attr('style', 'display:display;');
              $('#divtras').attr('style', 'display:none');
              $('#divreqciu').attr('style', 'display:display');
              $('#divtrasciu').attr('style', 'display:none');
            } else if (1 == tipo_req_tras) {
              $('#divtras').attr('style', 'display:display;');
              $('#divreq').attr('style', 'display:none');
              $('#divreqciu').attr('style', 'display:none');
              $('#divtrasciu').attr('style', 'display:display');

            } else {
              $('#divreq').attr('style', 'display:none');
              $('#divtras').attr('style', 'display:none');
              $('#divreqciu').attr('style', 'display:none');
              $('#divtrasciu').attr('style', 'display:none');
            }
          });





          $('#sale_dif_padres').change(function() {
            var padres = document.getElementById("sale_dif_padres").value;
            if (1 == padres) {
              $('#persona_sale').attr('style', 'display:display;');
            } else {
              $('#persona_sale').attr('style', 'display:none');
            }
          });





          $('#impedimento').change(function() {
            var imp = document.getElementById("impedimento").value;
            if ('No' == imp) {
              $('.siimpedimento').attr('style', 'display:none;');
            } else {
              $('.siimpedimento').attr('style', 'display:display');
            }
          });



          $('#retorno').change(function() {
            var retorno = document.getElementById("retorno").value;
            if (1 == retorno) {
              $('#motivo_noretorno').removeAttr('required');
              $('#fecha_retorno').attr('required', '');
              $('#fecha_retorno_hasta').attr('required', '');

              $('#si_retorno').attr('style', 'display:display;');
              $('#no_retorno').attr('style', 'display:none;');


            } else {

              $('#no_retorno').attr('style', 'display:display;');
              $('#si_retorno').attr('style', 'display:none;');

              $('#fecha_retorno').removeAttr('required');
              $('#fecha_retorno_hasta').removeAttr('required');
              $('#motivo_noretorno').attr('required', '');


            }
          });




          $('#id_tipo_documentoc').change(function() {
            var aut = document.getElementById("id_tipo_documentoc").value;
            if (305 == aut) {
              $('#cedulac').attr('style', 'display:display;');
              $('#cedulacontratista').attr('required', 'required');
            } else {
              $('#cedulac').attr('style', 'display:none;');
              $('#cedulacontratista').removeAttr('required');
            }
          });






          $('#id_tipo_autorizacion_salida').change(function() {
            var autorizacion = document.getElementById("id_tipo_autorizacion_salida").value;
            if (1 == autorizacion) {

              $('#id_tipo_documento_padre').attr('required', 'required');
              $('#identificacion_padre').attr('required', 'required');
              $('#nombre_padre').attr('required', 'required');
              $('#id_tipo_documento_madre').removeAttr('required');
              $('#identificacion_madre').removeAttr('required');
              $('#nombre_madre').removeAttr('required');
              $('.obligapadre').attr('style', 'display:display;color:#ff0000;');
              $('.obligamadre').attr('style', 'display:none;');

            } else if (2 == autorizacion) {

              $('#id_tipo_documento_madre').attr('required', 'required');
              $('#identificacion_madre').attr('required', 'required');
              $('#nombre_madre').attr('required', 'required');
              $('#id_tipo_documento_padre').removeAttr('required');
              $('#identificacion_padre').removeAttr('required');
              $('#nombre_padre').removeAttr('required');
              $('.obligamadre').attr('style', 'display:display;color:#ff0000;');
              $('.obligapadre').attr('style', 'display:none;');


            } else if (4 == autorizacion) {
              $('#id_tipo_documento_padre').attr('required', 'required');
              $('#identificacion_padre').attr('required', 'required');
              $('#nombre_padre').attr('required', 'required');
              $('#id_tipo_documento_madre').attr('required', 'required');
              $('#identificacion_madre').attr('required', 'required');
              $('#nombre_madre').attr('required', 'required');
              $('.obligapadre').attr('style', 'display:display;color:#ff0000;');
              $('.obligamadre').attr('style', 'display:display;color:#ff0000;');

            } else {
              $('#id_tipo_documento_padre').removeAttr('required');
              $('#identificacion_padre').removeAttr('required');
              $('#nombre_padre').removeAttr('required');
              $('#id_tipo_documento_madre').removeAttr('required');
              $('#identificacion_madre').removeAttr('required');
              $('#nombre_madre').removeAttr('required');
              $('.obligapadre').attr('style', 'display:none;');
              $('.obligamadre').attr('style', 'display:none;');
            }
          });









          $('#id_grupo').change(function() {
            var ma = document.getElementById("id_grupo").value;


            jQuery.ajax({
              type: "POST",
              url: "pages/funcionario_grupo.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#id_funcionario_grupo').html(b);


              }
            })
          });



          $('#id_categoria_oac').change(function() {
            var ma = document.getElementById("id_categoria_oac").value;


            jQuery.ajax({
              type: "POST",
              url: "pages/clase_oac.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#id_clase_oac').html(b);

                var pa = "";
                $('#id_tema_oac').val(pa);
                $('#id_motivo_oac').val(pa);

              }
            })
          });



          $('#id_clase_oac').change(function() {
            var ma = document.getElementById("id_clase_oac").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/tema_oac.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#id_tema_oac').html(b);

                var pa = "";
                $('#id_motivo_oac').val(pa);
              }
            })
          });



          $('#id_tema_oac').change(function() {
            var ma = document.getElementById("id_tema_oac").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/motivo_oac.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#id_motivo_oac').html(b);
              }
            })
          });




          $('#id_departamento').change(function() {
            var ma = document.getElementById("id_departamento").value;
            var pab = '<option value="" selected></option>';
            $('#id_tipo_oficina').val(pab);
            $('#codigo_oficina').val(pab);
            $('.codigo_oficina').attr('disabled', 'disabled');


            jQuery.ajax({
              type: "POST",
              url: "pages/municipios.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#id_municipio').html(b);
              }
            })
          });



          $('#id_departamentomun').change(function() {
            var ma = document.getElementById("id_departamentomun").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/municipiosid.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#id_municipiomun').html(b);
              }
            })
          });




          $('#id_departamentomun2').change(function() {
            var ma = document.getElementById("id_departamentomun2").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/municipiosid.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#id_municipiomun2').html(b);
              }
            })
          });





          $('#id_procedimiento_interno').change(function() {
            var marr = document.getElementById("id_procedimiento_interno").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/accion_interna.php",
              data: 'option=' + marr,
              async: true,
              success: function(b) {
                jQuery('#id_accion_interna').html(b);
              }
            })
          });






          $('#id_clase_licencia').change(function() {
            var ma = document.getElementById("id_clase_licencia").value;
            jQuery.ajax({
              type: "POST",
              url: "pages/modalidad_licencia.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#id_modalidad_licencia').html(b);
              }
            })
          });






          $('.listarcita').on('click', function() {
            var mayx = this.id;

            var opcionx = confirm('¿Confirma atención?');
            if (opcionx == true) {

              document.getElementById("acita").value = mayx;

              document.forms["formularioagenda"].submit();
            } else {
              return false;
            }
          });

          $('.noasistio').on('click', function() {
            var mayx = this.id;

            var opcionx = confirm('¿Confirma que no asistio?');
            if (opcionx == true) {

              document.getElementById("acita2").value = mayx;

              document.forms["formularionoasistio"].submit();
            } else {
              return false;
            }
          });




          $('.seleccion').click(function() {
            var ma = this.id;

            jQuery.ajax({
              type: "POST",
              url: "pages/listado.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                //jQuery('#'+ma+'2').html(b);
                $('#' + ma + '3').attr('style', 'display:none');
                $('#' + ma + '2').html(b);
              }
            })
          });












          $('.borrar_f').on('click', function() {
            var opcion = confirm('¿Estas seguro de eliminar el registro?');
            var may = this.id;
            var mayk = this.name;

            if (opcion == true) {

              document.getElementById("borrarregistro").value = may;
              document.getElementById("borrardetabla").value = mayk;

              document.forms["formulario_borrar"].submit();
            } else {
              return false;
            }
          });





          $('.anular').on('click', function() {
            var opciont = confirm('¿Estas seguro de anular el registro?');
            var mayt = this.id;
            if (opciont == true) {
              document.getElementById("anularregistro").value = mayt;
              document.forms["formulario_anular"].submit();
            } else {
              return false;
            }
          });






          $('.adjuntar').change('click', function() {
            document.forms["adjuntar_documento"].submit();
          });









          $(".fobliga").submit(function() {
            if (($("#fecha_desde").val().length < 2) || ($("#fecha_hasta").val().length < 2)) {
              alert("Se deben llenar todos los campos");
              return false;
            }
            return true;
          });





          //SID

          $('.controlProcesoAccionEtapa').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_accion_etapa.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divControlProcesoAccionEtapa').html(b);
              }
            })
          });

          $('.sidasignacion').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_asignacion.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divsidasignacion').html(b);
              }
            })
          });

          $('.sidnotificacion').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_notificacion.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divsidnotificacion').html(b);
              }
            })
          });

          $('.siddetallemigracion').click(function() {
            var ma = this.id;
            console.log('this.id');
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_detalle_migracion.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divsiddetallemigracion').html(b);
              }
            })
          });

          $('.sidetapamigracion').click(function() {
            var ma = this.id;
            console.log('this.id');
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_etapa_migracion.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divsidetapamigracion').html(b);
              }
            })
          });

          $('.controlprocesoeditarimplicado').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_editar_implicado.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divControlProcesoEditarImplicado').html(b);
              }
            })
          });



          $('.sidoldtraslado').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_migracion_traslado.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divsidoldtraslado').html(b);
              }
            })
          });

          $('.anexoetapa').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_etapa_anexo.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divverfaseetapa').html(b);
              }
            })
          });

          $('.anexoobservacion').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_etapa_observacion.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divetapaobservacion').html(b);
              }
            })
          });



          $('.sidcrearnotificacion').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_notificacion_editar.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divsidcrearnotificacion').html(b);
              }
            })
          });


          $('.sidtraslado').click(function() {
            var ma = this.id;
            jQuery.ajax({
              type: "POST",
              url: "pages/control_proceso_traslado.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divsidtraslado').html(b);
              }
            })
          });

          $('.actualizarcontrato').click(function() {
            var ma = this.id;
            console.log('this.id');
            jQuery.ajax({
              type: "POST",
              url: "pages/contratos_detalle.php",
              data: 'option=' + ma,
              async: true,
              success: function(b) {
                jQuery('#divactualizarcontrato').html(b);
              }
            })
          });




          /*
          $("#obligapercepcion").submit(function () {  
              if (
          	($("#claridad_lenguaje").val().length >0) || 
          	($("#agilidad_atencion").val().length  >0) || 	
          		($("#calidad_respuesta").val().length  >0) || 
          		($("#tiempo_respuesta").val().length  >0) || 
          		($("#amabilidad_atencion").val().length  >0) 
          	
          	) {  
          	
                  alert("Se deben seleccionar una calificación para todos los campos");  
                  return false;  
              }  
              return true;  
          }); 	
          	*/



          $('.solonumeros').keyup(function() {
            this.value = (this.value + '').replace(/[^0-9]/g, '');
          });



          $('.cerrar_pqrs_cert').on('click', function() {
            return confirm('¿Estas seguro de cerrar la PQRS, recuerde que debe tener un anexo de respuesta (Que ya exista ó que adjunte.).?');
          });




          $('.seguroelimfac').on('click', function() {
            return confirm('¿Estas seguro de eliminar todas las facturas?');
          });






          $('.confirmationdel').on('click', function() {
            return confirm('¿Estas seguro de eliminar el registro?');
          });



          $('.confirmarcambio').on('click', function() {
            return confirm('¿Estas seguro de la operación en el registro?');
          });



          $('.confirmadesvincular').on('click', function() {
            return confirm('¿Estas seguro de desvincular la PQRS?');
          });



          $('.confirmationnot').on('click', function() {
            return confirm('¿Esta seguro de crear el registro?');
          });


          $('.confirmavotacion').on('click', function() {
            var plancha = this.id;
            return confirm('¿Esta seguro de votar por la plancha número: ' + plancha + '. Recuerde que una vez emitido el voto, no puede ser modificado.');
          });



          $('.confirmaenvio').on('click', function() {

            return confirm('Esta seguro de crear el radicado. ');
          });


          $('.confirmationupdate').on('click', function() {
            return confirm('¿Esta seguro de actualizar el registro?');
          });


          $('.confirmacioneliminacionreporteimpresoras').on('click', function() {
            return confirm('¿Esta seguro de eliminar todos los registros?');
          });



          $('.confirmarrespuestar').on('click', function() {
            return confirm('Una vez enviada la respuesta, no podra adjuntar documentos.');
          });



          $('.enviar_correo').on('click', function() {
            return confirm('¿Esta seguro de enviar el correo?');
          });




          $('.aprobar_registro').on('click', function() {
            return confirm('¿Esta seguro de aprobar el registro?');
          });






          $('#form1').submit(function() {
            if (document.getElementById('nombre_usuario').value != "") {
              return true;
            } else {
              return false;
            }
          });



          /*
                        $('.seleccion').click(function (){
                        var ma =this.id;
                        jQuery.ajax({
                                type: "POST",
                                url: "pages/listado.php",
                                data: 'option='+ma,
                                async: true,
                    success: function(data){
              $.each(data,function(key, registro) {
                $("#Select").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
              });        
            }
                        })
                });

        */


          /*
                  $('#calendar').fullCalendar({
              header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
              },
               defaultDate: '2018-03-23',
                  locale: 'es',
              navLinks: true, // can click day/week names to navigate views
              editable: false,  //true
                  firstDay: 1,
                  lang: 'es',




              selectable: true,



              eventLimit: true, // allow "more" link when too many events


                  eventClick: function(event) {
                                        window.open(event.url, 'Info', 'width=200,height=30');
                                        return false;
                        },







              events: [
                {
                  title: 'Disponible',
                          url: '',
                  start: '2018-03-23T07:00:00',
                          end: '2018-03-23T08:00:00',
                          color:'#4BA34B',
                          textColor:'#fff'
                },
                          {
                  title: 'Ocupado',
                  start: '2018-03-23T08:00:00',
                          end: '2018-03-23T09:00:00',
                },
                          {
                  title: 'Disponible',
                          url: '',
                  start: '2018-03-23T09:00:00',
                          end: '2018-03-23T10:00:00',
                          color:'#4BA34B',
                          textColor:'#fff'
                },
                         {
                  title: 'Disponible',
                          url: '',
                  start: '2018-03-23T10:00:00',
                          end: '2018-03-23T11:00:00',
                          color:'#4BA34B',
                          textColor:'#fff'
                },
                         {
                  title: 'Disponible',
                          url: '',
                  start: '2018-03-23T11:00:00',
                          end: '2018-03-23T12:00:00',
                          color:'#4BA34B',
                          textColor:'#fff'
                },
                         {
                  title: 'Disponible',
                          url: '',
                  start: '2018-03-23T12:00:00',
                          end: '2018-03-23T13:00:00',
                          color:'#4BA34B',
                          textColor:'#fff'
                }
              ]
            });


*/










        })








        function DisableSpecificDates(date) {
          var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
          return [arraydays.indexOf(string) == -1];
        }


        $(function() {
          $(".datepicker").datepicker();
        });





        $(function() {
          $('.datepickersinfinsemana').datepicker({
            beforeShowDay: $.datepicker.noWeekends,
            changeMonth: true,
            changeYear: true,
            yearRange: "2018:2030"
          });
        });





        $(function() {
          $(".datepickera").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1940:2030"
          });
        });

        $(function() {
          $(".datepickerjo").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2012:<?php echo $anoactualcompleto; ?>"

          });
        });




        $(function() {
          $(".datepickerexpensacur").datepicker({
            maxDate: new Date(2020, 5, 20),
            minDate: new Date(2017, 12, 1)
          });
        });




        $(".datepickeredl").datepicker({
          minDate: new Date(2022, 7, 1),
          maxDate: new Date(2023, 6, 31)
        });

        /*
        	$(".datepickeredl20231").datepicker({
        	minDate: new Date(2023, 1, 1),
        	maxDate: new Date(2023, 6, 31)

        	});
        	
        	

        	$('.periodoedl').change(function() {
                var edlp = this.value;
                if ("2022-2"==edlp) {
        	$('#edlini').attr('class','form-control datepickeredl20222 obligaedl');
            $('#edlfin').attr('class','form-control datepickeredl20222 obligaedl');
        		} else if ("2023-1"==edlp) {
            $('#edlini').attr('class','form-control datepickeredl20231 obligaedl');
            $('#edlfin').attr('class','form-control datepickeredl20231 obligaedl');
        		}
              });
        	  */











        $(function() {
          $(".datepickercuraduria").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2016:<?php echo $anoactualcompleto; ?>"

          });
        });


        $.datepicker.regional['es'] = {
          closeText: 'Cerrar',
          prevText: '<Ant',
          nextText: 'Sig>',
          currentText: 'Hoy',
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
          dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
          dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
          weekHeader: 'Sm',
          dateFormat: 'yy-mm-dd',
          firstDay: 1,
          isRTL: false,
          showMonthAfterYear: false,
          yearSuffix: '',
          beforeShowDay: DisableSpecificDates
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
      </script>






      <script type="text/javascript" src="plugins/d3/d3.v3.js"></script>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js"></script>

      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css">











      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120466003-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
          dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-120466003-1');
      </script>



    </body>

    </html>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ?>
      <!--<script src='ip2.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script>
	  if( !document.cookie == "ipremote=0;" ){
       document.cookie = "ipremote=0;";
    } else {

var infoip;
	 axios.get('https://api.ipify.org')
            .then(response => {
              infoip=response.data;
			//  document.getElementById('ips').value=info;
			  document.cookie="ipremote="+infoip+";";
             // console.log(response);
            })
            .catch(error => {
             // console.log(error);
            });
			´
			}
</script>
-->
    <?php


      //https://norfipc.com/codigos/obtener-datos-asociados-direccion-ip-internet.php
      //https://www.ipify.org/   https://api.ipify.org/?format=json      http://checkip.amazonaws.com/ 
      //$ipremota = file_get_contents('https://api.ipify.org');

      /*
if (isset($_COOKIE['ipremote'])) {
	$ipremota=$_COOKIE['ipremote'];
} else {
	$ipremota=file_get_contents('https://api.ipify.org');
}



if (isset($_COOKIE['iplocal2'])) {
	$ip_local2=$_COOKIE['iplocal2'];
	//echo $ip_snr;
} else {
	$ip_local2='127.0.0.1';
}

*/

      $ipremota = '190.145.190.132';
      $ip_local2 = '127.0.0.1';
      //setcookie("iplocal","iplocal");

      $campos = json_encode($_POST);

      //$campos = print_r($_POST, true);


      //$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      $url = $_SERVER['REQUEST_URI'];
      $user = $_SESSION['snr'];
      $insertSQL88 = sprintf(
        "INSERT INTO auditoria (id_funcionario, alias, ip, fecha_hora, url, descripcion_auditoria, ip_local) VALUES (%s, %s, %s, now(), %s, %s, %s)",
        GetSQLValueString($user, "int"),
        GetSQLValueString($alias, "text"),
        GetSQLValueString($ipremota, "text"),
        GetSQLValueString($url, "text"),
        GetSQLValueString($campos, "text"),
        GetSQLValueString($ip_local2, "text")
      );
      $Result188 = mysql_query($insertSQL88, $conexion);

      mysql_free_result($Result188);
    }



    // envio automatico de mensajes...
    /*
$masundia = date('Y-m-d', strtotime('+1 day', strtotime($realdate)));
$selectyyc = mysql_query("select count(id_mensaje_correo) as tmens from mensaje_correo where fecha_mensaje BETWEEN '$realdate' AND '$masundia' and estado_mensaje_correo=1", $conexion);
$rowyyc = mysql_fetch_assoc($selectyyc);
if (0<$rowyyc['tmens']) {
require_once('auto.php');
} else {
//require_once('auto.php');
}
 */

    mysql_close($conexion);
  } else { ?>


    <html>

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Supernotariado</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link href='images/favicon.ico' rel='icon' type='image/x-icon' />
    </head>

    <body id="main">
      <div id="header1" class="x-hide-display">
        <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="100%" align="center">
              <image src="images/cabezotesnr-2020.jpg">
            </td>
        </table>
      </div>
      <div id="body1" class="x-hide-display">
        <center>

          <table style="width:300px; border: 1px solid #dddddd; padding: 15px;">
            <tr>
              <td>

                <div class="ca-login-titletext"> Iniciar sesión </div>
                <br />
                <br />
                <form NAME="Login" action="index.jsp" METHOD="post" form="form">

                  <div class="ca-login-text"> Nombre de usuario </div>
                  <input type="text" tabindex="1" size="30" autocomplete="off" name="username">
                  <div class="ca-login-forgottext"><a href="https://accesos.supernotariado.gov.co/iam/im/logout.jsp?envAlias=snr">¿Nombre del usuario olvidado?</a></div>
                  <br />
                  <div class="ca-login-text"> Contraseña </div>
                  <input type="password" tabindex="2" size="30" name="password">
                  <div class="ca-login-forgottext"><a href="https://accesos.supernotariado.gov.co/iam/im/logout.jsp?envAlias=snr">¿Contraseña olvidada?</a></div>
                  <br />
                  <br />

                  <INPUT TYPE="HIDDEN" NAME="SMENC" VALUE="UTF-8">
                  <INPUT type="HIDDEN" name="SMLOCALE" value="ES-es">
                  <input type="hidden" name="query" value="skin=snr">
                  <input type="hidden" name="target" value="http://www.vur.gov.co/portal/">
                  <input type="hidden" name="smquerydata" value="">
                  <input type="hidden" name="smauthreason" value="0">
                  <input type="hidden" name="smagentname" value="idymJium+3XZdKHdwLSjGzYCrP4BuR/WyQX40WqW6HPUBYZVOqWKS8WmOHGkuPrn">
                  <input type="hidden" name="postpreservationdata" value="">

                  <table id="ext-comp-1019" cellspacing="0" class="x-btn x-btn-noicon" style="width: auto;">
                    <tbody class="x-btn-small x-btn-icon-small-left">
                      <tr>
                        <td class="x-btn-tl"><i>&nbsp;</i></td>
                        <td class="x-btn-tc"></td>
                        <td class="x-btn-tr"><i>&nbsp;</i></td>
                      </tr>
                      <tr>
                        <td class="x-btn-ml"><i>&nbsp;</i></td>
                        <td class="x-btn-mc"><em class="" unselectable="on"><button name="ext-gen40" value="btnLogin" type="submit" id="ext-gen40" class=" x-btn-text" tabindex="3"> Iniciar sesión</button></em></td>
                        <td class="x-btn-mr"><i>&nbsp;</i></td>
                      </tr>
                      <tr>
                        <td class="x-btn-bl"><i>&nbsp;</i></td>
                        <td class="x-btn-bc"></td>
                        <td class="x-btn-br"><i>&nbsp;</i></td>
                      </tr>
                    </tbody>
                  </table>



                </form>
              </td>
            </tr>
          </table>
        </center>

      </div>


      <div id="ext-comp-1024" class=" x-panel x-border-panel" style="left: 0px;  position: absolute; bottom: 0;  border-color:red; width: 100%;">
        <div class="x-panel-bwrap" id="ext-gen45">
          <div class="x-panel-body ca-footer-section x-panel-body-noheader" id="ext-gen46" style="padding: 5px; height: 38px; width: 100%;"><label id="ext-comp-1025">
              <div id="footer1" class="">
                <table width="100%" border="0" cellpadding="0" class="ca-footer-text">
                  <tbody>
                    <tr>
                      <td nowrap="nowrap" class="ca-footer-copytext" align="center">Copyright &copy; 2019. Todos los derechos reservados.</td>
                    </tr>
                    <tr>
                      <td nowrap="" align="center">
                        <div class="ca-footer-linktext">
                          <a href="http://www.supernotariado.gov.co" target="CA">Superintendencia de Notariado y Registro</a>
                        </div>

                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </label></div>
        </div>
      </div>

    </body>

    <script type="text/javascript">
      // carga de pantalla
      // $(document).ajaxStart(function () {
      //   Pace.restart()
      // })
    </script>


    </html>

<?php }
} else {
  echo 'En Mantenimiento....';
}  ?>
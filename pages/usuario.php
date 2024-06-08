<?php
if (isset($_GET['i'])) {
  $id = $_GET['i'];
} else {
  $id = $_SESSION['snr'];
}

$nump3 = privilegios(3, $_SESSION['snr']);
$nump8 = privilegios(8, $_SESSION['snr']);
$nump9 = privilegios(9, $_SESSION['snr']);
$nump12 = privilegios(12, $_SESSION['snr']);
$nump13 = privilegios(13, $_SESSION['snr']);
$nump14 = privilegios(14, $_SESSION['snr']);
$nump15 = privilegios(15, $_SESSION['snr']);
$nump17 = privilegios(17, $_SESSION['snr']);
$nump20 = privilegios(20, $_SESSION['snr']);
$nump32 = privilegios(32, $_SESSION['snr']);
$nump36 = privilegios(36, $_SESSION['snr']);
$nump93 = privilegios(93, $_SESSION['snr']);
$nump96 = privilegios(96, $_SESSION['snr']);
$nump100 = privilegios(100, $_SESSION['snr']);
$nump101 = privilegios(101, $_SESSION['snr']);
$nump109 = privilegios(109, $_SESSION['snr']);
$nump119 = privilegios(119, $_SESSION['snr']);



if ((isset($_POST["foto_confirmacion"])) && ($_POST["foto_confirmacion"] != "")) {
  $foto_confirmacion = $_POST["foto_confirmacion"];
  $updateSQL = sprintf(
    "UPDATE funcionario SET foto_confirmacion=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($foto_confirmacion, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}



if ((isset($_POST["rh"])) && ($_POST["rh"] != "")) {
  $rh = $_POST["rh"];
  $updateSQL = sprintf(
    "UPDATE funcionario SET rh=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($rh, "text"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}




if ((isset($_POST["encargado_notaria"])) && ($_POST["encargado_notaria"] != "")) {
  $en = intval($_POST["encargado_notaria"]);
  $updateSQL = sprintf(
    "UPDATE funcionario SET encargado_notaria=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($en, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}




if ((isset($_POST["telefono_funcionario"])) && ($_POST["telefono_funcionario"] != "")) {
  $telefono_funcionario = $_POST["telefono_funcionario"];
  $updateSQL = sprintf(
    "UPDATE funcionario SET telefono_funcionario=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($telefono_funcionario, "text"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}




if ((isset($_POST["fecha_exp_cedula"])) && ($_POST["fecha_exp_cedula"] != "")) {
  $fecha_exp_cedula = $_POST["fecha_exp_cedula"];
  $updateSQL = sprintf(
    "UPDATE funcionario SET fecha_exp_cedula=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($fecha_exp_cedula, "text"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}



if ((isset($_POST["aforado_sindical"])) && ($_POST["aforado_sindical"] != "")) {
  $aforado_sindical = $_POST["aforado_sindical"];
  $updateSQL = sprintf(
    "UPDATE funcionario SET aforado_sindical=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($aforado_sindical, "text"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}



if ((isset($_POST["celular_funcionario"])) && ($_POST["celular_funcionario"] != "")) {
  $celular_funcionario = $_POST["celular_funcionario"];
  $updateSQL22 = sprintf(
    "UPDATE funcionario SET celular_funcionario=%s WHERE  id_funcionario=%s AND estado_funcionario=1",
    GetSQLValueString($celular_funcionario, "text"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL22, $conexion);
  //echo $updateSQL22;
}



if ((isset($_POST["id_estado_civil"])) && ($_POST["id_estado_civil"] != "")) {
  $id_estado_civil = $_POST["id_estado_civil"];
  $updateSQL = sprintf(
    "UPDATE funcionario SET id_estado_civil=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($id_estado_civil, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}


if ((isset($_POST["id_nivel_academico"])) && ($_POST["id_nivel_academico"] != "")) {
  $id_nivel_academico = $_POST["id_nivel_academico"];
  $updateSQL = sprintf(
    "UPDATE funcionario SET id_nivel_academico=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($id_nivel_academico, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}



if ((isset($_POST["numero_hijos"])) && ($_POST["numero_hijos"] != "")) {
  $numero_hijos = $_POST["numero_hijos"];
  $updateSQL = sprintf(
    "UPDATE funcionario SET numero_hijos=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($numero_hijos, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}


if ((isset($_POST["direccion_funcionario"])) && ($_POST["direccion_funcionario"] != "")) {
  $direccion_funcionario = $_POST["direccion_funcionario"];
  $updateSQL = sprintf(
    "UPDATE funcionario SET direccion_funcionario=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($direccion_funcionario, "text"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}



if ((isset($_POST["id_cargo_nomina_encargo"])) && ($_POST["id_cargo_nomina_encargo"] != "")) {
  $id_cargo_nomina_encargo = $_POST["id_cargo_nomina_encargo"];
  $updateSQLc = sprintf(
    "UPDATE funcionario SET id_cargo_nomina_encargo=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($id_cargo_nomina_encargo, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQLc, $conexion);
}


if ((isset($_POST["id_cargo_nomina_titular"])) && ($_POST["id_cargo_nomina_titular"] != "")) {
  $id_cargo_nomina_titular = $_POST["id_cargo_nomina_titular"];
  $updateSQLc = sprintf(
    "UPDATE funcionario SET id_cargo_nomina_titular=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($id_cargo_nomina_titular, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQLc, $conexion);
}


if ((isset($_POST["sexo"])) && ($_POST["sexo"] != "")) {
  $sexo = $_POST["sexo"];
  $updateSQLcs = sprintf(
    "UPDATE funcionario SET sexo=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($sexo, "text"),
    GetSQLValueString($id, "int")
  );
  $Result1s = mysql_query($updateSQLcs, $conexion);
}


if ((isset($_POST["fecha_ingreso"])) && ($_POST["fecha_ingreso"] != "")) {
  $fecha_ingreso = $_POST["fecha_ingreso"];
  $updateSQLc = sprintf(
    "UPDATE funcionario SET fecha_ingreso=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($fecha_ingreso, "date"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQLc, $conexion);
}



if ((isset($_POST["fecha_salida"])) && ($_POST["fecha_salida"] != "")) {
  $fecha_salida = $_POST["fecha_salida"];
  $updateSQLcs = sprintf(
    "UPDATE funcionario SET fecha_salida=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($fecha_salida, "date"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQLcs, $conexion);
}





if ((isset($_POST["id_autoridad_cancilleria"])) && ($_POST["id_autoridad_cancilleria"] != "")) {
  $id_autoridad_cancilleria = intval($_POST["id_autoridad_cancilleria"]);
  $updateSQL = sprintf(
    "UPDATE funcionario SET id_autoridad_cancilleria=%s  WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($id_autoridad_cancilleria, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}





if ((isset($_POST["subirfirma"])) && ($_POST["subirfirma"] != "")) {
} else {
}


if ((isset($_POST["subirfoto"])) && ($_POST["subirfoto"] != "")) {



  $tamano_archivo = 524288;   //1048576

  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
  $formato_archivo = array('jpg', 'png');


  $directoryftp = "files/";


  $ruta_archivo = 'fotoperfil-' . $id . '-' . date("YmdGis");


  if ("" != $_FILES['file']['tmp_name']) {

    $archivo = $_FILES['file']['tmp_name'];
    $tam_archivo = filesize($archivo);
    $tam_archivo2 = $_FILES['file']['size'];
    $nombrefile = strtolower($_FILES['file']['name']);
    $info = pathinfo($nombrefile);
    $extension = $info['extension'];
    $array_archivo = explode('.', $nombrefile);
    $extension2 = end($array_archivo);

    //echo $tam_archivo;
    //echo $tam_archivo2;



    if ($tamano_archivo >= intval($tam_archivo2)) {

      if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
        $files = $ruta_archivo . '.' . $extension;
        $mover_archivos = move_uploaded_file($archivo, $directoryftp . $files);
        //chmod($files,0777);
        $nombrebre_orig = ucwords($nombrefile);



        //$seguridad=md5($files.$id_ciudadano);


        $updateSQL = sprintf(
          "UPDATE funcionario SET foto_funcionario=%s where id_funcionario=%s",
          GetSQLValueString($files, "text"),
          GetSQLValueString($id, "int")
        );
        $Result = mysql_query($updateSQL, $conexion);



$emailu='sindy.padilla@supernotariado.gov.co';
$subject = 'Nueva foto';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
$cuerpo .= "Vicky de la Superintendencia de Notariado y Registro informa que se subio nueva foto.<br>";
$cuerpo .= "<br><br>";
$cuerpo .= '<a href="https://sisg.supernotariado.gov.co/usuario&'.$id.'.jsp">Ver el funcionario.</a>';
$cuerpo .= "<br><br>";
$cuerpo .= '<br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
$cabeceras .= 'Bcc: sisg1@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);



        echo $actualizado;
      } else {

        echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
      }
    } else {
      echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
    }
  } else {
    echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
  }
} else {
}



if ((isset($_POST["nombre_formacion"])) && ($_POST["nombre_formacion"] != "")) {
  $insertSQL = sprintf(
    "INSERT INTO formacion (id_funcionario, id_nivel_academico, nombre_formacion, fecha_grado, tarjeta_profesional, fecha_tarjeta, estado_formacion)
 VALUES (%s, %s, %s, %s, %s, %s, %s)",
    GetSQLValueString($id, "int"),
    GetSQLValueString($_POST["id_nivel_academico"], "int"),
    GetSQLValueString($_POST["nombre_formacion"], "text"),
    GetSQLValueString($_POST["fecha_grado"], "date"),
    GetSQLValueString($_POST["tarjeta_profesional"], "text"),
    GetSQLValueString($_POST["fecha_tarjeta"], "date"),
    GetSQLValueString(1, "int")
  );
  $Result = mysql_query($insertSQL, $conexion);
  echo $insertado;
} else {
}


if ((isset($_POST["requisitos_curaduria"])) && ($_POST["requisitos_curaduria"] != "")) {
  $insertSQL = sprintf(
    "INSERT INTO relacion_curaduria (id_funcionario, id_curaduria, 
requisitos_curaduria, tipo_relacion, estado_relacion_curaduria) 
VALUES (%s, %s, %s, %s, %s)",
    GetSQLValueString($id, "int"),
    GetSQLValueString($_POST["id_curaduria"], "int"),
    GetSQLValueString($_POST["requisitos_curaduria"], "text"),
    GetSQLValueString($_POST["tipo_relacion"], "text"),
    GetSQLValueString(1, "int")
  );
  $Result = mysql_query($insertSQL, $conexion);
  echo $insertado;
} else {
}



















if ((isset($_POST["nombre_curador_elegible"])) && ($_POST["nombre_curador_elegible"] != "")) {


  $tamano_archivo = 4194304;
  //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
  $formato_archivo = array('pdf');


  $directoryftp = "filesnr/elegibles/";


  $ruta_archivo = 'curador-elegible-' . $id . '-' . date("YmdGis");


  if ("" != $_FILES['file2']['tmp_name']) {


    $archivo = $_FILES['file2']['tmp_name'];
    $tam_archivo = filesize($archivo);
    $tam_archivo2 = $_FILES['file2']['size'];
    $nombrefile = strtolower($_FILES['file2']['name']);
    $info = pathinfo($nombrefile);
    $extension = $info['extension'];
    $array_archivo = explode('.', $nombrefile);
    $extension2 = end($array_archivo);

    //echo $tam_archivo;
    //echo $tam_archivo2;



    if ($tamano_archivo >= intval($tam_archivo2)) {

      if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
        $file2 = $ruta_archivo . '.' . $extension;
        $mover_archivos = move_uploaded_file($archivo, $directoryftp . $file2);
        //chmod($file2,0777);
        $nombrebre_orig = ucwords($nombrefile);





        $insertSQL = sprintf(
          "INSERT INTO curador_elegible (id_funcionario, id_departamento, codigo_municipio, 
nombre_curador_elegible, fecha_curador_elegible, porcentaje, documento_curador_elegible, estado_curador_elegible) 
VALUES (%s, %s, %s, %s, now(), %s, %s, %s)",
          GetSQLValueString($id, "int"),
          GetSQLValueString($_POST["id_departamento"], "int"),
          GetSQLValueString($_POST["codigo_municipio"], "int"),
          GetSQLValueString($_POST["nombre_curador_elegible"], "text"),
          GetSQLValueString($_POST["porcentaje"], "text"),
          GetSQLValueString($file2, "text"),
          GetSQLValueString(1, "int")
        );
        $Result = mysql_query($insertSQL, $conexion);
        echo $insertado;
      } else {

        echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
      }
    } else {
      echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
    }
  } else {
    echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
  }
} else {
}












if ((isset($_POST["lider_percepcion"]) && ($_POST["lider_percepcion"] != "")) && (1 == $_SESSION['rol'] or (2 == $_SESSION['snr_tipo_oficina'] and 1 == $_SESSION['snr_grupo_cargo']))) {
  $liderp = intval($_POST["lider_percepcion"]);
  $updateSQL = sprintf(
    "UPDATE funcionario SET lider_percepcion=%s WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($liderp, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}



if ((isset($_POST["id_vinculacion"]) && ($_POST["id_vinculacion"] != ""))) {
  $id_vinculacion = intval($_POST["id_vinculacion"]);
  $updateSQL = sprintf(
    "UPDATE funcionario SET id_vinculacion=%s WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($id_vinculacion, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}




if ((isset($_POST["supervisor"]) && ($_POST["supervisor"] != "")) && (1 == $_SESSION['rol'] or 0 < $nump93)) {
  $supervisor = intval($_POST["supervisor"]);
  $updateSQL = sprintf(
    "UPDATE funcionario SET supervisor=%s WHERE id_funcionario=%s and estado_funcionario=1",
    GetSQLValueString($supervisor, "int"),
    GetSQLValueString($id, "int")
  );
  $Result1 = mysql_query($updateSQL, $conexion);
}





if (1 == $_SESSION['snr_tipo_oficina']) {


  if ((isset($_POST["id_tipo_oficina"])) && ($_POST["id_tipo_oficina"] != "")) {
    $id_tipo_oficina = $_POST["id_tipo_oficina"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET id_tipo_oficina=%s, id_oficina_registro=0, id_grupo_area=301 WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString($id_tipo_oficina, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);

    $emailur2 = 'novedadesusuariosSNR@supernotariado.gov.co';
    $subject = 'Nueva novedad';
    $cuerpo2 = '';
    $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
    $cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado la novedad de cambio de oficina de un usuario en SISG, por favor revisar usuario.';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<a href="https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp">https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp</a>';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<br><br>Mensaje automático de la Superintendencia de Notariado y Registro<br>';
    $cuerpo2 .= "<br></div><br></div>";
    $cabeceras = '';
    $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
    $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
    $cabeceras .= "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($emailur2, $subject, $cuerpo2, $cabeceras);
  }









  if ((isset($_POST["fecha_nacimiento"])) && ($_POST["fecha_nacimiento"] != "")) {
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET fecha_nacimiento=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString($fecha_nacimiento, "text"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }





  if ((isset($_POST["id_oficina_registro"])) && ($_POST["id_oficina_registro"] != "")) {
    $id_oficina_registro = $_POST["id_oficina_registro"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET id_oficina_registro=%s WHERE id_funcionario=%s and id_tipo_oficina=2 and estado_funcionario=1",
      GetSQLValueString($id_oficina_registro, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);

    $emailur2 = 'novedadesusuariosSNR@supernotariado.gov.co';
    $subject = 'Nueva novedad';
    $cuerpo2 = '';
    $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
    $cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado una novedad de cambio de la oficina de registro de un usuario en SISG, por favor revisar usuario.';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<a href="https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp">https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp</a>';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<br><br>Mensaje automático de la Superintendencia de Notariado y Registro<br>';
    $cuerpo2 .= "<br></div><br></div>";
    $cabeceras = '';
    $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
    $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
    $cabeceras .= "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($emailur2, $subject, $cuerpo2, $cabeceras);
  }



  if ((isset($_POST["username_iris"])) && ($_POST["username_iris"] != "")) {
    $id_oficina_registroi = $_POST["username_iris"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET username_iris=%s WHERE id_funcionario=%s and id_tipo_oficina=1 and estado_funcionario=1",
      GetSQLValueString($id_oficina_registroi, "text"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }





  if ((isset($_POST["url_calendario"])) && ($_POST["url_calendario"] != "")) {
    $url_calendario = $_POST["url_calendario"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET url_calendario=%s WHERE id_funcionario=%s and id_tipo_oficina<3 and estado_funcionario=1",
      GetSQLValueString($url_calendario, "text"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }




  if ((isset($_POST["encargado"])) && ($_POST["encargado"] != "")) {
    $encargado = $_POST["encargado"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET encargado=%s WHERE id_funcionario=%s and id_tipo_oficina<3 and estado_funcionario=1",
      GetSQLValueString($encargado, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }


  if ((isset($_POST["guardar_pdf"])) && ($_POST["guardar_pdf"] != "")) {
    $guardar_pdf = $_POST["guardar_pdf"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET guardar_pdf=%s WHERE id_funcionario=%s and id_tipo_oficina<3 and estado_funcionario=1",
      GetSQLValueString($guardar_pdf, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }


  if ((isset($_POST["aprueba_pqrs"])) && ($_POST["aprueba_pqrs"] != "")) {
    $aprueba_pqrs = $_POST["aprueba_pqrs"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET aprueba_pqrs=%s WHERE id_funcionario=%s and lider_pqrs=1 and estado_funcionario=1",
      GetSQLValueString($aprueba_pqrs, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }



  if ((isset($_POST["remoto"])) && ($_POST["remoto"] != "")) {
    $aprueba_pqrs3 = $_POST["remoto"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET remoto=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString($aprueba_pqrs3, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }


  if ((isset($_POST["lms"])) && ($_POST["lms"] != "")) {
    $aprueba_pqrsl = $_POST["lms"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET lms=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString($aprueba_pqrsl, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }



  if ((isset($_POST["cedula_funcionario"])) && ($_POST["cedula_funcionario"] != "")) {
    $cedula_funcionario = $_POST["cedula_funcionario"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET cedula_funcionario=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString(trim($cedula_funcionario), "text"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);

    $emailur2 = 'novedadesusuariosSNR@supernotariado.gov.co';
    $subject = 'Nueva novedad';
    $cuerpo2 = '';
    $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
    $cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado una novedad de cambio de cedula de un usuario en SISG, por favor revisar usuario.';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<a href="https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp">https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp</a>';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<br><br>Mensaje automático de la Superintendencia de Notariado y Registro<br>';
    $cuerpo2 .= "<br></div><br></div>";
    $cabeceras = '';
    $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
    $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
    $cabeceras .= "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($emailur2, $subject, $cuerpo2, $cabeceras);
  }



  if (isset($_POST["alias"])) {

    if ($_POST["alias"] == "") {
      $updateSQL = sprintf(
        "UPDATE funcionario SET alias_iduca=null WHERE id_funcionario=%s and estado_funcionario=1",
        GetSQLValueString($id, "int")
      );
      $Result1 = mysql_query($updateSQL, $conexion);
    } else {

      $act = $_POST["alias"];
      $updateSQL = sprintf(
        "UPDATE funcionario SET alias_iduca=%s WHERE id_funcionario=%s and estado_funcionario=1",
        GetSQLValueString(trim($act), "text"),
        GetSQLValueString($id, "int")
      );
      $Result1 = mysql_query($updateSQL, $conexion);
    }
  }






  if ((isset($_POST["lider_pqrs"])) && ($_POST["lider_pqrs"] != "")) {
    $lider_pqrs = $_POST["lider_pqrs"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET lider_pqrs=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString($lider_pqrs, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }



  if ((isset($_POST["id_notaria"])) && ($_POST["id_notaria"] != "")) {
    $id_notaria = $_POST["id_notaria"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET id_notaria_f=%s WHERE id_funcionario=%s and id_tipo_oficina=3 and estado_funcionario=1",
      GetSQLValueString($id_notaria, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }



  if ((isset($_POST["id_grupo_area"])) && ($_POST["id_grupo_area"] != "")) {
    $id_grupo_area = $_POST["id_grupo_area"];
    $updateSQL = sprintf(
      "UPDATE funcionario SET id_grupo_area=%s WHERE id_funcionario=%s and id_tipo_oficina<3 and estado_funcionario=1",
      GetSQLValueString($id_grupo_area, "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);

    $emailur2 = 'novedadesusuariosSNR@supernotariado.gov.co';
    $subject = 'Nueva novedad';
    $cuerpo2 = '';
    $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
    $cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado una novedad de cambio de grupo de trabajo un usuario en SISG, por favor revisar usuario.';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<a href="https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp">https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp</a>';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<br><br>Mensaje automático de la Superintendencia de Notariado y Registro<br>';
    $cuerpo2 .= "<br></div><br></div>";
    $cabeceras = '';
    $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
    $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
    $cabeceras .= "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($emailur2, $subject, $cuerpo2, $cabeceras);
  }



  if ((isset($_POST["id_rol"])) && ($_POST["id_rol"] != "") and (1 == $_SESSION['rol'] or 0 < $nump8)) {
    $id_rol = intval($_POST["id_rol"]);
    if (6 == $id_rol or 5 == $id_rol) {
      if (isset($_POST["idenca"]) && "" != $_POST["idenca"]) {
        $causer = $_POST["idenca"];
      } else {
        $causer = 'xxxxxxxx';
      }
      $updateSQL = sprintf(
        "UPDATE funcionario SET id_rol=6, id_oficina_registro=0, id_cargo=8, id_cargo_nomina_encargo=44, id_vinculacion=6, 
alias_iduca=null, id_grupo_area=301 WHERE id_funcionario=%s and estado_funcionario=1",
        GetSQLValueString($id, "int")
      );

      $emailur2 = 'novedadesusuariosSNR@supernotariado.gov.co';
      $subject = 'Solicitud de inactivación de usuario';
      $cuerpo2 = '';
      $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
      $cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado una inactivación de un usuario en SISG, por favor revisar usuario.';
      $cuerpo2 .= "<br><br>";
      $cuerpo2 .= 'Tipo de usuario: Funcionario / <a href="https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp">https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp</a>';
      $cuerpo2 .= "<br><br>";
      $cuerpo2 .= "<br><br>";
      $cuerpo2 .= '<br><br>Mensaje automático de la Superintendencia de Notariado y Registro<br>';
      $cuerpo2 .= "<br></div><br></div>";
      $cabeceras = '';
      $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
      $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
      $cabeceras .= "MIME-Version: 1.0\r\n";
      $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
      mail($emailur2, $subject, $cuerpo2, $cabeceras);



      $curl44 = curl_init();
      curl_setopt_array($curl44, array(
        CURLOPT_URL => 'https://192.168.40.15:8443/bloquearusuarioSNR',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
"userID": "' . $causer . '",
"Estado": "I"
}',
        CURLOPT_HTTPHEADER => array(
          'Authorization: Basic aWdhYXBpOlNucjIwMjMq',
          'Content-Type: application/json'
        ),
      ));

      /*
$response = curl_exec($curl44);
curl_close($curl44);
echo $response;
*/


      $response44 = curl_exec($curl44);
      curl_close($curl44);
      //$character44=json_decode($response44);
      //echo $character44;


    } else {

      $updateSQL = sprintf(
        "UPDATE funcionario SET id_rol=%s WHERE id_funcionario=%s and estado_funcionario=1",
        GetSQLValueString($id_rol, "int"),
        GetSQLValueString($id, "int")
      );
    }

    $Result1 = mysql_query($updateSQL, $conexion);
  }




  if ((isset($_POST["correo_funcionario"])) && ($_POST["correo_funcionario"] != "")) {
    $updateSQL = sprintf(
      "UPDATE funcionario SET correo_funcionario=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString(trim($_POST["correo_funcionario"]), "text"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);




    $emailur2 = 'soportetecnico@supernotariado.gov.co';
    $subject = 'Solicitud de creación de usuario y clave en SISG';
    $cuerpo2 = '';
    $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
    $cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado una actualización del correo electrónico institucional, por favor revisar usuario. Si no presenta credenciales de SISG y se encuentra activo, por favor asignar usuario y clave de SISG. Luego enviar las credenciales al correo institucional del servidor público.';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= 'Usuario: <a href="https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp">https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp</a>';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= "Correo: " . trim($_POST["correo_funcionario"]);
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<br><br>Mensaje automático de la Superintendencia de Notariado y Registro<br>';
    $cuerpo2 .= "<br></div><br></div>";
    $cabeceras = '';
    $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
    $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
    $cabeceras .= "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($emailur2, $subject, $cuerpo2, $cabeceras);
  }



  if ((isset($_POST["correo_personal"])) && ($_POST["correo_personal"] != "")) {
    $updateSQL = sprintf(
      "UPDATE funcionario SET correo_personal=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString(trim($_POST["correo_personal"]), "text"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }




  if ((isset($_POST["codigo_app"])) && ($_POST["codigo_app"] != "")) {

    $updateSQL = sprintf(
      "UPDATE funcionario SET codigo_app=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString($_POST["codigo_app"], "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }



  if ((isset($_POST["nombre_funcionario"])) && ($_POST["nombre_funcionario"] != "")) {

    $updateSQL = sprintf(
      "UPDATE funcionario SET nombre_funcionario=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString($_POST["nombre_funcionario"], "text"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);
  }




  if ((isset($_POST["id_cargo"])) && ($_POST["id_cargo"] != "")) {

    $updateSQL = sprintf(
      "UPDATE funcionario SET id_cargo=%s WHERE id_funcionario=%s and estado_funcionario=1",
      GetSQLValueString($_POST["id_cargo"], "int"),
      GetSQLValueString($id, "int")
    );
    $Result1 = mysql_query($updateSQL, $conexion);

    $emailur2 = 'novedadesusuariosSNR@supernotariado.gov.co';
    $subject = 'Nueva novedad';
    $cuerpo2 = '';
    $cuerpo2 .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/vista/img/snr-chat.jpg'>";
    $cuerpo2 .= 'La Superintendencia de Notariado y Registro informa que se ha registrado una novedad de cambio de cargo de un usuario en SISG, por favor revisar usuario.';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<a href="https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp">https://sisg.supernotariado.gov.co/usuario&' . $id . '.jsp</a>';
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= "<br><br>";
    $cuerpo2 .= '<br><br>Mensaje automático de la Superintendencia de Notariado y Registro<br>';
    $cuerpo2 .= "<br></div><br></div>";
    $cabeceras = '';
    $cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
    $cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
    $cabeceras .= "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($emailur2, $subject, $cuerpo2, $cabeceras);
  }




  if ((isset($_POST["id_perfil"])) && ($_POST["id_perfil"] != "")) {
    $insertSQL = sprintf(
      "INSERT INTO funcionario_perfil (id_funcionario, id_perfil, estado_funcionario_perfil) VALUES (%s, %s, %s)",
      GetSQLValueString($id, "int"),
      GetSQLValueString($_POST["id_perfil"], "int"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);
    echo $insertado;
  } else {
  }



  if ((isset($_POST["id_punto_ubicacion"])) && ($_POST["id_punto_ubicacion"] != "")) {
    $insertSQL = sprintf(
      "INSERT INTO punto_ubicacion_enlace 
(id_funcionario, id_punto_ubicacion, estado_punto_ubicacion_enlace) VALUES (%s, %s, %s)",
      GetSQLValueString($id, "int"),
      GetSQLValueString($_POST["id_punto_ubicacion"], "int"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);
    echo $insertado;
  } else {
  }




  if ((isset($_POST["id_aplicacion"])) && ($_POST["id_aplicacion"] != "")) {
    $insertSQL = sprintf(
      "INSERT INTO funcionario_aplicacion 
(id_funcionario, id_aplicacion, estado_funcionario_aplicacion) VALUES (%s, %s, %s)",
      GetSQLValueString($id, "int"),
      GetSQLValueString($_POST["id_aplicacion"], "int"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);
    echo $insertado;
  } else {
  }





  if ((isset($_POST["table"])) && ($_POST["table"] == "soporte_funcionario")) {

    //$tamano_archivo=11534336;
    $tamano_archivo = 5767168;

    //$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
    $formato_archivo = array('pdf');


    $directoryftp = "filesnr/documentos/";


    $ruta_archivo = 'documento-' . $id . '-' . date("YmdGis");


    if ("" != $_FILES['file']['tmp_name']) {

      $archivo = $_FILES['file']['tmp_name'];
      $tam_archivo = filesize($archivo);
      $tam_archivo2 = $_FILES['file']['size'];
      $nombrefile = strtolower($_FILES['file']['name']);
      $info = pathinfo($nombrefile);
      $extension = $info['extension'];
      $array_archivo = explode('.', $nombrefile);
      $extension2 = end($array_archivo);

      //echo $tam_archivo;
      //echo $tam_archivo2;



      if ($tamano_archivo >= intval($tam_archivo2)) {

        if (($extension2 == $extension) and in_array($extension, $formato_archivo)) {
          $files2 = $ruta_archivo . '.' . $extension;
          $mover_archivos = move_uploaded_file($archivo, $directoryftp . $files2);
          //chmod($files,0777);
          $nombrebre_orig = ucwords($nombrefile);



          $seguridad = md5($files2 . $id_ciudadano);


          $insertSQL = sprintf(
            "INSERT INTO documento_funcionario (nombre_documento_funcionario, id_tipo_adjunto, 
id_tipo_subadjunto, id_funcionario, url_documento, hash_documento, fecha_inicial, 
fecha_documento, estado_documento_funcionario) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
            GetSQLValueString($_POST["nombre_documento_funcionario"], "text"),
            GetSQLValueString($_POST["id_tipo_adjunto"], "int"),
            GetSQLValueString($_POST["id_tipo_subadjunto"], "int"),
            GetSQLValueString($id, "int"),
            GetSQLValueString($files2, "text"),
            GetSQLValueString($seguridad, "text"),
            GetSQLValueString($_POST["fecha_inicial"], "date"),
            GetSQLValueString($_POST["fecha_documento"], "date"),
            GetSQLValueString(1, "int")
          );
          $Result = mysql_query($insertSQL, $conexion);
          echo $insertado;
        } else {

          echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido.</div>';
        }
      } else {
        echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
      }
    } else {
      echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 2 Megas permitidos.</div>';
    }
  } else {
  }



  if (
    (isset($_POST["guardarNuevoContrato"])) && ($_POST["guardarNuevoContrato"] != "") &&
    (isset($_POST["cod_datos_contrato"])) && ($_POST["cod_datos_contrato"] != "") &&
    (isset($_POST["ano_datos_contrato"])) && ($_POST["ano_datos_contrato"] != "") &&
    (isset($_POST["id_nc_salario"])) && ($_POST["id_nc_salario"] != "") &&
    (isset($_POST["id_funcionario_supervisor"])) && ($_POST["id_funcionario_supervisor"] != "") &&
    (isset($_POST["fecha_acta_inicio"])) && ($_POST["fecha_acta_inicio"] != "") &&
    (isset($_POST["fecha_terminacion"])) && ($_POST["fecha_terminacion"] != "")
  ) {
    $codContrato = $_POST["cod_datos_contrato"];
    $AnoContrato = $_POST["ano_datos_contrato"];
    $query4 = sprintf("SELECT count(id_nc_contratos) AS contrato FROM nc_contratos where cod_datos_contrato='$codContrato' AND ano_datos_contrato=$AnoContrato AND estado_nc_contratos=1");
    $result4 = $mysqli->query($query4);
    $row4 = $result4->fetch_array(MYSQLI_ASSOC);
    $row4['contrato'];
    if (0 < $row4['contrato']) {
      echo '<script type="text/javascript">swal(" ADVERTENCIA !", " Numero de contrato ' . $codContrato . '-' . $AnoContrato . ' Ya existente. !", "warning");</script>';
    } else {
      $insertSQL = sprintf(
        "INSERT INTO nc_contratos (cod_datos_contrato, ano_datos_contrato, id_nc_salario, id_funcionario, id_funcionario_supervisor, fecha_acta_inicio, fecha_terminacion, fecha_creado) 
	      VALUES (%s,%s,%s,%s,%s,%s,%s,now())",
        GetSQLValueString($_POST["cod_datos_contrato"], "text"),
        GetSQLValueString($_POST["ano_datos_contrato"], "int"),
        GetSQLValueString($_POST["id_nc_salario"], "int"),
        GetSQLValueString($id, "int"),
        GetSQLValueString($_POST["id_funcionario_supervisor"], "int"),
        GetSQLValueString($_POST["fecha_acta_inicio"], "date"),
        GetSQLValueString($_POST["fecha_terminacion"], "date")
      );
      $Result = mysql_query($insertSQL, $conexion);
      echo $insertado;
    }
  }
}

$query = sprintf("SELECT * FROM funcionario where id_funcionario=" . $id . " limit 1");
$select = mysql_query($query, $conexion);
$row_update = mysql_fetch_assoc($select);



if (1 == $_SESSION['rol'] or 0 < $nump12 or $id == $_SESSION['snr']) { ?>

  <div class="modal fade" id="popupnewdocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel">Soportes Documentales: <span class="licenciac" style="font-weight: bold;"></span></h4>
        </div>
        <div id="nuevaAventura" class="modal-body">
          <form action="" method="POST" name="formasdf3245fhgdh345122" enctype="multipart/form-data">

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Categoria:</label>
              <select class="form-control mayuscula" name="id_tipo_adjunto" id="id_categoria_soporte" required>
                <option value="" selected></option>
                <?php echo lista('tipo_adjunto');  ?>
              </select>
            </div>
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Documento:</label>
              <select class="form-control mayuscula" name="id_tipo_subadjunto" id="id_tipo_soporte" required>
              </select>
            </div>



            <div class="form-group text-left">
              <label class="control-label"> Fecha inicial de periodos (Para contratos, trabajos, etc.):</label>
              <input type="text" class="form-control datepickera" name="fecha_inicial" required>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> Fecha del documento o finalización del periodo señalado:</label>
              <input type="text" class="form-control datepickera" name="fecha_documento" required>
            </div>


            <div class="form-group text-left">
              <input type="file" name="file" required>
              <span style="color:#aaa;font-size:13px;">Documento PDF inferior a 5Mb</span>
            </div>

            <div class="form-group text-left">
              <label class="control-label">Observaciones:</label>
              <textarea class="form-control" name="nombre_documento_funcionario" style="height:120px;"></textarea>
            </div>


            <input type="hidden" name="table" value="soporte_funcionario">

            <div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                <span class="glyphicon glyphicon-remove"></span> Cancelar</button><button type="submit" class="btn btn-success">
                <input type="hidden" name="insert" value=""><span class="glyphicon glyphicon-ok"></span> Agregar </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } else {
} ?>







<?php if (1 == $_SESSION['rol'] or 0 < $nump14) { ?>
  <div class="modal fade" id="popupnewformacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel">Formación:</h4>
        </div>
        <div id="nuevaAventura" class="modal-body">
          <form action="" method="POST" name="forrewtergertm1">

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NIVEL DE ACADÉMICO:</label>
              <select class="form-control" name="id_nivel_academico">
                <option selected></option>
                <?php
                $query = sprintf("SELECT * FROM nivel_academico where estado_nivel_academico=1 order by id_nivel_academico");

                $select = mysql_query($query, $conexion);

                $row = mysql_fetch_assoc($select);

                $totalRows = mysql_num_rows($select);

                if (0 < $totalRows) {

                  do {

                    echo '<option value="' . $row['id_nivel_academico'] . '">' . $row['nombre_nivel_academico'] . '</option>';
                  } while ($row = mysql_fetch_assoc($select));
                } else {
                }

                mysql_free_result($select);

                ?>
              </select>
            </div>
            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL ESTUDIO / PROFESIÓN:</label>
              <input type="text" class="form-control" name="nombre_formacion">
            </div>
            <div class="form-group text-left">
              <label class="control-label"> FECHA DE GRADO:</label>
              <input type="text" class="form-control datepickera" name="fecha_grado" readonly="readonly">
            </div>
            <div class="form-group text-left">
              <label class="control-label">TARJETA DE PROFESIONAL:</label>
              <input type="text" class="form-control" name="tarjeta_profesional">
            </div>
            <div class="form-group text-left">
              <label class="control-label">FECHA DE TARJETA PROFESIONAL:</label>
              <input type="text" readonly="readonly" class="form-control datepickera" name="fecha_tarjeta">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-ok"></span> Crear </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } else {
} ?>













<?php if (1 == $_SESSION['rol'] or 0 < $nump3) { ?>
  <div class="modal fade" id="popupnewrcuraduria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel">Relación con Curaduria:</h4>
        </div>
        <div id="nuevaAventura" class="modal-body">
          <form action="" method="POST" name="forre34324wtergertm1">

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CURADURIA:</label>
              <select class="form-control" name="id_curaduria" required>
                <option selected></option>
                <?php echo lista('curaduria'); ?>
              </select>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE RELACIÓN:</label>
              <select class="form-control" name="tipo_relacion">
                <option selected></option>
                <option>CURADOR</option>
                <option>GRUPO INTERDISCIPLINARIO</option>
                <option>PERSONAL DE APOYO</option>
              </select>
            </div>



            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CUMPLE REQUISITOS COMO CURADOR:</label>
              <select class="form-control" name="requisitos_curaduria">
                <option selected></option>
                <option>Si</option>
                <option>No</option>
              </select>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-ok"></span> Crear </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>











  <div class="modal fade" id="popupelegible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel">Relacionar con lista de elegibles:</h4>
        </div>
        <div id="nuevaAventura" class="modal-body">
          <form action="" method="POST" name="forweqewqemasdf3245fhgdh345122" enctype="multipart/form-data">



            <div class="form-group text-left ubicacion">
              <label class="control-label"><span style="color:#ff0000;">*</span>DEPARTAMENTO:</label>
              <select class="form-control" name="id_departamento" id="id_departamento" required>
                <option value="" selected></option>
                <?php echo lista('departamento');  ?>
              </select>
            </div>
            <div class="form-group text-left ubicacion">
              <label class="control-label"><span style="color:#ff0000;">*</span>MUNICIPIO:</label>
              <select class="form-control" name="codigo_municipio" id="id_municipio" required>
              </select>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> CONVOCATORIA:</label>
              <input type="text" class="form-control" name="nombre_curador_elegible" required>
            </div>

            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> FECHA DE PUBLICACIÓN:</label>
              <input type="text" class="form-control datepicker" name="fecha_publicacion" required>
            </div>>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> PORCENTAJE %:</label>
              <input type="text" class="form-control numerodecimal" name="porcentaje" required>
            </div>


            <div class="form-group text-left">
              <label class="control-label"><span style="color:#ff0000;">*</span> SOPORTE DOCUMENTAL:</label>
              <input type="file" name="file2" required>
            </div>



            <div class="modal-footer">
              <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-ok"></span> Crear </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


<?php } else {
} ?>







<div class="row">
  <div class="col-md-8">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><b>Perfil</b></h3>

        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">








        <!-- /.box-header -->
        <div class="box-body">

          <div class="table-responsive">


            <div class="modal-body">


              <div class="form-group text-left">
                <label class="control-label">CEDULA:</label>
                <?php $cedula = $row_update['cedula_funcionario'];
                echo $cedula;
                if (1 == $_SESSION['rol'] or 0 < $nump8) { ?>
                  <form class="navbar-form" name="form145354326435436" method="post" action="">
                    <input type="hidden" id="idModal" value="4703">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="text" class="form-control numero" style="width:300px;" name="cedula_funcionario" value="<?php echo $row_update['cedula_funcionario'];  ?>" required>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>



  <?php 

                if ((1 == $_SESSION['rol'] or 0 < $nump8) or ($id == $_SESSION['snr'] && (!isset($row_update['fecha_exp_cedula'])))) {
                ?>
				

              <div class="form-group text-left">
                <label class="control-label">FECHA DE EXPEDICIÓN DE CEDULA:</label>
  <?php            
$expcedula = $row_update['fecha_exp_cedula'];
                echo $expcedula;

?>

                  <form class="navbar-form" name="form145354324353456435436" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="text" class="form-control datepickera" style="width:300px;" name="fecha_exp_cedula" value="<?php echo $row_update['fecha_exp_cedula'];  ?>" required>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
              
              </div>
  <?php } else {
                } ?>





              <div class="form-group text-left">
                <label class="control-label">NOMBRE:</label>
                <?php echo $row_update['nombre_funcionario'];

                if (2 >= $_SESSION['rol'] or 0 < $nump17) { ?>

                  <form class="navbar-form" name="form1456435436" method="post" action="">

                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="text" class="form-control" style="width:300px;" name="nombre_funcionario" value="<?php echo $row_update['nombre_funcionario'];  ?>" required>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>

                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>



              <div class="form-group text-left">
                <label class="control-label">SEXO:</label>
                <?php

                if ('F' == $row_update['sexo']) {
                  echo 'Femenino';
                } else if ('M' == $row_update['sexo']) {
                  echo 'Masculino';
                } else {
                }

                if (2 >= $_SESSION['rol'] or 0 < $nump8) { ?>

                  <form class="navbar-form" name="form1456435436" method="post" action="">

                    <div class="input-group">
                      <div class="input-group-btn">
                        <select name="sexo" class="form-control">
                          <option value=""></option>
                          <option value="F" <?php if ('F' == $row_update['sexo']) {
                                              echo 'selected';
                                            } else {
                                            } ?>>Femenino</option>
                          <option value="M" <?php if ('M' == $row_update['sexo']) {
                                              echo 'selected';
                                            } else {
                                            } ?>>Masculino</option>
                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>



              <?php if ((1 == $_SESSION['rol']  or 0 < $nump8) or ($id == $_SESSION['snr'] && 3 > $row_update['id_tipo_oficina'])) { ?>
                <div class="form-group text-left">
                  <label class="control-label">RH:</label>
                  <?php echo $row_update['rh'];
                  ?>

                  <?php
                  if ((1 == $_SESSION['rol'] or 0 < $nump8) or ($id == $_SESSION['snr'] && (!isset($row_update['rh'])))) {
                  ?>
                    <form class="navbar-form" name="form134544543556435436" method="post" action="">
                      <div class="input-group">
                        <div class="input-group-btn">
                          <input type="text" class="form-control" style="width:300px;" name="rh" value="<?php echo $row_update['rh'];  ?>" class="form-control" required>
                        </div>
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                        </div>
                      </div>
                    </form>
                  <?php } else {
                  } ?>
                </div>
              <?php } else {
              } ?>



              <?php if ((1 == $_SESSION['rol'] or 0 < $nump8 or $id == $_SESSION['snr']) && 3 > $row_update['id_tipo_oficina']) { ?>
                <div class="form-group text-left">
                  <label class="control-label">NÚMERO CELULAR: (Solo es visible por talento humano)</label>
                  <?php echo $row_update['celular_funcionario'];

                  if (1 == $_SESSION['rol'] or 0 < $nump8 or $id == $_SESSION['snr']) { ?>
                    <form class="navbar-form" name="for342325435m145436536534564TU36" method="post" action="">
                      <div class="input-group">
                        <div class="input-group-btn">
                          <input type="text" class="form-control numero" style="width:100%;" name="celular_funcionario" value="<?php echo $row_update['celular_funcionario'];  ?>" required>
                        </div>
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                        </div>
                      </div>
                    </form>
                  <?php } else {
                  } ?>
                </div>
              <?php } else {
              } ?>



              <div class="form-group text-left">
                <label class="control-label">CORREO INSTITUCIONAL:</label>
                <?php echo $row_update['correo_funcionario']; ?>

                <?php if (2 >= $_SESSION['rol'] or 0 < $nump15) { ?>
                  <form class="navbar-form" name="dfgdg56765740036" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="email" class="form-control" style="width:300px;" name="correo_funcionario" value="<?php echo $row_update['correo_funcionario'];  ?>" class="form-control" required>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>


              <?php if (2 >= $_SESSION['rol'] or 0 < $nump15) { ?>
                <div class="form-group text-left">
                  <label class="control-label">CORREO PERSONAL:</label>
                  <?php echo $row_update['correo_personal']; ?>


                  <form class="navbar-form" name="dfgdg5676343245740036" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="email" class="form-control" style="width:300px;" name="correo_personal" value="<?php echo $row_update['correo_personal'];  ?>" class="form-control" required>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>

                </div>
              <?php } else {
              } ?>




              <?php if (1 == $_SESSION['rol'] or 0 < $nump13 or 0 < $nump8) { ?>
                <div class="form-group text-left">
                  <label class="control-label">FECHA DE NACIMIENTO:</label>
                  <?php if (isset($row_update['fecha_nacimiento'])) {
                    echo $row_update['fecha_nacimiento'] . ' / ';
                    $edadc = calculaedad($row_update['fecha_nacimiento']);
                    echo $edadc . ' años';

                    if (70 < $edadc and 1 == $_SESSION['snr_tipo_oficina']) {
                      echo ' <b style="color:#ff0000">Supera los 70 años</b>';
                    } else {
                    }
                  } else {
                  }
                  ?>
                  <form class="navbar-form" name="dfgdg54356466765740036" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="text" readonly="readonly" class="form-control datepickera" style="width:300px;" name="fecha_nacimiento" value="<?php echo $row_update['fecha_nacimiento'];  ?>" required>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                </div>

              <?php } else {
              } ?>

              <?php if (1 == $_SESSION['rol'] or 0 < $nump20) { ?>
                <div class="form-group text-left">
                  <label class="control-label">ALIAS CA:</label>
                  <?php echo $row_update['alias_iduca']; ?>


                  <?php if ((1 == $_SESSION['rol'] or 0 < $nump20)) { ?>
                    <form class="navbar-form" name="form1456436" method="post" action="">
                      <div class="input-group">
                        <div class="input-group-btn">
                          <input type="text" class="form-control" name="alias" value="<?php echo $row_update['alias_iduca'];  ?>">
                        </div>
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                        </div>
                      </div>
                      <a href="https://accesos.supernotariado.gov.co/iam/im/snr/ui7/index.jsp" target="_blank">Accesos CA</a>
                    </form>
                  <?php } else {
                  } ?>
                </div>
              <?php } else {
              } ?>




              <div class="form-group text-left">
                <label class="control-label">Extensión en SNR (+576013282121#):</label>
                <?php echo $row_update['telefono_funcionario'];
                if (1 == $_SESSION['rol']  or 0 < $nump8) { ?>
                  <form class="navbar-form" name="for345435m145436536534564TU36" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="text" class="form-control" style="width:100%;" name="telefono_funcionario" value="<?php echo $row_update['telefono_funcionario'];  ?>" required>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>






              <div class="form-group text-left">
                <label class="control-label">DIRECCIÓN:</label>
                <?php echo $row_update['direccion_funcionario'];
                if (1 == $_SESSION['rol']) { ?>
                  <form class="navbar-form" name="for2323345345m14543653653456436" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="text" class="form-control" style="width:100%;" name="direccion_funcionario" value="<?php echo $row_update['direccion_funcionario'];  ?>" required>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>




              <div class="form-group text-left">
                <label class="control-label">ROL:</label>
                <?php echo quees('rol', $row_update['id_rol']); ?>

                <?php if (1 == $_SESSION['rol'] or 0 < $nump8) { ?>
                  <form class="navbar-form" name="fo3432r54435m14567657436" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="hidden" name="idenca" VALUE="<?php echo $row_update['alias_iduca']; ?>">
                        <select name="id_rol" class="form-control" required>
                          <?php
                          if (1 == $_SESSION['rol']) {
                            $varrol = "";
                          } else {
                            $varrol = " and id_rol>2 ";
                          }

                          $query = sprintf("SELECT id_rol, nombre_rol FROM rol where estado_rol=1 " . $varrol . " order by id_rol");
                          $select = mysql_query($query, $conexion);
                          $row = mysql_fetch_assoc($select);
                          $totalRows = mysql_num_rows($select);
                          if (0 < $totalRows) {
                            do {
                              echo '<option value="' . $row['id_rol'] . '"  ';

                              if ($row_update['id_rol'] == $row['id_rol']) {
                                echo 'selected';
                              } else {
                              }

                              echo '>' . $row['nombre_rol'] . '</option>';
                            } while ($row = mysql_fetch_assoc($select));
                          } else {
                          }
                          mysql_free_result($select);
                          ?>

                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>




              <div class="form-group text-left">
                <label class="control-label">PERFIL:</label>
                <?php echo quees('cargo', $row_update['id_cargo']);
                $id_perfil = $row_update['id_cargo']; ?>
                <?php if (1 == $_SESSION['rol'] or 0 < $nump8) { ?>
                  <form class="navbar-form" name="for5443fdg5m1456fyu436" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <select name="id_cargo" class="form-control" required>
                          <?php
                          $query = sprintf("SELECT * FROM cargo where estado_cargo=1 order by id_cargo");
                          $select = mysql_query($query, $conexion);
                          $row = mysql_fetch_assoc($select);
                          $totalRows = mysql_num_rows($select);
                          if (0 < $totalRows) {
                            do {
                              echo '<option value="' . $row['id_cargo'] . '"  ';

                              if ($row_update['id_cargo'] == $row['id_cargo']) {
                                echo 'selected';
                              } else {
                              }

                              echo '>' . $row['nombre_cargo'] . '</option>';
                            } while ($row = mysql_fetch_assoc($select));
                          } else {
                          }
                          mysql_free_result($select);
                          ?>

                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>




              <div class="form-group text-left">
                <label class="control-label">VINCULACIÓN:</label>
                <?php echo quees('vinculacion', $row_update['id_vinculacion']);

                if (2 >= $_SESSION['rol'] or 0 < $nump93) { ?>
                  <form class="navbar-form" name="for54434334545m13243244567657436" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <select name="id_vinculacion" class="form-control" required>
                          <?php
                          $query = sprintf("SELECT id_vinculacion, nombre_vinculacion FROM vinculacion where estado_vinculacion=1 order by id_vinculacion");
                          $select = mysql_query($query, $conexion);
                          $row = mysql_fetch_assoc($select);
                          $totalRows = mysql_num_rows($select);
                          if (0 < $totalRows) {
                            do {
                              echo '<option value="' . $row['id_vinculacion'] . '"  ';

                              if ($row_update['id_vinculacion'] == $row['id_vinculacion']) {
                                echo 'selected';
                              } else {
                              }

                              echo '>' . $row['nombre_vinculacion'] . '</option>';
                            } while ($row = mysql_fetch_assoc($select));
                          } else {
                          }
                          mysql_free_result($select);
                          ?>

                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>






              <div class="form-group text-left">
                <label class="control-label">CARGO:</label>
                <?php

                function cargonom($valor)
                {
                  global $mysqli;
                  $querynn = "SELECT * from cargo_nomina where id_cargo_nomina=" . $valor . " limit 1";
                  $resultnn = $mysqli->query($querynn);
                  $rownn = $resultnn->fetch_array();
                  return '' . $rownn['nombre_cargo_nomina'] . ' / ' . $rownn['cod_cargo_nomina'] . ' / ' . $rownn['grado_cargo_nomina'] . '';
                  $resultnn->free();
                }


                echo cargonom($row_update['id_cargo_nomina_encargo']);

                if (2 >= $_SESSION['rol'] or 0 < $nump93) { ?>
                  <form class="navbar-form" name="for544325435434334545m13243244567657436" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <select name="id_cargo_nomina_encargo" class="form-control" required>
                          <?php
                          $query = sprintf("SELECT * FROM cargo_nomina where estado_cargo_nomina=1 order by id_cargo_nomina");
                          $select = mysql_query($query, $conexion);
                          $row = mysql_fetch_assoc($select);
                          $totalRows = mysql_num_rows($select);
                          if (0 < $totalRows) {
                            do {
                              echo '<option value="' . $row['id_cargo_nomina'] . '"  ';

                              if ($row_update['id_cargo_nomina_encargo'] == $row['id_cargo_nomina']) {
                                echo 'selected';
                              } else {
                              }

                              echo '>' . $row['nombre_cargo_nomina'] . ' / ' . $row['cod_cargo_nomina'] . ' / ' . $row['grado_cargo_nomina'] . '</option>';
                            } while ($row = mysql_fetch_assoc($select));
                          } else {
                          }
                          mysql_free_result($select);
                          ?>

                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>






              <div class="form-group text-left">
                <label class="control-label">FECHA DE INGRESO:</label>
                <?php if (isset($row_update['fecha_ingreso']) and "" != $row_update['fecha_ingreso'] and "0000-00-00" != $row_update['fecha_ingreso']) {
                  echo $row_update['fecha_ingreso'];
                  //echo calculaedad($row['fecha_nacimiento']);
                  //tiempo_transcurrido
                  echo ' / Años: ' . calculaedad($row_update['fecha_ingreso']);
                } else {
                }
                ?>
                <?php if (1 == $_SESSION['rol'] or 0 < $nump8) { ?>
                  <form class="navbar-form" name="for4332434554432456fyu436" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="text" name="fecha_ingreso" class="form-control datepickera" value="<?php echo $row_update['fecha_ingreso']; ?>" required>
                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>
			  
			  
			  
			  
			   <div class="form-group text-left">
                <label class="control-label">FECHA DE RETIRO:</label>
                <?php if (isset($row_update['fecha_salida']) and "" != $row_update['fecha_salida'] and "0000-00-00" != $row_update['fecha_salida']) {
                  echo $row_update['fecha_salida'];
      
                  echo ' / Años: ' . calculaedad($row_update['fecha_salida']);
                } else {
                }
                ?>
                <?php if (1 == $_SESSION['rol'] or 0 < $nump8) { ?>
                  <form class="navbar-form" name="for43324453455654654432456fyu436" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <input type="text" name="fecha_salida" class="form-control datepickera" value="<?php echo $row_update['fecha_salida']; ?>" required>
                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>
			  
			  
			  
			  
			  


              <?php if (3 > $row_update['id_tipo_oficina']) { ?>









                <div class="form-group text-left">
                  <label class="control-label">ESTADO CIVIL:</label>
                  <?php echo quees('estado_civil', $row_update['id_estado_civil']); ?>
                  <?php if (1 == $_SESSION['rol'] or 0 < $nump8) { ?>
                    <form class="navbar-form" name="for4345544324545324334324fdg5m1456fyu436" method="post" action="">
                      <div class="input-group">
                        <div class="input-group-btn">
                          <select name="id_estado_civil" class="form-control" required>
                            <?php
                            $query = sprintf("SELECT * FROM estado_civil where estado_estado_civil=1 order by id_estado_civil");
                            $select = mysql_query($query, $conexion);
                            $row = mysql_fetch_assoc($select);
                            $totalRows = mysql_num_rows($select);
                            if (0 < $totalRows) {
                              do {
                                echo '<option value="' . $row['id_estado_civil'] . '"  ';

                                if ($row_update['id_estado_civil'] == $row['id_estado_civil']) {
                                  echo 'selected';
                                } else {
                                }

                                echo '>' . $row['nombre_estado_civil'] . '</option>';
                              } while ($row = mysql_fetch_assoc($select));
                            } else {
                            }
                            mysql_free_result($select);
                            ?>

                          </select>
                        </div>
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                        </div>
                      </div>
                    </form>
                  <?php } else {
                  } ?>
                </div>





                <div class="form-group text-left">
                  <label class="control-label">NÚMERO DE HIJOS:</label>
                  <?php if (isset($row_update['numero_hijos'])) {
                    echo $row_update['numero_hijos'];
                  } else {
                  }
                  ?>
                  <?php if (1 == $_SESSION['rol'] or 0 < $nump8) { ?>
                    <form class="navbar-form" name="for4332432344554432456fyu436" method="post" action="">
                      <div class="input-group">
                        <div class="input-group-btn">
                          <input type="text" name="numero_hijos" class="form-control numero" value="<?php echo $row_update['numero_hijos']; ?>" required>
                          </select>
                        </div>
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                        </div>
                      </div>
                    </form>
                  <?php } else {
                  } ?>
                </div>




                <div class="form-group text-left">
                  <label class="control-label">NIVEL EDUCATIVO ACTUAL:</label>
                  <?php echo quees('nivel_academico', $row_update['id_nivel_academico']); ?>
                  <?php if (1 == $_SESSION['rol'] or 0 < $nump8) { ?>
                    <form class="navbar-form" name="for43452342435443245453243fdg5m1456fyu436" method="post" action="">
                      <div class="input-group">
                        <div class="input-group-btn">
                          <select name="id_nivel_academico" class="form-control" required>
                            <?php
                            $query = sprintf("SELECT * FROM nivel_academico where estado_nivel_academico=1 order by id_nivel_academico");
                            $select = mysql_query($query, $conexion);
                            $row = mysql_fetch_assoc($select);
                            $totalRows = mysql_num_rows($select);
                            if (0 < $totalRows) {
                              do {
                                echo '<option value="' . $row['id_nivel_academico'] . '"  ';

                                if ($row_update['id_nivel_academico'] == $row['id_nivel_academico']) {
                                  echo 'selected';
                                } else {
                                }

                                echo '>' . $row['nombre_nivel_academico'] . '</option>';
                              } while ($row = mysql_fetch_assoc($select));
                            } else {
                            }
                            mysql_free_result($select);
                            ?>

                          </select>
                        </div>
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                        </div>
                      </div>
                    </form>
                  <?php } else {
                  } ?>
                </div>






                <?php
                if (3 > $row_update['id_tipo_oficina']) {
                ?>
                  <div class="form-group text-left">
                    <label class="control-label">SUPERVISOR:</label>
                    <?php
                    if (1 == $row_update['supervisor']) {
                      echo 'Si';
                    } else {
                      echo 'No';
                    }
                    ?>
                    <?php if (1 == $_SESSION['rol'] or (0 < $nump32)) { ?>
                      <form class="navbar-form" name="form145644435435345634325rg5634536" method="post" action="">
                        <div class="input-group">
                          <div class="input-group-btn">
                            <select name="supervisor" class="form-control" required>
                              <option value="0" <?php if (0 == $row_update['supervisor']) {
                                                  echo 'selected';
                                                } else {
                                                  echo '';
                                                }  ?>>No</option>
                              <option value="1" <?php if (1 == $row_update['supervisor']) {
                                                  echo 'selected';
                                                } else {
                                                  echo '';
                                                }  ?>>Si</option>
                            </select>
                          </div>
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </div>
                        </div>
                      </form>
                    <?php } else {
                    } ?>
                  </div>





                  <div class="form-group text-left">
                    <label class="control-label">AFORADO SINDICAL:</label>
                    <?php
                    if (1 == $row_update['aforado_sindical']) {
                      echo 'Si';
                    } else {
                      echo 'No';
                    }
                    ?>
                    <?php if (1 == $_SESSION['rol'] or (0 < $nump32)) { ?>
                      <form class="navbar-form" name="form145644435345435435345634325rg5634536" method="post" action="">
                        <div class="input-group">
                          <div class="input-group-btn">
                            <select name="aforado_sindical" class="form-control" required>
                              <option value="0" <?php if (0 == $row_update['aforado_sindical'] or !isset($row_update['aforado_sindical'])) {
                                                  echo 'selected';
                                                } else {
                                                  echo '';
                                                }  ?>>No</option>
                              <option value="1" <?php if (1 == $row_update['aforado_sindical']) {
                                                  echo 'selected';
                                                } else {
                                                  echo '';
                                                }  ?>>Si</option>
                            </select>
                          </div>
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </div>
                        </div>
                      </form>
                    <?php } else {
                    } ?>
                  </div>



                <?php } else {
                } ?>





                <?php if (1 == $row_update['id_cargo']) { ?>
                  <div class="form-group text-left">
                    <label class="control-label">Encargado:</label>
                    <?php if (1 == $row_update['encargado']) {
                      echo 'Si';
                    } else {
                      echo 'No';
                    } ?>
                    <?php if (1 == $_SESSION['rol'] or 0 < $nump8) { ?>
                      <form class="navbar-form" name="for3242345443fdg5m1456fyu436" method="post" action="">
                        <div class="input-group">
                          <div class="input-group-btn">
                            <select name="encargado" class="form-control" required>
                              <option value="0">No</option>
                              <option value="1" <?php if (1 == $row_update['encargado']) {
                                                  echo 'selected';
                                                } else {
                                                  echo '';
                                                } ?>>Si</option>
                            </select>
                          </div>
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                          </div>
                        </div>
                      </form>
                    <?php } else {
                    } ?>
                  </div>
                <?php } else {
                } ?>



              <?php } else {
              } ?>





              <div class="form-group text-left">
                <label class="control-label">País:</label>
                <?php
                if (45 == $row_update['id_paisactual']) {
                  echo 'Colombia';
                } else {
                }

                if (1 == $_SESSION['rol']) {
                ?>
                  <form class="navbar-form" name="form1456234443435634536" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <select name="id_paisactual" class="form-control" required>
                          <option value="45" <?php if (45 == $row_update['id_paisactual']) {
                                                echo 'selected';
                                              } else {
                                                echo '';
                                              }  ?>>Colombia</option>
                          <?php echo lista('pais'); ?>
                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>






              <div class="form-group text-left">
                <label class="control-label">TIPO DE OFICINA:</label>
                <?php echo quees('tipo_oficina', $row_update['id_tipo_oficina']); ?>

                <?php if (2 >= $_SESSION['rol'] or 0 < $nump96) { ?>
                  <form class="navbar-form" name="for54434545m14567657436" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <select name="id_tipo_oficina" class="form-control" required>
                          <?php
                          $query = sprintf("SELECT id_tipo_oficina, nombre_tipo_oficina FROM tipo_oficina where estado_tipo_oficina=1 order by id_tipo_oficina");
                          $select = mysql_query($query, $conexion) or die(mysql_error());
                          $row = mysql_fetch_assoc($select);
                          $totalRows = mysql_num_rows($select);
                          if (0 < $totalRows) {
                            do {
                              echo '<option value="' . $row['id_tipo_oficina'] . '"  ';

                              if ($row_update['id_tipo_oficina'] == $row['id_tipo_oficina']) {
                                echo 'selected';
                              } else {
                              }

                              echo '>' . $row['nombre_tipo_oficina'] . '</option>';
                            } while ($row = mysql_fetch_assoc($select));
                          } else {
                          }
                          mysql_free_result($select);
                          ?>

                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>









              <?PHP if (1 == $row_update['id_tipo_oficina']) { ?>
                <div class="form-group text-left">
                  <label class="control-label">GRUPO:</label>
                  <?php echo quees('grupo_area', $row_update['id_grupo_area']);

                  if (1 == $_SESSION['snr_tipo_oficina'] or 0 < $nump9) {
                    $id_grupo = $row_update['id_grupo_area'];
                    $actualizar6 = mysql_query("SELECT nombre_area FROM area, grupo_area WHERE grupo_area.id_area is not null and area.id_area=grupo_area.id_area and grupo_area.id_grupo_area='$id_grupo' limit 1", $conexion) or die(mysql_error());
                    $row16 = mysql_fetch_assoc($actualizar6);
                    echo '<br><label  class="control-label">	AREA:</label>  ' . $row16['nombre_area'];
                  } else {
                    echo '';
                  }
                  ?>
                  <?php if (2 >= $_SESSION['rol'] or 0 < $nump9) { ?>
                    <form class="navbar-form" name="for54435m1456fyu436" method="post" action="">
                      <div class="input-group">
                        <div class="input-group-btn">
                          <select name="id_grupo_area" class="form-control" required>
                            <option value=""></option>
                            <?php
                            $query = sprintf("SELECT id_grupo_area, nombre_grupo_area FROM grupo_area where id_area is not null and  estado_grupo_area=1 order by nombre_grupo_area");
                            $select = mysql_query($query, $conexion);
                            $row = mysql_fetch_assoc($select);
                            $totalRows = mysql_num_rows($select);
                            if (0 < $totalRows) {
                              do {
                                echo '<option value="' . $row['id_grupo_area'] . '"  ';

                                if ($row_update['id_grupo_area'] == $row['id_grupo_area']) {
                                  echo 'selected';
                                } else {
                                }

                                echo '>' . $row['nombre_grupo_area'] . '</option>';
                              } while ($row = mysql_fetch_assoc($select));
                            } else {
                            }
                            mysql_free_result($select);
                            ?>

                          </select>
                        </div>
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                        </div>
                      </div>
                    </form>
                </div>
              <?php } else {
                  } ?>



            <?php } elseif (2 == $row_update['id_tipo_oficina']) { ?>
              <div class="form-group text-left">
                <label class="control-label">ORIP:</label>
                <?php
                if (isset($row_update['id_oficina_registro'])) {
                  $idoripo = $row_update['id_oficina_registro'];
                  echo quees('oficina_registro', $row_update['id_oficina_registro']);  // region id_region 
                } else {
                }

                ?>
                <?php if (1 == $_SESSION['rol'] or 0 < $nump9) { ?>
                  <form class="navbar-form" name="fodfds634536" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <select name="id_oficina_registro" class="form-control" required>
                          <option value=""></option>
                          <?php
                          $query = sprintf("SELECT * FROM oficina_registro where estado_oficina_registro=1 order by nombre_oficina_registro");
                          $select = mysql_query($query, $conexion);
                          $row = mysql_fetch_assoc($select);
                          $totalRows = mysql_num_rows($select);
                          if (0 < $totalRows) {
                            do {
                              echo '<option value="' . $row['id_oficina_registro'] . '"  ';

                              if ($row_update['id_oficina_registro'] == $row['id_oficina_registro']) {
                                echo 'selected';
                              } else {
                              }

                              echo '>' . $row['nombre_oficina_registro'] . '</option>';
                            } while ($row = mysql_fetch_assoc($select));
                          } else {
                          }
                          mysql_free_result($select);
                          ?>
                          <option value="0">Sin dato</option>
                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } else {
                } ?>
              </div>






              <div class="form-group text-left">
                <label class="control-label">GRUPO:</label>
                <?php
                if (isset($row_update['id_grupo_area'])) {

                  echo quees('grupo_area', $row_update['id_grupo_area']);  // region id_region 
                } else {
                }

                ?>
                <?php if (2 >= $_SESSION['rol'] or 0 < $nump9) { ?>
                  <form class="navbar-form" name="fodf324ds634536" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <select name="id_grupo_area" class="form-control" required>
                          <option value=""></option>
                          <?php
                          $query = sprintf("SELECT id_grupo_area, nombre_grupo_area FROM grupo_area where id_orip=" . $idoripo . " and estado_grupo_area=1 order by nombre_grupo_area");
                          $select = mysql_query($query, $conexion);
                          $row = mysql_fetch_assoc($select);
                          $totalRows = mysql_num_rows($select);
                          if (0 < $totalRows) {
                            do {
                              echo '<option value="' . $row['id_grupo_area'] . '"  ';

                              if ($row_update['id_grupo_area'] == $row['id_grupo_area']) {
                                echo 'selected';
                              } else {
                              }

                              echo '>' . $row['nombre_grupo_area'] . '</option>';
                            } while ($row = mysql_fetch_assoc($select));
                          } else {
                          }
                          mysql_free_result($select);


                          ?>
                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>
                    </div>
                  </form>
              </div>
            <?php } else {
                } ?>




          <?php } elseif (3 == $row_update['id_tipo_oficina']) { ?>
            <div class="form-group text-left">
              <label class="control-label">Notaria:</label>
              <?php
                if (isset($row_update['id_notaria_f'])) {

                  echo quees('notaria', $row_update['id_notaria_f']);
                } else {
                }

              ?>
              <?php if (1 == $_SESSION['rol'] or 0 < $nump9) { ?>
                <form class="navbar-form" name="fodfd324234s634536" method="post" action="">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <select name="id_notaria" class="form-control" required>
                        <option value=""></option>
                        <?php
                        $query = sprintf("SELECT * FROM notaria, departamento where notaria.id_departamento=departamento.id_departamento and estado_notaria=1 order by nombre_notaria");
                        $select = mysql_query($query, $conexion) or die(mysql_error());
                        $row = mysql_fetch_assoc($select);
                        $totalRows = mysql_num_rows($select);
                        if (0 < $totalRows) {
                          do {
                            echo '<option value="' . $row['id_notaria'] . '"  ';

                            if ($row_update['id_notaria_f'] == $row['id_notaria']) {
                              echo 'selected';
                            } else {
                            }

                            echo '>' . $row['nombre_notaria'] . ' - ' . $row['nombre_departamento'] . '</option>';
                          } while ($row = mysql_fetch_assoc($select));
                        } else {
                        }
                        mysql_free_result($select);
                        ?>

                      </select>

                    </div>
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                    </div>

                  </div>

                </form>
              <?php } else {
                } ?>

            </div>


          <?php  } else {
              } ?>






          <?php
          if (2 >= $_SESSION['snr_tipo_oficina']) { ?>

            <div class="form-group text-left">
              <label class="control-label">Acceso a LMS Moodle:</label>
              <?php
              if (1 == $row_update['lms']) {
                echo 'Si';
              } else {
                echo 'No';
              }

              if (1 == $_SESSION['rol']) {
              ?>
                <form class="navbar-form" name="form1456234443435634536" method="post" action="">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <select name="lms" class="form-control" required>
                        <option value="0" <?php if (0 == $row_update['lms'] or !isset($row_update['lms'])) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>No</option>
                        <option value="1" <?php if (1 == $row_update['lms']) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>Si</option>
                      </select>
                    </div>
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                    </div>
                  </div>
                </form>
              <?php } else {
              } ?>
            </div>




            <div class="form-group text-left">
              <label class="control-label">Escritorio remoto:</label>
              <?php
              if (1 == $row_update['remoto']) {
                echo 'Si';
              } else {
                echo 'No';
              }
              if (1 == $_SESSION['rol']) {
              ?>
                <form class="navbar-form" name="form1456443435634536" method="post" action="">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <select name="remoto" class="form-control" required>
                        <option value="0" <?php if (0 == $row_update['remoto'] or !isset($row_update['remoto'])) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>No</option>
                        <option value="1" <?php if (1 == $row_update['remoto']) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>Si</option>
                      </select>
                    </div>
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                    </div>
                  </div>
                </form>
              <?php } else {
              } ?>
            </div>




            <div class="form-group text-left">
              <label class="control-label">Lider PQRS:</label>
              <?php
              if (1 == $row_update['lider_pqrs']) {
                echo 'Si';
              } else {
                echo 'No';
              }
              if (1 == $_SESSION['rol'] or (2 == $_SESSION['snr_tipo_oficina'] and 1 == $_SESSION['snr_grupo_cargo']
                and $row_update['id_oficina_registro'] == $_SESSION['id_oficina_registro'])) {
              ?>
                <form class="navbar-form" name="form14564435634536" method="post" action="">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <select name="lider_pqrs" class="form-control" required>
                        <option value="0" <?php if (0 == $row_update['lider_pqrs'] or !isset($row_update['lider_pqrs'])) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>No</option>
                        <option value="1" <?php if (1 == $row_update['lider_pqrs']) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>Si</option>
                      </select>
                    </div>
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                    </div>
                  </div>
                </form>
              <?php } else {
              } ?>
            </div>




            <?php if (1 == $row_update['lider_pqrs']) { ?>

              <div class="form-group text-left">
                <label class="control-label">Puede retornar, aprobar y enviar PQRS:</label>

                <?php
                if (1 == $row_update['aprueba_pqrs']) {
                  echo 'Si';
                } else {
                  echo 'No';
                }

                if (2 >= $_SESSION['rol']) {
                ?>

                  <form class="navbar-form" name="form14564434325rg5634536" method="post" action="">
                    <div class="input-group">
                      <div class="input-group-btn">
                        <select name="aprueba_pqrs" class="form-control" required>
                          <option value="0" <?php if (0 == $row_update['aprueba_pqrs'] or !isset($row_update['aprueba_pqrs'])) {
                                              echo 'selected';
                                            } else {
                                              echo '';
                                            }  ?>>No</option>
                          <option value="1" <?php if (1 == $row_update['aprueba_pqrs']) {
                                              echo 'selected';
                                            } else {
                                              echo '';
                                            }  ?>>Si</option>
                        </select>
                      </div>
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                      </div>

                    </div>

                  </form>

                <?php } else {
                } ?>

              </div>
            <?php } else {
            } ?>






            <?php if (1 == $_SESSION['rol'] or (2 == $_SESSION['snr_tipo_oficina'] and 1 == $_SESSION['snr_grupo_cargo']
              and $row_update['id_oficina_registro'] == $_SESSION['id_oficina_registro'])) { ?>
              <div class="form-group text-left">
                <label class="control-label">Lider Percepción:</label>
                <?php
                if (1 == $row_update['lider_percepcion']) {
                  echo 'Si';
                } else {
                  echo 'No';
                }
                ?>
                <form class="navbar-form" name="form14564443543534325rg5634536" method="post" action="">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <select name="lider_percepcion" class="form-control" required>
                        <option value="0" <?php if (0 == $row_update['lider_percepcion']) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>No</option>
                        <option value="1" <?php if (1 == $row_update['lider_percepcion']) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>Si</option>
                      </select>
                    </div>
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                    </div>
                  </div>
                </form>
              </div>
            <?php } else { ?>
              <div class="form-group text-left">
                <label class="control-label">Lider percepción:</label>

                <?php
                if (1 == $row_update['lider_percepcion']) {
                  echo 'Si';
                } else {
                  echo 'No';
                }
                ?>
              </div>
            <?php } ?>







            <?php if (1 == $_SESSION['rol'] or (0 < $nump36)) { ?>
              <div class="form-group text-left">
                <label class="control-label">Buscar por nombre y descargar PDF - IRIS:</label>
                <?php
                if (1 == $row_update['guardar_pdf']) {
                  echo 'Si';
                } else {
                  echo 'No';
                }
                ?>
                <form class="navbar-form" name="fodfhjgrm14564443543534325rg5634536" method="post" action="">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <select name="guardar_pdf" class="form-control" required>
                        <option value="0" <?php if (0 == $row_update['guardar_pdf']) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>No</option>
                        <option value="1" <?php if (1 == $row_update['guardar_pdf']) {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          }  ?>>Si</option>
                      </select>
                    </div>
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                    </div>
                  </div>
                </form>
              </div>
            <?php } else { ?>
              <div class="form-group text-left">
                <label class="control-label">Buscar por nombre y descargar PDF - IRIS:</label>
                <?php
                if (1 == $row_update['guardar_pdf']) {
                  echo 'Si';
                } else {
                  echo 'No';
                }
                ?>
              </div>
            <?php } ?>



            <div class="form-group text-left">
              <label class="control-label">Usuario Iris (Nivel central):</label>
              <?php
              echo $row_update['username_iris'];
              if (1 == $_SESSION['rol'] or (0 < $nump36)) { ?>
                <form class="navbar-form" name="form14553456436" method="post" action="">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <input type="text" class="form-control" name="username_iris" value="<?php echo $row_update['username_iris'];  ?>" required>
                    </div>
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                    </div>
                  </div>
                  <a href="https://sisg.supernotariado.gov.co/usuarios_iris.jsp" target="_blank"> Ver Usuarios Iris</a>
                </form>
              <?php } else {
              } ?>
            </div>




            <div class="form-group text-left">
              <label class="control-label">Calendario:</label>
              <?php
              echo '<a href="' . $row_update['url_calendario'] . '" target="blank">Calendario</a>';
              if (1 == $_SESSION['rol']) { ?>
                <form class="navbar-form" name="for345m14543653653456436" method="post" action="">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <input type="text" class="form-control" style="width:100%;" name="url_calendario" value="<?php echo $row_update['url_calendario'];  ?>" required>
                    </div>
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                    </div>
                  </div>
                </form>
              <?php } else {
              } ?>
            </div>







            <div class="form-group text-left">
              <label class="control-label">Código para APP (Android, IOS):</label>
              <?php $app1 = 'snr' . $row_update['cedula_funcionario'];
              $app2 = base64_encode($app1);

              $app3 = str_replace("=", "", $app2);
              //echo $app3;
              ?>
              <?php if (1 == $_SESSION['rol']) {  ?>
                &nbsp; <a href="documentos/sisg.apk">Android</a> / <a href="#">Iphone</a>
                <form class="navbar-form" name="for345m14543545653653456436" method="post" action="">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <input type="text" class="form-control" style="width:100%;" name="codigo_app" value="<?php echo $app3;  ?>" required>
                    </div>
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
                    </div>
                  </div>
                </form>
              <?php } else {
              } ?>
            </div>

          <?php } else {
          } ?>




            </div>


          </div>




          <!-- /.table-responsive -->
        </div>

        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
  </div>


  <?php if (1 == $_SESSION['rol']) {
    echo '';
  } else {
    echo '</div>';
  } ?>



  <div class="col-md-4">



    <div class="box direct-chat ">
      <div class="box-header with-border">
        <h3 class="box-title">Fotografia</h3>

        <div class="box-tools pull-right">

          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>


        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="min-height:340px;">
        <div class="direct-chat-messages" style="min-height:300px;">
          <center>
            <img src="files/<?php echo $row_update['foto_funcionario']; ?>" style="width:150px;border-radius: 5px;">

          </center>
          <?php if (($id == $_SESSION['snr'] or 1 == $_SESSION['rol'] or 0 < $nump119) && 1 != $row_update['foto_confirmacion']) { ?>
            <br>
            <form action="" method="POST" name="formsfg1ftregg" enctype="multipart/form-data">
              <div class="form-group text-left">
                <input type="file" name="file" required>
                <input type="hidden" name="subirfoto" value="1">
                <span style="color:#aaa;font-size:13px;">Imagenes jpg ó png en forma cuadrada inferiores a 500 Kb</span>
                <br>
                <center>
                  Debe cargar una foto de acuerdo con el <a href="files/portal/intranet/portal-carnet_digital.pdf" target="_blank">manual.</a><br>
                  <button type="submit" class="btn btn-xs btn-success">
                    <span class="glyphicon glyphicon-user"></span> &nbsp; Subir &nbsp; </button>
                </center>
              </div>
            </form>


          <?php } else {
          } ?>
          <?php if (1 == $_SESSION['rol'] or 0 < $nump119) { ?>
            <form class="navbar-form" name="fo45452342343345rm1" method="post" action="">
              Confirmar foto:
              <select class="form-control" style="width:70px;height:30px" name="foto_confirmacion" required>
                <option value=""></option>
                <option value="1" <?php if (1 == $row_update['foto_confirmacion']) {
                                    echo 'selected';
                                  } else {
                                  } ?>>Si</option>
                <option value="0" <?php if (0 == $row_update['foto_confirmacion']) {
                                    echo 'selected';
                                  } else {
                                  } ?>>No</option>
              </select>
              <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-refresh" title="Cambiar"></span></button>
            </form>
          <?php } else {
          } ?>






        </div>
      </div>
    </div>








    <?php
    $nump134 = privilegios(134, $_SESSION['snr']);

    if (1 == $_SESSION['rol'] or 0 < $nump134 or $id == $_SESSION['snr']) { ?>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Código de seguridad</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>

        </div>
        <div class="box-body">
          <center><span style="font-size:22px;">
              <?php

              $infoc = date('hd');
              echo intval(($infoc - 10) . $_SESSION['snr']);

              ?>
            </span></center>
          <br>
          <br>
        </div>
      </div>
    <?php } else {
    } ?>







    <?php if (3 > $row_update['id_tipo_oficina']) { ?>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Carné</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <center>
            <?php
            if (!isset($row_update['foto_funcionario']) or 'avatar.png' == $row_update['foto_funcionario']) {
              echo 'Debe cargar una foto de acuerdo con el <a href="files/portal/intranet/portal-carnet_digital.pdf" target="_blank">manual.</a><br>';
            } else {
            ?>
              <?php if ($id == $_SESSION['snr'] or 1 == $_SESSION['rol']) { ?>
                <a href="carnet/<?php echo $row_update['id_funcionario']; ?>.pdf" class="btn" style="background:#B40404;color:#fff" target="_blank">Carné Digital</a>
              <?php } else {
                echo '';
              } ?>
              <br><br>
              <img src="files/portal/intranet/portal-imagen_carnet_digital.png" style="width:300px;">
            <?php } ?>
          </center>


        </div>
      </div>
    <?php } else {
    } ?>





    <?php if ($id == $_SESSION['snr'] && 1 == $_SESSION['rol']) { ?>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Firma</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <center>
            <?php
            $momentocompleto = date('Y-m-d H:i');
            $momento_actual = strtotime($momentocompleto);
            $codef = $momento_actual * 76862;
            ?>
            <img src="lubrica/<?php echo $_SESSION['snr'] . '&' . $codef; ?>.png" style="max-width:300px;">
          </center>
          <hr>
          <form action="" method="POST" name="fo43534rm4535sfg1ftregg" enctype="multipart/form-data">
            <div class="form-group text-left">
              <input type="file" name="filef" required>
              <input type="hidden" name="subirfirma" value="1">
              <span style="color:#aaa;font-size:13px;">Imagenes jpg ó png inferiores a 500 Kb</span>
              <br>
              <center>
                <button type="submit" class="btn btn-xs btn-success">
                  <span class="glyphicon glyphicon-user"></span> &nbsp; Subir &nbsp; </button>
              </center>
            </div>
          </form>


        </div>
      </div>

    <?php } else {
    } ?>




    <?php $nump143 = privilegios(143, $_SESSION['snr']);


    if (1 == $_SESSION['rol'] or 0 < $nump143) { ?>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Privilegios</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">

          <form class="navbar-form" name="form1" method="post" action="">

            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control" style="width:220px;height:30px" name="id_perfil" required>
                  <option value="" selected></option>
                  <?php echo lista('perfil'); ?>
                </select>
              </div>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>
              </div>

            </div>
          </form>

          <?php

          $select = mysql_query("SELECT nombre_perfil, id_funcionario_perfil  FROM funcionario_perfil, perfil  where funcionario_perfil.id_perfil=perfil.id_perfil  and  funcionario_perfil.id_funcionario=" . $id . " and estado_funcionario_perfil=1 order by perfil.nombre_perfil", $conexion);
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
            echo '<ul>';
            do {

              echo '<li>' . $row['nombre_perfil'];

              if (1 == $_SESSION['rol']) {
                echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="funcionario_perfil" id="' . $row['id_funcionario_perfil'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
              } else {
              }

              echo '</li>';
            } while ($row = mysql_fetch_assoc($select));
            echo '</ul>';
          } else {
          }
          mysql_free_result($select);



          ?>
          <br />
        </div>
      </div>
    <?php } else {
    } ?>



    <?php if (1 == $_SESSION['rol']) { ?>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Ubicación</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">

          <form class="navbar-form" name="fo45345rm1" method="post" action="">

            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control" style="width:220px;height:30px" name="id_punto_ubicacion" required>
                  <option value="" selected></option>
                  <?php echo lista('punto_ubicacion'); ?>
                </select>
              </div>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>
              </div>

            </div>
          </form>

          <?php

          $select = mysql_query("SELECT * FROM punto_ubicacion, punto_ubicacion_enlace where punto_ubicacion_enlace.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion and  punto_ubicacion_enlace.id_funcionario=" . $id . " and estado_punto_ubicacion_enlace=1", $conexion);
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
            echo '<ul>';
            do {

              echo '<li>' . $row['nombre_punto_ubicacion'];

              if (1 == $_SESSION['rol']) {
                echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="punto_ubicacion_enlace" id="' . $row['id_punto_ubicacion_enlace'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
              } else {
              }

              echo '</li>';
            } while ($row = mysql_fetch_assoc($select));
            echo '</ul>';
          } else {
          }
          mysql_free_result($select);



          ?>
          <br />
        </div>
      </div>

    <?php } else {
      echo '';
    } ?>




    <?php if (1 == $_SESSION['rol'] or 1 == $_SESSION['snr_tipo_oficina']) { ?>

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Sistema Información que apoya</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <?php if (1 == $_SESSION['rol']) { ?>

            <form class="navbar-form" name="fo454543345rm1" method="post" action="">

              <div class="input-group">
                <div class="input-group-btn">
                  <select class="form-control" style="width:220px;height:30px" name="id_aplicacion" required>
                    <option value="" selected></option>
                    <?php echo lista('aplicacion'); ?>
                  </select>
                </div>
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>
                </div>

              </div>
            </form>

          <?php } else {
          } ?>

          <?php

          $select = mysql_query("SELECT * FROM funcionario_aplicacion, aplicacion where funcionario_aplicacion.id_aplicacion=aplicacion.id_aplicacion and id_funcionario=" . $id . " and estado_funcionario_aplicacion=1 and estado_aplicacion=1", $conexion);
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
            echo '<ul>';
            do {

              echo '<li title="' . $row['nombre_funcionario_aplicacion'] . '">';
              echo '' . $row['nombre_aplicacion'] . '';
              if (1 == $_SESSION['rol']) {
                echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="funcionario_aplicacion" id="' . $row['id_funcionario_aplicacion'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
              } else {
              }

              echo '</li>';
            } while ($row = mysql_fetch_assoc($select));
            echo '</ul>';
          } else {
          }
          mysql_free_result($select);



          ?>

        </div>
      </div>
    <?php } else {
    } ?>









    <?php if (1 == $_SESSION['rol']) { ?>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Inventario</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>

        </div>
        <div class="box-body">
          <?php
          /*
$select = mysql_query("SELECT b.id_funcionario, a.item, a.placa, a.clase_de_bien, a.descripcion_del_bien, a.marca, a.modelo, a.serie, a.estado, a.clase_bien, a.origen, a.num_orden_ingreso, a.fecha_orden_ingreso, a.num_orden_egreso, a.fecha_activacion,
a.costo_historico, a.codigo_contable, a.orip, c.nombre_departamento, a.observaciones, b.cedula_funcionario, b.nombre_funcionario
FROM inventario a, funcionario b, departamento c, inventario_funcionario d  
WHERE a.id_inventario=d.id_inventario AND b.id_funcionario=d.id_funcionario AND c.id_departamento=d.id_departamento
and b.id_funcionario =".$id." ", $conexion);
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
	echo '<ul>';
do {
echo '<li>'.$row['clase_de_bien'].' / ';
echo ''.$row['descripcion_del_bien'].' / ';
echo ''.$row['marca'].' / ';
echo 'Placa: '.$row['placa'].'';
echo '</li>';

 } while ($row = mysql_fetch_assoc($select)); 
 echo '</ul>';
} else { } 
mysql_free_result($select);
*/



          $json = file_get_contents('http://192.168.210.130:8080/wsHgfi/' . $cedula . '.json');
          $obj = json_decode($json);
          echo '<ul>';
          foreach ($obj as $character) {


            echo '<li>' . $character->TXTCLASEBIEN . ' / ';
            echo '' . $character->DESCRIPCION . ' / ';
            echo '' . $character->TXTMARCA . ' / ';
            echo 'Placa: ' . $character->TXTPLACAINVENTARIO . '';
            echo '</li>';
          }

          echo '</ul>';

          ?>
          <br>
          <br>
        </div>
      </div>
    <?php } else {
    } ?>








    <?php if (1 == $_SESSION['rol'] or 0 < $nump12) { ?>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Documentos</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>

        </div>
        <div class="box-body">

          <?php if ((1 == $_SESSION['rol'] or 0 < $nump12)) { ?>
            <a class="ventana1" data-toggle="modal" data-target="#popupnewdocumento" href="" title="Añadir"> <button type="button" class="btn btn-xs btn-success">
                <span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>
          <?php
          } else {
          }

          $select = mysql_query("select * from documento_funcionario, tipo_adjunto, tipo_subadjunto where tipo_adjunto.id_tipo_adjunto=tipo_subadjunto.id_tipo_adjunto and documento_funcionario.id_tipo_subadjunto=tipo_subadjunto.id_tipo_subadjunto and documento_funcionario.id_tipo_adjunto=tipo_subadjunto.id_tipo_adjunto and id_funcionario=" . $id . " and estado_documento_funcionario=1 ", $conexion) or die(mysql_error());
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
            do {
              echo '<hr>';

              if (1 == $_SESSION['rol'] or 0 < $nump12) {
                echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="documento_funcionario" id="' . $row['id_documento_funcionario'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
              } else {
              }


              echo ' <a href="filesnr/documentos/' . $row['url_documento'] . '" target="_blank"><img src="images/pdf.png"> ';
              echo '' . $row['nombre_tipo_adjunto'] . ' / ';
              echo '' . $row['nombre_tipo_subadjunto'] . '';
              echo '</a>';



              if (isset($row['nombre_documento_funcionario']) && "" != $row['nombre_documento_funcionario']) {
                echo '<br>"' . $row['nombre_documento_funcionario'] . '"';
              } else {
              }


              echo '<br><span style="color:#999;">' . $row['fecha_inicial'] . '-' . $row['fecha_documento'] . '</span>';

              if (isset($row['fecha_inicial']) && isset($row['fecha_documento'])) {
                echo ' (';
                echo calculatiempo($row['fecha_inicial'], $row['fecha_documento']);
                echo ' Años.)';
              } else if (isset($row['fecha_documento'])) {
                echo ' (';
                echo calculaedad($row['fecha_documento']);
                echo ' Años.)';
              } else {
              }
            } while ($row = mysql_fetch_assoc($select));
          } else {
          }
          mysql_free_result($select);




          ?>
          <br>
          <br>
        </div>
      </div>
    <?php } else {
    } ?>





    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Formación académica
          <?php
          if (1 == $_SESSION['rol']) {
            echo '<a href="https://www.datos.gov.co/resource/2jzx-383z.json?numerodeidentificacion=' . $cedula . '" target="_blank">Datos públicos</a>';
          } else {
          }
          ?>

        </h3>

        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">



        <?php if (1 == $_SESSION['rol'] or 0 < $nump14) { ?>
          <a class="ventana1" data-toggle="modal" data-target="#popupnewformacion" href="" title="Añadir"> <button type="button" class="btn btn-xs btn-success">
              <span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>
        <?php } else {
        } ?>
        <br>
        <br>

        <?php

        $selectup = mysql_query("SELECT * FROM estudio_funcionario where cedula_funcionario=" . $cedula . " and nombre_estudio_funcionario!=''", $conexion);
        $rowup = mysql_fetch_assoc($selectup);
        $totalRowsup = mysql_num_rows($selectup);
        if (0 < $totalRowsup) {
          echo '<ul>';
          do {
            echo '<li>';
            echo '<b>' . $rowup['nivel_formacion'] . '</b> / ';
            echo '<span>' . $rowup['nivel_educativo'] . '</span> / ';
            echo '<span>' . $rowup['institucion'] . '</span> / ';
            echo '<span>' . $rowup['nombre_estudio_funcionario'] . '</span>';



            echo '</li>';
          } while ($rowup = mysql_fetch_assoc($selectup));
          echo '</ul>';
        } else {
        }
        mysql_free_result($selectup);



        ?>

        <hr>


        <?php

        $selectu = mysql_query("SELECT * FROM formacion, nivel_academico where formacion.id_nivel_academico=nivel_academico.id_nivel_academico and id_funcionario=" . $id . " and estado_formacion=1 order by nivel_academico.id_nivel_academico", $conexion);
        $rowu = mysql_fetch_assoc($selectu);
        $totalRowsu = mysql_num_rows($selectu);
        if (0 < $totalRowsu) {
          echo '<ul>';
          do {

            echo '<li>';

            if (1 == $_SESSION['rol']  or 0 < $nump14) {
              echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="formacion" id="' . $rowu['id_formacion'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
            } else {
            }

            echo ' ' . $rowu['nombre_nivel_academico'] . ' / ' . $rowu['nombre_formacion'] . ' / TP: ' . $rowu['tarjeta_profesional'] . ' / ' . $rowu['fecha_tarjeta'] . ' ';

            if (isset($rowu['fecha_grado'])) {
              echo ' (';
              echo calculaedad($rowu['fecha_grado']);
              echo ' Años desde el grado)';
            } else {
            }


            if (isset($rowu['fecha_tarjeta'])) {
              echo ' (';
              echo calculaedad($rowu['fecha_tarjeta']);
              echo ' Años desde la tarjeta)';
            } else {
            }



            echo '</li>';
          } while ($rowu = mysql_fetch_assoc($selectu));
          echo '</ul>';
        } else {
        }
        mysql_free_result($selectu);



        ?>
        <br />
      </div>
    </div>



















    <?php if (3 == $row_update['id_tipo_oficina']) { ?>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Perfil: Notario; Posesiones</h3>
        </div>
        <div class="box-body">
          <?php
          $query = sprintf("SELECT * FROM posesion_notaria, funcionario, tipo_nombramiento_n where id_cargo=1 and posesion_notaria.id_funcionario=funcionario.id_funcionario and posesion_notaria.id_tipo_nombramiento_n=tipo_nombramiento_n.id_tipo_nombramiento_n and funcionario.id_funcionario=" . $id . " and estado_funcionario=1 and estado_posesion_notaria=1 order by fecha_inicio desc");
          $select = mysql_query($query, $conexion) or die(mysql_error());
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
          ?>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Notaria</th>
                  <th>Desde</th>
                  <th>Hasta</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php
              do {
                echo '<tr>';
                echo '<td>';
                echo '<a href="notaria&' . $row['id_notaria'] . '.jsp"><span class="fa fa-institution"></span></a> ';

                echo quees('notaria', $row['id_notaria']);

                echo '</td>';

                echo '<td>' . $row['fecha_inicio'] . '</td>';

                if (isset($row['fecha_fin'])) {
                  echo '<td>' . $row['fecha_fin'] . '</td>';
                } else {
                  echo '<td>Activo</td>';
                }
                echo '</tr>';
              } while ($row = mysql_fetch_assoc($select));
            } else {
            }
            mysql_free_result($select);


              ?>
              </tbody>
            </table>
        </div>
      </div>
    <?php
    } else {
    } ?>


    <?php
    $nump92 = privilegios(92, $_SESSION['snr']);

    if (1 == $_SESSION['rol'] or 0 < $nump92) { ?>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">IdAutoridad Cancilleria</h3>
        </div>
        <div class="box-body">
          <form class="navbar-form" name="for34gfgfdg5653653456436" method="post" action="">
            <div class="input-group">
              <div class="input-group-btn">
                <input type="text" class="form-control" style="width:100%;" name="id_autoridad_cancilleria" value="<?php echo $row_update['id_autoridad_cancilleria'];  ?>" required>
              </div>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" title="Actualizar"></span></button>
              </div>
            </div>
          </form>
        </div>
      </div>


    <?php

    } else {
    }










    $nump5 = privilegios(5, $_SESSION['snr']);

    if (1 == $_SESSION['rol'] or 0 < $nump5) {

      if (isset($_POST['id_notaria_propiedad']) && "" != $_POST['id_notaria_propiedad']) {
        $insertSQL44 = sprintf(
          "INSERT INTO notario_propiedad (id_notaria, id_funcionario, estado_notario_propiedad) VALUES (%s, %s, 1)",
          GetSQLValueString(intval($_POST["id_notaria_propiedad"]), "int"),
          GetSQLValueString($id, "int")
        );
        $Result4 = mysql_query($insertSQL44, $conexion);
        echo $insertado;
      }

    ?>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Asignar propiedad a una Notaria</h3>
        </div>
        <div class="box-body">

          <form class="navbar-form" name="fo454435345543345rm1" method="post" action="">

            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control" style="width:220px;height:30px" name="id_notaria_propiedad" required>
                  <option value="" selected></option>
                  <?php echo listanotarias(); ?>
                </select>
              </div>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Agregar"></span></button>
              </div>

            </div>
          </form>


          <hr>
          <?php

          $query4 = "SELECT id_notario_propiedad, nombre_notaria FROM notario_propiedad, notaria where notario_propiedad.id_notaria=notaria.id_notaria and id_funcionario=" . $id . " and estado_notario_propiedad=1";
          $select4 = mysql_query($query4, $conexion);
          $row4 = mysql_fetch_assoc($select4);
          $totalRows4 = mysql_num_rows($select4);

          if (0 < $totalRows4) {
            echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="notario_propiedad" id="' . $row4['id_notario_propiedad'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

            echo ' ' . $row4['nombre_notaria'];
          } else {
          }
          mysql_free_result($select4);
          ?>

        </div>
      </div>







 <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Autorizar como encargado</h3>
        </div>
        <div class="box-body">

          <form class="navbar-form" name="fo45rm1" method="post" action="">

            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control" style="width:220px;height:30px" name="encargado_notaria" required>
                  <option value="" ></option>
                 <option value="1" <?php if(1==$row_update['encargado_notaria']) { echo 'selected'; } else {} ?>>Si</option>
				 <option value="0" <?php if(0==$row_update['encargado_notaria']) { echo 'selected'; } else {} ?>>No</option>
                </select>
              </div>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign" title="Enviar"></span></button>
              </div>

            </div>
          </form>


          <hr>
          <?php

          $query4 = "SELECT id_notario_propiedad, nombre_notaria FROM notario_propiedad, notaria where notario_propiedad.id_notaria=notaria.id_notaria and id_funcionario=" . $id . " and estado_notario_propiedad=1";
          $select4 = mysql_query($query4, $conexion);
          $row4 = mysql_fetch_assoc($select4);
          $totalRows4 = mysql_num_rows($select4);

          if (0 < $totalRows4) {
            echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="notario_propiedad" id="' . $row4['id_notario_propiedad'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';

            echo ' ' . $row4['nombre_notaria'];
          } else {
          }
          mysql_free_result($select4);
          ?>

        </div>
      </div>
	  
	  
	  
    <?php

    } else {
    }





    if (3 > $row_update['id_tipo_oficina'] && isset($row_update['celular_funcionario'])) { ?>

      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">vCard</h3>

        </div>
        <div class="box-body">



          <?php if (1 == $_SESSION['rol'] or 22 == $_SESSION['snr_grupo_area'] or 306 == $_SESSION['snr_grupo_area']) {

            $vcard = "BEGIN:VCARD\r\nVERSION:3.0\r\nN:" . $row_update['nombre_funcionario'] . "\r\nORG:Superintendencia de Notariado y Registro\r\nTITLE:" . nombretabla('grupo_area', $row_update['id_grupo_area']) . "\r\nTEL;TYPE=home,voice:+57" . $row_update['celular_funcionario'] . "\r\nTEL;TYPE=work,voice:+576013282121#" . $row_update['telefono_funcionario'] . "\r\nURL;TYPE=work:www.supernotariado.gov.co\r\nEMAIL;TYPE=internet,pref:" . $row_update['correo_funcionario'] . "\r\nREV:" . date('Ymd') . "T195243Z\r\nEND:VCARD";

           // echo $vcard;

            echo '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . urlencode($vcard) . '&chld=L|1&choe=UTF-8">';
          } else {
          } ?>

        </div>
      </div>

    <?php } else {
    }



    if (3 > $row_update['id_tipo_oficina']) {
    ?>


      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Tipo de vacante</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <?php if (1 == $_SESSION['rol'] or 0 < $nump9 or $id == $_SESSION['snr']) {

            $query = "select * from tipo_vacante where cedula_f=" . $cedula . " and estado_tipo_vacante=1";
            $select = mysql_query($query, $conexion);
            $row = mysql_fetch_assoc($select);
            $totalRows = mysql_num_rows($select);
            if (0 < $totalRows) {
              do {

                echo '<b>TIPO DE VACANTE QUE OCUPA ACTUALMENTE:</b> ' . $row['nombre_tipo_vacante'] . '<br>';
                echo '<b>DUEÑO DEL CARGO:</b> ' . $row['dueno'] . '<br>';
                echo '<b>UBICACIÓN ACTUAL DEL DUEÑO:</b> ' . $row['ubicacion'] . '<br>';
              } while ($row = mysql_fetch_assoc($select));

              echo '<br><b>Nota:</b> Se informa a los funcionarios de Carrera administrativa que se encuentren en situación de encargo, se inscriban en la convocatoria, y no superen el proceso, regresarán a su cargo titular, el cual se mantendrá en la ubicación en la que se encontraba antes de ser encargado. ';
            }
            mysql_free_result($select);
          } else {
          } ?>
          <br>
          <br>

        </div>
      </div>
	  
	  
	  
	  
	  
	  
	   <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Vinculación a 2023</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <?php 
		  
$querym = "SELECT * FROM nomina where identificacion=" . $cedula . " order by fecha_efectiva desc";
$resultm = $mysqli->query($querym);
while ($obj = $resultm->fetch_array()) {
	echo $obj['desc_dependencia'].' - ';
	echo $obj['tipo_acto'].' - ';
echo $obj['fecha_efectiva'].' - ';
echo $obj['desc_cargo'].' - ';
echo $obj['cargo'].' - ';
echo $obj['grado'].'<br>';
 
    }
$resultm->free();


		  ?>
          <br>
		  
		    <a href="pdf/certificado_convocatoria&<?php echo $id; ?>.pdf">
              <button type="button" class="btn btn-xs btn-success">
                <span class="glyphicon glyphicon-plus-sign"></span> Certificado</button></a>
				
          <br>
        </div>
      </div>
	  
	  

    <?php } else {
    } ?>



    <?php

    if (4 == $row_update['id_tipo_oficina']) { ?>

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Relación con Curadurias</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <?php if (1 == $_SESSION['rol'] or 0 < $nump3) { ?>
            <a class="ventana1" data-toggle="modal" data-target="#popupnewrcuraduria" href="" title="Añadir"> <button type="button" class="btn btn-xs btn-success">
                <span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>
          <?php } else {
          } ?>
          <br>
          <br>
          <?php
          echo '<ul>';
          $selectu = mysql_query("SELECT * FROM relacion_curaduria, curaduria where relacion_curaduria.id_curaduria=curaduria.id_curaduria and relacion_curaduria.id_funcionario=" . $id . " and estado_relacion_curaduria=1 ", $conexion);
          $rowu = mysql_fetch_assoc($selectu);
          $totalRowsu = mysql_num_rows($selectu);
          if (0 < $totalRowsu) {

            do {

              echo '<li>';

              if (1 == $_SESSION['rol'] or 0 < $nump3) {
                echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="relacion_curaduria" id="' . $rowu['id_relacion_curaduria'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
              } else {
              }

              echo ' ' . $rowu['nombre_curaduria'] . ' <br> Cumple requisitos como Curador: ' . $rowu['requisitos_curaduria'] . ' ';



              echo '</li>';
            } while ($rowu = mysql_fetch_assoc($selectu));
          } else {
          }
          mysql_free_result($selectu);





          $queryg = sprintf("SELECT * FROM situacion_curaduria, tipo_acto where situacion_curaduria.id_tipo_acto=tipo_acto.id_tipo_acto and id_funcionario=" . $id . " and estado_situacion_curaduria=1");
          $selectg = mysql_query($queryg, $conexion);
          $rowcc = mysql_fetch_assoc($selectg);
          $totalRows_regg = mysql_num_rows($selectg);

          if (0 < $totalRows_regg) {


            do {

              echo '<li><b>';
              echo quees('curaduria', $rowcc['id_curaduria']);
              echo '</b>, Desde ' . $rowcc['fecha_acta_posesion'] . ', hasta ' . $rowcc['fecha_terminacion'] . ' (';
              echo calculatiempo($rowcc['fecha_acta_posesion'], $rowcc['fecha_terminacion']);
              echo ' Años.) ';
              echo '<a href="curaduria&' . $rowcc['id_curaduria'] . '.jsp" target="_blank">Ver</a>';
              echo '</li>';
            } while ($rowcc = mysql_fetch_assoc($selectg));
            mysql_free_result($selectg);
          }
          mysql_free_result($select);
          echo '</ul>';
          ?>




          <br />
        </div>
      </div>







      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Relacionar con lista de elegibles</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <?php if (1 == $_SESSION['rol'] or 0 < $nump3) { ?>
            <a class="ventana1" data-toggle="modal" data-target="#popupelegible" href="" title="Añadir"> <button type="button" class="btn btn-xs btn-success">
                <span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>
          <?php } else {
          } ?>
          <br>
          <br>
          <?php

          $selectu = mysql_query("SELECT * FROM curador_elegible, municipio where curador_elegible.id_departamento=municipio.id_departamento and curador_elegible.codigo_municipio=municipio.codigo_municipio and id_funcionario=" . $id . " and estado_curador_elegible=1 ", $conexion);
          $rowu = mysql_fetch_assoc($selectu);
          $totalRowsu = mysql_num_rows($selectu);
          if (0 < $totalRowsu) {
            echo '<ul>';
            do {

              echo '<li>';

              if (1 == $_SESSION['rol']) {
                echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="curador_elegible" id="' . $rowu['id_curador_elegible'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
              } else {
              }

              echo ' Convotatoria: ' . $rowu['nombre_curador_elegible'] . ' / Municipio: ' . $rowu['nombre_municipio'] . ' / Porcentaje: ' . $rowu['porcentaje'] . ' <a href="filesnr/elegibles/' . $rowu['documento_curador_elegible'] . '"><img src="images/pdf.png"></a>';



              echo '</li>';
            } while ($rowu = mysql_fetch_assoc($selectu));
            echo '</ul>';
          } else {
          }
          mysql_free_result($selectu);



          ?>
          <br />
        </div>
      </div>



    <?php } else {
    } ?>


    <?php if (1 == $_SESSION['rol'] || 0 < $nump136) {  ?>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Historial de Contratos.

            <?php
            if (1 == $_SESSION['rol']) {

              echo '<br><a href="https://consultaprocesos.colombiacompra.gov.co/Proveedores.jsp" target="_blank">Consultar</a><br>';


              echo '<a href="https://www.datos.gov.co/resource/rpmr-utcd.json?documento_proveedor=' . $cedula . '" target="_blank">Datos públicos</a>';
            } else {
            }
            ?>

          </h3>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="input-group-btn">
            <a class="ventana1" data-toggle="modal" data-target="#popuphistorialcargo" href="" title="Añadir"> <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></a>
          </div>


          <?php
          $query = "SELECT * FROM nc_contratos WHERE id_funcionario=$id ORDER BY ano_datos_contrato DESC, cod_datos_contrato DESC";
          $select = mysql_query($query, $conexion);
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
            echo '<br>';
            do {
              if (isset($row['cod_datos_contrato'])) {

                if (1 == $_SESSION['rol'] || 0 < $nump136) {
                  echo ' <a style="color:#ff0000;cursor: pointer" title="Borrar" name="nc_contratos" id="' . $row['id_nc_contratos'] . '" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
                }

                if (1 == $_SESSION['rol'] || 0 < $nump136) {
                  echo '<b># contrato:</b> ' . $row['cod_datos_contrato'] . ' - ' . $row['ano_datos_contrato'] . ' <a href="contratos&' . $id . '.jsp" class="btn btn-xs btn-warning" target="_blank">Detalles</a><br>';
                }

                echo '<b>Perfil:</b> ';
                if (isset($row['id_nc_salario']) && '' != $row['id_nc_salario']) {
                  $idSalario = $row['id_nc_salario'];
                  $query14 = "SELECT id_nc_salario, nombre_nc_cargo, nombre_nc_salario FROM nc_salario LEFT JOIN nc_cargo ON nc_cargo.id_nc_cargo=nc_salario.id_nc_cargo WHERE id_nc_salario=$idSalario";
                  $result14 = $mysqli->query($query14);
                  $row14 = $result14->fetch_array(MYSQLI_ASSOC);
                  echo $row14['nombre_nc_cargo'] . '<br> <b>Salario:</b> ' . $row14['nombre_nc_salario'];
                } else {
                }
                echo '<br>';
                echo '<b>Fecha Ingreso:</b> ' . $row['fecha_acta_inicio'] . '<br>';
                echo '<b>Fecha Salida:</b> ' . $row['fecha_terminacion'] . '<br>';
                echo '<b>Supervisor :</b>';
                if ($row['id_funcionario_supervisor']) {
                  echo quees('funcionario', $row['id_funcionario_supervisor']) . '<br>';
                } else {
                }
          ?>
                <hr>
          <?php
              }
            } while ($row = mysql_fetch_assoc($select));
          }
          mysql_free_result($select);
          ?>

          <div class="modal fade" id="popuphistorialcargo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                  <h4 class="modal-title" id="myModalLabel">Nuevo: <span class="licenciac" style="font-weight: bold;"></span></h4>
                </div>
                <div class="modal-body">
                  <form name="guardarformhistoricocargos" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <label><span style="color:#ff0000;">*</span>Número Contrato:</label><br>
                        <input type="text" name="cod_datos_contrato" class="form-control" required>
                      </div>

                      <div class="col-md-6">
                        <label><span style="color:#ff0000;">*</span>Año Contrato:</label><br>
                        <input type="number" name="ano_datos_contrato" class="form-control" required>
                      </div>

                      <div class="col-md-6">
                        <label><span style="color:#ff0000;">*</span>Perfil del Contratista:</label>
                        <select name="id_nc_salario" class="form-control" required>
                          <option value="" selected></option>
                          <?php $query14 = "SELECT id_nc_salario, nombre_nc_cargo, nombre_nc_salario FROM nc_salario LEFT JOIN nc_cargo ON nc_cargo.id_nc_cargo=nc_salario.id_nc_cargo WHERE estado_nc_salario=1";
                          $result14 = $mysqli->query($query14);
                          while ($row14 = $result14->fetch_array(MYSQLI_ASSOC)) {
                            echo '<option value="' . $row14['id_nc_salario'] . '">' . $row14['nombre_nc_cargo'] . ' - ' . $row14['nombre_nc_salario'] . '</option>';
                          }
                          $result14->free() ?>
                        </select>
                      </div>

                      <div class="col-md-6">
                        <label><span style="color:#ff0000;">*</span>Supervisor:</label>
                        <select name="id_funcionario_supervisor" class="form-control" required>
                          <?php
                          $query = sprintf("SELECT id_funcionario, nombre_funcionario FROM funcionario where estado_funcionario=1 and id_cargo IN(1,2,4) order by nombre_funcionario");
                          $select = mysql_query($query, $conexion);
                          $row = mysql_fetch_assoc($select);
                          $totalRows = mysql_num_rows($select);
                          if (0 < $totalRows) {
                            echo '<option value="" selected></option>';
                            do {
                              echo '<option value="' . $row['id_funcionario'] . '" style="text-transform: uppercase">' . $row['nombre_funcionario'] . '</option>';
                            } while ($row = mysql_fetch_assoc($select));
                          }
                          mysql_free_result($select);
                          ?>
                        </select>
                      </div>

                      <div class="col-md-6">
                        <label><span style="color:#ff0000;">*</span>Fecha de Inicio (Acta Inicio):</label>
                        <input type="date" name="fecha_acta_inicio" class="form-control" required>
                      </div>

                      <div class="col-md-6">
                        <label><span style="color:#ff0000;">*</span>Fecha de Terminacion:</label>
                        <input type="date" name="fecha_terminacion" class="form-control" required>
                      </div>

                    </div>
                    <div class="modal-footer"><button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()">
                        <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                      <button type="submit" class="btn btn-success btn-xs"><input type="hidden" name="guardarNuevoContrato" value="insertco"><span class="glyphicon glyphicon-ok"></span> Agregar </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>



<?php if (1==$_SESSION['snr_tipo_oficina']) { ?>

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Contratos con SECOP</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <?php 

$numeroq=$cedula;
$aniq=date('Y');
$curlq = curl_init();

curl_setopt_array($curlq, array(
  CURLOPT_URL => 'http://192.168.80.110/r1/CO/GOB/CCE-8033/CERTICON/wsConsultaContratosEntidad/pro/2000-01-01/'.$aniq.'-12-31/CC/'.$numeroq.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'x-road-client: CO/GOB/SNR-0027/FM-SIR',
    'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ1NXMzckM0cnAzdDQifQ.Y_bn-wolLvuKcQ8yeH5jbUnsTO-OYc-PnhL3HYaoVwk',
    'Cookie: .AspNet.Cookies=cz60Z1mEiQqaDWuuafrrEB--74aj9nwAWbjTdZgYAg7NXO_EKEgNR89vJDJeljuKg0EbRfgZurC3rkOO6YYquAktVrTiP6evWUxZ8FxL-x-DZbenbzrFG_MgOkO-QMj72QD80AXIf8w7tQ5t5z6k79ZN_qpA451DZY0lnnXSrS5IfTHkOwZlR7cQX0obKFkyzdfaZ00qtGssGSCFkXU3VeeuZ8_uJZUuyx7JuhtjnOfXNAeGQv22vzVsq6BI_8hZumVgGUZaMMITfO6UjIM_iEvCQmQgElajMSwJVzp8QBCC_OgQrY7gzKIxfYSDN40MQeW3wqYPsy18yEPJ7T7E7irU6hOPfGXjYNtyl8fWizmdykYsgGM9zx27iGFMXl634eoAjOZolaY_WWysaKY1M8q8KgR88qozwdTM5inXIWYDcpAedwLKA5JYsUf9vdEWfCHI9CCieCKuT16if2qam0yUs-OpoJi7OehN6rbJ8imSTAsjscpH1wWTJTnZS0TZ; JSESSIONID=ytsOGqhCfxtV6ebGsvhEqVGqpxODYr-jW5Z1EWQWxFVjXucQzVUg!-848547927'
  ),
));

$responseq = curl_exec($curlq);

curl_close($curlq);
		

$objq=json_decode($responseq);


$arrayv=$objq->contratosSECOPI;


foreach ($arrayv as $characterv) {
	
echo $characterv->nombredelaEntidad;
echo ', <b>';
echo $characterv->numerodelContrato;
echo '</b>, ';
echo $characterv->fechaIniciodelContrato;
echo ' a ';
echo $characterv->fechaFindelContrato;
echo ', <a href="';
echo $characterv->link;
echo '" target="_blank">Contrato</a><hr>';


}



	
$arrayq=$objq->contratosSECOPII;

foreach ($arrayq as $characterq) {
	
echo $characterq->nombredelaEntidad;
echo ', <b>';
echo $characterq->numerodelContrato;
echo '</b>, ';
echo $characterq->fechaIniciodelContrato;
$finc3 =$characterq->fechaFindelContrato;
echo $finc3;
echo ' a ';
echo $characterq->fechaFindelContrato;
echo ', <a href="';
echo $characterq->link;
echo '" target="_blank">Contrato</a><hr>';


$anocargue=$characterq->annoCargue;
if ($aniq==$anocargue) {
	$finc2=explode(" ", $finc3);
	$finc=$finc2[0];
	echo '<BR><b>FINALIZA: '.$finc.'</b>';
} else {
	}



}
		

		  
		  ?>
          <br>
          <br>
        </div>
      </div>
<?php } else {} ?>
	  
	  
	  
	  
	   
	  
	  
	  
	  
	  
	  
	  
	   <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Certificaciones</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <?php $nump136 = privilegios(136, $_SESSION['snr']);
          if (1 == $_SESSION['rol'] || 0 < $nump136) { ?>
            <a href="pdf/certificado_contratista&<?php echo $id; ?>.pdf">
              <button type="button" class="btn btn-xs btn-success">
                <span class="glyphicon glyphicon-plus-sign"></span> Contratistas</button></a>

            <br><br>

            <a href="pdf/certificado_convocatoria&<?php echo $id; ?>.pdf">
              <button type="button" class="btn btn-xs btn-success">
                <span class="glyphicon glyphicon-plus-sign"></span> Para convocatoria</button></a>

          <?php } else {
          } ?>
          <br>
          <br>
        </div>
      </div>
	  
	  
	  
	  
    <?php } ?>


    <?php
    if ((1 == $_SESSION['rol'] or $row_update['id_funcionario'] == $_SESSION['snr'] or 1 == $_SESSION['supervisor'] or 1 == $_SESSION['snr_grupo_cargo'])
      && 5 == $id_perfil && 2 >= $_SESSION['snr_tipo_oficina']
    ) { ?>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Cuentas de cobro:</h3>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="input-group-btn">

          </div>


          <?php
          $query = "select * from correspondencia where cedula_contratista=" . $cedula . " and estado_correspondencia=1";
          $select = mysql_query($query, $conexion);
          $row = mysql_fetch_assoc($select);
          $totalRows = mysql_num_rows($select);
          if (0 < $totalRows) {
            do {
              echo '<a href="correspondencia&' . $row['nombre_correspondencia'] . '.jsp" target="_blank">' . $row['nombre_correspondencia'] . '</a> 
				 / ' . $row['fecha_correspondencia'] . ' 
				 / (';
              if (isset($row['id_fun_presupuesto'])) {
                echo '<i class="fa fa-check" title="Presupuesto"></i> ';
              } else {
                echo '<i class="fa fa-close" title="Presupuesto"></i> ';
              }
              if (isset($row['id_fun_contabilidad'])) {
                echo '<i class="fa fa-check" title="Contabilidad"></i> ';
              } else {
                echo '<i class="fa fa-close" title="Contabilidad"></i> ';
              }
              if (isset($row['id_fun_tesoreria'])) {
                echo '<i class="fa fa-check" title="Tesoreria"></i> ';
              } else {
                echo '<i class="fa fa-close" title="Tesoreria"></i> ';
              }

              echo ')<br>';
            } while ($row = mysql_fetch_assoc($select));
          }
          mysql_free_result($select);
          ?>



        </div>
      </div>
    <?php

    } else {
    } ?>
  </div>
</div>




<?php
if ((3 > $_SESSION['snr_tipo_oficina']) && isset($row_update['url_calendario'])) {
?>

  <div class="row">
    <div class="col-md-12">
      <div class="box ">
        <div class="box-body">
          <iframe src="<?php echo $row_update['url_calendario']; ?>" style="width:100%;min-height:600px;"></iframe>
        </div>
      </div>
    </div>
  </div>
<?php
} else {
}
?>
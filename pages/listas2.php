<?php

function privilegioscuraduria($idcuraduria, $idmodulo, $idfuncuraduria)
{
   global $mysqli;
   $query4pn = sprintf("SELECT count(id_privilegio_curaduria) as contadorcuraduria FROM privilegio_curaduria where id_curaduria=" . $idcuraduria . " and id_modulo_curaduria=" . $idmodulo . " and id_funcionario=" . $idfuncuraduria . " and estado_privilegio_curaduria=1");
   $result4pn = $mysqli->query($query4pn);
   $row4pn = $result4pn->fetch_array(MYSQLI_ASSOC);
   $respn = $row4pn['contadorcuraduria'];
   return $respn;
   $result4pn->free();
}


function uploadFileGlobal($file, $ruta, $fileName, $tipoArchivoPermitido, $limite)
{
   $creado = 0;
   $existe = 0;
   if (!file_exists($ruta)) {
      if (mkdir($ruta, 0777, true)) {
         $creado = 1;
      } else {
         echo '<script type="text/javascript">swal(" ERROR !", " Existe error el crear la carpeta en la ruta no existe ' . $ruta . '  !", "error");</script>';
         return;
      }
   } else {
      $existe = 1;
   }

   if ($creado == 1 || $existe == 1) {
      $targetDirectory = $ruta;
      $targetPath = $targetDirectory . $fileName;
      $fileType = strtolower(pathinfo(basename($file['name']), PATHINFO_EXTENSION));
      if (!in_array($fileType, $tipoArchivoPermitido)) {
         $resultArray = '';
         foreach ($tipoArchivoPermitido as $value) {
            $resultArray .= $value . ',';
         }
         echo '<script type="text/javascript">swal(" ERROR !", " Solo archivos de tipo ' . $resultArray . '  !", "error");</script>';
         return;
      }

      $maxFileSize = $limite * 1024 * 1024; // 15MB (ajustar a lo nesecitado)
      if ($file['size'] > $maxFileSize) {
         echo '<script type="text/javascript">swal(" ERROR !", " El tamaño del archivo supera el límite máximo de ' . ($maxFileSize / 1024 / 1024) . ' MB !", "error");</script>';
         return;
      }

      if (file_exists($targetPath)) {
         echo '<script type="text/javascript">swal(" ERROR !", " El archivo ya existe. Cambie el nombre del archivo y vuelva a intentarlo.  !", "error");</script>';
         return;
      }

      if (move_uploaded_file($file['tmp_name'], $targetPath . '.' . $fileType)) {
         return '<script type="text/javascript">swal(" OK !", " Registrado Correctamente  !", "success");</script>';
      } else {
         return '<script type="text/javascript">swal(" ERROR !", "Error al cargar el archivo. Inténtalo de nuevo  !", "error");</script>';
      }
   }
}

function encrypt($data, $key)
{
   $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
   $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
   return base64_encode($encrypted . '::' . $iv);
}

function decrypt($data, $key)
{
   list($encryptedData, $iv) = explode('::', base64_decode($data), 2);
   return openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
}

function cs()
{
   return "F7F3DBE87FB85FBBF9E697FD46411";
}

function gia()
{
   return uniqid();
}

function buscarcampo($table, $campo, $condicion)
{
   global $mysqli;
   $query = "SELECT $campo FROM " . $table . " where $condicion";
   $result = $mysqli->query($query);
   $row = $result->fetch_array(MYSQLI_ASSOC);
   $info = $campo;
   if (0 < count($row)) {
      $nameff = $row[$info];
   } else {
      $nameff = 'No esta parametrizado';
   }
   $result->free();
   return $nameff;
}

function insertarDatos($mysqli, $tabla, $datos)
{
   mysqli_set_charset($mysqli, "utf8");
   // Escapar los datos para evitar inyección de SQL
   foreach ($datos as $campo => $valor) {
      $datos[$campo] = mysqli_real_escape_string($mysqli, $valor);
   }
   // Construir la consulta SQL
   $campos = implode(", ", array_keys($datos));
   $valores = "'" . implode("', '", $datos) . "'";
   $consulta = "INSERT INTO $tabla ($campos) VALUES ($valores)";
   // Ejecutar la consulta
   if (mysqli_query($mysqli, $consulta)) {
      return true;
   } else {
      // echo "Error: " . mysqli_error($mysqli);
      return false;
   }
   $mysqli->free();
   $mysqli->close();
}

function actualizarDatos($mysqli, $tabla, $datos, $condicion)
{
   mysqli_set_charset($mysqli, "utf8");
   // Construir la consulta SQL para actualizar
   $consulta = "UPDATE $tabla SET ";
   foreach ($datos as $campo => $valor) {
      $valor = mysqli_real_escape_string($mysqli, $valor);
      $consulta .= "$campo = '$valor', ";
   }
   $consulta = rtrim($consulta, ', ');
   $consulta .= " WHERE $condicion";
   // Ejecutar la consulta
   if (mysqli_query($mysqli, $consulta)) {
      return true;
   } else {
      // echo "Error: " . mysqli_error($mysqli);
      return false;
   }
   $mysqli->free();
   $mysqli->close();
}

function datecomision($fechaIda, $fechaRegreso)
{
   $fecha1 = new DateTime($fechaIda);
   $fecha2 = new DateTime($fechaRegreso);
   $fechas = $fecha1->diff($fecha2);
   $DiasComisionAntes = $fechas->days;
   $DiasComision = $DiasComisionAntes + 1 - 0.5;
   return $DiasComision;
}

function calcularDiferenciaDias($fecha1, $fecha2)
{
   $timestamp1 = strtotime($fecha1);
   $timestamp2 = strtotime($fecha2);
   $diferenciaSegundos = abs($timestamp2 - $timestamp1);
   $diferenciaDias = floor($diferenciaSegundos / (60 * 60 * 24));
   return $diferenciaDias;
}

function sweetAlert($titulo, $campo, $tipoAlerta)
{
   echo '<script type="text/javascript">swal(" ' . $titulo . ' !", " ' . $campo . '", "' . $tipoAlerta . '");</script>';
}


// REFERENTE A IRIS

function encontrarUsuarioIris($usernameIris, $conexionpostgres)
{
   if ("0" != $usernameIris) {
      $conexionpostgresql = pg_connect($conexionpostgres);
      if (!$conexionpostgresql) {
         echo 'No se puede conectar con IRIS.';
      } else {
         $Query = "SELECT idusuario, nombre, apellido FROM usuario where username='$usernameIris' limit 1";
         $resultadoi = pg_query($conexionpostgresql, $Query);
         $num_resultadosi = pg_num_rows($resultadoi);
         for ($i = 0; $i < $num_resultadosi; $i++) {
            $rowi = pg_fetch_array($resultadoi);
            return array(
               "idusuario" => $rowi['idusuario'],
               "nombre" => $rowi['nombre'],
               "apellido" => $rowi['apellido'],
            );
         }
         pg_free_result($resultadoi);
         pg_close($conexionpostgresql);
      }
   } else {
      return false;
   }
}

function obtenerRadicadoIris($tipoCorrespondencia, $conexionpostgres)
{
   $conexionpostgresql = pg_connect($conexionpostgres);
   if (!$conexionpostgresql) {
      echo 'No se puede conectar con IRIS.';
   } else {
      $anoiris = date("Y");
      $infoiris = 'SNR' . $anoiris . $tipoCorrespondencia;
      $query = "SELECT codigo FROM correspondencia where codigo like '%$infoiris%' order by idcorrespondencia desc limit 1";
      $resultado = pg_query($conexionpostgresql, $query);
      $num_resultados = pg_num_rows($resultado);
      for ($i = 0; $i < $num_resultados; $i++) {
         $row = pg_fetch_array($resultado);
         $info2iris = $row['codigo'];
      }
      $info3iris = explode($anoiris . $tipoCorrespondencia, $info2iris);
      $info4iris = intval($info3iris[1]);
      $info5iris = $info4iris + 1;
      $info6iris = trim(substr('000000' . $info5iris, -6));
      return 'SNR' . $anoiris . $tipoCorrespondencia . $info6iris;
      pg_free_result($resultado);
      pg_close($conexionpostgresql);
   }
}

function crearNuevoIris($usernameIris, $idTipoDocumento, $paraint, $para, $tipoCorrespondencia, $asuntoCorrespondencia, $descripcionCorrespondencia, $conexionpostgres)
{
   $conexionpostgresql = pg_connect($conexionpostgres);
   if (!$conexionpostgresql) {
      echo 'No se puede conectar con IRIS.';
   } else {

      $idUsuarioCreado = 1642; // Id Usuario Sisg
      $encontrarUsuarioIris = encontrarUsuarioIris($usernameIris, $conexionpostgres);
      if (isset($encontrarUsuarioIris['idusuario'])) {
         $deInt = $encontrarUsuarioIris['idusuario'];
         $deNombre = $encontrarUsuarioIris['nombre'];
         $deApellido = $encontrarUsuarioIris['apellido'];
         $radicado_salida = obtenerRadicadoIris($tipoCorrespondencia, $conexionpostgres);
      } else {
         $deInt = 1642;
         $deNombre = 'SISG';
         $deApellido = 'OTI';
         $radicado_salida = obtenerRadicadoIris($tipoCorrespondencia, $conexionpostgres);
      }

      if ('ER' == $tipoCorrespondencia) {
         $recibida = 'true';
         $interno = 'false';
         $idestado = 8; // Radicada
      } else if ('IE' == $tipoCorrespondencia) {
         $recibida = 'false';
         $interno = 'true';
         $idestado = 20; // Interna
      } else if ('EE' == $tipoCorrespondencia) {
         $recibida = 'false';
         $interno = 'false';
         $idestado = 15; // Enviada
      } else {
      }

      $fechairis = date("Y-m-d H:i:s");
      $fechaenvio = date("Y-m-d ") . '00:00:00';
      $textoiris4 = strip_tags($descripcionCorrespondencia);
      $string = preg_replace("/[\r\n|\n|\r]+/", " ", $textoiris4);
      $textoiris = $asuntoCorrespondencia . ': ' . $string;

      $queryIris = sprintf(
         "INSERT INTO correspondencia (
         idcorreoprioridad, 
         idtipodocumento, 
         codigo, 
         referencia, 
         asunto, 
         idestado, 
         idcorreovia, 
         recibida, 
         interna,

         deint, 
         de, 
         paraint, 
         para,  
         folios, 
         anexos, 
         contenido, 
         fechaenvio, 
         fecharecepcion,

         descripcion, 
         creado, 
         fcreado) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s,%s,%s,%s, %s,%s,%s)",
         GetSQLValueString('1', "text"),
         GetSQLValueString($idTipoDocumento, "text"),
         GetSQLValueString($radicado_salida, "text"),
         GetSQLValueString($radicado_salida, "text"),
         GetSQLValueString($asuntoCorrespondencia, "text"),
         GetSQLValueString($idestado, "text"),
         GetSQLValueString('3', "text"),
         GetSQLValueString($recibida, "text"),
         GetSQLValueString($interno, "text"),

         GetSQLValueString('5,' . $deInt . ' ', "text"),
         GetSQLValueString($deNombre . ' ' . $deApellido . ' [USUARIO]', "text"),
         GetSQLValueString('5,' . $paraint . ' ', "text"),
         GetSQLValueString($para . ' / ', "text"),
         GetSQLValueString('1', "text"),
         GetSQLValueString('1', "text"),
         GetSQLValueString('1', "text"),
         GetSQLValueString($fechaenvio, "text"),
         GetSQLValueString($fechairis, "text"),

         GetSQLValueString($textoiris, "text"),
         GetSQLValueString($idUsuarioCreado, "text"),
         GetSQLValueString($fechairis, "text")
      );
      $resultado = pg_query($conexionpostgresql, $queryIris);
      pg_free_result($resultado);
      pg_close($conexionpostgresql);
      return $radicado_salida;
   }
}

function cargarDocumentoIris($radicado, $origen, $conexionpostgres)
{
   $conexionpostgresql = pg_connect($conexionpostgres);
   if (!$conexionpostgresql) {
      echo 'No se puede conectar con IRIS.';
   } else {

      $TipoArchivo = strtolower(pathinfo(basename($origen), PATHINFO_EXTENSION));
      if ('pdf' == $TipoArchivo) {
         // Datos de conexión FTP
         $ftp_server = '192.168.10.22';
         $ftp_user = 'SISG';
         $ftp_pass = 'SISG2018';

         if (isset($radicado)) {
            $query = "SELECT idcorrespondencia FROM correspondencia where codigo like '%$radicado%' order by idcorrespondencia desc limit 1";
            $resultado = pg_query($conexionpostgresql, $query);
            while ($row = pg_fetch_assoc($resultado)) {
               $idcorrespondencia = $row['idcorrespondencia'];
            }
            pg_free_result($resultado);
         }

         if (isset($idcorrespondencia)) {
            // Ruta donde deseas crear la carpeta en el servidor FTP
            $nueva_carpeta = 'Correo/' . $idcorrespondencia . '/Files';

            // Ruta de archivos de origen y destino
            $archivo_origen = $origen;
            // eliminar lo anterior al ultimo /
            $parts = explode('/', $origen);
            array_shift($parts);
            $nombreArchivo = end($parts);
            $archivo_destino = $nueva_carpeta . $nombreArchivo;

            // Conexión FTP
            $conn_id = ftp_connect($ftp_server);
            if (!$conn_id) {
               die("No se pudo conectar al servidor FTP");
            }

            // Iniciar sesión FTP
            $login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);
            if (!$login_result) {
               die("No se pudo iniciar sesión en el servidor FTP");
            }

            // Crear la carpeta en el servidor FTP
            ftp_mkdir($conn_id, $nueva_carpeta);
            exit;

            // Subir el archivo al servidor FTP
            if (ftp_put($conn_id, $archivo_destino, $archivo_origen, FTP_BINARY)) {
               correspondenciaContenidoIris($idcorrespondencia, $nombreArchivo, $conexionpostgres);
            } else {
               die("No se pudo transferir el archivo al servidor FTP\n");
            }

            // Cerrar la conexión FTP
            ftp_close($conn_id);
         }
      }
   }
}

function correspondenciaContenidoIris($idcorrespondencia, $nombreArchivo, $conexionpostgres)
{
   $idUsuarioCreado = 1642; // Id Usuario Sisg
   $dateiris = date("Y-m-d H:i:s");
   $query = sprintf(
      "INSERT INTO correspondenciacontenido (
      idcorrespondencia, 
      idtipodocumento, 
      idsubclasedocumento, 
      indice, 
      upd, 

      mostrar, 
      nombre, 
      extension, 
      dir, 
      pag, 

      crc, 
      audita, 
      fechaaudita, 
      audita2,
      fechaaudita2, 

      creado, 
      fcreado,
      modificado, 
      fmodificado) VALUES (%s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s,%s, %s,%s,%s,%s)",
      GetSQLValueString($idcorrespondencia, "text"),
      GetSQLValueString('0', "text"),
      GetSQLValueString('0', "text"),
      GetSQLValueString('1', "text"),
      GetSQLValueString('0', "text"),

      GetSQLValueString('f', "text"),
      GetSQLValueString($nombreArchivo, "text"),
      GetSQLValueString('Pdf', "text"),
      GetSQLValueString('1', "text"),
      GetSQLValueString('1', "text"),

      GetSQLValueString('', "text"),
      GetSQLValueString('0', "text"),
      GetSQLValueString('', "text"),
      GetSQLValueString('0', "text"),
      GetSQLValueString('', "text"),

      GetSQLValueString($idUsuarioCreado, "text"),
      GetSQLValueString($dateiris, "text"),
      GetSQLValueString('0', "text"),
      GetSQLValueString('', "text")
   );
   $resultado = pg_query($conexionpostgres, $query);
   pg_free_result($resultado);
   pg_close($conexionpostgres);
}

function listaPorCampo($tabla, $valorcampo, $condicion)
{
   global $mysqli;
   $query = "SELECT nombre_" . $tabla . ", $valorcampo FROM " . $tabla . " WHERE $condicion";
   $result = $mysqli->query($query);
   while ($obj = $result->fetch_array()) {
      printf("<option value='%s'>%s</option>\n", $obj[$valorcampo], $obj['nombre_' . $tabla . '']);
   }
   $result->free();
}

function convertirNumeroALetras($numero) {
   $unidad = array('','uno','dos','tres','cuatro','cinco','seis','siete','ocho','nueve');
   $decena = array('','diez','veinte','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa');
   $centena = array('','ciento','doscientos','trescientos','cuatrocientos','quinientos','seiscientos','setecientos','ochocientos','novecientos');

   $valor = '';
   $numero = (float)$numero;
   $decimal = round(($numero - floor($numero)) * 100);
   $entero = floor($numero);

   if ($entero == 0) {
       $valor = 'cero';
   } elseif ($entero == 1) {
       $valor = 'un';
   } elseif ($entero <= 9) {
       $valor = $unidad[$entero];
   } elseif ($entero <= 99) {
       $valor = $decena[floor($entero/10)];
       $valor .= ($entero%10 > 0) ? ' y ' . $unidad[$entero%10] : '';
   } elseif ($entero <= 999) {
       $valor = $centena[floor($entero/100)];
       $valor .= ($entero%100 > 0) ? ' ' . convertirNumeroALetras($entero%100) : '';
   } elseif ($entero <= 999999) {
       $valor = convertirNumeroALetras(floor($entero/1000)) . ' mil';
       $valor .= ($entero%1000 > 0) ? ' ' . convertirNumeroALetras($entero%1000) : '';
   } elseif ($entero <= 999999999) {
       $valor = convertirNumeroALetras(floor($entero/1000000)) . ' millones';
       $valor .= ($entero%1000000 > 0) ? ' ' . convertirNumeroALetras($entero%1000000) : '';
   }

   if ($decimal > 0) {
       $valor .= ($decimal == 1) ? ' con ' . $decimal . ' centavo' : ' con ' . $decimal . ' centavos';
   }

   return $valor;
}

function calcularDiferenciaFechasMesesDias($fechaInicio, $fechaFin) {
   $inicio = new DateTime($fechaInicio);
   $fin = new DateTime($fechaFin);
   $diferencia = $inicio->diff($fin);
   $meses = $diferencia->y * 12 + $diferencia->m;
   $dias = $diferencia->d;
   return array('meses' => $meses, 'dias' => $dias+2);
 }

function auditoriaGeneral($tablaSave, $idFkTabla, $tabla, $idTabla, $accion, $GlobalIdFuncionario, $fechaActual, $conexion)
{
   $query = sprintf(
      "INSERT INTO $tablaSave (
        id_fk_tabla,
        nombre_auditoria,
        id_tabla_auditoria,
        accion_auditoria,
        id_funcionario_auditoria,
        fecha_auditoria) VALUES (%s,%s,%s,%s,%s,%s)",
      GetSQLValueString($idFkTabla, "int"),
      GetSQLValueString($tabla, "text"),
      GetSQLValueString($idTabla, "int"),
      GetSQLValueString($accion, "text"),
      GetSQLValueString($GlobalIdFuncionario, "int"),
      GetSQLValueString($fechaActual, "date")
   );
   mysql_query($query, $conexion) or die(mysql_error());
}
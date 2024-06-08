<?php
class conexion
{
  public function Conectar()
  {
    // variables de conexion SIN
    // define('HOST', '192.168.40.47');
    // define('PORT', '1521');
    // define('NAME', 'PRBASIN1');
    // define('USER', 'snconsol');
    // define('PASS', 'noolvidar1');

    // variable de conexion local
    define('HOST', 'localhost');
    define('PORT', '1521');
    define('NAME', 'xe');
    define('USER', 'System');
    define('PASS', 'sisg');

    $db_settings = "
    (DESCRIPTION =
      (ADDRESS = 
        (PROTOCOL = TCP)
        (HOST = " . HOST . ")
        (PORT = " . PORT . ")
      )
      (CONNECT_DATA =
        (SERVER = DEDICATED)
        (SERVICE_NAME = " . NAME . ")
      )
    ) 
    ";

    try {
      $conexionOracle = new PDO('oci:dbname=' . $db_settings, USER, PASS);
      $conexionOracle->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
      $conexionOracle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $conexionOracle;
    } catch (Exception $e) {
      echo "ERROR DE CONEXION: " . $e->getMessage();
    }
  }
}
// $conexOracle = oci_connect(USER, PASS, $db_settings);
// if (!$conexOracle) {
//   $e = oci_error();
//   trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
// }

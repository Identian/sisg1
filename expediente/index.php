<?php
$idExp = base64_decode(str_pad(strtr($_GET['q'], '-_', '+/'), strlen($_GET['q']) % 4, '=', STR_PAD_RIGHT));
$idnuevoexp = substr($idExp,11);
if (isset($idExp) && "" != $idExp) {
    ini_set('max_execution_time', 10000000);
    session_start();
    require_once('../conf.php');
    global $mysqli;
    $mysqli = new mysqli($hostname_conexion2, $username_conexion, $password_conexion, $database_conexion);
    if (mysqli_connect_errno()) {
        printf("", $mysqli->connect_error);
        exit();
    }
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href='../images/favicon.ico' rel='icon' type='image/x-icon' />
        <title>Sistema Integrado de Servicios y Gestión</title>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>

    <style>
        .enlace {
            font-size: 85%;
        }
    </style>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <br><label>INDICE / DOCUMENTOS</label><br>
                    <?php
                    $query2 = "SELECT * FROM cd_anexos WHERE id_cd_fk_cd_anexos = $idnuevoexp 
                                AND definitivo_cd_anexos=1
                                AND estado_cd_anexos=1 order by posicion_cd_anexos";
                    $result2 = $mysqli->query($query2);
                    while ($obj2 = $result2->fetch_array()) {
                        if (isset($_GET['e']) && $obj2['url_cd_anexos'] == $_GET['e']) {
                            echo '<a href="https://sisg.supernotariado.gov.co/expediente/' . $_GET['q'] . '&' . $obj2['ano_creacion_cd_anexos'] . '&' . $obj2['url_cd_anexos'] . '.jsp" class="btn btn-default btn-xs enlace">' . $obj2['nombre_cd_anexos'] . '</a><br>';
                        } else {
                            echo '<a href="https://sisg.supernotariado.gov.co/expediente/' . $_GET['q'] . '&' . $obj2['ano_creacion_cd_anexos'] . '&' . $obj2['url_cd_anexos'] . '.jsp" class="btn btn-default btn-xs enlace">' . $obj2['nombre_cd_anexos'] . '</a><br>';
                        }
                    }
                    $result2->free();
                    ?>
                </div>
                <div class="col-md-10">
                    <?php
                    if (isset($_GET['i']) && "" != $_GET['i'] && isset($_GET['e']) && "" != $_GET['e']) {
                        $uri = $_GET['i'] . '/' . $_GET['e'] . '.pdf';
                    ?>
                        <iframe src="https://sisg.supernotariado.gov.co/filesnr/sid/<?php echo $uri; ?>" style="width:100%;min-height:1024px"></iframe>
                    <?php } else {
                    } ?>
                </div>
            </div>
        </div>
    </body>
    </html>
<?php } else {
} ?>
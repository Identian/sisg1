<?php
if (1==$_SESSION['rol'] and isset($_GET["i"])){
	
if (isset($_GET['i'])) {
	$id=$_GET['i'];
} else {
	$id=0;
}

} else {
$id=$_SESSION['id_vigilado'];
$salida=privilegiosnotariado($id, 9, $_SESSION['snr']);
}



IF ((3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) 
	or 1==$_SESSION['rol']  or  0<$salida) { 




if ((isset($_POST["id_tipo_poder"])) && (""!=$_POST["id_tipo_poder"])) { 

$idmen=$_POST["identificacion_menor"];
$fechasalida=$_POST["fecha_salida"];

$querynb = sprintf("SELECT count(id_salida_menor) as rep FROM salida_menor where id_notaria=".$id." and identificacion_menor='$idmen' and fecha_salida='$fechasalida' and estado_salida_menor=2");
$selectnb = mysql_query($querynb, $conexion);
$rownb = mysql_fetch_assoc($selectnb);
if (0<$rownb['rep']) {
	echo $repetido;
} else {




$select = mysql_query("SELECT codigo_dane, nombre_notaria, email_notaria, nombre_municipio, nombre_funcionario, nombre_departamento FROM departamento, notaria, municipio, funcionario, posesion_notaria 
WHERE funcionario.id_cargo=1 AND funcionario.id_tipo_oficina=3 AND posesion_notaria.id_funcionario=funcionario.id_funcionario and estado_funcionario=1 
and estado_posesion_notaria=1 AND fecha_fin is null AND notaria.id_notaria=posesion_notaria.id_notaria AND departamento.id_departamento=notaria.id_departamento and
notaria.id_departamento=municipio.id_departamento AND notaria.codigo_municipio=municipio.codigo_municipio and notaria.id_notaria=".$id." and estado_notaria=1  limit 1", $conexion);
$row = mysql_fetch_assoc($select);
$codigo_dane=$row['codigo_dane'];
$nombre_notaria=$row['nombre_notaria'];
$nombre_municipio=$row['nombre_municipio'];
$email_notaria=$row['email_notaria'];
$nombre_funcionario=$row['nombre_funcionario'];
$nombre_departamento=$row['nombre_departamento'];
//$=$row[''];
mysql_free_result($select);

$dup = rand(10, 99);

$identificador=$codigo_dane.$identi.$dup;

$directoryftp='files/salidas/'.$identificador.'/';

mkdir($directoryftp, 0777, true);

	
	
	
	
	
$tamano_archivo=11534336;
//$formato_archivo = array('jpg', 'pdf', 'png', 'csv', 'xls', 'xlsx', 'doc', 'ppt', 'pptx', 'docx', 'rtf');
$formato_archivo = array('pdf');



	 
$archivo = $_FILES['file_autenticacion']['tmp_name'];
$tam_archivo= filesize($archivo);
$tam_archivo2= $_FILES['file_autenticacion']['size'];
$nombrefile = strtolower($_FILES['file_autenticacion']['name']);
//echo '<script>alert("'.$nombrefile.'");</script>';
$info = pathinfo($nombrefile); 

$extension=$info['extension'];

$array_archivo = explode('.',$nombrefile);
$extension2= end($array_archivo);

//echo $tam_archivo;
//echo $tam_archivo2;



if ($tamano_archivo>=intval($tam_archivo2)) {
	
if (($extension2==$extension) && $extension=='pdf') { 
  $files = 'auto'.$identificador.'.'.$extension;
  $mover_archivos = move_uploaded_file($archivo, $directoryftp.$files);
  //chmod($files,0777);
  //$nombrebre_orig= ucwords($nombrefile);
  
   
   
$file_civil = strtolower($_FILES['file_civil']['name']);
$infofile_civil = pathinfo($file_civil); 
$extensionfile_civil=$infofile_civil['extension'];

   
   
if (isset($_FILES['file_civil']['name']) && ""!=$_FILES['file_civil']['name'] && 'pdf'==$extensionfile_civil) {

   $archivoc = $_FILES['file_civil']['tmp_name'];
 $filesc = 'civil'.$identificador.'.pdf';
  $mover_archivos = move_uploaded_file($archivoc, $directoryftp.$filesc);
 
 
   
   
   if (3==$_POST["id_tipo_poder"]) {
$numero_escritura=$_POST["numero_escritura"];
$fecha_escritura=$_POST["fecha_escritura"];
} else if (4==$_POST["id_tipo_poder"]) {
$numero_escritura=$_POST["numero_escritura2"];
$fecha_escritura=$_POST["fecha_escritura2"];
	} else { 
	
	}





$insertSQL = sprintf("INSERT INTO salida_menor (identificador_sm, id_notaria, id_funcionario, id_tipo_poder, fecha_poder, id_tipo_autorizacion_salida, 
numero_escritura, fecha_escritura,  fecha_escritura_vigencia, hora_vigencia, 
id_tipo_custodia, id_tipo_documento_menor, identificacion_menor, nombre_menor, id_tipo_documento_padre, identificacion_padre, nombre_padre, 
id_tipo_documento_madre, identificacion_madre, nombre_madre, sale_dif_padres, id_tipo_documento_psale, identificacion_psale, nombre_psale, 
fecha_salida, fecha_salida_hasta, nombre_salida_menor, id_pais, fecha_retorno, fecha_retorno_hasta, motivo_noretorno, file_autenticacion, 
file_civil, fecha_carga, correo_solicitante, estado_salida_menor) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(), %s, %s)", 
GetSQLValueString($identificador, "text"), 
GetSQLValueString($id, "int"), 
GetSQLValueString($_SESSION['snr'], "int"), 
GetSQLValueString($_POST["id_tipo_poder"], "int"), 
GetSQLValueString($_POST["fecha_poder"], "date"), 
GetSQLValueString($_POST["id_tipo_autorizacion_salida"], "int"),
GetSQLValueString($numero_escritura, "text"),
GetSQLValueString($fecha_escritura, "date"),
GetSQLValueString($_POST["fecha_escritura_vigencia"], "date"),
GetSQLValueString($_POST["hora_vigencia"], "text"),
GetSQLValueString($_POST["id_tipo_custodia"], "int"), 
GetSQLValueString($_POST["id_tipo_documento_menor"], "int"), 
GetSQLValueString($_POST["identificacion_menor"], "text"), 
GetSQLValueString($_POST["nombre_menor"], "text"), 
GetSQLValueString($_POST["id_tipo_documento_padre"], "int"), 
GetSQLValueString($_POST["identificacion_padre"], "text"), 
GetSQLValueString($_POST["nombre_padre"], "text"), 
GetSQLValueString($_POST["id_tipo_documento_madre"], "int"), 
GetSQLValueString($_POST["identificacion_madre"], "text"), 
GetSQLValueString($_POST["nombre_madre"], "text"), 
GetSQLValueString($_POST["sale_dif_padres"], "int"), 
GetSQLValueString($_POST["id_tipo_documento_psale"], "int"), 
GetSQLValueString($_POST["identificacion_psale"], "text"), 
GetSQLValueString($_POST["nombre_psale"], "text"), 
GetSQLValueString($_POST["fecha_salida"], "date"), 
GetSQLValueString($_POST["fecha_salida_hasta"], "date"), 
GetSQLValueString($_POST["nombre_salida_menor"], "text"),
GetSQLValueString($_POST["id_pais"], "int"), 
GetSQLValueString($_POST["fecha_retorno"], "date"), 
GetSQLValueString($_POST["fecha_retorno_hasta"], "date"), 
GetSQLValueString($_POST["motivo_noretorno"], "text"), 
GetSQLValueString($files, "text"), 
GetSQLValueString($filesc, "text"), 
GetSQLValueString($_POST['correo'], "text"),
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion);

mysql_free_result($insertSQL);
//echo $insertado;
echo '<script type="text/javascript">swal(" OK !", " Código de verificación: '.$identificador.'.  - RECUERDE INFORMARLO POR ESCRITO AL CIUDADANO. -", "success");</script>';



$emailu=$_POST["correo"]; 
$subject = 'Permiso de salida de un menor';
$cuerpo = ''; 
$cuerpo .= "<div style='background:#f2f2f2;'><br><div style='margin: 0 auto;background:#fff;max-width:650px;width:100%;padding: 10px 10px 10px 10px;'><img src='https://servicios.supernotariado.gov.co/images/snr_2023.jpg'>";
$cuerpo .= "Se ha generado un nuevo registro de permiso de salida de un menor identificado con el código:"; 
$cuerpo .= "<br><br>"; 
$cuerpo .= $identificador;

$cuerpo .= "<br><br>"; 
$cuerpo .= "Puede verificar la información en la siguiente dirección web:"; 
$cuerpo .= "<br><br>"; 
$cuerpo .= '<a href="https://servicios.supernotariado.gov.co/salida&'.$identificador.'.html">https://servicios.supernotariado.gov.co/salida&'.$identificador.'.html</a>';

$cuerpo .= '<br><br><br>Superintendencia de Notariado y Registro<br>';
$cuerpo .= "<br></div><br></div>"; 
$cabeceras ='';
$cabeceras .= 'From: Supernotariado<notificadorD@supernotariado.gov.co>' . "\r\n";
//$cabeceras .= 'Bcc: sisg@supernotariado.gov.co' . "\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($emailu,$subject,$cuerpo,$cabeceras);





if (3==$_POST["id_tipo_poder"] or 4==$_POST["id_tipo_poder"]) {
$infopais='<Destino>No aplica por ser escritura pública</Destino>';
} else {
$selectr = mysql_query("select nombre_pais from pais where id_pais=".$_POST["id_pais"]." and estado_pais=1", $conexion);
$rowr = mysql_fetch_assoc($selectr);
$nombre_pais= $rowr['nombre_pais'];
mysql_free_result($selectr);
$infopais='<Destino>'.$nombre_pais.'</Destino>';		
}


if (1==$_POST["retorno"]){
$inforetorno='<FechaRegresoMenoresDesde>'.$_POST["fecha_retorno"].'</FechaRegresoMenoresDesde>
    <FechaRegresoMenoresHasta>'.$_POST["fecha_retorno_hasta"].'</FechaRegresoMenoresHasta>';
} else {
$inforetorno='<FechaRegresoMenoresDesde>0000-00-00</FechaRegresoMenoresDesde>
    <FechaRegresoMenoresHasta>0000-00-00</FechaRegresoMenoresHasta>';		
}


if (1==$_POST["id_tipo_autorizacion_salida"]) {
	$solicitante='<NombrePersonaNatural>'.$_POST["nombre_padre"].'</NombrePersonaNatural>  
      <TipoDocumentoIdentidad>'.sigladoc($_POST["id_tipo_documento_padre"]).'</TipoDocumentoIdentidad>  
      <NumeroDocumentoIdentidad>'.$_POST["identificacion_padre"].'</NumeroDocumentoIdentidad>';
	  $solicitantecc=$_POST["nombre_padre"].' '.sigladoc($_POST["id_tipo_documento_padre"]).$_POST["identificacion_padre"];
	  
} else if (2==$_POST["id_tipo_autorizacion_salida"]) {
		$solicitante='<NombrePersonaNatural>'.$_POST["nombre_madre"].'</NombrePersonaNatural>  
      <TipoDocumentoIdentidad>'.sigladoc($_POST["id_tipo_documento_madre"]).'</TipoDocumentoIdentidad>  
      <NumeroDocumentoIdentidad>'.$_POST["identificacion_madre"].'</NumeroDocumentoIdentidad>';
	   $solicitantecc=$_POST["nombre_madre"].' '.sigladoc($_POST["id_tipo_documento_madre"]).$_POST["identificacion_madre"];
	   
} else if (3==$_POST["id_tipo_autorizacion_salida"]) {
		$solicitante='<NombrePersonaNatural>'.$_POST["nombre_psale"].'</NombrePersonaNatural>  
      <TipoDocumentoIdentidad>'.sigladoc($_POST["id_tipo_documento_psale"]).'</TipoDocumentoIdentidad>  
      <NumeroDocumentoIdentidad>'.$_POST["identificacion_psale"].'</NumeroDocumentoIdentidad>';
	   $solicitantecc=$_POST["nombre_psale"].' '.sigladoc($_POST["id_tipo_documento_psale"]).$_POST["identificacion_psale"];
} else {
	$solicitante='<NombrePersonaNatural>0</NombrePersonaNatural>  
      <TipoDocumentoIdentidad>0</TipoDocumentoIdentidad>  
      <NumeroDocumentoIdentidad>0</NumeroDocumentoIdentidad>';
	   $solicitantecc='';
}

$hora= date("h:i:s A");
$fecha_sal= date("Y-m-d h:i:s A");
$fecha_doc= date("Y/m/d");
$doc_menor=sigladoc($_POST["id_tipo_documento_menor"]);

$doc_padre=sigladoc($_POST["id_tipo_documento_padre"]);

$doc_madre=sigladoc($_POST["id_tipo_documento_madre"]);

$doc_psale=sigladoc($_POST["id_tipo_documento_psale"]);




if (isset($_POST["identificacion_padre"]) && ""!=$_POST["identificacion_padre"]) {
	 $datos_padre='<TipoDocumento>'.$doc_padre.'</TipoDocumento>
      <NumeroDocumento>'.$_POST["identificacion_padre"].'</NumeroDocumento>';
} else {
	  $datos_padre='<TipoDocumento>x</TipoDocumento>
      <NumeroDocumento>0</NumeroDocumento>';
}


if (isset($_POST["identificacion_madre"]) && ""!=$_POST["identificacion_madre"]) {
      $datos_madre='<TipoDocumento>'.$doc_madre.'</TipoDocumento>
      <NumeroDocumento>'.$_POST["identificacion_madre"].'</NumeroDocumento>';
} else {
      $datos_madre='<TipoDocumento>x</TipoDocumento>
      <NumeroDocumento>0</NumeroDocumento>';
}


if (1==intval($_POST["sale_dif_padres"])) {
      $datos_psale='<TipoDocumento>'.$doc_psale.'</TipoDocumento>
      <NumeroDocumento>'.$_POST["identificacion_psale"].'</NumeroDocumento>';
} else {
      $datos_psale='<TipoDocumento>x</TipoDocumento>
      <NumeroDocumento>0</NumeroDocumento>';
}


	  
	  

$content = '<?xml version="1.0" encoding="UTF-8"?>

<GestionDocumental> 
  <Entidad>NOTARIA '.$nombre_notaria.'</Entidad>  
  <Dependencia>SNR</Dependencia>  
  <Pais>COLOMBIA</Pais>  
  <Departamento-Estado>'.$nombre_departamento.'</Departamento-Estado>  
  <Ciudad-Municipio>'.$nombre_municipio.'</Ciudad-Municipio>  
  <TipoDocumento>PODER - AUTORIZACION SALIDA MENOR</TipoDocumento>  
  <SolicitadoPor> 
    <PersonaNatural>
	'.$solicitante.'
    </PersonaNatural> 
  </SolicitadoPor>  
  <ElaboradoPor> 
    <FechaHoraElaboradoPor>'.$fecha_sal.'</FechaHoraElaboradoPor>  
    <Funcionario> 
      <NombreFuncionario>'.$nombre_funcionario.'</NombreFuncionario>  
      <DependenciaFuncionario>'.$nombre_municipio.'</DependenciaFuncionario>  
      <CargoFuncionario>Notario - '.$nombre_notaria.'</CargoFuncionario>  
      <CorreoElectronicoFuncionario>'.$email_notaria.'</CorreoElectronicoFuncionario> 
    </Funcionario> 
  </ElaboradoPor>  
  <AprobadoPor> 
    <FechaHoraAprobadoPor>'.$_POST["fecha_poder"].' '.$hora.'</FechaHoraAprobadoPor>  
    <Funcionario> 
      <NombreFuncionario>'.$nombre_funcionario.'</NombreFuncionario>  
      <DependenciaFuncionario>'.$nombre_municipio.'</DependenciaFuncionario>  
      <CargoFuncionario>Notario - '.$nombre_notaria.'</CargoFuncionario>  
      <CorreoElectronicoFuncionario>'.$email_notaria.'</CorreoElectronicoFuncionario> 
    </Funcionario> 
  </AprobadoPor>  
  <FirmadoPor> 
    <FechaHoraFirmadoPor>'.$fecha_sal.'</FechaHoraFirmadoPor>  
    <Funcionario> 
      <NombreFuncionario>'.$nombre_funcionario.'</NombreFuncionario>  
      <DependenciaFuncionario>'.$nombre_municipio.'</DependenciaFuncionario>  
      <CargoFuncionario>Notario - '.$nombre_notaria.'</CargoFuncionario>  
      <CorreoElectronicoFuncionario>'.$email_notaria.'</CorreoElectronicoFuncionario> 
    </Funcionario> 
  </FirmadoPor>  
  <EmitidoaNombreDe> 
    <PersonaNatural>'.$solicitante.'
	</PersonaNatural> 
  </EmitidoaNombreDe>  
  <FechaHoraDocumento>'.$fecha_sal.'</FechaHoraDocumento>  
  <Asunto>RECONOCIMIENTOS</Asunto>  
  <TituloDocumento>REC. DE FIRMA AUTORIZACION SALIDA MENOR '.$solicitantecc.'</TituloDocumento>  
  <PalabrasClaves/>  
  <SistemaDeInformacion>Vicky - Superintendencia de Notariado y Registro</SistemaDeInformacion>  
  <ExpedientesElectronico> 
    <CodigoExpediente>'.$identificador.'</CodigoExpediente>  
    <DescripcionExpediente>'.$identificador.'</DescripcionExpediente> 
  </ExpedientesElectronico>  
  <MesesVigenciaDocumentoSegunNaturaleza>3</MesesVigenciaDocumentoSegunNaturaleza>  
  <Apostilla>
    <RazonSocialOrganizacion>SUPERINTENDENCIA DE NOTARIADO Y REGISTRO</RazonSocialOrganizacion>
    <IdAutoridad>'.$codigo_dane.'</IdAutoridad>
    <CodDocumento>Nit 899.999.007-0</CodDocumento>
    <Tratamiento>1</Tratamiento>
    <NumDocumento>'.$identificador.'</NumDocumento>
    <FechaDocumento>'.$fecha_doc.'</FechaDocumento>
    <VigenciaDocumento/>
    <NomTitularDocumento>'.$_POST["nombre_menor"].'</NomTitularDocumento>
    <NomCampoFirmaDigital>0</NomCampoFirmaDigital>
    <CorreoElectronico>0</CorreoElectronico>
    <CantidadHojas>1</CantidadHojas>
  </Apostilla>
  <Migracion>
    <Menores>
      <Menor>
        <TipoDocumento>'.$doc_menor.'</TipoDocumento>
        <NumeroDocumento>'.$_POST["identificacion_menor"].'</NumeroDocumento>
        <NombresApellidos>'.$_POST["nombre_menor"].'</NombresApellidos>
      </Menor>
    </Menores>
    <Tipo>RECONOCIMIENTO</Tipo>
    <FechaSalidaMenoresDesde>'.$_POST["fecha_salida"].'</FechaSalidaMenoresDesde>
    <FechaSalidaMenoresHasta>'.$_POST["fecha_salida_hasta"].'</FechaSalidaMenoresHasta>
    '.$inforetorno.'
    <DestinosMenores>
      '.$infopais.'
    </DestinosMenores>
    <PropositoViaje>'.$_POST["nombre_salida_menor"].'</PropositoViaje>
    <Madre>
       '.$datos_madre.'
    </Madre>
    <Padre>
      '.$datos_padre.'
    </Padre>
    <RepresentanteLegal>
      <TipoDocumento/>
      <NumeroDocumento/>
    </RepresentanteLegal>
    <Acompanante>
	'.$datos_psale.'
    </Acompanante>
  </Migracion>
</GestionDocumental>
';



$fp = fopen($directoryftp."AutoDocumentacion.txt", "w");
fwrite($fp,$content);
fclose($fp);



/////////////////////

//$directoryftp='files/salidas/'.$identificador.'/';


$txt=$directoryftp.'AutoDocumentacion.txt';
$autenticacion=$directoryftp.'auto'.$identificador.'.pdf';
$civil=$directoryftp.'civil'.$identificador.'.pdf';
$fecha_sal= date("Y-m-d");



$selectraap = mysql_query("select nombre_tipo_poder from tipo_poder where id_tipo_poder=".intval($_POST["id_tipo_poder"])." and estado_tipo_poder=1", $conexion);
$rowraap = mysql_fetch_assoc($selectraap);
$nombre_tipo_poder= $rowraap['nombre_tipo_poder'];
mysql_free_result($selectraap);

$selectraa = mysql_query("select nombre_tipo_autorizacion_salida from tipo_autorizacion_salida where id_tipo_autorizacion_salida=".intval($_POST["id_tipo_autorizacion_salida"])." and estado_tipo_autorizacion_salida=1", $conexion);
$rowraa = mysql_fetch_assoc($selectraa);
$nombre_tipo_autorizacion_salida= $rowraa['nombre_tipo_autorizacion_salida'];
mysql_free_result($selectraa);



$selectraac = mysql_query("select nombre_tipo_custodia from tipo_custodia where id_tipo_custodia=".$_POST["id_tipo_custodia"]." and estado_tipo_custodia=1", $conexion);
$rowraac = mysql_fetch_assoc($selectraac);
$nombre_tipo_custodia= $rowraac['nombre_tipo_custodia'];
mysql_free_result($selectraac);


$proposito=substr ($_POST["nombre_salida_menor"], 0, 57); 


//$qr='https://sisg.supernotariado.gov.co/qrcode/salidas&'.$identificador.'.gif';
//$qr='qrcode/salida&'.$identificador.'.gif';
$qr='https://sisg.supernotariado.gov.co/qrcode/salida&'.$identificador.'.gif';


/*
require('fpdf/attachment.php');
$pdf = new PDF_Attachment();
$pdf->Attach($txt);
$pdf->Attach($autenticacion);
if (isset($filesc) && $filesc!='') {
$pdf->Attach($civil);
} else {}
$pdf->OpenAttachmentPane();
*/


require('fpdf/fpdf.php');
$pdf = new FPDF();


$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$pdf->image('images/cabezotesnr-2019.jpg',12,13,182);
$pdf->image('images/footer-snr-2019.jpg',12,265,182);
//$pdf->image('images/qrsnr.png',160,40,30);
//$pdf->Image('https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='.$identificador.'',160,40,30,0,'PNG');
$pdf->Image(''.$qr.'',160,40,30,0,'GIF');
$pdf->Text(17,50,utf8_decode("SUPERINTENDENCIA DE NOTARIADO Y REGISTRO"));
$pdf->Text(17,55,utf8_decode("AUTORIZACIÓN DE SALIDA DE MENOR"));
$pdf->Text(17,60,utf8_decode("IDENTIFICADOR: ".$identificador));
$pdf->Text(17,65,utf8_decode("FECHA DE CREACIÓN: ".$fecha_sal));
$pdf->Text(17,80,utf8_decode("----------------------------------------------------------------------------------------------------------------------------------------------------"));

$pdf->Text(17,95,utf8_decode("Resumen de la información reportada por el Notario de conformidad con lo contemplado en el artículo 110 de la"));
$pdf->Text(17,100,utf8_decode("Ley 1098 del 2006, Decreto 960 de 1970 y Decreto 1260 de 1970."));

$pdf->Text(17,115,utf8_decode("Código de la Notaria: ".$codigo_dane));
$pdf->Text(17,120,utf8_decode("Notaria: ".$nombre_notaria));
$pdf->Text(17,125,utf8_decode("Departamento: ".$nombre_departamento));
$pdf->Text(17,130,utf8_decode("Municipio: ".$nombre_municipio));
$pdf->Text(17,135,utf8_decode("Email: ".$email_notaria));
//$pdf->Text(17,140,utf8_decode("Nombre del Notario(a): ".$nombre_funcionario));
$pdf->Text(17,140,utf8_decode("Email del solcitante: ".$_POST["correo"]));




$pdf->Text(17,145,utf8_decode("Fecha de la autorización: ".$_POST["fecha_poder"]));
$pdf->Text(17,150,utf8_decode("Tipo de autorización: ".$nombre_tipo_poder));
$pdf->Text(17,155,utf8_decode("Solicitante u otorgante: ".$nombre_tipo_autorizacion_salida));


if (3==intval($_POST["id_tipo_poder"])) {
$pdf->Text(17,160,utf8_decode("Número de escritura: ".$_POST["numero_escritura"]));
$pdf->Text(17,165,utf8_decode("Fecha de la escritura: ".$_POST["fecha_escritura"]));

} else if (4==intval($_POST["id_tipo_poder"])) {
$pdf->Text(17,160,utf8_decode("Número de escritura: ".$_POST["numero_escritura2"].", Fecha de certificado vigencia: ".$_POST["fecha_escritura_vigencia"]));
$pdf->Text(17,165,utf8_decode("Fecha de la escritura: ".$_POST["fecha_escritura2"].", Hora del certificado: ".$_POST["hora_vigencia"]));

} else { 
$pdf->Text(17,160,utf8_decode("Número de escritura: No aplica"));
$pdf->Text(17,165,utf8_decode("Fecha de la escritura: No aplica"));
}

$pdf->Text(17,170,utf8_decode("Tipo de custodia: ".$nombre_tipo_custodia));
$pdf->Text(17,175,utf8_decode("Tipo de documento del menor: ".$doc_menor));
$pdf->Text(17,180,utf8_decode("Número de identificación: ".$_POST["identificacion_menor"]));
$pdf->Text(17,185,utf8_decode("Nombre del menor: ".$_POST["nombre_menor"]));

if (isset($_POST["identificacion_padre"]) && ""!=$_POST["identificacion_padre"]) {
$pdf->Text(17,190,utf8_decode("Tipo de documento del padre: ".$doc_padre));
$pdf->Text(17,195,utf8_decode("Número de identificación: ".$_POST["identificacion_padre"]));
$pdf->Text(17,200,utf8_decode("Nombre del padre: ".$_POST["nombre_padre"]));
} else {
$pdf->Text(17,190,utf8_decode("Tipo de documento del padre: No registro"));
$pdf->Text(17,195,utf8_decode("Número de identificación: No registro"));
$pdf->Text(17,200,utf8_decode("Nombre del padre: No registro"));
}

if (isset($_POST["identificacion_madre"]) && ""!=$_POST["identificacion_madre"]) {
$pdf->Text(17,205,utf8_decode("Tipo de documento de la madre: ".$doc_madre));
$pdf->Text(17,210,utf8_decode("Número de identificación: ".$_POST["identificacion_madre"]));
$pdf->Text(17,215,utf8_decode("Nombre de la madre: ".$_POST["nombre_madre"]));
} else {
$pdf->Text(17,205,utf8_decode("Tipo de documento de la madre: No registro"));
$pdf->Text(17,210,utf8_decode("Número de identificación: No registro"));
$pdf->Text(17,215,utf8_decode("Nombre de la madre: No registro"));
}


if (1==intval($_POST["sale_dif_padres"])) {
$pdf->Text(17,220,utf8_decode("Sale del pais con una persona diferente a los padres: Si"));
$pdf->Text(17,225,utf8_decode("Tipo de documento de la persona que sale con el menor: ".$doc_psale));
$pdf->Text(17,230,utf8_decode("Número de identificación: ".$_POST["identificacion_psale"]));
$pdf->Text(17,235,utf8_decode("Nombre de la persona que sale con el menor: ".$_POST["nombre_psale"]));
}else if (0==intval($_POST["sale_dif_padres"])) {
$pdf->Text(17,220,utf8_decode("Sale del pais con una persona diferente a los padres: No"));
$pdf->Text(17,225,utf8_decode("x"));
$pdf->Text(17,230,utf8_decode("x"));
$pdf->Text(17,235,utf8_decode("x"));
}else if (2==intval($_POST["sale_dif_padres"])) {
$pdf->Text(17,220,utf8_decode("Sale del pais con una persona diferente a los padres: SI"));
$pdf->Text(17,225,utf8_decode("Viaja con personal de la aerolinea o empresa de transporte."));
$pdf->Text(17,230,utf8_decode("x"));
$pdf->Text(17,235,utf8_decode("x"));
} else {
$pdf->Text(17,220,utf8_decode("Sale del pais con una persona diferente a los padres: No"));
$pdf->Text(17,225,utf8_decode("x"));
$pdf->Text(17,230,utf8_decode("x"));
$pdf->Text(17,235,utf8_decode("x"));
}




$pdf->Text(17,240,utf8_decode("Fecha de salida: ".$_POST["fecha_salida"].' / '.$_POST["fecha_salida_hasta"]));
$pdf->Text(17,245,utf8_decode("Proposito: ".$proposito));
if (1==$_POST["id_tipo_poder"]) {
$pdf->Text(17,250,utf8_decode("Pais: ".$nombre_pais));
$pdf->Text(17,255,utf8_decode("Fecha de retorno: ".$_POST["fecha_retorno"]." - ".$_POST["fecha_retorno_hasta"]));
} else {}

//$pdf->Text(17,270,utf8_decode("SUPERINTENDENCIA DE NOTARIADO Y REGISTRO, Calle 26 #13-49 Interior 201, Conmutador: +571 3282121"));





//$pdf->Write(5,'xxxx');
//$pdf->Output();


$pdf->Output('F', $directoryftp.$identificador.'.pdf', true);

//$ruta=$directoryftp.$identificador.'.pdf';
//$b64Doc = base64_encode(file_get_contents($ruta));  //chunk_split

//$updateSQL = "UPDATE salida_menor SET base64='$b64Doc' where identificador_sm='$identificador' limit 1";
//$Result = mysql_query($updateSQL, $conexion) or die(mysql_error());


chmod($directoryftp.$identificador.'.pdf',0777);


?>
<!--
<script>
  
    function ws() {
        	 var salida ="<?php //echo $identificador; ?>";
			//alert(salida);
                        jQuery.ajax({
                                type: "POST",url: "http://192.168.210.131:8084/index.php",
								data: "iden="+salida,
								async: true,
                                success: function(b) {
                                       jQuery("#id2").html(b);
										//var Var_JavaScript = b;
										
										//document.writeln(Var_JavaScript);
                                }
                        });				
    }
    //setInterval(ws, 3000);
	setTimeout(ws, 2000);
	
	
</script>
-->
<?php 


  } else {
	$filesc='';
	  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Se debe anexar el registro civil en formato pdf.</div>';
    }


  } else {
$files='';	  
  echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>El formato del archivo adjunto no es permitido, debe ser PDF.</div>';
  }
} else { 
$files='';	
 echo '<div class="alert aviso" style="background:#f99898;color:#bc0d0d;" role="alert"><a href="" class="close cerrar" style="text-decoration:none;">&times;</a>Operación fallida, El archivo supera los 10 Megas permitidos.</div>';
		}
		
		
} 

mysql_free_result($selectnb);

}



?>


<script>
function fileValidation(){
    var fileInput = document.getElementById('file_autenticacion'); 
	var file = fileInput.files[0].size;

 if (file < 5000000)  {
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
    if(!allowedExtensions.exec(filePath)){
        alert('Unicamente se permite archivos pdf');
        fileInput.value = '';
        return false;
    }else{

    }
} else {
	alert('El archivo debe tener un tamaño menor a 5 Mb.');
	document.getElementById('file_autenticacion').value='';
	return false;
}
}
//////////////////////
function fileValidationcivil(){
    var fileInput = document.getElementById('file_civil'); 
	var file = fileInput.files[0].size;

 if (file < 5000000)  {
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
	
    if(!allowedExtensions.exec(filePath)){
        alert('Unicamente se permite archivos pdf');
        fileInput.value = '';
        return false;
    }else{

    }
} else {
	alert('El archivo debe tener un tamaño menor a 5 Mb.');
	document.getElementById('file_civil').value='';
	return false;
}
}
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header"> 
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                   <h4 class="modal-title" id="myModalLabel"><b>SALIDA DE MENORES</b></h4>
              </div> 
              <div id="nuevaAventura" class="modal-body"> 

<form action="" method="POST" name="fo4434r4324546456456m1" enctype="multipart/form-data" >
				       
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE AUTORIZACIÓN DE LA SALIDA DEL MENOR:</label> 
<select  class="form-control" name="id_tipo_poder" id="id_tipo_poder" required>
<option value="" selected></option>
<?php echo lista('tipo_poder'); ?>
</select>
</div>

<div id="escritura" style="display:none;"> 
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RELACIONAR LOS DATOS DE LA ESCRITURA:</label> 
<div class="input-group">
<span class="input-group-addon"><span style="color:#ff0000;">*</span> # Escritura</span>
<input type="text"  class="mayuscula" name="numero_escritura" id="numero_escritura" value="" >
<span class="input-group-addon"><span style="color:#ff0000;">*</span> Fecha</span>


<?php if (2==1) {  ?>
	<input type="date" name="fecha_escritura" id="fecha_escritura" readonly="readonly" value="">
<?php } else { ?>
	<input type="text" class="datepicker" name="fecha_escritura" id="fecha_escritura" readonly="readonly" value="">
<?php  } ?>

	  </div>
</div>
</div>



<div id="vigenciaescritura" style="display:none;"> 
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> RELACIONAR LOS DATOS DE LA VIGENCIA ESCRITURA:</label> 
<div class="input-group">
<span class="input-group-addon"><span style="color:#ff0000;">*</span> # Escritura</span>
<input type="text"  class="mayuscula" name="numero_escritura2" id="numero_escritura2" value="" >
<span class="input-group-addon"><span style="color:#ff0000;">*</span> Fecha E.</span>

<?php if (2==1) {  ?>
	<input type="date" name="fecha_escritura2" id="fecha_escritura2" readonly="readonly" value="">
<?php } else { ?>
	<input type="text" class="datepicker" name="fecha_escritura2" id="fecha_escritura2" readonly="readonly" value="">
<?php  } ?>



</div>
	  
	  
<div class="input-group">
<span class="input-group-addon"><span style="color:#ff0000;">*</span> Fecha del certificado 





<?php if (2==1) {  ?>
<input type="date" name="fecha_escritura_vigencia" id="fecha_escritura_vigencia" readonly="readonly" value="">
<?php } else { ?>
<input type="text" class="datepicker" name="fecha_escritura_vigencia" id="fecha_escritura_vigencia" readonly="readonly" value="">
<?php  } ?>

</span>
<span class="input-group-addon"><span style="color:#ff0000;">*</span> Hora
<select  name="hora_vigencia" id="hora_vigencia" style="width:90px;">
<option value="" selected=""></option>
<option value="00:00:00">00:00:00</option>
<option value="00:15:00">00:15:00</option>
<option value="00:30:00">00:30:00</option>
<option value="00:45:00">00:45:00</option>
<option value="01:00:00">01:00:00</option>
<option value="01:15:00">01:15:00</option>
<option value="01:30:00">01:30:00</option>
<option value="01:45:00">01:45:00</option>
<option value="02:00:00">02:00:00</option>
<option value="02:15:00">02:15:00</option>
<option value="02:30:00">02:30:00</option>
<option value="02:45:00">02:45:00</option>
<option value="03:00:00">03:00:00</option>
<option value="03:15:00">03:15:00</option>
<option value="03:30:00">03:30:00</option>
<option value="03:45:00">03:45:00</option>
<option value="04:00:00">04:00:00</option>
<option value="04:15:00">04:15:00</option>
<option value="04:30:00">04:30:00</option>
<option value="04:45:00">04:45:00</option>
<option value="05:00:00">05:00:00</option>
<option value="05:15:00">05:15:00</option>
<option value="05:30:00">05:30:00</option>
<option value="05:45:00">05:45:00</option>
<option value="06:00:00">06:00:00</option>
<option value="06:15:00">06:15:00</option>
<option value="06:30:00">06:30:00</option>
<option value="06:45:00">06:45:00</option>
<option value="07:00:00">07:00:00</option>
<option value="07:15:00">07:15:00</option>
<option value="07:30:00">07:30:00</option>
<option value="07:45:00">07:45:00</option>
<option value="08:00:00">08:00:00</option>
<option value="08:15:00">08:15:00</option>
<option value="08:30:00">08:30:00</option>
<option value="08:45:00">08:45:00</option>
<option value="09:00:00">09:00:00</option>
<option value="09:15:00">09:15:00</option>
<option value="09:30:00">09:30:00</option>
<option value="09:45:00">09:45:00</option>
<option value="10:00:00">10:00:00</option>
<option value="10:15:00">10:15:00</option>
<option value="10:30:00">10:30:00</option>
<option value="10:45:00">10:45:00</option>
<option value="11:00:00">11:00:00</option>
<option value="11:15:00">11:15:00</option>
<option value="11:30:00">11:30:00</option>
<option value="11:45:00">11:45:00</option>
<option value="12:00:00">12:00:00</option>
<option value="12:15:00">12:15:00</option>
<option value="12:30:00">12:30:00</option>
<option value="12:45:00">12:45:00</option>
<option value="13:00:00">13:00:00</option>
<option value="13:15:00">13:15:00</option>
<option value="13:30:00">13:30:00</option>
<option value="13:45:00">13:45:00</option>
<option value="14:00:00">14:00:00</option>
<option value="14:15:00">14:15:00</option>
<option value="14:30:00">14:30:00</option>
<option value="14:45:00">14:45:00</option>
<option value="15:00:00">15:00:00</option>
<option value="15:15:00">15:15:00</option>
<option value="15:30:00">15:30:00</option>
<option value="15:45:00">15:45:00</option>
<option value="16:00:00">16:00:00</option>
<option value="16:15:00">16:15:00</option>
<option value="16:30:00">16:30:00</option>
<option value="16:45:00">16:45:00</option>
<option value="17:00:00">17:00:00</option>
<option value="17:15:00">17:15:00</option>
<option value="17:30:00">17:30:00</option>
<option value="17:45:00">17:45:00</option>
<option value="18:00:00">18:00:00</option>
<option value="18:15:00">18:15:00</option>
<option value="18:30:00">18:30:00</option>
<option value="18:45:00">18:45:00</option>
<option value="19:00:00">19:00:00</option>
<option value="19:15:00">19:15:00</option>
<option value="19:30:00">19:30:00</option>
<option value="19:45:00">19:45:00</option>
<option value="20:00:00">20:00:00</option>
<option value="20:15:00">20:15:00</option>
<option value="20:30:00">20:30:00</option>
<option value="20:45:00">20:45:00</option>
<option value="21:00:00">21:00:00</option>
<option value="21:15:00">21:15:00</option>
<option value="21:30:00">21:30:00</option>
<option value="21:45:00">21:45:00</option>
<option value="22:00:00">22:00:00</option>
<option value="22:15:00">22:15:00</option>
<option value="22:30:00">22:30:00</option>
<option value="22:45:00">22:45:00</option>
<option value="23:00:00">23:00:00</option>
<option value="23:15:00">23:15:00</option>
<option value="23:30:00">23:30:00</option>
<option value="23:45:00">23:45:00</option>
<option value="24:00:00">24:00:00</option>
<option value="24:15:00">24:15:00</option>
<option value="24:30:00">24:30:00</option>
<option value="24:45:00">24:45:00</option>
</select>
</span>
</div>



</div>
</div>





<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> FECHA DE LA AUTORIZACIÓN:</label> 
<?php if (2==1) {  ?>
<input type="date" readonly="readonly" class="form-control" name="fecha_poder"  required >
<?php } else { ?>
<input type="text" readonly="readonly" class="form-control datepicker" name="fecha_poder"  required >
<?php  } ?>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> SOLICITANTE U OTORGANTE:</label> 
<select class="form-control" name="id_tipo_autorizacion_salida" id="id_tipo_autorizacion_salida">
<option value="" selected></option>
<?php echo lista('tipo_autorizacion_salida'); ?>
</select>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> CORREO ELECTRÓNICO DEL SOLICITANTE:</label> 
<input type="email" class="form-control" name="correo" required >
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE CUSTODIA, TENENCIA Y PATRIA POTESTAD:</label> 
<select class="form-control" name="id_tipo_custodia">
<option value="" selected></option>
<?php echo lista('tipo_custodia'); ?>
</select>
</div>

<hr>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> TIPO DE IDENTIFICACIÓN DEL MENOR:</label> 
<select class="form-control" name="id_tipo_documento_menor" id="id_tipo_documento_menor">
<option></option>
<option value="6">Registro civil de nacimiento</option>
<option value="5">Tarjeta de identidad</option>
<option value="10">Menor extranjero residente en Colombia</option>
</select>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>NÚMERO DE IDENTIFICACIÓN DEL MENOR:</label> 
<input type="text" class="form-control mayuscula" name="identificacion_menor" required>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DEL MENOR:</label> 
<input type="text" class="form-control mayuscula" name="nombre_menor"  required>

<!--
<div class="input-group">
<span class="input-group-addon">
<input type="text" placeholder="1 Apellido" class="form-control mayuscula" name="menor1" value="" required></span>
<span class="input-group-addon">
	<input type="text" placeholder="2 Apellido" class="form-control mayuscula" name="menor2" value=""></span>
<span class="input-group-addon">
	<input type="text" placeholder="1 Nombre" class="form-control mayuscula" name="menor3" value="" required></span>
<span class="input-group-addon">
	<input type="text" placeholder="2 Nombre" class="form-control mayuscula" name="menor4" value="">
	</span>
	  </div>
	  -->
	  
	  
	  
	  
	  
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span class="obligapadre" style="display:none;" >*</span> TIPO DE DOCUMENTO DE PADRE:</label> 
<select  class="form-control" name="id_tipo_documento_padre" id="id_tipo_documento_padre" >
<option value="" selected></option>
<?php echo listadocumento(); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span class="obligapadre" style="display:none;" >*</span> IDENTIFICACION DEL PADRE:</label> 
<input type="text" class="form-control mayuscula" name="identificacion_padre" id="identificacion_padre" >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span class="obligapadre" style="display:none;" >*</span> NOMBRE DEL PADRE:</label> 
<input type="text" class="form-control mayuscula" name="nombre_padre" id="nombre_padre" >

<!--
<div class="input-group">
<span class="input-group-addon">
<input type="text" placeholder="1 Apellido" class="form-control mayuscula" name="padre1" value="" required></span>
<span class="input-group-addon">
	<input type="text" placeholder="2 Apellido" class="form-control mayuscula" name="padre2" value=""></span>
<span class="input-group-addon">
	<input type="text" placeholder="1 Nombre" class="form-control mayuscula" name="padre3" value="" required></span>
<span class="input-group-addon">
	<input type="text" placeholder="2 Nombre" class="form-control mayuscula" name="padre4" value="">
	</span>
	  </div>
	  -->
	  
</div>



<div class="form-group text-left"> 
<label  class="control-label"><span class="obligamadre" style="display:none;" >*</span> TIPO DE DOCUMENTO DE LA MADRE:</label> 
<select  class="form-control" name="id_tipo_documento_madre" id="id_tipo_documento_madre" >
<option value="" selected></option>
<?php echo listadocumento(); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span class="obligamadre" style="display:none;" >*</span> IDENTIFICACION DE LA MADRE:</label> 
<input type="text" class="form-control mayuscula" name="identificacion_madre" id="identificacion_madre" >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span class="obligamadre" style="display:none;" >*</span> NOMBRE DE LA MADRE:</label> 
<input type="text" class="form-control mayuscula" name="nombre_madre" id="nombre_madre"  >

<!--
<div class="input-group">
<span class="input-group-addon">
<input type="text" placeholder="1 Apellido" class="form-control mayuscula" name="madre1" value="" required></span>
<span class="input-group-addon">
	<input type="text" placeholder="2 Apellido" class="form-control mayuscula" name="madre2" value=""></span>
<span class="input-group-addon">
	<input type="text" placeholder="1 Nombre" class="form-control mayuscula" name="madre3" value="" required></span>
<span class="input-group-addon">
	<input type="text" placeholder="2 Nombre" class="form-control mayuscula" name="madre4" value="">
	</span>
	  </div>
	 -->
	  
</div>




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> SALE DEL PAIS CON UNA PERSONA DIFERENTE A LOS PADRES</label> 
<select  class="form-control" name="sale_dif_padres" id="sale_dif_padres" >
<option value="0" selected>No</option>
<option value="1" >Si</option>
<option value="2" >Viaja con personal de la aerolinea o empresa de transporte.</option>
</select>
</div>

<div id="persona_sale" style="display:none;"> 
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>TIPO DE DOCUMENTO DE LA PERSONA QUE SALE CON EL MENOR:</label> 
<select  class="form-control" name="id_tipo_documento_psale" >
<option value="" selected></option>
<?php echo listadocumento(); ?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> IDENTIFICACION DE LA PERSONA QUE SALE CON EL MENOR:</label> 
<input type="text" class="form-control mayuscula" name="identificacion_psale" >
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> NOMBRE DE LA PERSONA QUE SALE CON EL MENOR:</label> 
<input type="text" class="form-control mayuscula" name="nombre_psale">
<!--
<div class="input-group">
<span class="input-group-addon">
<input type="text" placeholder="1 Apellido" class="form-control mayuscula" name="psale1" value="" ></span>
<span class="input-group-addon">
	<input type="text" placeholder="2 Apellido" class="form-control mayuscula" name="psale2" value=""></span>
<span class="input-group-addon">
	<input type="text" placeholder="1 Nombre" class="form-control mayuscula" name="psale3" value="" ></span>
<span class="input-group-addon">
	<input type="text" placeholder="2 Nombre" class="form-control mayuscula" name="psale4" value="">
	</span>
	  </div>-->
	  
</div>
</div>



<hr>

<!--
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>FECHA DE SALIDA:</label> 
<input type="text" readonly="readonly" class="datepicker" name="fecha_salida" required >
</div>-->




<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>PERIODO DE SALIDA:</label> 

<div class="input-group">
<span class="input-group-addon">Desde:</span>

<?php if (2==1) {  ?>
<input type="date" readonly="readonly" name="fecha_salida"  placeholder="Desde" required >
<?php } else { ?>
	<input type="text" readonly="readonly" class="datepicker" name="fecha_salida"  placeholder="Desde" required >
<?php  } ?>




<span class="input-group-addon">Hasta:</span>

<?php if (2==1) {  ?>
<input type="date" readonly="readonly"  name="fecha_salida_hasta"   placeholder="Hasta" required>
<?php } else { ?>
<input type="text" readonly="readonly" class="datepicker" name="fecha_salida_hasta"   placeholder="Hasta" required>
<?php  } ?>



</div>
</div>





<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>PROPÓSITO DE LA SALIDA:</label> 
<textarea class="form-control mayuscula" name="nombre_salida_menor" required></textarea>
</div>
<div class="form-group text-left" id="pais"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>PAÍS DEL DESTINO FINAL:</label> 
<select class="form-control" name="id_pais" id="id_pais" required>
<option value="" selected></option>
<?php 

$query = sprintf("SELECT id_pais, nombre_pais FROM pais where estado_pais=1 order by nombre_pais"); 
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$totalRows = mysql_num_rows($select);
if (0<$totalRows){
do {

	echo '<option value="'.$row['id_pais'].'">'.$row['nombre_pais'].'</option>';
	 } while ($row = mysql_fetch_assoc($select)); 
} else {}	 

mysql_free_result($select);




?>
</select>
</div>
<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span>PERIODO DE RETORNO:</label> 



<select name="retorno" id="retorno">
<option value="1" selected>Si aplica</option>
<option value="0">No aplica</option>
</select>



<div class="input-group" id="si_retorno">
<span class="input-group-addon">Desde:</span>
<?php if (2==1) {  ?>
<input type="date" readonly="readonly" name="fecha_retorno"  id="fecha_retorno" placeholder="Desde" required >
<?php } else { ?>
<input type="text" readonly="readonly" class="datepicker" name="fecha_retorno"  id="fecha_retorno" placeholder="Desde" required >
<?php  } ?>


<span class="input-group-addon">Hasta:</span>

<?php if (2==1) {  ?>
<input type="date" readonly="readonly" name="fecha_retorno_hasta" id="fecha_retorno_hasta"  placeholder="Hasta" required>
<?php } else { ?>
<input type="text" readonly="readonly" class="datepicker" name="fecha_retorno_hasta" id="fecha_retorno_hasta"  placeholder="Hasta" required>
<?php  } ?>


</div>

<div class="input-group" id="no_retorno" style="display:none;">
<span class="input-group-addon"><span style="color:#ff0000;">*</span> Motivo:</span>
<input type="text"  class="form-control mayuscula" name="motivo_noretorno"  id="motivo_noretorno" placeholder="Motivo para no informar fecha de retorno." >
</div>



</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">* Solo PDF inferior a 5Mb.</span> <span id="infoadjunto">PODER AUTENTICADO</span>:</label> 
<input type="file" class="form-control" name="file_autenticacion" id="file_autenticacion" onchange="return fileValidation()" required>
</div>

<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">* Solo PDF inferior a 5Mb.</span> <span id="infoadjuntocivil">REGISTRO CIVIL DE NACIMIENTO</span>:</label> 
<input type="file" class="form-control" name="file_civil" id="file_civil" onchange="return fileValidationcivil()" required>
</div>


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Se acepta la <a href="https://pqrs.supernotariado.gov.co/documentos/Res-12225_pol_trat_prot_datos.pdf" target="_blank">politica del tratamiento de datos personales</a>:</label> 
<input type="checkbox" name="check" checked required>
</div>
					   
					   
        
                		 <div class="modal-footer">
                              <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
                              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                              <button type="submit" class="btn btn-success"><input type="hidden" name="archsucesion" value="notaria">
                              <span class="glyphicon glyphicon-ok"></span>Guardar</button>
					     </div>
				   </form>
              </div>
          </div> 
     </div> 
</div> 

<script>
function mayus(e) {
    e.value = e.value.toUpperCase();
}
</script>





<?php if (1==$_SESSION['rol'] or (3==$_SESSION['snr_tipo_oficina'] && (""!=$_SESSION['posesionnotaria'] or ""!=$_SESSION['id_vigilado'])))
{ include 'menu_notaria.php'; } else { } ?>



<div class="row">

<div class="col-md-12"  >
  
<div class="box" style="min-height:500px;">


<div class="box-header with-border">
                  <h3 class="box-title">
				
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</button>&nbsp;         
  
				  SALIDA DE MENORES DE LA NOTARIA <?php echo quees('notaria', $id); ?>
				   
				    <a href="https://sisg.supernotariado.gov.co/documentos/MANUAL_SALIDA_MENORES.pdf" target="_blank">Manual</a>
				   </h3>

	
	
<div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
</button></div>

                </div>
            <div class="box-body">



<!--
<div class="col-md-3">
<form action="" method="POST" name="for5erttgmgjht1">
<select class="form-control" style="width:100%;" name="buscar_c">
<option value="" selected> - - Buscar x Criterio - - </option>
<option>Identificación del menor</option>
<option>Identificación de la madre</option>
<option>Identificación del padre</option>
</select>
</div>

<div class="col-md-3"> 
<input type="text" class="form-control" name="buscar" placeholder="Valor">


</div>

<div class="col-md-3"> 
<button type="submit" class="btn btn-warning">
<i class="fa fa-search"></i> 
Buscar</button>
</form>
</div>
-->



	
	




<?php
$query = sprintf("SELECT respuesta_migra, id_salida_menor, identificador_sm, fecha_poder, identificacion_menor, nombre_menor,identificacion_padre, nombre_padre, identificacion_madre, nombre_madre, file_civil, file_autenticacion  FROM salida_menor where id_notaria=".$id." and estado_salida_menor=1 order by id_salida_menor desc");
$select = mysql_query($query, $conexion) or die(mysql_error());
$row = mysql_fetch_assoc($select);
$total557ll = mysql_num_rows($select);
if (0<$total557ll) {
?>

<table class="table table-striped table-bordered table-hover" id="tab_sucesiones">

<thead><tr align='center' valign='middle'>
<th>IDENTIFICADOR</th>
<th>FECHA DE AUTORIZACIÓN</th><th>IDENTIFICACIÓN DEL MENOR</th><th>NOMBRE DEL MENOR</th>
<th>IDENTIFICACIÓN DEL PADRE</th><th>NOMBRE DEL PADRE</th>
<th>IDENTIFICACIÓN DE LA MADRE</th><th>NOMBRE DE LA MADRE</th>

<th></th></tr></thead><tbody>
<?php
do {
	echo '<tr title="'.$row['respuesta_migra'].'">';

echo '<td>'.$row['identificador_sm'].'</td>';
echo '<td>'.$row['fecha_poder'].'</td>';
echo '<td>'.$row['identificacion_menor'].'</td>';
echo '<td>'.$row['nombre_menor'].'</td>';

echo '<td>'.$row['identificacion_padre'].'</td>';
echo '<td>'.$row['nombre_padre'].'</td>';

echo '<td>'.$row['identificacion_madre'].'</td>';
echo '<td>'.$row['nombre_madre'].'</td>';


echo '<td style="width:150px;">';


if (isset($row['file_autenticacion']) && file_exists('files/salidas/'.$row['identificador_sm'].'/'.$row['file_autenticacion'])) {
$valsal=1;
echo '<a href="files/salidas/'.$row['identificador_sm'].'/'.$row['file_autenticacion'].'" title="Autenticación" download="autenticacion.pdf"><img src="images/pdf.png"> ';
//echo round((filesize('files/salidas/'.$row['identificador_sm'].'/'.$row['file_autenticacion']))/1048576, 2).' Mg';
echo '</a> &nbsp; ';
} else { 
$valsal=0;
echo '<img src="images/notice.png" title="El poder ó E.P. no se adjunto correctamente."> &nbsp; '; }



if (isset($row['file_civil']) && file_exists('files/salidas/'.$row['identificador_sm'].'/'.$row['file_civil'])) {
$valsal2=1;
echo '<a href="files/salidas/'.$row['identificador_sm'].'/'.$row['file_civil'].'" title="Registro civil" download="registro_civil.pdf"><img src="images/pdf.png"> ';
//echo round((filesize('files/salidas/'.$row['identificador_sm'].'/'.$row['file_civil']))/1048576, 2).' Mg';
echo '</a> &nbsp; ';
} else { 
$valsal2=0;
echo '<img src="images/notice.png" title="El registro civil no se adjunto correctamente."> &nbsp; '; }



if (1==$valsal && 1==$valsal2) {
echo '<a href="files/salidas/'.$row['identificador_sm'].'/'.$row['identificador_sm'].'.pdf" download="Resumen_salida.pdf" title="Resumen de salida"><img src="images/pdf.png"></a> &nbsp;';
} else { echo '<img src="images/alert.png" title="No fue aceptado por el sistema dado problemas con un adjunto pdf."> &nbsp; '; }



if (((3==$_SESSION['snr_tipo_oficina'] && 1==$_SESSION['snr_grupo_cargo']) or (0==$valsal or 0==$valsal2)) or 1==$_SESSION['rol'] ) {  	
echo '<a style="color:#ff0000;cursor: pointer" title="Borrar" name="salida_menor" id="'.$row['id_salida_menor'].'" class="borrar_f"><span class="glyphicon glyphicon-trash"></span></a>';
} else {}


echo '</td></tr>';
} while ($row = mysql_fetch_assoc($select));
mysql_free_result($select);
echo '</tbody></table>';
} else {}
?>
 <script>
              $(document).ready(function() {
            $('#tab_sucesiones').DataTable({
              "lengthMenu": [ [50, 100, 200, 300, 500], [50, 100, 200, 300, 500] ],
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              }
            });
          });
          </script>



</div>
</div>
</div>

		

</div>

<?php
} else { echo 'No tiene acceso';}
?>



















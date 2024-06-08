<?php

if (isset($_POST['option']) and ""!=$_POST['option']) {
$id=intval($_POST['option']);

require_once('../conf.php'); 


$query_update = "SELECT * FROM gimnasio, funcionario where gimnasio.id_funcionario=funcionario.id_funcionario and id_gimnasio = ".$id."  and estado_gimnasio=1 limit 1";
$update = mysql_query($query_update, $conexion);
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
if (0<$totalRows_update){
	
?>
 
<div style="padding: 10px 10px 10px 10px">
 
<form action="" method="POST" name="for54432dsfds3m1">


<div class="form-group text-left"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Funcionario:</label> 
<input  class="form-control" value="<?php echo $row_update['nombre_funcionario']; ?>" 
readonly  required>
</div>



<div class="form-group text-left" id="categoria_gimnasio"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Categorias de inscripción: (Presencial)</label> 
<select name="id_categoria_gimnasiog" id="id_categoria_gimnasio" class="form-control" >
<option selected><?php echo $row_update['id_categoria_gimnasio']; ?></option>
<option>One</option>
<option>Premium</option>
<option>Classic</option>
<option>Super</option>
<option></option>
</select>
</div>


<div class="form-group text-left" id="sede_gimnasio"> 
<label  class="control-label"><span style="color:#ff0000;">*</span> Sede en la cual esta interesado: (<a href="https://bodytech.com.co/sedes" target="_blank">Ver mapa</a>)</label> 
<select name="id_sede_gimnasiog" class="form-control" id="id_sede_gimnasio" >
<option selected><?php echo $row_update['id_sede_gimnasio']; ?></option>
<option>ARMENIA, ARMENIA, CARRERA 6 NO 3 - 180 CENTRO COMERCIAL CALIMA, LOCAL: 223</option>
<option>BOGOTÁ, CABRERA, CALLE 85 # 7-13</option>
<option>BOGOTÁ, CHICO, AVENIDA 19 # 102 - 31 PISO 3</option>
<option>BOGOTÁ, CARRERA 11, CALLE 96#10-38</option>
<option>BOGOTÁ, CALLE 90, CALLE 90 # 16-30</option>
<option>BOGOTÁ, FONTANAR, KILOMETRO 2.5 VIA CHIA-CAJICA PRIMER PISO COSTADO SUR</option>
<option>BOGOTÁ, HACIENDA, CALLE 116 CON AVENIDA SEPTIMA CC HACIENDA SANTA BARARA SOTANO 1</option>
<option>BOGOTÁ, COLINA, CALLE 138 N° 58 - 74</option>
<option>BOGOTÁ, PASADENA, CRA 53 N°101 A - 37 C.C. LOS TRES ELEFANTES PISO 2</option>
<option>BOGOTÁ, CHAPINERO, CRA 7 # 63-25</option>
<option>BOGOTÁ, CEDRITOS, CALLE 147 # 7 - 52</option>
<option>BOGOTÁ, TORRE CENTRAL, CLL 26 # 68C-61 LOCAL 116</option>
<option>BOGOTÁ, SANTA ANA, AV 9 # 110-20  CENTRO COMERCIAL SANTA ANA</option>
<option>BOGOTÁ, BULEVAR, AVENIDA CARRERA 58 #127-59 LOCAL 181 B CC BULEVAR </option>
<option>BOGOTÁ, GRAN ESTACION, CENTRO COMERCIAL GRAN ESTACIÓN AV. CALLE 26 #62-47 TERCER PISO AL LADO DE CINE COLOMBIA.</option>
<option>BOGOTÁ, CHIA, CC. PLAZA MAYOR AVENIDA PRADILLA N 5-31 E LOCAL 121</option>
<option>BOGOTÁ, AUTOPISTA 134, CALLE 134 A # 23 - 72</option>
<option>BOGOTÁ, COUNTRY  138, CALLE 138 N# 10 A - 42</option>
<option>BOGOTÁ, FLORESTA, AVENDIA 68 # 90 -88 NIVEL 0 CENTRO COMERCIAL FLORESTA</option>
<option>BOGOTÁ, AUTOPISTA 170, CARRERA 23 N° 166 - 59// AUTP NORTE # 167-10</option>
<option>BOGOTÁ, GALERIAS, PISO 6, CRA. 24 #53 - 73, BOGOTÁ CC PLAZA 54</option>
<option>BOGOTÁ, TITAN PLAZA, CENTRO COMERCIAL TITAN PLAZA AV CARRERA 72#80-94 LOCAL 427 </option>
<option>BOGOTÁ, CENTRO MAYOR, CALLE 38ª SUR N° 34D - 51 LOCAL 3058</option>
<option>BOGOTÁ, SULTANA, CLL 12 SUR # 31 -33</option>
<option>BOGOTÁ, HAYUELOS, C.C. HAYUELOS CALLE 20 NO 82 - 52 LOCAL 4-59</option>
<option>BOGOTÁ, PABLO VI, CRA 52 BIS # 56B -26</option>
<option>BOGOTÁ, NORMANDIA, AV. BOYACA 49 29 PISO 2</option>
<option>BOGOTÁ, PLAZA CENTRAL, CARRERA 65 # 11 – 50 (AVENIDA DE LAS AMÉRICAS Y CALLE 13) PISO 3. LOCAL 3-28 | BOGOTÁ – COLOMBIA</option>
<option>BOGOTÁ, ENSUEÑO, CARRERA 51 # 59C SUR 93A</option>
<option>BOGOTÁ, PASEO DEL RIO, CL. 57D SUR #78H 14</option>
<option>BOGOTÁ, PORTAL 80, TRV  100A # 80A-20</option>
<option>BOGOTÁ, DIVERPLAZA, TRANSVERSAL 96 # 70 A - 85 TERRAZA CUARTO  PISO</option>
<option>BOGOTÁ, KENNEDY, TRANS. 78J # 41F-05 SUR</option>
<option>BOGOTÁ, PLAZA BOSA, CALLE 65 SUR 78 H -51 LOCAL 314</option>
<option>BOGOTÁ, SUBA, AV CRA 104 #148 - 07 LOC 269 C. C PLAZA IMPERIAL</option>
<option>SOACHA, TERREROS, CRA. 1 NO. 38-53 LOCAL 4-16 VENTURA-TERCER PISO</option>
<option>SOACHA, ANTARES, ANTARES AUTOPISTA SUR CARRERA 4 # 26- 55 SUR MUNICIPIO SOACHA</option>
<option>BARRANQUILLA, PARQUE WASHINGTON, CENTRO COMERCIAL ROYAL WASHIGNTON CARRERA 53 NO 79-279</option>
<option>BARRANQUILLA, VIVA BARRANQUILLA, CRA 51B NO 87 - 50 - CENTRO COMERCIAL VIVA</option>
<option>BARRANQUILLA, MIRAMAR, CRA 43 # 99-50 CC MIRAMAR PISO 3 LOCAL 301-302</option>
<option>BARRANQUILLA, RECREO, CRA. 43 NO. 60-25 BARRANQUILLA - COLOMBIA</option>
<option>BARRANQUILLA, SOLEDAD, CARRERA 32 N 30 15 PISO 3  C,C GRAN PLAZA DEL SOL</option>
<option>BARRANQUILLA, MURILLO, CALLE. 45 (MURILLO) NO. 21-18 PISO 2 ,3 ,4| BARRANQUILLA - COLOMBIA</option>
<option>BUCARAMANGA, CARACOLI, CARRERA 27 N 29 145 LOCAL 503 PARQUE CARACOLI</option>
<option>BUCARAMANGA, CACIQUE, TRANSVERSAL 93 #34 99 CENTRO COMERCILAL CACIQUE LOCAL 420</option>
<option>BUCARAMANGA, MEGAMALL, CARRERA 33 A # 30A 19 LOCAL 301</option>
<option>CALI, OESTE, CALLE 7 OESTE # 1A - 59 BARRIO SANTA TERESITA </option>
<option>CALI, JARDIN PLAZA, CARRERA 98 #16-200 LOC.202 C,C JARDIN PLAZA</option>
<option>CALI, CHIPICHAPE, CALLE 38 N # 6N - 35 LOCAL 8-246. CENTRO COMERCIAL CHIPICHAPE</option>
<option>CALI, CANEY, CALLE 48# 85-54</option>
<option>CALI, LIMONAR, CALLE 5 #69-09 CENTRO COMERCIAL PREMIER LIMONAR LOCAL 401</option>

<option>CARTAGENA, BOCAGRANDE, BOCAGRANDE AV EL MALECON CC. PLAZA BOCAGRANDE PISO 5 </option>
<option>CARTAGENA, CARIBE PLAZA, CLL. 29D NO. 22-62 LOCAL 225 | CARTAGENA - COLOMBIA BARRIO PIE DE LA POPA</option>
<option>CARTAGENA, PLAZUELA, C.C. LA PLAZUELA CALLE 71 #29 -236 LOCALES 1-5 </option>
<option>CARTAGENA, EJECUTIVOS, SUPER CENTRO LOS EJECUTIVOS 2 PISO CALLE 31#57-106</option>


<option>MEDELLIN, SANTA MARIA DE LOS ÁNGELES, CRA 46 # 16 SUR-67 </option>
<option>MEDELLIN, VIZCAYA, CLL 10 # 32-115 INT 127 </option>
<option>MEDELLIN, RIO SUR, CRA 43A N° 6 SUR - 26 CC. RÍO SUR - PISO 6</option>
<option>MEDELLIN, LLANOGRANDE, CENTRO COMERCIAL JARDINES DE LLANOGRANDE</option>
<option>MEDELLIN, MALL DEL ESTE, CRA 25 # 3-45 SOTANO 3</option>
<option>MEDELLIN, SAN LUCAS, CLL 20 SUR # 27-115 SÓTANO 4  </option>
<option>MEDELLIN, VILLAGRANDE, TRANS 27 A SUR 42B 60</option>
<option>MEDELLIN, LAURELES, CLL 66B # 32 D - 36</option>
<option>MEDELLIN, AMERICAS, DG 75B   2A-120 L.227</option>
<option>MEDELLIN, CITY PLAZA, CLL 36D SUR N 27A-105 LC 340</option>
<option>MEDELLIN, PREMIUM PLAZA, CRA 42 A # 30 - 25 LC 3189</option>
<option>MEDELLIN, ROBLEDO, CRA 80 N° 64 – 61 INTERIOR ÉXITO ROBLEDO  </option>
<option>MEDELLIN, SAN JUAN, CRA 84 # 44-54 INT. 201</option>
<option>MEDELLIN, CAMINO REAL, AV. ORIENTAL CRA. 46 NO. 52 - 95 LC 401</option>
<option>MEDELLIN, AVENIDA COLOMBIA, CLL 50 # 66-50</option>
<option>MEDELLIN, ENVIGADO, DG 40 # 33 SUR 48</option>
<option>MEDELLIN, NIQUIA, CC TIERRAGRO DIA 50 A # 38- 20, BELLO</option>
<option>MEDELLIN, BELEN, CLL 32 # 75-50 </option>
<option>MONTERIA, NUESTRO MONTERIA, TRANSVERSAL 29 # 29-69 CENTRO COMERCIAL NUESTRO MONTERIA</option>
<option>RIONEGRO, LLANOGRANDE, CENTRO COMERCIAL JARDINES DE LLANOGRANDE</option>
<option>PASTO, PASTO, CALLE 22B # 2 - 63//67 ÉXITO PANAMERICA</option>
<option>PALMIRA, PALMIRA, "CALLE 31 # 44-239 LLANOGRANDE PLAZA</option>
<option>PEREIRA, PEREIRA, AV CIRCUNVALAR CRA 13 Nº 12 B-25 EDIFICIO UNIPLEX PISO 5 Y 6</option>
<option>PEREIRA, DOS QUEBRADAS, CARRERA 16 # 43 CC EL PROGRESO LOCAL 208</option>
<option>TUNJA, CALLE 37 N. 6-20</option>
<option>TULUA, TULUA, CRA 40 #37-51 CENTRO COMERCIAL TULUA LA 14 LOCAL MESANINE H</option>
<option>MANIZALES, SANCANCIO, C.C. SANCANCIO CRA 27A # 66 - 30 </option>
<option>CUCUTA, CAOBOS, CALLE 11 # 2E-10 BARRIO CAOBOS CENTRO COMERCILA QUINTA VELEZ (3) PISO LOCAL 301</option>
<option>IBAGUE, IBAGUE, CLL 60 CON  AV AMBALA CENTRO COMERCIASL LA ESTACION LOCAL  302</option>
<option>VALLEDUPAR, MAYALES, CENTRO COMERCIAL MAYALES CALLE 31 NO 6-133</option>
<option>VILLAVICENCIO, LLANOCENTRO, CRA 39 C N°29C-15 BARRIO BALATA CC LLANOCENTRO LOCAL 3001</option>
<option>VILLAVICENCIO, VIVA VILLAVICENCIO, CALLE 7#45-185 CENTRO COMERCIAL VIVA VILLAVICENCIO BARRIO LA ESPERANZA</option>
<option>NEIVA, NEIVA, KRA 8A N- 38-42 C.C SAN PEDRO PLAZA LOCAL 291</option>
<option></option>

</select>
</div>

<hr>
<div class="form-group text-left" > 
<label  class="control-label"><span style="color:#ff0000;">*</span> Tipos de modalidades virtuales: (Virtual)</label> 
<select name="id_modalidad_gimnasiog"  class="form-control">
<option selected><?php echo $row_update['id_modalidad_gimnasio']; ?></option>
<option>My Coach</option>
<option>Coach Nutricional</option>
<option>Entrenamiento Personalizado Online</option>
<option></option>
</select>
</div>



<div class="modal-footer">
<input type="hidden"  name="id_gimnasiog"  value="<?php  echo $row_update['id_gimnasio']; ?>">
<input  type="hidden" name="id_funcionariog" value="<?php echo $row_update['id_funcionario']; ?>" >
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Actualizar </button>
</div>

</form>

<br><br>
      </div>



<?php 
} else {}
mysql_free_result($update);
} else { }

?>





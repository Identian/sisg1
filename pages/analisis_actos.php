<div class="row">
	
	
	 <div class="col-lg-3 col-xs-6">
	  <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo existenciaunica('notaria', 'id_categoria_notaria', 1); ?></h3>

              <p>Notarias 1 Categoria</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
		  </div>
		  

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo existenciaunica('notaria', 'id_categoria_notaria', 2); ?></h3>

              <p>Notarias 2 Categoria</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo existenciaunica('notaria', 'id_categoria_notaria', 3); ?></h3>

              <p>Notarias 3 Categoria</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
		 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo existencia('encuesta_notaria'); ?></h3>

              <p>Total de registros</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		

      </div>


<!--
 <div class="row">
  <div class="col-md-12">
<div class="info-box">

<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="pqrs_orip.jsp" >
                <span class="badge bg-green" ><i class="fa fa-check"> 195</i></span>
                <i class="fa fa-bar-chart"></i> ORIP
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="notarias.jsp" >
                <span class="badge bg-green" ><i class="fa fa-check"> 907</i></span>
                <i class="fa fa-bar-chart"></i> Notarias
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="curadurias.jsp">
                <span class="badge bg-green"><i class="fa fa-check"> 74</i></span>
                <i class="fa fa-bar-chart"></i> Curadurias
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="pqrs_central.jsp">
                <span class="badge bg-green"><i class="fa fa-check"> 18</i></span>
                <i class="fa fa-bar-chart"></i> Areas - NC
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="directorio.jsp">
                <span class="badge bg-green"><i class="fa fa-check"></i></span>
                <i class="fa fa-bar-chart"></i> Grupos
              </a>
</div>
<div class="col-md-2"><br>
  <a class="btn btn-app" style="width:100%;" href="mapa_orips.jsp">
                <span class="badge bg-green"><i class="fa fa-check"> 5</i></span>
                <i class="fa fa-bar-chart"></i> Direcciones regionales
              </a>
</div>        </div>
       
			   </div>
			  </div>-->
			  
        
    

<div class="row">
<div class="col-md-12" >
<div class="box box-body" >
<div class="text-center" style="margin: 0 auto;" >
<div class="row">
  <form action="" method="POST" name="srewr">
  <div class="col-md-1">Desde:</div>
<div class="col-md-2"> 
<input type="text" class="form-control datepickera" name="fecha_desde" placeholder="Fecha desde" required="" readonly="readonly" value="<?php if (isset($_POST['fecha_desde'])) { echo $_POST['fecha_desde']; } else { echo '2011-07-01';} ?>">
</div>
<div class="col-md-1">Hasta:</div>
<div class="col-md-2">
<input type="text" class="form-control datepickera" name="fecha_hasta" required="" placeholder="Fecha hasta" readonly="readonly"  value="<?php if (isset($_POST['fecha_hasta'])) { echo $_POST['fecha_hasta']; } else { echo '2019-12-31'; } ?>">
</div>
<div class="col-md-2"> 
<button type="submit" class="btn btn-success">
<span class="glyphicon glyphicon-search"></span> Buscar </button>
</div>
<div class="col-md-4"></div>
</form>
</div>
<div class="row">
  <br>
  <div class="box-body" >
<div id="chart"></div>
</div>
</div>
</div>
</div>
</div>	
</div>
<script type='text/javascript'>//<![CDATA[
window.onload=function(){
var chart = c3.generate({
    data: {
        x: 'x',
        columns: [
            ['x', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35'],
            ['Acto', <?php 
            if (isset($_POST['fecha_desde']) && isset($_POST['fecha_hasta'])) {
$fechas=" and fecha between '".$_POST['fecha_desde']."' and '".$_POST['fecha_hasta']."' ";
            } else {
              $fechas="";
            }
$query="SELECT SUM(p1) as registro1,  SUM(p2) as registro2,  SUM(p3) as registro3,  SUM(p4) as registro4,  SUM(p5) as registro5,  SUM(p6) as registro6,  SUM(p7) as registro7,  SUM(p8) as registro8,  SUM(p9) as registro9,  SUM(p10) as registro10,  SUM(p11) as registro11,  SUM(p12) as registro12,  SUM(p13) as registro13,  SUM(p14) as registro14,  SUM(p15) as registro15,  SUM(p16) as registro16,  SUM(p17) as registro17,  SUM(p18) as registro18,  SUM(p19) as registro19,  SUM(p20) as registro20,  SUM(p21) as registro21,  SUM(p22) as registro22,  SUM(p23) as registro23,  SUM(p24) as registro24,  SUM(p25) as registro25,  SUM(p26) as registro26,  SUM(p27) as registro27,  SUM(p28) as registro28,  SUM(p29) as registro29,  SUM(p30) as registro30,  SUM(p31) as registro31,  SUM(p32) as registro32,  SUM(p33) as registro33,  SUM(p34) as registro34,  SUM(p35) as registro35 FROM encuesta_notaria where estado_encuesta_notaria=1 ".$fechas."";
$select = mysql_query($query, $conexion);
$rown = mysql_fetch_assoc($select);
$info= json_encode($rown);
mysql_free_result($select);
$character = json_decode($info);
echo $character->registro1.', ';
echo $character->registro2.', ';
echo $character->registro3.', ';
echo $character->registro4.', ';
echo $character->registro5.', ';
echo $character->registro6.', ';
echo $character->registro7.', ';
echo $character->registro8.', ';
echo $character->registro9.', ';
echo $character->registro10.', ';
echo $character->registro11.', ';
echo $character->registro12.', ';
echo $character->registro13.', ';
echo $character->registro14.', ';
echo $character->registro15.', ';
echo $character->registro16.', ';
echo $character->registro17.', ';
echo $character->registro18.', ';
echo $character->registro19.', ';
echo $character->registro20.', ';
echo $character->registro21.', ';
echo $character->registro22.', ';
echo $character->registro23.', ';
echo $character->registro24.', ';
echo $character->registro25.', ';
echo $character->registro26.', ';
echo $character->registro27.', ';
echo $character->registro28.', ';
echo $character->registro29.', ';
echo $character->registro30.', ';
echo $character->registro31.', ';
echo $character->registro32.', ';
echo $character->registro33.', ';
echo $character->registro34.', ';
echo $character->registro35.'';
?>]
        ],
		type: 'bar'

    },

	
			color: {
  pattern: ['#337ab7', '#ddd']
          },

		  
	
    axis: {

        x: {

            type: 'pow1',

          

        }

    }

});




}//]]> 

</script>
<div class="row">
<div class="col-md-12" >

<div class="box box-solid">
            <div class="box-header with-border">
<h3 class="box-title">Actos:</h3> 
            </div>
            <div class="box-body">

            <div class="col-md-6" >

            1. Vivienda de Interés Social - VIS<br>
2. Escrituras de Vivienda de Interés Prioritario - VIP<br>
3. Escrituras de Vivienda de Interés Prioritario para Ahorradores - VIPA<br>
4. Sucesiones<br>
5. Contratos por Arrendamientos<br>
6. Fiducias<br>
7. Leasing<br>
8. Constitución de Sociedades<br>
9. Liquidación de Sociedades<br>
10. Reforma de Sociedad Comercial<br>
11. Matrimonios Civiles de diferente sexo<br>
12. Matrimonios Civiles entre Personas del Mismo Sexo - SU 214 de 2016<br>
13. Divorcios entre personas de diferente sexo<br>
14. Declaraciones de Uniones Maritales de Hecho.<br>
15. Disoluciones de Uniones Maritales de Hecho.<br>
16. Disoluciones y/o Liquidaciones de sociedades conyugales<br>
17. Correcciones del Registro civil<br>
18. Escrituras sobre Cambios de Nombre<br>
           
</div>
<div class="col-md-6" >

19. Escrituras sobre Legitimación de Hijos<br>
20. Capitulaciones Matrimoniales<br>
21. Interdictos<br>
22. Uniones entre Personas del Mismo Sexo <br>
23. Actas de Comparecencia<br>
24. Autenticaciones<br>
25. Declaraciones Extra Juicio<br>
26. Declaraciones de Supervivencia<br>
27. Conciliaciones<br>
28. Copias del Registro Civil<br>
29. Registros Civiles de Nacimiento<br>
30. Registros Civiles de Matrimonio<br>
31. Registros Civiles de Defunción<br>
32. Escrituras Publicas sobre Corrección del componente Sexo de Masculino ( M ) a Femenino ( F )<br>
33. Escrituras Publicas sobre Corrección del componente Sexo de Femenino ( F) a Masculino (M)<br>
34. Matrimonios Civiles que Involucraron a un menor de Edad <br>
35. Divorcios entre el mismo sexo<br>

 </div>
 </div>
	  
</div>
</div>







<!--http://www.chartjs.org/docs/latest/charts/bar.html-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<div class="row">

<div class="col-md-6">
            
<div class="panel panel-default">
  <div class="panel-body">
<H3>Tipologias PQRS</H3>
<div style="width:100%;"><canvas id="chartjs-6" class="chartjs"></canvas></div>
<script>new Chart(document.getElementById("chartjs-6"),
{"type":"bubble",
"data":
{"datasets":[{"Tipos":"PQRS",
"data":[{"x":20,"y":30,"r":15},{"x":40,"y":10,"r":10}],
"backgroundColor":"rgb(255, 99, 132)"}
]}});
</script>

</div>
</div>
</div>

<div class="col-md-6">
            
<div class="panel panel-default">
  <div class="panel-body">
  <H3>Historico</H3>
<div style="width:100%;"><canvas id="chartjs-7" class="chartjs"></canvas></div>
<script>new Chart(document.getElementById("chartjs-7"),
{"type":"line",
"data":{"labels":["January","February","March","April","May","June","July"],
"datasets":[{"label":"PQRS","data":[65,59,80,81,56,55,40],
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},
"options":{}});
</script>
</div>
</div>
</div>
</div>

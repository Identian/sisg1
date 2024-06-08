
<style>
	
		.container {
			width: 100%;
			margin: 0 auto;
		}
	
		.gantt .i1 .bar {
			fill: #6699cc;
		}
		

		
.gantt .i1 .bar { fill: #cc6699;}
.gantt .i2 .bar { fill: #808080;}
.gantt .i3 .bar { fill: #000000;}
.gantt .i4 .bar { fill: #FF0000;}
.gantt .i5 .bar { fill: #800000;}
.gantt .i6 .bar { fill: #FFFF00;}
.gantt .i7 .bar { fill: #808000;}
.gantt .i8 .bar { fill: #00FF00;}
.gantt .i9 .bar { fill: #008000;}
.gantt .i10 .bar { fill: #00FFFF;}
.gantt .i11 .bar { fill: #008080;}
.gantt .i12 .bar { fill: #0000FF;}
.gantt .i13 .bar { fill: #000080;}
.gantt .i14 .bar { fill: #FF00FF;}
.gantt .i15 .bar { fill: #800080;}
.gantt .i16 .bar { fill: #c0c0c0;}
.g1 { color:#cc6699;} 
.g2 { color:#808080;}
.g3 { color:#000000;}
.g4 { color:#FF0000;}
.g5 { color:#800000;}
.g6 { color:#FFFF00;}
.g7 { color:#808000;}
.g8 { color:#00FF00;}
.g9 { color:#008000;}
.g10 { color:#00FFFF;}
.g11 { color:#008080;}
.g12 { color:#0000FF;}
.g13 { color:#000080;}
.g14 { color:#FF00FF;}
.g15 { color:#800080;}
.g15 { color:#C0C0C0;}
	</style>
	<link rel="stylesheet" href="dist/css/frappe-gantt.css" />
	<script src="dist/js/frappe-gantt.js"></script>
	
	
<div class="row">

<div class="box">
<div class="box-body">
<div class="box-header with-border">
 <a href=""><!--download="config.json"-->
<button type="button" class="btn btn-success btn-xs" >Nuevo</button>
</a>
<hr>
<div class="col-md-4">
<div class="">
<b>Integrantes</b>
<br>
<i class="fa fa-user g1"></i> Luis Giovanni Ortegon Cortazar<br>
<i class="fa fa-user g2"></i> Andres Melo Murcia<br>
<i class="fa fa-user g4"></i> Ivan Dario Luengas<br>
<i class="fa fa-user g3"></i> Willy Rodriguez<br>

</div>
</div>


<div class="col-md-4">
<div class="">
<b>Documentos</b>
<br>
<a href="https://www.dian.gov.co/impuestos/factura-electronica/documentacion/Paginas/documentacion-tecnica.aspx">
Caja</a><br>

</div>
</div>


<div class="col-md-4">
<div class="">
<b>Recursos</b>
<br>
<a href="">XML</a><br>

</div>
</div>




<div class="col-md-12">

<div class="modal-body">


<b>Cronograma del proyecto de Notarias y Consulados digitales</b>
		
		
	<svg id="gantt"></svg>
	
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<script>
		var tasks = [
		
		{
				start: '2022-02-01',
				end: '2022-05-25',
				name: 'Proyecto',
				id: "0",
				progress: 0,
				custom_class: 'i1'
			},
			
			
			{
				start: '2022-02-01',
				end: '2022-02-03',
				name: 'Arquitectura',
				id: "Task 0",
				progress: 0,
				custom_class: 'i2'
			},
			{
				start: '2022-02-03',
				end: '2022-02-06',
				name: 'Catalogos de Notarias',
				id: "Task 1",
				progress: 5,
				dependencies: 'Task 0',
				custom_class: 'i2'
			},
			{
				start: '2022-02-04',
				end: '2022-02-08',
				name: 'Catalogos de actos',
				id: "Task 2",
				progress: 10,
				dependencies: 'Task 1',
				custom_class: 'i2'
			},
			{
				start: '2022-02-08',
				end: '2022-02-13',
				name: 'Desarrollo de autenticación',
				id: "Task 3",
				progress: 0,
				dependencies: 'Task 2',
				custom_class: 'i4'
			},
			
				{
				start: '2022-02-14',
				end: '2022-02-18',
				name: 'Desarrollo de login CA',
				id: "Task 3",
				progress: 0,
				dependencies: 'Task 2',
				custom_class: 'i4'
			},
			
				{
				start: '2022-02-18',
				end: '2022-02-22',
				name: 'Desarrollo del servicio web de Email',
				id: "Task 3",
				progress: 0,
				dependencies: 'Task 2',
				custom_class: 'i4'
			},
			
	
			{
				start: '2022-04-13',
				end: '2022-04-20',
				name: 'Pruebas y ajustes',
				id: "Task 5",
				progress: 0,
				dependencies: 'Task 4',
				custom_class: 'i2'
			}
		]

		
		var gantt = new Gantt('#gantt', tasks, {
	on_click: function (task) {
		console.log(task);
	},
	on_date_change: function(task, start, end) {
		console.log(task, start, end);
	},
	on_progress_change: function(task, progress) {
		console.log(task, progress);
	},
	on_view_change: function(mode) {
		console.log(mode);
	}
});
		
		gantt.change_view_mode('Day') // Quarter Day, Half Day, Day, Week, Month 


	</script>
	
	
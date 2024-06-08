

<div class="modal fade" id="popupcuraduria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
<h4 class="modal-title" id="myModalLabel">Información de Curaduria</h4>
</div> 
<div  class="modal-body"> 

</div>
</div> 
</div> 
</div> 



	<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo existencia('curaduria'); ?></h3>

              <p>Curadurias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             <h3><?php echo existencia('licencia_curaduria'); ?></h3>

              <p>Licencias</p>
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
          <div class="small-box bg-yellow">
            <div class="inner">
         		   <h3><?php echo existencia('tipo_autorizacion_licencia'); ?></h3>

              <p>Tipos de autorización</p>
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
          <div class="small-box bg-red">
            <div class="inner">
          
	
			       <h3><?php echo existencia('uso_aprobado_licencia'); ?></h3>

              <p>Usos</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
	
	
	<div class="row">
<div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Directorio de Curadurias 
				
				
				
				</strong></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
  
            <div class="box-body">
              <div class="table-responsive">
                <table id="datatabla" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
					<th>Código</th>
                    <th>Departamento</th>
					<th>Ciudad</th>
                   <th>Nombre</th>
				    <th>Correo</th>
                   
                        <th style="min-width:500px;"></th>         
                    </tr>
                    </thead>
                    <tbody>
		 
                    </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
		
		
		
	
	
	
</div>

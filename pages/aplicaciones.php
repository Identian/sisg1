 <?php
 if (isset($_GET['i']) and ""!=$_GET['i']) {
	 $id=$_GET['i'];
	 ?>
	 <div class="row">
        <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
      
            <div class="box-footer no-padding" jput="APLICACIONES" jput-ajax_url="http://127.0.0.1/oracle/?t=APLICACIONES&i=<?php echo $id; ?>">
              <ul class="nav nav-stacked">
                <li class="widget-user-header {{json.COLOR_A}}"><h2>{{json.NOMBRE_APLICACIONES}}</h2></li>
                <li><span class="badge bg-green">AREA</span> {{json.AREA_A}}</li>
                <li><span class="badge bg-green">DESCRIPCION</span> {{json.DESCRIPCION_A}}</li>
            
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
	 </div>
	 <?php
 } else {
?>	 
 
 <div class="row" jput="APLICACIONES" jput-ajax_url="http://127.0.0.1/oracle/?t=APLICACIONES">
    <div class="col-md-3 col-sm-6 col-xs-12" style="min-height:130px;" >
      <a href="?q=aplicaciones&i={{json.ID_APLICACIONES}}"><div class="info-box {{json.COLOR_A}}">
        <span class="info-box-icon"><i class="fa fa-cube"></i></span>
        <div class="info-box-content">
         
          <span>{{json.NOMBRE_APLICACIONES}}</span>
          <div class="progress">
            
          </div>
          <span class="progress-description">
            {{json.ID_APLICACIONES}} datos
          </span>
        </div><!-- /.info-box-content -->
      </div></a><!-- /.info-box -->
    </div><!-- /.col -->
  </div>
 <?php } ?>
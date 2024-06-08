<?php 
    require_once "controlador/privilegio_registro.php";
    require_once "modelo/privilegio_registro.php";

    $registro_privilegio = new Privilegio_Registro_Controlador();
    $registro_privilegio -> registro_privilegio_controlador();
?>
<div class="row">
<div class="col-md-9">    
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Acceso a módulos de la Orip - 
        <?php
          $nombreOrip = new Privilegio_Registro_Controlador();
          $nombreOrip -> nombre_orip_controlador();
        ?>
      </h3>
    </div>
    <div class="box-body">
      <?php
        $vista = new Privilegio_Registro_Controlador();
        $vista -> vista_cargo_privilegio_controlador();
      ?>
      <hr>
      <div class="row">
        <div class="col-md-12">
            <?php
                $lista_funcionario = new Privilegio_Registro_Controlador();
                $lista_funcionario -> lista_administracion_funcionario_privilegio_controlador();
            ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">    
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Usuarios de la Orip</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
        <?php
            $funcionarios = new Privilegio_Registro_Controlador();
            $funcionarios -> listado_funcionario_privilegio_controlador();
        ?>
    </div>
  </div>
</div>
<div class="modal fade" id="modalEliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Eliminar perfil
        </div>
        <div class="modal-body">
              <div class="box-body">
                <div id="formulario-modal-eliminar"></div>
            </div>                           
            <div class="modal-footer">
                <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <button type="submit" class="btn btn-success borrar-privilegio">
                <span class="glyphicon glyphicon-ok"></span>  Enviar </button>
            </div>
        </div>
      </div>
    </div>
</div>
<script src="js/privilegio_registro.js"></script>

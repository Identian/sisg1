<?php
require_once "controlador/no_conformidad.php";
require_once "modelo/no_conformidad.php";

$registro = new No_Conformidad_Controlador();
$registro->nuevo_pnc_orip_controlador();
?>
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><b>No Conformidad</b></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <?php
        $boton_registro = new No_Conformidad_Controlador();
        $boton_registro->verifica_privilegio_controlador();
        ?>
        <table class="table table-striped table-bordered table-hover" id="detalleNoConformidad">
          <thead>
            <tr align="center" valign="middle">
              <th>FECHA REGISTRO</th>
              <th>AÑO ERROR</th>
              <th>NUMERO RADICADO DOCUMENTO</th>
              <th>ETAPAS DE CONTROL SNC</th>
              <th>TIPO DE OMISIÓN/ERROR</th>
              <th>DESCRIPCIÓN DE LA OMISIÓN Y/O ERROR DETECTADO</th>
              <th>TRATAMIENTO DADO A LA OMISIÓN Y/O ERROR DETECTADO</th>
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $listado_orip = new No_Conformidad_Controlador();
            $listado_orip->lista_pnc_orip_controlador();
            ?>
            <script>
              $(document).ready(function() {
                $('#detalleNoConformidad').DataTable({
                  "order": [
                    [3, 'asc']
                  ],
                  "lengthMenu": [
                    [50, 100, 200, 300, 500],
                    [50, 100, 200, 300, 500]
                  ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                  }
                });
              });
            </script>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalformularionoconformidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Salida no conforme -
              <?php
              $nombre_orip = new No_Conformidad_Controlador();
              $nombre_orip->nombre_orip_controlador();
              ?>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <?php
            $registro = new No_Conformidad_Controlador();
            $registro->formulario_no_conformidad_controlador();
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalEditarNoConformidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Salida no conforme -
              <?php
              $nombre_orip = new No_Conformidad_Controlador();
              $nombre_orip->nombre_orip_controlador();
              ?>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div id="formulario-modal-no-conformidad-completar"></div>
          </div>
          <div class="modal-footer">
            <span style="color:#ff0000;">* Obligatorio</span>
            <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
            <button type="submit" class="btn btn-success completar-no-conformidad"><span class="glyphicon glyphicon-ok"></span> Enviar </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalConsultaNoConformidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Detalle salida no conforme -
              <?php
              $nombre_orip = new No_Conformidad_Controlador();
              $nombre_orip->nombre_orip_controlador();
              ?>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div id="formulario-modal-no-conformidad-consulta"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/no_conformidad.js"></script>
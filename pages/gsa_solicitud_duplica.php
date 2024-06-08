<?php

if (isset($_POST['option']) and "" != $_POST['option']) { ?>

  <input type="hidden" class="form-control" name="id_solicitud_duplicar" value="<?php echo $_POST['option']; ?>" <div class="row">
  <div class="col-md-4">
    <label>Fecha Inicio</label>
  </div>
  <div class="col-md-8">
    <input type="date" class="form-control" name="fecha_inicio_duplica"><br>
  </div>

  <div class="col-md-4">
    <label>Fechal Final</label>
  </div>
  <div class="col-md-8">
    <input type="date" class="form-control" name="fecha_final_duplica"><br>
  </div>
  </div>

<?php }

<?php
require_once "modelo/cuotas_partes.php";
require_once "controlador/cuotas_partes.php";
$nump68 = privilegios(68, $_SESSION['snr']);
$nump67 = privilegios(67, $_SESSION['snr']);
$nump66 = privilegios(66, $_SESSION['snr']);

if (1 == $_SESSION['rol']  or 0 < $nump68 or 0 < $nump67 or 0 < $nump66) {

  if ((isset($_POST["nit"])) && ($_POST["nit"] != "") and (isset($_POST["insertentidad"])) && ($_POST["insertentidad"] != "")) {
    $insertSQL = sprintf(
      "INSERT INTO cuotas_partes_entidades (
     nit, 
     nombre_cuotas_partes_entidades,
     id_departamento,
     id_municipio,
     id_cuotas_partes_clasificacion,
     direccion,
     telefono,
     correo1,
     correo2,
     estado_cuotas_partes_entidades) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
      GetSQLValueString($_POST["nit"], "int"),
      GetSQLValueString($_POST["nombre_cuotas_partes_entidades"], "text"),
      GetSQLValueString($_POST["id_departamento"], "int"),
      GetSQLValueString($_POST["id_municipio"], "int"),
      GetSQLValueString($_POST["id_cuotas_partes_clasificacion"], "int"),
      GetSQLValueString($_POST["direccion"], "text"),
      GetSQLValueString($_POST["telefono"], "int"),
      GetSQLValueString($_POST["correo1"], "text"),
      GetSQLValueString($_POST["correo2"], "text"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);
    echo $insertado;
  } else {
  }

  if ((isset($_POST["id_cuotas_partes_entidades"])) && ($_POST["id_cuotas_partes_entidades"] != "") and (isset($_POST["updateEntidad"])) && ($_POST["updateEntidad"] != "")) {
    $updateSQL = sprintf(
      "UPDATE cuotas_partes_entidades SET nit=%s, nombre_cuotas_partes_entidades=%s, id_departamento=%s, id_municipio=%s, id_cuotas_partes_clasificacion=%s, direccion=%s, telefono=%s, correo1=%s, correo2=%s where id_cuotas_partes_entidades=%s",
      GetSQLValueString($_POST["nit"], "text"),
      GetSQLValueString($_POST["nombre_cuotas_partes_entidades"], "text"),
      GetSQLValueString($_POST["id_departamento"], "int"),
      GetSQLValueString($_POST["id_municipio"], "int"),
      GetSQLValueString($_POST["id_cuotas_partes_clasificacion"], "int"),
      GetSQLValueString($_POST["direccion"], "text"),
      GetSQLValueString($_POST["telefono"], "int"),
      GetSQLValueString($_POST["correo1"], "text"),
      GetSQLValueString($_POST["correo2"], "text"),
      GetSQLValueString($_POST["id_cuotas_partes_entidades"], "int")
    );
    $Result = mysql_query($updateSQL, $conexion);
    echo $actualizado;
  } else {
  }

  if ((isset($_POST["cedula_ciudadania"])) && ($_POST["cedula_ciudadania"] != "") and (isset($_POST["insertcausante"])) && ($_POST["insertcausante"] != "")) {
    $insertSQL = sprintf(
      "INSERT INTO cuotas_partes_datos_causante (
     cedula_ciudadania, 
     nombre_cuotas_partes_datos_causante,
     id_cuotas_partes_entidades,
     tipodocumento,

     numero_resolucion,
     fecha_inicial_resolucion,
     fecha_final_resolucion,

     estado_cedula,
     sustitucion,
  
     estado_cuotas_partes_datos_causante) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
      GetSQLValueString($_POST["cedula_ciudadania"], "int"),
      GetSQLValueString($_POST["nombre_cuotas_partes_datos_causante"], "text"),
      GetSQLValueString($_POST["id_cuotas_partes_entidades"], "int"),
      GetSQLValueString(1, "int"),

      GetSQLValueString($_POST["numero_resolucion"], "text"),
      GetSQLValueString($_POST["fecha_inicial_resolucion"], "date"),
      GetSQLValueString($_POST["fecha_final_resolucion"], "date"),

      GetSQLValueString($_POST["estado_cedula"], "int"),
      GetSQLValueString($_POST["sustitucion"], "int"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);
    echo $insertado;
  } else {
  }

  if ((isset($_POST["id_cuotas_partes_datos_causante"])) && ($_POST["id_cuotas_partes_datos_causante"] != "") and (isset($_POST["updateCausante"])) && ($_POST["updateCausante"] != "")) {
    $updateSQL = sprintf(
      "UPDATE cuotas_partes_datos_causante SET cedula_ciudadania=%s, nombre_cuotas_partes_datos_causante=%s, id_cuotas_partes_entidades=%s, numero_resolucion=%s, fecha_inicial_resolucion=%s, fecha_final_resolucion=%s, estado_cedula=%s, sustitucion=%s where id_cuotas_partes_datos_causante=%s",
      GetSQLValueString($_POST["cedula_ciudadania"], "int"),
      GetSQLValueString($_POST["nombre_cuotas_partes_datos_causante"], "text"),
      GetSQLValueString($_POST["id_cuotas_partes_entidades"], "int"),

      GetSQLValueString($_POST["numero_resolucion"], "text"),
      GetSQLValueString($_POST["fecha_inicial_resolucion"], "date"),
      GetSQLValueString($_POST["fecha_final_resolucion"], "date"),

      GetSQLValueString($_POST["estado_cedula"], "int"),
      GetSQLValueString($_POST["sustitucion"], "int"),
      GetSQLValueString($_POST["id_cuotas_partes_datos_causante"], "int")
    );
    $Result = mysql_query($updateSQL, $conexion);
    echo $actualizado;
  } else {
  }


  if ((isset($_POST["cedula_sustitucion"])) && ($_POST["cedula_sustitucion"] != "") and (isset($_POST["insertsustituto"])) && ($_POST["insertsustituto"] != "")) {
    $insertSQL = sprintf(
      "INSERT INTO cuotas_partes_sustitucion (
     id_cuotas_partes_datos_causante,
     cedula_sustitucion, 
     nombre_cuotas_partes_sustitucion,

     numero_resolucion,
     fecha_inicial_resolucion,
     fecha_final_resolucion,

     tipodoc,
     estado_cedula,
     estado_cuotas_partes_sustitucion) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
      GetSQLValueString($_POST["id_cuotas_partes_datos_causante"], "int"),
      GetSQLValueString($_POST["cedula_sustitucion"], "int"),
      GetSQLValueString($_POST["nombre_cuotas_partes_sustitucion"], "text"),

      GetSQLValueString($_POST["numero_resolucion"], "text"),
      GetSQLValueString($_POST["fecha_inicial_resolucion"], "date"),
      GetSQLValueString($_POST["fecha_final_resolucion"], "date"),

      GetSQLValueString(1, "int"),
      GetSQLValueString($_POST["estado_cedula"], "int"),
      GetSQLValueString(1, "int")
    );
    $Result = mysql_query($insertSQL, $conexion);
    echo $insertado;
  } else {
  }

  if ((isset($_POST["id_cuotas_partes_sustitucion"])) && ($_POST["id_cuotas_partes_sustitucion"] != "") and (isset($_POST["updateSustituto"])) && ($_POST["updateSustituto"] != "")) {
    $updateSQL = sprintf(
      "UPDATE cuotas_partes_sustitucion SET id_cuotas_partes_datos_causante=%s, cedula_sustitucion=%s, nombre_cuotas_partes_sustitucion=%s, numero_resolucion=%s, fecha_inicial_resolucion=%s, fecha_final_resolucion=%s, estado_cedula=%s where id_cuotas_partes_sustitucion=%s",
      GetSQLValueString($_POST["id_cuotas_partes_datos_causante"], "int"),
      GetSQLValueString($_POST["cedula_sustitucion"], "int"),
      GetSQLValueString($_POST["nombre_cuotas_partes_sustitucion"], "text"),

      GetSQLValueString($_POST["numero_resolucion"], "text"),
      GetSQLValueString($_POST["fecha_inicial_resolucion"], "date"),
      GetSQLValueString($_POST["fecha_final_resolucion"], "date"),

      GetSQLValueString($_POST["estado_cedula"], "text"),
      GetSQLValueString($_POST["id_cuotas_partes_sustitucion"], "int")
    );
    $Result = mysql_query($updateSQL, $conexion);
    echo $actualizado;
  } else {
  }
?>

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo existencia('cuotas_partes_entidades'); ?></h3>

          <p>Entidades</p>
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
          <h3><?php echo existencia('cuotas_partes_datos_causante'); ?></h3>

          <p>Causantes</p>
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
          <h3><?php echo existencia('cuotas_partes_sustitucion'); ?></h3>

          <p>Sustitutos</p>
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


          <h3><?php echo existencia('cuotas_partes_pagos_entidades'); ?></h3>

          <p>Cuentas de Cobro</p>
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
          <h3 class="box-title"><strong> Editar Entidades | Causantes | Sustitutos </strong></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Entidades</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Causantes</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true">Sustitutos</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <?php
                $editarEntidades = new cuotasPartesControlador();
                $editarEntidades->editarEntidadesControlador();
                ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <?php
                $editarCausante = new cuotasPartesControlador();
                $editarCausante->editarCausanteControlador();
                ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <?php
                $editarSustituto = new cuotasPartesControlador();
                $editarSustituto->editarSustitucionControlador();
                ?>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <script type="text/javascript" language="javascript" src="js/cuotas_partes.js"></script>


  <div class="modal fade bd-example" id="popupinsertentidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Nueva Entidad</label> </h4>
        </div>
        <form method="POST" name="insertentidad">
          <div class="row" style="padding:10px 30px;">
            <div class="col-md-6">
              <label for="inputSuma"><span style="color:#ff0000;">*</span>Nit</label>
              <input type="number" class="form-control" name="nit" required>
            </div>
            <div class="col-md-6">
              <label for="inputSuma"><span style="color:#ff0000;">*</span>Razón Social</label>
              <input type="text" class="form-control" name="nombre_cuotas_partes_entidades" required>
            </div>

            <div class="col-md-6">
              <label class="control-label"><span style="color:#ff0000;">*</span> Departamento</label>
              <select name="id_departamento" id="id_departamentomun" class="form-control">

                <option value="" selected></option>
                <?php
                $query = sprintf("SELECT id_departamento, nombre_departamento FROM departamento where estado_departamento=1 order by id_departamento");
                $select = mysql_query($query, $conexion) or die(mysql_error());
                $row = mysql_fetch_assoc($select);
                $totalRows = mysql_num_rows($select);
                if (0 < $totalRows) {
                  do {
                    echo '<option value="' . $row['id_departamento'] . '">' . strtoupper($row['nombre_departamento']) . '</option>';
                  } while ($row = mysql_fetch_assoc($select));
                } else {
                }
                mysql_free_result($select);
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="input"><span style="color:#ff0000;">*</span> Ciudad:</label>
              <select class="form-control" name="id_municipio" id="id_municipiomun" required>

              </select>
            </div>

            <div class="col-md-6">
              <label class="control-label"><span style="color:#ff0000;">*</span> Clasificacion</label>
              <select name="id_cuotas_partes_clasificacion" class="form-control">
                <option>--- Seleccionar ---</option>
                <?php echo listapordefecto('cuotas_partes_clasificacion', 1300, $row['id_cuotas_partes_clasificacion']); ?>
              </select>
            </div>

            <div class="col-md-6">
              <label>Dirección</label>
              <input type="text" class="form-control" name="direccion">
            </div>

            <div class="col-md-6">
              <label>telefono</label>
              <input type="number" class="form-control" name="telefono">
            </div>

            <div class="col-md-6">
              <label>Correo</label>
              <input type="email" class="form-control" name="correo1">
            </div>

            <div class="col-md-6">
              <label>Correo Opcional</label>
              <input type="email" class="form-control" name="correo2">
            </div>

            <div class="col-sm-12" style="margin-top:10px;">
              <button style="float:right;" type="submit" class="btn btn-success" name="insertentidad" value="1">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example" id="popupeditarentidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Editar Entidad</label> </h4>
        </div>
        <div id="divEntidadEditar" class="modal-body">

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example" id="popupinsertcausante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Nuevo Causante</label> </h4>
        </div>
        <form method="POST" name="insertcausante">
          <div class="row" style="padding:10px 30px;">

            <div class="col-md-6">
              <label><span style="color:#ff0000;">*</span>Numero de Documento</label>
              <input type="number" class="form-control" name="cedula_ciudadania" required>
            </div>

            <div class="col-md-6">
              <label for="input"><span style="color:#ff0000;">*</span> Entidad (Cuota Parte):</label>
              <select name="id_cuotas_partes_entidades" class="form-control">
                <option>--- Seleccionar ---</option>
                <?php echo listapordefecto('cuotas_partes_entidades', 1300, $row['id_cuotas_partes_entidades']); ?>
              </select>
            </div>

            <div class="col-md-12">
              <label><span style="color:#ff0000;">*</span>Nombres Y Apellidos</label>
              <input type="text" class="form-control" name="nombre_cuotas_partes_datos_causante" required>
            </div>

            <div class="col-md-4">
              <label><span style="color:#ff0000;">*</span>Numero Resolución</label>
              <input type="text" class="form-control" name="numero_resolucion" required>
            </div>

            <div class="col-md-4">
              <label><span style="color:#ff0000;">*</span>Fecha Inicial Resolución</label>
              <input type="date" class="form-control" name="fecha_inicial_resolucion" required>
            </div>

            <div class="col-md-4">
              <label><span style="color:#ff0000;">*</span>Fecha Final Resolución</label>
              <input type="date" class="form-control" name="fecha_final_resolucion" required>
            </div>

            <div class="col-md-6">
              <label class="control-label"><span style="color:#ff0000;">*</span> Estado (Vive o No): </label>
              <select name="estado_cedula" class="form-control">
                <option>--- Seleccionar ---</option>
                <option value="0">INACTIVO</option>
                <option value="1">ACTIVO</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="control-label"><span style="color:#ff0000;">*</span> Sustito(s): </label>
              <select name="sustitucion" class="form-control">
                <option>--- Seleccionar ---</option>
                <option value="0">NO</option>
                <option value="1">SI</option>
              </select>
            </div>

            <div class="col-sm-12" style="margin-top:10px;">
              <button style="float:right;" type="submit" class="btn btn-success" name="insertcausante" value="1">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example" id="popupeditarcausante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Editar Causante</label> </h4>
        </div>
        <div id="divEntidadCausante" class="modal-body">

        </div>
      </div>
    </div>
  </div>


  <div class="modal fade bd-example" id="popupinsertsustituto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Nuevo Sustituto</label> </h4>
        </div>
        <form method="POST" name="insertsustituto">
          <div class="row" style="padding:10px 30px;">

            <div class="col-md-6">
              <label><span style="color:#ff0000;">*</span>Numero de Documento</label>
              <input type="number" class="form-control" name="cedula_sustitucion" required>
            </div>

            <div class="col-md-6">
              <label for="input"><span style="color:#ff0000;">*</span> Causante:</label>
              <select name="id_cuotas_partes_datos_causante" class="form-control">
                <option>--- Seleccionar ---</option>
                <?php echo listapordefecto('cuotas_partes_datos_causante', 1300, $row['id_cuotas_partes_datos_causante']); ?>
              </select>
            </div>

            <div class="col-md-12">
              <label><span style="color:#ff0000;">*</span>Nombres Y Apellidos</label>
              <input type="text" class="form-control" name="nombre_cuotas_partes_sustitucion" required>
            </div>

            <div class="col-md-4">
              <label><span style="color:#ff0000;">*</span>Numero Resolución</label>
              <input type="text" class="form-control" name="numero_resolucion" required>
            </div>

            <div class="col-md-4">
              <label><span style="color:#ff0000;">*</span>Fecha Inicial Resolución</label>
              <input type="date" class="form-control" name="fecha_inicial_resolucion" required>
            </div>

            <div class="col-md-4">
              <label><span style="color:#ff0000;">*</span>Fecha Final Resolución</label>
              <input type="date" class="form-control" name="fecha_final_resolucion" required>
            </div>

            <div class="col-md-6">
              <label class="control-label"><span style="color:#ff0000;">*</span> Estado (Vive o No): </label>
              <select name="estado_cedula" class="form-control">
                <option>--- Seleccionar ---</option>
                <option value="0">INACTIVO</option>
                <option value="1">ACTIVO</option>
              </select>
            </div>

            <div class="col-sm-12" style="margin-top:10px;">
              <button style="float:right;" type="submit" class="btn btn-success" name="insertsustituto" value="1">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade bd-example" id="popupeditarsustitucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel"><label class="control-label">Editar Sustituto</label> </h4>
        </div>
        <div id="divEntidadSustitucion" class="modal-body">

        </div>
      </div>
    </div>
  </div>

<?php
}

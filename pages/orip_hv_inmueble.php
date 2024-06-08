<?php
$nump135 = privilegios(135, $_SESSION['snr']); // Administrador Hoja de Vida Bien Inmueble

// Fecha Actual
date_default_timezone_set("America/Bogota");
$fechaActual = date("Y-m-d H:i:s");
$fechaAno = date("Y");

// INSERT Información Bien Inmueble
if (isset($_POST['guardar_info_bien_inmueble']) && "" != $_POST['guardar_info_bien_inmueble']) {

  $insertSQL = sprintf(
    "INSERT INTO oficina_registro_inmueble (
    fecha_adquisicion,
    num_escritura,
    nombre_notaria,
    num_cedula_catastral,
    num_matricula_inmobiliaria,
    porcentaje_propiedad,
    tipo_uso_inmueble,
    inmueble_declarado_patrimonio,
    num_acto_administrativo,
    area_terreno,

    area_construida,
    num_pisos,
    area_patio,
    area_zonas_verdes,
    num_asensores,
    carga_electrica_kva,
    num_contadores_electricos,
    num_puntos_red,
    num_lamparas,
    num_banos,

    num_bano_discapacitados,
    num_und_sanitarias,
    num_extintores,
    num_camaras_vigilancia,
    num_vigilantes,
    num_escrituras_registradas,
    num_libros,
    modulo_atencion_discapacitados,
    existe_enfermeria,
    fecha_creado)
    VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s,%s,%s,%s,%s, %s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
    GetSQLValueString($_POST['fecha_adquisicion'], "date"),
    GetSQLValueString($_POST['num_escritura'], "text"),
    GetSQLValueString($_POST['nombre_notaria'], "text"),
    GetSQLValueString($_POST['num_cedula_catastral'], "text"),
    GetSQLValueString($_POST['num_matricula_inmobiliaria'], "text"),
    GetSQLValueString($_POST['porcentaje_propiedad'], "text"),
    GetSQLValueString($_POST['tipo_uso_inmueble'], "text"),
    GetSQLValueString($_POST['inmueble_declarado_patrimonio'], "text"),
    GetSQLValueString($_POST['num_acto_administrativo'], "text"),
    GetSQLValueString($_POST['area_terreno'], "text"),

    GetSQLValueString($_POST['area_construida'], "text"),
    GetSQLValueString($_POST['num_pisos'], "int"),
    GetSQLValueString($_POST['area_patio'], "text"),
    GetSQLValueString($_POST['area_zonas_verdes'], "text"),
    GetSQLValueString($_POST['num_asensores'], "int"),
    GetSQLValueString($_POST['carga_electrica_kva'], "text"),
    GetSQLValueString($_POST['num_contadores_electricos'], "int"),
    GetSQLValueString($_POST['num_puntos_red'], "int"),
    GetSQLValueString($_POST['num_lamparas'], "int"),
    GetSQLValueString($_POST['num_banos'], "int"),

    GetSQLValueString($_POST['num_bano_discapacitados'], "int"),
    GetSQLValueString($_POST['num_und_sanitarias'], "int"),
    GetSQLValueString($_POST['num_extintores'], "int"),
    GetSQLValueString($_POST['num_camaras_vigilancia'], "int"),
    GetSQLValueString($_POST['num_vigilantes'], "int"),
    GetSQLValueString($_POST['num_escrituras_registradas'], "int"),
    GetSQLValueString($_POST['num_libros'], "int"),
    GetSQLValueString($_POST['modulo_atencion_discapacitados'], "text"),
    GetSQLValueString($_POST['existe_enfermeria'], "text"),
    GetSQLValueString($fechaActual, "date")
  );
  $Result = mysql_query($insertSQL, $conexion);
  echo $insertado;
  mysql_free_result($Result);
}
?>

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <?php if (0 < $nump135 || 1 == $_SESSION['rol']) { ?>
          <div style="margin: 10px;">
            <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#popuphojadevida" title="Hoja de Vida"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo</button>
          </div>
        <?php } ?>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="hojadevida" cellspacing="0" width="100%">
            <thead>
              <tr align="center" valign="middle">
                <th>Id</th>
                <th>Asignado</th>
                <th>Cod Municipal</th>
                <th>Direccion</th>
                <th>Barrio</th>
                <th>Cedula Catastral</th>
                <th>Numero Matricula Inmo.</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query5 = "SELECT * FROM oficina_registro_inmueble WHERE estado_oficina_registro_inmueble=1";
              $result5 = $mysqli->query($query5);
              while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) {
                if ($row5) {
              ?>
                  <tr>
                    <td><?php echo isset($row5) ? $row5['id_oficina_registro_inmueble'] : ''; ?></td>
                    <td><?php echo isset($row5) ? $row5['nombre_oficina_registro_inmueble'] : ''; ?></td>
                    <td><?php echo isset($row5) ? $row5['codigo_municipal'] : ''; ?></td>
                    <td><?php echo isset($row5) ? $row5['direccion'] : ''; ?></td>
                    <td><?php echo isset($row5) ? $row5['barrio'] : ''; ?></td>
                    <td><?php echo isset($row5) ? $row5['num_cedula_catastral'] : ''; ?></td>
                    <td><?php echo isset($row5) ? $row5['num_matricula_inmobiliaria'] : ''; ?></td>
                    <td>
                      <a href="orip_hv_inmueble_detalle&<?php echo $row5['id_oficina_registro_inmueble']; ?>.jsp" class="btn btn-info btn-xs">
                        <i class="fa fa-search" title="Detalle"></i>
                      </a>
                    </td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
          <script>
            $(document).ready(function() {
              $('#hojadevida').DataTable({
                "language": {
                  "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                "aaSorting": [
                  [0, "desc"]
                ]
              });
            });
          </script>
        </div>

      </div>
    </div>
  </div>
</div>


<!-- MODAL CREAR HOJA DE VIDA INMUEBLE -->
<div class="modal fade" id="popuphojadevida" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <b>Nuevo Bien Inmueble</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" name="forminmueble123">
          <table class="table">
            <tr>
              <th>Fecha Adquisición</th>
              <td><input type="date" class="form-control" name="fecha_adquisicion"></td>
            </tr>
            <tr>
              <th>Numero Escritura</th>
              <td><input type="text" class="form-control" name="num_escritura"></td>
            </tr>
            <tr>
              <th>Notaria de Registro</th>
              <td><input type="text" class="form-control" name="nombre_notaria"></td>
            </tr>
            <tr>
              <th>Cedula Catastral</th>
              <td><input type="text" class="form-control" name="num_cedula_catastral"></td>
            </tr>
            <tr>
              <th>Numero Matricula Inmobiliaria</th>
              <td><input type="text" class="form-control" name="num_matricula_inmobiliaria"></td>
            </tr>
            <tr>
              <th>Porcentaje (%) de Propiedad</th>
              <td><input type="number" class="form-control" name="porcentaje_propiedad"></td>
            </tr>
            <tr>
              <th>Tipo de Uso</th>
              <td>
                <select name="tipo_uso_inmueble" class="form-control">
                  <option value=""></option>
                  <option value="Propio">Propio</option>
                  <option value="Arriendo">Arriendo</option>
                  <option value="Comodato">Comodato</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>Inmueble Declarado Patrimonio</th>
              <td>
                <select name="inmueble_declarado_patrimonio" class="form-control">
                  <option value=""></option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>Numero Acto Administrativo</th>
              <td><input type="number" class="form-control" name="num_acto_administrativo"></td>
            </tr>
            <tr>
            <tr>
              <th>Area terreno</th>
              <td><input type="text" class="form-control" name="area_terreno" placeholder="m2"></td>
            </tr>
            <tr>
              <th>Area construida</th>
              <td><input type="text" class="form-control" name="area_construida" placeholder="m2"></td>
            </tr>
            <tr>
              <th>Numero Pisos</th>
              <td><input type="number" class="form-control" name="num_pisos"></td>
            </tr>
            <tr>
              <th>Area patio</th>
              <td><input type="text" class="form-control" name="area_patio" placeholder="m2"></td>
            </tr>
            <tr>
              <th>Area zona verdes</th>
              <td><input type="text" class="form-control" name="area_zonas_verdes" placeholder="m2"></td>
            </tr>
            <tr>
              <th>Numero asensores</th>
              <td><input type="number" class="form-control" name="num_asensores"></td>
            </tr>
            <tr>
              <th>Carga Electrica (KVA)</th>
              <td><input type="text" class="form-control" name="carga_electrica_kva"></td>
            </tr>
            <tr>
              <th>Numero contadores electricos</th>
              <td><input type="number" class="form-control" name="num_contadores_electricos"></td>
            </tr>
            <tr>
              <th>Numero puntos red</th>
              <td><input type="number" class="form-control" name="num_puntos_red"></td>
            </tr>
            <tr>
              <th>Numero lamparas</th>
              <td><input type="number" class="form-control" name="num_lamparas"></td>
            </tr>
            <tr>
              <th>Numero baños</th>
              <td><input type="number" class="form-control" name="num_banos"></td>
            </tr>
            <tr>
              <th>Numero baños (Discapasitados)</th>
              <td><input type="number" class="form-control" name="num_bano_discapacitados"></td>
            </tr>
            <tr>
              <th>Numero und Sanitarias</th>
              <td><input type="number" class="form-control" name="num_und_sanitarias"></td>
            </tr>
            <tr>
              <th>Numero extintores</th>
              <td><input type="number" class="form-control" name="num_extintores"></td>
            </tr>
            <tr>
              <th>Numero camaras vig</th>
              <td><input type="number" class="form-control" name="num_camaras_vigilancia"></td>
            </tr>
            <tr>
              <th>Numero vigilantes</th>
              <td><input type="number" class="form-control" name="num_vigilantes"></td>
            </tr>
            <tr>
              <th>Numero escrituras registradas</th>
              <td><input type="number" class="form-control" name="num_escrituras_registradas"></td>
            </tr>
            <tr>
              <th>Numero libros</th>
              <td><input type="number" class="form-control" name="num_libros"></td>
            </tr>
            <tr>
              <th>Existe Modulo atencion (Discapasitados)</th>
              <td>
                <select name="modulo_atencion_discapacitados" class="form-control">
                  <option value=""></option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>Existe enfermeria</th>
              <td>
                <select name="existe_enfermeria" class="form-control">
                  <option value=""></option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </td>
            </tr>
          </table>
          <div class="modal-footer"><button type="reset" class="btn btn-default btn-xs" data-dismiss="modal" onClick="this.form.reset()">
              <span class="glyphicon glyphicon-remove"></span> Cancelar</button>
            <button type="submit" class="btn btn-success btn-xs">
              <input type="hidden" name="guardar_info_bien_inmueble" value="guardar_info_bien_inmueble">
              <span class="glyphicon glyphicon-ok"></span> Guardar </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
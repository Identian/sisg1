<?php
session_start();
include '../conf.php';
include 'listas.php';
$nump85 = privilegios(85, $_SESSION['snr']);  // COORDINADOR ASEO CAFETERIA
$nump86 = privilegios(86, $_SESSION['snr']);  // ADMINISTRADOR ASEO Y CAFETERIA


if (isset($_POST['option']) and "" != $_POST['option']) {

  $idSolicitud = $_POST['option'];

  // CONSULTA DE VARIABLES GLOBALES
  $queryes = "SELECT gsa_solicitud.fecha_inicio, gsa_solicitud.fecha_final, gsa_solicitud.estado_snr, funcionario.nombre_funcionario, gsa_proveedor.nombre_gsa_proveedor FROM gsa_solicitud
  LEFT JOIN gsa_orden
  ON gsa_solicitud.id_gsa_orden=gsa_orden.id_gsa_orden
  LEFT JOIN funcionario
  ON gsa_orden.id_funcionario=funcionario.id_funcionario
  LEFT JOIN gsa_proveedor
  ON gsa_orden.id_gsa_proveedor=gsa_proveedor.id_gsa_proveedor
  WHERE id_gsa_solicitud=$idSolicitud AND estado_gsa_solicitud=1";
  $selectes = mysql_query($queryes, $conexion);
  $rowes = mysql_fetch_assoc($selectes);
  $fechaInicioC = date_create($rowes['fecha_inicio']);
  $fechaInicial = date_format($fechaInicioC, "d/m/Y");
  $fechaFinalC = date_create($rowes['fecha_final']);
  $fechaFinal = date_format($fechaFinalC, "d/m/Y");
  $estadoSnr = $rowes['estado_snr'];
  $funcionariogsa = $rowes['nombre_funcionario'];
  $nombreProveedor = $rowes['nombre_gsa_proveedor'];


  // CONSULTA DE VARIABLES PERFIL DE MODULOS OFICINAS DE REGISTRO
  $idfun = $_SESSION['snr'];
  $consulfun = "SELECT 
  oficina_registro.id_oficina_registro,
  oficina_registro.nombre_oficina_registro,
  funcionario.nombre_funcionario
  FROM funcionario
  LEFT JOIN oficina_registro
  ON funcionario.id_oficina_registro=oficina_registro.id_oficina_registro
  WHERE funcionario.id_funcionario=$idfun AND funcionario.estado_funcionario=1";
  $selectfun = mysql_query($consulfun, $conexion);
  $rowfun = mysql_fetch_assoc($selectfun);
  if (isset($rowfun)) {
    $oficinaRegistro = $rowfun['id_oficina_registro'];
    $NombreoficinaRegistro = $rowfun['nombre_oficina_registro'];
  } else {
    $oficinaRegistro = 0;
  }


  // CONSULTA LUGAR DEL PUNTO UBICACION
  $consulpunto = "SELECT 
  punto_ubicacion.id_punto_ubicacion, 
  punto_ubicacion.nombre_punto_ubicacion,
  funcionario.nombre_funcionario
  FROM punto_ubicacion_enlace
  LEFT JOIN punto_ubicacion
  ON punto_ubicacion_enlace.id_punto_ubicacion=punto_ubicacion.id_punto_ubicacion
  LEFT JOIN funcionario
  ON punto_ubicacion_enlace.id_funcionario=funcionario.id_funcionario
  WHERE punto_ubicacion_enlace.id_funcionario=$idfun AND punto_ubicacion_enlace.estado_punto_ubicacion_enlace=1";
  $selectpunto = mysql_query($consulpunto, $conexion);
  $rowpunto = mysql_fetch_assoc($selectpunto);
  if (isset($rowpunto)) {
    $puntoUbicacion = $rowpunto['id_punto_ubicacion'];
    $NombrepuntoUbicacion = $rowpunto['nombre_punto_ubicacion'];
  } else {
    $puntoUbicacion = 0;
  }


  // BUSCA EN VERIFICA QUE LA OFICINA, PUNTO UBICACION A GSA_VERIFICA_SOLICITUD
  if (NULL != $oficinaRegistro or 0 != $oficinaRegistro) {
    $consulfun = "SELECT id_gsa_verifica_solicitud, estado_gsa_verifica_solicitud, fecha_verificado, id_funcionario, observacion, estado_observacion FROM gsa_verifica_solicitud
    WHERE id_gsa_solicitud=$idSolicitud AND id_oficina_registro=$oficinaRegistro";
  }
  if (NULL != $puntoUbicacion or 0 != $puntoUbicacion) {
    $consulfun = "SELECT id_gsa_verifica_solicitud, estado_gsa_verifica_solicitud, fecha_verificado, id_funcionario, observacion, estado_observacion FROM gsa_verifica_solicitud
    WHERE id_gsa_solicitud=$idSolicitud AND id_punto_ubicacion=$puntoUbicacion";
  }
  $selectfun = mysql_query($consulfun, $conexion);
  $rowSolicitud = mysql_fetch_assoc($selectfun);
  $idverificado = $rowSolicitud['id_gsa_verifica_solicitud'];
  $estadoverificado = $rowSolicitud['estado_gsa_verifica_solicitud'];
  $funcionarioverificado = $rowSolicitud['id_funcionario'];
  $fechaVerificadoC = date_create($rowSolicitud['fecha_verificado']);
  $fechaVerificado = date_format($fechaVerificadoC, "d/m/Y H:i:s");
  $campoObservacion = $rowSolicitud['observacion'];
  $estadoObservacion = $rowSolicitud['estado_observacion'];
  if (is_null($estadoverificado)) {
    $estadoNumVerifica = 0;
    $estadoNomVerifica = 'Pendiente';
  } elseif (1 == $estadoverificado) {
    $estadoNumVerifica = 1;
    $estadoNomVerifica = 'Verificado';
  }


  if (1 == $_SESSION['rol'] or 0 < $nump86 or 0 < $nump85) {
    $privilegio = 0;
  } elseif (0 != $oficinaRegistro and 0 < privreg($oficinaRegistro, $idfun, 5, 10)) {
    $privilegio = 1;
  } elseif (0 != $puntoUbicacion) {
    $privilegio = 2;
  } ?>

  <script>
    // Funcion para no duplicar envios de formularios
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

    function fechaProgramaFumigacion(tabla, var2, var3) {
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + tabla + '-' + var2 + '-' + var3,
        async: true,
        success: function(html) {}
      })
    }

    function fechaRealizaFumigacion(tabla, var2, var3) {
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + tabla + '-' + var2 + '-' + var3,
        async: true,
        success: function(html) {}
      })
    }

    function valorServicioFumigacion(tabla, var2, var3) {
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + tabla + '-' + var2 + '-' + var3,
        async: true,
        success: function(html) {}
      })
    }

    function nombrePersonalFumigacion(tabla, var2, var3) {
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + tabla + '-' + var2 + '-' + var3,
        async: true,
        success: function(html) {}
      })
    }

    function campoObservacion(tabla, var2, var3, var4) {
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + tabla + '-' + var2 + '-' + var3 + '-' + var4,
        async: true,
        success: function(html) {
          location.reload()
        }
      })
    }

    function EditarcampoObservacion(tabla, var2, var3) {
      jQuery.ajax({
        type: "POST",
        url: "pages/gsa_actualizar.php",
        data: 'option=' + tabla + '-' + var2 + '-' + var3,
        async: true,
        success: function(html) {
          location.reload()
        }
      })
    }
  </script>

  <div class="box box-primary">
    <div class="row" style="margin:20px 5px;">
      <div class="table-responsive" style="height: 600px;">

        <?php if (0 == $privilegio) { ?>

          <table class="table table-striped table-bordered table-hover" id="TablaFumigacion" cellspacing="0" width="100%">
            <thead>
              <tr style="background-color: #eee;">
                <th>Oficina O Ubicacion</th>
                <th>Fecha Programada</th>
                <th>Valor Servicio</th>
                <th>Fecha Servicio</th>
                <th>Nombre Personal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $totalFacturacionExcel = 0;
              $query = "SELECT 
              oficina_registro.nombre_oficina_registro,
              punto_ubicacion.nombre_punto_ubicacion,
              gsa_solicitud_fumigacion.id_solicitud,
              gsa_solicitud_fumigacion.id_gsa_solicitud_fumigacion,
              gsa_solicitud_fumigacion.fecha_programa,
              gsa_solicitud_fumigacion.valor_servicio,
              gsa_solicitud_fumigacion.nombre_personal,
              gsa_solicitud_fumigacion.fecha_realiza,
              gsa_solicitud.fecha_inicio,
              gsa_solicitud.fecha_final
              FROM gsa_solicitud_fumigacion
              LEFT JOIN gsa_solicitud
              ON gsa_solicitud_fumigacion.id_solicitud=gsa_solicitud.id_gsa_solicitud
              LEFT JOIN oficina_registro
              ON oficina_registro.id_oficina_registro=gsa_solicitud_fumigacion.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON punto_ubicacion.id_punto_ubicacion=gsa_solicitud_fumigacion.id_punto_ubicacion
              WHERE gsa_solicitud_fumigacion.id_solicitud = $idSolicitud";
              $select = mysql_query($query, $conexion);
              $rowD1 = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  $cantidadPrecio = $rowD1['valor_servicio'];
                  $totalFacturacionExcel += $cantidadPrecio;
                  echo '<tr>';
                  echo '<td>' . $rowD1['nombre_oficina_registro'] . '' . $rowD1['nombre_punto_ubicacion'] . '</td>';

                  if (0 == $estadoSnr) {  ?>
                    <td>
                      <?php if (is_null($rowD1['fecha_programa'])) {
                        $fechaProgramaFumigacionC = '';
                      } else {
                        $fechaProgramaFumigacion = date_create($rowD1['fecha_programa']);
                        $fechaProgramaFumigacionC = date_format($fechaProgramaFumigacion, "d/m/Y");
                      } ?>
                      <input style="width:100px; text-align: center; border-radius:0px; border:solid 1px #999;" type="text" id="fecha_programa" name="fecha_programa" value="<?php echo $fechaProgramaFumigacionC; ?>" onchange="fechaProgramaFumigacion('fechaProgramaFumigacion', this.value, <?php echo $rowD1['id_gsa_solicitud_fumigacion']; ?>);" placeholder="dia/mes/año" pattern="[0-9/]{10}" title="Formato: dia/mes/año" />
                    </td>
                    <td>
                      <input style="width:150px; text-align: center; border-radius:0px; border:solid 1px #999;" type="number" value="<?php echo $rowD1['valor_servicio']; ?>" onchange="valorServicioFumigacion('valorServicioFumigacion', this.value, <?php echo $rowD1['id_gsa_solicitud_fumigacion']; ?>);" />
                    </td><?php
                        }
                        $botones = "";
                        if (1 == $estadoSnr) {
                          echo '<td>' . $rowD1['fecha_programa'] . '</td>';
                          echo '<td>' . $rowD1['valor_servicio'] . '</td>';
                          $botones = "
                    {
                      extend: 'excelHtml5',
                      text: 'Excel',
                      title: 'REPORTE FUMIGACION SOLICITUD # " . $rowD1['id_solicitud'] . " DEL PERIODO DESDE " . $rowD1['fecha_inicio'] . " HASTA " . $rowD1['fecha_final'] . "',
                    }";
                        }
                        echo '<td>' . $rowD1['fecha_realiza'] . '</td>';
                        echo '<td>' . $rowD1['nombre_personal'] . '</td>';
                      } while ($rowD1 = mysql_fetch_assoc($select));
                      mysql_free_result($select);
                    }
                    echo '</tr>'; ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Total</th>
                <th><?php echo number_format($totalFacturacionExcel, 2, '.', ','); ?></th>
              </tr>
            </tfoot>
            <script>
              $(document).ready(function() {
                var t = $('#TablaFumigacion').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                    <?php echo $botones; ?>
                  ],
                  "lengthMenu": [
                    [100, 200, 300, 500],
                    [100, 200, 300, 500]
                  ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                  },
                  "aaSorting": [
                    [0, "asc"]
                  ]
                });
              });
            </script>
          </table>

        <?php } elseif (1 == $privilegio or 2 == $privilegio) { ?>

          <table class="table table-striped table-bordered table-hover" id="gsaFumigacion" cellspacing="0" width="100%">
            <thead>
              <tr style="background-color: #eee;">
                <th>Oficina O Ubicacion</th>
                <th>Fecha Programada</th>
                <th>Fecha Servicio</th>
                <th>Nombre Personal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (1 == $privilegio) {
                $queryoficinapunto = 'gsa_solicitud_fumigacion.id_oficina_registro=' . $oficinaRegistro . '';
                $NombreImpreso = $NombreoficinaRegistro;
              }
              if (2 == $privilegio) {
                $queryoficinapunto = 'gsa_solicitud_fumigacion.id_punto_ubicacion=' . $puntoUbicacion . '';
                $NombreImpreso = $NombrepuntoUbicacion;
              }
              $query = "SELECT 
              oficina_registro.nombre_oficina_registro,
              punto_ubicacion.nombre_punto_ubicacion,
              gsa_solicitud_fumigacion.id_solicitud,
              gsa_solicitud_fumigacion.id_gsa_solicitud_fumigacion,
              gsa_solicitud_fumigacion.fecha_programa,
              gsa_solicitud_fumigacion.nombre_personal,
              gsa_solicitud_fumigacion.fecha_realiza,
              gsa_solicitud.fecha_inicio,
              gsa_solicitud.fecha_final
              FROM gsa_solicitud_fumigacion
              LEFT JOIN gsa_solicitud
              ON gsa_solicitud_fumigacion.id_solicitud=gsa_solicitud.id_gsa_solicitud
              LEFT JOIN oficina_registro
              ON oficina_registro.id_oficina_registro=gsa_solicitud_fumigacion.id_oficina_registro
              LEFT JOIN punto_ubicacion
              ON punto_ubicacion.id_punto_ubicacion=gsa_solicitud_fumigacion.id_punto_ubicacion
              WHERE gsa_solicitud.id_gsa_solicitud = $idSolicitud AND gsa_solicitud_fumigacion.id_solicitud = $idSolicitud AND $queryoficinapunto AND gsa_solicitud_fumigacion.estado_gsa_solicitud_fumigacion=1";
              $select = mysql_query($query, $conexion);
              $rowD2 = mysql_fetch_assoc($select);
              $totalRows = mysql_num_rows($select);
              if (0 < $totalRows) {
                do {
                  echo '<tr>';
                  echo '<td>' . $rowD2['nombre_oficina_registro'] . '' . $rowD2['nombre_punto_ubicacion'] . '</td>';

                  if (0 == $estadoSnr) {  ?>
                    <td>
                      <?php if (is_null($rowD2['fecha_programa'])) {
                        $fechaProgramaFumigacionC = '';
                      } else {
                        $fechaProgramaFumigacion = date_create($rowD2['fecha_programa']);
                        $fechaProgramaFumigacionC = date_format($fechaProgramaFumigacion, "d/m/Y");
                      } ?>
                      <input style="width:100px; text-align: center; border-radius:0px; border:solid 1px #999;" type="text" value="<?php echo $fechaProgramaFumigacionC; ?>" onchange="fechaProgramaFumigacion('fechaProgramaFumigacion', this.value, <?php echo $rowD2['id_gsa_solicitud_fumigacion']; ?>);" placeholder="dia/mes/año" pattern="[0-9/]{10}" title="Formato: dia/mes/año" />
                    </td>
                    <td>
                      <input style="width:150px; text-align: center; border-radius:0px; border:solid 1px #999;" type="number" value="<?php echo $rowD2['valor_servicio']; ?>" onchange="valorServicioFumigacion('valorServicioFumigacion', this.value, <?php echo $rowD2['id_gsa_solicitud_fumigacion']; ?>);" />
                    </td><?php
                        }
                        if (1 == $estadoSnr) {
                          if (is_null($rowD2['fecha_programa'])) {
                            $fechaC = '';
                          } else {
                            $fecha = date_create($rowD2['fecha_programa']);
                            $fechaC = date_format($fecha, "d/m/Y");
                          }
                          echo '<td>' . $fechaC . '</td>';
                        }
                        if (0 === $estadoNumVerifica) { ?>
                    <td>
                      <?php if (is_null($rowD2['fecha_realiza'])) {
                            $fechaProgramaFumigacionC = '';
                          } else {
                            $fechaProgramaFumigacion = date_create($rowD2['fecha_realiza']);
                            $fechaProgramaFumigacionC = date_format($fechaProgramaFumigacion, "d/m/Y");
                          } ?>
                      <input style="width:100px; text-align: center; border-radius:0px; border:solid 1px #999;" type="text" value="<?php echo $fechaProgramaFumigacionC; ?>" onchange="fechaRealizaFumigacion('fechaRealizaFumigacion', this.value, <?php echo $rowD2['id_gsa_solicitud_fumigacion']; ?>);" placeholder="dia/mes/año" pattern="[0-9/]{10}" title="Formato: dia/mes/año" />
                    </td>
                    <td>
                      <input style="width:200px; text-align: center; border-radius:0px; border:solid 1px #999;" type="text" value="<?php echo $rowD2['nombre_personal']; ?>" onchange="nombrePersonalFumigacion('nombrePersonalFumigacion', this.value, <?php echo $rowD2['id_gsa_solicitud_fumigacion']; ?>);" />
                    </td><?php
                        }
                        if (1 === $estadoNumVerifica) {
                          if (is_null($rowD2['fecha_realiza'])) {
                            $fechaC = '';
                          } else {
                            $fecha = date_create($rowD2['fecha_realiza']);
                            $fechaC = date_format($fecha, "d/m/Y");
                          }
                          echo '<td>' . $fechaC . '</td>';
                          echo '<td>' . $rowD2['nombre_personal'] . '</td>';
                        }
                      } while ($rowD2 = mysql_fetch_assoc($select));
                      mysql_free_result($select);
                    }
                    echo '</tr>'; ?>
            </tbody>
            <?php if (0 === $estadoNumVerifica) {
            }
            if (1 === $estadoNumVerifica) { ?>
              <tfoot>
                <tr>
                  <th>Observación</th>
                  <?php if (0 == $estadoObservacion) { ?>
                    <td><textarea style="min-height: 8px; width: 100%;" onchange="campoObservacion('Observacion', this.value, <?php echo $idverificado; ?>, 1);"><?php echo $campoObservacion; ?></textarea></td>
                  <?php }
                  if (1 == $estadoObservacion) { ?>
                    <td><?php echo $campoObservacion; ?> <span class="btn btn-warning btn-xs pull-right" onclick="EditarcampoObservacion('EditarObservacion', <?php echo $idverificado; ?>, 0);">Editar</span></td>
                  <?php } ?>
                </tr>
              </tfoot>
            <?php } ?>
            <script>
              if (0 === <?php echo $estadoNumVerifica; ?>) {
                $(document).ready(function() {
                  $('#gsaFumigacion').DataTable({
                    "lengthMenu": [
                      [50, 100, 200, 300, 500],
                      [50, 100, 200, 300, 500]
                    ],
                    "language": {
                      "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                    },
                    "aaSorting": [
                      [0, "asc"]
                    ]
                  });
                });
              }
            </script>
            <script>
              if (1 === <?php echo $estadoNumVerifica; ?>) {
                $(document).ready(function() {
                  $('#gsaFumigacion').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                      extend: 'pdfHtml5',
                      text: 'PDF',
                      title: "REPORTE FUMIGACION <?php echo $NombreImpreso; ?>",
                      customize: function(doc) {
                        doc.styles.title = {
                            color: 'gray',
                            fontSize: '14',
                            alignment: 'center'
                          },
                          doc.content.splice(1, 0, {
                            columns: [{
                              margin: 12,
                              alignment: 'left',
                              image: 'data:image/png;base64,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',
                              width: 100,
                              height: 30
                            }, {
                              margin: [100, 10],
                              text: "Solicitud # <?php echo $idSolicitud; ?> \n Fecha Solicitud: <?php echo $fechaInicial; ?> | <?php echo $fechaFinal; ?> \n Funcionario (Nivel Central): <?php echo $funcionariogsa; ?>  \n Proveedor: <?php echo $nombreProveedor; ?> \n Estado: <?php echo $estadoNomVerifica; ?>",
                              fontSize: 9
                            }]
                          });
                      },
                      messageBottom: " \n\n\n\n\n\n\n\n\n\n\nFirma Responsable: <?php echo quees('funcionario', $funcionarioverificado) ?> \n Fecha Recibido: <?php echo $fechaVerificado; ?> \n\n\n Observación: <?php echo $campoObservacion; ?>",
                    }],
                    "lengthMenu": [
                      [50, 100, 200, 300, 500],
                      [50, 100, 200, 300, 500]
                    ],
                    "language": {
                      "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                    },
                    "aaSorting": [
                      [0, "asc"]
                    ]
                  });
                });
              }
            </script>
          </table>

        <?php } else {
        } ?>

      </div>
    </div>
  </div>

<?php
}

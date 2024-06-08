<?php
class cuotasPartesControlador
{
  static public function tablaEntidadesControlador()
  {
    $respuesta = cuotasPartesModelo::tablaEntidadesModelo("cuotas_partes_entidades");
    $nump67 = privilegios(67, $_SESSION['snr']);
    $nump66 = privilegios(66, $_SESSION['snr']);
    echo '<div class="table-responsive">
          <table class="table display" id="cuota_parte">
            <thead>
              <tr>
                <th>No</th>
                <th>NIT</th>
                <th>RAZON SOCIAL</th>
                <th>DEPARTAMENTO</th>
                <th>MUNICIPIO</th>
                <th>DIRECCION</th>
                <th>ACCION</th>
              </tr>
            </thead>
            <tbody>';

    foreach ($respuesta as $row => $item) {
      echo '<tr>
            <td>' . $item['id_cuotas_partes_entidades'] . '</td>
            <td>' . $item['nit'] . '</td>
            <td>' . $item['nombre_cuotas_partes_entidades'] . '</td>
            <td>' . $item['nombre_departamento'] . '</td>
            <td>' . $item['nombre_municipio'] . '</td>
            <td>' . $item['direccion'] . '</td>
            <td>';

      echo '<a href="cuotas_partes_detalle_entidades&' . $item['id_cuotas_partes_entidades'] . '.jsp"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;';
      if (1 == $_SESSION['rol']  or 0 < $nump67 or 0 < $nump66) {
        echo '<a href="cuotas_partes_editar.jsp"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-pencil"></i></button></a>';
      }

      echo '</td>
            </tr>';
    }
    echo '</tbody>
          </table>
          </div>';
  }

  static public function detalleEntidadControlador($id)
  {
    $respuesta = cuotasPartesModelo::detalleEntidadModelo("cuotas_partes_entidades", $id);
    foreach ($respuesta as $row => $item) {
?>

      <div class="box box-info">
        <div class="box-header with-border">
          <p class="text-muted text-center"> Entidad de Orden Territorial</p>
          <h3 class="profile-username text-center"><?php echo $item['nombre_cuotas_partes_entidades']; ?></h3>
          <p class="text-muted text-center"><?php echo quees('departamento', $item['id_departamento']) ?> / <?php echo nombre_municipio($item['codigo_municipio'], $item['id_departamento']) ?></p>
        </div>
        <div class="box-body">
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>NIT:</b> <?php echo $item['nit']; ?>
            </li>
            <li class="list-group-item">
              <b>Razon Social:</b> <?php echo $item['nombre_cuotas_partes_entidades']; ?>
            </li>
            <li class="list-group-item">
              <b>Clasificación:</b> <?php echo quees('cuotas_partes_clasificacion', $item['id_cuotas_partes_clasificacion']); ?>
            </li>
            <li class="list-group-item">
              <b>Dirección:</b> <?php echo $item['direccion']; ?>
            </li>
            <li class="list-group-item">
              <b>Telefono:</b> <?php echo $item['telefono']; ?>
            </li>
            <li class="list-group-item">
              <b>Correos:</b><br> <?php echo $item['correo1'] . ' <br> ' . $item['correo2']; ?>
            </li>
          </ul>
        </div>
      </div>
    <?php

    }
  }

  static public function causantesControlador($id)
  {
    $respuesta = cuotasPartesModelo::causantesModelo("cuotas_partes_datos_causante", $id);
    $nump67 = privilegios(67, $_SESSION['snr']);
    $nump66 = privilegios(66, $_SESSION['snr']);
    echo '
    <div class="box box-info">
      <div class="box-header with-border">
        <h5 class="text-muted text-center"> Listado Causantes </h5>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table display" id="cuota_parte">
            <thead>
              <tr>
                <th>TIPO</th>
                <th>NUMERO DOCUMENTO</th>
                <th>NOMBRE APELLIDOS</th>
                <th>ACCION</th>
              </tr>
            </thead>
            <tbody>';

    foreach ($respuesta as $row => $item) {
      echo '<tr>
                <td>' . $item['nombre_tipo_documento'] . '</td>
                <td>' . $item['cedula_ciudadania'] . '</td>
                <td>' . $item['nombre_cuotas_partes_datos_causante'] . '</td>
                <td>';

      echo '<a href="cuotas_partes_detalle_causante&' . $item['id_cuotas_partes_datos_causante'] . '.jsp"><span class="glyphicon glyphicon-user"></span></a>&nbsp;&nbsp;&nbsp;';

      if (1 == $_SESSION['rol']  or 0 < $nump67 or 0 < $nump66) {
        echo '<a href="cuotas_partes_editar.jsp"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-pencil"></i></button></a>';
      }

      echo '</td>
              </tr>';
    }
    echo '</tbody>
          </table>
        </div>

      </div>
    </div>';
  }

  static public function detalleCausanteControlador($id)
  {
    $respuesta = cuotasPartesModelo::detalleCausanteModelo("cuotas_partes_datos_causante", $id);
    foreach ($respuesta as $row => $item) {
    ?>

      <div class="box box-info">
        <div class="box-header with-border">
          <p class="text-muted text-center"> CAUSANTE </p>
          <h3 class="profile-username text-center"><?php echo $item['nombre_cuotas_partes_datos_causante']; ?></h3>
          <p class="text-muted text-center">
            <?php if (1 == $item['estado_cedula']) {
              echo '<span style="color:green"><b>ACTIVO</b></span>';
            } elseif (0 == $item['estado_cedula']) {
              echo '<span style="color:red"><b>INACTIVO</b></span>';
            } else {
              echo '<span style="color:#333"><b>SIN PARAMETRO</b></span>';
            }
            ?>
          </p>
        </div>
        <div class="box-body">
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b><?php echo quees('tipo_documento', $item['tipodocumento']); ?> :</b> <?php echo $item['cedula_ciudadania']; ?>
            </li>
            <li class="list-group-item">
              <b>Sustitutos:</b>
              <?php if (1 == $item['sustitucion']) {
                echo '<span style="color:green"><b>SI</b></span>';
              } elseif (0 == $item['sustitucion']) {
                echo '<span style="color:red"><b>NO</b></span>';
              } else {
                echo '<span style="color:#333"><b>SIN PARAMETRO</b></span>';
              }
              ?>
            </li>
            <?php if (1 == $item['sustitucion']) {
              $id = $item['id_cuotas_partes_datos_causante'];
              $respuesta = cuotasPartesModelo::sustitutosModelo("cuotas_partes_sustitucion", $id);
              echo '<li class="list-group-item">';
              echo '<b>Datos de Sustituto(s):</b><br>';
              foreach ($respuesta as $row => $item) {
                echo '<b>' . $item['nombre_tipo_documento'] . ': </b>' . $item['cedula_sustitucion'] . '<br>';
                echo '<b>Nombre: </b>' . $item['nombre_cuotas_partes_sustitucion'] . '<br>';
              }
              echo '</li>';
            } elseif (0 == $item['sustitucion']) {
            } else {
              echo '<li class="list-group-item">';
              echo '<span style="color:#333"><b>SIN PARAMETRO</b></span>';
              echo '</li>';
            }
            ?>
            <!-- <li class="list-group-item">
              <b>Correos:</b><br> <php echo $item['correo1'] . ' <br> ' . $item['correo2']; ?>
            </li> -->
          </ul>
        </div>
      </div>
<?php

    }
  }

  static public function periodoscausantesControlador($id)
  {
    $respuesta = cuotasPartesModelo::periodoscausantesModelo("cuotas_partes_pagos_entidades", $id);
    $nump67 = privilegios(67, $_SESSION['snr']);
    $nump66 = privilegios(66, $_SESSION['snr']);

    echo '<div class="box box-info">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-md-2">';
    if (1 == $_SESSION['rol']  or 0 < $nump67 or 0 < $nump66) {
      echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#popupperiodos">
              Nuevo
            </button>';
    }
    echo '</div>
        <div class="col-md-10">
          <h5 class="text-muted text-center"> Periodos Cuotas Partes de la Entidad </h5>
        </div>
      </div>


      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table display" id="cuota_parte">
            <thead>
              <tr>
                <th>No Periodo</th>
                <th>Fecha Inicio Periodo</th>
                <th>Fecha Final Periodo</th>
                <th>Periodo</th>
                <th>Referencia</th>
                <th>Participación</th>
                <th>Valor Pagado</th>
                <th>Valor Cuota Parte</th>
                <th>ACCION</th>
              </tr>
            </thead>
            <tbody>';

    foreach ($respuesta as $row => $item) {
      echo '<tr>    
            <td>' . $item['id_cuotas_partes_pagos_entidades'] . '</td>
            <td>' . date("d/m/Y", strtotime($item['periodo_fecha_inicio'])) . '</td>
            <td>' . date("d/m/Y", strtotime($item['periodo_fecha_final'])) . '</td>
            <td>' . $item['fecha'] . '</td>
            <td>' . $item['referencia'] . '</td>
            <td>' . $item['participacion'] . ' % </td>
            <td>  $ ' . number_format((float) $item["valor_pagado"], 2, ",", ".") . '</td>
            <td>  $ ' . number_format((float) $item["valor_cuota_parte"], 2, ",", ".") . '</td>
            <td>';
      if (1 == $_SESSION['rol']  or 0 < $nump67 or 0 < $nump66) {
        echo '<a href="" class="editar_periodo" id="' . $item['id_cuotas_partes_pagos_entidades'] . '" data-toggle="modal" data-target="#popupeditarperiodo"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-pencil"></i></button></a>&nbsp;';
      }
      if (1 == $item['estado_vista']) {
        echo '<a href="pdf/cuotas_partes_cobros&' . $item['id_cuotas_partes_pagos_entidades'] . '.pdf" download="' . $item['id_cuotas_partes_pagos_entidades'] . '.pdf"><img src="images/prev.png"></a> ';
      }
      echo '</td>
            </tr>';
    }
    echo '</tbody>
            </table>
          </div>

        </div>
      </div>';
  }



  static public function editarEntidadesControlador()
  {
    $respuesta = cuotasPartesModelo::tablaEntidadesModelo("cuotas_partes_entidades");
    echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#popupinsertentidad">
      Nueva Entidad
    </button>
    <div class="clearfix">
      <hr>
    </div>
    <div class="table-responsive">
      <table class="table display" id="cuota_parte">
        <thead>
          <tr>
            <th>No</th>
            <th>NIT</th>
            <th>RAZON SOCIAL</th>
            <th>DEPARTAMENTO</th>
            <th>MUNICIPIO</th>
            <th>DIRECCION</th>
            <th>ACCION</th>
          </tr>
        </thead>
        <tbody>';

    foreach ($respuesta as $row => $item) {
      echo '<tr>
          <td>' . $item['id_cuotas_partes_entidades'] . '</td>
          <td>' . $item['nit'] . '</td>
          <td>' . $item['nombre_cuotas_partes_entidades'] . '</td>
          <td>' . $item['nombre_departamento'] . '</td>
          <td>' . $item['nombre_municipio'] . '</td>
          <td>' . $item['direccion'] . '</td>
          <td>';
      echo '   <div class="btn-group">
          <a name="' . $item['id_cuotas_partes_entidades'] . '" href="" class="editar_entidad" id="' . $item['id_cuotas_partes_entidades'] . '" data-toggle="modal" data-target="#popupeditarentidad"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-pencil"></i></button></a>&nbsp;';
      echo '  </td>
          </tr>';
    }
    echo '</tbody>
          </table>
          </div>';
  }


  static public function editarCausanteControlador()
  {
    $respuesta = cuotasPartesModelo::editarCausanteModelo("cuotas_partes_datos_causante");
    echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#popupinsertcausante">
      Nuevo Causante
    </button>
    <div class="clearfix">
      <hr>
    </div>
    <div class="table-responsive">
      <table class="table display" id="cuota_causante">
        <thead>
          <tr>
            <th>No Documento</th>
            <th>Nombres Causante</th>
            <th>Asociado a Entidad</th>
            <th>Sustituto</th>
            <th>Estado</th>
            <th>ACCION</th>
          </tr>
        </thead>
        <tbody>';
    foreach ($respuesta as $row => $item) {
      echo '<tr>
        <td>' . $item['cedula_ciudadania'] . '</td>
        <td>' . $item['nombre_cuotas_partes_datos_causante'] . '</td>
        <td>' . $item['nombre_cuotas_partes_entidades'] . '</td>
        <td>';
      switch ($item['sustitucion']) {
        case 0:
          echo "NO";
          break;
        case 1:
          echo "SI";
          break;
      }
      echo '</td>
        <td>';
      switch ($item['estado_cedula']) {
        case 0:
          echo "INACTIVO";
          break;
        case 1:
          echo "ACTIVO";
          break;
      }
      echo '</td>
        <td>';
      echo '   
        <a name="' . $item['id_cuotas_partes_datos_causante'] . '" href="" class="editar_causante" id="' . $item['id_cuotas_partes_datos_causante'] . '" data-toggle="modal" data-target="#popupeditarcausante"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-pencil"></i></button></a>&nbsp;';
      echo '  </td>
        </tr>';
    }
    echo '</tbody>
        </table>
        </div>';
  }

  static public function editarSustitucionControlador()
  {
    $respuesta = cuotasPartesModelo::editarSustitucionModelo("cuotas_partes_sustitucion");

    echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#popupinsertsustituto">
            Nuevo Sustituto
          </button>
          <div class="clearfix">
            <hr>
          </div>
        <div class="table-responsive">
          <table class="table display" id="cuota_sustitucion">
            <thead>
              <tr>
                <th>No Documento Nombres Sustituto</th>
                <th>Resolucion Sustituto</th>
                <th>Estado Sustituto</th>
                <th>Asociado al Causante</th>
                <th>Resolucion Causante</th>
                <th>Estado Causante</th>
                <th>ACCION</th>
              </tr>
            </thead>
            <tbody>';

    foreach ($respuesta as $row => $item) {
      echo '<tr>
          <td>' . $item['cedula_sustitucion'] . ' - ' . $item['nombre_cuotas_partes_sustitucion'] . '</td>';
      echo '<td>' . $item['resolucion_sustitucion'] . '</td>';
      echo '<td>';
      switch ($item['estado_cedula_sustitucion']) {
        case 0:
          echo "INACTIVO";
          break;
        case 1:
          echo "ACTIVO";
          break;
      }
      echo '</td>';
      echo '<td>' . $item['cedula_ciudadania'] . ' - ' . $item['nombre_cuotas_partes_datos_causante'] . '</td>';
      echo '<td>' . $item['resolucion_causante'] . '</td>';
      echo '<td>';
      switch ($item['estado_cedula_causante']) {
        case 0:
          echo "INACTIVO";
          break;
        case 1:
          echo "ACTIVO";
          break;
      }
      echo '</td>
          <td>';
      echo '<div class="btn-group">
          <a name="' . $item['id_cuotas_partes_sustitucion'] . '" href="" class="editar_sustitucion" id="' . $item['id_cuotas_partes_sustitucion'] . '" data-toggle="modal" data-target="#popupeditarsustitucion"><button class="btn btn-xs btn-warning"><i class="fa fa-fw fa-pencil"></i></button></a>&nbsp;';
      echo '</td>
          </tr>';
    }
    echo '</tbody>
          </table>
          </div>';
  }




  // FIN CLASS
}

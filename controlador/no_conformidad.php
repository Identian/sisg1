<?php

class No_Conformidad_Controlador
{

    public function verifica_privilegio_controlador()
    {
        $id_orip = intval($_GET['i']);
        $id_funcionario = $_SESSION['snr'];
        $id_modulo = 1;
        $datos = array(
            "id_orip" => htmlspecialchars($id_orip),
            "id_funcionario" => $id_funcionario,
            "id_modulo_registro" => $id_modulo,
            "estado" => 1
        );
        $consulta = No_Conformidad_Modelo::verifica_privilegio_modelo('privilegio_registro', $datos);
        foreach ($consulta as $value) {
            if ($value['id_perfil_registro'] == 2) {
                echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalformularionoconformidad">
                        <span class="glyphicon glyphicon-plus-sign"></span> Nueva salida no conforme
                    </button><br><br>';
            }
        }
        if (1 == $_SESSION['rol']) {
            echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalformularionoconformidad">
        <span class="glyphicon glyphicon-plus-sign"></span> Nueva salida no conforme
        </button><br><br>';
        }
    }

    public function lista_pnc_orip_controlador()
    {
        $id_orip = intval($_GET['i']);
        $id_funcionario = $_SESSION['snr'];
        $id_modulo = 1;
        $datos = array(
            "id_orip" => htmlspecialchars($id_orip),
            "id_funcionario" => $id_funcionario,
            "id_modulo_registro" => $id_modulo,
            "estado" => 1
        );
        $consulta = No_Conformidad_Modelo::lista_pnc_orip_modelo('snc_orip_pnc', $id_orip);
        $consulta_privilegio = No_Conformidad_Modelo::verifica_privilegio_modelo('privilegio_registro', $datos);
        foreach ($consulta as $item) {
            echo '<tr>
                    <td>' . $item['fecha_registro_snc'] . '</td>
                    <td>' . $item['ano_error_snc'] . '</td>
                    <td>' . $item['radicado_snc'] . '</td>
                    <td>' . $item['nombre_etapa_snc'] . '</td>
                    <td>' . $item['nombre_error_snc'] . '</td>
                    <td>' . $item['descripcion_error_snc'] . '</td>
                    <td>' . $item['nombre_tratamiento_error_snc'] . '</td>
                    <td>';
            foreach ($consulta_privilegio as $value) {
                if ($value['id_perfil_registro'] == 2) {
                    echo '<button type="button" consulta_id_nc_orip_pnc="' . $item["id_snc"] . '" class="btn btn-info btn-sm consulta-no-conformidad" title="Consulta" data-toggle="modal" data-target="#modalConsultaNoConformidad"><i class="fa fa-search"></i></button>';
                }
                if ($value['id_perfil_registro'] == 1) {
                    echo '<button type="button" formulario_id_nc_orip_pnc="' . $item["id_snc"] . '" formulario_funcionario_auditoria_usuario="' . $_SESSION["snr"] . '" class="btn btn-success btn-sm corregir-no-conformidad" title="Editar" data-toggle="modal" data-target="#modalEditarNoConformidad"><i class="fa fa-pencil"></i></button>';
                }
            }
            if (1 == $_SESSION['rol']) {
                echo '<button type="button" consulta_id_nc_orip_pnc="' . $item["id_snc"] . '" class="btn btn-info btn-sm consulta-no-conformidad" title="Consulta" data-toggle="modal" data-target="#modalConsultaNoConformidad"><i class="fa fa-search"></i></button>';
                echo '<button type="button" formulario_id_nc_orip_pnc="' . $item["id_snc"] . '" formulario_funcionario_auditoria_usuario="' . $_SESSION["snr"] . '" class="btn btn-success btn-sm corregir-no-conformidad" title="Editar" data-toggle="modal" data-target="#modalEditarNoConformidad"><i class="fa fa-pencil"></i></button>';
            }
            echo '</td>';
            echo '</tr>';
        }
    }

    public function nombre_orip_controlador()
    {
        $id_orip = intval($_GET['i']);
        $consulta = No_Conformidad_Modelo::nombre_orip_modelo('oficina_registro', $id_orip);
        echo $consulta['nombre_oficina_registro'];
    }

    public function etapa_pnc_orip_controlador()
    {
        $consulta = No_Conformidad_Modelo::etapa_pnc_orip_modelo('snc_orip_etapa');
        foreach ($consulta as $fila => $item) {
            echo '<option value="' . $item["id_snc_orip_etapa"] . '">' . $item["nombre_etapa_snc"] . '</option>';
        }
    }

    public function tipo_error_pnc_orip_controlador()
    {
        $consulta = No_Conformidad_Modelo::tipo_error_pnc_orip_modelo('snc_orip_tipo_error');
        foreach ($consulta as $fila => $item) {
            echo '<option value="' . $item["id_snc_tipo_error"] . '">' . $item["nombre_error_snc"] . '</option>';
        }
    }

    public function tratamiento_error_pnc_orip_controlador()
    {
        $consulta = No_Conformidad_Modelo::tratamiento_error_pnc_orip_modelo('snc_orip_tratamiento_error');
        foreach ($consulta as $fila => $item) {
            echo '<option value="' . $item["id_snc_orip_tratamiento_error"] . '">' . $item["nombre_tratamiento_error_snc"] . '</option>';
        }
    }

    public function funcionario_pnc_orip_controlador()
    {
        $id_orip = intval($_GET['i']);
        $consulta = No_Conformidad_Modelo::funcionario_pnc_orip_modelo('funcionario', $id_orip);
        foreach ($consulta as $fila => $item) {
            echo '<option value="' . $item["id_funcionario"] . '">' . $item["nombre_funcionario"] . '</option>';
        }
    }

    public function responsable_pnc_orip_controlador()
    {
        $id_orip = intval($_GET['i']);
        $consulta = No_Conformidad_Modelo::responsable_pnc_orip_modelo('snc_orip_responsable_error');
        foreach ($consulta as $fila => $item) {
            echo '<option value="' . $item["id_responsable"] . '">' . $item["nombre_responsable_snc"] . '</option>';
        }
    }

    public function notaria_controlador()
    {
        $consulta = No_Conformidad_Modelo::notaria_modelo('notaria');
        foreach ($consulta as $fila => $item) {
            echo '<option value="' . $item["id_notaria"] . '">' . $item["nombre_notaria"] . '</option>';
        }
    }

    static public function funcionario_orip_ajax_controlador($id_orip)
    {
        $consulta = No_Conformidad_Modelo::funcionario_pnc_orip_modelo('funcionario', $id_orip);
        foreach ($consulta as $fila => $item) {
            echo '<option value="' . $item["id_funcionario"] . '">' . $item["nombre_funcionario"] . '</option>';
        }
    }

    public function formulario_no_conformidad_controlador()
    {
        $id_orip = intval($_GET['i']);
        echo '<form method="POST">
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> FECHA EN QUE SE COMETIÓ EL ERROR PERFIL DE REGISTRO 1:</label>
                    <input type="date" class="form-control" id="ano_error" name="ano_error" required>
                    <input type="hidden" id="id_orip" name="id_orip" value="' . $id_orip . '">
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> NUMERO DE RADICADO DEL DOCUMENTO:</label>
                    <input type="text" class="form-control" id="radicado" name="radicado" required>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> ETAPA DETECCION NO CONFORMIDAD:</label>
                    <select class="form-control" id="id_etapa" name="id_etapa" required>
                        <option value="">Elige una opción</option>';
        $etapa = new No_Conformidad_Controlador();
        $etapa->etapa_pnc_orip_controlador();
        echo '</select>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE OMISIÓN Y/O ERROR DETECTADO:</label>
                    <select class="form-control" id="id_error" name="id_error" required>
                        <option value="">Elige una opción</option>';
        $tipo_error = new No_Conformidad_Controlador();
        $tipo_error->tipo_error_pnc_orip_controlador();
        echo '</select>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> DESCRIPCIÓN DE LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <textarea class="form-control" rows="3" id="descripcion_error" name="descripcion_error" required></textarea>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TRATAMIENTO DADO A LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <select class="form-control" id="id_tratamiento_error" name="id_tratamiento_error" required>
                        <option value="">Elige una opción</option>';
        $tratamiento_error = new No_Conformidad_Controlador();
        $tratamiento_error->tratamiento_error_pnc_orip_controlador();
        echo '</select>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> RESPONSABLE DE LA DETECCIÓN:</label>
                    <select class="form-control" id="responsable_deteccion" name="responsable_deteccion" required>
                        <option value="">Elige una opción</option>';
        $funcionario = new No_Conformidad_Controlador();
        $funcionario->funcionario_pnc_orip_controlador();
        echo '</select>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> RESPONSABLE DEL ERROR:</label>
                    <select class="form-control" id="tipo_responsable_error" name="tipo_responsable_error" required>
                        <option value="">Elige una opción</option>';
        $tipo_responsable = new No_Conformidad_Controlador();
        $tipo_responsable->responsable_pnc_orip_controlador();
        echo '</select>
                </div>
                <div class="form-group" id="campo-responsable-error">
                </div>
               
                <div class="modal-footer">
                <span style="color:#ff0000;">* Obligatorio</span>
                <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span> Enviar </button></div>
            </form>';
    }

    public function nuevo_pnc_orip_controlador()
    {
        $id_orip = intval($_GET['i']);
        date_default_timezone_set("America/Bogota");
        $fecha = date("Y-m-d H:i:s");
        if (isset($_POST['radicado']) && isset($_POST['turno'])) {
            $datos_nuevo_pnc = array(
                "orip_id" => htmlspecialchars($id_orip),
                "fecha_registro" => htmlspecialchars($fecha),
                "ano_error" => htmlspecialchars($_POST["ano_error"]),
                "radicado" => htmlspecialchars($_POST["radicado"]),
                "id_etapa" => htmlspecialchars($_POST["id_etapa"]),
                "id_error" => htmlspecialchars($_POST["id_error"]),
                "descripcion_error" => htmlspecialchars($_POST["descripcion_error"]),
                "id_tratamiento_error" => htmlspecialchars($_POST["id_tratamiento_error"]),
                "responsable_deteccion" => htmlspecialchars($_POST["responsable_deteccion"]),
                "tipo_responsable_error" => htmlspecialchars($_POST["tipo_responsable_error"]),
                "responsable_error" => htmlspecialchars($_POST["responsable_error"]),
                "turno" => htmlspecialchars($_POST["turno"]),
                "tratamiento_omision" => htmlspecialchars($_POST["tratamiento_omision"]),
                "estado" => 2
            );
            $consulta = No_Conformidad_Modelo::nuevo_pnc_orip_modelo('snc_orip_pnc', $datos_nuevo_pnc);
            if ($consulta == 'ok') {
                echo '<script type="text/javascript">swal(" OK !", " Registrado Correctamente  !", "success");</script>';
            }
        } else if (isset($_POST['radicado'])) {
            $datos_nuevo_pnc = array(
                "orip_id" => htmlspecialchars($id_orip),
                "fecha_registro" => htmlspecialchars($fecha),
                "ano_error" => htmlspecialchars($_POST["ano_error"]),
                "radicado" => htmlspecialchars($_POST["radicado"]),
                "id_etapa" => htmlspecialchars($_POST["id_etapa"]),
                "id_error" => htmlspecialchars($_POST["id_error"]),
                "descripcion_error" => htmlspecialchars($_POST["descripcion_error"]),
                "id_tratamiento_error" => htmlspecialchars($_POST["id_tratamiento_error"]),
                "responsable_deteccion" => htmlspecialchars($_POST["responsable_deteccion"]),
                "tipo_responsable_error" => htmlspecialchars($_POST["tipo_responsable_error"]),
                "responsable_error" => htmlspecialchars($_POST["responsable_error"]),
                "turno" => 0,
                "tratamiento_omision" => '',
                "estado" => 1
            );
            $consulta = No_Conformidad_Modelo::nuevo_pnc_orip_modelo('snc_orip_pnc', $datos_nuevo_pnc);
            if ($consulta == 'ok') {
                echo '<script type="text/javascript">swal(" OK !", " Registrado Correctamente  !", "success");</script>';
            }
        }
    }

    static public function consulta_id_nc_orip_pnc_controlador($datos)
    {
        $consulta = No_Conformidad_Modelo::consulta_id_nc_orip_pnc_modelo('snc_orip_pnc', $datos);
        $date = date_create($consulta['ano_error_snc']);
        if ($consulta['nombre_responsable_snc'] == 'FUNCIONARIO') {
            $consulta_responsable = No_Conformidad_Modelo::nombre_funcionario_pnc_modelo('funcionario', $consulta['responsable_error_snc']);
            $consulta_responsable = $consulta_responsable['nombre_funcionario'];
        } else if ($consulta['nombre_responsable_snc'] == 'NOTARIA') {
            $consulta_responsable = No_Conformidad_Modelo::nombre_notaria_modelo('notaria', $consulta['responsable_error_snc']);
            $consulta_responsable = $consulta_responsable['nombre_notaria'];
        } else {
            $consulta_responsable = No_Conformidad_Modelo::nombre_no_vinculado_modelo('snc_orip_pnc', $datos);
            $consulta_responsable = $consulta_responsable['responsable_error_snc'];
        }
        if ($consulta['estado_snc'] == 1) {
            echo '<form method="POST">
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> AÑO AL QUE PERTENECE EL ERROR CAMBIAR EL NOMBRE DEL CAMPO:</label>
                    <input type="number" class="form-control" placeholder="' . $consulta['ano_error_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> NUMERO DE RADICADO DEL DOCUMENTO:</label>
                    <input type="text" class="form-control" placeholder="' . $consulta['radicado_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> ETAPA DETECCION NO CONFORMIDAD:</label>
                    <input type="text" class="form-control" placeholder="' . $consulta['nombre_etapa_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE OMISIÓN Y/O ERROR DETECTADO:</label>
                    <input type="text" class="form-control" placeholder="' . $consulta['nombre_error_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> DESCRIPCIÓN DE LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <textarea class="form-control" rows="3" escripcion_error" disabled>' . $consulta['descripcion_error_snc'] . '</textarea>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TRATAMIENTO DADO A LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <input type="text" class="form-control" placeholder="' . $consulta['nombre_tratamiento_error_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> RESPONSABLE DE LA DETECCIÓN:</label>
                    <input type="text" class="form-control" placeholder="' . $consulta['funcionario_deteccion_error'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TIPO RESPONSABLE DEL ERROR:</label>
                    <input type="text" class="form-control" placeholder="' . $consulta['nombre_responsable_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> RESPONSABLE DEL ERROR:</label>
                    <input type="text" class="form-control" placeholder="' . $consulta_responsable . '" disabled>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
                </div>
            </form>';
        } else if ($consulta['estado_snc'] == 2) {
            echo '<form method="POST">
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> FECHA EN QUE SE COMETIÓ EL ERROR:</label>
                    <input type="text" class="form-control" id="ano_error" name="ano_error" placeholder="' . date_format($date, 'd/m/Y') . '" required>
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> NUMERO DE RADICADO DEL DOCUMENTO:</label>
                    <input type="text" class="form-control" id="radicado" name="radicado" placeholder="' . $consulta['radicado_snc'] . '" required>
                    <span class="glyphicon glyphicon-save-file form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> ETAPA DETECCION NO CONFORMIDAD:</label>
                    <select class="form-control" id="id_etapa" name="id_etapa" required>
                        <option value="">Elige una opción</option>';
            $etapa = new No_Conformidad_Controlador();
            $etapa->etapa_pnc_orip_controlador();
            echo '</select>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE OMISIÓN Y/O ERROR DETECTADO:</label>
                    <select class="form-control" id="id_error" name="id_error" required>
                        <option value="">Elige una opción</option>';
            $tipo_error = new No_Conformidad_Controlador();
            $tipo_error->tipo_error_pnc_orip_controlador();
            echo '</select>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> DESCRIPCIÓN DE LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <textarea class="form-control" rows="3" id="descripcion_error" name="descripcion_error" required></textarea>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TRATAMIENTO DADO A LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <select class="form-control" id="id_tratamiento_error" name="id_tratamiento_error" required>
                        <option value="">Elige una opción</option>';
            $tratamiento_error = new No_Conformidad_Controlador();
            $tratamiento_error->tratamiento_error_pnc_orip_controlador();
            echo '</select>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> RESPONSABLE DE LA DETECCIÓN:</label>
                    <select class="form-control" id="responsable_deteccion" name="responsable_deteccion" required>
                        <option value="">Elige una opción</option>';
            $funcionario = new No_Conformidad_Controlador();
            $funcionario->funcionario_pnc_orip_controlador();
            echo '</select>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> RESPONSABLE DEL ERROR:</label>
                    <select class="form-control" id="responsable_error" name="responsable_error" required>
                        <option value="">Elige una opción</option>';
            $funcionario = new No_Conformidad_Controlador();
            $funcionario->funcionario_pnc_orip_controlador();
            echo '</select>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TURNO GENERADO POR EL TRATAMIENTO DADO A LA OMISIÓN Y/O ERROR</label>
                    <input type="text" class="form-control" id="radicado" name="radicado" required>
                    <span class="glyphicon glyphicon-save-file form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> COMPLEMENTO DESCRIPCIÓN DE LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <input type="text" class="form-control" id="radicado" name="radicado" required>
                    <span class="glyphicon glyphicon-save-file form-control-feedback"></span>
                </div>
                <div class="modal-footer">
                <span style="color:#ff0000;">* Obligatorio</span>
                <button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>hasdhoksadhohdi
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Enviar </button></div>
            </form>';
        }
    }

    static public function formulario_completar_id_nc_orip_pnc_controlador($datos)
    {
        $id_no_conformidad = $datos['formulario_id_nc_orip_pnc'];
        $id_funcionario_auditoria_usuario = $datos['formulario_funcionario_auditoria_usuario'];
        $consulta = No_Conformidad_Modelo::consulta_id_nc_orip_pnc_modelo('snc_orip_pnc', $id_no_conformidad);
        $date = date_create($consulta['ano_error_snc']);
        if ($consulta['nombre_responsable_snc'] == 'FUNCIONARIO') {
            $consulta_responsable = No_Conformidad_Modelo::nombre_funcionario_pnc_modelo('funcionario', $consulta['responsable_error_snc']);
            $consulta_responsable = $consulta_responsable['nombre_funcionario'];
        } else if ($consulta['nombre_responsable_snc'] == 'NOTARIA') {
            $consulta_responsable = No_Conformidad_Modelo::nombre_notaria_modelo('notaria', $consulta['responsable_error_snc']);
            $consulta_responsable = $consulta_responsable['nombre_notaria'];
        } else {
            $consulta_responsable = No_Conformidad_Modelo::nombre_no_vinculado_modelo('snc_orip_pnc', $datos['formulario_id_nc_orip_pnc']);
            $consulta_responsable = $consulta_responsable['responsable_error_snc'];
        }
        echo '<form method="POST">
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> FECHA EN QUE SE COMETIÓ EL ERROR:</label>
                    <input type="hidden" name="id_no_conformidad" id="id_no_conformidad" value="' . $id_no_conformidad . '">
                    <input type="hidden" name="id_funcionario_auditoria_usuario" id="id_funcionario_auditoria_usuario" value="' . $id_funcionario_auditoria_usuario . '">
                    <input type="text" class="form-control" id="ano_error" name="ano_error" placeholder="' . date_format($date, 'd/m/Y') . '" disabled>
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> NUMERO DE RADICADO DEL DOCUMENTO:</label>
                    <input type="text" class="form-control" name="radicado" placeholder="' . $consulta['radicado_snc'] . '" disabled>
                    <span class="glyphicon glyphicon-save-file form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> ETAPA DETECCION NO CONFORMIDAD:</label>
                    <input type="text" class="form-control" name="radicado" placeholder="' . $consulta['nombre_etapa_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TIPO DE OMISIÓN Y/O ERROR DETECTADO:</label>
                    <input type="text" class="form-control" name="radicado" placeholder="' . $consulta['nombre_error_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> DESCRIPCIÓN DE LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <textarea class="form-control" rows="3" name="descripcion_error" disabled>' . $consulta['descripcion_error_snc'] . '</textarea>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TRATAMIENTO DADO A LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <input type="text" class="form-control" name="radicado" placeholder="' . $consulta['nombre_tratamiento_error_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> RESPONSABLE DE LA DETECCIÓN:</label>
                    <input type="text" class="form-control" name="radicado" placeholder="' . $consulta['funcionario_deteccion_error'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TIPO RESPONSABLE DEL ERROR:</label>
                    <input type="text" class="form-control" placeholder="' . $consulta['nombre_responsable_snc'] . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> RESPONSABLE DEL ERROR:</label>
                    <input type="text" class="form-control" placeholder="' . $consulta_responsable . '" disabled>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> TURNO GENERADO POR EL TRATAMIENTO DADO A LA OMISIÓN Y/O ERROR</label>
                    <input type="text" class="form-control" id="turno_correcion" required>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span> COMPLEMENTO DESCRIPCIÓN DE LA OMISIÓN Y/O ERROR DETECTADO:</label>
                    <textarea class="form-control" rows="3" id="id_tratamiento_omision" required></textarea>
                </div>
            </form>';
    }

    static public function registro_correccion_controlador($datos)
    {
        $respuesta = No_Conformidad_Modelo::registro_correccion_modelo('snc_orip_pnc', $datos);
        return $respuesta;
    }

    static public function consulta_responsable_error_controlador($datos)
    {
        if ($datos['tipo_responsable_error'] == 1) {
            echo '<div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span>FUNCIONARIO RESPONSABLE DEL ERROR:</label>
                    <select class="form-control" id="responsable_error" name="responsable_error" required>
                        <option value="">Elige una opción</option>';
            $responsable = new No_Conformidad_Controlador();
            $responsable->funcionario_orip_ajax_controlador($datos['id_orip']);
            echo '</select>
                </div>';
        } else if ($datos['tipo_responsable_error'] == 2) {
            echo '<div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span>APROBADOR DE DOCUMENTOS RADICADOS ASIGNADO A LA NOTARIA:</label>
                    <select class="form-control" id="responsable_error" name="responsable_error" required>
                        <option value="">Elige una opción</option>';
            $notaria = new No_Conformidad_Controlador();
            $notaria->notaria_controlador();
            echo '</select>
                </div>';
        } else if ($datos['tipo_responsable_error'] == 3) {
            echo '<div class="form-group has-feedback">
                    <label class="control-label"><span style="color:#ff0000;">*</span>NOMBRE FUNCIONARIO NO VINCULADO RESPONSABLE DEL ERROR:</label>
                    <input type="text" class="form-control" id="responsable_error" name="responsable_error">
                </div>';
        }
    }
}

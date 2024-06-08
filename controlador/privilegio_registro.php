<?php

class Privilegio_Registro_Controlador {

    public function nombre_orip_controlador(){
        $id_orip = intval($_GET['i']);
            $consulta = Privilegio_Registro_Modelo::nombre_orip_modelo('oficina_registro', $id_orip);
                echo $consulta['nombre_oficina_registro'];
    }

    public function modulo_privilegio_controlador(){
        $consulta = Privilegio_Registro_Modelo::modulo_privilegio_modelo('modulo_registro');
        foreach ($consulta as $fila => $item) {
            echo '<option value="'.$item["id_modulo_registro"].'">'.$item["nombre_modulo"].'</option>';
        }
    }

    static public function formulario_modulo_privilegio_registro_controlador($datos){
        $consulta = Privilegio_Registro_Modelo::formulario_modulo_privilegio_registro_modelo('perfil_registro', $datos);
        foreach ($consulta as $fila => $item) {
            echo '<option value="'.$item["id_perfil_registro"].'">'.$item["nombre_perfil"].'</option>';
        }
    }

    public function funcionario_privilegio_controlador(){
        $id_orip = intval($_GET['i']);
        $consulta = Privilegio_Registro_Modelo::funcionario_privilegio_modelo('funcionario', $id_orip);
        foreach ($consulta as $fila => $item) {
            echo '<option value="'.$item["id_funcionario"].'">'.$item["nombre_funcionario"].'</option>';
        }
    }

    public function listado_funcionario_privilegio_controlador(){
        $id_orip = intval($_GET['i']);
        $consulta = Privilegio_Registro_Modelo::funcionario_lista_privilegio_modelo('funcionario', $id_orip);
        echo '<ul>';
        foreach ($consulta as $fila => $item) {
            echo '<li>';
            if ($_SESSION['rol'] == 1) {
                    echo '<a href="https://sisg.supernotariado.gov.co/usuario&'.$item['id_funcionario'].'.jsp"><i class="fa fa-user"></i></a> '.$item['nombre_funcionario']; 
                    if ($item['id_cargo'] == 1) {
                        echo ' <b>(REGISTRADOR) </b></<a>';
                    }
            } else {
                    echo '<i class="fa fa-user"></i> '.$item['nombre_funcionario'];
                    if ($item['id_cargo'] == 1) {
                        echo ' <b>(REGISTRADOR) </b></<a>';
                    }
                }
            echo '</li>';
        }
        echo '</ul>';
    }

    public function vista_cargo_privilegio_controlador(){
        $id_orip = intval($_GET['i']);
        $idfun=$_SESSION['snr'];
        $datos = array("id_orip"=>$id_orip,
                    "id_funcionario"=>$idfun,
                    "estado"=>1);
        $consulta = Privilegio_Registro_Modelo::verificar_funcionario_privilegio_modelo('funcionario', $datos);
        $consulta_rol = Privilegio_Registro_Modelo::consulta_rol_modelo("funcionario", $idfun);
        if(($consulta["id_cargo"] == 1 && $consulta["id_tipo_oficina"] == 2) || $consulta_rol["id_rol"] == 1){
            echo '<form method="POST">
                    <div class="row">
                    <div class="col-md-12">Acceso a módulos de Registro:</div><br><br>
                    <div class="col-md-4">
                        <select class="form-control" style="width:100%;" name="id_modulo_privilegio" id="id_modulo_privilegio">
                        <option value="" selected> - - Módulo - - </option>';
                            $modulo = new Privilegio_Registro_Controlador();
                            $modulo -> modulo_privilegio_controlador();
                        echo '</select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" style="width:100%;" name="id_perfil_privilegio" id="id_perfil_privilegio">
                        <option value="" selected> - - Perfil - - </option>';
                            $modulo = new Privilegio_Registro_Controlador();
                            $modulo -> modulo_privilegio_controlador();
                        echo '</select>
                    </div>
                    <div class="col-md-4"> 
                        <select class="form-control" style="width:100%;" name="id_funcionario_privilegio">
                        <option value="" selected> - - Funcionario - - </option>';
                            $funcionario = new Privilegio_Registro_Controlador();
                            $funcionario -> funcionario_privilegio_controlador();
                        echo '</select>
                    </div><br><br>
                    <div class="col-md-3"> 
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                    </div>
                </form>';
        }else{
            echo '<form method="POST">
                    <div class="row">
                    <div class="col-md-12">Acceso a módulos de Registro:</div><br><br>
                    <div class="col-md-4">
                        <select class="form-control" style="width:100%;" name="id_modulo_privilegio" id="id_modulo_privilegio">
                        <option value="" selected> - - Módulo - - </option>';
                            $modulo = new Privilegio_Registro_Controlador();
                            $modulo -> modulo_privilegio_controlador();
                        echo '</select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" style="width:100%;" name="id_perfil_privilegio" id="id_perfil_privilegio">
                        <option value="" selected> - - Perfil - - </option>';
                            $modulo = new Privilegio_Registro_Controlador();
                            $modulo -> modulo_privilegio_controlador();
                        echo '</select>
                    </div>
                    <div class="col-md-4"> 
                        <select class="form-control" style="width:100%;" name="id_funcionario_privilegio">
                        <option value="" selected> - - Asesor - - </option>';
                            $funcionario = new Privilegio_Registro_Controlador();
                            $funcionario -> funcionario_privilegio_controlador();
                        echo '</select>
                    </div><br><br>
                    </div>
                </form>';
        }
    }

    public function registro_privilegio_controlador(){
        $id_orip = intval($_GET['i']);
        $idfun=$_SESSION['snr'];
        if (isset($_POST['id_modulo_privilegio'])){
            $datos = array("id_modulo_privilegio"=>htmlspecialchars($_POST['id_modulo_privilegio']),
                            "id_perfil_privilegio"=>htmlspecialchars($_POST['id_perfil_privilegio']),
                            "id_funcionario_privilegio"=>htmlspecialchars($_POST['id_funcionario_privilegio']),
                            "id_orip"=>$id_orip,
                            "id_funcionario"=>$idfun,
                            "estado"=>1);
            $consulta = Privilegio_Registro_Modelo::registro_privilegio_modelo('privilegio_registro', $datos);
            if($consulta == 'ok'){
                echo '<script type="text/javascript">swal(" OK !", " Privilegio Registrado Correctamente  !", "success");</script>';
            }
            if($consulta == 'DuplicadoError'){
                echo '<script type="text/javascript">swal(" Error !", " Usuario, Privilegio, y Modulo Duplicado  !", "error");</script>';
            }
        } 
    }

    public function lista_administracion_funcionario_privilegio_controlador(){
        $id_orip = intval($_GET['i']);
        $idfun=$_SESSION['snr'];
        $tabla = array("tabla1"=>'funcionario',
                        "tabla2"=>'modulo_registro',
                        "tabla3"=>'perfil_registro',
                        "tabla4"=>'privilegio_registro');
        $datos = array("id_orip"=>$id_orip,
            "id_funcionario"=>$idfun,
            "estado"=>1);
        $consulta_cargo = Privilegio_Registro_Modelo::verificar_funcionario_privilegio_modelo('funcionario', $datos);
        $consulta_rol = Privilegio_Registro_Modelo::consulta_rol_modelo("funcionario", $idfun);
        $consulta = Privilegio_Registro_Modelo::lista_administracion_funcionario_privilegio_modelo($tabla, $id_orip);
        if (($consulta != false && $consulta_cargo["id_cargo"] == 1) || ($consulta != false && $consulta_rol["id_rol"] == 1)){
            echo '<table class="table table-striped table-bordered table-hover" id="detalleimpresoras">
                <thead>
                    <tr align="center" valign="middle">
                        <th>FUNCIONARIO</th>
                        <th>MÓDULO</th>
                        <th>PERFIL</th>
                        <th>FECHA CREACIÓN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($consulta as $fila => $item) {
                    echo '<tr>
                        <td>'.$item["nombre_funcionario"].'</td>
                        <td>'.$item["nombre_modulo"].'</td>
                        <td>'.$item["nombre_perfil"].'</td>
                        <td>'.$item["fecha_privilegio"].'</td>
                        <td><button type="button" id="'.$item["id_privilegio_registro"].'" name="privilegio_registro"  class="borrar_f" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td>
                    </tr>';
                    }      
                echo '</tbody>
            </table>';
        }else if($consulta != false){
            echo '<table class="table table-striped table-bordered table-hover" id="detalleimpresoras">
                <thead>
                    <tr align="center" valign="middle">
                        <th>FUNCIONARIO</th>
                        <th>MÓDULO</th>
                        <th>PERFIL</th>
                        <th>FECHA CREACIÓN</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($consulta as $fila => $item) {
                    echo '<tr>
                        <td>'.$item["nombre_funcionario"].'</td>
                        <td>'.$item["nombre_modulo"].'</td>
                        <td>'.$item["nombre_perfil"].'</td>
                        <td>'.$item["fecha_privilegio"].'</td>
                    </tr>';
                    }      
                echo '</tbody>
            </table>';
        }
    }

    static public function formulario_eliminar_privilegio_controlador($datos){
        $eliminar_privilegio_id = $datos["formulario_eliminar_privilegio_id"];
        $eliminar_auditoria_usuario = $datos["formulario_eliminar_auditoria_usuario"];
        echo '<div class="alert alert-danger text-center">
                <i class="icon fa fa-ban"></i><strong>ATENCIÓN:</strong><br>
                Está seguro de eliminar los privilegios a este usuario?
                <form method="post" class="form-horizontal">
                    <input type="hidden" id="eliminar_privilegio_id" value="'.$eliminar_privilegio_id.'">
                    <input type="hidden" id="eliminar_auditoria_usuario" value="'.$eliminar_auditoria_usuario.'">
                </form>
            </div>';
    }

    static public function eliminar_privilegio_controlador($datos){
        $respuesta = Privilegio_Registro_Modelo::eliminar_privilegio_modelo("privilegio_registro", $datos);
        return $respuesta;
    }

    static public function menu_opciones_orip_controlador(){
        $idfun=$_SESSION['snr'];
        $consulta_cargo = Privilegio_Registro_Modelo::menu_opciones_orip_modelo("funcionario", $idfun);
        $consulta_rol = Privilegio_Registro_Modelo::consulta_rol_modelo("funcionario", $idfun);
        if($consulta_cargo["id_cargo"] == 1 || $consulta_rol["id_rol"] == 1){
            return $respuesta_menu = 1;
        }else{
            return $respuesta_menu = 2;
        }
    }
}


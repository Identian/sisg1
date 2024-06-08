<?php
require_once "../controlador/privilegio_registro.php";
require_once "../modelo/privilegio_registro.php";

class Privilegio_Registro_Ajax{

    public $id_modulo_privilegio;
    public function modulo_privilegio_registro(){
        $datos = htmlspecialchars($this->id_modulo_privilegio);
        $respuesta = Privilegio_Registro_Controlador::formulario_modulo_privilegio_registro_controlador($datos);
        echo $respuesta;
    }

    public $formulario_eliminar_privilegio_id;
    public $formulario_eliminar_auditoria_usuario;
    public function formulario_eliminar_privilegio(){
        $datos = array("formulario_eliminar_privilegio_id"=>htmlspecialchars($this->formulario_eliminar_privilegio_id),
                        "formulario_eliminar_auditoria_usuario"=>htmlspecialchars($this->formulario_eliminar_auditoria_usuario));
        $respuesta = Privilegio_Registro_Controlador::formulario_eliminar_privilegio_controlador($datos);
        echo $respuesta;
    }

    public $eliminar_privilegio_id;
    public $eliminar_auditoria_usuario;
    public function eliminar_privilegio(){
        $datos = array("eliminar_privilegio_id"=>htmlspecialchars($this->eliminar_privilegio_id),
                        "eliminar_auditoria_usuario"=>htmlspecialchars($this->eliminar_auditoria_usuario));
        $respuesta = Privilegio_Registro_Controlador::eliminar_privilegio_controlador($datos);
        echo $respuesta;
    }
}

if(isset($_POST["id_modulo_privilegio"]) && $_POST["id_modulo_privilegio"] != ''){
    $perfil = new Privilegio_Registro_Ajax();
    $perfil -> id_modulo_privilegio = $_POST["id_modulo_privilegio"];
    $perfil -> modulo_privilegio_registro();
}

if(isset($_POST["formulario_eliminar_privilegio_id"]) && isset($_POST["formulario_eliminar_auditoria_usuario"])){
    $perfil = new Privilegio_Registro_Ajax();
    $perfil -> formulario_eliminar_privilegio_id = $_POST["formulario_eliminar_privilegio_id"];
    $perfil -> formulario_eliminar_auditoria_usuario = $_POST["formulario_eliminar_auditoria_usuario"];
    $perfil -> formulario_eliminar_privilegio();
}

if(isset($_POST["eliminar_privilegio_id"]) && isset($_POST["eliminar_auditoria_usuario"])){
    $perfil = new Privilegio_Registro_Ajax();
    $perfil -> eliminar_privilegio_id = $_POST["eliminar_privilegio_id"];
    $perfil -> eliminar_auditoria_usuario = $_POST["eliminar_auditoria_usuario"];
    $perfil -> eliminar_privilegio();
}
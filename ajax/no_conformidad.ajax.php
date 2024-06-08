<?php
require_once "../controlador/no_conformidad.php";
require_once "../modelo/no_conformidad.php";

class No_Conformidad_Ajax{

    public $consulta_id_nc_orip_pnc;
    public function consulta_id_nc_orip_pnc_ajax(){
        $datos = htmlspecialchars($this->consulta_id_nc_orip_pnc);
        $respuesta = No_Conformidad_Controlador::consulta_id_nc_orip_pnc_controlador($datos);
        echo $respuesta;
    }

    public $formulario_id_nc_orip_pnc;
    public $formulario_funcionario_auditoria_usuario;
    public function formulario_completar_id_nc_orip_pnc_ajax(){
        $datos = array("formulario_id_nc_orip_pnc"=>htmlspecialchars($this->formulario_id_nc_orip_pnc),
                "formulario_funcionario_auditoria_usuario"=>htmlspecialchars($this->formulario_funcionario_auditoria_usuario));
        $respuesta = No_Conformidad_Controlador::formulario_completar_id_nc_orip_pnc_controlador($datos);
        echo $respuesta;
    }

    public $id_no_conformidad;
    public $id_funcionario_auditoria_usuario;
    public $turno;
    public $tratamiento_omision;
    public function correccion_id_nc_orip_pnc_ajax(){
        $datos = array("id_no_conformidad"=>htmlspecialchars($this->id_no_conformidad),
                "id_funcionario_auditoria_usuario"=>htmlspecialchars($this->id_funcionario_auditoria_usuario),
                "turno"=>htmlspecialchars($this->turno),
                "tratamiento_omision"=>htmlspecialchars($this->tratamiento_omision));
        $respuesta = No_Conformidad_Controlador::registro_correccion_controlador($datos);
        echo $respuesta;
    }  

    public $tipo_responsable_error;
    public $id_orip;
    public function consulta_responsable_error_ajax(){
        $datos = array("tipo_responsable_error"=>htmlspecialchars($this->tipo_responsable_error),
                "id_orip"=>htmlspecialchars($this->id_orip));
        $respuesta = No_Conformidad_Controlador::consulta_responsable_error_controlador($datos);
        echo $respuesta;
    }
}

if(isset($_POST["consulta_id_nc_orip_pnc"]) && $_POST["consulta_id_nc_orip_pnc"] != ''){
    $no_conformidad = new No_Conformidad_Ajax();
    $no_conformidad -> consulta_id_nc_orip_pnc = $_POST["consulta_id_nc_orip_pnc"];
    $no_conformidad -> consulta_id_nc_orip_pnc_ajax();
}

if(isset($_POST["formulario_id_nc_orip_pnc"]) && isset($_POST["formulario_funcionario_auditoria_usuario"])){
    $no_conformidad = new No_Conformidad_Ajax();
    $no_conformidad -> formulario_id_nc_orip_pnc = $_POST["formulario_id_nc_orip_pnc"];
    $no_conformidad -> formulario_funcionario_auditoria_usuario = $_POST["formulario_funcionario_auditoria_usuario"];
    $no_conformidad -> formulario_completar_id_nc_orip_pnc_ajax();
}

if(isset($_POST["id_no_conformidad"]) && isset($_POST["id_funcionario_auditoria_usuario"]) && isset($_POST["turno"]) && $_POST["turno"] != ''){
    $no_conformidad = new No_Conformidad_Ajax();
    $no_conformidad -> id_no_conformidad = $_POST["id_no_conformidad"];
    $no_conformidad -> id_funcionario_auditoria_usuario = $_POST["id_funcionario_auditoria_usuario"];
    $no_conformidad -> turno = $_POST["turno"];
    $no_conformidad -> tratamiento_omision = $_POST["tratamiento_omision"];
    $no_conformidad -> correccion_id_nc_orip_pnc_ajax();
}

if(isset($_POST["tipo_responsable_error"]) && $_POST["tipo_responsable_error"] != ''){
    $no_conformidad = new No_Conformidad_Ajax();
    $no_conformidad -> tipo_responsable_error = $_POST["tipo_responsable_error"];
    $no_conformidad -> id_orip = $_POST["id_orip"];
    $no_conformidad -> consulta_responsable_error_ajax();
}
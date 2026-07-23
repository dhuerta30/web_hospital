<?php

namespace App\Controllers;

use App\core\SessionManager;
use App\core\Token;
use App\core\Request;
use App\core\DB;
use App\core\Redirect;
use App\core\ArtifyStencil;

class SliderController
{
    public $token;

    public function __construct()
    {
        SessionManager::startSession();
        $Sesusuario = SessionManager::get('usuario');
        if (!isset($Sesusuario)) {
            Redirect::to("login");
        }
        $this->token = Token::generateFormToken('send_message');
    }

    public function index()
    {
        $artify = DB::ArtifyCrud();
        $artify->formDisplayInPopup();
        $artify->colRename("id_slider", "ID");
        $artify->buttonHide("submitBtnSaveBack");
        $artify->fieldTypes("imagen", "FILE_NEW");
        $artify->setSettings("pagination", false);
        $artify->setSettings("function_filter_and_search", true);
        $artify->setSettings("searchbox", true);
        $artify->setSettings("deleteMultipleBtn", false);
        $artify->setSettings("recordsPerPageDropdown", false);
        $artify->setSettings("totalRecordsInfo", true);
        $artify->setSettings("addbtn", true);
        $artify->setSettings("editbtn", true);
        $artify->setSettings("viewbtn", false);
        $artify->setSettings("delbtn", true);
        $artify->setSettings("actionbtn", true);
        $artify->setSettings("checkboxCol", false);
        $artify->setSettings("numberCol", false);
        $artify->setSettings("printBtn", false);
        $artify->setSettings("pdfBtn", false);
        $artify->setSettings("csvBtn", false);
        $artify->setSettings("excelBtn", false);
        $artify->fieldNotMandatory("titulo");
        $artify->fieldNotMandatory("contenido");
        $artify->addCallback("before_insert", [$this, "before_insert_slider"]);
        $artify->addCallback("before_update", [$this, "before_update_slider"]);
        $artify->addCallback("format_table_data", [$this, "formatTableDataCallBackslider"]);
        $artify->addCallback("before_delete", [$this, "eliminar_slider"]);
        $render = $artify->dbTable('slider')->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('slider', [
            'render' => $render
        ]);
    }

    public function eliminar_slider($data, $obj){
        $id = $data["id"];
        $queryfy = $obj->getQueryfyObj();

        // Obtener imagen asociada al slider
        $queryfy->where("id_slider", $id);
        $result = $queryfy->select("slider");

        if ($result && isset($result[0]["imagen"])) {
            $imagen = $result[0]["imagen"];

            // Actualizar tabla noticias
            $queryfy2 = $obj->getQueryfyObj(); // nuevo objeto para evitar where acumulados
            $queryfy2->where("imagen", $imagen);
            $queryfy2->update("noticias", array("enviar_imagen_a_slider" => "2"));
        }

        return $data;
    }


    public function formatTableDataCallBackslider($data, $obj){
        if($data){
            foreach($data as &$item){
                $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'" data-fancybox="gallery" data-caption="'.$item["titulo"].'">
                                    <img width="100" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                   </a>';
            }
        }
        return $data;
    }

    public function before_insert_slider($data, $obj){
        $data["slider"]["imagen"] = basename($data["slider"]["imagen"]);
        return $data;
    }

    public function before_update_slider($data, $obj){
        $data["slider"]["imagen"] = basename($data["slider"]["imagen"]);
        return $data;
    }

}
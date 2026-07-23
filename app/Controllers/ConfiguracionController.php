<?php

namespace App\Controllers;

use App\core\SessionManager;
use App\core\Token;
use App\core\DB;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use Docufy;

class ConfiguracionController
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
        $settings["script_url"] = $_ENV['URL_ArtifyCrud'];
        $_ENV["url_artify"] = "artify/artifycrud.php";
        $settings["url_artify"] = $_ENV["url_artify"];
        $settings["downloadURL"] = $_ENV['DOWNLOAD_URL'];
        $settings["hostname"] = $_ENV['DB_HOST'];
        $settings["database"] = $_ENV['DB_NAME'];
        $settings["username"] = $_ENV['DB_USER'];
        $settings["password"] = $_ENV['DB_PASS'];
        $settings["dbtype"] = $_ENV['DB_TYPE'];
        $settings["characterset"] = $_ENV["CHARACTER_SET"];

        $autoSuggestion = false;
        $artify = DB::ArtifyCrud(false, "", "", $autoSuggestion, $settings);
        $artify->addPlugin("bootstrap-colorpicker");
        $artify->setPK("id_configuracion");
        $queryfy = $artify->getQueryfyObj();
        $queryfy->where("id_configuracion", "1");
        $img = $queryfy->select("configuracion");
        
        $artify->addCallback("before_update", [$this, "before_actualizar_configuracion"]);
        $artify->tableHeading('Configuración del Sistema');
        $html_template = '<div id="i57h" class="row pt-4">
                                <div id="iyql" class="col-md"><div class="form-group">
                                    <label id="iyvph" class="form-label">Logo Login:</label>
                                    <img class="logo_login w-25 img-thumbnail" src="'.$_ENV["BASE_URL"]. "app/libs/artify/uploads/" . $img[0]["logo_login"].'">
                                    <span id="i6jpb" class="editable">{logo_login}</span>
                                    <p class="artify_help_block help-block form-text with-errors"></p>
                                </div>
                            </div>
                            <div id="irlr1" class="col-md">
                                <div class="form-group">
                                    <label id="i9t5d" class="form-label">Logo Panel:</label>
                                    <img class="logo_panel w-25 mb-3 img-thumbnail" src="'.$_ENV["BASE_URL"]. "app/libs/artify/uploads/" . $img[0]["logo_panel"].'">
                                    <span id="iywri" class="editable">{logo_panel}</span>
                                    <p class="artify_help_block help-block form-text with-errors"></p>
                                    </div>
                                </div>
                            <div id="ijhw1" class="col-md">
                                <div class="form-group">
                                <label id="i3vek" class="form-label">Título Sistema:</label>
                                <span id="ifa97" class="editable">{titulo_sistema}</span>
                                <p class="artify_help_block help-block form-text with-errors"></p>
                                </div>
                            </div>
                            <div id="ijhw1" class="col-md">
                                <div class="form-group">
                                <label id="i3vek" class="form-label">Color de Fondo Menu Panel:</label>
                                <span id="ifa97" class="editable">{color_fondo_menu_panel}</span>
                                <p class="artify_help_block help-block form-text with-errors"></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label id="i9t5d" class="form-label">Banner Superior:</label>
                                    <img class="banner_superior w-50 mb-3 img-thumbnail" src="'.$_ENV["BASE_URL"]. "app/libs/artify/uploads/" . $img[0]["banner_superior"].'">
                                    <span id="iywri" class="editable">{banner_superior}</span>
                                    <p class="artify_help_block help-block form-text with-errors"></p>
                                </div>
                            </div>
                        </div>';
        $artify->set_template($html_template);
        $artify->setSettings('required', true);
        $artify->setSettings('hideAutoIncrement', true);
        $artify->setSettings('encryption', true);
        $artify->fieldTypes("logo_login", "FILE_NEW");
        $artify->fieldTypes("logo_panel", "FILE_NEW");
        $artify->fieldTypes("banner_superior", "FILE_NEW");
        $artify->fieldTypes("titulo_sistema", "input");
        $artify->fieldCssClass("color_fondo_menu_panel", array("color_fondo_menu_panel"));
        $artify->formFields(array(
            "logo_login", 
            "logo_panel", 
            "titulo_sistema", 
            "color_fondo_menu_panel", 
            "banner_superior"
        ));
        $artify->setSettings('template', 'template_configuracion');
        $render = $artify->dbTable('configuracion')->render("editform", array("id" => "1"));
        $color = $artify->loadPluginJsCode("bootstrap-colorpicker",".color_fondo_menu_panel");

        $barra_lateral_izquierda = DB::ArtifyCrud(true);
        $template_lateral_izquierda = '
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group tipo_contenido">
                        <label id="i9t5d" class="form-label">Tipo Contenido:</label>
                        {tipo_contenido}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group seccion_imagen d-none">
                        <label id="i9t5d" class="form-label">Imagen</label>
                        {imagen}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group seccion_video d-none">
                        <label id="i9t5d" class="form-label">Video</label>
                        {video}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group seccion_url d-none">
                        <label id="i9t5d" class="form-label">Url</label>
                        {url}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label id="i9t5d" class="form-label">Ordenar</label>
                        {ordenar}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>
            </div>
        ';

        $barra_lateral_izquierda->set_template($template_lateral_izquierda);
        $barra_lateral_izquierda->formDisplayInPopup();

        $barra_lateral_izquierda->fieldCssClass("imagen", array("imagen"));
        $barra_lateral_izquierda->fieldCssClass("url", array("url"));
        $barra_lateral_izquierda->fieldCssClass("video", array("video"));

        /*$barra_lateral_izquierda->fieldNotMandatory("imagen");
        $barra_lateral_izquierda->fieldNotMandatory("video");
        $barra_lateral_izquierda->fieldNotMandatory("url");*/

        $barra_lateral_izquierda->fieldTypes("tipo_contenido", "select");
        $barra_lateral_izquierda->fieldDataBinding("tipo_contenido", array("Imagen" => "Imagen", "Video" => "Video"), "", "", "array");
        $barra_lateral_izquierda->dbOrderBy("ordenar asc");

        $barra_lateral_izquierda->fieldTypes("video", "TEXTAREA");
        $barra_lateral_izquierda->colRename("id_barra_lateral_izquierda", "ID");
        $barra_lateral_izquierda->buttonHide("submitBtnSaveBack");
        $barra_lateral_izquierda->fieldTypes("imagen", "FILE_NEW");
        $barra_lateral_izquierda->setSettings("actionbtn", true);
        $barra_lateral_izquierda->setSettings("required", false);
        $barra_lateral_izquierda->setSettings("editbtn", true);
        $barra_lateral_izquierda->setSettings("delbtn", true);
        $barra_lateral_izquierda->setSettings("pagination", true);
        $barra_lateral_izquierda->addCallback("format_table_data", [$this, "formatTableDataCallBackbarralateralizquierda"]);
        $barra_lateral_izquierda->setSettings("function_filter_and_search", true);
        $barra_lateral_izquierda->setSettings("searchbox", true);
        $barra_lateral_izquierda->setSettings("deleteMultipleBtn", false);
        $barra_lateral_izquierda->setSettings("recordsPerPageDropdown", true);
        $barra_lateral_izquierda->setSettings("totalRecordsInfo", true);
        $barra_lateral_izquierda->addCallback("before_insert", [$this, "before_insert_barra_lateral_izquierda"]);
        $barra_lateral_izquierda->addCallback("before_update", [$this, "before_update_barra_lateral_izquierda"]);
        $render_barra_lateral_izquierda = $barra_lateral_izquierda->dbTable("barra_lateral_izquierda")->render();

        $barra_lateral_derecha = DB::ArtifyCrud(true);
        $template_lateral_derecha = '
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group tipo_contenido">
                        <label id="i9t5d" class="form-label">Tipo Contenido:</label>
                        {tipo_contenido}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group seccion_imagen d-none">
                        <label id="i9t5d" class="form-label">Imagen</label>
                        {imagen}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group seccion_video d-none">
                        <label id="i9t5d" class="form-label">Video</label>
                        {video}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group seccion_url d-none">
                        <label id="i9t5d" class="form-label">Url</label>
                        {url}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label id="i9t5d" class="form-label">Ordenar</label>
                        {ordenar}
                        <p class="artify_help_block help-block form-text with-errors"></p>
                    </div>
                </div>
            </div>
        ';

        $barra_lateral_derecha->set_template($template_lateral_derecha);
        $barra_lateral_derecha->formDisplayInPopup();
        
        $barra_lateral_derecha->fieldCssClass("imagen", array("imagen"));
        $barra_lateral_derecha->fieldCssClass("url", array("url"));
        $barra_lateral_derecha->fieldCssClass("video", array("video"));

        /*$barra_lateral_derecha->fieldNotMandatory("imagen");
        $barra_lateral_derecha->fieldNotMandatory("video");
        $barra_lateral_derecha->fieldNotMandatory("url");*/

        $barra_lateral_derecha->fieldTypes("tipo_contenido", "select");
        $barra_lateral_derecha->fieldDataBinding("tipo_contenido", array("Imagen" => "Imagen", "Video" => "Video"), "", "", "array");

        $barra_lateral_derecha->fieldTypes("video", "TEXTAREA");
        $barra_lateral_derecha->colRename("id_barra_lateral_derecha", "ID");
        $barra_lateral_derecha->buttonHide("submitBtnSaveBack");
        $barra_lateral_derecha->fieldTypes("imagen", "FILE_NEW");
        $barra_lateral_derecha->setSettings("actionbtn", true);
        $barra_lateral_derecha->setSettings("editbtn", true);
        $barra_lateral_derecha->setSettings("required", false);
        $barra_lateral_derecha->setSettings("delbtn", true);
        $barra_lateral_derecha->setSettings("pagination", true);
        $barra_lateral_derecha->setSettings("function_filter_and_search", true);
        $barra_lateral_derecha->setSettings("searchbox", true);
        $barra_lateral_derecha->setSettings("deleteMultipleBtn", false);
        $barra_lateral_derecha->setSettings("recordsPerPageDropdown", true);
        $barra_lateral_derecha->setSettings("totalRecordsInfo", true);
        $barra_lateral_derecha->dbOrderBy("ordenar asc");
        $barra_lateral_derecha->addCallback("before_insert", [$this, "before_insert_barra_lateral_derecha"]);
        $barra_lateral_derecha->addCallback("before_update", [$this, "before_update_barra_lateral_derecha"]);
        $barra_lateral_derecha->addCallback("format_table_data", [$this, "formatTableDataCallBackbarralateralderecha"]);
        $render_barra_lateral_derecha = $barra_lateral_derecha->dbTable("barra_lateral_derecha")->render();

        $barra_inferior = DB::ArtifyCrud(true);
        $barra_inferior->formDisplayInPopup();
        $barra_inferior->colRename("id_barra_inferior", "ID");
        $barra_inferior->buttonHide("submitBtnSaveBack");
        $barra_inferior->fieldTypes("imagen", "FILE_NEW");
        $barra_inferior->setSettings("actionbtn", true);
        $barra_inferior->setSettings("editbtn", true);
        $barra_inferior->setSettings("delbtn", true);
        $barra_inferior->setSettings("pagination", true);
        $barra_inferior->setSettings("function_filter_and_search", true);
        $barra_inferior->setSettings("searchbox", true);
        $barra_inferior->setSettings("deleteMultipleBtn", false);
        $barra_inferior->setSettings("recordsPerPageDropdown", false);
        $barra_inferior->setSettings("totalRecordsInfo", true);
        $barra_inferior->addCallback("before_insert", [$this, "before_insert_barra_inferior"]);
        $barra_inferior->addCallback("before_update", [$this, "before_update_barra_inferior"]);
        $barra_inferior->addCallback("format_table_data", [$this, "formatTableDataCallBackbarrainferior"]);
        $render_barra_inferior = $barra_inferior->dbTable("barra_inferior")->render();

        $redes_sociales = DB::ArtifyCrud(true);
        $redes_sociales->colRename("id_redes_sociales", "ID");
        $redes_sociales->setSettings("searchbox", true);
        $redes_sociales->setSettings("editbtn", true);
        $redes_sociales->setSettings("delbtn", true);
        $redes_sociales->buttonHide("submitBtnSaveBack");
        $render_sociales = $redes_sociales->dbTable("redes_sociales")->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('configuracion', [
            'render' => $render, 
            'color' => $color,
            'render_barra_lateral_izquierda' => $render_barra_lateral_izquierda,
            'render_barra_lateral_derecha' => $render_barra_lateral_derecha,
            'render_barra_inferior' => $render_barra_inferior,
            'render_sociales' => $render_sociales
        ]);
    }

    public function formatTableDataCallBackbarralateralizquierda($data, $obj){
         if($data){
            foreach($data as &$item){
                if(!empty($item["imagen"])){
                    $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'" data-fancybox="gallery" data-caption="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                    <img width="150" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                   </a>';
                } else {
                    $item["imagen"] = "<div class='badge badge-danger'>Sin Imagen</div>";
                }

                if(empty($item["video"])){
                    $item["video"] = "<div class='badge badge-danger'>Sin Video</div>";
                } else {
                    $item["video"] = html_entity_decode($item["video"]);
                }
                
            }
        }
        return $data;
    }

    public function formatTableDataCallBackbarrainferior($data, $obj){
        if($data){
            foreach($data as &$item){
                if(!empty($item["imagen"])){
                    $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'" data-fancybox="gallery" data-caption="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                    <img width="150" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                   </a>';
                }                
            }
        }
        return $data;
    }

    public function formatTableDataCallBackbarralateralderecha($data, $obj){
        if($data){
            foreach($data as &$item){
                if(!empty($item["imagen"])){
                    $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'" data-fancybox="gallery" data-caption="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                    <img width="150" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                   </a>';
                } else {
                    $item["imagen"] = "<div class='badge badge-danger'>Sin Imagen</div>";
                }

                if(empty($item["video"])){
                    $item["video"] = "<div class='badge badge-danger'>Sin Video</div>";
                } else {
                    $item["video"] = html_entity_decode($item["video"]);
                }
                
            }
        }
        return $data;
    }

    public function before_insert_barra_lateral_izquierda($data, $obj){
        $data["barra_lateral_izquierda"]["imagen"] = basename((string)($data["barra_lateral_izquierda"]["imagen"] ?? ''));
        return $data;
    }

    public function before_update_barra_lateral_izquierda($data, $obj){
        $data["barra_lateral_izquierda"]["imagen"] = basename((string)($data["barra_lateral_izquierda"]["imagen"] ?? ''));
        return $data;
    }

    public function before_insert_barra_lateral_derecha($data, $obj){
        $data["barra_lateral_derecha"]["imagen"] = basename((string)($data["barra_lateral_derecha"]["imagen"] ?? ''));
        return $data;
    }

    public function before_update_barra_lateral_derecha($data, $obj){
        $data["barra_lateral_derecha"]["imagen"] = basename((string)($data["barra_lateral_derecha"]["imagen"] ?? ''));
        return $data;
    }

    public function before_insert_barra_inferior($data, $obj){
        $data["barra_inferior"]["imagen"] = basename((string)($data["barra_inferior"]["imagen"] ?? ''));
        return $data;
    }

    public function before_update_barra_inferior($data, $obj){
        $data["barra_inferior"]["imagen"] = basename((string)($data["barra_inferior"]["imagen"] ?? ''));
        return $data;
    }

    public function before_actualizar_configuracion($data, $obj){
        $data["configuracion"]["logo_login"] = basename((string)($data["configuracion"]["logo_login"] ?? ''));
        $data["configuracion"]["logo_panel"] = basename((string)($data["configuracion"]["logo_panel"] ?? ''));
        $data["configuracion"]["banner_superior"] = basename((string)($data["configuracion"]["banner_superior"] ?? ''));
        return $data;
    }
}
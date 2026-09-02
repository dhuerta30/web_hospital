<?php

namespace App\Controllers;

use App\core\SessionManager;
use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;

class PaginaController
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
        $artify->addPlugin("summernote");
        $template = '
        <div class="card">
            <div class="card-header bg-dark">
                Registro Médico
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Titulo</label>
                            {titulo}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Fecha</label>
                            {fecha}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Imagen</label>
                            {imagen}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Contenido</label>
                            {contenido}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Publicado por</label>
                            {publicado_por}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Categoría</label>
                            {categoria}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        $usuario = $_SESSION["usuario"][0]["nombre"];
        $artify->set_template($template);
        $artify->setSettings("actionFilterPosition", "top");
        $artify->addFilter("TituloFiltro", "Filtrar por Fecha", "fecha", "date");
        $artify->setFilterSource("TituloFiltro", "noticias", "fecha", "fecha as pl", "db");
        $artify->formFieldValue("publicado_por", $usuario);
        $artify->fieldDataAttr("publicado_por", array("readonly"=>"true"));
        $artify->colRename("id_pagina", "ID");
        $artify->setSettings("searchbox", true);
        $rol = $_SESSION["usuario"][0]["idrol"];
        if($rol == 2){
            $artify->setSettings("editbtn", true);
            $artify->setSettings("clonebtn", false);
            $artify->setSettings("delbtn", false);
        } else {
            $artify->setSettings("editbtn", true);
            $artify->setSettings("clonebtn", true);
            $artify->setSettings("delbtn", true);
        }
        $artify->setSettings("encryption", true);
        $artify->setSettings("encryption", true);
        $artify->fieldTypes("imagen", "FILE_NEW");
        $artify->crudRemoveCol(array("slug"));
        $artify->fieldTypes("categoria", "select");
        $artify->fieldDataBinding("categoria", array("Pagina" => "Pagina"), "", "", "array");
        $action = $_ENV["BASE_URL"]."pagina/{slug}";
        $text = 'Ver';
        $attr = array("title"=>"Ver", "target" => "_blank");
        $artify->enqueueBtnActions("url btn-light", $action, "url", $text, "", $attr); 
        $artify->buttonHide("submitBtnSaveBack");
        $artify->tableColFormatting("fecha", "date", array("format" =>"d/m/Y"));
        $artify->setSettings("function_filter_and_search", true);
        $artify->addCallback("before_insert", [$this, "insertar_pagina"]);
        $artify->addCallback("before_update", [$this, "actualizar_pagina"]);
        $artify->fieldCssClass("contenido", array("summernote"));
        $artify->addCallback("format_table_data", [$this, "formatTableDataCallBackpagina"]);
        $artify->fieldNotMandatory("imagen");
        $render = $artify->dbTable("pagina")->render();
        $select2 = $artify->loadPluginJsCode("summernote", ".summernote");
        $stencil = new ArtifyStencil();
        echo $stencil->render('Pagina', [
            'render' => $render,
            'select2' => $select2
        ]);
    }

    public function formatTableDataCallBackpagina($data, $obj){
        if($data){
            foreach($data as &$item){
                $titulo = str_replace('-', ' ', $item["titulo"]);
                $titulo = str_replace(['ñ','Ñ'], ['n','N'], $titulo); // reemplazo de ñ por n
                $item["titulo"] = $titulo;
                $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'" data-fancybox="gallery" data-caption="Foto">
                                    <img width="150" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                   </a>';
                $item["contenido"] = mb_strimwidth(strip_tags(html_entity_decode($item["contenido"], ENT_QUOTES, 'UTF-8')), 0, 50, "...");
            }
        }
        return $data;
    }

    private function slugify($string)
    {
        $string = mb_strtolower($string, 'UTF-8');
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
        $string = preg_replace('/[\s-]+/', '-', $string);
        $string = trim($string, '-');
        return $string;
    }

    public function insertar_pagina($data, $obj){
        $titulo = $data["pagina"]["titulo"];
        if(empty($titulo)){
            $error_msg = array("message" => "", "error" => "El campo Título es obligatorio", "redirectionurl" => "");
            die(json_encode($error_msg));
        }
        $queryfy = $obj->getQueryfyObj();
        $queryfy->where("titulo", $titulo);
        $result = $queryfy->select("pagina");
        if($result){
            $error_msg = array("message" => "", "error" => "Ya existe una página con ese título. Ingrese uno diferente.", "redirectionurl" => "");
            die(json_encode($error_msg));
        }
        $newData = array();
        $newData["pagina"]["titulo"] = $titulo;
        $newData["pagina"]["slug"] = $this->slugify($titulo);
        $newData["pagina"]["fecha"] = $data["pagina"]["fecha"];
        $newData["pagina"]["imagen"] = basename($data["pagina"]["imagen"]);
        $newData["pagina"]["contenido"] = $data["pagina"]["contenido"];
        $newData["pagina"]["publicado_por"] = $data["pagina"]["publicado_por"];
        $newData["pagina"]["categoria"] = $data["pagina"]["categoria"];
        return $newData;
    }

    public function actualizar_pagina($data, $obj){
        $newData = array();
        $newData["pagina"]["titulo"] = $data["pagina"]["titulo"];
        $newData["pagina"]["slug"] = $this->slugify($data["pagina"]["titulo"]);
        $newData["pagina"]["fecha"] = $data["pagina"]["fecha"];
        $newData["pagina"]["imagen"] = basename($data["pagina"]["imagen"]);
        $newData["pagina"]["contenido"] = $data["pagina"]["contenido"];
        $newData["pagina"]["publicado_por"] = $data["pagina"]["publicado_por"];
        $newData["pagina"]["categoria"] = $data["pagina"]["categoria"];
        return $newData;
    }
}
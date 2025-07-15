<?php

namespace App\Controllers;

use App\core\SessionManager;
use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;

class NoticiasController
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
        $artify->tableColFormatting("imagen", "html", array("type" =>"html", "str"=>"<img style='100%' src= \"".$_ENV["BASE_URL"]."app/libs/uploads/{col-name}\">"));
        $artify->fieldDataAttr("publicado_por", array("readonly"=>"true"));
        $artify->colRename("id_noticias", "ID");
        $artify->setSettings("searchbox", true);
        $artify->setSettings("editbtn", true);
        $artify->setSettings("clonebtn", true);
        $artify->setSettings("delbtn", true);
        $artify->fieldTypes("imagen", "FILE_NEW");
        $artify->buttonHide("submitBtnSaveBack");
        $artify->setSettings("function_filter_and_search", true);
        $artify->addCallback("before_insert", [$this, "insertar_noticias"]);
        $artify->addCallback("before_update", [$this, "actualizar_noticias"]);
        $render = $artify->dbTable("noticias")->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('noticias', [
            'render' => $render
        ]);
    }

    public function insertar_noticias($data, $obj){
        $data["noticias"]["imagen"] = basename($data["noticias"]["imagen"]);
        return $data;
    }

    public function actualizar_noticias($data, $obj){
        $data["noticias"]["imagen"] = basename($data["noticias"]["imagen"]);
        return $data;
    }
}
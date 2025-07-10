<?php

namespace App\Controllers;

use App\core\SessionManager;
use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;

class SliderController
{
    public $token;

	public function __construct()
	{
		SessionManager::startSession();
		$Sesusuario = SessionManager::get('usuario');
		if (isset($Sesusuario)) {
			if ($_SERVER['REQUEST_URI'] === "/home/modulos") {
				Redirect::to("modulos");
			}
		} else {
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
                Crear Slider Web
            </div>
            <div class="card-body">
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Titulo</label>
                            {titulo}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Url</label>
                            {url}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Url</label>
                            {imagen}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>';
        $artify->set_template($template);
        $artify->addFilter("FiltroTitulo", "Filtrar por Titulo", "titulo", "dropdown");
        $artify->setFilterSource("FiltroTitulo", "tabla_bd", "titulo", "titulo as pl", "db");
        $artify->setSettings("actionFilterPosition", "top");
        $artify->formDisplayInPopup();
        $artify->setSettings("function_filter_and_search", true);
        $artify->fieldTypes("imagen", "FILE_NEW");
        $artify->setSettings("searchbox", true);
        $artify->buttonHide("submitBtnSaveBack");
        $artify->colRename("id_slider", "ID");
        $render = $artify->dbTable("slider")->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('slider', [
            'render' => $render
        ]);
    }
}
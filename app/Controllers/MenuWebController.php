<?php

namespace App\Controllers;

use App\core\SessionManager;
use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;

class MenuWebController
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
        Redirect::areaProtegida("menu", "modulos");

		$artify = DB::ArtifyCrud();

		$action = "javascript:;";
		$text = '<i class="fas fa-arrows-alt-v"></i>';
		$attr = array("title"=>"Arrastra para Reordenar Fila");
		$artify->enqueueBtnActions("url btn btn-primary btn-sm reordenar_fila", $action, "url", $text, "orden_menu", $attr);
		$artify->multiTableRelationDisplay("tab", "Menu");
		$artify->bulkCrudUpdate("nombre", "text", array("data-some-attr" =>"some-dummy-val"));
		$artify->bulkCrudUpdate("url", "text", array("data-some-attr" =>"some-dummy-val"));

		$artify->bulkCrudUpdate("visibilidad", "select", array("data-cust-attr" =>"some-cust-val"), array(
			array(
				"Visible",
				"Visible"
			),
			array(
				"Oculto",
				"Oculto"
			)
		));

		$artify->colRename("id_menu_web", "ID");

		$artify->setSearchCols(array("nombre","url", "icono", "visibilidad"));
		$artify->fieldHideLable("submenu");
		$artify->fieldDataAttr("submenu", array("style"=>"display:none"));
		$artify->formFieldValue("submenu", "No");
		$artify->addPlugin("select2");
		$artify->fieldGroups("group1", array("nombre", "url"));
		$artify->crudRemoveCol(array("id_menu"));
		$artify->setSettings("searchbox", true);
		$artify->setSettings("printBtn", false);
		$artify->setSettings("pdfBtn", false);
		$artify->setSettings("csvBtn", false);
		$artify->setSettings("excelBtn", false);
		$artify->setSettings("viewbtn", false);
		$artify->setSettings("refresh", false);
		$artify->setSettings('editbtn', true);    
		$artify->setSettings('delbtn', true);
		$artify->setSettings("function_filter_and_search", true);
		$artify->buttonHide("submitBtnSaveBack");

		$artify->fieldTypes("visibilidad", "select");
		$artify->fieldDataBinding("visibilidad", array("Visible" => "Visible", "Oculto" => "Oculto"), "", "","array");

		$select2 = $artify->loadPluginJsCode("select2",".icono_menu, .icono_submenu");
		$render = $artify->dbTable("menu_web")->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('menu_web', [
            'render' => $render
        ]);
    }
}
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
		$artify->tableHeading("Primer Nivel");
		/*$action = "javascript:;";
		$text = '<i class="fas fa-arrows-alt-v"></i>';
		$attr = array("title"=>"Arrastra para Reordenar Fila");
		$artify->enqueueBtnActions("url btn btn-primary btn-sm reordenar_fila", $action, "url", $text, "orden_menu", $attr);*/
		$artify->multiTableRelationDisplay("tab", "Primer Nivel");
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

		$submenu = DB::ArtifyCrud(true);
		$submenu->tableHeading("Segundo Nivel");
		$submenu->multiTableRelationDisplay("tab", "Segundo Nivel");
		$submenu->setSettings("searchbox", true);
		$submenu->setSettings('editbtn', true);    
		$submenu->setSettings('delbtn', true);
		$submenu->colRename("id_submenu_web", "ID");
		$submenu->dbTable("submenu_web");
		$submenu->buttonHide("submitBtnSaveBack");
		$submenu->bulkCrudUpdate("nombre_submenu", "text", array("data-some-attr" =>"some-dummy-val"));
		$submenu->bulkCrudUpdate("url_submenu", "text", array("data-some-attr" =>"some-dummy-val"));
		$submenu->fieldHideLable("id_menu_web");
		$submenu->fieldDataAttr("id_menu_web", array("style"=>"display:none"));
		$submenu->fieldGroups("group1", array("nombre_submenu", "url_submenu"));
		$submenu->fieldTypes("visibilidad_submenu", "select");
		$submenu->fieldDataBinding("visibilidad_submenu", array("Visible" => "Visible", "Oculto" => "Oculto"), "", "","array");
		$submenu->crudTableCol(array(
			"id_submenu_web",
			"nombre_submenu",
			"url_submenu",
			"visibilidad_submenu"
		));
		$submenu->bulkCrudUpdate("visibilidad_submenu", "select", array("data-cust-attr" =>"some-cust-val"), array(
			array(
				"Visible",
				"Visible"
			),
			array(
				"Oculto",
				"Oculto"
			)
		));
		$artify->multiTableRelation("id_menu_web", "id_menu_web", $submenu);

		$submenudos = DB::ArtifyCrud(true);
		$submenudos->tableHeading("Tercer Nivel");
		$submenudos->multiTableRelationDisplay("tab", "Tercer Nivel");
		$submenudos->setSettings("searchbox", true);
		$submenudos->setSettings('editbtn', true);    
		$submenudos->setSettings('delbtn', true);
		$submenudos->colRename("id_submenudos_web", "ID");
		$submenudos->dbTable("submenudos_web");
		$submenudos->buttonHide("submitBtnSaveBack");
		$submenudos->bulkCrudUpdate("nombre_submenudos", "text", array("data-some-attr" =>"some-dummy-val"));
		$submenudos->bulkCrudUpdate("url_submenudos", "text", array("data-some-attr" =>"some-dummy-val"));
		$submenudos->fieldHideLable("id_menu_web");
		$submenudos->fieldDataAttr("id_menu_web", array("style"=>"display:none"));
		$submenudos->fieldGroups("group1", array("nombre_submenudos", "url_submenudos"));
		$submenudos->fieldTypes("visibilidad_submenudos", "select");
		$submenudos->fieldDataBinding("visibilidad_submenudos", array("Visible" => "Visible", "Oculto" => "Oculto"), "", "","array");
		$submenudos->crudTableCol(array(
			"id_submenudos_web",
			"nombre_submenudos",
			"url_submenudos",
			"visibilidad_submenudos"
		));
		$submenudos->bulkCrudUpdate("visibilidad_submenudos", "select", array("data-cust-attr" =>"some-cust-val"), array(
			array(
				"Visible",
				"Visible"
			),
			array(
				"Oculto",
				"Oculto"
			)
		));
		$submenu->multiTableRelation("id_submenu_web", "id_submenu_web", $submenudos);

		$select2 = $artify->loadPluginJsCode("select2",".icono_menu, .icono_submenu");
		$render = $artify->dbTable("menu_web")->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('menu_web', [
            'render' => $render
        ]);
    }
}
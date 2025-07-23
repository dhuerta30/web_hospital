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

		$queryfy = $artify->getQueryfyObj();
		$datamenu = $queryfy->DBQuery("SELECT MAX(orden_menu) as orden FROM menu");
		$newOrdenMenu = $datamenu[0]["orden"] + 1;

		/*$artify->addWhereConditionActionButtons("delete", "id_menu_web", "!=", array(4,5,6,7,10,12,19, 141));
		$artify->addWhereConditionActionButtons("edit", "id_menu_web", "!=", array(4,5,6,7,10,12,19, 141));*/

		$action = "javascript:;";
		$text = '<i class="fas fa-arrows-alt-v"></i>';
		$attr = array("title"=>"Arrastra para Reordenar Fila");
		$artify->enqueueBtnActions("url btn btn-primary btn-sm reordenar_fila", $action, "url", $text, "orden_menu", $attr);
		$artify->multiTableRelationDisplay("tab", "Menu");
		$artify->bulkCrudUpdate("nombre", "text", array("data-some-attr" =>"some-dummy-val"));
		$artify->bulkCrudUpdate("url", "text", array("data-some-attr" =>"some-dummy-val"));
		$artify->setSearchCols(array("nombre","url", "icono", "visibilidad"));
		$artify->fieldHideLable("submenu");
		$artify->fieldDataAttr("submenu", array("style"=>"display:none"));
		$artify->formFieldValue("orden_menu", $newOrdenMenu);
		$artify->formFieldValue("submenu", "No");
		$artify->addPlugin("select2");
		$artify->dbOrderBy("orden_menu asc");
		$artify->addCallback("format_table_data", [$this, "formatTableMenu"]);
		$artify->addCallback("after_insert", [$this, "agregar_menu"]);
		$artify->addCallback("before_delete", [$this, "eliminar_menu"]);
		$artify->fieldTypes("icono_menu", "select");
		$artify->fieldCssClass("icono_menu", array("icono_menu"));
		$artify->fieldCssClass("submenu", array("submenu"));
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
		$select2 = $artify->loadPluginJsCode("select2",".icono_menu, .icono_submenu");
		$render = $artify->dbTable("menu_web")->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('menu_web', [
            'render' => $render
        ]);
    }
}
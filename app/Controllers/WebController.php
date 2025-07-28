<?php

namespace App\Controllers;

use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;
use App\Models\NoticiasModel;

class WebController
{
    public function index()
    {
        $noticias = new NoticiasModel();
        $render = $noticias->post(1, 5);

        $stencil = new ArtifyStencil();
        echo $stencil->render('web/home', [
            'render' => $render
        ]);
    }

    public function buscar_noticias(){
        $request = new Request();

        if ($request->getMethod() === 'POST') {
            $param = $request->post('buscar_noticias');
            
            $settings["includeTemplateCSS"] = false;
            $settings["includeTemplateJS"] = false;
            $artify = DB::ArtifyCrud(false, "pure","pure", $settings);
            $artify->setSettings("addbtn", false);
            $artify->where("titulo", "%$param%", "LIKE", "OR");
            $artify->where("contenido", "%$param%", "LIKE");
            $artify->setPortfolioColumn(1);
            $artify->tableHeading("");
            $artify->recordsPerPage(5);
            $artify->setSettings("searchbox", false);
            $artify->setSettings("refresh", false);
            $artify->setSettings("function_filter_and_search", true);
            $artify->addCallback("format_table_data", [$this, "formatearDatosTablaNoticias"]);
            $artify->crudTableCol(array("titulo", "fecha","imagen", "contenido"));
            $artify->setSettings("template", "noticias");
            $render = $artify->dbTable("noticias")->render();

            echo json_encode(['render' => $render]);
        }
    }

    public function formatearDatosTablaNoticias($data, $obj){
        if($data){
            foreach($data as &$item){
                $item["titulo"] = "<center><h3><strong>".$item["titulo"]."</strong></h3></center>";
                $item["fecha"] = "<center><h5>".date("d/m/Y", strtotime($item["fecha"]))."</h5></center>";
                $item["imagen"] = "<img width='100%' src='".$_ENV["BASE_URL"]."app/libs/artify/uploads/".$item["imagen"]."'>";
                $item["contenido"] = mb_strimwidth(strip_tags(html_entity_decode($item["contenido"], ENT_QUOTES, 'UTF-8')), 0, 250, "...");
            }
        }
        return $data;
    }

    public function page(Request $request){
        
        $id = $request->get("param1");

        $queryfy = DB::Queryfy();
        $queryfy->where("id_noticias", $id);
        $data = $queryfy->select("noticias");
        
        $stencil = new ArtifyStencil();
        echo $stencil->render('web/pagina', [
            'data' => $data
        ]);
    }
}
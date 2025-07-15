<?php

namespace App\Controllers;

use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;

class WebController
{
    public function index()
    {
        $settings["includeTemplateCSS"] = false;
        $settings["includeTemplateJS"] = false;
        $artify = DB::ArtifyCrud(false, "pure","pure", $settings);
        $artify->setSettings("addbtn", false);
        $artify->setPortfolioColumn(1);
        $artify->tableHeading("");
        $artify->recordsPerPage(5);
        $artify->setSettings("searchbox", false);
        $artify->setSettings("refresh", false);
        $artify->setSettings("function_filter_and_search", true);
        $artify->addCallback("format_table_data", [$this, "formatearDatosTablaNoticias"]);
        $artify->crudTableCol(array("titulo","fecha","imagen"));
        $artify->setSettings("template", "noticias");
        $render = $artify->dbTable("noticias")->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('web/home', [
            'render' => $render
        ]);
    }

    public function formatearDatosTablaNoticias($data, $obj){
        if($data){
            foreach($data as &$item){
                $item["titulo"] = "<center><h3><strong>".$item["titulo"]."</strong></h3></center>";
                $item["fecha"] = "<center><h5>".date("d/m/Y", strtotime($item["fecha"]))."</h5></center>";
                 $item["imagen"] = "<img width='100%' src='".$item["imagen"]."'>";
            }
        }
        return $data;
    }
}
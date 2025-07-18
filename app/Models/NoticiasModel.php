<?php

namespace App\Models;

use App\core\DB;

class NoticiasModel
{
    private $table;

    public function __construct()
    {
        $this->table = 'noticias';
    }

    public function post($setPortfolioColumn, $recordsPerPage)
    {
        $settings["includeTemplateCSS"] = false;
        $settings["includeTemplateJS"] = false;
        $artify = DB::ArtifyCrud(false, "pure","pure", $settings);
        $artify->setSettings("addbtn", false);
        $artify->setPortfolioColumn($setPortfolioColumn);
        $artify->tableHeading("");
        $artify->recordsPerPage($recordsPerPage);
        $artify->setSettings("searchbox", false);
        $artify->setSettings("refresh", false);
        $artify->setSettings("function_filter_and_search", true);
        $artify->addCallback("format_table_data", [$this, "formatearDatosTablaNoticias"]);
        $artify->crudTableCol(array("titulo", "fecha","imagen", "contenido"));
        $artify->setSettings("template", $this->table);
        $render = $artify->dbTable($this->table)->render();
        return $render;
    }

    public function formatearDatosTablaNoticias($data, $obj){
        if($data){
            foreach($data as &$item){
                $item["titulo"] = "<center><a href='".$item["id_noticias"]."'><h3><strong>".$item["titulo"]."</strong></h3></a></center>";
                $item["fecha"] = "<center><h5>".date("d/m/Y", strtotime($item["fecha"]))."</h5></center>";
                $item["imagen"] = "<img width='100%' src='".$_ENV["BASE_URL"]."app/libs/artify/uploads/".$item["imagen"]."'>";
                $item["contenido"] = mb_strimwidth(strip_tags(html_entity_decode($item["contenido"], ENT_QUOTES, 'UTF-8')), 0, 250, "...");
                $item["boton"] = "<div class='row' style='margin-top:20px;'><div class='col-md-12 text-center'><a href='".$item["id_noticias"]."' class='btn btn-info btn-block'>Ver más</a></div></div>";
            }
        }
        return $data;
    }
}
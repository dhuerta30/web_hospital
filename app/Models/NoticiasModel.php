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
        $artify->crudTableCol(array("titulo","fecha","imagen"));
        $artify->setSettings("template", $this->table);
        $render = $artify->dbTable($this->table)->render();
        return $render;
    }

    public function formatearDatosTablaNoticias($data, $obj){
        if($data){
            foreach($data as &$item){
                $item["titulo"] = "<center><h3><strong>".$item["titulo"]."</strong></h3></center>";
                $item["fecha"] = "<center><h5>".date("d/m/Y", strtotime($item["fecha"]))."</h5></center>";
                 $item["imagen"] = "<img width='100%' src='".$_ENV["BASE_URL"]."app/libs/artify/uploads/".$item["imagen"]."'>";
            }
        }
        return $data;
    }
}
<?php

namespace App\Models;

use App\core\DB;
use App\core\Security;

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
        $artify->setSettings("totalRecordsInfo", false);
        $artify->setSettings("searchbox", false);
        $artify->setSettings("refresh", false);
        $artify->setSettings("function_filter_and_search", true);
        $artify->addCallback("format_table_data", [$this, "formatearDatosTablaNoticias"]);
        $artify->dbOrderBy("fecha desc");
        $artify->crudTableCol(array("titulo", "fecha","imagen", "contenido"));
        $artify->setSettings("template", $this->table);
        $render = $artify->setQuery(
            $this->table,
            "titulo, fecha, imagen, contenido",
            "id_noticias",
            " ORDER BY fecha ASC"
        )->render();
        return $render;
    }

    private function slugify($string) {
        $string = mb_strtolower($string, 'UTF-8');

        // Reemplazar acentos más comunes manualmente
        $buscar  = ['á','é','í','ó','ú','ñ','ü'];
        $reemplazar = ['a','e','i','o','u','n','u'];
        $string = str_replace($buscar, $reemplazar, $string);

        // Reemplazar espacios por guiones
        $string = str_replace(' ', '-', $string);

        // Eliminar caracteres que no sean letras, números o guiones
        $string = preg_replace('/[^a-z0-9\-]/', '', $string);

        // Eliminar guiones duplicados
        $string = preg_replace('/-+/', '-', $string);

        // Eliminar guiones al inicio o al final
        $string = trim($string, '-');

        return $string;
    }

    public function formatearDatosTablaNoticias($data, $obj){
        if($data){
            $meses = [
                1 => "enero", 2 => "febrero", 3 => "marzo", 4 => "abril",
                5 => "mayo", 6 => "junio", 7 => "julio", 8 => "agosto",
                9 => "septiembre", 10 => "octubre", 11 => "noviembre", 12 => "diciembre"
            ];
            foreach($data as &$item){
                $fechaObj = new \DateTime($item["fecha"]);
                $dia = $fechaObj->format("j");
                $mes = $meses[(int)$fechaObj->format("n")];
                $anio = $fechaObj->format("Y");
                $fechaFormateada = "$dia de $mes de $anio";
                $slug = $this->slugify($item["titulo"]);
                $item["titulo"] = "<center><a href='noticia/".$slug."'><h3><strong>".Security::e(str_replace('-', ' ', $item["titulo"]))."</strong></h3></a></center>";
                $item["fecha"] = "<center><h5><i class='fa fa-calendar'></i> ".$fechaFormateada."</h5></center>";
                $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.Security::e(basename((string)($item["imagen"] ?? ""))).'" data-fancybox="gallery" data-caption="Foto">
                                    <img width="100%" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.Security::e(basename((string)($item["imagen"] ?? ""))).'">
                                   </a>';
                $item["contenido"] = mb_strimwidth(strip_tags(Security::html($item["contenido"], ENT_QUOTES, 'UTF-8')), 0, 250, "...");
                $item["boton"] = "<div class='row' style='margin-top:20px;'><div class='col-md-12 text-center'><a href='noticia/".$slug."' class='btn btn-info btn-block'>Ver más</a></div></div>";
            }
        }
        return $data;
    }
}
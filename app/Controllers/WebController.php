<?php

namespace App\Controllers;

use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;
use App\core\Security;
use App\Models\NoticiasModel;

class WebController
{
    public function index()
    {
        $noticias = new NoticiasModel();
        $render = $noticias->post(1, 2);
        $queryfy = DB::Queryfy();
        $slider = $queryfy->select("slider");
        $stencil = new ArtifyStencil();
        echo $stencil->render('web/home', [
            'render' => $render,
            'slider' => $slider
        ]);
    }

    public function buscar_noticias(){
        $request = new Request();
        if ($request->getMethod() === 'POST') {
            $param = (string) $request->post('buscar_noticias');
            $param = trim(mb_substr($param, 0, 100, 'UTF-8'));
            if ($param === '') {
                echo json_encode(['render' => '']);
                return;
            }
            $settings["includeTemplateCSS"] = false;
            $settings["includeTemplateJS"] = false;
            $artify = DB::ArtifyCrud(false, "pure","pure", $settings);
            $artify->setSettings("addbtn", false);
            $artify->where("titulo", "%$param%", "LIKE", "OR");
            $artify->where("contenido", "%$param%", "LIKE");
            $artify->setPortfolioColumn(1);
            $artify->tableHeading("");
            $artify->recordsPerPage(2);
            $artify->dbOrderBy("fecha desc");
            $artify->setSettings("totalRecordsInfo", false);
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

    public static function configs(){
        $queryfy = DB::Queryfy();
        $queryfy->where("id_configuracion", "1");
        $data = $queryfy->select("configuracion");
        return $data;
    }

    public static function barra_lateral_izquierda(){
        $queryfy = DB::Queryfy();
        $data = $queryfy->executeQuery("SELECT * FROM barra_lateral_izquierda order by ordenar asc");
        return $data ?: [];
    }

    public static function barra_lateral_derecha(){
        $queryfy = DB::Queryfy();
        $data = $queryfy->executeQuery("SELECT * FROM barra_lateral_derecha order by ordenar asc");
        return $data ?: [];
    }

    public static function barra_inferior(){
        $queryfy = DB::Queryfy();
        $data = $queryfy->select("barra_inferior");
        return $data;
    }

    public static function redes_sociales(){
        $queryfy = DB::Queryfy();
        $data = $queryfy->select("redes_sociales");
        return $data;
    }

    public static function menuWeb(){
        $queryfy = DB::Queryfy();
        $data = $queryfy->select("menu_web");
        return $data;
    }

    public static function SubmenuWeb(){
        $queryfy = DB::Queryfy();
        $data = $queryfy->select("submenu_web");
        return $data;
    }

    public static function SubmenuDos(){
        $queryfy = DB::Queryfy();
        $data = $queryfy->select("submenudos_web");
        return $data;
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
                $boton = $_ENV["BASE_URL"]."noticia/".rawurlencode((string) $item["slug"]);
                $slug   = rawurlencode((string) $item["slug"]);
                $imagen = Security::e(basename((string) $item["imagen"]));

                $item["titulo"] = "<center><a href='".$_ENV["BASE_URL"]."noticia/".$slug."'><h3><strong>".Security::e($item["titulo"])."</strong></h3></a></center>";
                $item["fecha"] = "<center><h5><i class='fa fa-calendar'></i> ".Security::e($fechaFormateada)."</h5></center>";
                $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$imagen.'" data-fancybox="gallery" data-caption="Foto">
                                    <img width="100%" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$imagen.'">
                                   </a>';
                $item["contenido"] = mb_strimwidth(strip_tags(html_entity_decode($item["contenido"], ENT_QUOTES, 'UTF-8')), 0, 250, "...");
                $item["boton"] = "<a href='".Security::eUrl($boton)."' class=\"btn btn-info btn-block\">Ver más</a>";
            }
        }
        return $data;
    }

    private function slugify($string) {
        $string = (string) $string;
        $string = mb_strtolower($string, 'UTF-8');
        $buscar  = ['á','é','í','ó','ú','ñ','ü'];
        $reemplazar = ['a','e','i','o','u','n','u'];
        $string = str_replace($buscar, $reemplazar, $string);
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^a-z0-9\-]/', '', $string);
        $string = preg_replace('/-+/', '-', $string);
        $string = trim($string, '-');
        return $string;
    }

    private function resolverTituloExacto($tabla, $titulo){
        $slugBuscado = $this->slugify($titulo);
        if ($slugBuscado === "") {
            return null;
        }
        $queryfy = DB::Queryfy();
        $filas = $queryfy->select($tabla);

        if (is_array($filas)) {
            foreach ($filas as $fila) {
                if (isset($fila["titulo"]) && $this->slugify($fila["titulo"]) === $slugBuscado) {
                    return $fila["titulo"];
                }
            }
        }
        return null;
    }

    public function noticia(Request $request){
        $titulo = $request->get('titulo');
        $fullWidth = str_contains(
            trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'),
            'noticia/full/'
        );
        $tituloExacto = $this->resolverTituloExacto("noticias", $titulo);
        $filtroTitulo = ($tituloExacto !== null) 
            ? $tituloExacto 
            : $this->slugify($titulo);

        $settings["includeTemplateCSS"] = false;
        $settings["includeTemplateJS"] = false;
        $artify = DB::ArtifyCrud(false, "pure","pure", $settings);
        $artify->where("titulo", $filtroTitulo);
        $artify->setPortfolioColumn(1);
        $artify->tableHeading("");
        $artify->setSettings("searchbox", false);
        $artify->setSettings("refresh", false);
        $artify->setSettings("recordsPerPageDropdown", false);
        $artify->setSettings("totalRecordsInfo", false);
        $artify->setSettings("function_filter_and_search", true);
        $artify->crudTableCol(array("titulo", "fecha","imagen", "contenido"));
        $artify->addCallback("format_table_data", [$this, "formatearDatosTablaNoticiaPage"]);
        $artify->setSettings("addbtn", false);
        $artify->setSettings("template", "noticias");
        $data = $artify->dbTable("noticias")->render();
        $stencil = new ArtifyStencil();
        echo $stencil->render('web/noticia', [
            'data' => $data,
            'fullWidth' => $fullWidth
        ]);
    }

    public function formatearDatosTablaNoticiaPage($data, $obj){
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
                $imagen = Security::e(basename((string) $item["imagen"]));
                $item["titulo"] = "<center><h3><strong>".Security::e(str_replace('-', ' ', $item["titulo"]))."</strong></h3></center>";
                $item["fecha"] = "<center><h5><i class='fa fa-calendar'></i> ".Security::e($fechaFormateada)."</h5></center>";
                $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.Security::e(basename((string)($imagen ?? ""))).'" data-fancybox="gallery" data-caption="Foto">
                                    <img width="100%" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.Security::e(basename((string)($imagen ?? ""))).'">
                                   </a>';
                $item["contenido"] = Security::html($item["contenido"]);
            }
        }
        return $data;
    }

    public function page(Request $request)
    {
        $titulo = $request->get("titulo");
        $fullWidth = str_contains(
            trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'),
            'pagina/full/'
        );
        $tituloExacto = $this->resolverTituloExacto("pagina", $titulo);
        $filtroTitulo = ($tituloExacto !== null)
            ? $tituloExacto
            : $this->slugify($titulo);
        $settings["includeTemplateCSS"] = false;
        $settings["includeTemplateJS"] = false;
        $artify = DB::ArtifyCrud(false, "pure", "pure", $settings);
        $artify->where("titulo", $filtroTitulo);
        $artify->setPortfolioColumn(1);
        $artify->tableHeading("");
        $artify->setSettings("searchbox", false);
        $artify->setSettings("refresh", false);
        $artify->setSettings("recordsPerPageDropdown", false);
        $artify->setSettings("totalRecordsInfo", false);
        $artify->setSettings("function_filter_and_search", true);
        $artify->crudTableCol(["titulo", "imagen", "contenido"]);
        $artify->addCallback("format_table_data", [$this, "formatearDatosTablaPage"]);
        $artify->setSettings("addbtn", false);
        $artify->setSettings("template", "pagina");
        $data = $artify->dbTable("pagina")->render();
        $stencil = new ArtifyStencil();
        echo $stencil->render('web/pagina', [
            'data' => $data,
            'fullWidth' => $fullWidth
        ]);
    }

    public function formatearDatosTablaPage($data, $obj)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item["titulo"] = "<center><h3><strong>"
                    . Security::e(str_replace('-', ' ', $item["titulo"]))
                    . "</strong></h3></center>";
                if (!empty($item["imagen"])) {
                    $imagen = Security::e(basename((string) $item["imagen"]));
                    $item["imagen"] = '
                        <a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.Security::e(basename((string)($imagen ?? ""))).'" data-fancybox="gallery" data-caption="Foto">
                            <img width="100%" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.Security::e(basename((string)($imagen ?? ""))).'">
                        </a>';
                } else {
                    $item["imagen"] = "";
                }
                $item["contenido"] = Security::html($item["contenido"]);
            }
        }
        return $data;
    }
}
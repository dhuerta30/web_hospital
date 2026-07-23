<?php

namespace App\Controllers;

use App\core\SessionManager;
use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;

class NoticiasController
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
        $artify = DB::ArtifyCrud();
        $artify->addPlugin("summernote");
        $template = '
        <div class="card">
            <div class="card-header bg-dark">
                Registro Médico
            </div>
            <div class="card-body">
            
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Titulo</label>
                            {titulo}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Fecha</label>
                            {fecha}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Imagen</label>
                            {imagen}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Enviar imagen a slider</label>
                            {enviar_imagen_a_slider}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Contenido</label>
                            {contenido}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Publicado por</label>
                            {publicado_por}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Categoría</label>
                            {categoria}
                            <p class="artify_help_block help-block form-text with-errors"></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>';
        $usuario = $_SESSION["usuario"][0]["nombre"];
        $artify->set_template($template);
        $artify->addPlugin("bootstrap-switch-master");

        $artify->setSettings("actionFilterPosition", "top");

        $artify->addFilter("TituloFiltro", "Filtrar por Fecha", "fecha", "date");
        $artify->setFilterSource("TituloFiltro", "noticias", "fecha", "fecha as pl", "db");

        $artify->formFieldValue("publicado_por", $usuario);
        $artify->fieldDataAttr("publicado_por", array("readonly"=>"true"));
        $artify->colRename("id_noticias", "ID");
        $artify->setSettings("searchbox", true);
        $artify->setSettings("editbtn", true);
        $artify->setSettings("clonebtn", true);
        $artify->setSettings("delbtn", true);
        $artify->setSettings("encryption", true);
        $artify->setSettings("encryption", true);
        $artify->fieldTypes("imagen", "FILE_NEW");
        $artify->dbOrderBy("fecha desc");

        $artify->crudRemoveCol(array("enviar_imagen_a_slider", "slug"));

        $artify->fieldTypes("enviar_imagen_a_slider", "checkbox");
        $artify->fieldDataBinding("enviar_imagen_a_slider", array("1" => ""), "", "", "array");

        $artify->fieldTypes("categoria", "select");
        $artify->fieldDataBinding("categoria", "categorias", "nombre as categorias", "nombre", "db");

        $artify->fieldNotMandatory("enviar_imagen_a_slider");

        $artify->buttonHide("submitBtnSaveBack");
        $artify->tableColFormatting("fecha", "date", array("format" =>"d/m/Y"));
        $artify->setSettings("function_filter_and_search", true);
        $artify->addCallback("before_insert", [$this, "insertar_noticias"]);
        $artify->addCallback("before_update", [$this, "actualizar_noticias"]);
        $artify->fieldCssClass("contenido", array("summernote"));
        $artify->addCallback("format_table_data", [$this, "formatTableDataCallBacknoticias"]);
        $artify->addCallback("before_switch_update", [$this, "switch_noticias"]);
        
        $action = array("1"=>"2","2"=>"1");
        $text = array("1" => "<button class='btn btn-primary'>Si</button>","2"=>"<button class='btn btn-danger'>No</button>");
        $artify->enqueueActions($action, "switch", $text, "enviar_imagen_a_slider", array());

        $action = $_ENV["BASE_URL"]."noticia/{slug}";
        $text = 'Ver';
        $attr = array("title"=>"Ver", "target" => "_blank");
        $artify->enqueueBtnActions("url btn-light", $action, "url", $text, "", $attr);

        $render = $artify->dbTable("noticias")->render();
        $select2 = $artify->loadPluginJsCode("summernote", ".summernote");
        $switch = $artify->loadPluginJsCode("bootstrap-switch-master",".artify-checkbox");

        $galeria = DB::ArtifyCrud(true);
        $galeria->formDisplayInPopup();
        $galeria->colRename("id_galeria", "ID");
        $galeria->fieldTypes("imagen", "file_multi");
        $galeria->setSettings("searchbox", true);
        $galeria->setSettings("editbtn", true);
        $galeria->setSettings("delbtn", true);
        $galeria->buttonHide("submitBtnSaveBack");
        $galeria->addCallback("format_table_data", [$this, "formatTableDataCallBackgaleria"]);
        $galeria->addCallback("before_insert", [$this, "insertar_galeria"]);
        $galeria->addCallback("before_update", [$this, "actualizar_galeria"]);
        $render_galeria = $galeria->dbTable("galeria")->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('noticias', [
            'render' => $render,
            'select2' => $select2,
            'render_galeria' => $render_galeria,
            'switch' => $switch
        ]);
    }

    public function switch_noticias($data, $obj){
        $id = $data["id_noticias"];
        $queryfy = $obj->getQueryfyObj();

        if($data["enviar_imagen_a_slider"] == 1){
            $queryfy->where("id_noticias", $id);
            $result = $queryfy->select("noticias");

            $queryfy->insert("slider", array(
                "titulo" => $result[0]["titulo"],
                "imagen" => $result[0]["imagen"],
                "url" => $_ENV["BASE_URL"]. "app/libs/artify/uploads/" . $result[0]["imagen"],
            ));

            echo "<script>
                Swal.fire({
                    title: 'Genial!',
                    text: 'Imagen Enviada al Slider!',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
			        allowOutsideClick: false
                });
            </script>";

        } else {
            $queryfy->where("id_noticias", $id);
            $result = $queryfy->select("noticias");

            $queryfy->where("imagen", $result[0]["imagen"]);
            $queryfy->delete("slider");

            echo "<script>
                Swal.fire({
                    title: 'Genial!',
                    text: 'Imagen Eliminada del Slider!',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
			        allowOutsideClick: false
                });
            </script>";
        }

        return $data;
    }

    public function insertar_galeria($data, $obj){
        $data["galeria"]["imagen"] = basename($data["galeria"]["imagen"]);
        return $data;
    }

    public function actualizar_galeria($data, $obj){
        $data["galeria"]["imagen"] = basename($data["galeria"]["imagen"]);
        return $data;
    }

    public function formatTableDataCallBacknoticias($data, $obj){
        if($data){
            foreach($data as &$item){
                // Reemplazamos '-' por espacio
                $titulo = str_replace('-', ' ', $item["titulo"]);

                // Reemplazar ñ/Ñ y quitar acentos
                $titulo = strtr($titulo, [
                    'ñ' => 'n', 'Ñ' => 'N',
                    'á' => 'a', 'Á' => 'A',
                    'é' => 'e', 'É' => 'E',
                    'í' => 'i', 'Í' => 'I',
                    'ó' => 'o', 'Ó' => 'O',
                    'ú' => 'u', 'Ú' => 'U',
                    'ü' => 'u', 'Ü' => 'U'
                ]);

                $item["titulo"] = $titulo;

                // Imagen con Fancybox
                $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'" data-fancybox="gallery" data-caption="Foto">
                                        <img width="100" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                </a>';

                // Contenido resumido
                $item["contenido"] = mb_strimwidth(strip_tags(html_entity_decode($item["contenido"], ENT_QUOTES, 'UTF-8')), 0, 50, "...");
            }
        }
        return $data;
    }

    public function formatTableDataCallBackgaleria($data, $obj){
        if($data){
            foreach($data as &$item){
                $item["imagen"] = '<a href="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'" data-fancybox="gallery" data-caption="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                    <img width="150" src="'.$_ENV["BASE_URL"].'app/libs/artify/uploads/'.$item["imagen"].'">
                                   </a>';
            }
        }
        return $data;
    }

    private function slugify($string)
    {
        $string = mb_strtolower($string, 'UTF-8');
        // translitera acentos: ó -> o, ñ -> n, etc.
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        // permite letras, números, espacios Y guiones
        $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
        // espacios -> guion
        $string = preg_replace('/[\s-]+/', '-', $string); // colapsa espacios y guiones juntos
        $string = trim($string, '-');
        return $string;
    }

    public function insertar_noticias($data, $obj){
        $titulo = $data["noticias"]["titulo"];
    
        if(empty($titulo)){
            $error_msg = array("message" => "", "error" => "El campo Título es obligatorio", "redirectionurl" => "");
            die(json_encode($error_msg));
        }
    
        $queryfy = $obj->getQueryfyObj();
        $queryfy->where("titulo", $titulo);
        $result = $queryfy->select("noticias");
    
        if($result){
            $error_msg = array("message" => "", "error" => "Ya existe una noticia con ese título. Ingrese uno diferente.", "redirectionurl" => "");
            die(json_encode($error_msg));
        }
    
        $newData = array();
        $newData["noticias"]["titulo"] = $titulo;
        $newData["noticias"]["slug"] = $this->slugify($titulo);
        $newData["noticias"]["fecha"] = $data["noticias"]["fecha"];
        $newData["noticias"]["imagen"] = basename($data["noticias"]["imagen"]);
        $newData["noticias"]["enviar_imagen_a_slider"] = $data["noticias"]["enviar_imagen_a_slider"] ?? 2;
        $newData["noticias"]["contenido"] = $data["noticias"]["contenido"];
        $newData["noticias"]["publicado_por"] = $data["noticias"]["publicado_por"];
        $newData["noticias"]["categoria"] = $data["noticias"]["categoria"];
    
        if($newData["noticias"]["enviar_imagen_a_slider"] == 1){
            $queryfy->insert("slider", array(
                "titulo" => "imagen".time(),
                "imagen" => $newData["noticias"]["imagen"],
                "url" => $_ENV["BASE_URL"]. "app/libs/artify/uploads/" . $newData["noticias"]["imagen"],
            ));
        }
    
        return $newData;
    }

    public function actualizar_noticias($data, $obj){
        $newData = array();
        $newData["noticias"]["titulo"] = $data["noticias"]["titulo"];
        $newData["noticias"]["slug"] = $this->slugify($data["noticias"]["titulo"]);
        $newData["noticias"]["fecha"] = $data["noticias"]["fecha"];
        $newData["noticias"]["imagen"] = basename($data["noticias"]["imagen"]);
        $newData["noticias"]["enviar_imagen_a_slider"] = $data["noticias"]["enviar_imagen_a_slider"] ?? 2;
        $newData["noticias"]["contenido"] = $data["noticias"]["contenido"];
        $newData["noticias"]["publicado_por"] = $data["noticias"]["publicado_por"];
        $newData["noticias"]["categoria"] = $data["noticias"]["categoria"];

        $queryfy = $obj->getQueryfyObj();

        if($newData["noticias"]["enviar_imagen_a_slider"] == 1){
            $queryfy->insert("slider", array(
                "titulo" => "imagen".time(),
                "imagen" => $newData["noticias"]["imagen"],
                "url" => $_ENV["BASE_URL"]. "app/libs/artify/uploads/" . $newData["noticias"]["imagen"],
            ));
        } else {
            $queryfy->where("imagen", $newData["noticias"]["imagen"]);
            $queryfy->delete("slider");
        }

        return $newData;
    }

    public function carga_masiva_noticias(){
        $artify = DB::ArtifyCrud();
        $artify->addPlugin("select2");
        $artify->fieldRenameLable("archivo", "Archivo Excel");
        $artify->setLangData("save", "Subir");
        $artify->fieldDesc("archivo", "<strong>Suba un Archivo en Formato Excel xlsx</strong>");
        $artify->fieldTypes("modulo", "select");
        $artify->fieldDataBinding("modulo", array("noticias" => "noticias"), "", "", "array");
        $artify->setSettings("required", false);
        $artify->fieldTypes("archivo", "FILE_NEW");
        $artify->addCallback("before_insert", [$this, "carga_masiva"]); // devolución de llamada para antes de insertar los datos
        $artify->fieldGroups("group1", array("archivo", "modulo"));
        $render = $artify->dbTable("carga_masiva")->render("insertform");
        $select2 = $artify->loadPluginJsCode("select2",".modulo");

        $stencil = new ArtifyStencil();
        echo $stencil->render('carga_masiva', [
            'render' => $render,
            'select2' => $select2
        ]);
    }

    public function carga_masiva($data, $obj){
        $archivo = basename($data["carga_masiva"]["archivo"]);
        $modulo = $data["carga_masiva"]["modulo"];
        $extension = pathinfo($archivo, PATHINFO_EXTENSION);

        $queryfy = $obj->getQueryfyObj();
        $columnNames = $queryfy->columnNames($modulo);

        if (empty($archivo)) {
            $error_msg = array("message" => "", "error" => "No se ha subido ningún Archivo", "redirectionurl" => "");
            die(json_encode($error_msg));
        } 

        if (empty($modulo)) {
            $error_msg = array("message" => "", "error" => "No se ha seleccionado ningún Módulo", "redirectionurl" => "");
            die(json_encode($error_msg));
        } 

        if ($extension != "xlsx") {
            $error_msg = array("message" => "", "error" => "El Archivo Subido no es un Archivo Excel Válido", "redirectionurl" => "");
            die(json_encode($error_msg));
        }

        $records = $queryfy->excelToArray("uploads/".$archivo);

        $datosInsertar = [];
        foreach ($records as $Excelval) {
            $fila = [];
            foreach ($columnNames as $columna) {
                if (isset($Excelval[$columna])) {
                    $fila[$columna] = $Excelval[$columna];
                }
            }
            if (!empty($fila)) {
                $datosInsertar[] = $fila;
            }
        }

        if (!empty($datosInsertar)) {
            $queryfy->insertBatch($modulo, $datosInsertar);
        }

        $data["carga_masiva"]["archivo"] = $archivo;
        return $data;
    }
}
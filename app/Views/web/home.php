@include('layouts_web/header')
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="banners">
                    <?php 
                        $env = $_ENV["BASE_URL"];
                        $izquierda = App\Controllers\WebController::barra_lateral_izquierda();
                    ?>
                    <?php foreach($izquierda as $iz): ?>
                        <div class="banner banner-corto">
                            <?php if($iz["tipo_contenido"] == "Imagen"): ?>
                            <a href="<?=$iz["url"]?>">
                                <img src="<?= $env ?>app/libs/artify/uploads/<?=$iz["imagen"]?>"> 
                            </a>
                            <?php else: ?>
                                <?php echo html_entity_decode($iz["video"]); ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div id="main">
                    <div id="breadcrumbs">
                        <ul>
                            <li><a href="<?=$_ENV["BASE_URL"]?>">Inicio</a></li>
                            <li class="sep">/</li>
                            <li> »</li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="post">
                        <div class="post-header">
                            <h4></h4>
                            <h3></h3>
                        </div>
                        <div class="texto">
                            <!--<h3 class="title"></h3>-->
                            <div class="contenido">

                                <!--<div id="wowslider-container1">
                                    <div class="ws_images">
                                        <ul>
                                            <?php //foreach($slider as $item){ ?>
                                                <li><a href="<?//$_ENV["BASE_URL"]?>noticia/<?//str_replace(' ', '-', $item["url"])?>"><img src="<?//$_ENV["BASE_URL"]. "app/libs/artify/uploads/" .$item["imagen"]?>" alt="" title="<?//$item["titulo"]?>" id="wows1_<?//$item["id_slider"]?>"/></a></li>
                                            <?php //} ?>
                                        </ul>
                                    </div>
                                    <div class="ws_shadow"></div>
                                </div>

                                <script type="text/javascript" src='{{ $_ENV["BASE_URL"] }}engine1/wowslider.js'></script>
                                <script type="text/javascript" src='{{ $_ENV["BASE_URL"] }}engine1/script.js'></script>-->

                                <div class="noticias_home">
                                    {!! $render !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna derecha (Sidebar) -->
            <div class="col-md-3">
                <div id="sidebar">
                    <div class="buscar clearfix">
                        <label for="query">Buscar en el sitio</label>
                        <input class="form-control buscar_noticias" id="query" type="text">
                        <button class="btn btn-primary btn-block" type="submit" id="boton"><i class="fa fa-search"></i> Buscar</button>
                    </div>

                     <?php 
                        $env = $_ENV["BASE_URL"];
                        $redes = App\Controllers\WebController::redes_sociales();
                    ?>
                    <div class="redes-lista">
                        <h5 class="titulo-seccion">Síguenos</h5>
                        <ul>
                             <?php foreach($redes as $sociales): ?>
                                <li class="<?=lcfirst($sociales["titulo"])?>">
                                    <a href="<?=$sociales["url"]?>" target="_blank">
                                        <span><i class="<?=$sociales["icono"]?>"></i>  <?=$sociales["subtitulo"]?></span>
                                         
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <?php 
                        $derecha = App\Controllers\WebController::barra_lateral_derecha();
                    ?>
                    <!-- Banners secundarios -->
                   <div class="banners">
                        <?php foreach($derecha as $der): ?>
                            <div class="banner banner-corto">
                                <?php if($der["tipo_contenido"] == "Imagen"): ?>
                                <a href="<?=$der["url"]?>">
                                    <img src="<?= $env ?>app/libs/artify/uploads/<?=$der["imagen"]?>">
                                </a>
                                <?php else: ?>
                                    <?php echo html_entity_decode($der["video"]); ?>
                                <?php endif; ?>
                            </div> 
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="artify-ajax-loader">
    <img width="300" src='{{ $_ENV["BASE_URL"] }}app/libs/artify/images/ajax-loader.gif' class="artify-img-ajax-loader"/>
</div>
@include('layouts_web/footer')
<script>
$(document).on("click", "#boton", function(){
    let buscar_noticias = $(".buscar_noticias").val();
    $.ajax({
        type: "POST",
        url: "<?=$_ENV["BASE_URL"] ?>buscar_noticias",
        data: { buscar_noticias: buscar_noticias },
        dataType: "json",
        beforeSend: function() {
            $("#artify-ajax-loader").show();
        },
        success: function(data){
            $("#artify-ajax-loader").hide();
            $(".noticias_home").html(data["render"]);
        }
    });
});
</script>

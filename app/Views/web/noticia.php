@include('layouts_web/header')
<style>
div#artify_portfolio_0 {
    border: none;
    box-shadow: none;
    background: none;
}

h3 {
    color: #337ab7!important;
}

/* Quita el espacio sobrante al final del contenido (footer de exportación/
   paginación de artify, relleno y márgenes de la tarjeta que no se usan en el front). */
.noticias_home .artify-options-files,
.noticias_home .artify-export-options,
.noticias_home .artify-table-heading { display: none !important; }

.noticias_home .card,
.noticias_home .artifybox,
.noticias_home .card-body { border: none !important; box-shadow: none !important; background: none !important; }

.noticias_home .card-body { padding-bottom: 0 !important; }
.noticias_home .artify-portfolio-row,
.noticias_home .artify-portfolio-col,
.noticias_home .artify-portfolio-col-data { margin-bottom: 0 !important; }
.noticias_home .artify-portfolio-col-data:last-child { padding-bottom: 0 !important; margin-bottom: 0 !important; }
.noticias_home .row:last-child { margin-bottom: 0 !important; }
#main .post { margin-bottom: 0 !important; padding-bottom: 0 !important; }
</style>
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
                            <li><a href="https://saludresponde.minsal.cl">Inicio</a></li>
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
                            <div class="contenido">

                                <div class="noticias_home">
                                    {!! $data['data'] !!}
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

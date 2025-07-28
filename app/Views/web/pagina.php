@include('layouts_web/header')
<div id="content">
    <div class="wrap">
        <div id="main">
            <div id="breadcrumbs">
                <ul>
                    <li><a href="https://saludresponde.minsal.cl">Noticias</a></li>
                    <li class="sep">/</li>
                    <li> »</li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="post">
                <div class="post-header">
                    <!-- Custom field - Título paginas -->
                    <h4></h4>
                    <h3></h3>
                </div>
                <div class="clearfix"></div>
                <div class="texto">
                    <h3 class="title"></h3>
                    <div class="contenido">

                        <!-- contenido Noticias -->
                         <center><h3>{{ $data[0]["titulo"] }}</h3></center>
                         <img class="w-100" src="{{ $_ENV['BASE_URL'] }}app/libs/artify/uploads/{{ $data[0]['imagen'] }}" alt="">

                         <?=html_entity_decode($data[0]["contenido"], ENT_QUOTES, 'UTF-8');?>
                         
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="buscar clearfix">
                <label for="query">Buscar en el sitio</label>
                <input class="form-control buscar_noticias" id="query" type="text">
                <button class="btn btn-primary" type="submit" id="boton"><i class="fa fa-search"></i></button>
            </div>
            <div class="redes-lista">

                <h5 class="titulo-seccion">Síguenos</h5>
                <ul>
                    <li class="youtube">
                        <a class="clearfix" href="https://www.youtube.com/channel/UCml4WfvIJYsFdce0C6UMvzQ">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">YouTube</span>
                                <span class="usuario">Salud Responde </span>
                            </div>
                        </a>
                    </li>
                    <li class="twitter">
                        <a class="clearfix" href="https://twitter.com/Salud_Responde">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Twitter</span>
                                <span class="usuario">Salud_Responde</span>
                            </div>
                        </a>
                    </li>
                    <li class="instagram">
                        <a class="clearfix" href="https://www.instagram.com/saludrespondechile/">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Instagram</span>
                                <span class="usuario">Salud Responde</span>
                            </div>
                        </a>
                    </li>
                    <li class="facebook">
                        <a class="clearfix" href="https://www.facebook.com/SaludRespondeChile">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Facebook</span>
                                <span class="usuario">Salud Responde </span>
                            </div>
                        </a>
                    </li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="banners">
                <div class="banner banner-corto">
                    <a href="https://portalsaluddigital.minsal.cl/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2025/07/banners-320x100-1.png" alt="Portal Salud Digital ">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/atencion-de-salud-en-lengua-de-senas-chilena/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2023/09/banner-lengua-de-senas-01.png" alt="Atención remota vía lengua de señas">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/atencion-de-salud-en-kreyol/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2023/10/banner-kreyol-2-1.png" alt="Atención en Kreyol">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/agendamiento-y-atencion-en-cuidados-paliativos/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2024/08/banner-agendamiento-cuidados-paliativos-Dependencia-Severa-LATERAL.png" alt="">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://seremienlinea.minsal.cl/asdigital/index.php?mfarmacias">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2023/10/Farmacias-2023.png" alt="Farmacias de turno, horario normal y más">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/buscador-de-establecimientos-de-salud/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2023/09/visor-territorial-salud-respondev2.png" alt="búsqueda establecimientos de salud">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/vacunacion-sarampion/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2025/06/banner-lateral_sarampion-2025.png" alt="">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/estrategia-de-vacunacion-escolar-2025/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2025/06/vacunacion-escolar-2025-01.png" alt="">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/vacunate-contra-la-tos-convulsiva-preguntas-frecuentes/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2025/06/banner-vacuna-tos-convulsiva-embarazadas.png" alt="">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://www.remediosmasbaratos.cl/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2024/04/banner-lateral_remedios-mas-baratos-cenabast-1.png" alt="Remedios más baratos ley cenabast">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://portalsaluddigital.minsal.cl/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2023/09/LINEA-PREVENCION-DEL-SUICIDIO-4141.png" alt="Línea de Prevención del Suicidio">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/vacuna-escolar-contra-el-vph/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2024/08/banner-vacuna-nonavalente-lat.png" alt="etiquetado alcoholes">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/autotest-vih/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2023/09/banner-lateral_autotest-vih.png" alt="Autotes VIH">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/ley-ive-y-salud-responde/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2024/03/LEY-IVE.png" alt="Interrupción voluntaria del embarazo">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/universalizacion-de-la-atencion-primaria-de-salud/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2023/09/APS-UNiversal-lateral.png" alt="Universalización de la Atención Primaria">
                    </a>
                </div>
                <div class="banner banner-corto">
                    <a href="https://saludresponde.minsal.cl/viruela-del-mono-monkeypox/">
                        <img src="https://saludresponde.minsal.cl/wp-content/uploads/2024/08/banner-lateral-MPOX.jpg" alt="Portal Paciente">
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div id="artify-ajax-loader">
    <img width="300" src='{{ $_ENV["BASE_URL"] }}app/libs/artify/images/ajax-loader.gif' class="artify-img-ajax-loader"/>
</div>
@include('layouts_web/footer')
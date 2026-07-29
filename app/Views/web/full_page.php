@include('layouts_web/header')
<div id="content">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <div id="main">
                    <div id="breadcrumbs">
                        <ul>
                            <li><a href="/">Inicio</a></li>
                            <li class="sep">/</li>
                            <li>»</li>
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

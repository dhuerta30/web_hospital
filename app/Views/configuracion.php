@include('layouts/header')
@include('layouts/sidebar')
<link href='{{ $_ENV["BASE_URL"] }}css/sweetalert2.min.css' rel="stylesheet">
<div class="content-wrapper">
    <section class="content">
        <div class="card mt-4">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        {!! $render !!}
                        {!! $color !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        {!! $render_barra_lateral_izquierda !!}
                    </div>
                     <div class="col-md-6">
                        {!! $render_barra_lateral_derecha !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {!! $render_barra_inferior !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {!! $render_sociales !!}
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>
<div id="artify-ajax-loader">
    <img width="300" src='{{ $_ENV["BASE_URL"] }}app/libs/artify/images/ajax-loader.gif' class="artify-img-ajax-loader"/>
</div>
@include('layouts/footer')
<script src='{{ $_ENV["BASE_URL"] }}js/sweetalert2.all.min.js'></script>
<script>
function artifyToggleContenido($scope){
    if(!$scope || !$scope.length) return;

    var $tipo = $scope.find(".tipo_contenido select");
    if(!$tipo.length) return;

    var val = $tipo.val();

    var $secImagen = $scope.find(".seccion_imagen");
    var $secVideo  = $scope.find(".seccion_video");
    var $secUrl    = $scope.find(".seccion_url");

    var $inpImagen = $scope.find(".imagen");
    var $inpUrl    = $scope.find(".url");
    var $inpVideo  = $scope.find(".video");

    if (val === "Imagen") {
        $secImagen.removeClass('d-none');
        $secUrl.removeClass('d-none');
        $secVideo.addClass('d-none');

        $inpImagen.attr("required", "required");
        $inpUrl.attr("required", "required");
        $inpVideo.removeAttr("required");
    } else if (val === "Video") {
        $secVideo.removeClass('d-none');
        $secImagen.addClass('d-none');
        $secUrl.addClass('d-none');

        $inpVideo.attr("required", "required");
        $inpImagen.removeAttr("required");
        $inpUrl.removeAttr("required");
    } else {
        $secImagen.addClass('d-none');
        $secUrl.addClass('d-none');
        $secVideo.addClass('d-none');

        $inpImagen.removeAttr("required");
        $inpUrl.removeAttr("required");
        $inpVideo.removeAttr("required");
    }
}

function artifyScopeDe($el){
    var $scope = $el.closest("form");
    if(!$scope.length) $scope = $el.closest(".modal-body");
    if(!$scope.length) $scope = $el.closest(".artify-table-container");
    return $scope;
}

$(document).on("artify_after_ajax_action", function(event, obj, data){
    var dataAction = obj.getAttribute('data-action');

    if(dataAction === "edit" || dataAction === "add"){
        var $container = $(obj).closest(".artify-table-container");
        $container.find(".tipo_contenido select").each(function(){
            artifyToggleContenido(artifyScopeDe($(this)));
        });
    }
});

$(document).on("change", ".tipo_contenido select", function() {
    artifyToggleContenido(artifyScopeDe($(this)));
});

$(document).on("artify_after_submission", function(event, obj, data) {
    let json = JSON.parse(data);

    if (json.message) {
        $(".alert-success").hide();
        $(".alert-danger").hide();
        $.ajax({
            type: "POST",
            url: '{{ $_ENV["BASE_URL"] }}cargar_imagenes_configuracion',
            dataType: "json",
            success: function(data){
                $(".logo_login").attr("src", '{{ $_ENV["URL_ArtifyCrud"] }}' + 'artify/uploads/' + data[0].logo_login);
                $(".logo_panel").attr("src", '{{ $_ENV["URL_ArtifyCrud"] }}' + 'artify/uploads/' + data[0].logo_panel);
                $(".banner_superior").attr("src", '{{ $_ENV["URL_ArtifyCrud"] }}' + 'artify/uploads/' + data[0].banner_superior);
            }
        });

        Swal.fire({
            icon: "success",
            text: json["message"],
            confirmButtonText: "Aceptar",
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                $(".artify-back").click();
            }
        });
    }
});
</script>
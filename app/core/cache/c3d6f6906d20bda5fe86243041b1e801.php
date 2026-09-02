<?php echo (new \App\core\ArtifyStencil())->render('layouts/header', []); ?>
<?php echo (new \App\core\ArtifyStencil())->render('layouts/sidebar', []); ?>
<link href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/sweetalert2.min.css' rel="stylesheet">
<link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/fancybox.css' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/css/jquery.Jcrop.min.css">
<style>
.form-group.note-form-group.note-group-select-from-files {
    display: none;
}
.ui-autocomplete {
    z-index: 9999 !important; /* más alto que el modal */
    background: #fff;          /* fondo blanco */
    border: 1px solid #ccc;    /* borde gris */
    max-height: 200px;         /* alto máximo con scroll */
    overflow-y: auto;          /* scroll si hay muchas opciones */
}
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="card mt-4">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <?php echo $render; ?>
                        <?php echo $select2; ?>
                        <?php echo $switch; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo $render_galeria; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<div id="artify-ajax-loader">
    <img width="300" src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>app/libs/artify/images/ajax-loader.gif' class="artify-img-ajax-loader"/>
</div>
<?php echo (new \App\core\ArtifyStencil())->render('layouts/footer', []); ?>
<script src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>js/sweetalert2.all.min.js'></script>
<script src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>js/fancybox.umd.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/js/jquery.Jcrop.min.js"></script>
<script>
$(document).on("artify_after_submission", function(event, obj, data) {
	let json = JSON.parse(data);

	if (json.message) {
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

jQuery(document).on("artify_after_ajax_action", function(event, obj, data){
    var dataAction = obj.getAttribute('data-action');
    var dataId = obj.getAttribute('data-id');

    if (dataAction === "add" || dataAction === "edit") {
        const selector = "#bm90aWNpYXMjJHRpdHVsb0AzZHNmc2RmKio5OTM0MzI0";
        jQuery(document).off("input.onlyLetters", selector);
        jQuery(document).on("input.onlyLetters", selector, function () {
            this.value = this.value.replace(/[^\p{L}\p{N}\s-]/gu, '');
        });
    }

    if(dataAction == "delete"){
        // tu lógica acá
    }
});

$(document).on("change", "#bm90aWNpYXMjJGltYWdlbkAzZHNmc2RmKio5OTM0MzI0_artify_file_input", function (e) {
    let reader = new FileReader();
    reader.onload = function (e) {
        // Mostrar la imagen subida en un contenedor para recortarla
        $("#preview").html('<img src="'+e.target.result+'" id="cropbox">');

        // Activar JCrop sobre la imagen
        $('#cropbox').Jcrop({
            aspectRatio: 1, // cuadrado, puedes cambiarlo
            setSelect: [0, 0, 200, 200], // selección inicial
            onSelect: updateCoords
        });
    };
    reader.readAsDataURL(this.files[0]);
});

// Guardar las coordenadas en inputs ocultos
function updateCoords(c) {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}
</script>
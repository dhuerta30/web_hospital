<?php include 'C:\xampp7.4\htdocs\web_hospital\app\core/cache/7f48139f6ff92ede64e2db6fe41d9751.php'; ?>
<?php include 'C:\xampp7.4\htdocs\web_hospital\app\core/cache/7064253f90c2a15b84f41183a9699f0e.php'; ?>
<link href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/sweetalert2.min.css' rel="stylesheet">
<div class="content-wrapper">
<section class="content">
    <div class="card mt-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    
                    <div class="card">
                        <div class="card-header bg-dark">
                            Carga Masiva
                        </div>
                        <div class="card-body bg-light">
                             <?php echo $render; ?>
                             <?php echo $select2; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
</div>
<div id="artify-ajax-loader">
    <img width="300" src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>app/libs/artify/images/ajax-loader.gif' class="artify-img-ajax-loader"/>
</div>
<?php include 'C:\xampp7.4\htdocs\web_hospital\app\core/cache/9a6347798d9a9f909b9b68125e9524aa.php'; ?>
<script src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>js/sweetalert2.all.min.js'></script>
<script>
$(document).on("artify_after_ajax_action", function(event, obj, data){
    var dataAction = obj.getAttribute('data-action');
    var dataId = obj.getAttribute('data-id');

    if(dataAction == "add"){
    
    }

    if(dataAction == "edit"){
        
    }
});
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
</script>
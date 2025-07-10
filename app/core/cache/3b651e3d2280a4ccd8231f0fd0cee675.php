<?php include 'C:\xampp7429\htdocs\web_hospital\app\core/cache/b7be7644efb1c3f9722aaa837a568462.php'; ?>
<?php include 'C:\xampp7429\htdocs\web_hospital\app\core/cache/beb653e3f2073649f534e6f27530b190.php'; ?>
<link href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/sweetalert2.min.css' rel="stylesheet">
<div class="content-wrapper">
    <section class="content">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <?php echo $render; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<div id="artify-ajax-loader">
    <img width="300" src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>app/libs/artify/images/ajax-loader.gif' class="artify-img-ajax-loader"/>
</div>
<script src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>js/sweetalert2.all.min.js'></script>
<script>
    $(document).ready(function() {
    $(document).on('click', '.export', function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "<?=$_ENV["BASE_URL"]?>export_db",
        dataType: "json",
        beforeSend: function() {
            $("#artify-ajax-loader").show();
        },
        success: function(data) {
          $("#artify-ajax-loader").hide();
          $('#artify_search_btn').click();
            Swal.fire({
                title: "Genial!",
                text: data['success'],
                icon: "success",
                confirmButtonText: "Aceptar"
            });
        },
        error: function() {
            Swal.fire({
                title: "Lo siento!",
                text: 'Error al Exportar',
                icon: "error",
                confirmButtonText: "Aceptar"
            });
        }
      });
    });
  });

  $(document).on("click", ".artify-filter-option-remove, .artify-filter-option", function() {
    $(".artify-filter").val('');
  });

  $(document).on("keyup", "#artify_search_box", function(event) {
    let busqueda = $("#artify_search_box").val();

    if (busqueda == "") {
      $('#artify_search_btn').click();
    }
    
  });
</script>
<?php include 'C:\xampp7429\htdocs\web_hospital\app\core/cache/407f8db365a930f83c5db62aa662d6ec.php'; ?>
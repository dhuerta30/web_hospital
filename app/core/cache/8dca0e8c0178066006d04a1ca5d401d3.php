<?php echo (new \App\core\ArtifyStencil())->render('layouts/header', []); ?>
<?php echo (new \App\core\ArtifyStencil())->render('layouts/sidebar', []); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="card mt-4">
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
<?php echo (new \App\core\ArtifyStencil())->render('layouts/footer', []); ?>
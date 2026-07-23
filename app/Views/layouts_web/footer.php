<footer>
    <div class="wrap">
        <!-- Banda bicolor superior -->
        <div class="bicolor">
            <span class="azul"></span>
            <span class="rojo"></span>
        </div>

        <div class="top">
            <div class="listas">
                <!-- Aquí podrías agregar listas de enlaces u otra información -->

                <div id="sidebar_bottom" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 14px;">
                    <?php 
                        $env = $_ENV["BASE_URL"];
                        $inferior = App\Controllers\WebController::barra_inferior();
                    ?>

                    <?php foreach($inferior as $infer): ?>
                    <div class="sidebar-wrap widget_media_image">
                        <a href="<?=\App\core\Security::e($infer["url"])?>" target="_blank">
                            <img src="<?= $env ?>app/libs/artify/uploads/<?= \App\core\Security::e(basename((string) ($infer["imagen"] ?? ''))) ?>" style="width: 100%; height: auto;">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>


            </div>

            <div class="clearfix"></div>
        </div>

        <div class="bottom">
            <div class="left">
                <span>Avenida Vicuña Mackenna 1268</span><br>
                <span>Mesa central: 228924005/228924006</span>
            </div>
            <nav>
                <!-- Navegación del pie de página si es necesario -->
            </nav>
            <div class="clearfix"></div>

            <!-- Banda bicolor inferior -->
            <div class="bicolor">
                <span class="azul"></span>
                <span class="rojo"></span>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts agrupados y ordenados -->
<script src='{{ $_ENV["BASE_URL"] }}js/bootstrap.js'></script>
<script src='{{ $_ENV["BASE_URL"] }}js/main.js'></script>
<script src='{{ $_ENV["BASE_URL"] }}js/fancybox.umd.js'></script>
</body>
</html>

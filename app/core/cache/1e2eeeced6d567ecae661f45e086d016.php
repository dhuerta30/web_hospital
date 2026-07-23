<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hospital San José de Melipilla</title>

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="https://saludresponde.minsal.cl/wp-content/themes/gobcl-wp-master2/img/gob_favicon.ico" type="image/x-icon" />

    <!-- Meta Open Graph -->
    <meta property="og:title" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://saludresponde.minsal.cl/" />
    <meta property="og:image" content="https://saludresponde.minsal.cl/wp-content/uploads/2020/01/banner-plan-de-accion-coronavirus_660x220-150x150.png" />
    <meta property="og:site_name" content="Salud Responde">
    <meta property="og:description" content="&nbsp;">

    <!-- Styles -->
    <link rel="stylesheet" href="<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/main.css">
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/font-awesome.min.css'>
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/bootstrap-front.css'>
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/animate.css'>
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/icon-picker.css'>
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/glyphicon.css'>
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/dashicons.css'>
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/jquery.mCustomScrollbar.css'>
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/swpm.common.css'>
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/style.min.css'>
    <link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/default.min.css'>
	<link rel="stylesheet" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/fancybox.css' />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>css/style.css' />
	<!--<script type="text/javascript" src="engine1/jquery.js"></script>-->

    <!-- Scripts -->
    <script src='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>js/jquery.min.js'></script>
    <script src='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>js/jquery.mCustomScrollbar.concat.min.js'></script>
    <script src='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>js/frontend.js'></script>

    <!-- Extra Scripts -->	
	<script type="text/javascript" src='<?= \App\core\Security::e($_ENV['BASE_URL']) ?>js/jquery-ui.js'></script>
	

    <!-- Inline Styles for Compatibility -->
    <style>
        img.wp-smiley, img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
		h3.card-title {
    		display: none;
		}
		body {
			background-color: #e6e6e6!important;
		}

		i.fa-brands.fa-youtube, i.fa-brands.fa-x-twitter, i.fa.fa-instagram, i.fa.fa-facebook {
    		font-size: 30px;
			position: relative;
			top: 5px;
		}
    </style>

    <!-- Custom UI Styling -->
    <style>
        /* Simplified version of accessibility and password protection styles */
        #pojo-a11y-toolbar .pojo-a11y-toolbar-toggle a {
            background-color: #4054b2;
            color: #ffffff;
        }
        body.pojo-a11y-focusable a:focus {
            outline: 1px solid #FF0000 !important;
        }
        @media (max-width: 767px) {
            #pojo-a11y-toolbar { 
				top: 50px !important; 
			}
        }
    </style>

	<style>
	/* Estilo básico de menú */
	#menu-principal ul {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	#menu-principal li {
		position: relative;
	}

	#menu-principal > ul > li {
		display: inline-block;
		margin-right: 20px;
	}

	/* Submenús ocultos por defecto */
	.sub-menu {
		display: none;
		position: absolute;
		top: 100%;
		left: 0;
		background-color: white;
		border: 1px solid #ccc;
		min-width: 200px;
		z-index: 1000;
	}

	/* Mostrar submenú al hacer hover */
	.menu-item-has-children:hover > .sub-menu {
		display: block;
	}

	/* Sub-submenús posicionados a la derecha */
	.sub-menu .menu-item-has-children:hover > .sub-menu {
		left: 100%;
		top: 0;
	}

	.sub-menu .menu-item-has-children > .sub-menu {
		display: none;
	}
</style>

</head>
<body class="home page-template-default page page-id-49">
<?php
/*
 * Menú público — INF-CIBER-2026-10, hallazgo 4.1
 *
 * Los enlaces del menú provienen de las tablas menu_web / submenu_web /
 * submenudos_web. Uno de ellos apuntaba a http://10.63.247.125/intranet/,
 * publicando una IP de la red interna en el HTML de cara a Internet.
 *
 * Security::href() escapa el valor Y bloquea cualquier URL que apunte a un
 * rango privado (RFC 1918), a loopback o a un dominio interno (.local, .lan,
 * .intranet). Así el sitio deja de filtrar topología aunque el registro siga
 * mal en la base de datos; el intento queda anotado en el log de seguridad.
 *
 * IMPORTANTE: esto es una contención. La corrección de fondo es actualizar el
 * registro en la base de datos (ver sql/correccion_intranet.sql) y publicar la
 * intranet tras un nombre DNS con HTTPS, o sólo por VPN.
 */
$env         = $_ENV["BASE_URL"];
$configs     = App\Controllers\WebController::configs() ?: [];
$menuweb     = App\Controllers\WebController::menuWeb() ?: [];
$submenuweb  = App\Controllers\WebController::SubmenuWeb() ?: [];
$submenudos  = App\Controllers\WebController::SubmenuDos() ?: [];

// Agrupar submenús por id_menu_web
$submenusAgrupados = [];
foreach ($submenuweb as $submenu) {
    $submenusAgrupados[$submenu["id_menu_web"]][] = $submenu;
}

// ✅ Agrupar sub-submenús por id_submenu_web (no por su propio ID)
$subsubmenusAgrupados = [];
foreach ($submenudos as $subsubmenu) {
    if (isset($subsubmenu["id_submenu_web"])) {
        $subsubmenusAgrupados[$subsubmenu["id_submenu_web"]][] = $subsubmenu;
    }
}
?>
<div id="menu-movil">
    <div class="wrap">
        <nav id="menu-principal">
            <ul id="menu-main-menu" class="menu-main">
				<?php foreach ($menuweb as $menu): ?>
					<?php
						$menuId = $menu["id_menu_web"];
						// Omitir si no es visible
						if (strtolower($menu["visibilidad"] ?? '') === 'oculto') continue;

						$submenus = $submenusAgrupados[$menuId] ?? [];
						$hasChildren = !empty($submenus);
					?>
					<li class="menu-item <?= $hasChildren ? 'menu-item-has-children' : '' ?> menu-item-<?= \App\core\Security::e($menuId) ?>">
						<a href="<?= \App\core\Security::href($menu["url"] ?? '#') ?>">
							<?= \App\core\Security::e($menu["nombre"] ?? 'Sin nombre') ?>
						</a>

						<?php if ($hasChildren): ?>
							<ul class="sub-menu">
								<?php foreach ($submenus as $submenu): ?>
									<?php
										if (strtolower($submenu["visibilidad_submenu"] ?? '') === 'oculto') continue;

										$submenuId = $submenu["id_submenu_web"] ?? null;
										$subsubmenus = $submenuId && isset($subsubmenusAgrupados[$submenuId])
											? $subsubmenusAgrupados[$submenuId]
											: [];

										$hasSubsub = !empty($subsubmenus);
									?>
									<li class="menu-item <?= $hasSubsub ? 'menu-item-has-children' : '' ?> menu-item-<?= \App\core\Security::e($submenuId) ?>">
										<a href="<?= \App\core\Security::href($submenu["url_submenu"] ?? '#') ?>">
											<?= \App\core\Security::e($submenu["nombre_submenu"] ?? 'Sin nombre') ?>
										</a>

										<?php if ($hasSubsub): ?>
											<ul class="sub-menu">
												<?php foreach ($subsubmenus as $subsubmenu): ?>
													<?php if (strtolower($subsubmenu["visibilidad_submenudos"] ?? '') === 'oculto') continue; ?>
													<li class="menu-item menu-item-<?= $subsubmenu["id_submenudos_web"] ?? 'no-id' ?>">
														<a href="<?= \App\core\Security::href($subsubmenu["url_submenudos"] ?? '#') ?>">
															<?= \App\core\Security::e($subsubmenu["nombre_submenudos"] ?? 'Sin nombre') ?>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
        </nav>
    </div>
</div>

<header style="background-image: url('<?= \App\core\Security::e($env) ?>app/libs/artify/uploads/<?= \App\core\Security::e(basename((string) ($configs[0]["banner_superior"] ?? ''))) ?>');">
<div class="wrap">
	<nav id="menu-principal">
		<ul id="menu-main-menu" class="menu-main">
			<?php foreach ($menuweb as $menu): ?>
				<?php
					$menuId = $menu["id_menu_web"];
					if (strtolower($menu["visibilidad"] ?? '') === 'oculto') continue;

					$submenus = $submenusAgrupados[$menuId] ?? [];
					$hasChildren = !empty($submenus);
				?>
				<li class="menu-item <?= $hasChildren ? 'menu-item-has-children' : '' ?> menu-item-<?= \App\core\Security::e($menuId) ?>">
					<a href="<?= \App\core\Security::href($menu["url"] ?? '#') ?>">
						<?= \App\core\Security::e($menu["nombre"] ?? 'Sin nombre') ?>
					</a>

					<?php if ($hasChildren): ?>
						<ul class="sub-menu">
							<?php foreach ($submenus as $submenu): ?>
								<?php
									if (strtolower($submenu["visibilidad_submenu"] ?? '') === 'oculto') continue;

									$submenuId = $submenu["id_submenu_web"] ?? null;
									$subsubmenus = $submenuId && isset($subsubmenusAgrupados[$submenuId])
										? $subsubmenusAgrupados[$submenuId]
										: [];

									$hasSubsub = !empty($subsubmenus);
								?>
								<li class="menu-item <?= $hasSubsub ? 'menu-item-has-children' : '' ?> menu-item-<?= \App\core\Security::e($submenuId) ?>">
									<a href="<?= \App\core\Security::href($submenu["url_submenu"] ?? '#') ?>">
										<?= \App\core\Security::e($submenu["nombre_submenu"] ?? 'Sin nombre') ?>
									</a>

									<?php if ($hasSubsub): ?>
										<ul class="sub-menu">
											<?php foreach ($subsubmenus as $subsubmenu): ?>
												<?php if (strtolower($subsubmenu["visibilidad_submenudos"] ?? '') === 'oculto') continue; ?>
												<li class="menu-item menu-item-<?= $subsubmenu["id_submenudos_web"] ?? 'no-id' ?>">
													<a href="<?= \App\core\Security::href($subsubmenu["url_submenudos"] ?? '#') ?>">
														<?= \App\core\Security::e($subsubmenu["nombre_submenudos"] ?? 'Sin nombre') ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<a href="#" id="menu-movil-trigger">Menú Principal</a>
</div>
</header>
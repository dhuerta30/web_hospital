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
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/main.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/font-awesome.min.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/bootstrap-front.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/animate.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/icon-picker.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/glyphicon.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/dashicons.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/jquery.mCustomScrollbar.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/swpm.common.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/style.min.css'>
    <link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/default.min.css'>
	<link rel="stylesheet" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/fancybox.css' />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>css/style.css' />
	<!--<script type="text/javascript" src="engine1/jquery.js"></script>-->

    <!-- Scripts -->
    <script src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>js/jquery.min.js'></script>
    <script src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>js/jquery.mCustomScrollbar.concat.min.js'></script>
    <script src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>js/frontend.js'></script>

    <!-- Extra Scripts -->	
	<script type="text/javascript" src='<?php echo htmlspecialchars($_ENV["BASE_URL"], ENT_QUOTES, 'UTF-8'); ?>js/jquery-ui.js'></script>
	

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
$env = $_ENV["BASE_URL"];
$configs = App\Controllers\WebController::configs();
$menuweb = App\Controllers\WebController::menuWeb();
$submenuweb = App\Controllers\WebController::SubmenuWeb();
$submenudos = App\Controllers\WebController::SubmenuDos();

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
					<li class="menu-item <?= $hasChildren ? 'menu-item-has-children' : '' ?> menu-item-<?= $menuId ?>">
						<a href="<?= htmlspecialchars($menu["url"] ?? '#') ?>">
							<?= htmlspecialchars($menu["nombre"] ?? 'Sin nombre') ?>
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
									<li class="menu-item <?= $hasSubsub ? 'menu-item-has-children' : '' ?> menu-item-<?= $submenuId ?>">
										<a href="<?= htmlspecialchars($submenu["url_submenu"] ?? '#') ?>">
											<?= htmlspecialchars($submenu["nombre_submenu"] ?? 'Sin nombre') ?>
										</a>

										<?php if ($hasSubsub): ?>
											<ul class="sub-menu">
												<?php foreach ($subsubmenus as $subsubmenu): ?>
													<?php if (strtolower($subsubmenu["visibilidad_submenudos"] ?? '') === 'oculto') continue; ?>
													<li class="menu-item menu-item-<?= $subsubmenu["id_submenudos_web"] ?? 'no-id' ?>">
														<a href="<?= htmlspecialchars($subsubmenu["url_submenudos"] ?? '#') ?>">
															<?= htmlspecialchars($subsubmenu["nombre_submenudos"] ?? 'Sin nombre') ?>
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

<header style="background-image: url('<?= $env ?>app/libs/artify/uploads/<?=$configs[0]["banner_superior"]?>');">
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
				<li class="menu-item <?= $hasChildren ? 'menu-item-has-children' : '' ?> menu-item-<?= $menuId ?>">
					<a href="<?= htmlspecialchars($menu["url"] ?? '#') ?>">
						<?= htmlspecialchars($menu["nombre"] ?? 'Sin nombre') ?>
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
								<li class="menu-item <?= $hasSubsub ? 'menu-item-has-children' : '' ?> menu-item-<?= $submenuId ?>">
									<a href="<?= htmlspecialchars($submenu["url_submenu"] ?? '#') ?>">
										<?= htmlspecialchars($submenu["nombre_submenu"] ?? 'Sin nombre') ?>
									</a>

									<?php if ($hasSubsub): ?>
										<ul class="sub-menu">
											<?php foreach ($subsubmenus as $subsubmenu): ?>
												<?php if (strtolower($subsubmenu["visibilidad_submenudos"] ?? '') === 'oculto') continue; ?>
												<li class="menu-item menu-item-<?= $subsubmenu["id_submenudos_web"] ?? 'no-id' ?>">
													<a href="<?= htmlspecialchars($subsubmenu["url_submenudos"] ?? '#') ?>">
														<?= htmlspecialchars($subsubmenu["nombre_submenudos"] ?? 'Sin nombre') ?>
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
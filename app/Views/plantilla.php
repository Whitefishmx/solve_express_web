<!DOCTYPE html>
<html lang="es">
<?php
	$menuItems = [
		'login'  => [
			'signin' => [ 'Iniciar sesión', base_url ( 'signin' ) ],
		],
		'logout' => [
			'signout' => [ 'Cerrar sesión', base_url ( 'signout' ) ],
			/**'forgot' => [ 'Recuperar contraseña', base_url ( 'forgot' ) ],**/
		],
	];
	$session = $session ?? 0;
	$menuSelected = $menuItems[ intval ( $session ) === 0 ? 'login' : 'logout' ];
	$menu = array_reduce ( $menuSelected, function ( $carry, $item ) {
		return $carry."<li><a href='$item[1]'>$item[0]</a></li>";
	}, '' );
	$title = isset( $title ) ? ' | '.$title : '';
?>

<?php
	$iniciales = $iniciales ?? "JH";
	$name = $name ?? "James Hook";
	$company = $company ?? "WhiteFish";
?>

<head>
	<link rel="manifest" href="/./manifest.json">
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/CompanyExpress.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/_tables.scss" rel="stylesheet" type="text/css" />

	<link type="text/css" rel="stylesheet" href="/./assets/css/sExpress.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>SOLVE<?= $title ?></title>
</head>
<body class="" onload="GetDashboard()">
<script type="text/javascript" src="/./assets/js/jquery-3.7.1.js"></script>
<script type="text/javascript" src="/./assets/js/jquery-3.7.1.min.js"></script>

<script>
	if ("serviceWorker" in navigator) {
		navigator.serviceWorker.register("/assets/js/sw.js").then(function (registration) {
			console.log("Service Worker registrado con alcance:", registration.scope);
		}).catch(function (error) {
			console.log("Registro del Service Worker fallido:", error);
		});
	}
</script>

<div class="topbar d-print-none" style="background-color: white">
	<div class="container-xxl">
		<nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
			<ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0" style="margin-left: 2rem;">
				<li>
					<a class="navbar-brand" href="#">
						<!--<img src="assets/img/arbol-de-navidad.png" height="50" class="me-2" style="margin-right:0 !important;">-->
						<img src="assets/img/logo.png" width="135" alt="" class="me-2">
					</a>
				</li>
				<li class="mx-3 welcome-text">
				</li>
			</ul>
			<ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
				<!--<li class="topbar-item">
					<a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
						<i class="icofont-sun dark-mode"></i>
						<i class="icofont-moon light-mode"></i>
					</a>
				</li>
				<li class="dropdown topbar-item">
					<a
							class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
							aria-haspopup="false" aria-expanded="false">
						<i class="icofont-bell-alt"></i>
						<span class="alert-badge"></span>
					</a>
					<div class="dropdown-menu stop dropdown-menu-end dropdown-lg py-0">
						<h5 class="dropdown-item-text m-0 py-3 d-flex justify-content-between align-items-center">
							Notifications <a href="#" class="badge text-body-tertiary badge-pill">
								<i class="iconoir-plus-circle fs-4"></i>
							</a>
						</h5>
						
						<a href="pages-notifications.php" class="dropdown-item text-center text-dark fs-13 py-2">
							View All <i class="fi-arrow-right"></i>
						</a>
					</div>
				</li> -->
				<li class="dropdown topbar-item">
					<a
							class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
							aria-haspopup="false" aria-expanded="false">
						<span
								class="thumb-lg justify-content-center d-flex align-items-center bg-purple-subtle text-purple rounded-circle
						me-2 iniciales"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-end py-0">
						<div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
							<div class="flex-shrink-0">
								<span
										class="thumb-lg justify-content-center d-flex align-items-center bg-purple-subtle text-purple rounded-circle
						me-2 iniciales"></span>
							</div>
							<div class="flex-grow-1 ms-2 text-truncate align-self-center">
								<h6 class="my-0 fw-medium text-dark fs-13" id="nombreuser"></h6>
								<small class="text-muted mb-0" id="company"></small>
							</div><!--end media-body-->
						</div>
						<div class="dropdown-divider mt-0"></div>
						<small class="text-muted px-2 pb-1 d-block">Cuenta</small>
						<a class="dropdown-item" href="pages-profile.php"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Cuenta</a>
						<div class="dropdown-divider mb-0"></div>
						<a class="dropdown-item text-danger" href="/signout"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Salir</a>
					</div>
				</li>
			</ul>
		</nav>
	</div>
</div>
<!--<header>
	<nav
			class="nav-extended center"
			style="background-color: var(--background-color); border-bottom: var(--main-color) solid 15px; height:90px">
		<div class="nav-wrapper" style="height: 100%">
			<div class="left row hide-on-med-and-down valign-wrapper" style="margin-right: 15px">
				<div class="col">
					<div class="div-nav-text"><a class="waves-effect waves-light btn" id="theme-toggle"><i
									class="material-icons
					left">cloud</i>button</a></div>
				</div>
			</div>
			<div style="flex: 1; display: flex; justify-content: center;">
				<a
						href="<?= base_url (); ?>" class="brand-logo valign-wrapper" style="display: flex; align-items:
				center; height: 100%">
					<img src="/./assets/img/logo.png" style="height: 45px; max-height: 50px; margin: 5px 0;" alt="">
				</a>
			</div>
			<a
					href="<?= base_url (); ?>" data-target="mobile-demo" class="sidenav-trigger"
					style="color: var(--main-color)"><i
						class="material-icons">menu</i></a>
			<div class="right row hide-on-med-and-down valign-wrapper" style="margin-right: 15px">
				<div class="col">
					<div class="div-nav-text">Empresa S.A. de C.V.</div>
					<div class="div-nav-text">Uriel Magallón</div>
					<div class="div-nav-text">Cerrar Sesión</div>
				</div>
				<div class="col valign-wrapper">
					<a class="valign-wrapper" href="/profile">
						<img class="nav-user" src="/./assets/img/logo.png" alt="imagen de perfil">
					</a>
				</div>
			</div>
		</div>
	</nav>
	
	<!--	<ul class="sidenav" id="mobile-demo">-->
	<!--		<li class="collection-item avatar">-->
	<!--			<img src="images/yuna.jpg" alt="" class="circle">-->
	<!--			<span class="title">Title</span>-->
	<!--			<p>First Line <br>-->
	<!--			   Second Line-->
	<!--			</p>-->
	<!--			<a href="#!" class="secondary-content"><i class="material-icons">-->
	<!--		</li>-->
	<!--	</ul>-->
<!--</header>-->
<style>
    html {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100%;
        margin: 0;
    }

    main {
        flex: 1;
    }

    footer {
        background-color: #01579b; /* Cambia el color según tus necesidades */
        color: white;
        padding: 1em 0;
    }

    .input-field input:focus {
        border-bottom: 1px solid #19298a !important;
        box-shadow: 0 1px 0 0 #000000;
    }

    .input-field input:focus + label {
        color: #19298a !important;
    }

    .input-field input.valid {
        border-bottom: 1px solid #19298A !important;
        box-shadow: 0 1px 0 0 #000000;
    }

    #Loader {
        display: none;
        position: absolute;
        background-color: rgba(255, 255, 255, .2);
        background-image: url('/assets/img/loader.gif') !important;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 10%;
        top: 0;
        z-index: 999;
        transition: opacity 5s ease, visibility 5s ease;
    }
</style>
<div id="Loader"></div>
<div class="page-wrapper">
	<div class="page-content" style="width: 100%; margin-left: 0">
		<div class="container-xxl" style="margin-top: 15px;" id="mainContainer">
			<?= $main ?? '' ?>
		</div>
	</div>
</div>
<footer class="page-footer " style="background-color: var(--main-color)">
	<div class="row" style="margin: 15px 80px 15px 80px;">
		<div class="col s3">
			<div><h5>Ligas útiles</h5></div>
			<div><a href="/" class="linkFooter">Inicio</a></div>
			<div><a href="/" class="linkFooter">Aviso de privacidad</a></div>
			<div><a href="/" class="linkFooter">Términos y condiciones</a></div>
		</div>
		<div class="col s7">
			<div><h5>Contacto</h5></div>
			<div><a class="linkFooter" href="tel:+52515520475">55-1552-0475</a></div>
			<div><a class="linkFooter" href="mailto:contacto@solvegcm.mx">contacto@solvegcm.mx</a></div>
			<div>Calle Guillermo González Camarena 1600, Piso 2 int B. Santa Fe, Zedec Sta Fé, Álvaro Obregón, cp
			     01376 Ciudad de México, CDMX
			</div>
		</div>
		<div class="col s2" style="text-align: center">
			<img src="/./assets/img/logo_condusef-01-1920w.webp" alt="condusef" style="height: 78px">
			<img src="/./assets/img/Buro-1920w.webp" alt="buro" style="height: 105px">
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2024 Copyright Solve GCM
		</div>
	</div>
</footer>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/datatable.init.js"></script>
<script type="text/javascript" src="/./assets/js/employee.js"></script>
</body>
</html>
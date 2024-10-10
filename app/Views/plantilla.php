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
<head>
	<link rel="manifest" href="/./manifest.json">
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="/./assets/css/materialize.css" />
	<link type="text/css" rel="stylesheet" href="/./assets/css/materialize.min.css" />
	<link type="text/css" rel="stylesheet" href="/./assets/css/sExpress.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>SOLVE<?= $title ?></title>
</head>
<body class="">
<script type="text/javascript" src="/./assets/js/jquery-3.7.1.js"></script>
<script type="text/javascript" src="/./assets/js/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="/./assets/js/materialize.js"></script>
<script type="text/javascript" src="/./assets/js/materialize.min.js"></script>
<script>
	if ("serviceWorker" in navigator) {
		navigator.serviceWorker.register("/assets/js/sw.js").then(function (registration) {
			console.log("Service Worker registrado con alcance:", registration.scope);
		}).catch(function (error) {
			console.log("Registro del Service Worker fallido:", error);
		});
	}
</script>
<header>
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
					<img src="/./assets/img/logo.png" style="height: 45px; max-height: 50px; margin: 5px 0;">
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
</header>
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
<main class="" style="padding: 20px 0 20px 0;">
	<?= $main ?? '' ?>
</main>
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
</body>
</html>
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
	$title = isset($title) ? ' | '.$title : '';
?>
<head>
	<link rel="manifest" href="manifest.json">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link
			rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css"
			integrity="sha512-t38vG/f94E72wz6pCsuuhcOPJlHKwPy+PY+n1+tJFzdte3hsIgYE7iEpgg/StngunGszVMrRfvwZinrza0vMTA=="
			crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link
			rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
			integrity="sha512-UJfAaOlIRtdR+0P6C3KUoTDAxVTuy3lnSXLyLKlHYJlcSU8Juge/mjeaxDNMlw9LgeIotgz5FP8eUQPhX1q10A=="
			crossorigin="anonymous" referrerpolicy="no-referrer" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>SOLVE<?= $title ?></title>
</head>
<body class="blue-grey darken-4">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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
	<div class="navbar-fixed indigo darken-4">
		<nav>
			<div class="nav-wrapper indigo darken-4">
				<a href="<?= base_url (); ?>" class="brand-logo">Solve<?= $title ?></a>
				<a href="<?= base_url (); ?>" data-target="mobile-demo" class="sidenav-trigger"><i
							class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<?= $menu ?>
				</ul>
			</div>
		</nav>
	</div>
	<ul class="sidenav" id="mobile-demo">
		<?= $menu ?>
	</ul>
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
<main class="blue lighten-5" style="padding: 20px 0 20px 0;">
	<?= $main ?? '' ?>
</main>
<footer class="page-footer indigo darken-4">
	<div class="container">
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2024 Copyright Solve GCM
		</div>
	</div>
</footer>
</body>
</html>
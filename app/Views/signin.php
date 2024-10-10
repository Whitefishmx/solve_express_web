<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="manifest" href="/./manifest.json">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="/./assets/css/materialize.css" />
	<link type="text/css" rel="stylesheet" href="/./assets/css/materialize.min.css" />
	<link type="text/css" rel="stylesheet" href="/./assets/css/sExpress.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>SOLVE Login</title>
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

    .container {
        margin: 0 auto !important;
    }
</style>
<div id="Loader"></div>
<main class="" style="padding: 20px 0 20px 0;">
	<div class="container center" style="margin: auto; width: 75vw">
		<div class="row" style="margin-bottom: 0 !important;">
			<img class="left-align left" src="/./assets/img/logo.png" alt="logo" style="height: 80px">
		</div>
		<div class="row">
			<div
					class="col s6 hide-on-small-only"
					style="background-color: var(--main-color); border-radius: 25px; color: var(--title-color)">
				<h4 style="font-weight: bold">¡Tu nomina al instante!</h4>
				<h5>Sin deudas y sin intereses</h5>
				<img
						src="/./assets/img/women1.png" alt="ok" style="width: 24vw; display: block; position: relative;
				margin: auto">
			</div>
			<div class="col s6" style="padding: 5rem;min-width: 50%; width: auto">
				<h4>Inicio de sesión</h4>
				<form id="signinForm" name="signinForm" method="POST">
					<div class="row">
						<div class="input-field inline col s12">
							<i class="material-icons prefix">account_circle</i>
							<input id="account" name="account" type="text" class="validate" required>
							<label for="account">RFC *</label>
							<span class="helper-text" data-error="formato erróneo"></span>
						</div>
					</div>
					<div class="row">
						<div class="input-field inline col s12">
							<i class="material-icons prefix">lock</i>
							<input
									id="password" name="password" type="password" class="validate" data-length="256"
									minlength="8" required>
							<label for="password">Contraseña</label>
							<span
									class="helper-text"
									data-error="longitud minima de 8 caracteres (mayúsculas, minúsculas, números)"></span>
						</div>
					</div>
					<div class="d-grid">
						<button id="btnSend" name="btnSend" type="submit" class="btn" style="width:
						80%; color: var(--title-color) !important;font-weight: bold; border-radius: 15px;
						font-size: 1.4rem; height: 8vh">Iniciar sesión
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>
<script>
	$(document).ready(function () {
		let toastHTML;
		const formSignIn = $("#signinForm");
		formSignIn.on("submit", function (e) {
			e.preventDefault();
			const formData = {};
			$(this).serializeArray().forEach(function (item) {
				formData[item.name] = item.value;
			});
			const jsonData = JSON.stringify(formData);
			$.ajax({
				url: "/toSignIn",
				dataType: "json",
				data: jsonData,
				processData: false,
				contentType: false,
				method: "POST",
				beforeSend: function () {
					const obj = $(formSignIn);
					$("#Loader").delay(50000).css({
						display: "block",
						opacity: 1,
						visibility: "visible",
						left: obj.offset().left,
						top: obj.offset().top,
						width: obj.width(),
						height: obj.height(),
						zIndex: 999999
					}).focus();
				},
				success: function () {
					window.location.href = "<?=base_url ();?>";
				},
				error: function (data) {
					const errors = data.responseJSON.reason;
					M.Toast.dismissAll();
					if ((typeof errors) === "object") {
						$.each(errors, function (index, value) {
							toastHTML = "<span>" + value + "</span>" +
								"<button onclick='M.Toast.dismissAll()' class='btn-flat toast-action'>" +
								"<span class='material-icons' style='display: block; color: white;'>cancel</span></button>";
							M.toast({html: toastHTML, displayLength: 20000, duration: 20000});
						});
					} else {
						toastHTML = "<span>" + errors + "</span>" +
							"<button onclick='M.Toast.dismissAll()' class='btn-flat toast-action'>" +
							"<span class='material-icons' style='display: block; color: white;'>cancel</span></button>";
						M.toast({html: toastHTML, displayLength: 20000, duration: 20000});
					}
				},
				complete: function () {
					$("#Loader").css({
						display: "none"
					});
				},
			});
		});
	});
</script>
</body>
</html>





<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="manifest" href="/./manifest.json">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="/./assets/css/sExpress.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>SOLVE Login</title>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        background-color: #01579b;
        color: white;
        padding: 1em 0;
    }

    .form-control:focus {
        border-color: #19298a;
        box-shadow: 0 0 0 0.2rem rgba(25, 41, 138, 0.25);
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
	.header{
		display: flex;
		flex-wrap: wrap;
	}
	.header div{
		width: 100%;
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		padding: 20px;
	}
	@media screen and (max-width: 770px){
		.header div{
			width: 100%;
		}
	}
	.alerta{
		position: absolute;
		display: block;
		left: calc(50% - 200px);
		top: 50%;
	}
</style>
<div id="Loader"></div>
<main class="py-4">
	<div class="container text-center" style="margin: auto; width: 75vw; height: 90vh;">
		<div class="header">
			<div class="d-md-block"><img src="/./assets/img/logo.png" alt="logo" style="height: 80px"></div>
		</div>
		<div class="row">
			<div class="col-md-1 d-none d-md-block"></div>
			<div class="col-md-5 d-none d-md-block" style="background-color: var(--main-color); border-radius: 25px; color: var(--title-color); height: 90%;">
				<h4 class="font-weight-bold" style="margin-top: 1rem; margin-bottom: 0;">¡Tu nómina al instante!</h4>
				<h5 style="font-weight: 100;">Sin deudas y sin intereses</h5>
				<img src="/./assets/img/women1.png" alt="ok" style="height: 24vw; display: block; margin: auto">
			</div>
			<div class="col-md-6 d-md-block" style="padding: 1rem 5rem; min-width: 50%; width: auto">
				<h4 style="margin-bottom: 2rem">Inicio de sesión</h4>
				<form id="signinForm" name="signinForm" method="POST">
					<div class="form-group">
						<label for="curp" style="display: block; width: 100%; padding-left: 50px; margin-bottom: 0; text-align: left;">CURP *</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="material-icons">account_circle</i></span>
							</div>
							<input id="curp" name="curp" type="text" class="form-control" placeholder="18 caracteres" required>
						</div>
						<span class="invalid-feedback">formato erróneo</span>
					</div>
					<div class="form-group">
						<label for="password" style="display: block; width: 100%; padding-left: 50px; margin-bottom: 0; text-align: left;">Contraseña</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="material-icons">lock</i></span>
							</div>
							<input id="password" name="password" type="password" class="form-control" minlength="8" placeholder="minimo 8 caracteres" required>
						</div>
						<span class="invalid-feedback">longitud minima de 8 caracteres (mayúsculas, minúsculas, números)</span>
					</div>
					<div class="form-group">
						<div class="input-group">
						<button
								id="btnSend" name="btnSend" type="submit" class="btn btn-primary btn-block"
								style="width: 100%; color: var(--title-color) !important; font-size: 1.2rem; height: 8vh; margin-top: 1.5rem; letter-spacing: 0.1rem;">
							Iniciar sesión
						</button>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<a href="/validarCURP" target="_self">Registrarse</a>
							</button>
						</div>
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
				type: "POST",
				data: jsonData,
				processData: false,
				contentType: false,
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
					console.log(data);
					const errors = data.responseJSON.reason;
					if ((typeof errors) === "object") {
						$.each(errors, function (index, value) {
							toastHTML = "<div class='alert alert-danger alerta' role='alert'>" + value + "</div>";
							$("body").append(toastHTML);
						});
					} else {
						toastHTML = "<div class='alert alert-danger alerta' role='alert'>" + errors + "</div>";
						$("body").append(toastHTML);
						setTimeout(function() { 
							$('.alerta').fadeOut('fast'); 
						}, 1000)
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
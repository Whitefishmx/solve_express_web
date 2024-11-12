<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
	<meta charset="utf-8" />
	<title>SolveExpress | Validar</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
	<meta content="" name="drakoz" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<link rel="shortcut icon" href="/favicon.ico">
	
	<link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/libs/animate.css/animate.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<style>
    #Loader {
        display: none;
        position: absolute;
        background-color: rgba(255, 255, 255, .2);
        background-image: url('/assets/img/loader.gif') !important;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 200px;
        top: 0;
        z-index: 999;
        transition: opacity 5s ease, visibility 5s ease;
    }

    #curp {
        text-transform: uppercase;
    }
</style>
<script src="/assets/js/jquery-3.7.1.min.js"></script>
<div id="Loader"></div>
<div class="topbar d-print-none">
	<div class="container-xxl">
		<nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
			<ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
				<li class="topbar-item">
					<a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
						<i class="icofont-sun dark-mode"></i>
						<i class="icofont-moon light-mode"></i>
					</a>
				</li>
			</ul><!--end topbar-nav-->
		</nav>
		<!-- end navbar-->
	</div>
</div>
<div class="container-xxl">
	<div class="row vh-100 d-flex justify-content-center">
		<div class="col-12 align-self-center">
			<div class="card-body" id="curpValidator">
				<div class="row">
					<div class="col-lg-4 mx-auto">
						<div class="card">
							<div class="card-body p-0 bg-blue auth-header-box rounded-top">
								<div class="text-center p-3">
									<a href="/" class="logo logo-admin">
										<img src="/assets/img/logo.png" alt="logo" class="auth-logo" style="height: 50px">
									</a>
									<h4 class="mt-3 mb-1 fw-semibold text-white fs-18" id="TitleCard">Validar CURP</h4>
									<p class="text-bg-blue fw-medium mb-0" id="InstructionsCard">Introduce tu CURP para validar que estes registrado con tu
									                                                             empresa.</p>
								</div>
							</div>
							<div class="card-body pt-0" id="cardForm" style="display: block;">
								<form class="my-4" id="formCurpValidator">
									<div class="form-group mb-2">
										<label for="curp" class="form-label">CURP</label>
										<input id="curp" name="curp" type="text" class="form-control" placeholder="JDHY587536HFTEHR73">
									</div><!--end form-group-->
									<div class="form-group mb-0 row">
										<div class="col-12">
											<div class="d-grid mt-3">
												<button class="btn btn-primary" type="button" id="validateCurp">
													Validar <i class="fas fa-sign-in-alt ms-1"></i>
												</button>
											</div>
										</div><!--end col-->
									</div> <!--end form-group-->
								</form><!--end form-->
							</div><!--end card-body-->
							<div class="card-body pt-0" id="cardMeta" style="display: none; text-align: center">
								<script src="https://web-button.metamap.com/button.js"></script>
								<metamap-button
										clientid="63d42dbd0be362001ceb58d1" flowId="6706ca27cf0821001cc65f18" style="margin: 25px
								auto auto auto;"></metamap-button>
							</div>
							<div class="card-body pt-0" id="cardInValidation" style="display: none;">
								<div class="alert alert-info mb-0 border-2" role="alert">
									<h4 class="alert-heading font-18">Validación de identidad en proceso.</h4>
									<p>Se cargo su información biométrica y documentos oficiales con exito.</p>
									<p class="mb-0">El proceso de validación puede tardar hasta 5 minutos en completarse, </p>
								</div>
								<a href="/validarCURP" target="_self">Regrear a validar CURP</a>
							</div>
							<div class="card-body pt-0" id="cardPassword" style="display: none;">
								<form class="form" id="form-validation-2">
									<div class="mb-3">
										<label for="password" class="form-label">Contraseña</label>
										<input
												id="password" name="password" type="password" class="form-control" placeholder="C0ntraseña!" required
												minlength="8" maxlength="128">
									</div>
									<div class="mb-3">
										<label for="password2" class="form-label">Repetir contraseña</label>
										<input
												id="password2" name="password2" type="password" class="form-control" placeholder="Repita C0ntraseña!"
												required minlength="8" maxlength="128">
									</div><!--end form-group-->
									<div class="form-group mb-0 row">
										<div class="col-12">
											<div class="d-grid mt-3">
												<button type="submit" id="savePassword" class="btn btn-primary">Guardar contraseña <i
															class="fas fa-sign-in-alt ms-1"></i></button>
											</div>
										</div><!--end col-->
									</div> <!--end form-group-->
								</form><!--end form-->
							</div><!--end card-body-->
						</div><!--end card-->
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end card-body-->
		</div><!--end col-->
	</div><!--end row-->
</div>
<script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
<!--suppress JSUnresolvedReference -->
<script>
	let visitorId = "";
	let curp = "";
	let user = ";";
	const metamapButton = document.querySelector("metamap-button");
	FingerprintJS.load().then(fp => {
		fp.get().then(result => {
			visitorId = result.visitorId;
		});
	});
	$(document).ready(function () {
		document.getElementById("curp").addEventListener("input", function (e) {
			e.target.value = e.target.value.replace(/[^a-zA-Z0-9]/g, "").toUpperCase();
			if (e.target.value.length > 18) {
				e.target.value = e.target.value.slice(0, 18);
			}
		});
		$("#validateCurp").on("click", function () {
			validateCurp();
		});
		$("#formCurpValidator").on("submit", function (e) {
			e.preventDefault();
			validateCurp();
		});
		
		$("#form-validation-2").on("submit", function (e) {
			e.preventDefault();
			const password = $("#password").val();
			const password2 = $("#password2").val();
			changePassword(password, password2, user);
		});
		metamapButton.addEventListener("metamap:userFinishedSdk", ({detail}) => {
			console.log("finished payload", detail);
			wait4Validation();
		});
		metamapButton.addEventListener("metamap:exitedSdk", ({detail}) => {
			console.log("exited payload", detail);
		});
	});
	
	function validateCurp() {
		curp = $("#curp").val();
		FingerprintJS.load().then(fp => {
			fp.get().then(result => {
				visitorId = result.visitorId;
			});
		});
		$.ajax({
			url: "/toValidarCurp",
			data: {
				curp: curp,
				fingerprint: visitorId
			},
			dataType: "JSON",
			method: "POST",
			beforeSend: function () {
				const obj = $("#curpValidator");
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
			success: function (data, textStatus, xhr) {
				if (xhr.status === 201) {
					$("metamap-button").attr("metadata", JSON.stringify({curp: curp}));
					$("#cardForm").css("display", "none");
					$("#cardMeta").css("display", "block");
					$("#cardInValidation").css("display", "none");
					$("#cardPassword").css("display", "none");
					$("#TitleCard").html("Validar identidad");
					$("#InstructionsCard").html("De click en el botón para comenzar la verificación de identidad");
				}
				if (xhr.status === 202) {
					wait4Validation();
				}
				if (xhr.status === 200) {
					user = data["response"]["id"];
					console.log(user);
					$("#cardForm").css("display", "none");
					$("#cardMeta").css("display", "none");
					$("#cardInValidation").css("display", "none");
					$("#cardPassword").css("display", "block");
					$("#TitleCard").html("Ingrese una nueva contraseña");
					$("#InstructionsCard").html("La contraseña debe tener al menos 8 caracteres entre mayúsculas, minúsculas, números y carácter especial");
				}
			},
			error: function (error) {
				return void Swal.fire({icon: "error", title: "Oops...", text: error['responseJSON']['reason']});
				
			},
			complete: function () {
				$("#Loader").css({
					display: "none"
				});
			},
		});
	}
	
	function wait4Validation() {
		$("#cardForm").css("display", "none");
		$("#cardMeta").css("display", "none");
		$("#cardInValidation").css("display", "block");
		$("#cardPassword").css("display", "none");
		$("#TitleCard").html("Validando identidad");
		$("#InstructionsCard").html("");
	}
	
	function changePassword(password, password2, user) {
		$.ajax({
			url: "/setPassword",
			data: JSON.stringify({
				password: password,
				password2: password2,
				user: user,
			}),
			dataType: "JSON",
			contentType: "application/json; charset=utf-8",
			method: "POST",
			beforeSend: function () {
				const obj = $("#curpValidator");
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
			success: function (data, textStatus, xhr) {
				if (xhr.status === 200) {
					void Swal.fire({icon: "success", title: "Se guardo su contraseña, ya puede iniciar sesión", timer: 1500});
					setTimeout(function() {
						window.location.href = "/";
					}, 2500);
				}
			},
			error: function () {
				return void Swal.fire({icon: "error", title: "Oops...", text: "No se pudo actualizar la contraseña, intente nuevamente o contacte a soporte " +
						"técnico"});
			},
			complete: function () {
				$("#Loader").css({
					display: "none"
				});
			},
		});
	}
</script>
<!-- Javascript  -->
<!-- vendor js -->
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/app.js"></script>
</body>
<!--end body-->
</html>
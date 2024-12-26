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

    p.error {
        color: red;
        display: flex;
        align-items: center;
        margin: 5px 0;
    }

    p.error small {
        display: none; /* Oculta el <small> por defecto */
    }

    p.correct {
        color: green !important;
    }

    p.correct small {
        display: inline; /* Muestra el <small> si es correcto */
        color: green !important;
    }

    /* Opcional: ícono (fas) con un espacio a la derecha */
    p span.fas {
        margin-right: 5px;
        color: green !important;
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
<div class="page-wrapper" id="mainContainer">
	<div class="container-xxl">
		<div class="row vh-100 d-flex justify-content-center">
			<div class="col-12 align-self-center">
				<div class="card-body" id="curpValidator">
					<div class="row">
						<div class="col-lg-6 mx-auto">
							<div
									class="card" style="-webkit-box-shadow: 5px 13px 20px -2px rgba(0,0,0,0.75);
									-moz-box-shadow: 5px 13px 20px -2px rgba(0,0,0,0.75);
									box-shadow: 5px 13px 20px -2px rgba(0,0,0,0.75);">
								<!--======================================|HeaderCard|=================================-->
								<div class="card-body p-0 auth-header-box rounded-top">
									<div class="text-center p-3">
										<a href="/" class="logo logo-admin">
											<img src="/assets/img/logo.png" alt="" class="me-2 logo-dark" style="height: 50px">
											<img src="/assets/img/dark_logo.png" alt="" class="me-2 logo-light" style="height: 50px">
										</a>
										<h4 class="card-title" id="TitleCard" style="margin-top: 20px">Recuperar contraseña</h4>
										<div>
											<p class="card-subtitle fs-14 mb-2" id="InstructionsCard">Introduce tu CURP para validar que estes registrado.</p>
										</div>
									</div>
								</div>
								<!--======================================|End HeaderCard|=================================-->
								<!--======================================|BodyCards|=================================-->
								<div class="card-body pt-0" id="curpForm" style="display: block;">
									<form class="my-4" id="formCurpValidator">
										<div class="form-group mb-2">
											<label for="email" class="form-label">Correo</label>
											<input id="email" name="curp" type="text" class="form-control" placeholder="alguien@algo.com">
										</div><!--end form-group-->
										<div class="form-group mb-0 row">
											<div class="col-6">
												<div class="d-grid mt-3">
													<button class="btn btn-danger" type="button" id="backLogin" onclick="window.location.href = '/';">
														Regresar a Inicio <i class="fas fa-home  ms-1"></i>
													</button>
												</div>
											</div><!--end col-->
											<div class="col-6">
												<div class="d-grid mt-3">
													<button class="btn btn-primary" type="button" id="validateCurp">
														Validar <i class="fas fa-sign-in-alt ms-1"></i>
													</button>
												</div>
											</div><!--end col-->
										</div> <!--end form-group-->
									</form><!--end form-->
								</div><!--end card-CURP-->
								<div class="card-body pt-4" id="cardCode" style="display: none;">
									<form class="form" id="formCodeValidator">
										<div class="form-group mb-2">
											<label for="codeMail" class="form-label">Codigo</label>
											<input
													id="codeMail" name="codeMail" type="text" class="form-control" placeholder="50LV3E" maxlength="6"
													minlength="6" pattern="[A-Za-z0-9]{6}" style="text-transform: uppercase;" title="Sin espacios ni guiones"
													oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');">
										</div><!--end form-group-->
										<div class="form-group mb-0 row">
											<div class="d-grid mt-3">
												<button class="btn btn-primary" type="button" id="validateCodeMail">
													Validar <i class="fas fa-sign-in-alt ms-1"></i>
												</button>
											</div>
										</div> <!--end form-group-->
									</form><!--end form-->
								</div><!--end card-emailCode-->
								<div class="card-body pt-4" id="cardPassword" style="display: none;">
									<form class="form" id="formValidationPassword">
										<div class="row">
											<div class="col-lg-7">
												<div class="mb-3">
													<label for="password" class="form-label">Contraseña *</label>
													<input
															id="password" name="password" type="password" class="form-control" placeholder="C0ntraseña!">
													<small>Error Message</small>
												</div>
												<div class="mb-3">
													<label for="password2" class="form-label">Repetir contraseña *</label>
													<input
															id="password2" name="password2" type="password" class="form-control"
															placeholder="Repita C0ntraseña!">
													<small>Error Message</small>
												</div>
											</div>
											<div class="col-lg-5">
												<p id="special" class="error"><small class="fas fa-check"></small> Al menos un carácter especial.</p>
												<p id="number" class="error"><small class="fas fa-check"></small> Al menos un carácter número.</p>
												<p id="upper" class="error"><small class="fas fa-check"></small> Al menos una letra mayúscula.</p>
												<p id="length" class="error"><small class="fas fa-check"></small> Al menos 8 caracteres.</p>
												<p id="both" class="error"><small class="fas fa-check"></small> Las contraseñas coinciden.</p>
											</div>
										</div>
										<div class="form-group mb-0 row">
											<div class="col-12">
												<div class="d-grid mt-3" style="margin-top: 25px !important;">
													<button type="submit" id="savePassword" class="btn btn-primary">Guardar contraseña <i
																class="fas fa-sign-in-alt ms-1"></i></button>
												</div>
											</div><!--end col-->
										</div> <!--end form-group-->
									</form><!--end form-->
								</div><!--end card-password-->
								<!--======================================|End BodyCards|=================================-->
							</div><!--end card-->
						</div><!--end col-->
					</div><!--end row-->
				</div><!--end card-body-->
			</div><!--end col-->
		</div><!--end row-->
	</div>
</div>

<!-- Javascript  -->
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/resetPassword.js"></script>
</body>
<!--end body-->
</html>
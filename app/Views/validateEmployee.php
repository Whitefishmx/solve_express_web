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
<div class="page-wrapper" id="mainContainer">
	<div class="container-xxl">
		<div class="row vh-100 d-flex justify-content-center">
			<div class="col-12 align-self-center">
				<div class="card-body" id="curpValidator">
					<div class="row">
						<div class="col-lg-6 mx-auto">
							<div class="card" style="-webkit-box-shadow: 5px 13px 20px -2px rgba(0,0,0,0.75);
									-moz-box-shadow: 5px 13px 20px -2px rgba(0,0,0,0.75);
									box-shadow: 5px 13px 20px -2px rgba(0,0,0,0.75);">
								<div class="card-body p-0 auth-header-box rounded-top">
									<div class="text-center p-3">
										<a href="/" class="logo logo-admin">
											<img src="/assets/img/logo.png" alt="logo" class="auth-logo" style="height: 50px">
										</a>
										<h4 class="card-title" id="TitleCard" style="margin-top: 20px">Validar CURP</h4>
										<div>
											<p class="card-subtitle fs-14 mb-2" id="InstructionsCard">Introduce tu CURP para validar que estes registrado con tu
											                                                          empresa.</p>
										</div>
									</div>
								</div>
								<div class="card-body pt-0" id="cardForm" style="display: block;">
									<form class="my-4" id="formCurpValidator">
										<div class="form-group mb-2">
											<label for="curp" class="form-label">CURP</label>
											<input id="curp" name="curp" type="text" class="form-control" placeholder="JDHY587536HFTEHR73">
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
								<div class="card-body pt-4" id="cardPassword" style="display: none; padding-top: 0 !important;">
									<form class="form" id="form-validation-2">
										<div class="row">
											<div class="col-lg-6">
												<div class="mb-3">
													<label for="username" class="form-label">Usuario *</label>
													<input
															id="username" name="username" type="text" class="form-control" placeholder="Usuario">
													<small>Error Message</small>
												</div>
												<div class="mb-3">
													<label for="email" class="form-label">Correo *</label>
													<input class="form-control" id="email" name="email" type="text"
													       placeholder="sobebody@somehow.com">
													<small>Error Message</small>
												</div>
												<div class="mb-3">
													<label for="phone" class="form-label">Teléfono</label>
													<input id="phone" name="phone" type="tel" class="form-control" placeholder="(55)45-47-4545">
													<small>Error Message</small><input id="phoneUnmasked" type="hidden">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="mb-3">
													<label for="password" class="form-label">Contraseña *</label>
													<input
															id="password" name="password" type="password" class="form-control" placeholder="C0ntraseña!">
													<small>Error Message</small>
												</div>
												<div class="mb-3">
													<label for="password2" class="form-label">Repetir contraseña *</label>
													<input
															id="password2" name="password2" type="password" class="form-control" placeholder="Repita C0ntraseña!">
													<small>Error Message</small>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="form-group mb-0 row">
												<div class="col-12">
													<div class="d-grid mt-3" style="margin-top: 0 !important;">
														<button type="submit" id="savePassword" class="btn btn-primary">Guardar contraseña <i
																	class="fas fa-sign-in-alt ms-1"></i></button>
													</div>
												</div><!--end col-->
											</div> <!--end form-group-->
										</div>
									</form><!--end form-->
								</div><!--end card-body-->
							</div><!--end card-->
						</div><!--end col-->
					</div><!--end row-->
				</div><!--end card-body-->
			</div><!--end col-->
		</div><!--end row-->
	</div>
</div>

<!-- Javascript  -->
<script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/imask/imask.min.js"></script>
<!--<script src="/assets/js/pages/form-validation.js"></script>-->
<script src="/assets/js/app.js"></script>
<script src="/assets/js/validation.js"></script>
</body>
<!--end body-->
</html>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
	<?php
		$title = $title ?? "SolveExpress";
		$iniciales = $iniciales ?? "JH";
		$name = $name ?? "James Hook";
		$company = $company ?? "WhiteFish";
		$colors = [ 'success', 'blue', 'pink', 'purple', 'waring', 'info', 'dark' ];
		$color = $colors[ rand ( 0, count ( $colors ) - 1 ) ];
	?>
	<meta charset="utf-8" />
	<title><?php echo $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
	<meta content="" name="Drakoz" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<link rel="shortcut icon" href="/favicon.ico">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="/assets/libs/mobius1-selectr/selectr.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/simplebar/simplebar.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/sExpress.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/CompanyExpress.css" rel="stylesheet" type="text/css" />

</head>
<script>
	window.intercomSettings = {
		api_base: "https://api-iam.intercom.io",
		app_id: "fjsyzg5w",
	};
</script>
<script>
	// Completamos previamente el ID de tu aplicación en la URL del widget: 'https://widget.intercom.io/widget/fjsyzg5w'
	(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/fjsyzg5w';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<body>
<style>
    #Loader {
        display: none;
        position: absolute;
        background-color: rgba(255, 255, 255, .2);
        background-image: url('/assets/img/loader.gif') !important;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 250px;
        top: 0;
        z-index: 999;
        transition: opacity 5s ease, visibility 5s ease;
    }

    #uploadNomina {
        background-color: var(--bs-primary) !important;
        color: var(--bs-btn-hover-color) !important;
    }

    #uploadNomina:hover, button:hover {
        background-color: var(--bs-tertiarybg) !important;
        color: var(--bs-btn-hover-color) !important;
    }

    .form-control {
        background-color: rgba(140, 143, 156, 0.18);
    }
</style>
<div id="Loader"></div>
<div class="topbar d-print-none">
	<div class="container-xxl">
		<nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
			<ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
				<li>
					<a class="navbar-brand" href="/">
						<img src="/assets/img/express_logo.svg" alt="" class="me-2 logo-dark" style="width: 135px;">
						<img src="/assets/img/express_logo_dark.svg" alt="" class="me-2 logo-light" style="width: 135px;">
					</a>
				</li>
				<li class="mx-3 welcome-text">
				</li>
			</ul>
			<ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
				<li class="topbar-item">
					<a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
						<i class="icofont-sun dark-mode"></i>
						<i class="icofont-moon light-mode"></i>
					</a>
				</li>
				<li class="dropdown topbar-item">
					<a
						class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
						aria-haspopup="false" aria-expanded="false">
						<span class="thumb-lg justify-content-center d-flex align-items-center bg-<?= $color ?>-subtle text-<?= $color ?> rounded-circle me-2">
							<?= $iniciales; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-end py-0">
						<div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
							<div class="flex-shrink-0">
								<span
									class="thumb-lg justify-content-center d-flex align-items-center bg-<?= $color ?>-subtle text-<?= $color ?> rounded-circle me-2">
									<?= $iniciales; ?></span>
							</div>
							<div class="flex-grow-1 ms-2 text-truncate align-self-center">
								<h6 class="my-0 fw-medium text-dark fs-13"><?= $name; ?></h6>
								<small class="text-muted mb-0"><?= $company; ?></small>
							</div>
						</div>
						<div class="dropdown-divider mt-0"></div>
						<small class="text-muted px-2 pb-1 d-block">Cuenta</small>
						<a class="dropdown-item" href="/"><i class="fas fa-home  fs-18 me-1 align-text-bottom"></i> Inicio</a>
						<div class="dropdown-divider mb-0"></div>
						<a class="dropdown-item text-danger" href="/signout"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
					</div>
				</li>
			</ul>
		</nav>
	</div>
</div>
<div class="page-wrapper" id="mainContainer">
	<div class="page-content" style="width: 100%; margin-left: 0">
		<div class="container-xxl">
			<div class="row vh-100 d-flex justify-content-center">
				<div class="col-12 align-self-center">
					<div class="row align-items-center justify-content-center text-center">
						<h1>Tutoriales</h1>
					</div>
					<div class="accordion" id="accordionPanelsStayOpenExample">
						<div class="accordion-item">
							<h5 class="accordion-header">
								<button class="accordion-button fw-semibold collapsed text-light text-accordion" type="button" data-bs-toggle="collapse"
								        data-bs-target="#panelsStayOpen-collapse-1" aria-expanded="false" aria-controls="panelsStayOpen-collapse-1"
								        style="font-size: 1rem !important;">Disposiciones Solve Express</button></h5>
							<div id="panelsStayOpen-collapse-1" class="accordion-collapse collapse" style="">
								<div class="accordion-body">
									<div class="ratio ratio-16x9">
										<video controls>
											<source src="https://api.solvegcm.mx/public/assets/videos/Video%20Tutorial%20Disposiciones%20Solve%20Express.mp4" type="video/mp4">
										</video>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h5 class="accordion-header">
								<button class="accordion-button fw-semibold collapsed text-light text-accordion" type="button" data-bs-toggle="collapse"
								        data-bs-target="#panelsStayOpen-collapse-2" aria-expanded="false" aria-controls="panelsStayOpen-collapse-2"
								        style="font-size: 1rem !important;">Baja de empleados</button></h5>
							<div id="panelsStayOpen-collapse-2" class="accordion-collapse collapse" style="">
								<div class="accordion-body">
									<div class="ratio ratio-16x9">
										<video controls>
											<source src="https://api.solvegcm.mx/public/assets/videos/Video%20tutorial%20baja%20de%20empleados.mp4" type="video/mp4">
										</video>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h5 class="accordion-header">
								<button class="accordion-button fw-semibold collapsed text-light text-accordion" type="button" data-bs-toggle="collapse"
								        data-bs-target="#panelsStayOpen-collapse-3" aria-expanded="false" aria-controls="panelsStayOpen-collapse-3"
								        style="font-size: 1rem !important;">Carga de empleados</button></h5>
							<div id="panelsStayOpen-collapse-3" class="accordion-collapse collapse" style="">
								<div class="accordion-body">
									<div class="ratio ratio-16x9">
										<video controls>
											<source src="https://api.solvegcm.mx/public/assets/videos/Video%20tutorial%20carga%20empleados.mp4" type="video/mp4">
										</video>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/jquery-3.7.1.min.js"></script>
<script src="/assets/js/profile.js"></script>
</body>
<!--end body-->
</html>
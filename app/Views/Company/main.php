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
	<link href="/assets/libs/sweetalert2/sweetalert2.min.css?v=1.1.1" rel="stylesheet" type="text/css">
	<link href="/assets/libs/animate.css/animate.min.css?v=1.1.1" rel="stylesheet" type="text/css">
	<link href="/assets/libs/mobius1-selectr/selectr.min.css?v=1.1.1" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/simple-datatables/style.css?v=1.1.1" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/simplebar/simplebar.min.css?v=1.1.1" rel="stylesheet" type="text/css">
	<link href="/assets/css/bootstrap.min.css?v=1.1.1" rel="stylesheet" type="text/css" />
	<link href="/assets/css/icons.min.css?v=1.1.1" rel="stylesheet" type="text/css" />
	<link href="/assets/css/app.min.css?v=1.1.2" rel="stylesheet" type="text/css" />
	
	<link href="/assets/css/CompanyExpress.css?v=1.1.1" rel="stylesheet" type="text/css" />

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

    #uploadNomina, #upLoadFires {
        background-color: var(--bs-primary) !important;
        color: var(--bs-btn-hover-color) !important;
    }

    #uploadNomina:hover, button:hover, #upLoadFires:hover {
        background-color: var(--bs-tertiarybg) !important;
        color: var(--bs-btn-hover-color) !important;
    }

    .selectr-selected {
        border-color: var(--bs-primary)
    }

    .form-control[type="file"]::file-selector-button {
        background-color: var(--bs-primary);
        color: white;
    }

    .form-control[type="file"]::-webkit-file-upload-button {
        background-color: var(--bs-primary);
        color: white;
    }

    .form-control:hover:not(:disabled):not([readonly])::file-selector-button {
        background-color: #2271B891 !important;
        color: white;
    }

    .form-control:hover:not(:disabled):not([readonly])::-webkit-file-upload-button:hover {
        background-color: #2271B891 !important;
        color: white;
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
							</div><!--end media-body-->
						</div>
						<div class="dropdown-divider mt-0"></div>
						<small class="text-muted px-2 pb-1 d-block">Cuenta</small>
						<a class="dropdown-item" href="/profile"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Cuenta</a>
						<div class="dropdown-divider mb-0"></div>
						<a class="dropdown-item text-danger" href="/signout"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
					</div>
				</li>
			</ul><!--end topbar-nav-->
		</nav>
		<!-- end navbar-->
	</div>
</div>
<div class="page-wrapper" id="mainContainer">
	<div class="page-content" style="width: 100%; margin-left: 0">
		<div class="container-xxl" style="margin-top: 15px;">
			<div class="col-md-12 col-lg-126">
				<div class="card">
					<div class="card-body pt-0" style="margin-top: 15px">
						<!-- Init Tabs -->
						<ul class="nav nav-pills nav-justified" role="tablist">
							<li class="nav-item waves-effect waves-light">
								<a
										class="nav-link" data-bs-toggle="tab" href="#employeeTable" role="tab" aria-selected="true"
										id="tabFireEmployee">Empleados</a>
							</li>
							<li class="nav-item waves-effect waves-light">
								<a
										class="nav-link active" data-bs-toggle="tab" href="#provisionsTable" role="tab" aria-selected="false"
										id="tabEmployee">Disposiciones</a>
							</li>
							<li class="nav-item waves-effect waves-light">
								<a
										class="nav-link" data-bs-toggle="tab" href="#invoiceTable" role="tab" aria-selected="false"
										id="tabInvoices">Pagos</a>
							</li>
						</ul><!-- End Tabs -->
						<div class="tab-content">
							<!--Tabla de empleados-->
							<?php include ( 'employeeTab.php' ) ?>
							<!--Tabla de disposiciones-->
							<?php include ( 'provisionsTab.php' ) ?>
							<!--Tabla de facturas-->
							<?php include ( 'invoiceTab.php' ) ?>
						</div>
					</div><!-- End Panes -->
				</div>
			</div>
		</div>
	</div>
</div>
<script src="/assets/js/jquery-3.7.1.min.js?v=1.1.1"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js?v=1.1.1"></script>
<script src="/assets/libs/simplebar/simplebar.min.js?v=1.1.1"></script>
<script src="/assets/libs/simple-datatables/umd/simple-datatables.js?v=1.1.1"></script>
<script src="/assets/libs/mobius1-selectr/selectr.min.js?v=1.1.1"></script>
<script src="/assets/js/app.js?v=1.1.1"></script>
<script src="/assets/libs/sweetalert2/sweetalert2.min.js?v=1.1.1"></script>
<script src="/assets/js/company.js?v=2.0.2"></script>
</body>
<!--end body-->
</html>
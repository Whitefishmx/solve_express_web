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
	
	<link href="/assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/simplebar/simplebar.min.css" rel="stylesheet" type="text/css">
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
        background-size: 80%;
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
										<img src="/assets/img/logo.png" height="50" alt="logo" class="auth-logo">
									</a>
									<h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Validar Identidad</h4>
									<p class="text-bg-blue fw-medium mb-0"></p>
								</div>
							</div>
							<div class="card-body pt-0 align-items-center">
								
								<metamap-button clientid="63d42dbd0be362001ceb58d1" flowId="6706ca27cf0821001cc65f18" metadata='{"curp":
								"baca"}'></metamap-button>
							</div><!--end card-body-->
						</div><!--end card-->
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end card-body-->
		</div><!--end col-->
	</div><!--end row-->
</div>
<!-- Javascript  -->
<script>
	const metamapButton = document.querySelector('metamap-button');
	
	metamapButton.addEventListener('metamap:userFinishedSdk', ({ detail }) => {
		console.log('finished payload', detail)
	});
	
	metamapButton.addEventListener('metamap:exitedSdk', ({ detail }) => {
		console.log('exited payload', detail)
	});
</script>
<!-- vendor js -->
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/simple-datatables/umd/simple-datatables.js"></script>
<script src="/assets/js/pages/datatable.init.js"></script>
<script src="/assets/js/app.js"></script>
</body>
<!--end body-->
</html>
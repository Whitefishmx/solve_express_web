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
									<h4 class="mt-3 mb-1 fw-semibold text-white fs-18" id="TitleCard">Validar CURP</h4>
									<p class="text-bg-blue fw-medium mb-0" id="InstructionsCard">Introduce tu CURP para validar que estes registrado con tu
									                                                           empresa.</p>
								</div>
							</div>
							<div class="card-body pt-0" id="cardForm" style="display: none;">
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
							<div class="card-body pt-0" id="cardMeta" style="display: none;">
								<script src="https://web-button.metamap.com/button.js">	</script>
								<metamap-button clientid="63d42dbd0be362001ceb58d1" flowId="6706ca27cf0821001cc65f18"></metamap-button>
							</div>
							<div class="card-body pt-0" id="cardInValidation" style="display: block;">
								<div class="alert alert-info mb-0 border-2" role="alert">
									<h4 class="alert-heading font-18">Validación de identidad en proceso.</h4>
									<p>Se cargo su información biométrica y documentos oficiales con exito.</p>
									<p class="mb-0">El proceso de validación puede tardar hasta 5 minutos en completarse, </p>
								</div>
								
							</div>
						</div><!--end card-->
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end card-body-->
		</div><!--end col-->
	</div><!--end row-->
</div>
<script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
<script>
	let visitorId = "";
	let curp = "";
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
		$('#formCurpValidator').on('submit', function (e) {
			e.preventDefault();
            validateCurp();
		});
	});
	function validateCurp(){
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
				if (xhr.status=== 201) {
					window.location.href = "/validateIdentity";
				}if (xhr.status=== 202) {
					window.location.href = "/waitFor";
				}
				if (xhr.status=== 200) {
					window.location.href = "/newPassword";
				}
			},
			error: function (data) {
				console.log(data);
				
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
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/simple-datatables/umd/simple-datatables.js"></script>
<script src="/assets/js/pages/datatable.init.js"></script>
<script src="/assets/js/app.js"></script>
</body>
<!--end body-->
</html>
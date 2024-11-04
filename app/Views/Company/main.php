<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
	<?php
		$title = $title ?? "SolveExpress";
		$iniciales = $iniciales ?? "JH";
		$name = $name ?? "James Hook";
		$company = $company ?? "WhiteFish";
	?>
	<meta charset="utf-8" />
	<title><?php echo $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
	<meta content="" name="drakoz" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<link rel="shortcut icon" href="/favicon.ico">
	
	<link href="/assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
	
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
	
	<link href="/assets/css/CompanyExpress.css" rel="stylesheet" type="text/css" />

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
</style>
<div id="Loader"></div>
<div class="topbar d-print-none">
	<div class="container-xxl">
		<nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
			<ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
				<li>
					<a class="navbar-brand" href="#">
						<img src="assets/img/logo.png" width="135" alt="" class="me-2">
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
						<span
								class="thumb-lg justify-content-center d-flex align-items-center bg-purple-subtle text-purple rounded-circle
						me-2"><?= $iniciales; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-end py-0">
						<div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
							<div class="flex-shrink-0">
								<span
										class="thumb-lg justify-content-center d-flex align-items-center bg-purple-subtle text-purple rounded-circle
						me-2"><?= $iniciales; ?></span>
							</div>
							<div class="flex-grow-1 ms-2 text-truncate align-self-center">
								<h6 class="my-0 fw-medium text-dark fs-13"><?= $name; ?></h6>
								<small class="text-muted mb-0"><?= $company; ?></small>
							</div><!--end media-body-->
						</div>
						<div class="dropdown-divider mt-0"></div>
						<small class="text-muted px-2 pb-1 d-block">Cuenta</small>
						<a class="dropdown-item" href="pages-profile.php"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Profile</a>
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
							<li class="nav-item waves-effect waves-light" role="presentation">
								<a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab" aria-selected="true">Empleados</a>
							</li>
							<li class="nav-item waves-effect waves-light" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="false" tabindex="-1">Análisis</a>
							</li>
						</ul>
						<!-- End Tabs -->
						<!-- Panes-->
						<div class="tab-content">
							<!-- Table Employee -->
								<!-- Filters -->
							<div class="card-body pt-0">
							<div class="text-center">
								<form class="align-items-center" style="margin-top: 15px">
									<div class="row">
										<div class="col-auto"><label for="initDante" class="col-form-label">Fecha de Inicio</label></div>
										<div class="col-auto"><input type="date" class="form-control" id="initDante" placeholder="Enter Email"></div>
										<div class="col-auto"><label for="EndDate" class="col-form-label">Fecha Fin</label></div>
										<div class="col-auto"><input type="date" class="form-control" id="EndDate" placeholder="Enter Email"></div>
							
									</div>
								</form>
							</div>
							</div>
								<!-- End Filters -->
							
							<div class="tab-pane p-3 active show" id="home-1" role="tabpanel">
								<div class="row justify-content-center">
									<div class="table-responsive">
										
										<table class="table datatable" id="datatable_1">
											<thead class="table-light">
											<tr>
												<!--															<th style="width: 16px;">-->
												<!--																<div class="form-check mb-0 ms-n1">-->
												<!--																	<input type="checkbox" class="form-check-input" name="select-all" id="select-all">-->
												<!--																</div>-->
												<!--															</th>-->
												<th>#Empleado</th>
												<th>Nombre</th>
												<th>RFC</th>
												<!--															<th data-type="date" data-format="YYYY/DD/MM">Start Date</th>-->
												<th>Salario Neto</th>
												<th>Monto adelantado</th>
												<th>Monto restante</th>
												<th>Periodo</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<!--															<td style="width: 16px;">-->
												<!--																<div class="form-check">-->
												<!--																	<input type="checkbox" class="form-check-input" name="check" id="customCheck1">-->
												<!--																</div>-->
												<!--															</td>-->
												<td>2</td>
												<td>Juan Carlos Carreño</td>
												<td>CAFJ741213H56</td>
												<td>$12000</td>
												<td>$436.02</td>
												<td>$11563.98</td>
												<td>2ª quincena de Octubre 2024</td>
											</tr>
											<tr>
												<!--															<td style="width: 16px;">-->
												<!--																<div class="form-check">-->
												<!--																	<input type="checkbox" class="form-check-input" name="check" id="customCheck1">-->
												<!--																</div>-->
												<!--															</td>-->
												<td>7</td>
												<td>Uriel Magallon Lugo</td>
												<td>MALU970621T16</td>
												<td>$12000</td>
												<td>$1435.01</td>
												<td>$10564.99</td>
												<td>2ª quincena de Octubre 2024</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div><!--end row-->
							</div>
							<!-- Table Employee -->
							<!-- Analytics -->
							<div class="tab-pane p-3" id="profile-1" role="tabpanel">
								<p class="text-muted mb-0">
									Food truck fixie locavore, accusamus mcsweeney's
									single-origin coffee squid.
								</p>
							</div>
							<!-- End Analytics -->
						</div>
						<!-- End Panes -->
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>
<!-- Javascript  -->
<!-- vendor js -->
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.css"></script>
<script src="/assets/libs/simple-datatables/umd/simple-datatables.js"></script>
<script src="/assets/js/pages/datatable.init.js"></script>
<script src="/assets/js/app.js"></script>
</body>
<!--end body-->
</html>
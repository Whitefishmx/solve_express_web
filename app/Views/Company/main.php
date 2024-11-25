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
</style>
<div id="Loader"></div>
<div class="topbar d-print-none">
	<div class="container-xxl">
		<nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
			<ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
				<li>
					<a class="navbar-brand" href="#">
						<img src="/assets/img/logo.png" alt="" class="me-2 logo-dark" style="width: 135px;">
						<img src="/assets/img/dark_logo.png" alt="" class="me-2 logo-light" style="width: 135px;">
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
							<li class="nav-item waves-effect waves-light">
								<a
										class="nav-link active" data-bs-toggle="tab" href="#employeeTable" role="tab" aria-selected="true"
										id="tabEmployee">Empleados</a>
							</li>
							<li class="nav-item waves-effect waves-light">
								<a
										class="nav-link" data-bs-toggle="tab" href="#invoiceTable" role="tab" aria-selected="false"
										id="tabInvoices">Pagos</a>
							</li>
						</ul><!-- End Tabs -->
						<div class="tab-content">
							<!--Tabla de empleados-->
							<div class="tab-pane p-3 active" id="employeeTable" role="tabpanel">
								<div class="tab-content">
									<div class="card-body pt-0">
										<div class="text-center">
											<form class="align-items-center" style="margin-top: 5px">
												<div class="row align-items-center flex-wrap c-flex">
													<div class="col-sm-2">
														<label for="initDate" class="col-form-label bg-light">Fecha de Inicio</label>
														<input
																type="date" class="form-control bg-light" id="initDate" value="2024-08-01" min=min="2024-08-01"
																max="<?= date ( 'Y-m-d', strtotime ( 'now' ) ) ?>"></div>
													<div class="col-sm-2">
														<label for="endDate" class="col-form-label">Fecha de Fin</label>
														<input
																type="date" class="form-control bg-light" id="endDate"
																value="<?= date ( 'Y-m-d', strtotime ( 'now' ) ) ?>"
																min="2024-08-01"
																max="<?= date ( 'Y-m-d', strtotime ( 'now' ) ) ?>"></div>
													<div class="col-sm-2">
														<label for="rfc" class="col-form-label">RFC</label>
														<input type="text" class="form-control bg-light" id="rfc" placeholder="MUGH142563R23"></div>
													<div class="col-sm-2">
														<label for="curp" class="col-form-label">CURP</label>
														<input type="text" class="form-control bg-light" id="curp" placeholder="MUGH142563HFYRHD84"></div>
													<div class="col-sm-2">
														<label for="name" class="col-form-label">Nombre</label>
														<input type="text" class="form-control bg-light" id="name" placeholder="Juan Perez"></div>
													<div class="col-sm-2">
														<label for="period" class="col-form-label ">Periodo</label>
														<select id="period" class="form-select bg-light">
															<option value="">Todos</option>
														</select></div>
												</div>
										</div>
										<div class="row align-items-center" style="margin-top: 10px">
											<div class="row align-items-center flex-wrap c-flex">
												<div class="col-sm-5 text-center">
													<label for="download" class="col-form-label">
														Cargar archivo excel de nomina
													</label>
													<form id="formNomina" class="input-group">
														<div class="input-group">
															<input
																	type="file" class="form-control bg-light" id="nominaFile" aria-describedby="nominaFile"
																	aria-label="Cargar"
																	accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
															<button class="btn btn-outline-secondary" type="button" id="uploadNomina">Cargar Nomina</button>
														</div>
													</form>
												</div>
												<div class="col-md-1 text-end">
													<label class="col-form-label">
														Descargar layout de nomina
														<a href="" target="_blank" style="color: #FF9400"><i class="fas fa-download "></i></a>
													</label>
												</div>
												<div class="col-sm-2 text-center">
													<label for="columns" class="col-form-label">
														Seleccionar columnas <i class="fas fa-info-circle" title="Solo para la descarga del reporte"></i>
													</label>
													<select id="columns" class="form-select" multiple>
														<option value="" selected id="all">Todos</option>
														<option value="noEmpleado">No. De empleado</option>
														<option value="name">Nombre</option>
														<option value="lastName">Apellido Paterno</option>
														<option value="sureName">Apellido Materno</option>
														<option value="rfc">RFC</option>
														<option value="curp">CURP</option>
														<option value="plan">Esquema de pago</option>
														<option value="netSalary">Salario neto</option>
														<option value="period">Periodo</option>
													</select>
												</div>
												<div class="col-sm-2 text-center">
													<label for="download" class="col-form-label">
														Descargar reporte
													</label>
													<button type="button" class="btn btn-lg btn-primary" id="download">
														Descargar <i class="fas fa-download"></i>
													</button>
												</div>
												<div class="col-sm-2 text-center">
													<label for="searchReport" class="col-form-label">
														Realizar búsqueda
													</label>
													<button type="button" class="btn btn-lg btn-primary" id="searchReport">
														Buscar <i class="fas fa-search "></i>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="table-responsive">
										<table class="table datatable" id="datatable_1">
											<thead class="table-light">
											<tr>
												<th>#Empleado</th>
												<th>Nombre</th>
												<th>RFC</th>
												<th>Salario Neto</th>
												<th>Monto adelantado</th>
												<th>Monto restante</th>
												<th>Periodo</th>
											</tr>
											</thead>
											<tbody id="companyResults">
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!--Tabla de facturas-->
							<div class="tab-pane p-3" id="invoiceTable" role="tabpanel">
								<div class="row justify-content-center">
									<div class="table-responsive">
										<table class="table datatable" id="tableInvoice">
											<thead class="table-light">
											<tr>
												<th>Monto a pagar</th>
												<th>Beneficiario</th>
												<th>Cuenta clabe</th>
												<th>Numero de referencia</th>
												<th>Concepto</th>
												<th>Estatus</th>
												<th>CEP</th>
												<th>Fecha limite de pago</th>
											</tr>
											</thead>
											<tbody id="companyResults">
											<tr>
												<td>$ 436.04</td>
												<td>WHITEFISH SOLVE TECH</td>
												<td>646180376610900003</td>
												<td>7514328</td>
												<td>7514328</td>
												<td><span class="badge rounded-pill bg-primary"><strong>Liquidado</strong></span></td>
												<td><a
															href="https://api-solve.local/cepDownloader/1731522215_8090024.pdf" target="_blank"
															style="color: #FF9400"><i class="material-icons prefix">download</i>Descargar</a></td>
												<td>20/Octubre/2024</td>
											</tr>
											<tr>
												<td>$ 500.00</td>
												<td>WHITEFISH SOLVE TECH</td>
												<td>646180376610900003</td>
												<td>5546217</td>
												<td>5546217</td>
												<td><span class="badge rounded-pill bg-primary"><strong>Liquidado</strong></span></td>
												<td><a
															href="https://api-solve.local/cepDownloader/1731522215_8090024.pdf" target="_blank"
															style="color: #FF9400"><i class="material-icons prefix">download</i>Descargar</a></td>
												<td>05/Noviembre/2024</td>
											</tr>
											<tr>
												<td>$ 1,250.00</td>
												<td>WHITEFISH SOLVE TECH</td>
												<td>646180376610900003</td>
												<td>9642177</td>
												<td>9642177</td>
												<td><span class="badge rounded-pill bg-primary"><strong>Liquidado</strong></span></td>
												<td><a
															href="https://api-solve.local/cepDownloader/1731522215_8090024.pdf" target="_blank"
															style="color: #FF9400"><i class="material-icons prefix">download</i>Descargar</a></td>
												<td>20/Noviembre/2024</td>
											</tr>
											<tr>
												<td>$ 875.50</td>
												<td>WHITEFISH SOLVE TECH</td>
												<td>646180376610900003</td>
												<td>9642177</td>
												<td>9642177</td>
												<td><span class="badge rounded-pill bg-danger"><strong>Pendiente</strong></span></td>
												<td>No disponible</td>
												<td>05/Diciembre/2024</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div><!-- End Panes -->
				</div>
			</div>
		</div>
	</div>
</div>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/simple-datatables/umd/simple-datatables.js"></script>
<script src="/assets/libs/mobius1-selectr/selectr.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/jquery-3.7.1.min.js"></script>
<script src="/assets/js/company.js"></script>
</body>
<!--end body-->
</html>
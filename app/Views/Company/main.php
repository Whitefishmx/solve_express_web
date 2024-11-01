<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
	<?php $title = "Dashboard"; ?>
	<meta charset="utf-8" />
	<title><?php echo $title ?> | Rizz - Admin & Dashboard Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
	<meta content="" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="shortcut icon" href="/favicon.ico">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/CompanyExpress.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/_tables.scss" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	$iniciales = $iniciales ?? "JH";
	$name = $name ?? "James Hook";
	$company = $company ?? "WhiteFish";
?>
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
							class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
							aria-haspopup="false" aria-expanded="false">
						<i class="icofont-bell-alt"></i>
						<span class="alert-badge"></span>
					</a>
					<div class="dropdown-menu stop dropdown-menu-end dropdown-lg py-0">
						<h5 class="dropdown-item-text m-0 py-3 d-flex justify-content-between align-items-center">
							Notifications <a href="#" class="badge text-body-tertiary badge-pill">
								<i class="iconoir-plus-circle fs-4"></i>
							</a>
						</h5>
						<ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-1" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link mx-0 active" data-bs-toggle="tab" href="#All" role="tab" aria-selected="true">
									All <span class="badge bg-primary-subtle text-primary badge-pill ms-1">24</span>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link mx-0" data-bs-toggle="tab" href="#Projects" role="tab" aria-selected="false" tabindex="-1">
									Projects
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link mx-0" data-bs-toggle="tab" href="#Teams" role="tab" aria-selected="false" tabindex="-1">
									Team
								</a>
							</li>
						</ul>
						<div class="ms-0" style="max-height:230px;" data-simplebar>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="All" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
									<!-- item-->
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">2 min ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-wolf fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">Your order is placed</h6>
												<small class="text-muted mb-0">Dummy text of the printing and industry.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
									<!-- item-->
									
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">10 min ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-apple-swift fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">Meeting with designers</h6>
												<small class="text-muted mb-0">It is a long established fact that a reader.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
									<!-- item-->
									
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">40 min ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-birthday-cake fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">UX 3 Task complete.</h6>
												<small class="text-muted mb-0">Dummy text of the printing.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
									<!-- item-->
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">1 hr ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-drone fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">Your order is placed</h6>
												<small class="text-muted mb-0">It is a long established fact that a reader.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
									<!-- item-->
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">2 hrs ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-user fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">Payment Successfull</h6>
												<small class="text-muted mb-0">Dummy text of the printing.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
								</div>
								<div class="tab-pane fade" id="Projects" role="tabpanel" aria-labelledby="projects-tab" tabindex="0">
									<!-- item-->
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">40 min ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-birthday-cake fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">UX 3 Task complete.</h6>
												<small class="text-muted mb-0">Dummy text of the printing.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
									<!-- item-->
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">1 hr ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-drone fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">Your order is placed</h6>
												<small class="text-muted mb-0">It is a long established fact that a reader.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
									<!-- item-->
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">2 hrs ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-user fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">Payment Successfull</h6>
												<small class="text-muted mb-0">Dummy text of the printing.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
								</div>
								<div class="tab-pane fade" id="Teams" role="tabpanel" aria-labelledby="teams-tab" tabindex="0">
									<!-- item-->
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">1 hr ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-drone fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">Your order is placed</h6>
												<small class="text-muted mb-0">It is a long established fact that a reader.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
									<!-- item-->
									<a href="#" class="dropdown-item py-3">
										<small class="float-end text-muted ps-2">2 hrs ago</small>
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
												<i class="iconoir-user fs-4"></i>
											</div>
											<div class="flex-grow-1 ms-2 text-truncate">
												<h6 class="my-0 fw-normal text-dark fs-13">Payment Successfull</h6>
												<small class="text-muted mb-0">Dummy text of the printing.</small>
											</div><!--end media-body-->
										</div><!--end media-->
									</a><!--end-item-->
								</div>
							</div>
						
						</div>
						<!-- All-->
						<a href="pages-notifications.php" class="dropdown-item text-center text-dark fs-13 py-2">
							View All <i class="fi-arrow-right"></i>
						</a>
					</div>
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
								<h6 class="my-0 fw-medium text-dark fs-13"><?=$name;?></h6>
								<small class="text-muted mb-0"><?=$company;?></small>
							</div><!--end media-body-->
						</div>
						<div class="dropdown-divider mt-0"></div>
						<small class="text-muted px-2 pb-1 d-block">Account</small>
						<a class="dropdown-item" href="pages-profile.php"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Profile</a>
						<a class="dropdown-item" href="ecommerce-orders.php"><i class="las la-wallet fs-18 me-1 align-text-bottom"></i> Earning</a>
						<small class="text-muted px-2 py-1 d-block">Settings</small>
						<a class="dropdown-item" href="pages-profile.php"><i class="las la-cog fs-18 me-1 align-text-bottom"></i>Account Settings</a>
						<a class="dropdown-item" href="auth-lock-screen.php" target="_blank"><i class="las la-lock fs-18 me-1 align-text-bottom"></i>
							Lock</a>
						<a class="dropdown-item" href="pages-faq.php"><i class="las la-question-circle fs-18 me-1 align-text-bottom"></i> Help Center</a>
						<div class="dropdown-divider mb-0"></div>
						<a class="dropdown-item text-danger" href="auth-login.php"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
					</div>
				</li>
			</ul><!--end topbar-nav-->
		</nav>
		<!-- end navbar-->
	</div>
</div>
<div class="page-wrapper">
	<div class="page-content" style="width: 100%; margin-left: 0">
		<div class="container-xxl" style="margin-top: 15px;">
			
			<div class="col-md-12 col-lg-126">
				<div class="card">
					<div class="card-body pt-0" style="margin-top: 15px">
						<!-- Nav tabs -->
						<ul class="nav nav-pills nav-justified" role="tablist">
							<li class="nav-item waves-effect waves-light" role="presentation">
								<a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab" aria-selected="true">Inicio</a>
							</li>
							<li class="nav-item waves-effect waves-light" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="false" tabindex="-1">Graficas</a>
							</li>
						</ul>
						
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane p-3 active show" id="home-1" role="tabpanel">
								<div class="table-responsive">
									<div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
										<div class="datatable-top">
											<div class="datatable-dropdown">
												<label>
													<select class="datatable-selector" name="per-page">
														<option value="5">5</option>
														<option value="10" selected="">10</option>
														<option value="15">15</option>
														<option value="20">20</option>
														<option value="25">25</option>
													</select> entries per page
												</label>
											</div>
											<div class="datatable-search">
												<input
														class="datatable-input" placeholder="Search..." type="search" name="search" title="Search within table"
														aria-controls="datatable_1">
											</div>
										</div>
										<div class="datatable-container">
											<table class="table datatable datatable-table" id="datatable_1">
												<thead>
												<tr>
													<th data-sortable="true" style="width: 25.49019607843137%;">
														<button class="datatable-sorter">Name</button>
													</th>
													<th data-sortable="true" style="width: 10.51693404634581%;">
														<button class="datatable-sorter">Ext.</button>
													</th>
													<th data-sortable="true" style="width: 25.935828877005346%;">
														<button class="datatable-sorter">City</button>
													</th>
													<th data-format="DD/MM/YYYY" data-sortable="true" data-type="date" style="width: 18.983957219251337%;">
														<button class="datatable-sorter">Start Date</button>
													</th>
													<th data-sortable="true" style="width: 19.073083778966133%;">
														<button class="datatable-sorter">Completion</button>
													</th>
												</tr>
												</thead>
												<tbody>
												<tr data-index="0">
													<td>Unity Pugh</td>
													<td>9958</td>
													<td>Curicó</td>
													<td>2005/02/11</td>
													<td>37%</td>
												</tr>
												<tr data-index="1">
													<td>Theodore Duran</td>
													<td>8971</td>
													<td>Dhanbad</td>
													<td>1999/04/07</td>
													<td>97%</td>
												</tr>
												<tr data-index="2">
													<td>Kylie Bishop</td>
													<td>3147</td>
													<td>Norman</td>
													<td>2005/09/08</td>
													<td>63%</td>
												</tr>
												<tr data-index="3">
													<td>Willow Gilliam</td>
													<td>3497</td>
													<td>Amqui</td>
													<td>2009/29/11</td>
													<td>30%</td>
												</tr>
												<tr data-index="4">
													<td>Blossom Dickerson</td>
													<td>5018</td>
													<td>Kempten</td>
													<td>2006/11/09</td>
													<td>17%</td>
												</tr>
												<tr data-index="5">
													<td>Elliott Snyder</td>
													<td>3925</td>
													<td>Enines</td>
													<td>2006/03/08</td>
													<td>57%</td>
												</tr>
												<tr data-index="6">
													<td>Castor Pugh</td>
													<td>9488</td>
													<td>Neath</td>
													<td>2014/23/12</td>
													<td>93%</td>
												</tr>
												<tr data-index="7">
													<td>Pearl Carlson</td>
													<td>6231</td>
													<td>Cobourg</td>
													<td>2014/31/08</td>
													<td>100%</td>
												</tr>
												<tr data-index="8">
													<td>Deirdre Bridges</td>
													<td>1579</td>
													<td>Eberswalde-Finow</td>
													<td>2014/26/08</td>
													<td>44%</td>
												</tr>
												<tr data-index="9">
													<td>Daniel Baldwin</td>
													<td>6095</td>
													<td>Moircy</td>
													<td>2000/11/01</td>
													<td>33%</td>
												</tr>
												</tbody>
											</table>
										</div>
										<div class="datatable-bottom">
											<div class="datatable-info">Showing 1 to 10 of 11 entries</div>
											<nav class="datatable-pagination">
												<ul class="datatable-pagination-list">
													<li class="datatable-pagination-list-item datatable-hidden datatable-disabled">
														<button data-page="1" class="datatable-pagination-list-item-link" aria-label="Page 1">‹</button>
													</li>
													<li class="datatable-pagination-list-item datatable-active">
														<button data-page="1" class="datatable-pagination-list-item-link" aria-label="Page 1">1</button>
													</li>
													<li class="datatable-pagination-list-item">
														<button data-page="2" class="datatable-pagination-list-item-link" aria-label="Page 2">2</button>
													</li>
													<li class="datatable-pagination-list-item">
														<button data-page="2" class="datatable-pagination-list-item-link" aria-label="Page 2">›</button>
													</li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane p-3" id="profile-1" role="tabpanel">
								<p class="text-muted mb-0">
									Food truck fixie locavore, accusamus mcsweeney's
									single-origin coffee squid.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>


<!-- Javascript  -->
<!-- vendor js -->
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/datatable.init.js"
</body>
<!--end body-->
</html>
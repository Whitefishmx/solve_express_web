<div class="tab-pane p-3 active" id="provisionsTable" role="tabpanel">
	<div class="tab-content">
		<div class="card-body pt-0">
			<div class="row text-center" style="border: dashed var(--bs-border-color) 1px;border-radius: 10px; padding-bottom: 12px">
				<form class="align-items-center" style="margin-top: 5px">
					<div class="row align-items-center flex-wrap c-flex">
						<div class="col-sm-2">
							<label for="initDate" class="col-form-label">Fecha de Inicio</label>
							<input
									type="date" class="form-control bg-light" id="initDate" value="2024-08-01" min=min="2024-08-01"
									max="<?= date ( 'Y-m-d', strtotime ( 'now' ) ) ?>"></div>
						<div class="col-sm-2">
							<label for="endDate" class="col-form-label">Fecha de Fin</label>
							<input
									type="date" class="form-control bg-light" id="endDate"
									value="<?= date ( 'Y-m-d', strtotime ( 'now' ) ) ?>"
									min="2024-08-01"
									max="<?= date ( 'Y-m-d', strtotime ( 'now' ) ) ?>">
						</div>
						<div class="col-sm-2">
							<label for="curp" class="col-form-label">CURP</label>
							<input type="text" class="form-control bg-light" id="curp" placeholder="MUGH142563HFYRHD84">
						</div>
						<div class="col-sm-2">
							<label for="name" class="col-form-label">Nombre</label>
							<input type="text" class="form-control bg-light" id="name" placeholder="Juan Perez">
						</div>
						<div class="col-sm-2">
							<label for="period" class="col-form-label ">Periodo</label>
							<select id="period" class="form-select bg-light">
								<option value="">Todos</option>
							</select>
						</div>
						<div class="col-sm-2">
							<button type="button" class="form-control btn btn-lg btn-primary" id="searchReport" style="margin-top: 38px">
								Buscar <i class="fas fa-search"></i>
							</button>
						</div>
					</div>
			</div>
			<div class="row align-items-center" style="margin-top: 10px; border: dashed var(--bs-border-color) 1px; border-radius: 10px; padding-bottom: 12px">
				<div class="row align-items-center flex-wrap c-flex">
					<div class="col-sm-10 text-center">
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
					<div class="col-sm-2"></div>
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
					<th>CURP</th>
					<th>Salario Neto</th>
					<th>Monto adelantado</th>
					<th>Monto restante</th>
					<th>Periodo</th>
					<th>Fecha</th>
				</tr>
				</thead>
				<tbody id="companyResults">
				</tbody>
			</table>
		</div>
	</div>
</div>
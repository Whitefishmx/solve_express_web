<div class="tab-pane p-3" id="employeeTable" role="tabpanel">
	<div class="tab-content">
		<div class="card-body pt-0">
			<div class="row align-items-center" style="margin-top: 10px">
				<div class="row align-items-center flex-wrap c-flex">
					<div class="col-md-2 text-end">
						<label class="col-form-label">
							Descargar layout de nomina
							<a href="https://apisandbox.solve.com.mx/public/layoutDownloader/express_nomina.xlsx" target="_blank"
							   style="color: #FF9400"><i class="fas fa-download" style="font-size: 1.5rem"></i></a>
						</label>
					</div>
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
					<div class="col-sm-5 text-center">
						<label for="fireFile" class="col-form-label">
							Cargar baja de empleados
						</label>
						<form id="formFires" class="input-group" enctype="multipart/form-data">
							<div class="input-group">
								<input
									type="file" class="form-control bg-light" id="fireFile" aria-describedby="fireFile"
									aria-label="Cargar"
									accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
								<button class="btn btn-outline-secondary" type="button" id="upLoadFires">Cargar Bajas</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="text-center">
				<form class="align-items-center" style="margin-top: 5px">
					<div class="row align-items-center flex-wrap c-flex">
						<div class="col-sm-2">
							<label for="hiringDate" class="col-form-label">Fecha de Alta</label>
							<input
								type="date" class="form-control bg-light" id="hiringDate" value=""
								max="<?= date ( 'Y-m-d', strtotime ( 'now' ) ) ?>">
						</div>
						<div class="col-sm-2">
							<label for="fireDate" class="col-form-label">Fecha de baja</label>
							<input
								type="date" class="form-control bg-light" id="fireDate" value=""
								min="2024-10-01"
								max="<?= date ( 'Y-m-d', strtotime ( 'now' ) ) ?>">
						</div>
						<div class="col-sm-2">
							<label for="rfcFire" class="col-form-label">RFC</label>
							<input type="text" class="form-control bg-light" id="rfcFire" placeholder="MUGH142563R23">
						</div>
						<div class="col-sm-2">
							<label for="curpFire" class="col-form-label">CURP</label>
							<input type="text" class="form-control bg-light" id="curpFire" placeholder="MUGH142563HFYRHD84">
						</div>
						<div class="col-sm-2">
							<label for="nameFire" class="col-form-label">Nombre</label>
							<input type="text" class="form-control bg-light" id="nameFire" placeholder="Juan Perez">
						</div>
						<div class="col-sm-2 align-items-center">
							<label for="showFires" class="col-form-label">Mostrar bajas</label>
							<div class="form-check form-switch form-switch-danger col-sm-2" style="margin: auto">
								<input class="form-check-input text-center" type="checkbox" id="showFires" >
							</div>
						</div>
					</div>
			</div>
		
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="table-responsive">
			<table class="table datatable" id="fireEmployees">
				<thead class="table-light">
				<tr>
					<th>#Empleado</th>
					<th>Nombre</th>
					<th>CURP</th>
					<th>Clabe</th>
					<th>Fecha de alta</th>
					<th>Fecha de baja</th>
					<th>Dar de baja</th>
				</tr>
				</thead>
				<tbody id="fireResults"></tbody>
			</table>
		</div>
	</div>
</div>
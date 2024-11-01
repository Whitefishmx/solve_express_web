<script type="text/javascript" src="/./assets/js/employee.js"></script>
<div class="container" id="container">
	<div class="col s12">
		<ul class="tabs">
			<li class="tab col s3"><a class="active" href="#test1"  id="dashboard">Inicio</a></li>
			<li class="tab col s3"><a href="#test2" id="Disposiciones">Disposiciones</a></li>
			<li class="tab col s3"><a href="#test3">Pagos</a></li>
			<li class="tab col s3"><a href="#test4">Notificaciones</a></li>
		</ul>
	</div>
	<div id="test1" class="col s12" style="padding: 20px">
		<div class="">
			<div class="row">
				<h3 class="center-align" style="margin-top: 0; margin-bottom: 0">¿Cuánto dinero necesitas?</h3>
			</div>
			<div class="row">
				<div class="col s1"></div>
				<div class="col s4 dashboard-card">
					<div class="row center-align dashboard-alt ">Dias trabajados</div>
					<div class="row center-align dashboard-title" id="DashDays"></div>
				</div>
				<div class="col s2"></div>
				<div class="col s4 dashboard-card">
					<div class="row center-align dashboard-alt">Monto disponible</div>
					<div class="row center-align dashboard-title" id="DashAvailable"></div>
				</div>
				<div class="col s1"></div>
			</div>
			<div class="row dashboard-card" style="margin: auto 3rem auto 3rem;padding: 1rem;">
				<div class="row center-align"><h5>Solicitar:</h5></div>
				<div class="row center-align" style="font-size: 2.5rem; font-weight: bold">
					$ <input type="text" id="outRequestAmount" min="0" max="4000" step="50" value="1700"
					       style="width: 10rem; text-align: center; font-size: 2.5rem; font-weight: bold">
				</div>
				<div class="row center-align">
					<div class="col s1"></div>
					<div class="col s10 center-align">
						<label for="requestAmount">
							<input
									class="rangeInput"
									type="range" id="requestAmount" name="requestAmount"
									value="300" min="250" max="4000" step="50" />
						</label>
					</div>
					<div class="col s1"></div>
				</div>
				<div class="row center-align">
					<button id="reqPay" name="reqPay" type="submit" class="btn" style="width:
						15rem; color: var(--title-color) !important;font-weight: bold; border-radius: 15px;
						font-size: 1rem; height: 2.5rem">Solicitar adelanto</button>
				</div>
			</div>
			
		</div>
	</div>
	<div id="test2" class="col s12" style="padding: 20px">
		<table class="responsive-table">
			<thead>
			<tr>
				<th>Plan</th>
				<th>Periodo</th>
				<th>Monto pedido</th>
				<th>Monto restante</th>
				<th>Folio</th>
				<th>Num. Referencia</th>
				<th>Cuenta Clabe</th>
				<th>Banco</th>
				<th>CEP</th>
				<th>Fecha de Solicitud</th>
				<th>Fecha de Pago</th>
			</tr>
			</thead>
			<tbody id="resDisposition"></tbody>
		</table>
	</div>
	<div id="test3" class="col s12">No se encontraron pagos realizados</div>
	<div id="test4" class="col s12" style="color: rgba(0,0,0,0.53)">Vacío</div>
</div>


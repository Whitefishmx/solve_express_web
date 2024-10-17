<script type="text/javascript" src="/./assets/js/employee.js"></script>
<div class="container" id="container">
	<div class="col s12">
		<ul class="tabs">
			<li class="tab col s3"><a class="active" href="#test1">Inicio</a></li>
			<li class="tab col s3"><a href="#test2" id="Disposiciones">Disposiciones</a></li>
			<li class="tab col s3"><a href="#test3">Pagos</a></li>
			<li class="tab col s3"><a href="#test4">Notificaciones</a></li>
		</ul>
	</div>
	<div id="test1" class="col s12" style="padding: 20px">
		<div class="">
			<div class="row">
				<h3 class="center-align">¿Cuánto dinero necesitas?</h3>
			</div>
			<div class="row">
				<div class="col s1"></div>
				<div class="col s4 dashboard-card">
					<div class="row center-align dashboard-alt ">Dias trabajados</div>
					<div class="row center-align dashboard-title" id="DashDays"></div>
				</div>
				<div class="col s2"></div>
				<div class="col s4 dashboard-card" >
					<div class="row center-align dashboard-alt">Monto disponible</div>
					<div class="row center-align dashboard-title" id="DashAvailable"></div>
				</div>
				<div class="col s1"></div>
			</div>
			<div class="row dashboard-card">
				<div class="row center-align"><h5>Solicitar:</h5></div>
				<div class="row center-align"><h3 id="reqAmount">$ 250.00</h3></div>
				<div class="row center-align"></div>
			</div>
		</div>
		</div>
	</div>
	<div id="test2" class="col s12" style="padding: 20px">
		<table class="striped highlight responsive-table">
			<thead>
			<tr>
				<th>Plan</th>
				<th>Periodo</th>
				<th>Monto pedido</th>
				<th>Monto restante</th>
				<th>Folio</th>
				<th>Num. Referencia</th>
				<th>Cuenta</th>
				<th>Banco</th>
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
<div class="tab-pane p-3" id="invoiceTable" role="tabpanel">
	<div class="row justify-content-center">
		<div class="table-responsive">
			<table class="table datatable" id="tableInvoice">
				<thead class="table-light">
				<tr>
					<th>Monto a pagar</th>
					<th>Beneficiario</th>
					<th>Cuenta clabe</th>
					<th>Banco</th>
					<th>Numero de referencia</th>
					<th>Concepto</th>
					<th>Periodo</th>
					<th>Estatus</th>
					<th>CEP</th>
					<th>Fecha limite de pago</th>
					<th>Detalles</th>
				</tr>
				</thead>
				<tbody id="companyResults">
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-xl" id="paymentsDetails" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title m-0" id="myExtraLargeModalLabel">Detalle de pago</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-title ">
				<div class="col-sm-2 ms-auto text-end">
					<button type="button" class="btn btn-lg btn-primary text-center" style="display: inline-block; vertical-align: middle; margin: 10px 10px 0 0"
					        onclick="downloadDetailPaymentReport()">
						<i class="material-icons prefix" id="downloadPaymentDetail" style="vertical-align: middle;">download</i>
						<span style="vertical-align: middle;">Exportar</span>
					</button>
				</div>
			</div>
			<div class="modal-body" style="overflow-x: auto; max-width: 100%; overflow-y: auto; max-height: 100%">
				<table class="table datatable" id="detailsPaaymentTbl" style="table-layout: auto">
					<thead class="table-light">
					<tr>
						<th>#Empleado</th>
						<th>Nombre</th>
						<th>CURP</th>
						<th>Salario Neto</th>
						<th>Monto adelantado</th>
						<th>Monto depositado</th>
						<th>Comisión</th>
						<th>Monto restante</th>
						<th>Comprobante electrónico</th>
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
</div>
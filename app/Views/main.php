<div class="card" style="padding-left: 0; padding-right: 0;">
	<div class="card-body pt-0">
		<ul class="nav nav-pills nav-justified" role="tablist">
			<li class="nav-item waves-effect waves-light" role="presentation">
				<a class="nav-link active" data-bs-toggle="tab" href="#test1" role="tab" aria-selected="true" tabindex="-1">Inicio</a>
			</li>
			<li class="nav-item waves-effect waves-light" role="presentation">
				<a class="nav-link" data-bs-toggle="tab" href="#test2" role="tab" aria-selected="false" tabindex="-1" onclick="GetDisposiciones()">Disposiciones</a>
			</li>
			<li class="nav-item waves-effect waves-light" role="presentation">
				<a class="nav-link" data-bs-toggle="tab" href="#test3" role="tab" aria-selected="false" tabindex="-1">Notificaciones</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active p-3" id="test1" role="tabpanel" style="padding-top: 10px !important;">
				<h3 style="text-align: center; margin-bottom: 0">¿Cuánto dinero necesitas?</h3>
				<div class="container-fluid justify-content-center card cardback">
					<div class="row justify-content-center" style="padding: 10px 5px 0 5px">
						<div class="col-xs-3 col-md-3"><h5>Disposiciónes por:</h5></div>
						<div class="col-xs-2 col-md-2"><h4 id="dXD">Día: 1/2</h4></div>
						<div class="col-xs-3 col-md-3"><h4 id="dXQ">Quincena: 1/5</h4></div>
						<div class="col-xs-2 col-md-2"><h4 id="dXM">Mes: 1/10</h4></div>
					</div>
					<div class="row ">
						<div class="col-xs-6 col-sm-6">
							<div class="card cardback bordercard">
								<div class="" style="padding: 5px 0 0 0">
									<h5 class="card-title text-center" style="margin: 0;">Dias trabajados</h5>
								</div>
								<div class="" style="padding: 2px">
									<h2 class="text-center" style="font-weight: bold"><img src="assets/img/calendar.png" style="height: 1.7rem"> 13</h2>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6">
							<div class="card cardback bordercard">
								<div class="" style="padding: 5px 0 0 0">
									<h5 class="card-title text-center" style="margin: 0">Monto disponible</h5>
								</div>
								<div class="" id="DashAvailable" style="padding: 2px">
									<h2 class="text-center" style="font-weight: bold">$ 2,500.00</h2>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="card cardback bordercard">
								<div class="" style="padding: 5px 0 0 0">
									<h3 class="card-title text-center" style="margin: 0;">Monto</h3>
								</div>
								<div class="card-body text-center justify-content-center" style="padding-top: 0">
									<div class="row justify-content-center">
										<div class="col-xs-3 col-md-8" style="font-size: 2.5rem">
											<output id="outRequestAmount" class="dinero" style="font-weight: bold">$ 4,000</output>
											<input type="hidden" id="MontoReal" value="">
										</div>
										<div class="col-xs-3 col-md-8">
											<input
													id="requestAmount" name="requestAmount" type="range" value="" min="" max="" step="10"
													oninput="document.getElementById('MontoReal').value = this.value; outRequestAmount.value= '$ ' + Intl.NumberFormat('en-US').format(value); this.style.cssText = '';" />
										</div>
									</div>
									<div class="row justify-content-center" style="margin-top: 25px">
										<div class="col-xs-3 col-sm-10 ">
											<button
													id="reqPay" name="reqPay" type="submit" class="btn"
													onclick="document.getElementById('exampleModalScrollable').style.display='block'"
													style="width: 100%; color: var(--title-color) !important; font-size: 1rem; height: 2.5rem; letter-spacing: 0.1rem; margin-bottom: 1.5rem; background-color: #FF9400 !important;"
													data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Solicitar
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--	<div class="row justify-content-center">
						<div class="col-md-3 card cardback bordercard" style="height: 80px">
							<div class="card-body pt-1">
								<div class="card-header cardback" style="padding-bottom: 0.1rem;padding-top: .2rem;">
									<h3 class="card-title text-center">Peticiones por día</h3>
								</div>
								<div class="card-body pt-0" id="counterDay">
									<h2 class="text-center" style="font-weight: bold">1 / 10</h2>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card cardback bordercard" style="height: 80px">
								<div class="card-body pt-1">
									<div class="card-header cardback" style="padding-bottom: 0.1rem;padding-top: .2rem;">
										<h3 class="card-title text-center">Peticiones por quincena</h3>
									</div>
									<div class="card-body pt-0" id="counterBiweekly">
										<h2 class="text-center" style="font-weight: bold">1 / 10</h2>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 card cardback bordercard" style="height: 80px">
							<div class="card-body pt-1">
								<div class="card-header cardback" style="padding-bottom: 0.1rem;padding-top: .2rem;">
									<h3 class="card-title text-center">Peticiones por mes</h3>
								</div>
								<div class="card-body pt-0" id="counterMonth">
									<h2 class="text-center" style="font-weight: bold">1 / 10</h2>
								</div>
							</div>
						</div>
					</div>-->
<!--				<div class="row justify-content-center" style="height: 40px">-->
<!--					<div class="col-md-10 card cardback " style=" padding-left: 0; padding-right: 0; margin-bottom: 5px">-->
<!--						<div class="card-body pt-1" style="padding-bottom: .1rem">-->
<!--							<div class="row">-->
<!--								<div class="col-md-3"><h5>Disposiciónes por:</h5></div>-->
<!--								<div class="col-md-2"><h4 id="dXD">Día: 1/2</h4></div>-->
<!--								<div class="col-md-3"><h4 id="dXQ">Quincena: 1/5</h4></div>-->
<!--								<div class="col-md-2"><h4 id="dXM">Mes: 1/10</h4></div>-->
<!--							</div>-->
<!--							-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="row justify-content-center" style="height: 90px">-->
					<!--<div class="col-md-4 card cardback bordercard" style="height: 100px">
						<div class="" >
							<div class="card-body pt-1">
								<div class="card-body pt-0" id="counterBiweekly">
									<h5 class="card-title">Peticiones por día: 1 /10</h5>
									<h5 class="card-title ">Peticiones por quincena: 1 /10</h5>
									<h5 class="card-title">Peticiones por mes: 1 /10</h5>
								</div>
							</div>
						</div>
					</div>-->
<!--					<div class="col-md-5 card " style="height: 80px; padding-left: 0; padding-bottom: 2px">-->
<!--						<div class="card cardback bordercard" style="height: 80px; margin-bottom: 5px">-->
<!--							<div class="card-body pt-1" style="padding-bottom: 5px">-->
<!--								<div class="card-header cardback" style="padding-bottom: 0.1rem;padding-top: .2rem;">-->
<!--									<h3 class="card-title text-center">Dias trabajados</h3>-->
<!--								</div>-->
<!--								<div class="card-body pt-0" id="DashDays" style="padding-bottom: 0">-->
<!--									<h2 class="text-center" style="font-weight: bold"><img src="assets/img/calendar.png" style="height: 1.7rem"> 13</h2>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
					
<!--					<div class="col-md-5 card cardback bordercard" style="height: 80px; margin-bottom: 5px; padding-bottom: 2px">-->
<!--						<div class="card-body pt-1" style="padding-bottom: 5px">-->
<!--							<div class="card-header cardback" style="padding-bottom: 0.1rem; padding-top: .2rem;">-->
<!--								<h3 class="card-title text-center">Monto disponible</h3>-->
<!--							</div>-->
<!--							<div class="card-body pt-0" id="DashAvailable" style="padding-top: 0; padding-bottom: 0">-->
<!--								<h2 class="text-center" style="font-weight: bold">$ 2,500.00</h2>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				<div class="row justify-content-center">-->
<!--					<div class="col-md-10 card cardback bordercard">-->
<!--						<h3 class="text-center" style="font-size: 1.5rem; margin-top: 1.5rem; margin-bottom: 0;">Monto</h3>-->
<!--						<div class="col-md-12">-->
<!--							<div class="card-body text-center" style="padding-top: 0">-->
<!--								<div class="row justify-content-center">-->
<!--									<div class="col-md-8" style="font-size: 2.5rem">-->
<!--										<output id="outRequestAmount" class="dinero" style="font-weight: bold">$ 4,000</output>-->
<!--										<input type="hidden" id="MontoReal" value="">-->
<!--									</div>-->
<!--									<div class="col-md-8">-->
<!--										<input-->
<!--												id="requestAmount" name="requestAmount" type="range" value="" min="" max="" step="10"-->
<!--												oninput="document.getElementById('MontoReal').value = this.value; outRequestAmount.value= '$ ' + Intl.NumberFormat('en-US').format(value); this.style.cssText = '';" />-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--							<button-->
<!--									id="reqPay" name="reqPay" type="submit" class="btn"-->
<!--									onclick="document.getElementById('exampleModalScrollable').style.display='block'"-->
<!--									style="width: 100%; color: var(--title-color) !important; font-size: 1rem; height: 2.5rem; letter-spacing: 0.1rem; margin-bottom: 1.5rem; background-color: #FF9400 !important;"-->
<!--									data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Solicitar-->
<!--							</button>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
			</div>
			<div class="tab-pane p-3" id="test2" role="tabpanel">
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead class="table-light">
						<tr>
							<th style="text-align: center">Plan</th>
							<th style="text-align: center">Periodo</th>
							<th style="text-align: center">Monto solicitado</th>
							<th style="text-align: center">Monto restante</th>
							<th style="text-align: center">Folio</th>
							<th style="text-align: center">Num. Referencia</th>
							<th style="text-align: center">Cuenta Clabe</th>
							<th style="text-align: center">Banco</th>
							<th style="text-align: center">Comprobante de Pago</th>
							<th style="text-align: center">Fecha de Solicitud</th>
							<th style="text-align: center">Fecha de Pago</th>
						</tr>
						</thead>
						<tbody id="resDisposition"></tbody>
					</table><!--end /table-->
				</div>
			</div>
			<div class="tab-pane p-3 show" id="test3" role="tabpanel">
				<p class="text-muted mb-0">
					No se encontraron notificaciones.
				</p>
			</div>
		</div>
	</div>
</div>

<!--modal-->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" style="display: none;" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title m-0" id="exampleModalScrollableTitle">Detalles y Contrato</h6>
				<button
						type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
						style="background-color: #2b2d3c !important; color: #FFF !important;"></button>
			</div><!--end modal-header-->
			<div>
			</div>
			<div class="card cardback bordercard" style="height: 200px; margin-bottom: 0;">
				<div class="card-body pt-1">
					<h4 style="display: block; width: 100%; text-align: center; margin-top: 10px; margin-bottom: 20px !important;">Detalles de tu adelanto</h4>
					<p class="text-left" style="margin-bottom: 0.7rem !important; font-size: 0.9rem !important;">Tu solicitud: <span
								style="color: #26b719" id="solicitado"></span></p>
					<p class="text-left" style="margin-bottom: 0.7rem !important; font-size: 0.9rem !important;">Comisión: <span
								style="color: #26b719" id="comision"></span></p>
					<p class="text-left" style="margin-bottom: 0.7rem !important; font-size: 0.9rem !important;">Te depositamos: <span
								style="color: #26b719" id="depositamos"></span></p>
					<p class="text-left" style="margin-bottom: 0.7rem !important; font-size: 0.9rem !important;">CLABE: <span
								style="color: #26b719" id="cclabe"></span></p>
				</div>
			</div>
			<div class="modal-body" id="textDisclaimer">
			</div><!--end modal-body-->
			<div class="modal-footer">
				<button
						type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
						style="color: #FFF !important; border-color: #333333 !important; background-color: #333333 !important">Cerrar
				</button>
				<button
						type="button" class="btn btn-primary btn-sm"
						style="border-color: #FF9400 !important; background-color: #FF9400 !important; color: #fff !important;"
						onclick="RequestPay(); this.style.display = 'none'">Acepto
				</button>
			</div><!--end modal-footer-->
		</div><!--end modal-content-->
	</div><!--end modal-dialog-->
</div>


<style>
    :root {
        --base: #FF9400;
        --trackball: var(--base);
        --range: 0%;
    }

    input[type="range"] {
        -webkit-appearance: none;
        margin-right: 15px;
        min-width: 200px;
        max-width: 640px;
        width: 100%;
        height: 7px;
        background: #cccccc;
        border-radius: 5px;
        background-image: linear-gradient(#f4c27d, #f4c27d);
        background-size: 0% 100%;
        background-repeat: no-repeat;
    }

    [dir="rtl"] input[type="range"] {
        background: #FF9400;
        background-image: transparent;
        background-size: 30% 100%;
        background-repeat: no-repeat;
    }

    /* Input Thumb */
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: #FF9400;
        cursor: ew-resize;
        box-shadow: 0 0 2px 0 #555;
        transition: background .3s ease-in-out;
    }

    input[type="range"]::-moz-range-thumb {
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: #FF9400;
        cursor: ew-resize;
        box-shadow: 0 0 2px 0 #555;
        transition: background .3s ease-in-out;
    }

    input[type="range"]::-ms-thumb {
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: #FF9400;
        cursor: ew-resize;
        box-shadow: 0 0 2px 0 #555;
        transition: background .3s ease-in-out;
    }

    input[type="range"]::-webkit-slider-thumb:hover {
        background: #FF9400;
    }

    input[type="range"]::-moz-range-thumb:hover {
        background: #FF9400;
    }

    input[type="range"]::-ms-thumb:hover {
        background: #FF9400;
    }

    /* Input Track */
    input[type=range]::-webkit-slider-runnable-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }

    input[type=range]::-moz-range-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }

    input[type="range"]::-ms-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }

    #value {
        position: absolute;
        left: var(--range);
        top: 41%;
        font-size: 14px;
        color: var(--trackball);
        transition: 0.5s color ease;
    }
</style>
<script>
	//rellena los inputs range
	const rangeInputs = document.querySelectorAll("input[type=\"range\"]");
	let isRTL = document.documentElement.dir === "rtl";
	
	function handleInputChange(e) {
		let target = e.target;
		if (e.target.type !== "range") {
			target = document.getElementById("range");
		}
		const min = target.min;
		const max = target.max;
		const val = target.value;
		let percentage = (val - min) * 100 / (max - min);
		if (isRTL) {
			percentage = (max - val);
		}
		
		target.style.setProperty("background-size", percentage + "% 100%");
		
		
	}
	
	rangeInputs.forEach(input => {
		input.addEventListener("input", handleInputChange);
	});
	
	// Obtén los elementos del DOM
	
	
	// Función para actualizar la posición y el valor del rango


</script>

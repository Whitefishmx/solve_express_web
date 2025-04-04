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
					<div class="" style="padding: 2px" id="DashDays">
						<h2 class="text-center" style="font-weight: bold"><img src="../../../assets/img/calendar.png" style="height: 1.7rem"> 13</h2>
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
							<div class="col-xs-4 col-md-8">
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
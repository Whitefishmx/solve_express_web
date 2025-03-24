<div class="tab-pane p-3 show" id="test4" role="tabpanel" style="padding: 0 !important;">
	<?php
		//		$url = "https://api-solve.local/";
		$url = "https://sandbox.solvegcm.mx/";
	?>
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link" data-bs-toggle="tab" href="#cert" role="tab" aria-selected="false" tabindex="-1" id="certTab">Certificado</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link active" data-bs-toggle="tab" href="#assists" role="tab" aria-selected="true" tabindex="-1" id="aNb">Asistencias y Beneficios</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" data-bs-toggle="tab" href="#discounts" role="tab" aria-selected="false" tabindex="-1">Club de Descuentos</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane p-3" id="cert" role="tabpanel" style="padding: 0 !important; margin: 15px 0 0 0 !important;">
			<div class="row justify-content-center ">
				<div class="col-md-8" id="certImage">
				
				</div>
			</div>
			<div class="row justify-content-center" style="margin: 15px 0 0 0">
				<div
						class="col-xs-1 col-md-3 justify-content-center" style="text-align: center; display: flex; justify-content: center; align-items: center;"
						id="certDownload">
				
				</div>
			</div>
		</div>
		<div class="tab-pane p-3 active show" id="assists" role="tabpanel">
			<div class="row">
				<p style="font-size: 1.2rem">Estos son tus beneficios y asistencias disponibles. Para más información o para hacer uso de ellos, llámanos al
					<a href="tel:5588819169" style="color: var(--bs-primary)">5588819169</a>.
				</p>
			</div>
			<div class="row">
				<div class="accordion" id="accordionPanelsStayOpenExample">
				</div>
			</div>
			<div class="row">
				<p style="font-size: 1.2rem">Recuerda que puedes acceder a tus beneficios llamando al <a
							href="tel:5588819169" style="color: var(--bs-primary)
">5588819169</a>.</p>
			</div>
		</div>
		<div class="tab-pane p-3 justify-content-center" id="discounts" role="tabpanel">
			<!--<div class="row justify-content-center">
				<iframe src="https://app.desclub.com.mx/masservicios/?num_membresia=MASS412" style="width: 100%; max-width: 500px; height: 100%; min-height: 800px; margin: auto"></iframe>
			</div>-->
			<div class="row justify-content-center" style="margin: 15px 0 25px 0">
				<div class="col-md-5">
					<p class="mb-0" style="text-align: center; font-size: 1rem; line-height: 1.3rem">
						Descarga la app para acceder a tu club de descuentos
					</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-sm-6 d-flex flex-column align-items-center">
					<div class="row justify-content-center">
						<a
								href="https://play.google.com/store/apps/details?id=app.solve_express.mx" target="_blank">
							<img src="/assets/img/QR_solve_playStore.png" alt="qr" style="width: 250px">
						</a>
					</div>
					<div class="row justify-content-center">
						<a
								href="https://play.google.com/store/apps/details?id=app.solve_express.mx" target="_blank">
							<img src="/assets/img/PlayStore.svg" alt="googlePlay" style="width: 250px">
						</a>
					</div>
				</div>
				<div class="col-sm-6 d-flex flex-column align-items-center">
					<div class="row justify-content-center">
						<a href="https://apps.apple.com/mx/app/solve-express/id6743006696?l=en-GB" target="_blank">
							<img src="/assets/img/QR_solve_appStore.jpeg" alt="qr" style="width: 250px">
						</a>
					</div>
					<div class="row justify-content-center">
						<a href="https://apps.apple.com/mx/app/solve-express/id6743006696?l=en-GB" target="_blank">
							<img src="/assets/img/AppStore.svg" alt="googlePlay" style="width: 250px">
						</a>
					</div>
				</div>
			</div>
			<div class="row justify-content-center" style="margin: 45px 0 0 0 ">
				<div class="col-md-5 justify-content-center" style="text-align: center">
					<a href="https://api.solvegcm.mx/terminosMass" target="_blank" class="text-black" style="text-decoration: underline">
						Términos y condiciones de beneficios
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
    .text-accordion {
        font-size: 2rem;
    }
</style>
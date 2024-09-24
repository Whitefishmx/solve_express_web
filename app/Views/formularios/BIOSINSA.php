<link rel="stylesheet" href="/assets/css/formularios.css" type="text/css">
<form action="https://mesa-control.solveshop.xyz/saveForm" method="post">
	<input type="hidden" name="origen" value="17">
	<input type="hidden" name="environment" id="environment" value="SANDBOX">
	<div class="formulario">
		<div class="grupo">
			<label for="nombre">Nombre</label>
			<input type="text" id="nombre" name="nombre" required>
		</div>
		<div class="grupo">
			<label for="apellidos">Apellidos</label>
			<input type="text" name="apellidos" id="apellidos" required="">
		</div>
		<div class="grupo">
			<label for="telefono">Whatsapp</label>
			<input type="tel" name="telefono" id="telefono" pattern="\+52\d{10}" placeholder="+52" required="">
		</div>
		<div class="grupo">
			<label for="siWhats" style="width: 100%; text-align: justify">
				<input type="checkbox" name="siWhats" id="siWhats" value="1" required="" style="width: auto">
				Acepto recibir notificaciones y comunicaciones comerciales de SolveGCM por medio de WhatsApp, mensajes
				SMS y llamadas telefónicas.
			</label>
			<i class="fa-brands fa-whatsapp" style="color: #075E54; font-size: 20px;" aria-hidden="true"></i>
		</div>
		<div class="grupo">
			<label for="correoE">Correo Electrónico (opcional)
				<input type="text" name="correoE" id="correoE">
			</label>
		</div>
		<div class="grupo">
			<label for="correoE">RFC (opcional)
				<input type="text" name="rfc" id="rfc">
			</label>
		</div>
		<div class="grupo">
			<label style="width: 100%; text-align: justify">
				<input type="checkbox" name="politica" id="politica" value="1" required="" style="width: auto">
				He leído y acepto la <a
						href="https://www.solvegcm.mx/aviso-de-privacidad" target="_blank">política de privacidad</a>
			</label>
			<i class="fa-brands fa-whatsapp" style="color: #075E54; font-size: 20px;" aria-hidden="true"></i>
		</div>
		<script type="text/javascript" src="https://api.clientify.net/web-marketing/webforms/external/script/201618.js"></script>
		<div class="grupo">
			<label for="enviar">
				<input type="submit" name="enviar" id="enviar" value="Enviar">
			</label>
		</div>
	</div>
</form>
<script>
	document.getElementById("telefono").addEventListener("input", function (e) {
		let value = e.target.value;
		
		// Si el valor no empieza con +52, agregarlo
		if (!value.startsWith("+52")) {
			value = "+52" + value.replace(/[^0-9]/g, ""); // Quita caracteres no numéricos
		} else {
			// Remover cualquier carácter no numérico después del prefijo
			value = "+52" + value.slice(3).replace(/[^0-9]/g, "");
		}
		
		e.target.value = value;
	});
</script>


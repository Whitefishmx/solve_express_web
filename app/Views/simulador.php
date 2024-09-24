<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
	let p = "Q";
	const vPlazos = $("#plazos");
	function calculo_total(cantidad, plazo) {
		let pay;
		const total = cantidad * 1.48;
		$("#totalpagar").html("$ " + Intl.NumberFormat("es-MX", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		}).format(total));
		const pago = total / plazo;
		if (p === "Q") {
			pay = "Quincenal";
		} else if (p === "S") {
			pay = "Semanal";
		}
		vPlazos.html(plazo);
		$("#pagos").html("<h1>Pago " + pay + "</h1><p>$ " + Intl.NumberFormat("es-MX", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		}).format(pago) + "</p>");
	}
</script>
<link rel="stylesheet" href="/assets/css/formularios.css" type="text/css">
<style>
    .dinero {
        font-family: sans-serif;
        font-weight: bold;
        font-size: 30px;
        margin: 0 0 14px;
        color: #0a2240;
    }

    .rangeInput {
        -webkit-appearance: none;
        margin-right: 15px;
        min-width: 200px;
        max-width: 640px;
        width: 80%;
        height: 10px;
        background-size: 0 100% !important;
        border-radius: 15px;
        background: rgba(25, 220, 232, 0.6) linear-gradient(#2cbcf0, #146f90) no-repeat;
	    padding: 1px;
    }

    .rangeInput::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: radial-gradient(at top left, #2cbcf0 20%, #0a2240);
        cursor: pointer;
    }

    .rangeInput::-moz-range-thumb {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: radial-gradient(at top left, #2cbcf0 20%, #0a2240);
        cursor: pointer;
        border: none;
    }

    .rangeInput:hover {
        opacity: 1;
    }

    .button-group {
        flex-grow: 0;
        margin: 0;
    }

    .button-group input[type="radio"] {
        display: none;
    }

    .button-group label {
        display: inline-block;
        padding: 10px 20px;
        cursor: pointer;
        border: 1px solid #2b426d;
        background-color: #ffffff;
        color: #02375a;
        border-radius: 15px;
        transition: all ease 0.2s;
        text-align: center;
        flex-grow: 1;
        flex-basis: 0;
        width: 90px;
        font-size: 13px;
        margin: 5px;
        box-shadow: 0 0 25px -15px #000000;
    }

    .button-group input[type="radio"]:checked + label {
        background-color: #02375a;
        color: #ffffff;
        border: 1px solid #2b426d;
    }

    fieldset {
        border: 0;
        display: flex;
    }

    div h1 {
        font-size: 16px;
        font-family: sans-serif;
        color: #0a2240;
        margin: 14px 0;
    }

    .totales {
        width: 25%;
    }

    .leyenda {
        flex-grow: max();
    }
</style>
<form name="formSimulador" id="formSimulador" method="POST" class="container" action="/">
	<!-- Rango monto a prestar	-->
	<div style="display: block; width: 100%; text-align: center;">
		<div>
			<output id="outOverdraft" class="dinero">$ 4,000</output>
		</div>
		<div>
			<label for="overdraft">
				<input
						class="rangeInput"
						type="range" id="overdraft" name="overdraft"
						value="4000" min="4000" max="350000" step="1000" />
			</label>
		</div>
	</div>
	<div style="justify-content: center; text-align: center"><h1>¿A qué plazo?</h1></div>
	<!-- Radio buttons Semana Quincena	-->
	<div style="border: 0;  display: flex; text-align: center; justify-content: center;">
		<div class="button-group">
			<input type="radio" id="fortnightly" name="periodo" value="Q" checked="" />
			<label for="fortnightly">Quincenal</label>
		</div>
		<div class="button-group">
			<input type="radio" id="weekly" name="periodo" value="S" />
			<label for="weekly">Semanal</label>
		</div>
	</div>
	<!-- Rango plazo -->
	<div style="display: block; width: 100%; text-align: center;" id="plazo">
		<div>
			<output id="outMyPlazo" class="dinero" style="font-size: 24px;">12 Quincenas</output>
		</div>
		<div>
			<label for="overdraft">
				<input
						class="rangeInput" type="range" id="myPlazo" name="myPlazo" value="12" min="12" max="48"
						step="6" />
			</label>
		</div>
	</div>
	<!-- Recuadro de información -->
	<div
			style="display: flex; width: 90%; text-align: center; background-color: #f9f7f7; flex-direction: column;
			 margin: 15px auto; border: 1px solid black;">
		<div style="display: flex">
			<div class="totales">
				<h1>Total a pagar*</h1>
				<p id="totalpagar">$ 5,920.00</p>
			</div>
			<div class="totales">
				<h1>Periodo*</h1>
				<p id="periodo">Quincenal</p>
			</div>
			<div class="totales">
				<h1>Plazo*</h1>
				<p id="plazos">12</p>
			</div>
			<div class="totales" id="pagos">
				<h1>Pago Quincenal*</h1>
				<p>$ 493.33</p>
			</div>
		</div>
		<div class="leyenda">
			<p>*Los valores son estimados y varían según las condiciones de cada empresa y trabajador.</p>
		</div>
	</div>
	<!-- formularios -->
	<div>
		<h1 style="display: block; text-align: center; color: #0d2240; font size: 30px; font-family: sans-serif;">
			Déjanos tus datos y nos estaremos comunicando contigo en menos de 24 horas</h1>
		<div>
			<span><strong>Selecciona la empresa en la que trabajas</strong></span>
			<label for="empresa">
				<select name="empresa" id="empresa" required>
					<option value="0">Selecciona</option>
					<option value="17">BIOSINSA</option>
					<option value="16">ESTADO DE QUINTANA ROO</option>
					<option value="21">ESTADO DE SONORA</option>
					<option value="11">INDUSTRIAS CAZEL</option>
					<option value="9">MUNICIPIO DE AHOME</option>
					<option value="1">MUNICIPIO DE DURANGO</option>
					<option value="12">SEED DURANGO</option>
					<option value="20">TRANSPORTES CAZEL</option>
					<option value="0">Otra</option>
					<!--	--><?php
						/*				include ( '../conexion.php' );
										$ResEmpresas = mysqli_query ( $conn, "SELECT Id, Nombre FROM empresas WHERE Simulador = 1 ORDER BY Nombre ASC" );
										while ( $RResE = mysqli_fetch_array ( $ResEmpresas ) ) {
											echo '<option value="'.$RResE[ "Id" ].'">'.$RResE[ "Nombre" ].'</option>';
										}
									*/ ?>
				</select>
			</label>
			<span>Por favor espera a que cargue el formulario</span>
		</div>
	</div>
<!--	<script type="text/javascript" src="https://api.clientify.net/web-marketing/superforms/script/183873.js"></script>-->
	<div id="divFrame" style="display: block">
		<iframe
				src="https://apps.clientify.net/formbuilderembed/simpleembed/#/forms/embedform/183873/56417" width="80%"
				height="950" style="margin-top: -25px"></iframe>
	</div>
	<input type="submit" name="enviar" id="enviar"/>
	
</form>
<script type="text/javascript">
	$(document).ready(function () {
		const cantidad = $("#overdraft");
		const plazo = $("#myPlazo");
		const vPeriodo = $("#periodo");
		$("input[name='periodo']").on("change", function () {
			if ($(this).val() === "S") {
				p = "S";
				plazo.attr("min", "25");
				plazo.attr("max", "155");
				plazo.attr("step", "10");
				plazo.attr("value", "25");
				plazo.val(25);
				plazo.empty();
				plazo.css("cssText", "background-size: 0% 100% !important;");
				$("#outMyPlazo").val("25 Semanas");
				vPeriodo.html("Semanal");
			}
			if ($(this).val() === "Q") {
				p = "Q";
				plazo.attr("min", "12");
				plazo.attr("max", "72");
				plazo.attr("step", "6");
				plazo.attr("value", "12");
				plazo.val(12);
				plazo.empty();
				plazo.css("cssText", "background-size: 0% 100% !important;");
				$("#outMyPlazo").val("12 Quincenas");
				vPeriodo.html("Quincenal");
			}
			vPlazos.html(plazo.val());
			calculo_total(cantidad.val(), plazo.val());
		});
		cantidad.on("input", function () {
			let rangeMin = $(this).attr("min");
			let rangeMax = $(this).attr("max");
			let value = this.value;
			$("#outOverdraft").val("$ " + Intl.NumberFormat("en-US").format(value));
			calculo_total(value, plazo.val());
			const percentageFromValue = ((value - rangeMin) / (rangeMax - rangeMin)) * 100;
			$(this).css("cssText", "background-size: " + percentageFromValue + "% 100% !important;");
			
		});
		plazo.on("input", function () {
			const rangeMin = $(this).attr("min");
			const rangeMax = $(this).attr("max");
			const value = this.value;
			const percentageFromValue = ((value - rangeMin) / (rangeMax - rangeMin)) * 100;
			$(this).css("cssText", "background-size: " + percentageFromValue + "% 100% !important;");
			if (p === "Q") {
				$("#outMyPlazo").val(Intl.NumberFormat("en-US").format(value) + " Quincenas");
			} else {
				$("#outMyPlazo").val(Intl.NumberFormat("en-US").format(value) + " Semanas");
			}
			vPlazos.html(plazo.val());
			calculo_total(cantidad.val(), value);
		});
		$("#empresa").on("change", function () {
			console.log(this.value);
		});
		$('#formSimulador').on('submit', function (e) {
			e.preventDefault();
		});
	});
	
	function getEmpresas() {
	
	}
</script>
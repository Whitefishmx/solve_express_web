<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">
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
		$("#plazos").html(plazo);
		$("#pagos").html("<h1>Pago " + pay + "</h1><p>$ " + Intl.NumberFormat("es-MX", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		}).format(pago) + "</p>");
	}
</script>
<link rel="stylesheet" href="/assets/css/formularios.css" type="text/css">
<style>
    .dinero {
        font-family: poppins;
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
        height: 23px;
        background-size: 0 100% !important;
        border-radius: 15px;
        background: rgba(225, 217, 255, 0.73) linear-gradient(#78a6ff, #0658f6) no-repeat;
        padding: 0;
        border: 1px solid #0658f6;
    }

    .rangeInput::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: radial-gradient(at top left, #0658f6 20%, #0658f6);
        cursor: pointer;
    }

    .rangeInput::-moz-range-thumb {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: radial-gradient(at top left, #84afff 20%, #0658f6);
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
        border: 1px solid #0658f6;
        background-color: #ffffff;
        color: #0658f6;
        border-radius: 15px;
        transition: all ease 0.2s;
        text-align: center;
        flex-grow: 1;
        flex-basis: 0;
        width: 90px;
        font-size: 13px;
        margin: 5px;
        box-shadow: 0 0 25px -15px #000000;
	    font-family: poppins;
    }

    .button-group input[type="radio"]:checked + label {
        background-color: #0658f6;
        color: #ffffff;
        border: 0 solid #0658f6;
    }

    fieldset {
        border: 0;
        display: flex;
    }

    div h1 {
        font-size: 2vw;
        font-family: poppins;
        color: #ffffff;
        margin: 14px 0;
    }
    div p{
        font-size: 1.5vw;
        font-family: poppins;
        color: #ffffff;
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
	<div style="display: block; width: 100%; text-align: center; margin-top: 10px" id="plazo">
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
			style="display: flex; width: 90%; text-align: center; background-color: #0658f6; flex-direction: column;
			 margin: 25px auto; border: 0 solid black; color: #ffffff; font-weight: bold; font-family: poppins;
			 border-radius: 15px; ">
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
		$("#formSimulador").on("submit", function (e) {
			e.preventDefault();
		});
	});
	
	function getEmpresas() {
	
	}
</script>
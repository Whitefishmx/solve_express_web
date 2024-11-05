$(document).ready(function () {
	GetDashboard();
	$(".tabs").tabs({swipeable: false});
	const toggleButton = document.getElementById("theme-toggle");
	const cantidad = $("#requestAmount");
	const rangeOutput = document.getElementById("outRequestAmount");
	const rangeInput = document.querySelector("input[type=\"range\"]");
	$("#Disposiciones").on("click", GetDisposiciones);
	$("#dashboard").on("click", GetDashboard);
	rangeInput.addEventListener("input", function () {
		const value = (this.value - this.min) / (this.max - this.min) * 100;
		this.style.background = `linear-gradient(to right, var(--main-color) ${value}%, #ddd ${value}%)`;
	});
	cantidad.on("input", function () {
		let rangeMin = $(this).attr("min");
		let rangeMax = $(this).attr("max");
		let value = this.value;
		$("#outRequestAmount").val(Intl.NumberFormat("en-US").format(value));
	});
	rangeOutput.addEventListener("input", function () {
		rangeInput.value = this.value; // Actualiza el valor del rango
		const value = (rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min) * 100;
		rangeInput.style.background = `linear-gradient(to right, var(--main-color) ${value}%, #ddd ${value}%)`;
	});
	$("#reqPay").on("click", RequestPay);
});

function GetDisposiciones() {
	$.ajax({
		url: "/disposiciones",
		type: "POST",
		processData: false,
		contentType: false,
		beforeSend: function () {
			const obj = $("#mainContainer");
			const left = obj.offset().left;
			const top = obj.offset().top;
			const width = obj.width();
			const height = obj.height();
			$("#Loader").delay(50000).css({
				display: "block",
				opacity: 1,
				visibility: "visible",
				left: left,
				top: top,
				width: width,
				height: height,
				zIndex: 999999
			}).focus();
		},
		success: function (response) {
			let resContainer = $("#resDisposition");
			resContainer.empty();
			if (response.error !== 200) {
				resContainer.append("<tr><td  colspan=\"10\" style=\"text-align: center\">No hay peticiones aun<tr></tr></tr>");
			} else {
				let tableRes = "";
				$.each(response.response, function (index, value) {
					let url = "https://apisandbox.solve.com.mx/public/";
					let cep = "No disponible";
					if (value["cep"] != null) {
						cep = "<a href='' target='_blank' style=\"color: #FF9400\"><i class=\"material-icons prefix\">download</i>Descargar</a>";
					}
					let plan = "Quincenal";
					if (value.plan === "q") {
						plan = "Quincenal";
					} else if (value.plan === "m") {
						plan = "Mensual";
					} else if (value.plan === "s") {
						plan = "Semanal";
					}
					tableRes += "<tr>" +
						"<td>" + plan + "</td>" +
						"<td>" + value.period + "</td>" +
						"<td>" + value["requested_amount"] + "</td>" +
						"<td>" + value["remaining_amount"] + "</td>" +
						"<td>" + value["folio"] + "</td>" +
						"<td>" + value["noReference"] + "</td>" +
						"<td>" + value["clabe"] + "</td>" +
						"<td>" + value["bnk_alias"] + "</td>" +
						"<td>" + cep + "</td>" +
						"<td>" + value["Fecha_solicitud"] + "</td>" +
						"<td>" + value["Ultima_modificacion"] + "</td>";
				});
				resContainer.append(tableRes);
			}
			
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function (status) {
			// Maneja los errores de la solicitud
			console.error("Error en la solicitud:", status);
		}
	});
}

function GetDashboard() {
	$.ajax({
		url: "/dashboardEmployee",
		type: "POST",
		processData: false,
		contentType: false,
		beforeSend: function () {
			const obj = $("#mainContainer");
			const left = obj.offset().left;
			const top = obj.offset().top;
			const width = obj.width();
			const height = obj.height();
			$("#Loader").delay(50000).css({
				display: "block",
				opacity: 1,
				visibility: "visible",
				left: left,
				top: top,
				width: width,
				height: height,
				zIndex: 999999
			}).focus();
		},
		success: function (response) {
			const cantidad = $("#requestAmount");
			const rangeInput = document.querySelector("input[type=\"range\"]");
			var valorAlto;
			
			$('#nombreuser').html(response.response.name + ' ' + response.response.last_name);
			$('.iniciales').html(response.response.name.charAt(0) + response.response.last_name.charAt(0));
			$('#company').html(response.response.short_name);

			$("#DashDays").html('<h2 class="text-center" style="font-weight: bold"><img src="assets/img/calendar.png" style="height: 1.7rem"> ' + response.response.worked_days + '</h2>');
			$("#DashAvailable").html('<h2 class="text-center" style="font-weight: bold">$ ' + Intl.NumberFormat("en-US").format(response.response.amount_available ) + '</h2>');
			
			cantidad.attr("min", response.response.min_amount);
			if(parseFloat(response.response.amount_available) <= parseFloat(response.response.max_amount)) {
				cantidad.attr("max", response.response.amount_available);
				valorAlto = response.response.amount_available;
			} else {
				cantidad.attr("max", (response.response.max_amount));
				valorAlto = response.response.max_amount;
			}
			const valorMedio = (parseFloat(response.response.min_amount) + parseFloat(valorAlto)) / 2;
			rangeInput.value = Math.round(valorMedio);	
			$("#outRequestAmount").val('$ ' + Intl.NumberFormat("en-US").format(Math.round(valorMedio)));
			$("#MontoReal").val(valorMedio);
			const value = (rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min) * 100;
			rangeInput.style.background = `linear-gradient(to right, #f4c27d ${value}%, #ddd ${value}%)`;

			let montoReal = parseFloat($('#MontoReal').val()); // Actualiza montoReal en tiempo real
			let commission = parseFloat(response.response.commission);
			$('#solicitado').html('$ ' + Intl.NumberFormat("en-US").format(Math.round(montoReal)));
			$('#comision').html('$ ' + Intl.NumberFormat("en-US").format(Math.round(commission)));
			const depositado = montoReal - commission;
			$('#depositamos').html('$ ' + Intl.NumberFormat("en-US").format(Math.round(depositado)));
			$('#cclabe').html(response.response.clabe);
			
			$('#requestAmount').on('input', function() {
				let montoReal = parseFloat($('#MontoReal').val()); // Actualiza montoReal en tiempo real
				let commission = parseFloat(response.response.commission);
				$('#solicitado').html('$ ' + Intl.NumberFormat("en-US").format(Math.round(montoReal)));
				$('#comision').html('$ ' + Intl.NumberFormat("en-US").format(Math.round(commission)));
				const depositado = montoReal - commission;
				$('#depositamos').html('$ ' + Intl.NumberFormat("en-US").format(Math.round(depositado)));
			});
			
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function (status) {
			// Maneja los errores de la solicitud
			console.error("Error en la solicitud:", status);
		}
	});
}

function RequestPay() {
	let amount = $("#MontoReal").val();
	let resContainer = $("#mainContainer");
	var texto;
	console.log(amount);
	$.ajax({
		url: "/requestPay",
		data: {
			amount: amount
		},
		dataType: "JSON",
		method: "POST",
		beforeSend: function () {
			const obj = $("#mainContainer");
			const left = obj.offset().left;
			const top = obj.offset().top;
			const width = obj.width();
			const height = obj.height();
			$("#Loader").delay(50000).css({
				display: "block",
				opacity: 1,
				visibility: "visible",
				left: left,
				top: top,
				width: width,
				height: height,
				zIndex: 999999
			}).focus();
		},
		success: function (response) {
			console.log(response);
			
			if (response.error == 200)
			{
				texto = '<div class="alert alert-info mb-0 border-2" role="alert"><h4 class="alert-heading font-18">' + response.description + '</h4><p>' + response.response + '</p></div>';
			} else {
				texto = '<div class="alert alert-danger alert-dismissible fade show shadow-sm border-theme-white-2 mb-0" role="alert"><div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1"><i class="fas fa-xmark align-self-center mb-0 text-white "></i></div><strong>' + response.description + '</strong> ' + response.reason + '</div>';
				
			}
			console.log(texto);
			$('#texto_modal').html(texto);
		},	
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function (status) {
			// Maneja los errores de la solicitud
			console.error("Error en la solicitud:", status);
			console.log(status.responseJSON.reason);

			texto = '<div class="alert alert-danger alert-dismissible fade show shadow-sm border-theme-white-2 mb-0" role="alert"><div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1"><i class="fas fa-xmark align-self-center mb-0 text-white "></i></div><h4 class="alert-heading font-18">' + status.responseJSON.description + '</h4><p>' + status.responseJSON.reason + '</p></div>';
				
			$('#texto_modal').html(texto);
		}
	});

	
}
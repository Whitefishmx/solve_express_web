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
					let url = "https://api-solve.local/";
					let cep = "No disponible";
					if (value["cep"] != null) {
						cep = "<a href='' target='_blank' ><i class=\"material-icons prefix\">download</i>Descargar</a>";
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
			$("#DashDays").html(response.response.worked_days);
			$("#DashAvailable").html(response.response.amount_available);
			cantidad.attr("min", response.response.min_available);
			cantidad.attr("max", response.response.amount_available);
			const valorMedio = (parseFloat(response.response.min_available) + parseFloat(response.response.amount_available)) / 2;
			rangeInput.value = Math.round(valorMedio);
			$("#outRequestAmount").val(Math.round(valorMedio));
			const value = (rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min) * 100;
			rangeInput.style.background = `linear-gradient(to right, var(--main-color) ${value}%, #ddd ${value}%)`;
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
	let amount = $("#outRequestAmount").val();
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
			M.Toast.dismissAll();
			toastHTML = "<span>" + response.response + "</span>" +
				"<button onclick='M.Toast.dismissAll()' class='btn-flat toast-action'>" +
				"<span class='material-icons' style='display: block; color: white;'>cancel</span></button>";
			M.toast({html: toastHTML, displayLength: 20000, duration: 20000});
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
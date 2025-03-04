let url = "https://api.solvegcm.mx/";
// let url = "https://sandbox.solvegcm.mx/";
let nRead = [];
let nTotal = [];
$(document).ready(function () {
	verificarToken();
	GetDashboard();
	getDisclaimer();
	getNotifications();
	if ($("#aNb").length > 0) {
		$("#tabBen").on("click", function () {
			getBenefits();
		});
	}
	const toggleButton = document.getElementById("theme-toggle");
	const cantidad = $("#requestAmount");
	const rangeOutput = document.getElementById("outRequestAmount");
	const rangeInput = document.querySelector("input[type=\"range\"]");
	$("#Disposiciones").on("click", GetDisposiciones);
	$("#dashboard").on("click", GetDashboard);
	rangeInput.addEventListener("input", function () {
		const value = (this.value - this.min) / (this.max - this.min) * 100;
		this.style.background = `linear-gradient(to right, var(--range-color) ${value}%, #ddd ${value}%)`;
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
		rangeInput.style.background = `linear-gradient(to right, var(--range-color) ${value}%, #ddd ${value}%)`;
	});
	$("#reqPay").on("click", getDisclaimer);
	$("#aNb").on("click", function () {
		getBenefits();
	});
	$("#certTab").on("click", function () {
		getCerts();
	});
});

function GetDisposiciones() {
	verificarToken();
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
					let url = "https://api.solvegcm.mx/cepDownloader/";
					//let url = "https://api-solve.local/cepDownloader/";
					let cep = "En proceso";
					console.log(value);
					if (value["cep"] != null) {
						cep = "<a href='" + url + value["cep"] + "' target='_blank' style=\"color: #FF9400\"><i class=\"material-icons prefix\">download</i>Descargar</a>";
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
						"<td>$ " + Intl.NumberFormat("en-US").format(Math.round(value["requested_amount"])) + "</td>" +
						"<td>$ " + Intl.NumberFormat("en-US").format(Math.round(value["remaining_amount"])) + "</td>" +
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
	verificarToken();
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
			$("#dXD").html("Día: " + response["response"]["req_day"] + " / " + response["response"]["limit_day"]);
			$("#dXQ").html("Quincena: " + response["response"]["req_biweekly"] + " / " + response["response"]["limit_biweekly"]);
			$("#dXM").html("Mes: " + response["response"]["req_month"] + " / " + response["response"]["limit_month"]);
			
			$("#nombreuser").html(response.response.name + " " + response.response.last_name);
			$(".iniciales").html(response.response.name.charAt(0) + response.response.last_name.charAt(0));
			$("#company").html(response.response.short_name);
			
			$("#DashDays").html("<h2 class=\"text-center\" style=\"font-weight: bold\"><img src=\"assets/img/calendar.png\" style=\"height: 1.7rem\"> " + response.response.worked_days + "</h2>");
			$("#DashAvailable").html("<h2 class=\"text-center\" style=\"font-weight: bold\">$ " + Intl.NumberFormat("en-US").format(parseInt(response.response.amount_available)) + "</h2>");
			
			cantidad.attr("min", response.response.min_amount);
			if (parseFloat(response.response.amount_available) <= parseFloat(response.response.max_amount)) {
				cantidad.attr("max", response.response.amount_available);
				valorAlto = response.response.amount_available;
			} else {
				cantidad.attr("max", (response.response.max_amount));
				valorAlto = response.response.max_amount;
			}
			const valorMedio = (parseFloat(response.response.min_amount) + parseFloat(valorAlto)) / 2;
			rangeInput.value = Math.round(valorMedio);
			$("#outRequestAmount").val("$ " + Intl.NumberFormat("en-US").format(Math.round(valorMedio)));
			$("#MontoReal").val(valorMedio);
			const value = (rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min) * 100;
			rangeInput.style.background = `linear-gradient(to right, #f4c27d ${value}%, #ddd ${value}%)`;
			
			let montoReal = parseFloat($("#MontoReal").val()); // Actualiza montoReal en tiempo real
			let commission = parseFloat(response.response.commission);
			$("#solicitado").html("$ " + Intl.NumberFormat("en-US").format(Math.round(montoReal)));
			$("#comision").html("$ " + Intl.NumberFormat("en-US").format(Math.round(commission)));
			const depositado = montoReal - commission;
			$("#depositamos").html("$ " + Intl.NumberFormat("en-US").format(Math.round(depositado)));
			$("#cclabe").html(response.response.clabe);
			
			$("#requestAmount").on("input", function () {
				let montoReal = parseFloat($("#MontoReal").val()); // Actualiza montoReal en tiempo real
				let commission = parseFloat(response.response.commission);
				$("#solicitado").html("$ " + Intl.NumberFormat("en-US").format(Math.round(montoReal)));
				$("#comision").html("$ " + Intl.NumberFormat("en-US").format(Math.round(commission)));
				const depositado = montoReal - commission;
				$("#depositamos").html("$ " + Intl.NumberFormat("en-US").format(Math.round(depositado)));
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
	verificarToken();
	let amount = $("#MontoReal").val();
	let resContainer = $("#mainContainer");
	var texto;
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
			
			if (response.error == 200) {
				texto = "<div class=\"alert alert-info mb-0 border-2\" role=\"alert\"><h4 class=\"alert-heading font-18\">" + response.description + "</h4><p>" + response.response + "</p></div>";
			} else {
				texto = "<div class=\"alert alert-danger alert-dismissible fade show shadow-sm border-theme-white-2 mb-0\" role=\"alert\"><div class=\"d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1\"><i class=\"fas fa-xmark align-self-center mb-0 text-white \"></i></div><strong>" + response.description + "</strong> " + response.reason + "</div>";
			}
			console.log(texto);
			$("#textDisclaimer").html(texto);
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function (status) {
			// Maneja los errores de la solicitud
			// console.error("Error en la solicitud:", status);
			// console.log(status.responseJSON.reason);
			
			texto = "<div class=\"alert alert-danger alert-dismissible fade show shadow-sm border-theme-white-2 mb-0\" role=\"alert\"><div class=\"d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1\"><i class=\"fas fa-xmark align-self-center mb-0 text-white \"></i></div><h4 class=\"alert-heading font-18\">" + status.responseJSON.description + "</h4><p>" + status.responseJSON.reason + "</p></div>";
			
			$("#textDisclaimer").html(texto);
		}
	});
	
	
}

function getDisclaimer() {
	verificarToken();
	$.ajax({
		url: "/getLaws",
		data: {
			type: 3
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
			$("#textDisclaimer").append(response["response"]);
			$("#textDisclaimer").html(response["response"]);
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

function getBenefits() {
	verificarToken();
	$.ajax({
		url: "/getBenefits",
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
			let acordeon = $("#accordionPanelsStayOpenExample");
			let item = "";
			let counter = 0;
			acordeon.empty();
			$.each(response["response"], function (index, value) {
				item += `<div class="accordion-item">
<h5 class="accordion-header">
<button class="accordion-button fw-semibold collapsed text-light text-accordion" type="button" data-bs-toggle="collapse"
data-bs-target="#panelsStayOpen-collapse${counter}" aria-expanded="false" aria-controls="panelsStayOpen-collapse${counter}" style="font-size: 1rem !important;">
<img src="${url}/benefitsIco/${value["icon_dark"]}" alt="Icono" class="icon-img" style="height: 2rem;"/>${value["title"]}</button></h5>
<div id="panelsStayOpen-collapse${counter}" class="accordion-collapse collapse" style=""><div class="accordion-body">${value["description"]}</div></div></div>`;
				counter++;
			});
			acordeon.append(item);
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

function getCerts() {
	verificarToken();
	$.ajax({
		url: "/getCerts",
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
			let showImage = `<img src="${url}${response["response"]["show"]}" alt="certificado" class="img-fluid rounded" />`;
			let downloadImage = `<button
							type="button" class="btn btn-lg btn-primary text-light" onclick="window.open('${url}${response["response"]["download"]}',
							'_blank')" style="  display: flex; align-items: center;justify-content: center; gap: 5px;">
						<i class="material-icons prefix">download</i>Descargar
					</button>`;
			$("#certImage").html(showImage);
			$("#certDownload").html(downloadImage);
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

function getNotifications() {
	verificarToken();
	$.ajax({
		url: "/getNotifications",
		dataType: "JSON",
		method: "POST",
		success: function (response) {
			nRead = [];
			nTotal = [];
			let counter = 0;
			let notifications = "";
			$.each(response.response, function (index, value) {
				let markRead = `<i class="fas fa-asterisk text-secondary"></i> `;
				if (parseInt(value["web"]) === 1) {
					counter++;
					nTotal.push(value["id"]);
					if (parseInt(value["read"]) === 1) {
						nRead.push(value["id"]);
						markRead = ``;
					}
					let title = JSON.stringify(value["title"]);
					let body = JSON.stringify(value["body"]);
					notifications += `
			            <div class="card cardback bordercard bg-body-tertiary">
			                <div class="card-body">
			                    <div class="row">
			                        <div class="col-md-10">
			                            <div class="d-flex align-items-center">
			                                <div class="flex-grow-1 ms-2 text-truncate">
			                                    <h6 class="my-1 fw-medium text-dark fs-14">
			                                        ${markRead}${value["title"]}
			                                        <small class="text-muted ps-2">${value["date"]}</small>
			                                    </h6>
			                                    <p class="text-muted mb-0 text-wrap">${value["subtitle"]}</p>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="col-md-2 text-end align-self-center mt-sm-2 mt-lg-0">
			                            <button type="button"
			                                onclick="setNotificationData('${value["title"]}','${value["body"]}','${value["id"]}' )"
			                                class="btn btn-primary btn-sm px-2 text-light"
			                                data-bs-toggle="modal"
			                                data-bs-target="#notificationModal">Ver</button>
			                            <button type="button" class="btn btn bg-danger-subtle text-secondary btn-sm" onclick="deleteOneNotification('${value["id"]}')">
			                                <i class="fas fa-trash text-danger"></i>
			                            </button>
			                        </div>
			                    </div>
			                </div>
			            </div>`;
				}
			});
			counter = counter - (nRead.length);
			if (counter >= 1) {
				$("#countNotifications").html(counter);
				$("#count4Read").html(counter);
			} else if (counter === 0) {
				$("#countNotifications").html("");
				$("#count4Read").html("");
			}
			if (nTotal.length >= 1) {
				$("#count4Delete").html(nTotal.length);
			} else if (nTotal.length === 0) {
				$("#count4Delete").html("");
			}
			$("#notificationContent").html(notifications);
		},
		error: function (status) {
			console.error("Error en la solicitud:", status);
		}
	});
}

function setNotificationData(title, body, id) {
	$("#titleNotificationModal").html(title);
	$("#bodyNotificationModal").html(body);
	verificarToken();
	$.ajax({
		url: "/readNotifications",
		dataType: "JSON",
		data: {
			id: id
		},
		method: "POST",
		success: function (response) {
			getNotifications();
		},
		error: function (status) {
			console.error("Error en la solicitud:", status);
		}
	});
}

function deleteOneNotification(id) {
	verificarToken();
	$.ajax({
		url: "/deleteNotifications",
		dataType: "JSON",
		data: {
			id: id
		},
		method: "POST",
		success: function (response) {
			getNotifications();
		},
		error: function (status) {
			console.error("Error en la solicitud:", status);
		}
	});
}

function readAllNotifications() {
	verificarToken();
	$.ajax({
		url: "/readNotifications",
		dataType: "JSON",
		contentType: "application/json",
		data: JSON.stringify(nTotal.map(id => ({id}))),
		method: "POST",
		success: function () {
			getNotifications();
		},
		error: function (status) {
			console.error("Error en la solicitud:", status);
		}
	});
}

function deleteAllNotifications() {
	verificarToken();
	$.ajax({
		url: "/deleteNotifications",
		dataType: "JSON",
		contentType: "application/json",
		data: JSON.stringify(nTotal.map(id => ({id}))),
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
		success: function () {
			getNotifications();
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function (status) {
			console.error("Error en la solicitud:", status);
		}
	});
}


function verificarToken() {
	const expiraEn = localStorage.getItem("tokenExpira");
	const now = Math.floor(Date.now() / 1000);
	if (now >= expiraEn) {
		cerrarSesion();
	}
}

function cerrarSesion() {
	localStorage.removeItem("tokenExpira");
	window.location.href = "/signout";
}
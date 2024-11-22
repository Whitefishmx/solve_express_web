let initDate = $("#initDate");
let endDate = $("#endDate");
let rfc = $("#rfc");
let curp = $("#curp");
let name = $("#name");
let period = $("#period");
let selector = new Selectr("#columns", {multiple: !0});
$(document).ready(function () {
	getPeriods();
	getReport();
	getInvoices();
	$("#tabEmployee").on("click", function () {
		getPeriods();
		getReport();
	});
	$("#tabInvoices").on("click", function () {
	
	});
	$("#searchReport").on("click", function () {
		getReport();
	});
	$("#download").on("click", function () {
		downloadReport();
	});
	initDate.add(endDate).add(rfc).add(curp).add(name).add(period).on("input", function () {
		getReport();
	});
	$("#all").on("select", function () {
		selector.clear();
		return selector.setValue("");
	});
	$("#columns").on("change", function () {
		const selectedOptions = $(this).val();
		if (selectedOptions.length > 1 && selectedOptions.length < 9 && selectedOptions.includes("")) {
			return selector.setValue("");
		}
		if (selectedOptions.length >= 9) {
			selector.clear();
			return selector.setValue("");
		}
		
		// // Si se selecciona la opción "Todos"
		// if (selectedOptions.includes("")) {
		// 	// Desmarca todas las demás opciones
		// 	$(this).find('option').prop('selected', false);
		// 	allOption.prop('selected', true);
		// } else {
		// 	// Si se seleccionan otras opciones, desmarca "Todos"
		// 	allOption.prop('selected', false);
		// }
		//
		// // Actualiza el select con los cambios
		// $(this).trigger('change.select2');
	});
	$("#formNomina").on("submit", function (e) {
		e.preventDefault();
		uploadNomina();
	});
	$("#uploadNomina").on("click", function () {
		uploadNomina();
	});
});
function getPeriods() {
	$.ajax({
		url: "/getPeriods",
		type: "POST",
		processData: false,
		contentType: false,
		beforeSend() {
			let obj = $("#mainContainer");
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
			let select = $("#period");
			select.empty();
			select.append("<option value=\"\">Todos</option>");
			$.each(response.response, function (index, value) {
				select.append("<option value=\"" + value + "\">" + value + "</option>");
			});
			new Selectr("#period");
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
function getReport() {
	$.ajax({
		url: "/reportCompany",
		data: JSON.stringify({
			date1: initDate.val(),
			date2: endDate.val(),
			rfc: rfc.val(),
			curp: curp.val(),
			name: name.val(),
			period: period.val(),
		}),
		dataType: "JSON",
		contentType: "application/json; charset=utf-8",
		method: "POST",
		beforeSend() {
			let obj = $("#mainContainer");
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
			let resArea = $("#datatable_1 tbody");
			resArea.empty();
			resArea.html();
			$.each(response["response"], function (index, value) {
				let data = "<tr><td>" + value["external_id"] + "</td>" +
					"<td>" + value["name"] + " " + value["sure_name"] + " " + value["last_name"] + "</td>" +
					"<td>" + value["rfc"] + "</td>" +
					"<td>$ " + value["net_salary"] + "</td>" +
					"<td>$ " + value["sum_request_amount"] + "</td>" +
					"<td>$ " + value["remaining_amount"] + "</td>" +
					"<td>" + value["period"] + "</td></tr>";
				resArea.append(data);
			});
			try {
				new simpleDatatables.DataTable("#datatable_1", {searchable: !0, fixedHeight: !1});
			} catch (e) {
			}
			try {
				let e = new simpleDatatables.DataTable("#datatable_2");
				document.querySelector("button.csv").addEventListener("click", () => {
					simpleDatatables.exportCSV(e, {download: !0, lineDelimiter: "\n\n", columnDelimiter: ";"});
				}), document.querySelector("button.sql").addEventListener("click", () => {
					simpleDatatables.exportSQL(e, {download: !0, tableName: "export_table"});
				}), document.querySelector("button.txt").addEventListener("click", () => {
					simpleDatatables.exportTXT(e, {download: !0});
				}), document.querySelector("button.json").addEventListener("click", () => {
					simpleDatatables.exportJSON(e, {download: !0, escapeHTML: !0, space: 3});
				});
			} catch (e) {
			}
			try {
				document.addEventListener("DOMContentLoaded", function () {
					var a = document.querySelector("[name='select-all']"), c = document.querySelectorAll("[name='check']");
					a?.addEventListener("change", function () {
						var t = a.checked;
						c.forEach(function (e) {
							e.checked = t;
						});
					}), c.forEach(function (e) {
						e.addEventListener("click", function () {
							var e = c.length, t = document.querySelectorAll("[name='check']:checked").length;
							t <= 0 ? (a.checked = !1, a.indeterminate = !1) : e === t ? (a.checked = !0, a.indeterminate = !1) : (a.checked = !0, a.indeterminate = !0);
						});
					});
				});
			} catch (e) {
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
function downloadReport() {
	let cols = $("#columns").val();
	let columns = cols;
	if (cols.includes("")) {
		columns = [
			"noEmpleado",
			"name",
			"lastName",
			"sureName",
			"rfc",
			"curp",
			"plan",
			"netSalary",
			"period"
		];
	}
	getWInfo().then(data => {
		const settings = {
			"url": "https://api-solve.local//excelCompany",
			"method": "POST",
			"timeout": 0,
			"headers": {
				"Content-Type": "application/json",
				"Authorization": "Bearer " + data["t"],
			},
			"data": JSON.stringify({
				"filters": {
					"company": data["c"],
					"initDate": "" + initDate.val(),
					"endDate": "" + endDate.val(),
					"period": "" + period.val(),
					"rfc": "" + rfc.val(),
					"name": "" + name.val(),
				},
				"columns": columns,
			}),
			"xhrFields": {
				responseType: "blob" // Esto es clave para recibir la respuesta como un archivo binario
			}
		};
		
		$.ajax(settings).done(function (response) {
			let url = window.URL.createObjectURL(response);
			let a = document.createElement("a");
			let now = new Date();
			let monthName = month2Mes(now.getMonth() - 1);
			if (now.getMonth() === 0) {
				monthName = month2Mes(11);
			}
			let formattedDate = `${monthName}_${now.getDate()}_${now.getFullYear()}__${now.getHours()}_${now.getMinutes()}_${now.getSeconds()}`;
			a.href = url;
			a.download = formattedDate + ".xlsx"; // Nombre del archivo de descarga
			document.body.appendChild(a);
			a.click();
			window.URL.revokeObjectURL(url); // Libera la memoria
			document.body.removeChild(a); // Remueve el enlace d
		});
		
	});
}
function month2Mes(month) {
	const months = [
		"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
		"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
	];
	return months[month]; // Devuelve el nombre del mes
}
function getWInfo() {
	return $.ajax({
		url: "/data4req",
		method: "POST",
		beforeSend() {
			let obj = $("#mainContainer");
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
function uploadNomina() {
	getWInfo().then(data => {
		const formData = new FormData($("#formNomina")[0]);
		formData.append("nomina", $("#nominaFile")[0].files[0]);
		formData.append("company", data["c"]);
		$.ajax({
			url: "https://api-solve.local//sExpressUploadNomina",
			method: "POST",
			timeout: 0,
			headers: {"Authorization": "Bearer " + data["t"],},
			processData: false,
			mimeType: "multipart/form-data",
			contentType: false,
			data: formData,
			beforeSend: function () {
				const obj = $("#mainContainer");
				const left = obj.offset().left;
				const top = obj.offset().top;
				const width = obj.width();
				const height = obj.height();
				$("#solveLoader").delay(50000).css({
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
				console.log("Respuesta del servidor:", response);
			},
			complete: function () {
				$("#solveLoader").css({
					display: "none"
				});
			},
			error: function (status) {
				console.error("Error en la solicitud:", status);
			}
		});
	});
}
function getInvoices(){
	try {
		new simpleDatatables.DataTable("#tableInvoice", {searchable: !0, fixedHeight: !1});
	} catch (e) {
	}
}
let initDate = $("#initDate");
let endDate = $("#endDate");
let rfc = $("#rfc");
let curp = $("#curp");
let name = $("#name");
let period = $("#period");
let dataTable = null;
let dataEmployeesTable = null;
let dataPaymentsTable = null;
// noinspection JSUnresolvedReference
let selector = new Selectr("#columns", {multiple: true});
// noinspection JSUnresolvedReference
let periodSelector = new Selectr("#period");
let hiringDate = $("#hiringDate");
let fireDate = $("#fireDate");
let rfcFire = $("#rfcFire");
let curpFire = $("#curpFire");
let nameFire = $("#nameFire");
let showFires = $("#showFires");
let periodDetail = null;
let url = "https://api.solvegcm.mx/";
// let url = "https://api-solve.local/";
$(document).ready(function () {
	// initDate.add(endDate).add(rfc).add(curp).add(name).on("input", function () {
	// 	getReport();
	// });
	verificarToken
	hiringDate.add(fireDate).add(rfcFire).add(curpFire).add(nameFire).add(showFires).on("input", function () {
		getEmployees();
	});
	$("#tabFireEmployee").on("click", function () {
		getEmployees();
	});
	$("#tabEmployee").on("click", function () {
		getPeriods();
		getReport();
	}).click();
	$("#tabInvoices").on("click", function () {
		getPayments();
	});
	$("#searchReport").on("click", function () {
		getReport();
	});
	$("#download").on("click", function () {
		downloadReport();
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
	});
	$("#upLoadFires").on("click", function () {
		fireEmployees();
	});
	$("#formFires").on("submit", function (e) {
		e.preventDefault();
		fireEmployees();
	});
	$("#uploadNomina").on("click", function () {
		uploadNomina();
	});
	$('#downloadPaymentDetail').on('click', function () {
		downloadDetailPaymentReport();
	});
});
function getPeriods() {
	verificarToken();
	$.ajax({
		url: "/getPeriods",
		type: "POST",
		processData: false,
		contentType: false,
		beforeSend() {
			displayLoaderCompany();
		},
		success: function (response) {
			periodSelector.removeAll();
			periodSelector.add({value: "", text: "Todos", selected: true});
			$.each(response.response, function (index, value) {
				periodSelector.add({value: value, text: value});
			});
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function (status) {
			// Maneja los errores de la solicitud
			return void Swal.fire({icon: "error", title: "Error...", text: "No se logro recuperar la información de los periodos.", timer: 1500});
		}
	});
}
function getReport() {
	verificarToken();
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
			displayLoaderCompany();
		},
		success: function (response) {
			if (dataTable != null) dataTable.destroy();
			const resArea = $("#datatable_1 tbody");
			resArea.empty();
			// Construir el contenido HTML en una cadena
			let rows = "";
			$.each(response["response"], function (index, value) {
				rows += `
			<tr>
			    <td>${value["external_id"]}</td>
			    <td>${value["name"]} ${value["last_name"]} ${value["sure_name"]}</td>
			    <td>${value["curp"]}</td>
			    <td>$ ${Intl.NumberFormat("en-US").format(value["net_salary"])}</td>
			    <td>$ ${Intl.NumberFormat("en-US").format(value["requested_amount"])}</td>
			    <td>$ ${Intl.NumberFormat("en-US").format(value["remaining_amount"])}</td>
			    <td>${value["period"]}</td>
			    <td>${value["request_date"]}</td>
			</tr>`;
			});
			resArea.append(rows);
			
			dataTable = new simpleDatatables.DataTable("#datatable_1", {
				searchable: true,
				fixedHeight: true,
			});
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function (status) {
			// Maneja los errores de la solicitud
			return void Swal.fire({icon: "error", title: "Error...", text: "No se logro recuperar la información de los empleados.", timer: 1500});
		}
	});
}
function downloadReport() {
	verificarToken();
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
			"url": url + "excelCompany",
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
	verificarToken();
	return $.ajax({
		url: "/data4req",
		method: "POST",
		beforeSend() {
			displayLoaderCompany();
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
	verificarToken();
	getWInfo().then(data => {
		const formData = new FormData($("#formNomina")[0]);
		formData.append("nomina", $("#nominaFile")[0].files[0]);
		formData.append("company", data["c"]);
		formData.append("user", data["u"]);
		$.ajax({
			url: url + "sExpressUploadNomina",
			method: "POST",
			timeout: 0,
			headers: {"Authorization": "Bearer " + data["t"],},
			processData: false,
			mimeType: "multipart/form-data",
			contentType: false,
			data: formData,
			beforeSend: function () {
				displayLoaderCompany();
			},
			success: function (response) {
				console.log("Respuesta del servidor:", response);
				void Swal.fire({icon: "success", title: "Se actualizó la nomina de forma exitosa. ", timer: 1500});
				getEmployees();
			},
			complete: function () {
				$("#Loader").css({
					display: "none"
				});
			},
			error: function (status) {
				// noinspection JSUnresolvedReference
				return void Swal.fire({
					icon: "error",
					title: "Error...",
					text: "No se logro leer el archivo, verifique que los encabezados y tipo de celda sean correctos"
				});
			}
		});
	});
}
function getEmployees() {
	verificarToken();
	$.ajax({
		url: "/getEmployees",
		data: JSON.stringify({
			hiringDate: hiringDate.val(),
			fireDate: fireDate.val(),
			rfcFire: rfcFire.val(),
			curpFire: curpFire.val(),
			nameFire: nameFire.val(),
			fire: showFires.prop("checked"),
		}),
		dataType: "JSON",
		contentType: "application/json; charset=utf-8",
		method: "POST",
		beforeSend() {
			displayLoaderCompany();
		},
		success: function (response) {
			if (dataEmployeesTable != null) dataEmployeesTable.destroy();
			const resArea = $("#fireEmployees tbody");
			resArea.empty();
			let rows = "";
			response["response"].forEach((value) => {
				let formattedName = capitalizeWords(value["name"]);
				let formattedLastName = capitalizeWords(value["last_name"]);
				let formattedSureName = capitalizeWords(value["sure_name"]);
				let clabe = value["clabe"] || "No disponible";
				let fired = value["fireDate"] || "No disponible";
				let fireIcon = value["fireDate"] === null
					? `<i class='las la-trash-alt text-secondary font-16 text-danger'
                   style='font-size: 1.5rem; cursor: pointer'
                   onclick="fireEmployee('${value["employeeId"]}', '${formattedLastName}', '${formattedName}')"></i>`
					: `<i class='las la-trash-alt text-secondary' style='font-size: 1.2rem;' title='No disponible'></i>`;
				rows += `
            <tr>
                <td>${value["external_id"]}</td>
                <td>${formattedLastName} ${formattedSureName} ${formattedName}</td>
                <td>${value["curp"]}</td>
                <td>${clabe}</td>
                <td>${value["hiringDate"]}</td>
                <td>${fired}</td>
                <td style='text-align: center'>${fireIcon}</td>
            </tr>`;
			});
			resArea.append(rows);
			dataEmployeesTable = new simpleDatatables.DataTable("#fireEmployees", {
				searchable: true,
				fixedHeight: true,
			});
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function () {
			// noinspection JSUnresolvedReference
			return void Swal.fire({icon: "error", title: "Error...", text: "No se logro recuperar la información de los empleados."});
		}
	});
}
function capitalizeWords(str) {
	if (!str) return ""; // Verifica si la cadena es nula o vacía
	return str
		.split(" ") // Divide la cadena en palabras
		.map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()) // Capitaliza cada palabra
		.join(" "); // Une las palabras nuevamente con espacios
}
function fireEmployee(employeeId, lastName, name) {
	// noinspection JSUnresolvedReference
	Swal.fire({
		title: "Espera...",
		text: `¿Estás seguro que deseas dar de baja al empleado: ${lastName} ${name}?`,
		icon: "warning",
		showCancelButton: !0,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Sí, dar de baja",
	}).then((e) => {
		// noinspection JSUnresolvedReference
		if (e.isConfirmed) {
			verificarToken();
			$.ajax({
				url: "/fireEmployee",
				data: JSON.stringify({
					employee: employeeId,
				}),
				dataType: "JSON",
				contentType: "application/json; charset=utf-8",
				method: "DELETE",
				beforeSend() {
					displayLoaderCompany();
				},
				success: function () {
					// console.log(response);
					// noinspection JSUnresolvedReference
					return void Swal.fire({icon: "success", title: "Se dio de baja al empleado de forma exitosa.", timer: 1500});
				},
				complete: function () {
					$("#Loader").css({
						display: "none"
					});
					getEmployees();
				},
				error: function () {
					// console.error("Error en la solicitud:", status);
					// noinspection JSUnresolvedReference
					return void Swal.fire({icon: "error", title: "Error...", text: "No se logro dar de baja al empleado, por favor, inténtelo nuevamente."});
				}
			});
		}
	});
}
function fireEmployees() {
	// noinspection JSUnresolvedReference
	Swal.fire({
		title: "Espera...",
		text: `¿Estás seguro que deseas dar de baja los empleados que se encuentran en el archivo?`,
		icon: "warning",
		showCancelButton: !0,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Sí, dar de baja",
	}).then((e) => {
		// noinspection JSUnresolvedReference
		if (e.isConfirmed) {
			verificarToken();
			getWInfo().then(data => {
				const formElement = $("#formNomina")[0];
				if (!formElement || formElement.tagName !== "FORM") {
					console.error("El elemento no es un formulario válido.");
					return;
				}
				const formData = new FormData(formElement);
				formData.append("bajas", $("#fireFile")[0].files[0]);
				formData.append("company", data.c);
				const settings = {
					url: url + "sExpressUploadFires",
					type: "POST",
					headers: {"Authorization": "Bearer " + data["t"],},
					data: formData,
					processData: false,
					contentType: false,
					beforeSend() {
						displayLoaderCompany();
					},
					success() {
						// noinspection JSUnresolvedReference
						return void Swal.fire({icon: "success", title: "Se dieron de baja a los empleados de forma exitosa.", timer: 1500});
					},
					complete() {
						$("#Loader").css({display: "none"});
						getEmployees();
					},
					error() {
						// noinspection JSUnresolvedReference
						return void Swal.fire({
							icon: "error",
							title: "Error...",
							text: "No se logro dar de baja a los empleados, por favor, inténtelo nuevamente."
						});
					}
				};
				$.ajax(settings);
			});
		}
	});
}
function displayLoaderCompany() {
	// noinspection DuplicatedCode
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
}
function initializeTable() {
	if (!dataTable) {
		dataTable = new simpleDatatables.DataTable("#datatable_1", {searchable: true, fixedHeight: false});
	} else {
		dataTable.destroy();
		dataTable = new simpleDatatables.DataTable("#datatable_1", {searchable: true, fixedHeight: false});
	}
}
function getPayments() {
	verificarToken();
	$.ajax({
		url: "/getPayments",
		dataType: "JSON",
		contentType: "application/json; charset=utf-8",
		method: "POST",
		beforeSend() {
			displayLoaderCompany();
		},
		success: function (response) {
			if(dataPaymentsTable != null) dataPaymentsTable.destroy();
			let resAreaI = $("#tableInvoice tbody");
			resAreaI.empty();
			let rows = "";
			$.each(response["response"], function (index, value) {
				let status = "<span class='badge rounded-pill bg-danger'><strong>Pendiente</strong></span>";
				if (value["status"] === "1") {
					status = "<span class='badge rounded-pill bg-primary'><strong>Liquidado</strong></span>";
				}
				let cep = "En proceso";
				if (value["cep"] != null) {
					cep = "<a href='" + url + value["cep"] + "' target='_blank' style=\"color: #FF9400\"><i class=\"material-icons prefix\">download</i>Descargar</a>";
				}
				rows += `
            <tr onclick="showDetailsPayment('${value["concept"]}')">
                <td>$ ${Intl.NumberFormat("en-US").format(value["amount"])}</td>
                <td>${value["short_name"]}</td>
                <td>${value["clabe"]}</td>
                <td>${value["magicAlias"]}</td>
                <td>${value["noReference"]}</td>
                <td>${value["noReference"]}</td>
                <td>${value["concept"]}</td>
                <td>${status}</td>
                <td>${cep}</td>
                <td>${value["death_line"]}</td>
                <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" onclick="showDetailsPayment" data-bs-target="#paymentsDetails">Ver detalles</button></td>
            </tr>`;
			});
			resAreaI.html(rows);
			dataEmployeesTable = new simpleDatatables.DataTable("#tableInvoice", {
				searchable: true,
				fixedHeight: true,
			});
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function (status) {
			// Maneja los errores de la solicitud
			return void Swal.fire({icon: "error", title: "Error...", text: "No se logro recuperar la información de los empleados.", timer: 1500});
		}
	});
}
function showDetailsPayment(period) {
	verificarToken();
	periodDetail = period;
	$.ajax({
		url: "/getPaymentsDetails",
		data: JSON.stringify({
			period: period,
		}),
		dataType: "JSON",
		contentType: "application/json; charset=utf-8",
		method: "POST",
		beforeSend() {
			displayLoaderCompany();
		},
		success: function (response) {
			let resArea = $("#detailsPaaymentTbl tbody");
			resArea.empty();
			// Construir el contenido HTML en una cadena
			let rows = "";
			$.each(response["response"], function (index, value) {
				let url = "https://api.solvegcm.mx/cepDownloader/";
				//let url = "https://api-solve.local/cepDownloader/";
				let cep = "En proceso";
				if (value["cep"] != null) {
					cep = "<a href='" + url + value["cep"] + "' target='_blank' style=\"color: #FF9400\"><i class=\"material-icons prefix\">download</i>Descargar</a>";
				}
				rows += `
            <tr>
                <td>${value["external_id"]}</td>
                <td>${value["name"]} ${value["last_name"]} ${value["sure_name"]}</td>
                <td>${value["curp"]}</td>
                <td style="white-space: nowrap">$ ${Intl.NumberFormat("en-US").format(value["net_salary"])}</td>
                <td style="white-space: nowrap">$ ${Intl.NumberFormat("en-US").format(value["requested_amount"])}</td>
                <td style="white-space: nowrap">$ ${Intl.NumberFormat("en-US").format(value["amount_deposited"])}</td>
                <td style="white-space: nowrap">$ ${Intl.NumberFormat("en-US").format(value["tax"])}</td>
                <td style="white-space: nowrap">$ ${Intl.NumberFormat("en-US").format(value["remaining_amount"])}</td>
                <td style="white-space: nowrap">${cep}</td>
                <td style="white-space: nowrap">${value["period"]}</td>
                <td>${value["request_date"]}</td>
            </tr>`;
			});
			
			// Insertar el contenido en una sola operación
			resArea.html(rows);
			
			// Inicializar la tabla
			initializeTable();
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
		error: function (status) {
			// Maneja los errores de la solicitud
			return void Swal.fire({icon: "error", title: "Error...", text: "No se logro recuperar la información de los empleados.", timer: 1500});
		}
	});
}
function downloadDetailPaymentReport(){
	let columns = [
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
	getWInfo().then(data => {
		const settings = {
			"url": url + "excelCompany",
			"method": "POST",
			"timeout": 0,
			"headers": {
				"Content-Type": "application/json",
				"Authorization": "Bearer " + data["t"],
			},
			"data": JSON.stringify({
				"filters": {
					"company": data["c"],
					"period": "" + periodDetail,
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
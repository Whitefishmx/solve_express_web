$(document).ready(function () {
	$(".tabs").tabs({swipeable: false});
	const toggleButton = document.getElementById("theme-toggle");
	const cantidad = $("#requestAmount");
	$("#Disposiciones").on("click", GetDisposiciones);
	
	cantidad.on("input", function () {
		let rangeMin = $(this).attr("min");
		let rangeMax = $(this).attr("max");
		let value = this.value;
		$("#outRequestAmount").val("$ " + Intl.NumberFormat("en-US").format(value));
		const percentageFromValue = ((value - rangeMin) / (rangeMax - rangeMin)) * 100;
		$(this).css("cssText", "background-size: " + percentageFromValue + "% 100% !important;");
	});
});

function GetDisposiciones() {
	$.ajax({
		url: "/disposiciones",
		type: "POST",
		processData: false,
		contentType: false,
		beforeSend: function () {
			const obj = $("#container");
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
			let resContainer = $("#resDisposition");
			resContainer.empty();
			if (response.error !== 200) {
				resContainer.append('<tr><td  colspan="10" style="text-align: center">No hay peticiones aun<tr></tr></tr>');
			} else {
				let tableRes = "";
				$.each(response.response, function (index, value) {
					let plan ='Quincenal';
					if ( value.plan === 'q'){
						plan ='Quincenal';
					}else if ( value.plan === 'm'){
						plan ='Mensual';
					}else if ( value.plan === 's'){
						plan ='Semanal';
					}
					tableRes += "<tr>" +
						"<td>" + plan + "</td>" +
						"<td>" + value.period + "</td>" +
						"<td>" + value.requested_amount + "</td>" +
						"<td>" + value.remaining_amount + "</td>" +
						"<td>" + value.folio + "</td>" +
						"<td>" + value.noReference + "</td>" +
						"<td>" + value.clabe + "</td>" +
						"<td>" + value.bnk_alias + "</td>" +
						"<td>"+value.Fecha_solicitud +"</td>" +
					"<td>"+value.Ultima_modificación+"</td>";
				});
				resContainer.append(tableRes);
			}
			
		},
		complete: function () {
			$("#solveLoader").css({
				display: "none"
			});
		},
		error: function (status) {
			// Maneja los errores de la solicitud
			console.error("Error en la solicitud:", status);
		}
	});
}


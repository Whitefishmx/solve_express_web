$(document).ready(function () {
	getPeriods();
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
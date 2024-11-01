$(document).ready(function () {

});
function getPeriods(){
	$.ajax({
		url: "/getPeriods",
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
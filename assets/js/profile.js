$(document).ready(function () {
	getProfiles();
});

function getProfiles() {
	$.ajax({
		url: "/getProfile",
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
			
			$.each(response, function (index, value) {
				let name = value["name"] + " " + value["last_name"] + " " + value["sure_name"];
				$("#name").val(value["name"]);
				$("#curp").val(value["curp"]);
				$("#clabe").val(value["clabe"]);
				$("#nickname").val(value["nickname"]);
				$("#email").val(value["email"]);
				$("#phone").val(value["phone"]);
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
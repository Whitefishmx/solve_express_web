$(document).ready(function () {
	let formPassword = $("#formValidationPassword");
	formPassword.on("submit", function (e) {
		e.preventDefault();
		e.stopPropagation();
		if (formUserValidate()) {
			setNewPassword();
		}
	});
	$("#password, #password2").on("input", validatePassword);
	$("#validateCurp").on("click", function () {
		initRecovery();
	});
	$("#formCurpValidator").on("submit", function (e) {
		e.preventDefault();
		e.stopPropagation();
		initRecovery();
	});
	$("#validateCodeMail").on("click", function () {
		verifyCode();
	});
	$("#formCodeValidator").on("submit", function (e) {
		e.preventDefault();
		e.stopPropagation();
		verifyCode();
	});
	// $("#savePassword").on("click", function () {
	// 	setNewPassword();
	// });
	// formPassword.on("submit", function (e) {
	// 	e.preventDefault();
	// 	e.stopPropagation();
	// 	setNewPassword();
	// });
});

function formUserValidate() {
	let isValid = true;
	let n = document.getElementById("password"),
		r = document.getElementById("password2");
	
	function l(e, t) {
		isValid = false; // Marca como inválido si hay algún error
		e = e.parentElement;
		e.children[1].classList.add("error");
		e = e.querySelector("small");
		e.innerText = t;
		e.classList.add("error");
		e.classList.remove("success");
	}
	
	function c(e) {
		e = e.parentElement;
		e.children[1].classList.remove("error");
		e.children[1].classList.add("success");
		e = e.querySelector("small");
		e.classList.add("success");
		e.classList.remove("error");
	}
	
	function validatePasswordStrength(passwordElement, t, s) {
		const password = passwordElement.value;
		const hasUppercase = /[A-Z]/.test(password);
		const hasNumber = /\d/.test(password);
		const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
		if (passwordElement.value.length < t) {
			l(passwordElement, `La contraseña debe tener al menos ${t} caracteres`);
		} else if (passwordElement.value.length > s) {
			l(passwordElement, `La contraseña debe tener menos de ${s} caracteres`);
		} else if (!hasUppercase) {
			l(passwordElement, "La contraseña debe tener al menos una letra mayúscula");
		} else if (!hasNumber) {
			l(passwordElement, "La contraseña debe tener al menos un número");
		} else if (!hasSpecialChar) {
			l(passwordElement, "La contraseña debe tener al menos un carácter especial");
		} else {
			c(passwordElement);
		}
	}
	
	[n, r].forEach(function (e) {
		if (e.value.trim() === "") {
			l(e, "Este campo es obligatorio");
		} else {
			c(e);
		}
	});
	validatePasswordStrength(n, 8, 100);
	if (n.value !== r.value) {
		l(r, "Las contraseñas no coinciden");
	}
	return isValid; // Retorna true si es válido, false en caso contrario
}

function validatePassword() {
	const password = $("#password").val();
	const confirmPassword = $("#password2").val();
	const validations = [
		{selector: "#length", isValid: password.length >= 8},
		{selector: "#upper", isValid: /[A-Z]/.test(password)},
		{selector: "#number", isValid: /\d/.test(password)},
		{selector: "#special", isValid: /[!@#$%^&*(),.?":{}|<>]/.test(password)},
		{selector: "#both", isValid: password === confirmPassword}
	];
	validations.forEach(({selector, isValid}) => updateState(selector, isValid));
}

function updateState(selector, isValid) {
	const element = $(selector);
	const small = element.find("small");
	
	if (isValid) {
		element.removeClass("error").addClass("correct");
		small.show();
	} else {
		element.removeClass("correct").addClass("error");
		small.hide();
	}
}

function initRecovery() {
	$.ajax({
		url: "/initRecovery",
		data: {
			email: $("#email").val(),
		},
		dataType: "JSON",
		method: "POST",
		beforeSend: function () {
			const obj = $("#curpValidator");
			$("#Loader").delay(50000).css({
				display: "block",
				opacity: 1,
				visibility: "visible",
				left: obj.offset().left,
				top: obj.offset().top,
				width: obj.width(),
				height: obj.height(),
				zIndex: 999999
			}).focus();
		},
		success: function () {
			$("#curpForm").css("display", "none");
			$("#cardPassword").css("display", "none");
			$("#cardCode").css("display", "block");
			$("#TitleCard").html("Verificar correo");
			$("#InstructionsCard").html("Ingrese el codigo que se le envió a su correo registrado, <strong> Verifique que el correo no esté en cu carpeta de spam o No deseados</strong>");
		},
		error: function (error) {
			// noinspection JSUnresolvedReference
			return void Swal.fire({icon: "error", title: "Oops...", text: error["responseJSON"]["reason"]});
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
	});
}

function verifyCode() {
	$.ajax({
		url: "/validateCode",
		data: {
			code: $("#codeMail").val(),
		},
		dataType: "JSON",
		method: "POST",
		beforeSend: function () {
			const obj = $("#curpValidator");
			$("#Loader").delay(50000).css({
				display: "block",
				opacity: 1,
				visibility: "visible",
				left: obj.offset().left,
				top: obj.offset().top,
				width: obj.width(),
				height: obj.height(),
				zIndex: 999999
			}).focus();
		},
		success: function () {
			$("#curpForm").css("display", "none");
			$("#cardPassword").css("display", "block");
			$("#cardCode").css("display", "none");
			$("#TitleCard").html("Ingrese una nueva contraseña");
			$("#InstructionsCard").html("Ingrese una nueva contraseña, <strong> Verifique que cumpla los requisitos mostrados a continuación</strong>");
		},
		error: function (error) {
			// noinspection JSUnresolvedReference
			return void Swal.fire({icon: "error", title: "Oops...", text: error["responseJSON"]["reason"]});
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
	});
}
function setNewPassword() {
	$.ajax({
		url: "/changePassword",
		data: {
			password: $("#password").val(),
			password2: $("#password2").val(),
		},
		dataType: "JSON",
		method: "POST",
		beforeSend: function () {
			const obj = $("#curpValidator");
			$("#Loader").delay(50000).css({
				display: "block",
				opacity: 1,
				visibility: "visible",
				left: obj.offset().left,
				top: obj.offset().top,
				width: obj.width(),
				height: obj.height(),
				zIndex: 999999
			}).focus();
		},
		success: function (data, textStatus, xhr) {
			if (xhr.status === 200) {
				// noinspection JSUnresolvedReference
				void Swal.fire({icon: "success", title: "Se guardo su contraseña, ya puede iniciar sesión", timer: 1500});
				setTimeout(function () {
					window.location.href = "/";
				}, 2500);
			}
		},
		error: function (error) {
			// noinspection JSUnresolvedReference
			return void Swal.fire({icon: "error", title: "Oops...", text: error["responseJSON"]["reason"]});
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
	});
}
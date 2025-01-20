let visitorId = "";
let curp = "";
let user = ";";
const metamapButton = document.querySelector("metamap-button");
FingerprintJS.load().then(fp => {
	fp.get().then(result => {
		visitorId = result.visitorId;
	});
});
let curpSession;
let curpLocal;
let intervalId;
$(document).ready(function () {
	curpSession = sessionStorage.getItem('curp');
	curpLocal = localStorage.getItem('curp');
	if (curpSession || curpLocal) {
		startInterval();
	}
	let mask = IMask(document.getElementById("phone"), {mask: "(00)00-00-0000"});
	document.getElementById("curp").addEventListener("input", function (e) {
		e.target.value = e.target.value.replace(/[^a-zA-Z0-9]/g, "").toUpperCase();
		if (e.target.value.length > 18) {
			e.target.value = e.target.value.slice(0, 18);
		}
	});
	$("#validateCurp").on("click", function () {
		let curp =  $("#curp").val()
		sessionStorage.setItem('curp',curp);
		localStorage.setItem('curp',curp);
		validateCurp();
	});
	$("#formCurpValidator").on("submit", function (e) {
		let curp =  $("#curp").val()
		sessionStorage.setItem('curp',curp);
		localStorage.setItem('curp',curp);
		e.preventDefault();
		validateCurp();
	});
	$("#form-validation-2").on("submit", function (e) {
		e.preventDefault();
		e.stopPropagation();
		if (formUserValidate()) {
			createUser(); // Llama a la función si la validación es correcta
		}
	});
	document.getElementById("phone").addEventListener("keydown", function (e) {
		// Detecta las teclas Backspace (8) y Delete (46)
		
		if (e.key === "Backspace" || e.key === "Delete") {
			// Borra el contenido del input
			this.value = "";
			$("#phoneUnmasked").val("");
			mask.updateValue();
		}
	});
	metamapButton.addEventListener("metamap:userFinishedSdk", ({detail}) => {
		console.log("finished payload", detail);
		wait4Validation();
	});
	metamapButton.addEventListener("metamap:exitedSdk", ({detail}) => {
		console.log("exited payload", detail);
	});
	mask.on("accept", function () {
		$("#phoneUnmasked").val(mask.unmaskedValue);
	});
});

function validateCurp() {

		curp = localStorage.getItem('curp');
	
	FingerprintJS.load().then(fp => {
		fp.get().then(result => {
			visitorId = result.visitorId;
		});
	});
	$.ajax({
		url: "/toValidarCurp",
		data: {
			curp: curp,
			fingerprint: visitorId
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
			if (xhr.status === 201) {
				$("metamap-button").attr("metadata", JSON.stringify({curp: curp}));
				$("#cardForm").css("display", "none");
				$("#cardMeta").css("display", "block");
				$("#cardInValidation").css("display", "none");
				$("#cardPassword").css("display", "none");
				$("#TitleCard").html("Validar identidad");
				$("#InstructionsCard").html("De click en el botón para comenzar la verificación de identidad");
				sessionStorage.setItem('curp',curp);
			}
			if (xhr.status === 202) {
				wait4Validation();
			}
			if (xhr.status === 200) {
				clearInterval(intervalId);
				intervalId = null;
				sessionStorage.removeItem('curp');
				localStorage.removeItem('curp');
				user = data["response"]["id"];
				$("#cardForm").css("display", "none");
				$("#cardMeta").css("display", "none");
				$("#cardInValidation").css("display", "none");
				$("#cardPassword").css("display", "block");
				$("#TitleCard").html("Cree un usuario nuevo");
				$("#InstructionsCard").html("El usuario debe ser único y la contraseña debe tener al menos 8 caracteres entre mayúsculas, minúsculas, números y carácter especial");
			}
		},
		error: function (error) {
			clearInterval(intervalId);
			intervalId = null;
			sessionStorage.removeItem('curp');
			localStorage.removeItem('curp');
			return void Swal.fire({icon: "error", title: "Oops...", text: error["responseJSON"]["reason"]});
			
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
	});
}

function wait4Validation() {
	$("#cardForm").css("display", "none");
	$("#cardMeta").css("display", "none");
	$("#cardInValidation").css("display", "block");
	$("#cardPassword").css("display", "none");
	$("#TitleCard").html("Validando identidad");
	$("#InstructionsCard").html("");
	startInterval();
}

function changePassword(password, password2, user) {
	$.ajax({
		url: "/setPassword",
		data: JSON.stringify({
			password: password,
			password2: password2,
			user: user,
		}),
		dataType: "JSON",
		contentType: "application/json; charset=utf-8",
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
				void Swal.fire({icon: "success", title: "Se guardo su contraseña, ya puede iniciar sesión", timer: 1500});
				setTimeout(function () {
					window.location.href = "/";
				}, 2500);
			}
		},
		error: function () {
			return void Swal.fire({icon: "error", title: "Oops...", text: data["reason"][0]});
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
	});
}

function formUserValidate() {
	let isValid = true; // Bandera para determinar si todo el formulario es válido
	let s = document.getElementById("username"),
		a = document.getElementById("email"),
		n = document.getElementById("password"),
		r = document.getElementById("password2"),
		p = document.getElementById("phoneUnmasked");
	
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
	
	function i(e, t, s) {
		e.value.length < t
			? l(e, `El nombre de usuario debe tener al menos ${t} caracteres`)
			: e.value.length > s
				? l(e, `El nombre de usuario debe tener menos de ${s} caracteres`)
				: c(e);
	}
	
	function q(e, t, s) {
		e.value.length < t
			? l(e, `La contraseña debe tener al menos ${t} caracteres`)
			: e.value.length > s
				? l(e, `La contraseña debe tener menos de ${s} caracteres`)
				: c(e);
	}
	
	function z(e, t, s) {
		e.value.length !== s
			? e.value.length !== t
				? l(e, `El teléfono debe tener ${t} dígitos, sin incluir código de país`)
				: c(e)
			: c(e);
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
	
	[s, a, n, r].forEach(function (e) {
		if (e.value.trim() === "") {
			l(e, "Este campo es obligatorio");
		} else {
			c(e);
		}
	});
	
	i(s, 5, 15);
	z(p, 10, 0);
	validatePasswordStrength(n, 8, 100);
	
	
	let emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	emailRegex.test(a.value.trim()) ? c(a) : l(a, "El correo no es válido");
	
	if (n.value !== r.value) {
		l(r, "Las contraseñas no coinciden");
	}
	
	return isValid; // Retorna true si es válido, false en caso contrario
}

function createUser() {
	$.ajax({
		url: "/setUser",
		data: JSON.stringify({
			nickName: $("#username").val(),
			email: $("#email").val(),
			phone: $("#phoneUnmasked").val(),
			password: $("#password").val(),
			password2: $("#password2").val(),
			user: user,
		}),
		dataType: "JSON",
		contentType: "application/json; charset=utf-8",
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
				void Swal.fire({icon: "success", title: "Se guardo su contraseña, ya puede iniciar sesión", timer: 1500});
				setTimeout(function () {
					window.location.href = "/";
				}, 2500);
			}
		},
		error: function (error, textStatus, xhr) {
			let textReason = "No se logró crear el usuario, intente nuevamente o contacte a soporte técnico";
			let parsedData = JSON.parse(error.responseText);
			if (parsedData.reason) {
				$.each(parsedData.reason, function (index, value) {
					textReason += value + "\r\n";
				});
			}
			return void Swal.fire({icon: "error", title: "Oops...", text: textReason});
		},
		complete: function () {
			$("#Loader").css({
				display: "none"
			});
		},
	});
}
function startInterval(){
	if (intervalId) return;
	intervalId = setInterval(function () {
		validateCurp();
	}, 3000);
}
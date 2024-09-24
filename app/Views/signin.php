<div class="container">
	<div class="row">
		<div class="col m6 text-center align-center center-align center" style="padding-top:150px">
			<img
					src="<?= base_url ( 'assets/img/logo.png' ) ?>" class="at-item"
					style="width: 90%;margin: auto;padding: initial;display: block;" alt="logo">
		</div>
		<div class="col m6">
			<div class="col-5">
				<h2>Iniciar sesión</h2>
				<form id="signinForm" name="signinForm" method="POST">
					<div class="row">
						<div class="input-field inline col s12">
							<input id="email" name="email" type="email" class="validate" required>
							<label for="email">Correo *</label>
							<span class="helper-text" data-error="formato erróneo"></span>
						</div>
					</div>
					<div class="row">
						<div class="input-field inline col s12">
							<input
									id="password" name="password" type="password" class="validate" data-length="256"
									minlength="8" required>
							<label for="password">Contraseña</label>
							<span
									class="helper-text"
									data-error="longitud minima de 8 caracteres (mayúsculas, minúsculas, números)"></span>
						</div>
					</div>
					<div class="d-grid">
						<button id="btnSend" name="btnSend" type="submit" class="btn btn-dark blue">Iniciar sesión
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<style>
    input {
        color: black;
    }

    .at-item {
        filter: drop-shadow(4px 6px 3px rgb(0 0 0 / 0.4));
    }
    

</style>
<script>
	$(document).ready(function () {
		let toastHTML;
		const formSignIn = $("#signinForm");
		formSignIn.on("submit", function (e) {
			e.preventDefault();
			const formData = {};
			$(this).serializeArray().forEach(function (item) {
				formData[item.name] = item.value;
			});
			const jsonData = JSON.stringify(formData);
			$.ajax({
				url: "/toSignIn",
				dataType: "json",
				data: jsonData,
				processData: false,
				contentType: false,
				method: "POST",
				beforeSend: function () {
					const obj = $(formSignIn);
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
					window.location.href = "<?=base_url ();?>";
				},
				error: function (data) {
					const errors = data.responseJSON.reason;
					M.Toast.dismissAll();
					if ((typeof errors) === "object") {
						$.each(errors, function (index, value) {
							toastHTML = "<span>" + value + "</span>" +
								"<button onclick='M.Toast.dismissAll()' class='btn-flat toast-action'>" +
								"<span class='material-icons' style='display: block; color: white;'>cancel</span></button>";
							M.toast({html: toastHTML, displayLength: 20000, duration: 20000});
						});
					} else {
						toastHTML = "<span>" + errors + "</span>" +
							"<button onclick='M.Toast.dismissAll()' class='btn-flat toast-action'>" +
							"<span class='material-icons' style='display: block; color: white;'>cancel</span></button>";
						M.toast({html: toastHTML, displayLength: 20000, duration: 20000});
					}
				},
				complete: function () {
					$("#Loader").css({
						display: "none"
					});
				},
			});
		});
	});
</script>
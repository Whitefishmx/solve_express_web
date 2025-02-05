<?php
	$tabs = [
		"<li class='nav-item waves-effect waves-light' role='presentation'><a class='nav-link' data-bs-toggle='tab' href='#test4' role='tab' aria-selected='false' tabindex='-1' id='tabBen'>Beneficios</a></li>",
	];
	$permissions = $permissions ?? '';
	$found = array_filter ( (array)$permissions, function ( $item ) {
		return isset( $item[ 'name' ] ) && $item[ 'name' ] === 'benefits';
	} );
	$benefits = !empty( $found ) ? $tabs[ 0 ] : '';
	$bValidated = $bValidated ?? '';
	if ( !$bValidated){
		$found = 0;
	}
?>
<div class="card" style="padding-left: 0; padding-right: 0;">
	<div class="card-body pt-0">
		<ul class="nav nav-pills nav-justified" role="tablist">
			<li class="nav-item waves-effect waves-light" role="presentation">
				<a class="nav-link active" data-bs-toggle="tab" href="#test1" role="tab" aria-selected="true" tabindex="-1">Inicio</a>
			</li>
			<li class="nav-item waves-effect waves-light" role="presentation">
				<a class="nav-link" data-bs-toggle="tab" href="#test2" role="tab" aria-selected="false" tabindex="-1" onclick="GetDisposiciones()">Disposiciones</a>
			</li>
			<li class="nav-item waves-effect waves-light" role="presentation">
				<a class="nav-link" data-bs-toggle="tab" href="#test3" role="tab" aria-selected="false" tabindex="-1">Notificaciones</a>
			</li>
			<?= $benefits ?>
		</ul>
		<div class="tab-content">
			<?php include ( 'tabs/tabInicio.php' ) ?>
			<?php include ( 'tabs/tabProvisions.php' ) ?>
			<?php include ( 'tabs/tabNotifications.php' ) ?>
			<?php
			if ( !empty( $found ) && $found !== 0 ) {
				include ( 'tabs/tabBenefits.php' );
			}else if ($found === 0){
				include ( 'tabs/tabBenefitsInactive.php' );
			} ?>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" style="display: none;" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title m-0" id="exampleModalScrollableTitle">Detalles y Contrato</h6>
				<button
						type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
						style="background-color: #2b2d3c !important; color: #FFF !important;"
						onclick="location.reload();"></button>
			</div><!--end modal-header-->
			<div>
			</div>
			<div class="card cardback bordercard" style="height: 200px; margin-bottom: 0;">
				<div class="card-body pt-1">
					<h4 style="display: block; width: 100%; text-align: center; margin-top: 10px; margin-bottom: 20px !important;">Detalles de tu adelanto</h4>
					<p class="text-left" style="margin-bottom: 0.7rem !important; font-size: 0.9rem !important;">Tu solicitud: <span
								style="color: #26b719" id="solicitado"></span></p>
					<p class="text-left" style="margin-bottom: 0.7rem !important; font-size: 0.9rem !important;">Comisión: <span
								style="color: #26b719" id="comision"></span></p>
					<p class="text-left" style="margin-bottom: 0.7rem !important; font-size: 0.9rem !important;">Te depositamos: <span
								style="color: #26b719" id="depositamos"></span></p>
					<p class="text-left" style="margin-bottom: 0.7rem !important; font-size: 0.9rem !important;">CLABE: <span
								style="color: #26b719" id="cclabe"></span></p>
				</div>
			</div>
			<div class="modal-body" id="textDisclaimer">
			</div><!--end modal-body-->
			<div class="modal-footer">
				<button
						type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
						style="color: #FFF !important; border-color: #333333 !important; background-color: #333333 !important"
						onclick="location.reload();">Cerrar
				</button>
				<button
						type="button" class="btn btn-primary btn-sm"
						style="border-color: #FF9400 !important; background-color: #FF9400 !important; color: #fff !important;"
						onclick="RequestPay(); this.style.display = 'none'">Acepto
				</button>
			</div><!--end modal-footer-->
		</div><!--end modal-content-->
	</div><!--end modal-dialog-->
</div>
<!--suppress CssInvalidPropertyValue -->
<style>
    #requestAmount {
        min-width: 100px !important;
    }

    :root {
        --base: #FF9400;
        --trackball: var(--base);
        --range: 0%;
    }

    input[type="range"] {
        -webkit-appearance: none;
        margin-right: 15px;
        min-width: 200px;
        max-width: 640px;
        width: 100%;
        height: 7px;
        border-radius: 5px;
        background-size: 0 100%;
        background: #cccccc linear-gradient(#f4c27d, #f4c27d) no-repeat;
    }

    [dir="rtl"] input[type="range"] {
        background-size: 30% 100%;
        background: #FF9400 transparent no-repeat;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: #FF9400;
        cursor: ew-resize;
        box-shadow: 0 0 2px 0 #555;
        transition: background .3s ease-in-out;
    }

    input[type="range"]::-moz-range-thumb {
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: #FF9400;
        cursor: ew-resize;
        box-shadow: 0 0 2px 0 #555;
        transition: background .3s ease-in-out;
    }

    input[type="range"]::-ms-thumb {
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: #FF9400;
        cursor: ew-resize;
        box-shadow: 0 0 2px 0 #555;
        transition: background .3s ease-in-out;
    }

    input[type="range"]::-webkit-slider-thumb:hover {
        background: #FF9400;
    }

    input[type="range"]::-moz-range-thumb:hover {
        background: #FF9400;
    }

    input[type="range"]::-ms-thumb:hover {
        background: #FF9400;
    }

    input[type=range]::-webkit-slider-runnable-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }

    input[type=range]::-moz-range-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }

    input[type="range"]::-ms-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }

    #value {
        position: absolute;
        left: var(--range);
        top: 41%;
        font-size: 14px;
        color: var(--trackball);
        transition: 0.5s color ease;
    }
</style>
<script>
	const rangeInputs = document.querySelectorAll("input[type=\"range\"]");
	let isRTL = document.documentElement.dir === "rtl";
	
	function handleInputChange(e) {
		let target = e.target;
		if (e.target.type !== "range") {
			target = document.getElementById("range");
		}
		const min = target.min;
		const max = target.max;
		const val = target.value;
		let percentage = (val - min) * 100 / (max - min);
		if (isRTL) {
			percentage = (max - val);
		}
		
		target.style.setProperty("background-size", percentage + "% 100%");
		
		
	}
	
	rangeInputs.forEach(input => {
		input.addEventListener("input", handleInputChange);
	});
</script>

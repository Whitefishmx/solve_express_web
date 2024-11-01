<script type="text/javascript" src="/./assets/js/employee.js"></script>

<div class="card">
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
        </ul>
		<div class="tab-content">
            <div class="tab-pane active p-3" id="test1" role="tabpanel">
				<h3 style="text-align: center">¿Cuánto dinero necesitas?</h3>

				<div class="row justify-content-center">
                    <div class="col-md-4">
						<div class="card cardback bordercard" style="height: 120px">
							<div class="card-body pt-1">
								<div class="card-header cardback">
									<h3 class="card-title text-center">Dias trabajados</h3>
								</div>
								<div class="card-body pt-0" id="DashDays">
								<h2 class="text-center" style="font-weight: bold"><img src="assets/img/calendar.png" style="height: 1.7rem"> 13</h2>
								</div>
							</div>
						</div>                                             
					</div>

					<div class="col-md-4">
						<div class="card cardback bordercard" style="height: 120px">
							<div class="card-body pt-1">
								<div class="card-header cardback">
									<h3 class="card-title text-center">Monto disponible</h3>
								</div>
								<div class="card-body pt-0" id="DashAvailable">
									<h2 class="text-center" style="font-weight: bold">$ 2,500.00</h2>
								</div>
							</div>
						</div>
					</div>                                                  
                </div>

				<div class="row justify-content-center">
					<div class="col-md-8 card cardback bordercard">
						<h3 class="text-center" style="font-size: 2rem; margin-top: 1.5rem">Solicitar:</h3>
						<div class="col-md-12">
							<div class="card-body text-center">
								<div class="row justify-content-center">
									<div class="col-md-8" style="font-size: 2.5rem">
										<output id="outRequestAmount" class="dinero">$ 4,000</output>
									</div>
									<div class="col-md-8">
										<input id="requestAmount" name="requestAmount" type="range" value="300" min="250" max="4000"  step="50" oninput="outRequestAmount.value= '$ ' + Intl.NumberFormat('en-US').format(value); this.style.cssText = '';"/>
									</div>
								</div>
							</div>
							<button id="reqPay" name="reqPay" type="submit" class="btn" style="width: 100%; color: var(--title-color) !important; font-size: 1rem; height: 2.5rem; letter-spacing: 0.1rem; margin-bottom: 1.5rem; background-color: #FF9400 !important;">Solicitar adelanto</button>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane p-3" id="test2" role="tabpanel">
				<div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
								<th>Plan</th>
								<th>Periodo</th>
								<th>Monto pedido</th>
								<th>Monto restante</th>
								<th>Folio</th>
								<th>Num. Referencia</th>
								<th>Cuenta Clabe</th>
								<th>Banco</th>
								<th>CEP</th>
								<th>Fecha de Solicitud</th>
								<th>Fecha de Pago</th>
                            </tr>
                        </thead>
                        <tbody id="resDisposition"></tbody>
					</table><!--end /table-->
                </div>
            </div>
            <div class="tab-pane p-3 show" id="test3" role="tabpanel">
                <p class="text-muted mb-0">
					No se encontraron pagos realizados
                </p>
            </div>
        </div>
	</div>
</div>
<style>
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
  background: #cccccc;
  border-radius: 5px;
  background-image: linear-gradient(#f4c27d, #f4c27d);
  background-size: 0% 100%;
  background-repeat: no-repeat;
}
[dir="rtl"] input[type="range"] {
  background: #FF9400;
  background-image: transparent;
  background-size: 30% 100%;
  background-repeat: no-repeat;
}
/* Input Thumb */
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

/* Input Track */
input[type=range]::-webkit-slider-runnable-track  {
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
	//rellena los inputs range
const rangeInputs = document.querySelectorAll('input[type="range"]')
let isRTL = document.documentElement.dir === 'rtl'

function handleInputChange(e) {
  let target = e.target;
  if (e.target.type !== 'range') {
    target = document.getElementById('range');
  } 
  const min = target.min;
  const max = target.max;
  const val = target.value;
  let percentage = (val - min) * 100 / (max - min);
  if (isRTL) {
    percentage = (max - val) ;
  }
  
  target.style.setProperty('background-size', percentage + '% 100%');
 


}

rangeInputs.forEach(input => {
  input.addEventListener('input', handleInputChange);
})

// Obtén los elementos del DOM




// Función para actualizar la posición y el valor del rango


</script>

<div class="tab-pane p-3 show" id="test3" role="tabpanel">
	<div class="card-header">
		<div class="row align-items-center">
			<div class="col">
			</div>
			<div class="col-auto">
				<button class="btn btn-primary btn-sm px-2 text-light" onclick="readAllNotifications()"><i class="fas fa-eye me-1 text-light"></i> Marcar todo como leído <span
							class="badge rounded bg-dark-subtle ms-1 text-blue" id="count4Read"></span></button>
				<button class="btn bg-danger-subtle text-danger" onclick="deleteAllNotifications()"><i class="fas fa-trash me-1"></i> Eliminar todo <span
							class="badge rounded text-danger bg-dark-subtle ms-1" id="count4Delete"></span></button>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-12" id="notificationContent">
		</div>
	</div>
</div>
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<h6 class="modal-title m-0" id="titleNotificationModal"></h6>
				<button type="button" class="btn-close bg-dark-subtle" data-bs-dismiss="modal" aria-label="Close")"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-9" id="bodyNotificationModal">
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
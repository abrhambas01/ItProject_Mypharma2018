<div class="modal fade" id="addMedicineModal" tabindex="-1" role="dialog" aria-labelledby="addMedicineModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin" role="document">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header bg-primary-dark">
					
					<h3 class="block-title">Create New Medicine Dosage</h3>
					
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content">

					{{ Form::open(['id' => 'addMedicineForm', 'method'=>'POST', 'files' => 'true']) }} 
					<div class="form-group row">
						<div class="col-md-9">
							<div class="form-material">
								<select name="medicine_class_id" id="medicine_class_id" class="form-control {{ $errors->has('medicine_class_id') ? 'is-invalid' : '' }}" > 
									@foreach ($medicine_classes as $medicine_class) 
									<option id="medicine_class_id" value="{{ $medicine_class->id }}">{{ $medicine_class->treatment_of }}</option>
									@endforeach
								</select>
								<label for="material-text">Treatment for</label>

							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-9">
							<div class="form-material">
								<input type="text" class="form-control medicine_name" id="medicine_name" name="name" placeholder="5mg">
								<label for="material-text">Medicine Name</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-9">
							<div class="form-material">
								<input type="text" class="form-control dosage_form" id="dosage_form" name="dosage_form" placeholder="Tablet. Capsule.">
								<label for="material-text">in Form of..</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-9">
							<div class="form-material">
								<input type="text" class="form-control price" id="price" name="price" placeholder="(PHP)">
								<label for="material-text">Price</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-9">
							<div class="form-material">
								<input type="file" class="form-control photo" id="photo" name="photo" placeholder="">
								<span class="danger">*If you don't have an image a default picture is used.</span>

								<label for="material-text">Attach a Photo </label>
							</div>
						</div>
					</div>


				</form>
			</div>
		</div>

		
		<div class="modal-footer">
			<button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
			<button type="button" id="storeMedicineBtn" class="btn btn-alt-success">
				<i class="fa fa-check"></i> Store this Medicine Dosage
			</button>
		</div>

	</div>
</div>
</div>

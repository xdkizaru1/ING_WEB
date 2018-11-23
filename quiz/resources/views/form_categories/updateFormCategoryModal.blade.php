<div id="updateFormCategoryModal" class="modal updateFormCategoryModal modal-fixed-footer no-autoinit">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<h5>Editar categoría</h5>
			</div>
			<form id="updateFormCategoryForm" class="col s12" method="POST" action="form_categories">
				{{ csrf_field() }}
				@method('PUT')
				<div class="row" style="margin-bottom: 10px;">
					<div class="input-field col s12 m12">
			          <input id="update_form_category_name" name="form_category_name" type="text" class="validate form_category_name" required>
			          <label for="update_form_category_name" data-error="Verifique este campo" data-success="Campo validado">Nombre de la categoría *</label>
			        </div>
		        </div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a id="deleteFormCategoryModalButton" href="#deleteFormCategoryModal" class="modal-action modal-close modal-trigger left" style="margin-top: 10px;margin-left: 10px;"><i class="material-icons black-text">delete</i></a>
		<a href="#!" class="modal-action modal-close waves-effect btn-flat"><b>Cancelar</b></a>
		<button id="submit_button" onclick="submitUpdateFormCategory();" class="modal-action btn waves-effect submit_button"><b>Editar</b></button>
	</div>
</div>
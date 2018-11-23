<div id="newFormCategoryModal" class="modal newFormCategoryModal modal-fixed-footer">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<h5>Nueva categoría</h5>
			</div>
			<form id="newFormCategoryForm" class="col s12" method="POST" action="form_categories">
				{{ csrf_field() }}
				<div class="row" style="margin-bottom: 10px;">
					<div class="input-field col s12 m12">
			          <input id="form_category_name" name="form_category_name" type="text" class="validate form_category_name" required>
			          <label for="form_category_name" data-error="Verifique este campo" data-success="Campo validado">Nombre de la categoría *</label>
			        </div>
		        </div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect btn-flat"><b>Cancelar</b></a>
		<button id="submit_button" onclick="submitNewFormCategory();" class="modal-action btn waves-effect submit_button"><b>Registrar</b></button>
	</div>
</div>
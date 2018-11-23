<form id="deleteFormCategoryForm" method="POST">
	{{ csrf_field() }}
	@method('DELETE')
</form>
<div id="deleteFormCategoryModal" class="modal deleteFormCategoryModal">
	<div class="modal-content">
		<h5>Eliminar categoría?</h5>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect btn-flat"><b>Cancelar</b></a>
		<button id="delete_form_category_button" onclick="submitDeleteFormCategory();" class="modal-action btn-flat waves-effect delete_form_category_button"><b>Eliminar</b></button>
	</div>
</div>
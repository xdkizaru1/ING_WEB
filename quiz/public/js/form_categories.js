function submitNewFormCategory() {
	$('.submit_button').attr('disabled', true);
	$('#newFormCategoryForm').submit();
}

function submitUpdateFormCategory() {
	$('.submit_button').attr('disabled', true);
	$('#updateFormCategoryForm').submit();
}

function submitDeleteFormCategory() {
	$('.submit_button').attr('disabled', true);
	$('#deleteFormCategoryForm').submit();
}


$('.newFormCategoryModal').modal();

$('.updateFormCategoryModal').modal({
	ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
    	$('#update_form_category_name').val(trigger.attr('data-category-name'));
    	$('label[for="update_form_category_name"]').addClass('active');
    	$('#updateFormCategoryForm').attr('action','form_categories/'+trigger.attr('data-category-id'));
    	$('#deleteFormCategoryModalButton').attr('data-category-id', trigger.attr('data-category-id'));
	},
});

$('.deleteFormCategoryModal').modal({
	ready: function(modal, trigger){
		$('#deleteFormCategoryForm').attr('action','form_categories/'+trigger.attr('data-category-id'));
	},
});
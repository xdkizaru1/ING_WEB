<div id="newQuestionModal" class="modal newQuestionModal" style="width: 90% !important;">
	<div class="modal-content">
		<div class="row">
			<form id="newQuestionForm" class="col s12" method="POST">
				{{ csrf_field() }}
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect btn-flat"><b>Cancelar</b></a>
		<button id="submit_button" onclick="submitNewQuestion();" class="modal-action btn waves-effect submit_button"><b>Siguiente</b></button>
	</div>
</div>
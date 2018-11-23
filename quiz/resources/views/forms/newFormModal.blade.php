<div id="newFormModal" class="modal newFormModal ">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<h5>Nueva prueba</h5>
			</div>
			<form id="newFormForm" class="col s12" method="POST">
				{{ csrf_field() }}
				<div class="row" style="margin-bottom: 10px;">
					<div class="input-field col s12 m12">
						<input id="form_title" name="form_title" type="text" class="validate form_title" required>
						<label for="form_title" data-error="Verifique este campo" data-success="Campo validado">Título de la prueba *</label>
			        </div>
			        <div class="col s12 m12">
			        	<label>Categoría de la prueba</label>
			        	<select id="form_category_id" class="browser-default">
			        		@foreach($form_categories as $key=>$value)
			        	    	<option value="{{$value->form_category_id}}">{{$value->form_category_name}}</option>
			        		@endforeach
			        	</select>
			        </div>
			        <div class="col s4 m4">
			        	<br>
			        	<label>Cantidad de reactivos</label>
			        	<input id="question_cant" name="question_cant" type="number" min="3" value="3" class="validate question_cant" required>
			        </div>
		        </div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect btn-flat"><b>Cancelar</b></a>
		<button id="submit_button" onclick="submitNewForm();" class="modal-action btn waves-effect submit_button"><b>Siguiente</b></button>
	</div>
</div>
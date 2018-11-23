function submitNewForm() {
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	
	$.ajax({
		url: 'forms',
		type: 'POST',
		data: { _token: CSRF_TOKEN,
			form_title: $("#form_title").val(),
			form_category_id: $("#form_category_id option:selected").val(),
		},
	})
	.done(function(data) {
		if(data==1){
			$("#newFormModal").modal('close');
			for(var i=0; i < $('#question_cant').val() ; i++){
				$('#newQuestionForm').append(
				'<div class="row question" style="margin-bottom: 10px;">'+
					'<h5>Pregunta '+(i+1)+'</h5>'+
					'<div class="input-field col s12 m12">'+
						'<input id="question_text'+(i+1)+'" name="question_text" type="text" class="validate question_text" required>'+
						'<label for="question_text'+(i+1)+'" data-error="Verifique este campo" data-success="Campo validado">Pregunta *</label>'+
			        '</div>'+
			        '<div class="input-field col s12 m12">'+
						'<input id="question_correct_text'+(i+1)+'" name="question_correct_text" type="text" class="question_correct_text">'+
						'<label for="question_correct_text'+(i+1)+'" data-error="Verifique este campo" data-success="Campo validado">Texto a mostrar si se responde correctamente</label>'+
			        '</div>'+
			        '<div class="input-field col s12 m12">'+
						'<input id="question_incorrect_text'+(i+1)+'" name="question_incorrect_text" type="text" class="question_incorrect_text">'+
						'<label for="question_incorrect_text'+(i+1)+'" data-error="Verifique este campo" data-success="Campo validado">Texto a mostrar si se responde incorrectamente</label>'+
			        '</div>'+
			        '<h5>Respuestas de pregunta '+(i+1)+'</h5>'+
			        '<div class="answers">'+
				        '<div class="col s12 m12 answer-container">'+
							'<input name="answer" type="text" class="validate answer correct-answer" required>'+
							'<label for="answer" data-error="Verifique este campo" data-success="Campo validado">Respuesta correcta*</label>'+
				        '</div>'+
				        '<div class="col s12 m12 answer-container">'+
							'<input name="answer" type="text" class="validate answer" required>'+
							'<label for="answer" data-error="Verifique este campo" data-success="Campo validado">Respuesta incorrecta *</label>'+
				        '</div>'+
			        '</div>'+
			        '<a href="#" class="btn add-answer" style="margin-right:24px;" onclick="addAnswer(this);">Agregar respuesta</a>'+
			        '<a href="#" class="btn remove-answer" onclick="removeAnswer(this);">Quitar respuesta</a>'+
		        '</div>');
			}
			$("#newQuestionModal").modal({
				dismissible: false,
			});
			$("#newQuestionModal").modal('open');
			console.log("success");
		}
		else{
			console.log("error");	
		}
	})
	.fail(function() {
		console.log("error");
	})
}

function submitNewQuestion() {
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	
	$('#newQuestionForm .question').each(function(index){
		var answers=[];

		$(this).find('.answer').each(function(index) {
			answers.push($(this).val());
		});

		$.ajax({
			url: 'questions',
			type: 'POST',
			data: { _token: CSRF_TOKEN,
				question_text: $(this).find(".question_text").val(),
				question_correct_text: $(this).find(".question_correct_text").val(),
				question_incorrect_text: $(this).find(".question_incorrect_text").val(),
				answers: answers
			},
			error: function (request, status, error) {
			    console.log(request.responseText);
			}
		})
		.done(function(data) {
			if(data==1){
				// $("#newAnswerModal").modal();
				// $("#newAnswerModal").modal('open');
				$("#newQuestionModal").modal('close');
				console.log("success");
				location.reload();
			}
			else{
				console.log("error");	
			}
		})
	});
}

function submitUpdateForm() {
	// $('.submit_button').attr('disabled', true);
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	
	//Guardar todas las preguntas y respuestas en array
	var questions=[];

	$('.question').each(function(index){
		var answers=[];
		
		$(this).find('.answer').each(function(index) {
			if($(this).hasClass('correct-answer')){
				var answer={
					answer_text: $(this).val(),
					answer_correct: 1,
				}
			}
			else{
				var answer={
					answer_text: $(this).val(),
					answer_correct: 0,
				}
			}
			answers.push(answer);
		});

		var question={
			question_text: $(this).find(".question_text").val(),
			question_correct_text: $(this).find(".question_correct_text").val(),
			question_incorrect_text: $(this).find(".question_incorrect_text").val(),
			form_id: $("#form_title").attr('data-form-id'),
			answers: answers
		};
		questions.push(question);
	});

	// console.log(questions);
	
	$.ajax({
		url: 'forms',
		type: 'POST',
		data: { _token: CSRF_TOKEN,
			_method: 'PUT',
			form_id: $("#form_title").attr('data-form-id'),
			form_title: $("#form_title").val(),
			form_category_id: $("#form_category_id option:selected").val(),
			questions: questions,
		},
		error: function (request, status, error) {
			    console.log(request.responseText);
		}

	})
	.done(function(data) {
		window.location.reload();
	})
	.fail(function() {
		console.log("error");
	})
}

function submitDeleteForm() {
	$('#deleteFormForm').submit();
}


$('.newFormModal').modal();

$('.updateFormModal').modal({
	ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
    	$('#update_form_category_name').val(trigger.attr('data-category-name'));
    	$('label[for="update_form_category_name"]').addClass('active');
    	$('#updateFormForm').attr('action','form_categories/'+trigger.attr('data-category-id'));
    	$('#deleteFormModalButton').attr('data-category-id', trigger.attr('data-category-id'));
	},
});

$('.deleteFormModal').modal({
	ready: function(modal, trigger){
		$('#deleteFormForm').attr('action','form_categories/'+trigger.attr('data-category-id'));
	},
});

function addAnswer(el){
	$(el).prev().append('<div class="col s12 m12 answer-container">'+
		'<input name="answer" type="text" class="validate answer" required>'+
		'<label for="answer" data-error="Verifique este campo" data-success="Campo validado">Respuesta incorrecta*</label>'+
    '</div>');
}

function removeAnswer(el){
	if($(el).prev().prev().find('.answer-container').length > 2){
		$(el).prev().prev().find('.answer-container:last').remove();
	}
}

function addQuestion(el, id){
	$('.questions-container').append(
		'<div class="col s12 question new-question" data-question-id="" style="margin-bottom: 10px;">'+
		    '<h5>Pregunta '+($('.question').length+1)+' </h5>'+
		    '<div class="input-field col s12 m12">'+
		        '<input id="question_text'+($('.question').length+1)+'" name="question_text" type="text" class="validate question_text" required>'+
		        '<label for="question_text'+($('.question').length+1)+'" data-error="Verifique este campo" data-success="Campo validado">Pregunta *</label>'+
		    '</div>'+
		    '<div class="input-field col s12 m12">'+
		        '<input id="question_correct_text'+($('.question').length+1)+'" name="question_correct_text" type="text" class="question_correct_text">'+
		        '<label for="question_correct_text'+($('.question').length+1)+'" data-error="Verifique este campo" data-success="Campo validado">Texto a mostrar si se responde correctamente</label>'+
		    '</div>'+
		    '<div class="input-field col s12 m12">'+
		        '<input id="question_incorrect_text'+($('.question').length+1)+'" name="question_incorrect_text" type="text" class="question_incorrect_text">'+
		        '<label for="question_incorrect_text'+($('.question').length+1)+'" data-error="Verifique este campo" data-success="Campo validado">Texto a mostrar si se responde incorrectamente</label>'+
		    '</div>'+
		    '<h5>Respuestas de pregunta '+($('.question').length+1)+'</h5>'+
		    '<div class="answers">'+
                '<div class="col s12 m12 answer-container">'+
                    '<input name="answer" type="text" class="validate answer correct-answer" required>'+
                    '<label for="answer" data-error="Verifique este campo" data-success="Campo validado">Respuesta correcta*</label>'+
                '</div>'+
                '<div class="col s12 m12 answer-container">'+
                    '<input name="answer" type="text" class="validate answer" required>'+
                    '<label for="answer" data-error="Verifique este campo" data-success="Campo validado">Respuesta incorrecta *</label>'+
                '</div>'+
		    '</div>'+
		    '<a href="#" class="btn add-answer" style="margin-right:24px;" onclick="addAnswer(this);">Agregar respuesta</a>'+
		    '<a href="#" class="btn remove-answer" onclick="removeAnswer(this);">Quitar respuesta</a>'+
		'</div>');
	$('.total-questions b').html('');
	$('.total-questions b').append('Total de preguntas: '+($('.question').length));
}

function removeQuestion(el){
	if($('.question').length > 3){
		$('.questions-container .question:last').remove();
	}
	$('.total-questions b').html('');
	$('.total-questions b').append('Total de preguntas: '+($('.question').length));
}
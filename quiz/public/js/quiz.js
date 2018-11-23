function getQuizResult(){

	var total_correct_answers=0;
	$('.quiz-form').each(function(index){
		if($(this).find('input:checked').hasClass('correct')){
			// alert("Respuesta "+index+" correcta");
			total_correct_answers++;
			$(this).find('.answer-incorrect-container').hide();
			$(this).find('.answer-correct-container').show();
		}
		else{
			// alert("Respuesta "+index+" incorrecta");
			$(this).find('.answer-correct-container').hide();
			$(this).find('.answer-incorrect-container').show();
		}
	});
	$(".result-container").html('');
	$(".result-container").append('<h3>'+total_correct_answers+' de '+$('.quiz-form').length+' respuestas correctas</h3>');
}
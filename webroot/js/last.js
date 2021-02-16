function sumPoints(fromClass, toIdElem) {
	var sum = 0;
	$('.'+fromClass).each(function( index ) {
		sum += parseFloat($(this).val());
	});
	console.log(sum);
	$('#'+toIdElem).val(sum);
}

$( document ).ready(function() {
	
	$('#add-question').click(function() {
		var questionContainer = $('#questions');
		var nextIdRow = questionContainer.data('row');

		var html = '<div class="col-md-12 question-row">';
		html += '<span class="question-remove far fa-times-circle"></span>';
		html += '<div class="row">';
		html += '<div class="col-md-2"><div class="form-group"><div class="input text required">';
		html += '<input type="text" name="questions['+nextIdRow+'][label]" class="form-control" placeholder="Etiqueta (max 2)" maxlength="2" required="required" id="questions-'+nextIdRow+'-label">';
		html += '</div></div></div>';
		html += '<div class="col-md-5"><div class="form-group"><div class="input text required">';
		html += '<input type="text" name="questions['+nextIdRow+'][title]" class="form-control" placeholder="Título" required="required" maxlength="128" id="questions-'+nextIdRow+'-title">';
		html += '</div></div></div>';
		html += '<div class="col-md-3"><div class="form-group"><div class="input text required">';
		html += '<input type="text" name="questions['+nextIdRow+'][answer]" class="form-control" placeholder="Respuesta" required="required" maxlength="128" id="questions-'+nextIdRow+'-answer">';
		html += '</div></div></div>';
        html += '<div class="col-md-2"><div class="form-group"><div class="input text required">';
        html += '<input type="number" name="questions['+nextIdRow+'][points]" class="form-control questions-points" placeholder="Puntos" required="required" step="any" value="1" id="questions-'+nextIdRow+'-points">';
        html += '</div></div></div>';
		html += '<div class="col-md-12"><div class="form-group"><div class="input text required">';
		html += '<input type="text" name="questions['+nextIdRow+'][clue]" class="form-control" placeholder="Pista" required="required" id="questions-'+nextIdRow+'-clue">';
		html += '</div></div></div>';
        html += '</div></div>';

		questionContainer.append(html);
		questionContainer.data('row', nextIdRow+1);

		sumPoints('questions-points', 'points');

	});

	$('#questions').on('click', '.question-remove', function() {
		if ($('.question-row').length > 1) {
	    	$(this).parent().remove();
	    	sumPoints('questions-points', 'points');
	    } else {
	    	alert('El desafío debe tener al menos una pregunta.');
	    }
	});

	$('.questions-points').change(function() {
		sumPoints('questions-points', 'points');
	});

});
@extends('layouts.app')
@section('content')
    <div class="container" style="width: 90%;">
        <div class="row card edit-card">
            <div class="col s12">
                <h4>Editar formulario</h4>
            </div>
            <form id="updateFormForm" class="col s12" method="POST">
                {{ csrf_field() }}
                @method('PUT')
                <div class="row" style="margin-bottom: 10px;">
                    <div class="input-field col s12 m12">
                        <input id="form_title" data-form-id="{{$form[0]->form_id}}" name="form_title" type="text" class="validate form_title" value="{{$form[0]->form_title}}" required>
                        <label for="form_title" data-error="Verifique este campo" data-success="Campo validado">Título de la prueba *</label>
                    </div>
                    <div class="col s12 m12">
                        <label>Categoría de la prueba</label>
                        <select id="form_category_id" class="browser-default">
                            @foreach($form_categories as $key=>$value)
                                @if($form[0]->form_category_id == $value->form_category_id)
                                    <option selected value="{{$value->form_category_id}}">{{$value->form_category_name}}</option>
                                @else
                                    <option value="{{$value->form_category_id}}">{{$value->form_category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <div class="col s12 questions-container">
                <span class="total-questions"><b>Total de preguntas:  {{$questions->count()}}</b></span>
                <a href="#" class="btn add-question" style="margin-right:24px;margin-left:24px;" onclick="addQuestion(this);">Agregar pregunta</a>
                <a href="#" class="btn remove-question" onclick="removeQuestion(this);">Quitar pregunta</a>
                @foreach($questions as $key => $value)
                    <div class="col s12 question" data-question-id="{{$value->question_id}}" data-form-id="{{$value->form_id}}" style="margin-bottom: 10px;">
                        <h5>Pregunta {{$key+1}} </h5>
                        <div class="input-field col s12 m12">
                            <input id="question_text{{$key+1}}" name="question_text" type="text" class="validate question_text" value="{{$value->question_text}}" required>
                            <label for="question_text{{$key+1}}" data-error="Verifique este campo" data-success="Campo validado">Pregunta *</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <input id="question_correct_text{{$key+1}}" name="question_correct_text" type="text" value="{{$value->question_correct_text}}" class="question_correct_text">
                            <label for="question_correct_text{{$key+1}}" data-error="Verifique este campo" data-success="Campo validado">Texto a mostrar si se responde correctamente</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <input id="question_incorrect_text{{$key+1}}" name="question_incorrect_text" type="text" value="{{$value->question_incorrect_text}}" class="question_incorrect_text">
                            <label for="question_incorrect_text{{$key+1}}" data-error="Verifique este campo" data-success="Campo validado">Texto a mostrar si se responde incorrectamente</label>
                        </div>
                        <h5>Respuestas de pregunta {{$key+1}}</h5>
                        <div class="answers">
                            @foreach($answers as $key2=>$value2)
                                @if($value2->question_id == $value->question_id && $value2->answer_correct == 1)
                                    <div class="col s12 m12 answer-container">
                                        <input name="answer" type="text" class="validate answer correct-answer" value="{{$value2->answer_text}}" data-answer-id="{{$value2->answer_id}}" required>
                                        <label for="answer" data-error="Verifique este campo" data-success="Campo validado">Respuesta correcta*</label>
                                    </div>
                                @elseif($value2->question_id == $value->question_id && $value2->answer_correct == 0)
                                    <div class="col s12 m12 answer-container">
                                        <input name="answer" type="text" class="validate answer" value="{{$value2->answer_text}}" data-answer-id="{{$value2->answer_id}}" required>
                                        <label for="answer" data-error="Verifique este campo" data-success="Campo validado">Respuesta incorrecta *</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a href="#" class="btn add-answer" style="margin-right:24px;" onclick="addAnswer(this);">Agregar respuesta</a>
                        <a href="#" class="btn remove-answer" onclick="removeAnswer(this);">Quitar respuesta</a>
                    </div>
                @endforeach
            </div>
            <div class="col s12 center">
                <br>
                <form id="deleteFormForm" method="POST">
                    {{ csrf_field() }}
                    @method('DELETE')
                </form>
                <a onclick="submitDeleteForm();" class="left selectable" style="margin-top: 10px;margin-left: 10px;"><i class="material-icons black-text">delete</i></a>
                <a href="#!" class="modal-action modal-close waves-effect btn-flat"><b>Cancelar</b></a>
                <button id="submit_button" onclick="submitUpdateForm();" class="btn waves-effect submit_button"><b>Guardar cambios</b></button><br><br>
            </div>
        </div>
    </div>
@endsection
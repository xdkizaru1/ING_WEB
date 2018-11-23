@extends('layouts.app')
@section('content')
    <div class="container" style="width: 90%;">
    @if($forms->count() ==0)
    	<div class="col s12 center"><h5>No hay pruebas registradas.</h5></div>
    @else
        <div class="row">
    	@foreach($forms as $key=>$value)
            <div class="col s6">
        		<div class="card selectable" data-category-id="{{$value->form_id}}" data-category-title="{{$value->form_title}}" onclick="window.location='{{route('forms.show', $value->form_id)}}'">
                    <div class="card-content truncate">
                        {{$value->form_title}}
                    </div>
        		</div>
            </div>
    	@endforeach
        </div>
    @endif
    </div>
    <a style="position:fixed;bottom: 24px;right: 24px;" class="btn-floating btn-large waves-effect waves-light modal-trigger orange accent-4" href="#newFormModal">
    	<i class="material-icons">add</i>
    </a>
@include('forms.newFormModal')
@include('forms.updateFormModal')
@include('forms.deleteFormModal')
@include('questions.newQuestionModal')
@include('questions.updateQuestionModal')
@include('questions.deleteQuestionModal')
@include('answers.newAnswerModal')
@include('answers.updateAnswerModal')
@include('answers.deleteAnswerModal')
@endsection
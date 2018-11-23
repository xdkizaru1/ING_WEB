@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($questions as $key => $value)
                <div class="card col s12 quiz-form" style="margin-bottom: 0;">
                    <p><b>{{$value->question_text}}</b></p>
                    <div class="row">
                        <div class="col s12">
                        @foreach($answers as $key2 => $value2)
                            @if($value2->question_id == $value->question_id)
                            <p>
                            <label>
                                @if($value2->answer_correct == 1)
                                    <input class="with-gap correct" name="group{{$key}}" type="radio"/>
                                @else
                                    <input class="with-gap" name="group{{$key}}" type="radio"/>
                                @endif
                                <span>{{$value2->answer_text}}</span>
                            </label>
                            </p>
                            @endif
                        @endforeach
                        </div>
                        <div class="col s12 center answer-correct-container" style="display: none;">
                            <p class="green-text"><b>CORRECTO: {{$value->question_correct_text}}</b></p>
                        </div>
                        <div class="col s12 center answer-incorrect-container" style="display: none;">
                            <p class="red-text"><b>INCORRECTO: {{$value->question_incorrect_text}}</b></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col s12 center">
                <a href="#" class="btn" onclick="getQuizResult();">Consultar resultados</a>
            </div>
            <div class="col s12 center result-container"></div>
        </div>
    </div>
@endsection
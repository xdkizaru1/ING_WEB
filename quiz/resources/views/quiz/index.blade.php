@extends('layouts.app')
@section('content')
    <div class="container" style="width: 90%;">
    @if($forms->count() ==0)
        <div class="col s12 center"><h5>No hay pruebas registradas.</h5></div>
    @else
        <div class="row">
        @foreach($forms as $key=>$value)
            <div class="col s6">
                <div class="card">
                    <div class="card-content truncate">
                        <h5>{{$value->form_title}}</h5>
                    </div>
                    <div class="card-action center">
                        <a href="{{route('quiz.show', $value->form_id)}}" class="btn modal-trigger">Resolver</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @endif
    </div>
@endsection
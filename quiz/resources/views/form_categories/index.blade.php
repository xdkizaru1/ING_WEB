@extends('layouts.app')
@section('content')
    <div class="container" style="width: 90%;">
    @if($form_categories->count() ==0)
    	<div class="col s12 center"><h5>No hay categorias registradas.</h5></div>
    @else
        <div class="row">
            <div class="col s12 center"><h4>Categorías</h4></div>
    	@foreach($form_categories as $key=>$value)
            <div class="col s6">
        		<div class="card modal-trigger selectable" data-category-id="{{$value->form_category_id}}" data-category-name="{{$value->form_category_name}}" href="#updateFormCategoryModal">
                    <div class="card-content truncate">
                        <b>{{$value->form_category_name}}</b>
                    </div>
        		</div>
            </div>
    	@endforeach
        </div>
    @endif
    </div>
    <a style="position:fixed;bottom: 24px;right: 24px;" class="btn-floating btn-large waves-effect waves-light modal-trigger orange accent-4" href="#newFormCategoryModal">
    	<i class="material-icons">add</i>
    </a>
@include('form_categories.newFormCategoryModal')
@include('form_categories.updateFormCategoryModal')
@include('form_categories.deleteFormCategoryModal')
@endsection
@extends('layouts.main')

@section('content')
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['CategoriesController@update', $category->id]]) !!}
        @include('categories.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
@endsection
@extends('layouts.main')

@section('content')
    {!! Form::open(['action' => 'CategoriesController@index']) !!}
        @include('categories.form', ['submitButtonText' => 'Create'])
    {!! Form::close() !!}
@endsection
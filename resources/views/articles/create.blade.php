@extends('layouts.main')

@section('content')
    {!! Form::open(['action' => 'ArticlesController@index']) !!}
    @include('articles.form', ['submitButtonText' => 'Create', 'categories' => $categories, 'tags' => $tags])
    {!! Form::close() !!}
@endsection
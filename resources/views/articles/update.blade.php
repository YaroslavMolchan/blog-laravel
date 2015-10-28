@extends('layouts.main')

@section('content')
    {!! Form::model($article, ['url' => '/articles/'.$article->id, 'method' => 'PUT']) !!}
    @include('articles.form', ['submitButtonText' => 'Update', 'categories' => $categories, 'tags' => $tags, 'selected_tags' => $selected_tags])
    {!! Form::close() !!}
@endsection
@extends('layouts.main')

@section('content')
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['TagsController@update', $tag->id]]) !!}
        @include('tags.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
@endsection
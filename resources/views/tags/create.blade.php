@extends('layouts.main')

@section('content')
    {!! Form::open(['action' => 'TagsController@index']) !!}
        @include('tags.form', ['submitButtonText' => 'Create'])
    {!! Form::close() !!}
@endsection
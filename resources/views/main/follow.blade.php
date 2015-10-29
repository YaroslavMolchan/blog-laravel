@extends('layouts.main')

@section('content')
    <h2 class="text-center">Signup today for free and be the first to get notified on new updates.</h2>
    {!! Form::open() !!}

    <div class="form-group field-email">
        {!! Form::text('email', Cookie::get('email'), ['class' => 'form-control', 'placeholder' => 'Your Email']) !!}
        <p class="help-block"></p>
    </div>

    @include('errors.list')

    <div class="form-group">
        {!! Form::submit('Subscribe now', ['class' => 'btn btn-primary center-block']) !!}
    </div>
    {!! Form::close() !!}
@endsection
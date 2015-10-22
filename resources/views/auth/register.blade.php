@extends('layouts.main')

@section('content')
    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" placeholder="Username">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control"  placeholder="Password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"  placeholder="Password Confirmation">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-default">Register</button>
        </div>
    </form>
    @include('errors.list')
@endsection
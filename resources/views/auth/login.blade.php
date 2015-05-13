@extends('frontend')

@section('title','Login')

@section('content')
{!! Form::open() !!}
    <p>
        {!! Form::label('email','E-Mail') !!}
        {!! Form::text('email') !!}
    </p>
    <p>
        {!! Form::label('password','Password') !!}
        {!! Form::password('password') !!}
    </p>

    {!! Form::submit('Login') !!}
{!! Form::close() !!}
@stop
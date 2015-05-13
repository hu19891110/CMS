@extends('frontend')

@section('title','Register')

@section('content')
    {!! Form::open(['route'=>'api.user.store']) !!}
    @include('api.user.form',['submitButtonText'=>'Register'])
    {!! Form::close() !!}
@endsection
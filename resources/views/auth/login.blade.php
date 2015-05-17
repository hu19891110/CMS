@extends('frontend')

@section('title','Login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">
                {!! Form::open() !!}
                <h2 class="form-signin-heading">Please sign in</h2>
                {!! Form::label('email','E-Mail') !!}
                {!! Form::text('email',null,['class'=>'form-control']) !!}
                {!! Form::label('password','Password') !!}
                {!! Form::password('password',['class'=>'form-control']) !!}
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                {!! Form::submit('Login',['class'=>'btn btn-lg btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div> <!-- /container -->
@stop
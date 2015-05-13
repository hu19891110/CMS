<p>
    {!! Form::label('name_first','First Name') !!}
    {!! Form::text('name_first') !!}
</p>
<p>
    {!! Form::label('name_middle','Middle Name') !!}
    {!! Form::text('name_middle') !!}
</p>
<p>
    {!! Form::label('name_last','Last Name') !!}
    {!! Form::text('name_last') !!}
</p>
<p>
    {!! Form::label('email','E-Mail Address') !!}
    {!! Form::text('email') !!}
</p>
<p>
    {!! Form::label('username','Username') !!}
    {!! Form::text('username') !!}
</p>
<p>
    {!! Form::label('password','Password') !!}
    {!! Form::password('password') !!}
</p>
<p>
    {!! Form::label('password_confirmation','Confirm Password') !!}
    {!! Form::password('password_confirmation') !!}
</p>

{!! Form::submit($submitButtonText) !!}
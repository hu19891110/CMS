<html>
<head>
    <title>Create User</title>
</head>
<body>
{!! Form::open(['route'=>'api.user.store']) !!}
    @include('api.user.form',['submitButtonText'=>'Create User'])
{!! Form::close() !!}

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

</body>
</html>
<html>
<head>
    <title>Create Role</title>
</head>
<body>
{!! Form::open(['route'=>'api.role.store']) !!}
    @include('api.role.form',['submitButtonText'=>'Create Role'])
{!! Form::close() !!}

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

</body>
</html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
{!! Form::model($user, ['method'=>'PATCH', 'route'=>['api.user.update', $user]]) !!}
    @include('api.user.form',['submitButtonText'=>'Update User'])
{!! Form::close() !!}

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

</body>
</html>
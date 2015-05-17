<html>
<head>
    <title>Edit Role</title>
</head>
<body>
{!! Form::model($role, ['method'=>'PATCH', 'route'=>['api.role.update', $role]]) !!}
    @include('api.role.form',['submitButtonText'=>'Update Role'])
{!! Form::close() !!}

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

</body>
</html>
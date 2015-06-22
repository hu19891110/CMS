<html>
<head>
    <title>Create Project</title>
</head>
<body>
{!! Form::open(['route'=>'api.project.store']) !!}
    @include('api.project.form',['submitButtonText'=>'Create Project'])
{!! Form::close() !!}

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

</body>
</html>
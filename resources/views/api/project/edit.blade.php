<html>
<head>
    <title>Edit Project</title>
</head>
<body>
{!! Form::model($project, ['method'=>'PATCH', 'route'=>['api.project.update', $project]]) !!}
    @include('api.project.form',['submitButtonText'=>'Update Project'])
{!! Form::close() !!}

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

</body>
</html>
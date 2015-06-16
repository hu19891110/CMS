<html>
<head>
    <title>Create Page</title>
</head>
<body>
{!! Form::open(['route'=>'api.page.store']) !!}
    @include('api.page.form',['submitButtonText'=>'Create Page'])
{!! Form::close() !!}

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

</body>
</html>
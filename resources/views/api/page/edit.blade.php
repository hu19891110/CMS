<html>
<head>
    <title>Edit Page</title>
</head>
<body>
{!! Form::model($page, ['method'=>'PATCH', 'route'=>['api.page.update', $page]]) !!}
    @include('api.page.form',['submitButtonText'=>'Update Page'])
{!! Form::close() !!}

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

</body>
</html>
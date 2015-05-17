@extends('backend')
@section('title','Admin - Role - Edit')
@section('subtitle',$role->name)
@section('content')
    {!! Form::model($role, ['method'=>'PATCH', 'route'=>['api.role.update', $role],'id'=>'edit-role-form']) !!}
    @include('api.role.form',['submitButtonText'=>'Update Role'])
    {!! Form::close() !!}
@stop
@section('javascript')
    <script>
        // prepare the form when the DOM is ready
        $(document).ready(function() {
            var options = {
                success:       successMessage,  // post-submit callback
                error: errorJson,
                dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type)
                //clearForm: true,        // clear all form fields after successful submit
                //resetForm: true,        // reset the form after successful submit
                timeout:   3000,
            };

            // bind to the form's submit event
            $('#edit-role-form').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });

            function successMessage(json)
            {
                var str = '@oneLine('backend.role._partials.alerts.role-edited')';
                $('#alert-area').append(str);
            }
        });
    </script>
@endsection
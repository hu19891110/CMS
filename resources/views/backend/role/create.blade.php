@extends('backend')
@section('title','Admin - Role - Create')
@section('content')
    {!! Form::open(['route'=>'api.role.store','id'=>'create-role-form']) !!}
    @include('api.role.form',['submitButtonText'=>'Create Role'])
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
                clearForm: true,        // clear all form fields after successful submit
                resetForm: true,        // reset the form after successful submit
                timeout:   3000,
            };

            // bind to the form's submit event
            $('#create-role-form').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });

            function successMessage(json)
            {
                var str = '@oneLine('backend.role._partials.alerts.role-created')';
                $('#alert-area').append(str);
            }
        });
    </script>
@endsection
@extends('backend')
@section('title','Admin - Page - Create')
@section('content')
    {!! Form::open(['route'=>'api.page.store','id'=>'create-page-form']) !!}
    @include('api.page.form',['submitButtonText'=>'Create Page'])
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
            $('#create-page-form').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });

            function successMessage(json)
            {
                var str = '@oneLine('backend.page._partials.alerts.page-created')';
                $('#alert-area').append(str);
            }
        });
    </script>
    @include('backend.page._partials.auto-complete-js')
    @include('backend.page._partials.order-js')
@endsection
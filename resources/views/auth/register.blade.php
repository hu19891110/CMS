@extends('frontend')

@section('title','Register')

@section('content')
    {!! Form::open(['route'=>'api.user.store','id'=>'register-user-form']) !!}
        @include('api.user.form',['submitButtonText'=>'Register'])
    {!! Form::close() !!}
@endsection
@section('javascript')
    <script>
        // prepare the form when the DOM is ready
        $(document).ready(function() {
            var options = {
                success: successMessage,  // post-submit callback
                error: errorJson,
                dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type)
                timeout:   3000,
            };

            // bind to the form's submit event
            $('#register-user-form').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });
        });
        function successMessage(json)
        {
            var str = '@oneLine('auth._partials.registered-alert')';
            $('#alert-area').append(str);
        }
    </script>
@endsection
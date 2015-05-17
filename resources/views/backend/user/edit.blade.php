@extends('backend')
@section('title','Admin - User - Edit')
@section('subtitle',$user->username)
@section('content')
    {!! Form::model($user, ['method'=>'PATCH', 'route'=>['api.user.update', $user],'id'=>'edit-user-form']) !!}
        @include('api.user.form',['submitButtonText'=>'Update User'])
    {!! Form::close() !!}
@stop
@section('javascript')
    <script>
        // prepare the form when the DOM is ready
        $(document).ready(function() {
            var options = {
                //target:        '#myResultsDiv',   // target element(s) to be updated with server response
                //beforeSubmit:  showRequest,  // pre-submit callback
                success:       successMessage,  // post-submit callback
                error: errorJson,
                // other available options:
                //url:       url         // override for form's 'action' attribute
                //type:      type        // 'get' or 'post', override for form's 'method' attribute
                dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type)
                //clearForm: true        // clear all form fields after successful submit
                //resetForm: true        // reset the form after successful submit

                // $.ajax options can be used here too, for example:
                timeout:   3000
            };

            // bind to the form's submit event
            $('#edit-user-form').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });

            function successMessage(json)
            {

                $('#alert-area').append('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>User Updated!</div>')
            }
        });
    </script>
@endsection
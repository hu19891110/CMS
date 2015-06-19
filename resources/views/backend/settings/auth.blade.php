@extends('backend')
@section('title','Admin - Auth - Settings')
@section('subtitle','User Controls and Settings')
@section('css')
@stop
@section('content')
    {!! Form::open(['id'=>'auth-settings']) !!}
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="publicSignup">Can anyone Sign-up?</label>
                    <select name="publicSignup" class="form-control">
                        <option value="1" @if(Config::get('publicSignup')) selected @endif>Yes</option>
                        <option value="0" @if(!Config::get('publicSignup')) selected @endif>No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {!! Form::submit('Save Settings', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
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
                timeout:   3000
            };

            // bind to the form's submit event
            $('#auth-settings').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });

            function successMessage(json)
            {
                if (json.errors)
                    $.each(json.errors, function () {
                        $('#alert-area').append('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-cross"></i> Warning!</h4>' + this + '</div>');
                    });
                var str = '@oneLine('backend.settings._partials.updated')';
                $('#alert-area').append(str);
            }
        });
    </script>
@endsection
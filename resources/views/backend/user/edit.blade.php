@extends('backend')
@section('title','Admin - User - Edit')
@section('subtitle',$user->username)
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit {{$user->name_full}}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($user, ['method'=>'PATCH', 'route'=>['api.user.update', $user],'id'=>'edit-user-form']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name_first','First Name') !!}
                            {!! Form::text('name_first',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name_middle','Middle Name') !!}
                            {!! Form::text('name_middle',null,['class'=>"form-control"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name_last','Last Name') !!}
                            {!! Form::text('name_last',null,['class'=>"form-control"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email','E-Mail Address') !!}
                            {!! Form::text('email',null,['class'=>"form-control"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('username','Username') !!}
                            {!! Form::text('username',null,['class'=>"form-control"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password','Password') !!}
                            {!! Form::password('password',['class'=>"form-control"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation','Confirm Password') !!}
                            {!! Form::password('password_confirmation',['class'=>"form-control"]) !!}
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            {!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


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
                // inside event callbacks 'this' is the DOM element so we first
                // wrap it in a jQuery object and then invoke ajaxSubmit
                $(this).ajaxSubmit(options);

                // !!! Important !!!
                // always return false to prevent standard browser submit and page navigation
                return false;
            });

            function successMessage()
            {

                $('#alert-area').append('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>User Updated!</div>')
            }
        });
    </script>
@endsection
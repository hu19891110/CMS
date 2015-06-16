@extends('backend')
@section('title','Admin - Page - Edit')
@section('subtitle',$page->slug)
@section('css')
    {!! HTML::style( asset('assets/vendor/jquery-ui/themes/base/jquery-ui.css') ) !!}
    {!! HTML::style( asset('assets/vendor/widearea/widearea.css') ) !!}
@stop
@section('content')
    {!! Form::model($page, ['method'=>'PATCH', 'route'=>['api.page.update', $page],'id'=>'edit-page-form']) !!}
    @include('api.page.form',['submitButtonText'=>'Update Page'])
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
            $('#edit-page-form').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });

            function successMessage(json)
            {
                if (json.errors)
                    $.each(json.errors, function () {
                        $('#alert-area').append('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-cross"></i> Warning!</h4>' + this + '</div>');
                    });
                var str = '@oneLine('backend.page._partials.alerts.page-edited')';
                $('#alert-area').append(str);
            }
        });
    </script>
    @include('backend.page._partials.auto-complete-js')
@endsection
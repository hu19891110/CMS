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
    <script>
        $(document).ready(function() {
            //Owner
            $( "#owner_name" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "{!! URL::route('api.autocomplete',['type'=>'page-owner']) !!}",
                        dataType: "json",
                        data: {
                            q: request.term
                        },
                        success: function( data ) {
                            response(
                                $.map(data, function (value, key) {
                                    return {
                                        label: value.username,
                                        value: value.id
                                    };
                                })
                            );
                        }
                    });
                },
                minLength: 2,
                select: function( event, ui ) {
                    if(ui.item) {
                        $("#owner_name").val(ui.item.label);
                        $("#owner_id").val(ui.item.value);
                    }
                    return false;
                }
            });
            $("#owner_id").hide();
            $("#owner_id_label").hide();

            //Creator
            $( "#creator_name" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "{!! URL::route('api.autocomplete',['type'=>'page-creator']) !!}",
                        dataType: "json",
                        data: {
                            q: request.term
                        },
                        success: function( data ) {
                            response(
                                    $.map(data, function (value, key) {
                                        return {
                                            label: value.username,
                                            value: value.id
                                        };
                                    })
                            );
                        }
                    });
                },
                minLength: 2,
                select: function( event, ui ) {
                    if(ui.item) {
                        $("#creator_name").val(ui.item.label);
                        $("#creator_id").val(ui.item.value);
                    }
                    return false;
                }
            });
            $("#creator_id").hide();
            $("#creator_id_label").hide();
        });
    </script>
@endsection
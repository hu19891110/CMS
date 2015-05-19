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
    {!! HTML::script( asset('assets/vendor/widearea/widearea.js') ) !!}
    <script>
        // prepare the form when the DOM is ready
        $(document).ready(function() {
            wideArea();
        });
    </script>
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
                        url: "{!! URL::route('api.autocomplete',['type'=>'user']) !!}",
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
                        url: "{!! URL::route('api.autocomplete',['type'=>'user']) !!}",
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
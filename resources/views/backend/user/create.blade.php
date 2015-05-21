@extends('backend')
@section('title','Admin - User - Create')
@section('css')
    {!! HTML::style( asset('assets/vendor/jquery-ui/themes/base/jquery-ui.css') ) !!}
@stop
@section('content')
    {!! Form::open(['route'=>'api.user.store','id'=>'create-user-form']) !!}
    @include('api.user.form',['submitButtonText'=>'Create User'])
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
            $('#create-user-form').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });

            function successMessage(json)
            {
                var str = '@oneLine('backend.user._partials.alerts.user-created')';
                $('#alert-area').append(str);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            function split( val ) {
                return val.split( /,\s*/ );
            }

            function extractLast( term ) {
                return split( term ).pop();
            }
            function addCheckbox(name,value) {
                var container = $('#cblist');
                var inputs = container.find('input');
                var id = inputs.length+1;

                html ='<label><input checked id="permission'+id+'" type="checkbox" value="'+value+'" name="permission[]"/>';
                html +=name+"</label>";
                $('#cblist').append(html);
                return true;
            }
            $( "#permissions_search" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "{!! URL::route('api.autocomplete',['type'=>'permission']) !!}",
                        dataType: "json",
                        data: {
                            q: extractLast( request.term )
                        },
                        success: function( data ) {
                            response(
                                    $.map(data, function (value, key) {
                                        return {
                                            label: value.name,
                                            value: value.id
                                        };
                                    })
                            );
                        }
                    });
                },
                select: function( event, ui ) {
                    this.value = "";
                    addCheckbox(ui.item.label,ui.item.value);
                    return false;
                },
                focus: function() {
                    // prevent value inserted on focus when navigating the drop down list
                    return false;
                }
            });
        });
    </script>
@endsection
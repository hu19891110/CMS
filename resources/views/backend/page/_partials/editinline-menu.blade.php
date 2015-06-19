<div id='parent'>
    <div id='child'>
        <button type="button btn-default" class="btn" data-toggle="modal" data-target="#Edit-Page-{{$page->id}}">
            <i class="fa fa-gear"></i> Details
        </button>
        <button type="button btn-default" class="btn" id="Save-Page">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
</div>
<div class="modal fade" id="Edit-Page-{{$page->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Page: {{$page->slug}}</h4>
            </div>
            <div class="modal-body ui-front">
                {!! Form::model($page, ['method'=>'PATCH', 'route'=>['api.page.update', $page],'id'=>'edit-page-form','name'=>'edit-page-form']) !!}
                @include('api.page.form',['submitButtonText'=>'HIDDEN'])
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
{!! HTML::script( asset('/assets/vendor/ContentBuilder/scripts/contentbuilder.js') ) !!}
{!! HTML::script( asset('/assets/vendor/ContentBuilder/scripts/saveimages.js') ) !!}
<script type="text/javascript">
    $(document).ready(function() {

        $("#contentarea").contentbuilder({
            zoom: 1,
            snippetOpen: true,
            snippetFile: '/assets/vendor/ContentBuilder/assets/cmit-default/snippets.html'
        });

        $('#page_content_box').hide();
        $('#page_actions_box').hide();
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
<script>
    // prepare the form when the DOM is ready
    $(document).ready(function() {
        var options = {
            success:       successMessage,  // post-submit callback
            error: errorJson,
            type: 'POST',
            url: $('form#edit-page-form').attr('action'),
            data: $('form#edit-page-form').serialize(),
            timeout:   3000
        };

        $('#Save-Page').click(function(){
            //Save Images
            $("#contentarea").saveimages({
                handler: '/saveimage.php',
                onComplete: function () {
                    var sHTML = $('#contentarea').data('contentbuilder').html();
                    $('#content').val(sHTML);
                    if($('form[name=edit-page-form]').submit(function(){return false;})){
                        $.ajax({
                            type: 'POST',
                            url: $('form[name=edit-page-form]').attr('action'),
                            data: $('form[name=edit-page-form]').serialize(),
                            success:       successMessage,
                            error: errorJson,
                        });
                    }
                }
            });
            $("#contentarea").data('saveimages').save();

            return false;
        });

        function successMessage(json)
        {
            var str = '@oneLine('backend.page._partials.alerts.page-edited')';
            $('#alert-area').append(str);
        }
    });
</script>
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
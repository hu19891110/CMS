<script>
    function banUser(id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "PUT",
            dataType: "json",
            url: '{{URL::route('api.user.update',['user'=>null])}}/'+id,
            data: { status: "banned", }
        }).done(function(json) {
            processBanJson(json)
        }).fail(function(json){
            errorJson(json);
        }).always(function(json){
            closeBan();
        });
    }
    function unbanUser(id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "PUT",
            url: '{{URL::route('api.user.update',['user'=>null])}}/'+id,
            data: { status: "registered", }
        }).done(function(json) {
            processBanJson(json,id)
        }).fail(function(json){
            errorJson(json);
        });
    }
    function closeBan(id){
        $('#Ban-User-'+id).modal('hide');
        $('#Unban-User-'+id).modal('hide');
    }
    function processBanJson(json, id)
    {
        if (json.errors)
            $.each(json.errors, function () {
                $('#alert-area').append('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-cross"></i> Warning!</h4>' + this + '</div>');
            });
        else
            if(json.user.status=="banned")
            {
                //The user was just banned
                var str = '@oneLine('backend.user._partials.alerts.user-banned')';
                $('#alert-area').append(str) ;
                $('#Ban-User-'+json.user.id+'-btn').hide();
                $('#Unban-User-'+json.user.id+'-btn').show();
            }else{
                //The user is no longer banned
                var str = '@oneLine('backend.user._partials.alerts.user-unbanned')';
                $('#alert-area').append(str) ;
                $('#Ban-User-'+json.user.id+'-btn').show();
                $('#Unban-User-'+json.user.id+'-btn').hide();
            }
        closeBan(json.user.id);
        $('#User-Status-'+json.user.id).html(json.user.status);
    }
</script>
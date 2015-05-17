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
            processBanJson(json)
        }).fail(function(json){
            errorJson(json);
        }).always(function(json){
            closeBan();
        });
    }
    function closeBan()
    {
        $('#Ban-User-'+id).modal('hide');
        $('#Unban-User-'+id).modal('hide');
    }
    function processBanJson(json, id)
    {
        if(json.user.status=="banned")
        {
            //The user was just banned
            var str = '@oneLine('backend.user._partials.alerts.user-banned')';
            $('#alert-area').append(str) ;
            $('#Ban-User-'+json.user.id).modal('hide');
            $('#Ban-User-'+json.user.id+'-btn').hide();
            $('#Unban-User-'+json.user.id+'-btn').show();
        }else{
            //The user is no longer banned
            var str = '@oneLine('backend.user._partials.alerts.user-unbanned')';
            $('#alert-area').append(str) ;
            $('#Unban-User-'+json.user.id).modal('hide');
            $('#Ban-User-'+json.user.id+'-btn').show();
            $('#Unban-User-'+json.user.id+'-btn').hide();
        }
        $('#User-Status-'+json.user.id).html(json.user.status);
    }
</script>
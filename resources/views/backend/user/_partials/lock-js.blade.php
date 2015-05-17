<script>
    function lockUser(id)
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
            data: {
                status: "locked",
                status_ts: $('#Lock-User-Expire-'+id).val(),
            }
        }).done(function(json) {
            processLockJson(json)
        }).fail(function(json){
            errorJson(json);
        }).always(function(json){
            closeLock();
        });
    }

    function unlockUser(id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "PUT",
            url: '{{URL::route('api.user.update',['user'=>null])}}/'+id,
            data: {
                status: "registered",
                status_ts: $('#Lock-User-Expire-'+id).val(),
            }
        }).done(function(json) {
            processLockJson(json)
        }).fail(function(json){
            errorJson(json);
        });

        closeLock(id);
    }
    function closeLock(id){
        $('#Lock-User-'+id).modal('hide');
        $('#Unlock-User-'+id).modal('hide');
    }
    function processLockJson(json, id)
    {
        if(json.user.status=="locked")
        {
            //The user was just banned
            var str = '@oneLine('backend.user._partials.alerts.user-locked')';
            $('#alert-area').append(str) ;
            $('#Lock-User-'+json.user.id).modal('hide');
            $('#Lock-User-'+json.user.id+'-btn').hide();
            $('#Unlock-User-'+json.user.id+'-btn').show();
        }else{
            //The user is no longer banned
            var str = '@oneLine('backend.user._partials.alerts.user-unlocked')';
            $('#alert-area').append(str) ;
            $('#Unlock-User-'+json.user.id).modal('hide');
            $('#Lock-User-'+json.user.id+'-btn').show();
            $('#Unlock-User-'+json.user.id+'-btn').hide();
        }
        $('#User-Status-'+json.user.id).html(json.user.status);
    }
</script>
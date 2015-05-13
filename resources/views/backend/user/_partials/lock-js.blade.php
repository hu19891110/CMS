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
            data: { status: "locked", }
        })
                .done(function( json ) {
                    processLockJson(json);
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
            data: { status: "registered", }
        })
                .done(function( json ) {
                    processLockJson(json);
                });
    }

    function processLockJson(json)
    {
        if(json.success)
        {
            if(json.user.status=="banned")
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
        }
        else
        {
            alert( "Error Occured" );
        }
        $('#User-Status-'+json.user.id).html(json.user.status);
    }
</script>
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
        }).done(function(json,id) {
            processLockJson(json,id)
        }).fail(function(json){
            errorJson(json);
        }).always(function(id){
            closeLock(id);
        });
    }
    function closeLock(id){
        $('#Lock-User-'+id).modal('hide');
        $('#Unlock-User-'+id).modal('hide');
    }
    function processLockJson(json, id)
    {
        if (json.errors)
            $.each(json.errors, function () {
                $('#alert-area').append('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-cross"></i> Warning!</h4>' + this + '</div>');
            });
        else
            if(json.user.status=="locked")
            {
                //The user was just locked
                var str = '@oneLine('backend.user._partials.alerts.user-locked')';
                $('#alert-area').append(str) ;
                $('#Lock-User-'+json.user.id+'-btn').hide();
                $('#Unlock-User-'+json.user.id+'-btn').show();
            }else{
                //The user is no longer locked
                var str = '@oneLine('backend.user._partials.alerts.user-unlocked')';
                $('#alert-area').append(str) ;
                $('#Lock-User-'+json.user.id+'-btn').show();
                $('#Unlock-User-'+json.user.id+'-btn').hide();
            }
        closeLock(json.user.id);
        $('#User-Status-'+json.user.id).html(json.user.status);
    }
</script>
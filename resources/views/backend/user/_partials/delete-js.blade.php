<script>
    function deleteUser(id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "DELETE",
            dataType: "json",
            url: '{{URL::route('api.user.destroy',['user'=>null])}}/'+id,
        }).done(function(json) {
            if (json.errors)
                $.each(json.errors, function () {
                    $('#alert-area').append('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-cross"></i> Warning!</h4>' + this + '</div>');
                });
            else
                $('#User-'+id+'-tr').hide();

        }).fail(function(json){
            errorJson(json);
        });
        $('#Delete-User-'+id).modal('hide');
    }
</script>
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
        }).done(function(json){
            $('#User-'+id+'-tr').hide();
        }).fail(function(json){
            errorJson(json);
        });
        $('#Delete-User-'+id).modal('hide');
    }
</script>
<script>
    function deleteRole(id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "DELETE",
            dataType: "json",
            url: '{{URL::route('api.role.destroy',['role'=>null])}}/'+id,
        }).done(function(json){
            $('#Role-'+id+'-tr').hide();
        }).fail(function(json){
            errorJson(json);
        }).trigger( "updatedAlerts" );;
        $('#Delete-Role-'+id).modal('hide');
    }
</script>
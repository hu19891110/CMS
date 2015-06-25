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
            url: '{{URL::route('api.page.destroy',['page'=>null])}}/'+id,
        }).done(function(json){
            $('#Page-'+id+'-tr').hide();
        }).fail(function(json){
            errorJson(json);
        }).trigger( "updatedAlerts" );
        $('#Delete-Page-'+id).modal('hide');
    }
</script>
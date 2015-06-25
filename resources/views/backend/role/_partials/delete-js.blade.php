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
            if (json.errors)
                $.each(json.errors, function () {
                    $('#alert-area').append('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-cross"></i> Warning!</h4>' + this + '</div>');
                });
            else
                $('#Role-'+id+'-tr').hide();
        }).fail(function(json){
            errorJson(json);
        }).trigger( "updatedAlerts" );
        $('#Delete-Role-'+id).modal('hide');
    }
</script>
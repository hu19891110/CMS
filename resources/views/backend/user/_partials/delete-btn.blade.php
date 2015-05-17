<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#Delete-User-{{$user->id}}">
    <i class="fa fa-user-times"></i>
</button>
<div class="modal fade" id="Delete-User-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete User: {{$user->name_full}}</h4>
            </div>
            <div class="modal-body">
                <div class="callout callout-danger">
                    <h4>Danger</h4>
                    <p>This user will be deleted.</p>
                    <p>All content owned by this user will also be deleted.</p>
                    <p><strong>This can not be undone!</strong></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="javascript:deleteUser({{$user->id}})">Delete User</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
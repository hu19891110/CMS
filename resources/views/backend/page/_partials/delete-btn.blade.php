<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#Delete-Page-{{$page->id}}">
    <i class="fa fa-user-times"></i>
</button>
<div class="modal fade" id="Delete-Page-{{$page->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Page: {{$page->slug}}</h4>
            </div>
            <div class="modal-body">
                <div class="callout callout-danger">
                    <h4>Danger</h4>
                    <p>This Page will be deleted.</p>
                    <h4>Make sure you want to do this!</h4>
                    <p><strong>This can not be undone!</strong></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="javascript:deleteRole({{$page->id}})">Delete User</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
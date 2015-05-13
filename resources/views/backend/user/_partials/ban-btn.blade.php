
    <button
            type="button"
            class="btn btn-warning btn-xs"
            data-toggle="modal"
            data-target="#Ban-User-{{$user->id}}"
            id="Ban-User-{{$user->id}}-btn"
            @if($user->status=="banned")
                style="display:none"
            @endif
            >
        <i class="fa fa-ban"></i>
    </button>
    <button
            type="button"
            class="btn btn-success btn-xs"
            data-toggle="modal"
            data-target="#Unban-User-{{$user->id}}"
            id="Unban-User-{{$user->id}}-btn"
            @if($user->status!="banned")
                style="display:none"
            @endif
            >
        <i class="fa fa-circle-o"></i>
    </button>
    <div class="modal fade" id="Ban-User-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Ban User: {{$user->name_full}}</h4>
                </div>
                <div class="modal-body">
                    <div class="callout callout-warning">
                        <h4>Danger</h4>
                        <p>This user will no longer be allowed to access your website.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" onclick="javascript:banUser({{$user->id}})">Ban User</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="Unban-User-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Unban User: {{$user->name_full}}</h4>
                </div>
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h4>Info:</h4>
                        <p>This user will have access to the website again!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" onclick="javascript:unbanUser({{$user->id}})">Unban User</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
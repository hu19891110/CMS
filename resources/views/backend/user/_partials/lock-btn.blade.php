    <button
            type="button"
            class="btn btn-info btn-xs"
            data-toggle="modal"
            data-target="#Lock-User-{{$user->id}}"
            id="Lock-User-{{$user->id}}-btn"
    @if($user->status=="locked")
            style="display:none"
            @endif
            >
        <i class="fa fa-lock"></i>
    </button>
    <button
            type="button"
            class="btn btn-success btn-xs"
            data-toggle="modal"
            data-target="#Unlock-User-{{$user->id}}"
            id="Unlock-User-{{$user->id}}-btn"
    @if($user->status!="locked")
            style="display:none"
            @endif
            >
        <i class="fa fa-unlock"></i>
    </button>

    <div class="modal fade" id="Lock-User-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Lock User: {{$user->name_full}}</h4>
                </div>
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h4>Warning</h4>
                        <p>While this user is locked they will be unable to access your website.</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('lock_expire','When should the user be Unlocked?') !!}
                        <br>
                        {!! Form::text('lock_expire',\Carbon\Carbon::now()->addDays(7),['class'=>'datetimepicker form-control', 'id'=>'Lock-User-Expire-'.$user->id]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info" onclick="javascript:lockUser({{$user->id}})">Lock User</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="Unlock-User-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Unlock User: {{$user->name_full}}</h4>
                </div>
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h4>Warning</h4>
                        <p>While this user is locked they will be unable to access your website.</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('lock_expire','When should the user be Unlocked?') !!}
                        <br>
                        {!! Form::text('lock_expire',\Carbon\Carbon::now(),['class'=>'datetimepicker form-control', 'id'=>'Lock-User-Expire-'.$user->id]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info" onclick="javascript:unlockUser({{$user->id}})">Unlock User</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

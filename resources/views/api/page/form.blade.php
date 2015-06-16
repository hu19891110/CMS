<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Page Settings</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('title','Page title') !!}
                    {!! Form::text('title',null,['class'=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description','Description') !!}
                    {!! Form::text('description',null,['class'=>"form-control"]) !!}
                </div>
                @permission('page.system')
                    <div class="form-group">
                        {!! Form::label('system','Page Type') !!}
                        {!! Form::select('system', [false=>'Normal',true=>'System'], null, ['class'=>"form-control"]) !!}
                    </div>
                @endpermission
                @permission('page.review')
                    @permission('page.publish')
                        <div class="form-group">
                            {!! Form::label('status','Status') !!}
                            {!! Form::select('status', ["draft"=>'Draft',"review"=>'Under Review',"unpublished"=>'Unpublished', "published"=>'Published'], null, ['class'=>"form-control"]) !!}
                        </div>
                    @else
                        <div class="form-group">
                            {!! Form::label('status','Status') !!}
                            {!! Form::select('status', ["draft"=>'Draft',"review"=>'Under Review',"unpublished"=>'Unpublished'], null, ['class'=>"form-control"]) !!}
                        </div>
                    @endpermission
                @else
                    <div class="form-group">
                        {!! Form::label('status','Status') !!}
                        {!! Form::select('status', ["draft"=>'Draft',"review"=>'Under Review'], null, ['class'=>"form-control"]) !!}
                    </div>
                @endpermission
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Page Users</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('owner_name','Owner') !!}
                    {!! Form::text('owner_name', null,['class'=>"form-control",'id'=>'owner_name']) !!}
                    {!! Form::label('owner_id','Owner Id',['id'=>'owner_id_label']) !!}
                    {!! Form::text('owner_id',null,['class'=>"form-control",'id'=>'owner_id']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('creator_name','Creator') !!}
                    {!! Form::text('creator_name', null,['class'=>"form-control",'id'=>'creator_name']) !!}
                    {!! Form::label('creator_id','Creator Id',['id'=>'creator_id_label']) !!}
                    {!! Form::text('creator_id',null,['class'=>"form-control",'id'=>'creator_id']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div id="page_actions_box" class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Actions</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::submit(isset($submitButtonText)?$submitButtonText:"Submit",['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div id="page_content_box" class="box box-danger collapsed-box">
            <div class="box-header">
                <h3 class="box-title">Page Raw HTML</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <!--<button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>-->
                </div>
            </div><!-- /.box-header -->
            <div style="display: none;" class="box-body">
                <div class="form-group">
                    {!! Form::textarea('content',isset($pageContent)?$pageContent:"<p>Default Page Content</p>",['class'=>"form-control widearea",'data-widearea'=>"enable",'id'=>"content"]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
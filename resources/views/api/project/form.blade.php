<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Project Settings</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('title','Project title') !!}
                    {!! Form::text('title',null,['class'=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description','Project Description') !!}
                    {!! Form::text('description',null,['class'=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status','Status') !!}
                    {!! Form::select('status', ["draft"=>'Draft',"unpublished"=>'Unpublished',"published"=>"Published","funded"=>"Funded"], null, ['class'=>"form-control"]) !!}
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
                </div>
            </div><!-- /.box-header -->
            <div style="display: none;" class="box-body">
                <div class="form-group">
                    {!! Form::textarea('content',"<p>Default Project Content</p>",['class'=>"form-control widearea",'data-widearea'=>"enable",'id'=>"content"]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
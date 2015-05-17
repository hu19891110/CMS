<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">User</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    {!! Form::text('name',null,['class'=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('slug','Slug') !!}
                    {!! Form::text('slug',null,['class'=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description','Description') !!}
                    {!! Form::text('description',null,['class'=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('level','Level') !!}
                    {!! Form::text('level',null,['class'=>"form-control"]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Actions</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::submit(isset($submitButtonText)?$submitButtonText:"Submit",['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
     <div class="col-lg-4 col-md-6 col-sm-12">
         <div class="box box-primary">
             <div class="box-header">
                 <h3 class="box-title">User</h3>
             </div><!-- /.box-header -->
             <div class="box-body">
                 <div class="form-group">
                     {!! Form::label('name_first','First Name') !!}
                     {!! Form::text('name_first',null,['class'=>"form-control"]) !!}
                 </div>
                 <div class="form-group">
                     {!! Form::label('name_middle','Middle Name') !!}
                     {!! Form::text('name_middle',null,['class'=>"form-control"]) !!}
                 </div>
                 <div class="form-group">
                     {!! Form::label('name_last','Last Name') !!}
                     {!! Form::text('name_last',null,['class'=>"form-control"]) !!}
                 </div>
                 <div class="form-group">
                     {!! Form::label('email','E-Mail Address') !!}
                     {!! Form::text('email',null,['class'=>"form-control"]) !!}
                 </div>
                 <div class="form-group">
                     {!! Form::label('username','Username') !!}
                     {!! Form::text('username',null,['class'=>"form-control"]) !!}
                 </div>
                 <div class="form-group">
                     {!! Form::label('password','Password') !!}
                     {!! Form::password('password',['class'=>"form-control"]) !!}
                 </div>
                 <div class="form-group">
                     {!! Form::label('password_confirmation','Confirm Password') !!}
                     {!! Form::password('password_confirmation',['class'=>"form-control"]) !!}
                 </div>
             </div>
         </div>
     </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Roles</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <p>Roles in higher Levels automatically inherit all roles in lower levels.</p>
                    @foreach($roles as $level => $levelRoles)
                        <label>Roles in Level: {{$level}}</label>
                        @foreach($levelRoles as $role)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('roles[]', $role->slug, (isset($user)&&$user->is($role->slug) ? true : false)) !!}
                                    {{$role->name}}
                                </label>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Permissions</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <p>Roles in higher Levels automatically inherit all roles in lower levels.</p>
                    @foreach($roles as $level => $levelRoles)
                        <label>Roles in Level: {{$level}}</label>
                        @foreach($levelRoles as $role)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('roles[]', $role->slug, (isset($user)&&$user->is($role->slug) ? true : false)) !!}
                                    {{$role->name}}
                                </label>
                            </div>
                        @endforeach
                    @endforeach
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
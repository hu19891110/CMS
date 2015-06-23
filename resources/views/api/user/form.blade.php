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
    @permission('user.roles')
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Roles</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Assigned</th>
                                    <th>Inherited</th>
                                    <th>Denied</th>
                                </tr>
                                @foreach($roles as $group)
                                    <tr>
                                        <td colspan="5" class="text-center"><b>{{ ($group->random()->parent_id==NULL) ? "No Parent" : "Children of: ".$group->random()->parent->name}}</b></td>
                                    </tr>
                                    @foreach($group as $role)
                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>{!! Form::checkbox('roles[]', $role->slug, (isset($user)&&$user->grantedRoles->contains($role) ? true : false)) !!}</td>
                                            <td>{!! Form::checkbox('rolesInherited[]', $role->slug, (isset($user)&&$user->is($role->slug) ? true : false), ['disabled']) !!}</td>
                                            <td>{!! Form::checkbox('rolesDenied[]', $role->slug, (isset($user)&&$user->deniedRoles->contains($role) ? true : false), ['disabled']) !!}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Permissions Inherited</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            @if(isset($user))
                                <ul>

                                    @foreach($user->rolePermissions() as $permission)
                                        <li>{{$permission->name}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endpermission
    <div class="col-lg-4 col-md-6 col-sm-12">
        @permission('user.permissions')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Permissions Assigned</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('permissions_search','Permission Search:') !!}
                                {!! Form::text('permissions_search',null,['class'=>"form-control",'id'=>'permissions_search']) !!}
                            </div>
                            <div id="cblist">
                                @if(isset($user))
                                    @foreach($user->userPermissions as $permission)
                                        <div  class="checkbox">
                                            <label>
                                                <input checked type="checkbox" value="{{$permission->id}}" name="permission[]"/>
                                                {{$permission->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endpermission
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
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
    </div>
</div>
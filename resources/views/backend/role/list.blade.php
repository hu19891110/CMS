@extends('backend')
@section('title','Admin - User - Listing')
@section('content')
    <div class="box">
        <div class="box-body table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Level</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="user-table">
                @foreach($roles as $role)
                    <tr id="Role-{{$role->id}}-tr">
                        <td>{{$role->id}}</td>
                        <td id="Role-Name-{{$role->id}}">{{$role->name}}</td>
                        <td id="Role-Description-{{$role->id}}">{{$role->description}}</td>
                        <td id="Role-Level-{{$role->id}}">{{$role->level}}</td>
                        <td>
                            <!-- Edit Role -->
                            <a href="{{URL::route('admin.roles.edit',$role)}}" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                            @include('backend.role._partials.delete-btn')
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <div class="pull-left">

            </div>
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $roles->render() !!}
            </ul>
        </div>
    </div>
@stop
@section('javascript')
    @include('backend.role._partials.delete-js')
@stop
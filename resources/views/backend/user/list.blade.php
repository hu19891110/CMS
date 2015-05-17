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
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="user-table">
                    @foreach($users as $user)
                        <tr id="User-{{$user->id}}-tr">
                            <td>{{$user->id}}</td>
                            <td id="User-NameFull-{{$user->id}}">{{$user->name_full}}</td>
                            <td id="User-Email-{{$user->id}}">{{$user->email}}</td>
                            <td id="User-Username-{{$user->id}}">{{$user->username}}</td>
                            <td id="User-Status-{{$user->id}}">{{$user->status ? $user->status : "Active"}}</td>
                            <td>
                                <!-- Edit User -->
                                <a href="{{URL::route('admin.users.edit',$user)}}" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>

                                <!-- Lock User -->
                                @include('backend.user._partials.lock-btn')

                                <!-- Ban User -->
                                @include('backend.user._partials.ban-btn')

                                <!--Delete User -->
                                @include('backend.user._partials.delete-btn')
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
                {!! $users->render() !!}
            </ul>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker({
                format: "YYYY-MM-DD hh:mm:ss",
                sideBySide: true,
                showTodayButton: true,
                inline:true,
            });
        });
    </script>
    @include('backend.user._partials.lock-js')
    @include('backend.user._partials.ban-js')
    @include('backend.user._partials.delete-js')
@stop
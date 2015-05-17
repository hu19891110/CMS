<li class="header">Auth</li>
<!-- Optionally, you can add icons to the links -->
<li class="treeview {{Active::routePattern('admin.users.*',"active")}}">
    <a href="{{URL::route('admin.users')}}"><i class='fa fa-user'></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{Active::route('admin.users.list','active')}}"><a href="{{URL::route('admin.users.list')}}"><i class='fa fa-users'></i> <span>List Users</span></a></li>
        <li class="{{Active::route('admin.users.create','active')}}"><a href="{{URL::route('admin.users.create')}}"><i class='fa fa-users-plus'></i> <span>Create User</span></a></li>
    </ul>
</li>

<li class="treeview {{Active::routePattern('admin.roles.*',"active")}}">
    <a href="{{URL::route('admin.roles')}}"><i class='fa fa-user'></i> <span>Roles</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{Active::route('admin.roles.list','active')}}"><a href="{{URL::route('admin.roles.list')}}"><i class='fa fa-users'></i> <span>List Roles</span></a></li>
        <li class="{{Active::route('admin.roles.create','active')}}"><a href="{{URL::route('admin.roles.create')}}"><i class='fa fa-users-plus'></i> <span>Create Role</span></a></li>
    </ul>
</li>
<li class="{{Active::route('admin.users.settings','active')}}"><a href="#"><i class='fa fa-gear'></i> <span>Settings</span></a></li>
<!--
<li class="header">Navigation</li>
<li><a href="#"><i class='fa fa-link'></i> <span>Link</span></a></li>
<li><a href="#"><i class='fa fa-link'></i> <span>Another Link</span></a></li>
<li class="treeview">
    <a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="#">Link in level 2</a></li>
        <li><a href="#">Link in level 2</a></li>
    </ul>
</li>-->
<li class="header">Users</li>
<!-- Optionally, you can add icons to the links -->
<li class="treeview">
    <a href="{{URL::route('admin.users')}}"><i class='fa fa-user'></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{URL::route('admin.users.list')}}"><i class='fa fa-users'></i> <span>List Users</span></a></li>
        <li><a href="{{URL::route('admin.users.list')}}"><i class='fa fa-users-plus'></i> <span>Create User</span></a></li>
        <li><a href="#"><i class='fa fa-gear'></i> <span>Settings</span></a></li>
    </ul>
</li>


<li class="header">Navigation</li>
<!-- Optionally, you can add icons to the links -->
<li class="active"><a href="#"><i class='fa fa-link'></i> <span>Link</span></a></li>
<li><a href="#"><i class='fa fa-link'></i> <span>Another Link</span></a></li>
<li class="treeview">
    <a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="#">Link in level 2</a></li>
        <li><a href="#">Link in level 2</a></li>
    </ul>
</li>